-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2023 at 02:01 PM
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
(1, 'admin@gmail.com', '$2y$10$yKoQfaeLZJeACgo7TXbLRuxn0IQFASTXw7idsmUlYQT05PH/H.r7u', '', 'sk_test_51K7Ok1SImwf7DA0fmyPO4NOhzT86MzeD8vDpt8PtXFpBim1ed711h2fpOeytQSZOpVmRgxwkb8ISccAB45BY9IB00ZxorWl3g', 'pk_test_51K7Ok1SImwf7DA0foroMnlRi3yVyjTPI9E5DrhxorvxQuGPF7yB2WU5FnwoFubbeqDQQT40hnsuVbZf6qVhSKauJ00cY5UgqbF', '<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea sequi, pariatur, beatae eos, quidem exercitationem quo iusto esse explicabo officiis architecto at cum! Voluptatem velit dolorum tempora dolor hic facilis?</p><ul><li>Lorem, ipsum dolor sit</li><li>Lorem, ipsum dolor</li><li>Lorem, ipsum dolor sit ame</li></ul><p>t consectetur adipisicing elit. Ea sequi, pariatur, beatae eos, quidem exercitationem quo iusto esse explicabo officiis architecto at cum! Voluptatem velit dolorum tempora dolor hic facilis?</p><p><br></p><p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea sequi, pariatur, beatae eos, quidem exercitationem quo iusto esse explicabo officiis architecto at cum! Voluptatem velit dolorum tempora dolor hic facilis?</p><ul><li>Lorem, ipsum dolor sit</li><li>Lorem, ipsum dolor</li><li>Lorem, ipsum dolor sit ame</li></ul><p>t consectetur adipisicing elit. Ea sequi, pariatur, beatae eos, quidem exercitationem quo iusto esse explicabo officiis architecto at cum! Voluptatem velit dolorum tempora dolor hic facilis?</p>', '<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea sequi, pariatur, beatae eos, quidem exercitationem quo iusto esse explicabo officiis architecto at cum! Voluptatem velit dolorum tempora dolor hic facilis?</p><ul><li>Lorem, ipsum dolor sit</li><li>Lorem, ipsum dolor</li><li>Lorem, ipsum dolor sit ame</li></ul><p>t consectetur adipisicing elit. Ea sequi, pariatur, beatae eos, quidem exercitationem quo iusto esse explicabo officiis architecto at cum! Voluptatem velit dolorum tempora dolor hic facilis?</p><p><br></p><p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea sequi, pariatur, beatae eos, quidem exercitationem quo iusto esse explicabo officiis architecto at cum! Voluptatem velit dolorum tempora dolor hic facilis?</p><ul><li>Lorem, ipsum dolor sit</li><li>Lorem, ipsum dolor</li><li>Lorem, ipsum dolor sit ame</li></ul><p>t consectetur adipisicing elit. Ea sequi, pariatur, beatae eos, quidem exercitationem quo iusto esse explicabo officiis architecto at cum! Voluptatem velit dolorum tempora dolor hic facilis?</p>', 889094, '2022-11-09 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `advertisement_detail`
--

CREATE TABLE `advertisement_detail` (
  `id` int(11) NOT NULL,
  `offer_time` varchar(255) NOT NULL,
  `feature` text NOT NULL,
  `price` varchar(255) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `advertisement_detail`
--

INSERT INTO `advertisement_detail` (`id`, `offer_time`, `feature`, `price`, `tag`, `color`, `created_at`) VALUES
(27, '3 days', '<p>3 days description</p>', '100', 'meddle', '#ff2e2e', '2023-02-09 09:06:00'),
(36, '6 days', '<p>6 days Description</p>', '100', 'Advertisement', '#4400ff', '2023-02-15 08:46:00'),
(37, '9 days', '<p>9&nbsp; days description</p>', '1500', 'High', '#ffed24', '2023-02-15 08:47:00');

-- --------------------------------------------------------

--
-- Table structure for table `banner_ad`
--

CREATE TABLE `banner_ad` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `web_img` varchar(255) NOT NULL,
  `web_img_link` varchar(255) NOT NULL,
  `app_img` varchar(255) NOT NULL,
  `app_img_link` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `cost` int(11) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banner_ad`
--

INSERT INTO `banner_ad` (`id`, `user_id`, `web_img`, `web_img_link`, `app_img`, `app_img_link`, `start_date`, `end_date`, `cost`, `status`, `created_at`) VALUES
(78, 1, '', '', 'asset/banner/app/20230217_86240.png', 'http://youtube.com', '2022-02-17', '2022-03-03', 2800, 'inactive', '2023-02-17 09:25:00'),
(80, 55, '', '', 'asset/banner/app/20230302_28983.avif', 'http://youtube.com', '2022-02-17', '2022-03-10', 4200, 'active', '2023-03-02 01:46:00');

-- --------------------------------------------------------

--
-- Table structure for table `banner_configuration`
--

CREATE TABLE `banner_configuration` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
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
(19, '<div>\r\n<div><strong>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex iusto esse repellendus assumenda&nbsp; </strong>animi velit. Obcaecati reiciendis, enim optio, provident quos dicta illum a, aspernatur alias quae distinctio quasi?</div>\r\n<div>\r\n<div>\r\n<div>&nbsp; &nbsp; Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex iusto esse repellendus assumenda totam animi velit. Obcaecati reiciendis, enim optio, provident quos dicta illum a, aspernatur alias quae distinctio quasi?</div>\r\n<div>\r\n<div>\r\n<div>&nbsp; &nbsp; Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex iusto esse repellendus assumenda totam animi velit. Obcaecati reiciendis, enim optio, provident quos dicta illum a, aspernatur alias quae distinctio quasi?</div>\r\n<div>\r\n<div>\r\n<div>&nbsp; &nbsp; Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex iusto esse repellendus assumenda totam animi velit. Obcaecati reiciendis, enim optio, provident quos dicta illum a, aspernatur alias quae distinctio quasi?\r\n<div>\r\n<div>&nbsp; &nbsp; Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex iusto esse repellendus assumenda totam animi velit. Obcaecati reiciendis, enim optio, provident quos dicta illum a, aspernatur alias quae distinctio quasi?</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', 1900, 400, 1400, 500, '200', '100', '2023-02-07 06:32:00');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `graph` text NOT NULL,
  `reference` varchar(255) NOT NULL,
  `analytic` varchar(255) NOT NULL,
  `cover_img` varchar(255) NOT NULL,
  `cover_video` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `description`, `category_id`, `sub_id`, `graph`, `reference`, `analytic`, `cover_img`, `cover_video`, `created_at`) VALUES
(118, 'My Blog 6', '<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.</div>\r\n<div>\r\n<div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.</div>\r\n<div>&nbsp;</div>\r\n<div><img src=\"assets/upload/20230217_86985.jpg\" alt=\"My alt text\" width=\"369\" height=\"246\"></div>\r\n<div>&nbsp;</div>\r\n<div>\r\n<table style=\"border-collapse: collapse; width: 100.087%; height: 58.7814px;\" border=\"1\"><colgroup><col style=\"width: 50.0434%;\"><col style=\"width: 50.0434%;\"></colgroup>\r\n<tbody>\r\n<tr style=\"height: 19.5938px;\">\r\n<td style=\"height: 19.5938px;\"><strong>Condition</strong></td>\r\n<td style=\"height: 19.5938px;\"><strong>Price</strong></td>\r\n</tr>\r\n<tr style=\"height: 19.5938px;\">\r\n<td style=\"height: 19.5938px;\">new</td>\r\n<td style=\"height: 19.5938px;\">100</td>\r\n</tr>\r\n<tr style=\"height: 19.5938px;\">\r\n<td style=\"height: 19.5938px;\">old</td>\r\n<td style=\"height: 19.5938px;\">50</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.</div>\r\n<div>\r\n<div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.\r\n<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.</div>\r\n<div>\r\n<div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.\r\n<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.</div>\r\n<div>\r\n<div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.\r\n<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.</div>\r\n<div>\r\n<div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.\r\n<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.</div>\r\n<div>\r\n<div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.\r\n<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.</div>\r\n<div>\r\n<div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.\r\n<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.</div>\r\n<div>\r\n<div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.\r\n<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.</div>\r\n<div>\r\n<div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.\r\n<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.</div>\r\n<div>\r\n<div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.\r\n<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.</div>\r\n<div>\r\n<div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.\r\n<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.</div>\r\n<div>\r\n<div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.\r\n<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.</div>\r\n<div>\r\n<div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.\r\n<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.</div>\r\n<div>\r\n<div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.\r\n<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.</div>\r\n<div>\r\n<div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.\r\n<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.</div>\r\n<div>\r\n<div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.\r\n<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.</div>\r\n<div>\r\n<div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.\r\n<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.</div>\r\n<div>\r\n<div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.\r\n<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.</div>\r\n<div>\r\n<div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.\r\n<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.</div>\r\n<div>\r\n<div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ratione unde vel quasi dignissimos. Quos cupiditate iusto id. Expedita harum molestias commodi aspernatur laboriosam libero sunt obcaecati! Deleniti, consectetur delectus.</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', 92, 59, '', 'http://youtube.com', '', 'assets/blog/20230220_14583.jpg', 'https://www.youtube.com/watch?v=zpOULjyy-n8&list=RDzpOULjyy-n8&start_radio=1&ab_channel=RSpwagonVEVO', '2023-02-17 10:42:00'),
(119, 'blog 7', '<div>\r\n<div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</div>\r\n<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores temporibus in ipsa beatae earum corrupti soluta fuga perspiciatis cupiditate quam! Voluptates laudantium nesciunt, dolorum porro libero iste itaque numquam unde.</div>\r\n<div>\r\n<div>\r\n<div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores temporibus in ipsa beatae earum corrupti soluta fuga perspiciatis cupiditate quam! Voluptates laudantium nesciunt, dolorum porro libero iste itaque numquam unde.</div>\r\n<div>\r\n<div>\r\n<div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores temporibus in ipsa beatae earum corrupti soluta fuga perspiciatis cupiditate quam! Voluptates laudantium nesciunt, dolorum porro libero iste itaque numquam unde.</div>\r\n<div>\r\n<div>\r\n<div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores temporibus in ipsa beatae earum corrupti soluta fuga perspiciatis cupiditate quam! Voluptates laudantium nesciunt, dolorum porro libero iste itaque numquam unde.</div>\r\n<div><img src=\"assets/upload/20230217_48779.jpg\" alt=\"My alt text\" width=\"223\" height=\"149\"></div>\r\n<div>\r\n<div>\r\n<div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores temporibus in ipsa beatae earum corrupti soluta fuga perspiciatis cupiditate quam! Voluptates laudantium nesciunt, dolorum porro libero iste itaque numquam unde.</div>\r\n<div><img src=\"assets/upload/20230217_26837.jpg\" alt=\"My alt text\" width=\"225\" height=\"225\"></div>\r\n<div>&nbsp;</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', 92, 59, '', 'http://youtube.com', '', 'assets/blog/20230217_27331.jpg', 'http://youtube.com', '2023-02-17 14:24:00');

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
(97, 'Shoes', 'assets/category/20230302_46924.jpg', '{{baseurl}}/assets/category/20230302_46924.jpg', '2023-03-02 13:27:00'),
(98, 'Clothes', 'assets/category/20230302_73832.jpg', '{{baseurl}}/assets/category/20230302_73832.jpg', '2023-03-02 13:33:00');

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

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `listing_id`, `comment`, `created_at`) VALUES
(9, 24, 46, 'this is comment3', '2023-02-10 10:30:00'),
(10, 43, 46, 'this is comment3', '2023-02-10 10:33:00'),
(11, 1, 48, 'this is comment3', '2023-02-20 11:24:00');

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

--
-- Dumping data for table `exchange`
--

INSERT INTO `exchange` (`id`, `user_id`, `second_user`, `item`, `item2`, `status`, `created_at`) VALUES
(10, 43, 45, '45', '46', 'incoming', '2023-02-08 05:55:00'),
(11, 43, 45, '45', '46', 'outgoing', '2023-02-09 11:53:00'),
(12, 43, 45, '45', '46', 'outgoing', '2023-02-09 11:56:00'),
(13, 43, 45, '45', '46', 'outgoing', '2023-02-09 11:57:00'),
(14, 43, 45, '45', '46', 'outgoing', '2023-02-09 12:01:00'),
(15, 43, 45, '45', '46', 'outgoing', '2023-02-09 12:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `price` int(11) NOT NULL,
  `offer_time` varchar(255) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `title`, `price`, `offer_time`, `tag`, `color`, `created_at`) VALUES
(1, '<div>\r\n<div>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Deserunt voluptas beatae similique eos laudantium quae porro odit cumque delectus dolore consectetur aliquid consequatur, ut cum, voluptates ipsa nisi! Numquam, vel!</div>\r\n<div>\r\n<ul>\r\n<li>Lorem ipsum</li>\r\n<li>Lorem ipsum, dolor</li>\r\n</ul>\r\n</div>\r\n</div>', 500, '2 days', 'urgent', '#ff0000', '2023-02-12 12:12:00');

-- --------------------------------------------------------

--
-- Table structure for table `fee_configuration`
--

CREATE TABLE `fee_configuration` (
  `id` int(11) NOT NULL,
  `company_fee` int(11) NOT NULL,
  `user_fee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fee_configuration`
--

INSERT INTO `fee_configuration` (`id`, `company_fee`, `user_fee`) VALUES
(1, 1000, 1000);

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

--
-- Dumping data for table `listing`
--

INSERT INTO `listing` (`id`, `user_id`, `title`, `description`, `price`, `category_id`, `subcategory_id`, `location`, `location_lat`, `location_log`, `product_condition`, `exchange`, `fixed_price`, `giveaway`, `shipping_cost`, `sold`, `youtube_link`, `created_at`) VALUES
(43, 1, 'my product', 'my description', '20', 92, 59, 'pindi', '10.121200', '0.123000', 'new', 'false', 'true', 'false', '5', 'avaliable', '', '2023-02-08 05:54:00'),
(48, 1, 'my product', 'my description update test', '20', 92, 59, 'pindi', '10.121200', '0.123000', 'new', 'true', 'true', 'true', '5', 'avaliable', 'youtube.com', '2023-02-13 08:46:00'),
(49, 1, 'my product', 'my description update test', '20', 92, 59, 'pindi', '10.121200', '0.123000', 'new', 'true', 'true', 'true', '5', 'avaliable', 'youtube.com', '2023-02-13 08:46:00'),
(50, 1, 'my product', 'my description', '20', 92, 59, 'pindi', '33.565109', '73.016914', 'new', 'true', 'true', 'false', '5', 'avaliable', '', '2023-02-17 10:37:00'),
(51, 1, 'my product', 'my description update test', '20', 92, 59, 'pindi', '33.565109', '73.016914', 'new', 'true', 'true', 'true', '5', 'avaliable', 'youtube.com', '2023-02-20 10:24:00'),
(52, 1, 'Summer Wear Shoes', 'my description', '20', 97, 68, 'pindi', '33.565109', '73.016914', 'new', 'true', 'true', 'false', '5', 'avaliable', '', '2023-03-02 01:38:00'),
(53, 55, 'Zin Jee Clothes', 'my description', '20', 98, 68, 'pindi', '33.565109', '73.016914', 'new', 'true', 'true', 'false', '5', 'avaliable', '', '2023-03-02 01:39:00');

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
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `location_address` varchar(255) NOT NULL,
  `location_log` varchar(255) NOT NULL,
  `location_lat` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `online_status` varchar(255) NOT NULL,
  `email_verified_status` enum('false','true') NOT NULL,
  `status` enum('active','block') NOT NULL,
  `role` enum('user','company') NOT NULL,
  `live_image` varchar(255) NOT NULL,
  `cnic` varchar(255) NOT NULL,
  `subscription` enum('false','true') NOT NULL,
  `phone_no_verified_status` varchar(255) NOT NULL,
  `email_code` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`id`, `full_name`, `image`, `user_name`, `password`, `email`, `country`, `city`, `location_address`, `location_log`, `location_lat`, `phone_no`, `online_status`, `email_verified_status`, `status`, `role`, `live_image`, `cnic`, `subscription`, `phone_no_verified_status`, `email_code`, `created_at`) VALUES
(1, 'A2Z Company', 'asset/profile/20230302_20762.jpg', 'ME', '$2y$10$1MzJA614JXE.4MJJXx0pxuAiDNHoibXosnWjVb/L2YOWCcqcOTj0K', 'user@gmail.com', 'Pakistan', 'pindi', '', '', '', '', '', 'false', 'active', 'user', 'asset/cnic/20230302_17397.jpg', 'asset/live_image/20230302_17397.jpg', 'true', '', '', '2023-03-02 12:41:00'),
(55, 'A2Z Company', 'asset/profile/20230302_58532.jpg', 'ME', '$2y$10$hP1hQIv7GgI1287wSurcsuv/wR3Ip3ks/zvuB8yJUJoke1.gqCAcW', 'company@gmail.com', 'Pakistan', 'pindi', '', '', '', '090000000', '', 'false', 'active', 'company', 'asset/cnic/20230302_89476.jpg', 'asset/live_image/20230302_89476.jpg', 'true', '', '2739', '2023-02-16 02:33:00');

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
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `from_user` int(11) NOT NULL,
  `to_user` int(11) NOT NULL,
  `item1` int(11) NOT NULL,
  `item2` int(11) NOT NULL,
  `notification` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `from_user`, `to_user`, `item1`, `item2`, `notification`, `status`, `created_at`) VALUES
(1, 43, 46, 45, 46, 'Hi,  Want to exchange your Product with ', '', '2023-02-09 15:53:28'),
(7, 46, 46, 47, 0, 'Hi,  Want to make offer on your Product my product', '', '2023-02-13 11:51:28'),
(8, 46, 46, 47, 0, 'Hi, Maya Want to make offer on your Product my product', '', '2023-02-14 10:36:06'),
(9, 46, 46, 47, 0, 'Hi, Maya Want to make offer on your Product my product', '', '2023-02-14 10:56:51');

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
  `status` enum('pending','accept','reject','counter') NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `user_id`, `sale_by`, `listing_id`, `price`, `status`, `created_at`) VALUES
(20, 46, 47, 43, '30', 'pending', '2023-02-13 07:51:00'),
(21, 47, 46, 43, '30', 'pending', '2023-02-14 06:36:00'),
(22, 46, 47, 43, '30', 'counter', '2023-02-14 06:56:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`) VALUES
(65, 49, 'asset/listing/20230214_33379.jpg'),
(66, 49, 'asset/listing/20230214_66033.jpg'),
(67, 49, 'asset/listing/20230214_88492.jpg'),
(68, 43, 'asset/listing/20230214_46188.jpg'),
(69, 43, 'asset/listing/20230214_81221.jpg'),
(70, 43, 'asset/listing/20230214_14251.jpg'),
(71, 48, 'asset/listing/20230214_54423.jpg'),
(72, 48, 'asset/listing/20230214_98466.jpg'),
(73, 48, 'asset/listing/20230214_29673.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `listing_id` int(11) NOT NULL,
  `features_id` int(11) NOT NULL,
  `advertisement_detail_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `user_id`, `listing_id`, `features_id`, `advertisement_detail_id`, `created_at`) VALUES
(43, 1, 48, 1, 0, '2023-02-07 00:00:00'),
(44, 1, 48, 0, 27, '2023-02-07 12:14:00'),
(45, 1, 49, 0, 27, '2023-03-01 06:58:00'),
(48, 1, 49, 1, 0, '2023-02-15 06:58:00'),
(50, 55, 53, 1, 0, '2023-03-02 01:47:00');

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

--
-- Dumping data for table `reported_users`
--

INSERT INTO `reported_users` (`id`, `reportedBy_user_id`, `reported_user_id`, `created_at`) VALUES
(4, 1, 55, '2023-03-02 08:27:00'),
(5, 55, 1, '2023-03-02 08:28:00');

-- --------------------------------------------------------

--
-- Table structure for table `reportlists`
--

CREATE TABLE `reportlists` (
  `id` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reportlists`
--

INSERT INTO `reportlists` (`id`, `listing_id`, `user_id`) VALUES
(46, 48, 46);

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
(4, 40, 40, 4),
(5, 40, 41, 4),
(6, 40, 43, 4),
(7, 40, 46, 4),
(8, 43, 45, 4);

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
  `status` enum('pending','complete') NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale_order`
--

INSERT INTO `sale_order` (`id`, `sale_by`, `order_by`, `listing_id`, `shipping_id`, `status`, `created_at`) VALUES
(3, 46, 47, 48, 8, 'complete', '2023-02-14 06:45:18'),
(4, 46, 47, 48, 8, 'pending', '2023-02-14 06:58:00');

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

--
-- Dumping data for table `shipping_addresses`
--

INSERT INTO `shipping_addresses` (`id`, `user_id`, `country`, `address_1`, `address_2`, `city`, `state`, `zip_code`, `phone_no`, `created_at`) VALUES
(8, 46, 'abc', 'abc1', 'abc2', 'xyz', 'qwe', '123', '09876', '2023-02-14 06:45:54');

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
(67, 'Jaguar', 97, '2023-03-02 13:35:00'),
(68, 'Shalwar Kamiz', 98, '2023-03-02 13:35:00');

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
(24, 46, 27),
(25, 47, 27),
(26, 48, 27),
(27, 49, 27),
(28, 50, 27),
(29, 51, 27),
(30, 52, 27);

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
-- Indexes for table `fee_configuration`
--
ALTER TABLE `fee_configuration`
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
-- Indexes for table `notification`
--
ALTER TABLE `notification`
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
-- Indexes for table `reportlists`
--
ALTER TABLE `reportlists`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `banner_ad`
--
ALTER TABLE `banner_ad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `banner_configuration`
--
ALTER TABLE `banner_configuration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `chat_community`
--
ALTER TABLE `chat_community`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `exchange`
--
ALTER TABLE `exchange`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `fee_configuration`
--
ALTER TABLE `fee_configuration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `listing`
--
ALTER TABLE `listing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `most_search`
--
ALTER TABLE `most_search`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `reported_users`
--
ALTER TABLE `reported_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reportlists`
--
ALTER TABLE `reportlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sale_order`
--
ALTER TABLE `sale_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stripe_credentials`
--
ALTER TABLE `stripe_credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
