\<?php
// emergency_product.php
session_start();
include 'db.php';

$id = 2; // hardcoded emergency product ID

$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if (!$product = $result->fetch_assoc()) {
    echo "Product not found.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($product['name']); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background-color: #fff;
        }

        .product-container {
            max-width: 480px;
            margin: 0 auto;
        }

        .product-image {
            position: relative;
        }

        .product-image img {
            width: 100%;
        }

        .icon-back {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 24px;
            color: white;
            font-weight: bold;
            text-decoration: none;
        }

        .icon-cart {
            position: absolute;
            top: 350px;
            right: 15px;
            background-color: #ffffff;
            border-radius: 12px;
            padding: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }
        .icon-cart img {
            width: 40px;
            height: 40px;
        }

        .product-details {
            padding: 20px;
        }

        .product-details h2 {
            font-size: 18px;
            font-weight: 600;
            margin: 0;
        }

        .price {
            font-size: 16px;
            font-weight: 600;
            margin-top: 6px;
        }

        .description {
            font-size: 12px;
            color: #555;
            margin-top: 6px;
        }

        .rating {
            margin-top: 12px;
            font-size: 13px;
            display: flex;
            align-items: center;
        }

        .rating .star {
            color: gold;
            margin-right: 5px;
        }

        .form-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .form-group label {
            font-weight: 600;
            font-size: 13px;
            margin-bottom: 6px;
            display: block;
        }

        .dropdown-wrapper {
            display: flex;
            border: 1px solid #3FBDF1;
            border-radius: 6px;
            overflow: hidden;
            width: 120px;
        }

        .dropdown-wrapper select {
            flex: 1;
            padding: 10px;
            border: none;
            font-size: 13px;
        }

        .dropdown-wrapper select:focus {
            outline: none;
        }

        .quantity-selector {
            display: flex;
            background-color: #f4f4f4;
            border-radius: 6px;
        }

        .quantity-selector button {
            width: 30px;
            height: 32px;
            border: none;
            font-size: 18px;
            background-color: #eee;
        }

        .quantity-selector input {
            width: 40px;
            text-align: center;
            font-size: 14px;
            border: none;
            background-color: transparent;
        }

        .add-to-cart {
            margin-top: 24px;
            width: 100%;
            background-color: #3FBDF1;
            color: white;
            font-weight: bold;
            font-size: 15px;
            padding: 14px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 4px 0 #039be5; /* Blue base shadow */
        }

        .add-to-cart:hover {
            background-color: #1ca9db;
        }
    </style>
</head>
<body>

<div class="product-container">
    <div class="product-image">
    <img src="img/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
        <a href="home.php" class="icon-back">←</a>
        <div class="icon-cart">
            <img src="img/cart.png" alt="Cart" width="24">
        </div>
    </div>

    <div class="product-details">
        <h2><?php echo htmlspecialchars($product['name']); ?></h2>
        <div class="price">₱<?php echo number_format($product['price'], 2); ?></div>
        <div class="description">Note: Delivery will charge 10 for every emergency gallon delivery.</div>
        <div class="rating">
            <span class="star">★</span> 4.5 <span style="color:#999;">(128 reviews)</span>
        </div>

        <form action="add_to_cart.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <input type="hidden" name="size" id="selected-size" value="1Gallon">
            <input type="hidden" name="quantity" id="hidden-quantity" value="10">

            <div class="form-controls">
                <div class="form-group">
                    <label>Size</label>
                    <div class="dropdown-wrapper">
                        <select onchange="document.getElementById('selected-size').value = this.value">
                            <option value="1Gallon">1Gallon</option>
                            <option value="5Gallon">5Gallon</option>
                            <option value="10Gallon">10Gallon</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Quantity</label>
                    <div class="quantity-selector">
                        <button type="button" onclick="adjustQuantity(-1)">−</button>
                        <input type="number" id="quantity" value="10" min="1" oninput="syncQuantity()">
                        <button type="button" onclick="adjustQuantity(1)">+</button>
                    </div>
                </div>
            </div>

            <button type="submit" class="add-to-cart">ADD TO CART</button>
        </form>
    </div>
</div>

<script>
function adjustQuantity(change) {
    const input = document.getElementById('quantity');
    let value = parseInt(input.value);
    if (!isNaN(value)) {
        value += change;
        if (value < 1) value = 1;
        input.value = value;
        document.getElementById('hidden-quantity').value = value;
    }
}
function syncQuantity() {
    const value = parseInt(document.getElementById('quantity').value);
    document.getElementById('hidden-quantity').value = isNaN(value) ? 1 : value;
}
</script>

</body>
</html>
