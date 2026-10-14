<!doctype html>
<html lang="fr">
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

  <link rel="icon" href="./assets/images/la-kermesse-wordmark-transparent.png" sizes="32x32">
  <link rel="icon" href="./assets/images/la-kermesse-wordmark-transparent.png" sizes="192x192">
  <link rel="apple-touch-icon" href="./assets/images/la-kermesse-wordmark-transparent.png">
  <meta name="msapplication-TileImage" content="./assets/images/la-kermesse-wordmark-transparent.png"> 

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@500;600;700&family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">

  <!-- <link rel="stylesheet" href="assets/css/styles.css"> -->   
  <style>
:root {
  --ink: #071e28;
  --petrol: #0d3442;
  --night: #06171f;
  --cream: #f4efe4;
  --sand: #dfd2bc;
  --gold: #c6a56a;
  --gold-glint: #d6aa3c;
  --accent-pink: #d4005f;
  --line: rgba(244, 239, 228, .22);
  --radius-sm: 8px;
  --radius-md: 12px;
  --serif: "DM Serif Display", Georgia, serif;
  --sans: "DM Sans", Arial, sans-serif;
  --wrap: 1180px;
}

* { box-sizing: border-box; }
html { scroll-behavior: smooth; }
body { margin: 0; background: var(--night); color: var(--cream); font-family: var(--sans); font-size: 16px; line-height: 1.55; }
img { display: block; max-width: 100%; }
a { color: inherit; text-decoration: none; }
button { font: inherit; }
h1, h2, h3, h4, p { margin-top: 0; }
h1, h2, h3 { font-family: var(--serif); font-weight: 400; line-height: .99; letter-spacing: -.03em; }
h1 { font-size: clamp(3.8rem, 8.3vw, 8.1rem); }
h2 { font-size: clamp(2.65rem, 5.1vw, 5rem); }
h3 { font-size: 2rem; }

.sr-only { position: absolute !important; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; border: 0; }
.skip-link { position: fixed; z-index: 100; top: 1rem; left: 1rem; padding: .6rem .9rem; background: var(--cream); color: var(--ink); transform: translateY(-200%); }
.skip-link:focus { transform: none; }
.wrap { width: min(calc(100% - 3rem), var(--wrap)); margin-inline: auto; }
.section { padding: clamp(4.5rem, 7vw, 6.5rem) 0; }
.eyebrow { margin: 0 0 .9rem; font-size: .69rem; font-weight: 600; line-height: 1.2; letter-spacing: .13em; text-transform: uppercase; }

.button { position: relative; isolation: isolate; display: inline-flex; align-items: center; justify-content: center; gap: .8rem; min-height: 3.35rem; padding: .85rem 1.2rem; border: 1px solid rgba(244, 239, 228, .82); border-radius: var(--radius-sm); background: var(--ink); box-shadow: inset 0 0 0 3px var(--ink), inset 0 0 0 4px rgba(198, 165, 106, .66), 0 0 0 3px rgba(244, 239, 228, .18); color: var(--cream); font-size: .74rem; font-weight: 600; letter-spacing: .09em; text-align: center; text-transform: uppercase; transition: transform .25s ease, background .25s ease, box-shadow .25s ease, color .25s ease; }
.button::after { content: ""; position: absolute; inset: 5px; border: 1px solid rgba(244, 239, 228, .2); border-radius: 4px; pointer-events: none; transition: inset .25s ease, border-color .25s ease; }
.button:hover { background: #143f4e; color: var(--cream); box-shadow: inset 0 0 0 3px #143f4e, inset 0 0 0 4px var(--gold), 0 0 0 4px rgba(198, 165, 106, .36); transform: translateY(-2px); }
.button:hover::after { inset: 3px; border-color: rgba(244, 239, 228, .55); }
.button:focus-visible, .text-link:focus-visible, .info-link:focus-visible { outline: 2px solid var(--gold); outline-offset: 4px; }
.button--cream { background: var(--cream); color: var(--ink); box-shadow: inset 0 0 0 3px var(--cream), inset 0 0 0 4px var(--gold), 0 0 0 3px rgba(244, 239, 228, .18); }
.button--cream:hover { background: #fffaf0; color: var(--ink); }
.button--nav { min-height: 3rem; padding: .7rem 1rem; font-size: .7rem; }
.text-link { display: inline-flex; gap: .6rem; padding-bottom: .2rem; border-bottom: 1px solid currentColor; font-size: .78rem; font-weight: 600; letter-spacing: .04em; text-transform: uppercase; transition: opacity .2s; }
.text-link:hover { opacity: .66; }
.text-link--light { color: var(--cream); }

/* ============================================
   SITE HEADER — transparent on load, black on scroll
   ============================================ */
.site-header {
  position: fixed;
  z-index: 10;
  top: 0;
  right: 0;
  left: 0;
  display: flex;
  align-items: center;
  justify-content: space-between;
  height: 5.7rem;
  padding: 0 max(1.5rem, calc((100vw - var(--wrap)) / 2));
  background: transparent;
  color: var(--cream);
  transition: box-shadow .45s cubic-bezier(.4, 0, .2, 1);
}

.site-header::before {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  background: #000;
  opacity: 0;
  pointer-events: none;
  will-change: opacity;
  transform: translateZ(0);
  backface-visibility: hidden;
  transition: opacity .45s cubic-bezier(.4, 0, .2, 1);
}

.site-header.is-scrolled::before { opacity: 1; }
.site-header.is-scrolled { box-shadow: 0 1px 0 rgba(255, 255, 255, .08); }

.brand { display: block; width: 178px; height: 52px; overflow: hidden; }
.brand.site-nav__brand { display: none; }
.brand img { width: 100%; height: 100%; object-fit: contain; object-position: center; }
.site-nav { display: flex; align-items: center; gap: 1.6rem; font-size: .73rem; font-weight: 500; letter-spacing: .07em; text-transform: uppercase; }
.site-nav > a:not(.button) { transition: opacity .2s; }
.site-nav > a:not(.button):hover { opacity: .65; }
.site-nav > a[href="carte.html"] { color: var(--gold-glint); }
.site-nav__actions { display: flex; align-items: center; gap: .65rem; }
.site-nav__event-button { border-color: rgba(13, 52, 66, .82); background: var(--cream); box-shadow: inset 0 0 0 3px var(--cream), inset 0 0 0 4px rgba(13, 52, 66, .66), 0 0 0 3px rgba(244, 239, 228, .18); color: var(--petrol); }
.site-nav__event-button::after { border-color: rgba(13, 52, 66, .28); }
.site-nav__event-button:hover { background: #fffaf0; color: var(--petrol); box-shadow: inset 0 0 0 3px #fffaf0, inset 0 0 0 4px var(--petrol), 0 0 0 4px rgba(198, 165, 106, .36); }
.site-nav__event-button:hover::after { border-color: rgba(13, 52, 66, .52); }
.menu-toggle { display: none; padding: .7rem; border: 0; background: none; color: inherit; }
.menu-toggle > span:not(.sr-only) { display: block; width: 1.65rem; height: 1px; margin: .38rem; background: currentColor; }

.hero { position: relative; display: grid; align-items: end; min-height: 100svh; overflow: hidden; background: var(--night); color: var(--cream); }
.hero picture, .hero__image, .hero__veil { position: absolute; inset: 0; width: 100%; height: 100%; }
.hero__image { object-fit: cover; object-position: center 52%; animation: hero-enter 1.6s ease-out both; }
.hero__veil { background: linear-gradient(90deg, rgba(1, 14, 20, .76), rgba(1, 14, 20, .34) 46%, rgba(1, 14, 20, .16)), linear-gradient(0deg, rgba(1, 14, 20, .58), transparent 50%); }
.hero__content { position: relative; z-index: 1; padding-bottom: clamp(4rem, 9vh, 7rem); }
.hero__eyebrow { animation: rise .7s .25s both; }
.hero h1 { max-width: 710px; margin-bottom: 1.35rem; font-size: clamp(3.5rem, 6.7vw, 6.7rem); line-height: 1.02; animation: rise .8s .34s both; }
.hero__lede { max-width: 415px; margin-bottom: 1.8rem; font-size: clamp(1rem, 1.6vw, 1.18rem); animation: rise .8s .45s both; }
.hero__actions { display: flex; align-items: center; gap: 1.5rem; animation: rise .8s .56s both; }
.hero__scroll { position: absolute; right: max(1.5rem, calc((100vw - var(--wrap)) / 2)); bottom: 2rem; display: flex; align-items: center; gap: .7rem; margin: 0; font-size: .63rem; letter-spacing: .12em; writing-mode: vertical-rl; text-transform: uppercase; }
.hero__scroll span { width: 1px; height: 44px; background: var(--cream); opacity: .8; }


.story, .living, .gallery, .info, .map-section { width: 100%; padding-inline: max(1.5rem, calc((100vw - var(--wrap)) / 2)); }

.story {
  position: relative;
  isolation: isolate;
  min-height: 205svh;
  padding-block: 0;
  color: #e6d1a0;
  background-color: #e0cfa6; /* fallback */
  background-image:
    /* darker tan blotches */
    radial-gradient(ellipse 30% 20% at 75% 8%, rgba(205, 170, 125, 0.45), transparent 70%),
    radial-gradient(ellipse 22% 25% at 72% 40%, rgba(210, 175, 130, 0.40), transparent 70%),
    radial-gradient(ellipse 35% 18% at 22% 25%, rgba(200, 170, 125, 0.40), transparent 70%),
    radial-gradient(ellipse 30% 20% at 70% 90%, rgba(205, 170, 125, 0.40), transparent 70%),
    radial-gradient(ellipse 30% 18% at 25% 70%, rgba(200, 168, 122, 0.35), transparent 70%),
    /* light cream highlights */
    radial-gradient(ellipse 25% 18% at 48% 62%, rgba(240, 228, 198, 0.55), transparent 70%),
    radial-gradient(ellipse 30% 22% at 95% 55%, rgba(240, 228, 198, 0.45), transparent 70%),
    /* base: concentrated on the left, lighter on the right */
    linear-gradient(to right, #d4bf8a 0%, #e0cfa6 55%, #f6efdd 100%);
}

/* soft cloudy mottling */
.story::before {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  pointer-events: none;
  opacity: 0.7;
  background-size: 100% 100%;
  background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1000 1200' preserveAspectRatio='none'><filter id='m' x='0' y='0' width='100%' height='100%'><feTurbulence type='fractalNoise' baseFrequency='0.006 0.006' numOctaves='3' seed='7'/><feColorMatrix values='0 0 0 0 0.78  0 0 0 0 0.62  0 0 0 0 0.44  2.4 0 0 0 -0.95'/></filter><rect width='100%' height='100%' filter='url(%23m)'/></svg>");
}

/* fine paper grain */
.story::after {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  pointer-events: none;
  opacity: 0.18;
  mix-blend-mode: multiply;
  background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='240' height='240'><filter id='g'><feTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='2' stitchTiles='stitch'/><feColorMatrix values='0 0 0 0 0.45  0 0 0 0 0.35  0 0 0 0 0.2  0 0 0 0.8 0'/></filter><rect width='100%' height='100%' filter='url(%23g)'/></svg>");
}

.story__sticky { position: sticky; top: 0; display: grid; align-items: center; min-height: 100svh; padding-block: clamp(4.5rem, 9vh, 7.5rem); }
.story__lines { width: min(1120px, 82vw); margin-inline: auto; text-align: center; }
.story__line { max-width: 100%; margin: 0 0 clamp(.42rem, 1vw, .82rem); color: #080808; font-family: "Caveat", cursive; font-size: clamp(2rem, 3.1vw, 3.9rem); font-weight: 500; letter-spacing: -.025em; line-height: 1.08; text-align: center; text-wrap: balance; }
.story__char { opacity: .15; text-shadow: 0 .25px 0 rgba(0, 0, 0, .32); will-change: opacity; }
.story__line--welcome { margin-top: clamp(1rem, 2.2vw, 1.7rem); font-size: clamp(2.1rem, 3.3vw, 4.05rem); font-weight: 600; }


.garden {
  position: relative;
  isolation: isolate;
  overflow: hidden;
  color: var(--cream);
  background-color: #0b4353; /* fallback */
  background-image:
    /* darker blotches (left and center) */
    radial-gradient(ellipse 14% 45% at 20% 38%, rgba(2, 20, 28, 0.50), transparent 70%),
    radial-gradient(ellipse 12% 40% at 56% 30%, rgba(2, 20, 28, 0.38), transparent 70%),
    radial-gradient(ellipse 12% 45% at 60% 82%, rgba(2, 20, 28, 0.35), transparent 70%),
    radial-gradient(ellipse 10% 40% at 95% 45%, rgba(2, 20, 28, 0.30), transparent 70%),
    /* lighter petrol areas */
    radial-gradient(ellipse 30% 60% at 80% 25%, rgba(20, 90, 112, 0.40), transparent 70%),
    radial-gradient(ellipse 25% 60% at 38% 85%, rgba(20, 90, 112, 0.30), transparent 70%),
    /* base: slightly darker left, lighter right */
    linear-gradient(90deg, #093a49 0%, #0c4658 50%, #0e4c60 100%);
}

/* paper grain + speckles */
.garden::before {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  pointer-events: none;
  opacity: 0.6;
  mix-blend-mode: overlay;
  background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='300' height='300'><filter id='n'><feTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='3' stitchTiles='stitch'/><feColorMatrix values='0 0 0 0 0  0 0 0 0 0  0 0 0 0 0  0 0 0 0.95 0'/></filter><rect width='100%' height='100%' filter='url(%23n)'/></svg>");
}

/* faint horizontal paper fibers */
.garden::after {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  pointer-events: none;
  background-image: repeating-linear-gradient(
    0deg,
    rgba(255, 255, 255, 0.03) 0 1px,
    transparent 1px 3px
  );
}

.garden__intro { display: grid; grid-template-columns: 1fr 2fr; align-items: end; margin-bottom: 2.8rem; }
.garden__intro h2 { max-width: 690px; margin: 0; }
.garden__layout { display: grid; grid-template-columns: 1.06fr .72fr .75fr; grid-template-rows: auto auto; align-items: center; gap: 1.5rem; }
.garden figure { margin: 0; }
.image-frame { overflow: hidden; padding: .45rem; border: 1px solid var(--line); border-radius: var(--radius-md); }
.image-frame img { width: 100%; height: 100%; object-fit: cover; }
.garden__primary { grid-row: span 2; height: 590px; }
.garden__primary img { object-position: center; }
.garden__text { padding: 1rem 1.5rem 1rem 2rem; font-size: 1.04rem; }
.garden__text p { margin-bottom: 1.6rem; }
.garden__secondary { height: 230px; }
.garden__tertiary { grid-column: 2 / 4; height: 240px; }

.table-section { position: relative; padding-top: clamp(3.75rem, 5vw, 4.75rem); padding-bottom: 0; background: linear-gradient(to right, #d6c3a1 0%, #ffe6aaeb 55%
55%, #f0daa4ed 100%); color: #111213; }
.table-section .eyebrow { color: #7e2a34; }
.table-section__top { display: block; }
.table-section h2 { margin-bottom: 0; white-space: nowrap; }
.moments { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-top: clamp(1.8rem, 2.8vw, 2.5rem); }
.moment { padding-top: 1rem; border-top: 1px solid rgba(7, 30, 40, .3); }
.moment > span { color: #7e2a34; font-size: .73rem; letter-spacing: .09em; }
.moment h3 { margin: 1.3rem 0 .8rem; font-size: 2rem; }
.moment p { max-width: 290px; margin-bottom: 0; font-size: .91rem; }
.table-section__cta { display: flex; justify-content: center; padding-block: clamp(2.75rem, 5vw, 4.5rem); }
.menu-link-button { display: inline-flex; align-items: center; justify-content: center; gap: .8rem; min-height: 3.7rem; padding: .85rem 1.55rem; border: 2px solid rgba(240, 201, 119, .88); outline: 1px solid rgba(244, 239, 228, .8); outline-offset: -6px; background-color: #241309; box-shadow: 0 12px 24px rgba(52, 28, 9, .24); color: var(--cream); font-size: .76rem; font-weight: 700; letter-spacing: .1em; text-align: center; text-transform: uppercase; transition: transform .2s ease, box-shadow .2s ease, background-color .2s ease; }
.menu-link-button:hover { transform: translateY(-2px); box-shadow: 0 16px 28px rgba(52, 28, 9, .32); }
.menu-link-button:focus-visible { outline: 3px solid #7e2a34; outline-offset: 4px; }
.menu-link-button span { font-size: 1.05em; }
.pizza-showcase { --pizza-background: #000; --pizza-foreground: var(--cream); position: relative; margin-top: 0; overflow: clip; background: var(--pizza-background); color: var(--pizza-foreground); }
.pizza-showcase__sticky { padding: clamp(2.25rem, 5vw, 4.75rem) 0; }
.pizza-showcase__header { position: relative; min-height: 7.5rem; margin-bottom: clamp(.75rem, 1.6vw, 1.5rem); text-align: center; }
.pizza-showcase__header h3 { width: 100%; margin: 0; font-size: clamp(2.35rem, 4vw, 4.4rem); line-height: 1; white-space: nowrap; }
.pizza-showcase__viewport { width: 100%; overflow-x: clip; overflow-y: visible; }
.pizza-showcase__track { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: clamp(1.2rem, 2.6vw, 2.3rem); width: min(calc(100% - 3rem), var(--wrap)); margin: 0 auto; }
.pizza-card { min-width: 0; }
.pizza-card__disc { position: relative; display: grid; place-items: center; width: 100%; aspect-ratio: 1; overflow: visible; border: clamp(7px, 1vw, 12px) solid rgba(244, 239, 228, .9); border-radius: 50%; background: var(--cream); box-shadow: inset 0 0 0 1px rgba(7, 30, 40, .1), 0 16px 30px rgba(4, 20, 28, .18); }
.pizza-card__image { display: block; width: 78%; height: 78%; object-fit: contain; transform-origin: center; will-change: transform; }
.pizza-card__copy { padding: 1.1rem .15rem 0; }
.pizza-card__name { margin: 0; color: currentColor; font-family: var(--serif); font-size: clamp(1.7rem, 2.3vw, 2.55rem); font-weight: 400; line-height: .98; }
.pizza-card__ingredients { min-height: 3.2em; margin: .55rem 0 0; color: currentColor; font-family: var(--serif); font-size: .98rem; font-style: italic; line-height: 1.28; opacity: .9; }
.pizza-card__price-badge { position: absolute; z-index: 2; top: clamp(-2rem, -2.3vw, -1.15rem); right: clamp(-2rem, -2.3vw, -1.15rem); display: grid; place-items: center; width: clamp(4rem, 6.2vw, 5.5rem); aspect-ratio: 100 / 112; color: #0b1113; font-family: var(--sans); font-size: clamp(.65rem, 1vw, .88rem); font-weight: 700; letter-spacing: .02em; line-height: 1; white-space: nowrap; }
.pizza-card__price-mark { position: absolute; inset: 0; width: 100%; height: 100%; overflow: visible; }
.pizza-card__ribbon { fill: rgba(12, 17, 19, .1); stroke: #0b1113; stroke-linejoin: round; stroke-width: 2.25; }
.pizza-card__seal { fill: rgba(244, 239, 228, .93); stroke: #0b1113; stroke-linejoin: round; stroke-width: 2.8; }
.pizza-card__seal-line { fill: none; stroke: #0b1113; stroke-dasharray: 3 2.2; stroke-linejoin: round; stroke-width: 1.35; }
.pizza-card__price-text { position: relative; z-index: 1; transform: translateY(-.15rem); }
.pizza-showcase.is-enhanced { padding: 0; }
.pizza-showcase.is-enhanced .pizza-showcase__sticky { position: sticky; top: var(--pizza-sticky-offset, 5.7rem); display: flex; flex-direction: column; height: calc(100svh - var(--pizza-sticky-offset, 5.7rem)); min-height: 0; padding: clamp(1.2rem, 3vh, 2.25rem) 0; overflow: visible; }
.pizza-showcase.is-enhanced .pizza-showcase__header { flex: 0 0 auto; }
.pizza-showcase.is-enhanced .pizza-showcase__viewport { flex: 1 1 auto; min-height: 0; display: flex; align-items: center; padding-block: clamp(2rem, 5vh, 3.6rem) clamp(1.25rem, 3vh, 2.4rem); }
.pizza-showcase.is-enhanced .pizza-showcase__track { display: flex; align-items: flex-start; gap: clamp(2rem, 3vw, 3.5rem); width: max-content; max-width: none; margin: 0; padding-inline: max(1.5rem, calc((100vw - var(--wrap)) / 2)); }
.pizza-showcase.is-enhanced .pizza-card { flex: 0 0 clamp(18.5rem, 26vw, 27rem); }
.pizza-showcase.is-enhanced .pizza-card__disc { width: min(100%, min(44vh, 26vw)); margin-inline: auto; }
.pizza-info-band { width: 100%; overflow: hidden; background: linear-gradient(to right, #d6c3a1 0%, #ffe6aaeb 55% 55%, #f0daa4ed 100%); }
.pizza-info-band__papers { display: flex; align-items: center; justify-content: center; gap: clamp(1.4rem, 3vw, 2.85rem); height: clamp(9.4rem, 12vw, 11.5rem); padding: .6rem max(1.5rem, calc((100vw - var(--wrap)) / 2)); perspective: 800px; }
.pizza-info-band__paper { display: block; width: clamp(9.7rem, 11.5vw, 11.15rem); height: auto; transform-origin: 50% 8%; transform-style: preserve-3d; will-change: transform; filter: drop-shadow(0 5px 5px rgba(31, 24, 14, .14)); }
.pizza-info-band__paper--takeaway { animation: paper-breeze-takeaway 6.2s cubic-bezier(.45, .05, .55, .95) infinite; }
.pizza-info-band__paper--dine-in { animation: paper-breeze-dine-in 6.9s -1.1s cubic-bezier(.45, .05, .55, .95) infinite; }
.pizza-info-band__paper--hours { animation: paper-breeze-hours 5.8s -2s cubic-bezier(.45, .05, .55, .95) infinite; }
.pizza-info-band__checker { height: clamp(1.15rem, 1.65vw, 1.6rem); background-color: #fff; background-image: conic-gradient(#000 25%, #fff 0 50%, #000 0 75%, #fff 0); background-position: 0 0; background-size: 24px 24px; animation: checker-drift-left 6.5s linear infinite; }

.living {
  position: relative;
  isolation: isolate;
  display: grid;
  grid-template-columns: 1fr 1fr;
  align-items: center;
  gap: clamp(2.75rem, 5vw, 4.5rem);
  padding-block: clamp(3.25rem, 4.5vw, 4.5rem);
  overflow: hidden;
  color: var(--cream);
  background-color: #061f2a; /* fallback */
  background-image:
    /* darker blotches */
    radial-gradient(ellipse 14% 50% at 20% 40%, rgba(0, 0, 0, 0.35), transparent 70%),
    radial-gradient(ellipse 12% 45% at 58% 30%, rgba(0, 0, 0, 0.25), transparent 70%),
    radial-gradient(ellipse 12% 45% at 60% 80%, rgba(0, 0, 0, 0.25), transparent 70%),
    radial-gradient(ellipse 10% 45% at 95% 45%, rgba(0, 0, 0, 0.22), transparent 70%),
    /* slightly lighter petrol areas */
    radial-gradient(ellipse 30% 60% at 80% 25%, rgba(11, 67, 83, 0.40), transparent 70%),
    radial-gradient(ellipse 25% 60% at 40% 85%, rgba(11, 67, 83, 0.30), transparent 70%),
    /* base */
    linear-gradient(90deg, #04202b 0%, #062833 50%, #05232f 100%);
}

/* paper grain + speckles */
.living::before {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  pointer-events: none;
  opacity: 0.55;
  mix-blend-mode: overlay;
  background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='300' height='300'><filter id='n'><feTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='3' stitchTiles='stitch'/><feColorMatrix values='0 0 0 0 0  0 0 0 0 0  0 0 0 0 0  0 0 0 0.9 0'/></filter><rect width='100%' height='100%' filter='url(%23n)'/></svg>");
}

/* faint horizontal paper fibers */
.living::after {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  pointer-events: none;
  background-image: repeating-linear-gradient(
    0deg,
    rgba(255, 255, 255, 0.025) 0 1px,
    transparent 1px 3px
  );
}

.living__images { position: relative; z-index: 1; min-height: clamp(22.5rem, 28vw, 25rem); }
.living__images figure { position: absolute; margin: 0; overflow: hidden; border-radius: var(--radius-md); }
.living__images figure:first-child { top: 0; left: 0; width: 62%; height: clamp(21rem, 27vw, 24rem); }
.living__images figure:last-child { right: 0; bottom: 0; width: 42%; height: clamp(10.75rem, 14vw, 12rem); border: 8px solid #0a2d38; }
.living__images img { width: 100%; height: 100%; object-fit: cover; }
.living__images figure:first-child img { object-position: center; }
.living__images figure:last-child img { object-position: bottom; }
.living__copy { position: relative; z-index: 1; max-width: 440px; }
.living__copy h2 { margin-bottom: 1.35rem; }
.living__copy > p:last-child { margin-bottom: 0; font-size: 1.04rem; }

.events { position: relative; padding-block: clamp(3.25rem, 4.5vw, 4.5rem); overflow: hidden; background-color: #0b4353; color: var(--cream); }
.events__inner { display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1fr); align-items: center; gap: clamp(2.5rem, 4vw, 4rem); }
.events__image { width: min(100%, 30rem); aspect-ratio: 1 / 1; overflow: hidden; border-radius: var(--radius-md); }
.events__image img { width: 100%; height: 100%; object-fit: cover; object-position: center 46%; }
.events__content { align-self: center; max-width: 520px; }
.events__content h2 { max-width: 11ch; margin-bottom: 1.1rem; font-size: clamp(3rem, 4.2vw, 5rem); line-height: .95; }
.events__content > p { max-width: 500px; margin-bottom: 1.55rem; font-size: 1.02rem; }
.events__actions { display: flex; align-items: stretch; gap: .8rem; }
.events__actions .button { flex: 1 1 0; min-width: 0; padding-inline: .85rem; }
.events .button { border-color: rgba(244, 239, 228, .82); background: var(--ink); box-shadow: inset 0 0 0 3px var(--ink), inset 0 0 0 4px rgba(198, 165, 106, .66), 0 0 0 3px rgba(244, 239, 228, .18); color: var(--cream); }
.events .button--cream { background: var(--cream); color: var(--ink); box-shadow: inset 0 0 0 3px var(--cream), inset 0 0 0 4px var(--gold), 0 0 0 3px rgba(244, 239, 228, .18); }
.events .button::after { border-color: rgba(244, 239, 228, .2); }
.events .button:hover { background: #143f4e; box-shadow: inset 0 0 0 3px #143f4e, inset 0 0 0 4px var(--gold), 0 0 0 4px rgba(198, 165, 106, .36); color: var(--cream); }
.events .button--cream:hover { background: #fffaf0; color: var(--ink); }
.events .button:hover::after { border-color: rgba(244, 239, 228, .55); }
.events__private-button { overflow: visible; }
.events__private-tracer { position: absolute; z-index: 2; inset: -3px; width: calc(100% + 6px); height: calc(100% + 6px); overflow: visible; pointer-events: none; }
.events__private-tracer rect { fill: none; stroke: var(--gold-glint); stroke-width: 1.4; stroke-linecap: round; stroke-dasharray: 17 83; stroke-dashoffset: 0; filter: drop-shadow(0 0 2px rgba(214, 170, 60, .45)); animation: gold-trace 4.3s linear infinite; }
.events__private-button:hover .events__private-tracer rect { stroke: #ffe4a0; filter: drop-shadow(0 0 3px rgba(214, 170, 60, .65)); }

.pano { width: min(100%, 1680px); aspect-ratio: 2160 / 609; margin: 0 auto; overflow: hidden; border-radius: var(--radius-sm); background: #000; }
.pano img { width: 100%; height: 100%; object-fit: cover; object-position: center 44.5%; }
.gallery { position: relative; display: grid; grid-template-columns: 1fr 2.2fr; gap: 4rem; background-color: #061f2a; color: var(--cream); }
.gallery__heading { position: sticky; top: 8rem; align-self: start; }
.gallery__heading h2 { margin-bottom: 0; }
.gallery__grid { display: grid; grid-template-columns: repeat(2, 1fr); grid-auto-rows: 205px; gap: 1rem; }
.gallery__item { margin: 0; overflow: hidden; border-radius: var(--radius-sm); background: #061f2a; }
.gallery__item img { width: 100%; height: 100%; object-fit: cover; transition: transform .6s ease, filter .6s; }
.gallery__item:hover img { transform: scale(1.035); filter: brightness(1.06); }
.gallery__item--tall { grid-row: span 2; }
.gallery__item--wide { grid-column: span 2; }
.gallery__item:nth-child(2) img { object-position: center 45%; }

.reserve-band { position: relative; overflow: hidden; padding: 0; background: linear-gradient(to right, #d6c3a1 0%, #ffe6aaeb 55% 55%, #f0daa4ed 100%); color: var(--accent-pink); }
.reserve-band__inner { position: relative; z-index: 1; display: grid; place-items: center; min-height: clamp(10.5rem, 13vw, 12.5rem); padding-block: 1.25rem; text-align: center; }
.reserve-band__inner .eyebrow { margin-bottom: .28rem; color: var(--accent-pink); font-size: .61rem; }
.reserve-band__inner h2 { margin: 0 0 .28rem; color: var(--accent-pink); font-size: clamp(2rem, 3.2vw, 3.25rem); }
.reserve-band__inner > p:not(.eyebrow) { margin-bottom: .72rem; color: var(--accent-pink); font-size: .9rem; font-weight: 600; }
.reserve-band__inner > div { display: flex; align-items: center; justify-content: center; gap: 1rem; }
.reserve-band .button { min-height: 2.7rem; border-color: var(--accent-pink); background: var(--accent-pink); box-shadow: inset 0 0 0 3px var(--accent-pink), inset 0 0 0 4px rgba(244, 239, 228, .76), 0 0 0 2px rgba(212, 0, 95, .22); color: var(--cream); }
.reserve-band .button:hover { background: #af0050; box-shadow: inset 0 0 0 3px #af0050, inset 0 0 0 4px rgba(244, 239, 228, .82), 0 0 0 3px rgba(212, 0, 95, .22); }
.reserve-band .text-link--light { color: var(--accent-pink); }
.reserve-band__checker { position: relative; z-index: 1; height: clamp(1.15rem, 1.65vw, 1.6rem); background-color: #fff; background-image: conic-gradient(#000 25%, #fff 0 50%, #000 0 75%, #fff 0); background-position: 0 0; background-size: 24px 24px; animation: checker-drift-left 6.5s linear infinite; }

.info { position: relative; overflow: hidden; display: grid; grid-template-columns: .85fr 1.7fr; gap: 5rem; background: #06090b; color: var(--cream); }
.info__intro h2 { margin-bottom: 0; }
.info__details { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; }
.info h3 { margin-bottom: 1rem; color: var(--cream); font-family: var(--sans); font-size: .9rem; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; }
.info address { margin-bottom: 1rem; font-style: normal; }
.info-link { display: block; margin-bottom: .7rem; font-size: .9rem; text-decoration: underline; text-decoration-thickness: 1px; text-underline-offset: 4px; }
.info-link--icon { display: flex; align-items: center; gap: .55rem; min-height: 2.75rem; text-decoration: none; }
.info-link--icon span { border-bottom: 1px solid currentColor; }
.info-link--icon svg { width: 1rem; height: 1rem; flex: 0 0 1rem; fill: none; stroke: var(--gold); stroke-width: 1.7; }
.hours h3 + p { margin-bottom: 1.45rem; }
.hours p { margin: 0; font-size: .88rem; }
.map-section { position: relative; overflow: hidden; padding-top: 0; padding-bottom: clamp(4.5rem, 7vw, 6.5rem); background: #06090b; color: var(--cream); }
.map-section__head { display: flex; align-items: end; justify-content: space-between; margin-bottom: 1.5rem; }
.map-section__head .eyebrow { margin-bottom: .4rem; }
.map-section__head h2 { margin: 0; font-size: clamp(2.3rem, 4vw, 4rem); }
.map-frame { height: 460px; overflow: hidden; border: 1px solid rgba(244, 239, 228, .22); border-radius: var(--radius-md); background: var(--petrol); }
.map-frame iframe { width: 100%; height: 100%; border: 0; filter: saturate(.75) contrast(.95); }

/* ============================================
   SITE FOOTER — two centered lines: © then "par [logo]"
   ============================================ */
.site-footer { padding: 3rem 0; background: #000; color: var(--cream); text-align: center; }
.site-footer .wrap { display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; }
.site-footer__line, .site-footer__credit { margin: 0; font-size: .75rem; letter-spacing: .05em; line-height: 1.6; }
.site-footer__credit { display: inline-flex; align-items: center; justify-content: center;}
.site-footer__logo { display: inline-flex; align-items: center; text-decoration: none; }
.site-footer__logo img { height: 33px; width: auto; display: block; }

.reveal { opacity: 0; transform: translateY(20px); transition: opacity .7s ease, transform .7s ease; }
.reveal.is-visible { opacity: 1; transform: none; }
@keyframes hero-enter { from { opacity: 0; transform: scale(1.035); } to { opacity: 1; transform: scale(1); } }
@keyframes rise { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: none; } }
@keyframes gold-trace { to { stroke-dashoffset: -100; } }
@keyframes checker-drift-left { to { background-position: -24px 0; } }
@keyframes paper-breeze-takeaway {
  0%, 100% { transform: translate3d(0, 0, 0) rotateZ(-2.1deg) rotateX(0deg) rotateY(0deg); }
  27% { transform: translate3d(1px, 1px, 0) rotateZ(-1.35deg) rotateX(.7deg) rotateY(.35deg); }
  55% { transform: translate3d(-1px, 0, 0) rotateZ(-2.65deg) rotateX(-.35deg) rotateY(-.45deg); }
  78% { transform: translate3d(1px, 1px, 0) rotateZ(-1.6deg) rotateX(.4deg) rotateY(.2deg); }
}
@keyframes paper-breeze-dine-in {
  0%, 100% { transform: translate3d(0, 0, 0) rotateZ(1.45deg) rotateX(.1deg) rotateY(0deg); }
  27% { transform: translate3d(-1px, 1px, 0) rotateZ(.65deg) rotateX(1.1deg) rotateY(-.45deg); }
  55% { transform: translate3d(1px, 0, 0) rotateZ(2.45deg) rotateX(-.5deg) rotateY(.5deg); }
  78% { transform: translate3d(-1px, 1px, 0) rotateZ(1deg) rotateX(.65deg) rotateY(-.25deg); }
}
@keyframes paper-breeze-hours {
  0%, 100% { transform: translate3d(0, 0, 0) rotateZ(-1.15deg) rotateX(0deg) rotateY(0deg); }
  27% { transform: translate3d(1px, 1px, 0) rotateZ(-.35deg) rotateX(.55deg) rotateY(.65deg); }
  55% { transform: translate3d(-1px, 0, 0) rotateZ(-1.95deg) rotateX(-.25deg) rotateY(-.55deg); }
  78% { transform: translate3d(1px, 1px, 0) rotateZ(-.65deg) rotateX(.4deg) rotateY(.35deg); }
}

@media (max-width: 900px) {
  .site-nav { gap: .9rem; }
  .site-nav > a:not(.button) { font-size: .67rem; }
  .site-nav__actions { gap: .45rem; }
  .site-nav__actions .button { padding-inline: .7rem; font-size: .62rem; }
  .garden__layout { grid-template-columns: 1fr 1fr; }
  .garden__primary { height: 530px; }
  .garden__text { padding: 1rem; }
  .garden__secondary { display: none; }
  .garden__tertiary { grid-column: 2; height: 235px; }
  .living { gap: 3.5rem; }
  .gallery { gap: 2rem; }
  .info { gap: 3rem; }
}

@media (min-width: 901px) {
  .garden { padding-block: clamp(2.75rem, 3.8vw, 3.75rem); }
  .garden__intro { display: block; margin-bottom: clamp(1.1rem, 2vw, 1.65rem); }
  .garden__intro .eyebrow { margin-bottom: .55rem; }
  .garden__intro h2 { max-width: none; margin: 0; font-size: clamp(2.2rem, 3vw, 3.5rem); white-space: nowrap; }
  .garden__layout { gap: clamp(1rem, 1.65vw, 1.5rem); }
  .garden__primary { height: clamp(19rem, 27vw, 25.5rem); }
  .garden__secondary { height: clamp(9.5rem, 12vw, 11.5rem); }
  .garden__tertiary { height: clamp(8rem, 10.5vw, 10.75rem); }
  .garden__text { padding: .7rem 1rem .7rem 1.35rem; font-size: .96rem; }
  .garden__text p { margin-bottom: .85rem; }
}

@media (max-width: 1100px) and (min-width: 701px) {
  .pizza-showcase__track { grid-template-columns: repeat(2, minmax(0, 1fr)); }
  .pizza-showcase.is-enhanced .pizza-card { flex-basis: clamp(19rem, 42vw, 25rem); }
  .pizza-showcase.is-enhanced .pizza-card__disc { width: min(100%, min(44vh, 39vw)); }
}

@media (max-width: 820px) and (min-width: 701px) {
  .events__inner { grid-template-columns: minmax(0, 600px); justify-content: center; }
  .events__content { max-width: 600px; }
}

@media (max-width: 700px) {
  .wrap { width: min(calc(100% - 2.2rem), var(--wrap)); }
  .section { padding-block: clamp(3.3rem, 14vw, 4.5rem); }
  .site-header { height: 4.9rem; padding: 0 1.1rem; }
  .brand { width: 145px; height: 43px; }
  .menu-toggle { display: block; z-index: 12; }

  .site-nav {
    position: fixed;
    z-index: 11;
    inset: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    gap: 1.4rem;
    padding: 6rem 2rem 3rem;
    background: #000;
    text-align: center;
    overflow-y: auto;
    opacity: 0;
    visibility: hidden;
    transform: translateX(100%);
    transition: opacity .25s, visibility .25s, transform .25s;
  }
  .site-nav.is-open { opacity: 1; visibility: visible; transform: none; }

  .brand.site-nav__brand {
    display: block;
    width: 180px;
    height: 54px;
    margin: 0 0 1.4rem;
    flex: 0 0 auto;
  }
  .brand.site-nav__brand img { width: 100%; height: 100%; object-fit: contain; }

  .site-nav > a:not(.button):not(.site-nav__brand) {
    width: 100%;
    font-family: var(--serif);
    font-size: 2.1rem;
    font-weight: 400;
    letter-spacing: -.02em;
    line-height: 1.15;
    text-transform: none;
  }

  .site-nav__actions {
    display: flex;
    flex-direction: column;
    align-self: stretch;
    gap: .75rem;
    margin-top: 1.2rem;
    width: 100%;
  }
  .site-nav__actions .button {
    width: 100%;
    min-height: 3.5rem;
    margin-top: 0;
    padding: .85rem 1rem;
    font-size: 1rem;
    letter-spacing: .07em;
    line-height: 1.2;
  }

  .brand.site-nav__brand            { order: 0; }
  .site-nav > a[href="#jardin"]     { order: 1; }
  .site-nav > a[href="#evenements"] { order: 2; }
  .site-nav > a[href="#infos"]      { order: 3; }
  .site-nav > a[href="carte.html"]  { order: 4; }
  .site-nav__actions                { order: 5; }

  .menu-open { overflow: hidden; }

  .hero { min-height: min(100svh, 760px); }
  .hero__image { object-position: center 46%; }
  .hero__content { padding-bottom: 3.6rem; }
  .hero h1 { margin-bottom: 1.15rem; font-size: clamp(3rem, 12.8vw, 4.3rem); line-height: 1.04; }
  .hero__lede { max-width: 360px; font-size: 1rem; }
  .hero__actions { flex-direction: column; align-items: flex-start; gap: 1.2rem; }
  .hero__scroll { display: none; }

  .story, .living, .gallery, .info, .map-section { padding-inline: 1.1rem; }
  .story { min-height: 190svh; }
  .story__sticky { min-height: 100svh; padding-block: 5.75rem 4.5rem; }
  .story__lines { width: 100%; }
  .story__line { margin-bottom: .62rem; font-size: clamp(1.7rem, 7.5vw, 2.8rem); line-height: 1.08; }
  .story__line--welcome { margin-top: 1.25rem; font-size: clamp(1.8rem, 7.8vw, 2.9rem); }
  .garden__intro { display: block; margin-bottom: 2rem; }
  .garden__layout { display: block; }
  .garden__primary { height: 430px; margin-bottom: 1.35rem !important; }
  .garden__text { padding: 0 0 2rem; font-size: 1rem; }
  .garden__tertiary { height: 185px; margin-top: 1.25rem !important; }
  .table-section { padding-bottom: 0; }
  .table-section__top { display: block; }
  .table-section h2 { white-space: normal; }
  .moments { grid-template-columns: 1fr; gap: 1rem; margin-top: 2.4rem; }
  .moment h3 { margin: 1rem 0 .6rem; }
  .moment p { max-width: 430px; }

  .pizza-showcase { margin-top: 2.5rem; }
  .pizza-showcase__sticky { padding-block: 2.7rem; }
  .pizza-showcase__header { min-height: 0; margin-bottom: 1.25rem; }
  .pizza-showcase__header h3 { max-width: 11ch; margin-inline: auto; font-size: clamp(2.35rem, 10.4vw, 3.25rem); white-space: normal; }
  .pizza-showcase__track { grid-template-columns: 1fr; width: min(calc(100% - 2.2rem), var(--wrap)); gap: 2.25rem; }
  .pizza-card__ingredients { min-height: 0; font-size: 1rem; }
  .pizza-card__price-badge { top: -1.35rem; right: -1.25rem; width: 3.85rem; font-size: .66rem; }
  .pizza-showcase.is-enhanced .pizza-showcase__sticky { padding-block: 1rem; }
  .pizza-showcase.is-enhanced .pizza-showcase__header { margin-bottom: .65rem; }
  .pizza-showcase.is-enhanced .pizza-showcase__viewport { padding-block: 1.65rem 1rem; }
  .pizza-showcase.is-enhanced .pizza-showcase__track { gap: 1.1rem; padding-inline: 1.1rem; }
  .pizza-showcase.is-enhanced .pizza-card { flex-basis: min(84vw, 22rem); }
  .pizza-showcase.is-enhanced .pizza-card__disc { width: min(100%, 56vh); }
  .pizza-info-band__papers { gap: clamp(.45rem, 2.6vw, .9rem); height: clamp(6.9rem, 28vw, 7.5rem); padding-inline: .9rem; }
  .pizza-info-band__paper { width: clamp(4.9rem, 26vw, 6.4rem); }
  .pizza-info-band__checker { height: 1.05rem; background-size: 18px 18px; animation-name: checker-drift-left-mobile; }

  .living { display: flex; flex-direction: column-reverse; gap: 2.5rem; }
  .living__images { align-self: stretch; min-height: 420px; }
  .living__images figure:first-child { width: 68%; height: 390px; }
  .living__images figure:last-child { width: 45%; height: 190px; }
  .events__inner { display: block; width: 100%; }
  .events__image { min-height: 0; width: 100%; }
  .events__content { width: 100%; padding: 3rem 1.1rem 0; }
  .events__content h2 { max-width: 100%; font-size: clamp(3rem, 13vw, 4rem); }
  .events__content > p { margin-bottom: 1.5rem; font-size: 1rem; }
  .events__actions { flex-direction: column; }
  .events__actions .button { width: 100%; min-height: 3.45rem; }

  .pano { width: min(calc(100% - 2.2rem), var(--wrap)); }
  .gallery { display: block; }
  .gallery__heading { position: static; margin-bottom: 2rem; }
  .gallery__grid { grid-auto-rows: 150px; gap: .65rem; }

  .reserve-band__inner { min-height: 0; padding: 2.7rem 1.1rem; }
  .reserve-band__inner h2 { font-size: clamp(2.1rem, 11vw, 3rem); }
  .reserve-band__inner > div { flex-direction: column; gap: 1.1rem; }
  .reserve-band__checker { height: 1.05rem; background-size: 18px 18px; animation-name: checker-drift-left-mobile; }

  .info { display: block; }
  .info__intro { margin-bottom: 2.7rem; }
  .info__details { grid-template-columns: 1fr; gap: 2rem; }
  .info h3 { font-size: .86rem; }
  .map-section { padding-top: 0; padding-bottom: 4rem; }
  .map-section__head { display: block; }
  .map-frame { height: 340px; }

  .site-footer .wrap { display: flex; flex-direction: column; align-items: center; text-align: center; }
  .site-footer__line, .site-footer__credit { line-height: 1.7; }
}

@media (max-width: 360px) {
  .hero h1 { font-size: 2.95rem; }
  .events__content h2 { font-size: 2.85rem; }
  .button { padding-inline: .8rem; font-size: .68rem; }
}

@media (prefers-reduced-motion: reduce) {
  html { scroll-behavior: auto; }
  *, *::before, *::after { animation-duration: .01ms !important; animation-iteration-count: 1 !important; transition-duration: .01ms !important; }
  .reveal { opacity: 1; transform: none; }
  .story { min-height: 0; }
  .story__sticky { position: relative; min-height: 0; }
  .story__char { opacity: 1 !important; }
  .events__private-tracer rect { animation: none; stroke: var(--gold); stroke-dasharray: 100 0; stroke-dashoffset: 0; filter: none; }
  .pizza-info-band__paper, .pizza-info-band__checker, .reserve-band__checker { animation: none !important; }
}

@keyframes checker-drift-left-mobile { to { background-position: -18px 0; } }
  </style>
  
  <script type="application/ld+json">
  {"@context":"https://schema.org","@type":"Restaurant","name":"La Kermesse","description":"Bar-restaurant avec jardin et terrasse à Rennes.","address":{"@type":"PostalAddress","streetAddress":"121 Rue de Vern","postalCode":"35200","addressLocality":"Rennes","addressCountry":"FR"},"telephone":"+33982684417","sameAs":["https://www.instagram.com/la_kermesse_rennes/?hl=fr"],"servesCuisine":"Cuisine de saison, tapas"}
  </script>
</head>
<body>
  <a class="skip-link" href="#main">Aller au contenu</a>
  <header class="site-header" data-header>
  <a class="brand" href="#top" aria-label="La Kermesse — accueil"><img src="assets/images/la-kermesse-logo.svg" alt="La Kermesse"></a>
  <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="site-menu"><span></span><span></span><span class="sr-only">Ouvrir le menu</span></button>
  <nav id="site-menu" class="site-nav" aria-label="Navigation principale">
    <a class="brand site-nav__brand" href="#top" aria-label="La Kermesse — accueil">
      <img src="assets/images/la-kermesse-logo.svg" alt="La Kermesse">
    </a>
    <a href="#jardin">Le Jardin</a>
    <a href="#evenements">Événements</a>
    <a href="#infos">Infos</a>
    <a href="carte.html">La Carte</a>
    <div class="site-nav__actions">
        <a class="button button--nav site-nav__event-button" href="reservation-groupes.php">Organiser un événement 
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><circle cx="12" cy="9" r="4" fill="currentColor"/><circle cx="17" cy="9" r="3" fill="currentColor"/><circle cx="7" cy="9" r="3" fill="currentColor"/><path fill="currentColor" fill-rule="evenodd" d="M17.569 18h2.326c.592 0 1.045-.51.902-1.084C20.428 15.446 19.448 13 17 13c-.886 0-1.58.32-2.122.8c1.508.977 2.287 2.69 2.69 4.2m-8.446-4.2A3.1 3.1 0 0 0 7 13c-2.448 0-3.428 2.446-3.797 3.916c-.143.574.31 1.084.902 1.084h2.327c.403-1.51 1.182-3.223 2.69-4.2" clip-rule="evenodd"/><path fill="currentColor" d="M12 14c3.709 0 4.666 3.301 4.914 5.006c.08.547-.362.994-.914.994H8c-.552 0-.993-.447-.914-.994C7.334 17.301 8.291 14 12 14"/></svg>
		</a>
        <a class="button button--nav" href="reservation.php">Réserver une table 
		<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="currentColor"><path d="M7.75 2.5C7.75 2.08579 7.41421 1.75 7 1.75C6.58579 1.75 6.25 2.08579 6.25 2.5V4.07926C4.81067 4.19451 3.86577 4.47737 3.17157 5.17157C2.47737 5.86577 2.19451 6.81067 2.07926 8.25H21.9207C21.8055 6.81067 21.5226 5.86577 20.8284 5.17157C20.1342 4.47737 19.1893 4.19451 17.75 4.07926V2.5C17.75 2.08579 17.4142 1.75 17 1.75C16.5858 1.75 16.25 2.08579 16.25 2.5V4.0129C15.5847 4 14.839 4 14 4H10C9.16097 4 8.41527 4 7.75 4.0129V2.5Z"/><path fill-rule="evenodd" d="M2 12C2 11.161 2 10.4153 2.0129 9.75H21.9871C22 10.4153 22 11.161 22 12V14C22 17.7712 22 19.6569 20.8284 20.8284C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.8284C2 19.6569 2 17.7712 2 14V12ZM17 14C17.5523 14 18 13.5523 18 13C18 12.4477 17.5523 12 17 12C16.4477 12 16 12.4477 16 13C16 13.5523 16.4477 14 17 14ZM17 18C17.5523 18 18 17.5523 18 17C18 16.4477 17.5523 16 17 16C16.4477 16 16 16.4477 16 17C16 17.5523 16.4477 18 17 18ZM13 13C13 13.5523 12.5523 14 12 14C11.4477 14 11 13.5523 11 13C11 12.4477 11.4477 12 12 12C12.5523 12 13 12.4477 13 13ZM13 17C13 17.5523 12.5523 18 12 18C11.4477 18 11 17.5523 11 17C11 16.4477 11.4477 16 12 16C12.5523 16 13 16.4477 13 17ZM7 14C7.55228 14 8 13.5523 8 13C8 12.4477 7.55228 12 7 12C6.44772 12 6 12.4477 6 13C6 13.5523 6.44772 14 7 14ZM7 18C7.55228 18 8 17.5523 8 17C8 16.4477 7.55228 16 7 16C6.44772 16 6 16.4477 6 17C6 17.5523 6.44772 18 7 18Z" clip-rule="evenodd"/></g></svg>
		</a>
      </div>
  </nav>
</header>

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
          <a class="button" href="reservation.php">Réserver une table 
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
          <a class="text-link" href="reservation.php">Réserver au jardin <span aria-hidden="true">→</span></a>
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
        <a class="menu-link-button" href="carte.html">Découvrez notre carte <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="square" stroke-width="2" d="M8.272 8h7.778v7.778m-.88-6.899l-7.146 7.147"/></svg></a>
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
        <div class="events__content reveal"><p class="eyebrow">Quand le jardin s’anime</p><h2 id="events-title">Plus qu’un verre,<br>un rendez-vous.</h2><p>DJ sets, concerts, blind tests, stand-up, impro et soirées sport : La programmation évolue au fil des semaines.</p><div class="events__actions"><a class="button button--cream" href="https://www.instagram.com/la_kermesse_rennes/?hl=fr" target="_blank" rel="noopener">Suivre les prochains rendez-vous <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="square" stroke-width="2" d="M8.272 8h7.778v7.778m-.88-6.899l-7.146 7.147"/></svg></a><a class="button events__private-button" href="reservation-groupes.php"><svg class="events__private-tracer" viewBox="0 0 100 42" preserveAspectRatio="none" aria-hidden="true" focusable="false"><rect x="1" y="1" width="98" height="40" pathLength="100" /></svg>Organiser un événement 
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

    <section class="reserve-band section" aria-labelledby="reserve-title"><div class="wrap reserve-band__inner reveal"><p class="eyebrow">On vous garde une place ?</p><h2 id="reserve-title">Une table au jardin ?</h2><p>Réservez votre moment à La Kermesse.</p><div><a class="button button--cream" href="reservation.php">Réserver une table 
	<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="currentColor"><path d="M7.75 2.5C7.75 2.08579 7.41421 1.75 7 1.75C6.58579 1.75 6.25 2.08579 6.25 2.5V4.07926C4.81067 4.19451 3.86577 4.47737 3.17157 5.17157C2.47737 5.86577 2.19451 6.81067 2.07926 8.25H21.9207C21.8055 6.81067 21.5226 5.86577 20.8284 5.17157C20.1342 4.47737 19.1893 4.19451 17.75 4.07926V2.5C17.75 2.08579 17.4142 1.75 17 1.75C16.5858 1.75 16.25 2.08579 16.25 2.5V4.0129C15.5847 4 14.839 4 14 4H10C9.16097 4 8.41527 4 7.75 4.0129V2.5Z"/><path fill-rule="evenodd" d="M2 12C2 11.161 2 10.4153 2.0129 9.75H21.9871C22 10.4153 22 11.161 22 12V14C22 17.7712 22 19.6569 20.8284 20.8284C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.8284C2 19.6569 2 17.7712 2 14V12ZM17 14C17.5523 14 18 13.5523 18 13C18 12.4477 17.5523 12 17 12C16.4477 12 16 12.4477 16 13C16 13.5523 16.4477 14 17 14ZM17 18C17.5523 18 18 17.5523 18 17C18 16.4477 17.5523 16 17 16C16.4477 16 16 16.4477 16 17C16 17.5523 16.4477 18 17 18ZM13 13C13 13.5523 12.5523 14 12 14C11.4477 14 11 13.5523 11 13C11 12.4477 11.4477 12 12 12C12.5523 12 13 12.4477 13 13ZM13 17C13 17.5523 12.5523 18 12 18C11.4477 18 11 17.5523 11 17C11 16.4477 11.4477 16 12 16C12.5523 16 13 16.4477 13 17ZM7 14C7.55228 14 8 13.5523 8 13C8 12.4477 7.55228 12 7 12C6.44772 12 6 12.4477 6 13C6 13.5523 6.44772 14 7 14ZM7 18C7.55228 18 8 17.5523 8 17C8 16.4477 7.55228 16 7 16C6.44772 16 6 16.4477 6 17C6 17.5523 6.44772 18 7 18Z" clip-rule="evenodd"/></g></svg>
	</a><a class="text-link text-link--light" href="tel:+33982684417">09 82 68 44 17</a></div></div><div class="reserve-band__checker" aria-hidden="true"></div></section>

    <section class="map-section wrap reveal" style="padding-top:5%;" aria-labelledby="map-title"><div class="map-section__head"><p class="eyebrow">Le point de départ</p><h2 id="map-title">121, rue de Vern.</h2></div><div class="map-frame"><iframe title="Carte interactive : La Kermesse, 121 Rue de Vern, Rennes" src="https://www.google.com/maps?q=121+Rue+de+Vern,+35200+Rennes,+France&amp;z=15&amp;output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe></div></section>
	
    <section id="infos" class="info section wrap" aria-labelledby="info-title">
      <div class="info__intro reveal"><p class="eyebrow">Venir à La Kermesse</p><h2 id="info-title">On se retrouve<br>rue de Vern.</h2></div>
      <div class="info__details reveal"><div><h3>Nous trouver</h3><address>121 Rue de Vern<br>35200 Rennes</address><a class="text-link" href="https://www.google.com/maps/search/?api=1&query=121+Rue+de+Vern,+35200+Rennes,+France" target="_blank" rel="noopener">Ouvrir dans Google Maps <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="square" stroke-width="2" d="M8.272 8h7.778v7.778m-.88-6.899l-7.146 7.147"/></svg></a></div><div><h3>Nous contacter</h3><a class="info-link info-link--icon" href="tel:+33982684417"><svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M7.1 2.8 4.8 5.1c-.8.8-.8 2.2-.1 3.1 3.2 4.5 6.9 8.2 11.4 11.4.9.7 2.3.7 3.1-.1l2.3-2.3-3.4-3.4-2.2 1.6c-1.8-1.1-3.3-2.6-4.4-4.4l1.6-2.2-3.5-4z"/></svg><span>09 82 68 44 17</span></a><a class="info-link info-link--icon" href="https://www.instagram.com/la_kermesse_rennes/?hl=fr" target="_blank" rel="noopener"><svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.4" cy="6.6" r="1"/></svg><span>@la_kermesse_rennes <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="square" stroke-width="2" d="M8.272 8h7.778v7.778m-.88-6.899l-7.146 7.147"/></svg></span></a></div><div class="hours"><h3>Horaires restaurant</h3><p>Lun–mer · 09h–00h<br>Jeu–ven · 09h–01h<br>Sam · 17h–01h<br>Dim · Fermé</p><h3>Service cuisine</h3><p>Lun–mer · 12h–13h30 &amp; 18h30–21h30<br>Jeu–ven · 12h–13h30 &amp; 18h30–22h30<br>Sam · 18h30–22h30<br>Dim · Fermé</p></div></div>
    </section>

  </main>
  <footer class="site-footer">
<div class="wrap">
  <p class="site-footer__line">©2027 La Kermesse, Rennes - Tous droits réservés.</p>
  <p class="site-footer__credit">
    par
    <a class="site-footer__logo" href="https://midenflow.com" target="_blank" rel="noopener" aria-label="MidenFlow">
      <img src="assets/images/midenflow_logo.png" alt="www.midenflow.com">
    </a>
  </p>
</div>
</footer>

   <script src="assets/js/menu-data.js"></script>
  <!--<script src="assets/js/site.js?v=homepage-menu-link"></script>
  -->
  <script>
  // *** site.js ***
(() => {
  const header = document.querySelector('[data-header]');
  const menuButton = document.querySelector('.menu-toggle');
  const nav = document.querySelector('.site-nav');

  // ---------- Mobile menu toggle ----------
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

  // ---------- Header: transparent on load, black on scroll ----------
  if (header) {
    const THRESHOLD = 40;           // px before the black band appears
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

  // ---------- Reveal on scroll ----------
  const revealItems = document.querySelectorAll('.reveal');
  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver(entries => entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target);
      }
    }), { threshold: 0.12 });
    revealItems.forEach(item => observer.observe(item));
  } else {
    revealItems.forEach(item => item.classList.add('is-visible'));
  }

  // ---------- Story fade ----------
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

  // ---------- Pizzas: build the DOM from the data ----------
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

      item.className = 'pizza-card';
      disc.className = 'pizza-card__disc';
      pizzaImage.className = 'pizza-card__image';
      copy.className = 'pizza-card__copy';
      title.className = 'pizza-card__name';
      detail.className = 'pizza-card__ingredients';

      pizzaImage.src = image;
      pizzaImage.alt = `Pizza ${name}`;
      pizzaImage.loading = 'lazy';

      title.textContent = name;
      detail.textContent = ingredients;

      disc.append(pizzaImage, priceBadge);
      copy.append(title, detail);
      item.append(disc, copy);
      pizzaTarget.append(item);
    });
  }

  // ---------- Pizza showcase scroll animation ----------
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

  </script>
  
</body>
</html>
