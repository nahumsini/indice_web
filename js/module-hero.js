/* One clock owns both the photograph and the matching illustrative exchange. */
(function () {
  'use strict';
  const PERIOD = 5000;
  function createCycle({ length, clock, onChange, onPlayback, paused = false }) {
    let index = 0, suspended = false, timer = null;
    function schedule() {
      if (timer !== null) clock.clearTimeout(timer);
      timer = null;
      const playing = !paused && !suspended;
      onPlayback(playing, paused);
      if (playing) timer = clock.setTimeout(function () { index = (index + 1) % length; onChange(index, false); schedule(); }, PERIOD);
    }
    function select(next) { index = (next + length) % length; paused = true; onChange(index, true); schedule(); }
    onChange(index, false); schedule();
    return {
      next() { select(index + 1); }, previous() { select(index - 1); },
      pause() { paused = true; schedule(); }, toggle() { paused = !paused; schedule(); },
      suspend(value) { suspended = value; schedule(); },
      state() { return { index, paused, suspended }; }
    };
  }
  function applyScene(images, exchanges, labels, index, links = []) {
    images.forEach((image, i) => image.classList.toggle('is-active', i === index));
    exchanges.forEach((exchange, i) => { exchange.classList.toggle('is-current', i === index); });
    const latest = exchanges[index];
    latest.hidden = false;
    // Reuse nine exchanges in chronological order: retain history without growing the DOM.
    if (latest.parentNode) latest.parentNode.appendChild(latest);
    links.forEach((link, i) => { link.hidden = i !== index; });
    labels.forEach((label, i) => { label.hidden = i !== index; });
  }
  function mount(root, env) {
    const doc = root.ownerDocument;
    const images = Array.from(root.querySelectorAll('[data-module-image]'));
    const exchanges = Array.from(root.querySelectorAll('[data-module-exchange]'));
    const labels = Array.from(root.querySelectorAll('[data-module-label]'));
    const demo = root.querySelector('[data-module-demo]');
    const links = Array.from(root.querySelectorAll('[data-module-link]'));
    const stage = root.querySelector('[data-module-stage]');
    const controls = root.querySelector('[data-module-controls]');
    const toggle = root.querySelector('[data-module-toggle]');
    const reduced = env.matchMedia('(prefers-reduced-motion: reduce)');
    const status = root.querySelector('[data-module-status]');
    let inView = true;
    if (!images.length || images.length !== exchanges.length || labels.length !== exchanges.length) return;
    const cycle = createCycle({
      length: images.length, clock: env, paused: reduced.matches,
      onChange(index, manual) {
        applyScene(images, exchanges, labels, index, links);
        stage.scrollTop = stage.scrollHeight;
        if (manual) status.textContent = labels[index].textContent.trim();
      },
      onPlayback(playing, paused) {
        demo.dataset.playing = String(playing);
        root.querySelector('[data-module-pause]').hidden = paused;
        root.querySelector('[data-module-play]').hidden = !paused;
      }
    });
    controls.hidden = false;
    toggle.addEventListener('click', () => cycle.toggle());
    root.querySelector('[data-module-previous]').addEventListener('click', () => cycle.previous());
    root.querySelector('[data-module-next]').addEventListener('click', () => cycle.next());
    controls.addEventListener('keydown', event => {
      if (event.key === 'ArrowLeft' || event.key === 'ArrowRight') {
        event.preventDefault(); event.key === 'ArrowLeft' ? cycle.previous() : cycle.next();
      }
    });
    controls.addEventListener('focusin', event => { if (event.target !== toggle) cycle.pause(); });
    function visibility() { cycle.suspend(doc.hidden || !inView); }
    doc.addEventListener('visibilitychange', visibility);
    reduced.addEventListener('change', () => { if (reduced.matches) cycle.pause(); });
    if (env.IntersectionObserver) new env.IntersectionObserver(entries => { inView = entries[0].isIntersecting; visibility(); }, { threshold: 0.1 }).observe(root);
    let touch = null;
    stage.addEventListener('pointerdown', event => { if (event.pointerType === 'touch') { cycle.pause(); touch = { x: event.clientX, y: event.clientY }; } });
    stage.addEventListener('pointercancel', () => { touch = null; });
    stage.addEventListener('pointerup', event => {
      if (!touch) return;
      const x = event.clientX - touch.x, y = event.clientY - touch.y; touch = null;
      if (Math.abs(x) > 45 && Math.abs(x) > Math.abs(y) * 1.5) x < 0 ? cycle.next() : cycle.previous();
    });
    stage.addEventListener('wheel', () => cycle.pause(), { passive: true });
    stage.addEventListener('focusin', () => cycle.pause());
    links.forEach(link => { link.addEventListener('pointerenter', () => cycle.pause()); link.addEventListener('focus', () => cycle.pause()); });
    visibility();
  }
  if (typeof module !== 'undefined' && module.exports) module.exports = { createCycle, applyScene, PERIOD };
  if (typeof document !== 'undefined') document.querySelectorAll('[data-module-hero]').forEach(root => mount(root, window));
})();
