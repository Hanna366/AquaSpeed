<?php
session_start();
if (isset($_POST['product_id'])) {
    $id = $_POST['product_id'];
    unset($_SESSION['cart'][$id]);
    echo json_encode(['success' => true]);
    exit;
}
echo json_encode(['success' => false]);
