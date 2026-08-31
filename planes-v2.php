<?php
$page_title = 'Planes';
$page_description = 'Conoce las ofertas de Índice y configura en la plataforma el plan adecuado para ordenar y hacer crecer tu empresa.';
include 'header.php';

$plansUrlAttr = htmlspecialchars(getIndiceAppBaseUrl() . '/plans', ENT_QUOTES, 'UTF-8');
$offers = [
  ['tone' => 'aqua', 'key' => 'single', 'name' => 'Un módulo', 'price' => '79', 'audience' => 'Para resolver una necesidad puntual sin comprar de más.', 'features' => ['Elige un módulo básico', '5 usuarios incluidos', '100 GB de almacenamiento', 'Consultoría mensual de 60 minutos']],
  ['tone' => 'yellow', 'key' => 'control', 'name' => 'Controla', 'price' => '99', 'audience' => 'Para ordenar al equipo y convertir el trabajo diario en procesos claros.', 'features' => ['Recursos Humanos', 'Tareas y Procesos', '5 usuarios incluidos', 'Consultoría mensual de 60 minutos']],
  ['tone' => 'coral', 'key' => 'scale', 'name' => 'Escala', 'price' => '149', 'audience' => 'Para conectar equipo, operación, gastos y ventas en una sola rutina de control.', 'featured' => true, 'features' => ['Recursos Humanos + Tareas y Procesos', 'Gastos + Caja Chica', 'Ventas o Punto de Venta + Inventarios', 'Consultoría mensual de 60 minutos']],
  ['tone' => 'blue', 'key' => 'corporate', 'name' => 'Corporativiza', 'price' => '199', 'audience' => 'Para empresas que necesitan control integral y una base preparada para crecer.', 'features' => ['Los seis módulos básicos', 'Ventas + Punto de Venta + Cartera', '100 GB de almacenamiento', 'Consultoría mensual de 60 minutos']],
];
?>

<main class="pricing-v2-page">
  <section class="pricing-configurator-hero reveal" aria-labelledby="pricing-v2-title">
    <div class="container text-center">
      <span class="eyebrow" data-i18n="plans.v2.hero.eyebrow">Software + acompañamiento</span>
      <h1 id="pricing-v2-title" class="text-balance" data-i18n="plans.v2.hero.title">Elige una forma clara de poner tu empresa en orden.</h1>
      <p class="lead-soft mx-auto" data-i18n="plans.v2.hero.subtitle">Empieza con una necesidad puntual o conecta toda tu operación. Un consultor certificado te acompaña para convertir Índice en una forma real de trabajar.</p>
      <div class="pricing-v2-hero-actions">
        <a href="<?= $plansUrlAttr ?>" class="btn btn-brand btn-lg" data-i18n="plans.v2.hero.primary">Configurar mi plan</a>
        <a href="/contacto.php" class="btn btn-ghost btn-lg" data-i18n="plans.v2.hero.secondary">Diagnosticar mi empresa</a>
      </div>
      <p class="pricing-usd-note" data-i18n="plans.v2.hero.note">Precios mensuales en USD antes de impuestos. El precio definitivo se confirma en la plataforma.</p>
    </div>
  </section>

  <section class="pricing-v2-offers reveal" aria-labelledby="pricing-v2-offers-title">
    <div class="container">
      <div class="modules-section-heading text-center">
        <span class="eyebrow" data-i18n="plans.v2.offers.eyebrow">Una ruta para cada etapa</span>
        <h2 id="pricing-v2-offers-title" class="section-title" data-i18n="plans.v2.offers.title">No compres módulos al azar. Elige el nivel de control que necesitas.</h2>
      </div>
      <div class="pricing-v2-grid">
        <?php foreach ($offers as $offer): ?>
          <article class="pricing-v2-card pricing-v2-card--<?= htmlspecialchars($offer['tone'], ENT_QUOTES, 'UTF-8') ?><?= !empty($offer['featured']) ? ' is-featured' : '' ?>">
            <?php if (!empty($offer['featured'])): ?><span class="pricing-v2-card__badge" data-i18n="plans.v2.recommended">Recomendado</span><?php endif; ?>
            <div class="pricing-v2-card__heading">
              <h3 data-i18n="plans.v2.<?= $offer['key'] ?>.name"><?= htmlspecialchars($offer['name'], ENT_QUOTES, 'UTF-8') ?></h3>
              <p data-i18n="plans.v2.<?= $offer['key'] ?>.audience"><?= htmlspecialchars($offer['audience'], ENT_QUOTES, 'UTF-8') ?></p>
            </div>
            <div class="pricing-v2-card__price"><strong>$<?= htmlspecialchars($offer['price'], ENT_QUOTES, 'UTF-8') ?></strong><span data-i18n="plans.v2.per_month">USD / mes</span></div>
            <ul>
              <?php foreach ($offer['features'] as $index => $feature): ?>
                <li><i class="fa-solid fa-check" aria-hidden="true"></i><span data-i18n="plans.v2.<?= $offer['key'] ?>.feature_<?= $index + 1 ?>"><?= htmlspecialchars($feature, ENT_QUOTES, 'UTF-8') ?></span></li>
              <?php endforeach; ?>
            </ul>
            <a href="<?= $plansUrlAttr ?>" class="btn <?= !empty($offer['featured']) ? 'btn-brand' : 'btn-ghost' ?> w-100" data-i18n="plans.v2.offer_cta">Ver y configurar</a>
          </article>
        <?php endforeach; ?>
      </div>

      <div class="pricing-v2-custom">
        <div><span class="eyebrow" data-i18n="plans.v2.custom.eyebrow">Configuración flexible</span><h2 data-i18n="plans.v2.custom.title">¿Necesitas una combinación distinta?</h2><p data-i18n="plans.v2.custom.text">Un módulo cuesta $79 al mes. Al elegir dos o más módulos sueltos, cada uno cuesta $49 al mes. El configurador evita módulos duplicados y calcula usuarios e impuestos con el catálogo vigente.</p></div>
        <a href="<?= $plansUrlAttr ?>" class="btn btn-brand" data-i18n="plans.v2.custom.cta">Armar una configuración</a>
      </div>
    </div>
  </section>

  <section class="pricing-v2-included reveal" aria-labelledby="pricing-v2-included-title">
    <div class="container">
      <div class="modules-section-heading text-center"><span class="eyebrow" data-i18n="plans.v2.included.eyebrow">Incluido en cada suscripción</span><h2 id="pricing-v2-included-title" class="section-title" data-i18n="plans.v2.included.title">No te entregamos software y te dejamos solo.</h2></div>
      <div class="pricing-v2-benefits">
        <article><strong>5</strong><h3 data-i18n="plans.v2.included.users_title">Usuarios incluidos</h3><p data-i18n="plans.v2.included.users_text">Agrega más por $12 USD mensuales cada uno.</p></article>
        <article><strong>100 GB</strong><h3 data-i18n="plans.v2.included.storage_title">Almacenamiento incluido</h3><p data-i18n="plans.v2.included.storage_text">Los bloques adicionales de 100 GB cuestan $15 USD al mes.</p></article>
        <article><strong>60 min</strong><h3 data-i18n="plans.v2.included.consulting_title">Consultoría mensual</h3><p data-i18n="plans.v2.included.consulting_text">Una sesión no acumulable para revisar adopción y siguientes acciones.</p></article>
        <article><strong>20%</strong><h3 data-i18n="plans.v2.included.annual_title">Ahorro anual</h3><p data-i18n="plans.v2.included.annual_text">Aplica a módulos y paquetes contratados anualmente.</p></article>
      </div>
    </div>
  </section>

  <section class="pricing-v2-trial reveal" aria-labelledby="pricing-v2-trial-title">
    <div class="container">
      <div class="pricing-v2-trial__panel">
        <div><span class="eyebrow" data-i18n="plans.v2.trial.eyebrow">Prueba guiada</span><h2 id="pricing-v2-trial-title" data-i18n="plans.v2.trial.title">15 días para conocer Índice. Hasta 30 para implementarlo contigo.</h2><p data-i18n="plans.v2.trial.text">Registra tu tarjeta sin cargo inicial y accede temporalmente a Corporativiza. Después de tu consultoría, Índice o un distribuidor autorizado puede extender la prueba una sola vez hasta 30 días totales.</p></div>
        <div class="pricing-v2-trial__actions"><a href="<?= $plansUrlAttr ?>" class="btn btn-brand btn-lg" data-i18n="plans.v2.trial.primary">Comenzar prueba</a><a href="/contacto.php" class="home-text-link" data-i18n="plans.v2.trial.secondary">Hablar con un consultor</a></div>
      </div>
      <p class="pricing-v2-legal" data-i18n="plans.v2.trial.note">La extensión está sujeta a evaluación y autorización. No es automática ni acumulable. Los impuestos se calculan al contratar.</p>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
