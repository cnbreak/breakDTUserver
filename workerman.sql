/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50528
Source Host           : localhost:3306
Source Database       : workerman

Target Server Type    : MYSQL
Target Server Version : 50528
File Encoding         : 65001

user: break
Date: 2017-03-26 09:21:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for device
-- ----------------------------
DROP TABLE IF EXISTS `device`;
CREATE TABLE `device` (
  `deviceId` int(10) NOT NULL AUTO_INCREMENT,
  `deviceWorkerId` int(10) NOT NULL,
  `deviceConnectionId` int(10) NOT NULL,
  `deviceConnectionIp` varchar(20) NOT NULL,
  `deviceIdNo` varchar(20) NOT NULL,
  `deviceLastConnectionTime` varchar(20) NOT NULL,
  PRIMARY KEY (`deviceId`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for deviceinfo
-- ----------------------------
DROP TABLE IF EXISTS `deviceinfo`;
CREATE TABLE `deviceinfo` (
  `deviceInfoId` int(10) NOT NULL AUTO_INCREMENT,
  `deviceId` varchar(20) NOT NULL,
  `deviceInfoType` varchar(10) NOT NULL,
  `deviceInfoAddress` varchar(100) NOT NULL,
  `deviceInfoCity` varchar(10) NOT NULL,
  `deviceInfoInstallTime` varchar(20) NOT NULL,
  PRIMARY KEY (`deviceInfoId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
