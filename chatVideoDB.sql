CREATE DATABASE  IF NOT EXISTS `chatdb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `chatdb`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: chatdb
-- ------------------------------------------------------
-- Server version	5.6.21

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
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `mid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(150) DEFAULT '',
  `user_num` int(10) unsigned DEFAULT '0',
  `del` int(1) unsigned DEFAULT '0',
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `msg_count`
--

DROP TABLE IF EXISTS `msg_count`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `msg_count` (
  `mcid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_num` int(10) unsigned DEFAULT '0',
  `message_count` int(10) unsigned DEFAULT '0',
  `del` int(1) unsigned DEFAULT '0',
  PRIMARY KEY (`mcid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `msg_count`
--

LOCK TABLES `msg_count` WRITE;
/*!40000 ALTER TABLE `msg_count` DISABLE KEYS */;
/*!40000 ALTER TABLE `msg_count` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_count`
--

DROP TABLE IF EXISTS `user_count`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_count` (
  `ucid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `del` int(1) unsigned DEFAULT '0',
  `instructor` int(11) DEFAULT NULL,
  `watching` int(11) DEFAULT '-1',
  PRIMARY KEY (`ucid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_count`
--

LOCK TABLES `user_count` WRITE;
/*!40000 ALTER TABLE `user_count` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_count` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video`
--

DROP TABLE IF EXISTS `video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video` (
  `vid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `youtube_id` varchar(50) NOT NULL,
  PRIMARY KEY (`vid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video`
--

LOCK TABLES `video` WRITE;
/*!40000 ALTER TABLE `video` DISABLE KEYS */;
INSERT INTO `video` VALUES (1,'title 1','description 1','dQ2YNKbGqFc'),(2,'title 2','description 2','rIBRcQdzWQs'),(3,'title 3','description 3','UVUwqxuDb9A'),(4,'title 4','description 4','SZUcEmREZ9Y'),(5,'title 5','description 5','tFdlhlmQ-ek'),(6,'title 6','description 6','A6YB233OdSg'),(7,'title 7','description 7','p3PIn2o78nM'),(8,'title 8','description 8','U4S8TxR-AKg'),(9,'title 9','description 9','myatGlT7R4w'),(10,'title 10','description 10','VLW6kT0-qeQ'),(11,'title 11','description 11','S3xeouPc504');
/*!40000 ALTER TABLE `video` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-17 10:24:38
