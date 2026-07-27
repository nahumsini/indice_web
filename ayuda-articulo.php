<?php
$articles = require __DIR__ . '/content/help-articles.php';
$slug = strtolower((string)($_GET['slug'] ?? ''));
$slug = preg_replace('/[^a-z0-9\-]/', '', $slug);
$article = null;

foreach ($articles as $candidate) {
	if ($candidate['slug'] === $slug) {
		$article = $candidate;
		break;
	}
}

if (!$article) {
	http_response_code(404);
	$page_title = "Artículo no encontrado";
	$page_description = "No encontramos el artículo solicitado en el Centro de ayuda de Índice.";
	include 'header.php';
	?>
	<section class="page-hero bg-surface reveal">
		<div class="container text-center">
			<h1 class="display-5 fw-medium mb-3" data-i18n="help.not_found.title">Artículo no encontrado</h1>
			<p class="lead lead-soft mb-4" data-i18n="help.not_found.text">La guía que buscas no existe o cambió de ubicación.</p>
			<a href="/ayuda.php" class="btn btn-brand" data-i18n="help.article.back">Volver al Centro de ayuda</a>
		</div>
	</section>
	<?php include 'footer.php'; ?>
	<?php
	exit;
}

$page_title = $article['title'];
$page_description = $article['excerpt'];
include 'header.php';
?>

<main>
	<section class="page-hero bg-surface reveal" aria-label="<?php echo htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8'); ?>">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-9 text-center">
					<span class="eyebrow"><?php echo htmlspecialchars($article['category'], ENT_QUOTES, 'UTF-8'); ?></span>
					<h1 class="display-5 fw-medium text-balance mb-3"><?php echo htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
					<p class="lead lead-soft mb-3"><?php echo htmlspecialchars($article['excerpt'], ENT_QUOTES, 'UTF-8'); ?></p>
					<p class="small text-muted mb-0">
						<span data-i18n="help.article.updated">Actualizado</span>:
						<time datetime="<?php echo htmlspecialchars($article['updated'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($article['updated'], ENT_QUOTES, 'UTF-8'); ?></time>
						<span aria-hidden="true">·</span>
						<?php echo htmlspecialchars($article['read_time'], ENT_QUOTES, 'UTF-8'); ?>
					</p>
				</div>
			</div>
		</div>
	</section>

	<section class="py-6 bg-card reveal">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-9">
					<article class="card-min p-4 p-lg-5">
						<?php foreach ($article['sections'] as $section): ?>
							<section class="mb-4">
								<h2 class="h4 fw-medium mb-3"><?php echo htmlspecialchars($section['title'], ENT_QUOTES, 'UTF-8'); ?></h2>

								<?php if (!empty($section['body'])): ?>
									<?php foreach ($section['body'] as $paragraph): ?>
										<p class="lead-soft"><?php echo htmlspecialchars($paragraph, ENT_QUOTES, 'UTF-8'); ?></p>
									<?php endforeach; ?>
								<?php endif; ?>

								<?php if (!empty($section['steps'])): ?>
									<ol class="lead-soft mb-0">
										<?php foreach ($section['steps'] as $step): ?>
											<li><?php echo htmlspecialchars($step, ENT_QUOTES, 'UTF-8'); ?></li>
										<?php endforeach; ?>
									</ol>
								<?php endif; ?>
							</section>
						<?php endforeach; ?>
					</article>

					<div class="mt-4">
						<a href="/ayuda.php" class="btn btn-ghost" data-i18n="help.article.back">Volver al Centro de ayuda</a>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>

<?php include 'footer.php'; ?>
