<?php
// xuly_dangnhapQT.php - Bài 10: kiểm tra tài khoản trong bảng admin
require_once __DIR__ . '/../includes/functions.php';
require __DIR__ . '/ketnoi.php';

$user = layPost('tendn');
$pass = layPost('matkhau');

// Mật khẩu trong CSDL đã mã hóa MD5 nên so sánh với md5 của mật khẩu nhập vào
if ($kn->execute_query('SELECT 1 FROM admin WHERE useradmin = ? AND passadmin = ?', [$user, md5($pass)])->fetch_row()) {
    session_regenerate_id(true);
    $_SESSION['nguoiquantri'] = $user;
    thongBao('Đăng nhập thành công', 'quantri.php');
}
thongBao('Sai tên đăng nhập hoặc mật khẩu', 'dangnhapQT.php');
