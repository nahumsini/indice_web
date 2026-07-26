<?php
require_once __DIR__ . '/functions.php';

function legalPrivacyLoadMessages(string $locale): array {
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

$legalPrivacyContext = resolveSiteContext();
$legalPrivacyLocale = $legalPrivacyContext['locale'] ?? 'es-MX';
$legalPrivacyMessages = legalPrivacyLoadMessages('es-MX');
if ($legalPrivacyLocale !== 'es-MX') {
	$legalPrivacyMessages = array_merge($legalPrivacyMessages, legalPrivacyLoadMessages($legalPrivacyLocale));
}

function privacyText(string $key): string {
	global $legalPrivacyMessages;
	return (string)($legalPrivacyMessages[$key] ?? '');
}

function privacyAttr(string $key): string {
	return htmlspecialchars(privacyText($key), ENT_QUOTES, 'UTF-8');
}

function privacyParagraph(string $key): void {
	echo '<p class="lead-soft mb-0" data-i18n="' . htmlspecialchars($key, ENT_QUOTES, 'UTF-8') . '">'
		. privacyAttr($key)
		. '</p>';
}

function privacyList(array $keys): void {
	echo '<ul class="lead-soft mb-0">';
	foreach ($keys as $key) {
		echo '<li data-i18n="' . htmlspecialchars($key, ENT_QUOTES, 'UTF-8') . '">'
			. privacyAttr($key)
			. '</li>';
	}
	echo '</ul>';
}

$page_title = privacyText('legal.privacy.meta.title');
$page_description = privacyText('legal.privacy.meta.description');
include 'header.php';
?>

<main>
	<section class="page-hero bg-surface reveal" aria-label="<?php echo privacyAttr('legal.privacy.hero.title'); ?>">
		<div class="container text-center">
			<span class="eyebrow" data-i18n="legal.privacy.hero.eyebrow"><?php echo privacyAttr('legal.privacy.hero.eyebrow'); ?></span>
			<h1 class="display-5 fw-bold text-balance mb-3" data-i18n="legal.privacy.hero.title"><?php echo privacyAttr('legal.privacy.hero.title'); ?></h1>
			<p class="lead lead-soft mb-3 mx-auto" style="max-width:820px;" data-i18n="legal.privacy.hero.subtitle"><?php echo privacyAttr('legal.privacy.hero.subtitle'); ?></p>
			<p class="small text-muted mb-0">
				<span data-i18n="legal.common.last_updated_label"><?php echo privacyAttr('legal.common.last_updated_label'); ?></span>
				<time datetime="2026-05-13" data-i18n="legal.common.last_updated_date"><?php echo privacyAttr('legal.common.last_updated_date'); ?></time>
			</p>
		</div>
	</section>

	<section class="py-6 bg-card reveal">
		<div class="container">
			<div class="row g-4">
				<div class="col-lg-4">
					<div class="card-min p-4 h-100">
						<h2 class="h4 fw-bold mb-3" data-i18n="legal.privacy.responsible.title"><?php echo privacyAttr('legal.privacy.responsible.title'); ?></h2>
						<p class="lead-soft mb-3" data-i18n="legal.privacy.responsible.text"><?php echo privacyAttr('legal.privacy.responsible.text'); ?></p>
						<address class="lead-soft mb-0" style="font-style:normal;">
							<strong>Índice Technologies Inc.</strong><br>
							130 King St W, Toronto, ON, M5X1E3, Canada<br>
							<a href="mailto:contacto@indiceapp.com">contacto@indiceapp.com</a>
						</address>
					</div>
				</div>

				<div class="col-lg-8">
					<div class="card-min p-4 p-lg-5 h-100">
						<h2 class="h3 fw-bold mb-3" data-i18n="legal.privacy.intro.title"><?php echo privacyAttr('legal.privacy.intro.title'); ?></h2>
						<?php privacyParagraph('legal.privacy.intro.text'); ?>
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
						<h2 class="h4 fw-bold mb-3" data-i18n="legal.privacy.data.title"><?php echo privacyAttr('legal.privacy.data.title'); ?></h2>
						<p class="lead-soft" data-i18n="legal.privacy.data.text"><?php echo privacyAttr('legal.privacy.data.text'); ?></p>
						<?php privacyList([
							'legal.privacy.data.item_1',
							'legal.privacy.data.item_2',
							'legal.privacy.data.item_3',
							'legal.privacy.data.item_4',
							'legal.privacy.data.item_5',
							'legal.privacy.data.item_6',
							'legal.privacy.data.item_7',
						]); ?>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="card-min p-4 h-100">
						<h2 class="h4 fw-bold mb-3" data-i18n="legal.privacy.uses.title"><?php echo privacyAttr('legal.privacy.uses.title'); ?></h2>
						<?php privacyList([
							'legal.privacy.uses.item_1',
							'legal.privacy.uses.item_2',
							'legal.privacy.uses.item_3',
							'legal.privacy.uses.item_4',
							'legal.privacy.uses.item_5',
							'legal.privacy.uses.item_6',
							'legal.privacy.uses.item_7',
						]); ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="py-6 bg-card reveal">
		<div class="container">
			<div class="row g-4">
				<div class="col-lg-6">
					<div class="card-min p-4 h-100">
						<h2 class="h4 fw-bold mb-3" data-i18n="legal.privacy.sharing.title"><?php echo privacyAttr('legal.privacy.sharing.title'); ?></h2>
						<p class="lead-soft" data-i18n="legal.privacy.sharing.text"><?php echo privacyAttr('legal.privacy.sharing.text'); ?></p>
						<?php privacyList([
							'legal.privacy.sharing.item_1',
							'legal.privacy.sharing.item_2',
							'legal.privacy.sharing.item_3',
							'legal.privacy.sharing.item_4',
							'legal.privacy.sharing.item_5',
							'legal.privacy.sharing.item_6',
						]); ?>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="card-min p-4 h-100">
						<h2 class="h4 fw-bold mb-3" data-i18n="legal.privacy.transfers.title"><?php echo privacyAttr('legal.privacy.transfers.title'); ?></h2>
						<?php privacyParagraph('legal.privacy.transfers.text'); ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="py-6 bg-surface reveal">
		<div class="container">
			<div class="row g-4">
				<div class="col-md-6 col-lg-4">
					<div class="card-min p-4 h-100">
						<h2 class="h4 fw-bold mb-3" data-i18n="legal.privacy.retention.title"><?php echo privacyAttr('legal.privacy.retention.title'); ?></h2>
						<?php privacyParagraph('legal.privacy.retention.text'); ?>
					</div>
				</div>

				<div class="col-md-6 col-lg-4">
					<div class="card-min p-4 h-100">
						<h2 class="h4 fw-bold mb-3" data-i18n="legal.privacy.cookies.title"><?php echo privacyAttr('legal.privacy.cookies.title'); ?></h2>
						<?php privacyParagraph('legal.privacy.cookies.text'); ?>
					</div>
				</div>

				<div class="col-md-6 col-lg-4">
					<div class="card-min p-4 h-100">
						<h2 class="h4 fw-bold mb-3" data-i18n="legal.privacy.security.title"><?php echo privacyAttr('legal.privacy.security.title'); ?></h2>
						<?php privacyParagraph('legal.privacy.security.text'); ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="py-6 bg-card reveal">
		<div class="container">
			<div class="card-min p-4 p-lg-5">
				<h2 class="h3 fw-bold mb-3" data-i18n="legal.privacy.rights.title"><?php echo privacyAttr('legal.privacy.rights.title'); ?></h2>
				<p class="lead-soft" data-i18n="legal.privacy.rights.text"><?php echo privacyAttr('legal.privacy.rights.text'); ?></p>
				<?php privacyList([
					'legal.privacy.rights.item_1',
					'legal.privacy.rights.item_2',
					'legal.privacy.rights.item_3',
					'legal.privacy.rights.item_4',
					'legal.privacy.rights.item_5',
				]); ?>
				<p class="lead-soft mt-3 mb-0" data-i18n="legal.privacy.rights.note"><?php echo privacyAttr('legal.privacy.rights.note'); ?></p>
			</div>
		</div>
	</section>

	<section class="py-6 bg-surface reveal">
		<div class="container">
			<div class="row g-4">
				<div class="col-lg-6">
					<div class="card-min p-4 h-100">
						<h2 class="h4 fw-bold mb-3" data-i18n="legal.privacy.minors.title"><?php echo privacyAttr('legal.privacy.minors.title'); ?></h2>
						<?php privacyParagraph('legal.privacy.minors.text'); ?>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="card-min p-4 h-100">
						<h2 class="h4 fw-bold mb-3" data-i18n="legal.privacy.changes.title"><?php echo privacyAttr('legal.privacy.changes.title'); ?></h2>
						<?php privacyParagraph('legal.privacy.changes.text'); ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="py-6 bg-card text-center reveal">
		<div class="container">
			<div class="cta-box cta-box-strong">
				<h2 data-i18n="legal.privacy.contact.title"><?php echo privacyAttr('legal.privacy.contact.title'); ?></h2>
				<p data-i18n="legal.privacy.contact.text"><?php echo privacyAttr('legal.privacy.contact.text'); ?></p>
				<a href="mailto:contacto@indiceapp.com" class="btn btn-brand btn-lg" data-i18n="legal.privacy.contact.button"><?php echo privacyAttr('legal.privacy.contact.button'); ?></a>
			</div>
		</div>
	</section>
</main>

<?php include 'footer.php'; ?>
