<?php
require_once __DIR__ . '/functions.php';

function loadModulesLocaleMessages(string $locale): array {
  $filePath = __DIR__ . '/i18n/' . $locale . '.json';
  if (!is_file($filePath)) {
    return [];
  }

  $raw = file_get_contents($filePath);
  if ($raw === false) {
    return [];
  }

  $decoded = json_decode($raw, true);
  return is_array($decoded) ? $decoded : [];
}

$modulesContext = resolveSiteContext();
$modulesLocale = $modulesContext['locale'] ?? 'es-MX';
$modulesMessages = loadModulesLocaleMessages('es-MX');
if ($modulesLocale !== 'es-MX') {
  $modulesMessages = array_merge($modulesMessages, loadModulesLocaleMessages($modulesLocale));
}

function modulesText(string $key): string {
  global $modulesMessages;
  return (string) ($modulesMessages[$key] ?? '');
}

function modulesAttr(string $key): string {
  return htmlspecialchars(modulesText($key), ENT_QUOTES, 'UTF-8');
}

$page_title = modulesText('modules.meta.title');
$page_description = modulesText('modules.meta.description');
include 'header.php';

$modulos_basicos = [
  [
    'theme' => 'panel',
    'icon' => 'fa-gauge-high',
    'emoji' => '📊',
    'title_key' => 'modules.core.panel.title',
    'tagline_key' => 'modules.core.panel.tagline',
    'desc_key' => 'modules.core.panel.desc',
    'href' => '/modulo-panel-inicial.php',
    'preview' => 'panel',
    'features' => [
      ['icon' => 'fa-sitemap', 'label_key' => 'modules.core.panel.feature_1'],
      ['icon' => 'fa-chart-column', 'label_key' => 'modules.core.panel.feature_2'],
      ['icon' => 'fa-clipboard-list', 'label_key' => 'modules.core.panel.feature_3'],
    ],
  ],
  [
    'theme' => 'personas',
    'icon' => 'fa-users',
    'emoji' => '👥',
    'title_key' => 'modules.core.rh.title',
    'tagline_key' => 'modules.core.rh.tagline',
    'desc_key' => 'modules.core.rh.desc',
    'href' => '/modulo-recursos-humanos.php',
    'preview' => 'people',
    'features' => [
      ['icon' => 'fa-user-group', 'label_key' => 'modules.core.rh.feature_1'],
      ['icon' => 'fa-calendar-check', 'label_key' => 'modules.core.rh.feature_2'],
      ['icon' => 'fa-money-check-dollar', 'label_key' => 'modules.core.rh.feature_3'],
    ],
  ],
  [
    'theme' => 'finanzas',
    'icon' => 'fa-receipt',
    'emoji' => '💰',
    'title_key' => 'modules.core.expenses.title',
    'tagline_key' => 'modules.core.expenses.tagline',
    'desc_key' => 'modules.core.expenses.desc',
    'href' => '/modulo-gastos.php',
    'preview' => 'expenses',
    'features' => [
      ['icon' => 'fa-money-bill-wave', 'label_key' => 'modules.core.expenses.feature_1'],
      ['icon' => 'fa-clipboard-list', 'label_key' => 'modules.core.expenses.feature_2'],
      ['icon' => 'fa-truck-field', 'label_key' => 'modules.core.expenses.feature_3'],
    ],
  ],
  [
    'theme' => 'finanzas',
    'icon' => 'fa-wallet',
    'emoji' => '💳',
    'title_key' => 'modules.core.cash.title',
    'tagline_key' => 'modules.core.cash.tagline',
    'desc_key' => 'modules.core.cash.desc',
    'href' => '/modulo-caja-chica.php',
    'preview' => 'cash',
    'features' => [
      ['icon' => 'fa-money-bill', 'label_key' => 'modules.core.cash.feature_1'],
      ['icon' => 'fa-clipboard-check', 'label_key' => 'modules.core.cash.feature_2'],
      ['icon' => 'fa-scale-balanced', 'label_key' => 'modules.core.cash.feature_3'],
    ],
  ],
  [
    'theme' => 'productos',
    'icon' => 'fa-cash-register',
    'emoji' => '🛒',
    'title_key' => 'modules.core.pos.title',
    'tagline_key' => 'modules.core.pos.tagline',
    'desc_key' => 'modules.core.pos.desc',
    'href' => '/modulo-punto-de-venta.php',
    'preview' => 'pos',
    'features' => [
      ['icon' => 'fa-bag-shopping', 'label_key' => 'modules.core.pos.feature_1'],
      ['icon' => 'fa-boxes-stacked', 'label_key' => 'modules.core.pos.feature_2'],
      ['icon' => 'fa-sack-dollar', 'label_key' => 'modules.core.pos.feature_3'],
    ],
  ],
  [
    'theme' => 'productos',
    'icon' => 'fa-handshake',
    'emoji' => '💵',
    'title_key' => 'modules.core.sales.title',
    'tagline_key' => 'modules.core.sales.tagline',
    'desc_key' => 'modules.core.sales.desc',
    'href' => '/modulo-ventas.php',
    'preview' => 'sales',
    'features' => [
      ['icon' => 'fa-bullseye', 'label_key' => 'modules.core.sales.feature_1'],
      ['icon' => 'fa-file-invoice-dollar', 'label_key' => 'modules.core.sales.feature_2'],
      ['icon' => 'fa-arrow-right', 'label_key' => 'modules.core.sales.feature_3'],
    ],
  ],
  [
    'theme' => 'procesos',
    'icon' => 'fa-list-check',
    'emoji' => '✅',
    'title_key' => 'modules.core.process.title',
    'tagline_key' => 'modules.core.process.tagline',
    'desc_key' => 'modules.core.process.desc',
    'href' => '/modulo-procesos-tareas.php',
    'preview' => 'process',
    'features' => [
      ['icon' => 'fa-bullseye', 'label_key' => 'modules.core.process.feature_1'],
      ['icon' => 'fa-user-check', 'label_key' => 'modules.core.process.feature_2'],
      ['icon' => 'fa-chart-simple', 'label_key' => 'modules.core.process.feature_3'],
    ],
  ],
  [
    'theme' => 'dashboard',
    'icon' => 'fa-chart-line',
    'emoji' => '📈',
    'title_key' => 'modules.core.kpis.title',
    'tagline_key' => 'modules.core.kpis.tagline',
    'desc_key' => 'modules.core.kpis.desc',
    'href' => '/modulo-kpis.php',
    'preview' => 'kpis',
    'features' => [
      ['icon' => 'fa-chart-simple', 'label_key' => 'modules.core.kpis.feature_1'],
      ['icon' => 'fa-file-lines', 'label_key' => 'modules.core.kpis.feature_2'],
      ['icon' => 'fa-bell', 'label_key' => 'modules.core.kpis.feature_3'],
    ],
  ],
];

$modulos_complementarios = [
  ['icon' => 'fa-screwdriver-wrench', 'emoji' => '🔧', 'href' => '/modulo-mantenimiento.php', 'title_key' => 'modules.scale.maintenance.title', 'desc_key' => 'modules.scale.maintenance.desc'],
  ['icon' => 'fa-box', 'emoji' => '📦', 'href' => '/modulo-inventarios.php', 'title_key' => 'modules.scale.inventory.title', 'desc_key' => 'modules.scale.inventory.desc'],
  ['icon' => 'fa-file-lines', 'emoji' => '📄', 'href' => '/modulo-control-minutas.php', 'title_key' => 'modules.scale.minutes.title', 'desc_key' => 'modules.scale.minutes.desc'],
  ['icon' => 'fa-broom', 'emoji' => '🧹', 'href' => '/modulo-limpieza.php', 'title_key' => 'modules.scale.cleaning.title', 'desc_key' => 'modules.scale.cleaning.desc'],
  ['icon' => 'fa-shirt', 'emoji' => '👕', 'href' => '/modulo-lavanderia.php', 'title_key' => 'modules.scale.laundry.title', 'desc_key' => 'modules.scale.laundry.desc'],
  ['icon' => 'fa-truck', 'emoji' => '🚚', 'href' => '/modulo-transportacion.php', 'title_key' => 'modules.scale.transport.title', 'desc_key' => 'modules.scale.transport.desc'],
  ['icon' => 'fa-car', 'emoji' => '🚗', 'href' => '/modulo-vehiculos-maquinaria.php', 'title_key' => 'modules.scale.vehicles.title', 'desc_key' => 'modules.scale.vehicles.desc'],
  ['icon' => 'fa-building', 'emoji' => '🏢', 'href' => '/modulo-inmuebles.php', 'title_key' => 'modules.scale.properties.title', 'desc_key' => 'modules.scale.properties.desc'],
  ['icon' => 'fa-clipboard', 'emoji' => '📋', 'href' => '/modulo-formularios.php', 'title_key' => 'modules.scale.forms.title', 'desc_key' => 'modules.scale.forms.desc'],
  ['icon' => 'fa-receipt', 'emoji' => '🧾', 'href' => '/modulo-facturacion.php', 'title_key' => 'modules.scale.billing.title', 'desc_key' => 'modules.scale.billing.desc'],
  ['icon' => 'fa-envelope', 'emoji' => '📧', 'href' => '/modulo-correo-electronico.php', 'title_key' => 'modules.scale.email.title', 'desc_key' => 'modules.scale.email.desc'],
  ['icon' => 'fa-face-smile', 'emoji' => '😊', 'href' => '/modulo-clima-laboral.php', 'title_key' => 'modules.scale.climate.title', 'desc_key' => 'modules.scale.climate.desc'],
  ['icon' => 'fa-handshake', 'emoji' => '🤝', 'href' => '/modulo-afiliados.php', 'title_key' => 'modules.scale.affiliates.title', 'desc_key' => 'modules.scale.affiliates.desc'],
];

$modulos_ia = [
  ['icon' => 'fa-robot', 'emoji' => '🤖', 'title_key' => 'modules.ai.agent.title', 'desc_key' => 'modules.ai.agent.desc'],
  ['icon' => 'fa-brain', 'emoji' => '📊', 'title_key' => 'modules.ai.analytics.title', 'desc_key' => 'modules.ai.analytics.desc'],
  ['icon' => 'fa-chalkboard-user', 'emoji' => '🎓', 'title_key' => 'modules.ai.training.title', 'desc_key' => 'modules.ai.training.desc'],
];
?>

<main>

  <section class="page-hero bg-surface reveal" aria-label="<?= modulesAttr('modules.hero.title') ?>">
    <div class="container text-center">
      <span class="eyebrow" data-i18n="modules.hero.eyebrow"><?= modulesAttr('modules.hero.eyebrow') ?></span>
      <h1 class="display-5 fw-bold text-balance mb-3" data-i18n="modules.hero.title"><?= modulesAttr('modules.hero.title') ?></h1>
      <p class="lead lead-soft mb-4 mx-auto" style="max-width:780px;" data-i18n="modules.hero.subtitle"><?= modulesAttr('modules.hero.subtitle') ?></p>
      <div class="d-flex flex-wrap gap-2 justify-content-center">
        <a href="#basicos" class="btn btn-brand" data-i18n="modules.hero.cta.core"><?= modulesAttr('modules.hero.cta.core') ?></a>
        <a href="#complementarios" class="btn btn-ghost" data-i18n="modules.hero.cta.complementary"><?= modulesAttr('modules.hero.cta.complementary') ?></a>
        <a href="#ia" class="btn btn-ghost" data-i18n="modules.hero.cta.ai"><?= modulesAttr('modules.hero.cta.ai') ?></a>
      </div>
    </div>
  </section>

  <section class="py-6 bg-card reveal" id="basicos" aria-label="<?= modulesAttr('modules.core.title') ?>">
    <div class="container">
      <div class="text-center mb-5">
        <span class="eyebrow" data-i18n="modules.core.eyebrow"><?= modulesAttr('modules.core.eyebrow') ?></span>
        <h2 class="section-title" data-i18n="modules.core.title"><?= modulesAttr('modules.core.title') ?></h2>
        <p class="lead-soft mx-auto" style="max-width:760px;" data-i18n="modules.core.desc"><?= modulesAttr('modules.core.desc') ?></p>
      </div>

      <div class="row g-4">
        <?php foreach ($modulos_basicos as $mod):
          $theme = htmlspecialchars($mod['theme'], ENT_QUOTES, 'UTF-8');
          $preview = htmlspecialchars($mod['preview'] ?? 'panel', ENT_QUOTES, 'UTF-8');
          $moduleHref = $mod['href'] ?? null;
          $moduleTag = $moduleHref ? 'a' : 'article';
        ?>
        <div class="col-lg-6">
          <<?= $moduleTag ?><?php if ($moduleHref): ?> href="<?= htmlspecialchars($moduleHref, ENT_QUOTES, 'UTF-8') ?>"<?php endif; ?> class="module-card-modern module-core-card module-theme-<?= $theme ?><?php echo $moduleHref ? ' module-card-link' : ''; ?> h-100">
            <div class="module-core-head">
              <div class="module-core-title-row">
                <?php if (!empty($mod['emoji'])): ?>
                  <span class="module-emoji-icon module-emoji-icon-xl" aria-hidden="true"><?= htmlspecialchars($mod['emoji'], ENT_QUOTES, 'UTF-8') ?></span>
                <?php else: ?>
                  <i class="fa-solid <?= htmlspecialchars($mod['icon'], ENT_QUOTES, 'UTF-8') ?> module-icon"></i>
                <?php endif; ?>
                <div>
                  <h3 data-i18n="<?= htmlspecialchars($mod['title_key'], ENT_QUOTES, 'UTF-8') ?>"><?= modulesAttr($mod['title_key']) ?></h3>
                  <p class="hero-microcopy mb-0" data-i18n="<?= htmlspecialchars($mod['tagline_key'], ENT_QUOTES, 'UTF-8') ?>"><?= modulesAttr($mod['tagline_key']) ?></p>
                </div>
              </div>
              <div class="module-card-preview module-preview-<?= $preview ?>" aria-hidden="true">
                <span></span>
                <span></span>
                <span></span>
              </div>
            </div>
            <div class="module-core-body">
              <p class="module-core-copy" data-i18n="<?= htmlspecialchars($mod['desc_key'], ENT_QUOTES, 'UTF-8') ?>"><?= modulesAttr($mod['desc_key']) ?></p>
              <div class="module-core-chip-grid">
                <?php foreach ($mod['features'] as $feat): ?>
                  <span class="module-chip module-theme-<?= $theme ?>">
                    <i class="fa-solid <?= htmlspecialchars($feat['icon'], ENT_QUOTES, 'UTF-8') ?>"></i>
                    <span data-i18n="<?= htmlspecialchars($feat['label_key'], ENT_QUOTES, 'UTF-8') ?>"><?= modulesAttr($feat['label_key']) ?></span>
                  </span>
                <?php endforeach; ?>
              </div>
            </div>
            <?php if ($moduleHref): ?>
              <span class="module-card-cta">
                <span data-i18n="modules.card.open"><?= modulesAttr('modules.card.open') ?></span>
                <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
              </span>
            <?php endif; ?>
          </<?= $moduleTag ?>>
        </div>
        <?php endforeach; ?>
      </div>

      <div class="text-center mt-5">
        <a href="planes.php" class="btn btn-brand btn-lg" data-i18n="modules.core.cta"><?= modulesAttr('modules.core.cta') ?></a>
      </div>
    </div>
  </section>

  <section class="py-6 bg-surface reveal" id="complementarios" aria-label="<?= modulesAttr('modules.scale.title') ?>">
    <div class="container">
      <div class="text-center mb-5">
        <span class="eyebrow" data-i18n="modules.scale.eyebrow"><?= modulesAttr('modules.scale.eyebrow') ?></span>
        <h2 class="section-title" data-i18n="modules.scale.title"><?= modulesAttr('modules.scale.title') ?></h2>
        <p class="lead-soft mx-auto" style="max-width:780px;" data-i18n="modules.scale.desc"><?= modulesAttr('modules.scale.desc') ?></p>
      </div>

      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($modulos_complementarios as $mod):
          $moduleHref = $mod['href'] ?? null;
          $moduleTag = $moduleHref ? 'a' : 'article';
        ?>
        <div class="col">
          <<?= $moduleTag ?><?php if ($moduleHref): ?> href="<?= htmlspecialchars($moduleHref, ENT_QUOTES, 'UTF-8') ?>"<?php endif; ?> class="module-card-modern module-theme-complementarios<?php echo $moduleHref ? ' module-card-link' : ''; ?> h-100 p-4">
            <?php if (!empty($mod['emoji'])): ?>
              <span class="module-emoji-icon" aria-hidden="true"><?= htmlspecialchars($mod['emoji'], ENT_QUOTES, 'UTF-8') ?></span>
            <?php else: ?>
              <i class="fa-solid <?= htmlspecialchars($mod['icon'], ENT_QUOTES, 'UTF-8') ?> module-icon"></i>
            <?php endif; ?>
            <h3 data-i18n="<?= htmlspecialchars($mod['title_key'], ENT_QUOTES, 'UTF-8') ?>"><?= modulesAttr($mod['title_key']) ?></h3>
            <p data-i18n="<?= htmlspecialchars($mod['desc_key'], ENT_QUOTES, 'UTF-8') ?>"><?= modulesAttr($mod['desc_key']) ?></p>
            <?php if ($moduleHref): ?>
              <span class="module-card-cta">
                <span data-i18n="modules.card.open"><?= modulesAttr('modules.card.open') ?></span>
                <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
              </span>
            <?php endif; ?>
          </<?= $moduleTag ?>>
        </div>
        <?php endforeach; ?>
      </div>

      <div class="cta-box mt-5 text-center">
        <h3 class="mb-2" data-i18n="modules.custom.title"><?= modulesAttr('modules.custom.title') ?></h3>
        <p class="lead-soft mb-3" data-i18n="modules.custom.desc"><?= modulesAttr('modules.custom.desc') ?></p>
        <a href="contacto.php#demo" class="btn btn-brand" data-i18n="modules.custom.button"><?= modulesAttr('modules.custom.button') ?></a>
      </div>
    </div>
  </section>

  <section class="py-6 bg-card reveal" id="ia" aria-label="<?= modulesAttr('modules.ai.title') ?>">
    <div class="container">
      <div class="text-center mb-5">
        <span class="eyebrow" data-i18n="modules.ai.eyebrow"><?= modulesAttr('modules.ai.eyebrow') ?></span>
        <h2 class="section-title" data-i18n="modules.ai.title"><?= modulesAttr('modules.ai.title') ?></h2>
        <p class="lead-soft mx-auto" style="max-width:780px;" data-i18n="modules.ai.desc"><?= modulesAttr('modules.ai.desc') ?></p>
      </div>

      <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($modulos_ia as $mod): ?>
        <div class="col">
          <article class="module-card-modern module-theme-ia h-100 p-4">
            <?php if (!empty($mod['emoji'])): ?>
              <span class="module-emoji-icon" aria-hidden="true"><?= htmlspecialchars($mod['emoji'], ENT_QUOTES, 'UTF-8') ?></span>
            <?php else: ?>
              <i class="fa-solid <?= htmlspecialchars($mod['icon'], ENT_QUOTES, 'UTF-8') ?> module-icon"></i>
            <?php endif; ?>
            <h3 data-i18n="<?= htmlspecialchars($mod['title_key'], ENT_QUOTES, 'UTF-8') ?>"><?= modulesAttr($mod['title_key']) ?></h3>
            <p data-i18n="<?= htmlspecialchars($mod['desc_key'], ENT_QUOTES, 'UTF-8') ?>"><?= modulesAttr($mod['desc_key']) ?></p>
          </article>
        </div>
        <?php endforeach; ?>
      </div>

      <div class="cta-box cta-box-strong mt-5 text-center">
        <h3 class="mb-2" data-i18n="modules.ai.cta.title"><?= modulesAttr('modules.ai.cta.title') ?></h3>
        <p class="lead-soft mb-3" data-i18n="modules.ai.cta.desc"><?= modulesAttr('modules.ai.cta.desc') ?></p>
        <a href="contacto.php#demo" class="btn btn-brand btn-lg" data-i18n="modules.ai.cta.button"><?= modulesAttr('modules.ai.cta.button') ?></a>
      </div>
    </div>
  </section>

  <section class="py-6 bg-surface text-center reveal" aria-label="<?= modulesAttr('modules.cta.title') ?>">
    <div class="container">
      <div class="cta-box">
        <h2 data-i18n="modules.cta.title"><?= modulesAttr('modules.cta.title') ?></h2>
        <p data-i18n="modules.cta.desc"><?= modulesAttr('modules.cta.desc') ?></p>
        <a href="contacto.php#demo" class="btn btn-brand btn-lg" data-i18n="modules.cta.primary"><?= modulesAttr('modules.cta.primary') ?></a>
      </div>
    </div>
  </section>

</main>

<?php include 'footer.php'; ?>
