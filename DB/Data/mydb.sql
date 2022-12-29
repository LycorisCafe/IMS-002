-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2022 at 04:06 AM
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
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `al_year`, `day`, `institute`) VALUES
(1, 2023, 6, 'Thigma');

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `name`, `lastLogin`, `type`) VALUES
(1, 'admin', 'admin', 'Dasun Nethsara', '2022-12-29 03:56', 'Admin'),
(2, 'user1', 'user1', 'Naveen Balasooriya', '2022-12-29 03:28', 'User'),
(3, 'user2', 'user2', 'Lasith Randil', '2022-12-28 10:06', 'User');

--
-- Dumping data for table `regclass`
--

INSERT INTO `regclass` (`id`, `studentId`, `classId`) VALUES
(2, 'T23774', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
