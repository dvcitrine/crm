-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2019 at 12:22 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `citrinecrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `title`, `body`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Client One', 'Post Body', '2019-01-15 10:14:55', '2019-01-15 10:14:55', 1),
(2, 'Client  Two', 'Post Bod T==y', '2019-01-15 10:16:50', '2019-01-15 10:16:50', 1),
(3, 'Client  sdfsd', 'sdf', '2019-01-15 12:41:19', '2019-01-15 12:41:19', 1),
(5, 'User 1 Client ', '<p>User 1 post body...</p>', '2019-01-15 15:22:14', '2019-01-15 15:22:14', 1),
(6, 'User 2 Client ', '<p>User 23 Post!!!</p>', '2019-01-15 15:36:26', '2019-01-22 10:27:41', 2),
(7, 'Client ffdfghfghd', '<p>aervertvs</p>', '2019-02-03 20:11:00', '2019-02-03 20:11:00', 12),
(8, 'Tsoukalas', 'Shoes Retailer', '2019-02-04 20:19:54', '2019-02-04 20:19:54', 14);

-- --------------------------------------------------------

--
-- Table structure for table `hours`
--

CREATE TABLE `hours` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` int(11) NOT NULL,
  `minutes` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `project_code_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hours`
--

INSERT INTO `hours` (`id`, `date`, `minutes`, `description`, `created_at`, `updated_at`, `project_code_id`, `user_id`) VALUES
(1, 1548837918, 63, '', '2019-01-15 10:14:55', '2019-01-15 10:14:55', 1, 1),
(2, 1548857918, 12, '', '2019-01-15 10:16:50', '2019-01-15 10:16:50', 1, 2),
(3, 1549359752, 44, '', '2019-01-15 12:41:19', '2019-01-15 12:41:19', 1, 1),
(5, 1545359752, 75, '', '2019-01-15 15:22:14', '2019-01-15 15:22:14', 1, 1),
(6, 1542359752, 88, '', '2019-01-15 15:36:26', '2019-01-22 10:27:41', 2, 14),
(7, 1549159752, 122, '', '2019-02-03 20:11:00', '2019-02-03 20:11:00', 5, 14),
(8, 1544359752, 130, '', '2019-02-04 20:19:54', '2019-02-04 20:19:54', 8, 14),
(9, 1549319752, 35, '', '2019-02-04 21:37:57', '2019-02-04 21:37:57', 8, 14),
(10, 1549836000, 153, 'sdvsd sf.', '2019-02-11 15:37:07', '2019-02-11 15:37:07', 11, 14),
(11, 1549836000, 153, 'asdasdas', '2019-02-11 15:37:22', '2019-02-11 15:37:22', 11, 14),
(12, 1549836000, 121, 'dgdfgh ghf', '2019-02-11 15:53:01', '2019-02-11 15:53:01', 2, 2),
(13, 1550008800, 121, 'dgdfgh ghf', '2019-02-11 15:53:51', '2019-02-11 15:53:51', 2, 14),
(14, 1550008800, 61, 'sdg bb', '2019-02-11 15:54:01', '2019-02-11 15:54:01', 2, 14);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_01_15_105629_create_posts_table', 1),
(4, '2019_01_15_170220_add_user_id_to_posts', 2),
(5, '2019_01_22_123734_create_roles_table', 3),
(6, '2019_01_22_130056_create_role_user_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Post One', 'Post Body', '2019-01-15 10:14:55', '2019-01-15 10:14:55', 1),
(2, 'Post Two', 'Post Bod T==y', '2019-01-15 10:16:50', '2019-01-15 10:16:50', 1),
(3, 'sdfsd', 'sdf', '2019-01-15 12:41:19', '2019-01-15 12:41:19', 1),
(5, 'User 1 post', '<p>User 1 post body...</p>', '2019-01-15 15:22:14', '2019-01-15 15:22:14', 1),
(6, 'User 2 Post', '<p>User 23 Post!!!</p>', '2019-01-15 15:36:26', '2019-01-22 10:27:41', 2),
(7, 'ffdfghfghd', '<p>aervertvs</p>', '2019-02-03 20:11:00', '2019-02-03 20:11:00', 12);

-- --------------------------------------------------------

--
-- Table structure for table `project_codes`
--

CREATE TABLE `project_codes` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_codes`
--

INSERT INTO `project_codes` (`id`, `title`, `body`, `created_at`, `updated_at`, `client_id`, `user_id`, `service_id`, `is_active`) VALUES
(1, 'Project Code One', 'Post Body', '2019-01-15 10:14:55', '2019-01-15 10:14:55', 1, 1, 0, 0),
(2, 'Project Code  Two', 'Post Bod T==y', '2019-01-15 10:16:50', '2019-01-15 10:16:50', 3, 1, 0, 0),
(3, 'Project Code fsd', 'sdf', '2019-01-15 12:41:19', '2019-01-15 12:41:19', 1, 1, 0, 0),
(5, 'User 1 Project Code ', '<p>User 1 post body...</p>', '2019-01-15 15:22:14', '2019-01-15 15:22:14', 1, 1, 0, 0),
(6, 'User 2 Project Code ', '<p>User 23 Post!!!</p>', '2019-01-15 15:36:26', '2019-01-22 10:27:41', 2, 1, 0, 0),
(7, 'Project Code ffdfghfghd', '<p>aervertvs</p>', '2019-02-03 20:11:00', '2019-02-03 20:11:00', 5, 2, 0, 0),
(8, 'Tsoukalas Project Code ', 'Shoes Retailer', '2019-02-04 20:19:54', '2019-02-04 20:19:54', 8, 3, 0, 0),
(9, 'Tsouk234 Project Code ', 'Shoes Retailer project code', '2019-02-04 21:37:57', '2019-02-04 21:37:57', 8, 2, 0, 0),
(10, '11 Project code', '11 Project codesdgfd', '2019-02-06 14:33:06', '2019-02-06 14:33:06', 6, 14, 0, 0),
(11, 'sdfgs', 'sdfg', '2019-02-07 09:45:49', '2019-02-08 13:52:31', 7, 14, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_code_user`
--

CREATE TABLE `project_code_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_code_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_code_user`
--

INSERT INTO `project_code_user` (`id`, `project_code_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 14, NULL, NULL),
(3, 1, 2, NULL, NULL),
(4, 11, 2, NULL, NULL),
(5, 11, 3, NULL, NULL),
(6, 11, 11, NULL, NULL),
(7, 11, 14, NULL, NULL),
(8, 11, 15, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `created_at`, `updated_at`, `name`, `description`) VALUES
(1, NULL, NULL, 'admin', 'Administraotr'),
(2, NULL, NULL, 'user', 'User'),
(3, NULL, NULL, 'author', 'An Author');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `created_at`, `updated_at`, `user_id`, `role_id`) VALUES
(1, NULL, NULL, 1, 2),
(2, NULL, NULL, 2, 1),
(3, NULL, NULL, 3, 2),
(4, NULL, NULL, 11, 1),
(5, NULL, NULL, 12, 3),
(6, NULL, NULL, 13, 2),
(7, NULL, NULL, 14, 1),
(8, NULL, NULL, 15, 3),
(9, NULL, NULL, 16, 3),
(10, NULL, NULL, 17, 3),
(11, NULL, NULL, 18, 2),
(12, NULL, NULL, 19, 3),
(13, NULL, NULL, 20, 3);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_code` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `service_code`, `created_at`, `updated_at`) VALUES
(1, 'Hosting', 'HT1', '2019-02-07 20:37:45', '2019-02-07 20:48:06'),
(2, 'Website', 'WS', '2019-02-07 21:11:29', '2019-02-07 21:11:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test@test.com', NULL, '$2y$10$ELd5.uZaAntiWWC6GXZFNOeos3NIBTBLQEHBvnu1cOCjhm5SJXovG', '9mWCyfyIDtLh8xQHUfHf4fHTkRWWcS3rIODTM4WGjAc2FrXsJgo13oVwk90t', '2019-01-15 14:52:02', '2019-01-15 14:52:02'),
(2, 'User 2', 'user@wrae.com', NULL, '$2y$10$K9KE4.4DHV.GRRLKg.E4Mu//.i1wCQeUHxxpD6z3G1lBoEveDwFOm', '5VGn0wTQZeYxjuPNeK2XMeKaVseMaYvssqEMAohhFZFacfrM3EhsLpvSc0VF', '2019-01-15 15:33:22', '2019-01-15 15:33:22'),
(3, 'User 3', 'user@user.com', NULL, '$2y$10$K9KE4.4DHV.GRRLKg.E4Mu//.i1wCQeUHxxpD6z3G1lBoEveDwFOm', '5VGn0wTQZeYxjuPNeK2XMeKaVseMaYvssqEMAohhFZFacfrM3EhsLpvSc0VF', '2019-01-17 15:33:22', '2019-01-17 15:33:22'),
(11, 'zgzdaa', 'unfddorkjtuneteller@hotmail.com', NULL, '$2y$10$l/Y61ha.IKVpjvc0PkeTY.Qzv.vdsBpFTpbU1fRPEXsQpDUEqzdN6', 'OGdNSFBw96gMtf2GDr9juEu5b8NBbiNZW02oTIOgWVTlvtR6nrYLCqvkKF9b', '2019-02-03 20:02:34', '2019-02-03 20:02:34'),
(12, 'ffff', 'dddneteller@hotmail.com', NULL, '$2y$10$fgMArr1rfycSKmlt4CC9Uej0Mwyvyvmp5/4IrWAzpZP7nTvo2wZFW', NULL, '2019-02-03 20:07:36', '2019-02-03 20:07:36'),
(13, 'srbtrhbfn', 'xdzneteller@hotmail.com', NULL, '$2y$10$sSodhK5aDdm5PFNmIQTMIOQ7x/UZiNR5hKjoOcD8Oe007a9Gv4TOK', NULL, '2019-02-03 20:14:20', '2019-02-03 20:14:20'),
(14, 'fg14', 'unggfortuneteller@hotmail.com', NULL, '$2y$10$4TtLgCtOy7zgNZtHzc1AOO0/w19kFaXcBgTdJKJ0UrfbXVysl0wiu', 'f1a3EbtasT0drDoLbZt0udLMRwfsiiZHhkCpHCqJcSZYnDMlgkDsV5mdb6FP', '2019-02-04 18:02:08', '2019-02-04 18:02:08'),
(15, 'user16', 'unsggfortuneteller@hotmail.com', NULL, '$2y$10$69Ho2nDGfLZ1vr7Qz.0inOTmubNKrpAKCDbwRiQsU66LglIA4IwFC', NULL, '2019-02-04 19:10:57', '2019-02-04 19:10:57'),
(16, 'fggg', 'unsggfdfortuneteller@hotmail.com', NULL, '$2y$10$ihG5I.JXb3tGgJHYisVf0.vh40lJKXdAfiJJrAfI2FxcCex2/fJEG', NULL, '2019-02-04 19:16:00', '2019-02-04 19:16:00'),
(17, 'fggg', 'qnsggfdfortuneteller@hotmail.com', NULL, '$2y$10$vH4msZAcXiOkyk.eeiPtluhZuttkQSXGWLfCfl5AMXe52UfF42QiC', NULL, '2019-02-04 19:20:03', '2019-02-04 19:20:03'),
(18, 'fg18', 'unaggfortuneteller@hotmail.com', NULL, '$2y$10$MhMeb/5urUOcIHToTroN3uBVO09300UJrszIJ27.J2wS/ilkjBomG', NULL, '2019-02-04 19:21:35', '2019-02-04 19:21:35'),
(19, '1faggg', '1unggfortuneteller@hotmail.com', NULL, '$2y$10$mqlCnKdfd4WBJuM/6eEabOzqUBdoAIjC/TxK3Si1EshWUf5jDOuMq', NULL, '2019-02-04 19:22:02', '2019-02-04 19:22:02'),
(20, '1faggg', 'usnggfortuneteller@hotmail.com', NULL, '$2y$10$CBDmQXmWCC7gdH4v5R0GReAOHFTGkIAeUpK2mBA7Ig7.jczlLlMzG', NULL, '2019-02-04 19:23:20', '2019-02-04 19:23:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hours`
--
ALTER TABLE `hours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_codes`
--
ALTER TABLE `project_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_code_user`
--
ALTER TABLE `project_code_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hours`
--
ALTER TABLE `hours`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `project_codes`
--
ALTER TABLE `project_codes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `project_code_user`
--
ALTER TABLE `project_code_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
