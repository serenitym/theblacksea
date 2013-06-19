
CREATE TABLE IF NOT EXISTS `members` (
  `idM` int(5) NOT NULL AUTO_INCREMENT,
  `mbr_name` varchar(100) NOT NULL,
  `mbr_picUrl` varchar(200) DEFAULT NULL,
  `mbr_description` text,
  PRIMARY KEY (`idM`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `idEv`              int(11) NOT NULL AUTO_INCREMENT,
  `idExt`             int(11) NOT NULL,
  `ev_name`           varchar(300) NOT NULL,
  `ev_description`    text,
  `ev_date`           varchar(10) DEFAULT NULL,
  `ev_hour`           varchar(5) DEFAULT NULL,
  `ev_location`       varchar(100) DEFAULT NULL,
  `ev_price`          int(2) DEFAULT NULL,
  `ev_managersEmails` text,
  `ev_formType`       varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idEv`),
  KEY `idExt` (`idExt`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`idExt`) REFERENCES `members` (`idM`) ON DELETE CASCADE ON UPDATE CASCADE;



--
-- Table structure for table `events_vars`
--

CREATE TABLE IF NOT EXISTS `events_vars` (
  `idEv_var` int(11) NOT NULL AUTO_INCREMENT,
  `idEv` int(11) NOT NULL,
  `ev_nameVar` int(11) NOT NULL,
  `ev_description` int(11) DEFAULT NULL,
  `ev_price` int(11) NOT NULL,
  PRIMARY KEY (`idEv_var`),
  KEY `idEv` (`idEv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- Constraints for table `events_vars`
--
ALTER TABLE `events_vars`
  ADD CONSTRAINT `events_vars_ibfk_1` FOREIGN KEY (`idEv`) REFERENCES `events` (`idEv`) ON DELETE CASCADE ON UPDATE CASCADE;



--
-- Table structure for table `events_registrations`
--

CREATE TABLE IF NOT EXISTS `events_registrations` (
  `idSub`       int(5) NOT NULL AUTO_INCREMENT,
  `idEv`        int(3) NOT NULL,
  `ev_price`    int(3) NOT NULL,
  `usr_name`    varchar(200) NOT NULL,
  `usr_email`   text NOT NULL,
  `usr_address` text,
  `usr_status`  int(1) DEFAULT '0',
  `sub_date`    date DEFAULT NULL,
  PRIMARY KEY (`idUsr`),
  KEY `idEv` (`idEv`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events_registrations`
--
ALTER TABLE `events_registrations`
  ADD CONSTRAINT `events_registrations_ibfk_1` FOREIGN KEY (`idEv`) REFERENCES `events` (`idEv`) ON DELETE CASCADE ON UPDATE CASCADE;
