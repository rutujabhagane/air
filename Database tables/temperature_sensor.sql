-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2018 at 10:03 AM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `irr`
--

-- --------------------------------------------------------

--
-- Table structure for table `temperature_sensor`
--

CREATE TABLE `temperature_sensor` (
  `id` int(11) NOT NULL,
  `unit_id` int(12) NOT NULL,
  `reading` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temperature_sensor`
--

INSERT INTO `temperature_sensor` (`id`, `unit_id`, `reading`, `date`) VALUES
(1, 32760, 20, '2018-05-10 04:00:00'),
(2, 32760, 16, '2018-05-10 04:09:10'),
(3, 32760, 11, '2018-05-10 10:13:00'),
(4, 32760, 10, '2018-05-10 01:23:00'),
(5, 32760, 18, '2018-05-14 02:11:00'),
(6, 32760, 19, '2018-05-15 06:13:00'),
(7, 32760, -5, '2018-05-15 05:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `temperature_sensor`
--
ALTER TABLE `temperature_sensor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `temperature_sensor`
--
ALTER TABLE `temperature_sensor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
