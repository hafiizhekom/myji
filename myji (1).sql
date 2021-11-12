-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2021 at 03:23 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_code`, `category_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'shirt', 'Shirt', '2021-09-02 14:00:08', '2021-11-02 17:50:09', NULL),
(2, 'tshirt', 'T-Shirt', '2021-10-06 01:43:34', '2021-10-06 01:43:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `channel`
--

CREATE TABLE `channel` (
  `id` int(10) UNSIGNED NOT NULL,
  `channel_name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `fixed_fee` double(8,2) NOT NULL,
  `percentage_fee` double(8,2) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `channel`
--

INSERT INTO `channel` (`id`, `channel_name`, `fixed_fee`, `percentage_fee`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Shopee', 2000.00, 0.00, 1, '2021-09-20 14:33:50', '2021-10-18 19:52:00', NULL),
(2, 'Test', 0.00, 0.00, 1, '2021-11-08 08:04:06', '2021-11-08 08:04:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `id` int(11) NOT NULL,
  `color_code` varchar(10) NOT NULL,
  `color_name` varchar(20) NOT NULL,
  `color_hex` varchar(8) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`id`, `color_code`, `color_name`, `color_hex`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'white', 'White', '#ffffff', '2021-09-02 13:59:47', '2021-11-07 17:34:36', NULL),
(2, 'black', 'Black', '#000000', '2021-09-20 21:16:12', '2021-11-07 17:34:43', NULL),
(3, 'green', 'Green', '#05fa2e', '2021-11-07 17:35:23', '2021-11-07 17:35:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `first_name`, `last_name`, `gender`, `email`, `phone`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Hafiizh', 'Eko', 'M', 'hafiizhekom@yahoo.com', '085893630036', 'asdasdsadfsafsadas', '2021-10-14 07:08:19', '2021-10-14 07:08:19', NULL),
(2, 'Anya', 'Geraldine', 'F', 'anyageraldine@yahoo.com', '08593232132142143', 'sadsafsadasdsadsafsadasdsadsafsadasd', '2021-10-14 07:16:44', '2021-10-14 07:16:44', NULL);

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `title`, `content`, `order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ini All Size?', '<p>Yes! Kita ada all size untuk wanita dan pria. detail ukurannya, bisa dilihat di product detail</p>', 0, '2021-09-10 12:14:33', '0000-00-00 00:00:00', NULL);

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
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `channel_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `discount_amount` int(11) NOT NULL,
  `discount_percentage` int(11) NOT NULL,
  `address_shipping` varchar(200) NOT NULL,
  `total_price` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `type_order` enum('standart','return') NOT NULL DEFAULT 'standart',
  `return_order` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `channel_id`, `customer_id`, `discount_amount`, `discount_percentage`, `address_shipping`, `total_price`, `order_date`, `type_order`, `return_order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 0, 0, 'Jl. Utan Panjang 2', 12000, '2021-10-14', 'standart', 0, '2021-10-14 14:53:48', '2021-10-18 19:53:31', NULL),
(3, 1, 2, 0, 10, 'Jl. Utan Panjang 3', 900000, '2021-10-17', 'standart', 0, '2021-10-17 00:39:06', '2021-10-18 19:53:19', NULL),
(4, 1, 2, 9, 9, 'Jl. Utan Panjang 3', 300000, '2021-11-03', 'return', 3, '2021-11-02 20:13:47', '2021-11-02 20:13:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_detail_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` enum('success','refunded','returned') NOT NULL DEFAULT 'success',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_detail_id`, `quantity`, `price`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, 23, 100002, 'refunded', '2021-10-14 18:15:04', '2021-10-22 12:52:03', NULL),
(3, 1, 1, 12, 10000, 'success', '2021-10-23 03:05:16', '2021-10-23 03:05:16', NULL),
(7, 3, 3, 2, 300000, 'returned', '2021-11-02 19:03:25', '2021-11-02 21:31:46', NULL),
(8, 4, 3, 1, 300000, 'success', '2021-11-02 21:29:16', '2021-11-02 21:31:51', NULL);

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
  `id` int(11) NOT NULL,
  `product_code` varchar(191) CHARACTER SET latin1 NOT NULL,
  `product_name` varchar(191) CHARACTER SET latin1 NOT NULL,
  `category_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `image_file` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_code`, `product_name`, `category_id`, `color_id`, `image_file`, `view`, `created_at`, `updated_at`, `deleted_at`) VALUES
(9, 'product_2', 'Product 2', 1, 1, '', 0, '2021-09-23 16:30:26', '2021-11-07 16:47:56', NULL),
(10, 'product_3', 'Product 3', 1, 1, '', 0, '2021-10-01 05:09:35', '2021-11-07 16:49:11', NULL),
(11, 'product_4', 'Product 4', 1, 1, '', 0, '2021-10-11 06:45:47', '2021-11-07 16:49:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `production`
--

CREATE TABLE `production` (
  `id` int(11) NOT NULL,
  `purchasing_id` int(11) NOT NULL,
  `product_detail_id` int(11) NOT NULL,
  `request` int(11) DEFAULT NULL,
  `actual` int(11) DEFAULT NULL,
  `defect` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `production`
--

INSERT INTO `production` (`id`, `purchasing_id`, `product_detail_id`, `request`, `actual`, `defect`, `created_at`, `updated_at`, `deleted_at`) VALUES
(21, 8, 3, 200, 200, NULL, '2021-10-13 01:14:17', '2021-10-12 18:14:17', NULL),
(22, 8, 5, 200, NULL, NULL, '2021-10-12 17:23:06', '2021-10-12 17:23:06', NULL),
(23, 9, 1, 100, 120, 1, '2021-10-17 00:36:14', '2021-10-17 00:38:10', NULL),
(24, 9, 3, 150, 100, 1, '2021-10-17 00:36:14', '2021-10-17 00:38:15', NULL),
(25, 9, 5, 120, 50, 1, '2021-10-17 00:36:14', '2021-10-17 00:38:20', NULL),
(26, 8, 2, 200, 150, 12, '2021-10-22 15:51:46', '2021-10-22 15:56:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_detail`
--

CREATE TABLE `product_detail` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `yard_per_piece` double NOT NULL DEFAULT 0,
  `design_image_path` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `shopee_link` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatsapp_link` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_detail`
--

INSERT INTO `product_detail` (`id`, `product_id`, `size_id`, `color_id`, `category_id`, `price`, `yard_per_piece`, `design_image_path`, `shopee_link`, `whatsapp_link`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 9, 1, 2, 2, 12000, 12, 'product_2-1.png', 'b', 'a', '2021-10-11 06:43:05', '2021-11-02 17:51:43', NULL),
(2, 11, 1, 1, 2, 12000, 12, 'product_4-2.png', '', '', '2021-10-11 06:46:05', '2021-10-11 06:46:05', NULL),
(3, 10, 1, 1, 2, 12000, 23, 'product_3-10.jpg', 'test', 'test', '2021-10-11 23:59:25', '2021-11-02 17:55:35', NULL),
(5, 9, 4, 1, 1, 12000, 23, 'product_2-9.png', 'https://google.com', 'https://google.com', '2021-10-11 23:59:25', '2021-10-22 18:23:36', NULL),
(6, 9, 2, 1, 1, 12000, 122, 'product_2-6.png', '234', '123', '2021-10-22 12:15:03', '2021-11-08 06:51:20', NULL),
(7, 10, 2, 1, 2, 122000, 23, 'product_3-7.jpg', 'test', 'test', '2021-11-02 17:55:59', '2021-11-02 17:56:31', NULL),
(8, 10, 3, 1, 2, 125000, 23, 'product_3-8.jpg', 'test', 'test', '2021-11-02 17:56:17', '2021-11-02 17:56:39', NULL),
(9, 10, 4, 1, 2, 130000, 23, 'product_3-9.jpg', 'test', 'test', '2021-11-02 18:47:24', '2021-11-02 18:47:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_detail_image`
--

CREATE TABLE `product_detail_image` (
  `id` int(11) NOT NULL,
  `product_detail_id` int(11) NOT NULL,
  `file` varchar(50) NOT NULL,
  `main_image` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_detail_image`
--

INSERT INTO `product_detail_image` (`id`, `product_detail_id`, `file`, `main_image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 1, 'product_2-1-2.png', 0, '2021-11-08 05:06:03', '2021-11-08 05:43:13', NULL),
(3, 1, 'product_2-1-3.png', 0, '2021-11-08 05:06:03', '2021-11-08 05:43:13', NULL),
(4, 1, 'product_2-1-4.png', 0, '2021-11-08 05:13:20', '2021-11-08 05:43:13', NULL),
(6, 1, 'product_2-1-6.png', 1, '2021-11-08 05:20:05', '2021-11-08 05:43:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `id` int(11) NOT NULL,
  `promo_name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `fixed_amount` double(8,2) NOT NULL,
  `percentage_amount` double(8,2) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`id`, `promo_name`, `fixed_amount`, `percentage_amount`, `start_time`, `end_time`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Hallowen SALE', 0.00, 20.00, '2021-10-22 00:00:00', '2021-11-30 00:00:00', 1, '2021-10-22 02:12:46', '2021-10-22 02:12:46', NULL),
(2, 'Hallowen SALE 2', 0.00, 20.00, '2021-10-22 00:00:00', '2021-11-30 00:00:00', 1, '2021-10-22 02:35:24', '2021-10-22 02:35:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `promo_detail`
--

CREATE TABLE `promo_detail` (
  `id` int(11) NOT NULL,
  `promo_id` int(11) NOT NULL,
  `product_detail_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promo_detail`
--

INSERT INTO `promo_detail` (`id`, `promo_id`, `product_detail_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, '2021-10-22 06:19:33', '2021-10-22 06:42:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchasing`
--

CREATE TABLE `purchasing` (
  `id` int(11) NOT NULL,
  `po_code` varchar(50) NOT NULL,
  `item` varchar(50) NOT NULL,
  `unit` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `discount_amount` int(11) NOT NULL,
  `discount_percentage` int(11) NOT NULL,
  `shipping_cost` int(11) NOT NULL,
  `total_price_with_shipping` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchasing`
--

INSERT INTO `purchasing` (`id`, `po_code`, `item`, `unit`, `unit_price`, `total_price`, `discount_amount`, `discount_percentage`, `shipping_cost`, `total_price_with_shipping`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 'PO-1', 'Kain Sutra', 10, 2000, 16000, 0, 20, 2000, 18000, '2021-10-12 16:36:22', '2021-10-12 16:36:22', NULL),
(9, 'PO-2', 'Kain A', 100, 10000, 900000, 0, 10, 20000, 920000, '2021-10-17 00:35:44', '2021-10-17 00:35:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `refund`
--

CREATE TABLE `refund` (
  `id` int(11) NOT NULL,
  `order_detail_id` int(11) NOT NULL,
  `type` enum('refund','return') NOT NULL,
  `stock_flow` enum('actual','defect') NOT NULL,
  `reason` text CHARACTER SET latin1 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `refund`
--

INSERT INTO `refund` (`id`, `order_detail_id`, `type`, `stock_flow`, `reason`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'refund', 'actual', 'abcdef', '2021-10-14 21:06:29', '2021-10-22 21:58:42', NULL),
(5, 1, 'refund', 'actual', 'dsadsa', '2021-10-22 12:52:03', '2021-10-22 12:52:03', NULL),
(8, 7, 'return', 'actual', 'tidak suka', '2021-11-02 19:03:53', '2021-11-02 19:03:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id` int(10) NOT NULL,
  `size_code` varchar(100) CHARACTER SET latin1 NOT NULL,
  `size_name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`id`, `size_code`, `size_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'S', 'Small', NULL, NULL, NULL),
(2, 'M', 'Medium', NULL, NULL, NULL),
(3, 'L', 'Large', NULL, NULL, NULL),
(4, 'XL', 'Extra Large', NULL, NULL, NULL),
(5, 'XXL', 'Extra Extra Largee', NULL, '2021-09-20 14:22:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET latin1 NOT NULL,
  `image` varchar(255) CHARACTER SET latin1 NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `title`, `image`, `order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Slider 1', 'banner.jpg', 1, '2021-04-10 18:36:12', '2021-10-23 01:26:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `testimony`
--

CREATE TABLE `testimony` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET latin1 NOT NULL,
  `image` varchar(255) CHARACTER SET latin1 NOT NULL,
  `content` text CHARACTER SET latin1 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimony`
--

INSERT INTO `testimony` (`id`, `title`, `image`, `content`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Testimony 1', '1.jpg', NULL, '2021-04-10 22:26:55', '2021-10-24 05:57:38', NULL),
(2, 'Testimony 2', '2.jpg', NULL, '2021-04-10 22:27:31', '2021-10-24 05:57:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(100) CHARACTER SET latin1 NOT NULL,
  `remember_token` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administrator', 'admin@shopmyji.com', NULL, '$2y$10$KmwxpPo3ID3dAD7z5CWhqurOiEbpz7IzU6XQj1cNuLFBYVVzGn.xO', NULL, '2021-11-02 22:41:01', '2021-11-03 05:55:55', NULL);

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
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
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
-- Indexes for table `product_detail`
--
ALTER TABLE `product_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_detail_image`
--
ALTER TABLE `product_detail_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo_detail`
--
ALTER TABLE `promo_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchasing`
--
ALTER TABLE `purchasing`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `po_code` (`po_code`);

--
-- Indexes for table `refund`
--
ALTER TABLE `refund`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimony`
--
ALTER TABLE `testimony`
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
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `channel`
--
ALTER TABLE `channel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
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
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `production`
--
ALTER TABLE `production`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `product_detail`
--
ALTER TABLE `product_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_detail_image`
--
ALTER TABLE `product_detail_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `promo_detail`
--
ALTER TABLE `promo_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchasing`
--
ALTER TABLE `purchasing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `refund`
--
ALTER TABLE `refund`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
