(function () {
  'use strict';

  var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  function refreshOfferRail() {
    var rail = document.querySelector('.ub-rewards-swiper');
    if (!rail || !window.UberritoHome) return;

    var offers = [
      {
        eyebrow: 'New member offer',
        title: 'Join NÜ Rewards. Get <strong>FREE</strong> small chips & queso.',
        cta: 'Join free',
        href: UberritoHome.rewardsUrl,
        image: 'rewards-chips.webp',
        alt: 'Chips rewards offer'
      },
      {
        eyebrow: 'Member exclusive',
        title: 'Get texts + emails. Enjoy a <strong>FREE drink</strong> today.',
        cta: 'Get the offer',
        href: UberritoHome.rewardsUrl,
        image: 'bowl-and-glass.webp',
        alt: 'Uberrito drink offer'
      },
      {
        eyebrow: 'NÜ Rewards',
        title: 'Eat. Earn. Eat free. <strong>Rewards start here.</strong>',
        cta: 'Sign up',
        href: UberritoHome.rewardsUrl,
        image: 'rewards-burritos.webp',
        alt: 'Uberrito rewards offer'
      },
      {
        eyebrow: 'Order direct',
        title: 'Get <strong>$5 off</strong> when you order on Uberrito.com.',
        cta: 'Order direct',
        href: UberritoHome.orderUrl,
        image: 'rewards-nachos.webp',
        alt: 'Uberrito direct order offer'
      }
    ];

    rail.querySelectorAll('.ub-rewards-slide').forEach(function (slide, index) {
      var offer = offers[index % offers.length];
      var eyebrow = slide.querySelector('.ub-rewards-eyebrow');
      var title = slide.querySelector('h3');
      var button = slide.querySelector('.ub-rewards-button');
      var image = slide.querySelector('img');

      if (eyebrow) eyebrow.textContent = offer.eyebrow;
      if (title) title.innerHTML = offer.title;
      if (button) {
        button.href = offer.href;
        button.innerHTML = offer.cta + '<span aria-hidden="true">→</span>';
      }
      if (image) {
        image.src = UberritoHome.assetsUrl + offer.image;
        image.alt = offer.alt;
      }
    });
  }

  function loadHeroVideo() {
    var video = document.querySelector('.ub-home-hero__video');
    var connection = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
    if (!video || reducedMotion || window.innerWidth < 960 || (connection && connection.saveData)) return;

    video.src = video.dataset.src;
    video.addEventListener('canplay', function () {
      var playAttempt = video.play();
      if (playAttempt && typeof playAttempt.then === 'function') {
        playAttempt.then(function () { video.classList.add('is-playing'); }).catch(function () {});
      }
    }, { once: true });
    video.load();
  }

  function syncHeaderOffset() {
    var header = document.querySelector('.ub-header');
    var rail = document.querySelector('.ub-rewards-swiper');
    if (!header || !rail) return;

    var ticking = false;
    var update = function () {
      var top = window.scrollY > 100 ? 8 : rail.getBoundingClientRect().height + 8;
      header.style.setProperty('top', Math.round(top) + 'px', 'important');
      ticking = false;
    };

    var queue = function () {
      if (ticking) return;
      ticking = true;
      window.requestAnimationFrame(update);
    };

    update();
    window.addEventListener('scroll', queue, { passive: true });
    window.addEventListener('resize', queue, { passive: true });
  }

  function revealOnScroll() {
    var items = document.querySelectorAll('[data-reveal]');
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
    }, { rootMargin: '0px 0px -8% 0px', threshold: .12 });

    items.forEach(function (item) { observer.observe(item); });
  }

  function addPointerDepth() {
    if (reducedMotion || window.matchMedia('(pointer: coarse)').matches) return;

    document.querySelectorAll('.ub-pointer-depth').forEach(function (item) {
      var depth = Number(item.dataset.depth || 10);
      item.addEventListener('pointermove', function (event) {
        var rect = item.getBoundingClientRect();
        var x = (event.clientX - rect.left) / rect.width - .5;
        var y = (event.clientY - rect.top) / rect.height - .5;
        item.style.transform = 'translate3d(' + (x * depth) + 'px,' + (y * depth) + 'px,0)';
      });
      item.addEventListener('pointerleave', function () { item.style.transform = ''; });
    });
  }

  function addTilt() {
    if (reducedMotion || window.matchMedia('(pointer: coarse)').matches) return;

    document.querySelectorAll('.ub-tilt').forEach(function (card) {
      card.addEventListener('pointermove', function (event) {
        var rect = card.getBoundingClientRect();
        var rx = ((event.clientY - rect.top) / rect.height - .5) * -4;
        var ry = ((event.clientX - rect.left) / rect.width - .5) * 4;
        card.style.transform = 'perspective(1200px) rotateX(' + rx + 'deg) rotateY(' + ry + 'deg)';
      });
      card.addEventListener('pointerleave', function () { card.style.transform = ''; });
    });
  }

  function addMagneticButtons() {
    if (reducedMotion || window.matchMedia('(pointer: coarse)').matches) return;

    document.querySelectorAll('.ub-magnetic').forEach(function (button) {
      button.addEventListener('pointermove', function (event) {
        var rect = button.getBoundingClientRect();
        var x = (event.clientX - rect.left - rect.width / 2) * .12;
        var y = (event.clientY - rect.top - rect.height / 2) * .16;
        button.style.transform = 'translate3d(' + x + 'px,' + y + 'px,0)';
      });
      button.addEventListener('pointerleave', function () { button.style.transform = ''; });
    });
  }

  function init() {
    refreshOfferRail();
    syncHeaderOffset();
    revealOnScroll();
    addPointerDepth();
    addTilt();
    addMagneticButtons();
    window.setTimeout(loadHeroVideo, 900);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init, { once: true });
  } else {
    init();
  }
})();
