<?php
session_start();

// 1. Tạo chuỗi ngẫu nhiên 6 ký tự từ md5
$string = md5(time() . rand(1000, 9999));
$string = substr($string, 0, 6);

// 2. Lưu vào SESSION để đối chiếu
$_SESSION['captcha'] = $string;

// 3. Tạo khung hình ảnh 160x50
$img = imagecreate(160, 50);

// 4. Thiết lập bảng màu
$bg_color     = imagecolorallocate($img, 15, 23, 42);     # Slate 900 (Nền tối hiện đại)
$text_color   = imagecolorallocate($img, 56, 189, 248);   # Sky 400 (Chữ xanh neon phát sáng)
$noise_color  = imagecolorallocate($img, 51, 65, 85);     # Slate 700 (Đường nhiễu)

// 5. Vẽ vài đường nhiễu chống bot đọc ảnh
for ($i = 0; $i < 5; $i++) {
    imageline($img, 0, rand(0, 50), 160, rand(0, 50), $noise_color);
}

// 6. Vẽ chuỗi Captcha lên ảnh
imagestring($img, 5, 50, 16, $string, $text_color);

// 7. Khai báo Header và xuất ảnh PNG
header("Content-type: image/png");
header("Cache-Control: no-cache, must-revalidate");
imagepng($img);
imagedestroy($img);
?>