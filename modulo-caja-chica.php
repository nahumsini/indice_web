<?php
require_once __DIR__ . '/content/marketing.php';
require_once __DIR__ . '/content/module-basic-pages.php';
$page_title = basicModuleText('modules.core.cash.title');
$page_description = marketingString('pettyCashShowcase.intro');
$screenshotSizes = ['funds'=>[1444,1089],'balances'=>[1443,1090],'kiosk'=>[870,1808]];
include 'header.php';
?>
<main id="main-content" class="mk-page mk-hr-showcase mk-expenses-showcase">
<section class="mk-section mk-page-hero"><div class="mk-container">
<a class="mk-text-link" href="/modulos.php">← <?= marketingText('panel.back') ?></a>
<p class="mk-eyebrow"><span aria-hidden="true">💰</span><span data-i18n="modules.core.cash.title"><?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?></span></p>
<h1><?= marketingText('pettyCashShowcase.title') ?></h1><p class="mk-lead"><?= marketingText('pettyCashShowcase.intro') ?></p>
<div class="mk-actions"><a class="mk-button" href="/contacto.php"><?= marketingText('cta') ?> ↗</a><a class="mk-text-link" href="/planes.php"><?= marketingText('plans.link') ?> →</a></div>
<nav class="mk-hr-jump" aria-label="<?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?>"><?php foreach (['funds','balances','kiosk'] as $view): ?><a href="#petty-<?= $view ?>"><?= marketingText('pettyCashShowcase.'.$view.'.title') ?> ↓</a><?php endforeach; ?></nav>
</div></section>
<?php foreach (['funds','balances','kiosk'] as $index=>$view): ?>
<section id="petty-<?= $view ?>" class="mk-section <?= $index===1 ? 'mk-soft' : '' ?>"><div class="mk-container mk-hr-view <?= $view==='kiosk' ? 'mk-hr-kiosk' : '' ?>">
<div><p class="mk-eyebrow">0<?= $index+1 ?></p><h2><?= marketingText('pettyCashShowcase.'.$view.'.title') ?></h2><p class="mk-lead"><?= marketingText('pettyCashShowcase.'.$view.'.text') ?></p><p><?= marketingText('pettyCashShowcase.'.$view.'.detail') ?></p></div>
<figure><a class="mk-hr-shot" href="/imgs/petty-<?= $view ?>-demo-v1.png" target="_blank" rel="noopener"><img src="/imgs/petty-<?= $view ?>-demo-v1.png" alt="<?= htmlspecialchars(marketingString('pettyCashShowcase.'.$view.'.title'), ENT_QUOTES, 'UTF-8') ?>"  width="<?= $screenshotSizes[$view][0] ?>" height="<?= $screenshotSizes[$view][1] ?>" loading="lazy"></a><figcaption><a class="mk-text-link" href="/imgs/petty-<?= $view ?>-demo-v1.png" target="_blank" rel="noopener"><?= marketingText('hrShowcase.zoom') ?> ↗</a><p><?= marketingText('hrShowcase.note') ?></p></figcaption></figure>
</div></section>
<?php endforeach; ?>
<section class="mk-section mk-soft"><div class="mk-container mk-split">
<?php foreach (['control','trace'] as $feature): ?><article class="mk-info-card"><h2><?= marketingText('pettyCashShowcase.'.$feature.'.title') ?></h2><p><?= marketingText('pettyCashShowcase.'.$feature.'.text') ?></p></article><?php endforeach; ?>
</div></section>
<?php marketingClosing(); ?>
</main>
<?php include 'footer.php'; ?>
