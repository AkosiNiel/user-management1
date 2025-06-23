-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3308
-- Generation Time: Jun 20, 2025 at 05:34 AM
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
-- Database: `app`
--

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `firstname`, `lastname`, `middlename`, `address`, `company`, `contact_number`, `position`, `created_at`, `updated_at`) VALUES
(1, 1, 'Easton', 'O\'Hara', 'Sadye', '582 Izabella Fork\nStantonbury, AK 42862-1412', 'Adams PLC', '09135708279', 'Financial Examiner', '2025-06-19 18:58:29', '2025-06-19 18:58:29'),
(2, 2, 'Noemi', 'Quigley', 'Trey', '45785 Kulas Parkway\nPort Hardymouth, OK 67720', 'Crooks-Stoltenberg', '09535578399', 'Government Property Inspector', '2025-06-19 18:58:29', '2025-06-19 18:58:29'),
(3, 3, 'Crawford', 'Jones', 'Toni', '807 Orrin Fort Apt. 994\nTurnerfort, WV 91525', 'Upton, Waters and Wintheiser', '09303534540', 'Library Assistant', '2025-06-19 18:58:30', '2025-06-19 18:58:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'admin',
  `status` enum('active','deactivate') NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'marilou90', 'emmitt19@example.net', '$2y$12$n5nb22rLF5oUFdMGbkIY0eQAa79z3bVcUmoAVuXj.J9xoKCQ6m9X2', 'user', 'active', NULL, '2025-06-19 18:58:29', '2025-06-19 18:58:29'),
(2, 'wolf.wava', 'hintz.joannie@example.net', '$2y$12$0/w2SNyM4a5ntch0x6pbNe/w7IQpxSqHsZwhayemsOwxRDpg7JXnC', 'user', 'deactivate', NULL, '2025-06-19 18:58:29', '2025-06-19 18:58:29'),
(3, 'admin', 'admin@admin.com', '$2y$12$bmL0UWB0qyrHMv4eSmZuQeIj6qj1SuGLbx4DNZJF4atQl6CegcK56', 'superadmin', 'active', 'a4yYgZBI4d', '2025-06-19 18:58:29', '2025-06-19 18:58:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
