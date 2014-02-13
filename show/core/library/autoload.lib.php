<?php
/*
 * 自动加载类
 * 优先级别 control > model > library > function
 */
function __autoload($class_name) {
    if(file_exists(SHOWCONTROL."/".$class_name.".c.php"))
    {
        require_once SHOWCONTROL."/".$class_name.".c.php";
    }elseif(file_exists(SHOWMODEL."/".$class_name.".d.php"))
    {
        require_once SHOWMODEL."/".$class_name.".d.php";
    }elseif(file_exists(SHOWLIBRARY."/".$class_name.".lib.php"))
    {
        require_once SHOWLIBRARY."/".$class_name . '.lib.php';
    }elseif(file_exists(SHOWFUNCTION."/".$class_name.".php"))
    {
        require_once SHOWFUNCTION."/".$class_name.".php";
    }
}
class auto()
{
    public static loadClass(){}
}
//spl_autoload_register(array('Loader', 'loadClass'));
?>
