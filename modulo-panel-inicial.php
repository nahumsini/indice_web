<?php
require_once __DIR__ . '/content/marketing.php';
$page_title = marketingString('panel.title');
$page_description = marketingString('panel.intro');
require_once __DIR__ . '/content/module-basic-pages.php';
include 'header.php';
?>
<main id="main-content" class="mk-page mk-panel-page">
  <section class="mk-section mk-page-hero"><div class="mk-container">
    <a class="mk-text-link" href="/modulos.php">← <?= marketingText('panel.back') ?></a>
    <div class="mk-panel-hero-grid">
      <div><p class="mk-eyebrow"><span aria-hidden="true">🏠</span><span data-i18n="modules.core.panel.title"><?= htmlspecialchars(basicModuleText('modules.core.panel.title'), ENT_QUOTES, 'UTF-8') ?></span></p>
        <h1><?= marketingText('panel.title') ?></h1><p class="mk-lead"><?= marketingText('panel.intro') ?></p>
        <div class="mk-actions"><a class="mk-button" href="/contacto.php"><?= marketingText('cta') ?> ↗</a><a class="mk-text-link" href="/planes.php"><?= marketingText('plans.link') ?> →</a></div>
      </div>
      <figure class="mk-panel-illustration"><img src="/imgs/panel-business-structure-v1.png" width="1536" height="1024" alt="<?= htmlspecialchars(marketingString('panel.visual.alt'), ENT_QUOTES, 'UTF-8') ?>" data-i18n-alt="brand26.panel.visual.alt" fetchpriority="high"><figcaption><?= marketingText('panel.visual.caption') ?></figcaption></figure>
    </div>
  </div></section>
  <section class="mk-section"><div class="mk-container"><h2><?= marketingText('panel.features.title') ?></h2><div class="mk-module-grid mk-panel-features">
    <?php foreach (['structure'=>'🏢','people'=>'👥','diagnosis'=>'📈'] as $feature=>$emoji): ?><article class="mk-info-card"><span class="mk-panel-feature-icon" aria-hidden="true"><?= $emoji ?></span><h3><?= marketingText('panel.'.$feature.'.title') ?></h3><p><?= marketingText('panel.'.$feature.'.text') ?></p></article><?php endforeach; ?>
  </div></div></section>
  <section class="mk-section mk-soft"><div class="mk-container mk-split"><h2><?= marketingText('panel.agents.title') ?></h2><div><p class="mk-lead"><?= marketingText('panel.agents.text') ?></p><a class="mk-text-link" href="/index.php#lupita"><?= marketingText('nav.agents') ?> →</a></div></div></section>
  <?php marketingClosing(); ?>
</main>
<?php include 'footer.php'; ?>
