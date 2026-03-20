-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 19-03-2026 a las 14:44:34
-- Versión del servidor: 8.1.0
-- Versión de PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `catalogosaas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `analytics_events`
--

DROP TABLE IF EXISTS `analytics_events`;
CREATE TABLE IF NOT EXISTS `analytics_events` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tenant_id` bigint UNSIGNED NOT NULL,
  `event_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entity_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entity_id` bigint UNSIGNED DEFAULT NULL,
  `source` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `analytics_events_tenant_id_event_type_index` (`tenant_id`,`event_type`),
  KEY `analytics_events_tenant_id_entity_type_entity_id_index` (`tenant_id`,`entity_type`,`entity_id`),
  KEY `analytics_events_tenant_id_source_index` (`tenant_id`,`source`),
  KEY `analytics_events_tenant_id_created_at_index` (`tenant_id`,`created_at`),
  KEY `analytics_events_tenant_id_index` (`tenant_id`),
  KEY `analytics_events_event_type_index` (`event_type`),
  KEY `analytics_events_entity_type_index` (`entity_type`),
  KEY `analytics_events_entity_id_index` (`entity_id`),
  KEY `analytics_events_source_index` (`source`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `analytics_events`
--

INSERT INTO `analytics_events` (`id`, `tenant_id`, `event_type`, `entity_type`, `entity_id`, `source`, `ip`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, 2, 'menu_view', NULL, NULL, 'direct', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-03-11 23:52:04', '2026-03-11 23:52:04'),
(2, 2, 'menu_view', NULL, NULL, 'direct', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-03-12 00:00:04', '2026-03-12 00:00:04'),
(3, 2, 'menu_view', NULL, NULL, 'direct', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-03-12 00:00:50', '2026-03-12 00:00:50'),
(4, 2, 'menu_view', NULL, NULL, 'direct', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-03-12 00:01:42', '2026-03-12 00:01:42'),
(5, 2, 'menu_view', NULL, NULL, 'direct', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-03-12 00:02:52', '2026-03-12 00:02:52'),
(6, 2, 'menu_view', NULL, NULL, 'direct', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-03-12 00:02:55', '2026-03-12 00:02:55'),
(7, 2, 'menu_view', NULL, NULL, 'direct', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-03-12 01:14:45', '2026-03-12 01:14:45'),
(8, 2, 'menu_view', NULL, NULL, 'direct', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-03-12 01:21:27', '2026-03-12 01:21:27'),
(9, 2, 'menu_view', NULL, NULL, 'direct', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-03-12 01:24:01', '2026-03-12 01:24:01'),
(10, 2, 'menu_view', NULL, NULL, 'direct', '127.0.0.1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Mobile Safari/537.36', '2026-03-12 01:50:54', '2026-03-12 01:50:54'),
(11, 2, 'menu_view', NULL, NULL, 'direct', '127.0.0.1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Mobile Safari/537.36', '2026-03-12 01:52:08', '2026-03-12 01:52:08'),
(12, 3, 'menu_view', NULL, NULL, 'direct', '127.0.0.1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Mobile Safari/537.36', '2026-03-12 01:56:32', '2026-03-12 01:56:32'),
(13, 3, 'menu_view', NULL, NULL, 'direct', '127.0.0.1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Mobile Safari/537.36', '2026-03-12 01:56:38', '2026-03-12 01:56:38'),
(14, 3, 'menu_view', NULL, NULL, 'direct', '127.0.0.1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Mobile Safari/537.36', '2026-03-12 04:11:28', '2026-03-12 04:11:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tenant_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_tenant_id_slug_unique` (`tenant_id`,`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `tenant_id`, `name`, `slug`, `description`, `image_path`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 3, 'Panificados', 'panificados', 'Pan casero y especialidades', 'tenants/panaderiadonjuan/categories/69a8a903b03a3.webp', 1, '2026-03-02 00:30:31', '2026-03-05 00:49:55'),
(4, 3, 'Bebidas', 'bebidas', 'gaseosas, jugos', 'tenants/panaderiadonjuan/categories/69a8a8fa5c76b.webp', 1, '2026-03-02 16:48:05', '2026-03-05 00:49:46'),
(5, 2, 'Bebidas', 'bebidas', 'Bebidas frías, gaseosas etc', NULL, 1, '2026-03-02 17:23:09', '2026-03-03 03:27:07'),
(6, 2, 'Cafés', 'cafes', 'cafe de diferentes sabores', 'tenants/cafedelcentro/categories/69ac38e8ab869.webp', 1, '2026-03-02 17:35:04', '2026-03-07 17:40:40'),
(7, 3, 'Facturas Dulcesss', 'facturas-dulcesss', 'variedad de facturas dulces', 'tenants/panaderiadonjuan/categories/69a8a8efd2f90.webp', 1, '2026-03-04 00:14:02', '2026-03-05 00:49:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_03_01_231916_create_plans_table', 2),
(5, '2026_03_01_231926_create_tenants_table', 2),
(6, '2026_03_01_231934_add_tenant_id_to_users_table', 2),
(7, '2026_03_02_002221_create_categories_table', 3),
(8, '2026_03_02_235502_create_products_table', 4),
(9, '2026_03_06_143321_add_whatsapp_fields_to_tenants_table', 5),
(10, '2026_03_06_150406_rename_subdomain_to_slug_in_tenants_table', 6),
(11, '2026_03_07_031911_remove_email_from_tenants_table', 7),
(12, '2026_03_08_224644_add_business_fields_to_tenants_table', 8),
(13, '2026_03_09_000436_add_indexes_to_catalog_tables', 9),
(14, '2026_03_10_153829_create_analytics_events_table', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plans`
--

DROP TABLE IF EXISTS `plans`;
CREATE TABLE IF NOT EXISTS `plans` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `duration_days` int NOT NULL,
  `max_products` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `plans`
--

INSERT INTO `plans` (`id`, `name`, `price`, `duration_days`, `max_products`, `created_at`, `updated_at`) VALUES
(1, 'Plan Básico', 10000.00, 30, 50, '2026-03-01 23:48:37', '2026-03-07 19:31:53'),
(2, 'Premium Pro', 15000.00, 30, 1000, '2026-03-07 00:50:10', '2026-03-07 06:31:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tenant_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_tenant_id_slug_unique` (`tenant_id`,`slug`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_tenant_id_category_id_index` (`tenant_id`,`category_id`),
  KEY `products_tenant_id_index` (`tenant_id`),
  KEY `products_tenant_id_is_available_index` (`tenant_id`,`is_available`),
  KEY `products_tenant_id_name_index` (`tenant_id`,`name`),
  KEY `products_tenant_id_created_at_index` (`tenant_id`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `tenant_id`, `category_id`, `name`, `slug`, `description`, `price`, `image_path`, `is_available`, `created_at`, `updated_at`) VALUES
(3, 2, 6, 'Café helado', 'cafe-helado', 'cafe helado con hielo', 3500.00, 'tenants/cafedelcentro/products/69a8f7843169d.webp', 1, '2026-03-03 03:30:38', '2026-03-05 06:24:52'),
(4, 3, 4, 'Aquarios Pera 750ml', 'aquarios-pera-750ml', 'aquarios sabor pera', 2500.00, 'tenants//products/69ac36a26289f.webp', 1, '2026-03-03 03:31:29', '2026-03-07 17:30:58'),
(5, 2, 5, 'Coca Cola 500ml', 'coca-cola-500ml', 'Bebida sabor Cola', 2600.00, 'tenants/cafedelcentro/products/69a8e857e0a4f.webp', 1, '2026-03-05 05:20:08', '2026-03-07 19:11:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('7UAyETM9BdbLFKnFaBODWxm9hAaLesuw0esqJX9W', NULL, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRG9oVHpCUDY2eEt1R0hCWjRuU2t5dWw0TFV6S1Mzc0huSlZGdjU2ZyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wYW5hZGVyaWFkb25qdWFuIjtzOjU6InJvdXRlIjtzOjE4OiJ0ZW5hbnQucHVibGljLm1lbnUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1773277888),
('mmh1mVdBi7Hq0Mb4dB6EbsZWe4qx2AZZ6kbzzUGs', 2, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Mobile Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaEdJT2Eydzk4Sk9qQml3ODNYcXp1RlF2VFJNcjloZE1GTnBqVlNsbSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wYW5hZGVyaWFkb25qdWFuIjtzOjU6InJvdXRlIjtzOjE4OiJ0ZW5hbnQucHVibGljLm1lbnUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1773269798);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tenants`
--

DROP TABLE IF EXISTS `tenants`;
CREATE TABLE IF NOT EXISTS `tenants` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_id` bigint UNSIGNED NOT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `subscription_ends_at` timestamp NULL DEFAULT NULL,
  `status` enum('trial','active','suspended','expired') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'trial',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `whatsapp_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp_message` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tenants_subdomain_unique` (`slug`),
  KEY `tenants_plan_id_foreign` (`plan_id`),
  KEY `tenants_subdomain_index` (`slug`),
  KEY `tenants_status_index` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tenants`
--

INSERT INTO `tenants` (`id`, `name`, `slug`, `plan_id`, `trial_ends_at`, `subscription_ends_at`, `status`, `created_at`, `updated_at`, `whatsapp_number`, `whatsapp_message`, `instagram`, `facebook`, `description`, `address`, `logo_path`) VALUES
(2, 'Café del Centro', 'cafedelcentro', 1, '2026-03-16 23:50:31', '2026-03-31 23:50:31', 'active', '2026-03-01 23:50:31', '2026-03-09 18:08:38', NULL, NULL, 'https:ig', 'facebok', 'Abrimos de lunes a viernes de 8 a 17 y fin de semana 10 a 14hs.', 'Rolon 410', 'tenants/cafedelcentro/logo/69aee2762321e.webp'),
(3, 'Panadería Don Juan', 'panaderiadonjuan', 2, '2026-03-02 00:29:28', '2026-04-01 00:29:28', 'active', '2026-03-02 00:29:28', '2026-03-07 06:09:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tenant_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('owner','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'owner',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_tenant_id_index` (`tenant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `tenant_id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Juanma Aguirre', 'juanmagoya15@gmail.com', NULL, '$2y$12$zPI3bzQiWXTz5UQuxZUM7.mRpEwvpB4LbyoBXVUGy.ApyMQ5CF9ym', 'admin', NULL, '2026-03-03 04:39:12', '2026-03-07 17:50:34'),
(2, 2, 'Cecilia', 'ceci@gmail.com', NULL, '$2y$12$koAQ.GhOb/OqJCxIybSrouxczDARLK49Wc5a8vz34QINf.R5OVdKS', 'owner', NULL, '2026-03-03 06:49:01', '2026-03-03 06:49:01'),
(3, 3, 'juan ramon', 'juan@gmail.com', NULL, '$2y$12$IvK11ZLaU0DdsSYRrtMSC.cY9GJJdwRmb3Pg24E9HZlz0X1w.S2ym', 'owner', NULL, '2026-03-03 23:51:59', '2026-03-03 23:51:59');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tenants`
--
ALTER TABLE `tenants`
  ADD CONSTRAINT `tenants_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
