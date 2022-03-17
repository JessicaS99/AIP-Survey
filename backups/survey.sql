-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 25. Feb 2022 um 08:40
-- Server-Version: 10.4.22-MariaDB
-- PHP-Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `survey`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `admin`
--

CREATE TABLE `admin` (
  `admin` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `admin`
--

INSERT INTO `admin` (`admin`, `password`) VALUES
('Admin', '782281264e9aa90e155f5225cad808d5');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `seite1`
--

CREATE TABLE `seite1` (
  `user` text COLLATE utf8_unicode_ci NOT NULL,
  `datum` date NOT NULL,
  `q1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `q2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `q3` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `q4` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `q5` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `seite2`
--

CREATE TABLE `seite2` (
  `user` text COLLATE utf8_unicode_ci NOT NULL,
  `datum` date NOT NULL,
  `q6` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `q7` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `q8` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `q9` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `q10` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
