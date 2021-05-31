-- phpMyAdmin SQL Dump

-- version 3.5.8.1

-- http://www.phpmyadmin.net

--

-- Host: johansvensson.se.mysql:3306

-- Generation Time: May 22, 2021 at 07:41 AM

-- Server version: 10.1.30-MariaDB-1~xenial

-- PHP Version: 5.4.45-0+deb7u13



SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

SET time_zone = "+00:00";





/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

/*!40101 SET NAMES utf8 */;



--

-- Database: `johansvensson_se_johansvensson_se`

--

-- CREATE DATABASE `tippning` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

 USE `ola1_setippning`;



-- --------------------------------------------------------



--

-- Table structure for table `arena`

--



CREATE TABLE IF NOT EXISTS `arena` (

  `id` int(11) NOT NULL,

  `arena` varchar(45) DEFAULT NULL,

  `location` varchar(45) DEFAULT NULL,

  `capacity` varchar(45) DEFAULT NULL,

  `buildyear` varchar(45) DEFAULT NULL,

  PRIMARY KEY (`id`)

) ENGINE=MyISAM DEFAULT CHARSET=latin1;



--

-- Dumping data for table `arena`

--



INSERT INTO `arena` (`id`, `arena`, `location`, `capacity`, `buildyear`) VALUES

(1, 'Wembley (England)', '90000', '', ''),
(2, 'Baku Olimpiya (Azerbadjan)', '', '68000', ''),
(3, 'Parken (Danmark)', '', '38065', '2017'),
(4, 'Aviva (Irland)', '', '51700', '1957'),
(5, 'Stadio Olimpico (Italien)', '', '72698', ''),
(6, 'Amsterdam Arena (Nederländerna)', '', '55000', ''),
(7, 'Arena Nationala (Rumänien)', '', '55600', ''),
(8, 'Zenit Arena (Ryssland)', '', '69500', ''),
(9, 'Hampden Park (Skottland)', '', '52063', ''),
(10, 'Estadio Olímpico de la Cartuja (Sevilla, Spanien)', '', '53332', ''),
(11, 'Allianz Arena (Tyskland)', '', '67812', ''),
(12, 'Uj Puskas Ferenc Stadion (Ungern)', '', '65000', '');



-- --------------------------------------------------------



--

-- Table structure for table `classification`

--



CREATE TABLE IF NOT EXISTS `classification` (

  `id` int(11) NOT NULL,

  `classId` varchar(45) DEFAULT NULL,

  `class` varchar(45) DEFAULT NULL,

  PRIMARY KEY (`id`)

) ENGINE=MyISAM DEFAULT CHARSET=latin1;



--

-- Dumping data for table `classification`

--



INSERT INTO `classification` (`id`, `classId`, `class`) VALUES

(1, '1', 'Grupp A'),
(2, '1', 'Grupp B'),
(3, '1', 'Grupp C'),
(4, '1', 'Grupp D'),
(5, '1', 'Grupp E'),
(6, '1', 'Grupp F'),
(7, '2', 'Åttondel 1'),
(8, '2', 'Åttondel 2'),
(9, '2', 'Åttondel 3'),
(10, '2', 'Åttondel 4'),
(11, '2', 'Åttondel 5'),
(12, '2', 'Åttondel 6'),
(13, '2', 'Åttondel 7'),
(14, '2', 'Åttondel 8'),
(15, '3', 'Kvartsfinal 1'),
(16, '3', 'Kvartsfinal 2'),
(17, '3', 'Kvartsfinal 3'),
(18, '3', 'Kvartsfinal 4'),
(19, '4', 'Semifinal 1'),
(20, '4', 'Semifinal 2'),
(21, '5', 'Final');


-- --------------------------------------------------------



--

-- Table structure for table `emwinner`

--



CREATE TABLE IF NOT EXISTS `emwinner` (

  `id` int(11) NOT NULL,

  `year` varchar(45) DEFAULT NULL,

  `winner_swe` varchar(45) DEFAULT NULL,

  `winner_eng` varchar(45) DEFAULT NULL,

  `flagpic` varchar(45) DEFAULT NULL,

  `host` varchar(45) DEFAULT NULL,

  PRIMARY KEY (`id`)

) ENGINE=MyISAM DEFAULT CHARSET=latin1;



--

-- Dumping data for table `emwinner`

--



INSERT INTO `emwinner` (`id`, `year`, `winner_swe`, `winner_eng`, `flagpic`, `host`) VALUES

(1, '1960', 'Sovjetunionen', 'USSR', 'ussr.gif', 'Frankrike'),

(2, '1964', 'Spanien', 'Spain', 'esp.png', 'Spanien'),

(3, '1968', 'Italien', 'Italy', 'ita.png', 'Italien'),

(4, '1972', 'Västtyskland', 'West-Germany', 'west_ger.png', 'Belgien'),

(5, '1976', 'Tjeckoslovakien', 'Czechoslovakia', 'cze_svk.png', 'Jugoslavien'),

(6, '1980', 'VÃ¤sttyskland', 'West-Germany', 'west_ger.png', 'Italien'),

(7, '1984', 'Frankrike', 'France', 'fra.png', 'Frankrike'),

(8, '1988', 'Nederländerna', 'Netherlands', 'net.png', 'Västtyskland'),

(9, '1992', 'Danmark', 'Denmark', 'den.png', 'Sverige'),

(10, '1996', 'Tyskland', 'Germany', 'ger.png', 'England'),

(11, '2000', 'Frankrike', 'France', 'fra.png', 'Belgien & Nederländerna'),

(12, '2004', 'Grekland', 'Greece', 'gre.png', 'Portugal'),

(13, '2008', 'Spanien', 'Spain', 'esp.png', 'Schweiz & Österrike'),

(14, '2012', 'Spanien', 'Spain', 'esp.png', 'Polen & Ukraina'),

(15, '2014', 'Tyskland', 'Germany', 'ger.png', 'Brasilien'),

(16, '2016', 'Portugal', 'Portugal', 'esp.png', 'Frankrike');


-- --------------------------------------------------------



--

-- Table structure for table `forum_entries`

--



CREATE TABLE IF NOT EXISTS `forum_entries` (

  `ID` int(11) NOT NULL AUTO_INCREMENT,

  `forumID` int(11) NOT NULL,

  `user` int(11) DEFAULT NULL,

  `date` varchar(45) DEFAULT NULL,

  `time` varchar(45) DEFAULT NULL,

  `title` varchar(45) DEFAULT NULL,

  `contribution` varchar(45) DEFAULT NULL,

  PRIMARY KEY (`ID`),

  KEY `fk_user_to_userid` (`user`)

) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;



--

-- Dumping data for table `forum_entries`

--



-- --------------------------------------------------------



--

-- Table structure for table `forum_titles`

--



CREATE TABLE IF NOT EXISTS `forum_titles` (

  `id` int(11) NOT NULL AUTO_INCREMENT,

  `title` varchar(45) DEFAULT NULL,

  `date` varchar(45) DEFAULT NULL,

  `time` varchar(45) DEFAULT NULL,

  `owner` int(11) DEFAULT NULL,

  PRIMARY KEY (`id`),

  KEY `fk_forum_user` (`owner`)

) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;



--

-- Dumping data for table `forum_titles`

--



-- --------------------------------------------------------



--

-- Table structure for table `groups`

--



CREATE TABLE IF NOT EXISTS `groups` (

  `id` int(11) NOT NULL AUTO_INCREMENT,

  `groupName` varchar(45) DEFAULT NULL,

  PRIMARY KEY (`id`)

) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=2;



--

-- Dumping data for table `groups`

--



INSERT INTO `groups` (`groupName`) VALUES
('A'),
('B'),
('C'),
('D'),
('E'),
('F'),
('G'),
('H');

-- --------------------------------------------------------



--

-- Table structure for table `lag`

--



CREATE TABLE IF NOT EXISTS `lag` (

  `id` int(11) NOT NULL,

  `lag` varchar(5) DEFAULT NULL,

  `countryName_sv` varchar(45) DEFAULT NULL,

  `countryName_en` varchar(45) DEFAULT NULL,

  `countryShort` varchar(45) DEFAULT NULL,

  `flagImage` varchar(45) DEFAULT NULL,

  PRIMARY KEY (`id`)

) ENGINE=MyISAM DEFAULT CHARSET=latin1;



-- Dumping data for table `lag`

--



INSERT INTO `lag` (`id`, `lag`, `countryName_sv`, `countryName_en`, `countryShort`, `flagImage`) VALUES

(1, 'A1', 'Italien', 'Italy', 'ITA', 'ita.png'),
(2, 'A2', 'Schweiz', 'Switzerland', 'SWI', 'sch.gif'),
(3, 'A3', 'Turkiet', 'Turkey', 'TUR', 'tur.gif'),
(4, 'A4', 'Wales', 'Wales', 'WAL', 'wal.webp'),
(5, 'B1', 'Belgien', 'Belgium', 'BEL', 'bel.png'),
(6, 'B2', 'Danmark', 'Denmark', 'DEN', 'den.gif'),
(7, 'B3', 'Finland', 'Finland', 'FIN', 'fin.webp'),
(8, 'B4', 'Ryssland', 'Russia', 'RUS', 'rus.png'),
(9, 'C1', 'Österrike', 'Austria', 'AUS', 'aus.png'),
(10, 'C2', 'Nederländerna', 'Netherlands', 'NET', 'net.png'),
(11, 'C3', 'Nordmakedonien', 'North Macedonia', 'NMD', 'nmd.webp'),
(12, 'C4', 'Ukraina', 'Ukarine', 'UKR', 'ukr.gif'),
(13, 'D1', 'Kroatien', 'Croatia', 'CRO', 'cro.png'),
(14, 'D2', 'Tjeckien', 'Czech', 'CZE', 'cze.gif'),
(15, 'D3', 'England', 'England', 'ENG', 'eng.gif'),
(16, 'D4', 'Skottland', 'Scottland', 'SCO', 'sco.webp'),
(17, 'E1', 'Polen', 'Poland', 'POL', 'pol.png'),
(18, 'E2', 'Slovakien', 'Slovakia', 'SLO', 'svk.gif'),
(19, 'E3', 'Spanien', 'Spain', 'SPA', 'spa.png'),
(20, 'E4', 'Sverige', 'Sweden', 'SWE', 'swe.gif'),
(21, 'F1', 'Frankrike', 'France', 'FRA', 'fra.png'),
(22, 'F2', 'Tyskland', 'Germany', 'GER', 'ger.png'),
(23, 'F3', 'Ungern', 'Hungary', 'HUN', 'hun.gif'),
(24, 'F4', 'Portugal', 'Portugal', 'POR', 'por.gif');



-- --------------------------------------------------------



--

-- Table structure for table `matcher`

--



CREATE TABLE IF NOT EXISTS `matcher` (

  `ID` int(11) NOT NULL,

  `hemma` varchar(45) DEFAULT NULL,

  `borta` varchar(45) DEFAULT NULL,

  `datum` varchar(45) DEFAULT NULL,

  `tid` varchar(45) DEFAULT NULL,

  `plats` int(11) DEFAULT NULL,

  PRIMARY KEY (`ID`),

  KEY `fk_plats_to_stadium` (`plats`)

) ENGINE=MyISAM DEFAULT CHARSET=latin1;



--

-- Dumping data for table `matcher`

--


INSERT INTO `matcher` (`ID`, `hemma`, `borta`, `datum`, `tid`, `plats`) VALUES

(1, 'A3', 'A1', '2021-06-11', '21:00', 5),
(2, 'A4', 'A2', '2021-06-12', '15:00', 2),
(14, 'A3', 'A4', '2021-06-16', '18:00', 2),
(15, 'A1', 'A2', '2021-06-16', '21:00', 5),
(25, 'A1', 'A4', '2021-06-20', '18:00', 5),
(26, 'A2', 'A3', '2021-06-20', '18:00', 2),

(3, 'B2', 'B3', '2021-06-12', '18:00', 3),
(4, 'B1', 'B4', '2021-06-12', '21:00', 8),
(13, 'B3', 'B4', '2021-06-16', '15:00', 8),
(17, 'B2', 'B1', '2021-06-17', '18:00', 3),
(29, 'B4', 'B2', '2021-06-21', '21:00', 3),
(30, 'B3', 'B1', '2021-06-21', '21:00', 8),

(6, 'C1', 'C3', '2021-06-13', '18:00', 7),
(7, 'C2', 'C4', '2021-06-13', '21:00', 6),
(16, 'C4', 'C3', '2021-06-17', '15:00', 7),
(18, 'C2', 'C1', '2021-06-17', '21:00', 6),
(27, 'C4', 'C1', '2021-06-21', '18:00', 7),
(28, 'C3', 'C2', '2021-06-21', '18:00', 6),

(5, 'D3', 'D1', '2021-06-13', '15:00', 1),
(8, 'D4', 'D2', '2021-06-14', '15:00', 9),
(20, 'D1', 'D2', '2021-06-18', '18:00', 9),
(21, 'D3', 'D4', '2021-06-18', '21:00', 1),
(31, 'D1', 'D4', '2021-06-22', '21:00', 9),
(32, 'D2', 'D3', '2021-06-22', '21:00', 1),

(9, 'E1', 'E2', '2021-06-14', '18:00', 8),
(10, 'E3', 'E4', '2021-06-14', '21:00', 10),
(19, 'E4', 'E2', '2021-06-18', '15:00', 8),
(24, 'E3', 'E1', '2021-06-19', '21:00', 10),
(33, 'E4', 'E1', '2021-06-23', '18:00', 8),
(34, 'E2', 'E3', '2021-06-23', '18:00', 10),

(11, 'F3', 'F4', '2021-06-15', '18:00', 12),
(12, 'F1', 'F2', '2021-06-15', '21:00', 11),
(22, 'F3', 'F1', '2021-06-19', '15:00', 12),
(23, 'F4', 'F2', '2021-06-19', '18:00', 11),
(35, 'F4', 'F1', '2021-06-23', '21:00', 12),
(36, 'F2', 'F3', '2021-06-23', '21:00', 11),


(37, '', '', '2021-06-26', '18:00', 6),
(38, '', '', '2021-06-26', '21:00', 1),

(39, '', '', '2021-06-27', '18:00', 12),
(40, '', '', '2021-06-27', '21:00', 10),

(41, '', '', '2021-06-28', '18:00', 3),
(42, '', '', '2021-06-28', '21:00', 7),

(43, '', '', '2021-06-29', '18:00', 1),
(44, '', '', '2021-06-29', '21:00', 9),

(45, '', '', '2021-07-02', '18:00', 8),
(46, '', '', '2021-07-02', '21:00', 11),

(47, '', '', '2021-07-03', '18:00', 2),
(48, '', '', '2021-07-03', '21:00', 5),

(49, '', '', '2021-07-06', '21:00', 1),
(50, '', '', '2021-07-07', '21:00', 1),
(51, '', '', '2021-07-11', '21:00', 1);


-- --------------------------------------------------------



--

-- Table structure for table `tippning`

--



CREATE TABLE IF NOT EXISTS `tippning` (
  `id` int(11) NOT NULL,
  `m1` varchar(2) DEFAULT NULL,
  `m2` varchar(2) DEFAULT NULL,
  `m3` varchar(2) DEFAULT NULL,
  `m4` varchar(2) DEFAULT NULL,
  `m5` varchar(2) DEFAULT NULL,

  `m6` varchar(2) DEFAULT NULL,

  `m7` varchar(2) DEFAULT NULL,

  `m8` varchar(2) DEFAULT NULL,

  `m9` varchar(2) DEFAULT NULL,

  `m10` varchar(2) DEFAULT NULL,

  `m11` varchar(2) DEFAULT NULL,

  `m12` varchar(2) DEFAULT NULL,

  `m13` varchar(2) DEFAULT NULL,

  `m14` varchar(2) DEFAULT NULL,

  `m15` varchar(2) DEFAULT NULL,

  `m16` varchar(2) DEFAULT NULL,

  `m17` varchar(2) DEFAULT NULL,

  `m18` varchar(2) DEFAULT NULL,

  `m19` varchar(2) DEFAULT NULL,

  `m20` varchar(2) DEFAULT NULL,

  `m21` varchar(2) DEFAULT NULL,

  `m22` varchar(2) DEFAULT NULL,

  `m23` varchar(2) DEFAULT NULL,

  `m24` varchar(2) DEFAULT NULL,

  `m25` varchar(2) DEFAULT NULL,

  `m26` varchar(2) DEFAULT NULL,

  `m27` varchar(2) DEFAULT NULL,

  `m28` varchar(2) DEFAULT NULL,

  `m29` varchar(2) DEFAULT NULL,

  `m30` varchar(2) DEFAULT NULL,

  `m31` varchar(2) DEFAULT NULL,

  `m32` varchar(2) DEFAULT NULL,

  `m33` varchar(2) DEFAULT NULL,

  `m34` varchar(2) DEFAULT NULL,

  `m35` varchar(2) DEFAULT NULL,

  `m36` varchar(2) DEFAULT NULL,

  `m37` varchar(2) DEFAULT NULL,
  `m37a` varchar(2) default NULL,
  `m37b` varchar(2) default NULL,
  `m38` varchar(2) default NULL,
  `m38a` varchar(2) default NULL,
  `m38b` varchar(2) default NULL,
  `m39` varchar(2) default NULL,
  `m39a` varchar(2) default NULL,
  `m39b` varchar(2) default NULL,
  `m40` varchar(2) default NULL,
  `m40a` varchar(2) default NULL,
  `m40b` varchar(2) default NULL,
  `m41` varchar(2) default NULL,
  `m41a` varchar(2) default NULL,
  `m41b` varchar(2) default NULL,
  `m42` varchar(2) default NULL,
  `m42a` varchar(2) default NULL,
  `m42b` varchar(2) default NULL,
  `m43` varchar(2) default NULL,
  `m43a` varchar(2) default NULL,
  `m43b` varchar(2) default NULL,
  `m44` varchar(2) default NULL,
  `m44a` varchar(2) default NULL,
  `m44b` varchar(2) default NULL,
  `m45` varchar(2) default NULL,
  `m45a` varchar(2) default NULL,
  `m45b` varchar(2) default NULL,
  `m46` varchar(2) default NULL,
  `m46a` varchar(2) default NULL,
  `m46b` varchar(2) default NULL,
  `m47` varchar(2) default NULL,
  `m47a` varchar(2) default NULL,
  `m47b` varchar(2) default NULL,
  `m48` varchar(2) default NULL,
  `m48a` varchar(2) default NULL,
  `m48b` varchar(2) default NULL,
  `m49` varchar(2) default NULL,
  `m49a` varchar(2) default NULL,
  `m49b` varchar(2) default NULL,
  `m50` varchar(2) default NULL,
  `m50a` varchar(2) default NULL,
  `m50b` varchar(2) default NULL,
  `m51` varchar(2) default NULL,
  `m51a` varchar(2) default NULL,
  `m51b` varchar(2) default NULL,
  `swedishGoals` int(11) NOT NULL default 0,
  `topScorer` varchar(50) NOT NULL default '',

  PRIMARY KEY (`id`)

) ENGINE=MyISAM DEFAULT CHARSET=latin1;



--

-- Dumping data for table `tippning`

--


INSERT INTO `tippning` (`id`) VALUES (-1);

-- --------------------------------------------------------



--

-- Table structure for table `tippwinner`

--



CREATE TABLE IF NOT EXISTS `tippwinner` (

  `id` int(11) NOT NULL,

  `year` varchar(45) DEFAULT NULL,

  `givenName` varchar(45) DEFAULT NULL,

  `familyName` varchar(45) DEFAULT NULL,

  `cash` varchar(45) DEFAULT NULL,

  `pic` varchar(45) DEFAULT NULL,

  PRIMARY KEY (`id`)

) ENGINE=MyISAM DEFAULT CHARSET=latin1;



--

-- Dumping data for table `tippwinner`

--





-- --------------------------------------------------------



--

-- Table structure for table `users`

--



CREATE TABLE IF NOT EXISTS `users` (

  `id` int(11) NOT NULL AUTO_INCREMENT,

  `givenName` varchar(45) DEFAULT NULL,

  `familyName` varchar(45) DEFAULT NULL,

  `street` varchar(45) DEFAULT NULL,

  `city` varchar(45) DEFAULT NULL,

  `phoneNumber` varchar(45) DEFAULT NULL,

  `Company` varchar(45) DEFAULT NULL,

  `emailAddress` varchar(45) DEFAULT NULL,

  `username` varchar(45) DEFAULT NULL,

  `password` varchar(45) DEFAULT NULL,

  `foto` varchar(45) DEFAULT 'pic/users/default.png',

  `betalt` varchar(45) DEFAULT NULL,

  `admin` int(11) DEFAULT NULL,

  `points` int(11) DEFAULT NULL,

  `nbrOfLogins` int(11) DEFAULT '0',

  PRIMARY KEY (`id`)

) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;



--

-- Dumping data for table `users`

--



-- --------------------------------------------------------



--

-- Table structure for table `vmwinner`

--



CREATE TABLE IF NOT EXISTS `vmwinner` (

  `id` int(11) NOT NULL,

  `year` varchar(45) DEFAULT NULL,

  `winner_swe` varchar(45) DEFAULT NULL,

  `winner_eng` varchar(45) DEFAULT NULL,

  `flagpic` varchar(45) DEFAULT NULL,

  `host` varchar(45) DEFAULT NULL,

  PRIMARY KEY (`id`)

) ENGINE=MyISAM DEFAULT CHARSET=latin1;



--

-- Dumping data for table `vmwinner`

--



INSERT INTO `vmwinner` (`id`, `year`, `winner_swe`, `winner_eng`, `flagpic`, `host`) VALUES

(1, '1930', 'Uruguay', 'Uruguay', 'uru.png', 'Uruguay'),

(2, '1934', 'Italien', 'Italy', 'ita.png', 'Italien'),

(3, '1938', 'Italien', 'Italy', 'ita.png', 'Frankrike'),

(4, '1942', '-', '-', '-', 'Andra vÃ¤rldskriget VM spelades inte'),

(5, '1950', 'Uruguay', 'Uruguay', 'uru.png', 'Brasilien'),

(6, '1954', 'VÃ¤sttyskland', 'West-Germany', 'west_ger.png', 'Schweiz'),

(7, '1958', 'Brasilien', 'Brazil', 'bra.png', 'Sverige'),

(8, '1962', 'Brasilien', 'Brazil', 'bra.png', 'Chile'),

(9, '1966', 'England', 'England', 'eng.png', 'England'),

(10, '1970', 'Brasilien', 'Brazil', 'bra.png', 'Mexiko'),

(11, '1974', 'VÃ¤sttyskland', 'West-Germany', 'west_ger.png', 'VÃ¤sttyskland'),

(12, '1978', 'Argentina', 'Argentina', 'arg.png', 'Argentina'),

(13, '1982', 'Italien', 'Italy', 'ita.png', 'Spanien'),

(14, '1986', 'Argentina', 'Argentina', 'arg.png', 'Mexiko'),

(15, '1990', 'VÃ¤sttyskland', 'West-Germany', 'west_ger.png', 'Italien'),

(16, '1994', 'Brasilien', 'Brazil', 'bra.png', 'USA'),

(17, '1998', 'Frankrike', 'France', 'fra.png', 'Frankrike'),

(18, '2002', 'Brasilien', 'Brazil', 'bra.png', 'Sydkorea & Japan'),

(19, '2006', 'Italien', 'Italy', 'ita.png', 'Tyskland'),

(20, '2010', 'Spanien', 'Spain', 'spa.png', 'Sydafrika'),

(21, '2014', 'Tyskland', 'Germany', '', 'Brasilien');



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
