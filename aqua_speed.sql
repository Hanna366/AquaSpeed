-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 21, 2025 at 02:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aqua_speed`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(15) NOT NULL,
  `delivery_option` varchar(50) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `delivery_fee` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `order_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `schedule_date` date DEFAULT NULL,
  `schedule_time` varchar(20) DEFAULT NULL,
  `order_status` varchar(50) DEFAULT 'Order Made',
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `address`, `contact`, `delivery_option`, `subtotal`, `delivery_fee`, `total`, `payment_method`, `order_time`, `schedule_date`, `schedule_time`, `order_status`, `user_id`, `product_id`) VALUES
(1, 'P-6 Lalligan, Valencia City, Bukidnon.', '09062541381', 'Standard 10-20 Min', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-06 00:57:39', NULL, NULL, 'Order Made', 1, NULL),
(2, 'P-6 Laligan, Valencia City, Bukidnon', '09062541381', 'Standard (10-20 Min)', 150.00, 50.00, 200.00, 'Cash on Delivery', '2025-05-06 05:33:27', NULL, NULL, 'Order Made', 1, NULL),
(3, 'P-6 Laligan, Valencia City, Bukidnon', '09062541381', 'Standard (10-20 Min)', 150.00, 50.00, 200.00, 'Cash on Delivery', '2025-05-06 06:09:46', NULL, NULL, 'Order Made', 1, NULL),
(4, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Standard (10-20 Min)', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-06 06:29:49', NULL, NULL, 'Order Made', 1, NULL),
(5, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Standard (10-20 Min)', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-10 02:12:15', '2025-05-05', '8:00 AM', 'Order Made', 1, NULL),
(6, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Schedule Ahead', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-10 02:13:45', '2025-05-05', '8:00 AM', 'Order Made', 1, NULL),
(7, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Standard (10-20 Min)', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-10 02:15:38', '2025-05-05', '8:00 AM', '4', 1, NULL),
(8, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Schedule Ahead', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-10 03:40:25', '2025-05-12', '15:45', 'Order Made', 1, NULL),
(9, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Schedule Ahead', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-10 13:27:50', '2025-05-05', '13:00', 'Order Made', 1, NULL),
(10, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Standard (10-20 Min)', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-10 13:28:58', '2025-05-05', '8:00 AM', 'Order Made', 1, NULL),
(11, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Standard (10-20 Min)', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-10 13:29:07', '2025-05-05', '8:00 AM', 'Order Made', 1, NULL),
(12, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Standard (10-20 Min)', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-10 13:38:57', '2025-05-05', '8:00 AM', 'Order Made', 1, NULL),
(13, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Standard (10-20 Min)', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-10 15:19:34', '2025-05-05', '8:00 AM', 'Order Made', 1, NULL),
(14, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Standard (10-20 Min)', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-10 16:09:20', '2025-05-05', '8:00 AM', '3', 1, NULL),
(15, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Schedule Ahead', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-11 00:57:25', '2025-05-05', '8:00 AM', 'Order Made', 1, NULL),
(16, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Standard (10-20 Min)', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-11 00:57:40', '2025-05-05', '8:00 AM', 'Order Made', 1, NULL),
(17, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Schedule Ahead', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-13 12:17:31', '2025-05-05', '8:00 AM', 'Order Made', 1, NULL),
(18, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Standard (10-20 Min)', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-14 14:29:18', '2025-05-05', '8:00 AM', 'Order Made', 1, NULL),
(19, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Standard (10-20 Min)', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-14 14:36:17', '2025-05-05', '8:00 AM', 'Order Made', 1, NULL),
(20, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Standard (10-20 Min)', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-16 05:45:43', '2025-05-05', '8:00 AM', 'Order Made', 1, NULL),
(21, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Standard (10-20 Min)', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-16 07:15:49', '2025-05-05', '8:00 AM', 'Order Made', 1, NULL),
(22, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Standard (10-20 Min)', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-16 08:04:39', '2025-05-05', '8:00 AM', 'Order Made', 1, NULL),
(23, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Standard (10-20 Min)', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-16 09:34:25', '2025-05-05', '8:00 AM', 'Order Made', 1, NULL),
(24, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Schedule Ahead', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-16 10:31:14', '2025-05-05', '8:00 AM', 'Order Made', 1, NULL),
(25, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Standard (10-20 Min)', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-16 10:31:24', '2025-05-05', '8:00 AM', 'Order Made', 1, NULL),
(26, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Standard (10-20 Min)', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-16 12:48:13', '2025-05-05', '8:00 AM', 'Order Made', 1, NULL),
(27, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Schedule Ahead', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-18 04:07:20', '2025-05-05', '8:00 AM', 'Order Made', 1, NULL),
(28, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Standard (10-20 Min)', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-18 08:06:21', '2025-05-05', '8:00 AM', 'Order Made', 1, NULL),
(29, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Standard (10-20 Min)', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-18 14:27:42', '2025-05-05', '8:00 AM', 'Order Made', 1, NULL),
(30, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Standard (10-20 Min)', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-19 02:11:41', '2025-05-05', '8:00 AM', 'Order Made', 1, NULL),
(31, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Standard (10-20 Min)', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-19 02:48:52', '2025-05-05', '8:00 AM', 'Order Made', 1, NULL),
(32, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Schedule Ahead', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-19 02:51:15', '2025-05-05', '12:00 PM', 'Order Made', 1, NULL),
(33, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Standard (10-20 Min)', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-19 03:00:02', '2025-05-05', '8:00 AM', 'Order Made', 1, NULL),
(34, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Standard (10-20 Min)', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-19 04:18:19', '2025-05-05', '8:00 AM', 'Order Made', 1, NULL),
(35, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Schedule Ahead', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-19 04:57:56', '2025-05-13', '12:00 PM', 'Order Made', 1, NULL),
(36, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Standard (10-20 Min)', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-19 04:58:42', '2025-05-05', '8:00 AM', 'Order Made', 1, NULL),
(37, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Standard (10-20 Min)', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-19 05:26:29', '2025-05-05', '8:00 AM', 'Order Made', NULL, NULL),
(38, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Schedule Ahead', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-19 06:59:18', '2025-05-22', '12:00 PM', 'Order Made', NULL, NULL),
(39, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Schedule Ahead', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-19 07:22:35', '2025-04-30', '1:00 PM', 'Order Made', NULL, NULL),
(40, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Standard (10-20 Min)', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-19 09:42:41', '2025-05-05', '8:00 AM', 'Order Made', NULL, NULL),
(41, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Schedule Ahead', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-19 10:16:19', '2025-05-13', '12:00 PM', 'Order Made', NULL, NULL),
(42, 'P-6 Laligan, Valencia City, Bukidnon.', '09062541381', 'Schedule Ahead', 150.00, 5.00, 200.00, 'Cash on Delivery', '2025-05-19 10:18:30', '2025-05-05', '12:00 PM', 'Order Made', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 2, 3, 150.00),
(2, 1, 1, 1, 75.00),
(3, 2, 2, 1, 150.00);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `size_options` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `size_options`, `stock`) VALUES
(1, '10 Gallons and more', 'Order 10 gallons and up to get 5 pesos discount each. A freshly and cleaned refilled water gallons.', 15.00, 'gal.jpeg', '1Gallon,5Gallon', 100),
(2, 'Emergency Gallon Order', 'Note: Delivery will charge 10 for every emergency gallon delivery.', 20.00, 'lons.png', '1Gallon', 50),
(3, 'New Gallon with Water', 'Includes a brand new gallon filled with clean drinking water.', 150.00, 'gallon.jpeg', '1Gallon', 20),
(4, 'Below 10 Gallons', 'For orders less than 10 gallons. Regular rate applies per gallon.', 20.00, 'one.jpeg', '1Gallon,5Gallon', 50),
(5, '500mL Water', 'Convenient 500mL bottled water for personal hydration.', 10.00, 'bottle.jpeg', '500ml', 100);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `rating`, `comment`, `order_id`, `created_at`, `user_id`) VALUES
(1, 'Hanna Ares', 5, 'very nice ', 1426, '2025-05-16 21:36:01', NULL),
(2, 'anya', 4, 'nice quality', 1426, '2025-05-16 21:36:27', NULL),
(3, 'anya', 4, 'nice quality', 1426, '2025-05-16 21:46:15', NULL),
(4, 'Jenny Kim', 5, 'nice service quality', 1426, '2025-05-16 21:47:05', NULL),
(5, 'Jenny Kim', 5, 'nice service quality', 1426, '2025-05-16 21:58:31', 1),
(6, 'Lara Jayne', 5, 'nice service quality', 1426, '2025-05-16 21:58:45', 1),
(7, 'Lara Jayne', 5, 'nice service quality', 1426, '2025-05-16 22:30:11', NULL),
(8, 'Hanna Ares', 5, 'nice quality', 1426, '2025-05-16 23:24:28', NULL),
(9, 'Hanna Ares', 5, 'nice quality', 1426, '2025-05-16 23:46:20', NULL),
(10, 'Hanna Ares', 5, 'nice quality', 1426, '2025-05-16 23:46:47', NULL),
(11, 'Hanna Ares', 5, 'nice quality', 1426, '2025-05-16 23:47:39', NULL),
(12, 'Hanna Ares', 5, 'nice quality', 1426, '2025-05-16 23:47:58', NULL),
(13, 'Hanna Ares', 5, 'nice quality', 1426, '2025-05-16 23:50:15', NULL),
(14, 'Hanna Ares', 5, 'nice quality', 1426, '2025-05-16 23:51:22', NULL),
(15, 'Hanna Ares', 5, 'nice quality', 1426, '2025-05-16 23:52:28', NULL),
(16, 'Hanna Ares', 5, 'nice quality', 1426, '2025-05-16 23:53:02', NULL),
(17, 'Katrina Ares', 5, 'fast delivery', 1427, '2025-05-18 12:07:45', NULL),
(18, 'loreta', 5, 'Fast Delivery', 1430, '2025-05-19 10:12:08', NULL),
(19, 'Lara Ayco', 4, 'Not fast enough', 1435, '2025-05-19 12:58:23', NULL),
(20, 'Yanna', 5, 'The quality is giving', 1439, '2025-05-19 15:23:03', NULL),
(21, 'Lara ', 5, 'Fast Delivery ', 1441, '2025-05-19 18:16:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(20) DEFAULT 'user',
  `address` text DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `role`, `address`, `contact`) VALUES
(1, 'Hanna Ares', '2301111318@student.buksu.edu.ph', '$2y$10$4LbDJdIvPZVINYmgRIrDZeU8Ew8twLJEutM.ebnJ/lMJOAJGX1AAO', '2025-05-02 09:41:00', 'user', 'Purok Vanda Sta Fe Libona Bukidnon', '09531089791');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_user` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_password_user` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reviews_user` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `fk_password_user` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_reviews_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
