<?php
$page_title = "Planes";
$page_description = "Planes de Índice para ordenar tu operación, controlar ventas y finanzas, y escalar con IA y módulos a la medida.";
include 'header.php';
?>

<main>
  <section class="page-hero bg-surface reveal" aria-label="Planes">
    <div class="container text-center">
      <span class="eyebrow" data-i18n="plans.hero.eyebrow">Planes por etapa</span>
      <h1 class="display-5 fw-bold text-balance mb-3" data-i18n="plans.hero.title">Elige cómo quiere empezar a tomar control</h1>
      <p class="lead lead-soft mb-4" data-i18n="plans.hero.subtitle">Índice crece con su negocio: empiece por poner orden en la operación, avance a ventas y finanzas, y escale cuando necesite más.</p>
      <a href="contacto.php#demo" class="btn btn-brand btn-lg" data-i18n="plans.hero.cta">Comenzar ahora</a>
    </div>
  </section>

  <section class="py-6 bg-card reveal" aria-label="Tarjetas de planes">
    <div class="container">
      <div class="pricing-billing-toggle" aria-label="Billing period selector">
        <button type="button" class="pricing-billing-option is-active" data-i18n="plans.billing.monthly">Mensual</button>
        <button type="button" class="pricing-billing-option" data-i18n="plans.billing.yearly">Anual</button>
        <span class="pricing-billing-discount" data-i18n="plans.billing.discount">-20%</span>
      </div>

      <div class="row g-4 pricing-plan-grid">
        <div class="col-lg-4 pricing-card-wrap pricing-card-wrap-control">
          <article class="plan-card-v2 plan-card-control h-100">
            <span class="badge-indice badge-indice-panel" data-i18n="plans.control.badge">Índice Control</span>
            <h2 data-i18n="plans.control.title">Para empezar a ordenar</h2>
            <p class="plan-message" data-i18n="plans.control.subtitle">Para negocios que quieren organizar equipo, tareas y operación diaria sin complicarse.</p>
            <div class="plan-price" data-i18n-html="plans.control.price_html">$79 <span>USD/mes</span></div>
            <p class="plan-users" data-i18n-html="plans.control.users_html">Incluye 5 usuarios<br>Usuario adicional: $10 USD/mes</p>
            <p class="plan-trust" data-i18n="plans.trust">Sin contratos · Cancela cuando quieras</p>
            <ul>
              <li data-i18n="plans.control.feature_1">Panel Inicial</li>
              <li data-i18n="plans.control.feature_2">Recursos Humanos</li>
              <li data-i18n="plans.control.feature_3">Tareas y Procesos</li>
              <li data-i18n="plans.control.feature_4">KPIs básicos</li>
            </ul>
            <a href="contacto.php#demo" class="btn btn-ghost w-100" data-i18n="plans.control.cta">Elegir Control</a>
          </article>
        </div>

        <div class="col-lg-4 pricing-card-wrap pricing-card-wrap-scale">
          <article class="plan-card-v2 plan-card-scale featured h-100">
            <div class="plan-badge-row">
              <span class="badge-indice badge-indice-finanzas" data-i18n="plans.scale.badge">Índice Escala</span>
              <span class="plan-popular-badge" data-i18n="plans.scale.popular">Most popular</span>
            </div>
            <h2 data-i18n="plans.scale.title">Para tomar control real</h2>
            <p class="plan-message" data-i18n="plans.scale.subtitle">Para negocios que necesitan conectar operación, ventas, gastos, caja y decisiones.</p>
            <div class="plan-price" data-i18n-html="plans.scale.price_html">$199 <span>USD/mes</span></div>
            <p class="plan-users" data-i18n-html="plans.scale.users_html">Incluye 5 usuarios<br>Usuario adicional: $12 USD/mes</p>
            <p class="plan-trust" data-i18n="plans.trust">Sin contratos · Cancela cuando quieras</p>
            <p class="plan-hover-note" data-i18n="plans.scale.hover">Most teams upgrade here within 30 days</p>
            <ul>
              <li data-i18n="plans.scale.feature_1">Todo lo del Plan Control</li>
              <li data-i18n="plans.scale.feature_2">Punto de Venta</li>
              <li data-i18n="plans.scale.feature_3">Control de Gastos</li>
              <li data-i18n="plans.scale.feature_4">Caja Chica</li>
              <li data-i18n="plans.scale.feature_5">KPIs avanzados</li>
            </ul>
            <a href="contacto.php#demo" class="btn btn-brand w-100" data-i18n="plans.scale.cta">Elegir Escala</a>
          </article>
        </div>

        <div class="col-lg-4 pricing-card-wrap pricing-card-wrap-corporate">
          <article class="plan-card-v2 plan-card-corporate h-100">
            <span class="badge-indice badge-indice-ia" data-i18n="plans.corp.badge">Índice Corporativo</span>
            <h2 data-i18n="plans.corp.title">Para escalar con inteligencia</h2>
            <p class="plan-message" data-i18n="plans.corp.subtitle">Para empresas que necesitan automatización, personalización, IA y módulos propios.</p>
            <div class="plan-price" data-i18n="plans.corp.price">Cotización personalizada</div>
            <p class="plan-users" data-i18n="plans.corp.users">Solución a la medida</p>
            <p class="plan-trust" data-i18n="plans.trust">Sin contratos · Cancela cuando quieras</p>
            <ul>
              <li data-i18n="plans.corp.feature_1">Todos los módulos básicos</li>
              <li data-i18n="plans.corp.feature_2">Módulos de inteligencia artificial</li>
              <li data-i18n="plans.corp.feature_3">Módulos especializados hechos a la medida</li>
              <li data-i18n="plans.corp.feature_4">Automatización avanzada y escalabilidad</li>
            </ul>
            <a href="contacto.php#demo" class="btn btn-ghost w-100" data-i18n="plans.corp.cta">Solicitar cotización</a>
          </article>
        </div>
      </div>
    </div>
  </section>

  <section class="py-6 bg-surface reveal" aria-label="Qué plan necesito">
    <div class="container">
      <div class="text-center mb-4">
        <h2 class="section-title" data-i18n="plans.selector.title">Elija según el problema que quiere resolver primero</h2>
        <p class="lead-soft" data-i18n="plans.selector.subtitle">No tiene que decidir todo hoy. Empiece por la prioridad que más urge resolver.</p>
      </div>
      <div class="row g-3">
        <div class="col-md-4">
          <div class="card-min decision-card h-100 p-4">
            <span class="badge-indice badge-indice-panel" data-i18n="plans.selector.control.badge">Control</span>
            <h3 data-i18n="plans.selector.control.text">Si hoy necesita ordenar equipo y tareas.</h3>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-min decision-card h-100 p-4">
            <span class="badge-indice badge-indice-finanzas" data-i18n="plans.selector.scale.badge">Escala</span>
            <h3 data-i18n="plans.selector.scale.text">Si ya necesita controlar ventas, gastos, caja y KPIs.</h3>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-min decision-card h-100 p-4">
            <span class="badge-indice badge-indice-ia" data-i18n="plans.selector.corp.badge">Corporativo</span>
            <h3 data-i18n="plans.selector.corp.text">Si necesita IA, automatización o módulos propios.</h3>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-6 bg-card text-center reveal" aria-label="CTA planes">
    <div class="container">
      <div class="cta-box cta-box-strong">
        <h2 data-i18n="plans.cta.title">No necesita tener todo resuelto para empezar</h2>
        <p data-i18n="plans.cta.desc">Empiece con lo esencial. Índice crece con su negocio.</p>
        <a href="contacto.php#demo" class="btn btn-brand btn-lg" data-i18n="plans.cta.primary">Book a demo</a>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
