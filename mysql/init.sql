-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generated at: Sun, 17 Mar 2024 16:37:00
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_gift`
--

-- --------------------------------------------------------

--
-- Table structure for table `gift`
--

DROP TABLE IF EXISTS `gift`;
CREATE TABLE IF NOT EXISTS `gift` (
  `id` int NOT NULL AUTO_INCREMENT,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gift`
--

INSERT INTO `gift` (`id`, `amount`, `name`) VALUES
(3, '10', 'Component'),
(4, '20', 'Component2');

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migrations`
--

DROP TABLE IF EXISTS `doctrine_migrations`;
CREATE TABLE IF NOT EXISTS `doctrine_migrations` (
  `migration_id` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`migration_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `doctrine_migrations`
--

INSERT INTO `doctrine_migrations` (`migration_id`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240305090611', '2024-03-05 09:37:17', 309),
('DoctrineMigrations\\Version20240305102805', '2024-03-05 10:28:17', 43);

-- --------------------------------------------------------

--
-- Table structure for table `gift_list`
--

DROP TABLE IF EXISTS `gift_list`;
CREATE TABLE IF NOT EXISTS `gift_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `finished` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gift_list`
--

INSERT INTO `gift_list` (`id`, `finished`) VALUES
(2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `gift_list_gift`
--

DROP TABLE IF EXISTS `gift_list_gift`;
CREATE TABLE IF NOT EXISTS `gift_list_gift` (
  `gift_list_id` int NOT NULL,
  `gift_id` int NOT NULL,
  PRIMARY KEY (`gift_list_id`,`gift_id`),
  KEY `IDX_5301C71484A12BDD` (`gift_list_id`),
  KEY `IDX_5301C714D9D5ED84` (`gift_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gift_list_gift`
--
ALTER TABLE `gift_list_gift`
  ADD CONSTRAINT `FK_5301C71484A12BDD` FOREIGN KEY (`gift_list_id`) REFERENCES `gift_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_5301C714D9D5ED84` FOREIGN KEY (`gift_id`) REFERENCES `gift` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
