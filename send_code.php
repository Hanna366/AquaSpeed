<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_SESSION['email'];
    $entered_code = $_POST['reset_code'];

    $stmt = $conn->prepare("SELECT token, expires_at FROM password_resets WHERE email = ? ORDER BY id DESC LIMIT 1");
    if (!$stmt) die("Prepare failed (select code): " . $conn->error);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($token, $expires);
    $stmt->fetch();
    $stmt->close();

    if ($token === $entered_code && strtotime($expires) > time()) {
        $_SESSION['code_verified'] = true;
        header("Location: new_password.php");
        exit();
    } else {
        $_SESSION['error'] = "Invalid or expired code.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Verify Code</title>
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
  <h2>Enter Verification Code</h2>
  <p>Check your email for the reset code.</p>
  <form method="POST">
    <input type="text" name="reset_code" placeholder="Reset Code" required>
    <button type="submit">Verify Code</button>
  </form>
  <?php if (isset($_SESSION['error'])) { echo "<p class='error'>" . $_SESSION['error'] . "</p>"; unset($_SESSION['error']); } ?>
</div>
</body>
</html>
