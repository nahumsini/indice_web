<?php
// API de contacto (Marketing 2025)
// POST JSON: { nombre, email, pais, mensaje, csrf_token, company_website }
// Respuesta: { ok: true } | { ok: false, error }

require_once dirname(__DIR__) . '/functions.php';

header('Content-Type: application/json; charset=UTF-8');
header('Cache-Control: no-store');

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
if ($method !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Método no permitido']);
    exit;
}

// Leer payload JSON con límite defensivo de tamaño.
$request = getJsonRequestData(32768);
if (!$request['ok']) {
    http_response_code((int)$request['status']);
    echo json_encode(['ok' => false, 'error' => $request['error']]);
    exit;
}
$data = $request['data'];

// Honeypot: si trae el campo oculto lleno, respondemos OK genérico y no procesamos.
if (isHoneypotTriggered($data)) {
    http_response_code(200);
    echo json_encode(['ok' => true]);
    exit;
}

// CSRF
if (!validateCsrfToken($data['csrf_token'] ?? '')) {
    http_response_code(403);
    echo json_encode(['ok' => false, 'error' => 'Invalid request.']);
    exit;
}

// Rate limit por IP + endpoint (5 intentos / 10 min)
$ip = function_exists('getClientIP') ? getClientIP() : ($_SERVER['REMOTE_ADDR'] ?? 'unknown');
$rl = rateLimit('contact:' . $ip, 5, 600);
if (!$rl['allowed']) {
    http_response_code(429);
    if (!empty($rl['retry_after'])) {
        header('Retry-After: ' . (int)$rl['retry_after']);
    }
    echo json_encode(['ok' => false, 'error' => 'Too many attempts. Please try again later.']);
    exit;
}

$nombre  = limitText($data['nombre'] ?? '', 120);
$email   = limitText($data['email'] ?? '', 180);
$pais    = limitText($data['pais'] ?? '', 80);
$mensaje = limitText($data['mensaje'] ?? '', 3000);

if ($nombre === '' || $email === '' || $mensaje === '') {
    http_response_code(422);
    echo json_encode(['ok' => false, 'error' => 'Campos obligatorios: nombre, email, mensaje']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(422);
    echo json_encode(['ok' => false, 'error' => 'Email inválido']);
    exit;
}

// Logging sencillo dentro del proyecto
$logDir = dirname(__DIR__) . '/logs';
ensurePrivateRuntimeDir($logDir, 0750);
$logEntry = [
  'ts' => date('c'),
  'ip' => $ip,
  'payload' => compact('nombre','email','pais','mensaje'),
];
@file_put_contents($logDir . '/contact.log', json_encode($logEntry, JSON_UNESCAPED_UNICODE) . "\n", FILE_APPEND | LOCK_EX);

// Envío de email opcional
$subject = 'Nuevo contacto desde la web';
$body = '<h3>Nuevo contacto</h3>' .
        '<p><strong>Nombre:</strong> ' . htmlspecialchars($nombre) . '</p>' .
        '<p><strong>Email:</strong> ' . htmlspecialchars($email) . '</p>' .
        '<p><strong>País:</strong> ' . htmlspecialchars($pais) . '</p>' .
        '<p><strong>Mensaje:</strong><br>' . nl2br(htmlspecialchars($mensaje)) . '</p>';

if (function_exists('sendEmail')) {
    $to = $_ENV['CONTACT_TO'] ?? 'info@indiceapp.com';
    @sendEmail($to, $subject, $body);
}

http_response_code(200);
echo json_encode(['ok' => true]);
