-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: automatic_db
-- ------------------------------------------------------
-- Server version	8.0.19

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
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `serial_leitor` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(36) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contato` varchar(36) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `taxa_deb` decimal(5,2) NOT NULL,
  `taxa_cred_1x` decimal(5,2) NOT NULL,
  `taxa_cred_2x` decimal(5,2) NOT NULL,
  `taxa_cred_3x` decimal(5,2) NOT NULL,
  `taxa_cred_4x` decimal(5,2) NOT NULL,
  `taxa_cred_5x` decimal(5,2) NOT NULL,
  `taxa_cred_6x` decimal(5,2) NOT NULL,
  `taxa_cred_7x` decimal(5,2) NOT NULL,
  `taxa_cred_8x` decimal(5,2) NOT NULL,
  `taxa_cred_9x` decimal(5,2) NOT NULL,
  `taxa_cred_10x` decimal(5,2) NOT NULL,
  `taxa_cred_11x` decimal(5,2) NOT NULL,
  `taxa_cred_12x` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `serial_leitor` (`serial_leitor`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-04 15:10:07
