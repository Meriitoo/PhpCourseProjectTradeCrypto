-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2024 at 02:32 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crypto`
--

-- --------------------------------------------------------

--
-- Table structure for table `crypto_types`
--

CREATE TABLE `crypto_types` (
  `id` int(11) NOT NULL COMMENT 'Първичен ключ',
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crypto_types`
--

INSERT INTO `crypto_types` (`id`, `name`, `image`, `price`, `description`, `payment_method`, `user_id`) VALUES
(1, 'Amethyst', 'https://www.shutterstock.com/image-illustration/top-7-cryptocurrency-tokens-by-600nw-2152214777.jpg', 1000.00, 'Amethyst is a popular purple gemstone known for its stunning hues, which range from pale lavender to deep violet. It is often valued for its color, clarity, size, and cut. The most prized amethysts are deep purple with minimal inclusions.', 'credit-card', 0),
(33, 'Bitcoin ', 'https://rates.fm/static/content/thumbs/388x221/8/17/pzw4z6-1d1d46125a6b800d527184ac96c0d178.webp', 195.00, 'Bitcoin is the first and most well-known cryptocurrency, often referred to as \"digital gold.\" It operates on a decentralized network using blockchain technology, making it secure and resistant to censorship. Bitcoin is highly volatile but widely adopted​', 'debit-card', 20),
(34, 'Ethereum', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9s8PzLl0FzKBZIeusyOnBTaFO9kPxjL3Y-w&s', 3906.00, 'Ethereum introduced smart contracts, which are self-executing contracts with the terms of the agreement directly written into code. Ethereum is the backbone of much of the decentralized finance (DeFi) ecosystem and other blockchain applications​\r\n', 'debit-card', 20),
(38, 'Solana', 'https://tw.mitrade.com/cms_uploads/img/20231117/8b9abd4ceaaaff7b955fd193d3334e8d.jpg', 290.00, 'Known for its high-speed blockchain, Solana is designed to provide scalable solutions for decentralized applications (dApps) and decentralized finance (DeFi). It can process over 65,000 transactions per second, making it one of the fastest blockchains.', 'debit-card', 23),
(39, 'Binance Coin', 'https://rates.fm/static/content/thumbs/388x221/b/02/ukh2rv-6d1b0c8d8972ffa5bf30116664c3202b.webp', 740.00, 'BNB is a utility token created by Binance, a crypto exchange that launched in 2017. It has some elements of currency and utility crypto types. BNB can be used to pay for goods and services within and outside of the network. BNB is also used to pay network', 'debit-card', 23);

-- --------------------------------------------------------

--
-- Table structure for table `favorite_crypto_users`
--

CREATE TABLE `favorite_crypto_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `crypto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorite_crypto_users`
--

INSERT INTO `favorite_crypto_users` (`id`, `user_id`, `crypto_id`) VALUES
(1, 18, 1),
(9, 20, 6),
(11, 20, 8),
(23, 20, 19),
(58, 20, 21),
(60, 20, 23),
(61, 20, 26),
(62, 20, 1),
(66, 20, 28),
(67, 23, 34),
(69, 23, 33),
(70, 24, 38),
(71, 24, 39);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'simeon', 'simeon@abv.bg', '123456'),
(2, 'desi', 'desi@abv.bg', '789456'),
(3, 'eda', 'eda@abv.bg', '753159'),
(4, 'kris', 'kris@abv.bg', '852741'),
(5, 'deska', 'deska@abv.bg', '$argon2i$v=19$m=65536,t=4,p=1$eW5NSUF4WTVtbzNoRGU3Yg$4fVzbXz929AUD2BADQGLcZqSI5wBaGG+XR6DyEzMg24'),
(7, 'Mitko', 'mitko@abv.bg', '$argon2i$v=19$m=65536,t=4,p=1$V3dFeG1TT0J3amZPbmV1SQ$/JS2Q5IFrsuBithHtOknG3/bKfQTWY7BKyNaonmBCoI'),
(8, 'gosho', 'gosho@abv.bg', '$argon2i$v=19$m=65536,t=4,p=1$UXAvSkhYVTFIcjl0VDE3Mg$boDoyPrmvDmThNjZ5X56ToqhFGJM7un64c8rohYCkUg'),
(9, 'mimi', 'mimi@abv.bg', '$argon2i$v=19$m=65536,t=4,p=1$UTBvV3R2QkFUNVB2Z0EvZQ$ZD0rOQwvEQy2+97Z32/vuv3t1L4s/t2I3z9tc2qK7/Q'),
(10, 'koko', 'koko1@abv.bg', '$argon2i$v=19$m=65536,t=4,p=1$TmZmMS52SU4xVmkxVzU2UQ$S/J/UgR4XL9wtIyg98ZLt1j15+TMAzex8rFGp9lYyl0'),
(11, 'tom', 'tom@abv.bg', '$argon2i$v=19$m=65536,t=4,p=1$VnZkeEcydEx0LktoZVNiZw$dZk4vaZ+79T3+L8eQ8lvEFdhBLt0VNbJDQFkkotdMww'),
(12, 'djambi', 'djambi@abv.bg', '$argon2i$v=19$m=65536,t=4,p=1$cHFnWUtLb2trd2o1bDBRRA$9VDa1YBmBNT+kkYOCaMXtmEt+pwEYtbcep1rfy4XTJA'),
(13, 'reni', 'renito@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$a1BtamR5b1hoc2p2OVJXaw$kuUU1O5pUXKHq9Sw4fUYFRZsKVJX3RkU751FkXA3fz8'),
(17, 'kemi', 'kemito@abv.bg', '$argon2i$v=19$m=65536,t=4,p=1$LmpkN0ZGNE5xcDJmWjl2VA$DHCDugbAmBPJzOAncpfC5YVSRDzyZ34QxcKZ4q46rTo'),
(18, 'gosho', 'goshko@abv.bg', '$argon2i$v=19$m=65536,t=4,p=1$eDdDeHk2dGxWVjFhOXEudA$7b9VqnyJkXrBXJ7psM1R1Kis/Dks2938jI5DOx7EVY4'),
(19, 'renito', 'renito@abv.bg', '$argon2i$v=19$m=65536,t=4,p=1$QTNVZlRPYk13UGhIYVdKOQ$eIbt37kqYjZ8x11xkRW/hFRbSQTaZitIZhgNU8eCCYA'),
(20, 'test', 'test@abv.bg', '$argon2i$v=19$m=65536,t=4,p=1$aGxDdUdKckRrT0UwM0xPZA$yzcIYzCsDCQoM+YHwf0syi7OZTlxXTmznAOm+Zfie2w'),
(23, 'merito', 'merito11@abv.bg', '$argon2i$v=19$m=65536,t=4,p=1$d2M5V3NLUjMvQTJSOEs0bw$/JSs7xPaLKGcCmDc5uszJJo483kIdEuW/hDne19q5nU'),
(24, 'sisito', 'sisi@abv.bg', '$argon2i$v=19$m=65536,t=4,p=1$SXk1RVV4MVdLUDNZZ1k5Mg$1SJ/UA3WSrPC0yI49tvg+t9IMlGXQVOgcxiqtyBL5pU');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crypto_types`
--
ALTER TABLE `crypto_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorite_crypto_users`
--
ALTER TABLE `favorite_crypto_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `crypto_id` (`crypto_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crypto_types`
--
ALTER TABLE `crypto_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Първичен ключ', AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `favorite_crypto_users`
--
ALTER TABLE `favorite_crypto_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
