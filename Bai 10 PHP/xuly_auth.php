<?php
session_start();

if (isset($_POST['register'])) {
   
    $_SESSION['mock_db_user'] = $_POST['reg_user'];
    $_SESSION['mock_db_pass'] = $_POST['reg_pass'];
    
    header("Location: register.php?msg=success");
    exit();
}

// XỬ LÝ ĐĂNG NHẬP
if (isset($_POST['login'])) {
    $user = $_POST['login_user'];
    $pass = $_POST['login_pass'];
    $db_user = isset($_SESSION['mock_db_user']) ? $_SESSION['mock_db_user'] : 'admin';
    $db_pass = isset($_SESSION['mock_db_pass']) ? $_SESSION['mock_db_pass'] : '12345';
    if ($user === $db_user && $pass === $db_pass) {
        $_SESSION['username'] = $user; // Cấp thẻ phiên làm việc (Session Đăng nhập)
        header("Location: shop.php");
        exit();
    } else {
        header("Location: login.php?error=1");
        exit();
    }
}
?>