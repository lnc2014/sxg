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

/*Table structure for table `sxg_address` */

DROP TABLE IF EXISTS `sxg_address`;

CREATE TABLE `sxg_address` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL COMMENT '用户Id',
  `repair_user_id` int(11) DEFAULT '0' COMMENT '维修人员ID',
  `name` varchar(50) DEFAULT '0' COMMENT '收货人姓名',
  `mobile` varchar(50) DEFAULT '0' COMMENT '收货人电话号码',
  `sex` tinyint(4) DEFAULT '1' COMMENT '性别，1为男，0为女，保留字段',
  `province` varchar(50) DEFAULT '' COMMENT '省份',
  `city` varchar(50) DEFAULT '' COMMENT '城市',
  `area` varchar(50) DEFAULT '' COMMENT '区',
  `street` varchar(100) DEFAULT '' COMMENT '街道',
  `is_default` tinyint(4) DEFAULT '0' COMMENT '1为默认地址，0为一般地址',
  `create_time` int(11) DEFAULT '0' COMMENT '创建时间，时间戳',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间，时间戳',
  PRIMARY KEY (`address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `sxg_address` */

insert  into `sxg_address`(`address_id`,`user_id`,`repair_user_id`,`name`,`mobile`,`sex`,`province`,`city`,`area`,`street`,`is_default`,`create_time`,`update_time`) values (1,'1',0,'李农成','15899872592',1,'广东','深圳','福田区','金融科技大厦',1,1469371486,1469371486);

/*Table structure for table `sxg_admin` */

DROP TABLE IF EXISTS `sxg_admin`;

CREATE TABLE `sxg_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL COMMENT '后台管理员',
  `psw` varchar(50) NOT NULL COMMENT '后台登录密码',
  `parent_id` int(11) DEFAULT NULL COMMENT '上级账号ID，用于子帐号',
  `group_id` varchar(100) NOT NULL COMMENT '用户权限组，使用,分割，主要是用来存储权限组',
  `flag` tinyint(4) DEFAULT '1' COMMENT '是否有效，1有效，0冻结',
  `createtime` int(11) DEFAULT NULL COMMENT '创建时间,存储用时间戳',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `sxg_admin` */

insert  into `sxg_admin`(`id`,`username`,`psw`,`parent_id`,`group_id`,`flag`,`createtime`) values (1,'root','e10adc3949ba59abbe56e057f20f883e',0,'1',1,2147483647),(3,'22','22',1,'1,2,3',1,1461254271),(4,'22','b6d767d2f8ed5d21a44b0e5886680cb9',1,'1,2,3',0,1461254290),(8,'33','182be0c5cdcd5072bb1864cdee4d3d6e',1,'2',1,1461254600),(9,'admin','e10adc3949ba59abbe56e057f20f883e',1,'1,2,4',1,1461254659),(10,'admin','e10adc3949ba59abbe56e057f20f883e',1,'1,2,4',0,1461254694),(11,'admin','e10adc3949ba59abbe56e057f20f883e',1,'1,2,3,4',1,1461254727),(12,'admin','e10adc3949ba59abbe56e057f20f883e',1,'1,2,3,4',1,1461254751),(13,'admin','1dfc1f2c8e8e79447ca5224ca5508f93',1,'2,3,4',1,1461254793),(14,'333','182be0c5cdcd5072bb1864cdee4d3d6e',1,'1',1,1461256281),(15,'22','bcbe3365e6ac95ea2c0343a2395834dd',1,'1,2,3,4',1,1461256310),(17,'lnc','21232f297a57a5a743894a0e4a801fc3',1,'1,2,3,4',1,1461483426);

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

insert  into `sxg_admin_group`(`id`,`group_name`,`acl`,`status_is`,`create_time`) values (1,'订单中心','','Y',2147483647),(2,'用户管理','','Y',2147483647),(3,'运营方案','','Y',2147483647),(4,'数据统计','','Y',2147483647);

/*Table structure for table `sxg_delivery` */

DROP TABLE IF EXISTS `sxg_delivery`;

CREATE TABLE `sxg_delivery` (
  `delivery_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '物流配送Id',
  `company` varchar(50) DEFAULT NULL COMMENT '物流公司',
  `delivery_num` varchar(50) DEFAULT NULL COMMENT '物流单号',
  `delivery_money` decimal(10,2) DEFAULT NULL COMMENT '配送费用',
  `createtime` int(11) DEFAULT NULL COMMENT '物流单号添加时间',
  `updatetime` int(11) DEFAULT NULL COMMENT '物流信息更新时间',
  PRIMARY KEY (`delivery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sxg_delivery` */

/*Table structure for table `sxg_invoice` */

DROP TABLE IF EXISTS `sxg_invoice`;

CREATE TABLE `sxg_invoice` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '发票Id',
  `address_id` int(11) DEFAULT '0' COMMENT '地址ID',
  `user_id` int(11) DEFAULT '0' COMMENT '发票申请人',
  `invoice_header` varchar(50) DEFAULT '' COMMENT '发票抬头',
  `invoice_content` varchar(100) DEFAULT '' COMMENT '发票内容',
  `invoice_money` decimal(10,2) DEFAULT '0.00' COMMENT '发票金额',
  `delivery_way` tinyint(4) DEFAULT '1' COMMENT '配送方式，1为人工送达，2为物流，默认为人工',
  `delivery_id` int(11) DEFAULT '0' COMMENT '物流信息ID',
  `createtime` int(11) DEFAULT NULL COMMENT '发票申请时间',
  `updatetime` int(11) DEFAULT NULL COMMENT '发票审核更新时间',
  `status` tinyint(4) DEFAULT '1' COMMENT '1、受理中2、已开票（配送中）3、已完成',
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `sxg_invoice` */

insert  into `sxg_invoice`(`invoice_id`,`address_id`,`user_id`,`invoice_header`,`invoice_content`,`invoice_money`,`delivery_way`,`delivery_id`,`createtime`,`updatetime`,`status`) values (1,1,1,'我是来测试的','我是来测试的','12.00',1,1,1467117059,1467117059,2),(2,2,1,'1','1','12.00',1,1,1467117059,1467117059,1),(3,2,1,'1','1','12.00',1,1,1467117059,1467117059,2),(4,2,1,'1','1','425.00',1,1,1467117059,1467117059,3);

/*Table structure for table `sxg_order` */

DROP TABLE IF EXISTS `sxg_order`;

CREATE TABLE `sxg_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_no` varchar(50) NOT NULL DEFAULT '' COMMENT '订单编号',
  `user_id` varchar(50) NOT NULL DEFAULT '0' COMMENT '下单用户Id',
  `is_transfer` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否转单，1为转单，0为不转单，默认为0',
  `trasfer_repair_user_id` int(11) NOT NULL DEFAULT '0' COMMENT '转单维修人员Id',
  `repair_info_id` int(11) NOT NULL DEFAULT '0' COMMENT '维修单ID，用于记录维修的详细信息',
  `print_band` varchar(50) NOT NULL DEFAULT '' COMMENT '报修机器品牌',
  `print_model` varchar(50) NOT NULL DEFAULT '' COMMENT '报修机器型号',
  `repair_option` varchar(50) NOT NULL DEFAULT '' COMMENT '报修的选项：0001加粉（加墨）;0002打印质量差（需要拍照上传质量差页）;0003不能开机;0004卡纸',
  `repair_problem` varchar(200) NOT NULL DEFAULT '' COMMENT '报修的内容',
  `repair_pic` text NOT NULL COMMENT '报修的图片地址，多张图片使用;分割来',
  `address_id` int(11) NOT NULL DEFAULT '0' COMMENT '维修地址Id',
  `repair_assign` tinyint(4) NOT NULL DEFAULT '1' COMMENT '维修人员指定，1为随机指派，2为指定维修人员，默认为1',
  `repair_user_id` int(11) NOT NULL DEFAULT '0' COMMENT '维修人员Id',
  `visit_option` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1为跟维修人员商定，2为指定时间,3为立即上门',
  `visit_time` int(11) NOT NULL DEFAULT '0' COMMENT '指定上门的时间',
  `is_pay` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是不是已经结款，0为未结款，1为结款',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1,待接单2，待上门3,检测中4,调配件5,维修中6,待点评7,已结束8,已取消',
  `repair_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '维修费用',
  `createtime` int(11) NOT NULL DEFAULT '0' COMMENT '下单时间',
  `updatetime` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间，订单完成时间',
  `remark` varchar(500) NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `order_no` (`order_no`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

/*Data for the table `sxg_order` */

insert  into `sxg_order`(`id`,`order_no`,`user_id`,`is_transfer`,`trasfer_repair_user_id`,`repair_info_id`,`print_band`,`print_model`,`repair_option`,`repair_problem`,`repair_pic`,`address_id`,`repair_assign`,`repair_user_id`,`visit_option`,`visit_time`,`is_pay`,`status`,`repair_money`,`createtime`,`updatetime`,`remark`) values (1,'NO201605011213232','1',0,1,1,'1','1','','1','',1,1,1,1,0,0,1,'2.00',0,0,''),(2,'NO201605011213232','1',0,1,0,'1','1','','1','',1,1,1,1,0,0,7,'2.00',1469279068,0,''),(3,'NO201605011213232','1',0,1,0,'1','1','0001,0002,0003,0004','1','',1,1,1,1,0,1,5,'7.00',1469279068,0,''),(5,'SXG2016062117455857117','1',0,0,0,'','','1,1,1,0','','',0,1,0,1,0,0,2,'0.00',1466523958,1466523958,''),(6,'SXG2016062117473575148','1',0,0,0,'','','0001,0002,0003,0004','','',0,1,0,1,0,0,3,'0.00',1466524055,1466524055,''),(7,'SXG2016062117502957916','1',0,0,0,'','','0001,0002,0003,0004','','',0,1,0,1,0,0,5,'0.00',1466524229,1466524229,''),(8,'SXG2016062117504433950','1',0,0,0,'','','0001,0002,00004','','',0,1,0,1,0,0,4,'0.00',1466524244,1466524244,''),(9,'SXG2016062117524833477','1',0,0,0,'222','222','0001,0002,00004','','',0,1,0,1,0,0,3,'0.00',1466524368,1466524368,''),(10,'SXG2016062117535277359','1',0,0,0,'222','222','0001,0002,00004','','',0,1,0,1,0,0,1,'0.00',1466524432,1466524432,''),(11,'SXG2016062117555823724','1',0,0,0,'惠普','2003','0001,0002,00004','','',0,1,0,1,0,0,6,'0.00',1466524558,1466524558,''),(12,'SXG2016062613271180221','1',0,0,0,'联想','联想2016','0001,0002,0003,0','','static/upload/20160626/20160626132641_185.jpg;static/upload/20160626/20160626132645_567.jpg',7,1,0,1,0,0,7,'0.00',1469279068,1466924487,'希望快点来'),(13,'','',0,0,0,'','','','','',0,1,0,1,0,0,1,'0.00',1469279068,0,''),(14,'SXG2016072315042880653','1',0,0,0,'联想','45623','0001,0002,0003,0004','看能不能报修成功','static/upload/20160723/20160723150048_585.png;static/upload/20160723/20160723150052_798.png',3,1,0,1,0,0,1,'0.00',1469279068,1469281107,''),(15,'SXG2016072416112774231','1',0,0,0,'','','0001,0002,0003,0004','','static/upload/20160724/20160724161120_655.jpg',3,1,0,1,0,0,1,'0.00',1469369487,1469369512,''),(16,'SXG2016072416185945441','1',0,0,0,'','','0001,0002,00','','static/upload/20160724/20160724161857_110.jpg',0,1,0,1,0,0,1,'0.00',1469369939,1469369939,''),(17,'SXG2016072416193982196','1',0,0,0,'','','0001,0002,00','','',0,1,0,1,0,0,1,'0.00',1469369979,1469369979,''),(18,'SXG2016072416200386154','1',0,0,0,'','','0001,0002,00','','',0,1,0,1,0,0,1,'0.00',1469370003,1469370003,''),(19,'SXG2016072416202388598','1',0,0,0,'','','0001,0002,00','','',0,1,0,1,0,0,1,'0.00',1469370023,1469370023,''),(20,'SXG2016072416210114784','1',0,0,0,'','','0001,0002,00','','',0,1,0,1,0,0,1,'0.00',1469370061,1469370061,''),(21,'SXG2016072416212073234','1',0,0,0,'','','0001,0002,00','','',0,1,0,1,0,0,1,'0.00',1469370080,1469370080,''),(22,'SXG2016072416213064129','1',0,0,0,'','','0001,0002,00','','',0,1,0,1,0,0,1,'0.00',1469370090,1469370090,''),(23,'SXG2016072416220454662','1',0,0,0,'','','0001,0002,00','','',0,1,0,1,0,0,1,'0.00',1469370124,1469370124,''),(24,'SXG2016072416221856301','1',0,0,0,'','','0001,0002,00','','',0,1,0,1,0,0,1,'0.00',1469370138,1469370138,''),(25,'SXG2016072416413577401','1',0,0,0,'','','0001,0002,0003,0004','','',0,1,0,1,0,0,1,'0.00',1469371295,1469371295,''),(26,'SXG2016072416423149081','1',0,0,0,'联系','景姐姐','0001,0002,0003,0004','就是用来测试的','',10,2,123456,1,0,0,1,'0.00',1469371351,1469371494,''),(27,'SXG2016073110170462992','1',0,0,0,'联想','惠普D123','0001,0002,0003,0','','',0,1,0,1,0,0,1,'0.00',1469953024,1469953024,''),(28,'SXG2016073111151363629','1',0,0,0,'联想','惠普D123','0001,0002,00','','static/upload/20160731/20160731111252_846.jpg;static/upload/20160731/20160731111308_989.gif;static/upload/20160731/20160731111313_100.jpg',10,1,0,1,1469927040,0,1,'0.00',1469956513,1469957116,''),(29,'SXG2016073117145977151','1',0,0,0,'惠普','惠普DD123456','0001,0002,0003,0004','','static/upload/20160731/20160731171450_342.jpg;static/upload/20160731/20160731171455_545.jpg',10,2,123456,1,0,0,1,'0.00',1469978099,1469978115,''),(30,'SXG2016073117363579576','1',0,0,0,'惠普','惠普DD123456','0001,0002,0003,0004','','',0,1,0,1,0,0,1,'0.00',1469979395,1469979395,''),(31,'SXG2016080817023116514','1',0,0,0,'惠普','惠普DD123456','0001,0002','','',10,1,0,1,0,0,1,'0.00',1470668551,1470668553,''),(32,'SXG2016081309414064277','1',0,0,0,'惠普','惠普DD123456','0001,0002,0003,0004','','',0,1,0,1,0,0,1,'0.00',1471074100,1471074100,''),(33,'NO201605011213232','1',0,1,0,'1','1','','1','',1,1,1,1,0,0,6,'2.00',0,0,''),(34,'NO201605011213232','1',0,1,1,'1','1','0001,0002,0003,0004','1','',1,1,1,1,0,1,7,'7.00',1469279068,0,''),(35,'','',0,0,0,'','','','','',0,1,0,1,0,0,5,'0.00',0,0,'');

/*Table structure for table `sxg_repair_info` */

DROP TABLE IF EXISTS `sxg_repair_info`;

CREATE TABLE `sxg_repair_info` (
  `repair_info_id` int(11) NOT NULL AUTO_INCREMENT,
  `repair_band` varchar(100) NOT NULL DEFAULT '' COMMENT '维修品牌',
  `repair_model` varchar(100) NOT NULL DEFAULT '' COMMENT '维修型号',
  `repair_problem` varchar(200) NOT NULL DEFAULT '' COMMENT '维修故障现象',
  `is_change_parts` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '是否更换了配件',
  `parts_name` varchar(100) NOT NULL DEFAULT '' COMMENT '配件/耗材名称',
  `labor_cost` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '人工费',
  `parts_cost` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '配件费',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`repair_info_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `sxg_repair_info` */

insert  into `sxg_repair_info`(`repair_info_id`,`repair_band`,`repair_model`,`repair_problem`,`is_change_parts`,`parts_name`,`labor_cost`,`parts_cost`,`create_time`,`update_time`) values (1,'联想','联想A2500','不能打印',1,'不知道','100.00','20.00',0,0);

/*Table structure for table `sxg_repair_user` */

DROP TABLE IF EXISTS `sxg_repair_user`;

CREATE TABLE `sxg_repair_user` (
  `repair_user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '维修人员id',
  `repair_info_id` int(11) NOT NULL DEFAULT '0' COMMENT '维修单ID，用于记录维修的详细信息',
  `account` varchar(50) NOT NULL DEFAULT '' COMMENT '账号',
  `psw` varchar(50) NOT NULL DEFAULT '' COMMENT '密码',
  `mobile` varchar(50) NOT NULL DEFAULT '' COMMENT '电话号码',
  `address_id` int(11) DEFAULT '0' COMMENT '地址信息',
  `id_card` varchar(50) DEFAULT '0' COMMENT '身份证号码',
  `repair_num` varchar(50) DEFAULT '0' COMMENT '工号',
  `user_name` varchar(50) DEFAULT '0' COMMENT '姓名',
  `score` decimal(10,2) DEFAULT '0.00' COMMENT '评分',
  `commission` decimal(10,2) DEFAULT '0.00' COMMENT '累计佣金',
  `order_num` int(11) DEFAULT '0' COMMENT '接单总数量',
  `trans_num` int(11) DEFAULT '0' COMMENT '转单总数量',
  `bank_card_no` varchar(50) DEFAULT '0' COMMENT '银行卡号',
  `bank_name` varchar(50) DEFAULT '0' COMMENT '银行名称',
  `bank_type` varchar(50) DEFAULT '0' COMMENT '开户行名称',
  `id_card_pic_face` varchar(100) DEFAULT '' COMMENT '身份证正面照片',
  `id_card_pic_fan` varchar(100) DEFAULT '' COMMENT '身份证反面照片',
  `qualification_pic` varchar(100) DEFAULT '' COMMENT '资历证明图片',
  `good_print_band` varchar(100) DEFAULT '' COMMENT '擅长维修的品牌',
  `good_print_type` varchar(100) DEFAULT '' COMMENT '擅长维修的型号',
  `create_time` int(11) DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) DEFAULT '0' COMMENT '修改时间',
  `status` tinyint(4) DEFAULT '2' COMMENT '维修人员状态，1为正常，2为待审核，0为冻结',
  `flag` tinyint(4) DEFAULT '1' COMMENT '标识，1为有效，0为无效',
  PRIMARY KEY (`repair_user_id`),
  KEY `mobile` (`account`,`mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `sxg_repair_user` */

insert  into `sxg_repair_user`(`repair_user_id`,`repair_info_id`,`account`,`psw`,`mobile`,`address_id`,`id_card`,`repair_num`,`user_name`,`score`,`commission`,`order_num`,`trans_num`,`bank_card_no`,`bank_name`,`bank_type`,`id_card_pic_face`,`id_card_pic_fan`,`qualification_pic`,`good_print_band`,`good_print_type`,`create_time`,`update_time`,`status`,`flag`) values (1,0,'15899872592','e10adc3949ba59abbe56e057f20f883e','15899872592',0,'0','89854212','李农成','0.00','0.00',0,0,'0','0','0','',NULL,NULL,'','',0,0,NULL,1);

/*Table structure for table `sxg_user` */

DROP TABLE IF EXISTS `sxg_user`;

CREATE TABLE `sxg_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL DEFAULT '' COMMENT '账号',
  `wx_openid` varchar(100) NOT NULL DEFAULT '' COMMENT '微信open_id',
  `headimgurl` varchar(150) NOT NULL DEFAULT '' COMMENT '微信头像',
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '电话号码',
  `password` varchar(50) DEFAULT '0' COMMENT '保留字段，密码',
  `is_month` tinyint(4) DEFAULT '0' COMMENT '是否月结，1为月结，0为不是月结',
  `create_time` int(11) DEFAULT '0' COMMENT '创建时间',
  `status` tinyint(4) DEFAULT '1' COMMENT '状态，1为正常，0为冻结',
  `flag` tinyint(4) DEFAULT '1' COMMENT '是否有效，1有效。',
  `last_band` varchar(50) NOT NULL DEFAULT '' COMMENT '用户第一次报修的报修机器品牌',
  `last_model` varchar(50) NOT NULL DEFAULT '' COMMENT '用户第一次报修的报修机器型号',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `sxg_user` */

insert  into `sxg_user`(`user_id`,`user_name`,`wx_openid`,`headimgurl`,`mobile`,`password`,`is_month`,`create_time`,`status`,`flag`,`last_band`,`last_model`) values (1,'小明','ohoNsuGpFYcqe6AWeJ9plmVAir5A','http://wx.qlogo.cn/mmopen/C6nnRGnPbvzajew4VicW87DgjeLyIfIg9b0VaVp15xibDPqjUAg6GB9Y4RWSS4c6mLliae6Ue8ibg99loTibIvcQB0w/0','15899872592','0',0,1469272097,1,1,'惠普','惠普DD123456');

/*Table structure for table `sxg_user_feedback` */

DROP TABLE IF EXISTS `sxg_user_feedback`;

CREATE TABLE `sxg_user_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '反馈账号Id',
  `mobile` varchar(50) DEFAULT NULL COMMENT '反馈电话号码',
  `content` longtext COMMENT '反馈内容',
  `feedback_time` int(11) DEFAULT NULL COMMENT '反馈时间,时间戳',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `sxg_user_feedback` */

insert  into `sxg_user_feedback`(`id`,`user_id`,`mobile`,`content`,`feedback_time`) values (1,1,'15899872592',NULL,NULL),(2,1,NULL,'wedwewe',1467114522),(3,1,'15899872592','ssdsd',1467114612),(4,1,'15899872592','sdsd',1467114643),(5,1,'15899872592','我是来提建议的',1467114724),(6,1,'15899872592','是是是',1467114793),(7,1,'15899872592','s是是是',1467114836),(8,1,'15899872592','w问问',1467114948),(9,1,'15899872592','s试试',1467114956),(10,1,'15899872592','s是',1467114998),(11,1,'15899872592','s是',1467115012),(12,1,'15899872592','s试试',1467115042),(13,1,'15899872592','是',1467115080),(14,1,'15899872592','s是是是',1467115197),(15,1,'15899872592','w  二',1467115249),(16,1,'15899872592','死死死死死死',1467115342),(17,1,'15899872592','飒飒飒飒',1467115356),(18,1,NULL,'你好',1469371799),(19,1,NULL,'你好',1469371800),(20,1,NULL,'你好',1469371854),(21,1,'','你好',1469372012),(22,1,'','我来测试的',1469978262);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
