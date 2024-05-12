-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2024 at 07:50 AM
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
-- Database: `teacher_project_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner-image-table`
--

CREATE TABLE `banner-image-table` (
  `id` int(11) NOT NULL,
  `bannerPath` tinytext DEFAULT NULL,
  `bannerActivity` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banner-image-table`
--

INSERT INTO `banner-image-table` (`id`, `bannerPath`, `bannerActivity`) VALUES
(1, './Img/banner/443141496.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `carousel-banner-count`
--

CREATE TABLE `carousel-banner-count` (
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel-banner-count`
--

INSERT INTO `carousel-banner-count` (`count`) VALUES
(3);

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
(5, 'Class V'),
(6, 'Class VI'),
(7, 'Class VII'),
(8, 'Class VIII'),
(9, 'Class IX'),
(10, 'Class X'),
(11, 'Class XI'),
(12, 'Class XII'),
(13, 'Engineering');

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
-- Table structure for table `profile-image-table`
--

CREATE TABLE `profile-image-table` (
  `id` int(11) NOT NULL,
  `profileImagePath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile-image-table`
--

INSERT INTO `profile-image-table` (`id`, `profileImagePath`) VALUES
(1, './Img/user.png');

-- --------------------------------------------------------

--
-- Table structure for table `subject-table`
--

CREATE TABLE `subject-table` (
  `id` int(11) NOT NULL,
  `subjectName` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject-table`
--

INSERT INTO `subject-table` (`id`, `subjectName`) VALUES
(1, 'All Subjects'),
(2, 'English Literature'),
(3, 'English Language'),
(4, 'Bengali'),
(5, 'Hindi'),
(6, 'Mathematics'),
(7, 'Physics'),
(8, 'Chemistry'),
(9, 'Biology'),
(10, 'Computer Science'),
(11, 'History'),
(12, 'Geography'),
(13, 'Basic Website Development'),
(14, 'Advanced Website Development'),
(15, 'Basic Java'),
(16, 'Advanced Java'),
(17, 'C/C++'),
(18, 'Data Structure and Algorithms'),
(19, 'Python'),
(20, 'MySQL'),
(21, 'Node JS'),
(22, 'React JS');

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
(207, 1, 0, 0);

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
  `mode` varchar(255) NOT NULL,
  `locality` varchar(255) NOT NULL,
  `mapLink` varchar(255) NOT NULL DEFAULT 'Not Provided',
  `address` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `activity` tinyint(1) NOT NULL DEFAULT 1,
  `role` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher-table`
--

INSERT INTO `teacher-table` (`id`, `firstName`, `lastName`, `phoneNumber`, `email`, `gender`, `age`, `experience`, `mode`, `locality`, `mapLink`, `address`, `state`, `about`, `activity`, `role`) VALUES
(1, 'blobTech', '', '9830184239', '', '', '', '', 'Online/Offline', 'Desh Bandhu Nagar', '', 'EB-1/4, Baguihati, Kolkata 700059', 'West Bengal', '', 1, 'Institute');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'Teacher'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`) VALUES
(0, 'admin@gmail.com', '7ece99e593ff5dd200e2b9233d9ba654', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner-image-table`
--
ALTER TABLE `banner-image-table`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `profile-image-table`
--
ALTER TABLE `profile-image-table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject-table`
--
ALTER TABLE `subject-table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher-cls-subj`
--
ALTER TABLE `teacher-cls-subj`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher-table`
--
ALTER TABLE `teacher-table`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `contact-table`
--
ALTER TABLE `contact-table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profile-image-table`
--
ALTER TABLE `profile-image-table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subject-table`
--
ALTER TABLE `subject-table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `teacher-cls-subj`
--
ALTER TABLE `teacher-cls-subj`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT for table `teacher-table`
--
ALTER TABLE `teacher-table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
