<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Onboarding</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    /* Basic reset */
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: 'Arial', sans-serif;
      background-color: #ffffff;
    }

    /* Splash and Welcome shared style */
    .center-content {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
      padding: 20px;
      text-align: center;
    }

    .logo {
      width: 180px;
      height: 180px;
      object-fit: cover;
      border-radius: 50%;
      margin-bottom: 20px;
    }

    /* Splash screen text */
    #splash h1 {
      font-size: 28px;
      color: #333;
      margin: 10px 0;
    }

    #splash p {
      font-size: 16px;
      color: #6e6e6e;
    }

    /* Welcome screen hidden at first */
    #welcome {
      display: none;
    }

    /* Welcome texts */
    #welcome h2 {
      font-size: 24px;
      color: #4a4a4a;
      font-weight: bold;
      margin: 10px 0;
    }

    #welcome p {
      font-size: 14px;
      color: #6e6e6e;
      margin-bottom: 30px;
    }

    /* Button styling */
    .btn {
      width: 100%;
      max-width: 318px;
      padding: 12px 0;
      background-color: #4EC3FF;
      color: white;
      font-size: 14px;
      font-weight: bold;
      text-decoration: none;
      border-radius: 5px;
      letter-spacing: 1px;
      box-shadow: 0 4px 0 #039be5; /* Blue base shadow */
      transition: background-color 0.3s;
    }

    .btn:hover {
      background-color: #1A9DDC;
    }
  </style>
  <script>
    window.onload = function() {
      setTimeout(() => {
        document.getElementById('splash').style.display = 'none';
        document.getElementById('welcome').style.display = 'flex'; // flex to center nicely
      }, 2500); // 2.5 seconds
    };
  </script>
</head>
<body>

  <!-- Splash Screen -->
  <div id="splash" class="center-content">
    <img src="img/bugwak.jpeg" class="logo" alt="BUGWAK Logo">
    <h1>Fast delivery</h1>
    <p>Taste that refreshment, right on time.</p>
  </div>

  <!-- Welcome Screen -->
  <div id="welcome" class="center-content">
    <img src="img/bugwak.jpeg" class="logo" alt="BUGWAK Logo">
    <h2>We provide best quality water</h2>
    <p>WELCOME TO BUGWAK WATER REFILLING DELIVERY APP</p>
    <a href="qr.php" class="btn">GET STARTED</a>
  </div>

</body>
</html>
