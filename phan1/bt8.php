<?php
// bt8.php - Nhập số nguyên dương <= 10, in bảng cửu chương của số đó
$tieuDe = 'BT8 - Bảng cửu chương NC';
require __DIR__ . '/../includes/header.php';

$so = layPost('so');
$n = null;
$loi = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!laSoNguyen($so) || (int) $so < 1 || (int) $so > 10) {
        $loi = 'Vui lòng nhập số nguyên dương từ 1 đến 10.';
    } else {
        $n = (int) $so;
    }
}
?>
<h1 class="ten-bai">Bảng cửu chương nâng cao</h1>

<form method="post" action="bt8.php">
    Nhập số nguyên dương (≤ 10):
    <input type="text" name="so" value="<?= h($so) ?>">
    <input type="submit" value="Xem bảng cửu chương">
</form>

<?php if ($loi !== ''): ?>
    <p class="loi"><?= h($loi) ?></p>
<?php elseif ($n !== null): ?>
    <table class="cuu-chuong" style="width:220px;margin-top:12px">
        <tr><th>Bảng nhân <?= $n ?></th></tr>
        <?php for ($j = 1; $j <= 10; $j++): ?>
            <tr><td><?= $n ?> x <?= $j ?> = <?= $n * $j ?></td></tr>
        <?php endfor; ?>
    </table>
<?php endif; ?>
<?php require __DIR__ . '/../includes/footer.php'; ?>
