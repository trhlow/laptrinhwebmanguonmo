<?php
// xuly_dangnhap.php - Bài 8: kiểm tra tên đăng nhập và mật khẩu người dùng
require_once __DIR__ . '/../includes/functions.php';
require __DIR__ . '/ketnoi.php';

$user = layPost('tendn');
$pass = layPost('matkhau');

$row = $kn->execute_query('SELECT password FROM nguoi_dung WHERE username = ?', [$user])->fetch_assoc();
if ($row && password_verify($pass, $row['password'])) {
    session_regenerate_id(true);
    $_SESSION['nguoidung'] = $user;
    thongBao('Đăng nhập thành công', 'trangtt_canhan.php');
}
thongBao('Sai tên đăng nhập hoặc mật khẩu', 'dangnhap.php');
