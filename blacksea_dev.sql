-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 28, 2013 at 01:56 PM
-- Server version: 5.5.34-MariaDB-1~wheezy-log
-- PHP Version: 5.4.4-14+deb7u7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `theblack_production`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_classes`
--

CREATE TABLE IF NOT EXISTS `auth_classes` (
  `cid` int(4) NOT NULL AUTO_INCREMENT COMMENT 'Class ID',
  `name` char(20) NOT NULL COMMENT 'Class name',
  `parent` int(4) DEFAULT NULL COMMENT 'Class parent (for subclasses)',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `auth_invitations`
--

CREATE TABLE IF NOT EXISTS `auth_invitations` (
  `email` varchar(255) NOT NULL,
  `cid` int(3) NOT NULL DEFAULT '3',
  `token` varchar(32) NOT NULL,
  PRIMARY KEY (`email`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions_blog`
--

CREATE TABLE IF NOT EXISTS `auth_permissions_blog` (
  `cid` int(4) NOT NULL COMMENT 'Class Id',
  `article_add` tinyint(1) DEFAULT NULL COMMENT 'poate adauga articole',
  `article_edit` tinyint(1) DEFAULT NULL COMMENT 'poate edita, sterge articolele altora',
  `article_tmpl` int(11) DEFAULT NULL,
  `article_pub` tinyint(1) DEFAULT NULL COMMENT 'poate publica articlolele lui',
  `comm_edit` tinyint(1) DEFAULT NULL COMMENT 'poate edita comenturile altora',
  `comm_add` tinyint(1) DEFAULT NULL COMMENT 'poate adauga comenturi',
  UNIQUE KEY `cid` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions_site`
--

CREATE TABLE IF NOT EXISTS `auth_permissions_site` (
  `cid` int(4) NOT NULL,
  `page_addRm` tinyint(1) DEFAULT NULL COMMENT 'poate adauga si sterge pagini',
  `page_edit` tinyint(1) DEFAULT NULL COMMENT 'poate edita orice pagina',
  `page_pub` tinyint(1) DEFAULT NULL COMMENT 'poate publica pagini',
  UNIQUE KEY `cid` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions_sys`
--

CREATE TABLE IF NOT EXISTS `auth_permissions_sys` (
  `cid` int(4) NOT NULL,
  `user_addRm` tinyint(1) DEFAULT NULL,
  `user_edit` tinyint(1) DEFAULT NULL,
  `user_mute` tinyint(1) DEFAULT NULL,
  `perm_manage` tinyint(1) DEFAULT NULL,
  `class_manage` tinyint(1) DEFAULT NULL,
  UNIQUE KEY `cid` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auth_sessions`
--

CREATE TABLE IF NOT EXISTS `auth_sessions` (
  `sid` char(32) NOT NULL COMMENT 'PHP session ID',
  `uid` int(4) NOT NULL COMMENT 'User ID',
  `address` char(39) NOT NULL COMMENT 'IP address',
  `agent` text NOT NULL COMMENT 'User agent',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Time started',
  `expires` int(10) unsigned DEFAULT NULL COMMENT 'Lifetime',
  PRIMARY KEY (`sid`),
  KEY `uid_sid` (`uid`),
  KEY `fk_auth_sessions_1` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users`
--

CREATE TABLE IF NOT EXISTS `auth_users` (
  `uid` int(4) NOT NULL AUTO_INCREMENT COMMENT 'User ID',
  `cid` int(4) DEFAULT NULL COMMENT 'User class, if any (FK)',
  `name` char(20) NOT NULL COMMENT 'User name',
  `active` tinyint(1) NOT NULL COMMENT 'Whether is enabled or not',
  `email` varchar(100) NOT NULL COMMENT 'auth_users',
  `password` varchar(32) DEFAULT NULL,
  `token` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `token_UNIQUE` (`token`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `auth_users_datatables`
--
CREATE TABLE IF NOT EXISTS `auth_users_datatables` (
`uid` int(4)
,`name` char(20)
,`uclass` char(20)
,`active` tinyint(1)
,`email` varchar(100)
,`first_name` varchar(30)
,`last_name` varchar(50)
,`full_name` varchar(81)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `auth_users_profile`
--
CREATE TABLE IF NOT EXISTS `auth_users_profile` (
`uid` int(4)
,`first_name` varchar(30)
,`last_name` varchar(50)
,`title` varchar(70)
,`bio` text
,`phone` varchar(15)
,`photo` text
,`site` varchar(100)
,`email` varchar(100)
,`name` char(20)
,`cid` int(4)
,`country` char(4)
,`language` char(5)
);
-- --------------------------------------------------------

--
-- Table structure for table `auth_user_details`
--

CREATE TABLE IF NOT EXISTS `auth_user_details` (
  `uid` int(4) NOT NULL COMMENT 'User ID (FK)',
  `first_name` varchar(30) NOT NULL COMMENT 'First name',
  `last_name` varchar(50) NOT NULL COMMENT 'Last name',
  `language` char(5) DEFAULT NULL COMMENT 'Language code, i.e. en_US',
  `country` char(4) DEFAULT NULL COMMENT 'Country code, i.e. US',
  `city` varchar(100) DEFAULT NULL COMMENT 'City',
  `title` varchar(70) DEFAULT NULL,
  `bio` text,
  `photo` text,
  `phone` varchar(15) DEFAULT NULL,
  `site` varchar(100) DEFAULT NULL,
  `last_ip` varchar(39) NOT NULL COMMENT 'Last IP used to log in',
  `creation` varchar(100) NOT NULL COMMENT 'When was the user created',
  `last_login` char(32) DEFAULT NULL,
  UNIQUE KEY `uid` (`uid`),
  KEY `sid_details` (`last_login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_user_stats`
--

CREATE TABLE IF NOT EXISTS `auth_user_stats` (
  `uid` int(4) NOT NULL COMMENT 'User id (FK)',
  `age` int(6) DEFAULT NULL COMMENT 'Age on site (days)',
  `failed_logins` tinyint(1) DEFAULT NULL,
  `comments_count` int(6) DEFAULT NULL COMMENT 'Comments counter',
  `articles_count` int(6) DEFAULT NULL COMMENT 'Articles counter',
  `warn_count` int(2) DEFAULT NULL COMMENT 'Warns count',
  `permissions` text,
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blogComments`
--

CREATE TABLE IF NOT EXISTS `blogComments` (
  `idComm` int(5) NOT NULL AUTO_INCREMENT,
  `idP` int(5) DEFAULT NULL,
  `idExt` int(5) NOT NULL,
  `entryDate` date NOT NULL,
  `userName` char(30) NOT NULL,
  `uidComm` int(4) DEFAULT NULL,
  `ratingUp` int(3) DEFAULT NULL,
  `ratingDown` int(3) DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idComm`),
  KEY `FK_idRecord` (`idExt`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `blogComments_commGallery`
--

CREATE TABLE IF NOT EXISTS `blogComments_commGallery` (
  `idPic` int(5) NOT NULL AUTO_INCREMENT,
  `idComm` int(5) NOT NULL,
  `picUrl` text NOT NULL,
  `picTitle` varchar(80) DEFAULT NULL,
  `picDescr` text,
  `picLoc` text COMMENT 'locatia',
  `picDate` date DEFAULT NULL,
  PRIMARY KEY (`idPic`),
  KEY `idComm` (`idComm`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `blogComments_prior`
--

CREATE TABLE IF NOT EXISTS `blogComments_prior` (
  `idComm` int(5) NOT NULL,
  `idRecord` int(5) NOT NULL,
  `priorityLevel` tinyint(4) NOT NULL,
  UNIQUE KEY `idComm_UNIQUE` (`idComm`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='priorities for comments';

-- --------------------------------------------------------

--
-- Table structure for table `blogComments_text`
--

CREATE TABLE IF NOT EXISTS `blogComments_text` (
  `idComm` int(5) NOT NULL,
  `comment` text NOT NULL,
  UNIQUE KEY `idComm` (`idComm`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blogComments_thumbs`
--

CREATE TABLE IF NOT EXISTS `blogComments_thumbs` (
  `idComm` int(5) NOT NULL,
  `thumbsUp` int(3) DEFAULT '0',
  `thumbsDown` int(3) DEFAULT '0',
  UNIQUE KEY `idComm` (`idComm`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blogMap_recordsTags`
--

CREATE TABLE IF NOT EXISTS `blogMap_recordsTags` (
  `idTag` int(4) NOT NULL AUTO_INCREMENT,
  `idRecord` int(5) NOT NULL,
  `tagName` varchar(50) NOT NULL,
  PRIMARY KEY (`idTag`),
  KEY `idRecord` (`idRecord`),
  KEY `idTag` (`tagName`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4616 ;

-- --------------------------------------------------------

--
-- Table structure for table `blogRecords`
--

CREATE TABLE IF NOT EXISTS `blogRecords` (
  `idRecord` int(5) NOT NULL AUTO_INCREMENT,
  `idCat` int(5) DEFAULT NULL COMMENT 'ext ITEMS',
  `idTree` int(5) DEFAULT NULL,
  `uidRec` int(5) DEFAULT NULL COMMENT 'userID - author',
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `sideContent` longtext,
  `lead` longtext,
  `leadSec` mediumtext,
  `country` varchar(60) DEFAULT NULL,
  `city` varchar(60) DEFAULT NULL,
  `scripts` text,
  PRIMARY KEY (`idRecord`),
  KEY `idCat` (`idCat`),
  KEY `uid` (`uidRec`),
  KEY `idTree` (`idTree`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1158 ;

-- --------------------------------------------------------

--
-- Table structure for table `blogRecords_authors`
--

CREATE TABLE IF NOT EXISTS `blogRecords_authors` (
  `idRecord` int(5) NOT NULL,
  `uid` int(4) NOT NULL,
  UNIQUE KEY `idRecord_2` (`idRecord`,`uid`),
  KEY `idRecord` (`idRecord`,`uid`),
  KEY `idRecord_3` (`idRecord`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blogRecords_prior`
--

CREATE TABLE IF NOT EXISTS `blogRecords_prior` (
  `idRecord` int(5) NOT NULL AUTO_INCREMENT,
  `priorityLevel` int(1) NOT NULL,
  `endDate` date NOT NULL,
  PRIMARY KEY (`idRecord`),
  UNIQUE KEY `idRecord` (`idRecord`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `blogRecords_settings`
--

CREATE TABLE IF NOT EXISTS `blogRecords_settings` (
  `idRecord` int(5) NOT NULL COMMENT 'ext blogRecords',
  `idFormat` int(5) DEFAULT NULL COMMENT 'id format',
  `idTmpl` int(2) DEFAULT NULL,
  `idFolder` int(2) DEFAULT NULL,
  `relatedStory` text,
  `css` text,
  `js` text,
  `SEO` text NOT NULL COMMENT 'vector serializat cu metauri',
  UNIQUE KEY `idRecord` (`idRecord`),
  KEY `idTmpl` (`idTmpl`),
  KEY `idFolder` (`idFolder`),
  KEY `idFormat` (`idFormat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blogRecords_stats`
--

CREATE TABLE IF NOT EXISTS `blogRecords_stats` (
  `idRecord` int(5) NOT NULL,
  `entryDate` date NOT NULL COMMENT 'ultima revizie',
  `publishDate` date DEFAULT NULL COMMENT 'data publicarii',
  `republish` smallint(1) DEFAULT NULL,
  `nrRates` int(3) DEFAULT NULL,
  `ratingTotal` int(5) DEFAULT NULL,
  UNIQUE KEY `idRecord` (`idRecord`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `blogRecords_view`
--
CREATE TABLE IF NOT EXISTS `blogRecords_view` (
`idRecord` int(5)
,`idCat` int(5)
,`idTree` int(5)
,`uidRec` int(5)
,`title` varchar(255)
,`content` longtext
,`sideContent` longtext
,`lead` longtext
,`leadSec` mediumtext
,`scripts` text
,`country` varchar(60)
,`city` varchar(60)
,`entryDate` date
,`publishDate` date
,`nrRates` int(3)
,`ratingTotal` int(5)
,`republish` smallint(1)
,`relatedStory` text
,`css` text
,`js` text
,`SEO` text
,`folderName` varchar(100)
,`idFolder` int(3)
,`format` varchar(10)
,`idFormat` int(2)
);
-- --------------------------------------------------------

--
-- Table structure for table `blogRecord_folders`
--

CREATE TABLE IF NOT EXISTS `blogRecord_folders` (
  `idFolder` int(3) NOT NULL AUTO_INCREMENT,
  `parentFolder` int(3) NOT NULL DEFAULT '0',
  `folderName` varchar(100) NOT NULL,
  `idTmpl` int(2) DEFAULT NULL,
  PRIMARY KEY (`idFolder`),
  KEY `parentFolder` (`parentFolder`),
  KEY `idTmpl` (`idTmpl`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `blogRecord_formats`
--

CREATE TABLE IF NOT EXISTS `blogRecord_formats` (
  `idFormat` int(2) NOT NULL AUTO_INCREMENT,
  `format` varchar(10) NOT NULL,
  `idTmpl` int(2) DEFAULT NULL,
  PRIMARY KEY (`idFormat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `blogRecord_tmplFiles`
--

CREATE TABLE IF NOT EXISTS `blogRecord_tmplFiles` (
  `idTmpl` int(2) NOT NULL AUTO_INCREMENT,
  `tmplFile` varchar(30) NOT NULL,
  PRIMARY KEY (`idTmpl`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `blogTags`
--

CREATE TABLE IF NOT EXISTS `blogTags` (
  `idTag` int(5) NOT NULL AUTO_INCREMENT,
  `tagName` varchar(50) NOT NULL,
  PRIMARY KEY (`idTag`),
  UNIQUE KEY `tagName` (`tagName`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4935 ;

-- --------------------------------------------------------

--
-- Table structure for table `blogTags_banned`
--

CREATE TABLE IF NOT EXISTS `blogTags_banned` (
  `idTag` int(5) NOT NULL AUTO_INCREMENT,
  `tagname` varchar(50) NOT NULL,
  PRIMARY KEY (`idTag`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `blog_picManager`
--

CREATE TABLE IF NOT EXISTS `blog_picManager` (
  `idPic` int(5) NOT NULL AUTO_INCREMENT,
  `idRecord` int(5) NOT NULL,
  `picUrl` text NOT NULL,
  `picTitle` varchar(80) DEFAULT NULL,
  `picAuth` varchar(80) DEFAULT NULL COMMENT 'autor',
  `picLoc` text COMMENT 'locatia',
  `picDescr` text COMMENT 'descriere',
  `picDate` date DEFAULT NULL,
  PRIMARY KEY (`idPic`),
  KEY `idRecord` (`idRecord`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `cid_permissions`
--
CREATE TABLE IF NOT EXISTS `cid_permissions` (
`cid` int(4)
,`name` char(20)
,`parent` int(4)
,`article_add` tinyint(1)
,`article_edit` tinyint(1)
,`article_tmpl` int(11)
,`article_pub` tinyint(1)
,`comm_edit` tinyint(1)
,`comm_add` tinyint(1)
,`page_addRm` tinyint(1)
,`page_edit` tinyint(1)
,`page_pub` tinyint(1)
,`user_addRm` tinyint(1)
,`user_edit` tinyint(1)
,`user_mute` tinyint(1)
,`perm_manage` tinyint(1)
,`class_manage` tinyint(1)
);
-- --------------------------------------------------------

--
-- Table structure for table `ITEMS`
--

CREATE TABLE IF NOT EXISTS `ITEMS` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `type` char(40) NOT NULL,
  `name_ro` text NOT NULL,
  `name_en` text NOT NULL,
  `SEO` text,
  `opt` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=104 ;

-- --------------------------------------------------------

--
-- Table structure for table `MENUS`
--

CREATE TABLE IF NOT EXISTS `MENUS` (
  `id` int(3) NOT NULL,
  `idM` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rating_blog`
--

CREATE TABLE IF NOT EXISTS `rating_blog` (
  `uid` int(5) NOT NULL,
  `idRecord` int(5) NOT NULL,
  `rating` int(1) NOT NULL,
  UNIQUE KEY `uid` (`uid`,`idRecord`),
  KEY `idRecord` (`idRecord`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `session_data`
--

CREATE TABLE IF NOT EXISTS `session_data` (
  `session_id` varchar(32) NOT NULL DEFAULT '',
  `hash` varchar(32) NOT NULL DEFAULT '',
  `session_data` blob NOT NULL,
  `session_expire` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `TREE`
--

CREATE TABLE IF NOT EXISTS `TREE` (
  `Pid` int(3) NOT NULL,
  `Cid` int(3) NOT NULL,
  `poz` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure for view `auth_users_datatables`
--
DROP TABLE IF EXISTS `auth_users_datatables`;

CREATE ALGORITHM=UNDEFINED DEFINER=`theblack_dev`@`localhost` SQL SECURITY DEFINER VIEW `auth_users_datatables` AS select `auth_users`.`uid` AS `uid`,`auth_users`.`name` AS `name`,`auth_classes`.`name` AS `uclass`,`auth_users`.`active` AS `active`,`auth_users`.`email` AS `email`,`auth_user_details`.`first_name` AS `first_name`,`auth_user_details`.`last_name` AS `last_name`,concat(`auth_user_details`.`first_name`,' ',`auth_user_details`.`last_name`) AS `full_name` from ((`auth_users` join `auth_user_details` on((`auth_users`.`uid` = `auth_user_details`.`uid`))) join `auth_classes` on((`auth_users`.`cid` = `auth_classes`.`cid`)));

-- --------------------------------------------------------

--
-- Structure for view `auth_users_profile`
--
DROP TABLE IF EXISTS `auth_users_profile`;

CREATE ALGORITHM=UNDEFINED DEFINER=`theblack_dev`@`localhost` SQL SECURITY DEFINER VIEW `auth_users_profile` AS select `auth_users`.`uid` AS `uid`,`auth_user_details`.`first_name` AS `first_name`,`auth_user_details`.`last_name` AS `last_name`,`auth_user_details`.`title` AS `title`,`auth_user_details`.`bio` AS `bio`,`auth_user_details`.`phone` AS `phone`,`auth_user_details`.`photo` AS `photo`,`auth_user_details`.`site` AS `site`,`auth_users`.`email` AS `email`,`auth_users`.`name` AS `name`,`auth_users`.`cid` AS `cid`,`auth_user_details`.`country` AS `country`,`auth_user_details`.`language` AS `language` from (`auth_users` join `auth_user_details` on((`auth_users`.`uid` = `auth_user_details`.`uid`)));

-- --------------------------------------------------------

--
-- Structure for view `blogRecords_view`
--
DROP TABLE IF EXISTS `blogRecords_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`theblack_dev`@`localhost` SQL SECURITY DEFINER VIEW `blogRecords_view` AS select `blogRecords`.`idRecord` AS `idRecord`,`blogRecords`.`idCat` AS `idCat`,`blogRecords`.`idTree` AS `idTree`,`blogRecords`.`uidRec` AS `uidRec`,`blogRecords`.`title` AS `title`,`blogRecords`.`content` AS `content`,`blogRecords`.`sideContent` AS `sideContent`,`blogRecords`.`lead` AS `lead`,`blogRecords`.`leadSec` AS `leadSec`,`blogRecords`.`scripts` AS `scripts`,`blogRecords`.`country` AS `country`,`blogRecords`.`city` AS `city`,`blogRecords_stats`.`entryDate` AS `entryDate`,`blogRecords_stats`.`publishDate` AS `publishDate`,`blogRecords_stats`.`nrRates` AS `nrRates`,`blogRecords_stats`.`ratingTotal` AS `ratingTotal`,`blogRecords_stats`.`republish` AS `republish`,`blogRecords_settings`.`relatedStory` AS `relatedStory`,`blogRecords_settings`.`css` AS `css`,`blogRecords_settings`.`js` AS `js`,`blogRecords_settings`.`SEO` AS `SEO`,`blogRecord_folders`.`folderName` AS `folderName`,`blogRecord_folders`.`idFolder` AS `idFolder`,`blogRecord_formats`.`format` AS `format`,`blogRecord_formats`.`idFormat` AS `idFormat` from ((((`blogRecords` join `blogRecords_stats` on((`blogRecords`.`idRecord` = `blogRecords_stats`.`idRecord`))) left join `blogRecords_settings` on((`blogRecords`.`idRecord` = `blogRecords_settings`.`idRecord`))) left join `blogRecord_folders` on((`blogRecords_settings`.`idFolder` = `blogRecord_folders`.`idFolder`))) left join `blogRecord_formats` on((`blogRecords_settings`.`idFormat` = `blogRecord_formats`.`idFormat`)));

-- --------------------------------------------------------

--
-- Structure for view `cid_permissions`
--
DROP TABLE IF EXISTS `cid_permissions`;

CREATE ALGORITHM=UNDEFINED DEFINER=`theblack_dev`@`localhost` SQL SECURITY DEFINER VIEW `cid_permissions` AS select `auth_classes`.`cid` AS `cid`,`auth_classes`.`name` AS `name`,`auth_classes`.`parent` AS `parent`,`auth_permissions_blog`.`article_add` AS `article_add`,`auth_permissions_blog`.`article_edit` AS `article_edit`,`auth_permissions_blog`.`article_tmpl` AS `article_tmpl`,`auth_permissions_blog`.`article_pub` AS `article_pub`,`auth_permissions_blog`.`comm_edit` AS `comm_edit`,`auth_permissions_blog`.`comm_add` AS `comm_add`,`auth_permissions_site`.`page_addRm` AS `page_addRm`,`auth_permissions_site`.`page_edit` AS `page_edit`,`auth_permissions_site`.`page_pub` AS `page_pub`,`auth_permissions_sys`.`user_addRm` AS `user_addRm`,`auth_permissions_sys`.`user_edit` AS `user_edit`,`auth_permissions_sys`.`user_mute` AS `user_mute`,`auth_permissions_sys`.`perm_manage` AS `perm_manage`,`auth_permissions_sys`.`class_manage` AS `class_manage` from (((`auth_classes` join `auth_permissions_blog` on((`auth_classes`.`cid` = `auth_permissions_blog`.`cid`))) join `auth_permissions_site` on((`auth_classes`.`cid` = `auth_permissions_site`.`cid`))) join `auth_permissions_sys` on((`auth_classes`.`cid` = `auth_permissions_sys`.`cid`)));

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_permissions_blog`
--
ALTER TABLE `auth_permissions_blog`
  ADD CONSTRAINT `auth_permissions_blog_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `auth_classes` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_permissions_site`
--
ALTER TABLE `auth_permissions_site`
  ADD CONSTRAINT `auth_permissions_site_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `auth_classes` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_permissions_sys`
--
ALTER TABLE `auth_permissions_sys`
  ADD CONSTRAINT `auth_permissions_sys_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `auth_classes` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_sessions`
--
ALTER TABLE `auth_sessions`
  ADD CONSTRAINT `fk_auth_sessions_1` FOREIGN KEY (`uid`) REFERENCES `auth_users` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_users`
--
ALTER TABLE `auth_users`
  ADD CONSTRAINT `auth_users_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `auth_classes` (`cid`) ON UPDATE CASCADE;

--
-- Constraints for table `auth_user_details`
--
ALTER TABLE `auth_user_details`
  ADD CONSTRAINT `auth_user_details_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `auth_users` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_user_stats`
--
ALTER TABLE `auth_user_stats`
  ADD CONSTRAINT `auth_user_stats_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `auth_users` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blogComments`
--
ALTER TABLE `blogComments`
  ADD CONSTRAINT `blogComments_ibfk_1` FOREIGN KEY (`idExt`) REFERENCES `blogRecords` (`idRecord`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blogComments_commGallery`
--
ALTER TABLE `blogComments_commGallery`
  ADD CONSTRAINT `blogComments_commGallery_ibfk_1` FOREIGN KEY (`idComm`) REFERENCES `blogComments` (`idComm`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blogComments_text`
--
ALTER TABLE `blogComments_text`
  ADD CONSTRAINT `blogComments_text_ibfk_1` FOREIGN KEY (`idComm`) REFERENCES `blogComments` (`idComm`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blogComments_thumbs`
--
ALTER TABLE `blogComments_thumbs`
  ADD CONSTRAINT `blogComments_thumbs_ibfk_1` FOREIGN KEY (`idComm`) REFERENCES `blogComments` (`idComm`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blogMap_recordsTags`
--
ALTER TABLE `blogMap_recordsTags`
  ADD CONSTRAINT `blogMap_recordsTags_ibfk_1` FOREIGN KEY (`idRecord`) REFERENCES `blogRecords` (`idRecord`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blogRecords`
--
ALTER TABLE `blogRecords`
  ADD CONSTRAINT `blogRecords_ibfk_1` FOREIGN KEY (`idCat`) REFERENCES `ITEMS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blogRecords_uidfk_1` FOREIGN KEY (`uidRec`) REFERENCES `auth_users` (`uid`);

--
-- Constraints for table `blogRecords_authors`
--
ALTER TABLE `blogRecords_authors`
  ADD CONSTRAINT `blogRecords_authors_ibfk_1` FOREIGN KEY (`idRecord`) REFERENCES `blogRecords` (`idRecord`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blogRecords_authors_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `auth_users` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blogRecords_prior`
--
ALTER TABLE `blogRecords_prior`
  ADD CONSTRAINT `blogRecords_prior_ibfk_1` FOREIGN KEY (`idRecord`) REFERENCES `blogRecords` (`idRecord`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blogRecords_settings`
--
ALTER TABLE `blogRecords_settings`
  ADD CONSTRAINT `blogRecords_settings_ibfk_1` FOREIGN KEY (`idRecord`) REFERENCES `blogRecords` (`idRecord`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blogRecords_settings_ibfk_2` FOREIGN KEY (`idTmpl`) REFERENCES `blogRecord_tmplFiles` (`idTmpl`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `blogRecords_settings_ibfk_4` FOREIGN KEY (`idFormat`) REFERENCES `blogRecord_formats` (`idFormat`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `blogRecords_stats`
--
ALTER TABLE `blogRecords_stats`
  ADD CONSTRAINT `blogRecords_stats_ibfk_1` FOREIGN KEY (`idRecord`) REFERENCES `blogRecords` (`idRecord`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blogRecord_folders`
--
ALTER TABLE `blogRecord_folders`
  ADD CONSTRAINT `blogRecord_folders_ibfk_2` FOREIGN KEY (`idTmpl`) REFERENCES `blogRecord_tmplFiles` (`idTmpl`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `blog_picManager`
--
ALTER TABLE `blog_picManager`
  ADD CONSTRAINT `blog_picManager_ibfk_1` FOREIGN KEY (`idRecord`) REFERENCES `blogRecords` (`idRecord`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating_blog`
--
ALTER TABLE `rating_blog`
  ADD CONSTRAINT `rating_blog_ibfk_1` FOREIGN KEY (`idRecord`) REFERENCES `blogRecords` (`idRecord`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
