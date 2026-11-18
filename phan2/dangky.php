<?php
// dangky.php - Bài 3: form đăng ký thành viên
$tieuDe = 'Đăng ký thành viên';
require __DIR__ . '/../includes/header.php';
?>
<h1 class="ten-bai">Trang đăng ký thành viên</h1>

<form enctype="multipart/form-data" action="xlydangky.php" name="frmdk" method="post">
    <table class="bang-form">
        <tr>
            <td class="nhan">Tên đăng nhập:</td>
            <td><input type="text" name="tendn" maxlength="20" required></td>
        </tr>
        <tr>
            <td class="nhan">Mật khẩu:</td>
            <td><input type="password" name="matkhau" required></td>
        </tr>
        <tr>
            <td class="nhan">Họ tên:</td>
            <td><input type="text" name="hoten" maxlength="50" required></td>
        </tr>
        <tr>
            <td class="nhan">Giới tính:</td>
            <td>
                <label><input type="radio" name="gioitinh" value="0" checked> Nam</label>
                &nbsp;&nbsp;
                <label><input type="radio" name="gioitinh" value="1"> Nữ</label>
            </td>
        </tr>
        <tr>
            <td class="nhan">Quốc gia:</td>
            <td>
                <select name="quocgia">
                    <?php foreach (QUOC_GIA as $qg): ?>
                        <option value="<?= h($qg) ?>"><?= h($qg) ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="nhan">Ảnh đại diện:</td>
            <td>
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                <input type="file" name="hinhanh" accept="image/*" required>
                <br><small>Ảnh JPG, PNG, GIF hoặc WEBP, tối đa 1MB</small>
            </td>
        </tr>
        <tr>
            <td><input type="submit" name="dangky" value="Đăng Ký"></td>
            <td><input type="reset" name="lamlai" value="Làm lại"></td>
        </tr>
    </table>
</form>
<?php require __DIR__ . '/../includes/footer.php'; ?>
