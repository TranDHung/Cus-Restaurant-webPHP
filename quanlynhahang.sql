-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 19, 2021 lúc 03:42 PM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlynhahang`
--
CREATE DATABASE IF NOT EXISTS `quanlynhahang` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `quanlynhahang`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `id` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `ho` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ngaySinh` date NOT NULL,
  `gioi` int(11) NOT NULL,
  `userName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`id`, `ho`, `ten`, `ngaySinh`, `gioi`, `userName`, `password`, `type`) VALUES
('nv1', 'Trần Đức', 'Hưng', '2021-05-20', 1, 'quanly', '$2y$10$2A6Tid8pdn2qSy/K2NQpcukQrvJDSpGWio.u3bbWmmmx7UvF7zV.2', 1),
('nv2', 'Vũ Trung', 'Hậu', '2021-05-28', 1, 'vuhau', '$2y$10$WJl4E2sEmFr/uOeFhc2XTepcYCi/AJkOAwQ9xVRbxocBO913qri7i', 2),
('nv3', 'Nguyễn Hữu', 'Huy', '2021-05-22', 1, 'huuhuy', '$2y$10$SisBUHGD8iFZzw8yptc7u.lLOw5Kpv/gjce/FhrnM1OS8nstaEkqu', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dondat`
--

CREATE TABLE `dondat` (
  `id` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `tenkhach` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sdt` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `loaidon` int(11) NOT NULL,
  `phong` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `ngaydat` date NOT NULL,
  `giodat` time NOT NULL,
  `slkhach` int(11) NOT NULL,
  `monan` text COLLATE utf8_unicode_ci NOT NULL,
  `tongtien` int(11) NOT NULL,
  `trangthai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `dondat`
--

INSERT INTO `dondat` (`id`, `tenkhach`, `sdt`, `loaidon`, `phong`, `ngaydat`, `giodat`, `slkhach`, `monan`, `tongtien`, `trangthai`) VALUES
('DB00000001', 'Trần Đức Hưng', '0987477474', 2, 'pv4', '2021-05-13', '15:05:00', 15, 'kv1:1,mc1:1,tm1:1,kv11:1,mc11:2,mc12:2,tm8:2,kv13:1,', 6850000, 1),
('DB00000002', 'Trần Đức Hưng', '0987477474', 2, 'pv5', '2021-06-15', '15:34:00', 12, 'kv1:2,mc11:2,tm11:2,tm10:1,kv11:2,mc10:1,', 4240000, 0),
('DB00000003', 'Vũ Trung Hậu', '0987216221', 2, 'pv5', '2021-05-13', '15:42:00', 12, 'kv1:2,kv10:2,mc10:3,mc11:3,tm10:2,tm11:2,', 5960000, 0),
('DB00000004', 'Vu Trung Hau', '0999999999', 2, 'pv2', '2021-05-26', '15:23:00', 12, 'kv1:3,kv10:2,mc10:2,mc11:3,tm10:2,tm11:3,', 6120000, 0),
('DT00000001', 'Trần Đức Hưng', '0986599999', 1, 'pv7', '2021-04-28', '15:54:00', 65, 'kv1:2,mc10:2,tm11:2,kv11:1,mc11:2,', 13320000, 0),
('DT00000002', 'Nguyễn Hữu Huy', '0829921999', 1, 'pv8', '2021-05-16', '14:30:00', 50, 'kv1:2,kv10:2,kv11:2,mc10:2,mc11:2,mc12:2,tm11:3,tm2:3,', 14980000, 0),
('DT00000003', 'Nguyen Huu Huy', '097653333', 1, 'pv8', '2021-04-27', '12:22:00', 100, 'kv1:3,kv10:3,mc1:3,tm1:3,kv11:2,', 14300000, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `id` char(12) COLLATE utf8_unicode_ci NOT NULL,
  `nguoilap` char(100) COLLATE utf8_unicode_ci NOT NULL,
  `monan` text COLLATE utf8_unicode_ci NOT NULL,
  `phong` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tenkhach` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ngaylap` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `thanhtien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hoadon`
--

INSERT INTO `hoadon` (`id`, `nguoilap`, `monan`, `phong`, `tenkhach`, `ngaylap`, `thanhtien`) VALUES
('090521102909', 'Trần Đức Hưng', 'kv1:2,mc11:2,tm11:2,tm10:1,kv11:2,mc10:1,', 'pv5', 'Trần Đức Hưng', '09/05/2021', 5140000),
('090521160011', 'Trần ĐứcHưng', 'kv1:1,mc1:1,tm1:1,kv11:1,mc11:2,mc12:2,tm8:2,kv13:1,', 'pv4', 'Trần Đức Hưng', '09/05/2021', 9850000),
('140521144031', 'Trần Đức Hưng', 'kv1:1,mc10:1,tm10:1,', 'pt1', 'Trung Hậu', '14/05/2021', 1620000),
('190521203930', 'Trần Đức Hưng', 'kv1:3,kv10:3,mc1:3,tm1:3,kv11:2,', 'pv8', 'Nguyen Huu Huy', '19/05/2021', 14300000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `monan`
--

CREATE TABLE `monan` (
  `id` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `gia` int(11) NOT NULL,
  `anh` char(100) COLLATE utf8_unicode_ci NOT NULL,
  `vitri` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `monan`
--

INSERT INTO `monan` (`id`, `ten`, `gia`, `anh`, `vitri`) VALUES
('kv1', 'Avocado Shrimp', 200000, 'AvocadoShrimp.jpg', 1),
('kv10', 'Soupe l\'oignon', 400000, 'soupaloignon.jpg', 1),
('kv11', 'Soup Bouillabaise', 400000, 'soupbouillabaise.jpeg', 1),
('kv12', 'Soup Solyanka', 300000, 'soupsolyanka.jpg', 1),
('kv13', 'Spinach Artichoke', 250000, 'spinachart.jpg', 1),
('kv2', 'Bruschetta', 300000, 'bruschetta.jpg', 1),
('kv3', 'Chicken Avocado Roll Ups', 400000, 'chickenavocadorollups.jpg', 1),
('kv4', 'Chicken Parmegg Roll', 300000, 'chickenparmeggroll.jpg', 1),
('kv5', 'Mini Frittatas', 300000, 'minifrittatas.jpg', 1),
('kv6', 'Mozzarella Skewers', 400000, 'mozzarellaSkewers.jpg', 1),
('kv7', 'Ốc Sên nướng Pháp', 400000, 'ocsennuongphap.jpg', 1),
('kv8', 'Salade Nicoise', 250000, 'saladenicoise.jpg', 1),
('kv9', 'Smoked Salmon', 300000, 'smokedsalmon.jpg', 1),
('mc1', 'Bò Hầm Nấm', 500000, 'bohamnam.jpg', 2),
('mc10', 'Sunday Roast', 500000, 'sundayroast.jpg', 2),
('mc11', 'Sườn Cừu Nướng', 600000, 'suonnuong.jpeg', 2),
('mc12', 'Ức Vịt Sốt Cam', 350000, 'ucvitsotcam.jpg', 2),
('mc13', 'YorkShire', 400000, 'yorkshire.jpg', 2),
('mc2', 'Bò Nấu Tiêu Đen', 450000, 'bonautieuden.jpg', 2),
('mc3', 'Bosch Soup', 550000, 'boschsoup.jpg', 2),
('mc4', 'Bò Sống Parisa', 600000, 'bosongparisa.jpg', 2),
('mc5', 'Cozido', 500000, 'cozido.jpg', 2),
('mc6', 'Doner Kebab', 400000, 'donerkebab.jpg', 2),
('mc7', 'Gà Tây', 550000, 'gatay.jpg', 2),
('mc8', 'Rosti', 500000, 'rosti.jpg', 2),
('mc9', 'Spaghetti', 450000, 'spaghetti.jpg', 2),
('tm1', 'Bugnes Iyonnaises', 400000, 'bugneslyonnaises.jpg', 3),
('tm10', 'Pain Au Chocolat', 120000, 'painauchocolate.jpg', 3),
('tm11', 'Profiteroles', 160000, 'profiteroles.jpg', 3),
('tm12', 'Souffle', 100000, 'souffle.jpg', 3),
('tm13', 'Tarte Tatin', 130000, 'tartetatin.jpg', 3),
('tm2', 'Chocolate Pot De Creme', 200000, 'chocolatepotdecreme.jpeg', 3),
('tm3', 'Chocolate Souffle', 150000, 'chocolatesouffle.jpg', 3),
('tm4', 'Creme Brulee', 150000, 'cremebrulee.jpg', 3),
('tm5', 'Crepes', 130000, 'crepes.jpg', 3),
('tm6', 'Eclairs', 100000, 'eclairs.jpg', 3),
('tm7', 'Lemon Tart', 140000, 'lemontart.jpg', 3),
('tm8', 'Macaron', 100000, 'macaron.jpg', 3),
('tm9', 'Madeleines', 100000, 'madeleines.jpg', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phong`
--

CREATE TABLE `phong` (
  `id` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `kieuphong` int(11) NOT NULL,
  `gia` int(11) NOT NULL,
  `anh` char(100) COLLATE utf8_unicode_ci NOT NULL,
  `succhua` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phong`
--

INSERT INTO `phong` (`id`, `kieuphong`, `gia`, `anh`, `succhua`) VALUES
('pt1', 2, 800000, 'thuong1.jpg', 10),
('pt2', 2, 1300000, 'thuong2.jpg', 80),
('pt3', 2, 700000, 'thuong3.jpg', 20),
('pt4', 2, 1400000, 'thuong4.jpg', 150),
('pt5', 2, 1300000, 'thuong5.jpg', 50),
('pt6', 2, 2000000, 'thuong6.jpg', 250),
('pv1', 1, 1000000, 'phongvip1.jpg', 10),
('pv2', 1, 1200000, 'phongvip2.jpg', 20),
('pv3', 1, 2000000, 'phongvip3.jpg', 40),
('pv4', 1, 3000000, 'phongvip4.jpg', 80),
('pv5', 1, 900000, 'phongvip5.jpg', 10),
('pv6', 1, 7000000, 'phongvip6.jpg', 100),
('pv7', 1, 10000000, 'phongvip7.jpg', 200),
('pv8', 1, 9000000, 'phongvip8.jpg', 150);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`userName`);

--
-- Chỉ mục cho bảng `dondat`
--
ALTER TABLE `dondat`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `monan`
--
ALTER TABLE `monan`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
