<?php
if(!defined('BODY')){exit();}
/**
* 后台相关
* Author show
* copyright phpbody
*/
class adminModel{
	/**
	 * 是否管理员
	 * @param  [type] $user [description]
	 * @param  [type] $pass [description]
	 * @return [type]       [description]
	 */
	public static function getAdmin($user,$pass)
	{
		global $sdb;
		$sql = "select * from #pre#admin where username ='{$user}'";
		$tmp = $sdb->getone($sql);
		if($tmp==false){return false;}
		$password = md5($pass+$tmp['mcrypt']);
		if($password == $tmp['password'])
		{
			return true;
		}else{
			return false;
		}
	}
	public static function getGroup()
	{
		global $sdb;
		$sql = "select * from #pre#group";
		$data = $sdb->getall($sql);
		return $data;
	}
	public static function DelGroup($id)
	{
		global $sdb;
		$sdb->query("delete from #pre#group where groupid='{$id}'");
		$sdb->query("delete from #pre#admin where groupid='{$id}'");
		return true;
	}
    
}