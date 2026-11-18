<?php
// xuly_dangnhap.php - Bài 8 + Bài 10: một form đăng nhập (khung bên phải) dùng chung cho quản trị và người dùng
require_once __DIR__ . '/../includes/functions.php';
require __DIR__ . '/ketnoi.php';

$user = layPost('tendn');
$pass = md5(layPost('matkhau'));   // mật khẩu trong CSDL đã mã hóa MD5

// Kiểm tra bảng admin trước, không có mới kiểm tra bảng nguoi_dung
$laQuanTri = $kn->execute_query('SELECT 1 FROM admin WHERE useradmin = ? AND passadmin = ?', [$user, $pass])->fetch_row();
$laNguoiDung = !$laQuanTri
    && $kn->execute_query('SELECT 1 FROM nguoi_dung WHERE username = ? AND password = ?', [$user, $pass])->fetch_row();

if (!$laQuanTri && !$laNguoiDung) {
    thongBao('Sai tên đăng nhập hoặc mật khẩu', '../index.php');
}

session_regenerate_id(true);
unset($_SESSION['nguoiquantri'], $_SESSION['nguoidung']);   // mỗi lúc chỉ đăng nhập một loại tài khoản
if ($laQuanTri) {
    $_SESSION['nguoiquantri'] = $user;
    thongBao('Đăng nhập quản trị thành công', 'quantri.php');
}
$_SESSION['nguoidung'] = $user;
thongBao('Đăng nhập thành công', 'trangtt_canhan.php');
