<?php
session_start();
require 'db.php';

// Fetch all orders (latest 20)
$sql = "SELECT id, address, total, order_status, order_time FROM orders ORDER BY order_time DESC LIMIT 20";
$result = $conn->query($sql);

$orders = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Order Notifications</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f4f4;
            padding: 30px;
            margin: 0;
            position: relative;
        }
        h2 {
            text-align: center;
            color: #3FBDF1;
        }
        .notif-box {
            max-width: 700px;
            margin: 0 auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ddd;
        }
        .order {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }
        .order:last-child {
            border-bottom: none;
        }
        .order strong {
            font-size: 16px;
            display: block;
        }
        .order small {
            color: #777;
        }
        .close-btn {
            position: absolute;
            top: 20px;
            right: 30px;
            font-size: 24px;
            font-weight: bold;
            color: #3FBDF1;
            text-decoration: none;
        }
        .close-btn:hover {
            color: #007bbd;
        }
    </style>
</head>
<body>
    <a href="profile.php" class="close-btn" title="Back to Dashboard">&times;</a>

    <h2>Recent Orders</h2>
    <div class="notif-box">
        <?php if (!empty($orders)): ?>
            <?php foreach ($orders as $order): ?>
                <div class="order">
                    <strong>Order #<?= htmlspecialchars($order['id']) ?> - <?= htmlspecialchars($order['order_status']) ?></strong>
                    <div><small>Address: <?= htmlspecialchars($order['address']) ?></small></div>
                    <div>Total: ₱<?= number_format($order['total'], 2) ?></div>
                    <div><small><?= date("F j, Y - g:i A", strtotime($order['order_time'])) ?></small></div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No orders found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
