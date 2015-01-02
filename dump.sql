-- MySQL dump 10.13  Distrib 5.6.20, for osx10.9 (x86_64)
--
-- Host: localhost    Database: custom_cms
-- ------------------------------------------------------
-- Server version	5.6.20

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
-- Table structure for table `Category`
--

DROP TABLE IF EXISTS `Category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `urlKey` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_FF3A7B975553F29E` (`urlKey`),
  KEY `IDX_FF3A7B97E559DFD1` (`locale_id`),
  CONSTRAINT `FK_FF3A7B97E559DFD1` FOREIGN KEY (`locale_id`) REFERENCES `Locale` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Category`
--

LOCK TABLES `Category` WRITE;
/*!40000 ALTER TABLE `Category` DISABLE KEYS */;
INSERT INTO `Category` VALUES (4,1,'Category En 1 Edited','category-en-1'),(5,1,'Category En 1','category-en-1-20141230071537'),(6,1,'Category En 2','category-en-2'),(7,2,'Arabic 1','arabic-1');
/*!40000 ALTER TABLE `Category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Locale`
--

DROP TABLE IF EXISTS `Locale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Locale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Locale`
--

LOCK TABLES `Locale` WRITE;
/*!40000 ALTER TABLE `Locale` DISABLE KEYS */;
INSERT INTO `Locale` VALUES (1,'English','en_US'),(2,'Arabic','ar_IQ');
/*!40000 ALTER TABLE `Locale` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale_id` int(11) DEFAULT NULL,
  `create_user_id` int(11) NOT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `urlKey` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `createTime` datetime NOT NULL,
  `updateTime` datetime DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shortContent` longtext COLLATE utf8_unicode_ci NOT NULL,
  `metaDescription` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `metaKeywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_C01551435553F29E` (`urlKey`),
  KEY `IDX_C0155143E559DFD1` (`locale_id`),
  KEY `IDX_C015514385564492` (`create_user_id`),
  KEY `IDX_C0155143E0DFCA6C` (`update_user_id`),
  CONSTRAINT `FK_C015514385564492` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_C0155143E0DFCA6C` FOREIGN KEY (`update_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_C0155143E559DFD1` FOREIGN KEY (`locale_id`) REFERENCES `Locale` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog`
--

LOCK TABLES `blog` WRITE;
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
INSERT INTO `blog` VALUES (1,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat',2,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(3,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat0',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(4,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat01',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(5,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat012',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(6,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat0123',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(7,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat01234',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(8,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat012345',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(9,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat0123456',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(10,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat01234567',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(11,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat012345678',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(12,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat0123456789',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(13,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat012345678910',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(14,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat01234567891011',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(15,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat0123456789101112',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(16,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat012345678910111213',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(17,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat01234567891011121314',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(18,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat0123456789101112131415',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(19,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat012345678910111213141516',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(20,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat01234567891011121314151617',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(21,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat0123456789101112131415161718',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(22,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat012345678910111213141516171819',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(23,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat01234567891011121314151617181920',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(24,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat0123456789101112131415161718192021',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(25,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat012345678910111213141516171819202122',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(26,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat01234567891011121314151617181920212223',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(27,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat0123456789101112131415161718192021222324',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(28,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat012345678910111213141516171819202122232425',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(29,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat01234567891011121314151617181920212223242526',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(30,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat0123456789101112131415161718192021222324252627',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(31,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat012345678910111213141516171819202122232425262728',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(32,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat01234567891011121314151617181920212223242526272829',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(33,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat0123456789101112131415161718192021222324252627282930',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(34,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat012345678910111213141516171819202122232425262728293031',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(35,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat01234567891011121314151617181920212223242526272829303132',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(36,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat0123456789101112131415161718192021222324252627282930313233',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(37,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat012345678910111213141516171819202122232425262728293031323334',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(38,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat01234567891011121314151617181920212223242526272829303132333435',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(39,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat0123456789101112131415161718192021222324252627282930313233343536',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(40,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat012345678910111213141516171819202122232425262728293031323334353637',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(41,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat01234567891011121314151617181920212223242526272829303132333435363738',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(42,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat0123456789101112131415161718192021222324252627282930313233343536373839',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(43,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat012345678910111213141516171819202122232425262728293031323334353637383940',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(44,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat01234567891011121314151617181920212223242526272829303132333435363738394041',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(45,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat0123456789101112131415161718192021222324252627282930313233343536373839404142',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(46,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat012345678910111213141516171819202122232425262728293031323334353637383940414243',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(47,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat01234567891011121314151617181920212223242526272829303132333435363738394041424344',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(48,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat0123456789101112131415161718192021222324252627282930313233343536373839404142434445',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(49,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat012345678910111213141516171819202122232425262728293031323334353637383940414243444546',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(50,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat01234567891011121314151617181920212223242526272829303132333435363738394041424344454647',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(51,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat0123456789101112131415161718192021222324252627282930313233343536373839404142434445464748',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf'),(52,1,1,1,'Thay mặt kính, thay màn hình điện thoại Hoàng Khánh','thay-mat012345678910111213141516171819202122232425262728293031323334353637383940414243444546474849',1,'sdfsdf','2015-01-02 08:55:03','2015-01-02 11:02:05','','sfsdf','sdf','sdf');
/*!40000 ALTER TABLE `blog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_category`
--

DROP TABLE IF EXISTS `blog_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_category` (
  `blog_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`blog_id`,`category_id`),
  KEY `IDX_72113DE6DAE07E97` (`blog_id`),
  KEY `IDX_72113DE612469DE2` (`category_id`),
  CONSTRAINT `FK_72113DE612469DE2` FOREIGN KEY (`category_id`) REFERENCES `Category` (`id`),
  CONSTRAINT `FK_72113DE6DAE07E97` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_category`
--

LOCK TABLES `blog_category` WRITE;
/*!40000 ALTER TABLE `blog_category` DISABLE KEYS */;
INSERT INTO `blog_category` VALUES (1,4),(1,5),(3,4),(3,5),(4,4),(4,5),(5,4),(5,5),(6,4),(6,5),(7,4),(7,5),(8,4),(8,5),(9,4),(9,5),(10,4),(10,5),(11,4),(11,5),(12,4),(12,5),(13,4),(13,5),(14,4),(14,5),(15,4),(15,5),(16,4),(16,5),(17,4),(17,5),(18,4),(18,5),(19,4),(19,5),(20,4),(20,5),(21,4),(21,5),(22,4),(22,5),(23,4),(23,5),(24,4),(24,5),(25,4),(25,5),(26,4),(26,5),(27,4),(27,5),(28,4),(28,5),(29,4),(29,5),(30,4),(30,5),(31,4),(31,5),(32,4),(32,5),(33,4),(33,5),(34,4),(34,5),(35,4),(35,5),(36,4),(36,5),(37,4),(37,5),(38,4),(38,5),(39,4),(39,5),(40,4),(40,5),(41,4),(41,5),(42,4),(42,5),(43,4),(43,5),(44,4),(44,5),(45,4),(45,5),(46,4),(46,5),(47,4),(47,5),(48,4),(48,5),(49,4),(49,5),(50,4),(50,5),(51,4),(51,5),(52,4),(52,5);
/*!40000 ALTER TABLE `blog_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `roleId` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_57698A6AB8C2FD88` (`roleId`),
  KEY `IDX_57698A6A727ACA70` (`parent_id`),
  CONSTRAINT `FK_57698A6A727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,NULL,'guest'),(2,1,'user'),(3,2,'moderator'),(4,3,'administrator');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `displayName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,NULL,'admin@custom-cms.com','Administrator','$2y$14$8tVkJuERUMIo1mc0/2QG4.DEZxQsKMSB8vcjk1DVD7BVyzNtrmMB2'),(2,NULL,'mod@custom-cms.com','Moderator1','$2y$14$.Dq8MVUvp0nLNFskNcOfveK3mBCplvtUxe1G12FJQkGeaGJM/wMiS'),(3,NULL,'mod2@custom-cms.com','Moderator2','$2y$14$Rld.cmmVHVzIUFthvq02UO9vUA70Hlzp2SILyBl4M09oAlnf1B62C'),(4,NULL,'mod3@custom-cms.com','Moderator3','$2y$14$LKMKMAgyuNcjQP7jOrax3uD1BAkn3pD9exUodrcKH1iCGOeMpXVim'),(5,NULL,'mod4@custom-cms.com','Moderator4','$2y$14$bU7NPSRzeIeVFBk6ZxFMHOgHteKPxabfY48IdrFqKOxQwmlk6DYAG'),(6,NULL,'mod5@custom-cms.com','Moderator5','$2y$14$sPBKo3l2LUo28oVkEUjUv.jwelbcGTxnP.kc2hvBiRoolzOsTitnO');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_category`
--

DROP TABLE IF EXISTS `user_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_category` (
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`category_id`),
  KEY `IDX_E6C1FDC1A76ED395` (`user_id`),
  KEY `IDX_E6C1FDC112469DE2` (`category_id`),
  CONSTRAINT `FK_E6C1FDC112469DE2` FOREIGN KEY (`category_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_E6C1FDC1A76ED395` FOREIGN KEY (`user_id`) REFERENCES `Category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_category`
--

LOCK TABLES `user_category` WRITE;
/*!40000 ALTER TABLE `user_category` DISABLE KEYS */;
INSERT INTO `user_category` VALUES (4,1);
/*!40000 ALTER TABLE `user_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role_linker`
--

DROP TABLE IF EXISTS `user_role_linker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_role_linker` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `IDX_61117899A76ED395` (`user_id`),
  KEY `IDX_61117899D60322AC` (`role_id`),
  CONSTRAINT `FK_61117899A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_61117899D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role_linker`
--

LOCK TABLES `user_role_linker` WRITE;
/*!40000 ALTER TABLE `user_role_linker` DISABLE KEYS */;
INSERT INTO `user_role_linker` VALUES (1,4),(2,3),(3,3),(4,3),(5,3),(6,3);
/*!40000 ALTER TABLE `user_role_linker` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-01-02 20:13:28
