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
-- Table structure for table `time_blocks`
--

CREATE TABLE `time_blocks` (
  `time_block_id` int(11) NOT NULL COMMENT 'Time Block Id ( Primary )',
  `time_start` time NOT NULL COMMENT 'Time Start',
  `time_end` time NOT NULL COMMENT 'Time End',
  `advertiser_id` int(11) NOT NULL COMMENT 'Advertiser Id ( Foreign )',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_blocks`
--

INSERT INTO `time_blocks` (`time_block_id`, `time_start`, `time_end`, `advertiser_id`, `created_at`, `updated_at`) VALUES
(1, '12:00:00', '18:00:00', 1, '2017-05-01 07:42:58', '2017-05-01 07:42:58'),
(8, '16:45:00', '18:30:00', 1, '2017-05-01 07:55:25', '2017-05-01 07:55:25'),
(9, '16:45:00', '18:30:00', 2, '2017-05-01 08:04:26', '2017-05-01 08:04:26'),
(10, '16:00:00', '16:00:00', 1, '2017-05-01 08:11:33', '2017-05-01 08:11:33'),
(11, '17:00:00', '16:00:00', 1, '2017-05-01 08:14:16', '2017-05-01 08:14:16'),
(12, '15:00:00', '16:00:00', 1, '2017-05-01 08:14:37', '2017-05-01 08:14:37'),
(13, '18:00:00', '16:00:00', 1, '2017-05-01 08:14:46', '2017-05-01 08:14:46'),
(14, '10:00:00', '19:00:00', 2, '2017-05-01 09:21:06', '2017-05-01 09:21:06'),
(15, '23:15:00', '17:15:00', 3, '2017-05-01 09:22:27', '2017-05-01 09:22:27'),
(16, '06:15:00', '17:30:00', 3, '2017-05-01 09:22:38', '2017-05-01 09:22:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `time_blocks`
--
ALTER TABLE `time_blocks`
  ADD PRIMARY KEY (`time_block_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `time_blocks`
--
ALTER TABLE `time_blocks`
  MODIFY `time_block_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Time Block Id ( Primary )', AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
