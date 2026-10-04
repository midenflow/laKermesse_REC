<?php

/**  La Kermesse — Global configuration */

####======= SMTP (Gmail)
$website_version = 'v1';
$author = 'Midenflow.com';

####======= SMTP (Gmail)
define('SMTP_HOST',   'smtp.gmail.com');
define('SMTP_PORT',   587);
define('SMTP_USER',   'midenflow.team@gmail.com'); 
define('SMTP_PASS',   'zwwmtmothifplurf');
define('SMTP_SECURE', 'tls');                        // tls (587) or ssl (465)


// ============================================
// Email addresses
// ============================================
define('RESTAURANT_EMAIL', 'midenflow.team@gmail.com'); // ← change
define('RESTAURANT_NAME',  'La Kermesse');

define('FROM_EMAIL',       'midenflow.team@gmail.com');
define('FROM_NAME',        'La Kermesse Réservation');


####======= Booking rules
define('MAX_PARTY_SIZE',   12);
define('MAX_ADVANCE_DAYS', 60);

####======= MODE
define('DEMO_MODE', false); // true = simulate success, no emails sent


####======= PHPMailer includes
require_once __DIR__ . '/PHPMailer/Exception.php';
require_once __DIR__ . '/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

####======= Configure a PHPMailer instance with Gmail SMTP

function setupSMTP(PHPMailer $mail): void
{
    $mail->isSMTP();
    $mail->Host       = SMTP_HOST;
    $mail->SMTPAuth   = true;
    $mail->Username   = SMTP_USER;
    $mail->Password   = SMTP_PASS;
    $mail->SMTPSecure = SMTP_SECURE === 'ssl'
        ? PHPMailer::ENCRYPTION_SMTPS
        : PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = SMTP_PORT;
    $mail->CharSet    = 'UTF-8';
    $mail->isHTML(true);
}