<?php
if(isset($_POST['rate_submit']) && isset($_POST['rate']) && isset($_POST['song_id'])){
    $conn = mysqli_connect("localhost", "root", "", "csdl_nhac_v2") or die("Lỗi kết nối CSDL");
    mysqli_set_charset($conn, "utf8");

    $song_id = (int)$_POST['song_id'];
    $rate = (int)$_POST['rate'];
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    // 1. Cập nhật số sao vào bảng thống kê rating_info
    if($rate >= 1 && $rate <= 5){
        $query_update = "UPDATE rating_info SET rate_".$rate." = rate_".$rate." + 1 WHERE product_id = ".$song_id;
        mysqli_query($conn, $query_update);
    }

    // 2. Lưu ghi chú bình luận vào bảng rating_comments
    $query_comment = "INSERT INTO rating_comments (song_id, rating_star, comment) VALUES ($song_id, $rate, '$comment')";
    mysqli_query($conn, $query_comment);

    // Lấy thông tin bài hát để gửi email
    $song_query = mysqli_query($conn, "SELECT title FROM songs WHERE id = $song_id");
    $song_data = mysqli_fetch_array($song_query);
    $song_title = $song_data ? $song_data['title'] : "Bài hát #$song_id";

    mysqli_close($conn);

    // 3. Gửi phiếu đánh giá về Gmail yêu cầu
    $to = "kietla.25it@vku.udn.vn";
    $subject = "[Phiếu Đánh Giá Nhạc] Bài hát: " . $song_title;
    $message = "Hệ thống vừa nhận được một đánh giá mới:\n\n" .
               "- Tên bài hát: " . $song_title . "\n" .
               "- Số sao đánh giá: " . $rate . " sao\n" .
               "- Ghi chú/Bình luận: " . $comment . "\n\n" .
               "Trân trọng,\nHệ thống Quản lý Âm nhạc Pro";
    $headers = "From: system@quanlynhac.com";

    @mail($to, $subject, $message, $headers);

    // Quay lại trang chi tiết bài hát
    header("Location: index.php?id=" . $song_id . "&status=success");
    exit();
}
?>