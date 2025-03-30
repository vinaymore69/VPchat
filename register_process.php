<?php
// register_process.php
include('config.php');

// Only process POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}

// Retrieve and trim input values
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$terms = isset($_POST['terms']) ? $_POST['terms'] : '';

if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
    echo "All fields are required.";
    exit;
}

if ($password !== $confirm_password) {
    echo "Passwords do not match.";
    exit;
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email address.";
    exit;
}

// Check if the user already exists
$stmt = $mysqli->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
if (!$stmt) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    exit;
}
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "Username or Email already exists.";
    exit;
}
$stmt->close();

// Hash the password securely
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert new user into the database
$stmt = $mysqli->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
if (!$stmt) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    exit;
}
$stmt->bind_param("sss", $username, $email, $hashed_password);

if ($stmt->execute()) {
    // Registration successful, redirect or show a success message
    echo "Registration successful. <a href='login.php'>Click here to login</a>";
} else {
    echo "Registration failed. Please try again.";
}

$stmt->close();
$mysqli->close();
?>
