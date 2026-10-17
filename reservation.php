<?php
require_once __DIR__ . '/assets/includes/config.php';
?>
<!doctype html>
<html lang="fr">
<?php echo $copyright; ?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Réservez votre table à La Kermesse, 121 rue de Vern à Rennes.">
  <title>Réserver une table | La Kermesse Rennes</title>

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

  <a class="skip-link" href="/reservation">Aller au formulaire de réservation</a>

  <main class="shell">
    <a class="back-home" href="/">← Retour à La Kermesse</a><br>

    <section id="booking-panel" class="panel" aria-labelledby="booking-title">
      <header class="panel__head">
        <img class="panel__logo"
             src="assets/images/la-kermesse-logo.svg"
             alt="La Kermesse" width="260" height="52">
        <p class="eyebrow-cream">121 rue de Vern, Rennes</p>
        <h1 id="booking-title">On vous garde une table ?</h1>
        <p class="panel__lead">Choisissez votre moment à La Kermesse.</p>
      </header>

      <p class="notice" id="demo-notice" hidden>
        Prototype de réservation — les réglages d’exploitation sont à confirmer avec l’équipe.
      </p>

      <ol class="progress" aria-label="Progression de la réservation">
        <li class="is-current" data-progress="1"><span>1</span>Votre table</li>
        <li data-progress="2"><span>2</span>Coordonnées</li>
        <li data-progress="3"><span>3</span>Confirmation</li>
      </ol>

      <div class="alert alert--error" id="global-error" role="alert" hidden></div>

      <form id="booking-form" novalidate>
        <input type="hidden" name="csrf" id="csrf-token"
               value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">

        <!-- ============ ÉTAPE 1 ============ -->
        <section class="step" data-step="1" aria-labelledby="step1-title">
          <h2 id="step1-title">Votre table</h2>

          <div class="picker" role="group" aria-label="Date, horaire et nombre de personnes">
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
              <label class="picker__label" for="partySize">Personnes</label>
              <select id="partySize" name="partySize" required aria-describedby="party-error"></select>
              <input type="number" id="partySizeCustom" name="partySizeCustom"
                     min="19" max="200" inputmode="numeric" placeholder="Ex : 25"
                     aria-describedby="party-error" hidden>
              <button type="button" id="party-back" class="party-back" hidden>← Retour à la liste</button>
              <p class="field-error" id="party-error" data-error-for="partySize" role="alert"></p>
            </div>
          </div>

          <p class="status" id="availability-status" aria-live="polite">
            Choisissez une date et le nombre de personnes pour voir les disponibilités.
          </p>

          <!-- ============ EMPLACEMENT ============ -->
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

          <p class="phone-help"><br>
            Chers clients, si vous rencontrez des difficultes pour reserver en ligne, n'hesitez pas a nous contacter par telephone au <a href="tel:+33982684417">+33 982 68 44 17</a>. Nous serons ravis de vous aider.
          </p>
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
                     autocomplete="given-name" placeholder="Prénom" required aria-describedby="firstName-error">
              <p class="field-error" id="firstName-error" data-error-for="firstName" role="alert"></p>
            </div>

            <div class="field">
              <label for="lastName">Nom</label>
              <input type="text" id="lastName" name="lastName" maxlength="80"
                     autocomplete="family-name" placeholder="Nom" required aria-describedby="lastName-error">
              <p class="field-error" id="lastName-error" data-error-for="lastName" role="alert"></p>
            </div>

            <div class="field">
              <label for="email">E-mail</label>
              <input type="email" id="email" name="email" maxlength="160"
                     autocomplete="email" placeholder="nom.prenom@mail.com" required aria-describedby="email-error">
              <p class="field-error" id="email-error" data-error-for="email" role="alert"></p>
            </div>

            <div class="field">
              <label for="phone">Téléphone</label>
              <input type="tel" id="phone" name="phone" maxlength="30"
                     autocomplete="tel" placeholder="06XXXXXXXX" required aria-describedby="phone-error">
              <p class="field-error" id="phone-error" data-error-for="phone" role="alert"></p>
            </div>

            <div class="field field--wide">
              <label for="message">Une demande particulière <span class="optional">(optionnel)</span></label>
              <textarea id="message" name="message" rows="3" maxlength="1000"
                        aria-describedby="message-error" placeholder="Saisissez un commentaire à propos de la réservation"></textarea>
              <p class="field-error" id="message-error" data-error-for="messa ge" role="alert"></p>
            </div>
			
			<div class="field field--wide">
			  <label>L’un des convives a-t-il une intolérance/allergie&nbsp;?</label>

			  <div class="yesno" role="radiogroup" aria-label="Intolérance ou allergie">
				<label class="yesno__opt">
				  <input type="radio" name="hasAllergy" value="no" checked>
				  <span>Non</span>
				</label>
				<label class="yesno__opt">
				  <input type="radio" name="hasAllergy" value="yes">
				  <span>Oui</span>
				</label>
			  </div>

			  <div class="allergy-details" id="allergy-details" hidden>
				<label for="allergyDetails">Précisez l’allergie ou l’intolérance</label>
				<textarea id="allergyDetails" name="allergyDetails" rows="2" maxlength="500"
						  placeholder="Ex : allergie aux fruits à coque, intolérance au lactose…"
						  aria-describedby="allergyDetails-error"></textarea>
				<p class="field-error" id="allergyDetails-error"
				   data-error-for="allergyDetails" role="alert"></p>
			  </div>
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
            Réserver ma table <span aria-hidden="true">→</span>
          </button>

          <p class="phone-help"><br>
            Chers clients, si vous rencontrez des difficultés pour réserver en ligne, n'hésitez pas à nous contacter par téléphone au <a href="tel:+33982684417">+33 982 68 44 17</a>. Nous serons ravis de vous aider.
          </p>
		  
        </section>
      </form>

      <!-- ============ ÉTAPE 3 / Confirmation ============ -->
	  <section class="step result" data-step="3" hidden aria-live="polite" aria-labelledby="result-title">
	  <h2 tabindex="-1" id="result-title">Votre réservation est confirmée.</h2>
	  <p id="result-copy">Un mail de confirmation vient de vous être envoyé.</p>
	  <p class="result-note">
		Vous ne le trouvez pas&nbsp;? Pensez à vérifier votre dossier
		<strong>courriers indésirables (spam)</strong>.
	  </p>

	  <div class="reference">
		<span>Référence</span>
		<strong id="result-reference">—</strong>
	  </div>

	  <p class="phone-help">
		Une question&nbsp;? <a href="tel:+33982684417">09 82 68 44 17</a>
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
  <script src="assets/js/reservation.js"></script>
</body>
</html>