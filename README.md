# Lập trình web mã nguồn mở - Bài tập PHP

Bài tập môn Lập trình web mã nguồn mở của Trần Hoàng Long.

- **Phần 1 - PHP căn bản:** 10 bài gồm máy tính, giải phương trình bậc I và II, diện tích, tam giác, số ngày trong tháng, bảng cửu chương, số nguyên tố, ngày tháng.
- **Phần 2 - PHP và MySQL:** đăng ký thành viên có upload ảnh đại diện, đăng nhập, trang quản trị sửa/xóa người dùng.

## Cấu trúc thư mục

```
phanPHP/
├── index.php            ← trang chủ, liệt kê bài tập 2 phần
├── css/style.css
├── includes/            ← header, footer, functions dùng chung
├── hinhanh/             ← ảnh banner, ảnh sách
├── de-bai/              ← đề bài Phần 1
├── phan1/               ← bt1.php … bt10.php
└── phan2/
    ├── online_shop.sql  ← tạo CSDL online_shop (bảng nguoi_dung, admin, loai_sach, sach) và dữ liệu mẫu
    ├── ketnoi.php       ← kết nối CSDL
    ├── dangky.php, xlydangky.php, trangtt_canhan.php
    ├── xuly_dangnhap.php ← xử lý khung đăng nhập bên phải (chung cho quản trị và người dùng)
    ├── thoat.php        ← đăng xuất (chung cho quản trị và người dùng)
    ├── quantri.php, sua.php, thuchien_sua.php, xoa.php
    └── HINHANH/         ← ảnh đại diện người dùng upload
```

## Cài đặt và chạy

### 1. Cài XAMPP

Cài XAMPP **có PHP 8.2 trở lên** (https://www.apachefriends.org). Mở **XAMPP Control Panel**, bấm **Start** cho **Apache** và **MySQL**.

### 2. Lấy code về

Clone vào thư mục `htdocs` của XAMPP, trong thư mục `duanweb`:

```
cd <thư mục XAMPP>\htdocs
mkdir duanweb
cd duanweb
git clone https://github.com/trhlow/laptrinhwebmanguonmo.git phanPHP
```

Trên máy gốc, code nằm ở `D:\tranhoanglong\server\htdocs\duanweb\phanPHP`.

### 3. Tạo cơ sở dữ liệu (cần cho Phần 2)

Vào http://localhost/phpmyadmin → tab **Import** → chọn `phanPHP/phan2/online_shop.sql` → bấm **Import**.

### 4. Mở trang web

http://localhost/duanweb/phanPHP/

- Phần 1 chạy được ngay, không cần CSDL.
- Phần 2: đăng ký thành viên ở menu trái. Quản trị và người dùng đăng nhập chung ở **khung bên phải**:
  - Quản trị: **admin / admin123** hoặc **quantri / 123456**, đăng nhập xong vào trang Quản trị.
  - Người dùng mẫu: **nguyenvana / 123456** hoặc **tranthib / 123456**, đăng nhập xong vào trang Thông tin cá nhân.

## Những điểm đã chỉnh sửa so với code mẫu Phần 2

- Đổi các hàm `mysql_*` (đã bị xóa từ PHP 7) sang `mysqli`.
- Dùng prepared statement để chống SQL injection.
- Mã hóa mật khẩu bằng hàm MD5 (theo yêu cầu của cô).
- Kiểm tra ảnh upload: chỉ nhận ảnh JPG, PNG, GIF, WEBP tối đa 1MB, đặt tên ngẫu nhiên để không ghi đè ảnh của người khác.
- Sửa lỗi trong code mẫu:
  - Giá trị quốc gia giữa form đăng ký và form sửa không khớp.
  - Trang quản trị chào sai biến session.
  - Các trang chuyển hướng về trang `dangkyQT.php` không tồn tại.
  - Người không có quyền vẫn chạy được phần còn lại của trang.
- Đổi kiểu cột `gioitinh` từ `BIT` sang `TINYINT` để hiện đúng Nam/Nữ.
- Xóa người dùng bằng nút có hỏi xác nhận, không xóa qua link.

## Lỗi thường gặp

| Lỗi | Cách sửa |
|---|---|
| `localhost` không vào được | Apache có thể chạy cổng khác. Xem dòng `Listen` trong `apache\conf\httpd.conf`; ví dụ `Listen 8080` thì vào http://localhost:8080/duanweb/phanPHP/ |
| `Không thể kết nối đến CSDL online_shop` | MySQL chưa Start, hoặc chưa import `online_shop.sql` |
| MySQL có đặt mật khẩu cho `root` | Sửa mật khẩu trong `phan2/ketnoi.php` |
| `Call to undefined method mysqli::execute_query()` | PHP cũ hơn 8.2, cài XAMPP bản mới hơn |
