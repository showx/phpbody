<?php
/**
 * cookie 方法
 * 没什么事情，不推荐使用cookie
 * Author show
 * copyright phpbody
 */
class c{
    /**
     * 设置cookie
     * @param [type] $value [description]
     */
    public static function S($key,$arr,$json=true)
    {

        $keeptime = time() + 2592000;
        if($json==true)
        {
            $value = json_encode($arr);
        }
        setcookie($key,"show".base64_encode($value)."wx",$keeptime,'/'); 
        
    }
    /**
     * 获取cookie
     * @param [type] $key [description]
     */
    public static function G($key)
    {
        $a = '';
        if(isset($_COOKIE[$key]))
        {
            $a = $_COOKIE[$key];
        }
        if(!empty($a))
        {
            $a = substr($a,4,-2);
            $a = json_decode(base64_decode($a),true);
        }
        return $a;
    }
}