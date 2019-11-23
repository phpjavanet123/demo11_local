-- MySQL dump 10.16  Distrib 10.1.37-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: demo11_local
-- ------------------------------------------------------
-- Server version	10.1.37-MariaDB

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
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` bigint(10) DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `surname` varchar(191) DEFAULT NULL,
  `date_of_birth` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `phone_number` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `country` varchar(191) DEFAULT NULL,
  `trading_account_number` varchar(191) DEFAULT NULL,
  `balance` varchar(191) DEFAULT NULL,
  `open_trades` varchar(191) DEFAULT NULL,
  `close_trades` varchar(191) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'Test1','','','test1@mail.com','$2y$10$j6OUTFwitBLQM5FGCjwegeeMTIW79RBN6B2c8DHa5usyyxfK3CvwO','','','','','','','','','0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'Test2','','','test2@mail.com','$2y$10$8kCvH4tlUGkeXnjjO7y.rur4kfHMXlBFzaDtkK2zjM8NrepwdDXH6','','','','','','','','','0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,'Client20','Client201','','client20@mail.com','$2y$10$sYdWcmtpOpL3zpcJpqN2tOJh2odVTyt0eAd4lAqEXVp5A8Ki2FSMm','','','','','','','','','0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,'client21','','','client21@mail.com','$2y$10$fKULY4oaBYUYT2eHSiJGoOgctKurMDUEnuseEMtbycm6nFfnC3B1C','','','','','','','','','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currencies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `currencies_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` VALUES (1,'Leke','ALL','Lek'),(2,'Dollars','USD','$'),(3,'Afghanis','AFN','؋'),(4,'Pesos','ARS','$'),(5,'Guilders','AWG','ƒ'),(6,'Dollars','AUD','$'),(7,'New Manats','AZN','ман'),(8,'Dollars','BSD','$'),(9,'Dollars','BBD','$'),(10,'Rubles','BYR','p.'),(11,'Euro','EUR','€'),(12,'Dollars','BZD','BZ$'),(13,'Dollars','BMD','$'),(14,'Bolivianos','BOB','$b'),(15,'Convertible Marka','BAM','KM'),(16,'Pula','BWP','P'),(17,'Leva','BGN','лв'),(18,'Reais','BRL','R$'),(19,'Pounds','GBP','£'),(20,'Dollars','BND','$'),(21,'Riels','KHR','៛'),(22,'Dollars','CAD','$'),(23,'Dollars','KYD','$'),(24,'Pesos','CLP','$'),(25,'Yuan Renminbi','CNY','¥'),(26,'Pesos','COP','$'),(27,'Colón','CRC','₡'),(28,'Kuna','HRK','kn'),(29,'Pesos','CUP','₱'),(30,'Koruny','CZK','Kč'),(31,'Kroner','DKK','kr'),(32,'Pesos','DOP','RD$'),(33,'Dollars','XCD','$'),(34,'Pounds','EGP','£'),(35,'Colones','SVC','$'),(36,'Pounds','FKP','£'),(37,'Dollars','FJD','$'),(38,'Cedis','GHC','¢'),(39,'Pounds','GIP','£'),(40,'Quetzales','GTQ','Q'),(41,'Pounds','GGP','£'),(42,'Dollars','GYD','$'),(43,'Lempiras','HNL','L'),(44,'Dollars','HKD','$'),(45,'Forint','HUF','Ft'),(46,'Kronur','ISK','kr'),(47,'Rupees','INR','Rp'),(48,'Rupiahs','IDR','Rp'),(49,'Rials','IRR','﷼'),(50,'Pounds','IMP','£'),(51,'New Shekels','ILS','₪'),(52,'Dollars','JMD','J$'),(53,'Yen','JPY','¥'),(54,'Pounds','JEP','£'),(55,'Tenge','KZT','лв'),(56,'Won','KPW','₩'),(57,'Won','KRW','₩'),(58,'Soms','KGS','лв'),(59,'Kips','LAK','₭'),(60,'Lati','LVL','Ls'),(61,'Pounds','LBP','£'),(62,'Dollars','LRD','$'),(63,'Switzerland Francs','CHF','CHF'),(64,'Litai','LTL','Lt'),(65,'Denars','MKD','ден'),(66,'Ringgits','MYR','RM'),(67,'Rupees','MUR','₨'),(68,'Pesos','MXN','$'),(69,'Tugriks','MNT','₮'),(70,'Meticais','MZN','MT'),(71,'Dollars','NAD','$'),(72,'Rupees','NPR','₨'),(73,'Guilders','ANG','ƒ'),(74,'Dollars','NZD','$'),(75,'Cordobas','NIO','C$'),(76,'Nairas','NGN','₦'),(77,'Krone','NOK','kr'),(78,'Rials','OMR','﷼'),(79,'Rupees','PKR','₨'),(80,'Balboa','PAB','B/.'),(81,'Guarani','PYG','Gs'),(82,'Nuevos Soles','PEN','S/.'),(83,'Pesos','PHP','Php'),(84,'Zlotych','PLN','zł'),(85,'Rials','QAR','﷼'),(86,'New Lei','RON','lei'),(87,'Rubles','RUB','руб'),(88,'Pounds','SHP','£'),(89,'Riyals','SAR','﷼'),(90,'Dinars','RSD','Дин'),(91,'Rupees','SCR','₨'),(92,'Dollars','SGD','$'),(93,'Dollars','SBD','$'),(94,'Shillings','SOS','S'),(95,'Rand','ZAR','R'),(96,'Rupees','LKR','₨'),(97,'Kronor','SEK','kr'),(98,'Dollars','SRD','$'),(99,'Pounds','SYP','£'),(100,'New Dollars','TWD','NT$'),(101,'Baht','THB','฿'),(102,'Dollars','TTD','TT$'),(103,'Lira','TRY','TL'),(104,'Liras','TRL','£'),(105,'Dollars','TVD','$'),(106,'Hryvnia','UAH','₴'),(107,'Pesos','UYU','$U'),(108,'Sums','UZS','лв'),(109,'Bolivares Fuertes','VEF','Bs'),(110,'Dong','VND','₫'),(111,'Rials','YER','﷼'),(112,'Zimbabwe Dollars','ZWD','Z$');
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exchange_rates`
--

DROP TABLE IF EXISTS `exchange_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exchange_rates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `currency_id` bigint(20) unsigned NOT NULL,
  `rate` double(10,4) NOT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `exchange_rates_currency_id_foreign` (`currency_id`),
  CONSTRAINT `exchange_rates_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exchange_rates`
--

LOCK TABLES `exchange_rates` WRITE;
/*!40000 ALTER TABLE `exchange_rates` DISABLE KEYS */;
INSERT INTO `exchange_rates` VALUES (1,2,1.0000,1),(2,1,1.0000,0),(3,3,0.5000,0),(4,4,2.0000,0);
/*!40000 ALTER TABLE `exchange_rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) DEFAULT NULL,
  `migration` varchar(191) DEFAULT NULL,
  `batch` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (5,'2014_10_12_000000_create_users_table',1),(6,'2014_10_12_100000_create_password_resets_table',1),(7,'2019_07_16_102404_create_roles_table',1),(8,'2019_07_16_140158_create_clients_table',1),(NULL,'2019_11_18_124552_create_currencies_table',2),(NULL,'2019_11_18_131116_create_exchange_rates_table',3),(NULL,'2019_11_18_135752_create_wallets_table',3),(NULL,'2019_11_18_163122_create_transactions_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) DEFAULT NULL,
  `token` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrator','0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'User','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sqlite_sequence`
--

DROP TABLE IF EXISTS `sqlite_sequence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sqlite_sequence` (
  `name` varchar(10) DEFAULT NULL,
  `seq` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sqlite_sequence`
--

LOCK TABLES `sqlite_sequence` WRITE;
/*!40000 ALTER TABLE `sqlite_sequence` DISABLE KEYS */;
INSERT INTO `sqlite_sequence` VALUES ('migrations',8),('roles',2),('users',2),('clients',4);
/*!40000 ALTER TABLE `sqlite_sequence` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `wallet_id` bigint(20) unsigned NOT NULL,
  `type` int(10) unsigned NOT NULL,
  `amount` double(16,4) unsigned NOT NULL DEFAULT '0.0000',
  `currency_id` bigint(20) unsigned NOT NULL,
  `default_currency_amount` double(16,4) unsigned NOT NULL DEFAULT '0.0000',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,1,0,20.0000,1,12.0000,NULL,NULL),(2,2,0,30.0000,2,122.0000,NULL,NULL);
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `role_id` int(10) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_indx` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin Name','admin@example.com','0000-00-00 00:00:00','$2y$10$r3JwmbwCmZJjUhd5UOLXjeiwUu5SmEf0JvGhI81y7uNTcU7kEu/Ym',NULL,NULL,1,'','0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'User Name','user@example.com','0000-00-00 00:00:00','$2y$10$A1TVlkDBbKZKqGgbZCGtA.6CGo4GDAJq23hqwWDCY7/xwgPTQ.aZm',NULL,NULL,2,'','0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,'test1','user1@example.com',NULL,'$2y$10$Jv3bPMfKh9uTKU5sQsibxOdffSh2dqbuJCOpqvgarhq2icliWCZaG','Russia','Moscow4',2,NULL,'2019-11-20 15:22:34','2019-11-20 15:54:54'),(5,'test12','test16@example.com',NULL,'$2y$10$T.MVttMUlTPgzXIQ748aLOFhmRyvXmVs7NEz3YwfxnM0dtVt8onge','Russia','Moscow',2,NULL,'2019-11-20 15:55:35','2019-11-20 15:55:35'),(8,'test122222','test2@example.com',NULL,'$2y$10$IGn3VupGIoAdwzdTmfiJaO2ZG.niA8jK3MyxJgzHc8aQ5PTtH2QQy','Russia','Moscow55',2,NULL,'2019-11-23 06:29:58','2019-11-23 06:29:58'),(10,'Withdraw','withdraw@example.com',NULL,'$2y$10$IGn3VupGIoAdwzdTmfiJaO2ZG.niA8jK3MyxJgzHc8aQ5PTtH2QQy','United States of America','New York',2,NULL,'2019-11-23 06:29:58','2019-11-23 06:29:58'),(11,'Deposit','deposit@example.com',NULL,'$2y$10$IGn3VupGIoAdwzdTmfiJaO2ZG.niA8jK3MyxJgzHc8aQ5PTtH2QQy','United States of America','New York',2,NULL,'2019-11-23 06:29:58','2019-11-23 06:29:58');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wallets`
--

DROP TABLE IF EXISTS `wallets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wallets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `currency_id` bigint(20) unsigned NOT NULL,
  `number` int(10) unsigned NOT NULL,
  `amount` double(16,4) unsigned NOT NULL DEFAULT '0.0000',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wallets_user_id_foreign` (`user_id`),
  KEY `wallets_currency_id_foreign` (`currency_id`),
  CONSTRAINT `wallets_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  CONSTRAINT `wallets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallets`
--

LOCK TABLES `wallets` WRITE;
/*!40000 ALTER TABLE `wallets` DISABLE KEYS */;
INSERT INTO `wallets` VALUES (1,1,1,111,0.0000,NULL,NULL),(2,2,2,222,0.0000,NULL,NULL),(3,8,2,3,0.0000,'2019-11-23 06:29:58','2019-11-23 06:29:58'),(4,10,2,4,0.0000,'2019-11-23 06:29:58','2019-11-23 06:29:58'),(5,11,2,5,0.0000,'2019-11-23 06:29:58','2019-11-23 06:29:58');
/*!40000 ALTER TABLE `wallets` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-11-23 11:13:43
