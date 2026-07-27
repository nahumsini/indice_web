<?php
require_once __DIR__ . '/functions.php';

function legalTermsLoadMessages(string $locale): array {
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

$legalTermsContext = resolveSiteContext();
$legalTermsLocale = $legalTermsContext['locale'] ?? 'es-MX';
$legalTermsMessages = legalTermsLoadMessages('es-MX');
if ($legalTermsLocale !== 'es-MX') {
	$legalTermsMessages = array_merge($legalTermsMessages, legalTermsLoadMessages($legalTermsLocale));
}

function termsText(string $key): string {
	global $legalTermsMessages;
	return (string)($legalTermsMessages[$key] ?? '');
}

function termsAttr(string $key): string {
	return htmlspecialchars(termsText($key), ENT_QUOTES, 'UTF-8');
}

function termsParagraph(string $key): void {
	echo '<p class="lead-soft mb-0" data-i18n="' . htmlspecialchars($key, ENT_QUOTES, 'UTF-8') . '">'
		. termsAttr($key)
		. '</p>';
}

function termsList(array $keys): void {
	echo '<ul class="lead-soft mb-0">';
	foreach ($keys as $key) {
		echo '<li data-i18n="' . htmlspecialchars($key, ENT_QUOTES, 'UTF-8') . '">'
			. termsAttr($key)
			. '</li>';
	}
	echo '</ul>';
}

$page_title = termsText('legal.terms.meta.title');
$page_description = termsText('legal.terms.meta.description');
include 'header.php';
?>

<main>
	<section class="page-hero bg-surface reveal" aria-label="<?php echo termsAttr('legal.terms.hero.title'); ?>">
		<div class="container text-center">
			<span class="eyebrow" data-i18n="legal.terms.hero.eyebrow"><?php echo termsAttr('legal.terms.hero.eyebrow'); ?></span>
			<h1 class="display-5 fw-medium text-balance mb-3" data-i18n="legal.terms.hero.title"><?php echo termsAttr('legal.terms.hero.title'); ?></h1>
			<p class="lead lead-soft mb-3 mx-auto" style="max-width:820px;" data-i18n="legal.terms.hero.subtitle"><?php echo termsAttr('legal.terms.hero.subtitle'); ?></p>
			<p class="small text-muted mb-0">
				<span data-i18n="legal.common.last_updated_label"><?php echo termsAttr('legal.common.last_updated_label'); ?></span>
				<time datetime="2026-05-13" data-i18n="legal.common.last_updated_date"><?php echo termsAttr('legal.common.last_updated_date'); ?></time>
			</p>
		</div>
	</section>

	<section class="py-6 bg-card reveal">
		<div class="container">
			<div class="row g-4">
				<div class="col-lg-7">
					<div class="card-min p-4 p-lg-5 h-100">
						<h2 class="h3 fw-medium mb-3" data-i18n="legal.terms.intro.title"><?php echo termsAttr('legal.terms.intro.title'); ?></h2>
						<?php termsParagraph('legal.terms.intro.text'); ?>
					</div>
				</div>

				<div class="col-lg-5">
					<div class="card-min p-4 h-100">
						<h2 class="h4 fw-medium mb-3" data-i18n="legal.terms.operator.title"><?php echo termsAttr('legal.terms.operator.title'); ?></h2>
						<p class="lead-soft mb-3" data-i18n="legal.terms.operator.text"><?php echo termsAttr('legal.terms.operator.text'); ?></p>
						<address class="lead-soft mb-0" style="font-style:normal;">
							<strong>Índice Technologies Inc.</strong><br>
							130 King St W, Toronto, ON, M5X1E3, Canada<br>
							<a href="mailto:contacto@indiceapp.com">contacto@indiceapp.com</a>
						</address>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="py-6 bg-surface reveal">
		<div class="container">
			<div class="row g-4">
				<div class="col-lg-6">
					<div class="card-min p-4 h-100">
						<h2 class="h4 fw-medium mb-3" data-i18n="legal.terms.site.title"><?php echo termsAttr('legal.terms.site.title'); ?></h2>
						<?php termsParagraph('legal.terms.site.text'); ?>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="card-min p-4 h-100">
						<h2 class="h4 fw-medium mb-3" data-i18n="legal.terms.use.title"><?php echo termsAttr('legal.terms.use.title'); ?></h2>
						<?php termsList([
							'legal.terms.use.item_1',
							'legal.terms.use.item_2',
							'legal.terms.use.item_3',
							'legal.terms.use.item_4',
							'legal.terms.use.item_5',
						]); ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="py-6 bg-card reveal">
		<div class="container">
			<div class="row g-4">
				<div class="col-lg-4">
					<div class="card-min p-4 h-100">
						<h2 class="h4 fw-medium mb-3" data-i18n="legal.terms.accounts.title"><?php echo termsAttr('legal.terms.accounts.title'); ?></h2>
						<?php termsParagraph('legal.terms.accounts.text'); ?>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="card-min p-4 h-100">
						<h2 class="h4 fw-medium mb-3" data-i18n="legal.terms.plans.title"><?php echo termsAttr('legal.terms.plans.title'); ?></h2>
						<?php termsParagraph('legal.terms.plans.text'); ?>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="card-min p-4 h-100">
						<h2 class="h4 fw-medium mb-3" data-i18n="legal.terms.payments.title"><?php echo termsAttr('legal.terms.payments.title'); ?></h2>
						<?php termsParagraph('legal.terms.payments.text'); ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="py-6 bg-surface reveal">
		<div class="container">
			<div class="row g-4">
				<div class="col-md-6">
					<div class="card-min p-4 h-100">
						<h2 class="h4 fw-medium mb-3" data-i18n="legal.terms.ip.title"><?php echo termsAttr('legal.terms.ip.title'); ?></h2>
						<?php termsParagraph('legal.terms.ip.text'); ?>
					</div>
				</div>

				<div class="col-md-6">
					<div class="card-min p-4 h-100">
						<h2 class="h4 fw-medium mb-3" data-i18n="legal.terms.third_party.title"><?php echo termsAttr('legal.terms.third_party.title'); ?></h2>
						<?php termsParagraph('legal.terms.third_party.text'); ?>
					</div>
				</div>

				<div class="col-md-6">
					<div class="card-min p-4 h-100">
						<h2 class="h4 fw-medium mb-3" data-i18n="legal.terms.availability.title"><?php echo termsAttr('legal.terms.availability.title'); ?></h2>
						<?php termsParagraph('legal.terms.availability.text'); ?>
					</div>
				</div>

				<div class="col-md-6">
					<div class="card-min p-4 h-100">
						<h2 class="h4 fw-medium mb-3" data-i18n="legal.terms.liability.title"><?php echo termsAttr('legal.terms.liability.title'); ?></h2>
						<?php termsParagraph('legal.terms.liability.text'); ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="py-6 bg-card reveal">
		<div class="container">
			<div class="row g-4">
				<div class="col-lg-4">
					<div class="card-min p-4 h-100">
						<h2 class="h4 fw-medium mb-3" data-i18n="legal.terms.privacy.title"><?php echo termsAttr('legal.terms.privacy.title'); ?></h2>
						<?php termsParagraph('legal.terms.privacy.text'); ?>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="card-min p-4 h-100">
						<h2 class="h4 fw-medium mb-3" data-i18n="legal.terms.law.title"><?php echo termsAttr('legal.terms.law.title'); ?></h2>
						<?php termsParagraph('legal.terms.law.text'); ?>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="card-min p-4 h-100">
						<h2 class="h4 fw-medium mb-3" data-i18n="legal.terms.changes.title"><?php echo termsAttr('legal.terms.changes.title'); ?></h2>
						<?php termsParagraph('legal.terms.changes.text'); ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="py-6 bg-surface text-center reveal">
		<div class="container">
			<div class="cta-box cta-box-strong">
				<h2 data-i18n="legal.terms.contact.title"><?php echo termsAttr('legal.terms.contact.title'); ?></h2>
				<p data-i18n="legal.terms.contact.text"><?php echo termsAttr('legal.terms.contact.text'); ?></p>
				<a href="mailto:contacto@indiceapp.com" class="btn btn-brand btn-lg" data-i18n="legal.terms.contact.button"><?php echo termsAttr('legal.terms.contact.button'); ?></a>
			</div>
		</div>
	</section>
</main>

<?php include 'footer.php'; ?>
