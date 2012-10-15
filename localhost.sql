-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 27, 2012 at 12:20 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hms`
--
CREATE DATABASE `hms` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hms`;

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

DROP TABLE IF EXISTS `person`;
CREATE TABLE IF NOT EXISTS `person` (
  `personId` bigint(20) NOT NULL AUTO_INCREMENT,
  `fName` varchar(45) NOT NULL,
  `mName` varchar(45) NOT NULL,
  `lName` varchar(45) NOT NULL,
  `address` varchar(500) NOT NULL,
  `rPhone` varchar(45) NOT NULL,
  `mobile` varchar(45) NOT NULL,
  `registrationNo` varchar(45) DEFAULT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `DOB` timestamp NULL DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`personId`),
  UNIQUE KEY `personId_UNIQUE` (`personId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`personId`, `fName`, `mName`, `lName`, `address`, `rPhone`, `mobile`, `registrationNo`, `gender`, `DOB`, `email`) VALUES
(1, 'Shantanu', 'Shekhar', 'Thatte', 'Yashwant Cology', '2433520', '9960066611', NULL, 'Male', '1989-11-05 18:30:00', 'shantanuthatte@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userId` bigint(20) NOT NULL AUTO_INCREMENT,
  `userName` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `type` int(11) NOT NULL,
  `recoveryEmail` varchar(100) NOT NULL,
  `permission` varchar(20) NOT NULL,
  `personId` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `userName` (`userName`),
  KEY `personId_idx` (`personId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `password`, `type`, `recoveryEmail`, `permission`, `personId`) VALUES
(1, 'SThatte', 's', 1, 's', '1', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `personId` FOREIGN KEY (`personId`) REFERENCES `person` (`personId`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
