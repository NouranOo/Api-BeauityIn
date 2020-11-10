-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2018 at 09:21 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beauty_in`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `country_id`) VALUES
(1, 'alex', 1);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `Name` text NOT NULL,
  `slug` text NOT NULL,
  `code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `Name`, `slug`, `code`) VALUES
(1, 'Egypt', 'Eg', 20),
(2, 'SudiaArabia', 'Sud', 966);

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`id`, `user_id`, `provider_id`, `created_at`, `updated_at`) VALUES
(5, 25, 2, '2018-10-18 13:40:27', '2018-10-18 13:40:27');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(3, '2018_10_07_182544_create_favourites_table', 1),
(4, '2018_10_07_182706_create_messages_table', 1),
(5, '2018_10_07_182726_create_orders_table', 1),
(6, '2018_10_07_182950_create_place_of_services_table', 1),
(7, '2018_10_07_183144_create_posters_table', 1),
(8, '2018_10_07_183206_create_providers_table', 1),
(9, '2018_10_07_183230_create_services_table', 1),
(10, '2018_10_07_183320_create_sub_service_of_places_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `number_people` int(11) NOT NULL,
  `day` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `home_service` int(11) NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `number_people`, `day`, `time`, `home_service`, `note`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'df', 'fdsfsd', 0, '', 25, NULL, '2018-10-14 16:12:03', '2018-10-14 16:12:03'),
(2, 4, 'df', 'fdsfsd', 0, '', 25, 'pending', '2018-10-14 16:13:04', '2018-10-14 16:13:04'),
(3, 2, '22', '22', 0, 'hng', 26, NULL, NULL, NULL),
(4, 4, '2', '2', 0, '', 26, 'pending', '2018-10-18 12:16:01', '2018-10-18 12:16:01'),
(5, 4, '2', '2', 0, '', 26, 'pending', '2018-10-18 12:20:27', '2018-10-18 12:20:27'),
(6, 4, '2', '2', 0, '', 26, 'pending', '2018-10-18 12:21:15', '2018-10-18 12:21:15'),
(7, 4, '2', '2', 0, '', 26, 'pending', '2018-10-18 12:23:32', '2018-10-18 12:23:32'),
(8, 4, '2', '2', 0, '', 26, 'pending', '2018-10-18 12:23:57', '2018-10-18 12:23:57'),
(9, 4, '2', '2', 0, '', 26, 'pending', '2018-10-18 12:25:37', '2018-10-18 12:25:37'),
(10, 4, '2', '2', 0, '', 26, 'pending', '2018-10-18 12:26:05', '2018-10-18 12:26:05'),
(11, 4, '2', '2', 0, '', 26, 'pending', '2018-10-18 12:26:52', '2018-10-18 12:26:52'),
(12, 4, '2', '2', 0, '', 26, 'pending', '2018-10-18 12:27:08', '2018-10-18 12:27:08'),
(13, 4, '2', '2', 0, '', 26, 'pending', '2018-10-18 12:27:26', '2018-10-18 12:27:26');

-- --------------------------------------------------------

--
-- Table structure for table `order_subs`
--

CREATE TABLE `order_subs` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `created_at` text NOT NULL,
  `updated_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_subs`
--

INSERT INTO `order_subs` (`id`, `order_id`, `sub_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '', ''),
(2, 2, 2, '', ''),
(3, 3, 1, '', ''),
(0, 1, 12, '', ''),
(0, 1, 13, '', '');

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
-- Table structure for table `posters`
--

CREATE TABLE `posters` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `providers`
--

CREATE TABLE `providers` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `place_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `place_logo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `late` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_insta` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_twitter` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_facebook` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_information` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `home_service` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ApiToken` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `providers`
--

INSERT INTO `providers` (`id`, `email`, `password`, `full_name`, `phone`, `place_name`, `place_logo`, `image`, `lang`, `late`, `location`, `link_insta`, `link_twitter`, `link_facebook`, `description`, `other_information`, `home_service`, `ApiToken`, `Token`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'nouran@gmail.com', '$2y$10$hWbMGfYDY3tFFXl0YzwwPeIIRqH6TFp7lpibggLEVxPSO0sgxqm.u', 'Nourano', 12222222, 'Coffee', 'ProjectFiles/Provider_images/kRS4Ti_1539456869_18951034_1356532541062098_6870978811418195808_n.jpg', 'ProjectFiles/Provider_images/tgAaB5_1539456869_14446096_1681828945467601_3083090585149282382_n.jpg', '24', '21', 'dcsd', 'nn@inta', 'nn@twitter', NULL, 'cvdzv x', 'xz zxvxz', 'no', 'RmRUWWRLNVA2cEk3dmdqTmVyeDhPMGZWZ0xwZUFFY1lEcWthMlMyRQ==', 'sfagsdgbsrfb', 0, '2018-10-13 18:54:29', '2018-10-13 20:43:30');

-- --------------------------------------------------------

--
-- Table structure for table `provider_services`
--

CREATE TABLE `provider_services` (
  `id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `created_at` text NOT NULL,
  `updated_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `provider_services`
--

INSERT INTO `provider_services` (`id`, `provider_id`, `service_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `provider_subs`
--

CREATE TABLE `provider_subs` (
  `id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `created_at` text NOT NULL,
  `updated_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `provider_subs`
--

INSERT INTO `provider_subs` (`id`, `provider_id`, `sub_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '', ''),
(1, 1, 2, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `type`, `created_at`, `updated_at`) VALUES
(1, 'salon', 'female', NULL, NULL),
(2, 'male', 'salon', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_services`
--

CREATE TABLE `sub_services` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_services`
--

INSERT INTO `sub_services` (`id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(1, 'hair', 2, NULL, NULL),
(2, 'face', 33, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `ApiToken` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `late` double DEFAULT '0',
  `lang` double DEFAULT '0',
  `fb_id` int(11) DEFAULT '0',
  `tw_id` int(11) DEFAULT '0',
  `go_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `country_id`, `user_type`, `image`, `ApiToken`, `Token`, `remember_token`, `created_at`, `updated_at`, `late`, `lang`, `fb_id`, `tw_id`, `go_id`) VALUES
(24, 'pharous', 'pharous@gmail.com', '$2y$10$P44l.MtNUftnYfVy6kWKFuWdcjmjAK8asEcJdjf5J3OvZF6deWXNO', 1200000000, 0, 'male', 'ProjectFiles/user_image/wEwuYa_1539449781_monsters-university-mike-wazowski-600x372.jpg', 'NGxXeGpVZjVLZk90RnBFNWd2VmI0NWgxY1V6QmczbHBVT1VpQVl5ZA==', 'dfsdgadgvdzvg', NULL, '2018-10-13 16:56:23', '2018-10-13 16:56:23', NULL, NULL, NULL, NULL, NULL),
(25, 'coffe', 'nouran@gmail.com', '11111111', 1228333333, 1, 'female', 'ProjectFiles/user_image/bPcAWl_1539535806_01Splash01-min.jpg', 'NnZvcXh2Qm9Qblhvc0JYeElZMkh4NXNGSVJGZ2pwZ2xsZkFGTXBuag==', 'dfvDZfxfsdb', NULL, '2018-10-13 17:02:13', '2018-10-18 12:45:07', 0, 0, 0, 3, 0),
(26, 'coffee', 'nouranhossam@gmail.com', '$2y$10$8fCmvLj40cf3joraGgx4deYmVnzo7yjV2BRJGv8A620/Ems0M38bC', 2147483647, 1, 'female', NULL, 'anNpQVgwSGs5VFJzNTdWMzlEQ0d6emVBRDRaV2lGTlZTZGd1eGhwRA==', 'dfvDZfxfsdb', NULL, '2018-10-14 15:08:44', '2018-10-21 00:50:52', NULL, NULL, NULL, NULL, NULL),
(27, 'coffee', 'nouranhossa@gmail.com', '$2y$10$XaLmo9jc2i1H225gpnIl8.xLiwLpPSrJSxrEeJD9K0p6tReALTXFK', 122883433, 1, 'female', NULL, 'd2p5R2NtMkNwd2IydGdTajhLWnJ3aTdCVjQzRTBnVDdxQjZLVlVWbQ==', 'dfvDZfxfsdb', NULL, '2018-10-14 15:10:52', '2018-10-14 15:10:52', 3, 3, 3, 333, 33),
(28, 'coffee', 'nouranhosa@gmail.com', '$2y$10$ewXYPFNHVFBPT7Cc1TCyrumfak2dR.SKX2VI5ePMNMo/willfp4yK', 12288343, 1, 'female', NULL, 'YVF4dkNSRUhiV1hRYWVwNk9VSmZIVjJrRkhkWTRUZThTZmtDYk1wbg==', 'dfvDZfxfsdb', NULL, '2018-10-14 15:11:20', '2018-10-14 15:11:20', 0, 0, 0, 0, 0),
(29, 'coffee', 'nouranhodsa@gmail.com', '$2y$10$gXf69.8SukSWKo4g5BNJS.ltskFt6rHdEGXyYw7ehL4s3KYLuI84y', 1228834333, 1, 'female', NULL, 'Z2pPMHlQdFk2QzlpMFl0RDhhSHZFUmVReVJFTUFkZHdrRUdIODM2dw==', 'dfvDZfxfsdb', NULL, '2018-10-14 15:12:33', '2018-10-14 15:12:33', 0, 0, 0, 0, 0),
(30, 'coffee', 'nouranhods3a@gmail.com', '$2y$10$pfVqPGkrQDvIQ3k77pPxcu8rignipifizo2yNrcXDBa9zQk6.tstW', 2147483647, 1, 'female', NULL, 'aXc0RThMTVVzTUxkeHdFdlJMdGszNks2d0hVQWMwYzZkUzBTZkQ0aA==', 'dfvDZfxfsdb', NULL, '2018-10-14 15:14:30', '2018-10-14 15:14:30', 0, 0, 0, 0, 0),
(31, 'coffee', 'nouranhods3af@gmail.com', '$2y$10$tYbu0.Uf5hhqnFlcqCEtSO..XHHEWXRH7gnjhNyJ7Si4sTcl9exXe', 2147483647, 1, 'female', NULL, 'M0Z0dkIzS21sR2JMUndZRWlWUHN4UWl3ZGlyZWtLRmNqUG5pdWRsYQ==', 'dfvDZfxfsdb', NULL, '2018-10-14 15:17:09', '2018-10-14 15:17:09', 0, 0, 0, 0, 0),
(32, 'coffee', 'nouranh@gmail.com', '$2y$10$Dx384nYlPADq7ThFnIrjceQ1BowXLprkfKZBh0WFlIL4OAuzTw0n6', 1228, 1, 'female', NULL, 'WnR1Y0RkSzdVVFV5ajRVUDdGeDdlTTFzVHMxOEVSNHpkN0E0SnlCcQ==', 'dfvDZfxfsdb', NULL, '2018-10-14 15:17:34', '2018-10-14 15:17:34', 0, 0, 0, 3, 0),
(33, 'coffee', 'nouran2@gmail.com', '$2y$10$l.EOMkYbysDWRwF.Iz.Of.ekEJsb7P7USjP8KjQ2Jp3516F0FB.SK', 2222, 1, 'female', NULL, 'V01YU3Y2c0cyb1Y4Q1RxRHF4ZEw4cHlmU3J4Y1laWnF6cWlqVXh3RQ==', 'dfvDZfxfsdb', NULL, '2018-10-14 16:53:11', '2018-10-14 16:54:31', 0, 0, 0, 0, 0),
(34, 'coffe', 'nouran3@gmail.com', '11111111', 33, 1, 'female', NULL, 'S3oyb0gyTzg0UjdSRE4zYkh1empHaG51MVRpTmYyWVQ5RnZGYXNxQQ==', 'dfvDZfxfsdb', NULL, '2018-10-14 16:54:54', '2018-10-14 16:55:58', 0, 0, 0, 3, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posters`
--
ALTER TABLE `posters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_services`
--
ALTER TABLE `sub_services`
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
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `posters`
--
ALTER TABLE `posters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `providers`
--
ALTER TABLE `providers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sub_services`
--
ALTER TABLE `sub_services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
