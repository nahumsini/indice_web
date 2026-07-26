; (function () {
	var DEFAULT_LOCALE = 'es-MX';
	var STORAGE_KEY = 'indice.locale';
	var COOKIE_NAME = 'indice_locale';
	var COOKIE_MAX_AGE = 60 * 60 * 24 * 365; // 1 año
	var SUPPORTED_LOCALES = ['es-MX', 'es-CO', 'en-CA', 'fr-CA', 'zh-CA', 'ko-CA', 'pt-BR'];
	var LOCALE_FLAGS = {
		'es-MX': '/imgs/flags/mx.svg',
		'es-CO': '/imgs/flags/co.svg',
		'en-CA': '/imgs/flags/ca.svg',
		'fr-CA': '/imgs/flags/ca.svg',
		'zh-CA': '/imgs/flags/ca.svg',
		'ko-CA': '/imgs/flags/ca.svg',
		'pt-BR': '/imgs/flags/br.svg'
	};
	var LOCALE_ALIASES = {
		'es': 'es-MX',
		'es-mx': 'es-MX',
		'es-co': 'es-CO',
		'en': 'en-CA',
		'en-ca': 'en-CA',
		'en-us': 'en-CA',
		'fr': 'fr-CA',
		'fr-ca': 'fr-CA',
		'pt': 'pt-BR',
		'pt-br': 'pt-BR',
		'zh': 'zh-CA',
		'zh-cn': 'zh-CA',
		'zh-ca': 'zh-CA',
		'ko': 'ko-CA',
		'ko-kr': 'ko-CA',
		'ko-ca': 'ko-CA'
	};
	var cachedTranslations = {};
	var currentLocale = DEFAULT_LOCALE;

	function mapNavigatorLocale(navLocale) {
		if (!navLocale) return null;
		var normalized = String(navLocale).trim().toLowerCase().replace('_', '-');

		if (LOCALE_ALIASES[normalized]) return LOCALE_ALIASES[normalized];
		if (normalized.indexOf('fr-ca') === 0) return 'fr-CA';
		if (normalized.indexOf('en-ca') === 0) return 'en-CA';
		if (normalized.indexOf('en-us') === 0) return 'en-CA';
		if (normalized.indexOf('ko') === 0) return 'ko-CA';
		if (normalized.indexOf('zh') === 0) return 'zh-CA';
		if (normalized.indexOf('es-co') === 0) return 'es-CO';
		if (normalized.indexOf('pt') === 0) return 'pt-BR';
		if (normalized.indexOf('en') === 0) return 'en-CA';
		if (normalized.indexOf('es') === 0) return 'es-MX';
		if (normalized.indexOf('fr') === 0) return 'fr-CA';
		return null;
	}

	function detectLocaleByIp() {
		// El servidor ya resuelve el país por IP (Cloudflare / ipapi) y lo
		// inyecta en <html data-server-locale="...">. Aquí solo lo leemos.
		try {
			var serverLocale = document.documentElement.getAttribute('data-server-locale');
			if (serverLocale) return serverLocale;
		} catch (err) {
			// noop
		}
		return null;
	}

	function setLocaleCookie(locale) {
		try {
			var secure = window.location.protocol === 'https:' ? '; secure' : '';
			document.cookie = COOKIE_NAME + '=' + encodeURIComponent(locale) +
				'; max-age=' + COOKIE_MAX_AGE +
				'; path=/; samesite=Lax' + secure;
		} catch (err) {
			// noop
		}
	}

	function normalizeLocale(locale) {
		if (!locale) return null;
		var clean = String(locale).trim();
		var normalized = clean.toLowerCase().replace('_', '-');
		var exact = SUPPORTED_LOCALES.find(function (item) {
			return item.toLowerCase() === clean.toLowerCase();
		});
		if (exact) return exact;
		if (LOCALE_ALIASES[normalized]) return LOCALE_ALIASES[normalized];
		return mapNavigatorLocale(clean);
	}

	function detectInitialLocale() {
		try {
			var saved = localStorage.getItem(STORAGE_KEY);
			var normalizedSaved = normalizeLocale(saved);
			if (normalizedSaved) return normalizedSaved;
		} catch (err) {
			// noop
		}

		// Locale resuelto por el servidor a partir de la IP (prioridad sobre navigator)
		var ipLocale = normalizeLocale(detectLocaleByIp());
		if (ipLocale) return ipLocale;

		var navigatorLocale = normalizeLocale((navigator.languages && navigator.languages[0]) || navigator.language);
		if (navigatorLocale) return navigatorLocale;

		return DEFAULT_LOCALE;
	}

	function getLangTag(locale) {
		var value = normalizeLocale(locale) || DEFAULT_LOCALE;
		return value.toLowerCase();
	}

	function getTranslation(dict, key) {
		if (!dict || !key) return null;
		if (Object.prototype.hasOwnProperty.call(dict, key)) {
			return dict[key];
		}

		var fallback = cachedTranslations[DEFAULT_LOCALE] || {};
		if (Object.prototype.hasOwnProperty.call(fallback, key)) {
			return fallback[key];
		}

		return null;
	}

	function applyToElements(dict) {
		document.querySelectorAll('[data-i18n]').forEach(function (el) {
			var key = el.getAttribute('data-i18n');
			var value = getTranslation(dict, key);
			if (value !== null && value !== undefined) {
				el.textContent = value;
			}
		});

		document.querySelectorAll('[data-i18n-html]').forEach(function (el) {
			var key = el.getAttribute('data-i18n-html');
			var value = getTranslation(dict, key);
			if (value !== null && value !== undefined) {
				el.innerHTML = value;
			}
		});

		document.querySelectorAll('[data-i18n-placeholder]').forEach(function (el) {
			var key = el.getAttribute('data-i18n-placeholder');
			var value = getTranslation(dict, key);
			if (value !== null && value !== undefined) {
				el.setAttribute('placeholder', value);
			}
		});

		document.querySelectorAll('[data-i18n-aria-label]').forEach(function (el) {
			var key = el.getAttribute('data-i18n-aria-label');
			var value = getTranslation(dict, key);
			if (value !== null && value !== undefined) {
				el.setAttribute('aria-label', value);
			}
		});

		document.querySelectorAll('[data-i18n-title]').forEach(function (el) {
			var key = el.getAttribute('data-i18n-title');
			var value = getTranslation(dict, key);
			if (value !== null && value !== undefined) {
				el.setAttribute('title', value);
			}
		});
	}

	function updateSelector(locale) {
		var select = document.getElementById('localeSelector');
		if (select && select.value !== locale) {
			select.value = locale;
		}

		var flagBadge = document.getElementById('localeFlagBadge');
		if (flagBadge) {
			flagBadge.setAttribute('src', LOCALE_FLAGS[locale] || '/imgs/flags/default.svg');
		}
	}

	function fetchLocale(locale) {
		if (cachedTranslations[locale]) {
			return Promise.resolve(cachedTranslations[locale]);
		}

		return fetch('/i18n/' + locale + '.json', { cache: 'no-store' })
			.then(function (res) {
				if (!res.ok) {
					throw new Error('Locale not found: ' + locale);
				}
				return res.json();
			})
			.then(function (json) {
				cachedTranslations[locale] = json;
				return json;
			});
	}

	function setLocale(locale) {
		var normalizedLocale = normalizeLocale(locale) || DEFAULT_LOCALE;

		return fetchLocale(DEFAULT_LOCALE)
			.catch(function () {
				cachedTranslations[DEFAULT_LOCALE] = {};
				return {};
			})
			.then(function () {
				return fetchLocale(normalizedLocale).catch(function () {
					return cachedTranslations[DEFAULT_LOCALE] || {};
				});
			})
			.then(function (dict) {
				currentLocale = normalizedLocale;
				applyToElements(dict || {});
				updateSelector(currentLocale);

				document.documentElement.setAttribute('lang', getLangTag(currentLocale));
				document.documentElement.setAttribute('data-locale', currentLocale);

				try {
					localStorage.setItem(STORAGE_KEY, currentLocale);
				} catch (err) {
					// noop
				}

				setLocaleCookie(currentLocale);

				return currentLocale;
			});
	}

	function initSelector() {
		var select = document.getElementById('localeSelector');
		if (!select) return;

		select.addEventListener('change', function (event) {
			setLocale(event.target.value);
		});
	}

	function init() {
		initSelector();
		setLocale(detectInitialLocale());
	}

	window.IndiceI18n = {
		init: init,
		setLocale: setLocale,
		getLocale: function () {
			return currentLocale;
		},
		detectInitialLocale: detectInitialLocale,
		supportedLocales: SUPPORTED_LOCALES.slice()
	};

	document.addEventListener('DOMContentLoaded', init);
})();
