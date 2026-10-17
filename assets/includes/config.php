<?php

/** La Kermesse — Global configuration */

####======= Site metadata + banner

$website_version = 'v1';
$author          = 'Midenflow.com';
$author_website  = 'https://midenflow.com';

// ============================================
$copyright = "<!--\n"
    . "============================================\n"
    . "La Kermesse          : (" . htmlspecialchars($website_version, ENT_QUOTES, 'UTF-8') . ")\n"
    . "Design & development : " . htmlspecialchars($author, ENT_QUOTES, 'UTF-8') . "\n"
    . "Author Website       : " . htmlspecialchars($author_website, ENT_QUOTES, 'UTF-8') . "\n"
    . "============================================\n"
    . "-->\n";

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

// ============================================
// Session & CSRF
// ============================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf" value="'
         . htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') . '">';
}

// ============================================
// n8n webhook ( logging pipeline)
// ============================================
define('N8N_WEBHOOK_URL',    'https://vmi3402396.contaboserver.net/webhook/40c29c04-0a98-426d-8bc1-29a54e49632d');
define('N8N_WEBHOOK_SECRET', '40c29c04-0a98-426d-8bc1-29a54e49632d');

/**  * Send a payload to the n8n webhook for logging. 	*/
function sendToN8n(array $payload): void
{
    if (!defined('N8N_WEBHOOK_URL') || !N8N_WEBHOOK_URL) {
        error_log('[n8n] SKIPPED — N8N_WEBHOOK_URL not defined');
        return;
    }

    error_log('[n8n] → ' . N8N_WEBHOOK_URL);

    $body = json_encode($payload, JSON_UNESCAPED_UNICODE);
    if ($body === false) {
        error_log('[n8n] JSON encode failed: ' . json_last_error_msg());
        return;
    }
    error_log('[n8n] payload: ' . strlen($body) . ' bytes');

    $ch = curl_init(N8N_WEBHOOK_URL);
    if ($ch === false) {
        error_log('[n8n] curl_init failed');
        return;
    }

    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $body,
        CURLOPT_HTTPHEADER     => [
            'Content-Type: application/json',
            'X-Webhook-Secret: ' . N8N_WEBHOOK_SECRET,
        ],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 5,
        CURLOPT_CONNECTTIMEOUT => 3,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2,
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlErr  = curl_error($ch);
    $errNo    = curl_errno($ch);
    curl_close($ch);

    if ($response === false || $errNo !== 0) {
        error_log(sprintf('[n8n] CURL ERROR #%d: %s', $errNo, $curlErr));
        return;
    }

    error_log(sprintf(
        '[n8n] HTTP %d — body: %s',
        $httpCode,
        substr((string)$response, 0, 300)
    ));
}