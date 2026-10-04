<?php
require_once __DIR__ . '/content/marketing.php';
startSecureSession();
$page_title = marketingString('contact.title');
$page_description = marketingString('contact.text');
$selectedPlan = strtoupper(trim((string)($_GET['plan'] ?? '')));
if (!in_array($selectedPlan, ['CONTROLA', 'ESCALA', 'CORPORATIVO'], true)) $selectedPlan = '';
include 'header.php';
?>
<main id="main-content" class="mk-page mk-diagnosis-page">
  <section class="mk-section mk-page-hero">
    <div class="mk-container">
      <p class="mk-eyebrow"><?= marketingText('contact.eyebrow') ?></p>
      <h1><?= marketingText('contact.title') ?></h1>
      <p class="mk-lead"><?= marketingText('contact.text') ?></p>
    </div>
  </section>
  <section class="mk-section">
    <div class="mk-container mk-contact-grid">
      <div class="mk-contact-form">
        <h2><?= marketingText('contact.form') ?></h2>
        <p><?= marketingText('contact.form.intro') ?></p>
        <form id="contactForm" class="row g-3"><?php echo honeypotInput(); ?>
          <div class="col-md-6"><label class="form-label" for="fullName"><?= marketingText('contact.name') ?></label><input class="form-control" id="fullName" name="fullName" type="text" autocomplete="name" maxlength="120" required></div>
          <div class="col-md-6"><label class="form-label" for="companyName"><?= marketingText('contact.company') ?></label><input class="form-control" id="companyName" name="companyName" type="text" autocomplete="organization" maxlength="160" required></div>
          <div class="col-md-6"><label class="form-label" for="email"><?= marketingText('contact.email') ?></label><input class="form-control" id="email" name="email" type="email" autocomplete="email" maxlength="180" required></div>
          <div class="col-md-6"><label class="form-label" for="phone"><?= marketingText('contact.phone') ?></label><input class="form-control" id="phone" name="phone" type="tel" autocomplete="tel" maxlength="40"></div>
          <div class="col-12"><label class="form-label" for="country"><?= marketingText('contact.country') ?></label><input class="form-control" id="country" name="country" type="text" autocomplete="country-name" maxlength="80"></div>
          <div class="col-12"><label class="form-label" for="planInterest"><?= marketingText('contact.plan') ?></label><select class="form-select" id="planInterest" name="planInterest"><option value="" data-i18n="brand26.contact.plan.none"><?= htmlspecialchars(marketingString('contact.plan.none'), ENT_QUOTES, 'UTF-8') ?></option><?php foreach (['CONTROLA' => 'controla', 'ESCALA' => 'escala', 'CORPORATIVO' => 'corporativo'] as $value => $key): ?><option value="<?= $value ?>" data-i18n="brand26.contact.plan.<?= $key ?>" <?= $selectedPlan === $value ? 'selected' : '' ?>><?= htmlspecialchars(marketingString('contact.plan.'.$key), ENT_QUOTES, 'UTF-8') ?></option><?php endforeach; ?></select></div>
          <div class="col-12"><label class="form-label" for="challenge"><?= marketingText('contact.challenge') ?></label><textarea class="form-control" id="challenge" name="challenge" rows="4" maxlength="3000" required></textarea></div>
          <div class="col-12"><label class="mk-consent"><input type="checkbox" id="contactConsent" name="contactConsent" required><span><?= marketingText('contact.consent') ?> <a href="/privacidad.php" target="_blank" rel="noopener noreferrer"><?= marketingText('contact.privacy') ?></a>.</span></label></div>
          <div class="col-12"><button class="mk-button" type="submit"><?= marketingText('contact.send') ?><span aria-hidden="true">↗</span></button></div>
          <div class="col-12"><div id="contactStatus" role="status" aria-live="polite"></div></div>
          <div hidden><?php foreach (['sending','success','error'] as $key): ?><span data-form-copy="<?= $key ?>"><?= marketingText('contact.'.$key) ?></span><?php endforeach; ?></div>
        </form>
      </div>
      <aside class="mk-contact-aside">
        <span class="mk-spark" aria-hidden="true">✦</span>
        <h2><?= marketingText('contact.next') ?></h2>
        <p><?= marketingText('contact.next.text') ?></p>
        <ol class="mk-diagnosis-steps">
          <?php foreach (['received','call','diagnosis','trial'] as $step): ?><li><?= marketingText('contact.step.'.$step) ?></li><?php endforeach; ?>
        </ol>
        <p class="mk-fine-print"><?= marketingText('contact.trial.note') ?></p>
      </aside>
    </div>
  </section>
</main>
<?php include 'footer.php'; ?>
