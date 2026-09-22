<?php
require_once __DIR__ . '/content/marketing.php';
$page_title = marketingString('contact.title');
$page_description = marketingString('contact.text');
include 'header.php';
?>
<main id="main-content" class="mk-page"><section class="mk-section mk-page-hero"><div class="mk-container"><p class="mk-eyebrow"><?= marketingText('cta.short') ?></p><h1><?= marketingText('contact.title') ?></h1><p class="mk-lead"><?= marketingText('contact.text') ?></p></div></section><section class="mk-section"><div class="mk-container mk-contact-grid"><div class="mk-contact-form"><h2><?= marketingText('contact.form') ?></h2>
<form id="contactForm" class="row g-3"><?php echo honeypotInput(); ?>
<?php foreach(['nombre'=>['name','text',true],'email'=>['email','email',true],'pais'=>['country','text',false]] as $id=>$field): ?><div class="<?= $id === 'pais' ? 'col-12' : 'col-md-6' ?>"><label class="form-label" for="<?= $id ?>"><?= marketingText('contact.'.$field[0]) ?></label><input class="form-control" type="<?= $field[1] ?>" id="<?= $id ?>" name="<?= $id ?>" maxlength="<?= $id==='email' ? 180 : ($id==='pais' ? 80 : 120) ?>" autocomplete="<?= $id==='nombre' ? 'name' : ($id==='email' ? 'email' : 'country-name') ?>" <?= $field[2] ? 'required' : '' ?>></div><?php endforeach; ?>
<div class="col-12"><label class="form-label" for="mensaje"><?= marketingText('contact.message') ?></label><textarea class="form-control" id="mensaje" name="mensaje" rows="5" maxlength="3000" required></textarea></div><div class="col-12"><button class="mk-button" type="submit"><?= marketingText('contact.send') ?><span aria-hidden="true">↗</span></button></div><div class="col-12"><div id="contactStatus" role="status" aria-live="polite"></div></div>
<div hidden><?php foreach(['sending','success','error'] as $key): ?><span data-form-copy="<?= $key ?>"><?= marketingText('contact.'.$key) ?></span><?php endforeach; ?></div>
</form></div><aside class="mk-contact-aside"><span class="mk-spark" aria-hidden="true">✦</span><h2><?= marketingText('contact.next') ?></h2><p><?= marketingText('contact.next.text') ?></p><hr><a href="mailto:contacto@indiceapp.com">contacto@indiceapp.com</a><p class="mk-fine-print">Índice Technologies Inc.<br>130 King St W, Toronto, ON, M5X1E3, Canada</p></aside></div></section></main>
<?php include 'footer.php'; ?>
