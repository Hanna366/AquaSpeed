<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $delivery = $_POST['delivery'];
    $payment = $_POST['payment_method'];
    $subtotal = $_POST['subtotal'];
    $delivery_fee = $_POST['delivery_fee'];
    $total = $_POST['total'];

    $stmt = $conn->prepare("INSERT INTO orders (address, contact, delivery_option, subtotal, delivery_fee, total, payment_method) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssdds", $address, $contact, $delivery, $subtotal, $delivery_fee, $total, $payment);
    $stmt->execute();
    $stmt->close();

    // Optionally clear the session cart
    unset($_SESSION['cart']);

    header("Location: order_success.php");
    exit();
}
?>
