<?php
// bt7.php - Xuất bảng cửu chương từ 2 đến 10
$tieuDe = 'BT7 - Bảng cửu chương';
require __DIR__ . '/../includes/header.php';
?>
<h1 class="ten-bai">Bảng cửu chương từ 2 đến 10</h1>

<div class="luoi-cuu-chuong">
    <?php for ($i = 2; $i <= 10; $i++): ?>
        <table class="cuu-chuong">
            <tr><th>Bảng nhân <?= $i ?></th></tr>
            <?php for ($j = 1; $j <= 10; $j++): ?>
                <tr><td><?= $i ?> x <?= $j ?> = <?= $i * $j ?></td></tr>
            <?php endfor; ?>
        </table>
    <?php endfor; ?>
</div>
<?php require __DIR__ . '/../includes/footer.php'; ?>
