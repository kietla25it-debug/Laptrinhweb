<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 8: Soạn Thảo Văn Bản CKEditor</title>
    <!-- Nhúng thư viện CKEditor -->
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: #f8f9fa;
            color: #2d3436;
            margin: 0;
            padding: 40px 20px;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: #ffffff;
            padding: 35px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }
        h2, h3 { color: #6C5CE7; margin-top: 0; }
        .form-group { margin-bottom: 25px; }
        label { display: block; font-weight: 600; margin-bottom: 8px; color: #4b6584; }
        input[type="text"] {
            width: 100%; padding: 12px; border: 1px solid #dcdde1;
            border-radius: 8px; font-size: 15px; box-sizing: border-box;
        }
        textarea {
            width: 100% !important;
            box-sizing: border-box;
        }
        .btn-submit {
            background: #6C5CE7; color: white; border: none;
            padding: 12px 30px; font-size: 16px; font-weight: bold;
            border-radius: 8px; cursor: pointer;
        }
        .btn-submit:hover { opacity: 0.9; }
        table {
            width: 100%; border-collapse: collapse; margin-top: 20px;
            background: #fff; border-radius: 8px; overflow: hidden;
            box-shadow: 0 0 0 1px #dcdde1;
        }
        th, td { padding: 12px 15px; border-bottom: 1px solid #f1f2f6; text-align: left; vertical-align: top; }
        th { background: #6C5CE7; color: white; width: 25%; }
        pre { margin: 0; white-space: pre-wrap; word-wrap: break-word; }
        .preview-box {
            margin-top: 20px; padding: 20px; background: #fdfdfd;
            border: 1px dashed #b2bec3; border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2> Soạn Thảo Nội Dung Nâng Cao (Bài 8)</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label>Tiêu đề bài viết:</label>
            <input type="text" name="tieu_de" placeholder="Nhập tiêu đề..." value="<?php echo isset($_POST['tieu_de']) ? htmlspecialchars($_POST['tieu_de']) : ''; ?>" required>
        </div>

        <div class="form-group">
            <label>Nội dung chi tiết (CKEditor):</label>
            <textarea name="tomtat" id="tomtat" rows="10"><?php echo isset($_POST['tomtat']) ? htmlspecialchars($_POST['tomtat']) : ''; ?></textarea>
            
            <script type="text/javascript">
                CKEDITOR.replace('tomtat', {
                    width: '100%',
                    height: 400
                });
            </script>
        </div>

        <button type="submit" name="ok" class="btn-submit"> Gửi Dữ Liệu Lên Server</button>
    </form>
</div>
<?php if (isset($_POST['ok'])): ?>
<div class="container">
    <h3> Bảng Dữ Liệu Nhận Được (Posted Data)</h3>
    <table>
        <thead>
            <tr>
                <th>Field Name</th>
                <th>Value (Dữ liệu thô)</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach ($_POST as $sForm => $value) {
            if ($sForm == 'ok') continue;
            echo "<tr>";
            echo "<th>" . htmlspecialchars($sForm) . "</th>";
            echo "<td><pre>" . htmlspecialchars($value) . "</pre></td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

    <div class="preview-box">
        <h3> Xem trước định dạng HTML thực tế của ô "tomtat":</h3>
        <div><?php echo isset($_POST['tomtat']) ? $_POST['tomtat'] : ''; ?></div>
    </div>
</div>
<?php endif; ?>

</body>
</html>