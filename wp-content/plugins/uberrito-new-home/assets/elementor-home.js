(() => {
  'use strict';

  const root = document.querySelector('.ub-el-home');
  if (!root) return;

  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const slides = [...root.querySelectorAll('.ub-el-hero__slide')];
  const count = root.querySelector('.ub-el-hero-count p');
  let active = 0;
  let timer;

  const showSlide = (index) => {
    active = (index + slides.length) % slides.length;
    slides.forEach((slide, i) => {
      slide.classList.toggle('is-active', i === active);
      slide.setAttribute('aria-hidden', i === active ? 'false' : 'true');
    });
    if (count) count.textContent = `0${active + 1} / 0${slides.length}`;
  };

  const restart = () => {
    window.clearInterval(timer);
    if (!reduced && slides.length > 1) timer = window.setInterval(() => showSlide(active + 1), 7000);
  };

  root.querySelector('.ub-el-hero-prev .elementor-button')?.addEventListener('click', (event) => {
    event.preventDefault(); showSlide(active - 1); restart();
  });
  root.querySelector('.ub-el-hero-next .elementor-button')?.addEventListener('click', (event) => {
    event.preventDefault(); showSlide(active + 1); restart();
  });
  showSlide(0);
  restart();

  const revealTargets = root.querySelectorAll('.ub-el-card,.ub-el-proof,.ub-el-section-head,.ub-el-feels__copy,.ub-el-burrito-pal,.ub-el-location-card,.ub-el-catering__copy,.ub-el-catering__image,.ub-el-merch__copy,.ub-el-merch__art,.ub-el-rewards__copy,.ub-el-next-link');
  revealTargets.forEach((item) => item.classList.add('ub-el-reveal'));
  if ('IntersectionObserver' in window && !reduced) {
    const observer = new IntersectionObserver((entries) => entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target);
      }
    }), { threshold: 0.12, rootMargin: '0px 0px -30px' });
    revealTargets.forEach((item, i) => {
      item.style.transitionDelay = `${Math.min(i % 6, 4) * 70}ms`;
      observer.observe(item);
    });
  } else {
    revealTargets.forEach((item) => item.classList.add('is-visible'));
  }

  const eyes = root.querySelectorAll('.ub-el-burrito-pal,.ub-el-face-button');
  const followPointer = (event) => {
    eyes.forEach((character) => {
      const rect = character.getBoundingClientRect();
      const dx = event.clientX - (rect.left + rect.width / 2);
      const dy = event.clientY - (rect.top + rect.height / 2);
      const distance = Math.max(1, Math.hypot(dx, dy));
      character.style.setProperty('--ub-eye-x', `${(dx / distance) * 6}px`);
      character.style.setProperty('--ub-eye-y', `${(dy / distance) * 6}px`);
      if (character.classList.contains('ub-el-burrito-pal') && window.innerWidth > 900) {
        character.style.transform = `rotate(${84 + (dx / window.innerWidth) * 4}deg) translate(${dx * .012}px,${dy * .012}px)`;
      }
    });
  };
  if (!reduced) window.addEventListener('pointermove', followPointer, { passive: true });

  if (!reduced && window.matchMedia('(pointer:fine)').matches) {
    const dots = Array.from({ length: 9 }, () => {
      const dot = document.createElement('i');
      dot.className = 'ub-el-trail-dot';
      document.body.appendChild(dot);
      return { node: dot, x: -100, y: -100 };
    });
    let pointerX = -100;
    let pointerY = -100;
    window.addEventListener('pointermove', (event) => { pointerX = event.clientX; pointerY = event.clientY; }, { passive: true });
    const drawTrail = () => {
      let x = pointerX;
      let y = pointerY;
      dots.forEach((dot, index) => {
        dot.x += (x - dot.x) * .34;
        dot.y += (y - dot.y) * .34;
        dot.node.style.transform = `translate3d(${dot.x}px,${dot.y}px,0) translate(-50%,-50%) scale(${1 - index * .07})`;
        dot.node.style.opacity = `${1 - index * .1}`;
        x = dot.x; y = dot.y;
      });
      requestAnimationFrame(drawTrail);
    };
    drawTrail();
  }
})();
