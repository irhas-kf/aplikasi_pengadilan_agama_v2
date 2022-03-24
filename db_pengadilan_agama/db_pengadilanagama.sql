-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Des 2020 pada 23.22
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.1

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

--
-- Dumping data untuk tabel `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('irhas.cepunk@gmail.com', '$2y$10$a/oOTCvENJd7V4GFwG46v.kh8hHfGDXTbensYdjmBcJNh4EK/03pi', '2020-11-26 19:00:30');

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
  `nilai_perencanaan_anggaran` int(11) NOT NULL,
  `tanggal_perencanaan_anggaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_perencanaan_anggaran`
--

INSERT INTO `tb_perencanaan_anggaran` (`id_perencanaan_anggaran`, `nilai_perencanaan_anggaran`, `tanggal_perencanaan_anggaran`) VALUES
(39, 1000000, '2020-01-01'),
(40, 15000000, '2020-02-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_perencanaan_anggaran_mari`
--

CREATE TABLE `tb_perencanaan_anggaran_mari` (
  `id_perencanaan_anggaran` int(11) NOT NULL,
  `nilai_perencanaan_anggaran` bigint(100) NOT NULL,
  `tanggal_perencanaan_anggaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_perencanaan_anggaran_mari`
--

INSERT INTO `tb_perencanaan_anggaran_mari` (`id_perencanaan_anggaran`, `nilai_perencanaan_anggaran`, `tanggal_perencanaan_anggaran`) VALUES
(53, 1000000000, '2020-01-01'),
(54, 9000000000, '2020-02-01');

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
-- Struktur dari tabel `tb_realisasi_anggaran_mari`
--

CREATE TABLE `tb_realisasi_anggaran_mari` (
  `id_realisasi_anggaran` int(11) NOT NULL,
  `nilai_realisasi_anggaran` bigint(100) NOT NULL,
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
  `sisa` int(11) DEFAULT NULL,
  `tanggal` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_saldo`
--

INSERT INTO `tb_saldo` (`id_saldo`, `nominal`, `tergunakan`, `sisa`, `tanggal`) VALUES
(21, 900000000, 0, 900000000, '2020-01-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_saldo_mari`
--

CREATE TABLE `tb_saldo_mari` (
  `id_saldo` int(11) NOT NULL,
  `nominal` bigint(100) DEFAULT NULL,
  `tergunakan` bigint(100) DEFAULT NULL,
  `sisa` bigint(100) DEFAULT NULL,
  `tanggal` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_saldo_mari`
--

INSERT INTO `tb_saldo_mari` (`id_saldo`, `nominal`, `tergunakan`, `sisa`, `tanggal`) VALUES
(23, 130000000000, 10000000000, 120000000000, '2020-01-01');

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
  `photo_profile` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `level`, `photo_profile`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '2020-11-26 17:00:00', '$2y$10$FtgNOApD1oX4N/HU/4BYCugWaQrEZ0Abrz4r5iMZPCGbfOA2jYYg2', 'izwB2tQswTDOfogVICtQyDTG7C9GwWyZrGjOoJ2XUcJZF5wZPxB34eVKE28M', 'admin', '16089698565fe6ee8028f14.JPG', '2020-09-08 22:19:03', '2020-09-08 22:19:03'),
(2, 'pimpinan', 'pimpinan@gmail.com', NULL, '$2y$10$YMaLuWc0P3Ajfn3DSJEcr.ODrMyPSfbmJV7CaBum6NwMi46uZs9xW', NULL, 'pimpinan', '16089697145fe6edf2a999a.jpg', '2020-09-08 22:19:03', '2020-09-08 22:19:03'),
(3, 'operator', 'operator@gmail.com', NULL, '$2y$10$YMaLuWc0P3Ajfn3DSJEcr.ODrMyPSfbmJV7CaBum6NwMi46uZs9xW', 'QLMx4XNYZfhKl2baNAP1l7b670U1Im1S073HhRfWhQVYYOWM5GIy9BtpcJfJ', 'operator', '16089702615fe6f0159e4f5.jpg', '2020-09-08 22:19:03', '2020-09-08 22:19:03');

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
-- Indeks untuk tabel `tb_perencanaan_anggaran_mari`
--
ALTER TABLE `tb_perencanaan_anggaran_mari`
  ADD PRIMARY KEY (`id_perencanaan_anggaran`);

--
-- Indeks untuk tabel `tb_realisasi_anggaran`
--
ALTER TABLE `tb_realisasi_anggaran`
  ADD PRIMARY KEY (`id_realisasi_anggaran`);

--
-- Indeks untuk tabel `tb_realisasi_anggaran_mari`
--
ALTER TABLE `tb_realisasi_anggaran_mari`
  ADD PRIMARY KEY (`id_realisasi_anggaran`);

--
-- Indeks untuk tabel `tb_saldo`
--
ALTER TABLE `tb_saldo`
  ADD PRIMARY KEY (`id_saldo`);

--
-- Indeks untuk tabel `tb_saldo_mari`
--
ALTER TABLE `tb_saldo_mari`
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
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `tb_laporan_detail`
--
ALTER TABLE `tb_laporan_detail`
  MODIFY `id_laporan_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT untuk tabel `tb_laporan_detail_revisi`
--
ALTER TABLE `tb_laporan_detail_revisi`
  MODIFY `id_laporan_detail_revisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_nama_laporan`
--
ALTER TABLE `tb_nama_laporan`
  MODIFY `id_nama_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_perencanaan_anggaran`
--
ALTER TABLE `tb_perencanaan_anggaran`
  MODIFY `id_perencanaan_anggaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `tb_perencanaan_anggaran_mari`
--
ALTER TABLE `tb_perencanaan_anggaran_mari`
  MODIFY `id_perencanaan_anggaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `tb_realisasi_anggaran`
--
ALTER TABLE `tb_realisasi_anggaran`
  MODIFY `id_realisasi_anggaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `tb_realisasi_anggaran_mari`
--
ALTER TABLE `tb_realisasi_anggaran_mari`
  MODIFY `id_realisasi_anggaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `tb_saldo`
--
ALTER TABLE `tb_saldo`
  MODIFY `id_saldo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tb_saldo_mari`
--
ALTER TABLE `tb_saldo_mari`
  MODIFY `id_saldo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
