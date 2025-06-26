-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 26, 2025 at 03:23 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kemenag_2025`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kecamatan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`id`, `nama_kecamatan`, `created_at`, `updated_at`) VALUES
(637202, 'Landasan Ulin', NULL, NULL),
(637203, 'Cempaka', NULL, NULL),
(637204, 'Banjarbaru Utara', NULL, NULL),
(637205, 'Banjarbaru Selatan', NULL, NULL),
(637206, 'Liang Anggang', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelurahan`
--

CREATE TABLE `kelurahan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kecamatan` bigint(20) UNSIGNED NOT NULL,
  `nama_kelurahan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelurahan`
--

INSERT INTO `kelurahan` (`id`, `id_kecamatan`, `nama_kelurahan`, `created_at`, `updated_at`) VALUES
(1, 637205, 'Guntung Paikat', NULL, NULL),
(2, 637205, 'Kemuning', NULL, NULL),
(3, 637205, 'Loktabat Selatan', NULL, NULL),
(4, 637205, 'Sungai Besar', NULL, NULL),
(5, 637204, 'Komet', NULL, NULL),
(6, 637204, 'Loktabat Utara', NULL, NULL),
(7, 637204, 'Mentaos', NULL, NULL),
(8, 637204, 'Sungai Ulin', NULL, NULL),
(9, 637203, 'Bangkal', NULL, NULL),
(10, 637203, 'Cempaka', NULL, NULL),
(11, 637203, 'Palam', NULL, NULL),
(12, 637203, 'Sungai Tiung', NULL, NULL),
(13, 637202, 'Guntung Manggis', NULL, NULL),
(14, 637202, 'Guntung Payung', NULL, NULL),
(15, 637202, 'Landasan Ulin Timur', NULL, NULL),
(16, 637202, 'Syamsudin Noor', NULL, NULL),
(17, 637206, 'Landasan Ulin Barat', NULL, NULL),
(18, 637206, 'Landasan Ulin Selatan', NULL, NULL),
(19, 637206, 'Landasan Ulin Tengah', NULL, NULL),
(20, 637206, 'Landasan Ulin Utara', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kursus_calon_pengantin`
--

CREATE TABLE `kursus_calon_pengantin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `perkawinan_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah_laki` int(11) NOT NULL DEFAULT 0,
  `jumlah_wanita` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('BELUM','DIAJUKAN','DITOLAK','DISETUJUI') NOT NULL DEFAULT 'BELUM',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(44, '2014_10_12_000000_create_users_table', 1),
(45, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(46, '2019_08_19_000000_create_failed_jobs_table', 1),
(47, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(48, '2024_11_17_103756_create_prias_table', 1),
(49, '2024_11_17_103806_create_perempuans_table', 1),
(65, '2025_02_06_000000_create_kecamatan_table', 2),
(66, '2025_02_06_113634_create_laporan_table', 2),
(67, '2025_02_06_113724_create_kelurahan_table', 2),
(68, '2025_02_06_113735_create_perkawinan_table', 2),
(69, '2025_02_06_113753_create_peristiwa_perkawinan_table', 2),
(70, '2025_02_06_113804_create_pendidikan_perkawinan_table', 2),
(71, '2025_02_06_113815_create_kursus_calon_pengantin_table', 2),
(72, '2025_02_06_113833_create_usia_pengantin_table', 2),
(73, '2025_02_06_121009_add_status_to_laporan_table', 2),
(74, '2025_02_07_181021_add_deleted_at_to_laporan_table', 2),
(75, '2025_02_10_014124_add_file_to_peristiwa_perkawinan_table', 2),
(76, '2025_02_11_074431_add_file_to_pendidikan_perkawinan_table', 2),
(77, '2025_02_11_080335_add_file_to_kursus_calon_engantin_table', 2),
(78, '2025_02_11_082441_add_file_column_to_usia_pengantin_table', 2),
(79, '2025_06_25_011116_create_pernikahans_table', 2),
(80, '2025_06_25_013613_drop_tempat_pernikahan_column_in_pernikahans_table', 3),
(81, '2025_06_25_025948_add_kewarnegaraan_column_to_prias_table', 4),
(82, '2025_06_25_025958_add_kewarnegaraan_column_to_perempuans_table', 4),
(83, '2025_06_25_031415_add_kewarnegaraan_column_to_perempuans_table', 5),
(84, '2025_06_25_031833_add_hasil_rujukan_to_pernikahans_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan_perkawinan`
--

CREATE TABLE `pendidikan_perkawinan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `perkawinan_id` bigint(20) UNSIGNED NOT NULL,
  `laki_sd` int(11) NOT NULL DEFAULT 0,
  `laki_smp` int(11) NOT NULL DEFAULT 0,
  `laki_sma` int(11) NOT NULL DEFAULT 0,
  `laki_sarjana` int(11) NOT NULL DEFAULT 0,
  `wanita_sd` int(11) NOT NULL DEFAULT 0,
  `wanita_smp` int(11) NOT NULL DEFAULT 0,
  `wanita_sma` int(11) NOT NULL DEFAULT 0,
  `wanita_sarjana` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perempuans`
--

CREATE TABLE `perempuans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `usia` varchar(255) NOT NULL,
  `pendidikan` varchar(255) NOT NULL,
  `sertif_sucatin` varchar(255) NOT NULL,
  `kewarganegaraan` enum('WNI','WNA') NOT NULL DEFAULT 'WNI',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perempuans`
--

INSERT INTO `perempuans` (`id`, `nama`, `usia`, `pendidikan`, `sertif_sucatin`, `kewarganegaraan`, `created_at`, `updated_at`) VALUES
(1, '123', '12', 'Sarjana', 'true', 'WNI', '2025-06-24 17:24:34', '2025-06-24 17:38:05'),
(2, 'aliy', '32', 'Sarjana', 'true', 'WNI', '2025-06-24 19:15:44', '2025-06-24 19:22:22'),
(3, 'Nalar Putra', '40', 'D3', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(4, 'Mulyono Hutagalung', '21', 'SD', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(5, 'Edi Salahudin S.H.', '35', 'SMA', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(6, 'Carub Ramadan', '30', 'S2', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(7, 'Ade Marpaung', '24', 'SMA', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(8, 'Respati Bajragin Ardianto S.E.I', '20', 'S1', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(9, 'Jayeng Salahudin', '28', 'S1', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(10, 'Gatot Embuh Nashiruddin S.Gz', '30', 'S2', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(11, 'Legawa Tamba', '35', 'D3', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(12, 'Perkasa Zulkarnain', '40', 'D3', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(13, 'Heru Sinaga', '34', 'S1', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(14, 'Uda Wacana', '25', 'S1', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(15, 'Vega Aditya Situmorang', '27', 'S2', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(16, 'Hartaka Budiyanto', '40', 'SD', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(17, 'Wakiman Hidayat', '30', 'S2', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(18, 'Aris Prakasa', '24', 'S2', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(19, 'Harto Lamar Ramadan M.Farm', '23', 'S2', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(20, 'Rizki Perkasa Tarihoran M.M.', '35', 'S2', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(21, 'Tugiman Galak Prasetyo', '37', 'D3', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(22, 'Arta Jayadi Januar S.Ked', '38', 'D3', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(23, 'Purwa Dabukke', '24', 'SD', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(24, 'Ihsan Tamba S.H.', '34', 'S1', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(25, 'Prayoga Irawan', '28', 'S2', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(26, 'Lurhur Ramadan', '28', 'S2', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(27, 'Tasnim Nashiruddin', '25', 'S2', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(28, 'Raden Prasetya', '21', 'SMA', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(29, 'Bakidin Kajen Latupono M.TI.', '39', 'SMP', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(30, 'Atma Prabowo', '23', 'SD', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(31, 'Oskar Pradipta', '23', 'D3', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(32, 'Anggabaya Baktiono Pranowo', '34', 'D3', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(33, 'Jamil Kasiran Adriansyah', '34', 'SD', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(34, 'Jati Thamrin', '35', 'D3', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(35, 'Kamidin Maheswara', '39', 'SD', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(36, 'Bakti Mahdi Maulana', '27', 'S2', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(37, 'Asmuni Winarno S.I.Kom', '28', 'SMA', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(38, 'Rudi Simon Setiawan S.H.', '20', 'S1', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(39, 'Galuh Pratama', '25', 'SD', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(40, 'Edison Kuswoyo', '27', 'SD', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(41, 'Harja Megantara', '37', 'SD', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(42, 'Prayoga Adriansyah', '39', 'SMA', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(43, 'Digdaya Budiman', '26', 'S2', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(44, 'Baktiono Wasita', '36', 'D3', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(45, 'Jaeman Wahyudin', '38', 'SMP', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(46, 'Vino Tarihoran', '22', 'S2', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(47, 'Dimaz Karta Wahyudin', '28', 'S1', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(48, 'Ganep Hutagalung', '21', 'SMA', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(49, 'Kasiran Wahyudin', '20', 'S1', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(50, 'Ozy Alambana Pratama', '38', 'S1', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(51, 'Cengkir Nababan', '21', 'D3', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(52, 'Ganep Reza Situmorang', '40', 'S2', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(53, 'Bajragin Dongoran', '34', 'D3', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(54, 'Chandra Raharja Prasasta S.Gz', '38', 'SMA', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(55, 'Argono Jayadi Mahendra', '22', 'SMP', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(56, 'Luwes Wijaya', '25', 'SD', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(57, 'Dimaz Hutasoit', '36', 'SD', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(58, 'Balangga Warsa Wijaya', '39', 'SMP', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(59, 'Legawa Rangga Pradipta S.IP', '38', 'SMP', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(60, 'Dalimin Samosir', '23', 'SD', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(61, 'Rusman Jailani', '20', 'S2', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(62, 'Daru Balamantri Nainggolan', '28', 'SMP', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(63, 'Dipa Sihombing', '37', 'SMA', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(64, 'Lanang Among Tamba', '39', 'S2', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(65, 'Cahya Kuswoyo', '31', 'S1', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(66, 'Carub Januar', '35', 'S1', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(67, 'Limar Elvin Nashiruddin S.Gz', '39', 'SMP', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(68, 'Gangsa Damanik S.E.I', '39', 'SMA', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(69, 'Respati Damanik', '35', 'SD', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(70, 'Saiful Pradana', '32', 'S1', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(71, 'Martani Raditya Megantara', '26', 'SD', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(72, 'Edward Firmansyah', '27', 'D3', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(73, 'Mustika Ozy Anggriawan M.TI.', '26', 'D3', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(74, 'Ajiono Kurniawan S.Farm', '31', 'S1', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(75, 'Mujur Tarihoran', '30', 'S2', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(76, 'Harsaya Saputra', '37', 'SD', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(77, 'Karsa Manullang M.Pd', '25', 'SD', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(78, 'Langgeng Sirait', '24', 'S1', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(79, 'Karta Cengkir Lazuardi', '22', 'SMP', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(80, 'Jagapati Saragih', '24', 'D3', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(81, 'Timbul Halim', '39', 'SD', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(82, 'Rahmat Jatmiko Nashiruddin M.Farm', '29', 'SD', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(83, 'Asmadi Vino Zulkarnain', '32', 'D3', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(84, 'Lembah Hartana Narpati', '33', 'S1', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(85, 'Balangga Balapati Prasasta', '33', 'SD', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(86, 'Warji Wahyudin', '40', 'SMA', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(87, 'Bakti Nainggolan', '26', 'S1', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(88, 'Wardaya Maryadi', '27', 'D3', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(89, 'Ian Sirait S.Psi', '22', 'S2', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(90, 'Labuh Sirait', '39', 'SD', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(91, 'Prasetyo Prayoga', '29', 'SMP', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(92, 'Viktor Adhiarja Hutapea', '27', 'SD', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(93, 'Raden Lazuardi', '37', 'S2', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(94, 'Gamani Hakim', '31', 'S1', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(95, 'Sidiq Sinaga', '39', 'SMA', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(96, 'Kusuma Laksana Nashiruddin', '33', 'SMP', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(97, 'Marsito Rajata M.Kom.', '28', 'D3', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(98, 'Ikhsan Baktianto Zulkarnain', '34', 'S1', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(99, 'Parman Marbun', '30', 'SMA', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(100, 'Mursita Mulyanto Jailani S.Sos', '33', 'D3', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(101, 'Gaduh Firmansyah', '23', 'D3', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(102, 'Imam Artanto Sitompul', '23', 'S1', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(103, 'Eka Mansur', '35', 'SD', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(104, 'Raihan Gunawan', '36', 'S1', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(105, 'Pangeran Maulana', '40', 'SD', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(106, 'Gadang Rajata', '25', 'S2', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(107, 'Kemal Simanjuntak S.Psi', '40', 'SMA', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(108, 'Cecep Jailani M.Farm', '35', 'S1', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(109, 'Karsa Uwais', '20', 'SD', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(110, 'Galih Mahendra', '28', 'S2', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(111, 'Ajiono Kurniawan', '39', 'S1', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(112, 'Kajen Ikhsan Prabowo', '24', 'S2', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(113, 'Slamet Budiman', '36', 'S1', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(114, 'Kayun Januar', '35', 'SD', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(115, 'Gamblang Budiman', '26', 'SMA', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(116, 'Irnanto Ismail Hakim', '23', 'SMA', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(117, 'Laksana Darmanto Prasetyo', '32', 'S1', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(118, 'Marsudi Irfan Damanik', '27', 'SD', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(119, 'Lanang Maulana S.E.', '32', 'SD', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(120, 'Ridwan Situmorang', '33', 'SD', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(121, 'Yusuf Zulkarnain S.Kom', '25', 'D3', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(122, 'Cakrawangsa Saputra S.Pd', '25', 'S2', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(123, 'Lasmono Balangga Prasetya', '24', 'SMA', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(124, 'Eman Lurhur Budiman M.M.', '36', 'SMP', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(125, 'Wardaya Habibi', '39', 'S2', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(126, 'Taswir Wibisono', '29', 'D3', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(127, 'Darsirah Lazuardi', '26', 'SMP', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(128, 'Hamzah Jumadi Sihombing', '24', 'SD', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(129, 'Rafid Sihombing', '25', 'S1', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(130, 'Ajimat Estiawan Prasetyo S.Pd', '27', 'S1', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(131, 'Wisnu Tampubolon', '24', 'SMP', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(132, 'Wage Mandala', '20', 'D3', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(133, 'Okto Siregar', '39', 'SD', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(134, 'Lasmono Darsirah Hutasoit M.Ak', '30', 'SD', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(135, 'Caraka Wahyudin', '34', 'SD', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(136, 'Jarwi Wage Simbolon', '37', 'SMP', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(137, 'Hendri Mustofa', '29', 'S2', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(138, 'Margana Permadi', '35', 'SMP', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(139, 'Samsul Gunarto', '32', 'S2', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(140, 'Daruna Sirait', '20', 'SMP', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(141, 'Parman Hardiansyah', '31', 'SMA', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(142, 'Luhung Hardiansyah', '35', 'S1', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(143, 'Bagya Lukita Nababan S.IP', '34', 'SMA', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(144, 'Karya Saka Wibisono', '23', 'SMP', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(145, 'Jamal Baktiono Firgantoro S.Sos', '30', 'SMP', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(146, 'Unggul Wasita', '33', 'D3', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(147, 'Erik Saka Firgantoro', '21', 'SD', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(148, 'Makuta Pratama', '20', 'SD', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(149, 'Lamar Pangestu Wibisono S.H.', '31', 'SMA', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(150, 'Budi Sihotang', '26', 'S1', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(151, 'Cakrabirawa Lazuardi S.E.I', '22', 'SMA', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(152, 'Atmaja Salahudin', '31', 'SMP', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21');

-- --------------------------------------------------------

--
-- Table structure for table `peristiwa_perkawinan`
--

CREATE TABLE `peristiwa_perkawinan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `perkawinan_id` bigint(20) UNSIGNED NOT NULL,
  `kantor` int(11) NOT NULL DEFAULT 0,
  `luar_kantor` int(11) NOT NULL DEFAULT 0,
  `perkawinan_campuran_laki` int(11) NOT NULL DEFAULT 0,
  `perkawinan_campuran_perempuan` int(11) NOT NULL DEFAULT 0,
  `rujuk` int(11) NOT NULL DEFAULT 0,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perkawinan`
--

CREATE TABLE `perkawinan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `laporan_id` bigint(20) UNSIGNED NOT NULL,
  `kelurahan_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah_perkawinan` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pernikahans`
--

CREATE TABLE `pernikahans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pria` bigint(20) UNSIGNED NOT NULL,
  `id_perempuan` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_kelurahan` bigint(20) UNSIGNED NOT NULL,
  `tanggal_pernikahan` date NOT NULL,
  `hasil_rujukan` enum('ya','tidak') NOT NULL DEFAULT 'tidak',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pernikahans`
--

INSERT INTO `pernikahans` (`id`, `id_pria`, `id_perempuan`, `id_user`, `id_kelurahan`, `tanggal_pernikahan`, `hasil_rujukan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 15, '2004-04-04', 'tidak', '2025-06-24 17:38:05', '2025-06-24 18:13:02'),
(2, 3, 2, 1, 12, '2024-04-04', 'ya', '2025-06-24 19:22:22', '2025-06-24 19:22:22'),
(3, 32, 125, 2, 13, '2024-01-01', 'tidak', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(4, 96, 127, 2, 16, '2024-12-06', 'tidak', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(5, 167, 86, 1, 8, '2025-03-26', 'tidak', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(6, 89, 91, 1, 14, '2024-05-16', 'tidak', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(7, 171, 8, 2, 2, '2023-07-18', 'tidak', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(8, 193, 85, 3, 19, '2025-05-19', 'tidak', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(9, 186, 80, 2, 4, '2025-03-08', 'tidak', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(10, 171, 42, 2, 14, '2024-04-03', 'tidak', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(11, 33, 68, 2, 19, '2025-04-25', 'tidak', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(12, 165, 61, 2, 18, '2024-04-21', 'tidak', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(13, 195, 95, 3, 10, '2024-09-04', 'tidak', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(14, 91, 133, 2, 20, '2023-07-18', 'tidak', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(15, 74, 59, 3, 7, '2025-02-09', 'tidak', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(16, 161, 47, 3, 19, '2024-01-26', 'tidak', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(17, 184, 150, 3, 6, '2023-11-06', 'tidak', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(18, 68, 130, 3, 2, '2024-03-30', 'tidak', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(19, 49, 128, 3, 7, '2024-04-25', 'tidak', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(20, 142, 10, 3, 20, '2024-06-04', 'tidak', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(21, 141, 3, 3, 6, '2025-06-23', 'tidak', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(22, 55, 68, 1, 3, '2023-08-19', 'tidak', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(23, 145, 42, 2, 2, '2024-02-04', 'tidak', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(24, 145, 20, 3, 19, '2025-04-12', 'tidak', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(25, 118, 124, 3, 5, '2024-05-18', 'tidak', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(26, 157, 36, 2, 16, '2024-02-12', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(27, 1, 98, 3, 3, '2024-02-07', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(28, 166, 110, 1, 18, '2024-08-30', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(29, 200, 52, 1, 13, '2023-08-24', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(30, 185, 99, 1, 12, '2024-10-05', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(31, 106, 13, 2, 20, '2024-04-08', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(32, 37, 73, 2, 12, '2024-04-20', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(33, 67, 111, 1, 10, '2025-01-17', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(34, 78, 114, 3, 13, '2025-01-26', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(35, 47, 85, 2, 4, '2024-12-09', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(36, 170, 45, 3, 12, '2025-05-30', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(37, 152, 34, 3, 12, '2024-02-19', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(38, 87, 139, 3, 15, '2024-04-13', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(39, 34, 113, 1, 16, '2023-11-11', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(40, 67, 74, 3, 18, '2023-09-22', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(41, 2, 89, 1, 20, '2024-09-08', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(42, 28, 92, 3, 9, '2024-11-20', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(43, 3, 123, 1, 6, '2024-06-30', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(44, 15, 124, 2, 2, '2024-10-08', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(45, 23, 102, 1, 8, '2025-06-10', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(46, 70, 86, 1, 5, '2024-10-18', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(47, 35, 126, 3, 13, '2024-10-05', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(48, 114, 9, 1, 5, '2024-11-29', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(49, 103, 46, 1, 17, '2025-02-03', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(50, 73, 21, 3, 15, '2025-03-27', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(51, 182, 121, 2, 12, '2024-01-31', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(52, 113, 33, 1, 11, '2023-08-01', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(53, 185, 104, 2, 7, '2024-08-12', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(54, 58, 20, 1, 1, '2023-08-04', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(55, 42, 94, 3, 2, '2024-01-11', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(56, 23, 94, 1, 12, '2024-01-24', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(57, 126, 10, 3, 2, '2024-08-21', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(58, 198, 68, 2, 2, '2024-10-24', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(59, 139, 19, 3, 4, '2025-02-01', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(60, 200, 117, 3, 12, '2023-12-04', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(61, 135, 67, 2, 1, '2023-09-01', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(62, 55, 11, 2, 9, '2025-01-02', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(63, 177, 34, 2, 15, '2024-11-18', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(64, 83, 50, 2, 16, '2025-05-16', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(65, 34, 39, 3, 11, '2024-02-27', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(66, 31, 39, 2, 20, '2025-04-08', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(67, 181, 28, 2, 19, '2025-03-19', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(68, 16, 44, 3, 7, '2024-09-22', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(69, 117, 103, 3, 1, '2024-11-07', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(70, 188, 113, 1, 14, '2024-02-05', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(71, 139, 31, 2, 10, '2024-10-25', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(72, 78, 108, 1, 3, '2024-02-11', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(73, 46, 109, 3, 18, '2025-04-16', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(74, 76, 25, 2, 5, '2024-12-02', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(75, 148, 20, 3, 6, '2024-11-21', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(76, 204, 1, 2, 5, '2025-01-26', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(77, 61, 97, 2, 13, '2023-11-21', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(78, 27, 119, 2, 16, '2024-01-12', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(79, 180, 92, 1, 15, '2025-05-04', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(80, 61, 63, 2, 5, '2023-11-13', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(81, 36, 20, 1, 19, '2023-10-02', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(82, 17, 5, 1, 17, '2024-10-26', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(83, 44, 41, 2, 1, '2025-03-22', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(84, 136, 51, 2, 7, '2023-10-09', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(85, 150, 62, 1, 5, '2023-11-03', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(86, 112, 44, 1, 18, '2024-02-14', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(87, 86, 47, 1, 4, '2023-10-28', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(88, 9, 94, 3, 20, '2025-03-21', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(89, 124, 143, 1, 20, '2024-06-26', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(90, 70, 13, 3, 14, '2024-08-07', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(91, 91, 44, 3, 8, '2025-04-21', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(92, 16, 90, 2, 3, '2025-06-03', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(93, 6, 104, 1, 6, '2024-12-09', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(94, 188, 90, 2, 14, '2024-12-30', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(95, 125, 123, 1, 1, '2024-02-15', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(96, 128, 117, 3, 12, '2023-10-12', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(97, 29, 53, 3, 5, '2025-01-27', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(98, 50, 129, 1, 7, '2025-05-31', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(99, 65, 142, 3, 5, '2023-12-10', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(100, 33, 98, 3, 12, '2025-06-20', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(101, 133, 25, 2, 3, '2023-11-23', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(102, 86, 110, 1, 19, '2024-12-20', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(103, 133, 123, 2, 1, '2024-03-26', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(104, 47, 5, 3, 17, '2024-08-30', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(105, 157, 111, 3, 4, '2024-03-22', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(106, 103, 51, 2, 1, '2024-10-30', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(107, 188, 150, 2, 16, '2024-05-29', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(108, 189, 41, 2, 17, '2024-06-04', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(109, 182, 117, 2, 2, '2023-09-19', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(110, 159, 139, 1, 3, '2025-01-19', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(111, 132, 74, 2, 14, '2024-04-10', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(112, 14, 35, 1, 12, '2024-10-14', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(113, 33, 17, 3, 19, '2024-10-06', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(114, 19, 82, 2, 15, '2024-03-01', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(115, 73, 80, 1, 19, '2024-08-30', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(116, 130, 37, 2, 19, '2024-03-27', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(117, 68, 55, 3, 12, '2023-08-28', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(118, 127, 122, 1, 5, '2024-10-13', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(119, 110, 51, 2, 5, '2024-06-04', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(120, 112, 91, 1, 11, '2024-07-31', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(121, 138, 68, 3, 1, '2023-07-25', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(122, 113, 79, 2, 10, '2024-03-09', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(123, 165, 103, 2, 9, '2024-01-15', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(124, 62, 43, 3, 16, '2023-08-24', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(125, 86, 16, 3, 18, '2025-01-25', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(126, 98, 49, 3, 16, '2025-06-24', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(127, 35, 69, 2, 13, '2025-03-31', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(128, 124, 67, 1, 12, '2023-11-11', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(129, 16, 11, 3, 20, '2023-09-10', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(130, 41, 64, 1, 6, '2023-11-09', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(131, 175, 21, 2, 5, '2024-01-11', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(132, 197, 123, 2, 7, '2024-07-08', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(133, 205, 14, 1, 2, '2024-12-27', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(134, 31, 110, 2, 17, '2024-06-18', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(135, 143, 133, 1, 2, '2024-07-02', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(136, 202, 119, 3, 11, '2023-07-17', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(137, 57, 147, 3, 4, '2025-04-11', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(138, 96, 112, 3, 9, '2025-02-03', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(139, 16, 10, 3, 3, '2024-06-03', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(140, 81, 89, 3, 19, '2024-05-01', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(141, 38, 22, 1, 14, '2025-05-31', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(142, 192, 140, 1, 5, '2024-09-12', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(143, 33, 102, 3, 1, '2024-03-25', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(144, 58, 32, 3, 8, '2024-07-01', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(145, 169, 90, 2, 15, '2024-10-10', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(146, 126, 71, 1, 17, '2024-04-10', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(147, 83, 136, 1, 9, '2023-10-11', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(148, 66, 106, 1, 16, '2024-04-26', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(149, 74, 109, 3, 19, '2024-08-24', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(150, 10, 61, 3, 3, '2025-03-13', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(151, 46, 79, 2, 5, '2024-12-10', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22'),
(152, 51, 8, 3, 16, '2024-10-25', 'tidak', '2025-06-25 20:12:22', '2025-06-25 20:12:22');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prias`
--

CREATE TABLE `prias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `usia` varchar(255) NOT NULL,
  `pendidikan` varchar(255) NOT NULL,
  `sertif_sucatin` varchar(255) NOT NULL,
  `kewarganegaraan` enum('WNI','WNA') NOT NULL DEFAULT 'WNI',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prias`
--

INSERT INTO `prias` (`id`, `nama`, `usia`, `pendidikan`, `sertif_sucatin`, `kewarganegaraan`, `created_at`, `updated_at`) VALUES
(1, 'Udin', '12', 'SMP', 'true', 'WNI', '2025-06-24 17:24:19', '2025-06-24 17:38:05'),
(2, 'aav', '12', 'SMP', 'true', 'WNI', '2025-06-24 19:04:42', '2025-06-24 19:04:42'),
(3, 'james', '43', 'Magister', 'true', 'WNI', '2025-06-24 19:05:36', '2025-06-24 19:22:22'),
(6, 'Lembah Timbul Simanjuntak', '23', 'S2', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(7, 'Ibrani Dirja Winarno', '38', 'S2', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(8, 'Murti Arsipatra Prabowo', '33', 'S1', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(9, 'Eka Prasasta', '37', 'D3', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(10, 'Danang Darmaji Tampubolon S.H.', '37', 'SD', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(11, 'Martaka Hutapea', '40', 'SD', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(12, 'Darsirah Ilyas Januar S.I.Kom', '31', 'D3', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(13, 'Cagak Kurniawan', '23', 'SMA', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(14, 'Purwa Firmansyah', '25', 'S2', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(15, 'Dadi Cemplunk Manullang M.Kom.', '30', 'SMP', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(16, 'Balangga Ajimin Samosir', '33', 'SMA', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(17, 'Lurhur Langgeng Firgantoro S.E.', '26', 'SD', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(18, 'Rudi Naradi Setiawan', '23', 'SD', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(19, 'Jaeman Simanjuntak S.H.', '32', 'SMP', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(20, 'Cakrabuana Mahmud Nainggolan', '38', 'D3', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(21, 'Cahya Kajen Prayoga M.Farm', '37', 'SD', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(22, 'Saadat Natsir', '39', 'S1', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(23, 'Raihan Panca Utama M.Kom.', '32', 'S2', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(24, 'Nasim Hakim', '29', 'S2', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(25, 'Mujur Haryanto', '25', 'SMP', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(26, 'Aslijan Hutagalung S.E.I', '34', 'S1', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(27, 'Jagaraga Budiman S.Kom', '20', 'S1', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(28, 'Darmaji Jailani M.Pd', '40', 'SMA', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(29, 'Gambira Prayoga Maheswara', '22', 'S2', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(30, 'Maryanto Pangestu', '37', 'SMA', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(31, 'Panji Akarsana Wibowo S.Gz', '30', 'SMA', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(32, 'Gaiman Bakianto Siregar M.Pd', '40', 'SD', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(33, 'Artanto Saputra', '28', 'SMP', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(34, 'Ibrani Hutasoit', '35', 'S2', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(35, 'Martani Ibrahim Setiawan', '36', 'SMA', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(36, 'Niyaga Sitompul', '20', 'D3', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(37, 'Gangsa Prayoga M.TI.', '29', 'SMA', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(38, 'Kemba Nardi Natsir M.Ak', '27', 'SD', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(39, 'Cakrabuana Hadi Mansur', '29', 'SD', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(40, 'Harto Thamrin', '40', 'SD', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(41, 'Limar Manullang', '32', 'D3', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(42, 'Darmaji Hutagalung', '36', 'D3', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(43, 'Budi Prasetyo', '40', 'S1', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(44, 'Daniswara Wibowo', '25', 'S1', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(45, 'Galiono Waluyo', '31', 'S2', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(46, 'Xanana Samosir', '33', 'SMP', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(47, 'Rangga Waluyo Suryono S.T.', '39', 'SMA', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(48, 'Tirtayasa Waluyo', '23', 'D3', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(49, 'Ajimin Pangeran Siregar S.Gz', '22', 'SMP', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(50, 'Gara Cemeti Suwarno S.H.', '35', 'SD', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(51, 'Caket Sihotang', '25', 'D3', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(52, 'Maman Gunarto', '22', 'D3', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(53, 'Purwadi Yono Nababan S.Farm', '24', 'S2', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(54, 'Wawan Cahyanto Salahudin', '28', 'S1', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(55, 'Unggul Sihombing', '33', 'S1', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(56, 'Gilang Waskita', '37', 'D3', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(57, 'Gantar Marbun', '32', 'D3', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(58, 'Cakrawala Atmaja Salahudin S.Ked', '33', 'SD', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(59, 'Taswir Emil Hutagalung', '27', 'SD', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(60, 'Kasim Salahudin', '23', 'S2', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(61, 'Dadap Sihotang', '23', 'S2', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(62, 'Daniswara Koko Budiman', '37', 'S2', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(63, 'Okta Megantara', '28', 'SD', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(64, 'Najam Utama', '21', 'S2', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(65, 'Caturangga Dasa Situmorang M.Ak', '31', 'SMA', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(66, 'Abyasa Yono Gunarto S.Pt', '23', 'SD', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(67, 'Kariman Karya Napitupulu', '33', 'SMP', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(68, 'Baktiadi Mahendra S.Pt', '29', 'D3', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(69, 'Mulyono Kurnia Prasetyo M.TI.', '21', 'S1', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(70, 'Cemani Umay Nugroho', '21', 'S2', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(71, 'Mumpuni Johan Nababan S.E.I', '26', 'SMP', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(72, 'Luthfi Mangunsong', '26', 'S2', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(73, 'Irwan Okta Pradana', '32', 'S1', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(74, 'Vega Pangestu', '22', 'S2', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(75, 'Tirtayasa Garda Wijaya', '34', 'D3', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(76, 'Upik Wibowo', '28', 'S1', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(77, 'Ajimin Saputra', '35', 'D3', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(78, 'Aslijan Saputra S.IP', '33', 'SD', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(79, 'Heru Saputra M.M.', '39', 'SD', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(80, 'Yusuf Siregar', '28', 'SMP', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(81, 'Galang Salahudin S.H.', '22', 'S2', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(82, 'Mahesa Ganda Dabukke S.I.Kom', '33', 'S1', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(83, 'Cayadi Maman Haryanto', '23', 'D3', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(84, 'Asman Vero Haryanto S.IP', '40', 'SMP', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(85, 'Yoga Wacana', '33', 'SMA', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(86, 'Olga Budi Dabukke M.Kom.', '39', 'S1', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(87, 'Halim Lazuardi S.IP', '39', 'SMP', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(88, 'Raden Suryono', '23', 'SMP', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(89, 'Kasim Suryono S.Farm', '26', 'SMA', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(90, 'Mahfud Mansur S.Sos', '20', 'S1', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(91, 'Laswi Mangunsong', '30', 'S1', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(92, 'Asirwada Gunawan M.Ak', '37', 'SMA', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(93, 'Galih Dongoran', '28', 'SD', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(94, 'Jatmiko Budiyanto', '28', 'SD', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(95, 'Gaiman Bakianto Nugroho', '34', 'S2', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(96, 'Nyoman Purwadi Kurniawan', '25', 'S1', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(97, 'Cahyono Maheswara', '38', 'D3', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(98, 'Luwar Sitompul S.H.', '35', 'S2', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(99, 'Mumpuni Tarihoran', '28', 'SMP', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(100, 'Arsipatra Habibi', '23', 'SMP', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(101, 'Nalar Adika Prayoga S.Pd', '33', 'SMA', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(102, 'Harsanto Nainggolan M.Kom.', '39', 'SMP', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(103, 'Pranata Aris Nashiruddin S.Ked', '24', 'SMA', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(104, 'Ajimat Radit Firgantoro', '24', 'S2', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(105, 'Gilang Eja Haryanto S.H.', '36', 'S2', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(106, 'Arsipatra Daniswara Wibisono S.Gz', '31', 'SMA', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(107, 'Okta Saefullah', '37', 'SMA', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(108, 'Utama Legawa Budiyanto M.Ak', '26', 'D3', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(109, 'Ismail Lamar Pradana S.Gz', '21', 'D3', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(110, 'Hendri Ibrani Siregar', '27', 'SMP', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(111, 'Sabri Hardiansyah S.I.Kom', '32', 'SMP', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(112, 'Bahuwirya Uwais S.Kom', '39', 'S2', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(113, 'Limar Cemplunk Ardianto', '38', 'S2', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(114, 'Emil Sitorus', '28', 'SMA', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(115, 'Rudi Ardianto', '39', 'SD', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(116, 'Nasab Hardana Uwais', '27', 'S2', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(117, 'Bahuwarna Megantara', '24', 'S1', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(118, 'Jarwa Prasetya', '37', 'S1', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(119, 'Elvin Balangga Budiyanto S.Pt', '25', 'SD', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(120, 'Endra Gunarto', '28', 'SMP', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(121, 'Estiawan Daru Marpaung S.IP', '23', 'SMA', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(122, 'Kamal Thamrin S.Psi', '25', 'SMP', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(123, 'Aris Jindra Hutagalung', '35', 'SMP', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(124, 'Lulut Prasetya Zulkarnain S.Gz', '33', 'D3', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(125, 'Arsipatra Anom Kusumo', '29', 'D3', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(126, 'Kayun Cager Waskita S.Pd', '36', 'S1', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(127, 'Opan Gaiman Halim S.T.', '31', 'SMA', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(128, 'Utama Januar', '29', 'SMA', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(129, 'Lukman Lasmono Situmorang M.M.', '37', 'S2', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(130, 'Radika Himawan Nugroho S.IP', '22', 'D3', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(131, 'Embuh Wahyudin', '32', 'D3', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(132, 'Prabowo Simon Wijaya', '31', 'SD', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(133, 'Kurnia Wahyudin S.T.', '38', 'D3', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(134, 'Jaka Nashiruddin', '39', 'SD', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(135, 'Viman Asmianto Wasita', '21', 'D3', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(136, 'Elvin Jinawi Kusumo', '30', 'D3', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(137, 'Paiman Najmudin', '21', 'SMP', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(138, 'Jarwadi Uwais', '40', 'S1', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(139, 'Vero Saptono', '27', 'SMA', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(140, 'Mustofa Kacung Megantara S.Kom', '35', 'D3', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(141, 'Danang Jailani S.E.I', '26', 'SD', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(142, 'Eka Warsita Natsir M.M.', '23', 'S1', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(143, 'Abyasa Samosir', '20', 'S2', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(144, 'Gangsa Siregar S.E.I', '23', 'SD', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(145, 'Martana Cawuk Adriansyah', '29', 'SMA', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(146, 'Ismail Nasrullah Hutapea S.T.', '36', 'SMP', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(147, 'Damu Nugroho', '20', 'S2', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(148, 'Harimurti Hutasoit', '23', 'SMA', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(149, 'Garang Firmansyah S.E.', '38', 'SD', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(150, 'Harimurti Zulkarnain', '31', 'SMA', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(151, 'Dacin Januar S.Psi', '34', 'S1', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(152, 'Radika Teguh Kuswoyo S.Psi', '31', 'S2', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(153, 'Daliman Suwarno', '21', 'S2', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(154, 'Jaka Santoso', '32', 'SMA', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(155, 'Balijan Tirta Prayoga M.Ak', '20', 'S2', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(156, 'Nugraha Natsir', '22', 'S2', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(157, 'Ganda Manullang', '23', 'D3', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(158, 'Nyana Irawan', '23', 'SD', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(159, 'Radit Pradipta', '30', 'SMP', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(160, 'Laksana Haryanto', '35', 'S2', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(161, 'Liman Panca Budiman', '36', 'SMP', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(162, 'Luhung Marpaung', '26', 'S1', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(163, 'Rizki Bakijan Simbolon M.Farm', '30', 'S1', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(164, 'Marsito Zulkarnain', '21', 'D3', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(165, 'Cahya Darijan Wibisono', '31', 'S2', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(166, 'Viman Danu Wijaya S.I.Kom', '38', 'S1', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(167, 'Kawaya Siregar', '24', 'SMA', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(168, 'Pangestu Tarihoran', '34', 'S1', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(169, 'Tri Unggul Tampubolon M.Ak', '40', 'SMA', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(170, 'Unggul Laksana Widodo S.I.Kom', '34', 'SMP', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(171, 'Opan Mandala', '25', 'SMP', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(172, 'Hari Santoso S.Gz', '31', 'SMP', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(173, 'Jayeng Iswahyudi S.E.I', '26', 'S2', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(174, 'Makuta Natsir S.Pd', '20', 'SMA', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(175, 'Rizki Hardiansyah', '20', 'S2', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(176, 'Wahyu Iswahyudi S.Pd', '32', 'S2', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(177, 'Kusuma Aswani Latupono S.E.', '36', 'S2', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(178, 'Perkasa Salahudin', '28', 'S1', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(179, 'Aditya Napitupulu', '34', 'SMP', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(180, 'Kurnia Nashiruddin', '20', 'S1', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(181, 'Tugiman Rajata', '32', 'SMA', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(182, 'Karman Wijaya', '28', 'SMA', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(183, 'Gaduh Lazuardi M.Ak', '36', 'D3', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(184, 'Kenzie Prakasa', '26', 'S1', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(185, 'Vino Saka Irawan', '33', 'SD', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(186, 'Cakrabuana Hutapea', '40', 'D3', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(187, 'Teguh Putu Saputra', '21', 'S1', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(188, 'Mulyanto Santoso', '40', 'S2', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(189, 'Lulut Asirwanda Lazuardi', '33', 'S1', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(190, 'Bahuwirya Mansur', '39', 'SD', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(191, 'Jagapati Saefullah', '25', 'S1', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(192, 'Bakiono Danang Waluyo M.Ak', '39', 'S1', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(193, 'Dartono Purwanto Habibi', '28', 'S1', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(194, 'Omar Cayadi Firgantoro S.Kom', '25', 'S2', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(195, 'Hartana Najmudin', '22', 'SMA', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(196, 'Cahyadi Setiawan', '20', 'SMP', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(197, 'Jefri Hendri Widodo S.Gz', '36', 'S2', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(198, 'Gaman Wibowo', '40', 'D3', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(199, 'Dimaz Prayoga S.I.Kom', '28', 'D3', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(200, 'Reza Nugroho', '32', 'S2', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(201, 'Uda Mangunsong', '26', 'SMP', 'true', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(202, 'Tri Firmansyah S.Gz', '26', 'S1', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(203, 'Cahyono Mansur', '37', 'D3', 'false', 'WNA', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(204, 'Bahuwarna Mustofa', '36', 'SMA', 'true', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21'),
(205, 'Prakosa Gatra Zulkarnain S.Ked', '39', 'S2', 'false', 'WNI', '2025-06-25 20:12:21', '2025-06-25 20:12:21');

-- --------------------------------------------------------

--
-- Table structure for table `status_pernikahans`
--

CREATE TABLE `status_pernikahans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pernikahan` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `tanggal_perceraian` date DEFAULT NULL,
  `alasan_cerai` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_pernikahans`
--

INSERT INTO `status_pernikahans` (`id`, `id_pernikahan`, `status`, `tanggal_perceraian`, `alasan_cerai`, `created_at`, `updated_at`) VALUES
(1, 1, 'Menikah', NULL, NULL, '2025-06-24 17:38:05', '2025-06-24 17:38:05'),
(2, 2, 'Menikah', NULL, NULL, '2025-06-24 19:22:22', '2025-06-24 19:22:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nip`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, '123', 'admin', '$2y$10$KdehkBMWZUiMUPv/zkMVWeyRl3f7mjZkcpcNZhynMU2Y6WUGJ5JwW', 'admin', '2025-06-24 17:23:49', '2025-06-24 17:23:49'),
(2, '456', 'operator', '$2y$10$Gc7DyjqK65LlY5Kds5Fn8.PcZaSFZeu1AxVbmp2Xnc0B/HSYzGNc2', 'operator', '2025-06-24 17:23:49', '2025-06-24 17:23:49'),
(3, '789', 'kepala', '$2y$10$9JJyvNRktX9D/C2Blcv3/e.jM8tHkKa5n06K2kuRLfXeu/GPnb3QO', 'kua', '2025-06-24 17:23:49', '2025-06-24 17:23:49');

-- --------------------------------------------------------

--
-- Table structure for table `usia_pengantin`
--

CREATE TABLE `usia_pengantin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `perkawinan_id` bigint(20) UNSIGNED NOT NULL,
  `laki_minus_19` int(11) NOT NULL DEFAULT 0,
  `laki_19_21` int(11) NOT NULL DEFAULT 0,
  `laki_21_30` int(11) NOT NULL DEFAULT 0,
  `laki_30_plus` int(11) NOT NULL DEFAULT 0,
  `wanita_minus_19` int(11) NOT NULL DEFAULT 0,
  `wanita_19_21` int(11) NOT NULL DEFAULT 0,
  `wanita_21_30` int(11) NOT NULL DEFAULT 0,
  `wanita_30_plus` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelurahan_id_kecamatan_foreign` (`id_kecamatan`);

--
-- Indexes for table `kursus_calon_pengantin`
--
ALTER TABLE `kursus_calon_pengantin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kursus_calon_pengantin_perkawinan_id_foreign` (`perkawinan_id`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pendidikan_perkawinan`
--
ALTER TABLE `pendidikan_perkawinan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pendidikan_perkawinan_perkawinan_id_foreign` (`perkawinan_id`);

--
-- Indexes for table `perempuans`
--
ALTER TABLE `perempuans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peristiwa_perkawinan`
--
ALTER TABLE `peristiwa_perkawinan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peristiwa_perkawinan_perkawinan_id_foreign` (`perkawinan_id`);

--
-- Indexes for table `perkawinan`
--
ALTER TABLE `perkawinan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perkawinan_laporan_id_foreign` (`laporan_id`),
  ADD KEY `perkawinan_kelurahan_id_foreign` (`kelurahan_id`);

--
-- Indexes for table `pernikahans`
--
ALTER TABLE `pernikahans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pernikahans_id_pria_foreign` (`id_pria`),
  ADD KEY `pernikahans_id_perempuan_foreign` (`id_perempuan`),
  ADD KEY `pernikahans_id_user_foreign` (`id_user`),
  ADD KEY `pernikahans_id_kelurahan_foreign` (`id_kelurahan`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `prias`
--
ALTER TABLE `prias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_pernikahans`
--
ALTER TABLE `status_pernikahans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usia_pengantin`
--
ALTER TABLE `usia_pengantin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usia_pengantin_perkawinan_id_foreign` (`perkawinan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=637207;

--
-- AUTO_INCREMENT for table `kelurahan`
--
ALTER TABLE `kelurahan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `kursus_calon_pengantin`
--
ALTER TABLE `kursus_calon_pengantin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `pendidikan_perkawinan`
--
ALTER TABLE `pendidikan_perkawinan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perempuans`
--
ALTER TABLE `perempuans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `peristiwa_perkawinan`
--
ALTER TABLE `peristiwa_perkawinan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perkawinan`
--
ALTER TABLE `perkawinan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pernikahans`
--
ALTER TABLE `pernikahans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prias`
--
ALTER TABLE `prias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `status_pernikahans`
--
ALTER TABLE `status_pernikahans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usia_pengantin`
--
ALTER TABLE `usia_pengantin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD CONSTRAINT `kelurahan_id_kecamatan_foreign` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kursus_calon_pengantin`
--
ALTER TABLE `kursus_calon_pengantin`
  ADD CONSTRAINT `kursus_calon_pengantin_perkawinan_id_foreign` FOREIGN KEY (`perkawinan_id`) REFERENCES `perkawinan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pendidikan_perkawinan`
--
ALTER TABLE `pendidikan_perkawinan`
  ADD CONSTRAINT `pendidikan_perkawinan_perkawinan_id_foreign` FOREIGN KEY (`perkawinan_id`) REFERENCES `perkawinan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `peristiwa_perkawinan`
--
ALTER TABLE `peristiwa_perkawinan`
  ADD CONSTRAINT `peristiwa_perkawinan_perkawinan_id_foreign` FOREIGN KEY (`perkawinan_id`) REFERENCES `perkawinan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `perkawinan`
--
ALTER TABLE `perkawinan`
  ADD CONSTRAINT `perkawinan_kelurahan_id_foreign` FOREIGN KEY (`kelurahan_id`) REFERENCES `kelurahan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `perkawinan_laporan_id_foreign` FOREIGN KEY (`laporan_id`) REFERENCES `laporan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pernikahans`
--
ALTER TABLE `pernikahans`
  ADD CONSTRAINT `pernikahans_id_kelurahan_foreign` FOREIGN KEY (`id_kelurahan`) REFERENCES `kelurahan` (`id`),
  ADD CONSTRAINT `pernikahans_id_perempuan_foreign` FOREIGN KEY (`id_perempuan`) REFERENCES `perempuans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pernikahans_id_pria_foreign` FOREIGN KEY (`id_pria`) REFERENCES `prias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pernikahans_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `usia_pengantin`
--
ALTER TABLE `usia_pengantin`
  ADD CONSTRAINT `usia_pengantin_perkawinan_id_foreign` FOREIGN KEY (`perkawinan_id`) REFERENCES `perkawinan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
