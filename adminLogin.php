<?php
include('config.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Admin Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#212121] text-white h-screen flex items-center justify-center">
  <div class="w-full max-w-md bg-[#303030] rounded-lg shadow-lg p-8">
    <h2 class="text-2xl font-semibold text-center mb-6">Admin Login</h2>
    <?php if (isset($_SESSION['error'])): ?>
      <div class="bg-red-500 text-white p-3 mb-4 rounded"> <?= $_SESSION['error']; unset($_SESSION['error']); ?> </div>
    <?php endif; ?>
    <form action="adminLogin_process.php" method="POST">
      <input type="text" name="username" placeholder="Username" required class="w-full p-3 mb-3 bg-[#424242] rounded border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
      <input type="password" name="password" placeholder="Password" required class="w-full p-3 mb-3 bg-[#424242] rounded border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
      <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 p-3 rounded font-semibold">Login</button>
    </form>
  </div>
</body>
</html>