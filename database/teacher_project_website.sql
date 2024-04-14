-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2024 at 12:28 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teacher_project_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `class-table`
--

CREATE TABLE `class-table` (
  `id` int(11) NOT NULL,
  `className` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class-table`
--

INSERT INTO `class-table` (`id`, `className`) VALUES
(1, 'Class I'),
(2, 'Class II'),
(3, 'Class III'),
(4, 'Class IV'),
(5, 'Class V');

-- --------------------------------------------------------

--
-- Table structure for table `contact-table`
--

CREATE TABLE `contact-table` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subject-table`
--

CREATE TABLE `subject-table` (
  `id` int(11) NOT NULL,
  `subjectName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject-table`
--

INSERT INTO `subject-table` (`id`, `subjectName`) VALUES
(1, 'Bengali'),
(2, 'English'),
(3, 'All subjects'),
(4, 'Arts'),
(5, 'Science'),
(6, 'Commerce');

-- --------------------------------------------------------

--
-- Table structure for table `teacher-bannerimg-table`
--

CREATE TABLE `teacher-bannerimg-table` (
  `id` int(11) NOT NULL,
  `teacherId` int(11) NOT NULL,
  `bannerImgPath` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher-cls-subj`
--

CREATE TABLE `teacher-cls-subj` (
  `id` int(11) NOT NULL,
  `teacherId` int(11) NOT NULL,
  `classId` int(11) NOT NULL,
  `subjectId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher-cls-subj`
--

INSERT INTO `teacher-cls-subj` (`id`, `teacherId`, `classId`, `subjectId`) VALUES
(9, 1, 1, 1),
(10, 1, 2, 5),
(11, 2, 1, 2),
(12, 2, 2, 2),
(13, 2, 3, 2),
(14, 3, 1, 3),
(15, 3, 5, 5),
(16, 3, 4, 5),
(17, 4, 2, 1),
(18, 4, 5, 4),
(19, 5, 1, 3),
(20, 5, 2, 3),
(21, 5, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `teacher-profileimage-table`
--

CREATE TABLE `teacher-profileimage-table` (
  `id` int(11) NOT NULL,
  `teacherId` int(11) NOT NULL,
  `profileImgPath` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher-table`
--

CREATE TABLE `teacher-table` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `phoneNumber` varchar(13) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `experience` varchar(255) NOT NULL DEFAULT 'Not Yet',
  `qualification` varchar(255) NOT NULL,
  `locality` varchar(255) NOT NULL,
  `mapLink` varchar(255) NOT NULL DEFAULT 'Not Provided',
  `address` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher-table`
--

INSERT INTO `teacher-table` (`id`, `firstName`, `lastName`, `phoneNumber`, `email`, `gender`, `age`, `experience`, `qualification`, `locality`, `mapLink`, `address`, `state`) VALUES
(1, 'Mayukh ', 'Chatterjee', '0123456789', 'mayukhChatterjee@gmail.com', 'Male', '28', '4', 'B.Tech', 'baguihati', 'Not Provided', 'Kolkata', 'West Bengal'),
(2, 'Rajib', 'Ghosh', '9145678912', 'RajibGhosh454@gmail.com', 'Male', '30', '10', 'Masters(English)', 'behala', 'Not Provided', '11, Biren Roy Road W, opposite CESC Distribution Station, Behala Chowrasta, Behala Industrial Estate, Paschim Barisha, Kolkata, West Bengal 700008', 'West Bengal'),
(3, 'Prabir', 'Banerjee', '9474012345', 'Prabir052@gmail.com', 'Male', '28', '4', 'PhD (Physics)', 'garia', 'Not Provided', '55, East, Sreerampur Rd, near Kavi Nazrul Metro Stn, Kolkata, West Bengal 700084', 'West Bengal'),
(4, 'Arnab', 'Mukherjee', '9153044140', 'ArnabMukherjee052@gmail.com', 'Male', '25', '2', 'Graduate', 'naihati', 'Not Provided', 'Gouripur, Garifa, Naihati, Kolkata, West Bengal 743165', 'West Bengal'),
(5, 'Aashish', 'Debnath', '9474567855', 'aashishD044@gmail.com', 'Male', '26', '3', 'B.Tech', 'newtown', 'Not Provided', 'Major Arterial Road(South-East, Biswa Bangla Sarani, AA II, Newtown, Kolkata, West Bengal 700156', 'West Bengal');

-- --------------------------------------------------------

--
-- Table structure for table `temp-teachertable`
--

CREATE TABLE `temp-teachertable` (
  `id` int(11) NOT NULL,
  `teacherId` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `phoneNumber` varchar(13) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `experience` varchar(255) NOT NULL DEFAULT 'Not Yet',
  `qualification` varchar(255) NOT NULL,
  `locality` varchar(255) NOT NULL,
  `mapLink` varchar(255) NOT NULL DEFAULT 'Not Provided',
  `address` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temp-teachertable`
--

INSERT INTO `temp-teachertable` (`id`, `teacherId`, `firstName`, `lastName`, `phoneNumber`, `email`, `gender`, `age`, `experience`, `qualification`, `locality`, `mapLink`, `address`, `state`) VALUES
(1, 1, 'Mayukh ', 'Chatterjee', '0123456789', 'mayukhChatterjee@gmail.com', 'Male', '28', '4', 'B.Tech', 'baguihati', 'https://maps.app.goo.gl/pEYoihr19M6XkgPF8', 'Kolkata', 'West Bengal');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `teacherId` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'Teacher'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `teacherId`, `username`, `password`, `role`) VALUES
(1, 1, 'mayukhChatterjee@gmail.com', 'e368b9938746fa090d6afd3628355133', 'Teacher'),
(2, 2, 'RajibGhosh454@gmail.com', 'e368b9938746fa090d6afd3628355133', 'Teacher'),
(3, 3, 'Prabir052@gmail.com', 'e368b9938746fa090d6afd3628355133', 'Teacher'),
(4, 4, 'ArnabMukherjee052@gmail.com', 'e368b9938746fa090d6afd3628355133', 'Teacher'),
(5, 5, 'aashishD044@gmail.com', 'e368b9938746fa090d6afd3628355133', 'Teacher');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class-table`
--
ALTER TABLE `class-table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact-table`
--
ALTER TABLE `contact-table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject-table`
--
ALTER TABLE `subject-table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher-bannerimg-table`
--
ALTER TABLE `teacher-bannerimg-table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher-cls-subj`
--
ALTER TABLE `teacher-cls-subj`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher-profileimage-table`
--
ALTER TABLE `teacher-profileimage-table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher-table`
--
ALTER TABLE `teacher-table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp-teachertable`
--
ALTER TABLE `temp-teachertable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class-table`
--
ALTER TABLE `class-table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact-table`
--
ALTER TABLE `contact-table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `subject-table`
--
ALTER TABLE `subject-table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `teacher-bannerimg-table`
--
ALTER TABLE `teacher-bannerimg-table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher-cls-subj`
--
ALTER TABLE `teacher-cls-subj`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `teacher-profileimage-table`
--
ALTER TABLE `teacher-profileimage-table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teacher-table`
--
ALTER TABLE `teacher-table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `temp-teachertable`
--
ALTER TABLE `temp-teachertable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
