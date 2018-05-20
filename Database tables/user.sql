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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
