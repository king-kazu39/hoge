-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2018 年 9 月 27 日 17:08
-- サーバのバージョン： 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `second_test`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, '健康'),
(2, 'お金'),
(3, '仕事'),
(4, '家族'),
(5, '教育'),
(6, '精神'),
(7, '楽しみ');

-- --------------------------------------------------------

--
-- テーブルの構造 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_09_24_021257_create_targets_table', 2),
(4, '2018_09_27_071300_create_categories_table', 3);

-- --------------------------------------------------------

--
-- テーブルの構造 `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `targets`
--

CREATE TABLE `targets` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `target` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `goal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `targets`
--

INSERT INTO `targets` (`id`, `user_id`, `target`, `category_id`, `goal`, `created_at`, `updated_at`) VALUES
(1, 1, 'アプリの完成', 3, '2018-09-26 21:53:38', '2018-09-23 17:30:07', '2018-09-23 17:30:07'),
(2, 1, '修論書く', 5, '2018-09-26 21:53:21', '2018-09-23 17:30:43', '2018-09-23 17:30:43'),
(3, 2, 'カジノで勝つ', 2, '2018-10-29 16:00:00', '2018-09-23 17:31:17', '2018-09-23 17:31:17'),
(5, 4, '沖縄制覇する', 3, '2018-12-30 16:00:00', '2018-09-23 19:56:45', '2018-09-23 19:56:45'),
(6, 3, '海鮮丼食べる', 7, '2018-09-26 21:53:56', '2018-09-23 19:57:20', '2018-09-23 19:57:20'),
(7, 1, 'ダイエットする', 1, '2018-10-30 16:00:00', '2018-09-26 22:40:30', '2018-09-26 22:40:30'),
(8, 5, 'ジョリビー毎日食べる', 3, '2018-09-27 03:06:15', '2018-09-27 03:06:15', '2018-09-27 03:06:15'),
(9, 4, 'タガログ語マスターする', 5, '2019-02-27 16:00:00', '2018-09-27 06:55:51', '2018-09-27 06:55:51'),
(10, 5, '結婚する', 4, '2020-03-30 16:00:00', '2018-09-27 06:59:54', '2018-09-27 06:59:54'),
(11, 3, 'お化けを怖がらない', 6, '2018-09-26 16:00:00', '2018-09-27 07:01:02', '2018-09-27 07:01:02'),
(12, 2, 'チーム引っ張る', 3, '2018-10-25 16:00:00', '2018-09-27 07:48:18', '2018-09-27 07:48:18');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `img_name`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '井上侑弥', 'yuya@gmail.com', '$2y$10$qLoeM/q3du5JTNCa8frV7ewGDS7vPGOrhvYNyxK8qtKZI/zOh5vJm', 'images/cmp-icon7.png', 'fbv064Gax127rfgHY2aXsjeOORieD282YA0e57zhXV9SdoZ7xwFjZb8ZL9LR', '2018-09-23 17:26:02', '2018-09-23 17:26:02'),
(2, '小坂興樹', 'koki@gmail.com', '$2y$10$.deUyA2t.ViLXz7ph.IY.u4US8/8GicIlYPtEC6urXv6HTvDwfOoC', 'images/wf.jpeg', '3eUhnVDnZM6KKsCYcHYzE996ZX4Q9WKyodpXtCu0s9rSXSE3FMLUzBszxWH0', '2018-09-23 19:55:12', '2018-09-23 19:55:12'),
(3, '北野千裕', 'chihiro@gmail.com', '$2y$10$PSeM9P8P0d3uelbqmDh.6ObxsMYwWTcsf2oTFRJU49HPcb0AChO3.', 'images/kaisen.jpeg', 'nqVjAKXLvlXwf4S4Caq4vvuaZpJXMwXhxSyPVIOaVAdTh9q1Sxw7yG9vy4w3', '2018-09-23 19:55:56', '2018-09-23 19:55:56'),
(4, 'かじゃ〜', 'kazuya@gmail.com', '$2y$10$XKRWgjuv0E6Df/J75aycXu/0BmZyTTzeANGgH.HOEoPv7/bnQBj2.', 'images/okinawa.jpg', 'gfjAcmjtUOno9GNMhHLmRfhyaqKvEf8rXke4WLn37aJPDKGdGzMHRk60PiWf', '2018-09-23 19:56:22', '2018-09-23 19:56:22'),
(5, '中島海', 'kai@gmail.com', '$2y$10$USwqfZvYWD70DmkHCEbSTuanC24VBW65UyQd6Dix7i2Unv59VG1OK', 'images/jol.jpeg', 'vH5ZN0UsLWOXTWLxxYEAFVNjWZYJmxd8AIH44THbv3YXHUlPb0wS3OJ4btMR', '2018-09-26 07:59:10', '2018-09-26 07:59:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
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
-- Indexes for table `targets`
--
ALTER TABLE `targets`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `targets`
--
ALTER TABLE `targets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
