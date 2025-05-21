<?php
session_start();
require 'db.php';

if (!isset($_SESSION['email']) || !isset($_SESSION['code_verified'])) {
    header('Location: forgot_password.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPass = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if ($newPass === $confirm) {
        $hashed = password_hash($newPass, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        if (!$stmt) die("Prepare failed (update password): " . $conn->error);
        $stmt->bind_param("ss", $hashed, $_SESSION['email']);
        $stmt->execute();

        $stmt = $conn->prepare("DELETE FROM password_resets WHERE email = ?");
        $stmt->bind_param("s", $_SESSION['email']);
        $stmt->execute();

        session_unset();
        $_SESSION['success'] = "Password updated successfully!";
        header('Location: login.php');
        exit();
    } else {
        $_SESSION['error'] = "Passwords do not match.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Reset Password</title>
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
  <h2>Reset Your Password</h2>
  <form method="POST">
    <input type="password" name="password" placeholder="New Password" required>
    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
    <button type="submit">Reset Password</button>
  </form>
  <?php if (isset($_SESSION['error'])) { echo "<p class='error'>" . $_SESSION['error'] . "</p>"; unset($_SESSION['error']); } ?>
</div>
</body>
</html>
