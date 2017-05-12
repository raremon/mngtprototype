-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2017 at 11:23 PM
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
-- Table structure for table `active_vehicles`
--

DROP TABLE IF EXISTS `active_vehicles`;
CREATE TABLE `active_vehicles` (
  `active_vehicle_id` int(11) NOT NULL COMMENT 'PRIMARY',
  `ready_vehicle_id` int(11) NOT NULL COMMENT 'FOREIGN',
  `driver_id` int(11) DEFAULT NULL COMMENT 'FOREIGN',
  `route_id` int(11) DEFAULT NULL COMMENT 'FOREIGN',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `adowner_accounts`
--

DROP TABLE IF EXISTS `adowner_accounts`;
CREATE TABLE `adowner_accounts` (
  `owner_id` int(10) NOT NULL,
  `owner_uname` varchar(50) NOT NULL,
  `owner_upass` varchar(255) NOT NULL,
  `owner_lastlogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_online` int(1) NOT NULL,
  `advertiser_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

DROP TABLE IF EXISTS `ads`;
CREATE TABLE `ads` (
  `ad_id` int(11) NOT NULL COMMENT 'Ad''s Id ( Primary )',
  `ad_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ad''s File Name',
  `ad_filename` varchar(255) NOT NULL,
  `ad_duration` int(11) NOT NULL COMMENT 'Ad''s Duration',
  `advertiser_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `advertisers`
--

DROP TABLE IF EXISTS `advertisers`;
CREATE TABLE `advertisers` (
  `advertiser_id` int(11) NOT NULL COMMENT 'Advertiser''s Id ( Primary )',
  `advertiser_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Advertiser''s Name',
  `advertiser_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Advertiser''s Address',
  `advertiser_contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Advertiser''s Contact Details',
  `advertiser_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Advertiser''s Email',
  `advertiser_website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Advertiser''s Website',
  `advertiser_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Profile Image',
  `advertiser_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Advertiser''s Description',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ad_logs`
--

DROP TABLE IF EXISTS `ad_logs`;
CREATE TABLE `ad_logs` (
  `log_id` bigint(20) NOT NULL,
  `ad_id` int(10) NOT NULL,
  `date_log` date NOT NULL,
  `bus_id` int(10) NOT NULL,
  `route_id` int(11) NOT NULL,
  `amCount` int(11) NOT NULL,
  `pmCount` int(11) NOT NULL,
  `eveCount` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ad_schedules`
--

DROP TABLE IF EXISTS `ad_schedules`;
CREATE TABLE `ad_schedules` (
  `ad_id` int(11) NOT NULL COMMENT 'Ad''s Id ( Foreign )',
  `schedule_id` int(11) NOT NULL COMMENT 'Schedule''s Id ( Foreign )',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `airtimes`
--

DROP TABLE IF EXISTS `airtimes`;
CREATE TABLE `airtimes` (
  `airtime_id` int(11) NOT NULL COMMENT 'Airtime''s Id ( Primary )',
  `time_start` time NOT NULL COMMENT 'Time Start',
  `time_end` time DEFAULT NULL COMMENT 'Time End',
  `schedule_id` int(11) NOT NULL COMMENT 'Schedule''s Id ( Foreign )',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `drivers`
--

DROP TABLE IF EXISTS `drivers`;
CREATE TABLE `drivers` (
  `driver_id` int(11) NOT NULL COMMENT 'PRIMARY',
  `driver_fname` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_mname` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_lname` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_contact` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

DROP TABLE IF EXISTS `features`;
CREATE TABLE `features` (
  `feature_id` int(11) NOT NULL COMMENT 'Feature''s Id',
  `feature_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Feature''s Name',
  `feature_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Feature''s Directory URL',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'Box 001', 11, '2017-05-12 20:01:15', '2017-05-12 21:17:14'),
(2, 'Box 002', 12, '2017-05-12 20:01:19', '2017-05-12 21:17:16'),
(3, 'Box 003', NULL, '2017-05-12 20:01:22', '2017-05-12 21:19:37'),
(4, 'Box 004', NULL, '2017-05-12 20:01:26', '2017-05-12 21:15:14'),
(5, 'Box 005', NULL, '2017-05-12 20:01:29', '2017-05-12 20:01:29'),
(6, 'Box 006', NULL, '2017-05-12 20:01:32', '2017-05-12 21:15:22'),
(7, 'Box 007', NULL, '2017-05-12 20:01:36', '2017-05-12 21:15:19');

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

DROP TABLE IF EXISTS `privileges`;
CREATE TABLE `privileges` (
  `role_id` int(11) NOT NULL COMMENT 'Role''s Id',
  `feature_id` int(11) NOT NULL COMMENT 'Feature''s Id',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `ready_vehicles`
--

INSERT INTO `ready_vehicles` (`ready_vehicle_id`, `vehicle_id`, `box_id`, `tv_id`, `created_at`, `updated_at`) VALUES
(11, 1, 1, 1, '2017-05-12 21:17:13', '2017-05-12 21:17:13'),
(12, 2, 2, 2, '2017-05-12 21:17:16', '2017-05-12 21:17:16');

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
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL COMMENT 'Role''s Id',
  `role_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Role''s Name',
  `role_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Role''s Description',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `role_description`, `created_at`, `updated_at`) VALUES
(1, 'Manager', 'a person responsible for controlling or administering all or part of a company or similar organization.', '2017-05-10 00:03:43', '2017-05-10 00:03:43'),
(2, 'Program Director', 'The Program Director oversees the coordination and administration of all aspects of an ongoing program including planning, organizing, staffing, leading, and controlling program activities.', '2017-05-10 00:03:43', '2017-05-10 00:03:43'),
(3, 'System Administrator', 'A system administrator, or sysadmin, is a person who is responsible for the upkeep, configuration, and reliable operation of computer systems; especially multi-user computers, such as servers.', '2017-05-10 00:03:43', '2017-05-10 00:03:43'),
(4, 'Advertisement Officer', 'Advertising and Promotions Manager. Job Duties: Advertising, promotions, and marketing managers typically do the following: Work with department heads or staff to discuss topics such as contracts, selection of advertising media, or products to be advertised.', '2017-05-10 00:03:43', '2017-05-10 00:03:43');

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

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
CREATE TABLE `schedules` (
  `schedule_id` int(11) NOT NULL COMMENT 'Schedule''s Id ( Primary )',
  `advertiser_id` int(11) NOT NULL COMMENT 'Advertiser''s Id ( Foreign )',
  `route_id` int(11) NOT NULL COMMENT 'Route''s Id ( Foreign )',
  `schedule_duration` int(11) NOT NULL COMMENT 'Ad''s total duration',
  `date_start` date NOT NULL COMMENT 'Date Start',
  `date_end` date NOT NULL COMMENT 'Date End',
  `schedule_type` int(11) NOT NULL COMMENT 'Schedule''s Type ( 1:Normal ; 2:Scheduled ; 3:Blocked )',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, '4A77825', 'Lenovo Tv', 11, '2017-05-12 19:57:30', '2017-05-12 21:17:14'),
(2, '55854785', 'Predator 24 Inch QHD Monitor', 12, '2017-05-12 19:57:48', '2017-05-12 21:17:16'),
(3, '252136985AAO', 'ASUS 40 Inch Monitor', NULL, '2017-05-12 19:58:10', '2017-05-12 21:19:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'User''s Id',
  `user_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Username',
  `user_fname` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'First Name',
  `user_lname` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Last Name',
  `user_password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Password',
  `user_role` int(11) NOT NULL COMMENT 'Role Id',
  `user_lastlogin` timestamp NULL DEFAULT NULL COMMENT 'Last Login Timestamp',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_online` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_fname`, `user_lname`, `user_password`, `user_role`, `user_lastlogin`, `created_at`, `updated_at`, `is_online`) VALUES
(1, 'admin', 'Dennis', 'de Leon', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, '2017-05-06 20:35:50', '2017-04-09 17:17:02', '2017-05-06 20:35:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE `vehicles` (
  `vehicle_id` int(11) NOT NULL COMMENT 'PRIMARY',
  `vehicle_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `plate_number` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_type` int(11) NOT NULL COMMENT 'FOREIGN',
  `assigned_to` int(11) DEFAULT NULL COMMENT 'FOREIGN',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`vehicle_id`, `vehicle_name`, `plate_number`, `vehicle_description`, `vehicle_type`, `assigned_to`, `created_at`, `updated_at`) VALUES
(1, 'BUS 001', '252-14785', '40 Seater Bus', 1, 11, '2017-05-12 19:59:26', '2017-05-12 21:17:13'),
(2, 'BUS 002', '12528-AE', 'Lorem Ipsum', 1, 12, '2017-05-12 19:59:41', '2017-05-12 21:17:16'),
(3, 'BUS 003', '2529968', 'Lorem Ipsum', 1, NULL, '2017-05-12 19:59:50', '2017-05-12 21:19:37'),
(4, 'BUS 004', 'ASDE-1123', 'Lorem Ipsum', 1, NULL, '2017-05-12 20:00:01', '2017-05-12 20:00:01'),
(5, 'Trike 001', 'DDS-SPRT', 'Lorem Ipsum', 2, NULL, '2017-05-12 20:00:15', '2017-05-12 20:00:15'),
(6, 'Trike 002', '02521', 'Lorem Ipsum', 2, NULL, '2017-05-12 20:00:30', '2017-05-12 20:00:30'),
(7, 'Jeepney 001', 'JEEP1252', 'Lorem Ipsum', 3, NULL, '2017-05-12 20:00:46', '2017-05-12 21:15:14'),
(8, 'Hummer 001', '025284', 'Lorem Ipsum', 4, NULL, '2017-05-12 20:00:57', '2017-05-12 21:15:19');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_types`
--

DROP TABLE IF EXISTS `vehicle_types`;
CREATE TABLE `vehicle_types` (
  `vehicle_type_id` int(11) NOT NULL COMMENT 'PRIMARY',
  `vehicle_type_name` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `vehicle_types`
--

INSERT INTO `vehicle_types` (`vehicle_type_id`, `vehicle_type_name`, `created_at`, `updated_at`) VALUES
(1, 'Bus', '2017-05-12 19:58:29', '2017-05-12 19:58:29'),
(2, 'Trike', '2017-05-12 19:58:34', '2017-05-12 19:58:34'),
(3, 'Jeepney', '2017-05-12 19:58:49', '2017-05-12 19:58:49'),
(4, 'Hummer', '2017-05-12 19:58:54', '2017-05-12 19:58:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_vehicles`
--
ALTER TABLE `active_vehicles`
  ADD PRIMARY KEY (`active_vehicle_id`);

--
-- Indexes for table `adowner_accounts`
--
ALTER TABLE `adowner_accounts`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`ad_id`),
  ADD UNIQUE KEY `ad_id` (`ad_id`),
  ADD KEY `ad_id_2` (`ad_id`);

--
-- Indexes for table `advertisers`
--
ALTER TABLE `advertisers`
  ADD PRIMARY KEY (`advertiser_id`),
  ADD UNIQUE KEY `advertiser_id` (`advertiser_id`),
  ADD KEY `advertiser_id_2` (`advertiser_id`);

--
-- Indexes for table `ad_logs`
--
ALTER TABLE `ad_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `airtimes`
--
ALTER TABLE `airtimes`
  ADD PRIMARY KEY (`airtime_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`driver_id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`feature_id`),
  ADD UNIQUE KEY `feature_id` (`feature_id`);

--
-- Indexes for table `mediaboxes`
--
ALTER TABLE `mediaboxes`
  ADD PRIMARY KEY (`box_id`);

--
-- Indexes for table `privileges`
--
ALTER TABLE `privileges`
  ADD KEY `role_id` (`role_id`),
  ADD KEY `feature_id` (`feature_id`);

--
-- Indexes for table `ready_vehicles`
--
ALTER TABLE `ready_vehicles`
  ADD PRIMARY KEY (`ready_vehicle_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`region_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`),
  ADD UNIQUE KEY `role_id` (`role_id`),
  ADD KEY `role_id_2` (`role_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`route_id`),
  ADD UNIQUE KEY `route_id` (`route_id`),
  ADD KEY `route_id_2` (`route_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `tvs`
--
ALTER TABLE `tvs`
  ADD PRIMARY KEY (`tv_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `user_id_2` (`user_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- Indexes for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  ADD PRIMARY KEY (`vehicle_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `active_vehicles`
--
ALTER TABLE `active_vehicles`
  MODIFY `active_vehicle_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY';
--
-- AUTO_INCREMENT for table `adowner_accounts`
--
ALTER TABLE `adowner_accounts`
  MODIFY `owner_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Ad''s Id ( Primary )';
--
-- AUTO_INCREMENT for table `advertisers`
--
ALTER TABLE `advertisers`
  MODIFY `advertiser_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Advertiser''s Id ( Primary )';
--
-- AUTO_INCREMENT for table `ad_logs`
--
ALTER TABLE `ad_logs`
  MODIFY `log_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `airtimes`
--
ALTER TABLE `airtimes`
  MODIFY `airtime_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Airtime''s Id ( Primary )';
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY', AUTO_INCREMENT=104;
--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY';
--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `feature_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Feature''s Id';
--
-- AUTO_INCREMENT for table `mediaboxes`
--
ALTER TABLE `mediaboxes`
  MODIFY `box_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY', AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ready_vehicles`
--
ALTER TABLE `ready_vehicles`
  MODIFY `ready_vehicle_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY', AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `region_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY', AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Role''s Id', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `route_id` int(7) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Route''s Id ( Primary )', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Schedule''s Id ( Primary )';
--
-- AUTO_INCREMENT for table `tvs`
--
ALTER TABLE `tvs`
  MODIFY `tv_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'User''s Id', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY', AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  MODIFY `vehicle_type_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY', AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
