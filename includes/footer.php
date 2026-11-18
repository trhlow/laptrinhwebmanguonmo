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
                    <table>
                        <tr>
                            <td><label for="o-tendn">Tên đăng nhập:</label></td>
                            <td><input type="text" id="o-tendn" name="tendn" size="12" required></td>
                        </tr>
                        <tr>
                            <td><label for="o-matkhau">Mật khẩu:</label></td>
                            <td><input type="password" id="o-matkhau" name="matkhau" size="12" required></td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="Đăng nhập"></td>
                            <td><input type="reset" value="Hủy bỏ"></td>
                        </tr>
                    </table>
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
