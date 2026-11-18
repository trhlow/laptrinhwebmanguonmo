<?php
// bt1.php - Chương trình máy tính đơn giản: + - * / %
$tieuDe = 'BT1 - Máy tính';
require __DIR__ . '/../includes/header.php';

$a = layPost('a');
$b = layPost('b');
$pheptoan = layPost('pheptoan');
$ketQua = '';
$loi = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!laSo($a) || !laSo($b)) {
        $loi = 'Vui lòng nhập a và b là số hợp lệ.';
    } else {
        $x = sangSo($a);
        $y = sangSo($b);

        switch ($pheptoan) {
            case '+':
                $ketQua = dinhDangSo($x + $y);
                break;
            case '-':
                $ketQua = dinhDangSo($x - $y);
                break;
            case '*':
                $ketQua = dinhDangSo($x * $y);
                break;
            case '/':
                if ($y == 0) {
                    $loi = 'Không thể chia cho 0.';
                } else {
                    $ketQua = dinhDangSo($x / $y);
                }
                break;
            case '%':
                if ($y == 0) {
                    $loi = 'Không thể chia lấy dư cho 0.';
                } elseif (floor($x) == $x && floor($y) == $y) {
                    $ketQua = (string) ((int) $x % (int) $y); // cả 2 là số nguyên
                } else {
                    $ketQua = dinhDangSo(fmod($x, $y));       // số thực
                }
                break;
            default:
                $loi = 'Phép toán không hợp lệ.';
        }

        if ($ketQua !== '') {
            $ketQua = h($a) . ' ' . h($pheptoan) . ' ' . h($b) . ' = ' . $ketQua;
        }
    }
}
?>
<h1 class="ten-bai">Chương trình máy tính</h1>

<form method="post" action="bt1.php">
    <table class="bang-form">
        <tr>
            <td class="nhan">Nhập a:</td>
            <td><input type="text" name="a" value="<?= h($a) ?>"></td>
        </tr>
        <tr>
            <td class="nhan">Nhập b:</td>
            <td><input type="text" name="b" value="<?= h($b) ?>"></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <fieldset>
                    <legend>Chọn phép toán</legend>
                    <div style="text-align:center">
                        <button type="submit" name="pheptoan" value="+">+</button>
                        <button type="submit" name="pheptoan" value="-">-</button>
                        <button type="submit" name="pheptoan" value="*">*</button>
                        <button type="submit" name="pheptoan" value="/">/</button>
                        <button type="submit" name="pheptoan" value="%">%</button>
                    </div>
                </fieldset>
            </td>
        </tr>
        <tr>
            <td class="nhan">Kết quả:</td>
            <td>
                <?php if ($loi !== ''): ?>
                    <span class="loi"><?= h($loi) ?></span>
                <?php else: ?>
                    <span class="ket-qua"><?= $ketQua ?></span>
                <?php endif; ?>
            </td>
        </tr>
    </table>
</form>
<?php require __DIR__ . '/../includes/footer.php'; ?>
