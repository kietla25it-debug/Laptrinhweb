<?php
require_once 'ketnoi.php';

// 1. XỬ LÝ THÊM & SỬA
if (isset($_POST['btn_save'])) {
    $id = (int)$_POST['id'];
    $ten = trim($_POST['ten_the_loai']);
    $mota = trim($_POST['mo_ta']);

    if ($id > 0) {
        // Lệnh SỬA (UPDATE)
        $stmt = $conn->prepare("UPDATE the_loai SET ten_the_loai = ?, mo_ta = ? WHERE id = ?");
        $stmt->bind_param("ssi", $ten, $mota, $id);
        $_SESSION['toast'] = ['icon' => 'success', 'title' => 'Cập nhật thành công!'];
    } else {
        // Lệnh THÊM (INSERT)
        $stmt = $conn->prepare("INSERT INTO the_loai (ten_the_loai, mo_ta) VALUES (?, ?)");
        $stmt->bind_param("ss", $ten, $mota);
        $_SESSION['toast'] = ['icon' => 'success', 'title' => 'Đã thêm thể loại mới!'];
    }
    
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
    exit();
}

// 2. XỬ LÝ XÓA
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    // Lệnh XÓA (DELETE)
    $stmt = $conn->prepare("DELETE FROM the_loai WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    
    $_SESSION['toast'] = ['icon' => 'success', 'title' => 'Đã xóa dữ liệu!'];
    
    header("Location: index.php");
    exit();
}

// Nếu gõ link bậy bạ, đẩy về trang chủ
header("Location: index.php");
exit();
?>