-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2017 at 11:05 AM
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
CREATE DATABASE IF NOT EXISTS `star8_develop` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;
USE `star8_develop`;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `city_id` int(11) NOT NULL COMMENT 'PRIMARY',
  `region_id` int(11) NOT NULL COMMENT 'FOREIGN',
  `city_name` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_id`, `region_id`, `city_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Manila City', '2017-05-08 11:31:21', '2017-05-09 07:44:16'),
(2, 1, 'Caloocan City', '2017-05-08 11:41:37', '2017-05-08 11:41:37'),
(3, 1, 'Las Piñas City', '2017-05-08 11:43:00', '2017-05-08 11:43:00'),
(4, 1, 'Makati City', '2017-05-08 11:43:21', '2017-05-08 11:43:21'),
(5, 1, 'Malabon City', '2017-05-08 11:43:31', '2017-05-08 11:43:31'),
(6, 1, 'Mandaluyong City', '2017-05-08 11:43:41', '2017-05-08 11:43:41'),
(7, 1, 'Marikina City', '2017-05-08 11:45:02', '2017-05-08 11:45:02'),
(8, 1, 'Muntinlupa City', '2017-05-08 11:45:11', '2017-05-08 11:45:11'),
(9, 1, 'Navotas City', '2017-05-08 11:45:44', '2017-05-08 11:45:44'),
(10, 1, 'Parañaque City', '2017-05-08 11:46:47', '2017-05-08 11:46:47'),
(11, 1, 'Pasay City', '2017-05-08 11:46:58', '2017-05-08 11:46:58'),
(12, 1, 'Pasig City', '2017-05-08 11:47:09', '2017-05-08 11:47:09'),
(13, 1, 'Quezon City', '2017-05-08 11:47:46', '2017-05-08 11:47:46'),
(14, 1, 'San Juan City', '2017-05-08 11:47:58', '2017-05-08 11:47:58'),
(15, 1, 'Taguig City', '2017-05-08 11:48:06', '2017-05-08 11:48:06'),
(16, 1, 'Valenzuela City', '2017-05-08 11:48:20', '2017-05-08 11:48:20'),
(17, 2, 'Alaminos City', '2017-05-08 12:11:11', '2017-05-08 12:11:11'),
(18, 2, 'Batac City', '2017-05-08 12:11:37', '2017-05-08 12:11:37'),
(19, 2, 'Candon City', '2017-05-08 12:12:29', '2017-05-08 12:12:29'),
(20, 2, 'Dagupan City', '2017-05-08 12:12:46', '2017-05-08 12:12:46'),
(21, 2, 'Laoag City', '2017-05-08 12:13:01', '2017-05-08 12:13:01'),
(22, 2, 'San Carlos City', '2017-05-08 12:13:20', '2017-05-08 12:13:20'),
(23, 2, 'San Fernando City', '2017-05-08 12:13:39', '2017-05-08 12:13:39'),
(24, 2, 'Urdaneta City', '2017-05-08 12:13:57', '2017-05-08 12:13:57'),
(25, 2, 'Vigan City', '2017-05-08 12:14:07', '2017-05-08 12:14:07'),
(30, 3, 'Kalinga', '2017-05-08 12:19:55', '2017-05-08 12:19:55'),
(32, 3, 'Baguio City', '2017-05-08 12:20:36', '2017-05-08 12:20:36'),
(33, 4, 'Isabela City', '2017-05-08 12:21:47', '2017-05-08 12:21:47'),
(34, 4, 'Ilagan City', '2017-05-08 12:22:40', '2017-05-08 12:22:40'),
(35, 4, 'Santiago City', '2017-05-08 12:22:51', '2017-05-08 12:22:51'),
(36, 4, 'Tuguegarao City', '2017-05-08 12:23:14', '2017-05-08 12:23:14'),
(59, 5, 'Balanga City', '2017-05-08 12:52:54', '2017-05-08 12:52:54'),
(60, 5, 'Malolos City', '2017-05-08 12:53:12', '2017-05-08 12:53:12'),
(61, 5, 'Meycauayan City', '2017-05-08 12:53:27', '2017-05-08 12:53:27'),
(62, 5, 'San Jose del Monte', '2017-05-08 12:53:59', '2017-05-08 12:53:59'),
(63, 5, 'Cabanatuan City', '2017-05-08 12:54:16', '2017-05-08 12:54:16'),
(64, 5, 'Gapan City', '2017-05-08 12:54:27', '2017-05-08 12:54:27'),
(65, 5, 'Muñoz City', '2017-05-08 12:54:45', '2017-05-08 12:54:45'),
(66, 5, 'Palayan City', '2017-05-08 12:54:57', '2017-05-08 12:54:57'),
(67, 5, 'San Jose City', '2017-05-08 12:55:13', '2017-05-08 12:55:13'),
(68, 5, 'Angeles City', '2017-05-08 12:55:31', '2017-05-08 12:55:31'),
(69, 5, 'Mabalacat City', '2017-05-08 12:55:44', '2017-05-08 12:55:44'),
(70, 5, 'San Fernando City', '2017-05-08 12:56:01', '2017-05-08 12:56:01'),
(71, 5, 'Tarlac City', '2017-05-08 12:56:13', '2017-05-08 12:56:13'),
(72, 5, 'Olongapo City', '2017-05-08 12:56:31', '2017-05-08 12:56:31'),
(73, 6, 'Antipolo City', '2017-05-08 12:58:29', '2017-05-08 12:58:29'),
(74, 6, 'Bacoor City', '2017-05-08 12:58:40', '2017-05-08 12:58:40'),
(75, 6, 'Batangas City', '2017-05-08 12:58:52', '2017-05-08 12:58:52'),
(76, 6, 'Biñan City', '2017-05-08 12:59:16', '2017-05-08 12:59:16'),
(77, 6, 'Cabuyao City', '2017-05-08 12:59:29', '2017-05-08 12:59:29'),
(78, 6, 'Calamba', '2017-05-08 12:59:47', '2017-05-08 12:59:47'),
(79, 6, 'Cavite City', '2017-05-08 12:59:59', '2017-05-08 12:59:59'),
(80, 6, 'Dasmariñas City', '2017-05-08 13:00:13', '2017-05-08 13:00:13'),
(81, 6, 'General Trias', '2017-05-08 13:00:25', '2017-05-08 13:00:25'),
(82, 6, 'Imus', '2017-05-08 13:00:35', '2017-05-08 13:00:35'),
(83, 6, 'Lipa City', '2017-05-08 13:00:47', '2017-05-08 13:00:47'),
(84, 6, 'Lucena City', '2017-05-08 13:00:56', '2017-05-08 13:00:56'),
(85, 6, 'San Pablo City', '2017-05-08 13:01:07', '2017-05-08 13:01:07'),
(86, 6, 'San Pedro City', '2017-05-08 13:01:21', '2017-05-08 13:01:21'),
(87, 6, 'Santa Rosa', '2017-05-08 13:01:36', '2017-05-08 13:01:36'),
(88, 6, 'Tagaytay City', '2017-05-08 13:01:47', '2017-05-08 13:01:47'),
(89, 6, 'Tanauan City', '2017-05-08 13:01:59', '2017-05-08 13:01:59'),
(90, 6, 'Tayabas City', '2017-05-08 13:02:08', '2017-05-08 13:02:08'),
(91, 6, 'Trece Martires', '2017-05-08 13:02:25', '2017-05-08 13:02:25'),
(92, 7, 'Calapan City', '2017-05-08 13:05:41', '2017-05-08 13:05:41'),
(93, 7, 'Puerto Princesa City', '2017-05-08 13:06:07', '2017-05-08 13:06:07'),
(94, 8, 'Iriga City', '2017-05-08 13:08:20', '2017-05-08 13:08:20'),
(95, 8, 'Legaspi City', '2017-05-08 13:08:34', '2017-05-08 13:08:34'),
(96, 8, 'Ligao City', '2017-05-08 13:08:45', '2017-05-08 13:08:45'),
(97, 8, 'Masbate City', '2017-05-08 13:08:59', '2017-05-08 13:08:59'),
(98, 8, 'Naga City', '2017-05-08 13:09:11', '2017-05-08 13:09:11'),
(99, 8, 'Sorsogon City', '2017-05-08 13:09:26', '2017-05-08 13:09:26'),
(100, 8, 'Tabaco City', '2017-05-08 13:09:45', '2017-05-08 13:09:45'),
(101, 9, 'Iloilo City', '2017-05-08 13:14:29', '2017-05-08 13:14:29'),
(102, 9, 'Passi', '2017-05-08 13:14:39', '2017-05-08 13:14:39'),
(103, 9, 'Roxas City', '2017-05-08 13:14:55', '2017-05-08 13:14:55');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

DROP TABLE IF EXISTS `regions`;
CREATE TABLE `regions` (
  `region_id` int(11) NOT NULL COMMENT 'PRIMARY',
  `region_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`region_id`, `region_name`, `created_at`, `updated_at`) VALUES
(1, 'National Capital Region (NCR)', '2017-05-08 10:33:59', '2017-05-08 10:41:39'),
(2, 'Region I : Ilocos Region', '2017-05-08 10:35:57', '2017-05-08 10:35:57'),
(3, 'Cordillera Administrative Region (CAR)', '2017-05-08 10:44:22', '2017-05-08 10:44:22'),
(4, 'Region II : Cagayan Valley', '2017-05-08 10:45:07', '2017-05-08 11:08:27'),
(5, 'Region III : Central Luzon', '2017-05-08 10:45:23', '2017-05-08 11:08:27'),
(6, 'Region IV-A : CALABARZON', '2017-05-08 11:06:13', '2017-05-08 11:06:13'),
(7, 'Region IV-B : MIMAROPA Region', '2017-05-08 11:07:57', '2017-05-08 11:07:57'),
(8, 'Region V : Bicol Region', '2017-05-08 11:09:03', '2017-05-08 11:09:03'),
(9, 'Region VI : Western Visayas', '2017-05-08 11:09:27', '2017-05-08 11:09:27'),
(10, 'Region VII : Central Visayas', '2017-05-08 11:10:31', '2017-05-08 11:10:31'),
(11, 'Region VIII : Eastern Visayas', '2017-05-08 11:10:47', '2017-05-08 11:10:47'),
(12, 'Region IX : Zamboanga Peninsula', '2017-05-08 11:11:26', '2017-05-08 11:11:26'),
(13, 'Region X : Northern Mindanao', '2017-05-08 11:11:51', '2017-05-08 11:11:51'),
(14, 'Region XI : Davao Region', '2017-05-08 11:12:22', '2017-05-08 11:12:22'),
(15, 'Region XII : SOCCKSKSARGEN', '2017-05-08 11:13:19', '2017-05-08 11:13:19'),
(16, 'Region XIII : CARAGA', '2017-05-08 11:13:35', '2017-05-08 11:13:35'),
(17, 'Autonomous Region in Muslim Mindanao (ARMM)', '2017-05-08 11:14:02', '2017-05-08 11:14:02');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

DROP TABLE IF EXISTS `routes`;
CREATE TABLE `routes` (
  `route_id` int(7) UNSIGNED NOT NULL COMMENT 'Route''s Id ( Primary )',
  `route_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Route''s Name',
  `route_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Route''s Description',
  `city_from` int(7) UNSIGNED NOT NULL COMMENT 'Id of first city ( Foreign )',
  `city_to` int(7) UNSIGNED NOT NULL COMMENT 'Id of second city ( Foreign )',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`route_id`, `route_name`, `route_description`, `city_from`, `city_to`, `created_at`, `updated_at`) VALUES
(2, 'Mabalacat Madness', 'Super Enjoy ! -Dennis 2017', 1, 69, '2017-05-08 21:14:12', '2017-05-09 08:57:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`region_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`route_id`),
  ADD UNIQUE KEY `route_id` (`route_id`),
  ADD KEY `route_id_2` (`route_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY', AUTO_INCREMENT=104;
--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `region_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY', AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `route_id` int(7) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Route''s Id ( Primary )', AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
