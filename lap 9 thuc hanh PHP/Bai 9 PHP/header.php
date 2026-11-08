<?php
// Cấu hình thư mục lưu ảnh và giới hạn dung lượng
define('UPLOAD_DIR', 'uploads/');
define('MAX_FILE_SIZE', 5000000); 
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 9: Kỹ thuật Upload Hình Ảnh</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #f4f7f6; color: #2d3436; padding: 50px 20px; margin: 0; }
        .container { max-width: 550px; margin: 0 auto; background: #ffffff; padding: 35px; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.08); }
        h2 { color: #0984e3; margin-top: 0; border-bottom: 2px solid #f1f2f6; padding-bottom: 12px; text-align: center; }
        .form-group { margin-bottom: 22px; }
        label { display: block; font-weight: 600; margin-bottom: 8px; color: #4b6584; }
        input[type="file"] { display: block; width: 100%; padding: 12px; border: 2px dashed #74b9ff; border-radius: 8px; background: #f8f9fa; box-sizing: border-box; cursor: pointer; }
        .btn-upload { background: #0984e3; color: white; border: none; padding: 12px 25px; font-size: 16px; font-weight: bold; border-radius: 8px; cursor: pointer; width: 100%; transition: 0.2s; }
        .btn-upload:hover { background: #74b9ff; }
        .alert { margin: 20px 0; padding: 15px; border-radius: 8px; font-weight: 600; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .preview-box { margin-top: 20px; background: #fafafa; padding: 15px; border-radius: 8px; border: 1px solid #dfe6e9; text-align: center; }
        .preview-box img { max-width: 100%; max-height: 300px; border-radius: 6px; }
        .back-btn { display: inline-block; margin-top: 20px; background: #dfe6e9; color: #2d3436; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>
<div class="container">