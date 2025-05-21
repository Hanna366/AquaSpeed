<?php
session_start();

if (isset($_POST['product_id']) && isset($_SESSION['cart'][$_POST['product_id']])) {
    $id = $_POST['product_id'];

    if (isset($_POST['increase'])) {
        $_SESSION['cart'][$id]['quantity']++;
    } elseif (isset($_POST['decrease']) && $_SESSION['cart'][$id]['quantity'] > 1) {
        $_SESSION['cart'][$id]['quantity']--;
    } elseif (isset($_POST['quantity'])) {
        $qty = max(1, intval($_POST['quantity']));
        $_SESSION['cart'][$id]['quantity'] = $qty;
    }
}

header("Location: view_cart.php");
exit();
