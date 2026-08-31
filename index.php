<?php
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/content/home-campaigns.php';

$page_title = 'Inicio';
$page_description = 'Índice conecta personas, procesos, productos y finanzas para que pequeñas empresas operen con claridad y control.';

$siteContext = resolveSiteContext();
$homeCampaignCountry = $siteContext['country'] ?? null;

if (isset($_GET['country'])) {
  $requestedCountry = strtoupper(preg_replace('/[^A-Za-z]/', '', (string)$_GET['country']));
  if (preg_match('/^[A-Z]{2}$/', $requestedCountry)) {
    $homeCampaignCountry = $requestedCountry;
  }
}

$homeCampaign = getHomeCampaignForCountry($homeCampaignCountry);
$homeCampaignPrefix = $homeCampaign['i18n_prefix'];

$pillars = [
  [
    'number' => '01',
    'tone' => 'people',
    'title_key' => 'home_people_title',
    'text_key' => 'home_people_text',
    'title' => 'Personas',
    'text' => 'Equipo, responsabilidades y actividad visibles.',
  ],
  [
    'number' => '02',
    'tone' => 'process',
    'title_key' => 'home_processes_title',
    'text_key' => 'home_processes_text',
    'title' => 'Procesos',
    'text' => 'Trabajo diario con responsables y seguimiento.',
  ],
  [
    'number' => '03',
    'tone' => 'products',
    'title_key' => 'home_products_title',
    'text_key' => 'home_products_text',
    'title' => 'Productos',
    'text' => 'Catálogo, ventas e inventario conectados.',
  ],
  [
    'number' => '04',
    'tone' => 'finance',
    'title_key' => 'home_finance_title',
    'text_key' => 'home_finance_text',
    'title' => 'Finanzas',
    'text' => 'Ingresos, gastos y utilidad para decidir.',
  ],
];

$outcomes = [
  ['number' => '01', 'key' => 'home_problem_1', 'text' => 'Ve lo que está pasando.'],
  ['number' => '02', 'key' => 'home_problem_2', 'text' => 'Sabe qué debe hacer.'],
  ['number' => '03', 'key' => 'home_problem_3', 'text' => 'Delega sin perder el control.'],
];

$learningSignals = [
  ['key' => 'home_learning_1', 'text' => 'Explica cada módulo'],
  ['key' => 'home_learning_2', 'text' => 'Guía la siguiente acción'],
  ['key' => 'home_learning_3', 'text' => 'Estandariza la operación'],
];

include __DIR__ . '/header.php';
?>

<main class="home-minimal">
  <section
    class="home-hero-minimal"
    id="hero"
    data-market-country="<?= htmlspecialchars($homeCampaign['country'], ENT_QUOTES, 'UTF-8') ?>"
    aria-label="Mensaje principal de Índice"
    data-i18n-aria-label="home.promo.aria"
  >
    <div class="container">
      <div class="home-hero-minimal__inner">
        <span
          class="home-market-label"
          data-i18n="<?= htmlspecialchars($homeCampaignPrefix . '.badge', ENT_QUOTES, 'UTF-8') ?>"
        ><?= htmlspecialchars($homeCampaign['badge'], ENT_QUOTES, 'UTF-8') ?></span>

        <h1 data-i18n="<?= htmlspecialchars($homeCampaignPrefix . '.title', ENT_QUOTES, 'UTF-8') ?>">
          <?= htmlspecialchars($homeCampaign['title'], ENT_QUOTES, 'UTF-8') ?>
        </h1>

        <p
          class="home-hero-minimal__lead"
          data-i18n="<?= htmlspecialchars($homeCampaignPrefix . '.text', ENT_QUOTES, 'UTF-8') ?>"
        ><?= htmlspecialchars($homeCampaign['text'], ENT_QUOTES, 'UTF-8') ?></p>

        <div class="home-hero-minimal__actions">
          <a href="/contacto.php" class="btn btn-brand btn-lg" data-i18n="home_hero_cta_primary">Diagnosticar mi empresa</a>
          <a href="/metodologia.php" class="btn btn-ghost btn-lg" data-i18n="nav.methodology">Cómo funciona</a>
        </div>

        <p
          class="home-hero-minimal__proof"
          data-i18n="<?= htmlspecialchars($homeCampaignPrefix . '.offer', ENT_QUOTES, 'UTF-8') ?>"
        ><?= htmlspecialchars($homeCampaign['offer'], ENT_QUOTES, 'UTF-8') ?></p>

        <div class="home-pillar-rail" aria-label="Personas, procesos, productos y finanzas" data-i18n-aria-label="home_solution_title">
          <?php foreach ($pillars as $pillar): ?>
            <span class="home-pillar-rail__item home-pillar-rail__item--<?= htmlspecialchars($pillar['tone'], ENT_QUOTES, 'UTF-8') ?>">
              <span data-i18n="<?= htmlspecialchars($pillar['title_key'], ENT_QUOTES, 'UTF-8') ?>">
                <?= htmlspecialchars($pillar['title'], ENT_QUOTES, 'UTF-8') ?>
              </span>
            </span>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="home-system-section" id="system">
    <div class="container">
      <div class="home-section-heading">
        <span class="home-section-kicker" data-i18n="home_solution_eyebrow">Sistema operativo empresarial</span>
        <h2 data-i18n="home_solution_title">Todo tu negocio. Un solo sistema.</h2>
        <p data-i18n="home_solution_intro">Índice conecta las cuatro áreas que sostienen la operación.</p>
      </div>

      <div class="home-system-grid">
        <?php foreach ($pillars as $pillar): ?>
          <article class="home-system-item home-system-item--<?= htmlspecialchars($pillar['tone'], ENT_QUOTES, 'UTF-8') ?>">
            <span class="home-system-item__number"><?= htmlspecialchars($pillar['number'], ENT_QUOTES, 'UTF-8') ?></span>
            <h3 data-i18n="<?= htmlspecialchars($pillar['title_key'], ENT_QUOTES, 'UTF-8') ?>">
              <?= htmlspecialchars($pillar['title'], ENT_QUOTES, 'UTF-8') ?>
            </h3>
            <p data-i18n="<?= htmlspecialchars($pillar['text_key'], ENT_QUOTES, 'UTF-8') ?>">
              <?= htmlspecialchars($pillar['text'], ENT_QUOTES, 'UTF-8') ?>
            </p>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="home-outcomes-section" id="outcomes">
    <div class="container">
      <div class="home-section-heading home-section-heading--compact">
        <span class="home-section-kicker" data-i18n="home_problem_title">Lo que cambia con Índice</span>
        <h2 data-i18n="home_problem_4">Claridad para operar. Control para crecer.</h2>
      </div>

      <div class="home-outcomes-grid">
        <?php foreach ($outcomes as $outcome): ?>
          <article class="home-outcome">
            <span><?= htmlspecialchars($outcome['number'], ENT_QUOTES, 'UTF-8') ?></span>
            <h3 data-i18n="<?= htmlspecialchars($outcome['key'], ENT_QUOTES, 'UTF-8') ?>">
              <?= htmlspecialchars($outcome['text'], ENT_QUOTES, 'UTF-8') ?>
            </h3>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="home-learning-section" id="learning">
    <div class="container">
      <div class="home-learning-panel">
        <div class="home-learning-panel__copy">
          <span class="home-section-kicker" data-i18n="home_learning_badge">Modo aprendiz</span>
          <h2 data-i18n="home_learning_title">Software que también te enseña a dirigir.</h2>
          <p data-i18n="home_learning_text">
            Cada módulo explica qué hacer, por qué importa y cómo convertirlo en una forma estándar de operar.
          </p>
          <a href="/modo-aprendiz.php" class="home-text-link" data-i18n="home.apprentice.link">
            Conocer el modo aprendiz
          </a>
        </div>

        <div class="home-learning-signals">
          <?php foreach ($learningSignals as $index => $signal): ?>
            <div>
              <span>0<?= $index + 1 ?></span>
              <strong data-i18n="<?= htmlspecialchars($signal['key'], ENT_QUOTES, 'UTF-8') ?>">
                <?= htmlspecialchars($signal['text'], ENT_QUOTES, 'UTF-8') ?>
              </strong>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="home-final-section" id="cta">
    <div class="container">
      <div class="home-final-section__inner">
        <span class="home-section-kicker" data-i18n="home_cta_eyebrow">Prueba guiada</span>
        <h2 data-i18n="home_cta_title">Prueba Índice con acompañamiento, no por tu cuenta.</h2>
        <p class="home-final-section__text" data-i18n="home_cta_text">
          Comienza con 15 días sin costo y acceso temporal a Corporativiza. Después de tu consultoría, un asesor autorizado puede extender tu prueba una sola vez hasta 30 días totales.
        </p>

        <div class="home-final-benefits" role="list">
          <div role="listitem">
            <span>01</span>
            <strong data-i18n="home_cta_step_1_title">Crea tu cuenta</strong>
            <small data-i18n="home_cta_step_1_text">Activa 15 días de prueba sin cargo inicial.</small>
          </div>
          <div role="listitem">
            <span>02</span>
            <strong data-i18n="home_cta_step_2_title">Completa el Panel Inicial</strong>
            <small data-i18n="home_cta_step_2_text">Realiza el BMI y el PPI para conocer a tu empresa y tu perfil como líder.</small>
          </div>
          <div role="listitem">
            <span>03</span>
            <strong data-i18n="home_cta_step_3_title">Diagnostica con un consultor</strong>
            <small data-i18n="home_cta_step_3_text">Revisa tu empresa y recibe una recomendación basada en lo que realmente necesitas.</small>
          </div>
          <div role="listitem">
            <span>04</span>
            <strong data-i18n="home_cta_step_4_title">Continúa acompañado</strong>
            <small data-i18n="home_cta_step_4_text">Confirma tu plan y continúa con una consultoría mensual incluida.</small>
          </div>
        </div>

        <div class="home-final-support">
          <strong data-i18n="home_cta_support_title">Estamos contigo durante la prueba.</strong>
          <p data-i18n="home_cta_support_text">
            Puedes avanzar por tu cuenta o pedir apoyo cuando lo necesites. Queremos que Índice se adapte a tu empresa y no al revés.
          </p>
        </div>

        <div class="home-hero-minimal__actions">
          <a href="<?= htmlspecialchars(getIndiceAppBaseUrl() . '/plans', ENT_QUOTES, 'UTF-8') ?>" class="btn btn-brand btn-lg" data-i18n="home_cta_primary">Ver planes y comenzar</a>
          <a href="/contacto.php" class="btn btn-ghost btn-lg" data-i18n="plans.v2.hero.secondary">Diagnosticar mi empresa</a>
        </div>
        <p class="home-final-section__note" data-i18n="home_cta_note">
          Consultorías disponibles en español e inglés. Para los demás idiomas, puedes utilizar Índice y recibir atención por chat.
        </p>
      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . '/footer.php'; ?>
