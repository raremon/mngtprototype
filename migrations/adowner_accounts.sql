-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2017 at 07:34 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `adowner_accounts`
--

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
(1, 'nestle', 'fbdc00f0a084b3393c2dd1cbb5dc0027c726cfaa', '2017-05-01 05:27:12', '2017-05-01 05:20:46', '2017-05-01 05:20:46', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adowner_accounts`
--
ALTER TABLE `adowner_accounts`
  ADD PRIMARY KEY (`owner_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adowner_accounts`
--
ALTER TABLE `adowner_accounts`
  MODIFY `owner_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
