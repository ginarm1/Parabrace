-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2021 at 08:00 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parabrace`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `intro` mediumtext NOT NULL,
  `text` text NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `name`, `intro`, `text`, `image`, `created_at`, `updated_at`) VALUES
(1, 'About paracord', 'Parachute cord (also paracord or 550 cord when referring to type-III paracord) is a lightweight nylon kernmantle rope originally used in the suspension lines of parachutes. This cord is now used as a general purpose utility cord. This versatile cord was used by astronauts during the 82nd Space Shuttle mission to repair the Hubble Space Telescope.', 'Parachute cord (also paracord or 550 cord when referring to type-III paracord) is a lightweight nylon kernmantle rope originally used in the suspension lines of parachutes. This cord is now used as a general purpose utility cord. This versatile cord was used by astronauts during the 82nd Space Shuttle mission to repair the Hubble Space Telescope.\r\n\r\nThis cord is now used as a general purpose utility cord. This versatile cord was used by astronauts during the 82nd Space Shuttle mission to repair the Hubble Space Telescope.', 'paracord-rope.png', '2020-11-30 15:00:15', NULL),
(3, 'Spot fake paracord', 'There are a few indicators. The original military-approved paracord manufacturers included a single color-coded strand in the filament; the colors indicated the manufacturer:', 'But paracord can still meet the military specification without having the color-coded filament. In this case, look for the number of strands in the filament. For 550 cord, there should be 7-9 inner strands, each of them made up of three twisted strands.\r\n\r\nAnd most of all, look for “Mil-Spec” on the packaging or, better yet, “MIL-C-5040H” (a reference to the military specification that defines paracord requirements).', 'paracord-fake.jpg', '2020-11-30 15:11:28', '2020-12-05 14:14:55'),
(4, 'Kaip investuoti', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.', 'Lorem Ipsum comes from sections \r\n1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', NULL, '2020-11-30 15:37:58', '2020-12-05 12:49:13'),
(5, 'From zero to survivor', 'The story how I survived in the forest.', 'Here I am talking, how I used knife for cutting wood, hunting some animals, builder shelter and some stuff.', NULL, '2020-11-30 20:13:36', '2020-11-30 20:13:36');

-- --------------------------------------------------------

--
-- Table structure for table `article_partner`
--

CREATE TABLE `article_partner` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `article_id` bigint(20) UNSIGNED NOT NULL,
  `partner_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article_partner`
--

INSERT INTO `article_partner` (`id`, `article_id`, `partner_id`, `created_at`, `updated_at`) VALUES
(7, 1, 2, '2020-12-07 11:01:41', '2020-12-07 11:01:41'),
(12, 4, 1, '2020-12-08 14:23:33', '2020-12-08 14:23:33'),
(13, 16, 2, '2020-12-15 13:20:46', '2020-12-15 13:20:46'),
(14, 17, 1, '2020-12-15 14:03:17', '2020-12-15 14:03:17'),
(18, 3, 1, '2020-12-21 14:13:26', '2020-12-21 14:13:26'),
(20, 18, 1, '2021-01-29 11:47:35', '2021-01-29 11:47:35');

-- --------------------------------------------------------

--
-- Table structure for table `bracelets`
--

CREATE TABLE `bracelets` (
  `id` int(3) NOT NULL,
  `name` varchar(40) NOT NULL,
  `on_stock_quantity` int(3) NOT NULL,
  `cost` float NOT NULL,
  `lower_cost` float DEFAULT NULL,
  `sold_quantity` int(8) NOT NULL DEFAULT 0,
  `image` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Information about bracelets';

--
-- Dumping data for table `bracelets`
--

INSERT INTO `bracelets` (`id`, `name`, `on_stock_quantity`, `cost`, `lower_cost`, `sold_quantity`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Lithuanian', 8, 8.99, 6.99, 1, 'lithuanian.jpg', '2020-12-01 16:03:54', '2021-02-22 15:58:55'),
(2, 'Brown & Yellow', 2, 7.99, NULL, 1, 'brown-yellow.jpg', '2020-12-01 16:04:06', '2021-02-21 16:28:10'),
(4, 'Brown', 3, 7.99, NULL, 2, 'brown.jpg', '2020-12-01 16:04:19', '2021-02-22 09:21:45'),
(5, 'Black & White', 8, 6.99, NULL, 0, 'black-white.png', '2020-12-02 16:04:27', '2020-12-02 16:04:27'),
(11, 'Red and green', 4, 5.99, NULL, 6, 'red-green.jpg', '2020-12-05 21:02:14', '2021-02-22 15:58:55');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(4) NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(4) NOT NULL,
  `cost` double(10,2) NOT NULL,
  `sold` tinyint(1) NOT NULL DEFAULT 0,
  `order_id` int(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `user_id`, `name`, `image`, `quantity`, `cost`, `sold`, `order_id`, `created_at`, `updated_at`) VALUES
(37, 1, 'Brown & Yellow', 'brown-yellow.jpg', 1, 7.99, 1, 3, '2021-02-21 07:57:17', '2021-02-21 16:28:11'),
(39, 1, 'Red and green', 'red-green.jpg', 1, 5.99, 1, 3, '2021-02-21 08:29:58', '2021-02-21 16:28:11'),
(40, 1, 'Brown', 'brown.jpg', 1, 7.99, 1, 3, '2021-02-21 15:35:42', '2021-02-21 16:28:11'),
(41, 1, 'Brown', 'brown.jpg', 1, 7.99, 1, 4, '2021-02-22 09:03:36', '2021-02-22 09:21:46'),
(42, 1, 'Red and green', 'red-green.jpg', 5, 5.99, 1, 5, '2021-02-22 13:49:34', '2021-02-22 15:58:55'),
(44, 1, 'Lithuanian', 'lithuanian.jpg', 1, 6.99, 1, 5, '2021-02-22 15:19:16', '2021-02-22 15:58:55'),
(45, 2, 'Brown & Yellow', 'brown-yellow.jpg', 1, 7.99, 0, 19, '2021-02-22 17:28:19', '2021-02-22 17:28:19'),
(50, 1, 'Brown', 'brown.jpg', 2, 7.99, 0, 24, '2021-02-23 16:50:30', '2021-02-23 16:51:31');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_11_25_093441_create_bracelets_table', 1),
(2, '2020_11_25_093709_create_articles_table', 2),
(3, '2020_12_05_122628_create_partner_has_articles_table', 3),
(4, '2020_12_05_125042_create_article_partners_table', 4),
(5, '2014_10_12_000000_create_users_table', 5),
(6, '2014_10_12_100000_create_password_resets_table', 5),
(7, '2019_08_19_000000_create_failed_jobs_table', 5),
(8, '2020_12_08_174732_create_sessions_table', 6),
(9, '2021_01_28_130124_create_items_table', 7),
(11, '2021_02_14_100120_create_orders_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `total_cost` double(10,2) NOT NULL DEFAULT 0.00,
  `country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_nr` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_cost`, `country`, `city`, `address`, `phone_nr`, `created_at`, `updated_at`) VALUES
(3, 1, 32.95, 'Lithuania', 'Kaunas', 'Skliausto g., 35-21', '+37065224312', '2021-02-21 07:57:17', '2021-02-21 16:28:11'),
(4, 1, 10.98, 'Liechtenstein', 'Kaunas', 'Skliausto g., 35-21', '+37065224312', '2021-02-22 09:03:36', '2021-02-22 09:21:46'),
(5, 1, 15.97, 'Lithuania', 'Kaunas', 'Entai g., 35-21', '+37065224312', '2021-02-22 13:49:34', '2021-02-22 15:58:55'),
(19, 2, 0.00, 'LT', 'Kaunas', 'Rasos g., 35-21', '865423542', '2021-02-22 17:28:19', '2021-02-22 17:28:19'),
(20, 1, 0.00, 'Lithuania', 'Kaunas', 'Skliausto g., 35-21', '+37065224312', '2021-02-23 16:18:26', '2021-02-23 16:18:26');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` int(5) NOT NULL,
  `name` varchar(40) CHARACTER SET utf8 NOT NULL,
  `url` varchar(74) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `name`, `url`) VALUES
(1, 'Armijai ir civiliams', 'aic.lt'),
(2, 'Turistinės prekės', 'turistinesprekes.lt');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'client'),
(2, 'administrator');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_nr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(8) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `phone_nr`, `country`, `city`, `address`, `password`, `role_id`, `created_at`, `updated_at`, `email_verified_at`, `remember_token`) VALUES
(1, 'Gintaras', 'Armo', 'gintaras.armonaitis@gmail.com', '+37065224312', 'Lithuania', 'Kaunas', 'Skliausto g., 35-21', '$2y$10$U1opo4p/3AeaHQONTDnbeu1HR4bC15Atny5w7/QXBIOg9CMMgj6UK', 2, '2020-12-05 17:21:02', '2020-12-05 17:21:02', NULL, 'J7xpRCm2imfmuUL7dgeX1h7wGMX9AVAb1qaCOOi3WmMRPdyD0yzX0fZ1WKqx'),
(2, 'Petras', 'Petraitis', 'p@gmail.com', '865423542', 'LT', 'Kaunas', 'Rasos g., 35-21', '$2y$10$SgQ6cXPjyis65jhZtnazrOeTkGV5Z1lA13WxPDHlj/mZwp0QxuaPq', 1, '2020-12-07 14:12:13', '2020-12-07 14:12:13', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `article_name` (`name`);

--
-- Indexes for table `article_partner`
--
ALTER TABLE `article_partner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bracelets`
--
ALTER TABLE `bracelets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Name` (`name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `url` (`url`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_nr_unique` (`phone_nr`),
  ADD UNIQUE KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `article_partner`
--
ALTER TABLE `article_partner`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `bracelets`
--
ALTER TABLE `bracelets`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
