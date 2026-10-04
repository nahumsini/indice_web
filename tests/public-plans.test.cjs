const test = require('node:test');
const assert = require('node:assert/strict');
const fs = require('node:fs');
const path = require('node:path');

const root = path.resolve(__dirname, '..');
const offer = require('../content/public-plans-mx.json');

test('published Mexico plans match the approved commercial table', () => {
  assert.equal(offer.currency, 'MXN');
  assert.equal(offer.includedPeople, 10);
  assert.equal(offer.additionalPeopleBlockMonthlyCents, 89900);
  assert.equal(offer.implementationPromotionThroughMonth, '2026-10');
  assert.deepEqual(offer.plans.map(({ id, monthlyCents, annualCents,
    implementationPromotionCents, implementationRegularCents }) => [
    id, monthlyCents, annualCents, implementationPromotionCents, implementationRegularCents,
  ]), [
    ['controla', 299900, 2879040, 499900, 999900],
    ['escala', 549900, 5279040, 749950, 1499900],
    ['corporativo', 949900, 9119040, 1249950, 2499900],
  ]);
  for (const plan of offer.plans) {
    assert.equal(plan.annualCents, plan.monthlyCents * 12 * 0.8);
  }
});

test('each pricing CTA keeps the consultant-led diagnosis as the next step', () => {
  const page = fs.readFileSync(path.join(root, 'planes.php'), 'utf8');
  assert.match(page, /href="\/diagnostico\.php\?plan=<\?= \$slug \?>"/);
  assert.doesNotMatch(page, /getIndiceSignupUrl|\/signup|capture_registration|\/checkout/);
});

test('diagnosis starts its CSRF session before rendering the header', () => {
  const page = fs.readFileSync(path.join(root, 'diagnostico.php'), 'utf8');
  assert.ok(page.indexOf('startSecureSession();') > page.indexOf("require_once __DIR__ . '/content/marketing.php';"));
  assert.ok(page.indexOf('startSecureSession();') < page.indexOf("include 'header.php';"));
});

test('module and specialist scope is explicit for each plan', () => {
  assert.deepEqual(offer.modules.map(({ id, includedIn, choiceIn }) => [id, includedIn, choiceIn || []]), [
    ['panel', ['controla', 'escala', 'corporativo'], []],
    ['people', ['controla', 'escala', 'corporativo'], []],
    ['tasks', ['controla', 'escala', 'corporativo'], []],
    ['expenses', ['escala', 'corporativo'], []],
    ['sales', ['corporativo'], ['escala']],
    ['pos', ['corporativo'], ['escala']],
    ['inventory', ['escala', 'corporativo'], []],
    ['receivables', ['corporativo'], []],
    ['kpis', ['corporativo'], []],
  ]);
  assert.deepEqual(offer.agents.map(({ id, includedIn }) => [id, includedIn]), [
    ['lupita', ['controla', 'escala', 'corporativo']],
    ['controla', ['controla', 'escala', 'corporativo']],
    ['escala', ['escala', 'corporativo']],
    ['finance', ['escala', 'corporativo']],
    ['corporativo', ['corporativo']],
  ]);
});

test('every locale describes each published module and specialist', () => {
  for (const file of fs.readdirSync(path.join(root, 'i18n')).filter((name) => name.endsWith('.json'))) {
    const copy = JSON.parse(fs.readFileSync(path.join(root, 'i18n', file), 'utf8'));
    for (const { id } of offer.modules) {
      assert.ok(copy[`brand26.price.module.${id}.detail`], `${file}: ${id} detail`);
    }
    for (const { id } of offer.agents) {
      assert.ok(copy[`brand26.price.agent.${id}`], `${file}: ${id} name`);
      assert.ok(copy[`brand26.price.agent.${id}.detail`], `${file}: ${id} detail`);
    }
    assert.ok(copy['brand26.price.agents.heading'], `${file}: agents heading`);
    assert.ok(copy['brand26.price.agents.note'], `${file}: agents note`);
  }
});
