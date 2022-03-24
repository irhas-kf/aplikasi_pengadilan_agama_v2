-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Sep 2020 pada 15.36
-- Versi server: 10.3.15-MariaDB
-- Versi PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pengadilanagama`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_laporan`
--

CREATE TABLE `tb_laporan` (
  `id_laporan` int(11) NOT NULL,
  `judul_laporan` varchar(100) NOT NULL,
  `bulan_tahun_laporan` varchar(100) NOT NULL,
  `tanggal_pengajuan_laporan` varchar(100) DEFAULT NULL,
  `tanggal_konfirmasi_valid_laporan` varchar(100) DEFAULT NULL,
  `status_laporan` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL,
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_laporan`
--

INSERT INTO `tb_laporan` (`id_laporan`, `judul_laporan`, `bulan_tahun_laporan`, `tanggal_pengajuan_laporan`, `tanggal_konfirmasi_valid_laporan`, `status_laporan`, `updated_at`, `created_at`) VALUES
(6, 'berkas bulan september 2020', '09-2021', '2020-09-15 06:42:11', '2020-09-15 06:42:20', 'valid', '2020-09-15 06:42:11', '2020-09-13 11:40:23'),
(7, 'berkas bulan november 2020', '02-2021', '2020-09-14 09:10:13', '2020-09-14 09:26:13', 'valid', '2020-09-14 13:42:40', '2020-09-14 09:09:17'),
(8, 'berkas bulan januari 2021', '01-2021', '2020-09-15 07:58:12', '2020-09-15 07:58:30', 'valid', '2020-09-15 07:58:12', '2020-09-14 11:56:51'),
(21, 'berkas bulan februari 2020', '02-2020', '2020-09-14 14:04:34', '2020-09-14 14:04:49', 'valid', '2020-09-14 14:04:34', '2020-09-14 14:02:36'),
(23, 'berkas 1', '04-2021', '2020-09-14 16:32:59', '2020-09-14 16:33:13', 'valid', '2020-09-14 16:32:59', '2020-09-14 16:23:19'),
(24, 'berkas 2', '08-2020', '2020-09-15 06:02:56', '2020-09-15 06:04:38', 'valid', '2020-09-15 06:02:56', '2020-09-14 18:47:39'),
(25, 'berkas 3', '10-2025', '2020-09-15 08:34:01', '2020-09-15 08:34:12', 'valid', '2020-09-15 08:34:01', '2020-09-14 18:49:42'),
(26, 'berkas 25', '08-2025', '2020-09-15 10:23:35', '2020-09-15 10:33:52', 'valid', '2020-09-15 10:23:35', '2020-09-15 09:58:37'),
(27, 'berkas 26', '10-2027', NULL, NULL, 'draft', '2020-09-15 11:43:43', '2020-09-15 11:43:43'),
(28, 'berkas bulan desember 2025', '04-2025', '2020-09-15 13:12:21', '2020-09-15 13:12:43', 'valid', '2020-09-15 13:12:21', '2020-09-15 13:06:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_laporan_detail`
--

CREATE TABLE `tb_laporan_detail` (
  `id_laporan_detail` int(11) NOT NULL,
  `id_laporan` int(100) NOT NULL,
  `id_nama_laporan` int(100) NOT NULL,
  `file_laporan` varchar(100) NOT NULL,
  `ekstensi_laporan` varchar(100) NOT NULL,
  `status_laporan_detail` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL,
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_laporan_detail`
--

INSERT INTO `tb_laporan_detail` (`id_laporan_detail`, `id_laporan`, `id_nama_laporan`, `file_laporan`, `ekstensi_laporan`, `status_laporan_detail`, `updated_at`, `created_at`) VALUES
(18, 6, 1, '16000649245f5f0d9c18e90.pdf', 'pdf', 'valid', '2020-09-14 08:42:52', '2020-09-14 06:28:44'),
(19, 6, 4, '16000714175f5f26f956c5d.pdf', 'pdf', 'valid', '2020-09-14 09:01:45', '2020-09-14 08:16:57'),
(20, 7, 1, '16000745915f5f335f4d350.pdf', 'pdf', 'valid', '2020-09-14 09:10:36', '2020-09-14 09:09:51'),
(21, 7, 2, '16000746005f5f336849a11.pdf', 'pdf', 'valid', '2020-09-14 09:10:37', '2020-09-14 09:10:00'),
(22, 7, 3, '16000746055f5f336db3618.pdf', 'pdf', 'valid', '2020-09-14 09:10:38', '2020-09-14 09:10:05'),
(23, 7, 4, '16000746115f5f3373834fb.pdf', 'pdf', 'valid', '2020-09-14 09:14:34', '2020-09-14 09:10:11'),
(24, 8, 1, '16001002565f5f97a0d1f92.pdf', 'pdf', 'valid', '2020-09-14 16:17:57', '2020-09-14 11:57:12'),
(25, 8, 3, '16000850705f5f5c4eca4e0.pdf', 'pdf', 'valid', '2020-09-14 16:17:03', '2020-09-14 12:04:30'),
(26, 21, 1, '16000921725f5f780c59b2a.pdf', 'pdf', 'valid', '2020-09-14 14:03:09', '2020-09-14 14:02:52'),
(27, 21, 2, '16000922055f5f782d04752.pdf', 'pdf', 'valid', '2020-09-14 14:03:35', '2020-09-14 14:03:25'),
(28, 21, 3, '16000922655f5f786931bad.pdf', 'pdf', 'valid', '2020-09-14 14:04:45', '2020-09-14 14:04:25'),
(29, 21, 4, '16000922705f5f786e7e386.pdf', 'pdf', 'valid', '2020-09-14 14:04:49', '2020-09-14 14:04:30'),
(30, 8, 2, '16001001755f5f974f53029.pdf', 'pdf', 'valid', '2020-09-14 16:17:01', '2020-09-14 14:15:25'),
(31, 23, 1, '16001007185f5f996e670fa.pdf', 'pdf', 'valid', '2020-09-14 16:25:37', '2020-09-14 16:23:38'),
(32, 23, 3, '16001006325f5f991879683.pdf', 'pdf', 'valid', '2020-09-14 16:24:23', '2020-09-14 16:23:52'),
(33, 23, 2, '16001006395f5f991fb1e53.pdf', 'pdf', 'valid', '2020-09-14 16:24:21', '2020-09-14 16:23:59'),
(34, 23, 4, '16001007645f5f999c0c80f.pdf', 'pdf', 'valid', '2020-09-14 16:33:13', '2020-09-14 16:26:04'),
(35, 6, 2, '16001521265f60623ed15ce.pdf', 'pdf', 'valid', '2020-09-15 06:42:20', '2020-09-14 17:20:20'),
(36, 6, 3, '16001053915f5fabaf028fc.pdf', 'pdf', 'valid', '2020-09-14 18:44:32', '2020-09-14 17:43:11'),
(37, 24, 1, '16001497735f60590d506bf.pdf', 'pdf', 'valid', '2020-09-15 06:04:38', '2020-09-14 18:47:55'),
(38, 24, 2, '16001092815f5fbae1b66f9.pdf', 'pdf', 'valid', '2020-09-15 06:04:35', '2020-09-14 18:48:01'),
(39, 24, 4, '16001092925f5fbaec4af4d.pdf', 'pdf', 'valid', '2020-09-14 18:48:59', '2020-09-14 18:48:12'),
(40, 24, 3, '16001093025f5fbaf6d30f8.pdf', 'pdf', 'valid', '2020-09-14 18:48:57', '2020-09-14 18:48:22'),
(41, 25, 1, '16001100115f5fbdbbd43c3.pdf', 'pdf', 'valid', '2020-09-14 19:00:31', '2020-09-14 18:49:52'),
(42, 25, 2, '16001095815f5fbc0d4c4ee.pdf', 'pdf', 'valid', '2020-09-14 18:59:48', '2020-09-14 18:53:01'),
(45, 8, 4, '16001566885f6074105118a.pdf', 'pdf', 'valid', '2020-09-15 07:58:30', '2020-09-15 07:47:19'),
(46, 25, 3, '16001571355f6075cf8afa5.pdf', 'pdf', 'valid', '2020-09-15 08:05:46', '2020-09-15 08:04:43'),
(47, 25, 4, '16001588395f607c779412d.pdf', 'pdf', 'valid', '2020-09-15 08:34:12', '2020-09-15 08:31:18'),
(48, 26, 3, '16001640315f6090bf0aab2.pdf', 'pdf', 'valid', '2020-09-15 10:33:52', '2020-09-15 10:00:31'),
(49, 26, 1, '16001642555f60919fc03db.pdf', 'pdf', 'valid', '2020-09-15 10:33:50', '2020-09-15 10:00:39'),
(50, 26, 2, '16001654095f609621c07ce.pdf', 'pdf', 'valid', '2020-09-15 10:33:45', '2020-09-15 10:23:29'),
(52, 28, 1, '16001754205f60bd3c777a4.pdf', 'pdf', 'valid', '2020-09-15 13:11:23', '2020-09-15 13:08:09'),
(53, 28, 3, '16001753025f60bcc6e2853.pdf', 'pdf', 'valid', '2020-09-15 13:09:36', '2020-09-15 13:08:22'),
(54, 28, 2, '16001755155f60bd9b9d86a.pdf', 'pdf', 'valid', '2020-09-15 13:12:41', '2020-09-15 13:11:55'),
(55, 28, 4, '16001755225f60bda2a00dc.pdf', 'pdf', 'valid', '2020-09-15 13:12:43', '2020-09-15 13:12:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_laporan_detail_revisi`
--

CREATE TABLE `tb_laporan_detail_revisi` (
  `id_laporan_detail_revisi` int(11) NOT NULL,
  `id_laporan_detail` int(100) NOT NULL,
  `catatan_revisi` longtext DEFAULT NULL,
  `updated_at` varchar(100) NOT NULL,
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_laporan_detail_revisi`
--

INSERT INTO `tb_laporan_detail_revisi` (`id_laporan_detail_revisi`, `id_laporan_detail`, `catatan_revisi`, `updated_at`, `created_at`) VALUES
(1, 30, 'coba255', '2020-09-14 16:03:40', '2020-09-14 16:03:40'),
(2, 25, 'coba', '2020-09-14 16:09:06', '2020-09-14 16:09:06'),
(3, 24, 'revisi 1', '2020-09-14 16:16:34', '2020-09-14 16:16:34'),
(4, 31, 'ini revisi', '2020-09-14 16:24:19', '2020-09-14 16:24:19'),
(5, 34, 'coba revisi lpj04', '2020-09-14 16:32:49', '2020-09-14 16:32:49'),
(6, 35, 'ini revisi perkara', '2020-09-14 17:21:07', '2020-09-14 17:21:07'),
(7, 38, 'ini revisi', '2020-09-14 18:48:54', '2020-09-14 18:48:54'),
(8, 41, 'ini revisi laporan pp39', '2020-09-14 18:59:44', '2020-09-14 18:59:44'),
(9, 37, 'revisi 6', '2020-09-15 06:01:48', '2020-09-15 06:01:48'),
(10, 45, 'revisi 1', '2020-09-15 07:47:43', '2020-09-15 07:47:43'),
(11, 46, 'ini revisi', '2020-09-15 08:05:09', '2020-09-15 08:05:09'),
(12, 47, 'ini revisnya', '2020-09-15 08:33:39', '2020-09-15 08:33:39'),
(13, 49, 'revisi 5', '2020-09-15 10:01:02', '2020-09-15 10:01:02'),
(14, 48, 'revisi 6', '2020-09-15 10:01:09', '2020-09-15 10:01:09'),
(15, 52, 'revisi pp39 versi1', '2020-09-15 13:09:05', '2020-09-15 13:09:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_nama_laporan`
--

CREATE TABLE `tb_nama_laporan` (
  `id_nama_laporan` int(11) NOT NULL,
  `nama_laporan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_nama_laporan`
--

INSERT INTO `tb_nama_laporan` (`id_nama_laporan`, `nama_laporan`) VALUES
(1, 'pp39'),
(2, 'perkara'),
(3, 'lpj01'),
(4, 'lpj04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_perencanaan_anggaran`
--

CREATE TABLE `tb_perencanaan_anggaran` (
  `id_perencanaan_anggaran` int(11) NOT NULL,
  `nilai_perencanaan_anggaran` varchar(100) NOT NULL,
  `tanggal_perencanaan_anggaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_realisasi_anggaran`
--

CREATE TABLE `tb_realisasi_anggaran` (
  `id_realisasi_anggaran` int(11) NOT NULL,
  `nilai_realisasi_anggaran` varchar(100) NOT NULL,
  `tanggal_realisasi_anggaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_saldo`
--

CREATE TABLE `tb_saldo` (
  `id_saldo` int(11) NOT NULL,
  `nominal` int(11) DEFAULT NULL,
  `tergunakan` int(11) DEFAULT NULL,
  `tanggal` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_saldo`
--

INSERT INTO `tb_saldo` (`id_saldo`, `nominal`, `tergunakan`, `tanggal`) VALUES
(2, 1000000, 0, '2020-09-13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `level`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$YMaLuWc0P3Ajfn3DSJEcr.ODrMyPSfbmJV7CaBum6NwMi46uZs9xW', NULL, 'admin', '2020-09-08 22:19:03', '2020-09-08 22:19:03'),
(2, 'pimpinan', 'pimpinan@gmail.com', NULL, '$2y$10$YMaLuWc0P3Ajfn3DSJEcr.ODrMyPSfbmJV7CaBum6NwMi46uZs9xW', NULL, 'pimpinan', '2020-09-08 22:19:03', '2020-09-08 22:19:03'),
(3, 'operator', 'operator@gmail.com', NULL, '$2y$10$YMaLuWc0P3Ajfn3DSJEcr.ODrMyPSfbmJV7CaBum6NwMi46uZs9xW', NULL, 'operator', '2020-09-08 22:19:03', '2020-09-08 22:19:03');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `tb_laporan`
--
ALTER TABLE `tb_laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indeks untuk tabel `tb_laporan_detail`
--
ALTER TABLE `tb_laporan_detail`
  ADD PRIMARY KEY (`id_laporan_detail`);

--
-- Indeks untuk tabel `tb_laporan_detail_revisi`
--
ALTER TABLE `tb_laporan_detail_revisi`
  ADD PRIMARY KEY (`id_laporan_detail_revisi`);

--
-- Indeks untuk tabel `tb_nama_laporan`
--
ALTER TABLE `tb_nama_laporan`
  ADD PRIMARY KEY (`id_nama_laporan`);

--
-- Indeks untuk tabel `tb_perencanaan_anggaran`
--
ALTER TABLE `tb_perencanaan_anggaran`
  ADD PRIMARY KEY (`id_perencanaan_anggaran`);

--
-- Indeks untuk tabel `tb_realisasi_anggaran`
--
ALTER TABLE `tb_realisasi_anggaran`
  ADD PRIMARY KEY (`id_realisasi_anggaran`);

--
-- Indeks untuk tabel `tb_saldo`
--
ALTER TABLE `tb_saldo`
  ADD PRIMARY KEY (`id_saldo`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_laporan`
--
ALTER TABLE `tb_laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `tb_laporan_detail`
--
ALTER TABLE `tb_laporan_detail`
  MODIFY `id_laporan_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT untuk tabel `tb_laporan_detail_revisi`
--
ALTER TABLE `tb_laporan_detail_revisi`
  MODIFY `id_laporan_detail_revisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_nama_laporan`
--
ALTER TABLE `tb_nama_laporan`
  MODIFY `id_nama_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_perencanaan_anggaran`
--
ALTER TABLE `tb_perencanaan_anggaran`
  MODIFY `id_perencanaan_anggaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_realisasi_anggaran`
--
ALTER TABLE `tb_realisasi_anggaran`
  MODIFY `id_realisasi_anggaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_saldo`
--
ALTER TABLE `tb_saldo`
  MODIFY `id_saldo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
