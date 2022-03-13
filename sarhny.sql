-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2022 at 09:24 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sarhny`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `content` text CHARACTER SET utf8mb4 NOT NULL,
  `user` int(11) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `content`, `user`, `date_time`) VALUES
(1, 'انت مجنون اصلا', 1, '2022-03-13 19:11:03'),
(2, 'يا اهبل???', 1, '2022-03-13 19:11:03'),
(3, '🤣😂\r\n\r\nيا عبيط', 1, '2022-03-13 19:11:03'),
(5, 'dsad', 1, '2022-03-13 19:11:03'),
(7, 'جامد يجدعان 🤣❤️', 1, '2022-03-13 19:11:03'),
(8, 'dasdsd', 1, '2022-03-13 19:11:03'),
(9, 'يسشي', 1, '2022-03-13 19:11:03'),
(10, 'جاممد', 1, '2022-03-13 19:11:22'),
(11, 'dsadasd', 1, '2022-03-13 19:14:05'),
(12, 'امك قرعه 😂', 2, '2022-03-13 20:04:03'),
(13, 'امك حلوة', 2, '2022-03-13 20:09:36'),
(14, 'sadasdsad', 2, '2022-03-13 21:22:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_img` varchar(255) NOT NULL DEFAULT 'user-empty.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `profile_img`) VALUES
(1, 'youssef', 'youssef@gmail.com', '4297f44b13955235245b2497399d7a93', '8264055122222.jpg'),
(2, 'ali', 'ali@gmail.com', '4297f44b13955235245b2497399d7a93', '2761363202801.jpg'),
(3, 'aya', 'aya@gmail.com', '4297f44b13955235245b2497399d7a93', '2829305ABT860622FA55FAFFA3C9B668CC4DA2F784C5FDCC34E5306219A67FF2B230EE07CB.jfif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rec_user` (`user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `rec_user` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
