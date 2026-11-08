<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<title>Đánh Giá & Nghe Nhạc: <?php echo $song['title']; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		:root {
			--primary-color: #6C5CE7; --secondary-color: #A29BFE;
			--accent-color: #FD79A8; --bg-dark: #1A1E24;
			--text-light: #F1F2F6; --star-color: #FFD32A;
			--card-bg: rgba(33, 37, 43, 0.95);
		}
		* { box-sizing: border-box; }
		body {
			font-family: 'Segoe UI', Tahoma, sans-serif;
			background: linear-gradient(135deg, var(--bg-dark) 0%, #111418 100%);
			color: var(--text-light); margin: 0; padding: 20px; min-height: 100vh;
			display: flex; justify-content: center; align-items: center;
		}
		#music-container {
			background: var(--card-bg); border-radius: 20px;
			box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6); width: 100%; max-width: 680px; padding: 30px;
			border: 1px solid rgba(255, 255, 255, 0.08);
		}
		.back-link { display: inline-block; color: #A4B0BE; text-decoration: none; margin-bottom: 20px; font-size: 14px; }
		.back-link:hover { color: #fff; }
		
		header { text-align: center; margin-bottom: 20px; }
		.song-title { font-size: 26px; font-weight: 800; margin: 0 0 5px 0; color: #fff; }
		.artist-name { font-size: 15px; color: var(--accent-color); margin: 0; }
		
		.youtube-wrapper {
			position: relative; width: 100%; padding-bottom: 56.25%; height: 0;
			border-radius: 14px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.4);
			margin-bottom: 25px; background: #000;
		}
		.youtube-wrapper iframe { position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0; }

		.stats-container {
			display: flex; justify-content: space-between; background: rgba(0,0,0,0.25);
			padding: 18px; border-radius: 14px; margin-bottom: 25px; align-items: center;
		}
		.average-score { text-align: center; flex: 1; border-right: 1px solid rgba(255,255,255,0.1); padding-right: 10px; }
		.average-score h1 { font-size: 42px; margin: 0; color: var(--star-color); font-weight: 800; }
		.average-score .stars { color: var(--star-color); font-size: 14px; margin: 3px 0; }
		.average-score p { margin: 0; color: #A4B0BE; font-size: 12px; }
		
		.rating-bars { flex: 1.5; padding-left: 20px; }
		.bar-row { display: flex; align-items: center; margin-bottom: 6px; font-size: 12px; }
		.bar-label { width: 35px; color: #A4B0BE; }
		.bar-track { flex-grow: 1; height: 6px; background: rgba(255,255,255,0.1); border-radius: 3px; margin: 0 8px; overflow: hidden; }
		.bar-fill { height: 100%; background: var(--star-color); border-radius: 3px; }
		.bar-count { width: 20px; text-align: right; color: #A4B0BE; }

		.rating-section { text-align: center; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 20px; }
		.rating-section h3 { margin: 0 0 10px 0; font-size: 16px; color: #F1F2F6; }
		
		.star-rating { direction: rtl; display: inline-block; margin-bottom: 10px; }
		.star-rating input { display: none; }
		.star-rating label { font-size: 36px; color: rgba(255,255,255,0.15); cursor: pointer; transition: color 0.2s; padding: 0 4px; }
		.star-rating label:hover, .star-rating label:hover ~ label, .star-rating input:checked ~ label { color: var(--star-color); }
		
		.comment-box { width: 100%; background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.1); padding: 10px; border-radius: 8px; color: #fff; margin-bottom: 15px; resize: none; height: 70px; outline: none; }
		
		.btn-submit {
			background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
			color: white; border: none; padding: 10px 30px; font-size: 15px; font-weight: bold;
			border-radius: 25px; cursor: pointer; box-shadow: 0 5px 15px rgba(108, 92, 231, 0.4);
		}
		.btn-submit:hover { opacity: 0.9; }

		.alert-success { background: rgba(0, 184, 148, 0.2); border: 1px solid #00b894; color: #55efc4; padding: 10px; border-radius: 6px; font-size: 13px; margin-bottom: 15px; }

		.comments-list { margin-top: 25px; text-align: left; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 15px; }
		.comment-item { background: rgba(0,0,0,0.2); padding: 10px; border-radius: 8px; margin-bottom: 10px; font-size: 13px; }
		.comment-item span { color: var(--star-color); }
	</style>
</head>
<body>
	<div id="music-container">
		<a href="index.php" class="back-link">⬅ Quay lại danh sách bài hát</a>
		
		<header>
			<h1 class="song-title"><?php echo $song['title']; ?></h1>
			<p class="artist-name">Trình bày: <?php echo $song['artist']; ?></p>
		</header>

		<!-- Trình phát Video YouTube giống bản gốc -->
		<div class="youtube-wrapper">
			<iframe src="<?php echo $song['youtube_embed']; ?>" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>

		<!-- Thống kê đánh giá -->
		<div class="stats-container">
			<div class="average-score">
				<h1><?php echo $average; ?></h1>
				<div class="stars">★ ★ ★ ★ ⯨</div>
				<p><?php echo $total_votes; ?> lượt đánh giá</p>
			</div>
			
			<div class="rating-bars">
				<div class="bar-row"><div class="bar-label">5 sao</div><div class="bar-track"><div class="bar-fill" style="width: <?php echo $pct_5; ?>%;"></div></div><div class="bar-count"><?php echo $rate_5; ?></div></div>
				<div class="bar-row"><div class="bar-label">4 sao</div><div class="bar-track"><div class="bar-fill" style="width: <?php echo $pct_4; ?>%;"></div></div><div class="bar-count"><?php echo $rate_4; ?></div></div>
				<div class="bar-row"><div class="bar-label">3 sao</div><div class="bar-track"><div class="bar-fill" style="width: <?php echo $pct_3; ?>%;"></div></div><div class="bar-count"><?php echo $rate_3; ?></div></div>
				<div class="bar-row"><div class="bar-label">2 sao</div><div class="bar-track"><div class="bar-fill" style="width: <?php echo $pct_2; ?>%;"></div></div><div class="bar-count"><?php echo $rate_2; ?></div></div>
				<div class="bar-row"><div class="bar-label">1 sao</div><div class="bar-track"><div class="bar-fill" style="width: <?php echo $pct_1; ?>%;"></div></div><div class="bar-count"><?php echo $rate_1; ?></div></div>
			</div>
		</div>

		<!-- Form Gửi Đánh Giá Sao & Ghi Chú Bình Luận -->
		<div class="rating-section">
			<?php if(isset($_GET['status']) && $_GET['status'] == 'success') { ?>
				<div class="alert-success">Đánh giá thành công! Phiếu đánh giá đã được gửi về Gmail: kietla.25it@vku.udn.vn.</div>
			<?php } ?>

			<h3>Gửi đánh giá và cảm nhận của bạn</h3>
			<form action="xử_lý_dánh_giá.php" method="POST">
				<input type="hidden" name="song_id" value="<?php echo $song['id']; ?>">
				<div class="star-rating">
					<input type="radio" id="star5" name="rate" value="5" required><label for="star5">★</label>
					<input type="radio" id="star4" name="rate" value="4"><label for="star4">★</label>
					<input type="radio" id="star3" name="rate" value="3"><label for="star3">★</label>
					<input type="radio" id="star2" name="rate" value="2"><label for="star2">★</label>
					<input type="radio" id="star1" name="rate" value="1"><label for="star1">★</label>
				</div>
				<br>
				<textarea name="comment" class="comment-box" placeholder="Nhập ghi chú hoặc bình luận của bạn về bài hát này..." required></textarea>
				<br>
				<button type="submit" name="rate_submit" class="btn-submit">Gửi Đánh Giá & Gửi Phiếu Về Gmail</button>
			</form>

			<!-- Hiển thị danh sách bình luận đã gửi -->
			<div class="comments-list">
				<h4 style="margin: 0 0 10px 0; color: var(--secondary-color); font-size: 14px;">💬 Bình luận gần đây:</h4>
				<?php
				$conn_cm = mysqli_connect("localhost", "root", "", "csdl_nhac_v2");
				$cm_result = mysqli_query($conn_cm, "SELECT * FROM rating_comments WHERE song_id = " . $song['id'] . " ORDER BY id DESC LIMIT 5");
				if(mysqli_num_rows($cm_result) > 0) {
					while($cm = mysqli_fetch_array($cm_result)) {
						echo '<div class="comment-item"><span>' . str_repeat('★', $cm['rating_star']) . '</span>: ' . htmlspecialchars($cm['comment']) . '</div>';
					}
				} else {
					echo '<p style="color: #A4B0BE; font-size: 12px; margin: 0;">Chưa có bình luận nào cho bài hát này.</p>';
				}
				mysqli_close($conn_cm);
				?>
			</div>
		</div>
	</div>
</body>
</html>