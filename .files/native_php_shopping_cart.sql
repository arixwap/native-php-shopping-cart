-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table native_php_shopping_cart.carts
CREATE TABLE IF NOT EXISTS `carts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(8) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table native_php_shopping_cart.carts: ~3 rows (approximately)
DELETE FROM `carts`;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'EtlvF', '2019-08-26 17:52:54', '2019-08-26 17:52:54'),
	(2, 'LItQO', '2019-08-26 18:40:50', '2019-08-26 18:40:50'),
	(4, 'uMbxb', '2019-08-27 11:08:01', '2019-08-27 11:08:01'),
	(8, 'oNgNI', '2019-08-27 19:37:44', '2019-08-27 19:37:44'),
	(9, 'YFgri', '2019-08-27 20:06:54', '2019-08-27 20:06:54'),
	(10, 'bLMbv', '2019-08-27 20:12:47', '2019-08-27 20:12:47');
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;

-- Dumping structure for table native_php_shopping_cart.cart_products
CREATE TABLE IF NOT EXISTS `cart_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cart_id` int(10) unsigned NOT NULL DEFAULT '0',
  `product_id` int(10) unsigned NOT NULL DEFAULT '0',
  `category_id` int(10) unsigned DEFAULT NULL,
  `category_name` varchar(250) DEFAULT NULL COMMENT 'last edited category name',
  `name` varchar(250) DEFAULT NULL COMMENT 'last edited product name',
  `description` text COMMENT 'last edited product description',
  `price` float DEFAULT NULL COMMENT 'last edited price',
  `images` text,
  `quantity` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table native_php_shopping_cart.cart_products: ~8 rows (approximately)
DELETE FROM `cart_products`;
/*!40000 ALTER TABLE `cart_products` DISABLE KEYS */;
INSERT INTO `cart_products` (`id`, `cart_id`, `product_id`, `category_id`, `category_name`, `name`, `description`, `price`, `images`, `quantity`, `created_at`, `updated_at`) VALUES
	(1, 1, 6, 2, 'Elektronik', 'Gold Mini Speaker', '', 40000, '["http://192.168.1.89/shopping-cart/public/images/products/gold-mini-speaker-20190826030718-0.jpg"]', 1, '2019-08-26 17:55:18', '2019-08-26 18:06:12'),
	(2, 1, 4, 2, 'Elektronik', 'Mini USB Fan', '', 25000, '["http://192.168.1.89/shopping-cart/public/images/products/mini-fan-20190826025941-0.jpg"]', 1, '2019-08-26 17:59:05', '2019-08-26 18:05:48'),
	(4, 1, 8, 3, 'Rumah Tangga', 'Pengupas Mie', '', 40000, '["http://192.168.1.89/shopping-cart/public/images/products/pengupas-mie-20190826130430-0.jpg","http://192.168.1.89/shopping-cart/public/images/products/pengupas-mie-20190826130430-1.jpg"]', 1, '2019-08-26 18:06:23', '2019-08-26 18:06:23'),
	(7, 2, 10, 1, 'Alat Tulis Kantor', 'Kotak Pensil', '', 25000, '["http://192.168.1.89/shopping-cart/public/images/products/kotak-pensil-20190826130534-0.jpg"]', 1, '2019-08-26 18:41:02', '2019-08-26 18:41:02'),
	(8, 2, 9, 1, 'Alat Tulis Kantor', 'Deli Tempat Alat Tulis', '', 120000, '["http://192.168.1.89/shopping-cart/public/images/products/deli-tempat-alat-tulis-20190826130511-0.jpg"]', 1, '2019-08-26 18:41:05', '2019-08-26 18:41:05'),
	(9, 1, 1, 2, 'Elektronik', 'Caddy Disk DVD', 'Caddy Disk untuk external Hardisk.\r\nMenggunakan slot DVD.', 135000, '["http://192.168.1.89/shopping-cart/public/images/products/caddy-disk-dvd-20190826025555-0.jpg","http://192.168.1.89/shopping-cart/public/images/products/caddy-disk-dvd-20190826025630-0.jpg","http://192.168.1.89/shopping-cart/public/images/products/caddy-disk-dvd-20190826025630-1.jpg","http://192.168.1.89/shopping-cart/public/images/products/caddy-disk-dvd-20190826025630-2.jpg"]', 1, '2019-08-26 18:50:25', '2019-08-26 18:50:25'),
	(13, 4, 9, 1, 'Alat Tulis Kantor', 'Deli Tempat Alat Tulis', '', 120000, '["http://192.168.1.89/shopping-cart/public/images/products/deli-tempat-alat-tulis-20190826130511-0.jpg"]', 1, '2019-08-27 11:08:01', '2019-08-27 11:08:13'),
	(14, 4, 10, 1, 'Alat Tulis Kantor', 'Kotak Pensil', '', 25000, '["http://192.168.1.89/shopping-cart/public/images/products/kotak-pensil-20190826130534-0.jpg"]', 1, '2019-08-27 11:08:07', '2019-08-27 11:08:07'),
	(22, 8, 9, 1, 'Alat Tulis Kantor', 'Deli Tempat Alat Tulis', '', 120000, '["http://localhost/shopping-cart/public/images/products/deli-tempat-alat-tulis-20190826130511-0.jpg"]', 1, '2019-08-27 19:37:44', '2019-08-27 19:37:44'),
	(23, 9, 9, 1, 'Alat Tulis Kantor', 'Deli Tempat Alat Tulis', '', 120000, '["http://192.168.1.89/shopping-cart/public/images/products/deli-tempat-alat-tulis-20190826130511-0.jpg"]', 1, '2019-08-27 20:06:54', '2019-08-27 20:06:54'),
	(24, 10, 10, 1, 'Alat Tulis Kantor', 'Kotak Pensil', '', 25000, '["http://192.168.1.89/shopping-cart/public/images/products/kotak-pensil-20190826130534-0.jpg"]', 1, '2019-08-27 20:12:47', '2019-08-27 20:12:47');
/*!40000 ALTER TABLE `cart_products` ENABLE KEYS */;

-- Dumping structure for table native_php_shopping_cart.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `slug` varchar(50) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table native_php_shopping_cart.categories: ~3 rows (approximately)
DELETE FROM `categories`;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `parent_id`, `slug`, `name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 0, 'alat-tulis-kantor', 'Alat Tulis Kantor', '', '2019-08-26 02:54:39', '2019-08-27 20:07:47'),
	(2, 0, 'elektronik', 'Elektronik', '', '2019-08-26 02:54:51', '2019-08-26 02:54:51'),
	(3, 0, 'rumah-tangga', 'Rumah Tangga', '', '2019-08-26 12:55:44', '2019-08-26 12:55:44');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table native_php_shopping_cart.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(8) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL COMMENT 'User Order Name',
  `address` text COMMENT 'User Order Address',
  `total_price` float unsigned DEFAULT NULL,
  `payment` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table native_php_shopping_cart.orders: ~2 rows (approximately)
DELETE FROM `orders`;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Dumping structure for table native_php_shopping_cart.order_products
CREATE TABLE IF NOT EXISTS `order_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL DEFAULT '0',
  `product_id` int(10) unsigned NOT NULL DEFAULT '0',
  `category_id` int(10) unsigned DEFAULT NULL,
  `category_name` varchar(250) DEFAULT NULL COMMENT 'last edited category name',
  `name` varchar(250) DEFAULT NULL COMMENT 'last edited product name',
  `description` text COMMENT 'last edited product description',
  `price` float DEFAULT NULL COMMENT 'last edited price',
  `images` text,
  `quantity` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table native_php_shopping_cart.order_products: ~3 rows (approximately)
DELETE FROM `order_products`;
/*!40000 ALTER TABLE `order_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_products` ENABLE KEYS */;

-- Dumping structure for table native_php_shopping_cart.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL DEFAULT '0',
  `slug` varchar(50) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` text,
  `price` float DEFAULT NULL,
  `images` text,
  `quantity` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table native_php_shopping_cart.products: ~9 rows (approximately)
DELETE FROM `products`;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `category_id`, `slug`, `name`, `description`, `price`, `images`, `quantity`, `created_at`, `updated_at`) VALUES
	(1, 2, 'caddy-disk-dvd', 'Caddy Disk DVD', 'Caddy Disk untuk external Hardisk.\r\nMenggunakan slot DVD.', 135000, '["http://192.168.1.89/shopping-cart/public/images/products/caddy-disk-dvd-20190826025555-0.jpg","http://192.168.1.89/shopping-cart/public/images/products/caddy-disk-dvd-20190826025630-0.jpg","http://192.168.1.89/shopping-cart/public/images/products/caddy-disk-dvd-20190826025630-1.jpg","http://192.168.1.89/shopping-cart/public/images/products/caddy-disk-dvd-20190826025630-2.jpg"]', 4, '2019-08-23 11:55:56', '2019-08-27 11:15:27'),
	(2, 2, 'mini-bluetooth-speaker', 'Mini Bluetooth Speaker', 'Menggunakan Bluetooth atau SD Card', 60000, '["http://192.168.1.89/shopping-cart/public/images/products/mini-bluetooth-speaker-20190826025714-0.png","http://192.168.1.89/shopping-cart/public/images/products/mini-bluetooth-speaker-20190826025714-1.jpg"]', 10, '2019-08-23 11:57:22', '2019-08-27 11:12:18'),
	(4, 2, 'mini-fan', 'Mini USB Fan', '', 25000, '["http://192.168.1.89/shopping-cart/public/images/products/mini-fan-20190826025941-0.jpg"]', 10, '2019-08-26 02:59:41', '2019-08-27 11:12:29'),
	(6, 2, 'gold-mini-speaker', 'Gold Mini Speaker', '', 40000, '["http://192.168.1.89/shopping-cart/public/images/products/gold-mini-speaker-20190826030718-0.jpg"]', 9, '2019-08-26 03:07:18', '2019-08-27 11:12:07'),
	(8, 3, 'pengupas-mie', 'Pengupas Mie', '', 40000, '["http://192.168.1.89/shopping-cart/public/images/products/pengupas-mie-20190826130430-0.jpg","http://192.168.1.89/shopping-cart/public/images/products/pengupas-mie-20190826130430-1.jpg"]', 8, '2019-08-26 13:04:30', '2019-08-27 11:12:57'),
	(9, 1, 'deli-tempat-alat-tulis', 'Deli Tempat Alat Tulis', '', 120000, '["http://192.168.1.89/shopping-cart/public/images/products/deli-tempat-alat-tulis-20190826130511-0.jpg"]', 3, '2019-08-26 13:05:11', '2019-08-27 20:13:02'),
	(10, 1, 'kotak-pensil', 'Kotak Pensil', '', 25000, '["http://192.168.1.89/shopping-cart/public/images/products/kotak-pensil-20190826130534-0.jpg"]', 5, '2019-08-26 13:05:34', '2019-08-27 11:11:42'),
	(11, 3, 'set-sendok-masak', 'Set Sendok Masak', '', 82000, '["http://192.168.1.89/shopping-cart/public/images/products/set-sendok-masak-20190826130606-0.jpg"]', 10, '2019-08-26 13:06:06', '2019-08-27 19:33:32'),
	(12, 1, 'jam-digital-lucu', 'Jam Digital Lucu', '', 44000, '["http://192.168.1.89/shopping-cart/public/images/products/jam-digital-lucu-20190826130658-0.jpg","http://192.168.1.89/shopping-cart/public/images/products/jam-digital-lucu-20190826130658-1.jpg","http://192.168.1.89/shopping-cart/public/images/products/jam-digital-lucu-20190826130658-2.jpg"]', 10, '2019-08-26 13:06:58', '2019-08-27 11:15:23');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
