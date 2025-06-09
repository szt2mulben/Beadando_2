<?php
session_start();
header('Content-Type: application/json; charset=UTF-8');
require_once 'config.php';

if (!isset($_SESSION['felhasznalo'])
    || $_SESSION['felhasznalo']['szerep'] !== 'admin'
) {
  http_response_code(403);
  echo json_encode(['error' => 'Nincs jogosultságod.']);
  exit;
}

$stmt = $pdo->query("
  SELECT id, name, email, subject, message, created_at
  FROM messages
  ORDER BY created_at DESC
");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data);
