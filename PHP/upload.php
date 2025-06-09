<?php
session_start();
header('Content-Type: application/json; charset=UTF-8');
require_once 'config.php';

$response = ['status'=>'error','message'=>'Ismeretlen hiba.'];

if (!isset($_SESSION['felhasznalo'])) {
    $response['message'] = 'Nem vagy bejelentkezve!';
    echo json_encode($response);
    exit;
}
$felhasznalo = $_SESSION['felhasznalo'];
if (!in_array($felhasznalo['szerep'], ['admin','user'])) {
    $response['message'] = 'Nincs jogosultságod feltölteni.';
    echo json_encode($response);
    exit;
}
if (empty($_FILES['kep']) || $_FILES['kep']['error']!==UPLOAD_ERR_OK) {
    $response['message'] = 'Nem választottál fájlt, vagy hiba történt.';
    echo json_encode($response);
    exit;
}

$fajlnev = time().'_'.basename($_FILES['kep']['name']);
$celut   = __DIR__.'/../Gallery/'.$fajlnev;
if (!move_uploaded_file($_FILES['kep']['tmp_name'],$celut)) {
    $response['message']='Hiba a fájl mentésekor.';
    echo json_encode($response);
    exit;
}

$stmt = $pdo->prepare("INSERT INTO kepek (fajlnev, feltolto) VALUES (?,?)");
if ($stmt->execute([$fajlnev,$felhasznalo['nev']])) {
  $response = [
    'status'=>'ok',
    'message'=>'Sikeres feltöltés.',
    'url'=>'/Gallery/'.$fajlnev
  ];
} else {
  $response['message']='Hiba az adatbázisba íráskor.';
}

echo json_encode($response);
