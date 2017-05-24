-- MySQL dump 10.13  Distrib 5.7.12, for Win32 (AMD64)
--
-- Host: localhost    Database: localstar8
-- ------------------------------------------------------
-- Server version	5.7.16-log

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
-- Table structure for table `tbappdb`
--

DROP TABLE IF EXISTS `tbappdb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbappdb` (
  `Keyid` int(11) NOT NULL AUTO_INCREMENT,
  `AppId` varchar(45) DEFAULT NULL,
  `SqlCom` varchar(255) DEFAULT NULL,
  `DbCom` varchar(45) DEFAULT NULL,
  `TbName` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Keyid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbappdb`
--

LOCK TABLES `tbappdb` WRITE;
/*!40000 ALTER TABLE `tbappdb` DISABLE KEYS */;
INSERT INTO `tbappdb` VALUES (1,'001','CREATE TABLE `localstar8`.`tbappexec` (','Create','tbappexec');
/*!40000 ALTER TABLE `tbappdb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbappexec`
--

DROP TABLE IF EXISTS `tbappexec`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbappexec` (
  `keyid` int(11) NOT NULL AUTO_INCREMENT,
  `AppID` varchar(45) DEFAULT NULL,
  `AppFilename` varchar(45) DEFAULT NULL,
  `RouteID` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`keyid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbappexec`
--

LOCK TABLES `tbappexec` WRITE;
/*!40000 ALTER TABLE `tbappexec` DISABLE KEYS */;
INSERT INTO `tbappexec` VALUES (1,'001','8.exe','7');
/*!40000 ALTER TABLE `tbappexec` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbappupdate`
--

DROP TABLE IF EXISTS `tbappupdate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbappupdate` (
  `KeyId` int(11) NOT NULL AUTO_INCREMENT,
  `Appid` varchar(45) DEFAULT NULL,
  `AppFilename` varchar(45) DEFAULT NULL,
  `AppDtMod` varchar(45) DEFAULT NULL,
  `AppFileSize` varchar(45) DEFAULT NULL,
  `DbStatus` varchar(45) DEFAULT NULL,
  `RouteId` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`KeyId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbappupdate`
--

LOCK TABLES `tbappupdate` WRITE;
/*!40000 ALTER TABLE `tbappupdate` DISABLE KEYS */;
INSERT INTO `tbappupdate` VALUES (1,'001','8.exe','10/10/2017','12','1','7');
/*!40000 ALTER TABLE `tbappupdate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'localstar8'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-19 20:43:02
