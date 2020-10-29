-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 29 2020 г., 20:56
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `avto_salon_vw`
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
(1, 'Цвет'),
(3, 'Двигатель'),
(4, 'KПП');

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
(25, 1, 'Белый'),
(27, 1, 'Голубой'),
(18, 1, 'Жёлтый'),
(8, 1, 'Зеленый'),
(24, 1, 'Коричневый'),
(23, 1, 'Ораньжевый'),
(26, 1, 'Серебристый'),
(28, 1, 'Серый'),
(1, 1, 'Синий'),
(12, 1, 'Черный'),
(17, 3, '1.4 л. 125 л.с. TSI'),
(19, 3, '1.4 л. 150 л.с. TSI'),
(13, 3, '1.6 л. 90 л.с. MPI'),
(16, 3, '1.6л. 110 л.с. MPI'),
(29, 3, '2.0л. 180 л.с. TSI'),
(20, 3, '2.0л. 190 л.с. TSI'),
(30, 3, '2.0л. 220 л.с. TSI'),
(31, 3, '3.6 л. 220л.с. TSI'),
(32, 3, '3.6 л. 249л.с. FSI'),
(34, 3, '3.6 л. 340л.с. TSI'),
(14, 4, '5-MKП'),
(15, 4, '6-АКП'),
(22, 4, '6-МКП'),
(21, 4, '7-АКП'),
(33, 4, '8-АКП');

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
(13, 8, 4),
(14, 13, 4),
(15, 14, 4),
(16, 18, 8),
(17, 12, 9),
(18, 18, 10),
(19, 17, 10),
(20, 14, 10),
(21, 16, 8),
(22, 14, 8),
(23, 19, 9),
(25, 22, 9),
(26, 1, 11),
(27, 19, 11),
(28, 15, 11),
(29, 23, 12),
(30, 20, 12),
(31, 21, 12),
(32, 18, 13),
(33, 20, 13),
(34, 21, 13),
(35, 25, 14),
(36, 29, 14),
(37, 21, 14),
(38, 24, 15),
(39, 30, 15),
(40, 21, 15),
(41, 12, 16),
(42, 31, 16),
(43, 33, 16),
(44, 1, 17),
(45, 32, 17),
(46, 33, 17),
(47, 26, 18),
(48, 32, 18),
(49, 33, 18),
(50, 18, 19),
(51, 34, 19),
(52, 33, 19);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `price`) VALUES
(4, 'Polo', 800000),
(8, 'Jetta', 1485000),
(9, 'Passat', 1829000),
(10, 'Polo', 1100000),
(11, 'Jetta', 1860000),
(12, 'Passat', 2479000),
(13, 'Arteon', 3000000),
(14, 'Tiguan', 2310000),
(15, 'Tiguan', 2810000),
(16, 'Teramont', 3580000),
(17, 'Teramont', 4050000),
(18, 'Touareg', 5000000),
(19, 'Touareg', 5300000);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `parameter_values`
--
ALTER TABLE `parameter_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `parameter_value_product`
--
ALTER TABLE `parameter_value_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
