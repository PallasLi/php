/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50524
Source Host           : 127.0.0.1:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2015-01-12 08:56:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for location
-- ----------------------------
DROP TABLE IF EXISTS `location`;
CREATE TABLE `location` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(150) NOT NULL DEFAULT '' COMMENT '发送位置信息的微信号',
  `x` double(10,6) NOT NULL DEFAULT '0.000000' COMMENT 'X度',
  `y` double(10,6) NOT NULL DEFAULT '0.000000' COMMENT 'X度',
  `scale` int(11) NOT NULL DEFAULT '0' COMMENT '缩放大小',
  `label` varchar(200) NOT NULL DEFAULT '' COMMENT '位置标记',
  `createtime` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
