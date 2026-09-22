const test = require('node:test');
const assert = require('node:assert/strict');
const {frameAt} = require('../js/hero-chat.js');
test('conversation writes a question, sends, thinks, streams and finishes in order',()=>{
 const q='Hola Lupita, ¿cómo va el negocio hoy?', a='Operación: entregas en curso.\nVentas: seguimiento pendiente.';
 assert.deepEqual(frameAt(0,q,a),{phase:'compose',draft:'',answer:''});
 const typing=frameAt(1100,q,a); assert.ok(typing.draft.length>0 && typing.draft.length<q.length);
 assert.equal(frameAt(2300,q,a).draft,q);
 assert.equal(frameAt(2800,q,a).phase,'thinking'); assert.equal(frameAt(2800,q,a).draft,'');
 assert.equal(frameAt(3800,q,a).phase,'answer'); assert.ok(frameAt(3800,q,a).answer.length<a.length);
 assert.deepEqual(frameAt(18000,q,a),{phase:'done',draft:'',answer:a});
});
test('streaming preserves Unicode characters and report line breaks',()=>{
 const answer='你好 ✦\n📈 Operación'; const f=frameAt(3720,'Hola',answer);
 assert.equal(f.answer,'你好 ✦\n'); assert.equal(frameAt(21000,'Hola',answer).answer,answer);
});
