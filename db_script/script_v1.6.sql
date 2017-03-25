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
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (58,'gkyunsgFBWlwB8','$2y$10$jCOAIGYm2zqUTiWMFYoWfud0kVFIO1rtc/IHrsHmBYWDGrgmSBpw2','hohoangtunm',NULL,NULL,1,1,'2017-03-20 22:08:32.000000'),(59,'gkyunsgFBW','$2y$10$X1AxQ2hQwvDb0gjxPcwxN.7hO9ryh/pmMqc.ksFGqlCbSZXvqPnay','hohoangtu',NULL,NULL,1,1,'2017-03-20 22:11:32.000000'),(60,'gkyunsgFB','$2y$10$nt0jomOR7xfKuF9tQ6MCcuX9zArGVag07pQR9fhvlC/sn3OjA7qai','hohoangt',NULL,NULL,1,1,'2017-03-20 22:12:35.000000'),(61,'gkyunsgFBWlw','$2y$10$QcZ8lxLkIzLzVspETYDfxOThvUVENCagLgn1ofoYCnUOloEUwBNtS','h',NULL,NULL,1,1,'2017-03-20 23:05:36.000000'),(62,'gkyunsg','$2y$10$ctvxIOqrRvo247WAhiUrI.Vvd3svKmL2BDDtGAuF1haDRRT7n.lZe','hohoangtung',NULL,NULL,1,1,'2017-03-20 23:08:35.000000'),(63,'k','$2y$10$lhXQrW.ozUZTXufO1LQ7rO8kjpTS5GAdJVOOE.gAOuOsgQooqVm.2','hohoangtung1',NULL,NULL,1,1,'2017-03-20 23:11:08.000000'),(64,'aVlCF27KpG8j4Q','$2y$10$mC2VrbqJfChVhv5No0dodexF/GVUAneHQ9vJ0YfxkcYJ1Q12I0Y32','luannt2',NULL,NULL,1,1,'2017-03-20 23:18:31.000000'),(65,'vxEYNI8jD2hoozhh6','$2y$10$McHJoj5n8Z3hOtNyi48UM.7Jc2enAfsqzjXz3d5O6t6Knfg/n1mN6','hohoangtun.com',NULL,NULL,1,1,'2017-03-20 23:23:33.000000'),(66,'fSc6T.tpmsJ972vVD1O0.','$2y$10$cI3ofs.dxg2EevAvE2oSy.xQNhio6ee9nxm9uFwGNxszQFZbkH3Z2','1',NULL,NULL,1,1,'2017-03-24 19:35:11.000000'),(67,'ep44h0QDHoffJojssQgK/','$2y$10$rskoah5cvqGhLhCKH08Xh.NL4qSe77c1l5yV46k1DyxLGiubDl75O','2',NULL,NULL,1,1,'2017-03-24 19:53:39.000000');
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

--
-- Table structure for table `verify_status`
--

DROP TABLE IF EXISTS `verify_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `verify_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `code` varchar(8) DEFAULT NULL,
  `expired` double DEFAULT NULL,
  `tried_time` int(11) DEFAULT '0' COMMENT 'Số lần verify thất bại',
  `status` int(11) DEFAULT '1' COMMENT '1 - Waiting for verify\n2 - Verify expired\n3 - Verified',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  KEY `verify_status_user_id_fk_idx` (`user_id`),
  CONSTRAINT `verify_status_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `verify_status`
--

LOCK TABLES `verify_status` WRITE;
/*!40000 ALTER TABLE `verify_status` DISABLE KEYS */;
INSERT INTO `verify_status` VALUES (60,58,'916396',1490281712,0,3),(61,59,'646461',1490281892,0,1),(62,60,'165365',1490281955,0,1),(63,61,'797984',1350285136,0,1),(64,62,'363004',1390285315,0,1),(65,63,'771786',1490285468,0,1),(66,64,'714450',1490285911,0,1),(67,65,'228572',1490286213,0,2),(68,66,'513847',1490618112,0,3),(69,67,'598001',1490619219,1,3);
/*!40000 ALTER TABLE `verify_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'foodee'
--
/*!50003 DROP PROCEDURE IF EXISTS `insert_user` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_user`(
	in _username varchar(32), 
    in _password varchar(64),
    in _email varchar(128))
BEGIN
	insert into user(username, password, email, created_date) 
				values(_username, _password, _email, now());
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `login` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `login`(
	in _user_name varchar(32),
    in _password varchar(64))
BEGIN
	declare _id int(6);
    
    set @_id = -1;
    select @_id  := `id` from user 
    where (username = _user_name and password = _password);
    
    if (@_id = -1)
		then select 0;
        else select 1;
		end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `verify_account` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `verify_account`(
	in _user_id int(6), 
    in _code varchar(8))
BEGIN
	declare _real_code varchar(8);
	declare _status int;
	declare _tried_time int;
    declare _expired double;
	declare _rs int;

    set @_real_code := '';
    set @_status = 0;
    
	/* lấy ra code, trạng thái hiện tại và số lần đã thử */
    select @_real_code := `code`, @_status := `status`, @_tried_time := `tried_time`, @_expired := `expired`
    from verify_status where (user_id = _user_id);
     
    /**
    * Nếu quá số lần thử hoặc quá thời gian thì trả về mã fail 3
    */
    if (@_status = 2 or from_unixtime(@_expired) < now())
    then
		begin
			/* Nếu @_expired < CURRENT_TIMESTAMP thì set status =2 */
			update verify_status set status = 2
			where (user_id = _user_id); 
			set @_rs := 3;				/* fail */
		end;
	end if;
      
    /**
    * nếu code thật bằng code truyền vào, status hiện tại là 1 
    * chuyển status thành 3
    * gán giá trị trả về là 0
    */
	if (@_real_code = _code and @_status = 1 and from_unixtime(@_expired) > now())
    then
		begin
			update verify_status set status = 3
            where (user_id = _user_id);
			set @_rs := 0;		/* success */
        end;
	end if;
    
    /**
    * nếu code thật với code truyền vào khác nhau và status hiện tại là 1
    * verify thất bại
    * tăng số lầng thử lên 1
    * và gán giá trị trả về là 1
    */
    if (@_real_code <> _code and @_status = 1)
    then
		begin            
			update verify_status set tried_time = (@_tried_time + 1)
            where (user_id = _user_id);
            
            if (@_tried_time = 2) /* nếu đã sai 2 lần, thêm lần này nữa là 3 */
            then
				begin
					update verify_status set status = 2
					where (user_id = _user_id);
                    set @_rs := 2;		/* fail */
                end;
			else
				set @_rs := 1;			/* fail */ 
			end if;
        end;
    end if;

	/**
    * rs = 0: verify thành công
    * rs = 1: verify thất bại, sai code
    * rs = 2: verify thất bại, sai code và hết 3 lần thử
    * rs = 3: verify thất bại, quá expired time hoặc quá tried_time
    */
	select @_rs;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-25 22:32:33
