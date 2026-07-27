<?php
/**
 * registro.php
 *
 * NOTA: Este archivo está acoplado temporalmente a app.indiceapp.com
 * (bootstrap, base de datos y Stripe en producción). Recomendado
 * migrar a una API segura del app y dejar aquí únicamente la UI.
 *
 * Defensas mínimas (no rompen producción):
 *  - Verifica existencia de bootstrap antes del require.
 *  - Envuelve la integración crítica en try/catch.
 *  - No expone rutas internas ni stack traces al usuario.
 */

require_once __DIR__ . '/functions.php';

$bootstrapPath = '/home1/corazon/app.indiceapp.com/bootstrap.php';
$friendlyError = 'No pudimos iniciar el registro en este momento. '
    . 'Por favor contáctanos en contacto@indiceapp.com.';

if (!file_exists($bootstrapPath)) {
    error_log('[registro.php] App bootstrap not found.');
    http_response_code(503);
    echo '<!doctype html><meta charset="utf-8"><title>Registro</title>'
        . '<div style="font-family:system-ui,-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,sans-serif;max-width:560px;margin:80px auto;padding:24px;'
        . 'border:1px solid #e5e7eb;border-radius:12px;color:#111;">'
        . '<h1 style="margin:0 0 12px;font-size:1.25rem;">Registro temporalmente no disponible</h1>'
        . '<p style="margin:0;color:#374151;">' . htmlspecialchars($friendlyError) . '</p>'
        . '</div>';
    exit;
}

try {
    require $bootstrapPath;
    $config = require '/home1/corazon/app.indiceapp.com/panel_root/stripe_config.php';
    $plans  = db()->query("SELECT * FROM plans ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);

    if (!defined('APP_BOOTSTRAPPED')) {
        http_response_code(403);
        exit;
    }
    require '/home1/corazon/app.indiceapp.com/core/auth.php';
    require '/home1/corazon/app.indiceapp.com/core/permissions.php';
} catch (Throwable $bootErr) {
    error_log('[registro.php] Bootstrap failure: ' . $bootErr->getMessage());
    http_response_code(503);
    echo '<!doctype html><meta charset="utf-8"><title>Registro</title>'
        . '<div style="font-family:system-ui,-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,sans-serif;max-width:560px;margin:80px auto;padding:24px;'
        . 'border:1px solid #e5e7eb;border-radius:12px;color:#111;">'
        . '<h1 style="margin:0 0 12px;font-size:1.25rem;">Registro temporalmente no disponible</h1>'
        . '<p style="margin:0;color:#374151;">' . htmlspecialchars($friendlyError) . '</p>'
        . '</div>';
    exit;
}

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isHoneypotTriggered($_POST)) {
            http_response_code(200);
            echo '<!doctype html><meta charset="utf-8"><title>Registro</title>'
                . '<div style="font-family:system-ui,-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,sans-serif;max-width:560px;margin:80px auto;padding:24px;'
                . 'border:1px solid #e5e7eb;border-radius:12px;color:#111;">'
                . '<h1 style="margin:0 0 12px;font-size:1.25rem;">Registro recibido</h1>'
                . '<p style="margin:0;color:#374151;">Gracias. Revisaremos la información enviada.</p>'
                . '</div>';
            exit;
        }

        if (!validateCsrfToken($_POST['csrf_token'] ?? '')) {
            throw new Exception('Solicitud inválida');
        }

        $ip = function_exists('getClientIP') ? getClientIP() : ($_SERVER['REMOTE_ADDR'] ?? 'unknown');
        $rl = rateLimit('registro:' . $ip, 5, 600);
        if (!$rl['allowed']) {
            http_response_code(429);
            if (!empty($rl['retry_after'])) {
                header('Retry-After: ' . (int)$rl['retry_after']);
            }
            throw new Exception('Demasiados intentos');
        }

        $payload_raw = $_POST['payload'] ?? '';
        if (!is_string($payload_raw) || strlen($payload_raw) > 65536) {
            throw new Exception('Payload inválido');
        }
        $payload = json_decode($payload_raw, true);
        if (!is_array($payload)) { throw new Exception('Payload inválido'); }

        // Paso 1: Usuario
        $step1 = $payload['step1'] ?? [];
        $nombre_completo = trim((string)($step1['name'] ?? ''));
        $email           = trim((string)($step1['email'] ?? ''));
        $telefono        = trim((string)($step1['phone'] ?? ''));
        $password        = (string)($step1['password'] ?? '');
        if ($nombre_completo === '' || $email === '' || $password === '') {
            throw new Exception('Datos de usuario incompletos');
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Email inválido');
        }

        // Paso 2: Empresa
        $step2 = $payload['step2'] ?? [];
        $nombre_empresa = trim((string)($step2['companyName'] ?? ''));
        $industria      = trim((string)($step2['industry'] ?? ''));
        $descripcion    = trim((string)($step2['description'] ?? ''));
        if ($nombre_empresa === '' || $industria === '') {
            throw new Exception('Datos de empresa incompletos');
        }

        // Paso 3: Unidades y negocios
        $step3 = $payload['step3'] ?? [];
        $unidades = is_array($step3['unidades'] ?? null) ? $step3['unidades'] : [];
        $num_colaboradores = isset($step3['colaboradores']) ? (int)$step3['colaboradores'] : 0;

        // Paso 4: Productos, canales y métodos de pago
        $step4 = $payload['step4'] ?? [];
        $canales_venta = isset($step4['ventas'])    && is_array($step4['ventas'])    ? implode(',', $step4['ventas'])    : '';
        $metodos_pago  = isset($step4['pagos'])     && is_array($step4['pagos'])     ? implode(',', $step4['pagos'])     : '';
        $catalogo      = isset($step4['catalogo'])  && is_array($step4['catalogo'])  ? implode(',', $step4['catalogo'])  : '';

        // Plan seleccionado
        $plan_id = $_POST['plan_id'] ?? null;
        $plan = null;
        foreach ($plans as $p) { if ($p['id'] == $plan_id) $plan = $p; }
        if (!$plan) throw new Exception('Plan no seleccionado');
        $dias_trial = isset($plan['trial_days']) ? (int)$plan['trial_days'] : 0;
        $price = isset($plan['price']) ? (float)$plan['price'] : 0.0;

        // Si el plan tiene días gratis, crear el intento y esperar el cobro
        if ($dias_trial > 0) {
            $stmt = db()->prepare("INSERT INTO signup_intents (email, business_name, plan_slug, status, payload_json) VALUES (:email, :biz, :plan, 'trial', :payload)");
            $stmt->execute([':email' => $email, ':biz' => $nombre_empresa, ':plan' => $plan['name'], ':payload' => json_encode($payload, JSON_UNESCAPED_UNICODE)]);
            header('Location: https://app.indiceapp.com/auth/login?trial=true');
            exit();
        } else {
            require_once __DIR__ . '/vendor/autoload.php';
            $stripe = new \Stripe\StripeClient($config[$config['mode']==='live'?'secret_key_live':'secret_key_test']);
            $intent_id = uniqid();
            $session = $stripe->checkout->sessions->create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'mxn',
                        'product_data' => [
                            'name' => $plan['name'],
                        ],
                        'unit_amount' => (int)($price * 100),
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => 'https://indiceapp.com/register.php?paid=1',
                'cancel_url'  => 'https://indiceapp.com/register.php?error=1',
                'metadata' => [ 'intent_id' => $intent_id ]
            ]);
            $stmt = db()->prepare("INSERT INTO signup_intents (email, business_name, plan_slug, status, payload_json, intent_id) VALUES (:email, :biz, :plan, 'awaiting_payment', :payload, :intent_id)");
            $stmt->execute([':email' => $email, ':biz' => $nombre_empresa, ':plan' => $plan['name'], ':payload' => json_encode($payload, JSON_UNESCAPED_UNICODE), ':intent_id' => $intent_id]);
            header('Location: ' . $session->url);
            exit();
        }
    } catch (Throwable $e) {
        error_log('[registro.php] POST error: ' . $e->getMessage());
        // Mensaje amigable; nunca exponer ruta/stack al usuario.
        $error_message = 'No pudimos completar tu registro. Por favor verifica los datos o escríbenos a contacto@indiceapp.com.';
    }
}
?>
<?php
$page_title = 'Registro';
$page_description = 'Inicia tu registro en Indice';
include 'header.php';
?>

<section class="page-hero bg-surface reveal">
    <div class="container">
        <div class="card border-0 shadow-sm mx-auto" style="max-width: 640px;">
            <div class="card-body p-4 p-md-5">
                <h2 class="h3 text-center mb-4">Comienza tu Prueba Gratis</h2>
                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
                <?php endif; ?>
                <form method="post" id="form-registro">
                    <?php echo csrfInput(); ?>
                    <?php echo honeypotInput(); ?>
                    <input type="hidden" id="payload" name="payload">
                    <div class="mb-3">
                        <label for="plan_id" class="form-label">Selecciona un plan</label>
                        <select name="plan_id" id="plan_id" class="form-select" required>
                            <option value="">Elige un plan…</option>
                            <?php foreach ($plans as $p): ?>
                                <option value="<?php echo $p['id']; ?>"><?php echo htmlspecialchars($p['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Aqui va el wizard completo (usuario, empresa, unidades, productos, etc.) -->
                    <!-- Puedes reutilizar el HTML y JS del registro original -->
                    <button type="submit" class="btn btn-primary">Registrar y pagar</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
