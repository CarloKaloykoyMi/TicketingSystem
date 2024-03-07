-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2024 at 10:35 AM
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
(11, 0, 'Profile Detail Edited', '2024-03-06 09:17:07'),
(12, 0, 'Profile Detail Edited', '2024-03-06 09:17:39'),
(13, 0, 'Profile Detail Edited', '2024-03-06 09:19:15'),
(14, 0, 'Profile Detail Edited', '2024-03-06 09:20:02'),
(15, 0, 'Profile Detail Edited', '2024-03-06 09:20:18'),
(16, 0, 'Profile Detail Edited', '2024-03-06 09:20:30'),
(17, 1, 'Profile Detail Edited', '2024-03-06 09:21:21'),
(18, 1, 'Logged In', '2024-03-06 09:28:30'),
(19, 1, 'Logged In', '2024-03-06 09:32:51'),
(20, 1, 'Logged In', '2024-03-06 09:33:23');

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
(3, 'aaa', 'aaa', '09865545454', 'sunoo@gmail.om', 'aaa');

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
(1, 3, 9, 'IMG_20240229_100351.jpg'),
(2, 3, 10, 'IMG_20240229_100400.jpg'),
(3, 3, 10, 'IMG_20240229_100410.jpg'),
(4, 3, 11, 'IMG_20240229_100342.jpg'),
(5, 3, 11, 'IMG_20240229_100351.jpg'),
(6, 3, 12, 'IMG_20240229_100342.jpg'),
(7, 3, 12, 'IMG_20240229_100351.jpg'),
(8, 3, 13, 'IMG_20240229_100342.jpg'),
(9, 3, 13, 'IMG_20240229_100351.jpg'),
(10, 3, 14, 'IMG_20240229_100400.jpg'),
(11, 3, 14, 'IMG_20240229_100410.jpg'),
(12, 3, 15, 'IMG_20240229_100351.jpg'),
(13, 3, 15, 'IMG_20240229_100400.jpg'),
(14, 3, 16, 'CamScanner 03-01-2024 17.13_3.jpg'),
(15, 3, 16, 'CamScanner 03-01-2024 17.13_2 (1).jpg'),
(16, 11, 17, 'CamScanner 03-01-2024 17.13_3.jpg'),
(17, 11, 17, 'CamScanner 03-01-2024 17.13_2 (1).jpg'),
(18, 11, 18, 'CamScanner 03-01-2024 17.13_3.jpg'),
(19, 11, 18, 'CamScanner 03-01-2024 17.13_2 (1).jpg'),
(20, 11, 19, 'CamScanner 03-01-2024 17.13_3.jpg'),
(21, 11, 19, 'CamScanner 03-01-2024 17.13_2 (1).jpg');

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
  `branch` varchar(50) NOT NULL,
  `department` varchar(30) NOT NULL,
  `requestor` varchar(50) NOT NULL,
  `concern` text NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `to_dept` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `user_id`, `date`, `subject`, `to_company`, `branch`, `department`, `requestor`, `concern`, `status`, `date_created`, `to_dept`) VALUES
(1, 2, '2024-03-01 02:17:10.921935', 'Hello', 'Comfac Global Group', 'Makati', 'MIS-Department', 'Jio Arcaaaa', 'lorem ipsum', 'Unresolved', '2024-03-01 06:23:24', 'Management Info'),
(2, 2, '2024-03-01 02:18:49.370088', 'Hello', 'Comfac Global Group', 'Makati', 'MIS-Department', 'Jio Arcaaaa', 'lolre', 'Pending', '2024-03-01 02:18:49', 'MIS-Department'),
(4, 2, '2024-03-01 02:29:57.185172', 'Hello', 'Comfac Technology Options (CTO)', 'Libertad Branch', 'HR', 'Jio Arcaaaa', 'adsa', 'Pending', '2024-03-01 02:29:57', 'Building Management System(BMS)'),
(5, 3, '2024-03-01 02:55:42.646548', 'Hello', 'Comfac Global Group', 'Example', 'MIS-Department', 'John Carlo Astoveza', 'exampleeee', 'Pending', '2024-03-01 02:55:42', 'Accounting'),
(6, 3, '2024-03-01 05:29:04.393577', 'Hello', 'Comfac Global Group', 'Makati', 'MIS-Department', 'John Carlo Astoveza', 'aaaa', 'Pending', '2024-03-01 05:29:04', 'HR'),
(7, 3, '2024-03-01 05:32:45.867007', 'Hello', 'Comfac Global Group', 'Makati', 'HR', 'John Carlo Astoveza', 'aasdsd', 'Resolved', '2024-03-01 06:23:32', 'Field Service'),
(8, 3, '2024-03-01 05:34:12.254238', 'Hello', 'Comfac Global Group', 'Makati', 'MIS-Department', 'John Carlo Astoveza', 'aaa', 'Pending', '2024-03-01 05:34:12', 'System Installation'),
(9, 3, '2024-03-01 05:34:51.219785', 'aasd', 'Comfac Technology Options (CTO)', 'Makati', 'HR', 'John Carlo Astoveza', 'dsads', 'Pending', '2024-03-01 05:34:51', 'Building Management System(BMS)'),
(10, 3, '2024-03-01 05:35:26.039977', 'aasd', 'Comfac Technology Options (CTO)', 'Libertad Branch', 'MIS-Department', 'John Carlo Astoveza', 'adsad', 'Pending', '2024-03-01 05:35:26', 'MIS-Department'),
(11, 3, '2024-03-01 05:48:35.315925', 'Hello', 'Comfac Technology Options (CTO)', 'Libertad Branch', 'Purchasing', 'John Carlo Astoveza', 'sds', 'Pending', '2024-03-01 05:48:35', 'Systems Mechanical'),
(12, 3, '2024-03-01 05:56:45.213309', 'Hello', 'Comfac Technology Options (CTO)', 'Makati', 'MIS-Department', 'John Carlo Astoveza', 'asdsad', 'Pending', '2024-03-01 05:56:45', 'Systems Mechanical'),
(13, 3, '2024-03-01 05:56:45.278284', 'Hello', 'Comfac Technology Options (CTO)', 'Makati', 'MIS-Department', 'John Carlo Astoveza', 'asdsad', 'Pending', '2024-03-01 05:56:45', 'Systems Mechanical'),
(14, 3, '2024-03-01 06:08:59.715734', 'Hello', 'Comfac Technology Options (CTO)', 'Libertad Branch', 'Management Info', 'John Carlo Astoveza', 'adsa', 'Pending', '2024-03-01 06:08:59', 'HR'),
(15, 3, '2024-03-01 06:12:26.975759', 'cxc', 'Comfac Technology Options (CTO)', 'Libertad Branch', 'HR', 'John Carlo Astoveza', 'fdfd', 'Pending', '2024-03-01 06:12:26', 'Field Service'),
(16, 3, '2024-03-04 00:51:54.603265', 'qaaaa', 'Comfac Global Group', '', '', 'John Carlo Astoveza', 'aaa', 'Pending', '2024-03-04 00:51:54', 'System Installation'),
(17, 11, '2024-03-04 01:39:55.477646', 'qq', 'Cornersteel Systems Corporation', '', '', 'Sunoo Kim', 'qqq', 'Pending', '2024-03-04 01:39:55', 'Accounting'),
(18, 11, '2024-03-04 01:58:52.606154', 'Change Subject', 'Comfac Global Group', '', '', 'Sunoo Kim', 'Change the document', 'Pending', '2024-03-04 01:58:52', 'HR'),
(19, 11, '2024-03-04 05:24:52.586699', 'changeee', 'Comfac Technology Options (CTO)', '', '', 'Sunoo Kim', 'aaa', 'Pending', '2024-03-04 05:24:52', 'Accounting'),
(20, 3, '2024-03-06 02:35:22.649077', 'Final Examination ', 'Comfac Technology Options (CTO)', '', '', 'John Carlo Astoveza', 'February 26, 2024 - Monday \r\n- OJT Weekly Seminar about erpnext frappe framework,sql \r\n- Added Reply to admin and fixing the front-end design\r\n- Continued THHN Wire Logging (ERPnext Item Stock) \r\nFebruary 27, 2024 - Tuesday \r\n-Cleansing the e-ticket and adding some features \r\n-Collaborate with other interns \r\nFebraury 28, 2024 - Wednesday \r\n- Fixing the error for some features \r\n- Redesign the profile settings for our e-ticketing \r\n- Collaborating in attempting to fix the ARF test sheet code \r\nFebruary 29, 2024 - Thursday\r\n - Adding delete function for completing the CRUD process of the system \r\n- fixing the file placement for file attachment feature', 'Pending', '2024-03-06 02:35:22', 'MIS-Department');

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
(14, 34, 2, 'Isa pa', 'Jio Arcaaaa'),
(15, 17, 11, '', 'Sunoo Kim'),
(16, 17, 11, 'aaa', 'Sunoo Kim'),
(17, 17, 11, 'dss', 'Sunoo Kim'),
(18, 17, 11, 'aaa', 'Sunoo Kim'),
(19, 17, 11, 'a', 'Sunoo Kim'),
(20, 17, 11, '', 'Sunoo Kim'),
(21, 17, 11, 'aaa', 'Sunoo Kim');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `lastname`, `firstname`, `middleinitial`, `company`, `branch`, `department`, `email`, `contact`, `username`, `password`, `verification_status`, `role`, `created_at`, `image`) VALUES
(1, 'Antonio', 'Dellos', 'Z', 'comfac', 'Mandaluyong', 'IT- MIS', 'rogaka9738@rohoza.com', '09234234233', 'aaa', '@Dar1234', 1, 0, '2024-02-08 09:05:22', 'aaa.jpg'),
(2, 'Example', 'Jio', 'B', 'comfac', 'Mandaluyong', 'IT- MIS', 'john@gmail.com', '09255542125', 'john.john', '123456', 1, 1, '2024-02-14 07:09:24', NULL),
(3, 'Astoveza', 'John Carlo', 'L', 'Comfac Global Group', 'Libertad Branch', 'MIS-Department', 'laguinlinastovezajocar@gmail.com', '09773555302', 'Carlokaloykoy', 'Qwerty123', 1, 1, '2024-02-28 04:00:16', 'CamScanner 02-27-2024 16.45 (2)_1.jpg'),
(10, 'wew', 'heheh', 'ah', 'Comfac Technology Options (CTO)', 'Libertad Branch', 'MIS-Department', 'darwin.puzo@my.jru.edu', '09123456789', 'HEHEHHe', '@Dar12345', 1, 1, '2024-03-01 06:59:54', NULL),
(11, 'Kim', 'Sunoo', '', 'Comfac Global Group', 'Makati', 'Systems Mechanical', 'sunoo@gmail.om', '', 'root', 'sunoo@eyy123', 1, 1, '2024-03-04 01:01:50', 'aaa.jpg');

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
  MODIFY `at_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `file_attachment`
--
ALTER TABLE `file_attachment`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ticket_reply`
--
ALTER TABLE `ticket_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
