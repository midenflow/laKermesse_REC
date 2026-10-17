/* ============================================
   La Kermesse — Menu data (no logic)
   Loaded on every page that needs the menu.
   Update prices / dishes here, once.
   ============================================ */

window.laKermesseMenu = {
  lunch: {
    prices: [
      { price: "13 €", label: "Plat seul" },
      { price: "17 €", label: "Entrée + plat ou plat + dessert" },
      { price: "20 €", label: "Entrée + plat + dessert" }
    ],
    sections: [
      { title: "Entrées", items: ["Œufs mayonnaise", "Tranche de pâté maison", "Céleri rémoulade, chiffonnade de jambon cru", "Rillettes de poulet aux épices douces"] },
      { title: "Plats", items: ["Grillade de porc, sauce aux champignons, purée, carottes rôties", "Lasagne au thon, petits légumes, salade", "Salade de légumes grillés, feta, olives noires"] },
      { title: "Desserts", items: ["Mousse au chocolat", "Marbré vanille-chocolat", "Cheesecake banane", "Clafoutis aux pommes"] }
    ]
  },
  pizzas: [
    { name: "La sans chichi",       price: "11,50 €", ingredients: "Base tomate, mozzarella, origan", image: "assets/images/pizzas/La sans chichi.png" },
    { name: "La Reine de la Vern",  price: "12,50 €", ingredients: "Base tomate, mozzarella, jambon blanc, origan", image: "assets/images/pizzas/La rue de la Vern.png" },
    { name: "La Kermesse Royale",   price: "13 €",    ingredients: "Base tomate, mozzarella, jambon blanc, champignons frais, origan", image: "assets/images/pizzas/La Kermesse Royale.png" },
    { name: "Les 4 Chevaux",        price: "14,50 €", ingredients: "Base crème, mozzarella, gorgonzola, chèvre, copeaux de parmesan", image: "assets/images/pizzas/La 4 Chevaux.png" },
    { name: "La Véggie land",       price: "14 €",    ingredients: "Base tomate, mozzarella, légumes de saison, pesto, champignons, roquette", image: "assets/images/pizzas/La Véggie land.png" },
    { name: "La Bolo",              price: "13 €",    ingredients: "Base tomate, mozzarella, viande hachée, tomates, oignons", image: "assets/images/pizzas/La Bolo.png" },
    { name: "La Montagne Russe",    price: "14,50 €", ingredients: "Base crème, mozzarella, reblochon, pommes de terre, lardons, oignons", image: "assets/images/pizzas/La Montagne Russe.png" },
    { name: "La Mimi Ferme",        price: "12,50 €", ingredients: "Base crème, chèvre frais, miel", image: "assets/images/pizzas/La Mimi Ferme.png" },
    { name: "La Chicken Run",       price: "13 €",    ingredients: "Base tomate, tenders de poulet maison, oignons frits, sauce barbecue", image: "assets/images/pizzas/La Chicken Run.png" }
  ]
};

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
      copy: '<p class="carte-formula-panel__copy">Chaque midi a sa formule. Elle évolue selon les saisons, les arrivages et les envies de la cuisine. À découvrir chaque jour sur <a class="carte-inline-link" href="https://www.instagram.com/la_kermesse_rennes/?hl=fr" target="_blank" rel="noopener">Instagram</a> ou sur place.</p><a class="carte-formula-panel__instagram" href="https://www.instagram.com/la_kermesse_rennes/?hl=fr" target="_blank" rel="noopener" aria-label="Suivez La Kermesse sur Instagram"><svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><rect x="3" y="3" width="18" height="18" rx="5" ry="5" fill="none" stroke="currentColor" stroke-width="1.8"/><circle cx="12" cy="12" r="4" fill="none" stroke="currentColor" stroke-width="1.8"/><circle cx="17.4" cy="6.6" r="1.1" fill="currentColor"/></svg><span>@la_kermesse_rennes</span></a>'
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