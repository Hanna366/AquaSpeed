<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Aquaspeed Delivery App</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background-color: #f4f4f4;
      padding-bottom: 80px; /* prevent content from hiding under nav */
    }

    .header {
      background-color: #3FBDF1;
      color: white;
      padding: 20px;
      padding-top: 40px;
      text-align: left;
    }

    .header h2 {
      margin: 0;
      font-size: 20px;
    }

    .header p {
      margin: 0;
      font-size: 14px;
    }

    .search-bar {
      background-color: #3FBDF1;
      padding: 10px 20px;
    }

    .search-bar input {
      width: 100%;
      height: 45px;
      padding: 12px 40px 12px 14px;
      border-radius: 10px;
      border: none;
      font-size: 14px;
      background: rgba(183, 183, 183, 0.83) url('search-icon.png') no-repeat right 14px center;
      background-size: 20px;
      box-sizing: border-box;
      color: #fff;
    }

    .search-bar input::placeholder {
      color: #fff;
      opacity: 1;
    }

    .banner {
      position: relative;
      margin: 16px;
      height: 145px;
      background: url('img/water.png') no-repeat center center;
      background-size: 100% 110%;
      border-radius: 14px;
      overflow: hidden;
      color: white;
    }

    .banner-overlay {
      position: absolute;
      top: 0; right: 0; bottom: 0; left: 0;
      background-color: rgba(0, 0, 0, 0.35);
      z-index: 1;
    }

    .banner-content {
      position: absolute;
      top: 16px;
      left: 16px;
      z-index: 2;
    }

    .banner-content h3 {
      margin: 0;
      font-size: 16px;
      font-weight: bold;
    }

    .banner-content p {
      margin: 4px 0;
      font-size: 13px;
      color: #eaeaea;
    }

    .emergency-container {
      display: flex;
      align-items: center;
      gap: 8px;
      justify-content: center;
      margin-top: 20px;
    }

    .emergency-text {
      font-size: 13px;
      color: black;
      margin-left: 1000px;
    }

    .emergency-arrow {
      font-size: 30px;
      color: red;
      font-weight: bold;
    }

    .emergency-btn {
      background-color: #FFC72C;
      color: #000;
      border: none;
      width: 150px;
      height: 40px;
      border-radius: 6px;
      font-weight: bold;
      padding: 6px 10px;
      font-size: 12px;
      cursor: pointer;
    }

    .emergency-btn:hover {
      background-color: rgb(255, 213, 99);
    }

    .products {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 16px;
      padding: 16px;
    }

    .product {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
      overflow: hidden;
      position: relative;
      display: flex;
      flex-direction: column;
      text-align: left;
      transition: transform 0.2s;
    }

    .product:hover {
      transform: scale(1.01);
    }

    .image-container {
      background-color: #e6f7ff;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 10px;
      height: 160px;
      position: relative;
    }

    .product img {
      max-height: 110%;
      max-width: 100%;
      object-fit: contain;
    }

    .favorite-icon {
      position: absolute;
      top: 10px;
      right: 10px;
      background: black;
      color: white;
      padding: 6px;
      border-radius: 20%;
      font-size: 16px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.2);
      z-index: 2;
    }

    .product-info {
      padding: 12px;
    }

    .product-info h4 {
      margin: 0;
      font-size: 14px;
      font-weight: bold;
      color: #000;
    }

    .product-info span {
      font-size: 13px;
      color: #666;
      display: block;
      margin-top: 2px;
    }

    .product-info p {
      margin-top: 6px;
      font-size: 13px;
      font-weight: 500;
      color: #000;
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
      display: inline-block;
      pointer-events: auto; /* ensures only image is interactive */
    }

.bottom-nav a.active img,
.bottom-nav a:hover img {
      opacity: 1;
      filter: brightness(0) saturate(100%) contrast(150%);
    }

  </style>
</head>
<body>

  <div class="header">
    <p>Welcome Back!</p>
    <h2>AQUASPEED DELIVERY APP</h2>
  </div>

  <div class="search-bar">
    <input type="text" placeholder="Search" />
  </div>

  <div class="banner">
    <div class="banner-overlay"></div>
    <div class="banner-content">
      <h3>Bugwak Water Refilling</h3>
      <p>Water delivery</p>
    </div>
  </div>

  <div class="emergency-container">
    <span class="emergency-text">Go emergency order, need water now!</span>
    <span class="emergency-arrow">➔</span>
    <button class="emergency-btn" onclick="window.location.href='emergency_product.php?id=2'">Emergency Order</button>
  </div>

  <div class="products">
    <a href="product.php?id=1" style="text-decoration: none; color: inherit;">
      <div class="product">
        <div class="image-container">
          <span class="favorite-icon">♡</span>
          <img src="img/gal.jpeg" alt="10 Gallons or More">
        </div>
        <div class="product-info">
          <h4>10 Gallons and more</h4>
          <span>(Resellers price)</span>
          <p>₱15</p>
        </div>
      </div>
    </a>

    <a href="product.php?id=3" style="text-decoration: none; color: inherit;">
      <div class="product">
        <div class="image-container">
          <span class="favorite-icon">♡</span>
          <img src="img/gallon.jpeg" alt="New Gallon with Water">
        </div>
        <div class="product-info">
          <h4>New Gallon with Water</h4>
          <span>(New Batch)</span>
          <p>₱150</p>
        </div>
      </div>
    </a>

    <a href="product.php?id=4" style="text-decoration: none; color: inherit;">
      <div class="product">
        <div class="image-container">
          <span class="favorite-icon">♡</span>
          <img src="img/one.jpeg" alt="Below 10 Gallons">
        </div>
        <div class="product-info">
          <h4>Below 10 Gallons</h4>
          <p>₱20</p>
        </div>
      </div>
    </a>

    <a href="product.php?id=5" style="text-decoration: none; color: inherit;">
      <div class="product">
        <div class="image-container">
          <span class="favorite-icon">♡</span>
          <img src="img/bottle.jpeg" alt="500ml Water">
        </div>
        <div class="product-info">
          <h4>500mL Water</h4>
          <p>₱10</p>
        </div>
      </div>
    </a>
  </div>

  <!-- Bottom Navigation -->
  <div class="bottom-nav">
    <a href="home.php" class="active"><img src="img/home.png" alt="Home"></a>
    <a href="view_cart.php"><img src="img/gcr.png" alt="Orders"></a>
    <a href="favorites.php"><img src="img/gh.png" alt="Favorites"></a>
    <a href="profile.php"><img src="img/gp.png" alt="Profile"></a>
  </div>

</body>
</html>
