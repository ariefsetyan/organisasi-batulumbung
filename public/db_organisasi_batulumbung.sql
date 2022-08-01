-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2022 at 01:33 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_organisasi_batulumbung`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `organisasi_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `user_id`, `organisasi_id`, `nama`, `nama_kegiatan`, `tanggal`, `status`, `is_label`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'Ni Kadek Lia Mastika', 'Jalan Santai', '2022-06-15', 'Hadir', 't', '2022-07-19 21:28:17', '2022-07-19 21:29:27'),
(2, 6, 1, 'I Putu Febry Masprayoga', 'Jalan Santai', '2022-06-15', 'Hadir', 't', '2022-07-19 21:28:17', '2022-07-19 21:29:27'),
(3, 7, 1, 'I Putu Ferdinata', 'Jalan Santai', '2022-06-15', 'Hadir', 't', '2022-07-19 21:28:17', '2022-07-19 21:29:27'),
(4, 8, 1, 'Komang Dody Darmawan', 'Jalan Santai', '2022-06-15', 'Hadir', 't', '2022-07-19 21:28:17', '2022-07-19 21:29:27'),
(5, 9, 1, 'Ni Putu Dian Sariasih', 'Jalan Santai', '2022-06-15', 'Tidak Hadir', 't', '2022-07-19 21:28:17', '2022-07-19 21:29:27'),
(6, 10, 1, 'Ni Putu Indah Ariandini', 'Jalan Santai', '2022-06-15', 'Hadir', 't', '2022-07-19 21:28:17', '2022-07-19 21:29:27'),
(7, 11, 1, 'Ni Putu Jessica Tania Wulandari', 'Jalan Santai', '2022-06-15', 'Hadir', 't', '2022-07-19 21:28:17', '2022-07-19 21:29:27'),
(8, 12, 1, 'I Made Ari Purnama Putra', 'Jalan Santai', '2022-06-15', 'Tidak Hadir', 't', '2022-07-19 21:28:17', '2022-07-19 21:29:27'),
(9, 13, 1, 'Ni Putu Lusyadewi', 'Jalan Santai', '2022-06-15', 'Hadir', 't', '2022-07-19 21:28:17', '2022-07-19 21:29:27'),
(10, 14, 1, 'Ni Kadek Anggun Sasmita', 'Jalan Santai', '2022-06-15', 'Hadir', 't', '2022-07-19 21:28:17', '2022-07-19 21:29:27'),
(11, 21, 1, 'Ketut Yogi Hartadana', 'Jalan Santai', '2022-06-15', 'Tidak Hadir', 't', '2022-07-19 21:28:17', '2022-07-19 21:29:27'),
(12, 25, 1, 'I Putu Kardiana', 'Jalan Santai', '2022-06-15', 'Tidak Hadir', 't', '2022-07-19 21:28:17', '2022-07-19 21:29:27'),
(13, 5, 1, 'Ni Kadek Lia Mastika', 'Tirta Yatra', '2022-07-01', 'Hadir', 't', '2022-07-19 21:29:27', '2022-07-19 21:57:24'),
(14, 6, 1, 'I Putu Febry Masprayoga', 'Tirta Yatra', '2022-07-01', 'Tidak Hadir', 't', '2022-07-19 21:29:27', '2022-07-19 21:57:24'),
(15, 7, 1, 'I Putu Ferdinata', 'Tirta Yatra', '2022-07-01', 'Hadir', 't', '2022-07-19 21:29:27', '2022-07-19 21:57:24'),
(16, 8, 1, 'Komang Dody Darmawan', 'Tirta Yatra', '2022-07-01', 'Hadir', 't', '2022-07-19 21:29:27', '2022-07-19 21:57:24'),
(17, 9, 1, 'Ni Putu Dian Sariasih', 'Tirta Yatra', '2022-07-01', 'Hadir', 't', '2022-07-19 21:29:27', '2022-07-19 21:57:24'),
(18, 10, 1, 'Ni Putu Indah Ariandini', 'Tirta Yatra', '2022-07-01', 'Tidak Hadir', 't', '2022-07-19 21:29:27', '2022-07-19 21:57:24'),
(19, 11, 1, 'Ni Putu Jessica Tania Wulandari', 'Tirta Yatra', '2022-07-01', 'Tidak Hadir', 't', '2022-07-19 21:29:27', '2022-07-19 21:57:24'),
(20, 12, 1, 'I Made Ari Purnama Putra', 'Tirta Yatra', '2022-07-01', 'Hadir', 't', '2022-07-19 21:29:27', '2022-07-19 21:57:24'),
(21, 13, 1, 'Ni Putu Lusyadewi', 'Tirta Yatra', '2022-07-01', 'Hadir', 't', '2022-07-19 21:29:27', '2022-07-19 21:57:24'),
(22, 14, 1, 'Ni Kadek Anggun Sasmita', 'Tirta Yatra', '2022-07-01', 'Hadir', 't', '2022-07-19 21:29:27', '2022-07-19 21:57:24'),
(23, 21, 1, 'Ketut Yogi Hartadana', 'Tirta Yatra', '2022-07-01', 'Hadir', 't', '2022-07-19 21:29:27', '2022-07-19 21:57:24'),
(24, 25, 1, 'I Putu Kardiana', 'Tirta Yatra', '2022-07-01', 'Hadir', 't', '2022-07-19 21:29:27', '2022-07-19 21:57:24');

-- --------------------------------------------------------

--
-- Table structure for table `detail_user`
--

CREATE TABLE `detail_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `organisasi_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_user`
--

INSERT INTO `detail_user` (`id`, `user_id`, `organisasi_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1', '2022-07-19 20:25:20', '2022-07-19 20:25:20'),
(2, 2, 2, '1', '2022-07-19 20:25:20', '2022-07-19 20:25:20'),
(3, 3, 3, '1', '2022-07-19 20:25:20', '2022-07-19 20:25:20'),
(4, 4, 4, '1', '2022-07-19 20:25:20', '2022-07-19 20:25:20'),
(5, 5, 1, '1', '2022-07-19 20:28:12', '2022-07-19 20:28:12'),
(6, 6, 1, '1', '2022-07-19 20:29:09', '2022-07-19 20:29:09'),
(7, 7, 1, '1', '2022-07-19 20:30:07', '2022-07-19 20:30:07'),
(8, 8, 1, '1', '2022-07-19 20:31:43', '2022-07-19 20:31:43'),
(9, 8, 2, '1', '2022-07-19 20:31:43', '2022-07-19 20:31:43'),
(10, 9, 1, '1', '2022-07-19 20:32:48', '2022-07-19 20:32:48'),
(11, 10, 1, '1', '2022-07-19 20:33:54', '2022-07-19 20:33:54'),
(12, 11, 1, '1', '2022-07-19 20:35:01', '2022-07-19 20:35:01'),
(13, 12, 1, '1', '2022-07-19 20:36:13', '2022-07-19 20:36:13'),
(14, 13, 1, '1', '2022-07-19 20:37:16', '2022-07-19 20:37:16'),
(15, 14, 1, '0', '2022-07-19 20:38:22', '2022-07-19 20:38:22'),
(16, 15, 3, '0', '2022-07-19 20:40:36', '2022-07-19 20:40:36'),
(17, 15, 4, '1', '2022-07-19 20:40:36', '2022-07-19 20:40:36'),
(18, 16, 3, '0', '2022-07-19 20:41:46', '2022-07-19 20:41:46'),
(19, 16, 4, '1', '2022-07-19 20:41:46', '2022-07-19 20:41:46'),
(20, 17, 3, '0', '2022-07-19 20:42:46', '2022-07-19 20:42:46'),
(21, 17, 4, '1', '2022-07-19 20:42:46', '2022-07-19 20:42:46'),
(22, 18, 4, '1', '2022-07-19 20:43:58', '2022-07-19 20:43:58'),
(23, 19, 4, '1', '2022-07-19 20:44:51', '2022-07-19 20:44:51'),
(24, 20, 3, '0', '2022-07-19 20:46:18', '2022-07-19 20:46:18'),
(25, 20, 4, '1', '2022-07-19 20:46:18', '2022-07-19 20:46:18'),
(26, 21, 1, '1', '2022-07-19 20:47:22', '2022-07-19 20:47:22'),
(27, 21, 2, '1', '2022-07-19 20:47:22', '2022-07-19 20:47:22'),
(28, 22, 2, '1', '2022-07-19 20:49:02', '2022-07-19 20:49:02'),
(29, 23, 2, '1', '2022-07-19 20:49:54', '2022-07-19 20:49:54'),
(30, 24, 2, '1', '2022-07-19 20:51:19', '2022-07-19 20:51:19'),
(31, 25, 1, '0', '2022-07-19 20:55:23', '2022-07-19 20:55:23'),
(32, 25, 2, '1', '2022-07-19 20:55:23', '2022-07-19 20:55:23'),
(33, 26, 2, '1', '2022-07-19 20:56:25', '2022-07-19 20:56:25'),
(34, 27, 2, '0', '2022-07-19 20:58:11', '2022-07-19 20:58:11'),
(35, 28, 4, '0', '2022-07-19 20:59:13', '2022-07-19 20:59:13'),
(36, 29, 4, '0', '2022-07-19 21:00:45', '2022-07-19 21:00:45'),
(37, 30, 1, '1', '2022-07-19 21:12:50', '2022-07-19 21:12:50');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organisasi_id` bigint(20) UNSIGNED NOT NULL,
  `nama_event` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `tempat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `organisasi_id`, `nama_event`, `tanggal`, `waktu`, `tempat`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ulang Tahun Sekaa Teruna Ke-42', '2022-08-20', '17:00:00', 'Bale Banjar Batulumbung', 'Memperingati dan memeriahkan Hari Ulang Tahun Sekaa Teruna Cila Yowana yang ke-42', '2022-07-19 21:13:51', '2022-07-19 21:13:51'),
(2, 1, 'Turnamen Futsal', '2022-07-29', '18:00:00', 'Bale Banjar Batulumbung', 'Turnamen Futsal antar Sekaa Teruna Desa Adat Gulingan', '2022-07-19 21:15:18', '2022-07-19 21:15:18'),
(3, 2, 'Ulang Tahun Sekaa Teruna Ke-42', '2022-08-20', '18:00:00', 'Bale Banjar Batulumbung', 'Memperingati dan memeriahkan Hari Ulang Tahun Sekaa Teruna Cila Yowana yang ke-42', '2022-07-19 21:37:40', '2022-07-19 21:37:40'),
(4, 2, 'Latihan Tabuh Tari Sekar Jepun', '2022-07-27', '19:00:00', 'Bale Banjar Batulumbung', 'Latihan tabuh sekar jepun untuk HUT Sekaa Teruna Cila Yowana', '2022-07-19 21:38:34', '2022-07-19 21:38:34'),
(5, 4, 'Gotong Royong', '2022-08-06', '16:00:00', 'Bale Banjar Batulumbung', 'Kegiatan rutin PKK, gotong royong di area banjar batulumbung', '2022-07-19 22:10:59', '2022-07-19 22:10:59');

-- --------------------------------------------------------

--
-- Table structure for table `excel_absensi`
--

CREATE TABLE `excel_absensi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organisasi_id` bigint(20) UNSIGNED NOT NULL,
  `nama_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `tempat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `organisasi_id`, `nama_kegiatan`, `tanggal`, `waktu`, `tempat`, `deskripsi`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Jalan Santai', '2022-06-15', '07:00:00', 'Bale Banjar Batulumbung', '<p>Kegiatan jalan santai dilaksanakan oleh Sekaa Teruna Cila Yowana dalam rangka akhir bulan</p>', '1658294298.jpg', '2022-07-19 21:18:18', '2022-07-19 21:18:18'),
(2, 1, 'Tirta Yatra', '2022-07-01', '08:00:00', 'Pura Rambut Siwi', '<p>Program kerja Sekaa Teruna Cila Yowana yaitu Tirta Yatra ke Pura Rambut Siwi diikuti oleh anggota dan pembina Sekaa Teruna Cila Yowana</p>', '1658294489.jpg', '2022-07-19 21:21:29', '2022-07-19 21:21:29'),
(3, 2, 'Lomba Tabuh Baleganjur', '2022-06-15', '17:00:00', 'Art Center', '<p>Lomba Baleganjur di Art Center dalam rangka memeriahkan Pesta Kesenian Bali</p>', '1658295771.jpg', '2022-07-19 21:42:51', '2022-07-19 21:42:51'),
(4, 2, 'Pelantikan Pengurus Baru', '2022-05-25', '18:00:00', 'Bale Banjar Batulumbung', '<p>Sekaa Gong Gili Kusuma ikut berpartisipasi dalam rangka pelantikan pengurus baru Sekaa Teruna Cila Yowana</p>', '1658295883.jpg', '2022-07-19 21:44:43', '2022-07-19 21:44:43'),
(5, 3, 'Ngayah Mekidung di Pura', '2022-06-29', '18:00:00', 'Pura Dalem Batulumbung', '<p>Ngayah mekidung di pura Dalem Batulumbung</p>', '1658297142.jpg', '2022-07-19 22:05:42', '2022-07-19 22:05:42'),
(6, 4, 'Ngayah membuat banten', '2022-06-26', '08:00:00', 'Bale Banjar Batulumbung', '<p>Ngayah membuat banten dalam rangka odalan</p>', '1658297280.jpg', '2022-07-19 22:08:00', '2022-07-19 22:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_keuangan`
--

CREATE TABLE `laporan_keuangan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `organisasi_id` bigint(20) UNSIGNED NOT NULL,
  `jmlh_pemasukan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jmlh_pengeluaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `sumber_dana` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga_satuan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_10_02_054432_create_kegiatan_table', 1),
(6, '2021_10_02_054651_create_organisasi_table', 1),
(7, '2021_10_02_054835_create_pengumuman_table', 1),
(8, '2021_10_02_055048_create_absensi_table', 1),
(9, '2021_10_22_132019_create_laporan_keuangan_table', 1),
(10, '2022_03_12_031525_create_event_table', 1),
(11, '2022_03_14_120814_create_excel_absensi_table', 1),
(12, '2022_03_20_161313_create_pemasukan_table', 1),
(13, '2022_03_20_162308_create_pengeluaran_table', 1),
(14, '2022_04_11_094538_create_detail_user_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `organisasi`
--

CREATE TABLE `organisasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organisasi`
--

INSERT INTO `organisasi` (`id`, `kode`, `jenis`, `created_at`, `updated_at`) VALUES
(1, 'ST', 'Sekaa Teruna', '2022-07-19 20:25:20', '2022-07-19 20:25:20'),
(2, 'SG', 'Sekaa Gong', '2022-07-19 20:25:20', '2022-07-19 20:25:20'),
(3, 'SS', 'Sekaa Santi', '2022-07-19 20:25:20', '2022-07-19 20:25:20'),
(4, 'PKK', 'PKK', '2022-07-19 20:25:20', '2022-07-19 20:25:20');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organisasi_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `jmlh_pemasukan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `sumber_dana` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemasukan`
--

INSERT INTO `pemasukan` (`id`, `organisasi_id`, `user_id`, `jmlh_pemasukan`, `tanggal`, `sumber_dana`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1000000', '2022-07-01', 'Bantuan APBDes 2022', 'Bantuan Tunai dari Desa kepada Sekaa Teruna', '2022-07-20 05:30:27', '2022-07-20 05:30:27'),
(3, 2, 2, '500000', '2022-07-13', 'Iuran', 'Iuran Anggota', '2022-07-20 05:55:39', '2022-07-20 05:55:39');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organisasi_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jmlh_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan_harga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sumber_dana` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id`, `organisasi_id`, `user_id`, `total`, `tanggal`, `nama_barang`, `jmlh_barang`, `satuan_harga`, `sumber_dana`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '12000', '2022-07-16', 'Print', '10', '1000', 'Bantuan APBDes 2022', 'Pembuatan proposal kegiatan ulang tahun sekaa teruna', '2022-07-20 05:31:56', '2022-07-20 05:31:56'),
(3, 1, 1, '10000', '2022-07-18', 'Buku', '2', '5000', 'Bantuan APBDes 2022', 'Inventaris', '2022-07-20 05:33:37', '2022-07-20 05:33:37'),
(4, 2, 2, '80000', '2022-07-18', 'Snack Kotak', '10', '8000', 'Iuran', 'Konsumsi Latihan', '2022-07-20 05:56:15', '2022-07-20 05:56:15');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organisasi_id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `organisasi_id`, `judul`, `tanggal`, `waktu`, `isi`, `file`, `created_at`, `updated_at`) VALUES
(1, 1, 'Rapat Anggota', '2022-07-31', '18:00:00', 'Dalam rangka memperingati dan memeriahkan Hari Ulang Tahun Sekaa Teruna Cila Yowana yang ke-42', '1902071982laporan-kegiatan.pdf', '2022-07-19 21:22:31', '2022-07-19 21:22:31'),
(2, 1, 'Turnamen Futsal', '2022-07-29', '17:00:00', 'Diumumkan kepada seluruh anggota Sekaa Teruna Cila Yowana agar ikut meramaikan kegiatan Turnamen Futsal yang akan diadakan di Lapangan Agung Futsal', '1887319894823181847545595982Form_Permohonan_Surat_Survey (1).pdf', '2022-07-19 21:24:11', '2022-07-19 21:24:11'),
(3, 2, 'Latihan Tabuh Baleganjur', '2022-08-03', '18:00:00', 'Latihan tabuh baleganjur di Bale Banjar Batulumbung', '208992346pengeluaran.pdf', '2022-07-19 21:45:46', '2022-07-19 21:45:46'),
(4, 4, 'Rapat Anggota', '2022-08-02', '18:00:00', 'Rapat Bulanan Anggota di Bale Banjar Batulumbung', '1855592704pengeluaran.pdf', '2022-07-19 22:09:20', '2022-07-19 22:09:20');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `nik`, `tempat_lahir`, `tgl_lahir`, `email`, `password`, `no_telp`, `jenis_kelamin`, `pekerjaan`, `alamat`, `level`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ni Putu Windi Masyundari', '5103026908200005', 'Denpasar', '2000-08-29', 'windimasyundarii@gmail.com', '$2y$10$rkV7nV9Up61GABckedF9kOkL3aezsQ4/k07Qo6v8wm6nGWRom5hcm', '085872300219', 'Perempuan', 'Mahasiswa', 'Br. Batulumbung, Gulingan', 'Sekretaris', '1', NULL, '2022-07-19 20:25:20', '2022-07-19 20:25:20'),
(2, 'I Gede Oka Suastina', '5103023107020002', 'Badung', '2002-07-31', 'okasuastina@gmail.com', '$2y$10$hfOet3pr1pwAOgdA6T2w7exQ3EBGVvi2PAyqO2ycdYB6ZAeUT4T5C', '08587221219', 'Laki-Laki', 'Mahasiswa', 'Br. Batulumbung, Gulingan', 'Ketua', '1', NULL, '2022-07-19 20:25:20', '2022-07-19 20:25:20'),
(3, 'Ni Nyoman Rai Wiryani', '5103024211700001', 'Gulingan', '1970-11-02', 'wiryani@gmail.com', '$2y$10$sFvRxPuWXMMIU915uxZMp.9fHRL.n5bK65UmH3Vd0y7sx1YWc38N.', '081678098988', 'Perempuan', 'Pegawai Swasta', 'Br. Batulumbung, Gulingan', 'Ketua', '1', NULL, '2022-07-19 20:25:20', '2022-07-19 20:25:20'),
(4, 'Ni Luh Sri Artini', '5103025610770001', 'Penyaringan', '1977-10-16', 'sriartini@gmail.com', '$2y$10$rluH2pYSQ67zQdaAaYW/8uVRQvUbcJBF3ZMemNdq8Gkr9h/GVscju', '085872300119', 'Perempuan', 'Pegawai Swasta', 'Br. Batulumbung, Gulingan', 'Ketua', '1', NULL, '2022-07-19 20:25:20', '2022-07-19 20:25:20'),
(5, 'Ni Kadek Lia Mastika Dewi', '5103024301050001', 'Denpasar', '2005-01-03', 'liamastika@gmail.com', '$2y$10$.qJCGGi/x0KOrhFH08MP2uBKUs.xiX1T7oDYYO35TP/35VMC6Gx5q', '085874567092', 'Perempuan', 'Pelajar', 'Br. Batulumbung, Gulingan', 'Anggota', '1', NULL, '2022-07-19 20:28:12', '2022-07-19 20:28:12'),
(6, 'I Putu Febry Masprayoga', '5103020802010005', 'Denpasar', '2001-02-08', 'febrymasprayoga@gmail.com', '$2y$10$vD8RD2Uo6UrDvNcZIUzmlOdvdZPnVuwmAK/0Wa24pgeLbvkDdmIgK', '087453291889', 'Laki-Laki', 'Mahasiswa', 'Br. Batulumbung, Gulingan', 'Anggota', '1', NULL, '2022-07-19 20:29:09', '2022-07-19 20:29:09'),
(7, 'I Putu Ferdinata', '5103021502020011', 'Gulingan', '2002-02-15', 'ferdinata@gmail.com', '$2y$10$Kk43j/FMFFMadZzsZB44rutE9eoG6y9vHYGqlZkthjv92jFobnia6', '085874567092', 'Laki-Laki', 'Pegawai Swasta', 'Br. Batulumbung, Gulingan', 'Anggota', '1', NULL, '2022-07-19 20:30:07', '2022-07-19 20:30:07'),
(8, 'Komang Dody Darmawan', '5103022207000004', 'Mengwi', '2000-07-22', 'dodydarmawan@gmail.com', '$2y$10$84NLwE54gAX655sXXjxyiebOr6uE8ByCt2aIfpm1QSNlLLd.Kzbh2', '081998227387', 'Laki-Laki', 'Mahasiswa', 'Br. Batulumbung, Gulingan', 'Anggota', '1', NULL, '2022-07-19 20:31:43', '2022-07-19 20:31:43'),
(9, 'Ni Putu Dian Sariasih', '5103026502000001', 'Denpasar', '2000-02-25', 'diansariasih@gmail.com', '$2y$10$dNzmDgLXSyZ6jk0UlNPB/.W0ZCWy.I6jO7M5klqchqAlND8zlYLOm', '085874567082', 'Perempuan', 'Pegawai Swasta', 'Br. Batulumbung, Gulingan', 'Anggota', '1', NULL, '2022-07-19 20:32:48', '2022-07-19 20:32:48'),
(10, 'Ni Putu Indah Ariandini', '5103025901000009', 'Denpasar', '2000-01-19', 'indahariandini@gmail.com', '$2y$10$Sfi7Xe30ABRjKjXr02fjl.XGVBRh.78uoiXuyjfiXMHfiJlkPZLGS', '085874567082', 'Perempuan', 'Pegawai Swasta', 'Br. Batulumbung, Gulingan', 'Anggota', '1', NULL, '2022-07-19 20:33:54', '2022-07-19 20:33:54'),
(11, 'Ni Putu Jessica Tania Wulandari', '5103026105000007', 'Denpasar', '2000-05-21', 'jessicatania@gmail.com', '$2y$10$rKNtQgqM.pGGnzbuLnAU8.UHknmknX7.t1A53/3uZ42SWn9tivuOm', '085874567082', 'Perempuan', 'Mahasiswa', 'Br. Batulumbung, Gulingan', 'Anggota', '1', NULL, '2022-07-19 20:35:01', '2022-07-19 20:35:01'),
(12, 'I Made Ari Purnama Putra', '5103021804000005', 'Badung', '2000-04-18', 'aripurnama@gmail.com', '$2y$10$EjbdABx7bkk36HqIa7vHqOxeFhMp5S5RHLZQt1r9DyjJBN.P9YzS.', '0850988852667', 'Laki-Laki', 'Mahasiswa', 'Br. Batulumbung, Gulingan', 'Anggota', '1', NULL, '2022-07-19 20:36:13', '2022-07-19 20:36:13'),
(13, 'Ni Putu Lusyadewi', '5103024103000013', 'Denpasar', '2000-03-01', 'lusyadewi@gmail.com', '$2y$10$fz88yJXYOlUV7.VIFRIIMeAhuEABIgOwimtZLeTcY1MM3E/RmCBCa', '081998227387', 'Perempuan', 'Mahasiswa', 'Br. Batulumbung, Gulingan', 'Anggota', '1', NULL, '2022-07-19 20:37:16', '2022-07-19 20:37:16'),
(14, 'Ni Kadek Anggun Sasmita', '5103025307050006', 'Mengwi', '2005-07-13', 'anggunsasmita@gmail.com', '$2y$10$N4W2szu0GtK09Rl6tFx6U.jc/kNs/xgj9Mqc9psTfHQoUH.CQpcTq', '085874567092', 'Perempuan', 'Pelajar', 'Br. Batulumbung, Gulingan', 'Anggota', '0', NULL, '2022-07-19 20:38:22', '2022-07-19 20:38:22'),
(15, 'Ni Made Mertini', '5103024808830004', 'Gulingan', '1983-08-08', 'mertini@gmail.com', '$2y$10$XLhXaKUPvILy50T/17QBferE4Y/kS02m6uxkUgWEzfeW5O45Mq0rC', '081998227387', 'Perempuan', 'Pegawai Swasta', 'Br. Batulumbung, Gulingan', 'Anggota', '1', NULL, '2022-07-19 20:40:36', '2022-07-19 20:40:36'),
(16, 'Ni Nyoman Yatiani', '5103024705700008', 'Gulingan', '1973-05-07', 'yatiani@gmail.com', '$2y$10$bItDn7c1f7/fQO9QnvK5l.vb8Wtdk2D4vSTsvlP0x2sH4a7CFT1.y', '087652980129', 'Perempuan', 'Pegawai Swasta', 'Br. Batulumbung, Gulingan', 'Anggota', '1', NULL, '2022-07-19 20:41:46', '2022-07-19 20:41:46'),
(17, 'Ni Nyoman Astini', '5103025906800007', 'Badung', '1980-06-19', 'astini@gmail.com', '$2y$10$EVM1ocPZ3NFruZO1GG7oXuoArarFVZsP/pXJF1a6hwBHq2VlA82oG', '0850988852667', 'Perempuan', 'Pegawai Swasta', 'Br. Batulumbung, Gulingan', 'Anggota', '1', NULL, '2022-07-19 20:42:46', '2022-07-19 20:42:46'),
(18, 'Ni Ketut Sugiantari', '5103026209780004', 'Negara', '1978-09-22', 'sugiantari@gmail.com', '$2y$10$QMOJK2ZPiH5T1OhFP5vyQeKJIRxqYXMn.GlYSRpKzGfzXUpAxvDjG', '087652980129', 'Perempuan', 'Pegawai Swasta', 'Br. Batulumbung, Gulingan', 'Anggota', '1', NULL, '2022-07-19 20:43:58', '2022-07-19 20:43:58'),
(19, 'Ni Made Mertasih', '5103026708750008', 'Ekasari', '1975-08-27', 'mertasih@gmail.coom', '$2y$10$7SB2wtBDIJbhPqmPxKUP5OLsmig8ldvRy3baC0ws6X38x0L0/yb6e', '085874567092', 'Perempuan', 'Pegawai Swasta', 'Br. Batulumbung, Gulingan', 'Anggota', '1', NULL, '2022-07-19 20:44:51', '2022-07-19 20:44:51'),
(20, 'Ni Nyoman Kartini', '5103026705720003', 'Badung', '1972-05-27', 'kartini@gmail.com', '$2y$10$Pgz1YZTRNdrJGLxLr58n3.8iJNTNv.uAkrTBOEXd19F5U4cAqUvEC', '085233476566', 'Perempuan', 'PNS', 'Br. Batulumbung, Gulingan', 'Anggota', '1', NULL, '2022-07-19 20:46:18', '2022-07-19 20:46:18'),
(21, 'Ketut Yogi Hartadana', '5103022803970006', 'Gulingan', '1997-03-28', 'yogihartadana@gmail.com', '$2y$10$YFpFr6x1jnCsDTmxtGk1GutL8ChthllBI.mv1CC8kKOLqG7KBFaae', '085195852667', 'Laki-Laki', 'Pegawai Swasta', 'Br. Batulumbung, Gulingan', 'Anggota', '1', NULL, '2022-07-19 20:47:22', '2022-07-19 20:47:22'),
(22, 'I Wayan Sukarma', '5103020412740002', 'Badung', '1974-12-04', 'sukarma@gmail.com', '$2y$10$c/Raxm9jEuQpGEhPYyzvle6Vbu84ePPrVNjzGOkNAPRIgbka0tAPa', '085782239002', 'Laki-Laki', 'Pegawai Swasta', 'Br. Batulumbung, Gulingan', 'Anggota', '1', NULL, '2022-07-19 20:49:02', '2022-07-19 20:49:02'),
(23, 'I Wayan Suardana', '5103020201760008', 'Badung', '1976-01-02', 'suardana@gmail.com', '$2y$10$M2TavJA5XE7Relkz2eIa/OG7akjFt6P7g2jiIkqKPbvDZR1.wlEVS', '087652980129', 'Laki-Laki', 'Pegawai Swasta', 'Br. Batulumbung, Gulingan', 'Anggota', '1', NULL, '2022-07-19 20:49:54', '2022-07-19 20:49:54'),
(24, 'I Nyoman Okayana', '5103021601710004', 'Mengwi', '1971-01-16', 'okayana@gmail.com', '$2y$10$4U7mY3gcTYErnyebJhQyY.gI44otBmUo6lq6Q..Wy9a3Ri2L8dUc6', '081998227387', 'Laki-Laki', 'Pegawai Swasta', 'Br. Batulumbung, Gulingan', 'Anggota', '1', NULL, '2022-07-19 20:51:19', '2022-07-19 20:51:19'),
(25, 'I Putu Kardiana', '5103020505030004', 'Badung', '2003-05-05', 'kardiana@gmail.com', '$2y$10$wX6XfBg6L2Q9mkND1TYxO.VL39wSggzWrL7O906XdRmAOASohI2Ey', '085874567082', 'Laki-Laki', 'Pegawai Swasta', 'Br. Batulumbung, Gulingan', 'Anggota', '1', NULL, '2022-07-19 20:55:23', '2022-07-19 20:55:23'),
(26, 'I Made Karnawa', '5103020605710004', 'Mengwi', '1971-05-06', 'karnawa@gmail.com', '$2y$10$HJ3cuTPirGIgnjbPR6bK8.zPJXx4xDxpJZlS6/8uf1fCHnNikdggO', '087652980129', 'Laki-Laki', 'PNS', 'Br. Batulumbung, Gulingan', 'Anggota', '1', NULL, '2022-07-19 20:56:25', '2022-07-19 20:56:25'),
(27, 'I Nyoman Suwitra', '5103022811940008', 'Badung', '1994-11-28', 'suwitra@gmail.com', '$2y$10$c1RjOzLGhiIRWVaSTzqlJeMNLvQTB0AA9oSNiQQXkyIkjFvWa4Jhq', '087652980129', 'Laki-Laki', 'Pegawai Swasta', 'Br. Batulumbung, Gulingan', 'Anggota', '0', NULL, '2022-07-19 20:58:11', '2022-07-19 20:58:11'),
(28, 'Ni Luh Putu Yeni Indiameta', '5103025310010004', 'Badung', '2001-10-31', 'yeniindiameta@gmail.com', '$2y$10$IZwpwv4Ws/LakxM5I9XXuu7emeDKpcUxVBgG/eURSYg/2CdaAIfDe', '085874567082', 'Perempuan', 'Pegawai Swasta', 'Br. Batulumbung, Gulingan', 'Anggota', '0', NULL, '2022-07-19 20:59:13', '2022-07-19 20:59:13'),
(29, 'Ni Kadek Yanti Gangga Yundari', '5103024509910002', 'Badung', '1991-09-05', 'yantigangga@gmail.com', '$2y$10$6lr71CC6GUZqVe1XzD.4/uLJQGFgdRAsSU9XQb.cghBpKBEvg2tj2', '085874567082', 'Perempuan', 'Pegawai Swasta', 'Br. Batulumbung, Gulingan', 'Anggota', '0', NULL, '2022-07-19 21:00:45', '2022-07-19 21:00:45'),
(30, 'I Kadek Rastu Devani', '5103020207980006', 'Badung', '1998-07-02', 'rastudevani@gmail.com', '$2y$10$8wnTZeIghdUf/LkPdyjK6e/rewJHntKcagmuB6tXl8qzwpzp6fkDu', '081998227387', 'Laki-Laki', 'Pegawai Swasta', 'Br. Batulumbung, Gulingan', 'Ketua', '1', NULL, '2022-07-19 21:12:50', '2022-07-19 21:12:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_user`
--
ALTER TABLE `detail_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `excel_absensi`
--
ALTER TABLE `excel_absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_keuangan`
--
ALTER TABLE `laporan_keuangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organisasi`
--
ALTER TABLE `organisasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_nik_unique` (`nik`),
  ADD UNIQUE KEY `user_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `detail_user`
--
ALTER TABLE `detail_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `excel_absensi`
--
ALTER TABLE `excel_absensi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `laporan_keuangan`
--
ALTER TABLE `laporan_keuangan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `organisasi`
--
ALTER TABLE `organisasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
