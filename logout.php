<?php
session_start();
include('config.php');

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Get the most recent login that has not been logged out
    $stmt = $mysqli->prepare("SELECT id, login_time FROM user_logins WHERE user_id = ? AND logout_time IS NULL ORDER BY id DESC LIMIT 1");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $login_id = $row['id'];
        $login_time = strtotime($row['login_time']); // Convert to timestamp

        $logout_time = date('Y-m-d H:i:s'); // Corrected logout time
        $session_duration = time() - $login_time; // Duration in seconds

        // Log timestamps for debugging
        error_log("User ID: $user_id");
        error_log("Login Time: " . $row['login_time']);
        error_log("Logout Time: " . $logout_time);
        error_log("Session Duration: " . $session_duration);

        // Update logout time and duration
        $stmt = $mysqli->prepare("UPDATE user_logins SET logout_time = ?, session_duration = ? WHERE id = ?");
        $stmt->bind_param("sii", $logout_time, $session_duration, $login_id);
        $stmt->execute();
    }
}

// Destroy session
session_destroy();
header("Location: login.php");
exit;
?>
