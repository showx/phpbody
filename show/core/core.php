<?php
/*
 * 核心加载
 * Author show 
 * copry right PHPBODY (www.phpbody.com)
 */
//error_reporting(E_ALL);
date_default_timezone_set ('Asia/Shanghai');
define("BODY",1);
define("SHOWCONFIG",PHPBODY."/show/config");
define("SHOWLIBRARY",PHPBODY."/show/core/library");
define("SHOWFUNCTION",PHPBODY."/show/core/function");
//控制层
define("SHOWCONTROL",PHPBODY."/show/control");
//模型层
define("SHOWMODEL",PHPBODY."/show/model");
include SHOWLIBRARY."/autoload.lib.php";
include SHOWCONFIG."/config.php";
include SHOWCONFIG."/cache.php";
include PHPBODY."/show/core/cfun.php";
include SHOWCONFIG."/database.php";
$GLOBALS['sdb'] = db::i();
if(PHP_SAPI!=='cli') //主要用于跑取cron 或 处理数据用
{
    //站群相关
    define("HOST",$_SERVER['HTTP_HOST']);
    //模板文件目录
    define("SHOWTEMPLATE",PHPBODY."/show/display");
    include SHOWLIBRARY."/session.lib.php";
    include SHOWCONFIG."/template.php";
    /**
     * 异常处理
     */
    function exception($e)
    {
        if(is_object($e))
        {
            echo "<div><b>show:</b> ".$e->getLine().":".$e->getMessage()."<br/>-------------".$e->getFile()."</div>";
        }
    }
    set_exception_handler('exception');
    set_error_handler('exception', E_ALL);
}else{
    if(count($argv)>2)
    {
        $_GET['c'] = $argv['1'];
        $_GET['a'] = $argv['2'];
    }
}
    $GLOBALS['r'] = new r(); 
    global $r,$sdb;
    //route
    if(!isset($r->req->c))
    {
        // rbac::Check('home','index');
        $home = new home();
        if(!isset($r->req->a))
        {
            $home->index();
        }else{
            $t = $r->req->a;
            $home->$t();  //没必要不显示warning
        }
    }else{
        if(!isset($r->get->a))
        {
            $r->get->a = 'index';
        }
        try{
            $tmp = new $r->get->c;
        }catch(Exception $e)
        {
            echo 'no hack';exit();
        }
        $a = $r->get->a;
        // rbac::Check($r->get->c,$a);
        $tmp->$a();
    }

    $r->save();
    function pageshutdown()
    {
        if($GLOBALS['debug']['page'] == true)
        {
            
        }
    }
    register_shutdown_function(pageshutdown);
?>