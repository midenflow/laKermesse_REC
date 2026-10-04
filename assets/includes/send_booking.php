<?php
declare(strict_types=1);

session_start();

use PHPMailer\PHPMailer\PHPMailer;

header('Content-Type: application/json; charset=utf-8');

// ---------- Helpers ----------
function jsonResponse(array $data, int $code = 200): void {
    http_response_code($code);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

function clean(string $value): string {
    return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}

// ---------- Config ----------
require_once __DIR__ . '/config.php';

// ---------- Safety: required constants ----------
foreach ([
    'MAX_ADVANCE_DAYS', 'MAX_PARTY_SIZE',
    'SMTP_HOST', 'SMTP_PORT', 'SMTP_USER', 'SMTP_PASS', 'SMTP_SECURE',
    'RESTAURANT_EMAIL', 'RESTAURANT_NAME', 'FROM_EMAIL', 'FROM_NAME',
] as $c) {
    if (!defined($c)) {
        error_log("send_booking.php: missing constant $c");
        jsonResponse(['success' => false, 'message' => 'Configuration incomplète.'], 500);
    }
}

// ---------- Only POST ----------
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(['success' => false, 'message' => 'Méthode non autorisée.'], 405);
}

// ---------- CSRF ----------
$csrf = $_POST['csrf'] ?? '';
if (empty($csrf) || !hash_equals($_SESSION['csrf_token'] ?? '', $csrf)) {
    jsonResponse(['success' => false, 'message' => 'Jeton de sécurité invalide. Rechargez la page.'], 403);
}

// ---------- Honeypot ----------
if (!empty($_POST['website'])) {
    jsonResponse(['success' => true, 'status' => 'confirmed', 'reference' => 'BOT-' . uniqid()]);
}

// ---------- Collect & sanitise ----------
$date      = clean($_POST['date']      ?? '');
$time      = clean($_POST['time']      ?? '');
$partySize = (int) ($_POST['partySize'] ?? 0);
$location  = clean($_POST['location']  ?? '');
$firstName = clean($_POST['firstName'] ?? '');
$lastName  = clean($_POST['lastName']  ?? '');
$email     = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
$phone     = clean($_POST['phone']     ?? '');
$message   = clean($_POST['message']   ?? '');

// ---------- Validation ----------
$errors = [];

// Date
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

// Time
if (!preg_match('/^\d{2}:\d{2}$/', $time)) {
    $errors[] = 'Horaire invalide.';
}

// Party size
if ($partySize < 1 || $partySize > MAX_PARTY_SIZE) {
    $errors[] = 'Nombre de convives invalide.';
}

// Location — NEW
if (!in_array($location, ['inside', 'outside'], true)) {
    $errors[] = 'Emplacement invalide.';
}

// Names
if (mb_strlen($firstName) < 2) $errors[] = 'Prénom trop court.';
if (mb_strlen($lastName)  < 2) $errors[] = 'Nom trop court.';

// Email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Adresse e-mail invalide.';
}

// French phone
$phoneClean = preg_replace('/[\s.\-]/', '', $phone);
if (!preg_match('/^(?:\+33|0)[1-9]\d{8}$/', $phoneClean)) {
    $errors[] = 'Numéro de téléphone invalide.';
}

if (!empty($errors)) {
    jsonResponse(['success' => false, 'message' => implode(' ', $errors)], 422);
}

// ---------- Reference ----------
$reference = 'KER-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));

// ---------- Formatted values ----------
$dateObj       = DateTime::createFromFormat('Y-m-d', $date);
$dateFormatted = $dateObj ? $dateObj->format('d/m/Y') : $date;
$locationLabel = $location === 'inside' ? 'Intérieur' : 'Extérieur';

// ---------- Subjects ----------
$restaurantSubject = "Nouvelle réservation – $reference";
$guestSubject      = "Votre réservation à La Kermesse – $reference";

// ============================================================
// Shared markup — wordmark + rainbow rule
// Colours taken from the logo image
// ============================================================
$wordmarkBig = '<span style="color:#29ABE2;">l</span>'
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

$wordmarkSmall = $wordmarkBig;

$rainbowRule = '<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;">'
             . '<tr>'
             . '<td width="16.66%" height="5" style="background:#29ABE2;line-height:5px;font-size:0;">&nbsp;</td>'
             . '<td width="16.66%" height="5" style="background:#F15A5A;line-height:5px;font-size:0;">&nbsp;</td>'
             . '<td width="16.66%" height="5" style="background:#F7D74C;line-height:5px;font-size:0;">&nbsp;</td>'
             . '<td width="16.66%" height="5" style="background:#4ECB8C;line-height:5px;font-size:0;">&nbsp;</td>'
             . '<td width="16.66%" height="5" style="background:#F5A15E;line-height:5px;font-size:0;">&nbsp;</td>'
             . '<td width="16.66%" height="5" style="background:#F48FB1;line-height:5px;font-size:0;">&nbsp;</td>'
             . '</tr></table>';

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
<body style="margin:0;padding:0;background:#06171f;font-family:Arial,Helvetica,sans-serif;color:#0d3442;">
  <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
         style="background:#06171f;padding:32px 16px;">
    <tr>
      <td align="center">
        <table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0"
               style="max-width:600px;width:100%;background:#f4efe4;border-radius:2px;overflow:hidden;">

          <!-- HEADER — logo wordmark -->
          <tr>
            <td style="background:#0d3442;padding:26px 32px;">
              <div style="font-family:Georgia,'Times New Roman',serif;font-style:italic;font-size:30px;line-height:1;letter-spacing:-0.02em;">
                <span style="color:#29ABE2;">l</span><span style="color:#F15A5A;">a</span>&nbsp;<span style="color:#F7D74C;">K</span><span style="color:#F48FB1;">e</span><span style="color:#4ECB8C;">r</span><span style="color:#29ABE2;">m</span><span style="color:#F5A15E;">e</span><span style="color:#F7D74C;">s</span><span style="color:#F48FB1;">s</span><span style="color:#4ECB8C;">e</span>
              </div>
              <div style="margin-top:8px;font-size:11px;letter-spacing:0.18em;text-transform:uppercase;color:#f4efe4;opacity:0.75;">
                Nouvelle demande de réservation
              </div>
            </td>
          </tr>

          <!-- RAINBOW RULE (was gold) -->
          <tr>
            <td style="padding:0;">
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;">
                <tr>
                  <td width="16.66%" height="4" style="background:#29ABE2;line-height:4px;font-size:0;">&nbsp;</td>
                  <td width="16.66%" height="4" style="background:#F15A5A;line-height:4px;font-size:0;">&nbsp;</td>
                  <td width="16.66%" height="4" style="background:#F7D74C;line-height:4px;font-size:0;">&nbsp;</td>
                  <td width="16.66%" height="4" style="background:#4ECB8C;line-height:4px;font-size:0;">&nbsp;</td>
                  <td width="16.66%" height="4" style="background:#F5A15E;line-height:4px;font-size:0;">&nbsp;</td>
                  <td width="16.66%" height="4" style="background:#F48FB1;line-height:4px;font-size:0;">&nbsp;</td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- DETAILS TABLE -->
          <tr>
            <td style="padding:32px 32px 8px 32px;">
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                     style="border-top:1px solid #dfd2bc;">
                <tr>
                  <td style="padding:12px 0;font-size:11px;letter-spacing:0.14em;text-transform:uppercase;color:#0d3442;width:38%;">Référence</td>
                  <td style="padding:12px 0;font-family:Georgia,serif;font-size:17px;color:#071e28;text-align:right;">{$reference}</td>
                </tr>
                <tr>
                  <td style="padding:12px 0;border-top:1px dashed #dfd2bc;font-size:11px;letter-spacing:0.14em;text-transform:uppercase;color:#0d3442;">Date</td>
                  <td style="padding:12px 0;border-top:1px dashed #dfd2bc;font-family:Georgia,serif;font-size:17px;color:#071e28;text-align:right;">{$dateFormatted}</td>
                </tr>
                <tr>
                  <td style="padding:12px 0;border-top:1px dashed #dfd2bc;font-size:11px;letter-spacing:0.14em;text-transform:uppercase;color:#0d3442;">Heure</td>
                  <td style="padding:12px 0;border-top:1px dashed #dfd2bc;font-family:Georgia,serif;font-size:17px;color:#071e28;text-align:right;">{$time}</td>
                </tr>
                <tr>
                  <td style="padding:12px 0;border-top:1px dashed #dfd2bc;font-size:11px;letter-spacing:0.14em;text-transform:uppercase;color:#0d3442;">Convives</td>
                  <td style="padding:12px 0;border-top:1px dashed #dfd2bc;font-family:Georgia,serif;font-size:17px;color:#071e28;text-align:right;">{$partySize}</td>
                </tr>
                <tr>
                  <td style="padding:12px 0;border-top:1px dashed #dfd2bc;font-size:11px;letter-spacing:0.14em;text-transform:uppercase;color:#0d3442;">Emplacement</td>
                  <td style="padding:12px 0;border-top:1px dashed #dfd2bc;font-family:Georgia,serif;font-size:17px;color:#071e28;text-align:right;">{$locationLabel}</td>
                </tr>
                <tr>
                  <td style="padding:12px 0;border-top:1px dashed #dfd2bc;font-size:11px;letter-spacing:0.14em;text-transform:uppercase;color:#0d3442;">Client</td>
                  <td style="padding:12px 0;border-top:1px dashed #dfd2bc;font-family:Georgia,serif;font-size:17px;color:#071e28;text-align:right;">{$firstName} {$lastName}</td>
                </tr>
                <tr>
                  <td style="padding:12px 0;border-top:1px dashed #dfd2bc;font-size:11px;letter-spacing:0.14em;text-transform:uppercase;color:#0d3442;">E-mail</td>
                  <td style="padding:12px 0;border-top:1px dashed #dfd2bc;font-size:14px;color:#071e28;text-align:right;word-break:break-all;">{$email}</td>
                </tr>
                <tr>
                  <td style="padding:12px 0;border-top:1px dashed #dfd2bc;font-size:11px;letter-spacing:0.14em;text-transform:uppercase;color:#0d3442;">Téléphone</td>
                  <td style="padding:12px 0;border-top:1px dashed #dfd2bc;font-size:14px;color:#071e28;text-align:right;">{$phone}</td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- MESSAGE -->
          <tr>
            <td style="padding:8px 32px 36px 32px;">
              <div style="padding:16px 18px;background:#e7dac4;border-left:3px solid #c6a56a;font-size:14px;line-height:1.6;color:#071e28;">
                <strong style="display:block;font-size:11px;letter-spacing:0.14em;text-transform:uppercase;color:#0d3442;margin-bottom:6px;">
                  Message du client
                </strong>
                {$message}
              </div>
            </td>
          </tr>

          <!-- FOOTER — logo wordmark -->
          <tr>
            <td style="background:#071e28;padding:24px 32px;text-align:center;">
              <div style="font-family:Georgia,'Times New Roman',serif;font-style:italic;font-size:20px;line-height:1;letter-spacing:-0.02em;margin-bottom:10px;">
                <span style="color:#29ABE2;">l</span><span style="color:#F15A5A;">a</span>&nbsp;<span style="color:#F7D74C;">K</span><span style="color:#F48FB1;">e</span><span style="color:#4ECB8C;">r</span><span style="color:#29ABE2;">m</span><span style="color:#F5A15E;">e</span><span style="color:#F7D74C;">s</span><span style="color:#F48FB1;">s</span><span style="color:#4ECB8C;">e</span>
              </div>
              <div style="font-size:11px;color:#f4efe4;opacity:0.75;letter-spacing:0.16em;text-transform:uppercase;">
                121 rue de Vern - Rennes
              </div>
            </td>
          </tr>

        </table>
      </td>
    </tr>
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
<body style="margin:0;padding:0;background:#06171f;font-family:Arial,Helvetica,sans-serif;color:#0d3442;">

  <!-- Preheader -->
  <div style="display:none;max-height:0;overflow:hidden;color:#06171f;font-size:1px;">
    Référence {$reference} — {$dateFormatted} à {$time} pour {$partySize} convives ({$locationLabel}).
  </div>

  <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
         style="background:#06171f;padding:32px 16px;">
    <tr>
      <td align="center">
        <table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0"
               style="max-width:600px;width:100%;background:#f4efe4;border-radius:2px;overflow:hidden;">

          <!-- HEADER — logo wordmark -->
          <tr>
            <td align="center" style="background:#0d3442;padding:36px 32px 30px 32px;">
              <div style="font-family:Georgia,'Times New Roman',serif;font-style:italic;font-size:40px;line-height:1;letter-spacing:-0.02em;">
                <span style="color:#29ABE2;">l</span><span style="color:#F15A5A;">a</span>&nbsp;<span style="color:#F7D74C;">K</span><span style="color:#F48FB1;">e</span><span style="color:#4ECB8C;">r</span><span style="color:#29ABE2;">m</span><span style="color:#F5A15E;">e</span><span style="color:#F7D74C;">s</span><span style="color:#F48FB1;">s</span><span style="color:#4ECB8C;">e</span>
              </div>
              <div style="margin-top:12px;font-size:11px;letter-spacing:0.22em;text-transform:uppercase;color:#f4efe4;opacity:0.7;">
                121 rue de Vern - Rennes
              </div>
            </td>
          </tr>

          <!-- RAINBOW RULE (was gold) -->
          <tr>
            <td style="padding:0;">
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;">
                <tr>
                  <td width="16.66%" height="4" style="background:#29ABE2;line-height:4px;font-size:0;">&nbsp;</td>
                  <td width="16.66%" height="4" style="background:#F15A5A;line-height:4px;font-size:0;">&nbsp;</td>
                  <td width="16.66%" height="4" style="background:#F7D74C;line-height:4px;font-size:0;">&nbsp;</td>
                  <td width="16.66%" height="4" style="background:#4ECB8C;line-height:4px;font-size:0;">&nbsp;</td>
                  <td width="16.66%" height="4" style="background:#F5A15E;line-height:4px;font-size:0;">&nbsp;</td>
                  <td width="16.66%" height="4" style="background:#F48FB1;line-height:4px;font-size:0;">&nbsp;</td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- INTRO -->
          <tr>
            <td style="padding:40px 40px 8px 40px;">
              <h1 style="margin:0 0 10px 0;font-family:Georgia,'Times New Roman',serif;font-weight:400;font-size:30px;line-height:1.15;color:#071e28;">
                Merci {$firstName}&nbsp;!
              </h1>
              <p style="margin:0 0 20px 0;font-size:15px;line-height:1.6;color:#0d3442;">
                Nous avons bien reçu votre demande de réservation à La Kermesse. Voici le récapitulatif de votre table.
              </p>
            </td>
          </tr>

          <!-- REFERENCE BOX -->
          <tr>
            <td style="padding:0 40px 24px 40px;">
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                     style="background:#0d3442;border-left:3px solid #c6a56a;">
                <tr>
                  <td style="padding:16px 20px;">
                    <div style="font-size:10px;letter-spacing:0.18em;text-transform:uppercase;color:#c6a56a;">
                      Référence
                    </div>
                    <div style="margin-top:4px;font-family:Georgia,'Times New Roman',serif;font-size:22px;color:#f4efe4;letter-spacing:0.02em;">
                      {$reference}
                    </div>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- DETAILS -->
          <tr>
            <td style="padding:0 40px 32px 40px;">
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                     style="border-top:1px solid #dfd2bc;border-bottom:1px solid #dfd2bc;">
                <tr>
                  <td style="padding:14px 0;font-size:11px;letter-spacing:0.14em;text-transform:uppercase;color:#0d3442;width:40%;">
                    Date
                  </td>
                  <td style="padding:14px 0;font-family:Georgia,'Times New Roman',serif;font-size:17px;color:#071e28;text-align:right;">
                    {$dateFormatted}
                  </td>
                </tr>
                <tr>
                  <td style="padding:14px 0;font-size:11px;letter-spacing:0.14em;text-transform:uppercase;color:#0d3442;border-top:1px dashed #dfd2bc;">
                    Heure
                  </td>
                  <td style="padding:14px 0;font-family:Georgia,'Times New Roman',serif;font-size:17px;color:#071e28;text-align:right;border-top:1px dashed #dfd2bc;">
                    {$time}
                  </td>
                </tr>
                <tr>
                  <td style="padding:14px 0;font-size:11px;letter-spacing:0.14em;text-transform:uppercase;color:#0d3442;border-top:1px dashed #dfd2bc;">
                    Convives
                  </td>
                  <td style="padding:14px 0;font-family:Georgia,'Times New Roman',serif;font-size:17px;color:#071e28;text-align:right;border-top:1px dashed #dfd2bc;">
                    {$partySize}
                  </td>
                </tr>
                <tr>
                  <td style="padding:14px 0;font-size:11px;letter-spacing:0.14em;text-transform:uppercase;color:#0d3442;border-top:1px dashed #dfd2bc;">
                    Emplacement
                  </td>
                  <td style="padding:14px 0;font-family:Georgia,'Times New Roman',serif;font-size:17px;color:#071e28;text-align:right;border-top:1px dashed #dfd2bc;">
                    {$locationLabel}
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- NOTE -->
          <tr>
            <td style="padding:0 40px 36px 40px;">
              <p style="margin:0;padding:18px 20px;background:#e7dac4;border-left:3px solid #c6a56a;font-size:14px;line-height:1.6;color:#071e28;">
                L’équipe vous confirmera votre table dans les plus brefs délais. Pour modifier votre réservation, répondez simplement à cet e-mail ou appelez-nous.
              </p>
            </td>
          </tr>

          <!-- CTA -->
          <tr>
            <td align="center" style="padding:0 40px 44px 40px;">
              <a href="tel:+33982684417"
                 style="display:inline-block;padding:14px 28px;background:#071e28;color:#f4efe4;text-decoration:none;font-size:12px;font-weight:bold;letter-spacing:0.16em;text-transform:uppercase;border:1px solid #071e28;">
                Nous appeler&nbsp;&nbsp;·&nbsp;&nbsp;09 82 68 44 17
              </a>
            </td>
          </tr>

          <!-- FOOTER -->
          <tr>
            <td style="background:#071e28;padding:26px 40px;text-align:center;">
              <div style="font-family:Georgia,'Times New Roman',serif;font-style:italic;font-size:22px;line-height:1;letter-spacing:-0.02em;margin-bottom:8px;">
                <span style="color:#29ABE2;">l</span><span style="color:#F15A5A;">a</span>&nbsp;<span style="color:#F7D74C;">K</span><span style="color:#F48FB1;">e</span><span style="color:#4ECB8C;">r</span><span style="color:#29ABE2;">m</span><span style="color:#F5A15E;">e</span><span style="color:#F7D74C;">s</span><span style="color:#F48FB1;">s</span><span style="color:#4ECB8C;">e</span>
              </div>
              <div style="font-size:11px;letter-spacing:0.18em;text-transform:uppercase;color:#f4efe4;opacity:0.75;">
                121 rue de Vern - Rennes
              </div>
              <div style="margin-top:14px;font-size:11px;color:#f4efe4;opacity:0.45;line-height:1.6;">
                Vous recevez cet e-mail suite à votre demande de réservation.<br>
                Aucune donnée personnelle n’est cédée à des tiers.
              </div>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>
</html>
HTML;

// ============================================================
// GUEST PLAIN-TEXT FALLBACK
// ============================================================
$guestAltBody  = "Merci {$firstName} !\n\n";
$guestAltBody .= "Nous avons bien reçu votre demande de réservation à La Kermesse.\n\n";
$guestAltBody .= "Référence    : {$reference}\n";
$guestAltBody .= "Date         : {$dateFormatted}\n";
$guestAltBody .= "Heure        : {$time}\n";
$guestAltBody .= "Convives     : {$partySize}\n";
$guestAltBody .= "Emplacement  : {$locationLabel}\n\n";
$guestAltBody .= "L’équipe vous confirmera votre table dans les plus brefs délais.\n";
$guestAltBody .= "Pour modifier votre réservation, répondez à cet e-mail ou appelez le 09 82 68 44 17.\n\n";
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

// ---------- Send ----------
try {
    $mail = new PHPMailer(true);
    setupSMTP($mail);
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
    error_log('Mailer Error: ' . $e->getMessage());
    jsonResponse([
        'success' => false,
        'message' => "L'envoi de l'e-mail a échoué. Veuillez réessayer ou nous appeler.",
    ], 500);
}