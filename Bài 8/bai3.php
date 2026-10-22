<?php
// Nhúng thư viện PHPMailer
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    // --- 1. CẤU HÌNH SERVER SMTP GMAIL ---
    $mail->isSMTP();                      // Sử dụng giao thức SMTP
    $mail->CharSet    = 'UTF-8';          // Định dạng font tiếng Việt
    $mail->Host       = 'smtp.gmail.com'; // Máy chủ SMTP
    $mail->SMTPAuth   = true;             // Bật xác thực SMTP

    // Thông tin tài khoản của bạn
    $nguoigui    = 'kietla.25it@vku.udn.vn';     // Email Gmail của bạn
    $matkhau     = 'dykm dvuy hcjr ofdp';  // Mật khẩu ứng dụng 16 ký tự
    $tennguoigui = 'Anh Kiệt';

    $mail->Username   = $nguoigui;
    $mail->Password   = $matkhau;
    $mail->SMTPSecure = 'ssl';                // Mã hóa SSL
    $mail->Port       = 465;                  // Cổng kết nối SSL

    // --- 2. THÔNG TIN NGƯỜI GỬI ---
    $mail->setFrom($nguoigui, $tennguoigui);

    // --- 3. THÊM NHIỀU NGƯỜI NHẬN ---
    // Danh sách các email nhận thư (phân cách bằng dấu phẩy)
    $recipients = "lekiet1704207@gmail.com, nguyen_2251220246@dau.edu.vn, ngocbao822008@gmail.com";
    
    // Tách chuỗi danh sách email thành mảng bằng hàm explode()
    $email_array = explode(",", $recipients);

    // Duyệt từng email trong mảng và thêm vào danh sách nhận thư
    foreach ($email_array as $email) {
        $mail->addAddress(trim($email)); // Hàm trim() để xóa khoảng trắng thừa
    }

    // --- 4. NỘI DUNG EMAIL ---
    $mail->isHTML(true);                  // Định dạng email là HTML
    $mail->Subject = 'Thông báo gửi email hàng loạt';
    $mail->Body    = '<b>Thân gửi các bạn!</b><br>gián đáng yêu ko dáng đáng yêu ko ?';

    // Bỏ qua kiểm tra chứng chỉ SSL (Khắc phục lỗi SSL trên Localhost/XAMPP)
    $mail->smtpConnect(array(
        "ssl" => array(
            "verify_peer"       => false,
            "verify_peer_name"  => false,
            "allow_self_signed" => true
        )
    ));

    // --- 5. TIẾN HÀNH GỬI MAIL ---
    $mail->send();
    echo 'Đã gửi email thành công cho tất cả danh sách!';

} catch (Exception $e) {
    echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
}
?>