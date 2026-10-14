<?php
// send_event_booking.php
declare(strict_types=1);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/booking-core.php';

header('Content-Type: application/json; charset=utf-8');

requirePost();
requireCsrf();
rejectHoneypot();

// ============================================================
// LOGO (embedded inside the e-mail as a CID image: no external link)
// ============================================================
const KERMESSE_LOGO_CID = 'kermesse-logo';

// 560x112 transparent PNG, base64 encoded
const KERMESSE_LOGO_B64 = <<<'B64'
iVBORw0KGgoAAAANSUhEUgAAAjAAAABwCAMAAAA36LoYAAAA/1BMVEUAAABBwO/t23HsgW9nyp3bucfZfL4+SEg+R0dRVU5GSkk+
SEjUiXZGTErr2XE6SkpBwO9Du/K4kHlBwO+mlGhnyZ5oy5xGxfDi0W9oypwr0/LYe73auca9kHzTmW/We7zausZAvvCOdGfbt8nf
iK4AgICrnWdBv++gl5pCSUnkbbakb5aA///dk2zn13COsozjyaKdpojbeMJYsaaacmaKdGfJrbjQsryA/4Dl5eWVz47X0I+laJPe
fG1+gVq+c6kAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADVSDTD
AAAAQHRSTlMA/Pz8/Pz936JhHWKjlJ8fohmcYmCfHiBqWhGkodZmZmBWZh8TAjKPX80XYAIqKg+fqBkEN4lkmgIDm1wxRWmF6VIG
eQAAFUxJREFUeNrtnQdz20iygCmJ0iQMMnMSaUUr2Ou44e7d//9XDwARpgc9CCYp+eqma6u2TEo2OfjQuRuDgRUrVqxYsWLFihUr
VqxYsWLFihUrVqxYsWLFihUrVqxYsWLliMIFpVR4xreZYMl/nj2od5RgL8+/Ay6UUJaIpBx512PJ20KI7H/cXrj3kEnknxXiR8G7
88LW7nkiLqMYTIRl7ybvvwhiiXkH3XJ/BmX7rrhIOT0vpGZ1PELjc0XW1BLz1rj4ZzWJ3umzeKm5UYHgTOel0C6FTAmz1/AtJTrD
5I2J8YRILA0hVAoIhAc1jAA05TrGWqX35+XsbPKWtCSkJE5uPHVrNECnlpL1eV0QR8fKiWTun5nkLbwVlsTOVDI2dd1zVFzVQ/Hk
I/pjU6tifgNezuYn1ysy1SuxiZWMF6kqD4rzklBl8zHvwEsWTU/8t/FieOKySMwEQdUB8jBSmn6cWrf3bcIjVaHc1147pSVKYuMW
WBJcGFF5YdT4G1TYi/nWvGzrr57I7fUSS8Sm5z1xSeIj8+/YVMybiGqPlNwu9toRtUsn5ZL6JZACjsTT1c/ai/kGsjVkXU4KTMIL
MwVELvB2oZXxCNN+es1kQR6zLswbG6T7wRsBwymKizuNmaBCeUtqSoNqDgxL7JpM/GbXRtVvJJMz3CApbxzdh/EoYlfcaXLxM4nV
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
YII=
B64;

function kermesseLogoImg(int $height): string
{
    $width = $height * 5;
    return '<img src="cid:' . KERMESSE_LOGO_CID . '" alt="La Kermesse"'
         . ' width="' . $width . '" height="' . $height . '"'
         . ' style="display:inline-block;border:0;outline:none;text-decoration:none;'
         .          'width:' . $width . 'px;height:' . $height . 'px;'
         .          'font-family:Georgia,serif;font-style:italic;font-size:' . (int) round($height * 0.55) . 'px;color:#f4efe4;">';
}

// Must be called before every ->send() (attachments are cleared between sends)
function attachKermesseLogo($mail): void
{
    $mail->addStringEmbeddedImage(
        base64_decode(str_replace(["\r", "\n"], '', KERMESSE_LOGO_B64)),
        KERMESSE_LOGO_CID,
        'la-kermesse.png',
        'base64',
        'image/png'
    );
}

// ---------- Collect event-specific fields ----------
$firstName   = clean($_POST['firstName']   ?? '');
$lastName    = clean($_POST['lastName']    ?? '');
$eventType   = clean($_POST['eventType']   ?? '');
$eventDate   = clean($_POST['eventDate']   ?? '');
$eventTime   = clean($_POST['eventTime']   ?? '');
$location    = clean($_POST['location']    ?? '');
$partySize   = (int) ($_POST['partySize']  ?? 0);
$email       = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
$phone       = clean($_POST['phone']       ?? '');
$message     = clean($_POST['message']     ?? '');

// ---------- Validation ----------
$errors = [];

$allowedTypes = [
    'Anniversaire','Événement d’entreprise','Mariage',
    'Baptême / Communion','Repas de famille','Soirée privée','Autre'
];
if (!in_array($eventType, $allowedTypes, true)) $errors[] = 'Type d’événement invalide.';

if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $eventDate)) {
    $errors[] = 'Date invalide.';
} else {
    $today  = new DateTime('today');
    $chosen = DateTime::createFromFormat('Y-m-d', $eventDate);
    $max    = (clone $today)->modify('+730 days');
    if (!$chosen || $chosen < $today || $chosen > $max) {
        $errors[] = 'La date souhaitée est en dehors de la période acceptée.';
    }
}

if (!preg_match('/^\d{2}:\d{2}$/', $eventTime))     $errors[] = 'Horaire invalide.';
if (!in_array($location, ['inside','outside'], true)) $errors[] = 'Emplacement invalide.';
if ($partySize < 10 || $partySize > 300)            $errors[] = 'Nombre de personnes invalide (10 à 300).';
if ($e = validateName($firstName, 'Prénom'))        $errors[] = $e;
if ($e = validateName($lastName,  'Nom'))           $errors[] = $e;
if ($e = validateEmail($email))                     $errors[] = $e;
if ($e = validateFrenchPhone($phone))               $errors[] = $e;

if ($errors) {
    jsonResponse(['success' => false, 'message' => implode(' ', $errors)], 422);
}

// ============================================================
// Format values
// ============================================================
$reference     = makeReference('EVT');
$dateObj       = DateTime::createFromFormat('Y-m-d', $eventDate);
$dateFormatted = $dateObj ? $dateObj->format('d/m/Y') : $eventDate;
$locationLabel = $location === 'inside' ? 'Intérieur' : 'Extérieur';

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
$timeElegant    = str_replace(':', 'h', $eventTime);
$partySizeLabel = $partySize . ' personnes';

// ============================================================
// EMAIL PRESENTATION VALUES
// ============================================================

// ---------- Wordmark variants (embedded logo image) ----------
$wordmarkSmall = kermesseLogoImg(36);   // restaurant header + footer, guest footer
$wordmarkBig   = kermesseLogoImg(56);   // guest header

// ---------- Gold hairline rule (used in headers) ----------
$goldRule = '<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;">'
          . '<tr>'
          . '<td height="4" style="background:#c6a56a;line-height:4px;font-size:0;">&nbsp;</td>'
          . '</tr></table>';

// ---------- Safe HTML version of the free-text message (keeps line breaks) ----------
$toHtml = static fn(string $t): string => nl2br(
    htmlspecialchars(html_entity_decode($t, ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8')
);
$messageHtml = $toHtml($message);

// ---------- Optional message block (restaurant) ----------
$messageBlock = trim($message) !== ''
    ? '<tr><td style="padding:0 32px 28px 32px;">'
    .   '<div style="font-family:Georgia,\'Times New Roman\',serif;font-size:20px;color:#092934;margin-bottom:12px;">Message du client</div>'
    .   '<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#e7dac4;border-left:3px solid #c6a56a;">'
    .   '<tr><td style="padding:16px 20px;font-family:Georgia,serif;font-style:italic;font-size:15px;line-height:1.7;color:#092934;word-break:break-word;overflow-wrap:anywhere;">'
    .     $messageHtml
    .   '</td></tr></table>'
    . '</td></tr>'
    : '';

// ---------- Optional message recap (guest) ----------
$guestMessageBlock = trim($message) !== ''
    ? '<tr><td style="padding:0 40px 24px 40px;">'
    .   '<div style="font-size:11px;letter-spacing:0.12em;text-transform:uppercase;color:#0d3442;margin-bottom:8px;">Votre message</div>'
    .   '<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="border-left:3px solid #c6a56a;">'
    .   '<tr><td style="padding:4px 0 4px 16px;font-family:Georgia,serif;font-style:italic;font-size:15px;line-height:1.7;color:#0d3442;word-break:break-word;overflow-wrap:anywhere;">'
    .     $messageHtml
    .   '</td></tr></table>'
    . '</td></tr>'
    : '';

// ---------- Subjects ----------
$restaurantSubject = "Nouvelle demande d’événement – {$reference}";
$guestSubject      = "Votre demande d’événement à La Kermesse — {$reference}";

// ============================================================
// RESTAURANT EMAIL
// ============================================================
$restaurantBody = <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Nouvelle demande d’événement – La Kermesse</title>
</head>
<body style="margin:0;padding:0;background:#092934;font-family:Arial,Helvetica,sans-serif;color:#092934;">

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#092934;padding:32px 12px;">
<tr><td align="center">

<table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0" style="max-width:600px;width:100%;background:#f4efe4;border-radius:4px;overflow:hidden;">

<!-- HEADER -->
<tr>
<td style="background:#0d3442;padding:28px 32px;">
<div style="line-height:1;">{$wordmarkSmall}</div>
<div style="margin-top:10px;font-size:10px;letter-spacing:0.18em;text-transform:uppercase;color:#f4efe4;">Nouvelle demande d’événement</div>
</td>
</tr>

<tr><td>{$goldRule}</td></tr>

<!-- INTRO -->
<tr>
<td style="padding:30px 32px 20px 32px;">
<div style="font-family:Georgia,'Times New Roman',serif;font-size:25px;line-height:1.3;color:#092934;">Détails de l’événement</div>
<div style="margin-top:8px;font-size:13px;line-height:1.7;color:#0d3442;">Une nouvelle demande d’événement a été reçue sur le site de La Kermesse.</div>
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

<!-- EVENT DETAILS -->
<tr>
<td style="padding:0 32px 24px 32px;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="border-top:1px solid #dfd2bc;">
<tr>
<td style="padding:13px 0;font-size:11px;letter-spacing:0.12em;text-transform:uppercase;color:#0d3442;width:38%;">Type</td>
<td style="padding:13px 0;font-family:Georgia,serif;font-size:16px;color:#092934;text-align:right;">{$eventType}</td>
</tr>
<tr>
<td style="padding:13px 0;border-top:1px dashed #dfd2bc;font-size:11px;letter-spacing:0.12em;text-transform:uppercase;color:#0d3442;">Date</td>
<td style="padding:13px 0;border-top:1px dashed #dfd2bc;font-family:Georgia,serif;font-size:16px;color:#092934;text-align:right;">{$dateElegant}</td>
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

{$messageBlock}

<!-- FOOTER -->
<tr>
<td align="center" style="background:#092934;padding:26px 24px;">
<div style="line-height:1;">{$wordmarkSmall}</div>
<div style="margin-top:10px;font-size:10px;letter-spacing:0.15em;text-transform:uppercase;color:#f4efe4;">121 rue de Vern · Rennes</div>
<div style="margin-top:12px;font-size:11px;line-height:1.6;color:#c6a56a;">La Kermesse · Nouvelle demande d’événement</div>
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
<title>Votre demande d’événement à La Kermesse</title>
</head>
<body style="margin:0;padding:0;background:#092934;font-family:Arial,Helvetica,sans-serif;color:#092934;">

<!-- PREHEADER -->
<div style="display:none;max-height:0;overflow:hidden;color:#092934;font-size:1px;line-height:1px;">
Nous avons reçu votre demande d’événement — {$reference} — {$dateFormatted} à {$timeElegant} pour {$partySizeLabel}.
</div>

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#092934;padding:32px 12px;">
<tr><td align="center">

<table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0" style="max-width:600px;width:100%;background:#f4efe4;border-radius:4px;overflow:hidden;">

<!-- HEADER -->
<tr>
<td align="center" style="background:#0d3442;padding:36px 24px 28px 24px;">
<div style="line-height:1;">{$wordmarkBig}</div>
<div style="margin-top:12px;font-size:10px;letter-spacing:0.18em;text-transform:uppercase;color:#f4efe4;">121 rue de Vern · Rennes</div>
</td>
</tr>

<tr><td>{$goldRule}</td></tr>

<!-- INTRO -->
<tr>
<td style="padding:36px 40px 18px 40px;">
<h1 style="margin:0 0 12px 0;font-family:Georgia,'Times New Roman',serif;font-weight:400;font-size:29px;line-height:1.25;color:#092934;">Merci {$firstName} !</h1>
<p style="margin:0;font-size:15px;line-height:1.8;color:#0d3442;">Nous avons bien reçu votre projet d’événement à La Kermesse. Notre équipe vous contactera personnellement sous 24h ouvrées pour en discuter avec vous.</p>
</td>
</tr>

<!-- REFERENCE -->
<tr>
<td style="padding:8px 40px 26px 40px;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#0d3442;border-left:3px solid #c6a56a;">
<tr><td style="padding:17px 20px;">
<div style="font-size:10px;letter-spacing:0.18em;text-transform:uppercase;color:#c6a56a;">Référence de votre demande</div>
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
<td style="padding:14px 0;font-size:11px;letter-spacing:0.12em;text-transform:uppercase;color:#0d3442;width:40%;">Événement</td>
<td style="padding:14px 0;font-family:Georgia,'Times New Roman',serif;font-size:17px;color:#092934;text-align:right;">{$eventType}</td>
</tr>
<tr>
<td style="padding:14px 0;border-top:1px dashed #dfd2bc;font-size:11px;letter-spacing:0.12em;text-transform:uppercase;color:#0d3442;">Date</td>
<td style="padding:14px 0;border-top:1px dashed #dfd2bc;font-family:Georgia,'Times New Roman',serif;font-size:17px;color:#092934;text-align:right;">{$dateElegant}</td>
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
</table>
</td>
</tr>

{$guestMessageBlock}

<!-- CONTACT NOTE -->
<tr>
<td style="padding:0 40px 24px 40px;">
<div style="padding:18px 20px;background:#e7dac4;border-left:3px solid #c6a56a;font-size:14px;line-height:1.8;color:#092934;">
Pour la modifier ou nous poser une question, répondez simplement à cet e-mail ou appelez-nous.
</div>
</td>
</tr>

<!-- CTA -->
<tr>
<td align="center" style="padding:0 32px 38px 32px;">
<a href="tel:+33982684417" style="display:inline-block;padding:15px 25px;background:#c6a56a;color:#092934;text-decoration:none;font-size:11px;font-weight:bold;letter-spacing:0.12em;text-transform:uppercase;border:1px solid #c6a56a;">Nous appeler | 09 82 68 44 17</a>
</td>
</tr>

<!-- FOOTER -->
<tr>
<td align="center" style="background:#092934;padding:27px 24px;">
<div style="line-height:1;">{$wordmarkSmall}</div>
<div style="margin-top:10px;font-size:10px;letter-spacing:0.16em;text-transform:uppercase;color:#f4efe4;">121 rue de Vern · Rennes</div>
<div style="margin-top:14px;font-size:11px;line-height:1.7;color:#d5dadd;">Vous recevez cet e-mail suite à votre demande d’événement.<br>Aucune donnée personnelle n’est cédée à des tiers.</div>
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
$guestAltBody .= "Nous avons bien reçu votre projet d’événement à La Kermesse.\n";
$guestAltBody .= "Notre équipe vous contactera personnellement sous 24h ouvrées.\n\n";
$guestAltBody .= "Événement    : {$eventType}\n";
$guestAltBody .= "Date         : {$dateElegant} à {$timeElegant}\n";
$guestAltBody .= "Convives     : {$partySizeLabel} — {$locationLabel}\n";
$guestAltBody .= "Référence    : {$reference}\n";
$guestAltBody .= "\n";
$guestAltBody .= "Un changement ? Répondez à cet e-mail ou appelez-nous au 09 82 68 44 17.\n\n";
$guestAltBody .= "À très bientôt,\n";
$guestAltBody .= "La Kermesse — 121 rue de Vern, Rennes";

// ---------- Demo mode ----------
if (defined('DEMO_MODE') && DEMO_MODE) {
    jsonResponse([
        'success'   => true,
        'reference' => $reference,
        'message'   => 'Mode démo : e-mails non envoyés.'
    ]);
}

// ============================================================
// SEND
// ============================================================
try {
    $mail = newMailer();
    $mail->setFrom(FROM_EMAIL, defined('FROM_NAME_EVENT') ? FROM_NAME_EVENT : FROM_NAME);

    // → Restaurant / events team
    $notifyEmail = defined('EVENT_EMAIL') ? EVENT_EMAIL : RESTAURANT_EMAIL;
    $notifyName  = defined('EVENT_NAME')  ? EVENT_NAME  : RESTAURANT_NAME;

    $mail->addAddress($notifyEmail, $notifyName);
    $mail->addReplyTo($email, $firstName . ' ' . $lastName);
    $mail->Subject = $restaurantSubject;
    $mail->Body    = $restaurantBody;
    attachKermesseLogo($mail);
    $mail->send();

    // → Guest
    $mail->clearAddresses();
    $mail->clearReplyTos();
    $mail->clearAttachments();
    $mail->addAddress($email, $firstName . ' ' . $lastName);
    $mail->Subject = $guestSubject;
    $mail->Body    = $guestBody;
    $mail->AltBody = $guestAltBody;
    attachKermesseLogo($mail);
    $mail->send();

    jsonResponse(['success' => true, 'reference' => $reference]);
} catch (Throwable $e) {
    error_log('Event Mailer Error: ' . $e->getMessage());
    jsonResponse(['success' => false, 'message' => "L'envoi a échoué. Veuillez réessayer ou nous appeler."], 500);
}