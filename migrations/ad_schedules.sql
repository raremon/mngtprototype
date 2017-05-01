-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2017 at 11:23 AM
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
-- Table structure for table `ad_schedules`
--

CREATE TABLE `ad_schedules` (
  `ad_id` int(11) NOT NULL COMMENT 'Ad''s Id ( Foreign )',
  `schedule_id` int(11) NOT NULL COMMENT 'Schedule''s Id ( Foreign )',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ad_schedules`
--

INSERT INTO `ad_schedules` (`ad_id`, `schedule_id`, `created_at`, `updated_at`) VALUES
(6, 1, '2017-05-01 09:20:20', '2017-05-01 09:20:20'),
(7, 1, '2017-05-01 09:20:20', '2017-05-01 09:20:20'),
(8, 1, '2017-05-01 09:20:20', '2017-05-01 09:20:20'),
(11, 2, '2017-05-01 09:20:39', '2017-05-01 09:20:39'),
(12, 2, '2017-05-01 09:20:40', '2017-05-01 09:20:40'),
(6, 3, '2017-05-01 09:21:18', '2017-05-01 09:21:18'),
(7, 3, '2017-05-01 09:21:18', '2017-05-01 09:21:18'),
(8, 3, '2017-05-01 09:21:18', '2017-05-01 09:21:18'),
(6, 3, '2017-05-01 09:21:18', '2017-05-01 09:21:18'),
(9, 3, '2017-05-01 09:21:18', '2017-05-01 09:21:18'),
(11, 4, '2017-05-01 09:21:46', '2017-05-01 09:21:46'),
(12, 4, '2017-05-01 09:21:46', '2017-05-01 09:21:46'),
(7, 5, '2017-05-01 09:22:11', '2017-05-01 09:22:11'),
(6, 5, '2017-05-01 09:22:11', '2017-05-01 09:22:11'),
(9, 5, '2017-05-01 09:22:11', '2017-05-01 09:22:11'),
(8, 5, '2017-05-01 09:22:11', '2017-05-01 09:22:11'),
(7, 5, '2017-05-01 09:22:11', '2017-05-01 09:22:11'),
(6, 5, '2017-05-01 09:22:11', '2017-05-01 09:22:11'),
(11, 6, '2017-05-01 09:22:45', '2017-05-01 09:22:45'),
(12, 6, '2017-05-01 09:22:45', '2017-05-01 09:22:45'),
(11, 6, '2017-05-01 09:22:45', '2017-05-01 09:22:45');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
