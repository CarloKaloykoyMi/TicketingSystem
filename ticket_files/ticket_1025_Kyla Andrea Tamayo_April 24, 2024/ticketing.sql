-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2024 at 10:13 AM
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
  `branch_name` varchar(191) NOT NULL,
  `branch_address` varchar(191) NOT NULL,
  `contact` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `branch_name`, `branch_address`, `contact`, `email`, `created_at`) VALUES
(1, 'Libertad Branch', 'Manda', '09234234233', 'branch@gmail.com', '2024-02-12 06:10:35');

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
(1, 'Malupit', 'Manda', '9656524522', '@gmail', '2024-02-12 05:10:15'),
(2, 'Majupet Wazzap', 'Pasig', '09234234233', 'majupet@gmail.com', '2024-02-12 05:38:44'),
(3, 're', 'rew', 're', 're@gmail.com', '2024-02-14 02:12:12');

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
(1, 'MIS-Department', 'Jun edmund', '3rd Floor', '2024-02-12 06:40:50');

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
  `status` tinyint(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `lastname`, `firstname`, `middleinitial`, `company`, `branch`, `department`, `email`, `contact`, `username`, `password`, `status`, `created_at`) VALUES
(1, 'Antonio', 'Dello', 'Z', 'comfac', 'Mandaluyong', 'IT- MIS', 'rogaka9738@rohoza.com', '09234234233', 'aaa', '@Dar1234', 1, '2024-02-08 09:05:22'),
(2, 'Arcaaaa', 'Jio', 'B', 'Example', 'Makati', 'IT- MIS', 'john@gmail.com', '09255542125', 'john.john', '123456', 1, '2024-02-14 07:09:24');

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
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
