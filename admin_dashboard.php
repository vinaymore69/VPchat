<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#212121] text-white h-screen flex flex-col items-center justify-center">
    <div class="w-full max-w-lg bg-[#303030] rounded-lg shadow-lg p-8 text-center">
        <h2 class="text-2xl font-semibold mb-4">Admin Dashboard</h2>
        <div class="space-y-4">
            <a href="admin_view_logins.php" class="block w-full py-3 bg-[#374151] hover:bg-[#374178] rounded font-semibold text-white text-center">View Login History</a>
            <a href="logout.php" class="block w-full py-3 bg-red-600 hover:bg-red-700 rounded font-semibold text-white text-center">Logout</a>
        </div>
    </div>
</body>
</html>

