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

insert  into `password_resets`(`email`,`token`,`created_at`) values ('irhas.cepunk@gmail.com','$2y$10$a/oOTCvENJd7V4GFwG46v.kh8hHfGDXTbensYdjmBcJNh4EK/03pi','2020-11-27 02:00:30');

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
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

/*Data for the table `tb_laporan` */

insert  into `tb_laporan`(`id_laporan`,`judul_laporan`,`bulan_tahun_laporan`,`tanggal_pengajuan_laporan`,`tanggal_konfirmasi_valid_laporan`,`status_laporan`,`updated_at`,`created_at`) values (32,'Laporan Satu Bulan Januari','01-2020','2020-11-27 02:12:42','2020-11-27 02:13:13','valid','2020-11-27 02:56:16','2020-11-27 02:10:08'),(34,'Laporan Dua Bulan Februari','02-2020','2020-11-27 02:58:14','2020-11-27 02:58:27','valid','2020-11-27 02:58:14','2020-11-27 02:56:33'),(35,'Laporan Oktober','10-2020','2020-11-29 09:50:32','2020-11-29 09:51:15','valid','2020-11-29 09:50:32','2020-11-29 09:47:11'),(36,'Laporan Desember','12-2020','2020-11-29 09:56:58','2020-11-29 09:58:36','valid','2020-11-29 09:56:58','2020-11-29 09:56:11'),(37,'Laporan Bulan Maret','03-2020','2020-11-29 10:01:42','2020-11-29 10:02:37','valid','2020-11-29 10:01:42','2020-11-29 10:01:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

/*Data for the table `tb_laporan_detail` */

insert  into `tb_laporan_detail`(`id_laporan_detail`,`id_laporan`,`id_nama_laporan`,`file_laporan`,`ekstensi_laporan`,`status_laporan_detail`,`updated_at`,`created_at`) values (57,32,1,'16064430335fc06019617b1.pdf','pdf','valid','2020-11-27 02:11:33','2020-11-27 02:10:33'),(58,32,2,'16064430565fc06030a3352.pdf','pdf','valid','2020-11-27 02:11:34','2020-11-27 02:10:56'),(59,32,3,'16064431475fc0608b53210.xlsx','xlsx','valid','2020-11-27 02:13:10','2020-11-27 02:12:27'),(60,32,4,'16064431595fc06097aba02.xlsx','xlsx','valid','2020-11-27 02:13:13','2020-11-27 02:12:39'),(62,34,1,'16064458105fc06af28428d.pdf','pdf','valid','2020-11-27 02:57:24','2020-11-27 02:56:50'),(63,34,2,'16064458675fc06b2b75a6b.pdf','pdf','valid','2020-11-27 02:58:25','2020-11-27 02:57:47'),(64,34,4,'16064458925fc06b446cb63.pdf','pdf','valid','2020-11-27 02:58:27','2020-11-27 02:58:12'),(65,35,1,'16066432515fc36e33463c9.pdf','pdf','valid','2020-11-29 09:48:14','2020-11-29 09:47:31'),(66,35,2,'16066434035fc36ecb8e579.xlsx','xlsx','valid','2020-11-29 09:50:44','2020-11-29 09:50:03'),(67,35,3,'16066434135fc36ed5ee82d.pdf','pdf','valid','2020-11-29 09:51:15','2020-11-29 09:50:13'),(68,36,1,'16066437835fc37047dda91.xlsx','xlsx','valid','2020-11-29 09:57:21','2020-11-29 09:56:23'),(69,36,2,'16066437905fc3704eb100e.pdf','pdf','valid','2020-11-29 09:57:23','2020-11-29 09:56:30'),(70,36,3,'16066438065fc3705e87e1a.pdf','pdf','valid','2020-11-29 09:57:24','2020-11-29 09:56:46'),(71,36,4,'16066438145fc3706670714.pdf','pdf','valid','2020-11-29 09:58:36','2020-11-29 09:56:54'),(72,37,1,'16066440755fc3716b1c8f3.xlsx','xlsx','valid','2020-11-29 10:02:04','2020-11-29 10:01:15'),(73,37,2,'16066440815fc371717824c.pdf','pdf','valid','2020-11-29 10:02:19','2020-11-29 10:01:21'),(74,37,3,'16066440905fc3717a5a138.pdf','pdf','valid','2020-11-29 10:02:23','2020-11-29 10:01:30'),(75,37,4,'16066440995fc3718316b09.pdf','pdf','valid','2020-11-29 10:02:37','2020-11-29 10:01:39');

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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

/*Data for the table `tb_perencanaan_anggaran` */

insert  into `tb_perencanaan_anggaran`(`id_perencanaan_anggaran`,`nilai_perencanaan_anggaran`,`tanggal_perencanaan_anggaran`) values (29,500000,'2020-01-01'),(30,500000,'2020-02-01'),(31,200000,'2020-03-01'),(32,700000,'2020-12-01');

/*Table structure for table `tb_perencanaan_anggaran_mari` */

DROP TABLE IF EXISTS `tb_perencanaan_anggaran_mari`;

CREATE TABLE `tb_perencanaan_anggaran_mari` (
  `id_perencanaan_anggaran` int(11) NOT NULL AUTO_INCREMENT,
  `nilai_perencanaan_anggaran` int(11) NOT NULL,
  `tanggal_perencanaan_anggaran` varchar(100) NOT NULL,
  PRIMARY KEY (`id_perencanaan_anggaran`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

/*Data for the table `tb_perencanaan_anggaran_mari` */

insert  into `tb_perencanaan_anggaran_mari`(`id_perencanaan_anggaran`,`nilai_perencanaan_anggaran`,`tanggal_perencanaan_anggaran`) values (33,200000,'2020-01-01'),(34,300000,'2020-02-01'),(35,500000,'2020-03-01'),(36,600000,'2020-05-01');

/*Table structure for table `tb_realisasi_anggaran` */

DROP TABLE IF EXISTS `tb_realisasi_anggaran`;

CREATE TABLE `tb_realisasi_anggaran` (
  `id_realisasi_anggaran` int(11) NOT NULL AUTO_INCREMENT,
  `nilai_realisasi_anggaran` varchar(100) NOT NULL,
  `tanggal_realisasi_anggaran` varchar(100) NOT NULL,
  PRIMARY KEY (`id_realisasi_anggaran`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `tb_realisasi_anggaran` */

insert  into `tb_realisasi_anggaran`(`id_realisasi_anggaran`,`nilai_realisasi_anggaran`,`tanggal_realisasi_anggaran`) values (13,'300000','2020-01-01'),(16,'500000','2020-02-01'),(17,'200000','2020-03-01'),(18,'800000','2020-12-01');

/*Table structure for table `tb_realisasi_anggaran_mari` */

DROP TABLE IF EXISTS `tb_realisasi_anggaran_mari`;

CREATE TABLE `tb_realisasi_anggaran_mari` (
  `id_realisasi_anggaran` int(11) NOT NULL AUTO_INCREMENT,
  `nilai_realisasi_anggaran` varchar(100) NOT NULL,
  `tanggal_realisasi_anggaran` varchar(100) NOT NULL,
  PRIMARY KEY (`id_realisasi_anggaran`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `tb_realisasi_anggaran_mari` */

insert  into `tb_realisasi_anggaran_mari`(`id_realisasi_anggaran`,`nilai_realisasi_anggaran`,`tanggal_realisasi_anggaran`) values (19,'200000','2020-01-01'),(20,'300000','2020-02-01'),(21,'500000','2020-03-01');

/*Table structure for table `tb_saldo` */

DROP TABLE IF EXISTS `tb_saldo`;

CREATE TABLE `tb_saldo` (
  `id_saldo` int(11) NOT NULL AUTO_INCREMENT,
  `nominal` int(11) DEFAULT NULL,
  `tergunakan` int(11) DEFAULT NULL,
  `sisa` int(11) DEFAULT NULL,
  `tanggal` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_saldo`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_saldo` */

insert  into `tb_saldo`(`id_saldo`,`nominal`,`tergunakan`,`sisa`,`tanggal`) values (8,2000000,0,2000000,'2019-09-01'),(15,2000000,700000,1300000,'2020-12-17');

/*Table structure for table `tb_saldo_mari` */

DROP TABLE IF EXISTS `tb_saldo_mari`;

CREATE TABLE `tb_saldo_mari` (
  `id_saldo` int(11) NOT NULL AUTO_INCREMENT,
  `nominal` int(11) DEFAULT NULL,
  `tergunakan` int(11) DEFAULT NULL,
  `sisa` int(11) DEFAULT NULL,
  `tanggal` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_saldo`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_saldo_mari` */

insert  into `tb_saldo_mari`(`id_saldo`,`nominal`,`tergunakan`,`sisa`,`tanggal`) values (11,3000000,1600000,1400000,'2020-12-17');

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

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`level`,`created_at`,`updated_at`) values (1,'admin','admin@gmail.com','2020-11-27 00:00:00','$2y$10$YMaLuWc0P3Ajfn3DSJEcr.ODrMyPSfbmJV7CaBum6NwMi46uZs9xW','gC4hpJm83Yo7lyZNqUbuMUuw10qcZ6OYCsjG8NeDP7YDGcCAwBziaa8KZU4D','admin','2020-09-09 05:19:03','2020-09-09 05:19:03'),(2,'pimpinan','pimpinan@gmail.com',NULL,'$2y$10$YMaLuWc0P3Ajfn3DSJEcr.ODrMyPSfbmJV7CaBum6NwMi46uZs9xW',NULL,'pimpinan','2020-09-09 05:19:03','2020-09-09 05:19:03'),(3,'operator','operator@gmail.com',NULL,'$2y$10$YMaLuWc0P3Ajfn3DSJEcr.ODrMyPSfbmJV7CaBum6NwMi46uZs9xW','o48aWKtfrCzl5BXRsWh1wquSoC59CVPbFdxIl0XVswtUBXIqFbHX1sWHCqWo','operator','2020-09-09 05:19:03','2020-09-09 05:19:03');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
