<?php
require_once __DIR__ . '/functions.php';

function loadLearningLocaleMessages(string $locale): array {
	$filePath = __DIR__ . '/i18n/' . $locale . '.json';
	if (!is_file($filePath)) {
		return [];
	}

	$decoded = json_decode((string)file_get_contents($filePath), true);
	return is_array($decoded) ? $decoded : [];
}

$learningContext = resolveSiteContext();
$learningLocale = $learningContext['locale'] ?? 'es-MX';
$learningMessages = loadLearningLocaleMessages('es-MX');
if ($learningLocale !== 'es-MX') {
	$learningMessages = array_merge($learningMessages, loadLearningLocaleMessages($learningLocale));
}

function learningText(string $key): string {
	global $learningMessages;
	return (string)($learningMessages[$key] ?? '');
}

function learningAttr(string $key): string {
	return htmlspecialchars(learningText($key), ENT_QUOTES, 'UTF-8');
}

$page_title = learningText('learning.meta.title');
$page_description = learningText('learning.meta.description');

$learningCapabilities = [
	['icon' => 'fa-circle-info', 'key' => 'learning.item1'],
	['icon' => 'fa-lightbulb', 'key' => 'learning.item2'],
	['icon' => 'fa-building-circle-check', 'key' => 'learning.item3'],
	['icon' => 'fa-route', 'key' => 'learning.item4'],
	['icon' => 'fa-chart-line', 'key' => 'learning.item5'],
	['icon' => 'fa-arrow-pointer', 'key' => 'learning.item6'],
];

$learningSteps = [
	['number' => '01', 'title' => 'learning.path.step1.title', 'desc' => 'learning.path.step1.desc', 'tone' => 'blue'],
	['number' => '02', 'title' => 'learning.path.step2.title', 'desc' => 'learning.path.step2.desc', 'tone' => 'aqua'],
	['number' => '03', 'title' => 'learning.path.step3.title', 'desc' => 'learning.path.step3.desc', 'tone' => 'yellow'],
	['number' => '04', 'title' => 'learning.path.step4.title', 'desc' => 'learning.path.step4.desc', 'tone' => 'coral'],
];

$learningCases = [
	['emoji' => '☕', 'title' => 'learning.cases.emily.title', 'desc' => 'learning.cases.emily.desc', 'tone' => 'blue'],
	['emoji' => '🛒', 'title' => 'learning.cases.juanito.title', 'desc' => 'learning.cases.juanito.desc', 'tone' => 'coral'],
	['emoji' => '🔧', 'title' => 'learning.cases.camila.title', 'desc' => 'learning.cases.camila.desc', 'tone' => 'yellow'],
];

include 'header.php';
?>

<main class="learning-page">
	<section class="learning-hero reveal" aria-label="<?= learningAttr('learning.hero.title') ?>">
		<div class="container">
			<div class="row align-items-center g-5">
				<div class="col-lg-7">
					<span class="eyebrow" data-i18n="learning.hero.eyebrow"><?= learningAttr('learning.hero.eyebrow') ?></span>
					<h1 class="display-4 fw-medium text-balance mb-3" data-i18n="learning.hero.title"><?= learningAttr('learning.hero.title') ?></h1>
					<p class="lead lead-soft mb-4" data-i18n="learning.hero.subtitle"><?= learningAttr('learning.hero.subtitle') ?></p>
					<div class="d-flex flex-column flex-sm-row gap-2 hero-actions">
						<a href="<?= getIndiceLoginUrlAttr() ?>" class="btn btn-brand btn-lg" data-i18n="learning.hero.primary"><?= learningAttr('learning.hero.primary') ?></a>
						<a href="#como-aprendes" class="btn btn-ghost btn-lg" data-i18n="learning.hero.secondary"><?= learningAttr('learning.hero.secondary') ?></a>
					</div>
					<p class="hero-microcopy mt-3" data-i18n="learning.hero.microcopy"><?= learningAttr('learning.hero.microcopy') ?></p>
				</div>
				<div class="col-lg-5">
					<div class="learning-guide-preview" aria-hidden="true">
						<div class="learning-guide-preview__head">
							<span><i class="fa-solid fa-graduation-cap"></i></span>
							<div>
								<small data-i18n="nav.apprentice"><?= learningAttr('nav.apprentice') ?></small>
								<strong data-i18n="learning.preview.title"><?= learningAttr('learning.preview.title') ?></strong>
							</div>
							<em>2/4</em>
						</div>
						<div class="learning-guide-preview__body">
							<div class="learning-guide-preview__function">
								<span>💡</span>
								<small data-i18n="learning.preview.label"><?= learningAttr('learning.preview.label') ?></small>
								<strong data-i18n="learning.preview.function"><?= learningAttr('learning.preview.function') ?></strong>
								<p data-i18n="learning.preview.explanation"><?= learningAttr('learning.preview.explanation') ?></p>
							</div>
							<div class="learning-guide-preview__example">
								<span class="learning-guide-preview__avatar">☕</span>
								<small data-i18n="learning.preview.example_label"><?= learningAttr('learning.preview.example_label') ?></small>
								<strong data-i18n="learning.cases.emily.title"><?= learningAttr('learning.cases.emily.title') ?></strong>
								<p data-i18n="learning.preview.example"><?= learningAttr('learning.preview.example') ?></p>
							</div>
						</div>
						<div class="learning-guide-preview__progress"><span></span><span class="active"></span><span></span><span></span></div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="py-6 bg-card reveal" id="como-aprendes">
		<div class="container">
			<div class="text-center mb-5">
				<span class="eyebrow" data-i18n="learning.how.eyebrow"><?= learningAttr('learning.how.eyebrow') ?></span>
				<h2 class="section-title" data-i18n="learning.title"><?= learningAttr('learning.title') ?></h2>
				<p class="lead-soft mx-auto" style="max-width:780px;" data-i18n="learning.desc"><?= learningAttr('learning.desc') ?></p>
			</div>
			<div class="learning-capability-grid">
				<?php foreach ($learningCapabilities as $capability): ?>
					<article>
						<i class="fa-solid <?= htmlspecialchars($capability['icon'], ENT_QUOTES, 'UTF-8') ?>" aria-hidden="true"></i>
						<h3 data-i18n="<?= htmlspecialchars($capability['key'], ENT_QUOTES, 'UTF-8') ?>"><?= learningAttr($capability['key']) ?></h3>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="py-6 bg-surface reveal">
		<div class="container">
			<div class="row align-items-end g-4 mb-5">
				<div class="col-lg-7">
					<span class="eyebrow" data-i18n="learning.path.eyebrow"><?= learningAttr('learning.path.eyebrow') ?></span>
					<h2 class="section-title mb-0" data-i18n="learning.path.title"><?= learningAttr('learning.path.title') ?></h2>
				</div>
				<div class="col-lg-5">
					<p class="lead-soft mb-0" data-i18n="learning.path.desc"><?= learningAttr('learning.path.desc') ?></p>
				</div>
			</div>
			<div class="learning-path-grid">
				<?php foreach ($learningSteps as $step): ?>
					<article class="learning-step learning-step--<?= htmlspecialchars($step['tone'], ENT_QUOTES, 'UTF-8') ?>">
						<span><?= htmlspecialchars($step['number'], ENT_QUOTES, 'UTF-8') ?></span>
						<h3 data-i18n="<?= htmlspecialchars($step['title'], ENT_QUOTES, 'UTF-8') ?>"><?= learningAttr($step['title']) ?></h3>
						<p data-i18n="<?= htmlspecialchars($step['desc'], ENT_QUOTES, 'UTF-8') ?>"><?= learningAttr($step['desc']) ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="py-6 bg-card reveal">
		<div class="container">
			<div class="text-center mb-5">
				<span class="eyebrow" data-i18n="learning.cases.eyebrow"><?= learningAttr('learning.cases.eyebrow') ?></span>
				<h2 class="section-title" data-i18n="learning.cases.title"><?= learningAttr('learning.cases.title') ?></h2>
				<p class="lead-soft mx-auto" style="max-width:760px;" data-i18n="learning.cases.desc"><?= learningAttr('learning.cases.desc') ?></p>
			</div>
			<div class="row g-4">
				<?php foreach ($learningCases as $case): ?>
					<div class="col-lg-4">
						<article class="learning-case learning-case--<?= htmlspecialchars($case['tone'], ENT_QUOTES, 'UTF-8') ?> h-100">
							<span class="learning-case__emoji" aria-hidden="true"><?= htmlspecialchars($case['emoji'], ENT_QUOTES, 'UTF-8') ?></span>
							<h3 data-i18n="<?= htmlspecialchars($case['title'], ENT_QUOTES, 'UTF-8') ?>"><?= learningAttr($case['title']) ?></h3>
							<p data-i18n="<?= htmlspecialchars($case['desc'], ENT_QUOTES, 'UTF-8') ?>"><?= learningAttr($case['desc']) ?></p>
						</article>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="py-6 bg-surface reveal">
		<div class="container">
			<div class="learning-outcome">
				<div>
					<span class="eyebrow" data-i18n="learning.outcome.eyebrow"><?= learningAttr('learning.outcome.eyebrow') ?></span>
					<h2 class="section-title" data-i18n="learning.outcome.title"><?= learningAttr('learning.outcome.title') ?></h2>
					<p class="lead-soft mb-0" data-i18n="learning.outcome.desc"><?= learningAttr('learning.outcome.desc') ?></p>
				</div>
				<ul>
					<li><i class="fa-solid fa-check"></i><span data-i18n="learning.outcome.item1"><?= learningAttr('learning.outcome.item1') ?></span></li>
					<li><i class="fa-solid fa-check"></i><span data-i18n="learning.outcome.item2"><?= learningAttr('learning.outcome.item2') ?></span></li>
					<li><i class="fa-solid fa-check"></i><span data-i18n="learning.outcome.item3"><?= learningAttr('learning.outcome.item3') ?></span></li>
					<li><i class="fa-solid fa-check"></i><span data-i18n="learning.outcome.item4"><?= learningAttr('learning.outcome.item4') ?></span></li>
				</ul>
			</div>
		</div>
	</section>

	<section class="py-6 bg-card text-center reveal">
		<div class="container">
			<div class="cta-box cta-box-strong">
				<h2 data-i18n="learning.cta.title"><?= learningAttr('learning.cta.title') ?></h2>
				<p data-i18n="learning.cta.desc"><?= learningAttr('learning.cta.desc') ?></p>
				<div class="d-flex flex-column flex-sm-row gap-2 justify-content-center mt-4">
					<a href="<?= getIndiceLoginUrlAttr() ?>" class="btn btn-brand btn-lg" data-i18n="learning.cta.primary"><?= learningAttr('learning.cta.primary') ?></a>
					<a href="/modulos.php#basicos" class="btn btn-ghost btn-lg" data-i18n="learning.cta.secondary"><?= learningAttr('learning.cta.secondary') ?></a>
				</div>
			</div>
		</div>
	</section>
</main>

<?php include 'footer.php'; ?>
