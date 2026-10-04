<?php
// Single public intake: the marketing host validates the browser request and signs a
// server-to-server submission to the platform lead inbox. No local PII log is written.
require_once dirname(__DIR__) . '/functions.php';

header('Content-Type: application/json; charset=UTF-8');
header('Cache-Control: no-store');

function contactResponse(int $status, bool $ok, string $message): void {
    http_response_code($status);
    echo json_encode($ok ? ['ok' => true, 'message' => $message]
        : ['ok' => false, 'error' => $message], JSON_UNESCAPED_UNICODE);
    exit;
}

function contactField(array $data, string $key, int $maximum, bool $required = false): string {
    $raw = $data[$key] ?? '';
    if (!is_string($raw)) {
        contactResponse(422, false, 'Revisa los campos de la solicitud.');
    }
    $value = trim($raw);
    $length = function_exists('mb_strlen') ? mb_strlen($value, 'UTF-8') : strlen($value);
    if ($length > $maximum || ($required && $value === '')) {
        contactResponse(422, false, 'Revisa los campos obligatorios de la solicitud.');
    }
    return $value;
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    contactResponse(405, false, 'Método no permitido.');
}

$request = getJsonRequestData(8192);
if (!$request['ok']) {
    contactResponse((int)$request['status'], false, $request['error']);
}
$data = $request['data'];
if (isHoneypotTriggered($data)) {
    contactResponse(200, true, 'Solicitud recibida.');
}
if (!validateCsrfToken($data['csrf_token'] ?? '')) {
    contactResponse(403, false, 'Solicitud no válida. Actualiza la página e inténtalo de nuevo.');
}
$rateLimitDirectory = dirname(__DIR__) . '/data/rate_limit';
if (!is_dir($rateLimitDirectory) || !is_writable($rateLimitDirectory)) {
    contactResponse(503, false, 'No podemos recibir solicitudes en este momento. Escríbenos a contacto@indiceapp.com.');
}
$ip = function_exists('getClientIP') ? getClientIP() : ($_SERVER['REMOTE_ADDR'] ?? 'unknown');
$limit = rateLimit('contact:' . $ip, 5, 600);
if (!$limit['allowed']) {
    if (!empty($limit['retry_after'])) header('Retry-After: ' . (int)$limit['retry_after']);
    contactResponse(429, false, 'Demasiados intentos. Inténtalo más tarde.');
}

$fullName = contactField($data, 'fullName', 120, true);
$companyName = contactField($data, 'companyName', 160, true);
$email = strtolower(contactField($data, 'email', 180, true));
$phone = contactField($data, 'phone', 40);
$country = contactField($data, 'country', 80);
$challenge = contactField($data, 'challenge', 3000, true);
$landingPath = contactField($data, 'landingPath', 255);
$utmSource = contactField($data, 'utmSource', 100);
$utmMedium = contactField($data, 'utmMedium', 100);
$utmCampaign = contactField($data, 'utmCampaign', 150);
$planInterest = strtoupper(contactField($data, 'planInterest', 20));
$submittedId = contactField($data, 'submissionId', 36);

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || ($data['contactConsent'] ?? null) !== true) {
    contactResponse(422, false, 'Indica un correo válido y autoriza que te contactemos.');
}
if ($landingPath !== '' && $landingPath[0] !== '/') {
    contactResponse(422, false, 'Origen de solicitud no válido.');
}
if ($planInterest !== '' && !in_array($planInterest, ['CONTROLA', 'ESCALA', 'CORPORATIVO'], true)) {
    contactResponse(422, false, 'Plan de interés no válido.');
}

$secret = (string)($_ENV['INDICE_LEAD_INGEST_SECRET'] ?? '');
if (strlen($secret) < 32 || !function_exists('curl_init')) {
    contactResponse(503, false, 'No podemos recibir solicitudes en este momento. Escríbenos a contacto@indiceapp.com.');
}

$socialSources = ['facebook', 'instagram', 'meta', 'tiktok', 'youtube', 'linkedin'];
$sourceChannel = in_array(strtolower($utmSource), $socialSources, true)
    || in_array(strtolower($utmMedium), ['social', 'paid_social', 'social_paid'], true)
    ? 'SOCIAL' : 'WEBSITE';
$payload = json_encode([
    'fullName' => $fullName,
    'companyName' => $companyName,
    'email' => $email,
    'phone' => $phone,
    'country' => $country,
    'challenge' => $challenge,
    'landingPath' => $landingPath,
    'sourceChannel' => $sourceChannel,
    'utmSource' => $utmSource,
    'utmMedium' => $utmMedium,
    'utmCampaign' => $utmCampaign,
    'planInterest' => $planInterest,
    'contactConsent' => true,
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
if ($payload === false) contactResponse(422, false, 'La solicitud contiene caracteres no válidos.');

if ($submittedId !== '' && !preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i', $submittedId)) {
    contactResponse(422, false, 'Referencia de solicitud no válida.');
}
if ($submittedId === '') {
    $bytes = random_bytes(16);
    $bytes[6] = chr((ord($bytes[6]) & 0x0f) | 0x40);
    $bytes[8] = chr((ord($bytes[8]) & 0x3f) | 0x80);
    $hex = bin2hex($bytes);
    $submittedId = substr($hex, 0, 8) . '-' . substr($hex, 8, 4) . '-' . substr($hex, 12, 4)
        . '-' . substr($hex, 16, 4) . '-' . substr($hex, 20);
}
$submissionId = strtolower($submittedId);
$timestamp = (string)time();
$signature = hash_hmac('sha256', $timestamp . "\n" . $submissionId . "\n" . $payload, $secret);
$url = getIndiceAppBaseUrl() . '/api/v1/public/platform-leads';
$requestHandle = curl_init($url);
curl_setopt_array($requestHandle, [
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $payload,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => false,
    CURLOPT_CONNECTTIMEOUT => 4,
    CURLOPT_TIMEOUT => 10,
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'X-Lead-Id: ' . $submissionId,
        'X-Lead-Timestamp: ' . $timestamp,
        'X-Lead-Signature: ' . $signature,
    ],
]);
$response = curl_exec($requestHandle);
$status = (int)curl_getinfo($requestHandle, CURLINFO_HTTP_CODE);
curl_close($requestHandle);
if ($response === false || $status !== 201) {
    contactResponse(502, false, 'No pudimos guardar tu solicitud. Inténtalo de nuevo o escríbenos a contacto@indiceapp.com.');
}
contactResponse(200, true, 'Solicitud recibida. Un consultor te contactará para coordinar el diagnóstico sin costo.');
