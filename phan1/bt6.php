<?php
// bt6.php - Nhập số tháng, cho biết tháng đó có bao nhiêu ngày
$tieuDe = 'BT6 - Số ngày trong tháng';
require __DIR__ . '/../includes/header.php';

$thang = layPost('thang');
$nam = layPost('nam');
$ketQua = '';
$loi = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!laSoNguyen($thang)) {
        $loi = 'Vui lòng nhập tháng là số nguyên.';
    } elseif ($nam !== '' && (!laSoNguyen($nam) || (int) $nam < 1)) {
        $loi = 'Năm (nếu nhập) phải là số nguyên dương.';
    } else {
        $t = (int) $thang;

        if ($t > 12 || $t < 1) {
            $ketQua = 'Không có tháng ' . $t . '.';
        } else {
            switch ($t) {
                case 1: case 3: case 5: case 7: case 8: case 10: case 12:
                    $ketQua = "Tháng $t có 31 ngày.";
                    break;
                case 4: case 6: case 9: case 11:
                    $ketQua = "Tháng $t có 30 ngày.";
                    break;
                case 2:
                    if ($nam === '') {
                        $ketQua = 'Tháng 2 có 28 ngày (29 ngày nếu là năm nhuận).';
                    } else {
                        $y = (int) $nam;
                        // Năm nhuận: chia hết cho 400, hoặc chia hết cho 4 nhưng không chia hết cho 100
                        $laNamNhuan = ($y % 400 == 0) || ($y % 4 == 0 && $y % 100 != 0);
                        $ketQua = "Tháng 2 năm $y có " . ($laNamNhuan ? '29 ngày (năm nhuận).' : '28 ngày.');
                    }
                    break;
            }
        }
    }
}
?>
<h1 class="ten-bai">Số ngày trong tháng</h1>

<form method="post" action="bt6.php">
    <table class="bang-form">
        <tr>
            <td class="nhan">Nhập tháng:</td>
            <td><input type="text" name="thang" value="<?= h($thang) ?>"></td>
        </tr>
        <tr>
            <td class="nhan">Năm (không bắt buộc):</td>
            <td><input type="text" name="nam" value="<?= h($nam) ?>"> <i>dùng để xác định tháng 2 có 28 hay 29 ngày</i></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Xem kết quả"></td>
        </tr>
        <tr>
            <td class="nhan">Kết quả:</td>
            <td>
                <?php if ($loi !== ''): ?>
                    <span class="loi"><?= h($loi) ?></span>
                <?php else: ?>
                    <span class="ket-qua"><?= h($ketQua) ?></span>
                <?php endif; ?>
            </td>
        </tr>
    </table>
</form>
<?php require __DIR__ . '/../includes/footer.php'; ?>
