<?php
session_start();
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #fff;
            margin: 0;
            padding: 40px;
            color: #333;
        }

        h2 {
            color: #00bfff;
            font-size: 28px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
        }

                .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .cart-header h2 {
            font-size: 28px;
            font-weight: bold;
            color: #00bfff;
            margin: 0;
        }

        .back-arrow {
            font-size: 40px;
            color: #00bfff;
            text-decoration: none;
            transform: rotate(180deg);
            transition: color 0.2s ease;
        }

        .back-arrow:hover {
            color: #3FBDF1;
        }


        .cart-item {
            display: flex;
            align-items: center;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            padding: 20px;
            margin-bottom: 20px;
        }

        .cart-item img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 10px;
            margin-right: 20px;
        }

        .item-info {
            flex: 1;
        }

        .item-name {
            font-weight: bold;
            font-size: 18px;
        }

        .item-sub {
            font-size: 14px;
            color: #777;
            margin-bottom: 5px;
        }

        .item-price {
            color: #00bfff;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .quantity-controls input {
            width: 50px;
            text-align: center;
            padding: 6px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .quantity-controls button {
            width: 30px;
            height: 30px;
            font-size: 16px;
            background: #f2f2f2;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .remove-btn {
            background: none;
            border: none;
            font-size: 20px;
            color: #888;
            margin-left: 15px;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .remove-btn:hover {
            color: red;
        }

        .cart-summary {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 300px;
        }

        .total {
            font-size: 18px;
            font-weight: bold;
        }

        .checkout-btn {
            background: #00bfff;
            color: white;
            padding: 12px 30px;
            font-size: 16px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            box-shadow: 0 4px 0 #039be5;
        }

        .checkout-btn:hover {
            background: #0095cc;
        }

        .empty-cart {
            text-align: center;
            margin-top: 50px;
            font-size: 18px;
            color: #999;
        }
    </style>
</head>
<body>

<div class="cart-header">
    <h2>Cart</h2>
    <a href="home.php" class="back-arrow">➜</a>
</div>


<div id="cart-items">
<?php
$total = 0;
if (!empty($_SESSION['cart'])):
    foreach ($_SESSION['cart'] as $id => $item):
        $subtotal = $item['price'] * $item['quantity'];
        $total += $subtotal;
?>
    <div class="cart-item" data-id="<?php echo $id; ?>">
    <img src="img/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
        <div class="item-info">
            <div class="item-name"><?php echo htmlspecialchars($item['name']); ?></div>
            <div class="item-sub">1G</div>
            <div class="item-price">₱<?php echo number_format($item['price'], 2); ?></div>
            <form class="quantity-controls" action="update_cart.php" method="post">
                <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                <button type="submit" name="decrease">-</button>
                <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1">
                <button type="submit" name="increase">+</button>
            </form>
        </div>
        <button class="remove-btn" data-id="<?php echo $id; ?>">🗑️</button>
    </div>
    </div>
<?php endforeach; else: ?>
    <p class="empty-cart">Your cart is empty.</p>
<?php endif; ?>
</div>

<?php if ($total > 0): ?>
<div class="cart-summary" id="cart-summary">
    <div class="total" id="cart-total">TOTAL ₱<?php echo number_format($total, 2); ?></div>
    <a href="checkout.php"><button class="checkout-btn">CHECKOUT</button></a>
</div>
<?php endif; ?>

<script>
document.querySelectorAll('.remove-btn').forEach(button => {
    button.addEventListener('click', () => {
        const productId = button.dataset.id;

        fetch('remove_from_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'product_id=' + encodeURIComponent(productId)
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const item = document.querySelector(`.cart-item[data-id="${productId}"]`);
                if (item) item.remove();

                const items = document.querySelectorAll('.cart-item');
                let newTotal = 0;

                items.forEach(el => {
                    const price = parseFloat(el.querySelector('.item-price').textContent.replace(/[₱,]/g, ''));
                    const qty = parseInt(el.querySelector('input[name="quantity"]').value);
                    newTotal += price * qty;
                });

                const totalElem = document.getElementById('cart-total');
                if (newTotal === 0) {
                    document.getElementById('cart-items').innerHTML = '<p class="empty-cart">Your cart is empty.</p>';
                    document.getElementById('cart-summary').remove();
                } else if (totalElem) {
                    totalElem.textContent = 'TOTAL ₱' + newTotal.toFixed(2);
                }
            }
        });
    });
});
</script>

</body>
</html>
