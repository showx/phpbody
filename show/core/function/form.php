<?php
/**
* 窗体方式
* Author show
* copyright phpbody
*/
Class form{
    public static function getHeader()
    {
        return "<!DOCTYPE html>
<html>
<head>";
    }
    
    public static function go($c='',$a='',$url='phpbody.com')
    {
    	if(!empty($c) && !empty($a))
    	{
    		$url = "?c={$c}&a={$a}";
    	}
    	header("Location:{$url}");
    }
}