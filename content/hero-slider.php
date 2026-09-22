<?php /* Scripted examples, paired with module photographs; no live agent calls. */
?>
<div class="module-demo" data-module-demo>
  <section class="module-chat" aria-label="<?= htmlspecialchars(marketingString('slider.label'), ENT_QUOTES, 'UTF-8') ?>" data-i18n-aria-label="brand26.slider.label">
    <div class="module-chat-title">Lupita <span aria-hidden="true">⌄</span></div>
    <div class="module-chat-area" data-module-stage tabindex="0" role="region" aria-label="<?= htmlspecialchars(marketingString('slider.label'),ENT_QUOTES,'UTF-8') ?>" data-i18n-aria-label="brand26.slider.label">
      <?php foreach ($heroModules as $index => $module): ?>
      <article class="module-exchange" data-module-exchange="<?= $module ?>" <?= $index ? 'hidden' : '' ?>>
        <h2 class="visually-hidden"><?= marketingText('moduleHero.'.$module.'.label') ?></h2>
        <p class="module-question"><?= marketingText('moduleHero.'.$module.'.question') ?></p>
        <div class="module-answer"><span aria-hidden="true">✦</span><p><?= marketingText('moduleHero.'.$module.'.answer') ?></p></div>
      </article>
      <?php endforeach; ?>
    </div>
    <div class="module-composer" aria-hidden="true"><span>+</span><span><?= marketingText('story.composer') ?></span><span class="module-send">↑</span></div>
  </section>
  <div class="module-caption">
    <div class="module-labels"><?php foreach ($heroModules as $index => $module): ?><span data-module-label="<?= $module ?>" <?= $index ? 'hidden' : '' ?>><small><?= str_pad((string)($index+1),2,'0',STR_PAD_LEFT) ?> / 09</small> <?= marketingText('moduleHero.'.$module.'.label') ?></span><?php endforeach; ?></div>
    <div class="module-navigation" data-module-controls hidden>
      <button type="button" data-module-previous aria-label="<?= htmlspecialchars(marketingString('moduleHero.previous'),ENT_QUOTES,'UTF-8') ?>" data-i18n-aria-label="brand26.moduleHero.previous">←</button>
      <button type="button" data-module-toggle><span data-module-pause><?= marketingText('slider.pause') ?></span><span data-module-play hidden><?= marketingText('slider.play') ?></span></button>
      <button type="button" data-module-next aria-label="<?= htmlspecialchars(marketingString('moduleHero.next'),ENT_QUOTES,'UTF-8') ?>" data-i18n-aria-label="brand26.moduleHero.next">→</button>
    </div>
  </div>

  <p class="module-demo-note"><?= marketingText('slider.note') ?></p>
  <span class="visually-hidden" role="status" aria-live="polite" data-module-status></span>
</div>
