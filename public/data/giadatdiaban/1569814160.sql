-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 24, 2019 lúc 06:17 AM
-- Phiên bản máy phục vụ: 10.1.25-MariaDB
-- Phiên bản PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `csdlgia_2019`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dmnganhkd`
--

CREATE TABLE `dmnganhkd` (
  `id` int(10) UNSIGNED NOT NULL,
  `manganh` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tennganh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `theodoi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `dmnganhkd`
--

INSERT INTO `dmnganhkd` (`id`, `manganh`, `tennganh`, `theodoi`, `created_at`, `updated_at`) VALUES
(1, 'BOG', 'Mặt hàng bình ổn giá', 'TD', NULL, NULL),
(2, 'VLXD', 'Vật liệu xây dựng', 'KTD', NULL, '2019-09-13 01:49:28'),
(3, 'XMTXD', 'Xi măng, thép xây dựng', 'TD', NULL, NULL),
(4, 'DVHDTMCK', 'Dịch vụ hỗ trợ hoạt động thương mại tại cửa khẩu', 'KTD', NULL, '2019-09-05 08:26:54'),
(5, 'THAN', 'Than', 'KTD', NULL, '2019-09-05 08:54:45'),
(6, 'TACN', 'Thức ăn chăn nuôi', 'TD', NULL, NULL),
(7, 'GIAY', 'Giấy in, viết (dạng cuộn), giấy in báo sản xuất trong nước', 'KTD', NULL, '2019-09-05 09:03:04'),
(8, 'SACH', 'Sách giáo khoa', 'KTD', NULL, '2019-09-05 09:03:12'),
(9, 'ETANOL', 'Etanol nhiên liệu không biến tính, khí tự nhiên hóa lỏng(LNG); khí thiên nhiên nén (CNG)', 'TD', NULL, NULL),
(10, 'KCBTN', 'Dịch vụ khám chữa bệnh cho người tại cơ sở khám chữa bệnh tư nhân; khám chữa bệnh theo yêu cầu tại cơ sở khám chữa bệnh của nhà nước', 'TD', NULL, NULL),
(11, 'TPCNTE6T', 'Thực phẩm chức năng cho trẻ em dưới 6 tuổi', 'TD', NULL, NULL),
(12, 'DVLT', 'Dịch vụ lưu trú', 'TD', NULL, NULL),
(13, 'DVVT', 'Dịch vụ vận tải', 'TD', NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `dmnganhkd`
--
ALTER TABLE `dmnganhkd`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `dmnganhkd`
--
ALTER TABLE `dmnganhkd`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
