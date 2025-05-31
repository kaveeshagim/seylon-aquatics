-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: seylon-aquatics
-- ------------------------------------------------------
-- Server version	8.0.39

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
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metrics`
--

DROP TABLE IF EXISTS `metrics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `metrics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metrics`
--

LOCK TABLES `metrics` WRITE;
/*!40000 ALTER TABLE `metrics` DISABLE KEYS */;
/*!40000 ALTER TABLE `metrics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0000_00_00_000000_create_websockets_statistics_entries_table',1),(2,'2014_10_12_000000_create_users_table',1),(3,'2014_10_12_100000_create_password_reset_tokens_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2019_12_14_000001_create_personal_access_tokens_table',1),(6,'2024_07_18_112721_create_metrics_table',1),(7,'2024_08_17_193856_create_jobs_table',1),(8,'2024_10_17_222331_create_tbl_company_table',1),(9,'2024_10_17_222345_create_tbl_usertype_table',1),(10,'2024_10_17_222354_create_tbl_users_table',1),(11,'2024_10_17_223526_create_tbl_user_auth_log_table',1),(12,'2024_10_17_223538_create_tbl_size_table',1),(13,'2024_10_17_224321_create_tbl_notifications_table',1),(14,'2024_10_17_230921_create_tbl_reset_password_req_table',1),(15,'2024_10_17_232152_create_tbl_customers_table',1),(16,'2024_10_19_220232_create_tbl_order_mst_table',1),(17,'2024_10_19_220243_create_tbl_order_det_table',1),(18,'2024_10_19_224028_create_tbl_fish_habitat_table',1),(19,'2024_10_19_224219_create_tbl_fish_family_table',1),(20,'2024_10_19_224414_create_tbl_fish_species_table',1),(21,'2024_10_19_224427_create_tbl_fish_variety_table',1),(22,'2024_10_19_230654_create_tbl_priv_category_table',1),(23,'2024_10_19_230722_create_tbl_priv_subcategory_table',1),(24,'2024_10_19_230759_create_tbl_privilege_section_table',1),(25,'2024_10_19_230822_create_tbl_privilege_mst_table',1),(26,'2024_10_19_231900_alter_token_in_tbl_users',2),(27,'2024_10_19_232416_create_test_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_company`
--

DROP TABLE IF EXISTS `tbl_company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_company` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `web_url` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_no_one` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no_two` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_one` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_two` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perbox_cost` int NOT NULL,
  `document_fee` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_company`
--

LOCK TABLES `tbl_company` WRITE;
/*!40000 ALTER TABLE `tbl_company` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_customers`
--

DROP TABLE IF EXISTS `tbl_customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fname` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `company` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_status` tinyint DEFAULT NULL,
  `primary_contact` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secondary_contact` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `executive_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_customers_user_id_foreign` (`user_id`),
  KEY `tbl_customers_executive_id_foreign` (`executive_id`),
  CONSTRAINT `tbl_customers_executive_id_foreign` FOREIGN KEY (`executive_id`) REFERENCES `tbl_users` (`id`),
  CONSTRAINT `tbl_customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_customers`
--

LOCK TABLES `tbl_customers` WRITE;
/*!40000 ALTER TABLE `tbl_customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_fish_family`
--

DROP TABLE IF EXISTS `tbl_fish_family`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_fish_family` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `habitat_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_fish_family_habitat_id_foreign` (`habitat_id`),
  CONSTRAINT `tbl_fish_family_habitat_id_foreign` FOREIGN KEY (`habitat_id`) REFERENCES `tbl_fish_habitat` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_fish_family`
--

LOCK TABLES `tbl_fish_family` WRITE;
/*!40000 ALTER TABLE `tbl_fish_family` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_fish_family` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_fish_habitat`
--

DROP TABLE IF EXISTS `tbl_fish_habitat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_fish_habitat` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_fish_habitat`
--

LOCK TABLES `tbl_fish_habitat` WRITE;
/*!40000 ALTER TABLE `tbl_fish_habitat` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_fish_habitat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_fish_species`
--

DROP TABLE IF EXISTS `tbl_fish_species`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_fish_species` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `species_code` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `family_id` bigint unsigned NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scientific_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_fish_species_family_id_foreign` (`family_id`),
  CONSTRAINT `tbl_fish_species_family_id_foreign` FOREIGN KEY (`family_id`) REFERENCES `tbl_fish_family` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_fish_species`
--

LOCK TABLES `tbl_fish_species` WRITE;
/*!40000 ALTER TABLE `tbl_fish_species` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_fish_species` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_fish_variety`
--

DROP TABLE IF EXISTS `tbl_fish_variety`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_fish_variety` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fish_code` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `species_id` bigint unsigned NOT NULL,
  `common_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scientific_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size_cm` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qtyperbag` int DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `size` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_fish_variety_species_id_foreign` (`species_id`),
  CONSTRAINT `tbl_fish_variety_species_id_foreign` FOREIGN KEY (`species_id`) REFERENCES `tbl_fish_species` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_fish_variety`
--

LOCK TABLES `tbl_fish_variety` WRITE;
/*!40000 ALTER TABLE `tbl_fish_variety` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_fish_variety` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_notifications`
--

DROP TABLE IF EXISTS `tbl_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `notifications` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `seen_status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_notifications_user_id_foreign` (`user_id`),
  CONSTRAINT `tbl_notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_notifications`
--

LOCK TABLES `tbl_notifications` WRITE;
/*!40000 ALTER TABLE `tbl_notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_order_det`
--

DROP TABLE IF EXISTS `tbl_order_det`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_order_det` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `order_no` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fish_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `per_bag` int DEFAULT NULL,
  `orders` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `bags` int DEFAULT NULL,
  `boxes` int DEFAULT NULL,
  `approval_status` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_order_det_order_id_foreign` (`order_id`),
  CONSTRAINT `tbl_order_det_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `tbl_order_mst` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_order_det`
--

LOCK TABLES `tbl_order_det` WRITE;
/*!40000 ALTER TABLE `tbl_order_det` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_order_det` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_order_mst`
--

DROP TABLE IF EXISTS `tbl_order_mst`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_order_mst` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cus_id` bigint unsigned NOT NULL,
  `customer_name` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_no` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executive_id` bigint unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tot_orders` int DEFAULT NULL,
  `tot_bags` int DEFAULT NULL,
  `tot_boxes` int DEFAULT NULL,
  `tot_fish` int DEFAULT NULL,
  `advanced_payment` decimal(10,2) DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `delivery_date` date DEFAULT NULL,
  `order_total` decimal(10,2) DEFAULT NULL,
  `discount_applied` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_order_mst_cus_id_foreign` (`cus_id`),
  KEY `tbl_order_mst_executive_id_foreign` (`executive_id`),
  CONSTRAINT `tbl_order_mst_cus_id_foreign` FOREIGN KEY (`cus_id`) REFERENCES `tbl_customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tbl_order_mst_executive_id_foreign` FOREIGN KEY (`executive_id`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_order_mst`
--

LOCK TABLES `tbl_order_mst` WRITE;
/*!40000 ALTER TABLE `tbl_order_mst` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_order_mst` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_priv_category`
--

DROP TABLE IF EXISTS `tbl_priv_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_priv_category` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_priv_category`
--

LOCK TABLES `tbl_priv_category` WRITE;
/*!40000 ALTER TABLE `tbl_priv_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_priv_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_priv_subcategory`
--

DROP TABLE IF EXISTS `tbl_priv_subcategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_priv_subcategory` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` bigint unsigned NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_priv_subcategory_cat_id_foreign` (`cat_id`),
  CONSTRAINT `tbl_priv_subcategory_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `tbl_priv_category` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_priv_subcategory`
--

LOCK TABLES `tbl_priv_subcategory` WRITE;
/*!40000 ALTER TABLE `tbl_priv_subcategory` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_priv_subcategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_privilege_mst`
--

DROP TABLE IF EXISTS `tbl_privilege_mst`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_privilege_mst` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` bigint unsigned NOT NULL,
  `subcat_id` bigint unsigned NOT NULL,
  `sec_id` bigint unsigned NOT NULL,
  `user_type` bigint unsigned NOT NULL,
  `route_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission` tinyint DEFAULT NULL,
  `cre_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_privilege_mst_cat_id_foreign` (`cat_id`),
  KEY `tbl_privilege_mst_subcat_id_foreign` (`subcat_id`),
  KEY `tbl_privilege_mst_sec_id_foreign` (`sec_id`),
  KEY `tbl_privilege_mst_user_type_foreign` (`user_type`),
  CONSTRAINT `tbl_privilege_mst_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `tbl_priv_category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tbl_privilege_mst_sec_id_foreign` FOREIGN KEY (`sec_id`) REFERENCES `tbl_privilege_section` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tbl_privilege_mst_subcat_id_foreign` FOREIGN KEY (`subcat_id`) REFERENCES `tbl_priv_subcategory` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tbl_privilege_mst_user_type_foreign` FOREIGN KEY (`user_type`) REFERENCES `tbl_usertype` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_privilege_mst`
--

LOCK TABLES `tbl_privilege_mst` WRITE;
/*!40000 ALTER TABLE `tbl_privilege_mst` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_privilege_mst` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_privilege_section`
--

DROP TABLE IF EXISTS `tbl_privilege_section`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_privilege_section` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` bigint unsigned NOT NULL,
  `subcat_id` bigint unsigned NOT NULL,
  `route_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cre_user` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_privilege_section_cat_id_foreign` (`cat_id`),
  KEY `tbl_privilege_section_subcat_id_foreign` (`subcat_id`),
  KEY `tbl_privilege_section_cre_user_foreign` (`cre_user`),
  CONSTRAINT `tbl_privilege_section_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `tbl_priv_category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tbl_privilege_section_cre_user_foreign` FOREIGN KEY (`cre_user`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tbl_privilege_section_subcat_id_foreign` FOREIGN KEY (`subcat_id`) REFERENCES `tbl_priv_subcategory` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_privilege_section`
--

LOCK TABLES `tbl_privilege_section` WRITE;
/*!40000 ALTER TABLE `tbl_privilege_section` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_privilege_section` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_reset_password_req`
--

DROP TABLE IF EXISTS `tbl_reset_password_req`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_reset_password_req` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `reasons` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `new_password` text COLLATE utf8mb4_unicode_ci,
  `email_status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_reset_password_req`
--

LOCK TABLES `tbl_reset_password_req` WRITE;
/*!40000 ALTER TABLE `tbl_reset_password_req` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_reset_password_req` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_size`
--

DROP TABLE IF EXISTS `tbl_size`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_size` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_size`
--

LOCK TABLES `tbl_size` WRITE;
/*!40000 ALTER TABLE `tbl_size` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_size` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_auth_log`
--

DROP TABLE IF EXISTS `tbl_user_auth_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_user_auth_log` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `username` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_user_auth_log_user_id_foreign` (`user_id`),
  CONSTRAINT `tbl_user_auth_log_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_auth_log`
--

LOCK TABLES `tbl_user_auth_log` WRITE;
/*!40000 ALTER TABLE `tbl_user_auth_log` DISABLE KEYS */;
INSERT INTO `tbl_user_auth_log` VALUES (1,'127.0.0.1',1,'admin','user logged in successfully','User Logged In','2024-10-19 17:53:21','2024-10-19 17:53:21'),(2,'127.0.0.1',1,'admin','user logged in successfully','User Logged In','2024-10-19 17:55:58','2024-10-19 17:55:58'),(3,'127.0.0.1',1,'admin','user logged in successfully','User Logged In','2024-10-20 13:19:43','2024-10-20 13:19:43'),(4,'127.0.0.1',1,'admin','user logged out successfully','User Logged Out','2024-10-20 15:46:51','2024-10-20 15:46:51');
/*!40000 ALTER TABLE `tbl_user_auth_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tbl_usertype_id` bigint unsigned NOT NULL,
  `fname` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_status` tinyint DEFAULT NULL,
  `email` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `primary_contact` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secondary_contact` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` text COLLATE utf8mb4_unicode_ci,
  `avatar` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_users_tbl_usertype_id_foreign` (`tbl_usertype_id`),
  CONSTRAINT `tbl_users_tbl_usertype_id_foreign` FOREIGN KEY (`tbl_usertype_id`) REFERENCES `tbl_usertype` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_users`
--

LOCK TABLES `tbl_users` WRITE;
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` VALUES (1,'admin','$2y$10$LwzfgkQ2/3EEEvsX1V7g/./nkLdFO1KwCDKbFZwpnYB/bH8ITpcTe',1,'Admin',NULL,'Bio World Holdings',1,'','0713452345',NULL,'',NULL,NULL,'2024-10-20 15:46:51');
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usertype`
--

DROP TABLE IF EXISTS `tbl_usertype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_usertype` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usertype`
--

LOCK TABLES `tbl_usertype` WRITE;
/*!40000 ALTER TABLE `tbl_usertype` DISABLE KEYS */;
INSERT INTO `tbl_usertype` VALUES (1,'Administrator',NULL,NULL);
/*!40000 ALTER TABLE `tbl_usertype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `test` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `message` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_activity` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test`
--

LOCK TABLES `test` WRITE;
/*!40000 ALTER TABLE `test` DISABLE KEYS */;
INSERT INTO `test` VALUES (1,'false','2024-10-19','2024-10-19 17:55:58',NULL),(2,'false','2024-10-19','2024-10-19 17:56:05',NULL),(3,'false','2024-10-19','2024-10-19 17:56:17',NULL),(4,'false','2024-10-19','2024-10-19 18:01:21',NULL),(5,'false','2024-10-19','2024-10-19 18:02:48',NULL),(6,'false',NULL,'2024-10-20 13:19:43',NULL);
/*!40000 ALTER TABLE `test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `websockets_statistics_entries`
--

DROP TABLE IF EXISTS `websockets_statistics_entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `websockets_statistics_entries` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `app_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peak_connection_count` int NOT NULL,
  `websocket_message_count` int NOT NULL,
  `api_message_count` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `websockets_statistics_entries`
--

LOCK TABLES `websockets_statistics_entries` WRITE;
/*!40000 ALTER TABLE `websockets_statistics_entries` DISABLE KEYS */;
/*!40000 ALTER TABLE `websockets_statistics_entries` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-18  9:02:08
