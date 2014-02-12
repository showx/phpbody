<?php
/**
* 窗体类
* Author show
* copyright phpbody (www.phpbody.com)
*/
Class form{
    /**
     * 获取分页
     * @param  [type] $page  [description]
     * @param  [type] $count [description]
     * @param  [type] $paged [description]
     * @param  string $url   [description]
     * @return [type]        [description]
     */
    public static function getPage($page,$count,$paged,$url='/')
    {
        if(empty($count) || $count=='0'){return '';}
        $ye = ceil($count/$paged);
        $pages = "<ul class='page'>";
        for($i=1;$i<=$ye;$i++)
        {
            if($i==$page)
            {
                $current = "class='current'";
            }else{
                $current = "";
            }
            $pages .= "<li {$current}><a href='{$url}&page={$i}'>".$i."</a></li>";
        }
        $pages .= "</ul>";
        return $pages;
    }
    /**
     * 获取网页头部
     * @return [type] [description]
     */
    public static function getHeader()
    {
        return "<!DOCTYPE html>
<html>
<head>";
    }
    /**
     * 跳转方式
     * @param  string $c   [description]
     * @param  string $a   [description]
     * @param  string $url [description]
     * @return [type]      [description]
     */
    public static function go($c='',$a='',$url='phpbody.com')
    {
    	if(!empty($c) && !empty($a))
    	{
    		$url = "?c={$c}&a={$a}";
    	}
    	header("Location:{$url}");
    }
}