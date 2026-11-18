<?php
// bt9.php - Kiểm tra số nguyên tố
$tieuDe = 'BT9 - Số nguyên tố';
require __DIR__ . '/../includes/header.php';

$so = layPost('so');
$ketQua = '';
$loi = '';

// Trả về true nếu $n là số nguyên tố
function laSoNguyenTo($n)
{
    if ($n < 2) {
        return false;
    }
    if ($n < 4) {
        return true;            // 2 và 3
    }
    if ($n % 2 == 0) {
        return false;
    }
    // Chỉ cần thử các ước lẻ đến căn bậc hai của n
    for ($i = 3; $i * $i <= $n; $i += 2) {
        if ($n % $i == 0) {
            return false;
        }
    }
    return true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!laSoNguyen($so)) {
        $loi = 'Vui lòng nhập một số nguyên.';
    } elseif ((int) $so > 1000000000000) {
        $loi = 'Số quá lớn, vui lòng nhập số không vượt quá 1.000.000.000.000.';
    } else {
        $n = (int) $so;
        $ketQua = laSoNguyenTo($n)
            ? "$n là số nguyên tố."
            : "$n KHÔNG phải là số nguyên tố.";
    }
}
?>
<h1 class="ten-bai">Kiểm tra số nguyên tố</h1>

<form method="post" action="bt9.php">
    Nhập một số:
    <input type="text" name="so" value="<?= h($so) ?>">
    <input type="submit" value="Kiểm tra">
</form>

<?php if ($loi !== ''): ?>
    <p class="loi"><?= h($loi) ?></p>
<?php elseif ($ketQua !== ''): ?>
    <p class="ket-qua"><?= h($ketQua) ?></p>
<?php endif; ?>
<?php require __DIR__ . '/../includes/footer.php'; ?>
