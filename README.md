# Lập trình web mã nguồn mở - Bài tập PHP

Bài tập môn Lập trình web mã nguồn mở của Trần Hoàng Long.

- **Phần 1 - PHP căn bản** (`phan1/`): 10 bài máy tính, giải phương trình, tam giác, bảng cửu chương, số nguyên tố, ngày tháng…
- **Phần 2 - PHP và MySQL** (`phan2/`): đăng ký thành viên có upload ảnh đại diện, đăng nhập, trang quản trị sửa/xóa người dùng.

## Cấu trúc thư mục (giữ y nguyên trên mọi máy)

```
D:\tranhoanglong\
├── PHAN 1 - php.doc, PHAN 2 - php va SQL.pdf, ...   ← đề bài và tài liệu
└── server\                                          ← XAMPP cài vào đây
    └── htdocs\duanweb\                              ← code bài tập
        ├── hinhanh\            ← ảnh banner
        └── phanPHP\
            ├── index.php       ← trang chủ
            ├── css\, includes\ ← giao diện và hàm dùng chung
            ├── phan1\          ← bt1.php … bt10.php
            └── phan2\          ← trang PHP-MySQL, ketnoi.php, online_shop.sql, HINHANH\ (ảnh upload)
```

Repo chỉ chứa đề bài và code. XAMPP (`server\` trừ `htdocs\duanweb`) không có trên GitHub, mỗi máy tự cài.

## Cài đặt trên máy mới

### 1. Cài XAMPP vào `D:\tranhoanglong\server`

Tải XAMPP **có PHP 8.2 trở lên** tại https://www.apachefriends.org.
Khi cài, ở bước chọn thư mục, nhập đúng: `D:\tranhoanglong\server`

### 2. Lấy code về đúng chỗ (không ảnh hưởng file cũ)

Vì `D:\tranhoanglong` đã có XAMPP nên **không dùng `git clone`** (clone chỉ chạy vào thư mục trống).
Mở **Git Bash** hoặc **PowerShell** và chạy:

```
cd D:\tranhoanglong
git init -b main
git remote add origin https://github.com/trhlow/laptrinhwebmanguonmo.git
git fetch origin
git checkout main
```

Các lệnh này chỉ thêm file của repo vào. File XAMPP và các file khác đang có trên máy giữ nguyên.

Nếu máy đã có sẵn file **trùng tên mà nội dung khác**, git sẽ **dừng lại, không ghi đè** và báo:

```
error: The following untracked working tree files would be overwritten by checkout:
        server/htdocs/duanweb/phanPHP/index.php
Aborting
```

Đổi tên hoặc chép các file được liệt kê sang chỗ khác để giữ lại, rồi chạy lại `git checkout main`.

### 3. Tạo cơ sở dữ liệu (cần cho Phần 2)

1. Mở **XAMPP Control Panel** (`D:\tranhoanglong\server\xampp-control.exe`), bấm **Start** cho **Apache** và **MySQL**.
2. Vào http://localhost/phpmyadmin → tab **Import** → **Choose File** → chọn
   `D:\tranhoanglong\server\htdocs\duanweb\phanPHP\phan2\online_shop.sql` → bấm **Import**.

File này tự tạo CSDL `online_shop` gồm bảng `nguoi_dung`, bảng `admin` và tài khoản quản trị mặc định.

### 4. Mở trang web

http://localhost/duanweb/phanPHP/

- Phần 1 chạy được ngay, không cần CSDL.
- Phần 2: đăng ký thành viên ở menu trái; trang quản trị đăng nhập bằng **admin / admin123**.

## Cập nhật code mới

Khi repo có thay đổi, trên máy đã cài chỉ cần:

```
cd D:\tranhoanglong
git pull
```

## Lỗi thường gặp

| Lỗi | Cách sửa |
|---|---|
| `fatal: destination path ... already exists and is not an empty directory` | Đã dùng `git clone` vào thư mục có sẵn file. Làm theo bước 2 thay vì clone |
| `localhost` không vào được | Apache có thể đang chạy cổng khác. Xem dòng `Listen` trong `D:\tranhoanglong\server\apache\conf\httpd.conf`; ví dụ `Listen 8080` thì vào http://localhost:8080/duanweb/phanPHP/ |
| Apache không Start được | Cổng 80 bị chương trình khác chiếm (Skype, IIS…). Tắt chương trình đó, hoặc đổi `Listen 80` thành `Listen 8080` |
| `Không thể kết nối đến CSDL online_shop` | MySQL chưa Start, hoặc chưa import `online_shop.sql` (bước 3) |
| MySQL có đặt mật khẩu cho `root` | Sửa mật khẩu trong `phanPHP\phan2\ketnoi.php` |
| `Call to undefined method mysqli::execute_query()` | PHP cũ hơn 8.2, cài XAMPP bản mới hơn |
| Không lưu được ảnh đại diện | Kiểm tra thư mục `phanPHP\phan2\HINHANH\` có tồn tại và ghi được |
