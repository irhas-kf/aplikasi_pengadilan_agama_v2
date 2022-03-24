/*
SQLyog Ultimate v10.42 
MySQL - 5.5.5-10.4.11-MariaDB : Database - db_pengadilanagama
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_pengadilanagama` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_pengadilanagama`;

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `tb_laporan` */

DROP TABLE IF EXISTS `tb_laporan`;

CREATE TABLE `tb_laporan` (
  `id_laporan` int(11) NOT NULL AUTO_INCREMENT,
  `judul_laporan` varchar(100) NOT NULL,
  `bulan_tahun_laporan` varchar(100) NOT NULL,
  `tanggal_pengajuan_laporan` varchar(100) DEFAULT NULL,
  `tanggal_konfirmasi_valid_laporan` varchar(100) DEFAULT NULL,
  `status_laporan` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  PRIMARY KEY (`id_laporan`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

/*Data for the table `tb_laporan` */

/*Table structure for table `tb_laporan_detail` */

DROP TABLE IF EXISTS `tb_laporan_detail`;

CREATE TABLE `tb_laporan_detail` (
  `id_laporan_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_laporan` int(100) NOT NULL,
  `id_nama_laporan` int(100) NOT NULL,
  `file_laporan` varchar(100) NOT NULL,
  `ekstensi_laporan` varchar(100) NOT NULL,
  `status_laporan_detail` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  PRIMARY KEY (`id_laporan_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

/*Data for the table `tb_laporan_detail` */

/*Table structure for table `tb_laporan_detail_revisi` */

DROP TABLE IF EXISTS `tb_laporan_detail_revisi`;

CREATE TABLE `tb_laporan_detail_revisi` (
  `id_laporan_detail_revisi` int(11) NOT NULL AUTO_INCREMENT,
  `id_laporan_detail` int(100) NOT NULL,
  `catatan_revisi` longtext DEFAULT NULL,
  `updated_at` varchar(100) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  PRIMARY KEY (`id_laporan_detail_revisi`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `tb_laporan_detail_revisi` */

/*Table structure for table `tb_nama_laporan` */

DROP TABLE IF EXISTS `tb_nama_laporan`;

CREATE TABLE `tb_nama_laporan` (
  `id_nama_laporan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_laporan` varchar(100) NOT NULL,
  PRIMARY KEY (`id_nama_laporan`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tb_nama_laporan` */

insert  into `tb_nama_laporan`(`id_nama_laporan`,`nama_laporan`) values (1,'pp39'),(2,'perkara'),(3,'lpj01'),(4,'lpj04');

/*Table structure for table `tb_perencanaan_anggaran` */

DROP TABLE IF EXISTS `tb_perencanaan_anggaran`;

CREATE TABLE `tb_perencanaan_anggaran` (
  `id_perencanaan_anggaran` int(11) NOT NULL AUTO_INCREMENT,
  `nilai_perencanaan_anggaran` int(11) NOT NULL,
  `tanggal_perencanaan_anggaran` varchar(100) NOT NULL,
  PRIMARY KEY (`id_perencanaan_anggaran`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

/*Data for the table `tb_perencanaan_anggaran` */

/*Table structure for table `tb_realisasi_anggaran` */

DROP TABLE IF EXISTS `tb_realisasi_anggaran`;

CREATE TABLE `tb_realisasi_anggaran` (
  `id_realisasi_anggaran` int(11) NOT NULL AUTO_INCREMENT,
  `nilai_realisasi_anggaran` varchar(100) NOT NULL,
  `tanggal_realisasi_anggaran` varchar(100) NOT NULL,
  PRIMARY KEY (`id_realisasi_anggaran`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `tb_realisasi_anggaran` */

/*Table structure for table `tb_saldo` */

DROP TABLE IF EXISTS `tb_saldo`;

CREATE TABLE `tb_saldo` (
  `id_saldo` int(11) NOT NULL AUTO_INCREMENT,
  `nominal` int(11) DEFAULT NULL,
  `tergunakan` int(11) DEFAULT NULL,
  `sisa` int(11) DEFAULT NULL,
  `tanggal` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_saldo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_saldo` */

insert  into `tb_saldo`(`id_saldo`,`nominal`,`tergunakan`,`sisa`,`tanggal`) values (6,1500000,0,1500000,'2020-09-01'),(8,2000000,0,2000000,'2019-09-01');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`level`,`created_at`,`updated_at`) values (1,'admin','admin@gmail.com',NULL,'$2y$10$YMaLuWc0P3Ajfn3DSJEcr.ODrMyPSfbmJV7CaBum6NwMi46uZs9xW','wPhSza4B9lfgbmnV5CVdcHTrnACpwVE86YJiH97xIx2P4bN2hbWAx2creUen','admin','2020-09-09 05:19:03','2020-09-09 05:19:03'),(2,'pimpinan','pimpinan@gmail.com',NULL,'$2y$10$YMaLuWc0P3Ajfn3DSJEcr.ODrMyPSfbmJV7CaBum6NwMi46uZs9xW',NULL,'pimpinan','2020-09-09 05:19:03','2020-09-09 05:19:03'),(3,'operator','operator@gmail.com',NULL,'$2y$10$YMaLuWc0P3Ajfn3DSJEcr.ODrMyPSfbmJV7CaBum6NwMi46uZs9xW','AwHbLCcO8zHQwD4yhxMDK3AsMd2KabeiHIHY1h06JyKQEIeqpw7NUeW9vN2S','operator','2020-09-09 05:19:03','2020-09-09 05:19:03');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
