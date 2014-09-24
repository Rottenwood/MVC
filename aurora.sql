-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Сен 24 2014 г., 19:08
-- Версия сервера: 5.5.37-0ubuntu0.13.10.1-log
-- Версия PHP: 5.5.3-1ubuntu2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `aurora`
--

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pic` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`),
  KEY `pic_id` (`pic`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `title`, `content`, `alias`, `pic`) VALUES
(1, 'Клингоны', 'Внешне <b>клингоны</b> — типичные гуманоиды, похожие на людей и носящие длинные волосы, бороды и усы. Наиболее заметная их особенность — остроконечный лоб и костяные наросты на ногах.\r\n\r\nИх тело обладает бо́льшим количеством органов по сравнению с человеческим: клингоны имеют несколько лёгких, желудков, восьмиклапанное сердце и 28 рёбер, что делает их физиологически очень гибкими.\r\n\r\nКлингоны живут до 150 лет, однако многие их мужчины погибают в бою молодыми. Срок беременности у клингонских женщин составляет 30 недель, а сам процесс родов может продолжаться несколько суток.', 'klingony', 'klingon-wtf.jpg'),
(2, 'Последний рубеж', '<h1 style="text-align: center;"><i style="text-align: inherit; color: rgb(37, 37, 37); font-family: sans-serif; line-height: 21px; background-color: rgb(255, 255, 255);"><b><font size="6">Космос</font></b></i></h1><div style="text-align: justify;"><span style="text-align: inherit; color: rgb(37, 37, 37); font-family: sans-serif; line-height: 21px; background-color: rgb(255, 255, 255);"><b><span style="font-size: 14.399999618530273px;">Последний рубеж. Звездолёт „Энтерпрайз“ бороздит просторы вселенной, продолжая открывать и исследовать новые миры, новые формы жизни, новые цивилизации. Девиз команды&nbsp;— смело идти туда, куда не ступала нога человека.</span></b></span></div>', 'posledniy-rubezh', 'a.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `token` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `token`) VALUES
(1, 'test', '098f6bcd4621d373cade4e832627b4f6', '1b3b48fc9028791a3f45f6bc05d0c4fd');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
