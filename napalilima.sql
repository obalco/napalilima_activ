-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Hostiteľ: localhost
-- Vygenerované:: 25.Okt, 2012 - 18:54
-- Verzia serveru: 5.5.16
-- Verzia PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáza: `napalilima`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `claims`
--

CREATE TABLE IF NOT EXISTS `claims` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_u` int(11) NOT NULL,
  `who` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `claim` text COLLATE utf8_czech_ci NOT NULL,
  `date` varchar(16) COLLATE utf8_czech_ci NOT NULL,
  `_like` int(11) NOT NULL,
  `dislike` int(11) NOT NULL,
  `ip` varchar(16) COLLATE utf8_czech_ci NOT NULL,
  `sys_date` datetime NOT NULL,
  `show` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=104 ;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_u` int(11) NOT NULL,
  `id_c` int(11) NOT NULL,
  `comment` text COLLATE utf8_czech_ci NOT NULL,
  `sys_date` datetime NOT NULL,
  `ip` varchar(16) COLLATE utf8_czech_ci NOT NULL,
  `show` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=208 ;

--
-- Sťahujem dáta pre tabuľku `comments`
--

INSERT INTO `comments` (`id`, `id_u`, `id_c`, `comment`, `sys_date`, `ip`, `show`) VALUES
(197, 1, 1, 'comment', '2012-10-11 20:31:02', '127.0.0.1', 0),
(196, 1, 1, 'comment', '2012-10-11 20:31:01', '127.0.0.1', 0),
(195, 1, 1, 'comment', '2012-10-11 20:31:00', '127.0.0.1', 0),
(194, 1, 1, 'comment', '2012-10-11 20:30:58', '127.0.0.1', 0),
(193, 1, 1, 'comment', '2012-10-11 20:30:51', '127.0.0.1', 0),
(192, 1, 7, 'comment', '2012-10-11 20:19:43', '127.0.0.1', 0),
(191, 1, 12, 'comment', '2012-10-11 20:19:29', '127.0.0.1', 0),
(190, 1, 12, 'comentar pre 12', '2012-10-11 20:33:28', '127.0.0.1', 0),
(189, 1, 12, 'comment', '2012-10-11 19:42:28', '127.0.0.1', 0),
(198, 1, 23, 'andy', '2012-10-17 08:06:43', '127.0.0.1', 0),
(199, 1, 23, 'a este raz', '2012-10-17 08:08:44', '127.0.0.1', 0),
(200, 1, 23, 'andy 2', '2012-10-17 08:09:17', '127.0.0.1', 0),
(201, 1, 23, 'aksdnalsdn', '2012-10-17 08:09:51', '127.0.0.1', 0),
(202, 1, 23, '175252', '2012-10-17 08:10:13', '127.0.0.1', 0),
(203, 1, 26, 'totot je moj comentar ku staznoszti', '2012-10-17 15:33:58', '127.0.0.1', 0),
(204, 1, 26, '', '2012-10-17 15:39:08', '127.0.0.1', 0),
(205, 1, 1, 'posjfsafúakúfsjd', '2012-10-20 22:14:33', '127.0.0.1', 0),
(206, 1, 103, 'aha moj comentar', '2012-10-24 07:35:42', '127.0.0.1', 0),
(207, 1, 103, 'cx', '2012-10-25 18:28:54', '127.0.0.1', 0);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `tokens`
--

CREATE TABLE IF NOT EXISTS `tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_u` int(11) NOT NULL,
  `token` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `create_date` datetime NOT NULL,
  `confirm` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=20 ;

--
-- Sťahujem dáta pre tabuľku `tokens`
--

INSERT INTO `tokens` (`id`, `id_u`, `token`, `create_date`, `confirm`) VALUES
(4, 1, '073ACD508ED0373A5B59435E614DFE32', '0000-00-00 00:00:00', 0),
(12, 8, '72278DB0A3AB06F37592A37639A12282', '0000-00-00 00:00:00', 0),
(11, 7, '8F3ACD909EC29EE303A1474058BF8A7E', '0000-00-00 00:00:00', 0),
(13, 9, '942D0C92512D1265342736CF1978A7C9', '0000-00-00 00:00:00', 0),
(14, 10, '6802D91A20C665FE1D22281DB69D8DBC', '0000-00-00 00:00:00', 0),
(15, 13, 'C63BAB950CB38F5C177F1E05ED787060', '2012-10-25 18:02:49', 0),
(16, 14, 'E187144D30E922432D35C9D92C3EAF4A', '2012-10-25 18:27:35', 0),
(17, 15, 'BEB59106576234B831AC52B01C94C129', '2012-10-25 18:34:47', 0),
(18, 16, '4C8376E7782A62BEC3983A4362DECEAF', '2012-10-25 18:37:42', 0),
(19, 17, 'D123D4BAC1238FA49FB1D131F7F433AB', '2012-10-25 18:40:12', 0);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `users`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=18 ;

--
-- Sťahujem dáta pre tabuľku `users`
--

INSERT INTO `users` (`id`, `nick`, `pass`, `reg_date`, `mail`, `last_log`, `reg`) VALUES
(2, 'andy7', '', '', 'a.majik@centrum.sk', '', 0),
(10, 'asda', '', '2012-10-25 ', 'a.majik@centrum.ds', '2012-10-25 17:51:03', 0),
(4, 'adasda', '', '2012-10-24 ', 'a.majikaaa@centrum.sk', '2012-10-24 07:33:41', 0),
(9, 'andy723', '', '2012-10-25 ', 'a.majisadasdk@centrudasdm.sk', '2012-10-25 07:51:43', 0),
(8, 'adasdada', '', '2012-10-25 ', 'a.fasddada@sdo.sk', '2012-10-25 07:34:03', 0),
(11, 'andys', '', '2012-10-25 ', 'a.majik@centrm.sk', '2012-10-25 18:01:56', 0),
(12, 'and', '', '2012-10-25 ', 'a.mjik@centrm.sk', '2012-10-25 18:02:11', 0),
(13, 'anddasda', '', '2012-10-25 ', 'a.mjiask@centrm.sk', '2012-10-25 18:02:49', 0),
(14, 'dasdsa', '', '2012-10-25 ', 'a.majik@centrum.dt', '2012-10-25 18:27:35', 0),
(15, 'andy', '', '2012-10-25 ', 'a.mjik@centrum.sk', '2012-10-25 18:34:47', 0),
(16, 'ycycyas', '', '2012-10-25 ', 'mail.m@mail.sk', '2012-10-25 18:37:42', 0),
(17, 'dsisada', '', '2012-10-25 ', 'a.maik@centru.sk', '2012-10-25 18:40:12', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
