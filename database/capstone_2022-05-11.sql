-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: capstone
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.22-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Design',0,'2022-05-03 22:20:55','2022-05-03 22:20:55'),(2,'Frontend',0,'2022-05-03 22:20:55','2022-05-03 22:20:55'),(3,'Backend',0,'2022-05-03 22:20:55','2022-05-03 22:20:55'),(4,'Web Animation',0,'2022-05-03 22:20:55','2022-05-03 22:20:55'),(5,'Web Game',0,'2022-05-03 22:20:55','2022-05-03 22:20:55'),(6,'Security',0,'2022-05-03 22:20:55','2022-05-03 22:20:55'),(7,'Email Marketing',0,'2022-05-03 22:20:55','2022-05-03 22:20:55'),(8,'Maintenance',0,'2022-05-03 22:20:55','2022-05-03 22:20:55'),(9,'Documentation',0,'2022-05-03 22:20:55','2022-05-03 22:20:55');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(36) NOT NULL,
  `postal_code` char(7) NOT NULL,
  `province` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `subscribe_to_newsletter` tinyint(1) NOT NULL DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Jenny','Chung','123 King Street','Winnipeg','R3T 2R2','NA','Canada','(123) 123-1234','lawchunni@yahoo.com.hk','$2y$10$LBjCrLsiJ78JNthaWHnZoedwfQmZ2MWbvWXr1DsOjkv0F1OSUl6qa',1,0,0,'2022-04-22 14:30:31','2022-04-22 14:30:31'),(2,'User1','Test','123 King Street','Winnipeg','R3T 2R2','NA','Canada','(122) 122-4444','lawchunni@gmail.com','$2y$10$5xWYQnCS23zJTLvi6DStZ.RchWkD83EbTB5QYtP3twc.Abkd0DwZ.',0,0,0,'2022-04-22 14:41:44','2022-04-22 14:41:44');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoice` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `subtotal` decimal(10,2) NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL,
  `gst_amount` decimal(8,2) NOT NULL,
  `pst_amount` decimal(8,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_information` longtext NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_invoice_user_idx` (`user_id`),
  CONSTRAINT `fk_invoice_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice`
--

LOCK TABLES `invoice` WRITE;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoiceline`
--

DROP TABLE IF EXISTS `invoiceline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoiceline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `line_price` decimal(10,2) NOT NULL,
  `quantity` varchar(45) NOT NULL,
  `invoice_id` bigint(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_invoiceline_invoice_idx` (`invoice_id`),
  KEY `fk_invoiceline_product_idx` (`product_id`),
  CONSTRAINT `fk_invoiceline_invoice` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`),
  CONSTRAINT `fk_invoiceline_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoiceline`
--

LOCK TABLES `invoiceline` WRITE;
/*!40000 ALTER TABLE `invoiceline` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoiceline` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` VALUES (1,'2022-05-02 00:57:13 | GET | /?p=profile | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 00:57:13'),(2,'2022-05-02 00:57:41 | GET | /?p=profile | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 00:57:41'),(3,'2022-05-02 01:12:01 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 01:12:01'),(4,'2022-05-02 01:29:51 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 01:29:51'),(5,'2022-05-02 01:29:53 | GET | /?p=my-skills | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 01:29:53'),(6,'2022-05-02 01:29:54 | GET | /?p=portfolio | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 01:29:54'),(7,'2022-05-02 01:29:55 | GET | /?p=service-details | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 01:29:55'),(8,'2022-05-02 01:29:56 | GET | /?p=contact-me | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 01:29:56'),(9,'2022-05-02 01:30:07 | GET | /?p=contact-me | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 01:30:07'),(10,'2022-05-02 01:30:08 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 01:30:08'),(11,'2022-05-02 01:30:10 | GET | /?p=profile | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 01:30:10'),(12,'2022-05-02 01:30:12 | GET | /?p=service-details | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 01:30:12'),(13,'2022-05-02 01:30:14 | GET | /?p=portfolio | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 01:30:14'),(14,'2022-05-02 01:41:05 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 01:41:05'),(15,'2022-05-02 01:41:12 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 01:41:12'),(16,'2022-05-02 01:41:28 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 01:41:28'),(17,'2022-05-02 13:59:43 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 13:59:43'),(18,'2022-05-02 14:41:24 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 14:41:24'),(19,'2022-05-02 14:42:33 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 14:42:33'),(20,'2022-05-02 14:42:37 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 14:42:37'),(21,'2022-05-02 14:51:38 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 14:51:38'),(22,'2022-05-02 14:51:40 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 14:51:40'),(23,'2022-05-02 14:52:01 | GET | /?p=register | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 14:52:01'),(24,'2022-05-02 14:52:05 | GET | /?p=register | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 14:52:05'),(25,'2022-05-02 14:52:07 | GET | /?p=login | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 14:52:07'),(26,'2022-05-02 14:52:19 | POST | /?p=process_login | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 14:52:19'),(27,'2022-05-02 14:52:20 | GET | /?p=login | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 14:52:20'),(28,'2022-05-02 14:52:24 | POST | /?p=process_login | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 14:52:24'),(29,'2022-05-02 14:52:25 | GET | /?p=profile | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 14:52:25'),(30,'2022-05-02 15:04:00 | GET | /?p=profile | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 15:04:00'),(31,'2022-05-02 15:04:02 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 15:04:02'),(32,'2022-05-02 15:29:37 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 15:29:37'),(33,'2022-05-02 15:50:08 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 15:50:08'),(34,'2022-05-02 15:50:10 | GET | /?p=portfolio | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 15:50:10'),(35,'2022-05-02 15:50:12 | GET | /?p=service-details | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 15:50:12'),(36,'2022-05-02 15:50:31 | GET | /?p=service-details | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 15:50:31'),(37,'2022-05-02 15:50:33 | GET | /?p=contact-me | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 15:50:33'),(38,'2022-05-02 15:50:39 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 15:50:39'),(39,'2022-05-02 21:43:15 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 21:43:15'),(40,'2022-05-02 21:43:17 | GET | /?p=contact-me | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 21:43:17'),(41,'2022-05-02 21:43:18 | GET | /?p=service-details | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 21:43:18'),(42,'2022-05-02 21:43:20 | GET | /?p=profile | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 21:43:20'),(43,'2022-05-02 21:43:20 | POST | /?p=process_logout | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 21:43:20'),(44,'2022-05-02 21:43:21 | GET | /?p=home | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 21:43:21'),(45,'2022-05-02 21:43:23 | GET | /?p=login | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 21:43:23'),(46,'2022-05-02 21:43:28 | POST | /?p=process_login | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 21:43:28'),(47,'2022-05-02 21:43:29 | GET | /?p=login | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 21:43:29'),(48,'2022-05-02 21:43:32 | POST | /?p=process_login | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 21:43:32'),(49,'2022-05-02 21:43:33 | GET | /?p=login | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 21:43:33'),(50,'2022-05-02 21:43:37 | POST | /?p=process_login | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 21:43:37'),(51,'2022-05-02 21:43:37 | GET | /?p=profile | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 21:43:37');
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image` char(50) NOT NULL,
  `summary` text NOT NULL,
  `description` longtext NOT NULL,
  `technology` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount_available` tinyint(1) NOT NULL DEFAULT 0,
  `discount_rate` float NOT NULL,
  `status` enum('normal','promotion','bundle') NOT NULL DEFAULT 'normal',
  `category_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_product_category_idx` (`category_id`),
  CONSTRAINT `fk_product_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Logo Design','logo-design.jpg','We provide logo design for your company.','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','Graphic Design|Photoshop|Adobe Illustrator',200.00,1,0.1,'normal',1,0,'2022-05-03 23:48:54','2022-05-03 23:48:54'),(2,'Brand Design','brand-design.jpg','Brand design includes the brand color, symbols, fonts, templates to stand out your business from others. Logo design is not included in this service.','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','Graphic Design|Photoshop|Adobe Illustrator',600.00,0,0,'normal',1,0,'2022-05-03 23:48:54','2022-05-03 23:48:54'),(3,'UX Design - Desktop','ux-design-desktop.jpg','User experience (UX) design is the process of creating products that are simple to use and enjoyable to use. You can encourage adoption, retention, and loyalty by designing products that are as simple as possible for users. We will create the desktop version of UX design for you.','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','Web Design|Photoshop|Adobe XD',150.00,0,0,'normal',1,0,'2022-05-03 23:48:54','2022-05-03 23:48:54'),(4,'UX Design - Mobile','ux-design-mobile.jpg','User experience (UX) design is the process of creating products that are simple to use and enjoyable to use. You can encourage adoption, retention, and loyalty by designing products that are as simple as possible for users. We will create the mobile version of UX design for you.','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','Web Design|Photoshop|Adobe XD',150.00,0,0,'normal',1,0,'2022-05-03 23:48:54','2022-05-03 23:48:54'),(5,'UI Design - Desktop','ui-design-desktop.jpg','The user interface (UI) is the area in which humans and machines interact. UI is a component of user experience (UX) that consists of two major components: visual design, which conveys a product\'s look and feel, and interaction design, which is the functional and logical organisation of elements. ','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','Web Design|Photoshop|Adobe XD',150.00,0,0,'normal',1,0,'2022-05-03 23:48:54','2022-05-03 23:48:54'),(6,'UI Design - Mobile','ui-design-mobile.jpg','The user interface (UI) is the area in which humans and machines interact. UI is a component of user experience (UX) that consists of two major components: visual design, which conveys a product\'s look and feel, and interaction design, which is the functional and logical organisation of elements.','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','Web Design|Photoshop|Adobe XD',150.00,0,0,'normal',1,0,'2022-05-03 23:48:54','2022-05-03 23:48:54'),(7,'Website UI Developement','website-ui-developement.jpg','Front-end web development, often called client-side development, is the process of creating HTML, CSS, and JavaScript for a website or Web application so that a user can see and interact with it directly. The difficulty with front end development is that the tools and techniques used to produce the front end of a website are continually changing, necessitating the developer\'s constant awareness of how the field is progressing.','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','HTML5|CSS3|Javascript|jQuery|React|Angular',600.00,0,0,'normal',2,0,'2022-05-03 23:48:54','2022-05-03 23:48:54'),(8,'Database','database.jpg','Database can be used to store the data on your website, which includes customer information, product information, or event website contents.','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','mySQL',360.00,0,0,'normal',3,0,'2022-05-03 23:48:54','2022-05-03 23:48:54'),(9,'Web Hosting','web-hosting.jpg','Web hosting is a service that allows individuals and businesses to publish a website or web page on the Internet.','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','AWS',200.00,0,0,'normal',3,0,'2022-05-03 23:48:54','2022-05-03 23:48:54'),(10,'Internal Search Engine','internal-search-engine.jpg','Search engine on website allows visitors to search for anything by typing a keyword in an input box. ','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','PHP',400.00,0,0,'normal',3,0,'2022-05-03 23:48:54','2022-05-03 23:48:54'),(11,'User Authentication','user-authentication.jpg','The security process that allows users to verify their identities in order to gain access to their personal accounts on a website is known as website authentication.','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','PHP',400.00,0,0,'normal',3,0,'2022-05-03 23:48:54','2022-05-03 23:48:54'),(12,'Content management System','content-management-system.jpg','A content management system, or CMS, is software that allows people to generate, manage, and edit website content without requiring specialist technical skills.','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','PHP|Wordpress',999.99,0,0,'normal',3,0,'2022-05-03 23:48:54','2022-05-03 23:48:54'),(13,'Login System','login-system.jpg','A login page is a web page or website entry page that requires user identification and authentication, which is often accomplished by providing a username and password combination.','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','PHP',600.00,0,0,'normal',3,0,'2022-05-03 23:48:54','2022-05-03 23:48:54'),(14,'Shopping Cart System','shopping-cart-system.jpg','On an online retailer\'s website, a shopping cart is a piece of software that makes purchasing a product or service easier. It receives the customer\'s payment and arranges for the information to be distributed to the merchant, payment processor, and other stakeholders.','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','PHP',600.00,0,0,'normal',3,0,'2022-05-03 23:48:54','2022-05-03 23:48:54'),(15,'Web Animation','web-animation.jpg','There are numerous benefits to incorporating animation into site design. It keeps users on your site for longer, resulting in a lower bounce rate. This indicates that your visitors may spend more time on your page. It piques people\'s interest in your site and motivates them to share it and return.','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','Canvas',700.00,0,0,'normal',4,0,'2022-05-03 23:48:54','2022-05-03 23:48:54'),(16,'Canvas Game','canvas-game.jpg','The canvas element is the most commonly utilised for constructing a video game in JavaScript or executing any other work that requires animations beyond the usual capabilities of CSS transitions and keyframes.','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','Canvas',800.00,0,0,'normal',5,0,'2022-05-03 23:48:54','2022-05-03 23:48:54'),(17,'SSL','ssl.jpg','SSL protects internet connections by preventing hackers from reading or altering data sent between two systems. SSL safeguards the website you\'re visiting if you see a padlock icon next to the URL in the address bar.','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','SSL Certificate',350.00,0,0,'normal',6,0,'2022-05-03 23:48:54','2022-05-03 23:48:54'),(18,'eDM','edm.jpg','Electronic Direct Mail (EDM) is a type of digital marketing approach used by firms to offer products to a list of opted-in potential buyers via email. In addition to EDMs, firms can use cross-channel marketing to reach customers across many platforms.','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','Mailchimp',150.00,0,0,'normal',7,0,'2022-05-03 23:48:54','2022-05-03 23:48:54'),(19,'Website Maintenance Service','website-maintenance-service.jpg','The act of routinely monitoring your website for faults and ensuring that everything is up to date and relevant is known as website maintenance. You must do this on a regular basis in order to keep the website current, safe, and secure. This fosters visitor growth and improves your SEO and Google rankings.','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','All',400.00,0,0,'normal',8,0,'2022-05-03 23:48:54','2022-05-03 23:48:54'),(20,'User Documentation','technical-specification.jpg','User documentation (also known as end user manuals, end user guides, instruction manuals, and so on) is the information you give to customers to help them get the most out of your product or service. <br />These are the instructional materials that come with your product to help someone learn how to use it properly or even assemble it.','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','PDF',200.00,0,0,'normal',9,0,'2022-05-03 23:48:54','2022-05-03 23:48:54');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-04 13:39:20
