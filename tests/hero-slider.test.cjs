const test = require('node:test');
const assert = require('node:assert/strict');
const { mountSlider } = require('../js/hero-slider.js');
function setup({ mobile = false, motion = false } = {}) {
  const element = () => ({ hidden: false, dataset: {}, attrs: {}, listeners: {}, children: {},
    addEventListener(type, fn) { (this.listeners[type] ||= []).push(fn); },
    emit(type, event = {}) { for (const fn of this.listeners[type] || []) fn(event); },
    setAttribute(key, value) { this.attrs[key] = value; },
    querySelector(key) { return this.children[key]; }, focus() { root.emit('focusin'); this.focused = true; }
  });
  const root = element(), doc = element(), stage = element(), toggle = element(), controls = element(), status = element();
  const panels = [0,1,2].map(i => { const p=element(); p.children.h2={textContent:`Scene ${i}`}; return p; });
  const tabs = [0,1,2].map(element);
  toggle.children['[data-pause-label]']=element(); toggle.children['[data-play-label]']=element();
  root.ownerDocument=doc; root.querySelectorAll=key => key==='[data-scene]'?panels:tabs;
  root.children={'[data-slider-controls]':controls,'[data-slider-toggle]':toggle,'[data-slider-stage]':stage,'[data-slider-status]':status};
  const reduced=element(), desktop=element(); reduced.matches=motion; desktop.matches=!mobile;
  const timers=new Map(); let id=0; let intersection;
  const env={ matchMedia:q=>q.includes('reduced')?reduced:desktop, setTimeout:fn=>{timers.set(++id,fn); return id;}, clearTimeout:n=>timers.delete(n), IntersectionObserver:class { constructor(fn){intersection=fn;} observe(){} } };
  mountSlider(root,env);
  return {root,doc,stage,toggle,controls,status,panels,tabs,reduced,timers, intersection:visible=>intersection([{isIntersecting:visible}]), tick:()=>{const fn=timers.values().next().value; assert.ok(fn); timers.clear(); fn();}, active:()=>panels.findIndex(p=>!p.hidden)};
}
test('desktop rotates and wraps; manual selection pauses and announces',()=>{
 const s=setup(); assert.equal(s.active(),0); assert.equal(s.controls.hidden,false);
 for (const i of [1,2,0]) { s.tick(); assert.equal(s.active(),i); }
 s.tabs[2].emit('click'); assert.equal(s.active(),2); assert.equal(s.timers.size,0); assert.equal(s.status.textContent,'Scene 2'); assert.equal(s.tabs[2].attrs['aria-selected'],'true');
});
test('keyboard navigation wraps, moves focus and maintains one tab stop',()=>{
 const s=setup(); let prevented=false;
 s.tabs[0].emit('keydown',{key:'ArrowLeft',preventDefault(){prevented=true;}});
 assert.ok(prevented); assert.equal(s.active(),2); assert.ok(s.tabs[2].focused); assert.deepEqual(s.tabs.map(t=>t.tabIndex),[-1,-1,0]);
 s.tabs[2].emit('keydown',{key:'Home',preventDefault(){}}); assert.equal(s.active(),0); assert.equal(s.timers.size,0);
});
test('hover, hidden document and offscreen suspend playback; focus pauses',()=>{
 const s=setup(); s.root.emit('pointerenter',{pointerType:'mouse'}); assert.equal(s.timers.size,0);
 s.root.emit('pointerleave',{pointerType:'mouse'}); assert.equal(s.timers.size,1);
 s.doc.hidden=true; s.doc.emit('visibilitychange'); assert.equal(s.timers.size,0);
 s.doc.hidden=false; s.doc.emit('visibilitychange'); s.intersection(false); assert.equal(s.timers.size,0);
 s.intersection(true); assert.equal(s.timers.size,1); s.root.emit('focusin'); assert.equal(s.timers.size,0);
 s.toggle.emit('click'); assert.equal(s.timers.size,1); s.toggle.emit('click'); assert.equal(s.timers.size,0);
});
test('mobile starts paused and supports horizontal swipe without intercepting vertical gestures',()=>{
 const s=setup({mobile:true}); assert.equal(s.timers.size,0);
 s.stage.emit('pointerdown',{pointerType:'touch',clientX:100,clientY:20}); s.stage.emit('pointerup',{clientX:20,clientY:30}); assert.equal(s.active(),1);
 s.stage.emit('pointerdown',{pointerType:'touch',clientX:100,clientY:20}); s.stage.emit('pointerup',{clientX:20,clientY:150}); assert.equal(s.active(),1);
});
test('reduced motion disables automatic playback initially and when preference changes',()=>{
 const s=setup({motion:true}); assert.equal(s.timers.size,0); assert.ok(s.toggle.hidden); s.tabs[1].emit('click'); assert.equal(s.active(),1);
 const d=setup(); d.reduced.matches=true; d.reduced.emit('change'); assert.equal(d.timers.size,0); assert.ok(d.toggle.hidden);
});
