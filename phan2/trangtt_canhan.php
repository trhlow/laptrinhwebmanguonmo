<?php
// trangtt_canhan.php - Bài 5: hiển thị thông tin cá nhân của người đang đăng nhập
require_once __DIR__ . '/../includes/functions.php';
batBuocDangNhap('nguoidung', 'dangnhap.php');
require __DIR__ . '/ketnoi.php';

$row = $kn->execute_query('SELECT * FROM nguoi_dung WHERE username = ?', [$_SESSION['nguoidung']])->fetch_assoc();
if (!$row) {
    // Tài khoản đã bị quản trị xóa trong lúc đang đăng nhập
    unset($_SESSION['nguoidung']);
    thongBao('Tài khoản không còn tồn tại!', 'dangky.php');
}

$tieuDe = 'Thông tin cá nhân';
require __DIR__ . '/../includes/header.php';
?>
<p class="thanh-tai-khoan">Xin chào <b><?= h($_SESSION['nguoidung']) ?></b> | <a href="thoat.php">Thoát</a></p>
<h1 class="ten-bai">Thông tin của bạn</h1>

<table class="bang-form">
    <tr><td class="nhan">Họ và tên:</td><td><?= h($row['hoten']) ?></td></tr>
    <tr><td class="nhan">Giới tính:</td><td><?= $row['gioitinh'] == 0 ? 'Nam' : 'Nữ' ?></td></tr>
    <tr><td class="nhan">Quốc tịch:</td><td><?= h($row['quocgia']) ?></td></tr>
    <tr>
        <td class="nhan">Ảnh đại diện:</td>
        <td><?php if ($row['hinhdaidien'] !== ''): ?><img src="<?= h($row['hinhdaidien']) ?>" alt="Ảnh đại diện" class="anh-dai-dien"><?php else: ?>(chưa có)<?php endif; ?></td>
    </tr>
</table>
<?php require __DIR__ . '/../includes/footer.php'; ?>
