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
-- Table structure for table `airtimes`
--

CREATE TABLE `airtimes` (
  `airtime_id` int(11) NOT NULL COMMENT 'Airtime''s Id ( Primary )',
  `time_start` time NOT NULL COMMENT 'Time Start',
  `time_end` time DEFAULT NULL COMMENT 'Time End',
  `schedule_id` int(11) NOT NULL COMMENT 'Schedule''s Id ( Foreign )',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `airtimes`
--

INSERT INTO `airtimes` (`airtime_id`, `time_start`, `time_end`, `schedule_id`, `created_at`, `updated_at`) VALUES
(1, '19:30:00', NULL, 2, '2017-05-01 09:20:40', '2017-05-01 09:20:40'),
(2, '16:45:00', '18:30:00', 3, '2017-05-01 09:21:18', '2017-05-01 09:21:18'),
(3, '10:00:00', '19:00:00', 3, '2017-05-01 09:21:18', '2017-05-01 09:21:18'),
(4, '22:45:00', NULL, 5, '2017-05-01 09:22:11', '2017-05-01 09:22:11'),
(5, '06:15:00', '17:30:00', 6, '2017-05-01 09:22:45', '2017-05-01 09:22:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airtimes`
--
ALTER TABLE `airtimes`
  ADD PRIMARY KEY (`airtime_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airtimes`
--
ALTER TABLE `airtimes`
  MODIFY `airtime_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Airtime''s Id ( Primary )', AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
