-- phpMyAdmin SQL Dump
-- version 2.9.2-Debian-1.one.com1
-- http://www.phpmyadmin.net
-- 
-- Host: MySQL Server
-- Generation Time: May 04, 2011 at 05:01 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.0-8+etch16
-- 
-- Database: `thoka_se`
-- 
CREATE DATABASE `thoka_se` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `thoka_se`;

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
INSERT INTO `classification` VALUES (7, '1', 'Grupp G');
INSERT INTO `classification` VALUES (8, '1', 'Grupp H');
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
INSERT INTO `emwinner` VALUES (2, '1964', 'Spanien', 'Spain', 'esp.gif', 'Spanien');
INSERT INTO `emwinner` VALUES (3, '1968', 'Italien', 'Italy', 'ita.gif', 'Italien');
INSERT INTO `emwinner` VALUES (4, '1972', 'Västtyskland', 'West-Germany', 'west_ger.gif', 'Belgien');
INSERT INTO `emwinner` VALUES (5, '1976', 'Tjeckoslovakien', 'Czechoslovakia', 'cze_svk.gif', 'Jugoslavien');
INSERT INTO `emwinner` VALUES (6, '1980', 'Västtyskland', 'West-Germany', 'west_ger.gif', 'Italien');
INSERT INTO `emwinner` VALUES (7, '1984', 'Frankrike', 'France', 'fra.gif', 'Frankrike');
INSERT INTO `emwinner` VALUES (8, '1988', 'Nederländerna', 'Netherlands', 'ned.gif', 'Västtyskland');
INSERT INTO `emwinner` VALUES (9, '1992', 'Danmark', 'Denmark', 'den.gif', 'Sverige');
INSERT INTO `emwinner` VALUES (10, '1996', 'Tyskland', 'Germany', 'ger.gif', 'England');
INSERT INTO `emwinner` VALUES (11, '2000', 'Frankrike', 'France', 'fra.gif', 'Belgien & Nederländerna');
INSERT INTO `emwinner` VALUES (12, '2004', 'Grekland', 'Greece', 'gre.gif', 'Portugal');
INSERT INTO `emwinner` VALUES (13, '2008', 'Spanien', 'Spain', 'esp.gif', 'Schweiz & Österrike');
INSERT INTO `emwinner` VALUES (14, '2012', '-', '', '', 'Polen & Ukraina');

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
INSERT INTO `groups` VALUES (6, 'F');
INSERT INTO `groups` VALUES (7, 'G');
INSERT INTO `groups` VALUES (8, 'H');

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

INSERT INTO `lag` VALUES (1, 'A1', 'Sydafrika', 'South Africa', 'RSA', 'rsa.gif');
INSERT INTO `lag` VALUES (2, 'A2', 'Mexiko', 'Mexico', 'MEX', 'mex.gif');
INSERT INTO `lag` VALUES (3, 'A3', 'Uruguay', 'Uruguay', 'URU', 'uru.gif');
INSERT INTO `lag` VALUES (4, 'A4', 'Frankrike', 'France', 'FRA', 'fra.gif');
INSERT INTO `lag` VALUES (5, 'B1', 'Argentina', 'Argentina', 'ARG', 'arg.gif');
INSERT INTO `lag` VALUES (6, 'B2', 'Nigeria', 'Nigeria', 'NGA', 'nga.gif');
INSERT INTO `lag` VALUES (7, 'B3', 'Sydkorea', 'Korea Republic', 'KOR', 'kor.gif');
INSERT INTO `lag` VALUES (8, 'B4', 'Grekland', 'Greece', 'GRE', 'gre.gif');
INSERT INTO `lag` VALUES (9, 'C1', 'England', 'England', 'ENG', 'eng.gif');
INSERT INTO `lag` VALUES (10, 'C2', 'USA', 'USA', 'USA', 'usa.gif');
INSERT INTO `lag` VALUES (11, 'C3', 'Algeriet', 'Algeria', 'ALG', 'alg.gif');
INSERT INTO `lag` VALUES (12, 'C4', 'Slovenien', 'Slovenia', 'SVN', 'svn.gif');
INSERT INTO `lag` VALUES (13, 'D1', 'Tyskland', 'Germany', 'GER', 'ger.gif');
INSERT INTO `lag` VALUES (14, 'D2', 'Australien', 'Australia', 'AUS', 'aus.gif');
INSERT INTO `lag` VALUES (15, 'D3', 'Serbien', 'Serbia', 'SRB', 'srb.gif');
INSERT INTO `lag` VALUES (16, 'D4', 'Ghana', 'Ghana', 'GHA', 'gha.gif');
INSERT INTO `lag` VALUES (17, 'E1', 'Nederländerna', 'Netherlands', 'NED', 'ned.gif');
INSERT INTO `lag` VALUES (18, 'E2', 'Danmark', 'Denmark', 'DEN', 'den.gif');
INSERT INTO `lag` VALUES (19, 'E3', 'Japan', 'Japan', 'JPN', 'jpn.gif');
INSERT INTO `lag` VALUES (20, 'E4', 'Kamerun', 'Cameroon', 'CMR', 'cmr.gif');
INSERT INTO `lag` VALUES (21, 'F1', 'Italien', 'Italy', 'ITA', 'ita.gif');
INSERT INTO `lag` VALUES (22, 'F2', 'Paraguay', 'Paraguay', 'PAR', 'par.gif');
INSERT INTO `lag` VALUES (23, 'F3', 'Nya Zeeland', 'New Zealand', 'NZL', 'nzl.gif');
INSERT INTO `lag` VALUES (24, 'F4', 'Slovakien', 'Slovakia', 'SVK', 'svk.gif');
INSERT INTO `lag` VALUES (25, 'G1', 'Brasilien', 'Brazil', 'BRA', 'bra.gif');
INSERT INTO `lag` VALUES (26, 'G2', 'Nordkorea', 'Korea DPR', 'PRK', 'prk.gif');
INSERT INTO `lag` VALUES (27, 'G3', 'Elfenbenskusten', 'Côte d\\''Ivoire', 'CIV', 'civ.gif');
INSERT INTO `lag` VALUES (28, 'G4', 'Portugal', 'Portugal', 'POR', 'por.gif');
INSERT INTO `lag` VALUES (29, 'H1', 'Spanien', 'Spain', 'SPA', 'spa.gif');
INSERT INTO `lag` VALUES (30, 'H2', 'Schweiz', 'Switzerland', 'SCH', 'sch.gif');
INSERT INTO `lag` VALUES (31, 'H3', 'Honduras', 'Honduras', 'HON', 'hon.gif');
INSERT INTO `lag` VALUES (32, 'H4', 'Chile', 'Chile', 'CHI', 'chi.gif');

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

INSERT INTO `matcher` VALUES (1, 'A1', 'A2', '2010-06-11', '16:00', 1);
INSERT INTO `matcher` VALUES (2, 'A3', 'A4', '2010-06-11', '20:30', 2);
INSERT INTO `matcher` VALUES (17, 'A1', 'A3', '2010-06-16', '20:30', 5);
INSERT INTO `matcher` VALUES (18, 'A4', 'A2', '2010-06-17', '20:30', 9);
INSERT INTO `matcher` VALUES (33, 'A2', 'A3', '2010-06-22', '16:00', 10);
INSERT INTO `matcher` VALUES (34, 'A4', 'A1', '2010-06-22', '16:00', 7);
INSERT INTO `matcher` VALUES (3, 'B1', 'B2', '2010-06-12', '16:00', 4);
INSERT INTO `matcher` VALUES (4, 'B3', 'B4', '2010-06-12', '13:30', 6);
INSERT INTO `matcher` VALUES (19, 'B4', 'B2', '2010-06-17', '16:00', 7);
INSERT INTO `matcher` VALUES (20, 'B1', 'B3', '2010-06-17', '13:30', 1);
INSERT INTO `matcher` VALUES (35, 'B2', 'B3', '2010-06-22', '20:30', 3);
INSERT INTO `matcher` VALUES (36, 'B4', 'B1', '2010-06-22', '20:30', 9);
INSERT INTO `matcher` VALUES (5, 'C1', 'C2', '2010-06-12', '20:30', 10);
INSERT INTO `matcher` VALUES (6, 'C3', 'C4', '2010-06-13', '13:30', 9);
INSERT INTO `matcher` VALUES (22, 'C4', 'C2', '2010-06-18', '16:00', 4);
INSERT INTO `matcher` VALUES (23, 'C1', 'C3', '2010-06-18', '20:30', 2);
INSERT INTO `matcher` VALUES (37, 'C4', 'C1', '2010-06-23', '16:00', 6);
INSERT INTO `matcher` VALUES (38, 'C2', 'C3', '2010-06-23', '16:00', 5);
INSERT INTO `matcher` VALUES (7, 'D1', 'D2', '2010-06-13', '20:30', 3);
INSERT INTO `matcher` VALUES (8, 'D3', 'D4', '2010-06-13', '16:00', 5);
INSERT INTO `matcher` VALUES (21, 'D1', 'D3', '2010-06-18', '13:30', 6);
INSERT INTO `matcher` VALUES (24, 'D4', 'D2', '2010-06-19', '16:00', 10);
INSERT INTO `matcher` VALUES (39, 'D4', 'D1', '2010-06-23', '20:30', 1);
INSERT INTO `matcher` VALUES (40, 'D2', 'D3', '2010-06-23', '20:30', 8);
INSERT INTO `matcher` VALUES (9, 'E1', 'E2', '2010-06-14', '13:30', 1);
INSERT INTO `matcher` VALUES (10, 'E3', 'E4', '2010-06-14', '16:00', 7);
INSERT INTO `matcher` VALUES (25, 'E1', 'E3', '2010-06-19', '13:30', 3);
INSERT INTO `matcher` VALUES (26, 'E4', 'E2', '2010-06-19', '20:30', 5);
INSERT INTO `matcher` VALUES (43, 'E2', 'E3', '2010-06-24', '20:30', 10);
INSERT INTO `matcher` VALUES (44, 'E4', 'E1', '2010-06-24', '20:30', 2);
INSERT INTO `matcher` VALUES (11, 'F1', 'F2', '2010-06-14', '20:30', 2);
INSERT INTO `matcher` VALUES (12, 'F3', 'F4', '2010-06-15', '13:30', 10);
INSERT INTO `matcher` VALUES (27, 'F4', 'F2', '2010-06-20', '13:30', 7);
INSERT INTO `matcher` VALUES (28, 'F1', 'F3', '2010-06-20', '16:00', 8);
INSERT INTO `matcher` VALUES (41, 'F4', 'F1', '2010-06-24', '16:00', 4);
INSERT INTO `matcher` VALUES (42, 'F2', 'F3', '2010-06-24', '16:00', 9);
INSERT INTO `matcher` VALUES (13, 'G3', 'G4', '2010-06-15', '16:00', 6);
INSERT INTO `matcher` VALUES (14, 'G1', 'G2', '2010-06-15', '20:30', 4);
INSERT INTO `matcher` VALUES (29, 'G1', 'G3', '2010-06-20', '20:30', 1);
INSERT INTO `matcher` VALUES (30, 'G4', 'G2', '2010-06-21', '13:30', 2);
INSERT INTO `matcher` VALUES (45, 'G4', 'G1', '2010-06-25', '16:00', 3);
INSERT INTO `matcher` VALUES (46, 'G2', 'G3', '2010-06-25', '16:00', 8);
INSERT INTO `matcher` VALUES (15, 'H3', 'H4', '2010-06-16', '13:30', 8);
INSERT INTO `matcher` VALUES (16, 'H1', 'H2', '2010-06-16', '16:00', 3);
INSERT INTO `matcher` VALUES (31, 'H4', 'H2', '2010-06-21', '16:00', 6);
INSERT INTO `matcher` VALUES (32, 'H1', 'H3', '2010-06-21', '20:30', 4);
INSERT INTO `matcher` VALUES (47, 'H4', 'H1', '2010-06-25', '20:30', 5);
INSERT INTO `matcher` VALUES (48, 'H2', 'H3', '2010-06-25', '20:30', 7);
INSERT INTO `matcher` VALUES (49, 'A3', 'B3', '2010-06-26', '16:00', 6);
INSERT INTO `matcher` VALUES (50, 'C2', 'D4', '2010-06-26', '20:30', 10);
INSERT INTO `matcher` VALUES (51, 'E1', 'F4', '2010-06-27', '16:00', 7);
INSERT INTO `matcher` VALUES (52, 'G1', 'H4', '2010-06-27', '20:30', 1);
INSERT INTO `matcher` VALUES (53, 'B1', 'A2', '2010-06-28', '16:00', 3);
INSERT INTO `matcher` VALUES (54, 'D1', 'C1', '2010-06-28', '20:30', 1);
INSERT INTO `matcher` VALUES (55, 'F2', 'E3', '2010-06-29', '16:00', 5);
INSERT INTO `matcher` VALUES (56, 'H1', 'G4', '2010-06-29', '20:30', 2);
INSERT INTO `matcher` VALUES (57, 'A3', 'D4', '2011-07-02', '16:00', 6);
INSERT INTO `matcher` VALUES (58, 'E1', 'G1', '2011-07-02', '20:30', 1);
INSERT INTO `matcher` VALUES (59, 'B1', 'D1', '2011-07-03', '16:00', 2);
INSERT INTO `matcher` VALUES (60, 'F2', 'H1', '2011-07-03', '20:30', 1);
INSERT INTO `matcher` VALUES (61, 'A3', 'E1', '2011-07-06', '20:30', 2);
INSERT INTO `matcher` VALUES (62, 'D1', 'H1', '2011-07-07', '20:30', 3);
INSERT INTO `matcher` VALUES (63, 'A3', 'D1', '2011-07-10', '20:30', 6);
INSERT INTO `matcher` VALUES (64, 'E1', 'H1', '2011-06-11', '20:30', 1);

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
  `m38` varchar(2) default NULL,
  `m39` varchar(2) default NULL,
  `m40` varchar(2) default NULL,
  `m41` varchar(2) default NULL,
  `m42` varchar(2) default NULL,
  `m43` varchar(2) default NULL,
  `m44` varchar(2) default NULL,
  `m45` varchar(2) default NULL,
  `m46` varchar(2) default NULL,
  `m47` varchar(2) default NULL,
  `m48` varchar(2) default NULL,
  `m49` varchar(2) default NULL,
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
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `tippning`
-- 

INSERT INTO `tippning` VALUES (9, '2', '2', '1', '2', '1', 'X', '1', '1', '1', 'X', '1', '2', '2', '1', '2', '1', '2', '1', '1', '1', '1', '2', '1', 'X', '1', '2', '2', '1', '1', '1', '1', '1', 'X', '1', 'X', '2', '2', '1', '2', '1', '2', '1', '1', '2', 'X', '1', '2', 'X', '1', 'A4', 'B4', '1', 'C1', 'D2', '1', 'E1', 'F2', '2', 'G1', 'H4', '1', 'B1', 'A2', '1', 'D1', 'C2', '1', 'F1', 'E2', '1', 'H1', 'G4', '1', 'A4', 'C1', '2', 'E1', 'H4', '2', 'B1', 'D1', '2', 'F1', 'H1', '2', 'A4', 'H4', '1', 'D1', 'H1', '2', 'A4', 'B1', '2', 'H4', 'D1');
INSERT INTO `tippning` VALUES (-1, 'X', 'X', '1', '1', 'X', '2', '1', '2', '1', '1', 'X', 'X', 'X', '1', '2', '2', '2', '2', '1', '1', '2', 'X', 'X', 'X', '1', '2', '2', 'x', '1', '1', '1', '1', '2', '2', 'X', '2', '2', '1', '2', '1', '1', 'X', '2', '2', 'X', '2', '2', 'X', '1', 'A3', 'B3', '2', 'C2', 'D4', '1', 'E1', 'F4', '1', 'G1', 'H4', '1', 'B1', 'A2', '1', 'D1', 'C1', '1', 'F2', 'E3', '1', 'H1', 'G4', '1', 'A3', 'D4', '1', 'E1', 'G1', '2', 'B1', 'D1', '2', 'F2', 'H1', '2', 'A3', 'E1', '2', 'D1', 'H1', '2', 'A3', 'D1', '2', 'E1', 'H1');
INSERT INTO `tippning` VALUES (4, 'X', '2', '1', 'X', '1', '2', '1', '1', '1', 'X', '1', 'X', '2', '1', '2', '1', 'X', 'X', 'X', '1', '1', '2', '1', '2', '1', '2', '2', '1', '1', '1', '2', '1', '1', '1', '1', '2', '2', '1', '2', '1', '2', '1', '1', '2', '2', '2', '2', '1', '1', 'A4', 'B2', '1', 'C1', 'D3', '1', 'E1', 'F2', '1', 'G1', 'H2', '1', 'B1', 'A2', '1', 'D1', 'C2', '2', 'F1', 'E2', '1', 'H1', 'G4', '2', 'A4', 'C1', '1', 'E1', 'G1', '1', 'B1', 'D1', '2', 'E2', 'H1', '2', 'C1', 'E1', '1', 'B1', 'H1', '1', 'C1', 'H1', '2', 'E1', 'B1');
INSERT INTO `tippning` VALUES (12, 'X', '2', '1', '1', '1', 'X', '1', 'X', 'X', '2', '1', '2', '2', '1', '2', '1', '2', '1', '2', '1', '1', '1', '1', '2', '1', '2', 'X', '1', '1', '1', 'X', '1', '2', '1', 'X', '2', '2', 'X', '2', '1', '2', 'X', '1', '2', '2', 'X', '2', '1', '1', 'A4', 'B2', '2', 'C1', 'D2', '1', 'E1', 'F4', '1', 'G1', 'H4', '1', 'B1', 'A3', '1', 'D1', 'C4', '1', 'F1', 'E2', '2', 'H1', 'G4', '1', 'A4', 'C1', '2', 'E1', 'G1', '1', 'A3', 'D1', '2', 'F1', 'H1', '1', 'C1', 'H1', '2', 'A4', 'G1', '2', 'H1', 'A4', '1', 'G1', 'G1');
INSERT INTO `tippning` VALUES (16, '1', '2', '1', '1', '1', 'X', '1', 'X', '1', '2', '1', '2', '1', '1', 'X', '1', '1', '1', 'X', '1', '1', '2', '1', '1', '1', 'X', 'X', '1', 'X', '1', 'X', '1', '2', '1', 'X', '2', '2', '1', '2', 'X', '2', '1', '1', '2', 'X', '2', '2', '1', '1', 'A1', 'B3', '1', 'C1', 'D4', '1', 'E1', 'F2', '1', 'G3', 'H2', '1', 'B1', 'A4', '1', 'D1', 'C2', '1', 'F1', 'E4', '1', 'H1', 'G1', '2', 'A1', 'C1', '2', 'E1', 'G3', '1', 'B1', 'D1', '2', 'F1', 'H1', '1', 'C1', 'G3', '1', 'B1', 'H1', '2', 'G3', 'H1', '1', 'C1', 'B1');
INSERT INTO `tippning` VALUES (19, 'X', '2', '1', 'X', '1', '2', '1', '1', '2', 'X', '1', '2', '2', '1', '1', '1', '2', 'X', 'X', '1', '1', 'X', '1', 'X', 'X', '2', '2', '1', '1', '1', '1', '2', '1', 'X', '1', '2', 'X', 'X', '2', '1', '2', 'X', '1', '2', 'X', '2', 'X', '1', '1', 'A4', 'B2', '1', 'C1', 'D3', '2', 'E2', 'F1', '1', 'G1', 'H4', '1', 'B1', 'A2', '1', 'D1', 'C2', '1', 'F1', 'E1', '1', 'H1', 'G4', '2', 'A4', 'D1', '2', 'F1', 'G1', '2', 'B2', 'D3', '2', 'F2', 'G4', '1', 'D1', 'F1', '2', 'B1', 'G1', '1', 'F1', 'B1', '1', 'D1', 'G1');
INSERT INTO `tippning` VALUES (18, '2', '2', '1', '1', '1', 'X', '1', '1', '1', '2', '1', '2', '2', '1', '2', '1', '2', '1', 'X', 'X', '1', '2', '1', '1', '1', '1', '2', '1', '1', '1', 'X', '1', '1', '1', '2', '2', '2', '1', '1', '2', '2', '1', 'X', '2', '1', '2', '2', '1', '1', 'A4', 'B3', '1', 'C1', 'D3', '1', 'E1', 'F2', '1', 'G1', 'H2', '1', 'B1', 'A2', '1', 'D1', 'C2', '1', 'F1', 'E4', '2', 'H1', 'G4', '2', 'A4', 'C1', '2', 'E1', 'G1', '2', 'B1', 'D1', '2', 'F1', 'G4', '1', 'C1', 'G1', '1', 'D1', 'G4', '2', 'G1', 'G4', '1', 'C1', 'D1');
INSERT INTO `tippning` VALUES (17, 'X', '2', '1', 'X', 'X', 'X', '1', '2', 'X', '2', '1', 'X', '1', '1', '2', '1', '1', '2', '2', '1', 'X', '2', '1', '1', '1', '1', '2', '1', '1', 'X', '2', 'X', 'X', '1', 'X', '2', '2', '1', '2', '2', 'X', '1', '1', 'X', '2', '2', '2', '1', '1', 'A4', 'B2', '2', 'C2', 'D1', '1', 'E4', 'F2', '1', 'G1', 'H2', '1', 'B1', 'A2', '2', 'D4', 'C1', '2', 'F1', 'E1', '1', 'H1', 'G3', '2', 'A4', 'D1', '2', 'E4', 'G1', '1', 'B1', 'C1', '1', 'E1', 'H1', '1', 'D1', 'G1', '1', 'B1', 'E1', '2', 'G1', 'E1', '2', 'D1', 'B1');
INSERT INTO `tippning` VALUES (23, '2', '2', '1', '2', '1', '2', '1', '1', '1', '1', '1', '2', '1', '1', '2', '1', 'X', '1', 'X', '1', '2', 'X', '1', 'X', '1', '2', '1', '1', '1', '1', '2', '1', '1', '1', 'X', '2', '2', '1', '2', '2', '2', '1', '1', '2', '2', '2', '2', '1', '1', 'A4', 'B4', '1', 'C1', 'D1', '1', 'E1', 'F4', '1', 'G1', 'H2', '1', 'B1', 'A2', '1', 'D3', 'C4', '1', 'F1', 'E2', '1', 'H1', 'G3', '2', 'A4', 'C1', '2', 'E1', 'G1', '2', 'B1', 'D3', '2', 'F1', 'H1', '2', 'C1', 'G1', '2', 'D3', 'H1', '1', 'C1', 'D3', '1', 'G1', 'H1');
INSERT INTO `tippning` VALUES (20, 'X', '2', '1', 'X', '1', '2', '1', 'X', 'X', 'X', 'X', '2', '2', '1', '2', '1', '1', 'X', '2', '1', '1', '2', '1', '1', '1', '2', '2', '1', '1', '1', 'X', '1', '1', 'X', 'X', '2', '2', '1', '2', '2', '2', '1', '1', '2', 'X', '2', '2', '1', '1', 'A4', 'B2', '1', 'C1', 'D3', '1', 'E1', 'F2', '1', 'G1', 'H2', '1', 'B1', 'A4', '1', 'D1', 'C1', '1', 'F1', 'E2', '1', 'H1', 'G4', '2', 'A4', 'C1', '2', 'E1', 'G1', '2', 'B1', 'D1', '1', 'E2', 'H1', '1', 'C1', 'G1', '2', 'B1', 'H1', '1', 'C1', 'B1', '2', 'C1', 'H1');
INSERT INTO `tippning` VALUES (29, '1', '2', '1', '2', '1', '2', '1', '1', '1', 'X', '1', 'X', '2', '1', 'X', '1', '2', '1', 'X', '1', '1', 'X', '1', 'X', '1', '2', 'X', '1', '1', '1', '2', '1', '2', '1', '1', '2', '2', '1', '2', '2', '2', '1', '1', '2', '2', '1', '2', '1', '1', 'A4', 'B2', '1', 'C1', 'D3', '1', 'E1', 'F2', '1', 'G1', 'H2', '1', 'B1', 'A3', '1', 'D1', 'C2', '1', 'F1', 'E2', '1', 'H1', 'G4', '2', 'A4', 'C1', '2', 'E1', 'G1', '2', 'B1', 'D1', '2', 'F1', 'H1', '2', 'C1', 'G1', '2', 'D1', 'H1', '1', 'C1', 'D1', '1', 'G1', 'H1');
INSERT INTO `tippning` VALUES (31, 'X', '2', '1', '2', 'X', 'X', '1', '1', 'X', '1', '1', '2', '2', '1', 'X', '1', '1', 'X', '1', '1', '1', '2', '1', 'X', '1', '2', '1', '1', '1', '1', '2', '1', '1', '1', 'X', '2', '2', '1', '2', 'X', '2', 'X', '1', '2', '2', '2', '2', '1', '2', 'A4', 'B4', '1', 'C1', 'D3', '1', 'E1', 'F4', '1', 'G1', 'H2', '1', 'B1', 'A2', '1', 'D1', 'C2', '1', 'F1', 'E2', '1', 'H1', 'G4', '2', 'B4', 'C1', '2', 'E1', 'G1', '2', 'B1', 'D1', '2', 'F1', 'H1', '2', 'C1', 'G1', '1', 'D1', 'H1', '2', 'C1', 'H1', '2', 'G1', 'D1');
INSERT INTO `tippning` VALUES (32, 'X', '2', '1', '1', 'X', '2', '1', '1', '1', '2', '1', '2', '1', '1', '2', '1', '1', 'X', 'X', '1', 'X', 'X', '1', '2', '1', 'X', '1', '1', '1', '1', 'X', '1', '1', 'X', '1', '2', 'X', '1', '2', 'X', 'X', '1', '1', '2', '2', '2', '2', '1', '2', 'A4', 'B2', '1', 'C1', 'D3', '1', 'E1', 'F4', '1', 'G1', 'H2', '1', 'B1', 'A1', '1', 'D1', 'C4', '1', 'F1', 'E4', '1', 'H1', 'G3', '2', 'B2', 'C1', '2', 'E1', 'G1', '1', 'B1', 'D1', '2', 'F1', 'H1', '2', 'C1', 'G1', '1', 'B1', 'H1', '2', 'C1', 'H1', '1', 'B1', 'G1');
INSERT INTO `tippning` VALUES (13, 'X', '2', '1', '2', '1', '2', '1', '1', 'X', 'X', '1', 'X', '2', '1', '2', '1', '2', '1', 'X', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 'X', '1', '2', '1', 'X', '2', 'X', '1', '2', '2', '2', '1', '1', '2', 'X', '2', '2', 'X', '1', 'A4', 'B4', '1', 'C1', 'D3', '1', 'E1', 'F4', '1', 'G1', 'H4', '1', 'B1', 'A1', '1', 'D1', 'C4', '1', 'F1', 'E2', '1', 'H1', 'G1', '1', 'A4', 'C1', '2', 'E1', 'G1', '2', 'B1', 'D1', '2', 'F1', 'H1', '2', 'A4', 'G1', '2', 'D1', 'H1', '2', 'A4', 'D1', '2', 'G1', 'H1');
INSERT INTO `tippning` VALUES (30, 'X', '2', '1', '1', 'X', '1', '1', '1', '1', '2', '1', 'X', '1', '1', '2', '1', '1', '2', '2', '1', '1', '2', '1', '1', '1', '1', '2', '1', 'X', '1', '2', '1', '1', '1', 'X', '2', '2', '1', '2', '2', '2', '1', 'X', '2', '2', '2', '2', '1', '1', 'A2', 'B2', '1', 'C1', 'D3', '1', 'E1', 'F2', '1', 'G1', 'H2', '1', 'B1', 'A4', '1', 'D1', 'C2', '2', 'F1', 'E4', '1', 'H1', 'G3', '1', 'A2', 'C1', '1', 'E1', 'G1', '2', 'B1', 'D1', '2', 'E4', 'H1', '2', 'A2', 'E1', '2', 'D1', 'H1', '2', 'A2', 'D1', '2', 'E1', 'H1');
INSERT INTO `tippning` VALUES (25, '1', 'X', '2', 'X', '1', '2', '1', '2', 'X', '2', '1', '2', 'X', '1', '1', '1', '1', '1', '2', '1', '1', 'X', 'X', '1', '1', '1', 'X', '1', 'X', '1', 'X', '1', '1', 'X', 'X', 'X', '2', 'X', 'X', 'X', '2', '1', '1', 'X', '2', '2', '2', '2', '1', 'A1', 'B4', '1', 'C1', 'D4', '1', 'E4', 'F4', '1', 'G1', 'H4', '1', 'B2', 'A4', '1', 'D1', 'C4', '2', 'F1', 'E1', '1', 'H1', 'G3', '1', 'A1', 'C1', '2', 'E4', 'G1', '2', 'A4', 'D1', '1', 'E1', 'H1', '2', 'C1', 'G1', '2', 'B2', 'H1', '1', 'B2', 'C1', '2', 'G1', 'H1');
INSERT INTO `tippning` VALUES (33, '1', '2', '1', 'X', 'X', '1', 'X', 'X', '2', '2', '1', '1', '1', '1', '2', '1', 'X', '1', 'X', 'X', '1', 'X', '1', '2', '2', 'X', '2', '1', '1', '2', 'X', '1', 'X', 'X', 'X', '1', '2', '1', '2', '1', '2', 'X', '1', '1', '2', '2', '2', '1', '1', 'A4', 'B1', '2', 'C1', 'D1', '1', 'E2', 'F1', '2', 'G1', 'H1', '2', 'B1', 'A4', '1', 'D1', 'C1', '2', 'F1', 'E2', '1', 'H1', 'G1', '1', 'A4', 'D1', '1', 'F1', 'G2', '2', 'A4', 'D1', '2', 'E4', 'G1', '1', 'A4', 'E2', '2', 'C1', 'G1', '2', 'D1', 'D2', '2', 'D2', 'E2');
INSERT INTO `tippning` VALUES (2, '2', 'X', '1', '2', '1', '2', '1', '1', '1', '2', '1', '2', '2', '1', '2', '1', '1', '1', '2', '1', '1', '2', '1', 'X', '1', 'X', '1', '1', '1', '1', 'X', '1', '1', '1', 'X', '2', 'X', '1', '2', '2', '2', '1', '1', '2', '1', '2', '2', '1', '2', 'A2', 'B4', '1', 'C1', 'D3', '1', 'E1', 'F2', '1', 'G1', 'H2', '2', 'B1', 'A4', '1', 'D1', 'C4', '1', 'F1', 'E2', '2', 'H1', 'G4', '2', 'B4', 'C1', '1', 'E1', 'G1', '2', 'A4', 'D1', '2', 'F1', 'G4', '2', 'C1', 'E1', '1', 'D1', 'G4', '2', 'C1', 'G4', '1', 'E1', 'D1');
INSERT INTO `tippning` VALUES (34, '2', 'X', 'X', 'X', 'X', '2', '1', 'X', '1', '2', '1', '2', 'X', '1', '1', '1', '1', '1', '2', '1', 'X', 'X', '1', '1', '1', 'X', '1', '1', 'X', '1', '2', '1', '1', 'X', 'X', 'X', 'X', '1', 'X', '2', 'X', '1', '1', 'X', '2', '2', 'X', '1', '1', 'A4', 'B2', '1', 'C1', 'D3', '1', 'E1', 'F4', '1', 'G1', 'H2', '1', 'B1', 'A1', '1', 'D1', 'C2', '1', 'F1', 'E4', '1', 'H1', 'G3', '2', 'A4', 'C1', '2', 'E1', 'G1', '2', 'B1', 'D1', '2', 'F1', 'H1', '2', 'C1', 'G1', '1', 'D1', 'H1', '2', 'C1', 'H1', '1', 'G1', 'D1');
INSERT INTO `tippning` VALUES (15, 'X', '2', '1', '2', 'X', '2', '1', 'X', '1', '2', '1', '2', 'X', '1', 'X', '1', 'X', '1', 'X', '1', '1', '2', '1', 'X', 'X', 'X', '2', '1', '1', '1', '1', '1', '1', '1', '1', '2', '2', '1', '2', 'X', 'X', 'X', 'X', '2', '2', '2', '2', 'X', '1', 'A4', 'B2', '1', 'C1', 'D4', '1', 'E1', 'F2', '1', 'G1', 'H4', '1', 'B1', 'A2', '2', 'D1', 'C2', '1', 'F1', 'E4', '1', 'H1', 'G3', '2', 'A4', 'C1', '2', 'E1', 'G1', '1', 'B1', 'C2', '2', 'F1', 'H1', '2', 'C1', 'G1', '2', 'B1', 'H1', '1', 'C1', 'B1', '2', 'G1', 'H1');
INSERT INTO `tippning` VALUES (7, '2', '2', '1', 'X', '1', '2', '1', '1', '1', '2', '1', '2', '2', '1', 'X', '1', 'X', 'X', '2', '1', 'X', 'X', '1', '1', '1', '2', '1', '1', '1', '1', 'X', '1', '2', '1', 'X', '2', 'X', '1', '2', '2', 'X', 'X', '1', '2', '2', 'X', '2', 'X', '1', 'A4', 'B2', '2', 'C1', 'D1', '1', 'E1', 'F4', '1', 'G1', 'H4', '1', 'B1', 'A3', '1', 'D3', 'C4', '1', 'F1', 'E2', '1', 'H1', 'G4', '2', 'A4', 'C1', '2', 'E1', 'G1', '2', 'B1', 'D3', '2', 'F1', 'H1', '2', 'C1', 'G1', '2', 'D3', 'H1', '1', 'C1', 'D3', '2', 'G1', 'H1');
INSERT INTO `tippning` VALUES (35, '1', '2', '1', 'X', '1', 'X', '1', '1', 'X', '1', '1', 'X', '2', '1', '2', '1', 'X', '1', '2', '1', '1', '2', '1', 'X', '1', '2', 'X', '1', '1', 'X', 'X', '1', '1', '1', '1', '2', '2', 'X', 'X', 'X', 'X', '2', 'X', '2', 'X', '2', 'X', '1', '1', 'A4', 'B2', '1', 'C1', 'D2', '1', 'E1', 'F4', '1', 'G1', 'H2', '1', 'B1', 'A2', '1', 'D1', 'C2', '1', 'F1', 'E2', '1', 'H1', 'G4', '1', 'A4', 'C1', '1', 'E1', 'G1', '1', 'B2', 'C2', '2', 'F1', 'H1', '1', 'A4', 'H1', '2', 'C1', 'E1', '1', 'D1', 'B1', '1', 'A4', 'E1');
INSERT INTO `tippning` VALUES (21, '2', '2', '1', '2', '1', 'X', '1', '1', '1', '2', '1', '2', '2', '1', '2', '1', '2', '1', 'X', '1', '1', '2', '1', '2', '1', '1', 'X', '1', '1', '1', '1', '1', '2', '1', '1', '2', '2', '1', '2', '2', '2', '1', '1', '2', 'X', '1', '2', '1', '1', 'A4', 'B2', '1', 'C1', 'D3', '1', 'E1', 'F2', '1', 'G1', 'H4', '1', 'B1', 'A2', '1', 'D1', 'C2', '1', 'F1', 'E4', '2', 'H1', 'G4', '2', 'A4', 'C1', '1', 'E1', 'G1', '1', 'B1', 'D1', '2', 'F1', 'G4', '2', 'C1', 'E1', '1', 'B1', 'G4', '2', 'C1', 'G4', '1', 'E1', 'B1');
INSERT INTO `tippning` VALUES (36, '2', '2', 'X', '2', 'X', '1', '1', 'X', '2', '1', '1', 'X', '2', '1', '2', '1', 'X', 'X', '1', 'X', '1', '2', '1', 'X', 'X', '2', '1', '1', '1', '1', 'X', '1', '1', '1', '1', '1', '2', '1', '2', 'X', 'X', '1', '1', '2', '1', '2', 'X', '1', '1', 'A4', 'B1', '1', 'C1', 'D2', '2', 'E2', 'F4', '1', 'G1', 'H2', '2', 'B4', 'A2', '1', 'D1', 'C2', '2', 'F1', 'E1', '2', 'H1', 'G4', '1', 'A4', 'C1', '2', 'F4', 'G1', '2', 'A2', 'D1', '2', 'E1', 'G4', '2', 'A4', 'G1', '1', 'D1', 'G4', '2', 'A4', 'G4', '1', 'G1', 'D1');
INSERT INTO `tippning` VALUES (37, '1', '2', '1', '2', '1', 'X', '1', '2', '2', 'X', 'X', '2', '2', '1', 'X', '1', 'X', '1', '2', '1', '1', '1', '1', 'X', '1', '2', 'X', '1', '1', '1', '2', '1', '1', '2', 'X', '2', '2', 'X', '2', '2', '2', '1', '1', '2', '2', '2', '2', 'X', '1', 'A4', 'B1', '1', 'C1', 'D3', '2', 'E1', 'F2', '1', 'G1', 'H2', '2', 'B2', 'A1', '1', 'D1', 'C4', '2', 'F1', 'E2', '2', 'H1', 'G3', '1', 'A4', 'C1', '2', 'F2', 'G1', '2', 'A1', 'D1', '2', 'E2', 'G3', '1', 'A4', 'G1', '1', 'D1', 'G3', '1', 'G1', 'G3', '1', 'A4', 'D1');
INSERT INTO `tippning` VALUES (5, 'X', '2', '1', '2', '1', '2', '1', '1', '1', '2', '1', '2', '2', '1', '2', '1', '2', '1', '2', '1', '1', '2', '1', '1', '1', '2', '2', '1', '1', '1', '1', '1', '1', '1', '1', '2', '2', '1', '2', '2', '2', '1', '1', '2', '2', '2', '2', '1', '1', 'A4', 'B2', '1', 'C1', 'D3', '1', 'E1', 'F2', '1', 'G1', 'H4', '1', 'B1', 'A2', '1', 'D1', 'C2', '1', 'F1', 'E2', '1', 'H1', 'G4', '2', 'A4', 'C1', '2', 'E1', 'G1', '2', 'B1', 'D1', '2', 'F1', 'H1', '2', 'C1', 'G1', '2', 'B1', 'H1', '2', 'C1', 'B1', '2', 'G1', 'H1');
INSERT INTO `tippning` VALUES (24, '1', '2', '1', '1', '1', '2', '1', '1', '1', '1', '1', '2', '1', '1', '2', '1', '1', '1', '1', '2', '2', '1', '1', '2', '1', '2', '1', '1', '1', '1', '2', '1', '1', '1', '2', '2', '2', 'X', '2', '2', '2', '1', '2', '2', '2', '2', '2', '1', '1', 'A4', 'B1', '1', 'C1', 'D3', '1', 'E1', 'F4', '1', 'G1', 'H2', '1', 'B1', 'A2', '1', 'D1', 'C4', '1', 'F1', 'E3', '1', 'H1', 'G3', '2', 'A4', 'C1', '2', 'E1', 'G1', '2', 'B1', 'D1', '2', 'F1', 'H1', '1', 'C1', 'G1', '2', 'D1', 'H1', '1', 'G1', 'D1', '1', 'C1', 'H1');
INSERT INTO `tippning` VALUES (41, '1', '2', '1', '1', '1', '2', '1', '2', '1', '2', '1', 'X', '2', '1', '2', '1', 'X', '1', '1', '1', '1', '2', '1', '2', '1', '2', '2', '1', '2', '1', 'X', '1', '2', '1', '1', '2', 'X', '1', '2', '1', '2', '2', 'X', '1', '2', '2', 'X', '1', '2', 'A1', 'B1', '1', 'C1', 'D2', '1', 'E1', 'F1', '2', 'G1', 'H1', '1', 'B1', 'A4', '1', 'D1', 'C2', '1', 'F3', 'E2', '2', 'H3', 'G1', '1', 'B1', 'C1', '2', 'E1', 'G4', '2', 'B4', 'D1', '1', 'E1', 'G4', '2', 'B1', 'G4', '1', 'D1', 'E1', '2', 'A4', 'B1', '2', 'E1', 'D1');
INSERT INTO `tippning` VALUES (40, '2', '2', '1', '2', '1', '2', '1', '1', '1', '2', '1', '2', '2', '1', '2', '1', '1', '1', '1', '1', '1', '2', '1', '1', '1', '2', '2', '1', '1', '1', '1', '1', '1', '1', '1', '2', '2', '1', '2', '2', '2', '1', '1', '2', '2', '2', '2', '1', '1', 'A4', 'B4', '1', 'C1', 'D3', '1', 'E1', 'F2', '1', 'G1', 'H4', '1', 'B1', 'A2', '1', 'D1', 'C2', '1', 'F1', 'E2', '1', 'H1', 'G4', '1', 'A4', 'C1', '2', 'E1', 'G1', '2', 'B1', 'D1', '2', 'F1', 'H1', '2', 'A4', 'G1', '2', 'D1', 'H1', '2', 'A4', 'D1', '1', 'G1', 'H1');
INSERT INTO `tippning` VALUES (6, '1', 'X', '1', '1', '1', '2', '1', '1', '1', '1', '1', 'X', '1', '1', '2', '1', 'X', '1', '2', '1', '1', 'X', '1', '1', '1', '2', '2', '1', '1', '1', '2', '1', 'X', 'X', 'X', '2', 'X', '1', '2', '2', '2', '1', 'X', 'X', 'X', '2', '2', '1', '1', 'A4', 'B3', '1', 'C1', 'D3', '1', 'E1', 'F2', '1', 'G1', 'H2', '1', 'B1', 'A1', '1', 'D1', 'C4', '1', 'F1', 'E3', '1', 'H1', 'G3', '2', 'A4', 'C1', '1', 'E1', 'G1', '2', 'B1', 'D1', '2', 'F1', 'H1', '2', 'C1', 'E1', '2', 'D1', 'H1', '1', 'C1', 'D1', '2', 'E1', 'H1');
INSERT INTO `tippning` VALUES (39, '1', '1', '1', '2', 'X', '2', '1', '2', '2', '2', '1', '1', '1', '1', '2', '1', 'X', '2', 'X', '1', '1', '2', '1', '1', '1', 'X', 'X', '1', '1', '1', 'X', '1', 'X', '2', '1', 'X', '2', '1', '2', 'X', '2', '1', '1', '2', 'X', '2', '2', 'X', '1', 'A1', 'B4', '1', 'C1', 'D4', '2', 'E2', 'F3', '1', 'G1', 'H2', '1', 'B1', 'A4', '1', 'D1', 'C2', '2', 'F1', 'E1', '2', 'H1', 'G3', '1', 'A1', 'C1', '2', 'F1', 'G3', '1', 'A4', 'C1', '2', 'E2', 'H1', '1', 'A1', 'G1', '1', 'D1', 'E1', '2', 'G3', 'H1', '1', 'A1', 'D1');
INSERT INTO `tippning` VALUES (42, '1', '2', '2', '1', '1', 'X', '1', '1', '1', '2', '1', '2', '2', '1', '2', '1', '1', '2', '2', '1', 'X', '2', '1', '1', '1', '2', 'X', '1', '1', '1', '2', '1', 'X', '1', '1', '2', '2', '1', '2', '2', 'X', '1', '1', '2', 'X', '2', '2', '1', '1', 'A4', 'B2', '1', 'C1', 'D3', '1', 'E1', 'F4', '1', 'G1', 'H2', '2', 'B1', 'A1', '1', 'D1', 'C2', '2', 'F1', 'E2', '2', 'H1', 'G4', '2', 'A4', 'C1', '2', 'E1', 'G1', '1', 'A1', 'D1', '2', 'E2', 'G4', '2', 'C1', 'G1', '2', 'A1', 'G4', '2', 'C1', 'A1', '1', 'G1', 'G4');
INSERT INTO `tippning` VALUES (22, '1', '1', '1', '2', '1', '2', '1', '2', '1', '2', '1', '2', '2', '1', '1', '1', '1', '2', '1', 'X', '1', '2', '1', '2', '1', 'X', '2', '1', '1', '1', '2', '1', '1', '1', '1', '2', '2', '1', '2', '1', '1', '1', '1', '2', '1', '1', '2', '1', '1', 'A1', 'B4', '1', 'C1', 'D4', '1', 'E1', 'F4', '1', 'G4', 'H2', '2', 'B1', 'A2', '1', 'D1', 'C2', '1', 'F1', 'E4', '1', 'H1', 'G1', '2', 'A1', 'C1', '1', 'E1', 'G4', '1', 'A2', 'D1', '2', 'F1', 'H1', '1', 'C1', 'E1', '1', 'A2', 'H1', '2', 'E1', 'H1', '2', 'C1', 'A2');

-- --------------------------------------------------------

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

INSERT INTO `tippwinner` VALUES (1, '2004', 'Lennart', 'Karlsson', '600', 'lennartk.jpg');
INSERT INTO `tippwinner` VALUES (2, '2006', 'Karin', 'Waldemarsson', '800', 'karinw.jpg');
INSERT INTO `tippwinner` VALUES (3, '2008', 'Mattias', 'Hansson', '2650', 'mattiash.jpg');
INSERT INTO `tippwinner` VALUES (4, '2010', '', '', '0', '');

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
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

-- 
-- Dumping data for table `users`
-- 

INSERT INTO `users` VALUES (2, 'Thobias', 'Karlsson', NULL, 'Malmö', '0761452960', 'Tactel', 'thobias.karlsson@gmail.com', 'thoka', 'e358efa489f58062f10dd7316b65649e', NULL, '1', 1, 63);
INSERT INTO `users` VALUES (7, 'Magnus', 'Bengtsson', NULL, 'Halmstad', '0706562742', 'EKB Kraft AB', 'magnus.bengtsson@elkraftsbyggarna.se', 'mangebula', '5f86bdf702e28db0b889adece851dfd9', NULL, '1', NULL, 69);
INSERT INTO `users` VALUES (4, 'Martin', 'Källström', NULL, 'Karlshamn', '0702133497', 'Storegate', 'martin1.kallstrom@gmail.com', 'mupparna', '5c127516f8ca17d964241952e220f4bb', NULL, '1', NULL, 75);
INSERT INTO `users` VALUES (5, 'Jacob', 'Weinberg', NULL, 'Malmö', '+46705298964', 'Tactel', 'slass0@gmail.com', 'slass', '7d2beaeeb514cc1d3719df7387660b83', NULL, '1', 1, 76);
INSERT INTO `users` VALUES (6, 'Jonas', 'Falk', NULL, 'Mlm', '', '', '', 'jfalk', '4193a53e1318bfacc7b5ee5757c4d959', NULL, '1', NULL, 94);
INSERT INTO `users` VALUES (9, 'Alexander', 'Johansson', NULL, 'Halmstad', '0735-036056', 'EKB Kraft AB', 'okomesonen@gmail.com', 'Zwonka', 'a65558d8fd75d0dfeab0599a6d03249b', NULL, '1', NULL, 74);
INSERT INTO `users` VALUES (12, 'Evelina', 'Karlsson', NULL, 'Halmstad', '0733807920', '', 'karlssonevelina@live.se', 'Evis', 'a2dd7845a2397685768d78dbb99f90a4', NULL, '1', NULL, 61);
INSERT INTO `users` VALUES (13, 'Per', 'Waldemarsson', NULL, 'Halmstad', '0738430949', 'Försvarsmakten', 'per.waldemarsson@gmail.com', 'Waldis', 'f7a20b9a79645278fc5e16e47f352342', NULL, '1', NULL, 84);
INSERT INTO `users` VALUES (15, 'David', 'Moberg', NULL, 'Kvibille', '0706028423', 'NCC', 'david.moberg@ncc.se', 'dejva', 'b36eb6a9de96a0cf7ece35bcefb7dae1', NULL, '1', NULL, 71);
INSERT INTO `users` VALUES (16, 'Björn', 'Johnsson', NULL, 'Holm', '', 'Arkla Foods', 'jonssa81@hotmail.com', 'Jonssa', '0ae3f79a30234b6c45a6f7d298ba1310', NULL, '1', NULL, 56);
INSERT INTO `users` VALUES (17, 'Jennie', 'Johnsson', NULL, 'Gullbrandstorp', '', '', '', 'Jennie', 'f960f3fbd2ad46bfe7a08c66e9ecabf6', NULL, '1', NULL, 49);
INSERT INTO `users` VALUES (18, 'Niclas', 'Hagman', NULL, 'Gullbrandstorp', '0708584620', 'NH Golf Academy', 'n.hagman@telia.com', 'hagge76', '4ba3074d256c012af2755c2ba124edc6', NULL, '1', NULL, 59);
INSERT INTO `users` VALUES (19, 'Thomas ', 'Benes', NULL, 'Halmstad', '0705-558978', 'Benes Travel', 'thomas@benestravel.se', 'thomas@benestravel.se', '834e751450b82b20f2624d0c47fd1e94', NULL, '1', NULL, 50);
INSERT INTO `users` VALUES (20, 'Ola', 'Olsson', NULL, 'Lund', '-', 'Tactel', 'ola1olsson@gmail.com', 'ola', '5db7aee0dd008633e1c45ad22e3efc19', NULL, '1', 1, 71);
INSERT INTO `users` VALUES (21, 'Christian', 'Ekstrand', NULL, 'Malmö', '555555555', 'Dolme Inc.', 'christianekstrand@gmail.com', 'ekiz', 'f46c37ec8972033856fac1965748cf25', NULL, '1', NULL, 67);
INSERT INTO `users` VALUES (22, 'Göran', 'Johnsson', NULL, 'Halmstad', '', '', '', 'goran48', '72626c2e45e149d005a0d408e80dcfea', NULL, '1', NULL, 62);
INSERT INTO `users` VALUES (23, 'Caroline', 'Waldemarsson', NULL, 'Göteborg', '', '', '', 'Caroline', '245a5ba0006fa0673949e53c69852721', NULL, '1', NULL, 68);
INSERT INTO `users` VALUES (24, 'Tobbe', 'Larsson', NULL, 'Göteborg', '', '', '', 'Tobbe', 'ad00a0e0e0567de597b0c4d17c24d262', NULL, '1', NULL, 81);
INSERT INTO `users` VALUES (25, 'Hans', 'Valdemarsson', NULL, 'Slöinge', '0708-830093', '', 'putte@hako.se', 'PutteV', '4ba0feab6c2f13da9ded94435a297197', NULL, '1', NULL, 57);
INSERT INTO `users` VALUES (29, 'Jenny', 'Nilsson', NULL, 'Malmö', '', '', 'jenny.nilsson@me.com', 'jhennah', 'e37c173da8b57a4d522f5b49bfe33534', NULL, '1', NULL, 78);
INSERT INTO `users` VALUES (30, 'Magnus', 'Gunnarsson', NULL, 'Lund', '0702564555', 'Tactel', 'mange.gunnarsson@gmail.com', 'Manxz', 'e176d33338ede1c88c722670339a9473', NULL, '1', NULL, 89);
INSERT INTO `users` VALUES (31, 'Emma', 'Ivarsson', NULL, 'Halmstad', '0705526982', 'Bianco Footwear', 'emmaivarsson@live.se', 'emmaivarsson', '4b0a366bff54e5359c7bcfca1fa12b52', NULL, '1', NULL, 73);
INSERT INTO `users` VALUES (32, 'Christer', 'Holmgren', NULL, 'Getinge', '0707342428', 'Getinge Sterilisation AB', 'ch.holmghren@tele2.se', 'Christer', '85796980e853ca2f38df4e044237b32e', NULL, '1', NULL, 61);
INSERT INTO `users` VALUES (33, 'Kerstin', 'Carlsson', NULL, 'Getinge', '0702- 067098', '', 'kvc@telia.com', 'Kerstin', 'ce31816af4b6d7997b778c156f1826f2', NULL, '1', NULL, 41);
INSERT INTO `users` VALUES (34, 'Andreas', 'Holmberg', NULL, 'MALMÖ', '0704142272', 'TACTEL', 'andreas.holmberg@gmail.com', 'affeman', '993ad79e517cfe98baf12243ba455e1a', NULL, '1', NULL, 61);
INSERT INTO `users` VALUES (35, 'Thomas', 'Karlsson', NULL, 'Getinge', '0708830090', 'Hako', 'kvc@telia.com', 'thocar', '9626378751c4b33d23866b53344f71ec', NULL, '1', NULL, 53);
INSERT INTO `users` VALUES (36, 'Sandra', 'Holmgren', NULL, 'Getinge', '0739648064', '', 'sandra.holmgren@gmail.com', 'sandraholmgren', 'dfa508c6615e356a6d21c229c249bf55', NULL, '1', NULL, 47);
INSERT INTO `users` VALUES (37, 'Petra ', 'Holmgren', NULL, 'Getinge', '0737184271', '', 'petra_holmgren@spray.se', 'petraholmgren', '9537885ad310d401444a916409a4a040', NULL, '1', NULL, 45);
INSERT INTO `users` VALUES (39, 'Patrick', 'Gilmore', NULL, 'Oslo', '+46709927315', 'Noonday', 'p@noonday.se', 'fidodido', 'a80c5bdf50a09f455e69df210bb08ea8', NULL, '1', NULL, 46);
INSERT INTO `users` VALUES (40, 'Lina', 'Ekelund', NULL, 'Malmö', '0709-685628', 'Kicks', 'yanine_ekelund@hotmail.com', 'yanine', 'e7cd02cc66bb89e30b38fbd756b720a0', NULL, '1', NULL, 84);
INSERT INTO `users` VALUES (41, 'Nils', 'Anker', NULL, 'Slöinge', '0704947176', '', 'nisseanker@hotmail.com', 'nisse', '9837aac02814a746c02626f54596ba45', NULL, '1', NULL, 54);
INSERT INTO `users` VALUES (42, 'Anna', 'Karlsson', NULL, 'Slöinge', '0703251809', '', 'bannobus@gmail.com', 'banno', '1d3678832ee1f3d106f656501a5296b6', NULL, '1', NULL, 51);

-- --------------------------------------------------------

-- 
-- Table structure for table `vm2010arena`
-- 

CREATE TABLE `vm2010arena` (
  `id` int(11) NOT NULL,
  `arena` varchar(45) default NULL,
  `location` varchar(45) default NULL,
  `capacity` varchar(45) default NULL,
  `buildyear` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `vm2010arena`
-- 

INSERT INTO `vm2010arena` VALUES (1, 'Soccer City', 'Johannesburg', '94700', '1987');
INSERT INTO `vm2010arena` VALUES (2, 'Green Point Stadium', 'Kapstaden', '68000', '2009');
INSERT INTO `vm2010arena` VALUES (3, 'Moses Mabhida Stadium', 'Durban', '70000', '2009');
INSERT INTO `vm2010arena` VALUES (4, 'Ellis Park Stadium', 'Johannesburg', '61000', '1928');
INSERT INTO `vm2010arena` VALUES (5, 'Loftus Versfeld Stadium', 'Pretoria', '50000', '1906');
INSERT INTO `vm2010arena` VALUES (6, 'Nelson Mandela Bay Stadium', 'Port Elizabeth', '48000', '2009');
INSERT INTO `vm2010arena` VALUES (7, 'Free State Stadium', 'Bloemfontein', '48000', '2007');
INSERT INTO `vm2010arena` VALUES (8, 'Mbombela Stadium', 'Nelspruit', '46000', '2007');
INSERT INTO `vm2010arena` VALUES (9, 'Peter Mokaba Stadium', 'Polokwane', '45000', '2007');
INSERT INTO `vm2010arena` VALUES (10, 'Royal Bakofeng Stadium', 'Rustenburg', '42000', '1995');

-- --------------------------------------------------------

-- 
-- Table structure for table `vm2010tipp`
-- 

CREATE TABLE `vm2010tipp` (
  `idvm2010tipp` int(11) NOT NULL,
  PRIMARY KEY  (`idvm2010tipp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `vm2010tipp`
-- 


-- --------------------------------------------------------

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

INSERT INTO `vmwinner` VALUES (1, '1930', 'Uruguay', 'Uruguay', 'uru.gif', 'Uruguay');
INSERT INTO `vmwinner` VALUES (2, '1934', 'Italien', 'Italy', 'ita.gif', 'Italien');
INSERT INTO `vmwinner` VALUES (3, '1938', 'Italien', 'Italy', 'ita.gif', 'Frankrike');
INSERT INTO `vmwinner` VALUES (4, '1942', '-', '-', '-', 'Andra världskriget VM spelades inte');
INSERT INTO `vmwinner` VALUES (5, '1950', 'Uruguay', 'Uruguay', 'uru.gif', 'Brasilien');
INSERT INTO `vmwinner` VALUES (6, '1954', 'Västtyskland', 'West-Germany', 'west_ger.gif', 'Schweiz');
INSERT INTO `vmwinner` VALUES (7, '1958', 'Brasilien', 'Brazil', 'bra.gif', 'Sverige');
INSERT INTO `vmwinner` VALUES (8, '1962', 'Brasilien', 'Brazil', 'bra.gif', 'Chile');
INSERT INTO `vmwinner` VALUES (9, '1966', 'England', 'England', 'eng.gif', 'England');
INSERT INTO `vmwinner` VALUES (10, '1970', 'Brasilien', 'Brazil', 'bra.gif', 'Mexiko');
INSERT INTO `vmwinner` VALUES (11, '1974', 'Västtyskland', 'West-Germany', 'west_ger.gif', 'Västtyskland');
INSERT INTO `vmwinner` VALUES (12, '1978', 'Argentina', 'Argentina', 'arg.gif', 'Argentina');
INSERT INTO `vmwinner` VALUES (13, '1982', 'Italien', 'Italy', 'ita.gif', 'Spanien');
INSERT INTO `vmwinner` VALUES (14, '1986', 'Argentina', 'Argentina', 'arg.gif', 'Mexiko');
INSERT INTO `vmwinner` VALUES (15, '1990', 'Västtyskland', 'West-Germany', 'west_ger.gif', 'Italien');
INSERT INTO `vmwinner` VALUES (16, '1994', 'Brasilien', 'Brazil', 'bra.gif', 'USA');
INSERT INTO `vmwinner` VALUES (17, '1998', 'Frankrike', 'France', 'fra.gif', 'Frankrike');
INSERT INTO `vmwinner` VALUES (18, '2002', 'Brasilien', 'Brazil', 'bra.gif', 'Sydkorea & Japan');
INSERT INTO `vmwinner` VALUES (19, '2006', 'Italien', 'Italy', 'ita.gif', 'Tyskland');
INSERT INTO `vmwinner` VALUES (20, '2010', '-', '', '', 'Sydafrika');
INSERT INTO `vmwinner` VALUES (21, '2014', '-', '', '', 'Brasilien');
