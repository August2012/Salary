/*
Navicat MySQL Data Transfer

Source Server         : LOCAL
Source Server Version : 50153
Source Host           : localhost:3306
Source Database       : salary

Target Server Type    : MYSQL
Target Server Version : 50153
File Encoding         : 65001

Date: 2015-09-18 17:17:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员',
  `admin_name` varchar(200) NOT NULL DEFAULT '' COMMENT '账号',
  `admin_pwd` varchar(50) NOT NULL DEFAULT '' COMMENT '密码',
  `admin_email` varchar(100) NOT NULL DEFAULT '' COMMENT '邮箱',
  `admin_phone` varchar(20) NOT NULL DEFAULT '' COMMENT '手机号码',
  `add_time` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `is_use` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1:启用0未使用',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for messages
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(20) NOT NULL DEFAULT '' COMMENT '手机号码',
  `message` varchar(200) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1: 验证码， 2....',
  `send_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for services
-- ----------------------------
DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `ser_id` int(11) NOT NULL AUTO_INCREMENT,
  `ser_name` varchar(200) NOT NULL DEFAULT '' COMMENT '客服姓名',
  `ser_pwd` varchar(50) NOT NULL DEFAULT '' COMMENT '密码',
  `ser_phone` varchar(20) NOT NULL DEFAULT '' COMMENT '手机号码',
  `ser_email` varchar(100) NOT NULL DEFAULT '' COMMENT '邮箱',
  `ser_join` int(11) NOT NULL DEFAULT '0' COMMENT '加入时间',
  `is_use` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1:启用0未启用',
  PRIMARY KEY (`ser_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for wages
-- ----------------------------
DROP TABLE IF EXISTS `wages`;
CREATE TABLE `wages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ser_id` int(11) NOT NULL COMMENT '客服',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '工资',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `detail` text COMMENT '详细描述',
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '添加人',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
