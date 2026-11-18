<?php
// quantri.php - Bài 11: danh sách người dùng, quản trị có quyền sửa / xóa
require_once __DIR__ . '/../includes/functions.php';
batBuocDangNhap('nguoiquantri', 'dangnhapQT.php');
require __DIR__ . '/ketnoi.php';

$kq = $kn->query('SELECT username, hoten, gioitinh, quocgia, hinhdaidien FROM nguoi_dung ORDER BY username');

$tieuDe = 'Quản trị người dùng';
require __DIR__ . '/../includes/header.php';
?>
<p class="thanh-tai-khoan">Xin chào <b><?= h($_SESSION['nguoiquantri']) ?></b> | <a href="thoatQT.php">Thoát</a></p>
<h1 class="ten-bai">Thông tin người dùng</h1>

<?php if ($kq->num_rows === 0): ?>
    <p>Chưa có người dùng nào. <a href="dangky.php">Đăng ký thành viên</a></p>
<?php else: ?>
    <!-- Bỏ cột Mật khẩu của đề: mật khẩu đã được mã hóa nên không xem được -->
    <table class="bang-du-lieu">
        <tr>
            <th>Tên đăng nhập</th>
            <th>Họ và tên</th>
            <th>Giới tính</th>
            <th>Quốc gia</th>
            <th>Hình đại diện</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
        <?php while ($row = $kq->fetch_assoc()): ?>
            <tr>
                <td><?= h($row['username']) ?></td>
                <td><?= h($row['hoten']) ?></td>
                <td><?= $row['gioitinh'] == 0 ? 'Nam' : 'Nữ' ?></td>
                <td><?= h($row['quocgia']) ?></td>
                <td><?php if ($row['hinhdaidien'] !== ''): ?><img src="<?= h($row['hinhdaidien']) ?>" alt="" height="50" width="50"><?php endif; ?></td>
                <td><a href="sua.php?user=<?= urlencode($row['username']) ?>">Sửa</a></td>
                <td>
                    <!-- Xóa bằng POST (không dùng link GET) để không bị xóa nhầm qua đường link -->
                    <form method="post" action="xoa.php" onsubmit="return confirm('Xóa người dùng này?')">
                        <input type="hidden" name="user" value="<?= h($row['username']) ?>">
                        <input type="submit" value="Xóa">
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php endif; ?>
<?php require __DIR__ . '/../includes/footer.php'; ?>
