<?php include 'header.php'; ?>

<h2> Kết Quả Xử Lý Upload</h2>

<?php
$thong_bao = "";
$trang_thai = false;
$target_file = "";

if (isset($_POST['upload'])) {
    if (isset($_FILES['ufile']) && $_FILES['ufile']['error'] == 0) {
        $file_name = basename($_FILES['ufile']['name']);
        $target_file = UPLOAD_DIR . $file_name;

        if (!preg_match('/\.(jpg|jpeg|png|gif)$/i', $file_name)) {
            $thong_bao = "Lỗi: Chỉ chấp nhận các định dạng file ảnh (.jpg, .png, .gif)!";
        } else if (file_exists($target_file)) {
            $thong_bao = "Lỗi: File '$file_name' đã tồn tại trên hệ thống!";
        } else {
            if (move_uploaded_file($_FILES['ufile']['tmp_name'], $target_file)) {
                $thong_bao = "Thành công: File <i>'$file_name'</i> đã được tải lên!";
                $trang_thai = true;
            } else {
                $thong_bao = "Lỗi hệ thống khi lưu file!";
            }
        }
    } else {
        $thong_bao = "Lỗi: Không có file nào được chọn hoặc file bị lỗi!";
    }
}
?>
<div class="alert <?php echo $trang_thai ? 'alert-success' : 'alert-error'; ?>">
    <?php echo $thong_bao; ?>
</div>
<?php if ($trang_thai && !empty($target_file)): ?>
    <div class="preview-box">
        <p style="margin-top:0; color:#0984e3; font-weight:bold;"> Ảnh vừa tải lên:</p>
        <img src="<?php echo $target_file; ?>" alt="Uploaded">
    </div>
<?php endif; ?>

<a href="index.php" class="back-btn">⬅ Quay lại</a>

</div> 
</body>
</html>