(() => {
  const app = document.querySelector('[data-carte-app]');
  const tabs = document.querySelector('[data-carte-tabs]');
  const panel = document.querySelector('[data-carte-panel]');
  const intro = document.querySelector('[data-carte-intro]');
  const formula = document.querySelector('[data-carte-formula]');

  if (!app || !tabs || !panel || !intro || !formula) return;

  const makeElement = (tag, className, text) => {
    const element = document.createElement(tag);
    if (className) element.className = className;
    if (text) element.textContent = text;
    return element;
  };

  const renderIntro = data => {
    intro.replaceChildren(makeElement('h1', 'carte-intro__title', data.title));
  };

  const renderFormula = data => {
    const heading = document.createElement('div');
    heading.className = 'carte-formula__heading';
    const title = makeElement('h2', '', data.title);
    title.id = 'carte-formula-title';
    heading.append(title);
    const prices = document.createElement('div');
    prices.className = 'carte-formula__prices';
    data.prices.forEach(({ price, label }) => {
      const item = document.createElement('p');
      item.append(makeElement('strong', '', price), document.createTextNode(` ${label}`));
      prices.append(item);
    });
    formula.replaceChildren(heading, prices);
  };

  const resolveItems = category => {
    if (category.source === 'homepagePizzas') {
      return (window.laKermesseMenu?.pizzas || []).map(({ name, ingredients, image }) => ({ name, description: ingredients, image, active: true, type: 'pizza' }));
    }
    return (category.items || []).filter(item => item.active !== false);
  };

  const renderCategory = category => {
    const items = resolveItems(category);
    const title = makeElement('h2', 'sr-only', category.label);
    title.id = 'carte-panel-title';

    if (!items.length) {
      const empty = document.createElement('div');
      empty.className = 'carte-empty';
      empty.append(makeElement('p', 'eyebrow', category.label), makeElement('p', 'carte-empty__title', category.emptyState || 'Sélection à venir'), makeElement('p', 'carte-empty__copy', 'La sélection sera bientôt disponible.'));
      panel.replaceChildren(title, empty);
      return;
    }

    const grid = document.createElement('div');
    grid.className = 'carte-grid';
    grid.dataset.count = String(items.length);
    items.forEach(({ name, description, image, type, imageScale = 1 }) => {
      const card = document.createElement('article');
      card.className = `carte-card${type === 'pizza' ? ' carte-card--pizza' : ''}`;
      const visual = makeElement('div', 'carte-card__visual');
      const food = document.createElement('img');
      food.src = image;
      food.alt = name;
      food.loading = 'lazy';
      food.style.setProperty('--card-image-scale', imageScale);
      visual.append(food);
      const copy = makeElement('div', 'carte-card__copy');
      copy.append(makeElement('h3', '', name), makeElement('p', '', description));
      card.append(visual, copy);
      grid.append(card);
    });
    panel.replaceChildren(title, grid);
  };

  const selectCategory = (category, button, animate = true) => {
    panel.setAttribute('aria-labelledby', button.id);
    tabs.querySelectorAll('[role="tab"]').forEach(tab => {
      const active = tab === button;
      tab.setAttribute('aria-selected', String(active));
      tab.tabIndex = active ? 0 : -1;
      tab.classList.toggle('is-active', active);
    });

    const render = () => {
      renderCategory(category);
      requestAnimationFrame(() => panel.classList.remove('is-switching'));
    };
    if (!animate || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return render();
    panel.classList.add('is-switching');
    window.setTimeout(render, 180);
  };

  const renderTabs = categories => {
    tabs.replaceChildren();
    categories.forEach((category, index) => {
      const button = makeElement('button', 'carte-tab', category.label);
      button.type = 'button';
      button.id = `carte-tab-${category.id}`;
      button.setAttribute('role', 'tab');
      button.setAttribute('aria-controls', 'carte-panel');
      button.setAttribute('aria-selected', String(index === 0));
      button.tabIndex = index === 0 ? 0 : -1;
      button.classList.toggle('is-active', index === 0);
      button.addEventListener('click', () => selectCategory(category, button));
      button.addEventListener('keydown', event => {
        if (!['ArrowRight', 'ArrowLeft', 'Home', 'End'].includes(event.key)) return;
        event.preventDefault();
        const buttons = [...tabs.querySelectorAll('[role="tab"]')];
        const current = buttons.indexOf(button);
        const next = event.key === 'Home' ? 0 : event.key === 'End' ? buttons.length - 1 : (current + (event.key === 'ArrowRight' ? 1 : -1) + buttons.length) % buttons.length;
        buttons[next].focus();
        buttons[next].click();
      });
      tabs.append(button);
    });
    selectCategory(categories[0], tabs.querySelector('[role="tab"]'), false);
  };

  fetch('assets/data/carte.json')
    .then(response => {
      if (!response.ok) throw new Error('Impossible de charger la carte.');
      return response.json();
    })
    .then(data => {
      renderIntro(data.intro);
      renderFormula(data.formula);
      renderTabs(data.categories);
      app.removeAttribute('aria-busy');
    })
    .catch(() => {
      app.removeAttribute('aria-busy');
      panel.replaceChildren(makeElement('p', 'carte-load-error', 'La carte est momentanément indisponible. Merci de réessayer dans un instant.'));
    });
})();
