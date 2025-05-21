<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome - AquaSpeed</title>
  <link rel="stylesheet" href="styles/style.css">
  <script>
    // Auto-redirect after 3 seconds
    setTimeout(function(){
      window.location.href = "onboarding.php";
    }, 2000); // 2000 milliseconds = 2 seconds para redirect sa other frame
  </script>
</head>
<body class="splash">
  <div class="center-content">
    <img src="img/aqua.png" alt="AquaSpeed Logo" class="logo">
    <h1>Fast delivery</h1>
    <p>Taste that refreshment, right on time.</p>
  </div>
</body>
</html>
