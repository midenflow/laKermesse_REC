<?php require_once __DIR__ . '/assets/includes/config.php'; ?>
<!doctype html>
<html lang="fr">

<?php echo $copyright; ?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>La Carte | La Kermesse Rennes</title>
  <meta name="description" content="La carte de La Kermesse à Rennes : déjeuner, pizzas, boissons et desserts au fil des saisons.">
  <meta property="og:title" content="La Carte | La Kermesse Rennes">
  <meta property="og:description" content="Pizzas, formule du midi et boissons : découvrez la carte de La Kermesse, bar-restaurant et jardin caché à Rennes.">
  <meta property="og:type" content="website">
  <meta property="og:image" content="assets/images/01_hero_sunset_people.png">
  <meta name="theme-color" content="#120b06">

  <link rel="icon" type="image/x-icon" href="./assets/images/la_kermesse_duck.svg">
  <link rel="icon" href="./assets/images/la_kermesse_duck.svg" sizes="32x32">
  <link rel="icon" href="./assets/images/la_kermesse_duck.svg" sizes="192x192">
  <link rel="apple-touch-icon" href="./assets/images/la_kermesse_duck.svg">
  <meta name="msapplication-TileImage" content="./assets/images/la_kermesse_duck.svg">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@500;600;700&family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/styles.css">
	
  <script type="application/ld+json">
  {"@context":"https://schema.org","@type":"Restaurant","name":"La Kermesse","description":"Bar-restaurant avec jardin et terrasse à Rennes.","address":{"@type":"PostalAddress","streetAddress":"121 Rue de Vern","postalCode":"35200","addressLocality":"Rennes","addressCountry":"FR"},"telephone":"+33982684417","sameAs":["https://www.instagram.com/la_kermesse_rennes/?hl=fr"],"servesCuisine":"Cuisine de saison, tapas"}
  </script>
</head>
<body class="carte-page">
  <a class="skip-link" href="/">Aller au contenu</a>
<!-- Footer-->
  <?php require_once 'assets/includes/header.php';  ?>

  <main id="main" class="carte-main" data-carte-app>
    <section class="carte-intro wrap" data-carte-intro></section>
    <section class="carte-formula wrap" aria-labelledby="carte-formula-title" data-carte-formula></section>
    <section id="carte-catalogue" class="carte-catalogue wrap" aria-label="Menu La Kermesse">
      <div class="carte-tabs-wrap">
        <div class="carte-tabs" role="tablist" aria-label="Catégories de la carte" data-carte-tabs></div>
      </div>
      <div id="carte-panel" class="carte-panel" role="tabpanel" aria-labelledby="carte-tab-pizza" data-carte-panel></div>
    </section>
  </main>
  
<!-- Footer-->
  <?php require_once 'assets/includes/footer.php';  ?>
  
  <script src="assets/js/menu-data.js"></script>
  <script src="assets/js/site.js"></script>
  <script src="assets/js/carte.js"></script>
</body>
</html>