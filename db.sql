-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: barry    Database: GiftList
-- ------------------------------------------------------
-- Server version	5.5.58-0+deb7u1

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `admin_id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` char(50) DEFAULT '0',
  `last_name` char(50) DEFAULT '0',
  `email` char(100) DEFAULT '0',
  `owner_id` int(11) DEFAULT '0',
  PRIMARY KEY (`admin_id`),
  KEY `FK_admin_owner` (`owner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `comment_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` char(75) NOT NULL DEFAULT '0',
  `date_time` datetime DEFAULT NULL,
  `gift_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_id`),
  KEY `FK__gift` (`gift_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gift`
--

DROP TABLE IF EXISTS `gift`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gift` (
  `gift_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text,
  `num` char(10) DEFAULT NULL,
  `owner_id` int(11) NOT NULL,
  `status_id` int(11) DEFAULT NULL,
  `taken_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`gift_id`),
  KEY `FK_gift_status` (`status_id`),
  KEY `FK_gift_owner` (`owner_id`),
  KEY `FK_gift_taken` (`taken_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gift`
--

LOCK TABLES `gift` WRITE;
/*!40000 ALTER TABLE `gift` DISABLE KEYS */;
/*!40000 ALTER TABLE `gift` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gift_link`
--

DROP TABLE IF EXISTS `gift_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gift_link` (
  `link_id` int(10) NOT NULL AUTO_INCREMENT,
  `alt` char(50) DEFAULT '0',
  `title` char(50) DEFAULT '0',
  `url` text,
  `gift_id` int(11) DEFAULT NULL,
  `pic` char(100) DEFAULT '0',
  PRIMARY KEY (`link_id`),
  KEY `FK_gift_link_gift` (`gift_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gift_link`
--

LOCK TABLES `gift_link` WRITE;
/*!40000 ALTER TABLE `gift_link` DISABLE KEYS */;
/*!40000 ALTER TABLE `gift_link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gift_list`
--

DROP TABLE IF EXISTS `gift_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gift_list` (
  `gift_list_id` int(11) NOT NULL DEFAULT '0',
  `gift_id` int(11) DEFAULT NULL,
  `list_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`gift_list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gift_list`
--

LOCK TABLES `gift_list` WRITE;
/*!40000 ALTER TABLE `gift_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `gift_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `list`
--

DROP TABLE IF EXISTS `list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `list` (
  `list_id` int(11) NOT NULL,
  `status_id` int(11) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `list`
--

LOCK TABLES `list` WRITE;
/*!40000 ALTER TABLE `list` DISABLE KEYS */;
INSERT INTO `list` VALUES (1,1,1,NULL);
/*!40000 ALTER TABLE `list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `menu_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET latin1 NOT NULL,
  `url` text CHARACTER SET latin1 NOT NULL,
  `status_id` int(10) NOT NULL,
  `type_id` int(10) NOT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `FK_menu_status` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `owner`
--

DROP TABLE IF EXISTS `owner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `owner` (
  `owner_id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` char(50) CHARACTER SET latin1 DEFAULT NULL,
  `last_name` char(50) CHARACTER SET latin1 DEFAULT NULL,
  `email` char(100) CHARACTER SET latin1 DEFAULT NULL,
  `user_name` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`owner_id`),
  UNIQUE KEY `user_name_UNIQUE` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `owner`
--

LOCK TABLES `owner` WRITE;
/*!40000 ALTER TABLE `owner` DISABLE KEYS */;
INSERT INTO `owner` VALUES (1,'Kevin','Bollman','KevinBollman@gmail.com','KevinBollman',NULL);
/*!40000 ALTER TABLE `owner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `side_bar`
--

DROP TABLE IF EXISTS `side_bar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `side_bar` (
  `side_bar_id` int(10) NOT NULL AUTO_INCREMENT,
  `title` char(50) DEFAULT NULL,
  `content` text,
  `status_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`side_bar_id`),
  KEY `FK_side_bar_status` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `side_bar`
--

LOCK TABLES `side_bar` WRITE;
/*!40000 ALTER TABLE `side_bar` DISABLE KEYS */;
/*!40000 ALTER TABLE `side_bar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_text` text,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `taken`
--

DROP TABLE IF EXISTS `taken`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `taken` (
  `taken_id` int(10) NOT NULL AUTO_INCREMENT,
  `taken_name` char(50) DEFAULT '0',
  `taken_text` text,
  PRIMARY KEY (`taken_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `taken`
--

LOCK TABLES `taken` WRITE;
/*!40000 ALTER TABLE `taken` DISABLE KEYS */;
/*!40000 ALTER TABLE `taken` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-29 12:15:04
