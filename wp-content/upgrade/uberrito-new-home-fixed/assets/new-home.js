(function () {
  'use strict';

  var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var coarsePointer = window.matchMedia('(pointer: coarse)').matches;
  var config = window.UberritoNewHome || {};

  function clamp(value, min, max) {
    return Math.min(Math.max(value, min), max);
  }

  function initLoader() {
    var loader = document.querySelector('.nv-loader');
    if (!loader) return;

    var bar = loader.querySelector('.nv-loader__bar');
    var fill = loader.querySelector('.nv-loader__bar span');
    var progress = 0;
    document.documentElement.classList.add('nv-loading');

    function finish() {
      progress = 100;
      if (fill) fill.style.width = '100%';
      if (bar) bar.setAttribute('aria-valuenow', '100');
      window.setTimeout(function () {
        loader.classList.add('is-done');
        document.documentElement.classList.remove('nv-loading');
      }, reducedMotion ? 80 : 240);
    }

    if (reducedMotion) {
      finish();
      return;
    }

    var timer = window.setInterval(function () {
      progress = Math.min(progress + Math.floor(Math.random() * 12 + 8), 92);
      if (fill) fill.style.width = progress + '%';
      if (bar) bar.setAttribute('aria-valuenow', String(progress));
    }, 115);

    function complete() {
      window.clearInterval(timer);
      finish();
    }

    if (document.readyState === 'complete') {
      window.setTimeout(complete, 900);
    } else {
      window.addEventListener('load', function () { window.setTimeout(complete, 650); }, { once: true });
      window.setTimeout(complete, 2200);
    }
  }

  function initOfferRail() {
    var rail = document.querySelector('.nv-offers');
    if (!rail) return;

    var offers = [
      { label: 'New member offer', text: 'New here? Get <strong>FREE</strong> small chips & queso.', cta: 'Join now', image: 'rewards-chips.webp', href: config.rewardsUrl },
      { label: 'Member exclusive', text: 'Get texts + emails. Enjoy a <strong>FREE drink</strong> today.', cta: 'Get the offer', image: 'bowl-and-glass.webp', href: config.rewardsUrl },
      { label: 'NÜ Rewards', text: 'Eat. Earn. Eat free. <strong>Rewards start here.</strong>', cta: 'Sign up', image: 'rewards-burritos.webp', href: config.rewardsUrl },
      { label: 'Order direct', text: 'Get <strong>$5 off</strong> when you order on Uberrito.com.', cta: 'Order now', image: 'rewards-nachos.webp', href: config.orderUrl }
    ];
    var image = rail.querySelector('.nv-offers__image');
    var label = rail.querySelector('.nv-offers__copy small');
    var text = rail.querySelector('.nv-offers__copy p');
    var link = rail.querySelector('.nv-offers__link');
    var current = rail.querySelector('[data-offer-current]');
    var pause = rail.querySelector('[data-offer-pause]');
    var index = 0;
    var paused = false;
    var timer;

    function show(nextIndex) {
      index = (nextIndex + offers.length) % offers.length;
      var offer = offers[index];
      if (image) {
        image.style.opacity = '0';
        image.style.transform = 'translateY(8px) scale(.9)';
      }
      window.setTimeout(function () {
        if (image) {
          image.src = (config.assetsUrl || '') + offer.image;
          image.style.opacity = '1';
          image.style.transform = '';
        }
        if (label) label.textContent = offer.label;
        if (text) text.innerHTML = offer.text;
        if (link) {
          link.href = offer.href || '#';
          link.innerHTML = offer.cta + ' <span aria-hidden="true">→</span>';
        }
        if (current) current.textContent = String(index + 1);
      }, 180);
    }

    function restart() {
      window.clearInterval(timer);
      if (!paused) timer = window.setInterval(function () { show(index + 1); }, 5200);
    }

    var prev = rail.querySelector('[data-offer-prev]');
    var next = rail.querySelector('[data-offer-next]');
    if (prev) prev.addEventListener('click', function () { show(index - 1); restart(); });
    if (next) next.addEventListener('click', function () { show(index + 1); restart(); });
    if (pause) pause.addEventListener('click', function () {
      paused = !paused;
      pause.textContent = paused ? '▶' : 'Ⅱ';
      pause.setAttribute('aria-label', paused ? 'Resume offer rotation' : 'Pause offer rotation');
      restart();
    });
    restart();
  }

  function initNavigation() {
    var header = document.querySelector('.nv-site-head');
    var toggle = document.querySelector('.nv-menu-toggle');
    var menu = document.querySelector('.nv-mobile-menu');
    if (!header) return;

    var ticking = false;
    function update() {
      header.classList.toggle('is-scrolled', window.scrollY > 90);
      ticking = false;
    }
    window.addEventListener('scroll', function () {
      if (ticking) return;
      ticking = true;
      window.requestAnimationFrame(update);
    }, { passive: true });
    update();

    if (toggle && menu) {
      toggle.addEventListener('click', function () {
        var open = toggle.getAttribute('aria-expanded') === 'true';
        toggle.setAttribute('aria-expanded', String(!open));
        menu.hidden = open;
      });
      menu.addEventListener('click', function (event) {
        if (!event.target.closest('a')) return;
        toggle.setAttribute('aria-expanded', 'false');
        menu.hidden = true;
      });
    }
  }

  function initReveals() {
    var items = document.querySelectorAll('[data-nv-reveal]');
    if (!items.length || reducedMotion || !('IntersectionObserver' in window)) {
      items.forEach(function (item) { item.classList.add('is-visible'); });
      return;
    }

    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target);
      });
    }, { threshold: .12, rootMargin: '0px 0px -8% 0px' });
    items.forEach(function (item) { observer.observe(item); });
  }

  function initParallax() {
    if (reducedMotion || coarsePointer) return;

    document.querySelectorAll('.nv-parallax').forEach(function (item) {
      var depth = Number(item.dataset.depth || 12);
      item.addEventListener('pointermove', function (event) {
        var rect = item.getBoundingClientRect();
        var x = ((event.clientX - rect.left) / rect.width - .5) * depth;
        var y = ((event.clientY - rect.top) / rect.height - .5) * depth;
        item.style.transform = 'translate3d(' + x + 'px,' + y + 'px,0)';
      });
      item.addEventListener('pointerleave', function () { item.style.transform = ''; });
    });
  }

  function initMagneticElements() {
    if (reducedMotion || coarsePointer) return;

    document.querySelectorAll('.nv-magnetic').forEach(function (item) {
      item.addEventListener('pointermove', function (event) {
        var rect = item.getBoundingClientRect();
        var base = item.classList.contains('nv-face-button') ? ' rotate(-5deg)' : '';
        var x = (event.clientX - rect.left - rect.width / 2) * .13;
        var y = (event.clientY - rect.top - rect.height / 2) * .15;
        item.style.transform = 'translate3d(' + x + 'px,' + y + 'px,0)' + base;
      });
      item.addEventListener('pointerleave', function () { item.style.transform = ''; });
    });
  }

  function initEyes() {
    if (reducedMotion || coarsePointer) return;

    document.querySelectorAll('.nv-face-button').forEach(function (face) {
      face.addEventListener('pointermove', function (event) {
        var rect = face.getBoundingClientRect();
        var x = clamp((event.clientX - rect.left - rect.width / 2) / 15, -5, 5);
        var y = clamp((event.clientY - rect.top - rect.height / 2) / 15, -5, 5);
        face.style.setProperty('--eye-x', x + 'px');
        face.style.setProperty('--eye-y', y + 'px');
      });
      face.addEventListener('pointerleave', function () {
        face.style.setProperty('--eye-x', '0px');
        face.style.setProperty('--eye-y', '0px');
      });
    });
  }

  function initFlightPath() {
    var section = document.querySelector('.nv-flight');
    var svg = document.querySelector('.nv-flight__path');
    var path = document.querySelector('#nv-flight-path');
    var plane = document.querySelector('.nv-plane');
    if (!section || !svg || !path || !plane || reducedMotion || window.innerWidth < 768) return;

    var total = path.getTotalLength();
    var ticking = false;
    function update() {
      var maxScroll = Math.max(section.offsetHeight - window.innerHeight, 1);
      var progress = clamp((window.scrollY - section.offsetTop) / maxScroll, 0, 1);
      var point = path.getPointAtLength(total * progress);
      var ahead = path.getPointAtLength(Math.min(total, total * progress + 2));
      var rect = svg.getBoundingClientRect();
      var x = rect.left + point.x / 1400 * rect.width;
      var y = rect.top + point.y / 620 * rect.height;
      var angle = Math.atan2(ahead.y - point.y, ahead.x - point.x) * 180 / Math.PI;
      plane.style.transform = 'translate3d(' + x + 'px,' + y + 'px,0) translate(-50%,-50%) rotate(' + angle + 'deg)';
      ticking = false;
    }
    window.addEventListener('scroll', function () {
      if (ticking) return;
      ticking = true;
      window.requestAnimationFrame(update);
    }, { passive: true });
    window.addEventListener('resize', update, { passive: true });
    update();
  }

  function initBottomNavPreview() {
    if (coarsePointer) return;
    var section = document.querySelector('.nv-bottom-nav');
    var preview = document.querySelector('.nv-bottom-preview');
    var image = preview && preview.querySelector('img');
    if (!section || !preview || !image) return;

    section.querySelectorAll('nav a[data-preview]').forEach(function (link) {
      link.addEventListener('pointerenter', function () {
        image.src = (config.assetsUrl || '') + link.dataset.preview;
        preview.classList.add('is-visible');
      });
      link.addEventListener('pointerleave', function () { preview.classList.remove('is-visible'); });
    });
    section.addEventListener('pointermove', function (event) {
      preview.style.left = event.clientX + 'px';
      preview.style.top = event.clientY + 'px';
    });
  }

  function initFoodLaunch() {
    var footer = document.querySelector('.nv-footer');
    var foods = footer && footer.querySelectorAll('.nv-food-launch img');
    var letters = footer && footer.querySelectorAll('.nv-footer__word span');
    if (!footer || !foods || !foods.length || reducedMotion || !('IntersectionObserver' in window)) return;

    var animations = [];
    function start() {
      if (animations.length) return;
      foods.forEach(function (food, index) {
        animations.push(food.animate([
          { opacity: 0, transform: 'translate3d(0,120px,0) rotate(0deg)' },
          { opacity: 1, offset: .12 },
          { opacity: 1, transform: 'translate3d(' + ((index % 2 ? -1 : 1) * (35 + index * 8)) + 'px,-' + (330 + index * 35) + 'px,0) rotate(' + (index % 2 ? -150 : 180) + 'deg)', offset: .52 },
          { opacity: 1, offset: .86 },
          { opacity: 0, transform: 'translate3d(' + (index * 10 - 20) + 'px,130px,0) rotate(' + (index % 2 ? -330 : 360) + 'deg)' }
        ], { duration: 2900 + index * 170, delay: index * 220, iterations: Infinity, easing: 'cubic-bezier(.45,.05,.55,.95)' }));
      });
      letters.forEach(function (letter, index) {
        animations.push(letter.animate([
          { transform: 'translateY(0) rotate(0)' },
          { transform: 'translateY(-' + (8 + index % 3 * 4) + 'px) rotate(' + (index % 2 ? -2 : 2) + 'deg)' },
          { transform: 'translateY(0) rotate(0)' }
        ], { duration: 1600 + index * 80, delay: index * 90, iterations: Infinity, easing: 'ease-in-out' }));
      });
    }
    function stop() {
      animations.forEach(function (animation) { animation.cancel(); });
      animations = [];
    }
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) { if (entry.isIntersecting) start(); else stop(); });
    }, { threshold: .18 });
    observer.observe(footer);
  }

  function init() {
    initLoader();
    initOfferRail();
    initNavigation();
    initReveals();
    initParallax();
    initMagneticElements();
    initEyes();
    initFlightPath();
    initBottomNavPreview();
    initFoodLaunch();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init, { once: true });
  } else {
    init();
  }
})();
