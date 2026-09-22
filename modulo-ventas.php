<?php
require_once __DIR__ . '/content/marketing.php';
require_once __DIR__ . '/content/module-basic-pages.php';
$page_title = basicModuleText('modules.core.sales.title');
$page_description = marketingString('salesShowcase.intro');
$screenshotSizes = ['pipeline'=>[1447,1087],'quotes'=>[1447,1087],'commissions'=>[1446,1087]];
include 'header.php';
?>
<main id="main-content" class="mk-page mk-hr-showcase mk-inventory-showcase">
<section class="mk-section mk-page-hero"><div class="mk-container">
<a class="mk-text-link" href="/modulos.php">← <?= marketingText('panel.back') ?></a>
<p class="mk-eyebrow"><span aria-hidden="true">💼</span><span data-i18n="modules.core.sales.title"><?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?></span></p>
<h1><?= marketingText('salesShowcase.title') ?></h1><p class="mk-lead"><?= marketingText('salesShowcase.intro') ?></p>
<div class="mk-actions"><a class="mk-button" href="/contacto.php"><?= marketingText('cta') ?> ↗</a><a class="mk-text-link" href="/planes.php"><?= marketingText('plans.link') ?> →</a></div>
<nav class="mk-hr-jump" aria-label="<?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?>"><?php foreach (['pipeline','quotes','commissions'] as $view): ?><a href="#sales-<?= $view ?>"><?= marketingText('salesShowcase.'.$view.'.title') ?> ↓</a><?php endforeach; ?></nav>
</div></section>
<?php foreach (['pipeline','quotes','commissions'] as $index=>$view): ?>
<section id="sales-<?= $view ?>" class="mk-section <?= $index===1 ? 'mk-soft' : '' ?>"><div class="mk-container mk-hr-view">
<div><p class="mk-eyebrow">0<?= $index+1 ?></p><h2><?= marketingText('salesShowcase.'.$view.'.title') ?></h2><p class="mk-lead"><?= marketingText('salesShowcase.'.$view.'.text') ?></p><p><?= marketingText('salesShowcase.'.$view.'.detail') ?></p></div>
<figure><a class="mk-hr-shot" href="/imgs/sales-<?= $view ?>-demo-v1.png" target="_blank" rel="noopener"><img src="/imgs/sales-<?= $view ?>-demo-v1.png" alt="<?= htmlspecialchars(marketingString('salesShowcase.'.$view.'.title'), ENT_QUOTES, 'UTF-8') ?>"  width="<?= $screenshotSizes[$view][0] ?>" height="<?= $screenshotSizes[$view][1] ?>" loading="lazy"></a><figcaption><a class="mk-text-link" href="/imgs/sales-<?= $view ?>-demo-v1.png" target="_blank" rel="noopener"><?= marketingText('hrShowcase.zoom') ?> ↗</a><p><?= marketingText('hrShowcase.note') ?></p></figcaption></figure>
</div></section>
<?php endforeach; ?>
<section class="mk-section mk-soft"><div class="mk-container mk-split">
<?php foreach (['connect','logistics'] as $feature): ?><article class="mk-info-card"><h2><?= marketingText('salesShowcase.'.$feature.'.title') ?></h2><p><?= marketingText('salesShowcase.'.$feature.'.text') ?></p></article><?php endforeach; ?>
</div></section>
<?php marketingClosing(); ?>
</main>
<?php include 'footer.php'; ?>
