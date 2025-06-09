<?php
$host = 'mysql.omega';
$db   = 'vaszilijedc1';
$user = 'vaszilijedc1';
$pass = 'Jelszojelszo00';
$charset = 'utf8';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Adatbázis hiba: ' . $e->getMessage());
}
?>