<?php
// thoatQT.php - Bài 15: thoát tài khoản quản trị
require_once __DIR__ . '/../includes/functions.php';

unset($_SESSION['nguoiquantri']);
thongBao('Bạn đã thoát ra khỏi hệ thống quản trị', 'dangnhapQT.php');
