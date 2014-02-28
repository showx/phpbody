<?php
if(!defined('BODY')){exit();}
/**
 * download操作类
 * Author show
 * copyright phpbody (www.phpbody.com)
 */
Class download{
	/**
	 * 获取css文件里的图像
	 * @param  [type] $cssfile [description]
	 * @param  [type] $url     [description]
	 * @return [type]          [description]
	 */
	public static function getCssImg($cssfile,$urls)
	{
		$content = http::url_fetch($cssfile);
		$gui = "/url\((.*)?\)/isU";
		$url = string::preg($gui,$content,'all');
		
		foreach($url['1'] as $key=>$val)
		{

			$val = str_replace('../','/',$val);
			$data = http::url_fetch($urls.$val);
			$name = basename($val);//.pathinfo($val, PATHINFO_EXTENSION);
			$file = PHPBODY."/upload/".$name;
			// file::wfile($file,$data);
			file_put_contents($file,$data);
		}
	}
	public static function getCssFile($page)
	{

	}
}