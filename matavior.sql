/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : matavior

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2014-12-05 14:20:38
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
  `userOnlineMarking` varchar(255) NOT NULL DEFAULT '%s',
  `showOnTeamPage` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`groupID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mata_groups
-- ----------------------------
INSERT INTO `mata_groups` VALUES ('1', 'Everyone', null, '1', '0', '%s', '0');
INSERT INTO `mata_groups` VALUES ('2', 'Guests', null, '2', '0', '%s', '0');
INSERT INTO `mata_groups` VALUES ('3', 'Registered Users', null, '3', '10', '%s', '0');
INSERT INTO `mata_groups` VALUES ('4', 'Administrators', null, '4', '1000', '<strong style=\"color:#FE2E2E;\">%s</strong>', '1');
INSERT INTO `mata_groups` VALUES ('5', 'Moderators', null, '4', '100', '<strong style=\"color:#009933;\">%s</strong>', '1');

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
INSERT INTO `mata_session` VALUES ('sdsdfg', '1', '127.0.0.1', 'CHROME', '0', '', '', null);

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
  PRIMARY KEY (`userID`),
  UNIQUE KEY `username` (`username`) USING HASH
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mata_users
-- ----------------------------
INSERT INTO `mata_users` VALUES ('1', 'MadnessFreak', 'madnessfreak@happyduck.co', 'cc03e747a6afbbcbf8be7668acfebee5', '1c99c5a7d118311c49b120be2118e44a', '0', null, '0', '817603200', '0', '4', '0', '0', '1417702174', '127.0.0.1', '0');
INSERT INTO `mata_users` VALUES ('2', 'Aalabyss', 'max.mustermann@example.net', 'cc03e747a6afbbcbf8be7668acfebee5', '1c99c5a7d118311c49b120be2118e44a', '0', null, '0', '0', '0', '3', '0', '0', '1417778249', '127.0.0.1', '0');
INSERT INTO `mata_users` VALUES ('3', 'Abra', 'max.mustermann@example.net', 'cc03e747a6afbbcbf8be7668acfebee5', '1c99c5a7d118311c49b120be2118e44a', '0', null, '0', '0', '0', '3', '0', '0', '1417778968', '127.0.0.1', '0');
INSERT INTO `mata_users` VALUES ('4', 'Bisaflor', 'max.mustermann@example.net', 'cc03e747a6afbbcbf8be7668acfebee5', '1c99c5a7d118311c49b120be2118e44a', '0', null, '0', '0', '0', '3', '0', '0', '1417780451', '127.0.0.1', '0');
INSERT INTO `mata_users` VALUES ('5', 'Charmian', 'max.mustermann@example.net', 'cc03e747a6afbbcbf8be7668acfebee5', '1c99c5a7d118311c49b120be2118e44a', '0', null, '0', '0', '0', '3', '0', '0', '1417780618', '127.0.0.1', '0');
INSERT INTO `mata_users` VALUES ('6', 'Elezard', 'max.mustermann@example.net', 'cc03e747a6afbbcbf8be7668acfebee5', '1c99c5a7d118311c49b120be2118e44a', '0', null, '0', '0', '0', '3', '0', '0', '1417780680', '127.0.0.1', '0');
INSERT INTO `mata_users` VALUES ('7', 'Rihorn', 'max.mustermann@example.net', 'cc03e747a6afbbcbf8be7668acfebee5', '1c99c5a7d118311c49b120be2118e44a', '0', null, '0', '0', '0', '3', '0', '0', '1417780718', '127.0.0.1', '0');
INSERT INTO `mata_users` VALUES ('8', 'Seemon', 'max.mustermann@example.net', 'cc03e747a6afbbcbf8be7668acfebee5', '1c99c5a7d118311c49b120be2118e44a', '0', null, '0', '0', '0', '3', '0', '0', '1417780769', '127.0.0.1', '0');
INSERT INTO `mata_users` VALUES ('9', 'Arktos', 'max.mustermann@example.net', 'cc03e747a6afbbcbf8be7668acfebee5', '1c99c5a7d118311c49b120be2118e44a', '0', null, '0', '0', '0', '3', '0', '0', '1417780799', '127.0.0.1', '0');
INSERT INTO `mata_users` VALUES ('10', 'Tyracroc', 'max.mustermann@example.net', 'cc03e747a6afbbcbf8be7668acfebee5', '1c99c5a7d118311c49b120be2118e44a', '0', null, '0', '0', '0', '3', '0', '0', '1417780826', '127.0.0.1', '0');
INSERT INTO `mata_users` VALUES ('11', 'Fluffeluff', 'max.mustermann@example.net', 'd41d8cd98f00b204e9800998ecf8427e', '1c99c5a7d118311c49b120be2118e44a', '0', null, '0', '0', '0', '3', '0', '0', '1417780847', '127.0.0.1', '0');
INSERT INTO `mata_users` VALUES ('12', 'Quaxo', 'max.mustermann@example.net', 'cc03e747a6afbbcbf8be7668acfebee5', '1c99c5a7d118311c49b120be2118e44a', '0', null, '0', '0', '0', '3', '0', '0', '1417780866', '127.0.0.1', '0');
INSERT INTO `mata_users` VALUES ('13', 'Griffel', 'max.mustermann@example.net', 'cc03e747a6afbbcbf8be7668acfebee5', '1c99c5a7d118311c49b120be2118e44a', '0', null, '0', '0', '0', '3', '0', '0', '1417780876', '127.0.0.1', '0');
INSERT INTO `mata_users` VALUES ('15', 'Sonnkern', 'max.mustermann@example.net', 'cc03e747a6afbbcbf8be7668acfebee5', '1c99c5a7d118311c49b120be2118e44a', '0', null, '0', '0', '0', '3', '0', '0', '1417781154', '127.0.0.1', '0');
INSERT INTO `mata_users` VALUES ('16', 'Stahlos', 'max.mustermann@example.net', 'b154c69a5ff4adad34eb390101bfc48b', '1c99c5a7d118311c49b120be2118e44a', '0', null, '0', '0', '0', '3', '0', '0', '1417781195', '127.0.0.1', '0');
INSERT INTO `mata_users` VALUES ('18', 'Snubbull', 'max.mustermann@example.net', 'cc03e747a6afbbcbf8be7668acfebee5', '1c99c5a7d118311c49b120be2118e44a', '0', null, '0', '0', '0', '3', '0', '0', '1417781241', '127.0.0.1', '0');
INSERT INTO `mata_users` VALUES ('19', 'Scherox', 'max.mustermann@example.net', 'cc03e747a6afbbcbf8be7668acfebee5', '1c99c5a7d118311c49b120be2118e44a', '0', null, '0', '0', '0', '3', '0', '0', '1417781275', '127.0.0.1', '0');
INSERT INTO `mata_users` VALUES ('20', 'Octillery', 'max.mustermann@example.net', 'cc03e747a6afbbcbf8be7668acfebee5', '1c99c5a7d118311c49b120be2118e44a', '0', null, '0', '0', '0', '3', '0', '0', '1417781296', '127.0.0.1', '0');

-- ----------------------------
-- Table structure for `mata_user_to_group`
-- ----------------------------
DROP TABLE IF EXISTS `mata_user_to_group`;
CREATE TABLE `mata_user_to_group` (
  `userID` int(10) unsigned NOT NULL,
  `groupID` int(10) unsigned NOT NULL,
  UNIQUE KEY `userID` (`userID`,`groupID`),
  KEY `groupID` (`groupID`),
  KEY `userID_2` (`userID`),
  CONSTRAINT `sug_user_to_group_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `mata_users` (`userID`) ON DELETE CASCADE,
  CONSTRAINT `sug_user_to_group_ibfk_2` FOREIGN KEY (`groupID`) REFERENCES `mata_groups` (`groupID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mata_user_to_group
-- ----------------------------
INSERT INTO `mata_user_to_group` VALUES ('1', '3');
INSERT INTO `mata_user_to_group` VALUES ('2', '3');
INSERT INTO `mata_user_to_group` VALUES ('3', '3');
INSERT INTO `mata_user_to_group` VALUES ('4', '3');
INSERT INTO `mata_user_to_group` VALUES ('5', '3');
INSERT INTO `mata_user_to_group` VALUES ('6', '3');
INSERT INTO `mata_user_to_group` VALUES ('7', '3');
INSERT INTO `mata_user_to_group` VALUES ('8', '3');
INSERT INTO `mata_user_to_group` VALUES ('9', '3');
INSERT INTO `mata_user_to_group` VALUES ('10', '3');
INSERT INTO `mata_user_to_group` VALUES ('11', '3');
INSERT INTO `mata_user_to_group` VALUES ('12', '3');
INSERT INTO `mata_user_to_group` VALUES ('13', '3');
INSERT INTO `mata_user_to_group` VALUES ('15', '3');
INSERT INTO `mata_user_to_group` VALUES ('16', '3');
INSERT INTO `mata_user_to_group` VALUES ('18', '3');
INSERT INTO `mata_user_to_group` VALUES ('19', '3');
INSERT INTO `mata_user_to_group` VALUES ('20', '3');
INSERT INTO `mata_user_to_group` VALUES ('1', '4');
INSERT INTO `mata_user_to_group` VALUES ('3', '5');
INSERT INTO `mata_user_to_group` VALUES ('5', '5');
