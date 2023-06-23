-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 23, 2023 at 12:41 PM
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
(6000, '2023-06-23', 'AAC002', 'Company 4', 'C4', 'KL 33 BC 1920', '', 'outpass', '2023-06-23 12:22:16'),
(6002, '2023-06-23', 'AAC800', 'Company 4', 'C4', 'KL 33 BC 1920', '', 'outpass', '2023-06-23 12:22:16'),
(6020, '2023-06-23', 'AAC123', 'Company 2', 'C2', 'KL 05 B 2834', '', 'outpass', '2023-06-23 12:36:24'),
(7000, '2023-06-22', 'AAC003', 'Company 2', 'C2', 'KL 33 BC 1921', '', 'outpass', '2023-06-23 12:22:16'),
(9000, '2023-06-18', '12345', 'Company 3', 'C3', 'KL 33 BC 1920', '', 'outpass', '2023-06-23 12:22:16'),
(9001, '2023-06-20', 'AAC001', 'Company 2', 'C2', 'KL 33 BC 1920', '', 'outpass', '2023-06-23 12:22:16'),
(9003, '2023-06-20', 'AAC001', 'Company 2', 'C2', 'KL 33 BC 1920', 'Transfer', 'outpass', '2023-06-23 12:22:16'),
(9004, '2023-06-20', 'AAC002', 'Company 4', 'C4', 'KL 33 BC 1920', '', 'outpass', '2023-06-23 12:22:16'),
(60021, '2023-06-23', 'AAC800', 'Company 4', 'C4', 'KL 33 BC 1921', '', 'outpass', '2023-06-23 12:22:16'),
(90005, '2023-06-20', 'AAC001', 'Company 3', 'C3', 'KL 33 BC 1920', '', 'outpass', '2023-06-23 12:22:16'),
(90006, '2023-06-20', 'AAC001', 'Company 1', 'C1', 'KL 33 BC 1920', '', 'outpass', '2023-06-23 12:22:16'),
(90011, '2023-06-20', 'AAC001', 'Company 2', 'C2', 'KL 33 BC 1920', '', 'outpass', '2023-06-23 12:22:16'),
(800090, '2023-06-23', 'AAC801', 'Company 1', 'C1', 'KL 33 BC 1921', '', 'outpass', '2023-06-23 12:22:16'),
(900001, '2023-06-21', 'AAC001', 'Company 2', 'C2', 'KL 33 BC 1920', '', 'outpass', '2023-06-23 12:22:16'),
(900010, '2023-06-20', 'AAC001', 'Company 1', 'C1', 'KL 33 BC 1920', '', 'outpass', '2023-06-23 12:22:16'),
(600000002, '2023-06-23', 'Testfor123', 'Company 1', 'C1', 'KL 33 BC 1920', '', 'outpass', '2023-06-23 12:22:16');

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
(9000, 'Finished', 'Vinyl back 15mm natural', 'AAC001', '', 'REACH', '45 X 75 Cm', 10),
(9001, 'Finished', 'Vinyl Back 15mm Natural Hello', 'AAC001', 'ACP051', 'REACH', '18\" X 30\"', 50),
(9001, 'Finished', 'Vinyl Back 15mm Natural Welcome Border', 'AAC001', 'ACP050', 'REACH', '17.75\" X 38.75\"', 90),
(9003, 'Finished', 'Vinyl Back 15mm Natural Welcome Border', 'AAC001', 'ACP050', 'REACH', '17.75\" X 38.75\"', 100),
(9003, 'Finished', 'Vinyl Back 15mm Natural Hello', 'AAC001', 'ACP051', 'REACH', '18\" X 30\"', 40),
(9004, 'Finished', 'Vinyl Back 15mm Natural Welcome Border', 'AAC002', 'ACP050', 'REACH', '17.75\" X 38.75\"', 5),
(90005, 'Finished', 'Vinyl back 15mm natural Welcome Border', 'AAC001', 'ACP050', 'REACH', '17.75\" X 38.75\"', 40),
(90005, 'Finished', 'Vinyl Back 15mm Natural Hello', 'AAC001', 'ACP051', 'REACH', '18\" X 30\"', 30),
(90006, 'Finished', 'Vinyl Back 15mm Natural Welcome Border', 'AAC001', 'ACP050', 'REACH', '17.75\" X 38.75\"', 50),
(90006, 'Finished', 'Vinyl Back 15mm Natural Hello', 'AAC001', 'ACP051', 'REACH', '18\" X 30\"', 50),
(90006, 'Finished', 'Vinyl Back 15mm Natural Welcome Border', 'AAC001', 'ACP050', 'REACH', '17.75\" X 38.75\"', 50),
(90006, 'Finished', 'Vinyl Back 15mm Natural Hello', 'AAC001', 'ACP051', 'REACH', '18\" X 30\"', 50),
(900010, 'Finished', 'Vinyl Back 15mm Natural Welcome Border', 'AAC001', 'ACP050', 'REACH', '17.75\" X 38.75\"', 50),
(900010, 'Finished', 'Vinyl Back 15mm Natural Hello', 'AAC001', 'ACP051', 'REACH', '18\" X 30\"', 50),
(90011, 'Finished', 'Vinyl Back 15mm Natural Welcome Border', 'AAC001', 'ACP050', 'REACH', '17.75\" X 38.75\"', 50),
(90011, 'Finished', 'Vinyl Back 15mm Natural Hello', 'AAC001', 'ACP051', 'REACH', '18\" X 30\"', 50),
(900001, 'Finished', 'Vinyl Back 15mm Natural Welcome Border', 'AAC001', 'ACP050', 'REACH', '17.75\" X 38.75\"', 10),
(900001, 'Finished', 'Vinyl Back 15mm Natural Hello', 'AAC001', 'ACP051', 'REACH', '18\" X 30\"', 50),
(7000, 'Finished', 'Vinyl Back 15mm Natural Hello', 'AAC003', 'ACP051', 'REACH', '18\" X 30\"', 5),
(6000, 'Finished', 'Vinyl Back 15mm Natural Welcome Border', 'AAC002', 'ACP050', 'REACH', '17.75\" X 38.75\"', 5),
(800090, 'Finished', 'Black Natural 19mmm Welcome Border', 'AAC801', 'TUF059', 'Plain', '40 X 120cm', 100),
(6002, 'Finished', 'Vinyl Back 15mm Natural Clear', 'AAC800', 'ACP052', 'Border 4', '18\" X 30\"', 50),
(60021, 'Finished', 'Vinyl Back 15mm Natural Clear', 'AAC800', 'ACP052', 'Border 4', '18\" X 30\"', 50),
(600000002, 'Finished', 'Vinyl Back 15mm Natural Welcome Round Border', 'Testfor123', 'ACP050', 'Plain', '17.75\" X 38.75\"', 100),
(600000002, 'Finished', 'Vinyl Back 15mm Natural Hello', 'Testfor123', 'ACP051', 'Plain', '18\" X 30\"', 50),
(600000002, 'Finished', 'Black Rubber 18mm WET', 'Testfor123', 'TUF90', 'Round', '20', 1),
(6020, 'Finished', 'Vinyl Back 15mm Natural Hello', 'AAC123', 'ACP051', 'REACH', '18\" X 30\"', 100);

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
(9, '', 'TUF059', 'Vinyl back 15mm natural', 'Plain', '45 X 75 Cm', 573, 1),
(11, '', 'TUF060', 'Vinyl back 15mm natural', 'Plain', '40 X 120cm', 512, 1),
(12, '', 'COD900', 'Black Rubber 15mm', 'Plain', '40 X 120cm', 720, 1),
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(16, '2023-06-23', 'AAC123', 'Company 2', '', 'Closed', '2023-06-23 12:36:24');

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
('AAC123', 'ACP051', 'Vinyl Back 15mm Natural', 'REACH', '18\" X 30\"', 'Hello', 100);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
