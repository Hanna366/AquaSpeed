# 💧 AquaSpeed – Water Delivery System

AquaSpeed is a PHP and MySQL-based water delivery web application designed for customers to place orders and manage water deliveries online. It features user login/signup, Google login integration, admin management, and order tracking.

---

## 📁 System Installation / Setup Guide

Follow these steps to install and run the AquaSpeed system locally:

### 🔧 Prerequisites:
- XAMPP (Apache & MySQL)
- PHP 8.x
- Composer
- Web browser (Chrome, Firefox, etc.)

---

### ✅ Steps to Run the System Locally:

1. **Open XAMPP Control Panel**
   - Start **Apache** and **MySQL**

2. **Copy Source Code**
   - Place the `AquaSpeed` folder in your XAMPP `htdocs` directory:
     ```
     C:\xampp\htdocs\AquaSpeed
     ```

3. **Import the Database**
   - Go to your browser and open:
     ```
     http://localhost/phpmyadmin
     ```
   - Create a new database:
     ```
     aqua_speed
     ```
   - Import the provided SQL file:
     ```
     aqua_speed.sql (located in the root of AquaSpeed folder)
     ```

4. **Install Dependencies**
   - Open terminal or Git Bash inside the `AquaSpeed` folder and run:
     ```
     composer install
     ```

5. **Run the System**
   - Open your browser and visit:
     ```
     http://localhost/AquaSpeed/
     ```
