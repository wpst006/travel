-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 04, 2014 at 07:22 PM
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
-- Table structure for table `bookings`
--

CREATE TABLE IF NOT EXISTS `bookings` (
  `booking_id` varchar(15) NOT NULL,
  `booking_date` datetime NOT NULL,
  `package_id` varchar(15) NOT NULL,
  `title` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `no_of_people` int(2) NOT NULL,
  `airline_no` varchar(50) NOT NULL,
  `route` varchar(50) NOT NULL,
  PRIMARY KEY (`booking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
('CUS000002', 'a', 'a', 'a', 'a', 'a', 'a');

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
('PKG_000001', 'abcde', '5', '5.00');

-- --------------------------------------------------------

--
-- Table structure for table `packagetour_hotel`
--

CREATE TABLE IF NOT EXISTS `packagetour_hotel` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hotel_id` varchar(15) NOT NULL,
  `packagetour_id` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `packagetour_hotel`
--

INSERT INTO `packagetour_hotel` (`id`, `hotel_id`, `packagetour_id`) VALUES
(14, 'HOT_000003', 'PKG_000001'),
(15, 'HOT_000002', 'PKG_000001');

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
('CUS000002', 'a', 'a@gmail.com', 'a', 'member');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
