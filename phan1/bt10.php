<?php
// bt10.php - Hiển thị thứ, ngày, tháng, năm hôm nay bằng tiếng Anh
// Ví dụ: "Sunday 20th of March 2011"
$tieuDe = 'BT10 - Ngày tháng hiện tại';
require __DIR__ . '/../includes/header.php';

// l: tên thứ | j: ngày | S: hậu tố st/nd/rd/th | \o\f: chữ "of" | F: tên tháng | Y: năm 4 chữ số
$homNayTiengAnh = date('l jS \o\f F Y');

// Thêm bản tiếng Việt để đối chiếu
$thuTiengViet = ['Chủ nhật', 'Thứ hai', 'Thứ ba', 'Thứ tư', 'Thứ năm', 'Thứ sáu', 'Thứ bảy'];
$homNayTiengViet = $thuTiengViet[(int) date('w')] . ', ngày ' . date('j') . ' tháng ' . date('n') . ' năm ' . date('Y');
?>
<h1 class="ten-bai">Ngày tháng hiện tại</h1>

<p>Hôm nay là: <b><?= h($homNayTiengViet) ?></b></p>
<p>Tiếng Anh: <span class="ket-qua"><?= h($homNayTiengAnh) ?></span></p>
<?php require __DIR__ . '/../includes/footer.php'; ?>
