<?php
if(!defined('BODY')){exit();}
/**
* 字符处理
* Author show
* copyright phpbody(www.phpbody.com)
*/
Class string
{
	/**
	 * 获取字符范围
	 * @param  [type] $strings  [description]
	 * @param  [type] $getstart [description]
	 * @param  [type] $getend   [description]
	 * @return [type]           [description]
	 */
   public static function  getstring($strings,$getstart,$getend) {
		$strings=explode($getstart,$strings);
		$strings=$strings[1];
		$strings=explode($getend,$strings);
		return $strings[0];
	}
   /**
    * 获取验证码
    * @param  [type] $string [description]
    * @return [type]         [description]
    */
   public static function yanzheng($string)
   {
//session_start();
   	 include(SHOWFUNCTION.'/kcaptcha/kcaptcha.php');
   	 $captcha = new KCAPTCHA();
   	 $_SESSION['captcha_keystring'] = $captcha->getKeyString();
   }
   /**
    * 验证是否正确
    * @return [type] [description]
    */
   public static function yzm($string)
   {
// session_start();
   	if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] === $string){
		return true;
	}else{
		return false;
	}
   }
  /**
   * 判断是否utf8编码
   * @param  [type]  $word [description]
   * @return boolean       [description]
   */
  public static function is_utf8($word){
	  if (preg_match("/^([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){1}/",$word) == true || preg_match("/([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){1}$/",$word) == true || preg_match("/([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){2,}/",$word) == true){
	  return true;
	  }else{
	  return false;
	  }
  }
  	/**
    * utf8中文截取
    * 这里不使用mbstring扩展
    * @return string
    */
    public static function utf8_substr($str, $slen, $startdd=0)
    {
        return mb_substr($str , $startdd , $slen , 'UTF-8'); //mb_strcut
    }

    /**
     * 正则辅助函数
     * @param  [type] $gui  [description]
     * @param  [type] $data [description]
     * @param  string $a    [description]
     * @return [type]       [description]
     */
    public static function preg($gui,$data,$a='')
    {
        if($a=='all')
        {
            preg_match_all($gui,$data,$return);    
            return $return;
        }else{
            preg_match($gui,$data,$return);    
        }
        if(isset($return[1]))
        {
            return $return[1];    
        }else{
            return '';
        }
        
    }

	static function  get_charsetconv($convmode,$content) {
		if (!function_exists($convmode)) {
			include SHOWFUNCTION.'/charset_conv.php';
		}
		eval('$content='.$convmode.'($content);');
		return $content;
	}

	public static function  toutf8($str,$LANGPAK='utf8') {
		if($LANGPAK=='gbk') {
			$str=self::get_charsetconv(g2u,$str);
		}elseif($LANGPAK=='big5') {
			$str=get_charsetconv(b2u,$str);
		}else{
			$str=$str;
		}
		return $str;
	}

	static function  togbk($str,$LANGPAK='utf8') {
		if($LANGPAK=='gbk') {
			$str=$str;
		}elseif($LANGPAK=='big5') {
			$str=get_charsetconv(b2g,$str);
		}else{
			$str=get_charsetconv(u2g,$str);
		}
		return $str;
	}

	static function  tobig5($str,$LANGPAK='utf8') {
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
	static function  str_rand($x=4){
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
	static function  js_location($url,$time=3000,$in_parent=0){
		$parent = $in_parent ? 'parent.' : '';
		return '<script type="text/JavaScript">setTimeout("window.'.$parent.'location=\''.$url.'\';",'.$time.');</script>';
	}
	/**
	 * 获取最大键值
	 * @param  [type] $arr [description]
	 * @return [type]      [description]
	 */
	static function  get_max_key($arr) {
		$indexarr=array_keys($arr);
		rsort($indexarr);
		return $indexarr[0];
	}

}
?>
