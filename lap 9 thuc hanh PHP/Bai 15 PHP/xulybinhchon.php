<?php 
session_start();
ob_start();
require_once("./config.php");

if (isset($_GET["idPA"]) && isset($_GET["idBC"])) {
    $idPA = intval($_GET["idPA"]);
    $idBC = intval($_GET["idBC"]);
    
    // Tăng số lượt bình chọn trong CSDL
    mysqli_query($config, "UPDATE binhchon SET SoLanChon = SoLanChon + 1 WHERE idBC = $idBC");
    mysqli_query($config, "UPDATE phuongan SET SoLanChon = SoLanChon + 1 WHERE idBC = $idBC AND idPA = $idPA");
    
    // Đánh dấu câu hỏi này đã được chọn vào Session
    if (!isset($_SESSION['voted_questions'])) {
        $_SESSION['voted_questions'] = array();
    }
    if (!in_array($idBC, $_SESSION['voted_questions'])) {
        $_SESSION['voted_questions'][] = $idBC;
    }
    
    // Nếu đã bình chọn đủ cả 3 câu -> Chuyển sang xem BẢNG TOÀN BỘ KẾT QUẢ
    if (count($_SESSION['voted_questions']) >= 3) {
        header('Location: ketquabinhchon.php?mode=all');
    } else {
        header("Location: ketquabinhchon.php?idBC=$idBC");
    }
    exit();
}
?>