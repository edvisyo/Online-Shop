-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2020 at 01:15 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineshopoop`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` float NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `total_price` float NOT NULL,
  `order_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `product_name`, `product_price`, `product_quantity`, `total_price`, `order_created_at`) VALUES
(2, 34, 19, 'Adidas', 39.99, 1, 39.99, '2020-01-12 12:20:24'),
(3, 34, 13, 'Polar megztinis juodas', 39.99, 1, 39.99, '2020-01-13 20:56:28'),
(4, 34, 13, 'Polar megztinis juodas', 39.99, 2, 79.98, '2020-01-17 13:20:02');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` mediumtext NOT NULL,
  `price` double NOT NULL,
  `image` varchar(45) NOT NULL,
  `product_category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `product_category_id`) VALUES
(11, 'NIKE 6.0 ', 'Šiuolaikiski NIKE 6.0 batai spalvoti', 105.99, 'nike_id2.jpg', 2),
(12, 'VANS kepure', 'Vans gamintojo juoda kepure su baltu uzrasu ', 59.99, 'vans_kepure.jpg', 3),
(13, 'Polar megztinis juodas', 'Polar firmos juodas megztinis su auksiniu uzrasu', 39.99, 'polar_megztinis.jpg', 1),
(15, 'ADIDAS ', 'Adidas firmos raudonas megztinis su logotipu', 49.99, 'adidas_megztinis.jpg', 1),
(16, 'FILA', 'Fila baltas/raudonas megztinis', 25.99, 'fila_megztinis.jpg', 1),
(17, 'HUF', 'Huf gamintojo sviesi kepure su pauksciu', 26.99, 'huf_kepure.jpg', 3),
(18, 'NewBallance', 'Batai rudi/sviesus', 59.99, 'newballance_batai.JPG', 2),
(19, 'Adidas', 'Adidas balti marskineliai su logotipu', 39.99, 'adidas_marskineliai.jpg', 4),
(20, 'Stussy', 'Stussy juoda kepure su baltu uzrasu', 59.99, 'stussy_kepure.jpg', 3),
(21, 'Herschel', 'Herschel firmos juoda/balta kepure ', 29.99, 'herschel_id1.jpg', 3),
(24, 'Fila', 'Fila raudoni/balti/juodi', 15.99, 'fila_id2.jpg', 4),
(25, 'Magenta', 'Magenta juodi masrskineliai', 15.99, 'magenta_marskineliai.jpeg', 4),
(26, 'THRASHER ', 'Trasher marskineliai balti', 14.99, 'trasher_marskineliai.jpg', 4),
(27, 'HUF ', 'HUF zalsvi marskineliai', 15.99, 'huf_marskineliai.jpg', 4),
(28, 'Stussy', 'Stussy firmos balti marskineliai', 21.99, 'Stussy_id1.jpg', 4),
(31, 'POLAR', 'Polar firmos juodas megztinis su auksiniu uzrasu', 13.99, 'huf_megztinis.JPG', 1),
(32, 'THRASHER ', 'Thrasher firmos megztinis su baltu logotipu', 15.99, 'trasher_megztinis.jpg', 1),
(35, 'NIKE', 'NIKE gamintojo batai', 69.99, 'nikeSB_batai.jpg', 2),
(36, 'FILA', 'Fila balta kapure', 19.99, 'fila_kepure.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `category_name`) VALUES
(1, 'megztiniai'),
(2, 'batai'),
(3, 'kepures'),
(4, 'marskineliai'),
(5, 'dzinsai'),
(6, 'pirstines');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) NOT NULL,
  `user_status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `password`, `user_status_id`) VALUES
(20, 'admin', 'admin', 'linkincinamon@one.lt', '21232f297a57a5a743894a0e4a801fc3', 1),
(34, 'localuser', 'localuser', 'localuser@gmail.com', 'e58e28a556d2b4884cb16ba8a37775f0', 2),
(47, 'user', 'user', 'user@gmail.com', '5cc32e366c87c4cb49e4309b75f57d64', 2),
(48, 'user2', 'user2', 'user2@gmail.com', 'e557d99503e8fea85cc5d6a849abaadc', 2),
(49, 'user3', 'user3', 'user3@gmail.com', '6ad14ba9986e3615423dfca256d04e3f', 2),
(50, 'user4', 'user4', 'user4@gmail.com', 'adbb96d5d528acab47fefee235cd6935', 2),
(51, 'user5', 'user5', 'user5@gmail.com', '4a8b05b14ec0bacf9dc09c43b7660c81', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_status`
--

CREATE TABLE `user_status` (
  `id` int(11) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_status`
--

INSERT INTO `user_status` (`id`, `status`) VALUES
(1, 'admin'),
(2, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category_id` (`product_category_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_status_id` (`user_status_id`);

--
-- Indexes for table `user_status`
--
ALTER TABLE `user_status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `user_status`
--
ALTER TABLE `user_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`product_category_id`) REFERENCES `product_category` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_status_id`) REFERENCES `user_status` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
