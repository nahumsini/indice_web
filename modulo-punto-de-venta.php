<?php
require_once __DIR__ . '/content/marketing.php';
require_once __DIR__ . '/content/module-basic-pages.php';

$page_title = marketingString('posShowcase.meta.title');
$page_description = marketingString('posShowcase.meta.description');
$posBenefits = ['registers' => 'fa-cash-register', 'online' => 'fa-globe', 'control' => 'fa-chart-line'];
$posRetailModes = ['counter' => 'fa-store', 'checkout' => 'fa-cart-shopping', 'preticket' => 'fa-receipt'];
$posRestaurantTools = ['kitchen' => 'fa-utensils', 'station' => 'fa-display', 'service' => 'fa-users', 'mobile' => 'fa-mobile-screen-button'];
include 'header.php';
?>
<main id="main-content" class="mk-page mk-hr-showcase mk-pos-showcase">
    <section class="mk-section mk-page-hero">
        <div class="mk-container">
            <a class="mk-text-link" href="/modulos.php">← <?= marketingText('panel.back') ?></a>
            <div class="mk-pos-intro">
                <div>
                    <p class="mk-eyebrow"><span aria-hidden="true">🛒</span><span data-i18n="modules.core.pos.title"><?= basicModuleAttr('modules.core.pos.title') ?></span></p>
                    <h1><?= marketingText('posShowcase.title') ?></h1>
                    <p class="mk-lead"><?= marketingText('posShowcase.intro') ?></p>
                    <div class="mk-actions">
                        <a class="mk-button" href="/contacto.php"><?= marketingText('posShowcase.cta') ?> <span aria-hidden="true">↗</span></a>
                        <a class="mk-text-link" href="#pos-retail"><?= marketingText('posShowcase.explore') ?> <span aria-hidden="true">↓</span></a>
                    </div>
                </div>
            </div>
            <nav class="mk-hr-jump" aria-label="<?= htmlspecialchars(marketingString('posShowcase.nav'), ENT_QUOTES, 'UTF-8') ?>" data-i18n-aria-label="brand26.posShowcase.nav">
                <?php foreach (['registers', 'retail', 'restaurant'] as $section): ?>
                    <a href="#pos-<?= $section ?>"><?= marketingText('posShowcase.nav.' . $section) ?> <span aria-hidden="true">↓</span></a>
                <?php endforeach; ?>
            </nav>
        </div>
    </section>

    <section id="pos-registers" class="mk-section" aria-labelledby="pos-registers-title">
        <div class="mk-container">
            <div class="mk-hr-view">
            <div class="mk-section-heading">
                <p class="mk-eyebrow"><?= marketingText('posShowcase.registers.eyebrow') ?></p>
                <h2 id="pos-registers-title"><?= marketingText('posShowcase.registers.title') ?></h2>
                <p class="mk-lead"><?= marketingText('posShowcase.registers.intro') ?></p>
            </div>
            <figure><a class="mk-hr-shot" href="/imgs/pos-registers-demo-v1.png" target="_blank" rel="noopener"><img src="/imgs/pos-registers-demo-v1.png" alt="<?= htmlspecialchars(marketingString('posShowcase.registers.title'), ENT_QUOTES, 'UTF-8') ?>" width="1444" height="1089" loading="lazy"></a><figcaption><a class="mk-text-link" href="/imgs/pos-registers-demo-v1.png" target="_blank" rel="noopener"><?= marketingText('hrShowcase.zoom') ?> ↗</a><p><?= marketingText('hrShowcase.note') ?></p></figcaption></figure>
            </div>
            <details class="mk-pos-details"><summary><?= marketingText('posShowcase.details') ?></summary>
            <div class="mk-pos-grid">
                <?php foreach ($posBenefits as $benefit => $icon): ?>
                    <article class="mk-info-card">
                        <i class="fa-solid <?= $icon ?> mk-pos-icon" aria-hidden="true"></i>
                        <h3><?= marketingText('posShowcase.benefit.' . $benefit . '.title') ?></h3>
                        <p><?= marketingText('posShowcase.benefit.' . $benefit . '.text') ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
            </details>
        </div>
    </section>

    <section id="pos-retail" class="mk-section mk-soft" aria-labelledby="pos-retail-title">
        <div class="mk-container">
            <div class="mk-hr-view">
            <div class="mk-section-heading">
                <p class="mk-eyebrow"><?= marketingText('posShowcase.retail.eyebrow') ?></p>
                <h2 id="pos-retail-title"><?= marketingText('posShowcase.retail.title') ?></h2>
                <p class="mk-lead"><?= marketingText('posShowcase.retail.intro') ?></p>
            </div>
            <figure><a class="mk-hr-shot" href="/imgs/pos-retail-demo-v1.png" target="_blank" rel="noopener"><img src="/imgs/pos-retail-demo-v1.png" alt="<?= htmlspecialchars(marketingString('posShowcase.retail.title'), ENT_QUOTES, 'UTF-8') ?>" width="1672" height="941" loading="lazy"></a><figcaption><a class="mk-text-link" href="/imgs/pos-retail-demo-v1.png" target="_blank" rel="noopener"><?= marketingText('hrShowcase.zoom') ?> ↗</a><p><?= marketingText('hrShowcase.note') ?></p></figcaption></figure>
            </div>
            <details class="mk-pos-details"><summary><?= marketingText('posShowcase.details') ?></summary>
            <div class="mk-pos-grid">
                <?php foreach ($posRetailModes as $mode => $icon): ?>
                    <article class="mk-info-card">
                        <i class="fa-solid <?= $icon ?> mk-pos-icon" aria-hidden="true"></i>
                        <h3><?= marketingText('posShowcase.retail.' . $mode . '.title') ?></h3>
                        <p><?= marketingText('posShowcase.retail.' . $mode . '.text') ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
            </details>
        </div>
    </section>

    <section id="pos-restaurant" class="mk-section" aria-labelledby="pos-restaurant-title">
        <div class="mk-container">
            <div class="mk-hr-view mk-hr-kiosk">
            <div class="mk-section-heading">
                <p class="mk-eyebrow"><?= marketingText('posShowcase.restaurant.eyebrow') ?></p>
                <h2 id="pos-restaurant-title"><?= marketingText('posShowcase.restaurant.title') ?></h2>
                <p class="mk-lead"><?= marketingText('posShowcase.restaurant.intro') ?></p>
            </div>
            <figure><a class="mk-hr-shot" href="/imgs/pos-restaurant-demo-v1.png" target="_blank" rel="noopener"><img src="/imgs/pos-restaurant-demo-v1.png" alt="<?= htmlspecialchars(marketingString('posShowcase.restaurant.title'), ENT_QUOTES, 'UTF-8') ?>" width="887" height="1773" loading="lazy"></a><figcaption><a class="mk-text-link" href="/imgs/pos-restaurant-demo-v1.png" target="_blank" rel="noopener"><?= marketingText('hrShowcase.zoom') ?> ↗</a><p><?= marketingText('hrShowcase.note') ?></p></figcaption></figure>
            </div>
            <details class="mk-pos-details"><summary><?= marketingText('posShowcase.details') ?></summary>
            <div class="mk-pos-grid mk-pos-grid-two">
                <?php foreach ($posRestaurantTools as $tool => $icon): ?>
                    <article class="mk-info-card">
                        <i class="fa-solid <?= $icon ?> mk-pos-icon" aria-hidden="true"></i>
                        <h3><?= marketingText('posShowcase.restaurant.' . $tool . '.title') ?></h3>
                        <p><?= marketingText('posShowcase.restaurant.' . $tool . '.text') ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
            </details>
        </div>
    </section>

    <section class="mk-closing" aria-labelledby="pos-closing-title">
        <div class="mk-container">
            <h2 id="pos-closing-title"><?= marketingText('posShowcase.closing.title') ?></h2>
            <p><?= marketingText('posShowcase.closing.text') ?></p>
            <a class="mk-button mk-button-light" href="/contacto.php"><?= marketingText('posShowcase.cta') ?> <span aria-hidden="true">↗</span></a>
        </div>
    </section>
</main>
<?php include 'footer.php'; ?>
