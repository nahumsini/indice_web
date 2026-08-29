<?php
function loadEnv($path = '.env') {
	if (!file_exists($path)) {
		return;
	}

	$lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	if (!$lines) {
		return;
	}

	foreach ($lines as $line) {
		$line = trim($line);
		if ($line === '' || strpos($line, '#') === 0 || strpos($line, '=') === false) {
			continue;
		}

		[$name, $value] = array_map('trim', explode('=', $line, 2));
		if ($name !== '' && !array_key_exists($name, $_ENV)) {
			$_ENV[$name] = $value;
		}
	}
}

if (!isset($_ENV['ENV_LOADED'])) {
	loadEnv();
	$_ENV['ENV_LOADED'] = true;
}

function getIndiceAppBaseUrl() {
	$configuredUrl = trim((string)($_ENV['APP_URL'] ?? 'https://app.indiceapp.com'));
	if (!preg_match('#^https://#i', $configuredUrl)) {
		return 'https://app.indiceapp.com';
	}

	return rtrim($configuredUrl, '/');
}

function getIndiceLoginUrl() {
	return getIndiceAppBaseUrl() . '/login';
}

function getIndiceLoginUrlAttr() {
	return htmlspecialchars(getIndiceLoginUrl(), ENT_QUOTES, 'UTF-8');
}

function getIndiceSignupUrl() {
	return getIndiceAppBaseUrl() . '/signup';
}

function getIndiceSignupUrlAttr() {
	return htmlspecialchars(getIndiceSignupUrl(), ENT_QUOTES, 'UTF-8');
}

function sendEmail($to, $subject, $message, $headers = []) {
	$to = sanitizeEmailHeader($to);
	$subject = sanitizeEmailHeader($subject);
	if ($to === '' || $subject === '') {
		return false;
	}

	$defaultHeaders = [
		'From' => $_ENV['EMAIL_FROM'] ?? 'info@indiceapp.com',
		'Reply-To' => $_ENV['EMAIL_FROM'] ?? 'info@indiceapp.com',
		'Content-Type' => 'text/html; charset=UTF-8',
		'X-Mailer' => 'PHP/' . phpversion()
	];

	$headers = array_merge($defaultHeaders, $headers);
	$headerString = '';
	foreach ($headers as $key => $value) {
		$key = preg_replace('/[^A-Za-z0-9\-]/', '', (string)$key);
		$value = sanitizeEmailHeader($value);
		if ($key === '' || $value === '') {
			continue;
		}
		$headerString .= $key . ': ' . $value . "\r\n";
	}

	return @mail($to, $subject, $message, $headerString);
}

function sanitizeEmailHeader($value) {
	return trim(str_replace(["\r", "\n"], '', (string)$value));
}

function sanitizeInput($data) {
	return htmlspecialchars(trim((string)$data), ENT_QUOTES, 'UTF-8');
}

function getClientIP() {
	$remote = normalizeIp($_SERVER['REMOTE_ADDR'] ?? '');
	$trustProxyHeaders = !empty($_ENV['TRUST_PROXY_HEADERS']) && $_ENV['TRUST_PROXY_HEADERS'] === 'true';

	if ($trustProxyHeaders) {
		$cfIp = normalizeIp($_SERVER['HTTP_CF_CONNECTING_IP'] ?? '');
		if ($cfIp !== null) {
			return $cfIp;
		}

		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$parts = explode(',', (string)$_SERVER['HTTP_X_FORWARDED_FOR']);
			foreach ($parts as $part) {
				$ip = normalizeIp($part);
				if ($ip !== null) {
					return $ip;
				}
			}
		}

		$clientIp = normalizeIp($_SERVER['HTTP_CLIENT_IP'] ?? '');
		if ($clientIp !== null) {
			return $clientIp;
		}
	}

	return $remote ?? 'unknown';
}

function normalizeIp($ip) {
	$ip = trim((string)$ip);
	if ($ip === '') {
		return null;
	}
	return filter_var($ip, FILTER_VALIDATE_IP) ? $ip : null;
}

function isHttpsRequest() {
	if (!empty($_SERVER['HTTPS']) && strtolower((string)$_SERVER['HTTPS']) !== 'off') {
		return true;
	}
	if ((string)($_SERVER['SERVER_PORT'] ?? '') === '443') {
		return true;
	}

	$trustProxyHeaders = !empty($_ENV['TRUST_PROXY_HEADERS']) && $_ENV['TRUST_PROXY_HEADERS'] === 'true';
	if ($trustProxyHeaders && strtolower((string)($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '')) === 'https') {
		return true;
	}
	if (!empty($_SERVER['HTTP_CF_VISITOR']) && strpos((string)$_SERVER['HTTP_CF_VISITOR'], '"scheme":"https"') !== false) {
		return true;
	}

	return false;
}

function getJsonRequestData($maxBytes = 65536) {
	$raw = file_get_contents('php://input');
	if ($raw === false) {
		return ['ok' => false, 'status' => 400, 'error' => 'Invalid request body'];
	}

	if (strlen($raw) > $maxBytes) {
		return ['ok' => false, 'status' => 413, 'error' => 'Request body too large'];
	}

	$data = json_decode($raw, true);
	if (!is_array($data)) {
		return ['ok' => false, 'status' => 400, 'error' => 'Invalid JSON'];
	}

	return ['ok' => true, 'data' => $data];
}

function limitText($value, $maxLength = 500) {
	$value = trim((string)($value ?? ''));
	if (function_exists('mb_substr')) {
		return mb_substr($value, 0, $maxLength, 'UTF-8');
	}
	return substr($value, 0, $maxLength);
}

function ensurePrivateRuntimeDir($dir, $mode = 0750) {
	if (!is_dir($dir)) {
		@mkdir($dir, $mode, true);
	}
	if (is_dir($dir)) {
		@file_put_contents($dir . '/.htaccess', "Require all denied\nDeny from all\n");
	}
}

// ─────────────────────────────────────────────────────────────
// Geo / locale detection
// ─────────────────────────────────────────────────────────────

if (!defined('INDICE_LOCALE_COOKIE'))  define('INDICE_LOCALE_COOKIE', 'indice_locale');
if (!defined('INDICE_COUNTRY_COOKIE')) define('INDICE_COUNTRY_COOKIE', 'indice_country');

function getSupportedLocales() {
	return ['es-MX', 'es-CO', 'en-CA', 'fr-CA', 'zh-CA', 'ko-CA', 'pt-BR'];
}

function getDefaultLocale() {
	return 'es-MX';
}

function detectCountryCode() {
	// 1. Cloudflare header (instantáneo, sin costo)
	if (!empty($_SERVER['HTTP_CF_IPCOUNTRY'])) {
		$cf = strtoupper($_SERVER['HTTP_CF_IPCOUNTRY']);
		if (preg_match('/^[A-Z]{2}$/', $cf) && $cf !== 'XX' && $cf !== 'T1') {
			return $cf;
		}
	}

	// 2. Cookie cache (lookup previo)
	if (!empty($_COOKIE[INDICE_COUNTRY_COOKIE])) {
		$c = strtoupper(preg_replace('/[^A-Za-z]/', '', (string)$_COOKIE[INDICE_COUNTRY_COOKIE]));
		if (preg_match('/^[A-Z]{2}$/', $c)) {
			return $c;
		}
	}

	$ip = getClientIP();
	if (!$ip || $ip === 'unknown') return null;

	// 3. Cache en disco por hash de IP
	$cacheDir = __DIR__ . '/data/geo_cache';
	if (!is_dir($cacheDir)) {
		@mkdir($cacheDir, 0775, true);
	}
	$cacheFile = $cacheDir . '/' . sha1($ip) . '.json';
	if (is_file($cacheFile) && (time() - filemtime($cacheFile)) < 86400 * 30) {
		$data = json_decode((string)@file_get_contents($cacheFile), true);
		if (is_array($data) && !empty($data['country']) && preg_match('/^[A-Z]{2}$/', $data['country'])) {
			return $data['country'];
		}
	}

	// 4. Lookup remoto (con timeout corto, falla silenciosa)
	$country = lookupCountryByIp($ip);
	if ($country) {
		@file_put_contents($cacheFile, json_encode([
			'country' => $country,
			'ts'      => time(),
		]));
		if (!headers_sent()) {
			setcookie(INDICE_COUNTRY_COOKIE, $country, [
				'expires'  => time() + 86400 * 30,
				'path'     => '/',
				'secure'   => isHttpsRequest(),
				'httponly' => false,
				'samesite' => 'Lax',
			]);
		}
		return $country;
	}

	return null;
}

function lookupCountryByIp($ip) {
	if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
		return null;
	}

	$url = 'https://ipapi.co/' . urlencode($ip) . '/country/';
	$ctx = stream_context_create([
		'http' => [
			'timeout' => 2,
			'header'  => "User-Agent: IndiceWeb/1.0\r\n",
			'ignore_errors' => true,
		],
	]);
	$body = @file_get_contents($url, false, $ctx);
	if ($body === false) return null;

	$body = trim($body);
	if (preg_match('/^[A-Z]{2}$/', $body)) {
		return $body;
	}
	return null;
}

function countryToLocale($country) {
	if (!$country) return null;
	$c = strtoupper($country);

	$map = [
		// Hispanohablantes LATAM y España → es-MX
		'MX' => 'es-MX', 'AR' => 'es-MX', 'CL' => 'es-MX', 'PE' => 'es-MX',
		'EC' => 'es-MX', 'UY' => 'es-MX', 'PY' => 'es-MX', 'BO' => 'es-MX',
		'VE' => 'es-MX', 'DO' => 'es-MX', 'GT' => 'es-MX', 'HN' => 'es-MX',
		'SV' => 'es-MX', 'NI' => 'es-MX', 'CR' => 'es-MX', 'PA' => 'es-MX',
		'CU' => 'es-MX', 'PR' => 'es-MX', 'ES' => 'es-MX',
		'CO' => 'es-CO',
		// Portugués
		'BR' => 'pt-BR', 'PT' => 'pt-BR',
		// Inglés
		'CA' => 'en-CA', 'US' => 'en-CA', 'GB' => 'en-CA',
		'AU' => 'en-CA', 'IE' => 'en-CA', 'NZ' => 'en-CA',
		// Francés
		'FR' => 'fr-CA', 'BE' => 'fr-CA', 'LU' => 'fr-CA', 'CH' => 'fr-CA',
		// Chino
		'CN' => 'zh-CA', 'TW' => 'zh-CA', 'HK' => 'zh-CA', 'MO' => 'zh-CA', 'SG' => 'zh-CA',
		// Coreano
		'KR' => 'ko-CA', 'KP' => 'ko-CA',
	];

	return $map[$c] ?? null;
}

function countryToHeroVariant($country) {
	if (!$country) return 'b';
	$c = strtoupper($country);

	// LATAM hispanohablante → 'a' (dolor directo)
	$latam = ['MX','CO','AR','CL','PE','EC','UY','PY','BO','VE','DO','GT','HN','SV','NI','CR','PA','CU','PR'];
	if (in_array($c, $latam, true)) return 'a';

	// Norteamérica anglo → 'c' (eficiencia)
	if (in_array($c, ['CA','US'], true)) return 'c';

	// Resto del mundo → 'b' (transformación / general)
	return 'b';
}

function resolveSiteContext() {
	static $ctx = null;
	if ($ctx !== null) return $ctx;

	$supported = getSupportedLocales();
	$country   = detectCountryCode();
	$autoLocale = countryToLocale($country) ?: getDefaultLocale();

	// Override del usuario vía cookie (selector del header)
	$userOverride = false;
	$locale = $autoLocale;
	if (!empty($_COOKIE[INDICE_LOCALE_COOKIE])) {
		$candidate = (string)$_COOKIE[INDICE_LOCALE_COOKIE];
		if (in_array($candidate, $supported, true)) {
			$locale = $candidate;
			$userOverride = ($candidate !== $autoLocale);
		}
	}

	$ctx = [
		'country'      => $country,
		'locale'       => $locale,
		'autoLocale'   => $autoLocale,
		'userOverride' => $userOverride,
		'heroVariant'  => countryToHeroVariant($country),
		'supported'    => $supported,
	];
	return $ctx;
}

// ─────────────────────────────────────────────────────────────
// Seguridad: CSRF, rate limiting y honeypot
// ─────────────────────────────────────────────────────────────

function startSecureSession() {
	if (session_status() === PHP_SESSION_ACTIVE) {
		return;
	}
	if (headers_sent()) {
		return;
	}
	$secure = isHttpsRequest();
	session_set_cookie_params([
		'lifetime' => 0,
		'path'     => '/',
		'secure'   => $secure,
		'httponly' => true,
		'samesite' => 'Lax',
	]);
	@session_start();
}

function generateCsrfToken() {
	startSecureSession();
	if (empty($_SESSION['csrf_token']) || !is_string($_SESSION['csrf_token'])) {
		try {
			$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
		} catch (Exception $e) {
			$_SESSION['csrf_token'] = hash('sha256', uniqid('csrf_', true) . microtime(true));
		}
	}
	return $_SESSION['csrf_token'];
}

function validateCsrfToken($token) {
	startSecureSession();
	if (!is_string($token) || $token === '') return false;
	if (empty($_SESSION['csrf_token'])) return false;
	return hash_equals((string)$_SESSION['csrf_token'], $token);
}

function csrfMetaTag() {
	$token = htmlspecialchars(generateCsrfToken(), ENT_QUOTES, 'UTF-8');
	return '<meta name="csrf-token" content="' . $token . '">';
}

function csrfInput() {
	$token = htmlspecialchars(generateCsrfToken(), ENT_QUOTES, 'UTF-8');
	return '<input type="hidden" name="csrf_token" value="' . $token . '">';
}

function honeypotInput($name = 'company_website') {
	$safe = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
	return '<input type="text" name="' . $safe . '" value="" tabindex="-1" autocomplete="off" '
		. 'style="position:absolute;left:-9999px;height:0;width:0;opacity:0;" aria-hidden="true">';
}

function isHoneypotTriggered($payload, $name = 'company_website') {
	if (!is_array($payload)) return false;
	return isset($payload[$name]) && trim((string)$payload[$name]) !== '';
}

/**
 * Rate limit muy simple basado en archivos.
 * @return array ['allowed' => bool, 'remaining' => int, 'retry_after' => int|null]
 */
function rateLimit($key, $maxAttempts = 5, $windowSeconds = 600) {
	$dir = __DIR__ . '/data/rate_limit';
	ensurePrivateRuntimeDir($dir, 0750);
	$safeKey = preg_replace('/[^A-Za-z0-9_\-]/', '_', (string)$key);
	$file = $dir . '/' . sha1($safeKey) . '.json';
	$now = time();
	$attempts = [];

	if (is_file($file)) {
		$raw = @file_get_contents($file);
		$decoded = json_decode((string)$raw, true);
		if (is_array($decoded)) {
			foreach ($decoded as $ts) {
				if (is_int($ts) && ($now - $ts) < $windowSeconds) {
					$attempts[] = $ts;
				}
			}
		}
	}

	$count = count($attempts);
	if ($count >= $maxAttempts) {
		$oldest = min($attempts);
		return [
			'allowed'     => false,
			'remaining'   => 0,
			'retry_after' => max(1, $windowSeconds - ($now - $oldest)),
		];
	}

	$attempts[] = $now;
	@file_put_contents($file, json_encode($attempts), LOCK_EX);

	return [
		'allowed'     => true,
		'remaining'   => max(0, $maxAttempts - count($attempts)),
		'retry_after' => null,
	];
}
