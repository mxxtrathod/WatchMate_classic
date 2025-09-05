-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2025 at 07:58 AM
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
(1, '1805QM01_1.webp', 'Titan | Mens Classic Watch', 'Titan Mens Classic Dial With Blue Stainless Steel Strap Watch For Men With Premium Look on Hand', '699'),
(2, '1733KL03_1.webp', 'Titan | Classic Edition Men', 'Titan Karishma Quartz Analog Dial  Stainless Steel Strap Watch For Men', '780'),
(3, '1638SM02_1.webp', 'Titan | Mens Watch', 'Titan Karishma Analog Dial Silver Stainless Steel Watch For Men', '970'),
(4, '1803NM01_1.webp', 'Titan | Black Edition', 'Titan Karishma Black Dial Stainless Steel Classic Watch For Men', '680'),
(5, '1805NM01_1.webp', 'Titan | Full Black Watch', 'Titan Quartz Analog Black Dial Stainless Steel Watch For Men', '999'),
(6, '1825KM02_1.webp', 'Titan | Silver Edition Watch', 'Titan Full Stainless Steel Silver Code Watch For Men', '1100'),
(7, '1638SM02_1.webp', 'Titan | Steel Watch Mens', 'Titan Analog Stainless Steel Watch With Blue Dial ', '1000'),
(8, '1644YM05_1.webp', 'Titan | Gold Plated Watch ', 'Titan Men\'s Gold Dial Analog Watch Classic Edition', '1450'),
(9, 'TH1792079_1.webp', 'Tommy Hilfiger', 'Tommy Hilfiger Quartz Multifunction Green dial Stainless Steel Strap Watch for Men', '500');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `watches`
--
ALTER TABLE `watches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
