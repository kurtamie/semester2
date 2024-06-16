-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 11 Jul 2023 pada 02.05
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asli`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `letters`
--

CREATE TABLE `letters` (
  `id_surat_izin` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `nim` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_dosen_wali` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas_perkuliahan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_dan_nomor_telepon_orang_tua_wali` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_mulai_izin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_perizinan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_akhir_izin` date NOT NULL,
  `status` enum('PROSES','SELESAI','TOLAK') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PROSES',
  `foto1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `letters`
--

INSERT INTO `letters` (`id_surat_izin`, `id_user`, `nim`, `nama`, `nama_dosen_wali`, `kelas_perkuliahan`, `nama_dan_nomor_telepon_orang_tua_wali`, `tanggal_mulai_izin`, `jenis_perizinan`, `tanggal_akhir_izin`, `status`, `foto1`, `foto2`, `foto3`, `created_at`, `updated_at`) VALUES
(1, 2, '4342201033', 'Suep', 'Pak Ahmadi', 'Reguler Malam', '09090990', '2023-07-11', 'Lembur Kerja', '2023-07-11', 'SELESAI', 'hcLEUqbbdkZBIBJjkxh99XAYa44GrrNm42UyOO9b.png', 'WmM0ZQ75eNyjlJLfSzE79u3Iel8waAplyd9duT9l.png', '4XOM5lOsJqA7cIs6Nd3pFjjYRCab2kkUZXpdQhUI.jpg', '2023-07-10 18:13:44', '2023-07-10 18:41:59'),
(2, 2, '4342201033', 'Suep', 'Pak Supardianto', 'Reguler Malam', '09090990', '2023-07-11', 'Bekerja Shift', '2023-07-11', 'PROSES', 'POPjoNl4mu8F7cZCsojwQ4mHgUh4mElGYNQMqb90.png', 'BsdK7BuUg5kFwX4FiwshThMxwDYWulJFrsdIsEPg.png', 'sEIS58ZjOC1YL6iGleLNBNyS9BjHvO43wGpUqbcz.png', '2023-07-10 18:37:09', '2023-07-10 18:37:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_surveys`
--

CREATE TABLE `surat_surveys` (
  `id_surat_survey` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `nim` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_tujuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_instansi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keperluan_mahasiswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tugas_yang_dikerjakan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pdf_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('PROSES','TERIMA','TOLAK') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PROSES',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `surat_surveys`
--

INSERT INTO `surat_surveys` (`id_surat_survey`, `id_user`, `nim`, `nama`, `alamat_tujuan`, `alamat_instansi`, `keperluan_mahasiswa`, `tugas_yang_dikerjakan`, `pdf_file`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '4342201033', 'Suep', 'asd', 'asd', 'Membuat Tugas Akhir', 'Tugas akhir', '1.pdf', 'TERIMA', '2023-07-10 18:38:46', '2023-07-10 18:42:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('admin','mahasiswa') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'mahasiswa',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama`, `nim`, `nik`, `email`, `username`, `email_verified_at`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '', '12345', 'admin@gmail.com', 'admin', NULL, '$2y$10$uEz5DLZSr6MzntCO3zilb.AKiZ16OmL3W35H7/fcHmUFL2ecBFMDC', 'admin', NULL, '2023-07-10 17:45:06', '2023-07-10 17:45:06'),
(2, 'Suep', '4342201033', '', 'mahasiswa@gmail.com', 'mahasiswa', NULL, '$2y$10$01NITnIOmboTvNQ.nzmh/uk804rYtBfP1rBVHbvouYLDtkoWiwAxy', 'mahasiswa', NULL, '2023-07-10 17:45:06', '2023-07-10 17:45:06'),
(7, 'Jamaludin', '4342201010', NULL, '123@gmail.com', 'abc', NULL, '$2y$10$gFF7FvrKho8tAk/JoGr3he7oujl/cfDSp1gBuV.BB7eO.kYbc4BhC', 'mahasiswa', NULL, '2023-07-10 18:03:39', '2023-07-10 18:03:39'),
(8, 'Kamaluddin', '4342201009', NULL, 'noris123@gmail.com', '001', NULL, '$2y$10$0cgIVCb/3/sxkbcvMSWR6OBkpRpkeoh7sHt5HjB1FzUfwU5nanh5C', 'mahasiswa', NULL, '2023-07-10 18:06:43', '2023-07-10 18:06:43'),
(9, 'Ravi Syael', '4342201044', NULL, 'takanjuti@gmail.com', '123', NULL, '$2y$10$RkX9f3puRAOl6Zr6mmTyIeYrh23occk8PcL2WWZ9S9mgj79v4e7u.', 'mahasiswa', NULL, '2023-07-10 18:08:23', '2023-07-10 18:08:23');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `letters`
--
ALTER TABLE `letters`
  ADD PRIMARY KEY (`id_surat_izin`),
  ADD KEY `letters_id_user_foreign` (`id_user`);

--
-- Indeks untuk tabel `surat_surveys`
--
ALTER TABLE `surat_surveys`
  ADD PRIMARY KEY (`id_surat_survey`),
  ADD KEY `surat_surveys_id_user_foreign` (`id_user`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `letters`
--
ALTER TABLE `letters`
  MODIFY `id_surat_izin` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `surat_surveys`
--
ALTER TABLE `surat_surveys`
  MODIFY `id_surat_survey` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `letters`
--
ALTER TABLE `letters`
  ADD CONSTRAINT `letters_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `surat_surveys`
--
ALTER TABLE `surat_surveys`
  ADD CONSTRAINT `surat_surveys_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
