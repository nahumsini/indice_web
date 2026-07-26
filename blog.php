<?php
$page_title = "Blog";
$page_description = "Articulos y guias para mejorar la gestion de personas, procesos, productos y finanzas.";
include 'header.php';
?>

<section class="page-hero bg-surface reveal">
	<div class="container text-center">
		<h1 class="display-5 fw-bold mb-3">Blog de Indice</h1>
		<p class="lead lead-soft">Ideas practicas para ordenar, automatizar y escalar tu negocio.</p>
	</div>
</section>

<section class="py-5 bg-card">
	<div class="container">
		<div class="row g-4">
			<div class="col-lg-4 col-md-6">
				<article class="blog-card">
					<div class="blog-card-body">
						<span class="blog-category">Procesos</span>
						<h5>Como estandarizar operaciones en 30 dias</h5>
						<p class="text-muted mb-0">Una ruta simple para mapear, priorizar y ejecutar mejoras sin frenar la operacion.</p>
					</div>
				</article>
			</div>
			<div class="col-lg-4 col-md-6">
				<article class="blog-card">
					<div class="blog-card-body">
						<span class="blog-category">Finanzas</span>
						<h5>KPIs que si ayudan a decidir</h5>
						<p class="text-muted mb-0">Que indicadores mirar primero para aumentar margen y proteger flujo de caja.</p>
					</div>
				</article>
			</div>
			<div class="col-lg-4 col-md-6">
				<article class="blog-card">
					<div class="blog-card-body">
						<span class="blog-category">Personas</span>
						<h5>Onboarding operativo para equipos pequenos</h5>
						<p class="text-muted mb-0">Buenas practicas para integrar nuevos colaboradores con claridad desde el dia uno.</p>
					</div>
				</article>
			</div>
		</div>
	</div>
</section>

<?php include 'footer.php'; ?>
