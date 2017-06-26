-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2017 at 07:14 AM
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
CREATE DATABASE IF NOT EXISTS `star8_develop` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
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

--
-- Dumping data for table `adowner_accounts`
--

INSERT INTO `adowner_accounts` (`owner_id`, `owner_uname`, `owner_upass`, `owner_lastlogin`, `created_at`, `updated_at`, `is_online`, `advertiser_id`) VALUES
(1, 'nestle', 'fbdc00f0a084b3393c2dd1cbb5dc0027c726cfaa', '2017-05-01 05:27:12', '2017-05-01 05:20:46', '2017-05-01 05:20:46', 1, 1),
(2, 'mcdo', 'fbdc00f0a084b3393c2dd1cbb5dc0027c726cfaa', '2017-05-04 05:47:51', '2017-05-04 05:42:18', '2017-05-04 05:42:18', 1, 2);

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

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`ad_id`, `ad_name`, `ad_filename`, `ad_duration`, `advertiser_id`, `created_at`, `updated`) VALUES
(1, 'Burgerdesal and Cheesy Eggdesal', '1-Burgerdesal_and_Cheesy_Eggdesal.mp4', 62, 1, '2017-06-09 17:07:30', '2017-06-09 17:07:30'),
(2, 'Move On with McDonalds', '1-Move_On_with_McDonalds.mp4', 78, 1, '2017-06-09 17:07:48', '2017-06-09 17:07:48'),
(3, 'Best Daddy Ever', '1-Best_Daddy_Ever.mp4', 99, 1, '2017-06-09 17:07:58', '2017-06-09 17:07:58'),
(4, 'OMG Burger', '2-OMG_Burger.mp4', 52, 2, '2017-06-09 17:08:10', '2017-06-09 17:08:10'),
(5, 'Chizza Murders Pizza', '2-Chizza_Murders_Pizza.mp4', 61, 2, '2017-06-09 17:08:20', '2017-06-09 17:08:20'),
(6, 'Sisig Rice', '2-Sisig_Rice.mp4', 17, 2, '2017-06-09 17:08:29', '2017-06-09 17:08:29');

-- --------------------------------------------------------

--
-- Table structure for table `advertisers`
--

DROP TABLE IF EXISTS `advertisers`;
CREATE TABLE `advertisers` (
  `advertiser_id` int(10) NOT NULL,
  `advertiser_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Advertiser''s Name',
  `advertiser_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Advertiser''s Address',
  `advertiser_contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Advertiser''s Contact Details',
  `advertiser_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Advertiser''s Email',
  `advertiser_website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Advertiser''s Website',
  `advertiser_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Profile Image',
  `advertiser_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Advertiser''s Description',
  `agency_id` int(10) NOT NULL COMMENT 'FOREIGN',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `advertisers`
--

INSERT INTO `advertisers` (`advertiser_id`, `advertiser_name`, `advertiser_address`, `advertiser_contact`, `advertiser_email`, `advertiser_website`, `advertiser_image`, `advertiser_description`, `agency_id`, `created_at`, `updated_at`) VALUES
(1, 'McDonald\'s Philippines', '16th Floor Citibank Center Bldg. 8741 Paseo de Roxas St., Makati City, Philippines', '02-8635490', 'mcdo@mcdonalds.com.ph', 'mcdonalds.com.ph', '', 'McDonald\'s (or simply as McDo) is an American hamburger and fast food restaurant chain. It was founded in 1940 as a barbecue restaurant operated by Richard and Maurice McDonald. ', 2, '2017-04-27 03:56:27', '2017-06-17 18:06:47'),
(2, 'KFC', '80 Don A. Roces Ave, Diliman, Quezon City, Metro Manila, Philippines', '+63 2 887 8888', 'kfc@kfc.com.ph', 'kfc.com.ph', '', 'Kentucky Fried Chicken, more commonly known by its initials KFC, is an American fast food restaurant chain that specializes in fried chicken. Headquartered in Louisville, Kentucky, it is the world\'s second-largest restaurant chain (as measured by sales) after McDonald\'s, with almost 20,000 locations globally in 123 countries and territories as of December 2015. The chain is a subsidiary of Yum! Brands, a restaurant company that also owns the Pizza Hut and Taco Bell chains.', 2, '2017-05-02 06:00:22', '2017-06-17 19:28:39'),
(3, 'Strepsils', 'Makati City, Philippines', '3013001', 'info@strepsils.com.ph', 'www.strepsils.com.ph', 'Strepsils.jpg', 'Strepsils Philippines', 2, '2017-05-04 08:07:06', '2017-06-17 19:28:39'),
(4, 'Department of Health', 'Sta. Cruz, Manila', '+632 743-1829', 'officeofusecmcv@gmail.com', 'www.doh.gov.ph', 'Department_of_Health.png', 'The Department of Health (DOH) is the principal health agency in the Philippines. It is responsible for ensuring access to basic public health services to all Filipinos through the provision of quality health care and regulation of providers of health goods and services.\r\n', 2, '2017-06-02 14:42:37', '2017-06-17 19:28:39'),
(5, 'ABS-CBN', 'Quezon City', '(+632) 415-2272', 'thevoiceph@abs-cbn.com', 'www.abs-cbn.com', 'ABS-CBN.png', 'ABS-CBN Corporation, commonly known as ABS-CBN, is a Filipino media and entertainment group based in Quezon City. It is the Philippines\' largest entertainment and media conglomerate in terms of revenue, operating income, assets, equity, market capitalization, and number of employees.', 2, '2017-06-08 15:33:05', '2017-06-17 19:28:39');

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

--
-- Dumping data for table `ad_logs`
--

INSERT INTO `ad_logs` (`log_id`, `ad_id`, `date_log`, `bus_id`, `route_id`, `amCount`, `pmCount`, `eveCount`, `created_at`, `updated`) VALUES
(13, 2, '2017-05-03', 1, 7, 20, 20, 20, '2017-05-04 12:02:15', '2017-05-04 12:02:15'),
(14, 2, '2017-05-04', 1, 7, 0, 0, 1, '2017-05-04 12:12:59', '2017-05-04 12:12:59');

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
-- Table structure for table `agencies`
--

DROP TABLE IF EXISTS `agencies`;
CREATE TABLE `agencies` (
  `agency_id` int(10) NOT NULL COMMENT 'PRIMARY',
  `agency_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `agency_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `agency_contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `agency_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `agency_website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `agency_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `agency_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `billable` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agencies`
--

INSERT INTO `agencies` (`agency_id`, `agency_name`, `agency_address`, `agency_contact`, `agency_email`, `agency_website`, `agency_image`, `agency_description`, `billable`, `created_at`, `updated_at`) VALUES
(2, '12312312312321321', '321321213213213', '213123213123', '21312312321@gmail.com', '312312312312312', '12312312312321321.jpg', '312312312312', 0, '2017-06-17 18:06:08', '2017-06-20 09:03:11');

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
-- Table structure for table `card_readers`
--

DROP TABLE IF EXISTS `card_readers`;
CREATE TABLE `card_readers` (
  `card_id` int(11) NOT NULL COMMENT 'PRIMARY',
  `card_serial` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_status` tinyint(1) NOT NULL DEFAULT '1',
  `assigned_to` int(11) DEFAULT NULL COMMENT 'FOREIGN',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `cctvs`
--

DROP TABLE IF EXISTS `cctvs`;
CREATE TABLE `cctvs` (
  `cctv_id` int(11) NOT NULL COMMENT 'PRIMARY',
  `cctv_serial` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cctv_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cctv_status` tinyint(1) NOT NULL DEFAULT '1',
  `assigned_to` int(11) DEFAULT NULL COMMENT 'FOREIGN',
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
-- Table structure for table `deployment`
--

DROP TABLE IF EXISTS `deployment`;
CREATE TABLE `deployment` (
  `deploy_id` int(10) NOT NULL,
  `vehicle_id` int(10) NOT NULL COMMENT 'FOREIGN',
  `tv_id` int(10) DEFAULT NULL COMMENT 'FOREIGN',
  `box_id` int(10) DEFAULT NULL COMMENT 'FOREIGN',
  `cctv_id` int(11) DEFAULT NULL COMMENT 'FOREIGN',
  `ipcam_id` int(10) DEFAULT NULL COMMENT 'FOREIGN',
  `card_id` int(11) DEFAULT NULL COMMENT 'FOREIGN',
  `gps_id` int(10) DEFAULT NULL COMMENT 'FOREIGN',
  `pos_id` int(10) DEFAULT NULL COMMENT 'FOREIGN',
  `route_id` int(10) DEFAULT NULL COMMENT 'FOREIGN',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

DROP TABLE IF EXISTS `drivers`;
CREATE TABLE `drivers` (
  `driver_id` int(11) NOT NULL COMMENT 'PRIMARY',
  `driver_fname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_mname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_lname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_contact` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_address` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`feature_id`, `feature_name`, `feature_url`, `created_at`, `updated_at`) VALUES
(1, 'Create New User', '/user/add', '2017-04-09 17:21:12', '2017-04-09 17:21:12'),
(2, 'Update User', '/user/update', '2017-04-09 17:21:12', '2017-04-09 17:21:12'),
(3, 'Delete User', '/user/delete', '2017-04-09 17:21:12', '2017-04-09 17:21:12');

-- --------------------------------------------------------

--
-- Table structure for table `fillers`
--

DROP TABLE IF EXISTS `fillers`;
CREATE TABLE `fillers` (
  `filler_id` int(10) NOT NULL,
  `filler_title` varchar(255) NOT NULL,
  `filler_description` text NOT NULL,
  `filler_type` int(11) NOT NULL COMMENT '1=video;2=image;3=text',
  `filler_file` varchar(255) NOT NULL,
  `filler_duration` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL COMMENT '0=show;1=hide'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fillers`
--

INSERT INTO `fillers` (`filler_id`, `filler_title`, `filler_description`, `filler_type`, `filler_file`, `filler_duration`, `created_at`, `updated`, `status`) VALUES
(1, 'Supertastic Fillers', 'Loren Ipsum Dolor', 1, 'Love-Coding-Windows-Animated-Wallpaper.mp4', 15, '2017-06-10 01:06:08', '2017-06-10 01:06:08', 0),
(2, 'Star 8 Totoo', 'Super Discounts', 1, '2-discount.mp4', 11, '2017-06-10 01:06:31', '2017-06-10 01:06:31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `gps`
--

DROP TABLE IF EXISTS `gps`;
CREATE TABLE `gps` (
  `gps_id` int(11) NOT NULL COMMENT 'PRIMARY',
  `gps_serial` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gps_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gps_status` tinyint(1) NOT NULL DEFAULT '1',
  `assigned_to` int(11) DEFAULT NULL COMMENT 'FOREIGN',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `ip_cameras`
--

DROP TABLE IF EXISTS `ip_cameras`;
CREATE TABLE `ip_cameras` (
  `ipcam_id` int(11) NOT NULL COMMENT 'PRIMARY',
  `ipcam_serial` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ipcam_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ipcam_status` tinyint(1) NOT NULL DEFAULT '1',
  `assigned_to` int(11) DEFAULT NULL COMMENT 'FOREIGN',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL COMMENT 'PRIMARY',
  `city_id` int(11) NOT NULL COMMENT 'FOREIGN',
  `location_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` decimal(27,20) NOT NULL,
  `longitude` decimal(27,20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `city_id`, `location_name`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(7, 1, 'SM Manila', '14.58968869432250000000', '120.98311000845945000000', '2017-05-28 12:19:39', '2017-05-28 13:38:59'),
(8, 1, 'Adamson University', '14.58689568199794000000', '120.98566347144163000000', '2017-05-28 13:08:34', '2017-05-28 13:39:23'),
(9, 103, 'Marawi', '8.01062130000000200000', '124.29771800000003000000', '2017-05-28 13:48:44', '2017-05-28 13:48:44'),
(10, 11, 'EDSA Taft Avenue', '14.53871400000000000000', '121.00067149999995000000', '2017-06-03 02:33:42', '2017-06-03 02:33:42'),
(11, 11, 'SM Mall of Asia', '14.53505800000000000000', '120.98213199999998000000', '2017-06-03 02:34:10', '2017-06-03 02:34:10');

-- --------------------------------------------------------

--
-- Table structure for table `mediaboxes`
--

DROP TABLE IF EXISTS `mediaboxes`;
CREATE TABLE `mediaboxes` (
  `box_id` int(11) NOT NULL COMMENT 'PRIMARY',
  `box_tag` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `box_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `box_status` tinyint(1) NOT NULL DEFAULT '1',
  `assigned_to` int(11) DEFAULT NULL COMMENT 'FOREIGN',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `n_routeschedules`
--

DROP TABLE IF EXISTS `n_routeschedules`;
CREATE TABLE `n_routeschedules` (
  `play_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `timeslot` int(11) NOT NULL,
  `content_source` int(1) NOT NULL COMMENT '1=n_schedules;2=fillers',
  `schedule_id` int(11) NOT NULL DEFAULT '0',
  `ad_id` int(11) NOT NULL DEFAULT '0',
  `filler_id` int(10) NOT NULL DEFAULT '0',
  `play_order` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `n_routeschedules`
--

INSERT INTO `n_routeschedules` (`play_id`, `route_id`, `timeslot`, `content_source`, `schedule_id`, `ad_id`, `filler_id`, `play_order`, `created_at`, `updated`) VALUES
(1, 1, 8, 1, 1, 1, 0, 1, '2017-05-21 23:26:04', '2017-05-21 23:26:04'),
(2, 1, 8, 1, 2, 2, 0, 2, '2017-05-21 23:37:18', '2017-05-21 23:37:18'),
(3, 1, 8, 2, 0, 0, 1, 3, '2017-05-21 23:39:12', '2017-05-21 23:39:12'),
(4, 1, 8, 2, 0, 0, 2, 4, '2017-05-21 23:40:27', '2017-05-21 23:40:27'),
(5, 1, 8, 1, 3, 3, 0, 5, '2017-05-23 23:35:25', '2017-05-23 23:35:25'),
(6, 1, 8, 1, 4, 4, 0, 5, '2017-05-23 23:36:10', '2017-05-23 23:36:10'),
(7, 1, 8, 1, 5, 5, 0, 5, '2017-05-23 23:37:37', '2017-05-23 23:37:37');

-- --------------------------------------------------------

--
-- Table structure for table `n_schedules`
--

DROP TABLE IF EXISTS `n_schedules`;
CREATE TABLE `n_schedules` (
  `schedule_id` int(10) NOT NULL,
  `ad_id` int(10) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `timeslot` int(2) NOT NULL,
  `times_repeat` int(3) NOT NULL COMMENT 'no. of times ad wil repeat in an hour',
  `display_type` int(1) NOT NULL COMMENT '1=normal;2=split;3=star8',
  `win_123` int(1) NOT NULL COMMENT 'if display_type is 2 or split, win1=bigger, win2=window on top right; win3=window on bottom right',
  `route_id` int(11) NOT NULL COMMENT 'FOREIGN',
  `order_id` int(11) NOT NULL COMMENT 'FOREIGN',
  `paid_duration` int(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL COMMENT '0=unscheduled;1=scheduled'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `n_schedules`
--

INSERT INTO `n_schedules` (`schedule_id`, `ad_id`, `date_start`, `date_end`, `timeslot`, `times_repeat`, `display_type`, `win_123`, `route_id`, `order_id`, `paid_duration`, `created_at`, `updated`, `status`) VALUES
(1, 2, '2017-06-10', '2017-07-09', 4, 45, 2, 2, 3, 1, 12, '2017-06-10 01:36:11', '2017-06-10 01:36:11', 0),
(2, 2, '2017-06-10', '2017-07-09', 5, 45, 2, 2, 3, 1, 12, '2017-06-10 01:36:11', '2017-06-10 01:36:11', 0),
(3, 2, '2017-06-10', '2017-07-09', 10, 45, 2, 2, 3, 1, 12, '2017-06-10 01:36:11', '2017-06-10 01:36:11', 0),
(4, 2, '2017-06-10', '2017-07-09', 13, 45, 2, 2, 3, 1, 12, '2017-06-10 01:36:11', '2017-06-10 01:36:11', 0),
(5, 2, '2017-06-10', '2017-07-09', 18, 45, 2, 2, 3, 1, 12, '2017-06-10 01:36:11', '2017-06-10 01:36:11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `order_id` int(10) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sales_id` int(10) NOT NULL,
  `ad_duration` int(10) NOT NULL,
  `advertiser_id` int(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ad_id` int(10) NOT NULL COMMENT 'ad_id > 0 if order status is not zero',
  `order_status` int(1) NOT NULL COMMENT '0=pending;1=approved;2=cancelled',
  `status_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_start` date NOT NULL,
  `date_end` date DEFAULT NULL,
  `filler_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_routes`
--

DROP TABLE IF EXISTS `order_routes`;
CREATE TABLE `order_routes` (
  `orderroutes_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `route_id` int(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_slots`
--

DROP TABLE IF EXISTS `order_slots`;
CREATE TABLE `order_slots` (
  `orderslot_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `tslot_id` int(10) NOT NULL,
  `display_type` int(1) NOT NULL COMMENT '1=normal, 2=split-main, 3=star8, 4=split-top, 5=split-bottom',
  `win_123` int(1) NOT NULL COMMENT '1=main, 2=top; 3=bottom',
  `times_repeat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

DROP TABLE IF EXISTS `playlist`;
CREATE TABLE `playlist` (
  `play_id` int(10) NOT NULL,
  `id` int(10) NOT NULL,
  `content_type` varchar(50) NOT NULL,
  `content_id` int(10) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `timeslot` int(5) NOT NULL,
  `tslot_time` varchar(50) NOT NULL,
  `times_repeat` int(5) NOT NULL,
  `display_type` int(1) NOT NULL,
  `win_123` int(1) NOT NULL,
  `route_id` int(10) NOT NULL,
  `duration` int(5) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `play_order` int(10) NOT NULL,
  `order_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `playlist_updates`
--

DROP TABLE IF EXISTS `playlist_updates`;
CREATE TABLE `playlist_updates` (
  `update_id` int(10) NOT NULL,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `route_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playlist_updates`
--

INSERT INTO `playlist_updates` (`update_id`, `update_date`, `route_id`) VALUES
(0, '2017-06-09 21:32:35', 4),
(0, '2017-06-10 01:36:30', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pos`
--

DROP TABLE IF EXISTS `pos`;
CREATE TABLE `pos` (
  `pos_id` int(11) NOT NULL COMMENT 'PRIMARY',
  `pos_serial` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pos_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pos_status` tinyint(1) NOT NULL DEFAULT '1',
  `assigned_to` int(11) DEFAULT NULL COMMENT 'FOREIGN',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

--
-- Dumping data for table `privileges`
--

INSERT INTO `privileges` (`role_id`, `feature_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2017-04-09 17:20:18', '2017-04-09 17:20:18'),
(1, 2, '2017-04-09 17:23:20', '2017-04-09 17:23:20'),
(1, 1, '2017-04-09 17:20:18', '2017-04-09 17:20:18'),
(1, 2, '2017-04-09 17:23:20', '2017-04-09 17:23:20'),
(1, 1, '2017-04-09 17:20:18', '2017-04-09 17:20:18'),
(1, 2, '2017-04-09 17:23:20', '2017-04-09 17:23:20');

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
  `cctv_id` int(11) DEFAULT NULL COMMENT 'FOREIGN',
  `ipcam_id` int(11) DEFAULT NULL COMMENT 'FOREIGN',
  `pos_id` int(11) DEFAULT NULL COMMENT 'FOREIGN',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

DROP TABLE IF EXISTS `regions`;
CREATE TABLE `regions` (
  `region_id` int(11) NOT NULL COMMENT 'PRIMARY',
  `region_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_abbr` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`region_id`, `region_name`, `region_abbr`, `created_at`, `updated_at`) VALUES
(1, 'National Capital Region', 'NCR', '2017-05-08 10:33:59', '2017-05-28 11:21:33'),
(2, 'Ilocos Region', 'Region I', '2017-05-08 10:35:57', '2017-05-28 11:21:33'),
(3, 'Cordillera Administrative Region', 'CAR', '2017-05-08 10:44:22', '2017-05-28 11:21:33'),
(4, 'Cagayan Valley', 'Region II', '2017-05-08 10:45:07', '2017-05-28 11:21:33'),
(5, 'Central Luzon', 'Region III', '2017-05-08 10:45:23', '2017-05-28 11:21:33'),
(6, 'CALABARZON', 'Region IV-A', '2017-05-08 11:06:13', '2017-05-28 11:21:33'),
(7, 'MIMAROPA Region', 'Region IV-B', '2017-05-08 11:07:57', '2017-05-28 11:21:33'),
(8, 'Bicol Region', 'Region V', '2017-05-08 11:09:03', '2017-05-28 11:21:33'),
(9, 'Western Visayas', 'Region VI', '2017-05-08 11:09:27', '2017-05-28 11:21:33'),
(10, 'Central Visayas', 'Region VII', '2017-05-08 11:10:31', '2017-05-28 11:21:33'),
(11, 'Eastern Visayas', 'Region VIII', '2017-05-08 11:10:47', '2017-05-28 11:21:33'),
(12, 'Zamboanga Peninsula', 'Region IX', '2017-05-08 11:11:26', '2017-05-28 11:21:33'),
(13, 'Northern Mindanao', 'Region X', '2017-05-08 11:11:51', '2017-05-28 11:21:33'),
(14, 'Davao Region', 'Region XI', '2017-05-08 11:12:22', '2017-05-28 11:21:33'),
(15, 'SOCCKSKSARGEN', 'Region XII', '2017-05-08 11:13:19', '2017-05-28 11:21:33'),
(16, 'CARAGA', 'Region XIII', '2017-05-08 11:13:35', '2017-05-28 11:21:33'),
(17, 'Autonomous Region in Muslim Mindanao', 'ARMM', '2017-05-08 11:14:02', '2017-05-28 11:30:13');

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
(1, 'Admin', 'S/he can govern through the whole web application. Has all privileges.', '2017-04-09 17:19:10', '2017-04-09 17:19:10'),
(2, 'Sales Agent', 'Sales Agent', '2017-06-04 15:08:29', '2017-06-04 15:08:29');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

DROP TABLE IF EXISTS `routes`;
CREATE TABLE `routes` (
  `route_id` int(7) UNSIGNED NOT NULL COMMENT 'Route''s Id ( Primary )',
  `route_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Route''s Name',
  `route_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Route''s Description',
  `location_from` int(7) UNSIGNED NOT NULL COMMENT 'Id of first city ( Foreign )',
  `location_to` int(7) UNSIGNED NOT NULL COMMENT 'Id of second city ( Foreign )',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`route_id`, `route_name`, `route_description`, `location_from`, `location_to`, `created_at`, `updated_at`) VALUES
(3, 'Adamson to SM', 'lorem ipsum', 9, 7, '2017-05-28 14:11:31', '2017-05-29 02:53:39'),
(4, 'SM Manila to Adamson', 'SM Manila to Adamson', 7, 8, '2017-05-30 07:50:15', '2017-06-17 12:29:53'),
(5, 'EDSA Taft to MOA', 'EDSA Taft Avenue to SM Mall of Asia', 10, 11, '2017-06-03 02:35:18', '2017-06-03 02:35:18'),
(6, 'asdasd', 'aasdasd', 9, 11, '2017-06-17 12:26:26', '2017-06-17 12:26:26'),
(7, 'zzzzz', 'zzz', 8, 7, '2017-06-17 12:26:57', '2017-06-17 12:26:57'),
(8, 'dadsadasdasd', 'asdasdasdasdasdas', 10, 9, '2017-06-25 19:38:51', '2017-06-25 19:38:51');

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
-- Table structure for table `tbappdb`
--

DROP TABLE IF EXISTS `tbappdb`;
CREATE TABLE `tbappdb` (
  `Keyid` int(11) NOT NULL,
  `AppId` varchar(45) DEFAULT NULL,
  `SqlCom` varchar(255) DEFAULT NULL,
  `DbCom` varchar(45) DEFAULT NULL,
  `TbName` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbappdb`
--

INSERT INTO `tbappdb` (`Keyid`, `AppId`, `SqlCom`, `DbCom`, `TbName`) VALUES
(1, '001', 'INSERT INTO `localstar8`.`tbappupdate` (`Appid`, `AppFilename`, `AppDtMod`, `AppFileSize`, `DbStatus`, `RouteId`) VALUES (\'001\', \'8.exe\', \'10/10/2017\', \'12\', \'y\', \'7\')', 'Create', 'tbappexec');

-- --------------------------------------------------------

--
-- Table structure for table `tbappexec`
--

DROP TABLE IF EXISTS `tbappexec`;
CREATE TABLE `tbappexec` (
  `keyid` int(11) NOT NULL,
  `AppID` varchar(45) DEFAULT NULL,
  `AppFilename` varchar(45) DEFAULT NULL,
  `RouteID` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbappexec`
--

INSERT INTO `tbappexec` (`keyid`, `AppID`, `AppFilename`, `RouteID`) VALUES
(1, '001', '1.exe', '7'),
(2, '002', '2.exe', '7'),
(3, '003', '3.exe', '7'),
(4, '004', '4.exe', '7'),
(5, '005', 'MpUpdates.exe', '7');

-- --------------------------------------------------------

--
-- Table structure for table `tbappupdate`
--

DROP TABLE IF EXISTS `tbappupdate`;
CREATE TABLE `tbappupdate` (
  `KeyId` int(11) NOT NULL,
  `Appid` varchar(45) DEFAULT NULL,
  `AppFilename` varchar(45) DEFAULT NULL,
  `AppDtMod` varchar(45) DEFAULT NULL,
  `AppFileSize` varchar(45) DEFAULT NULL,
  `DbStatus` varchar(45) DEFAULT NULL,
  `RouteId` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbappupdate`
--

INSERT INTO `tbappupdate` (`KeyId`, `Appid`, `AppFilename`, `AppDtMod`, `AppFileSize`, `DbStatus`, `RouteId`) VALUES
(1, '001', '1.exe', '10/10/2017', '12', '1', '7'),
(2, '002', '2.exe', '10/10/2017', '23mb', '0', '7'),
(3, '003', '3.exe', '10/10/2017', '23mb', '0', '7'),
(4, '004', '4.exe', '10/10/2017', '23', '0', '7'),
(5, '005', 'MpUpdates.exe', '2017-05-21', '23mb', '0', '7'),
(6, '006', '6.exe', '05/30/2017', '12', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbdlapplog`
--

DROP TABLE IF EXISTS `tbdlapplog`;
CREATE TABLE `tbdlapplog` (
  `keyid` int(11) NOT NULL,
  `Appid` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `DateDl` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `DlStatus` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `Vid` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `tbhwdefect`
--

DROP TABLE IF EXISTS `tbhwdefect`;
CREATE TABLE `tbhwdefect` (
  `keyid` int(11) NOT NULL,
  `Mboardid` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `HwKeyid` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `DateOprt` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `DateReplace` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `PartDesc` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `VehicleId` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `tblcconfig`
--

DROP TABLE IF EXISTS `tblcconfig`;
CREATE TABLE `tblcconfig` (
  `keyid` int(11) NOT NULL,
  `LcPath` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `LcFunction` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `route_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `tblcconfig`
--

INSERT INTO `tblcconfig` (`keyid`, `LcPath`, `LcFunction`, `route_id`) VALUES
(1, 'C;\\8App', 'App', 0),
(2, 'C:\\8Video', 'Video', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbmbinfo`
--

DROP TABLE IF EXISTS `tbmbinfo`;
CREATE TABLE `tbmbinfo` (
  `keyid` int(11) NOT NULL,
  `MBoardID` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `HwKeyId` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `DateOprt` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `HddCap` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `HwCap` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `VehicleId` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `tbmbregs`
--

DROP TABLE IF EXISTS `tbmbregs`;
CREATE TABLE `tbmbregs` (
  `keyid` int(11) NOT NULL,
  `HwkeyId` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `VehicleId` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `RouteId` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `tbmbregs`
--

INSERT INTO `tbmbregs` (`keyid`, `HwkeyId`, `VehicleId`, `RouteId`) VALUES
(1, 'AU6485', 'Bus001', '7');

-- --------------------------------------------------------

--
-- Table structure for table `tbwsconfig`
--

DROP TABLE IF EXISTS `tbwsconfig`;
CREATE TABLE `tbwsconfig` (
  `keyid` int(11) NOT NULL,
  `WsLink` varchar(200) COLLATE utf8mb4_bin DEFAULT NULL,
  `WsFunction` varchar(200) COLLATE utf8mb4_bin DEFAULT NULL,
  `route_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `tbwsconfig`
--

INSERT INTO `tbwsconfig` (`keyid`, `WsLink`, `WsFunction`, `route_id`) VALUES
(1, 'http://180.232.67.229/api/', 'Appupdate', 0),
(2, 'http://180.232.67.229/assets/ads/', 'DlVideo', 0),
(3, 'http://172.16.4.243/api/jlogs/', 'Adlog', 0),
(4, 'http://180.232.67.229/assets/app/', 'Dlapp', 0),
(5, 'http://180.232.67.229/api/jtblconfig/', 'tblconfig', 0),
(6, 'http://180.232.67.229/api/jfiller/', 'jfiller', 0),
(7, 'http://180.232.67.229/api/jtbmbregs/', 'tbmbregs', 0),
(8, 'http://180.232.67.229/api/jtbmbinfo/', 'tbmbinfo', 0),
(9, 'http://180.232.67.229/api/jtbhwdefect/', 'jtbhwdefect', 0),
(10, 'http://180.232.67.229/api/jschedule/routeschedules/', 'jschedule', 0);

-- --------------------------------------------------------

--
-- Table structure for table `timeslots`
--

DROP TABLE IF EXISTS `timeslots`;
CREATE TABLE `timeslots` (
  `tslot_id` int(5) NOT NULL,
  `tslot_session` varchar(3) NOT NULL COMMENT 'am, pm, eve',
  `tslot_code` int(2) NOT NULL,
  `tslot_time` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timeslots`
--

INSERT INTO `timeslots` (`tslot_id`, `tslot_session`, `tslot_code`, `tslot_time`, `created_at`, `updated`) VALUES
(1, 'am', 4, '4:00 am - 5:00 am', '2017-05-26 22:49:08', '2017-05-26 22:49:08'),
(2, 'am', 5, '5:00 am - 6:00 am', '2017-05-26 22:49:08', '2017-05-26 22:49:08'),
(3, 'am', 6, '6:00 am - 7:00 am', '2017-05-26 22:49:59', '2017-05-26 22:49:59'),
(4, 'am', 7, '7:00 am - 8:00 am', '2017-05-26 22:49:59', '2017-05-26 22:49:59'),
(5, 'am', 8, '8:00 am - 9:00 am', '2017-05-26 22:50:49', '2017-05-26 22:50:49'),
(6, 'am', 9, '9:00 am - 10:00 am', '2017-05-26 22:50:49', '2017-05-26 22:50:49'),
(7, 'am', 10, '10:00 am - 11:00 am', '2017-05-26 22:51:21', '2017-05-26 22:51:21'),
(8, 'am', 11, '11:00 am - 12:00 pm', '2017-05-26 22:51:21', '2017-05-26 22:51:21'),
(9, 'pm', 12, '12:00 pm - 1:00 pm', '2017-05-26 22:52:42', '2017-05-26 22:52:42'),
(10, 'pm', 13, '1:00 pm - 2:00 pm', '2017-05-26 22:52:42', '2017-05-26 22:52:42'),
(11, 'pm', 14, '2:00 pm - 3:00 pm', '2017-05-26 22:54:25', '2017-05-26 22:54:25'),
(12, 'pm', 15, '3:00 pm - 4:00 pm', '2017-05-26 22:54:25', '2017-05-26 22:54:25'),
(13, 'pm', 16, '4:00 pm - 5:00 pm', '2017-05-26 22:55:10', '2017-05-26 22:55:10'),
(14, 'pm', 17, '5:00 pm - 6:00 pm', '2017-05-26 22:55:10', '2017-05-26 22:55:10'),
(15, 'eve', 18, '6:00 pm - 7:00 pm', '2017-05-26 22:56:01', '2017-05-26 22:56:01'),
(16, 'eve', 19, '7:00 pm - 8:00 pm', '2017-05-26 22:56:01', '2017-05-26 22:56:01'),
(17, 'eve', 20, '8:00 pm - 9:00 pm', '2017-05-26 22:57:01', '2017-05-26 22:57:01'),
(18, 'eve', 21, '9:00 pm - 10:00 pm', '2017-05-26 22:57:01', '2017-05-26 22:57:01');

-- --------------------------------------------------------

--
-- Table structure for table `tvs`
--

DROP TABLE IF EXISTS `tvs`;
CREATE TABLE `tvs` (
  `tv_id` int(11) NOT NULL COMMENT 'PRIMARY',
  `tv_serial` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tv_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tv_status` tinyint(1) NOT NULL DEFAULT '1',
  `assigned_to` int(11) DEFAULT NULL COMMENT 'FOREIGN',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

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
(1, 'admin', 'Juan', 'Dela Cruz', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, '2017-06-01 15:58:48', '2017-04-09 17:17:02', '2017-06-01 15:58:48', 1),
(2, 'butcher', 'Butch', 'Bituonan', '7329a646f1678ad2ddddbb47a7656c05304b4f5e', 1, '2017-05-02 05:28:11', '2017-05-02 05:27:34', '2017-05-02 05:28:11', 1),
(3, 'nati', 'Nati', 'Kremer', '450ffb252ac1e9db947bbf2a9e091447d37593b1', 1, '2017-05-05 02:26:56', '2017-05-05 02:20:30', '2017-05-05 02:26:56', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE `vehicles` (
  `vehicle_id` int(11) NOT NULL COMMENT 'PRIMARY',
  `vehicle_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `plate_number` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `chassi_number` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sim_number` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_type` int(11) NOT NULL COMMENT 'FOREIGN',
  `vehicle_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = Not deployed , 1 = Deployed , 2 = Not Working',
  `assigned_to` int(11) DEFAULT NULL COMMENT 'FOREIGN',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`vehicle_id`, `vehicle_name`, `plate_number`, `chassi_number`, `sim_number`, `vehicle_description`, `vehicle_type`, `vehicle_status`, `assigned_to`, `created_at`, `updated_at`) VALUES
(1, 'Electric-Powered Bus 005', 'STR 1234', 'CHASSI 145', '092252154122', 'Electric-powered bus', 1, 0, 6, '2017-06-03 02:05:22', '2017-06-25 11:57:34');

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
(1, 'Open Bus', '2017-06-20 16:21:10', '2017-06-20 16:21:26'),
(2, 'Close Bus', '2017-06-20 16:21:10', '2017-06-20 16:21:26'),
(3, 'Open Jeepney', '2017-06-20 16:21:10', '2017-06-20 16:21:26'),
(4, 'Aircon Jeepney', '2017-06-20 16:21:10', '2017-06-20 16:59:12'),
(5, 'Luxury Trike', '2017-06-20 16:21:10', '2017-06-20 16:21:26'),
(6, 'Hybrid Trike', '2017-06-20 16:21:10', '2017-06-20 16:21:26');

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`advertiser_id`);

--
-- Indexes for table `ad_logs`
--
ALTER TABLE `ad_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `agencies`
--
ALTER TABLE `agencies`
  ADD PRIMARY KEY (`agency_id`);

--
-- Indexes for table `airtimes`
--
ALTER TABLE `airtimes`
  ADD PRIMARY KEY (`airtime_id`);

--
-- Indexes for table `card_readers`
--
ALTER TABLE `card_readers`
  ADD PRIMARY KEY (`card_id`);

--
-- Indexes for table `cctvs`
--
ALTER TABLE `cctvs`
  ADD PRIMARY KEY (`cctv_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `deployment`
--
ALTER TABLE `deployment`
  ADD PRIMARY KEY (`deploy_id`);

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
-- Indexes for table `fillers`
--
ALTER TABLE `fillers`
  ADD PRIMARY KEY (`filler_id`);

--
-- Indexes for table `gps`
--
ALTER TABLE `gps`
  ADD PRIMARY KEY (`gps_id`);

--
-- Indexes for table `ip_cameras`
--
ALTER TABLE `ip_cameras`
  ADD PRIMARY KEY (`ipcam_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `mediaboxes`
--
ALTER TABLE `mediaboxes`
  ADD PRIMARY KEY (`box_id`);

--
-- Indexes for table `n_schedules`
--
ALTER TABLE `n_schedules`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_routes`
--
ALTER TABLE `order_routes`
  ADD PRIMARY KEY (`orderroutes_id`);

--
-- Indexes for table `order_slots`
--
ALTER TABLE `order_slots`
  ADD PRIMARY KEY (`orderslot_id`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`play_id`);

--
-- Indexes for table `pos`
--
ALTER TABLE `pos`
  ADD PRIMARY KEY (`pos_id`);

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
-- Indexes for table `salesmen`
--
ALTER TABLE `salesmen`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `tbappdb`
--
ALTER TABLE `tbappdb`
  ADD PRIMARY KEY (`Keyid`);

--
-- Indexes for table `tbappexec`
--
ALTER TABLE `tbappexec`
  ADD PRIMARY KEY (`keyid`);

--
-- Indexes for table `tbappupdate`
--
ALTER TABLE `tbappupdate`
  ADD PRIMARY KEY (`KeyId`);

--
-- Indexes for table `tbdlapplog`
--
ALTER TABLE `tbdlapplog`
  ADD PRIMARY KEY (`keyid`);

--
-- Indexes for table `tbhwdefect`
--
ALTER TABLE `tbhwdefect`
  ADD PRIMARY KEY (`keyid`);

--
-- Indexes for table `tblcconfig`
--
ALTER TABLE `tblcconfig`
  ADD PRIMARY KEY (`keyid`);

--
-- Indexes for table `tbmbinfo`
--
ALTER TABLE `tbmbinfo`
  ADD PRIMARY KEY (`keyid`);

--
-- Indexes for table `tbmbregs`
--
ALTER TABLE `tbmbregs`
  ADD PRIMARY KEY (`keyid`);

--
-- Indexes for table `tbwsconfig`
--
ALTER TABLE `tbwsconfig`
  ADD PRIMARY KEY (`keyid`);

--
-- Indexes for table `timeslots`
--
ALTER TABLE `timeslots`
  ADD PRIMARY KEY (`tslot_id`);

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
-- AUTO_INCREMENT for table `adowner_accounts`
--
ALTER TABLE `adowner_accounts`
  MODIFY `owner_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Ad''s Id ( Primary )', AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `advertisers`
--
ALTER TABLE `advertisers`
  MODIFY `advertiser_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `ad_logs`
--
ALTER TABLE `ad_logs`
  MODIFY `log_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `agencies`
--
ALTER TABLE `agencies`
  MODIFY `agency_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `airtimes`
--
ALTER TABLE `airtimes`
  MODIFY `airtime_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Airtime''s Id ( Primary )';
--
-- AUTO_INCREMENT for table `card_readers`
--
ALTER TABLE `card_readers`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY';
--
-- AUTO_INCREMENT for table `cctvs`
--
ALTER TABLE `cctvs`
  MODIFY `cctv_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY';
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY', AUTO_INCREMENT=104;
--
-- AUTO_INCREMENT for table `deployment`
--
ALTER TABLE `deployment`
  MODIFY `deploy_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY';
--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `feature_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Feature''s Id', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `fillers`
--
ALTER TABLE `fillers`
  MODIFY `filler_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gps`
--
ALTER TABLE `gps`
  MODIFY `gps_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY';
--
-- AUTO_INCREMENT for table `ip_cameras`
--
ALTER TABLE `ip_cameras`
  MODIFY `ipcam_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY';
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY', AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `mediaboxes`
--
ALTER TABLE `mediaboxes`
  MODIFY `box_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY';
--
-- AUTO_INCREMENT for table `n_schedules`
--
ALTER TABLE `n_schedules`
  MODIFY `schedule_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_routes`
--
ALTER TABLE `order_routes`
  MODIFY `orderroutes_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_slots`
--
ALTER TABLE `order_slots`
  MODIFY `orderslot_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `play_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pos`
--
ALTER TABLE `pos`
  MODIFY `pos_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY';
--
-- AUTO_INCREMENT for table `ready_vehicles`
--
ALTER TABLE `ready_vehicles`
  MODIFY `ready_vehicle_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY';
--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `region_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY', AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Role''s Id', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `route_id` int(7) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Route''s Id ( Primary )', AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `salesmen`
--
ALTER TABLE `salesmen`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Schedule''s Id ( Primary )';
--
-- AUTO_INCREMENT for table `tbappdb`
--
ALTER TABLE `tbappdb`
  MODIFY `Keyid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbappexec`
--
ALTER TABLE `tbappexec`
  MODIFY `keyid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbappupdate`
--
ALTER TABLE `tbappupdate`
  MODIFY `KeyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbdlapplog`
--
ALTER TABLE `tbdlapplog`
  MODIFY `keyid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbhwdefect`
--
ALTER TABLE `tbhwdefect`
  MODIFY `keyid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblcconfig`
--
ALTER TABLE `tblcconfig`
  MODIFY `keyid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbmbinfo`
--
ALTER TABLE `tbmbinfo`
  MODIFY `keyid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbmbregs`
--
ALTER TABLE `tbmbregs`
  MODIFY `keyid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbwsconfig`
--
ALTER TABLE `tbwsconfig`
  MODIFY `keyid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `timeslots`
--
ALTER TABLE `timeslots`
  MODIFY `tslot_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tvs`
--
ALTER TABLE `tvs`
  MODIFY `tv_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY';
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'User''s Id', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  MODIFY `vehicle_type_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY', AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
