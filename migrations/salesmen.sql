-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2017 at 05:29 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `star8_develop`
--

-- --------------------------------------------------------

--
-- Table structure for table `salesmen`
--

DROP TABLE IF EXISTS `salesmen`;
CREATE TABLE `salesmen` (
  `sales_id` int(11) NOT NULL COMMENT 'PRIMARY',
  `sales_fname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sales_lname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sales_contactno` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sales_email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `salesmen`
--

INSERT INTO `salesmen` (`sales_id`, `sales_fname`, `sales_lname`, `sales_contactno`, `sales_email`, `created_at`, `updated_at`) VALUES
(1, 'Dennis', 'de Leon', '354-2263', 'hexxableyd@gmail.com', '2017-05-29 16:59:52', '2017-05-29 17:31:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `salesmen`
--
ALTER TABLE `salesmen`
  ADD PRIMARY KEY (`sales_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `salesmen`
--
ALTER TABLE `salesmen`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY', AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
