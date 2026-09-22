/* Progressive enhancement: the first illustrative scene remains visible without JavaScript. */
(function () {
  'use strict';
  function mountSlider(root, environment) {
    const env = environment || window;
    const doc = root.ownerDocument;
    const panels = Array.from(root.querySelectorAll('[data-scene]'));
    const tabs = Array.from(root.querySelectorAll('[data-slide-to]'));
    const controls = root.querySelector('[data-slider-controls]');
    const toggle = root.querySelector('[data-slider-toggle]');
    const reduced = env.matchMedia('(prefers-reduced-motion: reduce)');
    const desktop = env.matchMedia('(min-width: 768px)');
    const period = 32000;
    let active = 0;
    let paused = reduced.matches || !desktop.matches;
    let hovered = false;
    let visible = true;
    let timer = null;
    let pointer = null;

    function syncPlayback() {
      if (timer !== null) env.clearTimeout(timer);
      timer = null;
      const playing = !paused && !hovered && visible && !doc.hidden && !reduced.matches;
      root.dataset.playing = String(playing);
      toggle.hidden = reduced.matches;
      toggle.querySelector('[data-pause-label]').hidden = paused;
      toggle.querySelector('[data-play-label]').hidden = !paused;
      if (playing) timer = env.setTimeout(function () { show(active + 1, false); }, period);
    }

    function show(index, manual) {
      active = (index + panels.length) % panels.length;
      if (manual) paused = true;
      panels.forEach(function (panel, i) { panel.hidden = i !== active; });
      tabs.forEach(function (tab, i) {
        tab.setAttribute('aria-selected', String(i === active));
        tab.tabIndex = i === active ? 0 : -1;
      });
      if (manual) root.querySelector('[data-slider-status]').textContent = panels[active].querySelector('h2').textContent;
      syncPlayback();
    }

    controls.hidden = false;
    tabs.forEach(function (tab, index) {
      tab.addEventListener('click', function () { show(index, true); });
      tab.addEventListener('keydown', function (event) {
        let next;
        if (event.key === 'ArrowRight') next = (active + 1) % panels.length;
        else if (event.key === 'ArrowLeft') next = (active + panels.length - 1) % panels.length;
        else if (event.key === 'Home') next = 0;
        else if (event.key === 'End') next = panels.length - 1;
        else return;
        event.preventDefault();
        show(next, true);
        tabs[next].focus();
      });
    });
    toggle.addEventListener('click', function () { paused = !paused; syncPlayback(); });
    root.addEventListener('pointerenter', function (event) {
      if (event.pointerType === 'mouse') { hovered = true; syncPlayback(); }
    });
    root.addEventListener('pointerleave', function (event) {
      if (event.pointerType === 'mouse') { hovered = false; syncPlayback(); }
    });
    root.addEventListener('focusin', function () { paused = true; syncPlayback(); });
    doc.addEventListener('visibilitychange', syncPlayback);
    reduced.addEventListener('change', function () { if (reduced.matches) paused = true; syncPlayback(); });
    desktop.addEventListener('change', function () { if (!desktop.matches) paused = true; syncPlayback(); });
    const stage = root.querySelector('[data-slider-stage]');
    stage.addEventListener('pointerdown', function (event) {
      if (event.pointerType === 'touch') pointer = { x: event.clientX, y: event.clientY };
    });
    stage.addEventListener('pointercancel', function () { pointer = null; });
    stage.addEventListener('pointerup', function (event) {
      if (!pointer) return;
      const x = event.clientX - pointer.x;
      const y = event.clientY - pointer.y;
      pointer = null;
      if (Math.abs(x) > 45 && Math.abs(x) > Math.abs(y) * 1.5) show(active + (x < 0 ? 1 : -1), true);
    });
    if (env.IntersectionObserver) {
      new env.IntersectionObserver(function (entries) {
        visible = entries[0].isIntersecting;
        syncPlayback();
      }, { threshold: 0.25 }).observe(root);
    }
    show(0, false);
  }
  if (typeof module !== 'undefined' && module.exports) module.exports = { mountSlider };
  if (typeof document !== 'undefined') document.querySelectorAll('[data-hero-slider]').forEach(function (root) { mountSlider(root); });
})();
