-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: db
-- Время создания: Дек 16 2020 г., 15:50
-- Версия сервера: 10.5.5-MariaDB-1:10.5.5+maria~focal
-- Версия PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `car-park`
--

DELIMITER $$
--
-- Процедуры
--
DROP PROCEDURE IF EXISTS `wat_summ`$$
CREATE DEFINER=`AntonP`@`%` PROCEDURE `wat_summ` (IN `wat` INT, OUT `wat_summ` INT)  BEGIN
SELECT sum(price*(1+wat/100)) into wat_summ FROM products;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `parameters`
--

DROP TABLE IF EXISTS `parameters`;
CREATE TABLE `parameters` (
  `id` int(11) NOT NULL,
  `name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `parameters`
--

INSERT INTO `parameters` (`id`, `name`) VALUES
(3, 'Двигатель'),
(4, 'KПП'),
(6, 'Цвет'),
(8, 'Год выпуска');

-- --------------------------------------------------------

--
-- Структура таблицы `parameter_values`
--

DROP TABLE IF EXISTS `parameter_values`;
CREATE TABLE `parameter_values` (
  `id` int(11) NOT NULL,
  `parameter_id` int(11) NOT NULL,
  `name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `parameter_values`
--

INSERT INTO `parameter_values` (`id`, `parameter_id`, `name`) VALUES
(66, 3, '2.0 л. 150 л.с.'),
(62, 3, '2.2 л. 109 л.с.'),
(63, 3, '2.2 л. 136 л.с.'),
(67, 3, '2.5 л. 181 л.с.'),
(68, 3, '3.5 л. 249 л.с.'),
(40, 3, '5.0 л. 130 л.с.'),
(14, 4, '5-MKП'),
(15, 4, '6-АКП'),
(22, 4, '6-МКП'),
(21, 4, '7-АКП'),
(33, 4, '8-АКП'),
(38, 6, 'Белый'),
(64, 6, 'Жёлтый'),
(37, 6, 'Зелёный'),
(69, 6, 'Чёрный'),
(41, 8, '2000'),
(42, 8, '2001'),
(44, 8, '2002'),
(43, 8, '2003'),
(45, 8, '2004'),
(46, 8, '2005'),
(47, 8, '2006'),
(48, 8, '2007'),
(49, 8, '2008'),
(50, 8, '2009'),
(51, 8, '2010'),
(52, 8, '2011'),
(53, 8, '2012'),
(54, 8, '2013'),
(55, 8, '2014'),
(56, 8, '2015'),
(57, 8, '2016'),
(58, 8, '2017'),
(59, 8, '2018'),
(60, 8, '2019'),
(61, 8, '2020');

-- --------------------------------------------------------

--
-- Структура таблицы `parameter_value_product`
--

DROP TABLE IF EXISTS `parameter_value_product`;
CREATE TABLE `parameter_value_product` (
  `id` int(11) NOT NULL,
  `parameter_value_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `parameter_value_product`
--

INSERT INTO `parameter_value_product` (`id`, `parameter_value_id`, `product_id`) VALUES
(82, 40, 32),
(83, 14, 32),
(84, 38, 32),
(85, 56, 32),
(86, 62, 33),
(87, 21, 33),
(88, 38, 33),
(89, 53, 33),
(90, 63, 34),
(91, 33, 34),
(92, 64, 34),
(93, 54, 34),
(94, 66, 35),
(95, 21, 35),
(96, 38, 35),
(97, 60, 35),
(98, 67, 36),
(99, 21, 36),
(100, 69, 36),
(101, 60, 36),
(102, 68, 37),
(103, 33, 37),
(104, 69, 37),
(105, 61, 37);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`) VALUES
(32, 'ПАЗ-32053/5'),
(33, 'Mercedes-sprinter'),
(34, 'Mercedes-sprinter'),
(35, 'Toyota Camry'),
(36, 'Toyota Camry'),
(37, 'Toyota Camry');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `login` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `access`) VALUES
(1, 'admin', 'admin1', 'admin'),
(2, 'user', 'user1', 'user'),
(3, 'guest', 'guest1', 'guest');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `parameters`
--
ALTER TABLE `parameters`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `parameter_values`
--
ALTER TABLE `parameter_values`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `parameter_id` (`parameter_id`,`name`),
  ADD KEY `paramter_id` (`parameter_id`);

--
-- Индексы таблицы `parameter_value_product`
--
ALTER TABLE `parameter_value_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parameter_value_id` (`parameter_value_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `parameters`
--
ALTER TABLE `parameters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `parameter_values`
--
ALTER TABLE `parameter_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT для таблицы `parameter_value_product`
--
ALTER TABLE `parameter_value_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `parameter_values`
--
ALTER TABLE `parameter_values`
  ADD CONSTRAINT `parameter_values_ibfk_1` FOREIGN KEY (`parameter_id`) REFERENCES `parameters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `parameter_value_product`
--
ALTER TABLE `parameter_value_product`
  ADD CONSTRAINT `parameter_value_product_ibfk_1` FOREIGN KEY (`parameter_value_id`) REFERENCES `parameter_values` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `parameter_value_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
