<?php
require_once dirname(__DIR__) . '/functions.php';

function marketingString(string $key): string {
    static $copy = null;
    if ($copy === null) {
        $locale = resolveSiteContext()['locale'];
        $fallback = json_decode(file_get_contents(__DIR__ . '/../i18n/es-MX.json'), true) ?: [];
        $path = __DIR__ . '/../i18n/' . basename($locale) . '.json';
        $copy = array_merge($fallback, is_file($path) ? (json_decode(file_get_contents($path), true) ?: []) : []);
    }
    return (string)($copy['brand26.' . $key] ?? $key);
}

function marketingText(string $key): string {
    return '<span data-i18n="brand26.' . htmlspecialchars($key, ENT_QUOTES, 'UTF-8') . '">' .
        htmlspecialchars(marketingString($key), ENT_QUOTES, 'UTF-8') . '</span>';
}

function marketingClosing(): void { ?>
<section class="mk-closing"><div class="mk-container"><span class="mk-spark" aria-hidden="true">✦</span><h2><?= marketingText('closing.title') ?></h2><p><?= marketingText('closing.text') ?></p><a class="mk-button mk-button-light" href="/contacto.php"><?= marketingText('cta') ?><span aria-hidden="true">↗</span></a></div></section>
<?php }

function marketingSteps(): void { ?>
<div class="mk-steps"><?php foreach (['one','two','three','four'] as $index => $step): ?><article><span class="mk-step-number" aria-hidden="true">0<?= $index + 1 ?></span><h3><?= marketingText('step.' . $step) ?></h3><p><?= marketingText('step.' . $step . '.text') ?></p></article><?php endforeach; ?></div>
<?php }
