-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2017 at 07:27 PM
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
-- Table structure for table `n_schedules`
--

DROP TABLE IF EXISTS `n_schedules`;
CREATE TABLE `n_schedules` (
  `schedule_id` int(10) NOT NULL,
  `ad_id` int(10) NOT NULL,
  `paid_duration` int(4) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date DEFAULT NULL,
  `timeslot` int(2) NOT NULL COMMENT '0=12-1am;1=1-2am;7=7-8am;etc',
  `times_repeat` int(3) NOT NULL COMMENT 'no. of times ad wil repeat in an hour',
  `display_type` int(1) NOT NULL COMMENT '1=normal;2=split;3=star8',
  `win_123` int(1) NOT NULL COMMENT 'if display_type is 2 or split, win1=bigger, win2=window on top right; win3=window on bottom right',
  `route_id` int(11) NOT NULL COMMENT 'FOREIGN',
  `order_id` int(11) NOT NULL COMMENT 'FOREIGN',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL COMMENT '0=unscheduled;1=scheduled'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `times_repeat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `n_schedules`
--
ALTER TABLE `n_schedules`
  MODIFY `schedule_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `order_routes`
--
ALTER TABLE `order_routes`
  MODIFY `orderroutes_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `order_slots`
--
ALTER TABLE `order_slots`
  MODIFY `orderslot_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
