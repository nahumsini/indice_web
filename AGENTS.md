# Índice Web — Agent Instructions

Sitio web corporativo de [Índice](https://indiceapp.com), plataforma de gestión empresarial para PyMEs. PHP sin framework, Bootstrap 5, vanilla JS. Sin sistema de build. Deployment vía FTP.

## Architecture

Every page follows this exact include pattern:
```php
<?php
$page_title = "...";
$page_description = "...";
include 'header.php'; // navbar, meta tags, Bootstrap CSS
?>
<!-- page content -->
<?php include 'footer.php'; ?>
```

- [header.php](header.php) — navbar with locale selector, SEO meta, CSS links
- [footer.php](footer.php) — CTA, social links, copyright
- [functions.php](functions.php) — `sanitizeInput()`, `loadEnv()`, `sendEmail()`

## Key Files

| File | Purpose |
|------|---------|
| [index.php](index.php) | Home tipográfico con mensaje principal personalizado por país |
| [modulos.php](modulos.php) | Modules page, data from [js/modulos-data.json](js/modulos-data.json) |
| [planes.php](planes.php) | Current pricing page (3 tiers: Control/Escala/Corporativo) |
| [registro.php](registro.php) | Multi-step registration — connects to production DB + Stripe |
| [api/contact.php](api/contact.php) | POST `{nombre,email,pais,mensaje}` → logs to `/logs/contact.log` |
| [api/capture_registration.php](api/capture_registration.php) | POST `{nombre,email,pais,empresa,telefono}` → logs to `/logs/` |

## i18n System

- Translation files: [i18n/](i18n/) (`es-MX` default, also `es-CO`, `en-CA`, `fr-CA`, `pt-BR`, `zh-CN`, `ko-KR`)
- Engine: [js/i18n.js](js/i18n.js) — detection order: localStorage → navigator.languages → IP geolocation
- HTML attributes: `data-i18n="key"` (text), `data-i18n-html="key"` (innerHTML), `data-i18n-placeholder`, `data-i18n-aria-label`, `data-i18n-title`
- When adding user-visible text, always add a key to **all** locale JSON files

## CSS Conventions

- **Bootstrap 5.3.3** via CDN (no local copy)
- Brand tokens in [css/brand.css](css/brand.css): `--indice-navy`, `--indice-blue-mid`, `--indice-yellow`, `--module-people`, `--module-products`, etc.
- Custom components in [css/style.css](css/style.css): `--primary-blue: #1a3c6e`, `.plan-card-v2`, `.module-card-modern`, `.navbar-custom`, `.btn-brand`
- Pillar module colors: People=`#4f83b8`, Process=`#f59e0b`, Products=`#f97316`, Finance=`#10b981`, AI=`#f59e0b`

## JavaScript Patterns

- Vanilla JS (ES6+), no framework
- Scroll animations: add `.reveal` class → [js/main.js](js/main.js) uses IntersectionObserver
- Async API calls: `fetch` with `async/await`, JSON response parsing
- Module data rendering: [js/modulos.js](js/modulos.js) reads [js/modulos-data.json](js/modulos-data.json)
- Error/success status: use `#contactStatus` or `[data-registration-status]` elements

## PHP Conventions

- Input sanitization: always use `sanitizeInput()` from [functions.php](functions.php) (`htmlspecialchars(trim(), ENT_QUOTES, 'UTF-8')`)
- Email validation: `filter_var($email, FILTER_VALIDATE_EMAIL)`
- Environment variables: `loadEnv()` reads `.env`; never hardcode credentials
- API responses: JSON only — `{ok: bool, error?: string}` for contact, `{success: bool, message?: string}` for registration

## Security

- Never echo raw user input — always run through `sanitizeInput()`
- [registro.php](registro.php) is production-connected (real DB, Stripe) — test carefully
- `/data/registrations/` and `/logs/` must not be web-accessible (check `.htaccess`)
- No `.env` in version control

## Deployment

- No build step needed — PHP files are served directly
- Deploy via SFTP using `.vscode/sftp.json` config (not committed)
- [robots.txt](robots.txt) and [sitemap.xml](sitemap.xml) are static files — update when adding pages
