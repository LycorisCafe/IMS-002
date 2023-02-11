-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2023 at 01:41 AM
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

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `regclassId`, `date_`, `d2d`) VALUES
(8, 1, '2023-02-08', 0),
(9, 2, '2023-02-08', 0),
(10, 3, '2023-02-08', 0),
(11, 4, '2023-02-08', 0),
(12, 5, '2023-02-08', 0),
(13, 6, '2023-02-08', 0),
(14, 1, '2023-02-09', 0),
(15, 2, '2023-02-09', 0),
(16, 3, '2023-02-09', 0),
(17, 4, '2023-02-09', 0);

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `al_year`, `day`, `time`, `institute`, `city`) VALUES
(1, 2023, 6, '01:00 PM', 'Thigma', 'Galle'),
(2, 2023, 7, '10:00 AM', 'Lycoris Cafe', 'Colombo'),
(4, 2024, 6, '10:00 AM', 'Thigma', 'Galle');

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`id`, `regclassID`, `date`, `marks`, `grade`, `rank`) VALUES
(4, 1, '2023-02-09', 50, 'C', 97),
(5, 1, '2023-02-10', 51, 'C', 98),
(6, 1, '2023-02-11', 67, 'B', 94),
(7, 1, '2023-02-12', 78, 'A', 64),
(8, 1, '2023-02-13', 39, 'S', 107),
(9, 1, '2023-02-14', 37, 'S', 120);

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `name`, `lastLogin`, `type`) VALUES
(1, 'maintainer', 'lycoris2004', 'Lycoris Cafe', '2023-02-14 10:26:58 PM', 'Maintainer'),
(2, 'admin', 'admin', 'Avatar Roku', '2023-02-11 12:32:02 AM', 'Admin'),
(3, 'user', 'user', 'Avatar Kiyoshi', '2023-02-09 02:36:25 AM', 'User'),
(4, 'aang', 'user', 'Avatar Aang', '', 'User');

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `regclassID`, `year`, `month`, `status`, `pDate`) VALUES
(3, 1, 2023, 2, 1, '2023-02-08'),
(4, 3, 2023, 2, 1, '2023-02-08'),
(5, 5, 2023, 2, 1, '2023-02-08'),
(6, 2, 2023, 2, 1, '2023-02-09'),
(7, 4, 2023, 2, 1, '2023-02-09');

--
-- Dumping data for table `regclass`
--

INSERT INTO `regclass` (`id`, `studentId`, `classId`, `attendance`) VALUES
(1, 'T23774', 1, 0),
(2, 'T23123', 1, 0),
(3, 'T23456', 1, 0),
(4, 'T23789', 1, 0),
(5, 'T23159', 1, 0),
(6, 'T23357', 1, 0),
(7, 'T24123', 1, 0),
(8, 'T24123', 4, 0),
(9, 'T24456', 1, 0),
(10, 'T24456', 4, 0),
(11, 'T24789', 1, 0),
(12, 'T24789', 4, 0),
(13, 'L23123', 2, 0),
(14, 'L23456', 2, 0),
(15, 'L23789', 2, 0),
(16, 'L23159', 2, 0);

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `school`, `town`, `district`) VALUES
(1, 'Christ Church Boys\' College', 'Baddegama', 'Galle'),
(2, 'St. Anthony\'s College', 'Baddegama', 'Galle');

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `admissionNo`, `fname`, `lname`, `al_year`, `scl_id`, `DOB`, `pic`, `institute`) VALUES
('L23123', '1000', 'Avishka', 'Navod', 2023, 0, '2004-10-12', '../uploads/L23123.jpg', 'Lycoris Cafe'),
('L23159', '1003', 'Yasith', 'Malinga', 2023, 0, '2004-10-18', '../uploads/L23159.jpg', 'Lycoris Cafe'),
('L23456', '1001', 'Pankaja', 'Poornajith', 2023, 0, '2004-04-17', '../uploads/L23456.jpg', 'Lycoris Cafe'),
('L23789', '1002', 'Pushpa', 'Piyumantha', 2023, 0, '2004-10-17', '../uploads/L23789.jpg', 'Lycoris Cafe'),
('T23123', '3220', 'lasith', 'randil', 2023, 0, '2004-11-15', '../uploads/T23123.jpg', 'Thigma'),
('T23159', '3224', 'wanindu', 'hasaranga', 2023, 0, '2004-08-01', '../uploads/T23159.jpg', 'Thigma'),
('T23357', '3235', 'Dhananjya', 'Lakshan', 2023, 0, '2004-03-25', '../uploads/T23357.jpg', 'Thigma'),
('T23456', '3221', 'naveen', 'balasooriya', 2023, 0, '2004-04-01', '../uploads/T23456.jpeg', 'Thigma'),
('T23774', '3319', 'Dasun', 'Nethsara', 2023, 0, '2004-08-19', '../uploads/T23774.png', 'Thigma'),
('T23789', '3223', 'janani', 'bhagya', 2023, 0, '2004-02-16', '../uploads/T23789.jpeg', 'Thigma'),
('T24123', '3210', 'Kaveen', 'Kalhara', 2024, 0, '2005-04-01', '../uploads/T24123.jpg', 'Thigma'),
('T24456', '3211', 'Yasod', 'Layan', 2024, 0, '2005-10-11', '../uploads/T24456.jpg', 'Thigma'),
('T24789', '3212', 'Yomal', 'Pahasara', 2024, 0, '2005-11-14', '', 'Thigma');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
