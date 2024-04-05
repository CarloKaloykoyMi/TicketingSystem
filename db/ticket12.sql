-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2024 at 09:57 AM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
