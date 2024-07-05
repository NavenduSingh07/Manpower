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
-- Table structure for table `form_detailsoutput`
--

CREATE TABLE `form_detailsoutput` (
  `form_id` int(11) NOT NULL,
  `departmentName` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `shift` varchar(10) NOT NULL,
  `supervisors` text DEFAULT NULL,
  `trimming_operators` text DEFAULT NULL,
  `trimming_labours` text DEFAULT NULL,
  `trimmingWD` int(11) NOT NULL DEFAULT 0,
  `visual_operators` text DEFAULT NULL,
  `visual_labours` text DEFAULT NULL,
  `visualWD` int(11) NOT NULL DEFAULT 0,
  `shorting_operators` text DEFAULT NULL,
  `shorting_labours` text DEFAULT NULL,
  `shortingWD` int(11) NOT NULL DEFAULT 0,
  `framing_operators` text DEFAULT NULL,
  `framing_labours` text DEFAULT NULL,
  `framingWD` int(11) NOT NULL DEFAULT 0,
  `junctionbox_operators` text DEFAULT NULL,
  `junctionbox_labours` text DEFAULT NULL,
  `junctionBoxWD` int(11) NOT NULL DEFAULT 0,
  `potting_operators` text DEFAULT NULL,
  `potting_labours` text DEFAULT NULL,
  `pottingWD` int(11) NOT NULL DEFAULT 0,
  `curring_operators` text DEFAULT NULL,
  `curring_labours` text DEFAULT NULL,
  `curringWD` int(11) NOT NULL DEFAULT 0,
  `cleaning_operators` text DEFAULT NULL,
  `cleaning_labours` text DEFAULT NULL,
  `cleaningWD` int(11) NOT NULL DEFAULT 0,
  `hipot_operators` text DEFAULT NULL,
  `hipot_labours` text DEFAULT NULL,
  `hipotWD` int(11) NOT NULL DEFAULT 0,
  `sunsimulator_operators` text DEFAULT NULL,
  `sunsimulator_labours` text DEFAULT NULL,
  `sunsimulatorWD` int(11) NOT NULL DEFAULT 0,
  `el_operators` text DEFAULT NULL,
  `el_labours` text DEFAULT NULL,
  `elWD` int(11) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL,
  `username` varchar(50) NOT NULL,
  `store_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_detailsoutput`
--

INSERT INTO `form_detailsoutput` (`form_id`, `departmentName`, `date`, `time`, `shift`, `supervisors`, `trimming_operators`, `trimming_labours`, `trimmingWD`, `visual_operators`, `visual_labours`, `visualWD`, `shorting_operators`, `shorting_labours`, `shortingWD`, `framing_operators`, `framing_labours`, `framingWD`, `junctionbox_operators`, `junctionbox_labours`, `junctionBoxWD`, `potting_operators`, `potting_labours`, `pottingWD`, `curring_operators`, `curring_labours`, `curringWD`, `cleaning_operators`, `cleaning_labours`, `cleaningWD`, `hipot_operators`, `hipot_labours`, `hipotWD`, `sunsimulator_operators`, `sunsimulator_labours`, `sunsimulatorWD`, `el_operators`, `el_labours`, `elWD`, `status`, `username`, `store_id`) VALUES
(4, 'Output', '2024-06-05', '14:21:15', 'Day', 'tests (123), testss (121)', 'testo (7532)', 'testl (111), testll (147)', 1, 'testo (7532)', 'testl (111), testll (147)', 2, 'testo (7532)', 'testl (111), testll (147)', 3, 'testo (7532)', 'testll (147)', 4, 'testo (7532)', 'testl (111)', 5, 'testo (7532)', 'testl (111), testll (147)', 6, 'testo (7532)', 'testl (111)', 7, 'testo (7532)', 'testl (111)', 8, 'testo (7532)', 'testl (111), testll (147)', 9, 'testo (7532)', 'testl (111), testll (147)', 10, 'testo (7532)', 'testl (111), testll (147)', 11, 2, 'supervisor', 1),
(6, 'Output', '2024-06-05', '18:05:16', 'Night', 'tests (123)', 'testo (7532)', 'testl (111)', 11, 'testo (7532)', 'testl (111)', 22, 'testo (7532)', 'testll (147)', 33, 'testo (7532)', 'testl (111)', 44, 'testo (7532)', 'testll (147)', 55, 'testo (7532)', 'testll (147)', 66, 'testo (7532)', 'testl (111)', 77, 'testo (7532)', 'testll (147)', 88, 'testo (7532)', 'testll (147)', 99, 'testo (7532)', 'testl (111)', 111, 'testo (7532)', 'testll (147)', 1111, 2, 'supervisor', 1),
(7, 'Output', '2024-06-06', '14:23:22', 'Night', 'tests (123)', 'testo (7532)', 'testll (147)', 786, 'testo (7532)', 'testll (147)', 9838, 'testo (7532)', 'testl (111)', 983, 'testo (7532)', 'testl (111)', 983, 'testo (7532)', 'testl (111)', 563, 'testo (7532)', 'testll (147)', 53, 'testo (7532)', 'testll (147)', 693, 'testo (7532)', 'testll (147)', 693, 'testo (7532)', 'testl (111)', 39378, 'testo (7532)', 'testl (111)', 78378, 'testo (7532)', 'testl (111)', 737, 2, 'supervisor', 1),
(8, 'Output', '2024-06-13', '16:41:31', 'Day', 'tests (123)', 'testo (7532)', 'testl (111), testll (147)', 11, 'testo (7532)', 'testl (111), testll (147)', 44, 'testo (7532)', 'testll (147)', 44, 'testo (7532)', 'testll (147)', 44, 'testo (7532)', 'testl (111), testll (147)', 4, 'testo (7532)', 'testll (147)', 44, 'testo (7532)', 'testl (111)', 4, 'testo (7532)', 'testl (111)', 44, 'testo (7532)', 'testl (111), testll (147)', 444, 'testo (7532)', 'testll (147)', 4431, 'testo (7532)', 'testl (111), testll (147)', 1324, 2, 'Navendu', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form_detailsoutput`
--
ALTER TABLE `form_detailsoutput`
  ADD PRIMARY KEY (`form_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form_detailsoutput`
--
ALTER TABLE `form_detailsoutput`
  MODIFY `form_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
