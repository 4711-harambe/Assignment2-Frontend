-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2016 at 08:52 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `backend`
--

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `description` varchar(256) NOT NULL,
  `sellingPrice` decimal(5,2) NOT NULL,
  `quantityOnHand` decimal(3,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `code`, `description`, `sellingPrice`, `quantityOnHand`) VALUES
(1, 'Breakfact', 'The most important meal of the day!', 6, 5),
(2, 'Lunch', 'Something to tide you over.', 9, 8),
(3, 'Dinner', 'The meat and potatoes of the day.', 35, 10),
(4, 'Poker Night', 'Just you and the fellas rippin it up!', 200, 6),
(5, 'Date Night', 'Netflix and chill?', 59.99, 3),
(6, 'House Cleaning', 'For that once ever couple of months occassion', 17, 3);

-- --------------------------------------------------------

--
-- Indexes for table `stock`
--

ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

DROP TABLE IF EXISTS `recipes`;
CREATE TABLE `recipes` (
`id` int (11) NOT NULL,
`code` varchar(32) NOT NULL,
`description` varchar(256) NOT NULL,
`ingredientsCode` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `code`, `description`, `ingredientsCode`) VALUES
(1, 'Breakfast', 'The most important meal of the day!', 1),
(2, 'Lunch', 'Something to tide you over.', 2),
(3, 'Dinner', 'The meat and potatoes of the day.',3),
(4, 'Poker Night', 'Just you and the fellas rippin it up!', 4),
(5, 'Date Night', 'Netflix and chill?', 5),
(6, 'House Cleaning', 'For that once ever couple of months occassion', 6);

-- ------------------------------------------------------

--
-- Indexes for table `stock`
--

ALTER TABLE `recipes`
    ADD PRIMARY KEY (`id`);

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

DROP TABLE IF EXISTS `ingredients`;
CREATE TABLE `ingredients` (
`id` int (11) NOT NULL,
`ingredientsCode` int(11) NOT NULL,
`ingredient` varchar(256) NOT NULL,
`amount` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipes`
--

INSERT INTO `ingredients` (`id`, `ingredientsCode`, `ingredient`, `amount`) VALUES
(1, 1, 'pizza slice', 2),
(2, 2, 'kraft Dinner', 1),
(3, 2, 'mountain Dew', 1),
(4, 3, 'steak', 1),
(5, 3, 'baked potato', 1),
(6, 3, 'asparagus spear', 4),
(7, 3, 'beer', 1),
(8, 4, 'deck of cards', 1),
(9, 4, 'poker chips', 1),
(10, 4, 'cigars', 5),
(11, 4, 'chips', 3),
(12, 4, 'beer', 24),
(13, 5, 'netflix subscription', 1),
(14, 5, 'candles', 4),
(15, 5, 'wine', 2),
(16, 5, 'condoms', 1),
(17, 6, 'febreeze', 1),
(18, 6, 'garbage bag', 3);

-- ------------------------------------------------------

--
-- Indexes for table `stock`
--

ALTER TABLE `ingredients`
    ADD PRIMARY KEY (`id`);
