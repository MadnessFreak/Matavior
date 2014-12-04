/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : matavior

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2014-12-04 16:22:43
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mata_navigation
-- ----------------------------
INSERT INTO `mata_navigation` VALUES ('1', 'mata.navigation.dashboard', 'dashboard', '0', '1', null);
INSERT INTO `mata_navigation` VALUES ('2', 'mata.navigation.members', 'members', '0', '1', null);
INSERT INTO `mata_navigation` VALUES ('3', 'mata.navigation.team', 'members/team', '0', '1', null);
INSERT INTO `mata_navigation` VALUES ('4', 'mata.navigation.blog', 'blog', '0', '1', null);
INSERT INTO `mata_navigation` VALUES ('5', 'mata.navigation.community', 'community', '0', '1', null);
INSERT INTO `mata_navigation` VALUES ('6', 'mata.navigation.search', 'search', '0', '1', null);

-- ----------------------------
-- Table structure for `mata_session`
-- ----------------------------
DROP TABLE IF EXISTS `mata_session`;
CREATE TABLE `mata_session` (
  `sessionID` char(40) NOT NULL,
  `userID` int(10) unsigned DEFAULT NULL,
  `ipAddress` varchar(39) NOT NULL DEFAULT '',
  `userAgent` varchar(255) NOT NULL DEFAULT '',
  `lastActivityTime` int(10) NOT NULL DEFAULT '0',
  `requestURI` varchar(255) NOT NULL DEFAULT '',
  `requestMethod` varchar(7) NOT NULL DEFAULT '',
  `sessionVariables` mediumtext,
  PRIMARY KEY (`sessionID`),
  KEY `userID` (`userID`),
  CONSTRAINT `mata_session_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `mata_users` (`userID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mata_session
-- ----------------------------

-- ----------------------------
-- Table structure for `mata_users`
-- ----------------------------
DROP TABLE IF EXISTS `mata_users`;
CREATE TABLE `mata_users` (
  `userID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(40) NOT NULL DEFAULT '',
  `token` char(40) NOT NULL DEFAULT '',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `banReason` mediumtext,
  `banExpires` int(10) NOT NULL DEFAULT '0',
  `birthday` int(10) NOT NULL DEFAULT '0',
  `activationCode` int(10) NOT NULL DEFAULT '0',
  `primaryGroup` int(10) unsigned NOT NULL DEFAULT '3',
  `avatarID` int(10) unsigned NOT NULL DEFAULT '0',
  `languageID` int(10) unsigned NOT NULL DEFAULT '0',
  `registrationDate` int(10) NOT NULL DEFAULT '0',
  `registrationIpAddress` varchar(39) NOT NULL DEFAULT '',
  `lastActivityTime` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mata_users
-- ----------------------------
INSERT INTO `mata_users` VALUES ('1', 'MadnessFreak', 'madnessfreak@happyduck.co', 'cc03e747a6afbbcbf8be7668acfebee5', 'asd', '0', null, '0', '817603200', '0', '3', '0', '0', '1417702174', '', '0');

-- ----------------------------
-- Table structure for `mata_user_to_group`
-- ----------------------------
DROP TABLE IF EXISTS `mata_user_to_group`;
CREATE TABLE `mata_user_to_group` (
  `userID` int(10) unsigned NOT NULL,
  `groupID` int(10) unsigned NOT NULL,
  UNIQUE KEY `userID` (`userID`,`groupID`),
  KEY `groupID` (`groupID`),
  CONSTRAINT `sug_user_to_group_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `mata_users` (`userID`) ON DELETE CASCADE,
  CONSTRAINT `sug_user_to_group_ibfk_2` FOREIGN KEY (`groupID`) REFERENCES `mata_groups` (`groupID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mata_user_to_group
-- ----------------------------
