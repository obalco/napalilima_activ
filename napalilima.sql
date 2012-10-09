-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Počítač: localhost
-- Vygenerováno: Neděle 30. září 2012, 18:12
-- Verze MySQL: 5.1.53
-- Verze PHP: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `napalilima`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `claims`
--

CREATE TABLE IF NOT EXISTS `claims` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_u` int(11) NOT NULL,
  `who` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `claim` text COLLATE utf8_czech_ci NOT NULL,
  `date` varchar(16) COLLATE utf8_czech_ci NOT NULL,
  `ip` varchar(16) COLLATE utf8_czech_ci NOT NULL,
  `sys_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=24 ;

--
-- Vypisuji data pro tabulku `claims`
--

INSERT INTO `claims` (`id`, `id_u`, `who`, `claim`, `date`, `ip`, `sys_date`) VALUES
(1, 1, 'gfhgfh', 'gfhfghfghgf', 'hfghfghfghgfhf', '127.0.0.1', '2012-09-29 00:00:00'),
(2, 1, 'gfhgfh', 'gfhfghfghgf', 'hfghfghfghgfhf', '127.0.0.1', '2012-09-29 00:00:00'),
(3, 1, 'dfgdfgdf', 'gdfgdfg', 'dfgdfgdfgdf', '127.0.0.1', '2012-09-29 00:00:00'),
(4, 1, 'dfgdfgdf', 'gdfgdfg', 'dfgdfgdfgdf', '127.0.0.1', '2012-09-29 00:00:00'),
(5, 0, 'dasdasasd', 'asdasdasasdasdasd', 'dasd', '127.0.0.1', '2012-09-29 00:00:00'),
(6, 0, 'dasdasasd', 'asdasdasasdasdasd', 'dasd', '127.0.0.1', '2012-09-29 00:00:00'),
(7, 0, 'asdasd', 'asdasdas', 'asdasdas', '127.0.0.1', '2012-09-29 00:00:00'),
(8, 0, 'gdfgfdg', 'fggdfdfgdfgdf', 'dfgdfg', '127.0.0.1', '2012-09-29 23:37:59'),
(9, 0, 'asdasdasd', '***** pièa jebe andy  wow ', 'asdasdas', '', '2012-09-30 11:04:13'),
(10, 0, 'dasdasd', '', 'sdasdas', '', '2012-09-30 11:04:30'),
(11, 0, 'asdasdasdasdas', '', 'dasdasd', '', '2012-09-30 11:04:40'),
(12, 0, 'andy', 'pièa *** jebe ', 'sdasdasdasdas', '', '2012-09-30 11:05:37'),
(13, 0, 'adasdasdasda', '**** ', 'dasdasda', '', '2012-09-30 11:07:23'),
(14, 0, 'sdasdasdadas', 'andys **** ***** neviem c mam ', 'asdasdadas', '', '2012-09-30 11:07:54'),
(15, 0, 'sdasdada', '**** ***** neviem c mam napisa andys **** ***** neviem c mam ', 'dasdasdasd', '', '2012-09-30 11:08:17'),
(16, 0, 'asdasdad', '**** ***** neviem c mam napisa andys **** ***** neviem c mam ', 'dasdas', '', '2012-09-30 11:08:42'),
(17, 0, 'andysadad', '**** ***** neviem c mam napisa andys **** ***** neviem c mam ', 'dasda', '', '2012-09-30 11:09:29'),
(18, 0, 'dasdasda', '**** ***** neviem c mam napisa andys **** ***** neviem c mam napisapièa ***** neviem c mam napisa andys **** ***** neviem c mam ', 'asdasdas', '', '2012-09-30 11:09:41'),
(19, 0, 'sadasd', '**** ***** neviem c mam napisa andys **** ***** neviem c mam napisapièa ***** neviem c mam napisa andys **** ***** neviem c mam ', 'asdadad', '', '2012-09-30 11:11:01'),
(20, 0, 'asdasdas', '**** ', 'asdas', '', '2012-09-30 11:11:14'),
(21, 0, 'asdasda', '', 'sadasdasd', '', '2012-09-30 11:34:09'),
(22, 0, 'sdasdasda', '', 'asdasdas', '', '2012-09-30 11:34:20'),
(23, 0, 'asdasdasd', '**** ***** je andy ', 'dasdasdas', '', '2012-09-30 11:34:53');

-- --------------------------------------------------------

--
-- Struktura tabulky `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_u` int(11) NOT NULL,
  `id_c` int(11) NOT NULL,
  `comment` text COLLATE utf8_czech_ci NOT NULL,
  `sys_date` varchar(11) COLLATE utf8_czech_ci NOT NULL,
  `ip` varchar(16) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

--
-- Vypisuji data pro tabulku `comments`
--


-- --------------------------------------------------------

--
-- Struktura tabulky `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

--
-- Vypisuji data pro tabulku `likes`
--


-- --------------------------------------------------------

--
-- Struktura tabulky `tokens`
--

CREATE TABLE IF NOT EXISTS `tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_u` int(11) NOT NULL,
  `token` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `t_or_f` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

--
-- Vypisuji data pro tabulku `tokens`
--


-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `pass` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `reg_date` varchar(11) COLLATE utf8_czech_ci NOT NULL,
  `mail` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `last_log` varchar(25) COLLATE utf8_czech_ci NOT NULL,
  `reg` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

--
-- Vypisuji data pro tabulku `users`
--

