-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2017 at 05:20 PM
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
-- Table structure for table `card_readers`
--

DROP TABLE IF EXISTS `card_readers`;
CREATE TABLE `card_readers` (
  `card_id` int(11) NOT NULL COMMENT 'PRIMARY',
  `card_serial` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `assigned_to` int(11) DEFAULT NULL COMMENT 'FOREIGN',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `card_readers`
--

INSERT INTO `card_readers` (`card_id`, `card_serial`, `card_description`, `assigned_to`, `created_at`, `updated_at`) VALUES
(1, '22528ASD', 'Lorem Ipsum', NULL, '2017-05-29 14:13:31', '2017-05-29 14:48:33'),
(2, '2252875', 'Lorem Ipsum', NULL, '2017-05-29 14:13:36', '2017-05-29 14:13:36'),
(3, '66398552', 'Lorem Ipsum', 1, '2017-05-29 14:13:43', '2017-05-29 14:15:22'),
(4, 'KKIDK452', 'Lorem Ipsum', 3, '2017-05-29 14:13:50', '2017-05-29 14:48:47');

-- --------------------------------------------------------

--
-- Table structure for table `gps`
--

DROP TABLE IF EXISTS `gps`;
CREATE TABLE `gps` (
  `gps_id` int(11) NOT NULL COMMENT 'PRIMARY',
  `gps_serial` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gps_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `assigned_to` int(11) DEFAULT NULL COMMENT 'FOREIGN',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `gps`
--

INSERT INTO `gps` (`gps_id`, `gps_serial`, `gps_description`, `assigned_to`, `created_at`, `updated_at`) VALUES
(1, '2252158', 'Lorem Ipsum', 1, '2017-05-29 14:13:58', '2017-05-29 14:41:10'),
(2, '129996', 'Lorem Ipsum', NULL, '2017-05-29 14:14:05', '2017-05-29 14:14:05'),
(3, 'KIKJ4528', 'Lorem Ipsum', NULL, '2017-05-29 14:14:12', '2017-05-29 14:48:33'),
(4, '369552', 'Lorem Ipsum', NULL, '2017-05-29 14:14:18', '2017-05-29 14:14:18'),
(5, 'KIKJJNE', 'Lorem Ipsum', 3, '2017-05-29 14:14:23', '2017-05-29 14:48:47'),
(6, '7514', 'Lorem Ipsum', NULL, '2017-05-29 14:14:32', '2017-05-29 14:14:32');

-- --------------------------------------------------------

--
-- Table structure for table `mediaboxes`
--

DROP TABLE IF EXISTS `mediaboxes`;
CREATE TABLE `mediaboxes` (
  `box_id` int(11) NOT NULL COMMENT 'PRIMARY',
  `box_tag` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `assigned_to` int(11) DEFAULT NULL COMMENT 'FOREIGN',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `mediaboxes`
--

INSERT INTO `mediaboxes` (`box_id`, `box_tag`, `assigned_to`, `created_at`, `updated_at`) VALUES
(1, '458851L', NULL, '2017-05-29 14:12:35', '2017-05-29 14:12:35'),
(2, '1254-857', NULL, '2017-05-29 14:12:49', '2017-05-29 14:12:49'),
(3, '4522896', NULL, '2017-05-29 14:12:57', '2017-05-29 14:41:32'),
(4, '3363958', 3, '2017-05-29 14:13:03', '2017-05-29 14:48:47'),
(5, 'K445L', NULL, '2017-05-29 14:13:11', '2017-05-29 14:41:10'),
(6, '12522LKI', NULL, '2017-05-29 14:13:17', '2017-05-29 14:13:17');

-- --------------------------------------------------------

--
-- Table structure for table `ready_vehicles`
--

DROP TABLE IF EXISTS `ready_vehicles`;
CREATE TABLE `ready_vehicles` (
  `ready_vehicle_id` int(11) NOT NULL COMMENT 'PRIMARY',
  `vehicle_id` int(11) NOT NULL COMMENT 'FOREIGN',
  `box_id` int(11) DEFAULT NULL COMMENT 'FOREIGN',
  `tv_id` int(11) DEFAULT NULL COMMENT 'FOREIGN',
  `card_id` int(11) DEFAULT NULL COMMENT 'FOREIGN',
  `gps_id` int(11) DEFAULT NULL COMMENT 'FOREIGN',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `ready_vehicles`
--

INSERT INTO `ready_vehicles` (`ready_vehicle_id`, `vehicle_id`, `box_id`, `tv_id`, `card_id`, `gps_id`, `created_at`, `updated_at`) VALUES
(3, 1, 4, 3, 4, 5, '2017-05-29 14:48:47', '2017-05-29 14:48:47');

-- --------------------------------------------------------

--
-- Table structure for table `tvs`
--

DROP TABLE IF EXISTS `tvs`;
CREATE TABLE `tvs` (
  `tv_id` int(11) NOT NULL COMMENT 'PRIMARY',
  `tv_serial` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tv_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `assigned_to` int(11) DEFAULT NULL COMMENT 'FOREIGN',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `tvs`
--

INSERT INTO `tvs` (`tv_id`, `tv_serial`, `tv_description`, `assigned_to`, `created_at`, `updated_at`) VALUES
(1, 'LKIMJM', 'Lorem Ipsum', NULL, '2017-05-29 14:14:42', '2017-05-29 14:41:32'),
(2, '1582', 'Lorem Ipsum', NULL, '2017-05-29 14:14:46', '2017-05-29 14:48:33'),
(3, '20025KJUNM', 'Lorem Ipsum', 3, '2017-05-29 14:14:52', '2017-05-29 14:48:47'),
(4, 'KMMINE', 'Lorem Ipsum', NULL, '2017-05-29 14:14:58', '2017-05-29 14:14:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card_readers`
--
ALTER TABLE `card_readers`
  ADD PRIMARY KEY (`card_id`);

--
-- Indexes for table `gps`
--
ALTER TABLE `gps`
  ADD PRIMARY KEY (`gps_id`);

--
-- Indexes for table `mediaboxes`
--
ALTER TABLE `mediaboxes`
  ADD PRIMARY KEY (`box_id`);

--
-- Indexes for table `ready_vehicles`
--
ALTER TABLE `ready_vehicles`
  ADD PRIMARY KEY (`ready_vehicle_id`);

--
-- Indexes for table `tvs`
--
ALTER TABLE `tvs`
  ADD PRIMARY KEY (`tv_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `card_readers`
--
ALTER TABLE `card_readers`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `gps`
--
ALTER TABLE `gps`
  MODIFY `gps_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `mediaboxes`
--
ALTER TABLE `mediaboxes`
  MODIFY `box_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ready_vehicles`
--
ALTER TABLE `ready_vehicles`
  MODIFY `ready_vehicle_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tvs`
--
ALTER TABLE `tvs`
  MODIFY `tv_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY', AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
