<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require 'config.php';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $errors[] = 'Mindkét mező kitöltése kötelező.';
    } else {
        $stmt = $pdo->prepare('SELECT id, username, password, role FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
          $_SESSION['felhasznalo'] = [
              'id'     => $user['id'],
              'nev'    => $user['username'],
              'szerep' => $user['role']
          ];
          echo '<!DOCTYPE html>
          <html><head><meta charset="utf-8"></head><body>
            <script>
              localStorage.setItem("vaszilij_username", ' . json_encode($user['username']) . ');
              localStorage.setItem("vaszilij_userdata", ' . json_encode($user['role']) . ');
              window.location.href = "/";
            </script>
          </body></html>';
          exit;
        } else {
            $errors[] = 'Hibás e-mail vagy jelszó.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> VaszilijEdc - Bejelentkezés</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class=" bg-[#d9edfa] min-h-screen flex items-center justify-center">
  <div class="absolute top-10 w-full flex justify-center">
    <h1 id="login-title" class="text-4xl font-extrabold text-black opacity-0 -translate-y-8 transform transition-all duration-700">VaszilijEdc
    </h1>
  </div>
  <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md transform opacity-0 -translate-y-10 transition-all duration-700" id="login-card">
    <h1 class="text-3xl font-bold text-center mb-6">Bejelentkezés</h1>
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
        <label for="email" class="block text-sm font-medium text-gray-700">E-mail cím</label>
        <input type="email" name="email" id="email" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition" />
      </div>
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Jelszó</label>
        <input type="password" name="password" id="password" required  class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition" />
      </div>
      <div class="flex items-center justify-between">
        <a href="/register" class="text-sm text-indigo-600 hover:underline transition">Még nem regisztráltál?</a>
        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transform hover:scale-105 transition">Bejelentkezés</button>
      </div>
    </form>
  </div>

  <script>
    window.addEventListener('DOMContentLoaded', () => {
      const title = document.getElementById('login-title');
      const card  = document.getElementById('login-card');
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
