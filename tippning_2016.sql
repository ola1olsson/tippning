-- phpMyAdmin SQL Dump
-- version 2.9.2-Debian-1.one.com1
-- http://www.phpmyadmin.net
-- 
-- Host: MySQL Server
-- Generation Time: May 04, 2011 at 05:01 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.0-8+etch16
-- 
-- Database: `tippning`
-- 
CREATE DATABASE `tippning` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tippning`;

-- --------------------------------------------------------

-- 
-- Table structure for table `classification`
-- 

CREATE TABLE `classification` (
  `id` int(11) NOT NULL,
  `classId` varchar(45) default NULL,
  `class` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `classification`
-- 

INSERT INTO `classification` VALUES (1, '1', 'Grupp A');
INSERT INTO `classification` VALUES (2, '1', 'Grupp B');
INSERT INTO `classification` VALUES (3, '1', 'Grupp C');
INSERT INTO `classification` VALUES (4, '1', 'Grupp D');
INSERT INTO `classification` VALUES (5, '1', 'Grupp E');
INSERT INTO `classification` VALUES (6, '1', 'Grupp F');
INSERT INTO `classification` VALUES (9, '2', 'Åttondel 1');
INSERT INTO `classification` VALUES (10, '2', 'Åttondel 2');
INSERT INTO `classification` VALUES (11, '2', 'Åttondel 3');
INSERT INTO `classification` VALUES (12, '2', 'Åttondel 4');
INSERT INTO `classification` VALUES (13, '2', 'Åttondel 5');
INSERT INTO `classification` VALUES (14, '2', 'Åttondel 6');
INSERT INTO `classification` VALUES (15, '2', 'Åttondel 7');
INSERT INTO `classification` VALUES (16, '2', 'Åttondel 8');
INSERT INTO `classification` VALUES (17, '3', 'Kvartsfinal 1');
INSERT INTO `classification` VALUES (18, '3', 'Kvartsfinal 2');
INSERT INTO `classification` VALUES (19, '3', 'Kvartsfinal 3');
INSERT INTO `classification` VALUES (20, '3', 'Kvartsfinal 4');
INSERT INTO `classification` VALUES (21, '4', 'Semifinal 1');
INSERT INTO `classification` VALUES (22, '4', 'Semifinal 2');
INSERT INTO `classification` VALUES (23, '5', 'Final');

-- --------------------------------------------------------

-- 
-- Table structure for table `emwinner`
-- 

CREATE TABLE `emwinner` (
  `id` int(11) NOT NULL,
  `year` varchar(45) default NULL,
  `winner_swe` varchar(45) default NULL,
  `winner_eng` varchar(45) default NULL,
  `flagpic` varchar(45) default NULL,
  `host` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `emwinner`
-- 

INSERT INTO `emwinner` VALUES (1, '1960', 'Sovjetunionen', 'USSR', 'ussr.gif', 'Frankrike');
INSERT INTO `emwinner` VALUES (2, '1964', 'Spanien', 'Spain', 'esp.png', 'Spanien');
INSERT INTO `emwinner` VALUES (3, '1968', 'Italien', 'Italy', 'ita.png', 'Italien');
INSERT INTO `emwinner` VALUES (4, '1972', 'Västtyskland', 'West-Germany', 'west_ger.png', 'Belgien');
INSERT INTO `emwinner` VALUES (5, '1976', 'Tjeckoslovakien', 'Czechoslovakia', 'cze_svk.png', 'Jugoslavien');
INSERT INTO `emwinner` VALUES (6, '1980', 'Västtyskland', 'West-Germany', 'west_ger.png', 'Italien');
INSERT INTO `emwinner` VALUES (7, '1984', 'Frankrike', 'France', 'fra.png', 'Frankrike');
INSERT INTO `emwinner` VALUES (8, '1988', 'Nederländerna', 'Netherlands', 'net.png', 'Västtyskland');
INSERT INTO `emwinner` VALUES (9, '1992', 'Danmark', 'Denmark', 'den.png', 'Sverige');
INSERT INTO `emwinner` VALUES (10, '1996', 'Tyskland', 'Germany', 'ger.png', 'England');
INSERT INTO `emwinner` VALUES (11, '2000', 'Frankrike', 'France', 'fra.png', 'Belgien & Nederländerna');
INSERT INTO `emwinner` VALUES (12, '2004', 'Grekland', 'Greece', 'gre.png', 'Portugal');
INSERT INTO `emwinner` VALUES (13, '2008', 'Spanien', 'Spain', 'esp.png', 'Schweiz & Österrike');
INSERT INTO `emwinner` VALUES (14, '2012', 'Spanien', 'Spain', 'esp.png', 'Polen & Ukraina');

-- --------------------------------------------------------

-- 
-- Table structure for table `forum_entries`
-- 

CREATE TABLE `forum_entries` (
  `forumID` int(11) NOT NULL auto_increment,
  `user` int(11) default NULL,
  `date` varchar(45) default NULL,
  `time` varchar(45) default NULL,
  `title` varchar(45) default NULL,
  `contribution` varchar(45) default NULL,
  PRIMARY KEY  (`forumID`),
  KEY `fk_user_to_userid` (`user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `forum_entries`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `forum_titles`
-- 

CREATE TABLE `forum_titles` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(45) default NULL,
  `date` varchar(45) default NULL,
  `time` varchar(45) default NULL,
  `owner` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_forum_user` (`owner`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `forum_titles`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `groups`
-- 

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `groupName` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `groups`
-- 

INSERT INTO `groups` VALUES (1, 'A');
INSERT INTO `groups` VALUES (2, 'B');
INSERT INTO `groups` VALUES (3, 'C');
INSERT INTO `groups` VALUES (4, 'D');
INSERT INTO `groups` VALUES (5, 'E');

-- --------------------------------------------------------

-- 
-- Table structure for table `lag`
-- 

CREATE TABLE `lag` (
  `id` int(11) NOT NULL,
  `lag` varchar(5) default NULL,
  `countryName_sv` varchar(45) default NULL,
  `countryName_en` varchar(45) default NULL,
  `countryShort` varchar(45) default NULL,
  `flagImage` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `lag`
-- 

INSERT INTO `lag` VALUES (1, 'A1', 'Frankrike', 'France', 'FRA', 'fra.png');
INSERT INTO `lag` VALUES (2, 'A2', 'Rumänien', 'Romania', 'ROM', 'rom.gif');
INSERT INTO `lag` VALUES (3, 'A3', 'Albanien', 'Albania', 'ALB', 'alb.gif');
INSERT INTO `lag` VALUES (4, 'A4', 'Schweiz', 'Switzerland', 'SCH', 'sch.png');
INSERT INTO `lag` VALUES (5, 'B1', 'England', 'England', 'ENG', 'eng.png');
INSERT INTO `lag` VALUES (6, 'B2', 'Ryssland', 'Russia', 'RUS', 'rus.png');
INSERT INTO `lag` VALUES (7, 'B3', 'Wales', 'Wales', 'WAL', 'wal.gif');
INSERT INTO `lag` VALUES (8, 'B4', 'Slovakien', 'Slovakia', 'SLO', 'slo.gif');
INSERT INTO `lag` VALUES (9, 'C1', 'Tyskland', '', 'GER', 'ger.png');
INSERT INTO `lag` VALUES (10, 'C2', 'Ukraina', '', 'UKR', 'ukr.gif');
INSERT INTO `lag` VALUES (11, 'C3', 'Polen', '', 'POL', 'pol.gif');
INSERT INTO `lag` VALUES (12, 'C4', 'Nordirland', '', 'NOR', 'nor.gif');
INSERT INTO `lag` VALUES (13, 'D1', 'Spanien', '', 'SPA', 'spa.png');
INSERT INTO `lag` VALUES (14, 'D2', 'Tjeckien', '', 'TJE', 'cze.gif');
INSERT INTO `lag` VALUES (15, 'D3', 'Turkiet', '', 'TUR', 'tur.gif');
INSERT INTO `lag` VALUES (16, 'D4', 'Kroatien', '', 'CRO', 'cro.png');
INSERT INTO `lag` VALUES (17, 'E1', 'Belgien', '', 'BEL', 'bel.png');
INSERT INTO `lag` VALUES (18, 'E2', 'Italien', '', 'ITA', 'ita.png');
INSERT INTO `lag` VALUES (19, 'E3', 'Irland', '', 'IRE', 'ira.png');
INSERT INTO `lag` VALUES (20, 'E4', 'Sverige', '', 'SWE', 'swe.gif');
INSERT INTO `lag` VALUES (21, 'F1', 'Portugal', '', 'POR', 'por.png');
INSERT INTO `lag` VALUES (22, 'F2', 'Island', '', 'ICE', 'ice.gif');
INSERT INTO `lag` VALUES (23, 'F3', 'Österrike', '', 'AUS', 'aus.png');
INSERT INTO `lag` VALUES (24, 'F4', 'Ungern', '', 'HUN', 'hun.gif');

-- --------------------------------------------------------

-- 
-- Table structure for table `matcher`
-- 

CREATE TABLE `matcher` (
  `ID` int(11) NOT NULL,
  `hemma` varchar(45) default NULL,
  `borta` varchar(45) default NULL,
  `datum` varchar(45) default NULL,
  `tid` varchar(45) default NULL,
  `plats` int(11) default NULL,
  PRIMARY KEY  (`ID`),
  KEY `fk_plats_to_stadium` (`plats`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `matcher`
-- 

INSERT INTO `matcher` VALUES (1, 'A1', 'A2', '2016-06-10', '21:00', 1);

INSERT INTO `matcher` VALUES (2, 'A3', 'A4', '2016-06-11', '15:00', 2);
INSERT INTO `matcher` VALUES (3, 'B3', 'B4', '2016-06-11', '18:00', 3);
INSERT INTO `matcher` VALUES (4, 'B1', 'B2', '2016-06-11', '21:00', 4);

INSERT INTO `matcher` VALUES (5, 'D3', 'D4', '2016-06-12', '15:00', 5);
INSERT INTO `matcher` VALUES (6, 'C3', 'C4', '2016-06-12', '18:00', 6);
INSERT INTO `matcher` VALUES (7, 'C1', 'C2', '2016-06-12', '21:00', 7);

INSERT INTO `matcher` VALUES (8, 'D1', 'D2', '2016-06-13', '15:00', 8);
INSERT INTO `matcher` VALUES (9, 'E3', 'E4', '2016-06-13', '18:00', 1);
INSERT INTO `matcher` VALUES (10, 'E1', 'E2', '2016-06-13', '21:00', 10);

INSERT INTO `matcher` VALUES (11, 'F3', 'F4', '2016-06-14', '18:00', 3);
INSERT INTO `matcher` VALUES (12, 'F1', 'F2', '2016-06-14', '21:00', 9);

INSERT INTO `matcher` VALUES (13, 'B2', 'B4', '2016-06-15', '15:00', 7);
INSERT INTO `matcher` VALUES (14, 'A2', 'A4', '2016-06-15', '18:00', 5);
INSERT INTO `matcher` VALUES (15, 'A1', 'A3', '2016-06-15', '21:00', 4);

INSERT INTO `matcher` VALUES (16, 'B1', 'B3', '2016-06-16', '15:00', 2);
INSERT INTO `matcher` VALUES (17, 'C2', 'C4', '2016-06-16', '18:00', 10);
INSERT INTO `matcher` VALUES (18, 'C1', 'C3', '2016-06-16', '21:00', 1);

INSERT INTO `matcher` VALUES (19, 'E2', 'E4', '2016-06-17', '15:00', 8);
INSERT INTO `matcher` VALUES (20, 'D2', 'D4', '2016-06-17', '18:00', 9);
INSERT INTO `matcher` VALUES (21, 'D1', 'D3', '2016-06-17', '21:00', 6);

INSERT INTO `matcher` VALUES (22, 'E1', 'E3', '2016-06-18', '15:00', 3);
INSERT INTO `matcher` VALUES (23, 'F2', 'F4', '2016-06-18', '18:00', 4);
INSERT INTO `matcher` VALUES (24, 'F1', 'F3', '2016-06-18', '21:00', 5);

INSERT INTO `matcher` VALUES (25, 'A4', 'A1', '2016-06-19', '21:00', 7);
INSERT INTO `matcher` VALUES (26, 'A2', 'A3', '2016-06-19', '21:00', 10);

INSERT INTO `matcher` VALUES (27, 'B4', 'B1', '2016-06-20', '21:00', 9);
INSERT INTO `matcher` VALUES (28, 'B2', 'B3', '2016-06-20', '21:00', 8);

INSERT INTO `matcher` VALUES (29, 'C4', 'C1', '2016-06-21', '18:00', 5);
INSERT INTO `matcher` VALUES (30, 'C2', 'C3', '2016-06-21', '18:00', 4);
INSERT INTO `matcher` VALUES (31, 'D4', 'D1', '2016-06-21', '21:00', 3);
INSERT INTO `matcher` VALUES (32, 'D2', 'D3', '2016-06-21', '21:00', 2);


INSERT INTO `matcher` VALUES (33, 'F4', 'F1', '2016-06-22', '18:00', 10);
INSERT INTO `matcher` VALUES (34, 'F2', 'F3', '2016-06-22', '18:00', 1);
INSERT INTO `matcher` VALUES (35, 'E4', 'E1', '2016-06-22', '21:00', 6);
INSERT INTO `matcher` VALUES (36, 'E2', 'E3', '2016-06-22', '21:00', 7);


INSERT INTO `matcher` VALUES (37, '', '', '2016-06-25', '15:00', 9);
INSERT INTO `matcher` VALUES (38, '', '', '2016-06-25', '18:00', 5);
INSERT INTO `matcher` VALUES (39, '', '', '2016-06-25', '21:00', 2);
INSERT INTO `matcher` VALUES (40, '', '', '2016-06-26', '15:00', 10);
INSERT INTO `matcher` VALUES (41, '', '', '2016-06-26', '18:00', 7);
INSERT INTO `matcher` VALUES (42, '', '', '2016-06-26', '21:00', 8);
INSERT INTO `matcher` VALUES (43, '', '', '2016-06-27', '18:00', 1);
INSERT INTO `matcher` VALUES (44, '', '', '2016-06-27', '21:00', 6);
INSERT INTO `matcher` VALUES (45, '', '', '2016-06-30', '21:00', 4);
INSERT INTO `matcher` VALUES (46, '', '', '2016-07-01', '21:00', 7);
INSERT INTO `matcher` VALUES (47, '', '', '2016-07-02', '21:00', 3);
INSERT INTO `matcher` VALUES (48, '', '', '2016-07-03', '21:00', 1);
INSERT INTO `matcher` VALUES (49, '', '', '2016-07-06', '21:00', 10);
INSERT INTO `matcher` VALUES (50, '', '', '2016-07-07', '21:00', 4);
INSERT INTO `matcher` VALUES (51, '', '', '2016-07-10', '21:00', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `tippning`
-- 

CREATE TABLE `tippning` (
  `id` int(11) NOT NULL,
  `m1` varchar(2) default NULL,
  `m2` varchar(2) default NULL,
  `m3` varchar(2) default NULL,
  `m4` varchar(2) default NULL,
  `m5` varchar(2) default NULL,
  `m6` varchar(2) default NULL,
  `m7` varchar(2) default NULL,
  `m8` varchar(2) default NULL,
  `m9` varchar(2) default NULL,
  `m10` varchar(2) default NULL,
  `m11` varchar(2) default NULL,
  `m12` varchar(2) default NULL,
  `m13` varchar(2) default NULL,
  `m14` varchar(2) default NULL,
  `m15` varchar(2) default NULL,
  `m16` varchar(2) default NULL,
  `m17` varchar(2) default NULL,
  `m18` varchar(2) default NULL,
  `m19` varchar(2) default NULL,
  `m20` varchar(2) default NULL,
  `m21` varchar(2) default NULL,
  `m22` varchar(2) default NULL,
  `m23` varchar(2) default NULL,
  `m24` varchar(2) default NULL,
  `m25` varchar(2) default NULL,
  `m26` varchar(2) default NULL,
  `m27` varchar(2) default NULL,
  `m28` varchar(2) default NULL,
  `m29` varchar(2) default NULL,
  `m30` varchar(2) default NULL,
  `m31` varchar(2) default NULL,
  `m32` varchar(2) default NULL,
  `m33` varchar(2) default NULL,
  `m34` varchar(2) default NULL,
  `m35` varchar(2) default NULL,
  `m36` varchar(2) default NULL,
  `m37` varchar(2) default NULL,
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
  `swedishGoals` int(11) NOT NULL,
  `topScorer` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- 
-- Table structure for table `tippwinner`
-- 

CREATE TABLE `tippwinner` (
  `id` int(11) NOT NULL,
  `year` varchar(45) default NULL,
  `givenName` varchar(45) default NULL,
  `familyName` varchar(45) default NULL,
  `cash` varchar(45) default NULL,
  `pic` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `tippwinner`
-- 

INSERT INTO `tippwinner` VALUES (1, '2010', 'Martin', 'Sundström', '10', '');
INSERT INTO `tippwinner` VALUES (2, '2012', 'Martin', 'Sundström', '10', '');
INSERT INTO `tippwinner` VALUES (3, '2014', '', '', '0', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `givenName` varchar(45) default NULL,
  `familyName` varchar(45) default NULL,
  `street` varchar(45) default NULL,
  `city` varchar(45) default NULL,
  `phoneNumber` varchar(45) default NULL,
  `Company` varchar(45) default NULL,
  `emailAddress` varchar(45) default NULL,
  `username` varchar(45) default NULL,
  `password` varchar(45) default NULL,
  `foto` varchar(45) default NULL,
  `betalt` varchar(45) default NULL,
  `admin` int(11) default NULL,
  `points` int(11) default NULL,
  `nbrOfLogins` int(11) default 0,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

-- The correct row has id -1
INSERT INTO `tippning`.`users` (`id`) VALUES (-1);
INSERT INTO `tippning` (`id`) VALUES (-1);
-- --------------------------------------------------------

-- 
-- Table structure for table `arena`
-- 

CREATE TABLE `arena` (
  `id` int(11) NOT NULL,
  `arena` varchar(45) default NULL,
  `location` varchar(45) default NULL,
  `capacity` varchar(45) default NULL,
  `buildyear` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `arena`
-- 

INSERT INTO `arena` VALUES (1, 'Stade de France', 'Saint-Denis', '76935', '1900');
INSERT INTO `arena` VALUES (2, 'Stade Bollaert-Delelis', 'Lens', '70042', '1900');
INSERT INTO `arena` VALUES (3, 'Stade de Bordeaux','Bordeaux', '68000', '1900');
INSERT INTO `arena` VALUES (4, 'Stade Vélodrome','Marseille', '100', '1900');
INSERT INTO `arena` VALUES (5, 'Parc des Princes', 'Paris', '63547', '1900');
INSERT INTO `arena` VALUES (6, 'Stade de Nice', 'Nice', '51300', '1900');
INSERT INTO `arena` VALUES (7, 'Stade Pierre Mauroy','Lille', '56000', '1900');
INSERT INTO `arena` VALUES (8, 'Stadium de Toulouse','Toulouse', '46154', '1900');
INSERT INTO `arena` VALUES (9, 'Stade Geoffroy Guichard', 'St-Etienne', '42968', '1900');
INSERT INTO `arena` VALUES (10,'Stade de Lyon','Lyon', '42374', '1900');


-- 
-- Table structure for table `vmwinner`
-- 

CREATE TABLE `vmwinner` (
  `id` int(11) NOT NULL,
  `year` varchar(45) default NULL,
  `winner_swe` varchar(45) default NULL,
  `winner_eng` varchar(45) default NULL,
  `flagpic` varchar(45) default NULL,
  `host` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `vmwinner`
-- 

INSERT INTO `vmwinner` VALUES (1, '1930', 'Uruguay', 'Uruguay', 'uru.png', 'Uruguay');
INSERT INTO `vmwinner` VALUES (2, '1934', 'Italien', 'Italy', 'ita.png', 'Italien');
INSERT INTO `vmwinner` VALUES (3, '1938', 'Italien', 'Italy', 'ita.png', 'Frankrike');
INSERT INTO `vmwinner` VALUES (4, '1942', '-', '-', '-', 'Andra världskriget VM spelades inte');
INSERT INTO `vmwinner` VALUES (5, '1950', 'Uruguay', 'Uruguay', 'uru.png', 'Brasilien');
INSERT INTO `vmwinner` VALUES (6, '1954', 'Västtyskland', 'West-Germany', 'west_ger.png', 'Schweiz');
INSERT INTO `vmwinner` VALUES (7, '1958', 'Brasilien', 'Brazil', 'bra.png', 'Sverige');
INSERT INTO `vmwinner` VALUES (8, '1962', 'Brasilien', 'Brazil', 'bra.png', 'Chile');
INSERT INTO `vmwinner` VALUES (9, '1966', 'England', 'England', 'eng.png', 'England');
INSERT INTO `vmwinner` VALUES (10, '1970', 'Brasilien', 'Brazil', 'bra.png', 'Mexiko');
INSERT INTO `vmwinner` VALUES (11, '1974', 'Västtyskland', 'West-Germany', 'west_ger.png', 'Västtyskland');
INSERT INTO `vmwinner` VALUES (12, '1978', 'Argentina', 'Argentina', 'arg.png', 'Argentina');
INSERT INTO `vmwinner` VALUES (13, '1982', 'Italien', 'Italy', 'ita.png', 'Spanien');
INSERT INTO `vmwinner` VALUES (14, '1986', 'Argentina', 'Argentina', 'arg.png', 'Mexiko');
INSERT INTO `vmwinner` VALUES (15, '1990', 'Västtyskland', 'West-Germany', 'west_ger.png', 'Italien');
INSERT INTO `vmwinner` VALUES (16, '1994', 'Brasilien', 'Brazil', 'bra.png', 'USA');
INSERT INTO `vmwinner` VALUES (17, '1998', 'Frankrike', 'France', 'fra.png', 'Frankrike');
INSERT INTO `vmwinner` VALUES (18, '2002', 'Brasilien', 'Brazil', 'bra.png', 'Sydkorea & Japan');
INSERT INTO `vmwinner` VALUES (19, '2006', 'Italien', 'Italy', 'ita.png', 'Tyskland');
INSERT INTO `vmwinner` VALUES (20, '2010', 'Spanien', 'Spain', 'spa.png', 'Sydafrika');
INSERT INTO `vmwinner` VALUES (21, '2014', '-', '', '', 'Brasilien');
