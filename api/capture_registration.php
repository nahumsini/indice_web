<?php
require_once dirname(__DIR__) . '/functions.php';

header('Content-Type: application/json; charset=UTF-8');
header('Cache-Control: no-store');

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
if ($method !== 'POST') {
	http_response_code(405);
	echo json_encode(['success' => false, 'message' => 'Method not allowed']);
	exit;
}

$request = getJsonRequestData(32768);
if (!$request['ok']) {
	http_response_code((int)$request['status']);
	echo json_encode(['success' => false, 'message' => $request['error']]);
	exit;
}
$data = $request['data'];

// Honeypot → respuesta genérica de éxito sin procesar
if (isHoneypotTriggered($data)) {
	http_response_code(200);
	echo json_encode(['success' => true, 'message' => 'Registration captured']);
	exit;
}

// CSRF
if (!validateCsrfToken($data['csrf_token'] ?? '')) {
	http_response_code(403);
	echo json_encode(['success' => false, 'message' => 'Invalid request.']);
	exit;
}

// Rate limit: 5 / 10 min por IP
$ip = function_exists('getClientIP') ? getClientIP() : ($_SERVER['REMOTE_ADDR'] ?? 'unknown');
$rl = rateLimit('capture:' . $ip, 5, 600);
if (!$rl['allowed']) {
	http_response_code(429);
	if (!empty($rl['retry_after'])) {
		header('Retry-After: ' . (int)$rl['retry_after']);
	}
	echo json_encode(['success' => false, 'message' => 'Too many attempts. Please try again later.']);
	exit;
}

function sanitizeField($value) {
	return limitText($value ?? '', 180);
}

$nombre   = sanitizeField($data['nombre']   ?? '');
$email    = sanitizeField($data['email']    ?? '');
$pais     = sanitizeField($data['pais']     ?? '');
$empresa  = sanitizeField($data['empresa']  ?? '');
$telefono = sanitizeField($data['telefono'] ?? '');
$contacto = sanitizeField($data['contacto'] ?? '');


if ($contacto !== '') {
	if ($email === '' && strpos($contacto, '@') !== false) {
		$email = $contacto;
	} elseif ($telefono === '') {
		$telefono = $contacto;
	}
}

if ($email === '' && $telefono === '') {
	http_response_code(422);
	echo json_encode(['success' => false, 'message' => 'Email or phone required']);
	exit;
}

if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
	http_response_code(422);
	echo json_encode(['success' => false, 'message' => 'Invalid email']);
	exit;
}

$logDir = dirname(__DIR__) . '/logs';
ensurePrivateRuntimeDir($logDir, 0750);

$entry = [
	'ts' => date('c'),
	'ip' => $ip,
	'payload' => [
		'nombre'   => $nombre,
		'email'    => $email,
		'pais'     => $pais,
		'empresa'  => $empresa,
		'telefono' => $telefono,
	],
];

@file_put_contents(
	$logDir . '/registrations.log',
	json_encode($entry, JSON_UNESCAPED_UNICODE) . "\n",
	FILE_APPEND | LOCK_EX
);

http_response_code(200);
echo json_encode(['success' => true, 'message' => 'Registration captured']);
