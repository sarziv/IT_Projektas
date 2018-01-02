-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 02, 2018 at 09:51 PM
-- Server version: 5.5.57-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `IT_projektas`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_name` varchar(50) NOT NULL,
  `order_type_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tech_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_type_id` (`order_type_id`),
  KEY `user_id` (`user_id`),
  KEY `order_name` (`order_name`),
  KEY `tech_id` (`tech_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_name`, `order_type_id`, `user_id`, `tech_id`) VALUES
(1, 'uzsakymas1', 2, 3, 2),
(2, 'uzsakymas2', 2, 3, 2),
(3, 'uzsakymas11', 3, 3, 6),
(40, 'Uzsakymas8', 3, 3, 2),
(41, 'Uzsakymas9', 2, 5, 7),
(44, 'Uzsakymas100', 2, 3, 2),
(45, 'Uzsakymas5', 2, 3, 14),
(51, 'Uzsakymas98', 1, 5, 0),
(52, 'Uzsakymas98', 1, 5, 0),
(56, 'nr 155', 1, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_vykd`
--

CREATE TABLE IF NOT EXISTS `order_vykd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_type` (`order_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `order_vykd`
--

INSERT INTO `order_vykd` (`id`, `order_type`) VALUES
(3, 'Atliktas'),
(1, 'Nepajimtas'),
(2, 'Priskirtas');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_type_id` (`user_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `user_type_id`) VALUES
(1, 'admin1', 'admin1', 1),
(2, 'tech10', 'tech10', 2),
(3, 'klie1', 'klie1', 3),
(5, 'klie2', 'klie2', 3),
(6, 'tech2', 'tech2', 2),
(7, 'tech3', 'tech3', 2),
(13, 'klie', 'klie', 3),
(14, 'tech5', 'tech5', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `type`) VALUES
(1, 'Admin'),
(3, 'Klientas'),
(2, 'Technikas');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`order_type_id`) REFERENCES `order_vykd` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
