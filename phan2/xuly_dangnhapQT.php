<?php
// xuly_dangnhapQT.php - Bài 10: kiểm tra tài khoản trong bảng admin
require_once __DIR__ . '/../includes/functions.php';
require __DIR__ . '/ketnoi.php';

$user = layPost('tendn');
$pass = layPost('matkhau');

$row = $kn->execute_query('SELECT pass_admin FROM admin WHERE user_admin = ?', [$user])->fetch_assoc();
if ($row && password_verify($pass, $row['pass_admin'])) {
    session_regenerate_id(true);
    $_SESSION['nguoiquantri'] = $user;
    thongBao('Đăng nhập thành công', 'quantri.php');
}
thongBao('Sai tên đăng nhập hoặc mật khẩu', 'dangnhapQT.php');
