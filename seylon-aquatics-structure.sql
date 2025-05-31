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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-18  9:02:59
