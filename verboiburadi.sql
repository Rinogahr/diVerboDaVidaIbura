-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: localhost    Database: verboiburadi
-- ------------------------------------------------------
-- Server version	5.7.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `departamento`
--

DROP TABLE IF EXISTS `departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departamento` (
  `dp_id` int(11) NOT NULL AUTO_INCREMENT,
  `dp_Nome` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `dp_Sala` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dp_Funcao` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mb_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`dp_id`),
  KEY `dp_mb_id_idx` (`mb_id`),
  CONSTRAINT `dp_mb_id` FOREIGN KEY (`mb_id`) REFERENCES `membro` (`mb_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamento`
--

LOCK TABLES `departamento` WRITE;
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
INSERT INTO `departamento` VALUES (1,'Verbinho D.I','Sala de 08 a 11 Anos','Professor',1),(2,'Verbinho D.I','Sala de 08 a 11 Anos','Assistente',3),(3,'Verbinho D.I','Sala de 05 a 07 Anos','Assistente',4),(4,'Verbinho D.I ADM','Sala de 03 a 11 Anos','ADM',2);
/*!40000 ALTER TABLE `departamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membro`
--

DROP TABLE IF EXISTS `membro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `membro` (
  `mb_id` int(11) NOT NULL AUTO_INCREMENT,
  `mb_Nome` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `mb_Sexo` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mb_DataNasc` date DEFAULT NULL,
  `mb_Email` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mb_img` blob,
  PRIMARY KEY (`mb_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membro`
--

LOCK TABLES `membro` WRITE;
/*!40000 ALTER TABLE `membro` DISABLE KEYS */;
INSERT INTO `membro` VALUES (1,'Rodrigo Pedro Maciel','Masculino','1988-11-08','rodrigopedro.m@gmail.com',''),(2,'Elisama Tavares de Sousa','Feminino','1990-09-08','zaminha.minha@gmail.com',''),(3,'Ellen filha de Sheila','Feminino','2000-03-25','elenmakup@hotmail.com',''),(4,'Filipe Lipinho','Masculino','2002-09-15','philip.lipinho@outlook.com','');
/*!40000 ALTER TABLE `membro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `usu_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_Login` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `usu_Senha` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `mb_id` int(11) DEFAULT NULL,
  `usu_recupSenha` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`usu_id`),
  KEY `usu_mb_id_idx` (`mb_id`),
  CONSTRAINT `usu_mb_id` FOREIGN KEY (`mb_id`) REFERENCES `membro` (`mb_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'rinogahr','$2y$10$KNgym0TDfvD9jbJhh4wlKe8TaMa5DCLAx9Ffs0g3JhUmdKFxO3YNO',1,NULL),(2,'minha','$2y$10$Z7nPofojrto5bJCdi/j.ruuFAcCredYQRhhfH.n/170N13oicEyMq',2,NULL),(3,'lipinho','$2y$10$StRLQKbEAeTnI07qWkFkg.BkuprJhoFPVaVbgG2Mx/9iEQALVpVF6',4,NULL),(4,'ellen','$2y$10$/Pf2oEhvfXRQA/qnjDvx0..1xcaSrdFDj4ZrOlO8qTrpiGS7ArNRG',3,NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-28 17:01:57
