-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 23, 2023 at 07:46 AM
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
-- Database: `akcdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `code` varchar(25) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `code`, `user_id`) VALUES
(1, 'Company 1', 'C1', 'akshaycoir'),
(34, 'Company 2', 'C200', 'new'),
(35, 'Akshay Coir', 'AKC1', 'new'),
(36, 'Company MAIN', 'cm', 'akshaycoir'),
(37, 'Company 3', 'c3', 'akshaycoir');

-- --------------------------------------------------------

--
-- Table structure for table `company_products`
--

DROP TABLE IF EXISTS `company_products`;
CREATE TABLE IF NOT EXISTS `company_products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(25) NOT NULL,
  `name` varchar(50) NOT NULL,
  `design` varchar(25) NOT NULL,
  `size` varchar(25) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `company_products`
--

INSERT INTO `company_products` (`id`, `code`, `name`, `design`, `size`, `user_id`) VALUES
(30, 'ACP050', 'Vinyl back 15mm Natural', 'Plain', '40 X 120 cm', 'akshaycoir'),
(32, 'ACP051', 'Vinyl back 15mm Natural', 'Plain', '45 X 75 cm', 'akshaycoir'),
(33, 'NWP001', 'Vinyl back 15mm Natural', 'Plain', '45 X 75 cm', 'new');

-- --------------------------------------------------------

--
-- Table structure for table `inpass`
--

DROP TABLE IF EXISTS `inpass`;
CREATE TABLE IF NOT EXISTS `inpass` (
  `no` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `source` varchar(125) NOT NULL,
  `woc` varchar(125) NOT NULL,
  `op` varchar(25) NOT NULL,
  `vehicleno` varchar(50) NOT NULL,
  `extras` varchar(125) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'inpass',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inpass`
--

INSERT INTO `inpass` (`no`, `date`, `source`, `woc`, `op`, `vehicleno`, `extras`, `type`, `timestamp`, `user_id`) VALUES
('1', '2023-07-23', 'Company MAIN', 'cm', '123', 'KL 23 BC 2982', 'test product', 'inpass', '2023-07-23 07:03:59', 'akshaycoir'),
('2', '2023-03-31', 'Company MAIN', 'cm', '1', 'KL 33 BC 1920', '', 'inpass', '2023-07-23 07:17:40', 'akshaycoir');

-- --------------------------------------------------------

--
-- Table structure for table `inpass_products`
--

DROP TABLE IF EXISTS `inpass_products`;
CREATE TABLE IF NOT EXISTS `inpass_products` (
  `inpass_no` int NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_code` varchar(25) NOT NULL,
  `product_design` varchar(50) NOT NULL,
  `product_size` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `product_qty` int NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inpass_products`
--

INSERT INTO `inpass_products` (`inpass_no`, `product_name`, `product_code`, `product_design`, `product_size`, `product_qty`, `user_id`) VALUES
(1, 'Vinyl Back 15mm Natural', 'ACP050', 'Plain', '40x120cm', 100, 'akshaycoir'),
(1, 'Black Rubber 15mm', 'TUF059', 'plain', '40x120cm', 50, 'akshaycoir'),
(2, 'Vinyl Back 15mm Natural', 'ACP050', 'Plain', '40x120cm', 10, 'akshaycoir');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_no` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `company` varchar(25) NOT NULL,
  `company_gstin` varchar(50) NOT NULL,
  `work_order_no` varchar(25) NOT NULL,
  `place_of_supply` varchar(25) NOT NULL,
  `type_of_payment` varchar(20) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `statecode` varchar(10) NOT NULL,
  `note` varchar(50) NOT NULL,
  `gst_percentage` varchar(10) NOT NULL,
  `grand_total` varchar(20) NOT NULL,
  `cgst` varchar(20) NOT NULL,
  `sgst` varchar(20) NOT NULL,
  `less_ro` varchar(10) NOT NULL,
  `total_amount` varchar(30) NOT NULL,
  `mode_of_transport` varchar(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` varchar(50) NOT NULL,
  UNIQUE KEY `invoice_no` (`invoice_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_data`
--

DROP TABLE IF EXISTS `invoice_data`;
CREATE TABLE IF NOT EXISTS `invoice_data` (
  `invoice_no` varchar(25) NOT NULL,
  `work_order_no` varchar(25) NOT NULL,
  `product_slno` int NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `size` varchar(50) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `nopcs` float NOT NULL,
  `rm` float NOT NULL,
  `total_unit` varchar(25) NOT NULL,
  `rate` float NOT NULL,
  `gst` float NOT NULL,
  `amount` float NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `outpass`
--

DROP TABLE IF EXISTS `outpass`;
CREATE TABLE IF NOT EXISTS `outpass` (
  `no` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `work_order_no` varchar(25) NOT NULL,
  `dest` varchar(125) NOT NULL,
  `woc` varchar(125) NOT NULL,
  `vehicleno` varchar(50) NOT NULL,
  `extras` varchar(125) NOT NULL,
  `invoice_no` varchar(20) NOT NULL DEFAULT 'Not Generated',
  `type` varchar(10) NOT NULL DEFAULT 'outpass',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` varchar(50) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `outpass`
--

INSERT INTO `outpass` (`no`, `date`, `work_order_no`, `dest`, `woc`, `vehicleno`, `extras`, `invoice_no`, `type`, `timestamp`, `user_id`) VALUES
(1, '2023-07-23', 'AKC001', 'Company MAIN', 'cm', 'KL 33 BC 1923', '', 'Not Generated', 'outpass', '2023-07-23 07:21:59', 'akshaycoir');

-- --------------------------------------------------------

--
-- Table structure for table `outpass_products`
--

DROP TABLE IF EXISTS `outpass_products`;
CREATE TABLE IF NOT EXISTS `outpass_products` (
  `outpass_no` int NOT NULL,
  `product_type` varchar(15) NOT NULL DEFAULT 'finished',
  `product_name` varchar(50) NOT NULL,
  `work_order` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `product_code` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'AAC(code)',
  `product_design` varchar(50) NOT NULL,
  `product_size` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `product_qty` int NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `outpass_products`
--

INSERT INTO `outpass_products` (`outpass_no`, `product_type`, `product_name`, `work_order`, `product_code`, `product_design`, `product_size`, `product_qty`, `user_id`) VALUES
(1, 'Finished', 'Vinyl back 15mm Natural', 'AKC001', 'ACP051', 'Plain', '45 X 75 cm', 40, 'akshaycoir');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `name` varchar(125) NOT NULL,
  `code` varchar(125) NOT NULL,
  `design` varchar(25) NOT NULL,
  `size` varchar(25) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'finished',
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`name`, `code`, `design`, `size`, `type`, `user_id`) VALUES
('Vinyl Back 15mm Natural', 'ACP050', 'Plain', '40x120cm', 'finished', 'akshaycoir'),
('Black Rubber 15mm', 'TUF059', 'plain', '40x120cm', 'finished', 'akshaycoir');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `name` varchar(50) NOT NULL,
  `wo` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `gstin` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`name`, `wo`, `gstin`, `user_id`, `password`) VALUES
('Akshay Coir', 'akc', 'GSTIN0000001', 'akshaycoir', '$2y$10$qHN0ldGy/uQ3yG6MV7RSkuFXtM9W/WwltD1MPWVUS7ykkDgrYkTBC'),
('New', 'new1', 'GSTINnew', 'new', '$2y$10$shEZyT6vpVzwaxSxvu3AsOjVNDpCLwD/u5ai2Gf0AsfJ2tBjq.pye');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `index` int NOT NULL AUTO_INCREMENT,
  `grade` varchar(25) NOT NULL,
  `code` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'NULL',
  `item` varchar(50) NOT NULL,
  `design` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'NULL',
  `size` varchar(25) NOT NULL,
  `qty` int NOT NULL,
  `default` int NOT NULL DEFAULT '1',
  `user_id` varchar(50) NOT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`index`, `grade`, `code`, `item`, `design`, `size`, `qty`, `default`, `user_id`) VALUES
(1, '', 'NULL', 'Vinyl Back 15mm Natural', 'Plain', '40x120cm', 70, 1, 'akshaycoir'),
(2, '', 'NULL', 'Black Rubber 15mm', 'plain', '40x120cm', 50, 1, 'akshaycoir');

-- --------------------------------------------------------

--
-- Table structure for table `stock_data`
--

DROP TABLE IF EXISTS `stock_data`;
CREATE TABLE IF NOT EXISTS `stock_data` (
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `product_name` varchar(50) NOT NULL,
  `product_size` varchar(25) NOT NULL,
  `product_qty` int NOT NULL,
  `total_qty` int NOT NULL,
  `type` varchar(15) NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stock_data`
--

INSERT INTO `stock_data` (`timestamp`, `product_name`, `product_size`, `product_qty`, `total_qty`, `type`, `user_id`) VALUES
('2023-07-23 12:33:59', 'Vinyl Back 15mm Natural', '40x120cm', 100, 100, 'Inpass', 'akshaycoir'),
('2023-07-23 12:33:59', 'Black Rubber 15mm', '40x120cm', 50, 50, 'Inpass', 'akshaycoir'),
('2023-07-23 12:47:40', 'Vinyl Back 15mm Natural', '40x120cm', 10, 110, 'Inpass', 'akshaycoir'),
('2023-07-23 12:51:59', 'Vinyl Back 15mm Natural', '40x120cm', 40, 70, 'Outpass', 'akshaycoir');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE IF NOT EXISTS `vehicles` (
  `type` varchar(50) NOT NULL,
  `number` varchar(50) NOT NULL,
  `owner` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`type`, `number`, `owner`, `user_id`) VALUES
('Pick-Up', 'KL 33 BC 1920', 'Company', 'akshaycoir'),
('Pick-Up', 'KL 33 BC 1921', 'Others', 'akshaycoir'),
('Pick-Up', 'KL 33 BC 1923', 'Others', 'akshaycoir'),
('Pick-up', 'KL 05 B 2834', 'Others', 'akshaycoir'),
('Pick-up', 'KL 00 BC 0000', 'Company', 'new');

-- --------------------------------------------------------

--
-- Table structure for table `work_orders`
--

DROP TABLE IF EXISTS `work_orders`;
CREATE TABLE IF NOT EXISTS `work_orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `work_order_no` varchar(25) NOT NULL,
  `company` varchar(50) NOT NULL,
  `extras` varchar(50) NOT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Open',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `work_order_no` (`work_order_no`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `work_orders`
--

INSERT INTO `work_orders` (`id`, `date`, `work_order_no`, `company`, `extras`, `status`, `timestamp`, `user_id`) VALUES
(1, '2023-07-23', 'AKC001', 'Company MAIN', '', 'Open', '2023-07-23 07:21:22', 'akshaycoir');

-- --------------------------------------------------------

--
-- Table structure for table `work_order_products`
--

DROP TABLE IF EXISTS `work_order_products`;
CREATE TABLE IF NOT EXISTS `work_order_products` (
  `work_order_no` varchar(25) NOT NULL,
  `code` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `design` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `size` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `features` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `qty` int NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `work_order_products`
--

INSERT INTO `work_order_products` (`work_order_no`, `code`, `name`, `design`, `size`, `features`, `qty`, `user_id`) VALUES
('AKC001', 'ACP051', 'Vinyl back 15mm Natural', 'Plain', '45 X 75 cm', '', 10, 'akshaycoir');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
