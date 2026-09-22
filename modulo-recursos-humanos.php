<?php
require_once __DIR__ . '/content/marketing.php';
require_once __DIR__ . '/content/module-basic-pages.php';
$page_title = basicModuleText('modules.core.rh.title');
$page_description = marketingString('hrShowcase.intro');
include 'header.php';
?>
<main id="main-content" class="mk-page mk-hr-showcase">
<section class="mk-section mk-page-hero"><div class="mk-container">
<a class="mk-text-link" href="/modulos.php">← <?= marketingText('panel.back') ?></a>
<p class="mk-eyebrow"><span aria-hidden="true">👥</span><span data-i18n="modules.core.rh.title"><?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?></span></p>
<h1><?= marketingText('hrShowcase.title') ?></h1><p class="mk-lead"><?= marketingText('hrShowcase.intro') ?></p>
<div class="mk-actions"><a class="mk-button" href="/contacto.php"><?= marketingText('cta') ?> ↗</a><a class="mk-text-link" href="/planes.php"><?= marketingText('plans.link') ?> →</a></div>
<nav class="mk-hr-jump" aria-label="<?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?>"><?php foreach (['attendance','payroll','kiosk'] as $view): ?><a href="#hr-<?= $view ?>"><?= marketingText('hrShowcase.'.$view.'.title') ?> ↓</a><?php endforeach; ?></nav>
</div></section>
<?php foreach (['attendance','payroll','kiosk'] as $index=>$view): ?>
<section id="hr-<?= $view ?>" class="mk-section <?= $index===1 ? 'mk-soft' : '' ?>"><div class="mk-container mk-hr-view <?= $view==='kiosk' ? 'mk-hr-kiosk' : '' ?>">
<div><p class="mk-eyebrow">0<?= $index+1 ?></p><h2><?= marketingText('hrShowcase.'.$view.'.title') ?></h2><p class="mk-lead"><?= marketingText('hrShowcase.'.$view.'.text') ?></p><p><?= marketingText('hrShowcase.'.$view.'.detail') ?></p></div>
<figure><a class="mk-hr-shot" href="/imgs/hr-<?= $view ?>-demo-v1.png" target="_blank" rel="noopener"><img src="/imgs/hr-<?= $view ?>-demo-v1.png" alt="<?= htmlspecialchars(marketingString('hrShowcase.'.$view.'.title'), ENT_QUOTES, 'UTF-8') ?>" width="<?= $view==='kiosk' ? 983 : 1444 ?>" height="<?= $view==='kiosk' ? 1600 : 1089 ?>" loading="lazy"></a><figcaption><a class="mk-text-link" href="/imgs/hr-<?= $view ?>-demo-v1.png" target="_blank" rel="noopener"><?= marketingText('hrShowcase.zoom') ?> ↗</a><p><?= marketingText('hrShowcase.note') ?></p></figcaption></figure>
</div></section>
<?php endforeach; ?>
<section class="mk-section mk-soft"><div class="mk-container"><h2><?= marketingText('hrShowcase.more.title') ?></h2><p class="mk-lead"><?= marketingText('hrShowcase.more.text') ?></p></div></section>
<?php marketingClosing(); ?>
</main>
<?php include 'footer.php'; ?>
