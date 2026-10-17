<?php require_once __DIR__ . '/assets/includes/config.php'; ?>
<!doctype html>
<html lang="fr">

<?php echo $copyright; ?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>La Kermesse Rennes | Bar, Restaurant &amp; Jardin</title>
  <meta name="description" content="La Kermesse, bar-restaurant et bar à tapas à Rennes : cuisine conviviale, grande terrasse et jardin caché au 121 Rue de Vern.">
  <meta property="og:title" content="La Kermesse Rennes | Bar, Restaurant & Jardin">
  <meta property="og:description" content="Un bistrot de quartier, un grand jardin caché et des soirées qui se prolongent.">
  <meta property="og:type" content="website">
  <meta property="og:image" content="assets/images/01_hero_sunset_people.png">
  <meta name="theme-color" content="#06171f">	
  
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
<body>
  <a class="skip-link" href="/">Aller au contenu</a>
  <!-- Header -->
  <?php require_once 'assets/includes/header.php';  ?>
  <main id="main">
    <section id="top" class="hero" aria-labelledby="hero-title">
      <picture>
        <source media="(max-width: 600px)" srcset="assets/images/02_evening_garden_empty_vertical.png">
        <img class="hero__image" src="assets/images/01_hero_sunset_people.png" alt="Le jardin de La Kermesse au coucher du soleil" fetchpriority="high">
      </picture>
      <div class="hero__veil"></div>
      <div class="hero__content wrap">
        <p class="eyebrow hero__eyebrow">BAR · RESTAURANT · JARDIN</p>
        <h1 id="hero-title">Le jardin caché<br>où Rennes se retrouve.</h1>
        <p class="hero__lede">Un bistrot de quartier, un grand jardin caché, une cuisine conviviale et des soirées qui se prolongent.</p>
        <div class="hero__actions">
          <a class="button" href="reservation">Réserver une table 
		  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="square" stroke-width="2" d="M8.272 8h7.778v7.778m-.88-6.899l-7.146 7.147"/></svg>
		  </a>
          <a class="text-link text-link--light" href="#histoire">Découvrir La Kermesse <span aria-hidden="true">↓</span></a>
        </div>
      </div>
      <p class="hero__scroll" aria-hidden="true">Défiler <span></span></p>
    </section>

    <section id="histoire" class="story" data-story aria-label="L’esprit Kermesse">
      <div class="story__sticky">
        <p class="sr-only">À propos de la saveur que laissent les moments partagés. À propos de notre jardin, de nos tablées, de nos verres et de nos soirs. À propos de notre musique. De nos nuits. De notre manière de recevoir. À propos de Rennes, des saisons, et du plaisir d’être ensemble. Bienvenue à La Kermesse.</p>
        <div class="story__lines" aria-hidden="true">
          <p class="story__line">À propos de la saveur que laissent les moments partagés.</p>
          <p class="story__line">À propos de notre jardin, de nos tablées, de nos verres et de nos soirs.</p>
          <p class="story__line">À propos de notre musique. De nos nuits. De notre manière de recevoir.</p>
          <p class="story__line">À propos de Rennes, des saisons, et du plaisir d’être ensemble.</p>
          <p class="story__line story__line--welcome">Bienvenue à La Kermesse.</p>
        </div>
      </div>
    </section>

    <section id="jardin" class="garden section" aria-labelledby="garden-title">
      <div class="wrap garden__intro reveal">
        <p class="eyebrow">Le jardin caché</p>
        <h2 id="garden-title">Une guinguette qui ne se laisse pas deviner.</h2>
      </div>
      <div class="garden__layout wrap">
        <figure class="garden__primary image-frame reveal"><img src="assets/images/03_day_garden_framed_arch.png" alt="Le jardin arboré et les transats de La Kermesse" loading="lazy" width="1047" height="1502"></figure>
        <div class="garden__text reveal">
          <p>Palmiers, tables au soleil, transats et grands éclats de rire : le jardin est le cœur battant de La Kermesse. Une vraie respiration urbaine, à partager en famille ou entre amis.</p>
          <a class="text-link" href="reservation">Réserver au jardin <span aria-hidden="true">→</span></a>
        </div>
        <figure class="garden__secondary image-frame reveal"><img src="assets/images/09_day_garden_wide.png" alt="Grande terrasse ensoleillée de La Kermesse" loading="lazy" width="1672" height="941"></figure>
        <figure class="garden__tertiary image-frame reveal"><img src="assets/images/14_garden_center_canopy.png" alt="Le jardin sous sa voile d'ombrage" loading="lazy" width="1849" height="851"></figure>
      </div>
    </section>

    <section id="carte" class="table-section section" aria-labelledby="table-title">
      <div class="wrap table-section__top">
        <div class="reveal">
          <p class="eyebrow">À table</p>
          <h2 id="table-title">Simple, de saison, à partager.</h2>
        </div>
      </div>
      <div class="wrap moments">
        <article class="moment reveal"><span>01</span><h3>Le midi</h3><p>Une formule de saison pour faire une vraie pause, sans quitter le quartier.</p></article>
        <article class="moment reveal"><span>02</span><h3>Le soir</h3><p>Quand le jardin prend une autre lumière, on prolonge la table autour de tapas et de verres choisis.</p></article>
        <article class="moment reveal"><span>03</span><h3>À partager</h3><p>Quelques assiettes, de la place pour tout le monde, et aucune raison de se presser.</p></article>
      </div>
      <div class="wrap table-section__cta reveal">
        <a class="menu-link-button" href="carte">Découvrez notre carte <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="square" stroke-width="2" d="M8.272 8h7.778v7.778m-.88-6.899l-7.146 7.147"/></svg></a>
      </div>
      <section class="pizza-showcase" data-pizza-showcase aria-labelledby="pizza-title">
        <div class="pizza-showcase__sticky">
          <div class="pizza-showcase__header wrap">
            <h3 id="pizza-title">Les Pizzas de La Kermesse.</h3>
          </div>
          <div class="pizza-showcase__viewport" data-pizza-viewport>
            <div class="pizza-showcase__track" data-pizza-list></div>
          </div>
        </div>
      </section>
      <section class="pizza-info-band" aria-label="Disponibilité des pizzas">
        <div class="pizza-info-band__papers">
          <img class="pizza-info-band__paper pizza-info-band__paper--takeaway" src="assets/images/pizzas/A emporter.png" alt="À emporter">
          <img class="pizza-info-band__paper pizza-info-band__paper--dine-in" src="assets/images/pizzas/Sur place.png" alt="Sur place">
          <img class="pizza-info-band__paper pizza-info-band__paper--hours" src="assets/images/pizzas/Jusqu'à 21h30.png" alt="Jusqu’à 21h30">
        </div>
        <div class="pizza-info-band__checker" aria-hidden="true"></div>
      </section>
    </section>

    <section class="living section wrap" aria-labelledby="living-title">
      <div class="living__images reveal"><figure><img src="assets/images/06_indoor_room.png" alt="La salle intérieure chaleureuse de La Kermesse" loading="lazy" width="941" height="1672"></figure><figure><img src="assets/images/08_arcade_machine.png" alt="Borne d'arcade dans la salle de La Kermesse" loading="lazy" width="1086" height="1448"></figure></div>
      <div class="living__copy reveal"><p class="eyebrow">Même quand le ciel change</p><h2 id="living-title">Dehors, dedans, toujours chez nous.</h2><p>Le jardin est une évidence, mais l’intérieur a lui aussi son mot à dire : une salle chaleureuse, des jeux et une ambiance qui garde le sourire.</p></div>
    </section>

    <section id="evenements" class="garden section" aria-labelledby="events-title">
      <div class="events__inner wrap">
        <div class="events__image"><img src="assets/images/04_dj_booth_event.png" alt="DJ installé dans le jardin de La Kermesse" loading="lazy" width="1087" height="1447"></div>
        <div class="events__content reveal"><p class="eyebrow">Quand le jardin s’anime</p><h2 id="events-title">Plus qu’un verre,<br>un rendez-vous.</h2><p>DJ sets, concerts, blind tests, stand-up, impro et soirées sport : La programmation évolue au fil des semaines.</p><div class="events__actions"><a class="button button--cream" href="https://www.instagram.com/la_kermesse_rennes/?hl=fr" target="_blank" rel="noopener">Suivre les prochains programmes  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="square" stroke-width="2" d="M8.272 8h7.778v7.778m-.88-6.899l-7.146 7.147"/></svg></a><a class="button events__private-button" href="reservation-groupes"><svg class="events__private-tracer" viewBox="0 0 100 42" preserveAspectRatio="none" aria-hidden="true" focusable="false"><rect x="1" y="1" width="98" height="40" pathLength="100" /></svg>Organiser un événement 
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M23 11v2h-1v1h-1v1h-1v1h-1v1h-1v1h-1v1h-1v1h-1v1h-1v1h-1v1h-1v-1h-1v-1h-1v-1h1v-1h1v-1h1v-1h1v-1h1v-1h1v-1H1v-4h15V9h-1V8h-1V7h-1V6h-1V5h-1V4h-1V3h1V2h1V1h1v1h1v1h1v1h1v1h1v1h1v1h1v1h1v1h1v1h1v1z"></path></svg>
		</a></div></div>
      </div>
    </section>

    <section class="gallery section wrap" aria-labelledby="gallery-title">
      <div class="gallery__heading reveal"><p class="eyebrow">En images</p><h2 id="gallery-title">Quelques éclats<br>de La Kermesse.</h2></div>
      <div class="gallery__grid">
        <figure class="gallery__item gallery__item--tall reveal"><img src="assets/images/02_evening_garden_empty_vertical.png" alt="Le jardin à l'heure bleue" loading="lazy" width="1087" height="1447"></figure>
        <figure class="gallery__item gallery__item--wide reveal"><img src="assets/images/10_people_garden_group.png" alt="Une ambiance conviviale dans le jardin" loading="lazy" width="1672" height="941"></figure>
        <figure class="gallery__item reveal"><img src="assets/images/07_day_garden_foreground_plant.png" alt="Végétation et terrasse au jardin" loading="lazy" width="1087" height="1447"></figure>
        <figure class="gallery__item reveal"><img src="assets/images/13_garden_left_entrance.png" alt="Terrasse et palmiers de La Kermesse" loading="lazy" width="1851" height="850"></figure>
        <figure class="gallery__item gallery__item--wide reveal"><img src="assets/images/05_golden_hour_people.png" alt="Les clients dans le jardin à l'heure dorée" loading="lazy" width="1254" height="1254"></figure>
      </div>
    </section>

    <figure class="pano" aria-label="Vue panoramique du jardin"><img src="assets/images/12_pano_terrace.png" alt="Vue panoramique de la terrasse de La Kermesse" loading="lazy" width="2160" height="728"></figure>

    <section class="reserve-band" aria-labelledby="reserve-title"><div class="wrap reserve-band__inner reveal"><p class="eyebrow">On vous garde une place ?</p><h2 id="reserve-title">Une table au jardin ?</h2><p>Réservez votre moment à La Kermesse.</p><div><a class="button button--cream" href="reservation">Réserver une table 
	<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="currentColor"><path d="M7.75 2.5C7.75 2.08579 7.41421 1.75 7 1.75C6.58579 1.75 6.25 2.08579 6.25 2.5V4.07926C4.81067 4.19451 3.86577 4.47737 3.17157 5.17157C2.47737 5.86577 2.19451 6.81067 2.07926 8.25H21.9207C21.8055 6.81067 21.5226 5.86577 20.8284 5.17157C20.1342 4.47737 19.1893 4.19451 17.75 4.07926V2.5C17.75 2.08579 17.4142 1.75 17 1.75C16.5858 1.75 16.25 2.08579 16.25 2.5V4.0129C15.5847 4 14.839 4 14 4H10C9.16097 4 8.41527 4 7.75 4.0129V2.5Z"/><path fill-rule="evenodd" d="M2 12C2 11.161 2 10.4153 2.0129 9.75H21.9871C22 10.4153 22 11.161 22 12V14C22 17.7712 22 19.6569 20.8284 20.8284C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.8284C2 19.6569 2 17.7712 2 14V12ZM17 14C17.5523 14 18 13.5523 18 13C18 12.4477 17.5523 12 17 12C16.4477 12 16 12.4477 16 13C16 13.5523 16.4477 14 17 14ZM17 18C17.5523 18 18 17.5523 18 17C18 16.4477 17.5523 16 17 16C16.4477 16 16 16.4477 16 17C16 17.5523 16.4477 18 17 18ZM13 13C13 13.5523 12.5523 14 12 14C11.4477 14 11 13.5523 11 13C11 12.4477 11.4477 12 12 12C12.5523 12 13 12.4477 13 13ZM13 17C13 17.5523 12.5523 18 12 18C11.4477 18 11 17.5523 11 17C11 16.4477 11.4477 16 12 16C12.5523 16 13 16.4477 13 17ZM7 14C7.55228 14 8 13.5523 8 13C8 12.4477 7.55228 12 7 12C6.44772 12 6 12.4477 6 13C6 13.5523 6.44772 14 7 14ZM7 18C7.55228 18 8 17.5523 8 17C8 16.4477 7.55228 16 7 16C6.44772 16 6 16.4477 6 17C6 17.5523 6.44772 18 7 18Z" clip-rule="evenodd"/></g></svg>
	</a></div></div><div class="reserve-band__checker" aria-hidden="true"></div></section>

    <section class="map-section wrap reveal" style="padding-top:5%;" aria-labelledby="map-title"><div class="map-section__head"><h2 id="map-title" class="maps-title">Rendez-vous au 121, rue de Vern.</h2></div><div class="map-frame"><iframe title="Carte interactive : La Kermesse, 121 Rue de Vern, Rennes" src="https://www.google.com/maps?q=121+Rue+de+Vern,+35200+Rennes,+France&amp;z=15&amp;output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe></div></section>
	
<section id="infos" class="info wrap" aria-label="Informations pratiques">
      <div class="info__details reveal is-visible" bis_skin_checked="1"><div class="paper-note paper-note--hours" bis_skin_checked="1"><img src="assets/images/horaires-restaurant-paper.png" alt="Horaires restaurant : lundi à mercredi, 09h à 00h ; jeudi à vendredi, 09h à 01h ; samedi, 17h à 01h ; dimanche, fermé."></div><div class="paper-note paper-note--contact contact-paper" bis_skin_checked="1"><img src="assets/images/contact-paper.png" alt="Nous contacter : 09 82 68 44 17 et Instagram @la_kermesse_rennes."><a class="contact-hotspot contact-hotspot--phone" href="tel:+33982684417" aria-label="Appeler La Kermesse au 09 82 68 44 17"></a><a class="contact-hotspot contact-hotspot--instagram" href="https://www.instagram.com/la_kermesse_rennes/" target="_blank" rel="noopener" aria-label="Ouvrir Instagram de La Kermesse"></a></div></div>
    </section>

  </main>
<!-- Footer  -->
  <?php require_once 'assets/includes/footer.php';  ?>
  
<script src="assets/js/menu-data.js"></script>
<script src="assets/js/site.js"></script>
<script src="assets/js/index.js"></script>

</body>
</html>
