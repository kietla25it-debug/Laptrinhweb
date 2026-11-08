<?php
// Kết nối cơ sở dữ liệu csdl_nhac_v2
$conn = mysqli_connect("localhost", "root", "", "csdl_nhac_v2") or die("Không thể kết nối CSDL: " . mysqli_connect_error());
mysqli_set_charset($conn, "utf8");

// Kiểm tra xem người dùng có đang click chọn xem chi tiết bài hát nào không
if(isset($_GET['id'])) {
    $song_id = (int)$_GET['id'];

    // Lấy thông tin bài hát từ CSDL
    $query_song = "SELECT * FROM songs WHERE id = " . $song_id;
    $result_song = mysqli_query($conn,$query_song) or die("Lỗi truy vấn bài hát: " . mysqli_error($conn));
    
    if(mysqli_num_rows($result_song) > 0) {
        $song = mysqli_fetch_array($result_song);

        // Lấy thông tin đánh giá của bài hát đó
        $query_rating = "SELECT * FROM rating_info WHERE product_id = " . $song_id;
        $result_rating = mysqli_query($conn,$query_rating) or die("Lỗi truy vấn đánh giá: " . mysqli_error($conn));$rate_5 = $rate_4 =$rate_3 = $rate_2 =$rate_1 = 0;
        $total_votes = 0;
        $average = 0;

        if(mysqli_num_rows($result_rating) > 0) {
            $row = mysqli_fetch_array($result_rating);
            $rate_5 = (int)$row['rate_5'];
            $rate_4 = (int)$row['rate_4'];
            $rate_3 = (int)$row['rate_3'];
            $rate_2 = (int)$row['rate_2'];
            $rate_1 = (int)$row['rate_1'];
            
            $total_votes =$rate_5 + $rate_4 +$rate_3 + $rate_2 +$rate_1;
            if($total_votes > 0) {$total_score = ($rate_5 * 5) + ($rate_4 * 4) + ($rate_3 * 3) + ($rate_2 * 2) + ($rate_1 * 1);$average = round($total_score / $total_votes, 1);
            }
        }

        // Tính phần trăm thanh biểu đồ
        $pct_5 =$total_votes > 0 ? round(($rate_5 / $total_votes) * 100) : 0;
        $pct_4 =$total_votes > 0 ? round(($rate_4 / $total_votes) * 100) : 0;
        $pct_3 =$total_votes > 0 ? round(($rate_3 / $total_votes) * 100) : 0;
        $pct_2 =$total_votes > 0 ? round(($rate_2 / $total_votes) * 100) : 0;
        $pct_1 =$total_votes > 0 ? round(($rate_1 / $total_votes) * 100) : 0;

        // Nhúng file giao diện chi tiết
        include("template/chi_tiet.php");
    } else {
        echo "Không tìm thấy bài hát này!";
    }

} else {
    // Nếu không có ID, hiển thị danh sách toàn bộ bài hát
    $query_songs = "SELECT * FROM songs";
    $result_songs = mysqli_query($conn,$query_songs) or die("Lỗi truy vấn danh sách bài hát: " . mysqli_error($conn));

    // Nhúng file giao diện danh sách
    include("template/danh_sach.php");
}

mysqli_close($conn);
?>