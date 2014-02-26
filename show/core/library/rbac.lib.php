<?php
if(!defined('BODY')){exit();}
/**
 * rbac控制器
 * Author show
 * copyright phpbody (www.phpbody.com)
 */
Class rbac
{
	public static function R()
	{
		glboal $sdb;
		$sql = "select * from #pre#rbac";
		$result = $sdb->getall($sql);

	}
	/**
	 * 验证权限
	 * @param [type] $ct [description]
	 * @param [type] $ac [description]
	 */
	public static function CheckUser($ct,$ac)
	{

	}
	public static function StrToArr()
	{

	}
	
	public static function string2array($str) {
		$result = array();
		$_ARR = array(
			0=>array(0,0,0,0),
			1=>array(0,0,0,1),
			2=>array(0,0,1,0),
			3=>array(0,0,1,1),
			4=>array(0,1,0,0),
			5=>array(0,1,0,1),
			6=>array(0,1,1,0),
			7=>array(0,1,1,1),
			8=>array(1,0,0,0),
			9=>array(1,0,0,1),
			A=>array(1,0,1,0),
			B=>array(1,0,1,1),
			C=>array(1,1,0,0),
			D=>array(1,1,0,1),
			E=>array(1,1,1,0),
			F=>array(1,1,1,1));
		for($i = 0; $i < strlen($str); $i++) {
			if($_arr = $_ARR[$str[$i]])
				for($j = 0; $j < count($_arr); $j++)
					$result[] = $_arr[$j];
		}
		return $result;
	}

	public static function array2string($arr) {
		$result = "";
		if(is_array($arr) && $arr) {
			$max_idx = max(array_keys($arr));
			$loop = ceil(($max_idx+1)/4)*4;
			$_HEX = array(0,1,2,3,4,5,6,7,8,9,A,B,C,D,E,F);
			for($i = 0; $i < $loop; $i+=4){
				$_sum = 0;
				if($arr[$i]) $_sum += (1 << 3);
				if($arr[$i+1]) $_sum += (1 << 2);
				if($arr[$i+2]) $_sum += (1 << 1);
				if($arr[$i+3]) $_sum += (1 << 0);
				$result .= $_HEX[$_sum];
			}
		}
		return $result;
	}
}