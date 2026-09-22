<?php
require_once __DIR__ . '/content/marketing.php';
$page_title = marketingString('implementation.eyebrow');
$page_description = marketingString('implementation.text');
include 'header.php';
?>
<main id="main-content" class="mk-page"><section class="mk-section mk-page-hero"><div class="mk-container"><p class="mk-eyebrow"><?= marketingText('implementation.eyebrow') ?></p><h1><?= marketingText('implementation.title') ?></h1><p class="mk-lead"><?= marketingText('implementation.text') ?></p><a class="mk-button" href="/contacto.php"><?= marketingText('cta') ?><span aria-hidden="true">↗</span></a></div></section><section class="mk-section"><div class="mk-container"><?php marketingSteps(); ?></div></section><section class="mk-section mk-soft"><div class="mk-container mk-split"><div><h2><?= marketingText('lupita.title') ?></h2><p class="mk-lead"><?= marketingText('lupita.text') ?></p><a class="mk-text-link" href="/index.php#lupita"><?= marketingText('nav.agents') ?> →</a></div><div class="mk-info-card"><h3><?= marketingText('learn.title') ?></h3><p><?= marketingText('learn.text') ?></p><a class="mk-text-link" href="/modo-aprendiz.php"><?= marketingText('learn.link') ?> →</a></div></div></section><?php marketingClosing(); ?></main>
<?php include 'footer.php'; ?>
