<?php require_once 'ketnoi.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Âm Nhạc Pro</title>
    <!-- Nhúng thư viện ngoài -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Nhúng file CSS của bạn -->
    <link rel="stylesheet" href="style.css">
</head>
<body class="py-5">

<div class="container">
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h2 class="text-primary fw-bold"><i class="fa-solid fa-music me-2"></i> Quản Lý Thể Loại</h2>
            <a href="form.php" class="btn btn-success btn-lg shadow-sm rounded-pill px-4">
                <i class="fa-solid fa-plus me-1"></i> Thêm Mới
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light text-secondary">
                    <tr>
                        <th width="10%" class="text-center">ID</th>
                        <th width="25%">Tên Thể Loại</th>
                        <th width="40%">Mô Tả Chi Tiết</th>
                        <th width="25%" class="text-center">Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM the_loai ORDER BY id DESC";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $id = $row['id'];
                            echo "<tr>";
                            echo "<td class='text-center'><span class='badge rounded-pill badge-id'>#{$id}</span></td>";
                            echo "<td><strong class='text-dark fs-5'>{$row['ten_the_loai']}</strong></td>";
                            echo "<td class='text-muted'>{$row['mo_ta']}</td>";
                            echo "<td class='text-center'>
                                    <a href='form.php?id={$id}' class='btn btn-warning btn-sm rounded-pill px-3 shadow-sm'>
                                        <i class='fa-solid fa-pen-to-square'></i> Sửa
                                    </a>
                                    <button onclick='confirmDelete({$id})' class='btn btn-danger btn-sm rounded-pill px-3 shadow-sm mt-1 mt-md-0'>
                                        <i class='fa-solid fa-trash'></i> Xóa
                                    </button>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='text-center py-5 text-muted'><i class='fa-regular fa-folder-open fs-1 d-block mb-3'></i> Chưa có dữ liệu!</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Hàm xác nhận xóa
    function confirmDelete(id) {
        Swal.fire({
            title: 'Bạn có chắc chắn?',
            text: "Dữ liệu thể loại này sẽ bị xóa vĩnh viễn!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c5ce7',
            confirmButtonText: 'Vâng, Xóa!',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'xuly.php?action=delete&id=' + id;
            }
        })
    }

    // Hiển thị thông báo sau khi Thêm/Sửa/Xóa thành công
    <?php if (isset($_SESSION['toast'])) { ?>
        const Toast = Swal.mixin({
            toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true
        });
        Toast.fire({
            icon: '<?php echo $_SESSION['toast']['icon']; ?>',
            title: '<?php echo $_SESSION['toast']['title']; ?>'
        });
    <?php unset($_SESSION['toast']); } ?>
</script>

</body>
</html>