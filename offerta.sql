-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2023 at 08:43 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `offerta`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `private_key` varchar(255) NOT NULL,
  `public_key` varchar(255) NOT NULL,
  `privacy_policy` text NOT NULL,
  `terms_and_conditions` text NOT NULL,
  `code` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `img`, `private_key`, `public_key`, `privacy_policy`, `terms_and_conditions`, `code`, `created_at`) VALUES
(1, 'mshoaib22757@gmail.com', '$2y$10$BskpqovGZqb5.HYtqL.Hc.ZC4v9XX0i1g6.kOB03vT.g1IK63lj0q', '', ' 21321312312', ' 31231231231232', '<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea sequi, pariatur, beatae eos, quidem exercitationem quo iusto esse explicabo officiis architecto at cum! Voluptatem velit dolorum tempora dolor hic facilis?</p><ul><li>Lorem, ipsum dolor sit</li><li>Lorem, ipsum dolor</li><li>Lorem, ipsum dolor sit ame</li></ul><p>t consectetur adipisicing elit. Ea sequi, pariatur, beatae eos, quidem exercitationem quo iusto esse explicabo officiis architecto at cum! Voluptatem velit dolorum tempora dolor hic facilis?</p><p><br></p><p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea sequi, pariatur, beatae eos, quidem exercitationem quo iusto esse explicabo officiis architecto at cum! Voluptatem velit dolorum tempora dolor hic facilis?</p><ul><li>Lorem, ipsum dolor sit</li><li>Lorem, ipsum dolor</li><li>Lorem, ipsum dolor sit ame</li></ul><p>t consectetur adipisicing elit. Ea sequi, pariatur, beatae eos, quidem exercitationem quo iusto esse explicabo officiis architecto at cum! Voluptatem velit dolorum tempora dolor hic facilis?</p>', '<p>&nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti, eos? Iste odit facilis quisquam deleniti voluptate quos molestias laboriosam itaque veritatis vitae ea quis omnis dolorem ut, officiis animi placeat.&nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti, eos? Iste odit facilis quisquam deleniti voluptate quos molestias laboriosam itaque veritatis vitae ea quis omnis dolorem ut, officiis animi placeat.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti, eos? Iste odit facilis quisquam deleniti voluptate quos molestias laboriosam itaque veritatis vitae ea quis omnis dolorem ut, officiis animi placeat.</p><p><br></p><p>&nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti, eos? Iste odit facilis quisquam deleniti voluptate quos molestias laboriosam itaque veritatis vitae ea quis omnis dolorem ut, officiis animi placeat.</p><p><br></p><p>&nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti, eos? Iste odit facilis quisquam deleniti voluptate quos molestias laboriosam itaque veritatis vitae ea quis omnis dolorem ut, officiis animi placeat.</p><p><br></p><blockquote>&nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti, eos? Iste odit facilis quisquam deleniti voluptate quos consectetur adipisicing elit. Deleniti, eos? Iste odit facilis quisquam deleniti voluptate quos molestias laboriosam itaque <span style=\"background-color: var(--cui-modal-bg); color: var(--cui-modal-color); font-weight: var(--cui-body-font-weight);\">em ut, officiis animi placeat.&nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti, eos? Iste odit facilis quisqumolestias laboriosam itaque veritatis vitae ea quis omnis dolorem ut, officiis animi placeat.&nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet veritatis vitae ea quis omnis dolorem ut, officiis animi placeat.&nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti, eos? Iste odit facilis quisquam deleniti voluptate quos molestias laboriosam itaque veritatis vitae ea quis omnis doloram deleniti voluptate quos molestias laboriosam itaque veritatis vitae ea quis omnis dolorem ut, officiis animi placeat.</span></blockquote>', 819626, '2022-11-09 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `advertisement_detail`
--

CREATE TABLE `advertisement_detail` (
  `id` int(11) NOT NULL,
  `offer_time` varchar(255) NOT NULL,
  `no_of_days_for_running_ad` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `banner_ad`
--

CREATE TABLE `banner_ad` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `web_img` varchar(255) NOT NULL,
  `web_img_link` varchar(255) NOT NULL,
  `app_img` varchar(255) NOT NULL,
  `app_img_link` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banner_ad`
--

INSERT INTO `banner_ad` (`id`, `user_id`, `title`, `description`, `web_img`, `web_img_link`, `app_img`, `app_img_link`, `start_date`, `end_date`, `created_at`) VALUES
(41, 42, 'My title', 'my discrip[tion', '', 'asset/banner/web/20230207_19170.jpg', '', 'asset/banner/app/20230207_19170.jpg', '2022-02-02', '2022-02-08', '2023-02-07 07:07:00');

-- --------------------------------------------------------

--
-- Table structure for table `banner_configuration`
--

CREATE TABLE `banner_configuration` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `web_length` int(11) NOT NULL,
  `web_width` int(11) NOT NULL,
  `app_length` int(11) NOT NULL,
  `app_width` int(11) NOT NULL,
  `app_cost` varchar(255) NOT NULL,
  `web_cost` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banner_configuration`
--

INSERT INTO `banner_configuration` (`id`, `description`, `web_length`, `web_width`, `app_length`, `app_width`, `app_cost`, `web_cost`, `created_at`) VALUES
(19, 'just test', 0, 0, 0, 0, '123', '123', '2023-02-07 06:32:00');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `graph` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `analytic` varchar(255) NOT NULL,
  `cover_img` varchar(255) NOT NULL,
  `cover_video` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `image_url`, `created_at`) VALUES
(89, 'jacket', 'http://localhost/offerta-admin-panel/assets/category/20230207_10175.svg', '{{baseurl}}/assets/category/20230207_10175.svg', '2023-02-07 06:28:00'),
(90, 'Shoes', 'assets/category/20230207_24224.svg', '{{baseurl}}/assets/category/20230207_24224.svg', '2023-02-07 06:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `chat_community`
--

CREATE TABLE `chat_community` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `chat_with` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `exchange`
--

CREATE TABLE `exchange` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `second_user` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `item2` varchar(255) NOT NULL,
  `status` enum('outgoing','incoming','success','failed') NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `following_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `list_id`) VALUES
(8, 39, 39);

-- --------------------------------------------------------

--
-- Table structure for table `listing`
--

CREATE TABLE `listing` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `location_lat` decimal(11,6) NOT NULL,
  `location_log` decimal(11,6) NOT NULL,
  `product_condition` varchar(255) NOT NULL,
  `exchange` varchar(255) NOT NULL,
  `fixed_price` varchar(255) NOT NULL,
  `giveaway` varchar(255) NOT NULL,
  `shipping_cost` varchar(255) NOT NULL,
  `sold` enum('avaliable','sold') NOT NULL,
  `youtube_link` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `location_address` varchar(255) NOT NULL,
  `location_log` varchar(255) NOT NULL,
  `location_lat` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `online_status` varchar(255) NOT NULL,
  `email_verified_status` enum('0','1') NOT NULL,
  `status` enum('active','block') NOT NULL,
  `phone_no_verified_status` varchar(255) NOT NULL,
  `email_code` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`id`, `full_name`, `image`, `user_name`, `password`, `email`, `location_address`, `location_log`, `location_lat`, `phone_no`, `online_status`, `email_verified_status`, `status`, `phone_no_verified_status`, `email_code`, `created_at`) VALUES
(43, '', '', '', '$2y$10$lfSczGDtKUsp2ZcZG/HtLOfDsDf0OXo9J.bTYnkg6nc3pdDx0rXFO', 'mshoaib227557@gmail.com', '', '', '', '', '', '0', 'active', '', '', '2023-02-07 08:33:00'),
(44, '', '', '', '$2y$10$RD7SNMQvh6VWN4xP4Ol/7e0EN6WKfU820LGOoNtoh1X4e38qusiha', 'mshoaib22755@gmail.com', '', '', '', '', '', '0', 'active', '', '', '2023-02-07 08:33:00'),
(45, '', '', '', '$2y$10$h9SPwO7rJqWPgqHMJAvHbux/yFju06.XRMql27VZQH3YZdHndI6ea', 'mshoaib22757@gmail.com', '', '', '', '', '', '0', 'active', '', '', '2023-02-07 08:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `most_search`
--

CREATE TABLE `most_search` (
  `id` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sale_by` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `status` enum('pending','accept','reject') NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `listing_id` int(11) NOT NULL,
  `feature_price` varchar(255) NOT NULL,
  `features_id` int(11) NOT NULL,
  `advertisement_detail_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reported_users`
--

CREATE TABLE `reported_users` (
  `id` int(11) NOT NULL,
  `reportedBy_user_id` int(11) NOT NULL,
  `reported_user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reviewed_user_id` int(11) NOT NULL,
  `review` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `reviewed_user_id`, `review`) VALUES
(4, 40, 40, 4);

-- --------------------------------------------------------

--
-- Table structure for table `sale_order`
--

CREATE TABLE `sale_order` (
  `id` int(11) NOT NULL,
  `sale_by` int(11) NOT NULL,
  `order_by` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_addresses`
--

CREATE TABLE `shipping_addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `address_1` varchar(255) NOT NULL,
  `address_2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stripe_credentials`
--

CREATE TABLE `stripe_credentials` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `private_key` varchar(255) NOT NULL,
  `public_key` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `category_id`, `created_at`) VALUES
(56, 'Indure', 90, '2023-02-07 06:57:00');

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`id`, `user_id`, `listing_id`) VALUES
(1, 34, 27),
(2, 35, 27);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advertisement_detail`
--
ALTER TABLE `advertisement_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner_ad`
--
ALTER TABLE `banner_ad`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner_configuration`
--
ALTER TABLE `banner_configuration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_community`
--
ALTER TABLE `chat_community`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exchange`
--
ALTER TABLE `exchange`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `listing`
--
ALTER TABLE `listing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `most_search`
--
ALTER TABLE `most_search`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reported_users`
--
ALTER TABLE `reported_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_order`
--
ALTER TABLE `sale_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stripe_credentials`
--
ALTER TABLE `stripe_credentials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `advertisement_detail`
--
ALTER TABLE `advertisement_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `banner_ad`
--
ALTER TABLE `banner_ad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `banner_configuration`
--
ALTER TABLE `banner_configuration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `chat_community`
--
ALTER TABLE `chat_community`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `exchange`
--
ALTER TABLE `exchange`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `listing`
--
ALTER TABLE `listing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `most_search`
--
ALTER TABLE `most_search`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `reported_users`
--
ALTER TABLE `reported_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sale_order`
--
ALTER TABLE `sale_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stripe_credentials`
--
ALTER TABLE `stripe_credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
