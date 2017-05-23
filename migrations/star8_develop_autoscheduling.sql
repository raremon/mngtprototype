-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2017 at 08:01 PM
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
(1, 'Kaya Niya, Kaya Mo', '1-Kaya_Niya,_Kaya_Mo.mp4', 78, 1, '2017-05-21 14:31:43', '2017-05-21 14:31:43'),
(2, 'Cool Summer with MayWard', '1-Cool_Summer_with_MayWard.mp4', 49, 1, '2017-05-21 14:32:41', '2017-05-21 14:32:41'),
(3, 'No to Teenage Pregnancy', '2-No_to_Teenage_Pregnancy.mp4', 34, 2, '2017-05-23 15:16:49', '2017-05-23 15:16:49'),
(4, 'No to Smoking', '2-No_to_Smoking.mp4', 38, 2, '2017-05-23 15:25:29', '2017-05-23 15:25:29'),
(5, 'Hand Washing Steps', '2-Hand_Washing_Steps.mp4', 105, 2, '2017-05-23 15:27:59', '2017-05-23 15:27:59');

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

--
-- Dumping data for table `advertisers`
--

INSERT INTO `advertisers` (`advertiser_id`, `advertiser_name`, `advertiser_address`, `advertiser_contact`, `advertiser_email`, `advertiser_website`, `advertiser_image`, `advertiser_description`, `created_at`, `updated_at`) VALUES
(1, 'McDo Philippines', 'Makati City, Philippines', '123-4567', 'info@mcdonalds.com.ph', 'https://www.mcdonalds.com.ph', 'McDo_Philippines.png', 'McDonald\'s (or simply McD or Micky D\'s) is an American hamburger and fast food restaurant chain. It was founded in 1940 as a barbecue restaurant operated by Richard and Maurice McDonald. In 1948, they reorganized their business as a hamburger stand, using production line principles. The first McDonald\'s franchise using the arches logo opened in Phoenix, Arizona in 1953. ', '2017-05-21 14:27:34', '2017-05-21 14:27:34'),
(2, 'Department of Health', 'Manila, Philippines', '+63-2 1234567', 'info@doh.gov.ph', 'http://www.doh.gov.ph/', 'Department_of_Health.png', 'The Philippine Department of Health (abbreviated as DOH; Filipino: Kagawaran ng Kalusugan) is the executive department of the Philippine government responsible for ensuring access to basic public health services by all Filipinos through the provision of quality health care and the regulation of all health services and products. It is the government\'s over-all technical authority on health.[2] It has its headquarters at the San Lazaro Compound, along Rizal Avenue in Manila.', '2017-05-23 15:04:10', '2017-05-23 15:04:10');

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
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fillers`
--

INSERT INTO `fillers` (`filler_id`, `filler_title`, `filler_description`, `filler_type`, `filler_file`, `filler_duration`, `created_at`, `updated`) VALUES
(1, 'Star8 Solar Powered Electric Tricycle - Teaser', 'Video demonstrating Star8 Solar Powered Electric Tricycle', 1, 'Star8TricycleTeaser.mp4', 82, '2017-05-21 22:42:31', '2017-05-21 22:42:31'),
(2, 'Star8 Products', 'Some of Star8 products include: Solar Tuk, Solar Bus, Solat Scooter, Solar Glass, Flexible Solar, and Solar Light.', 2, 'Star8Solar.png', 40, '2017-05-21 22:45:26', '2017-05-21 22:45:26');

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
  `timeslot` int(2) NOT NULL COMMENT '0=12-1am;1=1-2am;7=7-8am;etc',
  `times_repeat` int(3) NOT NULL COMMENT 'no. of times ad wil repeat in an hour',
  `display_type` int(1) NOT NULL COMMENT '1=normal;2=split;3=star8',
  `win_123` int(1) NOT NULL COMMENT 'if display_type is 2 or split, win1=bigger, win2=window on top right; win3=window on bottom right',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL COMMENT '0=unscheduled;1=scheduled'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `n_schedules`
--

INSERT INTO `n_schedules` (`schedule_id`, `ad_id`, `date_start`, `date_end`, `timeslot`, `times_repeat`, `display_type`, `win_123`, `created_at`, `updated`, `status`) VALUES
(1, 1, '2017-05-10', '2017-06-10', 8, 4, 1, 0, '2017-05-21 22:59:19', '2017-05-21 22:59:19', 0),
(2, 2, '2017-05-10', '2017-06-10', 8, 4, 1, 0, '2017-05-21 23:02:05', '2017-05-21 23:02:05', 0),
(3, 3, '2017-05-10', '2017-06-10', 8, 3, 2, 1, '2017-05-23 23:30:35', '2017-05-23 23:30:35', 0),
(4, 4, '2017-05-10', '2017-06-10', 8, 3, 2, 2, '2017-05-23 23:30:59', '2017-05-23 23:30:59', 0),
(5, 5, '2017-05-10', '2017-06-10', 8, 3, 2, 3, '2017-05-23 23:31:52', '2017-05-23 23:31:52', 0),
(6, 1, '2017-05-10', '2017-06-10', 18, 4, 1, 0, '2017-05-24 00:12:51', '2017-05-24 00:12:51', 0),
(7, 2, '2017-05-10', '2017-06-10', 18, 4, 1, 0, '2017-05-24 00:13:36', '2017-05-24 00:13:36', 0),
(8, 3, '2017-05-10', '2017-06-10', 18, 3, 2, 1, '2017-05-24 00:14:04', '2017-05-24 00:14:04', 0),
(9, 4, '2017-05-10', '2017-06-10', 18, 3, 2, 2, '2017-05-24 00:15:30', '2017-05-24 00:15:30', 0),
(10, 5, '2017-05-10', '2017-06-10', 18, 3, 2, 3, '2017-05-24 00:16:40', '2017-05-24 00:16:40', 0);

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
  `location_from` int(7) UNSIGNED NOT NULL COMMENT 'Id of first city ( Foreign )',
  `location_to` int(7) UNSIGNED NOT NULL COMMENT 'Id of second city ( Foreign )',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`route_id`, `route_name`, `route_description`, `location_from`, `location_to`, `created_at`, `updated_at`) VALUES
(1, 'EDSA Taft - Mall of Asia', 'EDSA Taft to Mall of Asia', 2, 1, '2017-05-21 15:14:40', '2017-05-21 15:14:40');

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
-- Indexes for table `fillers`
--
ALTER TABLE `fillers`
  ADD PRIMARY KEY (`filler_id`);

--
-- Indexes for table `n_routeschedules`
--
ALTER TABLE `n_routeschedules`
  ADD PRIMARY KEY (`play_id`);

--
-- Indexes for table `n_schedules`
--
ALTER TABLE `n_schedules`
  ADD PRIMARY KEY (`schedule_id`);

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
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Ad''s Id ( Primary )', AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `advertisers`
--
ALTER TABLE `advertisers`
  MODIFY `advertiser_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Advertiser''s Id ( Primary )', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `fillers`
--
ALTER TABLE `fillers`
  MODIFY `filler_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `n_routeschedules`
--
ALTER TABLE `n_routeschedules`
  MODIFY `play_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `n_schedules`
--
ALTER TABLE `n_schedules`
  MODIFY `schedule_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `region_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY', AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `route_id` int(7) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Route''s Id ( Primary )', AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
