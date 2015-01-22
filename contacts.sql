-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 16 Janvier 2015 à 00:04
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `contacts`
--

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `contactid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `contactName` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `note` text,
  `status` tinyint(4) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`contactid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `contacts`
--

INSERT INTO `contacts` (`contactid`, `userid`, `contactName`, `phone`, `email`, `address`, `note`, `status`, `timestamp`) VALUES
(1, 1, 'Barack Obama', '001-541-754-3010', 'obama@whitehouse.gov', 'The White House\n1600 Pennsylvania Avenue NW\nWashington, DC 20500', 'Current President of the United States', NULL, '2015-01-15 23:03:09'),
(2, 1, 'Angela Merkel', '030 18 272 2720', 'merkel@bundestag.de', 'Platz der Republik 1, 11011 Berlin', 'Chancellor of Germany', NULL, '2015-01-15 23:03:09'),
(3, 1, 'Mom', '636-48018', '', '', 'Makes the best cookies', NULL, '2015-01-15 23:03:09'),
(4, 1, 'Dad', '636-48018', '', '', '', NULL, '2015-01-15 23:03:09'),
(5, 1, 'Steven Spielberg', '001-541-574-3934', '', '', '73 Koala street Los Angeles', NULL, '2015-01-15 23:03:09'),
(6, 1, 'John', '+491571248953', 'john.smith@gmail.com', '', '', NULL, '2015-01-15 23:03:09'),
(7, 1, 'Hans Muller', '0115737954682', 'h.muller02@gmx.de', '37 Goethestr. Hamburg', '', NULL, '2015-01-15 23:03:09'),
(8, 1, 'Kaspar Shmidt', '01156161651  ', '', '', 'Birthday on April 21st', NULL, '2015-01-15 23:03:09'),
(9, 1, 'Karolin Fischer', '', '', '', 'Scholzstr. 44', NULL, '2015-01-15 23:03:09'),
(10, 1, 'Thomas Peters', '', 't.peters174@gmx.de', '', '', NULL, '2015-01-15 23:03:09'),
(11, 1, 'Rosamunde Zimmermann', '012165109519', 'rosaaamunde@gmail.com', 'KÃ¶nigstrasse 147 Dresden', '', NULL, '2015-01-15 23:03:09'),
(12, 1, 'Heidemarie SchrÃ¶der', '0194840198', '', '', '', NULL, '2015-01-15 23:03:09'),
(13, 1, 'Reinhold Schmitz', '0159019510', '', '', '', NULL, '2015-01-15 23:03:09');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`userid`, `username`, `password`) VALUES
(1, 'joe', 'b8cee3c70b6d84aed87523ca2390be1d');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
