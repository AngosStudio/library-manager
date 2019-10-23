/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100138
 Source Host           : localhost:3306
 Source Schema         : lib

 Target Server Type    : MySQL
 Target Server Version : 100138
 File Encoding         : 65001

 Date: 23/10/2019 14:23:28
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for lb__genres
-- ----------------------------
DROP TABLE IF EXISTS `lb__genres`;
CREATE TABLE `lb__genres`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_created` datetime(0) NULL DEFAULT NULL,
  `date_updated` datetime(0) NULL DEFAULT NULL,
  `date_deleted` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of lb__genres
-- ----------------------------
INSERT INTO `lb__genres` VALUES (1, 'Action and Adventure', NULL, NULL, NULL);
INSERT INTO `lb__genres` VALUES (2, 'Anthology', NULL, NULL, NULL);
INSERT INTO `lb__genres` VALUES (3, 'Classic', NULL, NULL, NULL);
INSERT INTO `lb__genres` VALUES (4, 'Comic and Graphic Novel', NULL, NULL, NULL);
INSERT INTO `lb__genres` VALUES (5, 'Crime and Detective', NULL, NULL, NULL);
INSERT INTO `lb__genres` VALUES (6, 'Drama', NULL, NULL, NULL);
INSERT INTO `lb__genres` VALUES (7, 'Fable', NULL, NULL, NULL);
INSERT INTO `lb__genres` VALUES (8, 'Fairy Tale', NULL, NULL, NULL);
INSERT INTO `lb__genres` VALUES (9, 'Fan-Fiction', NULL, NULL, NULL);
INSERT INTO `lb__genres` VALUES (10, 'Fantasy', NULL, NULL, NULL);
INSERT INTO `lb__genres` VALUES (11, 'Historical Fiction', NULL, NULL, NULL);
INSERT INTO `lb__genres` VALUES (12, 'Horror', NULL, NULL, NULL);
INSERT INTO `lb__genres` VALUES (13, 'Humor', NULL, NULL, NULL);
INSERT INTO `lb__genres` VALUES (14, 'Legend', NULL, NULL, NULL);
INSERT INTO `lb__genres` VALUES (15, 'Magical Realism', NULL, NULL, NULL);
INSERT INTO `lb__genres` VALUES (16, 'Mystery', NULL, NULL, NULL);
INSERT INTO `lb__genres` VALUES (17, 'Mythology', NULL, NULL, NULL);
INSERT INTO `lb__genres` VALUES (18, 'Realistic Fiction', NULL, NULL, NULL);
INSERT INTO `lb__genres` VALUES (19, 'Romance', NULL, NULL, NULL);
INSERT INTO `lb__genres` VALUES (20, 'Satire', NULL, NULL, NULL);
INSERT INTO `lb__genres` VALUES (21, 'Science Fiction (Sci-Fi)', NULL, NULL, NULL);
INSERT INTO `lb__genres` VALUES (22, 'Short Story', NULL, NULL, NULL);
INSERT INTO `lb__genres` VALUES (23, 'Suspense/Thriller', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for lb_books
-- ----------------------------
DROP TABLE IF EXISTS `lb_books`;
CREATE TABLE `lb_books`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_genre` int(11) NULL DEFAULT NULL,
  `name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `date_created` datetime(0) NULL DEFAULT NULL,
  `date_updated` datetime(0) NULL DEFAULT NULL,
  `date_deleted` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_genre`(`id_genre`) USING BTREE,
  CONSTRAINT `lb_books_ibfk_1` FOREIGN KEY (`id_genre`) REFERENCES `lb__genres` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of lb_books
-- ----------------------------
INSERT INTO `lb_books` VALUES (1, 2, 'Teste 1', NULL, '2019-10-23 10:52:38', '2019-10-23 10:54:15', '2019-10-23 10:54:15');
INSERT INTO `lb_books` VALUES (4, 5, 'Teste 3', 'Sed consectetur lectus nec justo maximus, ut varius dolor mollis. Quisque consequat odio ante, et vulputate ex tempus cursus. Quisque elementum blandit urna, sit amet tincidunt neque scelerisque quis. Maecenas in bibendum metus, et condimentum elit. Fusce turpis dolor, fermentum eu lobortis sed, hendrerit a sapien. Phasellus convallis lorem eget justo accumsan porta venenatis vitae mauris. Proin auctor suscipit lorem, a egestas mi facilisis sit amet. Donec mattis, nisl sed placerat dapibus, lacus elit tincidunt nibh, non bibendum velit ligula eu lacus.', '2019-10-23 11:04:32', NULL, NULL);
INSERT INTO `lb_books` VALUES (5, 10, 'Teste 2', 'Fusce vitae cursus augue, vitae bibendum orci. Quisque commodo consectetur purus, vel porta sem posuere et. Ut consectetur posuere ultricies. Phasellus non fermentum nisi, quis vehicula massa. Sed sit amet felis arcu. Cras eleifend neque velit. Fusce sed nibh placerat, consectetur nunc non, efficitur nulla. Sed vel euismod diam. Cras vel sagittis metus. Sed at congue sapien, vel malesuada elit.', '2019-10-23 11:04:56', '2019-10-23 12:44:40', '2019-10-23 12:44:40');
INSERT INTO `lb_books` VALUES (6, 11, 'Teste 5', 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse convallis rutrum est ut laoreet. Quisque hendrerit ornare consequat. Nam non nunc imperdiet, hendrerit sem vitae, aliquet nisi. Nam eget hendrerit nunc. Maecenas vel turpis mi. Nullam porta nibh eu justo bibendum sodales. Proin faucibus ultrices ullamcorper. Donec ultrices ac lectus eget iaculis.', '2019-10-23 12:00:54', '2019-10-23 12:02:19', NULL);
INSERT INTO `lb_books` VALUES (7, 2, 'asasas', 'asasas', '2019-10-23 12:45:50', NULL, NULL);
INSERT INTO `lb_books` VALUES (8, 10, 'asas', 'asas', '2019-10-23 12:46:22', NULL, NULL);
INSERT INTO `lb_books` VALUES (9, 3, 'asasas', 'asasas', '2019-10-23 12:46:43', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
