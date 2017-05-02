-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2017 at 11:24 AM
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
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `schedule_id` int(11) NOT NULL COMMENT 'Schedule''s Id ( Primary )',
  `advertiser_id` int(11) NOT NULL COMMENT 'Advertiser''s Id ( Foreign )',
  `route_id` int(11) NOT NULL COMMENT 'Route''s Id ( Foreign )',
  `date_start` date NOT NULL COMMENT 'Date Start',
  `date_end` date NOT NULL COMMENT 'Date End',
  `schedule_type` int(11) NOT NULL COMMENT 'Schedule''s Type ( 1:Normal ; 2:Scheduled ; 3:Blocked )',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`schedule_id`, `advertiser_id`, `route_id`, `date_start`, `date_end`, `schedule_type`, `created_at`, `updated_at`) VALUES
(1, 2, 4, '2017-05-03', '2017-06-23', 1, '2017-05-01 09:20:20', '2017-05-01 09:20:20'),
(2, 3, 3, '2017-05-05', '2017-06-07', 2, '2017-05-01 09:20:39', '2017-05-01 09:20:39'),
(3, 2, 6, '2017-05-05', '2017-05-13', 3, '2017-05-01 09:21:18', '2017-05-01 09:21:18'),
(4, 3, 2, '2017-05-05', '2017-05-12', 1, '2017-05-01 09:21:45', '2017-05-01 09:21:45'),
(5, 2, 3, '2017-05-03', '2017-06-05', 2, '2017-05-01 09:22:11', '2017-05-01 09:22:11'),
(6, 3, 2, '2017-05-01', '2017-05-01', 3, '2017-05-01 09:22:45', '2017-05-01 09:22:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`schedule_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Schedule''s Id ( Primary )', AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
