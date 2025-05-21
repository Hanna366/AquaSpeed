<?php
session_start();
require 'db.php';
require_once __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$feedback = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $code = rand(100000, 999999);
    $expires = date('Y-m-d H:i:s', strtotime('+30 minutes'));

    $stmt = $conn->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)");
    if (!$stmt) die("Prepare failed (insert reset): " . $conn->error);
    $stmt->bind_param("sss", $email, $code, $expires);
    $stmt->execute();

    $_SESSION['email'] = $email;

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = $_ENV['SMTP_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['EMAIL_USERNAME'];
        $mail->Password = $_ENV['EMAIL_PASSWORD'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $_ENV['SMTP_PORT'];

        $mail->setFrom($_ENV['EMAIL_FROM'], 'AquaSpeed Support');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Your AquaSpeed Reset Code';
        $mail->Body = "Your reset code is <strong>$code</strong>. It expires in 30 minutes.";

        $mail->send();
        $_SESSION['success'] = "Reset code sent.";
        header("Location: send_code.php");
        exit();
    } catch (Exception $e) {
        $feedback = "Error sending email: {$mail->ErrorInfo}";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password</title>
  <style>
    body { font-family: 'Segoe UI', sans-serif; background: #f5f7fa; display: flex; justify-content: center; align-items: center; height: 100vh; }
    .box { background: #fff; padding: 30px; border-radius: 8px; text-align: center; width: 300px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); }
    h2 { color: #007bff; }
    input, button { width: 100%; padding: 10px; margin: 10px 0; border-radius: 5px; border: 1px solid #ccc; }
    button { background-color: #007bff; color: #fff; font-weight: bold; border: none; }
    .error { color: red; }
  </style>
</head>
<body>
<div class="box">
  <h2>Forgot Password</h2>
  <p>Enter your email to receive a reset code.</p>
  <form method="POST">
    <input type="email" name="email" placeholder="Your e-mail address" required>
    <button type="submit">Reset my Password</button>
  </form>
  <?php if (!empty($feedback)) echo "<p class='error'>$feedback</p>"; ?>
</div>
</body>
</html>
