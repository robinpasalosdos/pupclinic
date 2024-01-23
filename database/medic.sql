-- phpMyAdmin SQL Dump
-- version 5.0.4deb2+deb11u1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 23, 2024 at 12:41 PM
-- Server version: 10.5.21-MariaDB-0+deb11u1
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medic`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`password`) VALUES
('admin');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `created_timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `name`, `email`, `password`, `date_created`, `created_timestamp`) VALUES
(1, 'robin', 'robinp', '1235', '2024-01-14', '2024-01-14 20:52:35'),
(2, 'brandon', 'brandon@gmail.com', '12345', '2024-01-14', '2024-01-14 20:53:06'),
(3, 'Robin', 'pasalosdos', '12345', '2024-01-23', '2024-01-23 09:43:19');

-- --------------------------------------------------------

--
-- Table structure for table `guest_records`
--

CREATE TABLE `guest_records` (
  `id` int(11) NOT NULL,
  `height` varchar(50) NOT NULL,
  `heart_rate` varchar(50) NOT NULL,
  `oxygen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `height` varchar(50) NOT NULL,
  `heart_rate` varchar(50) NOT NULL,
  `oxygen` varchar(50) NOT NULL,
  `transaction_no` int(11) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `created_timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `user_id`, `user_type`, `height`, `heart_rate`, `oxygen`, `transaction_no`, `date_created`, `created_timestamp`) VALUES
(1, 4, 'student', '193', '', '', 100001, '2024-01-23', '2024-01-23 04:13:26'),
(2, 4, 'student', '193', '', '', 100001, '2024-01-23', '2024-01-23 04:14:28'),
(3, 4, 'student', '194', '', '', 100001, '2024-01-23', '2024-01-23 04:16:11'),
(4, 4, 'student', '194', '', '', 100001, '2024-01-23', '2024-01-23 04:16:57'),
(5, 4, 'student', '194', '', '', 100005, '2024-01-23', '2024-01-23 04:17:53'),
(6, 4, 'student', '193', '', '', 100002, '2024-01-23', '2024-01-23 04:22:06'),
(7, 4, 'student', '189', '', '', 100007, '2024-01-23', '2024-01-23 04:28:06'),
(8, 4, 'student', '188', '189', '', 100008, '2024-01-23', '2024-01-23 04:29:14'),
(9, 4, 'student', '192', '', '', 100009, '2024-01-23', '2024-01-23 05:29:32'),
(10, 4, 'student', '194', '', '', 100010, '2024-01-23', '2024-01-23 05:29:52'),
(11, 4, 'student', '197', '115', '', 100011, '2024-01-23', '2024-01-23 06:45:19'),
(12, 3, 'faculty', '135', '136', '', 100012, '2024-01-23', '2024-01-23 09:43:51'),
(13, 1, 'student', '135', '', '', 100013, '2024-01-23', '2024-01-23 10:42:18'),
(14, 1, 'student', '136', '', '', 100014, '2024-01-23', '2024-01-23 10:45:54'),
(15, 1, 'student', '136', '', '', 100015, '2024-01-23', '2024-01-23 10:45:55'),
(16, 1, 'student', '137', '', '', 100016, '2024-01-23', '2024-01-23 10:46:10'),
(17, 2, 'student', '136', '137', '', 100017, '2024-01-23', '2024-01-23 10:47:18'),
(18, 4, 'student', '135', '136', '', 100018, '2024-01-23', '2024-01-23 11:02:35');

-- --------------------------------------------------------

--
-- Table structure for table `student_records`
--

CREATE TABLE `student_records` (
  `transaction_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `height` varchar(50) NOT NULL,
  `heart_rate` varchar(50) NOT NULL,
  `oxygen` varchar(50) NOT NULL,
  `transaction_no` varchar(50) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `created_timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_records`
--

INSERT INTO `student_records` (`transaction_id`, `id`, `height`, `heart_rate`, `oxygen`, `transaction_no`, `date_created`, `created_timestamp`) VALUES
(1, 4, '84', '', '', '', '2024-01-22', '2024-01-22 23:56:16'),
(2, 4, '84', '', '', '', '2024-01-22', '2024-01-22 23:56:16'),
(3, 4, '193', '', '', '', '2024-01-22', '2024-01-22 23:56:16'),
(4, 4, '85', '', '', '', '2024-01-22', '2024-01-22 23:56:32'),
(5, 4, '86', '', '', '', '2024-01-22', '2024-01-22 23:58:57'),
(6, 4, '118', '', '', '', '2024-01-23', '2024-01-23 00:01:07'),
(7, 4, '86', '', '', '', '2024-01-23', '2024-01-23 00:19:08'),
(8, 4, '85', '', '', '', '2024-01-23', '2024-01-23 00:21:33'),
(9, 4, '102', '', '', '', '2024-01-23', '2024-01-23 00:33:28'),
(10, 4, '196', '', '', '', '2024-01-23', '2024-01-23 01:23:22'),
(11, 4, '138', '', '', 'sefsf', '2024-01-23', '2024-01-23 01:37:33'),
(12, 4, '-1000', '', '', 'PUP346957CLI', '2024-01-23', '2024-01-23 01:39:19'),
(13, 4, '-1000', '190', '', 'PUP961876CLI', '2024-01-23', '2024-01-23 02:10:41'),
(14, 4, '-999', '', '', '100000', '2024-01-23', '2024-01-23 02:37:16'),
(15, 4, '190', '', '', '100000', '2024-01-23', '2024-01-23 02:38:29'),
(16, 4, '191', '', '', '100001', '2024-01-23', '2024-01-23 02:39:25'),
(17, 4, '183', '', '', '100002', '2024-01-23', '2024-01-23 02:44:26'),
(18, 4, '182', '', '', '100002', '2024-01-23', '2024-01-23 02:45:38'),
(19, 4, '114', '', '', '100019', '2024-01-23', '2024-01-23 02:51:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `student_no` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  `year` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `created_timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `name`, `email`, `student_no`, `course`, `year`, `section`, `password`, `date_created`, `created_timestamp`) VALUES
(1, 'student', 'robin', 'pasalosdos', '123', 'bscoe', '1', '6', '12345', '2024-01-23', '2024-01-23 10:20:17'),
(2, 'student', 'brandon', 'bustria', '123', 'bscoe', '2', '4', '', '2024-01-23', '2024-01-23 10:29:40'),
(3, 'faculty', 'robin', 'pasalosdos', '', '', '', '', '12345', '2024-01-23', '2024-01-23 10:31:22'),
(4, 'student', 'rob', 'robin', '454435', 'Bachelor of Science in Computer Engineering', '1', 'cx', '12345', '2024-01-23', '2024-01-23 11:01:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guest_records`
--
ALTER TABLE `guest_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_records`
--
ALTER TABLE `student_records`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `guest_records`
--
ALTER TABLE `guest_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `student_records`
--
ALTER TABLE `student_records`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
