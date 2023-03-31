-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2023 at 09:29 AM
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
(10, 'test'),
(11, 'test 3');

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
(1, 5, 0, '2023-03-07', 5, 'This is a comment '),
(2, 5, 1, '2023-03-16', 5, 'This is a new comment'),
(3, 5, 1, '2023-03-16', 5, 'This is try new coment'),
(4, 5, 0, '2023-03-18', 5, 'This is new cooment'),
(5, 5, 1, '2023-03-18', 5, 'This is another new comment');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department`) VALUES
(3, 'computer'),
(4, 'finance');

-- --------------------------------------------------------

--
-- Table structure for table `idea`
--

CREATE TABLE `idea` (
  `idea_id` int(11) NOT NULL,
  `document_url` varchar(100) NOT NULL,
  `a_status` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `submitDate` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `title_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `idea`
--

INSERT INTO `idea` (`idea_id`, `document_url`, `a_status`, `categories_id`, `views`, `submitDate`, `user_id`, `description`, `title`, `title_id`) VALUES
(1, 'pdf-6405fe1524ddb1.31561392.pdf', 0, 8, 0, '0000-00-00', 5, 'test', 'Table 1', 0),
(2, 'pdf-6405fe6cd75d90.43371750.pdf', 0, 9, 0, '2023-03-06', 5, 'Complain', 'Table 2', 0),
(3, '', 0, 10, 0, '2023-03-06', 5, 'Test Empty', 'Table 3', 0),
(4, 'pdf-64060175056090.80554375.pdf', 0, 9, 0, '2023-03-06', 5, 'Test files', 'Table 4', 0),
(5, 'pdf-6406087ed57de7.80537377.pdf', 0, 9, 85, '2023-03-06', 5, 'table no use', 'Table 5', 1),
(6, '', 1, 8, 10, '2023-03-23', 5, 'Des', 'Title', 0),
(7, '', 1, 8, 1, '2023-03-23', 5, 'Des', 'Title 3', 0),
(8, '', 1, 9, 0, '2023-03-23', 5, 'Test title id', 'Complain', 0),
(9, '', 1, 10, 0, '2023-03-23', 5, 'Test title id', 'Title', 4),
(10, '', 1, 8, 0, '2023-03-23', 5, 'Test and see', 'Test ', 4);

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
(23, 5, 3, 1, 0),
(24, 5, 5, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `title`
--

CREATE TABLE `title` (
  `title_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `closeDate` date NOT NULL,
  `finalCloseDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `title`
--

INSERT INTO `title` (`title_id`, `title`, `closeDate`, `finalCloseDate`) VALUES
(4, 'Title', '2023-03-30', '2023-05-04'),
(5, 'Test final', '2023-03-23', '2023-04-06');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `department` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `position`, `name`, `department`, `email`, `password`) VALUES
(1, 1, 'Ang Wei Jin', 0, '', ''),
(5, 1, 'Chooi Chee Kean', 0, 'cheekean2013@gmail.com', '$2y$10$cZeewRPT.CVevunj5JgiLe0aU0COOnABu4MpYoIBSdKUcQtTDaHxG'),
(6, 1, 'Voon Chen Ning', 0, 'cn06@gmail.com', '$2y$10$bthRSvrCiBasixd4qgdydODo59NcOgZjesQv.hTHkFAw0e5RSeoh.'),
(7, 1, 'Ooi Kel Vin', 3, 'mambamentality9925@gmail.com', '$2y$10$i3gpSbnvj43y2OpKeFbH9ObDHHfzswRNxdAaZSOvSvmSU3W13EyiW');

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
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

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
-- Indexes for table `title`
--
ALTER TABLE `title`
  ADD PRIMARY KEY (`title_id`);

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
  MODIFY `categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `idea`
--
ALTER TABLE `idea`
  MODIFY `idea_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `likepost`
--
ALTER TABLE `likepost`
  MODIFY `likepost_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `title`
--
ALTER TABLE `title`
  MODIFY `title_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;