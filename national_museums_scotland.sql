-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 03, 2022 at 03:31 AM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `national_museums_scotland`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `eventID` int NOT NULL,
  `memberID` int NOT NULL,
  PRIMARY KEY (`eventID`,`memberID`),
  KEY `memberFK` (`memberID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `collection`
--

DROP TABLE IF EXISTS `collection`;
CREATE TABLE IF NOT EXISTS `collection` (
  `itemID` int NOT NULL AUTO_INCREMENT,
  `itemName` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `collection` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`itemID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collection`
--

INSERT INTO `collection` (`itemID`, `itemName`, `collection`, `image`) VALUES
(1, 'Tyrannosaurus', 'Dinosaur', 'images/t-rex.jpg'),
(2, 'Triceratops', 'Dinosaur', 'images/triceratops.jpg'),
(3, 'Sphinx', 'Ancient Egypt', 'images/sphinx.jpg'),
(4, 'Golden Mask', 'Ancient Egypt', 'images/golden-mask.jpg'),
(5, 'Brachiosaurus', 'Dinosaur', 'images/brachiosaurus.jpg'),
(6, 'Sarcophagus', 'Ancient Egypt', 'images/sarcophagus.jpg'),
(7, 'Allosaurus', 'Dinosaur', 'images/allosaurus.jpg'),
(8, 'Velociraptor', 'Dinosaur', 'images/velociraptor.jpg'),
(9, 'Egyptian Scriptures', 'Ancient Egypt', 'images/egyptian-scriptures.jpg'),
(10, 'Anubis', 'Ancient Egypt', 'images/anubis.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `eventID` int NOT NULL AUTO_INCREMENT,
  `eventName` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `eventType` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `dayInWeek` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `museum` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `price` varchar(4) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`eventID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`eventID`, `eventName`, `eventType`, `dayInWeek`, `museum`, `price`, `image`, `description`) VALUES
(1, 'Dinosaurs', 'Tour', 'Monday', 'National Museum of Scotland', 'Free', 'images/dinosaur.jpg', 'Explore the dinosaur collection that has fossils and reconstructions with an expert to learn new and interesting facts.'),
(2, 'The First Flight', 'Workshop', 'Wednesday', 'National Museum of Flight', '12', 'images/the-first-flight.jpg', 'The Wright brothers, Orville Wright and Wilbur Wright, were the first to invent and build an airplane operated using motors. It was named the Wright Flyer. The first flight was on December 17th 1903.'),
(3, 'Tractors', 'Tour', 'Tuesday', 'National Museum of Rural Life', 'Free', 'images/tractor.jpg', 'Tractors has been used for farming since the 19th century. Learn more about this important vehicle by going to this tour. '),
(4, 'Life in the Trenches', 'Workshop', 'Friday', 'National War Museum', 'Free', 'images/trenches.jpg', 'Life in the trenches during the war were hard with soldiers facing many difficulties and conditions like trench foot.'),
(5, 'Farming Machinery', 'Exhibition', 'Thursday', 'National Museum of Rural Life', '15', 'images/farming-machinery.jpg', 'See a collection of the different machineries used for farming.'),
(6, 'T-rex', 'Exhibition', 'Wednesday', 'National Museum of Scotland', '15', 'images/t-rex.jpg', 'Tyrannosaurus or T-Rex was one of the biggest meat eating dinosaurs. Attend this exhibition to learn more.');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `memberID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`memberID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`memberID`, `username`, `email`, `password`) VALUES
(15, 'dylanyuen', 'dylanyuen22@gmail.com', '$2y$10$jfx1eovgzYP49vp6PmZ.AO9uMbMqo9jFYOMFsNfOCXM47yLA9PgDG'),
(16, 'gavinyuen', 'gavinyuen44@gmail.com', '$2y$10$uypqlNA1VSnRpoyXJTCScuOzYtaQi5jmKr7m8wnCTTYrY6VH0LVIC');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `commentID` int NOT NULL AUTO_INCREMENT,
  `memberComment` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rating` int NOT NULL,
  `memberID` int NOT NULL,
  `eventID` int NOT NULL,
  PRIMARY KEY (`commentID`),
  KEY `memberID` (`memberID`),
  KEY `eventID` (`eventID`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`commentID`, `memberComment`, `rating`, `memberID`, `eventID`) VALUES
(34, 'Great event', 3, 15, 3),
(37, 'Love planes so this was my favourite event', 5, 15, 2),
(38, 'Very interesting and got to see fossils of different dinosaur species', 5, 15, 1),
(39, 'Event was ok', 3, 16, 2),
(40, 'This event was not very interesting', 2, 16, 3);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `eventFK` FOREIGN KEY (`eventID`) REFERENCES `event` (`eventID`),
  ADD CONSTRAINT `memberFK` FOREIGN KEY (`memberID`) REFERENCES `member` (`memberID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
