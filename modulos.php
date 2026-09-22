<?php
require_once __DIR__ . '/content/marketing.php';
$locale = resolveSiteContext()['locale'];
$moduleCopy = array_merge(json_decode(file_get_contents(__DIR__ . '/i18n/es-MX.json'), true), json_decode(file_get_contents(__DIR__ . '/i18n/' . basename($locale) . '.json'), true) ?: []);
$page_title = marketingString('modules.title');
$page_description = marketingString('modules.text');
include 'header.php';
$modules = [
  ['panel','panel-inicial','🏠','blue'],
  ['rh','recursos-humanos','👥','aqua'],
  ['process','procesos-tareas','✅','yellow'],
  ['expenses','gastos','💸','green'],
  ['cash','caja-chica','💰','green'],
  ['inventory','inventarios','📦','coral'],
  ['pos','punto-de-venta','🛒','coral'],
  ['sales','ventas','💼','coral'],
  ['receivables','cartera','📙','green'],
  ['kpis','kpis','📈','purple'],
];
function moduleCatalogText(string $key): string {
  global $moduleCopy;
  return '<span data-i18n="' . htmlspecialchars($key, ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($moduleCopy[$key] ?? '', ENT_QUOTES, 'UTF-8') . '</span>';
}
?>
<main id="main-content" class="mk-page"><section class="mk-section mk-page-hero"><div class="mk-container"><p class="mk-eyebrow"><?= marketingText('hero.eyebrow') ?></p><h1><?= marketingText('modules.title') ?></h1><p class="mk-lead"><?= marketingText('modules.text') ?></p><div class="mk-actions"><a class="mk-button" href="/planes.php"><?= marketingText('plans.link') ?> ↗</a><a class="mk-text-link" href="/index.php#lupita"><?= marketingText('nav.agents') ?> →</a></div></div></section><section class="mk-section"><div class="mk-container"><div class="mk-module-grid mk-catalog-grid">
<?php foreach ($modules as [$key,$route,$emoji,$color]): ?>
<a class="mk-module-card mk-module-<?= $color ?>" href="/modulo-<?= $route ?>.php">
  <span class="mk-module-icon" aria-hidden="true"><?= $emoji ?></span>
  <h2><?= moduleCatalogText('modules.core.'.$key.'.title') ?></h2>
  <p><?= moduleCatalogText('modules.core.'.$key.'.tagline') ?></p>
  <span class="mk-module-discover"><?= marketingText('catalog.page') ?><span aria-hidden="true"> ↗</span></span>
</a>
<?php endforeach; ?>
</div><p class="mk-fine-print"><?= marketingText('faq.two.text') ?></p></div></section><section class="mk-section mk-soft"><div class="mk-container mk-learning"><div><h2><?= marketingText('learn.title') ?></h2><p><?= marketingText('learn.text') ?></p></div><a class="mk-text-link" href="/modo-aprendiz.php"><?= marketingText('learn.link') ?> →</a></div></section><?php marketingClosing(); ?></main>
<?php include 'footer.php'; ?>
