<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>QR Scan</title>
  <style>
    body {
      margin: 0;
      font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
      background-color: #fff;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      height: 100vh;
    }

    .container {
      width: 100%;
      max-width: 400px;
      padding: 20px;
      text-align: center;
      margin-top: 50px;
    }

    .back-arrow {
      position: absolute;
      top: 20px;
      right: 20px; /* <-- moved to right */
      font-size: 50px;
      color: #29b6f6;
      text-decoration: none;
    }

    .qr-image {
      width: 200px;
      height: 200px;
      margin: 40px auto 20px;
    }

    h2 {
      font-size: 20px;
      font-weight: bold;
      color: #555;
      margin-bottom: 10px;
    }

    p {
      font-size: 13px;
      color: #888;
      margin-bottom: 30px;
    }

.btn {
  display: block;
  width: 100%;
  max-width: 240px;
  margin: 0 auto;
  padding: 12px 0;
  background-color: #4dc3ff; /* Light sky blue */
  color: white;
  text-align: center;
  font-weight: bold;
  font-size: 14px;
  border: none;
  border-radius: 5px;
  text-decoration: none;
  box-shadow: 0 4px 0 #039be5; /* Blue base shadow */
  transition: background-color 0.3s ease;
}

.btn:hover {
  background-color: #039be5;
}



  </style>
</head>
<body>

  <a href="onboarding.php" class="back-arrow">&#8592;</a>

  <div class="container">
    <img src="img/qr.png" alt="QR Code" class="qr-image">

    <h2>QR SCAN</h2>
    <p>A QR scanner directing to AquaSpeeD Delivery app.</p>

    <a href="welcome.php" class="btn">NEXT</a>
  </div>

</body>
</html>
