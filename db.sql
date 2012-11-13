-- --------------------------------------------------------
-- Host:                         linuxpc
-- Server version:               5.5.24-0ubuntu0.12.04.1 - (Ubuntu)
-- Server OS:                    debian-linux-gnu
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2012-09-22 08:10:18
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for GiftList
DROP DATABASE IF EXISTS `GiftList`;
CREATE DATABASE IF NOT EXISTS `GiftList` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `GiftList`;


-- Dumping structure for table GiftList.admin
DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` char(50) DEFAULT '0',
  `last_name` char(50) DEFAULT '0',
  `email` char(100) DEFAULT '0',
  `owner_id` int(11) DEFAULT '0',
  PRIMARY KEY (`admin_id`),
  KEY `FK_admin_owner` (`owner_id`),
  CONSTRAINT `FK_admin_owner` FOREIGN KEY (`owner_id`) REFERENCES `owner` (`owner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table GiftList.comment
DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` char(75) NOT NULL DEFAULT '0',
  `date_time` datetime DEFAULT NULL,
  `gift_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_id`),
  KEY `FK__gift` (`gift_id`),
  CONSTRAINT `FK__gift` FOREIGN KEY (`gift_id`) REFERENCES `gift` (`gift_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table GiftList.gift
DROP TABLE IF EXISTS `gift`;
CREATE TABLE IF NOT EXISTS `gift` (
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
  KEY `FK_gift_taken` (`taken_id`),
  CONSTRAINT `FK_gift_owner` FOREIGN KEY (`owner_id`) REFERENCES `owner` (`owner_id`),
  CONSTRAINT `FK_gift_status` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `FK_gift_taken` FOREIGN KEY (`taken_id`) REFERENCES `taken` (`taken_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table GiftList.gift_link
DROP TABLE IF EXISTS `gift_link`;
CREATE TABLE IF NOT EXISTS `gift_link` (
  `link_id` int(10) NOT NULL AUTO_INCREMENT,
  `alt` char(50) DEFAULT '0',
  `title` char(50) DEFAULT '0',
  `url` text,
  `gift_id` int(11) DEFAULT NULL,
  `pic` char(100) DEFAULT '0',
  PRIMARY KEY (`link_id`),
  KEY `FK_gift_link_gift` (`gift_id`),
  CONSTRAINT `FK_gift_link_gift` FOREIGN KEY (`gift_id`) REFERENCES `gift` (`gift_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table GiftList.menu
DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET latin1 NOT NULL,
  `url` text CHARACTER SET latin1 NOT NULL,
  `status_id` int(10) NOT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `FK_menu_status` (`status_id`),
  CONSTRAINT `FK_menu_status` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table GiftList.owner
DROP TABLE IF EXISTS `owner`;
CREATE TABLE IF NOT EXISTS `owner` (
  `owner_id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` char(50) CHARACTER SET latin1 DEFAULT NULL,
  `last_name` char(50) CHARACTER SET latin1 DEFAULT NULL,
  `email` char(100) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`owner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table GiftList.side_bar
DROP TABLE IF EXISTS `side_bar`;
CREATE TABLE IF NOT EXISTS `side_bar` (
  `side_bar_id` int(10) NOT NULL AUTO_INCREMENT,
  `title` char(50) DEFAULT NULL,
  `content` text,
  `status_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`side_bar_id`),
  KEY `FK_side_bar_status` (`status_id`),
  CONSTRAINT `FK_side_bar_status` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table GiftList.status
DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_text` text,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table GiftList.taken
DROP TABLE IF EXISTS `taken`;
CREATE TABLE IF NOT EXISTS `taken` (
  `taken_id` int(10) NOT NULL AUTO_INCREMENT,
  `taken_name` char(50) DEFAULT '0',
  `taken_text` text,
  PRIMARY KEY (`taken_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
