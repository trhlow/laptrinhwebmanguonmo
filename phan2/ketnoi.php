<?php
// ketnoi.php - Bài 2: kết nối đến CSDL online_shop
// Đề dùng mysql_connect, hàm này đã bị xóa từ PHP 7 nên đổi sang mysqli
try {
    $kn = new mysqli('localhost', 'root', '', 'online_shop');
    $kn->set_charset('utf8mb4');
} catch (mysqli_sql_exception $e) {
    die('Không thể kết nối đến CSDL online_shop: ' . $e->getMessage());
}
