-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2024 at 06:59 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `subject` varchar(30) NOT NULL,
  `company` varchar(50) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `department` varchar(30) NOT NULL,
  `requestor` varchar(50) NOT NULL,
  `concern` text NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `comment` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `to_dept` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `user_id`, `date`, `subject`, `company`, `branch`, `department`, `requestor`, `concern`, `status`, `comment`, `date_created`, `to_dept`) VALUES
(7, 0, '2024-02-20 06:47:29.737215', 'change subject', 'Cornersteel Systems Corporation', '', 'Management Info', 'aaa', 'Hello', 'Resolved', 'oks naa', '2024-02-22 07:10:06', ''),
(8, 0, '2024-02-21 02:56:51.396396', 'change document', 'Comfac Global Group', 'Makati daw nye', 'MIS-Department', 'Kyang', 'Hi please comply', 'Pending', 'I get to you', '2024-02-22 06:30:05', ''),
(9, 0, '2024-02-21 03:05:13.355363', 'Acceptance Letter', 'Comfac Global Group', 'Makati daw nye', 'Management Info', 'Mharg', 'Please edit the document ', 'Resolved', 'I already fill it', '2024-02-23 00:58:21', ''),
(10, 0, '2024-02-21 03:07:36.182944', 'fix bugs', 'Cornersteel Systems Corporation', '', 'System Installation', 'Kyandra', 'Do the document', 'Cancelled', 'aaa', '2024-02-22 07:10:42', ''),
(11, 0, '2024-02-21 03:28:45.730754', 'concernnnn', 'Comfac Technology Options (CTO)', 'Makati', 'Accounting', 'Carlo', 'need updated', 'Unresolved', 'aaa', '2024-02-22 06:06:57', ''),
(12, 0, '2024-02-21 03:30:59.497076', 'ello', 'Cornersteel Systems Corporation', '', 'Accounting', 'Darwin', 'aaaa', 'Unresolved', '', '2024-02-22 06:04:02', ''),
(13, 0, '2024-02-22 01:37:08.971713', 'Kikyang', 'Comfac Global Group', 'Makati daw nye', 'MIS-Department', 'Kim', 'Happy Birthday Kyang!!!!!!!!!!!!!!!!!', 'Pending', '', '2024-02-22 01:37:08', ''),
(14, 0, '2024-02-22 01:38:07.218465', 'Kikyang', 'Comfac Global Group', 'sadsadsadsad', 'MIS-Department', 'Ngarag Fam', 'Happy Birthday Kikyang!!!!!!!!!', 'Resolved', 'sardsfdf', '2024-02-22 06:37:14', ''),
(15, 0, '2024-02-22 02:38:49.282823', 'Hiiii', 'Comfac Global Group', 'Makati daw nye', 'MIS-Department', 'Kim', 'Lorem ipsum dolor sit amet, consectetur adipiscing', 'Unresolved', '', '2024-02-23 05:22:07', ''),
(16, 0, '2024-02-22 02:40:13.379268', 'Hiiii', 'Comfac Global Group', 'sadsadsadsad', 'MIS-Department', 'Kim', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sollicitudin accumsan velit, et aliquam mi mollis vitae. Vivamus pellentesque placerat vehicula. Pellentesque vulputate diam nisi, bibendum pharetra lectus ultrices vel. Ut in ipsum tristique, iaculis velit id, convallis justo. Donec aliquam justo quis purus consequat rutrum. Sed sed velit at ante tincidunt dictum id eget ipsum. Proin a tellus felis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis sagittis urna nec lorem pharetra, quis commodo libero efficitur. Ut odio lectus, blandit nec dapibus nec, scelerisque a lectus. In hac habitasse platea dictumst.', 'Pending', '', '2024-02-22 08:44:01', ''),
(17, 0, '2024-02-22 06:46:28.161534', 'Kikyang', 'Comfac Global Group', 'Makati daw nye', 'HR', 'Kyang', 'adsads', 'Cancelled', '', '2024-02-23 05:21:15', ''),
(18, 0, '2024-02-22 06:47:36.916145', 'Follow up MOA', 'Comfac Global Group', 'Makati daw nye', 'MIS-Department', 'Kyang', 'please make it fasterrr!!!!', 'Pending', '', '2024-02-22 06:47:36', ''),
(19, 0, '2024-02-27 02:04:08.551969', 'change subject', 'Comfac Technology Options (CTO)', 'Libertad Branch', 'MIS-Department', 'kim', 'abc', 'Pending', '', '2024-02-27 02:04:08', ''),
(20, 0, '2024-02-28 00:44:18.238676', 'change subject', 'Comfac Global Group', 'Makati', 'MIS-Department', 'Kim', 'aaa', 'Pending', '', '2024-02-28 00:44:18', ''),
(31, 0, '2024-02-28 01:29:58.498678', 'sdfsdfs', 'Comfac Global Group', 'Makati', 'Accounting', 's', 'ss', 'Pending', '', '2024-02-28 01:29:58', ''),
(32, 0, '2024-02-28 02:49:46.278083', 'OO nga no', 'Comfac Global Group', 'Makati', 'MIS-Department', 'Try Natin rito', 'Reply Concerns', 'Pending', '', '2024-02-28 02:49:46', ''),
(33, 0, '2024-02-28 03:51:15.894244', '1423564', 'Comfac Global Group', 'Makati', 'MIS-Department', 'Try Natin rito', '64586', 'Pending', '', '2024-02-28 03:51:15', ''),
(34, 0, '2024-02-28 04:01:40.983215', 'change subject', 'Comfac Technology Options (CTO)', 'Makati', 'HR', 'Carlokaloykoy', 'Hello World', 'Pending', '', '2024-02-28 04:01:40', ''),
(35, 0, '2024-02-28 04:23:03.887279', 'change subject', 'Comfac Global Group', 'Makati', 'MIS-Department', 'kim', 'aaaa', 'Pending', '', '2024-02-28 04:23:03', ''),
(36, 0, '2024-02-28 04:24:48.220386', 'eyyy', 'Comfac Global Group', 'Makati', 'HR', 'kim', 'aaa', 'Pending', '', '2024-02-28 04:24:48', ''),
(37, 0, '2024-02-28 05:39:49.048609', 'change subject', 'Comfac Global Group', 'Makati', 'HR', 'kim', 'Check DB', 'Pending', '', '2024-02-28 05:39:49', ''),
(38, 2, '2024-02-28 05:43:31.175916', 'change subject', 'Comfac Technology Options (CTO)', 'Libertad Branch', 'Accounting', 'Try', 'Try DB3', 'Pending', '', '2024-02-28 05:43:31', '');

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
(1, 10, 1, 'Admin ITo', 'Dello Antonio'),
(2, 10, 0, 'Hello User itop', 'Jio Arcaaaa'),
(3, 10, 0, 'Admin ito ulit', 'Jio Arcaaaa'),
(4, 10, 0, 'Helloooo Sir Dello', 'Jio Arcaaaa'),
(5, 10, 1, 'Hello Jio', 'Dello Antonio'),
(6, 32, 1, 'Hi Jio, What seems to be the problem?', 'Dello Antonio'),
(7, 32, 0, 'Hello, Sir Dio Good morning po', 'Jio Arcaaaa'),
(8, 32, 1, 'Hiii Evaaaa', 'Dello Antonio'),
(9, 32, 0, 'halluuuu', 'Jio Arcaaaa'),
(10, 7, 1, 'Hellooooo check ulit', 'Dello Antonio'),
(11, 7, 0, 'oo nga', 'Jio Arcaaaa'),
(12, 34, 0, 'Ttry', 'John Carlo Astoveza'),
(13, 34, 0, 'Try ulit\r\n', 'Jio Arcaaaa'),
(14, 34, 2, 'Isa pa', 'Jio Arcaaaa');

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
  `role` int(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `lastname`, `firstname`, `middleinitial`, `company`, `branch`, `department`, `email`, `contact`, `username`, `password`, `verification_status`, `role`, `created_at`) VALUES
(1, 'Antonio', 'Dello', 'Z', 'comfac', 'Mandaluyong', 'IT- MIS', 'rogaka9738@rohoza.com', '09234234233', 'aaa', '@Dar1234', 1, 0, '2024-02-08 09:05:22'),
(2, 'Arcaaaa', 'Jio', 'B', 'Example', 'Makati', 'IT- MIS', 'john@gmail.com', '09255542125', 'john.john', '123456', 1, 1, '2024-02-14 07:09:24'),
(3, 'Astoveza', 'John Carlo', 'L', 'Comfac Global Group', 'Libertad Branch', 'MIS-Department', 'laguinlinastovezajocar@gmail.com', '09773555302', 'Carlokaloykoy', 'Qwerty123', 1, 1, '2024-02-28 04:00:16');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `ticket_reply`
--
ALTER TABLE `ticket_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
