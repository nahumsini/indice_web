const test = require('node:test');
const assert = require('node:assert/strict');
const { estimate } = require('../js/commercial-estimate.js');
const offer = require('../content/commercial-offer.json');

test('ten-person block boundaries and commercial examples', () => {
  for (const [people, blocks] of [[1,0],[10,0],[11,1],[20,1],[21,2],[30,2],[31,3]]) {
    assert.equal(estimate(offer, 'MX', people, 'MONTH', '2026-09').blocks, blocks);
  }
  assert.equal(estimate(offer,'MX',30,'MONTH','2026-09').prices[1],729700);
  assert.equal(estimate(offer,'US',30,'MONTH','2026-09').prices[1],43900);
  assert.equal(estimate(offer,'CA',30,'MONTH','2026-09').prices[1],59900);
});

test('annual discount covers package and blocks but leaves setup unchanged', () => {
  const result = estimate(offer,'MX',30,'YEAR','2026-09');
  assert.equal(result.prices[1],7005120);
  assert.equal(result.blockPrice,863040);
  assert.equal(result.setup,1249950);
  assert.equal(result.annual,true);
});

test('setup has its own 10/25/50-person boundaries and retains promotional cents', () => {
  for (const [people, cents] of [[10,499900],[11,749950],[25,749950],[26,1249950],[50,1249950],[51,null]]) {
    assert.equal(estimate(offer,'MX',people,'MONTH','2026-10').setup,cents);
  }
  const normal=estimate(offer,'MX',11,'MONTH','2026-11');
  assert.equal(normal.setup,1499900);
  assert.equal(normal.promotion,false);
});

test('international market uses US rates and local markets retain their currency', () => {
  assert.deepEqual(estimate(offer,'OTHER',26,'YEAR','2026-09'),estimate(offer,'US',26,'YEAR','2026-09'));
  assert.equal(estimate(offer,'CA',26,'MONTH','2026-09').currency,'CAD');
  assert.equal(estimate(offer,'CA',26,'MONTH','2026-09').setup,103900);
});

test('invalid input never silently becomes a zero-price estimate', () => {
  for (const people of [0,-1,NaN,10.5,10001,Infinity]) assert.equal(estimate(offer,'MX',people,'MONTH','2026-09'),null);
  assert.equal(estimate(offer,'??',10,'MONTH','2026-09'),null);
  assert.equal(estimate(offer,'MX',10,'WEEK','2026-09'),null);
});
