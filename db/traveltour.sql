-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 20, 2014 at 07:29 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `traveltour`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookingdetails`
--

CREATE TABLE IF NOT EXISTS `bookingdetails` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` varchar(15) NOT NULL,
  `package_id` varchar(15) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `no_of_people` int(3) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `bookingdetails`
--

INSERT INTO `bookingdetails` (`id`, `booking_id`, `package_id`, `duration`, `no_of_people`, `price`) VALUES
(1, '1139658107', 'PKG_000001', '2', 3, '5.00'),
(2, '1289810385', 'PKG_000001', '1', 2, '5.00'),
(3, '1275121773', 'PKG_000001', '1', 2, '5.00'),
(4, '1340636629', 'PKG_000001', '1', 2, '5.00'),
(5, '1113921106', 'PKG_000001', '1', 2, '5.00'),
(6, '1113921106', 'PKG_000002', '3', 3, '3.00'),
(7, '1366574345', 'PKG_000001', '1', 2, '5.00'),
(8, '1291598563', 'PKG_000001', '1', 2, '5.00'),
(9, '1406826614', 'PKG_000001', '1', 1, '5.00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `bookingdetails_view`
--
CREATE TABLE IF NOT EXISTS `bookingdetails_view` (
`id` int(11) unsigned
,`booking_id` varchar(15)
,`package_id` varchar(15)
,`duration` varchar(50)
,`no_of_people` int(3)
,`price` decimal(10,2)
,`title` varchar(50)
);
-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE IF NOT EXISTS `bookings` (
  `booking_id` varchar(15) NOT NULL,
  `booking_date` datetime NOT NULL,
  `customer_id` varchar(15) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`booking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `booking_date`, `customer_id`, `total`, `status`) VALUES
('1113921106', '2014-03-12 23:35:05', 'CUS000003', '8.00', 1),
('1139658107', '2014-03-06 18:56:04', 'CUS000002', '5.00', 1),
('1275121773', '2014-03-09 04:19:00', 'CUS000003', '5.00', 1),
('1289810385', '2014-03-09 04:18:46', 'CUS000003', '5.00', 1),
('1291598563', '2014-03-12 23:37:59', 'CUS000003', '5.00', 1),
('1340636629', '2014-03-12 23:31:48', 'CUS000003', '5.00', 1),
('1366574345', '2014-03-12 23:36:46', 'CUS000003', '5.00', 1),
('1406826614', '2014-03-12 23:38:07', 'CUS000003', '5.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` varchar(15) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `passport_no` varchar(30) NOT NULL,
  `country` varchar(50) NOT NULL,
  `postalcode` varchar(10) NOT NULL,
  `phone_no` varchar(30) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `firstname`, `lastname`, `passport_no`, `country`, `postalcode`, `phone_no`) VALUES
('CUS000002', 'a', 'a', 'a', 'a', 'a', 'a'),
('CUS000003', 'b', 'b', 'b', 'b', 'b', 'b');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE IF NOT EXISTS `hotels` (
  `hotel_id` varchar(15) NOT NULL,
  `hotel_name` varchar(50) NOT NULL,
  PRIMARY KEY (`hotel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`hotel_id`, `hotel_name`) VALUES
('HOT_000001', 'Sedona'),
('HOT_000002', 'Park Royal'),
('HOT_000003', 'Inya Lake');

-- --------------------------------------------------------

--
-- Table structure for table `packagetours`
--

CREATE TABLE IF NOT EXISTS `packagetours` (
  `package_id` varchar(15) NOT NULL,
  `title` varchar(50) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `packagetours`
--

INSERT INTO `packagetours` (`package_id`, `title`, `duration`, `price`) VALUES
('PKG_000001', 'abcde', '4', '5.00'),
('PKG_000002', 'test', '4', '3.00'),
('PKG_000003', 'wwwwwwwwwwww', '9', '23.00');

-- --------------------------------------------------------

--
-- Table structure for table `packagetour_hotel`
--

CREATE TABLE IF NOT EXISTS `packagetour_hotel` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hotel_id` varchar(15) NOT NULL,
  `packagetour_id` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `packagetour_hotel`
--

INSERT INTO `packagetour_hotel` (`id`, `hotel_id`, `packagetour_id`) VALUES
(29, 'HOT_000003', 'PKG_000002'),
(32, 'HOT_000003', 'PKG_000004'),
(33, 'HOT_000002', 'PKG_000004'),
(34, 'HOT_000001', 'PKG_000004'),
(36, 'HOT_000003', 'PKG_000003'),
(37, 'HOT_000001', 'PKG_000003'),
(38, 'HOT_000002', 'PKG_000001');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `payment_id` varchar(15) NOT NULL,
  `paymentdate` datetime NOT NULL,
  `booking_id` varchar(15) NOT NULL,
  `cardno` varchar(30) NOT NULL,
  `cardtype` varchar(10) NOT NULL,
  `cardholdername` varchar(30) NOT NULL,
  `securitycode` varchar(5) NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `paymentdate`, `booking_id`, `cardno`, `cardtype`, `cardholdername`, `securitycode`) VALUES
('1165285629', '2014-03-09 04:18:46', '1289810385', 'dsaf', 'mastercard', 'asf', 'asdf'),
('1218547811', '2014-03-09 04:19:00', '1275121773', 'dsaf', 'mastercard', 'asf', 'asdf'),
('1218848882', '2014-03-12 23:31:48', '1340636629', 'as', 'mastercard', 'asdf', 'asf'),
('1245297506', '2014-03-12 23:38:07', '1406826614', 'dsf', 'mastercard', 'sdaf', 'saf'),
('1288615224', '2014-03-06 18:56:04', '1139658107', 'a', 'mastercard', 'asda', 'asdf'),
('1299180077', '2014-03-12 23:37:59', '1291598563', 'adsf', 'mastercard', 'asdf', 'asdf'),
('1318466862', '2014-03-12 23:36:46', '1366574345', 'dsa', 'mastercard', 'sdaf', 'sdaf'),
('1326048375', '2014-03-12 23:35:05', '1113921106', 'asf', 'mastercard', 'sdfs', 'sadf');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` varchar(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(30) NOT NULL,
  `role` varchar(10) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `role`) VALUES
('CUS000001', 'admin', 'admin@gmail.com', 'admin', 'admin'),
('CUS000002', 'a', 'a@gmail.com', 'a', 'member'),
('CUS000003', 'b', 'b@gmail.com', 'b', 'member');

-- --------------------------------------------------------

--
-- Structure for view `bookingdetails_view`
--
DROP TABLE IF EXISTS `bookingdetails_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bookingdetails_view` AS select `bookingdetails`.`id` AS `id`,`bookingdetails`.`booking_id` AS `booking_id`,`bookingdetails`.`package_id` AS `package_id`,`bookingdetails`.`duration` AS `duration`,`bookingdetails`.`no_of_people` AS `no_of_people`,`bookingdetails`.`price` AS `price`,`packagetours`.`title` AS `title` from (`bookingdetails` join `packagetours` on((`bookingdetails`.`package_id` = `packagetours`.`package_id`))) order by `bookingdetails`.`id`;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
