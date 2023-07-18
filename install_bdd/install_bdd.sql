/*
 Navicat Premium Data Transfer

 Source Server         : Virtual Shiva
 Source Server Type    : MariaDB
 Source Server Version : 100519
 Source Host           : localhost:3306
 Source Schema         : sp_dw_1223

 Target Server Type    : MariaDB
 Target Server Version : 100519
 File Encoding         : 65001

 Date: 17/07/2023 13:59:05
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for t_langue
-- ----------------------------
DROP TABLE IF EXISTS `t_langue`;
CREATE TABLE `t_langue`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_langue
-- ----------------------------
INSERT INTO `t_langue` VALUES (1, 'Francais', 'fr.png');
INSERT INTO `t_langue` VALUES (2, 'Anglais', 'uk.png');
INSERT INTO `t_langue` VALUES (3, 'Créole', 'creo.png');

-- ----------------------------
-- Table structure for t_menu
-- ----------------------------
DROP TABLE IF EXISTS `t_menu`;
CREATE TABLE `t_menu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `ordre` int(11) NULL DEFAULT NULL,
  `fk_parent` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_menu
-- ----------------------------
INSERT INTO `t_menu` VALUES (1, 'index.php', 1, 0);
INSERT INTO `t_menu` VALUES (2, 'index.php?page=voyage', 2, 0);
INSERT INTO `t_menu` VALUES (3, 'index.php?page=boutique', 3, 0);
INSERT INTO `t_menu` VALUES (4, 'index.php?page=australie', 1, 2);
INSERT INTO `t_menu` VALUES (5, 'index.php?page=nz', 2, 2);
INSERT INTO `t_menu` VALUES (6, 'index.php?page=indo', 3, 2);

-- ----------------------------
-- Table structure for t_menu_trad
-- ----------------------------
DROP TABLE IF EXISTS `t_menu_trad`;
CREATE TABLE `t_menu_trad`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_menu` int(11) NULL DEFAULT NULL,
  `fk_langue` int(11) NULL DEFAULT NULL,
  `libelle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_menu_trad
-- ----------------------------
INSERT INTO `t_menu_trad` VALUES (1, 1, 1, 'Accueil');
INSERT INTO `t_menu_trad` VALUES (2, 1, 2, 'Home');
INSERT INTO `t_menu_trad` VALUES (3, 1, 3, 'Case ?');
INSERT INTO `t_menu_trad` VALUES (4, 2, 1, 'Voyages');
INSERT INTO `t_menu_trad` VALUES (5, 2, 2, 'Travel');
INSERT INTO `t_menu_trad` VALUES (6, 2, 3, 'Voyage en Creole');
INSERT INTO `t_menu_trad` VALUES (7, 3, 1, 'Boutique');
INSERT INTO `t_menu_trad` VALUES (8, 3, 2, 'Shop');
INSERT INTO `t_menu_trad` VALUES (9, 3, 3, 'Boutique en Creole');
INSERT INTO `t_menu_trad` VALUES (10, 4, 1, 'Australie');
INSERT INTO `t_menu_trad` VALUES (11, 4, 2, 'Australia');
INSERT INTO `t_menu_trad` VALUES (12, 4, 3, 'Australie en Creole');
INSERT INTO `t_menu_trad` VALUES (13, 5, 1, 'Nouvelle Zelande');
INSERT INTO `t_menu_trad` VALUES (14, 5, 2, 'New Zeland');
INSERT INTO `t_menu_trad` VALUES (15, 5, 3, 'Nouvelle Zelande en Creole');
INSERT INTO `t_menu_trad` VALUES (16, 6, 1, 'Indonesie');
INSERT INTO `t_menu_trad` VALUES (17, 6, 2, 'Indonisia');
INSERT INTO `t_menu_trad` VALUES (18, 6, 3, 'Indonésie en Creole');

-- ----------------------------
-- Table structure for t_pays
-- ----------------------------
DROP TABLE IF EXISTS `t_pays`;
CREATE TABLE `t_pays`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_pays
-- ----------------------------
INSERT INTO `t_pays` VALUES (1, 'France');
INSERT INTO `t_pays` VALUES (2, 'USA');
INSERT INTO `t_pays` VALUES (3, 'Russie');
INSERT INTO `t_pays` VALUES (4, 'Angleterre');
INSERT INTO `t_pays` VALUES (5, 'Australie');
INSERT INTO `t_pays` VALUES (6, 'New Zeland');

-- ----------------------------
-- Table structure for t_photo
-- ----------------------------
DROP TABLE IF EXISTS `t_photo`;
CREATE TABLE `t_photo`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photographie` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `titre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ordre` int(11) NULL DEFAULT NULL,
  `fk_user` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_photo
-- ----------------------------
INSERT INTO `t_photo` VALUES (1, 'photo1.jpg', 'Titre Photo 1', 'Description Photo 1', 1, 1);
INSERT INTO `t_photo` VALUES (2, 'photo2.jpg', 'Titre Photo 2', 'Description Photo 2', 2, 1);
INSERT INTO `t_photo` VALUES (3, 'photo3.jpg', 'Titre Photo 3', 'Description Photo 3', 3, 1);
INSERT INTO `t_photo` VALUES (4, 'photo4.jpg', 'Titre Photo 4', 'Description Photo 4', 4, 1);
INSERT INTO `t_photo` VALUES (5, 'photo5.jpg', 'Titre Photo 5', 'Description Photo 5', 5, 1);
INSERT INTO `t_photo` VALUES (6, 'photo6.jpg', 'Titre Photo 6', 'Description Photo 6', 6, 2);
INSERT INTO `t_photo` VALUES (7, 'photo7.jpg', 'Titre Photo 7', 'Description Photo 7', 7, 2);
INSERT INTO `t_photo` VALUES (8, 'photo8.jpg', 'Titre Photo 8', 'Description Photo 8', 8, 2);
INSERT INTO `t_photo` VALUES (9, 'photo9.jpg', 'Titre Photo 9', 'Description Photo 9', 9, 2);
INSERT INTO `t_photo` VALUES (10, 'photo10jpg', 'Titre Photo 10', 'Description Photo 10', 10, 2);

-- ----------------------------
-- Table structure for t_user
-- ----------------------------
DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `prenom` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `adresse_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `adresse_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `cp` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `fk_ville` int(11) NULL DEFAULT NULL,
  `fk_pays` int(11) NULL DEFAULT NULL,
  `login` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_user
-- ----------------------------
INSERT INTO `t_user` VALUES (1, 'THIBAULT', 'Christophe', 'Une super rue', 'Ravine des Cabris', '97423', 10, 1, 'admin', 'PASSWORD_01', 'avatar_01.png');
INSERT INTO `t_user` VALUES (2, 'Utilisateur 1', 'Prénom', 'Une super rue', 'Ravine des Cabris', '97432', 10, 1, 'tao', 'password_02', 'avatar_02.png');

-- ----------------------------
-- Table structure for t_ville
-- ----------------------------
DROP TABLE IF EXISTS `t_ville`;
CREATE TABLE `t_ville`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_ville
-- ----------------------------
INSERT INTO `t_ville` VALUES (1, 'St-Pierre');
INSERT INTO `t_ville` VALUES (2, 'Saint Denis');
INSERT INTO `t_ville` VALUES (3, 'Saint Louis');
INSERT INTO `t_ville` VALUES (4, 'Saint Joseph');
INSERT INTO `t_ville` VALUES (5, 'Sainte Rose');
INSERT INTO `t_ville` VALUES (6, 'Saint Benoit');
INSERT INTO `t_ville` VALUES (7, 'Saint André');
INSERT INTO `t_ville` VALUES (8, 'Sainte Marie');

SET FOREIGN_KEY_CHECKS = 1;
