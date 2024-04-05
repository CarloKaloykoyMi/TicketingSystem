-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2024 at 10:01 AM
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
(85, 39, 'Logged In', '2024-03-20 05:37:44'),
(86, 39, 'Logout', '2024-03-20 06:11:02'),
(87, 37, 'Logged In', '2024-03-20 06:12:30'),
(88, 37, 'Logout', '2024-03-20 06:34:29'),
(89, 39, 'Logged In', '2024-03-20 06:34:39'),
(90, 39, 'Logout', '2024-03-20 06:57:47'),
(91, 37, 'Logged In', '2024-03-20 06:57:52'),
(92, 37, 'Logout', '2024-03-20 06:57:58'),
(93, 39, 'Logged In', '2024-03-20 06:58:09'),
(94, 37, 'Logged In', '2024-03-21 01:17:39'),
(95, 39, 'Logged In', '2024-03-21 02:50:05'),
(96, 37, 'Logged In', '2024-03-21 02:52:47'),
(97, 37, 'Profile Picture Changed', '2024-03-21 03:02:14'),
(98, 37, 'Logout', '2024-03-21 03:02:47'),
(99, 39, 'Logged In', '2024-03-22 01:04:38'),
(100, 37, 'Logged In', '2024-03-22 01:06:30'),
(101, 39, 'Logged In', '2024-03-25 00:53:49'),
(102, 39, 'Logout', '2024-03-25 00:54:23'),
(103, 37, 'Logged In', '2024-03-25 00:55:26'),
(104, 37, 'Logout', '2024-03-25 01:01:13'),
(105, 35, 'Logged In', '2024-03-25 01:01:40'),
(106, 35, 'Logout', '2024-03-25 01:03:27'),
(107, 34, 'Logged In', '2024-03-25 01:03:58'),
(108, 39, 'Logged In', '2024-03-25 01:08:18'),
(109, 39, 'Logout', '2024-03-25 01:08:25'),
(110, 37, 'Logged In', '2024-03-25 01:08:47'),
(111, 37, 'Profile Picture Changed', '2024-03-25 01:15:46'),
(112, 37, 'Logged In', '2024-03-25 01:57:52'),
(113, 37, 'Logout', '2024-03-25 02:20:56'),
(114, 37, 'Logged In', '2024-03-25 02:20:57'),
(115, 37, 'Logout', '2024-03-25 05:42:16'),
(116, 37, 'Logged In', '2024-03-25 05:42:21'),
(117, 37, 'Logout', '2024-03-25 06:16:01'),
(118, 35, 'Logged In', '2024-03-25 06:16:17'),
(119, 37, 'Logged In', '2024-03-25 08:05:59'),
(120, 39, 'Logged In', '2024-03-25 09:19:17'),
(121, 39, 'Logout', '2024-03-25 09:19:38'),
(122, 39, 'Logged In', '2024-03-26 01:28:24'),
(123, 39, 'Logout', '2024-03-26 01:50:36'),
(124, 37, 'Logged In', '2024-03-26 01:50:41'),
(125, 37, 'Logout', '2024-03-26 01:54:42'),
(126, 40, 'Logged In', '2024-03-26 01:57:56'),
(127, 40, 'Logout', '2024-03-26 01:58:27'),
(128, 40, 'Logged In', '2024-03-26 01:58:36'),
(129, 37, 'Logged In', '2024-03-26 02:06:11'),
(130, 37, 'Logout', '2024-03-26 02:16:17'),
(131, 39, 'Logged In', '2024-03-26 02:18:33'),
(132, 39, 'Logout', '2024-03-26 02:22:26'),
(133, 37, 'Logged In', '2024-03-26 02:22:31'),
(134, 40, 'Profile Detail Edited', '2024-03-26 02:37:40'),
(135, 37, 'Logout', '2024-03-26 02:38:15'),
(136, 37, 'Logged In', '2024-03-26 02:38:16'),
(137, 37, 'Logout', '2024-03-26 02:52:18'),
(138, 37, 'Logged In', '2024-03-26 02:53:53'),
(139, 37, 'Logout', '2024-03-26 02:55:13'),
(140, 37, 'Logged In', '2024-03-26 03:03:34'),
(141, 37, 'Logout', '2024-03-26 03:03:36'),
(142, 37, 'Logged In', '2024-03-26 03:05:03'),
(143, 37, 'Logout', '2024-03-26 03:05:04'),
(144, 37, 'Logged In', '2024-03-26 03:06:03'),
(145, 37, 'Logout', '2024-03-26 03:08:52'),
(146, 37, 'Logged In', '2024-03-26 03:27:08'),
(147, 37, 'Logout', '2024-03-26 03:48:51'),
(148, 35, 'Logged In', '2024-03-26 03:49:10'),
(149, 35, 'Logged In', '2024-03-27 02:49:18'),
(150, 35, 'Logout', '2024-03-27 02:54:00'),
(151, 37, 'Logged In', '2024-03-27 03:01:54'),
(152, 41, 'Logged In', '2024-04-01 08:00:38'),
(153, 41, 'Profile Picture Changed', '2024-04-01 08:05:17'),
(154, 41, 'Profile Detail Edited', '2024-04-01 08:05:30'),
(155, 41, 'Profile Detail Edited', '2024-04-01 08:05:56'),
(156, 41, 'Profile Detail Edited', '2024-04-01 08:06:21'),
(157, 41, 'Profile Detail Edited', '2024-04-01 08:07:08'),
(158, 41, 'Logout', '2024-04-01 08:09:10'),
(159, 39, 'Logged In', '2024-04-01 08:09:49'),
(160, 39, 'Profile Detail Edited', '2024-04-01 08:15:28'),
(161, 39, 'Profile Detail Edited', '2024-04-01 08:15:34'),
(162, 39, 'Profile Detail Edited', '2024-04-01 08:15:39'),
(163, 39, 'Profile Detail Edited', '2024-04-01 08:15:54'),
(164, 39, 'Profile Detail Edited', '2024-04-01 08:15:59'),
(165, 39, 'Profile Detail Edited', '2024-04-01 08:16:11'),
(166, 39, 'Profile Detail Edited', '2024-04-01 08:16:16'),
(167, 39, 'Logout', '2024-04-01 08:24:02'),
(168, 41, 'Logged In', '2024-04-02 06:54:12'),
(169, 41, 'Logout', '2024-04-02 06:54:18'),
(170, 39, 'Logged In', '2024-04-02 06:55:36'),
(171, 39, 'Logout', '2024-04-02 07:01:50'),
(172, 42, 'Logged In', '2024-04-02 07:27:07'),
(173, 42, 'Profile Detail Edited', '2024-04-02 07:45:45'),
(174, 42, 'Logout', '2024-04-02 07:46:09'),
(175, 43, 'Logged In', '2024-04-02 07:52:06'),
(176, 43, 'Logout', '2024-04-02 07:58:33'),
(177, 39, 'Logged In', '2024-04-02 07:59:21'),
(178, 39, 'Logout', '2024-04-02 08:05:32'),
(179, 43, 'Logged In', '2024-04-02 08:06:00'),
(180, 43, 'Profile Detail Edited', '2024-04-02 08:12:03'),
(181, 43, 'Logout', '2024-04-02 08:36:13'),
(182, 39, 'Logged In', '2024-04-02 08:38:22'),
(183, 39, 'Logout', '2024-04-02 08:48:15'),
(184, 43, 'Logged In', '2024-04-02 08:48:34'),
(185, 43, 'Profile Detail Edited', '2024-04-02 08:50:34'),
(186, 43, 'Profile Detail Edited', '2024-04-02 08:55:04'),
(187, 43, 'Logout', '2024-04-02 08:55:27'),
(188, 39, 'Logged In', '2024-04-02 08:55:50'),
(189, 39, 'Profile Detail Edited', '2024-04-02 08:55:59'),
(190, 39, 'Profile Detail Edited', '2024-04-02 08:56:12'),
(191, 39, 'Logout', '2024-04-02 08:58:02'),
(192, 39, 'Logged In', '2024-04-02 08:59:11'),
(193, 39, 'Logout', '2024-04-02 09:36:07'),
(194, 39, 'Logged In', '2024-04-03 01:25:19'),
(195, 39, 'Logout', '2024-04-03 01:26:41'),
(196, 37, 'Logged In', '2024-04-03 01:26:46'),
(197, 37, 'Logout', '2024-04-03 03:12:30'),
(198, 37, 'Logged In', '2024-04-03 03:13:32'),
(199, 37, 'Logged In', '2024-04-04 07:08:53'),
(200, 37, 'Logout', '2024-04-04 07:09:25'),
(201, 39, 'Logged In', '2024-04-04 07:10:29'),
(202, 39, 'Logout', '2024-04-04 07:10:38'),
(203, 37, 'Logged In', '2024-04-04 07:14:58'),
(204, 39, 'Logged In', '2024-04-04 07:34:38'),
(205, 35, 'Logged In', '2024-04-05 02:21:13');

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
(7, 'Cornersteel Systems Corporation', 'Libertad', 'Mandaluyong City', '0945456555551', 'cornersteel@gmail.com', '2024-03-08 07:52:52'),
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
(4, 'Comfac Global Group', 'Mandaluyong City', '09656555565', 'comfac@gmail.com', '2024-02-15 02:49:02'),
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
  `message` text NOT NULL,
  `created_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `first_name`, `last_name`, `phone`, `email`, `message`, `created_at`) VALUES
(1, 'kim', 'babas', '09261518139', 'babaskim09@gmail.com', 'testing testing', ''),
(2, 'kyla marie', 'tamayo', '09773555302', 'kylamarietamayo@gmail.com', 'Can i ask questions?', ''),
(3, 'mhargielyn ', 'mineque', '09773555302', 'mhargielyn.mineque@my.jru.edu', 'testing', ''),
(4, 'John', 'Carlo', '09261518139', 'john@gmail.com', 'testing', ''),
(5, 'norman jake', 'alain', '09773555302', 'normanjakealain@gmail.com', 'testing lang', ''),
(6, 'Angelaaaaaaaaaa', 'iceee', '09232354555', 'mimasur@gmail.com', 'dsasds', '');

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
(12, 'Cornersteel Systems Corporation', 'MIS-Department', 'Jun Edmund', '3rd floor', '2024-03-20 03:02:34'),
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
(21, 37, 15, 'example.pdf'),
(22, 37, 15, 'example.docx'),
(23, 37, 16, 'example.PNG'),
(24, 40, 32, 'Jhesryl S. Gucila-Endorsement-form (F2F).pdf'),
(25, 40, 32, 'Jhesryl S. Gucila-Recommendation-Letter.pdf'),
(26, 40, 32, 'Jhesryl-S.-Gucila-Endorsement-form-F2F.pdf'),
(27, 40, 32, 'Jhesryl-S.-Gucila-Recommendation-Letter.pdf'),
(28, 40, 32, 'OJT-MOA.pdf'),
(29, 37, 34, 'WAR-WEEK 8.pdf'),
(30, 37, 34, 'WAR_Estrera (1).pdf'),
(31, 37, 34, 'JD_Estrera_EvalynGrace.jpg'),
(32, 35, 35, 'MAM_Astoveza_March.pdf'),
(33, 35, 35, 'CamScanner 04-04-2024 10.18_08.jpg'),
(34, 35, 37, 'CamScanner 04-04-2024 10.18-07.jpg'),
(35, 35, 37, 'CamScanner 04-04-2024 10.18_08.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `subject` varchar(990) NOT NULL,
  `to_company` varchar(50) NOT NULL,
  `requestor` varchar(50) NOT NULL,
  `concern` text NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `to_dept` varchar(250) NOT NULL,
  `email` varchar(50) NOT NULL,
  `to_branch` varchar(550) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `user_id`, `date`, `subject`, `to_company`, `requestor`, `concern`, `status`, `date_created`, `to_dept`, `email`, `to_branch`) VALUES
(15, 37, '2024-03-25 02:22:04.828501', 'Change Docu', 'Cornersteel Systems Corporation', 'John Carlo Astoveza', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas lectus magna, facilisis et scelerisque id, fermentum eu tellus. Pellentesque facilisis libero eget ligula volutpat, et gravida neque dictum. Sed id ullamcorper diam. Pellentesque luctus, nisl vel venenatis finibus, eros arcu maximus nisl, at euismod elit ipsum non magna. Aenean laoreet rutrum mi, ultricies varius enim lacinia sed. Maecenas tortor ante, varius at facilisis et, pulvinar ac nulla. Nulla vitae lacus at quam faucibus imperdiet. Praesent at congue orci, eget placerat mauris. Nulla facilisi. Nam varius elementum nunc quis elementum.', 'Cancelled', '2024-03-26 04:18:03', 'Accounting', 'laguinlinastovezajocar@gmail.com', ''),
(16, 37, '2024-03-25 05:21:49.511949', 'Import', 'Energy Specialist Company(ESCO)', 'John Carlo Astoveza', 'Ut ultricies viverra orci non semper. Vestibulum pretium blandit leo, in auctor diam vulputate vitae. Nam vitae lorem sed ex dignissim sagittis eu non quam. Sed aliquam enim nec ligula bibendum, non condimentum lacus accumsan. Proin dapibus justo ut metus placerat, vitae tincidunt eros pellentesque. In eget orci bibendum leo aliquam euismod.', 'Unresolved', '2024-04-03 01:29:53', 'Purchasing', 'laguinlinastovezajocar@gmail.com', ''),
(17, 37, '2024-03-25 05:43:27.132086', 'Import', 'Comfac Technology Options (CTO)', 'John Carlo Astoveza', 'Please Install', 'Resolved', '2024-04-03 01:29:26', 'System installation', 'laguinlinastovezajocar@gmail.com', ''),
(19, 37, '2024-03-25 05:53:07.427681', 'Import', 'Comfac Technology Options (CTO)', 'John Carlo Astoveza', 'aa', 'Cancelled', '2024-03-26 05:21:05', 'Purchasing', 'laguinlinastovezajocar@gmail.com', ''),
(27, 35, '2024-03-25 07:47:55.352923', 'Change the content', 'Comfac Technology Options (CTO)', 'Mhargielyn Miñeque', 'Nullam consequat massa nec tempus ultrices. Duis scelerisque lectus at quam sagittis, ut posuere velit tempor. Sed a nulla gravida, hendrerit nisl quis, iaculis massa. In hac habitasse platea dictumst. Aliquam nec pulvinar nisi. ', 'Cancelled', '2024-03-26 05:50:07', 'HR', 'mhargielyn.mineque@my.jru.edu', ''),
(34, 37, '2024-04-04 07:22:48.582058', 'Sample Presentation', 'Energy Specialist Company(ESCO)', 'John Carlo Astoveza', 'Helloo', 'Pending', '2024-04-04 07:22:48', 'HR', 'laguinlinastovezajocar@gmail.com', ''),
(35, 35, '2024-04-05 01:08:40.829557', 'change subject', '', 'Mhargielyn Miñeque', 'Test new', 'Pending', '2024-04-05 01:08:40', 'MIS-Department', 'mhargielyn.mineque@my.jru.edu', 'Libertad'),
(36, 35, '2024-04-05 01:10:33.549171', 'Test Ulit', 'Cornersteel Systems Corporation', 'Mhargielyn Miñeque', 'Test rev', 'Pending', '2024-04-05 01:10:33', 'MIS-Department', 'mhargielyn.mineque@my.jru.edu', 'Cabuyao'),
(37, 35, '2024-04-05 01:18:43.255372', 'change', 'Comfac Technology Options (CTO)', 'Mhargielyn Miñeque', 'picture', 'Pending', '2024-04-05 01:18:43', 'System installation', 'mhargielyn.mineque@my.jru.edu', 'Libertad');

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
(8, 30, 37, 'sss', 'John Carlo Astoveza'),
(9, 34, 37, 'Cancelling', 'John Carlo Astoveza'),
(10, 17, 37, 'hello', 'John Carlo Astoveza');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `lastname` varchar(191) NOT NULL,
  `firstname` varchar(191) NOT NULL,
  `middleinitial` varchar(191) NOT NULL,
  `suffix` varchar(50) NOT NULL,
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

INSERT INTO `user` (`user_id`, `lastname`, `firstname`, `middleinitial`, `suffix`, `company`, `branch`, `department`, `email`, `contact`, `username`, `password`, `verification_status`, `role`, `created_at`, `image`) VALUES
(34, 'Tamayo', 'Kyla Andrea', 'A', '', 'Comfac Technology Options (CTO)', '', 'Management Info', 'kylaandrea.tamayo@my.jru.edu', '09714414211', 'kyang', '@Qwerty123', 1, 1, '2024-03-08 07:24:04', 'user2.png'),
(35, 'Miñeque', 'Mhargielyn', 'D', '', 'Comfac Technology Options (CTO)', 'Libertad Branch', 'Management Info', 'mhargielyn.mineque@my.jru.edu', '09165255651', 'mharg', '@Qwerty123', 1, 1, '2024-03-08 07:46:49', 'user2.png'),
(37, 'Astoveza', 'John Carlo', 'L', '', 'Cornersteel Systems Corporation', 'Cabuyao', 'MIS-Department', 'laguinlinastovezajocar@gmail.com', '09773555302', 'Carlokaloykoy', '@Qwerty123', 1, 1, '2024-03-14 02:05:55', 'pexels-juan-gomez-2589650.jpg'),
(39, 'Estrera', 'Evalyn Grace', 'P', '', 'Cornersteel Systems Corporation', '', 'MIS-Department', 'estrera.evalyngrace@gmail.com', '09655662351', 'evagraceest', '@Qwerty123', 1, 0, '2024-03-20 05:37:00', 'user2.png'),
(40, 'Valen', 'Edmund', 'F', '', 'Cornersteel Systems Corporation', 'Libertad', 'MIS-Department', 'edmund@cornersteel.com', '09235877287', 'edmund', 'Comf@c123', 1, 1, '2024-03-26 01:57:09', 'user2.png'),
(42, 'Santos', 'John', '', 'Sr.', 'Comfac Global Group', 'Libertad', 'Management Info', 'mipepo5677@evimzo.com', '09565654581', 'john.santos', '@Qwerty123', 1, 1, '2024-04-02 07:26:16', 'user2.png'),
(43, 'Gonzales', 'Carlo', 'J', 'I', 'Comfac Global Group', 'Libertad', 'Purchasing', 'tefonitetu@rungel.net', '09785244451', 'carlo', '@Gawegh12', 1, 1, '2024-04-02 07:50:42', 'user2.png');

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
  MODIFY `at_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `file_attachment`
--
ALTER TABLE `file_attachment`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `ticket_reply`
--
ALTER TABLE `ticket_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
