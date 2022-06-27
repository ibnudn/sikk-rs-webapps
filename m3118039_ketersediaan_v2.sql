-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 27, 2022 at 06:42 AM
-- Server version: 10.2.40-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `m3118039_ketersediaan_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(11) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 1, 'mainappkey', 0, 0, 0, NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `log_kapasitas`
--

CREATE TABLE `log_kapasitas` (
  `id_log_kapasitas` int(11) NOT NULL,
  `id_faskes` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `data_kapasitas` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_kapasitas`
--

INSERT INTO `log_kapasitas` (`id_log_kapasitas`, `id_faskes`, `id_kelas`, `data_kapasitas`, `created_at`) VALUES
(1, 1, 1, 5, '2021-09-20 07:04:21'),
(2, 1, 1, 7, '2021-09-20 10:16:43'),
(3, 1, 1, 6, '2021-09-20 10:16:58'),
(4, 1, 2, 10, '2021-09-20 10:31:09'),
(5, 1, 3, 25, '2021-09-20 22:24:38'),
(6, 1, 4, 35, '2021-09-20 22:24:38'),
(7, 1, 2, 8, '2021-09-20 22:24:48'),
(8, 2, 10, 5, '2021-09-20 22:41:38'),
(9, 1, 3, 20, '2021-09-21 23:28:16'),
(23, 1, 4, 45, '2021-09-21 23:49:49'),
(24, 3, 5, 147, '2021-09-22 00:05:49'),
(25, 1, 5, 160, '2021-09-22 22:19:43'),
(26, 1, 6, 15, '2021-09-22 23:02:15'),
(27, 1, 3, 16, '2021-10-23 13:26:31'),
(28, 1, 5, 164, '2021-10-23 13:27:59'),
(29, 3, 4, 25, '2021-11-12 08:04:39'),
(30, 3, 6, 5, '2021-11-15 11:29:07'),
(31, 3, 4, 39, '2022-02-21 05:12:10'),
(32, 3, 9, 25, '2022-02-24 13:24:17'),
(37, 12, 10, 7, '2022-03-07 14:32:25'),
(38, 14, 3, 25, '2022-03-23 13:04:02'),
(39, 14, 4, 57, '2022-03-23 13:04:02'),
(40, 14, 4, 64, '2022-03-23 13:04:16'),
(41, 5, 5, 23, '2022-06-14 13:43:04'),
(42, 5, 5, 25, '2022-06-14 13:43:37'),
(43, 5, 4, 15, '2022-06-14 21:55:28'),
(44, 5, 6, 5, '2022-06-14 21:55:28'),
(45, 2, 10, 7, '2022-06-20 05:26:42'),
(46, 4, 10, 8, '2022-06-21 04:35:24'),
(47, 4, 10, 10, '2022-06-21 04:35:43'),
(48, 17, 5, 23, '2022-06-23 01:39:30'),
(49, 17, 4, 5, '2022-06-23 01:39:30'),
(50, 17, 4, 7, '2022-06-23 01:39:46'),
(51, 14, 5, 76, '2022-06-26 12:13:02');

-- --------------------------------------------------------

--
-- Table structure for table `log_ketersediaan`
--

CREATE TABLE `log_ketersediaan` (
  `id_log_ketersediaan` int(11) NOT NULL,
  `id_faskes` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `data_ketersediaan` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_ketersediaan`
--

INSERT INTO `log_ketersediaan` (`id_log_ketersediaan`, `id_faskes`, `id_kelas`, `data_ketersediaan`, `created_at`) VALUES
(1, 2, 10, 4, '2021-09-21 22:52:29'),
(5, 2, 10, 3, '2021-09-21 23:51:50'),
(6, 1, 1, 3, '2021-09-22 00:12:22'),
(7, 1, 2, 4, '2021-09-22 00:12:22'),
(8, 1, 3, 15, '2021-09-22 00:12:22'),
(9, 1, 4, 25, '2021-09-22 00:12:22'),
(10, 3, 5, 98, '2021-09-22 23:09:34'),
(11, 1, 5, 52, '2021-09-22 23:10:45'),
(12, 1, 6, 7, '2021-09-22 23:10:45'),
(13, 1, 1, 4, '2021-10-23 13:37:09'),
(14, 1, 1, 4, '2021-10-23 13:37:32'),
(15, 1, 2, 7, '2021-10-23 13:39:47'),
(16, 1, 3, 14, '2021-10-23 13:52:41'),
(17, 1, 3, 12, '2021-10-23 14:03:04'),
(18, 1, 4, 30, '2021-10-23 14:28:22'),
(19, 1, 5, 150, '2021-10-23 14:29:04'),
(20, 1, 5, 87, '2021-10-23 14:31:38'),
(21, 1, 6, 14, '2021-10-23 14:34:24'),
(22, 1, 6, 8, '2021-10-23 14:35:21'),
(23, 1, 6, 14, '2021-10-23 14:41:10'),
(24, 1, 1, 5, '2021-10-23 14:42:05'),
(25, 1, 2, 4, '2021-10-23 14:42:34'),
(26, 1, 3, 8, '2021-10-23 14:42:53'),
(27, 3, 5, 138, '2021-10-23 14:48:30'),
(28, 3, 5, 125, '2021-10-23 14:51:32'),
(29, 3, 4, 30, '2021-11-12 08:04:52'),
(30, 3, 4, 26, '2021-11-12 08:11:07'),
(31, 3, 4, 35, '2021-11-12 08:16:59'),
(32, 3, 4, 32, '2021-11-15 11:21:03'),
(33, 3, 4, 35, '2021-11-15 11:23:15'),
(34, 3, 4, 35, '2021-11-15 11:35:27'),
(38, 3, 4, 30, '2021-11-15 11:49:13'),
(39, 3, 5, 125, '2021-11-15 11:49:13'),
(40, 3, 6, 3, '2021-11-15 11:49:13'),
(41, 3, 4, 32, '2021-11-15 11:51:03'),
(42, 3, 6, 25, '2021-11-15 11:51:03'),
(55, 3, 4, 25, '2022-02-22 12:59:54'),
(56, 3, 6, 40, '2022-02-22 12:59:54'),
(57, 3, 4, 25, '2022-02-24 13:21:16'),
(58, 3, 5, 40, '2022-02-24 13:21:16'),
(59, 3, 6, 3, '2022-02-24 13:21:16'),
(60, 12, 10, 6, '2022-03-07 14:33:32'),
(61, 12, 10, 5, '2022-03-07 15:00:56'),
(62, 2, 10, 4, '2022-03-07 15:50:43'),
(63, 12, 10, 4, '2022-03-07 16:19:15'),
(64, 12, 10, 6, '2022-03-07 16:20:18'),
(65, 3, 6, 4, '2022-03-07 16:41:56'),
(66, 14, 3, 8, '2022-03-23 13:07:04'),
(67, 14, 4, 36, '2022-03-23 13:07:04'),
(68, 14, 3, 6, '2022-03-23 13:08:11'),
(69, 5, 5, 15, '2022-06-14 13:44:23'),
(70, 5, 5, 24, '2022-06-14 13:44:33'),
(71, 2, 10, 4, '2022-06-20 05:27:10'),
(72, 2, 10, 6, '2022-06-21 04:36:27'),
(73, 17, 4, 6, '2022-06-23 01:45:36'),
(74, 17, 5, 15, '2022-06-23 01:45:36'),
(75, 17, 4, 5, '2022-06-23 01:48:18'),
(76, 17, 4, 7, '2022-06-23 01:48:46'),
(77, 17, 5, 17, '2022-06-26 05:37:17'),
(78, 1, 1, 4, '2022-06-26 12:11:25'),
(79, 1, 2, 6, '2022-06-26 12:11:34'),
(80, 1, 4, 27, '2022-06-26 12:11:43'),
(81, 1, 5, 74, '2022-06-26 12:11:56'),
(82, 1, 6, 7, '2022-06-26 12:12:04'),
(83, 14, 5, 25, '2022-06-26 12:13:19');

-- --------------------------------------------------------

--
-- Table structure for table `tb_faskes`
--

CREATE TABLE `tb_faskes` (
  `id_faskes` int(11) NOT NULL,
  `id_tipe_faskes` int(11) NOT NULL,
  `nama_faskes` varchar(255) NOT NULL,
  `alamat_faskes` varchar(255) NOT NULL,
  `website_faskes` varchar(255) NOT NULL,
  `koordinat_faskes` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_faskes`
--

INSERT INTO `tb_faskes` (`id_faskes`, `id_tipe_faskes`, `nama_faskes`, `alamat_faskes`, `website_faskes`, `koordinat_faskes`, `created_at`, `updated_at`) VALUES
(1, 1, 'RSUD dr. Moewardi', 'Jl. Kolonel Sutarto No.132, Jebres, Kec. Jebres, Kota Surakarta, Jawa Tengah 57126', 'https://rsmoewardi.com/', '-7.558706140256582,110.84220170974733', '2021-09-20 06:34:23', '2022-06-14 04:36:51'),
(2, 6, 'Puskesmas Pajang', 'Jl. Sidoluhur No.29, Pajang, Kec. Laweyan, Kota Surakarta, Jawa Tengah 57146', '', '-7.573211165793956, 110.78921168321612', '2021-09-20 06:34:23', NULL),
(3, 3, 'RSUD Kota Surakarta', 'Jl. Lettu Sumarto No.01, Kedungupit, Kadipiro, Kec. Banjarsari, Kabupaten Boyolali, Jawa Tengah 57375', '', '-7.526229088793672,110.8127551054468', '2021-09-20 06:34:23', NULL),
(4, 6, 'Puskesmas Sibela', 'Jl. Sibela Timur 4 No.1, Mojosongo, Kec. Jebres, Kota Surakarta, Jawa Tengah 57127', '', '-7.536072971872239,110.84589245281768', '2021-09-20 06:34:23', NULL),
(5, 3, 'RS Hermina Surakarta', 'Jl. Kolonel Sutarto No.16, Jebres, Kec. Jebres, Kota Surakarta, Jawa Tengah 57126', 'https://www.herminahospitals.com/id/branch/hermina-solo', '-7.560269571938763,110.84021420564164', '2021-09-21 22:40:34', '2022-06-14 11:11:28'),
(12, 6, 'Puskesmas Banyuanyar', 'Sidomulyo, Jl. Bone Utama, Banyuanyar, Kec. Banjarsari, Kota Surakarta, Jawa Tengah 57137', '', '-7.5333312,110.8037025', '2022-03-07 14:31:50', NULL),
(14, 2, 'RS Dr. Oen Kandang Sapi Solo', 'Jl. Brigjend Katamso No.55, Tegalharjo, Kec. Jebres, Kota Surakarta, Jawa Tengah 57128', 'https://www.droenska.com/', '-7.555393135366458,110.83804964662176', '2022-03-11 09:03:40', '2022-06-14 08:43:26'),
(15, 3, 'RS Panti Waluyo Surakarta', 'Jl. A. Yani No.1, Kerten, Kec. Laweyan, Kota Surakarta, Jawa Tengah 57143', '', '-7.560131309501198,110.79074620605483', '2022-03-14 08:47:29', '2022-03-14 08:49:57'),
(16, 2, 'RS Tri Harsi', 'Jalan Wolter Monginsidi No.82, Gilingan, Kec. Banjarsari, Kota Surakarta, Jawa Tengah 57134', '', '-7.55522828213198,110.82862015838658', '2022-06-21 04:33:55', NULL),
(17, 3, 'RS Sayang Anak', 'JL. Ir Sutami', '', '-7.564784347967655,110.85767929483121', '2022-06-23 01:38:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kapasitas`
--

CREATE TABLE `tb_kapasitas` (
  `id_kapasitas` int(11) NOT NULL,
  `id_faskes` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kapasitas`
--

INSERT INTO `tb_kapasitas` (`id_kapasitas`, `id_faskes`, `id_kelas`, `kapasitas`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 6, '2021-09-20 07:04:07', '2021-09-20 10:16:58'),
(3, 1, 2, 8, '2021-09-20 10:31:09', '2021-09-20 22:24:48'),
(4, 1, 3, 16, '2021-09-20 22:24:38', '2021-10-23 13:26:31'),
(5, 1, 4, 45, '2021-09-20 22:24:38', '2021-09-21 23:49:49'),
(6, 2, 10, 7, '2021-09-20 22:41:38', '2022-06-20 05:26:42'),
(7, 3, 5, 147, '2021-09-22 00:05:49', NULL),
(8, 1, 5, 164, '2021-09-22 22:19:42', '2021-10-23 13:27:59'),
(9, 1, 6, 15, '2021-09-22 23:02:15', NULL),
(10, 3, 4, 39, '2021-11-12 08:04:39', '2022-02-21 05:12:10'),
(11, 3, 6, 5, '2021-11-15 11:29:07', NULL),
(12, 3, 9, 25, '2022-02-24 13:24:17', NULL),
(17, 12, 10, 7, '2022-03-07 14:32:25', NULL),
(18, 14, 3, 25, '2022-03-23 13:04:02', NULL),
(19, 14, 4, 64, '2022-03-23 13:04:02', '2022-03-23 13:04:16'),
(20, 5, 5, 25, '2022-06-14 13:43:04', '2022-06-14 13:43:36'),
(21, 5, 4, 15, '2022-06-14 21:55:28', NULL),
(22, 5, 6, 5, '2022-06-14 21:55:28', NULL),
(23, 4, 10, 10, '2022-06-21 04:35:24', '2022-06-21 04:35:43'),
(24, 17, 5, 23, '2022-06-23 01:39:30', NULL),
(25, 17, 4, 7, '2022-06-23 01:39:30', '2022-06-23 01:39:45'),
(26, 14, 5, 76, '2022-06-26 12:13:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_faskes`
--

CREATE TABLE `tb_kategori_faskes` (
  `id_kategori_faskes` int(11) NOT NULL,
  `kategori_faskes` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kategori_faskes`
--

INSERT INTO `tb_kategori_faskes` (`id_kategori_faskes`, `kategori_faskes`, `created_at`) VALUES
(1, 'Fasilitas Kesehatan Tingkat Pertama', '2021-09-20 06:29:06'),
(2, 'Fasilitas Kesehatan Tingkat Kedua', '2021-09-20 06:29:06'),
(3, 'Fasilitas Kesehatan Tingkat Ketiga', '2021-09-20 06:29:06');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`, `created_at`, `updated_at`) VALUES
(1, 'VVIP', '2021-09-20 06:58:04', NULL),
(2, 'VIP', '2021-09-20 06:58:04', NULL),
(3, 'Kelas I', '2021-09-20 06:58:04', NULL),
(4, 'Kelas II', '2021-09-20 06:58:04', NULL),
(5, 'Kelas III', '2021-09-20 06:58:04', NULL),
(6, 'ICU', '2021-09-20 06:58:04', NULL),
(7, 'PICU', '2021-09-20 06:58:04', NULL),
(8, 'NICU', '2021-09-20 06:58:04', NULL),
(9, 'Ruangan Lainnya', '2021-09-20 06:58:04', NULL),
(10, 'Puskesmas', '2021-09-20 06:58:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_ketersediaan`
--

CREATE TABLE `tb_ketersediaan` (
  `id_ketersediaan` int(11) NOT NULL,
  `id_faskes` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `ketersediaan` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_ketersediaan`
--

INSERT INTO `tb_ketersediaan` (`id_ketersediaan`, `id_faskes`, `id_kelas`, `ketersediaan`, `created_at`, `updated_at`) VALUES
(1, 2, 10, 6, '2021-09-21 22:52:29', '2022-06-21 04:36:27'),
(2, 1, 1, 4, '2021-09-22 00:12:22', '2022-06-26 12:11:25'),
(3, 1, 2, 6, '2021-09-22 00:12:22', '2022-06-26 12:11:34'),
(4, 1, 3, 8, '2021-09-22 00:12:22', '2021-10-23 14:42:53'),
(5, 1, 4, 27, '2021-09-22 00:12:22', '2022-06-26 12:11:43'),
(7, 1, 5, 74, '2021-09-22 23:10:45', '2022-06-26 12:11:56'),
(8, 1, 6, 7, '2021-09-22 23:10:45', '2022-06-26 12:12:04'),
(39, 3, 4, 25, '2022-02-24 13:21:16', NULL),
(40, 3, 5, 40, '2022-02-24 13:21:16', NULL),
(41, 3, 6, 4, '2022-02-24 13:21:16', '2022-03-07 16:41:56'),
(42, 12, 10, 6, '2022-03-07 14:33:32', '2022-03-07 16:20:18'),
(43, 14, 3, 6, '2022-03-23 13:07:04', '2022-03-23 13:08:11'),
(44, 14, 4, 36, '2022-03-23 13:07:04', NULL),
(45, 5, 5, 24, '2022-06-14 13:44:23', '2022-06-14 13:44:33'),
(46, 17, 4, 7, '2022-06-23 01:45:36', '2022-06-23 01:48:46'),
(47, 17, 5, 17, '2022-06-23 01:45:36', '2022-06-26 05:37:17'),
(48, 14, 5, 25, '2022-06-26 12:13:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_faskes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`id_pegawai`, `id_user`, `id_faskes`) VALUES
(1, 2, 1),
(3, 3, 3),
(6, 4, 5),
(4, 5, 4),
(5, 7, 12),
(7, 8, 14),
(8, 13, 15),
(9, 14, 17);

-- --------------------------------------------------------

--
-- Table structure for table `tb_role`
--

CREATE TABLE `tb_role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_role`
--

INSERT INTO `tb_role` (`id_role`, `nama_role`) VALUES
(1, 'Admin'),
(2, 'Pegawai');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tipe_faskes`
--

CREATE TABLE `tb_tipe_faskes` (
  `id_tipe_faskes` int(11) NOT NULL,
  `id_kategori_faskes` int(11) NOT NULL,
  `tipe_faskes` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_tipe_faskes`
--

INSERT INTO `tb_tipe_faskes` (`id_tipe_faskes`, `id_kategori_faskes`, `tipe_faskes`, `created_at`) VALUES
(1, 1, 'Rumah Sakit Tipe A', '2021-09-20 06:30:18'),
(2, 1, 'Rumah Sakit Tipe B', '2021-09-20 06:30:18'),
(3, 2, 'Rumah Sakit Tipe C', '2021-09-20 06:30:18'),
(4, 2, 'Rumah Sakit Tipe D', '2021-09-20 06:30:18'),
(5, 2, 'Rumah Sakit Khusus', '2021-09-20 06:30:18'),
(6, 3, 'Puskesmas', '2021-09-20 06:30:18');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_role` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `id_role`, `created_at`) VALUES
(1, 'admin', '$2y$10$FlqrQQs5KdbcB18XocxgrOR150Xgk.TQ0KCMx/40v8dze083yxSgi', 1, '2021-09-28 03:29:28'),
(2, 'moewardi', '$2y$10$OOjvl//FvrKB/uyOURGZf.exG.PStKd1G1j.e19zdSP1BTav.hSQW', 2, '2021-09-29 08:10:16'),
(3, 'rsud_kota', '$2y$10$D82o6usXBUC30gD39tOfUuN990zGMQSl970BPBR3n3egP2GpkX8DO', 2, '2021-10-25 22:17:51'),
(4, 'hermina', '$2y$10$mjNDhIpiiqJzD0K5OkHo0ug3J5ExBFCJhpGoxwrwsu.F3IVQX/q3q', 2, '2022-02-21 05:08:35'),
(5, 'sibela', '$2y$10$afJfJHEL9nH8P5rgBMTpiO3k6Dqf.fShrDo4T.GLM/19vu5avy1ra', 2, '2022-02-24 14:37:54'),
(7, 'banyuanyar', '$2y$10$vMYdUDk3J2rouTitiFtyxOz6yajlfu1HP/J6ccrA2if8F1ltG2mgu', 2, '2022-03-07 12:55:30'),
(8, 'oenska', '$2y$10$JJbIOTn67P.OAqkzMqTojuNp7PTWlQREdw/19tmPAhT7694OoUYVu', 2, '2022-03-11 09:02:25'),
(10, 'pkusolo', '$2y$10$lI6w1iLAxsO47LVjjwfea.AOwJ9P1Kkv0LwRrdPeFT.RUJwKgBEKC', 2, '2022-06-14 04:22:25'),
(12, 'brayat', '$2y$10$26F2zkP7vye05xVZ2Qp.quCLt61A2s1sGRwv7BOj/La6xQtT6IjFe', 2, '2022-06-21 04:30:05'),
(13, 'waluyo', '$2y$10$72oCJFddY1/Xx..YkFOpT.p4QvUvtN.ddafn0mzuNSBLKtjvkbql6', 2, '2022-06-21 04:31:00'),
(14, 'sayang_anak', '$2y$10$p/xTHkmu2YcjfJHC0ikkn.JbvGDWu5sgVRMozP2N9A03lJEeuPqQ.', 2, '2022-06-23 01:33:22');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_akses`
--

CREATE TABLE `tb_user_akses` (
  `id_user_akses` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user_akses`
--

INSERT INTO `tb_user_akses` (`id_user_akses`, `id_role`, `id_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 2, 6),
(7, 2, 7),
(8, 2, 8),
(9, 2, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_menu`
--

CREATE TABLE `tb_user_menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `uri` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user_menu`
--

INSERT INTO `tb_user_menu` (`id_menu`, `nama_menu`, `url`, `icon`, `uri`) VALUES
(1, 'Dashboard Admin', 'admin', 'fas fa-fw fa-tachometer-alt', 'admin'),
(2, 'Data User', 'admin/users', 'fas fa-fw fa-cog', 'admin'),
(3, 'Data Faskes', 'admin/faskes', 'fas fa-fw fa-hospital', 'admin'),
(4, 'Kapasitas Faskes', 'admin/kapasitas', 'fas fa-fw fa-bed', 'admin'),
(5, 'Ketersediaan Faskes', 'admin/ketersediaan', 'fas fa-fw fa-procedures', 'admin'),
(6, 'Dashboard Pegawai', 'pegawai', 'fas fa-fw fa-tachometer-alt', 'pegawai'),
(7, 'Data Faskes', 'pegawai/faskes', 'fas fa-fw fa-hospital', 'pegawai'),
(8, 'Kapasitas Faskes', 'pegawai/kapasitas', 'fas fa-fw fa-bed', 'pegawai'),
(9, 'Ketersediaan Faskes', 'pegawai/ketersediaan', 'fas fa-fw fa-procedures', 'pegawai');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_kapasitas`
--
ALTER TABLE `log_kapasitas`
  ADD PRIMARY KEY (`id_log_kapasitas`),
  ADD KEY `id_faskes` (`id_faskes`,`id_kelas`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `log_ketersediaan`
--
ALTER TABLE `log_ketersediaan`
  ADD PRIMARY KEY (`id_log_ketersediaan`),
  ADD KEY `id_faskes` (`id_faskes`,`id_kelas`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `tb_faskes`
--
ALTER TABLE `tb_faskes`
  ADD PRIMARY KEY (`id_faskes`),
  ADD KEY `id_tipe_faskes` (`id_tipe_faskes`);

--
-- Indexes for table `tb_kapasitas`
--
ALTER TABLE `tb_kapasitas`
  ADD PRIMARY KEY (`id_kapasitas`),
  ADD KEY `id_faskes` (`id_faskes`,`id_kelas`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `tb_kategori_faskes`
--
ALTER TABLE `tb_kategori_faskes`
  ADD PRIMARY KEY (`id_kategori_faskes`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `tb_ketersediaan`
--
ALTER TABLE `tb_ketersediaan`
  ADD PRIMARY KEY (`id_ketersediaan`),
  ADD KEY `id_faskes` (`id_faskes`,`id_kelas`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `id_user` (`id_user`,`id_faskes`),
  ADD KEY `id_faskes` (`id_faskes`);

--
-- Indexes for table `tb_role`
--
ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `tb_tipe_faskes`
--
ALTER TABLE `tb_tipe_faskes`
  ADD PRIMARY KEY (`id_tipe_faskes`),
  ADD KEY `id_kategori_faskes` (`id_kategori_faskes`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`);

--
-- Indexes for table `tb_user_akses`
--
ALTER TABLE `tb_user_akses`
  ADD PRIMARY KEY (`id_user_akses`),
  ADD KEY `id_role` (`id_role`,`id_menu`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `tb_user_menu`
--
ALTER TABLE `tb_user_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `log_kapasitas`
--
ALTER TABLE `log_kapasitas`
  MODIFY `id_log_kapasitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `log_ketersediaan`
--
ALTER TABLE `log_ketersediaan`
  MODIFY `id_log_ketersediaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `tb_faskes`
--
ALTER TABLE `tb_faskes`
  MODIFY `id_faskes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_kapasitas`
--
ALTER TABLE `tb_kapasitas`
  MODIFY `id_kapasitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_kategori_faskes`
--
ALTER TABLE `tb_kategori_faskes`
  MODIFY `id_kategori_faskes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_ketersediaan`
--
ALTER TABLE `tb_ketersediaan`
  MODIFY `id_ketersediaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_tipe_faskes`
--
ALTER TABLE `tb_tipe_faskes`
  MODIFY `id_tipe_faskes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_user_akses`
--
ALTER TABLE `tb_user_akses`
  MODIFY `id_user_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_user_menu`
--
ALTER TABLE `tb_user_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `log_kapasitas`
--
ALTER TABLE `log_kapasitas`
  ADD CONSTRAINT `log_kapasitas_ibfk_1` FOREIGN KEY (`id_faskes`) REFERENCES `tb_faskes` (`id_faskes`),
  ADD CONSTRAINT `log_kapasitas_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`);

--
-- Constraints for table `log_ketersediaan`
--
ALTER TABLE `log_ketersediaan`
  ADD CONSTRAINT `log_ketersediaan_ibfk_1` FOREIGN KEY (`id_faskes`) REFERENCES `tb_faskes` (`id_faskes`),
  ADD CONSTRAINT `log_ketersediaan_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`);

--
-- Constraints for table `tb_faskes`
--
ALTER TABLE `tb_faskes`
  ADD CONSTRAINT `tb_faskes_ibfk_1` FOREIGN KEY (`id_tipe_faskes`) REFERENCES `tb_tipe_faskes` (`id_tipe_faskes`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_kapasitas`
--
ALTER TABLE `tb_kapasitas`
  ADD CONSTRAINT `tb_kapasitas_ibfk_1` FOREIGN KEY (`id_faskes`) REFERENCES `tb_faskes` (`id_faskes`),
  ADD CONSTRAINT `tb_kapasitas_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`);

--
-- Constraints for table `tb_ketersediaan`
--
ALTER TABLE `tb_ketersediaan`
  ADD CONSTRAINT `tb_ketersediaan_ibfk_1` FOREIGN KEY (`id_faskes`) REFERENCES `tb_faskes` (`id_faskes`),
  ADD CONSTRAINT `tb_ketersediaan_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`);

--
-- Constraints for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD CONSTRAINT `tb_pegawai_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`),
  ADD CONSTRAINT `tb_pegawai_ibfk_2` FOREIGN KEY (`id_faskes`) REFERENCES `tb_faskes` (`id_faskes`);

--
-- Constraints for table `tb_tipe_faskes`
--
ALTER TABLE `tb_tipe_faskes`
  ADD CONSTRAINT `tb_tipe_faskes_ibfk_1` FOREIGN KEY (`id_kategori_faskes`) REFERENCES `tb_kategori_faskes` (`id_kategori_faskes`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `tb_role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_user_akses`
--
ALTER TABLE `tb_user_akses`
  ADD CONSTRAINT `tb_user_akses_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `tb_role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_user_akses_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `tb_user_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
