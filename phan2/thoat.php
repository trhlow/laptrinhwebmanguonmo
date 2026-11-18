<?php
// thoat.php - Bài 6 + Bài 15: đăng xuất (dùng chung cho quản trị và người dùng)
require_once __DIR__ . '/../includes/functions.php';

unset($_SESSION['nguoidung'], $_SESSION['nguoiquantri']);
thongBao('Bạn đã thoát ra khỏi hệ thống!', '../index.php');
