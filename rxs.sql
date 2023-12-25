-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 21, 2023 at 09:05 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rxs`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client`
--

DROP TABLE IF EXISTS `tbl_client`;
CREATE TABLE IF NOT EXISTS `tbl_client` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `middlename` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jersey_type`
--

DROP TABLE IF EXISTS `tbl_jersey_type`;
CREATE TABLE IF NOT EXISTS `tbl_jersey_type` (
  `id` tinyint NOT NULL AUTO_INCREMENT,
  `jersey_type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_jersey_type`
--

INSERT INTO `tbl_jersey_type` (`id`, `jersey_type`) VALUES
(1, 'Upper and Lower'),
(2, 'Upper Only');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

DROP TABLE IF EXISTS `tbl_orders`;
CREATE TABLE IF NOT EXISTS `tbl_orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `transaction_id` int NOT NULL,
  `invoice_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `shirt_code` varchar(50) NOT NULL,
  `shirt_price` varchar(50) NOT NULL,
  `jersey_number` int NOT NULL,
  `size_id` int NOT NULL,
  `team_name` varchar(50) NOT NULL,
  `jersey_type_id` int NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shirt`
--

DROP TABLE IF EXISTS `tbl_shirt`;
CREATE TABLE IF NOT EXISTS `tbl_shirt` (
  `id` int NOT NULL AUTO_INCREMENT,
  `shirt_title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `shirt_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `shirt_price` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `img_url` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `shirt_category_id` tinyint NOT NULL,
  `jersey_type_id` tinyint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shirt_category` (`shirt_category_id`),
  KEY `jersey_type_id` (`jersey_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_shirt`
--

INSERT INTO `tbl_shirt` (`id`, `shirt_title`, `shirt_code`, `shirt_price`, `img_url`, `shirt_category_id`, `jersey_type_id`) VALUES
(1, 'Full Sublimation Basketball Jersey', 'P0001', '200', 'P1.jpg', 1, 2),
(2, 'Full Sublimation Basketball Jersey', 'P0002', '200', 'P2.jpg', 1, 2),
(3, 'Full Sublimation Volleyball Jersey', 'P0003', '200', 'P3.jpg', 1, 2),
(4, 'Full Sublimation Volleyball Jersey', 'P0004', '200', 'P4.jpg', 1, 2),
(5, 'Full Sublimation Basketball Jersey', 'P0005', '200', 'P5.jpg', 1, 2),
(6, 'Full Sublimation Basketball Jersey', 'P0006', '200', 'P6.jpg', 1, 2),
(7, 'Full Sublimation Volleyball Jersey', 'P0007', '200', 'P7.jpg', 1, 2),
(8, 'Full Sublimation Basketball Jersey', 'P0008', '200', 'P8.jpg', 1, 2),
(9, 'Full Sublimation Basketball Jersey', 'P0009', '200', 'P9.jpg', 1, 2),
(10, 'Full Sublimation Basketball Jersey', 'P0010', '200', 'P10.jpg', 1, 2),
(11, 'Full Sublimation Basketball Jersey', 'P0011', '200', 'P11.jpg', 1, 1),
(12, 'Full Sublimation Basketball Jersey', 'P0012', '200', 'P12.jpg', 1, 2),
(13, 'Full Sublimation Basketball Jersey', 'P0013', '200', 'P13.jpg', 1, 1),
(14, 'Full Sublimation Basketball Jersey', 'P0014', '200', 'TP1.jpg', 1, 2),
(15, 'Full Sublimation Basketball Jersey', 'P0015', '200', 'TP2.jpg', 1, 2),
(16, 'Full Sublimation Basketball Jersey', 'P0016', '200', 'TP3.jpg', 1, 2),
(17, 'Full Sublimation Basketball Jersey', 'P0017', '200', 'TP4.jpg', 1, 2),
(18, 'Full Sublimation Basketball Jersey', 'P0018', '200', 'TP5.jpg', 1, 2),
(19, 'Full Sublimation Basketball Jersey', 'P0019', '200', 'TP6.jpg', 1, 2),
(20, 'Full Sublimation Basketball Jersey', 'P0020', '200', 'TP7.jpg', 1, 2),
(21, 'Full Sublimation Basketball Jersey', 'P0021', '200', 'TP8.jpg', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shirt_category`
--

DROP TABLE IF EXISTS `tbl_shirt_category`;
CREATE TABLE IF NOT EXISTS `tbl_shirt_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `shirt_category` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_shirt_category`
--

INSERT INTO `tbl_shirt_category` (`id`, `shirt_category`) VALUES
(1, 'Basketball'),
(2, 'Volleyball'),
(3, 'Badminton'),
(4, 'Table Tennis'),
(5, 'Football');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_size`
--

DROP TABLE IF EXISTS `tbl_size`;
CREATE TABLE IF NOT EXISTS `tbl_size` (
  `id` tinyint NOT NULL AUTO_INCREMENT,
  `size` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_size`
--

INSERT INTO `tbl_size` (`id`, `size`) VALUES
(1, 'Small'),
(2, 'Medium'),
(3, 'Large'),
(4, 'Exrta Large'),
(5, 'Double Extra Large');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

DROP TABLE IF EXISTS `tbl_transaction`;
CREATE TABLE IF NOT EXISTS `tbl_transaction` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_id` int NOT NULL,
  `shirt_title_id` int NOT NULL,
  `shirt_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `shirt_price` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `order_quantity` int NOT NULL,
  `total_payment` int NOT NULL,
  `img_url` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `shirt_category_id` int NOT NULL,
  `transaction_status` int NOT NULL,
  `team_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jersey_type_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  KEY `shirt_title` (`shirt_title_id`),
  KEY `shirt_category` (`shirt_category_id`),
  KEY `transaction_status` (`transaction_status`),
  KEY `jersey_type_id` (`jersey_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction_status`
--

DROP TABLE IF EXISTS `tbl_transaction_status`;
CREATE TABLE IF NOT EXISTS `tbl_transaction_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `transaction_status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_transaction_status`
--

INSERT INTO `tbl_transaction_status` (`id`, `transaction_status`) VALUES
(1, 'Pending'),
(2, 'On-progress'),
(3, 'Confirmed');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
