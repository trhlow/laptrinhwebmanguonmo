<?php
// xuly_dangnhap.php - Bài 8: kiểm tra tên đăng nhập và mật khẩu người dùng
require_once __DIR__ . '/../includes/functions.php';
require __DIR__ . '/ketnoi.php';

$user = layPost('tendn');
$pass = layPost('matkhau');

// Mật khẩu trong CSDL đã mã hóa MD5 nên so sánh với md5 của mật khẩu nhập vào
if ($kn->execute_query('SELECT 1 FROM nguoi_dung WHERE username = ? AND password = ?', [$user, md5($pass)])->fetch_row()) {
    session_regenerate_id(true);
    $_SESSION['nguoidung'] = $user;
    thongBao('Đăng nhập thành công', 'trangtt_canhan.php');
}
thongBao('Sai tên đăng nhập hoặc mật khẩu', 'dangnhap.php');
