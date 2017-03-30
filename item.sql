-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2017 at 02:41 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `coursework`
--

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `ItemID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FoundUser` int(10) unsigned DEFAULT NULL,
  `Type` enum('Jewellery','Electronics','Pet') DEFAULT NULL,
  `FoundDate` date DEFAULT NULL,
  `FoundAddLine1` varchar(30) DEFAULT NULL,
  `FoundAddLine2` varchar(20) DEFAULT NULL,
  `FoundPostCode` varchar(10) DEFAULT NULL,
  `Colour` varchar(10) DEFAULT NULL,
  `Photo` mediumblob,
  `Description` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ItemID`),
  KEY `FoundUser` (`FoundUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ItemID`, `FoundUser`, `Type`, `FoundDate`, `FoundAddLine1`, `FoundAddLine2`, `FoundPostCode`, `Colour`, `Photo`, `Description`) VALUES
(4, 1, '', NULL, NULL, NULL, NULL, NULL, '', NULL),
(5, 1, '', NULL, NULL, NULL, NULL, NULL, '', NULL),
(6, 1, '', NULL, NULL, NULL, NULL, NULL, '', NULL),
(7, 1, '', NULL, NULL, NULL, NULL, NULL, '', NULL),
(8, 1, '', NULL, NULL, NULL, NULL, NULL, '', NULL),
(9, 1, '', NULL, NULL, NULL, NULL, NULL, '', NULL),
(10, 1, '', NULL, NULL, NULL, NULL, NULL, '', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`FoundUser`) REFERENCES `user` (`UserID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
