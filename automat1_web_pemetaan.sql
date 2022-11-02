-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 02, 2022 at 07:06 AM
-- Server version: 10.3.35-MariaDB-log-cll-lve
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `automat1_web_pemetaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `gambar_data`
--

CREATE TABLE `gambar_data` (
  `id` int(255) NOT NULL,
  `nama_gambar` varchar(255) NOT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `lokasi_string` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `waktu_upload` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gambar_data`
--

INSERT INTO `gambar_data` (`id`, `nama_gambar`, `lokasi`, `lokasi_string`, `keterangan`, `waktu_upload`) VALUES
(1492, '11_Lubang_-7.634243,111.529993.jpg', '-7.634243,111.529993', ', ', 'Lubang', '2022-06-27 08:26:31'),
(1493, '12_Lubang_-7.634325,111.530367.jpg', '-7.634325,111.530367', ', ', 'Lubang', '2022-06-27 08:26:35'),
(1494, '13_Lubang_-7.634291,111.530253.jpg', '-7.634291,111.530253', ', ', 'Lubang', '2022-06-27 08:26:38'),
(1495, '14_Lubang_-7.634308,111.530128.jpg', '-7.634308,111.530128', ', ', 'Lubang', '2022-06-27 08:26:43'),
(1496, '2_Lubang_-7.634082,111.529143.jpg', '-7.634082,111.529143', ', ', 'Lubang', '2022-06-27 08:26:47'),
(1497, '3_Lubang_-7.634112,111.529312.jpg', '-7.634112,111.529312', ', ', 'Lubang', '2022-06-27 08:26:52'),
(1498, '4_Lubang_-7.634124,111.529394.jpg', '-7.634124,111.529394', ', ', 'Lubang', '2022-06-27 08:26:57'),
(1499, '5_Lubang_-7.634150,111.529546.jpg', '-7.634150,111.529546', ', ', 'Lubang', '2022-06-27 08:27:03'),
(1500, '6_Lubang_-7.634169,111.529634.jpg', '-7.634169,111.529634', ', ', 'Lubang', '2022-06-27 08:27:09'),
(1501, '7_Lubang_-7.634197,111.529767.jpg', '-7.634197,111.529767', ', ', 'Lubang', '2022-06-27 08:27:15'),
(1502, '8_Lubang_-7.634220,111.529886.jpg', '-7.634220,111.529886', ', ', 'Lubang', '2022-06-27 08:27:24'),
(1503, '9_Lubang_-7.634282,111.530253.jpg', '-7.634282,111.530253', ', ', 'Lubang', '2022-06-27 08:27:38'),
(1506, '17_Retak_-7.609881,111.549347.jpg', '-7.609881,111.549347', ', ', 'Retak', '2022-06-27 09:46:47'),
(1516, '27_Lubang_-7.609231,111.550487.jpg', '-7.609231,111.550487', ', ', 'Lubang', '2022-06-27 09:47:26'),
(1518, '29_Lubang_-7.609061,111.550764.jpg', '-7.609061,111.550764', ', ', 'Lubang', '2022-06-27 09:47:36'),
(1521, '32_Lubang_-7.608813,111.551212.jpg', '-7.608813,111.551212', ', ', 'Lubang', '2022-06-27 09:47:43'),
(1523, '34_Retak_-7.608627,111.551558.jpg', '-7.608627,111.551558', ', ', 'Retak', '2022-06-27 09:47:49'),
(1526, '37_Retak_-7.608327,111.552078.jpg', '-7.608327,111.552078', ', ', 'Retak', '2022-06-27 09:47:57'),
(1536, '47_Lubang_-7.605781,111.556512.jpg', '-7.605781,111.556512', ', ', 'Lubang', '2022-06-27 09:48:28'),
(1541, '58_Retak_-7.605409,111.557174.jpg', '-7.605409,111.557174', ', ', 'Retak', '2022-06-27 09:48:41'),
(1543, '60_Lubang_-7.605307,111.557347.jpg', '-7.605307,111.557347', ', ', 'Lubang', '2022-06-27 09:48:45'),
(1545, '62_Lubang_-7.605259,111.557428.jpg', '-7.605259,111.557428', ', ', 'Lubang', '2022-06-27 09:48:49'),
(1546, '63_Lubang_-7.605234,111.557476.jpg', '-7.605234,111.557476', ', ', 'Lubang', '2022-06-27 09:48:52'),
(1547, '64_Lubang_-7.605211,111.557520.jpg', '-7.605211,111.557520', ', ', 'Lubang', '2022-06-27 09:48:54'),
(1548, '65_Lubang_-7.605194,111.557555.jpg', '-7.605194,111.557555', ', ', 'Lubang', '2022-06-27 09:48:57'),
(1549, '66_Lubang_-7.605179,111.557584.jpg', '-7.605179,111.557584', ', ', 'Lubang', '2022-06-27 09:48:59'),
(1550, '67_Lubang_-7.605157,111.557610.jpg', '-7.605157,111.557610', ', ', 'Lubang', '2022-06-27 09:49:02'),
(1562, '5_Lubang_-7.647770,111.524978.jpg', '-7.647770,111.524978', ', ', 'Lubang', '2022-06-28 10:18:27'),
(1582, '25_Retak_-7.648137,111.527723.jpg', '-7.648137,111.527723', ', ', 'Retak', '2022-06-28 10:23:28'),
(1587, '30_Retak_-7.646372,111.521253.jpg', '-7.646372,111.521253', ', ', 'Retak', '2022-06-28 10:26:22'),
(1588, '31_Retak_-7.645787,111.519020.jpg', '-7.645787,111.519020', ', ', 'Retak', '2022-06-28 10:27:04'),
(1589, '32_Retak_-7.645538,111.518280.jpg', '-7.645538,111.518280', ', ', 'Retak', '2022-06-28 10:27:24'),
(1592, '35_Lubang_-7.646537,111.521920.jpg', '-7.646537,111.521920', ', ', 'Lubang', '2022-06-28 10:28:48'),
(1667, '68_Retak_-7.605139,111.557637.jpg', '-7.605139,111.557637', ', ', 'Retak', '2022-07-21 06:39:19'),
(1668, '69_Retak_-7.605121,111.557667.jpg', '-7.605121,111.557667', ', ', 'Retak', '2022-07-21 06:45:44'),
(1931, '12_Lubang_-6.1331,106.84658.jpg', '-6.1331,106.84658', '', 'Lubang', '2022-08-01 02:16:13'),
(1932, '13_Lubang_-6.13255,106.84647.jpg', '-6.13255,106.84647', '', 'Lubang', '2022-08-01 02:16:16'),
(1933, '14_Retak_-6.13088,106.84627.jpg', '-6.13088,106.84627', '', 'Retak', '2022-08-01 02:17:31'),
(1940, '21_Lubang_-6.12918,106.83782.jpg', '-6.12918,106.83782', '', 'Lubang', '2022-08-01 02:19:53'),
(1942, '23_Lubang_-6.12952,106.83606.jpg', '-6.12952,106.83606', '', 'Lubang', '2022-08-01 02:20:16'),
(1944, '25_Lubang_-6.12974,106.83482.jpg', '-6.12974,106.83482', '', 'Lubang', '2022-08-01 02:20:26'),
(1945, '26_Lubang_-6.12981,106.83423.jpg', '-6.12981,106.83423', '', 'Lubang', '2022-08-01 02:20:29'),
(1946, '27_Lubang_-6.12988,106.83366.jpg', '-6.12988,106.83366', '', 'Lubang', '2022-08-01 02:20:33'),
(1951, '32_Retak_-6.13075,106.82642.jpg', '-6.13075,106.82642', '', 'Retak', '2022-08-01 02:21:25'),
(1952, '33_Lubang_-6.13114,106.82446.jpg', '-6.13114,106.82446', '', 'Lubang', '2022-08-01 02:21:37'),
(1955, '36_Lubang_-6.13178,106.82156.jpg', '-6.13178,106.82156', '', 'Lubang', '2022-08-01 02:22:03'),
(1966, '47_Lubang_-6.13035,106.8103.jpg', '-6.13035,106.8103', '', 'Lubang', '2022-08-01 02:23:59'),
(1970, '51_Lubang_-6.1321,106.80155.jpg', '-6.1321,106.80155', '', 'Lubang', '2022-08-01 02:24:58'),
(1983, '64_Retak_-6.12973,106.78092.jpg', '-6.12973,106.78092', '', 'Retak', '2022-08-01 02:27:03'),
(1989, '70_Lubang_-6.12188,106.77384.jpg', '-6.12188,106.77384', '', 'Lubang', '2022-08-01 02:28:14'),
(2033, '114_Lubang_-6.11469,106.73194.jpg', '-6.11469,106.73194', '', 'Lubang', '2022-08-01 02:33:46'),
(2053, '134_Lubang_-6.10182,106.70286.jpg', '-6.10182,106.70286', '', 'Lubang', '2022-08-01 02:37:23'),
(2058, '139_Retak_-6.10582,106.69616.jpg', '-6.10582,106.69616', '', 'Retak', '2022-08-01 02:38:18'),
(2059, '140_Retak_-6.10607,106.69598.jpg', '-6.10607,106.69598', '', 'Retak', '2022-08-01 02:38:39'),
(2074, '155_Retak_-6.12187,106.66623.jpg', '-6.12187,106.66623', '', 'Retak', '2022-08-01 02:42:38'),
(2090, '3_Lubang_1.12542,104.03031.jpg', '1.12542,104.03031', '', 'Lubang', '2022-08-01 10:52:26'),
(2091, '2_Lubang_1.12537,104.03031.jpg', '1.12537,104.03031', '', 'Lubang', '2022-08-01 10:52:30'),
(2092, '1_Lubang_1.12537,104.03031.jpg', '1.12537,104.03031', '', 'Lubang', '2022-08-01 10:52:32'),
(2093, '1_Lubang_1.12554,104.03028.jpg', '1.12554,104.03028', '', 'Lubang', '2022-08-01 10:54:26'),
(2094, '2_Lubang_1.12552,104.03026.jpg', '1.12552,104.03026', '', 'Lubang', '2022-08-01 10:54:34'),
(2095, '3_Lubang_1.12546,104.03027.jpg', '1.12546,104.03027', '', 'Lubang', '2022-08-01 10:54:38'),
(2096, '4_Lubang_1.12537,104.03025.jpg', '1.12537,104.03025', '', 'Lubang', '2022-08-01 10:54:42'),
(2097, '5_Lubang_1.12555,104.0303.jpg', '1.12555,104.0303', '', 'Lubang', '2022-08-01 10:54:45'),
(2098, '6_Lubang_1.12539,104.03026.jpg', '1.12539,104.03026', '', 'Lubang', '2022-08-01 10:54:49'),
(2099, '7_Lubang_1.12532,104.03023.jpg', '1.12532,104.03023', '', 'Lubang', '2022-08-01 10:55:00'),
(2100, '8_Lubang_1.1253,104.03021.jpg', '1.1253,104.03021', '', 'Lubang', '2022-08-01 10:55:03'),
(2101, '9_Lubang_1.12532,104.03021.jpg', '1.12532,104.03021', '', 'Lubang', '2022-08-01 10:55:07'),
(2102, '10_Retak_1.12531,104.0302.jpg', '1.12531,104.0302', '', 'Retak', '2022-08-01 10:55:12'),
(2103, '11_Lubang_1.12532,104.0302.jpg', '1.12532,104.0302', '', 'Lubang', '2022-08-01 10:55:17'),
(2104, '12_Lubang_1.12534,104.0302.jpg', '1.12534,104.0302', '', 'Lubang', '2022-08-01 10:55:22'),
(2105, '13_Lubang_1.12534,104.03019.jpg', '1.12534,104.03019', '', 'Lubang', '2022-08-01 10:55:27'),
(2107, '15_Lubang_1.12536,104.03013.jpg', '1.12536,104.03013', '', 'Lubang', '2022-08-01 10:55:41'),
(2108, '16_Lubang_1.1254,104.03015.jpg', '1.1254,104.03015', '', 'Lubang', '2022-08-01 10:55:50'),
(2109, '17_Lubang_1.12537,104.0301.jpg', '1.12537,104.0301', '', 'Lubang', '2022-08-01 10:55:53'),
(2111, '19_Retak_1.12538,104.0301.jpg', '1.12538,104.0301', '', 'Retak', '2022-08-01 10:56:01'),
(2112, '20_Retak_1.12537,104.03011.jpg', '1.12537,104.03011', '', 'Retak', '2022-08-01 10:56:04'),
(2113, '21_Lubang_1.12537,104.03012.jpg', '1.12537,104.03012', '', 'Lubang', '2022-08-01 10:56:08'),
(2114, '22_Lubang_1.12536,104.03016.jpg', '1.12536,104.03016', '', 'Lubang', '2022-08-01 10:56:14'),
(2115, '23_Lubang_1.12537,104.03016.jpg', '1.12537,104.03016', '', 'Lubang', '2022-08-01 10:56:18'),
(2116, '24_Lubang_1.12537,104.03016.jpg', '1.12537,104.03016', '', 'Lubang', '2022-08-01 10:56:22'),
(2117, '25_Lubang_1.12536,104.03013.jpg', '1.12536,104.03013', '', 'Lubang', '2022-08-01 10:56:27'),
(2118, '26_Lubang_1.12534,104.03005.jpg', '1.12534,104.03005', '', 'Lubang', '2022-08-01 10:56:29'),
(2119, '27_Retak_1.12534,104.03.jpg', '1.12534,104.03', '', 'Retak', '2022-08-01 10:56:33'),
(2120, '28_Lubang_1.12534,104.02996.jpg', '1.12534,104.02996', '', 'Lubang', '2022-08-01 10:56:37'),
(2121, '29_Lubang_1.12534,104.02995.jpg', '1.12534,104.02995', '', 'Lubang', '2022-08-01 10:56:39'),
(2123, '31_Lubang_1.12534,104.0299.jpg', '1.12534,104.0299', '', 'Lubang', '2022-08-01 10:56:47'),
(2124, '32_Lubang_1.12532,104.02989.jpg', '1.12532,104.02989', '', 'Lubang', '2022-08-01 10:56:51'),
(2125, '33_Lubang_1.12531,104.0299.jpg', '1.12531,104.0299', '', 'Lubang', '2022-08-01 10:56:56'),
(2126, '34_Lubang_1.12531,104.02989.jpg', '1.12531,104.02989', '', 'Lubang', '2022-08-01 10:56:59'),
(2129, '37_Lubang_1.12531,104.0299.jpg', '1.12531,104.0299', '', 'Lubang', '2022-08-01 10:57:10'),
(2143, '3_Lubang_.jpg', '', '', 'Lubang', '2022-08-03 05:25:29'),
(2145, '5_Lubang_.jpg', '', '', 'Lubang', '2022-08-03 05:25:56'),
(2146, '6_Lubang_.jpg', '', '', 'Lubang', '2022-08-03 05:25:58'),
(2148, '8_Lubang_.jpg', '', '', 'Lubang', '2022-08-03 05:27:01'),
(2149, '10_Lubang_.jpg', '', '', 'Lubang', '2022-08-03 05:34:22'),
(2151, '1_Lubang_.jpg', '', '', 'Lubang', '2022-08-03 05:37:46'),
(2152, '2_Lubang_.jpg', '', '', 'Lubang', '2022-08-03 05:37:53'),
(2153, '1_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:01:33'),
(2154, '2_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:01:44'),
(2155, '3_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:01:47'),
(2156, '4_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:01:52'),
(2157, '5_Lubang_.jpg', '', '', 'Lubang', '2022-08-03 06:02:18'),
(2158, '6_Lubang_.jpg', '', '', 'Lubang', '2022-08-03 06:03:17'),
(2159, '7_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:03:21'),
(2160, '8_Lubang_.jpg', '', '', 'Lubang', '2022-08-03 06:03:24'),
(2161, '9_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:03:28'),
(2162, '10_Lubang_.jpg', '', '', 'Lubang', '2022-08-03 06:03:37'),
(2163, '11_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:08:34'),
(2164, '12_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:08:38'),
(2165, '13_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:08:42'),
(2166, '14_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:08:44'),
(2167, '15_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:08:48'),
(2168, '16_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:08:51'),
(2169, '17_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:08:53'),
(2170, '18_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:08:58'),
(2171, '19_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:09:00'),
(2172, '20_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:09:07'),
(2173, '22_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:09:09'),
(2174, '21_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:09:11'),
(2175, '23_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:09:12'),
(2176, '24_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:09:14'),
(2177, '25_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:09:18'),
(2178, '26_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:09:21'),
(2179, '27_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:09:24'),
(2180, '28_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:09:26'),
(2181, '29_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:09:29'),
(2182, '30_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:09:32'),
(2183, '31_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:09:35'),
(2184, '32_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:09:38'),
(2185, '33_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:09:41'),
(2186, '34_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:09:44'),
(2187, '35_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:09:47'),
(2188, '36_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:09:51'),
(2189, '37_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:09:54'),
(2190, '38_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:09:57'),
(2191, '39_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:10:00'),
(2192, '40_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:10:03'),
(2193, '41_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:10:07'),
(2194, '42_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:10:09'),
(2195, '43_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:10:12'),
(2196, '44_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:10:16'),
(2197, '45_Lubang_.jpg', '', '', 'Lubang', '2022-08-03 06:10:27'),
(2198, '46_Lubang_.jpg', '', '', 'Lubang', '2022-08-03 06:10:30'),
(2199, '66_Lubang_.jpg', '', '', 'Lubang', '2022-08-03 06:25:34'),
(2200, '51_Lubang_.jpg', '', '', 'Lubang', '2022-08-03 06:25:37'),
(2201, '65_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:25:40'),
(2202, '54_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:25:42'),
(2203, '52_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:25:45'),
(2204, '64_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:25:47'),
(2205, '60_Lubang_.jpg', '', '', 'Lubang', '2022-08-03 06:25:49'),
(2206, '49_Lubang_.jpg', '', '', 'Lubang', '2022-08-03 06:25:51'),
(2207, '56_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:25:54'),
(2208, '68_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:25:56'),
(2209, '72_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:25:58'),
(2210, '63_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:26:00'),
(2211, '61_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:26:05'),
(2212, '53_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:26:07'),
(2213, '69_Retak_.jpg', '', '', 'Retak', '2022-08-03 06:26:09'),
(2214, '67_Lubang_.jpg', '', '', 'Lubang', '2022-08-03 06:26:11');

-- --------------------------------------------------------

--
-- Table structure for table `header_laporan_data`
--

CREATE TABLE `header_laporan_data` (
  `id` int(255) NOT NULL,
  `nama_instansi` varchar(255) NOT NULL,
  `penanggung_jawab` varchar(255) NOT NULL,
  `alamat_instansi` varchar(255) NOT NULL,
  `telepon_instansi` varchar(255) NOT NULL,
  `fax_instansi` varchar(255) NOT NULL,
  `laman_instansi` varchar(255) NOT NULL,
  `email_instansi` varchar(255) NOT NULL,
  `logo_instansi` varchar(255) NOT NULL,
  `waktu_simpan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `header_laporan_data`
--

INSERT INTO `header_laporan_data` (`id`, `nama_instansi`, `penanggung_jawab`, `alamat_instansi`, `telepon_instansi`, `fax_instansi`, `laman_instansi`, `email_instansi`, `logo_instansi`, `waktu_simpan`) VALUES
(3, 'Politeknik Negeri Madiun', 'Eryandhi Putro Nugroho', 'Jl. Serayu no. 84 Madiun Kode Pos 63133', '0351-452970', '0351-492960', 'www.pnm.ac.id', 'sekretariat@pnm.ac.id', 'logopnm.png', '2022-07-24 10:29:38');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `nama_gambar` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lon` float(10,6) NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `nama_gambar`, `lat`, `lon`, `keterangan`) VALUES
(1, '1_Retak_-7.647216,111.522133.jpg', -7.647216, 111.522133, 'Retak'),
(2, '2_Retak_-7.647918,111.522069.jpg', -7.647918, 111.522072, 'Retak'),
(3, '3_Retak_-7.647556,111.525996.jpg', -7.647556, 111.525993, 'Retak'),
(4, '4_Lubang_-7.647524,111.525717.jpg', -7.647524, 111.525719, 'Lubang'),
(5, '5_Retak_-7.647173,111.524580.jpg', -7.647173, 111.524582, 'Retak');

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`id`, `name`, `username`, `email`, `password`) VALUES
(1, 'eryandhi', 'eryandhi', 'eryandhi@email.com', '$2y$10$S3pGpM56RyjveuOZUSnlQ.5wK5yOcqqCbtXQ8k5Wu6OmpoPs7qvfu'),
(2, 'putro', 'putro', 'putro@gmail.com', '$2y$10$QAMppa3c1sQCcVdd2oVAWuGeg//pGJiUlmceGSsNkOdAyQ3X9oiQG'),
(3, 'Ratna aulia', 'ratna', 'auliaratnaaa28@gmail.com', '$2y$10$pFQALR8VgiYqkeHjTi9wee3Q./74n3iFx7YMgQtkEoszxEUnbNimy'),
(21, 'tes', 'tes', 'tes@gmail.com', '$2y$10$tQLkjlNAFrlhvd8viCjPxeG/e/mgzfGGahG2C2Vlu.R0mIbRh1fo.'),
(23, 'Nyoba', 'nyoba', 'nyoba@email.com', '$2y$10$crk/pNwHNwttQixh0oh9pO3bI5HyKo9vhTZ/hJCaioTnYs/SD4dhi'),
(24, 'Aulia', 'aulia', 'auliaratnaaa28@gmail.com', '$2y$10$qYikFAjnQuVPK0Ne6yIfLu1KUYsy1KH.CAdD4aDpe95rkiWNuuztm'),
(25, 'Sulfan bagus setyawan', 'Sulfan', 'bagussetyawansulfan@gmail.com', '$2y$10$.WaLAZNq1PGwIFJc0P2K9unPQHRkyzp59nmReIqnS5/K5Of.340T.'),
(26, 'Nugroho', 'nugroho', 'nugroho@mail.com', '$2y$10$.oxFJitEB2oqmVjnGb.eVucJZCvbY4EvN8HI3jiu8dc1/Lvrf.jHK'),
(27, 'ilham', 'ilhamyd', 'ilham.dy18@gmail.com', '$2y$10$1d9VrhWbJ4A0kPv2/pr.uujgqc8th2zWi7xIlawfol9KpP.h/Rl.K'),
(28, 'Jiadah ', 'Jiadah', 'jiadahkhoirina@gmail.com', '$2y$10$5tA6xn8zN5FTBjVxg8Y5duJ98.HN69v/2gpEb5kG/9iST7jmR4XPS'),
(29, 'Ratna Aulia', 'Ratna Aulia', 'ratnaaulia31@gmail.com', '$2y$10$yHxAka9k2QvFCRl7/Fs9qOAE5/eG/oeKshaFb32s.ygcWx4S9Y6lG'),
(30, 'Eryandhi Putro Nugroho', 'eryandhipn', 'eryandhiputro@gmail.com', '$2y$10$afgAoVSIKCOSmKTm7u.RheTLfBuewtDPpMv0uZcm9FYWazi.lEEc.'),
(31, 'Fadila', 'Fadila ', 'jiadahkhoirina@gmail.com', '$2y$10$Zrnf7awq1RLlHMFgSULqHe47pMNQYvjVaBf4xYpr.jza6vQ.4EISe'),
(32, 'Joko', 'joko', 'Joko@gmail.com', '$2y$10$KFIQ8NWS.hWg9lgw8rKlWOcaFTxlWLaOG3Zqv80sVVqIETbXMsStS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gambar_data`
--
ALTER TABLE `gambar_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `header_laporan_data`
--
ALTER TABLE `header_laporan_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gambar_data`
--
ALTER TABLE `gambar_data`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2215;

--
-- AUTO_INCREMENT for table `header_laporan_data`
--
ALTER TABLE `header_laporan_data`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
