<?php
require_once __DIR__ . '/content/marketing.php';
$page_title = marketingString('about.title');
$page_description = marketingString('about.text');
include 'header.php';
?>
<main id="main-content" class="mk-page"><section class="mk-section mk-page-hero"><div class="mk-container"><p class="mk-eyebrow">Índice</p><h1><?= marketingText('about.title') ?></h1><p class="mk-lead"><?= marketingText('about.text') ?></p><a class="mk-button" href="/contacto.php"><?= marketingText('cta') ?> ↗</a></div></section><section class="mk-section"><div class="mk-container"><div class="mk-value-grid"><?php foreach(['one','two','three'] as $i=>$key): ?><article><span class="mk-outline-number" aria-hidden="true">0<?= $i+1 ?></span><h2><?= marketingText('value.'.$key) ?></h2><p><?= marketingText('value.'.$key.'.text') ?></p></article><?php endforeach; ?></div></div></section><?php marketingClosing(); ?></main>
<?php include 'footer.php'; ?>
