# Lập trình web mã nguồn mở - Bài tập PHP

Bài tập môn Lập trình web mã nguồn mở của Trần Hoàng Long.

- **Phần 1 - PHP căn bản** (`phan1/`): 10 bài máy tính, giải phương trình, tam giác, bảng cửu chương, số nguyên tố, ngày tháng…
- **Phần 2 - PHP và MySQL** (`phan2/`): đăng ký thành viên có upload ảnh đại diện, đăng nhập, trang quản trị sửa/xóa người dùng.

## Cấu trúc thư mục

```
├── PHAN 1 - php.doc, PHAN 2 - php va SQL.pdf, ...   ← đề bài và tài liệu của cô
└── server/htdocs/duanweb/                            ← CODE: thư mục này chép vào htdocs của XAMPP
    ├── hinhanh/              ← ảnh banner (phải nằm cạnh phanPHP)
    └── phanPHP/
        ├── index.php         ← trang chủ
        ├── css/, includes/   ← giao diện và hàm dùng chung
        ├── phan1/            ← bt1.php … bt10.php
        └── phan2/            ← trang PHP-MySQL, ketnoi.php, online_shop.sql, HINHANH/ (ảnh upload)
```

## Cài đặt và chạy

### 1. Cài XAMPP

Tải XAMPP **có PHP 8.2 trở lên** tại https://www.apachefriends.org (code dùng `mysqli::execute_query`, cần PHP ≥ 8.2).
Mở **XAMPP Control Panel**, bấm **Start** cho **Apache** và **MySQL**.

### 2. Lấy code về

Chép thư mục `server/htdocs/duanweb` vào thư mục `htdocs` của XAMPP (mặc định `C:\xampp\htdocs`):

```
git clone https://github.com/trhlow/laptrinhwebmanguonmo.git
xcopy /E /I laptrinhwebmanguonmo\server\htdocs\duanweb C:\xampp\htdocs\duanweb
```

Hoặc tải ZIP trên GitHub (nút **Code → Download ZIP**), giải nén rồi chép thư mục `duanweb` như trên.

> Giữ nguyên `hinhanh/` nằm cạnh `phanPHP/`, nếu không ảnh banner sẽ không hiện.

### 3. Tạo cơ sở dữ liệu (cần cho Phần 2)

1. Vào http://localhost/phpmyadmin
2. Chọn tab **Import** → **Choose File** → chọn `duanweb/phanPHP/phan2/online_shop.sql` → bấm **Import**.

File này tự tạo CSDL `online_shop` gồm bảng `nguoi_dung`, bảng `admin` và tài khoản quản trị mặc định.

### 4. Mở trang web

http://localhost/duanweb/phanPHP/

- Phần 1 chạy được ngay, không cần CSDL.
- Phần 2: đăng ký thành viên ở menu trái; trang quản trị đăng nhập bằng **admin / admin123**.

## Lỗi thường gặp

| Lỗi | Cách sửa |
|---|---|
| `localhost` không vào được | Apache có thể đang chạy cổng khác. Xem dòng `Listen` trong `xampp\apache\conf\httpd.conf`; ví dụ `Listen 8080` thì vào http://localhost:8080/duanweb/phanPHP/ |
| Apache không Start được | Cổng 80 bị chương trình khác chiếm (Skype, IIS…). Tắt chương trình đó, hoặc đổi `Listen 80` thành `Listen 8080` |
| `Không thể kết nối đến CSDL online_shop` | MySQL chưa Start, hoặc chưa import `online_shop.sql` (bước 3) |
| MySQL có đặt mật khẩu cho `root` | Sửa mật khẩu trong `phanPHP/phan2/ketnoi.php` |
| `Call to undefined method mysqli::execute_query()` | PHP cũ hơn 8.2, cài XAMPP bản mới hơn |
| Không lưu được ảnh đại diện | Kiểm tra thư mục `phanPHP/phan2/HINHANH/` có tồn tại và ghi được |
