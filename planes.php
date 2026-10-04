<?php
require_once __DIR__ . '/content/marketing.php';
$offer = json_decode(file_get_contents(__DIR__ . '/content/public-plans-mx.json'), true);
$promotionActive = (new DateTimeImmutable('now', new DateTimeZone('America/Mexico_City')))->format('Y-m') <= $offer['implementationPromotionThroughMonth'];
$tiers = $offer['plans'];
function planMoney(int $cents, bool $decimals = false): string {
    return '$' . number_format($cents / 100, $decimals ? 2 : 0, '.', ',');
}
$page_title = marketingString('price.title');
$page_description = marketingString('price.intro');
include 'header.php';
?>
<main id="main-content" class="mk-page mk-public-pricing">
  <section class="mk-section mk-page-hero">
    <div class="mk-container">
      <p class="mk-eyebrow"><?= marketingText('price.eyebrow') ?></p>
      <h1><?= marketingText('price.title') ?></h1>
      <p class="mk-lead"><?= marketingText('price.intro') ?></p>
      <p class="mk-fine-print"><?= marketingText('price.currency') ?></p>
    </div>
  </section>
  <section class="mk-section mk-soft" aria-labelledby="price-plans-heading">
    <div class="mk-container">
      <div class="mk-section-heading"><h2 id="price-plans-heading"><?= marketingText('price.choose') ?></h2><p><?= marketingText('price.choose.text') ?></p></div>
      <div class="mk-package-grid mk-price-cards">
        <?php foreach ($tiers as $tier): $slug = $tier['id']; ?>
        <article class="mk-package <?= $slug === 'escala' ? 'mk-package-featured' : '' ?>" id="<?= $slug ?>">
          <?php if ($slug === 'escala'): ?><span class="mk-price-popular"><?= marketingText('price.popular') ?></span><?php endif; ?>
          <h3><?= marketingText('price.plan.'.$slug) ?></h3>
          <p class="mk-package-description"><?= marketingText('price.plan.'.$slug.'.text') ?></p>
          <div class="mk-price"><strong><?= planMoney($tier['monthlyCents']) ?></strong><span>MXN</span></div>
          <p class="mk-price-period"><?= marketingText('price.month') ?></p>
          <p class="mk-price-annual"><?= marketingText('price.annual') ?>: <strong><?= planMoney($tier['annualCents'], true) ?> MXN</strong> <span><?= marketingText('price.annual.saving') ?></span></p>
          <a class="mk-button <?= $slug === 'escala' ? '' : 'mk-button-outline' ?>" href="/diagnostico.php?plan=<?= $slug ?>"><?= marketingText('price.cta') ?><span aria-hidden="true">↗</span></a>
          <p class="mk-price-card-note"><?= marketingText('price.plan.'.$slug.'.scope') ?></p>
        </article>
        <?php endforeach; ?>
      </div>
      <p class="mk-fine-print"><?= marketingText('price.no.checkout') ?></p>
    </div>
  </section>
  <section class="mk-section" aria-labelledby="price-compare-heading">
    <div class="mk-container">
      <div class="mk-section-heading"><h2 id="price-compare-heading"><?= marketingText('price.compare') ?></h2><p><?= marketingText('price.compare.text') ?></p></div>
      <div class="mk-price-table-wrap" tabindex="0" role="region" data-i18n-aria-label="brand26.price.compare" aria-label="<?= htmlspecialchars(marketingString('price.compare'), ENT_QUOTES, 'UTF-8') ?>">
        <table class="mk-price-table">
          <thead><tr><th scope="col"><?= marketingText('price.module') ?></th><?php foreach ($tiers as $tier): ?><th scope="col"><?= marketingText('price.plan.'.$tier['id']) ?></th><?php endforeach; ?></tr></thead>
          <tbody>
            <?php foreach ($offer['modules'] as $module): ?>
            <tr><th scope="row"><span class="mk-price-row-title"><?= marketingText('price.module.'.$module['id']) ?></span><span class="mk-price-row-detail"><?= marketingText('price.module.'.$module['id'].'.detail') ?></span></th>
              <?php foreach ($tiers as $tier): $slug = $tier['id'];
                $included = in_array($slug, $module['includedIn'], true);
                $choice = in_array($slug, $module['choiceIn'] ?? [], true);
              ?><td><?= $included ? '<span class="mk-price-check" data-i18n-aria-label="brand26.price.included" aria-label="' . htmlspecialchars(marketingString('price.included'), ENT_QUOTES, 'UTF-8') . '">✓</span>' : ($choice ? marketingText('price.choice') : '<span class="mk-price-dash" data-i18n-aria-label="brand26.price.not.included" aria-label="' . htmlspecialchars(marketingString('price.not.included'), ENT_QUOTES, 'UTF-8') . '">—</span>') ?></td><?php endforeach; ?>
            </tr>
            <?php endforeach; ?>
          </tbody>
          <tbody>
            <tr class="mk-price-table-group"><th colspan="4" scope="rowgroup"><?= marketingText('price.agents.heading') ?></th></tr>
            <?php foreach ($offer['agents'] as $agent): ?>
            <tr><th scope="row"><span class="mk-price-row-title"><?= marketingText('price.agent.'.$agent['id']) ?></span><span class="mk-price-row-detail"><?= marketingText('price.agent.'.$agent['id'].'.detail') ?></span></th>
              <?php foreach ($tiers as $tier): $included = in_array($tier['id'], $agent['includedIn'], true); ?>
              <td><?= $included ? '<span class="mk-price-check" data-i18n-aria-label="brand26.price.included" aria-label="' . htmlspecialchars(marketingString('price.included'), ENT_QUOTES, 'UTF-8') . '">✓</span>' : '<span class="mk-price-dash" data-i18n-aria-label="brand26.price.not.included" aria-label="' . htmlspecialchars(marketingString('price.not.included'), ENT_QUOTES, 'UTF-8') . '">—</span>' ?></td>
              <?php endforeach; ?>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <p class="mk-fine-print"><?= marketingText('price.choice.note') ?></p>
      <p class="mk-fine-print"><?= marketingText('price.agents.note') ?></p>
      <div class="mk-price-shared"><h3><?= marketingText('price.all.title') ?></h3><ul><li><?= marketingText('price.all.people') ?></li><li><?= marketingText('price.all.agents') ?></li><li><?= marketingText('price.all.consulting') ?></li><li><?= marketingText('price.all.learning') ?></li><li><?= marketingText('price.all.extra') ?>: <strong><?= planMoney($offer['additionalPeopleBlockMonthlyCents']) ?> MXN</strong> <?= marketingText('price.month') ?></li></ul></div>
    </div>
  </section>
  <section class="mk-section mk-soft" aria-labelledby="price-implementation-heading">
    <div class="mk-container">
      <div class="mk-section-heading"><h2 id="price-implementation-heading"><?= marketingText('price.implementation') ?></h2><p><?= marketingText('price.implementation.text') ?></p></div>
      <div class="mk-price-setup-grid">
        <?php foreach ($tiers as $tier): $slug = $tier['id']; ?>
        <article><h3><?= marketingText('price.plan.'.$slug) ?></h3><strong><?= planMoney($promotionActive ? $tier['implementationPromotionCents'] : $tier['implementationRegularCents'], $promotionActive && $slug !== 'controla') ?> MXN</strong><?php if ($promotionActive): ?><p><?= marketingText('price.promotion') ?> <s><?= planMoney($tier['implementationRegularCents']) ?> MXN</s></p><?php endif; ?></article>
        <?php endforeach; ?>
      </div>
      <p class="mk-fine-print"><?= $promotionActive ? marketingText('price.promotion.until') : marketingText('price.implementation.note') ?></p>
      <p class="mk-price-implementation-includes"><?= marketingText('price.implementation.includes') ?></p>
      <a class="mk-button" href="/diagnostico.php"><?= marketingText('cta') ?><span aria-hidden="true">↗</span></a>
    </div>
  </section>
  <?php marketingClosing(); ?>
</main>
<?php include 'footer.php'; ?>
