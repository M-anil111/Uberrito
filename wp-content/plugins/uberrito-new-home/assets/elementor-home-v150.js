(function(){
  'use strict';
  var reduced=matchMedia('(prefers-reduced-motion: reduce)').matches;
  var coarse=matchMedia('(pointer: coarse)').matches;
  var config=window.UberritoNewHome||{};
  function clamp(v,min,max){return Math.min(Math.max(v,min),max)}
  function actual(el,selector){return el&&el.querySelector(selector)}

  function normalizeElementor(){
    document.querySelectorAll('.nv-hero__copy .elementor-heading-title>span:not(.nv-accent),.nv-hero__copy .nv-hero__lede,.nv-hero__copy .nv-hero__lede p,.nv-hero__copy .nv-eyebrow,.nv-hero__copy .nv-hero__location').forEach(function(el){el.style.setProperty('color','#fff','important');el.style.setProperty('-webkit-text-fill-color','#fff','important')});
    var orderText=document.querySelector('.nv-nav__order .elementor-button-text');if(orderText)orderText.textContent='ORDER NOW →';
  }

  function loader(){
    var el=document.querySelector('.nv-loader');if(!el)return;
    var bar=el.querySelector('.nv-loader__bar'),fill=el.querySelector('.nv-loader__bar-fill'),p=0,t,done=false;
    document.documentElement.classList.add('nv-loading');
    function finish(){if(done)return;done=true;clearInterval(t);if(fill)fill.style.width='100%';if(bar)bar.setAttribute('aria-valuenow','100');setTimeout(function(){el.classList.add('is-done');document.documentElement.classList.remove('nv-loading')},reduced?20:220)}
    if(reduced){finish();return}
    t=setInterval(function(){p=Math.min(p+Math.floor(Math.random()*12+8),92);if(fill)fill.style.width=p+'%';if(bar)bar.setAttribute('aria-valuenow',String(p))},115);
    if(document.readyState==='complete')setTimeout(finish,650);else addEventListener('load',function(){setTimeout(finish,450)},{once:true});setTimeout(finish,2200);
  }

  function offers(){
    var rail=document.querySelector('.nv-offers');if(!rail)return;
    var data=[
      {label:'New member offer',text:'New here? Get <strong>FREE</strong> small chips & guacamole.',cta:'Join now',image:'rewards-chips.webp',href:config.rewardsUrl},
      {label:'NÜ Rewards',text:'Join today. Get enough points for a <strong>FREE side.</strong>',cta:'Sign up',image:'rewards-burritos.webp',href:config.rewardsUrl}
    ];
    var img=rail.querySelector('.nv-offers__image img'),label=rail.querySelector('small'),copy=rail.querySelector('.nv-offers__copy p'),link=rail.querySelector('.nv-offers__link a'),count=rail.querySelector('.nv-offers__count b'),index=0;
    function show(n){index=(n+data.length)%data.length;var o=data[index];rail.classList.add('is-changing');setTimeout(function(){if(img)img.src=(config.assetsUrl||'')+o.image;if(label)label.textContent=o.label;if(copy)copy.innerHTML=o.text;if(link){link.href=o.href||'#';link.textContent=o.cta+' →'}if(count)count.textContent=(index+1)+' / '+data.length;rail.classList.remove('is-changing')},220)}
    if(!reduced)setInterval(function(){show(index+1)},5200);
  }

  function heroSlider(){
    var hero=document.querySelector('.nv-hero'),slides=hero&&hero.querySelectorAll('[data-hero-slide]'),dots=hero&&hero.querySelectorAll('[data-hero-dot]');if(!hero||!slides||slides.length<2)return;
    var index=0,timer;
    function show(n){index=(n+slides.length)%slides.length;slides.forEach(function(s,i){s.classList.toggle('is-active',i===index);s.setAttribute('aria-hidden',i===index?'false':'true')});dots.forEach(function(d,i){d.classList.toggle('is-active',i===index)})}
    function start(){clearInterval(timer);if(!reduced)timer=setInterval(function(){show(index+1)},7000)}
    var prev=hero.querySelector('[data-hero-prev]'),next=hero.querySelector('[data-hero-next]');
    if(prev)prev.addEventListener('click',function(e){e.preventDefault();show(index-1);start()});if(next)next.addEventListener('click',function(e){e.preventDefault();show(index+1);start()});
    dots.forEach(function(d){d.addEventListener('click',function(e){e.preventDefault();show(Number(d.getAttribute('data-hero-dot')));start()})});show(0);start();
  }

  function navigation(){
    var head=document.querySelector('.nv-site-head'),toggle=document.querySelector('.nv-menu-toggle');if(!head)return;
    function update(){head.classList.toggle('is-scrolled',scrollY>90)}addEventListener('scroll',function(){requestAnimationFrame(update)},{passive:true});update();
    if(toggle)toggle.addEventListener('click',function(e){if(innerWidth>767)return;e.preventDefault();var links=document.querySelector('.nv-nav__links');if(!links)return;var open=links.classList.toggle('is-mobile-open');toggle.setAttribute('aria-expanded',String(open))});
  }

  function reveals(){var items=document.querySelectorAll('[data-nv-reveal]');if(!items.length||reduced||!('IntersectionObserver'in window)){items.forEach(function(i){i.classList.add('is-visible')});return}var ob=new IntersectionObserver(function(entries){entries.forEach(function(e){if(e.isIntersecting){e.target.classList.add('is-visible');ob.unobserve(e.target)}})},{threshold:.08,rootMargin:'0px 0px -5%'});items.forEach(function(i){ob.observe(i)})}
  function parallax(){if(reduced||coarse)return;document.querySelectorAll('.nv-parallax').forEach(function(el){var depth=Number(el.dataset.depth||12);el.addEventListener('pointermove',function(e){var r=el.getBoundingClientRect(),x=((e.clientX-r.left)/r.width-.5)*depth,y=((e.clientY-r.top)/r.height-.5)*depth;el.style.transform='translate3d('+x+'px,'+y+'px,0)'});el.addEventListener('pointerleave',function(){el.style.transform=''})})}
  function magnetic(){if(reduced||coarse)return;document.querySelectorAll('.nv-magnetic').forEach(function(el){el.addEventListener('pointermove',function(e){var r=el.getBoundingClientRect(),x=(e.clientX-r.left-r.width/2)*.13,y=(e.clientY-r.top-r.height/2)*.15;el.style.transform='translate3d('+x+'px,'+y+'px,0)'});el.addEventListener('pointerleave',function(){el.style.transform=''})})}

  function pointerCharacters(){if(reduced)return;var faces=document.querySelectorAll('.nv-face-button,.nv-burrito-pal,.nv-clippy');if(!faces.length)return;addEventListener('pointermove',function(e){faces.forEach(function(face){var r=face.getBoundingClientRect(),dx=e.clientX-r.left-r.width/2,dy=e.clientY-r.top-r.height/2,len=Math.max(Math.hypot(dx,dy),1);face.style.setProperty('--eye-x',clamp(dx/len*5,-5,5)+'px');face.style.setProperty('--eye-y',clamp(dy/len*5,-5,5)+'px');if(face.classList.contains('nv-burrito-pal')){face.style.setProperty('--arm-left',clamp(-25+dy/24,-55,20)+'deg');face.style.setProperty('--arm-right',clamp(25-dy/24,-20,55)+'deg');face.style.setProperty('--pal-tilt',clamp(dx/90,-7,7)+'deg')}})},{passive:true})}

  function pointerTrail(){
    if(reduced||coarse)return;var host=document.createElement('div');host.className='nv-pointer-trail';document.body.appendChild(host);var pool=[],cursor=0,pending=false,lastX=0,lastY=0;
    for(var i=0;i<18;i++){var dot=document.createElement('i');dot.className='nv-trail-dot';dot.style.opacity='0';host.appendChild(dot);pool.push(dot)}
    function paint(){pending=false;var dot=pool[cursor++%pool.length];dot.getAnimations().forEach(function(a){a.cancel()});dot.style.left=lastX+'px';dot.style.top=lastY+'px';dot.animate([{opacity:.9,transform:'translate(-50%,-50%) scale(1)'},{opacity:0,transform:'translate(-50%,-50%) scale(.15) translateY(24px)'}],{duration:650,easing:'cubic-bezier(.22,1,.36,1)',fill:'forwards'})}
    addEventListener('pointermove',function(e){lastX=e.clientX;lastY=e.clientY;if(!pending){pending=true;requestAnimationFrame(paint)}},{passive:true});
  }

  function flight(){
    var section=document.querySelector('.nv-flight'),plane=document.querySelector('.nv-plane');if(!section||!plane||reduced||innerWidth<768)return;var busy=false;
    function update(){var r=section.getBoundingClientRect(),max=Math.max(section.offsetHeight-innerHeight,1),p=clamp(-r.top/max,0,1),w=innerWidth,h=innerHeight,x=w*(.1+.8*p),y=h*(.65-.42*Math.sin(Math.PI*p)),a=-25+50*p;plane.style.transform='translate3d('+x+'px,'+y+'px,0) translate(-50%,-50%) rotate('+a+'deg)';busy=false}
    addEventListener('scroll',function(){if(!busy){busy=true;requestAnimationFrame(update)}},{passive:true});addEventListener('resize',update,{passive:true});update();
  }

  function previews(){if(coarse)return;var section=document.querySelector('.nv-bottom-nav'),preview=section&&section.querySelector('.nv-bottom-preview'),img=preview&&preview.querySelector('img');if(!section||!preview||!img)return;section.querySelectorAll('[data-preview]').forEach(function(link){link.addEventListener('pointerenter',function(){img.src=(config.assetsUrl||'')+link.dataset.preview;preview.classList.add('is-visible')});link.addEventListener('pointerleave',function(){preview.classList.remove('is-visible')})});section.addEventListener('pointermove',function(e){var r=section.getBoundingClientRect();preview.style.left=(e.clientX-r.left)+'px';preview.style.top=(e.clientY-r.top)+'px'})}

  function fruitNinja(){
    var footer=document.querySelector('.nv-footer'),stage=footer&&footer.querySelector('.nv-ninja-stage'),items=stage&&stage.querySelectorAll('[data-ninja-item]');if(!footer||!stage||!items.length||reduced)return;
    var slashTrail=document.createElement('i');slashTrail.className='nv-slash-trail';stage.appendChild(slashTrail);var animations=[],last={x:0,y:0,t:0},trailTimer;
    items.forEach(function(item){var img=item.querySelector('img');if(!img)return;var src=img.currentSrc||img.src;img.style.opacity='0';['left','right'].forEach(function(side){var half=document.createElement('i');half.className='nv-ninja-half nv-ninja-half--'+side;half.style.setProperty('--food','url("'+src+'")');item.appendChild(half)})});
    function start(){if(animations.length)return;var width=footer.clientWidth,height=footer.clientHeight;items.forEach(function(item,i){var startX=(.06+i*.205)*width,endX=startX+(i%2?-.1:.1)*width,duration=6600+i*340;animations.push(item.animate([{opacity:0,transform:'translate3d('+startX+'px,'+(height+100)+'px,0) rotate(0deg)'},{opacity:1,offset:.1},{opacity:1,transform:'translate3d('+endX+'px,'+(-120-i*18)+'px,0) rotate('+(i%2?-210:235)+'deg)',offset:.56},{opacity:1,offset:.8},{opacity:0,transform:'translate3d('+(endX+(i%2?-30:30))+'px,'+(height+55)+'px,0) rotate('+(i%2?-360:400)+'deg)'}],{duration:duration,delay:i*620,iterations:Infinity,easing:'cubic-bezier(.42,0,.58,1)'}))})}
    function stop(){animations.forEach(function(a){a.cancel()});animations=[]}
    function slash(e){var r=stage.getBoundingClientRect(),x=e.clientX-r.left,y=e.clientY-r.top,now=performance.now(),dx=x-last.x,dy=y-last.y,speed=Math.hypot(dx,dy)/Math.max(now-last.t,1);if(speed>.25){slashTrail.style.left=x+'px';slashTrail.style.top=y+'px';slashTrail.style.setProperty('--slash-angle',Math.atan2(dy,dx)*180/Math.PI+'deg');slashTrail.classList.add('is-live');clearTimeout(trailTimer);trailTimer=setTimeout(function(){slashTrail.classList.remove('is-live')},90)}if(speed>.35)items.forEach(function(item){var b=item.getBoundingClientRect();if(e.clientX>b.left-18&&e.clientX<b.right+18&&e.clientY>b.top-18&&e.clientY<b.bottom+18){item.classList.add('is-sliced');setTimeout(function(){item.classList.remove('is-sliced')},650)}});last={x:x,y:y,t:now}}
    stage.addEventListener('pointermove',slash,{passive:true});if('IntersectionObserver'in window)new IntersectionObserver(function(entries){entries.forEach(function(e){e.isIntersecting?start():stop()})},{threshold:.12}).observe(footer);else start();
  }

  function init(){normalizeElementor();loader();offers();heroSlider();navigation();reveals();parallax();magnetic();pointerCharacters();pointerTrail();flight();previews();fruitNinja()}
  if(document.readyState==='loading')document.addEventListener('DOMContentLoaded',init,{once:true});else init();
})();
