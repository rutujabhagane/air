-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2018 at 06:28 PM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `uid` varchar(12) NOT NULL,
  `username` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `othernames` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(60) NOT NULL,
  `profile_pic` text NOT NULL,
  `title` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `uid`, `username`, `firstname`, `lastname`, `othernames`, `password`, `email`, `profile_pic`, `title`) VALUES
(1, 'Hj90nm33', 'asadadams', 'Asad', 'Adams', '', '$2y$10$PRhzCZaibGEMm.88fvgGB.mxh.IhK2yq8FDk021ObXYVA6QkrAwWq', 'clarkpeace.adams@gmail.com', 'assets/img/default_profile.png', 'Admin'),
(3, 'QLz7+aglSq', 'kofi1', 'Kofi', 'Boakye', '', '$2y$10$ezsh59bB1Atkv4P.QnVjO.uAlsQlUvm7YFBRs8AYadbK3mQEUf/W.', 'kofiboakye@gmail.com', 'assets/img/default_profile.png', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `crop_reference`
--

CREATE TABLE `crop_reference` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crop_reference`
--

INSERT INTO `crop_reference` (`id`, `type`, `number`) VALUES
(1, 'maize', 1),
(2, 'groundnut', 2),
(3, 'tomato', 3),
(4, 'millet', 4),
(5, 'pepper', 5);

-- --------------------------------------------------------

--
-- Table structure for table `farm`
--

CREATE TABLE `farm` (
  `id` int(11) NOT NULL,
  `farm_name` varchar(20) NOT NULL,
  `crop` varchar(60) NOT NULL,
  `size` int(10) NOT NULL,
  `soil_type` varchar(15) NOT NULL,
  `irrigation_type` varchar(25) NOT NULL,
  `region` varchar(60) NOT NULL,
  `town` varchar(60) NOT NULL,
  `block_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `farm`
--

INSERT INTO `farm` (`id`, `farm_name`, `crop`, `size`, `soil_type`, `irrigation_type`, `region`, `town`, `block_id`) VALUES
(1, 'nimo tomato farm', 'tomato', 3, 'loamy', 'surface', 'BA', 'Dormaa', 1),
(2, 'ama maize farm', 'maize', 4, 'sandy', 'sprinkler', 'BA', 'Techiman', 1),
(3, 'Kelvin Tomato Farm', 'tomato', 20, 'loamy', 'surface', 'AR', 'Accra', 1);

-- --------------------------------------------------------

--
-- Table structure for table `farm_unit`
--

CREATE TABLE `farm_unit` (
  `id` int(11) NOT NULL,
  `farm_id` int(11) NOT NULL,
  `unit_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `farm_unit`
--

INSERT INTO `farm_unit` (`id`, `farm_id`, `unit_id`) VALUES
(0, 1, 26010),
(0, 1, 32760),
(0, 2, 98258);

-- --------------------------------------------------------

--
-- Table structure for table `irrigation_reference`
--

CREATE TABLE `irrigation_reference` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `number` int(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `irrigation_reference`
--

INSERT INTO `irrigation_reference` (`id`, `type`, `number`) VALUES
(1, 'drip', 1),
(2, 'surface', 2),
(3, 'sprinkler', 3),
(4, 'center', 4);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `subject` varchar(25) NOT NULL,
  `user_id` varchar(12) NOT NULL,
  `message` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_read` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `moisture_sensor`
--

CREATE TABLE `moisture_sensor` (
  `id` int(11) NOT NULL,
  `unit_id` int(12) NOT NULL,
  `reading` int(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `moisture_sensor`
--

INSERT INTO `moisture_sensor` (`id`, `unit_id`, `reading`, `date`) VALUES
(1, 32760, 3, '2018-05-10 04:00:00'),
(2, 32760, 12, '2018-05-10 04:09:10'),
(3, 32760, 3, '2018-05-10 10:13:00'),
(4, 32760, 200, '2018-05-10 01:23:00'),
(5, 32760, 1, '2018-05-14 02:11:00'),
(6, 32760, 12, '2018-05-15 06:13:00'),
(7, 32760, 12, '2018-05-15 05:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `soil_reference`
--

CREATE TABLE `soil_reference` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soil_reference`
--

INSERT INTO `soil_reference` (`id`, `type`, `number`) VALUES
(1, 'loamy', 1),
(2, 'clayey', 2),
(3, 'sandy', 3);

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

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `uid` varchar(12) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `othernames` varchar(30) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `pin` text NOT NULL,
  `profile_pic` text NOT NULL,
  `region` varchar(60) NOT NULL,
  `town` varchar(60) NOT NULL,
  `admin_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `uid`, `firstname`, `lastname`, `othernames`, `phone`, `pin`, `profile_pic`, `region`, `town`, `admin_id`) VALUES
(1, '5ae45a4316', 'Kofi', 'Nimo', 'K', '0242928745', '$2y$10$pe0x6MxWj0H1Fyu/VpKpL.zHv2zGEZfzAJi8u8bTZV.Q0YBwHDSbC', 'assets/img/default_user_profile.png', 'BA', 'Sunyani', 1),
(2, '5ae45a918e', 'Yvonne', 'Nimo', '', '0244521366', '$2y$10$pos0fQj8XpAIbLV8Dh83Fe9pbm4ZXTGo1je2SOUN5WnpXcupXvLz2', 'assets/img/default_user_profile.png', 'BA', 'Sunyani', 1),
(3, '5ae45af259', 'Ama', 'Yeboah', '', '0244521367', '$2y$10$Eyxdw31Iu6gLPGyaaCm..ux.AsOOFR/k8w6LSIuwI02ImSFHYUsLi', 'assets/img/default_user_profile.png', 'AR', 'Accra', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_farm`
--

CREATE TABLE `user_farm` (
  `id` int(11) NOT NULL,
  `user_id` varchar(12) NOT NULL,
  `farm_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_farm`
--

INSERT INTO `user_farm` (`id`, `user_id`, `farm_id`) VALUES
(1, '5ae45a4316', 1),
(2, '5ae45a918e', 1),
(3, '5ae45af259', 2),
(4, '5ae45a4316', 2);

-- --------------------------------------------------------

--
-- Table structure for table `water_need`
--

CREATE TABLE `water_need` (
  `id` int(11) NOT NULL,
  `farm_id` int(11) NOT NULL,
  `volume` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crop_reference`
--
ALTER TABLE `crop_reference`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farm`
--
ALTER TABLE `farm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farm_unit`
--
ALTER TABLE `farm_unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `irrigation_reference`
--
ALTER TABLE `irrigation_reference`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moisture_sensor`
--
ALTER TABLE `moisture_sensor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soil_reference`
--
ALTER TABLE `soil_reference`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temperature_sensor`
--
ALTER TABLE `temperature_sensor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_farm`
--
ALTER TABLE `user_farm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `water_need`
--
ALTER TABLE `water_need`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `crop_reference`
--
ALTER TABLE `crop_reference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `farm`
--
ALTER TABLE `farm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `irrigation_reference`
--
ALTER TABLE `irrigation_reference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `moisture_sensor`
--
ALTER TABLE `moisture_sensor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `soil_reference`
--
ALTER TABLE `soil_reference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `temperature_sensor`
--
ALTER TABLE `temperature_sensor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_farm`
--
ALTER TABLE `user_farm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `water_need`
--
ALTER TABLE `water_need`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
