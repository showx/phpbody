<?php
Class string
{
	/**
	 * 获取字符范围
	 * @param  [type] $strings  [description]
	 * @param  [type] $getstart [description]
	 * @param  [type] $getend   [description]
	 * @return [type]           [description]
	 */
    function getstring($strings,$getstart,$getend) {
		$strings=explode($getstart,$strings);
		$strings=$strings[1];
		$strings=explode($getend,$strings);
		return $strings[0];
	}


	function get_charsetconv($convmode,$content) {
		if (!function_exists($convmode)) {
			include SHOWFUNCTION.'charset_conv.php';
		}
		eval('$content='.$convmode.'($content);');
		return $content;
	}

	function toutf8($str,$LANGPAK='utf8') {
		if($LANGPAK=='gbk') {
			$str=get_charsetconv(g2u,$str);
		}elseif($LANGPAK=='big5') {
			$str=get_charsetconv(b2u,$str);
		}else{
			$str=$str;
		}
		return $str;
	}

	function togbk($str,$LANGPAK='utf8') {
		if($LANGPAK=='gbk') {
			$str=$str;
		}elseif($LANGPAK=='big5') {
			$str=get_charsetconv(b2g,$str);
		}else{
			$str=get_charsetconv(u2g,$str);
		}
		return $str;
	}

	function tobig5($str,$LANGPAK='utf8') {
		if($LANGPAK=='gbk') {
			$str=get_charsetconv(g2b,$str);
		}elseif($LANGPAK=='big5') {
			$str=$str;
		}else{
			$str=get_charsetconv(u2b,$str);
		}
		return $str;
	}
	/**
	 * 随机字符串
	 * @param  integer $x [description]
	 * @return [type]     [description]
	 */
	function str_rand($x=4){
		$str='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$string='';
		for($i=0;$i<$x;$i++) $string.=substr($str,mt_rand(0,strlen($str)-1),1);
		return $string;
	}

	/**
	 * js跳转
	 * @param  [type]  $url       [description]
	 * @param  integer $time      [description]
	 * @param  integer $in_parent [description]
	 * @return [type]             [description]
	 */
	function js_location($url,$time=3000,$in_parent=0){
		$parent = $in_parent ? 'parent.' : '';
		return '<script type="text/JavaScript">setTimeout("window.'.$parent.'location=\''.$url.'\';",'.$time.');</script>';
	}
	/**
	 * 获取最大键值
	 * @param  [type] $arr [description]
	 * @return [type]      [description]
	 */
	function get_max_key($arr) {
		$indexarr=array_keys($arr);
		rsort($indexarr);
		return $indexarr[0];
	}

}
?>
