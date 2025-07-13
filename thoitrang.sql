-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 06, 2024 lúc 05:37 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `thoitrang`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binhluan`
--

CREATE TABLE `binhluan` (
  `ID` int(11) NOT NULL,
  `IDKH` int(11) DEFAULT NULL,
  `IDSP` int(11) DEFAULT NULL,
  `binhLuan` text DEFAULT NULL,
  `ngayBL` text DEFAULT NULL,
  `star` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brand`
--

CREATE TABLE `brand` (
  `ID` int(11) NOT NULL,
  `tenBrand` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `brand`
--

INSERT INTO `brand` (`ID`, `tenBrand`) VALUES
(1, 'Bubberry'),
(2, 'Fendi'),
(3, 'Gucci'),
(4, 'Lacoste'),
(5, 'Hermes'),
(6, 'Balenciaga');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `ID` int(11) NOT NULL,
  `IDDH` int(11) DEFAULT NULL,
  `IDSP` int(11) NOT NULL,
  `soLuong` int(11) NOT NULL,
  `Size` varchar(100) NOT NULL,
  `tongTien` float NOT NULL,
  `cachThanhToan` varchar(100) DEFAULT NULL,
  `ten` varchar(100) DEFAULT NULL,
  `diaChi` varchar(200) DEFAULT NULL,
  `sdt` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `ghiChu` text DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`ID`, `IDDH`, `IDSP`, `soLuong`, `Size`, `tongTien`, `cachThanhToan`, `ten`, `diaChi`, `sdt`, `email`, `ghiChu`, `status`) VALUES
(361, 208, 58, 2, 'L', 1000000, 'Chuyển khoản ngân hàng', 'dshja', 'dsbhy', 'null', 'lily11@gmail.com', '', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhsachyeuthich`
--

CREATE TABLE `danhsachyeuthich` (
  `ID` int(11) NOT NULL,
  `IDKH` int(11) DEFAULT NULL,
  `IDSP` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `danhsachyeuthich`
--

INSERT INTO `danhsachyeuthich` (`ID`, `IDKH`, `IDSP`) VALUES
(582, 48, 56),
(583, 48, 56),
(584, 48, 56),
(585, 48, 56);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `ID` int(11) NOT NULL,
  `IDKH` int(11) NOT NULL,
  `ngayDat` date DEFAULT NULL,
  `tinhTrang` varchar(100) DEFAULT NULL,
  `phiGD` float NOT NULL,
  `giamGia` double NOT NULL DEFAULT 0,
  `tongTien` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`ID`, `IDKH`, `ngayDat`, `tinhTrang`, `phiGD`, `giamGia`, `tongTien`) VALUES
(208, 48, '2024-05-18', 'Đang xử lý', 29000, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giamgia`
--

CREATE TABLE `giamgia` (
  `ID` int(11) NOT NULL,
  `IDSK` int(11) DEFAULT NULL,
  `IDSP` int(11) DEFAULT NULL,
  `giaGiam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `giamgia`
--

INSERT INTO `giamgia` (`ID`, `IDSK`, `IDSP`, `giaGiam`) VALUES
(78, NULL, 55, 0),
(79, NULL, 56, 0),
(80, NULL, 57, 0),
(81, NULL, 58, 0),
(82, NULL, 59, 0),
(83, NULL, 60, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `ID` int(11) NOT NULL,
  `IDKH` int(11) DEFAULT NULL,
  `IDSP` int(11) DEFAULT NULL,
  `soLuong` int(11) DEFAULT NULL,
  `size` text NOT NULL,
  `tongTien` float DEFAULT NULL,
  `thoiGian` date DEFAULT NULL,
  `status` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `ID` int(11) NOT NULL,
  `IDTK` int(11) DEFAULT NULL,
  `hoTen` varchar(50) DEFAULT NULL,
  `ngaysinh` text DEFAULT NULL,
  `gioiTinh` varchar(50) NOT NULL,
  `sdt` varchar(20) DEFAULT NULL,
  `diachi` varchar(100) DEFAULT NULL,
  `ranks` int(30) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`ID`, `IDTK`, `hoTen`, `ngaysinh`, `gioiTinh`, `sdt`, `diachi`, `ranks`, `image`) VALUES
(45, 44, 'nhatus', '2004-02-02', 'Nam', 'null', 'hdh', 0, 'Public/image/Avatar/noavatar.png'),
(47, 46, 'Ly', '2004-02-02', 'Nam', 'null', 'bd', 0, 'Public/image/Avatar/noavatar.png'),
(48, 47, 'hoang', '2020-02-02', 'Nam', 'null', 'vgds', 0, 'Public/image/Avatar/kt2024_05_10_03_04_40.png'),
(49, 48, 'dshja', '2004-02-02', 'Nam', 'null', 'dsbhy', 0, 'Public/image/Avatar/noavatar.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kichthuoc`
--

CREATE TABLE `kichthuoc` (
  `ID` int(11) NOT NULL,
  `size` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `kichthuoc`
--

INSERT INTO `kichthuoc` (`ID`, `size`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(4, 'XL'),
(5, '2XL'),
(6, '3XL');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichsubanhang`
--

CREATE TABLE `lichsubanhang` (
  `ID` int(11) NOT NULL,
  `IDKH` int(11) DEFAULT NULL,
  `IDSP` int(11) DEFAULT NULL,
  `soLuong` int(11) DEFAULT NULL,
  `ngayBan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `magiam`
--

CREATE TABLE `magiam` (
  `ID` int(11) NOT NULL,
  `IDSK` int(11) DEFAULT NULL,
  `codes` varchar(100) DEFAULT NULL,
  `giagiam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `magiam`
--

INSERT INTO `magiam` (`ID`, `IDSK`, `codes`, `giagiam`) VALUES
(10, 75, '123', 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mausac`
--

CREATE TABLE `mausac` (
  `ID` int(11) NOT NULL,
  `tenMau` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `mausac`
--

INSERT INTO `mausac` (`ID`, `tenMau`) VALUES
(1, 'Xanh lá'),
(2, 'Nâu'),
(3, 'Trắng'),
(4, 'Đen'),
(5, 'Vàng'),
(6, 'Đỏ'),
(7, 'Hồng'),
(8, 'Tím');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `ID` int(11) NOT NULL,
  `IDLoai` int(11) DEFAULT NULL,
  `IDBrand` int(11) DEFAULT NULL,
  `IDSize` int(11) DEFAULT NULL,
  `IDMau` int(11) DEFAULT NULL,
  `IDSX` int(11) DEFAULT NULL,
  `tenSP` varchar(200) DEFAULT NULL,
  `giaSP` float DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `image1` text NOT NULL,
  `image2` text NOT NULL,
  `moTa` text NOT NULL,
  `congDung` text NOT NULL,
  `suDung` text NOT NULL,
  `gioiThieuTH` text NOT NULL,
  `combo` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`ID`, `IDLoai`, `IDBrand`, `IDSize`, `IDMau`, `IDSX`, `tenSP`, `giaSP`, `image`, `image1`, `image2`, `moTa`, `congDung`, `suDung`, `gioiThieuTH`, `combo`, `status`) VALUES
(55, 7, 1, 1, 2, 2, 'Áo Thun Nữ Tay Ngắn Trơn 100% Cotton Form Regular', 250000, 'Public/image/at3.png', 'Public/image/at2.png', 'Public/image/at1.png', 'Áo Thun Nữ Tay Ngắn - 10S24TSSW001 là sản phẩm thời trang cao cấp được Routine đầu tư kỹ lưỡng từ khâu thiết kế đến khâu sản xuất. Item này phù hợp để làm người bạn đồng hành cùng bạn chinh phục mọi phong cách thời trang trong cuộc sống hằng ngày nhờ những đặc điểm nổi bật', 'Chất liệu 100% Cotton: Được tạo thành từ sợi bông tự nhiên mang lại cảm giác mềm mịn và dễ chịu khi tiếp xúc.', 'Có khả năng thấm hút mồ hôi tốt giúp người mặc cảm thấy khô ráo và thoáng mát hơn trong những ngày nắng nóng.', 'Kiểu áo phù hợp cho cả đi học, đi làm hay đi du lịch, dễ mix cùng nhiều trang phục khác nhau.', NULL, 1),
(56, 12, 4, 3, 3, 2, 'Chân Váy Midi Nữ Lưng Thun Xếp Ly Trơn Form Aline', 152000, 'Public/image/tt.png', 'Public/image/t1.png', 'Public/image/p.png', 'Chân Váy Midi Nữ Lưng Thun Xếp Ly Trơn Form Aline - 10S23SKIW003 được thiết kế theo form dáng váy chữ A hiện đại và nữ tính', 'Thiết kế tông màu trung tính dễ kết hợp cũng nhiều trang phục khác', 'Là một chiếc chân váy đa-zi-năng có thể sử dụng trong nhiều hoàn cảnh đi học, đi làm, dạo phố,... và có thể phù hợp với nhiều phong cách.', 'Lưng váy được may thun và thiết kế xếp ly tạo độ bồng bềnh, mang vẻ đẹp nữ tính cho các nàng', NULL, 1),
(57, 9, 5, 5, 4, 5, 'Quần Jean Lưng Gài Ống Đứng Vải Cotton', 300000, 'Public/image/j.png', 'Public/image/jj.png', 'Public/image/jj1.png', 'Chất liệu Chất Lượng: Bắt đầu một cuộc hành trình phong cách với những chiếc quần jeans nam được làm từ chất liệu vải denim chất lượng cao. Sự kết hợp giữa độ bền và tính linh hoạt của denim không chỉ mang lại sự thoải mái mà còn giữ cho bạn luôn trông sạch sẽ và lịch lãm.', 'Thiết Kế Đa Dạng: Từ dáng skinny, slim fit đến straight-leg hoặc bootcut, chúng tôi mang đến sự đa dạng trong thiết kế để phản ánh phong cách cá nhân của bạn. Với các chi tiết như túi tiện ích, đường nét chắc chắn và cổ điển, quần jeans nam của chúng tôi không chỉ là một lựa chọn thời trang mà còn là biểu tượng của sự tự tin và cá tính.', 'Từ công việc hàng ngày đến giải trí, từ việc quản lý tài chính đến việc kết nối với bạn bè, ứng dụng của chúng tôi là đối tác lý tưởng cho mọi tình huống. Với tính linh hoạt và tính năng đa dạng, bạn sẽ luôn tìm thấy điều bạn cần để làm cho ngày của mình trở nên suôn sẻ và thú vị hơn bao giờ hết.', 'no', NULL, 1),
(58, 10, 2, 3, 3, 2, 'Áo Blazer Form Ngắn Tay Dài Phối Túi Giả', 500000, 'Public/image/bll.png', 'Public/image/bl1.png', 'Public/image/bl.png', 'Chất liệu chéo Hàn đứng form, cứng cáp mềm mại có độ bền cao và dày dặn, mát da.', 'Mang đến sự tinh tế và phong cách cho bất kỳ trang phục nào, áo blazer nữ là một mảnh ghép không thể thiếu trong tủ quần áo của mọi phụ nữ hiện đại. Với kiểu dáng và cắt may đặc biệt, chúng tôi cam kết mang đến cho bạn sự tự tin và quyền lực mỗi khi mặc.', 'Áo blazer nữ không chỉ là một mảnh ghép trong tủ quần áo, mà còn là biểu tượng của sự tự tin và quyến rũ. Kết hợp với quần jean, chân váy hoặc đầm, áo blazer nữ mang lại một phong cách đầy mê hoặc và chuyên nghiệp, phản ánh sự mạnh mẽ và năng động của người phụ nữ hiện đại.', 'Tích hợp một số lượng lớn các tính năng hiệu năng, áo blazer nữ không chỉ làm cho bạn trở nên tự tin mà còn mang lại sự thoải mái và linh hoạt trong mọi tình huống. Với chất liệu vải cao cấp và đường may tỉ mỉ, chúng tôi đảm bảo rằng bạn sẽ luôn cảm thấy thoải mái và tự tin suốt cả ngày dài.', NULL, 1),
(59, 14, 1, 6, 1, 8, 'Áo Nỉ Lacoste Nữ Oversize Hai Mặt', 450000, 'Public/image/h.png', 'Public/image/h1.png', 'Public/image/hh.png', 'Chiếc áo nỉ này kết hợp đường cắt hiện đại với chất liệu vải piqué hai mặt. Nổi bật với cổ áo có gân và kiểu dáng thể thao, thoải mái, bên trên là hình thêu René Lacoste mang tính biểu tượng.', 'Main fabric: Cotton (52%), Polyester (41%), Elastane (7%) / Rib edge: Cotton (98%), Elastane (2%)', 'Dáng oversize, đường cắt rộng với vai trễ', 'Sản phẩm Lacoste với chất liệu cotton và màu nhuộm tự nhiên lưu ý cách bảo quản tốt nhất là giặt bằng tay không giặt máy, sử dụng dầu gội – sữa tắm hoặc nước giặt không có nồng độ chất tẩy cao', NULL, 1),
(60, 40, 1, 3, 1, 2, 'Jumsuit 2 Dây', 360000, 'Public/image/ju.png', 'Public/image/ju1.png', 'Public/image/ju2.png', 'Được chế tác từ chất liệu vải thô tinh tế, sản phẩm đem lại cảm giác thoải mái và thoáng mát mỗi khi diện.', 'Jumpsuit được thiết kế với phần thân áo hai dây cúp ngực, tạo nên vẻ gợi cảm và nữ tính. Bên cạnh đó, thân áo của sản phẩm được may bằng 2 tầng bèo xếp tầng, mang đến một diện mạo phong cách và trẻ trung.', 'Thiết kế là một lựa chọn tuyệt vời cho các dịp, từ buổi dạo phố đến các sự kiện đặc biệt.', 'Khi phơi quần áo, hãy chọn nơi thoáng đãng và có ánh sáng nhẹ để tránh bị ẩm và mốc.', NULL, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sukien`
--

CREATE TABLE `sukien` (
  `ID` int(11) NOT NULL,
  `tenSK` varchar(200) DEFAULT NULL,
  `ngayBD` text DEFAULT NULL,
  `ngayKT` text DEFAULT NULL,
  `noiDung` text DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sukien`
--

INSERT INTO `sukien` (`ID`, `tenSK`, `ngayBD`, `ngayKT`, `noiDung`, `image`) VALUES
(75, 'Sự kiện mùa hè', '2023-12-08', '2023-11-08', 'Vui chơi mùa hè săn sale', 'Public/image/SuKien/vector 5196 sale-poster-with-eventful-percent-discount.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `ID` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `passwords` varchar(200) DEFAULT NULL,
  `role` varchar(50) NOT NULL,
  `checktk` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`ID`, `email`, `passwords`, `role`, `checktk`, `status`) VALUES
(44, 'user123@gmail.com', '$2y$10$qonpnbDKCsTjRgWtbRFDD.MXUxjhFukIBYJ9HbrQcJa6VEOOyNmvi', 'user', 0, 0),
(46, 'lyly@gmail.com', '$2y$10$HqxTU.gSoWTtxIeI4o.0JOksVFwxyseBn/mZ.cQXyty6JGiIMnOTS', 'admin', 0, 1),
(47, 'hoang@gmail.com', '$2y$10$OXso/1YThHPJwTmhhjcHCeJuOUHmmZRQoNdbASOEBO1UUv1jfQYoK', 'user', 0, 1),
(48, 'lily11@gmail.com', '$2y$10$2Bt8p8fu1lvlV.KSb88BGuvpRElgVzweyieEWuTUj5g9CqPT2lz2S', 'admin', 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `theloai`
--

CREATE TABLE `theloai` (
  `ID` int(11) NOT NULL,
  `tenTL` varchar(100) DEFAULT NULL,
  `Loai` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `theloai`
--

INSERT INTO `theloai` (`ID`, `tenTL`, `Loai`) VALUES
(2, 'Sơ Mi', '0'),
(7, 'Áo Thun', '0'),
(8, 'Áo Vest', '0'),
(9, 'Quần Jeans Nam', '0'),
(10, 'Áo Blazers', '1'),
(11, 'Đầm', '1'),
(12, 'Chân váy', '1'),
(14, 'Hoodies', '1'),
(15, 'Đầm Thun', '2'),
(16, 'Đầm Công Sở', '2'),
(40, 'JumSuit', '2'),
(42, 'Đầm Midi', '2'),
(44, 'Balo & Ví', '3'),
(45, 'Phụ Kiện', '3'),
(46, 'Túi', '3'),
(47, 'Giày', '3');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tintuc`
--

CREATE TABLE `tintuc` (
  `ID` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `date_at` date DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `category` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tintuc`
--

INSERT INTO `tintuc` (`ID`, `title`, `date_at`, `content`, `image`, `category`) VALUES
(40, 'BƯỚC VÀO THẾ GIỚI KỲ DIỆU CỦA THỜI TRANG', '2022-11-30', '\"Chào mừng bạn đến với cửa hàng thời trang của chúng tôi! Chúng tôi tự hào mang đến cho bạn những xu hướng thời trang mới nhất và đa dạng, từ những bộ trang phục đơn giản hàng ngày đến những bộ trang phục lịch lãm cho các dịp đặc biệt.\"', './Public/image/a4.png', 1),
(41, 'THỜI TRANG XU HƯỚNG', '2022-11-30', 'Tại cửa hàng của chúng tôi, chúng tôi cam kết chỉ cung cấp những sản phẩm thời trang chất lượng, được lựa chọn kỹ lưỡng để đảm bảo sự hài lòng của khách hàng. Chúng tôi không chỉ tập trung vào việc mang lại sự thời trang mà còn quan trọng hơn, làm cho bạn cảm thấy tự tin và thoải mái trong bất kỳ bộ trang phục nào bạn chọn.', './Public/image/a5.png', 1),
(42, 'Đặt Hàng Trực Tuyến, Linh Hoạt Và Nhanh Chóng', '2022-12-01', 'Hệ thống đặt hàng trực tuyến của VIETST được nâng cấp để đáp ứng tất cả các nhu cầu của khách hàng. Cho phép họ tùy chỉnh món ăn theo sở thích cá nhân, và giao hàng được thực hiện nhanh chóng và chính xác.', './Public/image/pv.png', 2),
(43, 'Khuyến Mãi và Ưu Đãi - Hấp Dẫn và Đa Dạng', '2022-12-01', 'Để tri ân sự ủng hộ của khách hàng, VIETST liên tục tung ra các chương trình khuyến mãi và ưu đãi hấp dẫn. Từ giảm giá đặc biệt cho đơn hàng lớn đến gói combo tiết kiệm, VIETST không ngừng đổi mới để làm hài lòng khách hàng.', './Public/image/sp.png', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `xuatxu`
--

CREATE TABLE `xuatxu` (
  `ID` int(11) NOT NULL,
  `tenSX` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `xuatxu`
--

INSERT INTO `xuatxu` (`ID`, `tenSX`) VALUES
(2, 'Hàn Quốc'),
(4, 'Nga'),
(5, 'Hoa Kỳ'),
(6, 'Nhật Bản'),
(8, 'Pháp'),
(19, 'Việt Nam');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDKH` (`IDKH`),
  ADD KEY `IDSP` (`IDSP`);

--
-- Chỉ mục cho bảng `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDDH` (`IDDH`);

--
-- Chỉ mục cho bảng `danhsachyeuthich`
--
ALTER TABLE `danhsachyeuthich`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDKH` (`IDKH`),
  ADD KEY `IDSP` (`IDSP`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDKH` (`IDKH`);

--
-- Chỉ mục cho bảng `giamgia`
--
ALTER TABLE `giamgia`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDSK` (`IDSK`),
  ADD KEY `IDSP` (`IDSP`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDKH` (`IDKH`),
  ADD KEY `IDSP` (`IDSP`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDTK` (`IDTK`);

--
-- Chỉ mục cho bảng `kichthuoc`
--
ALTER TABLE `kichthuoc`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `lichsubanhang`
--
ALTER TABLE `lichsubanhang`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDKH` (`IDKH`),
  ADD KEY `IDSP` (`IDSP`);

--
-- Chỉ mục cho bảng `magiam`
--
ALTER TABLE `magiam`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDSK` (`IDSK`);

--
-- Chỉ mục cho bảng `mausac`
--
ALTER TABLE `mausac`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDLoai` (`IDLoai`),
  ADD KEY `IDBrand` (`IDBrand`),
  ADD KEY `IDSize` (`IDSize`),
  ADD KEY `IDMau` (`IDMau`),
  ADD KEY `IDSX` (`IDSX`);

--
-- Chỉ mục cho bảng `sukien`
--
ALTER TABLE `sukien`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `theloai`
--
ALTER TABLE `theloai`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `xuatxu`
--
ALTER TABLE `xuatxu`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=283;

--
-- AUTO_INCREMENT cho bảng `brand`
--
ALTER TABLE `brand`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=362;

--
-- AUTO_INCREMENT cho bảng `danhsachyeuthich`
--
ALTER TABLE `danhsachyeuthich`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=586;

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT cho bảng `giamgia`
--
ALTER TABLE `giamgia`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT cho bảng `giohang`
--
ALTER TABLE `giohang`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1961;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT cho bảng `kichthuoc`
--
ALTER TABLE `kichthuoc`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `lichsubanhang`
--
ALTER TABLE `lichsubanhang`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT cho bảng `magiam`
--
ALTER TABLE `magiam`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `mausac`
--
ALTER TABLE `mausac`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT cho bảng `sukien`
--
ALTER TABLE `sukien`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `theloai`
--
ALTER TABLE `theloai`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `xuatxu`
--
ALTER TABLE `xuatxu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD CONSTRAINT `binhluan_ibfk_1` FOREIGN KEY (`IDKH`) REFERENCES `khachhang` (`ID`),
  ADD CONSTRAINT `binhluan_ibfk_2` FOREIGN KEY (`IDSP`) REFERENCES `sanpham` (`ID`);

--
-- Các ràng buộc cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD CONSTRAINT `chitietdonhang_ibfk_1` FOREIGN KEY (`IDDH`) REFERENCES `donhang` (`ID`);

--
-- Các ràng buộc cho bảng `danhsachyeuthich`
--
ALTER TABLE `danhsachyeuthich`
  ADD CONSTRAINT `danhsachyeuthich_ibfk_1` FOREIGN KEY (`IDKH`) REFERENCES `khachhang` (`ID`),
  ADD CONSTRAINT `danhsachyeuthich_ibfk_2` FOREIGN KEY (`IDSP`) REFERENCES `sanpham` (`ID`);

--
-- Các ràng buộc cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_1` FOREIGN KEY (`IDKH`) REFERENCES `khachhang` (`ID`);

--
-- Các ràng buộc cho bảng `giamgia`
--
ALTER TABLE `giamgia`
  ADD CONSTRAINT `giamgia_ibfk_1` FOREIGN KEY (`IDSK`) REFERENCES `sukien` (`ID`),
  ADD CONSTRAINT `giamgia_ibfk_2` FOREIGN KEY (`IDSP`) REFERENCES `sanpham` (`ID`);

--
-- Các ràng buộc cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `giohang_ibfk_1` FOREIGN KEY (`IDKH`) REFERENCES `khachhang` (`ID`),
  ADD CONSTRAINT `giohang_ibfk_2` FOREIGN KEY (`IDSP`) REFERENCES `sanpham` (`ID`);

--
-- Các ràng buộc cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD CONSTRAINT `khachhang_ibfk_1` FOREIGN KEY (`IDTK`) REFERENCES `taikhoan` (`ID`);

--
-- Các ràng buộc cho bảng `lichsubanhang`
--
ALTER TABLE `lichsubanhang`
  ADD CONSTRAINT `lichsubanhang_ibfk_1` FOREIGN KEY (`IDKH`) REFERENCES `khachhang` (`ID`),
  ADD CONSTRAINT `lichsubanhang_ibfk_2` FOREIGN KEY (`IDSP`) REFERENCES `sanpham` (`ID`);

--
-- Các ràng buộc cho bảng `magiam`
--
ALTER TABLE `magiam`
  ADD CONSTRAINT `magiam_ibfk_1` FOREIGN KEY (`IDSK`) REFERENCES `sukien` (`ID`);

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`IDLoai`) REFERENCES `theloai` (`ID`),
  ADD CONSTRAINT `sanpham_ibfk_2` FOREIGN KEY (`IDBrand`) REFERENCES `brand` (`ID`),
  ADD CONSTRAINT `sanpham_ibfk_3` FOREIGN KEY (`IDSize`) REFERENCES `kichthuoc` (`ID`),
  ADD CONSTRAINT `sanpham_ibfk_4` FOREIGN KEY (`IDMau`) REFERENCES `mausac` (`ID`),
  ADD CONSTRAINT `sanpham_ibfk_5` FOREIGN KEY (`IDSX`) REFERENCES `xuatxu` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
