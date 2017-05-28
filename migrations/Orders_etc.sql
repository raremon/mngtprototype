-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2017 at 04:41 PM
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
  `date_end` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `sales_id`, `ad_duration`, `advertiser_id`, `created_at`, `updated`, `ad_id`, `order_status`, `status_date`, `date_start`, `date_end`) VALUES
(1, '2017-05-26 23:27:24', 1, 90, 1, '2017-05-26 23:27:24', '2017-05-26 23:27:24', 0, 0, '2017-05-26 23:31:42', '2017-05-26', '2017-06-27');

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
  `display_type` int(1) NOT NULL COMMENT '1=normal, 2=split, 3=star8'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_slots`
--

INSERT INTO `order_slots` (`orderslot_id`, `order_id`, `tslot_id`, `display_type`) VALUES
(1, 1, 5, 1),
(2, 1, 15, 1);

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
(8, 'am', 11, '11:00 am - 12:00 am', '2017-05-26 22:51:21', '2017-05-26 22:51:21'),
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

--
-- Indexes for dumped tables
--

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
-- Indexes for table `timeslots`
--
ALTER TABLE `timeslots`
  ADD PRIMARY KEY (`tslot_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `order_routes`
--
ALTER TABLE `order_routes`
  MODIFY `orderroutes_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_slots`
--
ALTER TABLE `order_slots`
  MODIFY `orderslot_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `timeslots`
--
ALTER TABLE `timeslots`
  MODIFY `tslot_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
