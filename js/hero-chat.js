/* Illustrative typing only: no input submission or agent/API connection. */
(function () {
  'use strict';
  function frameAt(elapsed, question, answer) {
    const q = Array.from(question), a = Array.from(answer);
    const sentAt = 2600, responseAt = 3600;
    const count = Math.max(0, Math.floor((elapsed - responseAt) / 24));
    return {
      phase: elapsed < sentAt ? 'compose' : elapsed < responseAt ? 'thinking' : count < a.length ? 'answer' : 'done',
      draft: elapsed < sentAt ? q.slice(0, Math.floor(q.length * Math.min(1, elapsed / 2200))).join('') : '',
      answer: a.slice(0, count).join('')
    };
  }
  function mountChat(root, env) {
    const panels = Array.from(root.querySelectorAll('[data-scene]'));
    const draft = root.querySelector('[data-chat-draft]');
    const placeholder = root.querySelector('[data-chat-placeholder]');
    const reduced = env.matchMedia('(prefers-reduced-motion: reduce)');
    let current = null, elapsed = 0, timer = null, last = 0, animated = false;
    function stop() { if (timer !== null) env.clearTimeout(timer); timer = null; }
    function render() {
      if (!current) return;
      const question = current.querySelector('[data-chat-question]').textContent.trim();
      const answer = current.querySelector('[data-chat-source]').textContent.trim();
      const stream = current.querySelector('[data-chat-stream]');
      const thinking = current.querySelector('[data-chat-thinking]');
      root.classList.toggle('is-chat-animated', animated);
      if (!animated) {
        root.dataset.chatPhase = 'done'; stream.hidden = true; thinking.hidden = true;
        draft.textContent = ''; placeholder.hidden = false; return;
      }
      const frame = frameAt(elapsed, question, answer);
      root.dataset.chatPhase = frame.phase;
      draft.textContent = frame.draft;
      placeholder.hidden = frame.phase === 'compose';
      stream.hidden = false; stream.textContent = frame.answer;
      thinking.hidden = frame.phase !== 'thinking';
    }
    function tick() {
      const now = env.performance.now(); elapsed += Math.min(now - last, 100); last = now;
      render(); timer = env.setTimeout(tick, 40);
    }
    function sync() {
      stop();
      const selected = panels.find(panel => !panel.hidden);
      const playing = root.dataset.playing === 'true' && !reduced.matches;
      if (selected !== current) { current = selected; elapsed = 0; animated = playing; }
      if (reduced.matches) animated = false;
      if (playing && !animated) { animated = true; elapsed = 0; }
      render();
      if (playing) { last = env.performance.now(); timer = env.setTimeout(tick, 40); }
    }
    // Observe only playback/selection, never the stream text we write ourselves.
    const stateObserver = new env.MutationObserver(sync);
    stateObserver.observe(root, { attributes: true, attributeFilter: ['data-playing'] });
    panels.forEach(panel => stateObserver.observe(panel, { attributes: true, attributeFilter: ['hidden'] }));
    const localeObserver = new env.MutationObserver(sync);
    root.querySelectorAll('[data-chat-source], [data-chat-question]').forEach(node => localeObserver.observe(node, { childList: true, characterData: true, subtree: true }));
    reduced.addEventListener('change', sync);
    sync();
  }
  if (typeof module !== 'undefined' && module.exports) module.exports = { frameAt, mountChat };
  if (typeof document !== 'undefined') document.querySelectorAll('[data-hero-slider]').forEach(root => mountChat(root, window));
})();
