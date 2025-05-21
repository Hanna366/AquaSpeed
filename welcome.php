<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Welcome to AquaSpeed</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html, body {
      font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
      background-color: #000;
      color: white;
      width: 100%;
      overflow-x: hidden;
    }

    .top {
      position: relative;
      width: 100%;
    }

    .top img {
      width: 100%;
      height: auto;
      display: block;
    }

    .welcome-group {
      position: absolute;
      bottom: -80px;
      left: 50%;
      transform: translateX(-50%);
      text-align: center;
      width: 100%;
      max-width: 100%;
      padding: 0 30px;
      z-index: 10;
    }

    .welcome-group h1 {
      font-size: 24px;
      margin-bottom: 5px;
      font-weight: bold;
    }

    .welcome-group p {
      font-size: 16px;
      color: #ccc;
      margin-bottom: 30px;
    }

    .btn {
      width: 318px;
      height: 60px;
      padding: 14px 0;
      font-size: 14px;
      font-weight: bold;
      border-radius: 6px;
      text-align: center;
      margin: 0 auto 10px;
      text-decoration: none;
      display: block;
    }

    .btn-primary {
      background-color: white;
      color: black;
      border: none;
    }

    .btn-secondary {
      background-color: transparent;
      color: white;
      border: 2px solid white;
    }

    .btn-google {
  background-color: white;
  color: #000;
  border: 2px solid #4285F4;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  text-transform: uppercase;
}

.btn-google .icon {
  display: flex;
  align-items: center;
}

.btn-google img {
  height: 24px;
  width: 24px;
}


    .btn:hover {
      background: #5c6672;
    }

    .guest-link {
      font-size: 13px;
      margin-top: 16px;
      text-decoration: underline;
      cursor: pointer;
    }

    .bottom {
      background: linear-gradient(to bottom, #3a3a3a, #222222, #121212);
      text-align: center;
      padding: 120px 20px 60px;
    }

    @media (max-width: 600px) {
      .welcome-group {
        bottom: -100px;
      }
    }
  </style>
</head>
<body>

  <div class="top">
    <img src="img/bg.png" alt="AquaSpeed Background" />
    <div class="welcome-group">
      <h1>Welcome to AquaSpeed</h1>
      <p>Water Delivery app</p>
      <a href="account.php" class="btn btn-primary">CREATE AN ACCOUNT</a>
      <a href="login.php" class="btn btn-secondary">LOGIN</a>
      <a href="admin_login.php" class="btn btn-secondary">ADMIN LOGIN</a>
      <a href="google_login.php" class="btn btn-google">
  <span class="icon"><img src="img/gog.png" alt="Google Icon"></span>
       <span>LOGIN WITH GOOGLE</span>
</a>
      <div class="guest-link" onclick="location.href='guest-home.php'">Continue as Guest</div>
    </div>
  </div>

  <div class="bottom"></div>

</body>
</html>
