/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : matavior

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2014-12-10 14:44:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `mata_activity`
-- ----------------------------
DROP TABLE IF EXISTS `mata_activity`;
CREATE TABLE `mata_activity` (
  `activityID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `objectID` int(10) unsigned NOT NULL,
  `objectData` varchar(255) NOT NULL DEFAULT '',
  `eventID` int(10) unsigned NOT NULL,
  `userID` int(10) unsigned NOT NULL,
  `timeTriggered` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`activityID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mata_activity
-- ----------------------------
INSERT INTO `mata_activity` VALUES ('1', '666', '', '3', '1', '0');
INSERT INTO `mata_activity` VALUES ('2', '888', '', '3', '1', '0');
INSERT INTO `mata_activity` VALUES ('3', '35', 'Seemon', '4', '1', '1418215772');
INSERT INTO `mata_activity` VALUES ('4', '39', 'Seemon', '4', '1', '1418217793');
INSERT INTO `mata_activity` VALUES ('5', '40', 'MadnessFreak', '4', '8', '1418217975');

-- ----------------------------
-- Table structure for `mata_event`
-- ----------------------------
DROP TABLE IF EXISTS `mata_event`;
CREATE TABLE `mata_event` (
  `eventID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `eventName` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`eventID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mata_event
-- ----------------------------
INSERT INTO `mata_event` VALUES ('1', 'mata.user.notification.event.wall');
INSERT INTO `mata_event` VALUES ('2', 'mata.user.notification.event.message');
INSERT INTO `mata_event` VALUES ('3', 'mata.user.event.test');
INSERT INTO `mata_event` VALUES ('4', 'mata.user.event.wall');

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
INSERT INTO `mata_groups` VALUES ('1', 'Everyone', null, '1', '0', '<small>%s</small>', '0');
INSERT INTO `mata_groups` VALUES ('2', 'Guests', null, '2', '0', '<small>%s</small>', '0');
INSERT INTO `mata_groups` VALUES ('3', 'Registered Users', null, '3', '10', '<small>%s</small>', '0');
INSERT INTO `mata_groups` VALUES ('4', 'Administrators', null, '4', '1000', '<span class=\"label label-primary\">%s</span>', '1');
INSERT INTO `mata_groups` VALUES ('5', 'Moderators', null, '4', '100', '<span class=\"label label-success\">%s</span>', '1');

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
-- Table structure for `mata_notifications`
-- ----------------------------
DROP TABLE IF EXISTS `mata_notifications`;
CREATE TABLE `mata_notifications` (
  `notificationID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `objectID` int(10) unsigned NOT NULL DEFAULT '0',
  `objectData` varchar(255) DEFAULT '',
  `eventID` int(10) unsigned NOT NULL,
  `authorID` int(10) unsigned NOT NULL,
  `timeTriggered` int(10) NOT NULL DEFAULT '0',
  `timeRead` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`notificationID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mata_notifications
-- ----------------------------
INSERT INTO `mata_notifications` VALUES ('1', '3', '', '1', '7', '1418041306', '1418205120');
INSERT INTO `mata_notifications` VALUES ('2', '1', '-Hello-my-friend', '2', '4', '1418047676', '1418206270');
INSERT INTO `mata_notifications` VALUES ('3', '26', '', '1', '1', '1418128255', '1418206150');
INSERT INTO `mata_notifications` VALUES ('4', '27', '', '1', '1', '1418128340', '1418208852');
INSERT INTO `mata_notifications` VALUES ('5', '28', '', '1', '8', '1418128977', '1418202493');
INSERT INTO `mata_notifications` VALUES ('6', '29', '', '1', '1', '1418135168', '1418208887');
INSERT INTO `mata_notifications` VALUES ('7', '30', '', '1', '8', '1418135281', '1418202597');
INSERT INTO `mata_notifications` VALUES ('8', '31', '', '1', '9', '1418135374', '1418204385');
INSERT INTO `mata_notifications` VALUES ('9', '32', '', '1', '1', '1418135433', '1418204856');
INSERT INTO `mata_notifications` VALUES ('10', '33', '', '1', '1', '1418207639', '1418207775');
INSERT INTO `mata_notifications` VALUES ('11', '34', '', '1', '8', '1418208905', '1418208969');
INSERT INTO `mata_notifications` VALUES ('12', '35', '', '1', '1', '1418209003', '1418209119');
INSERT INTO `mata_notifications` VALUES ('13', '36', '', '1', '8', '1418209142', '1418211343');
INSERT INTO `mata_notifications` VALUES ('14', '37', '', '1', '5', '1418209233', '1418211292');
INSERT INTO `mata_notifications` VALUES ('15', '38', '', '1', '1', '1418217752', '1418217915');
INSERT INTO `mata_notifications` VALUES ('16', '39', '', '1', '1', '1418217793', '1418217925');
INSERT INTO `mata_notifications` VALUES ('17', '40', '', '1', '8', '1418217975', '1418217998');

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mata_users
-- ----------------------------
INSERT INTO `mata_users` VALUES ('1', 'MadnessFreak', 'madnessfreak@happyduck.co', 'cc03e747a6afbbcbf8be7668acfebee5', '1c99c5a7d118311c49b120be2118e44a', '0', null, '0', '817603200', '0', '4', '1', '0', '1417702174', '127.0.0.1', '0');
INSERT INTO `mata_users` VALUES ('2', 'Aalabyss', 'max.mustermann@example.net', 'cc03e747a6afbbcbf8be7668acfebee5', '1c99c5a7d118311c49b120be2118e44a', '0', null, '0', '0', '0', '3', '0', '0', '1417778249', '127.0.0.1', '0');
INSERT INTO `mata_users` VALUES ('3', 'Abra', 'max.mustermann@example.net', 'cc03e747a6afbbcbf8be7668acfebee5', '1c99c5a7d118311c49b120be2118e44a', '0', null, '0', '0', '0', '5', '0', '0', '1417778968', '127.0.0.1', '0');
INSERT INTO `mata_users` VALUES ('4', 'Bisaflor', 'max.mustermann@example.net', 'cc03e747a6afbbcbf8be7668acfebee5', '1c99c5a7d118311c49b120be2118e44a', '0', null, '0', '0', '0', '3', '0', '0', '1417780451', '127.0.0.1', '0');
INSERT INTO `mata_users` VALUES ('5', 'Charmian', 'max.mustermann@example.net', 'cc03e747a6afbbcbf8be7668acfebee5', '1c99c5a7d118311c49b120be2118e44a', '0', null, '0', '0', '0', '5', '3', '0', '1417780618', '127.0.0.1', '0');
INSERT INTO `mata_users` VALUES ('6', 'Elezard', 'max.mustermann@example.net', 'cc03e747a6afbbcbf8be7668acfebee5', '1c99c5a7d118311c49b120be2118e44a', '0', null, '0', '0', '0', '3', '0', '0', '1417780680', '127.0.0.1', '0');
INSERT INTO `mata_users` VALUES ('7', 'Rihorn', 'max.mustermann@example.net', 'cc03e747a6afbbcbf8be7668acfebee5', '1c99c5a7d118311c49b120be2118e44a', '0', null, '0', '0', '0', '3', '0', '0', '1417780718', '127.0.0.1', '0');
INSERT INTO `mata_users` VALUES ('8', 'Seemon', 'max.mustermann@example.net', 'cc03e747a6afbbcbf8be7668acfebee5', '1c99c5a7d118311c49b120be2118e44a', '0', null, '0', '0', '0', '3', '2', '0', '1417780769', '127.0.0.1', '1418218806');
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
INSERT INTO `mata_users` VALUES ('21', 'Digital Max', 'max.mustermann@example.net', 'cc03e747a6afbbcbf8be7668acfebee5', '1c99c5a7d118311c49b120be2118e44a', '0', null, '0', '0', '0', '3', '0', '0', '1418127521', '127.0.0.1', '0');

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
  CONSTRAINT `mata_user_to_group_ibfk_2` FOREIGN KEY (`groupID`) REFERENCES `mata_groups` (`groupID`) ON DELETE CASCADE,
  CONSTRAINT `mata_user_to_group_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `mata_users` (`userID`) ON DELETE CASCADE
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
INSERT INTO `mata_user_to_group` VALUES ('21', '3');
INSERT INTO `mata_user_to_group` VALUES ('1', '4');
INSERT INTO `mata_user_to_group` VALUES ('3', '5');
INSERT INTO `mata_user_to_group` VALUES ('5', '5');

-- ----------------------------
-- Table structure for `mata_user_to_notification`
-- ----------------------------
DROP TABLE IF EXISTS `mata_user_to_notification`;
CREATE TABLE `mata_user_to_notification` (
  `userID` int(10) unsigned NOT NULL,
  `notificationID` int(10) unsigned NOT NULL,
  UNIQUE KEY `notificationID` (`userID`,`notificationID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mata_user_to_notification
-- ----------------------------
INSERT INTO `mata_user_to_notification` VALUES ('1', '1');
INSERT INTO `mata_user_to_notification` VALUES ('1', '2');
INSERT INTO `mata_user_to_notification` VALUES ('1', '3');
INSERT INTO `mata_user_to_notification` VALUES ('1', '5');
INSERT INTO `mata_user_to_notification` VALUES ('1', '7');
INSERT INTO `mata_user_to_notification` VALUES ('1', '8');
INSERT INTO `mata_user_to_notification` VALUES ('1', '9');
INSERT INTO `mata_user_to_notification` VALUES ('1', '10');
INSERT INTO `mata_user_to_notification` VALUES ('1', '11');
INSERT INTO `mata_user_to_notification` VALUES ('1', '13');
INSERT INTO `mata_user_to_notification` VALUES ('1', '14');
INSERT INTO `mata_user_to_notification` VALUES ('1', '17');
INSERT INTO `mata_user_to_notification` VALUES ('8', '4');
INSERT INTO `mata_user_to_notification` VALUES ('8', '6');
INSERT INTO `mata_user_to_notification` VALUES ('8', '12');
INSERT INTO `mata_user_to_notification` VALUES ('8', '15');
INSERT INTO `mata_user_to_notification` VALUES ('8', '16');

-- ----------------------------
-- Table structure for `mata_user_wall`
-- ----------------------------
DROP TABLE IF EXISTS `mata_user_wall`;
CREATE TABLE `mata_user_wall` (
  `entryID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(10) unsigned NOT NULL,
  `authorID` int(10) unsigned NOT NULL,
  `content` text NOT NULL,
  `timeCreated` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`entryID`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mata_user_wall
-- ----------------------------
INSERT INTO `mata_user_wall` VALUES ('1', '1', '5', 'Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere.', '1418119882');
INSERT INTO `mata_user_wall` VALUES ('2', '1', '1', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.', '1418119934');
INSERT INTO `mata_user_wall` VALUES ('3', '1', '7', 'Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.', '1418119974');
INSERT INTO `mata_user_wall` VALUES ('4', '1', '1', 'Nothing to say here ...', '1418122913');
INSERT INTO `mata_user_wall` VALUES ('5', '5', '1', 'First!', '1418123039');
INSERT INTO `mata_user_wall` VALUES ('6', '5', '1', 'First!', '1418123039');
INSERT INTO `mata_user_wall` VALUES ('7', '1', '1', 'I\'m as great as a banana!', '1418123175');
INSERT INTO `mata_user_wall` VALUES ('8', '5', '1', 'Ehh, what?!', '1418123859');
INSERT INTO `mata_user_wall` VALUES ('9', '6', '1', 'You are not my mother!', '1418125613');
INSERT INTO `mata_user_wall` VALUES ('10', '6', '1', 'You are not my mother!', '1418125620');
INSERT INTO `mata_user_wall` VALUES ('11', '6', '1', 'Bla', '1418125671');
INSERT INTO `mata_user_wall` VALUES ('12', '6', '1', 'Bla', '1418125677');
INSERT INTO `mata_user_wall` VALUES ('13', '6', '1', 'yolo', '1418125907');
INSERT INTO `mata_user_wall` VALUES ('14', '6', '1', 'yolo', '1418125914');
INSERT INTO `mata_user_wall` VALUES ('15', '6', '1', 'what', '1418126009');
INSERT INTO `mata_user_wall` VALUES ('16', '6', '1', 'what', '1418126014');
INSERT INTO `mata_user_wall` VALUES ('17', '6', '1', 'gut', '1418126992');
INSERT INTO `mata_user_wall` VALUES ('18', '6', '1', 'gut', '1418126997');
INSERT INTO `mata_user_wall` VALUES ('19', '6', '1', 'test', '1418127170');
INSERT INTO `mata_user_wall` VALUES ('20', '6', '1', 'test', '1418127174');
INSERT INTO `mata_user_wall` VALUES ('21', '6', '1', 'asd', '1418127287');
INSERT INTO `mata_user_wall` VALUES ('22', '6', '1', 'asd', '1418127292');
INSERT INTO `mata_user_wall` VALUES ('23', '6', '1', 'asd', '1418127316');
INSERT INTO `mata_user_wall` VALUES ('24', '6', '1', 'xxx', '1418127374');
INSERT INTO `mata_user_wall` VALUES ('25', '1', '1', 'I\'m so cool! I posted on my own wall. LOL.', '1418128221');
INSERT INTO `mata_user_wall` VALUES ('26', '1', '1', 'I\'m so cool! I posted on my own wall. LOL.', '1418128255');
INSERT INTO `mata_user_wall` VALUES ('27', '8', '1', 'Hey Seemon, nice to see you dude!', '1418128340');
INSERT INTO `mata_user_wall` VALUES ('28', '1', '8', 'Thanks for your greetings! :)', '1418128977');
INSERT INTO `mata_user_wall` VALUES ('29', '8', '1', 'It\'s been a pleasure. ;)', '1418135168');
INSERT INTO `mata_user_wall` VALUES ('30', '1', '8', 'Hehe', '1418135281');
INSERT INTO `mata_user_wall` VALUES ('31', '1', '9', 'Eh, what\'s up?', '1418135374');
INSERT INTO `mata_user_wall` VALUES ('32', '1', '1', 'Good night!', '1418135433');
INSERT INTO `mata_user_wall` VALUES ('33', '1', '1', 'Hello!', '1418207639');
INSERT INTO `mata_user_wall` VALUES ('34', '1', '8', 'How are you today?', '1418208905');
INSERT INTO `mata_user_wall` VALUES ('35', '8', '1', 'I\'m find and you?', '1418209003');
INSERT INTO `mata_user_wall` VALUES ('36', '1', '8', 'Same here', '1418209142');
INSERT INTO `mata_user_wall` VALUES ('37', '1', '5', 'What are you doing?!', '1418209233');
INSERT INTO `mata_user_wall` VALUES ('38', '8', '1', 'Test', '1418217752');
INSERT INTO `mata_user_wall` VALUES ('39', '8', '1', 'Activity or what?', '1418217793');
INSERT INTO `mata_user_wall` VALUES ('40', '1', '8', 'Spam?', '1418217975');
