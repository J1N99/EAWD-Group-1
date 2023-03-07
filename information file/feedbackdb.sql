-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2023 at 07:15 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `feedbackdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL,
  `categories` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories`) VALUES
(8, 'report'),
(9, 'complain'),
(10, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `a_status` int(11) NOT NULL,
  `commentDate` date NOT NULL,
  `idea_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `user_id`, `a_status`, `commentDate`, `idea_id`, `comment`) VALUES
(1, 2, 0, '2023-03-07', 5, 'This is a comment ');

-- --------------------------------------------------------

--
-- Table structure for table `idea`
--

CREATE TABLE `idea` (
  `idea_id` int(11) NOT NULL,
  `document_url` varchar(100) NOT NULL,
  `a_status` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `closeDate` date NOT NULL,
  `finalCloseDate` date NOT NULL,
  `views` int(11) NOT NULL,
  `submitDate` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `idea`
--

INSERT INTO `idea` (`idea_id`, `document_url`, `a_status`, `categories_id`, `closeDate`, `finalCloseDate`, `views`, `submitDate`, `user_id`, `description`, `title`) VALUES
(1, 'pdf-6405fe1524ddb1.31561392.pdf', 0, 8, '0000-00-00', '0000-00-00', 0, '0000-00-00', 5, 'test', 'Table 1'),
(2, 'pdf-6405fe6cd75d90.43371750.pdf', 0, 9, '0000-00-00', '0000-00-00', 0, '2023-03-06', 5, 'Complain', 'Table 2'),
(3, '', 0, 10, '0000-00-00', '0000-00-00', 0, '2023-03-06', 5, 'Test Empty', 'Table 3'),
(4, 'pdf-64060175056090.80554375.pdf', 0, 9, '0000-00-00', '0000-00-00', 0, '2023-03-06', 5, 'Test files', 'Table 4'),
(5, 'pdf-6406087ed57de7.80537377.pdf', 0, 9, '0000-00-00', '0000-00-00', 0, '2023-03-06', 5, 'table no use', 'Table 5');

-- --------------------------------------------------------

--
-- Table structure for table `likepost`
--

CREATE TABLE `likepost` (
  `likepost_id` int(11) NOT NULL,
  `idea_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `t_up` int(11) NOT NULL,
  `t_down` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likepost`
--

INSERT INTO `likepost` (`likepost_id`, `idea_id`, `user_id`, `t_up`, `t_down`) VALUES
(1, 5, 5, 1, 0),
(2, 5, 6, 1, 0),
(3, 4, 6, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `position`, `name`, `department`, `email`, `password`) VALUES
(1, 1, 'Ang Wei Jin', 'staff', '', ''),
(5, 1, 'Chooi Chee Kean', 'staff', 'cheekean2013@gmail.com', '$2y$10$cZeewRPT.CVevunj5JgiLe0aU0COOnABu4MpYoIBSdKUcQtTDaHxG'),
(6, 1, 'Voon Chen Ning', 'staff', 'cn06@gmail.com', '$2y$10$bthRSvrCiBasixd4qgdydODo59NcOgZjesQv.hTHkFAw0e5RSeoh.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `idea`
--
ALTER TABLE `idea`
  ADD PRIMARY KEY (`idea_id`);

--
-- Indexes for table `likepost`
--
ALTER TABLE `likepost`
  ADD PRIMARY KEY (`likepost_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `idea`
--
ALTER TABLE `idea`
  MODIFY `idea_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `likepost`
--
ALTER TABLE `likepost`
  MODIFY `likepost_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
