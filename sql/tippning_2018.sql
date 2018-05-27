-- phpMyAdmin SQL Dump

-- version 3.5.8.1

-- http://www.phpmyadmin.net

--

-- Host: johansvensson.se.mysql:3306

-- Generation Time: May 22, 2018 at 07:41 AM

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

CREATE DATABASE `tippning` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `tippning`;



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

(1, 'Cosmos Arena', 'Samara', '44918', '2017'),

(2, 'Olympiastadion Fisjt', 'Sotji', '47659', '2013'),

(3, 'Rostov Arena', 'Rostov-na-Donu', '45000', '2017'),

(4, 'Centralstadion', 'Jekaterinburg', '35000', '1957'),

(5, 'Volgograd Arena', 'Volgograd', '45568', '2017'),

(6, 'Kazan Arena', 'Kazan', '45105', '2013'),

(7, 'Luzjnikistadion', 'Moskva', '81000', '2013'),

(8, 'Jubileumsstadion (Mordvinien Arena)', 'Saransk', '45015', '2018'),

(9, 'Otkrytie Arena (Spartak Stadium)', 'Moskva', '45360', '2014'),

(10, 'Centralstadion', 'S:t Petersburg', '68134', '2017'),

(11, 'Nizhny Novgorod Stadium', 'Nizjnij Novgorod', '44899', '2018'),

(12, 'Kaliningrad Stadium', 'Kaliningrad', '35212', '2018');



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
(7, '1', 'Grupp G'),
(8, '1', 'Grupp H'),
(9, '2', 'Åttondel 1'),
(10, '2', 'Åttondel 2'),
(11, '2', 'Åttondel 3'),
(12, '2', 'Åttondel 4'),
(13, '2', 'Åttondel 5'),
(14, '2', 'Åttondel 6'),
(15, '2', 'Åttondel 7'),
(16, '2', 'Åttondel 8'),
(17, '3', 'Kvartsfinal 1'),
(18, '3', 'Kvartsfinal 2'),
(19, '3', 'Kvartsfinal 3'),
(20, '3', 'Kvartsfinal 4'),
(21, '4', 'Semifinal 1'),
(22, '4', 'Semifinal 2'),
(23, '5', 'Final');


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

  `forumID` int(11) NOT NULL AUTO_INCREMENT,

  `user` int(11) DEFAULT NULL,

  `date` varchar(45) DEFAULT NULL,

  `time` varchar(45) DEFAULT NULL,

  `title` varchar(45) DEFAULT NULL,

  `contribution` varchar(45) DEFAULT NULL,

  PRIMARY KEY (`forumID`),

  KEY `fk_user_to_userid` (`user`)

) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;



--

-- Dumping data for table `forum_entries`

--



INSERT INTO `forum_entries` (`forumID`, `user`, `date`, `time`, `title`, `contribution`) VALUES

(1, 44, '2016-04-26', '08:33', 'Test', 'Test');



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



INSERT INTO `forum_titles` (`id`, `title`, `date`, `time`, `owner`) VALUES

(1, 'Test', '2016-04-26', '08:33', 44);



-- --------------------------------------------------------



--

-- Table structure for table `groups`

--



CREATE TABLE IF NOT EXISTS `groups` (

  `id` int(11) NOT NULL,

  `groupName` varchar(45) DEFAULT NULL,

  PRIMARY KEY (`id`)

) ENGINE=MyISAM DEFAULT CHARSET=latin1;



--

-- Dumping data for table `groups`

--



INSERT INTO `groups` (`id`, `groupName`) VALUES

(1, 'A'),

(2, 'B'),

(3, 'C'),

(4, 'D'),

(5, 'E'),

(6, 'F'),

(7, 'G'),

(8, 'H');

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



--

-- Dumping data for table `lag`

--



INSERT INTO `lag` (`id`, `lag`, `countryName_sv`, `countryName_en`, `countryShort`, `flagImage`) VALUES

(1, 'A1', 'Ryssland', 'Russia', 'RUS', 'rus.png'),
(2, 'A2', 'Uruguay', 'Uruguay', 'URU', 'uru.gif'),
(3, 'A3', 'Egypten', 'Egypt', 'EYG', 'eyg.png'),
(4, 'A4', 'Saudiarabien', 'Saudi Arabia', 'SAU', 'sau.png'),
(5, 'B1', 'Portugal', 'Portugal', 'POR', 'por.png'),
(6, 'B2', 'Spanien', 'Spain', 'ESP', 'spa.png'),
(7, 'B3', 'Iran', 'Iran', 'IRN', 'ira.png'),
(8, 'B4', 'Marocko', 'Morocco', 'MAR', 'mar.png'),
(9, 'C1', 'Frankrike', 'France', 'FRA', 'fra.png'),
(10, 'C2', 'Peru', 'Peru', 'PER', 'per.png'),
(11, 'C3', 'Danmark', 'Denmark', 'DEN', 'den.gif'),
(12, 'C4', 'Australien', 'Australia', 'AUS', 'aus.gif'),
(13, 'D1', 'Argentina', 'Argentina', 'ARG', 'arg.png'),
(14, 'D2', 'Kroatien', 'Croaatia', 'CRO', 'cro.gif'),
(15, 'D3', 'Island', 'Iceland', 'ICE', 'ice.gif'),
(16, 'D4', 'Nigeria', 'Nigeria', 'NGA', 'nig.png'),
(17, 'E1', 'Brasilien', 'Brasilia', 'BRA', 'bra.png'),
(18, 'E2', 'Schweiz', 'Switzerland', 'SCH', 'sch.png'),
(19, 'E3', 'Costa Rica', 'Costa Rica', 'CRI', 'cos.png'),
(20, 'E4', 'Serbien', 'Serbia', 'SER', 'ser.png'),
(21, 'F1', 'Tyskland', 'Germany', 'GER', 'ger.png'),
(22, 'F2', 'Mexiko', 'Mexico', 'MEX', 'mex.png'),
(23, 'F3', 'Sverige', 'Sweden', 'SWE', 'swe.gif'),
(24, 'F4', 'Sydkorea', 'South Korea', '', 'kor.gif'),
(25, 'G1', 'Belgien', 'Belgium', 'BEL', 'bel.png'),
(26, 'G2', 'England', 'England', 'ENG', 'eng.png'),
(27, 'G3', 'Tunisien', 'Tunisia', 'TUN', 'tun.png'),
(28, 'G4', 'Panama', 'Panama', 'PAN', 'pan.png'),
(29, 'H1', 'Polen', 'Poland', 'POL', 'pol.png'),
(30, 'H2', 'Colombia', 'Colombia', 'COL', 'col.png'),
(31, 'H3', 'Senegal', 'Senegal', 'SEN', 'sen.png'),
(32, 'H4', 'Japan', 'Japan', 'JAP', 'jap.png');



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

(1, 'A1', 'A4', '2018-06-14', '17:00', 7),
(2, 'A3', 'A2', '2018-06-15', '13:00', 4),
(17, 'A1', 'A3', '2018-06-19', '20:00', 3),
(19, 'A2', 'A4', '2018-06-20', '16:30', 6),
(33, 'A2', 'A1', '2018-06-25', '15:00', 12),
(34, 'A4', 'A3', '2018-06-25', '15:50', 8),

(3, 'B4', 'B3', '2018-06-15', '17:00', 2),
(4, 'B1', 'B2', '2018-06-15', '20:00', 10),
(18, 'B1', 'B4', '2018-06-20', '14:00', 1),
(20, 'B3', 'B2', '2018-06-20', '19:30', 4),
(35, 'B3', 'B1', '2018-06-25', '20:00', 7),
(36, 'B2', 'B4', '2018-06-25', '20:00', 2),

(5, 'C1', 'C4', '2018-06-16', '12:00', 6),
(7, 'C2', 'C3', '2018-06-16', '17:30', 9),
(21, 'C3', 'C4', '2018-06-21', '13:30', 10),
(22, 'C1', 'C2', '2018-06-21', '16:30', 11),
(37, 'C3', 'C1', '2018-06-26', '16:00', 10),
(38, 'C4', 'C2', '2018-06-26', '16:00', 3),

(6, 'D1', 'D3', '2018-06-16', '15:00', 8),
(8, 'D2', 'D4', '2018-06-16', '20:30', 12),
(23, 'D1', 'D2', '2018-06-21', '19:30', 5),
(25, 'D4', 'D3', '2018-06-22', '17:00', 12),
(39, 'D4', 'D1', '2018-06-26', '19:50', 6),
(40, 'D3', 'D2', '2018-06-26', '19:00', 4),

(9, 'E3', 'E4', '2018-06-17', '13:30', 7),
(11, 'E1', 'E2', '2018-06-17', '20:00', 1),
(24, 'E1', 'E3', '2018-06-22', '14:00', 9),
(26, 'E4', 'E2', '2018-06-22', '20:00', 3),
(43, 'E4', 'E1', '2018-06-27', '21:00', 9),
(44, 'E2', 'E3', '2018-06-27', '21:00', 1),

(10, 'F1', 'F2', '2018-06-17', '16:30', 3),
(12, 'F3', 'F4', '2018-06-18', '14:00', 11),
(29, 'F1', 'F3', '2018-06-23', '19:30', 2),
(28, 'F4', 'F2', '2018-06-23', '16:30', 11),
(41, 'F4', 'F1', '2018-06-27', '16:00', 5),
(42, 'F2', 'F3', '2018-06-27', '16:00', 1),

(13, 'G1', 'G4', '2018-06-18', '17:00', 2),
(14, 'G3', 'G2', '2018-06-18', '19:30', 5),
(27, 'G1', 'G3', '2018-06-23', '14:00', 4),
(30, 'G2', 'G4', '2018-06-24', '14:00', 6),
(47, 'G2', 'G1', '2018-06-28', '20:00', 12),
(48, 'G4', 'G3', '2018-06-28', '21:00', 8),

(15, 'H2', 'H4', '2018-06-19', '13:40', 7),
(16, 'H1', 'H3', '2018-06-19', '17:00', 8),
(31, 'H4', 'H3', '2018-06-24', '16:30', 1),
(32, 'H1', 'H2', '2018-06-24', '19:30', 5),
(45, 'H4', 'H1', '2018-06-28', '17:00', 1),
(46, 'H3', 'H2', '2018-06-28', '18:00', 1),

(49, '', '', '2018-06-30', '20:00', 1),
(50, '', '', '2018-06-30', '15:00', 1),

(51, '', '', '2018-07-01', '16:00', 1),
(52, '', '', '2018-07-01', '19:00', 1),

(53, '', '', '2018-07-02', '15:00', 1),
(54, '', '', '2018-07-02', '20:00', 1),

(55, '', '', '2018-07-03', '16:00', 1),
(56, '', '', '2018-07-03', '19:00', 1),

(57, '', '', '2018-07-06', '16:00', 1),
(58, '', '', '2018-07-06', '19:00', 1),

(59, '', '', '2018-07-07', '20:00', 1),
(60, '', '', '2018-07-07', '18:00', 1),

(61, '', '', '2018-07-10', '21:00', 1),
(62, '', '', '2018-07-11', '21:00', 1),
(63, '', '', '2018-07-14', '17:00', 1),
(64, '', '', '2018-07-15', '18:00', 1);



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

  `m38` varchar(2) DEFAULT NULL,

  `m39` varchar(2) DEFAULT NULL,

  `m40` varchar(2) DEFAULT NULL,

  `m41` varchar(2) DEFAULT NULL,

  `m42` varchar(2) DEFAULT NULL,

  `m43` varchar(2) DEFAULT NULL,

  `m44` varchar(2) DEFAULT NULL,

  `m45` varchar(2) DEFAULT NULL,

  `m46` varchar(2) DEFAULT NULL,

  `m47` varchar(2) DEFAULT NULL,

  `m48` varchar(2) DEFAULT NULL,

  `m49` varchar(2) DEFAULT NULL,
  `m49a` varchar(2) default NULL,
  `m49b` varchar(2) default NULL,
  `m50` varchar(2) default NULL,
  `m50a` varchar(2) default NULL,
  `m50b` varchar(2) default NULL,
  `m51` varchar(2) default NULL,
  `m51a` varchar(2) default NULL,
  `m51b` varchar(2) default NULL,
  `m52` varchar(2) default NULL,
  `m52a` varchar(2) default NULL,
  `m52b` varchar(2) default NULL,
  `m53` varchar(2) default NULL,
  `m53a` varchar(2) default NULL,
  `m53b` varchar(2) default NULL,
  `m54` varchar(2) default NULL,
  `m54a` varchar(2) default NULL,
  `m54b` varchar(2) default NULL,
  `m55` varchar(2) default NULL,
  `m55a` varchar(2) default NULL,
  `m55b` varchar(2) default NULL,
  `m56` varchar(2) default NULL,
  `m56a` varchar(2) default NULL,
  `m56b` varchar(2) default NULL,
  `m57` varchar(2) default NULL,
  `m57a` varchar(2) default NULL,
  `m57b` varchar(2) default NULL,
  `m58` varchar(2) default NULL,
  `m58a` varchar(2) default NULL,
  `m58b` varchar(2) default NULL,
  `m59` varchar(2) default NULL,
  `m59a` varchar(2) default NULL,
  `m59b` varchar(2) default NULL,
  `m60` varchar(2) default NULL,
  `m60a` varchar(2) default NULL,
  `m60b` varchar(2) default NULL,
  `m61` varchar(2) default NULL,
  `m61a` varchar(2) default NULL,
  `m61b` varchar(2) default NULL,
  `m62` varchar(2) default NULL,
  `m62a` varchar(2) default NULL,
  `m62b` varchar(2) default NULL,
  `m63` varchar(2) default NULL,
  `m63a` varchar(2) default NULL,
  `m63b` varchar(2) default NULL,
  `m64` varchar(2) default NULL,
  `m64a` varchar(2) default NULL,
  `m64b` varchar(2) default NULL,
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



INSERT INTO `tippwinner` (`id`, `year`, `givenName`, `familyName`, `cash`, `pic`) VALUES

(1, '2010', 'Martin', 'SundstrÃ¶m', '10', ''),

(2, '2012', 'Martin', 'SundstrÃ¶m', '10', ''),

(3, '2014', 'Johan', 'Thuvesson', '10', '');



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



INSERT INTO `users` (`id`, `givenName`, `familyName`, `street`, `city`, `phoneNumber`, `Company`, `emailAddress`, `username`, `password`, `foto`, `betalt`, `admin`, `points`, `nbrOfLogins`) VALUES

(44, 'Johan', 'Widholm', NULL, 'Tomelilla', '070', '', 'johan@widholm.se', 'johan@widholm.se', 'e157b7e125613bfbfd7c09192e25ab0a', NULL, '1', NULL, NULL, 33),

(55, 'Kaveh Rahimi', 'SEOdob', NULL, 'SEOdob', '83883871288', 'Stoua la brute P', 'esgruffunchee1997@seocdvig.ru', 'SEOdob', 'c5048d6244f3c1ea3fe5f44b4ef18fd3', NULL, NULL, NULL, NULL, 1),

(54, 'Sean Peter Fox', 'JamesWew', NULL, 'JamesWew', '85659982935', 'Que dalle', 'sweden@cheapscript.net', 'JamesWew', '40eed085afd6d3354ffc056890a2f21a', NULL, NULL, NULL, NULL, 1),

(56, 'Johan', 'Widholm', NULL, 'Tomelilla', '', '', 'johan@bo-ohlsson.se', 'johan@bo-ohlsson.se', 'e157b7e125613bfbfd7c09192e25ab0a', NULL, NULL, NULL, NULL, 1);



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
