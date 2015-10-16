-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Окт 16 2015 г., 23:26
-- Версия сервера: 5.6.25
-- Версия PHP: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bank`
--

-- --------------------------------------------------------

--
-- Структура таблицы `operations`
--

CREATE TABLE IF NOT EXISTS `operations` (
  `id` int(11) NOT NULL,
  `moment` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sum` int(11) DEFAULT NULL,
  `actual` int(11) DEFAULT NULL,
  `persons_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `operations`
--

INSERT INTO `operations` (`id`, `moment`, `sum`, `actual`, `persons_id`) VALUES
(1, '2015-10-15 20:01:25', 100, 100, 2),
(2, '2015-10-15 20:01:25', 100, 200, 2),
(3, '2015-10-15 20:01:25', 100, 300, 2),
(4, '2015-10-15 20:01:25', 200, 500, 2),
(5, '2015-10-15 20:01:25', 200, 700, 2),
(6, '2015-10-15 20:01:25', 60, 760, 2),
(7, '2015-10-15 20:01:25', 60, 820, 2),
(8, '2015-10-15 20:01:25', 60, 880, 2),
(9, '2015-10-15 20:01:25', 80, 960, 2),
(10, '2015-10-15 20:01:25', 80, 1060, 2),
(11, '2015-10-15 20:01:25', 100, 1160, 2),
(12, '2015-10-15 20:01:25', 100, 1260, 2),
(13, '2015-10-15 20:20:39', 100, 100, 1),
(14, '2015-10-15 20:20:43', 100, 200, 1),
(15, '2015-10-15 20:20:47', 100, 300, 1),
(16, '2015-10-15 20:20:51', 100, 400, 1),
(17, '2015-10-15 20:20:55', 100, 500, 1),
(18, '2015-10-15 20:21:56', 100, 600, 1),
(19, '2015-10-15 20:22:00', 100, 700, 1),
(20, '2015-10-15 20:22:04', 100, 800, 1),
(21, '2015-10-15 20:22:07', 100, 900, 1),
(22, '2015-10-15 20:22:13', 100, 1000, 1),
(23, '2015-10-15 20:22:17', 100, 1100, 1),
(24, '2015-10-15 20:22:22', 100, 1200, 1),
(25, '2015-10-15 20:22:25', 100, 1300, 1),
(26, '2015-10-15 20:22:30', 100, 1400, 1),
(27, '2015-10-15 20:23:35', 1000, 1000, 3),
(28, '2015-10-15 20:23:39', 1000, 2000, 3),
(30, '2015-10-15 20:23:46', 1000, 3000, 3),
(31, '2015-10-15 20:23:50', 1000, 4000, 3),
(32, '2015-10-15 20:23:55', 1000, 5000, 3),
(33, '2015-10-15 20:23:58', 1000, 6000, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `persons`
--

CREATE TABLE IF NOT EXISTS `persons` (
  `id` int(11) NOT NULL,
  `user` text,
  `password` text,
  `cut` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `make` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `persons`
--

INSERT INTO `persons` (`id`, `user`, `password`, `cut`, `make`) VALUES
(1, 'some', 'any', '2015-10-15 20:04:32', '2015-10-15 01:49:53'),
(2, 'admin@bank.com', '12345', '2015-10-15 01:49:53', '2015-10-15 01:49:53'),
(3, 'unknow', 'unknow', '2015-10-15 20:27:35', '2015-10-15 20:27:35');

-- --------------------------------------------------------

--
-- Структура таблицы `pool`
--

CREATE TABLE IF NOT EXISTS `pool` (
  `id` int(11) NOT NULL,
  `ip` text,
  `timemark` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int(11) NOT NULL,
  `sid` varchar(255) DEFAULT NULL,
  `start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` text
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sessions`
--

INSERT INTO `sessions` (`id`, `sid`, `start`, `user`) VALUES
(22, 'k26cfl1c037rouaatnbbtur9m4', '2015-10-16 07:50:27', 'some'),
(23, 'f5e9jnepnm2044fjm8gud7uun4', '2015-10-16 07:54:54', 'unknow'),
(24, 'vqgvrdrpqh1jqdmqe23k8vi037', '2015-10-16 07:58:04', 'unknow');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `operations`
--
ALTER TABLE `operations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pool`
--
ALTER TABLE `pool`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sid` (`sid`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `operations`
--
ALTER TABLE `operations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT для таблицы `persons`
--
ALTER TABLE `persons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `pool`
--
ALTER TABLE `pool`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT для таблицы `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
