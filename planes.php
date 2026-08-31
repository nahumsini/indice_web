<?php
if (is_file(__DIR__ . '/planes-v2.php')) {
  require __DIR__ . '/planes-v2.php';
  return;
}

$page_title = "Planes";
$page_description = "Configura tu plan de Índice con módulos básicos, empleados y consultorías. Consulta tu precio mensual estimado en tiempo real.";
include 'header.php';
?>

<main class="pricing-configurator-page">
  <section class="pricing-configurator-hero reveal" aria-labelledby="pricing-configurator-title">
    <div class="container text-center">
      <span class="eyebrow" data-i18n="plans.config.hero.eyebrow">Plan a tu medida</span>
      <h1 id="pricing-configurator-title" class="text-balance" data-i18n="plans.config.hero.title">Elige lo que necesitas. Ve tu precio al instante.</h1>
      <p class="lead-soft mx-auto" data-i18n="plans.config.hero.subtitle">Combina los módulos básicos de Índice y paga únicamente por la estructura que necesita tu empresa.</p>

      <div class="pricing-launch-banner">
        <span class="pricing-launch-banner__badge" data-i18n="plans.config.launch.badge">Precio de lanzamiento</span>
        <strong data-i18n="plans.config.launch.title">50% de la tarifa regular</strong>
        <span data-i18n="plans.config.launch.desc">Contrata ahora y conserva tu tarifa mensual de lealtad mientras tu suscripción permanezca activa.</span>
      </div>

      <div class="pricing-tier-scale" aria-label="Escala de precios mensuales" data-i18n-aria-label="plans.config.tiers.aria">
        <div class="pricing-tier-scale__item" data-pricing-tier="1">
          <span data-i18n="plans.config.tiers.one">1 combinación</span>
          <strong>$69</strong>
        </div>
        <div class="pricing-tier-scale__item" data-pricing-tier="2">
          <span data-i18n="plans.config.tiers.two">2 combinaciones</span>
          <strong>$109</strong>
        </div>
        <div class="pricing-tier-scale__item" data-pricing-tier="3">
          <span data-i18n="plans.config.tiers.three">3 combinaciones</span>
          <strong>$149</strong>
        </div>
        <div class="pricing-tier-scale__item" data-pricing-tier="4">
          <span data-i18n="plans.config.tiers.complete">4 o todas</span>
          <strong>$199</strong>
        </div>
      </div>
      <p class="pricing-usd-note" data-i18n="plans.config.usd_note">Precios mensuales en USD antes de impuestos.</p>
    </div>
  </section>

  <section class="pricing-builder-section reveal" aria-labelledby="pricing-builder-title">
    <div class="container">
      <div class="pricing-builder-layout">
        <div class="pricing-builder-controls">
          <section class="pricing-builder-panel" aria-labelledby="pricing-builder-title">
            <div class="pricing-builder-panel__heading">
              <div>
                <span class="eyebrow" data-i18n="plans.config.modules.eyebrow">Módulos básicos elegibles</span>
                <h2 id="pricing-builder-title" data-i18n="plans.config.modules.title">Arma la base de tu operación</h2>
                <p data-i18n="plans.config.modules.desc">Cada tarjeta cuenta como una combinación, aunque incluya dos módulos conectados.</p>
              </div>
              <div class="pricing-builder-actions">
                <button type="button" class="pricing-text-action" data-pricing-select-all data-i18n="plans.config.actions.all">Elegir todos</button>
                <button type="button" class="pricing-text-action" data-pricing-clear data-i18n="plans.config.actions.clear">Limpiar</button>
              </div>
            </div>

            <div class="pricing-module-options">
              <button type="button" class="pricing-module-option pricing-module-option--aqua" data-pricing-module="human-resources" aria-pressed="false">
                <span class="pricing-module-option__check" aria-hidden="true"><i class="fa-solid fa-check"></i></span>
                <span class="pricing-module-option__emojis" aria-hidden="true">👥</span>
                <span class="pricing-module-option__names">
                  <strong data-i18n="modules.core.rh.title">Recursos Humanos</strong>
                </span>
                <small data-i18n="plans.config.modules.counts_one">Cuenta como 1</small>
              </button>

              <button type="button" class="pricing-module-option pricing-module-option--yellow" data-pricing-module="processes" aria-pressed="false">
                <span class="pricing-module-option__check" aria-hidden="true"><i class="fa-solid fa-check"></i></span>
                <span class="pricing-module-option__emojis" aria-hidden="true">✅</span>
                <span class="pricing-module-option__names">
                  <strong data-i18n="modules.core.process.title">Procesos y tareas</strong>
                </span>
                <small data-i18n="plans.config.modules.counts_one">Cuenta como 1</small>
              </button>

              <button type="button" class="pricing-module-option pricing-module-option--green" data-pricing-module="expenses-cash" aria-pressed="false">
                <span class="pricing-module-option__check" aria-hidden="true"><i class="fa-solid fa-check"></i></span>
                <span class="pricing-module-option__emojis" aria-hidden="true"><span>💸</span><span>💰</span></span>
                <span class="pricing-module-option__names">
                  <strong><span data-i18n="modules.core.expenses.title">Gastos</span> + <span data-i18n="modules.core.cash.title">Caja chica</span></strong>
                </span>
                <small data-i18n="plans.config.modules.counts_one">Cuenta como 1</small>
              </button>

              <button type="button" class="pricing-module-option pricing-module-option--coral" data-pricing-module="pos-inventory" aria-pressed="false">
                <span class="pricing-module-option__check" aria-hidden="true"><i class="fa-solid fa-check"></i></span>
                <span class="pricing-module-option__emojis" aria-hidden="true"><span>🛒</span><span>📦</span></span>
                <span class="pricing-module-option__names">
                  <strong><span data-i18n="modules.core.pos.title">Punto de venta</span> + <span data-i18n="modules.core.inventory.title">Inventarios</span></strong>
                </span>
                <small data-i18n="plans.config.modules.counts_one">Cuenta como 1</small>
              </button>

              <button type="button" class="pricing-module-option pricing-module-option--coral" data-pricing-module="sales-inventory" aria-pressed="false">
                <span class="pricing-module-option__check" aria-hidden="true"><i class="fa-solid fa-check"></i></span>
                <span class="pricing-module-option__emojis" aria-hidden="true"><span>💼</span><span>📦</span></span>
                <span class="pricing-module-option__names">
                  <strong><span data-i18n="modules.core.sales.title">Ventas</span> + <span data-i18n="modules.core.inventory.title">Inventarios</span></strong>
                </span>
                <small data-i18n="plans.config.modules.counts_one">Cuenta como 1</small>
              </button>
            </div>
          </section>

          <section class="pricing-builder-panel" aria-labelledby="pricing-extras-title">
            <div class="pricing-builder-panel__heading">
              <div>
                <span class="eyebrow" data-i18n="plans.config.extras.eyebrow">Ajusta tu equipo y acompañamiento</span>
                <h2 id="pricing-extras-title" data-i18n="plans.config.extras.title">Completa tu estimación</h2>
              </div>
            </div>

            <div class="pricing-extra-grid">
              <article class="pricing-extra-control">
                <div>
                  <span class="pricing-extra-control__icon" aria-hidden="true">👥</span>
                  <h3 data-i18n="plans.config.employees.title">Empleados</h3>
                  <p data-i18n="plans.config.employees.desc">Incluye 5 empleados. Cada empleado adicional cuesta $12 USD al mes.</p>
                </div>
                <div class="pricing-stepper" role="group" aria-label="Número de empleados" data-i18n-aria-label="plans.config.employees.aria">
                  <button type="button" data-pricing-stepper="employees" data-direction="-1" aria-label="Restar empleado" data-i18n-aria-label="plans.config.employees.minus">−</button>
                  <output data-pricing-employees>5</output>
                  <button type="button" data-pricing-stepper="employees" data-direction="1" aria-label="Agregar empleado" data-i18n-aria-label="plans.config.employees.plus">+</button>
                </div>
              </article>

              <article class="pricing-extra-control">
                <div>
                  <span class="pricing-extra-control__icon" aria-hidden="true">🤝</span>
                  <h3 data-i18n="plans.config.consulting.title">Consultorías adicionales</h3>
                  <p data-i18n="plans.config.consulting.desc">Tu primera consultoría de 50 minutos está incluida. Cada sesión adicional cuesta $89 USD.</p>
                </div>
                <div class="pricing-stepper" role="group" aria-label="Consultorías adicionales" data-i18n-aria-label="plans.config.consulting.aria">
                  <button type="button" data-pricing-stepper="consulting" data-direction="-1" aria-label="Restar consultoría" data-i18n-aria-label="plans.config.consulting.minus">−</button>
                  <output data-pricing-consulting>0</output>
                  <button type="button" data-pricing-stepper="consulting" data-direction="1" aria-label="Agregar consultoría" data-i18n-aria-label="plans.config.consulting.plus">+</button>
                </div>
              </article>
            </div>
          </section>

          <section class="pricing-builder-panel" aria-labelledby="pricing-tax-title">
            <div class="pricing-builder-panel__heading">
              <div>
                <span class="eyebrow" data-i18n="plans.config.tax.eyebrow">Estimación fiscal</span>
                <h2 id="pricing-tax-title" data-i18n="plans.config.tax.title">Selecciona tu país de facturación</h2>
                <p data-i18n="plans.config.tax.desc">Mostramos una referencia. El impuesto definitivo se determina con la dirección fiscal y las reglas aplicables al momento del cobro.</p>
              </div>
            </div>

            <div class="pricing-tax-fields">
              <label>
                <span data-i18n="plans.config.tax.country">País</span>
                <select class="form-select" data-pricing-country>
                  <option value="MX" data-i18n="plans.config.tax.country_mx">México</option>
                  <option value="CA" data-i18n="plans.config.tax.country_ca">Canadá</option>
                  <option value="US" data-i18n="plans.config.tax.country_us">Estados Unidos</option>
                  <option value="CO" data-i18n="plans.config.tax.country_co">Colombia</option>
                  <option value="BR" data-i18n="plans.config.tax.country_br">Brasil</option>
                </select>
              </label>

              <label data-pricing-canada-region hidden>
                <span data-i18n="plans.config.tax.canada_region">Provincia o región fiscal</span>
                <select class="form-select" data-pricing-canada-rate>
                  <option value="0.05" data-tax-label="GST 5%" data-i18n="plans.config.tax.ca_gst5">GST 5% · AB, BC, MB, QC, SK y territorios</option>
                  <option value="0.13" data-tax-label="HST 13%" data-i18n="plans.config.tax.ca_hst13">HST 13% · Ontario</option>
                  <option value="0.14" data-tax-label="HST 14%" data-i18n="plans.config.tax.ca_hst14">HST 14% · Nova Scotia</option>
                  <option value="0.15" data-tax-label="HST 15%" data-i18n="plans.config.tax.ca_hst15">HST 15% · NB, NL y PEI</option>
                </select>
              </label>
            </div>

            <div class="pricing-tax-notes" aria-live="polite">
              <p data-pricing-tax-note="MX" data-i18n="plans.config.tax.note_mx">Estimación con IVA general del 16%.</p>
              <p data-pricing-tax-note="CA" data-i18n="plans.config.tax.note_ca" hidden>La estimación muestra GST/HST según la región seleccionada; otros impuestos provinciales pueden aplicar.</p>
              <p data-pricing-tax-note="US" data-i18n="plans.config.tax.note_us" hidden>El sales tax se calcula al pagar según el estado y la localidad de la dirección de facturación.</p>
              <p data-pricing-tax-note="CO" data-i18n="plans.config.tax.note_co" hidden>Estimación con la tarifa general de IVA del 19%.</p>
              <p data-pricing-tax-note="BR" data-i18n="plans.config.tax.note_br" hidden>Los impuestos se calculan al pagar según el municipio, el régimen aplicable y la transición fiscal vigente.</p>
            </div>
          </section>
        </div>

        <aside class="pricing-summary-card" aria-labelledby="pricing-summary-title" data-pricing-summary>
          <div class="pricing-summary-card__topline">
            <span class="pricing-summary-card__badge" data-i18n="plans.config.summary.eyebrow">Tu configuración</span>
            <span class="pricing-summary-card__loyalty" data-i18n="plans.config.summary.loyalty">Tarifa de lealtad</span>
          </div>
          <h2 id="pricing-summary-title" data-i18n="plans.config.summary.title">Precio estimado</h2>

          <div class="pricing-summary-selection">
            <span data-pricing-selection-empty data-i18n="plans.config.summary.empty">Selecciona al menos una combinación</span>
            <span data-pricing-selection-count-wrap hidden>
              <strong data-pricing-selected-count>0</strong>
              <span data-i18n="plans.config.summary.combinations">combinaciones seleccionadas</span>
            </span>
          </div>

          <div class="pricing-summary-price">
            <span data-pricing-launch-price>$0</span>
            <small data-i18n="plans.config.summary.per_month">USD / mes</small>
          </div>
          <p class="pricing-summary-regular">
            <span data-i18n="plans.config.summary.regular">Tarifa regular:</span>
            <del data-pricing-regular-price>$0</del>
          </p>

          <dl class="pricing-summary-breakdown">
            <div>
              <dt data-i18n="plans.config.summary.plan">Plan mensual</dt>
              <dd data-pricing-plan-price>$0</dd>
            </div>
            <div>
              <dt data-i18n="plans.config.summary.extra_employees">Empleados adicionales</dt>
              <dd data-pricing-employees-price>$0</dd>
            </div>
            <div>
              <dt data-i18n="plans.config.summary.monthly_subtotal">Subtotal mensual</dt>
              <dd data-pricing-monthly-subtotal>$0</dd>
            </div>
            <div>
              <dt data-i18n="plans.config.summary.extra_consulting">Consultorías adicionales · pago único</dt>
              <dd data-pricing-consulting-price>$0</dd>
            </div>
            <div>
              <dt><span data-i18n="plans.config.summary.tax">Impuestos estimados</span> · <span data-pricing-tax-label>IVA 16%</span></dt>
              <dd data-pricing-tax-price>$0</dd>
            </div>
          </dl>

          <div class="pricing-summary-total">
            <span data-i18n="plans.config.summary.first_invoice">Primera factura estimada</span>
            <strong data-pricing-first-total>$0</strong>
          </div>
          <div class="pricing-summary-recurring">
            <span data-i18n="plans.config.summary.recurring">Mensualidad posterior estimada</span>
            <strong data-pricing-recurring-total>$0</strong>
          </div>

          <p class="pricing-summary-pending-tax" data-pricing-pending-tax hidden data-i18n="plans.config.summary.pending_tax">Impuestos por calcular al confirmar la dirección de facturación.</p>
          <span class="visually-hidden" data-pricing-tax-pending-label data-i18n="plans.config.summary.to_calculate">Por calcular</span>
          <a href="<?= getIndiceLoginUrlAttr() ?>" class="btn btn-brand btn-lg w-100 is-disabled" aria-disabled="true" data-pricing-cta data-i18n="plans.config.summary.cta">Crear cuenta y empezar 30 días gratis</a>
          <p class="pricing-summary-disclaimer" data-i18n="plans.config.summary.disclaimer">La estimación no es una factura. Confirmarás módulos y datos fiscales antes de contratar.</p>
        </aside>
      </div>
    </div>
  </section>

  <section class="pricing-included-section reveal" aria-labelledby="pricing-included-title">
    <div class="container">
      <div class="modules-section-heading text-center">
        <span class="eyebrow" data-i18n="plans.config.included.eyebrow">Incluido desde el primer día</span>
        <h2 id="pricing-included-title" class="section-title" data-i18n="plans.config.included.title">Empieza acompañado, no a ciegas</h2>
      </div>
      <div class="pricing-included-grid">
        <article>
          <span aria-hidden="true">30</span>
          <h3 data-i18n="plans.config.included.trial_title">30 días de acceso completo</h3>
          <p data-i18n="plans.config.included.trial_desc">Prueba todos los módulos básicos antes de decidir tu configuración.</p>
        </article>
        <article>
          <span aria-hidden="true">5</span>
          <h3 data-i18n="plans.config.included.employees_title">5 empleados incluidos</h3>
          <p data-i18n="plans.config.included.employees_desc">Agrega más cuando tu equipo crezca por $12 USD mensuales cada uno.</p>
        </article>
        <article>
          <span aria-hidden="true">1</span>
          <h3 data-i18n="plans.config.included.consulting_title">Primera consultoría sin costo</h3>
          <p data-i18n="plans.config.included.consulting_desc">Revisa tus evaluaciones con un consultor de Índice durante 50 minutos.</p>
        </article>
        <article>
          <span aria-hidden="true">50%</span>
          <h3 data-i18n="plans.config.included.loyalty_title">Precio de lanzamiento protegido</h3>
          <p data-i18n="plans.config.included.loyalty_desc">Conserva tu tarifa de lealtad mientras tu suscripción siga activa.</p>
        </article>
      </div>

      <aside class="pricing-growth-note" aria-labelledby="pricing-growth-note-title">
        <strong id="pricing-growth-note-title" data-i18n="plans.config.growth.title">Condiciones de crecimiento</strong>
        <span data-i18n="plans.config.growth.employee">Usuario adicional: $12 USD/mes con tarifa de lanzamiento; tarifa regular futura de $20 USD/mes.</span>
        <span data-i18n="plans.config.growth.modules">Módulo adicional: $29 USD/mes.</span>
        <span data-i18n="plans.config.growth.storage">5 GB incluidos. Si excedes el almacenamiento, los GB adicionales se agregan automáticamente a tu siguiente factura a $1 USD/GB.</span>
      </aside>
    </div>
  </section>
</main>

<script src="/js/planes.js"></script>
<?php include 'footer.php'; ?>
