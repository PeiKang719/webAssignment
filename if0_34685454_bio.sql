-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql303.byetcluster.com
-- Generation Time: Jul 25, 2023 at 12:03 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_34685454_bio`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(7) NOT NULL,
  `password` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `location` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `about` varchar(500) NOT NULL,
  `image` mediumblob NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `password`, `username`, `name`, `location`, `email`, `phone`, `about`, `image`, `date`) VALUES
(1, 'e99a18c428cb38d5f260853678922e03', 'admin', 'Ong Pei Kang', 'Johor', 'ongpeikang57@gmail.com', '0108020466', 'I am a motivated and ambitious computer science student specializing in database management,seeking an internship opportunity as a software engineer from October 9,2023 to March 22,2024(6 months). With a strong academic background in database concepts, programming languages, and data management systems, I am eager to apply my\r\nknowledge and contribute to a dynamic work environment as a software engineer.', 0x313639303239383230385f50726573656e746174696f6e31322e6a7067, '2023-07-24 18:48:59');

-- --------------------------------------------------------

--
-- Table structure for table `bio`
--

CREATE TABLE `bio` (
  `bioID` int(7) NOT NULL,
  `name` varchar(40) NOT NULL,
  `location` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `about` varchar(500) NOT NULL,
  `image` mediumblob NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bio`
--

INSERT INTO `bio` (`bioID`, `name`, `location`, `email`, `phone`, `about`, `image`, `date`) VALUES
(9, 'Rose', 'Kuala Lumpur', 'rose@gmail.com', '0154669655', 'Im a computer science student specializing in networking in UM.', 0x313639303237373034305f696d6167657320283230292e6a706567, '2023-07-25 17:24:00'),
(10, 'Jennie', 'Penang', 'jennie@gmail.com', '0197758855', 'Im a computer science student specializing in cybersecurity in USM', 0x313639303237373132325f696d6167657320283231292e6a706567, '2023-07-25 17:25:22'),
(11, 'Shawn', 'Pahang', 'shawn@gmail.com', '0145223211', 'Im a computer science student specializing in software engineering in UMP.', 0x313639303237373137345f696d6167657320283232292e6a706567, '2023-07-25 17:26:14'),
(12, 'Benjamin', 'Melaka', 'benjamin@gmail.com', '0123456789', 'Im a computer science student specializing in artificial intelligence in UTeM.', 0x313639303239383030375f696d6167657320283139292e6a706567, '2023-07-25 23:13:27'),
(13, 'Jack', 'Sabah', 'JackABC123123@gmail.com', '0125896325', 'Im a computer science student specializing in data engineering in UMS.', 0x313639303330303730325f37353135343935622d393832642d343464322d393933312d3561386262626632373533322e6a706567, '2023-07-25 23:58:22');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedbackID` int(7) NOT NULL,
  `feedback` varchar(80) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedbackID`, `feedback`, `date`) VALUES
(5, 'Good Bio', '2023-07-25 17:19:10'),
(7, 'Good Morning!!!', '2023-07-25 23:14:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `bio`
--
ALTER TABLE `bio`
  ADD PRIMARY KEY (`bioID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedbackID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bio`
--
ALTER TABLE `bio`
  MODIFY `bioID` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedbackID` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
