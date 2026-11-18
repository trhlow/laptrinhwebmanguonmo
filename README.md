# Lập trình web mã nguồn mở - Bài tập PHP

Bài tập môn Lập trình web mã nguồn mở của Trần Hoàng Long.

- **Phần 1 - PHP căn bản** (`phan1/`): 10 bài máy tính, giải phương trình, tam giác, bảng cửu chương, số nguyên tố, ngày tháng…
- **Phần 2 - PHP và MySQL** (`phan2/`): đăng ký thành viên có upload ảnh đại diện, đăng nhập, trang quản trị sửa/xóa người dùng.

## Lấy code và bài tập về máy

```
git clone https://github.com/trhlow/laptrinhwebmanguonmo.git D:\tranhoanglong
```

Lệnh này tạo thư mục `D:\tranhoanglong` mới và tải về toàn bộ đề bài và code. Các file khác trên máy không bị ảnh hưởng.

> `git clone` chỉ chạy được khi `D:\tranhoanglong` **chưa có** hoặc **đang trống**. Nếu thư mục đó đã có, hãy đổi tên cuối lệnh, ví dụ `D:\tranhoanglong-github`.
>
> Không cài git thì bấm **Code → Download ZIP** trên trang GitHub rồi giải nén.

## Cấu trúc thư mục

```
tranhoanglong\
├── PHAN 1 - php.doc                 ← đề bài Phần 1
├── PHAN 2 - php va SQL.pdf          ← đề bài Phần 2
├── BT quan ly ban sach VERSION 6.pdf, battapthem_chattructuyen_...pdf
├── giao dien_new.zip, hinhanh.zip   ← giao diện và hình ảnh cô cho
└── server\htdocs\duanweb\           ← code bài tập
    ├── hinhanh\                     ← ảnh banner
    └── phanPHP\
        ├── index.php                ← trang chủ
        ├── css\, includes\          ← giao diện và hàm dùng chung
        ├── phan1\                   ← bt1.php … bt10.php
        └── phan2\                   ← trang PHP-MySQL, ketnoi.php, online_shop.sql, HINHANH\
```

`server\` trên máy gốc là thư mục cài XAMPP. Repo chỉ giữ phần code trong `server\htdocs\duanweb`, không chứa XAMPP.

## Chạy thử (không bắt buộc)

1. Cài XAMPP **có PHP 8.2 trở lên** (https://www.apachefriends.org) vào thư mục `D:\tranhoanglong\server`.
2. Mở `D:\tranhoanglong\server\xampp-control.exe`, bấm **Start** cho **Apache** và **MySQL**.
3. Vào http://localhost/phpmyadmin → tab **Import** → chọn `server\htdocs\duanweb\phanPHP\phan2\online_shop.sql` → **Import** (chỉ cần cho Phần 2).
4. Mở http://localhost/duanweb/phanPHP/. Trang quản trị đăng nhập bằng **admin / admin123**.

| Lỗi | Cách sửa |
|---|---|
| `localhost` không vào được | Xem dòng `Listen` trong `server\apache\conf\httpd.conf`; ví dụ `Listen 8080` thì vào http://localhost:8080/duanweb/phanPHP/ |
| `Không thể kết nối đến CSDL online_shop` | MySQL chưa Start, hoặc chưa import `online_shop.sql` |
| `Call to undefined method mysqli::execute_query()` | PHP cũ hơn 8.2, cài XAMPP bản mới hơn |
