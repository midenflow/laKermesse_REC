<?php
require_once __DIR__ . '/assets/includes/config.php';
?>
<!doctype html>
<html lang="fr">
<?php echo $copyright; ?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Organisez votre événement à La Kermesse, 121 rue de Vern à Rennes.">
  <title>Organiser un événement | La Kermesse Rennes</title>

  <link rel="icon" type="image/x-icon" href="./assets/images/la_kermesse_duck.svg">
  <link rel="icon" href="./assets/images/la_kermesse_duck.svg" sizes="32x32">
  <link rel="icon" href="./assets/images/la_kermesse_duck.svg" sizes="192x192">
  <link rel="apple-touch-icon" href="./assets/images/la_kermesse_duck.svg">
  <meta name="msapplication-TileImage" content="./assets/images/la_kermesse_duck.svg"> 

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600&family=DM+Serif+Display&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body class="booking-page">

  <a class="skip-link" href="/">Aller au formulaire</a>

  <main class="shell">
    <a class="back-home" href="/">← Retour à La Kermesse</a><br>

    <section id="event-panel" class="panel" aria-labelledby="event-title">
      <header class="panel__head">
        <img class="panel__logo" src="assets/images/la-kermesse-logo.svg" alt="La Kermesse" width="260" height="52">
        <p class="eyebrow-cream">121 rue de Vern, Rennes</p>
        <h1 id="event-title">Organiser un événement ?</h1>
        <p class="panel__lead">Anniversaires, repas d’entreprise, célébrations. Parlons-en.</p>
      </header>

      <ol class="progress" aria-label="Progression de la demande">
        <li class="is-current" data-progress="1"><span>1</span>Coordonnées</li>
        <li data-progress="2"><span>2</span>Confirmation</li>
      </ol>

      <div class="alert alert--error" id="global-error" role="alert" hidden></div>

      <form id="event-form" novalidate>
        <input type="hidden" name="csrf" id="csrf-token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">

        <!-- ============ ÉTAPE 1 ============ -->
        <section class="step" data-step="1" aria-labelledby="step1-title">
          <h2 id="step1-title">Votre événement</h2>

          <div class="picker" role="group" aria-label="Date, horaire et nombre de personnes">
            <div class="picker__cell">
              <label class="picker__label" for="date">Date souhaitée</label>
              <input type="date" id="date" name="date" required aria-describedby="date-error" autocomplete="off">
              <p class="field-error" id="date-error" data-error-for="date" role="alert"></p>
            </div>

            <div class="picker__cell">
              <label class="picker__label" for="time">Créneau</label>
              <select id="time" name="time" required disabled aria-describedby="time-error"><option value="">Choisir</option></select>
              <p class="field-error" id="time-error" data-error-for="time" role="alert"></p>
            </div>

            <div class="picker__cell">
              <label class="picker__label" for="partySize">Personnes</label>
              <select id="partySize" name="partySize" required aria-describedby="party-error" style="display: none;"><option value="1">1 personne</option><option value="2">2 personnes</option><option value="3">3 personnes</option><option value="4">4 personnes</option><option value="5">5 personnes</option><option value="6">6 personnes</option><option value="7">7 personnes</option><option value="8">8 personnes</option><option value="9">9 personnes</option><option value="10">10 personnes</option><option value="11">11 personnes</option><option value="12">12 personnes</option><option value="13">13 personnes</option><option value="14">14 personnes</option><option value="15">15 personnes</option><option value="16">16 personnes</option><option value="17">17 personnes</option><option value="18">18 personnes</option><option value="+18">+ de 18 personnes</option></select>
              <input type="number" id="partySizeCustom" name="partySizeCustom" min="19" max="200" inputmode="numeric" placeholder="Ex : 25" aria-describedby="party-error">
              <p class="field-error" id="party-error" data-error-for="partySize" role="alert"></p>
            </div>
          </div>

          <p class="status" id="availability-status" aria-live="polite">Choisissez une date et le nombre de personnes pour voir les disponibilités.</p>

          <div class="fields">

            <div class="field">
              <label for="firstName">Prénom</label>
              <input type="text" id="firstName" name="firstName" maxlength="80" placeholder="Prénom" autocomplete="given-name" required aria-describedby="firstName-error">
              <p class="field-error" id="firstName-error" data-error-for="firstName" role="alert"></p>
            </div>

            <div class="field">
              <label for="lastName">Nom</label>
              <input type="text" id="lastName" name="lastName" maxlength="80" placeholder="Nom" autocomplete="family-name" required aria-describedby="lastName-error">
              <p class="field-error" id="lastName-error" data-error-for="lastName" role="alert"></p>
            </div>

            <div class="field field--wide">
              <label for="eventType">Type d’événement</label>
              <select id="eventType" name="eventType" required aria-describedby="eventType-error">
                <option value="">Choisir</option>
                <option value="Anniversaire">Anniversaire</option>
                <option value="Mariage">Mariage</option>
                <option value="Événement d’entreprise">Événement d’entreprise</option>
                <option value="Repas de famille">Repas de famille</option>
                <option value="Soirée privée">Soirée privée</option>
				<option value="Occasion particulière">Occasion particulière</option>
                <option value="Autre">Autre</option>
              </select>
              <p class="field-error" id="eventType-error" data-error-for="eventType" role="alert"></p>
            </div>

            <div class="field">
              <label for="email">E-mail</label>
              <input type="email" id="email" name="email" maxlength="160" placeholder="nom.prenom@mail.com" autocomplete="email" required aria-describedby="email-error">
              <p class="field-error" id="email-error" data-error-for="email" role="alert"></p>
            </div>

            <div class="field">
              <label for="phone">Téléphone</label>
              <input type="tel" id="phone" name="phone" maxlength="30" placeholder="06XXXXXXXX"  autocomplete="tel" required aria-describedby="phone-error">
              <p class="field-error" id="phone-error" data-error-for="phone" role="alert"></p>
            </div>

            <div class="field field--wide">
              <label for="message">Dîtes-nous en plus</span></label>
              <textarea id="message" name="message" rows="5" maxlength="2000" placeholder="Occasion, ambiance souhaitée, contraintes particulières…" aria-describedby="message-error"></textarea>
              <p class="field-error" id="message-error" data-error-for="message" role="alert"></p>
            </div>

          </div>

          <!-- ============ EMPLACEMENT ============ -->
          <div class="location" id="location-picker" role="radiogroup" aria-label="Choisissez l’emplacement de votre événement">
            <p class="location__heading" id="location-label">Emplacement</p>

            <div class="location__grid" aria-labelledby="location-label">

              <label class="location__card" data-location="inside">
                <input type="radio" name="location" value="inside" aria-labelledby="loc-inside-title">
                <div class="location__image">
                  <img src="assets/images/06_indoor_room.png" alt="Salle intérieure de La Kermesse" loading="lazy" width="600" height="450">
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
                <input type="radio" name="location" value="outside" aria-labelledby="loc-outside-title">
                <div class="location__image">
                  <img src="assets/images/14_garden_center_canopy.png" alt="Terrasse et jardin de La Kermesse" loading="lazy" width="600" height="450">
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

          <button type="submit" class="btn" id="submit-event">
            Envoyer ma demande <span aria-hidden="true">→</span>
          </button>

          <p class="phone-help"><br>
            Vous préférez nous appeler&nbsp;?
            <a href="tel:+33982684417">+33 982 68 44 17</a>
          </p>
        </section>
      </form>

      <!-- ============ ÉTAPE 2 / Confirmation ============ -->
      <section class="step result" data-step="2" hidden aria-live="polite" aria-labelledby="result-title">
        <h2 id="result-title">Merci&nbsp;!</h2>
        <p id="result-copy"></p>

        <div class="reference">
          <span>Référence</span>
          <strong id="result-reference">—</strong>
        </div>

        <p class="phone-help">
          Une question ? <a href="tel:+33982684417">09 82 68 44 17</a>
        </p>
        <a class="btn" href="/">Retour au site</a>
      </section>

      <br>
      <p class="panel__head eyebrow midenflow-copyright">
        <span>Système de réservation par</span>
        <a href="https://midenflow.com" target="_blank" rel="noopener">
          <img src="assets/images/midenflow_logo.png" alt="www.midenflow.com" style="height: 30px;">
        </a>
      </p>
    </section>
  </main>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="assets/js/reservation-groupes.js"></script>
</body></html>