<?php
// product.php
include 'db.php';
session_start();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($product = $result->fetch_assoc()) {
            // Product loaded successfully
        } else {
            echo "Product not found.";
            exit;
        }
    } else {
        echo "Database error.";
        exit;
    }
} else {
    echo "Invalid product.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($product['name']); ?></title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }
        .product-container {
            max-width: 700px;
            margin: 50px auto;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            border-radius: 12px;
            overflow: hidden;
        }
        .product-image {
            width: 100%;
            position: relative;
        }
        .product-image img {
            width: 100%;
            max-height: 600px;
            border-bottom: 1px solid #eee;
        }
        .icon-back, .icon-heart, .icon-cart {
            position: absolute;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }
        .icon-back {
            top: 15px;
            left: 15px;
            font-size: 60px;
            font-weight: bold;
            color: white;
        }
        .icon-heart {
            top: 40px;
            right: 15px;
            width: 40px;
            height: 40px;
            background-color: #1c1c1c;
            border-radius: 20%;
            color: white;
            font-size: 18px;
            font-weight: bold;
        }
        .icon-cart {
            top: 400px;
            right: 15px;
            width: 40px;
            height: 40px;
            background-color: white;
            border-radius: 20%;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .icon-cart img {
            width: 20px;
            height: 20px;
        }
        .product-details {
            padding: 30px;
        }
        .product-details h2 {
            margin: 0;
            font-size: 28px;
        }
        .price {
            font-size: 24px;
            margin-top: 10px;
            font-weight: bold;
        }
        .description {
            margin-top: 15px;
            font-size: 16px;
            color: #555;
        }
        .rating {
            display: flex;
            align-items: center;
            margin-top: 20px;
            font-size: 16px;
            color: #444;
        }
        .rating span.star {
            color: gold;
            margin-right: 5px;
        }
        .add-to-cart {
            background-color: #3FBDF1;
            color: white;
            width: 100%;
            padding: 18px;
            font-size: 18px;
            font-weight: bold;
            border: none;
            border-radius: 12px;
            margin-top: 30px;
            cursor: pointer;
            box-shadow: 0 4px 0 #039be5;
        }
        .add-to-cart:hover {
            background-color: #35a8d3;
        }
    </style>
</head>
<body>

<div class="product-container">
    <div class="product-image">
        <img src="img/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
        <a href="home.php" style="text-decoration: none; color: inherit;">
            <div class="icon-back">←</div>
        </a>
        <div class="icon-heart">♡</div>
        <div class="icon-cart">
            <img src="img/cart.png" alt="Cart" />
        </div>
    </div>

    <div class="product-details">
        <h2><?php echo htmlspecialchars($product['name']); ?></h2>
        <div class="price">₱<?php echo number_format($product['price'], 2); ?></div>
        <div class="description"><?php echo htmlspecialchars($product['description']); ?></div>
        <div class="rating">
            <span class="star">★</span>
            4.5 &nbsp;<span style="color:#888;">(128 reviews)</span>
        </div>

        <form action="add_to_cart.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <input type="hidden" name="size" id="selected-size" value="1Gallon">
            <input type="hidden" name="quantity" id="hidden-quantity" value="10">

            <div style="display: flex; align-items: center; gap:399px; margin-top: 25px;">
                <!-- Size Dropdown -->
                <div style="display: flex; flex-direction: column;">
                    <label for="size" style="font-weight: bold; margin-bottom: 6px;">Size</label>
                    <div class="dropdown-wrapper" style="position: relative; width: 140px;">
                        <div style="display: flex; border: 1px solid #3FBDF1; border-radius: 8px; overflow: hidden;">
                            <div style="flex: 1; padding: 10px; font-size: 14px; color: #444;" id="selected-option">1Gallon</div>
                            <button type="button" onclick="toggleDropdown()" style="background-color: #3FBDF1; border: none; width: 40px; display: flex; align-items: center; justify-content: center;">
                                <span style="border: solid white; border-width: 0 2px 2px 0; padding: 4px; transform: rotate(45deg); display: inline-block;"></span>
                            </button>
                        </div>
                        <ul id="dropdown-options" style="list-style: none; margin: 0; padding: 0; position: absolute; top: 100%; left: 0; background-color: white; border: 1px solid #3FBDF1; border-top: none; z-index: 10; display: none; max-height: 150px; overflow-y: auto; width: 100%;">
                            <li onclick="selectOption('1Gallon')" style="padding: 10px; font-size: 14px; cursor: pointer;">1Gallon</li>
                            <li onclick="selectOption('5Gallon')" style="padding: 10px; font-size: 14px; cursor: pointer;">5Gallon</li>
                            <li onclick="selectOption('10Gallon')" style="padding: 10px; font-size: 14px; cursor: pointer;">10Gallon</li>
                        </ul>
                    </div>
                </div>

                <!-- Quantity -->
                <div style="display: flex; flex-direction: column;">
                    <label for="quantity" style="font-weight: bold; margin-bottom: 6px;">Quantity</label>
                    <div style="display: flex; align-items: center; background-color: #f7f7f7; border-radius: 8px; overflow: hidden;">
                        <button type="button" onclick="adjustQuantity(-1)" style="width: 36px; height: 36px; background-color: #fafafa; border: none; font-size: 20px; color: #999;">−</button>
                        <input type="number" id="quantity" value="10" min="1" style="width: 50px; text-align: center; font-size: 16px; border: none; background: transparent;" oninput="syncQuantity()">
                        <button type="button" onclick="adjustQuantity(1)" style="width: 36px; height: 36px; background-color: #e6e6e6; border: none; font-size: 20px; color: #444;">+</button>
                    </div>
                </div>
            </div>

            <button type="submit" class="add-to-cart">Add to Cart</button>
        </form>
    </div>
</div>

<script>
    function toggleDropdown() {
        const options = document.getElementById('dropdown-options');
        options.style.display = options.style.display === 'block' ? 'none' : 'block';
    }

    function selectOption(value) {
        document.getElementById('selected-option').textContent = value;
        document.getElementById('selected-size').value = value;
        document.getElementById('dropdown-options').style.display = 'none';
    }

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

    document.addEventListener('click', function(event) {
        const wrapper = document.querySelector('.dropdown-wrapper');
        if (!wrapper.contains(event.target)) {
            document.getElementById('dropdown-options').style.display = 'none';
        }
    });
</script>

</body>
</html>
