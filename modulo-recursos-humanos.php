<?php
require_once __DIR__ . '/functions.php';

function hrModuleLoadMessages(string $locale): array {
	$filePath = __DIR__ . '/i18n/' . $locale . '.json';
	if (!is_file($filePath)) {
		return [];
	}

	$raw = file_get_contents($filePath);
	if ($raw === false) {
		return [];
	}

	$decoded = json_decode($raw, true);
	return is_array($decoded) ? $decoded : [];
}

$hrModuleContext = resolveSiteContext();
$hrModuleLocale = $hrModuleContext['locale'] ?? 'es-MX';
$hrModuleMessages = hrModuleLoadMessages('es-MX');
if ($hrModuleLocale !== 'es-MX') {
	$hrModuleMessages = array_merge($hrModuleMessages, hrModuleLoadMessages($hrModuleLocale));
}

function hrModuleText(string $key): string {
	global $hrModuleMessages;
	return (string)($hrModuleMessages[$key] ?? '');
}

function hrModuleAttr(string $key): string {
	return htmlspecialchars(hrModuleText($key), ENT_QUOTES, 'UTF-8');
}

function hrModuleInitial(string $key): string {
	$value = hrModuleText($key);
	if ($value === '') {
		return '';
	}
	if (function_exists('mb_substr')) {
		return mb_substr($value, 0, 1, 'UTF-8');
	}
	return substr($value, 0, 1);
}

$page_title = hrModuleText('module.hr.meta.title');
$page_description = hrModuleText('module.hr.meta.description');

$hrHeroStats = [
	['value' => '98%', 'label_key' => 'module.hr.hero.stat_1.label', 'text_key' => 'module.hr.hero.stat_1.text'],
	['value' => '5', 'label_key' => 'module.hr.hero.stat_2.label', 'text_key' => 'module.hr.hero.stat_2.text'],
	['value' => '24/7', 'label_key' => 'module.hr.hero.stat_3.label', 'text_key' => 'module.hr.hero.stat_3.text'],
];

$hrLiveLogs = [
	['name_key' => 'module.hr.visual.log_1.name', 'role_key' => 'module.hr.visual.log_1.role', 'time' => '08:01', 'method_key' => 'module.hr.visual.log_1.method', 'status_key' => 'module.hr.visual.log_1.status', 'status' => 'ok'],
	['name_key' => 'module.hr.visual.log_2.name', 'role_key' => 'module.hr.visual.log_2.role', 'time' => '08:09', 'method_key' => 'module.hr.visual.log_2.method', 'status_key' => 'module.hr.visual.log_2.status', 'status' => 'warning'],
	['name_key' => 'module.hr.visual.log_3.name', 'role_key' => 'module.hr.visual.log_3.role', 'time' => '08:17', 'method_key' => 'module.hr.visual.log_3.method', 'status_key' => 'module.hr.visual.log_3.status', 'status' => 'ok'],
];

$hrProblems = [
	['icon' => 'fa-user-clock', 'title_key' => 'module.hr.problem_1.title', 'text_key' => 'module.hr.problem_1.text'],
	['icon' => 'fa-user-secret', 'title_key' => 'module.hr.problem_2.title', 'text_key' => 'module.hr.problem_2.text'],
	['icon' => 'fa-location-crosshairs', 'title_key' => 'module.hr.problem_3.title', 'text_key' => 'module.hr.problem_3.text'],
	['icon' => 'fa-file-invoice-dollar', 'title_key' => 'module.hr.problem_4.title', 'text_key' => 'module.hr.problem_4.text'],
	['icon' => 'fa-table-cells', 'title_key' => 'module.hr.problem_5.title', 'text_key' => 'module.hr.problem_5.text'],
	['icon' => 'fa-building-user', 'title_key' => 'module.hr.problem_6.title', 'text_key' => 'module.hr.problem_6.text'],
];

$hrControlCards = [
	['icon' => 'fa-circle-check', 'title_key' => 'module.hr.control.card_1.title', 'text_key' => 'module.hr.control.card_1.text'],
	['icon' => 'fa-map-location-dot', 'title_key' => 'module.hr.control.card_2.title', 'text_key' => 'module.hr.control.card_2.text'],
	['icon' => 'fa-camera', 'title_key' => 'module.hr.control.card_3.title', 'text_key' => 'module.hr.control.card_3.text'],
	['icon' => 'fa-bell', 'title_key' => 'module.hr.control.card_4.title', 'text_key' => 'module.hr.control.card_4.text'],
];

$hrVerification = [
	['icon' => 'fa-face-smile', 'title_key' => 'module.hr.verify.card_1.title', 'text_key' => 'module.hr.verify.card_1.text'],
	['icon' => 'fa-location-dot', 'title_key' => 'module.hr.verify.card_2.title', 'text_key' => 'module.hr.verify.card_2.text'],
	['icon' => 'fa-store', 'title_key' => 'module.hr.verify.card_3.title', 'text_key' => 'module.hr.verify.card_3.text'],
];

$hrPayrollModes = [
	['icon' => 'fa-scale-balanced', 'title_key' => 'module.hr.payroll.mode_1.title', 'text_key' => 'module.hr.payroll.mode_1.text'],
	['icon' => 'fa-clipboard-check', 'title_key' => 'module.hr.payroll.mode_2.title', 'text_key' => 'module.hr.payroll.mode_2.text'],
	['icon' => 'fa-layer-group', 'title_key' => 'module.hr.payroll.mode_3.title', 'text_key' => 'module.hr.payroll.mode_3.text'],
	['icon' => 'fa-earth-americas', 'title_key' => 'module.hr.payroll.mode_4.title', 'text_key' => 'module.hr.payroll.mode_4.text'],
];

$hrCountries = [
	'module.hr.country.mx',
	'module.hr.country.co',
	'module.hr.country.br',
	'module.hr.country.ca',
	'module.hr.country.us',
];

$hrAnalytics = [
	['value' => '96%', 'label_key' => 'module.hr.analytics.metric_1.label', 'text_key' => 'module.hr.analytics.metric_1.text'],
	['value' => '12', 'label_key' => 'module.hr.analytics.metric_2.label', 'text_key' => 'module.hr.analytics.metric_2.text'],
	['value' => '3', 'label_key' => 'module.hr.analytics.metric_3.label', 'text_key' => 'module.hr.analytics.metric_3.text'],
	['value' => '8', 'label_key' => 'module.hr.analytics.metric_4.label', 'text_key' => 'module.hr.analytics.metric_4.text'],
];

$hrOperations = [
	['icon' => 'fa-inbox', 'title_key' => 'module.hr.ops.card_1.title', 'text_key' => 'module.hr.ops.card_1.text'],
	['icon' => 'fa-laptop', 'title_key' => 'module.hr.ops.card_2.title', 'text_key' => 'module.hr.ops.card_2.text'],
	['icon' => 'fa-gift', 'title_key' => 'module.hr.ops.card_3.title', 'text_key' => 'module.hr.ops.card_3.text'],
];

$hrAlerts = [
	['type' => 'danger', 'icon' => 'fa-triangle-exclamation', 'title_key' => 'module.hr.alerts.item_1.title', 'text_key' => 'module.hr.alerts.item_1.text'],
	['type' => 'warning', 'icon' => 'fa-clock', 'title_key' => 'module.hr.alerts.item_2.title', 'text_key' => 'module.hr.alerts.item_2.text'],
	['type' => 'success', 'icon' => 'fa-money-check-dollar', 'title_key' => 'module.hr.alerts.item_3.title', 'text_key' => 'module.hr.alerts.item_3.text'],
];

$hrLanguages = [
	'module.hr.language.es',
	'module.hr.language.en',
	'module.hr.language.fr',
	'module.hr.language.pt',
	'module.hr.language.ko',
	'module.hr.language.zh',
];

include 'header.php';
?>

<main class="module-detail module-detail-hr module-detail-hr-v2">
	<section class="hr-ops-hero bg-surface reveal" aria-label="<?php echo hrModuleAttr('module.hr.hero.aria'); ?>">
		<div class="container">
			<div class="row align-items-center g-5">
				<div class="col-lg-6">
					<a href="/modulos.php#basicos" class="module-back-link">
						<i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
						<span data-i18n="module.hr.back"><?php echo hrModuleAttr('module.hr.back'); ?></span>
					</a>
					<span class="eyebrow module-detail-eyebrow" data-i18n="module.hr.hero.eyebrow"><?php echo hrModuleAttr('module.hr.hero.eyebrow'); ?></span>
					<h1 class="display-5 fw-bold text-balance mb-3" data-i18n="module.hr.hero.title"><?php echo hrModuleAttr('module.hr.hero.title'); ?></h1>
					<p class="lead lead-soft mb-4" data-i18n="module.hr.hero.subtitle"><?php echo hrModuleAttr('module.hr.hero.subtitle'); ?></p>
					<div class="d-flex flex-column flex-sm-row gap-2 hero-actions">
						<a href="/contacto.php#demo" class="btn btn-brand btn-lg" data-i18n="module.hr.hero.cta.primary"><?php echo hrModuleAttr('module.hr.hero.cta.primary'); ?></a>
						<a href="#control-tiempo-real" class="btn btn-ghost btn-lg" data-i18n="module.hr.hero.cta.secondary"><?php echo hrModuleAttr('module.hr.hero.cta.secondary'); ?></a>
					</div>
					<p class="hero-microcopy mt-3" data-i18n="module.hr.hero.microcopy"><?php echo hrModuleAttr('module.hr.hero.microcopy'); ?></p>

					<div class="hr-hero-stat-grid" aria-label="<?php echo hrModuleAttr('module.hr.hero.stats_aria'); ?>">
						<?php foreach ($hrHeroStats as $stat): ?>
							<div class="hr-hero-stat">
								<strong><?php echo htmlspecialchars($stat['value'], ENT_QUOTES, 'UTF-8'); ?></strong>
								<span data-i18n="<?php echo htmlspecialchars($stat['label_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo hrModuleAttr($stat['label_key']); ?></span>
								<small data-i18n="<?php echo htmlspecialchars($stat['text_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo hrModuleAttr($stat['text_key']); ?></small>
							</div>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="hr-control-visual" aria-label="<?php echo hrModuleAttr('module.hr.visual.aria'); ?>">
						<div class="hr-live-topbar">
							<span><i class="hr-live-dot" aria-hidden="true"></i><span data-i18n="module.hr.visual.live"><?php echo hrModuleAttr('module.hr.visual.live'); ?></span></span>
							<strong data-i18n="module.hr.visual.mode"><?php echo hrModuleAttr('module.hr.visual.mode'); ?></strong>
						</div>
						<div class="hr-visual-screen">
							<div class="hr-branch-strip">
								<span data-i18n="module.hr.visual.branch_1"><?php echo hrModuleAttr('module.hr.visual.branch_1'); ?></span>
								<span data-i18n="module.hr.visual.branch_2"><?php echo hrModuleAttr('module.hr.visual.branch_2'); ?></span>
								<span data-i18n="module.hr.visual.branch_3"><?php echo hrModuleAttr('module.hr.visual.branch_3'); ?></span>
							</div>

							<div class="hr-visual-grid">
								<div class="hr-attendance-feed">
									<div class="hr-visual-heading">
										<i class="fa-solid fa-users-viewfinder" aria-hidden="true"></i>
										<span data-i18n="module.hr.visual.feed_title"><?php echo hrModuleAttr('module.hr.visual.feed_title'); ?></span>
									</div>
									<?php foreach ($hrLiveLogs as $log): ?>
										<div class="hr-log-row hr-log-row-<?php echo htmlspecialchars($log['status'], ENT_QUOTES, 'UTF-8'); ?>">
											<span class="hr-photo"><?php echo htmlspecialchars(hrModuleInitial($log['name_key']), ENT_QUOTES, 'UTF-8'); ?></span>
											<div>
												<strong data-i18n="<?php echo htmlspecialchars($log['name_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo hrModuleAttr($log['name_key']); ?></strong>
												<small data-i18n="<?php echo htmlspecialchars($log['role_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo hrModuleAttr($log['role_key']); ?></small>
											</div>
											<time><?php echo htmlspecialchars($log['time'], ENT_QUOTES, 'UTF-8'); ?></time>
											<em data-i18n="<?php echo htmlspecialchars($log['method_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo hrModuleAttr($log['method_key']); ?></em>
										</div>
									<?php endforeach; ?>
								</div>

								<div class="hr-alert-card">
									<span class="hr-alert-badge" data-i18n="module.hr.visual.alert_badge"><?php echo hrModuleAttr('module.hr.visual.alert_badge'); ?></span>
									<h3 data-i18n="module.hr.visual.alert_title"><?php echo hrModuleAttr('module.hr.visual.alert_title'); ?></h3>
									<p data-i18n="module.hr.visual.alert_text"><?php echo hrModuleAttr('module.hr.visual.alert_text'); ?></p>
									<div class="hr-alert-route">
										<span data-i18n="module.hr.visual.alert_step_1"><?php echo hrModuleAttr('module.hr.visual.alert_step_1'); ?></span>
										<i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
										<span data-i18n="module.hr.visual.alert_step_2"><?php echo hrModuleAttr('module.hr.visual.alert_step_2'); ?></span>
										<i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
										<span data-i18n="module.hr.visual.alert_step_3"><?php echo hrModuleAttr('module.hr.visual.alert_step_3'); ?></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="py-6 bg-card reveal" aria-label="<?php echo hrModuleAttr('module.hr.problems.aria'); ?>">
		<div class="container">
			<div class="text-center mb-5">
				<span class="eyebrow" data-i18n="module.hr.problems.eyebrow"><?php echo hrModuleAttr('module.hr.problems.eyebrow'); ?></span>
				<h2 class="section-title" data-i18n="module.hr.problems.title"><?php echo hrModuleAttr('module.hr.problems.title'); ?></h2>
				<p class="lead-soft mx-auto" style="max-width:780px;" data-i18n="module.hr.problems.subtitle"><?php echo hrModuleAttr('module.hr.problems.subtitle'); ?></p>
			</div>

			<div class="row g-3">
				<?php foreach ($hrProblems as $problem): ?>
					<div class="col-md-6 col-lg-4">
						<article class="hr-pain-card h-100">
							<i class="fa-solid <?php echo htmlspecialchars($problem['icon'], ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true"></i>
							<h3 data-i18n="<?php echo htmlspecialchars($problem['title_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo hrModuleAttr($problem['title_key']); ?></h3>
							<p data-i18n="<?php echo htmlspecialchars($problem['text_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo hrModuleAttr($problem['text_key']); ?></p>
						</article>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="py-6 bg-surface reveal" id="control-tiempo-real" aria-label="<?php echo hrModuleAttr('module.hr.control.aria'); ?>">
		<div class="container">
			<div class="row g-5 align-items-center">
				<div class="col-lg-5">
					<span class="eyebrow" data-i18n="module.hr.control.eyebrow"><?php echo hrModuleAttr('module.hr.control.eyebrow'); ?></span>
					<h2 class="section-title" data-i18n="module.hr.control.title"><?php echo hrModuleAttr('module.hr.control.title'); ?></h2>
					<p class="lead-soft" data-i18n="module.hr.control.subtitle"><?php echo hrModuleAttr('module.hr.control.subtitle'); ?></p>
				</div>
				<div class="col-lg-7">
					<div class="hr-control-grid">
						<?php foreach ($hrControlCards as $card): ?>
							<article class="hr-control-card">
								<i class="fa-solid <?php echo htmlspecialchars($card['icon'], ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true"></i>
								<h3 data-i18n="<?php echo htmlspecialchars($card['title_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo hrModuleAttr($card['title_key']); ?></h3>
								<p data-i18n="<?php echo htmlspecialchars($card['text_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo hrModuleAttr($card['text_key']); ?></p>
							</article>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="py-6 bg-card reveal" aria-label="<?php echo hrModuleAttr('module.hr.verify.aria'); ?>">
		<div class="container">
			<div class="row g-4 align-items-end mb-4">
				<div class="col-lg-7">
					<span class="eyebrow" data-i18n="module.hr.verify.eyebrow"><?php echo hrModuleAttr('module.hr.verify.eyebrow'); ?></span>
					<h2 class="section-title mb-0" data-i18n="module.hr.verify.title"><?php echo hrModuleAttr('module.hr.verify.title'); ?></h2>
				</div>
				<div class="col-lg-5">
					<p class="lead-soft mb-0" data-i18n="module.hr.verify.subtitle"><?php echo hrModuleAttr('module.hr.verify.subtitle'); ?></p>
				</div>
			</div>

			<div class="row g-4">
				<?php foreach ($hrVerification as $card): ?>
					<div class="col-md-4">
						<article class="hr-proof-card h-100">
							<i class="fa-solid <?php echo htmlspecialchars($card['icon'], ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true"></i>
							<h3 data-i18n="<?php echo htmlspecialchars($card['title_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo hrModuleAttr($card['title_key']); ?></h3>
							<p data-i18n="<?php echo htmlspecialchars($card['text_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo hrModuleAttr($card['text_key']); ?></p>
						</article>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="py-6 bg-surface reveal" aria-label="<?php echo hrModuleAttr('module.hr.payroll.aria'); ?>">
		<div class="container">
			<div class="text-center mb-5">
				<span class="eyebrow" data-i18n="module.hr.payroll.eyebrow"><?php echo hrModuleAttr('module.hr.payroll.eyebrow'); ?></span>
				<h2 class="section-title" data-i18n="module.hr.payroll.title"><?php echo hrModuleAttr('module.hr.payroll.title'); ?></h2>
				<p class="lead-soft mx-auto" style="max-width:780px;" data-i18n="module.hr.payroll.subtitle"><?php echo hrModuleAttr('module.hr.payroll.subtitle'); ?></p>
			</div>

			<div class="row g-4">
				<?php foreach ($hrPayrollModes as $mode): ?>
					<div class="col-md-6 col-lg-3">
						<article class="hr-payroll-card h-100">
							<i class="fa-solid <?php echo htmlspecialchars($mode['icon'], ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true"></i>
							<h3 data-i18n="<?php echo htmlspecialchars($mode['title_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo hrModuleAttr($mode['title_key']); ?></h3>
							<p data-i18n="<?php echo htmlspecialchars($mode['text_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo hrModuleAttr($mode['text_key']); ?></p>
						</article>
					</div>
				<?php endforeach; ?>
			</div>

			<div class="hr-country-strip" aria-label="<?php echo hrModuleAttr('module.hr.countries.aria'); ?>">
				<span data-i18n="module.hr.countries.label"><?php echo hrModuleAttr('module.hr.countries.label'); ?></span>
				<?php foreach ($hrCountries as $countryKey): ?>
					<strong data-i18n="<?php echo htmlspecialchars($countryKey, ENT_QUOTES, 'UTF-8'); ?>"><?php echo hrModuleAttr($countryKey); ?></strong>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="py-6 bg-card reveal" aria-label="<?php echo hrModuleAttr('module.hr.analytics.aria'); ?>">
		<div class="container">
			<div class="row g-5 align-items-center">
				<div class="col-lg-5">
					<span class="eyebrow" data-i18n="module.hr.analytics.eyebrow"><?php echo hrModuleAttr('module.hr.analytics.eyebrow'); ?></span>
					<h2 class="section-title" data-i18n="module.hr.analytics.title"><?php echo hrModuleAttr('module.hr.analytics.title'); ?></h2>
					<p class="lead-soft" data-i18n="module.hr.analytics.subtitle"><?php echo hrModuleAttr('module.hr.analytics.subtitle'); ?></p>
				</div>
				<div class="col-lg-7">
					<div class="hr-metric-grid">
						<?php foreach ($hrAnalytics as $metric): ?>
							<div class="hr-metric-card">
								<strong><?php echo htmlspecialchars($metric['value'], ENT_QUOTES, 'UTF-8'); ?></strong>
								<span data-i18n="<?php echo htmlspecialchars($metric['label_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo hrModuleAttr($metric['label_key']); ?></span>
								<p data-i18n="<?php echo htmlspecialchars($metric['text_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo hrModuleAttr($metric['text_key']); ?></p>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="py-6 bg-surface reveal" aria-label="<?php echo hrModuleAttr('module.hr.ops.aria'); ?>">
		<div class="container">
			<div class="text-center mb-5">
				<span class="eyebrow" data-i18n="module.hr.ops.eyebrow"><?php echo hrModuleAttr('module.hr.ops.eyebrow'); ?></span>
				<h2 class="section-title" data-i18n="module.hr.ops.title"><?php echo hrModuleAttr('module.hr.ops.title'); ?></h2>
				<p class="lead-soft mx-auto" style="max-width:780px;" data-i18n="module.hr.ops.subtitle"><?php echo hrModuleAttr('module.hr.ops.subtitle'); ?></p>
			</div>

			<div class="row g-4">
				<?php foreach ($hrOperations as $operation): ?>
					<div class="col-md-4">
						<article class="hr-ops-card h-100">
							<i class="fa-solid <?php echo htmlspecialchars($operation['icon'], ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true"></i>
							<h3 data-i18n="<?php echo htmlspecialchars($operation['title_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo hrModuleAttr($operation['title_key']); ?></h3>
							<p data-i18n="<?php echo htmlspecialchars($operation['text_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo hrModuleAttr($operation['text_key']); ?></p>
						</article>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="py-6 bg-card reveal" aria-label="<?php echo hrModuleAttr('module.hr.alerts.aria'); ?>">
		<div class="container">
			<div class="row g-5 align-items-center">
				<div class="col-lg-5">
					<span class="eyebrow" data-i18n="module.hr.alerts.eyebrow"><?php echo hrModuleAttr('module.hr.alerts.eyebrow'); ?></span>
					<h2 class="section-title" data-i18n="module.hr.alerts.title"><?php echo hrModuleAttr('module.hr.alerts.title'); ?></h2>
					<p class="lead-soft" data-i18n="module.hr.alerts.subtitle"><?php echo hrModuleAttr('module.hr.alerts.subtitle'); ?></p>
				</div>
				<div class="col-lg-7">
					<div class="hr-alert-timeline">
						<?php foreach ($hrAlerts as $alert): ?>
							<article class="hr-alert-item hr-alert-item-<?php echo htmlspecialchars($alert['type'], ENT_QUOTES, 'UTF-8'); ?>">
								<i class="fa-solid <?php echo htmlspecialchars($alert['icon'], ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true"></i>
								<div>
									<h3 data-i18n="<?php echo htmlspecialchars($alert['title_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo hrModuleAttr($alert['title_key']); ?></h3>
									<p data-i18n="<?php echo htmlspecialchars($alert['text_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo hrModuleAttr($alert['text_key']); ?></p>
								</div>
							</article>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="py-6 bg-surface reveal" aria-label="<?php echo hrModuleAttr('module.hr.languages.aria'); ?>">
		<div class="container">
			<div class="hr-language-panel">
				<div>
					<span class="eyebrow" data-i18n="module.hr.languages.eyebrow"><?php echo hrModuleAttr('module.hr.languages.eyebrow'); ?></span>
					<h2 class="section-title" data-i18n="module.hr.languages.title"><?php echo hrModuleAttr('module.hr.languages.title'); ?></h2>
					<p class="lead-soft" data-i18n="module.hr.languages.subtitle"><?php echo hrModuleAttr('module.hr.languages.subtitle'); ?></p>
				</div>
				<div class="hr-language-grid">
					<?php foreach ($hrLanguages as $languageKey): ?>
						<span data-i18n="<?php echo htmlspecialchars($languageKey, ENT_QUOTES, 'UTF-8'); ?>"><?php echo hrModuleAttr($languageKey); ?></span>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

	<section class="py-6 bg-card text-center reveal" aria-label="<?php echo hrModuleAttr('module.hr.cta.aria'); ?>">
		<div class="container">
			<div class="cta-box cta-box-strong hr-final-cta">
				<span class="eyebrow" data-i18n="module.hr.cta.eyebrow"><?php echo hrModuleAttr('module.hr.cta.eyebrow'); ?></span>
				<h2 data-i18n="module.hr.cta.title"><?php echo hrModuleAttr('module.hr.cta.title'); ?></h2>
				<p data-i18n="module.hr.cta.text"><?php echo hrModuleAttr('module.hr.cta.text'); ?></p>
				<div class="d-flex flex-column flex-sm-row gap-2 justify-content-center">
					<a href="/contacto.php#demo" class="btn btn-brand btn-lg" data-i18n="module.hr.cta.primary"><?php echo hrModuleAttr('module.hr.cta.primary'); ?></a>
					<a href="/modulos.php#basicos" class="btn btn-ghost btn-lg" data-i18n="module.hr.cta.secondary"><?php echo hrModuleAttr('module.hr.cta.secondary'); ?></a>
				</div>
			</div>
		</div>
	</section>
</main>

<?php include 'footer.php'; ?>
