-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 20, 2023 at 09:39 AM
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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `code`) VALUES
(1, 'Company 1', 'C1'),
(2, 'Company 2', 'C2'),
(3, 'Company 3', 'C3'),
(4, 'Company 4', 'C4'),
(5, 'Company 5', 'C5'),
(7, 'Company 6', 'C6');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  PRIMARY KEY (`no`)
) ENGINE=MyISAM AUTO_INCREMENT=1061 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inpass`
--

INSERT INTO `inpass` (`no`, `date`, `source`, `woc`, `op`, `vehicleno`, `extras`, `type`) VALUES
(900, '2023-06-18', 'Company 1', 'C1', 100, 'KL 23 BC 2982', '', 'inpass'),
(901, '2023-06-18', 'Company 1', 'C1', 101, 'KL 23 BC 2982', '', 'inpass'),
(902, '2023-06-20', 'Company 5', 'C5', 809, 'KL 23 BC 2982', '', 'inpass'),
(903, '2023-06-20', 'Company 2', 'C2', 809, 'KL 23 BC 2982', '', 'inpass'),
(904, '2023-06-20', 'Company 2', 'C2', 9000, 'KL 33 BC 1920', '', 'inpass');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inpass_products`
--

INSERT INTO `inpass_products` (`inpass_no`, `product_name`, `product_code`, `product_design`, `product_size`, `product_qty`) VALUES
(900, 'Vinyl back 15mm natural', 'TUF059', 'Plain', '45 X 75 Cm', 100),
(901, 'Vinyl back 15mm natural', 'TUF059', 'Plain', '45 X 75 Cm', 10),
(901, 'Vinyl back 15mm natural	', 'TUF060', 'Plain', '40 X 120cm', 400),
(902, 'Vinyl back 15mm natural', 'TUF059', 'Plain', '45 X 75 Cm', 500),
(903, 'Black Rubber 15mm', 'COD900', 'Plain', '40 X 120cm', 20),
(904, 'Vinyl back 15mm natural', 'TUF059', 'Plain', '45 X 75 Cm', 100);

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
  PRIMARY KEY (`no`)
) ENGINE=MyISAM AUTO_INCREMENT=9005 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `outpass`
--

INSERT INTO `outpass` (`no`, `date`, `work_order_no`, `dest`, `woc`, `vehicleno`, `extras`, `type`) VALUES
(9000, '2023-06-18', '', 'Company 3', 'C3', 'KL 33 BC 1920', '', 'outpass'),
(9001, '2023-06-20', 'AAC001', 'Company 2', 'C2', 'KL 33 BC 1920', '', 'outpass'),
(9003, '2023-06-20', 'AAC001', 'Company 2', 'C2', 'KL 33 BC 1920', '', 'outpass'),
(9004, '2023-06-20', 'AAC002', 'Company 4', 'C4', 'KL 33 BC 1920', '', 'outpass');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `outpass_products`
--

INSERT INTO `outpass_products` (`outpass_no`, `product_type`, `product_name`, `work_order`, `product_code`, `product_design`, `product_size`, `product_qty`) VALUES
(9000, 'Finished', 'Vinyl back 15mm natural', 'AAC001', '', 'REACH', '45 X 75 Cm', 10),
(9001, 'Finished', 'Vinyl Back 15mm Natural Hello', 'AAC001', 'ACP051', 'REACH', '18\" X 30\"', 50),
(9001, 'Finished', 'Vinyl Back 15mm Natural Welcome Border', 'AAC001', 'ACP050', 'REACH', '17.75\" X 38.75\"', 90),
(9003, 'Finished', 'Vinyl Back 15mm Natural Welcome Border', 'AAC001', 'ACP050', 'REACH', '17.75\" X 38.75\"', 100),
(9003, 'Finished', 'Vinyl Back 15mm Natural Hello', 'AAC001', 'ACP051', 'REACH', '18\" X 30\"', 40),
(9004, 'Finished', 'Vinyl Back 15mm Natural Welcome Border', 'AAC002', 'ACP050', 'REACH', '17.75\" X 38.75\"', 5);

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`name`, `code`, `design`, `size`, `type`) VALUES
('Vinyl back 15mm natural', 'TUF059', 'Plain', '45 X 75 Cm', 'finished'),
('Vinyl back 15mm natural	', 'TUF060', 'Plain', '40 X 120cm', 'finished'),
('Black Rubber 15mm', 'COD900', 'Plain', '40 X 120cm', 'finished');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `name` varchar(50) NOT NULL,
  `wo` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`index`, `grade`, `code`, `item`, `design`, `size`, `qty`, `default`) VALUES
(9, '', 'TUF059', 'Vinyl back 15mm natural', 'Plain', '45 X 75 Cm', 505, 1),
(11, '', 'TUF060', 'Vinyl back 15mm natural', 'Plain', '40 X 120cm', 40, 1),
(12, '', 'COD900', 'Black Rubber 15mm', 'Plain', '40 X 120cm', 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE IF NOT EXISTS `vehicles` (
  `type` varchar(50) NOT NULL,
  `number` varchar(50) NOT NULL,
  `owner` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `work_orders`
--

INSERT INTO `work_orders` (`id`, `date`, `work_order_no`, `company`, `extras`, `status`) VALUES
(6, '2023-06-20', 'AAC002', 'Company 4', '', 'Closed'),
(5, '2023-06-19', 'AAC001', 'Company 2', '', 'Open');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `work_order_products`
--

INSERT INTO `work_order_products` (`work_order_no`, `code`, `name`, `design`, `size`, `features`, `qty`) VALUES
('AAC001', 'ACP050', 'Vinyl Back 15mm Natural', 'REACH', '17.75\" X 38.75\"', 'Welcome Border', 100),
('AAC001', 'ACP051', 'Vinyl Back 15mm Natural', 'REACH', '18\" X 30\"', 'Hello', 50),
('AAC002', 'ACP050', 'Vinyl Back 15mm Natural', 'REACH', '17.75\" X 38.75\"', 'Welcome Border', 5);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
