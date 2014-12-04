-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 12. Okt 2014 um 18:52
-- Server Version: 5.5.38
-- PHP-Version: 5.4.4-14+deb7u14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `muhvieh_db`
--
CREATE DATABASE `muhvieh_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `muhvieh_db`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `movie_id` mediumint(9) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  PRIMARY KEY (`movie_id`,`categorie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `categories_main`
--

CREATE TABLE IF NOT EXISTS `categories_main` (
  `id` mediumint(9) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `credits`
--

CREATE TABLE IF NOT EXISTS `credits` (
  `movie_id` mediumint(9) NOT NULL,
  `credits_id` int(11) NOT NULL,
  PRIMARY KEY (`movie_id`,`credits_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `credits_main`
--

CREATE TABLE IF NOT EXISTS `credits_main` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `directors`
--

CREATE TABLE IF NOT EXISTS `directors` (
  `movie_id` int(11) NOT NULL,
  `director_id` int(11) NOT NULL,
  PRIMARY KEY (`movie_id`,`director_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `directors_main`
--

CREATE TABLE IF NOT EXISTS `directors_main` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `movies`
--

CREATE TABLE IF NOT EXISTS `movies` (
  `id` mediumint(9) NOT NULL,
  `title` text COLLATE utf8_bin NOT NULL,
  `original_title` text CHARACTER SET utf8,
  `overview` text CHARACTER SET utf8,
  `cover` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `adult` tinyint(1) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `homepage` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `imdb_id` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `vote_average` double(2,1) DEFAULT NULL,
  `vote_count` int(11) DEFAULT NULL,
  `add_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `newsletter` tinyint(1) DEFAULT '0',
  `role` int(11) NOT NULL,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `users`
-- Admin anlegen username: admin@muh.vieh passwort: muhvieh
--

INSERT INTO `users` (`id`, `email`, `password`, `newsletter`, `role`, `last_login`) VALUES
(1, 'admin@muh.vieh', '1a7b64a1db1dafdf120f5f19f55694ff', 0, 1, '2014-12-02 09:53:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wishlist`
--

CREATE TABLE IF NOT EXISTS `wishlist` (
  `user_id` mediumint(9) NOT NULL,
  `movie_id` mediumint(9) NOT NULL,
  PRIMARY KEY (`user_id`,`movie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
