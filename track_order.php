<?php
include 'db.php';
$order_id = $_GET['order_id'] ?? null;
$status = 0;

if ($order_id) {
    $stmt = $conn->prepare("SELECT order_status FROM orders WHERE id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $order = $result->fetch_assoc();
    $status = intval($order['order_status'] ?? 3);
    $stmt->close();
}

$steps = [
    ['icon' => 'bag.png', 'title' => 'Order Made', 'desc' => 'Your order has been confirmed'],
    ['icon' => 'sw.png', 'title' => 'Gallon Collected', 'desc' => 'Empty gallon has been picked up'],
    ['icon' => 'sta.jpeg', 'title' => 'Refilled Gallon', 'desc' => 'Your gallon has just been freshly refilled'],
    ['icon' => 'pal.jpeg', 'title' => 'Bugwak Refilling Station', 'desc' => 'Preparing to deliver your order'],
    ['icon' => 'loc.png', 'title' => 'My Location', 'desc' => 'Destination'],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Track Order</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 20px;
      background: #fff;
    }
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .header h2 {
      font-size: 18px;
      color: #00bfff;
    }
    .route-box {
      background: #f9f9f9;
      padding: 15px;
      border-radius: 12px;
      margin: 20px 0;
      font-size: 16px;
    }
    .route-box strong {
      font-weight: 600;
      color: #111;
    }
    .estimation {
      background: #333;
      color: white;
      padding: 10px 15px;
      border-radius: 8px;
      font-size: 13px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-weight: 500;
    }
    .timeline {
      display: flex;
      margin-top: 20px;
      align-items: stretch;
      height: 360px;
    }
    .steps-column,
    .line-column,
    .icons-column {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: 360px;
    }
    .icons-column {
      align-items: center;
      margin-right: 10px;
    }
    .icons-column img {
      width: 22px;
    }
    .line-column {
      align-items: center;
      margin-right: 15px;
    }
    .line {
      width: 4px;
      height: 28px;
      background: #ccc;
    }
    .line.done {
      background: #00bfff;
    }
    .line.dotted {
      background: repeating-linear-gradient(
        to bottom,
        #ccc,
        #ccc 2px,
        transparent 2px,
        transparent 5px
      );
    }
    .circle {
      width: 18px;
      height: 18px;
      border-radius: 50%;
      background-color: #ccc;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 12px;
      color: white;
      z-index: 1;
    }
    .circle.done {
      background-color: #00bfff;
    }
    .step-title {
      font-size: 13px;
      font-weight: 600;
      color: #333;
    }
    .step-desc {
      font-size: 11px;
      color: #999;
    }
    .step.inactive .step-title,
    .step.inactive .step-desc {
      color: #ccc;
    }
    .review-link {
      margin-top: 30px;
      text-align: center;
      font-size: 13px;
      color: #333;
      font-weight: 600;
    }
    .review-link a {
      color: #333;
      text-decoration: none;
    }
    .review-link a:hover {
      color: #00bfff;
    }

  </style>
</head>
<body>

<div class="header">
  <h2>Track Order</h2>
  <a href="home.php" style="font-size: 30px; text-decoration: none; color: black;">&times;</a>
</div>

<div class="route-box">
  <p>From<br><strong>Bugwak Refilling Station</strong></p>
  <p>To<br><strong>P-6, Laligan</strong></p>
</div>

<div class="estimation">
  <span>Estimated Time of Delivery</span>
  <span>20mins</span>
</div>

<div class="timeline">
  <!-- Left: icons with conditional check overlay -->
  <div class="icons-column">
    <?php foreach ($steps as $index => $step): ?>
      <?php if ($step['icon'] === 'pal.jpeg' && $status >= $index): ?>
        <div style="position: relative; width: 28px; height: 28px;">
          <img src="img/<?= $step['icon'] ?>" alt="<?= $step['title'] ?>" style="width: 30px;">
          <img src="img/check.png" alt="Check" style="position: absolute; width: 10px; top: 5px; right: 2px;">
        </div>
      <?php else: ?>
        <img src="img/<?= $step['icon'] ?>" alt="<?= $step['title'] ?>">
      <?php endif; ?>
    <?php endforeach; ?>
  </div>

  <!-- Middle: circles and progress line -->
  <div class="line-column">
    <?php foreach ($steps as $index => $step): ?>
      <div class="circle <?= ($status >= $index ? 'done' : '') ?>">
        <?= ($status >= $index ? '✔' : '') ?>
      </div>
      <?php if ($index < count($steps) - 1): ?>
        <div class="line <?= ($status > $index ? 'done' : ($status == $index ? '' : 'dotted')) ?>"></div>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>

  <!-- Right: text steps -->
  <div class="steps-column">
    <?php foreach ($steps as $index => $step): ?>
      <div class="step <?= ($status < $index ? 'inactive' : '') ?>">
        <div class="step-title"><?= $step['title'] ?></div>
        <div class="step-desc"><?= $step['desc'] ?></div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<div class="review-link">
<a href="rate_and_reviews.php?order_id=<?= $order_id ?>">Rate and Review</a>


</div>


</body>
</html>
