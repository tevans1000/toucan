-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2017 at 05:09 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toucan_tevans`
--
CREATE DATABASE IF NOT EXISTS `toucan_tevans` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `toucan_tevans`;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `member_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `member_name` char(255) NOT NULL,
  `member_email` char(255) NOT NULL,
  PRIMARY KEY (`member_id`),
  UNIQUE KEY `member_id` (`member_id`),
  UNIQUE KEY `member_email` (`member_email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

DROP TABLE IF EXISTS `schools`;
CREATE TABLE IF NOT EXISTS `schools` (
  `school_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `school_name` char(255) NOT NULL,
  PRIMARY KEY (`school_id`),
  UNIQUE KEY `school_id` (`school_id`),
  UNIQUE KEY `school_name` (`school_name`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`school_id`, `school_name`) VALUES
(3, 'Alperton Community School'),
(1, 'Ark Academy'),
(4, 'Brondesbury College'),
(2, 'Capital City Academy'),
(7, 'Claremont High School'),
(13, 'Crest Academy'),
(8, 'Islamia School for Girls'),
(5, 'JFS'),
(6, 'Kingsbury High School'),
(11, 'Lycee International De Londres'),
(12, 'Michaela Community School'),
(10, 'Newman Catholic College'),
(9, 'Preston Manor School'),
(14, 'Queens Park Community School'),
(15, 'Southover Partnership School'),
(16, 'Swaminarayan School'),
(18, 'Tokyngton Academy'),
(17, 'Village School'),
(19, 'Wembley High Technology College'),
(20, 'Woodfield School');

-- --------------------------------------------------------

--
-- Table structure for table `school_members`
--

DROP TABLE IF EXISTS `school_members`;
CREATE TABLE IF NOT EXISTS `school_members` (
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `member_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`school_id`,`member_id`),
  KEY `school_id` (`school_id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `school_members`
--
ALTER TABLE `school_members`
  ADD CONSTRAINT `FK-school_members-member_id` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK-school_members-school_id` FOREIGN KEY (`school_id`) REFERENCES `schools` (`school_id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- --------------------------------------------------------

--
-- Create database user `toucan`@`localhost`
--

CREATE USER `toucan`@`localhost` IDENTIFIED BY "WFkPC8gyEhlqTi7yVkVoczgMz";
GRANT USAGE ON *.* TO 'toucan'@'localhost';
GRANT SELECT, INSERT ON `toucan_tevans`.* TO 'toucan'@'localhost';

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
