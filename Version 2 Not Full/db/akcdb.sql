-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 25, 2023 at 07:56 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `code`, `user_id`) VALUES
(1, 'Company 1', 'C1', 'akshaycoir'),
(34, 'Company 2', 'C200', 'new'),
(35, 'Akshay Coir', 'AKC1', 'new'),
(36, 'Company MAIN', 'cm', 'akshaycoir'),
(37, 'Company 3', 'c3', 'akshaycoir'),
(38, 'Company 2', 'C2', 'test'),
(39, 'Company 1', 'C2', 'test'),
(40, 'Company 3', 'c3', 'test');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inpass`
--

INSERT INTO `inpass` (`no`, `date`, `source`, `woc`, `op`, `vehicleno`, `extras`, `type`, `timestamp`, `user_id`) VALUES
(1, '2023-07-26', 'Company 1', 'C1', '1', 'KL 23 BC 2982', '', 'inpass', '2023-07-25 18:34:50', 'akshaycoir'),
(2, '2023-07-26', 'Company MAIN', 'cm', '2', 'KL 23 BC 2982', '', 'inpass', '2023-07-25 18:35:04', 'akshaycoir');

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
('1', '1/2324', '2023-07-26', 'Company 1', 'C1', '1', 'KL 23 BC 2982', '', 'inpass', '2023-07-25 18:34:50', 'akshaycoir'),
('2', '2/2324', '2023-07-26', 'Company MAIN', 'cm', '2', 'KL 23 BC 2982', '', 'inpass', '2023-07-25 18:35:04', 'akshaycoir'),
('6', '6/2324', '2023-07-26', 'Company 1', 'C2', '878', 'KL 23 BC 2982', '', 'inpass', '2023-07-25 19:41:13', 'test'),
('7', '7/2324', '2023-07-26', 'Company 3', 'c3', '123', 'KL 23 BC 2982', '', 'inpass', '2023-07-25 19:41:27', 'test'),
('8', '8/2324', '2023-07-26', 'Company 1', 'C2', '123', 'KL 33 BC 1920', '', 'inpass', '2023-07-25 19:41:36', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `inpass_products`
--

DROP TABLE IF EXISTS `inpass_products`;
CREATE TABLE IF NOT EXISTS `inpass_products` (
  `inpass_no` int NOT NULL,
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

INSERT INTO `inpass_products` (`inpass_no`, `date_of_entry`, `product_name`, `product_code`, `product_design`, `product_size`, `product_qty`, `user_id`) VALUES
(1, '2023-07-26', 'test', 'COP900', 'test1', 'twa x tes', 500, 'akshaycoir'),
(2, '2023-07-26', 'Black Rubber 15mm', 'TUF059', 'plain', '40x120cm', 100, 'akshaycoir'),
(2, '2023-07-26', 'Vinyl Back 15mm Natural', 'ACP050', 'Plain', '40x120cm', 20, 'akshaycoir');

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
('1', '1/2324', '2023-07-26', 'test', 'COP900', 'test1', 'twa x tes', '500', 'akshaycoir'),
('2', '2/2324', '2023-07-26', 'Black Rubber 15mm', 'TUF059', 'plain', '40x120cm', '100', 'akshaycoir'),
('2', '2/2324', '2023-07-26', 'Vinyl Back 15mm Natural', 'ACP050', 'Plain', '40x120cm', '20', 'akshaycoir'),
('6', '6/2324', '2023-07-26', 'Vinyl Back 15mm Natural', 'ACP050', 'Plain', '40 X 120 cm', '500', 'test'),
('7', '7/2324', '2023-07-26', 'Vinyl Back 15mm Natural', 'ACP050', 'Plain', '40 X 120 cm', '50', 'test'),
('8', '8/2324', '2023-07-26', 'Black Rubber 15mm', 'TUF059', 'plain', '45 X 75 cm', '1000', 'test');

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
('A001', '2023-07-23', 'Company 1', '', 'AKC001', '', '', '', '', '', '18', '18.00', '1.62', '1.62', '0.24', '21.00', '', '2023-07-23 14:41:37', 'akshaycoir'),
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
('A001', 'AKC001', 0, 'Vinyl back 15mm Natural', 'Passing Final', '45 X 75 cm', 'Inch', 8, 8, '8 Nos', 1.5, 18, 12, 'akshaycoir'),
('A001', 'AKC001', 1, 'Vinyl back 15mm Natural', 'Passing Final', '40 X 120 cm', 'Inch', 4, 4, '4 Nos', 1.5, 18, 6, 'akshaycoir'),
('N001', 'NEW001', 0, 'Vinyl back 15mm Natural', 'Passing Final', '45 X 75 cm', 'Inch', 40, 40, '40 Nos', 1.5, 18, 60, 'new');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `outpass`
--

INSERT INTO `outpass` (`no`, `date`, `work_order_no`, `dest`, `woc`, `vehicleno`, `extras`, `invoice_no`, `type`, `timestamp`, `user_id`) VALUES
(1, '2023-07-23', 'AKC001', 'Company 1', 'C1', 'KL 33 BC 1920', '', 'Not Generated', 'outpass', '2023-07-23 14:32:48', 'akshaycoir'),
(2, '2023-07-23', 'AKC001', 'Company 1', 'C1', 'KL 33 BC 1921', '', 'Not Generated', 'outpass', '2023-07-23 14:33:24', 'akshaycoir'),
(3, '2023-07-23', 'AKC001', 'Company 1', 'C1', 'KL 33 BC 1921', '', 'Not Generated', 'outpass', '2023-07-23 14:34:23', 'akshaycoir'),
(4, '2023-07-23', 'AKC001', 'Company 1', 'C1', 'KL 33 BC 1921', '', 'Not Generated', 'outpass', '2023-07-23 14:50:34', 'akshaycoir'),
(6, '2023-07-23', 'AKC002', 'Company MAIN', 'cm', 'KL 33 BC 1921', '', 'Not Generated', 'outpass', '2023-07-23 14:50:49', 'akshaycoir'),
(7, '2023-07-23', 'AKC001', 'Company 1', 'C1', 'KL 05 B 2834', '', 'Not Generated', 'outpass', '2023-07-23 14:51:06', 'akshaycoir'),
(8, '2023-07-24', 'NEW001', 'Akshay Coir', 'AKC1', 'KL 23 BC 2982', '', 'Not Generated', 'outpass', '2023-07-24 15:27:07', 'new'),
(9, '2023-07-26', 'AKC002', 'Company MAIN', 'cm', 'KL 33 BC 1920', '', 'Not Generated', 'outpass', '2023-07-25 18:54:57', 'akshaycoir');

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
  `invoice_no` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `timestamp` timestamp NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `outpass_old`
--

INSERT INTO `outpass_old` (`no`, `no_year`, `date`, `work_order_no`, `dest`, `woc`, `vehicleno`, `extras`, `invoice_no`, `type`, `timestamp`, `user_id`) VALUES
('1', '1/2324', '2023-07-23', 'AKC001', 'Company 1', 'C1', 'KL 33 BC 1920', '', 'Not Generated', 'outpass', '2023-07-23 14:32:48', 'akshaycoir'),
('2', '2/2324', '2023-07-23', 'AKC001', 'Company 1', 'C1', 'KL 33 BC 1921', '', 'Not Generated', 'outpass', '2023-07-23 14:33:24', 'akshaycoir'),
('3', '3/2324', '2023-07-23', 'AKC001', 'Company 1', 'C1', 'KL 33 BC 1921', '', 'Not Generated', 'outpass', '2023-07-23 14:34:23', 'akshaycoir'),
('4', '4/2324', '2023-07-23', 'AKC001', 'Company 1', 'C1', 'KL 33 BC 1921', '', 'Not Generated', 'outpass', '2023-07-23 14:50:34', 'akshaycoir'),
('6', '6/2324', '2023-07-23', 'AKC002', 'Company MAIN', 'cm', 'KL 33 BC 1921', '', 'Not Generated', 'outpass', '2023-07-23 14:50:49', 'akshaycoir'),
('7', '7/2324', '2023-07-23', 'AKC001', 'Company 1', 'C1', 'KL 05 B 2834', '', 'Not Generated', 'outpass', '2023-07-23 14:51:06', 'akshaycoir'),
('9', '9/2324', '2023-07-26', 'AKC002', 'Company MAIN', 'cm', 'KL 33 BC 1920', '', 'Not Generated', 'outpass', '2023-07-25 18:54:57', 'akshaycoir'),
('12', '12/2324', '2023-07-26', 'T00002', 'Company 1', 'C2', 'KL 33 BC 1920', '', 'Not Generated', 'outpass', '2023-07-25 19:42:20', 'test'),
('13', '13/2324', '2023-07-26', 'T00002', 'Company 1', 'C2', 'KL 23 BC 2982', '', 'Not Generated', 'outpass', '2023-07-25 19:42:39', 'test'),
('14', '14/2324', '2023-07-26', 'T00001', 'Company 1', 'C2', 'KL 33 BC 1920', '', 'Not Generated', 'outpass', '2023-07-25 19:43:07', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `outpass_products`
--

DROP TABLE IF EXISTS `outpass_products`;
CREATE TABLE IF NOT EXISTS `outpass_products` (
  `outpass_no` int NOT NULL,
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

--
-- Dumping data for table `outpass_products`
--

INSERT INTO `outpass_products` (`outpass_no`, `date_of_entry`, `product_type`, `product_name`, `work_order`, `product_code`, `product_design`, `product_size`, `product_qty`, `user_id`) VALUES
(1, '0000-00-00', 'Finished', 'Vinyl back 15mm Natural', 'AKC001', 'ACP051', 'Plain', '45 X 75 cm', 1, 'akshaycoir'),
(1, '0000-00-00', 'Finished', 'Vinyl back 15mm Natural', 'AKC001', 'ACP050', 'Plain', '40 X 120 cm', 1, 'akshaycoir'),
(2, '0000-00-00', 'Finished', 'Vinyl back 15mm Natural', 'AKC001', 'ACP051', 'Plain', '45 X 75 cm', 1, 'akshaycoir'),
(3, '0000-00-00', 'Finished', 'Vinyl back 15mm Natural', 'AKC001', 'ACP051', 'Plain', '45 X 75 cm', 1, 'akshaycoir'),
(4, '0000-00-00', 'Finished', 'Vinyl back 15mm Natural', 'AKC001', 'ACP051', 'Plain', '45 X 75 cm', 1, 'akshaycoir'),
(4, '0000-00-00', 'Finished', 'Vinyl back 15mm Natural', 'AKC001', 'ACP050', 'Plain', '40 X 120 cm', 1, 'akshaycoir'),
(6, '0000-00-00', 'Finished', 'Vinyl back 15mm Natural', 'AKC002', 'ACP051', 'Plain', '45 X 75 cm', 2, 'akshaycoir'),
(7, '0000-00-00', 'Finished', 'Vinyl back 15mm Natural', 'AKC001', 'ACP051', 'Plain', '45 X 75 cm', 2, 'akshaycoir'),
(7, '0000-00-00', 'Finished', 'Vinyl back 15mm Natural', 'AKC001', 'ACP050', 'Plain', '40 X 120 cm', 2, 'akshaycoir'),
(8, '0000-00-00', 'Finished', 'Vinyl back 15mm Natural', 'NEW001', 'NWP001', 'Plain', '45 X 75 cm', 10, 'new'),
(9, '2023-07-26', 'Finished', 'Vinyl back 15mm Natural', 'AKC002', 'ACP051', 'Plain', '45 X 75 cm', 1, 'akshaycoir');

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
('1', '1/001', '0000-00-00', 'Finished', 'Vinyl back 15mm Natural', 'AKC001', 'ACP051', 'Plain', '45 X 75 cm', '1', 'akshaycoir'),
('1', '1/001', '0000-00-00', 'Finished', 'Vinyl back 15mm Natural', 'AKC001', 'ACP050', 'Plain', '40 X 120 cm', '1', 'akshaycoir'),
('2', '2/001', '0000-00-00', 'Finished', 'Vinyl back 15mm Natural', 'AKC001', 'ACP051', 'Plain', '45 X 75 cm', '1', 'akshaycoir'),
('3', '3/001', '0000-00-00', 'Finished', 'Vinyl back 15mm Natural', 'AKC001', 'ACP051', 'Plain', '45 X 75 cm', '1', 'akshaycoir'),
('4', '4/001', '0000-00-00', 'Finished', 'Vinyl back 15mm Natural', 'AKC001', 'ACP051', 'Plain', '45 X 75 cm', '1', 'akshaycoir'),
('4', '4/001', '0000-00-00', 'Finished', 'Vinyl back 15mm Natural', 'AKC001', 'ACP050', 'Plain', '40 X 120 cm', '1', 'akshaycoir'),
('6', '6/001', '0000-00-00', 'Finished', 'Vinyl back 15mm Natural', 'AKC002', 'ACP051', 'Plain', '45 X 75 cm', '2', 'akshaycoir'),
('7', '7/001', '0000-00-00', 'Finished', 'Vinyl back 15mm Natural', 'AKC001', 'ACP051', 'Plain', '45 X 75 cm', '2', 'akshaycoir'),
('7', '7/001', '0000-00-00', 'Finished', 'Vinyl back 15mm Natural', 'AKC001', 'ACP050', 'Plain', '40 X 120 cm', '2', 'akshaycoir'),
('9', '9/2324', '2023-07-26', 'Finished', 'Vinyl back 15mm Natural', 'AKC002', 'ACP051', 'Plain', '45 X 75 cm', '1', 'akshaycoir'),
('12', '12/2324', '2023-07-26', 'Finished', 'Vinyl back 15mm natural', 'T00002', 'COD901', 'REACH', '40 X 120cm', '300', 'test'),
('13', '13/2324', '2023-07-26', 'Finished', 'Black Rubber 15mm', 'T00002', 'COD902', 'REACH', '40 X 120cm', '50', 'test'),
('14', '14/2324', '2023-07-26', 'Finished', 'Vinyl back 15mm natural', 'T00001', 'ACP050', 'Plain', '45 X 75 Cm', '100', 'test');

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
('Black Rubber 15mm', 'TUF059', 'plain', '45 X 75 cm', 'finished', 'test'),
('Vinyl Back 15mm Natural', 'ACP050', 'Plain', '40 X 120 cm', 'finished', 'test');

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
  `user_id` varchar(50) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`name`, `wo`, `gstin`, `phoneno`, `user_id`, `password`) VALUES
('Akshay Coir', 'akc', 'GSTIN0000001', '9000000001', 'akshaycoir', '$2y$10$qHN0ldGy/uQ3yG6MV7RSkuFXtM9W/WwltD1MPWVUS7ykkDgrYkTBC'),
('new', 'N1', 'GSTIN0000NEW', '9000000000', 'new', '$2y$10$2asapdd6H.cqrKTeBzQdne3Z5qxPBRm5OVbBtVb6/bGzdeoBuRXOm'),
('test', 't1', 'GSTIN2392039t', '9000000000', 'test', '$2y$10$KHhxqtgLG6q6YzH2IP9DNeCdcCKr1LUrYqJu6JPNoJszHnBDGWX9O');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`index`, `grade`, `code`, `item`, `design`, `size`, `qty`, `default`, `user_id`) VALUES
(1, '', 'NULL', 'Vinyl Back 15mm Natural', 'Plain', '40x120cm', 240, 1, 'akshaycoir'),
(2, '', 'NULL', 'Black Rubber 15mm', 'plain', '40x120cm', 425, 1, 'akshaycoir'),
(3, '', 'NULL', 'Vinyl back 15mm Natural', 'Border 4', '40x120cm', 90, 1, 'new'),
(4, '', 'NULL', 'test', 'test1', 'twa x tes', 530, 1, 'akshaycoir'),
(7, '', 'NULL', 'Vinyl Back 15mm Natural', 'Plain', '40 X 120 cm', 150, 1, 'test'),
(8, '', 'NULL', 'Black Rubber 15mm', 'plain', '45 X 75 cm', 950, 1, 'test');

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
('2023-07-23 20:21:06', 'Vinyl Back 15mm Natural', '40x120cm', 2, 16, 'Outpass', 'akshaycoir'),
('2023-07-23 20:39:19', 'Vinyl back 15mm Natural', '40x120cm', 100, 100, 'Inpass', 'new'),
('2023-07-24 20:57:07', 'Vinyl back 15mm Natural', '40x120cm', 10, 90, 'Outpass', 'new'),
('2023-07-25 19:32:46', 'Black Rubber 15mm', '40x120cm', 1, 25, 'Inpass', 'akshaycoir'),
('2023-07-26 00:02:07', 'Vinyl Back 15mm Natural', '40x120cm', 200, 216, 'Inpass', 'akshaycoir'),
('2023-07-26 00:02:07', 'Black Rubber 15mm', '40x120cm', 300, 325, 'Inpass', 'akshaycoir'),
('2023-07-26 00:02:22', 'Vinyl Back 15mm Natural', '40x120cm', 5, 221, 'Inpass', 'akshaycoir'),
('2023-07-26 00:02:44', 'test', 'twa x tes', 30, 30, 'Inpass', 'akshaycoir'),
('2023-07-26 00:04:50', 'test', 'twa x tes', 500, 530, 'Inpass', 'akshaycoir'),
('2023-07-26 00:05:04', 'Black Rubber 15mm', '40x120cm', 100, 425, 'Inpass', 'akshaycoir'),
('2023-07-26 00:05:04', 'Vinyl Back 15mm Natural', '40x120cm', 20, 241, 'Inpass', 'akshaycoir'),
('2023-07-26 00:24:57', 'Vinyl Back 15mm Natural', '40x120cm', 1, 240, 'Outpass', 'akshaycoir'),
('2023-07-26 01:11:13', 'Vinyl Back 15mm Natural', '40 X 120 cm', 500, 500, 'Inpass', 'test'),
('2023-07-26 01:11:27', 'Vinyl Back 15mm Natural', '40 X 120 cm', 50, 550, 'Inpass', 'test'),
('2023-07-26 01:11:36', 'Black Rubber 15mm', '45 X 75 cm', 1000, 1000, 'Inpass', 'test'),
('2023-07-26 01:12:20', 'Vinyl Back 15mm Natural', '40 X 120 cm', 300, 250, 'Outpass', 'test'),
('2023-07-26 01:12:39', 'Black Rubber 15mm', '45 X 75 cm', 50, 950, 'Outpass', 'test'),
('2023-07-26 01:13:08', 'Vinyl Back 15mm Natural', '40 X 120 cm', 100, 150, 'Outpass', 'test');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `work_orders`
--

INSERT INTO `work_orders` (`id`, `date`, `work_order_no`, `company`, `extras`, `status`, `timestamp`, `user_id`) VALUES
(1, '2023-07-23', 'AKC001', 'Company 1', '', 'Open', '2023-07-23 14:31:55', 'akshaycoir'),
(2, '2023-07-23', 'AKC002', 'Company MAIN', 'test', 'Open', '2023-07-23 14:36:55', 'akshaycoir'),
(3, '2023-07-24', 'NEW001', 'Akshay Coir', '', 'Open', '2023-07-24 15:26:53', 'new'),
(4, '2023-07-26', 'AKC003', 'Company MAIN', '', 'Open', '2023-07-25 19:18:37', 'akshaycoir');

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

--
-- Dumping data for table `work_orders_old`
--

INSERT INTO `work_orders_old` (`date`, `no_year`, `work_order_no`, `company`, `extras`, `status`, `timestamp`, `user_id`) VALUES
('2023-07-23', 'AKC001/2324', 'AKC001', 'Company 1', '', 'Open', '2023-07-23 14:31:55', 'akshaycoir'),
('2023-07-23', 'AKC002/2324', 'AKC002', 'Company MAIN', 'test', 'Open', '2023-07-23 14:36:55', 'akshaycoir'),
('2023-07-26', 'AKC003/2324', 'AKC003', 'Company MAIN', '', 'Open', '2023-07-25 19:18:37', 'akshaycoir'),
('2023-07-26', 'T00001/2324', 'T00001', 'Company 1', '', 'Closed', '2023-07-25 19:43:08', 'test'),
('2023-07-26', 'T00002/2324', 'T00002', 'Company 1', '', 'Open', '2023-07-25 19:42:09', 'test');

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
  `features` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `qty` int NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `work_order_products`
--

INSERT INTO `work_order_products` (`work_order_no`, `date_of_entry`, `code`, `name`, `design`, `size`, `features`, `qty`, `user_id`) VALUES
('NEW001', '0000-00-00', 'NWP001', 'Vinyl back 15mm Natural', 'Plain', '45 X 75 cm', '', 40, 'new'),
('AKC003', '2023-07-26', 'ACP050', 'Vinyl back 15mm Natural', 'Plain', '40 X 120 cm', '', 1, 'akshaycoir'),
('AKC001', '2023-07-23', 'ACP051', 'Vinyl back 15mm Natural', 'Plain', '45 X 75 cm', '', 97, 'akshaycoir'),
('AKC001', '2023-07-23', 'ACP050', 'Vinyl back 15mm Natural', 'Plain', '40 X 120 cm', '', 1, 'akshaycoir'),
('AKC002', '2023-07-23', 'ACP051', 'Vinyl back 15mm Natural', 'Plain', '45 X 75 cm', '', 97, 'akshaycoir');

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
  `features` varchar(50) NOT NULL,
  `qty` varchar(10) NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `work_order_products_old`
--

INSERT INTO `work_order_products_old` (`work_order_no`, `no_year`, `date_of_entry`, `code`, `name`, `design`, `size`, `features`, `qty`, `user_id`) VALUES
('AKC003', 'AKC003/2324', '2023-07-26', 'ACP050', 'Vinyl back 15mm Natural', 'Plain', '40 X 120 cm', '', '1', 'akshaycoir'),
('AKC001', 'AKC001/2324', '2023-07-23', 'ACP051', 'Vinyl back 15mm Natural', 'Plain', '45 X 75 cm', '', '97', 'akshaycoir'),
('AKC001', 'AKC001/2324', '2023-07-23', 'ACP050', 'Vinyl back 15mm Natural', 'Plain', '40 X 120 cm', '', '1', 'akshaycoir'),
('AKC002', 'AKC002/2324', '2023-07-23', 'ACP051', 'Vinyl back 15mm Natural', 'Plain', '45 X 75 cm', '', '97', 'akshaycoir'),
('T00001', 'T00001/2324', '2023-07-26', 'ACP050', 'Vinyl back 15mm natural', 'Plain', '45 X 75 Cm', '', '100', 'test'),
('T00002', 'T00002/2324', '2023-07-26', 'COD901', 'Vinyl back 15mm natural', 'REACH', '40 X 120cm', '', '300', 'test');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
