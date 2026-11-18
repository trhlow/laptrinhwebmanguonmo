<?php
// includes/header.php - Phần đầu trang + menu trái (dùng chung cho mọi trang)
require_once __DIR__ . '/functions.php';

$tieuDe = $tieuDe ?? 'Trang chủ';

// Đường dẫn về thư mục gốc phanPHP: '' với index.php, '../' với trang trong phan1/ hoặc phan2/
$thuMucTrang = dirname($_SERVER['SCRIPT_FILENAME']);
$goc = realpath($thuMucTrang) === realpath(__DIR__ . '/..') ? '' : '../';
$trangHienTai = $goc === '' ? basename($_SERVER['SCRIPT_NAME']) : basename($thuMucTrang) . '/' . basename($_SERVER['SCRIPT_NAME']);

$menuPhpCanBan = [
    'phan1/bt1.php'  => 'BT1 - Máy tính',
    'phan1/bt2.php'  => 'BT2 - Giải PT bậc I một ẩn',
    'phan1/bt3.php'  => 'BT3 - Giải PT bậc II một ẩn',
    'phan1/bt4.php'  => 'BT4 - Tính diện tích',
    'phan1/bt5.php'  => 'BT5 - Tam giác',
    'phan1/bt6.php'  => 'BT6 - Số ngày trong tháng',
    'phan1/bt7.php'  => 'BT7 - Bảng cửu chương',
    'phan1/bt8.php'  => 'BT8 - Bảng cửu chương NC',
    'phan1/bt9.php'  => 'BT9 - Số nguyên tố',
    'phan1/bt10.php' => 'BT10 - Ngày tháng hiện tại',
];

$menuPhpMySql = [
    'phan2/dangky.php'         => 'Đăng ký thành viên',
    'phan2/dangnhap.php'       => 'Đăng nhập',
    'phan2/trangtt_canhan.php' => 'Thông tin cá nhân',
    'phan2/dangnhapQT.php'     => 'Đăng nhập quản trị',
    'phan2/quantri.php'        => 'Quản trị người dùng',
];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= h($tieuDe) ?> - Tri thức</title>
    <link rel="stylesheet" href="<?= $goc ?>css/style.css">
</head>
<body>
<div class="khung">
    <!-- Banner -->
    <div class="banner">
        <img src="<?= $goc ?>hinhanh/sachhay1.jpg" alt="Banner Tri thức">
    </div>

    <!-- Thanh điều hướng -->
    <div class="thanh-dieu-huong">
        <a href="<?= $goc ?>index.php">Trang chủ</a>
        <span class="khau-hieu">Cùng bạn đi tìm tri thức!</span>
    </div>

    <div class="noi-dung-chinh">
        <!-- Menu trái -->
        <div class="cot-trai">
            <div class="tieu-de-menu">Bài tập PHP căn bản</div>
            <ul class="menu">
                <?php foreach ($menuPhpCanBan as $file => $ten): ?>
                    <li><a href="<?= $goc . h($file) ?>" class="<?= $file === $trangHienTai ? 'dang-chon' : '' ?>"><?= h($ten) ?></a></li>
                <?php endforeach; ?>
            </ul>
            <div class="tieu-de-menu">Bài tập PHP-MySQL</div>
            <ul class="menu">
                <?php foreach ($menuPhpMySql as $file => $ten): ?>
                    <li><a href="<?= $goc . h($file) ?>" class="<?= $file === $trangHienTai ? 'dang-chon' : '' ?>"><?= h($ten) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Nội dung giữa -->
        <div class="cot-giua">
