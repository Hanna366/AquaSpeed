<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Logout Confirmation</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #3FBDF1;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .box {
      background-color: white;
      padding: 40px 30px;
      border-radius: 15px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      text-align: center;
      width: 90%;
      max-width: 350px;
    }

    .box img {
      width: 80px;
      margin-bottom: 20px;
    }

    .box p {
      margin: 10px 0 25px;
      font-size: 16px;
      color: #333;
    }

    .btn {
      padding: 12px 25px;
      font-size: 14px;
      border-radius: 30px;
      font-weight: bold;
      cursor: pointer;
      border: none;
      width: 100%;
      margin: 5px 0;
    }

    .cancel-btn {
      background-color: #00AEEF;
      color: white;
    }

    .logout-btn {
      background-color: white;
      color: #00AEEF;
      border: 2px solid #00AEEF;
    }

    .logout-btn:hover {
      background-color: #00AEEF;
      color: white;
    }

    .cancel-btn:hover {
      background-color: #007bbd;
    }
  </style>
</head>
<body>
  <div class="box">
    <img src="img/do.png" alt="Logout Icon">
    <p><strong>Oh no! You're leaving…</strong><br>Are you sure?</p>
    
    <form method="post">
      <button class="btn cancel-btn" name="stay">Nah! Just Kidding</button>
      <button class="btn logout-btn" name="logout">Yes, Log Me Out</button>
    </form>
  </div>
</body>
</html>

<?php
// Handle the buttons
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: login.php");
        exit();
    } elseif (isset($_POST['stay'])) {
        header("Location: profile.php"); // Or wherever the user was before
        exit();
    }
}
?>
