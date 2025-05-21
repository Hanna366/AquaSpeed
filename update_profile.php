<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users SET name = ?, address = ?, contact = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $name, $address, $contact, $email, $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Profile updated successfully!";
    } else {
        $_SESSION['error'] = "Failed to update profile.";
    }

    header("Location: profile.php"); // redirect to view profile
    exit();
}
?>
