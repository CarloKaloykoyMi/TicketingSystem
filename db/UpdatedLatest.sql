-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2024 at 09:53 AM
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
-- Database: `ticketing`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail`
--

CREATE TABLE `audit_trail` (
  `at_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Action` varchar(550) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_trail`
--

INSERT INTO `audit_trail` (`at_id`, `user_id`, `Action`, `Date`) VALUES
(1, 3, 'Logout', '2024-03-06 03:23:49'),
(2, 3, 'Logged In', '2024-03-06 03:27:11'),
(3, 3, 'Logout', '2024-03-06 03:27:26'),
(4, 3, 'Logged In', '2024-03-06 03:27:31'),
(5, 2, 'Logged In', '2024-03-06 03:49:57'),
(6, 0, 'Profile Detail Edited', '2024-03-06 04:07:55'),
(7, 2, 'Profile Detail Edited', '2024-03-06 04:08:43'),
(8, 2, 'Logout', '2024-03-06 05:12:58'),
(9, 0, 'Profile Detail Edited', '2024-03-06 05:19:38'),
(10, 0, 'Profile Detail Edited', '2024-03-06 05:20:10'),
(11, 1, 'Logged In', '2024-03-07 02:01:44'),
(12, 1, 'Profile Detail Edited', '2024-03-07 02:02:25'),
(13, 1, 'Logout', '2024-03-07 02:06:54'),
(14, 10, 'Logged In', '2024-03-07 02:07:00'),
(15, 10, 'Logout', '2024-03-07 02:28:06'),
(16, 10, 'Logged In', '2024-03-07 02:28:07'),
(17, 3, 'Logged In', '2024-03-07 02:39:53'),
(18, 3, 'Logout', '2024-03-07 03:08:32'),
(19, 3, 'Logged In', '2024-03-07 03:08:33'),
(20, 10, 'Logout', '2024-03-07 03:22:01'),
(21, 10, 'Logged In', '2024-03-07 03:22:03'),
(22, 10, 'Logged In', '2024-03-07 04:15:05'),
(23, 10, 'Logout', '2024-03-07 04:15:10'),
(24, 2, 'Logged In', '2024-03-07 04:15:14'),
(25, 2, 'Logout', '2024-03-07 04:16:31'),
(26, 1, 'Logged In', '2024-03-07 04:16:36'),
(27, 1, 'Logout', '2024-03-07 04:23:30'),
(28, 3, 'Logged In', '2024-03-07 04:23:51'),
(29, 3, 'Logout', '2024-03-07 06:23:15'),
(30, 1, 'Logged In', '2024-03-07 06:23:20'),
(31, 1, 'Profile Picture Changed', '2024-03-07 07:10:59'),
(32, 10, 'Profile Picture Changed', '2024-03-07 07:14:42'),
(33, 10, 'Profile Picture Changed', '2024-03-07 07:18:45'),
(34, 10, 'Profile Picture Changed', '2024-03-07 07:19:45'),
(35, 10, 'Logout', '2024-03-07 07:26:00'),
(36, 3, 'Logged In', '2024-03-07 07:26:19'),
(37, 3, 'Logout', '2024-03-07 07:28:38'),
(38, 30, 'Logged In', '2024-03-07 07:32:04'),
(39, 30, 'Profile Picture Changed', '2024-03-07 07:34:49'),
(40, 30, 'Logout', '2024-03-07 07:37:47'),
(41, 3, 'Logged In', '2024-03-07 07:38:06'),
(42, 3, 'Logout', '2024-03-07 07:38:27'),
(43, 30, 'Logged In', '2024-03-07 07:38:49'),
(44, 1, 'Logout', '2024-03-07 07:51:41'),
(45, 10, 'Logged In', '2024-03-07 07:51:56'),
(46, 10, 'Logout', '2024-03-07 07:52:44'),
(47, 10, 'Logged In', '2024-03-07 07:53:15'),
(48, 10, 'Profile Detail Edited', '2024-03-07 07:53:45'),
(49, 10, 'Profile Picture Changed', '2024-03-07 07:54:30'),
(50, 10, 'Profile Picture Changed', '2024-03-07 07:54:42'),
(51, 10, 'Profile Picture Changed', '2024-03-07 07:54:53'),
(52, 10, 'Logout', '2024-03-07 07:55:50'),
(53, 1, 'Logged In', '2024-03-07 07:58:36'),
(54, 30, 'Profile Detail Edited', '2024-03-07 08:23:50'),
(55, 30, 'Profile Detail Edited', '2024-03-07 08:25:21'),
(56, 30, 'Profile Detail Edited', '2024-03-07 08:25:46'),
(57, 30, 'Profile Detail Edited', '2024-03-07 08:25:55'),
(58, 30, 'Profile Detail Edited', '2024-03-07 08:26:07');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(50) NOT NULL,
  `company` varchar(50) NOT NULL,
  `branch_name` varchar(191) NOT NULL,
  `branch_address` varchar(191) NOT NULL,
  `contact` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `company`, `branch_name`, `branch_address`, `contact`, `email`, `created_at`) VALUES
(1, 'Comfac Technology Options (CTO)', 'Libertad Branch', 'Manda', '09234234233', 'branch@gmail.com', '2024-02-12 06:10:35'),
(2, 'Comfac Technology Options (CTO)', 'Makati', 'Makati City', '0912316546', 'makati@gmail.com', '2024-02-15 04:42:21'),
(3, 'Comfac Technology Options (CTO)', 'Laguna Branch', 'Laguna', '09546123146', 'laguna@gmail.com', '2024-02-15 04:43:53'),
(4, 'Comfac Global Group', 'Makati', 'Makati City LIpa', '09546123111', 'evalyngrace.estrera@gmail.com', '2024-02-20 02:04:35'),
(5, 'Comfac Technology Options (CTO)', 'Laguna', 'Laguna', '09546123146', 'estrera.evalyngrace@gmail.com', '2024-02-20 02:05:19'),
(6, 'Comfac Global Group', 'Example', 'Davao', '09546123146', 'evalyngrace.estrera@my.jru.edu', '2024-02-20 06:02:34');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(50) NOT NULL,
  `company_name` varchar(191) NOT NULL,
  `company_address` varchar(191) NOT NULL,
  `contact` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company_name`, `company_address`, `contact`, `email`, `created_at`) VALUES
(4, 'Comfac Global Group', 'Mandaluyong City', '09546123146', 'comfac@gmail.com', '2024-02-15 02:49:02'),
(5, 'Comfac Technology Options (CTO)', 'Mandaluyong City', '09586123146', 'comfac_cto@gmail.com', '2024-02-15 02:49:48'),
(6, 'Cornersteel Systems Corporation', 'Mandaluyong City', '09546127746', 'cornersteel@gmail.com', '2024-02-15 02:50:16'),
(7, 'Energy Specialist Company(ESCO)', 'Mandaluyong City', '09776123146', 'esco@gmail.com', '2024-02-15 02:50:47');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `first_name`, `last_name`, `phone`, `email`, `message`) VALUES
(1, 'aaa', 'aaa', '06545454', 'gray@gmail.com', 'aaaa'),
(2, 'aaa', 'aaa', '09865545454', 'gray@gmail.com', 'aaaa'),
(3, 'aaa', 'aaa', '09865545454', 'sunoo@gmail.om', 'aaa'),
(4, 'jc', 'cristobal', '123456789', 'jc@gmail.com', 'hi po');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(50) NOT NULL,
  `department_name` varchar(191) NOT NULL,
  `department_head` varchar(191) NOT NULL,
  `location` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department_name`, `department_head`, `location`, `created_at`) VALUES
(1, 'MIS-Department', 'Jun edmund', '3rd Floor', '2024-02-12 06:40:50'),
(2, 'HR', 'John', '2ndFloor', '2024-02-15 04:46:07'),
(3, 'Accounting', 'Kim', '3rd floor', '2024-02-15 04:46:51'),
(4, 'Management Info', 'Carlo', '2ndFloor', '2024-02-15 04:47:21'),
(5, 'Purchasing', 'Kyla', '4th Floor', '2024-02-15 04:48:03'),
(6, 'System Installation', 'Andrea', '5th Floor', '2024-02-15 04:48:27'),
(7, 'Building Management System(BMS)', 'Rommel', '2nd Floor', '2024-02-15 04:49:01'),
(8, 'Systems Mechanical', 'Norman', '2ndFloor', '2024-02-15 04:49:30'),
(9, 'Field Service', 'Mharg', '3rd floor', '2024-02-15 04:52:18');

-- --------------------------------------------------------

--
-- Table structure for table `file_attachment`
--

CREATE TABLE `file_attachment` (
  `file_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `file_attachment`
--

INSERT INTO `file_attachment` (`file_id`, `user_id`, `ticket_id`, `file_name`) VALUES
(23, 3, 1, 'Windows_10_Default_Profile_Picture.svg.png'),
(24, 3, 2, 'CamScanner 02-27-2024 16.32_1 (1).pdf'),
(25, 3, 2, 'CamScanner 02-27-2024 16.32_1.jpg'),
(26, 10, 3, 'CamScanner 02-27-2024 16.32_1 (1).pdf'),
(27, 10, 3, 'CamScanner 02-27-2024 16.32_1.jpg'),
(28, 2, 4, 'Windows_10_Default_Profile_Picture.svg.png'),
(29, 2, 4, 'CamScanner 02-27-2024 16.32_1.jpg'),
(30, 30, 5, 'pexels-adeoye-daniel-20299478.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `subject` varchar(30) NOT NULL,
  `to_company` varchar(50) NOT NULL,
  `requestor` varchar(50) NOT NULL,
  `concern` text NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `to_dept` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `user_id`, `date`, `subject`, `to_company`, `requestor`, `concern`, `status`, `date_created`, `to_dept`) VALUES
(1, 3, '2024-03-07 02:40:29.064445', 'Machine', 'Comfac Global Group', 'John Carlo Astoveza', 'pick up machine', 'Resolved', '2024-03-07 03:23:17', 'MIS-Department'),
(2, 3, '2024-03-07 02:49:29.736979', 'LAN Cable', 'Comfac Global Group', 'John Carlo Astoveza', 'Need to fix lan cable', 'Pending', '2024-03-07 02:49:29', 'MIS-Department'),
(3, 10, '2024-03-07 03:10:31.414712', 'Docker', 'Cornersteel Systems Corporation', 'heheh wew', 'Hello', 'Pending', '2024-03-07 03:10:31', 'HR'),
(4, 2, '2024-03-07 04:15:49.293724', 'Try', 'Comfac Global Group', 'Jio Example', 'Lan Connection', 'Resolved', '2024-03-07 06:30:22', 'MIS-Department'),
(5, 30, '2024-03-07 07:32:26.084698', 'Hello try', 'Comfac Technology Options (CTO)', 'Carlokalo Koy', 'Tyr try', 'Pending', '2024-03-07 07:32:26', 'MIS-Department');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_reply`
--

CREATE TABLE `ticket_reply` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reply` text NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket_reply`
--

INSERT INTO `ticket_reply` (`id`, `ticket_id`, `user_id`, `reply`, `Name`) VALUES
(1, 4, 1, 'Helloo', 'Delloo Antonio'),
(2, 4, 1, 'Hi', 'Delloo Antonio'),
(3, 3, 10, 'Hello', 'heheh wew'),
(4, 1, 1, 'ss', 'Delloo Antonio'),
(5, 3, 1, 'Hello', 'Delloo Antonio'),
(6, 3, 10, 'Hellooooo', 'heheh wew'),
(7, 3, 1, 'Helloo22\r\n', 'Delloo Antonio'),
(8, 1, 3, 'dasdas', 'John Carlo Astoveza'),
(9, 5, 30, 'Hello', 'Carlokalo Koy'),
(10, 5, 1, 'Hello po', 'Delloo Antonio'),
(11, 4, 30, 'Hello po', 'Carlokalo Koy'),
(12, 4, 3, 'Hiii', 'John Carlo Astoveza');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `lastname` varchar(191) NOT NULL,
  `firstname` varchar(191) NOT NULL,
  `middleinitial` varchar(191) NOT NULL,
  `company` varchar(191) NOT NULL,
  `branch` varchar(191) NOT NULL,
  `department` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `contact` varchar(191) NOT NULL,
  `username` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `verification_status` tinyint(50) NOT NULL,
  `role` tinyint(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `lastname`, `firstname`, `middleinitial`, `company`, `branch`, `department`, `email`, `contact`, `username`, `password`, `verification_status`, `role`, `created_at`, `image`) VALUES
(1, 'Antonio', 'Delloo', 'Z', 'comfac', 'Mandaluyong', 'IT- MIS', 'rogaka9738@rohoza.com', '09234234233', 'aaa', '@Dar1234', 1, 0, '2024-02-08 09:05:22', 'Windows_10_Default_Profile_Picture.svg.png'),
(2, 'Example', 'Jio', 'B', 'comfac', 'Mandaluyong', 'IT- MIS', 'john@gmail.com', '09255542125', 'john.john', '123456', 1, 1, '2024-02-14 07:09:24', NULL),
(3, 'Astoveza', 'John Carlo', 'L', 'Comfac Global Group', 'Libertad Branch', 'MIS-Department', 'laguinlinastovezajocar@gmail.com', '09773555302', 'Carlokaloykoy', 'Qwerty123', 1, 1, '2024-02-28 04:00:16', 'CamScanner 02-27-2024 16.45 (2)_1.jpg'),
(10, 'wew', 'ediwow', 'ah', 'Comfac Technology Options (CTO)', 'Libertad Branch', 'MIS-Department', 'darwin.puzo@my.jru.edu', '09123456789', 'HEHEHHe', '@Dar12345', 1, 1, '2024-03-01 06:59:54', 'pexels-adeoye-daniel-20299478.jpg'),
(20, 'Estrera', 'Evalyn Grace', 'P.', 'Comfac Technology Options (CTO)', 'Libertad Branch', 'MIS-Department', 'eva@gmail.com', '09565641546', 'root', '@Qwerty123', 1, 1, '2024-03-06 06:56:14', NULL),
(21, 'aaa', 'aaa', 'a', 'Comfac Global Group', 'Makati', 'HR', 'john@gmail.com', '09565641546', 'root', '@Dar1234', 1, 1, '2024-03-06 06:59:48', NULL),
(22, 'aaa', 'qq', 'D.', 'Comfac Global Group', 'Makati', 'HR', 'john@gmail.com', '09565641546', 'root', '@Dar1234', 1, 1, '2024-03-06 07:00:20', NULL),
(23, 'aaa', 'aaa', 'P.', 'Comfac Global Group', 'Makati', 'MIS-Department', 'john@gmail.com', '09154564543', 'root', '@Dar1234', 1, 1, '2024-03-06 07:02:09', NULL),
(24, 'Estrera', 'Kim', 'a', 'Comfac Global Group', 'Makati', 'HR', 'john@gmail.com', '09154564543', 'root', '@Dar1234', 1, 0, '2024-03-06 07:03:07', NULL),
(25, 'aaa', 'Kim', 'D.', 'Comfac Global Group', 'Makati', 'Accounting', 'john@gmail.com', '09154564543', 'root', '@Dar1234', 1, 0, '2024-03-06 07:03:35', NULL),
(26, 'aa', 'aa', 'M.', 'Comfac Global Group', 'Makati', 'HR', 'john@gmail.com', '09565641546', 'root', '@Dar1234', 1, 0, '2024-03-06 07:07:04', NULL),
(27, 'aaa', 'qq', 'M.', 'Comfac Technology Options (CTO)', 'Libertad Branch', 'Management Info', 'mharg@gmail.com', '09262156455', 'root', '@Dar1234', 1, 0, '2024-03-06 07:07:54', NULL),
(28, 'aa', 'aaa', 'P.', 'Comfac Global Group', 'Makati', 'HR', 'john@gmail.com', '09565641546', 'qq', '@Dar1234', 1, 0, '2024-03-06 07:48:21', NULL),
(29, 'Babas', 'Kim', 'M.', 'Comfac Technology Options (CTO)', 'Libertad Branch', 'Accounting', 'kimpoyyyyyy@gmail.com', '09154564543', 'ww', '@Dar1234', 1, 1, '2024-03-06 07:49:06', NULL),
(30, 'Koy', 'Carlokaloy', 'y', 'Comfac Technology Options (CTO)', 'Makati', 'MIS-Department', 'carlokaloykoy101@gmail.com', '06782454215', 'Carloo', 'Qwerty123', 1, 1, '2024-03-07 07:31:05', 'pexels-adeoye-daniel-20299478.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD PRIMARY KEY (`at_id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file_attachment`
--
ALTER TABLE `file_attachment`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `ticket_reply`
--
ALTER TABLE `ticket_reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_trail`
--
ALTER TABLE `audit_trail`
  MODIFY `at_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `file_attachment`
--
ALTER TABLE `file_attachment`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ticket_reply`
--
ALTER TABLE `ticket_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
