-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 28, 2024 at 03:44 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `promptly`
--

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE `awards` (
  `award_id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text,
  `upvote_threshold` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `badges`
--

CREATE TABLE `badges` (
  `badge_id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text,
  `follower_threshold` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `badges`
--

INSERT INTO `badges` (`badge_id`, `name`, `description`, `follower_threshold`) VALUES
(1, 'Rising Star', 'Awarded to users with at least 50 followers.', 50),
(2, 'Influencer', 'Awarded to users with at least 100 followers.', 100),
(3, 'Celebrity', 'Awarded to users with at least 500 followers.', 500),
(4, 'Poetry Pro', 'Awarded to users whose entries have 100 or more upvotes.', 0),
(5, 'Master Poet', 'Awarded to users whose entries have 500 or more upvotes.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `entries`
--

CREATE TABLE `entries` (
  `entry_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `prompt_id` int DEFAULT NULL,
  `content` text NOT NULL,
  `upvotes` int DEFAULT '0',
  `downvotes` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `badge_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `entry_awards`
--

CREATE TABLE `entry_awards` (
  `entry_award_id` int NOT NULL,
  `entry_id` int DEFAULT NULL,
  `award_id` int DEFAULT NULL,
  `awarded_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `follow_id` int NOT NULL,
  `follower_id` int DEFAULT NULL,
  `following_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`follow_id`, `follower_id`, `following_id`, `created_at`) VALUES
(1, 2, 3, '2024-01-02 04:30:00'),
(2, 3, 2, '2024-01-02 04:45:00'),
(3, 4, 2, '2024-01-03 02:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `prompts`
--

CREATE TABLE `prompts` (
  `prompt_id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text,
  `created_by` int DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` int NOT NULL,
  `session_data` text,
  `user_id` int DEFAULT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user',
  `logged_in` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `session_data`, `user_id`, `role`, `logged_in`) VALUES
(35, '416eaabe45c11d814e9c8d363555981e542f2c5b22fb3ba2cf9d0fb32785b36f', 38, 'user', 0),
(36, '5c10793f17254163637a523566a27c69df11c58b31cbc07cbe8752b71768e218', 38, 'user', 0),
(37, 'f8bf92e8684be2f895baea62683506332a80ac17b4dd0bf930bf8b70163e5045', 37, 'user', 0),
(38, 'c516d5f0bb28f5cb02b2ce970d2a62e4c32663d08f64a1471e199a001d7acb2e', 37, 'user', 0),
(39, '72fe7fe8a38db708fa2a2bb6be299a87f794db8258cc6ab9ae731631fc498a99', 38, 'user', 0),
(40, 'd9a89fd8852f95c36f49d0652dcfba52484efe70811660065dda9d629e879711', 38, 'user', 0),
(41, 'a479eb4d671861f3382c4d35cd8ed6285aa05a48ea3c4480bb43c8fb470d6c37', 37, 'user', 0),
(42, 'a5b21d671f6e67aefd86f5192e5cf5a6866624b5f811c85af4ea1ed0f8d1e811', 40, 'user', 0),
(43, 'ddebaf275cbb0b0764d885cf6f55cd847cddea73482c40db458034e6e58e4220', 41, 'user', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `follower_count` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `email_verified_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(20) DEFAULT 'user',
  `is_verified` tinyint(1) DEFAULT '0',
  `verification_code` varchar(255) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `follower_count`, `created_at`, `email_verified_at`, `role`, `is_verified`, `verification_code`, `reset_token`, `reset_token_created_at`) VALUES
(38, 'admin', '$2y$10$o50ywcni4HMBky4SKt.skuA3ZtZG7i3CDr4II7IneltZY.97FQmQK', 'chronicallyoccurring@gmail.com', 0, '2024-11-17 09:10:39', '2024-11-18 01:10:39', 'admin', 1, NULL, NULL, NULL),
(39, 'users', '$2y$04$ly2iCiujrWM8iO9OK.0AbeMhtxyo2zPVCRfadN3gU.OMTN/ZiXEri', 'rosalyncapio88@gmail.com', 0, '2024-11-19 06:16:55', '2024-11-19 14:16:55', 'user', 1, NULL, NULL, NULL),
(41, 'rosalyn', '$2y$04$b0XP7BAjwCg7MNrbtW.QDOXie7U24KxLzYYyxRry2YkwRXihHqFbm', 'rosalyncapio8@gmail.com', 0, '2024-11-28 03:37:39', '2024-11-28 11:37:39', 'user', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_badges`
--

CREATE TABLE `user_badges` (
  `user_badge_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `badge_id` int DEFAULT NULL,
  `awarded_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_badges`
--

INSERT INTO `user_badges` (`user_badge_id`, `user_id`, `badge_id`, `awarded_at`) VALUES
(1, 1, 1, '2024-11-13 02:00:00'),
(2, 1, 2, '2024-11-15 06:30:00'),
(3, 2, 1, '2024-11-16 01:45:00'),
(4, 3, 3, '2024-11-18 03:20:00'),
(5, 3, 4, '2024-11-20 05:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `vote_id` int NOT NULL,
  `entry_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `vote_type` enum('up','down') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `awards`
--
ALTER TABLE `awards`
  ADD PRIMARY KEY (`award_id`);

--
-- Indexes for table `badges`
--
ALTER TABLE `badges`
  ADD PRIMARY KEY (`badge_id`);

--
-- Indexes for table `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`entry_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `prompt_id` (`prompt_id`);

--
-- Indexes for table `entry_awards`
--
ALTER TABLE `entry_awards`
  ADD PRIMARY KEY (`entry_award_id`),
  ADD KEY `entry_id` (`entry_id`),
  ADD KEY `award_id` (`award_id`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`follow_id`),
  ADD KEY `follower_id` (`follower_id`),
  ADD KEY `following_id` (`following_id`);

--
-- Indexes for table `prompts`
--
ALTER TABLE `prompts`
  ADD PRIMARY KEY (`prompt_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_badges`
--
ALTER TABLE `user_badges`
  ADD PRIMARY KEY (`user_badge_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `badge_id` (`badge_id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`vote_id`),
  ADD KEY `entry_id` (`entry_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `awards`
--
ALTER TABLE `awards`
  MODIFY `award_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `badges`
--
ALTER TABLE `badges`
  MODIFY `badge_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `entries`
--
ALTER TABLE `entries`
  MODIFY `entry_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `entry_awards`
--
ALTER TABLE `entry_awards`
  MODIFY `entry_award_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `follow_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prompts`
--
ALTER TABLE `prompts`
  MODIFY `prompt_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `session_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user_badges`
--
ALTER TABLE `user_badges`
  MODIFY `user_badge_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `vote_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `entries`
--
ALTER TABLE `entries`
  ADD CONSTRAINT `entries_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `entries_ibfk_2` FOREIGN KEY (`prompt_id`) REFERENCES `prompts` (`prompt_id`);

--
-- Constraints for table `entry_awards`
--
ALTER TABLE `entry_awards`
  ADD CONSTRAINT `entry_awards_ibfk_1` FOREIGN KEY (`entry_id`) REFERENCES `entries` (`entry_id`),
  ADD CONSTRAINT `entry_awards_ibfk_2` FOREIGN KEY (`award_id`) REFERENCES `awards` (`award_id`);

--
-- Constraints for table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_ibfk_1` FOREIGN KEY (`follower_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `follows_ibfk_2` FOREIGN KEY (`following_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `prompts`
--
ALTER TABLE `prompts`
  ADD CONSTRAINT `prompts_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `user_badges`
--
ALTER TABLE `user_badges`
  ADD CONSTRAINT `user_badges_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `user_badges_ibfk_2` FOREIGN KEY (`badge_id`) REFERENCES `badges` (`badge_id`);

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`entry_id`) REFERENCES `entries` (`entry_id`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
