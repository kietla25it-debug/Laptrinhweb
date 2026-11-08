<?php include 'header.php'; ?>

<h2> Form Upload Hình Ảnh</h2>

<form action="upload_xuly.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>">
    
    <div class="form-group">
        <label>Chọn tệp hình ảnh (.jpg, .png, .gif):</label>
        <input type="file" name="ufile" required>
    </div>

    <button type="submit" name="upload" class="btn-upload"> Tải Ảnh Lên Server</button>
</form>

</div> 
</body>
</html>