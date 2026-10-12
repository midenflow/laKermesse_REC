(() => {
  const header = document.querySelector('[data-header]');
  const menuButton = document.querySelector('.menu-toggle');
  const nav = document.querySelector('.site-nav');

  if (menuButton && nav) {
    menuButton.addEventListener('click', () => {
      const open = menuButton.getAttribute('aria-expanded') === 'true';
      menuButton.setAttribute('aria-expanded', String(!open));
      nav.classList.toggle('is-open', !open);
      document.body.classList.toggle('menu-open', !open);
    });
    nav.querySelectorAll('a').forEach(link => link.addEventListener('click', () => {
      menuButton.setAttribute('aria-expanded', 'false'); nav.classList.remove('is-open'); document.body.classList.remove('menu-open');
    }));
  }

  const updateHeader = () => header?.classList.toggle('is-scrolled', window.scrollY > 24);
  updateHeader(); window.addEventListener('scroll', updateHeader, { passive: true });

  const revealItems = document.querySelectorAll('.reveal');
  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver(entries => entries.forEach(entry => {
      if (entry.isIntersecting) { entry.target.classList.add('is-visible'); observer.unobserve(entry.target); }
    }), { threshold: 0.12 });
    revealItems.forEach(item => observer.observe(item));
  } else revealItems.forEach(item => item.classList.add('is-visible'));

  const story = document.querySelector('[data-story]');
  const storyLines = [...(story?.querySelectorAll('.story__line') || [])];
  const storyReducedMotion = window.matchMedia?.('(prefers-reduced-motion: reduce)');

  if (story && storyLines.length && storyReducedMotion) {
    const ghostOpacity = .15;
    const revealWindow = .06;
    const damping = .14;
    const storyCharacters = [];
    let storyFrame;
    let targetStoryProgress = 0;
    let renderedStoryProgress = 0;
    let storyStart = 0;
    let storyScrollDistance = 1;

    storyLines.forEach(line => {
      const text = line.textContent;
      line.textContent = '';

      [...text].forEach(character => {
        const span = document.createElement('span');
        span.className = 'story__char';
        span.textContent = character;
        line.append(span);
        storyCharacters.push(span);
      });
    });

    const clampStoryProgress = value => Math.min(1, Math.max(0, value));
    const smoothstep = value => value * value * (3 - (2 * value));
    const recalculateStoryGeometry = () => {
      const bounds = story.getBoundingClientRect();
      storyStart = bounds.top + window.scrollY;
      storyScrollDistance = Math.max(1, story.offsetHeight - window.innerHeight);
    };
    const updateStoryTarget = () => {
      if (storyReducedMotion.matches) {
        targetStoryProgress = 1;
        return;
      }

      const rawProgress = clampStoryProgress((window.scrollY - storyStart) / storyScrollDistance);
      targetStoryProgress = clampStoryProgress((rawProgress - .06) / .86);
    };
    const renderStory = () => {
      storyFrame = undefined;
      renderedStoryProgress += (targetStoryProgress - renderedStoryProgress) * damping;
      if (Math.abs(targetStoryProgress - renderedStoryProgress) < .001) {
        renderedStoryProgress = targetStoryProgress;
      }

      const characterCount = Math.max(1, storyCharacters.length - 1);
      storyCharacters.forEach((character, index) => {
        const start = (index / characterCount) * (1 - revealWindow);
        const localProgress = clampStoryProgress((renderedStoryProgress - start) / revealWindow);
        const opacity = ghostOpacity + ((1 - ghostOpacity) * smoothstep(localProgress));
        character.style.opacity = opacity.toFixed(3);
      });

      if (Math.abs(targetStoryProgress - renderedStoryProgress) >= .001) {
        storyFrame = window.requestAnimationFrame(renderStory);
      }
    };
    const queueStoryRender = () => {
      if (!storyFrame) storyFrame = window.requestAnimationFrame(renderStory);
    };
    const handleStoryScroll = () => {
      updateStoryTarget();
      queueStoryRender();
    };
    const handleStoryResize = () => {
      recalculateStoryGeometry();
      updateStoryTarget();
      queueStoryRender();
    };

    window.addEventListener('scroll', handleStoryScroll, { passive: true });
    window.addEventListener('resize', handleStoryResize, { passive: true });
    storyReducedMotion.addEventListener?.('change', handleStoryResize);
    window.addEventListener('load', handleStoryResize, { once: true });
    document.fonts?.ready.then(handleStoryResize);
    handleStoryResize();
  }

  const menuData = window.laKermesseMenu;
  const pizzaTarget = document.querySelector('[data-pizza-list]');
  const createPriceBadge = price => {
    const badge = document.createElement('span');
    const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
    const priceText = document.createElement('span');
    const addPath = (className, d) => {
      const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
      path.setAttribute('class', className);
      path.setAttribute('d', d);
      svg.append(path);
    };
    badge.className = 'pizza-card__price-badge';
    badge.setAttribute('aria-label', `Prix : ${price}`);
    svg.classList.add('pizza-card__price-mark');
    svg.setAttribute('viewBox', '0 0 100 112');
    svg.setAttribute('aria-hidden', 'true');
    svg.setAttribute('focusable', 'false');
    addPath('pizza-card__ribbon', 'M30 75 27 104 43 94 53 107 58 77');
    addPath('pizza-card__ribbon', 'M70 75 73 104 57 94 47 107 42 77');
    addPath('pizza-card__seal', 'M50 7 C63 5 70 11 79 17 C87 25 94 36 92 49 C95 62 88 72 80 80 C70 88 62 93 50 91 C38 93 29 88 20 80 C12 72 5 62 8 49 C6 36 13 25 21 17 C30 11 37 5 50 7 Z');
    addPath('pizza-card__seal-line', 'M50 14 C61 12 68 17 75 22 C83 29 87 38 85 49 C88 59 82 68 75 75 C67 82 59 85 50 84 C41 85 33 82 25 75 C18 68 12 59 15 49 C13 38 17 29 25 22 C32 17 39 12 50 14 Z');
    priceText.className = 'pizza-card__price-text';
    priceText.textContent = price;
    badge.append(svg, priceText);
    return badge;
  };
  if (menuData && pizzaTarget) {
    menuData.pizzas.forEach(({ name, price, ingredients, image }) => {
      const item = document.createElement('article');
      const title = document.createElement('h4');
      const detail = document.createElement('p');
      const disc = document.createElement('div');
      const pizzaImage = document.createElement('img');
      const copy = document.createElement('div');
      const priceBadge = createPriceBadge(price);
      item.className = 'pizza-card'; disc.className = 'pizza-card__disc'; pizzaImage.className = 'pizza-card__image'; copy.className = 'pizza-card__copy'; title.className = 'pizza-card__name'; detail.className = 'pizza-card__ingredients';
      pizzaImage.src = image; pizzaImage.alt = `Pizza ${name}`; pizzaImage.loading = 'lazy';
      title.textContent = name; detail.textContent = ingredients;
      disc.append(pizzaImage, priceBadge); copy.append(title, detail); item.append(disc, copy);
      pizzaTarget.append(item);
    });
  }

  const pizzaShowcase = document.querySelector('[data-pizza-showcase]');
  const pizzaViewport = document.querySelector('[data-pizza-viewport]');
  const pizzaTrack = document.querySelector('[data-pizza-list]');
  const reducedMotion = window.matchMedia?.('(prefers-reduced-motion: reduce)');

  if (pizzaShowcase && pizzaViewport && pizzaTrack && reducedMotion) {
    const palette = [
      { position: 0, background: '#000000', foreground: '#f4efe4' },
      { position: .08, background: '#0d3442', foreground: '#f4efe4' },
      { position: .22, background: '#329fc0', foreground: '#06171f' },
      { position: .35, background: '#e7776f', foreground: '#06171f' },
      { position: .48, background: '#d6aa3c', foreground: '#06171f' },
      { position: .61, background: '#e97aac', foreground: '#06171f' },
      { position: .74, background: '#66b98d', foreground: '#06171f' },
      { position: .90, background: '#ee9a72', foreground: '#06171f' },
      { position: 1, background: '#000000', foreground: '#f4efe4' }
    ];
    let geometry = { overflow: 0, startOffset: 0 };
    let framePending = false;
    let resizeFrame;

    const clamp = value => Math.min(1, Math.max(0, value));
    const hexToRgb = hex => [1, 3, 5].map(position => parseInt(hex.slice(position, position + 2), 16));
    const mixColor = (from, to, amount) => {
      const start = hexToRgb(from);
      const end = hexToRgb(to);
      return `rgb(${start.map((value, index) => Math.round(value + (end[index] - value) * amount)).join(', ')})`;
    };
    const setPalette = progress => {
      const nextIndex = Math.min(palette.length - 1, palette.findIndex(stop => stop.position >= progress));
      const index = Math.max(0, nextIndex - 1);
      const current = palette[index];
      const next = palette[nextIndex];
      const amount = current === next ? 0 : (progress - current.position) / (next.position - current.position);
      pizzaShowcase.style.setProperty('--pizza-background', mixColor(current.background, next.background, amount));
      pizzaShowcase.style.setProperty('--pizza-foreground', mixColor(current.foreground, next.foreground, amount));
    };
    const renderProgress = () => {
      framePending = false;
      if (!geometry.overflow) return;
      const progress = clamp((geometry.startOffset - pizzaShowcase.getBoundingClientRect().top) / geometry.overflow);
      const translate = -geometry.overflow * progress;
      pizzaTrack.style.transform = `translate3d(${translate}px, 0, 0)`;
      pizzaTrack.querySelectorAll('.pizza-card__image').forEach((image, index) => {
        const direction = index % 2 === 0 ? 1 : -1;
        image.style.transform = `rotate(${progress * 300 * direction}deg)`;
      });
      setPalette(progress);
    };
    const requestRender = () => {
      if (!framePending) {
        framePending = true;
        window.requestAnimationFrame(renderProgress);
      }
    };
    const resetStaticState = () => {
      pizzaShowcase.classList.remove('is-enhanced');
      pizzaShowcase.style.removeProperty('height');
      pizzaShowcase.style.removeProperty('--pizza-background');
      pizzaShowcase.style.removeProperty('--pizza-foreground');
      pizzaTrack.style.removeProperty('transform');
      pizzaTrack.querySelectorAll('.pizza-card__image').forEach(image => image.style.removeProperty('transform'));
      geometry = { overflow: 0, startOffset: 0 };
    };
    const recalculate = () => {
      if (reducedMotion.matches) {
        resetStaticState();
        return;
      }
      pizzaShowcase.classList.add('is-enhanced');
      const stickyScene = pizzaShowcase.querySelector('.pizza-showcase__sticky');
      const headerHeight = header?.getBoundingClientRect().height || 0;
      pizzaShowcase.style.setProperty('--pizza-sticky-offset', `${Math.ceil(headerHeight)}px`);
      const overflow = Math.max(0, pizzaTrack.scrollWidth - pizzaViewport.clientWidth);
      const stickyHeight = stickyScene.getBoundingClientRect().height;
      geometry = { overflow, startOffset: headerHeight };
      pizzaShowcase.style.height = `${Math.ceil(stickyHeight + overflow)}px`;
      requestRender();
    };
    const queueRecalculate = () => {
      window.cancelAnimationFrame(resizeFrame);
      resizeFrame = window.requestAnimationFrame(recalculate);
    };

    window.addEventListener('scroll', requestRender, { passive: true });
    window.addEventListener('resize', queueRecalculate, { passive: true });
    window.addEventListener('load', queueRecalculate, { once: true });
    reducedMotion.addEventListener?.('change', queueRecalculate);
    recalculate();
  }

})();
