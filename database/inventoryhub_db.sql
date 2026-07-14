-- Database: `inventoryhub_db`
CREATE DATABASE IF NOT EXISTS `inventoryhub_db`;
USE `inventoryhub_db`;

-- Table structure for table `users`
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('admin', 'user') DEFAULT 'user',
  `address_street` VARCHAR(255) DEFAULT NULL,
  `address_city` VARCHAR(100) DEFAULT NULL,
  `address_province` VARCHAR(100) DEFAULT NULL,
  `address_zip` VARCHAR(20) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `categories`
CREATE TABLE IF NOT EXISTS `categories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `products`
CREATE TABLE IF NOT EXISTS `products` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `category_id` INT NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `image` VARCHAR(255) DEFAULT NULL,
  `stock` INT DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `requests`
CREATE TABLE IF NOT EXISTS `requests` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  `quantity` INT DEFAULT 1,
  `purpose` TEXT NOT NULL,
  `status` ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `users`
-- passwords: admin123 and user123
INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `address_street`, `address_city`, `address_province`, `address_zip`) VALUES
(1, 'Admin Yesi', 'admin@gmail.com', '$2y$10$REAkaAqVustxLuHVJoAgWuPgvzAWqiC7TKcisFibeJgBwuaaKOhLm', 'admin', 'Jl. Kaliurang KM 12', 'Sleman', 'DI Yogyakarta', '55581'),
(2, 'User Biasa', 'user@gmail.com', '$2y$10$PH4IyeExm4IAaNYAhRc3Z.fIslwdXgQNE.CQ6DOcdefPi9y70L8CO', 'user', 'Jl. Margonda Raya No. 100', 'Depok', 'Jawa Barat', '16424')
ON DUPLICATE KEY UPDATE id=id;

-- Dumping data for table `categories`
INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Elektronik', 'Peralatan elektronik seperti laptop, proyektor, dll.'),
(2, 'Alat Tulis Kantor', 'Peralatan penunjang kerja kantor seperti kertas, spidol, dll.')
ON DUPLICATE KEY UPDATE id=id;

-- Dumping data for table `products`
INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `stock`) VALUES
(1, 1, 'Laptop Asus ROG', 'Laptop spesifikasi tinggi untuk editing dan development.', 5),
(2, 1, 'Proyektor Epson', 'Proyektor ruang rapat HD.', 3),
(3, 2, 'Papan Tulis Whiteboard', 'Papan tulis whiteboard ukuran 120x90 cm.', 2)
ON DUPLICATE KEY UPDATE id=id;
