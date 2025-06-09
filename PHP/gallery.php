<?php
require_once 'config.php';

$stmt = $pdo->query("SELECT fajlnev FROM kepek ORDER BY datum DESC");
$kepek = [];
while ($row = $stmt->fetch()) {
    $clean = str_replace('\\', '/', $row['fajlnev']);
    $file = basename($row['fajlnev']);
    $kepek[] = '/Gallery/' . $file;
}
echo json_encode($kepek);
