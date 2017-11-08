-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 07, 2017 at 03:20 AM
-- Server version: 5.5.57-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tcp`
--

-- --------------------------------------------------------

--
-- Table structure for table `item_ageGroup`
--

CREATE TABLE `item_ageGroup` (
  `ageGroup` varchar(11) NOT NULL,
  `ageGroupId` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_ageGroup`
--

INSERT INTO `item_ageGroup` (`ageGroup`, `ageGroupId`) VALUES
('0-4', 1),
('5-11', 2),
('12-15', 3),
('16+', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item_ageGroup`
--
ALTER TABLE `item_ageGroup`
  ADD PRIMARY KEY (`ageGroupId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item_ageGroup`
--
ALTER TABLE `item_ageGroup`
  MODIFY `ageGroupId` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
