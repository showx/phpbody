<?php
/*
 * 常用函数库 
 * (有些常用的函数直接使用比较方便)
 * Author show 
 * copry right PHPBODY (www.phpbody.com)
 */
function b()
{
    echo "<br/>";
}
function dbug($var)
{
	form::sbug($var);
}
function utf8_substr($string,$len,$start=0)
{
	$str = string::utf8_substr($str,$slen,$start);
	return $str;
}
function http($url)
{
	$content = http::http_get($url);
	return $content;
}
function go($c,$a)
{
	form::go($c,$a);
}


?>