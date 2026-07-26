<?php
$page_title = "Contacto";
$page_description = "Contáctanos para solicitar una demo y conocer cómo Índice puede ayudarte a escalar tu empresa.";
include 'header.php';
?>

<section class="page-hero bg-surface reveal" id="demo">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 mx-auto text-center">
				<h1 class="display-5 fw-bold mb-3">Hablemos de tu empresa</h1>
				<p class="lead lead-soft">Cuéntanos tu operación actual y te mostramos cómo implementar Índice paso a paso.</p>
			</div>
		</div>
	</div>
</section>

<section class="py-5 bg-card">
	<div class="container">
		<div class="row g-4">
			<div class="col-lg-7">
				<div class="card-min p-4 h-100">
					<h2 class="h4 fw-bold mb-3">Envíanos un mensaje</h2>
					<form id="contactForm" class="row g-3">
						<?php echo honeypotInput(); ?>
						<div class="col-md-6">
							<label for="nombre" class="form-label">Nombre</label>
							<input type="text" id="nombre" name="nombre" class="form-control" required>
						</div>
						<div class="col-md-6">
							<label for="email" class="form-label">Email</label>
							<input type="email" id="email" name="email" class="form-control" required>
						</div>
						<div class="col-md-6">
							<label for="pais" class="form-label">País</label>
							<input type="text" id="pais" name="pais" class="form-control">
						</div>
						<div class="col-12">
							<label for="mensaje" class="form-label">Mensaje</label>
							<textarea id="mensaje" name="mensaje" class="form-control" rows="5" required></textarea>
						</div>
						<div class="col-12">
							<button type="submit" class="btn btn-brand btn-lg">Enviar mensaje</button>
						</div>
						<div class="col-12">
							<div id="contactStatus" class="small"></div>
						</div>
					</form>
				</div>
			</div>

			<div class="col-lg-5">
				<div class="card-min p-4 h-100 company-info">
					<h3 class="h5 fw-bold mb-2">Contáctanos directamente</h3>
					<p class="lead-soft mb-3">Si tienes dudas o quieres conocer cómo Índice puede ayudarte, escríbenos o agenda una demo.</p>

					<p class="mb-2">
						<strong>Correo:</strong>
						<a href="mailto:contacto@indiceapp.com">contacto@indiceapp.com</a>
					</p>
					<p class="mb-2"><strong>Horario:</strong> Lunes a Viernes, 9:00 a 18:00</p>
					<p class="mb-3"><strong>Soporte:</strong> 24/7 para clientes activos</p>

					<hr class="my-3">

					<address class="mb-0" style="font-style:normal;">
						<strong>Índice Technologies Inc.</strong><br>
						130 King St W, Toronto, ON, M5X1E3, Canada<br>
						<span class="text-muted">Exchange Tower</span>
					</address>
				</div>
			</div>
		</div>
	</div>
</section>

<?php include 'footer.php'; ?>
