<?php
// Nhúng các tệp thư viện PHPMailer vào chương trình
require "PHPMailer-master/src/PHPMailer.php";
require "PHPMailer-master/src/SMTP.php";
require 'PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Khởi tạo đối tượng PHPMailer
$mail = new PHPMailer(true);

try {
    // --- 1. CẤU HÌNH SERVER SMTP GMAIL ---
    // $mail->SMTPDebug = 2;              // Chế độ debug (bật khi muốn xem chi tiết lỗi kết nối)
    $mail->isSMTP();                      // Sử dụng giao thức SMTP
    $mail->CharSet    = 'UTF-8';          // Hỗ trợ tiếng Việt không bị lỗi font
    $mail->Host       = 'smtp.gmail.com'; // Máy chủ SMTP của Gmail
    $mail->SMTPAuth   = true;             // Bật xác thực SMTP

    // --- 2. THÔNG TIN TÀI KHOẢN GỬI ---
    $nguoigui    = 'kietla.25it@vku.udn.vn';       // Email Gmail người gửi (thay đúng đuôi @gmail.com của bạn nếu cần)
    $matkhau     = 'dykm dvuy hcjr ofdp';    // Mật khẩu ứng dụng 16 ký tự của bạn
    $tennguoigui = 'lê Anh Kiệt';              // Tên người gửi hiển thị

    $mail->Username   = $nguoigui;
    $mail->Password   = $matkhau;
    $mail->SMTPSecure = 'ssl';                // Phương thức mã hóa SSL
    $mail->Port       = 465;                  // Cổng kết nối SSL

    // --- 3. THÔNG TIN NGƯỜI NHẬN ---
    $mail->setFrom($nguoigui, $tennguoigui);
    
    $to       = 'nguyen_2251220246@dau.edu.vn';      // Địa chỉ email nhận thư
    $to_name  = 'Nguyên';                    // Tên người nhận
    $mail->addAddress($to, $to_name);

    // --- 4. NỘI DUNG EMAIL ---
    $mail->isHTML(true);                      // Định dạng nội dung dạng HTML
    $mail->Subject = 'Gửi thư từ PHP';
    $mail->Body    = '<b>Chào bạn!</b><br>chuyển tôi 5 xị  vào số này 9600167996551!';
    
    // Đính kèm tệp (nếu có tệp 4.jpg nằm cùng thư mục Bài 8)
    if (file_exists("4.jpg")) {
        $mail->addAttachment("4.jpg", "picture");
    }

    // Bỏ qua kiểm tra chứng chỉ SSL (Bắt buộc phải có để chạy mượt trên Localhost/XAMPP)
    $mail->smtpConnect(array(
        "ssl" => array(
            "verify_peer"       => false,
            "verify_peer_name"  => false,
            "allow_self_signed" => true
        )
    ));

    // --- 5. GỬI MAIL ---
    $mail->send();
    echo 'Đã gửi mail xong';

} catch (Exception $e) {
    echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
}
?>