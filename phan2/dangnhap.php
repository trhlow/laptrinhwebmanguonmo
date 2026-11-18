<?php
// dangnhap.php - Bài 7: form đăng nhập người dùng
$tieuDe = 'Đăng nhập';
require __DIR__ . '/../includes/header.php';
?>
<h1 class="ten-bai">ĐĂNG NHẬP</h1>

<form action="xuly_dangnhap.php" name="dangnhap" method="post">
    <table class="bang-form">
        <tr>
            <td class="nhan">Tên đăng nhập:</td>
            <td><input type="text" name="tendn" required></td>
        </tr>
        <tr>
            <td class="nhan">Mật khẩu:</td>
            <td><input type="password" name="matkhau" required></td>
        </tr>
        <tr>
            <td><input type="submit" name="dn" value="Đăng nhập"></td>
            <td><input type="reset" name="ll" value="Làm lại"></td>
        </tr>
    </table>
</form>
<p>Chưa có tài khoản? <a href="dangky.php">Đăng ký thành viên</a></p>
<?php require __DIR__ . '/../includes/footer.php'; ?>
