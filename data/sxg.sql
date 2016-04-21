/*
SQLyog Ultimate v11.27 (32 bit)
MySQL - 5.6.17 : Database - shanxiuge
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`shanxiuge` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `shanxiuge`;

/*Table structure for table `sxg_admin` */

DROP TABLE IF EXISTS `sxg_admin`;

CREATE TABLE `sxg_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL COMMENT '后台管理员',
  `psw` varchar(50) NOT NULL COMMENT '后台登录密码',
  `parent_id` int(11) DEFAULT NULL COMMENT '上级账号ID，用于子帐号',
  `group_id` int(11) NOT NULL DEFAULT '1' COMMENT '用户权限组，1为普通，其他的对应group表',
  `flag` tinyint(4) DEFAULT '1' COMMENT '是否有效，1有效，0冻结',
  `createtime` int(11) DEFAULT NULL COMMENT '创建时间,存储用时间戳',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `sxg_admin` */

insert  into `sxg_admin`(`id`,`username`,`psw`,`parent_id`,`group_id`,`flag`,`createtime`) values (1,'root','e10adc3949ba59abbe56e057f20f883e',0,1,1,2147483647);

/*Table structure for table `sxg_admin_group` */

DROP TABLE IF EXISTS `sxg_admin_group`;

CREATE TABLE `sxg_admin_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) NOT NULL COMMENT '组名称',
  `acl` text NOT NULL COMMENT '权限',
  `status_is` enum('Y','N') NOT NULL DEFAULT 'Y' COMMENT '状态',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间，时间戳',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='管理员组';

/*Data for the table `sxg_admin_group` */

insert  into `sxg_admin_group`(`id`,`group_name`,`acl`,`status_is`,`create_time`) values (1,'3','','Y',2147483647),(2,'w','','Y',2147483647),(3,'w','','Y',2147483647),(4,'','','Y',2147483647);

/*Table structure for table `sxg_repair_user` */

DROP TABLE IF EXISTS `sxg_repair_user`;

CREATE TABLE `sxg_repair_user` (
  `repair_user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '维修人员id',
  `account` varchar(50) NOT NULL COMMENT '账号',
  `mobile` varchar(50) DEFAULT NULL COMMENT '电话号码',
  `repair_num` varchar(50) DEFAULT NULL COMMENT '工号',
  `user_name` varchar(50) DEFAULT NULL COMMENT '姓名',
  `score` decimal(10,2) DEFAULT NULL COMMENT '评分',
  `commission` decimal(10,2) DEFAULT NULL COMMENT '累计佣金',
  `order_num` int(11) DEFAULT NULL COMMENT '接单总数量',
  `trans_num` int(11) DEFAULT NULL COMMENT '转单总数量',
  `status` tinyint(4) DEFAULT NULL COMMENT '维修人员状态，1为正常，2为待审核，0为冻结',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NULL DEFAULT NULL COMMENT '修改时间',
  `flag` tinyint(4) DEFAULT '1' COMMENT '标识，1为有效，0为无效',
  PRIMARY KEY (`repair_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sxg_repair_user` */

/*Table structure for table `sxg_user` */

DROP TABLE IF EXISTS `sxg_user`;

CREATE TABLE `sxg_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL COMMENT '账号',
  `mobile` varchar(20) DEFAULT NULL COMMENT '电话号码',
  `password` varchar(50) DEFAULT NULL COMMENT '保留字段，密码',
  `address_id` int(11) DEFAULT NULL COMMENT '用户地址信息',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `status` tinyint(4) DEFAULT '1' COMMENT '状态，1为正常，0为冻结',
  `flag` tinyint(4) DEFAULT '1' COMMENT '是否有效，1有效。',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sxg_user` */

/*Table structure for table `sxg_user_feedback` */

DROP TABLE IF EXISTS `sxg_user_feedback`;

CREATE TABLE `sxg_user_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) DEFAULT NULL COMMENT '反馈账号',
  `mobile` varchar(50) DEFAULT NULL COMMENT '反馈电话号码',
  `content` longtext COMMENT '反馈内容',
  `feedback_time` int(11) DEFAULT NULL COMMENT '反馈时间,时间戳',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sxg_user_feedback` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
