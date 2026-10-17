/* ============================================
   La Kermesse — Shared site behaviors
   Mobile menu + header scroll.
   Loaded on every page.
   ============================================ */

(() => {
  const header = document.querySelector('[data-header]');
  const menuButton = document.querySelector('.menu-toggle');
  const nav = document.querySelector('.site-nav');

  // ---------- Mobile menu ----------
  if (menuButton && nav) {
    menuButton.addEventListener('click', () => {
      const open = menuButton.getAttribute('aria-expanded') === 'true';
      menuButton.setAttribute('aria-expanded', String(!open));
      nav.classList.toggle('is-open', !open);
      document.body.classList.toggle('menu-open', !open);
    });

    nav.querySelectorAll('a').forEach(link => link.addEventListener('click', () => {
      menuButton.setAttribute('aria-expanded', 'false');
      nav.classList.remove('is-open');
      document.body.classList.remove('menu-open');
    }));
  }

  // ---------- Header: transparent → black on scroll ----------
  if (header) {
    const THRESHOLD = 40;
    let isScrolled = false;
    let ticking = false;

    const updateHeader = () => {
      const shouldScroll = window.scrollY > THRESHOLD;
      if (shouldScroll !== isScrolled) {
        isScrolled = shouldScroll;
        header.classList.toggle('is-scrolled', isScrolled);
      }
      ticking = false;
    };

    const onScroll = () => {
      if (!ticking) {
        window.requestAnimationFrame(updateHeader);
        ticking = true;
      }
    };

    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onScroll, { passive: true });
    updateHeader();
  }
})();