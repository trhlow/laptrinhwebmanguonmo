<?php
// sua.php - Bài 12: hiển thị thông tin cũ của người dùng cần sửa
require_once __DIR__ . '/../includes/functions.php';
batBuocDangNhap('nguoiquantri', 'dangnhapQT.php');
require __DIR__ . '/ketnoi.php';

$row = $kn->execute_query('SELECT * FROM nguoi_dung WHERE username = ?', [$_GET['user'] ?? ''])->fetch_assoc();
if (!$row) {
    thongBao('Không tìm thấy người dùng này!', 'quantri.php');
}

$tieuDe = 'Sửa người dùng';
require __DIR__ . '/../includes/header.php';
?>
<p class="thanh-tai-khoan">Xin chào <b><?= h($_SESSION['nguoiquantri']) ?></b> | <a href="quantri.php">Quay lại</a> | <a href="thoatQT.php">Thoát</a></p>
<h1 class="ten-bai">Sửa thông tin người dùng</h1>

<form name="frmsua" action="thuchien_sua.php" method="post" enctype="multipart/form-data">
    <table class="bang-form">
        <tr>
            <td class="nhan">Username:</td>
            <td><input type="text" name="tendn" value="<?= h($row['username']) ?>" readonly></td>
        </tr>
        <tr>
            <td class="nhan">Mật khẩu mới:</td>
            <td><input type="password" name="matkhau"> <small>(để trống nếu không đổi)</small></td>
        </tr>
        <tr>
            <td class="nhan">Họ tên:</td>
            <td><input type="text" name="hoten" maxlength="50" value="<?= h($row['hoten']) ?>" required></td>
        </tr>
        <tr>
            <td class="nhan">Giới tính:</td>
            <td>
                <label><input type="radio" name="gioitinh" value="0" <?= $row['gioitinh'] == 0 ? 'checked' : '' ?>> Nam</label>
                &nbsp;&nbsp;
                <label><input type="radio" name="gioitinh" value="1" <?= $row['gioitinh'] == 1 ? 'checked' : '' ?>> Nữ</label>
            </td>
        </tr>
        <tr>
            <td class="nhan">Quốc gia:</td>
            <td>
                <select name="quocgia">
                    <?php foreach (QUOC_GIA as $qg): ?>
                        <option value="<?= h($qg) ?>" <?= $qg === $row['quocgia'] ? 'selected' : '' ?>><?= h($qg) ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="nhan">Hình đại diện:</td>
            <td>
                <?php if ($row['hinhdaidien'] !== ''): ?><img src="<?= h($row['hinhdaidien']) ?>" alt="" height="50" width="50"><?php endif; ?>
                Ảnh mới:
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                <input type="file" name="hinh" accept="image/*">
            </td>
        </tr>
        <tr>
            <td><input type="submit" name="suatt" value="Sửa thông tin"></td>
            <td><input type="reset" name="huybo" value="Hủy bỏ"></td>
        </tr>
    </table>
</form>
<?php require __DIR__ . '/../includes/footer.php'; ?>
