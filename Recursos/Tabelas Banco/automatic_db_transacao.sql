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
-- Table structure for table `transacao`
--

DROP TABLE IF EXISTS `transacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transacao` (
  `transacao_id` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `cliente_nome` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cliente_email` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `debito_credito` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `tipo_transacao` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `tipo_pagamento` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `valor_bruto` decimal(8,2) NOT NULL,
  `valor_desconto` decimal(8,2) NOT NULL,
  `valor_taxa` decimal(8,2) NOT NULL,
  `valor_liquido` decimal(8,2) NOT NULL,
  `transportadora` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `num_envio` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `data_transacao` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `data_compensacao` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `ref_transacao` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parcelas` int NOT NULL,
  `codigo_usuario` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `codigo_venda` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `serial_leitor` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `recebimentos` int NOT NULL,
  `recebidos` int NOT NULL,
  `valor_recebido` decimal(8,2) NOT NULL,
  `valor_tarifa_intermediacao` decimal(8,2) NOT NULL,
  `valor_taxa_intermediacao` decimal(8,2) NOT NULL,
  `valor_taxa_parcelamento` decimal(8,2) NOT NULL,
  `valor_tarifa_boleto` decimal(8,2) NOT NULL,
  `bandeira_cartao_credito` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `id_cliente` int DEFAULT NULL,
  PRIMARY KEY (`transacao_id`),
  KEY `Transacao_fk0` (`id_cliente`),
  CONSTRAINT `Transacao_fk0` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-04 15:10:06
