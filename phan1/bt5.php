<?php
// bt5.php - Nhập 3 cạnh, kiểm tra có phải tam giác và loại tam giác
$tieuDe = 'BT5 - Tam giác';
require __DIR__ . '/../includes/header.php';

$canhA = layPost('a');
$canhB = layPost('b');
$canhC = layPost('c');
$ketQua = '';
$loi = '';

// So sánh 2 số thực có bằng nhau không (tránh sai số dấu phẩy động)
function bangNhau($x, $y)
{
    return abs($x - $y) <= 1e-9 * max(1, abs($x), abs($y));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!laSo($canhA) || !laSo($canhB) || !laSo($canhC)) {
        $loi = 'Vui lòng nhập 3 cạnh là số hợp lệ.';
    } else {
        $a = sangSo($canhA);
        $b = sangSo($canhB);
        $c = sangSo($canhC);

        if ($a <= 0 || $b <= 0 || $c <= 0) {
            $ketQua = 'Đây KHÔNG phải là tam giác (các cạnh phải lớn hơn 0).';
        } elseif ($a + $b <= $c || $a + $c <= $b || $b + $c <= $a) {
            $ketQua = 'Đây KHÔNG phải là tam giác (tổng 2 cạnh bất kỳ phải lớn hơn cạnh còn lại).';
        } else {
            // Sắp xếp để cạnh lớn nhất nằm cuối, phục vụ kiểm tra tam giác vuông
            $canh = [$a, $b, $c];
            sort($canh);
            $laVuong = bangNhau($canh[0] ** 2 + $canh[1] ** 2, $canh[2] ** 2);
            $laCan = bangNhau($a, $b) || bangNhau($b, $c) || bangNhau($a, $c);
            $laDeu = bangNhau($a, $b) && bangNhau($b, $c);

            if ($laDeu) {
                $loai = 'tam giác đều';
            } elseif ($laVuong && $laCan) {
                $loai = 'tam giác vuông cân';
            } elseif ($laVuong) {
                $loai = 'tam giác vuông';
            } elseif ($laCan) {
                $loai = 'tam giác cân';
            } else {
                $loai = 'tam giác thường';
            }

            $ketQua = 'Ba cạnh ' . dinhDangSo($a) . ', ' . dinhDangSo($b) . ', ' . dinhDangSo($c) . ' tạo thành ' . $loai . '.';
        }
    }
}
?>
<h1 class="ten-bai">Kiểm tra tam giác</h1>

<form method="post" action="bt5.php">
    <table class="bang-form">
        <tr>
            <td class="nhan">Cạnh a:</td>
            <td><input type="text" name="a" value="<?= h($canhA) ?>"></td>
        </tr>
        <tr>
            <td class="nhan">Cạnh b:</td>
            <td><input type="text" name="b" value="<?= h($canhB) ?>"></td>
        </tr>
        <tr>
            <td class="nhan">Cạnh c:</td>
            <td><input type="text" name="c" value="<?= h($canhC) ?>"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Kiểm tra"></td>
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
