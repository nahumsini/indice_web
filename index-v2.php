<?php
require_once __DIR__ . '/functions.php';

$page_title = 'Inicio';
$page_description = 'Índice organiza personas, procesos, productos y finanzas con software y acompañamiento para que tu empresa opere con claridad.';
include __DIR__ . '/header.php';

$plansUrlAttr = htmlspecialchars(getIndiceAppBaseUrl() . '/plans', ENT_QUOTES, 'UTF-8');
?>

<main class="home-v2">
  <section class="home-v2-hero">
    <div class="container">
      <div class="home-v2-hero__grid">
        <div class="home-v2-hero__copy">
          <span class="home-v2-kicker" data-i18n="home.v2.hero.eyebrow">Sistema operativo empresarial + consultoría</span>
          <h1 data-i18n="home.v2.hero.title">Tu empresa no necesita más software. Necesita más control.</h1>
          <p data-i18n="home.v2.hero.text">Índice conecta equipo, tareas, ventas, inventario y finanzas en una sola forma de operar, con un consultor certificado que te ayuda a implementarla.</p>
          <div class="home-v2-hero__actions">
            <a href="/contacto.php" class="btn btn-brand btn-lg" data-i18n="home.v2.hero.primary">Diagnosticar mi empresa</a>
            <a href="<?= $plansUrlAttr ?>" class="btn btn-ghost btn-lg" data-i18n="home.v2.hero.secondary">Ver planes</a>
          </div>
          <div class="home-v2-hero__trust" role="list">
            <span role="listitem"><i class="fa-solid fa-check"></i><span data-i18n="home.v2.hero.trust_1">15 días sin costo</span></span>
            <span role="listitem"><i class="fa-solid fa-check"></i><span data-i18n="home.v2.hero.trust_2">Consultoría mensual incluida</span></span>
            <span role="listitem"><i class="fa-solid fa-check"></i><span data-i18n="home.v2.hero.trust_3">Soporte en español e inglés</span></span>
          </div>
        </div>

        <div class="home-v2-product" aria-label="Vista del sistema Índice" data-i18n-aria-label="home.v2.product.aria">
          <div class="home-v2-product__aura" aria-hidden="true"></div>
          <div class="home-v2-product__frame">
            <div class="home-v2-product__bar"><span></span><span></span><span></span><strong>Índice</strong></div>
            <img src="/imgs/hero/dashboard-ui.svg?v=3" alt="Panel operativo de Índice" data-i18n-alt="home.v2.product.alt" width="1280" height="800">
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="home-v2-chaos" aria-labelledby="home-v2-chaos-title">
    <div class="container">
      <div class="home-v2-chaos__heading">
        <span class="home-v2-kicker" data-i18n="home.v2.chaos.eyebrow">El problema no es trabajar poco</span>
        <h2 id="home-v2-chaos-title" data-i18n="home.v2.chaos.title">Tu negocio creció. El control no creció con él.</h2>
        <p data-i18n="home.v2.chaos.text">Cuando la operación vive entre Excel, WhatsApp, mensajes y memoria, el dueño termina persiguiendo información y resolviendo todo personalmente.</p>
      </div>
      <div class="home-v2-chaos__grid">
        <article><span>01</span><h3 data-i18n="home.v2.chaos.card_1_title">Información fragmentada</h3><p data-i18n="home.v2.chaos.card_1_text">Cada área trabaja con archivos y versiones diferentes.</p></article>
        <article><span>02</span><h3 data-i18n="home.v2.chaos.card_2_title">Dependencia del dueño</h3><p data-i18n="home.v2.chaos.card_2_text">Nada avanza sin preguntas, seguimiento o autorización.</p></article>
        <article><span>03</span><h3 data-i18n="home.v2.chaos.card_3_title">Decisiones tardías</h3><p data-i18n="home.v2.chaos.card_3_text">Los problemas aparecen cuando ya costaron tiempo o dinero.</p></article>
      </div>
    </div>
  </section>

  <section class="home-v2-method" aria-labelledby="home-v2-method-title">
    <div class="container">
      <div class="home-v2-section-heading">
        <span class="home-v2-kicker" data-i18n="home.v2.method.eyebrow">Cómo entra Índice</span>
        <h2 id="home-v2-method-title" data-i18n="home.v2.method.title">Primero entendemos tu empresa. Después configuramos la solución.</h2>
      </div>
      <div class="home-v2-method__grid">
        <article><span>1</span><div><h3 data-i18n="home.v2.method.step_1_title">Diagnóstico</h3><p data-i18n="home.v2.method.step_1_text">Mapeamos personas, procesos, productos y finanzas.</p></div></article>
        <article><span>2</span><div><h3 data-i18n="home.v2.method.step_2_title">Recomendación</h3><p data-i18n="home.v2.method.step_2_text">Priorizamos los problemas y elegimos solo lo necesario.</p></div></article>
        <article><span>3</span><div><h3 data-i18n="home.v2.method.step_3_title">Implementación</h3><p data-i18n="home.v2.method.step_3_text">Configuramos responsables, reglas y operación contigo.</p></div></article>
        <article><span>4</span><div><h3 data-i18n="home.v2.method.step_4_title">Acompañamiento</h3><p data-i18n="home.v2.method.step_4_text">Revisamos adopción, resultados y la siguiente mejora.</p></div></article>
      </div>
    </div>
  </section>

  <section class="home-v2-system" aria-labelledby="home-v2-system-title">
    <div class="container">
      <div class="home-v2-system__intro">
        <div><span class="home-v2-kicker" data-i18n="home_solution_eyebrow">Sistema operativo empresarial</span><h2 id="home-v2-system-title" data-i18n="home.v2.system.title">Cuatro áreas. Una sola operación.</h2></div>
        <p data-i18n="home.v2.system.text">Índice captura lo que pasa, aplica reglas y convierte la operación diaria en decisiones claras.</p>
      </div>
      <div class="home-v2-system__grid">
        <article class="is-people"><span>01</span><h3 data-i18n="home_people_title">Personas</h3><p data-i18n="home_people_text">Equipo, responsabilidades y actividad visibles.</p></article>
        <article class="is-process"><span>02</span><h3 data-i18n="home_processes_title">Procesos</h3><p data-i18n="home_processes_text">Trabajo diario con responsables y seguimiento.</p></article>
        <article class="is-products"><span>03</span><h3 data-i18n="home_products_title">Productos</h3><p data-i18n="home_products_text">Catálogo, ventas e inventario conectados.</p></article>
        <article class="is-finance"><span>04</span><h3 data-i18n="home_finance_title">Finanzas</h3><p data-i18n="home_finance_text">Ingresos, gastos y utilidad para decidir.</p></article>
      </div>
    </div>
  </section>

  <section class="home-v2-plans" aria-labelledby="home-v2-plans-title">
    <div class="container">
      <div class="home-v2-section-heading">
        <span class="home-v2-kicker" data-i18n="home.v2.plans.eyebrow">Empieza según tu realidad</span>
        <h2 id="home-v2-plans-title" data-i18n="home.v2.plans.title">No compres módulos al azar. Elige el nivel de control que necesitas.</h2>
      </div>
      <div class="home-v2-plans__grid">
        <article><span class="home-v2-plan-dot is-aqua"></span><h3 data-i18n="plans.v2.control.name">Controla</h3><strong>$99 <small data-i18n="plans.v2.per_month">USD / mes</small></strong><p data-i18n="plans.v2.control.audience">Para ordenar al equipo y convertir el trabajo diario en procesos claros.</p></article>
        <article class="is-featured"><span class="home-v2-plan-badge" data-i18n="plans.v2.recommended">Recomendado</span><span class="home-v2-plan-dot is-coral"></span><h3 data-i18n="plans.v2.scale.name">Escala</h3><strong>$149 <small data-i18n="plans.v2.per_month">USD / mes</small></strong><p data-i18n="plans.v2.scale.audience">Para conectar equipo, operación, gastos y ventas en una sola rutina de control.</p></article>
        <article><span class="home-v2-plan-dot is-blue"></span><h3 data-i18n="plans.v2.corporate.name">Corporativiza</h3><strong>$199 <small data-i18n="plans.v2.per_month">USD / mes</small></strong><p data-i18n="plans.v2.corporate.audience">Para empresas que necesitan control integral y una base preparada para crecer.</p></article>
      </div>
      <div class="home-v2-plans__action"><a href="<?= $plansUrlAttr ?>" class="btn btn-brand btn-lg" data-i18n="home.v2.plans.cta">Comparar y configurar planes</a><p data-i18n="home.v2.plans.note">Todos incluyen 5 usuarios, 100 GB y una consultoría mensual de 60 minutos.</p></div>
    </div>
  </section>

  <section class="home-v2-guidance" aria-labelledby="home-v2-guidance-title">
    <div class="container">
      <div class="home-v2-guidance__panel">
        <div class="home-v2-guidance__mark"><img src="/imgs/logo-mark.svg" alt="" width="72" height="72"></div>
        <div><span class="home-v2-kicker" data-i18n="home.v2.guidance.eyebrow">Consultoría integrada</span><h2 id="home-v2-guidance-title" data-i18n="home.v2.guidance.title">No te entregamos software y te dejamos solo.</h2><p data-i18n="home.v2.guidance.text">Un consultor certificado te ayuda a configurar Índice, capacitar al equipo, revisar la adopción y convertir los datos en acciones para el negocio.</p></div>
        <a href="/contacto.php" class="btn btn-ghost btn-lg" data-i18n="home.v2.guidance.cta">Solicitar diagnóstico</a>
      </div>
    </div>
  </section>

  <section class="home-v2-final" aria-labelledby="home-v2-final-title">
    <div class="container">
      <div class="home-v2-final__inner">
        <span class="home-v2-kicker" data-i18n="home.v2.final.eyebrow">Prueba guiada</span>
        <h2 id="home-v2-final-title" data-i18n="home.v2.final.title">15 días para conocer Índice. Hasta 30 para implementarlo contigo.</h2>
        <p data-i18n="home.v2.final.text">Registra tu tarjeta sin cargo inicial y accede temporalmente a Corporativiza. Después de tu consultoría, un asesor autorizado puede extender la prueba una sola vez.</p>
        <div class="home-v2-final__actions"><a href="<?= $plansUrlAttr ?>" class="btn btn-brand btn-lg" data-i18n="home.v2.final.primary">Ver planes y comenzar</a><a href="/contacto.php" class="btn btn-ghost btn-lg" data-i18n="home.v2.final.secondary">Hablar con un consultor</a></div>
      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . '/footer.php'; ?>
