CREATE DATABASE IF NOT EXISTS `quan_ly_nhac` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `quan_ly_nhac`;

-- Bảng bài hát
CREATE TABLE IF NOT EXISTS `songs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `artist` varchar(255) NOT NULL,
  `cover_img` varchar(500) NOT NULL,
  `youtube_embed` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `songs` (`id`, `title`, `artist`, `cover_img`, `youtube_embed`) VALUES
(1, 'Yêu Ngược Lối', 'Ca sĩ A', 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=500', 'https://www.youtube.com/embed/dQw4w9WgXcQ'),
(2, 'Sóng Gió', 'Jack & K-ICM', 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=500', 'https://www.youtube.com/embed/2vjPBrBU-TM'),
(3, 'Vầng Trăng Khóc', 'Ưng Hoàng Phúc & Thu Thủy', 'https://images.unsplash.com/photo-1518495973542-4542c06a5843?q=80&w=500', 'https://www.youtube.com/embed/5qap5aO4i9A');

-- Bảng đánh giá sao
CREATE TABLE IF NOT EXISTS `rating_info` (
  `product_id` int(10) NOT NULL,
  `rate_1` int(10) NOT NULL DEFAULT '0',
  `rate_2` int(10) NOT NULL DEFAULT '0',
  `rate_3` int(10) NOT NULL DEFAULT '0',
  `rate_4` int(10) NOT NULL DEFAULT '0',
  `rate_5` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `rating_info` (`product_id`, `rate_1`, `rate_2`, `rate_3`, `rate_4`, `rate_5`) VALUES
(1, 1, 2, 5, 15, 50),
(2, 0, 1, 4, 25, 80),
(3, 2, 3, 10, 30, 100);

-- Bảng lưu chi tiết các bình luận/ghi chú đánh giá của người dùng
CREATE TABLE IF NOT EXISTS `rating_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `song_id` int(11) NOT NULL,
  `rating_star` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;