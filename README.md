# Índice — Sitio Web Corporativo

Sitio oficial de [Índice](https://indiceapp.com), plataforma de gestión empresarial para PyMEs.

## Flujo comercial vigente — 2026-10-04

La web conserva el diseño de portada y metodología, pero ahora ofrece un único siguiente paso:
**solicitar un diagnóstico empresarial inicial sin costo** en `diagnostico.php`. La landing
también funciona como destino directo de campañas de redes; conserva UTM y el plan de interés
para la bandeja del Administrador de Plataforma. `contacto.php` redirige a esa landing;
`planes.php` publica los tres planes mexicanos confirmados y todos sus CTA llegan al mismo
diagnóstico. No hay
contratación ni prueba inmediata desde la web. Un consultor contacta al prospecto; la prueba
guiada de agentes de 15 días se considera solamente después de completar el diagnóstico.

`api/contact.php` valida CSRF, honeypot, consentimiento, campos y límite de 5 envíos por IP en
10 minutos. Envía una solicitud firmada por HMAC a
`/api/v1/public/platform-leads` del backend de Índice. No guarda datos personales en logs
locales ni responde éxito si el backend no confirma la recepción. Requiere
`INDICE_LEAD_INGEST_SECRET` en el `.env` privado de este host, igual al valor de
`APP_PLATFORM_LEAD_INGEST_SECRET` del backend (32 caracteres aleatorios como mínimo). El
directorio privado `data/rate_limit/` debe ser escribible por PHP; de lo contrario la recepción
falla cerrada.

Los precios públicos aprobados están en `content/public-plans-mx.json`: Controla $2,999,
Escala $5,499 y Corporativo $9,499 MXN al mes, con anualidades, módulos y puesta en marcha
separada. La promoción de implementación se oculta después de octubre de 2026. No se
sincronizan automáticamente al catálogo USD ni a Stripe. `content/commercial-offer.json`
permanece como referencia histórica del estimador anterior, no como fuente de la página actual.

Desplegar primero backend y las migraciones de leads de la versión aprobada, luego configurar ambos secretos y finalmente
publicar esta web. Verificar en staging un envío sintético y su aparición única en la bandeja;
no enviar leads reales de prueba sin consentimiento. El rollback web restaura la versión
anterior; la migración conserva los prospectos existentes. Ver el contrato
`Indice_base_SAAS/docs/platform-lead-diagnosis-flow-v1.md`.

La sección siguiente documenta la implementación anterior del 2026-09-21 y no define el CTA
comercial vigente.

## Actualización comercial y visual — 2026-09-21

La web utiliza la identidad azul del ERP y presenta el posicionamiento de ERP personalizado
con Lupita y cuatro especialistas. El recorrido comercial vigente está documentado en
`Indice_base_SAAS/docs/platform-lead-diagnosis-flow-v1.md`.

- `index.php` carga `index-v2.php`; `planes-v2.php` redirige a la página pública actual.
- `css/marketing.css` organiza las nuevas superficies; `css/brand.css` conserva los colores de
  módulos y usa azul para acciones de producto.
- `content/marketing.php` reutiliza los diccionarios y la detección de idioma existentes.
- `content/commercial-offer.json` contiene la referencia de la nueva propuesta comercial en
  centavos. `js/commercial-estimate.js` calcula estimaciones, nunca cargos ni derechos de acceso.
- Los llamados comerciales vigentes llevan a `diagnostico.php`. La conversación de portada
  sigue siendo un ejemplo ilustrativo.
- La página `/plans` del SaaS conserva su catálogo publicado y su flujo de registro. Sólo se
  alineó su identidad azul en esta tarea. No dirigir la nueva oferta a su checkout hasta adaptar
  y verificar el contrato de billing; no sincronizar estos importes automáticamente a Stripe.
- La estimación deja de mostrar la promoción cuando el mes UTC supera octubre de 2026. Es una
  regla de presentación, no un mecanismo de reserva o cobro: elegibilidad y condiciones se
  confirman en la propuesta. Más de 50 personas requiere cotización de alta.
- No se añaden rutas: se conservan URLs de páginas y módulos. No se modificaron secretos,
  integraciones de pago, condiciones legales ni APIs.

Validaciones del cambio: PHP lint, pruebas del estimador (`node --test tests/commercial-estimate.test.cjs`),
comprobación HTTP de páginas/enlaces y claves de traducción. La vista previa local deshabilita
los envíos de formularios. La revisión visual en navegador y la entrega real de contactos
requieren verificación adicional; no se enviaron mensajes de prueba.

Las descripciones anteriores del catálogo en la documentación restante deben interpretarse
como contexto previo; la nueva oferta se rige por la referencia comercial indicada arriba.


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
├── planes.php              # precios públicos MXN; CTA al diagnóstico
├── diagnostico.php         # único formulario público de prospectos
├── modulos.php             # módulos (datos en js/modulos-data.json)
├── metodologia.php
├── nosotros.php
├── contacto.php            # redirección a diagnostico.php
├── registro.php            # ⚠ acoplado a app.indiceapp.com (DB + Stripe)
├── api/
│   ├── contact.php         # POST JSON, CSRF, rate limit, HMAC hacia app
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

- 10 locales soportados: `es-MX` (default), `es-CO`, `en-CA`, `en-US`, `fr-CA`, `pt-BR`, `zh-CA`, `zh-CN`, `ko-CA`, `ko-KR`.
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
php -l diagnostico.php
php -l registro.php
php -l api/contact.php
php -l api/capture_registration.php

# Whitespace y conflictos
git diff --check
```

Manual:

1. Home carga.
2. Navbar y selector de idioma funcionan.
3. `planes.php` muestra los tres precios e inclusiones; `contacto.php` redirige a `diagnostico.php`.
4. El formulario crea un único prospecto en Administrador de Plataforma y recibe `{ok:true}`.
5. Registro responde sin exponer paths internos si falla bootstrap.
6. No se ven keys i18n crudas (`nav.home`).
7. Assets (CSS/JS/imágenes) cargan.
8. `/data/`, `/logs/`, `/.env` devuelven 403 desde el navegador.

Contrato de precios publicados: `node --test tests/public-plans.test.cjs`.

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


## Portada comercial y agentes

La portada presenta el ERP personalizado y los agentes de IA. Recorre nueve módulos (sin Panel) con fotografías ilustrativas y un chat continuo translúcido. `js/module-hero.js` sincroniza imagen, conversación, etiqueta y enlace cada **5 segundos**. El botón de cada módulo aparece con los dos CTA principales, usa su familia de color y describe sus funciones. Los ejemplos usan personas y cifras ficticias en MXN; no realizan llamadas a agentes.

- Vista: `index-v2.php`, `content/hero-slider.php` y `css/hero-slider.css`.
- Activos: `imgs/hero-module-*-v1.jpg`; prompts en `docs/hero-module-images.md`.
- Textos: claves `brand26.*` de los diez diccionarios.
- Planes: `content/commercial-offer.json` y `js/commercial-estimate.js` calculan una estimación comercial; no cambian los precios de Stripe ni el registro.
- Los anteriores `js/hero-slider.js` y `js/hero-chat.js` se conservan como versiones previas y no se cargan en el home.

La navegación manual, el uso del historial y el enfoque del botón de módulo pausan el recorrido. Se suspende con la pestaña oculta o fuera de pantalla; con movimiento reducido inicia estático. Sin JavaScript se muestra RH. Se conservan hasta nueve intercambios en el historial.

### Validación

`node --test tests/*.test.cjs` valida la estimación comercial y las secuencias. Validar también PHP, JSON, sintaxis JS, enlaces y recursos locales. La versión móvil se comprobó en Chrome con anchos de 320, 360, 390 y 430 px; tablet/escritorio en 768, 1024 y 1440 px. Sin desbordamiento horizontal; menú móvil, nueve enlaces e historial revisados. En móvil, los CTA ocupan el ancho disponible y los controles tienen áreas táctiles de al menos 44 px.

### Alcance de publicación

Publicar los archivos web y recursos versionados mediante el servidor configurado, con copia previa de los archivos reemplazados. No transferir `.env`, `.vscode`, `.git`, registros privados ni configuración local. Esta publicación no despliega el ERP ni modifica cobros.
