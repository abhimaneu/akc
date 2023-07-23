-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 23, 2023 at 02:55 PM
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
  `no` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `source` varchar(125) NOT NULL,
  `woc` varchar(125) NOT NULL,
  `op` varchar(25) NOT NULL,
  `vehicleno` varchar(50) NOT NULL,
  `extras` varchar(125) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'inpass',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` varchar(50) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inpass`
--

INSERT INTO `inpass` (`no`, `date`, `source`, `woc`, `op`, `vehicleno`, `extras`, `type`, `timestamp`, `user_id`) VALUES
(1, '2023-07-23', 'Company MAIN', 'cm', '123', 'KL 23 BC 2982', '', 'inpass', '2023-07-23 14:09:33', 'akshaycoir'),
(2, '2023-07-23', 'Company 3', 'c3', '123', 'KL 33 BC 1920', '', 'inpass', '2023-07-23 14:09:59', 'akshaycoir'),
(3, '2023-07-23', 'Company MAIN', 'cm', '1', 'KL 33 BC 1920', 'tset', 'inpass', '2023-07-23 14:10:35', 'akshaycoir'),
(4, '2023-07-23', 'Company 1', 'C1', '878', '1', 'test', 'inpass', '2023-07-23 14:48:53', 'akshaycoir'),
(6, '2023-07-23', 'Company 1', 'C1', '878', 'KL 23 BC 2982', '', 'inpass', '2023-07-23 14:49:06', 'akshaycoir'),
(7, '2023-07-23', 'Company 3', 'c3', '878', 'KL 23 BC 2982', '', 'inpass', '2023-07-23 14:49:29', 'akshaycoir');

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
(1, 'Vinyl Back 15mm Natural', 'ACP050', 'Plain', '40x120cm', 1, 'akshaycoir'),
(1, 'Black Rubber 15mm', 'TUF059', 'plain', '40x120cm', 2, 'akshaycoir'),
(2, 'Vinyl Back 15mm Natural', 'ACP050', 'Plain', '40x120cm', 3, 'akshaycoir'),
(3, 'Black Rubber 15mm', 'TUF059', 'plain', '40x120cm', 1, 'akshaycoir'),
(4, 'Vinyl Back 15mm Natural', 'ACP050', 'Plain', '40x120cm', 22, 'akshaycoir'),
(6, 'Vinyl Back 15mm Natural', 'ACP050', 'Plain', '40x120cm', 1, 'akshaycoir'),
(7, 'Black Rubber 15mm', 'TUF059', 'plain', '40x120cm', 22, 'akshaycoir');

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

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_no`, `date`, `company`, `company_gstin`, `work_order_no`, `place_of_supply`, `type_of_payment`, `contact`, `statecode`, `note`, `gst_percentage`, `grand_total`, `cgst`, `sgst`, `less_ro`, `total_amount`, `mode_of_transport`, `timestamp`, `user_id`) VALUES
('A001', '2023-07-23', 'Company 1', '', 'AKC001', '', '', '', '', '', '18', '18.00', '1.62', '1.62', '0.24', '21.00', '', '2023-07-23 14:41:37', 'akshaycoir');

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

--
-- Dumping data for table `invoice_data`
--

INSERT INTO `invoice_data` (`invoice_no`, `work_order_no`, `product_slno`, `product_name`, `type`, `size`, `unit`, `nopcs`, `rm`, `total_unit`, `rate`, `gst`, `amount`, `user_id`) VALUES
('A001', 'AKC001', 0, 'Vinyl back 15mm Natural', 'Passing Final', '45 X 75 cm', 'Inch', 8, 8, '8 Nos', 1.5, 18, 12, 'akshaycoir'),
('A001', 'AKC001', 1, 'Vinyl back 15mm Natural', 'Passing Final', '40 X 120 cm', 'Inch', 4, 4, '4 Nos', 1.5, 18, 6, 'akshaycoir');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `outpass`
--

INSERT INTO `outpass` (`no`, `date`, `work_order_no`, `dest`, `woc`, `vehicleno`, `extras`, `invoice_no`, `type`, `timestamp`, `user_id`) VALUES
(1, '2023-07-23', 'AKC001', 'Company 1', 'C1', 'KL 33 BC 1920', '', 'Not Generated', 'outpass', '2023-07-23 14:32:48', 'akshaycoir'),
(2, '2023-07-23', 'AKC001', 'Company 1', 'C1', 'KL 33 BC 1921', '', 'Not Generated', 'outpass', '2023-07-23 14:33:24', 'akshaycoir'),
(3, '2023-07-23', 'AKC001', 'Company 1', 'C1', 'KL 33 BC 1921', '', 'Not Generated', 'outpass', '2023-07-23 14:34:23', 'akshaycoir'),
(4, '2023-07-23', 'AKC001', 'Company 1', 'C1', 'KL 33 BC 1921', '', 'Not Generated', 'outpass', '2023-07-23 14:50:34', 'akshaycoir'),
(6, '2023-07-23', 'AKC002', 'Company MAIN', 'cm', 'KL 33 BC 1921', '', 'Not Generated', 'outpass', '2023-07-23 14:50:49', 'akshaycoir'),
(7, '2023-07-23', 'AKC001', 'Company 1', 'C1', 'KL 05 B 2834', '', 'Not Generated', 'outpass', '2023-07-23 14:51:06', 'akshaycoir');

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
(1, 'Finished', 'Vinyl back 15mm Natural', 'AKC001', 'ACP051', 'Plain', '45 X 75 cm', 1, 'akshaycoir'),
(1, 'Finished', 'Vinyl back 15mm Natural', 'AKC001', 'ACP050', 'Plain', '40 X 120 cm', 1, 'akshaycoir'),
(2, 'Finished', 'Vinyl back 15mm Natural', 'AKC001', 'ACP051', 'Plain', '45 X 75 cm', 1, 'akshaycoir'),
(3, 'Finished', 'Vinyl back 15mm Natural', 'AKC001', 'ACP051', 'Plain', '45 X 75 cm', 1, 'akshaycoir'),
(4, 'Finished', 'Vinyl back 15mm Natural', 'AKC001', 'ACP051', 'Plain', '45 X 75 cm', 1, 'akshaycoir'),
(4, 'Finished', 'Vinyl back 15mm Natural', 'AKC001', 'ACP050', 'Plain', '40 X 120 cm', 1, 'akshaycoir'),
(6, 'Finished', 'Vinyl back 15mm Natural', 'AKC002', 'ACP051', 'Plain', '45 X 75 cm', 2, 'akshaycoir'),
(7, 'Finished', 'Vinyl back 15mm Natural', 'AKC001', 'ACP051', 'Plain', '45 X 75 cm', 2, 'akshaycoir'),
(7, 'Finished', 'Vinyl back 15mm Natural', 'AKC001', 'ACP050', 'Plain', '40 X 120 cm', 2, 'akshaycoir');

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
('new', '', '', 'new', '$2y$10$2asapdd6H.cqrKTeBzQdne3Z5qxPBRm5OVbBtVb6/bGzdeoBuRXOm');

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
(1, '', 'NULL', 'Vinyl Back 15mm Natural', 'Plain', '40x120cm', 16, 1, 'akshaycoir'),
(2, '', 'NULL', 'Black Rubber 15mm', 'plain', '40x120cm', 24, 1, 'akshaycoir');

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
('2023-07-23 19:39:33', 'Vinyl Back 15mm Natural', '40x120cm', 1, 1, 'Inpass', 'akshaycoir'),
('2023-07-23 19:39:33', 'Black Rubber 15mm', '40x120cm', 2, 2, 'Inpass', 'akshaycoir'),
('2023-07-23 19:39:59', 'Vinyl Back 15mm Natural', '40x120cm', 3, 4, 'Inpass', 'akshaycoir'),
('2023-07-23 19:40:35', 'Black Rubber 15mm', '40x120cm', 1, 3, 'Inpass', 'akshaycoir'),
('2023-07-23 20:02:48', 'Vinyl Back 15mm Natural', '40x120cm', 1, 3, 'Outpass', 'akshaycoir'),
('2023-07-23 20:02:48', 'Vinyl Back 15mm Natural', '40x120cm', 1, 2, 'Outpass', 'akshaycoir'),
('2023-07-23 20:03:24', 'Vinyl Back 15mm Natural', '40x120cm', 1, 1, 'Outpass', 'akshaycoir'),
('2023-07-23 20:04:23', 'Black Rubber 15mm', '40x120cm', 1, 2, 'Outpass', 'akshaycoir'),
('2023-07-23 20:18:53', 'Vinyl Back 15mm Natural', '40x120cm', 22, 23, 'Inpass', 'akshaycoir'),
('2023-07-23 20:19:06', 'Vinyl Back 15mm Natural', '40x120cm', 1, 24, 'Inpass', 'akshaycoir'),
('2023-07-23 20:19:29', 'Black Rubber 15mm', '40x120cm', 22, 24, 'Inpass', 'akshaycoir'),
('2023-07-23 20:20:34', 'Vinyl Back 15mm Natural', '40x120cm', 1, 23, 'Outpass', 'akshaycoir'),
('2023-07-23 20:20:34', 'Vinyl Back 15mm Natural', '40x120cm', 1, 22, 'Outpass', 'akshaycoir'),
('2023-07-23 20:20:49', 'Vinyl Back 15mm Natural', '40x120cm', 2, 20, 'Outpass', 'akshaycoir'),
('2023-07-23 20:21:06', 'Vinyl Back 15mm Natural', '40x120cm', 2, 18, 'Outpass', 'akshaycoir'),
('2023-07-23 20:21:06', 'Vinyl Back 15mm Natural', '40x120cm', 2, 16, 'Outpass', 'akshaycoir');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `work_orders`
--

INSERT INTO `work_orders` (`id`, `date`, `work_order_no`, `company`, `extras`, `status`, `timestamp`, `user_id`) VALUES
(1, '2023-07-23', 'AKC001', 'Company 1', '', 'Open', '2023-07-23 14:31:55', 'akshaycoir'),
(2, '2023-07-23', 'AKC002', 'Company MAIN', 'test t', 'Open', '2023-07-23 14:36:55', 'akshaycoir');

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
('AKC001', 'ACP051', 'Vinyl back 15mm Natural', 'Plain', '45 X 75 cm', '', 98, 'akshaycoir'),
('AKC001', 'ACP050', 'Vinyl back 15mm Natural', 'Plain', '40 X 120 cm', '', 1, 'akshaycoir'),
('AKC002', 'ACP051', 'Vinyl back 15mm Natural', 'Plain', '45 X 75 cm', '', 98, 'akshaycoir');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
