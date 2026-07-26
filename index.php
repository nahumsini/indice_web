<?php
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/content/home-campaigns.php';

$page_title = "Inicio";
$page_description = "Índice ayuda a dueños de PYMEs a organizar, entender y controlar su negocio con un ERP modular y modo aprendiz.";

$heroVariantOverride = null;
$siteContext = resolveSiteContext();
$heroVariant = $heroVariantOverride ?: ($siteContext['heroVariant'] ?? 'b');
$homeCampaignCountry = $siteContext['country'] ?? null;
if (isset($_GET['country'])) {
  $requestedCountry = strtoupper(preg_replace('/[^A-Za-z]/', '', (string)$_GET['country']));
  if (preg_match('/^[A-Z]{2}$/', $requestedCountry)) {
    $homeCampaignCountry = $requestedCountry;
  }
}
$homeCampaign = getHomeCampaignForCountry($homeCampaignCountry);
$homeCampaignPrefix = $homeCampaign['i18n_prefix'];

$heroDashboardCandidates = [
  '/imgs/hero/dashboard-ui.svg',
  '/imgs/hero/dashboard-ui.webp',
  '/imgs/hero/dashboard-ui.png',
  '/imgs/hero/dashboard-ui.jpg',
  '/imgs/hero/dashboard-ui.jpeg',
];

$heroDashboardSrc = null;
foreach ($heroDashboardCandidates as $candidate) {
  $absoluteCandidate = __DIR__ . $candidate;
  if (is_file($absoluteCandidate)) {
    $heroDashboardSrc = $candidate . '?v=' . filemtime($absoluteCandidate);
    break;
  }
}

$heroContent = [
    'a' => [
        'badge' => 'Diagnóstico empresarial en 2 minutos',
        'title' => 'No sabes si tu negocio gana dinero.',
        'subtitle' => 'Descúbrelo en minutos y entiende qué está mal en tu empresa.',
        'bullets' => [
            'Sepa exactamente cuánto está ganando o perdiendo',
            'Detecte qué área está fallando en su negocio',
            'Reciba claridad inmediata, sin complicaciones',
        ],
        'primary_cta' => 'Descubrir mi negocio',
        'secondary_cta' => 'Ver cómo funciona',
        'microcopy' => 'Resultado inmediato. Sin registro. Sin complicaciones.',
        'dashboard_label' => 'Así se ve su negocio con Índice',
        'dashboard_note' => 'De caos a control.',
    ],

    'b' => [
        'badge' => 'Control empresarial simplificado',
        'title' => 'Su negocio está creciendo, pero no está bajo control.',
        'subtitle' => 'Índice le muestra qué está pasando realmente y cómo organizarlo.',
        'bullets' => [
            'Entienda si realmente está generando utilidad',
            'Ordene su operación sin depender de usted',
            'Tome decisiones con claridad todos los días',
        ],
        'primary_cta' => 'Descubrir mi negocio',
        'secondary_cta' => 'Ver planes',
        'microcopy' => 'En minutos verá qué está mal y cómo arreglarlo.',
        'dashboard_label' => 'Así se ve su negocio con Índice',
        'dashboard_note' => 'Menos caos. Más control.',
    ],

    'c' => [
        'badge' => 'Business diagnosis in minutes',
        'title' => 'You are running your business across too many tools.',
        'subtitle' => 'Find out what’s broken and take control in minutes.',
        'bullets' => [
            'See what is not working in your business',
            'Stop relying on scattered tools',
            'Make better decisions with clarity',
        ],
        'primary_cta' => 'Start diagnosis',
        'secondary_cta' => 'Explore platform',
        'microcopy' => 'Instant results. No signup required.',
        'dashboard_label' => 'Your business in Indice',
        'dashboard_note' => 'Less chaos. More control.',
    ],
];

  $v = $heroVariant;
  $hero = $heroContent[$v] ?? $heroContent['b'];
  $kpis = [
    [
      'key' => 'hero_kpi_sales',
      'label' => 'Ventas',
      'value' => '$248K',
    ],
    [
      'key' => 'hero_kpi_profit',
      'label' => 'Utilidad',
      'value' => '18.6%',
    ],
    [
      'key' => 'hero_kpi_tasks',
      'label' => 'Tareas',
      'value' => '3 pendientes',
    ],
    [
      'key' => 'hero_kpi_expenses',
      'label' => 'Gastos',
      'value' => '$31K',
    ],
  ];

include __DIR__ . '/header.php';
?>

<main>

  <!-- HERO -->
  <section class="home-hero hero-variant hero-variant-<?= htmlspecialchars($v, ENT_QUOTES) ?> reveal" id="hero" aria-label="Hero">
    <div class="container">
      <div class="row align-items-center g-5">

        <div class="col-lg-6">
          <span class="eyebrow" data-i18n="hero_badge">
            <?= htmlspecialchars($hero['badge'], ENT_QUOTES) ?>
          </span>

          <h1 class="home-title hero-title mt-3" data-i18n-html="hero_title">
            <?= $hero['title'] ?>
          </h1>

          <p class="home-subtitle hero-subtitle" data-i18n="hero_subtitle">
            <?= htmlspecialchars($hero['subtitle'], ENT_QUOTES) ?>
          </p>

          <ul class="hero-bullets hero-points list-unstyled mt-4 mb-0">
            <?php foreach ($hero['bullets'] as $i => $bullet): ?>
              <li>
                <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                <span data-i18n="hero_bullet_<?= $i + 1 ?>">
                  <?= htmlspecialchars($bullet, ENT_QUOTES) ?>
                </span>
              </li>
            <?php endforeach; ?>
          </ul>

          <div class="hero-actions d-flex flex-wrap gap-2 mt-4">
            <a href="contacto.php#demo" class="btn btn-brand btn-lg" data-i18n="hero_cta_primary">
              <?= htmlspecialchars($hero['primary_cta'], ENT_QUOTES) ?>
            </a>
            <a href="planes.php" class="btn btn-ghost btn-lg" data-i18n="hero_cta_secondary">
              <?= htmlspecialchars($hero['secondary_cta'], ENT_QUOTES) ?>
            </a>
          </div>

          <p class="hero-microcopy mt-3" data-i18n="hero_microcopy">
            <?= htmlspecialchars($hero['microcopy'], ENT_QUOTES) ?>
          </p>

          <p class="small text-muted mt-2" data-i18n="hero_available_languages">
            Disponible en múltiples idiomas y países.
          </p>
        </div>

        <div class="col-lg-6">
          <div class="product-stage product-stage-laptop">
            <span class="preview-label" data-i18n="hero_dashboard_label">
              <?= htmlspecialchars($hero['dashboard_label'], ENT_QUOTES) ?>
            </span>

            <div class="hero-visual-shell" aria-hidden="true">
              <div class="hero-visual-aura"></div>

              <div class="saas-laptop">
                <div class="saas-laptop__screen-frame">
                  <div class="saas-laptop__camera"></div>

                  <div class="saas-laptop__screen">
                    <?php if ($heroDashboardSrc): ?>
                      <img
                        src="<?= htmlspecialchars($heroDashboardSrc, ENT_QUOTES) ?>"
                        alt="Vista del dashboard de Índice con métricas, operaciones y equipo"
                        class="saas-laptop__screen-image"
                        width="1280"
                        height="800"
                        fetchpriority="high"
                        decoding="async"
                      >
                    <?php else: ?>
                      <div class="saas-laptop__fallback">
                        <div class="hero-dashboard-card dashboard-preview system-preview bg-card hero-dashboard saas-screen-fallback">
                          <div class="preview-top" aria-hidden="true">
                            <span class="dot"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                          </div>

                          <div class="hero-kpis" aria-label="Indicadores clave del negocio">
                            <?php foreach ($kpis as $kpi): ?>
                              <div class="hero-kpi">
                                <span data-i18n="<?= htmlspecialchars($kpi['key'], ENT_QUOTES) ?>">
                                  <?= htmlspecialchars($kpi['label'], ENT_QUOTES) ?>
                                </span>
                                <strong><?= htmlspecialchars($kpi['value'], ENT_QUOTES) ?></strong>
                              </div>
                            <?php endforeach; ?>
                          </div>

                          <div class="hero-module-grid module-strip" aria-label="Módulos de Índice">
                            <span class="module-chip module-theme-panel">
                              <i class="fa-solid fa-gauge-high"></i>
                              <span data-i18n="hero_module_panel">Panel Inicial</span>
                            </span>

                            <span class="module-chip module-theme-personas">
                              <i class="fa-solid fa-user-group"></i>
                              <span data-i18n="hero_module_hr">Recursos Humanos</span>
                            </span>

                            <span class="module-chip module-theme-procesos">
                              <i class="fa-solid fa-diagram-project"></i>
                              <span data-i18n="hero_module_tasks">Tareas y Procesos</span>
                            </span>

                            <span class="module-chip module-theme-finanzas">
                              <i class="fa-solid fa-sack-dollar"></i>
                              <span data-i18n="hero_module_expenses">Gastos</span>
                            </span>

                            <span class="module-chip module-theme-productos">
                              <i class="fa-solid fa-cash-register"></i>
                              <span data-i18n="hero_module_pos">POS</span>
                            </span>

                            <span class="module-chip module-theme-ia">
                              <i class="fa-solid fa-brain"></i>
                              <span data-i18n="hero_module_ai">IA</span>
                            </span>
                          </div>

                          <div class="hero-dashboard-note" data-i18n="hero_dashboard_note">
                            <?= htmlspecialchars($hero['dashboard_note'], ENT_QUOTES) ?>
                          </div>
                        </div>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>

                <div class="saas-laptop__base"></div>
                <div class="saas-laptop__trackpad"></div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- PROMO POR PAÍS -->
  <section
    class="home-market-promo home-market-promo--<?= htmlspecialchars($homeCampaign['theme'], ENT_QUOTES) ?> reveal"
    id="market-promo"
    data-market-country="<?= htmlspecialchars($homeCampaign['country'], ENT_QUOTES) ?>"
    data-market-campaign="<?= htmlspecialchars($homeCampaign['campaign_id'], ENT_QUOTES) ?>"
    aria-label="Promoción personalizada por país"
    data-i18n-aria-label="home.promo.aria"
  >
    <div class="container">
      <div class="home-market-promo__grid">
        <div class="home-market-promo__copy">
          <span class="market-badge">
            <img src="<?= htmlspecialchars($homeCampaign['flag'], ENT_QUOTES) ?>" alt="" width="22" height="16" loading="lazy" decoding="async" aria-hidden="true">
            <span data-i18n="<?= htmlspecialchars($homeCampaignPrefix . '.badge', ENT_QUOTES) ?>">
              <?= htmlspecialchars($homeCampaign['badge'], ENT_QUOTES) ?>
            </span>
          </span>

          <h2 data-i18n="<?= htmlspecialchars($homeCampaignPrefix . '.title', ENT_QUOTES) ?>">
            <?= htmlspecialchars($homeCampaign['title'], ENT_QUOTES) ?>
          </h2>

          <p data-i18n="<?= htmlspecialchars($homeCampaignPrefix . '.text', ENT_QUOTES) ?>">
            <?= htmlspecialchars($homeCampaign['text'], ENT_QUOTES) ?>
          </p>

          <div class="market-offer">
            <i class="fa-solid fa-bolt" aria-hidden="true"></i>
            <span data-i18n="<?= htmlspecialchars($homeCampaignPrefix . '.offer', ENT_QUOTES) ?>">
              <?= htmlspecialchars($homeCampaign['offer'], ENT_QUOTES) ?>
            </span>
          </div>

          <div class="d-flex flex-wrap gap-2 mt-4">
            <a
              href="contacto.php?campaign=<?= rawurlencode($homeCampaign['campaign_id']) ?>#demo"
              class="btn btn-market-primary"
              data-i18n="home.promo.cta.primary"
            >Agendar diagnóstico</a>
            <a href="modulos.php" class="btn btn-market-secondary" data-i18n="home.promo.cta.secondary">Ver módulos</a>
          </div>
        </div>

        <div class="market-metrics" aria-label="Indicadores de campaña" data-i18n-aria-label="home.promo.metrics_aria">
          <?php foreach ($homeCampaign['metrics'] as $idx => $metric): ?>
            <?php $metricNumber = $idx + 1; ?>
            <div class="market-metric">
              <strong data-i18n="<?= htmlspecialchars($homeCampaignPrefix . '.metric_' . $metricNumber . '.value', ENT_QUOTES) ?>">
                <?= htmlspecialchars($metric['value'], ENT_QUOTES) ?>
              </strong>
              <span data-i18n="<?= htmlspecialchars($homeCampaignPrefix . '.metric_' . $metricNumber . '.label', ENT_QUOTES) ?>">
                <?= htmlspecialchars($metric['label'], ENT_QUOTES) ?>
              </span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <!-- PROBLEMA -->
  <section class="py-6 bg-card reveal" id="problem">
    <div class="container">
      <div class="text-center mb-4">
        <h2 class="section-title" data-i18n="home_problem_title">
          ¿Siente que se le arma el desorden y todo termina cayendo en usted?
        </h2>
      </div>

      <div class="row g-3">
        <div class="col-md-6 col-lg-3">
          <div class="card-min outcome-card h-100 p-4">
            <i class="fa-solid fa-chart-line"></i>
            <h3 data-i18n="home_problem_1">No sabe si realmente está ganando dinero.</h3>
          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="card-min outcome-card h-100 p-4">
            <i class="fa-solid fa-user-clock"></i>
            <h3 data-i18n="home_problem_2">Todo depende de usted.</h3>
          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="card-min outcome-card h-100 p-4">
            <i class="fa-solid fa-plug-circle-xmark"></i>
            <h3 data-i18n="home_problem_3">Usa Excel, WhatsApp y notas sueltas.</h3>
          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="card-min outcome-card h-100 p-4">
            <i class="fa-solid fa-magnifying-glass-chart"></i>
            <h3 data-i18n="home_problem_4">Se le va el tiempo en lo operativo.</h3>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- SOLUCIÓN -->
  <section class="py-6 bg-surface home-pillars reveal" id="solution">
    <div class="container">
      <div class="text-center mb-5">
        <span class="eyebrow" data-i18n="home_solution_eyebrow">Sistema operativo empresarial</span>
        <h2 class="section-title mb-3" data-i18n="home_solution_title">
          Todo su negocio, organizado en 4 pilares
        </h2>
        <p class="section-subtitle" data-i18n="home_solution_intro">
          Cuando una falla, toda la empresa lo siente. Índice las conecta para que pueda operar con claridad.
        </p>
      </div>

      <div class="row g-4">
        <div class="col-md-6 col-lg-3">
          <article class="pillar-card-v2 pillar-card-v2--people h-100">
            <span class="pillar-card-v2__icon" aria-hidden="true"><i class="fa-solid fa-user-group"></i></span>
            <h4 data-i18n="home_people_title">Personas</h4>
            <p data-i18n="home_people_text">Su equipo, asistencia y comunicación.</p>
            <span class="pillar-card-v2__bar" aria-hidden="true"></span>
          </article>
        </div>

        <div class="col-md-6 col-lg-3">
          <article class="pillar-card-v2 pillar-card-v2--process h-100">
            <span class="pillar-card-v2__icon" aria-hidden="true"><i class="fa-solid fa-gears"></i></span>
            <h4 data-i18n="home_processes_title">Procesos</h4>
            <p data-i18n="home_processes_text">Las tareas y operación del día a día.</p>
            <span class="pillar-card-v2__bar" aria-hidden="true"></span>
          </article>
        </div>

        <div class="col-md-6 col-lg-3">
          <article class="pillar-card-v2 pillar-card-v2--products h-100">
            <span class="pillar-card-v2__icon" aria-hidden="true"><i class="fa-solid fa-box-open"></i></span>
            <h4 data-i18n="home_products_title">Productos</h4>
            <p data-i18n="home_products_text">Lo que vende y cómo lo vende.</p>
            <span class="pillar-card-v2__bar" aria-hidden="true"></span>
          </article>
        </div>

        <div class="col-md-6 col-lg-3">
          <article class="pillar-card-v2 pillar-card-v2--finance h-100">
            <span class="pillar-card-v2__icon" aria-hidden="true"><i class="fa-solid fa-chart-simple"></i></span>
            <h4 data-i18n="home_finance_title">Finanzas</h4>
            <p data-i18n="home_finance_text">Su dinero, gastos e ingresos claros.</p>
            <span class="pillar-card-v2__bar" aria-hidden="true"></span>
          </article>
        </div>
      </div>
    </div>
  </section>

  <!-- MODO APRENDIZ -->
  <section class="py-6 bg-card reveal" id="learning">
    <div class="container text-center">
      <span class="badge-indice badge-indice-dashboard mb-3">
        <i class="fa-solid fa-graduation-cap"></i>
        <span data-i18n="home_learning_badge">Modo aprendiz</span>
      </span>

      <h2 class="section-title mb-3" data-i18n="home_learning_title">
        Índice no solo organiza su negocio, lo enseña a administrarlo
      </h2>

      <p class="section-subtitle mb-4" data-i18n="home_learning_text">
        El sistema le guía paso a paso para que entienda qué hacer, sin ser experto.
      </p>

      <div class="row g-3 justify-content-center">
        <div class="col-md-4 col-lg-3">
          <div class="card-min p-4 h-100">
            <i class="fa-solid fa-circle-info mb-2"></i>
            <h4 data-i18n="home_learning_1">Explica cada módulo</h4>
          </div>
        </div>

        <div class="col-md-4 col-lg-3">
          <div class="card-min p-4 h-100">
            <i class="fa-solid fa-route mb-2"></i>
            <h4 data-i18n="home_learning_2">Le dice qué hacer</h4>
          </div>
        </div>

        <div class="col-md-4 col-lg-3">
          <div class="card-min p-4 h-100">
            <i class="fa-solid fa-shield-check mb-2"></i>
            <h4 data-i18n="home_learning_3">Reduce errores</h4>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA FINAL -->
  <section class="py-6 text-center reveal" id="cta">
    <div class="container">
      <h2 class="section-title mb-3" data-i18n="home_cta_title">
        Empiece a tomar control de su negocio hoy
      </h2>

      <p class="section-subtitle mb-4" data-i18n="home_cta_text">
        Pruebe Índice y lleve su empresa al siguiente nivel.
      </p>

      <div class="d-flex justify-content-center gap-3 flex-wrap">
        <a href="contacto.php#demo" class="btn btn-brand btn-lg" data-i18n="home_cta_primary">
          Agenda una demo
        </a>

        <a href="planes.php" class="btn btn-ghost btn-lg" data-i18n="home_cta_secondary">
          Ver planes
        </a>
      </div>
    </div>
  </section>

</main>

<?php include __DIR__ . '/footer.php'; ?>