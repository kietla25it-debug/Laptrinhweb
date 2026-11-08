<?php
require_once 'ketnoi.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$ten_the_loai = "";
$mo_ta = "";
$is_edit = false;

// Nếu form nhận được ID -> Lấy dữ liệu cũ đổ vào để Sửa
if ($id > 0) {
    $is_edit = true;
    $stmt = $conn->prepare("SELECT * FROM the_loai WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        $ten_the_loai = $row['ten_the_loai'];
        $mo_ta = $row['mo_ta'];
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?= $is_edit ? "Cập Nhật" : "Thêm Mới" ?></title>
    <!-- Nhúng thư viện ngoài -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Nhúng file CSS của bạn -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container form-container">
    <div class="card p-4">
        <h3 class="text-center mb-4 fw-bold" style="color: #6c5ce7;">
            <?= $is_edit ? "<i class='fa-solid fa-pen-nib'></i> Sửa Thể Loại" : "<i class='fa-solid fa-layer-group'></i> Thêm Mới" ?>
        </h3>
        
        <form action="xuly.php" method="POST">
            <!-- Chuyền ID ngầm để xuly.php biết -->
            <input type="hidden" name="id" value="<?= $id ?>">
            
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="ten" name="ten_the_loai" placeholder="Tên thể loại" required value="<?= htmlspecialchars($ten_the_loai) ?>">
                <label for="ten">Tên thể loại (Ví dụ: Nhạc Pop)</label>
            </div>
            
            <div class="form-floating mb-4">
                <textarea class="form-control" id="mota" name="mo_ta" placeholder="Mô tả chi tiết" style="height: 120px"><?= htmlspecialchars($mo_ta) ?></textarea>
                <label for="mota">Mô tả chi tiết...</label>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" name="btn_save" class="btn btn-custom btn-lg rounded-pill fw-bold">
                    <?= $is_edit ? "<i class='fa-solid fa-floppy-disk'></i> Lưu Thay Đổi" : "<i class='fa-solid fa-paper-plane'></i> Xác Nhận" ?>
                </button>
            </div>
        </form>
        
        <div class="text-center mt-4">
            <a href="index.php" class="text-secondary text-decoration-none fw-semibold">
                <i class="fa-solid fa-arrow-left"></i> Quay lại trang chủ
            </a>
        </div>
    </div>
</div>

</body>
</html>