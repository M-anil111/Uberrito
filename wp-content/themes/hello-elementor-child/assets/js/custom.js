/* ============================================================
   UBERRITO — Cinematic Hero Banner (vanilla JS)
   Requires GSAP + Swiper already loaded on the page globally.
   ============================================================ */
(() => {
  "use strict";

  const HEADER_SELECTOR = ".ub-header";
  const STICKY_THRESHOLD = 50;
  const DIRECTION_TOLERANCE = 4;

  let header = null;
  let lastScrollY = Math.max(window.scrollY, 0);
  let stickyState = null;
  let directionState = null;
  let ticking = false;

  /**
   * Only prepares .ub-header.
   * The outer Elementor header wrapper remains untouched.
   */
  const prepareHeader = () => {
    header.style.setProperty("position", "fixed", "important");
    header.style.setProperty("top", "80px", "important");
    header.style.setProperty("left", "50%", "important");
    header.style.setProperty("width", "100%", "important");
    header.style.setProperty("z-index", "99999", "important");
    header.style.setProperty(
      "transform",
      "translateX(-50%)",
      "important"
    );
    header.style.setProperty("visibility", "visible", "important");
    header.style.setProperty("opacity", "1", "important");
  };

  /**
   * Avoid unnecessary class writes.
   */
  const toggleClass = (className, enabled) => {
    if (header.classList.contains(className) !== enabled) {
      header.classList.toggle(className, enabled);
    }
  };

  const updateHeader = () => {
    const currentScrollY = Math.max(
      window.scrollY || document.documentElement.scrollTop,
      0
    );

    const delta = currentScrollY - lastScrollY;
    const shouldBeSticky = currentScrollY > STICKY_THRESHOLD;

    // Toggle sticky class only after 50px.
    if (shouldBeSticky !== stickyState) {
      stickyState = shouldBeSticky;
      toggleClass("is-sticky", shouldBeSticky);
    }

    // Track scroll direction without flickering.
    if (Math.abs(delta) >= DIRECTION_TOLERANCE) {
      const nextDirection = delta > 0 ? "down" : "up";

      if (nextDirection !== directionState) {
        directionState = nextDirection;

        toggleClass("scrolling-down", nextDirection === "down");
        toggleClass("scrolling-up", nextDirection === "up");
      }
    }

    // Reset helper classes at the top.
    if (currentScrollY <= 0) {
      stickyState = false;
      directionState = null;

      toggleClass("is-sticky", false);
      toggleClass("scrolling-up", false);
      toggleClass("scrolling-down", false);
    }

    lastScrollY = currentScrollY;
    ticking = false;
  };

  const handleScroll = () => {
    if (ticking) return;

    ticking = true;
    window.requestAnimationFrame(updateHeader);
  };

  const initialize = () => {
    header = document.querySelector(HEADER_SELECTOR);

    if (!header) {
      console.warn("Sticky Header: .ub-header was not found.");
      return;
    }

    prepareHeader();
    updateHeader();

    window.addEventListener("scroll", handleScroll, {
      passive: true
    });

    window.addEventListener("pageshow", () => {
      prepareHeader();
      updateHeader();
    });
  };

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initialize, {
      once: true
    });
  } else {
    initialize();
  }
})();

(() => {
  "use strict";

  const header = document.querySelector(".ub-header");

  if (!header) return;

  const STICKY_THRESHOLD = 50;
  const TOP_CHANGE_THRESHOLD = 100;

  let currentTop = null;
  let isSticky = null;
  let ticking = false;

  // Smoothly animate the top position.
  header.style.setProperty(
    "transition",
    "top 0.45s cubic-bezier(0.22, 1, 0.36, 1)",
    "important"
  );

  header.style.setProperty("will-change", "top");

  const updateHeader = () => {
    const scrollY = Math.max(
      window.scrollY || document.documentElement.scrollTop,
      0
    );

    const nextStickyState = scrollY > STICKY_THRESHOLD;
    const nextTop = scrollY >= TOP_CHANGE_THRESHOLD ? "0px" : "80px";

    // Toggle sticky class only when needed.
    if (nextStickyState !== isSticky) {
      isSticky = nextStickyState;
      header.classList.toggle("is-sticky", isSticky);
    }

    // Update top only when the value changes.
    if (nextTop !== currentTop) {
      currentTop = nextTop;
      header.style.setProperty("top", currentTop, "important");
    }

    ticking = false;
  };

  const handleScroll = () => {
    if (ticking) return;

    ticking = true;
    window.requestAnimationFrame(updateHeader);
  };

  updateHeader();

  window.addEventListener("scroll", handleScroll, {
    passive: true
  });

  window.addEventListener("pageshow", updateHeader);
})();

(function () {
  'use strict';

  var CONFIG = {
    heroSelector: '#ub-hero',
    swiperSelector: '#ub-hero-swiper',
    scrollThreshold: 40,     // px scrolled before header goes solid
    bgZoomDuration: 20,      // seconds, slow cinematic zoom per active slide
    bgZoomScale: 1.08,
  };

  var heroEl = document.querySelector(CONFIG.heroSelector);
  if (!heroEl) return;

  var hasGSAP = typeof window.gsap !== 'undefined';
  var hasSwiper = typeof window.Swiper !== 'undefined';

  /* ----------------------------------------------------------
     1. Split heading text into per-character spans for stagger
  ---------------------------------------------------------- */
  function splitChars(lineEl) {
    var text = lineEl.textContent;
    var frag = document.createDocumentFragment();

    text.split('').forEach(function (ch) {
      var span = document.createElement('span');
      span.className = 'ub-hero__char';
      span.textContent = ch === ' ' ? '\u00A0' : ch;
      frag.appendChild(span);
    });

    lineEl.textContent = '';
    lineEl.appendChild(frag);
  }

  heroEl.querySelectorAll('[data-split]').forEach(splitChars);

  /* ----------------------------------------------------------
     2. Per-slide GSAP entrance timeline
  ---------------------------------------------------------- */
  var activeTimelines = {}; // keyed by slide index, so we can kill/replay cleanly

  function buildSlideTimeline(slideEl, immediate) {
    if (!hasGSAP) return null;

    var tl = gsap.timeline({ paused: true });

    var eyebrow = slideEl.querySelector('[data-anim="eyebrow"]');
    var chars = slideEl.querySelectorAll('.ub-hero__char');
    var desc = slideEl.querySelector('[data-anim="desc"]');
    var cta = slideEl.querySelector('[data-anim="cta"]');
    var meta = slideEl.querySelector('[data-anim="meta"]');
    var badge = slideEl.closest('.swiper-slide') === slideEl
      ? slideEl.querySelector('.ub-hero__badge')
      : null;
    badge = slideEl.querySelector('.ub-hero__badge');
    var ctaButtons = cta ? cta.querySelectorAll('.ub-btn') : [];

    // Reset state before animating in (so replays on loop look correct)
    gsap.set(eyebrow, { opacity: 0, y: 14 });
    gsap.set(chars, { opacity: 0, y: 34, rotation: 6, scale: 0.85, transformOrigin: '50% 100%' });
    gsap.set(desc, { opacity: 0, y: 16 });
    gsap.set(cta, { opacity: 0 });
    gsap.set(ctaButtons, { opacity: 0, y: 14, scale: 0.9 });
    gsap.set(meta, { opacity: 0, y: 10 });
    if (badge) gsap.set(badge, { opacity: 0, scale: 0.85, y: -10 });

    tl.to(eyebrow, { opacity: 1, y: 0, duration: 0.5, ease: 'power2.out' })
      .to(chars, {
        opacity: 1, y: 0, rotation: 0, scale: 1,
        duration: 0.65, ease: 'back.out(1.6)', stagger: 0.022,
      }, '-=0.25')
      .to(desc, { opacity: 1, y: 0, duration: 0.5, ease: 'power2.out' }, '-=0.35')
      .to(cta, { opacity: 1, duration: 0.01 }, '-=0.25')
      .to(ctaButtons, {
        opacity: 1, y: 0, scale: 1,
        duration: 0.7, ease: 'elastic.out(1, 0.6)', stagger: 0.1,
      }, '-=0.2')
      .to(meta, { opacity: 1, y: 0, duration: 0.4, ease: 'power2.out' }, '-=0.3');

    if (badge) {
      tl.to(badge, {
        opacity: 1, scale: 1, y: 0, duration: 0.6, ease: 'power2.out',
        onComplete: function () {
          // idle floating loop, independent of the entrance timeline
          gsap.to(badge, {
            y: -8, duration: 2.6, ease: 'sine.inOut',
            yoyo: true, repeat: -1,
          });
        },
      }, '-=0.5');
    }

    if (immediate) tl.progress(1);
    return tl;
  }

  function playSlide(slideEl) {
    if (!hasGSAP) return;
    var key = slideEl.getAttribute('data-slide') || Math.random();
    if (activeTimelines[key]) activeTimelines[key].kill();
    var tl = buildSlideTimeline(slideEl, false);
    activeTimelines[key] = tl;
    if (tl) tl.play(0);
  }

  /* ----------------------------------------------------------
     3. Background slow cinematic zoom (per active slide)
  ---------------------------------------------------------- */
  var bgTweens = {};

  function playBgZoom(slideEl) {
    if (!hasGSAP) return;
    var bg = slideEl.querySelector('.ub-hero__bg');
    if (!bg) return;
    var key = slideEl.getAttribute('data-slide') || Math.random();

    if (bgTweens[key]) bgTweens[key].kill();
    gsap.set(bg, { scale: 1 });
    bgTweens[key] = gsap.to(bg, {
      scale: CONFIG.bgZoomScale,
      duration: CONFIG.bgZoomDuration,
      ease: 'none',
    });
  }

  /* ----------------------------------------------------------
     4. Swiper init
  ---------------------------------------------------------- */
  var swiperInstance = null;

  if (hasSwiper) {
    swiperInstance = new Swiper(CONFIG.swiperSelector, {
      loop: true,
      effect: 'fade',
      fadeEffect: { crossFade: true },
      speed: 1200,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      },
      keyboard: { enabled: true },
      grabCursor: true,
      allowTouchMove: true,
      simulateTouch: true,
      pagination: {
        el: heroEl.querySelector('.ub-hero__pagination'),
        clickable: true,
      },
      navigation: {
        nextEl: heroEl.querySelector('.ub-hero__nav--next'),
        prevEl: heroEl.querySelector('.ub-hero__nav--prev'),
      },
      a11y: { enabled: true },
      on: {
        init: function (swiper) {
          var activeSlide = swiper.slides[swiper.activeIndex];
          if (activeSlide) {
            playSlide(activeSlide);
            playBgZoom(activeSlide);
          }
        },
        slideChangeTransitionStart: function (swiper) {
          var activeSlide = swiper.slides[swiper.activeIndex];
          if (activeSlide) {
            playSlide(activeSlide);
            playBgZoom(activeSlide);
          }
        },
      },
    });
  } else {
    // Fallback: no Swiper present, just animate the first slide in place.
    var firstSlide = heroEl.querySelector('.ub-hero__slide');
    if (firstSlide) {
      playSlide(firstSlide);
      playBgZoom(firstSlide);
    }
  }

  /* ----------------------------------------------------------
     5. Sticky header transparent -> solid on scroll
     Toggles body.ub-scrolled; see hero.css for the paired rules.
     Uses rAF-throttling so we only touch the DOM once per frame.
  ---------------------------------------------------------- */
  var ticking = false;

  function updateHeaderState() {
    var scrolled = window.scrollY > CONFIG.scrollThreshold;
    document.body.classList.toggle('ub-scrolled', scrolled);
    ticking = false;
  }

  window.addEventListener('scroll', function () {
    if (!ticking) {
      window.requestAnimationFrame(updateHeaderState);
      ticking = true;
    }
  }, { passive: true });

  updateHeaderState(); // set correct initial state (e.g. on reload mid-page)

})();


  document.addEventListener("DOMContentLoaded", function () {
    const sliderElement = document.querySelector(".ub-rewards-swiper");

    if (!sliderElement || typeof Swiper === "undefined") {
      return;
    }

    new Swiper(sliderElement, {
      loop: true,
      slidesPerView: 1,
      spaceBetween: 0,
      speed: 700,

      autoplay: {
        delay: 3500,
        disableOnInteraction: false,
        pauseOnMouseEnter: false
      },

      allowTouchMove: true,
      grabCursor: true,

      keyboard: {
        enabled: true
      },

      a11y: {
        enabled: true
      }
    });
  });