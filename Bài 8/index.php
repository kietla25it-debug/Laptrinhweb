<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 2 - Gửi Email</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2 class="mb-4">Email tới bạn</h2>
    <form action="mail.php" method="POST" enctype="multipart/form-data" class="col-md-7 border p-4 rounded bg-light">
        <div class="form-group">
            <label>Email người nhận:</label>
            <input type="email" class="form-control" name="email" placeholder="Nhập email" required>
        </div>
        <div class="form-group">
            <label>Tiêu đề (Subject):</label>
            <input type="text" class="form-control" name="tieude" placeholder="Nhập tiêu đề" required>
        </div>
        <div class="form-group">
            <label>Nội dung:</label>
            <textarea name="content" class="form-control" rows="5" placeholder="Nhập nội dung thư" required></textarea>
        </div>
        <div class="form-group">
            <label>File đính kèm:</label>
            <input type="file" class="form-control-file" name="file">
        </div>
        <button type="submit" class="btn btn-primary">Gửi Mail</button>
    </form>
</body>
</html>