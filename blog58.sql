/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : blog58

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2020-01-14 10:54:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin_log
-- ----------------------------
DROP TABLE IF EXISTS `admin_log`;
CREATE TABLE `admin_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1',
  `content` text COLLATE utf8mb4_unicode_ci,
  `ip` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `time` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_log
-- ----------------------------
INSERT INTO `admin_log` VALUES ('1', 'admin01', '1', '管理员登陆', '127.0.0.1', '1578899063');
INSERT INTO `admin_log` VALUES ('2', 'admin01', '1', '管理员登陆', '127.0.0.1', '1578899272');
INSERT INTO `admin_log` VALUES ('3', 'admin01', '1', '编辑了id为18的规则，数据：1', '127.0.0.1', '1578899541');
INSERT INTO `admin_log` VALUES ('4', 'admin01', '1', '编辑了id为18的规则，数据：0', '127.0.0.1', '1578899543');
INSERT INTO `admin_log` VALUES ('5', 'admin01', '1', '退出了管理系统', '127.0.0.1', '1578903886');
INSERT INTO `admin_log` VALUES ('6', 'admin', '1', '管理员登陆', '127.0.0.1', '1578903891');
INSERT INTO `admin_log` VALUES ('7', 'admin', '1', '退出了管理系统', '127.0.0.1', '1578903905');
INSERT INTO `admin_log` VALUES ('8', 'admin01', '1', '管理员登陆', '127.0.0.1', '1578903910');
INSERT INTO `admin_log` VALUES ('9', 'admin', '1', '管理员登陆', '127.0.0.1', '1578965491');

-- ----------------------------
-- Table structure for admin_user
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_ip` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `rule_id` tinyint(4) NOT NULL DEFAULT '0',
  `state` tinyint(4) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_time` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `update_time` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_user
-- ----------------------------
INSERT INTO `admin_user` VALUES ('1', 'admin', '99999@qq.com', null, 'eyJpdiI6InFhbjE2MDdwOENrTGliVXF0RzE5V3c9PSIsInZhbHVlIjoiVjkycHhPQ2krUHI4aFIzTDcwWXJTdz09IiwibWFjIjoiYzJjMjM2YTRhYTEyNDA3MTE1MDFmMTFkZmQ1N2Q5NDEwYmE2MmJlZmI2NjQwYWJiZjJmNjMzMmNiM2FiMzI0NCJ9', '127.0.0.1', '1', '0', '5e182c65e3492', '1578552878', '1578965491');
INSERT INTO `admin_user` VALUES ('5', 'admin01', '8888@qq.com', null, 'eyJpdiI6IktNaG1DSlhIbjYxT3ZwNHVxdmNuT1E9PSIsInZhbHVlIjoiTDhLSXJxUWRpOFdpdVlhN2pRR0Jtdz09IiwibWFjIjoiYzNkODExOGE4NmMzODllYjVjYTJiM2M0NjVkODQ3NDQ3ZWQ1MGNlOTkxMDQ1NzU0ODY1NTlmZTEyYzNkZDMyMSJ9', '0', '3', '0', null, '1578559554', '1578903910');

-- ----------------------------
-- Table structure for auth_group_rule
-- ----------------------------
DROP TABLE IF EXISTS `auth_group_rule`;
CREATE TABLE `auth_group_rule` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '控制器名称',
  `controller` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '控制器',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '类型',
  `icon` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '图标',
  `order` int(11) NOT NULL DEFAULT '1' COMMENT '排序',
  `state` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of auth_group_rule
-- ----------------------------
INSERT INTO `auth_group_rule` VALUES ('4', '网站管理', 'app\\http\\controllers\\admin\\indexcontroller', '1', '&#xe716;', '1', '0');
INSERT INTO `auth_group_rule` VALUES ('2', '管理员管理', 'app\\http\\controllers\\admin\\sitecontroller', '1', '&#xe66f;', '1', '0');

-- ----------------------------
-- Table structure for auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `method` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '方法',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '类型',
  `p_id` int(11) NOT NULL DEFAULT '0' COMMENT '分类',
  `order` tinyint(4) NOT NULL DEFAULT '1' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0为显示，1为不显示',
  `state` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of auth_rule
-- ----------------------------
INSERT INTO `auth_rule` VALUES ('18', '管理列表', 'admin/admin_list', '1', '2', '1', '0', '0');
INSERT INTO `auth_rule` VALUES ('14', '子页', 'admin/welcome', '1', '4', '1', '1', '0');
INSERT INTO `auth_rule` VALUES ('4', '添加规则', 'admin/add_rule', '1', '2', '1', '1', '0');
INSERT INTO `auth_rule` VALUES ('6', '编辑规则', 'admin/auth_rule_edit/{id?}', '1', '2', '1', '1', '0');
INSERT INTO `auth_rule` VALUES ('7', '删除规则', 'admin/auth_rule_drop', '1', '2', '1', '1', '0');
INSERT INTO `auth_rule` VALUES ('13', '首页', 'admin/index', '1', '4', '1', '1', '0');
INSERT INTO `auth_rule` VALUES ('10', '分组列表', 'admin/auth_group', '1', '2', '1', '1', '0');
INSERT INTO `auth_rule` VALUES ('11', '分组编辑', 'admin/auth_group_edit/{id?}', '1', '2', '1', '1', '0');
INSERT INTO `auth_rule` VALUES ('16', '规则列表', 'admin/rule_list', '1', '2', '3', '0', '0');
INSERT INTO `auth_rule` VALUES ('17', '删除分组', 'admin/auth_group_drop', '1', '2', '1', '1', '0');
INSERT INTO `auth_rule` VALUES ('19', '添加管理', 'admin/add_admin', '1', '2', '1', '1', '0');
INSERT INTO `auth_rule` VALUES ('20', '编辑管理', 'admin/edit_admin/{id?}', '1', '2', '1', '1', '0');
INSERT INTO `auth_rule` VALUES ('27', '删除管理', 'admin/drop_admin', '1', '2', '1', '1', '0');
INSERT INTO `auth_rule` VALUES ('22', '角色列表', 'admin/group_list', '1', '2', '2', '0', '0');
INSERT INTO `auth_rule` VALUES ('23', '添加角色', 'admin/add_group', '1', '2', '1', '1', '0');
INSERT INTO `auth_rule` VALUES ('24', '编辑角色', 'admin/edit_group/{id?}', '1', '2', '1', '1', '0');
INSERT INTO `auth_rule` VALUES ('25', '删除角色', 'admin/drop_group', '1', '2', '1', '1', '0');
INSERT INTO `auth_rule` VALUES ('26', '退出登录', 'admin/exit_login', '1', '4', '1', '1', '0');
INSERT INTO `auth_rule` VALUES ('28', '管理日志', 'admin/log_list', '1', '4', '1', '0', '0');
INSERT INTO `auth_rule` VALUES ('29', '删除日志', 'admin/log_drop', '1', '4', '1', '1', '0');

-- ----------------------------
-- Table structure for group
-- ----------------------------
DROP TABLE IF EXISTS `group`;
CREATE TABLE `group` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '角色名',
  `rules` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '规则',
  `state` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0为正常，1为禁用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of group
-- ----------------------------
INSERT INTO `group` VALUES ('1', '超级管理员', null, '0');
INSERT INTO `group` VALUES ('3', '二级管理员', '14,13,26,18,10,16,22', '0');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2019_12_26_151350_create_admin_user_table', '1');
INSERT INTO `migrations` VALUES ('2', '2019_12_27_150537_create_admin_log_table', '1');
INSERT INTO `migrations` VALUES ('3', '2019_12_30_173108_create_auth_rule_table', '1');
INSERT INTO `migrations` VALUES ('4', '2020_01_02_143650_create_auth_group_rule_table', '1');
INSERT INTO `migrations` VALUES ('5', '2020_01_07_155137_create_group_table', '2');
INSERT INTO `migrations` VALUES ('6', '2020_01_07_155443_create_group_role_table', '2');
