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

  const renderDrinkList = items => {
    const list = document.createElement('ul');
    list.className = 'drinks-list';
    items.forEach(item => {
      const entry = document.createElement('li');
      entry.className = 'drink-entry';
      const primary = document.createElement('div');
      primary.className = 'drink-entry__primary';
      primary.append(makeElement('h4', '', item.name));
      if (item.detail) primary.append(makeElement('p', 'drink-entry__detail', item.detail));

      if (item.price) {
        entry.append(primary, makeElement('p', 'drink-entry__price', item.price));
      } else {
        const prices = document.createElement('ul');
        prices.className = 'drink-entry__prices';
        (item.prices || []).forEach(({ label, value }) => {
          const price = document.createElement('li');
          price.append(makeElement('span', '', label), makeElement('strong', '', value));
          prices.append(price);
        });
        entry.append(primary, prices);
      }
      list.append(entry);
    });
    return list;
  };

  const renderDrinkTable = (rows, columns) => {
    const table = document.createElement('div');
    table.className = 'drinks-table';
    table.style.setProperty('--drink-column-count', String(columns.length));

    const header = document.createElement('div');
    header.className = 'drinks-table__header';
    header.append(makeElement('span', 'sr-only', 'Boisson'));
    columns.forEach(column => header.append(makeElement('span', '', column)));
    table.append(header);

    rows.forEach(row => {
      const item = document.createElement('div');
      item.className = 'drinks-table__row';
      const primary = document.createElement('div');
      primary.className = 'drinks-table__primary';
      primary.append(makeElement('h4', '', row.name));
      if (row.detail) primary.append(makeElement('p', '', row.detail));
      item.append(primary);
      row.prices.forEach((price, index) => {
        const cell = makeElement('p', 'drinks-table__price', price);
        cell.dataset.label = columns[index];
        item.append(cell);
      });
      table.append(item);
    });
    return table;
  };

  const renderDrinks = category => {
    const menu = document.createElement('div');
    menu.className = 'drinks-menu';

    category.groups.forEach(group => {
      const section = document.createElement('section');
      section.className = `drinks-group drinks-group--${group.id}`;
      section.setAttribute('aria-labelledby', `drinks-${group.id}`);
      const title = makeElement('h3', 'drinks-group__title', group.title);
      title.id = `drinks-${group.id}`;
      section.append(title);
      if (group.items?.length) section.append(renderDrinkList(group.items));
      if (group.rows?.length) section.append(renderDrinkTable(group.rows, group.columns));

      (group.subgroups || []).forEach(subgroup => {
        const subSection = document.createElement('section');
        subSection.className = 'drinks-subgroup';
        const subTitle = makeElement('h4', 'drinks-subgroup__title', subgroup.title);
        subSection.append(subTitle);
        if (subgroup.items?.length) subSection.append(renderDrinkList(subgroup.items));
        if (subgroup.rows?.length) subSection.append(renderDrinkTable(subgroup.rows, group.columns));
        section.append(subSection);
      });
      menu.append(section);
    });
    panel.replaceChildren(menu);
  };

  const renderCategory = category => {
    const title = makeElement('h2', 'sr-only', category.label);
    title.id = 'carte-panel-title';

    if (category.type === 'formula') {
      const formulaPanel = document.createElement('div');
      formulaPanel.className = 'carte-formula-panel';
      formulaPanel.append(makeElement('p', 'carte-formula-panel__copy', category.copy));
      panel.replaceChildren(title, formulaPanel);
      return;
    }

    if (category.type === 'drinks') {
      renderDrinks(category);
      panel.prepend(title);
      return;
    }

    const items = resolveItems(category);

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
