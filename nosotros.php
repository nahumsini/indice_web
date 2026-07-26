<?php
require_once __DIR__ . '/functions.php';

$siteCtx = resolveSiteContext();
$currentLocale = $siteCtx['locale'] ?? 'es-MX';
$isCanadaLocale = in_array($currentLocale, ['en-CA', 'fr-CA', 'zh-CA', 'ko-CA'], true);

$pageTitles = [
  'es-MX' => 'Hablemos',
  'es-CO' => 'Hablemos',
  'en-CA' => 'Book a demo',
  'fr-CA' => 'Planifier une démo',
  'pt-BR' => 'Fale com a gente',
  'zh-CA' => '预约演示',
  'ko-CA' => '데모 상담',
];

$pageDescriptions = [
  'es-MX' => 'Agenda una demo, comparte tus dudas o inicia una conversación comercial con Índice.',
  'es-CO' => 'Agenda una demo, comparte tus dudas o inicia una conversación comercial con Índice.',
  'en-CA' => 'Book a demo, ask questions, or start a sales conversation with Indice.',
  'fr-CA' => 'Planifiez une démo, posez vos questions ou démarrez une conversation avec l’équipe Índice.',
  'pt-BR' => 'Agende uma demo, tire dúvidas ou fale com o time comercial do Índice.',
  'zh-CA' => '预约演示、提交问题，或直接与 Índice 销售团队联系。',
  'ko-CA' => '데모를 예약하고, 질문을 남기고, 영업팀과 바로 상담하세요.',
];

$page_title = $pageTitles[$currentLocale] ?? 'Hablemos';
$page_description = $pageDescriptions[$currentLocale] ?? $pageDescriptions['es-MX'];

$demoHref = '#lead-form';
$emailSubject = $isCanadaLocale ? 'Indice inquiry' : 'Consulta sobre Índice';
$salesSubject = $isCanadaLocale ? 'Indice sales conversation' : 'Conversación comercial con Índice';
$emailHref = 'mailto:contacto@indiceapp.com?subject=' . rawurlencode($emailSubject);
$salesHref = 'mailto:contacto@indiceapp.com?subject=' . rawurlencode($salesSubject);
$mapHref = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode('130 King St W, Toronto, ON, Canada');

include 'header.php';
?>

<section class="page-hero bg-surface reveal" aria-label="Contacto Índice" data-i18n-aria-label="connect.aria.hero">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-8 mx-auto text-center">
        <h1 class="display-5 fw-bold mb-3 text-balance" data-i18n="connect.hero.title">¿Quieres entender cómo aplicar Índice en tu negocio?</h1>
        <p class="lead lead-soft mb-4" data-i18n="connect.hero.subtitle">Te mostramos cómo organizar tu operación paso a paso, sin complicaciones.</p>
        <div class="d-flex flex-column flex-sm-row gap-2 justify-content-center hero-actions">
          <a href="<?php echo htmlspecialchars($demoHref, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-brand btn-lg" data-i18n="connect.hero.cta.primary">Agendar demo</a>
          <a href="<?php echo htmlspecialchars($emailHref, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-ghost btn-lg" data-i18n="connect.hero.cta.secondary">Escribir por correo</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5 bg-card reveal" aria-label="Opciones de contacto" data-i18n-aria-label="connect.aria.options">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-4">
        <div class="card-min p-4 h-100">
          <div class="mb-3" style="font-size: 1.75rem;">→</div>
          <h2 class="h4 fw-bold mb-2" data-i18n="connect.options.demo.title">Ver cómo funciona</h2>
          <p class="lead-soft mb-4" data-i18n="connect.options.demo.text">Agenda una demo y te mostramos cómo organizar tu negocio con Índice.</p>
          <a href="<?php echo htmlspecialchars($demoHref, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-brand" data-i18n="connect.options.demo.cta">Agendar demo</a>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card-min p-4 h-100">
          <div class="mb-3" style="font-size: 1.75rem;">?</div>
          <h2 class="h4 fw-bold mb-2" data-i18n="connect.options.support.title">Tengo dudas</h2>
          <p class="lead-soft mb-4" data-i18n="connect.options.support.text">Si tienes preguntas, te respondemos por correo con claridad.</p>
          <a href="<?php echo htmlspecialchars($emailHref, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-ghost" data-i18n="connect.options.support.cta">Escribir por correo</a>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card-min p-4 h-100">
          <div class="mb-3" style="font-size: 1.75rem;">+</div>
          <h2 class="h4 fw-bold mb-2" data-i18n="connect.options.sales.title">Necesito algo más avanzado</h2>
          <p class="lead-soft mb-4" data-i18n="connect.options.sales.text">Si tu operación requiere algo más estructurado o personalizado, podemos ayudarte.</p>
          <a href="<?php echo htmlspecialchars($salesHref, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-ghost" data-i18n="connect.options.sales.cta">Contactar por correo</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5 bg-surface reveal" id="lead-form" aria-label="Formulario de contacto" data-i18n-aria-label="connect.aria.form">
  <div class="container">
    <div class="row g-4 align-items-start">
      <div class="col-lg-7">
        <div class="card-min p-4 p-lg-5 h-100">
          <h2 class="display-6 fw-bold mb-2 text-balance" data-i18n="connect.form.title">Déjanos tus datos y te contactamos</h2>
          <p class="lead-soft mb-4" data-i18n="connect.form.subtitle">Respuesta rápida. Sin formularios largos.</p>

          <form data-registration-form class="row g-3">
            <?php echo csrfInput(); ?>
            <?php echo honeypotInput(); ?>
            <input type="hidden" name="pais" value="<?php echo htmlspecialchars((string)($siteCtx['country'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>">

            <div class="col-12">
              <label for="leadNombre" class="form-label" data-i18n="connect.form.name.label">Nombre</label>
              <input type="text" id="leadNombre" name="nombre" class="form-control" data-i18n-placeholder="connect.form.name.placeholder" placeholder="Tu nombre" required>
            </div>

            <div class="col-12">
              <label for="leadEmpresa" class="form-label" data-i18n="connect.form.company.label">Empresa</label>
              <input type="text" id="leadEmpresa" name="empresa" class="form-control" data-i18n-placeholder="connect.form.company.placeholder" placeholder="Tu empresa">
            </div>

            <div class="col-12">
              <label for="leadEmail" class="form-label" data-i18n="connect.form.contact.label">Correo electrónico</label>
              <input type="email" id="leadEmail" name="email" class="form-control" data-i18n-placeholder="connect.form.contact.placeholder" placeholder="correo@empresa.com" required>
            </div>

            <div class="col-12 d-none" aria-hidden="true">
              <span data-form-copy="sending" data-i18n="connect.form.status.sending">Enviando...</span>
              <span data-form-copy="invalid" data-i18n="connect.form.status.invalid">Ingresa un correo electrónico válido para continuar.</span>
              <span data-form-copy="success" data-i18n="connect.form.status.success">Listo. Recibimos tus datos y te contactaremos pronto.</span>
              <span data-form-copy="error" data-i18n="connect.form.status.error">No fue posible enviar el formulario.</span>
            </div>

            <div class="col-12 d-flex flex-column flex-sm-row gap-3 align-items-sm-center">
              <button type="submit" class="btn btn-brand btn-lg" data-i18n="connect.form.submit">Enviar</button>
              <p class="small text-muted mb-0" data-i18n="connect.form.microcopy">Tres campos. Sin vueltas.</p>
            </div>

            <div class="col-12">
              <p class="small mb-0" data-registration-status></p>
            </div>
          </form>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="card-min p-4 p-lg-5 h-100 company-info">
          <h2 class="h4 fw-bold mb-2" data-i18n="connect.quick.title">Contacto por correo</h2>
          <p class="lead-soft mb-4" data-i18n="connect.quick.text">Escríbenos y te respondemos lo antes posible.</p>

          <div class="d-grid gap-3 mb-4">
            <a href="<?php echo htmlspecialchars($emailHref, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-brand btn-lg" data-i18n="connect.quick.primary">✉️ Escribir por correo</a>
          </div>

          <p class="small text-muted mb-3" data-i18n="connect.quick.note">Respondemos en menos de 24 horas hábiles.</p>

          <div class="border-top pt-3">
            <p class="mb-1 text-uppercase text-muted" style="letter-spacing:1px; font-size:0.75rem;" data-i18n="connect.quick.email_label">Email</p>
            <p class="mb-0"><a href="mailto:contacto@indiceapp.com">contacto@indiceapp.com</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-4 bg-card reveal" aria-label="Información corporativa" data-i18n-aria-label="connect.aria.company">
  <div class="container">
    <div class="card-min p-4 company-info">
      <div class="row g-3 align-items-start">
        <div class="col-lg-5">
          <h2 class="h5 fw-bold mb-2" data-i18n="connect.company.title">Información corporativa</h2>
          <p class="lead-soft mb-0" data-i18n="connect.company.text">Índice Technologies Inc. es una empresa registrada en Canadá.</p>
        </div>
        <div class="col-lg-4">
          <p class="small text-uppercase text-muted mb-1" style="letter-spacing:1px;" data-i18n="connect.company.address_label">Dirección</p>
          <p class="mb-0" data-i18n="connect.company.address">130 King St W, Toronto, ON, Canada — Exchange Tower</p>
        </div>
        <div class="col-lg-3">
          <p class="small text-uppercase text-muted mb-1" style="letter-spacing:1px;" data-i18n="connect.company.email_label">Email</p>
          <p class="mb-2"><a href="mailto:contacto@indiceapp.com">contacto@indiceapp.com</a></p>
          <a href="<?php echo htmlspecialchars($mapHref, ENT_QUOTES, 'UTF-8'); ?>" class="small fw-semibold" target="_blank" rel="noopener" data-i18n="connect.company.map">Ver ubicación</a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>
