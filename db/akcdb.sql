-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 25, 2023 at 09:08 PM
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `code`) VALUES
(1, 'Company 1', 'C1'),
(2, 'Company 2', 'C2'),
(3, 'Company 3', 'C3'),
(4, 'Company 4', 'C4'),
(5, 'Company 5', 'C5'),
(17, 'Company 6', 'C6'),
(18, 'Company A', 'CA');

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
  `features` varchar(25) NOT NULL DEFAULT 'none',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `company_products`
--

INSERT INTO `company_products` (`id`, `code`, `name`, `design`, `size`, `features`) VALUES
(1, 'ACP050', 'Vinyl Back 15mm Natural', 'REACH', '17.75\" X 38.75\"', 'Welcome Border'),
(2, 'ACP051', 'Vinyl Back 15mm Natural', 'REACH', '18\" X 30\"', 'Hello');

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
  `op` int NOT NULL,
  `vehicleno` varchar(50) NOT NULL,
  `extras` varchar(125) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'inpass',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=7002 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inpass`
--

INSERT INTO `inpass` (`no`, `date`, `source`, `woc`, `op`, `vehicleno`, `extras`, `type`, `timestamp`) VALUES
(890, '2023-06-23', 'Company A', 'CA', 190, 'KL 33 BC 1920', '', 'inpass', '2023-06-23 12:21:36'),
(900, '2023-06-18', 'Company 1', 'C1', 100, 'KL 23 BC 2982', '', 'inpass', '2023-06-23 12:21:36'),
(901, '2023-06-18', 'Company 1', 'C1', 101, 'KL 23 BC 2982', '', 'inpass', '2023-06-23 12:21:36'),
(902, '2023-06-20', 'Company 5', 'C5', 809, 'KL 23 BC 2982', '', 'inpass', '2023-06-23 12:21:36'),
(903, '2023-06-20', 'Company 2', 'C2', 809, 'KL 23 BC 2982', '', 'inpass', '2023-06-23 12:21:36'),
(904, '2023-06-20', 'Company 2', 'C2', 9000, 'KL 33 BC 1920', '', 'inpass', '2023-06-23 12:21:36'),
(905, '2023-06-20', 'Company 2', 'C2', 123, 'KL 23 BC 2982', '', 'inpass', '2023-06-23 12:21:36'),
(906, '2023-06-20', 'Company 4', 'C4', 123, 'KL 33 BC 1920', '', 'inpass', '2023-06-23 12:21:36'),
(907, '2023-06-20', 'Company 2', 'C2', 123, 'KL 23 BC 2982', '', 'inpass', '2023-06-23 12:21:36'),
(908, '2023-06-20', 'Company 4', 'C4', 123, 'KL 33 BC 1920', '', 'inpass', '2023-06-23 12:21:36'),
(910, '2023-06-20', 'Company 2', 'C2', 878, 'KL 23 BC 2982', '', 'inpass', '2023-06-23 12:21:36'),
(911, '2023-06-20', 'Company 2', 'C2', 878, 'KL 23 BC 2983', '', 'inpass', '2023-06-23 12:21:36'),
(912, '2023-06-22', 'Company 2', 'C2', 200, 'KL 23 BC 2982', 'Goods', 'inpass', '2023-06-23 12:21:36'),
(915, '2023-06-23', 'Company 2', 'C2', 920, 'KL 33 BC 1921', '', 'inpass', '2023-06-23 12:21:36'),
(920, '2023-06-23', 'Company 3', 'C3', 929, 'KL 33 BC 1921', '', 'inpass', '2023-06-23 12:33:32'),
(1001, '2023-06-23', 'Company 2', 'C2', 798, 'KL 33 BC 1921', '', 'inpass', '2023-06-23 12:21:36'),
(7001, '2023-06-23', 'Company 2', 'C2', 1234, 'KL 33 OF 2323', '', 'inpass', '2023-06-23 12:21:36');

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
  `product_qty` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inpass_products`
--

INSERT INTO `inpass_products` (`inpass_no`, `product_name`, `product_code`, `product_design`, `product_size`, `product_qty`) VALUES
(900, 'Vinyl back 15mm natural', 'TUF059', 'Plain', '45 X 75 Cm', 100),
(901, 'Vinyl back 15mm natural', 'TUF059', 'Plain', '45 X 75 Cm', 10),
(901, 'Vinyl back 15mm natural	', 'TUF060', 'Plain', '40 X 120cm', 400),
(902, 'Vinyl back 15mm natural', 'TUF059', 'Plain', '45 X 75 Cm', 500),
(903, 'Black Rubber 15mm', 'COD900', 'Plain', '40 X 120cm', 20),
(904, 'Vinyl back 15mm natural', 'TUF059', 'Plain', '45 X 75 Cm', 100),
(906, 'Black Rubber 15mm', 'COD900', 'Plain', '40 X 120cm', 10),
(905, 'Vinyl back 15mm natural', 'TUF059', 'Plain', '45 X 75 Cm', 1000),
(907, 'Black Rubber 20mm', 'COD901', 'Plain', '40 X 120cm', 10),
(908, 'Black Rubber 20mm', 'COD901', 'Plain', '40 X 120cm', 10),
(910, 'Black Rubber 20mm', 'COD901', 'Plain', '40 X 120cm', 10),
(911, 'Black Rubber 20mm', 'COD901', 'Plain', '40 X 120cm', 100),
(912, 'Vinyl back 15mm natural	', 'TUF060', 'Plain', '40 X 120cm', 100),
(915, 'Black Rubber 15mm', 'COD900', 'Plain', '40 X 120cm', 5),
(915, 'Black Rubber 20mm', 'COD901', 'Plain', '40 X 120cm', 10),
(890, 'Vinyl back 20mm natural', 'TUF100', 'Border', '40 X 120cm', 100),
(890, 'Vinyl back 15mm natural', 'TUF059', 'Plain', '45 X 75 Cm', 10),
(1001, 'Vinyl back 15mm natural', 'TUF060', 'Plain', '40 X 120cm', 112),
(7001, 'Vinyl back 15mm natural', 'TUF060', 'Plain', '40 X 120cm', 10),
(920, 'Vinyl back 15mm natural', 'TUF059', 'Plain', '45 X 75 Cm', 123);

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
  UNIQUE KEY `invoice_no` (`invoice_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_no`, `date`, `company`, `company_gstin`, `work_order_no`, `place_of_supply`, `type_of_payment`, `contact`, `statecode`, `note`, `gst_percentage`, `grand_total`, `cgst`, `sgst`, `less_ro`, `total_amount`, `mode_of_transport`, `timestamp`) VALUES
('A300', '2023-06-25', 'Company 2', 'GSTIN2392039', 'AAC300', 'Alapuzha', 'CASH', '974700000', '32', 'Goods', '18', '941.00', '84.69', '84.69', '0.38', '1110.00', 'Vehicle', '2023-06-25 20:53:29');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_data`
--

DROP TABLE IF EXISTS `invoice_data`;
CREATE TABLE IF NOT EXISTS `invoice_data` (
  `invoice_no` varchar(25) NOT NULL,
  `work_order_no` varchar(25) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `size` varchar(50) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `nopcs` float NOT NULL,
  `rm` float NOT NULL,
  `total_unit` float NOT NULL,
  `rate` float NOT NULL,
  `gst` float NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `invoice_data`
--

INSERT INTO `invoice_data` (`invoice_no`, `work_order_no`, `product_name`, `type`, `size`, `unit`, `nopcs`, `rm`, `total_unit`, `rate`, `gst`, `amount`) VALUES
('A300', 'AAC300', 'Vinyl Back 15mm Natural Welcome Border REACH', 'Passing Final', '17.75\" X 38.75\"', 'Inch', 10, 10, 10, 1.5, 18, 15),
('A300', 'AAC300', 'Vinyl Back 15mm Natural Welcome Border REACH', 'Packing', '17.75\" X 38.75\"', 'Inch', 10, 10, 10, 2, 18, 20),
('A300', 'AAC300', 'Vinyl Back 15mm Natural Welcome Border REACH', 'Tagging', '17.75\" X 38.75\"', 'Inch', 10, 10, 10, 5.75, 18, 57.5),
('A300', 'AAC300', 'Vinyl Back 15mm Natural Welcome Border REACH', 'Landing And Loading', '17.75\" X 38.75\"', 'Inch', 10, 10, 10, 0.16, 18, 1.6),
('A300', 'AAC300', 'Vinyl Back 15mm Natural Hello REACH', 'Passing Final', '18\" X 30\"', 'Inch', 20, 20, 20, 1.5, 18, 30),
('A300', 'AAC300', 'Vinyl Back 15mm Natural Hello REACH', 'Packing', '18\" X 30\"', 'Inch', 20, 20, 20, 2, 18, 40),
('A300', 'AAC300', 'Vinyl Back 15mm Natural Hello REACH', 'Tagging', '18\" X 30\"', 'Inch', 20, 20, 20, 5.75, 18, 115),
('A300', 'AAC300', 'Vinyl Back 15mm Natural Hello REACH', 'Landing And Loading', '18\" X 30\"', 'Inch', 20, 20, 20, 0.16, 18, 3.2),
('A300', 'AAC300', 'Black Natural 19mm Welcome Border Border 4', 'Passing Final', '17.75\" X 38.75\"', 'Inch', 30, 30, 30, 1.5, 18, 45),
('A300', 'AAC300', 'Black Natural 19mm Welcome Border Border 4', 'Packing', '17.75\" X 38.75\"', 'Inch', 30, 30, 30, 2, 18, 60),
('A300', 'AAC300', 'Black Natural 19mm Welcome Border Border 4', 'Tagging', '17.75\" X 38.75\"', 'Inch', 30, 30, 30, 5.75, 18, 172.5),
('A300', 'AAC300', 'Black Natural 19mm Welcome Border Border 4', 'Landing And Loading', '17.75\" X 38.75\"', 'Inch', 30, 30, 30, 0.16, 18, 4.8),
('A300', 'AAC300', 'Black Rubber 15mm Clear Plain', 'Passing Final', '18\" X 30\"', 'Inch', 40, 40, 40, 1.5, 18, 60),
('A300', 'AAC300', 'Black Rubber 15mm Clear Plain', 'Packing', '18\" X 30\"', 'Inch', 40, 40, 40, 2, 18, 80),
('A300', 'AAC300', 'Black Rubber 15mm Clear Plain', 'Tagging', '18\" X 30\"', 'Inch', 40, 40, 40, 5.75, 18, 230),
('A300', 'AAC300', 'Black Rubber 15mm Clear Plain', 'Landing And Loading', '18\" X 30\"', 'Inch', 40, 40, 40, 0.16, 18, 6.4);

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
  `type` varchar(10) NOT NULL DEFAULT 'outpass',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=600000003 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `outpass`
--

INSERT INTO `outpass` (`no`, `date`, `work_order_no`, `dest`, `woc`, `vehicleno`, `extras`, `type`, `timestamp`) VALUES
(1200, '2023-06-24', 'AAC100', 'Company 2', 'C2', 'KL 33 BC 1920', '', 'outpass', '2023-06-23 18:38:25'),
(1201, '2023-06-25', 'AAC101', 'Company 4', 'C4', 'KL 05 B 2834', '', 'outpass', '2023-06-24 20:33:40'),
(1203, '2023-06-25', 'AAC200', 'Company 5', 'C5', 'KL 33 BC 1920', '', 'outpass', '2023-06-24 20:34:21'),
(1204, '2023-06-25', 'AAC300', 'Company 2', 'C2', 'KL 23 BC 2983', '', 'outpass', '2023-06-24 20:35:59');

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
  `product_qty` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `outpass_products`
--

INSERT INTO `outpass_products` (`outpass_no`, `product_type`, `product_name`, `work_order`, `product_code`, `product_design`, `product_size`, `product_qty`) VALUES
(1200, 'Finished', 'Vinyl Back 15mm Natural Hello', 'AAC100', 'ACP051', 'REACH', '18\" X 30\"', 100),
(1200, 'Finished', 'Vinyl Back 15mm Natural Welcome Border', 'AAC100', 'ACP050', 'REACH', '17.75\" X 38.75\"', 200),
(1201, 'Finished', 'Vinyl Back 15mm Natural Welcome Border', 'AAC101', 'ACP050', 'REACH', '17.75\" X 38.75\"', 1),
(1203, 'Finished', 'Vinyl Back 15mm Natural Welcome Border', 'AAC200', 'ACP050', 'REACH', '17.75\" X 38.75\"', 10),
(1203, 'Finished', 'Vinyl Back 15mm Natural Hello', 'AAC200', 'ACP051', 'REACH', '18\" X 30\"', 20),
(1203, 'Finished', 'Black Rubber 15mm Border', 'AAC200', 'ACP059', 'Plain', '23\" X 45\"', 30),
(1204, 'Finished', 'Vinyl Back 15mm Natural Welcome Border', 'AAC300', 'ACP050', 'REACH', '17.75\" X 38.75\"', 10),
(1204, 'Finished', 'Vinyl Back 15mm Natural Hello', 'AAC300', 'ACP051', 'REACH', '18\" X 30\"', 20),
(1204, 'Finished', 'Black Natural 19mm Welcome Border', 'AAC300', 'ACP022', 'Border 4', '17.75\" X 38.75\"', 30),
(1204, 'Finished', 'Black Rubber 15mm Clear', 'AAC300', 'ACP023', 'Plain', '18\" X 30\"', 40);

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
  `type` varchar(10) NOT NULL DEFAULT 'finished'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`name`, `code`, `design`, `size`, `type`) VALUES
('Vinyl back 15mm natural', 'TUF059', 'Plain', '45 X 75 Cm', 'finished'),
('Vinyl back 15mm natural', 'TUF060', 'Plain', '40 X 120cm', 'finished'),
('Black Rubber 15mm', 'COD900', 'Plain', '40 X 120cm', 'finished'),
('Black Rubber 20mm', 'COD901', 'Plain', '40 X 120cm', 'finished'),
('Vinyl back 20mm natural', 'TUF100', 'Border', '40 X 120cm', 'finished');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `name` varchar(50) NOT NULL,
  `wo` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`name`, `wo`) VALUES
('AK Coir', 'AK123');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `index` int NOT NULL AUTO_INCREMENT,
  `grade` varchar(25) NOT NULL,
  `code` varchar(25) NOT NULL,
  `item` varchar(50) NOT NULL,
  `design` varchar(50) NOT NULL,
  `size` varchar(25) NOT NULL,
  `qty` int NOT NULL,
  `default` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`index`, `grade`, `code`, `item`, `design`, `size`, `qty`, `default`) VALUES
(9, '', 'TUF059', 'Vinyl back 15mm natural', 'Plain', '45 X 75 Cm', 343, 1),
(11, '', 'TUF060', 'Vinyl back 15mm natural', 'Plain', '40 X 120cm', 381, 1),
(12, '', 'COD900', 'Black Rubber 15mm', 'Plain', '40 X 120cm', 620, 1),
(15, '', 'COD901', 'Black Rubber 20mm', 'Plain', '40 X 120cm', 120, 1),
(16, '', 'TUF100', 'Vinyl back 20mm natural', 'Border', '40 X 120cm', 99, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE IF NOT EXISTS `vehicles` (
  `type` varchar(50) NOT NULL,
  `number` varchar(50) NOT NULL,
  `owner` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`type`, `number`, `owner`) VALUES
('Pick-Up', 'KL 33 BC 1920', 'Company'),
('Pick-Up', 'KL 33 BC 1921', 'Others'),
('Pick-Up', 'KL 33 BC 1923', 'Others'),
('Pick-up', 'KL 05 B 2834', 'Others');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `work_orders`
--

INSERT INTO `work_orders` (`id`, `date`, `work_order_no`, `company`, `extras`, `status`, `timestamp`) VALUES
(5, '2023-06-19', 'AAC001', 'Company 3', '', 'Open', '2023-06-23 12:22:33'),
(6, '2023-06-20', 'AAC002', 'Company 4', '', 'Closed', '2023-06-23 12:22:33'),
(7, '2023-06-23', 'AAC004', 'Company 3', '', 'Open', '2023-06-23 12:22:33'),
(8, '2023-06-23', 'AAC800', 'Company 4', '', 'Closed', '2023-06-23 12:22:33'),
(9, '2023-06-23', 'AAC801', 'Company 1', '', 'Closed', '2023-06-23 12:22:33'),
(14, '2023-06-23', 'Testfor123', 'Company 1', '', 'Closed', '2023-06-23 12:22:33'),
(16, '2023-06-23', 'AAC123', 'Company 2', '', 'Closed', '2023-06-23 12:36:24'),
(17, '2023-06-24', 'AAC100', 'Company 2', '', 'Closed', '2023-06-23 18:38:25'),
(18, '2023-06-24', 'AAC101', 'Company 4', '', 'Closed', '2023-06-24 20:33:40'),
(19, '2023-06-25', 'AAC200', 'Company 5', '', 'Closed', '2023-06-24 20:34:21'),
(20, '2023-06-25', 'AAC300', 'Company 2', '', 'Open', '2023-06-24 20:33:08');

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
  `qty` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `work_order_products`
--

INSERT INTO `work_order_products` (`work_order_no`, `code`, `name`, `design`, `size`, `features`, `qty`) VALUES
('AAC004', 'ACP050', 'Vinyl Back 15mm Natural', 'REACH', '17.75\" X 38.75\"', 'Welcome Border', 100),
('AAC800', 'ACP052', 'Vinyl Back 15mm Natural', 'Border 4', '18\" X 30\"', 'Clear', 50),
('AAC801', 'TUF059', 'Black Natural 19mmm', 'Plain', '40 X 120cm', 'Welcome Border', 1000),
('AAC001', 'ACP051', 'Vinyl Back 15mm Natural', 'REACH', '18\" X 30\"', 'Hello', 500),
('AAC002', 'ACP050', 'Vinyl Back 15mm Natural', 'REACH', '17.75\" X 38.75\"', 'Welcome Border', 5),
('Testfor123', 'ACP050', 'Vinyl Back 15mm Natural', 'Plain', '17.75\" X 38.75\"', 'Welcome Round Border', 100),
('Testfor123', 'ACP051', 'Vinyl Back 15mm Natural', 'Plain', '18\" X 30\"', 'Hello', 50),
('Testfor123', 'TUF90', 'Black Rubber 18mm', 'Round', '20', 'WET', 1),
('AAC123', 'ACP051', 'Vinyl Back 15mm Natural', 'REACH', '18\" X 30\"', 'Hello', 100),
('AAC100', 'ACP051', 'Vinyl Back 15mm Natural', 'REACH', '18\" X 30\"', 'Hello', 100),
('AAC100', 'ACP050', 'Vinyl Back 15mm Natural', 'REACH', '17.75\" X 38.75\"', 'Welcome Border', 20),
('AAC101', 'ACP050', 'Vinyl Back 15mm Natural', 'REACH', '17.75\" X 38.75\"', 'Welcome Border', 1),
('AAC200', 'ACP050', 'Vinyl Back 15mm Natural', 'REACH', '17.75\" X 38.75\"', 'Welcome Border', 10),
('AAC200', 'ACP051', 'Vinyl Back 15mm Natural', 'REACH', '18\" X 30\"', 'Hello', 20),
('AAC200', 'ACP059', 'Black Rubber 15mm', 'Plain', '23\" X 45\"', 'Border', 30),
('AAC300', 'ACP050', 'Vinyl Back 15mm Natural', 'REACH', '17.75\" X 38.75\"', 'Welcome Border', 100),
('AAC300', 'ACP051', 'Vinyl Back 15mm Natural', 'REACH', '18\" X 30\"', 'Hello', 200),
('AAC300', 'ACP022', 'Black Natural 19mm', 'Border 4', '17.75\" X 38.75\"', 'Welcome Border', 300),
('AAC300', 'ACP023', 'Black Rubber 15mm', 'Plain', '18\" X 30\"', 'Clear', 360);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
