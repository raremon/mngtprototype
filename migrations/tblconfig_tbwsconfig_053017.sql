-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2017 at 06:43 PM
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
-- Table structure for table `tblcconfig`
--

CREATE TABLE `tblcconfig` (
  `keyid` int(11) NOT NULL,
  `LcPath` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `LcFunction` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `route_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `tblcconfig`
--

INSERT INTO `tblcconfig` (`keyid`, `LcPath`, `LcFunction`, `route_id`) VALUES
(1, 'C;\\8App', 'App', 0),
(2, 'C:\\8Video', 'Video', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbwsconfig`
--

CREATE TABLE `tbwsconfig` (
  `keyid` int(11) NOT NULL,
  `WsLink` varchar(200) COLLATE utf8mb4_bin DEFAULT NULL,
  `WsFunction` varchar(200) COLLATE utf8mb4_bin DEFAULT NULL,
  `route_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `tbwsconfig`
--

INSERT INTO `tbwsconfig` (`keyid`, `WsLink`, `WsFunction`, `route_id`) VALUES
(1, 'http://180.232.67.229/api/', 'Appupdate', 0),
(2, 'http://180.232.67.229/assets/ads/', 'DlVideo', 0),
(3, 'http://172.16.4.243/api/jlogs/', 'Adlog', 0),
(4, 'http://180.232.67.229/assets/app/', 'Dlapp', 0),
(5, 'http://180.232.67.229/api/jtblconfig/', 'tblconfig', 0),
(6, 'http://180.232.67.229/api/jfiller/', 'jfiller', 0),
(7, 'http://180.232.67.229/api/jtbmbregs/', 'tbmbregs', 0),
(8, 'http://180.232.67.229/api/jtbmbinfo/', 'tbmbinfo', 0),
(9, 'http://180.232.67.229/api/jtbhwdefect/', 'jtbhwdefect', 0),
(10, 'http://180.232.67.229/api/jschedule/routeschedules/', 'jschedule', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblcconfig`
--
ALTER TABLE `tblcconfig`
  ADD PRIMARY KEY (`keyid`);

--
-- Indexes for table `tbwsconfig`
--
ALTER TABLE `tbwsconfig`
  ADD PRIMARY KEY (`keyid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblcconfig`
--
ALTER TABLE `tblcconfig`
  MODIFY `keyid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbwsconfig`
--
ALTER TABLE `tbwsconfig`
  MODIFY `keyid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
