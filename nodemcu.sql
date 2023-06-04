-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 04, 2023 at 06:42 AM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id20859912_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `nodemcu`
--

CREATE TABLE `nodemcu` (
  `id` int(11) NOT NULL,
  `action` varchar(255) DEFAULT NULL,
  `pin` varchar(10) DEFAULT NULL,
  `frequency` int(11) NOT NULL,
  `value` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nodemcu`
--

INSERT INTO `nodemcu` (`id`, `action`, `pin`, `frequency`, `value`) VALUES
(0, 'read', 'D0', 0, 0),
(1, 'read', 'D1', 0, 0),
(2, 'read', 'D2', 0, 0),
(3, 'read', 'D3', 0, 1),
(4, 'write', 'D4', 0, 10),
(5, 'read', 'D5', 0, 0),
(6, 'read', 'D6', 0, 0),
(7, 'read', 'D7', 0, 0),
(8, 'read', 'D8', 0, 0),
(10, 'write', 'A0', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nodemcu`
--
ALTER TABLE `nodemcu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nodemcu`
--
ALTER TABLE `nodemcu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
