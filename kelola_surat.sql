-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jun 2022 pada 12.05
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kelola_surat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `attachment_letters`
--

CREATE TABLE `attachment_letters` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `incoming_letters_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `attachment_letters`
--

INSERT INTO `attachment_letters` (`id`, `file_name`, `incoming_letters_id`) VALUES
(17, 'f_l4gmxb090-Contohpdfsurat.pdf', 19),
(27, '3D2N-Favourite-Komodo-Trails-1-Night-on-Board-and-1-Night-in-Hotel-480x320.jpg', 22);

-- --------------------------------------------------------

--
-- Struktur dari tabel `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `disposisi`
--

CREATE TABLE `disposisi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tujuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sifat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perintah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `incoming_letters_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `disposisi`
--

INSERT INTO `disposisi` (`id`, `tujuan`, `sifat`, `perintah`, `isi`, `incoming_letters_id`, `created_at`, `updated_at`) VALUES
(1, 'Ngetiau', 'Rahasia', 'Wakwakw', 'LOL', 19, NULL, NULL),
(2, 'adad', 'sadasd', 'sadas', 'asdasd', 20, NULL, NULL),
(4, 'asdasd', 'asdasd', 'asdasd', 'asdasdasdasd', 19, '2022-06-19 11:42:50', '2022-06-19 11:42:50'),
(5, 'asdasd', 'sadsad', 'asdasd', 'asdasd', 19, '2022-06-20 01:45:45', '2022-06-20 01:45:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `disposisi_user`
--

CREATE TABLE `disposisi_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `disposisi_id` int(10) UNSIGNED NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `disposisi_user`
--

INSERT INTO `disposisi_user` (`id`, `disposisi_id`, `users_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'Diterima', NULL, '2022-06-20 01:42:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `incoming_letters`
--

CREATE TABLE `incoming_letters` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `letter_subject` varchar(255) NOT NULL,
  `letter_content` varchar(2555) NOT NULL,
  `letter_no` varchar(255) NOT NULL,
  `letter_date` date NOT NULL,
  `date_received` date NOT NULL,
  `sender` varchar(255) NOT NULL,
  `regarding` varchar(255) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `incoming_letters`
--

INSERT INTO `incoming_letters` (`id`, `email`, `letter_subject`, `letter_content`, `letter_no`, `letter_date`, `date_received`, `sender`, `regarding`, `users_id`) VALUES
(19, 'diohilmi98@gmail.com', 'ini subject buat lamar kerja', 'assasas sasa sasa sasas', '1111111111', '2022-06-16', '2022-06-21', 'asdasd', 'asdsad', 1),
(20, 'yosydz@gmail.com', 'Lorem ipsum dolor sir amet', 'Lorem ipsum dolor sir ametLorem ipsum dolor sir ametLorem ipsum dolor sir\r\nametLorem ipsum dolor sir ametLorem ipsum dolor sir ametLorem ipsum dolor\r\nsir ametLorem ipsum dolor sir ametLorem ipsum dolor sir ametLorem ipsum\r\ndolor sir ametLorem ipsum dolor sir ametLorem ipsum dolor sir ametLorem\r\nipsum dolor sir ametLorem ipsum dolor sir ametLorem ipsum dolor sir\r\nametLorem ipsum dolor sir ametLorem ipsum dolor sir ametLorem ipsum dolor\r\nsir ametLorem ipsum dolor sir ametLorem ipsum dolor sir ametLorem ipsum\r\ndolor sir ametLorem ipsum dolor sir ametLorem ipsum dolor sir amet', '123123adas12312', '2022-06-16', '2022-06-18', 'asdasd', 'sdaasdasd', 1),
(22, 'asdasd', 'sadasd', 'asdasd', '12312', '2022-07-01', '2022-06-30', 'asdasd', 'asdasd', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `letters`
--

CREATE TABLE `letters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `letter_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `letter_date` date NOT NULL,
  `date_received` date NOT NULL,
  `regarding` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `letter_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `letter_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `letters_code`
--

CREATE TABLE `letters_code` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `letters_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `letters_code`
--

INSERT INTO `letters_code` (`id`, `created_at`, `updated_at`, `letters_code`, `name`) VALUES
(1, '2022-06-19 06:01:42', '2022-06-19 06:01:55', 'asdasd', '1231231');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_12_29_043513_create_departments_table', 1),
(6, '2021_12_29_065240_create_senders_table', 1),
(7, '2021_12_30_055748_create_letters_table', 1),
(8, '2022_06_05_102054_create_letters_code_table', 1),
(9, '2022_06_06_053432_delete_column_letter_no_in_letter', 1),
(10, '2022_06_06_062309_create_disposisi_table', 1),
(11, '2022_06_06_064049_add_latter_code_to_letter_table', 1),
(12, '2022_06_06_064927_drop_letters_table', 1),
(13, '2022_06_06_065148_create_second_letters_table', 1),
(14, '2022_06_07_135548_add_position_to_users', 1),
(15, '2022_06_09_125503_create_disposisi_user_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `out_letters`
--

CREATE TABLE `out_letters` (
  `id` int(11) NOT NULL,
  `letter_no` varchar(255) NOT NULL,
  `letter_date` date NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `regarding` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `status` enum('Request','Accept','Decline','') NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `out_letters`
--

INSERT INTO `out_letters` (`id`, `letter_no`, `letter_date`, `tujuan`, `regarding`, `file`, `status`, `keterangan`, `users_id`) VALUES
(1, '123123', '2022-06-11', 'qwewqe', 'qweqwe', '21_557_Dima.pdf', 'Request', 'qweqe', 1);

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
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `position` varchar(55) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `positions`
--

INSERT INTO `positions` (`id`, `position`, `create_at`, `update_at`) VALUES
(1, 'Administrator', '2022-06-20 07:15:04', '2022-06-20 07:15:04'),
(2, 'Pegawai Unit', '2022-06-20 07:15:04', '2022-06-20 07:15:04'),
(3, 'Direktur', '2022-06-20 07:15:11', '2022-06-20 07:15:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `senders`
--

CREATE TABLE `senders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `positions_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `profile`, `remember_token`, `created_at`, `updated_at`, `positions_id`) VALUES
(1, 'Aris Maulana', 'admin@gmail.com', NULL, '$2y$10$WdEdyl7ZqZkD1vYV6oLY7e7lqtXPQ3jzbfmM1IIwuxt8NHGsGZKgK', NULL, NULL, '2022-06-13 00:14:59', '2022-06-13 00:14:59', 1),
(3, 'Aris User', 'pegawai@gmail.com', NULL, '$2y$10$WdEdyl7ZqZkD1vYV6oLY7e7lqtXPQ3jzbfmM1IIwuxt8NHGsGZKgK', NULL, NULL, '2022-06-13 00:14:59', '2022-06-13 00:14:59', 2),
(4, 'DaniUser', 'pegawaidani@gmail.com', NULL, '$2y$10$WdEdyl7ZqZkD1vYV6oLY7e7lqtXPQ3jzbfmM1IIwuxt8NHGsGZKgK', NULL, NULL, '2022-06-13 00:14:59', '2022-06-13 00:14:59', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `attachment_letters`
--
ALTER TABLE `attachment_letters`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `disposisi`
--
ALTER TABLE `disposisi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `disposisi_user`
--
ALTER TABLE `disposisi_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disposisi_id` (`disposisi_id`,`users_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `incoming_letters`
--
ALTER TABLE `incoming_letters`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `letters`
--
ALTER TABLE `letters`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `letters_code`
--
ALTER TABLE `letters_code`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `out_letters`
--
ALTER TABLE `out_letters`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `senders`
--
ALTER TABLE `senders`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT untuk tabel `attachment_letters`
--
ALTER TABLE `attachment_letters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `disposisi`
--
ALTER TABLE `disposisi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `disposisi_user`
--
ALTER TABLE `disposisi_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `incoming_letters`
--
ALTER TABLE `incoming_letters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `letters`
--
ALTER TABLE `letters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `letters_code`
--
ALTER TABLE `letters_code`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `out_letters`
--
ALTER TABLE `out_letters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `senders`
--
ALTER TABLE `senders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
