<?php
require_once dirname(__DIR__) . '/functions.php';

function basicModuleConfigs(): array {
	return [
		'panel-inicial' => [
			'href' => '/modulo-panel-inicial.php',
			'theme' => 'panel',
			'icon' => 'fa-gauge-high',
			'title_key' => 'modules.core.panel.title',
			'tagline_key' => 'modules.core.panel.tagline',
			'desc_key' => 'modules.core.panel.desc',
			'features' => [
				['icon' => 'fa-sitemap', 'label_key' => 'modules.core.panel.feature_1'],
				['icon' => 'fa-chart-column', 'label_key' => 'modules.core.panel.feature_2'],
				['icon' => 'fa-clipboard-list', 'label_key' => 'modules.core.panel.feature_3'],
			],
			'stats' => ['4', '12', '100%', '1'],
		],
		'procesos-tareas' => [
			'href' => '/modulo-procesos-tareas.php',
			'theme' => 'procesos',
			'icon' => 'fa-list-check',
			'title_key' => 'modules.core.process.title',
			'tagline_key' => 'modules.core.process.tagline',
			'desc_key' => 'modules.core.process.desc',
			'features' => [
				['icon' => 'fa-bullseye', 'label_key' => 'modules.core.process.feature_1'],
				['icon' => 'fa-user-check', 'label_key' => 'modules.core.process.feature_2'],
				['icon' => 'fa-chart-simple', 'label_key' => 'modules.core.process.feature_3'],
			],
			'stats' => ['18', '6', '92%', '4'],
		],
		'punto-de-venta' => [
			'href' => '/modulo-punto-de-venta.php',
			'theme' => 'productos',
			'icon' => 'fa-cash-register',
			'title_key' => 'modules.core.pos.title',
			'tagline_key' => 'modules.core.pos.tagline',
			'desc_key' => 'modules.core.pos.desc',
			'features' => [
				['icon' => 'fa-bag-shopping', 'label_key' => 'modules.core.pos.feature_1'],
				['icon' => 'fa-boxes-stacked', 'label_key' => 'modules.core.pos.feature_2'],
				['icon' => 'fa-sack-dollar', 'label_key' => 'modules.core.pos.feature_3'],
			],
			'stats' => ['126', '$24K', '3', '98%'],
		],
		'ventas' => [
			'href' => '/modulo-ventas.php',
			'theme' => 'productos',
			'icon' => 'fa-handshake',
			'title_key' => 'modules.core.sales.title',
			'tagline_key' => 'modules.core.sales.tagline',
			'desc_key' => 'modules.core.sales.desc',
			'features' => [
				['icon' => 'fa-bullseye', 'label_key' => 'modules.core.sales.feature_1'],
				['icon' => 'fa-file-invoice-dollar', 'label_key' => 'modules.core.sales.feature_2'],
				['icon' => 'fa-arrow-right', 'label_key' => 'modules.core.sales.feature_3'],
			],
			'stats' => ['14', '7', '5', '82%'],
		],
		'gastos' => [
			'href' => '/modulo-gastos.php',
			'theme' => 'finanzas',
			'icon' => 'fa-receipt',
			'title_key' => 'modules.core.expenses.title',
			'tagline_key' => 'modules.core.expenses.tagline',
			'desc_key' => 'modules.core.expenses.desc',
			'features' => [
				['icon' => 'fa-money-bill-wave', 'label_key' => 'modules.core.expenses.feature_1'],
				['icon' => 'fa-clipboard-list', 'label_key' => 'modules.core.expenses.feature_2'],
				['icon' => 'fa-truck-field', 'label_key' => 'modules.core.expenses.feature_3'],
			],
			'stats' => ['32', '5', '$8K', '100%'],
		],
		'caja-chica' => [
			'href' => '/modulo-caja-chica.php',
			'theme' => 'finanzas',
			'icon' => 'fa-wallet',
			'title_key' => 'modules.core.cash.title',
			'tagline_key' => 'modules.core.cash.tagline',
			'desc_key' => 'modules.core.cash.desc',
			'features' => [
				['icon' => 'fa-money-bill', 'label_key' => 'modules.core.cash.feature_1'],
				['icon' => 'fa-clipboard-check', 'label_key' => 'modules.core.cash.feature_2'],
				['icon' => 'fa-scale-balanced', 'label_key' => 'modules.core.cash.feature_3'],
			],
			'stats' => ['4', '$12K', '2', '1'],
		],
		'kpis' => [
			'href' => '/modulo-kpis.php',
			'theme' => 'dashboard',
			'icon' => 'fa-chart-line',
			'title_key' => 'modules.core.kpis.title',
			'tagline_key' => 'modules.core.kpis.tagline',
			'desc_key' => 'modules.core.kpis.desc',
			'features' => [
				['icon' => 'fa-chart-simple', 'label_key' => 'modules.core.kpis.feature_1'],
				['icon' => 'fa-file-lines', 'label_key' => 'modules.core.kpis.feature_2'],
				['icon' => 'fa-bell', 'label_key' => 'modules.core.kpis.feature_3'],
			],
			'stats' => ['18', '6', '4', '100%'],
		],
		'mantenimiento' => [
			'href' => '/modulo-mantenimiento.php',
			'theme' => 'complementarios',
			'icon' => 'fa-screwdriver-wrench',
			'title_key' => 'modules.scale.maintenance.title',
			'tagline_key' => 'modules.scale.maintenance.tagline',
			'desc_key' => 'modules.scale.maintenance.desc',
			'features' => [
				['icon' => 'fa-calendar-check', 'label_key' => 'modules.scale.maintenance.feature_1'],
				['icon' => 'fa-screwdriver-wrench', 'label_key' => 'modules.scale.maintenance.feature_2'],
				['icon' => 'fa-triangle-exclamation', 'label_key' => 'modules.scale.maintenance.feature_3'],
			],
			'stats' => ['14', '5', '92%', '3'],
		],
		'inventarios' => [
			'href' => '/modulo-inventarios.php',
			'theme' => 'productos',
			'icon' => 'fa-box',
			'title_key' => 'modules.core.inventory.title',
			'tagline_key' => 'modules.core.inventory.tagline',
			'desc_key' => 'modules.core.inventory.desc',
			'features' => [
				['icon' => 'fa-box-open', 'label_key' => 'modules.core.inventory.feature_1'],
				['icon' => 'fa-warehouse', 'label_key' => 'modules.core.inventory.feature_2'],
				['icon' => 'fa-cart-flatbed', 'label_key' => 'modules.core.inventory.feature_3'],
			],
			'stats' => ['248', '12', '6', '99%'],
		],
		'cartera' => [
			'href' => '/modulo-cartera.php',
			'theme' => 'finanzas',
			'icon' => 'fa-book',
			'title_key' => 'modules.core.receivables.title',
			'tagline_key' => 'modules.core.receivables.tagline',
			'desc_key' => 'modules.core.receivables.desc',
			'features' => [
				['icon' => 'fa-credit-card', 'label_key' => 'modules.core.receivables.feature_1'],
				['icon' => 'fa-calendar-day', 'label_key' => 'modules.core.receivables.feature_2'],
				['icon' => 'fa-money-check-dollar', 'label_key' => 'modules.core.receivables.feature_3'],
			],
			'stats' => ['18', '$42K', '5', '94%'],
		],
		'control-minutas' => [
			'href' => '/modulo-control-minutas.php',
			'theme' => 'complementarios',
			'icon' => 'fa-file-lines',
			'title_key' => 'modules.scale.minutes.title',
			'tagline_key' => 'modules.scale.minutes.tagline',
			'desc_key' => 'modules.scale.minutes.desc',
			'features' => [
				['icon' => 'fa-pen-to-square', 'label_key' => 'modules.scale.minutes.feature_1'],
				['icon' => 'fa-user-check', 'label_key' => 'modules.scale.minutes.feature_2'],
				['icon' => 'fa-list-check', 'label_key' => 'modules.scale.minutes.feature_3'],
			],
			'stats' => ['9', '18', '4', '100%'],
		],
		'limpieza' => [
			'href' => '/modulo-limpieza.php',
			'theme' => 'complementarios',
			'icon' => 'fa-broom',
			'title_key' => 'modules.scale.cleaning.title',
			'tagline_key' => 'modules.scale.cleaning.tagline',
			'desc_key' => 'modules.scale.cleaning.desc',
			'features' => [
				['icon' => 'fa-broom', 'label_key' => 'modules.scale.cleaning.feature_1'],
				['icon' => 'fa-clipboard-check', 'label_key' => 'modules.scale.cleaning.feature_2'],
				['icon' => 'fa-camera', 'label_key' => 'modules.scale.cleaning.feature_3'],
			],
			'stats' => ['22', '7', '95%', '2'],
		],
		'lavanderia' => [
			'href' => '/modulo-lavanderia.php',
			'theme' => 'complementarios',
			'icon' => 'fa-shirt',
			'title_key' => 'modules.scale.laundry.title',
			'tagline_key' => 'modules.scale.laundry.tagline',
			'desc_key' => 'modules.scale.laundry.desc',
			'features' => [
				['icon' => 'fa-shirt', 'label_key' => 'modules.scale.laundry.feature_1'],
				['icon' => 'fa-tags', 'label_key' => 'modules.scale.laundry.feature_2'],
				['icon' => 'fa-truck-ramp-box', 'label_key' => 'modules.scale.laundry.feature_3'],
			],
			'stats' => ['86', '11', '4', '97%'],
		],
		'transportacion' => [
			'href' => '/modulo-transportacion.php',
			'theme' => 'complementarios',
			'icon' => 'fa-truck',
			'title_key' => 'modules.scale.transport.title',
			'tagline_key' => 'modules.scale.transport.tagline',
			'desc_key' => 'modules.scale.transport.desc',
			'features' => [
				['icon' => 'fa-route', 'label_key' => 'modules.scale.transport.feature_1'],
				['icon' => 'fa-user-clock', 'label_key' => 'modules.scale.transport.feature_2'],
				['icon' => 'fa-location-dot', 'label_key' => 'modules.scale.transport.feature_3'],
			],
			'stats' => ['12', '34', '6', '94%'],
		],
		'vehiculos-maquinaria' => [
			'href' => '/modulo-vehiculos-maquinaria.php',
			'theme' => 'complementarios',
			'icon' => 'fa-car',
			'title_key' => 'modules.scale.vehicles.title',
			'tagline_key' => 'modules.scale.vehicles.tagline',
			'desc_key' => 'modules.scale.vehicles.desc',
			'features' => [
				['icon' => 'fa-car', 'label_key' => 'modules.scale.vehicles.feature_1'],
				['icon' => 'fa-screwdriver-wrench', 'label_key' => 'modules.scale.vehicles.feature_2'],
				['icon' => 'fa-gauge-high', 'label_key' => 'modules.scale.vehicles.feature_3'],
			],
			'stats' => ['18', '5', '2', '91%'],
		],
		'inmuebles' => [
			'href' => '/modulo-inmuebles.php',
			'theme' => 'complementarios',
			'icon' => 'fa-building',
			'title_key' => 'modules.scale.properties.title',
			'tagline_key' => 'modules.scale.properties.tagline',
			'desc_key' => 'modules.scale.properties.desc',
			'features' => [
				['icon' => 'fa-building', 'label_key' => 'modules.scale.properties.feature_1'],
				['icon' => 'fa-key', 'label_key' => 'modules.scale.properties.feature_2'],
				['icon' => 'fa-screwdriver-wrench', 'label_key' => 'modules.scale.properties.feature_3'],
			],
			'stats' => ['6', '14', '3', '100%'],
		],
		'formularios' => [
			'href' => '/modulo-formularios.php',
			'theme' => 'complementarios',
			'icon' => 'fa-clipboard',
			'title_key' => 'modules.scale.forms.title',
			'tagline_key' => 'modules.scale.forms.tagline',
			'desc_key' => 'modules.scale.forms.desc',
			'features' => [
				['icon' => 'fa-clipboard-list', 'label_key' => 'modules.scale.forms.feature_1'],
				['icon' => 'fa-pen-to-square', 'label_key' => 'modules.scale.forms.feature_2'],
				['icon' => 'fa-file-export', 'label_key' => 'modules.scale.forms.feature_3'],
			],
			'stats' => ['24', '9', '3', '100%'],
		],
		'facturacion' => [
			'href' => '/modulo-facturacion.php',
			'theme' => 'complementarios',
			'icon' => 'fa-receipt',
			'title_key' => 'modules.scale.billing.title',
			'tagline_key' => 'modules.scale.billing.tagline',
			'desc_key' => 'modules.scale.billing.desc',
			'features' => [
				['icon' => 'fa-file-invoice-dollar', 'label_key' => 'modules.scale.billing.feature_1'],
				['icon' => 'fa-credit-card', 'label_key' => 'modules.scale.billing.feature_2'],
				['icon' => 'fa-clock-rotate-left', 'label_key' => 'modules.scale.billing.feature_3'],
			],
			'stats' => ['$18K', '7', '3', '98%'],
		],
		'correo-electronico' => [
			'href' => '/modulo-correo-electronico.php',
			'theme' => 'complementarios',
			'icon' => 'fa-envelope',
			'title_key' => 'modules.scale.email.title',
			'tagline_key' => 'modules.scale.email.tagline',
			'desc_key' => 'modules.scale.email.desc',
			'features' => [
				['icon' => 'fa-envelope-open-text', 'label_key' => 'modules.scale.email.feature_1'],
				['icon' => 'fa-users', 'label_key' => 'modules.scale.email.feature_2'],
				['icon' => 'fa-clock', 'label_key' => 'modules.scale.email.feature_3'],
			],
			'stats' => ['42', '8', '5', '100%'],
		],
		'clima-laboral' => [
			'href' => '/modulo-clima-laboral.php',
			'theme' => 'complementarios',
			'icon' => 'fa-face-smile',
			'title_key' => 'modules.scale.climate.title',
			'tagline_key' => 'modules.scale.climate.tagline',
			'desc_key' => 'modules.scale.climate.desc',
			'features' => [
				['icon' => 'fa-face-smile', 'label_key' => 'modules.scale.climate.feature_1'],
				['icon' => 'fa-chart-simple', 'label_key' => 'modules.scale.climate.feature_2'],
				['icon' => 'fa-comments', 'label_key' => 'modules.scale.climate.feature_3'],
			],
			'stats' => ['82%', '5', '11', '3'],
		],
		'afiliados' => [
			'href' => '/modulo-afiliados.php',
			'theme' => 'complementarios',
			'icon' => 'fa-handshake',
			'title_key' => 'modules.scale.affiliates.title',
			'tagline_key' => 'modules.scale.affiliates.tagline',
			'desc_key' => 'modules.scale.affiliates.desc',
			'features' => [
				['icon' => 'fa-handshake', 'label_key' => 'modules.scale.affiliates.feature_1'],
				['icon' => 'fa-percent', 'label_key' => 'modules.scale.affiliates.feature_2'],
				['icon' => 'fa-chart-line', 'label_key' => 'modules.scale.affiliates.feature_3'],
			],
			'stats' => ['16', '9', '$4K', '100%'],
		],
	];
}

function basicModuleConfig(string $slug): ?array {
	$configs = basicModuleConfigs();
	return $configs[$slug] ?? null;
}

function basicModuleLocaleMessages(): array {
	static $messages = null;
	if ($messages !== null) {
		return $messages;
	}

	$ctx = resolveSiteContext();
	$locale = $ctx['locale'] ?? 'es-MX';
	$messages = basicModuleLoadLocale('es-MX');
	if ($locale !== 'es-MX') {
		$messages = array_merge($messages, basicModuleLoadLocale($locale));
	}
	return $messages;
}

function basicModuleLoadLocale(string $locale): array {
	$filePath = dirname(__DIR__) . '/i18n/' . $locale . '.json';
	if (!is_file($filePath)) {
		return [];
	}

	$decoded = json_decode((string)file_get_contents($filePath), true);
	return is_array($decoded) ? $decoded : [];
}

function basicModuleText(string $key, array $vars = [], string $fallback = ''): string {
	$messages = basicModuleLocaleMessages();
	$value = (string)($messages[$key] ?? $fallback);
	foreach ($vars as $name => $replacement) {
		$value = str_replace('{' . $name . '}', (string)$replacement, $value);
	}
	return $value;
}

function basicModuleAttr(string $key, array $vars = [], string $fallback = ''): string {
	return htmlspecialchars(basicModuleText($key, $vars, $fallback), ENT_QUOTES, 'UTF-8');
}

function basicModuleValue(array $module, string $field): string {
	return basicModuleText($module[$field . '_key'] ?? '', [], '');
}

function basicModuleFeatureValue(array $module, int $index): string {
	return basicModuleText($module['features'][$index]['label_key'] ?? '', [], '');
}

function basicModulePageTitle(array $module): string {
	return basicModuleText('module.basic.meta.title_template', [
		'module' => basicModuleValue($module, 'title'),
	], basicModuleValue($module, 'title'));
}

function basicModulePageDescription(array $module): string {
	return basicModuleText('module.basic.meta.description_template', [
		'module' => basicModuleValue($module, 'title'),
		'description' => basicModuleValue($module, 'desc'),
	], basicModuleValue($module, 'desc'));
}

function basicModuleRenderPage(array $module): void {
	$title = basicModuleValue($module, 'title');
	$tagline = basicModuleValue($module, 'tagline');
	$description = basicModuleValue($module, 'desc');
	$feature1 = basicModuleFeatureValue($module, 0);
	$feature2 = basicModuleFeatureValue($module, 1);
	$feature3 = basicModuleFeatureValue($module, 2);
	$vars = [
		'module' => $title,
		'tagline' => $tagline,
		'description' => $description,
		'feature_1' => $feature1,
		'feature_2' => $feature2,
		'feature_3' => $feature3,
	];
	$theme = htmlspecialchars($module['theme'], ENT_QUOTES, 'UTF-8');
	$icon = htmlspecialchars($module['icon'], ENT_QUOTES, 'UTF-8');
	$stats = $module['stats'] ?? ['1', '2', '3', '4'];
	$flowIds = ['control', 'followup', 'owners', 'reports'];
	?>
<main class="module-detail module-detail-basic module-detail-<?= $theme ?>">
	<section class="module-detail-hero bg-surface reveal" aria-label="<?= basicModuleAttr('module.basic.hero.aria_template', $vars) ?>">
		<div class="container">
			<div class="row align-items-center g-5">
				<div class="col-lg-6">
					<a href="/modulos.php#basicos" class="module-back-link">
						<i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
						<span data-i18n="module.basic.back"><?= basicModuleAttr('module.basic.back') ?></span>
					</a>
					<span class="eyebrow module-detail-eyebrow" data-i18n="module.basic.hero.eyebrow"><?= basicModuleAttr('module.basic.hero.eyebrow') ?></span>
					<h1 class="display-5 fw-medium text-balance mb-3"><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h1>
					<p class="lead lead-soft mb-2"><?= htmlspecialchars($description, ENT_QUOTES, 'UTF-8') ?></p>
					<p class="lead-soft fs-5 mb-4"><?= htmlspecialchars($tagline, ENT_QUOTES, 'UTF-8') ?></p>
					<div class="d-flex flex-column flex-sm-row gap-2 hero-actions">
						<a href="<?= getIndiceLoginUrlAttr() ?>" class="btn btn-brand btn-lg" data-i18n="nav.login"><?= basicModuleAttr('nav.login') ?></a>
						<a href="#flujos" class="btn btn-ghost btn-lg" data-i18n="module.basic.hero.cta.secondary"><?= basicModuleAttr('module.basic.hero.cta.secondary') ?></a>
					</div>
					<p class="hero-microcopy mt-3"><?= basicModuleAttr('module.basic.hero.microcopy_template', $vars) ?></p>
				</div>

				<div class="col-lg-6">
					<div class="hr-product-preview module-preview-card" aria-label="<?= basicModuleAttr('module.basic.preview.aria_template', $vars) ?>">
						<div class="hr-window-bar" aria-hidden="true">
							<span></span>
							<span></span>
							<span></span>
						</div>
						<div class="hr-preview-head">
							<div>
								<span class="badge-indice badge-indice-<?= $theme ?>" data-i18n="module.basic.preview.badge"><?= basicModuleAttr('module.basic.preview.badge') ?></span>
								<h2><?= basicModuleAttr('module.basic.preview.title_template', $vars) ?></h2>
							</div>
							<button type="button" class="hr-preview-action"><?= basicModuleAttr('module.basic.preview.action') ?></button>
						</div>

						<div class="hr-preview-stats">
							<?php foreach ($stats as $index => $value): ?>
								<div>
									<strong><?= htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8') ?></strong>
									<span data-i18n="module.basic.preview.stat_<?= $index + 1 ?>"><?= basicModuleAttr('module.basic.preview.stat_' . ($index + 1)) ?></span>
								</div>
							<?php endforeach; ?>
						</div>

						<div class="hr-preview-grid">
							<div class="hr-preview-panel">
								<div class="hr-preview-panel-title">
									<i class="fa-solid <?= $icon ?>" aria-hidden="true"></i>
									<span><?= basicModuleAttr('module.basic.preview.board_title_template', $vars) ?></span>
								</div>
								<div class="hr-person-list">
									<?php foreach ($module['features'] as $index => $feature): ?>
										<div class="hr-person-row">
											<span class="hr-avatar"><i class="fa-solid <?= htmlspecialchars($feature['icon'], ENT_QUOTES, 'UTF-8') ?>" aria-hidden="true"></i></span>
											<div>
												<strong><?= htmlspecialchars(basicModuleFeatureValue($module, $index), ENT_QUOTES, 'UTF-8') ?></strong>
												<small><?= basicModuleAttr('module.basic.preview.row_label_' . ($index + 1)) ?></small>
											</div>
											<em class="hr-status hr-status-<?= $index === 0 ? 'ok' : ($index === 1 ? 'warning' : 'pending') ?>"><?= basicModuleAttr('module.basic.preview.row_status_' . ($index + 1)) ?></em>
										</div>
									<?php endforeach; ?>
								</div>
							</div>

							<div class="hr-preview-panel hr-preview-panel-accent">
								<div class="hr-preview-panel-title">
									<i class="fa-solid fa-bell" aria-hidden="true"></i>
									<span data-i18n="module.basic.preview.pending_title"><?= basicModuleAttr('module.basic.preview.pending_title') ?></span>
								</div>
								<ul class="hr-task-list">
									<li><span><?= basicModuleAttr('module.basic.preview.task_1_template', $vars) ?></span><strong>2</strong></li>
									<li><span><?= basicModuleAttr('module.basic.preview.task_2_template', $vars) ?></span><strong>5</strong></li>
									<li><span><?= basicModuleAttr('module.basic.preview.task_3_template', $vars) ?></span><strong>1</strong></li>
								</ul>
								<div class="hr-payroll-note">
									<i class="fa-solid fa-link" aria-hidden="true"></i>
									<span><?= basicModuleAttr('module.basic.preview.note_template', $vars) ?></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="py-6 bg-card reveal" aria-label="<?= basicModuleAttr('module.basic.problems.aria_template', $vars) ?>">
		<div class="container">
			<div class="text-center mb-4">
				<span class="eyebrow" data-i18n="module.basic.problems.eyebrow"><?= basicModuleAttr('module.basic.problems.eyebrow') ?></span>
				<h2 class="section-title"><?= basicModuleAttr('module.basic.problems.title_template', $vars) ?></h2>
				<p class="lead-soft mx-auto" style="max-width:760px;"><?= basicModuleAttr('module.basic.problems.subtitle_template', $vars) ?></p>
			</div>

			<div class="row g-3">
				<?php for ($i = 1; $i <= 4; $i++): ?>
					<div class="col-md-6 col-lg-3">
						<div class="hr-problem-card h-100">
							<i class="fa-solid <?= $i === 1 ? 'fa-layer-group' : ($i === 2 ? 'fa-comments' : ($i === 3 ? 'fa-circle-question' : 'fa-chart-line')) ?>" aria-hidden="true"></i>
							<p><?= basicModuleAttr('module.basic.problem_' . $i . '_template', $vars) ?></p>
						</div>
					</div>
				<?php endfor; ?>
			</div>
		</div>
	</section>

	<section class="py-6 bg-surface reveal" aria-label="<?= basicModuleAttr('module.basic.benefits.aria_template', $vars) ?>">
		<div class="container">
			<div class="row align-items-end g-4 mb-4">
				<div class="col-lg-7">
					<span class="eyebrow" data-i18n="module.basic.benefits.eyebrow"><?= basicModuleAttr('module.basic.benefits.eyebrow') ?></span>
					<h2 class="section-title mb-0"><?= basicModuleAttr('module.basic.benefits.title_template', $vars) ?></h2>
				</div>
				<div class="col-lg-5">
					<p class="lead-soft mb-0"><?= basicModuleAttr('module.basic.benefits.subtitle_template', $vars) ?></p>
				</div>
			</div>

			<div class="row g-4">
				<?php foreach ($module['features'] as $index => $feature): ?>
					<div class="col-md-6 col-lg-4">
						<article class="module-card-modern module-theme-<?= $theme ?> h-100 p-4">
							<i class="fa-solid <?= htmlspecialchars($feature['icon'], ENT_QUOTES, 'UTF-8') ?> module-icon" aria-hidden="true"></i>
							<h3><?= htmlspecialchars(basicModuleFeatureValue($module, $index), ENT_QUOTES, 'UTF-8') ?></h3>
							<p><?= basicModuleAttr('module.basic.benefit_text_' . ($index + 1) . '_template', $vars) ?></p>
						</article>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="py-6 bg-card reveal" id="flujos" aria-label="<?= basicModuleAttr('module.basic.flows.aria_template', $vars) ?>">
		<div class="container">
			<div class="text-center mb-5">
				<span class="eyebrow" data-i18n="module.basic.flows.eyebrow"><?= basicModuleAttr('module.basic.flows.eyebrow') ?></span>
				<h2 class="section-title"><?= basicModuleAttr('module.basic.flows.title_template', $vars) ?></h2>
				<p class="lead-soft mx-auto" style="max-width:760px;"><?= basicModuleAttr('module.basic.flows.subtitle_template', $vars) ?></p>
			</div>

			<div class="hr-flow-shell">
				<div class="nav hr-flow-nav" role="tablist" aria-label="<?= basicModuleAttr('module.basic.flows.nav_aria_template', $vars) ?>">
					<?php foreach ($flowIds as $index => $flowId): ?>
						<button class="hr-flow-tab<?= $index === 0 ? ' active' : '' ?>" id="<?= htmlspecialchars($flowId, ENT_QUOTES, 'UTF-8') ?>-tab" data-bs-toggle="tab" data-bs-target="#<?= htmlspecialchars($flowId, ENT_QUOTES, 'UTF-8') ?>" type="button" role="tab" aria-controls="<?= htmlspecialchars($flowId, ENT_QUOTES, 'UTF-8') ?>" aria-selected="<?= $index === 0 ? 'true' : 'false' ?>">
							<i class="fa-solid <?= $index === 0 ? $icon : ($index === 1 ? 'fa-route' : ($index === 2 ? 'fa-user-check' : 'fa-chart-column')) ?>" aria-hidden="true"></i>
							<span><?= basicModuleAttr('module.basic.flow_' . ($index + 1) . '.tab') ?></span>
						</button>
					<?php endforeach; ?>
				</div>

				<div class="tab-content hr-flow-content">
					<?php foreach ($flowIds as $index => $flowId): ?>
						<div class="tab-pane fade<?= $index === 0 ? ' show active' : '' ?>" id="<?= htmlspecialchars($flowId, ENT_QUOTES, 'UTF-8') ?>" role="tabpanel" aria-labelledby="<?= htmlspecialchars($flowId, ENT_QUOTES, 'UTF-8') ?>-tab" tabindex="0">
							<div class="row g-4 align-items-center">
								<div class="col-lg-5">
									<h3><?= basicModuleAttr('module.basic.flow_' . ($index + 1) . '.title_template', $vars) ?></h3>
									<p class="lead-soft"><?= basicModuleAttr('module.basic.flow_' . ($index + 1) . '.text_template', $vars) ?></p>
								</div>
								<div class="col-lg-7">
									<ul class="hr-flow-list">
										<?php for ($item = 1; $item <= 3; $item++): ?>
											<li>
												<i class="fa-solid fa-circle-check" aria-hidden="true"></i>
												<span><?= basicModuleAttr('module.basic.flow_' . ($index + 1) . '.item_' . $item . '_template', $vars) ?></span>
											</li>
										<?php endfor; ?>
									</ul>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

	<section class="py-6 bg-surface reveal" aria-label="<?= basicModuleAttr('module.basic.fit.aria_template', $vars) ?>">
		<div class="container">
			<div class="row g-4 align-items-center">
				<div class="col-lg-5">
					<span class="eyebrow" data-i18n="module.basic.fit.eyebrow"><?= basicModuleAttr('module.basic.fit.eyebrow') ?></span>
					<h2 class="section-title"><?= basicModuleAttr('module.basic.fit.title_template', $vars) ?></h2>
					<p class="lead-soft"><?= basicModuleAttr('module.basic.fit.subtitle_template', $vars) ?></p>
				</div>
				<div class="col-lg-7">
					<div class="hr-fit-grid">
						<?php for ($i = 1; $i <= 4; $i++): ?>
							<div class="hr-fit-item">
								<i class="fa-solid <?= $i === 1 ? 'fa-store' : ($i === 2 ? 'fa-people-group' : ($i === 3 ? 'fa-briefcase' : 'fa-building')) ?>" aria-hidden="true"></i>
								<span><?= basicModuleAttr('module.basic.fit.item_' . $i . '_template', $vars) ?></span>
							</div>
						<?php endfor; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="py-6 bg-card text-center reveal" aria-label="<?= basicModuleAttr('module.basic.cta.aria_template', $vars) ?>">
		<div class="container">
			<div class="cta-box cta-box-strong">
				<span class="eyebrow" data-i18n="module.basic.cta.eyebrow"><?= basicModuleAttr('module.basic.cta.eyebrow') ?></span>
				<h2><?= basicModuleAttr('module.basic.cta.title_template', $vars) ?></h2>
				<p><?= basicModuleAttr('module.basic.cta.text_template', $vars) ?></p>
				<div class="d-flex flex-column flex-sm-row gap-2 justify-content-center">
					<a href="<?= getIndiceLoginUrlAttr() ?>" class="btn btn-brand btn-lg" data-i18n="nav.login"><?= basicModuleAttr('nav.login') ?></a>
					<a href="/modulos.php#basicos" class="btn btn-ghost btn-lg" data-i18n="module.basic.cta.secondary"><?= basicModuleAttr('module.basic.cta.secondary') ?></a>
				</div>
			</div>
		</div>
	</section>
</main>
	<?php
}
