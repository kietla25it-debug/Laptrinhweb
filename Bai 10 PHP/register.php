<?php session_start(); ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Ký Tài Khoản</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .auth-box { background: white; padding: 40px; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.1); width: 350px; text-align: center; }
        h2 { color: #2d3436; margin-top: 0; margin-bottom: 20px; }
        input { width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #dfe6e9; border-radius: 8px; box-sizing: border-box; }
        .btn-submit { background: #00b894; color: white; border: none; padding: 12px; width: 100%; border-radius: 8px; font-weight: bold; cursor: pointer; }
        .btn-submit:hover { background: #00cec9; }
        .link { display: block; margin-top: 15px; color: #0984e3; text-decoration: none; font-size: 14px; }
    </style>
</head>
<body>
    <div class="auth-box">
        <h2> Tạo Tài Khoản</h2>
        <?php if(isset($_GET['msg'])) echo "<p style='color:#00b894; font-weight:bold;'>Đăng ký thành công! Hãy đăng nhập.</p>"; ?>
        
        <form action="xuly_auth.php" method="POST">
            <input type="text" name="reg_user" placeholder="Tên đăng nhập" required>
            <input type="password" name="reg_pass" placeholder="Mật khẩu" required>
            <button type="submit" name="register" class="btn-submit">Đăng Ký Ngay</button>
        </form>
        <a href="login.php" class="link">Đã có tài khoản? Đăng nhập tại đây</a>
    </div>
</body>
</html>