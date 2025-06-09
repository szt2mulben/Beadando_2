<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="hu">
<head><meta charset="UTF-8"><title>Kijelentkezés…</title></head>
<body>
  <script>
    localStorage.removeItem('vaszilij_username');
    localStorage.removeItem('vaszilij_userdata');
    window.location.href = '/login';
  </script>
</body>
</html>
