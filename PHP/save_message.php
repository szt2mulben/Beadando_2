<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();

require __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /');
    exit;
}

$errors = [];

$name    = trim($_POST['name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');
$gdpr    = isset($_POST['gdpr']) && $_POST['gdpr'] === 'on';

if ($name === '' || $email === '' || $message === '') {
    $errors[] = 'A név, email és üzenet mezők kitöltése kötelező.';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Kérjük, érvényes email címet adj meg.';
}

if (!$gdpr) {
    $errors[] = 'A GDPR feltételek elfogadása kötelező.';
}

if (!empty($errors)) {
    $_SESSION['msg_errors'] = $errors;
    header('Location: /');
    exit;
}

try {
    $stmt = $pdo->prepare('
        INSERT INTO messages (name, email, subject, message, created_at)
        VALUES (:name, :email, :subject, :message, NOW())
    ');
    $stmt->execute([
        ':name'    => $name,
        ':email'   => $email,
        ':subject' => $subject,
        ':message' => $message
    ]);

    $_SESSION['msg_success'] = 'Köszönjük, az üzenetedet sikeresen elküldtük.';
    header('Location: /');
    exit;

} catch (PDOException $e) {
    error_log('ERROR [save_message.php]: ' . $e->getMessage());
    $_SESSION['msg_errors'] = ['Hiba történt az üzenet mentése során. Kérjük, próbáld újra később.'];
    header('Location: /');
    exit;
}
