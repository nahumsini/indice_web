document.addEventListener('DOMContentLoaded', function () {
    function getCsrfToken() {
        var meta = document.querySelector('meta[name="csrf-token"]');
        return meta ? meta.getAttribute('content') || '' : '';
    }

    function getFormCopy(scopeEl, key, fallback) {
        if (!scopeEl) return fallback;
        var source = scopeEl.querySelector('[data-form-copy="' + key + '"]');
        if (!source) return fallback;
        var value = (source.textContent || '').trim();
        return value || fallback;
    }

    function isValidEmail(value) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(String(value || '').trim());
    }

    var revealEls = document.querySelectorAll('.reveal');

    if ('IntersectionObserver' in window) {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });

        revealEls.forEach(function (el) { io.observe(el); });
    } else {
        revealEls.forEach(function (el) { el.classList.add('in'); });
    }

    var contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', async function (e) {
            e.preventDefault();

            var status = document.getElementById('contactStatus');
            if (status) {
                status.textContent = 'Enviando...';
                status.className = 'small text-muted';
            }

            var payload = {
                nombre: (document.getElementById('nombre') || {}).value || '',
                email: (document.getElementById('email') || {}).value || '',
                pais: (document.getElementById('pais') || {}).value || '',
                mensaje: (document.getElementById('mensaje') || {}).value || '',
                csrf_token: getCsrfToken(),
                company_website: (contactForm.querySelector('[name="company_website"]') || {}).value || ''
            };

            try {
                var res = await fetch('/api/contact.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });

                var json = {};
                try {
                    json = await res.json();
                } catch (parseError) {
                    json = { ok: false, error: 'Respuesta invalida del servidor' };
                }

                if (!res.ok || !json.ok) {
                    throw new Error(json.error || 'No se pudo enviar el mensaje');
                }

                if (status) {
                    status.textContent = 'Mensaje enviado correctamente. Te contactaremos pronto.';
                    status.className = 'small text-success';
                }
                contactForm.reset();
            } catch (err) {
                if (status) {
                    status.textContent = err.message || 'Error al enviar el mensaje.';
                    status.className = 'small text-danger';
                }
            }
        });
    }

    // Captura minima de registros para CTAs o formularios futuros.
    var registrationForms = document.querySelectorAll('[data-registration-form]');
    registrationForms.forEach(function (formEl) {
        formEl.addEventListener('submit', async function (e) {
            e.preventDefault();

            var statusEl = formEl.querySelector('[data-registration-status]');
            if (statusEl) {
                statusEl.textContent = getFormCopy(formEl, 'sending', 'Enviando...');
                statusEl.className = 'small text-muted mb-0';
            }

            var formData = new FormData(formEl);
            var payload = {
                nombre: formData.get('nombre') || '',
                email: formData.get('email') || '',
                pais: formData.get('pais') || '',
                empresa: formData.get('empresa') || '',
                csrf_token: formData.get('csrf_token') || getCsrfToken(),
                company_website: formData.get('company_website') || ''
            };

            if (!payload.email) {
                if (statusEl) {
                    statusEl.textContent = getFormCopy(formEl, 'invalid', 'Ingresa un correo electronico valido para continuar.');
                    statusEl.className = 'small text-danger mb-0';
                }
                return;
            }

            if (payload.email && !isValidEmail(payload.email)) {
                if (statusEl) {
                    statusEl.textContent = getFormCopy(formEl, 'invalid', 'Ingresa un correo electronico valido para continuar.');
                    statusEl.className = 'small text-danger mb-0';
                }
                return;
            }

            try {
                var response = await fetch('/api/capture_registration.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });

                var parsed = {};
                try {
                    parsed = await response.json();
                } catch (parseError) {
                    parsed = { success: false, message: 'Respuesta invalida del servidor' };
                }

                if (!response.ok || !parsed.success) {
                    throw new Error(parsed.message || 'No fue posible registrar tus datos.');
                }

                if (statusEl) {
                    statusEl.textContent = getFormCopy(formEl, 'success', 'Listo. Recibimos tus datos y te contactaremos pronto.');
                    statusEl.className = 'small text-success mb-0';
                }
                formEl.reset();
            } catch (error) {
                if (statusEl) {
                    statusEl.textContent = error.message || getFormCopy(formEl, 'error', 'No fue posible enviar el formulario.');
                    statusEl.className = 'small text-danger mb-0';
                }
            }
        });
    });
});
