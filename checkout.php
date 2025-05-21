<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $delivery = $_POST['delivery'];
    $payment = $_POST['payment_method'];
    $subtotal = $_POST['subtotal'];
    $delivery_fee = $_POST['delivery_fee'];
    $total = $_POST['total'];
    $schedule_date = $_POST['schedule_date'] ?? null;
    $schedule_time = $_POST['schedule_time'] ?? null;

    $stmt = $conn->prepare("INSERT INTO orders (address, contact, delivery_option, subtotal, delivery_fee, total, payment_method, schedule_date, schedule_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssddsss", $address, $contact, $delivery, $subtotal, $delivery_fee, $total, $payment, $schedule_date, $schedule_time);
    $stmt->execute();
    $order_id = $stmt->insert_id;
    $stmt->close();
    header("Location: order_success.php?order_id=" . $order_id);
    exit();
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
      background-color: #f9f9f9;
    }
    .checkout-container {
      max-width: 600px;
      margin: 0 auto;
      background: white;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .checkout-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    .checkout-title {
      color: #00bfff;
      font-size: 22px;
      font-weight: bold;
    }
    .back-arrow {
      text-decoration: none;
      font-size: 34px;
      color: #00bfff;
    }
    .address-section, .payment-section, .summary-section {
      margin-bottom: 25px;
    }
    .delivery-options {
      display: flex;
      gap: 10px;
      margin-bottom: 15px;
    }
    .delivery-option {
      flex: 1;
      border: 1px solid #ccc;
      border-radius: 10px;
      padding: 12px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      cursor: pointer;
    }
    .delivery-option input[type="radio"] {
      display: none;
    }
    .delivery-label-text {
      font-size: 13px;
      font-weight: bold;
    }
    .delivery-label-text small {
      display: block;
      font-size: 11px;
      color: #888;
    }
    .radio-circle {
      width: 20px;
      height: 20px;
      border: 2px solid #ccc;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .delivery-option.selected .radio-circle {
      background-color: #00bfff;
      border-color: #00bfff;
    }
    .radio-circle::after {
      content: '✔';
      color: white;
      font-size: 12px;
      display: none;
    }
    .delivery-option.selected .radio-circle::after {
      display: block;
    }

    .schedule-section {
      display: none;
    }
    .calendar-header {
      font-weight: bold;
      margin-bottom: 5px;
    }
    .calendar-controls {
      display: flex;
      align-items: center;
      gap: 10px;
      color: #666;
      font-size: 14px;
      margin-bottom: 8px;
    }
    .calendar-controls span {
      cursor: pointer;
    }
    .calendar-grid {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      text-align: center;
      font-size: 14px;
      gap: 4px;
    }
    .calendar-grid-wrapper {
      max-width: 280px;
    }
    .calendar-grid div {
      height: 30px;
      line-height: 30px;
    }
    .calendar-date {
      border-radius: 50%;
      width: 20px;
      height: 32px;
      line-height: 32px;
      margin: auto;
      transition: 0.2s;
      cursor: pointer;
    }
    .calendar-date.selected {
      background-color: #00bfff;
      color: white;
      font-weight: bold;
    }
    .custom-time {
      color: #888;
      font-size: 14px;
      margin-top: 10px;
      text-align: right;
      cursor: pointer;
    }
    .time-options {
      display: flex;
      gap: 10px;
      margin-top: 10px;
    }
    .time-option {
      flex: 1;
      padding: 10px;
      text-align: center;
      border: 1px solid #ccc;
      border-radius: 20px;
      cursor: pointer;
    }
    .time-option.selected {
      background-color: #00bfff;
      color: white;
      border-color: #00bfff;
    }
    .custom-time-options {
      animation: fadeIn 0.3s ease;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(8px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .payment-image {
      display: block;
      width: 100%;
      max-width: 250px;
      margin: 10px auto;
      border-radius: 12px;
    }
    .summary {
      font-size: 15px;
    }
    .summary div {
      display: flex;
      justify-content: space-between;
      margin-bottom: 8px;
    }
    .total {
      font-weight: bold;
      font-size: 17px;
    }
    .place-order-btn {
      width: 100%;
      padding: 14px;
      background-color: #00bfff;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      box-shadow: 0 4px 0 #039be5;
    }
    .place-order-btn:hover {
  background-color: #039be5;
    }

  </style>
</head>
<body>
<div class="checkout-container">
  <div class="checkout-header">
    <span class="checkout-title">Checkout</span>
    <a href="view_cart.php" class="back-arrow">←</a>
  </div>
  <form method="POST">
    <div class="address-section">
      <p><strong>Delivery Address</strong> <a href="#" style="float:right; color:black;">Change</a></p>
      <p>Valencia City<br>P-6 Laligan, Valencia City, Bukidnon.</p>
      <p><strong>09062541381</strong></p>
    </div>

    <div class="delivery-options">
      <label class="delivery-option selected">
        <div class="delivery-label-text">Standard<small>10–20 Min</small></div>
        <div class="radio-circle"></div>
        <input type="radio" name="delivery" value="Standard (10-20 Min)" checked>
      </label>
      <label class="delivery-option">
        <div class="delivery-label-text">Schedule Ahead<small>Choose Your Time</small></div>
        <div class="radio-circle"></div>
        <input type="radio" name="delivery" value="Schedule Ahead">
      </label>
    </div>

    <div class="schedule-section" id="scheduleSection">
      <div class="calendar-header">Date</div>
      <div class="calendar-controls">
        <span id="prevMonth">◀</span>
        <span id="currentMonth">May 6, 2025</span>
        <span id="nextMonth">▶</span>
      </div>

      <div class="calendar-grid-wrapper">
        <div class="calendar-grid">
          <div>S</div><div>M</div><div>T</div><div>W</div><div>T</div><div>F</div><div>S</div>
        </div>
        <div class="calendar-grid" id="calendarBody"></div>
      </div>

      <div class="calendar-header" style="margin-top: 15px;">Time</div>

      <!-- Default Time Options -->
      <div class="time-options" id="defaultTimeOptions">
        <div class="time-option selected" data-value="8:00 AM">8:00am</div>
        <div class="time-option" data-value="12:00 PM">12:00pm</div>
        <div class="time-option" data-value="1:00 PM">1:00pm</div>
      </div>

      <!-- + Custom Time Link -->
      <div class="custom-time" id="customTimeTrigger">+ Custom Time</div>

      <!-- Custom Time Options -->
      <div class="custom-time-options" id="customTimeOptions" style="display: none;">
        <div class="time-options">
          <div class="time-option" data-value="13:00">13:00</div>
          <div class="time-option" data-value="15:45">15:45</div>
          <div class="time-option" data-value="18:50">18:50</div>
        </div>
      </div>

      <!-- Hidden Inputs -->
      <input type="hidden" name="schedule_date" id="scheduleDateInput" value="2025-05-06">
      <input type="hidden" name="schedule_time" id="scheduleTimeInput" value="8:00 AM">
    </div>

    <div class="payment-section">
      <p><strong>Payment</strong></p>
      <img src="img/cash.png" alt="Cash on Delivery" class="payment-image">
      <input type="hidden" name="payment_method" value="Cash on Delivery">
    </div>

    <div class="summary-section">
      <div class="summary">
        <div><span>Sub Total</span><span>₱150</span></div>
        <div><span>Delivery fee</span><span>₱5(10)</span></div>
        <div class="total"><span>Total</span><span>₱200</span></div>
      </div>
      <input type="hidden" name="subtotal" value="150">
      <input type="hidden" name="delivery_fee" value="5">
      <input type="hidden" name="total" value="200">
      <input type="hidden" name="address" value="P-6 Laligan, Valencia City, Bukidnon.">
      <input type="hidden" name="contact" value="09062541381">
    </div>
    <button type="submit" class="place-order-btn">Place Order</button>
  </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const options = document.querySelectorAll('.delivery-option');
  const scheduleSection = document.getElementById('scheduleSection');
  const timeInput = document.getElementById('scheduleTimeInput');
  const timeButtons = document.querySelectorAll('.time-option');

  options.forEach(option => {
    option.addEventListener('click', () => {
      options.forEach(o => o.classList.remove('selected'));
      option.classList.add('selected');
      option.querySelector('input').checked = true;
      scheduleSection.style.display = option.textContent.includes('Schedule Ahead') ? 'block' : 'none';
    });
  });

  timeButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.time-option').forEach(b => b.classList.remove('selected'));
      btn.classList.add('selected');
      timeInput.value = btn.dataset.value;
    });
  });

  // Custom time toggle
  const customTimeTrigger = document.getElementById('customTimeTrigger');
  const defaultTimeOptions = document.getElementById('defaultTimeOptions');
  const customTimeOptions = document.getElementById('customTimeOptions');

  customTimeTrigger.addEventListener('click', () => {
    defaultTimeOptions.style.display = 'none';
    customTimeOptions.style.display = 'block';
  });

  // Calendar
  const calendarBody = document.getElementById("calendarBody");
  const currentMonthLabel = document.getElementById("currentMonth");
  const scheduleDateInput = document.getElementById("scheduleDateInput");
  const prevBtn = document.getElementById("prevMonth");
  const nextBtn = document.getElementById("nextMonth");

  let selectedDate = new Date(2025, 4, 6);
  let currentMonth = 4;
  let currentYear = 2025;

  function renderCalendar(month, year) {
    calendarBody.innerHTML = "";
    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const prevMonthDays = new Date(year, month, 0).getDate();
    const totalCells = Math.ceil((firstDay + daysInMonth) / 7) * 7;

    currentMonthLabel.textContent = new Date(year, month, 6).toLocaleDateString("en-US", {
      month: "long",
      day: "numeric",
      year: "numeric"
    });

    for (let i = 0; i < totalCells; i++) {
      const dayNum = i - firstDay + 1;
      const cell = document.createElement("div");

      if (i < firstDay) {
        cell.textContent = prevMonthDays - firstDay + i + 1;
        cell.style.color = "#ccc";
      } else if (dayNum > daysInMonth) {
        cell.textContent = dayNum - daysInMonth;
        cell.style.color = "#ccc";
      } else {
        const cellDate = new Date(year, month, dayNum);
        const iso = cellDate.toISOString().split("T")[0];
        cell.textContent = dayNum;
        cell.classList.add("calendar-date");
        cell.dataset.date = iso;

        if (
          selectedDate.getDate() === dayNum &&
          selectedDate.getMonth() === month &&
          selectedDate.getFullYear() === year
        ) {
          cell.classList.add("selected");
        }

        cell.addEventListener("click", () => {
          document.querySelectorAll(".calendar-date").forEach(d => d.classList.remove("selected"));
          cell.classList.add("selected");
          selectedDate = cellDate;
          scheduleDateInput.value = iso;
        });
      }

      cell.style.borderRadius = "50%";
      cell.style.width = "20px";
      cell.style.height = "32px";
      cell.style.lineHeight = "32px";
      cell.style.margin = "auto";
      cell.style.cursor = "pointer";

      calendarBody.appendChild(cell);
    }

    scheduleDateInput.value = selectedDate.toISOString().split("T")[0];
  }

  prevBtn.addEventListener("click", () => {
    currentMonth--;
    if (currentMonth < 0) {
      currentMonth = 11;
      currentYear--;
    }
    renderCalendar(currentMonth, currentYear);
  });

  nextBtn.addEventListener("click", () => {
    currentMonth++;
    if (currentMonth > 11) {
      currentMonth = 0;
      currentYear++;
    }
    renderCalendar(currentMonth, currentYear);
  });

  renderCalendar(currentMonth, currentYear);
});
</script>
</body>
</html>
