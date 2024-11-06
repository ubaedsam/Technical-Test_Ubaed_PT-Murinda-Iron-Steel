-- --------------------------------------------------------
-- Host:                         localhost
-- Versi server:                 8.0.31 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk tugas_mis
CREATE DATABASE IF NOT EXISTS `tugas_mis` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `tugas_mis`;

-- membuang struktur untuk table tugas_mis.coa
CREATE TABLE IF NOT EXISTS `coa` (
  `mis_kodeacc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mis_ccy` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `namaacc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipeacc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `levelacc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parentacc` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `groupacc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `controlacc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `depart` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gainloss` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`mis_kodeacc`),
  KEY `coa_mis_ccy_foreign` (`mis_ccy`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel tugas_mis.coa: 5 rows
/*!40000 ALTER TABLE `coa` DISABLE KEYS */;
INSERT INTO `coa` (`mis_kodeacc`, `mis_ccy`, `namaacc`, `tipeacc`, `levelacc`, `parentacc`, `groupacc`, `controlacc`, `depart`, `gainloss`, `created_at`, `updated_at`) VALUES
	('Natus duis eligendi', 'CYY00001', 'Deacon Jacobson', 'general', '1', 'Dolor dolor officiis', 'capital', 'acc.paylable', NULL, NULL, '2024-11-06 03:01:13', '2024-11-06 03:01:13'),
	('Fugiat rerum labori', 'CYY00009', 'Daria Hughes', 'detil', '5', 'Natus duis eligendi', 'other_revenue', 'acc.paylable', 'Y', 'Y', '2024-11-06 03:03:01', '2024-11-06 03:03:01'),
	('Esse aliquip ex id', 'CYY00010', 'Hop Dawson', 'general', '1', 'Fugiat rerum labori', 'other_expences', 'cash/bank', 'Y', 'Y', '2024-11-06 03:30:43', '2024-11-06 03:30:43'),
	('Eligendi aliqua Exp baru', 'CYY00002', 'Lee Mccray baru', 'general', '2', 'Esse aliquip ex id', 'other_revenue', 'acc.receivable', 'Y', 'Y', '2024-11-06 03:31:43', '2024-11-06 04:19:24');
/*!40000 ALTER TABLE `coa` ENABLE KEYS */;

-- membuang struktur untuk table tugas_mis.currency
CREATE TABLE IF NOT EXISTS `currency` (
  `mis_ccy` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ccy` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`mis_ccy`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel tugas_mis.currency: 13 rows
/*!40000 ALTER TABLE `currency` DISABLE KEYS */;
INSERT INTO `currency` (`mis_ccy`, `ccy`, `name`, `created_at`, `updated_at`) VALUES
	('CYY00001', '123456789', 'US', '2024-11-04 23:35:48', '2024-11-06 01:25:27'),
	('CYY00002', 'Qui nostrum veniam', 'Diana Herman', '2024-11-05 20:47:35', '2024-11-05 20:47:35'),
	('CYY00003', 'Natus excepteur volu', 'Colorado Hensley', '2024-11-05 20:54:50', '2024-11-05 20:54:50'),
	('CYY00007', 'Autem perspiciatis', 'Ariana Bush', '2024-11-05 21:11:39', '2024-11-05 21:11:39'),
	('CYY00009', 'Similique rem sint q', 'Lenore Spencer', '2024-11-05 21:50:47', '2024-11-05 21:50:47'),
	('CYY00010', 'ada', '223', '2024-11-05 21:52:51', '2024-11-05 21:52:51'),
	('CYY00011', 'Ut molestiae distinc', 'Emi Willis', '2024-11-05 21:54:22', '2024-11-05 21:54:22'),
	('CYY00012', '12345', 'Emi Willis', '2024-11-05 21:54:36', '2024-11-05 21:54:36'),
	('CYY00013', '3253', '121212', '2024-11-05 21:57:14', '2024-11-05 21:57:14'),
	('CYY00014', 'Facilis quaerat nost', 'Testing 12', '2024-11-05 21:58:11', '2024-11-05 21:58:11'),
	('CYY00015', 'Consequatur eos mag baru', 'Testing ajah', '2024-11-05 21:58:59', '2024-11-06 08:15:41'),
	('CYY00016', 'Baru', 'Jena Mcpherson', '2024-11-06 01:01:38', '2024-11-06 01:01:38');
/*!40000 ALTER TABLE `currency` ENABLE KEYS */;

-- membuang struktur untuk table tugas_mis.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel tugas_mis.failed_jobs: 0 rows
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- membuang struktur untuk table tugas_mis.jrcode
CREATE TABLE IF NOT EXISTS `jrcode` (
  `jrcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_terakhir` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`jrcode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel tugas_mis.jrcode: 1 rows
/*!40000 ALTER TABLE `jrcode` DISABLE KEYS */;
INSERT INTO `jrcode` (`jrcode`, `nama`, `nomor_terakhir`, `keterangan`, `created_at`, `updated_at`) VALUES
	('Maiores ut rerum eiu baru', 'Eu non at tempor et baru', '2234', 'Cumque anim ex minim baru', '2024-11-05 21:54:04', '2024-11-05 22:33:04'),
	('Sint ipsam atque acc baru', 'Sed maiores voluptat', '2324535', 'Magnam labore dolore', '2024-11-06 07:37:13', '2024-11-06 08:08:05');
/*!40000 ALTER TABLE `jrcode` ENABLE KEYS */;

-- membuang struktur untuk table tugas_mis.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel tugas_mis.migrations: 8 rows
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2024_11_05_040108_create_currency_table', 1),
	(6, '2024_11_05_040243_create_jrcode_table', 1),
	(7, '2024_11_05_040258_create_coa_table', 1),
	(8, '2024_11_05_040312_create_transx_table', 1),
	(9, '2024_11_06_131831_add_depart_to_transx_table', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- membuang struktur untuk table tugas_mis.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel tugas_mis.password_resets: 0 rows
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- membuang struktur untuk table tugas_mis.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel tugas_mis.personal_access_tokens: 0 rows
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- membuang struktur untuk table tugas_mis.transx
CREATE TABLE IF NOT EXISTS `transx` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jrcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `nomor_ref` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mis_kodeacc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `debet` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kredit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `departemen` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transx_jrcode_foreign` (`jrcode`),
  KEY `transx_mis_kodeacc_foreign` (`mis_kodeacc`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel tugas_mis.transx: 2 rows
/*!40000 ALTER TABLE `transx` DISABLE KEYS */;
INSERT INTO `transx` (`id`, `jrcode`, `tanggal_transaksi`, `nomor_ref`, `remark`, `mis_kodeacc`, `description`, `debet`, `kredit`, `created_at`, `updated_at`, `departemen`) VALUES
	(4, 'Maiores ut rerum eiu baru', '2004-01-27', 'Quas recusandae Vel', 'Eu perferendis et id', 'Fugiat rerum labori', 'Magnam facere eum ex', 'Asperiores nobis pro', 'Tenetur omnis laboru', '2024-11-06 07:07:38', '2024-11-06 07:07:38', '0'),
	(3, 'Maiores ut rerum eiu baru', '1987-01-12', 'Aut laboriosam dict', 'Recusandae Et labor baru', 'Natus duis eligendi', 'Illo accusamus ex ne', 'Voluptas voluptatem', 'Omnis unde nemo est', '2024-11-06 06:50:15', '2024-11-06 07:53:06', '1');
/*!40000 ALTER TABLE `transx` ENABLE KEYS */;

-- membuang struktur untuk table tugas_mis.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel tugas_mis.users: 0 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
