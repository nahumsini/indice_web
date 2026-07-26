<?php
$articles = require __DIR__ . '/content/help-articles.php';
$page_title = "Centro de ayuda";
$page_description = "Artículos y guías para aprender a usar Índice paso a paso.";
include 'header.php';

$categories = [];
foreach ($articles as $article) {
	$categories[$article['category']] = true;
}
?>

<main>
	<section class="page-hero bg-surface reveal" aria-label="Centro de ayuda">
		<div class="container text-center">
			<span class="eyebrow" data-i18n="help.hero.eyebrow">Guías del sistema</span>
			<h1 class="display-5 fw-bold mb-3" data-i18n="help.hero.title">Centro de ayuda</h1>
			<p class="lead lead-soft mx-auto mb-4" style="max-width:760px;" data-i18n="help.hero.subtitle">
				Artículos prácticos para configurar Índice, usar módulos y resolver dudas del día a día.
			</p>
			<div class="d-flex flex-wrap gap-2 justify-content-center">
				<a href="#articulos" class="btn btn-brand" data-i18n="help.hero.cta.primary">Ver artículos</a>
				<a href="/contacto.php#demo" class="btn btn-ghost" data-i18n="help.hero.cta.secondary">Pedir ayuda</a>
			</div>
		</div>
	</section>

	<section class="py-5 bg-card reveal" aria-label="Categorías de ayuda">
		<div class="container">
			<div class="text-center mb-4">
				<h2 class="section-title" data-i18n="help.categories.title">Temas principales</h2>
				<p class="lead-soft" data-i18n="help.categories.subtitle">Empieza por el área que quieres ordenar o aprender.</p>
			</div>
			<div class="d-flex flex-wrap gap-2 justify-content-center">
				<?php foreach (array_keys($categories) as $category): ?>
					<span class="module-chip module-theme-dashboard"><?php echo htmlspecialchars($category, ENT_QUOTES, 'UTF-8'); ?></span>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="py-6 bg-surface reveal" id="articulos" aria-label="Artículos de ayuda">
		<div class="container">
			<div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3 mb-4">
				<div>
					<span class="eyebrow" data-i18n="help.articles.eyebrow">Base de conocimiento</span>
					<h2 class="section-title mb-0" data-i18n="help.articles.title">Artículos para usar Índice</h2>
				</div>
				<p class="lead-soft mb-0" data-i18n="help.articles.subtitle">Contenido interno, seguro y editable desde el sitio.</p>
			</div>

			<div class="row g-4">
				<?php foreach ($articles as $article): ?>
					<div class="col-md-6 col-lg-4">
						<article class="blog-card h-100">
							<div class="blog-card-body">
								<span class="blog-category"><?php echo htmlspecialchars($article['category'], ENT_QUOTES, 'UTF-8'); ?></span>
								<h3 class="h5"><?php echo htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
								<p class="text-muted"><?php echo htmlspecialchars($article['excerpt'], ENT_QUOTES, 'UTF-8'); ?></p>
								<div class="d-flex justify-content-between align-items-center gap-3 mt-3">
									<span class="small text-muted"><?php echo htmlspecialchars($article['read_time'], ENT_QUOTES, 'UTF-8'); ?></span>
									<a class="fw-semibold" href="/ayuda-articulo.php?slug=<?php echo urlencode($article['slug']); ?>" data-i18n="help.article.read">Leer artículo</a>
								</div>
							</div>
						</article>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="py-6 bg-card text-center reveal">
		<div class="container">
			<div class="cta-box cta-box-strong">
				<h2 data-i18n="help.cta.title">¿Falta una guía?</h2>
				<p data-i18n="help.cta.text">Podemos agregar nuevos artículos conforme aparezcan dudas reales de clientes y usuarios.</p>
				<a href="/contacto.php#demo" class="btn btn-brand btn-lg" data-i18n="help.cta.button">Solicitar ayuda</a>
			</div>
		</div>
	</section>
</main>

<?php include 'footer.php'; ?>
