<?php
session_start();
require 'config.php';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $password2= $_POST['password2'];

    if (empty($username) || empty($email) || empty($password)) {
        $errors[] = 'Minden mező kitöltése kötelező.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Érvénytelen e-mail cím.';
    } elseif ($password !== $password2) {
        $errors[] = 'A jelszavak nem egyeznek.';
    } else {
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ? OR username = ?');
        $stmt->execute([$email, $username]);
        if ($stmt->fetch()) {
            $errors[] = 'Ez a felhasználónév vagy e-mail már foglalt.';
        }
    }

    if (empty($errors)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare('
            INSERT INTO users (username, email, password, role, created_at)
            VALUES (?, ?, ?, ?, NOW())
        ');
        $stmt->execute([$username, $email, $hash, 'user']);
        $_SESSION['user_id'] = $pdo->lastInsertId();
        header('Location: /login');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Regisztráció – VaszilijEdc</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#d9edfa] min-h-screen flex items-center justify-center">
  <div class="absolute top-10 w-full flex justify-center">
    <h1 id="reg-title" class="text-4xl font-extrabold text-black opacity-0 -translate-y-8 transform transition-all duration-700">VaszilijEdc
    </h1>
  </div>
  <div id="reg-card" class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md transform opacity-0 -translate-y-10 transition-all duration-700">
    <h2 class="text-2xl font-bold text-center mb-6">Regisztráció</h2>
    <?php if (!empty($errors)): ?>
      <div class="bg-red-100 border border-red-300 text-red-800 rounded p-4 mb-4 animate-pulse">
        <ul class="list-disc pl-5">
          <?php foreach ($errors as $e): ?>
            <li><?php echo htmlspecialchars($e); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
    <form method="post" novalidate class="space-y-5">
      <div>
        <label for="username" class="block text-sm font-medium text-gray-700">Felhasználónév</label>
        <input type="text" name="username" id="username" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition"/>
      </div>
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">E-mail cím</label>
        <input type="email" name="email" id="email" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition"/>
      </div>
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Jelszó</label>
        <input type="password" name="password" id="password" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition"/>
      </div>
      <div>
        <label for="password2" class="block text-sm font-medium text-gray-700">Jelszó újra</label>
        <input type="password" name="password2" id="password2" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition"/>
      </div>
      <div class="flex items-center justify-between">
        <a href="/login" class="text-sm text-indigo-600 hover:underline transition">Van már fiókod?</a>
        <button type="submit"class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transform hover:scale-105 transition">Regisztráció
        </button>
      </div>
    </form>
  </div>

  <script>
    window.addEventListener('DOMContentLoaded', () => {
      const title = document.getElementById('reg-title');
      const card  = document.getElementById('reg-card');

      setTimeout(() => {
        title.classList.remove('opacity-0', '-translate-y-8');
        title.classList.add('opacity-100', 'translate-y-0');
      }, 100);

      setTimeout(() => {
        card.classList.remove('opacity-0', '-translate-y-10');
        card.classList.add('opacity-100', 'translate-y-0');
      }, 300);
    });
  </script>
</body>
</html>
