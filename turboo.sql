/*
 Navicat Premium Data Transfer

 Source Server         : Almotech-Develop
 Source Server Type    : MySQL
 Source Server Version : 50730
 Source Host           : localhost:3306
 Source Schema         : turboo

 Target Server Type    : MySQL
 Target Server Version : 50730
 File Encoding         : 65001

 Date: 18/05/2020 18:16:48
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for banners
-- ----------------------------
DROP TABLE IF EXISTS `banners`;
CREATE TABLE `banners`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `visible` tinyint(4) NOT NULL DEFAULT 1,
  `user_create_id` bigint(20) NULL DEFAULT NULL,
  `user_update_id` bigint(20) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of banners
-- ----------------------------
INSERT INTO `banners` VALUES (1, 'Oferteee', 'phpEABB.tmp.png', 1, 2, 2, '2020-04-23 15:29:29', '2020-04-23 15:39:34', NULL);
INSERT INTO `banners` VALUES (2, 'Oferteee', 'phpH8W3jX.jpg', 1, 2, NULL, '2020-05-12 14:25:06', '2020-05-12 14:25:06', NULL);

-- ----------------------------
-- Table structure for business_categories
-- ----------------------------
DROP TABLE IF EXISTS `business_categories`;
CREATE TABLE `business_categories`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `visible` tinyint(4) NOT NULL DEFAULT 1,
  `user_create_id` int(11) NULL DEFAULT NULL,
  `user_update_id` int(11) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of business_categories
-- ----------------------------
INSERT INTO `business_categories` VALUES (1, 'Dhurata', 'php8B83.tmp.jpg', 1, 2, 2, NULL, '2020-04-14 13:18:04', '2020-04-15 14:47:24');
INSERT INTO `business_categories` VALUES (2, 'Restorant', 'phpEFDB.tmp.jpg', 1, 2, 2, NULL, '2020-04-14 13:18:29', '2020-04-15 14:47:13');
INSERT INTO `business_categories` VALUES (3, 'Category 289', 'php81BC.tmp.png', 1, 2, NULL, '2020-04-14 13:19:52', '2020-04-14 13:19:07', '2020-04-14 13:19:52');
INSERT INTO `business_categories` VALUES (4, 'Lule', 'phpC44.tmp.jpg', 1, 2, NULL, NULL, '2020-04-15 14:47:48', '2020-04-15 14:47:48');

-- ----------------------------
-- Table structure for business_images
-- ----------------------------
DROP TABLE IF EXISTS `business_images`;
CREATE TABLE `business_images`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_id` int(11) NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of business_images
-- ----------------------------
INSERT INTO `business_images` VALUES (1, 21, 'phpCgx0nJ.png', NULL, '2020-05-15 10:29:55', '2020-05-15 10:29:55');
INSERT INTO `business_images` VALUES (6, 21, 'php5YA9d8.jpg', NULL, '2020-05-15 10:56:10', '2020-05-15 10:56:10');
INSERT INTO `business_images` VALUES (7, 21, 'phpCj3Lsg.png', NULL, '2020-05-15 10:56:10', '2020-05-15 10:56:10');
INSERT INTO `business_images` VALUES (8, 21, 'php869oHo.jpg', NULL, '2020-05-15 10:56:10', '2020-05-15 10:56:10');
INSERT INTO `business_images` VALUES (9, 21, 'phpPri3Vw.png', NULL, '2020-05-15 10:56:10', '2020-05-15 10:56:10');

-- ----------------------------
-- Table structure for business_infos
-- ----------------------------
DROP TABLE IF EXISTS `business_infos`;
CREATE TABLE `business_infos`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `business_category_id` int(11) NULL DEFAULT NULL,
  `business_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `banner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nuis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `city_id` int(11) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `user_create_id` int(11) NULL DEFAULT NULL,
  `user_update_id` int(11) NULL DEFAULT NULL,
  `open` time(0) NULL DEFAULT NULL,
  `close` time(0) NULL DEFAULT NULL,
  `weekend_open` time(0) NULL DEFAULT NULL,
  `weekend_close` time(0) NULL DEFAULT NULL,
  `delivery_price` decimal(8, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of business_infos
-- ----------------------------
INSERT INTO `business_infos` VALUES (1, 16, 1, 'Name 1', NULL, 'php4BF1.tmp.png', NULL, '1321', 'tiranee', 'https://develop.almotech.co/magazina_virtuale/', 1, '2020-04-08 12:11:00', '2020-04-07 14:59:43', '2020-04-08 12:11:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `business_infos` VALUES (2, 17, 1, 'Name 2', NULL, 'php12FC.tmp.png', NULL, '1321', 'tiranee', 'https://develop.almotech.co/magazina_virtuale/', 1, '2020-04-08 12:09:13', '2020-04-07 15:00:34', '2020-04-08 12:09:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `business_infos` VALUES (3, 18, 1, 'asd', NULL, 'phpEF95.tmp.png', NULL, '1321', 'Tirane, Albania', 'https://develop.almotech.co/magazina_virtuale/', 2, '2020-04-08 12:20:10', '2020-04-07 19:16:02', '2020-04-08 12:20:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `business_infos` VALUES (4, 19, 1, 'Baby Boo', NULL, 'phpMdLKNa.jpg', 'phpfbj6rb.jpg', '1321', 'Tirane, Albania', 'https://develop.almotech.co/magazina_virtuale/', 1, NULL, '2020-04-08 12:22:19', '2020-05-12 14:41:33', NULL, 2, '13:00:00', '02:30:00', '01:00:00', '10:30:00', NULL);
INSERT INTO `business_infos` VALUES (5, 20, 4, 'The Flower', NULL, 'phpOl9Uxg.png', 'php57qX6J.jpg', '1321', 'Tirane, Albania', 'https://develop.almotech.co/magazina_virtuale/', 2, NULL, '2020-04-08 12:22:47', '2020-05-12 14:53:11', NULL, 2, '00:00:00', '00:00:00', '00:00:00', '00:00:00', NULL);
INSERT INTO `business_infos` VALUES (6, 21, 1, 'Maison', 'asfdgthj', 'phpsz5ddp.jpg', 'phpSNYN3f.jpg', '1321', 'Tirane, Albania', 'https://develop.almotech.co/magazina_virtuale/', 1, NULL, '2020-04-13 14:07:44', '2020-05-12 14:47:36', NULL, 2, '12:30:00', '18:30:00', '02:30:00', '16:00:00', 150.00);
INSERT INTO `business_infos` VALUES (7, 22, 1, 'Optika Luani', NULL, 'phpnv52nt.png', 'php6UULXS.jpg', '1321', 'Tirane, Albania', 'https://develop.almotech.co/magazina_virtuale/', 1, NULL, '2020-04-14 10:55:08', '2020-05-12 14:50:01', NULL, 2, '00:00:00', '00:00:00', '00:00:00', '00:00:00', 100.00);
INSERT INTO `business_infos` VALUES (8, 23, 2, 'Chakra Jone', NULL, 'phpRwyuKo.jpg', 'phptybWcX.jpg', '1321', 'Tirane, Albania', 'https://develop.almotech.co/magazina_virtuale/', 2, NULL, '2020-04-14 11:00:58', '2020-05-12 14:42:44', NULL, 2, '00:00:00', '00:00:00', '00:00:00', '00:00:00', 100.00);
INSERT INTO `business_infos` VALUES (9, 24, 4, 'Pink Flower', NULL, 'phpp4BrSr.png', 'phpWIBTQT.jpg', '1321', 'tiranee', 'https://develop.almotech.co/magazina_virtuale/', 2, NULL, '2020-04-14 13:36:57', '2020-05-12 14:52:52', NULL, 2, '00:00:00', '00:00:00', '00:00:00', '00:00:00', 150.00);
INSERT INTO `business_infos` VALUES (10, 27, 2, 'Katering Family', NULL, 'php72vek9.png', 'phpytYf42.jpg', '1321', 'Tirane, Albania', 'https://develop.almotech.co/magazina_virtuale/', 1, NULL, '2020-04-14 14:22:10', '2020-05-12 14:45:22', NULL, 2, '00:30:00', '02:30:00', '00:30:00', '02:30:00', 120.00);
INSERT INTO `business_infos` VALUES (11, 28, 2, 'Millenium', NULL, 'phpS0VJum.png', 'phpfFoVFB.jpg', NULL, NULL, NULL, 1, NULL, '2020-04-15 09:56:03', '2020-05-12 14:48:37', NULL, 2, '00:00:00', '00:00:00', '00:00:00', '00:00:00', NULL);
INSERT INTO `business_infos` VALUES (12, 29, 2, 'Opium Sushi', NULL, 'phpVJiK2q.png', 'phpaHTkyA.jpg', NULL, NULL, NULL, 1, NULL, '2020-04-15 09:58:37', '2020-05-12 14:49:20', NULL, 2, '00:00:00', '00:00:00', '00:00:00', '00:00:00', NULL);
INSERT INTO `business_infos` VALUES (13, 30, 1, 'iShpejti', 'asdasdasdad', 'phpVaZAq6.png', 'phpf8bYSi.jpg', '1321', 'Tirane, Albania', 'https://develop.almotech.co/magazina_virtuale/', 2, NULL, '2020-04-15 15:59:06', '2020-05-12 14:43:19', NULL, 2, '00:00:00', '00:30:00', '04:00:00', '04:30:00', NULL);
INSERT INTO `business_infos` VALUES (14, 31, 1, 'Le petit flower', NULL, 'phpApD5QV.jpg', 'phpZfIH4t.jpg', '123456655', 'rrugadsdd', NULL, 1, NULL, '2020-04-30 15:46:27', '2020-05-12 14:46:50', NULL, 2, '00:00:00', '00:00:00', '00:00:00', '00:00:00', NULL);

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `business_category_id` int(11) NULL DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `visible` tinyint(4) NOT NULL DEFAULT 1,
  `user_create_id` int(11) NOT NULL,
  `user_update_id` int(11) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (5, 2, 'Bar', 'php872.tmp.png', 1, 2, NULL, NULL, '2020-04-15 14:28:07', '2020-04-15 14:28:07');
INSERT INTO `categories` VALUES (6, 2, 'Restorant', '', 1, 1, NULL, NULL, NULL, NULL);
INSERT INTO `categories` VALUES (7, 1, 'Optike', 'asd.jpg', 1, 2, NULL, NULL, '2020-04-30 10:18:12', '2020-04-30 10:18:12');
INSERT INTO `categories` VALUES (8, 1, 'Parfumeri', 'asd.jpg', 1, 2, NULL, NULL, '2020-04-30 10:18:12', '2020-04-30 10:18:12');
INSERT INTO `categories` VALUES (9, 1, 'Bizhuteri', 'asd.jpg', 1, 2, NULL, NULL, '2020-04-30 14:37:57', '2020-04-30 14:37:57');
INSERT INTO `categories` VALUES (10, 1, 'Bebe', 'asd.jpg', 1, 2, NULL, NULL, '2020-04-30 14:37:57', '2020-04-30 14:37:57');
INSERT INTO `categories` VALUES (11, 1, 'Veshje', 'phpr1P3Bw.png', 1, 2, NULL, NULL, '2020-05-06 14:06:41', '2020-05-06 14:06:41');
INSERT INTO `categories` VALUES (12, 1, 'Other', 'phpy23Dm9.png', 1, 2, NULL, NULL, '2020-05-06 14:06:57', '2020-05-06 14:06:57');

-- ----------------------------
-- Table structure for cities
-- ----------------------------
DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_create_id` int(11) NULL DEFAULT NULL,
  `user_update_id` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 94 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cities
-- ----------------------------
INSERT INTO `cities` VALUES (1, 'Tirane', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (2, 'Durres', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (3, 'Elbasan', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (4, 'Korce', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (5, 'Lushnje', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (6, 'Fier', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (7, 'Berat', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (8, 'Shkoder', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (9, 'Vlore', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (10, 'Gjirokaster', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (11, 'Sarande', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (12, 'Tepelene', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (13, 'Kavaje', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (14, 'Pogradec', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (15, 'Kruje', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (16, 'Kuçove', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (17, 'Kukes', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (18, 'Lezhe', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (19, 'Librazhd', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (20, 'Permet', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (21, 'Erseke', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (22, 'Burrel', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (23, 'Divjake', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (24, 'Tropoje', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (25, 'Belsh', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (26, 'Bulqizë', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (27, 'Cerrik', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (28, 'Delvine', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (29, 'Devoll', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (30, 'Diber', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (31, 'Dropull', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (32, 'Finiq', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (33, 'Fushe-Arrez', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (34, 'Gramsh', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (35, 'Has', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (36, 'Himarë', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (37, 'Kamëz', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (38, 'Kelcyre', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (39, 'Klos', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (40, 'Kolonje', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (41, 'Konispol', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (42, 'Kurbin', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (43, 'Libohove', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (44, 'Malesi e Madhe', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (45, 'Maliq', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (46, 'Mallakaster', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (47, 'Mat', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (48, 'Mirdite', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (49, 'Patos', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (50, 'Peqin', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (51, 'Polican', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (52, 'Perrenjas', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (53, 'Pustec', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (54, 'Roskovec', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (55, 'Rrogozhine', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (57, 'Selenice', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (58, 'Shijak', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (59, 'Skrapar', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (60, 'Ura Vajgurore', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (61, 'Vorë', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (62, 'Periferi Tirane', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (63, 'Periferi Durres', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (64, 'Bajram Curri', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (65, 'Ballsh', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (66, 'Bilisht', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (67, 'Borsh', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (68, 'Çorovode', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (69, 'Fushe-Kruje', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (70, 'Kamez', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (71, 'Kerrabe', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (72, 'Konispol', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (73, 'Koplik', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (74, 'Kraste', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (75, 'Krume', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (76, 'Ksamil', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (77, 'Leskovik', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (78, 'Mamurras', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (79, 'Memaliaj', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (80, 'Milot', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (81, 'Orikum', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (82, 'Peshkopi', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (83, 'Peze', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (84, 'Puke', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (85, 'Rreshen', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (86, 'Rubik', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (87, 'Shengjin', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (88, 'Shtermeni', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (89, 'Vaqarr', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (90, 'Vore', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (91, 'Sukth', 1, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (92, 'Cakran', 11, NULL, '2019-02-06 11:01:46', '2019-02-06 11:01:46', NULL);
INSERT INTO `cities` VALUES (93, 'Lac', NULL, NULL, '2019-03-28 15:26:10', '2019-03-28 15:26:10', NULL);

-- ----------------------------
-- Table structure for coupon_types
-- ----------------------------
DROP TABLE IF EXISTS `coupon_types`;
CREATE TABLE `coupon_types`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `visible` tinyint(4) NOT NULL DEFAULT 1,
  `user_create_id` int(11) NOT NULL,
  `user_update_id` int(11) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of coupon_types
-- ----------------------------
INSERT INTO `coupon_types` VALUES (1, 'Testsssss', 0, 2, 2, '2020-05-07 17:13:24', '2020-05-07 16:57:00', '2020-05-07 17:13:24');
INSERT INTO `coupon_types` VALUES (2, 'New comers', 1, 2, 2, NULL, '2020-05-07 17:13:29', '2020-05-08 08:28:44');
INSERT INTO `coupon_types` VALUES (3, 'Promo', 1, 2, NULL, NULL, '2020-05-08 08:28:58', '2020-05-08 08:28:58');

-- ----------------------------
-- Table structure for coupons
-- ----------------------------
DROP TABLE IF EXISTS `coupons`;
CREATE TABLE `coupons`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `discount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `quantity` int(11) NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `start_date` date NULL DEFAULT NULL,
  `end_date` date NULL DEFAULT NULL,
  `business_id` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `used_coupons` int(11) NULL DEFAULT 0,
  `type` int(11) NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of coupons
-- ----------------------------
INSERT INTO `coupons` VALUES (1, 'Test', '1200', 25, 'P6PxPlQIE9', '2020-05-03', '2020-05-30', 21, '2020-05-05 13:41:50', '2020-05-05 15:00:34', 5, 3, NULL);
INSERT INTO `coupons` VALUES (2, 'Test', '1200', 25, 'IZpafUyKGx', '2020-05-06', '2020-05-23', 21, '2020-05-05 13:42:20', '2020-05-05 13:42:20', 0, 3, NULL);
INSERT INTO `coupons` VALUES (3, 'Test', '1500', 1500, 'a2iTg', '2020-05-06', '2020-05-30', 21, '2020-05-05 15:26:56', '2020-05-05 15:26:56', 0, 3, NULL);
INSERT INTO `coupons` VALUES (4, 'Test', '1500', 1500, 'y7C1G', '2020-05-06', '2020-05-30', 21, '2020-05-05 15:27:17', '2020-05-05 15:27:17', 0, 3, NULL);
INSERT INTO `coupons` VALUES (5, 'First Register Coupon', '10', 100, 'Gb3MQ', '2020-05-07', '2020-05-28', 31, '2020-05-07 11:15:36', '2020-05-07 11:15:36', 0, 3, NULL);
INSERT INTO `coupons` VALUES (6, 'Test turboo', '25', 26, 'Gd3VA', '2020-05-11', '2020-05-30', 21, '2020-05-08 08:30:39', '2020-05-08 08:30:39', 0, 2, NULL);
INSERT INTO `coupons` VALUES (7, 'Test', '15', 70, '2SjsI', '2020-05-11', '2020-05-30', 21, '2020-05-08 13:58:37', '2020-05-08 13:58:37', 0, 2, 'phpRHH8Ps.jpg');
INSERT INTO `coupons` VALUES (8, 'Testt kuponn', '40', 40, 'tEoR1', '2020-05-10', '2020-05-30', 21, '2020-05-08 14:07:58', '2020-05-08 14:07:58', 0, 2, 'phpS0o3rd.png');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for favourite_businesses
-- ----------------------------
DROP TABLE IF EXISTS `favourite_businesses`;
CREATE TABLE `favourite_businesses`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `business_id` int(11) NOT NULL,
  `mobile_user_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 94 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of favourite_businesses
-- ----------------------------
INSERT INTO `favourite_businesses` VALUES (2, 20, 13, '2020-05-08 09:36:45', '2020-05-08 09:36:45');
INSERT INTO `favourite_businesses` VALUES (3, 20, 15, '2020-05-08 09:39:12', '2020-05-08 09:39:12');
INSERT INTO `favourite_businesses` VALUES (67, 31, 7, '2020-05-11 14:00:34', '2020-05-11 14:00:34');
INSERT INTO `favourite_businesses` VALUES (72, 20, 7, '2020-05-12 09:11:11', '2020-05-12 09:11:11');
INSERT INTO `favourite_businesses` VALUES (84, 22, 7, '2020-05-13 08:03:22', '2020-05-13 08:03:22');
INSERT INTO `favourite_businesses` VALUES (85, 30, 7, '2020-05-13 08:54:36', '2020-05-13 08:54:36');
INSERT INTO `favourite_businesses` VALUES (88, 21, 20, '2020-05-14 11:25:03', '2020-05-14 11:25:03');
INSERT INTO `favourite_businesses` VALUES (93, 21, 7, '2020-05-18 14:47:01', '2020-05-18 14:47:01');

-- ----------------------------
-- Table structure for favourite_products
-- ----------------------------
DROP TABLE IF EXISTS `favourite_products`;
CREATE TABLE `favourite_products`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mobile_user_id` int(11) NULL DEFAULT NULL,
  `product_id` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 55 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of favourite_products
-- ----------------------------
INSERT INTO `favourite_products` VALUES (2, 15, 1, '2020-05-08 09:31:16', '2020-05-08 09:31:16');
INSERT INTO `favourite_products` VALUES (3, 13, 2, '2020-05-11 09:24:03', '2020-05-11 09:24:03');
INSERT INTO `favourite_products` VALUES (39, 15, 8, '2020-05-12 19:09:47', '2020-05-12 19:09:47');
INSERT INTO `favourite_products` VALUES (40, 7, 3, '2020-05-12 19:42:23', '2020-05-12 19:42:23');
INSERT INTO `favourite_products` VALUES (47, 20, 1, '2020-05-14 11:37:42', '2020-05-14 11:37:42');
INSERT INTO `favourite_products` VALUES (49, 7, 32, '2020-05-15 12:48:23', '2020-05-15 12:48:23');
INSERT INTO `favourite_products` VALUES (50, 15, 31, '2020-05-15 12:49:27', '2020-05-15 12:49:27');
INSERT INTO `favourite_products` VALUES (51, 15, 30, '2020-05-15 12:49:45', '2020-05-15 12:49:45');
INSERT INTO `favourite_products` VALUES (52, 7, 33, '2020-05-15 12:57:59', '2020-05-15 12:57:59');
INSERT INTO `favourite_products` VALUES (54, 7, 8, '2020-05-15 18:25:42', '2020-05-15 18:25:42');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2020_04_07_102549_create_business_infos_table', 2);
INSERT INTO `migrations` VALUES (5, '2020_04_08_144935_create_categories_table', 3);
INSERT INTO `migrations` VALUES (6, '2020_04_13_143817_create_products_table', 4);
INSERT INTO `migrations` VALUES (7, '2020_04_14_125230_create_business_categories_table', 5);
INSERT INTO `migrations` VALUES (8, '2016_06_01_000001_create_oauth_auth_codes_table', 6);
INSERT INTO `migrations` VALUES (9, '2016_06_01_000002_create_oauth_access_tokens_table', 6);
INSERT INTO `migrations` VALUES (10, '2016_06_01_000003_create_oauth_refresh_tokens_table', 6);
INSERT INTO `migrations` VALUES (11, '2016_06_01_000004_create_oauth_clients_table', 6);
INSERT INTO `migrations` VALUES (12, '2016_06_01_000005_create_oauth_personal_access_clients_table', 6);
INSERT INTO `migrations` VALUES (13, '2020_04_15_082100_create_mobile_users_table', 7);
INSERT INTO `migrations` VALUES (14, '2020_04_17_134719_create_orders_table', 8);
INSERT INTO `migrations` VALUES (15, '2020_04_17_140003_create_order_items_table', 8);
INSERT INTO `migrations` VALUES (16, '2020_04_20_121846_create_push_notifications_table', 9);
INSERT INTO `migrations` VALUES (17, '2020_04_20_123012_create_push_individuals_table', 9);
INSERT INTO `migrations` VALUES (18, '2020_04_23_144647_create_banners_table', 10);
INSERT INTO `migrations` VALUES (19, '2020_04_24_115734_create_mobile_user__business_categories_table', 11);
INSERT INTO `migrations` VALUES (20, '2020_04_28_140052_create_reviews_table', 12);
INSERT INTO `migrations` VALUES (21, '2020_05_04_131157_create_favourite_products_table', 13);
INSERT INTO `migrations` VALUES (22, '2020_05_04_131217_create_favourite_businesses_table', 13);
INSERT INTO `migrations` VALUES (23, '2020_05_05_112811_create_coupons_table', 14);

-- ----------------------------
-- Table structure for mobile_user__business_categories
-- ----------------------------
DROP TABLE IF EXISTS `mobile_user__business_categories`;
CREATE TABLE `mobile_user__business_categories`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mobile_user_id` int(11) NOT NULL,
  `business_category_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 289 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mobile_user__business_categories
-- ----------------------------
INSERT INTO `mobile_user__business_categories` VALUES (1, 1, 1, '2020-04-24 12:30:50', '2020-04-24 12:30:50');
INSERT INTO `mobile_user__business_categories` VALUES (2, 1, 2, '2020-04-24 12:30:51', '2020-04-24 12:30:51');
INSERT INTO `mobile_user__business_categories` VALUES (3, 1, 1, '2020-04-24 12:30:51', '2020-04-24 12:30:51');
INSERT INTO `mobile_user__business_categories` VALUES (4, 1, 1, '2020-04-30 11:20:20', '2020-04-30 11:20:20');
INSERT INTO `mobile_user__business_categories` VALUES (5, 1, 2, '2020-04-30 11:20:20', '2020-04-30 11:20:20');
INSERT INTO `mobile_user__business_categories` VALUES (6, 1, 2, '2020-04-30 11:20:20', '2020-04-30 11:20:20');
INSERT INTO `mobile_user__business_categories` VALUES (7, 1, 1, '2020-04-30 11:27:33', '2020-04-30 11:27:33');
INSERT INTO `mobile_user__business_categories` VALUES (8, 1, 1, '2020-04-30 11:27:46', '2020-04-30 11:27:46');
INSERT INTO `mobile_user__business_categories` VALUES (9, 1, 2, '2020-04-30 11:27:46', '2020-04-30 11:27:46');
INSERT INTO `mobile_user__business_categories` VALUES (10, 1, 1, '2020-04-30 11:28:08', '2020-04-30 11:28:08');
INSERT INTO `mobile_user__business_categories` VALUES (11, 1, 1, '2020-04-30 11:28:17', '2020-04-30 11:28:17');
INSERT INTO `mobile_user__business_categories` VALUES (12, 1, 2, '2020-04-30 11:28:17', '2020-04-30 11:28:17');
INSERT INTO `mobile_user__business_categories` VALUES (13, 1, 1, '2020-04-30 11:31:14', '2020-04-30 11:31:14');
INSERT INTO `mobile_user__business_categories` VALUES (14, 1, 2, '2020-04-30 11:31:14', '2020-04-30 11:31:14');
INSERT INTO `mobile_user__business_categories` VALUES (15, 1, 1, '2020-04-30 12:46:30', '2020-04-30 12:46:30');
INSERT INTO `mobile_user__business_categories` VALUES (16, 1, 2, '2020-04-30 12:46:30', '2020-04-30 12:46:30');
INSERT INTO `mobile_user__business_categories` VALUES (17, 14, 1, '2020-05-05 15:40:58', '2020-05-05 15:40:58');
INSERT INTO `mobile_user__business_categories` VALUES (18, 14, 2, '2020-05-05 15:40:58', '2020-05-05 15:40:58');
INSERT INTO `mobile_user__business_categories` VALUES (19, 14, 1, '2020-05-06 14:21:06', '2020-05-06 14:21:06');
INSERT INTO `mobile_user__business_categories` VALUES (20, 14, 2, '2020-05-06 14:21:06', '2020-05-06 14:21:06');
INSERT INTO `mobile_user__business_categories` VALUES (21, 14, 1, '2020-05-06 14:29:21', '2020-05-06 14:29:21');
INSERT INTO `mobile_user__business_categories` VALUES (22, 14, 1, '2020-05-06 14:29:24', '2020-05-06 14:29:24');
INSERT INTO `mobile_user__business_categories` VALUES (23, 14, 1, '2020-05-08 12:06:31', '2020-05-08 12:06:31');
INSERT INTO `mobile_user__business_categories` VALUES (24, 14, 2, '2020-05-08 12:06:31', '2020-05-08 12:06:31');
INSERT INTO `mobile_user__business_categories` VALUES (25, 14, 4, '2020-05-08 12:06:31', '2020-05-08 12:06:31');
INSERT INTO `mobile_user__business_categories` VALUES (26, 14, 4, '2020-05-08 12:06:31', '2020-05-08 12:06:31');
INSERT INTO `mobile_user__business_categories` VALUES (27, 15, 1, '2020-05-08 12:24:33', '2020-05-08 12:24:33');
INSERT INTO `mobile_user__business_categories` VALUES (28, 15, 2, '2020-05-08 12:24:33', '2020-05-08 12:24:33');
INSERT INTO `mobile_user__business_categories` VALUES (29, 15, 4, '2020-05-08 12:24:33', '2020-05-08 12:24:33');
INSERT INTO `mobile_user__business_categories` VALUES (30, 15, 4, '2020-05-08 18:12:23', '2020-05-08 18:12:23');
INSERT INTO `mobile_user__business_categories` VALUES (31, 15, 2, '2020-05-08 18:13:24', '2020-05-08 18:13:24');
INSERT INTO `mobile_user__business_categories` VALUES (32, 15, 4, '2020-05-08 18:16:42', '2020-05-08 18:16:42');
INSERT INTO `mobile_user__business_categories` VALUES (33, 14, 1, '2020-05-11 08:26:45', '2020-05-11 08:26:45');
INSERT INTO `mobile_user__business_categories` VALUES (34, 14, 2, '2020-05-11 08:26:45', '2020-05-11 08:26:45');
INSERT INTO `mobile_user__business_categories` VALUES (35, 14, 4, '2020-05-11 08:26:45', '2020-05-11 08:26:45');
INSERT INTO `mobile_user__business_categories` VALUES (36, 7, 1, '2020-05-11 08:33:07', '2020-05-11 08:33:07');
INSERT INTO `mobile_user__business_categories` VALUES (37, 7, 2, '2020-05-11 08:33:07', '2020-05-11 08:33:07');
INSERT INTO `mobile_user__business_categories` VALUES (38, 7, 4, '2020-05-11 08:33:07', '2020-05-11 08:33:07');
INSERT INTO `mobile_user__business_categories` VALUES (39, 7, 1, '2020-05-11 14:50:21', '2020-05-11 14:50:21');
INSERT INTO `mobile_user__business_categories` VALUES (40, 7, 2, '2020-05-11 14:50:21', '2020-05-11 14:50:21');
INSERT INTO `mobile_user__business_categories` VALUES (41, 7, 4, '2020-05-11 14:50:21', '2020-05-11 14:50:21');
INSERT INTO `mobile_user__business_categories` VALUES (42, 7, 4, '2020-05-11 14:50:21', '2020-05-11 14:50:21');
INSERT INTO `mobile_user__business_categories` VALUES (43, 7, 4, '2020-05-11 14:50:21', '2020-05-11 14:50:21');
INSERT INTO `mobile_user__business_categories` VALUES (44, 7, 2, '2020-05-11 14:51:17', '2020-05-11 14:51:17');
INSERT INTO `mobile_user__business_categories` VALUES (45, 7, 1, '2020-05-11 14:51:17', '2020-05-11 14:51:17');
INSERT INTO `mobile_user__business_categories` VALUES (46, 7, 1, '2020-05-11 14:54:40', '2020-05-11 14:54:40');
INSERT INTO `mobile_user__business_categories` VALUES (47, 7, 2, '2020-05-11 14:54:40', '2020-05-11 14:54:40');
INSERT INTO `mobile_user__business_categories` VALUES (48, 7, 4, '2020-05-11 14:54:40', '2020-05-11 14:54:40');
INSERT INTO `mobile_user__business_categories` VALUES (49, 14, 1, '2020-05-11 14:59:03', '2020-05-11 14:59:03');
INSERT INTO `mobile_user__business_categories` VALUES (50, 14, 2, '2020-05-11 14:59:03', '2020-05-11 14:59:03');
INSERT INTO `mobile_user__business_categories` VALUES (51, 14, 1, '2020-05-12 08:15:13', '2020-05-12 08:15:13');
INSERT INTO `mobile_user__business_categories` VALUES (52, 14, 2, '2020-05-12 08:15:13', '2020-05-12 08:15:13');
INSERT INTO `mobile_user__business_categories` VALUES (53, 7, 1, '2020-05-12 09:03:26', '2020-05-12 09:03:26');
INSERT INTO `mobile_user__business_categories` VALUES (54, 7, 2, '2020-05-12 09:03:26', '2020-05-12 09:03:26');
INSERT INTO `mobile_user__business_categories` VALUES (55, 7, 1, '2020-05-12 09:05:42', '2020-05-12 09:05:42');
INSERT INTO `mobile_user__business_categories` VALUES (56, 7, 2, '2020-05-12 09:05:42', '2020-05-12 09:05:42');
INSERT INTO `mobile_user__business_categories` VALUES (57, 7, 2, '2020-05-12 09:05:42', '2020-05-12 09:05:42');
INSERT INTO `mobile_user__business_categories` VALUES (58, 7, 1, '2020-05-12 09:09:38', '2020-05-12 09:09:38');
INSERT INTO `mobile_user__business_categories` VALUES (59, 7, 2, '2020-05-12 09:09:38', '2020-05-12 09:09:38');
INSERT INTO `mobile_user__business_categories` VALUES (60, 7, 4, '2020-05-12 09:09:38', '2020-05-12 09:09:38');
INSERT INTO `mobile_user__business_categories` VALUES (61, 7, 1, '2020-05-12 09:10:17', '2020-05-12 09:10:17');
INSERT INTO `mobile_user__business_categories` VALUES (62, 7, 2, '2020-05-12 09:10:17', '2020-05-12 09:10:17');
INSERT INTO `mobile_user__business_categories` VALUES (63, 7, 1, '2020-05-12 10:06:14', '2020-05-12 10:06:14');
INSERT INTO `mobile_user__business_categories` VALUES (64, 7, 2, '2020-05-12 10:06:14', '2020-05-12 10:06:14');
INSERT INTO `mobile_user__business_categories` VALUES (65, 7, 1, '2020-05-12 11:56:28', '2020-05-12 11:56:28');
INSERT INTO `mobile_user__business_categories` VALUES (66, 7, 2, '2020-05-12 11:56:28', '2020-05-12 11:56:28');
INSERT INTO `mobile_user__business_categories` VALUES (67, 7, 1, '2020-05-12 11:57:25', '2020-05-12 11:57:25');
INSERT INTO `mobile_user__business_categories` VALUES (68, 7, 4, '2020-05-12 11:57:25', '2020-05-12 11:57:25');
INSERT INTO `mobile_user__business_categories` VALUES (69, 14, 1, '2020-05-12 12:09:00', '2020-05-12 12:09:00');
INSERT INTO `mobile_user__business_categories` VALUES (70, 14, 2, '2020-05-12 12:09:00', '2020-05-12 12:09:00');
INSERT INTO `mobile_user__business_categories` VALUES (71, 7, 2, '2020-05-12 12:16:01', '2020-05-12 12:16:01');
INSERT INTO `mobile_user__business_categories` VALUES (72, 18, 1, '2020-05-12 12:45:36', '2020-05-12 12:45:36');
INSERT INTO `mobile_user__business_categories` VALUES (73, 7, 2, '2020-05-12 12:47:31', '2020-05-12 12:47:31');
INSERT INTO `mobile_user__business_categories` VALUES (74, 20, 4, '2020-05-12 12:54:42', '2020-05-12 12:54:42');
INSERT INTO `mobile_user__business_categories` VALUES (75, 20, 1, '2020-05-12 12:54:42', '2020-05-12 12:54:42');
INSERT INTO `mobile_user__business_categories` VALUES (76, 18, 1, '2020-05-12 13:39:36', '2020-05-12 13:39:36');
INSERT INTO `mobile_user__business_categories` VALUES (77, 18, 1, '2020-05-12 14:13:30', '2020-05-12 14:13:30');
INSERT INTO `mobile_user__business_categories` VALUES (78, 18, 2, '2020-05-12 14:13:57', '2020-05-12 14:13:57');
INSERT INTO `mobile_user__business_categories` VALUES (79, 18, 2, '2020-05-12 14:15:52', '2020-05-12 14:15:52');
INSERT INTO `mobile_user__business_categories` VALUES (80, 18, 2, '2020-05-12 14:27:12', '2020-05-12 14:27:12');
INSERT INTO `mobile_user__business_categories` VALUES (81, 18, 2, '2020-05-12 14:30:39', '2020-05-12 14:30:39');
INSERT INTO `mobile_user__business_categories` VALUES (82, 18, 2, '2020-05-12 14:33:43', '2020-05-12 14:33:43');
INSERT INTO `mobile_user__business_categories` VALUES (83, 18, 2, '2020-05-12 14:35:30', '2020-05-12 14:35:30');
INSERT INTO `mobile_user__business_categories` VALUES (84, 18, 2, '2020-05-12 14:59:42', '2020-05-12 14:59:42');
INSERT INTO `mobile_user__business_categories` VALUES (85, 18, 2, '2020-05-12 15:01:05', '2020-05-12 15:01:05');
INSERT INTO `mobile_user__business_categories` VALUES (86, 18, 2, '2020-05-12 15:36:14', '2020-05-12 15:36:14');
INSERT INTO `mobile_user__business_categories` VALUES (87, 18, 2, '2020-05-12 15:36:54', '2020-05-12 15:36:54');
INSERT INTO `mobile_user__business_categories` VALUES (88, 18, 1, '2020-05-12 15:38:16', '2020-05-12 15:38:16');
INSERT INTO `mobile_user__business_categories` VALUES (89, 15, 2, '2020-05-12 18:35:23', '2020-05-12 18:35:23');
INSERT INTO `mobile_user__business_categories` VALUES (90, 15, 4, '2020-05-12 18:35:23', '2020-05-12 18:35:23');
INSERT INTO `mobile_user__business_categories` VALUES (91, 15, 4, '2020-05-12 18:35:23', '2020-05-12 18:35:23');
INSERT INTO `mobile_user__business_categories` VALUES (92, 15, 1, '2020-05-12 18:35:23', '2020-05-12 18:35:23');
INSERT INTO `mobile_user__business_categories` VALUES (93, 15, 4, '2020-05-12 18:35:23', '2020-05-12 18:35:23');
INSERT INTO `mobile_user__business_categories` VALUES (94, 15, 4, '2020-05-12 18:35:23', '2020-05-12 18:35:23');
INSERT INTO `mobile_user__business_categories` VALUES (95, 15, 4, '2020-05-12 18:35:23', '2020-05-12 18:35:23');
INSERT INTO `mobile_user__business_categories` VALUES (96, 15, 4, '2020-05-12 18:35:23', '2020-05-12 18:35:23');
INSERT INTO `mobile_user__business_categories` VALUES (97, 15, 2, '2020-05-12 18:35:23', '2020-05-12 18:35:23');
INSERT INTO `mobile_user__business_categories` VALUES (98, 15, 1, '2020-05-12 18:35:23', '2020-05-12 18:35:23');
INSERT INTO `mobile_user__business_categories` VALUES (99, 15, 4, '2020-05-12 18:35:23', '2020-05-12 18:35:23');
INSERT INTO `mobile_user__business_categories` VALUES (100, 7, 1, '2020-05-12 19:42:06', '2020-05-12 19:42:06');
INSERT INTO `mobile_user__business_categories` VALUES (101, 7, 2, '2020-05-13 07:44:30', '2020-05-13 07:44:30');
INSERT INTO `mobile_user__business_categories` VALUES (102, 18, 2, '2020-05-13 07:54:04', '2020-05-13 07:54:04');
INSERT INTO `mobile_user__business_categories` VALUES (103, 18, 2, '2020-05-13 15:40:51', '2020-05-13 15:40:51');
INSERT INTO `mobile_user__business_categories` VALUES (104, 18, 2, '2020-05-13 15:50:41', '2020-05-13 15:50:41');
INSERT INTO `mobile_user__business_categories` VALUES (105, 7, 2, '2020-05-14 16:19:32', '2020-05-14 16:19:32');
INSERT INTO `mobile_user__business_categories` VALUES (106, 7, 4, '2020-05-14 16:19:32', '2020-05-14 16:19:32');
INSERT INTO `mobile_user__business_categories` VALUES (107, 7, 2, '2020-05-14 18:49:33', '2020-05-14 18:49:33');
INSERT INTO `mobile_user__business_categories` VALUES (108, 18, 1, '2020-05-14 20:10:39', '2020-05-14 20:10:39');
INSERT INTO `mobile_user__business_categories` VALUES (109, 18, 1, '2020-05-14 21:15:33', '2020-05-14 21:15:33');
INSERT INTO `mobile_user__business_categories` VALUES (110, 18, 2, '2020-05-14 21:16:34', '2020-05-14 21:16:34');
INSERT INTO `mobile_user__business_categories` VALUES (111, 18, 2, '2020-05-14 21:17:18', '2020-05-14 21:17:18');
INSERT INTO `mobile_user__business_categories` VALUES (112, 18, 2, '2020-05-14 21:18:11', '2020-05-14 21:18:11');
INSERT INTO `mobile_user__business_categories` VALUES (113, 18, 2, '2020-05-14 21:58:39', '2020-05-14 21:58:39');
INSERT INTO `mobile_user__business_categories` VALUES (114, 18, 2, '2020-05-14 21:59:11', '2020-05-14 21:59:11');
INSERT INTO `mobile_user__business_categories` VALUES (115, 18, 2, '2020-05-14 22:00:39', '2020-05-14 22:00:39');
INSERT INTO `mobile_user__business_categories` VALUES (116, 18, 2, '2020-05-14 22:01:49', '2020-05-14 22:01:49');
INSERT INTO `mobile_user__business_categories` VALUES (117, 18, 2, '2020-05-14 22:02:21', '2020-05-14 22:02:21');
INSERT INTO `mobile_user__business_categories` VALUES (118, 18, 2, '2020-05-14 22:03:41', '2020-05-14 22:03:41');
INSERT INTO `mobile_user__business_categories` VALUES (119, 18, 1, '2020-05-14 22:04:52', '2020-05-14 22:04:52');
INSERT INTO `mobile_user__business_categories` VALUES (120, 18, 2, '2020-05-14 22:05:57', '2020-05-14 22:05:57');
INSERT INTO `mobile_user__business_categories` VALUES (121, 18, 2, '2020-05-14 22:07:32', '2020-05-14 22:07:32');
INSERT INTO `mobile_user__business_categories` VALUES (122, 18, 2, '2020-05-14 22:08:58', '2020-05-14 22:08:58');
INSERT INTO `mobile_user__business_categories` VALUES (123, 18, 2, '2020-05-14 22:12:14', '2020-05-14 22:12:14');
INSERT INTO `mobile_user__business_categories` VALUES (124, 18, 2, '2020-05-14 22:14:50', '2020-05-14 22:14:50');
INSERT INTO `mobile_user__business_categories` VALUES (125, 18, 2, '2020-05-14 22:15:24', '2020-05-14 22:15:24');
INSERT INTO `mobile_user__business_categories` VALUES (126, 18, 2, '2020-05-14 22:16:01', '2020-05-14 22:16:01');
INSERT INTO `mobile_user__business_categories` VALUES (127, 18, 1, '2020-05-14 22:16:58', '2020-05-14 22:16:58');
INSERT INTO `mobile_user__business_categories` VALUES (128, 18, 2, '2020-05-14 22:17:25', '2020-05-14 22:17:25');
INSERT INTO `mobile_user__business_categories` VALUES (129, 18, 2, '2020-05-14 22:18:24', '2020-05-14 22:18:24');
INSERT INTO `mobile_user__business_categories` VALUES (130, 18, 2, '2020-05-15 08:46:13', '2020-05-15 08:46:13');
INSERT INTO `mobile_user__business_categories` VALUES (131, 18, 2, '2020-05-15 09:05:41', '2020-05-15 09:05:41');
INSERT INTO `mobile_user__business_categories` VALUES (132, 18, 2, '2020-05-15 09:06:39', '2020-05-15 09:06:39');
INSERT INTO `mobile_user__business_categories` VALUES (133, 18, 2, '2020-05-15 09:20:35', '2020-05-15 09:20:35');
INSERT INTO `mobile_user__business_categories` VALUES (134, 18, 2, '2020-05-15 09:21:20', '2020-05-15 09:21:20');
INSERT INTO `mobile_user__business_categories` VALUES (135, 18, 2, '2020-05-15 09:26:07', '2020-05-15 09:26:07');
INSERT INTO `mobile_user__business_categories` VALUES (136, 18, 2, '2020-05-15 09:26:39', '2020-05-15 09:26:39');
INSERT INTO `mobile_user__business_categories` VALUES (137, 18, 2, '2020-05-15 09:33:19', '2020-05-15 09:33:19');
INSERT INTO `mobile_user__business_categories` VALUES (138, 18, 1, '2020-05-15 10:16:06', '2020-05-15 10:16:06');
INSERT INTO `mobile_user__business_categories` VALUES (139, 18, 2, '2020-05-15 10:38:05', '2020-05-15 10:38:05');
INSERT INTO `mobile_user__business_categories` VALUES (140, 18, 2, '2020-05-15 10:43:12', '2020-05-15 10:43:12');
INSERT INTO `mobile_user__business_categories` VALUES (141, 18, 2, '2020-05-15 10:55:07', '2020-05-15 10:55:07');
INSERT INTO `mobile_user__business_categories` VALUES (142, 18, 2, '2020-05-15 10:57:09', '2020-05-15 10:57:09');
INSERT INTO `mobile_user__business_categories` VALUES (143, 18, 2, '2020-05-15 10:58:47', '2020-05-15 10:58:47');
INSERT INTO `mobile_user__business_categories` VALUES (144, 18, 2, '2020-05-15 11:00:19', '2020-05-15 11:00:19');
INSERT INTO `mobile_user__business_categories` VALUES (145, 18, 2, '2020-05-15 11:01:44', '2020-05-15 11:01:44');
INSERT INTO `mobile_user__business_categories` VALUES (146, 18, 1, '2020-05-15 11:03:08', '2020-05-15 11:03:08');
INSERT INTO `mobile_user__business_categories` VALUES (147, 18, 2, '2020-05-15 11:04:06', '2020-05-15 11:04:06');
INSERT INTO `mobile_user__business_categories` VALUES (148, 18, 1, '2020-05-15 11:04:41', '2020-05-15 11:04:41');
INSERT INTO `mobile_user__business_categories` VALUES (149, 18, 2, '2020-05-15 11:14:33', '2020-05-15 11:14:33');
INSERT INTO `mobile_user__business_categories` VALUES (150, 18, 2, '2020-05-15 11:34:17', '2020-05-15 11:34:17');
INSERT INTO `mobile_user__business_categories` VALUES (151, 18, 1, '2020-05-15 11:35:15', '2020-05-15 11:35:15');
INSERT INTO `mobile_user__business_categories` VALUES (152, 18, 1, '2020-05-15 11:37:04', '2020-05-15 11:37:04');
INSERT INTO `mobile_user__business_categories` VALUES (153, 18, 1, '2020-05-15 11:37:33', '2020-05-15 11:37:33');
INSERT INTO `mobile_user__business_categories` VALUES (154, 18, 1, '2020-05-15 11:38:03', '2020-05-15 11:38:03');
INSERT INTO `mobile_user__business_categories` VALUES (155, 18, 2, '2020-05-15 11:38:54', '2020-05-15 11:38:54');
INSERT INTO `mobile_user__business_categories` VALUES (156, 18, 2, '2020-05-15 11:44:11', '2020-05-15 11:44:11');
INSERT INTO `mobile_user__business_categories` VALUES (157, 18, 2, '2020-05-15 11:46:40', '2020-05-15 11:46:40');
INSERT INTO `mobile_user__business_categories` VALUES (158, 7, 2, '2020-05-15 11:47:33', '2020-05-15 11:47:33');
INSERT INTO `mobile_user__business_categories` VALUES (159, 7, 2, '2020-05-15 11:48:05', '2020-05-15 11:48:05');
INSERT INTO `mobile_user__business_categories` VALUES (160, 18, 2, '2020-05-15 11:59:03', '2020-05-15 11:59:03');
INSERT INTO `mobile_user__business_categories` VALUES (161, 18, 1, '2020-05-15 11:59:52', '2020-05-15 11:59:52');
INSERT INTO `mobile_user__business_categories` VALUES (162, 18, 2, '2020-05-15 12:01:09', '2020-05-15 12:01:09');
INSERT INTO `mobile_user__business_categories` VALUES (163, 7, 1, '2020-05-15 12:31:16', '2020-05-15 12:31:16');
INSERT INTO `mobile_user__business_categories` VALUES (164, 18, 1, '2020-05-15 12:36:04', '2020-05-15 12:36:04');
INSERT INTO `mobile_user__business_categories` VALUES (165, 18, 2, '2020-05-15 12:59:53', '2020-05-15 12:59:53');
INSERT INTO `mobile_user__business_categories` VALUES (166, 18, 2, '2020-05-15 13:15:19', '2020-05-15 13:15:19');
INSERT INTO `mobile_user__business_categories` VALUES (167, 18, 2, '2020-05-15 13:18:12', '2020-05-15 13:18:12');
INSERT INTO `mobile_user__business_categories` VALUES (168, 18, 2, '2020-05-15 13:18:37', '2020-05-15 13:18:37');
INSERT INTO `mobile_user__business_categories` VALUES (169, 18, 1, '2020-05-15 13:19:46', '2020-05-15 13:19:46');
INSERT INTO `mobile_user__business_categories` VALUES (170, 18, 2, '2020-05-15 13:20:20', '2020-05-15 13:20:20');
INSERT INTO `mobile_user__business_categories` VALUES (171, 18, 1, '2020-05-15 13:25:26', '2020-05-15 13:25:26');
INSERT INTO `mobile_user__business_categories` VALUES (172, 18, 2, '2020-05-15 13:26:29', '2020-05-15 13:26:29');
INSERT INTO `mobile_user__business_categories` VALUES (173, 18, 2, '2020-05-15 13:28:00', '2020-05-15 13:28:00');
INSERT INTO `mobile_user__business_categories` VALUES (174, 18, 2, '2020-05-15 13:29:00', '2020-05-15 13:29:00');
INSERT INTO `mobile_user__business_categories` VALUES (175, 18, 2, '2020-05-15 13:29:48', '2020-05-15 13:29:48');
INSERT INTO `mobile_user__business_categories` VALUES (176, 18, 1, '2020-05-15 13:31:07', '2020-05-15 13:31:07');
INSERT INTO `mobile_user__business_categories` VALUES (177, 18, 2, '2020-05-15 13:32:12', '2020-05-15 13:32:12');
INSERT INTO `mobile_user__business_categories` VALUES (178, 18, 2, '2020-05-15 13:34:27', '2020-05-15 13:34:27');
INSERT INTO `mobile_user__business_categories` VALUES (179, 18, 2, '2020-05-15 13:34:59', '2020-05-15 13:34:59');
INSERT INTO `mobile_user__business_categories` VALUES (180, 18, 2, '2020-05-15 13:39:10', '2020-05-15 13:39:10');
INSERT INTO `mobile_user__business_categories` VALUES (181, 18, 1, '2020-05-15 13:39:37', '2020-05-15 13:39:37');
INSERT INTO `mobile_user__business_categories` VALUES (182, 18, 2, '2020-05-15 13:40:13', '2020-05-15 13:40:13');
INSERT INTO `mobile_user__business_categories` VALUES (183, 18, 2, '2020-05-15 13:41:20', '2020-05-15 13:41:20');
INSERT INTO `mobile_user__business_categories` VALUES (184, 18, 2, '2020-05-15 13:43:19', '2020-05-15 13:43:19');
INSERT INTO `mobile_user__business_categories` VALUES (185, 18, 2, '2020-05-15 13:43:56', '2020-05-15 13:43:56');
INSERT INTO `mobile_user__business_categories` VALUES (186, 18, 2, '2020-05-15 13:47:20', '2020-05-15 13:47:20');
INSERT INTO `mobile_user__business_categories` VALUES (187, 18, 1, '2020-05-15 13:48:17', '2020-05-15 13:48:17');
INSERT INTO `mobile_user__business_categories` VALUES (188, 18, 2, '2020-05-15 13:49:33', '2020-05-15 13:49:33');
INSERT INTO `mobile_user__business_categories` VALUES (189, 18, 2, '2020-05-15 13:50:54', '2020-05-15 13:50:54');
INSERT INTO `mobile_user__business_categories` VALUES (190, 18, 2, '2020-05-15 13:53:25', '2020-05-15 13:53:25');
INSERT INTO `mobile_user__business_categories` VALUES (191, 18, 2, '2020-05-15 13:54:31', '2020-05-15 13:54:31');
INSERT INTO `mobile_user__business_categories` VALUES (192, 18, 1, '2020-05-15 14:17:20', '2020-05-15 14:17:20');
INSERT INTO `mobile_user__business_categories` VALUES (193, 18, 1, '2020-05-15 14:31:58', '2020-05-15 14:31:58');
INSERT INTO `mobile_user__business_categories` VALUES (194, 18, 2, '2020-05-15 14:37:05', '2020-05-15 14:37:05');
INSERT INTO `mobile_user__business_categories` VALUES (195, 18, 2, '2020-05-15 14:39:05', '2020-05-15 14:39:05');
INSERT INTO `mobile_user__business_categories` VALUES (196, 18, 2, '2020-05-15 14:58:00', '2020-05-15 14:58:00');
INSERT INTO `mobile_user__business_categories` VALUES (197, 18, 2, '2020-05-15 14:59:00', '2020-05-15 14:59:00');
INSERT INTO `mobile_user__business_categories` VALUES (198, 18, 2, '2020-05-15 15:01:20', '2020-05-15 15:01:20');
INSERT INTO `mobile_user__business_categories` VALUES (199, 18, 2, '2020-05-15 15:08:06', '2020-05-15 15:08:06');
INSERT INTO `mobile_user__business_categories` VALUES (200, 7, 2, '2020-05-15 15:11:57', '2020-05-15 15:11:57');
INSERT INTO `mobile_user__business_categories` VALUES (201, 7, 4, '2020-05-15 15:11:57', '2020-05-15 15:11:57');
INSERT INTO `mobile_user__business_categories` VALUES (202, 18, 2, '2020-05-15 15:18:12', '2020-05-15 15:18:12');
INSERT INTO `mobile_user__business_categories` VALUES (203, 18, 2, '2020-05-15 15:31:28', '2020-05-15 15:31:28');
INSERT INTO `mobile_user__business_categories` VALUES (204, 18, 2, '2020-05-15 15:33:37', '2020-05-15 15:33:37');
INSERT INTO `mobile_user__business_categories` VALUES (205, 18, 2, '2020-05-15 15:42:56', '2020-05-15 15:42:56');
INSERT INTO `mobile_user__business_categories` VALUES (206, 18, 2, '2020-05-15 15:43:34', '2020-05-15 15:43:34');
INSERT INTO `mobile_user__business_categories` VALUES (207, 18, 2, '2020-05-15 15:44:35', '2020-05-15 15:44:35');
INSERT INTO `mobile_user__business_categories` VALUES (208, 18, 1, '2020-05-15 15:46:35', '2020-05-15 15:46:35');
INSERT INTO `mobile_user__business_categories` VALUES (209, 18, 1, '2020-05-15 15:47:18', '2020-05-15 15:47:18');
INSERT INTO `mobile_user__business_categories` VALUES (210, 18, 1, '2020-05-15 15:48:30', '2020-05-15 15:48:30');
INSERT INTO `mobile_user__business_categories` VALUES (211, 18, 2, '2020-05-15 15:49:47', '2020-05-15 15:49:47');
INSERT INTO `mobile_user__business_categories` VALUES (212, 18, 1, '2020-05-15 15:50:48', '2020-05-15 15:50:48');
INSERT INTO `mobile_user__business_categories` VALUES (213, 18, 1, '2020-05-15 15:52:11', '2020-05-15 15:52:11');
INSERT INTO `mobile_user__business_categories` VALUES (214, 18, 2, '2020-05-15 17:41:40', '2020-05-15 17:41:40');
INSERT INTO `mobile_user__business_categories` VALUES (215, 18, 2, '2020-05-15 17:43:57', '2020-05-15 17:43:57');
INSERT INTO `mobile_user__business_categories` VALUES (216, 18, 2, '2020-05-15 17:47:23', '2020-05-15 17:47:23');
INSERT INTO `mobile_user__business_categories` VALUES (217, 18, 2, '2020-05-15 17:49:57', '2020-05-15 17:49:57');
INSERT INTO `mobile_user__business_categories` VALUES (218, 18, 2, '2020-05-15 17:50:51', '2020-05-15 17:50:51');
INSERT INTO `mobile_user__business_categories` VALUES (219, 18, 2, '2020-05-15 17:51:38', '2020-05-15 17:51:38');
INSERT INTO `mobile_user__business_categories` VALUES (220, 18, 2, '2020-05-15 18:25:04', '2020-05-15 18:25:04');
INSERT INTO `mobile_user__business_categories` VALUES (221, 18, 2, '2020-05-15 18:26:03', '2020-05-15 18:26:03');
INSERT INTO `mobile_user__business_categories` VALUES (222, 18, 2, '2020-05-15 19:23:18', '2020-05-15 19:23:18');
INSERT INTO `mobile_user__business_categories` VALUES (223, 18, 2, '2020-05-15 19:24:30', '2020-05-15 19:24:30');
INSERT INTO `mobile_user__business_categories` VALUES (224, 18, 2, '2020-05-15 19:33:50', '2020-05-15 19:33:50');
INSERT INTO `mobile_user__business_categories` VALUES (225, 18, 2, '2020-05-15 19:35:48', '2020-05-15 19:35:48');
INSERT INTO `mobile_user__business_categories` VALUES (226, 18, 2, '2020-05-15 19:40:09', '2020-05-15 19:40:09');
INSERT INTO `mobile_user__business_categories` VALUES (227, 18, 1, '2020-05-15 19:41:51', '2020-05-15 19:41:51');
INSERT INTO `mobile_user__business_categories` VALUES (228, 18, 2, '2020-05-15 19:43:00', '2020-05-15 19:43:00');
INSERT INTO `mobile_user__business_categories` VALUES (229, 18, 1, '2020-05-15 19:44:05', '2020-05-15 19:44:05');
INSERT INTO `mobile_user__business_categories` VALUES (230, 18, 2, '2020-05-15 19:47:06', '2020-05-15 19:47:06');
INSERT INTO `mobile_user__business_categories` VALUES (231, 18, 1, '2020-05-15 19:47:47', '2020-05-15 19:47:47');
INSERT INTO `mobile_user__business_categories` VALUES (232, 18, 2, '2020-05-15 19:52:11', '2020-05-15 19:52:11');
INSERT INTO `mobile_user__business_categories` VALUES (233, 18, 1, '2020-05-15 19:52:41', '2020-05-15 19:52:41');
INSERT INTO `mobile_user__business_categories` VALUES (234, 18, 1, '2020-05-15 20:50:42', '2020-05-15 20:50:42');
INSERT INTO `mobile_user__business_categories` VALUES (235, 18, 2, '2020-05-15 21:23:26', '2020-05-15 21:23:26');
INSERT INTO `mobile_user__business_categories` VALUES (236, 18, 2, '2020-05-15 21:24:21', '2020-05-15 21:24:21');
INSERT INTO `mobile_user__business_categories` VALUES (237, 18, 2, '2020-05-15 22:28:09', '2020-05-15 22:28:09');
INSERT INTO `mobile_user__business_categories` VALUES (238, 18, 1, '2020-05-15 23:00:41', '2020-05-15 23:00:41');
INSERT INTO `mobile_user__business_categories` VALUES (239, 18, 1, '2020-05-15 23:07:54', '2020-05-15 23:07:54');
INSERT INTO `mobile_user__business_categories` VALUES (240, 18, 2, '2020-05-15 23:10:11', '2020-05-15 23:10:11');
INSERT INTO `mobile_user__business_categories` VALUES (241, 18, 1, '2020-05-18 07:37:52', '2020-05-18 07:37:52');
INSERT INTO `mobile_user__business_categories` VALUES (242, 18, 1, '2020-05-18 07:39:48', '2020-05-18 07:39:48');
INSERT INTO `mobile_user__business_categories` VALUES (243, 18, 1, '2020-05-18 07:54:08', '2020-05-18 07:54:08');
INSERT INTO `mobile_user__business_categories` VALUES (244, 18, 1, '2020-05-18 08:01:00', '2020-05-18 08:01:00');
INSERT INTO `mobile_user__business_categories` VALUES (245, 18, 2, '2020-05-18 08:01:30', '2020-05-18 08:01:30');
INSERT INTO `mobile_user__business_categories` VALUES (246, 18, 2, '2020-05-18 08:02:39', '2020-05-18 08:02:39');
INSERT INTO `mobile_user__business_categories` VALUES (247, 18, 2, '2020-05-18 08:08:38', '2020-05-18 08:08:38');
INSERT INTO `mobile_user__business_categories` VALUES (248, 18, 2, '2020-05-18 08:10:18', '2020-05-18 08:10:18');
INSERT INTO `mobile_user__business_categories` VALUES (249, 18, 1, '2020-05-18 08:13:41', '2020-05-18 08:13:41');
INSERT INTO `mobile_user__business_categories` VALUES (250, 18, 1, '2020-05-18 08:18:01', '2020-05-18 08:18:01');
INSERT INTO `mobile_user__business_categories` VALUES (251, 18, 1, '2020-05-18 08:19:02', '2020-05-18 08:19:02');
INSERT INTO `mobile_user__business_categories` VALUES (252, 18, 2, '2020-05-18 08:44:44', '2020-05-18 08:44:44');
INSERT INTO `mobile_user__business_categories` VALUES (253, 18, 2, '2020-05-18 08:55:41', '2020-05-18 08:55:41');
INSERT INTO `mobile_user__business_categories` VALUES (254, 18, 2, '2020-05-18 09:20:36', '2020-05-18 09:20:36');
INSERT INTO `mobile_user__business_categories` VALUES (255, 18, 2, '2020-05-18 09:22:49', '2020-05-18 09:22:49');
INSERT INTO `mobile_user__business_categories` VALUES (256, 18, 2, '2020-05-18 09:28:00', '2020-05-18 09:28:00');
INSERT INTO `mobile_user__business_categories` VALUES (257, 18, 2, '2020-05-18 09:29:14', '2020-05-18 09:29:14');
INSERT INTO `mobile_user__business_categories` VALUES (258, 18, 2, '2020-05-18 09:30:32', '2020-05-18 09:30:32');
INSERT INTO `mobile_user__business_categories` VALUES (259, 18, 2, '2020-05-18 09:30:52', '2020-05-18 09:30:52');
INSERT INTO `mobile_user__business_categories` VALUES (260, 18, 2, '2020-05-18 09:40:22', '2020-05-18 09:40:22');
INSERT INTO `mobile_user__business_categories` VALUES (261, 18, 1, '2020-05-18 10:10:44', '2020-05-18 10:10:44');
INSERT INTO `mobile_user__business_categories` VALUES (262, 18, 4, '2020-05-18 10:11:21', '2020-05-18 10:11:21');
INSERT INTO `mobile_user__business_categories` VALUES (263, 18, 2, '2020-05-18 10:53:08', '2020-05-18 10:53:08');
INSERT INTO `mobile_user__business_categories` VALUES (264, 18, 2, '2020-05-18 11:26:26', '2020-05-18 11:26:26');
INSERT INTO `mobile_user__business_categories` VALUES (265, 18, 2, '2020-05-18 11:30:49', '2020-05-18 11:30:49');
INSERT INTO `mobile_user__business_categories` VALUES (266, 18, 2, '2020-05-18 11:45:57', '2020-05-18 11:45:57');
INSERT INTO `mobile_user__business_categories` VALUES (267, 18, 2, '2020-05-18 12:12:41', '2020-05-18 12:12:41');
INSERT INTO `mobile_user__business_categories` VALUES (268, 18, 2, '2020-05-18 12:13:09', '2020-05-18 12:13:09');
INSERT INTO `mobile_user__business_categories` VALUES (269, 18, 1, '2020-05-18 12:16:18', '2020-05-18 12:16:18');
INSERT INTO `mobile_user__business_categories` VALUES (270, 18, 2, '2020-05-18 12:19:47', '2020-05-18 12:19:47');
INSERT INTO `mobile_user__business_categories` VALUES (271, 18, 2, '2020-05-18 12:51:47', '2020-05-18 12:51:47');
INSERT INTO `mobile_user__business_categories` VALUES (272, 7, 2, '2020-05-18 13:14:05', '2020-05-18 13:14:05');
INSERT INTO `mobile_user__business_categories` VALUES (273, 18, 2, '2020-05-18 13:16:31', '2020-05-18 13:16:31');
INSERT INTO `mobile_user__business_categories` VALUES (274, 18, 2, '2020-05-18 13:20:02', '2020-05-18 13:20:02');
INSERT INTO `mobile_user__business_categories` VALUES (275, 18, 2, '2020-05-18 13:39:02', '2020-05-18 13:39:02');
INSERT INTO `mobile_user__business_categories` VALUES (276, 18, 1, '2020-05-18 13:40:20', '2020-05-18 13:40:20');
INSERT INTO `mobile_user__business_categories` VALUES (277, 18, 2, '2020-05-18 13:42:12', '2020-05-18 13:42:12');
INSERT INTO `mobile_user__business_categories` VALUES (278, 18, 2, '2020-05-18 13:42:55', '2020-05-18 13:42:55');
INSERT INTO `mobile_user__business_categories` VALUES (279, 18, 2, '2020-05-18 14:29:27', '2020-05-18 14:29:27');
INSERT INTO `mobile_user__business_categories` VALUES (280, 18, 2, '2020-05-18 15:23:04', '2020-05-18 15:23:04');
INSERT INTO `mobile_user__business_categories` VALUES (281, 18, 2, '2020-05-18 15:23:36', '2020-05-18 15:23:36');
INSERT INTO `mobile_user__business_categories` VALUES (282, 18, 2, '2020-05-18 15:24:11', '2020-05-18 15:24:11');
INSERT INTO `mobile_user__business_categories` VALUES (283, 18, 2, '2020-05-18 15:28:13', '2020-05-18 15:28:13');
INSERT INTO `mobile_user__business_categories` VALUES (284, 18, 2, '2020-05-18 15:29:39', '2020-05-18 15:29:39');
INSERT INTO `mobile_user__business_categories` VALUES (285, 18, 2, '2020-05-18 15:48:26', '2020-05-18 15:48:26');
INSERT INTO `mobile_user__business_categories` VALUES (286, 18, 2, '2020-05-18 16:02:58', '2020-05-18 16:02:58');
INSERT INTO `mobile_user__business_categories` VALUES (287, 18, 2, '2020-05-18 16:11:44', '2020-05-18 16:11:44');
INSERT INTO `mobile_user__business_categories` VALUES (288, 18, 1, '2020-05-18 16:12:37', '2020-05-18 16:12:37');

-- ----------------------------
-- Table structure for mobile_users
-- ----------------------------
DROP TABLE IF EXISTS `mobile_users`;
CREATE TABLE `mobile_users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `active_device` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `platform` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `attempts` int(11) NULL DEFAULT NULL,
  `sent_at` timestamp(0) NULL DEFAULT NULL,
  `sent` tinyint(4) NULL DEFAULT NULL,
  `status` tinyint(4) NULL DEFAULT 1,
  `date_of_birth` date NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `mobile_users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mobile_users
-- ----------------------------
INSERT INTO `mobile_users` VALUES (1, 'Asd Asd', 'test@gmail.com', '$2y$10$LbnGra4szTvSlBDFq/4fle.h5e3s7dxbcL0bhIcHKigIHkaw6AT4S', '069879879878', 'asdkajsdlkasdjkasdasd', 'ios', 'b8RJNvTImcdf3JGo0Ks6LiIoVQXx9Iq4PZ4xSjCnLvPj3awAzqdcrccSxkYk', '2020-03-02 08:47:00', '2020-04-20 12:38:30', '111111', 1, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mobile_users` VALUES (2, 'Test', 'test123@gmail.com', '$2y$10$e6KrYeieXW.4rudo1irwm.yJzGAp66Ek1z.llVv7ANK2xetmyMgCq', '0694489809', 'adasdasdasdasdasdasdasd', 'android', NULL, '2020-02-25 13:54:59', '2020-04-20 13:54:59', NULL, NULL, NULL, NULL, 1, NULL, NULL);
INSERT INTO `mobile_users` VALUES (3, 'Test', 'test123@gmail45.com', '$2y$10$e6KrYeieXW.4rudo1irwm.yJzGAp66Ek1z.llVv7ANK2xetmyMgCq', '0694489809', 'adasdasdasdasdasdasdasd', 'ios', NULL, '2020-04-27 13:54:59', '2020-04-20 13:54:59', NULL, NULL, NULL, NULL, 1, NULL, NULL);
INSERT INTO `mobile_users` VALUES (4, 'Test', 'test123@gmail4775.com', '$2y$10$e6KrYeieXW.4rudo1irwm.yJzGAp66Ek1z.llVv7ANK2xetmyMgCq', '0694489809', 'adasdasdasdasdasdasdasd', 'ios', NULL, '2020-04-27 13:54:59', '2020-04-20 13:54:59', NULL, NULL, NULL, NULL, 1, NULL, NULL);
INSERT INTO `mobile_users` VALUES (5, 'ledja', 'ledja@gmail.com', '$2y$10$COInZUnW8rk8nmfczJeVU.iq4yFOKVfhdoBk8ex7lfCt4V5i95wme', '0694489809', 'adasdasdasdasdasdasdasd', 'asdasdasd', NULL, '2020-04-28 14:47:55', '2020-04-28 14:47:55', NULL, NULL, NULL, NULL, 1, NULL, NULL);
INSERT INTO `mobile_users` VALUES (6, 'txgxhxh', 'tsdyyfy@gmail.com', '$2y$10$dvad6bM3sR9MbMIppVM8TOMzxF.Dx4v3HIz/PD6qRs7.XuguXBsFS', '5868068628', 'token', 'Android', NULL, '2020-04-30 08:27:20', '2020-04-30 08:27:20', NULL, NULL, NULL, NULL, 1, NULL, NULL);
INSERT INTO `mobile_users` VALUES (7, 'Paris', 'pariszarka@gmail.com', '$2y$10$FHT8RNcTJ3E9fshWJGhmmef.dbJQNRbyXNcNam2wZ82XQ0t3wpsbW', '0694812891', 'token', 'Android', NULL, '2020-04-30 08:28:05', '2020-05-18 13:13:58', '111111', 1, NULL, NULL, 1, '1970-01-01', NULL);
INSERT INTO `mobile_users` VALUES (8, 'ledja', 'ledja1@gmail.com', '$2y$10$3GTUZKngZ1IPv1wflfBEmOpifd4L/G/pz1iah/YhEoboFZY7Dh3ve', '0694489809', 'adasdasdasdasdasdasdasd', 'asdasdasd', NULL, '2020-04-30 09:36:08', '2020-04-30 09:36:08', NULL, NULL, NULL, NULL, 1, NULL, NULL);
INSERT INTO `mobile_users` VALUES (9, 'Erion', 'turboo.info@gmail.com', '$2y$10$9wop1PTWNMZllQ3kPlmcleWfwJl4gug9SA4onN3fzXkFLLopo6POC', '0692463977', 'token', 'Android', NULL, '2020-04-30 16:12:45', '2020-05-01 12:56:18', '111111', 1, NULL, NULL, 1, NULL, NULL);
INSERT INTO `mobile_users` VALUES (10, 'vufu', 'dyfyfyfdy@gmail.con', '$2y$10$NdvyPmLSUeHGm5pT1EARROLPprHuhVvu2EIewzkMufcJJYdQOxU4y', '383578382', 'token', 'Android', NULL, '2020-05-01 09:00:50', '2020-05-01 09:00:50', NULL, NULL, NULL, NULL, 1, NULL, NULL);
INSERT INTO `mobile_users` VALUES (11, 'Eugen Yzeiri', 'eugen.yzeiri@gmail.com', '$2y$10$11CcPXyyRbDXuaq4PYlf9.WypZ8eVueL1sNXM3x/VF7AEPCD08C5.', '0699464631', 'token', 'Android', NULL, '2020-05-02 10:51:33', '2020-05-12 13:20:05', '111111', 1, NULL, NULL, 1, '1992-06-23', NULL);
INSERT INTO `mobile_users` VALUES (12, 'Eugen Yzeiri', 'juxhinjo@live.co', '$2y$10$.W7RE2QP9JxNqGQIKH9vbuxO/jx1yGJ9fQInU4ceSOWzoyNmlhRo6', '0699464631', 'token', 'Android', NULL, '2020-05-04 10:33:35', '2020-05-04 10:33:35', NULL, NULL, NULL, NULL, 1, '1955-06-21', NULL);
INSERT INTO `mobile_users` VALUES (13, 'Ledja', 'Ledja@yahoo.com', '$2y$10$yxM8NefWik.mXXbyeadOTu56VI0n25rWGtFMmMvHTUtQIcAm.eqLu', '0694489809', 'adasdasdasdasdasdasdasd', 'asdasdasd', NULL, '2020-05-04 12:01:35', '2020-05-08 14:24:29', NULL, NULL, NULL, NULL, 1, '1996-12-22', 'phprT8l1z.jpg');
INSERT INTO `mobile_users` VALUES (14, 'ledja', 'ledja123@gmail.com', '$2y$10$SX3T2WJ2EnEccCjseSC5DeSsYGemBozVl/ZW24HIDsKE8GtYuXVhK', '0694489808', 'adasdasdasdasdasdasdasd', 'asdasdasd', NULL, '2020-05-05 10:29:59', '2020-05-05 10:29:59', NULL, NULL, NULL, NULL, 1, '1996-12-22', NULL);
INSERT INTO `mobile_users` VALUES (15, 'Erion Cuni', 'erioncuni85@gmail.com', '$2y$10$YGYLd6Yej2LuuHlxaYKID..bHksuEvAshVJCjTcnlJ5K3yZ5M0xtG', '0692463979', 'token', 'Android', NULL, '2020-05-06 23:49:17', '2020-05-12 18:34:38', '111111', 1, NULL, NULL, 1, '1970-01-01', NULL);
INSERT INTO `mobile_users` VALUES (16, 'Ergi', 'ergi.almotech@gmail.com', '$2y$10$1qFU.ZUODpC.YN/TD7T.muTNcOzUQBAE1MMDJvzsmarmkaez/7sua', '0695616686', 'token', 'Android', NULL, '2020-05-07 18:36:47', '2020-05-07 18:36:54', '111111', 1, NULL, NULL, 1, '1970-01-01', NULL);
INSERT INTO `mobile_users` VALUES (17, 'ledja', 'ledja1234@gmail.com', '$2y$10$Y5ZqC2g0bz..WxWhgcaPj.e2q7D1QlyrlWyJMDUWq9Vez5pu7ZVkW', '0694489808', 'adasdasdasdasdasdasdasd', 'asdasdasd', NULL, '2020-05-08 09:27:40', '2020-05-08 09:27:40', NULL, NULL, NULL, NULL, 1, '1996-12-22', NULL);
INSERT INTO `mobile_users` VALUES (18, 'Armelindo', 'lindolalaj1@gmail.com', '$2y$10$WqKASVozDKmtt7yiSk1AgeRnjZoVSvbcimO5Ej0Y/KG.TzNFMLtU.', '0698152941', 'adasdasdasdasdasdasdasd', 'ios', NULL, '2020-05-11 10:55:01', '2020-05-18 08:00:48', '111111', 1, NULL, NULL, 1, '1996-12-22', NULL);
INSERT INTO `mobile_users` VALUES (19, 'Shpetim Limani', 'shpetimlimani9@gmail.com', '$2y$10$BTyjVWEkZMd2bSVQSlsQue6goMGqUuMyGntQCb.I2RR7mFoizCm62', '0698735126', 'token', 'Android', NULL, '2020-05-11 20:47:23', '2020-05-11 20:48:23', '111111', 1, NULL, NULL, 1, '1970-01-01', NULL);
INSERT INTO `mobile_users` VALUES (20, 'Mariklen', 'info@turboo.al', '$2y$10$0yBSaP5cCxkTsToBu3Okh.EBn2zEy/4AYn1xNu0qx1H92oxg41kxi', '0698211722', 'token', 'Android', NULL, '2020-05-12 12:54:08', '2020-05-12 12:54:28', '111111', 1, NULL, NULL, 1, '1970-01-01', NULL);

-- ----------------------------
-- Table structure for mobile_users_addresses
-- ----------------------------
DROP TABLE IF EXISTS `mobile_users_addresses`;
CREATE TABLE `mobile_users_addresses`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mobile_user_id` int(11) NULL DEFAULT NULL,
  `city` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lng` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(4) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mobile_users_addresses
-- ----------------------------
INSERT INTO `mobile_users_addresses` VALUES (1, 1, 'Tirane', 'Rruga Test', 'asadad', '189,1999', '84,456', '2020-04-17 13:58:38', '2020-04-17 11:58:38', 0);
INSERT INTO `mobile_users_addresses` VALUES (2, 1, 'Tirane', 'Rruga Asd', 'sdas', '78,1223', '987,12332', '2020-04-17 13:59:12', '2020-04-17 11:59:12', 0);
INSERT INTO `mobile_users_addresses` VALUES (3, 1, 'Tirane', 'Rruga Asd', NULL, '78,1223', '987,12332', '2020-04-17 14:55:41', '2020-04-17 14:55:41', 1);
INSERT INTO `mobile_users_addresses` VALUES (4, 7, 'd dvdv', 'd dvdvfg', 'vyucyc', '189,1999', '84,456', '2020-05-05 13:51:41', '2020-05-05 13:51:41', 0);
INSERT INTO `mobile_users_addresses` VALUES (5, 7, 'test', 'test', NULL, '78.1223', '987.12332', '2020-05-06 07:56:49', '2020-05-06 07:56:49', 0);
INSERT INTO `mobile_users_addresses` VALUES (6, 7, 'yxy', 'yxyyxcy', NULL, '189,1999', '84,456', '2020-05-06 09:11:27', '2020-05-06 09:11:27', 1);
INSERT INTO `mobile_users_addresses` VALUES (7, 1, 'Tirane', 'Rruga Asd', NULL, '78,1223', '987,12332', '2020-05-05 08:42:51', '2020-05-05 08:42:51', 1);
INSERT INTO `mobile_users_addresses` VALUES (8, 7, 'ergi', 'ergi', NULL, '78.1223', '987.12332', '2020-05-05 13:55:06', '2020-05-05 13:55:06', 0);
INSERT INTO `mobile_users_addresses` VALUES (9, 7, 'ergi', 'ergi', NULL, '78.1223', '987.12332', '2020-05-05 13:59:05', '2020-05-05 13:59:05', 0);
INSERT INTO `mobile_users_addresses` VALUES (10, 7, 'rrff', 'erfg', NULL, '78.1223', '987.12332', '2020-05-05 14:02:48', '2020-05-05 14:02:48', 0);
INSERT INTO `mobile_users_addresses` VALUES (11, 7, 'ergi', 'ergi', NULL, '78.1223', '987.12332', '2020-05-05 14:13:21', '2020-05-05 14:13:21', 0);
INSERT INTO `mobile_users_addresses` VALUES (12, 7, 'ergi', 'ergi', NULL, '78.1223', '987.12332', '2020-05-05 14:14:49', '2020-05-05 14:14:49', 0);
INSERT INTO `mobile_users_addresses` VALUES (13, 7, 'ergi', 'ergi', NULL, '78.1223', '987.12332', '2020-05-05 14:55:58', '2020-05-05 14:55:58', 0);
INSERT INTO `mobile_users_addresses` VALUES (14, 7, 'test1', 'test1', NULL, '78.1223', '987.12332', '2020-05-12 20:17:05', '2020-05-12 20:17:05', 0);
INSERT INTO `mobile_users_addresses` VALUES (15, 15, 'Albania', 'Rruga Hamit Troplini', NULL, '78.1223', '987.12332', '2020-05-08 22:21:24', '2020-05-08 22:21:24', 0);
INSERT INTO `mobile_users_addresses` VALUES (16, 7, 'fufud', 'dyxyx', NULL, '78.1223', '987.12332', '2020-05-07 09:38:34', '2020-05-07 09:38:34', 1);
INSERT INTO `mobile_users_addresses` VALUES (17, 16, 'ergi', 'ergi', NULL, '78.1223', '987.12332', '2020-05-07 18:40:07', '2020-05-07 18:40:07', 1);
INSERT INTO `mobile_users_addresses` VALUES (18, 15, 'test', 'test', NULL, '78.1223', '987.12332', '2020-05-09 11:17:39', '2020-05-09 11:17:39', 0);
INSERT INTO `mobile_users_addresses` VALUES (19, 15, 'test', 'tedt', NULL, '78.1223', '987.12332', '2020-05-09 11:53:06', '2020-05-09 11:53:06', 1);

-- ----------------------------
-- Table structure for oauth_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens`  (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `expires_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_access_tokens_user_id_index`(`user_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of oauth_access_tokens
-- ----------------------------
INSERT INTO `oauth_access_tokens` VALUES ('05a3b8316c39ecfa4a11650b628d1e4e0f11dbfaa08e88c4fc40ed8f8176c2683740095cac4912fd', 15, 5, 'DS', '[]', 0, '2020-05-11 07:42:10', '2020-05-11 07:42:10', '2021-05-11 07:42:10');
INSERT INTO `oauth_access_tokens` VALUES ('06fac55543147b28cfd525dfc1ef101ccf6726b844ca281fc622d75a957473508a91729b6866f7f8', 7, 5, 'DS', '[]', 0, '2020-05-12 09:09:52', '2020-05-12 09:09:52', '2021-05-12 09:09:52');
INSERT INTO `oauth_access_tokens` VALUES ('072695e652961edf8a77ec7ac79669a1fda949455af77cd96f445b61d3a1f509582feaf649e1966f', 18, 5, 'DS', '[]', 0, '2020-05-18 07:39:46', '2020-05-18 07:39:46', '2021-05-18 07:39:46');
INSERT INTO `oauth_access_tokens` VALUES ('0866b836dcb2643aa7cf8e7a14bcc650994f2359e73229d4eb25ae057c202df217d4a671ca0d923e', 7, 5, 'DS', '[]', 0, '2020-05-14 18:49:23', '2020-05-14 18:49:23', '2021-05-14 18:49:23');
INSERT INTO `oauth_access_tokens` VALUES ('08b38141f4b9a0cfd3b2a6632276600bd5f1acd365873cd63b5ad62b8ed68c925e4a38161f6279bd', 1, 1, 'app', '[]', 0, '2020-04-15 09:05:41', '2020-04-15 09:05:41', '2021-04-15 09:05:41');
INSERT INTO `oauth_access_tokens` VALUES ('08f3f7e9df12e3d334faba361e417badc9901436f674bfa018ba2ddeb198467cf13526cbee5fa0c1', 7, 5, 'DS', '[]', 0, '2020-05-12 09:03:22', '2020-05-12 09:03:22', '2021-05-12 09:03:22');
INSERT INTO `oauth_access_tokens` VALUES ('0a294977ea927a280152354c7611b6da40e91676febcf9c77b63d10d246a964e4ae64ae473827e99', 7, 5, 'DS', '[]', 0, '2020-05-07 15:22:52', '2020-05-07 15:22:52', '2021-05-07 15:22:52');
INSERT INTO `oauth_access_tokens` VALUES ('0a9e7ab461b3689b372fbe48fb62438aeca59553d50563dc4344e34c79d86dd27e709e9de2d8851c', 7, 5, 'DS', '[]', 0, '2020-05-07 15:24:57', '2020-05-07 15:24:57', '2021-05-07 15:24:57');
INSERT INTO `oauth_access_tokens` VALUES ('0b3d5f13b0141dcb3453b7407e7b83d5e208d18520f35d811e049480d973d0d7b227216c25bddfa6', 20, 5, 'app', '[]', 0, '2020-05-12 12:54:08', '2020-05-12 12:54:08', '2021-05-12 12:54:08');
INSERT INTO `oauth_access_tokens` VALUES ('0cd024f4c44f53e6dd485442db3d9eb6a294738a8cf6cd7603fdf24fd7f36a07b0210eade0ea1a70', 15, 5, 'DS', '[]', 0, '2020-05-08 18:12:13', '2020-05-08 18:12:13', '2021-05-08 18:12:13');
INSERT INTO `oauth_access_tokens` VALUES ('10aa0c5c918e82655ba9e4d9f52728858f1b2eb21582ea21ca23a9eff7f7c07dd76797e19108bcab', 7, 5, 'DS', '[]', 0, '2020-05-07 15:14:34', '2020-05-07 15:14:34', '2021-05-07 15:14:34');
INSERT INTO `oauth_access_tokens` VALUES ('1319e3898d8e29e8f54880a9f06022b6c4451681a7a98ac47ddd58734198784556aa58c06d142949', 15, 5, 'app', '[]', 0, '2020-05-06 23:49:17', '2020-05-06 23:49:17', '2021-05-06 23:49:17');
INSERT INTO `oauth_access_tokens` VALUES ('13d374cae165536d488c905f62174634a03f25118e79d6458ccec539b2ae00a94e6a867e47b8484c', 7, 5, 'DS', '[]', 0, '2020-05-12 19:42:01', '2020-05-12 19:42:01', '2021-05-12 19:42:01');
INSERT INTO `oauth_access_tokens` VALUES ('14c11fdeac4d504c7ca2a43f020d83dbbe92fbaa9758be1ae0ab77387d9f562092bd258daa270b90', 5, 5, 'app', '[]', 0, '2020-04-28 14:47:56', '2020-04-28 14:47:56', '2021-04-28 14:47:56');
INSERT INTO `oauth_access_tokens` VALUES ('16f63926d0fdf18680ed232473511b92b5c4bc1565d26019ebb6d7081fa3689f79e88953c49dffc5', 15, 5, 'DS', '[]', 0, '2020-05-09 11:11:37', '2020-05-09 11:11:37', '2021-05-09 11:11:37');
INSERT INTO `oauth_access_tokens` VALUES ('187799d798ac9ecafa15ab89fc8e8035c53f9569d8a55f91d8e45ea0fc28905eccaf51938a0db71d', 15, 5, 'DS', '[]', 0, '2020-05-12 18:34:45', '2020-05-12 18:34:45', '2021-05-12 18:34:45');
INSERT INTO `oauth_access_tokens` VALUES ('1a53a9de00de74d05c80feb880579bf304573512bc8166b8790db01f53a1ed2a9cee8949d3351b97', 9, 5, 'DS', '[]', 0, '2020-04-30 16:13:07', '2020-04-30 16:13:07', '2021-04-30 16:13:07');
INSERT INTO `oauth_access_tokens` VALUES ('1de424eec4dcf1cb9b93eb34e5042d3c9f2b832a5df2d9a3b846e2317d2c3bd3bc0cfd5728f7196c', 18, 5, 'DS', '[]', 0, '2020-05-18 07:54:04', '2020-05-18 07:54:04', '2021-05-18 07:54:04');
INSERT INTO `oauth_access_tokens` VALUES ('1e46e04fdb06ded56f92169609eca137f404501494e1370541a57348d1ac89bdd62ac4adb16cf56a', 7, 5, 'DS', '[]', 0, '2020-05-07 15:33:54', '2020-05-07 15:33:54', '2021-05-07 15:33:54');
INSERT INTO `oauth_access_tokens` VALUES ('1eb4505b35fbbb552f69d9cb5a96c20b175c14cf2771853def4daf7f0b8bcafd84cce843c54d0e27', 18, 5, 'app', '[]', 0, '2020-05-11 10:55:01', '2020-05-11 10:55:01', '2021-05-11 10:55:01');
INSERT INTO `oauth_access_tokens` VALUES ('20c8e78de42760346d9a2019dd3f59ff8a4bd323122583e8079183859dd01e726da7765fcdcfe4b3', 7, 5, 'DS', '[]', 0, '2020-05-11 12:37:11', '2020-05-11 12:37:11', '2021-05-11 12:37:11');
INSERT INTO `oauth_access_tokens` VALUES ('2211b858517519c8cf7d103049a5f9324474936722e0b1d15a349bfae1dc24dbf9b188b18552b1a6', 8, 5, 'app', '[]', 0, '2020-04-30 09:36:08', '2020-04-30 09:36:08', '2021-04-30 09:36:08');
INSERT INTO `oauth_access_tokens` VALUES ('2253f60c6938ec949fa6f7cc781b6e5072aaf3e879d72cff869dab012e2b00289d227a032d627910', 12, 5, 'app', '[]', 0, '2020-05-04 10:33:35', '2020-05-04 10:33:35', '2021-05-04 10:33:35');
INSERT INTO `oauth_access_tokens` VALUES ('22c573e788b443e7bba537247916889ea509dd921d87e37ab3e67b425c78aa9e989a7da87d25ae95', 19, 5, 'app', '[]', 0, '2020-05-11 20:47:23', '2020-05-11 20:47:23', '2021-05-11 20:47:23');
INSERT INTO `oauth_access_tokens` VALUES ('24914b610d2018a01813d424f5eefc59243f1c4bca20b281d96de6883d2e53bcbfd2141255cf7e28', 7, 5, 'DS', '[]', 0, '2020-04-30 16:00:18', '2020-04-30 16:00:18', '2021-04-30 16:00:18');
INSERT INTO `oauth_access_tokens` VALUES ('2d358a19bfdf87de2eafa6ee91ef2617cd47dc85ad70f939c7f9a5acfb86c2a609340d444d8b6527', 1, 5, 'app', '[]', 0, '2020-04-16 13:40:41', '2020-04-16 13:40:41', '2021-04-16 13:40:41');
INSERT INTO `oauth_access_tokens` VALUES ('34bd1d803bdc520bc26776c8259e23d96e31436def6ead9336be52029f2ca2d369762d1af124ddba', 7, 5, 'DS', '[]', 0, '2020-05-11 14:58:31', '2020-05-11 14:58:31', '2021-05-11 14:58:31');
INSERT INTO `oauth_access_tokens` VALUES ('36554aabb63849ec11ad4e0138f3f35edb9f5d7e74370a08c524c0534d4f5b29dae15b7aa307046d', 7, 5, 'DS', '[]', 0, '2020-05-07 15:36:08', '2020-05-07 15:36:08', '2021-05-07 15:36:08');
INSERT INTO `oauth_access_tokens` VALUES ('39b42c76b5415aa4b099ad10c53181e48d26f6db1b5872ae4f7ced7eb391ddc050fd7dbaac940e5a', 7, 5, 'DS', '[]', 0, '2020-05-14 16:19:26', '2020-05-14 16:19:26', '2021-05-14 16:19:26');
INSERT INTO `oauth_access_tokens` VALUES ('3baa2024fa40a1f32c1b3cf945fd6f64849ad3fc4f1bb1e75221499f7032e6f04da4e907f1d9293d', 6, 5, 'app', '[]', 0, '2020-04-30 08:27:20', '2020-04-30 08:27:20', '2021-04-30 08:27:20');
INSERT INTO `oauth_access_tokens` VALUES ('3d80b16c1ed39fad5db70d240bfcef633459b61bbeec2083bb88b378b8dc7d7ef713987ca6f65d04', 14, 5, 'app', '[]', 0, '2020-05-05 10:29:59', '2020-05-05 10:29:59', '2021-05-05 10:29:59');
INSERT INTO `oauth_access_tokens` VALUES ('3f4dd9057536f6aa2326fe0ec9ff566f183941fbfc622d5c187079e582214b70c58097c53eb38cf3', 7, 5, 'DS', '[]', 0, '2020-05-12 08:24:14', '2020-05-12 08:24:14', '2021-05-12 08:24:14');
INSERT INTO `oauth_access_tokens` VALUES ('434efa060381ddbe4408a7e2e4e515a173fadca62571f224a0a6bb62e753d2b8daba0dff216567cd', 13, 5, 'app', '[]', 0, '2020-05-04 12:01:35', '2020-05-04 12:01:35', '2021-05-04 12:01:35');
INSERT INTO `oauth_access_tokens` VALUES ('4424927b426dd3904b22b6e6466a168866ee2ec6c8dc911df3ed35e5011d5c9e1269a850c3c92c15', 18, 5, 'DS', '[]', 0, '2020-05-18 08:00:58', '2020-05-18 08:00:58', '2021-05-18 08:00:58');
INSERT INTO `oauth_access_tokens` VALUES ('49c91b6ab7c1a19ea1d70ee6992f4acf7ac44e11b10015cb44c022b48d0dfc7b664b0f6df17888e9', 7, 5, 'DS', '[]', 0, '2020-05-09 20:28:47', '2020-05-09 20:28:47', '2021-05-09 20:28:47');
INSERT INTO `oauth_access_tokens` VALUES ('4a4eac37d46256d2d7f407c115e8ca487e9af6b1c37ed0dad90c33bceda7851b55539b4dc6b936bf', 7, 5, 'DS', '[]', 0, '2020-04-30 14:46:19', '2020-04-30 14:46:19', '2021-04-30 14:46:19');
INSERT INTO `oauth_access_tokens` VALUES ('4acdf7f04ecd80ed53c480fb7b85fd993ee4942c86b9bd74f7a9dfb197ce40b9a381924cf4121fa7', 7, 5, 'DS', '[]', 0, '2020-04-30 09:26:53', '2020-04-30 09:26:53', '2021-04-30 09:26:53');
INSERT INTO `oauth_access_tokens` VALUES ('4b8615ce120de280adf2f4a3ec08eb63c670adf5e1a7150454265739dda060f6836f1d9d55de9377', 7, 5, 'DS', '[]', 0, '2020-04-30 14:03:58', '2020-04-30 14:03:58', '2021-04-30 14:03:58');
INSERT INTO `oauth_access_tokens` VALUES ('4cd62f6d1f38d9673ec4df6ca92c8023f8692b0a9cf3a131557471e594ba9f203e81f970c5112d06', 18, 5, 'DS', '[]', 0, '2020-05-12 14:13:27', '2020-05-12 14:13:27', '2021-05-12 14:13:27');
INSERT INTO `oauth_access_tokens` VALUES ('50e21f5140c8c0c843d7271ef559d26f3c01114754f659edc0b50e6ee19ae669b8a0bc3354905354', 7, 5, 'DS', '[]', 0, '2020-05-12 11:57:21', '2020-05-12 11:57:21', '2021-05-12 11:57:21');
INSERT INTO `oauth_access_tokens` VALUES ('524b55f5217251ae065abe8054a0527e544881b88a15449df268f26e958098ab209f24f266eef5ba', 7, 5, 'DS', '[]', 0, '2020-05-05 09:01:40', '2020-05-05 09:01:40', '2021-05-05 09:01:40');
INSERT INTO `oauth_access_tokens` VALUES ('553663a92b367183cb5e34c080641df0d62a332265b4691836f2a4e745372632c04204786d29ec4a', 7, 5, 'DS', '[]', 0, '2020-05-06 14:58:14', '2020-05-06 14:58:14', '2021-05-06 14:58:14');
INSERT INTO `oauth_access_tokens` VALUES ('58e4d13c3f1b5eaf9ab647d41e7119e22b2540c2300f847c94a15d8e3851a357dedf31a3126836fa', 1, 5, 'DS', '[]', 0, '2020-04-17 08:28:57', '2020-04-17 08:28:57', '2021-04-17 08:28:57');
INSERT INTO `oauth_access_tokens` VALUES ('58fb3d128b3be1431523f23f4b581b7817bbacb932cf7da6e4085766994a470b07107965a63e640e', 16, 5, 'app', '[]', 0, '2020-05-07 18:36:47', '2020-05-07 18:36:47', '2021-05-07 18:36:47');
INSERT INTO `oauth_access_tokens` VALUES ('5c434beef81c4d8a874b0ed6c265a0f8133bd40bf49997688588f58424a9b65fd5adfc5dc81b16b9', 7, 5, 'DS', '[]', 0, '2020-05-07 15:38:22', '2020-05-07 15:38:22', '2021-05-07 15:38:22');
INSERT INTO `oauth_access_tokens` VALUES ('5fcca75d822e8711e717a5a59724ffedb2d948d5bcac9c19ef2cce3443ea5d6cc50b264bab74a9fd', 7, 5, 'DS', '[]', 0, '2020-04-30 15:42:29', '2020-04-30 15:42:29', '2021-04-30 15:42:29');
INSERT INTO `oauth_access_tokens` VALUES ('61a75500f7f0526fe42f480145d4835ea621f480dc3165bbd0f2f72764a484c05e40759fbbf319a4', 7, 5, 'DS', '[]', 0, '2020-04-30 08:28:15', '2020-04-30 08:28:15', '2021-04-30 08:28:15');
INSERT INTO `oauth_access_tokens` VALUES ('62555753c069a7db9e77de505b54c1b40362b8a20166b240ea445187917b521218e7eee0c6c33d90', 7, 5, 'DS', '[]', 0, '2020-05-12 08:14:59', '2020-05-12 08:14:59', '2021-05-12 08:14:59');
INSERT INTO `oauth_access_tokens` VALUES ('643709d955801fa5bf4d0ff4fc6dc74b9042f3e9f5607e923d74f9a6146d16c896d83c5d51a1a874', 7, 5, 'DS', '[]', 0, '2020-05-11 14:51:09', '2020-05-11 14:51:09', '2021-05-11 14:51:09');
INSERT INTO `oauth_access_tokens` VALUES ('644ae3056a7d131ab51be1891079fd08cf3ad4d7475faceecd55bcbcfe8d5197bb5a08480e99ef82', 7, 5, 'DS', '[]', 0, '2020-05-11 14:39:41', '2020-05-11 14:39:41', '2021-05-11 14:39:41');
INSERT INTO `oauth_access_tokens` VALUES ('684f71f79b47eca0a6228277a14c588b0918bdbcee5f83efe5d5968f00ed32458ba051f9d4470587', 7, 5, 'DS', '[]', 0, '2020-05-12 08:46:18', '2020-05-12 08:46:18', '2021-05-12 08:46:18');
INSERT INTO `oauth_access_tokens` VALUES ('688c1185ac489253984100939b43ed76bf7c3d85c57d4415e8d4cf31711dba692d4786072cadf21e', 7, 5, 'DS', '[]', 0, '2020-05-11 14:37:47', '2020-05-11 14:37:47', '2021-05-11 14:37:47');
INSERT INTO `oauth_access_tokens` VALUES ('69e1499a7d7692041a8c68d2f1ded487a0aed20729804ccf342e9a5520c22312d16373a7911f68fb', 7, 5, 'DS', '[]', 0, '2020-05-12 08:49:43', '2020-05-12 08:49:43', '2021-05-12 08:49:43');
INSERT INTO `oauth_access_tokens` VALUES ('6a6631787998df76b08d696c52581aec3e0fde79380716f69170c24a105283e15d17819b03ca49bf', 7, 5, 'DS', '[]', 0, '2020-05-15 11:47:29', '2020-05-15 11:47:29', '2021-05-15 11:47:29');
INSERT INTO `oauth_access_tokens` VALUES ('6a849b7ee50d3673e4053688658950a9dab2cfd7a9be120e04a0bd24434df4b1f07c74ff73aa3146', 7, 5, 'DS', '[]', 0, '2020-05-11 08:32:00', '2020-05-11 08:32:00', '2021-05-11 08:32:00');
INSERT INTO `oauth_access_tokens` VALUES ('6af7aebdd8a6d00e7a9ffd3d783652e3ff9d663a5fcf17668671a2cbd989c045d603146989cec648', 15, 5, 'DS', '[]', 0, '2020-05-06 23:49:37', '2020-05-06 23:49:37', '2021-05-06 23:49:37');
INSERT INTO `oauth_access_tokens` VALUES ('6e2db054eefb10e94e68412e5875c7ccf85b68362255a8a4a648cf693d66057b672ce646d74dd6a8', 7, 5, 'DS', '[]', 0, '2020-05-12 12:15:57', '2020-05-12 12:15:57', '2021-05-12 12:15:57');
INSERT INTO `oauth_access_tokens` VALUES ('75026bca0d4736dc2c5a6b2c8655396a6b793aece7ed6cc17008a71bc9a23d1d284d20fa2d1a380b', 7, 5, 'DS', '[]', 0, '2020-05-07 09:31:27', '2020-05-07 09:31:27', '2021-05-07 09:31:27');
INSERT INTO `oauth_access_tokens` VALUES ('76f4777c3a42327ab061c6b9f92bc64cacb50e1df617035439d58a202e37ad4fca53511d449b8085', 7, 5, 'DS', '[]', 0, '2020-05-11 14:50:01', '2020-05-11 14:50:01', '2021-05-11 14:50:01');
INSERT INTO `oauth_access_tokens` VALUES ('77738ae664fd33d31b2501e6b41d63cc91d4d611965e84d77d70327afc11a36f9af58859a30aeeef', 7, 5, 'DS', '[]', 0, '2020-05-12 09:02:05', '2020-05-12 09:02:05', '2021-05-12 09:02:05');
INSERT INTO `oauth_access_tokens` VALUES ('787433746645b9c9ed773763dddf7ef19951ac142bad6376774dc3b515a90458381eef8a33f3b6b6', 16, 5, 'DS', '[]', 0, '2020-05-07 18:37:02', '2020-05-07 18:37:02', '2021-05-07 18:37:02');
INSERT INTO `oauth_access_tokens` VALUES ('7a81f519cfc5a047072adac1ce3097567c42c283b917c6e2ea2896e561b697ff300794dec9a675e0', 15, 5, 'DS', '[]', 0, '2020-05-09 14:13:36', '2020-05-09 14:13:36', '2021-05-09 14:13:36');
INSERT INTO `oauth_access_tokens` VALUES ('7e9ea9a000a161da91a05998ca0ba92307dc3774c124e1df0bf39770f243209a48e657a6abe9f34b', 11, 5, 'app', '[]', 0, '2020-05-02 10:51:33', '2020-05-02 10:51:33', '2021-05-02 10:51:33');
INSERT INTO `oauth_access_tokens` VALUES ('7f39dc243e5f8fb9d522641b4f75510ab4719069beae4934f023364f0148f76cf1330175760c4169', 7, 5, 'DS', '[]', 0, '2020-05-12 08:41:59', '2020-05-12 08:41:59', '2021-05-12 08:41:59');
INSERT INTO `oauth_access_tokens` VALUES ('7f4140378d34c9fd82e7b619e7d680e4ba536d6c398a7cddb2f8ec8697ad1cd703e704f3de0a912f', 7, 5, 'DS', '[]', 0, '2020-05-01 09:01:01', '2020-05-01 09:01:01', '2021-05-01 09:01:01');
INSERT INTO `oauth_access_tokens` VALUES ('808b81854651c480e17ab02c239b6a41983b831ecfdd4963946580512ef08df5b38445bbea80500f', 7, 5, 'DS', '[]', 0, '2020-05-12 11:56:19', '2020-05-12 11:56:19', '2021-05-12 11:56:19');
INSERT INTO `oauth_access_tokens` VALUES ('81ca12363dce9a3dbfecb9c0681936e5e29374bf172ce374733521a7291d3c33f9c28518ab3986a7', 7, 5, 'DS', '[]', 0, '2020-05-07 09:49:54', '2020-05-07 09:49:54', '2021-05-07 09:49:54');
INSERT INTO `oauth_access_tokens` VALUES ('868c11236773eda860b3dbd3d5ce5621128fd33451617e6b77839d0855b10545d0bf2464e83a4c3e', 15, 5, 'DS', '[]', 0, '2020-05-07 10:55:31', '2020-05-07 10:55:31', '2021-05-07 10:55:31');
INSERT INTO `oauth_access_tokens` VALUES ('86c12dbbb6c7f92ec6c0d3434dfff93f1a92118a89834c2512ccc3526889b5873473cdb784ce159c', 7, 5, 'DS', '[]', 0, '2020-05-11 15:06:05', '2020-05-11 15:06:05', '2021-05-11 15:06:05');
INSERT INTO `oauth_access_tokens` VALUES ('87a82da3c88c2cbba8ba6a119cb6c2150ed4bccbe6f5d4ab7e5d682554a924328bc0c5cf381ac081', 7, 5, 'DS', '[]', 0, '2020-05-05 09:04:53', '2020-05-05 09:04:53', '2021-05-05 09:04:53');
INSERT INTO `oauth_access_tokens` VALUES ('8e244683893e7a2895e6828ce7f369b703c4bcf7ddf98a5f7e2d23371809ce813e9caacacbb6b977', 7, 5, 'DS', '[]', 0, '2020-05-09 20:28:49', '2020-05-09 20:28:49', '2021-05-09 20:28:49');
INSERT INTO `oauth_access_tokens` VALUES ('8e582b25b789df2db788d319360738c22e05a18799b5d78f2a0d15589fe34cdf986dafa00eaf2a81', 7, 5, 'DS', '[]', 0, '2020-05-07 15:30:39', '2020-05-07 15:30:39', '2021-05-07 15:30:39');
INSERT INTO `oauth_access_tokens` VALUES ('9029c35175c22b64e2679bae08a46e054475dd1e0563c9093c909434b3ec09c4b55dfb0c56a8ed10', 18, 5, 'DS', '[]', 0, '2020-05-11 10:55:36', '2020-05-11 10:55:36', '2021-05-11 10:55:36');
INSERT INTO `oauth_access_tokens` VALUES ('910736223d25205efcd20ee00de45b8f4e54762e89e847e05d46f624136ed123e3e06b0f6c6f4387', 9, 5, 'DS', '[]', 0, '2020-05-01 12:56:27', '2020-05-01 12:56:27', '2021-05-01 12:56:27');
INSERT INTO `oauth_access_tokens` VALUES ('92aed29e8f233a1813805ae0f78fed620ca9a5ff9405af506bdc62b85dde00695c734cd328391112', 7, 5, 'DS', '[]', 0, '2020-05-11 10:59:34', '2020-05-11 10:59:34', '2021-05-11 10:59:34');
INSERT INTO `oauth_access_tokens` VALUES ('92e915729cd7759ab49ce4d10cddb5f6a576870c3679a2552a803af693166189e2f79b272f8864e7', 10, 5, 'app', '[]', 0, '2020-05-01 09:00:50', '2020-05-01 09:00:50', '2021-05-01 09:00:50');
INSERT INTO `oauth_access_tokens` VALUES ('934237154679372d97543be877c7b6ae3d5af8d33ce27d39963102c352cbb096bd17009c83430a20', 7, 5, 'DS', '[]', 0, '2020-05-07 15:37:22', '2020-05-07 15:37:22', '2021-05-07 15:37:22');
INSERT INTO `oauth_access_tokens` VALUES ('935ba9ed7010beae99246fd06406d73061b75c96b3c55693e19fc07ad06be773dc0fb610a8355acd', 7, 5, 'DS', '[]', 0, '2020-05-12 08:31:38', '2020-05-12 08:31:38', '2021-05-12 08:31:38');
INSERT INTO `oauth_access_tokens` VALUES ('9448eff74cff39e9671a58f9305b00a3fa5a45787d7483d13176da73a3483540a894b9945fbd7a3e', 15, 5, 'DS', '[]', 0, '2020-05-08 18:11:07', '2020-05-08 18:11:07', '2021-05-08 18:11:07');
INSERT INTO `oauth_access_tokens` VALUES ('94f90be6e6682cab72dbf8a6cc617e71052373208b17e509b129c7a7e7069a05666aadbb074e3b8f', 7, 5, 'DS', '[]', 0, '2020-05-12 09:00:18', '2020-05-12 09:00:18', '2021-05-12 09:00:18');
INSERT INTO `oauth_access_tokens` VALUES ('9c8b8ae9a5b169d2540ffe8649276d80998eedda9008ff15b492ae7b525efaa443ad15eb9de67b83', 15, 5, 'DS', '[]', 0, '2020-05-11 07:42:43', '2020-05-11 07:42:43', '2021-05-11 07:42:43');
INSERT INTO `oauth_access_tokens` VALUES ('9cf9a1bb97b933b8370bad1bdf7886db1b680a6b7cb2f7f5916409bd2bec4e848ea6f2d876f6fde6', 7, 5, 'DS', '[]', 0, '2020-05-11 10:55:56', '2020-05-11 10:55:56', '2021-05-11 10:55:56');
INSERT INTO `oauth_access_tokens` VALUES ('9ee3e84c26a3a45ab46ccdd7e8201733c3ffc470fbbf591c5dfb42f5913c522a5198ab670884f5b5', 15, 5, 'DS', '[]', 0, '2020-05-07 08:18:53', '2020-05-07 08:18:53', '2021-05-07 08:18:53');
INSERT INTO `oauth_access_tokens` VALUES ('a12a051127d51c70ae74a98241b96792e9d94dda13217cca43b143a8c80cbbacfe116a31ba04c764', 7, 5, 'DS', '[]', 0, '2020-05-12 08:52:13', '2020-05-12 08:52:13', '2021-05-12 08:52:13');
INSERT INTO `oauth_access_tokens` VALUES ('a4406453b554da6dd90270de1805a94c38f2be9e53b2a6a0f55fa20f41042f78d0e3211c5d639df9', 7, 5, 'DS', '[]', 0, '2020-05-11 10:40:48', '2020-05-11 10:40:48', '2021-05-11 10:40:48');
INSERT INTO `oauth_access_tokens` VALUES ('a52e2c1d16d75fe73c501ecafbedcc451dfc443562752cf3e2ce04a5237d2d63b75053288c795a8a', 9, 5, 'app', '[]', 0, '2020-04-30 16:12:45', '2020-04-30 16:12:45', '2021-04-30 16:12:45');
INSERT INTO `oauth_access_tokens` VALUES ('aa5237d53e0cc6344203225b0f75dcf71c828a1f9a24cd2b1ffd984b0f1b5045325ebaeca7cf03be', 17, 5, 'app', '[]', 0, '2020-05-08 09:27:40', '2020-05-08 09:27:40', '2021-05-08 09:27:40');
INSERT INTO `oauth_access_tokens` VALUES ('aab40d84c7d860fa6a78143e23ed9d617ccc54f6d47677dd05f8794929494ec959ce0bb095f791d1', 7, 5, 'DS', '[]', 0, '2020-05-11 10:50:45', '2020-05-11 10:50:45', '2021-05-11 10:50:45');
INSERT INTO `oauth_access_tokens` VALUES ('ac5e1d00cd6f88c2e85919194279b3a48ab50a10b90f15031ae472233f4ec9cf6f2ad9a13c21e361', 15, 5, 'DS', '[]', 0, '2020-05-11 08:34:10', '2020-05-11 08:34:10', '2021-05-11 08:34:10');
INSERT INTO `oauth_access_tokens` VALUES ('ae01f37c725fb34e7b32b97364dcde6ac63ac3ded08e1309c7edf1819f19a4756f562bfde345a335', 20, 5, 'DS', '[]', 0, '2020-05-12 12:54:34', '2020-05-12 12:54:34', '2021-05-12 12:54:34');
INSERT INTO `oauth_access_tokens` VALUES ('af3bba7dc97e7af260edd748338f90130a635855a95040190013bcc1c9651ecb869da9e2256b853b', 18, 5, 'DS', '[]', 0, '2020-05-14 21:15:30', '2020-05-14 21:15:30', '2021-05-14 21:15:30');
INSERT INTO `oauth_access_tokens` VALUES ('b07f509512748fc2ff1109d16e873126511e2619d354dc6176bc62fb2997f3ecc1a1cae6832e773f', 15, 5, 'DS', '[]', 0, '2020-05-12 08:47:55', '2020-05-12 08:47:55', '2021-05-12 08:47:55');
INSERT INTO `oauth_access_tokens` VALUES ('b50d6e1f83e78dd96bfa77e6683893d8972fa916cfbf8319d9d07a77a38dd052da60e33e194de1b4', 1, 1, 'DS', '[]', 0, '2020-04-16 11:27:56', '2020-04-16 11:27:56', '2021-04-16 11:27:56');
INSERT INTO `oauth_access_tokens` VALUES ('b7b0bda0334a631508bb2fe67e382748aabac57198c07f8ea1a71405b880e6f6a9c6d90a915b4855', 7, 5, 'DS', '[]', 0, '2020-05-12 11:53:38', '2020-05-12 11:53:38', '2021-05-12 11:53:38');
INSERT INTO `oauth_access_tokens` VALUES ('b7b69ee7e09fc43da7bf8050cf56d8eba7e7312079d3d580d18fe259935a08cfd0f9817bd372777b', 7, 5, 'DS', '[]', 0, '2020-05-12 10:06:09', '2020-05-12 10:06:09', '2021-05-12 10:06:09');
INSERT INTO `oauth_access_tokens` VALUES ('c0de07adf4a940eeae895b4e3925b2a67da1903aa6055ed5eb843b83447fb2da5a756649a3a51a47', 1, 1, 'app', '[]', 0, '2020-04-15 08:47:00', '2020-04-15 08:47:00', '2021-04-15 08:47:00');
INSERT INTO `oauth_access_tokens` VALUES ('c0e5e2aff45c8771c2c31f75c1963db1e68f002bff6803242f759bfd8f0421f89b343a501a8c49f9', 7, 5, 'DS', '[]', 0, '2020-05-07 15:39:25', '2020-05-07 15:39:25', '2021-05-07 15:39:25');
INSERT INTO `oauth_access_tokens` VALUES ('c7f1495892d24772c2e7f0045acb29c994120b75cf236d09ac35afad217c427c8bb7f6112f18aeb3', 7, 5, 'DS', '[]', 0, '2020-05-07 15:32:02', '2020-05-07 15:32:02', '2021-05-07 15:32:02');
INSERT INTO `oauth_access_tokens` VALUES ('c9dbe697da0efea02ba3f8cbfbc972853ff15bc513bbc22f5197bcc07c34cd2460193b043069d3b9', 7, 5, 'DS', '[]', 0, '2020-05-07 15:21:32', '2020-05-07 15:21:32', '2021-05-07 15:21:32');
INSERT INTO `oauth_access_tokens` VALUES ('c9f0b9f28a51c7d8f561a6c2e5bb34a6e127edce800f5843bd4e69a1f9dc0d1f655e47f600e185cd', 7, 5, 'DS', '[]', 0, '2020-05-15 12:31:12', '2020-05-15 12:31:12', '2021-05-15 12:31:12');
INSERT INTO `oauth_access_tokens` VALUES ('cd57d45d93277707eb299efb67639bfda64377252601aadad5780763a051485e67f48840ab0336be', 7, 5, 'DS', '[]', 0, '2020-05-12 12:47:25', '2020-05-12 12:47:25', '2021-05-12 12:47:25');
INSERT INTO `oauth_access_tokens` VALUES ('cfb81c8e195e1bb5f67573213e5ccb064a1114fd749e8571867ee469d89b3fe976e4c2efa049cb1f', 18, 5, 'DS', '[]', 0, '2020-05-14 20:10:36', '2020-05-14 20:10:36', '2021-05-14 20:10:36');
INSERT INTO `oauth_access_tokens` VALUES ('d0d7ed2e1f59e84154140429865a503286b527bc323ee94c3f81ec77b2d12d0acff8c56a076da7a1', 7, 5, 'DS', '[]', 0, '2020-05-11 15:00:33', '2020-05-11 15:00:33', '2021-05-11 15:00:33');
INSERT INTO `oauth_access_tokens` VALUES ('d15eb23cc4b61a22ad2d8b7bafa2408f653bb763b6e6802ac02a58071c45e58bc19f9480ce7ff82a', 7, 5, 'DS', '[]', 0, '2020-05-06 14:59:39', '2020-05-06 14:59:39', '2021-05-06 14:59:39');
INSERT INTO `oauth_access_tokens` VALUES ('d15f9552f5c73cd48a25a851ab4bbda0b365b64cb0a31180ceeb4c3c54bfaba965aed6f72c19c242', 1, 1, 'app', '[]', 0, '2020-04-16 09:06:26', '2020-04-16 09:06:26', '2021-04-16 09:06:26');
INSERT INTO `oauth_access_tokens` VALUES ('d2bdf18afd7eeb15603e8e9c5aab1c19d83e7407568394565fc76f4ff93f53c35e9fb19299a0a5c7', 7, 5, 'DS', '[]', 0, '2020-05-18 13:14:02', '2020-05-18 13:14:02', '2021-05-18 13:14:02');
INSERT INTO `oauth_access_tokens` VALUES ('d398305482160d81b147b48d6fe75f17ff3c4b9cd498ad3917e0f92c480617271cb5e7cbb0a030c4', 2, 5, 'app', '[]', 0, '2020-04-20 13:55:01', '2020-04-20 13:55:01', '2021-04-20 13:55:01');
INSERT INTO `oauth_access_tokens` VALUES ('d89d1ec113044bf30a81866f9c01589184f82037e0e50ac597d8e76b957ed1404ba4b7b62129639a', 7, 5, 'DS', '[]', 0, '2020-05-11 14:54:28', '2020-05-11 14:54:28', '2021-05-11 14:54:28');
INSERT INTO `oauth_access_tokens` VALUES ('da49dcd1c91d6917186986a1a9ccfc4c719161118400b4ffed89e47df489adddbc9cac9b8edb8783', 15, 5, 'DS', '[]', 0, '2020-05-08 22:15:28', '2020-05-08 22:15:28', '2021-05-08 22:15:28');
INSERT INTO `oauth_access_tokens` VALUES ('dbfbedb0aa163c1b3477d7b3f0d77f4ea7e27cb55323d40a0496e2d805058d7f46f420ffda2fcc1c', 7, 5, 'DS', '[]', 0, '2020-05-11 14:42:07', '2020-05-11 14:42:07', '2021-05-11 14:42:07');
INSERT INTO `oauth_access_tokens` VALUES ('de99e55a90281c7c7c7904c390372c54ddce8d0f56be11ee2f677ecf50931032b4ad1be03f08a8f7', 7, 5, 'DS', '[]', 0, '2020-05-09 11:05:34', '2020-05-09 11:05:34', '2021-05-09 11:05:34');
INSERT INTO `oauth_access_tokens` VALUES ('de9a372b4b9dc3ada6dc2148904a4cf68b2c9925951acdddce83e2591ccbf4835febcf5a514d6e92', 7, 5, 'DS', '[]', 0, '2020-05-12 08:34:42', '2020-05-12 08:34:42', '2021-05-12 08:34:42');
INSERT INTO `oauth_access_tokens` VALUES ('e1086d3621c3fe65fecffa4b8b368eb315261bb735fd04f856110a566fd255bfb6878f322e5f7fd2', 7, 5, 'DS', '[]', 0, '2020-05-11 14:36:55', '2020-05-11 14:36:55', '2021-05-11 14:36:55');
INSERT INTO `oauth_access_tokens` VALUES ('e15b3b420eb7704cdf8de14005db886bb5a47d35cd2461047ef374c6281698fbf9a6274e56521e82', 7, 5, 'DS', '[]', 0, '2020-05-11 09:18:10', '2020-05-11 09:18:10', '2021-05-11 09:18:10');
INSERT INTO `oauth_access_tokens` VALUES ('e36f3fdd2a71c1997d8f6800e47c8d3c7ae3665225ad24da1475e70465a43c4d56fa3da5bfea544c', 7, 5, 'DS', '[]', 0, '2020-05-12 08:54:10', '2020-05-12 08:54:10', '2021-05-12 08:54:10');
INSERT INTO `oauth_access_tokens` VALUES ('e6cc190e716dabe20f08f298a617a3a09f125d2b4c09850c8ef8cac8c44d3e7d410e890c8a0a58d2', 7, 5, 'DS', '[]', 0, '2020-05-09 11:09:14', '2020-05-09 11:09:14', '2021-05-09 11:09:14');
INSERT INTO `oauth_access_tokens` VALUES ('e72aeffe05c45bbc56dfdadcb8300544824b8a6c60fcd003f1df1c43fadd6a1ded0dbf527a2ca2aa', 7, 5, 'DS', '[]', 0, '2020-05-07 15:19:05', '2020-05-07 15:19:05', '2021-05-07 15:19:05');
INSERT INTO `oauth_access_tokens` VALUES ('e8408915a07064f8d57542a054b7f20970cf1dc5c49b8ec42dbba67429500c589e451ec5e4bcb0d0', 7, 5, 'DS', '[]', 0, '2020-05-04 14:30:46', '2020-05-04 14:30:46', '2021-05-04 14:30:46');
INSERT INTO `oauth_access_tokens` VALUES ('ea496d44b53198fe7792e36bc2591fa9381b1864a859cf9d8d523cca32d627914377f1ba4def6ce7', 1, 5, 'DS', '[]', 0, '2020-04-17 11:57:41', '2020-04-17 11:57:41', '2021-04-17 11:57:41');
INSERT INTO `oauth_access_tokens` VALUES ('edccbf3eb81514df910b11610c0cab284e16f30633c72e3a15c00aa035afc0eabf98af0d7f185885', 7, 5, 'DS', '[]', 0, '2020-05-13 07:44:20', '2020-05-13 07:44:20', '2021-05-13 07:44:20');
INSERT INTO `oauth_access_tokens` VALUES ('ee0dd3bcaa7f6943b5cb198d612a910465018ebda65238c27067f4e54b991d6b974caabf561a7f3e', 1, 1, 'app', '[]', 0, '2020-04-16 09:49:19', '2020-04-16 09:49:19', '2021-04-16 09:49:19');
INSERT INTO `oauth_access_tokens` VALUES ('ef03a0dba9a6cfd048d05eff0fa2082fa161d4ba78787e8244aff510f1df235fdeddbfddb02f247f', 7, 5, 'DS', '[]', 0, '2020-05-14 18:27:11', '2020-05-14 18:27:11', '2021-05-14 18:27:11');
INSERT INTO `oauth_access_tokens` VALUES ('ef1fbf9958319fcadab17276967f3be5e234916ccd0ea8c0521f11302bed1456dfe6d1a6563050a3', 7, 5, 'DS', '[]', 0, '2020-05-12 09:05:12', '2020-05-12 09:05:12', '2021-05-12 09:05:12');
INSERT INTO `oauth_access_tokens` VALUES ('f01a831edb570e0380abbf77a686bf654f95c04409f6314fb3cc3c84470314f36b938dc48af3d32f', 7, 5, 'DS', '[]', 0, '2020-05-11 07:49:31', '2020-05-11 07:49:31', '2021-05-11 07:49:31');
INSERT INTO `oauth_access_tokens` VALUES ('f3a928aa4e253f87284028301661114afd6fa46bfa6aa26fd55f7f9155c4652b2bb17311d1ac276d', 7, 5, 'DS', '[]', 0, '2020-05-15 15:11:53', '2020-05-15 15:11:53', '2021-05-15 15:11:53');
INSERT INTO `oauth_access_tokens` VALUES ('f587d7378c1950193af681f031c92af84964ac3403ab9dd3b1f8a8be5476ced3d5ccd4ea3ed1efdf', 15, 5, 'DS', '[]', 0, '2020-05-12 08:46:12', '2020-05-12 08:46:12', '2021-05-12 08:46:12');
INSERT INTO `oauth_access_tokens` VALUES ('f813651772e1e2a9e42b0f5e9095a967483891cf3909abf57ca59d91ddac449e8f6e36831297be19', 7, 5, 'DS', '[]', 0, '2020-04-30 14:42:49', '2020-04-30 14:42:49', '2021-04-30 14:42:49');
INSERT INTO `oauth_access_tokens` VALUES ('fa07345095707a9552a24c675c9553ff4fdb764d72f775a13f48e05f82230fda9ab52cb285c0417d', 7, 5, 'DS', '[]', 0, '2020-05-07 15:42:38', '2020-05-07 15:42:38', '2021-05-07 15:42:38');
INSERT INTO `oauth_access_tokens` VALUES ('fc0acda4ecbdaba5c0855eb287d16de7706624363765271e2c06c1e2bab158dcda5cbe4e4bd05e39', 7, 5, 'DS', '[]', 0, '2020-05-11 14:48:20', '2020-05-11 14:48:20', '2021-05-11 14:48:20');
INSERT INTO `oauth_access_tokens` VALUES ('fdf57460bf1df7659d49bd3f93e1e12dda1f5c4f4acb308c4c4305a5b972a8317fd4f4a5d159e31d', 7, 5, 'app', '[]', 0, '2020-04-30 08:28:05', '2020-04-30 08:28:05', '2021-04-30 08:28:05');
INSERT INTO `oauth_access_tokens` VALUES ('ff5c21d4990fa955f81eeef212373f0dbd74c85d96b1710e81b261e94c9a140e921445ec6615c004', 7, 5, 'DS', '[]', 0, '2020-05-11 15:01:58', '2020-05-11 15:01:58', '2021-05-11 15:01:58');

-- ----------------------------
-- Table structure for oauth_auth_codes
-- ----------------------------
DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes`  (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_auth_codes_user_id_index`(`user_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for oauth_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `redirect` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_clients_user_id_index`(`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of oauth_clients
-- ----------------------------
INSERT INTO `oauth_clients` VALUES (1, NULL, 'Laravel Personal Access Client', 'lO55dmWlzdf8VymM66kX0IVEnkJrZKWd1LhFtlAX', 'http://localhost', 1, 0, 0, '2020-04-14 15:29:32', '2020-04-14 15:29:32');
INSERT INTO `oauth_clients` VALUES (2, NULL, 'Laravel Password Grant Client', '5dIejELwngyYpi3JRuvEZOOoMF9xp3kv9OnFdrWs', 'http://localhost', 0, 1, 0, '2020-04-14 15:29:32', '2020-04-14 15:29:32');
INSERT INTO `oauth_clients` VALUES (3, NULL, 'Laravel Personal Access Client', 'pk6CVzuEyaMdsmXVzpkOlmFByUfAOG86qz9z0gqb', 'http://localhost', 1, 0, 0, '2020-04-16 12:43:46', '2020-04-16 12:43:46');
INSERT INTO `oauth_clients` VALUES (4, NULL, 'Laravel Password Grant Client', 'GPkXPV4Lq2gYAnE4k8j065Vbt6xTsnAru18xVfx7', 'http://localhost', 0, 1, 0, '2020-04-16 12:43:46', '2020-04-16 12:43:46');
INSERT INTO `oauth_clients` VALUES (5, NULL, 'Laravel Personal Access Client', 'OuNbFn8LOX57cGDR6tKXSCv4QWquAffi4U6HKw9Q', 'http://localhost', 1, 0, 0, '2020-04-16 13:39:18', '2020-04-16 13:39:18');
INSERT INTO `oauth_clients` VALUES (6, NULL, 'Laravel Password Grant Client', 'xEe31P6U93YQU5WqaiyS82lqzCkBid9Os9onlmcc', 'http://localhost', 0, 1, 0, '2020-04-16 13:39:18', '2020-04-16 13:39:18');

-- ----------------------------
-- Table structure for oauth_personal_access_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of oauth_personal_access_clients
-- ----------------------------
INSERT INTO `oauth_personal_access_clients` VALUES (1, 1, '2020-04-14 15:29:32', '2020-04-14 15:29:32');
INSERT INTO `oauth_personal_access_clients` VALUES (2, 3, '2020-04-16 12:43:46', '2020-04-16 12:43:46');
INSERT INTO `oauth_personal_access_clients` VALUES (3, 5, '2020-04-16 13:39:18', '2020-04-16 13:39:18');

-- ----------------------------
-- Table structure for oauth_refresh_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens`  (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for order_items
-- ----------------------------
DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(8, 2) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 93 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_items
-- ----------------------------
INSERT INTO `order_items` VALUES (1, 1, 1, 'Test', 5, 600.00, 3000, '2020-04-28 09:59:12', '2020-04-28 09:59:12');
INSERT INTO `order_items` VALUES (2, 1, 2, 'Test', 5, 10000.00, 50000, '2020-04-28 09:59:12', '2020-04-28 09:59:12');
INSERT INTO `order_items` VALUES (3, 2, 1, 'Test', 5, 600.00, 3000, '2020-04-28 09:59:15', '2020-04-28 09:59:15');
INSERT INTO `order_items` VALUES (4, 2, 2, 'Test', 5, 10000.00, 50000, '2020-04-28 09:59:15', '2020-04-28 09:59:15');
INSERT INTO `order_items` VALUES (5, 3, 1, 'Test', 5, 600.00, 3000, '2020-04-28 09:59:18', '2020-04-28 09:59:18');
INSERT INTO `order_items` VALUES (6, 3, 2, 'Test', 5, 10000.00, 50000, '2020-04-28 09:59:18', '2020-04-28 09:59:18');
INSERT INTO `order_items` VALUES (7, 4, 1, 'Test', 5, 600.00, 3000, '2020-04-28 12:42:07', '2020-04-28 12:42:07');
INSERT INTO `order_items` VALUES (8, 4, 2, 'Test', 5, 10000.00, 50000, '2020-04-28 12:42:07', '2020-04-28 12:42:07');
INSERT INTO `order_items` VALUES (9, 5, 4, 'Productasdad', 2, 120.00, 240, '2020-04-30 13:22:42', '2020-04-30 13:22:42');
INSERT INTO `order_items` VALUES (10, 5, 3, 'Product123', 1, 120.00, 120, '2020-04-30 13:22:42', '2020-04-30 13:22:42');
INSERT INTO `order_items` VALUES (11, 5, 1, 'Test', 3, 1200.00, 3600, '2020-04-30 13:22:42', '2020-04-30 13:22:42');
INSERT INTO `order_items` VALUES (12, 6, 3, 'Product123', 2, 120.00, 240, '2020-04-30 15:56:17', '2020-04-30 15:56:17');
INSERT INTO `order_items` VALUES (13, 6, 1, 'Test', 3, 1200.00, 3600, '2020-04-30 15:56:17', '2020-04-30 15:56:17');
INSERT INTO `order_items` VALUES (14, 7, 1, 'Test', 3, 1200.00, 3600, '2020-05-01 09:07:12', '2020-05-01 09:07:12');
INSERT INTO `order_items` VALUES (15, 8, 1, 'Test', 5, 600.00, 3000, '2020-05-04 15:32:50', '2020-05-04 15:32:50');
INSERT INTO `order_items` VALUES (16, 8, 2, 'Test', 5, 10000.00, 50000, '2020-05-04 15:32:50', '2020-05-04 15:32:50');
INSERT INTO `order_items` VALUES (17, 9, 1, 'Test', 5, 600.00, 3000, '2020-05-04 15:32:52', '2020-05-04 15:32:52');
INSERT INTO `order_items` VALUES (18, 9, 2, 'Test', 5, 10000.00, 50000, '2020-05-04 15:32:52', '2020-05-04 15:32:52');
INSERT INTO `order_items` VALUES (19, 10, 1, 'Test', 5, 600.00, 3000, '2020-05-04 15:32:54', '2020-05-04 15:32:54');
INSERT INTO `order_items` VALUES (20, 10, 2, 'Test', 5, 10000.00, 50000, '2020-05-04 15:32:54', '2020-05-04 15:32:54');
INSERT INTO `order_items` VALUES (21, 11, 7, 'test', 2, 480.00, 960, '2020-05-05 08:03:47', '2020-05-05 08:03:47');
INSERT INTO `order_items` VALUES (22, 11, 5, 'Product123', 2, 120.00, 240, '2020-05-05 08:03:47', '2020-05-05 08:03:47');
INSERT INTO `order_items` VALUES (23, 12, 3, 'Product123', 5, 120.00, 600, '2020-05-05 09:11:18', '2020-05-05 09:11:18');
INSERT INTO `order_items` VALUES (24, 12, 1, 'Test', 4, 1200.00, 4800, '2020-05-05 09:11:18', '2020-05-05 09:11:18');
INSERT INTO `order_items` VALUES (25, 13, 5, 'Product123', 1, 120.00, 120, '2020-05-05 09:12:18', '2020-05-05 09:12:18');
INSERT INTO `order_items` VALUES (26, 13, 4, 'Productasdad', 1, 120.00, 120, '2020-05-05 09:12:18', '2020-05-05 09:12:18');
INSERT INTO `order_items` VALUES (27, 13, 3, 'Product123', 1, 120.00, 120, '2020-05-05 09:12:18', '2020-05-05 09:12:18');
INSERT INTO `order_items` VALUES (28, 13, 1, 'Test', 1, 1200.00, 1200, '2020-05-05 09:12:18', '2020-05-05 09:12:18');
INSERT INTO `order_items` VALUES (29, 14, 1, 'Test', 5, 600.00, 3000, '2020-05-05 14:27:51', '2020-05-05 14:27:51');
INSERT INTO `order_items` VALUES (30, 14, 2, 'Test', 5, 10000.00, 50000, '2020-05-05 14:27:51', '2020-05-05 14:27:51');
INSERT INTO `order_items` VALUES (31, 15, 1, 'Test', 5, 600.00, 3000, '2020-05-05 14:27:57', '2020-05-05 14:27:57');
INSERT INTO `order_items` VALUES (32, 15, 2, 'Test', 5, 10000.00, 50000, '2020-05-05 14:27:57', '2020-05-05 14:27:57');
INSERT INTO `order_items` VALUES (33, 16, 1, 'Test', 5, 600.00, 3000, '2020-05-05 14:51:49', '2020-05-05 14:51:49');
INSERT INTO `order_items` VALUES (34, 17, 1, 'Test', 5, 600.00, 3000, '2020-05-05 14:54:55', '2020-05-05 14:54:55');
INSERT INTO `order_items` VALUES (35, 18, 1, 'Test', 5, 600.00, 3000, '2020-05-05 14:55:12', '2020-05-05 14:55:12');
INSERT INTO `order_items` VALUES (36, 19, 1, 'Test', 5, 600.00, 3000, '2020-05-05 14:55:40', '2020-05-05 14:55:40');
INSERT INTO `order_items` VALUES (37, 20, 1, 'Test', 5, 600.00, 3000, '2020-05-05 14:56:04', '2020-05-05 14:56:04');
INSERT INTO `order_items` VALUES (38, 21, 1, 'Test', 5, 600.00, 3000, '2020-05-05 14:56:22', '2020-05-05 14:56:22');
INSERT INTO `order_items` VALUES (39, 22, 1, 'Test', 5, 600.00, 3000, '2020-05-05 14:57:25', '2020-05-05 14:57:25');
INSERT INTO `order_items` VALUES (40, 22, 2, 'Test', 5, 10000.00, 50000, '2020-05-05 14:57:25', '2020-05-05 14:57:25');
INSERT INTO `order_items` VALUES (41, 23, 1, 'Test', 5, 600.00, 3000, '2020-05-05 14:58:22', '2020-05-05 14:58:22');
INSERT INTO `order_items` VALUES (42, 23, 2, 'Test', 5, 10000.00, 50000, '2020-05-05 14:58:22', '2020-05-05 14:58:22');
INSERT INTO `order_items` VALUES (43, 24, 1, 'Test', 5, 600.00, 3000, '2020-05-05 14:59:09', '2020-05-05 14:59:09');
INSERT INTO `order_items` VALUES (44, 25, 1, 'Test', 5, 600.00, 3000, '2020-05-05 15:00:01', '2020-05-05 15:00:01');
INSERT INTO `order_items` VALUES (45, 26, 1, 'Test', 5, 600.00, 3000, '2020-05-05 15:00:12', '2020-05-05 15:00:12');
INSERT INTO `order_items` VALUES (46, 26, 2, 'Test', 5, 10000.00, 50000, '2020-05-05 15:00:12', '2020-05-05 15:00:12');
INSERT INTO `order_items` VALUES (47, 27, 1, 'Test', 5, 600.00, 3000, '2020-05-05 15:00:34', '2020-05-05 15:00:34');
INSERT INTO `order_items` VALUES (48, 27, 2, 'Test', 5, 10000.00, 50000, '2020-05-05 15:00:34', '2020-05-05 15:00:34');
INSERT INTO `order_items` VALUES (49, 28, 1, 'Test', 5, 600.00, 3000, '2020-05-06 09:00:03', '2020-05-06 09:00:03');
INSERT INTO `order_items` VALUES (50, 28, 2, 'Test', 5, 10000.00, 50000, '2020-05-06 09:00:03', '2020-05-06 09:00:03');
INSERT INTO `order_items` VALUES (51, 29, 1, 'Test', 1, 1200.00, 1200, '2020-05-06 09:06:57', '2020-05-06 09:06:57');
INSERT INTO `order_items` VALUES (52, 30, 1, 'Test', 5, 600.00, 3000, '2020-05-06 09:45:07', '2020-05-06 09:45:07');
INSERT INTO `order_items` VALUES (53, 30, 2, 'Test', 5, 10000.00, 50000, '2020-05-06 09:45:07', '2020-05-06 09:45:07');
INSERT INTO `order_items` VALUES (54, 31, 4, 'Productasdad', 3, 120.00, 360, '2020-05-06 15:03:28', '2020-05-06 15:03:28');
INSERT INTO `order_items` VALUES (55, 31, 3, 'Product123', 2, 120.00, 240, '2020-05-06 15:03:28', '2020-05-06 15:03:28');
INSERT INTO `order_items` VALUES (56, 32, 5, 'Product123', 1, 120.00, 120, '2020-05-06 15:03:54', '2020-05-06 15:03:54');
INSERT INTO `order_items` VALUES (57, 32, 4, 'Productasdad', 1, 120.00, 120, '2020-05-06 15:03:54', '2020-05-06 15:03:54');
INSERT INTO `order_items` VALUES (58, 32, 3, 'Product123', 1, 120.00, 120, '2020-05-06 15:03:54', '2020-05-06 15:03:54');
INSERT INTO `order_items` VALUES (59, 33, 5, 'Product123', 3, 120.00, 360, '2020-05-06 23:53:24', '2020-05-06 23:53:24');
INSERT INTO `order_items` VALUES (60, 33, 4, 'Productasdad', 2, 120.00, 240, '2020-05-06 23:53:24', '2020-05-06 23:53:24');
INSERT INTO `order_items` VALUES (61, 33, 3, 'Product123', 1, 120.00, 120, '2020-05-06 23:53:24', '2020-05-06 23:53:24');
INSERT INTO `order_items` VALUES (62, 33, 1, 'Test', 1, 1200.00, 1200, '2020-05-06 23:53:24', '2020-05-06 23:53:24');
INSERT INTO `order_items` VALUES (63, 34, 5, 'Product123', 1, 120.00, 120, '2020-05-07 08:08:33', '2020-05-07 08:08:33');
INSERT INTO `order_items` VALUES (64, 34, 3, 'Product123', 4, 120.00, 480, '2020-05-07 08:08:33', '2020-05-07 08:08:33');
INSERT INTO `order_items` VALUES (65, 35, 4, 'Productasdad', 1, 120.00, 120, '2020-05-07 09:18:45', '2020-05-07 09:18:45');
INSERT INTO `order_items` VALUES (66, 35, 3, 'Product123', 2, 120.00, 240, '2020-05-07 09:18:45', '2020-05-07 09:18:45');
INSERT INTO `order_items` VALUES (67, 35, 1, 'Test', 2, 1200.00, 2400, '2020-05-07 09:18:45', '2020-05-07 09:18:45');
INSERT INTO `order_items` VALUES (68, 36, 4, 'Productasdad', 1, 120.00, 120, '2020-05-07 10:57:20', '2020-05-07 10:57:20');
INSERT INTO `order_items` VALUES (69, 36, 1, 'Test', 6, 1200.00, 7200, '2020-05-07 10:57:20', '2020-05-07 10:57:20');
INSERT INTO `order_items` VALUES (70, 37, 5, 'Product123', 1, 120.00, 120, '2020-05-07 15:26:23', '2020-05-07 15:26:23');
INSERT INTO `order_items` VALUES (71, 37, 4, 'Productasdad', 1, 120.00, 120, '2020-05-07 15:26:23', '2020-05-07 15:26:23');
INSERT INTO `order_items` VALUES (72, 37, 3, 'Product123', 1, 120.00, 120, '2020-05-07 15:26:23', '2020-05-07 15:26:23');
INSERT INTO `order_items` VALUES (73, 37, 1, 'Test', 1, 1200.00, 1200, '2020-05-07 15:26:23', '2020-05-07 15:26:23');
INSERT INTO `order_items` VALUES (74, 38, 6, 'Productasdad', 2, 120.00, 240, '2020-05-08 08:44:17', '2020-05-08 08:44:17');
INSERT INTO `order_items` VALUES (75, 39, 1, 'Test', 6, 1200.00, 7200, '2020-05-09 11:14:47', '2020-05-09 11:14:47');
INSERT INTO `order_items` VALUES (76, 40, 6, 'Productasdad', 1, 120.00, 120, '2020-05-11 11:06:23', '2020-05-11 11:06:23');
INSERT INTO `order_items` VALUES (77, 40, 4, 'Productasdad', 1, 120.00, 120, '2020-05-11 11:06:23', '2020-05-11 11:06:23');
INSERT INTO `order_items` VALUES (78, 40, 3, 'Product123', 1, 120.00, 120, '2020-05-11 11:06:23', '2020-05-11 11:06:23');
INSERT INTO `order_items` VALUES (79, 40, 1, 'Test', 1, 1200.00, 1200, '2020-05-11 11:06:23', '2020-05-11 11:06:23');
INSERT INTO `order_items` VALUES (80, 41, 6, 'Productasdad', 5, 120.00, 600, '2020-05-11 11:07:36', '2020-05-11 11:07:36');
INSERT INTO `order_items` VALUES (81, 41, 5, 'Product123', 3, 120.00, 360, '2020-05-11 11:07:36', '2020-05-11 11:07:36');
INSERT INTO `order_items` VALUES (82, 41, 4, 'Productasdad', 3, 120.00, 360, '2020-05-11 11:07:36', '2020-05-11 11:07:36');
INSERT INTO `order_items` VALUES (83, 41, 3, 'Product123', 4, 120.00, 480, '2020-05-11 11:07:36', '2020-05-11 11:07:36');
INSERT INTO `order_items` VALUES (84, 41, 1, 'Test', 4, 1200.00, 4800, '2020-05-11 11:07:36', '2020-05-11 11:07:36');
INSERT INTO `order_items` VALUES (85, 42, 3, 'Product123', 1, 120.00, 120, '2020-05-11 11:15:08', '2020-05-11 11:15:08');
INSERT INTO `order_items` VALUES (86, 42, 1, 'Test', 1, 1200.00, 1200, '2020-05-11 11:15:08', '2020-05-11 11:15:08');
INSERT INTO `order_items` VALUES (87, 43, 3, 'Product123', 1, 120.00, 120, '2020-05-11 11:15:09', '2020-05-11 11:15:09');
INSERT INTO `order_items` VALUES (88, 43, 1, 'Test', 1, 1200.00, 1200, '2020-05-11 11:15:09', '2020-05-11 11:15:09');
INSERT INTO `order_items` VALUES (89, 44, 1, 'Test', 1, 1200.00, 1200, '2020-05-11 11:47:34', '2020-05-11 11:47:34');
INSERT INTO `order_items` VALUES (90, 45, 3, 'Product123', 1, 120.00, 120, '2020-05-11 14:03:44', '2020-05-11 14:03:44');
INSERT INTO `order_items` VALUES (91, 46, 1, 'Parfumlule', 4, 123.00, 492, '2020-05-15 10:57:58', '2020-05-15 10:57:58');
INSERT INTO `order_items` VALUES (92, 47, 15, 'Traditional Indian Cuisine', 4, 120.00, 480, '2020-05-17 11:51:40', '2020-05-17 11:51:40');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mobile_user_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `business_id` int(11) NULL DEFAULT NULL,
  `status` enum('pending','approved','refused','delivering','delivered','canceled') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `total` int(11) NULL DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `coupon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `orders_status_index`(`status`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 48 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES (1, 1, 1, 21, 'approved', 53000, 'zxczxczczxczxc', '2020-04-28 09:59:12', '2020-04-28 10:10:45', NULL);
INSERT INTO `orders` VALUES (2, 2, 1, 21, 'approved', 53000, 'zxczxczczxczxc', '2020-04-28 09:59:15', '2020-04-28 11:14:42', NULL);
INSERT INTO `orders` VALUES (3, 1, 1, 21, 'approved', 53000, 'zxczxczczxczxc', '2020-04-28 09:59:18', '2020-04-28 12:41:52', NULL);
INSERT INTO `orders` VALUES (4, 1, 1, 21, 'pending', 53000, 'zxczxczczxczxc', '2020-04-28 12:42:07', '2020-04-28 12:42:07', NULL);
INSERT INTO `orders` VALUES (5, 7, 4, 1, 'pending', 3960, 'Note', '2020-04-30 13:22:42', '2020-04-30 13:22:42', NULL);
INSERT INTO `orders` VALUES (6, 7, 5, 1, 'approved', 3840, 'Note', '2020-04-30 15:56:17', '2020-04-30 15:56:17', NULL);
INSERT INTO `orders` VALUES (7, 7, 4, 1, 'refused', 3600, 'Note', '2020-05-01 09:07:12', '2020-05-01 09:07:12', NULL);
INSERT INTO `orders` VALUES (8, 13, 1, 21, 'pending', 53000, 'zxczxczczxczxc', '2020-05-04 15:32:50', '2020-05-04 15:32:50', NULL);
INSERT INTO `orders` VALUES (9, 13, 1, 21, 'pending', 53000, 'zxczxczczxczxc', '2020-05-04 15:32:52', '2020-05-04 15:32:52', NULL);
INSERT INTO `orders` VALUES (10, 13, 1, 21, 'approved', 53000, 'zxczxczczxczxc', '2020-05-04 15:32:54', '2020-05-04 15:32:54', NULL);
INSERT INTO `orders` VALUES (11, 7, 4, 1, 'pending', 1200, 'Note', '2020-05-05 08:03:47', '2020-05-05 08:03:47', NULL);
INSERT INTO `orders` VALUES (12, 7, 4, 1, 'pending', 5400, 'Note', '2020-05-05 09:11:18', '2020-05-05 09:11:18', NULL);
INSERT INTO `orders` VALUES (13, 7, 5, 1, 'pending', 1560, 'Note', '2020-05-05 09:12:18', '2020-05-05 09:12:18', NULL);
INSERT INTO `orders` VALUES (14, 13, 1, 21, 'pending', 53000, 'zxczxczczxczxc', '2020-05-05 14:27:51', '2020-05-05 14:27:51', NULL);
INSERT INTO `orders` VALUES (15, 13, 1, 21, 'pending', 53000, 'zxczxczczxczxc', '2020-05-05 14:27:57', '2020-05-05 14:27:57', NULL);
INSERT INTO `orders` VALUES (16, 13, 1, 21, 'pending', 51800, 'zxczxczczxczxc', '2020-05-05 14:51:49', '2020-05-05 14:51:49', 'P6PxPlQIE9');
INSERT INTO `orders` VALUES (17, 13, 1, 21, 'pending', 51800, 'zxczxczczxczxc', '2020-05-05 14:54:55', '2020-05-05 14:54:55', 'P6PxPlQIE9');
INSERT INTO `orders` VALUES (18, 13, 1, 21, 'pending', 51800, 'zxczxczczxczxc', '2020-05-05 14:55:12', '2020-05-05 14:55:12', 'P6PxPlQIE9');
INSERT INTO `orders` VALUES (19, 13, 1, 21, 'pending', 51800, 'zxczxczczxczxc', '2020-05-05 14:55:40', '2020-05-05 14:55:40', 'P6PxPlQIE9');
INSERT INTO `orders` VALUES (20, 13, 1, 21, 'pending', 51800, 'zxczxczczxczxc', '2020-05-05 14:56:04', '2020-05-05 14:56:04', 'P6PxPlQIE9');
INSERT INTO `orders` VALUES (21, 13, 1, 21, 'pending', 51800, 'zxczxczczxczxc', '2020-05-05 14:56:22', '2020-05-05 14:56:22', 'P6PxPlQIE9');
INSERT INTO `orders` VALUES (22, 13, 1, 21, 'pending', 51800, 'zxczxczczxczxc', '2020-05-05 14:57:25', '2020-05-05 14:57:25', 'P6PxPlQIE9');
INSERT INTO `orders` VALUES (23, 13, 1, 21, 'pending', 51800, 'zxczxczczxczxc', '2020-05-05 14:58:22', '2020-05-05 14:58:22', 'P6PxPlQIE9');
INSERT INTO `orders` VALUES (24, 13, 1, 21, 'pending', 51800, 'zxczxczczxczxc', '2020-05-05 14:59:09', '2020-05-05 14:59:09', 'P6PxPlQIE9');
INSERT INTO `orders` VALUES (25, 13, 1, 21, 'pending', 51800, 'zxczxczczxczxc', '2020-05-05 15:00:01', '2020-05-05 15:00:01', 'P6PxPlQIE9');
INSERT INTO `orders` VALUES (26, 13, 1, 21, 'pending', 51800, 'zxczxczczxczxc', '2020-05-05 15:00:12', '2020-05-05 15:00:12', 'P6PxPlQIE9');
INSERT INTO `orders` VALUES (27, 13, 1, 21, 'pending', 51800, 'zxczxczczxczxc', '2020-05-05 15:00:34', '2020-05-05 15:00:34', 'P6PxPlQIE9');
INSERT INTO `orders` VALUES (28, 13, 1, 21, 'pending', 53000, 'zxczxczczxczxc', '2020-05-06 09:00:03', '2020-05-06 09:00:03', '');
INSERT INTO `orders` VALUES (29, 7, 6, 1, 'pending', 1200, 'Note', '2020-05-06 09:06:57', '2020-05-06 09:06:57', '');
INSERT INTO `orders` VALUES (30, 13, 1, 21, 'pending', 53000, 'zxczxczczxczxc', '2020-05-06 09:45:07', '2020-05-06 09:45:07', '');
INSERT INTO `orders` VALUES (31, 7, 6, 1, 'pending', 600, 'Note', '2020-05-06 15:03:28', '2020-05-06 15:03:28', '');
INSERT INTO `orders` VALUES (32, 7, 6, 1, 'pending', 360, 'Note', '2020-05-06 15:03:54', '2020-05-06 15:03:54', '');
INSERT INTO `orders` VALUES (33, 15, 15, 1, 'pending', 1920, 'Note', '2020-05-06 23:53:24', '2020-05-06 23:53:24', '');
INSERT INTO `orders` VALUES (34, 15, 15, 1, 'pending', 600, 'Note', '2020-05-07 08:08:33', '2020-05-07 08:08:33', '');
INSERT INTO `orders` VALUES (35, 15, 15, 1, 'pending', 2760, 'Note', '2020-05-07 09:18:45', '2020-05-07 09:18:45', '');
INSERT INTO `orders` VALUES (36, 15, 15, 1, 'pending', 7320, 'Note', '2020-05-07 10:57:20', '2020-05-07 10:57:20', '');
INSERT INTO `orders` VALUES (37, 15, 15, 1, 'pending', 1560, 'Note', '2020-05-07 15:26:23', '2020-05-07 15:26:23', '');
INSERT INTO `orders` VALUES (38, 7, 6, 1, 'pending', 240, 'Note', '2020-05-08 08:44:17', '2020-05-08 08:44:17', '');
INSERT INTO `orders` VALUES (39, 15, 18, 1, 'pending', 7200, 'Note', '2020-05-09 11:14:47', '2020-05-09 11:14:47', '');
INSERT INTO `orders` VALUES (40, 7, 6, 1, 'pending', 1560, 'Note', '2020-05-11 11:06:23', '2020-05-11 11:06:23', '');
INSERT INTO `orders` VALUES (41, 7, 6, 1, 'pending', 6600, 'Note', '2020-05-11 11:07:36', '2020-05-11 11:07:36', '');
INSERT INTO `orders` VALUES (42, 7, 6, 1, 'pending', 1320, 'Note', '2020-05-11 11:15:08', '2020-05-11 11:15:08', '');
INSERT INTO `orders` VALUES (43, 7, 6, 1, 'pending', 1320, 'Note', '2020-05-11 11:15:09', '2020-05-11 11:15:09', '');
INSERT INTO `orders` VALUES (44, 15, 19, 21, 'pending', 1200, 'Note', '2020-05-11 11:47:34', '2020-05-11 11:47:34', '');
INSERT INTO `orders` VALUES (45, 7, 6, 1, 'pending', 120, 'Note', '2020-05-11 14:03:44', '2020-05-11 14:03:44', '');
INSERT INTO `orders` VALUES (46, 7, 6, 21, 'pending', 492, 'Note', '2020-05-15 10:57:58', '2020-05-15 10:57:58', '');
INSERT INTO `orders` VALUES (47, 7, 6, 23, 'pending', 480, 'Note', '2020-05-17 11:51:40', '2020-05-17 11:51:40', '');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for privacy_policies
-- ----------------------------
DROP TABLE IF EXISTS `privacy_policies`;
CREATE TABLE `privacy_policies`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `user_update_id` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of privacy_policies
-- ----------------------------
INSERT INTO `privacy_policies` VALUES (1, '<p><strong>NORMAL TEST</strong></p>\r\n<p>&nbsp;</p>\r\n<p><strong>TEST&nbsp;</strong></p>\r\n<p>&nbsp;</p>\r\n<p><strong>TESTTT</strong></p>', 1, '2020-05-05 12:09:06', '2020-05-05 10:50:18');

-- ----------------------------
-- Table structure for product_images
-- ----------------------------
DROP TABLE IF EXISTS `product_images`;
CREATE TABLE `product_images`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_images
-- ----------------------------
INSERT INTO `product_images` VALUES (1, 30, 'phpesWHIv.jpg', NULL, '2020-05-13 15:48:31', '2020-05-13 15:48:31');
INSERT INTO `product_images` VALUES (2, 31, 'phpMpypCz.webp', NULL, '2020-05-13 15:50:20', '2020-05-13 15:50:20');
INSERT INTO `product_images` VALUES (3, 31, 'phpNdkprq.jpg', '2020-05-14 10:15:20', '2020-05-13 15:50:20', '2020-05-14 10:15:20');
INSERT INTO `product_images` VALUES (4, 31, 'phpym3vgh.png', '2020-05-14 10:15:28', '2020-05-13 15:50:20', '2020-05-14 10:15:28');
INSERT INTO `product_images` VALUES (5, 32, 'phpkBIRYf.jpg', NULL, '2020-05-14 13:47:39', '2020-05-14 13:47:39');
INSERT INTO `product_images` VALUES (6, 33, 'phpWXoIjB.png', NULL, '2020-05-14 13:52:14', '2020-05-14 13:52:14');
INSERT INTO `product_images` VALUES (7, 34, 'php1mEU0N.png', NULL, '2020-05-14 14:14:52', '2020-05-14 14:14:52');
INSERT INTO `product_images` VALUES (8, 35, 'phpJvnBzB.png', NULL, '2020-05-14 14:15:16', '2020-05-14 14:15:16');
INSERT INTO `product_images` VALUES (9, 36, 'phpX1gkEX.png', NULL, '2020-05-14 14:15:59', '2020-05-14 14:15:59');
INSERT INTO `product_images` VALUES (10, 37, 'phpV5wa8T.png', NULL, '2020-05-14 14:16:37', '2020-05-14 14:16:37');
INSERT INTO `product_images` VALUES (11, 38, 'phpCWi6BK.png', NULL, '2020-05-14 14:17:52', '2020-05-14 14:17:52');
INSERT INTO `product_images` VALUES (12, 39, 'phpviYGrJ.png', NULL, '2020-05-14 14:18:05', '2020-05-14 14:18:05');
INSERT INTO `product_images` VALUES (13, 40, 'phpIsGluI.png', NULL, '2020-05-14 14:18:18', '2020-05-14 14:18:18');
INSERT INTO `product_images` VALUES (14, 41, 'phpgXzQKc.jpg', NULL, '2020-05-14 14:24:51', '2020-05-14 14:24:51');

-- ----------------------------
-- Table structure for product_reviews
-- ----------------------------
DROP TABLE IF EXISTS `product_reviews`;
CREATE TABLE `product_reviews`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `mobile_user_id` int(11) NOT NULL,
  `review` double(8, 2) NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_id` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `state` tinyint(4) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_reviews
-- ----------------------------
INSERT INTO `product_reviews` VALUES (1, 8, 1, 5.00, 'bestttt', 21, '2020-05-08 10:19:21', '2020-05-08 10:19:21', 0);
INSERT INTO `product_reviews` VALUES (2, 7, 1, 5.00, 'bestttt', 21, '2020-05-08 10:31:36', '2020-05-08 10:31:36', 0);
INSERT INTO `product_reviews` VALUES (3, 8, 1, 5.00, 'bestttt', 21, '2020-05-08 10:31:39', '2020-05-08 10:31:39', 0);
INSERT INTO `product_reviews` VALUES (4, 4, 1, 5.00, 'bestttt', 21, '2020-05-08 10:32:07', '2020-05-08 10:32:07', 0);
INSERT INTO `product_reviews` VALUES (5, 5, 1, 5.00, 'bestttt', 21, '2020-05-08 10:32:09', '2020-05-08 10:32:09', 0);
INSERT INTO `product_reviews` VALUES (6, 6, 1, 5.00, 'bestttt', 21, '2020-05-08 10:32:12', '2020-05-08 10:32:12', 0);
INSERT INTO `product_reviews` VALUES (7, 6, 1, 1.00, 'bestttt', 21, '2020-05-08 10:32:17', '2020-05-08 10:32:17', 0);
INSERT INTO `product_reviews` VALUES (8, 6, 1, 1.00, 'bad', 21, '2020-05-08 10:32:22', '2020-05-08 10:32:22', 0);
INSERT INTO `product_reviews` VALUES (9, 6, 1, 1.00, 'bad', 21, '2020-05-08 10:52:24', '2020-05-08 10:52:24', 0);

-- ----------------------------
-- Table structure for product_sizes
-- ----------------------------
DROP TABLE IF EXISTS `product_sizes`;
CREATE TABLE `product_sizes`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NULL DEFAULT NULL,
  `size` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `quantity` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `visible` tinyint(4) NULL DEFAULT 1,
  `user_create_id` int(11) NOT NULL,
  `user_update_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_sizes
-- ----------------------------
INSERT INTO `product_sizes` VALUES (1, 40, 'M', '10', '2020-05-14 14:18:18', '2020-05-14 14:18:18', 1, 0, NULL);
INSERT INTO `product_sizes` VALUES (2, 40, 'L', '20', '2020-05-14 14:18:18', '2020-05-14 14:18:18', 1, 0, NULL);
INSERT INTO `product_sizes` VALUES (3, 40, 'S', '60', '2020-05-14 14:18:18', '2020-05-14 14:18:18', 1, 0, NULL);
INSERT INTO `product_sizes` VALUES (4, 41, 'M', '30', '2020-05-14 14:24:51', '2020-05-14 16:23:56', 1, 0, 21);
INSERT INTO `product_sizes` VALUES (5, 5, 'L', '26555', '2020-05-14 14:24:51', '2020-05-14 16:20:12', 1, 0, 21);
INSERT INTO `product_sizes` VALUES (6, 41, 'XLL', '15', '2020-05-14 14:24:51', '2020-05-14 14:24:51', 1, 0, NULL);
INSERT INTO `product_sizes` VALUES (7, 41, 'S', '15', '2020-05-14 16:21:21', '2020-05-14 16:21:21', 1, 21, NULL);

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `quantity` int(11) NULL DEFAULT NULL,
  `price` decimal(8, 2) NOT NULL,
  `visible` tinyint(4) NULL DEFAULT 1,
  `user_create_id` int(11) NOT NULL,
  `user_update_id` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `is_offer` tinyint(4) NULL DEFAULT 0,
  `discount` int(11) NULL DEFAULT NULL,
  `is_specific` enum('yes','no') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 42 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'Parfumlule', 'asdasdasdasdasd', 'php36oAjt.jpg', 8, 21, 11, 1200.00, 0, 21, NULL, '2020-05-13 09:05:58', '2020-05-13 09:05:58', NULL, 1, 20, NULL);
INSERT INTO `products` VALUES (2, 'Parfum', 'sadasdasdasdasd', 'php546Ejl.jpg', 8, 21, 11, 3500.00, 1, 21, NULL, '2020-05-13 09:06:32', '2020-05-13 09:06:32', NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (3, 'Parfum', 'asdasd', 'phphTvKEk.jpg', 8, 21, 10, 120.00, 1, 21, NULL, '2020-05-13 09:06:52', '2020-05-13 09:06:52', NULL, 1, 25, NULL);
INSERT INTO `products` VALUES (4, 'Parfum', 'asdasd', 'phpvnSqfk.jpg', 8, 21, 10, 120.00, 1, 21, NULL, '2020-05-13 10:18:43', '2020-05-13 10:18:43', NULL, 1, 15, NULL);
INSERT INTO `products` VALUES (5, 'Parfum', 'asdasd', 'phpLYpYz7.jpg', 8, 21, 10, 120.00, 1, 21, NULL, '2020-05-13 10:19:04', '2020-05-13 10:19:04', NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (6, 'Parfum', 'asdasd', 'phpphHPX1.jpg', 8, 21, 10, 120.00, 1, 21, NULL, '2020-05-13 10:19:27', '2020-05-13 10:19:27', NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (7, 'Parfum', 'testt', 'phpxbuagb.jpg', 8, 21, 10, 480.00, 1, 21, NULL, '2020-05-13 10:19:52', '2020-05-13 10:19:52', NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (8, 'Parfum', 'asdasdasdasda', 'phpV1irDN.jpg', 8, 21, 1, 1800.00, 1, 21, NULL, '2020-05-13 10:20:13', '2020-05-13 10:20:13', NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (9, 'Body', 'awdadasdadasd', 'phpGitrRN.jpg', 10, 19, 15, 120.00, 1, 19, NULL, '2020-05-13 08:50:17', '2020-05-13 08:50:17', NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (10, 'Body', 'Body Babyboo', 'phpwW4ZGE.jpg', 10, 19, 20, 120.00, 1, 19, NULL, '2020-05-13 08:51:05', '2020-05-13 08:51:05', NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (11, 'Boo', 'BabyBoo', 'php89rJe7.jpg', 10, 19, 10, 120.00, 1, 19, NULL, '2020-05-13 08:51:42', '2020-05-13 08:51:42', NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (12, 'Traditional Indian Cuisine', 'Chakra', 'phpuCeMnp.jpg', 6, 23, 20, 120.00, 1, 23, NULL, '2020-05-13 08:53:59', '2020-05-13 08:53:59', NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (13, 'Traditional Indian Cuisine', 'Asdfgnm', 'phpOCVjyf.jpg', 6, 23, 20, 120.00, 1, 23, NULL, '2020-05-13 08:54:21', '2020-05-13 08:54:21', NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (14, 'Traditional Indian Cuisine', 'ASDFGH', 'phpQ1ZOwi.jpg', 6, 23, 10, 120.00, 1, 23, NULL, '2020-05-13 08:54:48', '2020-05-13 08:54:48', NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (15, 'Traditional Indian Cuisine', 'ASDFGH', 'phpMNQDqQ.jpg', 6, 23, 20, 120.00, 1, 23, NULL, '2020-05-13 08:55:28', '2020-05-13 08:55:28', NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (16, 'Abazhur', 'asdfg', 'phpu9vwJl.jpeg', 12, 30, 10, 120.00, 1, 30, NULL, '2020-05-13 08:57:50', '2020-05-13 08:57:50', NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (17, 'Aparat tensioni', 'asdfgh', 'php5jhBHo.jpg', 12, 30, 20, 120.00, 1, 30, NULL, '2020-05-13 08:58:43', '2020-05-13 08:58:43', NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (18, 'Box', 'qwerty', 'phpv6uqco.jpg', 12, 30, 20, 120.00, 1, 30, NULL, '2020-05-13 08:59:08', '2020-05-13 08:59:08', NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (19, 'Katering', 'asdfgh', 'php6jRUV5.jpg', 6, 27, 20, 120.00, 1, 27, NULL, '2020-05-13 09:00:44', '2020-05-13 09:00:44', NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (20, 'Katering', 'sdfgh', 'phpeR99IT.jpg', 6, 27, 20, 120.00, 1, 27, NULL, '2020-05-13 09:01:06', '2020-05-13 09:01:06', NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (21, 'Katering', 'sdf', 'phpT4s97T.jpg', 6, 27, 20, 120.00, 1, 27, NULL, '2020-05-13 09:01:31', '2020-05-13 09:01:31', NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (22, 'Pizza', 'ADSF', 'phpBR1yg4.jpg', 6, 29, 20, 120.00, 1, 29, NULL, '2020-05-13 09:09:14', '2020-05-13 09:09:14', NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (23, 'Pizza', 'sdfgh', 'phpwgBgGF.jpg', 6, 29, 20, 120.00, 1, 29, NULL, '2020-05-13 09:09:35', '2020-05-13 09:09:35', NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (24, 'Pizza', 'asdfgyhj', 'phpP42ve5.jpg', 6, 29, 20, 120.00, 1, 29, NULL, '2020-05-13 09:09:58', '2020-05-13 09:09:58', NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (25, 'Syze optike', 'ehdfgh', 'phpl02Qau.jpg', 7, 22, 20, 120.00, 1, 22, NULL, '2020-05-13 10:14:29', '2020-05-13 10:14:29', NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (26, 'Syze dielli', 'dftghjk', 'phpQTgOvI.jpg', 7, 22, 20, 120.00, 1, 22, NULL, '2020-05-13 10:15:01', '2020-05-13 10:15:01', NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (27, 'Syze optike', 'wertyui', 'phpLFFUUP.jpg', 7, 22, 20, 120.00, 1, 22, NULL, '2020-05-13 10:15:30', '2020-05-13 10:15:30', NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (28, 'Syze optike', 'ytyghjkl', 'phpMUiwlQ.jpg', 7, 22, 20, 120.00, 1, 22, NULL, '2020-05-13 10:15:56', '2020-05-13 10:15:56', NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (29, 'Syze dielli', 'qsedfgh', 'phpbbN7T6.png', 7, 22, 10, 120.00, 1, 22, NULL, '2020-05-13 10:16:28', '2020-05-13 10:16:29', NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (30, 'Testt', 'testinggg', 'phpesWHIv.jpg', 8, 21, 10, 120.00, 1, 21, NULL, '2020-05-13 15:48:31', '2020-05-13 15:48:31', NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (31, 'Test', 'sadsadasd', 'phpxs4sNI.png', 12, 21, 10, 120.00, 1, 21, NULL, '2020-05-13 15:50:20', '2020-05-13 15:50:20', NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (32, 'test', 'asdasdasdasd', 'phpY4XAm4.jpg', 8, 21, 10, 120.00, 1, 21, NULL, '2020-05-14 13:47:39', '2020-05-14 13:47:39', NULL, 0, NULL, NULL);
INSERT INTO `products` VALUES (33, 'asdsd', 'asdsadasdasd', 'phpmfO11J.jpg', 8, 21, 100, 120.00, 1, 21, NULL, '2020-05-14 13:52:14', '2020-05-14 13:52:14', NULL, 0, NULL, 'no');
INSERT INTO `products` VALUES (41, 'testinggg sizee', 'asdasdasdasdasdasd', 'phphabCKx.jpg', 10, 21, 1, 156.00, 1, 21, NULL, '2020-05-14 14:52:06', '2020-05-14 14:52:06', NULL, 0, NULL, 'yes');

-- ----------------------------
-- Table structure for push_individuals
-- ----------------------------
DROP TABLE IF EXISTS `push_individuals`;
CREATE TABLE `push_individuals`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_user_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of push_individuals
-- ----------------------------
INSERT INTO `push_individuals` VALUES (1, 'test', 'asdfgdfdsfsdff', 1, '2020-04-20 13:01:16', '2020-04-20 13:01:16');
INSERT INTO `push_individuals` VALUES (2, 'test', 'asdasdasd', 2, '2020-04-20 15:00:37', '2020-04-20 15:00:37');
INSERT INTO `push_individuals` VALUES (3, 'sdfsd', 'sdfsdfsdfsdf', 2, '2020-04-20 15:00:58', '2020-04-20 15:00:58');

-- ----------------------------
-- Table structure for push_notifications
-- ----------------------------
DROP TABLE IF EXISTS `push_notifications`;
CREATE TABLE `push_notifications`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of push_notifications
-- ----------------------------
INSERT INTO `push_notifications` VALUES (1, 'test', 'asdasdasd', '2020-04-20 14:35:34', '2020-04-20 14:35:34');
INSERT INTO `push_notifications` VALUES (2, 'test', 'asdasdasd', '2020-04-20 14:36:36', '2020-04-20 14:36:36');

-- ----------------------------
-- Table structure for reviews
-- ----------------------------
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `business_id` int(11) NOT NULL,
  `mobile_user_id` int(11) NOT NULL,
  `review` double(8, 2) NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `state` tinyint(4) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of reviews
-- ----------------------------
INSERT INTO `reviews` VALUES (1, 21, 1, 3.00, 'The best restaurant in the town!!!', '2020-04-28 14:14:41', '2020-05-15 12:03:35', 1);
INSERT INTO `reviews` VALUES (2, 21, 1, 5.00, 'The best restaurant in the town!!!', '2020-04-28 14:15:30', '2020-05-15 12:03:35', 1);
INSERT INTO `reviews` VALUES (3, 21, 1, 4.00, 'The best restaurant in the town!!!', '2020-04-28 14:15:32', '2020-05-15 12:03:35', 1);
INSERT INTO `reviews` VALUES (4, 21, 1, 5.00, 'The best restaurant in the town!!!', '2020-04-30 11:22:07', '2020-05-15 12:03:35', 1);
INSERT INTO `reviews` VALUES (5, 21, 7, 2.00, 'gfygff', '2020-04-30 12:31:09', '2020-05-15 12:03:35', 1);
INSERT INTO `reviews` VALUES (6, 21, 7, 3.00, 'chxyyxxyx', '2020-04-30 12:33:42', '2020-05-15 12:03:35', 1);
INSERT INTO `reviews` VALUES (7, 21, 7, 3.00, 'uuf', '2020-04-30 13:32:07', '2020-05-15 12:03:35', 1);
INSERT INTO `reviews` VALUES (8, 21, 1, 5.00, 'The best restaurant in the town!!!', '2020-04-30 13:35:55', '2020-05-15 12:03:35', 1);
INSERT INTO `reviews` VALUES (9, 21, 1, 5.50, 'The best restaurant in the town!!!', '2020-04-30 13:36:01', '2020-05-15 12:03:35', 1);
INSERT INTO `reviews` VALUES (10, 21, 1, 5.00, 'The best restaurant in the town!!!', '2020-04-30 13:37:30', '2020-05-15 12:03:35', 1);
INSERT INTO `reviews` VALUES (11, 21, 1, 5.00, 'The best restaurant in the town!!!', '2020-04-30 13:37:36', '2020-05-15 12:03:35', 1);
INSERT INTO `reviews` VALUES (12, 21, 7, 4.00, 'jccj', '2020-04-30 13:38:12', '2020-05-15 12:03:35', 1);
INSERT INTO `reviews` VALUES (13, 21, 1, 5.00, 'The best restaurant in the town!!!', '2020-04-30 15:49:56', '2020-05-15 12:03:35', 1);
INSERT INTO `reviews` VALUES (14, 21, 1, 5.00, 'The best restaurant in the town!!!', '2020-04-30 16:00:06', '2020-05-15 12:03:35', 1);
INSERT INTO `reviews` VALUES (15, 21, 1, 5.00, 'The best restaurant in the town!!!', '2020-04-30 16:00:19', '2020-05-15 12:03:35', 1);
INSERT INTO `reviews` VALUES (16, 21, 1, 5.00, 'The best restaurant in the town!!!', '2020-04-30 16:00:20', '2020-05-15 12:03:35', 1);
INSERT INTO `reviews` VALUES (17, 23, 7, 2.00, 'fgcgbg', '2020-05-01 08:57:36', '2020-05-01 08:57:36', 0);
INSERT INTO `reviews` VALUES (18, 21, 7, 5.00, 'hdhhdhhdd', '2020-05-05 09:14:35', '2020-05-15 12:03:35', 1);
INSERT INTO `reviews` VALUES (19, 21, 7, 3.00, 'rated', '2020-05-06 13:12:11', '2020-05-15 12:03:35', 1);
INSERT INTO `reviews` VALUES (20, 30, 7, 3.00, 'hcchhc', '2020-05-06 14:14:57', '2020-05-06 14:14:57', 0);
INSERT INTO `reviews` VALUES (21, 21, 7, 5.00, 'the best one', '2020-05-06 15:10:41', '2020-05-15 12:03:35', 1);
INSERT INTO `reviews` VALUES (22, 28, 15, 5.00, 'best', '2020-05-07 08:05:44', '2020-05-07 08:05:44', 0);
INSERT INTO `reviews` VALUES (23, 31, 15, 5.00, 'best', '2020-05-07 08:06:42', '2020-05-07 11:16:13', 1);
INSERT INTO `reviews` VALUES (24, 22, 7, 4.00, 'viigufuc', '2020-05-07 10:32:48', '2020-05-07 10:32:48', 0);
INSERT INTO `reviews` VALUES (25, 19, 7, 3.00, 'gcxggxgx', '2020-05-07 10:33:19', '2020-05-11 15:11:57', 1);
INSERT INTO `reviews` VALUES (26, 20, 7, 3.00, 'ufyfydzy', '2020-05-07 10:33:51', '2020-05-07 10:33:51', 0);
INSERT INTO `reviews` VALUES (27, 21, 15, 4.00, 'erion', '2020-05-07 10:56:30', '2020-05-15 12:03:35', 1);
INSERT INTO `reviews` VALUES (28, 21, 1, 5.50, 'The best restaurant in the town!!!', '2020-05-08 10:51:20', '2020-05-15 12:03:35', 1);
INSERT INTO `reviews` VALUES (29, 21, 1, 5.50, 'The best restaurant in the town!!!', '2020-05-08 10:52:10', '2020-05-15 12:03:35', 1);
INSERT INTO `reviews` VALUES (30, 21, 7, 3.00, 'hxyx', '2020-05-11 08:21:45', '2020-05-15 12:03:35', 1);
INSERT INTO `reviews` VALUES (31, 30, 7, 3.00, 'uvufufy', '2020-05-13 09:17:11', '2020-05-13 09:17:11', 0);

-- ----------------------------
-- Table structure for used_coupons
-- ----------------------------
DROP TABLE IF EXISTS `used_coupons`;
CREATE TABLE `used_coupons`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NULL DEFAULT NULL,
  `coupon_id` int(11) NULL DEFAULT NULL,
  `mobile_user_id` int(11) NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of used_coupons
-- ----------------------------
INSERT INTO `used_coupons` VALUES (1, 22, 1, 13, 'P6PxPlQIE9', '2020-05-05 14:57:25', '2020-05-05 14:57:25');
INSERT INTO `used_coupons` VALUES (2, 22, 1, 13, 'P6PxPlQIE9', '2020-05-05 14:57:25', '2020-05-05 14:57:25');
INSERT INTO `used_coupons` VALUES (3, 23, 1, 13, 'P6PxPlQIE9', '2020-05-05 14:58:22', '2020-05-05 14:58:22');
INSERT INTO `used_coupons` VALUES (4, 23, 1, 13, 'P6PxPlQIE9', '2020-05-05 14:58:23', '2020-05-05 14:58:23');
INSERT INTO `used_coupons` VALUES (5, 26, 1, 13, 'P6PxPlQIE9', '2020-05-05 15:00:12', '2020-05-05 15:00:12');
INSERT INTO `used_coupons` VALUES (6, 26, 1, 13, 'P6PxPlQIE9', '2020-05-05 15:00:12', '2020-05-05 15:00:12');
INSERT INTO `used_coupons` VALUES (7, 27, 1, 13, 'P6PxPlQIE9', '2020-05-05 15:00:34', '2020-05-05 15:00:34');
INSERT INTO `used_coupons` VALUES (8, 27, 1, 13, 'P6PxPlQIE9', '2020-05-05 15:00:34', '2020-05-05 15:00:34');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_create_id` bigint(20) NULL DEFAULT NULL,
  `user_update_id` bigint(20) NULL DEFAULT NULL,
  `role` enum('1','2','3','4','5') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `status` tinyint(1) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE,
  INDEX `users_role_index`(`role`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Erion', 'Cuni', 'erion@gmail.com', NULL, '$2y$10$U.voZWTSmEACORdcWMGdw.ECAj2sjMVCVyvley.4eAHrmJ885Ny0.', '06900000', NULL, NULL, '2', NULL, NULL, '2020-03-09 13:24:12', '2020-03-10 13:13:45', 1);
INSERT INTO `users` VALUES (2, 'Ledja', 'M', 'ledja@gmail.com', NULL, '$2y$10$U.voZWTSmEACORdcWMGdw.ECAj2sjMVCVyvley.4eAHrmJ885Ny0.', '0682440444', 1, NULL, '2', NULL, NULL, '2020-04-07 09:42:47', '2020-04-07 09:42:47', 1);
INSERT INTO `users` VALUES (3, 'Test', 'Test', 'ledja.almotech@gmail.com', NULL, '$2y$10$FwXgT5HEEXeOf0Dx04J.qerPQR.9M29Q.V2AYw/EM/us9XOXM62M.', '0690000056656', 1, NULL, '3', '2020-03-25 13:08:57', NULL, '2020-03-11 16:14:17', '2020-03-25 13:08:57', 1);
INSERT INTO `users` VALUES (4, 'Test', 'Test2', 'ledja.almotech123@gmail.com', NULL, '$2y$10$H5716bnif8Q32LOnne3jK.WozqA3Xxd.Dr4tgJ/Qnw.jMztFUJu8i', '069000007894', 1, NULL, '4', '2020-03-25 13:08:49', NULL, '2020-03-11 16:30:48', '2020-03-25 13:08:49', 1);
INSERT INTO `users` VALUES (5, 'Adela', 'Test3', 'test3@gmail.com', NULL, '$2y$10$VMHrxDCkefrkSAK0zESAn.pk966cpc0fnksRiJs1oYEApwapBSS7C', '06820000000', 2, NULL, '3', '2020-03-25 13:09:43', NULL, '2020-03-25 12:49:02', '2020-03-25 13:09:43', 1);
INSERT INTO `users` VALUES (15, 'Ledja', 'L', 'ledjam@yahoo.com', NULL, '$2y$10$xlAJgzdGMf7DCN2ISOgVhuATbqlA0ZzU8CEtd2hbw3HxfPUMO1lMW', '0682440444', 1, NULL, '5', NULL, NULL, '2020-04-07 14:57:18', '2020-04-07 14:57:18', 1);
INSERT INTO `users` VALUES (16, 'Ledja', 'L', 'ledjam123s@yahoo.com', NULL, '$2y$10$m5oZctN.rknvGws.4gmsiewzGQ9eGgMBS0iKvLmNrNWQVQW9NlQoG', '0682440444', 1, NULL, '5', NULL, NULL, '2020-04-07 14:59:43', '2020-04-07 14:59:43', 1);
INSERT INTO `users` VALUES (17, 'Ledja', 'L', 'ledjam234@yahoo.com', NULL, '$2y$10$e2.RnrNJtxvuk9kJ8IMfSOnuuhf5YIUGi3dcW0nteF95dM.0NwIU6', '0682440444', 1, NULL, '5', NULL, NULL, '2020-04-07 15:00:34', '2020-04-07 15:00:34', 1);
INSERT INTO `users` VALUES (18, 'Ledja', 'Admin', 'admin@gmail.com', NULL, '$2y$10$8kylhzXkB9rvMWn2ZCSBo.dqsfrTZ8W3I.KiUWJBA6fi22YoJ63WK', '0682440445ssss', 1, NULL, '5', '2020-04-08 12:20:10', NULL, '2020-04-07 19:16:01', '2020-04-08 12:20:10', 1);
INSERT INTO `users` VALUES (19, 'GiftShop', 'TESTTT', 'babyboo@gmail.com', NULL, '$2y$10$EQ/Oh4QWDI8iWswF7rnQJeosevCjZsmol/WXUjGMuoFcd4KgmDrfe', '068000000', 1, 2, '5', NULL, NULL, '2020-05-12 14:41:33', '2020-05-12 14:41:33', 1);
INSERT INTO `users` VALUES (20, 'The Flower', 'The Flower', 'theflower@gmail.com', NULL, '$2y$10$y1OPDLYGv.eDdiqCb1pPaOovBY23GmnPYAI3WHxs296lXpKAbHiRO', '0682440444', 1, 2, '5', NULL, NULL, '2020-05-12 14:53:11', '2020-05-12 14:53:11', 1);
INSERT INTO `users` VALUES (21, 'Maison', 'test', 'test1@gmail.com', NULL, '$2y$10$kdjS4.b360A8Uy4KZjUfhO7d7XAzOEnT1TL9Lo//Qyek6ilDcEuwa', '0682440444', 2, 2, '5', NULL, NULL, '2020-05-12 14:47:36', '2020-05-12 14:47:36', 1);
INSERT INTO `users` VALUES (22, 'Optika ', 'Luani', 'optikaluani@email.co', NULL, '$2y$10$8ohpVgfXvtC3tNaOX6FZzOjIPqMRllC5XqxDCIDvA1nhOedK2Aq9.', '06824404555', 2, 2, '5', NULL, NULL, '2020-05-12 14:50:01', '2020-05-12 14:50:01', 1);
INSERT INTO `users` VALUES (23, 'chakra', 'jone', 'chakra@yahoo.com', NULL, '$2y$10$ZbppqlpTH4brCj.xayvzFeoTljN2djD1OERfCFos1IKGW/PuZ5Kfy', '068244044', 2, 2, '5', NULL, NULL, '2020-05-12 14:42:44', '2020-05-12 14:42:44', 1);
INSERT INTO `users` VALUES (24, 'Pink Flower', 'Flower', 'pinkflower@yahoo.com', NULL, '$2y$10$yR8nub9NIWjdZ5KHteCVtudB658FZ6x/4mhZUbsOjm6P2kEHvExty', '0682440444', 2, 2, '5', NULL, NULL, '2020-05-12 14:52:52', '2020-05-12 14:52:52', 1);
INSERT INTO `users` VALUES (27, 'Katering Family', 'Katering Family', 'katering@asd.com', NULL, '$2y$10$oYc9s5zfVpobXcDDnRsH9.97TewSzIQnlK53J9PfQ2OcOuH5q39aW', '0682440444', 2, 2, '5', NULL, NULL, '2020-05-12 14:45:21', '2020-05-12 14:45:21', 1);
INSERT INTO `users` VALUES (28, 'Millenium', 'Millenium', 'millenium@yahoo.com', NULL, '$2y$10$3UKknXwpO99LZFuxFca6tOdk.IkfkrC9VeozSmAhN/.C1noXu2sia', '0694489809', 2, 2, '5', NULL, NULL, '2020-05-12 14:48:37', '2020-05-12 14:48:37', 1);
INSERT INTO `users` VALUES (29, 'Opium Sushi', 'Opium Sushi', 'opium@gmail.com', NULL, '$2y$10$.l9FE3lFwEQPcwrz8FJbv.vOTEcjAL/fcRwh0isbXIu6H.B/7aigO', '0682440445', 2, 2, '5', NULL, NULL, '2020-05-12 14:49:20', '2020-05-12 14:49:20', 1);
INSERT INTO `users` VALUES (30, 'iShpejti', 'iShpejti', 'ishpejti@gmail.com', NULL, '$2y$10$gkjtyKLjR11ISCfrcdTNKOlH5HgqRP38KY7OdxVCkyUHEmVmxlYMe', '06824404555', 2, 2, '5', NULL, NULL, '2020-05-12 14:43:19', '2020-05-12 14:43:19', 1);
INSERT INTO `users` VALUES (31, 'Le petit flower', 'Le petit flower', 'lepetitflower@gmail.com', NULL, '$2y$10$VSy32a45FTdsfdFbPFVrP.rzPWrnCtZqsmc83PrTII83J4FiAWreq', '0692463979', 2, 2, '5', NULL, NULL, '2020-05-12 14:46:50', '2020-05-12 14:46:50', 1);

SET FOREIGN_KEY_CHECKS = 1;
