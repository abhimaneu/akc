-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 22, 2023 at 12:17 PM
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
  `op` int NOT NULL,
  `vehicleno` varchar(50) NOT NULL,
  `extras` varchar(125) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'inpass',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` varchar(50) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inpass`
--

INSERT INTO `inpass` (`no`, `date`, `source`, `woc`, `op`, `vehicleno`, `extras`, `type`, `timestamp`, `user_id`) VALUES
('1', '2023-07-18', 'Company 3 Ltd.', 'C300', 123, 'KL 33 BC 1921', 'test', 'inpass', '2023-07-18 12:28:48', 'akshaycoir'),
('2', '2023-07-18', 'Company 3 Ltd.', 'C301', 9000, 'KL 33 BC 1921', '', 'inpass', '2023-07-18 12:29:37', 'akshaycoir'),
('4', '2023-07-21', 'Company 2', 'C2', 123, 'KL 33 BC 1920', 'new product 2', 'inpass', '2023-07-21 16:55:56', 'new'),
('5', '2023-07-21', 'Company 2', 'C2', 123, 'KL 33 BC 1921', 'new product 3', 'inpass', '2023-07-21 16:56:24', 'new'),
('6', '2023-07-21', 'Company 5', 'C5', 9000, 'KL 33 BC 1921', '', 'inpass', '2023-07-21 16:57:37', 'new'),
('7', '2023-07-22', 'Company 2', 'C200', 878, 'KL 33 BC 1920', 'new 2', 'inpass', '2023-07-22 10:29:44', 'new'),
('8', '2023-07-22', 'Company 2', 'C2001', 123, 'KL 33 BC 1920', 'new product', 'inpass', '2023-07-22 10:31:03', 'new'),
('9', '2023-07-22', 'Company MAIN', 'cm', 123, 'KL 33 BC 1920', '', 'inpass', '2023-07-22 10:35:59', 'akshaycoir');

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
(1, 'Vinyl Back 15mm Natural', 'TUF001', 'Plain', '45 X 75 cm', 100, 'akshaycoir'),
(1, 'Vinyl Back 15mm Natural', 'TUF002', 'Plain', '40 X 120 cm', 50, 'akshaycoir'),
(2, 'Vinyl Back 15mm Natural', 'TUF002', 'Plain', '40 X 120 cm', 60, 'akshaycoir'),
(4, 'Vinyl Back 15mm Natural', 'ACP050', 'Plain', '40 X 120 cm', 120, 'new'),
(4, 'Vinyl Back 15mm Natural', 'ACP051', 'Plain', '45 X 75 cm', 12, 'new'),
(5, 'Vinyl Back 15mm Natural', 'ACP050', 'Plain', '40 X 120 cm', 140, 'new'),
(6, 'Vinyl Back 15mm Natural', 'ACP051', 'Plain', '45 X 75 cm', 1, 'new'),
(7, 'Vinyl Back 15mm Natural', 'ACP050', 'Plain', '40 X 120 cm', 100, 'new'),
(8, 'Black Rubber 15mm', 'BCP001', 'Plain', '100 X 50 cm', 100, 'new'),
(9, 'Vinyl Back 15mm Natural', 'TUF001', 'Plain', '45 X 75 cm', 10, 'akshaycoir');

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
('A001', '2023-07-18', 'Company 2', '', 'AKC001', '', '', '', '', '', '18', '15.00', '1.35', '1.35', '0.70', '17.00', '', '2023-07-19 18:41:02', 'akshaycoir'),
('A003', '2023-07-18', 'Company 6', 'GSTIN2392039', 'AKC003', 'Alapuzha', '', '974700000', '32', 'Goods', '18', '2990.00', '269.10', '269.10', '0.20', '3528.00', 'Vehicle', '2023-07-19 18:43:24', 'akshaycoir'),
('A00custom', '2023-07-14', 'Company 2', 'GSTIN00000000', 'AKCcustom', 'a', '', '9747000001', '001', 'Goods', '18', '3000.00', '270.00', '270.00', '0.00', '3540.00', 'Vehicle', '2023-07-19 18:47:07', 'akshaycoir'),
('AKC4', '2023-07-22', 'Company 1', '', 'AKC004', '', '', '', '', '', '18', '1470.00', '132.30', '132.30', '0.60', '1734.00', '', '2023-07-22 10:38:07', 'akshaycoir'),
('NEW1', '2023-07-21', 'Company 5', 'GSTIN00000000', 'NEW001', 'Alapuzha', 'CASH', '9747000001', '32', 'NEW test', '18', '200.00', '18.00', '18.00', '0.00', '236.00', 'Vehicle', '2023-07-22 10:29:02', 'new');

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
('A001', 'AKC001', 0, 'Vinyl back 15mm Natural', 'Passing Final', '40 X 75 cm', 'Inch', 10, 10, '10 Nos', 1.5, 18, 15, 'akshaycoir'),
('A003', 'AKC003', 0, 'Vinyl back 15mm Natural', 'Passing Final', '45 X 75 cm', 'Inch', 100, 100, '100 Nos', 1.5, 18, 150, 'akshaycoir'),
('A003', 'AKC003', 0, 'Vinyl back 15mm Natural', 'Packing', '20 X 70 cm', 'Inch', 1000, 1000, '1000 Sqft', 2.75, 18, 2750, 'akshaycoir'),
('A003', 'AKC003', 1, 'Vinyl back 15mm Natural', 'Passing Final', '40 X 120 cm', 'Inch', 50, 50, '50 Nos', 1.5, 18, 75, 'akshaycoir'),
('A003', 'AKC003', 2, 'Vinyl Back 15mm Natural', 'Passing Final', '50 X 50 cm', 'Inch', 10, 10, '10 Nos', 1.5, 18, 15, 'akshaycoir'),
('A00custom', 'AKCcustom', 0, 'Vinyl back 15mm Natural Test', 'Test', '18 X 30 CM', 'INCH', 1000, 1000, '1000 Nos', 1.5, 18, 1500, 'akshaycoir'),
('A00custom', 'AKCcustom', 0, 'Vinyl back 15mm Natural Test', 'Test2', '40 X 75 cm', 'INCH', 1000, 1000, '1000 Nos', 1.5, 18, 1500, 'akshaycoir'),
('NEW1', 'NEW001', 0, 'Vinyl back 15mm Natural', 'Passing Final', '40 X 120 cm', 'Inch', 100, 100, '100 Nos', 1.5, 18, 150, 'new'),
('NEW1', 'NEW001', 1, 'test product', 't1', '43 size', 'INCH', 10, 10, '10 Nos', 1, 18, 10, 'new'),
('NEW1', 'NEW001', 1, 'test product', 't2', '42 sizze', 'inch', 20, 20, '20 Sqft', 2, 18, 40, 'new'),
('AKC4', 'AKC004', 0, 'Vinyl back 15mm Natural', 'Passing Final', '45 X 75 cm', 'Inch', 980, 980, '980 Nos', 1.5, 18, 1470, 'akshaycoir');

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
) ENGINE=InnoDB AUTO_INCREMENT=600000003 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `outpass`
--

INSERT INTO `outpass` (`no`, `date`, `work_order_no`, `dest`, `woc`, `vehicleno`, `extras`, `invoice_no`, `type`, `timestamp`, `user_id`) VALUES
(1, '2023-07-18', 'AKC001', 'Company 2', 'C2', 'KL 33 BC 1923', 'test 1', 'Not Generated', 'outpass', '2023-07-18 13:00:29', 'akshaycoir'),
(2, '2023-07-18', 'AKC001', 'Company 2', 'C2', 'KL 33 BC 1923', '', 'Not Generated', 'outpass', '2023-07-18 13:01:03', 'akshaycoir'),
(3, '2023-07-20', 'AAkdel', 'Company 1 ltd', 'C100', 'KL 33 BC 1921', '', 'Not Generated', 'outpass', '2023-07-20 10:54:44', 'akshaycoir'),
(4, '2023-07-21', 'NEW001', 'Company 5', 'C5', 'KL 33 BC 1920', '', 'Not Generated', 'outpass', '2023-07-21 17:49:00', 'new'),
(5, '2023-07-22', 'NEW002', 'Akshay Coir', 'AKC1', 'KL 23 BC 2983', 'new', 'Not Generated', 'outpass', '2023-07-22 10:32:16', 'new'),
(6, '2023-07-22', 'AKC004', 'Company 1', 'C1', 'KL 33 BC 1920', '', 'Not Generated', 'outpass', '2023-07-22 10:36:43', 'akshaycoir'),
(7, '2023-07-22', 'AKC002', 'Company 3', 'c3', 'KL 33 BC 1921', '', 'Not Generated', 'outpass', '2023-07-22 10:37:26', 'akshaycoir');

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
(1, 'Finished', 'Vinyl back 15mm Natural', 'AKC001', 'ACP050', 'Plain', '40 X 75 cm', 30, 'alshaycoir'),
(2, 'Finished', 'Vinyl back 15mm Natural', 'AKC001', 'ACP050', 'Plain', '40 X 75 cm', 10, 'alshaycoir'),
(3, 'Finished', 'Vinyl back 15mm Natural', 'AAkdel', 'ACP051', 'Plain', '45 X 75 cm', 10, 'alshaycoir'),
(4, 'Finished', 'Vinyl back 15mm Natural', 'NEW001', 'ACP050', 'Plain', '40 X 120 cm', 100, 'new'),
(5, 'Finished', 'Vinyl Back 15mm Natural', 'NEW002', 'ACP050', 'Plain', '45 X 75 Cm', 50, 'new'),
(6, 'Finished', 'Vinyl back 15mm Natural', 'AKC004', 'ACP051', 'Plain', '45 X 75 cm', 5, 'akshaycoir'),
(7, 'Finished', 'Vinyl back 15mm Natural', 'AKC002', 'ACP051', 'Plain', '45 X 75 cm', 10, 'akshaycoir');

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
('Vinyl Back 15mm Natural', 'TUF001', 'Plain', '45 X 75 cm', 'finished', 'akshaycoir'),
('Vinyl Back 15mm Natural', 'TUF002', 'Plain', '40 X 120 cm', 'finished', 'akshaycoir'),
('Vinyl Back 15mm Natural', 'ACP050', 'Plain', '40 X 120 cm', 'finished', 'new'),
('Vinyl Back 15mm Natural', 'ACP051', 'Plain', '45 X 75 cm', 'finished', 'new'),
('Black Rubber 15mm', 'BCP001', 'Plain', '100 X 50 cm', 'finished', 'new');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`index`, `grade`, `code`, `item`, `design`, `size`, `qty`, `default`, `user_id`) VALUES
(1, '', 'NULL', 'Vinyl Back 15mm Natural', 'Plain', '45 X 75 cm', 70, 1, 'akshaycoir'),
(2, '', 'NULL', 'Vinyl Back 15mm Natural', 'Plain', '40 X 120 cm', 85, 1, 'akshaycoir'),
(7, '', 'NULL', 'Vinyl Back 15mm Natural', 'Plain', '40 X 120 cm', 270, 1, 'new'),
(8, '', 'NULL', 'Vinyl Back 15mm Natural', 'Plain', '45 X 75 cm', 63, 1, 'new'),
(9, '', 'NULL', 'Black Rubber 15mm', 'Plain', '100 X 50 cm', 100, 1, 'new');

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
('2023-07-18 17:58:48', 'Vinyl Back 15mm Natural', '45 X 75 cm', 100, 100, 'Inpass', 'akshaycoir'),
('2023-07-18 17:58:48', 'Vinyl Back 15mm Natural', '40 X 120 cm', 50, 50, 'Inpass', 'akshaycoir'),
('2023-07-18 17:59:37', 'Vinyl Back 15mm Natural', '40 X 120 cm', 60, 110, 'Inpass', 'akshaycoir'),
('2023-07-18 18:30:29', 'Vinyl Back 15mm Natural', '45 X 75 cm', 30, 70, 'Outpass', 'akshaycoir'),
('2023-07-18 18:31:03', 'Vinyl Back 15mm Natural', '45 X 75 cm', 10, 60, 'Outpass', 'akshaycoir'),
('2023-07-20 16:24:44', 'Vinyl Back 15mm Natural', '40 X 120 cm', 10, 100, 'Outpass', 'akshaycoir'),
('2023-07-21 22:25:17', 'Vinyl Back 15mm Natural', '40 X 120 cm', 10, 10, 'Inpass', 'new'),
('2023-07-21 22:25:17', 'Vinyl Back 15mm Natural', '45 X 75 cm', 100, 100, 'Inpass', 'new'),
('2023-07-21 22:25:56', 'Vinyl Back 15mm Natural', '40 X 120 cm', 120, 130, 'Inpass', 'new'),
('2023-07-21 22:25:56', 'Vinyl Back 15mm Natural', '45 X 75 cm', 12, 112, 'Inpass', 'new'),
('2023-07-21 22:26:24', 'Vinyl Back 15mm Natural', '40 X 120 cm', 140, 270, 'Inpass', 'new'),
('2023-07-21 22:27:37', 'Vinyl Back 15mm Natural', '45 X 75 cm', 1, 113, 'Inpass', 'new'),
('2023-07-21 23:19:00', 'Vinyl Back 15mm Natural', '40 X 120 cm', 100, 170, 'Outpass', 'new'),
('2023-07-22 15:59:44', 'Vinyl Back 15mm Natural', '40 X 120 cm', 100, 270, 'Inpass', 'new'),
('2023-07-22 16:01:03', 'Black Rubber 15mm', '100 X 50 cm', 100, 100, 'Inpass', 'new'),
('2023-07-22 16:02:16', 'Vinyl Back 15mm Natural', '45 X 75 cm', 50, 63, 'Outpass', 'new'),
('2023-07-22 16:05:59', 'Vinyl Back 15mm Natural', '45 X 75 cm', 10, 70, 'Inpass', 'akshaycoir'),
('2023-07-22 16:06:43', 'Vinyl Back 15mm Natural', '40 X 120 cm', 5, 95, 'Outpass', 'akshaycoir'),
('2023-07-22 16:07:26', 'Vinyl Back 15mm Natural', '40 X 120 cm', 10, 85, 'Outpass', 'akshaycoir');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `work_orders`
--

INSERT INTO `work_orders` (`id`, `date`, `work_order_no`, `company`, `extras`, `status`, `timestamp`, `user_id`) VALUES
(1, '2023-07-18', 'AKC001', 'Company 2', 'test', 'Closed', '2023-07-18 13:01:03', 'akshaycoir'),
(3, '2023-07-18', 'AKC002', 'Company 3', '', 'Open', '2023-07-18 13:08:01', 'akshaycoir'),
(4, '2023-07-18', 'AKC003', 'Company 6', '', 'Open', '2023-07-18 15:16:19', 'akshaycoir'),
(8, '2023-07-21', 'NEW001', 'Company 5', 'new 1', 'Closed', '2023-07-21 17:49:00', 'new'),
(9, '2023-07-22', 'NEW002', 'Akshay Coir', 'new', 'Closed', '2023-07-22 10:32:16', 'new'),
(10, '2023-07-22', 'AKC004', 'Company 1', '', 'Closed', '2023-07-22 10:36:43', 'akshaycoir');

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
('AKC001', 'ACP050', 'Vinyl back 15mm Natural', 'Plain', '40 X 75 cm', '', 10, 'akshaycoir'),
('AKC002', 'ACP051', 'Vinyl back 15mm Natural', 'Plain', '45 X 75 cm', '', 980, 'akshaycoir'),
('AKC003', 'ACP051', 'Vinyl back 15mm Natural', 'Plain', '45 X 75 cm', '', 980, 'akshaycoir'),
('AKC003', 'ACP050', 'Vinyl back 15mm Natural', 'Plain', '40 X 120 cm', '', 50, 'akshaycoir'),
('AKC003', 'ACP053', 'Vinyl Back 15mm Natural', 'Plain', '50 X 50 cm', '', 10, 'akshaycoir'),
('NEW001', 'ACP050', 'Vinyl back 15mm Natural', 'Plain', '40 X 120 cm', '', 100, 'new'),
('NEW002', 'ACP050', 'Vinyl Back 15mm Natural', 'Plain', '45 X 75 Cm', '', 50, 'new'),
('AKC004', 'ACP051', 'Vinyl back 15mm Natural', 'Plain', '45 X 75 cm', '', 980, 'akshaycoir');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
