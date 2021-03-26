-- MySQL dump 10.13  Distrib 5.7.32, for Linux (x86_64)
--
-- Host: localhost    Database: smallbee
-- ------------------------------------------------------
-- Server version	5.7.32

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
-- Table structure for table `computer_devices`
--

DROP TABLE IF EXISTS `computer_devices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `computer_devices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `computer_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `computer_devices`
--

LOCK TABLES `computer_devices` WRITE;
/*!40000 ALTER TABLE `computer_devices` DISABLE KEYS */;
INSERT INTO `computer_devices` VALUES (1,3,1,'2020-11-17 03:12:44','2020-11-17 03:12:44'),(2,3,2,'2020-11-17 04:21:50','2020-11-26 14:29:46'),(3,4,3,'2020-11-18 02:03:44','2020-11-20 03:01:34'),(4,9,4,'2020-11-20 01:34:59','2020-11-20 01:34:59'),(5,3,5,'2020-11-20 02:06:06','2020-11-20 02:06:06'),(6,9,6,'2020-11-20 02:17:10','2020-11-20 02:17:10'),(7,4,7,'2020-11-20 02:20:44','2020-11-20 02:20:44'),(8,9,8,'2020-11-20 02:43:50','2020-11-20 02:43:50'),(9,3,9,'2020-11-20 11:54:54','2020-11-20 11:54:54'),(10,3,10,'2020-11-20 11:56:42','2020-11-20 11:56:42'),(11,10,11,'2020-11-23 07:54:47','2020-11-23 07:54:47'),(12,3,12,'2020-11-25 02:03:43','2020-11-25 02:03:43');
/*!40000 ALTER TABLE `computer_devices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `computers`
--

DROP TABLE IF EXISTS `computers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `computers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `serial_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wan_ip_addr` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `computers_serial_number_unique` (`serial_number`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `computers`
--

LOCK TABLES `computers` WRITE;
/*!40000 ALTER TABLE `computers` DISABLE KEYS */;
INSERT INTO `computers` VALUES (1,'12346578984asdf','192.168.101.17','2020-11-15 22:01:03','2020-11-15 22:01:03','10001',NULL),(2,'asdfaqwer','192.168.0.150','2020-11-15 22:02:27','2020-12-27 09:10:09','10002',NULL),(3,'00:FF:8D:21:1F:AE','192.168.101.127','2020-11-15 23:43:04','2021-02-13 20:44:05','10003','42.6.171.194'),(4,'00:FF:22:00:10:FF','192.168.101.12','2020-11-18 01:04:25','2021-01-27 03:37:41','10004','42.176.236.203'),(5,'00:FF:D1:74:C6:2C','192.168.3.5','2020-11-18 01:24:25','2020-11-18 01:24:25','10005',NULL),(6,'00:FF:A7:BE:AA:FD','192.168.0.8','2020-11-18 02:35:28','2020-12-26 15:03:29','10006',NULL),(7,'84:3A:4B:DA:95:2D','192.168.0.106','2020-11-19 03:28:39','2021-02-08 03:14:47','10007','175.147.146.239'),(8,'02:00:4C:4F:4F:50','169.254.22.36','2020-11-19 05:23:27','2020-11-19 05:23:27','10008',NULL),(9,'6C:62:6D:85:F6:32','192.168.3.5','2020-11-20 01:33:09','2021-01-03 02:30:45','10009','182.202.168.131'),(10,'00:FF:CF:C0:48:8D','192.168.2.223','2020-11-23 06:32:14','2020-11-24 06:57:46','100010',NULL),(11,'123','123','2020-11-23 07:27:15','2020-11-23 07:27:15','100011',NULL),(12,'00:FF:20:CF:99:82','192.168.101.49','2020-11-26 03:05:37','2020-11-26 03:05:37','100012',NULL),(13,'00:FF:4D:FD:28:35','192.168.101.69','2020-11-27 17:44:04','2020-11-27 17:44:04','100013',NULL),(26,'00:FF:7F:D9:BD:19','192.168.101.7','2020-12-27 09:20:59','2021-01-04 00:49:11','100014','223.102.163.33'),(27,'24:F5:AA:C6:27:9E','192.168.0.8','2020-12-27 09:53:36','2021-01-06 12:59:59','100015','220.201.84.221'),(28,'44:06:E8:BD:B2:52','192.168.101.7','2021-01-03 03:26:54','2021-01-03 03:26:54','100016','223.102.163.33'),(29,'00:FF:F7:26:8E:9A','192.168.101.81','2021-01-27 02:20:59','2021-01-27 02:20:59','100017','42.176.236.203'),(30,'02:11:22:33:44:55','192.168.101.82','2021-01-28 01:51:59','2021-01-28 01:51:59','100018','42.176.236.203'),(31,'00:FF:20:22:AB:00','192.168.0.8','2021-01-28 07:07:35','2021-01-28 07:07:35','100019','42.54.88.28'),(32,'8C:8C:AA:21:D9:D3','192.168.3.27','2021-01-30 12:58:49','2021-03-12 00:55:02','100020','182.202.187.190'),(33,'08:9E:01:FC:0D:4A','192.168.0.120','2021-01-31 02:36:35','2021-01-31 02:36:35','100021','60.19.84.126'),(34,'00:0C:29:B3:88:D6','192.168.0.9','2021-01-31 03:32:37','2021-02-26 01:47:03','100022','42.85.28.191'),(35,'00:50:56:C0:00:01','192.168.101.127','2021-02-01 03:41:40','2021-02-01 03:41:40','100023','175.146.175.119'),(36,'80:A5:89:7F:B5:1B','192.168.101.127','2021-02-01 03:43:56','2021-02-01 03:43:56','100024','175.146.175.119'),(37,'00:E0:66:E0:EC:81','192.168.52.4','2021-02-07 12:56:44','2021-03-07 07:49:49','100025','42.176.132.226'),(38,'9C:EB:E8:60:F7:6C','192.168.101.81','2021-02-07 14:28:58','2021-02-22 17:13:23','100026','42.6.171.18'),(39,'D4:AE:52:8C:C9:EA','192.168.2.100','2021-02-07 15:10:29','2021-02-07 15:10:29','100027','222.169.185.102'),(40,'00:E0:4C:07:AE:CE','192.168.52.15','2021-02-08 02:41:36','2021-03-04 07:42:56','100028','42.54.80.234'),(41,'00:FF:3C:8A:12:A9','192.168.101.127','2021-02-15 15:23:22','2021-03-20 11:15:53','100029','42.177.204.29'),(42,'C4:54:44:AE:14:1C','192.168.0.9','2021-02-26 00:24:15','2021-03-24 01:28:01','100030','42.179.115.1'),(43,'00:E0:7A:68:09:25','192.168.0.100','2021-03-08 06:12:15','2021-03-14 09:42:10','100031','58.21.114.220');
/*!40000 ALTER TABLE `computers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `devices`
--

DROP TABLE IF EXISTS `devices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `devices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `serial_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `devices_serial_number_unique` (`serial_number`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devices`
--

LOCK TABLES `devices` WRITE;
/*!40000 ALTER TABLE `devices` DISABLE KEYS */;
INSERT INTO `devices` VALUES (1,'357818083941900.sb',NULL,'2020-11-17 03:12:44','2020-11-17 03:12:44'),(2,'868149039371550.sb',NULL,'2020-11-17 04:21:50','2020-11-17 04:21:50'),(3,'866176035263756.sb',NULL,'2020-11-18 02:03:44','2020-11-18 02:03:44'),(4,'868159033196341.sb',NULL,'2020-11-20 01:34:59','2020-11-20 01:34:59'),(5,'869114041766162.sb',NULL,'2020-11-20 02:06:06','2020-11-20 02:06:06'),(6,'868548033248559.sb',NULL,'2020-11-20 02:17:10','2020-11-20 02:17:10'),(7,'2c4af2c9adfaaa90.sb',NULL,'2020-11-20 02:20:44','2020-11-20 02:20:44'),(8,'99001207267926.sb',NULL,'2020-11-20 02:43:50','2020-11-20 02:43:50'),(9,'864695046948743.sb',NULL,'2020-11-20 11:54:54','2020-11-20 11:54:54'),(10,'864695048076360.sb',NULL,'2020-11-20 11:56:42','2020-11-20 11:56:42'),(11,'864329037265038.sb',NULL,'2020-11-23 07:54:47','2020-11-23 07:54:47'),(12,'865830030101756.sb',NULL,'2020-11-25 02:03:43','2020-11-25 02:03:43');
/*!40000 ALTER TABLE `devices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2020_11_06_030504_create_computers_table',1),(5,'2020_11_06_032456_create_devices_table',1),(6,'2020_11_06_142454_create_computer_devices_table',1),(7,'2020_11_06_142626_create_user_computers_table',1),(8,'2020_11_24_084207_create_resources_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('admin@gmail.com','$2y$10$nZ9WZwC5SFyyIj8p6amt..6YoTnF63MXjMVhh075S51WUCzqwvKna','2021-03-01 04:54:04');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resources`
--

DROP TABLE IF EXISTS `resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resources` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resources`
--

LOCK TABLES `resources` WRITE;
/*!40000 ALTER TABLE `resources` DISABLE KEYS */;
INSERT INTO `resources` VALUES (1,'51_快手.js',9193,'2020-12-16 11:17:18','2021-03-01 04:54:51'),(2,'41_huasan.js',9031,'2020-12-17 03:01:21','2020-12-17 03:01:21');
/*!40000 ALTER TABLE `resources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_computers`
--

DROP TABLE IF EXISTS `user_computers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_computers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `computer_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_computers`
--

LOCK TABLES `user_computers` WRITE;
/*!40000 ALTER TABLE `user_computers` DISABLE KEYS */;
INSERT INTO `user_computers` VALUES (1,2,1,'2020-11-15 22:01:03','2020-11-15 22:01:03'),(2,2,2,'2020-11-15 22:02:27','2020-11-15 22:02:27'),(3,2,3,'2020-11-15 23:43:04','2020-11-15 23:43:04'),(4,2,4,'2020-11-18 01:04:25','2020-11-18 01:04:25'),(5,2,5,'2020-11-18 01:24:25','2020-11-18 01:24:25'),(6,2,6,'2020-11-18 02:35:28','2020-11-18 02:35:28'),(7,2,7,'2020-11-19 03:28:39','2020-11-19 03:28:39'),(8,2,8,'2020-11-19 05:23:28','2020-11-19 05:23:28'),(9,2,9,'2020-11-20 01:33:09','2020-11-20 01:33:09'),(10,2,10,'2020-11-23 06:32:14','2020-11-23 06:32:14'),(11,2,11,'2020-11-23 07:27:15','2020-11-23 07:27:15'),(12,2,12,'2020-11-26 03:05:38','2020-11-26 03:05:38'),(13,2,13,'2020-11-27 17:44:04','2020-11-27 17:44:04'),(14,2,26,'2020-12-27 09:20:59','2020-12-27 09:20:59'),(15,2,27,'2020-12-27 09:53:36','2020-12-27 09:53:36'),(16,2,28,'2021-01-03 03:26:54','2021-01-03 03:26:54'),(17,2,29,'2021-01-27 02:20:59','2021-01-27 02:20:59'),(18,2,30,'2021-01-28 01:51:59','2021-01-28 01:51:59'),(19,2,31,'2021-01-28 07:07:36','2021-01-28 07:07:36'),(20,2,32,'2021-01-30 12:58:49','2021-01-30 12:58:49'),(21,2,33,'2021-01-31 02:36:35','2021-01-31 02:36:35'),(22,2,34,'2021-01-31 03:32:37','2021-01-31 03:32:37'),(23,2,35,'2021-02-01 03:41:40','2021-02-01 03:41:40'),(24,2,36,'2021-02-01 03:43:56','2021-02-01 03:43:56'),(25,2,37,'2021-02-07 12:56:44','2021-02-07 12:56:44'),(26,2,38,'2021-02-07 14:28:58','2021-02-07 14:28:58'),(27,2,39,'2021-02-07 15:10:29','2021-02-07 15:10:29'),(28,2,40,'2021-02-08 02:41:36','2021-02-08 02:41:36'),(29,2,41,'2021-02-15 15:23:22','2021-02-15 15:23:22'),(30,2,42,'2021-02-26 00:24:15','2021-02-26 00:24:15'),(31,2,43,'2021-03-08 06:12:15','2021-03-08 06:12:15');
/*!40000 ALTER TABLE `user_computers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expire_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@gmail.com',NULL,'$2y$10$Ta4/qxjprNgTQ2lxpepAROeSsNd66BTQj7ilSAucqrE9ms1XUaXG2',NULL,'7IUU8r0BC7oo0P4rZ1sZTnxLjUjnIuexITj2jxKs7uDJvZggtESORSsQpkJk','2020-11-15 21:56:49','2020-11-15 21:56:49'),(2,'Mobile star','test@gmaill.com',NULL,'asdfasdf','2021-02-13 22:01:03','rwLpY7u1IigmXGMcTN6bnDQks8pxEA3Lz3DGWdlFlL66XfNNUYbO4iThTmIw','2020-11-15 22:01:03','2020-11-15 22:01:03'),(3,'yangguo','605741690@qq.com',NULL,'$2y$10$PMmWszclhi/6hlIRgGhFS.1WgsanS5xkIDm.DQzEpracZjJ4b6X3i',NULL,NULL,'2020-12-31 06:49:04','2020-12-31 06:49:04'),(4,'Mobile Star','mobilestar920@gmail.com',NULL,'$2y$10$uJ.cDxetBBLtILo5m7j.Yeih9H5racEDH28VsAnL9y8Z1sx45tgiy',NULL,NULL,'2021-03-01 04:54:21','2021-03-01 04:54:21');
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

-- Dump completed on 2021-03-24 18:53:23
