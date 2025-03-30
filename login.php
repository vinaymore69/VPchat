<?php
// login.php
include('config.php');

session_start();
if (isset($_SESSION['error'])) {
    echo '<div class="bg-red-500 text-white p-3 mb-4">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}
if (isset($_SESSION['message'])) {
    echo '<div class="bg-green-500 text-white p-3 mb-4">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Login - ChatGPT Interface</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-[#212121] text-white h-screen flex flex-col items-center justify-center">
  <!-- Login Card -->
  <div class="w-full max-w-md bg-[#303030] rounded-lg shadow-lg p-8">
    <div class="mb-6 text-center">
      <i class="fas fa-robot text-xl"></i>
      <h2 class="mt-4 text-2xl font-semibold">Login</h2>
    </div>
    <form action="login_process.php" method="POST" class="space-y-6">
      <div>
        <label for="username" class="block mb-2">Username</label>
        <input type="text" id="username" name="username" class="w-full p-3 bg-[#303030] rounded border border-gray-600 focus:outline-none focus:border-blue-500" placeholder="Enter your username" required>
      </div>
      <div>
        <label for="password" class="block mb-2">Password</label>
        <input type="password" id="password" name="password" class="w-full p-3 bg-[#303030] rounded border border-gray-600 focus:outline-none focus:border-blue-500" placeholder="Enter your password" required>
      </div>
      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <input type="checkbox" id="remember" name="remember" class="mr-2">
          <label for="remember">Remember Me</label>
        </div>
        <a href="forgot_password.php" class="text-blue-400 hover:underline">Forgot Password?</a>
      </div>
      <button type="submit" class="w-full py-3 bg-[#374151] hover:bg-[#374178] rounded font-semibold">Login</button>
    </form>
    <div class="mt-6 text-center">
      <p>Don't have an account? <a href="register.php" class="text-blue-400 hover:underline">Register</a></p>
    </div>
  </div>
</body>
</html>
