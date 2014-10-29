CREATE DATABASE  IF NOT EXISTS `fri_sandbox` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `fri_sandbox`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: fri_sandbox
-- ------------------------------------------------------
-- Server version	5.6.20

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
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `published` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (1,'Lorem ipsum dolor sit amet','Lorem ipsum dolor sit amet consectetuer nec tincidunt rhoncus dolor nibh. Pretium ligula enim sed pellentesque orci pretium Maecenas vel semper eget. Pellentesque consectetuer leo laoreet tincidunt semper Nulla nulla non ligula semper. Neque sed Maecenas Integer tortor mollis velit laoreet eu orci non. Orci convallis non magnis et orci eu Sed.\r\n\r\n','2014-10-01 00:00:00'),(2,'Accumsan ligula et enim lacinia','Accumsan ligula et enim lacinia Sed condimentum Phasellus convallis neque consectetuer. Suspendisse porttitor facilisis Aliquam urna hendrerit euismod at vitae interdum elit. Nulla Curabitur adipiscing congue et rhoncus montes sociis urna eget ultrices. Adipiscing Phasellus tempor adipiscing consequat enim et purus In nunc venenatis. Tincidunt metus libero Nam mus consequat eget Curabitur ut quis consectetuer. Sit dignissim quis malesuada Nam porta ante rutrum nulla dignissim nunc. Turpis adipiscing In.','2014-10-02 00:00:00'),(3,'Dolor lorem orci consequat nibh','Dolor lorem orci consequat nibh tincidunt tellus dfdddddddddddddvitae ligula interdum cursus. Semper congue mattis ac velit nunc at pretium in pellentesque laoreet. Nulla turpis vitae condimentum eget Aenean Aliquam Phasellus Lorem mollis Nunc. Et pretium nulla Donec magnis consequat consectetuer pede convallis ligula faucibus. Pellentesque ac gravida orci elit netus Vestibulum Nullam vel nibh turpis. Eros pede id fames vel at venenatis turpis.','2014-10-03 00:00:00'),(4,'dddd','ddd','2014-10-19 23:11:28');
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meno` varchar(64) DEFAULT NULL,
  `priezvisko` varchar(64) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `heslo` varchar(64) DEFAULT NULL,
  `vek` int(11) DEFAULT NULL,
  `datum` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Juraj','Lúdik','juraj.ludik@gmail.com','123456789',23,'2014-10-28 16:38:51'),(2,'Marek','?a?ko','m.cacko@gmail.com','123456789',22,NULL),(3,'Peter','Matula','p.matula@gmail.com','123456789',25,'2014-10-25 13:32:02'),(4,'Jozef','Malo','jozef.malo@gmail.com','123456789',28,NULL),(5,'Tibor','Karas','t.karas@gmail.com','123456789',30,NULL),(6,'Juraj','Mrkvi?ka','j.m@azet.sk','123456789',16,NULL),(7,'Andrej','Krá?','andrejko@azet.sk','123456789',17,NULL),(8,'Miachaela','Mrkvi?ková','m.mrkvickova@gmail.com','123456789',32,NULL),(9,'Janka','Krivosová','j.krivonosa@gmail.com','123456789',22,NULL),(10,'Marek','Matula','sportovec@gmail.com','123456789',23,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_group`
--

DROP TABLE IF EXISTS `user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_group` (
  `iduser` int(11) NOT NULL,
  `idusergroup` int(11) NOT NULL,
  PRIMARY KEY (`iduser`,`idusergroup`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_group`
--

LOCK TABLES `user_group` WRITE;
/*!40000 ALTER TABLE `user_group` DISABLE KEYS */;
INSERT INTO `user_group` VALUES (1,2),(1,4),(1,6),(2,2),(2,3),(2,4),(3,1),(4,1),(4,3),(4,4),(4,5),(5,1),(6,2),(7,3),(7,4),(7,5),(8,1),(8,2),(8,4),(9,1),(10,1),(10,2),(10,3),(10,4),(10,5);
/*!40000 ALTER TABLE `user_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usergroup`
--

DROP TABLE IF EXISTS `usergroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usergroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazov` varchar(64) COLLATE utf8_slovak_ci DEFAULT NULL,
  `popis` varchar(255) COLLATE utf8_slovak_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `nazov_UNIQUE` (`nazov`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usergroup`
--

LOCK TABLES `usergroup` WRITE;
/*!40000 ALTER TABLE `usergroup` DISABLE KEYS */;
INSERT INTO `usergroup` VALUES (1,'Športovci','sportujeme cely den'),(2,'Informatici','radi programujeme od rana do vecera'),(3,'Kuchári','kuchtime'),(4,'Pivo','pijeme pivo'),(5,'Domov','sedime doma'),(6,'Slovensko','Vsetko o slovensku');
/*!40000 ALTER TABLE `usergroup` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-10-29  8:53:19
