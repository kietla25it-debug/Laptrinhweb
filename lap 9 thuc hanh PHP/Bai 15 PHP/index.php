<?php
session_start();
require_once("./config.php");
if (!isset($_SESSION['voted_questions'])) {
    $_SESSION['voted_questions'] = array();
}

$voted_count = count($_SESSION['voted_questions']);

$idBC = isset($_GET['idBC']) ? intval($_GET['idBC']) : 1;

if ($voted_count >= 3) {
    header("Location: ketquabinhchon.php?mode=all");
    exit();
}
if (in_array($idBC, $_SESSION['voted_questions'])) {
    $res_next = mysqli_query($config, "SELECT idBC FROM binhchon WHERE idBC NOT IN (" . implode(',', $_SESSION['voted_questions']) . ") LIMIT 1");
    if ($row_next = mysqli_fetch_array($res_next)) {
        $idBC = $row_next['idBC'];
    }
}

$sql_q = "SELECT * FROM binhchon WHERE idBC = $idBC";
$res_q = mysqli_query($config, $sql_q);
$current_q = mysqli_fetch_array($res_q);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bình Chọn Trực Tuyến</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="poll-card">
        <div class="poll-header">
            <h2>BÌNH CHỌN TRỰC TUYẾN</h2>
        </div>
        
        <div class="poll-body">
            <!-- Thanh hiển thị tiến độ -->
            <div class="progress-tracker">
                <span>Tiến độ bình chọn:</span>
                <span class="badge-completed">Đã hoàn thành <?php echo $voted_count; ?>/3 câu</span>
            </div>

            <div class="question-title">
                Câu <?php echo $idBC; ?>: <?php echo $current_q['MoTa']; ?>
            </div>

            <form method="get" action="xulybinhchon.php">
                <input type="hidden" name="idBC" value="<?php echo $idBC; ?>" />

                <div class="option-group">
                    <?php
                    $s = "SELECT * FROM phuongan WHERE idBC = $idBC";
                    $kq = mysqli_query($config, $s);
                    $i = 0;
                    while ($row = mysqli_fetch_array($kq)) {
                    ?>
                        <label class="option-item">
                            <input type="radio" value="<?php echo $row['idPA']; ?>" name="idPA" <?php if ($i == 0) { echo "checked"; $i++; } ?> />
                            <span class="option-text"><?php echo $row['MoTa']; ?></span>
                        </label>
                    <?php } ?>
                </div>

                <button type="submit" name="Submit" class="btn-submit">
                    <?php echo ($voted_count == 2) ? "Hoàn Thành & Xem Tất Cả Kết Quả" : "Gửi Bình Chọn Câu Này"; ?>
                </button>
            </form>
        </div>
    </div>

</body>
</html>