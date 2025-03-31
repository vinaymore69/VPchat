<?php
include('config.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $mysqli->prepare("SELECT id, password FROM admin_users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_id'] = $row['id'] ?? null; // Ensure id exists before using it
            
            if ($_SESSION['admin_id'] !== null) {
                header("Location: admin_dashboard.php");
                exit();
            } else {
                $_SESSION['error'] = "Error: User ID not found!";
            }
        } else {
            $_SESSION['error'] = "Invalid password!";
        }
    } else {
        $_SESSION['error'] = "User not found!";
    }
    header("Location: adminLogin.php");
    exit();
}
?>
