<?php
header("Content-type:text/html;charset=utf-8");
define("PHPBODY",dirname(__FILE__));
define("SHOWCONFIG",PHPBODY."/show/config");
define("SHOWLIBRARY",PHPBODY."/show/core/library");
include SHOWCONFIG."/database.php";
include SHOWLIBRARY."/db.lib.php";
if(file_exists(PHPBODY."/install.lok"))
{
    echo "It's installed...";exit();
}
$GLOBALS['sdb'] = db::i();
global $sdb;
$sql=<<<EOF
DROP TABLE IF EXISTS `show_admin`;
CREATE TABLE `show_admin` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(255) default NULL,
  `password` varchar(255) default NULL,
  `type` int(11) default NULL,
  `mcrypt` varchar(255) default NULL,
  `groupdid` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
INSERT INTO show_admin VALUES ('1', 'admin', '584efbd5d11809943039e71845b0cd7', '1', 'show','1');

DROP TABLE IF EXISTS `show_category`;
CREATE TABLE `show_category` (
  `id` int(11) NOT NULL auto_increment,
  `parentid` int(11) default '0',
  `name` varchar(255) default NULL,
  `template` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `show_content`;
CREATE TABLE `show_content` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) default NULL,
  `content` text,
  `type` int(11) default NULL,
  `categoryid` int(11) default NULL,
  `tags` varchar(255) default NULL,
  `timestamp` int(11) default NULL,
  `uptime` int(11) default NULL,
  `listorder` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `show_session`;
CREATE TABLE `show_session` (
  `id` varchar(255) NOT NULL default '',
  `data` varchar(255) default NULL,
  `lastaccess` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `show_subsite`;
CREATE TABLE `show_subsite` (
  `id` int(11) default NULL auto_increment,
  `name` varchar(255) default NULL,
  `data` text,
  `timestamp` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `show_group`;
CREATE TABLE `show_group` (
  `groupid` int(11) NOT NULL auto_increment,
  `groupname` varchar(255) default NULL,
  `xian` varchar(255) default NULL,
  PRIMARY KEY  (`groupid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO show_group VALUES ('1', '管理组', '');
DROP TABLE IF EXISTS `show_menu`;
CREATE TABLE `show_menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `english` varchar(255) DEFAULT NULL,
  `parentid` int(11) DEFAULT NULL,
  `listorder` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
INSERT INTO `show_menu` VALUES ('1', '根目录', 'menu', '0', null), ('2', '简介', 'jianjie', '1', null);
DROP TABLE IF EXISTS `show_debug`;
CREATE TABLE `show_debug` (
  `url` varchar(255) DEFAULT NULL,
  `get` text,
  `post` text,
  `timestamp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `show_users`;
CREATE TABLE `show_users` (
  `id` int(11) NOT NULL default '0',
  `username` varchar(255) default NULL,
  `password` varchar(255) default NULL,
  `mcrypt` varchar(255) default NULL,
  `timestamp` int(11) default NULL,
  `lasttime` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `show_comment`;
CREATE TABLE `show_comment` (
  `id` int(11) default NULL,
  `username` varchar(255) default NULL,
  `content` text,
  `timestamp` int(11) default NULL,
  `title` varchar(255) default NULL,
  `touser` int(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `show_config`;
CREATE TABLE `show_config` (
  `id` int(11) NOT NULL default '0',
  `keys` varchar(255) default NULL,
  `values` varchar(255) default NULL,
  `timestamp` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `show_links`;
CREATE TABLE `show_links` (
  `id` int(11) NOT NULL default '0',
  `title` varchar(255) default NULL,
  `url` varchar(255) default NULL,
  `type` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `show_rbac`;
CREATE TABLE `show_rbac` (
  `id` int(11) NOT NULL DEFAULT '0' auto_increment,
  `name` varchar(255) DEFAULT NULL,
  `control` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `parentct` int(11) DEFAULT NULL,
  `parentctname` varchar(255) DEFAULT NULL,
  `notyz` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
EOF;
$data = explode(";", $sql);
foreach($data as $sql)
{
    if(!empty($sql))
    {
        $sdb->query($sql);
    }
}
file_put_contents(PHPBODY."/install.lok", "ok");
echo "安装完成<a href='index.php'>返回首页</a>&nbsp;<a href='admin.php'>进入后台</a>";
?>