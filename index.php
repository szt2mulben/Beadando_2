<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$path = rtrim($uri, '/');

if ($path === '') {
    $path = '/';
}


if ($path === '/') {
    include __DIR__ . '/index.html';
    exit;
}

if ($path === '/Blog') {
    include __DIR__ . '/Blog/blog.html';
    exit;
}

if ($path === '/Tamogatas') {
    include __DIR__ . '/Tamogatas/tamogatas.html';
    exit;
}

if ($path === '/login') {
    include __DIR__ . '/PHP/login.php';
    exit;
}

if ($path === '/register') {
    include __DIR__ . '/PHP/register.php';
    exit;
}

if ($path === '/logout') {
    include __DIR__ . '/PHP/logout.php';
    exit;
}
if ($path === '/admin') {
    include __DIR__ . '/Admin/admin.html';
    exit;
}
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <title>404 – Nem található</title>
</head>
<body>
  <h1>404 – A kért oldal nem található</h1>
  <p>Kérlek, ellenőrizd az URL címet.</p>
  <p><a href="/">Vissza a főoldalra</a></p>
</body>
</html>
<?php
exit;
