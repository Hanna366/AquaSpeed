<?php
require_once __DIR__ . '/vendor/autoload.php';
include 'db.php';

$mpdf = new \Mpdf\Mpdf();
$mpdf->SetTitle("AquaSpeed - Full Report");

// --- PAGE 1: CUSTOMER REVIEWS ---
$reviewQuery = "SELECT name, rating, comment FROM reviews ORDER BY created_at DESC";
$reviewResult = $conn->query($reviewQuery);

$reviewHtml = '
<h2 style="text-align:center;">Customer Reviews Report</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="10">
  <thead>
    <tr>
      <th>Name</th>
      <th>Rating</th>
      <th>Comment</th>
    </tr>
  </thead>
  <tbody>
';

if ($reviewResult && $reviewResult->num_rows > 0) {
    while ($row = $reviewResult->fetch_assoc()) {
        $reviewHtml .= '<tr>
            <td>' . htmlspecialchars($row['name']) . '</td>
            <td>' . str_repeat('⭐', (int)$row['rating']) . '</td>
            <td>' . htmlspecialchars($row['comment']) . '</td>
        </tr>';
    }
} else {
    $reviewHtml .= '<tr><td colspan="3">No reviews available</td></tr>';
}
$reviewHtml .= '</tbody></table>';

$mpdf->WriteHTML($reviewHtml);
$mpdf->AddPage(); // === PAGE BREAK ===

// --- PAGE 2: ORDERS MADE ---
$orderQuery = "SELECT id, address, contact, delivery_option, total, payment_method, order_time, schedule_date, schedule_time, order_status FROM orders ORDER BY order_time DESC";
$orderResult = $conn->query($orderQuery);

$orderHtml = '
<h2 style="text-align:center;">Orders Made</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="10">
  <thead>
    <tr>
      <th>Order ID</th>
      <th>Address</th>
      <th>Contact</th>
      <th>Delivery Option</th>
      <th>Total</th>
      <th>Payment</th>
      <th>Order Time</th>
      <th>Schedule</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
';

if ($orderResult && $orderResult->num_rows > 0) {
    while ($row = $orderResult->fetch_assoc()) {
        $schedule = $row['schedule_date'] ? htmlspecialchars($row['schedule_date'] . ' ' . $row['schedule_time']) : 'N/A';
        $orderHtml .= '<tr>
            <td>' . htmlspecialchars($row['id']) . '</td>
            <td>' . htmlspecialchars($row['address']) . '</td>
            <td>' . htmlspecialchars($row['contact']) . '</td>
            <td>' . htmlspecialchars($row['delivery_option']) . '</td>
            <td>₱' . number_format($row['total'], 2) . '</td>
            <td>' . htmlspecialchars($row['payment_method']) . '</td>
            <td>' . date('F j, Y, g:i a', strtotime($row['order_time'])) . '</td>
            <td>' . $schedule . '</td>
            <td>' . htmlspecialchars($row['order_status']) . '</td>
        </tr>';
    }
} else {
    $orderHtml .= '<tr><td colspan="9">No orders available</td></tr>';
}
$orderHtml .= '</tbody></table>';

$mpdf->WriteHTML($orderHtml);
$mpdf->Output("aqua_speed_full_report.pdf", "I");
?>
