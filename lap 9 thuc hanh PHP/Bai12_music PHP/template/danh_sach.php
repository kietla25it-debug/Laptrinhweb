<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Kho Nhạc Hot & Đánh Giá</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #1E272E; color: #F1F2F6; margin: 0; padding: 40px; }
        .container { max-width: 700px; margin: 0 auto; }
        h1 { text-align: center; color: #FFD32A; margin-bottom: 25px; }
        .top-actions { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .btn-add { background: #00b894; color: white; padding: 10px 20px; border-radius: 20px; text-decoration: none; font-weight: bold; font-size: 14px; }
        .song-card {
            display: flex; align-items: center; background: rgba(47, 54, 64, 0.9);
            padding: 15px; margin-bottom: 15px; border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.1);
        }
        .song-card img { width: 70px; height: 70px; border-radius: 8px; object-fit: cover; margin-right: 20px; }
        .song-info { flex-grow: 1; }
        .song-info h3 { margin: 0 0 5px 0; font-size: 18px; color: #fff; }
        .song-info p { margin: 0; color: #A4B0BE; font-size: 14px; }
        .btn-listen {
            background: linear-gradient(135deg, #6C5CE7, #FD79A8); color: white;
            padding: 8px 20px; border-radius: 20px; text-decoration: none; font-weight: bold; font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎵 KHO NHẠC HOT & ĐÁNH GIÁ 🎵</h1>
        <div class="top-actions">
            <span style="color: #A4B0BE;">Danh sách bài hát nổi bật</span>
            <a href="them_nhac.php" class="btn-add">➕ Thêm bài hát mới</a>
        </div>
        
        <?php while($song = mysqli_fetch_array($result_songs)) { ?>
            <div class="song-card">
                <img src="<?php echo $song['cover_img']; ?>" alt="Cover">
                <div class="song-info">
                    <h3><?php echo $song['title']; ?></h3>
                    <p>Trình bày: <?php echo $song['artist']; ?></p>
                </div>
                <a href="index.php?id=<?php echo $song['id']; ?>" class="btn-listen">Nghe & Đánh Giá</a>
            </div>
        <?php } ?>
    </div>
</body>
</html>