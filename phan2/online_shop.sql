-- online_shop.sql - CSDL cho bài tập PHP-MySQL
-- Import bằng phpMyAdmin (tab Import) hoặc: mysql -u root < online_shop.sql
-- Import lại nhiều lần được: bảng nguoi_dung giữ nguyên dữ liệu, các bảng còn lại được tạo lại từ đầu

CREATE DATABASE IF NOT EXISTS online_shop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE online_shop;

-- ========== TẠO CÁC BẢNG ==========

-- Bảng người dùng (Phần 2)
-- Khác đề Phần 2: gioitinh dùng TINYINT thay BIT vì mysqli trả BIT về dạng nhị phân, so sánh == 0 bị sai
CREATE TABLE IF NOT EXISTS nguoi_dung (
    username    VARCHAR(20)  NOT NULL,
    password    VARCHAR(255) NOT NULL,   -- mật khẩu đã mã hóa MD5
    hoten       VARCHAR(50)  NOT NULL,
    gioitinh    TINYINT(1)   NOT NULL,   -- 0: Nam, 1: Nữ
    quocgia     VARCHAR(30)  NOT NULL,
    hinhdaidien TEXT         NOT NULL,   -- chỉ lưu đường dẫn ảnh, không lưu ảnh
    PRIMARY KEY (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS sach;          -- xóa sach trước vì sach có khóa ngoại trỏ tới loai_sach
DROP TABLE IF EXISTS loai_sach;
DROP TABLE IF EXISTS admin;

-- 1. Bảng loại sách
CREATE TABLE loai_sach (
    maloai  VARCHAR(5)   NOT NULL,
    tenloai VARCHAR(100) NOT NULL,
    PRIMARY KEY (maloai)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Bảng sách
CREATE TABLE sach (
    idsach   INT          NOT NULL AUTO_INCREMENT,
    tensach  VARCHAR(100) NOT NULL,
    tacgia   VARCHAR(100) NOT NULL,
    mota     TEXT,
    sotrang  INT,
    dongia   INT,
    hinhsach TEXT,
    maloai   VARCHAR(5)   NOT NULL,
    PRIMARY KEY (idsach),
    FOREIGN KEY (maloai) REFERENCES loai_sach (maloai)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Bảng quản trị
CREATE TABLE admin (
    useradmin VARCHAR(20) NOT NULL,
    passadmin TEXT        NOT NULL,
    PRIMARY KEY (useradmin)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========== NHẬP DỮ LIỆU MẪU ==========

-- 2 người dùng, mật khẩu mã hóa bằng hàm MD5 (mật khẩu gốc: 123456)
INSERT IGNORE INTO nguoi_dung (username, password, hoten, gioitinh, quocgia, hinhdaidien) VALUES
('nguyenvana', MD5('123456'), 'Nguyễn Văn A', 0, 'Việt Nam', ''),
('tranthib',   MD5('123456'), 'Trần Thị B',   1, 'Việt Nam', '');

-- 2 quản trị viên, mật khẩu mã hóa bằng hàm MD5
INSERT INTO admin (useradmin, passadmin) VALUES
('admin',   MD5('admin123')),
('quantri', MD5('123456'));

-- 5 loại sách
INSERT INTO loai_sach (maloai, tenloai) VALUES
('ML001', 'Du lịch'),
('ML002', 'Xây dựng'),
('ML003', 'Công nghệ thông tin'),
('ML004', 'Văn học'),
('ML005', 'Phát triển bản thân');

-- 10 cuốn sách, hình lấy từ thư mục hinhanh của dự án
INSERT INTO sach (tensach, tacgia, mota, sotrang, dongia, hinhsach, maloai) VALUES
('Một vòng quanh châu Á', 'Nhiều tác giả', 'Giới thiệu các điểm đến nổi tiếng, văn hóa và ẩm thực của các nước châu Á.', 220, 65000, 'hinhanh/136452.jpg', 'ML001'),
('Du lịch thế giới - Châu Á', 'Nhiều tác giả', 'Cẩm nang du lịch các quốc gia châu Á: danh lam thắng cảnh, lễ hội, kinh nghiệm đi lại.', 180, 55000, 'hinhanh/139075.jpg', 'ML001'),
('Du lịch thế giới - Châu Âu', 'Nhiều tác giả', 'Cẩm nang du lịch các nước châu Âu với những công trình kiến trúc và thành phố nổi tiếng.', 196, 58000, 'hinhanh/139076.jpg', 'ML001'),
('Các phương pháp thi công xây dựng', 'Ngô Văn Quỳ', 'Trình bày các phương pháp và kỹ thuật thi công công trình xây dựng dân dụng và công nghiệp.', 350, 95000, 'hinhanh/143801.jpg', 'ML002'),
('Các mẹo hay khi sử dụng máy tính', 'Phạm Quang Huy', 'Tổng hợp các thủ thuật giúp sử dụng máy tính và phần mềm văn phòng hiệu quả hơn.', 240, 48000, 'hinhanh/144337.jpg', 'ML003'),
('Tin học văn phòng - Windows XP', 'Phạm Quang Huy', 'Hướng dẫn sử dụng hệ điều hành Windows XP từ cơ bản đến nâng cao.', 280, 52000, 'hinhanh/144343.jpg', 'ML003'),
('Tự học JavaScript', 'Phạm Quang Hiển', 'Tự học lập trình JavaScript qua các ví dụ thực hành cho trang web.', 320, 75000, 'hinhanh/144571.jpg', 'ML003'),
('Kỹ thuật số - Flip-flop, thanh ghi, bộ đếm', 'Nguyễn Hữu Phương', 'Kiến thức về flip-flop, thanh ghi và bộ đếm trong mạch điện tử số.', 200, 45000, 'hinhanh/73900.jpg', 'ML003'),
('Mộng đời bất tuyệt', 'Nguyễn Tường Bách', 'Tiểu thuyết về những ước mơ và số phận con người qua nhiều biến động của cuộc đời.', 400, 88000, 'hinhanh/144220.jpg', 'ML004'),
('Vượt qua thử thách', 'Nhiều tác giả', 'Những câu chuyện truyền cảm hứng giúp bạn đứng dậy sau thất bại và vượt qua khó khăn.', 160, 42000, 'hinhanh/144349.jpg', 'ML005');
