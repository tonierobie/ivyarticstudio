-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 27, 2020 at 04:46 PM
-- Server version: 5.7.30
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ivyartic_studio`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `name` varchar(125) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `created_at`, `updated_at`, `name`, `deleted`, `user_id`) VALUES
(1, '2019-07-15 09:26:45', '2019-07-15 17:11:22', 'Painting', 0, 1),
(2, '2019-07-15 09:50:36', '2019-07-15 16:48:05', 'Drawing', 0, 1),
(3, '2019-09-09 06:37:54', '2019-09-09 06:37:54', 'Printmaking', 0, 1),
(4, '2019-09-09 06:38:11', '2019-09-09 06:38:11', 'Sculpture', 0, 1),
(5, '2019-09-09 06:38:26', '2019-09-09 06:38:26', 'Ceramics', 0, 1),
(6, '2019-09-09 06:38:42', '2019-09-09 06:38:42', 'Photography', 0, 1),
(7, '2019-09-09 06:38:55', '2019-09-09 06:38:55', 'Filmmaking', 0, 1),
(8, '2019-09-09 06:39:08', '2019-09-09 06:39:08', 'Design', 0, 1),
(9, '2019-09-09 06:39:20', '2019-09-09 06:39:20', 'Crafts', 0, 1),
(10, '2019-09-09 06:39:33', '2019-09-09 06:39:33', 'Architecture', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `purchased` tinyint(4) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `created_at`, `updated_at`, `purchased`, `deleted`) VALUES
(26, '2019-08-20 07:31:02', '2019-08-20 09:01:03', 1, 1),
(27, '2019-08-20 10:44:31', '2019-08-20 10:44:31', 0, 0),
(28, '2019-08-20 10:50:52', '2019-08-20 10:59:41', 1, 0),
(29, '2019-08-23 16:18:46', '2019-08-23 16:28:35', 1, 0),
(30, '2019-08-27 11:09:18', '2019-08-27 12:24:58', 1, 0),
(31, '2019-08-27 11:51:59', '2019-08-27 11:51:59', 0, 0),
(32, '2019-08-27 12:19:48', '2019-08-27 12:19:48', 0, 0),
(34, '2019-08-27 12:48:16', '2019-08-27 12:50:52', 1, 0),
(35, '2019-09-11 18:47:28', '2019-09-11 18:47:28', 0, 0),
(36, '2019-09-21 13:39:52', '2019-09-21 13:39:52', 0, 0),
(37, '2019-09-22 21:59:36', '2019-09-22 21:59:36', 0, 0),
(38, '2020-01-18 11:18:30', '2020-01-18 11:18:30', 0, 0),
(39, '2020-02-17 00:27:13', '2020-02-17 00:27:13', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `option_id` int(11) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `created_at`, `updated_at`, `cart_id`, `product_id`, `qty`, `option_id`, `deleted`) VALUES
(57, '2019-08-20 07:31:02', '2019-08-20 07:46:23', 26, 2, 1, 3, 0),
(58, '2019-08-20 10:44:31', '2019-08-20 10:44:31', 27, 2, 1, 3, 0),
(59, '2019-08-20 10:50:52', '2019-08-20 10:50:52', 28, 2, 1, 3, 0),
(60, '2019-08-23 16:18:46', '2019-08-23 16:18:46', 29, 2, 1, 3, 0),
(61, '2019-08-23 16:21:17', '2019-08-23 16:21:17', 29, 1, 1, 1, 0),
(62, '2019-08-27 11:09:18', '2019-08-27 11:16:42', 30, 1, 1, 1, 0),
(63, '2019-08-27 11:11:24', '2019-08-27 11:11:35', 30, 4, 9, 2, 1),
(64, '2019-08-27 11:52:00', '2019-08-27 11:52:00', 31, 1, 1, 1, 0),
(65, '2019-08-27 12:19:48', '2019-08-27 12:19:48', 32, 1, 1, 2, 0),
(69, '2019-08-27 12:48:16', '2019-08-27 12:48:16', 34, 1, 1, 2, 0),
(70, '2019-09-11 18:47:34', '2019-09-11 18:47:34', 35, 2, 1, 2, 0),
(71, '2019-09-11 18:47:47', '2019-09-11 18:47:47', 35, 1, 1, 2, 0),
(72, '2019-09-21 13:39:52', '2019-09-21 13:39:52', 36, 2, 1, 2, 0),
(73, '2019-09-22 21:59:37', '2019-09-22 21:59:37', 37, 8, 1, 0, 0),
(74, '2020-01-18 11:18:52', '2020-01-18 11:18:52', 38, 6, 1, 2, 0),
(75, '2020-02-17 00:27:27', '2020-02-17 00:27:27', 39, 2, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(11) NOT NULL,
  `migration` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`) VALUES
(1, 'Migration1549756212'),
(2, 'Migration1549770647'),
(3, 'Migration1550018019'),
(4, 'Migration1550023025'),
(5, 'Migration1553040803'),
(6, 'Migration1553041425'),
(7, 'Migration1553047403'),
(8, 'Migration1554860082'),
(9, 'Migration1556064610'),
(10, 'Migration1557882435'),
(11, 'Migration1559088627'),
(12, 'Migration1559089589');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `name` varchar(155) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `userid`, `name`, `deleted`) VALUES
(1, 1, '104cm by 78cm', 0),
(2, 1, '62cm by 43cm', 0),
(3, 11, '62cm by 43cm', 0),
(4, 1, '10cm x 6cm', 0),
(5, 19, 'Color: Black and White', 0),
(6, 19, 'Size: 50 cm by 80 cm', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(155) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `list` decimal(10,2) DEFAULT NULL,
  `shipping` decimal(10,2) DEFAULT NULL,
  `body` text,
  `featured` tinyint(4) DEFAULT NULL,
  `inventory` int(11) DEFAULT NULL,
  `charges` decimal(10,2) DEFAULT NULL,
  `has_options` tinyint(4) DEFAULT NULL,
  `approval` tinyint(4) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `created_at`, `updated_at`, `user_id`, `name`, `brand_id`, `price`, `list`, `shipping`, `body`, `featured`, `inventory`, `charges`, `has_options`, `approval`, `deleted`) VALUES
(1, '2019-07-15 09:35:09', '2020-02-19 09:45:31', 3, 'Rich Family', 2, 4.00, 5.00, 0.00, '&lt;div class=&quot;wpb_text_column wpb_content_element &quot;&gt;\r\n&lt;div class=&quot;wpb_wrapper&quot;&gt;&lt;br /&gt;\r\n&lt;p&gt;&lt;span class=&quot;s1&quot;&gt;Oil paint on Board&lt;br /&gt;&lt;/span&gt;104cm by 78cm&lt;/p&gt;\r\n&lt;p&gt;Signed. 1991&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;', 1, 6, 0.32, 1, 0, 0),
(2, '2019-07-15 10:01:21', '2020-02-19 09:55:23', 3, 'All is never lost (Rescue mission)', 2, 8.05, 10.03, 2.00, '&lt;p&gt;Oil paint on Board&lt;br /&gt;62cm by 43cm&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;Signed. 2006&lt;/p&gt;', 1, 5, 0.64, 1, 0, 0),
(3, '2019-07-16 07:58:22', '2019-08-27 08:39:31', 11, 'Untitled', 1, 11.00, 12.00, 0.00, '&lt;p&gt;Oil pastels on paper&lt;/p&gt;\r\n&lt;p&gt;10cm x 6cm&amp;nbsp;&lt;/p&gt;', 1, 6, 0.88, 1, 1, 0),
(4, '2019-07-16 11:19:34', '2019-08-27 11:25:18', 11, 'Waiting for a Bus', 1, 70.00, 80.00, 5.00, '&lt;p&gt;Charcoal on paper and wire mesh&lt;/p&gt;\r\n&lt;p&gt;40x45cm&lt;/p&gt;', 1, 8, 5.60, 1, 1, 0),
(5, '2019-09-05 12:04:26', '2019-09-05 12:04:27', 1, 'Mark Anthony', 2, 49.00, 50.00, 3.00, '&lt;p&gt;Artistic bottles for hme beautification&lt;/p&gt;', 1, 10, 3.92, 0, 1, 0),
(6, '2019-09-05 12:05:46', '2020-02-19 08:41:22', 1, 'African Woman', 2, 59.00, 60.00, 3.00, '&lt;p&gt;An art of an african woman doing her daily chores&lt;/p&gt;', 1, 15, 4.72, 1, 1, 0),
(7, '2019-09-05 12:13:56', '2019-09-05 12:13:57', 1, 'Panther Designers', 2, 42.00, 45.00, 0.00, '&lt;p&gt;A facial art of a person&lt;/p&gt;', 1, 5, 3.36, 0, 1, 0),
(8, '2019-09-05 12:19:16', '2019-09-05 12:19:16', 1, 'Woman Comfort', 2, 52.00, 55.00, 0.00, '&lt;p&gt;An art of a woman posing &lt;/p&gt;', 1, 6, 4.16, 0, 1, 0),
(9, '2019-11-12 14:27:06', '2019-12-10 05:03:52', 20, 'Calm Forest', 2, 11.65, 12.00, 3.80, '&lt;p&gt;Abstract Art&lt;/p&gt;', 1, 5, 0.93, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `name`, `url`, `sort`, `deleted`) VALUES
(1, 1, '5a754b6a96944f94ef599d5c5c82e8f0b53cb437.jpg', 'uploads\\product_images\\product_1\\5a754b6a96944f94ef599d5c5c82e8f0b53cb437.jpg', 0, 1),
(2, 1, '94e57274e86c3b1017d478dab1178acd36eba5a5.jpg', 'uploads\\product_images\\product_1\\94e57274e86c3b1017d478dab1178acd36eba5a5.jpg', 0, 0),
(3, 2, 'dbbb1bb67c16223cbeb8b38863feaf662509ceae.jpg', 'uploads\\product_images\\product_2\\dbbb1bb67c16223cbeb8b38863feaf662509ceae.jpg', 0, 0),
(4, 3, '6adf2659d00b6170d46125703427db752b74f507.jpg', 'uploads\\product_images\\product_3\\6adf2659d00b6170d46125703427db752b74f507.jpg', 0, 0),
(5, 4, '46c4cfef66d08b9915b899d43440052e0f6854d9.jpg', 'uploads\\product_images\\product_4\\46c4cfef66d08b9915b899d43440052e0f6854d9.jpg', 0, 0),
(6, 5, 'c404338e627877d862539d5e8cb629e6911cb275.jpeg', 'uploads\\product_images\\product_5\\c404338e627877d862539d5e8cb629e6911cb275.jpeg', 0, 0),
(7, 6, '80dc9188cfbefceb0c740a3e2489fa456d370e04.jpg', 'uploads\\product_images\\product_6\\80dc9188cfbefceb0c740a3e2489fa456d370e04.jpg', 0, 0),
(8, 7, 'a5ce87908d7ae6d0ba796baacc3b987202bb2788.jpeg', 'uploads/product_images/product_7/a5ce87908d7ae6d0ba796baacc3b987202bb2788.jpeg', 0, 0),
(9, 8, '14fd8efe998111324342b0ca8df21b951079dbbb.jpeg', 'uploads/product_images/product_8/14fd8efe998111324342b0ca8df21b951079dbbb.jpeg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_option_refs`
--

CREATE TABLE `product_option_refs` (
  `id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `option_id` int(11) DEFAULT NULL,
  `inventory` int(11) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_option_refs`
--

INSERT INTO `product_option_refs` (`id`, `created_at`, `updated_at`, `product_id`, `option_id`, `inventory`, `deleted`) VALUES
(1, '2019-07-15 09:56:47', '2020-02-19 09:45:30', 1, 1, 2, 0),
(2, '2019-07-15 09:58:25', '2020-02-19 09:45:31', 1, 2, 4, 0),
(5, '2019-07-22 06:32:06', '2019-08-27 11:25:18', 4, 2, 8, 0),
(6, '2019-08-27 08:34:57', '2020-02-19 09:55:23', 2, 2, 5, 0),
(7, '2019-08-27 08:38:15', '2019-08-27 08:39:31', 3, 4, 6, 0),
(8, '2019-08-27 08:39:16', '2019-08-27 08:39:16', 3, 1, 5, 0),
(9, '2019-09-05 12:05:47', '2020-02-19 08:41:22', 6, 2, 10, 0),
(10, '2019-09-05 12:05:47', '2020-02-19 08:41:22', 6, 4, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `gateway` varchar(15) DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `charge_id` varchar(255) DEFAULT NULL,
  `success` tinyint(4) DEFAULT NULL,
  `reason` varchar(155) DEFAULT NULL,
  `card_brand` varchar(25) DEFAULT NULL,
  `last4` varchar(4) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `shipping_address1` varchar(255) DEFAULT NULL,
  `shipping_address2` varchar(255) DEFAULT NULL,
  `email` varchar(155) DEFAULT NULL,
  `phone` varchar(155) DEFAULT NULL,
  `shipping_city` varchar(155) DEFAULT NULL,
  `shipping_state` varchar(155) DEFAULT NULL,
  `shipping_zip` varchar(55) DEFAULT NULL,
  `shipping_country` varchar(15) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `created_at`, `updated_at`, `cart_id`, `gateway`, `type`, `amount`, `charge_id`, `success`, `reason`, `card_brand`, `last4`, `name`, `shipping_address1`, `shipping_address2`, `email`, `phone`, `shipping_city`, `shipping_state`, `shipping_zip`, `shipping_country`, `deleted`) VALUES
(44, '2019-08-20 08:59:40', '2019-08-20 11:20:00', 26, 'PesaPal', 'MPESA', 6.00, '782a6230-7077-4de2-909a-065b24780d4e', 1, 'paid', 'MPESA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(48, '2019-08-20 10:51:12', '2019-08-20 10:59:41', 28, 'PesaPal', 'MPESA', 6.00, 'c0bdb7c7-b4a5-40a1-ad68-08468c1c79cb', 1, 'paid', 'MPESA', NULL, 'Anthony ngugi', '123 Kenya', 'Kamakis', NULL, NULL, 'Ruiru', 'Kamakis', '254', NULL, 0),
(49, '2019-08-23 16:21:53', '2019-08-23 16:28:35', 29, 'PesaPal', 'MPESA', 14.00, '297f8c61-95cc-46b2-a59e-9f060fb38f3e', 1, 'paid', 'MPESA', NULL, 'Anthony Robert Ngugi Wanjiru', 'Kampala Road Off Enterprise Road', 'Kampara RD', NULL, NULL, 'Nairobi', 'Kenya', '10203', NULL, 0),
(50, '2019-08-27 11:09:30', '2019-08-27 12:24:58', 30, 'PesaPal', 'MPESA', 2.00, '33b07db3-89f1-42db-8c8d-f1b297477a64', 1, 'paid', 'MPESA', NULL, 'Anthony Robert Ngugi Wanjiru', 'Kampala Road Off Enterprise Road', 'Kampara RD', 'tonierobie@gmail.com', '+254728519998', 'Nairobi', 'Kenya', '10203', NULL, 0),
(59, '2019-08-27 12:48:26', '2019-08-27 12:50:51', 34, 'PesaPal', 'MPESA', 2.00, 'b757092e-2b68-4fb7-a95c-2f532dddebb2', 1, 'paid', 'MPESA', NULL, 'Anthony Robert Ngugi Wanjiru', 'Kampala Road Off Enterprise Road', 'Kampara RD', 'tonierobie@gmail.com', '728519998', 'Nairobi', 'Kenya', '10203', NULL, 0),
(60, '2019-09-21 13:40:19', '2019-09-21 13:40:19', 36, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'Anth', 'jiji', 'okpok&oacute;', 'okok@jjnj', 'kk555', '4455685', '56565566', '65', NULL, 0),
(61, '2020-02-17 00:27:57', '2020-02-18 07:04:05', 39, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'African Woman', 'segwegt', 'segweg', 'scentronia@gmail.com', '+254728519998', 'naiiii', 'kikjij', '254', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `username` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `fname` varchar(150) DEFAULT NULL,
  `lname` varchar(150) DEFAULT NULL,
  `acl` text,
  `artistic_name` varchar(155) DEFAULT NULL,
  `description` text,
  `approval` tinyint(4) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `created_at`, `updated_at`, `username`, `email`, `password`, `fname`, `lname`, `acl`, `artistic_name`, `description`, `approval`, `deleted`) VALUES
(1, '2019-07-12 06:14:11', '2019-07-16 08:47:07', 'tonierobie@gmail.com', 'tonierobie@gmail.com', '$2y$10$SIs5Oa8.F.4TAQ90Q.wjxexIFJiGyPzQr2ZmVSC4CWk88dfNyTBYC', 'Anthony', 'Ngugi', '[\"SuperAdmin\"]', 'Anthony Ngugi', '', 1, 0),
(2, '2019-08-28 08:32:47', '2019-12-10 05:05:30', 'ivy.kamau', 'ivy@ivyarticstudio.com', '$2y$10$ViSGgftbbOdP4f3hcmrahelXO8ISJzLl0RWRVTRj9aP1Pcu64DhUK', 'Ivy', 'Kamau', '[\"SuperAdmin\"]', 'Davina', '&lt;p&gt;ivy.kamau&lt;/p&gt;', 1, 0),
(3, '2019-07-15 07:55:15', '2019-07-16 11:05:18', 'scentronia2@gmail.com', 'scentronia2@gmail.com', '$2y$10$O48clsEyR43kUDNqIIDKUOz6tKckgw2mCK1ccnTIEt/7bM84AnrKS', 'Jak Moses', 'Katarikawe', '[\"Artist\"]', 'Jak Katarikawe', '&lt;div class=&quot;ce_text block&quot;&gt;\r\n&lt;div class=&quot;ce_text block&quot;&gt;\r\n&lt;h1&gt;Jak Katarikawe&lt;/h1&gt;\r\n&lt;p class=&quot;StandardWeb1&quot;&gt;&lt;span style=&quot;font-size: 12px;&quot;&gt;&lt;strong&gt;born in 1938, Kigezi, Kabale, Uganda&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p class=&quot;StandardWeb1&quot;&gt;&lt;span style=&quot;font-size: 12px;&quot;&gt;&lt;strong&gt;Lives and works since 1981 as a freelance &lt;em&gt;painter&lt;/em&gt; in Nairobi, Kenya&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p class=&quot;StandardWeb1&quot;&gt;&lt;span style=&quot;font-size: 12px;&quot;&gt;&lt;strong&gt;Participation in: Jo&amp;rsquo;burg Art Fair 2010, Johannesburg and 7th Biennial Dak&amp;rsquo;Art 2006, Dakar&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p class=&quot;StandardWeb1&quot;&gt;&lt;span style=&quot;font-size: 11px;&quot;&gt;Since 1966 more then 100 exhibitions local - national - worldwide&lt;/span&gt;&lt;/p&gt;\r\n&lt;p class=&quot;StandardWeb1&quot;&gt;&lt;span style=&quot;font-size: 11px;&quot;&gt;Worldwide represented in more than 60 galleries, museums and collections&lt;/span&gt;&lt;/p&gt;\r\n&lt;p class=&quot;StandardWeb1&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p class=&quot;StandardWeb1&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;div class=&quot;ce_text block&quot;&gt;\r\n&lt;p&gt;&lt;strong&gt;&lt;a name=&quot;artist profil&quot;&gt;&lt;/a&gt; Artist Profil&lt;br /&gt;&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Jak Katarikawe, who now lives in Nairobi, began working as a self-taught painter in the mid-1960s. He is best known for his narrative and colourful imagery. His paintings invoke stories of everyday life in Africa and carry the influence of his upbringing in rural south-western Uganda: wonderful stories of amorous elephants, dancing cows, jealous lovers and working women. The real mingles with the unreal, reality and dreams become indistinguishable. Although the colours may seem to be those of a carefree artist, the vivid imagery is deceptive, for Katarikawe also addresses moral concerns and the harsh conditions around him.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;div class=&quot;ce_text block&quot;&gt;\r\n&lt;p&gt;&lt;strong&gt;&lt;a name=&quot;awarding&quot;&gt;&lt;/a&gt; Awarding &lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1999 &lt;/strong&gt;- National Award (Kenia), K&amp;uuml;nstler aus 52 L&amp;auml;ndern zum Thema: &quot;Mein Land im Jahr 2000&quot;, The Winsor &amp;amp; Newton Worldwide Millenium Painting Competition, UN Headquarters New York, USA&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1970 &lt;/strong&gt;- Preis der Kunstzeitschrift &quot;African Arts&quot;, Los Angeles, USA&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1967 &lt;/strong&gt;- Erster Workshop-Preis der East African Community, Dar es Salaam, Tansania&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;div class=&quot;ce_text block&quot;&gt;\r\n&lt;p&gt;&lt;strong&gt;&lt;a name=&quot;exhibitions&quot;&gt;&lt;/a&gt; Solo Exhibitions (Selection)&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;2014 &lt;/strong&gt;- &quot;Jak Katarikawe&quot;, The Nairobi Gallery, National Museums of Kenya, 31. 8. - 1. 12. 2014&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;2006 &lt;/strong&gt;- &quot;Dreaming in Pictures&amp;ldquo;, Mtsifa Gallery / Makerere University, Kampala, Uganda&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;2005 &lt;/strong&gt;- &quot;Dreaming in Pictures&amp;ldquo;, National Gallery/Ford Foundation, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;2001 &lt;/strong&gt;- &amp;bdquo;Bilder aus Tr&amp;auml;umen. Jak Katarikawe (Uganda)&amp;ldquo;, Galerie 37, Frankfurt/Main, Deutschland (15. 9. &amp;ndash; 31. 3. 2002)&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1999 &lt;/strong&gt;- &amp;bdquo;Trust God, he will crown your Efforts with Success. An Exhibition with Paintings by Jak Katarikawe&amp;ldquo;, French Cultural Centre, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1998 -&lt;/strong&gt; &amp;bdquo;Feast fo the Eyes&amp;ldquo;, mit Zachary Mbutha, Gallery Watatu, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1994 &lt;/strong&gt;- &amp;bdquo;Jak Katarikawe. Years of Dreaming. A First Retrospective&amp;ldquo;, Gallery Watatu, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1993 &lt;/strong&gt;- French Cultural Centre, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1992 &lt;/strong&gt;- &amp;bdquo;Jak Katarikawe. Malerei und Grafik aus Ostafrika&amp;ldquo;, Museum f&amp;uuml;r V&amp;ouml;lkerkunde, Leipzig, Deutschland&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1991 &lt;/strong&gt;- &amp;bdquo;Jak Katarikawe&amp;ldquo;, Museum f&amp;uuml;r V&amp;ouml;lkerkunde, Frankfurt/M., Deutschland&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1990 &lt;/strong&gt;- Jak Katarikawe. &amp;Ouml;lbilder und Drucke 1976-1989&amp;ldquo;, Iwalewa Haus, Bayreuth, Deutschland&lt;/p&gt;\r\n&lt;p&gt;- &amp;bdquo;Kigezi&amp;ldquo;, Gallery Watatu, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;- &amp;bdquo;Art Brewed in an African Pot. An Exhibition of Paintings by Jak Katarikawe&amp;ldquo;, Nairobi Safari Club, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1982 &lt;/strong&gt;- French Cultural Centre, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1980 &lt;/strong&gt;- French Cultural Centre, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1977 &lt;/strong&gt;- &amp;bdquo;Jak Katarikawe. Peinture et Musique&amp;ldquo;, French Cultural Centre, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;- Ausstellung mit Keith Harrington, Gallery Watatu, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1975 &lt;/strong&gt;- The Commonwealth Institute, London, England (&amp;ndash; 1976)&lt;/p&gt;\r\n&lt;p&gt;- African Heritage, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;- Gallery Watatu, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1974 &lt;/strong&gt;- Textile Craft School, Kampala, Uganda&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1970 &lt;/strong&gt;- Nommo Gallery, Kampala, Uganda&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1969 &lt;/strong&gt;- Nommo Gallery, Kampala, Uganda&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1968 &lt;/strong&gt;- Ausstellung mit Samwel Wanjau, Kibo Gallery, Moshi, Tansania&lt;/p&gt;\r\n&lt;p&gt;- Ausstellung mit Samwel Wanjau, Paa ya Paa Gallery, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1966 -&lt;/strong&gt; Uganda Museum and National Theatre, Kampala, Uganda&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;Group Exhibitions (Selection)&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;2014 &lt;/strong&gt;- &quot;The Gems of Contemporary Kenyan Art&quot;, Alliance Fran&amp;ccedil;aise, Nairobi, Kenya, 16. 9. - 5. 10. 2014&lt;strong&gt;&lt;br /&gt;&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;2011 &lt;/strong&gt;- Spherique - Indian Ocean Art Project, Plan Hotel Group, Diamonds Star of the East - Zanzibar, Tansania&lt;/p&gt;\r\n&lt;p&gt;- Jak Katarikawe, Wanyu Brush, &lt;a href=&quot;http://www.kunst-transit-berlin.de/sane-wadu.html&quot;&gt;Sane Wadu&lt;/a&gt;, Gallery Watatu, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;- Uganda Modern Art, Honorarkonsulat, M&amp;uuml;nchen, Bonn, Wien&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;2010 &lt;/strong&gt;- Jo&amp;rsquo;burg Art Fair, Johannesburg, S&amp;uuml;dafrika&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;2009 &lt;/strong&gt;- Gallery Watatu, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;2008 &lt;/strong&gt;- &amp;bdquo;Angaza Africa: African Art Now&amp;ldquo;, Laurens King, USA&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;2007 &lt;/strong&gt;- &quot;AfriqueEurope: Reves croises&quot;, Les Ateliers des Tanneurs, Br&amp;uuml;ssel, Belgien&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;2006 &lt;/strong&gt;- Banana Hill, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;- Gallery Watatu, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;- &amp;bdquo;7. Biennale Dak&amp;rsquo;Art &amp;ndash; Biennale l&amp;rsquo;art africain contemporain&amp;ldquo;, Dakar, Senegal&lt;/p&gt;\r\n&lt;p&gt;- &amp;bdquo;Ostafrikanische Kunst aus der Sammlung Guido Ast&amp;ldquo;, Bettendorffsche Galerie, Im Schlossgarten, Leinen-Gauangeloch, Deutschland&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;2003 &lt;/strong&gt;- &amp;bdquo;Thelathini: 30 faces, 30 facets of contemporary art in Kenya&amp;ldquo;, Kuona Trust, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;- Jak Katarikawe, East African Art Biennale, Dar es Salaam, Tanzania&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;2001 &lt;/strong&gt;- &amp;bdquo;Tagewerke. Bilder zur Arbeit in Afrika&amp;ldquo;, Galerie 37, Frankfurt/M., Deutschland&lt;/p&gt;\r\n&lt;p&gt;- Museum f&amp;uuml;r V&amp;ouml;lkerkunde, Hamburg, Deutschland&lt;/p&gt;\r\n&lt;p&gt;- &amp;bdquo;Is that Art?&amp;ldquo;, Ramoma: Rahimtullah Museum of Modern Art, Nairobi, Kenia 2000&lt;/p&gt;\r\n&lt;p&gt;- &amp;bdquo;Art Explosion&amp;ldquo;, Village Market, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;- &amp;bdquo;Die lachende Dritte&amp;ldquo;, Museum f&amp;uuml;r V&amp;ouml;lkerkunde - Galerie 37, Frankfurt, Deutschland&lt;/p&gt;\r\n&lt;p&gt;- &amp;ldquo;Our World Year 2000&amp;ldquo;, Mall Galleries, London, England; World Trade Center, Stockholm, Schweden; United Nations, New York, USA&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;2000 -&lt;/strong&gt; &quot;Mixed Exhibition of internatilnal Artists&quot;, Gallery Kentaro, Studen, Schweiz, 19. 10. - 14. 11. 2000&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1999 &lt;/strong&gt;- &amp;bdquo;My Country in the Year 2000&amp;ldquo;, Gallery Watatu, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1998 &lt;/strong&gt;- &amp;bdquo;Spirit Lives On&amp;ldquo;, Paa ya Paa/Gallery Watatu/French Cultural Centre, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1997 &lt;/strong&gt;- &amp;bdquo;Katarikawe and Kitengela Glass&amp;ldquo;, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1996 &lt;/strong&gt;- &amp;bdquo;Contemporary Art in Uganda&amp;ldquo;, Kunsthaus am Schloss, Aschaffenburg, Deutschland&lt;/p&gt;\r\n&lt;p&gt;- &amp;bdquo;Wasser in Afrika&amp;ldquo;, Regierungspr&amp;auml;sidium, Darmstadt, Deutschland&lt;/p&gt;\r\n&lt;p&gt;- &amp;bdquo;Zeitgen&amp;ouml;ssische afrikanische Kunst&amp;ldquo;, GTZ, Eschhorn, Deutschland&lt;/p&gt;\r\n&lt;p&gt;- &amp;bdquo;Kunst aus Ostafrika&amp;ldquo;, Kunst Transit, Berlin, Deutschland&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1995 &lt;/strong&gt;- &amp;bdquo;Charity Art Exhibition in aid of the National&amp;ldquo;, Spinal Injury Hospital, New Stanley Hotel, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1994 &lt;/strong&gt;- &amp;ldquo;Das Neue Afrika&amp;ldquo;, Schirn, Kunsthalle Frankfurt, Deutschland&lt;/p&gt;\r\n&lt;p&gt;- &amp;ldquo;Vernissage Total&amp;ldquo;, French Cultural Centre, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;- &amp;bdquo;Art Afrika&amp;ldquo;, Pan African Congress, Kampala, Uganda&lt;/p&gt;\r\n&lt;p&gt;- &amp;bdquo;Group &amp;sbquo;94&amp;ldquo;, Gallery Watatu, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;- &amp;bdquo;The Custodian&amp;rsquo;s View&amp;ldquo;, Gallery Watatu, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1993 &lt;/strong&gt;- &amp;bdquo;Entdeckungen. Zeitgen&amp;ouml;ssische Kunst aus Ostafrika&amp;ldquo;, Ludwigshafen, Deutschland&lt;/p&gt;\r\n&lt;p&gt;- &amp;bdquo;Kenya Festival Arts Auction&amp;ldquo;, Gallery Watatu, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;- &amp;bdquo;Artist&amp;rsquo; Visions of Family Planning&amp;ldquo;, Goethe Institut, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;- &amp;bdquo;Kunst aus Afrika heute. Meisterwerke der Sammlung Peus, Hamburg&amp;ldquo;, Ludwig Forum f&amp;uuml;r Internationale Kunst, Aachen, Deutschland&lt;/p&gt;\r\n&lt;p&gt;- &quot;African Contemporary Art&amp;ldquo;, Gallery Parco, Tokio and Nagoya, Japan&lt;/p&gt;\r\n&lt;p&gt;- &amp;bdquo;End of the Year Show&amp;ldquo;, Gallery Watatu, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1992 &lt;/strong&gt;- &amp;bdquo;Rafiki wa Zamani&amp;ldquo;, Gallery Watatu, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;&amp;bdquo;Kenya Art Panorama&amp;ldquo;, French Cultural Centre, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1991 &lt;/strong&gt;- &amp;bdquo;Custodian&amp;rsquo;s View&amp;ldquo;, Gallery Watatu, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;- &amp;bdquo;Frauen der Welt&amp;ldquo;, Koeln, Deutschland&lt;/p&gt;\r\n&lt;p&gt;- &amp;bdquo;Mit Pinsel und Mei&amp;szlig;el. Zeitgen&amp;ouml;ssische afrikanische Kunst&amp;ldquo;, Museum f&amp;uuml;r V&amp;ouml;lkerkunde, Frankfurt/M., Deutschland&lt;/p&gt;\r\n&lt;p&gt;- Art of East Africa&amp;ldquo;, Gallery Watatu, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;- &amp;bdquo;Gallery Artists&amp;ldquo;, Gallery Watatu, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1990 &lt;/strong&gt;- &amp;bdquo;Kunst uit Kenya&amp;ldquo;, Technische Universiteit, Eindhoven, Deutschland&lt;/p&gt;\r\n&lt;p&gt;- Gallery Watatu, Nairobi, Kenia (2x)&lt;/p&gt;\r\n&lt;p&gt;- &amp;bdquo;Wegzeichen. Neue Kunst aus Afrika&amp;ldquo;, Museum f&amp;uuml;r V&amp;ouml;lkerkunde, Frankfurt/M., Deutschland&lt;/p&gt;\r\n&lt;p&gt;- &amp;bdquo;&amp;rsquo;Abstracte kunst ist e persoonlijk&amp;rsquo;. Traditionele verhalen zijn het thema voor moderne kunstenaars uit Kenya&amp;ldquo;, Onze wereld, Amsterdam, Niederlande&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1989 &lt;/strong&gt;- &amp;bdquo;Christmas Exhibition&amp;ldquo;, Gallery Watatu, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1987 &lt;/strong&gt;- &amp;bdquo;Ostafrikanische K&amp;uuml;nstler&amp;ldquo;, Deutsche Stiftung f&amp;uuml;r Entwicklungsl&amp;auml;nder, Feldafing, Deutschland&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1985 &lt;/strong&gt;- &amp;bdquo;Art Fights Hunger&amp;ldquo;. Kenya Freedom from Hunger Council, Sarit Centre, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1984 &lt;/strong&gt;- &amp;bdquo;Sanaa. East Africa Contemporary Art&amp;ldquo;, The Commonwealth Institute, London, England&lt;/p&gt;\r\n&lt;p&gt;- Kulturamt Hannover - Kubus, Hannover, Deutschland&lt;/p&gt;\r\n&lt;p&gt;- &amp;bdquo;Neue Kunst aus Afrika. Afrikanische Gegenwartskunst aus der Sammlung Gunter Peus&amp;ldquo;,&lt;/p&gt;\r\n&lt;p&gt;- Katholische Akademie/Kulturbeh&amp;ouml;rde Hamburg, Deutschland&lt;/p&gt;\r\n&lt;p&gt;- International Monetary Fund, Washington, USA&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1983 &lt;/strong&gt;- Gallery Watatu, Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;- Linden Museum, Stuttgart, Deutschland&lt;/p&gt;\r\n&lt;p&gt;- Institut f&amp;uuml;r Auslandsbeziehungen, Stuttgart, Deutschland&lt;/p&gt;\r\n&lt;p&gt;- &amp;bdquo;Annual Visual Arts Exhibition/Kenya 20th Independence Anniversary&amp;ldquo;, City Hall Nairobi, Kenia&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1981 &lt;/strong&gt;- The Commonwealth Institute, London, England (Teil der Horizonte-Ausstellung 1978/79)&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1980 &lt;/strong&gt;- Tropenmuseum, Amsterdam, Niederlande&lt;/p&gt;\r\n&lt;p&gt;- Liljevalch Konsthall, Stockholm, Schweden&lt;/p&gt;\r\n&lt;p&gt;- Buchmesse (Paulskirche), Frankfurt/Main, Deutschland&lt;/p&gt;\r\n&lt;p&gt;- St&amp;auml;dtische Galerie im Schlossgarten, Erlangen, Deutschland&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1979 &lt;/strong&gt;- &amp;bdquo;Horizonte 79. Festival der Weltkulturen - Kunst aus Afrika&amp;ldquo;, Berliner Festspiele, Berlin (West), Bundesrepublik Deutschland (Wanderausstellung: Bremen, Stockholm, Erlangen, Amsterdam, Frankfurt/M.)&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1977 &lt;/strong&gt;- FESTAC - Second International Black and African Festival of Arts and Culture, Lagos, Nigeria&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1975 &lt;/strong&gt;- Africa Centre, London, England&lt;/p&gt;\r\n&lt;p&gt;- Commenwealth Institute, London, England (Solo- und Gruppenausstellung, -1976)&lt;/p&gt;\r\n&lt;p&gt;- &amp;ldquo;Kunst, Handwerk in Afrika im Wandel&amp;ldquo;, Museum f&amp;uuml;r V&amp;ouml;lkerkunde, Frankfurt, Deutschland&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1971 &lt;/strong&gt;. Wanderausstellung, Schweiz und USA (-1974)&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1970 &lt;/strong&gt;- Nommo Gallery, Kampala, Uganda&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1969 &lt;/strong&gt;- Union Carbide/Unesco, New York, USA (f&amp;uuml;r Unesco)&lt;/p&gt;\r\n&lt;p&gt;- Nommo Gallery, Kampala, Uganda&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1967 &lt;/strong&gt;- Institute of Adult Education, Kampala, Uganda&lt;/p&gt;\r\n&lt;p&gt;- New Stanley Art Gallery, New Stanley Hotel, Nairobi, Kenia&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;div class=&quot;ce_text block&quot;&gt;\r\n&lt;p&gt;&lt;strong&gt;&lt;a name=&quot;publications&quot;&gt;&lt;/a&gt; Publications (Selection)&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;- Gacheru, Margaretta wa, &quot;Creating Contemporary African Art: Art Networks in Urban Kenya: 1960 &amp;ndash; 2010&quot;, Loyola University Chicago, 2014&lt;/p&gt;\r\n&lt;p&gt;- Jo&amp;rsquo;burg Art Fair 2010, Johannesburg 2010&lt;/p&gt;\r\n&lt;p&gt;- Enwezor, Okwui; Okeke-Agulu, Chika, &amp;bdquo;Contemporary African Art Since 1980&amp;ldquo;, Bologna, 2009&lt;/p&gt;\r\n&lt;p&gt;- Schmidt, Wendelin u. a., &amp;bdquo;Foyer des Arts. &amp;Uuml;ber die DAK&amp;rsquo;ART 2006&amp;ldquo;, in: Texte zur Kunst, September 2006, Nr. 63, S.256-260&lt;/p&gt;\r\n&lt;p&gt;- Dak&#039;Art 2006, &quot;Katarikawe, Jak : Uganda&quot;, 7&amp;egrave;me biennale de l&#039;art africain contemporain, Pages 204-207&lt;/p&gt;\r\n&lt;p&gt;- Spring, Chris, &quot;Angaza Africa: African Art Now&quot; (Katalog), Laurence King 2006&lt;/p&gt;\r\n&lt;p&gt;- Court, Elsbeth, &quot;Jak Katarikawe - mind the gap&quot;, in: African arts. 37 (2), sommer 2004, pages 8, 91&lt;/p&gt;\r\n&lt;p&gt;- Court, Elsbeth, &amp;bdquo;Thelathini: 30 faces, 30 facets of centemporary art in Kenya&amp;ldquo;, Kuona Trust, Nairobi 2003, Pages 104-108, 142&lt;/p&gt;\r\n&lt;p&gt;- &quot;Jak Katarikawe&quot;, in: East Africa Art Biennale - EASTAFAB 2003, Pages 104-107&lt;/p&gt;\r\n&lt;p&gt;- Dialogue: Jak Katarikawe.&quot;, in: African Arts Nr. 36, 2:5, 2003&lt;/p&gt;\r\n&lt;p&gt;- Kasfir, Sidney Littlefield, &quot;Katarikawe Dreaming: Notes on a Retrospective.&quot;, in: African Arts Nr. 35, (4) 74-77, 2002&lt;/p&gt;\r\n&lt;p&gt;- Museum der Weltkulturen, &amp;bdquo;Dreaming in Pictures. Jak Katarikawe&amp;ldquo;, Ford Foundation, Nairobi 2002&lt;/p&gt;\r\n&lt;p&gt;- Museum der Weltkulturen/Galerie 37, &amp;bdquo;Bilder aus Traeumen. Dreaming in Pictures. Jak Katarikawe&amp;ldquo;, Frankfurt/M. 2001&lt;/p&gt;\r\n&lt;p&gt;- Gabriel, Alexandra, Zeitgen&amp;ouml;ssische Malerei in Kenia, (Dissertation), Kunstgeschichtliches Institut, Universit&amp;auml;t Freiburg, 2001&lt;/p&gt;\r\n&lt;p&gt;- Arnoldi, M., C. Kreamer, und M. Mason. &quot;Reflections on &#039;African Voices&#039; at the Smithsonian&#039;s National Museum of Natural History.&quot;, in: African Arts Nr. 34, 2:16-35, 2001&lt;/p&gt;\r\n&lt;p&gt;- Njami, S., &amp;bdquo;El Tiempo de Africa&amp;ldquo;, Centro Atlantico de Arte Moderno, Las Palmas 2000&lt;/p&gt;\r\n&lt;p&gt;- &quot;Africa on Display: Exhibiting Art by Africans&quot;, in: Contemporary Cultures of Display, E. Barker, Hg.&lt;/p&gt;\r\n&lt;p&gt;- Yale and Open University Press, London 1999&lt;/p&gt;\r\n&lt;p&gt;- Beidelman, T.O., The Cool Knife: imagery of Gender, Sexuality and Moral Education in Kaguru&lt;/p&gt;\r\n&lt;p&gt;- Initiation Ritual&amp;ldquo;, Smithsonian institution Press, Washington, DC 1997&lt;/p&gt;\r\n&lt;p&gt;- Rychner, Rose-Marie, &amp;bdquo;Ugandan Artist Promotion Committee, Neuch&amp;acirc;tel 1996. 71 S., S. 67-69,&lt;/p&gt;\r\n&lt;p&gt;- Deliss, Clementine, Hg., &amp;bdquo;Seven Stories About Modern Art in Africa&amp;ldquo;, Whitechapel Art Gallery, London 1995&lt;/p&gt;\r\n&lt;p&gt;- Kleine-Gunk, Bernd, Kunst aus Kenya. Sieben ostafrikanische Maler, Graphium Press, Wuppertal 1994&lt;/p&gt;\r\n&lt;p&gt;- Aghte, Johanna, &amp;bdquo;Religion in Contemporary East African Art&amp;ldquo; in: Journal of religion in Africa, Leiden 24(4), 1994. S. 375-388&lt;/p&gt;\r\n&lt;p&gt;- Becker, Wolfgang (Hg.), &amp;bdquo;Kunst aus Afrika heute. Meisterwerke der Sammlung Peus, Hamburg.&amp;ldquo;, Ludwig Forum f&amp;uuml;r internationale Kunst, Aachen. September 1993&lt;/p&gt;\r\n&lt;p&gt;- Stadtmuseum Ludwigshafen, &amp;bdquo;Entdeckung. Zeitgen&amp;ouml;ssische Kunst aus Ostafrika&amp;ldquo;, Ludwigshafen 1993&lt;/p&gt;\r\n&lt;p&gt;- Althoff, Gabriele, &quot;Der K&amp;uuml;nstler und das Essen: Jak Katarikawe in Deutschland&quot;, in: Jambo Umlaut : Zeitschrift f&amp;uuml;r kenianisch-deutschen Kulturaustausch, No. 6, August-December 1992, pages 34-35&lt;/p&gt;\r\n&lt;p&gt;- Le Centre, &amp;bdquo;Kenya Art Panorama&amp;ldquo;, Centre culturel fran&amp;ccedil;ais, Nairobi 1992&lt;/p&gt;\r\n&lt;p&gt;- &amp;bdquo;Review of Art from Africa. Museum f&amp;uuml;r V&amp;ouml;lkerkunde&amp;ldquo;, in: African Arts 14, 4:7643. 1991.&lt;/p&gt;\r\n&lt;p&gt;- Str&amp;ouml;ter-Bender, Jutta, Zeitgen&amp;ouml;ssische Kunst in der &amp;bdquo;Dritten Welt&amp;ldquo;, K&amp;ouml;ln 1991&lt;/p&gt;\r\n&lt;p&gt;- Iwalewa-Haus, &quot;Jak Katarikawe - Gem&amp;auml;lde und Drucke&quot;, Iwalewa-Haus, Universit&amp;auml;t Bayreuth, 1990&lt;/p&gt;\r\n&lt;p&gt;- Oomen, Mar; van Hulst, Walter (Hg.), &amp;bdquo;&amp;rsquo;Abstracte kunst is te peroonlijk&amp;rsquo;: Traditionele verhalen zijn het thema voor moderne kunstenaars uit Kenya&amp;ldquo;, Onze werdeld, Amsterdam 1990. S. 37-42&lt;/p&gt;\r\n&lt;p&gt;- Agthe, Johanna, &amp;bdquo;Wegzeichen. Signs. Kunst aus Ostafrika 1974 &amp;ndash; 89. Art from East Africa 1974 &amp;ndash; 89&amp;ldquo;. Hg. Museum f&amp;uuml;r Voelkerkunde, Frankfurt/M. 1990&lt;/p&gt;\r\n&lt;p&gt;- Court, E., &quot;Exhibition of Traditional and Contemporary Gourds&quot;, African Arts Nr. 17, 4:82, 1984&lt;/p&gt;\r\n&lt;p&gt;- Katholische Akademie Hamburg, &amp;bdquo;Neue Kunst aus Afrika. Afrikanische Gegenwartskunst aus der Sammlung Gunter Peus&amp;ldquo;, Hamburg 1984&lt;/p&gt;\r\n&lt;p&gt;- Museum fur Voelkerkunde, &amp;bdquo;Mit Pinsel und Mei&amp;szlig;el: Zeitgenoessische afrikanische Kunst&amp;ldquo;, Frankfurt/M. 1981&lt;/p&gt;\r\n&lt;p&gt;- Povey, J. &quot;First Word&quot;, in: African Arts Nr. 7, 4, 1974&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;div class=&quot;ce_text block&quot;&gt;\r\n&lt;p&gt;&lt;strong&gt;&lt;a name=&quot;museums&quot;&gt;&lt;/a&gt;&amp;nbsp;Museums - Exhibition&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;- Museum der Weltkulturen, Frankfurt/M.&lt;/p&gt;\r\n&lt;p&gt;- Gallery Watatu, Nairobi, Kenia (seit 1984)&lt;/p&gt;\r\n&lt;p&gt;- Rockefeller Foundation Office, Nairobi&lt;/p&gt;\r\n&lt;p&gt;- World Bank, Washington/Nairobi&lt;/p&gt;\r\n&lt;p&gt;- Iwalewa-Haus, Bayreuth&lt;/p&gt;\r\n&lt;p&gt;- Kunst Transit Berlin&lt;/p&gt;\r\n&lt;p&gt;- Bernd Kleine-Gunk, F&amp;uuml;rth&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;p class=&quot;StandardWeb1&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;', 1, 0),
(11, '2019-07-15 11:01:41', '2019-08-27 07:16:27', 'anthony', 'ivy@ivyarticstudio.com2', '$2y$10$O21VLUhduQ7WwRj1RdpQwOpF5UTH3hlVoUS1H38jskL9mXDBediz.', 'Cloud', 'Chatanda', '[\"Artist\"]', 'Cloud Chatanda', '&lt;p&gt;Cloud Chatanda ( Njombe - Tanzania 1974) is a visual artists specialized in illustration and drawings. He received his training from Kinondoni Young Artist (KYA). His illustrations have been widespread used in Tanzania in schoolbooks, Magazine and Campaign Comics. Chatanda has received several awards for his work, among others he won the Best AC cartoon award 2013. Chatanda currently works on larger scale hand drawings that deal with daily and city life in Tanzania, he has exhibited his works at Nafasi Art Space.&lt;/p&gt;', 1, 0),
(17, '2019-07-24 10:52:52', '2019-09-06 05:31:51', 'parhamcurtis', 'backup@eapi.co.ke', '$2y$10$tqO2xqSlKhKIeLU2Qy5qVOH5QgggW9O72RI/IeClrqHUEpzCQvhEi', 'Richard Edith', 'Muthamia', '[\"Artist\"]', 'ivy kamau 2', '&lt;p&gt;am a real artist&lt;/p&gt;', 1, 0),
(19, '2019-09-05 12:30:44', '2019-09-05 12:32:12', 'john.doe@ivyarticstudio.com', 'john.doe@ivyarticstudio.com', '$2y$10$rxkuaGKu2Y6cMgEZYpY22u5JoazqFbUmBM5FdHfbIi6J8JMN0teuu', 'John', 'Doe', '[\"Artist\"]', 'John Doe iV', '&lt;p&gt;I am a self-taught artist and wood sculptor. I like to use bright colors and unusual shapes and textures to create visual energy and movement. Many people who view my work tell me that it makes them happy. This past summer I exhibited at Saatchi-The Other Art Fair in Chicago, La Galleria Pall Mall in London, and Signature Gallery in Glencoe, Illinois. This fall I will be exhibiting at the SITE Gallery in New York and the Colorida Gallery in Lisbon, Portugal.&lt;/p&gt;', 1, 0),
(20, '2019-09-05 15:25:46', '2019-09-06 05:31:24', 'Levy Ntabo', 'levyntabo@gmail.com', '$2y$10$5evw2jHx4PW4Cid1SCscYOKprD35LCLxYGYPak.cOAopZqbUt7VXy', 'Levy', 'Ntabo', '[\"Artist\"]', 'Levy', '&lt;p&gt;I do African contemporary art but largerly I want to paint the wildest and wierdest imaginations&lt;/p&gt;', 1, 0),
(21, '2019-09-06 18:50:43', '2019-10-30 05:25:41', 'Veev_arts', 'kuivivy@gmail.com', '$2y$10$LbKMSpZrnwjX/mQP.S2y9.D5g3VQISwobFAHzCwDmEaWCoiKWdK1u', 'vivianne', 'wanyoike', '[\"Artist\"]', 'Veev_arts', '&lt;p&gt;Veev is an artist that loves creating beauty out of scrap. She uses the simple things in our day to day life to make amazing art work to give you that personal touch and experience. Glam up your home or give that personalized gift to your loved ones and make memories with us...&lt;/p&gt;', 1, 0),
(22, '2019-09-07 07:29:40', '2019-09-09 06:36:05', 'FAISAL', 'Chebonabdalla7@gmail.com', '$2y$10$WK4hHuwBgxxQ2Gzddq9nCuUg1Ca3ebtrNZ8kKoTVWm6WtJai2YavG', 'Chebon', 'Abdalla', '[\"Artist\"]', 'FADEDFLAWS', '&lt;p&gt;Charcoal and coloured pencil artist.&lt;/p&gt;', 1, 0),
(23, '2019-12-08 22:51:59', '2019-12-08 22:51:59', 'DonaldKip', 'inbox264@glmux.com', '$2y$10$rwDgLDFTWr.WIWYf/8aETOghg5TXe7zt4lwaNSsttN0sLIVlBN7TC', 'DonaldKip', 'DonaldKip', '', 'DonaldKip', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

CREATE TABLE `user_sessions` (
  `id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `session` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sessions`
--

INSERT INTO `user_sessions` (`id`, `created_at`, `updated_at`, `user_id`, `session`, `user_agent`) VALUES
(1, '2019-09-06 09:00:50', '2019-09-06 09:00:50', 20, 'c9f0f895fb98ab9159f51fd0297e236d', 'Mozilla (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident; Touch; rv:11.0; IEMobile; NOKIA; Lumia 520) like iPhone OS 7_0_3 Mac OS X AppleWebKit (KHTML, like Gecko) Mobile Safari'),
(2, '2019-12-10 05:06:04', '2019-12-10 05:06:04', 2, '70efdf2ec9b086079795c442636b55fb', 'Mozilla (Windows NT 10.0; Win64; x64; rv:70.0) Gecko Firefox');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted` (`deleted`),
  ADD KEY `name` (`name`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted` (`deleted`),
  ADD KEY `purchased` (`purchased`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted` (`deleted`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `option_id` (`option_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `migration` (`migration`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted` (`deleted`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted` (`deleted`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `featured` (`featured`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `name` (`name`),
  ADD KEY `price` (`price`),
  ADD KEY `has_options` (`has_options`),
  ADD KEY `inventory` (`inventory`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted` (`deleted`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `sort` (`sort`);

--
-- Indexes for table `product_option_refs`
--
ALTER TABLE `product_option_refs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `option_id` (`option_id`),
  ADD KEY `inventory` (`inventory`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted` (`deleted`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `success` (`success`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted` (`deleted`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `updated_at` (`updated_at`);

--
-- Indexes for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `session` (`session`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_option_refs`
--
ALTER TABLE `product_option_refs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_sessions`
--
ALTER TABLE `user_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
