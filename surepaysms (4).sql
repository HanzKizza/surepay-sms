-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 24, 2023 at 05:58 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `surepaysms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pwd` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `contact`, `email`, `role`, `pwd`, `status`, `created_at`, `updated_at`) VALUES
(1, 'hAnZ', '256777205339', 'hanningtonkizza@gmail.com', 'sa', 'hanz', 'active', NULL, NULL),
(2, 'Test Maker', '256706014', 'testmaker@gmail.com', 'maker', 'test', 'active', NULL, NULL),
(3, 'Test Checker', '256706014', 'testchecker@gmail.com', 'checker', 'test', 'active', '2023-05-16 10:47:09', '2023-05-16 10:47:09');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `messageId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `phoneNumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vendorId` bigint(20) NOT NULL,
  `userId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `service` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`messageId`)
) ENGINE=MyISAM AUTO_INCREMENT=92 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`messageId`, `phoneNumber`, `message`, `vendorId`, `userId`, `service`, `sender`, `status`, `created_at`, `updated_at`) VALUES
(1, '256777205339', 'test', 1, '1', 'SMS Platform', 'hAnZ', 'sent', '2023-05-15 08:11:50', '2023-05-15 08:11:50'),
(2, '256777205339', 'test', 1, '1', 'SMS Platform', 'hAnZ', 'sent', '2023-05-15 08:11:50', '2023-05-15 08:11:50'),
(3, '256777205339', 'This is a test on monday 15th', 1, '1', 'SMS Platform', 'hAnZ', 'sent', '2023-05-15 08:14:55', '2023-05-15 08:14:55'),
(4, '256777205339', 'This', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 09:25:59', '2023-05-15 09:25:59'),
(5, '706014375', 'Hello Misaga', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 09:37:56', '2023-05-15 09:37:56'),
(6, '785987778', 'Hello Ivan', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 09:37:56', '2023-05-15 09:37:56'),
(7, '785987778', 'Hello Kiwanuka', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 09:37:56', '2023-05-15 09:37:56'),
(8, '785987782', 'Hello Kiwanuka', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 09:37:56', '2023-05-15 09:37:56'),
(9, '785987781', 'Hello Kiwanuka', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 09:37:56', '2023-05-15 09:37:56'),
(10, '785987785', 'Hello Kiwanuka', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 09:37:56', '2023-05-15 09:37:56'),
(11, '785987787', 'Hello Kiwanuka', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 09:37:56', '2023-05-15 09:37:56'),
(12, '785987783', 'Hello Kiwanuka', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 09:37:56', '2023-05-15 09:37:56'),
(13, '785987784', 'Hello Kiwanuka', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 09:37:56', '2023-05-15 09:37:56'),
(14, '785987780', 'Hello Kiwanuka', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 09:37:56', '2023-05-15 09:37:56'),
(15, '785987786', 'Hello Kiwanuka', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 09:37:56', '2023-05-15 09:37:56'),
(16, '785987779', 'Hello Kiwanuka', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 09:37:56', '2023-05-15 09:37:56'),
(17, '256777205339', 'This is a new test', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 10:16:05', '2023-05-15 10:16:05'),
(18, '706014375', 'Hello Misaga', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 10:17:35', '2023-05-15 10:17:35'),
(19, '785987778', 'Hello Ivan', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 10:17:35', '2023-05-15 10:17:35'),
(20, '785987778', 'Hello Kiwanuka', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 10:17:35', '2023-05-15 10:17:35'),
(21, '785987779', 'Hello Kiwanuka', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 10:17:35', '2023-05-15 10:17:35'),
(22, '785987780', 'Hello Kiwanuka', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 10:17:35', '2023-05-15 10:17:35'),
(23, '785987781', 'Hello Kiwanuka', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 10:17:35', '2023-05-15 10:17:35'),
(24, '785987782', 'Hello Kiwanuka', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 10:17:35', '2023-05-15 10:17:35'),
(25, '785987785', 'Hello Kiwanuka', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 10:17:35', '2023-05-15 10:17:35'),
(26, '785987783', 'Hello Kiwanuka', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 10:17:35', '2023-05-15 10:17:35'),
(27, '785987784', 'Hello Kiwanuka', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 10:17:35', '2023-05-15 10:17:35'),
(28, '785987787', 'Hello Kiwanuka', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 10:17:35', '2023-05-15 10:17:35'),
(29, '785987786', 'Hello Kiwanuka', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 10:17:35', '2023-05-15 10:17:35'),
(30, '256777205339', 'This is a new test', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 12:35:03', '2023-05-15 12:35:03'),
(31, '256777205339', 'This is a very other test', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 13:13:20', '2023-05-15 13:13:20'),
(32, '256777205339', 'This is a very other test', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 13:14:06', '2023-05-15 13:14:06'),
(33, '256777205339', 'This is a very other test', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 13:14:24', '2023-05-15 13:14:24'),
(34, '785987780', 'Hello Kiwanuka Please come pick your child Jeff from school', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 13:16:46', '2023-05-15 13:16:46'),
(35, '785987781', 'Hello Kiwanuka Please come pick your child Jeff from school', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 13:16:46', '2023-05-15 13:16:46'),
(36, '785987778', 'Hello Kiwanuka Please come pick your child Jeff from school', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 13:16:46', '2023-05-15 13:16:46'),
(37, '785987782', 'Hello Kiwanuka Please come pick your child Jeff from school', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 13:16:46', '2023-05-15 13:16:46'),
(38, '785987779', 'Hello Kiwanuka Please come pick your child Jeff from school', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 13:16:46', '2023-05-15 13:16:46'),
(39, '785987786', 'Hello Kiwanuka Please come pick your child Jeff from school', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 13:16:46', '2023-05-15 13:16:46'),
(40, '785987778', 'Hello Ivan Please come pick your child Zuckerberg from school', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 13:16:46', '2023-05-15 13:16:46'),
(41, '785987783', 'Hello Kiwanuka Please come pick your child Jeff from school', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 13:16:46', '2023-05-15 13:16:46'),
(42, '785987784', 'Hello Kiwanuka Please come pick your child Jeff from school', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 13:16:46', '2023-05-15 13:16:46'),
(43, '785987785', 'Hello Kiwanuka Please come pick your child Jeff from school', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 13:16:46', '2023-05-15 13:16:46'),
(44, '706014375', 'Hello Misaga Please come pick your child Elon from school', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 13:16:46', '2023-05-15 13:16:46'),
(45, '785987787', 'Hello Kiwanuka Please come pick your child Jeff from school', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-15 13:16:46', '2023-05-15 13:16:46'),
(46, '256777205339', 'This is a test', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 06:21:52', '2023-05-16 06:21:52'),
(47, '256777205339', 'Test', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 07:41:43', '2023-05-16 07:41:43'),
(48, '256777205339', 'This is a bulk test', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 07:55:15', '2023-05-16 07:55:15'),
(49, '256777205339', 'This is a bulk test', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 07:55:15', '2023-05-16 07:55:15'),
(50, '256777205339', 'This is a bulk test', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 07:55:15', '2023-05-16 07:55:15'),
(51, '256777205339', 'This is a bulk test', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 07:55:15', '2023-05-16 07:55:15'),
(52, '256777205339', 'This is a bulk test', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 07:55:15', '2023-05-16 07:55:15'),
(53, '256777205339', 'This is a bulk test', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 07:55:15', '2023-05-16 07:55:15'),
(54, '256777205339', 'This is a bulk test', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 07:55:15', '2023-05-16 07:55:15'),
(55, '256777205339', 'This is a bulk test', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 07:55:15', '2023-05-16 07:55:15'),
(56, '256777205339', 'This is a bulk test', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 07:55:15', '2023-05-16 07:55:15'),
(57, '256777205339', 'This is a bulk test', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 07:55:15', '2023-05-16 07:55:15'),
(58, '256777205339', 'This is a bulk test', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 07:55:15', '2023-05-16 07:55:15'),
(59, '256777205339', 'This is a bulk test', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 07:55:15', '2023-05-16 07:55:15'),
(60, '256777205339', 'This is a bulk test', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 07:55:15', '2023-05-16 07:55:15'),
(61, '256777205339', 'This is a bulk test', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 07:55:15', '2023-05-16 07:55:15'),
(62, '256777205339', 'This is a bulk test', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 07:55:15', '2023-05-16 07:55:15'),
(63, '256777205339', 'This is a bulk test', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 07:55:15', '2023-05-16 07:55:15'),
(64, '256777205339', 'This is a bulk test', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 07:55:15', '2023-05-16 07:55:15'),
(65, '256777205339', 'This is a bulk test', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 07:55:15', '2023-05-16 07:55:15'),
(66, '256777205339', 'This is a bulk test', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 07:55:15', '2023-05-16 07:55:15'),
(67, '256777205339', 'TEst bulk evening', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 13:04:37', '2023-05-16 13:04:37'),
(68, '256777205339', 'TEst bulk evening', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 13:04:37', '2023-05-16 13:04:37'),
(69, '256777205339', 'TEst bulk evening', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 13:04:37', '2023-05-16 13:04:37'),
(70, '256777205339', 'TEst bulk evening', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 13:04:37', '2023-05-16 13:04:37'),
(71, '256777205339', 'TEst bulk evening', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 13:04:37', '2023-05-16 13:04:37'),
(72, '256777205339', 'TEst bulk evening', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 13:04:37', '2023-05-16 13:04:37'),
(73, '256777205339', 'TEst bulk evening', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 13:04:37', '2023-05-16 13:04:37'),
(74, '256777205339', 'TEst bulk evening', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 13:04:37', '2023-05-16 13:04:37'),
(75, '256777205339', 'TEst bulk evening', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 13:04:37', '2023-05-16 13:04:37'),
(76, '256777205339', 'TEst bulk evening', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 13:04:37', '2023-05-16 13:04:37'),
(77, '256777205339', 'TEst bulk evening', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 13:04:37', '2023-05-16 13:04:37'),
(78, '256777205339', 'TEst bulk evening', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-16 13:04:37', '2023-05-16 13:04:37'),
(79, '256777205339', 'test', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-22 12:06:39', '2023-05-22 12:06:39'),
(80, '785987778', 'hello Kiwanuka, Please come pick your child Jeff from school latest yesto', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-23 07:19:19', '2023-05-23 07:19:19'),
(81, '706014375', 'hello Misaga, Please come pick your child Elon from school latest today', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-23 07:19:19', '2023-05-23 07:19:19'),
(82, '785987778', 'hello Ivan, Please come pick your child Zuckerberg from school latest tomox', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-23 07:19:19', '2023-05-23 07:19:19'),
(83, '785987779', 'hello Kiwanuka, Please come pick your child Jeff from school latest yesto', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-23 07:19:19', '2023-05-23 07:19:19'),
(84, '785987780', 'hello Kiwanuka, Please come pick your child Jeff from school latest yesto', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-23 07:19:19', '2023-05-23 07:19:19'),
(85, '785987781', 'hello Kiwanuka, Please come pick your child Jeff from school latest yesto', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-23 07:19:19', '2023-05-23 07:19:19'),
(86, '785987782', 'hello Kiwanuka, Please come pick your child Jeff from school latest yesto', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-23 07:19:19', '2023-05-23 07:19:19'),
(87, '785987786', 'hello Kiwanuka, Please come pick your child Jeff from school latest yesto', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-23 07:19:19', '2023-05-23 07:19:19'),
(88, '785987783', 'hello Kiwanuka, Please come pick your child Jeff from school latest yesto', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-23 07:19:19', '2023-05-23 07:19:19'),
(89, '785987785', 'hello Kiwanuka, Please come pick your child Jeff from school latest yesto', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-23 07:19:19', '2023-05-23 07:19:19'),
(90, '785987784', 'hello Kiwanuka, Please come pick your child Jeff from school latest yesto', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-23 07:19:19', '2023-05-23 07:19:19'),
(91, '785987787', 'hello Kiwanuka, Please come pick your child Jeff from school latest yesto', 1, '1', 'SMS-Portal', 'Sure Test', 'sent', '2023-05-23 07:19:19', '2023-05-23 07:19:19');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `messageId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `phoneNumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `clientId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`messageId`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`messageId`, `phoneNumber`, `message`, `clientId`, `sender`, `status`, `created_at`, `updated_at`) VALUES
(1, '0777205339', 'Hello hello', '1', 'surepay', 'pending', '2023-03-07 09:03:07', '2023-03-07 09:03:07'),
(2, '0777205339', 'Hello', '1', 'surepay', 'pending', '2023-03-07 09:16:57', '2023-03-07 09:16:57'),
(3, '0777205339', 'Hello', '1', 'surepay', 'pending', '2023-03-07 09:17:57', '2023-03-07 09:17:57'),
(4, '0777205339', 'Hello', '1', 'surepay', 'pending', '2023-03-07 09:21:08', '2023-03-07 09:21:08'),
(5, '0777205339', 'Hello', '1', 'surepay', 'pending', '2023-03-07 09:21:35', '2023-03-07 09:21:35'),
(6, '0777205339', 'Hello', '1', 'surepay', 'pending', '2023-03-07 09:22:36', '2023-03-07 09:22:36'),
(7, '0777205339', 'Hello', '1', 'surepay', 'pending', '2023-03-07 09:23:00', '2023-03-07 09:23:00'),
(8, '0777205339', 'Hello', '1', 'surepay', 'pending', '2023-03-07 09:23:55', '2023-03-07 09:23:55'),
(9, '256777205339', 'this is test', '1', 'surepay', 'sent', '2023-04-14 14:03:05', '2023-04-14 14:03:05'),
(10, '256777205339', 'Hello this is a test', '1', 'surepay', 'sent', '2023-05-07 15:07:15', '2023-05-07 15:07:15'),
(11, '256777205339', 'Test', '1', 'surepay', 'sent', '2023-05-09 07:43:29', '2023-05-09 07:43:29');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2023_03_07_074257_create_message_table', 1),
(3, '2023_04_12_113319_create_user_migration', 1),
(4, '2023_04_12_113719_create_vendor_table', 1),
(5, '2023_04_12_113908_create_admin_table', 1),
(6, '2023_04_12_114057_create_transaction_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

DROP TABLE IF EXISTS `queue`;
CREATE TABLE IF NOT EXISTS `queue` (
  `queueId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `messageId` int(11) NOT NULL,
  PRIMARY KEY (`queueId`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `queue`
--

INSERT INTO `queue` (`queueId`, `messageId`) VALUES
(1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `transaction_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vendorId` int(11) NOT NULL,
  `userId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transRef` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transType` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` bigint(20) NOT NULL,
  `creditsBefore` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `creditsAfter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `vendorId`, `userId`, `transRef`, `transType`, `amount`, `creditsBefore`, `creditsAfter`, `details`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '0', '23456', 'creditTopout', 0, '25', '275', 'this is a test', 'success', '2023-04-13 11:47:33', '2023-04-13 11:47:33'),
(2, 1, '0', '23456', 'creditTopout', 10000, '25', '275', 'This is a test', 'success', '2023-04-13 11:51:42', '2023-04-13 11:51:42'),
(3, 1, '0', '34546', 'creditTopout', 4000, '275', '375', 'Credit topup test', 'success', '2023-04-14 07:01:06', '2023-04-14 07:01:06'),
(4, 1, '0', '3454654', 'creditTopout', 2000, '375', '425', 'TEst', 'success', '2023-04-14 07:20:50', '2023-04-14 07:20:50'),
(5, 3, '0', '3454654', 'creditTopout', 4000, '0', '100', 'test', 'success', '2023-04-14 07:21:39', '2023-04-14 07:21:39'),
(6, 1, '0', 'sdahfgjksd', 'creditTopout', 1000, '425', '450', 'this is a test', 'success', '2023-04-14 10:21:56', '2023-04-14 10:21:56'),
(7, 1, '0', 'jhdsjka', 'creditTopout', 2000, '450', '500', 'This is a test', 'success', '2023-04-14 10:44:46', '2023-04-14 10:44:46'),
(8, 1, '0', 'kjadhskx', 'creditTopout', 10000, '500', '750', 'thi', 'success', '2023-04-14 11:20:57', '2023-04-14 11:20:57'),
(9, 2, '0', 'sdahfgjksd', 'creditTopout', 100, '0', '3', 'this', 'success', '2023-04-24 07:27:29', '2023-04-24 07:27:29'),
(10, 1, '0', 'yes', 'creditTopout', 100, '750', '755', 'yes', 'success', '2023-04-24 07:27:58', '2023-04-24 07:27:58'),
(11, 4, '0', '23456', 'creditTopout', 100, '0', '3', 'yes', 'success', '2023-04-24 07:30:06', '2023-04-24 07:30:06'),
(12, 1, '0', '23456', 'creditTopout', 100, '755', '760', 'yes', 'success', '2023-04-24 07:30:31', '2023-04-24 07:30:31'),
(13, 1, '0', '212121', 'Credit Transfer', 0, '730', '720', 'Credit tranfer of 10 sms credits to Test Vendor', 'success', '2023-05-08 18:13:14', '2023-05-08 18:13:14'),
(14, 1, '0', '212121', 'Credit Transfer', 0, '730', '720', 'Credit tranfer of 10 sms credits to Test Vendor', 'success', '2023-05-08 18:14:54', '2023-05-08 18:14:54'),
(15, 2, '0', '211683580494', 'Affiliate Credit Topup', 0, '21', '31', 'Credit top up of 10 sms credits', 'success', '2023-05-08 18:14:54', '2023-05-08 18:14:54'),
(16, 1, '0', '212121', 'Credit Transfer', 0, '720', '710', 'Credit tranfer of 10 sms credits to Test Vendor', 'success', '2023-05-09 02:30:17', '2023-05-09 02:30:17'),
(17, 2, '0', '211683610217', 'Affiliate Credit Topup', 0, '31', '41', 'Credit top up of 10 sms credits', 'success', '2023-05-09 02:30:17', '2023-05-09 02:30:17'),
(18, 1, '0', '212121', 'Credit Transfer', 0, '710', '690', 'Credit tranfer of 20 sms credits to Test Affiliate', 'success', '2023-05-09 04:03:40', '2023-05-09 04:03:40'),
(19, 6, '0', '211683615820', 'Affiliate Credit Topup', 0, '0', '20', 'Credit top up of 20 sms credits', 'success', '2023-05-09 04:03:40', '2023-05-09 04:03:40'),
(20, 1, '0', 'Tres', 'creditTopout', 10000, '654', '1154', 'Yes', 'success', '2023-05-16 07:29:49', '2023-05-16 07:29:49'),
(21, 1, '0', 'test', 'creditTopout', 1000, '', '', 'Test', 'rejected', '2023-05-16 10:42:53', '2023-05-16 10:42:53'),
(22, 1, '0', 'test top up', 'creditTopout', 10000, '', '', 'Test top up', 'success', '2023-05-17 04:21:21', '2023-05-17 04:21:21'),
(23, 1, '0', 'Tres', 'creditTopout', 1000, '1642', '1692', 'Test', 'approved', '2023-05-17 05:17:33', '2023-05-17 05:17:33'),
(24, 1, '0', 'Test transaction', 'creditTopout', 4000, '', '', 'test', 'pending', '2023-05-17 05:41:50', '2023-05-17 05:41:50'),
(25, 3, '0', '23456', 'creditTopout', 4000, '', '', 'test', 'pending', '2023-05-18 08:56:05', '2023-05-18 08:56:05');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vendorId` int(11) NOT NULL,
  `userName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pwd` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `vendorId`, `userName`, `contact`, `email`, `pwd`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'hAnZ', '256777205339', 'hanningtonkizza@gmail.com', 'hanz', 'active', NULL, NULL),
(2, 1, 'Kityo', '256705456656', 'kityo@gmail.com', 'sure', 'active', '2023-04-14 08:37:06', '2023-04-14 08:37:06');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

DROP TABLE IF EXISTS `vendor`;
CREATE TABLE IF NOT EXISTS `vendor` (
  `vendorId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rate` bigint(20) NOT NULL,
  `credits` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `referorId` bigint(20) NOT NULL,
  `pwd` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`vendorId`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendorId`, `name`, `contact`, `email`, `rate`, `credits`, `type`, `referorId`, `pwd`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Sure Test', '256777205339', 'hanningtonkizza@gmail.com', 20, '1679', 'independent', 0, 'hanz', 'active', NULL, '2023-05-17 05:17:52'),
(2, 'Test Vendor', '256777205', 'hanningtonkizza67@gmail.com', 40, '41', 'affiliate', 1, 'hanz', 'active', '2023-04-14 05:46:25', '2023-05-09 02:30:17'),
(3, 'Test Vendor', '256777205', 'hanningtonkizza87@gmail.com', 40, '100', 'independent', 0, 'hanz', 'active', '2023-04-14 05:49:52', '2023-04-14 07:21:39'),
(4, 'TestVendor3', '256777205339', 'hanningtonkizza56768@gmail.com', 40, '3', 'independent', 0, 'hanz', 'active', '2023-04-24 03:51:41', '2023-04-24 07:30:06'),
(5, 'Hannington Kizza', '256777205339', 'hanningtonkizzatest@gmail.com', 40, '0', 'independent', 0, 'hanz', 'active', '2023-04-24 03:59:18', '2023-04-24 03:59:18'),
(6, 'Test Affiliate', '256777205339', 'test@gmail.com', 0, '20', 'affiliate', 1, 'lcf34x', 'active', '2023-05-09 03:57:38', '2023-05-09 04:03:40'),
(7, 'Test Affiliate 2', '256777205339', 'test2@gmail.com', 0, '0', 'affiliate', 1, '4xyni8', 'active', '2023-05-09 04:00:09', '2023-05-09 04:00:09'),
(8, 'Test Affiliate', '256777205339', 'testaffiliate@gmail.com', 0, '0', 'affiliate', 1, 'ad7yqo', 'active', '2023-05-17 08:59:04', '2023-05-17 08:59:04'),
(9, 'elvis onyango', '0775136124', 'elviszazu@gmail.com', 0, '0', 'affiliate', 1, '8icrjo', 'active', '2023-05-18 08:41:24', '2023-05-18 08:41:24');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
