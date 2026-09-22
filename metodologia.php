<?php
require_once __DIR__ . '/content/marketing.php';
$page_title = marketingString('method.eyebrow');
$page_description = marketingString('method.intro');
include 'header.php';
?>
<main id="main-content" class="mk-page mk-method">
  <section class="mk-section mk-page-hero">
    <div class="mk-container">
      <p class="mk-eyebrow"><?= marketingText('method.eyebrow') ?></p>
      <h1><?= marketingText('method.title') ?></h1>
      <p class="mk-lead"><?= marketingText('method.intro') ?></p>
      <div class="mk-actions"><a class="mk-button" href="/contacto.php"><?= marketingText('cta') ?><span aria-hidden="true">↗</span></a></div>
      <div class="mk-ai-platforms">
        <p><?= marketingText('method.platforms') ?></p>
        <div class="mk-ai-names"><span><img src="/imgs/integrations/chatgpt.png" width="24" height="24" alt="">ChatGPT</span><span><img src="/imgs/integrations/claude.png" width="24" height="24" alt="">Claude</span></div>
        <p class="mk-platform-note"><?= marketingText('method.compatibility') ?></p>
      </div>
    </div>
  </section>
  <section class="mk-section">
    <div class="mk-container">
      <h2><?= marketingText('method.roles.title') ?></h2>
      <p class="mk-lead"><?= marketingText('method.roles.intro') ?></p>
      <figure class="mk-access-map">
        <div class="mk-access-lanes">
          <?php foreach (['operators', 'admins', 'leaders'] as $index => $role): ?>
          <article class="mk-access-lane">
            <div class="mk-access-visual" aria-hidden="true">
              <svg viewBox="0 0 240 132" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="43" cy="44" r="15" fill="#b8d1fa"/>
                <path d="M17 112V87c0-18 12-27 26-27s26 9 26 27v25" fill="#2563eb"/>
                <?php if ($role === 'operators'): ?>
                <rect x="111" y="14" width="88" height="90" rx="10" fill="white" stroke="#406da9" stroke-width="3"/>
                <rect x="121" y="26" width="68" height="64" rx="5" fill="#e9f1ff"/>
                <circle cx="155" cy="48" r="10" fill="#b8d1fa"/><path d="m143 71 8 8 17-19" stroke="#16816e" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M155 104v17m-23 0h46M58 83l40-27 22 3" stroke="#406da9" stroke-width="7" stroke-linecap="round"/>
                <?php elseif ($role === 'admins'): ?>
                <rect x="96" y="29" width="109" height="71" rx="6" fill="white" stroke="#406da9" stroke-width="3"/>
                <path d="M87 105h123" stroke="#406da9" stroke-width="6" stroke-linecap="round"/>
                <rect x="106" y="39" width="22" height="48" rx="3" fill="#dce9ff"/>
                <path d="M139 47h52m-52 13h40m-40 14h46" stroke="#80a7e4" stroke-width="5" stroke-linecap="round"/>
                <rect x="188" y="64" width="29" height="54" rx="6" fill="#18365c"/><rect x="192" y="71" width="21" height="36" rx="2" fill="#e9f1ff"/>
                <?php else: ?>
                <rect x="94" y="18" width="125" height="94" rx="12" fill="white" stroke="#406da9" stroke-width="3"/>
                <rect x="148" y="31" width="58" height="20" rx="8" fill="#dce9ff"/>
                <path d="m107 61 3 7 7 3-7 3-3 7-3-7-7-3 7-3Z" fill="#2563eb"/>
                <path d="M126 67h70m-70 11h58" stroke="#80a7e4" stroke-width="5" stroke-linecap="round"/>
                <rect x="106" y="92" width="101" height="10" rx="5" fill="#e9f1ff"/>
                <?php endif; ?>
              </svg>
            </div>
            <h3><?= marketingText('method.' . $role . '.title') ?></h3>
            <div class="mk-access-channel">
              <?php if ($role === 'leaders'): ?>
                <span><img src="/imgs/integrations/chatgpt.png" width="20" height="20" alt="">ChatGPT</span><span><img src="/imgs/integrations/claude.png" width="20" height="20" alt="">Claude</span>
              <?php else: ?>
                <?= marketingText('method.diagram.' . ($role === 'operators' ? 'kiosk' : 'web')) ?>
              <?php endif; ?>
            </div>
            <p><?= marketingText('method.' . $role . '.text') ?></p>
          </article>
          <?php endforeach; ?>
        </div>
        <div class="mk-access-hub"><strong>Índice</strong><span><?= marketingText('method.diagram.hub') ?></span></div>
        <figcaption><?= marketingText('method.diagram.caption') ?></figcaption>
      </figure>
    </div>
  </section>
  <section class="mk-section mk-method-kiosk">
    <div class="mk-container mk-split">
      <div><h2><?= marketingText('method.kiosk.title') ?></h2><p class="mk-lead"><?= marketingText('method.kiosk.text') ?></p><p><?= marketingText('method.kiosk.access') ?></p></div>
      <div class="mk-tool-panel"><span class="mk-tool-count" aria-hidden="true">120+</span><h3><?= marketingText('method.tools.title') ?></h3><p><?= marketingText('method.tools.text') ?></p><a class="mk-button mk-button-light" href="/modulos.php"><?= marketingText('method.modules') ?><span aria-hidden="true">↗</span></a></div>
    </div>
  </section>
  <section class="mk-section">
    <div class="mk-container">
      <h2><?= marketingText('method.consult.title') ?></h2>
      <p class="mk-lead"><?= marketingText('method.consult.text') ?></p>
      <?php marketingSteps(); ?>
      <aside class="mk-custom-scope"><h3><?= marketingText('method.custom.title') ?></h3><p><?= marketingText('method.custom.text') ?></p></aside>
    </div>
  </section>
  <section class="mk-section mk-soft"><div class="mk-container mk-split"><div><h2><?= marketingText('lupita.title') ?></h2><p class="mk-lead"><?= marketingText('lupita.text') ?></p><a class="mk-text-link" href="/index.php#lupita"><?= marketingText('nav.agents') ?> →</a></div><div class="mk-info-card"><h3><?= marketingText('learn.title') ?></h3><p><?= marketingText('learn.text') ?></p><a class="mk-text-link" href="/modo-aprendiz.php"><?= marketingText('learn.link') ?> →</a></div></div></section>
  <?php marketingClosing(); ?>
</main>
<?php include 'footer.php'; ?>
