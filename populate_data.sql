-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 22, 2020 at 07:34 AM
-- Server version: 10.2.30-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u707460616_accounts`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `announcement` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `announcement_index` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`announcement`, `announcement_index`) VALUES
('2/16/2020: Hello and welcome to AcaNotes! This is where we will be delivering our official announcements. As of now, the AcaNotes team is working on a payment system so that you note sharers can earn money from uploading your notes! Prices will be determined by your average ratings and by your popularity amongst your peers (as measured by number of downloads), so start earning points now by sharing your content! Until we get the payment system running, however, all content remains free.\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `a_id` int(11) NOT NULL,
  `a_title` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `a_subject` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `a_author` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `a_date` date NOT NULL,
  `a_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `a_rating` float DEFAULT NULL,
  `a_downloads` int(11) NOT NULL,
  `a_directory` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`a_id`, `a_title`, `a_subject`, `a_author`, `a_date`, `a_description`, `a_rating`, `a_downloads`, `a_directory`) VALUES
(107, '中文Paper 2《活着》与《追风筝的人》分析', 'Chinese Lang Lit', 'admin', '2020-02-16', '这是一篇有关《活着》与《追风筝的人》的Paper 2 分析', 4, 7, '107_admin_Chinese Lang Lit_中文Paper 2《活着》与《追风筝的人》分析'),
(108, 'Language as an Area of Knowledge', 'TOK', 'ealu', '2020-02-21', 'Summarizes the whole chapter on Language as an area of knowledge. It\'s also nice and bulleted :).', 4, 1, '108_ealu_TOK_Language as an Area of Knowledge'),
(109, 'Psych P1 P2 review notes', 'Psychology', 'admin', '2020-02-22', 'Psychology review notes for P1 and P2. Note that these are by no means comprehensive and should serve as a supplement.', NULL, 0, '109_admin_Psychology_Psych P1 P2 review notes'),
(110, 'Developmental Economics Paper 2 Review', 'Economics', 'admin', '2020-02-22', 'Some notes on developmental economics paper 2.', NULL, 0, '110_admin_Economics_Developmental Economics Paper '),
(111, 'Oedipus Rex Paper 2 Review', 'English Lang Lit', 'admin', '2020-02-22', 'Oedipus Rex Paper 2 Review', NULL, 0, '111_admin_English Lang Lit_Oedipus Rex Paper 2 Rev');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_first` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_last` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_pwd` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_uid` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(255) NOT NULL,
  `user_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_rating` float DEFAULT NULL,
  `user_downloads` int(255) NOT NULL,
  `user_points` int(11) NOT NULL,
  `user_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `vkey` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `createdate` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_first`, `user_last`, `user_email`, `user_pwd`, `user_uid`, `user_id`, `user_description`, `user_rating`, `user_downloads`, `user_points`, `user_title`, `vkey`, `verified`, `createdate`) VALUES
('AcaNotes', 'Admin', 'acanotes@protonmail.com', '$2y$10$EnSV4wwR9xCwJX2u8udfEuUlCxU6we.3rdGUn55vkxJhiLdTqFrYu', 'admin', 123, 'Hi! This is the AcaNotes admin account.', 4, 7, 0, 'Freshie', '4455f8173c0b5bee0920f63e2e224dd5', 1, '2020-02-16 04:55:41.253023'),
('Andrew', 'Liu', 'all2209@columbia.edu', '$2y$10$qeaizsQe/C8sPbmROeJtSe6ApM0yoDamBj6SR4C6EtkvgVIhFikl6', 'aliu1324', 124, '', NULL, 0, 0, 'Freshie', 'e6ab4a17c843ecfec75d9996c3ad050f', 1, '2020-02-16 04:57:31.850082'),
('Emma', 'Liu', 'emma.liuosm@gmail.com', '$2y$10$ZOLb5d6VzLkKhnTkMsIzbuc68gGbfu2zr5CGBcHPi9G7hbQMkL/2W', 'ealu', 125, 'A junior at ISB (International School of Beijing) in her first year of the IBDP! Here to share her ugly notes :)', 4, 1, 0, 'Freshie', 'f8f0daedc2cdd85c967c152d69de260c', 1, '2020-02-16 07:51:13.483521');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
