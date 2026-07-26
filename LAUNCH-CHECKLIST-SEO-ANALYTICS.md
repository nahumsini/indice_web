# Checklist de Lanzamiento: SEO + Analytics + QA

Fecha: 2026-04-26

## 1) SEO tecnico

- [ ] Verificar que cada pagina principal tenga `title` y `meta description` unicos.
- [ ] Confirmar que solo exista un `h1` por pagina.
- [ ] Revisar enlaces internos rotos en:
	- `index.php`
	- `modulos.php`
	- `metodologia.php`
	- `planes.php`
	- `nosotros.php`
	- `contacto.php`
- [ ] Confirmar que `robots.txt` permita indexar las paginas publicas.
- [ ] Validar `sitemap.xml` y enviar en Google Search Console y Bing Webmaster.
- [ ] Revisar canibalizacion de idioma (usar `lang` correcto en `<html>` segun locale).

## 2) SEO de contenido

- [ ] Alinear copys de CTA por mercado: MX, CO, CA, US, BR.
- [ ] Incluir keywords comerciales en hero y secciones de valor:
	- ERP para pymes
	- control de procesos
	- control financiero empresarial
	- software de gestion para pequenas empresas
- [ ] Asegurar que los textos traducidos mantengan intencion comercial y no solo traduccion literal.

## 3) Analitica y eventos

- [ ] Configurar GA4 con propiedad de produccion.
- [ ] Registrar eventos clave:
	- `cta_click_primary`
	- `cta_click_secondary`
	- `lead_form_submit_success`
	- `lead_form_submit_error`
	- `locale_change`
- [ ] Crear conversion principal en GA4: `lead_form_submit_success`.
- [ ] Conectar Search Console y validar dominio.
- [ ] Revisar consentimiento de cookies segun pais objetivo.

## 4) QA funcional

- [ ] Probar envio de `contactForm` en `contacto.php`.
- [ ] Probar envio de formulario `data-registration-form` en `index.php`.
- [ ] Validar respuesta 200 de:
	- `/api/contact.php`
	- `/api/capture_registration.php`
- [ ] Confirmar escritura en logs:
	- `logs/contact.log`
	- `logs/registrations.log`

## 5) QA responsive

- [ ] Revisar Home en 360px, 390px, 768px, 1024px y 1440px.
- [ ] Verificar que botones principales no rompan layout en mobile.
- [ ] Confirmar legibilidad de tarjetas KPI y formularios en pantallas chicas.
- [ ] Confirmar que selector de idioma sea usable en mobile.

## 6) Performance basica

- [ ] Comprimir imagenes de `imgs/` que superen 200 KB.
- [ ] Definir dimensiones de imagen para evitar CLS.
- [ ] Revisar Lighthouse (mobile):
	- Performance >= 80
	- SEO >= 90
	- Accessibility >= 90

## 7) Seguridad minima

- [ ] Confirmar sanitizacion y validacion de email en APIs publicas.
- [ ] Confirmar que logs no expongan secretos ni headers sensibles.
- [ ] Revisar que no se publiquen archivos temporales o de debug en produccion.

## 8) Go-live

- [ ] Hacer backup previo a despliegue.
- [ ] Publicar cambios en ventana de bajo trafico.
- [ ] Monitorear 24h:
	- errores servidor
	- conversion de formularios
	- indexacion en Search Console

