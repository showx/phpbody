<?php
if(!defined('BODY')){exit();}
/**
* 窗体类
* Author show
* copyright phpbody (www.phpbody.com)
*/
Class form{
    /**
     * 调试函数
     * @param  [type] $vararr [description]
     * @return [type]         [description]
     */
    public static function sbug($vararr)
    {
        $tem = "<div style='background-color:#000000;color:green;width:auto;height:120px;overflow-y:scroll;'><pre>";
        $e = var_export($vararr,true);
        $tem .= $e;
        $tem .= "</pre></div><br/>";
        echo $tem;
    }
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
    public static function getFormTop($action,$method='get')
    {
        return "<form action='{$action}' method='{$method}' >";
    }
    public static function input($type='text',$name='input1',$value='')
    {
        return "<input type='{$type}' name='{$name}' value='{$value}' />";
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
    	http::switchheader("location",$url);
    }
}