/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1_3306
Source Server Version : 50612
Source Host           : 127.0.0.1:3306
Source Database       : beehive

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2015-07-26 21:49:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bee_action
-- ----------------------------
DROP TABLE IF EXISTS `bee_action`;
CREATE TABLE `bee_action` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bee_action
-- ----------------------------
INSERT INTO `bee_action` VALUES ('1', 'diary');
INSERT INTO `bee_action` VALUES ('2', 'album');

-- ----------------------------
-- Table structure for bee_ad
-- ----------------------------
DROP TABLE IF EXISTS `bee_ad`;
CREATE TABLE `bee_ad` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `link` varchar(255) DEFAULT NULL,
  `style` tinyint(4) DEFAULT NULL,
  `i_path` varchar(255) DEFAULT NULL,
  `i_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bee_ad
-- ----------------------------

-- ----------------------------
-- Table structure for bee_album
-- ----------------------------
DROP TABLE IF EXISTS `bee_album`;
CREATE TABLE `bee_album` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `des` varchar(255) DEFAULT NULL,
  `u_id` int(10) unsigned DEFAULT NULL,
  `power` tinyint(4) DEFAULT NULL,
  `time` varchar(13) DEFAULT NULL,
  `browse` tinyint(4) DEFAULT NULL,
  `tolist` tinyint(4) DEFAULT NULL,
  `hot` int(11) DEFAULT NULL,
  `update_time` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bee_album
-- ----------------------------

-- ----------------------------
-- Table structure for bee_atag
-- ----------------------------
DROP TABLE IF EXISTS `bee_atag`;
CREATE TABLE `bee_atag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `hot` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bee_atag
-- ----------------------------

-- ----------------------------
-- Table structure for bee_a_replay
-- ----------------------------
DROP TABLE IF EXISTS `bee_a_replay`;
CREATE TABLE `bee_a_replay` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `time` varchar(13) DEFAULT NULL,
  `a_id` int(10) unsigned DEFAULT NULL,
  `r_id` int(10) unsigned DEFAULT '0',
  `u_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `u_id` (`u_id`),
  KEY `a_id` (`a_id`),
  CONSTRAINT `bee_a_replay_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `bee_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bee_a_replay_ibfk_2` FOREIGN KEY (`a_id`) REFERENCES `bee_album` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bee_a_replay
-- ----------------------------

-- ----------------------------
-- Table structure for bee_a_t
-- ----------------------------
DROP TABLE IF EXISTS `bee_a_t`;
CREATE TABLE `bee_a_t` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `a_id` int(10) unsigned DEFAULT NULL,
  `t_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `a_id` (`a_id`),
  KEY `t_id` (`t_id`),
  CONSTRAINT `bee_a_t_ibfk_1` FOREIGN KEY (`a_id`) REFERENCES `bee_album` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bee_a_t_ibfk_2` FOREIGN KEY (`t_id`) REFERENCES `bee_atag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bee_a_t
-- ----------------------------

-- ----------------------------
-- Table structure for bee_bclassify
-- ----------------------------
DROP TABLE IF EXISTS `bee_bclassify`;
CREATE TABLE `bee_bclassify` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `pid` int(10) unsigned DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bee_bclassify
-- ----------------------------
INSERT INTO `bee_bclassify` VALUES ('9', '文学', '0', '0,');
INSERT INTO `bee_bclassify` VALUES ('10', '小说', '9', '0,9,');
INSERT INTO `bee_bclassify` VALUES ('11', '流行', '0', '0,');
INSERT INTO `bee_bclassify` VALUES ('12', '漫画', '11', '0,11,');
INSERT INTO `bee_bclassify` VALUES ('13', '文化', '0', '0,');
INSERT INTO `bee_bclassify` VALUES ('15', '随笔', '9', '0,9,');
INSERT INTO `bee_bclassify` VALUES ('16', '散文', '9', '0,9,');
INSERT INTO `bee_bclassify` VALUES ('17', '绘本', '11', '0,11,');
INSERT INTO `bee_bclassify` VALUES ('18', '推理', '11', '0,11,');
INSERT INTO `bee_bclassify` VALUES ('19', '历史', '13', '0,13,');
INSERT INTO `bee_bclassify` VALUES ('20', '哲学', '13', '0,13,');
INSERT INTO `bee_bclassify` VALUES ('21', '传记', '13', '0,13,');
INSERT INTO `bee_bclassify` VALUES ('22', '生活', '0', '0,');
INSERT INTO `bee_bclassify` VALUES ('23', '经管', '0', '0,');
INSERT INTO `bee_bclassify` VALUES ('24', '科技', '0', '0,');

-- ----------------------------
-- Table structure for bee_bimage
-- ----------------------------
DROP TABLE IF EXISTS `bee_bimage`;
CREATE TABLE `bee_bimage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `b_id` int(10) unsigned DEFAULT NULL,
  `is_cover` tinyint(4) DEFAULT '0',
  `i_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `b_id` (`b_id`),
  CONSTRAINT `bee_bimage_ibfk_1` FOREIGN KEY (`b_id`) REFERENCES `bee_book` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bee_bimage
-- ----------------------------
INSERT INTO `bee_bimage` VALUES ('27', '55b4e0218849a.jpg', '55', '1', '/Uploads/book/2015-07-26/');
INSERT INTO `bee_bimage` VALUES ('28', '55b4e07dc7c67.jpg', '58', '1', '/Uploads/book/2015-07-26/');
INSERT INTO `bee_bimage` VALUES ('29', '55b4e0de26313.jpg', '59', '1', '/Uploads/book/2015-07-26/');
INSERT INTO `bee_bimage` VALUES ('30', '55b4e176b7dad.jpg', '60', '1', '/Uploads/book/2015-07-26/');
INSERT INTO `bee_bimage` VALUES ('31', '55b4e19520c9c.jpg', '61', '1', '/Uploads/book/2015-07-26/');
INSERT INTO `bee_bimage` VALUES ('32', '55b4e5062039f.jpg', '62', '1', '/Uploads/book/2015-07-26/');

-- ----------------------------
-- Table structure for bee_book
-- ----------------------------
DROP TABLE IF EXISTS `bee_book`;
CREATE TABLE `bee_book` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `release_t` varchar(255) DEFAULT NULL,
  `writer` varchar(255) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `isbn` varchar(255) DEFAULT NULL,
  `translater` varchar(255) DEFAULT NULL,
  `brief` longtext,
  `w_brief` longtext,
  `book_cover` varchar(255) DEFAULT NULL,
  `hot` int(11) DEFAULT NULL,
  `b_brief` longtext,
  `score` tinyint(10) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bee_book
-- ----------------------------
INSERT INTO `bee_book` VALUES ('55', '世间寂静', '1504368000', '弹弹堂', 'PHP兄弟连出版社', '64564894', '无', '111111', '我', null, '6', null, '0');
INSERT INTO `bee_book` VALUES ('58', '我一直在你身边', '1404662400', '弹弹堂', 'PHP兄弟连出版社', '64564894', 'me', '寂静的世界', '121212', null, '6', null, '0');
INSERT INTO `bee_book` VALUES ('59', '歪笑', '775497600', '弹弹堂', 'dds', '64564894', '123', '', 'me', null, null, null, '0');
INSERT INTO `bee_book` VALUES ('60', '魔法森林', '1504368000', '弹弹堂', 'dds', '64564894', '无', '', '121212', null, '1', null, '0');
INSERT INTO `bee_book` VALUES ('61', '文化记忆', '1504368000', '弹弹堂', 'PHP兄弟连出版社', '64564894', '123', '', 'me', null, null, null, '0');
INSERT INTO `bee_book` VALUES ('62', '视觉', '1504368000', '潘驰', 'PHP兄弟连出版社', '11111', '无', '我前天失眠到三点，所以决定一定要九点就睡觉！然后……我手贱地打开了这本书……然后……看完已经十二点了……然后……把所有的恋爱过的暗恋过的人都想了一遍……又是两点钟才睡！故事很好看书很漂亮。最关键的是，书里有不少新故事，没发过的！还有长安君的情史！', '潘驰', null, null, null, '0');

-- ----------------------------
-- Table structure for bee_b_c
-- ----------------------------
DROP TABLE IF EXISTS `bee_b_c`;
CREATE TABLE `bee_b_c` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `b_id` int(10) unsigned DEFAULT NULL,
  `c_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bee_b_c_ibfk_1` (`b_id`),
  KEY `bee_b_c_ibfk_2` (`c_id`),
  CONSTRAINT `bee_b_c_ibfk_1` FOREIGN KEY (`b_id`) REFERENCES `bee_book` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bee_b_c_ibfk_2` FOREIGN KEY (`c_id`) REFERENCES `bee_bclassify` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bee_b_c
-- ----------------------------
INSERT INTO `bee_b_c` VALUES ('28', '55', '10');
INSERT INTO `bee_b_c` VALUES ('29', '58', '10');
INSERT INTO `bee_b_c` VALUES ('30', '59', '12');
INSERT INTO `bee_b_c` VALUES ('31', '60', '15');
INSERT INTO `bee_b_c` VALUES ('32', '61', '18');
INSERT INTO `bee_b_c` VALUES ('33', '61', '19');
INSERT INTO `bee_b_c` VALUES ('34', '61', '20');
INSERT INTO `bee_b_c` VALUES ('35', '61', '21');
INSERT INTO `bee_b_c` VALUES ('36', '62', '16');
INSERT INTO `bee_b_c` VALUES ('37', '62', '18');
INSERT INTO `bee_b_c` VALUES ('38', '62', '19');
INSERT INTO `bee_b_c` VALUES ('39', '62', '20');

-- ----------------------------
-- Table structure for bee_b_replay
-- ----------------------------
DROP TABLE IF EXISTS `bee_b_replay`;
CREATE TABLE `bee_b_replay` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `time` varchar(13) DEFAULT NULL,
  `b_id` int(10) unsigned DEFAULT NULL,
  `r_id` int(10) unsigned DEFAULT '0',
  `u_id` int(10) unsigned DEFAULT NULL,
  `rc_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `u_id` (`u_id`),
  KEY `b_id` (`b_id`),
  CONSTRAINT `bee_b_replay_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `bee_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bee_b_replay
-- ----------------------------
INSERT INTO `bee_b_replay` VALUES ('27', '测试子楼层', '1437909860', '47', '8', '3', '0');
INSERT INTO `bee_b_replay` VALUES ('28', '测试内框楼层', '1437909871', '47', '8', '3', '27');

-- ----------------------------
-- Table structure for bee_diary
-- ----------------------------
DROP TABLE IF EXISTS `bee_diary`;
CREATE TABLE `bee_diary` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext,
  `time` varchar(13) DEFAULT NULL,
  `u_id` int(10) unsigned DEFAULT NULL,
  `power` tinyint(4) DEFAULT NULL,
  `browse` tinyint(4) DEFAULT NULL,
  `hot` int(11) DEFAULT NULL,
  `tolist` tinyint(4) DEFAULT NULL,
  `update_time` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `u_id` (`u_id`),
  CONSTRAINT `bee_diary_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `bee_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bee_diary
-- ----------------------------

-- ----------------------------
-- Table structure for bee_dtag
-- ----------------------------
DROP TABLE IF EXISTS `bee_dtag`;
CREATE TABLE `bee_dtag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `hot` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bee_dtag
-- ----------------------------

-- ----------------------------
-- Table structure for bee_d_t
-- ----------------------------
DROP TABLE IF EXISTS `bee_d_t`;
CREATE TABLE `bee_d_t` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `d_id` int(10) unsigned DEFAULT NULL,
  `t_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `d_id` (`d_id`),
  KEY `t_id` (`t_id`),
  CONSTRAINT `bee_d_t_ibfk_1` FOREIGN KEY (`d_id`) REFERENCES `bee_diary` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bee_d_t_ibfk_2` FOREIGN KEY (`t_id`) REFERENCES `bee_dtag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bee_d_t
-- ----------------------------

-- ----------------------------
-- Table structure for bee_follow
-- ----------------------------
DROP TABLE IF EXISTS `bee_follow`;
CREATE TABLE `bee_follow` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `u_id` int(10) unsigned DEFAULT NULL,
  `f_id` int(10) unsigned DEFAULT NULL,
  `time` varchar(13) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `u_id` (`u_id`),
  KEY `f_id` (`f_id`),
  CONSTRAINT `bee_follow_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `bee_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bee_follow_ibfk_2` FOREIGN KEY (`f_id`) REFERENCES `bee_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bee_follow
-- ----------------------------

-- ----------------------------
-- Table structure for bee_friend
-- ----------------------------
DROP TABLE IF EXISTS `bee_friend`;
CREATE TABLE `bee_friend` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `u_id` int(10) unsigned DEFAULT NULL,
  `f_id` int(10) unsigned DEFAULT NULL,
  `time` varchar(13) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `u_id` (`u_id`),
  KEY `f_id` (`f_id`),
  CONSTRAINT `bee_friend_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `bee_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bee_friend_ibfk_2` FOREIGN KEY (`f_id`) REFERENCES `bee_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bee_friend
-- ----------------------------

-- ----------------------------
-- Table structure for bee_l_b
-- ----------------------------
DROP TABLE IF EXISTS `bee_l_b`;
CREATE TABLE `bee_l_b` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `hot` int(11) DEFAULT '0',
  `u_id` int(11) DEFAULT NULL,
  `time` varchar(13) DEFAULT NULL,
  `b_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  `show` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bee_l_b
-- ----------------------------
INSERT INTO `bee_l_b` VALUES ('9', '我前天失眠到三点，所以决定一定要九点就睡觉！然后……我手贱地打开了这本书……然后……看完已经十二点了……然后……把所有的恋爱过的暗恋过的人都想了一遍……又是两点钟才睡！故事很好看书很漂亮。最关键的是，书里有不少新故事，没发过的！还有长安君的情史！', '7', '3', '1437917885', '55', '！！！！！！！', '5', '1');
INSERT INTO `bee_l_b` VALUES ('10', '我前天失眠到三点，所以决定一定要九点就睡觉！然后……我手贱地打开了这本书……然后……看完已经十二点了……然后……把所有的恋爱过的暗恋过的人都想了一遍……又是两点钟才睡！故事很好看书很漂亮。最关键的是，书里有不少新故事，没发过的！还有长安君的情史！', '7', '3', '1437917922', '59', '！！！！！！！！', '5', '1');
INSERT INTO `bee_l_b` VALUES ('11', '我前天失眠到三点，所以决定一定要九点就睡觉！然后……我手贱地打开了这本书……然后……看完已经十二点了……然后……把所有的恋爱过的暗恋过的人都想了一遍……又是两点钟才睡！故事很好看书很漂亮。最关键的是，书里有不少新故事，没发过的！还有长安君的情史！', '0', '3', '1437918495', '62', '很不错的书', '5', '1');
INSERT INTO `bee_l_b` VALUES ('12', '非常的好看\r\n我前天失眠到三点，所以决定一定要九点就睡觉！然后……我手贱地打开了这本书……然后……看完已经十二点了……然后……把所有的恋爱过的暗恋过的人都想了一遍……又是两点钟才睡！故事很好看书很漂亮。最关键的是，书里有不少新故事，没发过的！还有长安君的情史！', '0', '3', '1437918550', '60', '十分好看的一本书', '5', '1');

-- ----------------------------
-- Table structure for bee_l_r
-- ----------------------------
DROP TABLE IF EXISTS `bee_l_r`;
CREATE TABLE `bee_l_r` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `hot` int(11) DEFAULT '0',
  `u_id` int(11) DEFAULT NULL,
  `time` varchar(13) DEFAULT NULL,
  `m_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  `show` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bee_l_r
-- ----------------------------

-- ----------------------------
-- Table structure for bee_mclassify
-- ----------------------------
DROP TABLE IF EXISTS `bee_mclassify`;
CREATE TABLE `bee_mclassify` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `pid` int(10) unsigned DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bee_mclassify
-- ----------------------------
INSERT INTO `bee_mclassify` VALUES ('1', '类型', '0', '0,');
INSERT INTO `bee_mclassify` VALUES ('2', '国家/地区', '0', '0,');
INSERT INTO `bee_mclassify` VALUES ('3', '年代', '0', '0,');
INSERT INTO `bee_mclassify` VALUES ('4', '中国', '2', '0,2,');
INSERT INTO `bee_mclassify` VALUES ('5', '美国', '2', '0,2,');
INSERT INTO `bee_mclassify` VALUES ('8', '艺术家1', '0', '0,');
INSERT INTO `bee_mclassify` VALUES ('9', '测试', '5', '0,2,5,');
INSERT INTO `bee_mclassify` VALUES ('10', '香港', '2', '0,2,');
INSERT INTO `bee_mclassify` VALUES ('11', '英国', '2', '0,2,');
INSERT INTO `bee_mclassify` VALUES ('12', '韩国', '2', '0,2,');
INSERT INTO `bee_mclassify` VALUES ('13', '印度', '2', '0,2,');
INSERT INTO `bee_mclassify` VALUES ('14', '日本', '2', '0,2,');
INSERT INTO `bee_mclassify` VALUES ('15', '欧洲', '2', '0,2,');
INSERT INTO `bee_mclassify` VALUES ('16', '动作', '1', '0,1,');
INSERT INTO `bee_mclassify` VALUES ('17', '爱情', '1', '0,1,');
INSERT INTO `bee_mclassify` VALUES ('18', '喜剧', '1', '0,1,');
INSERT INTO `bee_mclassify` VALUES ('19', '动画', '1', '0,1,');
INSERT INTO `bee_mclassify` VALUES ('20', '科幻', '1', '0,1,');
INSERT INTO `bee_mclassify` VALUES ('21', '惊悚', '1', '0,1,');
INSERT INTO `bee_mclassify` VALUES ('22', '悬疑', '1', '0,1,');
INSERT INTO `bee_mclassify` VALUES ('23', '搞笑', '1', '0,1,');
INSERT INTO `bee_mclassify` VALUES ('24', '同志', '1', '0,1,');
INSERT INTO `bee_mclassify` VALUES ('25', '1990', '3', '0,3,');
INSERT INTO `bee_mclassify` VALUES ('26', '1991', '3', '0,3,');
INSERT INTO `bee_mclassify` VALUES ('27', '1992', '3', '0,3,');
INSERT INTO `bee_mclassify` VALUES ('28', '1993', '3', '0,3,');
INSERT INTO `bee_mclassify` VALUES ('29', '1994', '3', '0,3,');
INSERT INTO `bee_mclassify` VALUES ('30', '1995', '3', '0,3,');
INSERT INTO `bee_mclassify` VALUES ('31', '1996', '3', '0,3,');
INSERT INTO `bee_mclassify` VALUES ('32', '1997', '3', '0,3,');
INSERT INTO `bee_mclassify` VALUES ('33', '1998', '3', '0,3,');
INSERT INTO `bee_mclassify` VALUES ('34', '1999', '3', '0,3,');
INSERT INTO `bee_mclassify` VALUES ('35', '2000', '3', '0,3,');
INSERT INTO `bee_mclassify` VALUES ('36', '2001', '3', '0,3,');
INSERT INTO `bee_mclassify` VALUES ('37', '2002', '3', '0,3,');
INSERT INTO `bee_mclassify` VALUES ('38', '2003', '3', '0,3,');
INSERT INTO `bee_mclassify` VALUES ('39', '2004', '3', '0,3,');
INSERT INTO `bee_mclassify` VALUES ('40', '2005', '3', '0,3,');
INSERT INTO `bee_mclassify` VALUES ('41', '2006', '3', '0,3,');
INSERT INTO `bee_mclassify` VALUES ('42', '2007', '3', '0,3,');
INSERT INTO `bee_mclassify` VALUES ('43', '2008', '3', '0,3,');
INSERT INTO `bee_mclassify` VALUES ('44', '2009', '3', '0,3,');
INSERT INTO `bee_mclassify` VALUES ('45', '2010', '3', '0,3,');
INSERT INTO `bee_mclassify` VALUES ('46', '2011', '3', '0,3,');
INSERT INTO `bee_mclassify` VALUES ('47', '2012', '3', '0,3,');
INSERT INTO `bee_mclassify` VALUES ('48', '2013', '3', '0,3,');
INSERT INTO `bee_mclassify` VALUES ('49', '2014', '3', '0,3,');
INSERT INTO `bee_mclassify` VALUES ('50', '2015', '3', '0,3,');

-- ----------------------------
-- Table structure for bee_mimage
-- ----------------------------
DROP TABLE IF EXISTS `bee_mimage`;
CREATE TABLE `bee_mimage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `m_id` int(10) unsigned DEFAULT NULL,
  `is_cover` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `m_id` (`m_id`),
  CONSTRAINT `bee_mimage_ibfk_1` FOREIGN KEY (`m_id`) REFERENCES `bee_movie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bee_mimage
-- ----------------------------

-- ----------------------------
-- Table structure for bee_movie
-- ----------------------------
DROP TABLE IF EXISTS `bee_movie`;
CREATE TABLE `bee_movie` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `crelease_t` varchar(255) DEFAULT NULL,
  `orelease_t` varchar(255) DEFAULT NULL,
  `director` varchar(255) DEFAULT NULL,
  `writer` varchar(255) DEFAULT NULL,
  `country` int(10) unsigned DEFAULT NULL,
  `tlong` int(11) DEFAULT NULL,
  `brief` longtext,
  `alias` varchar(255) DEFAULT NULL,
  `year` int(10) unsigned DEFAULT NULL,
  `hot` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `bee_movie_ibfk_1` (`country`),
  KEY `bee_movie_ibfk_2` (`year`),
  CONSTRAINT `bee_movie_ibfk_1` FOREIGN KEY (`country`) REFERENCES `bee_mclassify` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bee_movie_ibfk_2` FOREIGN KEY (`year`) REFERENCES `bee_mclassify` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bee_movie
-- ----------------------------

-- ----------------------------
-- Table structure for bee_photo
-- ----------------------------
DROP TABLE IF EXISTS `bee_photo`;
CREATE TABLE `bee_photo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `time` varchar(13) DEFAULT NULL,
  `a_id` int(10) unsigned DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `is_cover` tinyint(4) DEFAULT '0',
  `descr` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `a_id` (`a_id`),
  CONSTRAINT `bee_photo_ibfk_1` FOREIGN KEY (`a_id`) REFERENCES `bee_album` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bee_photo
-- ----------------------------

-- ----------------------------
-- Table structure for bee_q_a
-- ----------------------------
DROP TABLE IF EXISTS `bee_q_a`;
CREATE TABLE `bee_q_a` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `u_id` int(10) unsigned DEFAULT NULL,
  `q_id` int(10) unsigned DEFAULT NULL,
  `content` varchar(255) NOT NULL,
  `hot` int(11) DEFAULT NULL,
  `time` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `u_id` (`u_id`),
  KEY `q_id` (`q_id`),
  CONSTRAINT `bee_q_a_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `bee_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bee_q_a_ibfk_2` FOREIGN KEY (`q_id`) REFERENCES `bee_u_q` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bee_q_a
-- ----------------------------

-- ----------------------------
-- Table structure for bee_s_b
-- ----------------------------
DROP TABLE IF EXISTS `bee_s_b`;
CREATE TABLE `bee_s_b` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  `hot` int(11) DEFAULT '0',
  `u_id` int(11) DEFAULT NULL,
  `time` varchar(13) DEFAULT NULL,
  `b_id` int(11) DEFAULT NULL,
  `statut` tinyint(4) DEFAULT '0',
  `show` tinyint(4) DEFAULT '1',
  `grade` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bee_s_b
-- ----------------------------
INSERT INTO `bee_s_b` VALUES ('2', 'bee_l_rbee_l_rbee_l_r', '0', '3', '1437641042', '48', '0', '1', null);
INSERT INTO `bee_s_b` VALUES ('3', '莎木莎木莎木莎木', '0', '3', '1437645441', '49', '0', '1', null);
INSERT INTO `bee_s_b` VALUES ('4', 'cescescesces', '0', null, '1437908658', '47', '0', '1', null);
INSERT INTO `bee_s_b` VALUES ('5', '很好看', '0', '3', '1437917876', '55', '0', '1', null);
INSERT INTO `bee_s_b` VALUES ('6', '我前天失眠到三点，所以决定一定要九点就睡觉！然后……我手贱地打开了这本书……然后……看完已经十二点了……然后……把所有的恋爱过的暗恋过的', '0', '3', '1437917914', '59', '0', '1', null);

-- ----------------------------
-- Table structure for bee_s_r
-- ----------------------------
DROP TABLE IF EXISTS `bee_s_r`;
CREATE TABLE `bee_s_r` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  `hot` int(11) DEFAULT '0',
  `u_id` int(11) DEFAULT NULL,
  `time` varchar(13) DEFAULT NULL,
  `m_id` int(11) DEFAULT NULL,
  `statut` tinyint(4) DEFAULT '0',
  `show` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bee_s_r
-- ----------------------------

-- ----------------------------
-- Table structure for bee_tip
-- ----------------------------
DROP TABLE IF EXISTS `bee_tip`;
CREATE TABLE `bee_tip` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `u_id` int(10) unsigned DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `time` varchar(13) DEFAULT NULL,
  `do_id` int(10) unsigned DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `p_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `u_id` (`u_id`),
  KEY `p_id` (`p_id`),
  CONSTRAINT `bee_tip_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `bee_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bee_tip_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `bee_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bee_tip
-- ----------------------------

-- ----------------------------
-- Table structure for bee_user
-- ----------------------------
DROP TABLE IF EXISTS `bee_user`;
CREATE TABLE `bee_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `sex` tinyint(4) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `time` varchar(13) DEFAULT NULL,
  `sign` varchar(255) DEFAULT NULL,
  `introduce` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bee_user
-- ----------------------------
INSERT INTO `bee_user` VALUES ('3', '驰哥带我', '3ff60446bfef736fb0056fe2068bd218', '130345678', '123456@qqq.com', null, null, '1437459993', null, null);

-- ----------------------------
-- Table structure for bee_u_like
-- ----------------------------
DROP TABLE IF EXISTS `bee_u_like`;
CREATE TABLE `bee_u_like` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `u_id` int(10) unsigned DEFAULT NULL,
  `p_id` int(10) unsigned DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `action_id` int(10) unsigned DEFAULT NULL,
  `like_id` int(10) unsigned DEFAULT NULL,
  `time` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bee_u_like
-- ----------------------------
INSERT INTO `bee_u_like` VALUES ('1', null, '0', 'movie', null, '47', '1437908505');
INSERT INTO `bee_u_like` VALUES ('2', null, '0', 'book', null, '47', '1437908585');
INSERT INTO `bee_u_like` VALUES ('4', '3', '0', 'book', null, '60', '1437918530');

-- ----------------------------
-- Table structure for bee_u_q
-- ----------------------------
DROP TABLE IF EXISTS `bee_u_q`;
CREATE TABLE `bee_u_q` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `u_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `time` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `u_id` (`u_id`),
  CONSTRAINT `bee_u_q_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `bee_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bee_u_q
-- ----------------------------
