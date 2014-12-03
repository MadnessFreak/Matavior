/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : matavior

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2014-12-03 16:23:41
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `mata_groups`
-- ----------------------------
DROP TABLE IF EXISTS `mata_groups`;
CREATE TABLE `mata_groups` (
  `groupID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `groupName` varchar(255) NOT NULL DEFAULT '',
  `groupDesc` text,
  `groupType` tinyint(1) NOT NULL DEFAULT '4',
  `priority` mediumint(8) NOT NULL DEFAULT '0',
  `showOnTeamPage` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`groupID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mata_groups
-- ----------------------------

-- ----------------------------
-- Table structure for `mata_navigation`
-- ----------------------------
DROP TABLE IF EXISTS `mata_navigation`;
CREATE TABLE `mata_navigation` (
  `navID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `navName` varchar(255) NOT NULL DEFAULT '',
  `navLink` varchar(255) NOT NULL DEFAULT '',
  `showOrder` int(10) NOT NULL DEFAULT '0',
  `showOnTop` tinyint(1) NOT NULL DEFAULT '1',
  `permissions` text,
  PRIMARY KEY (`navID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mata_navigation
-- ----------------------------
