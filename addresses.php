<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch addresses and order time from orders table
$stmt = $conn->prepare("SELECT address, order_time FROM orders WHERE user_id = ? ORDER BY order_time DESC");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$addresses = [];
while ($row = $result->fetch_assoc()) {
    $addresses[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Addresses</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f4f4f4;
      padding: 30px;
      margin: 0;
    }
    h2 {
      text-align: center;
      color: #3FBDF1;
      margin-top: 20px;
    }
    .address-box {
      max-width: 600px;
      margin: 50px auto;
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px #ddd;
      position: relative;
    }
    .item {
      padding: 15px 0;
      border-bottom: 1px solid #eee;
    }
    .item:last-child {
      border-bottom: none;
    }
    .date {
      font-size: 13px;
      color: #888;
      margin-top: 5px;
    }
    .close-btn {
      position: absolute;
      top: 15px;
      right: 15px;
      background: #3FBDF1;
      color: white;
      border: none;
      border-radius: 50%;
      width: 28px;
      height: 28px;
      font-size: 16px;
      line-height: 28px;
      text-align: center;
      cursor: pointer;
      text-decoration: none;
    }
    .close-btn:hover {
      background: #1ba5da;
    }
  </style>
</head>
<body>

<div class="address-box">
  <a href="profile.php" class="close-btn">×</a> <!-- change profile.php to your desired page -->
  <h2>My Delivery Addresses</h2>
  <?php if (!empty($addresses)): ?>
    <?php foreach ($addresses as $entry): ?>
      <div class="item">
        <?= nl2br(htmlspecialchars($entry['address'])) ?>
        <div class="date">Ordered on <?= date('F j, Y - g:i A', strtotime($entry['order_time'])) ?></div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p>No addresses found from past orders.</p>
  <?php endif; ?>
</div>

</body>
</html>
