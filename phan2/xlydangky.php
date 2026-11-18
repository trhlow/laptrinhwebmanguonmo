<?php
// xlydangky.php - Bài 4: xử lý đăng ký, upload ảnh đại diện (chỉ lưu đường dẫn vào CSDL)
require_once __DIR__ . '/../includes/functions.php';
require __DIR__ . '/ketnoi.php';

$tdn = layPost('tendn');
$mk  = layPost('matkhau');
$ht  = layPost('hoten');
$gt  = layPost('gioitinh');
$qg  = layPost('quocgia');

if ($tdn === '' || $mk === '' || $ht === '' || mb_strlen($tdn) > 20 || mb_strlen($ht) > 50
    || !in_array($gt, ['0', '1'], true) || !in_array($qg, QUOC_GIA, true)) {
    thongBao('Thông tin đăng ký không hợp lệ, vui lòng nhập lại!', 'dangky.php');
}

// Kiểm tra tên đăng nhập đã có chưa
if ($kn->execute_query('SELECT 1 FROM nguoi_dung WHERE username = ?', [$tdn])->fetch_row()) {
    thongBao('Đã có tên đăng nhập này. Bạn hãy chọn tên đăng nhập khác!', 'dangky.php');
}

$duongDan = luuHinh($_FILES['hinhanh'] ?? []);
if ($duongDan === null) {
    thongBao('Ảnh đại diện không hợp lệ (chỉ nhận ảnh JPG, PNG, GIF, WEBP, tối đa 1MB)!', 'dangky.php');
}

// Mật khẩu được mã hóa bằng MD5 trước khi lưu (theo yêu cầu đề)
$kn->execute_query(
    'INSERT INTO nguoi_dung (username, password, hoten, gioitinh, quocgia, hinhdaidien) VALUES (?, ?, ?, ?, ?, ?)',
    [$tdn, md5($mk), $ht, $gt, $qg, $duongDan]
);

session_regenerate_id(true);
$_SESSION['nguoidung'] = $tdn;
thongBao('Đăng ký thành công', 'trangtt_canhan.php');
