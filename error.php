<?php
$error_code = preg_replace('/[^0-9]/', '', (string)($_GET['code'] ?? '404'));
if ($error_code === '') {
	$error_code = '404';
}
$page_title = "Error $error_code";
$page_description = "Ha ocurrido un error en la pagina solicitada.";
include 'header.php';
?>

<section class="py-5 bg-surface" style="min-height:60vh;">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 mx-auto text-center">
				<h1 class="display-1 fw-bold text-primary mb-3"><?php echo htmlspecialchars($error_code); ?></h1>
				<p class="lead mb-4">No pudimos mostrar la pagina solicitada.</p>
				<a href="/index.php" class="btn btn-brand btn-lg">Volver al inicio</a>
			</div>
		</div>
	</div>
</section>

<?php include 'footer.php'; ?>
