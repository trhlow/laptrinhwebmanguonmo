<?php
// thoat.php - Bài 6: đăng xuất người dùng
require_once __DIR__ . '/../includes/functions.php';

// Chỉ xóa phiên người dùng, không đăng xuất luôn tài khoản quản trị nếu đang mở cùng trình duyệt
unset($_SESSION['nguoidung']);
thongBao('Bạn đã thoát ra khỏi hệ thống!', 'dangnhap.php');
