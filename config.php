<?php
// config.php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', ''); // Update if needed
define('DB_NAME', 'chatbot_db');

date_default_timezone_set('Asia/Kolkata'); // Change to your timezone
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>

