<?php
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Create Account</title>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .form-container {
      background-color: transparent;
      padding: 30px;
      border-radius: 10px;
      width: 100%;
      max-width: 380px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
      color: #00AEEF;
      margin-bottom: 10px;
    }

    p {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin: 15px 0 5px;
      font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      height: 50px;
      padding: 14px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
      box-sizing: border-box;
    }

    .btn {
      width: 100%;
      height: 60px;
      margin-top: 20px;
      background-color: #00AEEF;
      color: white;
      font-size: 14px;
      font-weight: bold;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      box-shadow: 0 4px 0 #039be5;
    }

    .btn:hover {
      background-color: #0095d9;
    }

    .link {
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
    }

    .link a {
      color: #00AEEF;
      text-decoration: none;
      font-weight: bold;
    }

    .g-recaptcha {
      margin-top: 15px;
    }
  </style>
</head>
<body>

  <div class="form-container">
    <h2>Create your Account</h2>
    <p>Please fill in your details to create your account</p>
    <form action="signup_validate.php" method="post">
      <label for="name">Name</label>
      <input type="text" name="name" required>

      <label for="email">Email</label>
      <input type="email" name="email" required>

      <label for="password">Password</label>
      <input type="password" name="password" required>

      <label for="confirm_password">Confirm Password</label>
      <input type="password" name="confirm_password" required>

      <!-- reCAPTCHA widget -->
      <div class="g-recaptcha" data-sitekey="<?php echo $_ENV['RECAPTCHA_SITE_KEY']; ?>"></div>

      <button type="submit" class="btn">CREATE AN ACCOUNT</button>
    </form>
    <div class="link">
      Already have an account? <a href="login.php">Sign in</a>
    </div>
  </div>

</body>
</html>
