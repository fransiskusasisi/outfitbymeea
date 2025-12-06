-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2025 at 04:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stok_gudang`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(150) NOT NULL,
  `kode_barang` varchar(255) DEFAULT NULL,
  `kategori_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ukuran` varchar(50) DEFAULT NULL,
  `kondisi` enum('baru','bekas bagus','bekas sedang') NOT NULL DEFAULT 'baru',
  `stok` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`barang_id`, `nama_barang`, `kode_barang`, `kategori_id`, `ukuran`, `kondisi`, `stok`, `created_at`, `updated_at`) VALUES
(3, 'kemeja  Putih', '14', 5, 'S', 'bekas sedang', 4, '2025-11-12 03:06:52', '2025-11-20 17:32:22'),
(4, 'Baju Panjang', '13', 8, 'L', 'bekas sedang', 2, '2025-11-13 12:27:05', '2025-12-04 11:50:14'),
(5, 'Jaket Hitam', '12', 1, 'L', 'bekas bagus', 22, '2025-11-13 15:59:02', '2025-12-04 11:49:20'),
(6, 'Jaket Harian', '11', 1, 'L', 'bekas bagus', 11, '2025-11-13 16:02:54', '2025-12-04 11:48:22'),
(7, 'Kemeja Panjang', '10', 5, 'XL', 'bekas sedang', 7, '2025-11-13 16:07:06', '2025-12-04 11:46:35'),
(8, 'Baju Panjang', '9', 8, 'L', 'bekas bagus', 8, '2025-11-13 16:09:55', '2025-11-20 17:31:06'),
(9, 'Jaket Olahraga', '8', 1, 'L', 'bekas bagus', 10, '2025-11-13 16:11:18', '2025-12-04 12:04:58'),
(10, 'Jaket Harian', '7', 1, 'XL', 'bekas bagus', 14, '2025-11-13 16:13:17', '2025-12-04 12:04:39'),
(13, 'Set Baju Rok Panjang', '5', 9, 'M', 'bekas bagus', 11, '2025-11-13 16:22:52', '2025-11-20 17:30:23'),
(14, 'Set Baju Celana Pendek', '4', 9, 'L', 'bekas bagus', 15, '2025-11-13 16:24:28', '2025-11-20 17:30:14'),
(17, 'Baju Panjang', '2', 8, 'L', 'bekas bagus', 3, '2025-11-18 12:52:23', '2025-11-20 17:29:55'),
(19, 'Jaket yellow', '15', 1, 'L', 'bekas bagus', 4, '2025-11-20 17:36:40', '2025-11-30 08:20:11'),
(20, 'jaket Puffer', '16', 1, 'L', 'bekas bagus', 2, '2025-11-20 17:39:57', '2025-11-20 17:39:57'),
(21, 'Jaket Panjang Perempuan', '17', 1, 'L', 'bekas sedang', 5, '2025-11-20 17:45:10', '2025-11-20 17:45:10'),
(22, 'Hoodie', '18', 6, 'L', 'bekas bagus', 2, '2025-11-20 17:48:09', '2025-11-20 17:49:06'),
(23, 'Jaket Premium', '18', 1, 'L', 'bekas bagus', 2, '2025-11-20 17:55:33', '2025-11-20 17:55:33'),
(24, 'Jaket  Perempuan', '19', 1, 'M', 'bekas bagus', 3, '2025-11-20 17:59:30', '2025-11-20 17:59:30'),
(26, 'Jaket', '21', 1, 'XL', 'bekas bagus', 2, '2025-11-20 18:11:22', '2025-12-02 10:47:15'),
(27, 'Jaket Tweed', '21', 1, 'S', 'bekas sedang', 2, '2025-12-02 10:38:35', '2025-12-02 10:42:58'),
(28, 'Bomber', '22', 1, 'L', 'bekas bagus', 4, '2025-12-02 10:44:27', '2025-12-04 12:48:36'),
(115, 'Jaket Panjang Premium', '101', 1, 'L', 'bekas bagus', 5, '2025-12-02 11:17:10', '2025-12-03 20:46:12'),
(116, 'Jaket Harian Tebal', '102', 1, 'XL', 'bekas bagus', 4, '2025-12-02 11:17:10', '2025-12-04 11:46:49'),
(117, 'Kemeja Santai Biru', '103', 5, 'M', 'bekas bagus', 10, '2025-12-02 11:17:10', '2025-12-04 11:47:00'),
(118, 'Hoodie Black Oversize', '104', 6, 'L', 'bekas bagus', 6, '2025-12-02 11:17:10', '2025-12-02 11:33:18'),
(119, 'Sweater Rajut Coklat', '105', 10, 'S', 'bekas sedang', 3, '2025-12-02 11:17:10', '2025-12-04 11:48:01'),
(122, 'Kaos Graphic Minimalis', '108', 8, 'S', 'bekas bagus', 12, '2025-12-02 11:17:10', '2025-12-04 11:48:11'),
(124, 'Hoodie Abu Misty', '110', 6, 'XL', 'bekas bagus', 5, '2025-12-02 11:17:10', '2025-12-02 11:17:10'),
(127, 'Jaket Bomber Hitam', '113', 1, 'L', 'bekas bagus', 4, '2025-12-02 11:17:10', '2025-12-02 11:17:10'),
(130, 'Sweater Polos Putih', '116', 10, 'L', 'bekas bagus', 6, '2025-12-02 11:17:10', '2025-12-04 11:48:37'),
(131, 'Jaket Waterproof', '117', 1, 'L', 'bekas bagus', 3, '2025-12-02 11:17:10', '2025-12-02 11:17:10'),
(132, 'Kemeja Casual Kotak', '118', 5, 'M', 'bekas bagus', 7, '2025-12-02 11:17:10', '2025-12-04 11:48:57'),
(134, 'Hoodie Black Edition', '120', 6, 'XL', 'bekas bagus', 2, '2025-12-02 11:17:10', '2025-12-04 12:48:44'),
(138, 'Jaket Angin Outdoor', '124', 1, 'XL', 'bekas bagus', 4, '2025-12-02 11:17:10', '2025-12-02 11:17:10'),
(141, 'Sweater Tebal Abu', '127', 10, 'L', 'bekas bagus', 3, '2025-12-02 11:17:10', '2025-12-04 12:47:21'),
(142, 'Jaket Tebal', '128', 1, 'M', 'bekas bagus', 13, '2025-12-02 11:17:10', '2025-12-04 11:50:00'),
(143, 'Hoodie Premium', '129', 6, 'XL', 'bekas bagus', 2, '2025-12-02 11:17:10', '2025-12-02 11:17:10'),
(145, 'Jaket Velvet cagoule', '131', 1, 'XL', 'bekas bagus', 9, '2025-12-02 11:17:10', '2025-12-04 11:50:46'),
(146, 'Jaket Streetwear', '132', 1, 'L', 'bekas bagus', 5, '2025-12-02 11:17:10', '2025-12-02 11:17:10'),
(149, 'Jaket Kulit Sintetis', '135', 1, 'L', 'bekas sedang', 2, '2025-12-02 11:17:10', '2025-12-02 11:17:10'),
(150, 'Kemeja Linen Putih', '136', 5, 'M', 'bekas bagus', 12, '2025-12-02 11:17:10', '2025-12-04 11:50:57'),
(151, 'Jaket Black', '137', 1, 'L', 'bekas bagus', 8, '2025-12-02 11:17:10', '2025-12-04 11:51:32'),
(153, 'Sweater Casual Pink', '139', 10, 'M', 'bekas bagus', 4, '2025-12-02 11:17:10', '2025-12-04 11:51:43'),
(154, 'Kaos Cotton Cream', '140', 8, 'S', 'bekas sedang', 15, '2025-12-02 11:17:10', '2025-12-04 11:52:19'),
(155, 'Jaket Hoodie', '141', 6, 'L', 'bekas bagus', 6, '2025-12-02 11:17:10', '2025-12-03 12:28:06'),
(158, 'Jaket Varsity Merah', '144', 1, 'XL', 'bekas bagus', 4, '2025-12-02 11:17:10', '2025-12-02 11:17:10'),
(159, 'Sweater Oversize', '145', 10, 'L', 'bekas bagus', 10, '2025-12-02 11:17:10', '2025-12-04 11:53:28'),
(161, 'Kemeja Denim', '147', 5, 'L', 'bekas bagus', 5, '2025-12-02 11:17:10', '2025-12-04 11:53:45'),
(162, 'Kaos Queen Tour', '148', 8, 'M', 'bekas bagus', 6, '2025-12-02 11:17:10', '2025-12-04 11:54:03'),
(163, 'Blouse Formal Black', '149', 11, 'S', 'bekas bagus', 3, '2025-12-02 11:17:10', '2025-12-04 11:54:56'),
(165, 'Jaket Perempuan Pink', '151', 1, 'M', 'bekas bagus', 4, '2025-12-02 11:17:10', '2025-12-04 11:55:20'),
(166, 'Jaket Harian Tipis', '152', 1, 'L', 'bekas sedang', 2, '2025-12-02 11:17:10', '2025-12-02 11:17:10'),
(168, 'Kemeja Slimfit Hitam', '154', 5, 'M', 'bekas bagus', 14, '2025-12-02 11:17:10', '2025-12-04 11:55:39'),
(169, 'Sweater Hoodie Tan', '155', 10, 'L', 'bekas bagus', 5, '2025-12-02 11:17:10', '2025-12-04 11:55:55'),
(170, 'Jaket Putih', '156', 1, 'M', 'bekas bagus', 8, '2025-12-02 11:17:10', '2025-12-04 11:56:13'),
(172, 'Jaket Casual Harian', '158', 1, 'XL', 'bekas bagus', 3, '2025-12-02 11:17:10', '2025-12-02 11:17:10'),
(175, 'Kaos Distro Street', '161', 8, 'L', 'bekas bagus', 7, '2025-12-02 11:17:10', '2025-12-04 11:56:56'),
(176, 'Sweater Orange', '162', 10, 'L', 'bekas bagus', 4, '2025-12-02 11:17:10', '2025-12-04 11:57:14'),
(178, 'Kemeja Stripe Hitam', '164', 5, 'M', 'bekas bagus', 12, '2025-12-02 11:17:10', '2025-12-04 11:57:30'),
(182, 'Kaos Brown Edition', '168', 8, 'M', 'bekas bagus', 7, '2025-12-02 11:17:10', '2025-12-04 11:57:42'),
(183, 'Jaket Jeans', '169', 1, 'S', 'bekas sedang', 1, '2025-12-02 11:17:10', '2025-12-04 11:58:04'),
(184, 'Jaket Jeans Premium', '170', 1, 'L', 'bekas bagus', 4, '2025-12-02 11:17:10', '2025-12-02 11:17:10'),
(185, 'Hoodie Black', '171', 6, 'XL', 'bekas bagus', 14, '2025-12-02 11:17:10', '2025-12-03 20:52:57'),
(187, 'Sweater Maroon', '173', 10, 'L', 'bekas bagus', 3, '2025-12-02 11:17:10', '2025-12-04 11:59:06'),
(188, 'Kemeja Flannel', '174', 5, 'L', 'bekas bagus', 4, '2025-12-02 11:17:10', '2025-12-04 11:59:32'),
(189, 'Kaos Distro Hitam', '175', 8, 'M', 'bekas bagus', 12, '2025-12-02 11:17:10', '2025-12-04 11:59:47'),
(192, 'Kaos Casual Brown', '178', 8, 'L', 'bekas bagus', 10, '2025-12-02 11:17:10', '2025-12-04 11:59:58'),
(196, 'Jaket Gunung', '182', 1, 'XL', 'bekas bagus', 3, '2025-12-02 11:17:10', '2025-12-02 11:17:10'),
(200, 'Hoodie Pastel', '186', 6, 'L', 'bekas bagus', 4, '2025-12-02 11:17:10', '2025-12-02 11:17:10'),
(201, 'Jaket  Perempuan', '187', 1, 'L', 'bekas bagus', 10, '2025-12-02 11:17:10', '2025-12-04 12:00:15'),
(203, 'Baju Panjang Santai', '189', 8, 'XL', 'bekas bagus', 13, '2025-12-02 11:17:10', '2025-12-04 12:00:33'),
(206, 'Kemeja Soft Blue', '192', 5, 'M', 'bekas bagus', 6, '2025-12-02 11:17:10', '2025-12-04 12:01:37'),
(208, 'Kaos Earth Tone', '194', 8, 'L', 'bekas bagus', 12, '2025-12-02 11:17:10', '2025-12-04 12:01:51'),
(210, 'Jaket yellow Kecoklatan', '196', 1, 'M', 'bekas bagus', 7, '2025-12-02 11:17:10', '2025-12-04 12:02:02'),
(211, 'Kaos Everyday Wear', '197', 8, 'L', 'bekas bagus', 14, '2025-12-02 11:17:10', '2025-12-04 12:02:15'),
(212, 'Sweater Morning', '198', 10, 'L', 'bekas bagus', 3, '2025-12-02 11:17:10', '2025-12-04 12:02:29');

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `keluar_id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`keluar_id`, `barang_id`, `jumlah`, `tanggal`, `user_id`, `created_at`, `updated_at`) VALUES
(5, 4, 1, '2025-11-18', 2, NULL, NULL),
(8, 19, 1, '2025-11-21', 2, NULL, NULL),
(9, 7, 2, '2025-11-30', 2, NULL, NULL),
(10, 141, 1, '2025-01-04', 2, '2025-12-04 12:47:21', '2025-12-04 12:47:38'),
(11, 28, 1, '2025-12-04', 2, '2025-12-04 12:48:36', '2025-12-04 12:48:36'),
(12, 134, 1, '2025-12-04', 2, '2025-12-04 12:48:44', '2025-12-04 12:48:44');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `masuk_id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `harga_jual` decimal(12,2) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`masuk_id`, `barang_id`, `gambar`, `harga_jual`, `jumlah`, `tanggal`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 3, '2-kemeja  Putih-1763470172.jpg', 30000.00, 11, '2025-05-13', 3, NULL, '2025-12-04 12:42:07'),
(3, 4, '3-Baju Panjang-1763470023.jpg', 50000.00, 27, '2025-10-01', 3, NULL, '2025-12-04 12:45:19'),
(4, 8, '4-Baju Panjang-1763469864.jpg', 50000.00, 11, '2025-10-13', 3, NULL, '2025-12-04 12:45:27'),
(5, 10, '5-Jaket Harian-1763466331.jpg', 50000.00, 2, '2025-03-13', 3, NULL, '2025-12-04 12:31:20'),
(6, 5, '6-Jaket Hitam-1763466300.jpg', 50000.00, 12, '2025-03-13', 3, NULL, '2025-12-04 11:45:03'),
(7, 6, '7-Jaket Harian-1763466278.jpg', 50000.00, 5, '2025-03-13', 3, NULL, '2025-12-04 11:44:08'),
(8, 9, '8-Jaket Olahraga-1763466249.jpg', 50000.00, 3, '2025-11-13', 3, NULL, '2025-12-04 12:32:18'),
(9, 7, '9-Kemeja Panjang-1763466195.jpg', 50000.00, 50, '2025-04-13', 3, NULL, '2025-12-04 12:41:07'),
(10, 14, '10-Set Baju Celana Pendek-1763466122.jpg', 50000.00, 9, '2025-09-13', 3, NULL, '2025-12-04 12:44:21'),
(12, 13, '12-Set Baju Rok Panjang-1763466065.jpg', 50000.00, 5, '2025-08-13', 3, NULL, '2025-12-04 12:44:09'),
(15, 17, '15-Baju Panjang-1763470411.jpg', 50000.00, 3, '2025-01-01', 3, NULL, '2025-12-04 11:35:39'),
(16, 5, '16-Jaket Hitam-1763659631.jpg', 100000.00, 22, '2025-03-21', 3, NULL, '2025-12-04 11:45:15'),
(17, 19, '17-Jaket yellow-1763660243.jpg', 200000.00, 5, '2025-11-21', 3, NULL, NULL),
(18, 20, '18-jaket Puffer-1763660434.jpg', 200000.00, 2, '2025-11-21', 3, NULL, NULL),
(19, 21, '19-Jaket Panjang Perempuan-1763660755.jpg', 85000.00, 5, '2025-11-21', 3, NULL, NULL),
(20, 22, '20-Hoodie-1763660979.jpg', 85000.00, 2, '2025-01-21', 3, NULL, '2025-12-04 11:40:48'),
(21, 23, '21-Jaket Premium-1763661371.jpg', 145000.00, 2, '2025-11-21', 3, NULL, NULL),
(22, 24, '22-Jaket  Perempuan-1763661621.jpg', 125000.00, 3, '2025-02-21', 3, NULL, '2025-12-04 11:39:55'),
(24, 26, '24-Jaket Harian-1763662312.jpg', 125000.00, 2, '2025-02-14', 3, NULL, '2025-12-04 11:39:22'),
(25, 27, '25-Jaket Tweed-1764672053.jpg', 145000.00, 2, '2025-01-06', 3, '2025-12-02 10:40:53', '2025-12-02 10:41:28'),
(26, 28, '26-Bomber-1764672316.jpg', 90000.00, 5, '2025-01-02', 3, '2025-12-02 10:45:16', '2025-12-02 10:46:22'),
(28, 115, '28-Jaket-1764794746.jpg', 60000.00, 4, '2025-12-02', 3, '2025-12-02 11:20:24', '2025-12-03 20:45:45'),
(29, 116, '29-Jaket Harian Tebal-1764764571.jpg', 55000.00, 3, '2025-03-02', 3, '2025-12-02 11:20:24', '2025-12-04 11:45:41'),
(30, 117, '30-Kemeja Santai Biru-1764774965.jpg', 50000.00, 10, '2025-04-02', 3, '2025-12-02 11:20:24', '2025-12-04 12:40:54'),
(31, 118, '31-Hoodie Black Oversize-1764675297.jpg', 80000.00, 6, '2025-01-14', 3, '2025-12-02 11:20:24', '2025-12-04 11:43:22'),
(32, 119, '32-Sweater Rajut Coklat-1764775520.jpg', 65000.00, 5, '2025-12-02', 3, '2025-12-02 11:20:24', '2025-12-03 15:25:20'),
(35, 122, '35-Kaos Graphic Minimalis-1764770678.jpg', 90000.00, 4, '2025-05-02', 3, '2025-12-02 11:20:24', '2025-12-04 12:42:19'),
(37, 124, '37-Hoodie Abu Misty-1764674926.jpg', 50000.00, 8, '2025-01-04', 3, '2025-12-02 11:20:24', '2025-12-04 12:30:02'),
(40, 127, '40-Jaket Bomber Hitam-1764675834.jpg', 55000.00, 5, '2025-02-02', 3, '2025-12-02 11:20:24', '2025-12-04 11:41:02'),
(43, 130, '43-Sweater Polos Putih-1764776076.jpg', 30000.00, 7, '2025-12-02', 3, '2025-12-02 11:20:24', '2025-12-04 12:38:19'),
(44, 131, '44-Jaket Waterproof-1764765364.jpg', 50000.00, 10, '2025-12-02', 3, '2025-12-02 11:20:24', '2025-12-04 12:34:47'),
(45, 132, '45-Kemeja Casual Kotak-1764772113.png', 140000.00, 4, '2025-05-02', 3, '2025-12-02 11:20:24', '2025-12-04 12:41:55'),
(47, 134, '47-Hoodie Black Edition-1764675115.jpg', 135000.00, 3, '2025-01-15', 3, '2025-12-02 11:20:24', '2025-12-04 11:37:41'),
(51, 138, '51-Jaket Angin Outdoor-1764675687.jpg', 60000.00, 4, '2025-02-02', 3, '2025-12-02 11:20:24', '2025-12-04 11:40:12'),
(54, 141, '54-Sweater Tebal Abu-1764775729.jpg', 70000.00, 2, '2025-12-02', 3, '2025-12-02 11:20:24', '2025-12-03 15:28:49'),
(55, 142, '55-Jaket-1764794482.jpg', 160000.00, 2, '2025-12-02', 3, '2025-12-02 11:20:24', '2025-12-03 20:41:22'),
(56, 143, '56-Hoodie Premium-1764675467.jpg', 150000.00, 7, '2025-02-05', 3, '2025-12-02 11:20:24', '2025-12-04 11:39:07'),
(58, 145, '58-Jaket-1764794992.jpg', 125000.00, 10, '2025-12-02', 3, '2025-12-02 11:20:24', '2025-12-04 12:35:09'),
(59, 146, '59-Jaket Streetwear-1764765161.jpg', 55000.00, 4, '2025-12-02', 3, '2025-12-02 11:20:24', '2025-12-03 12:32:41'),
(62, 149, '62-Jaket Kulit Sintetis-1764766272.jpg', 60000.00, 3, '2025-03-02', 3, '2025-12-02 11:20:24', '2025-12-04 11:44:20'),
(63, 150, '63-Kemeja Linen Putih-1764772451.jpg', 160000.00, 4, '2025-04-02', 3, '2025-12-02 11:20:24', '2025-12-04 12:41:22'),
(64, 151, '64-Jaket-1764794245.jpg', 65000.00, 5, '2025-02-02', 3, '2025-12-02 11:20:24', '2025-12-04 11:40:27'),
(66, 153, '66-Sweater Casual Pink-1764775413.jpg', 70000.00, 4, '2025-08-02', 3, '2025-12-02 11:20:24', '2025-12-04 12:43:56'),
(67, 154, '67-Kaos Cotton Cream-1764770086.jpg', 50000.00, 6, '2025-12-02', 3, '2025-12-02 11:20:24', '2025-12-03 13:54:46'),
(68, 155, '68-Jaket Hoodie Zip-1764764864.jpg', 60000.00, 3, '2025-03-02', 3, '2025-12-02 11:20:24', '2025-12-04 11:44:52'),
(71, 158, '71-Jaket Varsity Merah-1764765251.jpg', 65000.00, 2, '2025-12-02', 3, '2025-12-02 11:20:24', '2025-12-03 12:34:11'),
(72, 159, '72-Sweater Oversize-1764775978.jpg', 30000.00, 10, '2025-06-02', 3, '2025-12-02 11:20:24', '2025-12-04 12:42:54'),
(75, 165, '75-Jaket Perempuan Pink-1764765069.jpg', 65000.00, 4, '2025-12-02', 3, '2025-12-02 11:23:06', '2025-12-03 12:31:09'),
(76, 166, '76-Jaket Harian Tipis-1764764704.jpg', 35000.00, 10, '2025-03-02', 3, '2025-12-02 11:23:06', '2025-12-04 12:31:57'),
(78, 168, '78-Kemeja Slimfit Hitam-1764772860.jpg', 65000.00, 8, '2025-04-02', 3, '2025-12-02 11:23:06', '2025-12-04 12:40:18'),
(79, 169, '79-Sweater Hoodie Tan-1764775791.jpg', 35000.00, 2, '2025-07-02', 3, '2025-12-02 11:23:06', '2025-12-04 12:43:39'),
(80, 170, '80-Jaket-1764794120.jpg', 150000.00, 3, '2025-12-02', 3, '2025-12-02 11:23:06', '2025-12-03 20:35:20'),
(82, 172, '82-Jaket Casual Harian-1764675970.jpg', 150000.00, 6, '2025-02-02', 3, '2025-12-02 11:23:06', '2025-12-04 11:41:15'),
(85, 175, '85-Kaos Distro Street-1764769423.jpg', 35000.00, 8, '2025-12-02', 3, '2025-12-02 11:23:06', '2025-12-03 13:43:43'),
(86, 176, '86-Sweater Orange-1764776176.jpg', 50000.00, 7, '2025-06-02', 3, '2025-12-02 11:23:06', '2025-12-04 12:43:08'),
(88, 178, '88-Kemeja Stripe Hitam-1764772949.jpg', 35000.00, 10, '2025-12-02', 3, '2025-12-02 11:23:06', '2025-12-04 12:36:43'),
(92, 182, '92-Kaos Brown Edition-1764769323.jpg', 170000.00, 2, '2025-12-02', 3, '2025-12-02 11:23:06', '2025-12-03 13:42:03'),
(93, 183, '93-Jaket-1764794890.jpg', 100000.00, 7, '2025-03-02', 3, '2025-12-02 11:23:06', '2025-12-04 12:31:34'),
(94, 184, '94-Jaket Jeans Premium-1764766969.jpg', 65000.00, 3, '2025-03-02', 3, '2025-12-02 11:23:06', '2025-12-04 11:44:30'),
(95, 185, '95-Jaket-1764795159.jpg', 80000.00, 6, '2025-01-04', 3, '2025-12-02 11:23:06', '2025-12-04 11:42:44'),
(97, 187, '97-Sweater Maroon-1764775866.jpg', 100000.00, 9, '2025-07-02', 3, '2025-12-02 11:23:06', '2025-12-04 12:43:29'),
(98, 188, '98-Kemeja Flannel-1764772204.jpg', 50000.00, 1, '2025-05-02', 3, '2025-12-02 11:23:06', '2025-12-04 12:41:44'),
(99, 189, '99-Kaos Distro Hitam-1764769163.jpg', 30000.00, 11, '2025-12-02', 3, '2025-12-02 11:23:06', '2025-12-03 13:39:23'),
(102, 192, '102-Kaos Casual Brown-1764769227.jpg', 55000.00, 5, '2025-12-02', 3, '2025-12-02 11:23:06', '2025-12-03 13:40:27'),
(106, 196, '106-Jaket Gunung-1764764343.jpg', 100000.00, 7, '2025-02-02', 3, '2025-12-02 11:23:06', '2025-12-04 12:30:22'),
(110, 200, '110-Hoodie Pastel-1764675374.jpg', 45000.00, 9, '2025-02-02', 3, '2025-12-02 11:23:06', '2025-12-04 12:30:39'),
(111, 201, '111-Jaket-1764795059.jpg', 55000.00, 5, '2025-02-11', 3, '2025-12-02 11:23:06', '2025-12-04 11:39:41'),
(113, 203, '113-Jaket-1764794587.jpg', 50000.00, 8, '2025-01-02', 3, '2025-12-02 11:23:06', '2025-12-04 11:42:30'),
(116, 206, '116-Kemeja Soft Blue-1764774736.jpg', 65000.00, 5, '2025-09-02', 3, '2025-12-02 11:23:06', '2025-12-04 12:44:34'),
(118, 208, '118-Kaos Earth Tone-1764770207.jpg', 80000.00, 3, '2025-06-02', 3, '2025-12-02 11:23:06', '2025-12-04 12:42:41'),
(120, 210, '120-Jaket-1764794332.jpg', 55000.00, 4, '2025-12-02', 3, '2025-12-02 11:23:06', '2025-12-03 20:38:52'),
(121, 211, '121-Kaos Everyday Wear-1764770319.jpg', 40000.00, 6, '2025-06-02', 3, '2025-12-02 11:23:06', '2025-12-04 12:42:30'),
(122, 212, '122-Sweater Morning-1764776225.jpg', 90000.00, 2, '2025-06-02', 3, '2025-12-02 11:23:06', '2025-12-04 12:43:18');

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
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Jaket', '2025-10-29 16:18:45', '2025-10-29 16:18:45'),
(3, 'Celana', NULL, NULL),
(5, 'Kemeja', NULL, NULL),
(6, 'Hoodie', NULL, NULL),
(8, 'Kaos', NULL, NULL),
(9, 'Set', NULL, NULL),
(10, 'Sweater', NULL, NULL),
(11, 'Blouse', NULL, NULL);

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
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2025_10_23_072403_create_kategoris_table', 1),
(5, '2025_10_23_072404_create_barang_table', 1),
(6, '2025_10_23_07240_create_users_table', 1),
(7, '2025_10_27_014935_create_barang_masuk_table', 1),
(8, '2025_10_27_014942_create_barang_keluar_table', 1),
(9, '2025_10_28_173424_create_barangkus_table', 2),
(10, '2025_11_05_130842_remove_created_at_from_barang_table', 3),
(11, '2025_11_05_132145_add_timestamp_to_barang_table', 3),
(12, '2025_11_05_142920_add_timestamps_to_barang_masuk_and_barang_keluar_tables', 3),
(13, '2025_11_12_225843_modify_barangs_table', 4),
(14, '2025_11_13_142448_create_riwayat_login_table', 4),
(15, '2025_11_16_214916_modify_barang_table_2', 5),
(16, '2025_11_16_222229_modify_barang_masuk_table_2', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `riwayat_login`
--

CREATE TABLE `riwayat_login` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `login_at` timestamp NULL DEFAULT NULL,
  `logout_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `riwayat_login`
--

INSERT INTO `riwayat_login` (`id`, `user_id`, `ip_address`, `user_agent`, `login_at`, `logout_at`, `created_at`, `updated_at`) VALUES
(1, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-13 12:03:58', '2025-11-13 12:04:40', '2025-11-13 12:03:58', '2025-11-13 12:04:40'),
(2, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-13 12:04:52', '2025-11-13 12:05:10', '2025-11-13 12:04:52', '2025-11-13 12:05:10'),
(3, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-13 12:05:19', '2025-11-13 12:05:43', '2025-11-13 12:05:19', '2025-11-13 12:05:43'),
(4, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-13 12:05:50', '2025-11-13 12:18:54', '2025-11-13 12:05:50', '2025-11-13 12:18:54'),
(5, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-13 12:19:11', NULL, '2025-11-13 12:19:11', '2025-11-13 12:19:11'),
(6, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-13 13:56:04', '2025-11-13 13:58:56', '2025-11-13 13:56:04', '2025-11-13 13:58:56'),
(7, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-13 13:59:05', '2025-11-13 14:03:57', '2025-11-13 13:59:05', '2025-11-13 14:03:57'),
(8, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-13 14:04:03', NULL, '2025-11-13 14:04:03', '2025-11-13 14:04:03'),
(9, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-13 14:16:02', NULL, '2025-11-13 14:16:02', '2025-11-13 14:16:02'),
(10, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-13 14:16:04', NULL, '2025-11-13 14:16:04', '2025-11-13 14:16:04'),
(11, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-13 14:17:32', '2025-11-13 15:14:20', '2025-11-13 14:17:32', '2025-11-13 15:14:20'),
(12, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-13 15:14:43', '2025-11-13 15:14:52', '2025-11-13 15:14:43', '2025-11-13 15:14:52'),
(13, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-13 15:15:08', NULL, '2025-11-13 15:15:08', '2025-11-13 15:15:08'),
(14, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-13 15:54:14', '2025-11-13 16:29:11', '2025-11-13 15:54:14', '2025-11-13 16:29:11'),
(15, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-13 16:29:18', '2025-11-13 16:29:40', '2025-11-13 16:29:18', '2025-11-13 16:29:40'),
(16, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-13 16:29:43', '2025-11-13 16:30:05', '2025-11-13 16:29:43', '2025-11-13 16:30:05'),
(17, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-13 16:30:09', '2025-11-13 16:30:26', '2025-11-13 16:30:09', '2025-11-13 16:30:26'),
(18, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-13 16:30:29', NULL, '2025-11-13 16:30:29', '2025-11-13 16:30:29'),
(19, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-13 16:31:26', '2025-11-13 16:32:51', '2025-11-13 16:31:26', '2025-11-13 16:32:51'),
(20, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-13 16:32:59', '2025-11-13 16:57:18', '2025-11-13 16:32:59', '2025-11-13 16:57:18'),
(21, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-13 16:57:22', NULL, '2025-11-13 16:57:22', '2025-11-13 16:57:22'),
(22, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-13 17:08:36', '2025-11-13 17:08:45', '2025-11-13 17:08:36', '2025-11-13 17:08:45'),
(23, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-13 17:08:53', '2025-11-13 17:08:57', '2025-11-13 17:08:53', '2025-11-13 17:08:57'),
(24, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-13 17:09:04', NULL, '2025-11-13 17:09:04', '2025-11-13 17:09:04'),
(25, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-14 02:06:23', '2025-11-14 02:14:13', '2025-11-14 02:06:23', '2025-11-14 02:14:13'),
(26, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-14 02:14:18', NULL, '2025-11-14 02:14:18', '2025-11-14 02:14:18'),
(27, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-16 10:46:01', '2025-11-16 10:48:01', '2025-11-16 10:46:01', '2025-11-16 10:48:01'),
(28, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-16 10:48:08', '2025-11-16 10:50:45', '2025-11-16 10:48:08', '2025-11-16 10:50:45'),
(29, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-16 10:50:49', '2025-11-16 11:11:39', '2025-11-16 10:50:49', '2025-11-16 11:11:39'),
(30, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-16 11:11:43', '2025-11-16 11:16:58', '2025-11-16 11:11:43', '2025-11-16 11:16:58'),
(31, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-16 11:17:03', '2025-11-16 11:20:29', '2025-11-16 11:17:03', '2025-11-16 11:20:29'),
(32, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-16 11:20:32', NULL, '2025-11-16 11:20:32', '2025-11-16 11:20:32'),
(33, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-16 12:05:09', '2025-11-16 12:08:20', '2025-11-16 12:05:09', '2025-11-16 12:08:20'),
(34, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-16 12:08:24', '2025-11-16 12:13:19', '2025-11-16 12:08:24', '2025-11-16 12:13:19'),
(35, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-16 12:13:22', '2025-11-16 12:32:01', '2025-11-16 12:13:22', '2025-11-16 12:32:01'),
(36, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-16 12:32:05', NULL, '2025-11-16 12:32:05', '2025-11-16 12:32:05'),
(37, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-18 11:19:50', '2025-11-18 11:20:48', '2025-11-18 11:19:50', '2025-11-18 11:20:48'),
(38, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-18 11:20:54', '2025-11-18 11:21:47', '2025-11-18 11:20:54', '2025-11-18 11:21:47'),
(39, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-18 11:21:52', '2025-11-18 11:22:06', '2025-11-18 11:21:52', '2025-11-18 11:22:06'),
(40, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-18 11:22:09', '2025-11-18 11:22:29', '2025-11-18 11:22:09', '2025-11-18 11:22:29'),
(41, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-18 11:22:32', '2025-11-18 12:57:18', '2025-11-18 11:22:32', '2025-11-18 12:57:18'),
(42, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-18 12:57:22', '2025-11-18 12:57:26', '2025-11-18 12:57:22', '2025-11-18 12:57:26'),
(43, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-18 12:57:29', '2025-11-18 12:59:18', '2025-11-18 12:57:29', '2025-11-18 12:59:18'),
(44, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-18 12:59:22', '2025-11-18 13:01:14', '2025-11-18 12:59:22', '2025-11-18 13:01:14'),
(45, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-18 13:01:17', '2025-11-18 13:35:04', '2025-11-18 13:01:17', '2025-11-18 13:35:04'),
(46, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-18 13:35:08', '2025-11-18 13:44:06', '2025-11-18 13:35:08', '2025-11-18 13:44:06'),
(47, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-18 13:44:09', '2025-11-18 13:44:54', '2025-11-18 13:44:09', '2025-11-18 13:44:54'),
(48, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-18 13:44:57', '2025-11-18 13:45:41', '2025-11-18 13:44:57', '2025-11-18 13:45:41'),
(49, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-18 13:45:45', '2025-11-30 06:19:46', '2025-11-18 13:45:45', '2025-11-30 06:19:46'),
(50, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-18 13:58:28', '2025-11-18 14:00:55', '2025-11-18 13:58:28', '2025-11-18 14:00:55'),
(51, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-18 14:01:00', '2025-11-18 14:04:52', '2025-11-18 14:01:00', '2025-11-18 14:04:52'),
(52, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-18 14:04:56', NULL, '2025-11-18 14:04:56', '2025-11-18 14:04:56'),
(53, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-19 13:26:00', '2025-11-19 13:26:27', '2025-11-19 13:26:00', '2025-11-19 13:26:27'),
(54, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-19 13:26:31', '2025-11-19 13:26:55', '2025-11-19 13:26:31', '2025-11-19 13:26:55'),
(55, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-19 13:27:00', '2025-11-19 13:27:18', '2025-11-19 13:27:00', '2025-11-19 13:27:18'),
(56, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-19 13:27:22', '2025-11-19 13:27:36', '2025-11-19 13:27:22', '2025-11-19 13:27:36'),
(57, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-19 13:27:49', NULL, '2025-11-19 13:27:49', '2025-11-19 13:27:49'),
(58, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-20 17:19:28', '2025-11-20 17:22:32', '2025-11-20 17:19:28', '2025-11-20 17:22:32'),
(59, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-20 17:22:36', '2025-11-20 17:22:56', '2025-11-20 17:22:36', '2025-11-20 17:22:56'),
(60, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-20 17:23:01', '2025-11-20 17:23:25', '2025-11-20 17:23:01', '2025-11-20 17:23:25'),
(61, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-20 17:23:28', '2025-11-20 17:23:39', '2025-11-20 17:23:28', '2025-11-20 17:23:39'),
(62, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-20 17:23:42', '2025-11-20 17:40:54', '2025-11-20 17:23:42', '2025-11-20 17:40:54'),
(63, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-20 17:40:58', '2025-11-20 17:41:20', '2025-11-20 17:40:58', '2025-11-20 17:41:20'),
(64, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-20 17:41:24', '2025-11-20 18:04:14', '2025-11-20 17:41:24', '2025-11-20 18:04:14'),
(65, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-20 18:04:18', '2025-11-20 18:05:39', '2025-11-20 18:04:18', '2025-11-20 18:05:39'),
(66, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-20 18:05:46', '2025-11-20 18:14:13', '2025-11-20 18:05:46', '2025-11-20 18:14:13'),
(67, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-20 18:14:17', '2025-11-20 18:15:37', '2025-11-20 18:14:17', '2025-11-20 18:15:37'),
(68, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-20 18:15:41', '2025-11-20 18:17:06', '2025-11-20 18:15:41', '2025-11-20 18:17:06'),
(69, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-20 18:17:09', '2025-11-20 18:19:42', '2025-11-20 18:17:09', '2025-11-20 18:19:42'),
(70, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-20 18:19:45', NULL, '2025-11-20 18:19:45', '2025-11-20 18:19:45'),
(71, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-30 06:19:49', '2025-11-30 06:36:34', '2025-11-30 06:19:49', '2025-11-30 06:36:34'),
(72, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-30 06:36:37', '2025-11-30 07:06:43', '2025-11-30 06:36:37', '2025-11-30 07:06:43'),
(73, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-30 07:06:47', '2025-11-30 08:05:46', '2025-11-30 07:06:47', '2025-11-30 08:05:46'),
(74, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-30 08:05:49', '2025-11-30 08:16:03', '2025-11-30 08:05:49', '2025-11-30 08:16:03'),
(75, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-30 08:16:07', '2025-11-30 08:46:39', '2025-11-30 08:16:07', '2025-11-30 08:46:39'),
(76, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-30 08:48:29', '2025-11-30 08:56:02', '2025-11-30 08:48:29', '2025-11-30 08:56:02'),
(77, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-30 08:56:07', '2025-11-30 08:56:58', '2025-11-30 08:56:07', '2025-11-30 08:56:58'),
(78, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-30 08:57:01', '2025-11-30 08:57:57', '2025-11-30 08:57:01', '2025-11-30 08:57:57'),
(79, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-30 08:58:00', '2025-11-30 08:58:27', '2025-11-30 08:58:00', '2025-11-30 08:58:27'),
(80, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-30 08:58:31', '2025-11-30 08:59:07', '2025-11-30 08:58:31', '2025-11-30 08:59:07'),
(81, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-30 08:59:12', '2025-11-30 08:59:58', '2025-11-30 08:59:12', '2025-11-30 08:59:58'),
(82, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-30 09:00:01', '2025-11-30 09:00:40', '2025-11-30 09:00:01', '2025-11-30 09:00:40'),
(83, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-30 09:00:45', '2025-11-30 09:01:18', '2025-11-30 09:00:45', '2025-11-30 09:01:18'),
(84, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-30 09:01:21', '2025-11-30 09:01:35', '2025-11-30 09:01:21', '2025-11-30 09:01:35'),
(85, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-30 09:01:38', '2025-11-30 09:09:14', '2025-11-30 09:01:38', '2025-11-30 09:09:14'),
(86, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-30 09:09:17', NULL, '2025-11-30 09:09:17', '2025-11-30 09:09:17'),
(87, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-01 05:33:35', '2025-12-01 05:45:12', '2025-12-01 05:33:35', '2025-12-01 05:45:12'),
(88, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-01 05:45:15', '2025-12-01 07:39:59', '2025-12-01 05:45:15', '2025-12-01 07:39:59'),
(89, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-01 05:46:17', '2025-12-01 05:47:14', '2025-12-01 05:46:17', '2025-12-01 05:47:14'),
(90, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-01 05:47:17', NULL, '2025-12-01 05:47:17', '2025-12-01 05:47:17'),
(91, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-01 06:39:33', '2025-12-01 06:41:25', '2025-12-01 06:39:33', '2025-12-01 06:41:25'),
(92, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-01 06:41:28', '2025-12-01 06:41:46', '2025-12-01 06:41:28', '2025-12-01 06:41:46'),
(93, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-01 06:41:52', '2025-12-01 06:43:39', '2025-12-01 06:41:52', '2025-12-01 06:43:39'),
(94, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-01 06:43:42', '2025-12-01 06:45:52', '2025-12-01 06:43:42', '2025-12-01 06:45:52'),
(95, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-01 06:45:57', '2025-12-01 07:39:36', '2025-12-01 06:45:57', '2025-12-01 07:39:36'),
(96, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-02 02:06:45', '2025-12-02 11:38:29', '2025-12-02 02:06:45', '2025-12-02 11:38:29'),
(97, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-02 10:03:19', '2025-12-02 11:49:25', '2025-12-02 10:03:19', '2025-12-02 11:49:25'),
(98, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-03 04:38:08', '2025-12-03 16:39:57', '2025-12-03 04:38:08', '2025-12-03 16:39:57'),
(99, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-03 04:41:54', '2025-12-03 17:08:25', '2025-12-03 04:41:54', '2025-12-03 17:08:25'),
(100, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-03 17:08:31', '2025-12-04 12:48:22', '2025-12-03 17:08:31', '2025-12-04 12:48:22'),
(101, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-03 17:18:00', '2025-12-04 12:47:56', '2025-12-03 17:18:00', '2025-12-04 12:47:56'),
(102, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-03 17:19:04', '2025-12-04 12:48:46', '2025-12-03 17:19:04', '2025-12-04 12:48:46'),
(103, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-05 01:12:59', '2025-12-05 01:29:12', '2025-12-05 01:12:59', '2025-12-05 01:29:12'),
(104, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-05 01:29:15', '2025-12-05 01:44:19', '2025-12-05 01:29:15', '2025-12-05 01:44:19'),
(105, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-05 01:44:24', NULL, '2025-12-05 01:44:24', '2025-12-05 01:44:24'),
(106, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-06 07:58:34', '2025-12-06 07:58:43', '2025-12-06 07:58:34', '2025-12-06 07:58:43'),
(107, 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-06 07:58:46', '2025-12-06 07:59:17', '2025-12-06 07:58:46', '2025-12-06 07:59:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('pemilik','kasir','petugas_gudang') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `nama`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'Pemilik', 'pemilik', 'pemilik', 'pemilik', '2025-10-28 10:51:06'),
(2, 'Kasir', 'kasir', 'kasir', 'kasir', '2025-10-28 10:51:06'),
(3, 'Petugas Gudang', 'gudang', 'gudang', 'petugas_gudang', '2025-10-28 10:51:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`barang_id`),
  ADD KEY `barang_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`keluar_id`),
  ADD KEY `barang_keluar_barang_id_foreign` (`barang_id`),
  ADD KEY `barang_keluar_user_id_foreign` (`user_id`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`masuk_id`),
  ADD KEY `barang_masuk_barang_id_foreign` (`barang_id`),
  ADD KEY `barang_masuk_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `riwayat_login`
--
ALTER TABLE `riwayat_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `riwayat_login_user_id_index` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `barang_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `keluar_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `masuk_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `riwayat_login`
--
ALTER TABLE `riwayat_login`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`) ON DELETE SET NULL;

--
-- Constraints for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`barang_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `barang_keluar_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`barang_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `barang_masuk_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `riwayat_login`
--
ALTER TABLE `riwayat_login`
  ADD CONSTRAINT `riwayat_login_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
