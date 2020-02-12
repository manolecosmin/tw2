# HeidiSQL Dump 
#
# --------------------------------------------------------
# Host:                 localhost
# Database:             logistica
# Server version:       5.0.18-nt-max
# Server OS:            Win32
# max_allowed_packet:   1048576
# HeidiSQL version:     3.0 RC3 Revision: 111
# --------------------------------------------------------

/*!40100 SET CHARACTER SET latin1;*/


#
# Database structure for database 'logistica'
#

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `logistica` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `logistica`;


#
# Table structure for table 'dist_tarif'
#

CREATE TABLE /*!32312 IF NOT EXISTS*/ `dist_tarif` (
  `baza` char(20) NOT NULL default '',
  `jud_b` char(10) default NULL,
  `dest` char(20) default NULL,
  `jud_d` char(10) default NULL,
  `ruta` char(60) default NULL,
  `km_r` double default '0',
  `km_t` double default '0',
  KEY `baza` (`baza`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



#
# Table structure for table 'livrari'
#

CREATE TABLE /*!32312 IF NOT EXISTS*/ `livrari` (
  `id` int(6) unsigned NOT NULL auto_increment,
  `client` char(40) default NULL,
  `produs` char(60) default NULL,
  `cantitate` double default NULL,
  `data_cmd` date default NULL,
  `localit` char(60) default NULL,
  `termen` date default NULL,
  `moneda` char(3) default 'EUR',
  `pret` double default NULL,
  `confirmat` enum('D','N') default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



#
# Table structure for table 'livrari_ext'
#

CREATE TABLE /*!32312 IF NOT EXISTS*/ `livrari_ext` (
  `id` int(6) unsigned NOT NULL auto_increment,
  `client` char(40) default NULL,
  `produs` char(60) default NULL,
  `cantitate` double default NULL,
  `data_cmd` date default NULL,
  `termen` date default NULL,
  `pret` double default NULL,
  `moneda` char(3) default 'EUR',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



#
# Table structure for table 'locatii'
#

CREATE TABLE /*!32312 IF NOT EXISTS*/ `locatii` (
  `id` smallint(6) unsigned NOT NULL auto_increment,
  `denumire` char(40) default NULL,
  `adresa` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



#
# Table structure for table 'plan'
#

CREATE TABLE /*!32312 IF NOT EXISTS*/ `plan` (
  `id` int(6) unsigned NOT NULL auto_increment,
  `pid` int(6) unsigned NOT NULL default '0',
  `client` char(40) default NULL,
  `produs` char(60) default NULL,
  `cant` double default '0',
  `dord` tinyint(3) unsigned default '0',
  `locat` char(60) default NULL,
  `data_l` date default NULL,
  `moneda` char(3) default NULL,
  `data_c` date default NULL,
  `pret` double default '0',
  `inchis` tinyint(3) unsigned default '0',
  `factura` char(24) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



#
# Table structure for table 'plan_ext'
#

CREATE TABLE /*!32312 IF NOT EXISTS*/ `plan_ext` (
  `id` int(6) unsigned NOT NULL default '0',
  `pid` int(6) unsigned NOT NULL default '0',
  `client` char(40) default NULL,
  `produs` char(60) default NULL,
  `cant` double default '0',
  `data_l` date default NULL,
  `data_c` date default NULL,
  `pret` double default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



#
# Table structure for table 'plan_hdr'
#

CREATE TABLE /*!32312 IF NOT EXISTS*/ `plan_hdr` (
  `id` int(6) unsigned NOT NULL auto_increment,
  `data` date NOT NULL,
  `tr_id` int(6) unsigned NOT NULL,
  `auto` char(12) default NULL,
  `sofer` char(40) default NULL,
  `tel` char(16) default NULL,
  `km` int(6) unsigned default '0',
  `pret_km` double default '0',
  `cursv` double default '0',
  `factura` char(24) default NULL,
  `inchis` tinyint(3) unsigned default '0',
  PRIMARY KEY  (`id`),
  KEY `plh` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



#
# Table structure for table 'plan_hdr_ext'
#

CREATE TABLE /*!32312 IF NOT EXISTS*/ `plan_hdr_ext` (
  `id` int(6) unsigned NOT NULL auto_increment,
  `data` date NOT NULL default '0000-00-00',
  `tr_id` int(6) unsigned NOT NULL default '0',
  `auto` char(24) default NULL,
  `sofer` char(40) default NULL,
  `tel` char(16) default NULL,
  `tara` char(24) default NULL,
  `pret_km` double default '0',
  `locatie` char(60) default NULL,
  `descarcare` char(60) default NULL,
  `inchis` tinyint(3) unsigned default '0',
  PRIMARY KEY  (`id`),
  KEY `plh` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



#
# Table structure for table 'prod_it'
#

CREATE TABLE /*!32312 IF NOT EXISTS*/ `prod_it` (
  `Art` int(11) default NULL,
  `den_it` varchar(100) default NULL,
  `den_ro` varchar(75) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



#
# Table structure for table 'stoc'
#

CREATE TABLE /*!32312 IF NOT EXISTS*/ `stoc` (
  `articol` char(60) default NULL,
  `um` char(10) default NULL,
  `stoc` double default NULL,
  KEY `articol` (`articol`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



#
# Table structure for table 'trans_a'
#

CREATE TABLE /*!32312 IF NOT EXISTS*/ `trans_a` (
  `id` mediumint(6) unsigned NOT NULL auto_increment,
  `tr_id` mediumint(6) unsigned NOT NULL default '0',
  `nr_auto` char(10) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



#
# Table structure for table 'trans_s'
#

CREATE TABLE /*!32312 IF NOT EXISTS*/ `trans_s` (
  `id` mediumint(6) unsigned NOT NULL auto_increment,
  `tr_id` mediumint(6) unsigned NOT NULL,
  `sofer` char(32) default NULL,
  `tel` char(14) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



#
# Table structure for table 'trasport'
#

CREATE TABLE /*!32312 IF NOT EXISTS*/ `trasport` (
  `id` int(6) unsigned NOT NULL auto_increment,
  `tip` tinyint(3) unsigned default '0',
  `data_a` date default NULL,
  `den` varchar(40) default NULL,
  `cui` varchar(14) NOT NULL default '',
  `reg_com` varchar(20) default NULL,
  `pers_c` varchar(40) default NULL,
  `tel` varchar(16) default '0',
  `fax` varchar(16) default NULL,
  `mobil` varchar(16) default NULL,
  `e_mail` varchar(40) default NULL,
  `local` varchar(25) default NULL,
  `judet` varchar(25) default NULL,
  `adresa` text,
  `obs` text,
  `pret_km` double default '0',
  `c1` tinyint(3) unsigned default '0',
  `c2` tinyint(3) unsigned default '0',
  `c3` tinyint(3) unsigned default '0',
  `c4` tinyint(3) unsigned default '0',
  `c5` tinyint(3) unsigned default '0',
  `c6` tinyint(3) unsigned default '0',
  `c7` tinyint(3) unsigned default '0',
  `c8` tinyint(3) unsigned default '0',
  `c9` tinyint(3) unsigned default '0',
  `clasa` tinyint(3) unsigned default '0',
  `mod_plata` char(40) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Transportatori';

