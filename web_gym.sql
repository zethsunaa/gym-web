-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2025 at 08:36 PM
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
-- Database: `web_gym`
--

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `name_exercise` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `categories` varchar(50) NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `name_exercise`, `description`, `created_date`, `created_by`, `updated_date`, `updated_by`, `categories`, `img`) VALUES
(9, 'AGUMH', 'asdasd', '2025-07-17 17:07:37', 'Admin', '2025-07-17 17:23:15', 'Admin', 'back', 'back/1752772545_Certificate_Edited_Leinsky_Erlangga.jpg'),
(10, 'kontol', 'dfsdfsdf', '2025-07-17 17:12:34', 'Admin', '2025-07-17 18:31:34', 'Admin', 'chest', 'chest/1752772354_Certificate_Edited_Leinsky_Erlangga.jpg'),
(12, 'fsdfdsfs', 'fsdfdsfds', '2025-07-17 17:16:35', 'Admin', '2025-07-17 17:16:49', 'Admin', 'back', 'back/1752772609_esp32_cam_no_labels.jpeg'),
(13, 'aw', 'dsasda', '2025-07-17 17:26:30', 'Admin', '2025-07-17 17:26:40', 'Admin', 'chest', 'chest/1752773190_ChatGPT Image Jul 16, 2025, 03_55_57 PM.png'),
(14, 'ff', 'ffff', '2025-07-17 18:17:27', 'Admin', '2025-07-17 18:17:27', 'Admin', 'chest', 'chest/1752776247_Blank diagram (2).jpeg'),
(15, 'sdfdsfds', 'fdsfdsf', '2025-07-17 18:17:49', 'Admin', '2025-07-17 18:17:49', 'Admin', 'chest', 'chest/1752776269_085d4-17323161603820-1920.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`) VALUES
(6, 'leinsky', 'admin', 'aw123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `content`
--
ALTER TABLE `content`
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
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
