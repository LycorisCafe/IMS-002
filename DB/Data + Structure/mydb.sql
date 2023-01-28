-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2023 at 11:28 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `regclassId` int(11) NOT NULL,
  `date_` date NOT NULL,
  `d2d` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `regclassId`, `date_`, `d2d`) VALUES
(3, 1, '2023-01-25', 1),
(4, 2, '2023-01-25', 0),
(5, 3, '2023-01-25', 0),
(9, 1, '2023-01-26', 0),
(10, 2, '2023-01-26', 1),
(11, 3, '2023-01-26', 1),
(12, 1, '2023-01-27', 1),
(13, 2, '2023-01-27', 0),
(14, 3, '2023-01-27', 1),
(15, 1, '2023-01-28', 1),
(16, 2, '2023-01-28', 1),
(17, 3, '2023-01-28', 1),
(18, 1, '2023-01-29', 0),
(19, 2, '2023-01-29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `al_year` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `time` varchar(8) NOT NULL,
  `institute` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `al_year`, `day`, `time`, `institute`, `city`) VALUES
(1, 2023, 6, '01:00 PM', 'Thigma', 'Galle'),
(2, 2024, 6, '10:00 AM', 'Thigma', 'Galle'),
(3, 2023, 7, '10:00 AM', 'Lycoris Cafe', 'Galle');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id` int(11) NOT NULL,
  `regclassID` int(11) NOT NULL,
  `date` date NOT NULL,
  `marks` int(11) NOT NULL,
  `grade` varchar(2) NOT NULL,
  `rank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`id`, `regclassID`, `date`, `marks`, `grade`, `rank`) VALUES
(1, 1, '2023-01-29', 65, 'B', 98);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastLogin` varchar(22) NOT NULL,
  `type` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `name`, `lastLogin`, `type`) VALUES
(3, 'maintainer', 'maintainer', 'Lycoris Cafe', '2023-01-29 11:09:29 AM', 'Maintainer'),
(4, 'admin', 'admin', 'Dasun Nethsara', '2023-01-29 11:16:09 PM', 'Admin'),
(5, 'user', 'user', 'Tony Stark', '2023-01-29 11:18:49 AM', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `regclassID` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `pDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `regclassID`, `year`, `month`, `status`, `pDate`) VALUES
(4, 1, 2023, 1, 1, '2023-01-29'),
(5, 2, 2023, 1, 1, '2023-01-27'),
(6, 3, 2023, 1, 0, '2023-01-26');

-- --------------------------------------------------------

--
-- Table structure for table `regclass`
--

CREATE TABLE `regclass` (
  `id` int(11) NOT NULL,
  `studentId` varchar(7) NOT NULL,
  `classId` int(11) NOT NULL,
  `attendance` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `regclass`
--

INSERT INTO `regclass` (`id`, `studentId`, `classId`, `attendance`) VALUES
(1, 'T23774', 1, 1),
(2, 'T23123', 1, 1),
(3, 'T23456', 1, 1),
(4, 'T24123', 1, 0),
(5, 'T24456', 1, 0),
(6, 'L23123', 3, 0),
(7, 'L23456', 1, 0),
(8, 'L23789', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` varchar(7) NOT NULL,
  `admissionNo` varchar(7) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `al_year` year(4) NOT NULL,
  `DOB` date NOT NULL,
  `pic` varchar(255) NOT NULL,
  `institute` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `admissionNo`, `fname`, `lname`, `al_year`, `DOB`, `pic`, `institute`) VALUES
('L23123', '1234', 'skdjcbhsdlhbh', 'ksdhncvilusdi', 2023, '2004-08-04', '', 'Lycoris Cafe'),
('L23456', '1235', 'sdhlciusdh', 'uiodfvjiodj', 2023, '2004-09-01', '', 'Thigma'),
('L23789', '1236', 'jcijmikjmnhu', 'ijmligygh', 2023, '2004-02-19', '', 'Lycoris Cafe'),
('T23123', '3220', 'lasith', 'randil', 2023, '2004-11-15', '', 'Thigma'),
('T23456', '3221', 'naveen', 'balasooriya', 2023, '2004-05-15', '', 'Thigma'),
('T23774', '3219', 'Dasun', 'Nethsara', 2023, '2004-08-19', '', 'Thigma'),
('T24123', '3310', 'kaveen', 'kalhara', 2024, '2005-08-01', '', 'Thigma'),
('T24456', '3311', 'yasod', 'layan', 2024, '2005-01-07', '', 'Thigma');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `regclassId` (`regclassId`,`date_`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `regclassID` (`regclassID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `regclassID` (`regclassID`);

--
-- Indexes for table `regclass`
--
ALTER TABLE `regclass`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studentId` (`studentId`,`classId`),
  ADD KEY `regclassId` (`classId`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `regclass`
--
ALTER TABLE `regclass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`regclassId`) REFERENCES `regclass` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_ibfk_1` FOREIGN KEY (`regclassID`) REFERENCES `regclass` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`regclassID`) REFERENCES `regclass` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `regclass`
--
ALTER TABLE `regclass`
  ADD CONSTRAINT `regclass_ibfk_1` FOREIGN KEY (`classId`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `regclass_ibfk_2` FOREIGN KEY (`studentId`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
