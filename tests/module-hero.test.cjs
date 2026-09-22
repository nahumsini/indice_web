const test=require('node:test');
const assert=require('node:assert/strict');
const {createCycle,applyScene,PERIOD}=require('../js/module-hero.js');
function setup(paused=false){
 const timers=new Map();let id=0;const changes=[],playback=[];
 const clock={setTimeout(fn,delay){assert.equal(delay,5000);timers.set(++id,fn);return id;},clearTimeout(id){timers.delete(id);}};
 const cycle=createCycle({length:9,clock,paused,onChange:(index,manual)=>changes.push({index,manual}),onPlayback:(playing,paused)=>playback.push({playing,paused})});
 return {cycle,timers,changes,playback,tick(){assert.equal(timers.size,1);const fn=timers.values().next().value;timers.clear();fn();}};
}
test('one five-second clock traverses all nine modules and wraps',()=>{
 const s=setup();assert.equal(PERIOD,5000);
 for(let i=1;i<=18;i++){s.tick();assert.equal(s.cycle.state().index,i%9);}
 assert.deepEqual(s.changes.slice(0,9).map(v=>v.index),[0,1,2,3,4,5,6,7,8]);
});
test('photo, current conversation, label and module link stay synchronized while history persists',()=>{
 const node=()=>({hidden:true,classList:{toggle(_,value){this.active=value;}}});
 const images=Array.from({length:9},node), exchanges=Array.from({length:9},node),labels=Array.from({length:9},node),links=Array.from({length:9},node);
 const parent={children:[...exchanges],appendChild(item){this.children=this.children.filter(n=>n!==item);this.children.push(item);}};
 exchanges.forEach(n=>n.parentNode=parent);
 for(let step=0;step<18;step++){
  const index=step%9;applyScene(images,exchanges,labels,index,links);
  assert.equal(images.findIndex(i=>i.classList.active),index);
  assert.equal(exchanges.findIndex(i=>i.classList.active),index);
  assert.equal(labels.findIndex(i=>!i.hidden),index);
  assert.equal(links.findIndex(i=>!i.hidden),index);
  assert.equal(links.filter(i=>!i.hidden).length,1);
  assert.equal(exchanges.filter(i=>!i.hidden).length,Math.min(step+1,9));
  assert.equal(parent.children.at(-1),exchanges[index]);
  assert.equal(parent.children.length,9);
 }
});
test('manual navigation pauses, wraps backwards and can resume',()=>{
 const s=setup();s.cycle.previous();assert.equal(s.cycle.state().index,8);assert.equal(s.timers.size,0);
 s.cycle.next();assert.equal(s.cycle.state().index,0);assert.ok(s.changes.at(-1).manual);
 s.cycle.toggle();s.tick();assert.equal(s.cycle.state().index,1);
 s.cycle.pause();assert.equal(s.timers.size,0);
});
test('visibility suspension preserves an explicit pause',()=>{
 const s=setup();s.cycle.suspend(true);assert.equal(s.timers.size,0);
 s.cycle.suspend(false);assert.equal(s.timers.size,1);
 s.cycle.pause();s.cycle.suspend(true);s.cycle.suspend(false);assert.equal(s.timers.size,0);
});
test('reduced-motion initial state has no automatic advancement',()=>{
 const s=setup(true);assert.equal(s.timers.size,0);assert.equal(s.cycle.state().index,0);
 s.cycle.next();assert.equal(s.cycle.state().index,1);assert.equal(s.timers.size,0);
});
