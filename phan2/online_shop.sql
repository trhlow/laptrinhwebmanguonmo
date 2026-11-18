-- online_shop.sql - CSDL cho bài tập PHP-MySQL (Phần 2)
-- Import bằng phpMyAdmin (tab Import) hoặc: mysql -u root < online_shop.sql

CREATE DATABASE IF NOT EXISTS online_shop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE online_shop;

-- Bài 1: bảng người dùng
-- Khác đề: password dài 255 để lưu mật khẩu đã mã hóa (password_hash),
-- gioitinh dùng TINYINT thay BIT vì mysqli trả BIT về dạng nhị phân, so sánh == 0 bị sai
CREATE TABLE IF NOT EXISTS nguoi_dung (
    username    VARCHAR(20)  NOT NULL,
    password    VARCHAR(255) NOT NULL,
    hoten       VARCHAR(50)  NOT NULL,
    gioitinh    TINYINT(1)   NOT NULL,   -- 0: Nam, 1: Nữ
    quocgia     VARCHAR(30)  NOT NULL,
    hinhdaidien TEXT         NOT NULL,   -- chỉ lưu đường dẫn ảnh, không lưu ảnh
    PRIMARY KEY (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng admin (đề dùng ở Bài 10 nhưng chưa cho lệnh tạo)
CREATE TABLE IF NOT EXISTS admin (
    user_admin VARCHAR(20)  NOT NULL,
    pass_admin VARCHAR(255) NOT NULL,
    PRIMARY KEY (user_admin)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tài khoản quản trị mặc định: admin / admin123
INSERT IGNORE INTO admin (user_admin, pass_admin)
VALUES ('admin', '$2y$12$39vIjxjEQDlzfSHoQS3G1upc1lh7h3SOPZYbALrjAyMEolU/ftaQG');
