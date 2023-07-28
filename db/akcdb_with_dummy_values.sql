-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 28, 2023 at 05:20 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `code`, `user_id`) VALUES
(1, 'Company 2', 'C2', 'akshaycoir'),
(2, 'Company 1', 'C1', 'akshaycoir'),
(3, 'Company 1', 'C2', 'new'),
(4, 'Company MAIN', 'C2', 'new');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(1, '', '2023-07-28', 'Company 1', 'C2', '878', 'KL 33 BC 1920', '', 'inpass', '2023-07-28 14:29:19', 'new'),
(2, '', '2023-07-28', 'Company 1', 'C2', '234', 'KL 33 BC 1921', '', 'inpass', '2023-07-28 14:30:19', 'new'),
(3, '', '2023-07-28', 'Company 1', 'C2', '878', 'KL 33 BC 1920', '', 'inpass', '2023-07-28 14:36:08', 'new'),
(4, '', '2023-07-28', 'Company 1', 'C2', '878', 'KL 33 BC 1920', '', 'inpass', '2023-07-28 16:06:19', 'new'),
(5, '', '2023-07-28', 'Company MAIN', 'C2', '123', 'KL 33 BC 1920', '', 'inpass', '2023-07-28 16:11:55', 'new'),
(6, '', '2023-07-28', 'Company 1', 'C2', '123', 'KL 33 BC 1920', '', 'inpass', '2023-07-28 16:13:10', 'new'),
(7, '', '2023-07-28', 'Company 1', 'C2', '878', 'KL 33 BC 1920', '', 'inpass', '2023-07-28 16:20:48', 'new'),
(8, '', '2023-07-28', 'Company MAIN', 'C2', '123', 'KL 33 BC 1920', '', 'inpass', '2023-07-28 16:21:14', 'new'),
(1, '', '2023-07-28', 'Company 2', 'C2', '123', 'KL 23 BC 2982', '', 'inpass', '2023-07-28 16:52:36', 'akshaycoir'),
(2, '', '2023-07-28', 'Company 2', 'C2', '123', 'KL 23 BC 2982', '', 'inpass', '2023-07-28 16:52:50', 'akshaycoir'),
(3, '', '2023-07-28', 'Company 2', 'C2', '123', 'KL 33 BC 1920', '', 'inpass', '2023-07-28 17:11:36', 'akshaycoir'),
(9, '', '2023-07-28', 'Company 1', 'C2', '878', 'KL 33 BC 1920', '', 'inpass', '2023-07-28 17:11:53', 'new'),
(4, '', '2023-07-28', 'Company 2', 'C2', '123', 'KL 33 BC 1920', '', 'inpass', '2023-07-28 17:18:01', 'akshaycoir');

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
('1', '1/2324', '2023-07-28', 'Company 2', 'C2', '878', 'KL 33 BC 1920', '', 'inpass', '2023-07-28 14:25:35', 'akshaycoir'),
('2', '2/2324', '2023-07-28', 'Company 1', 'C1', '123', 'KL 33 BC 1920', '', 'inpass', '2023-07-28 16:00:13', 'akshaycoir'),
('3', '3/2324', '2023-07-28', 'Company 2', 'C2', '878', 'KL 33 BC 1920', '', 'inpass', '2023-07-28 16:02:48', 'akshaycoir'),
('4', '4/2324', '2023-07-28', 'Company 2', 'C2', '878', 'KL 33 BC 1920', '', 'inpass', '2023-07-28 16:05:44', 'akshaycoir'),
('5', '5/2324', '2023-07-28', 'Company 1', 'C1', '878', 'KL 33 BC 1920', '', 'inpass', '2023-07-28 16:12:15', 'akshaycoir'),
('6', '6/2324', '2023-07-28', 'Company 2', 'C2', '123', 'KL 33 BC 1920', '', 'inpass', '2023-07-28 16:19:46', 'akshaycoir'),
('7', '7/2324', '2023-07-28', 'Company 2', 'C2', '878', 'KL 33 BC 1920', '', 'inpass', '2023-07-28 16:21:41', 'akshaycoir');

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
(1, '', '2023-07-28', 'black rubber 15mm', 'ACP050', 'plain', '45x75cm', 50, 'new'),
(2, '', '2023-07-28', 'black rubber 15mm', 'ACP050', 'plain', '45x75cm', 1, 'new'),
(3, '', '2023-07-28', 'a', 'TUF059', 'plain', '45x75cm', 700, 'new'),
(4, '', '2023-07-28', 'vinyl back 15mm natural', 'ACP051', 'plain', '45x75cm', 1000, 'new'),
(5, '', '2023-07-28', 'vinyl back 15mm natural', 'ACP051', 'plain', '45x75cm', 500, 'new'),
(6, '', '2023-07-28', 'vinyl back 15mm natural', 'ACP051', 'plain', '45x75cm', 200, 'new'),
(6, '', '2023-07-28', 'black rubber 15mm', 'ACP050', 'plain', '45x75cm', 100, 'new'),
(7, '', '2023-07-28', 'brown matte', 'TUF100', 'plain', '23x23cm', 500, 'new'),
(8, '', '2023-07-28', 'a', 'TUF059', 'plain', '45x75cm', 100, 'new'),
(1, '', '2023-07-28', 'a', 'ACP051', 'reach', '40x20cm', 100, 'akshaycoir'),
(2, '', '2023-07-28', 'black matte body', 'TUF100', 'plain', '45x75cm', 4000, 'akshaycoir'),
(3, '', '2023-07-28', 'vinyl back 15mm natural', 'TUF059', 'plain', '45x75cm', 100, 'akshaycoir'),
(9, '', '2023-07-28', 'brown matte', 'TUF100', 'plain', '23x23cm', 200, 'new'),
(4, '', '2023-07-28', 'vinyl back 15mm natural', 'TUF059', 'plain', '45x75cm', 500, 'akshaycoir');

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
('1', '1/2324', '2023-07-28', 'vinyl back 15mm natural', 'TUF059', 'plain', '45x75cm', '100', 'akshaycoir'),
('2', '2/2324', '2023-07-28', 'vinyl back 15mm natural', 'TUF059', 'plain', '45x75cm', '500', 'akshaycoir'),
('3', '3/2324', '2023-07-28', 'black rubber 15mm', 'ACP050', 'plain', '40x120cm', '50', 'akshaycoir'),
('4', '4/2324', '2023-07-28', 'a', 'ACP051', 'reach', '40x20cm', '100', 'akshaycoir'),
('5', '5/2324', '2023-07-28', 'a', 'ACP051', 'reach', '40x20cm', '200', 'akshaycoir'),
('6', '6/2324', '2023-07-28', 'black matte body', 'TUF100', 'plain', '45x75cm', '100', 'akshaycoir'),
('7', '7/2324', '2023-07-28', 'a', 'ACP051', 'reach', '40x20cm', '500', 'akshaycoir');

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
('N001', '2023-07-28', 'Company 1', 'GSTIN2392039', 'NEW003', 'Alapuzha', '', '974700000', '32', '', '18', '225.00', '20.25', '20.25', '0.50', '265.00', '', '2023-07-28 17:16:38', 'new'),
('N112', '2023-07-28', 'Company 3', 'GSTIN2392039', 'NEW112', '', '', '', '', '', '18', '10000.00', '900.00', '900.00', '0.00', '11800.00', '', '2023-07-28 17:17:26', 'new');

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
('N001', 'NEW003', 0, 'Vinyl Back 15mm Natural', 'Passing Final', '45x75cm', 'Inch', 100, 100, '100 Nos', 1.5, 18, 150, 'new'),
('N001', 'NEW003', 1, 'Vinyl Back 15mm Natural', 'Passing Final', '45x120cm', 'Inch', 50, 50, '50 Nos', 1.5, 18, 75, 'new'),
('N112', 'NEW112', 0, 'Product A', 'Passing Final', '40X75cm', 'INCH', 1000, 1000, '1000', 10, 18, 10000, 'new');

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

--
-- Dumping data for table `outpass`
--

INSERT INTO `outpass` (`no`, `no_year`, `date`, `work_order_no`, `dest`, `woc`, `vehicleno`, `extras`, `type`, `timestamp`, `user_id`) VALUES
(1, '', '2023-07-28', 'NEW001', 'Company 1', 'C2', 'KL 33 BC 1920', '', 'outpass', '2023-07-28 14:32:07', 'new'),
(2, '', '2023-07-28', 'NEW001', 'Company 1', 'C2', 'KL 33 BC 1920', '', 'outpass', '2023-07-28 14:33:12', 'new'),
(3, '', '2023-07-28', 'NEW001', 'Company 1', 'C2', 'KL 33 BC 1920', '', 'outpass', '2023-07-28 14:33:32', 'new'),
(1, '', '2023-07-28', 'AKC001', 'Company 1', 'C1', 'KL 33 BC 1920', '', 'outpass', '2023-07-28 16:53:20', 'akshaycoir'),
(2, '', '2023-07-28', 'AKC001', 'Company 1', 'C1', 'KL 23 BC 2982', '', 'outpass', '2023-07-28 16:53:29', 'akshaycoir'),
(4, '', '2023-07-28', 'NEW002', 'Company MAIN', 'C2', 'KL 33 BC 1923', '', 'outpass', '2023-07-28 17:13:01', 'new'),
(5, '', '2023-07-28', 'NEW002', 'Company MAIN', 'C2', 'KL 33 BC 1920', '', 'outpass', '2023-07-28 17:14:22', 'new'),
(6, '', '2023-07-28', 'NEW003', 'Company 1', 'C2', 'KL 23 BC 2982', '', 'outpass', '2023-07-28 17:15:45', 'new'),
(3, '', '2023-07-28', 'AKC001', 'Company 1', 'C1', 'KL 33 BC 1920', '', 'outpass', '2023-07-28 17:18:17', 'akshaycoir');

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
('1', '1/2324', '2023-07-28', 'AKC001', 'Company 1', 'C1', 'KL 23 BC 2982', '', 'outpass', '2023-07-28 14:26:10', 'akshaycoir');

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

--
-- Dumping data for table `outpass_products`
--

INSERT INTO `outpass_products` (`outpass_no`, `no_year`, `date_of_entry`, `product_type`, `product_name`, `work_order`, `product_code`, `product_design`, `product_size`, `product_qty`, `user_id`) VALUES
(1, '', '2023-07-28', 'Finished', 'vinyl back 15mm natural', 'NEW001', 'TUF059', 'plain', '17x17cm', 5, 'new'),
(2, '', '2023-07-28', 'Finished', 'black rubber 15mm', 'NEW001', 'ACP050', 'reach', '4575cm', 1, 'new'),
(3, '', '2023-07-28', 'Finished', 'vinyl back 15mm natural', 'NEW001', 'TUF059', 'plain', '17x17cm', 0, 'new'),
(1, '', '2023-07-28', 'Finished', 'vinyl back 15mm natural', 'AKC001', 'ACP050', 'test1', '40x120cm', 1, 'akshaycoir'),
(2, '', '2023-07-28', 'Finished', 'vinyl back 15mm natural', 'AKC001', 'ACP050', 'test1', '40x120cm', 2, 'akshaycoir'),
(4, '', '2023-07-28', 'Finished', 'vinyl back 15mm natural', 'NEW002', 'TUF001', 'border 4', '40x120cm', 200, 'new'),
(4, '', '2023-07-28', 'Finished', 'black rubber 20mm', 'NEW002', 'ACP050', 'test1', '40x120cm', 50, 'new'),
(4, '', '2023-07-28', 'Finished', 'vinyl back 15mm natural', 'NEW002', 'TUF001', 'border 4', '40x120cm', 200, 'new'),
(5, '', '2023-07-28', 'Finished', 'black rubber 20mm', 'NEW002', 'ACP050', 'test1', '40x120cm', 5, 'new'),
(6, '', '2023-07-28', 'Finished', 'vinyl back 15mm natural', 'NEW003', 'ACP050', 'plain', '45x75cm', 50, 'new'),
(6, '', '2023-07-28', 'Finished', 'vinyl back 15mm natural', 'NEW003', 'ACP051', 'reach', '45x120cm', 50, 'new'),
(3, '', '2023-07-28', 'Finished', 'vinyl back 15mm natural', 'AKC001', 'ACP050', 'test1', '40x120cm', 100, 'akshaycoir');

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
('1', '1/2324', '2023-07-28', 'Finished', 'vinyl back 15mm natural', 'AKC001', 'ACP050', 'plain', '40x120cm', '10', 'akshaycoir');

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
('vinyl back 15mm natural', 'TUF059', 'plain', '45x75cm', 'finished', 'akshaycoir'),
('black rubber 15mm', 'ACP050', 'plain', '40x120cm', 'finished', 'akshaycoir'),
('a', 'ACP051', 'reach', '40x20cm', 'finished', 'akshaycoir'),
('black matte body', 'TUF100', 'plain', '45x75cm', 'finished', 'akshaycoir');

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
('Akshay Coir', 'akc', 'GSTIN0000001', '9000000001', 5, 4, 'akshaycoir', '$2y$10$qHN0ldGy/uQ3yG6MV7RSkuFXtM9W/WwltD1MPWVUS7ykkDgrYkTBC'),
('New', 'AK123', 'GSTIN2392039', '9000000000', 10, 7, 'new', '$2y$10$dovaSN.Ey8WV7l0gT5Ew4.T0.nvv4PyA2/nCHT5p0.//T2i.owICW');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`index`, `item`, `design`, `size`, `qty`, `default`, `user_id`) VALUES
(1, 'vinyl back 15mm natural', 'plain', '45x75cm', 1087, 1, 'akshaycoir'),
(2, 'black rubber 15mm', 'plain', '45x75cm', 90, 1, 'new'),
(3, 'a', 'plain', '45x75cm', 800, 1, 'new'),
(4, 'black rubber 15mm', 'plain', '40x120cm', 50, 1, 'akshaycoir'),
(5, 'a', 'reach', '40x20cm', 900, 1, 'akshaycoir'),
(6, 'vinyl back 15mm natural', 'plain', '45x75cm', 1250, 1, 'new'),
(7, 'black matte body', 'plain', '45x75cm', 4100, 1, 'akshaycoir'),
(8, 'brown matte', 'plain', '23x23cm', 650, 1, 'new');

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
('2023-07-28 19:55:35', 'vinyl back 15mm natural', '45x75cm', 100, 100, 'Inpass', 'akshaycoir'),
('2023-07-28 19:56:10', 'vinyl back 15mm natural', '45x75cm', 10, 90, 'Outpass', 'akshaycoir'),
('2023-07-28 19:59:19', 'black rubber 15mm', '45x75cm', 50, 50, 'Inpass', 'new'),
('2023-07-28 20:00:19', 'black rubber 15mm', '45x75cm', 1, 51, 'Inpass', 'new'),
('2023-07-28 20:02:08', 'black rubber 15mm', '45x75cm', 5, 46, 'Outpass', 'new'),
('2023-07-28 20:03:12', 'black rubber 15mm', '45x75cm', 1, 45, 'Outpass', 'new'),
('2023-07-28 20:03:32', 'black rubber 15mm', '40x75cm', 0, 0, 'Outpass', 'new'),
('2023-07-28 20:06:08', 'a', '45x75cm', 700, 700, 'Inpass', 'new'),
('2023-07-28 21:30:13', 'vinyl back 15mm natural', '45x75cm', 500, 590, 'Inpass', 'akshaycoir'),
('2023-07-28 21:32:48', 'black rubber 15mm', '40x120cm', 50, 50, 'Inpass', 'akshaycoir'),
('2023-07-28 21:35:44', 'a', '40x20cm', 100, 100, 'Inpass', 'akshaycoir'),
('2023-07-28 21:36:20', 'vinyl back 15mm natural', '45x75cm', 1000, 1000, 'Inpass', 'new'),
('2023-07-28 21:41:55', 'vinyl back 15mm natural', '45x75cm', 500, 1500, 'Inpass', 'new'),
('2023-07-28 21:42:15', 'a', '40x20cm', 200, 300, 'Inpass', 'akshaycoir'),
('2023-07-28 21:43:10', 'vinyl back 15mm natural', '45x75cm', 200, 1700, 'Inpass', 'new'),
('2023-07-28 21:43:10', 'black rubber 15mm', '45x75cm', 100, 145, 'Inpass', 'new'),
('2023-07-28 21:49:46', 'black matte body', '45x75cm', 100, 100, 'Inpass', 'akshaycoir'),
('2023-07-28 21:50:48', 'brown matte', '23x23cm', 500, 500, 'Inpass', 'new'),
('2023-07-28 21:51:14', 'a', '45x75cm', 100, 800, 'Inpass', 'new'),
('2023-07-28 21:51:41', 'a', '40x20cm', 500, 800, 'Inpass', 'akshaycoir'),
('2023-07-28 22:22:37', 'a', '40x20cm', 100, 900, 'Inpass', 'akshaycoir'),
('2023-07-28 22:22:50', 'black matte body', '45x75cm', 4000, 4100, 'Inpass', 'akshaycoir'),
('2023-07-28 22:23:20', 'vinyl back 15mm natural', '45x75cm', 1, 589, 'Outpass', 'akshaycoir'),
('2023-07-28 22:23:29', 'vinyl back 15mm natural', '45x75cm', 2, 587, 'Outpass', 'akshaycoir'),
('2023-07-28 22:41:36', 'vinyl back 15mm natural', '45x75cm', 100, 687, 'Inpass', 'akshaycoir'),
('2023-07-28 22:41:53', 'brown matte', '23x23cm', 200, 700, 'Inpass', 'new'),
('2023-07-28 22:42:33', 'vinyl back 15mm natural', '45x75cm', 200, 1500, 'Outpass', 'new'),
('2023-07-28 22:43:01', 'black rubber 15mm', '45x75cm', 50, 95, 'Outpass', 'new'),
('2023-07-28 22:43:01', 'vinyl back 15mm natural', '45x75cm', 200, 1300, 'Outpass', 'new'),
('2023-07-28 22:44:22', 'black rubber 15mm', '45x75cm', 5, 90, 'Outpass', 'new'),
('2023-07-28 22:45:45', 'vinyl back 15mm natural', '45x75cm', 50, 1250, 'Outpass', 'new'),
('2023-07-28 22:45:45', 'brown matte', '23x23cm', 50, 650, 'Outpass', 'new'),
('2023-07-28 22:48:01', 'vinyl back 15mm natural', '45x75cm', 500, 1187, 'Inpass', 'akshaycoir'),
('2023-07-28 22:48:17', 'vinyl back 15mm natural', '45x75cm', 100, 1087, 'Outpass', 'akshaycoir');

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

--
-- Dumping data for table `work_orders`
--

INSERT INTO `work_orders` (`id`, `date`, `work_order_no`, `company`, `extras`, `status`, `timestamp`, `user_id`) VALUES
(2, '2023-07-28', 'NEW001', 'Company 1', '', 'Open', '2023-07-28 14:30:38', 'new'),
(3, '2023-07-28', 'AKC001', 'Company 1', '', 'Open', '2023-07-28 16:53:10', 'akshaycoir'),
(4, '2023-07-28', 'NEW002', 'Company MAIN', '', 'Open', '2023-07-28 17:12:19', 'new'),
(5, '2023-07-28', 'NEW003', 'Company 1', '', 'Open', '2023-07-28 17:15:13', 'new');

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
('2023-07-28', 'AKC001/2324', 'AKC001', 'Company 1', '', 'Open', '2023-07-28 14:25:55', 'akshaycoir');

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
  `org_qty` int NOT NULL,
  `qty` int NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `work_order_products`
--

INSERT INTO `work_order_products` (`work_order_no`, `date_of_entry`, `code`, `name`, `design`, `size`, `org_qty`, `qty`, `user_id`) VALUES
('NEW001', '2023-07-28', 'TUF059', 'vinyl back 15mm natural', 'plain', '17x17cm', 5, 0, 'new'),
('NEW001', '2023-07-28', 'ACP050', 'black rubber 15mm', 'reach', '4575cm', 188, 50, 'new'),
('AKC001', '2023-07-28', 'ACP050', 'vinyl back 15mm natural', 'test1', '40x120cm', 1200, 1097, 'akshaycoir'),
('NEW002', '2023-07-28', 'ACP050', 'black rubber 20mm', 'test1', '40x120cm', 100, 50, 'new'),
('NEW002', '2023-07-28', 'TUF001', 'vinyl back 15mm natural', 'border 4', '40x120cm', 200, 0, 'new'),
('NEW003', '2023-07-28', 'ACP050', 'vinyl back 15mm natural', 'plain', '45x75cm', 100, 50, 'new'),
('NEW003', '2023-07-28', 'ACP051', 'vinyl back 15mm natural', 'reach', '45x120cm', 50, 0, 'new');

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
  `org_qty` int NOT NULL,
  `qty` varchar(10) NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `work_order_products_old`
--

INSERT INTO `work_order_products_old` (`work_order_no`, `no_year`, `date_of_entry`, `code`, `name`, `design`, `size`, `org_qty`, `qty`, `user_id`) VALUES
('AKC001', 'AKC001/2324', '2023-07-28', 'ACP050', 'vinyl back 15mm natural', 'plain', '40x120cm', 0, '40', 'akshaycoir');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
