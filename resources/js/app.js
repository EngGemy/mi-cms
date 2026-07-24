// MI Poultry — public frontend bootstrap
import Lenis from 'lenis';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { createIcons, icons } from 'lucide';
import Swiper from 'swiper';
import { Navigation, Pagination, A11y } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/pagination';
import 'swiper/css/navigation';

gsap.registerPlugin(ScrollTrigger);
window.Lenis = Lenis;
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;

/** @type {import('swiper').Swiper | null} */
let projectsSwiper = null;

// Initialize Lucide icons
function refreshLucideIcons() {
  createIcons({ icons });
}

document.addEventListener('DOMContentLoaded', () => {
  refreshLucideIcons();
  initLoader();
  initLenis();
  initHeader();
  initHeroCinematic();
  initRotator();
  initParallax();
  initFooterReveal();
  initCounters();
  initMagnetic();
  initFaq();
  initMobileMenu();
  initNavDropdowns();
  initStagesSlider();
  initProjectsSection();
  // Carousels BEFORE reveals so GSAP does not leave moved nodes at opacity:0
  initMiCarousels();
  initReveals();
  initSmoothAnchors();
  initAboutPage();
  initProjectPage();
  initCertModal();
  initCertHoverPreview();
  initChairmanTypewriter();
  initSideRailShare();
  initProcessTimeline();
  initListingNav();
  initServicesCinema();
  initServiceCalcLinks();
  initSpaTransitions();
  ScrollTrigger.refresh();
});

document.addEventListener('livewire:init', () => {
  Livewire.hook('morph.updated', () => {
    refreshLucideIcons();
  });
});

let lenis;

function initLoader() {
  // Loader removed — mark ready immediately and run soft entrances.
  document.body.classList.add('is-loaded');
  const boot = () => {
    runHeroEntrance();
    runHeaderBrandEntrance();
    if (window.ScrollTrigger) ScrollTrigger.refresh();
  };
  if (document.readyState === 'complete') boot();
  else window.addEventListener('load', boot, { once: true });
}

function runHeaderBrandEntrance() {
  const brand = document.querySelector('[data-header-brand]');
  if (!brand) return;
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  const mark = brand.querySelector('.header-brand-logo');
  const img = brand.querySelector('.header-brand-logo img');
  const text = brand.querySelector('.header-brand-text');
  const glow = brand.querySelector('.header-brand-glow');
  const sheen = brand.querySelector('.header-brand-sheen');

  const tl = gsap.timeline({ defaults: { ease: 'expo.out' } });

  tl.set(brand, { opacity: 1 })
    .fromTo(mark, {
      opacity: 0,
      scale: 0.55,
      rotate: -18,
      filter: 'blur(8px)',
    }, {
      opacity: 1,
      scale: 1,
      rotate: -3,
      filter: 'blur(0px)',
      duration: 1.05,
    }, 0)
    .fromTo(glow, { opacity: 0, scale: 0.6 }, { opacity: 0.85, scale: 1, duration: 0.8 }, 0.1)
    .fromTo(text, {
      opacity: 0,
      x: 18,
      filter: 'blur(6px)',
    }, {
      opacity: 1,
      x: 0,
      filter: 'blur(0px)',
      duration: 0.85,
    }, 0.28)
    .fromTo(sheen, { xPercent: -130, opacity: 0 }, { xPercent: 130, opacity: 1, duration: 0.9, ease: 'power2.inOut' }, 0.45)
    .to(sheen, { opacity: 0, duration: 0.2 }, 1.2)
    .to(glow, { opacity: 0.35, duration: 0.6 }, 1.0)
    .add(() => {
      // Hand off to continuous CSS logo animation
      if (mark) gsap.set(mark, { clearProps: 'transform,filter' });
      if (sheen) gsap.set(sheen, { clearProps: 'transform,opacity' });
      if (glow) gsap.set(glow, { clearProps: 'transform,opacity' });
    });
}

function initLenis() {
  lenis = new Lenis({
    duration: 1.1,
    easing: t => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
    smoothWheel: true,
  });
  lenis.on('scroll', ScrollTrigger.update);
  gsap.ticker.add(time => lenis.raf(time * 1000));
  gsap.ticker.lagSmoothing(0);
  window.lenis = lenis;
}

function runHeroEntrance() {
  const tl = gsap.timeline({ defaults: { ease: 'expo.out' } });

  tl.fromTo('[data-hero-headline] .char-line',
    { y: '115%', rotateX: -8 },
    { y: '0%', rotateX: 0, duration: 1.3, stagger: 0.14, transformOrigin: 'center bottom' },
    0
  );

  tl.fromTo('[data-hero-headline] .rotating-word',
    { opacity: 0, y: 24, scale: .92 },
    { opacity: 1, y: 0, scale: 1, duration: 1, ease: 'power4.out' },
    0.45
  );

  tl.fromTo('[data-hero-fade]',
    { opacity: 0, y: 28, filter: 'blur(6px)' },
    { opacity: 1, y: 0, filter: 'blur(0px)', duration: 1, stagger: 0.1 },
    0.25
  );

  tl.fromTo('.hero--cinematic .hero-stats > div',
    { opacity: 0, y: 20 },
    { opacity: 1, y: 0, duration: .7, stagger: 0.08, ease: 'power3.out' },
    1.0
  );
}

function initHeroCinematic() {
  const root = document.querySelector('[data-hero-cinematic]');
  if (!root) return;

  document.body.classList.add('has-cinematic-hero');

  const video = root.querySelector('[data-hero-video]');
  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  if (!video) {
    root.classList.add('hero--no-video');
    root.classList.remove('hero--has-video');
    return;
  }

  if (reduced) {
    root.classList.add('hero--reduced');
    root.classList.remove('hero--has-video');
    video.removeAttribute('autoplay');
    try { video.pause(); } catch (_) {}
    return;
  }

  let failed = false;
  const markPlaying = () => {
    if (failed) return;
    root.classList.add('hero--video-playing');
    root.classList.remove('hero--video-failed');
  };
  const markFailed = () => {
    failed = true;
    root.classList.add('hero--video-failed');
    root.classList.remove('hero--video-playing', 'hero--has-video');
  };

  video.muted = true;
  video.defaultMuted = true;
  video.setAttribute('muted', '');
  video.playsInline = true;

  const tryPlay = () => {
    if (failed) return;
    const p = video.play();
    if (p && typeof p.then === 'function') {
      p.then(markPlaying).catch(() => {
        // Retry once after a short delay (iOS / slow decode)
        setTimeout(() => {
          const retry = video.play();
          if (retry && typeof retry.then === 'function') {
            retry.then(markPlaying).catch(markFailed);
          } else {
            markPlaying();
          }
        }, 250);
      });
    } else {
      markPlaying();
    }
  };

  video.addEventListener('playing', markPlaying);
  video.addEventListener('error', markFailed, { once: true });
  const source = video.querySelector('source');
  if (source) source.addEventListener('error', markFailed, { once: true });

  if (video.readyState >= 2) tryPlay();
  else {
    video.addEventListener('loadeddata', tryPlay, { once: true });
    video.addEventListener('canplay', tryPlay, { once: true });
  }

  // Unlock autoplay after first user gesture if needed
  const unlock = () => {
    if (!failed && video.paused) tryPlay();
    window.removeEventListener('pointerdown', unlock);
    window.removeEventListener('touchstart', unlock);
  };
  window.addEventListener('pointerdown', unlock, { once: true, passive: true });
  window.addEventListener('touchstart', unlock, { once: true, passive: true });

  const io = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) tryPlay();
      else {
        try { video.pause(); } catch (_) {}
      }
    });
  }, { threshold: 0.12 });
  io.observe(root);
}

function initRotator() {
  const root = document.getElementById('rotWord');
  if (!root) return;
  const items = [...root.querySelectorAll('.rw-item')];
  if (items.length < 2) return;

  const hero = document.querySelector('[data-hero-cinematic]');
  const hasVideo = !!(hero && hero.querySelector('[data-hero-video]') && !hero.classList.contains('hero--reduced') && !hero.classList.contains('hero--video-failed'));
  const imgLayers = hasVideo ? [] : [...document.querySelectorAll('[data-hero-images] .hero-image-layer')];

  let idx = 0;
  setInterval(() => {
    const cur = items[idx];
    idx = (idx + 1) % items.length;
    const next = items[idx];
    cur.classList.add('is-exit'); cur.classList.remove('is-active');
    requestAnimationFrame(() => next.classList.add('is-active'));
    setTimeout(() => cur.classList.remove('is-exit'), 700);
    imgLayers.forEach((l, i) => l.classList.toggle('is-active', i === idx));
  }, 3200);
}

/* ------------------------------------------------------------------
   CINEMATIC REVEALS
   ------------------------------------------------------------------ */
function initReveals() {
  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduced) {
    gsap.set('[data-reveal], [data-stagger] > *, [data-parallax], .eyebrow', {
      opacity: 1, x: 0, y: 0, scale: 1,
      clipPath: 'inset(0% 0% 0% 0%)',
      filter: 'blur(0px)',
      clearProps: 'transform,opacity,clip-path,filter'
    });
    return;
  }

  const isRTL = document.documentElement.dir === 'rtl';
  const isMobile = window.innerWidth < 768;

  // Helper to set will-change safely
  const setWillChange = (el, props) => { el.style.willChange = props; };
  const clearWillChange = (el) => { el.style.willChange = 'auto'; };

  // 1) Individual reveals
  gsap.utils.toArray('[data-reveal]').forEach(el => {
    const type = (el.getAttribute('data-reveal') || '').trim();
    const delay = parseFloat(el.getAttribute('data-reveal-delay')) || 0;

    let from = {};
    let to = {};
    let will = 'transform, opacity';

    switch (type) {
      case 'left':
        from = { opacity: 0, x: isRTL ? 60 : -60 };
        to = { opacity: 1, x: 0, duration: 1, ease: 'power3.out', delay };
        break;
      case 'right':
        from = { opacity: 0, x: isRTL ? -60 : 60 };
        to = { opacity: 1, x: 0, duration: 1, ease: 'power3.out', delay };
        break;
      case 'scale':
        from = { opacity: 0, scale: 0.92, y: 30 };
        to = { opacity: 1, scale: 1, y: 0, duration: 1, ease: 'power3.out', delay };
        break;
      case 'clip':
        if (isMobile) {
          from = { opacity: 0, y: 40 };
          to = { opacity: 1, y: 0, duration: 1, ease: 'power3.out', delay };
        } else {
          from = { opacity: 0, clipPath: 'inset(0 0 100% 0)' };
          to = { opacity: 1, clipPath: 'inset(0 0% 0% 0)', duration: 1.1, ease: 'power3.out', delay };
          will = 'clip-path, opacity';
        }
        break;
      case 'title':
        if (isMobile) {
          from = { opacity: 0, y: 30 };
          to = { opacity: 1, y: 0, duration: 0.9, ease: 'power3.out', delay };
        } else {
          from = { opacity: 0, y: 40, clipPath: 'inset(100% 0 0 0)' };
          to = { opacity: 1, y: 0, clipPath: 'inset(0% 0 0 0)', duration: 1, ease: 'power3.out', delay };
          will = 'clip-path, opacity';
        }
        break;
      default:
        from = { opacity: 0, y: 50, filter: 'blur(4px)' };
        to = { opacity: 1, y: 0, filter: 'blur(0px)', duration: 1, ease: 'power3.out', delay };
        will = 'transform, opacity, filter';
    }

    setWillChange(el, will);
    gsap.fromTo(el, from, {
      ...to,
      scrollTrigger: { trigger: el, start: 'top 85%', once: true },
      onComplete: () => clearWillChange(el)
    });
  });

  // 2) Stagger containers
  gsap.utils.toArray('[data-stagger]').forEach(c => {
    // Skip mobile carousels — Swiper reparents children and leaves them invisible if staggered first
    if (c.hasAttribute('data-mi-carousel')) return;

    const delay = parseFloat(c.getAttribute('data-reveal-delay')) || 0;
    const children = [...c.children].filter(ch => !ch.hasAttribute('data-no-reveal'));
    if (!children.length) return;

    children.forEach(ch => setWillChange(ch, 'transform, opacity, filter'));
    gsap.fromTo(children,
      { opacity: 0, y: 40, scale: 0.96, filter: 'blur(3px)' },
      {
        opacity: 1, y: 0, scale: 1, filter: 'blur(0px)',
        duration: 0.9, ease: 'power3.out', stagger: 0.1, delay,
        scrollTrigger: { trigger: c, start: 'top 85%', once: true },
        onComplete: () => children.forEach(clearWillChange)
      }
    );
  });

  // 3) Eyebrow labels
  gsap.utils.toArray('.eyebrow').forEach(el => {
    setWillChange(el, 'transform, opacity');
    gsap.fromTo(el,
      { opacity: 0, x: isRTL ? 20 : -20, scale: .92 },
      {
        opacity: 1, x: 0, scale: 1,
        duration: .7, ease: 'power3.out',
        scrollTrigger: { trigger: el, start: 'top 92%', once: true },
        onComplete: () => clearWillChange(el)
      }
    );
  });
}

/* ------------------------------------------------------------------
   PARALLAX (light, scrubbed)
   ------------------------------------------------------------------ */
function initParallax() {
  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const isMobile = window.innerWidth < 768;
  if (reduced || isMobile) return;

  gsap.utils.toArray('[data-parallax]').forEach(el => {
    const speed = parseFloat(el.getAttribute('data-parallax')) || 0.1;
    const clamped = Math.max(0.05, Math.min(0.2, speed));
    el.style.willChange = 'transform';
    gsap.fromTo(el,
      { y: `${-clamped * 100}%` },
      {
        y: `${clamped * 100}%`,
        ease: 'none',
        scrollTrigger: { trigger: el, scrub: 1 },
        onComplete: () => { el.style.willChange = 'auto'; }
      }
    );
  });
}

/* ------------------------------------------------------------------
   FOOTER REVEAL
   ------------------------------------------------------------------ */
function initFooterReveal() {
  const footer = document.querySelector('footer');
  if (!footer) return;

  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduced) {
    const line = footer.querySelector('.footer-line');
    if (line) line.style.transform = 'scaleX(1)';
    return;
  }

  const isMobile = window.innerWidth < 768;
  const tl = gsap.timeline({
    scrollTrigger: { trigger: footer, start: 'top 90%', once: true }
  });

  // Top line draw
  const line = footer.querySelector('.footer-line');
  if (line) {
    tl.fromTo(line,
      { scaleX: 0 },
      { scaleX: 1, duration: 1.2, ease: 'power3.out' },
      0
    );
  }

  // Brand
  const brand = footer.querySelector('.footer-brand');
  if (brand) {
    tl.fromTo(brand,
      { opacity: 0, y: 30 },
      { opacity: 1, y: 0, duration: 0.9, ease: 'power3.out' },
      0.1
    );
  }

  // Columns stagger
  const cols = footer.querySelectorAll('.footer-col');
  if (cols.length) {
    tl.fromTo(cols,
      { opacity: 0, y: isMobile ? 30 : 50 },
      { opacity: 1, y: 0, duration: 0.9, stagger: 0.12, ease: 'power3.out' },
      0.2
    );
  }

  // Copyright bar
  const copy = footer.querySelector('.footer-copy');
  if (copy) {
    tl.fromTo(copy,
      { opacity: 0 },
      { opacity: 1, duration: 0.8, ease: 'power2.out' },
      0.6
    );
  }

  // Watermark parallax
  const watermark = footer.querySelector('.footer-watermark');
  if (watermark && !isMobile) {
    gsap.fromTo(watermark,
      { y: '-12%' },
      { y: '12%', ease: 'none', scrollTrigger: { trigger: footer, scrub: 1.5 } }
    );
  }
}

function initCounters() {
  gsap.utils.toArray('[data-counter]').forEach(el => {
    const target = parseFloat(el.getAttribute('data-target'));
    const obj = { n: 0 };
    ScrollTrigger.create({
      trigger: el, start: 'top 85%', once: true,
      onEnter: () => gsap.to(obj, { n: target, duration: 2, ease: 'power3.out',
        onUpdate: () => el.textContent = Math.round(obj.n).toLocaleString('en-US') }),
    });
  });
}

function initMagnetic() {
  document.querySelectorAll('[data-magnetic]').forEach(btn => {
    btn.addEventListener('mousemove', e => {
      const r = btn.getBoundingClientRect();
      const x = e.clientX - r.left - r.width / 2;
      const y = e.clientY - r.top - r.height / 2;
      btn.style.transform = `translate(${x * 0.15}px, ${y * 0.25}px)`;
    });
    btn.addEventListener('mouseleave', () => { btn.style.transform = ''; });
  });
}

function initFaq() {
  document.querySelectorAll('.faq-item').forEach(item => {
    item.querySelector('.faq-q')?.addEventListener('click', () => {
      const open = item.classList.toggle('is-open');
      item.querySelector('.faq-q').setAttribute('aria-expanded', String(open));
      lenis?.resize();
    });
  });
}

function initMobileMenu() {
  const btn = document.getElementById('mobBtn');
  const closeBtn = document.getElementById('mobClose');
  const drawer = document.getElementById('mobDrawer');
  if (!btn || !drawer) return;

  const set = (open) => {
    drawer.classList.toggle('is-open', open);
    document.body.classList.toggle('menu-open', open);
    btn.classList.toggle('is-open', open);
    btn.setAttribute('aria-expanded', open ? 'true' : 'false');
    drawer.setAttribute('aria-hidden', open ? 'false' : 'true');
    if (open) lenis?.stop();
    else lenis?.start();
  };

  btn.addEventListener('click', () => set(!drawer.classList.contains('is-open')));
  closeBtn?.addEventListener('click', () => set(false));

  document.querySelectorAll('[data-mob-link]').forEach((l) => {
    l.addEventListener('click', () => set(false));
  });

  drawer.querySelectorAll('[data-mob-group]').forEach((group) => {
    const gBtn = group.querySelector('[data-mob-group-btn]');
    const panel = group.querySelector('[data-mob-group-panel]');
    if (!gBtn || !panel) return;
    gBtn.addEventListener('click', () => {
      const open = panel.hasAttribute('hidden');
      panel.toggleAttribute('hidden', !open);
      gBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
      group.classList.toggle('is-open', open);
    });
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && drawer.classList.contains('is-open')) set(false);
  });
}

function initNavDropdowns() {
  const drops = [...document.querySelectorAll('[data-nav-drop]')];
  if (!drops.length) return;

  const closeAll = (except = null) => {
    drops.forEach((drop) => {
      if (drop === except) return;
      const btn = drop.querySelector('[data-nav-drop-btn]');
      const panel = drop.querySelector('[data-nav-drop-panel]');
      drop.classList.remove('is-open');
      btn?.setAttribute('aria-expanded', 'false');
      panel?.setAttribute('hidden', '');
    });
  };

  drops.forEach((drop) => {
    const btn = drop.querySelector('[data-nav-drop-btn]');
    const panel = drop.querySelector('[data-nav-drop-panel]');
    if (!btn || !panel) return;

    btn.addEventListener('click', (e) => {
      e.preventDefault();
      e.stopPropagation();
      const open = !drop.classList.contains('is-open');
      closeAll(drop);
      drop.classList.toggle('is-open', open);
      btn.setAttribute('aria-expanded', open ? 'true' : 'false');
      panel.toggleAttribute('hidden', !open);
    });

    drop.addEventListener('mouseenter', () => {
      if (window.matchMedia('(hover: hover)').matches) {
        closeAll(drop);
        drop.classList.add('is-open');
        btn.setAttribute('aria-expanded', 'true');
        panel.removeAttribute('hidden');
      }
    });
    drop.addEventListener('mouseleave', () => {
      if (window.matchMedia('(hover: hover)').matches) {
        drop.classList.remove('is-open');
        btn.setAttribute('aria-expanded', 'false');
        panel.setAttribute('hidden', '');
      }
    });
  });

  document.addEventListener('click', () => closeAll());
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeAll();
  });
}

function initStagesSlider() {
  const section = document.getElementById('stagesSection');
  const track = document.getElementById('stagesTrack');
  const wrap = document.querySelector('.stages-wrap');
  const prev = document.getElementById('stagesPrev');
  const next = document.getElementById('stagesNext');
  const progressEl = document.getElementById('stagesProgress');
  if (!section || !track || !wrap) return;

  const cards = [...track.querySelectorAll('.stage-card')];
  if (!cards.length) return;

  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const isMobile = window.innerWidth < 768;
  const isRTL = document.documentElement.dir === 'rtl';

  // Build progress dots
  if (progressEl) {
    progressEl.innerHTML = cards.map(() => '<span class="stages-progress-dot"></span>').join('');
  }
  const dots = progressEl ? [...progressEl.querySelectorAll('.stages-progress-dot')] : [];

  const updateDots = (idx) => {
    dots.forEach((d, i) => d.classList.toggle('is-active', i === idx));
  };

  const getStep = () => (cards[0]?.offsetWidth || 380) + 20;

  // Reduced motion: static, fully visible
  if (reduced) {
    gsap.set(cards, { opacity: 1, clearProps: 'transform' });
    gsap.set(track, { clearProps: 'transform' });
    if (prev) prev.disabled = true;
    if (next) next.disabled = cards.length <= 1;
    updateDots(0);
    return;
  }

  // ------------------------------------------------------------------
  // MOBILE: native horizontal swipe + stagger entrance + progress
  // ------------------------------------------------------------------
  if (isMobile) {
    gsap.fromTo(cards,
      { opacity: 0, y: 50, scale: 0.96 },
      {
        opacity: 1, y: 0, scale: 1,
        duration: 0.85, stagger: 0.1, ease: 'power3.out',
        scrollTrigger: { trigger: section, start: 'top 80%', once: true }
      }
    );

    const nums = cards.map(c => c.querySelector('.stage-num')).filter(Boolean);
    if (nums.length) {
      gsap.fromTo(nums,
        { opacity: 0, scale: 0.5, rotate: -12 },
        {
          opacity: 1, scale: 1, rotate: -3,
          duration: 0.6, stagger: 0.1, ease: 'back.out(1.6)',
          scrollTrigger: { trigger: section, start: 'top 75%', once: true }
        }
      );
    }

    const onScroll = () => {
      const max = track.scrollWidth - wrap.clientWidth;
      if (max <= 0) { updateDots(0); return; }
      const progress = Math.max(0, Math.min(1, Math.abs(track.scrollLeft) / max));
      updateDots(Math.round(progress * (cards.length - 1)));
    };
    track.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    if (prev && next) {
      const dir = isRTL ? -1 : 1;
      prev.addEventListener('click', () => track.scrollBy({ left: dir * getStep(), behavior: 'smooth' }));
      next.addEventListener('click', () => track.scrollBy({ left: -dir * getStep(), behavior: 'smooth' }));
    }
    return;
  }

  // ------------------------------------------------------------------
  // DESKTOP: pinned horizontal scroll (cinematic)
  // ------------------------------------------------------------------
  const maxScroll = () => track.scrollWidth - wrap.clientWidth;
  const endOffset = () => maxScroll() + Math.min(window.innerHeight * 0.35, 500);

  // Set initial hidden state immediately to prevent FOUC
  gsap.set(cards, { opacity: 0, y: 60, scale: 0.94, rotateY: isRTL ? -5 : 5 });
  gsap.set(track, { x: 0 });

  const tl = gsap.timeline({
    scrollTrigger: {
      trigger: section,
      pin: true,
      scrub: 1,
      start: 'top 18%',
      end: () => '+=' + endOffset(),
      invalidateOnRefresh: true,
      onUpdate: (self) => {
        const idx = Math.min(cards.length - 1, Math.floor(self.progress * cards.length));
        updateDots(idx);
        if (prev) prev.disabled = self.progress <= 0.02;
        if (next) next.disabled = self.progress >= 0.98;
      }
    }
  });

  // 1) Cards stagger in with subtle 3D depth
  tl.to(cards,
    {
      opacity: 1, y: 0, scale: 1, rotateY: 0,
      stagger: 0.03, ease: 'power2.out',
      duration: 0.12
    },
    0
  );

  // 2) Stage numbers pop in
  const nums = cards.map(c => c.querySelector('.stage-num')).filter(Boolean);
  if (nums.length) {
    tl.to(nums,
      {
        opacity: 1, scale: 1, rotate: -3,
        stagger: 0.03, ease: 'back.out(1.6)',
        duration: 0.1
      },
      0.02
    );
  }

  // 3) Horizontal track movement
  tl.to(track,
    {
      x: () => isRTL ? maxScroll() : -maxScroll(),
      ease: 'none',
      duration: 0.88
    },
    0.12
  );

  // 4) Image parallax inside each card (simultaneous, creates depth)
  cards.forEach(card => {
    const img = card.querySelector('.stage-image img');
    if (img) {
      tl.fromTo(img,
        { y: '-10%', scale: 1.1 },
        { y: '10%', scale: 1.1, ease: 'none', duration: 0.88 },
        0.12
      );
    }
  });

  // Nav buttons: drive vertical scroll to matching timeline position
  if (prev && next) {
    const st = tl.scrollTrigger;
    prev.addEventListener('click', () => {
      if (!st) return;
      const target = Math.max(0, st.progress - (1 / cards.length));
      lenis?.scrollTo(st.start + (st.end - st.start) * target, { duration: 0.8 });
    });
    next.addEventListener('click', () => {
      if (!st) return;
      const target = Math.min(1, st.progress + (1 / cards.length));
      lenis?.scrollTo(st.start + (st.end - st.start) * target, { duration: 0.8 });
    });
  }
}

function initMiCarousels() {
  const mq = window.matchMedia('(max-width: 767px)');
  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  /** @type {Map<HTMLElement, import('swiper').Swiper>} */
  const instances = new Map();

  const countItems = (root) => {
    if (instances.has(root)) {
      return root.querySelectorAll('.mi-carousel-item').length;
    }
    return root.querySelectorAll(':scope > .mi-carousel-item').length;
  };

  const shouldMount = (root) => {
    const count = countItems(root);
    if (count < 2) return false;
    if (root.hasAttribute('data-mi-force')) return true;
    const whenOver = parseInt(root.getAttribute('data-mi-when-over') || '0', 10);
    if (whenOver > 0 && count > whenOver) return true;
    return mq.matches;
  };

  const mount = (root) => {
    if (instances.has(root) || root.classList.contains('swiper-initialized')) return;

    const items = [...root.querySelectorAll(':scope > .mi-carousel-item')];
    if (items.length < 2) return;

    const wrapper = document.createElement('div');
    wrapper.className = 'swiper-wrapper';
    items.forEach((item) => {
      const slide = document.createElement('div');
      slide.className = 'swiper-slide';
      slide.appendChild(item);
      wrapper.appendChild(slide);
    });

    const pagination = document.createElement('div');
    pagination.className = 'swiper-pagination mi-carousel-pagination';

    root.classList.add('swiper', 'mi-carousel-swiper', 'is-carousel');
    root.appendChild(wrapper);
    root.appendChild(pagination);

    const rawPer = parseFloat(root.getAttribute('data-mi-per') || '1') || 1;
    const per = mq.matches ? Math.min(1.15, rawPer) : Math.min(1.4, Math.max(1, rawPer));

    const swiper = new Swiper(root, {
      modules: [Pagination, A11y, Navigation],
      slidesPerView: per,
      spaceBetween: 14,
      centeredSlides: false,
      speed: reduced ? 0 : 420,
      grabCursor: true,
      watchOverflow: true,
      resistanceRatio: 0.65,
      nested: true,
      a11y: { enabled: true },
      pagination: {
        el: pagination,
        clickable: true,
        dynamicBullets: true,
      },
      on: {
        init() {
          root.classList.add('is-ready');
          items.forEach((item) => {
            item.style.opacity = '1';
            item.style.transform = 'none';
            item.style.filter = 'none';
            item.style.visibility = 'visible';
          });
        },
      },
    });

    instances.set(root, swiper);
  };

  const unmount = (root) => {
    const swiper = instances.get(root);
    if (!swiper) return;

    const items = [...root.querySelectorAll('.swiper-slide > .mi-carousel-item')];
    swiper.destroy(true, true);
    instances.delete(root);

    root.classList.remove('swiper', 'mi-carousel-swiper', 'is-carousel', 'is-ready', 'swiper-initialized', 'swiper-horizontal', 'swiper-backface-hidden');
    root.querySelectorAll('.swiper-wrapper, .mi-carousel-pagination, .swiper-pagination').forEach((n) => n.remove());
    items.forEach((item) => root.appendChild(item));
    root.querySelectorAll('.swiper-slide').forEach((n) => n.remove());
  };

  const sync = () => {
    document.querySelectorAll('[data-mi-carousel]').forEach((root) => {
      if (shouldMount(root)) mount(root);
      else unmount(root);
    });
  };

  sync();
  mq.addEventListener('change', sync);
}

function initProjectsSection() {
  const pills    = [...document.querySelectorAll('#projectFilters .filter-pill')];
  const tiles    = [...document.querySelectorAll('#projectsGrid .project-tile-clean')];
  const featured = document.querySelector('#projectsFeatured');
  const mobile   = document.getElementById('projectsMobile');
  const swiperEl = document.getElementById('projectsSwiper');
  const reduced  = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const mqMobile = window.matchMedia('(max-width: 767px)');

  if (!pills.length && !swiperEl) return;

  const filterDesktop = (cat) => {
    if (!tiles.length) return;
    const showTiles = tiles.filter(t => cat === 'all' || t.getAttribute('data-cat') === cat);
    const hideTiles = tiles.filter(t => !showTiles.includes(t));
    const showFeatured = !featured || cat === 'all' || featured.getAttribute('data-cat') === cat;

    if (reduced) {
      hideTiles.forEach(t => { t.style.display = 'none'; t.style.opacity = '0'; });
      showTiles.forEach(t => { t.style.display = ''; t.style.opacity = '1'; t.style.transform = ''; });
      if (featured) featured.style.display = showFeatured ? '' : 'none';
      return;
    }

    const tl = gsap.timeline({ defaults: { ease: 'power2.in' } });

    if (featured) {
      if (showFeatured) {
        if (featured.style.display === 'none') {
          featured.style.display = '';
          gsap.fromTo(featured, { opacity: 0, y: 24 }, { opacity: 1, y: 0, duration: 0.5, ease: 'power3.out' });
        }
      } else {
        tl.to(featured, { opacity: 0, y: -12, duration: 0.25, onComplete: () => { featured.style.display = 'none'; } }, 0);
      }
    }

    tl.to(hideTiles, {
      opacity: 0, scale: 0.94, y: 12, duration: 0.28, stagger: 0.03,
      onComplete() { hideTiles.forEach(t => { t.style.display = 'none'; }); }
    }, 0);

    tl.call(() => {
      showTiles.forEach(t => { t.style.display = ''; });
      gsap.fromTo(showTiles,
        { opacity: 0, scale: 0.96, y: 18, filter: 'blur(3px)' },
        { opacity: 1, scale: 1, y: 0, filter: 'blur(0px)', duration: 0.45, ease: 'power3.out', stagger: 0.06 }
      );
    }, null, 0.22);
  };

  const filterMobile = (cat) => {
    if (!projectsSwiper || !swiperEl) return;
    const slides = [...swiperEl.querySelectorAll('.swiper-slide')];
    slides.forEach((slide) => {
      const match = cat === 'all' || slide.getAttribute('data-cat') === cat;
      slide.style.display = match ? '' : 'none';
    });
    projectsSwiper.update();
    projectsSwiper.slideTo(0, reduced ? 0 : 420);
  };

  const applyFilter = (cat) => {
    if (mqMobile.matches) filterMobile(cat);
    else filterDesktop(cat);
  };

  const mountSwiper = () => {
    if (!swiperEl || !mobile || projectsSwiper) return;
    if (!swiperEl.querySelector('.swiper-slide')) return;

    projectsSwiper = new Swiper(swiperEl, {
      modules: [Navigation, Pagination, A11y],
      direction: 'horizontal',
      slidesPerView: 1.12,
      spaceBetween: 14,
      centeredSlides: true,
      speed: reduced ? 0 : 480,
      grabCursor: true,
      watchOverflow: true,
      resistanceRatio: 0.65,
      nested: true,
      a11y: { enabled: true },
      pagination: {
        el: swiperEl.querySelector('.projects-swiper-pagination'),
        clickable: true,
        dynamicBullets: true,
      },
      navigation: {
        prevEl: document.getElementById('projectsSwiperPrev'),
        nextEl: document.getElementById('projectsSwiperNext'),
      },
      on: {
        init(sw) {
          swiperEl.classList.add('is-ready');
          if (!reduced) {
            gsap.fromTo(sw.slides, {
              opacity: 0.55,
              y: 18,
              scale: 0.97,
            }, {
              opacity: 1,
              y: 0,
              scale: 1,
              duration: 0.55,
              stagger: 0.05,
              ease: 'power3.out',
              clearProps: 'opacity,transform',
            });
          }
        },
      },
    });

    // Re-apply active filter after mount
    const active = document.querySelector('#projectFilters .filter-pill.is-active');
    if (active) filterMobile(active.getAttribute('data-filter') || 'all');
  };

  const unmountSwiper = () => {
    if (projectsSwiper) {
      projectsSwiper.destroy(true, true);
      projectsSwiper = null;
    }
    if (swiperEl) swiperEl.classList.remove('is-ready');
  };

  const syncLayout = () => {
    if (mqMobile.matches) mountSwiper();
    else unmountSwiper();
  };

  syncLayout();
  mqMobile.addEventListener('change', syncLayout);

  pills.forEach((p) => p.addEventListener('click', () => {
    pills.forEach((b) => b.classList.remove('is-active'));
    p.classList.add('is-active');
    applyFilter(p.getAttribute('data-filter') || 'all');
  }));
}

function initHeader() {
  const header = document.querySelector('.site-header') || document.querySelector('header');
  if (!header) return;

  const cinematic = document.querySelector('[data-hero-cinematic]');

  const onScroll = () => {
    const scrolled = window.scrollY > 20;
    header.classList.toggle('is-scrolled', scrolled);
    if (cinematic) {
      header.classList.toggle('header--over-hero', !scrolled);
    }
  };
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  // Hash-section active tracking (homepage only)
  const navLinks = [...header.querySelectorAll('.header-nav a[href*="#"]')].filter((a) => {
    const href = a.getAttribute('href') || '';
    return href.includes('#') && !a.classList.contains('active');
  });
  const hashLinks = navLinks.filter((a) => {
    try {
      const u = new URL(a.href, window.location.origin);
      return u.pathname === window.location.pathname || u.pathname.endsWith('/' + (document.documentElement.lang || 'ar'));
    } catch (_) {
      return false;
    }
  });

  if (hashLinks.length) {
    const sections = hashLinks
      .map((a) => {
        const hash = (a.getAttribute('href') || '').split('#')[1];
        return hash ? document.getElementById(hash) : null;
      })
      .filter(Boolean);

    if (sections.length) {
      const io = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (!entry.isIntersecting) return;
          hashLinks.forEach((a) => a.classList.remove('active'));
          const link = hashLinks.find((a) => (a.getAttribute('href') || '').endsWith('#' + entry.target.id));
          link?.classList.add('active');
        });
      }, { rootMargin: '-20% 0px -70% 0px', threshold: 0 });

      sections.forEach((s) => io.observe(s));
    }
  }
}

function initProcessTimeline() {
  const root = document.querySelector('[data-process-timeline]');
  if (!root) return;
  const stages = [...root.querySelectorAll('[data-process-stage]')];
  if (!stages.length) return;

  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const isMobile = window.matchMedia('(max-width: 767px)').matches;

  if (reduced) {
    stages.forEach((s) => s.classList.add('is-active'));
    return;
  }

  stages.forEach((stage, i) => {
    gsap.fromTo(stage, { opacity: 0.45, y: isMobile ? 24 : 40 }, {
      opacity: 1,
      y: 0,
      duration: 0.55,
      ease: 'power2.out',
      scrollTrigger: {
        trigger: stage,
        start: 'top 80%',
        toggleClass: { targets: stage, className: 'is-active' },
        once: true,
      },
      delay: isMobile ? i * 0.04 : 0,
    });
  });
}

function initListingNav() {
  const scrollToGrid = () => {
    const grid = document.querySelector('[data-listing-grid]');
    if (!grid) return;
    const top = grid.getBoundingClientRect().top + window.scrollY - 88;
    if (window.lenis) window.lenis.scrollTo(top, { duration: 0.7 });
    else window.scrollTo({ top, behavior: 'smooth' });
  };

  const animateGridIn = () => {
    const items = document.querySelectorAll('.listing-grid-anim > *');
    if (!items.length || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
    gsap.fromTo(items, { opacity: 0, y: 16 }, {
      opacity: 1,
      y: 0,
      duration: 0.35,
      stagger: 0.06,
      ease: 'power2.out',
      clearProps: 'opacity,transform',
    });
  };

  document.addEventListener('livewire:navigated', () => {
    refreshLucideIcons();
    scrollToGrid();
    requestAnimationFrame(animateGridIn);
  });

  if (new URLSearchParams(window.location.search).has('page')) {
    requestAnimationFrame(() => {
      scrollToGrid();
      animateGridIn();
    });
  }
}

function initAboutPage() {
  // Only run on the about page
  if (!document.querySelector('.about-hero')) return;

  const prefersLess = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // --- Hero title: reveal lines (clip-path inset bottom → 0) ---
  const titleLines = document.querySelectorAll('.about-title-line');
  if (titleLines.length && !prefersLess) {
    gsap.to(titleLines, {
      clipPath: 'inset(0 0 0% 0)',
      duration: 1.1,
      stagger: 0.14,
      ease: 'expo.out',
      delay: 0.2,
    });
  } else {
    titleLines.forEach(l => (l.style.clipPath = 'none'));
  }

  // --- Hero bg parallax ---
  const heroBg = document.querySelector('.about-hero-img');
  if (heroBg && !prefersLess) {
    gsap.to(heroBg, {
      yPercent: 18,
      ease: 'none',
      scrollTrigger: { trigger: '.about-hero', start: 'top top', end: 'bottom top', scrub: true },
    });
  }

  // --- Stats bar: counter is handled by global initCounters() ---

  // --- Timeline milestones: stagger entrance ---
  const milestones = document.querySelectorAll('.about-milestone');
  if (milestones.length) {
    milestones.forEach((card, i) => {
      if (prefersLess) {
        card.style.opacity = 1;
        card.style.transform = 'none';
        return;
      }
      gsap.to(card, {
        opacity: 1,
        y: 0,
        duration: 0.75,
        ease: 'power3.out',
        delay: 0,
        scrollTrigger: {
          trigger: card,
          start: 'top 85%',
          toggleActions: 'play none none none',
        },
      });

      // Dot scale-in with slight bounce
      const dot = card.querySelector('.about-milestone-dot');
      if (dot) {
        gsap.fromTo(dot,
          { scale: 0, opacity: 0 },
          {
            scale: 1, opacity: 1, duration: 0.55,
            ease: 'back.out(2)',
            scrollTrigger: { trigger: card, start: 'top 85%', toggleActions: 'play none none none' },
          }
        );
      }
    });
  }

  // --- VMG, values, certs: handled by global [data-stagger] in initReveals ---

  // --- Catalog badge slow rotation ---
  const badge = document.querySelector('.about-catalog-badge');
  if (badge && !prefersLess) {
    gsap.to(badge, {
      rotation: 360,
      duration: 20,
      ease: 'none',
      repeat: -1,
    });
  }
}

function initSmoothAnchors() {
  document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
      const target = document.querySelector(a.getAttribute('href'));
      if (target) { e.preventDefault(); lenis?.scrollTo(target, { offset: -76, duration: 1.4 }); }
    });
  });
}

function initSideRailShare() {
  document.querySelectorAll('[data-mi-share]').forEach((btn) => {
    btn.addEventListener('click', async () => {
      const url = btn.getAttribute('data-share-url') || window.location.href;
      const title = btn.getAttribute('data-share-title') || document.title;
      const fallback = btn.getAttribute('data-share-fallback');
      try {
        if (navigator.share) {
          await navigator.share({ title, url });
          return;
        }
      } catch (e) {
        if (e && e.name === 'AbortError') return;
      }
      try {
        await navigator.clipboard.writeText(url);
        btn.classList.add('is-copied');
        window.setTimeout(() => btn.classList.remove('is-copied'), 1600);
      } catch (_) {
        if (fallback) window.open(fallback, '_blank', 'noopener,noreferrer');
      }
    });
  });
}

function initProjectPage() {
  if (!document.querySelector('.proj-hero')) return;

  const reduced  = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const isMobile = window.innerWidth < 768;

  // Title lines — cinematic clip reveal
  const lines = document.querySelectorAll('.proj-hero-title .title-line');
  if (lines.length && !reduced) {
    gsap.to(lines, {
      clipPath: 'inset(0% 0 0% 0)',
      duration: 1.1, stagger: 0.16,
      ease: 'expo.out', delay: 0.2,
    });
  } else {
    lines.forEach(l => { l.style.clipPath = 'none'; });
  }

  // Fade elements (category badge, meta row)
  const fades = document.querySelectorAll('[data-proj-fade]');
  if (!reduced) {
    gsap.from(fades, {
      opacity: 0, y: 28, filter: 'blur(4px)',
      duration: 0.85, stagger: 0.13, delay: 0.4, ease: 'power3.out',
    });
  } else {
    fades.forEach(el => { el.style.opacity = 1; el.style.transform = 'none'; });
  }

  // Hero background parallax
  const heroBg = document.querySelector('[data-proj-parallax]');
  if (heroBg && !reduced && !isMobile) {
    gsap.fromTo(heroBg,
      { yPercent: -8 },
      {
        yPercent: 8, ease: 'none',
        scrollTrigger: { trigger: '.proj-hero', start: 'top top', end: 'bottom top', scrub: 1.2 },
      }
    );
  }

  // Stats count-up is handled by global initCounters()

  // Project phases stagger entrance
  const phaseCards = document.querySelectorAll('.proj-phase-card');
  if (phaseCards.length && !reduced) {
    gsap.utils.toArray('.proj-phase-card').forEach((card, i) => {
      gsap.fromTo(card,
        { opacity: 0, y: 40, scale: 0.97 },
        {
          opacity: 1, y: 0, scale: 1,
          duration: 0.8, ease: 'power3.out', delay: i * 0.08,
          scrollTrigger: { trigger: card, start: 'top 88%', once: true }
        }
      );
    });
  }
}

function initCertModal() {
  const modal = document.getElementById('certModal');
  if (!modal) return;

  const img = document.getElementById('certModalImg');
  const placeholder = document.getElementById('certModalPlaceholder');
  const nameEl = document.getElementById('certModalName');
  const issuerEl = document.getElementById('certModalIssuer');
  const counterEl = document.getElementById('certModalCounter');
  const closeBtn = document.getElementById('certModalClose');
  const prevBtn = document.getElementById('certModalPrev');
  const nextBtn = document.getElementById('certModalNext');
  const cards = [...document.querySelectorAll('[data-cert-card]')];
  if (!cards.length) return;

  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  let isOpen = false;
  let currentIdx = 0;
  let currentTl = null;

  const setBodyScroll = (lock) => {
    document.body.style.overflow = lock ? 'hidden' : '';
  };

  const updateArrows = () => {
    if (prevBtn) prevBtn.disabled = currentIdx <= 0;
    if (nextBtn) nextBtn.disabled = currentIdx >= cards.length - 1;
  };

  const loadContent = (idx) => {
    const card = cards[idx];
    const imgUrl = card.getAttribute('data-cert-img');
    const name = card.getAttribute('data-cert-name');
    const issuer = card.getAttribute('data-cert-issuer');

    if (imgUrl) {
      img.src = imgUrl;
      img.style.display = 'block';
      placeholder.style.display = 'none';
    } else {
      img.style.display = 'none';
      img.src = '';
      placeholder.style.display = 'grid';
    }
    nameEl.textContent = name;
    issuerEl.textContent = issuer;
    if (counterEl) counterEl.textContent = (idx + 1) + ' / ' + cards.length;
    updateArrows();
  };

  const open = (idx) => {
    if (isOpen) {
      // Already open: just navigate with cinematic transition
      if (idx === currentIdx) return;
      currentIdx = idx;
      if (reduced) {
        loadContent(idx);
        return;
      }
      const tl = gsap.timeline({ defaults: { ease: 'power2.inOut' } });
      tl.to([img, placeholder], { opacity: 0, scale: 0.96, duration: 0.2 })
        .to('.cert-modal-info', { opacity: 0, y: 12, duration: 0.18 }, 0)
        .call(() => loadContent(idx))
        .fromTo(img.style.display !== 'none' ? img : placeholder,
          { opacity: 0, scale: 0.96 },
          { opacity: 1, scale: 1, duration: 0.35, ease: 'power3.out' }
        )
        .fromTo('.cert-modal-info',
          { opacity: 0, y: 12 },
          { opacity: 1, y: 0, duration: 0.3, ease: 'power3.out' },
          '-=0.2'
        );
      return;
    }

    isOpen = true;
    currentIdx = idx;
    setBodyScroll(true);
    modal.setAttribute('aria-hidden', 'false');
    loadContent(idx);

    if (reduced) {
      gsap.set(modal, { display: 'flex', opacity: 1 });
      gsap.set('.cert-modal-container', { opacity: 1, scale: 1, y: 0, filter: 'blur(0px)' });
      gsap.set(img.style.display !== 'none' ? img : placeholder, { opacity: 1, scale: 1 });
      gsap.set('.cert-modal-info', { opacity: 1, y: 0 });
      gsap.set([closeBtn, prevBtn, nextBtn], { opacity: 1, scale: 1, rotate: 0 });
      return;
    }

    currentTl = gsap.timeline({ defaults: { ease: 'power3.out' } });

    currentTl
      .set(modal, { display: 'flex' })
      .fromTo(modal, { opacity: 0 }, { opacity: 1, duration: 0.45 })
      .fromTo('.cert-modal-container',
        { opacity: 0, scale: 0.9, y: 50, filter: 'blur(10px)' },
        { opacity: 1, scale: 1, y: 0, filter: 'blur(0px)', duration: 0.75 }, 0.06)
      .fromTo(img.style.display !== 'none' ? img : placeholder,
        { opacity: 0, scale: 0.94 },
        { opacity: 1, scale: 1, duration: 0.65, ease: 'power4.out' }, 0.16)
      .fromTo('.cert-modal-info',
        { opacity: 0, y: 24 },
        { opacity: 1, y: 0, duration: 0.5 }, 0.24)
      .fromTo(closeBtn,
        { opacity: 0, scale: 0.7, rotate: -90 },
        { opacity: 1, scale: 1, rotate: 0, duration: 0.45, ease: 'back.out(1.7)' }, 0.28)
      .fromTo([prevBtn, nextBtn],
        { opacity: 0, x: (i) => i === 0 ? 30 : -30 },
        { opacity: 1, x: 0, duration: 0.5, ease: 'power3.out' }, 0.2);
  };

  const close = () => {
    if (!isOpen) return;
    if (currentTl) currentTl.kill();

    const closeTl = gsap.timeline({
      defaults: { ease: 'power2.in' },
      onComplete: () => {
        isOpen = false;
        currentIdx = 0;
        setBodyScroll(false);
        modal.setAttribute('aria-hidden', 'true');
        gsap.set(modal, { display: 'none' });
        img.src = '';
        currentTl = null;
      }
    });

    if (reduced) {
      closeTl.set(modal, { display: 'none', opacity: 0 });
      return;
    }

    closeTl
      .to('.cert-modal-info', { opacity: 0, y: 16, duration: 0.22 }, 0)
      .to([prevBtn, nextBtn], { opacity: 0, duration: 0.2 }, 0)
      .to(img.style.display !== 'none' ? img : placeholder, { opacity: 0, scale: 0.96, duration: 0.25 }, 0)
      .to('.cert-modal-container', { opacity: 0, scale: 0.92, y: 40, filter: 'blur(8px)', duration: 0.35 }, 0.05)
      .to(closeBtn, { opacity: 0, scale: 0.8, rotate: 45, duration: 0.25 }, 0.05)
      .to(modal, { opacity: 0, duration: 0.3 }, 0.15);
  };

  const goPrev = () => { if (currentIdx > 0) open(currentIdx - 1); };
  const goNext = () => { if (currentIdx < cards.length - 1) open(currentIdx + 1); };

  cards.forEach((card, i) => {
    card.addEventListener('click', () => open(i));
    card.addEventListener('keydown', (e) => { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); open(i); } });
  });

  closeBtn.addEventListener('click', close);
  if (prevBtn) prevBtn.addEventListener('click', (e) => { e.stopPropagation(); goPrev(); });
  if (nextBtn) nextBtn.addEventListener('click', (e) => { e.stopPropagation(); goNext(); });
  modal.addEventListener('click', (e) => { if (e.target === modal) close(); });
  document.addEventListener('keydown', (e) => {
    if (!isOpen) return;
    if (e.key === 'Escape') close();
    if (e.key === 'ArrowLeft') goNext(); // RTL: left arrow = next
    if (e.key === 'ArrowRight') goPrev(); // RTL: right arrow = prev
  });
}

function initCertHoverPreview() {
  const cards = document.querySelectorAll('[data-cert-card]');
  if (!cards.length) return;

  const isMobile = window.innerWidth < 768;
  if (isMobile) return;

  cards.forEach(card => {
    const preview = card.querySelector('.cert-hover-preview');
    if (!preview) return;

    const enter = () => {
      gsap.killTweensOf(preview);
      gsap.fromTo(preview,
        { opacity: 0, y: 12, scale: 0.96, pointerEvents: 'none' },
        { opacity: 1, y: 0, scale: 1, duration: 0.35, ease: 'power3.out', pointerEvents: 'none' }
      );
    };
    const leave = () => {
      gsap.killTweensOf(preview);
      gsap.to(preview, { opacity: 0, y: 8, scale: 0.98, duration: 0.25, ease: 'power2.in' });
    };

    card.addEventListener('mouseenter', enter);
    card.addEventListener('mouseleave', leave);
    card.addEventListener('focus', enter);
    card.addEventListener('blur', leave);
  });
}

/* ------------------------------------------------------------------
   CHAIRMAN QUOTE — ink typewriter (RTL-safe)
   ------------------------------------------------------------------ */
function initChairmanTypewriter() {
  const el = document.querySelector('[data-chairman-typewriter]');
  if (!el) return;

  const typed = el.querySelector('.chairman-quote-typed');
  const signature = document.querySelector('[data-chairman-signature]');
  const full = el.getAttribute('data-quote') || '';
  if (!typed || !full) {
    el.classList.add('is-static');
    signature?.classList.add('is-visible');
    return;
  }

  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduced) {
    el.classList.add('is-static', 'is-ready', 'is-done');
    typed.textContent = full;
    signature?.classList.add('is-visible');
    return;
  }

  const fallback = el.querySelector('.chairman-quote-fallback');
  if (fallback) fallback.setAttribute('aria-hidden', 'true');

  let started = false;

  const finish = () => {
    el.classList.remove('is-typing');
    el.classList.add('is-done');
    signature?.classList.add('is-visible');
  };

  const start = () => {
    if (started) return;
    started = true;
    el.classList.add('is-ready', 'is-typing');

    const chars = Array.from(full);
    let i = 0;

    const tick = () => {
      if (i >= chars.length) {
        finish();
        return;
      }

      const ch = chars[i++];
      const span = document.createElement('span');
      span.className = 'tw-char';
      span.textContent = ch;
      typed.appendChild(span);

      let delay = 20 + Math.random() * 26;
      if ('،.!?…—-:؛'.includes(ch)) delay += 160 + Math.random() * 140;
      else if (ch === ' ') delay += 35 + Math.random() * 25;

      setTimeout(tick, delay);
    };

    setTimeout(tick, 380);
  };

  const io = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          start();
          io.disconnect();
        }
      });
    },
    { threshold: 0.32, rootMargin: '0px 0px -8% 0px' }
  );

  io.observe(el);
}

function initServicesCinema() {
  const root = document.querySelector('[data-svc-cinema]');
  if (!root) return;

  const videos = [...root.querySelectorAll('[data-svc-video]')];
  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  const tryPlayVideos = () => {
    if (reduced) return;
    videos.forEach((video) => {
      video.muted = true;
      video.playsInline = true;
      const cell = video.closest('[data-svc-cell]');
      const play = () => {
        const p = video.play();
        if (p && typeof p.then === 'function') {
          p.then(() => cell?.classList.add('is-live')).catch(() => {});
        } else {
          cell?.classList.add('is-live');
        }
      };
      if (video.readyState >= 2) play();
      else video.addEventListener('loadeddata', play, { once: true });
    });
  };

  const io = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        tryPlayVideos();
        videos.forEach((v) => { try { if (!reduced) v.play(); } catch (_) {} });
      } else {
        videos.forEach((v) => { try { v.pause(); } catch (_) {} });
      }
    });
  }, { threshold: 0.2 });
  io.observe(root);

  if (window.gsap && window.ScrollTrigger) {
    const reveal = root.querySelectorAll('[data-svc-reveal]');
    gsap.set(reveal, { y: 36, opacity: 0 });
    ScrollTrigger.create({
      trigger: root,
      start: 'top 72%',
      once: true,
      onEnter: () => {
        gsap.to(reveal, {
          y: 0,
          opacity: 1,
          duration: 0.85,
          ease: 'power3.out',
          stagger: 0.1,
        });
      },
    });
  }
}

function initServiceCalcLinks() {
  document.querySelectorAll('[data-svc-calc]').forEach((link) => {
    link.addEventListener('click', (e) => {
      const type = link.getAttribute('data-svc-calc');
      if (!type) return;
      const target = document.querySelector('#start');
      if (!target) {
        try { sessionStorage.setItem('mi:barn-type', type); } catch (_) {}
        return; // allow navigation to homepage#start
      }

      e.preventDefault();
      const data = target._x_dataStack && target._x_dataStack[0];
      if (data && typeof data.pickType === 'function') {
        data.pickType(type);
      } else {
        try { sessionStorage.setItem('mi:barn-type', type); } catch (_) {}
        window.location.hash = 'start';
        window.dispatchEvent(new CustomEvent('mi:pick-barn', { detail: { type } }));
      }
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  });

  window.addEventListener('mi:pick-barn', (e) => {
    const type = e.detail?.type;
    const target = document.querySelector('#start');
    const data = target?._x_dataStack?.[0];
    if (type && data && typeof data.pickType === 'function') {
      data.pickType(type);
    }
  });

  // Resume barn type after landing from a service page
  try {
    const pending = sessionStorage.getItem('mi:barn-type');
    if (pending && document.querySelector('#start')) {
      sessionStorage.removeItem('mi:barn-type');
      setTimeout(() => {
        window.dispatchEvent(new CustomEvent('mi:pick-barn', { detail: { type: pending } }));
      }, 600);
    }
  } catch (_) {}
}

function initSpaTransitions() {
  // Prefer native cross-document View Transitions (CSS @view-transition).
  // Fallback: soft fade-out before hard navigation.
  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduced) return;
  if (CSS.supports && CSS.supports('view-transition-name', 'none')) return;

  document.addEventListener('click', (e) => {
    const a = e.target.closest('a[href]');
    if (!a) return;
    if (a.target && a.target !== '_self') return;
    if (a.hasAttribute('download')) return;
    if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;

    let url;
    try { url = new URL(a.href, window.location.origin); } catch (_) { return; }
    if (url.origin !== window.location.origin) return;
    if (url.pathname === window.location.pathname && url.search === window.location.search) return;

    e.preventDefault();
    const main = document.getElementById('app-main') || document.querySelector('main');
    if (main) main.classList.add('is-page-leaving');
    setTimeout(() => { window.location.href = url.href; }, 200);
  });
}
