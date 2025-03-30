<?php
// forgot_password.php
include('config.php');
session_start();
if (isset($_SESSION['error'])) {
    echo '<div class="bg-red-500 text-white p-3 mb-4 text-center">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}
if (isset($_SESSION['message'])) {
    echo '<div class="bg-green-500 text-white p-3 mb-4 text-center">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Forgot Password - ChatGPT Interface</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-[#212121] text-white h-screen flex flex-col items-center justify-center">
  <!-- Forgot Password Card -->
  <div class="w-full max-w-md bg-[#303030] rounded-lg shadow-lg p-8">
    <div class="mb-6 text-center">
      <i class="fas fa-unlock-alt text-2xl"></i>
      <h2 class="mt-4 text-2xl font-semibold">Forgot Password</h2>
    </div>
    <form action="forgot_password_process.php" method="POST" class="space-y-6">
      <div>
        <label for="email" class="block mb-2">Enter your Email</label>
        <input type="email" id="email" name="email" class="w-full p-3 bg-[#303030] rounded border border-gray-600 focus:outline-none focus:border-blue-500" placeholder="your-email@example.com" required>
      </div>
      <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-500 rounded font-semibold">Reset Password</button>
    </form>
    <div class="mt-6 text-center">
      <p>Remembered your password? <a href="login.php" class="text-blue-400 hover:underline">Login</a></p>
    </div>
  </div>
</body>
</html>
