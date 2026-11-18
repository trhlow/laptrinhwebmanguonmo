<?php
// bt4.php - Tính diện tích: đường tròn, tam giác, chữ nhật (chọn bằng radio button)
$tieuDe = 'BT4 - Tính diện tích';
require __DIR__ . '/../includes/header.php';

$hinh       = layPost('hinh');
$banKinh    = layPost('bankinh');
$canhDay    = layPost('canhday');
$chieuCao   = layPost('chieucao');
$chieuDai   = layPost('chieudai');
$chieuRong  = layPost('chieurong');
$ketQua = '';
$loi = '';

// Kiểm tra 1 giá trị là số dương
function laSoDuong($chuoi)
{
    return laSo($chuoi) && sangSo($chuoi) > 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($hinh) {
        case 'tron':
            if (!laSoDuong($banKinh)) {
                $loi = 'Bán kính phải là số dương.';
            } else {
                $r = sangSo($banKinh);
                $ketQua = 'Diện tích hình tròn (r = ' . dinhDangSo($r) . ') là: S = π × r² = ' . dinhDangSo(M_PI * $r * $r);
            }
            break;

        case 'tamgiac':
            if (!laSoDuong($canhDay) || !laSoDuong($chieuCao)) {
                $loi = 'Cạnh đáy và chiều cao phải là số dương.';
            } else {
                $day = sangSo($canhDay);
                $cao = sangSo($chieuCao);
                $ketQua = 'Diện tích tam giác (đáy = ' . dinhDangSo($day) . ', cao = ' . dinhDangSo($cao)
                        . ') là: S = (đáy × cao) / 2 = ' . dinhDangSo($day * $cao / 2);
            }
            break;

        case 'chunhat':
            if (!laSoDuong($chieuDai) || !laSoDuong($chieuRong)) {
                $loi = 'Chiều dài và chiều rộng phải là số dương.';
            } else {
                $dai = sangSo($chieuDai);
                $rong = sangSo($chieuRong);
                $ketQua = 'Diện tích hình chữ nhật (dài = ' . dinhDangSo($dai) . ', rộng = ' . dinhDangSo($rong)
                        . ') là: S = dài × rộng = ' . dinhDangSo($dai * $rong);
            }
            break;

        default:
            $loi = 'Vui lòng chọn một hình cần tính diện tích.';
    }
}

// Giữ trạng thái radio đã chọn
function chon($giaTri, $hinh)
{
    return $giaTri === $hinh ? 'checked' : '';
}
?>
<h1 class="ten-bai">Tính diện tích hình</h1>

<form method="post" action="bt4.php">
    <p>Chọn hình cần tính diện tích:</p>

    <div class="nhom-hinh">
        <label><input type="radio" name="hinh" value="tron" <?= chon('tron', $hinh) ?>> Đường tròn</label>
        <div class="o-nhap-hinh">Bán kính r: <input type="text" name="bankinh" value="<?= h($banKinh) ?>"></div>
    </div>

    <div class="nhom-hinh">
        <label><input type="radio" name="hinh" value="tamgiac" <?= chon('tamgiac', $hinh) ?>> Tam giác</label>
        <div class="o-nhap-hinh">
            Cạnh đáy: <input type="text" name="canhday" value="<?= h($canhDay) ?>">
            Chiều cao: <input type="text" name="chieucao" value="<?= h($chieuCao) ?>">
        </div>
    </div>

    <div class="nhom-hinh">
        <label><input type="radio" name="hinh" value="chunhat" <?= chon('chunhat', $hinh) ?>> Chữ nhật</label>
        <div class="o-nhap-hinh">
            Chiều dài: <input type="text" name="chieudai" value="<?= h($chieuDai) ?>">
            Chiều rộng: <input type="text" name="chieurong" value="<?= h($chieuRong) ?>">
        </div>
    </div>

    <input type="submit" value="Tính diện tích">
</form>

<?php if ($loi !== ''): ?>
    <p class="loi"><?= h($loi) ?></p>
<?php elseif ($ketQua !== ''): ?>
    <p class="ket-qua"><?= h($ketQua) ?></p>
<?php endif; ?>
<?php require __DIR__ . '/../includes/footer.php'; ?>
