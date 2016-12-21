-- MySQL dump 10.15  Distrib 10.0.28-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: localhost
-- ------------------------------------------------------
-- Server version	10.0.28-MariaDB-0ubuntu0.16.10.1

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
-- Table structure for table `Abscence`
--

DROP TABLE IF EXISTS `Abscence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Abscence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `debut_abs` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fich_justificatif` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `fin_abs` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Abscence_User` (`user_id`),
  CONSTRAINT `fk_Abscence_User` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Abscence`
--

LOCK TABLES `Abscence` WRITE;
/*!40000 ALTER TABLE `Abscence` DISABLE KEYS */;
/*!40000 ALTER TABLE `Abscence` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(55) NOT NULL,
  `ine` varchar(50) NOT NULL,
  `EtuId` varchar(50) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:array)',
  `cn` varchar(255) NOT NULL,
  `ufcLibelleDiplome` varchar(255) NOT NULL,
  `ufcLibelleEtape` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (4,'niung','0308012300d','21500429','nicolas.iung@edu.univ-fcomte.fr','a:1:{i:0;s:8:\"ROLE_ETU\";}','iung nicolas','DUT informatique','DUT Informatique 2e année'),(5,'niung','0308012300d','21500429','nicolas.iung@edu.univ-fcomte.fr','a:1:{i:0;s:8:\"ROLE_ETU\";}','iung nicolas','DUT informatique','DUT Informatique 2e année'),(6,'jdessert','0308009187v','21508822','justine.dessertenne@edu.univ-fcomte.fr','a:1:{i:0;s:8:\"ROLE_ETU\";}','dessertenne justine','DUT carrières sociales','DUT carrières sociales opt. services à la personne 2e année');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-16 10:21:19