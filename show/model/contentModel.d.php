<?php
if(!defined('BODY')){exit();}
/**
* 内容相关
* Author show
* copyright phpbody (www.phpbody.com)
*/
class contentModel{
	/**
	*  添加文章 
	*/
	public static function contentadd($arr)
    {
        global $sdb;
        $time = time();
        $sql = "insert into #pre#content(`title`,`content`,`categoryid`,`tags`,`timestamp`) 
        values('{$arr['title']}','{$arr['content']}','{$arr['categoryid']}','{$arr['tags']}','{$time}');";
        $return = $sdb->query($sql);
        return $return;
    }
}