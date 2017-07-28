/*
SQLyog Community v11.51 (64 bit)
MySQL - 10.0.17-MariaDB : Database - msc
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`msc` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `msc`;

/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `kode_barang` char(5) NOT NULL,
  `nama_barang` varchar(25) DEFAULT NULL,
  `gambar` varchar(200) DEFAULT NULL,
  `stok` int(11) DEFAULT '0',
  `harga` int(11) DEFAULT NULL,
  `saldo` int(11) DEFAULT '0',
  PRIMARY KEY (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `barang` */

insert  into `barang`(`kode_barang`,`nama_barang`,`gambar`,`stok`,`harga`,`saldo`) values ('BRG01','Susu','susu.jpg',20,10000,200000),('BRG02','Chocolate','coklat.jpg',40,20000,800000);

/*Table structure for table `jenis` */

DROP TABLE IF EXISTS `jenis`;

CREATE TABLE `jenis` (
  `kode_jenis` char(5) NOT NULL,
  `nama_jenis` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`kode_jenis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `jenis` */

insert  into `jenis`(`kode_jenis`,`nama_jenis`) values ('jns01','Minuman'),('jns02','Makanan');

/*Table structure for table `mutasi` */

DROP TABLE IF EXISTS `mutasi`;

CREATE TABLE `mutasi` (
  `no_transaksi` char(5) NOT NULL,
  `kode_barang` char(5) DEFAULT NULL,
  `keterangan` varchar(25) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `unit` int(11) DEFAULT NULL,
  PRIMARY KEY (`no_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mutasi` */

insert  into `mutasi`(`no_transaksi`,`kode_barang`,`keterangan`,`tanggal`,`unit`) values ('NT001','BRG01','Masuk','2017-06-01',20),('NT002','BRG01','Keluar','2017-06-15',20),('NT003','BRG02','Keluar','2017-06-29',30),('NT004','BRG02','Masuk','2017-06-29',10);

/*Table structure for table `saldo` */

DROP TABLE IF EXISTS `saldo`;

CREATE TABLE `saldo` (
  `kode_barang` char(5) DEFAULT NULL,
  `saldo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `saldo` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
