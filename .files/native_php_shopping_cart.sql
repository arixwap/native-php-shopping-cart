-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.5.0.5332
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

-- Dumping data for table native_php_shopping_cart.carts: ~4 rows (approximately)
DELETE FROM `carts`;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, '1HUff', '2019-08-26 07:06:35', '2019-08-26 07:06:35'),
	(3, 'NnKKZ', '2019-08-27 03:22:54', '2019-08-27 03:22:54'),
	(4, 'VoxEo', '2019-08-27 06:09:35', '2019-08-27 06:09:35');
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;

-- Dumping structure for table native_php_shopping_cart.cart_products
CREATE TABLE IF NOT EXISTS `cart_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cart_id` int(10) unsigned NOT NULL DEFAULT '0',
  `product_id` int(10) unsigned NOT NULL DEFAULT '0',
  `category_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL COMMENT 'last edited product name',
  `description` text COMMENT 'last edited product description',
  `price` float DEFAULT NULL COMMENT 'last edited price',
  `images` json DEFAULT NULL,
  `quantity` int(10) unsigned DEFAULT NULL,
  `category_name` varchar(250) DEFAULT NULL COMMENT 'last edited category name',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table native_php_shopping_cart.cart_products: ~4 rows (approximately)
DELETE FROM `cart_products`;
/*!40000 ALTER TABLE `cart_products` DISABLE KEYS */;
INSERT INTO `cart_products` (`id`, `cart_id`, `product_id`, `category_id`, `name`, `description`, `price`, `images`, `quantity`, `category_name`, `created_at`, `updated_at`) VALUES
	(7, 3, 4, 2, 'Mini USB Fan', '', 25000, '["http://192.168.1.7/shopping-cart/public/images/products/mini-fan-20190826025941-0.jpg"]', 1, 'Elektronik', '2019-08-27 04:01:12', '2019-08-27 04:01:12'),
	(8, 3, 2, 2, 'Mini Bluetooth Speaker', 'Menggunakan Bluetooth atau SD Card', 60000, '["http://192.168.1.7/shopping-cart/public/images/products/mini-bluetooth-speaker-20190826025714-0.png", "http://192.168.1.7/shopping-cart/public/images/products/mini-bluetooth-speaker-20190826025714-1.jpg"]', 1, 'Elektronik', '2019-08-27 04:41:03', '2019-08-27 04:41:03'),
	(17, 4, 2, 2, 'Mini Bluetooth Speaker', 'Menggunakan Bluetooth atau SD Card', 60000, '["http://192.168.1.7/shopping-cart/public/images/products/mini-bluetooth-speaker-20190826025714-0.png", "http://192.168.1.7/shopping-cart/public/images/products/mini-bluetooth-speaker-20190826025714-1.jpg"]', 1, 'Elektronik', '2019-08-27 06:12:16', '2019-08-27 06:12:21'),
	(18, 4, 1, 2, 'Caddy Disk DVD', 'Caddy Disk untuk external Hardisk. Menggunakan slot DVD.', 135000, '["http://192.168.1.7/shopping-cart/public/images/products/caddy-disk-dvd-20190826025555-0.jpg", "http://192.168.1.7/shopping-cart/public/images/products/caddy-disk-dvd-20190826025630-0.jpg", "http://192.168.1.7/shopping-cart/public/images/products/caddy-disk-dvd-20190826025630-1.jpg", "http://192.168.1.7/shopping-cart/public/images/products/caddy-disk-dvd-20190826025630-2.jpg"]', 1, 'Elektronik', '2019-08-27 06:12:18', '2019-08-27 06:12:21');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table native_php_shopping_cart.categories: ~2 rows (approximately)
DELETE FROM `categories`;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `parent_id`, `slug`, `name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 0, 'alat-tulis', 'Alat Tulis', '', '2019-08-26 02:54:39', '2019-08-26 02:54:39'),
	(2, 0, 'elektronik', 'Elektronik', '', '2019-08-26 02:54:51', '2019-08-26 02:54:51');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table native_php_shopping_cart.orders: ~0 rows (approximately)
DELETE FROM `orders`;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `user_id`, `name`, `address`, `total_price`, `payment`, `created_at`, `updated_at`) VALUES
	(1, 'szFwc', 'Arix Wap', 'Tohpati', NULL, NULL, '2019-08-27 07:35:37', '2019-08-27 07:35:37');
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
  `images` json DEFAULT NULL,
  `quantity` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table native_php_shopping_cart.order_products: ~0 rows (approximately)
DELETE FROM `order_products`;
/*!40000 ALTER TABLE `order_products` DISABLE KEYS */;
INSERT INTO `order_products` (`id`, `order_id`, `product_id`, `category_id`, `category_name`, `name`, `description`, `price`, `images`, `quantity`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 2, 'Elektronik', 'Caddy Disk DVD', 'Caddy Disk untuk external Hardisk.\r\nMenggunakan slot DVD.', 135000, '["http://192.168.1.7/shopping-cart/public/images/products/caddy-disk-dvd-20190826025555-0.jpg", "http://192.168.1.7/shopping-cart/public/images/products/caddy-disk-dvd-20190826025630-0.jpg", "http://192.168.1.7/shopping-cart/public/images/products/caddy-disk-dvd-20190826025630-1.jpg", "http://192.168.1.7/shopping-cart/public/images/products/caddy-disk-dvd-20190826025630-2.jpg"]', 2, '2019-08-27 07:35:37', '2019-08-27 07:35:37'),
	(2, 1, 4, 2, 'Elektronik', 'Mini USB Fan', '', 25000, '["http://192.168.1.7/shopping-cart/public/images/products/mini-fan-20190826025941-0.jpg"]', 2, '2019-08-27 07:35:37', '2019-08-27 07:35:37');
/*!40000 ALTER TABLE `order_products` ENABLE KEYS */;

-- Dumping structure for table native_php_shopping_cart.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL DEFAULT '0',
  `slug` varchar(50) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` text,
  `price` float DEFAULT NULL,
  `images` json DEFAULT NULL,
  `quantity` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table native_php_shopping_cart.products: ~4 rows (approximately)
DELETE FROM `products`;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `category_id`, `slug`, `name`, `description`, `price`, `images`, `quantity`, `created_at`, `updated_at`) VALUES
	(1, 2, 'caddy-disk-dvd', 'Caddy Disk DVD', 'Caddy Disk untuk external Hardisk.\r\nMenggunakan slot DVD.', 135000, '["http://192.168.1.7/shopping-cart/public/images/products/caddy-disk-dvd-20190826025555-0.jpg", "http://192.168.1.7/shopping-cart/public/images/products/caddy-disk-dvd-20190826025630-0.jpg", "http://192.168.1.7/shopping-cart/public/images/products/caddy-disk-dvd-20190826025630-1.jpg", "http://192.168.1.7/shopping-cart/public/images/products/caddy-disk-dvd-20190826025630-2.jpg"]', 0, '2019-08-23 11:55:56', '2019-08-26 02:56:30'),
	(2, 2, 'mini-bluetooth-speaker', 'Mini Bluetooth Speaker', 'Menggunakan Bluetooth atau SD Card', 60000, '["http://192.168.1.7/shopping-cart/public/images/products/mini-bluetooth-speaker-20190826025714-0.png", "http://192.168.1.7/shopping-cart/public/images/products/mini-bluetooth-speaker-20190826025714-1.jpg"]', 5, '2019-08-23 11:57:22', '2019-08-26 02:57:14'),
	(4, 2, 'mini-fan', 'Mini USB Fan', '', 25000, '["http://192.168.1.7/shopping-cart/public/images/products/mini-fan-20190826025941-0.jpg"]', 3, '2019-08-26 02:59:41', '2019-08-26 02:59:41'),
	(6, 0, 'gold-mini-speaker', 'Gold Mini Speaker', '', 40000, '["http://192.168.1.7/shopping-cart/public/images/products/gold-mini-speaker-20190826030718-0.jpg"]', 4, '2019-08-26 03:07:18', '2019-08-26 03:07:18');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
