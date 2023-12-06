-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2023 at 11:59 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agilni`
--

-- --------------------------------------------------------

--
-- Table structure for table `highscores`
--

CREATE TABLE `highscores` (
  `id_highscore` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `correct_answers` tinyint(4) NOT NULL DEFAULT 0,
  `incorrect_answers` tinyint(4) NOT NULL DEFAULT 0,
  `avg_time` double NOT NULL DEFAULT 0,
  `game_type` enum('add','multiply') NOT NULL,
  `game_level` enum('easy','medium','hard') NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `highscores`
--

INSERT INTO `highscores` (`id_highscore`, `id_user`, `correct_answers`, `incorrect_answers`, `avg_time`, `game_type`, `game_level`, `date_time`) VALUES
(1, 1, 4, 4, 8.17, 'add', 'hard', '2023-08-02 07:37:21'),
(2, 1, 6, 6, 6.75, 'add', 'hard', '2023-11-23 16:26:15'),
(4, 1, 4, 2, 3.41, 'add', 'medium', '2022-11-22 00:05:49'),
(5, 1, 10, 4, 9.88, 'multiply', 'easy', '2023-08-09 21:45:52'),
(6, 1, 6, 8, 9.73, 'multiply', 'hard', '2023-11-10 06:36:19'),
(7, 1, 5, 6, 1.49, 'add', 'hard', '2023-11-26 06:54:42'),
(8, 1, 0, 10, 4.49, 'multiply', 'medium', '2022-11-29 17:50:56'),
(9, 1, 1, 3, 9.41, 'multiply', 'hard', '2023-11-16 00:36:57'),
(10, 1, 2, 10, 3.38, 'multiply', 'medium', '2023-08-28 18:38:31'),
(11, 2, 0, 5, 3.13, 'add', 'easy', '2023-11-02 06:33:08'),
(12, 2, 6, 7, 1.63, 'multiply', 'easy', '2023-10-02 23:28:29'),
(13, 2, 2, 2, 3.54, 'multiply', 'easy', '2023-10-30 05:10:01'),
(14, 2, 2, 3, 9.04, 'multiply', 'medium', '2023-11-18 02:12:25'),
(15, 2, 3, 2, 1.26, 'multiply', 'medium', '2023-08-24 04:37:16'),
(16, 2, 6, 6, 5.88, 'multiply', 'medium', '2023-08-13 07:52:13'),
(17, 2, 3, 0, 3.22, 'multiply', 'hard', '2023-08-14 12:26:59'),
(18, 2, 5, 6, 6.85, 'multiply', 'medium', '2023-11-13 14:44:27'),
(19, 2, 6, 3, 1.39, 'multiply', 'easy', '2023-11-12 04:07:19'),
(20, 2, 1, 8, 6.34, 'add', 'medium', '2023-08-16 22:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(12) NOT NULL,
  `user_password` varchar(30) NOT NULL,
  `role` enum('user','admin') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `user_password`, `role`) VALUES
(1, 'perica', 'password', 'user'),
(2, 'milica', 'password', 'user'),
(7, 'admin', 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `highscores`
--
ALTER TABLE `highscores`
  ADD PRIMARY KEY (`id_highscore`),
  ADD KEY `highscores_FK` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `highscores`
--
ALTER TABLE `highscores`
  MODIFY `id_highscore` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `highscores`
--
ALTER TABLE `highscores`
  ADD CONSTRAINT `highscores_FK` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
