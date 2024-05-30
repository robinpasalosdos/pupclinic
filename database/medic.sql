-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2024 at 07:14 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

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
  `transaction_no` int(11) NOT NULL,
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `health_record`
--
ALTER TABLE `health_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
