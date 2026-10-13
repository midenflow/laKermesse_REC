<?php

### send_booking.php
declare(strict_types=1);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/booking-core.php';

header('Content-Type: application/json; charset=utf-8');

requirePost();
requireCsrf();
rejectHoneypot();

// ---------- Collect table-specific fields ----------
$date           = clean($_POST['date']      ?? '');
$time           = clean($_POST['time']      ?? '');
$partySize      = (int) ($_POST['partySize'] ?? 0);
$location       = clean($_POST['location']  ?? '');
$firstName      = clean($_POST['firstName'] ?? '');
$lastName       = clean($_POST['lastName']  ?? '');
$email          = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
$phone          = clean($_POST['phone']     ?? '');
$message        = clean($_POST['message']   ?? '');
$hasAllergy     = ($_POST['hasAllergy'] ?? 'no') === 'yes' ? 'yes' : 'no';
$allergyDetails = clean($_POST['allergyDetails'] ?? '');

// ---------- Validation ----------
$errors = [];

if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
    $errors[] = 'Date invalide.';
} else {
    $today  = new DateTime('today');
    $chosen = DateTime::createFromFormat('Y-m-d', $date);
    $max    = (clone $today)->modify('+' . MAX_ADVANCE_DAYS . ' days');
    if (!$chosen || $chosen < $today || $chosen > $max) {
        $errors[] = 'La date choisie est en dehors de la période de réservation.';
    }
}

if (!preg_match('/^\d{2}:\d{2}$/', $time))        $errors[] = 'Horaire invalide.';
if ($partySize < 1 || $partySize > MAX_PARTY_SIZE_CUSTOM)
                                                  $errors[] = 'Nombre de personnes invalide.';
if (!in_array($location, ['inside','outside'], true))
                                                  $errors[] = 'Emplacement invalide.';
if ($e = validateName($firstName, 'Prénom'))      $errors[] = $e;
if ($e = validateName($lastName,  'Nom'))         $errors[] = $e;
if ($e = validateEmail($email))                   $errors[] = $e;
if ($e = validateFrenchPhone($phone))             $errors[] = $e;
if ($hasAllergy === 'yes' && mb_strlen($allergyDetails) < 3)
                                                  $errors[] = 'Merci de préciser l’allergie.';

if ($errors) {
    jsonResponse(['success' => false, 'message' => implode(' ', $errors)], 422);
}

// ============================================================
// Format values
// ============================================================
$reference     = makeReference('KER');
$dateObj       = DateTime::createFromFormat('Y-m-d', $date);
$dateFormatted = $dateObj ? $dateObj->format('d/m/Y') : $date;
$locationLabel = $location === 'inside' ? 'Intérieur' : 'Extérieur';
$allergyLabel  = $hasAllergy === 'yes' ? 'Oui' : 'Non';

// ---------- Elegant date / time ----------
if ($dateObj) {
    $dayNames   = ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'];
    $monthNames = [
        1=>'janvier',2=>'février',3=>'mars',4=>'avril',5=>'mai',6=>'juin',
        7=>'juillet',8=>'août',9=>'septembre',10=>'octobre',11=>'novembre',12=>'décembre'
    ];
    $dateElegant = $dayNames[(int)$dateObj->format('w')] . ' '
                 . (int)$dateObj->format('j') . ' '
                 . $monthNames[(int)$dateObj->format('n')] . ' '
                 . $dateObj->format('Y');
} else {
    $dateElegant = $dateFormatted;
}
$timeElegant    = str_replace(':', 'h', $time);
$partySizeLabel = $partySize . ' ' . ($partySize === 1 ? 'personne' : 'personnes');

// ============================================================
// EMAIL PRESENTATION VALUES
// Every conditional, colour or optional block lives here.
// The two heredocs below contain nothing but {$variables}.
// ============================================================

// ---------- Wordmark ----------
$wordmark = '<span style="color:#29ABE2;">l</span>'
          . '<span style="color:#F15A5A;">a</span>'
          . '&nbsp;'
          . '<span style="color:#F7D74C;">K</span>'
          . '<span style="color:#F48FB1;">e</span>'
          . '<span style="color:#4ECB8C;">r</span>'
          . '<span style="color:#29ABE2;">m</span>'
          . '<span style="color:#F5A15E;">e</span>'
          . '<span style="color:#F7D74C;">s</span>'
          . '<span style="color:#F48FB1;">s</span>'
          . '<span style="color:#4ECB8C;">e</span>';

// ---------- Wordmark variants (used inside the heredocs) ----------
$wordmarkSmall = $wordmark;   // restaurant header + footer
$wordmarkBig   = $wordmark;   // guest header + footer

// ---------- Rainbow hairline ----------
$rainbowHairline = '<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;">'
                 . '<tr>'
                 . '<td width="16.66%" height="2" style="background:#29ABE2;line-height:2px;font-size:0;">&nbsp;</td>'
                 . '<td width="16.66%" height="2" style="background:#F15A5A;line-height:2px;font-size:0;">&nbsp;</td>'
                 . '<td width="16.66%" height="2" style="background:#F7D74C;line-height:2px;font-size:0;">&nbsp;</td>'
                 . '<td width="16.66%" height="2" style="background:#4ECB8C;line-height:2px;font-size:0;">&nbsp;</td>'
                 . '<td width="16.66%" height="2" style="background:#F5A15E;line-height:2px;font-size:0;">&nbsp;</td>'
                 . '<td width="16.66%" height="2" style="background:#F48FB1;line-height:2px;font-size:0;">&nbsp;</td>'
                 . '</tr></table>';

// ---------- Gold hairline rule (used in headers) ----------
$goldRule = '<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;">'
          . '<tr>'
          . '<td height="4" style="background:#c6a56a;line-height:4px;font-size:0;">&nbsp;</td>'
          . '</tr></table>';

// ---------- Allergy presentation values ----------
$allergyValueColor  = $hasAllergy === 'yes' ? '#F15A5A' : '#092934';
$allergyValueWeight = $hasAllergy === 'yes' ? 'bold'    : 'normal';

$allergyCallout = $hasAllergy === 'yes'
    ? '<tr><td style="padding:32px 52px 0 52px;">'
    .   '<div style="padding:20px 24px;background:#fdf6f5;border-left:2px solid #F15A5A;">'
    .     '<div style="font-family:Arial,sans-serif;font-size:10px;letter-spacing:0.22em;text-transform:uppercase;color:#F15A5A;margin-bottom:10px;">Allergie signalée</div>'
    .     '<div style="font-family:Georgia,serif;font-style:italic;font-size:17px;line-height:1.6;color:#071e28;">'
    .       $allergyDetails
    .     '</div>'
    .   '</div>'
    . '</td></tr>'
    : '';

$guestAllergyNote = $hasAllergy === 'yes'
    ? '<tr><td style="padding:28px 52px 0 52px;">'
    .   '<div style="font-family:Georgia,serif;font-style:italic;font-size:15px;line-height:1.7;color:#0d3442;padding-left:18px;border-left:2px solid #F15A5A;">'
    .     'Note transmise à la cuisine&nbsp;: ' . $allergyDetails
    .   '</div>'
    . '</td></tr>'
    : '';

$allergyPreheader = $hasAllergy === 'yes' ? ', allergie signalée' : '';
$allergyAltLine   = $hasAllergy === 'yes' ? "Allergie : {$allergyDetails}\n" : '';

// ---------- Optional message block (restaurant) ----------
$messageBlock = trim($message) !== ''
    ? '<tr><td style="padding:32px 52px 0 52px;">'
    .   '<div style="font-family:Georgia,serif;font-style:italic;font-size:16px;line-height:1.7;color:#0d3442;padding-left:18px;border-left:2px solid #c6a56a;">'
    .     $message
    .   '</div>'
    . '</td></tr>'
    : '';

// ---------- Subjects ----------
$restaurantSubject = ($hasAllergy === 'yes' ? '⚠ Allergie — ' : '')
                   . "Réservation {$reference}";
$guestSubject      = "Votre réservation à La Kermesse — {$reference}";

// ============================================================
// RESTAURANT EMAIL
// ============================================================
$restaurantBody = <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Nouvelle réservation – La Kermesse</title>
</head>
<body style="margin:0;padding:0;background:#092934;font-family:Arial,Helvetica,sans-serif;color:#092934;">

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#092934;padding:32px 12px;">
<tr><td align="center">

<table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0" style="max-width:600px;width:100%;background:#f4efe4;border-radius:4px;overflow:hidden;">

<!-- HEADER -->
<tr>
<td style="background:#0d3442;padding:28px 32px;">
<div style="font-family:Georgia,'Times New Roman',serif;font-style:italic;font-size:30px;line-height:1.2;letter-spacing:-0.02em;">{$wordmarkSmall}</div>
<div style="margin-top:10px;font-size:10px;letter-spacing:0.18em;text-transform:uppercase;color:#f4efe4;">Nouvelle demande de réservation</div>
</td>
</tr>

<tr><td>{$goldRule}</td></tr>

<!-- INTRO -->
<tr>
<td style="padding:30px 32px 20px 32px;">
<div style="font-family:Georgia,'Times New Roman',serif;font-size:25px;line-height:1.3;color:#092934;">Détails de la réservation</div>
<div style="margin-top:8px;font-size:13px;line-height:1.7;color:#0d3442;">Une nouvelle demande a été reçue sur le site de La Kermesse.</div>
</td>
</tr>

<!-- REFERENCE -->
<tr>
<td style="padding:0 32px 24px 32px;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#0d3442;border-left:3px solid #c6a56a;">
<tr><td style="padding:15px 18px;">
<div style="font-size:10px;letter-spacing:0.16em;text-transform:uppercase;color:#c6a56a;">Référence</div>
<div style="margin-top:5px;font-family:Georgia,'Times New Roman',serif;font-size:21px;color:#f4efe4;">{$reference}</div>
</td></tr>
</table>
</td>
</tr>

<!-- BOOKING DETAILS -->
<tr>
<td style="padding:0 32px 24px 32px;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="border-top:1px solid #dfd2bc;">
<tr>
<td style="padding:13px 0;font-size:11px;letter-spacing:0.12em;text-transform:uppercase;color:#0d3442;width:38%;">Date</td>
<td style="padding:13px 0;font-family:Georgia,serif;font-size:16px;color:#092934;text-align:right;">{$dateFormatted}</td>
</tr>
<tr>
<td style="padding:13px 0;border-top:1px dashed #dfd2bc;font-size:11px;letter-spacing:0.12em;text-transform:uppercase;color:#0d3442;">Heure</td>
<td style="padding:13px 0;border-top:1px dashed #dfd2bc;font-family:Georgia,serif;font-size:16px;color:#092934;text-align:right;">{$timeElegant}</td>
</tr>
<tr>
<td style="padding:13px 0;border-top:1px dashed #dfd2bc;font-size:11px;letter-spacing:0.12em;text-transform:uppercase;color:#0d3442;">Convives</td>
<td style="padding:13px 0;border-top:1px dashed #dfd2bc;font-family:Georgia,serif;font-size:16px;color:#092934;text-align:right;">{$partySizeLabel}</td>
</tr>
<tr>
<td style="padding:13px 0;border-top:1px dashed #dfd2bc;font-size:11px;letter-spacing:0.12em;text-transform:uppercase;color:#0d3442;">Emplacement</td>
<td style="padding:13px 0;border-top:1px dashed #dfd2bc;font-family:Georgia,serif;font-size:16px;color:#092934;text-align:right;">{$locationLabel}</td>
</tr>
<tr>
<td style="padding:13px 0;border-top:1px dashed #dfd2bc;font-size:11px;letter-spacing:0.12em;text-transform:uppercase;color:#0d3442;">Allergie</td>
<td style="padding:13px 0;border-top:1px dashed #dfd2bc;font-family:Georgia,serif;font-size:16px;color:{$allergyValueColor};text-align:right;font-weight:{$allergyValueWeight};">{$allergyLabel}</td>
</tr>
</table>
</td>
</tr>

<!-- CUSTOMER -->
<tr>
<td style="padding:0 32px 28px 32px;">
<div style="font-family:Georgia,'Times New Roman',serif;font-size:20px;color:#092934;margin-bottom:12px;">Informations du client</div>
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#e7dac4;">
<tr><td style="padding:13px 15px;font-size:12px;color:#0d3442;width:34%;">Nom</td><td style="padding:13px 15px;font-size:14px;color:#092934;text-align:right;">{$firstName} {$lastName}</td></tr>
<tr><td style="padding:13px 15px;border-top:1px solid #dfd2bc;font-size:12px;color:#0d3442;">E-mail</td><td style="padding:13px 15px;border-top:1px solid #dfd2bc;font-size:13px;color:#092934;text-align:right;word-break:break-word;">{$email}</td></tr>
<tr><td style="padding:13px 15px;border-top:1px solid #dfd2bc;font-size:12px;color:#0d3442;">Téléphone</td><td style="padding:13px 15px;border-top:1px solid #dfd2bc;font-size:13px;color:#092934;text-align:right;">{$phone}</td></tr>
</table>
</td>
</tr>

{$allergyCallout}
{$messageBlock}

<!-- FOOTER -->
<tr>
<td align="center" style="background:#092934;padding:26px 24px;">
<div style="font-family:Georgia,'Times New Roman',serif;font-style:italic;font-size:22px;line-height:1.3;">{$wordmarkSmall}</div>
<div style="margin-top:10px;font-size:10px;letter-spacing:0.15em;text-transform:uppercase;color:#f4efe4;">121 rue de Vern · Rennes</div>
<div style="margin-top:12px;font-size:11px;line-height:1.6;color:#c6a56a;">La Kermesse · Nouvelle réservation</div>
</td>
</tr>

</table>
</td></tr>
</table>
</body>
</html>
HTML;

// ============================================================
// GUEST EMAIL
// ============================================================
$guestBody = <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Votre réservation à La Kermesse</title>
</head>
<body style="margin:0;padding:0;background:#092934;font-family:Arial,Helvetica,sans-serif;color:#092934;">

<!-- PREHEADER -->
<div style="display:none;max-height:0;overflow:hidden;color:#092934;font-size:1px;line-height:1px;">
Nous avons reçu votre demande — {$reference} — {$dateFormatted} à {$timeElegant} pour {$partySizeLabel}.
</div>

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#092934;padding:32px 12px;">
<tr><td align="center">

<table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0" style="max-width:600px;width:100%;background:#f4efe4;border-radius:4px;overflow:hidden;">

<!-- HEADER -->
<tr>
<td align="center" style="background:#0d3442;padding:36px 24px 28px 24px;">
<div style="font-family:Georgia,'Times New Roman',serif;font-style:italic;font-size:39px;line-height:1.2;letter-spacing:-0.02em;">{$wordmarkBig}</div>
<div style="margin-top:12px;font-size:10px;letter-spacing:0.18em;text-transform:uppercase;color:#f4efe4;">121 rue de Vern · Rennes</div>
</td>
</tr>

<tr><td>{$goldRule}</td></tr>

<!-- INTRO -->
<tr>
<td style="padding:36px 40px 18px 40px;">
<h1 style="margin:0 0 12px 0;font-family:Georgia,'Times New Roman',serif;font-weight:400;font-size:29px;line-height:1.25;color:#092934;">Merci {$firstName} !</h1>
<p style="margin:0;font-size:15px;line-height:1.8;color:#0d3442;">Nous avons bien reçu votre demande de réservation à La Kermesse. Retrouvez les détails de votre demande ci-dessous.</p>
</td>
</tr>

<!-- REFERENCE -->
<tr>
<td style="padding:8px 40px 26px 40px;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#0d3442;border-left:3px solid #c6a56a;">
<tr><td style="padding:17px 20px;">
<div style="font-size:10px;letter-spacing:0.18em;text-transform:uppercase;color:#c6a56a;">Référence de réservation</div>
<div style="margin-top:6px;font-family:Georgia,'Times New Roman',serif;font-size:23px;color:#f4efe4;letter-spacing:0.02em;">{$reference}</div>
</td></tr>
</table>
</td>
</tr>

<!-- DETAILS -->
<tr>
<td style="padding:0 40px 30px 40px;">
<div style="font-family:Georgia,'Times New Roman',serif;font-size:20px;color:#092934;margin-bottom:12px;">Votre récapitulatif</div>
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="border-top:1px solid #dfd2bc;border-bottom:1px solid #dfd2bc;">
<tr>
<td style="padding:14px 0;font-size:11px;letter-spacing:0.12em;text-transform:uppercase;color:#0d3442;width:40%;">Date</td>
<td style="padding:14px 0;font-family:Georgia,'Times New Roman',serif;font-size:17px;color:#092934;text-align:right;">{$dateFormatted}</td>
</tr>
<tr>
<td style="padding:14px 0;border-top:1px dashed #dfd2bc;font-size:11px;letter-spacing:0.12em;text-transform:uppercase;color:#0d3442;">Heure</td>
<td style="padding:14px 0;border-top:1px dashed #dfd2bc;font-family:Georgia,'Times New Roman',serif;font-size:17px;color:#092934;text-align:right;">{$timeElegant}</td>
</tr>
<tr>
<td style="padding:14px 0;border-top:1px dashed #dfd2bc;font-size:11px;letter-spacing:0.12em;text-transform:uppercase;color:#0d3442;">Convives</td>
<td style="padding:14px 0;border-top:1px dashed #dfd2bc;font-family:Georgia,'Times New Roman',serif;font-size:17px;color:#092934;text-align:right;">{$partySizeLabel}</td>
</tr>
<tr>
<td style="padding:14px 0;border-top:1px dashed #dfd2bc;font-size:11px;letter-spacing:0.12em;text-transform:uppercase;color:#0d3442;">Emplacement</td>
<td style="padding:14px 0;border-top:1px dashed #dfd2bc;font-family:Georgia,'Times New Roman',serif;font-size:17px;color:#092934;text-align:right;">{$locationLabel}</td>
</tr>
<tr>
<td style="padding:14px 0;border-top:1px dashed #dfd2bc;font-size:11px;letter-spacing:0.12em;text-transform:uppercase;color:#0d3442;">Allergie</td>
<td style="padding:14px 0;border-top:1px dashed #dfd2bc;font-family:Georgia,'Times New Roman',serif;font-size:17px;color:{$allergyValueColor};text-align:right;">{$allergyLabel}</td>
</tr>
</table>
</td>
</tr>

{$guestAllergyNote}

<!-- CONTACT NOTE -->
<tr>
<td style="padding:0 40px 24px 40px;">
<div style="padding:18px 20px;background:#e7dac4;border-left:3px solid #c6a56a;font-size:14px;line-height:1.8;color:#092934;">
Pour modifier votre demande ou nous poser une question, répondez simplement à cet e-mail ou appelez-nous.
</div>
</td>
</tr>

<!-- CTA -->
<tr>
<td align="center" style="padding:0 32px 38px 32px;">
<a href="tel:+33982684417" style="display:inline-block;padding:15px 25px;background:#c6a56a;color:#092934;text-decoration:none;font-size:11px;font-weight:bold;letter-spacing:0.12em;text-transform:uppercase;border:1px solid #c6a56a;">Nous appeler · 09 82 68 44 17</a>
</td>
</tr>

<!-- FOOTER -->
<tr>
<td align="center" style="background:#092934;padding:27px 24px;">
<div style="font-family:Georgia,'Times New Roman',serif;font-style:italic;font-size:23px;line-height:1.3;">{$wordmarkSmall}</div>
<div style="margin-top:10px;font-size:10px;letter-spacing:0.16em;text-transform:uppercase;color:#f4efe4;">121 rue de Vern · Rennes</div>
<div style="margin-top:14px;font-size:11px;line-height:1.7;color:#d5dadd;">Vous recevez cet e-mail suite à votre demande de réservation.<br>Aucune donnée personnelle n’est cédée à des tiers.</div>
</td>
</tr>

</table>
</td></tr>
</table>
</body>
</html>
HTML;

// ============================================================
// PLAIN TEXT FALLBACK
// ============================================================
$guestAltBody  = "Bonjour {$firstName},\n\n";
$guestAltBody .= "Nous avons le plaisir de confirmer votre table à La Kermesse.\n\n";
$guestAltBody .= "Rendez-vous : {$dateElegant} à {$timeElegant}\n";
$guestAltBody .= "Table pour   : {$partySizeLabel} — {$locationLabel}\n";
$guestAltBody .= "Référence    : {$reference}\n";
$guestAltBody .= $allergyAltLine;
$guestAltBody .= "\n";
$guestAltBody .= "Un changement ? Répondez à cet e-mail ou appelez-nous au 09 82 68 44 17.\n\n";
$guestAltBody .= "À très bientôt,\n";
$guestAltBody .= "La Kermesse — 121 rue de Vern, Rennes";

// ---------- Demo mode ----------
if (DEMO_MODE) {
    jsonResponse([
        'success'   => true,
        'status'    => 'confirmed',
        'reference' => $reference,
        'message'   => 'Mode démo : e-mails non envoyés.'
    ]);
}

// ============================================================
// SEND
// ============================================================
try {
    $mail = newMailer();
    $mail->setFrom(FROM_EMAIL, FROM_NAME);

    // → Restaurant
    $mail->addAddress(RESTAURANT_EMAIL, RESTAURANT_NAME);
    $mail->Subject = $restaurantSubject;
    $mail->Body    = $restaurantBody;
    $mail->send();

    // → Guest
    $mail->clearAddresses();
    $mail->addAddress($email, $firstName . ' ' . $lastName);
    $mail->Subject = $guestSubject;
    $mail->Body    = $guestBody;
    $mail->AltBody = $guestAltBody;
    $mail->send();

    jsonResponse([
        'success'   => true,
        'status'    => 'confirmed',
        'reference' => $reference,
    ]);
} catch (Throwable $e) {
    error_log('Table Mailer Error: ' . $e->getMessage());
    jsonResponse([
        'success' => false,
        'message' => "L'envoi a échoué. Veuillez réessayer ou nous appeler.",
    ], 500);
}