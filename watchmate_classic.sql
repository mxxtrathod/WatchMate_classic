-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2025 at 02:08 PM
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
-- Database: `watchmate_classic`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address_line1` varchar(255) NOT NULL,
  `address_line2` varchar(255) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `shipping` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_email`, `full_name`, `phone`, `address_line1`, `address_line2`, `city`, `state`, `zip`, `country`, `subtotal`, `shipping`, `total`, `created_at`, `status`) VALUES
(1, 'abc@abc.com', 'meet', '9316666919', 'abc charnbia', 'creoss', 'surat', 'gurjart', '392166', 'India', 1000.00, 10.00, 1010.00, '2025-09-24 07:36:41', 'Delivered'),
(2, 'xyz@xyz.com', 'xyz', '966556656', 'demo', 'demo', 'surat', 'gujarat', '200010', 'India', 1450.00, 10.00, 1460.00, '2025-09-24 07:44:26', 'Delivered'),
(3, 'smit@gmail.com', 'smit', '1010101010', '1103 kiran arcade', 'near D-mart , kosad , amroli', 'surat', 'gujarat', '394107', 'India', 5350.00, 10.00, 5360.00, '2025-09-24 09:22:06', 'Delivered'),
(4, 'meet@gmail.com', 'Meet rathod', '931666666', 'demo', 'demo', 'surat', 'gujarat', '394017', 'India', 1360.00, 10.00, 1370.00, '2025-09-27 06:45:15', 'Cancelled'),
(5, 'parth@gmail.com', 'Parth', '000000000', 'demo', 'demo', 'surat', 'Gujarat', '394107', 'India', 1450.00, 10.00, 1460.00, '2025-09-27 07:51:57', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `watch_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `watch_id`, `title`, `price`, `quantity`) VALUES
(1, 1, 7, 'Titan | Steel Watch Mens', 1000.00, 1),
(2, 2, 8, 'Titan | Gold Plated Watch ', 1450.00, 1),
(3, 3, 8, 'Titan | Gold Plated Watch ', 1450.00, 3),
(4, 3, 9, 'Tommy Hilfiger', 500.00, 2),
(5, 4, 4, 'Titan | Black Edition', 680.00, 2),
(6, 5, 8, 'Titan | Gold Plated Watch ', 1450.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `confirm_pass` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`name`, `email`, `password`, `confirm_pass`) VALUES
('abc ', 'abc@abc.com', '123', '123'),
('meet', 'meet@gmail.com', 'meet123', 'meet123'),
('Meet Rathod ', 'meet@test.com', '0018', '0018'),
('parth', 'parth@gmail.com', '123', '123'),
('raj', 'raj@gmail.com', '1818', '1818'),
('Smit ', 'smit@gmail.com', 'smit123', 'smit123'),
('xyz', 'xyz@xyz.com', '123', '123');

-- --------------------------------------------------------

--
-- Table structure for table `watches`
--

CREATE TABLE `watches` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `watches`
--

INSERT INTO `watches` (`id`, `image`, `title`, `description`, `price`) VALUES
(1, '1805QM01_1.webp', 'Titan | Mens Classic Watch', 'Titan Mens Classic Dial With Blue Stainless Steel Strap Watch For Men With Premium Look on Hand', '599'),
(2, '1733KL03_1.webp', 'Titan | Classic Edition Men', 'Titan Karishma Quartz Analog Dial  Stainless Steel Strap Watch For Men', '780'),
(3, '1638SM02_1.webp', 'Titan | Mens Watch', 'Titan Karishma Analog Dial Silver Stainless Steel Watch For Men', '970'),
(4, '1803NM01_1.webp', 'Titan | Black Edition', 'Titan Karishma Black Dial Stainless Steel Classic Watch For Men', '680'),
(5, '1805NM01_1.webp', 'Titan | Full Black Watch', 'Titan Quartz Analog Black Dial Stainless Steel Watch For Men', '999'),
(6, '1825KM02_1.webp', 'Titan | Silver Edition Watch', 'Titan Full Stainless Steel Silver Code Watch For Men', '1100'),
(7, '1638SM02_1.webp', 'Titan | Steel Watch Mens', 'Titan Analog Stainless Steel Watch With Blue Dial ', '1000'),
(8, '1644YM05_1.webp', 'Titan | Gold Plated Watch ', 'Titan Men\'s Gold Dial Analog Watch Classic Edition', '1450'),
(9, 'TH1792079_1.webp', 'Tommy Hilfiger', 'Tommy Hilfiger Quartz Multifunction Green dial Stainless Steel Strap Watch for Men', '500'),
(10, 'PLPEWJK0021805_1.webp', 'Police classic Watch', 'Police silver analog with classic dial watch for mens', '590');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `watches`
--
ALTER TABLE `watches`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `watches`
--
ALTER TABLE `watches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
