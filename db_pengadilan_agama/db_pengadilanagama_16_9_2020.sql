-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Sep 2020 pada 10.14
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
(29, 'berkas bulan januari 2020', '01-2020', '2020-09-16 05:52:54', '2020-09-16 06:00:23', 'valid', '2020-09-16 05:52:54', '2020-09-16 05:49:34'),
(30, 'berkas bulan februari 2020', '02-2020', '2020-09-16 05:53:36', '2020-09-16 06:00:56', 'valid', '2020-09-16 05:53:36', '2020-09-16 05:49:49'),
(31, 'berkas bulan maret 2020', '03-2020', '2020-09-16 05:55:44', '2020-09-16 06:01:10', 'valid', '2020-09-16 05:55:44', '2020-09-16 05:50:12'),
(32, 'berkas bulan april 2020', '04-2020', '2020-09-16 05:56:43', '2020-09-16 06:01:35', 'valid', '2020-09-16 05:56:43', '2020-09-16 05:50:27'),
(33, 'berkas bulan mei 2020', '05-2020', '2020-09-16 05:57:33', '2020-09-16 06:01:56', 'valid', '2020-09-16 05:57:33', '2020-09-16 05:50:39'),
(34, 'berkas bulan juni 2020', '06-2020', '2020-09-16 05:58:44', '2020-09-16 06:02:16', 'valid', '2020-09-16 05:58:44', '2020-09-16 05:50:53'),
(35, 'berkas bulan juli 2020', '07-2020', '2020-09-16 05:59:15', '2020-09-16 06:02:42', 'valid', '2020-09-16 05:59:15', '2020-09-16 05:51:07'),
(36, 'berkas bulan agustus 2020', '08-2020', '2020-09-16 05:59:53', '2020-09-16 06:03:06', 'valid', '2020-09-16 05:59:53', '2020-09-16 05:51:24');

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
(56, 29, 1, '16002355175f61a7fd2bfb9.pdf', 'pdf', 'valid', '2020-09-16 06:00:18', '2020-09-16 05:51:57'),
(57, 29, 2, '16002355245f61a804654d7.pdf', 'pdf', 'valid', '2020-09-16 06:00:20', '2020-09-16 05:52:04'),
(58, 29, 3, '16002355365f61a8102df9e.pdf', 'pdf', 'valid', '2020-09-16 06:00:21', '2020-09-16 05:52:16'),
(59, 29, 4, '16002355435f61a817a2da2.pdf', 'pdf', 'valid', '2020-09-16 06:00:23', '2020-09-16 05:52:23'),
(60, 30, 1, '16002355935f61a8496a299.pdf', 'pdf', 'valid', '2020-09-16 06:00:42', '2020-09-16 05:53:13'),
(61, 30, 2, '16002355985f61a84e9fc13.pdf', 'pdf', 'valid', '2020-09-16 06:00:46', '2020-09-16 05:53:18'),
(62, 30, 3, '16002356075f61a8572236e.pdf', 'pdf', 'valid', '2020-09-16 06:00:51', '2020-09-16 05:53:27'),
(63, 30, 4, '16002356135f61a85dba8bb.pdf', 'pdf', 'valid', '2020-09-16 06:00:56', '2020-09-16 05:53:33'),
(64, 31, 3, '16002356325f61a870a6d66.pdf', 'pdf', 'valid', '2020-09-16 06:01:10', '2020-09-16 05:53:52'),
(66, 31, 4, '16002357365f61a8d84e829.pdf', 'pdf', 'valid', '2020-09-16 06:01:06', '2020-09-16 05:55:36'),
(67, 32, 1, '16002357775f61a901d2de3.pdf', 'pdf', 'valid', '2020-09-16 06:01:21', '2020-09-16 05:56:17'),
(68, 32, 2, '16002357885f61a90c47dac.pdf', 'pdf', 'valid', '2020-09-16 06:01:26', '2020-09-16 05:56:28'),
(69, 32, 3, '16002357955f61a91373c11.pdf', 'pdf', 'valid', '2020-09-16 06:01:30', '2020-09-16 05:56:35'),
(70, 32, 4, '16002358005f61a918ad87e.pdf', 'pdf', 'valid', '2020-09-16 06:01:35', '2020-09-16 05:56:40'),
(71, 33, 1, '16002358275f61a9332664b.pdf', 'pdf', 'valid', '2020-09-16 06:01:46', '2020-09-16 05:57:07'),
(72, 33, 3, '16002358415f61a94140c9a.pdf', 'pdf', 'valid', '2020-09-16 06:01:51', '2020-09-16 05:57:21'),
(73, 33, 4, '16002358525f61a94c28c24.pdf', 'pdf', 'valid', '2020-09-16 06:01:56', '2020-09-16 05:57:32'),
(74, 34, 2, '16002358875f61a96fb1c07.pdf', 'pdf', 'valid', '2020-09-16 06:02:07', '2020-09-16 05:58:07'),
(75, 34, 3, '16002359075f61a9832016d.pdf', 'pdf', 'valid', '2020-09-16 06:02:11', '2020-09-16 05:58:27'),
(76, 34, 4, '16002359225f61a9920686a.pdf', 'pdf', 'valid', '2020-09-16 06:02:16', '2020-09-16 05:58:42'),
(77, 35, 1, '16002359355f61a99ff2b33.pdf', 'pdf', 'valid', '2020-09-16 06:02:27', '2020-09-16 05:58:55'),
(78, 35, 2, '16002359425f61a9a6ebeee.pdf', 'pdf', 'valid', '2020-09-16 06:02:31', '2020-09-16 05:59:02'),
(79, 35, 3, '16002359485f61a9aca9777.pdf', 'pdf', 'valid', '2020-09-16 06:02:37', '2020-09-16 05:59:08'),
(80, 35, 4, '16002359545f61a9b21e6f4.pdf', 'pdf', 'valid', '2020-09-16 06:02:42', '2020-09-16 05:59:14'),
(81, 36, 2, '16002359735f61a9c58bfa2.pdf', 'pdf', 'valid', '2020-09-16 06:02:55', '2020-09-16 05:59:33'),
(82, 36, 3, '16002359825f61a9cec3e1a.pdf', 'pdf', 'valid', '2020-09-16 06:03:00', '2020-09-16 05:59:42'),
(83, 36, 4, '16002359905f61a9d6b959b.pdf', 'pdf', 'valid', '2020-09-16 06:03:06', '2020-09-16 05:59:50');

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

--
-- Dumping data untuk tabel `tb_perencanaan_anggaran`
--

INSERT INTO `tb_perencanaan_anggaran` (`id_perencanaan_anggaran`, `nilai_perencanaan_anggaran`, `tanggal_perencanaan_anggaran`) VALUES
(1, '3', '2020-05-15'),
(2, '5', '2020-08-15'),
(3, '8', '2020-09-15');

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
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `tb_laporan_detail`
--
ALTER TABLE `tb_laporan_detail`
  MODIFY `id_laporan_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

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
  MODIFY `id_perencanaan_anggaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
