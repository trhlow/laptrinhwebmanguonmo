        </div><!-- /.cot-giua -->

        <!-- Khung đăng nhập bên phải -->
        <div class="cot-phai">
            <div class="tieu-de-menu">Đăng nhập</div>
            <?php if (isset($_SESSION['nguoidung'])): ?>
                <div class="form-dang-nhap">
                    Xin chào <b><?= h($_SESSION['nguoidung']) ?></b><br>
                    <a href="<?= $goc ?>phan2/trangtt_canhan.php">Thông tin cá nhân</a> | <a href="<?= $goc ?>phan2/thoat.php">Thoát</a>
                </div>
            <?php else: ?>
                <form class="form-dang-nhap" method="post" action="<?= $goc ?>phan2/xuly_dangnhap.php">
                    <label>Tên đăng nhập: <input type="text" name="tendn" required></label>
                    <label>Mật khẩu: <input type="password" name="matkhau" required></label>
                    <div class="nhom-nut">
                        <input type="submit" value="Đăng nhập">
                        <input type="reset" value="Hủy bỏ">
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div><!-- /.noi-dung-chinh -->

    <!-- Chân trang -->
    <div class="chan-trang">
        CopyRight&copy; sachhay.com<br>
        Design by TrucMaiPham
    </div>
</div>
</body>
</html>
