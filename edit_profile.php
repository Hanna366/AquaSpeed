<?php
session_start();
require 'db.php';

$user_id = $_SESSION['user_id']; // Ensure this session variable is set

$stmt = $conn->prepare("SELECT name, address, contact, email FROM users WHERE id = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error); // This tells you the real reason
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Profile</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #fff;
      padding: 40px;
    }
    .container {
      max-width: 400px;
      margin: auto;
      text-align: center;
    }
    .avatar {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      background: #e0eaff;
      margin: 20px auto;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 36px;
      color: #007bff;
    }
    label {
      display: block;
      margin: 10px 0 5px;
      text-align: left;
    }
    input[type="text"], input[type="email"] {
      width: 100%;
      padding: 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
      margin-bottom: 15px;
    }
    button {
      padding: 10px 20px;
      background: #007bff;
      border: none;
      color: white;
      font-weight: bold;
      border-radius: 6px;
      cursor: pointer;
    }
  </style>
</head>
<body>
<div class="container">
  <h2>Edit Profile</h2>
  <div class="avatar">👤</div>

  <form method="POST" action="update_profile.php">
    <label for="name">Full Name</label>
    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>

    <label for="address">Address</label>
    <input type="text" name="address" value="<?= htmlspecialchars($user['address']) ?>" required>

    <label for="contact">Contact Number</label>
    <input type="text" name="contact" value="<?= htmlspecialchars($user['contact']) ?>" required>

    <label for="email">Email</label>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

    <button type="submit">Update</button>
  </form>
</div>
</body>
</html>
