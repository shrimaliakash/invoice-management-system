-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 24, 2021 at 07:36 PM
-- Server version: 5.7.26-log
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invoice`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(15) NOT NULL,
  `admin_image` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `email`, `password`, `admin_image`) VALUES
(1, 'Akash Shrimali', 'akashshrimali1995@gmail.com', 'Admin@123', '4122.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(5) NOT NULL AUTO_INCREMENT,
  `category` varchar(40) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category`) VALUES
(1, 'Shampoo'),
(2, 'Biscuit'),
(3, 'Hair Oil');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `city_id` int(5) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(40) NOT NULL,
  `country_id` int(5) NOT NULL,
  `state_id` int(5) NOT NULL,
  PRIMARY KEY (`city_id`),
  KEY `fk_country` (`country_id`),
  KEY `fk_state` (`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`, `country_id`, `state_id`) VALUES
(1, 'ahmedabad', 1, 1),
(2, 'surat', 1, 1),
(3, 'mumbai', 1, 2),
(4, 'nashik', 1, 2),
(5, 'royston', 2, 4),
(6, 'bedford', 2, 4),
(7, 'litherland', 2, 5),
(8, 'st helens', 2, 5),
(9, 'valsad', 1, 1),
(10, 'SHIRDI', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `country_id` int(5) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(40) NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`) VALUES
(1, 'India'),
(2, 'United States'),
(17, 'xxxxc');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(5) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(60) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_person` varchar(60) NOT NULL,
  `contact_no` bigint(10) NOT NULL,
  `city` varchar(40) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `phone`, `email`, `address`, `contact_person`, `contact_no`, `city`, `status`) VALUES
(8, 'akash', 9173137625, 'akash@gmail.com', 'gulbai tekra', 'akash shrimali', 7600992758, '3', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_id` int(5) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `from_date` date NOT NULL,
  `expire_date` date NOT NULL,
  `customer_id` int(5) NOT NULL,
  `customer_name` varchar(60) NOT NULL,
  `number` bigint(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `gross_amount` double NOT NULL,
  `discount` double NOT NULL,
  `tax` double NOT NULL,
  `additional_tax` double NOT NULL,
  `total_amount` double NOT NULL,
  `notes` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `date`, `from_date`, `expire_date`, `customer_id`, `customer_name`, `number`, `address`, `gross_amount`, `discount`, `tax`, `additional_tax`, `total_amount`, `notes`) VALUES
(2, '2017-01-05', '2016-12-20', '2016-12-28', 8, 'akash', 9173137625, 'gulbai tekra', 8600, 5, 15, 20, 11180, 'nice and good'),
(12, '2017-03-15', '2017-03-06', '2017-02-27', 8, 'akash', 9173137625, 'gulbai tekra', 4250, 5, 15, 4, 4845, 'nice and good'),
(16, '2017-04-10', '2017-04-02', '2017-03-21', 8, 'akash', 9173137625, 'gulbai tekra', 6600, 5, 10, 15, 7920, 'nice and good');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

DROP TABLE IF EXISTS `invoice_details`;
CREATE TABLE IF NOT EXISTS `invoice_details` (
  `invoice_detail_id` int(5) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(5) NOT NULL,
  `product_code` int(5) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(5) NOT NULL,
  `total` double NOT NULL,
  PRIMARY KEY (`invoice_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`invoice_detail_id`, `invoice_id`, `product_code`, `price`, `quantity`, `total`) VALUES
(4, 2, 6, 800, 5, 4000),
(5, 2, 4, 400, 4, 1600),
(6, 2, 13, 1000, 3, 3000),
(34, 12, 9, 800, 2, 1600),
(35, 12, 4, 400, 4, 1600),
(36, 12, 14, 350, 3, 1050),
(46, 16, 4, 400, 3, 1200),
(47, 16, 9, 800, 5, 4000),
(48, 16, 14, 350, 4, 1400);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `category_id` int(5) NOT NULL,
  `subcategory_id` int(5) NOT NULL,
  `product_code` int(5) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(40) NOT NULL,
  `purchase_amount` double NOT NULL,
  `tax` double NOT NULL,
  `additional_tax` double NOT NULL,
  `discount` double NOT NULL,
  `gross_amount` double NOT NULL,
  `sales_amount` double NOT NULL,
  PRIMARY KEY (`product_code`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`category_id`, `subcategory_id`, `product_code`, `product_name`, `purchase_amount`, `tax`, `additional_tax`, `discount`, `gross_amount`, `sales_amount`) VALUES
(1, 1, 2, 'Dove2', 200, 5, 10, 10, 210, 300),
(1, 2, 3, 'sunslik advanced', 200, 10, 5, 5, 220, 300),
(1, 3, 4, 'Advanced Hair and Solder', 300, 10, 5, 5, 330, 400),
(1, 4, 5, 'advanced lakme', 500, 5, 6, 4, 535, 650),
(2, 5, 6, 'Parle G  Gold', 600, 4, 5, 6, 618, 800),
(2, 6, 7, 'Have Good Day', 600, 4, 2, 5, 606, 800),
(2, 7, 8, 'Parle Orio', 900, 15, 5, 5, 1035, 1200),
(2, 8, 9, 'Hide nd sick gold', 500, 10, 20, 5, 625, 800),
(2, 9, 10, 'advanced Dark Fantas', 700, 25, 35, 10, 1050, 1200),
(3, 10, 11, 'Bajaj Hair Oil', 500, 15, 20, 6, 645, 800),
(3, 11, 12, 'Bajaj Amla', 600, 15, 20, 10, 750, 850),
(3, 12, 13, 'Hair and solider', 620, 20, 25, 15, 806, 1000),
(3, 13, 14, 'perasuit hair', 200, 10, 20, 5, 250, 350),
(1, 3, 15, 'Hari and Solder plus', 500, 10, 15, 5, 600, 700);

-- --------------------------------------------------------

--
-- Table structure for table `quotation`
--

DROP TABLE IF EXISTS `quotation`;
CREATE TABLE IF NOT EXISTS `quotation` (
  `quotation_id` int(5) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `from_date` date NOT NULL,
  `expire_date` date NOT NULL,
  `customer_id` int(5) NOT NULL,
  `customer_name` varchar(60) NOT NULL,
  `number` bigint(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `gross_amount` double NOT NULL,
  `discount` double NOT NULL,
  `tax` double NOT NULL,
  `additional_tax` double NOT NULL,
  `total_amount` double NOT NULL,
  `notes` varchar(50) NOT NULL,
  PRIMARY KEY (`quotation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation`
--

INSERT INTO `quotation` (`quotation_id`, `date`, `from_date`, `expire_date`, `customer_id`, `customer_name`, `number`, `address`, `gross_amount`, `discount`, `tax`, `additional_tax`, `total_amount`, `notes`) VALUES
(11, '2021-05-25', '2021-05-04', '2021-05-20', 8, 'akash', 9173137625, 'gulbai tekra', 800, 5, 10, 10, 920, ''),
(14, '2021-05-25', '2021-05-19', '2021-05-26', 8, 'akash', 9173137625, 'gulbai tekra', 800, 0, 0, 0, 800, '');

-- --------------------------------------------------------

--
-- Table structure for table `quotation_details`
--

DROP TABLE IF EXISTS `quotation_details`;
CREATE TABLE IF NOT EXISTS `quotation_details` (
  `quotation_detail_id` int(5) NOT NULL AUTO_INCREMENT,
  `quotation_id` int(5) NOT NULL,
  `product_code` int(5) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(5) NOT NULL,
  `total` double NOT NULL,
  PRIMARY KEY (`quotation_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation_details`
--

INSERT INTO `quotation_details` (`quotation_detail_id`, `quotation_id`, `product_code`, `price`, `quantity`, `total`) VALUES
(142, 11, 7, 800, 1, 800),
(149, 14, 9, 800, 1, 800);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE IF NOT EXISTS `state` (
  `state_id` int(5) NOT NULL AUTO_INCREMENT,
  `state_name` varchar(40) NOT NULL,
  `country_id` int(5) NOT NULL,
  PRIMARY KEY (`state_id`),
  KEY `fk_coun` (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `state_name`, `country_id`) VALUES
(1, 'gujarat', 1),
(2, 'maharastra', 1),
(4, 'alabama', 2),
(5, 'alaska', 2),
(8, 'sfsdsd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

DROP TABLE IF EXISTS `subcategory`;
CREATE TABLE IF NOT EXISTS `subcategory` (
  `subcategory_id` int(5) NOT NULL AUTO_INCREMENT,
  `subcategory` varchar(40) NOT NULL,
  `category_id` int(5) NOT NULL,
  PRIMARY KEY (`subcategory_id`),
  KEY `FK_subcategory` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`subcategory_id`, `subcategory`, `category_id`) VALUES
(1, 'Dove', 1),
(2, 'Sunsilk', 1),
(3, 'Hair and Solder', 1),
(4, 'lakme', 1),
(5, 'Parle G', 2),
(6, 'Good Day', 2),
(7, 'Orio', 2),
(8, 'Hide nd sick', 2),
(9, 'Dark Fantastic', 2),
(10, 'Bajaj', 3),
(11, 'Amla', 3),
(12, 'Hair and Care', 3),
(13, 'Perasuit', 3);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

DROP TABLE IF EXISTS `vendor`;
CREATE TABLE IF NOT EXISTS `vendor` (
  `vendor_id` int(5) NOT NULL AUTO_INCREMENT,
  `vendor_name` varchar(60) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `vat_no` varchar(30) NOT NULL,
  `tin_no` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_person` varchar(60) NOT NULL,
  `contact_no` bigint(10) NOT NULL,
  `city` varchar(40) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`vendor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `vendor_name`, `phone`, `email`, `vat_no`, `tin_no`, `address`, `contact_person`, `contact_no`, `city`, `status`) VALUES
(4, 'Akash', 9173137625, 'akash@gmail.com', 'sdvhsdag163ghg', 'r6vgvhvth65', 'silaj', 'Akash shrimali', 7600992758, '3', 'Active');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `city_ibfk_2` FOREIGN KEY (`state_id`) REFERENCES `state` (`state_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `state`
--
ALTER TABLE `state`
  ADD CONSTRAINT `state_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`) ON UPDATE CASCADE;

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `FK_subcategory` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
