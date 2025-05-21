<?php
include 'db.php';
session_start();

$order_id = $_GET['order_id'] ?? null;
$error_message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $rating = intval($_POST['rating']);
    $comment = $_POST['comment'];
    $order_id = $_POST['order_id'];

    $stmt = $conn->prepare("INSERT INTO reviews (name, rating, comment, order_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sisi", $name, $rating, $comment, $order_id);
    if (!$stmt->execute()) {
        echo "<p style='color:red;'>Failed to insert review: " . $stmt->error . "</p>";
    }
}

// Fetch reviews
$reviews = [];
$result = $conn->query("SELECT * FROM reviews WHERE order_id = $order_id ORDER BY created_at DESC");
while ($row = $result->fetch_assoc()) {
    $reviews[] = $row;
}

// Get average rating and total reviews
$avg_result = $conn->query("SELECT ROUND(AVG(rating),1) as avg_rating, COUNT(*) as total FROM reviews WHERE order_id = $order_id");
$avg_data = $avg_result->fetch_assoc();
$average = $avg_data['avg_rating'] ?? 0;
$total = $avg_data['total'] ?? 0;

// Breakdown
$ratings_count = array_fill(1, 5, 0);
$breakdown = $conn->query("SELECT rating, COUNT(*) as count FROM reviews WHERE order_id = $order_id GROUP BY rating");
while ($row = $breakdown->fetch_assoc()) {
    $ratings_count[$row['rating']] = $row['count'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reviews</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #fff;
            margin: 0;
            padding: 20px;
        }
        .header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .header h2 {
            font-size: 18px;
            margin-left: 10px;
        }
        .summary-box {
            background: #f6f6f6;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 25px;
        }
        .avg-rating {
            font-size: 36px;
            font-weight: bold;
            float: right;
        }
        .stars {
            color: #ffc107;
            font-size: 14px;
        }
        .bars {
            margin-top: 10px;
        }
        .bar {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }
        .bar span {
            width: 15px;
            display: inline-block;
        }

       .bar-container {
            flex: 1;
            background: #e0e0e0;
            border-radius: 4px;
            overflow: hidden; /* ✅ FIX: clip the inside bar cleanly */
        }

        .bar-line {
            height: 6px;
            background: #3FBDF1;
            margin: 0;
            border-radius: 0; /* ✅ optional: avoids visual bumping at edge */
        }

        .review {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
            align-items: flex-start;
        }
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        .review-content {
            flex: 1;
        }
        .review-name {
            font-weight: bold;
            font-size: 14px;
        }
        .review-time {
            font-size: 12px;
            color: #999;
        }
        .review-comment {
            font-size: 13px;
            margin-top: 4px;
        }
        .stars.small {
            font-size: 12px;
        }
        .write-review-btn {
            display: block;
            background: transparent;
            color: black;
            text-align: center;
            padding: 14px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 8px;
            margin-top: 30px;
        }
        form.review-form {
            margin-top: 20px;
        }
        form.review-form input, form.review-form select, form.review-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-family: 'Poppins';
        }
        form.review-form button {
            background: #3FBDF1;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 6px;
            font-weight: bold;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<?php if ($error_message): ?>
    <div class="error"><?= $error_message ?></div>
<?php endif; ?>

<div class="header">
    <a href="track_order.php?order_id=<?= $order_id ?>" style="text-decoration: none; font-weight: bold; font-size: 40px; color:#3FBDF1;">←</a>
    <h2>AquaSpeed</h2>
</div>

<div class="summary-box">
    <div class="avg-rating"><?= $average ?></div>
    <div class="stars"><?= str_repeat("★", round($average)) ?><?= str_repeat("☆", 5 - round($average)) ?></div>
    <small><?= $total ?> Reviews</small>

    <div class="bars">
        <?php for ($i = 5; $i >= 1; $i--): ?>
            <div class="bar">
                <span><?= $i ?></span>
                <div class="bar-container">
                    <div class="bar-line" style="width: <?= $total ? ($ratings_count[$i] / $total * 100) : 0 ?>%;"></div>
                </div>
            </div>
        <?php endfor; ?>
    </div>
</div>

<?php foreach ($reviews as $r): ?>
    <div class="review">
        <img src="img/ol.png" class="avatar" alt="avatar">
        <div class="review-content">
            <div class="review-name"><?= htmlspecialchars($r['name']) ?></div>
            <div class="stars small"><?= str_repeat("★", $r['rating']) ?><?= str_repeat("☆", 5 - $r['rating']) ?> <span class="review-time">• <?= date("g:i a", strtotime($r['created_at'])) ?></span></div>
            <div class="review-comment"><?= htmlspecialchars($r['comment']) ?></div>
        </div>
    </div>
<?php endforeach; ?>

<a class="write-review-btn" href="#write-form">Write Review</a>

<form id="write-form" method="POST" class="review-form">
    <input type="hidden" name="order_id" value="<?= $order_id ?>">
    <input type="text" name="name" placeholder="Your name" required>
    <select name="rating" required>
        <option value="">Select Rating</option>
        <option value="5">★★★★★ - Excellent</option>
        <option value="4">★★★★☆ - Good</option>
        <option value="3">★★★☆☆ - Average</option>
        <option value="2">★★☆☆☆ - Poor</option>
        <option value="1">★☆☆☆☆ - Bad</option>
    </select>
    <textarea name="comment" rows="3" placeholder="Write your review here..." required></textarea>
    <button type="submit" style=" box-shadow: 0 4px 0 #039be5; height: 60px">Submit Review</button>
</form>

</body>
</html>
