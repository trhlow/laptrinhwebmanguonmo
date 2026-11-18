<?php
// bt2.php - Giải phương trình bậc I: ax + b = 0
$tieuDe = 'BT2 - Giải PT bậc I';
require __DIR__ . '/../includes/header.php';

$a = layPost('a');
$b = layPost('b');
$ketQua = '';
$loi = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!laSo($a) || !laSo($b)) {
        $loi = 'Vui lòng nhập a và b là số hợp lệ.';
    } else {
        $soA = sangSo($a);
        $soB = sangSo($b);

        if ($soA == 0) {
            $ketQua = ($soB == 0)
                ? 'Phương trình có vô số nghiệm.'
                : 'Phương trình vô nghiệm.';
        } else {
            $ketQua = 'Phương trình có nghiệm x = ' . dinhDangSo(-$soB / $soA);
        }
    }
}
?>
<h1>Giải phương trình bậc I</h1>

<form method="post" action="bt2.php">
    Nhập a: <input type="text" name="a" value="<?= h($a) ?>"><br>
    Nhập b: <input type="text" name="b" value="<?= h($b) ?>"><br>
    <input type="submit" value="Giải"><br>
    Kết quả:
    <?php if ($loi !== ''): ?>
        <span class="loi"><?= h($loi) ?></span>
    <?php else: ?>
        <span class="ket-qua"><?= h($ketQua) ?></span>
    <?php endif; ?>
</form>
<?php require __DIR__ . '/../includes/footer.php'; ?>
