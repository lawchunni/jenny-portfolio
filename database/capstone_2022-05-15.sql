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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice`
--

LOCK TABLES `invoice` WRITE;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
INSERT INTO `invoice` VALUES (1,1490.00,60.00,74.50,104.30,1668.80,1,'{\"name\":\"Jenny Chung\",\"street\":\"123 King Street\",\"city\":\"Winnipeg\",\"postal_code\":\"R3T 2R2\",\"province\":\"NA\",\"country\":\"Canada\",\"phone\":\"(123) 123-1234\",\"email\":\"lawchunni@yahoo.com.hk\",\"credit_card\":\"5555\"}','2022-05-11 14:22:42','2022-05-11 14:22:42'),(2,1980.00,20.00,99.00,138.60,2217.60,1,'{\"name\":\"Jenny Chung\",\"street\":\"123 King Street\",\"city\":\"Winnipeg\",\"postal_code\":\"R3T 2R2\",\"province\":\"NA\",\"country\":\"Canada\",\"phone\":\"(123) 123-1234\",\"email\":\"lawchunni@yahoo.com.hk\",\"credit_card\":\"1234\"}','2022-05-14 23:45:07','2022-05-14 23:45:07'),(3,1280.00,20.00,64.00,89.60,1433.60,2,'{\"name\":\"User1 Test\",\"street\":\"123 King Street\",\"city\":\"Winnipeg\",\"postal_code\":\"R3T 2R2\",\"province\":\"NA\",\"country\":\"Canada\",\"phone\":\"(122) 122-4444\",\"email\":\"lawchunni@gmail.com\",\"credit_card\":\"9995\"}','2022-05-15 00:13:43','2022-05-15 00:13:43'),(4,510.00,40.00,25.50,35.70,571.20,2,'{\"name\":\"User1 Test\",\"street\":\"123 King Street\",\"city\":\"Winnipeg\",\"postal_code\":\"R3T 2R2\",\"province\":\"NA\",\"country\":\"Canada\",\"phone\":\"(122) 122-4444\",\"email\":\"lawchunni@gmail.com\",\"credit_card\":\"3333\"}','2022-05-15 02:49:49','2022-05-15 02:49:49'),(5,600.00,0.00,30.00,42.00,672.00,2,'{\"name\":\"User1 Test\",\"street\":\"123 King Street\",\"city\":\"Winnipeg\",\"postal_code\":\"R3T 2R2\",\"province\":\"NA\",\"country\":\"Canada\",\"phone\":\"(122) 122-4444\",\"email\":\"lawchunni@gmail.com\",\"credit_card\":\"8899\"}','2022-05-15 03:21:32','2022-05-15 03:21:32');
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoiceline`
--

LOCK TABLES `invoiceline` WRITE;
/*!40000 ALTER TABLE `invoiceline` DISABLE KEYS */;
INSERT INTO `invoiceline` VALUES (1,'Logo Design',200.00,540.00,'3',1,1),(2,'Website UI Developement',600.00,600.00,'1',1,7),(3,'User Documentation',200.00,200.00,'1',1,20),(4,'UX Design - Desktop',150.00,150.00,'1',1,3),(5,'Logo Design',200.00,180.00,'1',2,1),(6,'Website UI Developement',600.00,600.00,'1',2,7),(7,'Canvas Game',800.00,800.00,'1',2,16),(8,'Internal Search Engine',400.00,400.00,'1',2,10),(9,'Logo Design',200.00,180.00,'1',3,1),(10,'Canvas Game',800.00,800.00,'1',3,16),(11,'eDM',150.00,300.00,'2',3,18),(12,'Logo Design',200.00,360.00,'2',4,1),(13,'UI Design - Mobile',150.00,150.00,'1',4,6),(14,'Website UI Developement',600.00,600.00,'1',5,7);
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
) ENGINE=InnoDB AUTO_INCREMENT=720 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` VALUES (1,'2022-05-02 00:57:13 | GET | /?p=profile | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 00:57:13'),(2,'2022-05-02 00:57:41 | GET | /?p=profile | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 00:57:41'),(3,'2022-05-02 01:12:01 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 01:12:01'),(4,'2022-05-02 01:29:51 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 01:29:51'),(5,'2022-05-02 01:29:53 | GET | /?p=my-skills | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 01:29:53'),(6,'2022-05-02 01:29:54 | GET | /?p=portfolio | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 01:29:54'),(7,'2022-05-02 01:29:55 | GET | /?p=service-details | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 01:29:55'),(8,'2022-05-02 01:29:56 | GET | /?p=contact-me | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 01:29:56'),(9,'2022-05-02 01:30:07 | GET | /?p=contact-me | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 01:30:07'),(10,'2022-05-02 01:30:08 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 01:30:08'),(11,'2022-05-02 01:30:10 | GET | /?p=profile | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 01:30:10'),(12,'2022-05-02 01:30:12 | GET | /?p=service-details | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 01:30:12'),(13,'2022-05-02 01:30:14 | GET | /?p=portfolio | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 01:30:14'),(14,'2022-05-02 01:41:05 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 01:41:05'),(15,'2022-05-02 01:41:12 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 01:41:12'),(16,'2022-05-02 01:41:28 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 01:41:28'),(17,'2022-05-02 13:59:43 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 13:59:43'),(18,'2022-05-02 14:41:24 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 14:41:24'),(19,'2022-05-02 14:42:33 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 14:42:33'),(20,'2022-05-02 14:42:37 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 14:42:37'),(21,'2022-05-02 14:51:38 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 14:51:38'),(22,'2022-05-02 14:51:40 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 14:51:40'),(23,'2022-05-02 14:52:01 | GET | /?p=register | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 14:52:01'),(24,'2022-05-02 14:52:05 | GET | /?p=register | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 14:52:05'),(25,'2022-05-02 14:52:07 | GET | /?p=login | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 14:52:07'),(26,'2022-05-02 14:52:19 | POST | /?p=process_login | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 14:52:19'),(27,'2022-05-02 14:52:20 | GET | /?p=login | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 14:52:20'),(28,'2022-05-02 14:52:24 | POST | /?p=process_login | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 14:52:24'),(29,'2022-05-02 14:52:25 | GET | /?p=profile | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 14:52:25'),(30,'2022-05-02 15:04:00 | GET | /?p=profile | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 15:04:00'),(31,'2022-05-02 15:04:02 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 15:04:02'),(32,'2022-05-02 15:29:37 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 15:29:37'),(33,'2022-05-02 15:50:08 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 15:50:08'),(34,'2022-05-02 15:50:10 | GET | /?p=portfolio | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 15:50:10'),(35,'2022-05-02 15:50:12 | GET | /?p=service-details | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 15:50:12'),(36,'2022-05-02 15:50:31 | GET | /?p=service-details | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 15:50:31'),(37,'2022-05-02 15:50:33 | GET | /?p=contact-me | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 15:50:33'),(38,'2022-05-02 15:50:39 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 15:50:39'),(39,'2022-05-02 21:43:15 | GET | / | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 21:43:15'),(40,'2022-05-02 21:43:17 | GET | /?p=contact-me | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 21:43:17'),(41,'2022-05-02 21:43:18 | GET | /?p=service-details | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 21:43:18'),(42,'2022-05-02 21:43:20 | GET | /?p=profile | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 21:43:20'),(43,'2022-05-02 21:43:20 | POST | /?p=process_logout | 200 | Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36\r\n','2022-05-02 21:43:20');
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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Logo Design','logo-design.jpg','<p>A well-designed logo fosters trust by verifying your professionalism and encourages consumers to stay.</p>\r\n\r\n<p>It informs prospective clients on who you are, what you do, and how it helps them. It conveys to folks who have no prior information or experience with your company that you produce excellent job.</p>','The process of creating a logo can take 3-4 weeks, including data collecting from your organization, draught design, and final design.','Graphic Design|Photoshop|Adobe Illustrator',200.00,1,0.1,'normal',1,0,'2022-05-03 23:48:54','2022-05-15 00:33:20'),(2,'Brand Design','brand-design.jpg','Brand design includes the brand color, symbols, fonts, templates to stand out your business from others. Logo design is not included in this service.','Our brand design service includes below elements:\r\n<ul>\r\n<li>Collect Business goals and brand personality information</li>\r\n<li>Market and user research</li>\r\n<li>Create visual elements of brand</li>\r\n<li>Create style guide</li>\r\n</ul>','Graphic Design|Photoshop|Adobe Illustrator',600.00,0,0,'normal',1,0,'2022-05-03 23:48:54','2022-05-15 00:48:52'),(3,'UX Design - Desktop','','User experience (UX) design is the process of creating products that are simple to use and enjoyable to use. You can encourage adoption, retention, and loyalty by designing products that are as simple as possible for users. We will create the desktop version of UX design for you.','What to expect: <br /><br />\r\nDesktop version wireframe and prototype of a website.','Web Design|Photoshop|Adobe XD',150.00,0,0,'normal',1,0,'2022-05-03 23:48:54','2022-05-15 03:26:10'),(4,'UX Design - Mobile','ux-design-mobile.jpg','User experience (UX) design is the process of creating products that are simple to use and enjoyable to use. You can encourage adoption, retention, and loyalty by designing products that are as simple as possible for users. We will create the mobile version of UX design for you.','What to expect: <br /><br />\r\nMobile version wireframe and prototype of a website.','Web Design|Photoshop|Adobe XD',150.00,0,0,'normal',1,0,'2022-05-03 23:48:54','2022-05-15 00:49:36'),(5,'UI Design - Desktop','ui-design-desktop.jpg','The user interface (UI) is the area in which humans and machines interact. UI is a component of user experience (UX) that consists of two major components: visual design, which conveys a product\'s look and feel, and interaction design, which is the functional and logical organisation of elements. ','What to expect: \r\n<p>Graph design of the actual look and feel of the website - desktop version only.</p>\r\n<p><strong>Output:</strong></p>\r\n<p>Adobe XD & png image</p>','Web Design|Photoshop|Adobe XD',150.00,0,0,'normal',1,0,'2022-05-03 23:48:54','2022-05-15 00:54:43'),(6,'UI Design - Mobile','ui-design-mobile.jpg','The user interface (UI) is the area in which humans and machines interact. UI is a component of user experience (UX) that consists of two major components: visual design, which conveys a product\'s look and feel, and interaction design, which is the functional and logical organisation of elements.','What to expect: \r\n<p>Graph design of the actual look and feel of the website - mobile version only.</p>\r\n<p><strong>Output:</strong></p>\r\n<p>Adobe XD & png image</p>','Web Design|Photoshop|Adobe XD',150.00,0,0,'normal',1,0,'2022-05-03 23:48:54','2022-05-15 00:54:34'),(7,'Website UI Developement','website-ui-developement.jpg','Front-end web development, often called client-side development, is the process of creating HTML, CSS, and JavaScript for a website or Web application so that a user can see and interact with it directly. The difficulty with front end development is that the tools and techniques used to produce the front end of a website are continually changing, necessitating the developer\'s constant awareness of how the field is progressing.','What to expect: \r\n<ul>\r\n<li>The actual website to interact with for the frontend part</li>\r\n<li>Desktop version and Mobile version</li>\r\n<li>CSS style animation</li>\r\n</ul>\r\n','HTML5|CSS3|Javascript|jQuery|React|Angular',600.00,0,0,'normal',2,0,'2022-05-03 23:48:54','2022-05-15 01:00:51'),(8,'Database','database.jpg','Database can be used to store the data on your website, which includes customer information, product information, or event website contents.','When do you need a database for your software / website:\r\n<ul>\r\n<li><strong>Organizes and manages large volumes of data</strong><br />On a daily basis, a database stores and maintains a significant quantity of data. This would be impossible to achieve with any other tool, such as a spreadsheet, because they just do not function.</li>\r\n<li><strong>Easily updating data</strong><br />It is simple to change data in a database.</li>\r\n<li><strong>Data security</strong><br />Databases use a variety of approaches to secure data security. Before accessing a database, users must log in and specific access specifiers must be met. These restrict database access to just authorised users.</li> \r\n</ul>','mySQL',360.00,0,0,'normal',3,0,'2022-05-03 23:48:54','2022-05-15 01:12:39'),(9,'Web Hosting','web-hosting.jpg','Web hosting is a service that allows individuals and businesses to publish a website or web page on the Internet.','We use a cloud web hosting on Amazon Web Services (AWS) for your website. Please contact us for more details before purchasing.','AWS',200.00,0,0,'normal',3,0,'2022-05-03 23:48:54','2022-05-15 01:17:46'),(10,'Internal Search Engine','internal-search-engine.jpg','Search engine on website allows visitors to search for anything by typing a keyword in an input box. ','After the search feature is built, users will be able to search for any content in the website. ','PHP',400.00,0,0,'normal',3,0,'2022-05-03 23:48:54','2022-05-15 01:22:35'),(11,'User Authentication','user-authentication.jpg','The security process that allows users to verify their identities in order to gain access to their personal accounts on a website is known as website authentication.','Users enter their information into the website\'s login form. That data is then transferred to the authentication server, where it is compared to all of the user credentials in database. When a match is found, the system authenticates users and grants them access to their accounts.','PHP',400.00,0,0,'normal',3,0,'2022-05-03 23:48:54','2022-05-15 01:25:47'),(12,'Content Management System','content-management-system.jpg','A content management system, or CMS, is software that allows people to generate, manage, and edit website content without requiring specialist technical skills.','Benefit of using a Content Management System:\r\n<ul>\r\n<li>Users could quickly generate and organize material with content creation.</li>\r\n<li>Content storage is the storing of content in a single location in a consistent manner.</li>\r\n<li>Workflows assign rights for content management depending on roles such as authors, editors, and administrators.</li>\r\n<li>Content is published, organised, and pushed live.</li>\r\n</ul>','PHP|Wordpress',999.99,1,0.5,'normal',3,0,'2022-05-03 23:48:54','2022-05-15 02:23:02'),(13,'Login System','login-system.jpg','A login page is a web page or website entry page that requires user identification and authentication, which is often accomplished by providing a username and password combination.','Login steps:\r\n<ul>\r\n<li>Users will be prompted for their username and password.</li>\r\n<li>Users\' credentials will then be transferred to the website\'s server, where they will be compared to the information on file.</li>\r\n<li>Once a password match is found, users will be able to access their account.</li>\r\n</ul>','PHP',600.00,0,0,'normal',3,0,'2022-05-03 23:48:54','2022-05-15 01:32:33'),(14,'Shopping Cart System','shopping-cart-system.jpg','On an online retailer\'s website, a shopping cart is a piece of software that makes purchasing a product or service easier. It receives the customer\'s payment and arranges for the information to be distributed to the merchant, payment processor, and other stakeholders.','We will customize the shopping cart ordering flow for your website. The steps of a shopping cart system may includes:\r\n<ul>\r\n<li>Add items to shopping cart</li>\r\n<li>Checkout shopping cart</li>\r\n<li>Insert billing info</li>\r\n<li>Insert shipping info</li>\r\n<li>Choose shipping method</li>\r\n<li>preview order</li>\r\n<li>payment</li>\r\n<li>confirmation</li>\r\n</ul>','PHP',600.00,0,0,'normal',3,0,'2022-05-03 23:48:54','2022-05-15 01:37:52'),(15,'Web Animation','web-animation.jpg','There are numerous benefits to incorporating animation into site design. It keeps users on your site for longer, resulting in a lower bounce rate. This indicates that your visitors may spend more time on your page. It piques people\'s interest in your site and motivates them to share it and return.','Please contact us to discount the best solution for your web animation before payment.','Canvas',700.00,0,0,'normal',4,0,'2022-05-03 23:48:54','2022-05-15 01:39:39'),(16,'Canvas Game','canvas-game.jpg','The canvas element is the most commonly utilised for constructing a video game in JavaScript or executing any other work that requires animations beyond the usual capabilities of CSS transitions and keyframes.','A canvas game might be one of your finest solutions for attracting web visitors and making your website look enjoyable! Contact us and tell us about your website\'s purpose, and we\'ll create the best game for you!','Canvas',800.00,0,0,'normal',5,0,'2022-05-03 23:48:54','2022-05-15 01:43:20'),(17,'SSL','ssl.jpg','SSL protects internet connections by preventing hackers from reading or altering data sent between two systems. SSL safeguards the website you\'re visiting if you see a padlock icon next to the URL in the address bar.','To secure the website from cross-site attacks, a Secure Sockets Layer (SSL) will be installed in the web server by using a commercial certificate.','SSL Certificate',350.00,0,0,'normal',6,0,'2022-05-03 23:48:54','2022-05-15 01:45:17'),(18,'eDM','edm.jpg','Electronic Direct Mail (EDM) is a type of digital marketing approach used by firms to offer products to a list of opted-in potential buyers via email. In addition to EDMs, firms can use cross-channel marketing to reach customers across many platforms.','We will design the look and feel, create the HTML and CSS of the eDM for you. Mailchimp will be used to send out the email marketing campaigns to your customers.','Mailchimp',150.00,0,0,'normal',7,0,'2022-05-03 23:48:54','2022-05-15 04:12:20'),(19,'Website Maintenance Service','website-maintenance-service.jpg','The act of routinely monitoring your website for faults and ensuring that everything is up to date and relevant is known as website maintenance. You must do this on a regular basis in order to keep the website current, safe, and secure. This fosters visitor growth and improves your SEO and Google rankings.','Our web maintenance service includes:\r\n<ul>\r\n<li>Updating Website Software</li>\r\n<li>Improving Website Speed</li>\r\n<li>Fixing HTML Errors</li>\r\n<li>Backing up Files</li>\r\n<li>Developing New Content</li>\r\n<li>Fixing Broken Links</li>\r\n</ul>','All',400.00,0,0,'normal',8,0,'2022-05-03 23:48:54','2022-05-15 01:50:46'),(20,'User Documentation','technical-specification.jpg','User documentation (also known as end user manuals, end user guides, instruction manuals, and so on) is the information you give to customers to help them get the most out of your product or service. <br />These are the instructional materials that come with your product to help someone learn how to use it properly or even assemble it.','We offer user documentation of your website for your users! The document types may include:\r\n<ul>\r\n<li>Document description which gives a full description of the product</li>\r\n<li>Installation and Setup Guide</li>\r\n<li>Product / User Manual.</li>\r\n</ul>','PDF',300.00,0,0,'normal',9,0,'2022-05-03 23:48:54','2022-05-15 03:28:11');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Admin','User','123 King Street','Winnipeg','R1N 6G6','Manitoba','Canada','(999) 798-6363','admin@jennywebservices.xyz','$2y$10$M.zKcNWtlktOqOT4Z1hVVOZ7JcR70.KVEd5ysJcjI9pbvzapq8EnC',1,0,0,'2022-05-15 04:22:02','2022-05-15 04:23:12'),(2,'Test','User','123 King Street','Winnipeg','R1N 6G6','Manitoba','Canada','(889) 621-3698','user@test.com','$2y$10$trkMNymfnDuQSFjainmop./no2NSefBsmp3vdeW8KWDf6XQCSxGVS',0,0,0,'2022-05-15 04:24:30','2022-05-15 04:24:30');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-15  4:34:56
