<?php
session_start(); 
$host = "localhost";
$user = "root";
$pass = "";
$db_name = "bai11";

// Kết nối MySQLi hướng đối tượng
$conn = new mysqli($host, $user, $pass, $db_name);

if ($conn->connect_error) {
    die("Kết nối CSDL thất bại: " . $conn->connect_error);
}

// Set font tiếng Việt
$conn->set_charset("utf8mb4");
?>