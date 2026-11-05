<?php
session_start();
// Kiểm tra nếu chưa đăng nhập thì không cho vào trang này
if(!isset($_SESSION["info"])){
    echo "<h2>Bạn chưa đăng nhập!</h2>";
    echo "<a href='login.html'>Quay lại trang đăng nhập</a>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Sinh Viên</title>
    <style>
        body { font: normal 14pt Arial; margin: 50px 100px; color: navy; }
        h2 { color: red; }
        .info { color: green; font-weight: bold; background-color: yellow; padding: 5px; border: 1px solid silver;}
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: solid 1px silver; padding: 10px; text-align: left; }
        th { background-color: #DAFEF3; color: navy; text-align: center;}
        .logout { display: inline-block; margin-top: 20px; padding: 8px 15px; background: #ddd; color: blue; text-decoration: none; border: 1px solid silver; border-radius: 5px; }
        .logout:hover { background: #DAFEF3; }
    </style>
</head>
<body>
    <h2>TRANG QUẢN LÝ SINH VIÊN</h2>
    <p>Thông tin đăng nhập: <span class="info"><?php echo $_SESSION["info"]; ?></span></p>
    
    <h3>Danh sách toàn bộ sinh viên:</h3>
    <table>
        <tr>
            <th>Mã SV</th>
            <th>Họ Tên</th>
            <th>Lớp</th>
            <th>Địa Chỉ</th>
        </tr>
        <?php
        // Kết nối cơ sở dữ liệu
        include("connect.php");
        mysqli_query($con, "SET NAMES 'utf8'");
        
        // Truy vấn lấy danh sách sinh viên
        $sql = "SELECT * FROM sinhvien";
        $result = mysqli_query($con, $sql);
        
        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['masv'] . "</td>";
                echo "<td>" . $row['hoten'] . "</td>";
                echo "<td>" . $row['lop'] . "</td>";
                echo "<td>" . $row['diachi'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4' style='text-align:center;'>Chưa có sinh viên nào</td></tr>";
        }
        
        // Giải phóng bộ nhớ và đóng kết nối
        mysqli_free_result($result);
        mysqli_close($con);
        ?>
    </table>
    
    <a href="login.html" class="logout">Đăng xuất</a>
</body>
</html>
