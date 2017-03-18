-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: foodee
-- ------------------------------------------------------
-- Server version	5.7.17-log

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
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime(6) NOT NULL,
  `content` varchar(1024) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `fonda_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comment_user_id_fk_idx` (`user_id`),
  KEY `comment_fonda_id_fk_idx` (`fonda_id`),
  CONSTRAINT `comment_fonda_id_fk` FOREIGN KEY (`fonda_id`) REFERENCES `fonda` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `comment_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `culinary`
--

DROP TABLE IF EXISTS `culinary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `culinary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Loại ẩm thực';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `culinary`
--

LOCK TABLES `culinary` WRITE;
/*!40000 ALTER TABLE `culinary` DISABLE KEYS */;
INSERT INTO `culinary` VALUES (1,'Cà phê'),(2,'Món lẩu'),(3,'Món Thái'),(4,'Món Hàn'),(5,'Món nướng');
/*!40000 ALTER TABLE `culinary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dainty`
--

DROP TABLE IF EXISTS `dainty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dainty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COMMENT='Món ăn.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dainty`
--

LOCK TABLES `dainty` WRITE;
/*!40000 ALTER TABLE `dainty` DISABLE KEYS */;
INSERT INTO `dainty` VALUES (1,'Chả giò cá lóc'),(2,'Đậu hủ chiên'),(3,'Đậu hủ tứ xuyên'),(4,'Đậu hủ thúi'),(5,'Súp cua tóc tiên'),(6,'Súp nha đam hải sản'),(7,'Súp hải sản chua cay'),(8,'Lẩu gà tre nấm tươi'),(9,'Gà đồng hầm củ cải'),(10,'Lẩu cá bóp'),(11,'Lẩu hải sản chua ngọt'),(12,'Cơm cháy kho quẹt'),(13,'Lẩu cua đồng'),(14,'Ốc hương ra muối'),(15,'Sò huyết nướng'),(16,'Mực nướng muối ớt'),(17,'Sườn hầm bí đỏ'),(18,'Sườn heo ram mặn'),(19,'Cua rang me'),(20,'Cà phê Capuccino'),(21,'Cà phê Espresso'),(22,'Cà phê Latte'),(23,'Cà phê Mocha'),(24,'Cà phê đá'),(25,'Cà phê sữa đá'),(26,'Bạc sỉu');
/*!40000 ALTER TABLE `dainty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dainty_group`
--

DROP TABLE IF EXISTS `dainty_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dainty_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dainty_group`
--

LOCK TABLES `dainty_group` WRITE;
/*!40000 ALTER TABLE `dainty_group` DISABLE KEYS */;
INSERT INTO `dainty_group` VALUES (1,'Empty'),(2,'Món ăn nhanh'),(3,'Món khai vị'),(4,'Súp'),(5,'Rượu'),(6,'Hải sản'),(7,'Rau'),(8,'Lẩu'),(9,'Các món gỏi'),(10,'Cà phê'),(11,'Thức uống trái cây'),(12,'Rượu nhẹ'),(13,'Kem');
/*!40000 ALTER TABLE `dainty_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fonda`
--

DROP TABLE IF EXISTS `fonda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fonda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `location_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `scale` int(11) NOT NULL,
  `open_time` time DEFAULT NULL,
  `close_time` time DEFAULT NULL,
  `open_day` int(11) DEFAULT NULL,
  `phone_1` varchar(16) DEFAULT NULL,
  `phone_2` varchar(16) DEFAULT NULL,
  `min_price` float DEFAULT NULL,
  `max_price` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `location_id_fk_idx` (`location_id`),
  KEY `fonda_group_id_fk_idx` (`group_id`),
  CONSTRAINT `fonda_group_id_fk` FOREIGN KEY (`group_id`) REFERENCES `fonda_group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `location_id_fk` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Cửa hàng, nhà hàng, quán ăn cà phê';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fonda`
--

LOCK TABLES `fonda` WRITE;
/*!40000 ALTER TABLE `fonda` DISABLE KEYS */;
/*!40000 ALTER TABLE `fonda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fonda_culinary`
--

DROP TABLE IF EXISTS `fonda_culinary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fonda_culinary` (
  `fonda_id` int(11) NOT NULL,
  `culinary_id` int(11) NOT NULL,
  PRIMARY KEY (`fonda_id`,`culinary_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fonda_culinary`
--

LOCK TABLES `fonda_culinary` WRITE;
/*!40000 ALTER TABLE `fonda_culinary` DISABLE KEYS */;
/*!40000 ALTER TABLE `fonda_culinary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fonda_dainty`
--

DROP TABLE IF EXISTS `fonda_dainty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fonda_dainty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fonda_id` int(11) NOT NULL,
  `dainty_id` int(11) NOT NULL,
  `price` varchar(45) NOT NULL,
  `create_date` datetime(6) DEFAULT NULL,
  `is_sale` tinyint(4) NOT NULL DEFAULT '0',
  `percent_sale` int(11) DEFAULT NULL,
  `price_sale` float DEFAULT NULL,
  `dainty_group_id` int(11) DEFAULT NULL,
  `description` varchar(512) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `is_featured` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fonda_dainty_dainty_group_id_fk_idx` (`dainty_group_id`),
  KEY `fonda_dainty_fonda_id_fk_idx` (`fonda_id`),
  KEY `fonda_dainty_dainty_id_fk_idx` (`dainty_id`),
  CONSTRAINT `fonda_dainty_dainty_group_id_fk` FOREIGN KEY (`dainty_group_id`) REFERENCES `dainty_group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fonda_dainty_dainty_id_fk` FOREIGN KEY (`dainty_id`) REFERENCES `dainty` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fonda_dainty_fonda_id_fk` FOREIGN KEY (`fonda_id`) REFERENCES `fonda` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Món của một quán';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fonda_dainty`
--

LOCK TABLES `fonda_dainty` WRITE;
/*!40000 ALTER TABLE `fonda_dainty` DISABLE KEYS */;
/*!40000 ALTER TABLE `fonda_dainty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fonda_group`
--

DROP TABLE IF EXISTS `fonda_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fonda_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='Nhóm nhà hàng.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fonda_group`
--

LOCK TABLES `fonda_group` WRITE;
/*!40000 ALTER TABLE `fonda_group` DISABLE KEYS */;
INSERT INTO `fonda_group` VALUES (1,'Quán cà phê bình dân'),(2,'Quán ăn gia đình'),(3,'Nhà hàng bình dân'),(4,'Buffet'),(5,'Vỉa hè'),(6,'Nhà hàng'),(7,'Quán cà phê');
/*!40000 ALTER TABLE `fonda_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fonda_utility`
--

DROP TABLE IF EXISTS `fonda_utility`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fonda_utility` (
  `fonda_id` int(11) NOT NULL,
  `utility_id` int(11) NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`fonda_id`,`utility_id`),
  KEY `utility_utility_id_fk_idx` (`utility_id`),
  CONSTRAINT `utility_fonda_id_fk` FOREIGN KEY (`fonda_id`) REFERENCES `fonda` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `utility_utility_id_fk` FOREIGN KEY (`utility_id`) REFERENCES `utility` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fonda_utility`
--

LOCK TABLES `fonda_utility` WRITE;
/*!40000 ALTER TABLE `fonda_utility` DISABLE KEYS */;
/*!40000 ALTER TABLE `fonda_utility` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image_dainty`
--

DROP TABLE IF EXISTS `image_dainty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image_dainty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(128) NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  `upload_date` datetime(6) DEFAULT NULL,
  `fonda_dainty_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `image_fonda_dainty_id_fk_idx` (`fonda_dainty_id`),
  CONSTRAINT `image_fonda_dainty_id_fk` FOREIGN KEY (`fonda_dainty_id`) REFERENCES `fonda_dainty` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image_dainty`
--

LOCK TABLES `image_dainty` WRITE;
/*!40000 ALTER TABLE `image_dainty` DISABLE KEYS */;
/*!40000 ALTER TABLE `image_dainty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image_fonda`
--

DROP TABLE IF EXISTS `image_fonda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image_fonda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(128) NOT NULL,
  `desciption` varchar(256) DEFAULT NULL,
  `upload_date` datetime(6) DEFAULT NULL,
  `fonda_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `image_fonda_fonda_id_fk_idx` (`fonda_id`),
  CONSTRAINT `image_fonda_fonda_id_fk` FOREIGN KEY (`fonda_id`) REFERENCES `fonda` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image_fonda`
--

LOCK TABLES `image_fonda` WRITE;
/*!40000 ALTER TABLE `image_fonda` DISABLE KEYS */;
/*!40000 ALTER TABLE `image_fonda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `longitude` double DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location`
--

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
/*!40000 ALTER TABLE `location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `display_name` varchar(45) DEFAULT NULL,
  `dob` datetime(6) DEFAULT NULL,
  `gender` varchar(16) DEFAULT NULL,
  `location` varchar(128) DEFAULT NULL,
  `profile_picture_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sale`
--

DROP TABLE IF EXISTS `sale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `begin_day` datetime(6) NOT NULL,
  `end_day(6)` datetime(6) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `percent` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `fonda_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fonda_id_fk_idx` (`fonda_id`),
  CONSTRAINT `sale_fonda_id_fk` FOREIGN KEY (`fonda_id`) REFERENCES `fonda` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sale`
--

LOCK TABLES `sale` WRITE;
/*!40000 ALTER TABLE `sale` DISABLE KEYS */;
/*!40000 ALTER TABLE `sale` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `email_confirm_token` varchar(64) DEFAULT NULL,
  `email_confirm_token_expired` datetime(6) DEFAULT NULL,
  `access_token` varchar(64) DEFAULT NULL,
  `access_token_expired` datetime(6) DEFAULT NULL,
  `user_status_id` int(11) DEFAULT '1',
  `user_role_id` int(11) DEFAULT '1',
  `created_date` datetime(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `user_status_id_idx` (`user_status_id`),
  KEY `user_role_id_fk_idx` (`user_role_id`),
  CONSTRAINT `user_role_id_fk` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user_status_id_fk` FOREIGN KEY (`user_status_id`) REFERENCES `user_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'111','222','333',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'abc','xyz','haha',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'7ung','hihi','haa',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,'tung','hihi','shết',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(13,'tunghh','hihi','lol',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(14,'tùng hồ','hihi','email mới',NULL,NULL,NULL,NULL,1,1,NULL),(15,'stevie','$2y$10$gE2ylDU6JfDD.Z/hUifkJOQXc3sCbdlb/yJS.KRSC4JR83a59dK.K','xyz',NULL,NULL,NULL,NULL,1,1,NULL),(16,'xUnBC1skPMs61RmF./lKp1','$2y$10$lUEi5ni0sdHhII3gMzw1WesiAULbFD5o87TOhzeIzhzAbrqgdI10a','ggg',NULL,NULL,NULL,NULL,1,1,NULL),(17,'OWiJybjoVC.SE6y0rU7YT/','$2y$10$ITy0XgM/rRze/KHn0To86eUsx46Uzsyw7xSiEJWT7FY3DEDC0eFFG','ohohohoho',NULL,NULL,NULL,NULL,1,1,NULL),(22,'u','p','e',NULL,NULL,NULL,NULL,1,1,'2017-03-17 23:58:39.000000'),(23,'GfWU72vcUueRK9Wka9yKB1','$2y$10$QAFz1vntTN1qlxrfGU40iu88ivAOLUaR3aEaa20jYbxVvuTIs2LO.','hohoang',NULL,NULL,NULL,NULL,1,1,'2017-03-18 14:07:19.000000'),(24,'RQKQifmdEBmBnezN2BQy/1','$2y$10$oLih1Y3H1QtazWh8UzMJhOzoAHMH82l4wrICsoTET3OGnYudQ97ey','hohoanggg',NULL,NULL,NULL,NULL,1,1,'2017-03-18 16:29:41.000000'),(25,'56DEdYSmdp9JqT9hxcSCG.','$2y$10$F5YID14k1rYvTlQxmLYImePNQe0sp1DMEZmRUqL.Ci0.ZpCLXu596','hohoanggga',NULL,NULL,NULL,NULL,1,1,'2017-03-18 16:30:11.000000'),(26,'davidggaa','mede','hohoangggaa',NULL,NULL,NULL,NULL,1,1,'2017-03-18 21:14:32.000000'),(28,'EWYCwdK0PRlfawfEuKPBR0','$2y$10$8DPJJQwHeEjLQn7udr4oIufCTQ74IxnlKy6h9DrBkqAw2g.oI1/z2','hohoangggauu',NULL,NULL,NULL,NULL,1,1,'2017-03-18 21:27:54.000000'),(29,'Qatt9GYWs/DTgWGkHTFK/1','$2y$10$pfwiPQZ1RXVjxI4Bm7FOA.0w9Orh1TYrKDo98Vy2HAnHSO0XraltK','hohohoemail',NULL,NULL,NULL,NULL,1,1,'2017-03-18 21:32:02.000000');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(64) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role`
--

LOCK TABLES `user_role` WRITE;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` VALUES (1,'Guess',NULL),(2,'Vendor',NULL);
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_status`
--

DROP TABLE IF EXISTS `user_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `code` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_status`
--

LOCK TABLES `user_status` WRITE;
/*!40000 ALTER TABLE `user_status` DISABLE KEYS */;
INSERT INTO `user_status` VALUES (1,'verifying email',NULL),(2,'verified',NULL);
/*!40000 ALTER TABLE `user_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utility`
--

DROP TABLE IF EXISTS `utility`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utility` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Tiện nghi của quán ăn.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utility`
--

LOCK TABLES `utility` WRITE;
/*!40000 ALTER TABLE `utility` DISABLE KEYS */;
INSERT INTO `utility` VALUES (1,'Wifi'),(2,'Có chỗ gửi xe'),(3,'Máy lạnh'),(4,'Vườn hoa'),(5,'Hút thuốc'),(6,'Không hút thuốc');
/*!40000 ALTER TABLE `utility` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-18 21:36:06
