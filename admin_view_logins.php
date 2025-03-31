<?php
session_start();
include('config.php');

// Check if admin is logged in (add proper authentication logic)
if (!isset($_SESSION['admin_id'])) {
    header("Location: adminLogin.php");
    exit;
}

$result = $mysqli->query("SELECT u.username, l.login_time, l.logout_time, l.session_duration 
                          FROM user_logins l
                          JOIN users u ON l.user_id = u.id
                          ORDER BY l.login_time DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - User Logins</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#212121] text-white p-8">
    <div class="max-w-4xl mx-auto bg-[#303030] rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-semibold mb-4 text-center">User Login History</h2>
        <table class="w-full border border-gray-600">
            <thead>
                <tr class="bg-[#374151]">
                    <th class="border border-gray-600 p-2">Username</th>
                    <th class="border border-gray-600 p-2">Login Time</th>
                    <th class="border border-gray-600 p-2">Logout Time</th>
                    <th class="border border-gray-600 p-2">Session Duration (mins)</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr class="bg-[#424242] hover:bg-[#525252]">
                    <td class="border border-gray-600 p-2"><?php echo htmlspecialchars($row['username']); ?></td>
                    <td class="border border-gray-600 p-2"><?php echo $row['login_time']; ?></td>
                    <td class="border border-gray-600 p-2"><?php echo $row['logout_time'] ?? 'Still Logged In'; ?></td>
                    <td class="border border-gray-600 p-2">
                        <?php echo ($row['session_duration']) ? round($row['session_duration'] / 60, 2) : '-'; ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
