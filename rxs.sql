-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 25, 2023 at 08:47 AM
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
-- Table structure for table `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `email`, `username`, `password`, `firstname`, `middlename`, `lastname`) VALUES
(1, 'admin@admin.com', 'admin1', 'e00cf25ad42683b3df678c61f42c6bda', 'admin_fn-admin1', 'admin_mn-admin1', 'admin_ln-admin1'),
(2, 'admin2@admin2.com', 'admin2', 'c84258e9c39059a89ab77d846ddab909', 'admin_fn-admin2', 'admin_mn-admin2', 'admin_ln-admin2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client`
--

DROP TABLE IF EXISTS `tbl_client`;
CREATE TABLE IF NOT EXISTS `tbl_client` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `middlename` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_client`
--

INSERT INTO `tbl_client` (`id`, `email`, `username`, `password`, `firstname`, `middlename`, `lastname`) VALUES
(4, 'client1@gmail.com', 'client1', 'a165dd3c2e98d5d607181d0b87a4c66b', 'Juan', '', 'Dela Cruz'),
(5, 'client2@gmail.com', 'client2', '2c66045d4e4a90814ce9280272e510ec', 'Coco', '', 'Martin'),
(6, 'client3@gmail.com', 'client3', 'c27af3f6460eb10979adb366fc7f6856', 'Tanggol', '', 'Dimagiba'),
(7, 'client4@gmail.com', 'client4', 'de285ec98e0f83211da217a4e1c5923e', 'Sam', '', 'Milby'),
(8, 'client5@gmail.com', 'client5', '7e8670fef6f81f377fe6e162ea1077e5', 'Piolo', '', 'Pascual'),
(9, 'client6@gmail.com', 'client6', '9dc5beb30a97d0e3ad847db4774c6ac9', 'Jericho', '', 'Rosales'),
(10, 'client7@gmail.com', 'client7', 'ab5b1c502ce04b8960af53d4e05d651b', 'Dether', '', 'Ocampo'),
(11, 'client8@gmail.com', 'client8', 'c2fe3d4ec1bf9ae28fca65f73a7f324e', 'Vhong', '', 'Navarro'),
(12, 'client9@gmail.com', 'client9', '6598d72ef2d225ac18b294dc8acc85a2', 'Jong', '', 'Hilario'),
(13, 'client10@gmail.com', 'client10', '9ea481b7715dc310cace283bb5258d55', 'Vice', '', 'Ganda'),
(14, 'client11@gmail.com', 'client11', 'ee94ee42f3ffa6427c3919669e4d065c', 'Amy', '', 'Perez'),
(15, 'client12@gmail.com', 'client12', 'feccd19e5eaa7e8f0452f048e3330884', 'Kariel', '', 'Gutierez'),
(16, 'client13@gmail.com', 'client13', '9005a9c76bbdb5cf6c9f69d10178f60d', 'Kim', '', 'Chui'),
(17, 'client14@gmail.com', 'client14', '012a3d7712575af011ed6a423197c4b1', 'Anne', '', 'Curtis'),
(18, 'client15@gmail.com', 'client15', '59c93bbf2283f88f5ee75b2659ccb35b', 'Ryan', '', 'Bang'),
(19, 'client16@gmail.com', 'client16', 'd604e45d0b7ec1840002ee121d390ad6', 'Ion', '', 'Perez'),
(20, 'client17@gmail.com', 'client17', '320224f5fddedac5d4fb3dbde7b41d86', 'Jackie', '', 'Chan'),
(21, 'client18@gmail.com', 'client18', 'c7b470b16ad9b4164f2689513665fc16', 'Jet', '', 'Li'),
(22, 'client19@gmail.com', 'client19', '9a53b1c3fc4232d96e8faea6265e9f63', 'Bruce', '', 'Lee'),
(23, 'client20@gmail.com', 'client20', '368a94c98923133ca122ca11e0ab05e4', 'Wil', '', 'Lei');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customize`
--

DROP TABLE IF EXISTS `tbl_customize`;
CREATE TABLE IF NOT EXISTS `tbl_customize` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bg_color` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name_input` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name_direction` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `team_name_input` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `team_name_direction` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `number_input` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `number_direction` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `logo` varchar(50) NOT NULL,
  `pattern` varchar(50) NOT NULL,
  `font` varchar(50) NOT NULL,
  `client_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_customize`
--

INSERT INTO `tbl_customize` (`id`, `bg_color`, `name_input`, `name_direction`, `team_name_input`, `team_name_direction`, `number_input`, `number_direction`, `logo`, `pattern`, `font`, `client_id`) VALUES
(2, 'bg-secondary', 'Engbino', 'name-position-top', 'Team Bu-ok', 'team-name-position-top', '04', 'number-position-front-right', 'logo2', 'pattern3', 'Times New Roman', 4);

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
-- Table structure for table `tbl_logos`
--

DROP TABLE IF EXISTS `tbl_logos`;
CREATE TABLE IF NOT EXISTS `tbl_logos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `img_url` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_logos`
--

INSERT INTO `tbl_logos` (`id`, `img_url`) VALUES
(1, 'GSW.png'),
(2, 'MAVERICKS.png'),
(3, 'RAPTORS.png'),
(4, 'WOLVES.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

DROP TABLE IF EXISTS `tbl_orders`;
CREATE TABLE IF NOT EXISTS `tbl_orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `img_url` varchar(50) NOT NULL,
  `shirt_id` int NOT NULL,
  `invoice_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `shirt_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `shirt_price` varchar(50) NOT NULL,
  `jersey_number` int NOT NULL,
  `size_id` int NOT NULL,
  `team_name` varchar(50) NOT NULL,
  `jersey_type_id` int NOT NULL,
  `transaction_status_id` int NOT NULL,
  `client_id` int NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=126 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`id`, `img_url`, `shirt_id`, `invoice_number`, `name`, `shirt_code`, `shirt_price`, `jersey_number`, `size_id`, `team_name`, `jersey_type_id`, `transaction_status_id`, `client_id`, `created_at`, `updated_at`) VALUES
(125, 'P2.jpg', 2, 'rxs6122-002', 'Umukagi', 'P0002', '200', 36, 3, 'Team Pla', 2, 3, 4, 'December 25, 2023', 'December 25, 2023'),
(124, 'P2.jpg', 2, 'rxs6122-002', 'Meruem', 'P0002', '200', 26, 2, 'Team Pla', 2, 3, 4, 'December 25, 2023', 'December 25, 2023'),
(123, 'P2.jpg', 2, 'rxs6122-002', 'Ging', 'P0002', '200', 48, 3, 'Team Pla', 2, 3, 4, 'December 25, 2023', 'December 25, 2023'),
(122, 'P2.jpg', 2, 'rxs6122-002', 'Netero', 'P0002', '200', 62, 2, 'Team Pla', 2, 3, 4, 'December 25, 2023', 'December 25, 2023'),
(121, 'P2.jpg', 2, 'rxs6122-002', 'Illumi', 'P0002', '200', 27, 3, 'Team Pla', 2, 3, 4, 'December 25, 2023', 'December 25, 2023'),
(120, 'P2.jpg', 2, 'rxs6122-002', 'Chrollo', 'P0002', '200', 28, 3, 'Team Pla', 2, 3, 4, 'December 25, 2023', 'December 25, 2023'),
(119, 'P2.jpg', 2, 'rxs6122-002', 'Morrow', 'P0002', '200', 32, 3, 'Team Pla', 2, 3, 4, 'December 25, 2023', 'December 25, 2023'),
(118, 'P2.jpg', 2, 'rxs6122-002', 'Leorio', 'P0002', '200', 16, 3, 'Team Pla', 2, 3, 4, 'December 25, 2023', 'December 25, 2023'),
(117, 'P2.jpg', 2, 'rxs6122-002', 'Curta', 'P0002', '200', 17, 2, 'Team Pla', 2, 3, 4, 'December 25, 2023', 'December 25, 2023'),
(116, 'P2.jpg', 2, 'rxs6122-002', 'Zoldyck', 'P0002', '200', 13, 1, 'Team Pla', 2, 3, 4, 'December 25, 2023', 'December 25, 2023'),
(115, 'P2.jpg', 2, 'rxs6122-002', 'Freecs', 'P0002', '200', 12, 1, 'Team Pla', 2, 3, 4, 'December 25, 2023', 'December 25, 2023'),
(114, 'P1.jpg', 1, 'rxs6122-001', 'Juanso', 'P0001', '200', 27, 2, 'Team Bu-ok', 2, 3, 4, 'December 25, 2023', 'December 25, 2023'),
(113, 'P1.jpg', 1, 'rxs6122-001', 'Indo', 'P0001', '200', 16, 3, 'Team Bu-ok', 2, 3, 4, 'December 25, 2023', 'December 25, 2023'),
(112, 'P1.jpg', 1, 'rxs6122-001', 'Handog', 'P0001', '200', 29, 1, 'Team Bu-ok', 2, 3, 4, 'December 25, 2023', 'December 25, 2023'),
(111, 'P1.jpg', 1, 'rxs6122-001', 'Ganado', 'P0001', '200', 16, 3, 'Team Bu-ok', 2, 3, 4, 'December 25, 2023', 'December 25, 2023'),
(110, 'P1.jpg', 1, 'rxs6122-001', 'Fuli', 'P0001', '200', 21, 2, 'Team Bu-ok', 2, 3, 4, 'December 25, 2023', 'December 25, 2023'),
(109, 'P1.jpg', 1, 'rxs6122-001', 'Empera', 'P0001', '200', 14, 2, 'Team Bu-ok', 2, 3, 4, 'December 25, 2023', 'December 25, 2023'),
(108, 'P1.jpg', 1, 'rxs6122-001', 'Dulaso', 'P0001', '200', 30, 1, 'Team Bu-ok', 2, 3, 4, 'December 25, 2023', 'December 25, 2023'),
(107, 'P1.jpg', 1, 'rxs6122-001', 'Cabuya', 'P0001', '200', 2, 3, 'Team Bu-ok', 2, 3, 4, 'December 25, 2023', 'December 25, 2023'),
(106, 'P1.jpg', 1, 'rxs6122-001', 'Balusi', 'P0001', '200', 10, 2, 'Team Bu-ok', 2, 3, 4, 'December 25, 2023', 'December 25, 2023'),
(105, 'P1.jpg', 1, 'rxs6122-001', 'Abante', 'P0001', '200', 1, 1, 'Team Bu-ok', 2, 3, 4, 'December 25, 2023', 'December 25, 2023');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patterns`
--

DROP TABLE IF EXISTS `tbl_patterns`;
CREATE TABLE IF NOT EXISTS `tbl_patterns` (
  `id` int NOT NULL AUTO_INCREMENT,
  `img_url` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_patterns`
--

INSERT INTO `tbl_patterns` (`id`, `img_url`) VALUES
(1, 'pattern1.png'),
(2, 'pattern2.png'),
(3, 'pattern3.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shirt`
--

DROP TABLE IF EXISTS `tbl_shirt`;
CREATE TABLE IF NOT EXISTS `tbl_shirt` (
  `id` int NOT NULL AUTO_INCREMENT,
  `shirt_title` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `shirt_code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `shirt_price` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `img_url` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `shirt_category_id` tinyint NOT NULL,
  `jersey_type_id` tinyint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shirt_category` (`shirt_category_id`),
  KEY `jersey_type_id` (`jersey_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_shirt`
--

INSERT INTO `tbl_shirt` (`id`, `shirt_title`, `shirt_code`, `shirt_price`, `img_url`, `shirt_category_id`, `jersey_type_id`) VALUES
(1, 'Full Sublimation Basketball Jersey', 'P0001', '200', 'P1.jpg', 1, 2),
(2, 'Full Sublimation Basketball Jersey', 'P0002', '200', 'P2.jpg', 1, 2),
(3, 'Full Sublimation Volleyball Jersey', 'P0003', '200', 'P3.jpg', 2, 2),
(4, 'Full Sublimation Volleyball Jersey', 'P0004', '200', 'P4.jpg', 2, 2),
(5, 'Full Sublimation Basketball Jersey', 'P0005', '200', 'P5.jpg', 1, 2),
(6, 'Full Sublimation Basketball Jersey', 'P0006', '200', 'P6.jpg', 1, 2),
(7, 'Full Sublimation Volleyball Jersey', 'P0007', '200', 'P7.jpg', 2, 2),
(8, 'Full Sublimation Basketball Jersey', 'P0008', '200', 'P8.jpg', 1, 2),
(9, 'Full Sublimation Volleyball Jersey', 'P0009', '200', 'P9.jpg', 2, 2),
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
(21, 'Full Sublimation Basketball Jersey', 'P0021', '200', 'TP8.jpg', 1, 2),
(22, 'Feature', 'P0022', '1,000', 'Feature.jpg', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shirt_category`
--

DROP TABLE IF EXISTS `tbl_shirt_category`;
CREATE TABLE IF NOT EXISTS `tbl_shirt_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `shirt_category` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
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
  `shirt_code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `shirt_price` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `order_quantity` int NOT NULL,
  `total_payment` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `img_url` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `shirt_category_id` int NOT NULL,
  `transaction_status` int NOT NULL,
  `team_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `jersey_type_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  KEY `shirt_title` (`shirt_title_id`),
  KEY `shirt_category` (`shirt_category_id`),
  KEY `transaction_status` (`transaction_status`),
  KEY `jersey_type_id` (`jersey_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction_status`
--

DROP TABLE IF EXISTS `tbl_transaction_status`;
CREATE TABLE IF NOT EXISTS `tbl_transaction_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `transaction_status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_transaction_status`
--

INSERT INTO `tbl_transaction_status` (`id`, `transaction_status`) VALUES
(1, 'On-cart'),
(2, 'Pending'),
(3, 'On-progress'),
(4, 'Delivered');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  ADD CONSTRAINT `tbl_transaction_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `tbl_client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_transaction_ibfk_2` FOREIGN KEY (`shirt_title_id`) REFERENCES `tbl_shirt` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_transaction_ibfk_3` FOREIGN KEY (`shirt_category_id`) REFERENCES `tbl_shirt_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_transaction_ibfk_4` FOREIGN KEY (`transaction_status`) REFERENCES `tbl_transaction_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
