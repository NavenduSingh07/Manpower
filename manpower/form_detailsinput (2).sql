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
-- Table structure for table `form_detailsinput`
--

CREATE TABLE `form_detailsinput` (
  `form_id` int(11) NOT NULL,
  `departmentName` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `shift` varchar(10) NOT NULL,
  `supervisors` text DEFAULT NULL,
  `manual_layup_and_bussing_operators` text DEFAULT NULL,
  `manual_layup_and_bussing_labours` text DEFAULT NULL,
  `manualLayupBussWD` int(11) NOT NULL DEFAULT 0,
  `repairing_string_operators` text NOT NULL,
  `repairing_string_labours` text NOT NULL,
  `repairingStringWD` int(11) NOT NULL DEFAULT 0,
  `repairing_module_operators` text NOT NULL,
  `repairing_module_labours` text NOT NULL,
  `repairingModuleWD` int(11) DEFAULT 0,
  `eva_glass_loader_operators` text DEFAULT NULL,
  `eva_glass_loader_labours` text DEFAULT NULL,
  `evaGlassWD` int(11) NOT NULL DEFAULT 0,
  `stringer_layup1_operators` text DEFAULT NULL,
  `stringer_layup1_labours` text DEFAULT NULL,
  `stringerL1WD` int(11) NOT NULL DEFAULT 0,
  `stringer_layup2_operators` text DEFAULT NULL,
  `stringer_layup2_labours` text DEFAULT NULL,
  `stringerL2WD` int(11) NOT NULL DEFAULT 0,
  `stringer_layup3_operators` text DEFAULT NULL,
  `stringer_layup3_labours` text DEFAULT NULL,
  `stringerL3WD` int(11) NOT NULL DEFAULT 0,
  `stringer_ms40_operators` text DEFAULT NULL,
  `stringer_ms40_labours` text DEFAULT NULL,
  `stringerMS40WD` int(11) NOT NULL DEFAULT 0,
  `bussing_tapping_operators` text DEFAULT NULL,
  `bussing_tapping_labours` text DEFAULT NULL,
  `bussTapingWD` int(11) NOT NULL DEFAULT 0,
  `eva_backsheet_operators` text DEFAULT NULL,
  `eva_backsheet_labours` text DEFAULT NULL,
  `evaBacksheetWD` int(11) NOT NULL DEFAULT 0,
  `el_repairing_operators` text DEFAULT NULL,
  `el_repairing_labours` text DEFAULT NULL,
  `elRepairWD` int(11) NOT NULL DEFAULT 0,
  `lamination1_operators` text DEFAULT NULL,
  `lamination1_labours` text DEFAULT NULL,
  `lamination1WD` int(11) NOT NULL DEFAULT 0,
  `lamination2_operators` text DEFAULT NULL,
  `lamination2_labours` text DEFAULT NULL,
  `lamination2WD` int(11) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL,
  `username` varchar(50) NOT NULL,
  `store_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_detailsinput`
--

INSERT INTO `form_detailsinput` (`form_id`, `departmentName`, `date`, `time`, `shift`, `supervisors`, `manual_layup_and_bussing_operators`, `manual_layup_and_bussing_labours`, `manualLayupBussWD`, `repairing_string_operators`, `repairing_string_labours`, `repairingStringWD`, `repairing_module_operators`, `repairing_module_labours`, `repairingModuleWD`, `eva_glass_loader_operators`, `eva_glass_loader_labours`, `evaGlassWD`, `stringer_layup1_operators`, `stringer_layup1_labours`, `stringerL1WD`, `stringer_layup2_operators`, `stringer_layup2_labours`, `stringerL2WD`, `stringer_layup3_operators`, `stringer_layup3_labours`, `stringerL3WD`, `stringer_ms40_operators`, `stringer_ms40_labours`, `stringerMS40WD`, `bussing_tapping_operators`, `bussing_tapping_labours`, `bussTapingWD`, `eva_backsheet_operators`, `eva_backsheet_labours`, `evaBacksheetWD`, `el_repairing_operators`, `el_repairing_labours`, `elRepairWD`, `lamination1_operators`, `lamination1_labours`, `lamination1WD`, `lamination2_operators`, `lamination2_labours`, `lamination2WD`, `status`, `username`, `store_id`) VALUES
(12, 'Input', '2024-06-10', '13:15:58', 'Day', 'sup (544)', 'zxc (789), rty (963)', 'qwe (123), asd (456)', 1, 'zxc (789), rty (963)', 'qwe (123), asd (456)', 2, 'zxc (789), rty (963)', 'qwe (123), asd (456)', 3, 'zxc (789)', 'asd (456)', 4, 'zxc (789)', 'asd (456)', 5, 'zxc (789)', 'asd (456)', 6, 'rty (963)', 'asd (456)', 7, 'rty (963)', 'asd (456)', 8, 'rty (963)', 'qwe (123)', 9, 'rty (963)', 'qwe (123)', 10, 'rty (963)', 'asd (456)', 12, 'rty (963)', 'asd (456)', 0, 'rty (963)', 'asd (456)', 13, 2, 'supervisor', 1),
(13, 'Input', '2024-06-13', '10:42:32', 'Day', 'tests (123), testss (121)', 'dyt (7852)', 'testll (147)', 444, 'dyt (7852)', 'testl (111), testll (147)', 55, 'dyt (7852)', 'testl (111), testll (147)', 5, 'dyt (7852)', 'testl (111), testll (147)', 55, 'dyt (7852)', 'testl (111), testll (147)', 5, 'dyt (7852)', 'testl (111)', 5, 'dyt (7852)', 'testl (111), testll (147)', 5, 'dyt (7852)', 'testl (111), testll (147)', 5, 'dyt (7852)', 'testl (111), testll (147)', 5, 'dyt (7852)', 'testl (111)', 55, 'dyt (7852)', 'testl (111), testll (147)', 55, 'dyt (7852)', 'testl (111), testll (147)', 0, 'dyt (7852)', 'testll (147)', 55, 2, 'Navendu', 1),
(14, 'Input', '2024-06-18', '12:38:55', 'Night', 'testss (121)', 'dyt (7852)', 'testl (111)', 11, 'dyt (7852)', 'testl (111)', 2, 'dyt (7852)', 'testl (111), testll (147)', 2, 'dyt (7852)', 'testl (111), testll (147)', 2, 'dyt (7852)', 'testll (147)', 22, 'dyt (7852)', 'testl (111)', 22, 'dyt (7852)', 'testl (111), testll (147)', 222, 'dyt (7852)', 'testl (111), testll (147)', 22, 'dyt (7852)', 'testl (111), testll (147)', 22, 'dyt (7852)', 'testl (111), testll (147)', 222, 'dyt (7852)', 'testl (111), testll (147)', 2, 'dyt (7852)', 'testll (147)', 0, 'dyt (7852)', 'testl (111)', 2, 2, 'Navendu', 1),
(15, 'Input', '2024-07-01', '11:28:31', 'Day', 'tests (123)', 'dyt (7852)', 'testl (111)', 1, 'dyt (7852)', 'testl (111)', 11101, 'dyt (7852)', 'testl (111)', 11, 'zxc (789)', 'asd (456)', 22, 'zxc (789)', 'qwe (123)', 11, 'zxc (789)', 'testll (147)', 22, 'zxc (789)', 'testll (147)', 11, 'rty (963)', 'testll (147)', 1, 'zxc (789)', 'testll (147)', 11, 'dyt (7852), zxc (789)', 'testl (111), testll (147)', 1, 'zxc (789)', 'qwe (123)', 11, 'zxc (789)', 'testll (147)', 0, 'dyt (7852)', 'testl (111), testll (147)', 1, 2, 'Navendu', 1),
(16, 'Input', '2024-07-01', '11:42:47', 'Day', 'tests (123)', 'rty (963)', 'qwe (123)', 0, 'dyt (7852)', 'testll (147)', 0, 'zxc (789)', 'testl (111)', 0, 'dyt (7852)', 'qwe (123)', 0, 'dyt (7852)', 'testll (147)', 0, 'dyt (7852)', 'testl (111)', 0, 'zxc (789)', 'testl (111)', 0, 'dyt (7852)', 'testll (147)', 0, 'zxc (789)', 'qwe (123)', 0, 'rty (963)', 'testl (111)', 0, 'dyt (7852)', 'asd (456)', 0, 'zxc (789)', 'testll (147)', 0, 'zxc (789)', 'testll (147)', 0, 1, 'Navendu', 1),
(17, 'Input', '2024-07-03', '10:56:35', 'Day', '10015', '10065', '10060, 10065, 10172, 10344', 111, '10065, 10139, 10241, 10365', '10065, 10119, 10320', 54, '10226, 10369', '10060', 545, '10015', '10119', 5, '10060', '10060', 5, '10060, 10065', '10060, 10119', 5, '10060', '10065', 55, '10065', '10060', 5, '10060', '10065', 5, '10015, 10119', '10060', 5, '10119', '10060', 5, '10015', '10060', 0, '10060', '10065', 5, 2, 'Navendu', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form_detailsinput`
--
ALTER TABLE `form_detailsinput`
  ADD PRIMARY KEY (`form_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form_detailsinput`
--
ALTER TABLE `form_detailsinput`
  MODIFY `form_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
