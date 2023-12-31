-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 15, 2023 at 04:17 PM
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
  `gstin` varchar(50) NOT NULL,
  `address` varchar(75) NOT NULL,
  `contact` varchar(25) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `code`, `gstin`, `address`, `contact`, `user_id`) VALUES
(1, 'Company 1', 'Kerala Timbers', '', '', '', 'akshaycoir'),
(10, 'Company test ', '', 'GST11111111111111111', 'Thumpoli, Alapuzha', '11111111111111111111', 'akshaycoir');

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
(1, '', '2023-09-07', 'Company 1', 'Kerala Timbers', '123', 'KL 33 BC 1920', '', 'inpass', '2023-09-07 15:24:47', 'akshaycoir'),
(2, '', '2023-09-07', 'Company 3', 'WGS', '891', 'KL 05 B 2833', '', 'inpass', '2023-09-07 15:25:07', 'akshaycoir');

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

-- --------------------------------------------------------

--
-- Table structure for table `inpass_products`
--

DROP TABLE IF EXISTS `inpass_products`;
CREATE TABLE IF NOT EXISTS `inpass_products` (
  `inpass_no` int NOT NULL,
  `no_year` varchar(15) NOT NULL,
  `date_of_entry` date NOT NULL,
  `product_wono` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
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

INSERT INTO `inpass_products` (`inpass_no`, `no_year`, `date_of_entry`, `product_wono`, `product_name`, `product_code`, `product_design`, `product_size`, `product_qty`, `user_id`) VALUES
(1, '', '2023-09-07', 'KTT001', 'vinyl back 15mm natural', 'ACP050', 'plain', '40x120cm', 100, 'akshaycoir'),
(1, '', '2023-09-07', 'KTT001', 'black rubber 20mm', 'TUF059', 'test1', '40x120cm', 200, 'akshaycoir'),
(2, '', '2023-09-07', 'AAC112', 'black rubber 20mm', 'TUF059', 'test1', '40x120cm', 1800, 'akshaycoir');

-- --------------------------------------------------------

--
-- Table structure for table `inpass_products_old`
--

DROP TABLE IF EXISTS `inpass_products_old`;
CREATE TABLE IF NOT EXISTS `inpass_products_old` (
  `inpass_no` varchar(10) NOT NULL,
  `no_year` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_of_entry` date NOT NULL,
  `product_wono` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_code` varchar(25) NOT NULL,
  `product_design` varchar(50) NOT NULL,
  `product_size` varchar(25) NOT NULL,
  `product_qty` varchar(15) NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
('A001', '2023-09-23', 'Company 1', 'GSTIN2392039', 'AKC001', 'Alapuzha', 'CASH', '974700000', '32', '', '18', '2775.00', '69.38', '69.38', '-0.24', '2914.00', 'Vehicle', '2023-09-23 15:35:03', 'akshaycoir'),
('A002', '2023-09-23', 'Company 1', 'GSTIN2392039', 'AKC002', 'Alapuzha', 'CASH', '974700000', '32', '', '18', '1446.39', '36.16', '36.16', '-0.29', '1519.00', 'Vehicle', '2023-09-23 15:36:24', 'akshaycoir'),
('A1', '2023-10-13', 'Company MAIN', 'GSTIN2039203902', 'AAC001', 'THUFOEJF', 'CASH', '209029302', '001', 'Goods', '18', '1388.00', '34.70', '34.70', '0.40', '1457.00', 'Vehicle', '2023-10-13 14:45:18', 'akshaycoir'),
('A2', '2023-10-13', 'Company MAIN', 'GSTIN2039203902', 'AAC001', 'THUFOEJF', 'CASH', '209029302', '001', 'Goods', '18', '1332.66', '33.32', '33.32', '0.30', '1399.00', 'Vehicle', '2023-10-13 14:45:37', 'akshaycoir'),
('A3', '2023-10-14', 'Company MAIN', 'GSTIN2039203902', 'AAC001', 'Alapuzha', 'CASH', '209029302', '32', 'Goods', '18', '11951.46', '298.79', '298.79', '0.04', '12549.00', 'Vehicle', '2023-10-14 09:17:20', 'akshaycoir'),
('A4', '2023-10-14', 'Compant test', 'GSTIN11111111111', 'AKCdel', 'Thumpoli, Alapuzha', 'CASH', '11111111111', '32', 'Goods', '18', '55154.00', '1378.85', '1378.85', '-0.30', '57912.00', 'Vehicle', '2023-10-14 09:27:15', 'akshaycoir'),
('A5', '2023-10-14', 'Company test', 'GST1111111111111', 'AAC001', '1111111111111111,111111', '', '111111111111', '32', '', '18', '10800.00', '270.00', '270.00', '0.00', '11340.00', '', '2023-10-14 09:29:49', 'akshaycoir'),
('A6', '2023-10-14', 'Company test ', 'GST11111111111111111', '11111111', 'Thumpoli, Alapuzha', '', '11111111111111111111', '32', '', '18', '69400.00', '1735.00', '1735.00', '0.00', '72870.00', '', '2023-10-14 09:31:22', 'akshaycoir'),
('A99', '2023-10-13', 'Company 1', 'a', 'AAC001', 'Alapuzha', 'CASH', '974700000', '32', 'Goods', '18', '1000.00', '25.00', '25.00', '0.00', '1050.00', 'Vehicle', '2023-10-13 14:44:00', 'akshaycoir');

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
  `size_d1` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `size_d2` varchar(25) NOT NULL,
  `size_unit` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nopcs` float NOT NULL,
  `initqty` float NOT NULL,
  `total_qty` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `total_unit` varchar(15) NOT NULL,
  `rate` float NOT NULL,
  `amount` float NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `invoice_data`
--

INSERT INTO `invoice_data` (`invoice_no`, `work_order_no`, `product_slno`, `product_name`, `type`, `size_d1`, `size_d2`, `size_unit`, `nopcs`, `initqty`, `total_qty`, `total_unit`, `rate`, `amount`, `user_id`) VALUES
('A001', 'AKC001', 0, 'PVC MAT', 'Passing Final', '18', '30', 'Inch', 1000, 3.75, '3750.000', 'Sqft', 0.23, 862.5, 'akshaycoir'),
('A001', 'AKC001', 0, 'PVC MAT', 'EMDILITH', '18', '30', 'Inch', 1000, 3.75, '3750.000', 'Sqft', 0.35, 1312.5, 'akshaycoir'),
('A001', 'AKC001', 0, 'PVC MAT', 'Landing and Loading', '18', '30', 'Inch', 1000, 3.75, '3750.000', 'Sqft', 0.16, 600, 'akshaycoir'),
('A002', 'AKC002', 0, 'Product A', 'Passing Final', '18', '30', 'Inch', 100, 3.75, '375.000', 'Sqft', 0.23, 86.25, 'akshaycoir'),
('A002', 'AKC002', 0, 'Product A', 'Packing', '18', '30', 'Inch', 100, 3.75, '375.000', 'Sqft', 0.43, 161.25, 'akshaycoir'),
('A002', 'AKC002', 1, 'Product B', 'Packing', '45', '75', 'Cm', 1000, 3.633, '3633.000', 'Sqft', 0.33, 1198.89, 'akshaycoir'),
('A99', 'AAC001', 0, 'A', 'Packing', '18', '40', 'Inch', 100, 5, '500.000', 'Sqft', 2, 1000, 'akshaycoir'),
('A1', 'AAC001', 0, 'Vinyl back 15mm Natural', 'Packing', '10', '10', 'inch', 100, 0.694, '69.400', 'Sqft', 20, 1388, 'akshaycoir'),
('A2', 'AAC001', 0, 'PVC MAT', '100', '101', '10', 'inch', 10, 7.014, '70.140', 'Sqft', 19, 1332.66, 'akshaycoir'),
('A3', 'AAC001', 0, 'A', 'Passing Final', '10', '10', 'inch', 100, 0.694, '69.400', 'Sqft', 2, 138.8, 'akshaycoir'),
('A3', 'AAC001', 0, 'A', 'Pass', '20', '20', 'inch', 100, 2.778, '277.800', 'Sqft', 1, 277.8, 'akshaycoir'),
('A3', 'AAC001', 1, 'B', '1', '1', '1', 'inch', 1, 0.007, '0.007', 'Sqft', 1, 0.01, 'akshaycoir'),
('A3', 'AAC001', 1, 'B', '2', '2', '2', 'cm', 2, 0.004, '0.008', 'Sqft', 2, 0.02, 'akshaycoir'),
('A3', 'AAC001', 2, 'C', 'c', '9', '9', 'inch', 90, 0.563, '50.670', 'Sqft', 9, 456.03, 'akshaycoir'),
('A3', 'AAC001', 2, 'C', 'd', '10', '12', 'inch', 100, 0.833, '83.300', 'Sqft', 10, 833, 'akshaycoir'),
('A3', 'AAC001', 3, 'D', 'D', '10', '10', 'inch', 100, 0.694, '69.400', 'Sqft', 100, 6940, 'akshaycoir'),
('A3', 'AAC001', 3, 'D', 'E', '20', '20', 'inch', 90, 2.778, '250.020', 'Sqft', 10, 2500.2, 'akshaycoir'),
('A3', 'AAC001', 3, 'D', 'F', '20', '29', 'inch', 20, 4.028, '80.560', 'Sqft', 10, 805.6, 'akshaycoir'),
('A4', 'AKCdel', 0, 'Product A', 'Passing Final', '19', '19', 'inch', 1000, 2.507, '2507.000', 'Sqft', 20, 50140, 'akshaycoir'),
('A4', 'AKCdel', 0, 'Product A', 'pass', '19', '19', 'inch', 200, 2.507, '501.400', 'Sqft', 10, 5014, 'akshaycoir'),
('A5', 'AAC001', 0, 'PVC MAT', 'd', '10', '10', 'cm', 10000, 0.108, '1080.000', 'Sqft', 10, 10800, 'akshaycoir'),
('A6', '11111111', 0, 'Vinyl back 15mm Natural', 'RWOJROW', '10', '10', 'inch', 10000, 0.694, '6940.000', 'Sqft', 10, 69400, 'akshaycoir');

-- --------------------------------------------------------

--
-- Table structure for table `outpass`
--

DROP TABLE IF EXISTS `outpass`;
CREATE TABLE IF NOT EXISTS `outpass` (
  `no` int NOT NULL,
  `no_year` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `woc` varchar(10) NOT NULL DEFAULT ' ',
  `work_order_no` varchar(25) NOT NULL,
  `dest` varchar(125) NOT NULL,
  `vehicleno` varchar(50) NOT NULL,
  `extras` varchar(125) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'outpass',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `outpass`
--

INSERT INTO `outpass` (`no`, `no_year`, `date`, `woc`, `work_order_no`, `dest`, `vehicleno`, `extras`, `type`, `timestamp`, `user_id`) VALUES
(3, '', '2023-09-07', ' ', 'AAC004', 'Company 1', 'KL 33 BC 1923', '', 'outpass', '2023-09-07 15:32:46', 'akshaycoir');

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
  `product_bundle` int NOT NULL,
  `product_qty` int NOT NULL,
  `stock_acof` varchar(15) NOT NULL,
  `stock_name` varchar(50) NOT NULL,
  `stock_size` varchar(30) NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `outpass_products`
--

INSERT INTO `outpass_products` (`outpass_no`, `no_year`, `date_of_entry`, `product_type`, `product_name`, `work_order`, `product_code`, `product_design`, `product_size`, `product_bundle`, `product_qty`, `stock_acof`, `stock_name`, `stock_size`, `user_id`) VALUES
(3, '', '2023-09-07', 'Finished', 'vinyl back 15mm natural', 'AAC004', 'ACP050', 'plain', '40x120cm', 10, 10, 'Kerala Timbers', 'vinyl back 15mm natural', '40x120cm', 'akshaycoir');

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
  `product_bundle` int NOT NULL,
  `product_qty` varchar(15) NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
('vinyl back 15mm natural', 'ACP050', 'plain', '40x120cm', 'finished', 'akshaycoir'),
('black rubber 20mm', 'TUF059', 'test1', '40x120cm', 'finished', 'akshaycoir');

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
  `address` varchar(50) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `acc_no` varchar(50) NOT NULL,
  `ifsc` varchar(50) NOT NULL,
  `invoice_count` int NOT NULL DEFAULT '1',
  `inpass_count` int NOT NULL DEFAULT '1',
  `outpass_count` int NOT NULL DEFAULT '1',
  `user_id` varchar(50) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`name`, `wo`, `gstin`, `phoneno`, `address`, `bank_name`, `acc_no`, `ifsc`, `invoice_count`, `inpass_count`, `outpass_count`, `user_id`, `password`) VALUES
('Akshay Coir', 'AK123', 'GSTIN2392039', '9000000001', 'Thumpoli Alapuzha', 'South Indian Bank', '0000000000000001', 'ISV0000005', 7, 3, 4, 'akshaycoir', '$2y$10$LlSL8rcKoqbX/QqKZWAWyO15bY8az.XhMLsBnv3GFESCbkDOBJdWW');

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
  `acof` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `default` int NOT NULL DEFAULT '1',
  `user_id` varchar(50) NOT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`index`, `item`, `design`, `size`, `qty`, `acof`, `default`, `user_id`) VALUES
(1, 'vinyl back 15mm natural', 'plain', '40x120cm', 90, 'Kerala Timbers', 1, 'akshaycoir'),
(2, 'black rubber 20mm', 'test1', '40x120cm', 200, 'Kerala Timbers', 1, 'akshaycoir'),
(3, 'black rubber 20mm', 'test1', '40x120cm', 1720, 'WGS', 1, 'akshaycoir');

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
  `acof` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `type` varchar(15) NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stock_data`
--

INSERT INTO `stock_data` (`timestamp`, `product_name`, `product_size`, `product_qty`, `total_qty`, `acof`, `type`, `user_id`) VALUES
('2023-09-07 20:54:47', 'vinyl back 15mm natural', '40x120cm', 100, 100, 'Kerala Timbers', 'Inpass', 'akshaycoir'),
('2023-09-07 20:54:47', 'black rubber 20mm', '40x120cm', 200, 200, 'Kerala Timbers', 'Inpass', 'akshaycoir'),
('2023-09-07 20:55:07', 'black rubber 20mm', '40x120cm', 200, 200, 'WGS', 'Inpass', 'akshaycoir'),
('2023-09-07 20:55:25', 'black rubber 20mm', '40x120cm', -20, 180, 'WGS', 'Manual', 'akshaycoir'),
('2023-09-07 20:56:06', 'vinyl back 15mm natural', '40x120cm', 100, 0, 'Kerala Timbers', 'Outpass', 'akshaycoir'),
('2023-09-07 20:57:19', 'black rubber 20mm', '40x120cm', 10, 170, 'WGS', 'Outpass', 'akshaycoir'),
('2023-09-07 20:57:19', 'black rubber 20mm', '40x120cm', 10, 190, 'Kerala Timbers', 'Outpass', 'akshaycoir'),
('2023-09-07 20:58:06', 'black rubber 20mm', '40x120cm', -10, 160, 'WGS', 'Manual', 'akshaycoir'),
('2023-09-07 20:58:22', 'vinyl back 15mm natural', '40x120cm', 0, 100, 'Kerala Timbers', 'Manual', 'akshaycoir'),
('2023-09-07 21:02:46', 'vinyl back 15mm natural', '40x120cm', 10, 90, 'Kerala Timbers', 'Outpass', 'akshaycoir'),
('2023-09-07 21:14:03', 'vinyl back 15mm natural', '40x120cm', -90, 0, 'Kerala Timbers', 'Manual', 'akshaycoir'),
('2023-09-07 21:14:20', 'vinyl back 15mm natural', '40x120cm', 90, 90, 'Kerala Timbers', 'Manual', 'akshaycoir'),
('2023-09-07 21:35:05', 'black rubber 20mm', '40x120cm', 1620, 1780, 'WGS', 'Manual', 'akshaycoir'),
('2023-09-07 21:35:25', 'black rubber 20mm', '40x120cm', 1700, 1700, 'WGS', 'Manual', 'akshaycoir'),
('2023-09-07 22:05:30', 'black rubber 20mm', '40x120cm', 0, 1720, 'WGS', 'Manual', 'akshaycoir'),
('2023-09-07 22:05:30', 'black rubber 20mm', '40x120cm', 0, 200, 'Kerala Timbers', 'Manual', 'akshaycoir');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `work_orders`
--

INSERT INTO `work_orders` (`id`, `date`, `work_order_no`, `company`, `extras`, `status`, `timestamp`, `user_id`) VALUES
(1, '2023-09-07', 'AAC001', 'Company 1', '', 'Closed', '2023-09-07 15:26:06', 'akshaycoir'),
(2, '2023-09-07', 'AAC004', 'Company 1', '', 'Closed', '2023-09-07 15:32:46', 'akshaycoir');

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
  `org_qty` int NOT NULL,
  `qty` int NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `work_order_products`
--

INSERT INTO `work_order_products` (`work_order_no`, `date_of_entry`, `code`, `name`, `design`, `size`, `org_qty`, `qty`, `user_id`) VALUES
('AAC001', '2023-09-07', 'ACP050', 'vinyl back 15mm natural', 'plain', '40x120cm', 100, 100, 'akshaycoir'),
('AAC004', '2023-09-07', 'ACP050', 'vinyl back 15mm natural', 'plain', '40x120cm', 10, 10, 'akshaycoir');

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
