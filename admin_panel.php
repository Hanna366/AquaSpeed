<?php
session_start();
include 'db.php';

// Fetch recent reviews
$reviews = [];
$sql = "SELECT name AS customer_name, rating, comment FROM reviews ORDER BY created_at DESC LIMIT 5";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Panel</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f9f9f9;
      margin: 0;
      padding: 20px;
      color: #333;
    }

    h1 {
      text-align: center;
    }

    .card-container {
      display: flex;
      justify-content: space-between;
      margin: 20px 0;
      flex-wrap: wrap;
    }

    .card {
      background: #fff;
      border-radius: 70px;
      height: 180px;
      padding: 11px;
      width: 30%;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      text-align: center;
      margin-bottom: 20px;
    }

    .section {
      display: flex;
      gap: 20px;
      margin-bottom: 20px;
    }

    .table-box, .sales-box {
      background: #fff;
      padding: 20px;
      flex: 1;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      position: relative;
    }

    .download-report {
      position: absolute;
      top: 20px;
      right: 20px;
    }

    .download-report button {
      background-color: #3FBDF1;
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    table th, table td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ccc;
    }

    .reviews-card {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .review-table {
      width: 100%;
      border-collapse: collapse;
    }

    .review-table th, .review-table td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #eee;
    }

    .back {
      font-size: 60px;
      font-weight: bold;
      cursor: pointer;
      margin-bottom: 20px;
      display: inline-block;
      color: #3FBDF1;
    }

    .tag {
      padding: 4px 10px;
      border-radius: 12px;
      font-size: 12px;
      color: white;
    }

    .delivered { background: green; }
    .pending { background: orange; }
    .cancelled { background: red; }
  </style>
</head>
<body>

  <div class="back" onclick="window.history.back()">←</div>
  <h1>Admin</h1>

  <div class="card-container">
    <div class="card">
      <p>Total Orders<br><small>↑ 25% Today</small></p>
      <h2>150</h2>
    </div>
    <div class="card">
      <p>Revenue<br><small>↑ 25% Today</small></p>
      <h2>₱2500</h2>
    </div>
    <div class="card">
      <p>Customers<br><small>↑ 25% Today</small></p>
      <h2>105</h2>
    </div>
  </div>

  <div class="section">
    <div class="table-box">
      <h3>Recent Orders</h3>
      <table>
        <thead>
          <tr><th>Customer</th><th>Address</th><th>Status</th></tr>
        </thead>
        <tbody>
          <tr><td>Hanna Ares</td><td>P. LAGSAN</td><td><span class="tag delivered">Delivered</span></td></tr>
          <tr><td>Lara Jayne</td><td>P. LAGSAN</td><td><span class="tag pending">Pending</span></td></tr>
          <tr><td>Anya Joy</td><td>P. LAGSAN</td><td><span class="tag cancelled">Cancelled</span></td></tr>
        </tbody>
      </table>
    </div>

    <div class="sales-box">
      <h3>Sales Report</h3>
      <form class="download-report" action="generate_report.php" method="post" target="_blank">
        <button type="submit">Download PDF</button>
      </form>
      <canvas id="salesChart" width="400" height="200"></canvas>
    </div>
  </div>

  <div class="reviews-card">
    <h3>Customer Reviews</h3>
    <table class="review-table">
      <thead>
        <tr><th>Customer</th><th>Rating</th><th>Comment</th></tr>
      </thead>
      <tbody>
        <?php if (!empty($reviews)): ?>
          <?php foreach ($reviews as $review): ?>
          <tr>
            <td><?= htmlspecialchars($review['customer_name']) ?></td>
            <td><?= str_repeat('⭐', (int)$review['rating']) ?></td>
            <td><?= htmlspecialchars($review['comment']) ?></td>
          </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="3">No reviews found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
          label: 'Sales',
          data: [1200, 1000, 1800, 1600, 2100, 2500],
          borderColor: '#3FBDF1',
          backgroundColor: 'transparent',
          tension: 0.4,
          borderWidth: 3,
          fill: false,
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            ticks: { color: '#888' },
            grid: { color: '#eee' }
          },
          x: {
            ticks: { color: '#888' },
            grid: { display: false }
          }
        },
        plugins: {
          legend: { display: false }
        },
        animation: {
          duration: 1500,
          easing: 'easeOutQuart'
        }
      }
    });
  </script>

</body>
</html>
