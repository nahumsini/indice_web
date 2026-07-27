# Índice — Sitio Web Corporativo

Sitio oficial de [Índice](https://indiceapp.com), plataforma de gestión empresarial para PyMEs.

## Stack

- **PHP 8.4 plano** (sin framework, sin build system).
- **Bootstrap 5.3.3** vía CDN.
- **Font Awesome 6.5** vía CDN.
- **Tipografía segura del sistema** (`system-ui`, San Francisco, Segoe UI y equivalentes), sin descarga externa.
- CSS propio: [css/brand.css](css/brand.css) (tokens de marca) + [css/style.css](css/style.css) (componentes).
- JS vanilla: [js/main.js](js/main.js), [js/i18n.js](js/i18n.js), [js/modulos.js](js/modulos.js), [js/metodologia.js](js/metodologia.js).
- i18n por archivos JSON en [i18n/](i18n/).
- **APIs ligeras** en [api/](api/) (PHP plano que escribe a `/logs/`).
- **Despliegue**: SFTP/cPanel. No hay build.

## Estructura real

```
Indice_web/
├── header.php              # navbar, meta, CSRF meta tag, selector de locale
├── footer.php              # navegación institucional y datos corporativos
├── functions.php           # env loader, sanitizeInput, sendEmail,
│                           # detección de país, CSRF, rate limit, honeypot
├── index.php               # home tipográfico con mensaje por mercado
├── planes.php              # única página activa de planes
├── modulos.php             # módulos (datos en js/modulos-data.json)
├── metodologia.php
├── nosotros.php
├── contacto.php            # form contacto (CSRF + honeypot)
├── registro.php            # ⚠ acoplado a app.indiceapp.com (DB + Stripe)
├── api/
│   ├── contact.php         # POST JSON, CSRF, rate limit, honeypot
│   └── capture_registration.php
├── auth/                   # (vacío tras limpieza)
├── i18n/                   # es-MX, es-CO, en-CA, en-US, fr-CA, pt-BR, zh-CN, ko-KR
├── css/                    # brand.css + style.css
├── js/                     # i18n.js, main.js, modulos.js, metodologia.js
├── imgs/                   # logos y assets
├── data/                   # geo_cache, rate_limit (NO accesibles vía HTTP)
├── logs/                   # contact.log, registrations.log (NO accesibles)
├── _archive_cleanup/       # archivos retirados, bloqueados por .htaccess
├── .htaccess               # handler cPanel + hardening (FilesMatch, headers, gzip, expires)
├── .env / .env.example
├── AGENTS.md
└── SECURITY_CLEANUP_REPORT.md
```

## Advertencias importantes

- **`registro.php` está acoplado a producción** (`/home1/corazon/app.indiceapp.com/bootstrap.php`,
  base de datos `plans`/`signup_intents`, Stripe Checkout). No modificar sin validar en staging.
  El archivo ya valida `file_exists($bootstrapPath)` y captura excepciones para no exponer
  rutas internas si el bootstrap no está disponible.
- **APIs requieren CSRF token** del meta `<meta name="csrf-token">` que inyecta `header.php`.
  Sin token válido responden HTTP 403. Tienen rate limit de 5 intentos / 10 minutos por IP.
- **`/data/` y `/logs/` están bloqueados** por `RewriteRule` en `.htaccess` raíz. No mover el bloqueo.
- **`.env` nunca debe subirse**. `loadEnv()` lo carga al inicio de `header.php`.
- **`_archive_cleanup/`** contiene archivos retirados; no acceder vía HTTP (bloqueado).

## i18n

- 8 locales soportados: `es-MX` (default), `es-CO`, `en-CA`, `en-US`, `fr-CA`, `pt-BR`, `zh-CN`, `ko-KR`.
- Detección server-side: Cloudflare → cookie → IP (cache 30 días en `data/geo_cache/`).
- Detección client-side: `localStorage` → `data-server-locale` → `navigator.languages`.
- Atributos: `data-i18n`, `data-i18n-html`, `data-i18n-placeholder`, `data-i18n-aria-label`, `data-i18n-title`.
- Cuando se agregue texto visible, agregar la clave a **todos** los JSON de [i18n/](i18n/).

## Convenciones

- **PHP**: input siempre vía `sanitizeInput()` o `filter_var()`. Nunca `echo` directo de input.
- **JSON responses**:
  - `api/contact.php` → `{ok: bool, error?: string}`.
  - `api/capture_registration.php` → `{success: bool, message?: string}`.
- **Variables CSS**: `--indice-navy`, `--indice-blue-mid`, `--indice-yellow`, `--module-*` en `brand.css`.
- **Animaciones de scroll**: añadir clase `.reveal`; `js/main.js` usa `IntersectionObserver`.

## Validación previa al deploy

```bash
# Sintaxis PHP
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

# Whitespace y conflictos
git diff --check
```

Manual:

1. Home carga.
2. Navbar y selector de idioma funcionan.
3. `planes.php` muestra los 3 planes correctos.
4. Form de contacto envía y recibe `{ok:true}`.
5. Registro responde sin exponer paths internos si falla bootstrap.
6. No se ven keys i18n crudas (`nav.home`).
7. Assets (CSS/JS/imágenes) cargan.
8. `/data/`, `/logs/`, `/.env` devuelven 403 desde el navegador.

## Flujo de despliegue recomendado

1. `git diff --check` y revisión manual.
2. `php -l` sobre archivos modificados.
3. Probar en local con `php -S localhost:8000`.
4. Subir por SFTP (`.vscode/sftp.json`, no commitear).
5. Verificar `.htaccess` no rompió rutas.
6. Probar formulario de contacto en producción.

## Configuración (`.env`)

```env
APP_URL=https://app.indiceapp.com
API_URL=https://app.indiceapp.com/api
EMAIL_FROM=info@indiceapp.com
CONTACT_TO=info@indiceapp.com
```

## Soporte

- contacto@indiceapp.com
- Ver [SECURITY_CLEANUP_REPORT.md](SECURITY_CLEANUP_REPORT.md) para el detalle del último hardening.
