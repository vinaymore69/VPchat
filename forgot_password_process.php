<?php
require 'vendor/autoload.php';
use Vinay\Vpchat\Example;

$example = new Example();
echo $example->sayHello();
// forgot_password_process.php
session_start();
include('config.php');


// Make sure PHPMailer is installed via Composer or manually included
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// If using Composer's autoloader:
require 'vendor/autoload.php';

// Or, if you downloaded PHPMailer manually, include the following files:
// require 'path/to/PHPMailer/src/Exception.php';
// require 'path/to/PHPMailer/src/PHPMailer.php';
// require 'path/to/PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: forgot_password.php");
    exit;
}

$email = trim($_POST['email']);
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "Please enter a valid email address.";
    header("Location: forgot_password.php");
    exit;
}

// Check if email exists in the database
$stmt = $mysqli->prepare("SELECT id FROM users WHERE email = ?");
if (!$stmt) {
    $_SESSION['error'] = "Database error. Please try again.";
    header("Location: forgot_password.php");
    exit;
}
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error'] = "No account found with that email.";
    header("Location: forgot_password.php");
    exit;
}

// Generate a reset token (in production, store this token in your database with an expiration time)
$token = bin2hex(random_bytes(16)); 

// Create a reset link (update with your actual domain/URL)
$resetLink = "http://localhost/your_project/reset_password.php?token=" . $token;

$subject = "Password Reset Instructions";
$body = "Hi,<br><br>Please click the following link to reset your password:<br>";
$body .= "<a href='$resetLink'>$resetLink</a><br><br>If you did not request a password reset, please ignore this email.";

// Create a new PHPMailer instance and configure SMTP
$mail = new PHPMailer(true);
try {
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 3; // Enable SMTP debug output (set to 3 for more verbosity)
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'harrygoesthat@gmail.com';
    $mail->Password   = '345#1#30K';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;                 // TCP port to connect to

    // Recipients
    $mail->setFrom('no-reply@yourdomain.com', 'ChatGPT');
    $mail->addAddress($email);                  // Add a recipient

    // Content
    $mail->isHTML(true);                        // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $body;

    $mail->send();
    $_SESSION['message'] = "Password reset instructions have been sent to your email.";
} catch (Exception $e) {
    $_SESSION['error'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

header("Location: login.php");
exit;
?>
