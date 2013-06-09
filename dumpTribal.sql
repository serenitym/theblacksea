-- MySQL dump 10.13  Distrib 5.5.31, for debian-linux-gnu (x86_64)
--
-- Host: dev.linuxd.net    Database: tribalFest
-- ------------------------------------------------------
-- Server version	5.5.30-1.1-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ITEMS`
--

DROP TABLE IF EXISTS `ITEMS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ITEMS` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `type` char(40) NOT NULL,
  `name_ro` text NOT NULL,
  `name_en` text NOT NULL,
  `SEO` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ITEMS`
--

LOCK TABLES `ITEMS` WRITE;
/*!40000 ALTER TABLE `ITEMS` DISABLE KEYS */;
INSERT INTO `ITEMS` VALUES (1,'sitePrez','Home','Home',NULL),(2,'events','Workshops','Workshops',NULL),(3,'events','Dance Contest','Dance Contest / Open Stage','a:1:{s:2:\"en\";a:4:{s:9:\"title_tag\";s:0:\"\";s:10:\"title_meta\";s:0:\"\";s:16:\"description_meta\";s:0:\"\";s:13:\"keywords_meta\";s:0:\"\";}}'),(4,'single','Bazaar','Bazaar',NULL),(5,'contact','Contact','Contact',NULL),(6,'single','dance contest rules','dance contest rules',NULL),(7,'single','open stage rules','open stage rules',NULL);
/*!40000 ALTER TABLE `ITEMS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MENUS`
--

DROP TABLE IF EXISTS `MENUS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MENUS` (
  `id` int(3) NOT NULL,
  `idM` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MENUS`
--

LOCK TABLES `MENUS` WRITE;
/*!40000 ALTER TABLE `MENUS` DISABLE KEYS */;
INSERT INTO `MENUS` VALUES (1,1),(2,1),(3,1),(4,1),(5,1);
/*!40000 ALTER TABLE `MENUS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TREE`
--

DROP TABLE IF EXISTS `TREE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TREE` (
  `Pid` int(3) NOT NULL,
  `Cid` int(3) NOT NULL,
  `poz` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TREE`
--

LOCK TABLES `TREE` WRITE;
/*!40000 ALTER TABLE `TREE` DISABLE KEYS */;
INSERT INTO `TREE` VALUES (0,1,0),(0,2,1),(0,3,2),(3,6,0),(3,7,1),(0,4,3),(0,5,4);
/*!40000 ALTER TABLE `TREE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `idEv` int(11) NOT NULL AUTO_INCREMENT,
  `idExt` int(11) DEFAULT '0',
  `ev_name` varchar(300) NOT NULL,
  `ev_description` text,
  `ev_date` varchar(10) DEFAULT NULL,
  `ev_hour` varchar(5) DEFAULT NULL,
  `ev_location` varchar(100) DEFAULT NULL,
  `ev_price` int(2) DEFAULT NULL,
  `ev_managersEmails` text,
  `ev_formType` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idEv`),
  KEY `idExt` (`idExt`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,1,'Fast & Furious; Silky Snake - 2 hrs (All Levels)','Ideal for dancers to be able to showcase both of these modes of movement in a balanced and seamless manner.\r\n\r\nSome experience strongly suggested, although class will be taught with multi-level options.\r\n\r\nIn this workshop, you will practice quick, clean execution of isolated locks throughout the body.  You’ll work up a sweat drilling these powerful movements with increasing speed.  Next we will break down those notorious fluid belly dance moves: belly rolls, body rolls, figure 8’s and flowing arms.  You will learn about the musculature behind those difficult movements that are so delicious to watch.  Ever notice the way some dancers make you weak in the knees with their belly rolls?  You’ll discover why, and how to work up to it! \r\nDuring the last section of class, we will discuss using this dichotomy between sharp and fluid in a graceful way, so you can interchange them with ease.  As time allows, we will go through a combo or two that illustrates what you just learned, and then we’ll put it to music and talk about how and when to use these movements so you’re interpreting the music intelligently and beautifully.','11-1-2013','19:00','Arcub Hall, Bucharest',35,'ioana@serenitymedia.ro,\r\nvictor@serenitymedia.ro','workshop'),(2,1,'Catchy Fusion Combos 2 hrs (Intermediate/Advanced)','A few combos to tuck into your coin belt.  These combos include some favorite cabaret and tribal flavors as influences from Jazz, Latin, Hip-Hop, and Polynesian dance.  You’ll practice crisp isolations, elegant arms, smooth hip shapes, fancy turns, and steps inspired by other styles of dance!  We’ll break the complex moves down to their simplest form then add on till they become a show-stopping routine.  Explore traveling circles, snakey figure-eights, sassy poses, and much more!!! \r\n\r\nA basic foundation of bellydance technique recommended.','11-02-2013','12:30','Arcub Hall, Bucharest',35,'ioana@serenitymedia.ro, \r\nvictor@serenitymedia.ro','workshop'),(4,0,'Fusion Dance Competion','<p><img alt=\"\" src=\"http://test.linuxd.net/RES/uploads/images/dansatoare-small.jpg\" style=\"width: 250px; height: 290px; margin-right: 20px; float: left;\" /></p>\r\n\r\n<p><span style=\"font-size:14px;\"><span class=\"vevent\"><span class=\"description\">&nbsp;&nbsp; &nbsp; The Fusion Dance Competition is the first-ever competition of this kind in the</span></span></span></p>\r\n\r\n<p><span style=\"font-size:14px;\"><span class=\"vevent\"><span class=\"description\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Romanian bellydance community.</span></span></span></p>\r\n\r\n<p><span style=\"font-size:14px;\"><span class=\"vevent\"><span class=\"description\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; No traditional Middle Eastern categories. No traditional music. Everything else&nbsp; </span></span></span></p>\r\n\r\n<p><span style=\"font-size:14px;\"><span class=\"vevent\"><span class=\"description\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; goes.</span></span></span></p>\r\n\r\n<p><strong style=\"line-height: 1.6em;\"><em><span style=\"font-size:14px;\"><span class=\"vevent\"><span class=\"description\">&nbsp; &nbsp; &nbsp; This is&nbsp; about innovation and the future of the art of movement.</span></span></span></em></strong></p>\r\n\r\n<p><span style=\"font-size:14px;\">&nbsp; &nbsp; &nbsp; This competition is intended for all semi-professional and professional&nbsp; </span></p>\r\n\r\n<p><span style=\"font-size:14px;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; dancers, </span><span style=\"font-size:14px;\">as well as creative newcomers. Some dance experience is strongly </span></p>\r\n\r\n<p><span style=\"font-size:14px;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; recommended.&nbsp;</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong style=\"font-size: 14px; line-height: 1.6em;\">&nbsp; &nbsp; &nbsp; <span style=\"color:#FF8C00;\">Application deadline:&nbsp; Oct 10th 2013 &nbsp;</span></strong></p>\r\n\r\n<p><span style=\"font-size: 14px; text-align: center; line-height: 1.6em;\">&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; </span></p>\r\n\r\n<p><span style=\"font-size: 14px; text-align: center; line-height: 1.6em;\">&nbsp; &nbsp; &nbsp;Local and International Dancers are invited to BRING IT!</span></p>\r\n\r\n<p><strong style=\"font-size: 14px; line-height: 1.6em;\"><span style=\"color:#8E5F1F;\">&nbsp; &nbsp; &nbsp;</span><a href=\"http://test.linuxd.net/?idT=3&amp;idC=6\"><span style=\"color:#8E5F1F;\">Rules of engagement</span></a></strong></p>\r\n\r\n<p>&nbsp;</p>','11-02-2013','18:00','Arcub Hall, Bucharest',NULL,'victor@serenitymedia.ro','events'),(5,0,'Open Stage','<p><img alt=\"\" src=\"http://test.linuxd.net/RES/uploads/images/gallery/Screen%20Shot%202013-05-31%20at%205.55.42%20PM.png\" style=\"width: 250px; height: 173px; float: left; margin-right: 20px;\" /></p>\r\n\r\n<p><span style=\"font-size:14px;\">Ideal for those dance afficionados who are not into compeating. Take the pressure off and show us what you&#39;ve got!</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:14px;\">This performance opportunity is geared towards the professional and semi professional dancer, but creative newcomers are also encouraged. Some dance experience is strongly recommended. You&#39;ll dance on a beautiful stage, in front of a warm supportive audience.</span></p>\r\n\r\n<p><span style=\"font-size:14px;\"><strong style=\"line-height: 1.6em;\"><a href=\"http://test.linuxd.net/?idT=3&amp;idC=7\"><span style=\"color:#8E5F1F;\">Rules of engagement</span></a></strong></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>','11-3-2013','15:00','Arcub Hall, Bucharest',10,'ioana@serenitymedia.ro, \r\nvictor@serenitymedia.ro',NULL),(6,0,'Premium Package Deal','Includes all 9 workshops & Entrance to the Gala Show.\r\n\r\n\r\nThis is an ideal package for dancers who want to further their skill level and take it up a notch.',NULL,NULL,NULL,235,'andreea.bonea@gmail.com, najah.tribe@gmail.com','event'),(7,2,'From Tribal to Fusion - 2 hrs (All Levels)','We will explore the evolution of Tribal Style through the basics of American Tribal style and the specific technique, which is characteristic for Tribal. We will start with an intense warm up through yoga and drilling. The emphasis will be on understanding the difference between cabaret and Tribal Fusion movements and technique – precise isolations, posture and arm movements will be introduced. This workshop is appropriate for beginners and for advanced dancers, who are looking for an in-depth review of technique and a challenge.','11-1-2013','16:30','Arcub Hall, Bucharest',30,'ioana@serenitymedia.ro, \r\nvictor@serenitymedia.ro',NULL),(8,2,'The silky Upgrade for the Tribal dancer - 2 hrs (Intermediate/Advanced)','Move up a level, develop your body & style and become stronger in your technique. In this workshop, Manca will teach from years of her experience about the complexity of Tribal Fusion movements – how to make them fluid, silky, soft and extended, but at the same time super-strong and dramatic! We will research this complexity trough training of technique and combinations in Manca’s original style.','11-02-2013','10:00','Arcub Hall, Bucharest',30,'ioana@serenitymedia.ro, \r\nvictor@serenitymedia.ro',NULL),(9,2,'Beyond Choreography - 2 hrs (All Levels)','This workshop is not just a simple choreography based-class! You will also get a sneak peek into the creative process and learn how to work trough music interpretation, how to structure a combo and how to come up with new, fresh and exciting moves. You’ll also learn some tricks which will help you when your inspiration in running low. Innovative combinations and moves will move you into a Tribal Fusion choreography. Manca Pavli is an acclaimed choreographer – her best work includes two international touring shows – Orient Under Construction and Bellydance Unveiled.','11-3-2013','10:00','Arcub Hall, Bucharest',30,'ioana@serenitymedia.ro, \r\nvictor@serenitymedia.ro',NULL),(10,2,'Manca\'s Package deal','Includes all 3 workshops',NULL,NULL,NULL,80,'ioana@serenitymedia.ro, \r\nvictor@serenitymedia.ro',NULL),(11,1,'Building Character 2 hrs (All Levels)','How does a dancer create a mood for their piece?  How can we change character to fit the music?  How can costuming affect the performance?  What is stage fright and how do I deal with it?  How can one small person fill a huge stage?\r\n\r\n\r\nBuilding character is a delicate process that requires some experimentation for each individual.  One must learn to take risks on stage, and getting there can be a challenge.  Give life to your dance through musicality, intention, and conviction.  Being a great performer requires not only great technique, but also incredible stage presence.\r\n\r\n\r\nPutting together a performance can be a complex and overwhelming process.  Every aspect deserves attention: from facial expression and characterization to picking the proper moves to fit the music and the color of the costume.  In this workshop, we’ll do acting exercises to awaken your inner diva, practice posture and facial expression, discuss dealing with nerves, dancing musically, and the how to’s of picking music, choreographing, and costuming.','11-3-2013','12:30','Arcub Hall, Bucharest',35,'ioana@serenitymedia.ro, \r\nvictor@serenitymedia.ro',NULL),(12,1,'Ashley\'s Package deal','Includes all 3 workshops',NULL,NULL,NULL,90,'ioana@serenitymedia.ro, \r\nvictor@serenitymedia.ro',NULL),(13,3,'The Creative Lab - 2hrs (All Levels)','With her curriculum in dance and expression, Tjarda’s view on Tribal Fusion could only be an open one. Tjarda is known for her innovative choreographies and creative movement vocabulary. Blurring lines and drawing inspiration from even the most unlikely sources is the opening stance of all her choreographies and classes. In this workshop Tjarda will show you her fun way of creating your own combos to step outside any genre and look for new fusion ideas. Utilizing the elements of dance, such as energy, space, time, breath, etcetera. With some fun tools, tips & trics you will learn how to establish motion and personality in your dancing. Be ready to get inspired!!','11-1-2013','14:00','Arcub Hall, Bucharest',30,'ioana@serenitymedia.ro, \r\nvictor@serenitymedia.ro',NULL),(14,3,'Valuable Technique for Contemporary Fusion - 2 hrs (All Levels)','This workshop is geared towards all level bellydancers and will provide a thorough warm up - to increase power and flexibility - and a carefully balanced cool down. Tjarda focuses on dance movement, posture, alignment, stability and mobility and dynamic presence: technique taught with a magic mix of solid knowledge and fun exercises. At the end of the workshop we will apply this technique to a fun and challenging contemporary fusion combo. Inspired by her studies in modern dance, Tjarda has her own approach of teaching her fusion style to integrate core strength and dance movement to enhance your dancing!','11-02-2013','15:00','Arcub Hall, Bucharest',30,'ioana@serenitymedia.ro, \r\nvictor@serenitymedia.ro',NULL),(15,3,'In a Manner of Speaking - 2 hrs (Intermediate/Advanced)','This workshop is all about how to follow your own pace and staying true to yourself! Dance is a non-verbal-language, a way of expressing ourselves without words, to connect with each other on a deeper level. Everybody has his or her own story to tell. The clearer you articulate your words and sentences, the better the audience will understand what you are saying. Your movement needs to be filled with your energy from beginning to end, so it will be articulated effectively. How does your movement communicate with the audience? We will explore translating different stories through our movement while working with an engaging combination. Intention and body language will have our main focus in this workshop.','11-3-2013','15:00','Arcub Hall, Bucharest',30,'ioana@serenitymedia.ro, \r\nvictor@serenitymedia.ro',NULL),(16,3,'Tjarda\'s Package deal','Includes all 3 workshops',NULL,NULL,NULL,80,'ioana@serenitymedia.ro, \r\nvictor@serenitymedia.ro',NULL),(17,0,'Gala Show','<p><img alt=\"\" class=\"hoverZoomLink\" src=\"http://test.linuxd.net/RES/uploads/images/AFIS%20AMT_small.jpg\" style=\"width: 219px; height: 310px; margin-right: 20px; float: left;\" /></p>\r\n\r\n<p><span style=\"font-size:14px;\">Be delighted with an amazing show.&nbsp; After 3 days of sweaty workshops &amp; a kick ass dance contest, come and see our talented instructors in action and enjoy Tribal Fusion at it&#39;s best. Our Fusion Dance Contest winners will also have the opportunity to perform and enchant you.&nbsp; Lots of other cool surprises...</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:14px;\"><strong><a href=\"http://www.electricbrother.ro\">Electric Brother</a></strong> is also joining our show and is DJing some fusiony tunes for us from his </span></p>\r\n\r\n<p><span style=\"font-size:14px;\">latest album:&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; </span><span style=\"font-size:14px;\"><img alt=\"\" height=\"26\" src=\"http://test.linuxd.net/RES/uploads/images/Screen%20Shot%202013-06-03%20at%201.07.25%20PM.png\" width=\"136\" /></span></p>','11-3-2013','20:00','Arcub Hall, Bucharest',12,'ioana@serenitymedia.ro, \r\nvictor@serenitymedia.ro',NULL);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_registrations`
--

DROP TABLE IF EXISTS `events_registrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_registrations` (
  `idSub` int(5) NOT NULL AUTO_INCREMENT,
  `idEv` int(3) NOT NULL,
  `ev_price` int(3) NOT NULL,
  `usr_name` varchar(200) NOT NULL,
  `usr_email` text NOT NULL,
  `usr_address` text,
  `usr_status` int(1) DEFAULT '0',
  `sub_date` date DEFAULT NULL,
  PRIMARY KEY (`idSub`),
  KEY `idEv` (`idEv`),
  CONSTRAINT `events_registrations_ibfk_1` FOREIGN KEY (`idEv`) REFERENCES `events` (`idEv`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_registrations`
--

LOCK TABLES `events_registrations` WRITE;
/*!40000 ALTER TABLE `events_registrations` DISABLE KEYS */;
INSERT INTO `events_registrations` VALUES (34,9,30,'nume prenume','Promo@promo.ro','Promo address',0,'2013-06-05'),(39,9,30,'nume345','email345','',0,'2013-06-05'),(40,9,30,'nume345','email345','',0,'2013-06-05'),(42,8,30,'dadasda','dasdadada','',0,'2013-06-05'),(43,8,30,'dadasda','dasdadada','',0,'2013-06-05'),(44,8,30,'dadasda','dasdadada','',0,'2013-06-05'),(45,8,30,'dadasda','dasdadada','',0,'2013-06-05'),(46,8,27,'tffgsdfgsdfsd','fsdfsfsfsfsf','',0,'2013-06-05'),(47,10,72,'vcxvzxvczx','czxczxczczc','',0,'2013-06-05'),(48,16,72,'gfdgsdfgsdf','gsdfgsdfgsgdf','',0,'2013-06-05'),(49,16,80,'gfdgsdfgsdf','gsdfgsdfgsgdf','',0,'2013-06-05'),(50,2,35,'nopromo','dadajsdahk','',0,'2013-06-05'),(82,4,20,'ioana Cristea','ioana@serenitymedia.ro','kjdakjdahdhakjdkjhakhd  sdfsfdsf',0,'2013-06-05'),(83,4,20,'iodanc adasd','ioana@serenitymedia.ro','dcasda',0,'2013-06-05'),(84,4,20,'iodanc adasd','ioana@serenitymedia.ro','dcasda',0,'2013-06-05'),(85,4,35,'IOANA IOANA','ioana@serenitymedia.ro','jdakajd ajsjasjd',0,'2013-06-05'),(86,4,35,'IOANAAAAA','ioana@serenitymedia.ro','dddds sda sd asda',0,'2013-06-05'),(87,4,20,'iodai daisd aosid a','ioana@serenitymedia.ro','fdfsf sdf',0,'2013-06-05'),(88,4,20,'WORKS fine','ioana@serenitymedia.ro','mskdjaksjd',0,'2013-06-05'),(89,5,10,'Full testing','ioana@serenitymedia.ro','o anumita adresa pentru un full testing',0,'2013-06-06'),(90,5,10,'again full','ioana@serenitymedia.ro','jdakjd akjdakl',0,'2013-06-06'),(91,5,10,'again full','ioana@serenitymedia.ro','jdakjd akjdakl',0,'2013-06-06'),(92,5,10,'again full','ioana@serenitymedia.ro','jdakjd akjdakl',0,'2013-06-06'),(93,5,10,'again full','ioana@serenitymedia.ro','jdakjd akjdakl',0,'2013-06-06'),(94,5,10,'acum trebe','ioana@serenitymedia.ro','o adresa',1,'2013-06-06'),(95,9,30,'FULLtest','ioana@serenitymedia.ro','addressa addressa addressa',1,'2013-06-06');
/*!40000 ALTER TABLE `events_registrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_vars`
--

DROP TABLE IF EXISTS `events_vars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_vars` (
  `idEv_var` int(11) NOT NULL AUTO_INCREMENT,
  `idEv` int(11) NOT NULL,
  `ev_nameVar` varchar(50) NOT NULL,
  `ev_description` text,
  `ev_price` int(4) NOT NULL,
  PRIMARY KEY (`idEv_var`),
  KEY `idEv` (`idEv`),
  CONSTRAINT `events_vars_ibfk_1` FOREIGN KEY (`idEv`) REFERENCES `events` (`idEv`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=182 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_vars`
--

LOCK TABLES `events_vars` WRITE;
/*!40000 ALTER TABLE `events_vars` DISABLE KEYS */;
INSERT INTO `events_vars` VALUES (147,5,'',NULL,0),(173,17,'',NULL,0),(180,4,'solo',NULL,20),(181,4,'duo / troupe',NULL,35);
/*!40000 ALTER TABLE `events_vars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `idM` int(5) NOT NULL AUTO_INCREMENT,
  `mbr_name` varchar(100) NOT NULL,
  `mbr_picUrl` varchar(200) DEFAULT NULL,
  `mbr_description` text,
  PRIMARY KEY (`idM`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,'Ashley Lopez','RES/uploads/images/instructor/ins3.jpg','<p>In addition to her Bachelor of Music in Vocal Performance, Ashley L&oacute;pez is a world known performer, instructor (her online instructional videos may be found at <a href=\"http://daturaonline.com/\" target=\"_blank\" title=\"http://daturaonline.com/\">Datura Online.</a>), and ever-evolving student of tribal fusion bellydance.&nbsp; Ashley holds Level I &amp; II certifications from <a href=\"http://rachelbrice.com/rb/Welcome.html\" target=\"_blank\" title=\"http://rachelbrice.com/rb/Welcome.html\">Rachel Brice&rsquo;s</a> 8 Elements as well as the Tribal Massive Advanced/Professional Certification Program for 2011 &amp; 2012. She is a certified Group Fitness Instructor through the American Council on Exercise, a Registered Yoga Teacher through Yoga Alliance, holds Pilates certifications Balanced Body University, the Aerobics and Fitness Association of America.<br />\r\n&nbsp;An active soloist and group performer, her most recent dance collaborations include performances with <a href=\"http://beatsantique.bandcamp.com/\" target=\"_blank\" title=\"http://beatsantique.bandcamp.com/\">Beats Antique</a>, <a href=\"http://www.facebook.com/pages/Zoe-Jakes-Official-Fan-Page/289128031424\" target=\"_blank\" title=\"http://www.facebook.com/pages/Zoe-Jakes-Official-Fan-Page/289128031424\">Zoe Jakes</a> and her Bhoomi Project as well as <a href=\"http://rachelbrice.com/rb/Welcome.html\" target=\"_blank\" title=\"http://rachelbrice.com/rb/Welcome.html\">Rachel Brice&rsquo;s</a> performance group for Tribal Fest 2012.</p>\r\n\r\n<p><strong style=\"font-size: 14px; line-height: 1.6em;\">website</strong><span style=\"font-size: 14px; line-height: 1.6em;\">:&nbsp;</span><a href=\"http://www.ashleylopezbellydance.com/\" style=\"font-size: 14px; line-height: 1.6em;\">http://www.ashleylopezbellydance.com/</a></p>'),(2,'Manca Pavli','RES/uploads/images/instructor/ins2.jpg','<p>Manca Pavli is a Slovenian dancer specializing in Tribal style belly dance and Oriental dance technique, teaching dance and performing all over the world.<br />\r\nFor the past four years, Manca has been the teaching assistant for Rachel Brice at the annual Belly Dance Yoga Retreat in Costa Rica. Manca credits Rachel Brice as an important influence on her own teaching techniques and dance style. She is also a Suhaila Salimpour Level 2 certified dancer.<br />\r\nShe was also a guest tribal dancer of the Bellydance Superstars on their Fall 2009 European tour of England, France and Morocco.</p>\r\n\r\n<p>Manca is the artistic director and choreographer of the Amaya Dance Company which last toured Europe with the Infusion Project show.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:14px;\"><strong>website:</strong>&nbsp;<a href=\"http://www.bellydance-fusion.com/\">http://www.bellydance-fusion.com/</a></span></p>'),(3,'Tjarda','RES/uploads/images/instructor/ins4.jpg','<p>Tjarda is a true pioneer of Tribal Fusion Bellydance in The Netherlands. She&#39;s a genuine dancer with a broad-minded curiosity towards fusing bellydance and well-known for her innovative choreographies. Since 2005 she is the inventive force behind award-winning troupe <a href=\"http://www.tjarda.nu/index.php?option=com_content&amp;view=article&amp;id=11&amp;Itemid=13\" target=\"_blank\">The Uzum&eacute; Dance Company</a>&quot;.<br />\r\nTjarda performs solo, with The Uzum&eacute;, The Amano Project, as an&nbsp;honorary member in UNMATA or you can spot her in some new collaborations with Samantha Emanuel/Hasthorpe (BDSS) and Anasma which will be showcased at various festivals.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:14px;\"><strong>website:</strong>&nbsp;<a href=\"http://www.tjarda.nu/\">http://www.tjarda.nu/</a></span></p>');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-06-07 14:21:58
