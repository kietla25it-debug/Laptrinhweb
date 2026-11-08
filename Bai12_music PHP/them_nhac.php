<?php
$conn = mysqli_connect("localhost", "root", "", "csdl_nhac_v2");
mysqli_set_charset($conn, "utf8");

$success = "";
if(isset($_POST['add_song'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $artist = mysqli_real_escape_string($conn, $_POST['artist']);
    $cover_img = mysqli_real_escape_string($conn, $_POST['cover_img']);
    $youtube_embed = mysqli_real_escape_string($conn, $_POST['youtube_embed']);

    // Thêm vào bảng songs
    $sql = "INSERT INTO songs (title, artist, cover_img, youtube_embed) VALUES ('$title', '$artist', '$cover_img', '$youtube_embed')";
    if(mysqli_query($conn, $sql)) {
        $new_id = mysqli_insert_id($conn);
        // Khởi tạo dòng thống kê sao cho bài hát mới
        mysqli_query($conn, "INSERT INTO rating_info (product_id, rate_1, rate_2, rate_3, rate_4, rate_5) VALUES ($new_id, 0, 0, 0, 0, 0)");
        $success = "Thêm bài hát mới thành công!";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Bài Hát Mới</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #1E272E; color: #fff; padding: 40px; display: flex; justify-content: center; }
        .form-box { background: rgba(47, 54, 64, 0.95); padding: 30px; border-radius: 15px; width: 100%; max-width: 500px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); }
        h2 { text-align: center; color: #FFD32A; margin-top: 0; }
        label { display: block; margin-bottom: 5px; color: #A4B0BE; font-size: 14px; }
        input { width: 100%; padding: 10px; margin-bottom: 15px; background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: #fff; outline: none; }
        button { background: linear-gradient(135deg, #6C5CE7, #FD79A8); color: white; border: none; padding: 12px; width: 100%; font-weight: bold; border-radius: 20px; cursor: pointer; }
        .back { display: block; text-align: center; margin-top: 15px; color: #A4B0BE; text-decoration: none; font-size: 14px; }
        .success { background: rgba(0,184,148,0.2); border: 1px solid #00b894; color: #55efc4; padding: 10px; border-radius: 6px; text-align: center; margin-bottom: 15px; font-size: 14px; }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>🎵 Thêm Bài Hát Mới</h2>
        <?php if($success) { echo "<div class='success'>$success</div>"; } ?>
        <form action="" method="POST">
            <label>Tên bài hát:</label>
            <input type="text" name="title" required placeholder="Ví dụ: Sóng Gió">
            
            <label>Ca sĩ trình bày:</label>
            <input type="text" name="artist" required placeholder="Ví dụ: Jack & K-ICM">
            
            <label>Link ảnh bìa (URL):</label>
            <input type="text" name="cover_img" required placeholder="https://...">
            
            <label>Link nhúng YouTube (Embed URL):</label>
            <input type="text" name="youtube_embed" required placeholder="https://www.youtube.com/embed/...">
            
            <button type="submit" name="add_song">Thêm Bài Hát</button>
        </form>
        <a href="index.php" class="back">⬅ Quay lại danh sách nhạc</a>
    </div>
</body>
</html>