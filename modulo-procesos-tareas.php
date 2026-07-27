<?php
require_once __DIR__ . '/functions.php';

function processModuleLoadMessages(string $locale): array {
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

$processModuleContext = resolveSiteContext();
$processModuleLocale = $processModuleContext['locale'] ?? 'es-MX';
$processModuleMessages = processModuleLoadMessages('es-MX');
if ($processModuleLocale !== 'es-MX') {
	$processModuleMessages = array_merge($processModuleMessages, processModuleLoadMessages($processModuleLocale));
}

function processModuleText(string $key): string {
	global $processModuleMessages;
	return (string)($processModuleMessages[$key] ?? '');
}

function processModuleAttr(string $key): string {
	return htmlspecialchars(processModuleText($key), ENT_QUOTES, 'UTF-8');
}

$page_title = processModuleText('module.process.meta.title');
$page_description = processModuleText('module.process.meta.description');

$processHeroStats = [
	['value' => '92%', 'label_key' => 'module.process.hero.stat_1.label', 'text_key' => 'module.process.hero.stat_1.text'],
	['value' => '18', 'label_key' => 'module.process.hero.stat_2.label', 'text_key' => 'module.process.hero.stat_2.text'],
	['value' => '6', 'label_key' => 'module.process.hero.stat_3.label', 'text_key' => 'module.process.hero.stat_3.text'],
];

$processBoard = [
	[
		'status' => 'today',
		'title_key' => 'module.process.visual.column_1',
		'items' => [
			['title_key' => 'module.process.visual.task_1.title', 'meta_key' => 'module.process.visual.task_1.meta'],
			['title_key' => 'module.process.visual.task_2.title', 'meta_key' => 'module.process.visual.task_2.meta'],
		],
	],
	[
		'status' => 'doing',
		'title_key' => 'module.process.visual.column_2',
		'items' => [
			['title_key' => 'module.process.visual.task_3.title', 'meta_key' => 'module.process.visual.task_3.meta'],
			['title_key' => 'module.process.visual.task_4.title', 'meta_key' => 'module.process.visual.task_4.meta'],
		],
	],
	[
		'status' => 'risk',
		'title_key' => 'module.process.visual.column_3',
		'items' => [
			['title_key' => 'module.process.visual.task_5.title', 'meta_key' => 'module.process.visual.task_5.meta'],
			['title_key' => 'module.process.visual.task_6.title', 'meta_key' => 'module.process.visual.task_6.meta'],
		],
	],
];

$processProblems = [
	['icon' => 'fa-comments', 'title_key' => 'module.process.problem_1.title', 'text_key' => 'module.process.problem_1.text'],
	['icon' => 'fa-user-xmark', 'title_key' => 'module.process.problem_2.title', 'text_key' => 'module.process.problem_2.text'],
	['icon' => 'fa-repeat', 'title_key' => 'module.process.problem_3.title', 'text_key' => 'module.process.problem_3.text'],
	['icon' => 'fa-clock', 'title_key' => 'module.process.problem_4.title', 'text_key' => 'module.process.problem_4.text'],
	['icon' => 'fa-store', 'title_key' => 'module.process.problem_5.title', 'text_key' => 'module.process.problem_5.text'],
	['icon' => 'fa-chart-simple', 'title_key' => 'module.process.problem_6.title', 'text_key' => 'module.process.problem_6.text'],
];

$processControl = [
	['icon' => 'fa-user-check', 'title_key' => 'module.process.control.card_1.title', 'text_key' => 'module.process.control.card_1.text'],
	['icon' => 'fa-calendar-check', 'title_key' => 'module.process.control.card_2.title', 'text_key' => 'module.process.control.card_2.text'],
	['icon' => 'fa-camera', 'title_key' => 'module.process.control.card_3.title', 'text_key' => 'module.process.control.card_3.text'],
	['icon' => 'fa-bell', 'title_key' => 'module.process.control.card_4.title', 'text_key' => 'module.process.control.card_4.text'],
];

$processRecurring = [
	['step' => '01', 'title_key' => 'module.process.recurring.step_1.title', 'text_key' => 'module.process.recurring.step_1.text'],
	['step' => '02', 'title_key' => 'module.process.recurring.step_2.title', 'text_key' => 'module.process.recurring.step_2.text'],
	['step' => '03', 'title_key' => 'module.process.recurring.step_3.title', 'text_key' => 'module.process.recurring.step_3.text'],
	['step' => '04', 'title_key' => 'module.process.recurring.step_4.title', 'text_key' => 'module.process.recurring.step_4.text'],
];

$processMetrics = [
	['value' => '84%', 'label_key' => 'module.process.metrics.metric_1.label', 'text_key' => 'module.process.metrics.metric_1.text'],
	['value' => '11', 'label_key' => 'module.process.metrics.metric_2.label', 'text_key' => 'module.process.metrics.metric_2.text'],
	['value' => '4', 'label_key' => 'module.process.metrics.metric_3.label', 'text_key' => 'module.process.metrics.metric_3.text'],
	['value' => '27', 'label_key' => 'module.process.metrics.metric_4.label', 'text_key' => 'module.process.metrics.metric_4.text'],
];

$processAlerts = [
	['type' => 'warning', 'icon' => 'fa-triangle-exclamation', 'title_key' => 'module.process.alerts.item_1.title', 'text_key' => 'module.process.alerts.item_1.text'],
	['type' => 'danger', 'icon' => 'fa-fire', 'title_key' => 'module.process.alerts.item_2.title', 'text_key' => 'module.process.alerts.item_2.text'],
	['type' => 'success', 'icon' => 'fa-circle-check', 'title_key' => 'module.process.alerts.item_3.title', 'text_key' => 'module.process.alerts.item_3.text'],
];

include 'header.php';
?>

<main class="module-detail module-detail-process-v2">
	<section class="process-ops-hero bg-surface reveal" aria-label="<?php echo processModuleAttr('module.process.hero.aria'); ?>">
		<div class="container">
			<div class="row align-items-center g-5">
				<div class="col-lg-6">
					<a href="/modulos.php#basicos" class="module-back-link">
						<i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
						<span data-i18n="module.process.back"><?php echo processModuleAttr('module.process.back'); ?></span>
					</a>
					<span class="eyebrow process-detail-eyebrow" data-i18n="module.process.hero.eyebrow"><?php echo processModuleAttr('module.process.hero.eyebrow'); ?></span>
					<h1 class="display-5 fw-medium text-balance mb-3" data-i18n="module.process.hero.title"><?php echo processModuleAttr('module.process.hero.title'); ?></h1>
					<p class="lead lead-soft mb-4" data-i18n="module.process.hero.subtitle"><?php echo processModuleAttr('module.process.hero.subtitle'); ?></p>
					<div class="d-flex flex-column flex-sm-row gap-2 hero-actions">
						<a href="<?= getIndiceLoginUrlAttr() ?>" class="btn btn-brand btn-lg" data-i18n="nav.login"><?php echo processModuleAttr('nav.login'); ?></a>
						<a href="#tablero-operativo" class="btn btn-ghost btn-lg" data-i18n="module.process.hero.cta.secondary"><?php echo processModuleAttr('module.process.hero.cta.secondary'); ?></a>
					</div>
					<p class="hero-microcopy mt-3" data-i18n="module.process.hero.microcopy"><?php echo processModuleAttr('module.process.hero.microcopy'); ?></p>

					<div class="process-hero-stat-grid" aria-label="<?php echo processModuleAttr('module.process.hero.stats_aria'); ?>">
						<?php foreach ($processHeroStats as $stat): ?>
							<div class="process-hero-stat">
								<strong><?php echo htmlspecialchars($stat['value'], ENT_QUOTES, 'UTF-8'); ?></strong>
								<span data-i18n="<?php echo htmlspecialchars($stat['label_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo processModuleAttr($stat['label_key']); ?></span>
								<small data-i18n="<?php echo htmlspecialchars($stat['text_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo processModuleAttr($stat['text_key']); ?></small>
							</div>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="process-command-visual" aria-label="<?php echo processModuleAttr('module.process.visual.aria'); ?>">
						<div class="process-live-topbar">
							<span><i class="process-live-dot" aria-hidden="true"></i><span data-i18n="module.process.visual.live"><?php echo processModuleAttr('module.process.visual.live'); ?></span></span>
							<strong data-i18n="module.process.visual.mode"><?php echo processModuleAttr('module.process.visual.mode'); ?></strong>
						</div>
						<div class="process-board">
							<?php foreach ($processBoard as $column): ?>
								<div class="process-board-column process-board-column-<?php echo htmlspecialchars($column['status'], ENT_QUOTES, 'UTF-8'); ?>">
									<h2 data-i18n="<?php echo htmlspecialchars($column['title_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo processModuleAttr($column['title_key']); ?></h2>
									<?php foreach ($column['items'] as $item): ?>
										<article>
											<strong data-i18n="<?php echo htmlspecialchars($item['title_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo processModuleAttr($item['title_key']); ?></strong>
											<span data-i18n="<?php echo htmlspecialchars($item['meta_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo processModuleAttr($item['meta_key']); ?></span>
										</article>
									<?php endforeach; ?>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="py-6 bg-card reveal" aria-label="<?php echo processModuleAttr('module.process.problems.aria'); ?>">
		<div class="container">
			<div class="text-center mb-5">
				<span class="eyebrow" data-i18n="module.process.problems.eyebrow"><?php echo processModuleAttr('module.process.problems.eyebrow'); ?></span>
				<h2 class="section-title" data-i18n="module.process.problems.title"><?php echo processModuleAttr('module.process.problems.title'); ?></h2>
				<p class="lead-soft mx-auto" style="max-width:780px;" data-i18n="module.process.problems.subtitle"><?php echo processModuleAttr('module.process.problems.subtitle'); ?></p>
			</div>

			<div class="row g-3">
				<?php foreach ($processProblems as $problem): ?>
					<div class="col-md-6 col-lg-4">
						<article class="process-pain-card h-100">
							<i class="fa-solid <?php echo htmlspecialchars($problem['icon'], ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true"></i>
							<h3 data-i18n="<?php echo htmlspecialchars($problem['title_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo processModuleAttr($problem['title_key']); ?></h3>
							<p data-i18n="<?php echo htmlspecialchars($problem['text_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo processModuleAttr($problem['text_key']); ?></p>
						</article>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="py-6 bg-surface reveal" id="tablero-operativo" aria-label="<?php echo processModuleAttr('module.process.control.aria'); ?>">
		<div class="container">
			<div class="row g-5 align-items-center">
				<div class="col-lg-5">
					<span class="eyebrow" data-i18n="module.process.control.eyebrow"><?php echo processModuleAttr('module.process.control.eyebrow'); ?></span>
					<h2 class="section-title" data-i18n="module.process.control.title"><?php echo processModuleAttr('module.process.control.title'); ?></h2>
					<p class="lead-soft" data-i18n="module.process.control.subtitle"><?php echo processModuleAttr('module.process.control.subtitle'); ?></p>
				</div>
				<div class="col-lg-7">
					<div class="process-control-grid">
						<?php foreach ($processControl as $card): ?>
							<article class="process-control-card">
								<i class="fa-solid <?php echo htmlspecialchars($card['icon'], ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true"></i>
								<h3 data-i18n="<?php echo htmlspecialchars($card['title_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo processModuleAttr($card['title_key']); ?></h3>
								<p data-i18n="<?php echo htmlspecialchars($card['text_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo processModuleAttr($card['text_key']); ?></p>
							</article>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="py-6 bg-card reveal" aria-label="<?php echo processModuleAttr('module.process.recurring.aria'); ?>">
		<div class="container">
			<div class="row g-4 align-items-end mb-4">
				<div class="col-lg-7">
					<span class="eyebrow" data-i18n="module.process.recurring.eyebrow"><?php echo processModuleAttr('module.process.recurring.eyebrow'); ?></span>
					<h2 class="section-title mb-0" data-i18n="module.process.recurring.title"><?php echo processModuleAttr('module.process.recurring.title'); ?></h2>
				</div>
				<div class="col-lg-5">
					<p class="lead-soft mb-0" data-i18n="module.process.recurring.subtitle"><?php echo processModuleAttr('module.process.recurring.subtitle'); ?></p>
				</div>
			</div>

			<div class="process-recurring-grid">
				<?php foreach ($processRecurring as $step): ?>
					<article class="process-step-card">
						<span><?php echo htmlspecialchars($step['step'], ENT_QUOTES, 'UTF-8'); ?></span>
						<h3 data-i18n="<?php echo htmlspecialchars($step['title_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo processModuleAttr($step['title_key']); ?></h3>
						<p data-i18n="<?php echo htmlspecialchars($step['text_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo processModuleAttr($step['text_key']); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="py-6 bg-surface reveal" aria-label="<?php echo processModuleAttr('module.process.metrics.aria'); ?>">
		<div class="container">
			<div class="row g-5 align-items-center">
				<div class="col-lg-5">
					<span class="eyebrow" data-i18n="module.process.metrics.eyebrow"><?php echo processModuleAttr('module.process.metrics.eyebrow'); ?></span>
					<h2 class="section-title" data-i18n="module.process.metrics.title"><?php echo processModuleAttr('module.process.metrics.title'); ?></h2>
					<p class="lead-soft" data-i18n="module.process.metrics.subtitle"><?php echo processModuleAttr('module.process.metrics.subtitle'); ?></p>
				</div>
				<div class="col-lg-7">
					<div class="process-metric-grid">
						<?php foreach ($processMetrics as $metric): ?>
							<div class="process-metric-card">
								<strong><?php echo htmlspecialchars($metric['value'], ENT_QUOTES, 'UTF-8'); ?></strong>
								<span data-i18n="<?php echo htmlspecialchars($metric['label_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo processModuleAttr($metric['label_key']); ?></span>
								<p data-i18n="<?php echo htmlspecialchars($metric['text_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo processModuleAttr($metric['text_key']); ?></p>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="py-6 bg-card reveal" aria-label="<?php echo processModuleAttr('module.process.alerts.aria'); ?>">
		<div class="container">
			<div class="row g-5 align-items-center">
				<div class="col-lg-5">
					<span class="eyebrow" data-i18n="module.process.alerts.eyebrow"><?php echo processModuleAttr('module.process.alerts.eyebrow'); ?></span>
					<h2 class="section-title" data-i18n="module.process.alerts.title"><?php echo processModuleAttr('module.process.alerts.title'); ?></h2>
					<p class="lead-soft" data-i18n="module.process.alerts.subtitle"><?php echo processModuleAttr('module.process.alerts.subtitle'); ?></p>
				</div>
				<div class="col-lg-7">
					<div class="process-alert-stack">
						<?php foreach ($processAlerts as $alert): ?>
							<article class="process-alert-item process-alert-item-<?php echo htmlspecialchars($alert['type'], ENT_QUOTES, 'UTF-8'); ?>">
								<i class="fa-solid <?php echo htmlspecialchars($alert['icon'], ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true"></i>
								<div>
									<h3 data-i18n="<?php echo htmlspecialchars($alert['title_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo processModuleAttr($alert['title_key']); ?></h3>
									<p data-i18n="<?php echo htmlspecialchars($alert['text_key'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo processModuleAttr($alert['text_key']); ?></p>
								</div>
							</article>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="py-6 bg-surface text-center reveal" aria-label="<?php echo processModuleAttr('module.process.cta.aria'); ?>">
		<div class="container">
			<div class="cta-box cta-box-strong process-final-cta">
				<span class="eyebrow" data-i18n="module.process.cta.eyebrow"><?php echo processModuleAttr('module.process.cta.eyebrow'); ?></span>
				<h2 data-i18n="module.process.cta.title"><?php echo processModuleAttr('module.process.cta.title'); ?></h2>
				<p data-i18n="module.process.cta.text"><?php echo processModuleAttr('module.process.cta.text'); ?></p>
				<div class="d-flex flex-column flex-sm-row gap-2 justify-content-center">
					<a href="<?= getIndiceLoginUrlAttr() ?>" class="btn btn-brand btn-lg" data-i18n="nav.login"><?php echo processModuleAttr('nav.login'); ?></a>
					<a href="/modulos.php#basicos" class="btn btn-ghost btn-lg" data-i18n="module.process.cta.secondary"><?php echo processModuleAttr('module.process.cta.secondary'); ?></a>
				</div>
			</div>
		</div>
	</section>
</main>

<?php include 'footer.php'; ?>
