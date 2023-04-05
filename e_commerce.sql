-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Време на генериране:  5 апр 2023 в 03:35
-- Версия на сървъра: 10.4.17-MariaDB
-- Версия на PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данни: `e_commerce`
--

-- --------------------------------------------------------

--
-- Структура на таблица `images`
--

CREATE TABLE `images` (
  `product_id` int(5) NOT NULL,
  `location` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `images`
--

INSERT INTO `images` (`product_id`, `location`) VALUES
(2, '859255341.apple-iphone-13-128gb.jpg'),
(3, 'xiaomi-12-5g-gray.jpg'),
(3, 'samsung-galaxy-s22-5g-128gb-black.jpg'),
(4, 'samsung-galaxy-s22-5g-128gb-black.jpg');

-- --------------------------------------------------------

--
-- Структура на таблица `items`
--

CREATE TABLE `items` (
  `product_id` int(5) NOT NULL,
  `id_user` int(5) NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `publication_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `items`
--

INSERT INTO `items` (`product_id`, `id_user`, `title`, `description`, `publication_date`) VALUES
(2, 1, 'iPhone 13', 'The best iPhone Yet!', '2023-04-05 01:22:35'),
(3, 1, 'Xiaomi 12', 'Xiaomi 12 Android smartphone. Announced Dec 2021. Features 6.28″ display, Snapdragon 8 Gen 1 chipset, 4500 mAh battery, 256 GB storage, 12 GB RAM,', '2023-04-05 01:25:51'),
(4, 1, 'Samsung', 'Description', '2023-04-05 01:29:54');

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE `users` (
  `id_user` int(5) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `surname` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` longtext NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `city` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`id_user`, `first_name`, `surname`, `username`, `password`, `email`, `phone_number`, `city`) VALUES
(1, 'Stanislav', 'Lazarov', 'lazarov142', '$2y$10$b0c4f0mevfMk9BhLpVC1I.FmzmzPquAQb5BMMs4Ps/9pcWpHIl65S', 'lazarov142@gmail.com', '088888888', 'Varna');

--
-- Indexes for dumped tables
--

--
-- Индекси за таблица `images`
--
ALTER TABLE `images`
  ADD KEY `product_id` (`product_id`);

--
-- Индекси за таблица `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`product_id`) USING BTREE,
  ADD KEY `id_user` (`id_user`) USING BTREE;

--
-- Индекси за таблица `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `product_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `items` (`product_id`) ON DELETE CASCADE;

--
-- Ограничения за таблица `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
