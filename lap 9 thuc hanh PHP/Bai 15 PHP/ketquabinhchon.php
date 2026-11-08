<?php
session_start();
require_once("./config.php");

$voted_count = isset($_SESSION['voted_questions']) ? count($_SESSION['voted_questions']) : 0;
$mode = isset($_GET['mode']) ? $_GET['mode'] : '';

// Nếu đã chọn đủ 3 câu thì bắt buộc hiển thị chế độ 'all' (toàn bộ)
if ($voted_count >= 3) {
    $mode = 'all';
}

$idBC = isset($_GET['idBC']) ? intval($_GET['idBC']) : 1;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Kết Quả Bình Chọn</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="poll-card">
        <div class="poll-header">
            <h2><?php echo ($mode == 'all') ? "TỔNG HỢP KẾT QUẢ TOÀN BỘ 3 CÂU HỎI" : "KẾT QUẢ BÌNH CHỌN CÂU $idBC"; ?></h2>
        </div>

        <div class="poll-body">
            
            <?php if ($mode == 'all'): ?>
                <!-- HIỂN THỊ BẢNG TOÀN BỘ 3 CÂU HỎI -->
                <?php
                $sql_all_q = "SELECT * FROM binhchon ORDER BY idBC ASC";
                $res_all_q = mysqli_query($config, $sql_all_q);

                while ($q = mysqli_fetch_array($res_all_q)) {
                    $cur_idBC = $q['idBC'];
                    
                    // Tính tổng số lượt của câu hỏi này
                    $res_sum = mysqli_query($config, "SELECT SUM(SoLanChon) AS total FROM phuongan WHERE idBC = $cur_idBC");
                    $d_sum = mysqli_fetch_array($res_sum);
                    $total_votes = $d_sum['total'] ? $d_sum['total'] : 0;
                ?>
                    <div class="overall-block">
                        <div class="overall-title">Câu <?php echo $cur_idBC; ?>: <?php echo $q['MoTa']; ?></div>
                        
                        <?php
                        $res_pa = mysqli_query($config, "SELECT * FROM phuongan WHERE idBC = $cur_idBC");
                        while ($pa = mysqli_fetch_array($res_pa)) {
                            $percent = ($total_votes > 0) ? round(($pa['SoLanChon'] / $total_votes) * 100, 2) : 0;
                        ?>
                            <div class="result-row">
                                <div class="result-info">
                                    <span><?php echo $pa['MoTa']; ?></span>
                                    <span><?php echo $percent; ?>% (<?php echo $pa['SoLanChon']; ?> lượt)</span>
                                </div>
                                <div class="bar-container">
                                    <div class="bar-fill" data-progress="<?php echo $percent; ?>"></div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>

                <!-- Nút làm lại từ đầu -->
                <?php unset($_SESSION['voted_questions']); ?>
                <a href="index.php" class="back-link">🔄 Thực hiện bình chọn lại từ đầu</a>

            <?php else: ?>
                <!-- HIỂN THỊ KẾT QUẢ TỪNG CÂU ĐƠN LẺ -->
                <?php
                $q = mysqli_fetch_array(mysqli_query($config, "SELECT * FROM binhchon WHERE idBC = $idBC"));
                $d_sum = mysqli_fetch_array(mysqli_query($config, "SELECT SUM(SoLanChon) AS total FROM phuongan WHERE idBC = $idBC"));
                $total_votes = $d_sum['total'] ? $d_sum['total'] : 0;
                ?>
                <div class="question-title"><?php echo $q['MoTa']; ?></div>

                <?php
                $res_pa = mysqli_query($config, "SELECT * FROM phuongan WHERE idBC = $idBC");
                while ($pa = mysqli_fetch_array($res_pa)) {
                    $percent = ($total_votes > 0) ? round(($pa['SoLanChon'] / $total_votes) * 100, 2) : 0;
                ?>
                    <div class="result-row">
                        <div class="result-info">
                            <span><?php echo $pa['MoTa']; ?></span>
                            <span><?php echo $percent; ?>% (<?php echo $pa['SoLanChon']; ?> lượt)</span>
                        </div>
                        <div class="bar-container">
                            <div class="bar-fill" data-progress="<?php echo $percent; ?>"></div>
                        </div>
                    </div>
                <?php } ?>

                <br>
                <a href="index.php" class="btn-submit" style="display: block; text-align: center; text-decoration: none;">
                    Trang Bình Chọn Tiếp Theo (<?php echo $voted_count; ?>/3) →
                </a>
            <?php endif; ?>

        </div>
    </div>

    <!-- Script chạy hiệu ứng thanh % -->
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                document.querySelectorAll('.bar-fill').forEach(bar => {
                    bar.style.width = bar.getAttribute('data-progress') + '%';
                });
            }, 100);
        });
    </script>
</body>
</html>