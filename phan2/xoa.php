<?php
// xoa.php - Bài 14: xóa một người dùng
require_once __DIR__ . '/../includes/functions.php';
batBuocDangNhap('nguoiquantri');
require __DIR__ . '/ketnoi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    thongBao('Hãy dùng nút Xóa trong trang quản trị!', 'quantri.php');
}

$kn->execute_query('DELETE FROM nguoi_dung WHERE username = ?', [layPost('user')]);
thongBao($kn->affected_rows ? 'Xóa thành công' : 'Không tìm thấy người dùng này!', 'quantri.php');
