<?php
// assets/includes/send_event_booking.php

declare(strict_types=1);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/booking-core.php';

$mail = newMailer();
$mail->setFrom(FROM_EMAIL, FROM_NAME_EVENT);
$mail->addAddress(EVENT_EMAIL, EVENT_NAME);

header('Content-Type: application/json; charset=utf-8');

requirePost();
requireCsrf();
rejectHoneypot();

// ---- Collect event-specific fields ----
$firstName   = clean($_POST['firstName']   ?? '');
$lastName    = clean($_POST['lastName']    ?? '');
$eventType   = clean($_POST['eventType']   ?? '');
$eventDate   = clean($_POST['eventDate']   ?? '');
$partySize   = (int) ($_POST['partySize']  ?? 0);
$email       = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
$phone       = clean($_POST['phone']       ?? '');
$message     = clean($_POST['message']     ?? '');

// ---- Validate ----
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

if ($partySize < 10 || $partySize > 300) $errors[] = 'Nombre de personnes invalide (10 à 300).';
if ($e = validateName($firstName, 'Prénom')) $errors[] = $e;
if ($e = validateName($lastName,  'Nom'))    $errors[] = $e;
if ($e = validateEmail($email))              $errors[] = $e;
if ($e = validateFrenchPhone($phone))        $errors[] = $e;

if ($errors) {
    jsonResponse(['success' => false, 'message' => implode(' ', $errors)], 422);
}

// ---- Build & send event emails ----
$reference = makeReference('EVT');
$dateObj   = DateTime::createFromFormat('Y-m-d', $eventDate);
$dateFormatted = $dateObj ? $dateObj->format('d/m/Y') : $eventDate;

// … your event email templates here …

try {
    $mail = newMailer();

    $mail->addAddress(RESTAURANT_EMAIL, RESTAURANT_NAME);
    $mail->Subject = "Nouvel événement – $reference";
    $mail->Body    = $restaurantBody;
    $mail->send();

    $mail->clearAddresses();
    $mail->addAddress($email, "$firstName $lastName");
    $mail->Subject = "Votre demande d’événement à La Kermesse – $reference";
    $mail->Body    = $guestBody;
    $mail->AltBody = $guestAltBody;
    $mail->send();

    jsonResponse(['success' => true, 'reference' => $reference]);
} catch (Throwable $e) {
    error_log('Event Mailer Error: ' . $e->getMessage());
    jsonResponse(['success' => false, 'message' => "L'envoi a échoué."], 500);
}