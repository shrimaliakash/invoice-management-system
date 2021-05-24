/*
SQLyog Community Edition- MySQL GUI v8.05 
MySQL - 5.5.16-log : Database - bfsdemo
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `web_marketing` */

DROP TABLE IF EXISTS `web_marketing`;

CREATE TABLE `web_marketing` (
  `name` varchar(50) DEFAULT NULL,
  `val` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `web_marketing` */

insert  into `web_marketing`(`name`,`val`) values ('Direct Sales','20.00');
insert  into `web_marketing`(`name`,`val`) values ('Search Engine Marketing','15.00');
insert  into `web_marketing`(`name`,`val`) values ('PPC Advertising','15.00');
insert  into `web_marketing`(`name`,`val`) values ('Website Marketing','10.00');
insert  into `web_marketing`(`name`,`val`) values ('Blog Marketing','10.00');
insert  into `web_marketing`(`name`,`val`) values ('Social Media Marketing','10.00');
insert  into `web_marketing`(`name`,`val`) values ('Email Marketing','10.00');
insert  into `web_marketing`(`name`,`val`) values ('Online PR','2.50');
insert  into `web_marketing`(`name`,`val`) values ('Multimedia Marketing','2.50');
insert  into `web_marketing`(`name`,`val`) values ('Mobile Marketing','2.50');
insert  into `web_marketing`(`name`,`val`) values ('Display Advertising','2.50');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;