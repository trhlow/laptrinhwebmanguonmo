<?php
// thuchien_sua.php - Bài 13: thực hiện lệnh sửa thông tin người dùng
require_once __DIR__ . '/../includes/functions.php';
batBuocDangNhap('nguoiquantri', 'dangnhapQT.php');
require __DIR__ . '/ketnoi.php';

$tdn = layPost('tendn');
$mk  = layPost('matkhau');
$ht  = layPost('hoten');
$gt  = layPost('gioitinh');
$qg  = layPost('quocgia');
$trangSua = 'sua.php?user=' . urlencode($tdn);

if ($ht === '' || mb_strlen($ht) > 50 || !in_array($gt, ['0', '1'], true) || !in_array($qg, QUOC_GIA, true)) {
    thongBao('Thông tin sửa không hợp lệ!', $trangSua);
}

$kn->execute_query(
    'UPDATE nguoi_dung SET hoten = ?, gioitinh = ?, quocgia = ? WHERE username = ?',
    [$ht, $gt, $qg, $tdn]
);

// Chỉ đổi mật khẩu khi quản trị có nhập mật khẩu mới
if ($mk !== '') {
    $kn->execute_query('UPDATE nguoi_dung SET password = ? WHERE username = ?', [password_hash($mk, PASSWORD_DEFAULT), $tdn]);
}

// Chỉ đổi ảnh khi có chọn ảnh mới; không chọn thì giữ ảnh cũ trong CSDL
if (($_FILES['hinh']['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
    $duongDan = luuHinh($_FILES['hinh']);
    if ($duongDan === null) {
        thongBao('Đã lưu thông tin, nhưng ảnh mới không hợp lệ (chỉ nhận ảnh JPG, PNG, GIF, WEBP, tối đa 1MB)!', $trangSua);
    }
    $kn->execute_query('UPDATE nguoi_dung SET hinhdaidien = ? WHERE username = ?', [$duongDan, $tdn]);
}

thongBao('Sửa thành công', 'quantri.php');
