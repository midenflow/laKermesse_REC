<?php
session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Réservez votre table à La Kermesse, 121 rue de Vern à Rennes.">
  <title>Réserver une table | La Kermesse Rennes</title>

<link rel="icon" href="./assets/images/la-kermesse-wordmark-transparent.png" sizes="32x32" />
<link rel="icon" href="./assets/images/la-kermesse-wordmark-transparent.png" sizes="192x192" />
<link rel="apple-touch-icon" href="./assets/images/la-kermesse-wordmark-transparent.png" />
<meta name="msapplication-TileImage" content="./assets/images/la-kermesse-wordmark-transparent.png" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600&family=DM+Serif+Display&display=swap" rel="stylesheet">

  <style>
  /* ============================================
     La Kermesse – Booking page styles
     ============================================ */

  :root {
    --ink: #071e28;
    --petrol: #0d3442;
    --night: #06171f;
    --cream: #f4efe4;
    --gold: #c6a56a;
    --coral: #ff7e78;
    --line: rgba(244, 239, 228, 0.22);
    --serif: "DM Serif Display", Georgia, serif;
    --sans: "DM Sans", Arial, sans-serif;
    --wrap: 760px;
    --radius: 0.3rem;
    --transition: 0.25s ease;
  }

  *, *::before, *::after { box-sizing: border-box; }
  html { scroll-behavior: smooth; }

  body {
    margin: 0;
    background: var(--night);
    color: var(--cream);
    font-family: var(--sans);
    font-size: 16px;
    line-height: 1.55;
    -webkit-font-smoothing: antialiased;
  }

  img { display: block; max-width: 100%; height: auto; }
  a   { color: inherit; text-decoration: none; }
  button { font: inherit; }

  .sr-only {
    position: absolute !important;
    width: 1px; height: 1px;
    padding: 0; margin: -1px;
    overflow: hidden; clip: rect(0,0,0,0);
    white-space: nowrap; border: 0;
  }

  .skip-link {
    position: fixed; z-index: 100; top: 1rem; left: 1rem;
    padding: 0.6rem 0.9rem;
    background: var(--cream); color: var(--ink);
    transform: translateY(-200%);
    transition: transform var(--transition);
  }
  .skip-link:focus { transform: none; }

  /* ---------- Layout ---------- */
  .shell {
    position: relative; isolation: isolate;
    display: grid; place-items: center;
    min-height: 100vh; padding: 2.5rem 1.25rem;
    background:
      linear-gradient(110deg, rgba(6,23,31,0.91), rgba(6,23,31,0.7)),
      url("./assets/images/14_garden_center_canopy.png") center / cover fixed no-repeat;
  }
  .shell::before {
    content: ""; position: absolute; inset: 0; z-index: -1;
    backdrop-filter: blur(3px);
  }

  .back-home {
    position: absolute; top: 1.7rem; left: clamp(1.25rem,4vw,4rem);
    z-index: 10; font-size: 0.75rem; font-weight: 600;
    letter-spacing: 0.06em; text-transform: uppercase;
    color: var(--cream); transition: opacity var(--transition);
  }
  .back-home:hover { opacity: 0.7; }

  .panel {
    position: relative; z-index: 1;
    width: min(100%, var(--wrap));
    padding: clamp(1.5rem,4vw,3rem);
    background: rgba(13,52,66,0.95);
    border: 1px solid var(--line);
    box-shadow: 0 30px 90px rgba(0,0,0,0.42);
  }

  /* ---------- Header ---------- */
  .panel__head { text-align: center; }
  .panel__logo {
    width: min(260px,70%); height: 52px;
    margin: 0 auto 0.4rem;
    object-fit: contain; object-position: center;
  }
  .eyebrow {
    margin: 0 0 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.13em;
    font-size: 0.69rem; font-weight: 600; line-height: 1.2;
    color: var(--gold);
  }
  .panel h1 {
    margin: 0.1rem 0 0.35rem;
    font-family: var(--serif); font-weight: 400;
    font-size: clamp(2.2rem,3.6vw,3.4rem);
    line-height: 1.06; letter-spacing: -0.03em;
  }
  .panel__lead {
    margin: 0; font-size: 0.95rem;
    color: rgba(244,239,228,0.85);
  }

  /* ---------- Notice ---------- */
  .notice {
    margin: 1.2rem 0 0; padding: 0.75rem 1rem;
    border-left: 2px solid var(--gold);
    background: rgba(6,23,31,0.32);
    font-size: 0.78rem; color: rgba(244,239,228,0.9);
  }

  /* ---------- Progress ---------- */
  .progress {
    display: flex; justify-content: space-between; gap: 1rem;
    list-style: none; margin: 1.7rem 0 1.5rem; padding: 0;
    border-top: 1px solid var(--line);
  }
  .progress li {
    display: flex; align-items: center; gap: 0.45rem;
    padding-top: 0.8rem;
    color: rgba(244,239,228,0.52);
    font-size: 0.68rem; font-weight: 600;
    letter-spacing: 0.05em; text-transform: uppercase;
  }
  .progress li span {
    display: grid; place-items: center;
    width: 1.35rem; height: 1.35rem;
    border: 1px solid currentColor; border-radius: 50%;
    font-size: 0.64rem;
  }
  .progress .is-current { color: var(--cream); }

  /* ---------- Alerts ---------- */
  .alert {
    margin-bottom: 1rem; padding: 0.75rem 1rem;
    border-left: 2px solid var(--coral);
    background: rgba(255,126,120,0.12);
    font-size: 0.82rem;
  }
  .alert--error   { border-left-color: var(--coral); }
  .alert--success { border-left-color: #59d581; background: rgba(89,213,129,0.12); }

  /* ---------- Steps ---------- */
  .step { transition: opacity var(--transition); }
  .step[hidden] { display: none !important; }
  .step h2 {
    margin: 0 0 0.85rem;
    font-family: var(--serif);
    font-size: clamp(1.9rem,3vw,2.5rem);
    font-weight: 400; letter-spacing: -0.02em;
  }

  /* ---------- Picker (date / time / party) ---------- */
  .picker {
    display: grid; grid-template-columns: 1.2fr 1fr 1fr;
    border: 1px solid rgba(244,239,228,0.75);
    border-radius: var(--radius);
    background: #fff; color: #182333;
    overflow: hidden;
  }
  .picker__cell {
    display: grid; gap: 0.16rem; min-width: 0;
    padding: 0.55rem 0.75rem;
    border-right: 1px solid #d5d8dd;
    cursor: pointer;
  }
  .picker__cell:last-child { border-right: 0; }
  .picker__label {
    font-size: 0.61rem; font-weight: 700;
    letter-spacing: 0.07em; text-transform: uppercase;
    color: #5d6875;
  }
  .picker input, .picker select {
    width: 100%; min-width: 0; padding: 0;
    border: 0; outline: 0; background: transparent;
    color: #182333; font: 500 0.96rem/1.35 var(--sans);
    cursor: pointer;
  }
  .picker input:focus, .picker select:focus { box-shadow: 0 2px 0 var(--gold); }
  .picker select:disabled { color: #777; cursor: wait; }
  .picker select option { color: #182333; background: #fff; }

  .picker__cell.has-error { background: rgba(255,126,120,0.1); }
  .picker__cell.has-error input,
  .picker__cell.has-error select { color: var(--coral); }

  .status {
    min-height: 1.25rem; margin: 0.55rem 0 0;
    font-size: 0.74rem; color: rgba(244,239,228,0.76);
  }

  /* ============================================
     LOCATION PICKER  (Intérieur / Extérieur)
     ============================================ */
  .location {
    margin-top: 1.6rem;
  }
  .location__heading {
    margin: 0 0 0.6rem;
    font-size: 0.61rem; font-weight: 700;
    letter-spacing: 0.07em; text-transform: uppercase;
    color: rgba(244,239,228,0.85);
  }
  .location__grid {
    display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;
  }
  .location__card {
    position: relative;
    display: block;
    background: #fff; color: #182333;
    border: 1px solid rgba(244,239,228,0.75);
    border-radius: var(--radius);
    cursor: pointer;
    overflow: hidden;
    transition: transform var(--transition), box-shadow var(--transition);
  }
  .location__card:hover { transform: translateY(-2px); }
  .location__card input[type="radio"] {
    position: absolute; opacity: 0; pointer-events: none;
  }
  .location__image {
    position: relative;
    aspect-ratio: 4 / 3;
    overflow: hidden;
    background: var(--petrol);
  }
  .location__image img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease, filter 0.35s ease;
  }
  .location__card:hover .location__image img { transform: scale(1.04); }

  .location__meta {
    display: flex; align-items: center; justify-content: space-between;
    gap: 0.6rem;
    padding: 0.7rem 0.85rem;
  }
  .location__title {
    font-family: var(--serif);
    font-size: 1.15rem; line-height: 1.1;
    letter-spacing: -0.01em;
  }
  .location__desc {
    display: block;
    margin-top: 0.15rem;
    font-size: 0.72rem;
    color: #5d6875;
  }
  .location__check {
    flex: 0 0 auto;
    display: grid; place-items: center;
    width: 1.5rem; height: 1.5rem;
    border-radius: 50%;
    border: 1px solid #d5d8dd;
    background: #fff;
    color: transparent;
    font-size: 0.85rem; line-height: 1;
    transition: background var(--transition), color var(--transition), border-color var(--transition);
  }

  /* Selected state */
  .location__card.is-selected {
    border-color: var(--gold);
    box-shadow:
      0 0 0 1px var(--gold),
      0 8px 24px rgba(198,165,106,0.25);
  }
  .location__card.is-selected .location__image img { filter: brightness(1.04); }
  .location__card.is-selected .location__check {
    background: var(--gold);
    border-color: var(--gold);
    color: #071e28;
  }

  /* Error state */
  .location.has-error .location__card {
    border-color: var(--coral);
  }
  .location.has-error .location__grid { outline: none; }

  .location__error {
    margin: 0.6rem 0 0;
    font-size: 0.72rem;
    color: var(--coral);
    min-height: 1rem;
  }

  /* ---------- Buttons ---------- */
  .btn {
    position: relative; isolation: isolate;
    display: inline-flex; align-items: center; justify-content: center;
    gap: 0.8rem; width: 100%; min-height: 3.45rem;
    padding: 0.9rem 1.4rem; margin-top: 0.55rem;
    background: #071e28; color: var(--cream);
    border: 1px solid rgba(244,239,228,0.82);
    box-shadow:
      inset 0 0 0 3px #071e28,
      inset 0 0 0 4px rgba(198,165,106,0.66),
      0 0 0 3px rgba(244,239,228,0.18);
    font-size: 0.78rem; font-weight: 600;
    letter-spacing: 0.105em; text-transform: uppercase;
    cursor: pointer;
    transition: transform var(--transition), background var(--transition),
                box-shadow var(--transition), color var(--transition);
  }
  .btn::after {
    content: ""; position: absolute; inset: 5px;
    border: 1px solid rgba(244,239,228,0.2);
    pointer-events: none;
    transition: inset var(--transition), border-color var(--transition);
  }
  .btn:hover:not(:disabled) {
    background: #143f4e;
    box-shadow:
      inset 0 0 0 3px #143f4e,
      inset 0 0 0 4px var(--gold),
      0 0 0 4px rgba(198,165,106,0.36);
    transform: translateY(-3px);
  }
  .btn:hover:not(:disabled)::after {
    inset: 3px; border-color: rgba(244,239,228,0.55);
  }
  .btn:disabled { opacity: 0.48; cursor: not-allowed; transform: none; }
  .btn:disabled:hover {
    background: #071e28;
    box-shadow:
      inset 0 0 0 3px #071e28,
      inset 0 0 0 4px rgba(198,165,106,0.66),
      0 0 0 3px rgba(244,239,228,0.18);
  }

  /* ---------- Back link ---------- */
  .link-back {
    margin: 0 0 1.4rem; padding: 0; border: 0; background: none;
    color: var(--cream); font-size: 0.74rem; font-weight: 600;
    letter-spacing: 0.05em; text-transform: uppercase;
    cursor: pointer; transition: opacity var(--transition);
  }
  .link-back:hover { opacity: 0.7; }

  /* ---------- Fields ---------- */
  .fields { display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem; }
  .field { display: grid; gap: 0.45rem; }
  .field--wide { grid-column: 1 / -1; }
  .field label {
    font-size: 0.74rem; font-weight: 600;
    letter-spacing: 0.04em; text-transform: uppercase;
  }
  .field .optional {
    font-weight: 400; text-transform: none;
    letter-spacing: 0; opacity: 0.7;
  }
  .field input, .field select, .field textarea {
    width: 100%;
    border: 1px solid rgba(244,239,228,0.45);
    border-radius: 0;
    background: rgba(6,23,31,0.35);
    color: var(--cream);
    padding: 0.85rem 0.8rem;
    font: 400 1rem/1.3 var(--sans);
    outline: none;
    transition: border-color var(--transition), box-shadow var(--transition);
  }
  .field input:focus, .field select:focus, .field textarea:focus {
    border-color: var(--gold);
    box-shadow: 0 0 0 3px rgba(198,165,106,0.25);
  }
  .field textarea { resize: vertical; min-height: 4.5rem; }
  .field-error {
    margin: 0; font-size: 0.72rem;
    color: var(--coral); min-height: 1rem;
  }
  .field.has-error input,
  .field.has-error select,
  .field.has-error textarea { border-color: var(--coral); }

  /* ---------- Summary ---------- */
  .summary {
    display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.5rem;
    margin: 1.6rem 0; padding: 1rem 0;
    border-top: 1px solid var(--line);
    border-bottom: 1px solid var(--line);
  }
  .summary div { font-size: 0.72rem; }
  .summary span {
    display: block; margin-bottom: 0.2rem;
    color: rgba(244,239,228,0.6);
    font-size: 0.62rem; font-weight: 600;
    letter-spacing: 0.07em; text-transform: uppercase;
  }

  /* ---------- Legal / phone ---------- */
  .legal, .phone-help {
    margin: 1.1rem 0; font-size: 0.76rem;
    color: rgba(244,239,228,0.76);
  }
  .phone-help a {
    text-decoration: underline; text-underline-offset: 3px;
    color: var(--cream); font-weight: 600;
  }

  /* ---------- Result ---------- */
  .result { text-align: center; }
  .result h2 { margin: 0.2rem 0 1rem; }
  .result p  { font-size: 1.05rem; }
  .reference {
    margin: 1.7rem auto; padding: 1rem; max-width: 320px;
    border: 1px solid var(--line);
  }
  .reference span {
    display: block; margin-bottom: 0.25rem;
    font-size: 0.65rem; font-weight: 600;
    letter-spacing: 0.08em; text-transform: uppercase;
  }
  .reference strong {
    font-family: var(--serif);
    font-size: 1.6rem; font-weight: 400;
  }

  /* ---------- Honeypot ---------- */
  .honeypot {
    position: absolute !important;
    left: -9999px !important;
    width: 1px; height: 1px; overflow: hidden;
  }

  /* ---------- Responsive ---------- */
  @media (max-width: 700px) {
    .shell { padding: 4.5rem 0 0; background-attachment: scroll; }
    .back-home { top: 1.3rem; left: 1.1rem; }
    .panel {
      min-height: calc(100vh - 4.5rem);
      padding: 1.25rem 1rem; border-inline: 0;
    }
    .panel__logo { height: 46px; }
    .panel h1    { font-size: 2.2rem; }

    .picker { grid-template-columns: 1fr; }
    .picker__cell {
      border-right: 0;
      border-bottom: 1px solid #d5d8dd;
    }
    .picker__cell:last-child { border-bottom: 0; }

    .location__grid { grid-template-columns: 1fr; gap: 0.8rem; }
    .location__title { font-size: 1.05rem; }

    .progress { margin: 1rem 0; }
    .progress li { font-size: 0.54rem; }
    .fields  { grid-template-columns: 1fr; }
    .summary { grid-template-columns: 1fr; }
    .btn     { font-size: 0.67rem; }
  }

  @media (max-width: 400px) {
    .panel h1 { font-size: 1.9rem; }
    .panel__lead { font-size: 0.85rem; }
  }
  </style>
</head>
<body class="booking-page">

  <a class="skip-link" href="#booking-panel">Aller au formulaire de réservation</a>

  <main class="shell">
    <a class="back-home" href="index.html">← Retour à La Kermesse</a>

    <section id="booking-panel" class="panel" aria-labelledby="booking-title">
      <header class="panel__head">
        <img class="panel__logo"
             src="assets/images/la-kermesse-wordmark-transparent.png"
             alt="La Kermesse" width="260" height="52">
        <p class="eyebrow">121 rue de Vern, Rennes</p>
        <h1 id="booking-title">On vous garde une table&nbsp;?</h1>
        <p class="panel__lead">Choisissez votre moment à La Kermesse.</p>
      </header>

      <p class="notice" id="demo-notice" hidden>
        Prototype de réservation — les réglages d’exploitation sont à confirmer avec l’équipe.
      </p>

      <ol class="progress" aria-label="Progression de la réservation">
        <li class="is-current" data-progress="1"><span>1</span>Votre table</li>
        <li data-progress="2"><span>2</span>Vos coordonnées</li>
        <li data-progress="3"><span>3</span>Confirmation</li>
      </ol>

      <div class="alert alert--error" id="global-error" role="alert" hidden></div>

      <form id="booking-form" novalidate>
        <input type="hidden" name="csrf" id="csrf-token"
               value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">

        <!-- ============ ÉTAPE 1 ============ -->
        <section class="step" data-step="1" aria-labelledby="step1-title">
          <h2 id="step1-title">Votre table</h2>

          <div class="picker" role="group" aria-label="Date, horaire et nombre de convives">
            <div class="picker__cell">
              <label class="picker__label" for="date">Date</label>
              <input type="date" id="date" name="date" required
                     aria-describedby="date-error" autocomplete="off">
              <p class="field-error" id="date-error" data-error-for="date" role="alert"></p>
            </div>

            <div class="picker__cell">
              <label class="picker__label" for="time">Horaire</label>
              <select id="time" name="time" required disabled aria-describedby="time-error">
                <option value="">Choisir</option>
              </select>
              <p class="field-error" id="time-error" data-error-for="time" role="alert"></p>
            </div>

            <div class="picker__cell">
              <label class="picker__label" for="partySize">Convives</label>
              <select id="partySize" name="partySize" required aria-describedby="party-error"></select>
              <p class="field-error" id="party-error" data-error-for="partySize" role="alert"></p>
            </div>
          </div>

          <p class="status" id="availability-status" aria-live="polite">
            Choisissez une date et le nombre de convives pour voir les disponibilités.
          </p>

          <!-- ============ NOUVEAU : EMPLACEMENT ============ -->
          <div class="location" id="location-picker" role="radiogroup"
               aria-label="Choisissez l’emplacement de votre table">
            <p class="location__heading" id="location-label">Emplacement</p>

            <div class="location__grid" aria-labelledby="location-label">

              <label class="location__card" data-location="inside">
                <input type="radio" name="location" value="inside"
                       aria-labelledby="loc-inside-title">
                <div class="location__image">
                  <img src="assets/images/06_indoor_room.png"
                       alt="Salle intérieure de La Kermesse"
                       loading="lazy" width="600" height="450">
                </div>
                <div class="location__meta">
                  <div>
                    <span class="location__title" id="loc-inside-title">Intérieur</span>
                    <span class="location__desc">Salle chaleureuse</span>
                  </div>
                  <span class="location__check" aria-hidden="true">✓</span>
                </div>
              </label>

              <label class="location__card" data-location="outside">
                <input type="radio" name="location" value="outside"
                       aria-labelledby="loc-outside-title">
                <div class="location__image">
                  <img src="assets/images/14_garden_center_canopy.png"
                       alt="Terrasse et jardin de La Kermesse"
                       loading="lazy" width="600" height="450">
                </div>
                <div class="location__meta">
                  <div>
                    <span class="location__title" id="loc-outside-title">Extérieur</span>
                    <span class="location__desc">Jardin &amp; terrasse</span>
                  </div>
                  <span class="location__check" aria-hidden="true">✓</span>
                </div>
              </label>

            </div>

            <p class="location__error" data-error-for="location" role="alert"></p>
          </div>

          <button type="button" class="btn" id="to-step-2" disabled>
            Continuer <span aria-hidden="true">→</span>
          </button>
        </section>

        <!-- ============ ÉTAPE 2 ============ -->
        <section class="step" data-step="2" hidden aria-labelledby="step2-title">
          <button type="button" class="link-back" data-back>
            ← Modifier votre moment
          </button>

          <h2 id="step2-title">Vos coordonnées</h2>

          <div class="fields">
            <div class="field">
              <label for="firstName">Prénom</label>
              <input type="text" id="firstName" name="firstName" maxlength="80"
                     autocomplete="given-name" required aria-describedby="firstName-error">
              <p class="field-error" id="firstName-error" data-error-for="firstName" role="alert"></p>
            </div>

            <div class="field">
              <label for="lastName">Nom</label>
              <input type="text" id="lastName" name="lastName" maxlength="80"
                     autocomplete="family-name" required aria-describedby="lastName-error">
              <p class="field-error" id="lastName-error" data-error-for="lastName" role="alert"></p>
            </div>

            <div class="field">
              <label for="email">E-mail</label>
              <input type="email" id="email" name="email" maxlength="160"
                     autocomplete="email" required aria-describedby="email-error">
              <p class="field-error" id="email-error" data-error-for="email" role="alert"></p>
            </div>

            <div class="field">
              <label for="phone">Téléphone</label>
              <input type="tel" id="phone" name="phone" maxlength="30"
                     autocomplete="tel" required aria-describedby="phone-error">
              <p class="field-error" id="phone-error" data-error-for="phone" role="alert"></p>
            </div>

            <div class="field field--wide">
              <label for="message">Une demande particulière <span class="optional">(optionnel)</span></label>
              <textarea id="message" name="message" rows="3" maxlength="1000"
                        aria-describedby="message-error"></textarea>
              <p class="field-error" id="message-error" data-error-for="message" role="alert"></p>
            </div>
          </div>

          <div class="summary" id="booking-summary" aria-live="polite"></div>

          <div class="honeypot" aria-hidden="true">
            <label for="website">Site web</label>
            <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
          </div>

          <p class="legal">
            Vos coordonnées servent uniquement à gérer votre réservation. Elles ne sont ni cédées ni revendues.
          </p>

          <button type="submit" class="btn" id="submit-booking">
            Envoyer ma demande <span aria-hidden="true">→</span>
          </button>

          <p class="phone-help">
            Besoin d’aide ? <a href="tel:+33982684417">09 82 68 44 17</a>
          </p>
        </section>
      </form>

      <!-- ============ ÉTAPE 3 ============ -->
      <section class="step result" data-step="3" hidden aria-live="polite" aria-labelledby="result-title">
        <p class="eyebrow">Votre demande est enregistrée</p>
        <h2 id="result-title">Merci&nbsp;!</h2>
        <p id="result-copy"></p>

        <div class="reference">
          <span>Référence</span>
          <strong id="result-reference">—</strong>
        </div>

        <p class="phone-help">
          Une question ? <a href="tel:+33982684417">09 82 68 44 17</a>
        </p>
        <a class="btn" href="index.html">Retour au site</a>
      </section>
    </section>
  </main>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
          integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
          crossorigin="anonymous"></script>

  <script>
  /* ============================================
     La Kermesse – Booking with jQuery
     ============================================ */
  (function ($) {
    "use strict";

    // ---------- CONFIG ----------
    const APP_CONFIG = {
      maxPartySize: 12,
      minDate: null,
      maxAdvanceDays: 60,
      slotInterval: 30,
      openingHours: {
        0: { lunch: ["12:00", "14:00"], dinner: null },
        1: null,
        2: { lunch: ["12:00", "14:00"], dinner: ["19:00", "22:00"] },
        3: { lunch: ["12:00", "14:00"], dinner: ["19:00", "22:00"] },
        4: { lunch: ["12:00", "14:00"], dinner: ["19:00", "22:00"] },
        5: { lunch: ["12:00", "14:00"], dinner: ["19:00", "22:00"] },
        6: { lunch: ["12:00", "14:00"], dinner: ["19:00", "22:00"] },
      },
      closedDates: [],
    };

    // ---------- DOM ----------
    const $form = $("#booking-form");
    const $date = $("#date");
    const $time = $("#time");
    const $party = $("#partySize");
    const $toStep2 = $("#to-step-2");
    const $submitBtn = $("#submit-booking");
    const $globalError = $("#global-error");
    const $availabilityStatus = $("#availability-status");
    const $summary = $("#booking-summary");
    const $csrf = $("#csrf-token");
    const $locationPicker = $("#location-picker");
    const $locationCards = $locationPicker.find(".location__card");
    const $locationRadios = $locationPicker.find('input[name="location"]');

    let selectedTime = "";
    let selectedLocation = "";

    // ---------- Helpers ----------
    function pad2(n) { return String(n).padStart(2, "0"); }

    function toLocalISODate(d) {
      return d.getFullYear() + "-" + pad2(d.getMonth() + 1) + "-" + pad2(d.getDate());
    }

    // ---------- Init ----------
    function init() {
      const today = new Date();
      const minDate = toLocalISODate(today);
      APP_CONFIG.minDate = minDate;
      $date.attr("min", minDate);

      const max = new Date(today);
      max.setDate(max.getDate() + APP_CONFIG.maxAdvanceDays);
      $date.attr("max", toLocalISODate(max));

      for (let i = 1; i <= APP_CONFIG.maxPartySize; i++) {
        $party.append(
          $("<option>", {
            value: i,
            text: i + (i === 1 ? " personne" : " personnes"),
          })
        );
      }
      $party.val("2");

      $date.val(minDate);
      refreshAvailability();
    }

    // ---------- Time slots ----------
    function generateTimeSlots(dateStr) {
      if (!dateStr) return [];
      const date = new Date(dateStr + "T12:00:00");
      if (isNaN(date.getTime())) return [];

      const day = date.getDay();
      const hours = APP_CONFIG.openingHours[day];
      if (!hours) return [];
      if (APP_CONFIG.closedDates.indexOf(dateStr) !== -1) return [];

      const slots = [];

      function addRange(start, end) {
        if (!start || !end) return;
        const sp = start.split(":"); const ep = end.split(":");
        const current = new Date(date);
        current.setHours(+sp[0], +sp[1], 0, 0);
        const endTime = new Date(date);
        endTime.setHours(+ep[0], +ep[1], 0, 0);

        while (current <= endTime) {
          slots.push(pad2(current.getHours()) + ":" + pad2(current.getMinutes()));
          current.setMinutes(current.getMinutes() + APP_CONFIG.slotInterval);
        }
      }

      if (hours.lunch)  addRange(hours.lunch[0],  hours.lunch[1]);
      if (hours.dinner) addRange(hours.dinner[0], hours.dinner[1]);

      const unique = [];
      slots.forEach(function (s) { if (unique.indexOf(s) === -1) unique.push(s); });
      unique.sort();
      return unique;
    }

    // ---------- Availability ----------
    function refreshAvailability() {
      const dateVal = $date.val();
      const partyVal = $party.val();

      if (!dateVal || !partyVal) {
        $time.prop("disabled", true).empty().append('<option value="">Choisir</option>');
        $toStep2.prop("disabled", true);
        $availabilityStatus.text("Choisissez une date et le nombre de convives pour voir les disponibilités.");
        return;
      }

      const slots = generateTimeSlots(dateVal);

      $time.empty().append('<option value="">Choisir</option>');
      selectedTime = "";
      updateStep1Button();

      if (slots.length === 0) {
        $time.prop("disabled", true);
        $availabilityStatus.text("Aucun créneau disponible. Essayez une autre date ou un autre nombre de convives.");
        return;
      }

      slots.forEach(function (slot) {
        $time.append($("<option>", { value: slot, text: slot }));
      });

      $time.prop("disabled", false);
      $availabilityStatus.text(slots.length + " créneau(x) disponible(s)");
    }

    // ---------- Step 1 button state ----------
    function updateStep1Button() {
      const ready = !!selectedTime && !!selectedLocation;
      $toStep2.prop("disabled", !ready);
    }

    // ---------- Errors ----------
    function showError(fieldId, message) {
      const $field = $("#" + fieldId);
      const $error = $('[data-error-for="' + fieldId + '"]');

      if (fieldId === "location") {
        $locationPicker.addClass("has-error");
      } else {
        $field.closest(".field, .picker__cell").addClass("has-error");
      }
      $error.text(message);
    }

    function clearError(fieldId) {
      const $field = $("#" + fieldId);
      const $error = $('[data-error-for="' + fieldId + '"]');

      if (fieldId === "location") {
        $locationPicker.removeClass("has-error");
      } else {
        $field.closest(".field, .picker__cell").removeClass("has-error");
      }
      $error.text("");
    }

    function clearAllErrors() {
      $(".field-error").text("");
      $(".location__error").text("");
      $(".field, .picker__cell").removeClass("has-error");
      $locationPicker.removeClass("has-error");
      $globalError.attr("hidden", true).text("");
    }

    // ---------- Validation ----------
    function validateStep1() {
      let valid = true;
      clearAllErrors();

      if (!$date.val())  { showError("date", "Veuillez choisir une date.");   valid = false; }
      if (!$time.val())  { showError("time", "Veuillez choisir un horaire."); valid = false; }
      if (!$party.val()) { showError("partySize", "Veuillez choisir le nombre de convives."); valid = false; }
      if (!$locationRadios.filter(":checked").length) {
        showError("location", "Veuillez choisir un emplacement (intérieur ou extérieur).");
        valid = false;
      }

      return valid;
    }

    function validateStep2() {
      let valid = true;
      clearAllErrors();

      const firstName = $.trim($("#firstName").val());
      const lastName  = $.trim($("#lastName").val());
      const email     = $.trim($("#email").val());
      const phone     = $.trim($("#phone").val()).replace(/[\s.\-]/g, "");

      if (firstName.length < 2) { showError("firstName", "Veuillez indiquer votre prénom (2 caractères min)."); valid = false; }
      if (lastName.length  < 2) { showError("lastName",  "Veuillez indiquer votre nom (2 caractères min).");    valid = false; }

      if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        showError("email", "Veuillez saisir une adresse e-mail valide.");
        valid = false;
      }

      if (!/^(?:\+33|0)[1-9]\d{8}$/.test(phone)) {
        showError("phone", "Veuillez saisir un numéro de téléphone français valide.");
        valid = false;
      }

      return valid;
    }

    // ---------- Navigation ----------
    function goToStep(step) {
      $(".step").attr("hidden", true);
      $('[data-step="' + step + '"]').removeAttr("hidden");

      $(".progress li").removeClass("is-current").removeAttr("aria-current");
      $('.progress li[data-progress="' + step + '"]').addClass("is-current").attr("aria-current", "step");

      const $heading = $('[data-step="' + step + '"] h2');
      if ($heading.length) {
        $heading.attr("tabindex", "-1").trigger("focus");
        $heading[0].scrollIntoView({ behavior: "smooth", block: "start" });
      }
      clearAllErrors();
    }

    // ---------- Summary ----------
    function populateSummary() {
      const parts = $date.val().split("-");
      const pretty = parts[2] + "/" + parts[1] + "/" + parts[0];

      const locationLabel = selectedLocation === "inside" ? "Intérieur" : "Extérieur";

      let html = "";
      html += '<div><span>Date</span>'       + pretty          + '</div>';
      html += '<div><span>Heure</span>'      + $time.val()     + '</div>';
      html += '<div><span>Convives</span>'   + $party.val()    + '</div>';
      html += '<div><span>Emplacement</span>' + locationLabel  + '</div>';

      // 4 columns on desktop, stacked on mobile — CSS already handles both
      $summary.css("grid-template-columns", "repeat(4, 1fr)");
      $summary.html(html);
    }

    // ---------- Events ----------
    $(function () {
      init();

      $date.on("change", function () { clearError("date"); refreshAvailability(); });
      $party.on("change", function () { clearError("partySize"); refreshAvailability(); });

      $time.on("change", function () {
        selectedTime = $(this).val();
        clearError("time");
        updateStep1Button();
      });

      // ----- Location cards -----
      $locationCards.on("click", function (e) {
        // If the click target is the radio itself, let default happen
        // Otherwise force check the inner radio
        const $radio = $(this).find('input[name="location"]');
        if (!$radio.prop("checked")) {
          $radio.prop("checked", true).trigger("change");
        }
      });

      $locationRadios.on("change", function () {
        selectedLocation = $(this).val();

        $locationCards.removeClass("is-selected");
        $(this).closest(".location__card").addClass("is-selected");

        clearError("location");
        updateStep1Button();
      });

      // ----- Step 1 -> 2 -----
      $toStep2.on("click", function () {
        if (!validateStep1()) return;
        populateSummary();
        goToStep(2);
      });

      $("[data-back]").on("click", function () { goToStep(1); });

      // Clear errors on input
      $form.on("input change", "input:not([type=hidden]), select, textarea", function () {
        if (this.id) clearError(this.id);
      });

      // ----- Submit -----
      $form.on("submit", function (e) {
        e.preventDefault();
        clearAllErrors();

        if (!validateStep2()) {
          const $firstError = $(".has-error").first();
          if ($firstError.length) {
            $firstError.find("input, select, textarea").first().trigger("focus");
            $firstError[0].scrollIntoView({ behavior: "smooth", block: "center" });
          }
          return;
        }

        const payload = {
          csrf:      $csrf.val(),
          date:      $date.val(),
          time:      $time.val(),
          partySize: $party.val(),
          location:  selectedLocation,
          firstName: $.trim($("#firstName").val()),
          lastName:  $.trim($("#lastName").val()),
          email:     $.trim($("#email").val()),
          phone:     $.trim($("#phone").val()),
          message:   $.trim($("#message").val()),
          website:   $("#website").val(),
        };

        $submitBtn
          .prop("disabled", true)
          .html('Envoi en cours… <span aria-hidden="true">⏳</span>');

        $.ajax({
          url: "assets/includes/send_booking.php",
          type: "POST",
          dataType: "json",
          data: payload,
        })
          .done(function (response) {
            if (response.success) {
              $(".progress, .panel__lead, #booking-title").hide();
              $("#result-reference").text(response.reference || "—");
              $("#result-title").text(
                response.status === "confirmed"
                  ? "Votre table est confirmée."
                  : "Votre demande est en attente."
              );
              $("#result-copy").text(
                response.status === "confirmed"
                  ? "Votre réservation a été enregistrée. Un e-mail de confirmation vous a été envoyé."
                  : "L’équipe validera votre demande selon les disponibilités. Vous recevrez un e-mail de confirmation."
              );
              goToStep(3);
            } else {
              $globalError
                .removeAttr("hidden")
                .text(response.message || "Une erreur est survenue. Veuillez réessayer.");
              $submitBtn
                .prop("disabled", false)
                .html('Envoyer ma demande <span aria-hidden="true">→</span>');
            }
          })
          .fail(function (xhr) {
            let msg = "Le serveur de réservation est inaccessible. Vérifiez votre connexion puis réessayez.";
            if (xhr.responseJSON && xhr.responseJSON.message) {
              msg = xhr.responseJSON.message;
            } else if (xhr.status === 0) {
              msg = "Connexion impossible. Vérifiez que le serveur est bien démarré.";
            }
            $globalError.removeAttr("hidden").text(msg);
            $submitBtn
              .prop("disabled", false)
              .html('Envoyer ma demande <span aria-hidden="true">→</span>');
          });
      });
    });
  })(jQuery);
  </script>
</body>
</html>