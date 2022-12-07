-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2022 at 08:22 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `7thsemprojectdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `lecturelinks`
--

CREATE TABLE `lecturelinks` (
  `slno` int(11) NOT NULL,
  `teacherid` int(11) NOT NULL,
  `date` date NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `video` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lecturelinks`
--

INSERT INTO `lecturelinks` (`slno`, `teacherid`, `date`, `title`, `description`, `video`) VALUES
(18, 12345, '2022-11-13', 'C programming', '', 'video/video.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `testid` int(11) NOT NULL,
  `questionid` int(11) NOT NULL,
  `question` text NOT NULL,
  `teacheranswer` text NOT NULL,
  `studentanswer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`testid`, `questionid`, `question`, `teacheranswer`, `studentanswer`) VALUES
(1, 1, 'What is C language?', 'C is a mid-level and procedural programming language. The Procedural programming language is also known as the structured programming language is a technique in which large programs are broken down into smaller modules, and each module uses structured code. This technique minimizes error and misinterpretation.', 'C is a mid-level and procedural programming language.'),
(1, 2, 'Who is the founder of C language?', 'Dennis Ritchie.', 'Dennis Ritchie.');

-- --------------------------------------------------------

--
-- Table structure for table `testdetails`
--

CREATE TABLE `testdetails` (
  `testid` int(11) NOT NULL,
  `quesnos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `testdetails`
--

INSERT INTO `testdetails` (`testid`, `quesnos`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(15) NOT NULL,
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`id`, `name`, `email`, `image`, `password`, `category`) VALUES
(12345, 'N Biraja', 'something@example.com', 'profile-picture/', 'abcde', 0),
(1905197, 'Rishabh Ranjan', '1905197@kiit.ac.in', 'profile-picture/1660201310069.jpg', 'abcde', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lecturelinks`
--
ALTER TABLE `lecturelinks`
  ADD PRIMARY KEY (`slno`);

--
-- Indexes for table `testdetails`
--
ALTER TABLE `testdetails`
  ADD PRIMARY KEY (`testid`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lecturelinks`
--
ALTER TABLE `lecturelinks`
  MODIFY `slno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `testdetails`
--
ALTER TABLE `testdetails`
  MODIFY `testid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
