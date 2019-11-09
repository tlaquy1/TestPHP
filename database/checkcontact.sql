-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 09, 2019 lúc 10:51 AM
-- Phiên bản máy phục vụ: 10.4.6-MariaDB
-- Phiên bản PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `checkcontact`
--
CREATE DATABASE IF NOT EXISTS `checkcontact` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `checkcontact`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact`
--

CREATE TABLE `contact` (
  `ID` int(11) NOT NULL,
  `Ten` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `SDT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `contact`
--

INSERT INTO `contact` (`ID`, `Ten`, `Email`, `SDT`) VALUES
(1, 'Hoàng ML', 'hoangml@hoangml.com', 9001008),
(2, 'Hoàng ', 'hoangml@hoangml.com', 9001008),
(3, 'LamMl', 'lamMl@lamml.com', 12011151),
(4, 'Nhung', 'nhung@lamml.com', 12011151),
(5, 'Sang', 'hello@gmail.com', 11122331);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhan`
--

CREATE TABLE `nhan` (
  `MaNhan` varchar(10) NOT NULL,
  `TenNhan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `nhan`
--

INSERT INTO `nhan` (`MaNhan`, `TenNhan`) VALUES
('nhan1', 'banbe'),
('nhan2', 'nguoithan'),
('nhan3', 'giaovien');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tag`
--

CREATE TABLE `tag` (
  `ID` int(10) NOT NULL,
  `MaNhan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tag`
--

INSERT INTO `tag` (`ID`, `MaNhan`) VALUES
(1, 'nhan1'),
(1, 'nhan2'),
(1, 'nhan3'),
(2, 'nhan1'),
(2, 'nhan3'),
(3, 'nhan1'),
(4, 'nhan2');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `nhan`
--
ALTER TABLE `nhan`
  ADD PRIMARY KEY (`MaNhan`);

--
-- Chỉ mục cho bảng `tag`
--
ALTER TABLE `tag`
  ADD KEY `ID` (`ID`),
  ADD KEY `MaNhan` (`MaNhan`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `FK_ID` FOREIGN KEY (`ID`) REFERENCES `contact` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MaNhan` FOREIGN KEY (`MaNhan`) REFERENCES `nhan` (`MaNhan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
