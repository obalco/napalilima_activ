-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Počítač: localhost
-- Vygenerováno: Čtvrtek 11. října 2012, 18:44
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=26 ;

--
-- Vypisuji data pro tabulku `claims`
--

INSERT INTO `claims` (`id`, `id_u`, `who`, `claim`, `date`, `ip`, `sys_date`) VALUES
(1, 1, 'gfhgfh', 'gfhfghfghgf', 'hfghfghfghgfhf', '127.0.0.1', '2012-09-29 00:00:00'),
(7, 0, 'asdasd', 'asdasdas', 'asdasdas', '127.0.0.1', '2012-09-29 00:00:00'),
(12, 0, 'andy', 'pièa *** jebe ', 'sdasdasdasdas', '', '2012-09-30 11:05:37'),
(15, 0, 'sdasdada', '**** ***** neviem c mam napisa andys **** ***** neviem c mam ', 'dasdasdasd', '', '2012-09-30 11:08:17'),
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
  `sys_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip` varchar(16) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=198 ;

--
-- Vypisuji data pro tabulku `comments`
--

INSERT INTO `comments` (`id`, `id_u`, `id_c`, `comment`, `sys_date`, `ip`) VALUES
(197, 1, 1, 'comment', '2012-10-11 20:31:02', '127.0.0.1'),
(196, 1, 1, 'comment', '2012-10-11 20:31:01', '127.0.0.1'),
(195, 1, 1, 'comment', '2012-10-11 20:31:00', '127.0.0.1'),
(194, 1, 1, 'comment', '2012-10-11 20:30:58', '127.0.0.1'),
(193, 1, 1, 'comment', '2012-10-11 20:30:51', '127.0.0.1'),
(192, 1, 7, 'comment', '2012-10-11 20:19:43', '127.0.0.1'),
(191, 1, 12, 'comment', '2012-10-11 20:19:29', '127.0.0.1'),
(190, 1, 12, 'comentar pre 12', '2012-10-11 20:33:28', '127.0.0.1'),
(189, 1, 12, 'comment', '2012-10-11 19:42:28', '127.0.0.1');

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

