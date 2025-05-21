<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT name, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($name, $email);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Profile</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background-color: #fff;
      padding-bottom: 80px;
    }

    .profile-header {
      text-align: center;
      padding-top: 30px;
    }

    .avatar {
      width: 90px;
      height: 90px;
      border-radius: 50%;
      margin: 0 auto 10px;
      display: block;
    }

    .profile-info h3 {
      margin: 0;
      font-size: 18px;
      font-weight: 600;
    }

    .profile-info p {
      margin: 4px 0;
      font-size: 13px;
      color: gray;
    }

    .edit-btn {
      display: block;
      width: 90%;
      max-width: 360px;
      height: 52px;
      margin: 20px auto;
      padding: 12px;
      background-color: #3FBDF1;
      color: white;
      font-size: 14px;
      font-weight: bold;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      box-shadow: 0 4px 0 #039be5; /* Blue base shadow */
    }
    .edit-btn:hover {
      background-color: #039be5; /* Darker blue on hover */
    }

    .menu {
      display: flex;
      flex-direction: column;
      gap: 22px;
      padding: 30px 24px;
    }

    .menu-item {
      display: flex;
      align-items: center;
      font-size: 14px;
      color: #000;
      text-decoration: none;
      margin-bottom: 22px;
    }

    .menu-item img {
      width: 20px;
      height: 20px;
      margin-right: 15px;
    }

    .menu-item:hover {
      background-color: #f9f9f9;
      border-radius: 8px;
      padding: 8px;
    }

    .bottom-nav {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 65px;
      background: #fff;
      border-top: 1px solid #ddd;
      display: flex;
      justify-content: space-around;
      align-items: center;
      z-index: 1000;
    }

    .bottom-nav a {
      flex: 1;
      text-align: center;
      padding-top: 6px;
    }

    .bottom-nav a img {
      width: 70px;
      height: 70px;
      opacity: 0.6;
      transition: opacity 0.2s ease, filter 0.2s ease;
    }

    .bottom-nav a.active img,
    .bottom-nav a:hover img {
      opacity: 1;
      filter: brightness(0) saturate(100%) contrast(150%);
    }
  </style>
</head>
<body>

  <div class="profile-header">
    <img src="img/per.jpeg" alt="Avatar" class="avatar">
    <div class="profile-info">
      <h3><?= htmlspecialchars($name) ?></h3>
      <p><?= htmlspecialchars($email) ?></p>
    </div>
    <form action="edit_profile.php" method="get">
  <button type="submit" class="edit-btn">EDIT PROFILE</button>
</form>

  </div>

  <div class="menu">
    <a href="home.php" class="menu-item"><img src="img/h2.png"> HOME</a>
    <a href="orders.php" class="menu-item"><img src="img/orders.png"> ORDERS</a>
    <a href="addresses.php" class="menu-item"><img src="img/l2.png"> MY ADDRESSES</a>
    <a href="notifications.php" class="menu-item"><img src="img/not.png"> NOTIFICATIONS</a>
    <a href="help.php" class="menu-item"><img src="img/help.png"> HELP</a>
    <a href="logout_confirm.php" class="menu-item"><img src="img/out.png"> LOG OUT</a>
  </div>

  <div class="bottom-nav">
    <a href="home.php"><img src="img/home.png" alt="Home"></a>
    <a href="view_cart.php"><img src="img/gcr.png" alt="Orders"></a>
    <a href="favorites.php"><img src="img/gh.png" alt="Favorites"></a>
    <a href="profile.php" class="active"><img src="img/gp.png" alt="Profile"></a>
  </div>

</body>
</html>
