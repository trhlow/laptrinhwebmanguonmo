<?php
// index.php - Trang chủ
$tieuDe = 'Trang chủ';
require __DIR__ . '/includes/header.php';
?>
<p>Trang chủ</p>
<h2>Bài tập PHP căn bản - Phần 1</h2>
<p>Chọn một bài tập ở menu bên trái để bắt đầu:</p>
<ul>
    <?php foreach ($menuPhpCanBan as $file => $ten): ?>
        <li><a href="<?= $goc . h($file) ?>"><?= h($ten) ?></a></li>
    <?php endforeach; ?>
</ul>
<h2>Bài tập PHP-MySQL - Phần 2</h2>
<ul>
    <?php foreach ($menuPhpMySql as $file => $ten): ?>
        <li><a href="<?= $goc . h($file) ?>"><?= h($ten) ?></a></li>
    <?php endforeach; ?>
</ul>
<?php require __DIR__ . '/includes/footer.php'; ?>
