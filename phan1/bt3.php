<?php
// bt3.php - Giải phương trình bậc II: ax^2 + bx + c = 0
$tieuDe = 'BT3 - Giải PT bậc II';
require __DIR__ . '/../includes/header.php';

$a = layPost('a');
$b = layPost('b');
$c = layPost('c');
$ketQua = '';
$loi = '';

// Bấm "Làm lại" thì xoá dữ liệu đã nhập
if (isset($_POST['lamlai'])) {
    $a = $b = $c = '';
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!laSo($a) || !laSo($b) || !laSo($c)) {
        $loi = 'Vui lòng nhập a, b, c là số hợp lệ.';
    } else {
        $soA = sangSo($a);
        $soB = sangSo($b);
        $soC = sangSo($c);

        // Chuỗi phương trình theo mẫu đề: 2x² + 3x + -5 = 0
        $phuongTrinh = dinhDangSo($soA) . 'x<sup>2</sup> + ' . dinhDangSo($soB) . 'x + ' . dinhDangSo($soC) . ' = 0';

        if ($soA == 0) {
            // Trở thành phương trình bậc I: bx + c = 0
            $ketQua = 'Vì a = 0 nên phương trình trở thành bậc nhất: ' . dinhDangSo($soB) . 'x + ' . dinhDangSo($soC) . ' = 0, ';
            if ($soB == 0) {
                $ketQua .= ($soC == 0) ? 'có vô số nghiệm.' : 'vô nghiệm.';
            } else {
                $ketQua .= 'có nghiệm x = ' . dinhDangSo(-$soC / $soB);
            }
        } else {
            $delta = $soB * $soB - 4 * $soA * $soC;
            $ketQua = 'Phương trình bậc hai: ' . $phuongTrinh . ', ';

            if ($delta < 0) {
                $ketQua .= 'vô nghiệm (Δ = ' . dinhDangSo($delta) . ' &lt; 0).';
            } elseif ($delta == 0) {
                $ketQua .= 'có nghiệm kép: x<sub>1</sub> = x<sub>2</sub> = ' . dinhDangSo(-$soB / (2 * $soA));
            } else {
                $x1 = (-$soB + sqrt($delta)) / (2 * $soA);
                $x2 = (-$soB - sqrt($delta)) / (2 * $soA);
                $ketQua .= 'có 2 nghiệm phân biệt: x<sub>1</sub> = ' . dinhDangSo($x1)
                         . ' và x<sub>2</sub> = ' . dinhDangSo($x2);
            }
        }
    }
}
?>
<h1>GIẢI PHƯƠNG TRÌNH BẬC 2</h1>

<form method="post" action="bt3.php">
    Nhập a: <input type="text" name="a" value="<?= h($a) ?>"><br>
    Nhập b: <input type="text" name="b" value="<?= h($b) ?>"><br>
    Nhập c: <input type="text" name="c" value="<?= h($c) ?>"><br>
    <input type="submit" name="giai" value="Giải">
    <input type="submit" name="lamlai" value="Làm lại">
</form>

<?php if ($loi !== ''): ?>
    <div class="khung-ket-qua loi"><?= h($loi) ?></div>
<?php elseif ($ketQua !== ''): ?>
    <!-- $ketQua chỉ chứa số đã định dạng và thẻ sup/sub do chương trình tạo ra -->
    <div class="khung-ket-qua"><?= $ketQua ?></div>
<?php endif; ?>
<?php require __DIR__ . '/../includes/footer.php'; ?>
