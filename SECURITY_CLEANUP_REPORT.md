# SECURITY & CLEANUP REPORT

Auditoría de seguridad, limpieza y estructura aplicada a Índice Web.
Sin cambios visuales ni de precios. Sin frameworks nuevos. Sin romper Stripe.

## 1. Cambios realizados

### `.htaccess` endurecido
- Conserva el bloque cPanel (`ea-php84` handler).
- `Options -Indexes`.
- Bloqueo por `FilesMatch` de: `.env`, `.env.*`, `*.log`, `error_log`,
  `composer.json/lock`, `package.json/lock`, `README.md`, `*.sql`, `*.bak`,
  `*.backup`, `*.old`, `*.zip`, `*.tar`, `*.gz`, `*.ini`, `*.sh`, `.htaccess.*`,
  `AGENTS.md`, `LAUNCH-CHECKLIST*.md`, `SECURITY_CLEANUP_REPORT.md`.
- Bloqueo por `RewriteRule` de carpetas: `/data/`, `/logs/`, `/registrations/`,
  `/_archive_cleanup/`.
- Headers de seguridad: `X-Frame-Options: SAMEORIGIN`, `X-Content-Type-Options: nosniff`,
  `Referrer-Policy: strict-origin-when-cross-origin`,
  `Permissions-Policy: geolocation=(), microphone=(), camera=()`, `X-XSS-Protection: 0`.
- `mod_deflate` para HTML/CSS/JS/JSON/SVG/fonts.
- `mod_expires` y `Cache-Control` para assets estáticos (7 días CSS/JS, 30 días imágenes,
  1 año fonts) y `no-cache` para `.php/.html`.

### CSRF, rate limit y honeypot
- Nuevos helpers en `functions.php`:
  - `startSecureSession()` — sesión con cookie `httponly`, `samesite=Lax`, `secure` en HTTPS.
  - `generateCsrfToken()` / `validateCsrfToken($t)` — token de 64 hex en `$_SESSION['csrf_token']`,
    comparación con `hash_equals`.
  - `csrfMetaTag()` — `<meta name="csrf-token">` inyectado por `header.php`.
  - `csrfInput()` — input oculto para forms tradicionales.
  - `honeypotInput()` / `isHoneypotTriggered()` — campo `company_website` invisible.
  - `rateLimit($key, $max=5, $window=600)` — basado en archivos en `data/rate_limit/`.
- `api/contact.php` y `api/capture_registration.php`:
  - Validan CSRF (HTTP 403 si falla).
  - Aplican rate limit 5/10min por IP (HTTP 429 con `Retry-After`).
  - Validan honeypot (responden éxito genérico si está lleno).
  - Validan email con `FILTER_VALIDATE_EMAIL`.
  - Mantienen el formato JSON original que consume `js/main.js`.
- `contacto.php` ahora incluye `<?php echo honeypotInput(); ?>` en el form.
- `js/main.js` ahora envía `csrf_token` y `company_website` en ambos endpoints.

### `registro.php` aislado
- Verifica `file_exists($bootstrapPath)` antes de `require`.
- Envuelve bootstrap + auth + permissions en `try/catch` con `Throwable`.
- Captura `Throwable` también en el flujo POST (antes solo `Exception`).
- Valida `email` con `FILTER_VALIDATE_EMAIL`.
- En caso de fallo: responde HTTP 503 con página minimal sin path interno;
  loguea con `error_log('[registro.php] ...')`.
- Comentario inicial documentando el acoplamiento temporal.

### i18n sincronizado
- `getSupportedLocales()` ahora incluye `en-US` (8 locales).
- `countryToLocale()` mapea `US`, `GB`, `AU`, `IE`, `NZ` → `en-US`; Canadá sigue `en-CA`.
- `js/i18n.js` `SUPPORTED_LOCALES` y `LOCALE_ALIASES` actualizados con `en-US`.
- `header.php` selector de idioma agrega "English US".

## 2. Archivos movidos a `_archive_cleanup/`

| Origen                                  | Motivo                                  |
|-----------------------------------------|-----------------------------------------|
| `1registro.php`                         | Vacío, sin referencias                  |
| `auth/register.php`                     | Vacío, sin referencias                  |
| `test.php`                              | Página de prueba                        |
| `debug-clicks.js`                       | Script de debug                         |
| `test-modulos.js`                       | Script de prueba                        |
| `error_log`                             | Log antiguo                             |
| `.htaccess.phpupgrader.34ab719e`        | Backup de upgrader cPanel               |
| `.htaccess.phpupgrader.initial`        | Backup de upgrader cPanel               |
| `imgs/logo-indice.png.png`              | Duplicado de doble extensión            |
| `imgs/modulos/procesos-tareas.png.png`  | Duplicado de doble extensión            |
| `imgs/modulos/recursos-humanos.png.png` | Duplicado de doble extensión            |
| `planes_new.php`                        | Versión vieja de planes ($25/$75)       |

`AGENTS.md` también se actualizó para quitar la referencia a `planes_new.php`.

## 3. Archivos sensibles protegidos

- `.env`, `.env.*` → 403.
- Cualquier `*.log` y `error_log` → 403.
- `composer.json/lock`, `package.json/lock`, `*.sql`, backups → 403.
- `README.md`, `AGENTS.md`, `LAUNCH-CHECKLIST*.md` → 403 (no leakean estructura).
- `/data/`, `/logs/`, `/registrations/`, `/_archive_cleanup/` → 403 vía `RewriteRule`.
- `_archive_cleanup/.htaccess` agrega `deny from all` como segunda capa.
- `data/rate_limit/.htaccess` se crea automáticamente con `Require all denied`.

## 4. Locales sincronizados

| Locale  | JSON | PHP `getSupportedLocales()` | JS `SUPPORTED_LOCALES` | Selector header |
|---------|:----:|:---------------------------:|:----------------------:|:---------------:|
| es-MX   | ✓    | ✓                           | ✓                      | ✓               |
| es-CO   | ✓    | ✓                           | ✓                      | ✓               |
| en-CA   | ✓    | ✓                           | ✓                      | ✓               |
| en-US   | ✓    | ✓ **(nuevo)**               | ✓ **(nuevo)**          | ✓ **(nuevo)**   |
| fr-CA   | ✓    | ✓                           | ✓                      | ✓               |
| pt-BR   | ✓    | ✓                           | ✓                      | ✓               |
| zh-CN   | ✓    | ✓                           | ✓                      | ✓               |
| ko-KR   | ✓    | ✓                           | ✓                      | ✓               |

Fallback global: `es-MX`. Selector de Canadá ofrece `en-CA`, `fr-CA`.

## 5. Endpoints protegidos

| Endpoint                            | CSRF | Rate limit       | Honeypot | Email validation |
|-------------------------------------|:----:|------------------|:--------:|:----------------:|
| `api/contact.php`                   | ✓    | 5 / 10min / IP   | ✓        | ✓                |
| `api/capture_registration.php`      | ✓    | 5 / 10min / IP   | ✓        | ✓                |

`registro.php` no es endpoint JSON pero ahora valida email y captura excepciones.

## 6. Riesgos pendientes

1. **`registro.php` sigue acoplado a producción** (DB y Stripe del app real).
   Recomendación: migrar a una API REST en `app.indiceapp.com` y dejar aquí solo la UI.
2. **No hay CAPTCHA**. El honeypot + rate limit reduce abuso pero un atacante humano
   puede saltarse ambos. Si hay spam persistente, considerar Cloudflare Turnstile.
3. **`js/i18n.js` carga JSON sin verificación de integridad**. Un atacante con MITM
   podría alterar textos. Mitigado por HTTPS pero vale añadir SRI si se mueve a CDN.
4. **`data/rate_limit/`** crece sin recolección de basura. Limpieza por TTL al vuelo
   pero los archivos persisten. Sugerido: cron mensual `find data/rate_limit -mtime +7 -delete`.
5. **`functions.php` aún usa `@mail()`** para envío de contacto. Si se requiere fiabilidad,
   migrar a SMTP autenticado (PHPMailer + `.env`).
6. **Páginas `/privacidad.php` y `/terminos.php`** referenciadas en footer no existen.
7. **No hay CSP** (Content-Security-Policy). Por compatibilidad con CDNs no se añadió;
   evaluar `Content-Security-Policy-Report-Only` primero.
8. **Sesiones PHP**: `startSecureSession()` se invoca al generar el meta CSRF y al validar.
   Si en producción ya hay otra sesión activa antes del header, podría haber colisión
   de cookies. Verificar.

## 7. Recomendaciones siguientes

- Crear `privacidad.php` y `terminos.php`.
- Configurar Cloudflare Turnstile en formularios públicos.
- Reemplazar `@mail()` por PHPMailer + SMTP del `.env`.
- Migrar `registro.php` a un endpoint del app principal.
- Añadir cron de limpieza para `data/rate_limit/` y `data/geo_cache/`.
- Tras 30 días de validación productiva, eliminar contenido de `_archive_cleanup/`.
- Considerar `Content-Security-Policy-Report-Only` + tracking en Sentry / log propio.
- Versionar assets con query string (`?v=YYYYMMDD`) para invalidar caché tras deploy.

## 8. Validaciones ejecutadas

```bash
php -l header.php
php -l footer.php
php -l functions.php
php -l index.php
php -l planes.php
php -l metodologia.php
php -l contacto.php
php -l registro.php
php -l api/contact.php
php -l api/capture_registration.php
git diff --check
```

Resultado: ver salida en consola al final de la sesión.
