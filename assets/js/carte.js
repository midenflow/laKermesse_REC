/* ============================================
   La Kermesse — Carte-only behaviors
   Tabs, panels, drinks table, formula.
   ============================================ */

/* ============================================
   Carte data — used only on carte.html
   ============================================ */
window.laKermesseCarte = {
  intro: { title: "MENU" },
  formula: {
    eyebrow: "Déjeuner",
    title: "La formule du midi",
    prices: [
      { price: "13 €", label: "Plat seul" },
      { price: "17 €", label: "Entrée + plat ou plat + dessert" },
      { price: "20 €", label: "Entrée + plat + dessert" }
    ]
  },
  categories: [
    { id: "pizza", label: "Pizza", source: "homepagePizzas" },
    {
      id: "formule-midi",
      label: "Formule du midi",
      type: "formula",
		copy: '<p class="carte-formula-panel__copy">Chaque midi a sa formule. Elle évolue selon les saisons, les arrivages et les envies de la cuisine. À découvrir chaque jour sur <a class="carte-inline-link" href="https://www.instagram.com/la_kermesse_rennes/?hl=fr" target="_blank" rel="noopener">Instagram</a> ou sur place.</p><a class="carte-formula-panel__instagram" href="https://www.instagram.com/la_kermesse_rennes/?hl=fr" target="_blank" rel="noopener" aria-label="Suivez La Kermesse sur Instagram"><svg style=" width: 15%; color: var(--gold); padding-top: 5%; "viewBox="0 0 24 24" aria-hidden="true" focusable="false"><rect x="3" y="3" width="18" height="18" rx="5" ry="5" fill="none" stroke="currentColor" stroke-width="1.8"/><circle cx="12" cy="12" r="4" fill="none" stroke="currentColor" stroke-width="1.8"/><circle cx="17.4" cy="6.6" r="1.1" fill="currentColor"/></svg></a>'
    },
    {
      id: "boissons",
      label: "Boissons",
      type: "drinks",
      groups: [
        {
          id: "apero",
          title: "L’Apéro",
          items: [
            { name: "Ricard", price: "3,00 €" },
            { name: "Kir", price: "4,20 €", detail: "cassis, mûre, framboise, pêche" },
            { name: "Lillet tonic", price: "7,50 €" },
            { name: "Spritz Aperol", price: "7,50 €" },
            { name: "Spritz Sureau", price: "8,50 €" },
            { name: "Spritz Limoncello", price: "8,50 €" },
            { name: "Cidre", prices: [
              { label: "demi", value: "4,00 €" },
              { label: "pinte", value: "7,50 €" },
              { label: "bouteille", value: "11,00 €" }
            ]},
            { name: "Punch", prices: [
              { label: "demi", value: "4,50 €" },
              { label: "pinte", value: "8,50 €" },
              { label: "pichet", value: "23,00 €" }
            ]}
          ]
        },
        {
          id: "chaudes",
          title: "Boissons chaudes",
          items: [
            { name: "Expresso · Allongé · Déca", price: "1,80 €" },
            { name: "Café crème", price: "2,50 €" },
            { name: "Cappuccino", price: "3,50 €" },
            { name: "Double expresso", price: "3,60 €" },
            { name: "Café latte", price: "4,00 €" },
            { name: "Café frappé", price: "4,00 €" },
            { name: "Chocolat chaud", price: "3,00 €" },
            { name: "Thé · Infusion", price: "3,00 €" }
          ]
        },
        {
          id: "softs",
          title: "Les softs",
          items: [
            { name: "Sirop à l’eau", price: "2,00 €", detail: "orgeat, menthe, grenadine, fraise, cerise, violette, citron, banane, kiwi" },
            { name: "Diabolo", price: "3,00 €" },
            { name: "Limonade", price: "2,50 €" },
            { name: "Ginger beer", price: "3,00 €" },
            { name: "Soda", price: "3,70 €", detail: "Coca, Coca 0, Fanta, Schweppes agrumes" },
            { name: "Thé glacé maison", price: "3,50 €" },
            { name: "Citronnade maison", price: "3,50 €" },
            { name: "Jus de fruit bio", price: "4,50 €", detail: "pamplemousse, ACE, ananas, abricot, orange, pomme, tomate" }
          ]
        },
        {
          id: "eau",
          title: "L’Eau",
          items: [
            { name: "Plate", prices: [{ label: "0,5 L", value: "1,50 €" }, { label: "1 L", value: "2,50 €" }] },
            { name: "Gazeuse", prices: [{ label: "0,5 L", value: "2,70 €" }, { label: "1 L", value: "4,50 €" }] }
          ]
        },
        {
          id: "bieres",
          title: "Les bières",
          columns: ["25 cl", "50 cl", "1,5 L"],
          rows: [
            { name: "Blonde légère", detail: "4,2 %", prices: ["3,00 €", "5,50 €", "16,00 €"] },
            { name: "Champs Libre", detail: "blonde non filtrée · 5,8 %", prices: ["4,00 €", "7,50 €", "22,00 €"] },
            { name: "Pélican Blonde", detail: "7,5 %", prices: ["4,50 €", "8,50 €", "25,00 €"] },
            { name: "Pélican Rouge", detail: "7,5 %", prices: ["4,50 €", "8,50 €", "25,00 €"] },
            { name: "IPA, Sainte-Colombe", detail: "6,7 %", prices: ["4,00 €", "7,50 €", "22,00 €"] },
            { name: "NEIPA, Panthincific", detail: "5 %", prices: ["4,50 €", "8,50 €", "25,00 €"] },
            { name: "Blanche, Affligem", detail: "4,8 %", prices: ["4,00 €", "7,50 €", "22,00 €"] },
            { name: "Bière du moment", detail: "selon arrivage", prices: ["4,00 €", "7,50 €", "22,00 €"] }
          ],
          subgroups: [
            { title: "Bières bouteille", items: [
              { name: "Brooklyn", price: "5,50 €" },
              { name: "1664", price: "4,00 €" },
              { name: "Desperados", price: "6,50 €" }
            ]}
          ]
        },
        {
          id: "bulles",
          title: "Les bulles",
          items: [
            { name: "Coupe de Prosecco", price: "4,00 €" },
            { name: "Coupe de Champagne", price: "8,50 €" }
          ]
        },
        {
          id: "vins",
          title: "Les vins",
          columns: ["12 cl", "Btl"],
          subgroups: [
            { title: "Blancs", rows: [
              { name: "Chardonnay", prices: ["3,50 €", "19,00 €"] },
              { name: "Chenin AOP bio", prices: ["4,50 €", "24,00 €"] },
              { name: "Côtes de Bergerac", prices: ["4,00 €", "22,00 €"] },
              { name: "Quincy", prices: ["5,50 €", "30,00 €"] }
            ]},
            { title: "Rosés", rows: [
              { name: "Corse", prices: ["4,50 €", "24,00 €"] },
              { name: "Guinguette bio", prices: ["4,50 €", "24,00 €"] },
              { name: "Cabernet d’Anjou", prices: ["4,50 €", "24,00 €"] }
            ]},
            { title: "Rouges", rows: [
              { name: "Pinot noir", prices: ["4,50 €", "24,00 €"] },
              { name: "Échine d’Âne", prices: ["5,00 €", "27,00 €"] }
            ]}
          ]
        }
      ]
    }
  ]
};

/* ============================================
   Carte renderer — tabs, panels, drinks
   ============================================ */
   
   
(() => {
  const app = document.querySelector('[data-carte-app]');
  const tabs = document.querySelector('[data-carte-tabs]');
  const panel = document.querySelector('[data-carte-panel]');
  const intro = document.querySelector('[data-carte-intro]');
  const formula = document.querySelector('[data-carte-formula]');
  const data = window.laKermesseCarte;

  if (!app || !tabs || !panel || !intro || !formula || !data) return;

  const el = (tag, className, text) => {
    const node = document.createElement(tag);
    if (className) node.className = className;
    if (text != null) node.textContent = text;
    return node;
  };

  const renderIntro = () => {
    intro.replaceChildren(el('h1', 'carte-intro__title', data.intro.title));
  };

  const renderFormula = () => {
    const heading = el('div', 'carte-formula__heading');
    const title = el('h2', '', data.formula.title);
    title.id = 'carte-formula-title';
    heading.append(title);

    const prices = el('div', 'carte-formula__prices');
    data.formula.prices.forEach(({ price, label }) => {
      const row = document.createElement('p');
      row.append(el('strong', '', price), document.createTextNode(` ${label}`));
      prices.append(row);
    });

    formula.replaceChildren(heading, prices);
  };

  const resolveItems = category => {
    if (category.source === 'homepagePizzas') {
      return (window.laKermesseMenu?.pizzas || []).map(({ name, ingredients, image }) => ({
        name, description: ingredients, image, type: 'pizza'
      }));
    }
    return (category.items || []).filter(item => item.active !== false);
  };

  const buildDrinkList = items => {
    const list = el('ul', 'drinks-list');
    items.forEach(item => {
      const entry = el('li', 'drink-entry');
      const primary = el('div', 'drink-entry__primary');
      primary.append(el('h4', '', item.name));
      if (item.detail) primary.append(el('p', 'drink-entry__detail', item.detail));

      if (item.price) {
        entry.append(primary, el('p', 'drink-entry__price', item.price));
      } else if (item.prices) {
        const prices = el('ul', 'drink-entry__prices');
        item.prices.forEach(({ label, value }) => {
          const line = document.createElement('li');
          line.append(el('span', '', label), el('strong', '', value));
          prices.append(line);
        });
        entry.append(primary, prices);
      }
      list.append(entry);
    });
    return list;
  };

  const buildDrinkTable = (rows, columns) => {
    const table = el('div', 'drinks-table');
    table.style.setProperty('--drink-column-count', String(columns.length));

    const header = el('div', 'drinks-table__header');
    header.append(el('span', 'sr-only', 'Boisson'));
    columns.forEach(col => header.append(el('span', '', col)));
    table.append(header);

    rows.forEach(row => {
      const line = el('div', 'drinks-table__row');
      const primary = el('div', 'drinks-table__primary');
      primary.append(el('h4', '', row.name));
      if (row.detail) primary.append(el('p', '', row.detail));
      line.append(primary);

      row.prices.forEach((price, i) => {
        const cell = el('p', 'drinks-table__price', price);
        cell.dataset.label = columns[i];
        line.append(cell);
      });
      table.append(line);
    });
    return table;
  };

  const buildDrinks = category => {
    const menu = el('div', 'drinks-menu');
    category.groups.forEach(group => {
      const section = el('section', `drinks-group drinks-group--${group.id}`);
      const title = el('h3', 'drinks-group__title', group.title);
      title.id = `drinks-${group.id}`;
      section.setAttribute('aria-labelledby', title.id);
      section.append(title);

      if (group.items?.length) section.append(buildDrinkList(group.items));
      if (group.rows?.length)  section.append(buildDrinkTable(group.rows, group.columns || []));

      (group.subgroups || []).forEach(sub => {
        const block = el('section', 'drinks-subgroup');
        block.append(el('h4', 'drinks-subgroup__title', sub.title));
        if (sub.items?.length) block.append(buildDrinkList(sub.items));
        if (sub.rows?.length)  block.append(buildDrinkTable(sub.rows, group.columns || []));
        section.append(block);
      });

      menu.append(section);
    });
    return menu;
  };

  const renderCategory = category => {
    const title = el('h2', 'sr-only', category.label);
    title.id = 'carte-panel-title';

    if (category.type === 'formula') {
      const wrap = el('div', 'carte-formula-panel');
      wrap.innerHTML = category.copy;   // trusted — comes from laKermesseCarte, not user input
      panel.replaceChildren(title, wrap);
      return;
    }

    if (category.type === 'drinks') {
      panel.replaceChildren(title, buildDrinks(category));
      return;
    }

    const items = resolveItems(category);
    if (!items.length) {
      const empty = el('div', 'carte-empty');
      empty.append(
        el('p', 'eyebrow', category.label),
        el('p', 'carte-empty__title', category.emptyState || 'Sélection à venir'),
        el('p', 'carte-empty__copy', 'La sélection sera bientôt disponible.')
      );
      panel.replaceChildren(title, empty);
      return;
    }

    const grid = el('div', 'carte-grid');
    grid.dataset.count = String(items.length);
    items.forEach(({ name, description, image, type }) => {
      const card = el('article', `carte-card${type === 'pizza' ? ' carte-card--pizza' : ''}`);
      const visual = el('div', 'carte-card__visual');
      const img = document.createElement('img');
      img.src = image;
      img.alt = name;
      img.loading = 'lazy';
      visual.append(img);
      const copy = el('div', 'carte-card__copy');
      copy.append(el('h3', '', name), el('p', '', description));
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

    if (!animate || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
      render();
      return;
    }
    panel.classList.add('is-switching');
    window.setTimeout(render, 180);
  };

  const renderTabs = () => {
    tabs.replaceChildren();
    data.categories.forEach((category, index) => {
      const btn = el('button', 'carte-tab', category.label);
      btn.type = 'button';
      btn.id = `carte-tab-${category.id}`;
      btn.setAttribute('role', 'tab');
      btn.setAttribute('aria-controls', 'carte-panel');
      btn.setAttribute('aria-selected', String(index === 0));
      btn.tabIndex = index === 0 ? 0 : -1;
      btn.classList.toggle('is-active', index === 0);
      btn.addEventListener('click', () => selectCategory(category, btn));
      btn.addEventListener('keydown', event => {
        if (!['ArrowRight', 'ArrowLeft', 'Home', 'End'].includes(event.key)) return;
        event.preventDefault();
        const list = [...tabs.querySelectorAll('[role="tab"]')];
        const current = list.indexOf(btn);
        const next = event.key === 'Home' ? 0
                  : event.key === 'End'  ? list.length - 1
                  : (current + (event.key === 'ArrowRight' ? 1 : -1) + list.length) % list.length;
        list[next].focus();
        list[next].click();
      });
      tabs.append(btn);
    });
    selectCategory(data.categories[0], tabs.querySelector('[role="tab"]'), false);
  };

  renderIntro();
  renderFormula();
  renderTabs();
})();