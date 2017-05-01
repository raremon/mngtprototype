-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2017 at 07:10 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `star8`
--
-- CREATE DATABASE IF NOT EXISTS `star8_develop` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
-- USE `star8_develop`;

-- --------------------------------------------------------

--
-- Table structure for table `ad_sched`
--

DROP TABLE IF EXISTS `ad_sched`;
CREATE TABLE `ad_sched` (
  `ad_id` int(10) NOT NULL,
  `schedID` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ad_sched`
--

INSERT INTO `ad_sched` (`ad_id`, `schedID`) VALUES
(1, 1),
(2, 1),
(4, 1),
(5, 1),
(6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

DROP TABLE IF EXISTS `ads`;
CREATE TABLE `ads` (
  `ad_id` int(11) NOT NULL COMMENT 'Ad''s Id',
  `ad_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ad''s File Name',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ad_filename` varchar(255) NOT NULL,
  `advertiser_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`ad_id`, `ad_name`, `created_at`, `updated`, `ad_filename`, `advertiser_id`) VALUES
(1, 'Check the Label Mommy - Nido', '2017-04-27 02:48:52', '2017-04-27 02:49:22', 'nido1.mp4', 1),
(2, 'Nido Forti-Choco', '2017-04-27 02:53:16', '2017-04-27 02:53:16', 'nido2.mp4', 1),
(4, 'Nestea OK!', '2017-04-27 03:00:37', '2017-04-27 03:00:37', 'nestea1.mp4', 1),
(5, 'Milo Beat Energy Gap', '2017-04-27 03:01:33', '2017-04-27 03:01:33', 'milo1.mp4', 1),
(6, 'McDo - Kaya Niya, Kaya Mo', '2017-04-27 04:09:12', '2017-04-27 04:09:12', 'mcdo1.mp4', 2);

-- --------------------------------------------------------

--
-- Table structure for table `advertisers`
--

DROP TABLE IF EXISTS `advertisers`;
CREATE TABLE `advertisers` (
  `advertiser_id` int(11) NOT NULL COMMENT 'Advertiser''s Id',
  `advertiser_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Advertiser''s Name',
  `advertiser_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Advertiser''s Address',
  `advertiser_contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Advertiser''s Contact Details',
  `advertiser_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Advertiser''s Email',
  `advertiser_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Advertiser''s Description',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `advertisers`
--

INSERT INTO `advertisers` (`advertiser_id`, `advertiser_name`, `advertiser_address`, `advertiser_contact`, `advertiser_email`, `advertiser_description`, `created_at`, `updated_at`) VALUES
(1, 'Nestle Philippines', 'Makati, Philippines', '+632 3013001 loc. 100', 'nestlegroup@nestle.com.ph', 'Nestle Philippines', '2017-04-27 02:43:40', '2017-04-27 02:55:59'),
(2, 'McDonald\'s Philippines', '16th Floor Citibank Center Bldg. 8741 Paseo de Roxas St., Makati City, Philippines', '02-8635490', 'mcdo@mcdonalds.com.ph', 'McDonald\'s (or simply as McDo) is an American hamburger and fast food restaurant chain. It was founded in 1940 as a barbecue restaurant operated by Richard and Maurice McDonald. ', '2017-04-27 03:56:27', '2017-04-27 03:56:27');

-- --------------------------------------------------------

--
-- Table structure for table `airtime`
--

DROP TABLE IF EXISTS `airtime`;
CREATE TABLE `airtime` (
  `airID` int(15) NOT NULL,
  `sTime` time NOT NULL,
  `eTime` time NOT NULL,
  `schedID` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `airtime`
--

INSERT INTO `airtime` (`airID`, `sTime`, `eTime`, `schedID`) VALUES
(1, '06:00:00', '08:00:00', 1),
(2, '11:00:00', '12:00:00', 1),
(3, '17:00:00', '18:00:00', 1),
(4, '08:00:00', '00:00:00', 2),
(5, '05:30:00', '00:00:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

DROP TABLE IF EXISTS `bus`;
CREATE TABLE `bus` (
  `bus_id` int(5) NOT NULL,
  `bus_plateno` varchar(20) NOT NULL,
  `bus_type` varchar(100) NOT NULL,
  `bus_location` varchar(100) NOT NULL,
  `route_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`bus_id`, `bus_plateno`, `bus_type`, `bus_location`, `route_id`) VALUES
(1, 'STR 1234', 'E-Bus', 'EDSA ', 7);

-- --------------------------------------------------------

--
-- Table structure for table `bus_type`
--

DROP TABLE IF EXISTS `bus_type`;
CREATE TABLE `bus_type` (
  `bus_type_id` int(7) UNSIGNED NOT NULL COMMENT 'Bus Type''s Id',
  `bus_type_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Bus Type''s Name',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `bus_type`
--

INSERT INTO `bus_type` (`bus_type_id`, `bus_type_name`, `created_at`, `updated_at`) VALUES
(11, 'Sun Bus ( 35 pax )', '2017-04-05 22:18:55', '2017-04-06 18:34:21'),
(12, 'City Bus ( 20 pax )', '2017-04-05 22:18:55', '2017-04-05 22:18:55'),
(13, 'City Bus ( 14 pax )', '2017-04-05 22:18:55', '2017-04-05 22:18:55'),
(14, 'Jeepney ( 20 pax )', '2017-04-05 22:18:55', '2017-04-05 22:18:55'),
(15, 'LimoTuk ( 11 pax )', '2017-04-05 22:18:55', '2017-04-05 22:18:55'),
(16, 'FG Hybrid Tuk Tuk ( 6 pax )', '2017-04-05 22:18:55', '2017-04-05 22:18:55'),
(17, 'W5 Tuk Tuk ( 5 pax )', '2017-04-05 22:18:55', '2017-04-05 22:18:55'),
(18, 'Revolution ( 5 pax )', '2017-04-05 22:18:55', '2017-04-05 22:18:55'),
(19, 'Solar Car ( 4 pax )', '2017-04-05 22:18:55', '2017-04-05 22:18:55'),
(20, 'E-Van Passenger ( 7-11 pax )', '2017-04-05 22:18:55', '2017-04-05 22:18:55');

-- --------------------------------------------------------

--
-- Table structure for table `buses`
--

DROP TABLE IF EXISTS `buses`;
CREATE TABLE `buses` (
  `bus_id` int(7) UNSIGNED NOT NULL COMMENT 'Bus'' Id ( Primary )',
  `bus_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Bus'' Name',
  `plate_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Bus'' Plate Number',
  `bus_desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Bus'' Description',
  `bus_type` int(7) UNSIGNED NOT NULL COMMENT 'Bus'' Type ( Foreign )',
  `route_id` int(11) NOT NULL COMMENT 'Bus'' Route ( foreign )',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`bus_id`, `bus_name`, `plate_number`, `bus_desc`, `bus_type`, `route_id`, `created_at`, `updated_at`) VALUES
(1, 'Bus 001', 'PAP-IUAQ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', 16, 7, '2017-04-08 13:26:28', '2017-04-27 04:32:24');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `client_id` int(5) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_address` text NOT NULL,
  `client_contact` text NOT NULL,
  `client_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 2, '2017-04-09 17:23:20', '2017-04-09 17:23:20');

-- --------------------------------------------------------

--
-- Table structure for table `programming`
--

DROP TABLE IF EXISTS `programming`;
CREATE TABLE `programming` (
  `prog_id` int(6) NOT NULL,
  `prog_name` int(11) NOT NULL,
  `prog_dcreated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

DROP TABLE IF EXISTS `programs`;
CREATE TABLE `programs` (
  `program_id` int(11) NOT NULL COMMENT 'Program''s Id',
  `ad_id` int(11) NOT NULL COMMENT 'Ad''s Id ( Foreign )',
  `route_id` int(11) NOT NULL COMMENT 'Route''s Id ( Foreign )',
  `advertiser_id` int(11) NOT NULL COMMENT 'Advertiser''s Id ( Foreign )',
  `program_start` date NOT NULL COMMENT 'Date of the start of program',
  `program_end` date NOT NULL COMMENT 'Date of the end of program',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`program_id`, `ad_id`, `route_id`, `advertiser_id`, `program_start`, `program_end`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, '2017-04-25', '2017-04-29', '2017-04-24 18:47:10', '2017-04-24 18:47:10'),
(2, 2, 2, 1, '2017-04-21', '2017-04-26', '2017-04-24 18:47:10', '2017-04-24 18:47:10'),
(3, 6, 2, 2, '2017-04-24', '2017-05-26', '2017-04-24 18:47:10', '2017-04-24 18:47:10'),
(4, 2, 2, 1, '2017-04-24', '2017-04-27', '2017-04-24 18:47:10', '2017-04-24 18:47:10');

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
(1, 'Admin', 'S/he can govern through the whole web application. Has all privileges.', '2017-04-09 17:19:10', '2017-04-09 17:19:10');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

DROP TABLE IF EXISTS `routes`;
CREATE TABLE `routes` (
  `route_id` int(7) UNSIGNED NOT NULL COMMENT 'Route''s Id',
  `route_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Route''s Name',
  `route_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Route''s Description',
  `terminal_from` int(7) UNSIGNED NOT NULL COMMENT 'Id of first terminal',
  `terminal_to` int(7) UNSIGNED NOT NULL COMMENT 'Id of second terminal',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`route_id`, `route_name`, `route_description`, `terminal_from`, `terminal_to`, `created_at`, `updated_at`) VALUES
(2, 'Turista Package 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 1, 6, '2017-04-24 17:22:50', '2017-04-24 17:22:50'),
(3, 'San Cee Jay Field Trip', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 2, 4, '2017-04-24 17:23:27', '2017-04-24 17:23:27'),
(4, 'Tondo to PNU', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 6, 7, '2017-04-24 17:23:59', '2017-04-24 17:23:59'),
(5, 'Salubungan to Cebu Oversea', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 8, 2, '2017-04-24 17:24:22', '2017-04-24 17:24:22'),
(6, 'High School Recreational Trip', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 5, 4, '2017-04-24 17:24:52', '2017-04-24 17:24:52'),
(7, 'EDSA to MOA', 'EDSA MRT Taft Station to Mall of Asia', 9, 10, '2017-04-27 03:07:40', '2017-04-27 03:07:40');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
CREATE TABLE `schedules` (
  `schedID` int(15) NOT NULL,
  `route_id` int(10) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `advertiser_id` int(10) NOT NULL,
  `schedType` int(1) NOT NULL COMMENT '1=Normal;2=Scheduled;3=Blocked'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`schedID`, `route_id`, `date_start`, `date_end`, `advertiser_id`, `schedType`) VALUES
(1, 7, '2017-04-24', '2017-05-24', 1, 3),
(2, 7, '2017-04-25', '2017-05-31', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `terminals`
--

DROP TABLE IF EXISTS `terminals`;
CREATE TABLE `terminals` (
  `terminal_id` int(7) UNSIGNED NOT NULL COMMENT 'Terminal ID',
  `terminal_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Terminal Name',
  `latitude` decimal(27,20) NOT NULL COMMENT 'Latitude Value on Google Map',
  `longitude` decimal(27,20) NOT NULL COMMENT 'Longitude Value on Google Map',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terminals`
--

INSERT INTO `terminals` (`terminal_id`, `terminal_name`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, 'Puregold Head Office', '14.58671917073496000000', '120.98741227171934000000', '2017-04-08 10:35:12', '2017-04-23 06:23:01'),
(2, 'Cebu Oversea', '14.58932529323732000000', '120.98706894896543000000', '2017-04-08 10:50:48', '2017-04-08 12:38:37'),
(3, 'Unilevel Ph', '14.58660023395050800000', '120.99224372883600000000', '2017-04-08 10:59:47', '2017-04-08 12:39:03'),
(4, 'Intra Golf Club', '14.58414416680946600000', '120.97656541846311000000', '2017-04-08 11:05:03', '2017-04-08 11:05:03'),
(5, 'Manila High School', '14.58899304029157000000', '120.97833567641294000000', '2017-04-09 08:16:57', '2017-04-09 08:16:57'),
(6, 'Tondo', '14.63038392862019600000', '120.97470758241730000000', '2017-04-09 08:17:38', '2017-04-24 17:21:14'),
(7, 'Philippine Normal University - Manila', '14.58775747024978700000', '120.98308855078733000000', '2017-04-09 08:46:26', '2017-04-24 17:21:14'),
(8, 'Salubungan', '14.42002963887672900000', '121.46303230307615000000', '2017-04-23 08:26:09', '2017-04-24 17:21:14'),
(9, 'EDSA Taft MRT Station', '14.61168000000000000000', '121.05463700000000000000', '2017-04-27 03:05:03', '2017-04-27 03:05:03'),
(10, 'Mall of Asia', '14.53505800000000000000', '120.98213200000000000000', '2017-04-27 03:06:50', '2017-04-27 03:06:50');

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
(1, 'admin', 'cee jay', 'reyes', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, '2017-04-26 01:16:01', '2017-04-09 17:17:02', '2017-04-26 01:16:01', 1);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `airtime`
--
ALTER TABLE `airtime`
  ADD PRIMARY KEY (`airID`);

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`bus_id`);

--
-- Indexes for table `bus_type`
--
ALTER TABLE `bus_type`
  ADD PRIMARY KEY (`bus_type_id`),
  ADD UNIQUE KEY `bus_type_id_2` (`bus_type_id`),
  ADD KEY `bus_type_id` (`bus_type_id`);

--
-- Indexes for table `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`bus_id`),
  ADD UNIQUE KEY `bus_id_3` (`bus_id`),
  ADD KEY `bus_id` (`bus_id`),
  ADD KEY `bus_id_2` (`bus_id`),
  ADD KEY `bus_id_4` (`bus_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`feature_id`),
  ADD UNIQUE KEY `feature_id` (`feature_id`);

--
-- Indexes for table `privileges`
--
ALTER TABLE `privileges`
  ADD KEY `role_id` (`role_id`),
  ADD KEY `feature_id` (`feature_id`);

--
-- Indexes for table `programming`
--
ALTER TABLE `programming`
  ADD PRIMARY KEY (`prog_id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`program_id`);

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
  ADD PRIMARY KEY (`schedID`);

--
-- Indexes for table `terminals`
--
ALTER TABLE `terminals`
  ADD PRIMARY KEY (`terminal_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `user_id_2` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Ad''s Id', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `advertisers`
--
ALTER TABLE `advertisers`
  MODIFY `advertiser_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Advertiser''s Id', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `airtime`
--
ALTER TABLE `airtime`
  MODIFY `airID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `bus_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bus_type`
--
ALTER TABLE `bus_type`
  MODIFY `bus_type_id` int(7) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Bus Type''s Id', AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `buses`
--
ALTER TABLE `buses`
  MODIFY `bus_id` int(7) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Bus'' Id ( Primary )', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `feature_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Feature''s Id', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `programming`
--
ALTER TABLE `programming`
  MODIFY `prog_id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Program''s Id', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Role''s Id', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `route_id` int(7) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Route''s Id', AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `terminals`
--
ALTER TABLE `terminals`
  MODIFY `terminal_id` int(7) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Terminal ID', AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'User''s Id', AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
