<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$siteKey = $_ENV['RECAPTCHA_SITE_KEY'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Login</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Helvetica Neue', sans-serif;
      background-color: #fff;
      color: #333;
    }

    .container {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
    }

    .back-arrow {
      font-size: 50px;
      margin-bottom: 20px;
      cursor: pointer;
      color: #29b6f6;
    }

    h2 {
      color: #00AEEF;
      margin-bottom: 10px;
    }

    p.subtitle {
      font-size: 14px;
      color: #555;
      margin-bottom: 30px;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-family: 'Poppins', sans-serif;
      font-size: 14px;
      font-weight: bold;
    }

    input[type="email"],
    input[type="password"] {
      width: 290px;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      margin-bottom: 20px;
      font-size: 14px;
    }

    .forgot {
      text-align: right;
      font-size: 13px;
      font-weight: 600;
      font-family: 'Poppins', sans-serif;
      margin-bottom: 80px;
      margin-right: 90px;
      color: #333;
      cursor: pointer;
    }

    .login-btn {
      width: 318px;
      height: 60px;
      padding: 14px;
      background-color: #00AEEF;
      color: #fff;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      font-size: 14px;
      box-shadow: 0 4px 0 #039be5;
      cursor: pointer;
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .login-btn:hover {
      background-color: #008fc7;
      box-shadow: 0 6px 0 #027bb5;
    }
  </style>

  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
  <div class="container">
    <div class="back-arrow" onclick="window.history.back()">&larr;</div>
    <h2>Admin Login</h2>
    <p class="subtitle">Enter your credentials to access the admin panel.</p>

    <?php if (isset($_GET['error'])): ?>
      <div style="color: red; font-size: 14px; margin-bottom: 20px;">
        <?php
          switch ($_GET['error']) {
            case 'invalid': echo "Invalid password."; break;
            case 'noaccount': echo "No admin account found with that email."; break;
            case 'recaptcha': echo "Please verify that you are not a robot."; break;
          }
        ?>
      </div>
    <?php endif; ?>

    <form action="admin_login_validate.php" method="post">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="admin@example.com" required />

      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="********" required />

      <div class="g-recaptcha" data-sitekey="<?= htmlspecialchars($siteKey) ?>"></div>

      <div class="forgot" onclick="location.href='forgot_password.php'">Forgot Password?</div>

      <button type="submit" class="login-btn">LOGIN AS ADMIN</button>
    </form>
  </div>
</body>
</html>
