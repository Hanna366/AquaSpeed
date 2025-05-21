<?php
require 'db.php';
session_start();

// Fetch most ordered products
$sql = "
    SELECT 
        p.id, p.name, p.image, p.price, SUM(oi.quantity) AS total_ordered
    FROM 
        order_items oi
    JOIN 
        products p ON oi.product_id = p.id
    GROUP BY 
        oi.product_id
    ORDER BY 
        total_ordered DESC
    LIMIT 10
";

$result = $conn->query($sql);
$favorites = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $favorites[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Favorite Products</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #3FBDF1;
            color: white;
            padding: 20px;
            font-size: 20px;
        }
        .back-btn {
            float: right;
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 40px;
            margin-right: 10px;
        }
        .container {
            padding: 20px;
        }
        .card {
            background: white;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .card img {
            width: 100%;
            max-height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }
        .card h4 {
            margin: 10px 0 5px;
            font-size: 16px;
        }
        .card p {
            margin: 0;
            font-size: 14px;
            color: #333;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 20px;
        }
    </style>
</head>
<body>

<div class="header">
    Your Favorite Products!
    <a href="profile.php" class="back-btn">&#8592;</a>
</div>

<div class="container">
    <div class="grid">
        <?php if (!empty($favorites)): ?>
            <?php foreach ($favorites as $product): ?>
                <div class="card">
                    <img src="img/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                    <h4><?= htmlspecialchars($product['name']) ?></h4>
                    <p>₱<?= number_format($product['price'], 2) ?></p>
                    <small>Ordered <?= $product['total_ordered'] ?>x</small>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No products have been ordered yet.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
