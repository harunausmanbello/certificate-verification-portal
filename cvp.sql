-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 08, 2023 at 12:27 PM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cvp`
--

-- --------------------------------------------------------

--
-- Table structure for table `bachelor`
--

CREATE TABLE `bachelor` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `grade` varchar(50) DEFAULT NULL,
  `year` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `regno` varchar(255) DEFAULT NULL,
  `refno` varchar(255) DEFAULT NULL,
  `program` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bachelor`
--

INSERT INTO `bachelor` (`id`, `fullname`, `department`, `grade`, `year`, `status`, `regno`, `refno`, `program`) VALUES
(1, 'HARUNA dff', 'CYBER SECURITY', 'First Class', '2023', 'graduate', '0086CSC2122', 'H00086', 'bachelor degree'),
(2, 'MUHAMMAD FAUWAZ HARUNA', 'COMPUTER SCIENCE', 'First Class', '2023', 'graduate', '0086CSC2120', 'R00022', 'bachelor degree');

-- --------------------------------------------------------

--
-- Table structure for table `masters`
--

CREATE TABLE `masters` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `year` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `regno` varchar(255) DEFAULT NULL,
  `refno` varchar(255) DEFAULT NULL,
  `program` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `masters`
--

INSERT INTO `masters` (`id`, `fullname`, `department`, `year`, `status`, `regno`, `refno`, `program`) VALUES
(1, 'HARUNA USMAN BELLO', 'CYBER SECURITY', '2023', 'graduate', '0086CSC2122', 'H00086', 'Masters degree'),
(2, 'Muhammad Fauwaz Haruna', 'Computer Science', '2023', 'graduate', '0086csc2120', 'R00022', 'Masters degree');

-- --------------------------------------------------------

--
-- Table structure for table `usertbl`
--

CREATE TABLE `usertbl` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `cover_img` varchar(255) DEFAULT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usertbl`
--

INSERT INTO `usertbl` (`id`, `fname`, `lname`, `username`, `password`, `email`, `phone`, `address`, `role`, `cover_img`, `profile_img`, `created_at`, `updated_at`) VALUES
(11, NULL, NULL, 'rashid', '$2y$10$tKepanZ/4SiqcLZTusvtKOy87iUHQ2PfbyXXQesfQQ9cy.ZPzLQEy', 'harunarrasheeed@gmail.com', NULL, NULL, 'admin', NULL, NULL, '2023-11-14 23:00:47', '2023-12-08 11:31:15'),
(12, NULL, NULL, 'staff', '$2y$10$v.4MChue71S9Nx5vONbwT.EZ0DD1j2N06jYNWk3QE7c4rPFExJSS.', 'harunausmanbello.16.0102@gmail.com', NULL, NULL, 'staff', NULL, NULL, '2023-12-07 23:51:26', '2023-12-07 23:51:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bachelor`
--
ALTER TABLE `bachelor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `masters`
--
ALTER TABLE `masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usertbl`
--
ALTER TABLE `usertbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bachelor`
--
ALTER TABLE `bachelor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `masters`
--
ALTER TABLE `masters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usertbl`
--
ALTER TABLE `usertbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
