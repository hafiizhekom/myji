-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2021 at 06:30 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myji`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_code` varchar(10) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_code`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'vol_1', 'Vol.1', '2021-09-02 14:00:08', '0000-00-00 00:00:00'),
(2, 'tshirt', 'T-Shirt', '2021-10-06 01:43:34', '2021-10-06 01:43:34');

-- --------------------------------------------------------

--
-- Table structure for table `channel`
--

CREATE TABLE `channel` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `channel_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fixed_fee` double(8,2) NOT NULL,
  `percentage_fee` double(8,2) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `channel`
--

INSERT INTO `channel` (`id`, `channel_name`, `fixed_fee`, `percentage_fee`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Tests', 1000.00, 1.00, 1, '2021-09-20 14:33:50', '2021-09-20 15:58:21');

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `id` int(11) NOT NULL,
  `color_code` varchar(10) NOT NULL,
  `color_name` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`id`, `color_code`, `color_name`, `created_at`, `updated_at`) VALUES
(1, 'white', 'White', '2021-09-02 13:59:47', '0000-00-00 00:00:00'),
(2, 'Blacks', 'blacks', '2021-09-20 21:16:12', '2021-09-20 14:16:11');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `title`, `content`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Ini All Size?', '<p>Yes! Kita ada all size untuk wanita dan pria. detail ukurannya, bisa dilihat di product detail</p>', 0, '2021-09-10 12:14:33', '0000-00-00 00:00:00');

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
(1, '2019_08_19_000000_create_failed_jobs_table', 1),
(2, '2021_08_23_000000_create_users_table', 1),
(3, '2021_08_23_000001_create_channels_table', 1),
(4, '2021_08_23_000001_create_permissions_table', 1),
(5, '2021_08_23_000001_create_product_size_table', 1),
(6, '2021_08_23_000001_create_products_table', 1),
(7, '2021_08_23_000001_create_promo_detail_table', 1),
(8, '2021_08_23_000001_create_promos_table', 1),
(9, '2021_08_23_000001_create_roles_table', 1),
(10, '2021_08_23_000001_create_sizes_table', 1),
(11, '2021_09_10_134848_create_channel_table', 0),
(12, '2021_09_10_134848_create_color_table', 0),
(13, '2021_09_10_134848_create_failed_jobs_table', 0),
(14, '2021_09_10_134848_create_faq_table', 0),
(15, '2021_09_10_134848_create_permissions_table', 0),
(16, '2021_09_10_134848_create_product_table', 0),
(17, '2021_09_10_134848_create_product_detail_table', 0),
(18, '2021_09_10_134848_create_promo_table', 0),
(19, '2021_09_10_134848_create_promo_product_detail_table', 0),
(20, '2021_09_10_134848_create_role_table', 0),
(21, '2021_09_10_134848_create_size_table', 0),
(22, '2021_09_10_134848_create_slider_table', 0),
(23, '2021_09_10_134848_create_testimony_table', 0),
(24, '2021_09_10_134848_create_user_table', 0),
(25, '2021_09_10_134848_create_volume_table', 0);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `view` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_code`, `product_name`, `view`, `created_at`, `updated_at`) VALUES
(9, 'product_2', 'Product 2', 0, '2021-09-23 16:30:26', '2021-09-23 16:30:26'),
(10, 'product_3', 'Product 3', 0, '2021-10-01 05:09:35', '2021-10-01 05:09:35'),
(11, 'product_4', 'Product 4', 0, '2021-10-11 06:45:47', '2021-10-11 06:45:47');

-- --------------------------------------------------------

--
-- Table structure for table `production`
--

CREATE TABLE `production` (
  `id` bigint(20) NOT NULL,
  `purchasing_id` bigint(20) NOT NULL,
  `product_detail_id` bigint(20) NOT NULL,
  `request` bigint(20) DEFAULT NULL,
  `actual` bigint(20) DEFAULT NULL,
  `defect` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `production`
--

INSERT INTO `production` (`id`, `purchasing_id`, `product_detail_id`, `request`, `actual`, `defect`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 100, 90, 10, '2021-10-03 01:19:36', '2021-10-02 18:19:36'),
(3, 2, 5, 20, 25, 20, '2021-10-03 00:51:35', '2021-10-02 17:51:35'),
(4, 3, 5, 200, 20, 10, '2021-10-03 08:47:39', '2021-10-03 01:47:39'),
(5, 4, 5, 200, 20, NULL, '2021-10-03 08:51:09', '2021-10-03 01:51:09'),
(6, 5, 5, 100, 20, 100, '2021-10-03 09:26:31', '2021-10-03 02:26:31'),
(12, 6, 1, 20, 32, NULL, '2021-10-12 09:55:30', '2021-10-12 02:55:30'),
(13, 6, 2, 30, 43, NULL, '2021-10-12 09:55:31', '2021-10-12 02:55:31'),
(16, 7, 1, 200, 23, NULL, '2021-10-12 10:09:01', '2021-10-12 03:09:01'),
(17, 7, 3, 300, 34, NULL, '2021-10-12 10:09:01', '2021-10-12 03:09:01');

-- --------------------------------------------------------

--
-- Table structure for table `production.actual`
--

CREATE TABLE `production.actual` (
  `id_production.actual` bigint(20) NOT NULL,
  `id_production.request` bigint(20) NOT NULL,
  `actual` bigint(20) NOT NULL,
  `flag` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_detail`
--

CREATE TABLE `product_detail` (
  `id` int(20) UNSIGNED NOT NULL,
  `product_id` int(20) UNSIGNED NOT NULL,
  `size_id` int(20) UNSIGNED NOT NULL,
  `color_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` bigint(20) NOT NULL DEFAULT '0',
  `yard_per_piece` double NOT NULL DEFAULT '0',
  `design_image_path` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_detail`
--

INSERT INTO `product_detail` (`id`, `product_id`, `size_id`, `color_id`, `category_id`, `price`, `yard_per_piece`, `design_image_path`, `created_at`, `updated_at`) VALUES
(1, 9, 1, 1, 1, 12000, 12, 'product_2-1.png', '2021-10-11 06:43:05', '2021-10-11 06:43:06'),
(2, 11, 1, 1, 2, 12000, 12, 'product_4-2.png', '2021-10-11 06:46:05', '2021-10-11 06:46:05'),
(3, 11, 4, 1, 1, 12000, 23, 'product_4-3.jpg', '2021-10-11 23:59:25', '2021-10-11 23:59:27'),
(5, 9, 4, 1, 1, 12000, 23, 'product_4-3.jpg', '2021-10-11 23:59:25', '2021-10-11 23:59:27');

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `promo_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fixed_amount` double(8,2) NOT NULL,
  `percentage_amount` double(8,2) NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promo_product_detail`
--

CREATE TABLE `promo_product_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `promo_id` bigint(20) UNSIGNED NOT NULL,
  `product_detail_id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchasing`
--

CREATE TABLE `purchasing` (
  `id` bigint(20) NOT NULL,
  `po_code` varchar(50) NOT NULL,
  `item` varchar(50) NOT NULL,
  `unit` bigint(20) NOT NULL,
  `unit_price` bigint(20) NOT NULL,
  `total_price` bigint(20) NOT NULL,
  `discount_amount` bigint(20) NOT NULL,
  `discount_percentage` int(11) NOT NULL,
  `shipping_cost` bigint(20) NOT NULL,
  `total_price_with_shipping` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchasing`
--

INSERT INTO `purchasing` (`id`, `po_code`, `item`, `unit`, `unit_price`, `total_price`, `discount_amount`, `discount_percentage`, `shipping_cost`, `total_price_with_shipping`, `created_at`, `updated_at`) VALUES
(1, 'PO-1', 'Kain Linen', 10, 25000, 250000, 0, 0, 20000, 270000, '2021-10-01 12:52:25', '2021-10-01 05:52:25'),
(2, 'PO-2', 'Kain Sutra', 10, 10000, 100000, 0, 0, 7500, 107500, '2021-10-01 05:45:23', '2021-10-01 05:45:23'),
(3, 'PO-3', 'Cotton Combed', 100, 10000, 1000000, 0, 0, 22500, 1022500, '2021-10-02 23:53:00', '2021-10-02 23:53:00'),
(4, 'PO-4', 'Kain A', 100, 10, 1000, 0, 0, 2500, 3500, '2021-10-03 01:48:14', '2021-10-03 01:48:14'),
(5, 'PO-5', 'Kain B', 100, 1000, 100000, 0, 0, 2500, 102500, '2021-10-03 02:20:40', '2021-10-03 02:20:40'),
(6, 'PO-6', 'Kain C', 20, 300, 5400, 0, 10, 200, 5600, '2021-10-11 10:25:13', '2021-10-11 10:25:13'),
(7, 'PO-7', 'Kain D', 100, 100, 9000, 0, 10, 200, 9200, '2021-10-12 03:02:08', '2021-10-12 03:02:08');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `size_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`id`, `size_code`, `size_name`, `created_at`, `updated_at`) VALUES
(1, 'S', 'Small', NULL, NULL),
(2, 'M', 'Medium', NULL, NULL),
(3, 'L', 'Large', NULL, NULL),
(4, 'XL', 'Extra Large', NULL, NULL),
(5, 'XXL', 'Extra Extra Largee', NULL, '2021-09-20 14:22:23');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `title`, `image`, `order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Slider 1', 'sliders/April2021/ysb4gGYV1c3NAbyupFc2.jpg', 1, '2021-04-10 18:36:12', '2021-04-10 19:12:43', NULL),
(2, 'Slider 2', 'sliders/April2021/CQIrRZxDesJQrcNDmmPp.jpg', 2, '2021-04-10 18:53:36', '2021-04-10 20:31:14', '2021-04-10 20:31:14');

-- --------------------------------------------------------

--
-- Table structure for table `testimony`
--

CREATE TABLE `testimony` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimony`
--

INSERT INTO `testimony` (`id`, `title`, `image`, `content`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Testimony 1', 'testimonies/April2021/naNFwWCymC63lyaJY0oe.jpg', NULL, '2021-04-10 22:26:55', '2021-04-10 22:26:55', NULL),
(2, 'Testimony 2', 'testimonies/April2021/pKsDJFFDcb7BTiuumTEj.jpg', NULL, '2021-04-10 22:27:31', '2021-04-10 22:27:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `channel`
--
ALTER TABLE `channel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `color_code` (`color_code`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `production`
--
ALTER TABLE `production`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `production.actual`
--
ALTER TABLE `production.actual`
  ADD PRIMARY KEY (`id_production.actual`);

--
-- Indexes for table `product_detail`
--
ALTER TABLE `product_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo_product_detail`
--
ALTER TABLE `promo_product_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchasing`
--
ALTER TABLE `purchasing`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `po_code` (`po_code`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `channel`
--
ALTER TABLE `channel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `production`
--
ALTER TABLE `production`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `production.actual`
--
ALTER TABLE `production.actual`
  MODIFY `id_production.actual` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_detail`
--
ALTER TABLE `product_detail`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promo_product_detail`
--
ALTER TABLE `promo_product_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchasing`
--
ALTER TABLE `purchasing`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
