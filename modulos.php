<?php
require_once __DIR__ . '/content/marketing.php';
$locale = resolveSiteContext()['locale'];
$moduleCopy = array_merge(json_decode(file_get_contents(__DIR__ . '/i18n/es-MX.json'), true), json_decode(file_get_contents(__DIR__ . '/i18n/' . basename($locale) . '.json'), true) ?: []);
$page_title = marketingString('modules.title');
$page_description = marketingString('modules.text');
include 'header.php';
$groups = [
  ['key'=>'modules.journey.structure.title', 'items'=>['panel'=>'panel-inicial']],
  ['key'=>'modules.journey.people.title', 'items'=>['rh'=>'recursos-humanos']],
  ['key'=>'modules.journey.process.title', 'items'=>['process'=>'procesos-tareas']],
  ['key'=>'modules.journey.finance.title', 'items'=>['expenses'=>'gastos','cash'=>'caja-chica','receivables'=>'cartera']],
  ['key'=>'modules.journey.products.title', 'items'=>['inventory'=>'inventarios','pos'=>'punto-de-venta','sales'=>'ventas']],
  ['key'=>'modules.journey.intelligence.title', 'items'=>['kpis'=>'kpis']],
];
?>
<main id="main-content" class="mk-page"><section class="mk-section mk-page-hero"><div class="mk-container"><p class="mk-eyebrow"><?= marketingText('hero.eyebrow') ?></p><h1><?= marketingText('modules.title') ?></h1><p class="mk-lead"><?= marketingText('modules.text') ?></p><div class="mk-actions"><a class="mk-button" href="/planes.php"><?= marketingText('plans.link') ?> ↗</a><a class="mk-text-link" href="/index.php#lupita"><?= marketingText('nav.agents') ?> →</a></div></div></section><section class="mk-section"><div class="mk-container"><div class="mk-module-grid"><?php foreach($groups as $i=>$group): ?><article class="mk-module-group"><span class="mk-outline-number" aria-hidden="true">0<?= $i+1 ?></span><h2 data-i18n="<?= $group['key'] ?>"><?= htmlspecialchars($moduleCopy[$group['key']] ?? '', ENT_QUOTES, 'UTF-8') ?></h2><?php foreach($group['items'] as $key=>$route): $copyKey='modules.core.'.$key.'.title'; ?><a href="/modulo-<?= $route ?>.php"><span data-i18n="<?= $copyKey ?>"><?= htmlspecialchars($moduleCopy[$copyKey] ?? '', ENT_QUOTES, 'UTF-8') ?></span><span aria-hidden="true"> ↗</span></a><?php endforeach; ?></article><?php endforeach; ?></div><p class="mk-fine-print"><?= marketingText('faq.two.text') ?></p></div></section><section class="mk-section mk-soft"><div class="mk-container mk-learning"><div><h2><?= marketingText('learn.title') ?></h2><p><?= marketingText('learn.text') ?></p></div><a class="mk-text-link" href="/modo-aprendiz.php"><?= marketingText('learn.link') ?> →</a></div></section><?php marketingClosing(); ?></main>
<?php include 'footer.php'; ?>
