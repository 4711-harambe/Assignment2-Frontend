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
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('eedff4638c477908c70cd23c4425e3d4497bfc0a', '127.0.0.1', 1479497146, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393439363835313b75736572726f6c657c733a353a2261646d696e223b6b65797c733a313a2231223b7265636f72647c4f3a383a22737464436c617373223a363a7b733a323a226964223b733a313a2231223b733a343a226e616d65223b733a363a22436865657365223b733a31313a226465736372697074696f6e223b733a39383a224c65617665207468697320726177206d696c6b2c20626565667920616e6420737765657420636865657365206f757420666f7220616e20686f7572206265666f72652073657276696e6720616e64207061697220776974682070656172206a616d2e223b733a353a227072696365223b733a343a22322e3935223b733a373a2270696374757265223b733a353a22312e706e67223b733a383a2263617465676f7279223b733a313a2273223b7d6f726465727c613a333a7b733a363a226e756d626572223b693a303b733a383a226461746574696d65223b4e3b733a353a226974656d73223b613a333a7b693a323b693a363b693a383b693a323b693a313b693a343b7d7d),
('3d3953cd0339fe53f8b0371d74117d2cb34841ce', '127.0.0.1', 1479497467, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393439373138393b75736572726f6c657c733a353a2261646d696e223b6b65797c733a313a2231223b7265636f72647c4f3a383a22737464436c617373223a363a7b733a323a226964223b733a313a2231223b733a343a226e616d65223b733a363a22436865657365223b733a31313a226465736372697074696f6e223b733a39383a224c65617665207468697320726177206d696c6b2c20626565667920616e6420737765657420636865657365206f757420666f7220616e20686f7572206265666f72652073657276696e6720616e64207061697220776974682070656172206a616d2e223b733a353a227072696365223b733a343a22322e3935223b733a373a2270696374757265223b733a353a22312e706e67223b733a383a2263617465676f7279223b733a313a2273223b7d6f726465727c613a333a7b733a363a226e756d626572223b693a303b733a383a226461746574696d65223b4e3b733a353a226974656d73223b613a333a7b693a31303b693a313b693a313b693a313b693a323b693a313b7d7d),
('2eda189bf60c2d21121833699a0062df92930e26', '127.0.0.1', 1479497832, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393439373537353b75736572726f6c657c733a353a2261646d696e223b6b65797c733a313a2231223b7265636f72647c4f3a383a22737464436c617373223a363a7b733a323a226964223b733a313a2231223b733a343a226e616d65223b733a363a22436865657365223b733a31313a226465736372697074696f6e223b733a39383a224c65617665207468697320726177206d696c6b2c20626565667920616e6420737765657420636865657365206f757420666f7220616e20686f7572206265666f72652073657276696e6720616e64207061697220776974682070656172206a616d2e223b733a353a227072696365223b733a343a22322e3935223b733a373a2270696374757265223b733a353a22312e706e67223b733a383a2263617465676f7279223b733a313a2273223b7d),
('9195152c902dee9717dee3c20be7a981a944f9f1', '127.0.0.1', 1479497964, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393439373931383b75736572726f6c657c733a353a2261646d696e223b6b65797c733a313a2231223b7265636f72647c4f3a383a22737464436c617373223a363a7b733a323a226964223b733a313a2231223b733a343a226e616d65223b733a363a22436865657365223b733a31313a226465736372697074696f6e223b733a39383a224c65617665207468697320726177206d696c6b2c20626565667920616e6420737765657420636865657365206f757420666f7220616e20686f7572206265666f72652073657276696e6720616e64207061697220776974682070656172206a616d2e223b733a353a227072696365223b733a343a22322e3935223b733a373a2270696374757265223b733a353a22312e706e67223b733a383a2263617465676f7279223b733a313a2273223b7d),
('5cfad1bb303b132bc5050632849c26303b210c6f', '127.0.0.1', 1480100558, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438303130303535383b),
('48aef2305f2227934e87a68e8795a2f9b7123156', '127.0.0.1', 1480100634, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438303130303632383b);

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `StockModel`;
CREATE TABLE `StockModel` (
  `id` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `description` varchar(256) NOT NULL,
  `sellingPrice` decimal(5,2) NOT NULL,
  `quantityOnHand` decimal(3,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock`
--

INSERT INTO `StockModel` (`id`, `code`, `description`, `sellingPrice`, `quantityOnHand`) VALUES
(1, 'Breakfast', 'The most important meal of the day!', 6, 5),
(2, 'Lunch', 'Something to tide you over.', 9, 8),
(3, 'Dinner', 'The meat and potatoes of the day.', 35, 10),
(4, 'Poker Night', 'Just you and the fellas rippin it up!', 200, 6),
(5, 'Date Night', 'Netflix and chill?', 59.99, 3),
(6, 'House Cleaning', 'For that once ever couple of months occassion', 17, 3);

-- --------------------------------------------------------

--
-- Indexes for table `stock`
--

ALTER TABLE `StockModel`
  ADD PRIMARY KEY (`id`);

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

DROP TABLE IF EXISTS `RecipesModel`;
CREATE TABLE `RecipesModel` (
`id` int (11) NOT NULL,
`code` varchar(32) NOT NULL,
`description` varchar(256) NOT NULL,
`ingredientsCode` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipes`
--

INSERT INTO `RecipesModel` (`id`, `code`, `description`, `ingredientsCode`) VALUES
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

ALTER TABLE `RecipesModel`
    ADD PRIMARY KEY (`id`);

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

DROP TABLE IF EXISTS `Ingredients`;
CREATE TABLE `ingredients` (
`id` int (11) NOT NULL,
`ingredientsCode` int(11) NOT NULL,
`ingredient` varchar(256) NOT NULL,
`amount` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipes`
--

INSERT INTO `Ingredients` (`id`, `ingredientsCode`, `ingredient`, `amount`) VALUES
(1, 1, 'Pizza Slice', 2),
(2, 2, 'Kraft Dinner', 1),
(3, 2, 'Mountain Dew', 1),
(4, 3, 'Steak', 1),
(5, 3, 'Baked Potato', 1),
(6, 3, 'Asparagus Spear', 4),
(7, 3, 'Beer', 1),
(8, 4, 'Deck of Cards', 1),
(9, 4, 'Poker Chips', 1),
(10, 4, 'Cigars', 5),
(11, 4, 'Chips', 3),
(12, 4, 'Beer', 24),
(13, 5, 'Netflix Subscription', 1),
(14, 5, 'Candles', 4),
(15, 5, 'Wine', 2),
(16, 5, 'Condoms', 1),
(17, 6, 'Febreeze', 1),
(18, 6, 'Garbage Bag', 3);

-- ------------------------------------------------------

--
-- Indexes for table `stock`
--

ALTER TABLE `ingredients`
    ADD PRIMARY KEY (`id`);

-- --------------------------------------------------------

--
-- Table structure for table `ingredientsConsumed`
--

DROP TABLE IF EXISTS `IngredientsConsumed`;
CREATE TABLE `IngredientsConsumed` (
`id` int (11) NOT NULL,
`code` varchar(32) NOT NULL,
`amount` int(11) NOT NULL,
`value` decimal(9,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ingredientsConsumed`
--

INSERT INTO `IngredientsConsumed` (`id`, `code`, `amount`, `value`) VALUES
(1, 'Deck of Cards', 4, 4),
(2, 'Poker Chips', 4, 200),
(3, 'Chips', 6, 42),
(4, 'Cigars', 20, 300),
(5, 'Beer', 12, 300),
(6, 'Netflix Subscription', 3, 29.97),
(7, 'Candles', 12, 60),
(8, 'Wine', 6, 90),
(9, 'Condoms', 3, 45);

-- ------------------------------------------------------

--
-- Indexes for table `ingredientsConsumed`
--

ALTER TABLE `IngredientsConsumed`
	ADD PRIMARY KEY (`id`);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
`id` int (11) NOT NULL,
`spentPurchasing` decimal(9,2) NOT NULL,
`earnedSales` decimal(9,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `spentPurchasing`, `earnedSales`) VALUES
(1, 10000, 17500);


-- ------------------------------------------------------

--
-- Indexes for table `log`
--

ALTER TABLE `log`
ADD PRIMARY KEY (`id`);
