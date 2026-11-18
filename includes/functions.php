<?php
// includes/functions.php - Các hàm dùng chung cho bài tập PHP căn bản

date_default_timezone_set('Asia/Ho_Chi_Minh');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Danh sách quốc gia dùng chung cho form đăng ký và form sửa
const QUOC_GIA = ['Việt Nam', 'China', 'Japan', 'Khác'];

// Hiện thông báo bằng alert rồi chuyển trang (giống cách làm trong đề), dừng xử lý phía sau
function thongBao($loiNhan, $url)
{
    echo '<!DOCTYPE html><meta charset="UTF-8"><script>alert('
        . json_encode($loiNhan, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG)
        . ');location.href=' . json_encode($url) . ';</script>';
    exit;
}

// Chặn người chưa đăng nhập: $khoa là 'nguoidung' hoặc 'nguoiquantri'.
// Đưa về trang chủ để đăng nhập ở khung bên phải (các trang gọi hàm này đều nằm trong phan2/)
function batBuocDangNhap($khoa)
{
    if (!isset($_SESSION[$khoa])) {
        thongBao('Bạn không có quyền trên trang này! Hãy đăng nhập ở khung bên phải.', '../index.php');
    }
}

// Lưu ảnh upload vào thư mục phan2/HINHANH/, trả về đường dẫn để lưu CSDL, hoặc null nếu file không hợp lệ.
// Đuôi file lấy theo loại ảnh thật (không theo tên file) nên không upload được file .php
function luuHinh($file)
{
    $duoi = [IMAGETYPE_JPEG => 'jpg', IMAGETYPE_PNG => 'png', IMAGETYPE_GIF => 'gif', IMAGETYPE_WEBP => 'webp'];
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK || $file['size'] > 1000000) {
        return null;
    }
    $thongTin = @getimagesize($file['tmp_name']);
    if (!$thongTin || !isset($duoi[$thongTin[2]])) {
        return null;
    }
    // Tên ngẫu nhiên để 2 người cùng up "avatar.jpg" không ghi đè ảnh của nhau
    $duongDan = 'HINHANH/' . bin2hex(random_bytes(8)) . '.' . $duoi[$thongTin[2]];
    return move_uploaded_file($file['tmp_name'], __DIR__ . '/../phan2/' . $duongDan) ? $duongDan : null;
}

// Chống XSS khi in dữ liệu người dùng ra HTML
function h($giaTri)
{
    return htmlspecialchars((string) $giaTri, ENT_QUOTES, 'UTF-8');
}

// Lấy giá trị từ form (POST), đã cắt khoảng trắng
function layPost($ten)
{
    return isset($_POST[$ten]) ? trim((string) $_POST[$ten]) : '';
}

// Kiểm tra chuỗi có phải số thực hợp lệ không (chấp nhận dấu phẩy thập phân)
function laSo($chuoi)
{
    return $chuoi !== '' && is_numeric(str_replace(',', '.', $chuoi));
}

// Chuyển chuỗi sang số thực
function sangSo($chuoi)
{
    return (float) str_replace(',', '.', $chuoi);
}

// Kiểm tra chuỗi có phải số nguyên hợp lệ không
function laSoNguyen($chuoi)
{
    return filter_var($chuoi, FILTER_VALIDATE_INT) !== false;
}

// Định dạng số để hiển thị: làm tròn 4 chữ số, bỏ số 0 thừa, tránh "-0"
function dinhDangSo($so)
{
    $so = round((float) $so, 4);
    if ($so == 0) {
        $so = 0;
    }
    return (string) $so;
}
