-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2024 at 08:54 AM
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
-- Table structure for table `form_details`
--

CREATE TABLE `form_details` (
  `form_id` int(11) NOT NULL,
  `supervisors` varchar(255) NOT NULL,
  `operators` text NOT NULL,
  `labours` text NOT NULL,
  `shift` varchar(10) NOT NULL,
  `departmentName` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `username` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `store_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_details`
--

INSERT INTO `form_details` (`form_id`, `supervisors`, `operators`, `labours`, `shift`, `departmentName`, `status`, `username`, `date`, `time`, `store_id`) VALUES
(15, 'tests (123)', 'null (0)', 'testl (111), testll (147)', 'Day', 'Housekeeping', 2, 'supervisor', '2024-05-22', '12:35:37', 1),
(17, 'tests (123)', 'null (0)', 'testll (147)', 'Day', 'Housekeeping', 2, 'supervisor', '2024-05-22', '16:45:32', 1),
(18, 'tests (123), testss (121)', 'null (0)', 'testl (111), testll (147)', 'Day', 'Housekeeping', 2, 'supervisor', '2024-05-23', '15:29:23', 1),
(19, 'tests (123), testss (121)', 'null (0)', 'testl (111)', 'Day', 'Housekeeping', 2, 'supervisor', '2024-06-04', '15:51:10', 1),
(20, 'tests (123), testss (121)', 'null (0)', 'testl (111), testll (147)', 'Day', 'Housekeeping', 2, 'supervisor', '2024-06-04', '15:52:02', 1),
(21, 'tests (123), testss (121)', 'null (0)', 'testll (147)', 'Day', 'Housekeeping', 2, 'Navendu', '2024-06-13', '16:44:35', 1),
(22, 'testss (121)', 'null (0)', 'testll (147)', 'Day', 'Housekeeping', 2, 'Navendu', '2024-07-01', '11:42:28', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form_details`
--
ALTER TABLE `form_details`
  ADD PRIMARY KEY (`form_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form_details`
--
ALTER TABLE `form_details`
  MODIFY `form_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
