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