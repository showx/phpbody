<?php
/*
 * copry right PHPBODY
 */
error_reporting(E_ALL);
define("BODY",1);

//站群相关
define("HOST",$_SERVER['HTTP_HOST']);

//配置文件文件夹
define("SHOWCONFIG",PHPBODY."/show/config");

//模板文件目录
define("SHOWTEMPLATE",PHPBODY."/show/display");

//库文件
define("SHOWLIBRARY",PHPBODY."/show/core/library");

//函数文件 几个工具
define("SHOWFUNCTION",PHPBODY."/show/core/function");

//控制层
define("SHOWCONTROL",PHPBODY."/show/control");

//模型层
define("SHOWMODEL",PHPBODY."/show/model");

include SHOWCONFIG."/database.php";
include SHOWCONFIG."/template.php";
include SHOWLIBRARY."/autoload.lib.php";
include SHOWCONTROL."/base.php";
$GLOBALS['sdb'] = db::i();
include SHOWLIBRARY."/session.lib.php";
$GLOBALS['r'] = new r(); 
global $r,$sdb;
//route
if(!isset($r->get->c))
{
    $home = new home();
    $home->index();
}else{
    if(!isset($r->get->a))
    {
        $r->get->a = 'index';
    }
    try{
        @$tmp = new $r->get->c;
    }catch(Exception $e)
    {
        
    }
    $a = $r->get->a;
    $tmp->$a();
}
?>