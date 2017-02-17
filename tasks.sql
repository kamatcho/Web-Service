-- phpMyAdmin SQL Dump
-- version 4.6.5.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 15, 2017 at 07:04 PM
-- Server version: 5.6.34
-- PHP Version: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tasks`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_02_04_183957_Create_Task_Table', 1),
(4, '2017_02_04_184007_Create_Image_Table', 1),
(5, '2017_02_04_224030_Add_Time_Stamp_To_Task_Table', 2),
(6, '2017_02_04_224046_Add_Time_Stamp_To_Image_Table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `api_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(1) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `api_token`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Kamatcho', 'mohamed.phpstorm@gmail.com', '$2y$10$W7TZjGCEUIv9gD/cTIDxSexNMzMRdH/b/cGU2RcHkVhxTf682ziLG', 'AefC6v9dOUTNFLFxMxhKTS7HtnJQ1zimFRbLNVvDlcDQqsgbvLWuYeDgimJV', 1, 'waN4knjx0UciTU6nZt5Hr6UGldyZ5i3pv8pYunXJy4XNH129RVVMB8Kt8z9m', '2017-02-04 17:07:38', '2017-02-05 00:10:33'),
(3, 'Mohamed Kamatcho', 'bedo.kamatcho@gmail.com', '$2y$10$iMyGwNhj4/YsIKlWq8DUeORQ.b9TC3rIZy6ldTD2k9HBwmkMwwCBC', 'QTcQ5izB5sBWD30hDUqgtuPxZaxG5VuQqoRXeGN4erukzXe1L90SyJrFMJGx', 0, NULL, '2017-02-04 19:29:28', '2017-02-04 19:29:28'),
(7, 'Test', 'test@test.com', '$2y$10$j69gYikqYRjmjDgWAaFW2.TEC8bAedRoHVwnYG0iP30T6zS.eI3fK', 'aepW8VOqf3I6J7vPfbKj4Z1YNnyB4usOjccdQxXMnNm2tx8onwLhMuxVF7A1', 0, NULL, '2017-02-09 00:08:34', '2017-02-09 00:08:34');

-- --------------------------------------------------------

--
-- Table structure for table `user_images`
--

CREATE TABLE `user_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_images`
--

INSERT INTO `user_images` (`id`, `user_id`, `image`, `created_at`, `updated_at`) VALUES
(31, 7, '1487158073.image.jpeg', '2017-02-15 09:27:53', '2017-02-15 09:27:53'),
(32, 7, '1487164314.image.jpeg', '2017-02-15 11:11:54', '2017-02-15 11:11:54'),
(33, 7, '1487167214.image.jpeg', '2017-02-15 12:00:15', '2017-02-15 12:00:15'),
(34, 7, '1487168082.image.jpeg', '2017-02-15 12:14:42', '2017-02-15 12:14:42'),
(35, 7, '1487169023.image.jpeg', '2017-02-15 12:30:23', '2017-02-15 12:30:23');

-- --------------------------------------------------------

--
-- Table structure for table `user_tasks`
--

CREATE TABLE `user_tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `task` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_tasks`
--

INSERT INTO `user_tasks` (`id`, `user_id`, `task`, `description`, `created_at`, `updated_at`) VALUES
(1, 3, 'First Task', 'U Need To Finish BackEnd Today', '2017-02-04 20:43:03', '2017-02-04 20:53:24'),
(2, 7, 'Kamatch', 'Edit', '2017-02-09 20:10:24', '2017-02-13 07:07:42'),
(3, 7, 'Test Title', 'Test Update', '2017-02-09 20:10:24', '2017-02-13 06:52:23'),
(4, 7, 'Test', 'Tester', '2017-02-09 20:10:24', '2017-02-13 06:54:55'),
(5, 7, 'Mr.', 'c', '2017-02-09 20:10:24', '2017-02-09 20:10:24'),
(6, 7, 'Mrs.', 'c', '2017-02-09 20:10:24', '2017-02-09 20:10:24'),
(7, 7, 'Mr.', 'o', '2017-02-09 20:10:24', '2017-02-09 20:10:24'),
(8, 7, 'Ms.', 'e', '2017-02-09 20:10:24', '2017-02-09 20:10:24'),
(9, 7, 'Prof.', 'q', '2017-02-09 20:10:24', '2017-02-09 20:10:24'),
(10, 7, 'Mrs.', 'b', '2017-02-09 20:10:24', '2017-02-09 20:10:24'),
(11, 7, 'Dr.', 'b', '2017-02-09 20:10:24', '2017-02-09 20:10:24'),
(12, 7, 'Mrs.', 'e', '2017-02-09 20:10:24', '2017-02-09 20:10:24'),
(13, 7, 'Prof.', 'h', '2017-02-09 20:10:24', '2017-02-09 20:10:24'),
(14, 7, 'Miss', 'h', '2017-02-09 20:10:24', '2017-02-09 20:10:24'),
(15, 7, 'Prof.', 'a', '2017-02-09 20:10:24', '2017-02-09 20:10:24'),
(16, 7, 'Dr.', 'h', '2017-02-09 20:10:24', '2017-02-09 20:10:24'),
(17, 7, 'Mrs.', 'a', '2017-02-09 20:10:24', '2017-02-09 20:10:24'),
(18, 7, 'Prof.', 'e', '2017-02-09 20:10:24', '2017-02-09 20:10:24'),
(19, 7, 'Miss', 'p', '2017-02-09 20:10:24', '2017-02-09 20:10:24'),
(20, 7, 'Dr.', 'l', '2017-02-09 20:10:24', '2017-02-09 20:10:24'),
(21, 7, 'Dr.', 'x', '2017-02-09 20:10:24', '2017-02-09 20:10:24'),
(22, 7, 'test task', 'it\'s test task', '2017-02-13 04:41:23', '2017-02-13 04:41:23'),
(23, 7, 'test task', 'it\'s test task', '2017-02-13 04:41:50', '2017-02-13 04:41:50'),
(24, 7, 'test task title', 'test task description', '2017-02-13 04:55:57', '2017-02-13 04:55:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_images`
--
ALTER TABLE `user_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_tasks`
--
ALTER TABLE `user_tasks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user_images`
--
ALTER TABLE `user_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `user_tasks`
--
ALTER TABLE `user_tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
