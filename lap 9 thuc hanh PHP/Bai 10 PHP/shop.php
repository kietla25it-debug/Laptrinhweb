<?php
session_start();
// Nếu chưa đăng nhập, đá văng ra ngoài
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Cửa Hàng Công Nghệ</title>
    <style>
        body { margin: 0; font-family: 'Segoe UI', Tahoma, sans-serif; background: #f4f7f6; color: #2d3436; }
    
        .navbar {
            background: #ffffff; padding: 15px 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex; justify-content: space-between; /* Đẩy Logo sang trái, Nút sang phải */
            align-items: center; position: sticky; top: 0;
        }
        .navbar .logo { font-size: 24px; font-weight: bold; color: #0984e3; }
        .navbar .user-menu { display: flex; align-items: center; gap: 15px; }
        .navbar .btn-logout {
            background: #ff7675; color: white; text-decoration: none; padding: 8px 20px;
            border-radius: 6px; font-weight: bold; transition: 0.2s;
        }
        .navbar .btn-logout:hover { background: #d63031; }

        /* DANH SÁCH SẢN PHẨM */
        .container { max-width: 1000px; margin: 40px auto; padding: 0 20px; }
        .title { text-align: center; margin-bottom: 40px; font-size: 28px; }
        .product-grid { display: flex; gap: 20px; justify-content: center; }
        .product-card {
            background: white; padding: 20px; border-radius: 12px; width: 30%;
            text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.05); transition: 0.3s;
        }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .product-card img { width: 100%; height: 200px; object-fit: cover; border-radius: 8px; margin-bottom: 15px; background: #dfe6e9; }
        .product-card h3 { margin: 0 0 10px 0; color: #0984e3; }
        .product-card .price { color: #d63031; font-weight: bold; font-size: 18px; margin-bottom: 15px; }
        .product-card .btn-buy {
            background: #00b894; color: white; border: none; padding: 10px; width: 100%;
            border-radius: 6px; font-weight: bold; cursor: pointer;
        }
    </style>
</head>
<body>


    <div class="navbar">
        <div class="logo">🛒 TechShop</div>
        <div class="user-menu">
            <span>Xin chào, <b><?php echo $_SESSION['username']; ?></b>!</span>
            <a href="logout.php" class="btn-logout">🚪 Đăng xuất</a>
        </div>
    </div>

    <div class="container">
        <h1 class="title">Sản Phẩm Mới Nhất</h1>
        <div class="product-grid">
            <div class="product-card">
                <!-- Dùng ảnh placeholder tạm thời -->
                <img src="https://via.placeholder.com/300x200?text=iPhone+15" alt="Product">
                <h3>iPhone 15 Pro</h3>
                <div class="price">25.000.000 VNĐ</div>
                <button class="btn-buy">Thêm vào giỏ</button>
            </div>
            <div class="product-card">
                <img src="https://via.placeholder.com/300x200?text=MacBook+Air" alt="Product">
                <h3>MacBook Air M2</h3>
                <div class="price">28.500.000 VNĐ</div>
                <button class="btn-buy">Thêm vào giỏ</button>
            </div>
            <div class="product-card">
                <img src="https://via.placeholder.com/300x200?text=AirPods+Pro" alt="Product">
                <h3>AirPods Pro 2</h3>
                <div class="price">5.500.000 VNĐ</div>
                <button class="btn-buy">Thêm vào giỏ</button>
            </div>
        </div>
    </div>

</body>
</html>