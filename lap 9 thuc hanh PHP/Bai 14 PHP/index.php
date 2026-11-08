<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác minh CAPTCHA</title>
    <!-- Nhúng CSS riêng -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="captcha-card">
        <div class="card-header">
            <h2>Xác thực CAPTCHA</h2>
            <p>Vui lòng nhập đúng chuỗi ký tự bên dưới để tiếp tục.</p>
        </div>

        <!-- Form gửi action đến check.php -->
        <form action="check.php" method="POST">
            <div class="form-group">
                <div class="captcha-box">
                    <input type="text" name="input" placeholder="Nhập 6 ký tự..." autocomplete="off" required>
                    
                    <div class="img-wrapper">
                        <img src="captcha.php" id="captcha-img" alt="Captcha Code">
                        <!-- Nút Refresh đổi mã tức thì -->
                        <button type="button" class="btn-refresh" onclick="refreshCaptcha()" title="Đổi mã khác">↻</button>
                    </div>
                </div>
            </div>

            <button type="submit" name="submit" class="btn-submit">Xác Nhận</button>
        </form>

        <!-- Hiển thị thông báo đúng/sai -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert-message <?php echo $_SESSION['status']; ?>">
                <?php 
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    unset($_SESSION['status']);
                ?>
            </div>
        <?php endif; ?>
    </div>

    <script>
        // Hàm làm mới ảnh Captcha không reload trang
        function refreshCaptcha() {
            document.getElementById('captcha-img').src = 'captcha.php?' + new Date().getTime();
        }
    </script>
</body>
</html>