-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2017 at 01:36 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mngtprototype_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `ad_id` int(11) NOT NULL COMMENT 'Ad''s Id ( Primary )',
  `ad_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ad''s Name',
  `ad_filename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ad''s File Name',
  `advertiser_id` int(11) NOT NULL COMMENT 'Advertiser''s Id ( Foreign )',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`ad_id`, `ad_name`, `ad_filename`, `advertiser_id`, `created_at`, `updated`) VALUES
(1, 'burgerdesal', '1-burgerdesal', 1, '2017-04-29 11:28:52', '2017-04-29 11:28:52'),
(2, 'kayamokayako', '1-kayamokayako', 1, '2017-04-29 11:29:09', '2017-04-29 11:29:09'),
(3, 'tatay ko magaling', '1-tatay ko magaling', 1, '2017-04-29 11:29:21', '2017-04-29 11:29:21'),
(4, 'nakaraan', '1-nakaraan', 1, '2017-04-29 11:29:32', '2017-04-29 11:29:32'),
(5, 'move on na day', '1-move on na day', 1, '2017-04-29 11:29:44', '2017-04-29 11:29:44'),
(6, 'natulala sa sarap', '2-natulala sa sarap', 2, '2017-04-29 11:30:00', '2017-04-29 11:30:00'),
(7, 'patay na ang pizza', '2-patay na ang pizza', 2, '2017-04-29 11:30:15', '2017-04-29 11:30:57'),
(8, 'sisig rice', '2-sisig rice', 2, '2017-04-29 11:30:26', '2017-04-29 11:30:57'),
(9, 'namigay ng sarap', '2-namigay ng sarap', 2, '2017-04-29 11:31:58', '2017-04-29 11:31:58'),
(10, 'discount', '2-discount', 2, '2017-04-29 11:32:09', '2017-04-29 11:33:09'),
(11, 'the toppings are on top', '3-the toppings are on top', 3, '2017-04-29 11:32:25', '2017-04-29 11:33:09'),
(12, 'naghanap si angel', '3-naghanap si angel', 3, '2017-04-29 11:33:57', '2017-04-29 11:33:57'),
(13, 'galit galit muna', '3-galit galit muna', 3, '2017-04-29 11:34:13', '2017-04-29 11:34:13'),
(14, 'pagtapos ng gera', '3-pagtapos ng gera', 3, '2017-04-29 11:34:28', '2017-04-29 11:34:28'),
(15, 'matatakaw sa mang inasal', '3-matatakaw sa mang inasal', 3, '2017-04-29 11:34:42', '2017-04-29 11:34:42');

-- --------------------------------------------------------

--
-- Table structure for table `advertisers`
--

CREATE TABLE `advertisers` (
  `advertiser_id` int(11) NOT NULL COMMENT 'Advertiser''s Id ( Primary )',
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
(1, 'McDonalds', '16th Floor Citibank Center Bldg. 8741 Paseo de Roxas St. ,Makati City', '02-8635490', 'writeus@ph.mcd.com', 'Our Chairman and Founder, George T. Yang, built the first Golden Arches in the Philippines in 1981. From our first restaurant along Morayta in Manila, we are happy to welcome you in our 375 restaurants nationwide. \r\n\r\nWith Kenneth S. Yang as the President & CEO and with over 27,000 dedicated employees and crew members, we remain committed in growing and innovating products and services for you.\r\n\r\nAnd with our Chief Happiness Officer, Ronald McDonald, we always aim to spread happiness to communities and to have fun with you guys!!', '2017-04-24 17:27:58', '2017-04-29 11:21:54'),
(2, 'KFC', '80-82 A Ramcar Roces Avenue\r\nQuezon City, Philippines', '887-8888', 'contactus@kfc.com', 'entucky Fried Chicken owes its delicious history to Harland David Sanders, its founder who is fondly referred to as “The Colonel”. Upon perfection of the Original Recipe that makes use of 11 secret herbs and spices, Colonel Sanders has brought the ultimate delight of chicken lovers to the world.\r\n\r\nKFC Corporation Philippines is the home of finger lickin’ goodness in the country, serving its range of world-famous dishes and sides to Filipinos.', '2017-04-24 17:29:19', '2017-04-24 17:29:19'),
(3, 'Mang Inasal', 'Mandaluyong City 1550, Philippines', '724 1111', 'feedback@manginasal.com', 'It is our aim not just to deliver high-quality meals but to serve the Alagang Pinoy way. We serve our customers with puso - by always making them our first priority in ways that connect to our customers. \r\n\r\nIn Mang Inasal, FSC is our way of life. And it is the reason why we are still in business today.', '2017-04-24 17:35:14', '2017-04-24 17:35:14');

-- --------------------------------------------------------

--
-- Table structure for table `ad_schedules`
--

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

CREATE TABLE `airtimes` (
  `airtime_id` int(11) NOT NULL COMMENT 'Airtime''s Id ( Primary )',
  `time_start` time NOT NULL COMMENT 'Time Start',
  `time_end` time NOT NULL COMMENT 'Time End',
  `schedule_id` int(11) NOT NULL COMMENT 'Schedule''s Id ( Foreign )',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `buses`
--

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
(1, 'Bus 001', 'PAP-IUAQ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', 16, 4, '2017-04-08 13:26:28', '2017-04-26 08:04:11');

-- --------------------------------------------------------

--
-- Table structure for table `bus_type`
--

CREATE TABLE `bus_type` (
  `bus_type_id` int(7) UNSIGNED NOT NULL COMMENT 'Bus Type''s Id ( Primary )',
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
-- Table structure for table `features`
--

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
(1, 2, '2017-04-09 17:23:20', '2017-04-09 17:23:20');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

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
(2, 'Ad Manager', 'Manages Ads', '2017-04-18 19:29:48', '2017-04-18 19:29:48');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `route_id` int(7) UNSIGNED NOT NULL COMMENT 'Route''s Id ( Primary )',
  `route_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Route''s Name',
  `route_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Route''s Description',
  `terminal_from` int(7) UNSIGNED NOT NULL COMMENT 'Id of first terminal ( Foreign )',
  `terminal_to` int(7) UNSIGNED NOT NULL COMMENT 'Id of second terminal ( Foreign )',
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
(6, 'High School Recreational Trip', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 5, 4, '2017-04-24 17:24:52', '2017-04-24 17:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `schedule_id` int(11) NOT NULL COMMENT 'Schedule''s Id ( Primary )',
  `route_id` int(11) NOT NULL COMMENT 'Route''s Id ( Foreign )',
  `date_start` date NOT NULL COMMENT 'Date Start',
  `date_end` date NOT NULL COMMENT 'Date End',
  `schedule_type` int(11) NOT NULL COMMENT 'Schedule''s Type ( 1:Normal ; 2:Scheduled ; 3:Blocked )',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `terminals`
--

CREATE TABLE `terminals` (
  `terminal_id` int(7) UNSIGNED NOT NULL COMMENT 'Terminal ID ( Primary )',
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
(8, 'Salubungan', '14.42002963887672900000', '121.46303230307615000000', '2017-04-23 08:26:09', '2017-04-24 17:21:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'User''s Id ( Primary )',
  `user_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Username',
  `user_fname` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'First Name',
  `user_lname` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Last Name',
  `user_password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Password',
  `user_role` int(11) NOT NULL COMMENT 'Role Id ( Foreign )',
  `is_online` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = False (default) ; 1 = True',
  `user_lastlogin` timestamp NULL DEFAULT NULL COMMENT 'Last Login Timestamp',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_fname`, `user_lname`, `user_password`, `user_role`, `is_online`, `user_lastlogin`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'cee jay', 'reyes', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 1, '2017-04-28 12:41:55', '2017-04-09 17:17:02', '2017-04-28 12:41:55'),
(2, 'hexxableyd', 'Dennis', 'de Leon', '88ea39439e74fa27c09a4fc0bc8ebe6d00978392', 2, 0, '2017-04-28 12:40:29', '2017-04-09 17:17:02', '2017-04-28 12:40:29');

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
-- Indexes for table `airtimes`
--
ALTER TABLE `airtimes`
  ADD PRIMARY KEY (`airtime_id`);

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
-- Indexes for table `bus_type`
--
ALTER TABLE `bus_type`
  ADD PRIMARY KEY (`bus_type_id`),
  ADD UNIQUE KEY `bus_type_id_2` (`bus_type_id`),
  ADD KEY `bus_type_id` (`bus_type_id`);

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
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Ad''s Id ( Primary )', AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `advertisers`
--
ALTER TABLE `advertisers`
  MODIFY `advertiser_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Advertiser''s Id ( Primary )', AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `airtimes`
--
ALTER TABLE `airtimes`
  MODIFY `airtime_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Airtime''s Id ( Primary )';
--
-- AUTO_INCREMENT for table `buses`
--
ALTER TABLE `buses`
  MODIFY `bus_id` int(7) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Bus'' Id ( Primary )', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bus_type`
--
ALTER TABLE `bus_type`
  MODIFY `bus_type_id` int(7) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Bus Type''s Id ( Primary )', AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `feature_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Feature''s Id', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Role''s Id', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `route_id` int(7) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Route''s Id ( Primary )', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Schedule''s Id ( Primary )';
--
-- AUTO_INCREMENT for table `terminals`
--
ALTER TABLE `terminals`
  MODIFY `terminal_id` int(7) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Terminal ID ( Primary )', AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'User''s Id ( Primary )', AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
