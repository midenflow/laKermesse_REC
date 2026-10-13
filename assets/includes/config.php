<?php

/** La Kermesse — Global configuration */

####======= Site metadata
$website_version = 'v1';
$author          = 'Midenflow.com';
$author_website  = 'https://midenflow.com';

####======= SMTP (Gmail)
define('SMTP_HOST',   'smtp.gmail.com');
define('SMTP_PORT',   587);
define('SMTP_USER',   'midenflow.team@gmail.com');
define('SMTP_PASS',   'zwwmtmothifplurf');
define('SMTP_SECURE', 'tls');                        // tls (587) or ssl (465)

// ============================================
// Email addresses — Tables
// ============================================
define('RESTAURANT_EMAIL', 'midenflow.team@gmail.com');
define('RESTAURANT_NAME',  'La Kermesse');

define('FROM_EMAIL',       'midenflow.team@gmail.com');
define('FROM_NAME',        'La Kermesse Réservation');

// ============================================
// Email addresses — Events
// ============================================
define('EVENT_EMAIL', 'midenflow.team@gmail.com');
define('EVENT_NAME',  'La Kermesse Événements');

define('FROM_NAME_EVENT', 'La Kermesse Événements');

// ============================================
// Table booking rules
// ============================================
define('MAX_PARTY_SIZE',        18);
define('MAX_PARTY_SIZE_CUSTOM', 500);
define('LARGE_PARTY_THRESHOLD', 20);
define('MAX_ADVANCE_DAYS',      60);

// ============================================
// Event booking rules
// ============================================
define('EVENT_MIN_GUESTS',       10);
define('EVENT_MAX_GUESTS',       300);
define('EVENT_MAX_ADVANCE_DAYS', 730);   	// 2 years ahead

// ============================================
// Mode
// ============================================
define('DEMO_MODE', false);

// ============================================
// PHPMailer includes
// ============================================
require_once __DIR__ . '/PHPMailer/Exception.php';
require_once __DIR__ . '/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

// ============================================
// Configure a PHPMailer instance with Gmail SMTP
// ============================================
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