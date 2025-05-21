<?php
include 'db.php';
$order_id = $_GET['order_id'] ?? null;
$order = null;

if ($order_id) {
    $stmt = $conn->prepare("SELECT id, delivery_option, schedule_date, schedule_time, total, order_time FROM orders WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $order = $result->fetch_assoc();
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Success</title>
  <style>
    body {
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      text-align: center;
      background: #fff;
      padding: 40px 20px;
      margin: 0;
    }

    /* Order ID */
    .order-id {
      font-size: 18px;
      font-family: 'Poppins', sans-serif;
      color: #333;
      margin-bottom: 20px;
    }

    /* Image container with overlay */
    .success-image-wrapper {
      position: relative;
      width: 170px;
      margin: 0 auto 30px;
    }

    .drop {
      width: 150%;
      display: block;
      margin-left: -35px;
    }

    .checkmark {
      position: absolute;
      width: 80px;
      top: 15px;
      left: 60%;
    }

    /* Texts */
    .success-title {
      font-size: 20px;
      font-weight: bold;
      color: #333;
      margin-bottom: 8px;
    }

    .subtitle {
      font-size: 14px;
      color: #888;
      margin-bottom: 80px;
    }

    /* Buttons */
    .btn {
      display: block;
      width: 90%;
      max-width: 300px;
      margin: 10px auto;
      padding: 14px;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      font-weight: bold;
    }
    .btn-primary {
      background-color: #00bfff;
      color: white;
      border: none;
      box-shadow: 0 4px 0 #039be5; /* Blue base shadow */
    }

    .btn-secondary {
      background: transparent;
      border: none;
      color: #00bfff;
    }
    .btn-primary:hover {
      background-color: #009acd;
    }

    .btn-secondary:hover {
     color: #007aa3;
    }


  </style>
</head>
<body>

<?php if ($order): ?>
  <div class="order-id">
    Order Id: <?php echo str_pad($order['id'], 7, "0", STR_PAD_LEFT); ?>
  </div>

  <div class="success-image-wrapper">
    <img src="img/drop.jpeg" alt="Jug" class="drop">
    <img src="img/checks.png" alt="Checkmark" class="checkmark">
  </div>

  <div class="success-title">Order Successful</div>
  <div class="subtitle">Pickup scheduled, we’re on the way!</div>

  <button class="btn btn-primary" onclick="window.location.href='home.php'">Continue Ordering</button>
  <button class="btn btn-secondary" onclick="window.location.href='track_order.php?order_id= 14<?php echo $order['id']; ?>'">Track Order</button>

<?php else: ?>
  <p>Order not found.</p>
<?php endif; ?>

</body>
</html>
