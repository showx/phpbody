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
     * @param  [type] $page  第几页
     * @param  [type] $count 总数量
     * @param  [type] $paged 每页多少数量
     * @param  string $url   [description]
     * @return [type]        [description]
     */
    public static function getPage($page,$count,$paged,$url='/',$dx = true)
    {
        if(empty($count) || $count=='0'){return '';}
        $ye = ceil($count/$paged);  //总页数
        $pages = "<ul class='page'>";

        // for($i=1;$i<=$ye;$i++)
        // {
        //     if($i==$page)
        //     {
        //         $current = "class='current'";
        //     }else{
        //         $current = "";
        //     }
        //     $pages .= "<li ><a {$current} href='{$url}/{$i}'>".$i."</a></li>"; //&page=
        // }

        $left = $page - 3;
        $right = $page + 3;
        $t ='';
        if($page!=1)
        {
            $pages .= "<li><a href='{$url}/1'>第一页</a></li>";
        }
        for($i=$left;$i<=$page;$i++)
        {
            if($i<=0)
            {
                continue;
            }
            if(empty($t) && $i<$page)
            {
                $t = 's';
                $pages .= "<li><a href='{$url}/{$i}'>上一页</a></li>";
            }
            if($page==$i)
            {
                $current = "class='current'";
            }else{
                $current = "";
            }
            $pages .= "<li ><a {$current} href='{$url}/{$i}'>".$i."</a></li>"; //&page=
        }
        $x = $page+1;
        for($i=$x;$i<=$right;$i++)
        {
            if($i<=$ye)
            {
                if($page==$i)
                {
                    $current = "class='current'";
                }else{
                    $current = "";
                }
                $pages .= "<li ><a {$current} href='{$url}/{$i}'>".$i."</a></li>"; //&page=
            }
            
        }
        
        if($page!=$ye && $page<$ye)
        {
            $pages .= "<li ><a href='{$url}/{$x}'>下一页</a></li>"; //&page=
        }
        if($page!=$ye)
        {
            $pages .= "<li><a href='{$url}/{$ye}'>末页</a></li>";
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