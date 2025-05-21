<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "aqua_speed";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Create connection
$conn = new mysqli($host, $user, $password, $dbname,  3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
