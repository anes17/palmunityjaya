-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 8.0.30 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk toko_online
DROP DATABASE IF EXISTS `toko_online`;
CREATE DATABASE IF NOT EXISTS `toko_online` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `toko_online`;

-- membuang struktur untuk table toko_online.kategori
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE IF NOT EXISTS `kategori` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel toko_online.kategori: ~3 rows (lebih kurang)
INSERT INTO `kategori` (`id`, `nama`) VALUES
	(4, 'baju pria'),
	(5, 'baju wanita'),
	(8, 'jam tangan');

-- membuang struktur untuk table toko_online.produk
DROP TABLE IF EXISTS `produk`;
CREATE TABLE IF NOT EXISTS `produk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kategori_id` int NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `harga` double NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `detail` text,
  `ketersediaan_stok` enum('habis','tersedia') DEFAULT 'tersedia',
  PRIMARY KEY (`id`),
  KEY `nama` (`nama`),
  KEY `kategori_produk` (`kategori_id`),
  CONSTRAINT `kategori_produk` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel toko_online.produk: ~15 rows (lebih kurang)
INSERT INTO `produk` (`id`, `kategori_id`, `nama`, `harga`, `foto`, `detail`, `ketersediaan_stok`) VALUES
	(1, 4, 'baju nike', 500000, 'P6aCbL6p9D.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex quaerat expedita modi, voluptatibus illo ullam reprehenderit doloremque maxime blanditiis sapiente?\r\n', 'tersedia'),
	(2, 4, 'adidas', 250000, 'GDqAOOuiXD.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex quaerat expedita modi, voluptatibus illo ullam reprehenderit doloremque maxime blanditiis sapiente?\r\n', 'tersedia'),
	(3, 5, 'baju muslim wanita', 110000, '6PS1Fhinvi.jpg', '', 'tersedia'),
	(4, 5, 'Baju polos modis', 20000, 'kmDFswwuww.jpg', '', 'tersedia'),
	(5, 5, 'Sablon Modis', 50000, 'ugArlxmV1I.jpg', '', 'tersedia'),
	(6, 8, 'Rolex', 10000000, '3LoCcaUoy7.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex quaerat expedita modi, voluptatibus illo ullam reprehenderit doloremque maxime blanditiis sapiente?\r\n', 'tersedia'),
	(7, 4, 'baju motif', 200000, '5ZcvrFzrw5.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex quaerat expedita modi, voluptatibus illo ullam\r\n', 'tersedia'),
	(8, 4, 'baju merah', 500000, '8eruvSW7iK.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex quaerat expedita modi, voluptatibus illo ullam reprehenderit ', 'tersedia'),
	(9, 5, 'kemeja', 350000, 'qKrsr0x5ZT.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex quaerat expedita modi, voluptatibus\r\n', 'tersedia'),
	(10, 4, 'sablon punggung', 70000, 'lfvO7nZHzB.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex quaerat expedita modi, voluptatibus illo ullam reprehenderit doloremque maxime blanditiis sapiente?\r\n', 'tersedia'),
	(11, 4, 'corak kecil', 50000, '0qIbUlNlPS.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex quaerat expedita modi, voluptatibus illo ullam reprehenderit doloremque maxime blanditiis sapiente?\r\n', 'tersedia'),
	(12, 5, 'polos puth', 80000, 'Sic7Q2wgEV.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex quaerat expedita modi, voluptatibus illo ullam reprehenderit doloremque maxime blanditiis sapiente?\r\n', 'tersedia'),
	(13, 4, 'polos hitam', 120000, 'n9GyHbYmUp.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex quaerat expedita modi, voluptatibus illo ullam reprehenderit doloremque maxime blanditiis sapiente?\r\n', 'tersedia'),
	(14, 8, 'alexandre christie', 2000000, 'ZNwjqS5A6b.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex quaerat expedita modi, voluptatibus illo ullam reprehenderit doloremque maxime blanditiis sapiente?\r\n', 'tersedia'),
	(15, 8, 'jam elegan', 300000, 'WQVUCxioS6.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex quaerat expedita modi, voluptatibus illo ullam reprehenderit doloremque maxime blanditiis sapiente?\r\n', 'tersedia');

-- membuang struktur untuk table toko_online.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel toko_online.users: ~1 rows (lebih kurang)
INSERT INTO `users` (`id`, `username`, `password`) VALUES
	(2, 'admin', '$2y$10$KQr3MBCiQ7va6lUKY9UXke7rDz55sBSARudeTtWiyHVvMSU.JA92e');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
