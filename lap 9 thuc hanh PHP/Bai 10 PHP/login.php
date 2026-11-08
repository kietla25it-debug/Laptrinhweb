<?php 
session_start();
if (isset($_SESSION['username'])) { header("Location: shop.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Nhập</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .auth-box { background: white; padding: 40px; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.1); width: 350px; text-align: center; }
        h2 { color: #2d3436; margin-top: 0; margin-bottom: 20px; }
        input { width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #dfe6e9; border-radius: 8px; box-sizing: border-box; }
        .btn-submit { background: #0984e3; color: white; border: none; padding: 12px; width: 100%; border-radius: 8px; font-weight: bold; cursor: pointer; }
        .btn-submit:hover { background: #74b9ff; }
        .link { display: block; margin-top: 15px; color: #00b894; text-decoration: none; font-size: 14px; }
    </style>
</head>
<body>
    <div class="auth-box">
        <h2> Đăng Nhập</h2>
        <?php if(isset($_GET['error'])) echo "<p style='color:#d63031; font-weight:bold;'>Sai tài khoản hoặc mật khẩu!</p>"; ?>
        
        <form action="xuly_auth.php" method="POST">
            <input type="text" name="login_user" placeholder="Tên đăng nhập" required>
            <input type="password" name="login_pass" placeholder="Mật khẩu" required>
            <button type="submit" name="login" class="btn-submit"> Vào Cửa Hàng</button>
        </form>
        <a href="register.php" class="link">Chưa có tài khoản? Đăng ký mới</a>
    </div>
</body>
</html>