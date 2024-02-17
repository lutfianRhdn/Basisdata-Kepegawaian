-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: 127.0.01    Database: LutfianRahdiansyah_IF4_Kepegawaian
-- ------------------------------------------------------
-- Server version	8.0.36-0ubuntu0.22.04.1

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
-- Table structure for table `golongan`
--

DROP TABLE IF EXISTS `golongan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `golongan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_golongan` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `golongan`
--

LOCK TABLES `golongan` WRITE;
/*!40000 ALTER TABLE `golongan` DISABLE KEYS */;
INSERT INTO `golongan` VALUES (1,'Staff'),(2,'Magang'),(3,'Kontrak'),(4,'Tetap');
/*!40000 ALTER TABLE `golongan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jabatan`
--

DROP TABLE IF EXISTS `jabatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jabatan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jabatan`
--

LOCK TABLES `jabatan` WRITE;
/*!40000 ALTER TABLE `jabatan` DISABLE KEYS */;
INSERT INTO `jabatan` VALUES (1,'Software Enginer'),(2,'Data Enginer'),(3,'Database Enginer'),(4,'Network Enginer');
/*!40000 ALTER TABLE `jabatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pegawai`
--

DROP TABLE IF EXISTS `pegawai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pegawai` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `jabatan_id` int DEFAULT NULL,
  `golongan_id` int DEFAULT NULL,
  `pendidikan_id` int DEFAULT NULL,
  `gaji` decimal(10,2) NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jabatan_id` (`jabatan_id`),
  KEY `golongan_id` (`golongan_id`),
  KEY `pendidikan_id` (`pendidikan_id`),
  CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatan` (`id`),
  CONSTRAINT `pegawai_ibfk_2` FOREIGN KEY (`golongan_id`) REFERENCES `golongan` (`id`),
  CONSTRAINT `pegawai_ibfk_3` FOREIGN KEY (`pendidikan_id`) REFERENCES `pendidikan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pegawai`
--

LOCK TABLES `pegawai` WRITE;
/*!40000 ALTER TABLE `pegawai` DISABLE KEYS */;
INSERT INTO `pegawai` VALUES (1,'Lutfian Rahdiansyah',1,2,1,2000000.00,'aktif'),(3,'Taufiq',4,1,3,20000000.00,'aktif'),(4,'Edwin',2,3,1,1000000.00,'tidak aktif');
/*!40000 ALTER TABLE `pegawai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pendidikan`
--

DROP TABLE IF EXISTS `pendidikan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pendidikan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tingkat` enum('SMA/K','S1','S2','S3') DEFAULT NULL,
  `tempat_pendidikan` varchar(255) NOT NULL,
  `tahun` char(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pendidikan`
--

LOCK TABLES `pendidikan` WRITE;
/*!40000 ALTER TABLE `pendidikan` DISABLE KEYS */;
INSERT INTO `pendidikan` VALUES (1,'S1','Universitas Komputer Indonesia','2019'),(2,'S2','Universitas Komputer Indonesia','2020'),(3,'S3','Universitas Komputer Indonesia','2021'),(4,'S1','Universitas Indonesia','2015');
/*!40000 ALTER TABLE `pendidikan` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-16 16:37:00
