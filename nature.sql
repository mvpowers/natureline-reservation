-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2019 at 06:28 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nature`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` smallint(5) UNSIGNED NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `age` tinyint(4) NOT NULL,
  `sex` enum('F','M') NOT NULL,
  `booking_email` varchar(300) NOT NULL,
  `address` varchar(300) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `ticket_id` varchar(225) NOT NULL,
  `seat_number` tinyint(4) NOT NULL,
  `booking_date` datetime NOT NULL,
  `booking_mode` enum('1','2','3') NOT NULL,
  `user_id` smallint(5) UNSIGNED NOT NULL,
  `flight_id` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `first_name`, `last_name`, `age`, `sex`, `booking_email`, `address`, `phone`, `ticket_id`, `seat_number`, `booking_date`, `booking_mode`, `user_id`, `flight_id`) VALUES
(1, 'onovo', 'ifeanyi', 44, 'M', 'ifeanyichukwufavourfg@gmail.com', '23 imuto', '07030562007', 'w5ew42dn1w', 1, '2019-06-11 21:40:17', '3', 1, 8),
(2, 'onovo', 'ifeanyi', 23, 'M', 'ifeanyichukwufavourfg@gmail.com', 'ijagun', '07030562007', 'ne5b17iwyc', 2, '2019-06-23 12:50:10', '1', 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `flight`
--

CREATE TABLE `flight` (
  `flight_id` smallint(5) UNSIGNED NOT NULL,
  `flight_name` char(255) NOT NULL,
  `origin` char(255) NOT NULL,
  `destination` char(255) NOT NULL,
  `check_in_time` time NOT NULL,
  `check_in_date` date NOT NULL,
  `departure_time` time NOT NULL,
  `departure_date` date NOT NULL,
  `max_seat` tinyint(4) NOT NULL,
  `flight_bill` double UNSIGNED NOT NULL,
  `faa_bill` double UNSIGNED NOT NULL,
  `total_cost` double UNSIGNED NOT NULL,
  `status` enum('not available','available') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `flight`
--

INSERT INTO `flight` (`flight_id`, `flight_name`, `origin`, `destination`, `check_in_time`, `check_in_date`, `departure_time`, `departure_date`, `max_seat`, `flight_bill`, `faa_bill`, `total_cost`, `status`) VALUES
(6, 'aero-airlines', 'ogun', 'abuja', '14:34:00', '2019-05-26', '15:33:00', '2019-05-26', 5, 800, 36, 836, 'available'),
(7, 'dana', 'ogun', 'lagos', '14:34:00', '2019-05-26', '15:33:00', '2019-05-26', 8, 300, 100, 400, 'not available'),
(8, 'aric', 'ogun', 'kaduna', '03:24:00', '2019-05-26', '00:04:00', '2019-05-26', 4, 200.56, 501, 701.56, 'available'),
(9, 'flo', 'enugu', 'abuja', '02:32:00', '2019-06-08', '02:13:00', '2019-06-09', 6, 200, 289.89, 489.89, 'not available'),
(10, 'df-76', 'kogi', 'abuja', '00:03:00', '2019-06-16', '00:13:00', '2019-06-03', 4, 200, 200, 400, 'not available');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` smallint(5) UNSIGNED NOT NULL,
  `user_name` varchar(60) NOT NULL,
  `email` varchar(300) NOT NULL,
  `phone` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registration_date` datetime NOT NULL,
  `user_level` tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `email`, `phone`, `password`, `registration_date`, `user_level`) VALUES
(1, 'admin', 'onyia314@gmail.com', 'o8o34677331', '$2y$10$ID47b7o6M6ruCFjgo502RedWrZoV1yLq5W6yGMb71Hl4qpYilYg.q', '2019-05-18 19:55:11', 1),
(2, 'onovo', 'onovo@gmail.com', '08109934443', '$2y$10$F3M8Hd2Pce1GU61oq/SuQ.OnCOdqiqgNZ37mMoCXo204woI6uigKO', '2019-05-18 19:57:35', 0),
(3, 'nkem', 'nkem@gmail.com', '08034677331', '$2y$10$tXypq4NO07AWXKnAsuLeCOSHMT3xTvMgcRdLf66uPr/b.0VgKP5si', '2019-05-19 10:18:53', 0),
(4, 'ify042', 'ify@gmail.com', '123', '$2y$10$fvfI6Y9Go0nJ8JQ4EMJDbO6lQ0s/uaDFZcW6t/vwYF4lA2f/Q6bj2', '2019-05-21 15:56:33', 0),
(5, 'wilson', 'wilson@gmail.com', '9262662', '$2y$10$bhWonExxxornp2jjAFWC2OjcF27P6cN7zwBSiryY5RCWGZnQRFIc2', '2019-05-22 22:54:07', 0),
(6, 'nnamdi', 'nnamdi@gmail.com', '11222333', '$2y$10$5NuDhyylF842s5eS11NdV.fiKmsz2k6cLrpipOhjucwNXpGrajWvq', '2019-06-08 08:45:25', 0),
(7, 'okereke', 'okereke@gmail.com', '07030562007', '$2y$10$2qKjSeZ6KuGIu6tI2zAxjO.qNnM7.k1zSBfR8HDUNJZDr9oWI7xZy', '2019-06-08 21:23:25', 0),
(8, 'chioma', 'chioma@gmail.om', 'fzgff', '$2y$10$QBjoVBaWWxi7KFw08/MpOOffNDRJ3ves9rcwhZQu2.fFv2rKcNuTO', '2019-06-08 21:39:57', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_archive`
--

CREATE TABLE `users_archive` (
  `archive_id` int(5) UNSIGNED NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `age` tinyint(4) NOT NULL,
  `sex` enum('F','M') NOT NULL,
  `booking_email` varchar(300) NOT NULL,
  `address` varchar(300) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `ticket_id` varchar(225) NOT NULL,
  `seat_number` tinyint(4) NOT NULL,
  `booking_date` datetime NOT NULL,
  `booking_mode` enum('1','2','3') NOT NULL,
  `flight_id` smallint(5) UNSIGNED NOT NULL,
  `flight_name` char(255) NOT NULL,
  `origin` char(255) NOT NULL,
  `destination` char(255) NOT NULL,
  `check_in_time` time NOT NULL,
  `check_in_date` date NOT NULL,
  `departure_time` time NOT NULL,
  `departure_date` date NOT NULL,
  `flight_bill` double UNSIGNED NOT NULL,
  `faa_bill` double UNSIGNED NOT NULL,
  `total_cost` double UNSIGNED NOT NULL,
  `user_id` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_archive`
--

INSERT INTO `users_archive` (`archive_id`, `first_name`, `last_name`, `age`, `sex`, `booking_email`, `address`, `phone`, `ticket_id`, `seat_number`, `booking_date`, `booking_mode`, `flight_id`, `flight_name`, `origin`, `destination`, `check_in_time`, `check_in_date`, `departure_time`, `departure_date`, `flight_bill`, `faa_bill`, `total_cost`, `user_id`) VALUES
(31, 'ify', 'ifeanyi', 12, 'M', 'ify@gmail.com', 'ijagun', '12255', '924500739', 1, '2019-05-25 14:45:46', '1', 8, 'aric', 'ogun', 'kaduna', '03:24:00', '2019-05-26', '00:04:00', '2019-05-26', 70, 50, 120, 4),
(32, 'sherif', 'joshua', 12, 'M', 'ify@gmail.com', 'ijagun', '12324', '246893376', 2, '2019-05-25 14:46:20', '2', 8, 'aric', 'ogun', 'kaduna', '03:24:00', '2019-05-26', '00:04:00', '2019-05-26', 70, 50, 120, 4),
(33, 'ify', 'nkem', 23, 'M', 'ify@gmail.com', 'ijagun', '07030562007', '493780629', 1, '2019-05-25 14:37:58', '1', 7, 'dana', 'ogun', 'lagos', '14:34:00', '2019-05-26', '15:33:00', '2019-05-26', 200, 89, 289, 4),
(34, 's', 's', 34, 'M', 'ify@gmail.com', 'ijagun', '12345678', '446188624', 2, '2019-05-25 14:41:50', '2', 7, 'dana', 'ogun', 'lagos', '14:34:00', '2019-05-26', '15:33:00', '2019-05-26', 200, 89, 289, 4),
(35, 'onovo', 'ifeanyi', 23, 'M', 'onovo@gmail.com', 'okenla street', '22222', '195867781', 3, '2019-05-25 14:42:41', '2', 7, 'dana', 'ogun', 'lagos', '14:34:00', '2019-05-26', '15:33:00', '2019-05-26', 200, 89, 289, 4),
(36, 'onovo', 'ifeanyi', 12, 'M', 'ify@gmail.com', 'ijagun', '07030562007', '630194948', 1, '2019-05-25 14:55:27', '2', 7, 'dana', 'ogun', 'lagos', '14:34:00', '2019-05-26', '15:33:00', '2019-05-26', 200, 89, 289, 4),
(37, 'onovo', 'ifeanyi', 23, 'M', 'onovo@gmail.com', 'gg', '142443', '337816812', 2, '2019-05-25 15:31:27', '1', 7, 'dana', 'ogun', 'lagos', '14:34:00', '2019-05-26', '15:33:00', '2019-05-26', 200, 89, 289, 4),
(38, 'w', 'w', 23, 'M', 'ify@gmail.com', 'ijagun', '3', '972217549', 3, '2019-05-25 15:36:05', '1', 7, 'dana', 'ogun', 'lagos', '14:34:00', '2019-05-26', '15:33:00', '2019-05-26', 200, 89, 289, 4),
(39, 'ify', 'onyia', 12, 'M', 'ify@gmail.com', 'ijagun', '07030562007', '763994469', 1, '2019-05-26 17:29:49', '1', 7, 'dana', 'ogun', 'lagos', '14:34:00', '2019-05-26', '15:33:00', '2019-05-26', 300, 100, 400, 4),
(40, 'onyia', 'chukwuebuka', 23, 'M', 'onyia314@gmail.com', 'ijagun', '08109934443', '516674323', 2, '2019-05-26 17:30:48', '3', 7, 'dana', 'ogun', 'lagos', '14:34:00', '2019-05-26', '15:33:00', '2019-05-26', 300, 100, 400, 1),
(41, 'wilson', 'ofornedu', 12, 'M', 'wilson@gmail.com', 'ijagun', '64764646', '529848950', 3, '2019-05-26 17:32:05', '2', 7, 'dana', 'ogun', 'lagos', '14:34:00', '2019-05-26', '15:33:00', '2019-05-26', 300, 100, 400, 4),
(42, 'denilson', 'sucre', 23, 'M', 'sucre@gmail.com', 'ijagun', '284636', '186047091', 4, '2019-05-26 17:35:52', '3', 7, 'dana', 'ogun', 'lagos', '14:34:00', '2019-05-26', '15:33:00', '2019-05-26', 300, 100, 400, 1),
(43, 'onovo', 'danji', 23, 'M', 'wilson@gmail.com', '212', '12345678', '293410400', 1, '2019-06-07 21:58:05', '3', 8, 'aric', 'ogun', 'kaduna', '03:24:00', '2019-05-26', '00:04:00', '2019-05-26', 200, 50, 250, 1),
(44, 'wilson', 'ww', 2, 'M', 'onyia314@gmail.com', 'w', 'ww', '912874185', 2, '2019-06-07 22:31:53', '3', 8, 'aric', 'ogun', 'kaduna', '03:24:00', '2019-05-26', '00:04:00', '2019-05-26', 200, 50, 250, 1),
(45, 'onovo', 'danji', 23, 'F', 'onovo@gmail.com', 'we', '12345678', '857524869', 1, '2019-06-08 00:09:31', '3', 9, 'flo', 'enugu', 'abuja', '02:32:00', '2019-06-08', '02:13:00', '2019-06-09', 200, 289, 489, 1),
(46, 'nnamdi', 'kama', 12, 'M', 'nnamdi@gmail.com', 'mount', '123333', '582314871', 2, '2019-06-08 09:11:06', '1', 9, 'flo', 'enugu', 'abuja', '02:32:00', '2019-06-08', '02:13:00', '2019-06-09', 200, 289, 489, 6),
(47, 'nnamdi', 'nwata', 23, 'F', 'onovo@gmail.com', 'w,', '0983774775', '235512941', 3, '2019-06-08 13:05:10', '3', 9, 'flo', 'enugu', 'abuja', '02:32:00', '2019-06-08', '02:13:00', '2019-06-09', 200, 289, 489, 1),
(48, 'chima', 'okeke', 23, 'M', 'onyia314@gmail.com', 'po', '12324', '223254075', 4, '2019-06-08 13:14:54', '3', 9, 'flo', 'enugu', 'abuja', '02:32:00', '2019-06-08', '02:13:00', '2019-06-09', 200, 289, 489, 1),
(49, 'onyia', 'chukwuebuka', 21, 'M', 'onyia314@gmail.com', '46 mount street awkunanaw enugu', '08103719833', '541450481', 5, '2019-06-08 13:38:51', '3', 9, 'flo', 'enugu', 'abuja', '02:32:00', '2019-06-08', '02:13:00', '2019-06-09', 200, 289, 489, 1),
(50, 'onyia', 'chukwuebuka', 32, 'M', 'onyia314@gmail.com', '47 igbariam', '08034677331', '382744680', 6, '2019-06-08 13:46:15', '3', 9, 'flo', 'enugu', 'abuja', '02:32:00', '2019-06-08', '02:13:00', '2019-06-09', 200, 289, 489, 1),
(51, 'dangote', 'aliko', 54, 'M', 'onyia314@gmail.com', 'udi', '08034677331', '281927422', 1, '2019-06-08 14:12:56', '3', 9, 'flo', 'enugu', 'abuja', '02:32:00', '2019-06-08', '02:13:00', '2019-06-09', 200, 289, 489, 1),
(52, 'dantata', 'danji', 54, 'M', 'onyia314@gmail.com', '47 igbariam', '07030562007', '474758008', 2, '2019-06-08 14:23:01', '3', 9, 'flo', 'enugu', 'abuja', '02:32:00', '2019-06-08', '02:13:00', '2019-06-09', 200, 289, 489, 1),
(53, 'gbenga', 'adekunle', 12, 'M', 'onyia314@gmail.com', '47 igbariam', '12345678', '622316703', 3, '2019-06-08 14:25:49', '3', 9, 'flo', 'enugu', 'abuja', '02:32:00', '2019-06-08', '02:13:00', '2019-06-09', 200, 289, 489, 1),
(54, 'achime', 'chukwuebuka', 3, 'M', 'onyia314@gmail.com', '47 igbariam', '07030562007', '454884098', 4, '2019-06-08 14:27:27', '3', 9, 'flo', 'enugu', 'abuja', '02:32:00', '2019-06-08', '02:13:00', '2019-06-09', 200, 289, 489, 1),
(55, 'onyia', 'kama', 34, 'M', 'onyia314@gmail.com', 'germany', '08103719833', '361591386', 5, '2019-06-08 14:32:41', '3', 9, 'flo', 'enugu', 'abuja', '02:32:00', '2019-06-08', '02:13:00', '2019-06-09', 200, 289, 489, 1),
(56, 'onovo', 'ifeanyi', 24, 'M', 'onyia314@gmail.com', '47 igbariam', '07030562007', '757508918', 6, '2019-06-08 14:34:15', '3', 9, 'flo', 'enugu', 'abuja', '02:32:00', '2019-06-08', '02:13:00', '2019-06-09', 200, 289, 489, 1),
(57, 'messi', 'lionel', 34, 'M', 'onyia314@gmail.com', 'spain', '08034677331', '306944503', 1, '2019-06-08 14:35:59', '3', 9, 'flo', 'enugu', 'abuja', '02:32:00', '2019-06-08', '02:13:00', '2019-06-09', 200, 289, 489, 1),
(58, 'kama', 'nkem', 23, 'M', 'onyia314@gmail.com', 'ijagun', '08034677331', '282901569', 2, '2019-06-08 15:11:13', '3', 9, 'flo', 'enugu', 'abuja', '02:32:00', '2019-06-08', '02:13:00', '2019-06-09', 200, 289, 489, 1),
(59, 'denilson', 'sucre', 23, 'M', 'onyia314@gmail.com', 'ijagun', '23', '672250054', 3, '2019-06-08 15:15:28', '3', 9, 'flo', 'enugu', 'abuja', '02:32:00', '2019-06-08', '02:13:00', '2019-06-09', 200, 289, 489, 1),
(60, 'kama', 'danji', 23, 'M', 'onyia314@gmail.com', 'we', '232', '547557466', 4, '2019-06-08 15:19:56', '3', 9, 'flo', 'enugu', 'abuja', '02:32:00', '2019-06-08', '02:13:00', '2019-06-09', 200, 289, 489, 1),
(61, 'opa', 'kama', 21, 'M', 'onyia314@gmail.com', 'we', '121', '740063771', 5, '2019-06-08 15:21:37', '3', 9, 'flo', 'enugu', 'abuja', '02:32:00', '2019-06-08', '02:13:00', '2019-06-09', 200, 289, 489, 1),
(62, 'winner', 'okonkwo', 12, 'M', 'onyia314@gmail.com', 'winco', '12324', '323475326', 6, '2019-06-08 15:23:40', '3', 9, 'flo', 'enugu', 'abuja', '02:32:00', '2019-06-08', '02:13:00', '2019-06-09', 200, 289, 489, 1),
(63, 'i', 'e', 12, 'M', 'ify@gmail.com', '12', '13', '457141608', 1, '2019-05-26 18:12:29', '1', 7, 'dana', 'ogun', 'lagos', '14:34:00', '2019-05-26', '15:33:00', '2019-05-26', 300, 100, 400, 4),
(64, 'sherif', 'sucre', 12, 'M', 'onyia314@gmail.com', '12', '12345678', '197929399', 1, '2019-06-08 15:32:23', '3', 7, 'dana', 'ogun', 'lagos', '14:34:00', '2019-05-26', '15:33:00', '2019-05-26', 300, 100, 400, 1),
(65, 'wlfred', 'okoye', 23, 'M', 'onyia314@gmail.com', 'winco', '08034677331', '310128335', 2, '2019-06-08 15:37:11', '3', 7, 'dana', 'ogun', 'lagos', '14:34:00', '2019-05-26', '15:33:00', '2019-05-26', 300, 100, 400, 1),
(66, 'mum', 'sucre', 23, 'F', 'onyia314@gmail.com', 'we', '07030562007', '116033369', 3, '2019-06-08 15:59:36', '3', 7, 'dana', 'ogun', 'lagos', '14:34:00', '2019-05-26', '15:33:00', '2019-05-26', 300, 100, 400, 1),
(67, 'onovo', 'ifeanyi', 12, 'M', 'onyia314@gmail.com', '47', '0983774775', '438372177', 4, '2019-06-09 15:25:12', '3', 7, 'dana', 'ogun', 'lagos', '14:34:00', '2019-05-26', '15:33:00', '2019-05-26', 300, 100, 400, 1),
(68, 'nnamdi', 'joshua', 12, 'M', 'onyia314@gmail.com', '46 mount street awkunanaw enugu', '12345678', '723302260', 5, '2019-06-09 15:27:30', '3', 7, 'dana', 'ogun', 'lagos', '14:34:00', '2019-05-26', '15:33:00', '2019-05-26', 300, 100, 400, 1),
(69, 'nnamdi', 'kama', 23, 'M', 'onyia314@gmail.com', '47 igbariam', '07030562007', '805726264', 6, '2019-06-09 15:32:17', '3', 7, 'dana', 'ogun', 'lagos', '14:34:00', '2019-05-26', '15:33:00', '2019-05-26', 300, 100, 400, 1),
(70, 'chinedu', 'onyibalu', 12, 'F', 'onyia314@gmail.com', 's', '12345678', '769584725', 1, '2019-06-08 00:19:03', '3', 8, 'aric', 'ogun', 'kaduna', '03:24:00', '2019-05-26', '00:04:00', '2019-05-26', 200, 501, 701, 1),
(71, 'kama', 'nnamdi', 22, 'M', 'onyia314@gmail.com', '22', '07030562007', '910628762', 1, '2019-06-09 16:15:30', '3', 8, 'aric', 'ogun', 'kaduna', '03:24:00', '2019-05-26', '00:04:00', '2019-05-26', 200, 501, 701, 1),
(72, 'onovo', 'ofornedu', 12, 'M', 'onyia314@gmail.com', 'ijagun', '08103719833', '449347852', 2, '2019-06-09 16:18:05', '3', 8, 'aric', 'ogun', 'kaduna', '03:24:00', '2019-05-26', '00:04:00', '2019-05-26', 200, 501, 701, 1),
(73, 'onovo', 'ifeanyi', 12, 'M', 'onyia314@gmail.com', '12', '12345678', '0', 3, '2019-06-09 19:28:59', '3', 8, 'aric', 'ogun', 'kaduna', '03:24:00', '2019-05-26', '00:04:00', '2019-05-26', 200, 501, 701, 1),
(74, 'wilson', 'chi', 12, 'M', 'onyia314@gmail.com', 'winco', '07030562007', '9', 3, '2019-06-09 20:08:44', '3', 8, 'aric', 'ogun', 'kaduna', '03:24:00', '2019-05-26', '00:04:00', '2019-05-26', 200, 501, 701, 1),
(75, 'wilson', 'van', 22, 'M', 'onyia314@gmail.com', 'sd', '2345678', '0', 3, '2019-06-09 20:14:45', '3', 8, 'aric', 'ogun', 'kaduna', '03:24:00', '2019-05-26', '00:04:00', '2019-05-26', 200, 501, 701, 1),
(76, 'dike', 'dike', 12, 'M', 'onyia314@gmail.com', 'ijagun', '07030562007', '0', 4, '2019-06-09 20:23:11', '3', 8, 'aric', 'ogun', 'kaduna', '03:24:00', '2019-05-26', '00:04:00', '2019-05-26', 200, 501, 701, 1),
(77, 'mum', 'onyia', 12, 'M', 'onyia314@gmail.com', '46 mount street awkunanaw enugu', '07030562007', '3', 1, '2019-06-10 16:26:49', '3', 8, 'aric', 'ogun', 'kaduna', '03:24:00', '2019-05-26', '00:04:00', '2019-05-26', 200, 501, 701, 1),
(78, 'onovo', 'ifeanyi', 21, 'M', 'onyia314@gmail.com', 'ijagun', '07030562007', '1', 2, '2019-06-10 16:43:59', '3', 8, 'aric', 'ogun', 'kaduna', '03:24:00', '2019-05-26', '00:04:00', '2019-05-26', 200, 501, 701, 1),
(79, 'onyia', 'nkemdirim', 21, 'M', 'nkem@gmail.com', '45 mount street awkunanw', '08109934443', '7', 3, '2019-06-10 16:47:16', '1', 8, 'aric', 'ogun', 'kaduna', '03:24:00', '2019-05-26', '00:04:00', '2019-05-26', 200, 501, 701, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD UNIQUE KEY `ticket_id` (`ticket_id`),
  ADD KEY `flight_id` (`flight_id`);

--
-- Indexes for table `flight`
--
ALTER TABLE `flight`
  ADD PRIMARY KEY (`flight_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_archive`
--
ALTER TABLE `users_archive`
  ADD PRIMARY KEY (`archive_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `flight`
--
ALTER TABLE `flight`
  MODIFY `flight_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users_archive`
--
ALTER TABLE `users_archive`
  MODIFY `archive_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`flight_id`);

--
-- Constraints for table `users_archive`
--
ALTER TABLE `users_archive`
  ADD CONSTRAINT `users_archive_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
