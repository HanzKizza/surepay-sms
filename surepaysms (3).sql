-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 19, 2023 at 09:28 AM
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
  `pwd` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `contact`, `email`, `pwd`, `status`, `created_at`, `updated_at`) VALUES
(1, 'hAnZ', '256777205339', 'hanningtonkizza@gmail.com', 'hanz', 'active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `messageId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `phoneNumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `service` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`messageId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(9, '256777205339', 'this is test', '1', 'surepay', 'sent', '2023-04-14 14:03:05', '2023-04-14 14:03:05');

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(8, 1, '0', 'kjadhskx', 'creditTopout', 10000, '500', '750', 'thi', 'success', '2023-04-14 11:20:57', '2023-04-14 11:20:57');

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
  `credits` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pwd` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`vendorId`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendorId`, `name`, `contact`, `email`, `credits`, `pwd`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Sure Test', '256777205339', 'hanningtonkizza@gmail.com', '750', 'hanz', 'active', NULL, '2023-04-14 11:20:57'),
(2, 'Test Vendor', '256777205', 'hanningtonkizza67@gmail.com', '0', '$2y$10$Qq/e5WJMQaSP2nVUNmc.Ruzh6grhaPm7gPJz/Kn68hKQNOSx6UnRy', 'active', '2023-04-14 05:46:25', '2023-04-14 05:46:25'),
(3, 'Test Vendor', '256777205', 'hanningtonkizza87@gmail.com', '100', 'hanz', 'active', '2023-04-14 05:49:52', '2023-04-14 07:21:39');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
