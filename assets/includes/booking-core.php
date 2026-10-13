<?php

### booking-core.php

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use PHPMailer\PHPMailer\PHPMailer;

// ---------- Config ----------
require_once __DIR__ . '/config.php';

// ---------- JSON response ----------
function jsonResponse(array $data, int $code = 200): void {
    http_response_code($code);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

// ---------- Sanitise ----------
function clean(string $value): string {
    return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}

// ---------- Common guards ----------
function requirePost(): void {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        jsonResponse(['success' => false, 'message' => 'Méthode non autorisée.'], 405);
    }
}

function requireCsrf(): void {
    $csrf = $_POST['csrf'] ?? '';
    if (empty($csrf) || !hash_equals($_SESSION['csrf_token'] ?? '', $csrf)) {
        jsonResponse(['success' => false, 'message' => 'Jeton de sécurité invalide. Rechargez la page.'], 403);
    }
}

function rejectHoneypot(): void {
    if (!empty($_POST['website'])) {
        jsonResponse(['success' => true, 'status' => 'confirmed', 'reference' => 'BOT-' . uniqid()]);
    }
}

// ---------- Common field validators ----------
function validateName(string $value, string $label): ?string {
    if (mb_strlen($value) < 2) return "$label trop court.";
    return null;
}

function validateEmail(string $email): ?string {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return 'Adresse e-mail invalide.';
    return null;
}

function validateFrenchPhone(string $phone): ?string {
    $clean = preg_replace('/[\s.\-]/', '', $phone);
    if (!preg_match('/^(?:\+33|0)[1-9]\d{8}$/', $clean)) return 'Numéro de téléphone invalide.';
    return null;
}

// ---------- Reference generator ----------
function makeReference(string $prefix): string {
    return $prefix . '-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
}

// ---------- Mailer ----------
function newMailer(): PHPMailer {
    $mail = new PHPMailer(true);
    setupSMTP($mail);                						# defined in config.php
    $mail->setFrom(FROM_EMAIL, FROM_NAME);
    return $mail;
}

// ---------- HTML escaping for email bodies ----------
function emailSafe(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}