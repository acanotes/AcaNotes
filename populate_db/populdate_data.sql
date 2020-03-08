-- MariaDB dump 10.17  Distrib 10.4.11-MariaDB, for osx10.13 (x86_64)
--
-- Host: localhost    Database: acanotes
-- ------------------------------------------------------
-- Server version	10.4.11-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `acanotes`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `acanotes` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `acanotes`;

--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `announcements` (
  `announcement` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `announcement_index` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcements`
--

LOCK TABLES `announcements` WRITE;
/*!40000 ALTER TABLE `announcements` DISABLE KEYS */;
INSERT INTO `announcements` VALUES ('2/16/2020: Hello and welcome to AcaNotes! This is where we will be delivering our official announcements. As of now, the AcaNotes team is working on a payment system so that you note sharers can earn money from uploading your notes! Prices will be determined by your average ratings and by your popularity amongst your peers (as measured by number of downloads), so start earning points now by sharing your content! Until we get the payment system running, however, all content remains free.\r\n',1);
/*!40000 ALTER TABLE `announcements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notes` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_title` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `a_subject` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `a_author` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `a_date` date NOT NULL,
  `a_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `a_rating` float DEFAULT NULL,
  `a_downloads` int(11) NOT NULL,
  `a_directory` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Dumping data for table `notes`
--

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
INSERT INTO 'notes' VALUES (500, 'ALIU TEST NOTE', 'TOK', 'aliu1324', '2020-03-8 04:55:41.253023', 'ALIUS TEST NOTE DUH', 3.0, 12, 'duhduhduh');
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_first` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_last` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_pwd` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_uid` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(255) NOT NULL AUTO_INCREMENT,
  `user_description` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_rating` float DEFAULT NULL,
  `user_downloads` int(255) NOT NULL DEFAULT 0,
  `user_points` int(11) NOT NULL DEFAULT 0,
  `user_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `vkey` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `createdate` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('AcaNotes','Admin','acanotes@protonmail.com','$2y$10$EnSV4wwR9xCwJX2u8udfEuUlCxU6we.3rdGUn55vkxJhiLdTqFrYu','admin',123,'Hi! This is the AcaNotes admin account.',4,7,0,'Freshie','4455f8173c0b5bee0920f63e2e224dd5',1,'2020-02-16 04:55:41.253023'),('Andrew','Liu','all2209@columbia.edu','$2y$10$qeaizsQe/C8sPbmROeJtSe6ApM0yoDamBj6SR4C6EtkvgVIhFikl6','aliu1324',124,'',NULL,0,0,'Freshie','e6ab4a17c843ecfec75d9996c3ad050f',1,'2020-02-16 04:57:31.850082'),('Emma','Liu','emma.liuosm@gmail.com','$2y$10$ZOLb5d6VzLkKhnTkMsIzbuc68gGbfu2zr5CGBcHPi9G7hbQMkL/2W','ealu',125,'A junior at ISB (International School of Beijing) in her first year of the IBDP! Here to share her ugly notes :)',4,1,0,'Freshie','f8f0daedc2cdd85c967c152d69de260c',1,'2020-02-16 07:51:13.483521'),('Stone','Tao','stao@ucsd.edu','$2y$10$j4mHr1sfrcvP6fRFfNAmHOq4sweOlItmlkYKUOETtDB2rSvMZ0nVy','stonet2000',126,'',NULL,0,0,'Freshie','dc2a014abe210d2b0497a540c8d372a5',1,'2020-02-28 03:19:31.243962'),('Test','Name','test@ucsd.edu','$2y$10$HamGUrA.ex5Ucy8COEqCp.XH.zWD69ZIQS7KzW.xue8uHDFMg7VEO','test',127,'',NULL,0,0,'Freshie','c00a7decb73fe9dc44fb26b290f9e6ca',1,'2020-02-28 03:19:47.761438');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table 'ratings'
--
DROP TABLE IF EXISTS 'ratings';
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE 'ratings'(
  'rating_id' int(11) NOT NULL AUTO_INCREMENT,
  'note_id' int(11) NOT NULL,
  'note_author' varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  'note_rater' varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY('rating_id')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

---
--- Dumping data for table 'ratings'
---
LOCK TABLES 'ratings' WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO 'ratings' VALUES(0, 123, 'aliu1324', 'admin');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-02-27 19:20:05
