-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2024 at 10:10 AM
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
-- Database: `sellingbooks`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_category` int(11) NOT NULL DEFAULT 10 COMMENT '1: Tiểu thuyết\r\n2 :Truyện ngắn\r\n3 : Huyền bí\r\n4: kinh điển\r\n5: kiếm hiệp\r\n6:lịch sử\r\n7: thơ\r\n8: phưu lưu\r\n9:khoa học viển tưởng\r\n10: khác',
  `TenSach` varchar(255) NOT NULL,
  `TacGia` varchar(255) NOT NULL,
  `MoTa` text DEFAULT NULL,
  `Gia` decimal(10,2) NOT NULL,
  `SoLuongTrongKho` int(11) NOT NULL,
  `URL` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `id_category`, `TenSach`, `TacGia`, `MoTa`, `Gia`, `SoLuongTrongKho`, `URL`, `created_at`, `updated_at`) VALUES
(12, 5, 'Cửu Âm Chân Kinh.', 'Thái Dám Tiền Triều.', 'Võ công thiếu lâm tự.', 120000.00, 25, '/upload/1713925417_t.jpg', '2024-04-15 06:26:24', '2024-04-23 19:23:37'),
(13, 10, 'Cửu  dương thần công', 'kim dung', 'võ công đệ nhất thiên hạ', 1220.00, 121, '/upload/1713368925_a.jpg', '2024-04-16 01:09:26', '2024-04-17 08:48:45'),
(14, 10, 'cửu âm chân kinh', 'kim dung', '22', 1.00, 4, '/upload/1713368934_b.jpg', '2024-04-17 01:09:32', '2024-04-17 08:48:54'),
(15, 10, 'Cửu  dương thần công', 'kim dung', '45', 1.00, 54, '/upload/1713454862_tải xuống.jpg', '2024-04-17 01:11:49', '2024-04-18 08:41:02'),
(17, 10, 'Cửu  dương thần công', 'kim dung', '24', 1.00, 45, '/upload/1713368957_t.jpg', '2024-04-17 01:14:05', '2024-04-17 08:49:17'),
(18, 10, 'Cửu  dương thần công', 'kim dung', '452', 5.00, 45, '/upload/1713369025_e.jpg', '2024-04-17 01:24:17', '2024-04-17 08:50:25'),
(22, 10, 'Quỳ hoa bảo điển', 'Đông phương bất bại', 'võ công đệ nhất thiên hạ', 12000.00, 12, '/upload/1713495630_r.jpg', '2024-04-18 20:00:30', '2024-04-18 20:00:30'),
(23, 10, 'Dịch gân kinh', 'Phương chính đại sư', 'Võ công thiếu lâm', 10.00, 121, '/upload/1713495717_e.jpg', '2024-04-18 20:01:57', '2024-04-18 20:01:57'),
(25, 10, 'Long Trảo Thủ', 'Đại sư', 'tuyệt thế võ công', 500000.00, 25, '/upload/1713751059_t.jpg', '2024-04-21 18:57:39', '2024-04-21 18:57:39'),
(26, 10, 'Onepice', 'Eiichiro Oda', 'Vua hải Tặc', 2500000.00, 100, '/upload/1713752813_onepice.jpg', '2024-04-21 19:26:53', '2024-04-21 19:26:53'),
(27, 2, 'Chí phèo', 'Nam Cao', 'Làng Vũ Đại', 15000.00, 120, '/upload/1713754294_chí phèo.jpg', '2024-04-21 19:51:34', '2024-04-21 19:51:34'),
(28, 5, 'Cửu  dương thần công', 'kim dung', '112', 1212.00, 1221, '/upload/1713775303_duongqua.jpg', '2024-04-22 01:41:43', '2024-04-22 01:41:43'),
(29, 6, 'Quỳ hoa bảo điển', 'Đông phương bất bại', '1231', 123.00, 123, '/upload/1713775329_tây độc.jpg', '2024-04-22 01:42:09', '2024-04-22 01:42:09'),
(30, 2, 'Tịch tà kiếm phổ', 'Nhạc bất quần', 'Tự cung', 120000.00, 2500000, '/upload/1713925487_doccoquykiem.jpg', '2024-04-23 19:24:47', '2024-04-23 19:24:47');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `ghichu` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `ghichu`, `created_at`, `updated_at`) VALUES
(1, 'Tiểu thuyết', '', NULL, NULL),
(2, 'Truyện ngắn', '', NULL, NULL),
(3, 'Huyền bí', '', NULL, NULL),
(4, 'kinh điển', '', NULL, NULL),
(5, 'kiếm hiệp', '', NULL, NULL),
(6, 'lịch sử', '', NULL, NULL),
(7, 'Thơ', '', NULL, NULL),
(8, 'phưu lưu', '', NULL, NULL),
(9, 'khoa học viển tưởng', '', NULL, NULL),
(10, 'Khác', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chatprivate`
--

CREATE TABLE `chatprivate` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_send` int(11) NOT NULL,
  `id_sent` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chatprivate`
--

INSERT INTO `chatprivate` (`id`, `id_send`, `id_sent`, `created_at`, `updated_at`) VALUES
(1, 8, 1, NULL, NULL),
(3, 8, 11, NULL, NULL),
(4, 8, 3, '2024-05-07 02:52:06', '2024-05-07 02:52:06');

-- --------------------------------------------------------

--
-- Table structure for table `chatpublic`
--

CREATE TABLE `chatpublic` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_send` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chatpublic`
--

INSERT INTO `chatpublic` (`id`, `id_user`, `id_send`, `message`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'hello', NULL, NULL),
(2, 2, 3, 'hihi', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_book` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `id_book`, `id_user`, `comment`, `created_at`, `updated_at`) VALUES
(32, 12, 1, 'chi tiết sản phẩm', '2024-04-24 09:17:25', '2024-04-24 02:17:25'),
(33, 12, 1, '?/?', '2024-04-24 09:17:41', '2024-04-24 02:17:41'),
(34, 12, 1, ',,', '2024-04-24 09:17:51', '2024-04-24 02:17:51'),
(35, 12, 1, 'gg', '2024-04-24 09:18:58', '2024-04-24 02:18:58'),
(36, 12, 1, 'sdg', '2024-04-24 09:19:28', '2024-04-24 02:19:28'),
(37, 28, 1, 'nhìnb', '2024-05-02 02:36:44', '2024-05-01 19:36:44'),
(38, 27, 1, 'l;', '2024-05-02 08:14:29', '2024-05-02 01:14:29'),
(39, 12, 1, 'gfhj', '2024-05-02 08:19:13', '2024-05-02 01:19:13'),
(40, 14, 8, 'g', '2024-05-02 08:20:19', '2024-05-02 01:20:19'),
(41, 27, 1, 'không là gì cả', '2024-05-03 08:13:29', '2024-05-03 01:13:29'),
(42, 27, 1, 'mà sao e còn chờ mong', '2024-05-03 08:13:45', '2024-05-03 01:13:45'),
(43, 13, 1, 't', '2024-05-03 08:14:07', '2024-05-03 01:14:07'),
(44, 13, 1, 'fsd', '2024-05-03 08:15:52', '2024-05-03 01:15:52'),
(45, 13, 1, 'mà sao e còn chờ mong', '2024-05-03 08:16:00', '2024-05-03 01:16:00'),
(46, 29, 7, '.', '2024-05-03 08:44:30', '2024-05-03 01:44:30'),
(47, 29, 7, '...', '2024-05-03 08:44:39', '2024-05-03 01:44:39'),
(49, 27, 1, 'df', '2024-05-03 15:40:16', '2024-05-03 08:40:16');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Ten` varchar(255) DEFAULT NULL,
  `DiaChi` varchar(255) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `SoDienThoai` varchar(255) NOT NULL,
  `ghi_chu` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `Ten`, `DiaChi`, `Email`, `SoDienThoai`, `ghi_chu`, `created_at`, `updated_at`) VALUES
(17, 'Mô dung phục', 'qưer', 'tienhdg@gnail.com', '0366874875', 'qửe', '2024-04-17 06:33:57', NULL),
(18, 'Mộ Dung Bác', 'ádf', 'tienhdg@gnail.com', '0333666777', 'ádf', '2024-04-17 15:31:24', NULL),
(19, 'Mộ Dung Bác', 'sản phẩm', 'tienduc@gmail.com', '0368374871', 'thieyu', '2024-04-19 01:10:25', NULL),
(20, 'Lý Mạc Sầu', 'Tuyệt tình cốc', 'tien@gmail.com', '0366874871', 'không', '2024-04-19 07:43:10', NULL),
(21, 'Nam Đế', 'Đại lý tự', 'nam@gmail.com', '0368999874', 'không', '2024-04-19 07:49:15', NULL),
(22, 'Chu Bá Thông', 'Toàn   chân giáo', 'tienductvd@gmail.com', '0300838037', 'k', '2024-04-19 07:50:40', NULL),
(23, 'Giang Văn tài', 'Hà Nội', 'giang @gmail.com', '0366874212', 'Hàng dễ cháy', '2024-04-19 09:28:01', NULL),
(24, 'sd', 'ádfsa', 'tienduc@gmail.com', '0300838037', 'ádf', '2024-04-24 09:23:16', NULL),
(25, 'Mộ Dung Bác', 'sdfgfsdg', 'tienductvd@gmail.com', '0368374871', 'sdfgsdfg', '2024-04-24 09:34:53', NULL),
(26, 'Mộ Dung Bác', 'sdfgfsdg', 'tienductvd@gmail.com', '0368374871', 'sdfgsdfg', '2024-04-24 09:36:04', NULL),
(27, 'Mô dung phục', 'ưerwet', 'admin@example.com', '0300838037', 'ưertrwe', '2024-04-24 09:36:22', NULL),
(28, 'Trần6', '34563', 'admin@admin.com', '43563456', '3456', '2024-04-24 09:39:10', NULL),
(29, 'Mô dung phục', 'ewrtwe', 'tienduc@gmail.com', '0300838037', 'ưertwert', '2024-04-24 09:39:48', NULL),
(30, 'cao', 'ưer', 'tienductvd@gmail.com', '0368374871', 'ưer', '2024-04-24 09:41:46', NULL),
(31, NULL, 'sdgffsd', NULL, '0300838037', 'gsdf', '2024-04-24 09:51:46', NULL),
(32, NULL, 'Đại học thủy lợi', NULL, '0333666777', 'tuyệt thế', '2024-05-02 02:22:30', NULL),
(33, 'Mộ Dung Bác', 'hà nội', 'admin@example.com', '0368374871', 'không', '2024-05-02 02:31:40', NULL),
(34, 'Mộ Dung Bác', 'hà nội', 'admin@example.com', '0368374871', 'không', '2024-05-02 02:33:39', NULL),
(35, 'Mô dung phục', 'kk', 'admin@example.com', '0368374871', 'k[', '2024-05-02 02:33:55', NULL),
(36, NULL, 'sdfgsd', NULL, '0333666777', 'fg', '2024-05-02 04:39:26', NULL),
(37, NULL, '879078', NULL, '0368374871', '9009', '2024-05-02 04:42:41', NULL),
(38, NULL, 'ryurt', NULL, '0333666777', 'uytruy', '2024-05-02 08:22:36', NULL),
(39, NULL, '7', NULL, '0333666777', '8', '2024-05-03 08:16:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `evaluate`
--

CREATE TABLE `evaluate` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `evaluate`
--

INSERT INTO `evaluate` (`id`, `id_user`, `id_book`, `level`, `created_at`, `updated_at`) VALUES
(1, 1, 27, 4, '2024-04-23 05:44:04', '2024-05-03 08:40:10'),
(3, 1, 12, 3, '2024-04-23 07:07:07', '2024-05-02 01:16:17'),
(4, 1, 13, 5, '2024-04-23 07:27:09', '2024-04-23 00:44:22'),
(5, 6, 27, 2, '2024-04-23 07:43:41', '2024-04-23 00:43:41'),
(6, 8, 14, 2, '2024-05-02 08:20:15', '2024-05-02 01:20:23'),
(7, 7, 29, 4, '2024-05-03 08:43:41', '2024-05-03 01:43:41');

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
-- Table structure for table `like`
--

CREATE TABLE `like` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `like`
--

INSERT INTO `like` (`id`, `id_user`, `id_book`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, NULL),
(12, 1, 13, '2024-04-22 00:39:33', '2024-04-22 00:39:33'),
(13, 1, 14, '2024-04-22 00:39:44', '2024-04-22 00:39:44'),
(15, 1, 22, '2024-04-22 00:51:26', '2024-04-22 00:51:26'),
(16, 7, 12, '2024-04-22 00:52:28', '2024-04-22 00:52:28'),
(17, 6, 12, '2024-04-22 21:18:28', '2024-04-22 21:18:28'),
(18, 1, 12, '2024-04-24 02:22:51', '2024-04-24 02:22:51'),
(19, 1, 28, '2024-05-01 19:36:37', '2024-05-01 19:36:37'),
(20, 8, 27, '2024-05-02 01:19:50', '2024-05-02 01:19:50'),
(21, 8, 14, '2024-05-02 01:20:11', '2024-05-02 01:20:11'),
(22, 7, 29, '2024-05-03 01:43:46', '2024-05-03 01:43:46'),
(23, 1, 27, '2024-05-03 08:40:05', '2024-05-03 08:40:05');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_04_15_061250_create_books_table', 1),
(6, '2024_04_15_061526_create_customers_table', 2),
(7, '2024_04_15_061624_create_orders_table', 3),
(8, '2024_04_16_011712_create_roles_table', 4),
(9, '2024_04_16_024153_create_permissions_table', 5),
(10, '2024_04_16_024326_create_role_user_table', 5),
(11, '2024_04_16_024356_create_permission_role_table', 5),
(12, '2024_04_16_025932_create_posts_table', 6),
(13, '2024_04_16_043459_create_permissions_table', 7),
(14, '2024_04_16_043608_create_role_user_table', 8),
(15, '2024_04_16_043730_create_permission_role_table', 9),
(16, '2024_04_16_043840_create_role_user_table', 10),
(17, '2024_04_17_021251_create_orders_table', 11),
(18, '2024_04_18_091500_create_comment_table', 12),
(19, '2024_04_22_024526_create_category_table', 13),
(20, '2024_04_22_035037_create_like_table', 14),
(21, '2024_04_23_043127_create__evaluate_table', 15),
(22, '2024_04_23_043430_create_evaluate_table', 16),
(23, '2014_10_12_100000_create_password_resets_table', 17),
(24, '2024_05_07_041747_create_chatprivate_table', 18),
(25, '2024_05_07_042302_create_chatpublic_table', 19),
(26, '2024_05_07_070035_create_private_messages_table', 20);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ID_Sach` bigint(20) UNSIGNED NOT NULL,
  `ID_Kh` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `SoLuong` int(11) NOT NULL,
  `Gia` decimal(10,2) NOT NULL,
  `trang_thai` enum('hoanthanh','danggiao','huydon','khac') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `ID_Sach`, `ID_Kh`, `id_user`, `SoLuong`, `Gia`, `trang_thai`, `created_at`, `updated_at`) VALUES
(19, 10, 17, NULL, 13, 1456.00, 'hoanthanh', '2024-04-17 06:33:57', NULL),
(20, 12, 17, NULL, 6, 720000.00, 'hoanthanh', '2024-04-17 06:33:57', NULL),
(21, 10, 18, NULL, 2, 224.00, 'danggiao', '2024-04-17 15:31:24', NULL),
(22, 12, 18, NULL, 1, 120000.00, 'danggiao', '2024-04-17 15:31:24', NULL),
(23, 10, 19, NULL, 1, 112.00, 'danggiao', '2024-04-19 01:10:25', NULL),
(24, 12, 20, NULL, 49, 5880000.00, 'danggiao', '2024-04-19 07:43:10', NULL),
(25, 13, 20, NULL, 2, 2440.00, 'danggiao', '2024-04-19 07:43:10', NULL),
(26, 12, 21, NULL, 49, 5880000.00, 'danggiao', '2024-04-19 07:49:15', NULL),
(27, 13, 21, NULL, 2, 2440.00, 'danggiao', '2024-04-19 07:49:15', NULL),
(28, 12, 22, NULL, 1, 120000.00, 'danggiao', '2024-04-19 07:50:40', NULL),
(29, 12, 23, NULL, 1, 120000.00, 'danggiao', '2024-04-19 09:28:01', NULL),
(30, 12, 26, NULL, 1, 120000.00, 'danggiao', '2024-04-24 09:36:04', NULL),
(31, 27, 26, NULL, 1, 15000.00, 'danggiao', '2024-04-24 09:36:04', NULL),
(32, 12, 27, NULL, 1, 120000.00, 'danggiao', '2024-04-24 09:36:22', NULL),
(33, 12, 1, NULL, 1, 120000.00, 'danggiao', '2024-04-24 09:39:10', NULL),
(34, 12, 1, NULL, 1, 120000.00, 'danggiao', '2024-04-24 09:39:48', NULL),
(35, 12, 30, 1, 1, 120000.00, 'danggiao', '2024-04-24 09:41:46', NULL),
(36, 12, 31, 1, 2, 240000.00, 'danggiao', '2024-04-24 09:51:46', NULL),
(37, 13, 32, 1, 1, 1220.00, 'danggiao', '2024-05-02 02:22:30', NULL),
(38, 14, 32, 1, 2, 2.00, 'danggiao', '2024-05-02 02:22:30', NULL),
(39, 12, 34, NULL, 2, 240000.00, 'danggiao', '2024-05-02 02:33:39', NULL),
(40, 12, 35, NULL, 1, 120000.00, 'danggiao', '2024-05-02 02:33:55', NULL),
(41, 12, 36, 1, 1, 120000.00, 'danggiao', '2024-05-02 04:39:26', NULL),
(42, 14, 36, 1, 8, 8.00, 'danggiao', '2024-05-02 04:39:26', NULL),
(43, 27, 36, 1, 3, 45000.00, 'danggiao', '2024-05-02 04:39:26', NULL),
(44, 12, 37, 1, 5, 600000.00, 'danggiao', '2024-05-02 04:42:41', NULL),
(45, 14, 37, 1, 4, 4.00, 'danggiao', '2024-05-02 04:42:41', NULL),
(46, 18, 37, 1, 8, 40.00, 'danggiao', '2024-05-02 04:42:41', NULL),
(47, 12, 38, 8, 5, 600000.00, 'danggiao', '2024-05-02 08:22:36', NULL),
(48, 15, 38, 8, 13, 13.00, 'danggiao', '2024-05-02 08:22:36', NULL),
(49, 27, 39, 1, 1, 15000.00, 'danggiao', '2024-05-03 08:16:37', NULL);

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
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'create-post', 'Tạo bài viết', NULL, NULL),
(2, 'edit-post', 'Sửa bài viết', NULL, NULL),
(3, 'delete-post', 'Xóa bài viết', NULL, NULL),
(4, 'approve-comment', 'Duyệt bình luận', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 1, NULL, NULL),
(3, 3, 1, NULL, NULL),
(4, 1, 2, NULL, NULL),
(5, 2, 2, NULL, NULL),
(6, 1, 3, NULL, NULL);

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
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'test', 'thế thôi', 'bình yên', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `private_messages`
--

CREATE TABLE `private_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `private_chat_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `private_messages`
--

INSERT INTO `private_messages` (`id`, `private_chat_id`, `sender_id`, `message`, `created_at`, `updated_at`) VALUES
(3, 1, 8, 'có gì không', '2024-05-07 09:50:14', '2024-05-07 02:50:15'),
(4, 1, 1, 'không có việc gì thế', '2024-05-07 09:50:41', '2024-05-07 02:50:41'),
(5, 1, 8, 'thanh xuân', '2024-05-07 09:51:45', '2024-05-07 02:51:45'),
(6, 4, 8, 'dm', '2024-05-07 09:52:06', '2024-05-07 02:52:06'),
(7, 4, 8, 'có gì không', '2024-05-07 09:52:15', '2024-05-07 02:52:16'),
(8, 1, 1, 'quá tầm thường', '2024-05-07 09:54:20', '2024-05-07 02:54:21'),
(9, 1, 1, 'l', '2024-05-07 09:54:25', '2024-05-07 02:54:25'),
(10, 1, 1, 'thích chết không\\', '2024-05-07 09:54:32', '2024-05-07 02:54:33'),
(11, 1, 1, 'ÁD', '2024-05-07 09:59:51', '2024-05-07 02:59:51'),
(12, 1, 1, 'alo', '2024-05-07 14:37:48', '2024-05-07 07:37:50'),
(13, 1, 8, 'gì', '2024-05-07 14:38:00', '2024-05-07 07:38:01'),
(14, 1, 1, 'anh nhắn tin gì đấy', '2024-05-07 14:40:09', '2024-05-07 07:40:10'),
(15, 1, 1, 'địa chỉ', '2024-05-08 01:42:00', '2024-05-07 18:42:01');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Quản trị viên', NULL, NULL),
(2, 'EditorUser', 'Biên tập viên', NULL, NULL),
(3, 'User', 'Người dùng', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, '2024-04-24 00:53:57'),
(2, 1, 2, NULL, '2024-05-02 00:34:59'),
(3, 3, 3, NULL, NULL),
(4, 3, 5, '2024-04-18 08:29:57', '2024-04-18 08:29:57'),
(5, 3, 6, '2024-04-18 08:37:22', '2024-04-18 08:37:22'),
(6, 1, 7, '2024-04-18 19:40:04', '2024-04-18 19:40:04'),
(7, 3, 8, '2024-04-18 19:41:03', '2024-04-18 19:41:03'),
(8, 1, 10, '2024-04-18 20:14:25', '2024-04-18 20:14:25'),
(9, 1, 11, '2024-04-18 20:16:21', '2024-04-18 20:16:21'),
(10, 1, 12, '2024-04-18 20:32:46', '2024-04-18 20:32:46'),
(11, 3, 16, '2024-04-18 21:09:12', '2024-04-18 21:09:12'),
(12, 3, 17, '2024-04-18 21:13:50', '2024-04-18 21:13:50'),
(13, 1, 18, '2024-04-19 01:32:56', '2024-04-19 01:43:04'),
(14, 3, 19, '2024-04-19 01:39:37', '2024-04-19 01:39:37'),
(15, 3, 24, '2024-04-22 02:56:04', '2024-04-22 02:56:04'),
(16, 3, 25, '2024-04-22 21:11:15', '2024-04-22 21:11:15'),
(17, 3, 26, '2024-04-23 08:25:58', '2024-04-23 08:25:58'),
(18, 3, 27, '2024-04-24 01:01:30', '2024-04-24 01:01:30'),
(19, 3, 28, '2024-04-24 01:06:23', '2024-04-24 01:06:23'),
(20, 1, 29, '2024-04-24 01:41:42', '2024-04-24 01:41:42'),
(21, 3, 30, '2024-05-01 23:36:24', '2024-05-01 23:36:24'),
(22, 1, 31, '2024-05-01 23:41:09', '2024-05-01 23:41:09'),
(23, 3, 32, '2024-05-03 08:38:35', '2024-05-03 08:38:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `URL` varchar(120) DEFAULT NULL,
  `trang_thai` int(11) NOT NULL DEFAULT 0 COMMENT '0 : là chờ admin xác nhận \r\n1: là tài khoản đã được cấp phép hoạt động\r\n2 : khóa acc',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `URL`, `trang_thai`, `created_at`, `updated_at`) VALUES
(1, 'Trần Tiến Đức', 'admin@example.com', NULL, '$2y$12$6nI0EoiRLkSXiRSFFV2FgeweaKA3pUu77zSQeI5inNR6U.7sRk54S', NULL, '/upload/1713946014_quachtinhx.jpg', 1, NULL, '2024-04-24 08:06:54'),
(2, 'Editor', 'editor@example.com', NULL, '$2y$12$qUI3aScduBo/ZVyppOV15O5BF1VuYlPPhZcVrkCRqk8eiHm4vl0NO', NULL, '/upload/1713514983_kimluan.jpg', 1, NULL, '2024-05-02 07:34:59'),
(3, 'User', 'user@example.com', NULL, '$2y$12$fLG8yNv/J0TROYikMCklauIQOqjBXo6TsSj1Sns0yaWX/XPamUnOy', NULL, '/upload/1713515045_duongqua.jpg', 1, NULL, '2024-04-19 08:24:05'),
(5, 'Trần Tiến Đức', 'tienduc@gmail.com', NULL, '$2y$12$VABc6JsLhPw1LncHJ1m/sO9QFVUNtRFFvEzsphVJkVkx.Pe/5TWGK', NULL, '/upload/1713515148_tây độc.jpg', 1, '2024-04-18 15:29:57', '2024-04-19 08:25:48'),
(6, 'Trần Tiến Đức', 'haha@gmail.com', NULL, '$2y$12$3QrvynoOYD2B4FzVzlUH2.05ofbIewFxRsKdiSMti7Dt1KLanU3rW', NULL, '/upload/1713515161_đông tà.jpg', 1, '2024-04-18 15:37:22', '2024-04-22 18:31:19'),
(7, NULL, 'tuyet@gmail.com', NULL, '$2y$12$Y5juHg/nZAUj2WzM.RRWXeJ40Cq.vS6y3gd2PMEiocRg1EaI8zk7K', NULL, '/upload/1713944247_duongqua.jpg', 1, '2024-04-19 02:40:04', '2024-04-24 07:40:50'),
(8, 'Diệp phàm', 'diep@gmail.com', NULL, '$2y$12$bjN.60c3SAdTbFEZ83Li2uqfUSIeuobz.DE4R/zCVSJlkeiNkN0eW', NULL, '/upload/1713515203_dieu.jpg', 1, '2024-04-19 02:41:03', '2024-04-22 18:35:53'),
(10, 'Quách Tĩnh', 'quachtinh@gmail.com', NULL, '$2y$12$WyBGue3Yex38jwfOoRzQGONaORXipmYj.pvumsA.h5MxA2/GibwX2', NULL, '/upload/1713515213_dieucar.jpg', 1, '2024-04-19 03:14:25', '2024-04-22 22:57:08'),
(11, 'Quách đại hiệp', 'quach@gmail.com', NULL, '$2y$12$SOAwa/jsrIUtXiv3MY/5F.mV4wfwuGnTJ9YwIiefjsab//jIOufVa', NULL, '/upload/1713515227_avata.jpg', 1, '2024-04-19 03:16:21', '2024-04-22 18:56:32'),
(12, 'Kim luân pháp sư', 'kimluan@gmail.com', NULL, '$2y$12$RGriHlJSKKTQs0a1qBYiVO12i.H4ixn1vw7qEl1Ow1b8wKK1G45He', NULL, '/upload/1713497566_kimluan.jpg', 2, '2024-04-19 03:32:46', '2024-04-22 22:57:09'),
(13, 'Hoàng lão  tà', 'ta@gmail.com', NULL, '$2y$12$AUUQYiHLHiiMw3dVLeHLGOGm.K/AUA3217/7yAIOJgyZml8sRIInO', NULL, '/upload/1713499404_quachtinhx.jpg', 1, '2024-04-19 04:03:24', '2024-04-22 20:34:34'),
(14, 'hoàng lão tà', 'hoanglt@gmail.com', NULL, '$2y$12$dYYUQEBdI2YOL6OvwoKTceOSM.rWFTprYDxxaJRS/94E01GcyI2eS', NULL, '/upload/1713499598_quachtinhx.jpg', 1, '2024-04-19 04:06:38', '2024-04-22 20:40:20'),
(16, 'Hoàng Lão Tà', 'hoangexample@gmail.com', NULL, '$2y$12$bYolOaPsIEF2CQ93wX7y3eNI7q4s.dskGrqyoNClKh0WLDBGRhcai', NULL, '/upload/1713499752_b.jpg', 1, '2024-04-19 04:09:12', '2024-04-22 22:57:10'),
(17, 'Hồng thất công', 'thatcong@example.com', NULL, '$2y$12$lkQ1r0/O/f4XeYjZjrfd2.wBf6xh3RlcE1I0gmJNl4AmKCT40oR7O', NULL, '/upload/1713500030_t.jpg', 1, '2024-04-19 04:13:50', '2024-04-18 21:13:50'),
(18, 'Hư trúc', 'hutruc@example.com', NULL, '$2y$12$tpnLQubIibFeL5Jv4tUHRev1JWDnR7fCXSji.frCgvnd6CX4by4kW', NULL, '/upload/1713515576_hư  trúc.jpg', 1, '2024-04-19 08:32:56', '2024-04-19 08:43:04'),
(19, 'Trần Tiến Đức', 'rt@example.com', NULL, '$2y$12$iv4tupmcBS0vya8sVoq05.bpTpTWXnUQUX0pQFYMnqhzBGJmw3aJK', NULL, '/upload/1713515976_a.jpg', 1, '2024-04-19 08:39:36', '2024-04-19 01:39:37'),
(20, 'Cẩu tạp chủng', 'tienduc1123@gmail.com', NULL, '$2y$12$1/g1rpRBbo1SKjqy9qBx4OrM7bLoedx5k2NfAb9yYtJzMtylIZrTq', NULL, '/upload/1713779183_quachtinhx.jpg', 2, '2024-04-22 09:46:23', '2024-04-22 22:57:29'),
(21, 'thành công khôngcssf', 'tontai@gmail.com', NULL, '$2y$12$TeFPXbiMPK24k8NPww41wufAWJ9D5eK7ZbaQpXjdBaX5uXUTfA2ES', NULL, '/upload/1713779512_doccoquykiem.jpg', 1, '2024-04-22 09:51:52', '2024-04-22 20:44:35'),
(22, 'ádfasdfasdf', 'tuffsdfsdfyet@gmail.com', NULL, '$2y$12$xvm.v2ovM8.wl6ysL/GE3e3SrMcOc60VMBtPu8tAW5YzlonqxkGPq', NULL, '/upload/1713779619_b.jpg', 1, '2024-04-22 09:53:39', '2024-04-22 18:28:37'),
(23, 'ádfasdf', 'tuydffdfdsadet@gmail.com', NULL, '$2y$12$fwC7ns64ukfl4rDg0wE5OOpindjCV2T0.vmu7Z0c7R.fLpTaBenVO', NULL, '/upload/1713779700_b.jpg', 1, '2024-04-22 09:55:00', '2024-04-22 20:42:29'),
(24, 'người dùng facebook', 'nguoifung@gmail.com', NULL, '$2y$12$/l5VzrRh03MOVzO4F8A.iOdbdX4SrthaRaAhGatottiFo4pt/.weC', NULL, '/upload/1713779764_hư  trúc.jpg', 0, '2024-04-22 09:56:04', '2024-04-22 22:57:29'),
(25, 'Hoàng Kỳ Anh', 'tienductvd@gmail.com', NULL, '$2y$12$X0oSmw1OVaiz3jmHw2awDejGPnpAbsrEWGmfuxA.oD276RTYCQURu', NULL, '/upload/1713845475_duongqua.jpg', 2, '2024-04-23 04:11:15', '2024-05-03 01:52:01'),
(26, 'nguyễn văn hoài', 'dhoai8340@gmail.com', NULL, '$2y$12$dxYHAXItL0GBEae9b9cR0evuW4SttfOd6g50lhecfcKkDcNCoWP/a', NULL, '/upload/1713885958_chubathong.jpg', 0, '2024-04-23 15:25:58', '2024-05-01 23:58:55'),
(27, 'nguyễn duy khương', 'ducvnfx21916@funix.edu.vn', NULL, '$2y$12$lQo9x9Grdku5W2wQFikeMeJNzRBQzVjMxTcc7wGFacYN807eAgKdq', NULL, '/upload/1713945690_đông tà.jpg', 0, '2024-04-24 08:01:30', '2024-05-01 23:56:22'),
(28, 'khu', 'adfdmin@example.com', NULL, '$2y$12$zqfzUkPWUYFXywa1KtuRpe1HtfYEQp0JhY711iyo/6EXmCYvC4E7a', NULL, '/upload/1713945983_c.jpg', 0, '2024-04-24 08:06:22', '2024-04-24 01:48:19'),
(29, 'Trần Tiến Đức', 'admsdsđin@admin.com', NULL, '$2y$12$5IFUrUjr99CSyS6SB8ooUO7wTty2b00dQdGw2KmRhiQ2IIXpCmnJG', NULL, '/upload/1713948102_c.jpg', 2, '2024-04-24 08:41:41', '2024-04-24 01:48:06'),
(30, 'thành công khôngc', 'tret@gmail.com', NULL, '$2y$12$0ATFytfCvZotOOQINH9pOOM94Yk7/lF/K.Pm112afRY5jzxVGSjvK', NULL, '/upload/1714631784_dieucar.jpg', 1, '2024-05-02 06:36:24', '2024-05-01 23:46:53'),
(31, 'thành công khôngc', 'hahom@gmail.com', NULL, '$2y$12$5E3tS8YbUYXxt/ZG/Pq/DepaVetA3Lvz..VIMjXbh/t7gnsQ6CLiO', NULL, '/upload/1714632069_dieucar.jpg', 1, '2024-05-02 06:41:08', '2024-05-01 23:47:20'),
(32, 'nguyễn quang học', 'nqhoc@uneti.edu.vn', NULL, '$2y$12$ThVKSgELCeI21.UovjzS1eOFjEtFlUiTpTxpjDijLs9Sxi2bqmr.S', NULL, '/upload/1714750715_dieucar.jpg', 1, '2024-05-03 15:38:34', '2024-05-03 08:39:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chatprivate`
--
ALTER TABLE `chatprivate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chatpublic`
--
ALTER TABLE `chatpublic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluate`
--
ALTER TABLE `evaluate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `like`
--
ALTER TABLE `like`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `private_messages`
--
ALTER TABLE `private_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `chatprivate`
--
ALTER TABLE `chatprivate`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chatpublic`
--
ALTER TABLE `chatpublic`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `evaluate`
--
ALTER TABLE `evaluate`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `like`
--
ALTER TABLE `like`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `private_messages`
--
ALTER TABLE `private_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
