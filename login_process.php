<?php
session_start();
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Username and Password are required.";
        header("Location: login.php");
        exit;
    }

    // Validate user credentials
    $stmt = $mysqli->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['message'] = "Login successful!";

            // Insert login time
            $user_id = $user['id'];
            $stmt = $mysqli->prepare("INSERT INTO user_logins (user_id) VALUES (?)");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();

            header("Location: index.php");
            exit;
        } else {
            $_SESSION['error'] = "Invalid username or password.";
        }
    } else {
        $_SESSION['error'] = "Invalid username or password.";
    }

    header("Location: login.php");
    exit;
}
?>
