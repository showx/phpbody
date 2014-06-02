<?php
/*
 * 自动加载类
 * 优先级别 control > model > library > function
 */
function __autoload($class_name) {
    global $allow;
    // echo "<!-- {$allow} -->";
   
    $patharr = array(
        "content"=>SHOWCONTROL.$allow."/content.c.php",
        "category"=>SHOWCONTROL.$allow."/category.c.php",
        "home"=>SHOWCONTROL.$allow."/home.c.php",
        "lists"=>SHOWCONTROL.$allow."/lists.c.php",

        "listsModel"=>SHOWMODEL."/listsModel.d.php",  //model暂时不区分池
        "adminModel"=>SHOWMODEL."/adminModel.d.php",
        "categoryModel"=>SHOWMODEL."/categoryModel.d.php",
        "indexModel"=>SHOWMODEL."/indexModel.d.php",
        "contentModel"=>SHOWMODEL."/contentModel.d.php",

        "http"=>SHOWFUNCTION."/http.php",
        "file"=>SHOWFUNCTION."/file.php",
        "form"=>SHOWFUNCTION."/form.php",
        "string"=>SHOWFUNCTION."/string.php",

        "db"=>SHOWLIBRARY."/db.lib.php",
        "r"=>SHOWLIBRARY."/r.lib.php",
        "session"=>SHOWLIBRARY."/session.lib.php",
        "tpl"=>SHOWLIBRARY."/tpl.lib.php",
        );
    if(array_key_exists($class_name, $patharr))
    {
        require_once $patharr[$class_name]; //PATH_SEPARATOR
    }else{
       if(file_exists(SHOWCONTROL.$allow.DIRECTORY_SEPARATOR.$class_name.".c.php"))
        {
            require_once SHOWCONTROL.$allow.DIRECTORY_SEPARATOR.$class_name.".c.php";
        }elseif(file_exists(SHOWMODEL.DIRECTORY_SEPARATOR.$class_name.".d.php"))
        {
            require_once SHOWMODEL.DIRECTORY_SEPARATOR.$class_name.".d.php";
        }elseif(file_exists(SHOWLIBRARY.DIRECTORY_SEPARATOR.$class_name.".lib.php"))
        {
            require_once SHOWLIBRARY.DIRECTORY_SEPARATOR.$class_name . '.lib.php';
        }elseif(file_exists(SHOWFUNCTION.DIRECTORY_SEPARATOR.$class_name.".php"))
        {
            require_once SHOWFUNCTION.DIRECTORY_SEPARATOR.$class_name.".php";
        } 
    }
    
}
class AutoL
{
    public static function loadClass(){

    }
    /**
    * 生成配置菜单
    */
    public static function genAuto()
    {

    }
}
//spl_autoload_register(array('AutoL', 'loadClass'));
?>
