/* Commercial estimates only. Contractual billing remains owned by the SaaS backend. */
(function (root) {
  'use strict';
  function estimate(offer, market, people, interval, month) {
    if (!Number.isInteger(people) || people < 1 || people > 10000 || !['MONTH', 'YEAR'].includes(interval)) return null;
    const rates = offer.markets[market === 'OTHER' ? 'US' : market];
    if (!rates) return null;
    const blocks = Math.max(0, Math.ceil((people - offer.includedPeople) / offer.blockSize));
    const annual = interval === 'YEAR';
    const multiplier = annual ? 12 * (100 - offer.annualDiscountPercent) : 100;
    const recurring = cents => Math.round(cents * multiplier / 100);
    const tier = people <= 10 ? 0 : people <= 25 ? 1 : people <= 50 ? 2 : -1;
    const promotion = month <= offer.promotionThroughMonth;
    return {
      currency: rates.currency, blocks,
      prices: rates.base.map(base => recurring(base + blocks * rates.block)),
      blockPrice: recurring(rates.block),
      setup: tier < 0 ? null : (promotion ? rates.setupPromotion[tier] : rates.setup[tier]),
      regularSetup: tier < 0 ? null : rates.setup[tier],
      promotion, annual,
    };
  }
  if (typeof module !== 'undefined' && module.exports) module.exports = { estimate };
  if (typeof document === 'undefined') return;
  const form = document.getElementById('commercial-estimator');
  if (!form) return;
  const offer = JSON.parse(document.getElementById('commercial-offer').textContent);
  const peopleInput = form.querySelector('#plan-people');
  function update() {
    const date = new Date();
    const month = date.getUTCFullYear() + '-' + String(date.getUTCMonth() + 1).padStart(2, '0');
    const result = estimate(offer, form.elements.market.value, peopleInput.valueAsNumber, form.elements.interval.value, month);
    if (!result) {
      document.querySelectorAll('[data-plan-price], [data-block-count], [data-block-price], [data-setup-price], [data-setup-regular]').forEach(el => el.textContent = '—');
      return;
    }
    const locale = document.documentElement.getAttribute('data-locale') || document.documentElement.lang || 'es-MX';
    const number = cents => new Intl.NumberFormat(locale, { minimumFractionDigits: cents % 100 ? 2 : 0, maximumFractionDigits: 2 }).format(cents / 100);
    document.querySelectorAll('[data-plan-price]').forEach(el => el.textContent = number(result.prices[Number(el.dataset.planPrice)]));
    document.querySelectorAll('[data-plan-currency]').forEach(el => el.textContent = result.currency);
    document.querySelectorAll('[data-period-month]').forEach(el => el.hidden = result.annual);
    document.querySelectorAll('[data-period-year]').forEach(el => el.hidden = !result.annual);
    document.querySelector('[data-block-count]').textContent = String(result.blocks);
    document.querySelector('[data-block-price]').textContent = number(result.blockPrice) + ' ' + result.currency;
    document.querySelector('[data-setup-amount]').hidden = result.setup === null;
    document.querySelector('[data-setup-custom]').hidden = result.setup !== null;
    document.querySelector('[data-promotion-label]').hidden = !result.promotion;
    document.querySelector('[data-regular-setup]').hidden = !result.promotion;
    if (result.setup !== null) {
      document.querySelector('[data-setup-price]').textContent = number(result.setup);
      document.querySelector('[data-setup-regular]').textContent = number(result.regularSetup) + ' ' + result.currency;
    }
  }
  form.addEventListener('input', update);
  form.addEventListener('change', update);
  form.addEventListener('submit', event => event.preventDefault());
  new MutationObserver(update).observe(document.documentElement, { attributes: true, attributeFilter: ['lang', 'data-locale'] });
  update();
})(typeof window !== 'undefined' ? window : globalThis);
