-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 15. Nov 2020 um 17:22
-- Server-Version: 10.4.11-MariaDB
-- PHP-Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `agbm`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `preachers`
--

CREATE TABLE `preachers` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `permition` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `preachers`
--

INSERT INTO `preachers` (`id`, `name`, `permition`) VALUES
(1, 'Sergej Kapsamun', 'true'),
(2, 'Ottmar Wander', 'true'),
(3, 'Christel Pietruska', 'false'),
(4, 'Juri Gaus', 'true'),
(5, 'Ralf Pietruska', 'true'),
(6, 'Ellen Harder', 'true'),
(7, 'Joel Costa da Blanka', 'false'),
(8, 'Guangtulung Riemei', 'true'),
(9, 'Evelin Riemei', 'true'),
(13, 'Samuel Pietruska', 'true'),
(14, 'Günter Rehme', 'true'),
(15, 'Christoph Bock', 'true'),
(16, 'Christoph Berger', 'true'),
(17, 'Lipohar Dragutin', 'false'),
(18, 'Martin Farr', 'false'),
(19, 'Karl Heinz Walter', 'false'),
(20, 'Alexander Vilem', 'false'),
(21, 'Herbert Gehring', 'false'),
(22, 'Walfried Eberhardt', 'false'),
(23, 'Heinz Ottschoffsky', 'false'),
(24, 'Ralf Schönfeld', 'false'),
(25, 'Jan Kozak', 'false'),
(26, 'Eckhardt Willhelm', 'false'),
(27, 'Herbert Gering', 'false'),
(28, 'Matthias Dorn', 'false');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `preachers`
--
ALTER TABLE `preachers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `preachers`
--
ALTER TABLE `preachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
