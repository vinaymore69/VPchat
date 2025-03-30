<?php
// register.php
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
  <title>Register - ChatGPT Interface</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-[#212121] text-white h-screen flex flex-col items-center justify-center">
  <!-- Registration Card -->
  <div class="w-full max-w-md bg-[#303030] rounded-lg shadow-lg p-8">
    <div class="mb-6 text-center">
      <i class="fas fa-user-plus text-2xl"></i>
      <h2 class="mt-4 text-2xl font-semibold">Register</h2>
    </div>
    <form action="register_process.php" method="POST" class="space-y-6">
      <!-- Group: Username and Email -->
      <div class="flex space-x-4">
        <div class="w-1/2">
          <label for="username" class="block mb-2">Username</label>
          <input type="text" id="username" name="username" class="w-full p-3 bg-[#303030] rounded border border-gray-600 focus:outline-none focus:border-blue-500" placeholder="Username" required>
        </div>
        <div class="w-1/2">
          <label for="email" class="block mb-2">Email</label>
          <input type="email" id="email" name="email" class="w-full p-3 bg-[#303030] rounded border border-gray-600 focus:outline-none focus:border-blue-500" placeholder="Email" required>
        </div>
      </div>
      <!-- Group: Password and Confirm Password -->
      <div class="flex space-x-4">
        <div class="w-1/2">
          <label for="password" class="block mb-2">Password</label>
          <input type="password" id="password" name="password" class="w-full p-3 bg-[#303030] rounded border border-gray-600 focus:outline-none focus:border-blue-500" placeholder="Password" required>
        </div>
        <div class="w-1/2">
          <label for="confirm_password" class="block mb-2">Confirm Password</label>
          <input type="password" id="confirm_password" name="confirm_password" class="w-full p-3 bg-[#303030] rounded border border-gray-600 focus:outline-none focus:border-blue-500" placeholder="Confirm Password" required>
        </div>
      </div>
      <!-- Terms -->
      <div class="flex items-center">
        <input type="checkbox" id="terms" name="terms" class="mr-2" required>
        <label for="terms">I agree to the <a href="#" class="text-blue-400 hover:underline">Terms & Conditions</a></label>
      </div>
      <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-500 rounded font-semibold">Register</button>
    </form>
    <div class="mt-6 text-center">
      <p>Already have an account? <a href="login.php" class="text-blue-400 hover:underline">Login</a></p>
    </div>
  </div>
</body>
</html>
