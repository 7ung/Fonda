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
-- Table structure for table `access_token`
--

DROP TABLE IF EXISTS `access_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `access_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `access_token` varchar(128) NOT NULL,
  `expired` double DEFAULT '-1' COMMENT '-1 meaning none expired',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `access_token_UNIQUE` (`access_token`),
  KEY `acess_token_user_id_fk_idx` (`user_id`),
  CONSTRAINT `acess_token_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `access_token`
--

LOCK TABLES `access_token` WRITE;
/*!40000 ALTER TABLE `access_token` DISABLE KEYS */;
INSERT INTO `access_token` VALUES (3,'$2y$10$4qrBefyRXe3T6zvrik3RNe6NT4kcNhxRJtjpvAhXR2CIKy8xAjhX2',0,92);
/*!40000 ALTER TABLE `access_token` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (1,'2017-04-17 00:00:00.000000','goood',92,1);
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
  `group_id` int(11) NOT NULL,
  `scale` int(11) NOT NULL COMMENT '1: < 50 chỗ\n2: 50 đến 100 chỗ\n3: trên 100 chỗ',
  `open_time` time DEFAULT NULL,
  `close_time` time DEFAULT NULL,
  `open_day` int(11) DEFAULT NULL,
  `phone_1` varchar(16) DEFAULT NULL,
  `phone_2` varchar(16) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT '1' COMMENT '1 là true\n0 là false',
  PRIMARY KEY (`id`),
  KEY `fonda_group_id_fk_idx` (`group_id`),
  KEY `fonda_user_id_fk_idx` (`user_id`),
  CONSTRAINT `fonda_group_id_fk` FOREIGN KEY (`group_id`) REFERENCES `fonda_group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fonda_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='Cửa hàng, nhà hàng, quán ăn cà phê';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fonda`
--

LOCK TABLES `fonda` WRITE;
/*!40000 ALTER TABLE `fonda` DISABLE KEYS */;
INSERT INTO `fonda` VALUES (1,'Đại Gia',1,3,'07:00:00','12:00:00',NULL,NULL,NULL,92,1),(3,'Hồ Vĩ Dạ',5,1,'07:00:00','19:00:00',NULL,NULL,NULL,92,1),(4,'Hồ Vĩ Dạ',4,1,'07:00:00','19:00:00',NULL,NULL,NULL,92,1),(5,'Hồ Vĩ Dạ',3,1,'07:00:00','19:00:00',NULL,NULL,NULL,92,1),(6,'Hồ Vĩ Dạ',2,1,'07:00:00','19:00:00',NULL,NULL,NULL,92,1);
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
  PRIMARY KEY (`fonda_id`,`culinary_id`),
  KEY `fonda_culinary_culinary_id_fk_idx` (`culinary_id`),
  CONSTRAINT `fonda_culinary_culinary_id_fk` FOREIGN KEY (`culinary_id`) REFERENCES `culinary` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fonda_culinary_fonda_id_fk` FOREIGN KEY (`fonda_id`) REFERENCES `fonda` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fonda_culinary`
--

LOCK TABLES `fonda_culinary` WRITE;
/*!40000 ALTER TABLE `fonda_culinary` DISABLE KEYS */;
INSERT INTO `fonda_culinary` VALUES (1,3),(1,4);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Món của một quán';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fonda_dainty`
--

LOCK TABLES `fonda_dainty` WRITE;
/*!40000 ALTER TABLE `fonda_dainty` DISABLE KEYS */;
INSERT INTO `fonda_dainty` VALUES (1,1,2,'12000','2017-04-14 00:00:00.000000',1,NULL,8000,2,'dummy',1,0);
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
INSERT INTO `fonda_utility` VALUES (1,1,'pass: khongcopass'),(1,2,'Gửi xe ở sân thượng');
/*!40000 ALTER TABLE `fonda_utility` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(256) NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  `upload_date` double DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `image_user_user_id_fk_idx` (`user_id`),
  CONSTRAINT `image_user_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image`
--

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
INSERT INTO `image` VALUES (1,'https://scontent.fsgn5-2.fna.fbcdn.net/v/t1.0-9/16730174_782446968571874_2961317568171881099_n.jpg?oh=1e26b8f7fd307e79bac3f68a8e3a6bfe&oe=595AE56C','Ảnh fb',1491718565,NULL),(2,'https://scontent.fsgn5-2.fna.fbcdn.net/v/t1.0-9/16730174_782446968571874_2961317568171881099_n.jpg?oh=1e26b8f7fd307e79bac3f68a8e3a6bfe&oe=595AE56C','Ảnh fb',1491718630,NULL),(3,'https://scontent.fsgn5-2.fna.fbcdn.net/v/t1.0-9/16730174_782446968571874_2961317568171881099_n.jpg?oh=1e26b8f7fd307e79bac3f68a8e3a6bfe&oe=595AE56C','Ảnh fb',1491718720,NULL),(4,'https://scontent.fsgn5-2.fna.fbcdn.net/v/t1.0-9/16730174_782446968571874_2961317568171881099_n.jpg?oh=1e26b8f7fd307e79bac3f68a8e3a6bfe&oe=595AE56C','Ảnh fb',1491718786,NULL),(5,'https://scontent.fsgn5-2.fna.fbcdn.net/v/t1.0-9/16730174_782446968571874_2961317568171881099_n.jpg?oh=1e26b8f7fd307e79bac3f68a8e3a6bfe&oe=595AE56C','Ảnh fb',1491719096,NULL),(6,'https://scontent.fsgn5-2.fna.fbcdn.net/v/t1.0-9/16730174_782446968571874_2961317568171881099_n.jpg?oh=1e26b8f7fd307e79bac3f68a8e3a6bfe&oe=595AE56C','Ảnh fb',1491719153,92);
/*!40000 ALTER TABLE `image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image_dainty`
--

DROP TABLE IF EXISTS `image_dainty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image_dainty` (
  `image_id` int(11) NOT NULL,
  `fonda_dainty_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`image_id`),
  KEY `image_fonda_dainty_id_fk_idx` (`fonda_dainty_id`),
  CONSTRAINT `image_dainty_dainty_id_fk` FOREIGN KEY (`fonda_dainty_id`) REFERENCES `fonda_dainty` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `image_dainty_image_id_fk` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
  `image_id` int(11) NOT NULL,
  `fonda_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`image_id`),
  KEY `image_fonda_fonda_id_fk_idx` (`fonda_id`),
  CONSTRAINT `image_fonda_fonda_id_fk` FOREIGN KEY (`fonda_id`) REFERENCES `fonda` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `image_fonda_image_id_fk` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image_fonda`
--

LOCK TABLES `image_fonda` WRITE;
/*!40000 ALTER TABLE `image_fonda` DISABLE KEYS */;
INSERT INTO `image_fonda` VALUES (6,1);
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
  `profile_id` int(11) DEFAULT NULL,
  `fonda_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `location_fonda_id_fk_idx` (`fonda_id`),
  KEY `location_profile_id_fk_idx` (`profile_id`),
  CONSTRAINT `location_fonda_id_fk` FOREIGN KEY (`fonda_id`) REFERENCES `fonda` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `location_profile_id_fk` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `location`
--

LOCK TABLES `location` WRITE;
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` VALUES (1,10.8869628,106.7563277,'Bình Dương',10,NULL),(5,93.8184,73.188,NULL,NULL,3),(6,93.8184,73.188,NULL,NULL,4),(7,93.8184,73.188,NULL,NULL,5),(8,93.8184,73.188,NULL,NULL,6),(15,12.1,15.3,'hcm',NULL,1);
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
  `first_name` varchar(64) DEFAULT NULL,
  `last_name` varchar(64) DEFAULT NULL,
  `dob` datetime(6) DEFAULT NULL,
  `gender` varchar(16) DEFAULT NULL,
  `profile_picture_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_profile_id_fk_idx` (`user_id`),
  KEY `profile_image_image_id_fk_idx` (`profile_picture_id`),
  CONSTRAINT `profile_image_image_id_fk` FOREIGN KEY (`profile_picture_id`) REFERENCES `image` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user_profile_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES (10,'steve','howard','1995-11-26 00:00:00.000000','male',2,92),(11,'Đại gia nhà hàng 94',NULL,NULL,'female',NULL,94);
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
  `user_role_id` int(11) DEFAULT '1',
  `created_date` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `user_role_id_fk_idx` (`user_role_id`),
  CONSTRAINT `user_role_id_fk` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (72,'YjPlaB.CxtW0IQeIcH2W0','$2y$10$t66d/wKl7dei30Gzl7yfIOG.VqvjW98vKeZAvmoxixXJ1XD65.Vjm','hghghgh@hh',1,1491384467),(79,'5lvydpyVjqZLh.3vrHmj1','$2y$10$uJJZYj0DajMCKVQ.bqDRW.tIA7jpWfffj9HHiuiSrU10bw9IowH6u','haha@hahahh',1,1491471519),(92,'m06xgekJlYx83GQyMTi8J1','$2y$10$2OJg8Wx/wYjjk0sSJSkbP.dDJpU2XYGnzwXca9.ww9P846qH7vYLa','hohoangtung12a3@gmail.com',2,1491894672),(94,'e5Zagh5YGDeWfCmhqe1Ft0','$2y$10$nA.3TxnUniQHjYR1FF6hFeEW6nqO.8nRH25.N4oIdNSQlVQodpDMq','dumm',1,1491982417);
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
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `verify_status`
--

LOCK TABLES `verify_status` WRITE;
/*!40000 ALTER TABLE `verify_status` DISABLE KEYS */;
INSERT INTO `verify_status` VALUES (75,79,'347240',1491730722,0,1),(84,92,'301762',1492161908,0,3),(86,94,'697969',1492241618,0,1);
/*!40000 ALTER TABLE `verify_status` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-14 12:24:44
