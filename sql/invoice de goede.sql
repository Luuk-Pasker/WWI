-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 03 dec 2019 om 10:46
-- Serverversie: 10.1.38-MariaDB
-- PHP-versie: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wideworldimporters`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `invoice`
--

CREATE TABLE `invoice` (
  `InvoicesID` int(11) NOT NULL,
  `PersonID` int(11) NOT NULL,
  `sendMethod` varchar(255) NOT NULL,
  `paymentMethod` varchar(255) NOT NULL,
  `InvoiceDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `invoice`
--

INSERT INTO `invoice` (`InvoicesID`, `PersonID`, `sendMethod`, `paymentMethod`, `InvoiceDate`) VALUES
(4, 3268, '', '', '2019-12-02 14:23:23'),
(5, 3269, '', '', '2019-12-02 14:25:14'),
(6, 3263, '', '', '2019-12-02 14:26:34'),
(7, 3263, '', '', '2019-12-02 14:27:00'),
(8, 3263, '', '', '2019-12-02 14:27:12'),
(9, 3263, '', '', '2019-12-02 14:27:25'),
(10, 3263, 'Air Freight', 'Credit-Card', '2019-12-03 09:27:12'),
(11, 3263, 'Air Freight', 'Credit-Card', '2019-12-03 09:36:39'),
(12, 3263, 'Delivery Van', 'IDEAL', '2019-12-03 09:37:02'),
(13, 3263, 'Customer Collect', 'IDEAL', '2019-12-03 09:44:08');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`InvoicesID`),
  ADD KEY `PersonID` (`PersonID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `invoice`
--
ALTER TABLE `invoice`
  MODIFY `InvoicesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`PersonID`) REFERENCES `people` (`PersonID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
