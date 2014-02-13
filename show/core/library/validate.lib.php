<?php
/**
* 验证相关
* Author show
* powered by phpbody (www.phpbody.com)
*/
Class validate{
    /**
     * 验证是否ip 
     */
    public static is_ip($ip)
    {
        preg_match("/[\d]{1,3}\.[\d]{1,3}\.[\d]{1,3}\.[\d]{1,3}/",$ip,$e);
        if(!empty($e[0]))
        {
            return true;
        }else{
            return false;
        }
    }
}
