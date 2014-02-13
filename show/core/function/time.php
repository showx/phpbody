<?php
if(!defined('BODY')){exit();}
/**
 * 时间操作相关
 * Author show
 * copyright phpbody (www.phpbody.com)
 */
Class time{
    /**
     * 生成指定范围日期
     * @var string
     */
    public static createday($d0 = '2010-02-21',$d1 = '2010-04-23'; )
    {
        $_time = range(strtotime($d0), strtotime($d1), 24*60*60);
        $_time = array_map(create_function('$v', 'return date("Y-m-d", $v);'), $_time);
        return $_time;
    }
}
?>
