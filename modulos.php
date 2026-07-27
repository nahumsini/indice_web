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

$page_title = preg_replace('/\s*\|\s*[ÍI]ndice\s*$/u', '', modulesText('modules.meta.title'));
$page_description = modulesText('modules.meta.description');
include 'header.php';

$moduleJourney = [
  [
    'number' => '01',
    'tone' => 'blue',
    'label_key' => 'modules.journey.structure.label',
    'title_key' => 'modules.journey.structure.title',
    'desc_key' => 'modules.journey.structure.desc',
    'modules' => [
      ['emoji' => '🏠', 'href' => '/modulo-panel-inicial.php', 'title_key' => 'modules.core.panel.title'],
    ],
  ],
  [
    'number' => '02',
    'tone' => 'aqua',
    'label_key' => 'modules.journey.people.label',
    'title_key' => 'modules.journey.people.title',
    'desc_key' => 'modules.journey.people.desc',
    'modules' => [
      ['emoji' => '👥', 'href' => '/modulo-recursos-humanos.php', 'title_key' => 'modules.core.rh.title'],
    ],
  ],
  [
    'number' => '03',
    'tone' => 'yellow',
    'label_key' => 'modules.journey.process.label',
    'title_key' => 'modules.journey.process.title',
    'desc_key' => 'modules.journey.process.desc',
    'modules' => [
      ['emoji' => '✅', 'href' => '/modulo-procesos-tareas.php', 'title_key' => 'modules.core.process.title'],
    ],
  ],
  [
    'number' => '04',
    'tone' => 'green',
    'label_key' => 'modules.journey.finance.label',
    'title_key' => 'modules.journey.finance.title',
    'desc_key' => 'modules.journey.finance.desc',
    'modules' => [
      ['emoji' => '💸', 'href' => '/modulo-gastos.php', 'title_key' => 'modules.core.expenses.title'],
      ['emoji' => '💰', 'href' => '/modulo-caja-chica.php', 'title_key' => 'modules.core.cash.title'],
      ['emoji' => '📙', 'href' => '/modulo-cartera.php', 'title_key' => 'modules.core.receivables.title'],
    ],
  ],
  [
    'number' => '05',
    'tone' => 'coral',
    'label_key' => 'modules.journey.products.label',
    'title_key' => 'modules.journey.products.title',
    'desc_key' => 'modules.journey.products.desc',
    'modules' => [
      ['emoji' => '🛒', 'href' => '/modulo-punto-de-venta.php', 'title_key' => 'modules.core.pos.title'],
      ['emoji' => '💼', 'href' => '/modulo-ventas.php', 'title_key' => 'modules.core.sales.title'],
      ['emoji' => '📦', 'href' => '/modulo-inventarios.php', 'title_key' => 'modules.core.inventory.title'],
    ],
  ],
  [
    'number' => '06',
    'tone' => 'purple',
    'label_key' => 'modules.journey.intelligence.label',
    'title_key' => 'modules.journey.intelligence.title',
    'desc_key' => 'modules.journey.intelligence.desc',
    'modules' => [
      ['emoji' => '📈', 'href' => '/modulo-kpis.php', 'title_key' => 'modules.core.kpis.title'],
    ],
  ],
];

$moduleGroups = [
  [
    'title_key' => 'modules.directory.assets',
    'modules' => [
      ['emoji' => '🔧', 'href' => '/modulo-mantenimiento.php', 'title_key' => 'modules.scale.maintenance.title'],
      ['emoji' => '🚜', 'href' => '/modulo-vehiculos-maquinaria.php', 'title_key' => 'modules.scale.vehicles.title'],
      ['emoji' => '🏢', 'href' => '/modulo-inmuebles.php', 'title_key' => 'modules.scale.properties.title'],
    ],
  ],
  [
    'title_key' => 'modules.directory.daily',
    'modules' => [
      ['emoji' => '🧹', 'href' => '/modulo-limpieza.php', 'title_key' => 'modules.scale.cleaning.title'],
      ['emoji' => '👕', 'href' => '/modulo-lavanderia.php', 'title_key' => 'modules.scale.laundry.title'],
      ['emoji' => '🚚', 'href' => '/modulo-transportacion.php', 'title_key' => 'modules.scale.transport.title'],
    ],
  ],
  [
    'title_key' => 'modules.directory.admin',
    'modules' => [
      ['emoji' => '📝', 'href' => '/modulo-control-minutas.php', 'title_key' => 'modules.scale.minutes.title'],
      ['emoji' => '📋', 'href' => '/modulo-formularios.php', 'title_key' => 'modules.scale.forms.title'],
      ['emoji' => '📄', 'href' => '/modulo-facturacion.php', 'title_key' => 'modules.scale.billing.title'],
      ['emoji' => '✉️', 'href' => '/modulo-correo-electronico.php', 'title_key' => 'modules.scale.email.title'],
    ],
  ],
  [
    'title_key' => 'modules.directory.team',
    'modules' => [
      ['emoji' => '🌡️', 'href' => '/modulo-clima-laboral.php', 'title_key' => 'modules.scale.climate.title'],
      ['emoji' => '🤝', 'href' => '/modulo-afiliados.php', 'title_key' => 'modules.scale.affiliates.title'],
    ],
  ],
];

$modulos_ia = [
  ['emoji' => '🤖', 'title_key' => 'modules.ai.agent.title'],
  ['emoji' => '🧠', 'title_key' => 'modules.ai.analytics.title'],
  ['emoji' => '🎓', 'title_key' => 'modules.ai.training.title'],
  ['emoji' => '🧭', 'title_key' => 'modules.ai.coach.title'],
];
?>

<main class="modules-page">

  <section class="modules-page-hero reveal" aria-label="<?= modulesAttr('modules.hero.title') ?>">
    <div class="container text-center">
      <span class="eyebrow" data-i18n="modules.hero.eyebrow"><?= modulesAttr('modules.hero.eyebrow') ?></span>
      <h1 class="display-5 text-balance" data-i18n="modules.hero.title"><?= modulesAttr('modules.hero.title') ?></h1>
      <p class="lead lead-soft mx-auto" data-i18n="modules.hero.subtitle"><?= modulesAttr('modules.hero.subtitle') ?></p>
      <a href="<?= getIndiceLoginUrlAttr() ?>" class="btn btn-brand btn-lg" data-i18n="home_hero_cta_primary"><?= modulesAttr('home_hero_cta_primary') ?></a>
    </div>
  </section>

  <section class="modules-core-showcase reveal" id="basicos" aria-label="<?= modulesAttr('modules.core.title') ?>">
    <div class="container">
      <div class="modules-section-heading text-center">
        <span class="eyebrow" data-i18n="modules.core.eyebrow"><?= modulesAttr('modules.core.eyebrow') ?></span>
        <h2 class="section-title" data-i18n="modules.core.title"><?= modulesAttr('modules.core.title') ?></h2>
        <p class="lead-soft mx-auto" data-i18n="modules.core.desc"><?= modulesAttr('modules.core.desc') ?></p>
      </div>

      <div class="module-journey-grid">
        <?php foreach ($moduleJourney as $stage): ?>
          <article class="module-journey-card module-journey-card--<?= htmlspecialchars($stage['tone'], ENT_QUOTES, 'UTF-8') ?>">
            <div class="module-journey-card__heading">
              <span class="module-journey-card__number"><?= htmlspecialchars($stage['number'], ENT_QUOTES, 'UTF-8') ?></span>
              <div>
                <h3 data-i18n="<?= htmlspecialchars($stage['label_key'], ENT_QUOTES, 'UTF-8') ?>"><?= modulesAttr($stage['label_key']) ?></h3>
                <p data-i18n="<?= htmlspecialchars($stage['desc_key'], ENT_QUOTES, 'UTF-8') ?>"><?= modulesAttr($stage['desc_key']) ?></p>
              </div>
            </div>
            <div class="module-journey-card__links">
              <?php foreach ($stage['modules'] as $mod): ?>
                <a href="<?= htmlspecialchars($mod['href'], ENT_QUOTES, 'UTF-8') ?>" class="indice-module-tile">
                  <span class="indice-module-tile__emoji" aria-hidden="true"><?= htmlspecialchars($mod['emoji'], ENT_QUOTES, 'UTF-8') ?></span>
                  <span class="indice-module-tile__name" data-i18n="<?= htmlspecialchars($mod['title_key'], ENT_QUOTES, 'UTF-8') ?>"><?= modulesAttr($mod['title_key']) ?></span>
                </a>
              <?php endforeach; ?>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="modules-learning-strip reveal" aria-label="<?= modulesAttr('modules.learning.title') ?>">
    <div class="container">
      <div class="modules-learning-bridge">
        <div>
          <span class="eyebrow" data-i18n="home_learning_badge"><?= modulesAttr('home_learning_badge') ?></span>
          <h2 data-i18n="modules.learning.title"><?= modulesAttr('modules.learning.title') ?></h2>
        </div>
        <div class="modules-learning-steps" aria-label="<?= modulesAttr('modules.learning.title') ?>">
          <span data-i18n="learning.path.step1.title"><?= modulesAttr('learning.path.step1.title') ?></span>
          <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
          <span data-i18n="learning.path.step2.title"><?= modulesAttr('learning.path.step2.title') ?></span>
          <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
          <span data-i18n="learning.path.step4.title"><?= modulesAttr('learning.path.step4.title') ?></span>
        </div>
        <a href="/modo-aprendiz.php" class="home-text-link" data-i18n="home.apprentice.link"><?= modulesAttr('home.apprentice.link') ?></a>
      </div>
    </div>
  </section>

  <section class="modules-directory-section reveal" id="complementarios" aria-label="<?= modulesAttr('modules.scale.title') ?>">
    <div class="container">
      <div class="modules-section-heading text-center">
        <span class="eyebrow" data-i18n="modules.scale.eyebrow"><?= modulesAttr('modules.scale.eyebrow') ?></span>
        <h2 class="section-title" data-i18n="modules.scale.title"><?= modulesAttr('modules.scale.title') ?></h2>
        <p class="lead-soft mx-auto" data-i18n="modules.scale.desc"><?= modulesAttr('modules.scale.desc') ?></p>
      </div>

      <div class="module-directory-grid">
        <?php foreach ($moduleGroups as $group): ?>
          <article class="module-directory-group">
            <h3 data-i18n="<?= htmlspecialchars($group['title_key'], ENT_QUOTES, 'UTF-8') ?>"><?= modulesAttr($group['title_key']) ?></h3>
            <div class="module-directory-list">
              <?php foreach ($group['modules'] as $mod): ?>
                <a href="<?= htmlspecialchars($mod['href'], ENT_QUOTES, 'UTF-8') ?>" class="indice-module-tile indice-module-tile--gray">
                  <span class="indice-module-tile__emoji" aria-hidden="true"><?= htmlspecialchars($mod['emoji'], ENT_QUOTES, 'UTF-8') ?></span>
                  <span class="indice-module-tile__name" data-i18n="<?= htmlspecialchars($mod['title_key'], ENT_QUOTES, 'UTF-8') ?>"><?= modulesAttr($mod['title_key']) ?></span>
                </a>
              <?php endforeach; ?>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="modules-ai-section reveal" id="ia" aria-label="<?= modulesAttr('modules.ai.title') ?>">
    <div class="container">
      <div class="modules-ai-panel">
        <div class="modules-ai-panel__intro">
          <span class="eyebrow" data-i18n="modules.ai.eyebrow"><?= modulesAttr('modules.ai.eyebrow') ?></span>
          <h2 class="section-title" data-i18n="modules.ai.title"><?= modulesAttr('modules.ai.title') ?></h2>
          <p class="lead-soft" data-i18n="modules.ai.desc"><?= modulesAttr('modules.ai.desc') ?></p>
        </div>
        <div class="modules-ai-grid">
          <?php foreach ($modulos_ia as $mod): ?>
            <a href="<?= getIndiceLoginUrlAttr() ?>" class="indice-module-tile indice-module-tile--gold">
              <span class="indice-module-tile__emoji" aria-hidden="true"><?= htmlspecialchars($mod['emoji'], ENT_QUOTES, 'UTF-8') ?></span>
              <span class="indice-module-tile__name" data-i18n="<?= htmlspecialchars($mod['title_key'], ENT_QUOTES, 'UTF-8') ?>"><?= modulesAttr($mod['title_key']) ?></span>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="modules-final-cta text-center reveal" aria-label="<?= modulesAttr('modules.cta.title') ?>">
    <div class="container">
      <h2 data-i18n="modules.cta.title"><?= modulesAttr('modules.cta.title') ?></h2>
      <p data-i18n="modules.cta.desc"><?= modulesAttr('modules.cta.desc') ?></p>
      <a href="<?= getIndiceLoginUrlAttr() ?>" class="btn btn-brand btn-lg" data-i18n="home_hero_cta_primary"><?= modulesAttr('home_hero_cta_primary') ?></a>
    </div>
  </section>

</main>

<?php include 'footer.php'; ?>
