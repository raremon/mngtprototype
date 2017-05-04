-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2017 at 10:02 PM
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
(1, 'Burgerdesal and Cheesy Eggdesal', '1-Burgerdesal_and_Cheesy_Eggdesal.mp4', 62, 1, '2017-05-02 19:51:50', '2017-05-02 19:51:50'),
(2, 'Move On with McDonalds', '1-Move_On_with_McDonalds.mp4', 78, 1, '2017-05-02 19:52:09', '2017-05-02 19:52:09'),
(3, 'Girl Moves On with Burger Mcdo', '1-Girl_Moves_On_with_Burger_Mcdo.mp4', 62, 1, '2017-05-02 19:52:17', '2017-05-02 19:52:17'),
(4, 'Remembrance of the Past', '1-Remembrance_of_the_Past.mp4', 66, 1, '2017-05-02 19:52:28', '2017-05-02 19:52:28'),
(5, 'Best Daddy Ever', '1-Best_Daddy_Ever.mp4', 99, 1, '2017-05-02 19:52:38', '2017-05-02 19:52:38'),
(6, 'KFC Special Discount Promo', '2-KFC_Special_Discount_Promo.mp4', 11, 2, '2017-05-02 19:52:54', '2017-05-02 19:52:54'),
(7, '5 in 1 Meal Box', '2-5_in_1_Meal_Box.mp4', 87, 2, '2017-05-02 19:53:14', '2017-05-02 19:53:14'),
(8, 'OMG Burger', '2-OMG_Burger.mp4', 52, 2, '2017-05-02 19:53:52', '2017-05-02 19:53:52'),
(9, 'Chizza Murders Pizza', '2-Chizza_Murders_Pizza.mp4', 61, 2, '2017-05-02 19:54:03', '2017-05-02 19:54:03'),
(10, 'Sisig Rice', '2-Sisig_Rice.mp4', 17, 2, '2017-05-02 19:54:19', '2017-05-02 19:54:19'),
(11, 'Sarap ng Kaing Pinoy', '3-Sarap_ng_Kaing_Pinoy.mp4', 31, 3, '2017-05-02 19:54:40', '2017-05-02 19:54:40'),
(12, 'Huli Ka Moments', '3-Huli_Ka_Moments.mp4', 31, 3, '2017-05-02 19:54:50', '2017-05-02 19:54:50'),
(13, 'Halo Halo', '3-Halo_Halo.mp4', 32, 3, '2017-05-02 19:55:06', '2017-05-02 19:55:06'),
(14, 'Mang Inasal Madness', '3-Mang_Inasal_Madness.mp4', 61, 3, '2017-05-02 19:55:20', '2017-05-02 19:55:53'),
(15, 'The Toppings are on Top', '3-The_Toppings_are_on_Top.mp4', 104, 3, '2017-05-02 19:55:37', '2017-05-02 19:55:37');

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
(1, 'McDonalds', 'Citibank Center, Paseo de Roxas, Makati, 1226 Metro Manila', '02-8635490', 'info@ie.mcd.com', 'https://www.mcdonalds.com.ph/', 'McDonalds.jpg', 'McDonald\'s (or simply as McD) is an American hamburger and fast food restaurant chain. It was founded in 1940 as a barbecue restaurant operated by Richard and Maurice McDonald. In 1948, they reorganized their business as a hamburger stand, using production line principles.', '2017-05-02 17:08:03', '2017-05-02 17:14:18'),
(2, 'Kentucky Fried Chicken', '80-82 A Ramcar Roces Avenue Quezon City, Philippines', '887-8888', 'customercare@kfc.ph', 'http://www.kfc.com.ph/', 'Kentucky_Fried_Chicken.png', 'Kentucky Fried Chicken owes its delicious history to Harland David Sanders, its founder who is fondly referred to as “The Colonel”. Upon perfection of the Original Recipe that makes use of 11 secret herbs and spices, Colonel Sanders has brought the ultimate delight of chicken lovers to the world.', '2017-05-02 17:13:30', '2017-05-02 17:29:39'),
(3, 'Mang Inasal', ' Unit 613, 6/F, Globe Telecom Plaza II, Pioneer Highlands Condominium, Pioneer cor. Madison sts. Mandaluyong, Philippines', '(02) 724 1111', 'customercare@mnginasal.ph', 'http://www.manginasal.com/', 'Mang_Inasal.jpg', 'The company was started by Edgar J. Sia II, a young enterprising architect, who owned his first business at the age of twenty. Sia engaged in the food business at twenty-six years of age, opening the first Mang Inasal branch in December 2003 at the Robinsons Mall Carpark in Iloilo City. The restaurant was an instant success, despite stiff competition from other, more established grilled-food restaurants.', '2017-05-02 17:16:48', '2017-05-02 17:17:07');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
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
(1, 'System Administrator', 'A system administrator, or sysadmin, is a person who is responsible for the upkeep, configuration, and reliable operation of computer systems; especially multi-user computers, such as servers.', '2017-05-02 16:12:15', '2017-05-02 16:12:36'),
(2, 'Program Director', 'The Program Director oversees the coordination and administration of all aspects of an ongoing program including planning, organizing, staffing, leading, and controlling program activities.', '2017-05-02 16:12:15', '2017-05-02 16:12:36'),
(3, 'Manager', 'Advertising managers often possess a 4-year bachelor\'s degree in advertising or a related field such as journalism or marketing. ... Typical courses that are pertinent to an advertising manager\'s job duties include media strategy, account services, advertising planning, creative strategy and ad design.', '2017-05-02 16:12:15', '2017-05-02 16:12:36'),
(4, 'Advertisement Officer', 'Advertising and Promotions Manager. Job Duties: Advertising, promotions, and marketing managers typically do the following: Work with department heads or staff to discuss topics such as contracts, selection of advertising media, or products to be advertised. Gather and organize information to plan advertising campaigns.', '2017-05-02 16:12:15', '2017-05-02 16:12:36');

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
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`),
  ADD UNIQUE KEY `role_id` (`role_id`),
  ADD KEY `role_id_2` (`role_id`);

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
  MODIFY `advertiser_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Advertiser''s Id ( Primary )', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Role''s Id', AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
