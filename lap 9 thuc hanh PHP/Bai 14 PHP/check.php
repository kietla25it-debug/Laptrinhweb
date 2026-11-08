<?php
session_start();

if (isset($_POST['submit'])) {
    $input = trim($_POST['input'] ?? '');

    // Kiểm tra tính chính xác (phân biệt hoa/thường)
    if (!empty($input) && isset($_SESSION['captcha']) && $input === $_SESSION['captcha']) {
        $_SESSION['status'] = "success";
        $_SESSION['message'] = "✓ Bạn đã nhập chính xác CAPTCHA!";
    } else {
        $_SESSION['status'] = "error";
        $_SESSION['message'] = "✕ Mã CAPTCHA không chính xác. Vui lòng thử lại!";
    }
}

// Quay trở lại trang chính
header("Location: index.php");
exit();
?>