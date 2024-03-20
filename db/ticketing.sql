-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2024 at 06:44 AM
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
(1, 34, 'Logged In', '2024-03-08 07:24:36'),
(2, 34, 'Logout', '2024-03-08 07:24:45'),
(3, 1, 'Logged In', '2024-03-08 07:25:52'),
(4, 1, 'Profile Detail Edited', '2024-03-08 07:26:46'),
(5, 1, 'Logout', '2024-03-08 07:27:33'),
(6, 1, 'Logged In', '2024-03-08 07:28:01'),
(7, 1, 'Logout', '2024-03-08 07:33:18'),
(8, 1, 'Logged In', '2024-03-08 07:33:35'),
(9, 1, 'Logout', '2024-03-08 07:45:24'),
(10, 35, 'Logged In', '2024-03-08 07:48:21'),
(11, 35, 'Logout', '2024-03-08 07:48:36'),
(12, 1, 'Logged In', '2024-03-08 07:48:58'),
(13, 1, 'Logout', '2024-03-08 07:57:08'),
(14, 34, 'Logged In', '2024-03-08 07:58:00'),
(15, 34, 'Logout', '2024-03-08 07:58:19'),
(16, 34, 'Logged In', '2024-03-08 07:58:42'),
(17, 35, 'Logged In', '2024-03-08 07:58:53'),
(18, 36, 'Logged In', '2024-03-11 05:45:42'),
(19, 36, 'Logout', '2024-03-11 05:46:17'),
(20, 33, 'Logged In', '2024-03-11 05:46:23'),
(21, 34, 'Logged In', '2024-03-11 05:46:50'),
(22, 34, 'Logout', '2024-03-11 05:51:15'),
(23, 34, 'Logged In', '2024-03-11 05:51:22'),
(24, 34, 'Logout', '2024-03-11 05:51:25'),
(25, 33, 'Logged In', '2024-03-11 05:51:27'),
(26, 33, 'Logout', '2024-03-11 05:51:35'),
(27, 33, 'Logged In', '2024-03-11 05:51:38'),
(28, 33, 'Logout', '2024-03-11 05:54:54'),
(29, 34, 'Logged In', '2024-03-11 05:54:58'),
(30, 34, 'Logout', '2024-03-11 06:27:20'),
(31, 34, 'Logged In', '2024-03-11 06:33:26'),
(32, 34, 'Logout', '2024-03-11 06:56:30'),
(33, 34, 'Logged In', '2024-03-11 06:56:32'),
(34, 34, 'Logout', '2024-03-11 06:57:08'),
(35, 34, 'Logged In', '2024-03-11 06:57:13'),
(36, 34, 'Logout', '2024-03-11 07:13:47'),
(37, 34, 'Logged In', '2024-03-11 07:13:49'),
(38, 35, 'Logged In', '2024-03-12 07:03:15'),
(39, 35, 'Logout', '2024-03-12 07:22:45'),
(40, 35, 'Logged In', '2024-03-12 07:23:37'),
(41, 35, 'Logout', '2024-03-12 07:45:23'),
(42, 35, 'Logged In', '2024-03-12 07:48:12'),
(43, 35, 'Logout', '2024-03-12 08:22:52'),
(44, 35, 'Logged In', '2024-03-12 08:23:25'),
(45, 1, 'Logged In', '2024-03-12 08:26:41'),
(46, 35, 'Logout', '2024-03-12 08:36:50'),
(47, 35, 'Logged In', '2024-03-12 08:37:13'),
(48, 36, 'Logged In', '2024-03-13 06:45:31'),
(49, 36, 'Logout', '2024-03-13 06:47:20'),
(50, 36, 'Logged In', '2024-03-13 06:47:32'),
(51, 1, 'Logged In', '2024-03-14 01:51:35'),
(52, 37, 'Logged In', '2024-03-14 02:06:27'),
(53, 1, 'Logged In', '2024-03-15 01:04:11'),
(54, 1, 'Logout', '2024-03-15 01:06:32'),
(55, 38, 'Logged In', '2024-03-15 01:06:48'),
(56, 38, 'Logout', '2024-03-15 01:07:13'),
(57, 38, 'Logged In', '2024-03-15 01:07:43'),
(58, 38, 'Logout', '2024-03-15 01:08:16'),
(59, 37, 'Logged In', '2024-03-15 01:08:43'),
(60, 37, 'Logged In', '2024-03-18 00:48:50'),
(61, 37, 'Logout', '2024-03-18 01:22:36'),
(62, 37, 'Logged In', '2024-03-18 01:28:10'),
(63, 37, 'Logout', '2024-03-18 01:30:55'),
(64, 37, 'Logged In', '2024-03-18 01:30:56'),
(65, 37, 'Logout', '2024-03-18 01:31:19'),
(66, 36, 'Logged In', '2024-03-18 01:32:55'),
(67, 36, 'Logout', '2024-03-18 01:34:34'),
(68, 37, 'Logged In', '2024-03-18 01:34:51'),
(69, 36, 'Logged In', '2024-03-19 05:06:05'),
(70, 37, 'Logged In', '2024-03-19 05:06:53'),
(71, 37, 'Logout', '2024-03-19 05:09:08'),
(72, 37, 'Logged In', '2024-03-19 05:10:08'),
(73, 36, 'Logged In', '2024-03-20 02:44:11'),
(74, 36, 'Profile Detail Edited', '2024-03-20 02:44:48'),
(75, 37, 'Logged In', '2024-03-20 02:45:59'),
(76, 38, 'Logged In', '2024-03-20 03:14:03'),
(77, 38, 'Logout', '2024-03-20 03:21:32'),
(78, 36, 'Logout', '2024-03-20 03:21:34'),
(79, 36, 'Logged In', '2024-03-20 03:22:24'),
(80, 38, 'Logged In', '2024-03-20 03:26:56'),
(81, 38, 'Logged In', '2024-03-20 05:34:13'),
(82, 38, 'Logout', '2024-03-20 05:34:32'),
(83, 36, 'Logged In', '2024-03-20 05:34:50'),
(84, 36, 'Logout', '2024-03-20 05:37:17'),
(85, 39, 'Logged In', '2024-03-20 05:37:44');

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
(7, 'Cornersteel Systems Corporation', 'Libertad', 'Mandaluyong', '0945456555551', 'cornersteel@gmail.com', '2024-03-08 07:52:52'),
(8, 'Comfac Global Group', 'Libertad', 'Mandaluyong', '0965655556555', 'comfac@gmail.com', '2024-03-08 07:53:27'),
(9, 'Cornersteel Systems Corporation', 'Makati', 'Makati City', '09515156555', 'cornersteelmakati@gmail.com', '2024-03-08 07:54:56'),
(10, 'Cornersteel Systems Corporation', 'Cabuyao', 'Laguna', '092535656545', 'cabuyao@gmail.com', '2024-03-08 07:55:29'),
(11, 'Energy Specialist Company(ESCO)', 'Libertad', 'Mandaluyong', '092554655465', 'libertad@gmail.com', '2024-03-08 07:56:05'),
(12, 'Comfac Technology Options (CTO)', 'Libertad', 'Mandaluyong', '092153555', 'cto@gmail.com', '2024-03-08 07:57:02');

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
(1, 'kim', 'babas', '09261518139', 'babaskim09@gmail.com', 'testing testing'),
(2, 'kyla marie', 'tamayo', '09773555302', 'kylamarietamayo@gmail.com', 'Can i ask questions?'),
(3, 'mhargielyn ', 'mineque', '09773555302', 'mhargielyn.mineque@my.jru.edu', 'testing'),
(4, 'John', 'Carlo', '09261518139', 'john@gmail.com', 'testing'),
(5, 'norman jake', 'alain', '09773555302', 'normanjakealain@gmail.com', 'testing lang');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(50) NOT NULL,
  `company` varchar(50) NOT NULL,
  `department_name` varchar(191) NOT NULL,
  `department_head` varchar(191) NOT NULL,
  `location` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `company`, `department_name`, `department_head`, `location`, `created_at`) VALUES
(12, 'Cornersteel Systems Corporation', 'MIS-Department', 'Jun Edmund', '3rd Floor', '2024-03-20 03:02:34'),
(13, 'Energy Specialist Company(ESCO)', 'Accounting', 'Peter', '3rd Floor', '2024-03-20 03:05:58'),
(14, 'Cornersteel Systems Corporation', 'HR', 'Joaquin', '2nd Floor', '2024-03-20 03:07:14'),
(15, 'Comfac Technology Options (CTO)', 'System installation', 'Rein ', '3rd Floor', '2024-03-20 03:12:42'),
(16, 'Cornersteel Systems Corporation', 'Accounting', 'Andrea', '2nd Floor', '2024-03-20 03:14:57'),
(17, 'Energy Specialist Company(ESCO)', 'HR', 'Karen', '3rd Floor', '2024-03-20 03:15:36'),
(18, 'Comfac Technology Options (CTO)', 'Purchasing', 'Kyla', '4th Floor', '2024-03-20 03:17:25'),
(19, 'Comfac Global Group', 'System Mechanical', 'Norman', '2nd Floor', '2024-03-20 03:18:13'),
(20, 'Cornersteel Systems Corporation', 'Field Service', 'Jasmin', '3rd Floor', '2024-03-20 03:19:07'),
(21, 'Energy Specialist Company(ESCO)', 'Building Management System (BMS)', 'Rommel', '2nd Floor', '2024-03-20 03:19:59'),
(22, 'Comfac Global Group', 'Management Info', 'Grace', '2nd Floor', '2024-03-20 03:20:37');

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
(1, 35, 2, 'aaaa.pdf'),
(2, 35, 2, 'Capture.PNG'),
(3, 34, 3, 'CamScanner 03-08-2024 16.22_6.jpg'),
(4, 34, 4, 'CamScanner 03-08-2024 16.22_6.jpg'),
(5, 35, 5, 'Screenshot (1).png'),
(6, 35, 6, 'Screenshot (2).png');

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
  `to_dept` varchar(250) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `user_id`, `date`, `subject`, `to_company`, `requestor`, `concern`, `status`, `date_created`, `to_dept`, `email`) VALUES
(1, 35, '2024-03-08 08:00:23.149807', 'example', 'Comfac Global Group', 'Mhargielyn Miñeque', 'lorem ipsum', 'Resolved', '2024-03-11 06:24:59', 'MIS-Department', ''),
(2, 35, '2024-03-08 08:02:12.160295', 'exampleee', 'Comfac Technology Options (CTO)', 'Mhargielyn Miñeque', 'lorefaa', 'Pending', '2024-03-12 08:45:18', 'Management Info', ''),
(3, 34, '2024-03-11 05:50:59.482337', 'example', 'Comfac Technology Options (CTO)', 'Kyla Andrea Tamayo', 'aaa', 'Unresolved', '2024-03-12 08:27:11', 'Accounting', ''),
(4, 34, '2024-03-11 06:47:15.876799', 'ZZ', 'Comfac Global Group', 'Kyla Andrea Tamayo', 'AA', 'Resolved', '2024-03-12 07:39:12', 'Management Info', ''),
(5, 35, '2024-03-12 08:53:03.868637', 'aaa', 'Comfac Global Group', 'Mhargielyn Miñeque', 'aaa', 'Pending', '2024-03-12 08:53:03', 'Accounting', ''),
(6, 35, '2024-03-12 08:53:26.403573', 'aaa', 'Comfac Technology Options (CTO)', 'Mhargielyn Miñeque', 'aaa', 'Unresolved', '2024-03-12 08:54:56', 'Management Info', 'mhargielyn.mineque@my.jru.edu');

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
(1, 3, 33, 'aaa', 'Kim Babas'),
(2, 3, 33, 'aaa', 'Kim Babas'),
(3, 2, 33, 'a', 'Kim Babas'),
(4, 2, 34, 'ddd', 'Kyla Andrea Tamayo'),
(5, 3, 34, 'yyy', 'Kyla Andrea Tamayo');

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
(33, 'Babas', 'Kim', 'M', 'Comfac Technology Options (CTO)', 'Libertad Branch', 'HR', 'regipelo@imagepoet.net', '09721515551', 'kimpoy', '@Qwerty123', 1, 1, '2024-03-08 07:21:30', 'user2.png'),
(34, 'Tamayo', 'Kyla Andrea', 'A', 'Comfac Technology Options (CTO)', 'Libertad Branch', 'Management Info', 'zoguqoma@citmo.net', '09714414211', 'kyang', '@Qwerty123', 1, 1, '2024-03-08 07:24:04', 'user2.png'),
(35, 'Miñeque', 'Mhargielyn', 'D', 'Comfac Technology Options (CTO)', 'Libertad Branch', 'Management Info', 'mhargielyn.mineque@my.jru.edu', '09165255651', 'mharg', '@Qwerty123', 1, 1, '2024-03-08 07:46:49', 'user2.png'),
(37, 'Astoveza', 'John Carlo', 'L', 'Cornersteel Systems Corporation', 'Cabuyao', 'MIS-Department', 'laguinlinastovezajocar@gmail.com', '09773555302', 'Carlokaloykoy', '@Qwerty123', 1, 1, '2024-03-14 02:05:55', 'user2.png'),
(39, 'Estrera', 'Evalyn Grace', 'P', 'Cornersteel Systems Corporation', 'Libertad', 'MIS-Department', 'estrera.evalyngrace@gmail.com', '09655662351', 'evagraceest', '@Qwerty123', 1, 0, '2024-03-20 05:37:00', 'user2.png');

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
  MODIFY `at_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `file_attachment`
--
ALTER TABLE `file_attachment`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ticket_reply`
--
ALTER TABLE `ticket_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
