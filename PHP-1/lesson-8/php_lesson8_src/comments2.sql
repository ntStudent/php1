-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Сен 08 2016 г., 22:54
-- Версия сервера: 10.1.9-MariaDB
-- Версия PHP: 7.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ek`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments2`
--

CREATE TABLE `comments2` (
  `id_comment` int(11) NOT NULL,
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(64) NOT NULL,
  `text` text NOT NULL,
  `is_moderate` enum('0','1','2') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments2`
--

INSERT INTO `comments2` (`id_comment`, `dt`, `name`, `text`, `is_moderate`) VALUES
(1, '2016-09-08 18:09:21', 'Дмитрий', '34534екуе ек куеку', '0'),
(2, '2016-09-08 18:26:26', '324324', 'gdrfe tgr tret rew', '0'),
(3, '2016-09-08 18:39:22', '342 5432', '3 24543 2', '0'),
(4, '2016-09-08 18:57:20', '52345', '34543253', '0'),
(5, '2016-09-08 18:57:24', 'ывпав', 'ы впав ыпав', '0');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments2`
--
ALTER TABLE `comments2`
  ADD PRIMARY KEY (`id_comment`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments2`
--
ALTER TABLE `comments2`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
