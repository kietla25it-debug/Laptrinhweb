<?php
// 1. Định nghĩa chuẩn đầu ra của file là XML/RSS
header("Content-type: text/xml; charset=utf-8");

// 2. Kết nối cơ sở dữ liệu MySQL
$conn = mysqli_connect("localhost", "root", "", "rss") or die("Không thể kết nối CSDL");
mysqli_set_charset($conn, "utf8");

// 3. Truy vấn lấy danh sách tin tức từ bảng news
$query = "SELECT * FROM news";
$result = mysqli_query($conn, $query);

$item = "";
// 4. Duyệt qua từng dòng dữ liệu để đóng gói vào thẻ <item> của RSS
while($row = mysqli_fetch_array($result)){
    $item .= '<item>';
    $item .= '<title><![CDATA[' . $row['title'] . ']]></title>';
    $item .= '<link>' . $row['link'] . '</link>';
    $item .= '<description><![CDATA[' . $row['description'] . ']]></description>';
    $item .= '</item>';
}

// 5. Xuất cấu trúc hoàn chỉnh của file RSS (XML)
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<rss version="2.0">';
echo '<channel>';
echo '<title>Học Web | Kênh Tin Tức PHP Pro</title>';
echo '<link>http://localhost/bai13/</link>';
echo '<description>Hệ thống cập nhật thông tin bài học lập trình PHP và MySQL thực tế.</description>';
echo '<language>vi-vn</language>';

// Chèn các item tin tức lấy từ CSDL vào đây
echo $item;

echo '</channel>';
echo '</rss>';
?>