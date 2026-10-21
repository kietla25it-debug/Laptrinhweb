<?php
require('util/main.php');

require('model/database.php');
require('model/product_db.php');

/***************************************
 * Delete a product
 ****************************************/

// Sample data
$product_name = 'Fender Telecaster';

// Delete the product and display an appropriate messge
$delete_message = "No rows were deleted.";

/***************************************
 * Insert a product
 ****************************************/

// Sample data
$category_id = 1;
$code = 'tele';
$name = 'Fender Telecaster';
$description = 'NA';
$price = '949.99';
$discount_percent = 0;   // hàm add_product() yêu cầu thêm tham số này

// Insert the data (hàm trả về ID của sản phẩm vừa thêm)
$product_id = add_product($category_id, $code, $name, $description,
                          $price, $discount_percent);

// Display an appropriate message
if ($product_id) {
    $insert_message = "Product '$name' was inserted (product ID: $product_id).";
} else {
    $insert_message = "No rows were inserted.";
}

/*********************************************
 * Select some products
 **********************************************/

// Bước 4: hiển thị category Guitars
$cat_id = 1;

// Lấy danh sách sau khi thêm để thấy sản phẩm mới
$products = get_products_by_category($cat_id);

include 'home.php';
?>