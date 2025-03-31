<?php
include('config.php');

$hashed_password = password_hash("admin123", PASSWORD_DEFAULT);
$sql = "INSERT INTO admin_users (username, password) VALUES ('admin', ?)";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $hashed_password);

if ($stmt->execute()) {
    echo "✅ Admin user created successfully.";
} else {
    echo "❌ Error: " . $mysqli->error;
}
?>
