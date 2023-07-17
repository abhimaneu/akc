-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 17, 2023 at 07:05 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `code`) VALUES
(1, 'Company 1', 'C1'),
(2, 'Company 2', 'C2'),
(3, 'Company 3', 'C3'),
(4, 'Company 4', 'C4'),
(5, 'Company 5', 'C5'),
(17, 'Company 6', 'C6');

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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `no` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `source` varchar(125) NOT NULL,
  `woc` varchar(125) NOT NULL,
  `op` int NOT NULL,
  `vehicleno` varchar(50) NOT NULL,
  `extras` varchar(125) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'inpass',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inpass`
--

INSERT INTO `inpass` (`no`, `date`, `source`, `woc`, `op`, `vehicleno`, `extras`, `type`, `timestamp`) VALUES
('1001', '2023-06-23', 'Company 2', 'C2', 798, 'KL 33 BC 1921', '', 'inpass', '2023-06-23 12:21:36'),
('7001', '2023-06-23', 'Company 2', 'C2', 1234, 'KL 33 OF 2323', '', 'inpass', '2023-06-23 12:21:36'),
('720', '2023-06-27', 'Company 2', 'C2', 9000, 'KL 33 BC 1921', 'Goods', 'inpass', '2023-06-27 10:53:29'),
('890', '2023-06-23', 'Company A', 'CA', 190, 'KL 33 BC 1920', '', 'inpass', '2023-06-23 12:21:36'),
('900', '2023-06-18', 'Company 1', 'C1', 100, 'KL 23 BC 2982', '', 'inpass', '2023-06-23 12:21:36'),
('901', '2023-06-18', 'Company 1', 'C1', 101, 'KL 23 BC 2982', '', 'inpass', '2023-06-23 12:21:36'),
('902', '2023-06-20', 'Company 5', 'C5', 809, 'KL 23 BC 2982', '', 'inpass', '2023-06-23 12:21:36'),
('903', '2023-06-20', 'Company 2', 'C2', 809, 'KL 23 BC 2982', '', 'inpass', '2023-06-23 12:21:36'),
('904', '2023-06-20', 'Company 2', 'C2', 9000, 'KL 33 BC 1920', '', 'inpass', '2023-06-23 12:21:36'),
('905', '2023-06-20', 'Company 2', 'C2', 123, 'KL 23 BC 2982', '', 'inpass', '2023-06-23 12:21:36'),
('9050', '2023-07-05', 'Company 2', 'C2', 123, 'KL 33 BC 1920', '', 'inpass', '2023-07-05 07:11:23'),
('9051', '2023-07-08', 'Company 2', 'C2', 124, 'KL 33 OF 2323', '', 'inpass', '2023-07-08 10:46:26'),
('9052', '2023-07-10', 'Company 5', 'C2', 100, 'KL 33 BC 1921', 'Goods', 'inpass', '2023-07-10 06:51:12'),
('9053', '2023-07-10', 'Company 2', 'C2', 102, 'KL 33 A 1112', '', 'inpass', '2023-07-10 07:36:20'),
('9055', '2023-07-10', 'Company 1', 'C1', 101, 'KL 33 A 1111', '', 'inpass', '2023-07-10 07:36:21'),
('906', '2023-06-20', 'Company 4', 'C4', 123, 'KL 33 BC 1920', '', 'inpass', '2023-06-23 12:21:36'),
('907', '2023-06-20', 'Company 2', 'C2', 123, 'KL 23 BC 2982', '', 'inpass', '2023-06-23 12:21:36'),
('908', '2023-06-20', 'Company 4', 'C4', 123, 'KL 33 BC 1920', '', 'inpass', '2023-06-23 12:21:36'),
('910', '2023-06-20', 'Company 2', 'C2', 878, 'KL 23 BC 2982', '', 'inpass', '2023-06-23 12:21:36'),
('911', '2023-06-20', 'Company 2', 'C2', 878, 'KL 23 BC 2983', '', 'inpass', '2023-06-23 12:21:36'),
('912', '2023-06-22', 'Company 2', 'C2', 200, 'KL 23 BC 2982', 'Goods', 'inpass', '2023-06-23 12:21:36'),
('915', '2023-06-23', 'Company 2', 'C2', 920, 'KL 33 BC 1921', '', 'inpass', '2023-06-23 12:21:36'),
('920', '2023-06-23', 'Company 3', 'C3', 929, 'KL 33 BC 1921', '', 'inpass', '2023-06-23 12:33:32'),
('921', '2023-07-03', 'Company 2', 'C2', 234, 'KL 23 BC 2982', '', 'inpass', '2023-07-02 19:04:37'),
('922', '2023-07-07', 'Company 2', 'C2', 123, 'KL 33 BC 1920', '', 'inpass', '2023-07-07 17:18:45'),
('923', '2023-07-03', 'Company 2', 'C2', 123, 'KL 33 BC 1920', '', 'inpass', '2023-07-03 15:36:28'),
('924', '2023-07-05', 'Company 2', 'C2', 878, 'KL 33 BC 1920', '', 'inpass', '2023-07-05 07:21:28'),
('925', '2023-07-05', 'Company 2', 'C2', 1, 'KL 33 BC 1921', '', 'inpass', '2023-07-05 07:22:56'),
('926', '2023-07-07', 'Company 4', 'C4', 234, 'KL 33 BC 1921', '', 'inpass', '2023-07-07 17:23:40'),
('927', '2023-07-07', 'Company 3', 'C3', 9000, 'KL 33 BC 1921', 'c1', 'inpass', '2023-07-07 17:24:06'),
('928', '2023-07-07', 'Company 3', 'C3', 9000, 'KL 33 BC 1921', 'c1', 'inpass', '2023-07-07 17:26:41'),
('930', '2023-07-07', 'Company 2', 'C2', 878, 'KL 33 BC 1920', '', 'inpass', '2023-07-07 17:29:48'),
('931', '2023-07-07', 'Company 2', 'C2', 878, 'KL 33 BC 1920', '', 'inpass', '2023-07-07 17:31:22'),
('932', '2023-07-07', 'Company 2', 'C2', 878, 'KL 23 BC 2983', 'c1', 'inpass', '2023-07-07 18:04:36'),
('935', '2023-07-08', 'Company 2', 'C2', 123, 'KL 33 A 1111', '', 'inpass', '2023-07-08 07:01:12'),
('936', '2023-07-08', 'Company 1', 'C1', 878, 'KL 33 A 0001', '', 'inpass', '2023-07-08 07:11:35'),
('937', '0000-00-00', 'c1', 'cc1', 123, 'KL 00 00 0000', 'ntg', 'inpass', '2023-10-07 06:30:00'),
('938', '0000-00-00', 'c1', 'cc1', 123, 'KL 00 00 0000', 'ntg', 'inpass', '2023-10-07 06:30:00'),
('939', '0000-00-00', 'c1', 'cc1', 123, 'KL 00 00 0000', 'ntg', 'inpass', '2023-10-07 06:30:00'),
('940', '2023-07-13', 'Company 2', 'C200', 123, 'KL 23 BC 2982', 'tt1', 'inpass', '2023-07-13 17:29:24'),
('941', '2023-07-13', 'Company 3', 'C3', 878, 'KL 33 BC 1920', '', 'inpass', '2023-07-13 17:32:08'),
('942', '2023-07-13', 'Company 3', 'C3', 878, 'KL 33 BC 1921', 'tt12', 'inpass', '2023-07-13 17:33:26'),
('943', '2023-07-13', 'Company 2', 'C2', 123, 'KL 33 BC 1920', 't2', 'inpass', '2023-07-13 17:33:51'),
('944', '2023-07-13', 'Company 5', 'C5', 123, 'KL 33 BC 1921', '', 'inpass', '2023-07-13 17:36:55'),
('945', '2023-07-16', 'Company 4', 'C4', 123, 'KL 23 BC 2982', 'test1', 'inpass', '2023-07-16 14:03:31');

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
(920, 'Vinyl back 15mm natural', 'TUF059', 'Plain', '45 X 75 Cm', 123),
(720, 'Black Rubber 15mm', 'COD902', 'Plain', '45 X 120cm', 17),
(720, 'Vinyl back 15mm natural', 'TUF159', 'Plain', '50 X 75 Cm', 18),
(921, 'Black Rubber 5mm', 'COD920', 'Plain', '40 X 120cm', 100),
(923, 'Vinyl back 15mm natural', 'TUF059', 'Plain', '45 X 75 Cm', 5),
(9050, 'Vinyl back 15mm natural', 'TUF059', 'Plain', '45 X 75 Cm', 100),
(924, 'Black Rubber 5mm', 'COD920', 'Plain', '40 X 120cm', 9),
(925, 'Vinyl back 20mm natural', 'TUF100', 'Border', '40 X 120cm', 1),
(922, 'Black Rubber 20mm', 'COD901', 'Plain', '40 X 120cm', 1),
(926, 'Black Rubber 20mm', 'COD901', 'Plain', '40 X 120cm', 188),
(927, 'Black Rubber 5mm', 'COD920', 'Plain', '40 X 120cm', 5),
(928, 'Black Rubber 20mm', 'COD901', 'Plain', '40 X 120cm', 12),
(930, 'Black Rubber 20mm', 'COD903', 'Plain', '45 X 120cm', 1),
(931, 'Black Rubber 20mm', 'COD903', 'Plain', '45 X 120cm', 1),
(932, 'Black Rubber 15mm', 'COD900', 'Plain', '40 X 120cm', 89),
(935, 'Vinyl back 20mm natural', 'TUF100', 'Border', '40 X 120cm', 200),
(935, 'Vinyl back 15mm natural', 'TUF059', 'Plain', '45 X 75 Cm', 200),
(936, 'Vinyl back 15mm natural', 'TUF060', 'Plain', '40 X 120cm', 20),
(936, 'Black Rubber 5mm', 'COD920', 'Plain', '40 X 120cm', 10),
(9051, 'Vinyl back 15mm natural', 'TUF060', 'Plain', '40 X 120cm', 1),
(9052, 'Black Rubber 20mm', 'COD901', 'Plain', '40 X 120cm', 200),
(9052, 'Black Rubber 5mm', 'COD920', 'Plain', '40 X 120cm', 10),
(9053, 'Vinyl back 15mm natural', 'TUF060', 'Plain', '40 X 120cm', 200),
(9055, 'Vinyl back 15mm natural', 'TUF059', 'Plain', '45 X 75 Cm', 100),
(940, 'Black Rubber 220mm', 'COD904', 'Plain', '45 X 120cm', 5),
(940, 'Black Rubber 200mm', 'COD905', 'Plain', '40 X 12cm', 10),
(940, 'Vinyl back 15mm natural', 'TUF070', 'Plain', '50 X 75 Cm', 100),
(940, 'Vinyl back 15mm natural', 'TUF070', 'Plain', '50 X 75 Cm', 500),
(941, '1', '1', '1', '1', 1),
(942, 'Vinyl back 15mm natural', 'TUF070', 'Plain', '50 X 75 Cm', 9),
(943, 'Black Rubber 205mm', 'COD906', 'Plain', '40 X 12cm', 10),
(944, 'Vinyl back 15mm natural', 'TUF071', 'Plain', '45 X 70 Cm', 19),
(944, 'Black Rubber 200mm', 'COD905', 'Plain', '40 X 12cm', 5),
(945, 'Vinyl back 15mm natural', 'TUF059', 'Plain', '45 X 75 Cm', 1),
(945, 'Black Rubber 220mm', 'COD904', 'Plain', '45 X 120cm', 2);

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
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_no`, `date`, `company`, `company_gstin`, `work_order_no`, `place_of_supply`, `type_of_payment`, `contact`, `statecode`, `note`, `gst_percentage`, `grand_total`, `cgst`, `sgst`, `less_ro`, `total_amount`, `mode_of_transport`, `timestamp`) VALUES
('A009', '2023-07-03', 'Company 3', 'GSTIN2392039', 'AAC009', 'Alapuzha', 'CASH', '974700000', '32', '', '18', '47.05', '4.23', '4.23', '0.51', '55.00', 'Vehicle', '2023-07-03 15:37:32'),
('A011', '2023-07-08', 'Company 2', 'GSTIN2392039', 'AAC011', 'Alapuzha', 'CASH', '974700000', '32', '', '18', '1129.20', '101.63', '101.63', '0.46', '1332.00', '', '2023-07-08 07:13:38'),
('A012', '2023-07-08', 'Company 2', '', 'AAC012', '', '', '', '', '', '18', '733.98', '66.06', '66.06', '0.10', '866.00', '', '2023-07-08 07:09:40'),
('A020', '2023-07-16', 'Company 1', '', 'AAC020', '', '', '', '', '', '18', '9.41', '0.85', '0.85', '0.11', '11.00', '', '2023-07-17 06:12:01'),
('A124', '2023-06-27', 'Company 2', 'GSTIN2392039', 'AAC124', 'Alapuzha', 'CASH', '974700000', '32', 'Goods', '18', '112.92', '10.16', '10.16', '0.24', '133.00', 'Vehicle', '2023-07-02 19:01:11'),
('A300', '2023-06-25', 'Company 2', 'GSTIN239203', 'AAC300', 'Alapuzha', 'ONLINE', '974700000', '32', 'Goods', '18', '941.00', '84.69', '84.69', '0.38', '1110.00', 'Vehicle', '2023-06-26 09:24:41'),
('Intest1', '2023-07-18', 'Company 2', 'GSTIN2392039', 'AKCtest1', 'Alapuzha', 'CASH', '974700000', '32', 'Goods', '18', '18250.00', '1642.50', '1642.50', '0.00', '21535.00', 'Vehicle', '2023-07-17 19:00:28');

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
  `total_unit` varchar(25) NOT NULL,
  `rate` float NOT NULL,
  `gst` float NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `invoice_data`
--

INSERT INTO `invoice_data` (`invoice_no`, `work_order_no`, `product_name`, `type`, `size`, `unit`, `nopcs`, `rm`, `total_unit`, `rate`, `gst`, `amount`) VALUES
('A300', 'AAC300', 'Vinyl Back 15mm Natural Welcome Border REACH', 'Passing Final', '17.75\" X 38.75\"', 'Inch', 10, 10, '10 Nos', 1.5, 18, 15),
('A300', 'AAC300', 'Vinyl Back 15mm Natural Welcome Border REACH', 'Packing', '17.75\" X 38.75\"', 'Inch', 10, 10, '10 Nos', 2, 18, 20),
('A300', 'AAC300', 'Vinyl Back 15mm Natural Welcome Border REACH', 'Tagging', '17.75\" X 38.75\"', 'Inch', 10, 10, '10 Nos', 5.75, 18, 57.5),
('A300', 'AAC300', 'Vinyl Back 15mm Natural Welcome Border REACH', 'Landing And Loading', '17.75\" X 38.75\"', 'Inch', 10, 10, '10 Nos', 0.16, 18, 1.6),
('A300', 'AAC300', 'Vinyl Back 15mm Natural Hello REACH', 'Passing Final', '18\" X 30\"', 'Inch', 20, 20, '20 Nos', 1.5, 18, 30),
('A300', 'AAC300', 'Vinyl Back 15mm Natural Hello REACH', 'Packing', '18\" X 30\"', 'Inch', 20, 20, '20 Nos', 2, 18, 40),
('A300', 'AAC300', 'Vinyl Back 15mm Natural Hello REACH', 'Tagging', '18\" X 30\"', 'Inch', 20, 20, '20 Nos', 5.75, 18, 115),
('A300', 'AAC300', 'Vinyl Back 15mm Natural Hello REACH', 'Landing And Loading', '18\" X 30\"', 'Inch', 20, 20, '20 Nos', 0.16, 18, 3.2),
('A300', 'AAC300', 'Black Natural 19mm Welcome Border Border 4', 'Passing Final', '17.75\" X 38.75\"', 'Inch', 30, 30, '30 Nos', 1.5, 18, 45),
('A300', 'AAC300', 'Black Natural 19mm Welcome Border Border 4', 'Packing', '17.75\" X 38.75\"', 'Inch', 30, 30, '30 Nos', 2, 18, 60),
('A300', 'AAC300', 'Black Natural 19mm Welcome Border Border 4', 'Tagging', '17.75\" X 38.75\"', 'Inch', 30, 30, '30 Nos', 5.75, 18, 172.5),
('A300', 'AAC300', 'Black Natural 19mm Welcome Border Border 4', 'Landing And Loading', '17.75\" X 38.75\"', 'Inch', 30, 30, '30 Nos', 0.16, 18, 4.8),
('A300', 'AAC300', 'Black Rubber 15mm Clear Plain', 'Passing Final', '18\" X 30\"', 'Inch', 40, 40, '40 Nos', 1.5, 18, 60),
('A300', 'AAC300', 'Black Rubber 15mm Clear Plain', 'Packing', '18\" X 30\"', 'Inch', 40, 40, '40 Nos', 2, 18, 80),
('A300', 'AAC300', 'Black Rubber 15mm Clear Plain', 'Tagging', '18\" X 30\"', 'Inch', 40, 40, '40 Nos', 5.75, 18, 230),
('A300', 'AAC300', 'Black Rubber 15mm Clear Plain', 'Landing And Loading', '18\" X 30\"', 'Inch', 40, 40, '40 Nos', 0.16, 18, 6.4),
('A124', 'AAC124', 'Vinyl Back 15mm Natural Welcome Border REACH', 'Passing Final', '17.75\" X 38.75\"', 'Inch', 10, 10, '10 Nos', 1.5, 18, 15),
('A124', 'AAC124', 'Vinyl Back 15mm Natural Welcome Border REACH', 'Packing', '17.75\" X 38.75\"', 'Inch', 10, 10, '10 Nos', 2, 18, 20),
('A124', 'AAC124', 'Vinyl Back 15mm Natural Welcome Border REACH', 'Tagging', '17.75\" X 38.75\"', 'Inch', 10, 10, '10 Nos', 5.75, 18, 57.5),
('A124', 'AAC124', 'Vinyl Back 15mm Natural Welcome Border REACH', 'Landing And Loading', '17.75\" X 38.75\"', 'Inch', 10, 10, '10 Nos', 0.16, 18, 1.6),
('A124', 'AAC124', 'Vinyl Back 15mm Natural Hello REACH', 'Passing Final', '18\" X 30\"', 'Inch', 2, 2, '2 Nos', 1.5, 18, 3),
('A124', 'AAC124', 'Vinyl Back 15mm Natural Hello REACH', 'Packing', '18\" X 30\"', 'Inch', 2, 2, '2 Nos', 2, 18, 4),
('A124', 'AAC124', 'Vinyl Back 15mm Natural Hello REACH', 'Tagging', '18\" X 30\"', 'Inch', 2, 2, '2 Nos', 5.75, 18, 11.5),
('A124', 'AAC124', 'Vinyl Back 15mm Natural Hello REACH', 'Landing And Loading', '18\" X 30\"', 'Inch', 2, 2, '2 Nos', 0.16, 18, 0.32),
('A009', 'AAC009', 'Vinyl Back 15mm Natural Welcome Border REACH', 'Passing Final', '17.75\" X 38.75\"', 'Inch', 5, 5, '5 Nos', 1.5, 18, 7.5),
('A009', 'AAC009', 'Vinyl Back 15mm Natural Welcome Border REACH', 'Packing', '17.75\" X 38.75\"', 'Inch', 5, 5, '5 Nos', 2, 18, 10),
('A009', 'AAC009', 'Vinyl Back 15mm Natural Welcome Border REACH', 'Tagging', '17.75\" X 38.75\"', 'Inch', 5, 5, '5 Nos', 5.75, 18, 28.75),
('A009', 'AAC009', 'Vinyl Back 15mm Natural Welcome Border REACH', 'Landing And Loading', '17.75\" X 38.75\"', 'Inch', 5, 5, '5 Nos', 0.16, 18, 0.8),
('A012', 'AAC012', 'Vinyl Back 15mm Natural Welcome Border REACH', 'Passing Final', '17.75\" X 38.75\"', 'Inch', 50, 50, '50 Nos', 1.5, 18, 75),
('A012', 'AAC012', 'Vinyl Back 15mm Natural Welcome Border REACH', 'Packing', '17.75\" X 38.75\"', 'Inch', 50, 50, '50 Nos', 2, 18, 100),
('A012', 'AAC012', 'Vinyl Back 15mm Natural Welcome Border REACH', 'Tagging', '17.75\" X 38.75\"', 'Inch', 50, 50, '50 Nos', 5.75, 18, 287.5),
('A012', 'AAC012', 'Vinyl Back 15mm Natural Welcome Border REACH', 'Landing And Loading', '17.75\" X 38.75\"', 'Inch', 50, 50, '50 Nos', 0.16, 18, 8),
('A012', 'AAC012', 'Vinyl Back 15mm Natural Hello REACH', 'Passing Final', '18\" X 30\"', 'Inch', 28, 28, '28 Nos', 1.5, 18, 42),
('A012', 'AAC012', 'Vinyl Back 15mm Natural Hello REACH', 'Packing', '18\" X 30\"', 'Inch', 28, 28, '28 Nos', 2, 18, 56),
('A012', 'AAC012', 'Vinyl Back 15mm Natural Hello REACH', 'Tagging', '18\" X 30\"', 'Inch', 28, 28, '28 Nos', 5.75, 18, 161),
('A012', 'AAC012', 'Vinyl Back 15mm Natural Hello REACH', 'Landing And Loading', '18\" X 30\"', 'Inch', 28, 28, '28 Nos', 0.16, 18, 4.48),
('A011', 'AAC011', 'Vinyl Back 15mm Natural Hello REACH', 'Passing Final', '18\" X 30\"', 'Inch', 100, 100, '100 Nos', 4.5, 18, 450),
('A011', 'AAC011', 'Vinyl Back 15mm Natural Hello REACH', 'Packing', '18\" X 30\"', 'Inch', 100, 100, '100 Nos', 2, 18, 200),
('A011', 'AAC011', 'Vinyl Back 15mm Natural Hello REACH', 'Tagging', '18\" X 30\"', 'Inch', 100, 100, '100 Nos', 2.75, 18, 275),
('A011', 'AAC011', 'Vinyl Back 15mm Natural Hello REACH', 'Landing And Loading', '18\" X 30\"', 'Inch', 100, 100, '100 Nos', 0.16, 18, 16),
('A011', 'AAC011', 'Vinyl Back 15mm Natural Hello REACH', 'Passing Final', '18\" X 30\"', 'Inch', 20, 20, '20 Nos', 1.5, 18, 30),
('A011', 'AAC011', 'Vinyl Back 15mm Natural Hello REACH', 'Packing', '18\" X 30\"', 'Inch', 20, 20, '20 Nos', 2, 18, 40),
('A011', 'AAC011', 'Vinyl Back 15mm Natural Hello REACH', 'Tagging', '18\" X 30\"', 'Inch', 20, 20, '20 Nos', 5.75, 18, 115),
('A011', 'AAC011', 'Vinyl Back 15mm Natural Hello REACH', 'Landing And Loading', '18\" X 30\"', 'Inch', 20, 20, '20 Nos', 0.16, 18, 3.2),
('A020', 'AAC020', 'Vinyl Back 15mm Natural REACH', 'Passing Final', '18\" X 30\"', 'Inch', 1, 1, '1 Nos', 1.5, 18, 1.5),
('A020', 'AAC020', 'Vinyl Back 15mm Natural REACH', 'Packing', '18\" X 30\"', 'Inch', 1, 1, '1 Nos', 2, 18, 2),
('A020', 'AAC020', 'Vinyl Back 15mm Natural REACH', 'Tagging', '18\" X 30\"', 'Inch', 1, 1, '1 Nos', 5.75, 18, 5.75),
('A020', 'AAC020', 'Vinyl Back 15mm Natural REACH', 'Landing And Loading', '18\" X 30\"', 'Inch', 1, 1, '1 Nos', 0.16, 18, 0.16),
('Intest1', 'AKCtest1', 'Vinyl test product', 'Passing Final', '20 X 72 cm', 'Inch', 1000, 1000, '1000 Nos', 1.5, 18, 1500),
('Intest1', 'AKCtest1', 'Vinyl test product', 'Packing', '20 X 72 cm', 'Inch', 1000, 1000, '8000 Sqft', 2, 18, 16000),
('Intest1', 'AKCtest1', 'Black Rubber Mat Test', 'Packing', '18 X 30 CM', 'INCH', 500, 500, '500 Nos', 1.5, 18, 750);

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
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=600000003 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `outpass`
--

INSERT INTO `outpass` (`no`, `date`, `work_order_no`, `dest`, `woc`, `vehicleno`, `extras`, `invoice_no`, `type`, `timestamp`) VALUES
(1000, '2023-07-08', 'AAC012', 'Company 2', 'C2', 'KL 05 B 2834', 'Out', 'A012', 'outpass', '2023-07-08 07:03:07'),
(1002, '2023-07-08', 'AAC011', 'Company 2', 'C2', 'KL 33 BC 1921', '', 'A011', 'outpass', '2023-07-08 07:12:54'),
(1200, '2023-06-24', 'AAC100', 'Company 2', 'C2', 'KL 33 BC 1920', '', 'Not Generated', 'outpass', '2023-06-23 18:38:25'),
(1201, '2023-06-25', 'AAC101', 'Company 4', 'C4', 'KL 05 B 2834', '', 'Not Generated', 'outpass', '2023-06-24 20:33:40'),
(1203, '2023-06-25', 'AAC200', 'Company 5', 'C5', 'KL 33 BC 1920', '', 'Not Generated', 'outpass', '2023-06-24 20:34:21'),
(1204, '2023-06-25', 'AAC300', 'Company 2', 'C2', 'KL 23 BC 2983', '', 'A300', 'outpass', '2023-06-24 20:35:59'),
(1210, '2023-06-27', 'AAC124', 'Company 2', 'C2', 'KL 33 BC 1921', '', 'A124', 'outpass', '2023-06-27 16:10:02'),
(1214, '2023-07-03', 'AAC099', 'Company 4', 'C4', 'KL 33 BC 1921', '', 'Not Generated', 'outpass', '2023-07-02 19:06:32'),
(8000, '2023-07-07', 'AAC102', 'Company 3', 'C3', 'KL 33 BC 1921', '', 'Not Generated', 'outpass', '2023-07-07 17:42:48'),
(90009, '2023-07-03', 'AAC009', 'Company 3', 'C3', 'KL 33 BC 1921', '', 'A009', 'outpass', '2023-07-03 15:37:05'),
(90010, '2023-07-05', 'AAC003', 'Company 2', 'C2', 'KL 33 BC 1923', '', 'Not Generated', 'outpass', '2023-07-05 07:12:07'),
(90011, '2023-07-08', 'AAC011', 'Company 2', 'C2', 'KL 33 BC 1923', '', 'Not Generated', 'outpass', '2023-07-08 10:54:35'),
(90012, '2023-07-11', 'AAC004', 'Company 3', 'C3', 'KL 33 BC 1921', '', 'Not Generated', 'outpass', '2023-07-11 18:00:09'),
(90013, '2023-07-11', 'AAC004', 'Company 3', 'C3', '1', '', 'Not Generated', 'outpass', '2023-07-11 18:04:54'),
(90014, '2023-07-11', 'AAC004', 'Company 3', 'C3', 'KL 33 BC 1921', 't1', 'Not Generated', 'outpass', '2023-07-11 18:05:22'),
(90015, '2023-07-11', 'AAC004', 'Company 3', 'C3', 'KL 33 BC 1921', 't2', 'Not Generated', 'outpass', '2023-07-11 18:06:08'),
(90016, '2023-07-11', 'AAC010', 'Company 2', 'C2', 'KL 33 BC 1921', 't1', 'Not Generated', 'outpass', '2023-07-11 18:09:42'),
(90017, '2023-07-13', 'AACtt1', 'Company 4', 'C4', 'KL 33 BC 1921', 'tt1', 'Not Generated', 'outpass', '2023-07-13 17:17:10'),
(90018, '2023-07-13', 'AACtt2', 'Company 1', 'C1', 'KL 33 BC 1921', '', 'Not Generated', 'outpass', '2023-07-13 17:39:29'),
(90019, '2023-07-16', 'AAC019', 'Company 2', 'C2', 'KL 33 BC 1921', '', 'Not Generated', 'outpass', '2023-07-16 14:38:22'),
(90020, '2023-07-16', 'AAC020', 'Company 1', 'C1', 'KL 33 BC 1921', '', 'A020', 'outpass', '2023-07-16 14:52:01'),
(90021, '2023-07-17', 'AACtimetesting', 'Company 6', 'C6', 'KL 33 BC 1921', '', 'Not Generated', 'outpass', '2023-07-17 11:18:11'),
(90022, '2023-07-28', 'AACtimetesting', 'Company 6', 'C6', 'KL 05 B 2834', '', 'Not Generated', 'outpass', '2023-07-17 11:19:08');

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
(1204, 'Finished', 'Black Rubber 15mm Clear', 'AAC300', 'ACP023', 'Plain', '18\" X 30\"', 40),
(1210, 'Finished', 'Vinyl Back 15mm Natural Welcome Border', 'AAC124', 'ACP050', 'REACH', '17.75\" X 38.75\"', 10),
(1210, 'Finished', 'Vinyl Back 15mm Natural Hello', 'AAC124', 'ACP051', 'REACH', '18\" X 30\"', 2),
(1214, 'Finished', 'Black Natural 5mm Clear Border', 'AAC099', 'ACP053', 'REACH', '40 X 120cm', 50),
(90009, 'Finished', 'Vinyl Back 15mm Natural Welcome Border', 'AAC009', 'ACP050', 'REACH', '17.75\" X 38.75\"', 5),
(90010, 'Finished', 'Vinyl Back 15mm Natural Welcome Border', 'AAC003', 'ACP050', 'REACH', '17.75\" X 38.75\"', 1),
(8000, 'Finished', 'Vinyl Back 15mm Natural Welcome Border', 'AAC102', 'ACP050', 'REACH', '17.75\" X 38.75\"', 2),
(8000, 'Finished', 'Vinyl Back 15mm Natural Hello', 'AAC102', 'ACP051', 'REACH', '18\" X 30\"', 2),
(1000, 'Finished', 'Vinyl Back 15mm Natural Welcome Border', 'AAC012', 'ACP050', 'REACH', '17.75\" X 38.75\"', 50),
(1000, 'Finished', 'Vinyl Back 15mm Natural Hello', 'AAC012', 'ACP051', 'REACH', '18\" X 30\"', 28),
(1002, 'Finished', 'Vinyl Back 15mm Natural Hello', 'AAC011', 'ACP051', 'REACH', '18\" X 30\"', 100),
(1002, 'Finished', 'Vinyl Back 15mm Natural Hello', 'AAC011', 'ACP051', 'REACH', '18\" X 30\"', 20),
(90011, 'Finished', 'Vinyl Back 15mm Natural Hello', 'AAC011', 'ACP051', 'REACH', '18\" X 30\"', 100),
(90011, 'Finished', 'Vinyl Back 15mm Natural Hello', 'AAC011', 'ACP051', 'REACH', '18\" X 30\"', 20),
(90012, 'Finished', 'Vinyl Back 15mm Natural Hello', 'AAC102', 'ACP051', 'REACH', '18\" X 30\"', 58),
(90012, 'Finished', 'Vinyl Back 15mm Natural Hello', 'AAC102', 'ACP051', 'REACH', '18\" X 30\"', 58),
(90012, 'Finished', 'Vinyl Back 15mm Natural Welcome Border', 'AAC004', 'ACP050', 'REACH', '17.75\" X 38.75\"', 0),
(90013, 'Finished', 'Vinyl Back 15mm Natural Welcome Border', 'AAC004', 'ACP050', 'REACH', '17.75\" X 38.75\"', 1),
(90014, 'Finished', 'Vinyl Back 15mm Natural Welcome Border', 'AAC004', 'ACP050', 'REACH', '17.75\" X 38.75\"', 94),
(90015, 'Finished', 'Vinyl Back 15mm Natural Welcome Border', 'AAC004', 'ACP050', 'None', '17.75\" X 38.75\"', 5),
(90016, 'Finished', 'Vinyl Back 15mm Natural Welcome Border', 'AAC010', 'ACP050', 'REACH', '17.75\" X 38.75\"', 5),
(90016, 'Finished', 'Vinyl Back 15mm Natural Hello', 'AAC010', 'ACP051', 'REACH', '18\" X 30\"', 5),
(90017, 'Finished', 'Vinyl Back 15mm Natural', 'AACtt1', 'ACP051', 'REACH', '18\" X 30\"', 5),
(90017, 'Finished', 'Vinyl Back 15mm Natural', 'AACtt1', 'ACP050', 'REACH', '17.75\" X 38.75\"', 5),
(90018, 'Finished', 'Vinyl Back 15mm Natural', 'AACtt2', 'ACP051', 'REACH', '18\" X 30\"', 15),
(90018, 'Finished', 'Vinyl back 15mm natural', 'AACtt2', 'ACP052', 'REACH', '45 X 120cm', 20),
(90019, 'Finished', 'Vinyl Back 15mm Natural', 'AAC019', 'ACP051', 'REACH', '18\" X 30\"', 70),
(90020, 'Finished', 'Vinyl Back 15mm Natural', 'AAC020', 'ACP051', 'REACH', '18\" X 30\"', 1),
(90021, 'Finished', 'Vinyl Back 15mm Natural', 'AACtimetesting', 'ACP051', 'REACH', '18\" X 30\"', 1),
(90021, 'Finished', 'Vinyl Back 15mm Natural', 'AACtimetesting', 'ACP050', 'REACH', '17.75\" X 38.75\"', 5),
(90022, 'Finished', 'Vinyl Back 15mm Natural', 'AACtimetesting', 'ACP051', 'REACH', '18\" X 30\"', 5),
(90022, 'Finished', 'Vinyl Back 15mm Natural', 'AACtimetesting', 'ACP050', 'REACH', '17.75\" X 38.75\"', 1);

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
('Vinyl back 20mm natural', 'TUF100', 'Border', '40 X 120cm', 'finished'),
('Black Rubber 5mm', 'COD920', 'Plain', '40 X 120cm', 'finished'),
('Black Rubber 20mm', 'COD903', 'Plain', '45 X 120cm', 'finished'),
('Black Rubber 220mm', 'COD904', 'Plain', '45 X 120cm', 'finished'),
('Black Rubber 200mm', 'COD905', 'Plain', '40 X 12cm', 'finished'),
('Vinyl back 15mm natural', 'TUF070', 'Plain', '50 X 75 Cm', 'finished'),
('1', '1', '1', '1', 'finished'),
('Black Rubber 205mm', 'COD906', 'Plain', '40 X 12cm', 'finished'),
('Vinyl back 15mm natural', 'TUF071', 'Plain', '45 X 70 Cm', 'finished');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `name` varchar(50) NOT NULL,
  `wo` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `gstin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`name`, `wo`, `gstin`) VALUES
('Akshay Coir', 'AK123', 'GSTIN00000000');

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
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`index`, `grade`, `code`, `item`, `design`, `size`, `qty`, `default`) VALUES
(9, '', 'TUF059', 'Vinyl back 15mm natural', 'Plain', '45 X 75 Cm', 381, 1),
(11, '', 'TUF060', 'Vinyl back 15mm natural', 'Plain', '40 X 120cm', 519, 1),
(12, '', 'COD900', 'Black Rubber 15mm', 'Plain', '40 X 120cm', 689, 1),
(15, '', 'COD901', 'Black Rubber 20mm', 'Plain', '40 X 120cm', 521, 1),
(16, '', 'TUF100', 'Vinyl back 20mm natural', 'Border', '40 X 120cm', 300, 1),
(17, '', 'COD902', 'Black Rubber 15mm', 'Plain', '45 X 120cm', 17, 1),
(18, '', 'TUF159', 'Vinyl back 15mm natural', 'Plain', '50 X 75 Cm', 538, 1),
(19, '', 'COD920', 'Black Rubber 5mm', 'Plain', '40 X 120cm', 84, 1),
(20, '', 'COD903', 'Black Rubber 20mm', 'Plain', '45 X 120cm', 2, 1),
(21, '', '', 'Black Rubber 220mm', '', '45 X 120cm', 7, 1),
(22, '', '', 'Black Rubber 200mm', '', '40 X 12cm', 15, 1),
(23, '', 'NULL', '1', 'NULL', '1', 1, 1),
(24, '', 'NULL', 'Black Rubber 205mm', 'NULL', '40 X 12cm', 10, 1),
(25, '', 'NULL', 'Vinyl back 15mm natural', 'Plain', '45 X 70 Cm', 2, 1);

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
  `type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stock_data`
--

INSERT INTO `stock_data` (`timestamp`, `product_name`, `product_size`, `product_qty`, `total_qty`, `type`) VALUES
('2023-07-16 19:33:31', 'Vinyl back 15mm natural', '45 X 75 Cm', 1, 386, 'Inpass'),
('2023-07-16 19:33:31', 'Black Rubber 220mm', '45 X 120cm', 2, 7, 'Inpass'),
('2023-07-16 20:08:22', 'Vinyl Back 15mm Natural', '18\" X 30\"', 70, 539, 'Outpass'),
('2023-07-16 20:22:01', 'Vinyl back 15mm natural', '50 X 75 Cm', 1, 538, 'Outpass'),
('2023-07-17 16:48:11', 'Vinyl back 15mm natural', '45 X 70 Cm', 1, 3, 'Outpass'),
('2023-07-17 16:48:11', 'Vinyl back 15mm natural', '45 X 75 Cm', 5, 381, 'Outpass'),
('2023-07-17 16:49:08', 'Vinyl back 15mm natural', '40 X 120cm', 5, 519, 'Outpass'),
('2023-07-17 16:49:08', 'Vinyl back 15mm natural', '45 X 70 Cm', 1, 2, 'Outpass');

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `work_order_no` (`work_order_no`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `work_orders`
--

INSERT INTO `work_orders` (`id`, `date`, `work_order_no`, `company`, `extras`, `status`, `timestamp`) VALUES
(5, '2023-06-19', 'AAC001', 'Company 3', '', 'Open', '2023-06-23 12:22:33'),
(6, '2023-06-20', 'AAC002', 'Company 4', '', 'Closed', '2023-06-23 12:22:33'),
(7, '2023-06-23', 'AAC004', 'Company 3', '', 'Closed', '2023-07-11 18:06:08'),
(8, '2023-06-23', 'AAC800', 'Company 4', '', 'Closed', '2023-06-23 12:22:33'),
(9, '2023-06-23', 'AAC801', 'Company 1', '', 'Closed', '2023-06-23 12:22:33'),
(16, '2023-06-23', 'AAC123', 'Company 2', '', 'Closed', '2023-06-23 12:36:24'),
(17, '2023-06-24', 'AAC100', 'Company 2', '', 'Closed', '2023-06-23 18:38:25'),
(20, '2023-06-25', 'AAC300', 'Company 2', '', 'Open', '2023-06-24 20:33:08'),
(24, '2023-06-28', 'AAC102', 'Company 3', '123', 'Open', '2023-06-27 18:56:07'),
(25, '2023-07-03', 'AAC099', 'Company 4', '', 'Closed', '2023-07-02 19:06:32'),
(26, '2023-07-03', 'AAC009', 'Company 3', '', 'Closed', '2023-07-03 15:37:05'),
(33, '2023-07-07', 'AAC010', 'Company 2', 'c1', 'Closed', '2023-07-11 18:09:42'),
(35, '2023-07-08', 'AAC011', 'Company 2', '', 'Closed', '2023-07-08 10:54:35'),
(39, '2023-07-16', 'AAC019', 'Company 2', 't1', 'Closed', '2023-07-16 14:38:22'),
(40, '2023-07-16', 'AAC020', 'Company 1', '', 'Closed', '2023-07-16 14:52:01');

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
('AAC004', 'ACP050', 'Vinyl Back 15mm Natural', 'REACH', '17.75\" X 38.75\"', 'Welcome Border', 1),
('AAC801', 'TUF059', 'Black Natural 19mmm', 'Plain', '40 X 120cm', 'Welcome Border', 1000),
('AAC001', 'ACP051', 'Vinyl Back 15mm Natural', 'REACH', '18\" X 30\"', 'Hello', 58),
('AAC002', 'ACP050', 'Vinyl Back 15mm Natural', 'REACH', '17.75\" X 38.75\"', 'Welcome Border', 1),
('AAC100', 'ACP051', 'Vinyl Back 15mm Natural', 'REACH', '18\" X 30\"', 'Hello', 58),
('AAC100', 'ACP050', 'Vinyl Back 15mm Natural', 'REACH', '17.75\" X 38.75\"', 'Welcome Border', 1),
('AAC300', 'ACP050', 'Vinyl Back 15mm Natural', 'REACH', '17.75\" X 38.75\"', 'Welcome Border', 1),
('AAC300', 'ACP051', 'Vinyl Back 15mm Natural', 'REACH', '18\" X 30\"', 'Hello', 58),
('AAC300', 'ACP022', 'Black Natural 19mm', 'Border 4', '17.75\" X 38.75\"', 'Welcome Border', 300),
('AAC300', 'ACP023', 'Black Rubber 15mm', 'Plain', '18\" X 30\"', 'Clear', 360),
('AAC123', 'ACP051', 'Vinyl Back 15mm Natural', 'REACH', '18\" X 30\"', 'Hello', 58),
('AAC800', 'ACP052', 'Vinyl Back 15mm Natural', 'Border 4', '18\" X 30\"', 'Clear', 50),
('AAC102', 'ACP050', 'Vinyl Back 15mm Natural', 'REACH', '17.75\" X 38.75\"', 'Welcome Border', 1),
('AAC102', 'ACP051', 'Vinyl Back 15mm Natural', 'REACH', '18\" X 30\"', 'Hello', 58),
('AAC099', 'ACP053', 'Black Natural 5mm', 'REACH', '40 X 120cm', 'Clear Border', 50),
('AAC009', 'ACP050', 'Vinyl Back 15mm Natural', 'REACH', '17.75\" X 38.75\"', 'Welcome Border', 1),
('AAC010', 'ACP050', 'Vinyl Back 15mm Natural', 'REACH', '17.75\" X 38.75\"', 'Welcome Border', 1),
('AAC010', 'ACP051', 'Vinyl Back 15mm Natural', 'REACH', '18\" X 30\"', 'Hello', 5),
('AAC011', 'ACP051', 'Vinyl Back 15mm Natural', 'REACH', '18\" X 30\"', 'Hello', 100),
('AAC011', 'ACP051', 'Vinyl Back 15mm Natural', 'REACH', '18\" X 30\"', 'Hello', 20),
('AAC019', 'ACP051', 'Vinyl Back 15mm Natural', 'REACH', '18\" X 30\"', '', 70),
('AAC020', 'ACP051', 'Vinyl Back 15mm Natural', 'REACH', '18\" X 30\"', '', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
