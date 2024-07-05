-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2024 at 08:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testmrp`
--

-- --------------------------------------------------------

--
-- Table structure for table `manpower`
--

CREATE TABLE `manpower` (
  `sno` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `departmentName` varchar(100) NOT NULL,
  `role` varchar(255) NOT NULL,
  `punchid` int(10) NOT NULL,
  `store_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manpower`
--

INSERT INTO `manpower` (`sno`, `name`, `departmentName`, `role`, `punchid`, `store_id`) VALUES
(37, 'tests', 'Housekeeping', 'supervisor', 123, 1),
(38, 'testss', 'Housekeeping', 'supervisor', 121, 1),
(39, 'testl', 'Housekeeping', 'labour', 111, 1),
(40, 'testll', 'Housekeeping', 'labour', 147, 1),
(43, 'null', 'Housekeeping', 'operator', 0, 1),
(44, 'tests', 'Packaging', 'supervisor', 123, 1),
(45, 'testss', 'Packaging', 'supervisor', 121, 1),
(46, 'testl', 'Packaging', 'labour', 111, 1),
(47, 'testll', 'Packaging', 'labour', 147, 1),
(48, 'testo', 'Packaging', 'operator', 0, 1),
(49, 'tests', 'Input', 'supervisor', 123, 1),
(50, 'testss', 'Input', 'supervisor', 121, 1),
(51, 'testl', 'Input', 'labour', 111, 1),
(52, 'testll', 'Input', 'labour', 147, 1),
(53, 'dyt', 'Input', 'operator', 7852, 1),
(54, 'tests', 'Output', 'supervisor', 123, 1),
(55, 'testss', 'Output', 'supervisor', 121, 1),
(56, 'testl', 'Output', 'labour', 111, 1),
(57, 'testll', 'Output', 'labour', 147, 1),
(58, 'testo', 'Output', 'operator', 7532, 1),
(59, 'qwe', 'Input', 'labour', 123, 1),
(60, 'asd', 'Input', 'labour', 456, 1),
(61, 'zxc', 'Input', 'operator', 789, 1),
(62, 'rty', 'Input', 'operator', 963, 1),
(63, 'sup', 'Input', 'supervisor', 544, 1),
(64, 'qwe', 'Packaging', 'labour', 123, 1),
(65, 'asd', 'Packaging', 'labour', 456, 1),
(66, 'zxc', 'Packaging', 'operator', 789, 1),
(67, 'rty', 'Packaging', 'operator', 963, 1),
(68, 'sup', 'Packaging', 'supervisor', 544, 1),
(69, 'qwe', 'Housekeeping', 'labour', 123, 1),
(70, 'asd', 'Housekeeping', 'labour', 456, 1),
(71, 'zxc', 'Housekeeping', 'operator', 789, 1),
(72, 'rty', 'Housekeeping', 'operator', 963, 1),
(73, 'sup', 'Housekeeping', 'supervisor', 544, 1),
(74, 'qwe', 'Output', 'labour', 123, 1),
(75, 'asd', 'Output', 'labour', 456, 1),
(76, 'zxc', 'Output', 'operator', 789, 1),
(77, 'rty', 'Output', 'operator', 963, 1),
(78, 'sup', 'Output', 'supervisor', 544, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `manpower`
--
ALTER TABLE `manpower`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `manpower`
--
ALTER TABLE `manpower`
  MODIFY `sno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
