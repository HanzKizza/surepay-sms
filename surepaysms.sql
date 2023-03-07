-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 07, 2023 at 01:23 PM
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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(8, '0777205339', 'Hello', '1', 'surepay', 'pending', '2023-03-07 09:23:55', '2023-03-07 09:23:55');

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
