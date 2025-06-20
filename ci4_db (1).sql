-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2025 at 06:18 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci4_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guitars`
--

CREATE TABLE `guitars` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `brand` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guitars`
--

INSERT INTO `guitars` (`id`, `name`, `description`, `price`, `stock`, `brand`, `type`, `image`) VALUES
(15, 'Classic Vibe Telecaster', 'Very Good sounding guitar', 80000.00, 3, 'Fender', 'Telecaster', '1750309160_dec3de9281a97f5e436b.png'),
(16, 'Player II Telecaster', 'Very good sounding guitar', 50000.00, 5, 'Fender', 'Telecaster', '1750310169_ad485379f521f448850e.png');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-06-18-145514', 'App\\Database\\Migrations\\AddCheckoutDetailsToOrdersMigration', 'default', 'App', 1750258532, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `guitar_name` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('Pending','Paid','Shipped') DEFAULT 'Pending',
  `fullname` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `guitar_name`, `quantity`, `total_price`, `status`, `fullname`, `address`, `phone`) VALUES
(3, 9, NULL, 'Cory Wong Vintage', 1, 168000.00, 'Shipped', 'Peter', 'wahahahaha', '09193549990'),
(4, 9, NULL, 'Redondo Player Guitar', 1, 350000.00, 'Shipped', 'Peter', 'wahahahaha', '09193549990'),
(5, 9, NULL, 'Redondo Player Guitar', 1, 350000.00, 'Shipped', 'Daniel', 'dfasdfaf', '0302039209'),
(6, 9, NULL, 'Redondo Player Guitar', 2, 4700000.00, 'Shipped', 'Vivi', 'Taga dyan lang ya', '091935900009'),
(7, 10, NULL, 'Classic Vibe Telecaster', 1, 350000.00, 'Shipped', 'Chuu Vy', 'Loona Moon', '012939123912'),
(8, 9, NULL, 'Redondo Player Guitar', 1, 2350000.00, 'Shipped', 'Mae Abella', '123 Manila', '09293923092'),
(9, 11, NULL, 'Cory Wong Vintage', 1, 168000.00, 'Shipped', 'Jhoseph Familara', '123 QC', '09192839239'),
(10, 11, NULL, 'Contemporary Jazzmaster', 1, 2350000.00, 'Shipped', 'Jopet Familara', '123 Montalban', '0919239293019'),
(11, 11, NULL, 'Player II Telecaster', 2, 336000.00, 'Shipped', 'Jopet Familara', '123 QC', '09192839239');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `role` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `updated_at`, `role`) VALUES
(1, 'pete1', 'pete1@gmail.com', '$2y$10$AtIvLcZ1eARyn8RAUrOUfec6ruhlN50AHavjVMrvrRXhsiN/MseQu', '2025-05-09 20:00:46', '2025-06-18 22:12:03', 'admin'),
(5, 'terminalassesment1', 'terminalassesment1@gmail.com', '$2y$10$66Oe/SdMPQfNUdR8a/6DWeqfyhNfMVn5jtJlVzjz8zaiSaPIUwhme', '2025-05-09 22:14:42', '2025-06-19 05:16:58', 'admin'),
(6, 'admin1', 'admin1@gmail.com', '$2y$10$YOfQJqL9jto10P6IktI.0ePAiGBzdRaYt/8mjyJlkwDa2FtGI.xya', '2025-05-10 02:56:14', '2025-05-10 02:56:14', 'user'),
(7, 'peter03', 'peter03@gmail.com', '$2y$10$GW4YPtAkVsZl1hI6W3njx.WTt7ZU72QE1EVUkg7YlbcY4C7yofYPO', '2025-06-07 02:59:20', '2025-06-07 02:59:20', 'user'),
(8, 'admin3', 'admin3@gmail.com', '$2y$10$T86wwkQlV6Vt/YiC3Cc4pOa.sW0nld.zEM1PBSQ7GPHhW5oQrfAxe', '2025-06-18 14:15:27', '2025-06-18 22:16:15', 'admin'),
(9, 'peter03', 'peterpogi@gmail.com', '$2y$10$OnFC1zkwaul2L.3IIpYg3OI3jfB47yRIsgltyQyGEny2wLSszk7pK', '2025-06-18 14:17:04', '2025-06-18 14:17:04', 'user'),
(10, 'Chuu Vy', 'chuuvy@gmail.com', '$2y$10$7yWDjiGQFRGMqZHZdL39LeYVvlgGM5Oyl6CRJdRNgvt4URMQiSgbi', '2025-06-18 15:37:58', '2025-06-18 15:37:58', 'user'),
(11, 'Jhoseph Familara', 'jopet03@gmail.com', '$2y$10$TrI22XLa.Yvtf8ZHFYJVf.V7vkzMZSVRL7H1qRUXt5PjBiENCIGtq', '2025-06-19 05:11:33', '2025-06-19 05:11:33', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `guitars`
--
ALTER TABLE `guitars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `orders_ibfk_2` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guitars`
--
ALTER TABLE `guitars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `guitars` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
