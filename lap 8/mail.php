<?php
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail = new PHPMailer(true);

    try {
        // --- 1. CẤU HÌNH SERVER SMTP ---
        $mail->isSMTP();
        $mail->CharSet    = 'UTF-8';
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;

        // Thông tin tài khoản của bạn
        $nguoigui    = 'kietla.25it@vku.udn.vn';     // Đổi lại đúng Gmail của bạn
        $matkhau     = 'dykm dvuy hcjr ofdp';  // Mật khẩu ứng dụng 16 ký tự
        $tennguoigui = 'Anh Kiệt';

        $mail->Username   = $nguoigui;
        $mail->Password   = $matkhau;
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        // --- 2. THÔNG TIN NGƯỜI NHẬN VÀ NỘI DUNG TỪ FORM ---
        $mail->setFrom($nguoigui, $tennguoigui);
        
        $to      = $_POST['email'];
        $tieude  = $_POST['tieude'];
        $noidung = $_POST['content'];

        $mail->addAddress($to, "Người Nhận");

        // --- 3. XỬ LÝ TỆP ĐÍNH KÈM (FILE UPLOAD) ---
        if (isset($_FILES['file']['name']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
            $uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['file']['name']));
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                $mail->addAttachment($uploadfile, $_FILES['file']['name']);
            }
        }

        // --- 4. SOẠN THƯ HTML ---
        $mail->isHTML(true);
        $mail->Subject = $tieude;
        $mail->Body    = '
            <div style="border: 1px solid #ddd; padding: 15px; border-radius: 5px;">
                <h3><b>Xin chào!</b></h3>
                <p>' . nl2br(htmlspecialchars($noidung)) . '</p>
            </div>';

        // Bỏ qua kiểm tra chứng chỉ SSL
        $mail->smtpConnect(array(
            "ssl" => array(
                "verify_peer"       => false,
                "verify_peer_name"  => false,
                "allow_self_signed" => true
            )
        ));

        // --- 5. GỬI MAIL VÀ CHUYỂN HƯỚNG ---
        if ($mail->send()) {
            echo "<script>alert('Đã gửi email thành công!'); window.location.href='index.php';</script>";
        }

    } catch (Exception $e) {
        echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
    }
}
?>