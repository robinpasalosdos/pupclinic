-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2024 at 09:04 AM
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
('21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `birthday` varchar(50) NOT NULL,
  `sex` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `heart_rate` varchar(50) NOT NULL,
  `oxygen` varchar(50) NOT NULL,
  `bp` varchar(50) NOT NULL,
  `temp` varchar(50) NOT NULL,
  `height` varchar(50) NOT NULL,
  `weight` varchar(50) NOT NULL,
  `bmi` varchar(50) NOT NULL,
  `assessment_access` int(11) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `created_timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `health_record`
--

CREATE TABLE `health_record` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `emergency_contact` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `civil_status` varchar(50) DEFAULT NULL,
  `college_department` varchar(100) DEFAULT NULL,
  `course_school_year` varchar(100) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `childhood_illness` varchar(255) DEFAULT NULL,
  `previous_hospitalization` varchar(3) DEFAULT NULL,
  `operation_surgery` varchar(3) DEFAULT NULL,
  `current_medications` varchar(255) DEFAULT NULL,
  `allergies` varchar(255) DEFAULT NULL,
  `family_history` varchar(255) DEFAULT NULL,
  `cigarette_smoking` varchar(3) DEFAULT NULL,
  `alcohol_drinking` varchar(3) DEFAULT NULL,
  `traveled_abroad` varchar(3) DEFAULT NULL,
  `working_impression` varchar(255) DEFAULT NULL,
  `vital_signs` varchar(20) DEFAULT NULL,
  `height` varchar(10) DEFAULT NULL,
  `weight` varchar(10) DEFAULT NULL,
  `bmi` varchar(10) DEFAULT NULL,
  `bp` varchar(10) DEFAULT NULL,
  `hr` varchar(10) DEFAULT NULL,
  `rr` varchar(10) DEFAULT NULL,
  `temp` varchar(10) DEFAULT NULL,
  `head` varchar(255) DEFAULT NULL,
  `eyes` varchar(255) DEFAULT NULL,
  `ears` varchar(255) DEFAULT NULL,
  `throat` varchar(255) DEFAULT NULL,
  `chest_lungs` varchar(255) DEFAULT NULL,
  `xray_result` varchar(20) DEFAULT NULL,
  `breast` varchar(20) DEFAULT NULL,
  `heart_murmur` varchar(10) DEFAULT NULL,
  `heart_rhythm` varchar(10) DEFAULT NULL,
  `abdomen` varchar(20) DEFAULT NULL,
  `genito_urinary` varchar(50) DEFAULT NULL,
  `extremities` varchar(20) DEFAULT NULL,
  `vertebral_column` varchar(20) DEFAULT NULL,
  `skin` varchar(255) DEFAULT NULL,
  `scars` varchar(20) DEFAULT NULL,
  `referred_to` varchar(255) DEFAULT NULL,
  `follow_up_on` varchar(50) DEFAULT NULL,
  `fit` varchar(20) DEFAULT NULL,
  `for_work_up` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `health_record`
--

INSERT INTO `health_record` (`id`, `name`, `date`, `sex`, `address`, `contact`, `emergency_contact`, `age`, `civil_status`, `college_department`, `course_school_year`, `contact_no`, `childhood_illness`, `previous_hospitalization`, `operation_surgery`, `current_medications`, `allergies`, `family_history`, `cigarette_smoking`, `alcohol_drinking`, `traveled_abroad`, `working_impression`, `vital_signs`, `height`, `weight`, `bmi`, `bp`, `hr`, `rr`, `temp`, `head`, `eyes`, `ears`, `throat`, `chest_lungs`, `xray_result`, `breast`, `heart_murmur`, `heart_rhythm`, `abdomen`, `genito_urinary`, `extremities`, `vertebral_column`, `skin`, `scars`, `referred_to`, `follow_up_on`, `fit`, `for_work_up`) VALUES
(80, 'Robin Pasalosdo', '2024-05-02', 'Malej', 'n', 'n', 'n', 87, 'n', 'n', 'n', 'n', 'none', 'no', 'no', '', '', 'others', 'no', 'no', 'no', '', 'not-in-distress', '190', '58', '16.07', '190', '58.28', '190 58.28', '190 58.28', 'none', 'none', 'none', 'none', 'none', 'normal', 'none', 'present', 'regular', 'none', '', 'none', 'normal', 'none', 'absent', 'none', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE `queue` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `heart_rate` varchar(50) NOT NULL,
  `oxygen` varchar(50) NOT NULL,
  `bp` varchar(50) NOT NULL,
  `temp` varchar(50) NOT NULL,
  `height` varchar(50) NOT NULL,
  `weight` varchar(50) NOT NULL,
  `bmi` varchar(50) NOT NULL,
  `assessment_access` int(11) NOT NULL,
  `discomfort_rate` int(11) NOT NULL,
  `created_timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `queue`
--

INSERT INTO `queue` (`id`, `user_id`, `name`, `user_type`, `heart_rate`, `oxygen`, `bp`, `temp`, `height`, `weight`, `bmi`, `assessment_access`, `discomfort_rate`, `created_timestamp`) VALUES
(90, 32, 'Robin Pasalosdo', 'faculty', '', '', '', '', '', '', '', 0, 10, '2024-05-26 02:22:51');

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `heart_rate` varchar(50) NOT NULL,
  `oxygen` varchar(50) NOT NULL,
  `bp` varchar(50) NOT NULL,
  `temp` varchar(50) NOT NULL,
  `height` varchar(50) NOT NULL,
  `weight` varchar(50) NOT NULL,
  `bmi` varchar(50) NOT NULL,
  `transaction_no` int(11) NOT NULL,
  `assessment_status` int(11) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `created_timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `user_id`, `user_type`, `name`, `email`, `heart_rate`, `oxygen`, `bp`, `temp`, `height`, `weight`, `bmi`, `transaction_no`, `assessment_status`, `date_created`, `created_timestamp`) VALUES
(31, 34, 'faculty', 'Justine Paul Canlas Serdeña', 'serdenajustinep@gmail.com', '58.28', '190 58.28', '190', '190 58.28', '190', '58', '16.07', 100001, 0, '2024-05-24', '2024-05-24 21:59:55'),
(32, 35, 'student', 'junel soliva', 'junellalissoliva@gmail.com', '58.28', '190 58.28', '190', '190 58.28', '190', '58', '16.07', 100032, 0, '2024-05-25', '2024-05-25 16:29:20'),
(33, 35, 'student', 'junel soliva', 'junellalissoliva@gmail.com', '58.28', '190 58.28', '190', '190 58.28', '190', '58', '16.07', 100033, 0, '2024-05-25', '2024-05-25 18:02:26'),
(34, 35, 'student', 'junel soliva', 'junellalissoliva@gmail.com', '58.28', '190 58.28', '190', '190 58.28', '190', '58', '16.07', 100034, 0, '2024-05-25', '2024-05-25 18:42:22'),
(35, 35, 'student', 'junel soliva', 'junellalissoliva@gmail.com', '58.28', '190 58.28', '190', '190 58.28', '190', '58', '16.07', 100035, 0, '2024-05-25', '2024-05-25 19:36:45'),
(36, 35, 'student', 'junel soliva', 'junellalissoliva@gmail.com', '58.28', '190 58.28', '190', '190 58.28', '190', '58', '16.07', 100036, 0, '2024-05-25', '2024-05-25 22:22:35'),
(37, 35, 'student', 'junel soliva', 'junellalissoliva@gmail.com', '58.28', '190 58.28', '190', '190 58.28', '190', '58', '16.07', 100037, 0, '2024-05-26', '2024-05-26 00:03:18'),
(38, 32, 'faculty', 'Robin Pasalosdo', 'robinpasalosdos@gmail.com', '58.28', '190 58.28', '190', '190 58.28', '190', '58', '16.07', 100038, 0, '2024-05-26', '2024-05-26 01:19:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `birthday` varchar(50) NOT NULL,
  `sex` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `student_no` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  `year` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `assessment_access` int(11) NOT NULL,
  `verified` int(11) NOT NULL,
  `pic` varchar(100) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `created_timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `name`, `birthday`, `sex`, `email`, `student_no`, `course`, `year`, `section`, `password`, `assessment_access`, `verified`, `pic`, `date_created`, `created_timestamp`) VALUES
(32, 'faculty', 'Robin Pasalosdo', '2111-11-11', 'Male', 'robinpasalosdos@gmail.com', '', '', '', '', '689f48f753397d7c606150b855bc4b1e', 0, 0, 'default.png', '2024-05-14', '2024-05-14 22:10:14'),
(34, 'faculty', 'Justine Paul Canlas Serdeña', '2000-08-30', 'Male', 'serdenajustinep@gmail.com', '', '', '', '', '1ee18708865728cef0c67588b76624c2', 0, 0, 'default.png', '2024-05-24', '2024-05-24 21:57:34'),
(35, 'student', 'junel soliva', '2000-02-29', 'Male', 'junellalissoliva@gmail.com', '0292929292', 'ofcourse', '2', '4', '48132e2a83087ef205588487b2e762da', 0, 0, 'junel soliva - 2024.05.24 - 04.14.47pm.jpg', '2024-05-24', '2024-05-24 22:13:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_record`
--
ALTER TABLE `health_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `queue`
--
ALTER TABLE `queue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `health_record`
--
ALTER TABLE `health_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `queue`
--
ALTER TABLE `queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
