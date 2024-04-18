-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2024 at 07:26 PM
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

--
-- Dumping data for table `teacher-bannerimg-table`
--

INSERT INTO `teacher-bannerimg-table` (`id`, `teacherId`, `bannerImgPath`) VALUES
(1, 7, './Img/banner/banner 2.png'),
(3, 7, './Img/banner/banner 3.png'),
(5, 7, './Img/banner/banner 1.png'),
(9, 1, './Img/banner/banner 4.png');

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
(1, 1, 1, 1),
(2, 1, 1, 3),
(3, 1, 2, 3),
(4, 1, 4, 4),
(5, 1, 5, 4),
(6, 2, 2, 2),
(7, 2, 3, 3),
(8, 2, 4, 6),
(9, 2, 5, 1),
(10, 3, 5, 1),
(11, 3, 4, 5),
(12, 3, 4, 4),
(13, 3, 2, 5),
(14, 4, 1, 1),
(15, 4, 2, 3),
(16, 5, 1, 5),
(17, 5, 2, 6),
(18, 5, 5, 6),
(19, 6, 4, 4),
(20, 6, 2, 2),
(21, 6, 3, 2),
(22, 7, 5, 6),
(23, 7, 1, 6),
(24, 7, 4, 6),
(26, 9, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `teacher-profileimage-table`
--

CREATE TABLE `teacher-profileimage-table` (
  `id` int(11) NOT NULL,
  `teacherId` int(11) NOT NULL,
  `profileImgPath` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher-profileimage-table`
--

INSERT INTO `teacher-profileimage-table` (`id`, `teacherId`, `profileImgPath`) VALUES
(3, 1, './uploads/508718472.jpg'),
(4, 2, './uploads/1990172325.jpg'),
(5, 3, './uploads/1966271404.jpg'),
(6, 5, './uploads/1463051365.jpg'),
(7, 7, './uploads/641319319.png');

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
(1, 'Bidyut', 'Kr Das', '1234567890', 'demo1@gmail.com', 'Male', '23', '1', 'Graduated', 'kankinara', 'Not Provided', 'Madral, Joychandi Tala', 'West Bengal'),
(2, 'Kingshuk', 'Sil', '0512346789', 'demo2@gmail.com', 'Male', '23', 'Not Yet', 'Diploma', 'behala', '', 'SokherBajar,Kolkata', 'West Bengal'),
(3, 'Diganta', 'Mondal', '1243567890', 'demo3@gmail.com', 'Male', '23', '1', 'Graduated', 'sector v', 'Not Provided', 'Saltlake, Kolkata', 'West Bengal'),
(4, 'Aashish', 'Kumar Choudhury', '1253467890', 'demo4@gmail.com', 'Male', '23', '1', 'MacBook Owner', 'kestopur', 'Not Provided', 'Baguihati', 'Westbengal'),
(5, 'Arnab', 'Debnath', '1235467890', 'demo5@gmail.com', 'Male', '23', '1', 'Chief Executive Officer', 'baguihati', 'Not Provided', 'Kolkata', 'West Bengal'),
(6, 'Swarnadip', 'Dasgupta', '1209345678', 'demo6@gmail.com', 'Male', '23', '1', '10+2', 'naihati', 'Not Provided', '24 Parganas(North)', 'West Bengal'),
(7, 'Akash', 'Doodeja', '1245367890', 'demo7@gmail.com', 'Male', '22', '3', 'M.Sc (Physics)', 'beldanga', 'Not Provided', 'Murshidabad', 'West Bengal'),
(9, 'Debankur', 'Das', '9234567891', 'giganigga@gmail.com', 'Male', '19', 'Not Yet', 'Sample', 'locality', '', 'Address', 'State');

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
(9, 0, 'admin@gmail.com', '7ece99e593ff5dd200e2b9233d9ba654', 'Admin'),
(11, 1, 'demo1@gmail.com', 'e368b9938746fa090d6afd3628355133', 'Teacher'),
(12, 2, 'demo2@gmail.com', '1066726e7160bd9c987c9968e0cc275a', 'Teacher'),
(13, 3, 'demo3@gmail.com', '297e430d45e7bf6f65f5dc929d6b072b', 'Teacher'),
(14, 4, 'demo4@gmail.com', '7b1312a1b3e74bb174b3fbbf68ab5a92', 'Teacher'),
(15, 5, 'demo5@gmail.com', '95346415f1f5933a78386d1759d2ef22', 'Teacher'),
(16, 6, 'demo6@gmail.com', '7aeee81cdd1d43d0f1ebf938866831e3', 'Teacher'),
(17, 7, 'demo7@gmail.com', '5961ba6c436f1eaa1ccf665316308b6a', 'Teacher'),
(18, 8, 'demo8@gmail.com', '58857ed08cd530984d1c4156b0e8022f', 'Teacher'),
(19, 9, 'giganigga@gmail.com', 'eca8bfc5e06b01a2e4b369259ac048fb', 'Teacher');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `teacher-cls-subj`
--
ALTER TABLE `teacher-cls-subj`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `teacher-profileimage-table`
--
ALTER TABLE `teacher-profileimage-table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teacher-table`
--
ALTER TABLE `teacher-table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `temp-teachertable`
--
ALTER TABLE `temp-teachertable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
