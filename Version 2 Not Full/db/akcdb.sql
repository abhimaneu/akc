-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 27, 2023 at 08:12 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `no` int NOT NULL,
  `no_year` varchar(15) NOT NULL,
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

INSERT INTO `inpass` (`no`, `no_year`, `date`, `source`, `woc`, `op`, `vehicleno`, `extras`, `type`, `timestamp`, `user_id`) VALUES
(1, '', '2022-02-28', 'Company 3', 'c3', '123', 'KL 23 BC 2982', '', 'inpass', '2023-07-27 20:06:59', 'akshaycoir'),
(2, '', '2023-07-28', 'Company MAIN', 'cm', '123', 'KL 33 BC 1921', '', 'inpass', '2023-07-27 20:07:20', 'akshaycoir');

-- --------------------------------------------------------

--
-- Table structure for table `inpass_old`
--

DROP TABLE IF EXISTS `inpass_old`;
CREATE TABLE IF NOT EXISTS `inpass_old` (
  `no` varchar(10) NOT NULL,
  `no_year` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `source` varchar(125) NOT NULL,
  `woc` varchar(125) NOT NULL,
  `op` varchar(25) NOT NULL,
  `vehicleno` varchar(50) NOT NULL,
  `extras` varchar(125) NOT NULL,
  `type` varchar(10) NOT NULL,
  `timestamp` timestamp NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inpass_old`
--

INSERT INTO `inpass_old` (`no`, `no_year`, `date`, `source`, `woc`, `op`, `vehicleno`, `extras`, `type`, `timestamp`, `user_id`) VALUES
('1', '1/2324', '2023-07-26', 'Company MAIN', 'cm', '123', 'KL 33 BC 1920', 'test', 'inpass', '2023-07-26 14:59:41', 'akshaycoir'),
('2', '2/2324', '2023-07-26', 'Company MAIN', 'cm', '123', 'KL 23 BC 2983', '', 'inpass', '2023-07-26 15:00:14', 'akshaycoir');

-- --------------------------------------------------------

--
-- Table structure for table `inpass_products`
--

DROP TABLE IF EXISTS `inpass_products`;
CREATE TABLE IF NOT EXISTS `inpass_products` (
  `inpass_no` int NOT NULL,
  `no_year` varchar(15) NOT NULL,
  `date_of_entry` date NOT NULL,
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

INSERT INTO `inpass_products` (`inpass_no`, `no_year`, `date_of_entry`, `product_name`, `product_code`, `product_design`, `product_size`, `product_qty`, `user_id`) VALUES
(1, '', '2022-02-28', 'Vinyl Back 15mm Natural', 'ACP050', 'Plain', '40x120cm', 122, 'akshaycoir'),
(2, '', '2023-07-28', 'Vinyl Back 15mm Natural', 'ACP050', 'Plain', '40x120cm', 1, 'akshaycoir');

-- --------------------------------------------------------

--
-- Table structure for table `inpass_products_old`
--

DROP TABLE IF EXISTS `inpass_products_old`;
CREATE TABLE IF NOT EXISTS `inpass_products_old` (
  `inpass_no` varchar(10) NOT NULL,
  `no_year` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_of_entry` date NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_code` varchar(25) NOT NULL,
  `product_design` varchar(50) NOT NULL,
  `product_size` varchar(25) NOT NULL,
  `product_qty` varchar(15) NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inpass_products_old`
--

INSERT INTO `inpass_products_old` (`inpass_no`, `no_year`, `date_of_entry`, `product_name`, `product_code`, `product_design`, `product_size`, `product_qty`, `user_id`) VALUES
('1', '1/2324', '2023-07-26', 'Black Rubber 15mm', 'TUF059', 'plain', '40x120cm', '100', 'akshaycoir'),
('1', '1/2324', '2023-07-26', 'test', 'COP900', 'test1', 'twa x tes', '1', 'akshaycoir'),
('2', '2/2324', '2023-07-26', 'Black Rubber 15mm', 'TUF059', 'plain', '40x120cm', '100', 'akshaycoir'),
('2', '2/2324', '2023-07-26', 'Vinyl Back 15mm Natural', 'ACP050', 'Plain', '40x120cm', '1', 'akshaycoir');

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
('A001', '2023-07-23', 'Company 1', '', 'AKC001', '', '', '', '', '', '18', '1347.00', '121.23', '121.23', '0.46', '1589.00', '', '2023-07-26 13:37:12', 'akshaycoir'),
('A002', '2023-07-23', 'AA Company', 'GSTIN000000001', 'AKC002', 'Alapuzha', 'CASH', '974700000', '32', '', '18', '339.50', '30.55', '30.55', '0.60', '400.00', 'Vehicle', '2023-07-26 13:01:54', 'akshaycoir'),
('N001', '2023-07-24', 'Akshay Coir', 'GSTIN00000000', 'NEW001', 'Alapuzha', 'CASH', '974700000', '32', 'Goods', '18', '60.00', '5.40', '5.40', '0.80', '70.00', 'Vehicle', '2023-07-24 16:30:14', 'new');

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
('N001', 'NEW001', 0, 'Vinyl back 15mm Natural', 'Passing Final', '45 X 75 cm', 'Inch', 40, 40, '40 Nos', 1.5, 18, 60, 'new'),
('A002', 'AKC002', 0, 'Vinyl back 15mm Natural', 'Passing Final', '45 X 75 cm', 'Inch', 97, 97, '97 Nos', 1.5, 18, 145.5, 'akshaycoir'),
('A002', 'AKC002', 0, 'Vinyl back 15mm Natural', 'Tagging', '45 X 75 cm', 'Inch', 97, 97, '97', 2, 18, 194, 'akshaycoir'),
('A001', 'AKC001', 0, 'Vinyl back 15mm Natural', 'Passing Final', '45 X 75 cm', 'Inch', 97, 97, '97 Nos', 1.5, 18, 145.5, 'akshaycoir'),
('A001', 'AKC001', 1, 'Vinyl back 15mm Natural', 'Passing Final', '40 X 120 cm', 'Inch', 100, 1, '1 Nos', 1.5, 18, 1.5, 'akshaycoir'),
('A001', 'AKC001', 1, 'Vinyl back 15mm Natural', 'Tagging', '40 X 120 cm', 'Inch', 100, 1, '800 Sqft', 1.5, 18, 1200, 'akshaycoir');

-- --------------------------------------------------------

--
-- Table structure for table `outpass`
--

DROP TABLE IF EXISTS `outpass`;
CREATE TABLE IF NOT EXISTS `outpass` (
  `no` int NOT NULL,
  `no_year` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `work_order_no` varchar(25) NOT NULL,
  `dest` varchar(125) NOT NULL,
  `woc` varchar(125) NOT NULL,
  `vehicleno` varchar(50) NOT NULL,
  `extras` varchar(125) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'outpass',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `outpass_old`
--

DROP TABLE IF EXISTS `outpass_old`;
CREATE TABLE IF NOT EXISTS `outpass_old` (
  `no` varchar(10) NOT NULL,
  `no_year` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `work_order_no` varchar(25) NOT NULL,
  `dest` varchar(125) NOT NULL,
  `woc` varchar(125) NOT NULL,
  `vehicleno` varchar(50) NOT NULL,
  `extras` varchar(125) NOT NULL,
  `type` varchar(10) NOT NULL,
  `timestamp` timestamp NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `outpass_old`
--

INSERT INTO `outpass_old` (`no`, `no_year`, `date`, `work_order_no`, `dest`, `woc`, `vehicleno`, `extras`, `type`, `timestamp`, `user_id`) VALUES
('2', '2/2324', '2023-07-28', 'AKC001', 'Company 1', 'C1', 'KL 23 BC 2982', '', 'outpass', '2023-07-27 20:00:26', 'akshaycoir');

-- --------------------------------------------------------

--
-- Table structure for table `outpass_products`
--

DROP TABLE IF EXISTS `outpass_products`;
CREATE TABLE IF NOT EXISTS `outpass_products` (
  `outpass_no` int NOT NULL,
  `no_year` varchar(15) NOT NULL,
  `date_of_entry` date NOT NULL,
  `product_type` varchar(15) NOT NULL DEFAULT 'finished',
  `product_name` varchar(50) NOT NULL,
  `work_order` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `product_code` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'AAC(code)',
  `product_design` varchar(50) NOT NULL,
  `product_size` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `product_qty` int NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `outpass_products_old`
--

DROP TABLE IF EXISTS `outpass_products_old`;
CREATE TABLE IF NOT EXISTS `outpass_products_old` (
  `outpass_no` varchar(10) NOT NULL,
  `no_year` varchar(15) NOT NULL,
  `date_of_entry` date NOT NULL,
  `product_type` varchar(15) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `work_order` varchar(25) NOT NULL,
  `product_code` varchar(25) NOT NULL,
  `product_design` varchar(50) NOT NULL,
  `product_size` varchar(25) NOT NULL,
  `product_qty` varchar(15) NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `outpass_products_old`
--

INSERT INTO `outpass_products_old` (`outpass_no`, `no_year`, `date_of_entry`, `product_type`, `product_name`, `work_order`, `product_code`, `product_design`, `product_size`, `product_qty`, `user_id`) VALUES
('2', '2/2324', '2023-07-28', 'Finished', 'Vinyl back 15mm Natural', 'AKC001', 'ACP050', 'Plain', '40 X 120 cm', '4', 'akshaycoir');

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
('Black Rubber 15mm', 'TUF059', 'plain', '40x120cm', 'finished', 'akshaycoir'),
('Vinyl back 15mm Natural', 'TUF059', 'Border 4', '40x120cm', 'finished', 'new'),
('test', 'COP900', 'test1', 'twa x tes', 'finished', 'akshaycoir'),
('Vinyl back 20mm Natural', 'TUF060', 'Border 4', '40x120cm', 'finished', 'new');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `name` varchar(50) NOT NULL,
  `wo` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `gstin` varchar(50) NOT NULL,
  `phoneno` varchar(15) NOT NULL,
  `inpass_count` int NOT NULL DEFAULT '1',
  `outpass_count` int NOT NULL DEFAULT '1',
  `user_id` varchar(50) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`name`, `wo`, `gstin`, `phoneno`, `inpass_count`, `outpass_count`, `user_id`, `password`) VALUES
('Akshay Coir', 'akc', 'GSTIN0000001', '9000000001', 3, 1, 'akshaycoir', '$2y$10$qHN0ldGy/uQ3yG6MV7RSkuFXtM9W/WwltD1MPWVUS7ykkDgrYkTBC'),
('new', 'N1', 'GSTIN0000NEW', '9000000000', 1, 1, 'new', '$2y$10$2asapdd6H.cqrKTeBzQdne3Z5qxPBRm5OVbBtVb6/bGzdeoBuRXOm'),
('test', 't1', 'GSTIN2392039t', '9000000000', 1, 1, 'test', '$2y$10$KHhxqtgLG6q6YzH2IP9DNeCdcCKr1LUrYqJu6JPNoJszHnBDGWX9O');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `index` int NOT NULL AUTO_INCREMENT,
  `item` varchar(50) NOT NULL,
  `design` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'NULL',
  `size` varchar(25) NOT NULL,
  `qty` int NOT NULL,
  `default` int NOT NULL DEFAULT '1',
  `user_id` varchar(50) NOT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`index`, `item`, `design`, `size`, `qty`, `default`, `user_id`) VALUES
(4, 'Black Rubber 15mm', 'plain', '40x120cm', 205, 1, 'akshaycoir'),
(5, 'test', 'test1', 'twa x tes', 950, 1, 'akshaycoir'),
(6, 'Vinyl Back 15mm Natural', 'Plain', '40x120cm', 123, 1, 'akshaycoir');

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
('2023-07-26 20:29:41', 'Black Rubber 15mm', '40x120cm', 100, 100, 'Inpass', 'akshaycoir'),
('2023-07-26 20:29:41', 'test', 'twa x tes', 1, 1, 'Inpass', 'akshaycoir'),
('2023-07-26 20:30:14', 'Black Rubber 15mm', '40x120cm', 100, 200, 'Inpass', 'akshaycoir'),
('2023-07-26 20:30:14', 'Vinyl Back 15mm Natural', '40x120cm', 1, 1, 'Inpass', 'akshaycoir'),
('2023-07-27 22:21:40', 'test', 'twa x tes', 5, 6, 'Inpass', 'akshaycoir'),
('2023-07-28 00:10:11', 'Vback 15', '45 X 90 cm', 100, 100, 'Inpass', 'akshaycoir'),
('2023-07-28 00:10:24', 'Vback 156', '45 X 95 cm', 1000, 1000, 'Manual', 'akshaycoir'),
('2023-07-28 00:10:43', 'Vback 156', '45 X 95 cm', 0, 0, 'Manual', 'akshaycoir'),
('2023-07-28 00:12:08', 'a', 'a', 900, 900, 'Inpass', 'akshaycoir'),
('2023-07-28 00:12:12', 'a', 'a', 9000, 9000, 'Manual', 'akshaycoir'),
('2023-07-28 00:12:23', 'a', 'a', 0, 0, 'Delete', 'akshaycoir'),
('2023-07-28 01:21:45', 'test', 'twa x tes', 600, 606, 'Inpass', 'akshaycoir'),
('2023-07-28 01:21:45', 'Black Rubber 15mm', '40x120cm', 5, 205, 'Inpass', 'akshaycoir'),
('2023-07-28 01:22:05', 'Vinyl Back 15mm Natural', '40x120cm', 5, 6, 'Inpass', 'akshaycoir'),
('2023-07-28 01:22:25', 'test', 'twa x tes', 344, 950, 'Inpass', 'akshaycoir'),
('2023-07-28 01:22:55', 'Vinyl Back 15mm Natural', '40x120cm', 34, 40, 'Inpass', 'akshaycoir'),
('2023-07-28 01:29:45', 'Vinyl Back 15mm Natural', '40x120cm', 40, 0, 'Outpass', 'akshaycoir'),
('2023-07-28 01:30:26', 'Black Rubber 15mm', '40x120cm', 4, 201, 'Outpass', 'akshaycoir'),
('2023-07-28 01:36:59', 'Vinyl Back 15mm Natural', '40x120cm', 122, 122, 'Inpass', 'akshaycoir'),
('2023-07-28 01:37:20', 'Vinyl Back 15mm Natural', '40x120cm', 1, 123, 'Inpass', 'akshaycoir'),
('2023-07-28 01:39:48', 'Black Rubber 15mm', '40x120cm', 200, 200, 'Manual', 'akshaycoir'),
('2023-07-28 01:41:05', 'Black Rubber 15mm', '40x120cm', 205, 205, 'Manual', 'akshaycoir');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `work_orders_old`
--

DROP TABLE IF EXISTS `work_orders_old`;
CREATE TABLE IF NOT EXISTS `work_orders_old` (
  `date` date NOT NULL,
  `no_year` varchar(15) NOT NULL,
  `work_order_no` varchar(25) NOT NULL,
  `company` varchar(50) NOT NULL,
  `extras` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `timestamp` timestamp NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `work_order_products`
--

DROP TABLE IF EXISTS `work_order_products`;
CREATE TABLE IF NOT EXISTS `work_order_products` (
  `work_order_no` varchar(25) NOT NULL,
  `date_of_entry` date NOT NULL,
  `code` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `design` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `size` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `qty` int NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `work_order_products_old`
--

DROP TABLE IF EXISTS `work_order_products_old`;
CREATE TABLE IF NOT EXISTS `work_order_products_old` (
  `work_order_no` varchar(25) NOT NULL,
  `no_year` varchar(15) NOT NULL,
  `date_of_entry` date NOT NULL,
  `code` varchar(25) NOT NULL,
  `name` varchar(50) NOT NULL,
  `design` varchar(50) NOT NULL,
  `size` varchar(25) NOT NULL,
  `qty` varchar(10) NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
