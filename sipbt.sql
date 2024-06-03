-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table sipbt.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipbt.migrations: ~0 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(2, '2024_04_17_034135_tb_user', 1);

-- Dumping structure for table sipbt.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipbt.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table sipbt.tb_alamat
CREATE TABLE IF NOT EXISTS `tb_alamat` (
  `id_alamat` int NOT NULL AUTO_INCREMENT,
  `id_provinsi` int DEFAULT NULL,
  `id_kota` int DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_alamat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table sipbt.tb_alamat: ~0 rows (approximately)

-- Dumping structure for table sipbt.tb_alamatpengiriman
CREATE TABLE IF NOT EXISTS `tb_alamatpengiriman` (
  `alamatpengiriman_id` int NOT NULL AUTO_INCREMENT,
  `alamatpengiriman_user_id` varchar(255) DEFAULT NULL,
  `alamatpengiriman_alamat` varchar(255) DEFAULT NULL,
  `alamatpengiriman_deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamatpengiriman_created` varchar(255) DEFAULT NULL,
  `alamatpengiriman_updated` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`alamatpengiriman_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table sipbt.tb_alamatpengiriman: ~2 rows (approximately)
INSERT INTO `tb_alamatpengiriman` (`alamatpengiriman_id`, `alamatpengiriman_user_id`, `alamatpengiriman_alamat`, `alamatpengiriman_deskripsi`, `alamatpengiriman_created`, `alamatpengiriman_updated`) VALUES
	(1, '9', 'Wisma Lidah Kulon', 'Pagar Oren', '2024-05-17 16:11:23', '2024-05-17 16:11:23'),
	(3, '8', 'Wisma Lidah Kulon', 'Pager Pink', '2024-05-17 16:51:57', '2024-05-17 16:52:01');

-- Dumping structure for table sipbt.tb_keranjang
CREATE TABLE IF NOT EXISTS `tb_keranjang` (
  `id_keranjang` int NOT NULL AUTO_INCREMENT,
  `keranjang_id_produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `keranjang_id_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `qty_keranjang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kuantitas` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_keranjang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table sipbt.tb_keranjang: ~0 rows (approximately)

-- Dumping structure for table sipbt.tb_kuantitas
CREATE TABLE IF NOT EXISTS `tb_kuantitas` (
  `kuantitas_id` int NOT NULL AUTO_INCREMENT,
  `kuantitas_id_produk` varchar(255) DEFAULT NULL,
  `kuantitas_luaslahan` varchar(255) DEFAULT NULL,
  `kuantitas_jumlahbatang` varchar(255) DEFAULT NULL,
  `kuantitas_created` varchar(255) DEFAULT NULL,
  `kuantitas_updated` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kuantitas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table sipbt.tb_kuantitas: ~0 rows (approximately)

-- Dumping structure for table sipbt.tb_metodepembayaran
CREATE TABLE IF NOT EXISTS `tb_metodepembayaran` (
  `metodepembayaran_id` int NOT NULL AUTO_INCREMENT,
  `metodepembayaran_name` varchar(255) DEFAULT NULL,
  `metodepembayaran_bank` varchar(255) DEFAULT NULL,
  `metodepembayaran_numberbank` varchar(255) DEFAULT NULL,
  `metodepembayaran_created` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`metodepembayaran_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table sipbt.tb_metodepembayaran: ~0 rows (approximately)
INSERT INTO `tb_metodepembayaran` (`metodepembayaran_id`, `metodepembayaran_name`, `metodepembayaran_bank`, `metodepembayaran_numberbank`, `metodepembayaran_created`) VALUES
	(3, 'Bagus Setya', 'BCA', '50855599988', '2024-05-26 23:20:45');

-- Dumping structure for table sipbt.tb_pengiriman
CREATE TABLE IF NOT EXISTS `tb_pengiriman` (
  `id_pengiriman` int NOT NULL AUTO_INCREMENT,
  `id_transaksi` int DEFAULT NULL,
  `id_alamat` int DEFAULT NULL,
  PRIMARY KEY (`id_pengiriman`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table sipbt.tb_pengiriman: ~0 rows (approximately)

-- Dumping structure for table sipbt.tb_perkembangan
CREATE TABLE IF NOT EXISTS `tb_perkembangan` (
  `id_pbk` int NOT NULL AUTO_INCREMENT,
  `nama_bibit` varchar(255) DEFAULT NULL,
  `tgl_pkb` varchar(255) DEFAULT NULL,
  `umur_bibit` int DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pbk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table sipbt.tb_perkembangan: ~0 rows (approximately)

-- Dumping structure for table sipbt.tb_pesan
CREATE TABLE IF NOT EXISTS `tb_pesan` (
  `id_pesanan` int NOT NULL AUTO_INCREMENT,
  `nama_pesanan` varchar(255) DEFAULT NULL,
  `tgl_pesanan` varchar(255) DEFAULT NULL,
  `kuantitas` int DEFAULT NULL,
  `total_harga` int DEFAULT NULL,
  PRIMARY KEY (`id_pesanan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table sipbt.tb_pesan: ~0 rows (approximately)

-- Dumping structure for table sipbt.tb_produk
CREATE TABLE IF NOT EXISTS `tb_produk` (
  `id_produk` int NOT NULL AUTO_INCREMENT,
  `produk_id_user` varchar(255) DEFAULT NULL,
  `kode_bibit` varchar(255) DEFAULT NULL,
  `nama_bibit` varchar(255) DEFAULT NULL,
  `detail_bibit` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `harga_bibit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stok_bibit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gambar_bibit` varchar(255) DEFAULT NULL,
  `terjual_bibit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_bibit` varchar(255) DEFAULT NULL,
  `created_produk` varchar(255) DEFAULT NULL,
  `updated_produk` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table sipbt.tb_produk: ~0 rows (approximately)
INSERT INTO `tb_produk` (`id_produk`, `produk_id_user`, `kode_bibit`, `nama_bibit`, `detail_bibit`, `harga_bibit`, `stok_bibit`, `gambar_bibit`, `terjual_bibit`, `status_bibit`, `created_produk`, `updated_produk`) VALUES
	(57, '6', 'A001', 'Benih Bibit Cabai Rawit Pelita F1 - Cap Panah Merak', 'Cocok ditanaman di ketinggian di dataran rendah, menengah, dan tinggi. Umur panen 75-100 Hari Setelah Tanaman', '45000', '1', '79621715796157.png', NULL, '1', '2024-05-15 18:02:37', NULL);

-- Dumping structure for table sipbt.tb_stok
CREATE TABLE IF NOT EXISTS `tb_stok` (
  `id_bibit` int NOT NULL AUTO_INCREMENT,
  `stok_kode_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stok_jumlah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_bibit`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table sipbt.tb_stok: ~0 rows (approximately)
INSERT INTO `tb_stok` (`id_bibit`, `stok_kode_barang`, `stok_jumlah`, `created_at`, `updated_at`) VALUES
	(29, 'A001', '1', '2024-05-15 18:02:37', NULL);

-- Dumping structure for table sipbt.tb_transaksi
CREATE TABLE IF NOT EXISTS `tb_transaksi` (
  `id_transaksi` int NOT NULL AUTO_INCREMENT,
  `id_pesan` int DEFAULT NULL,
  `nama_bibit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kuantitas` int DEFAULT NULL,
  `total_harga` int DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table sipbt.tb_transaksi: ~0 rows (approximately)

-- Dumping structure for table sipbt.tb_user
CREATE TABLE IF NOT EXISTS `tb_user` (
  `id_user` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomortelepon_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipbt.tb_user: ~5 rows (approximately)
INSERT INTO `tb_user` (`id_user`, `nama_user`, `nomortelepon_user`, `alamat_user`, `email_user`, `username_user`, `password_user`, `role_user`, `status_user`, `created_user`, `updated_user`) VALUES
	(1, 'Meivy Bagus', '081280328853', 'Wsma Lidah Kulon XF-01', NULL, 'memebagus', '123456', '1', '1', '2024-04-17 11:26:51', NULL),
	(4, 'bagus', '081280328853', 'Wisma Lidah Kulon', NULL, 'baguss', '123456', '2', '1', '2024-05-05 06:07:14', '2024-05-05 06:51:49'),
	(6, 'Setya', '081280328853', 'Wisma Lidah Kulon', NULL, 'setya', '123456', '3', '1', '2024-05-09 00:05:42', NULL),
	(7, 'okok', '123456', 'okok', NULL, 'okok', '123456', '4', '1', '2024-05-09 22:49:10', NULL),
	(8, 'Bagus Setya Pradana', '081280328853', 'Wisma Lidah Kulon', NULL, 'meme11', '123456', '4', '1', '2024-05-17 15:42:25', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
