-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2024 at 07:45 AM
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
(1, 'robin', 'robinpasalosdos@gmail.com', '1235', '2024-01-14', '2024-01-14 20:52:35'),
(2, 'brandon', 'brandon@gmail.com', '12345', '2024-01-14', '2024-01-14 20:53:06');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_no` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  `year` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `created_timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_no`, `name`, `course`, `year`, `section`, `email`, `password`, `date_created`, `created_timestamp`) VALUES
(1, '324234', 'dcasfc', 'dcvsd', '2', 'cx', 'c', '', '2024-01-14', '2024-01-14 20:54:23'),
(2, '324234', 'dcasfc', 'dcvsd', '2', 'cx', 'c', '', '2024-01-14', '2024-01-14 20:54:25'),
(3, '324234', 'sdfsdf', 'sdfsd', '3', 'sdfsd', 'sdfs', 'dfsd', '2024-01-14', '2024-01-14 20:54:59'),
(4, '324234', 'robin', 'Bachelor of Science in Computer Engineering', '1', 'cx', 'pasalosdos', '12345', '2024-01-14', '2024-01-14 21:25:13'),
(5, '123456', 'bonak', 'Bachelor of Science in Computer Engineering', '5', '9', 'qwertyuiop', '1234', '2024-01-14', '2024-01-14 21:40:03'),
(6, '2019-05473-MN-0', 'Justine Paul Serdena', 'Bachelor of Science in Computer Engineering', '4', '4-3', 'jasutindono@gmail.com', 'Dikoalam', '2024-01-14', '2024-01-14 22:00:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
