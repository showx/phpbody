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
		$password = md5($pass+$tmp['mcrypt']); //加号
		if($password == $tmp['password'])
		{
			return true;
		}else{
			return false;
		}
	}
	/**
	* 修改密码
	*/
	public static function UpPassword($password)
	{
		global $sdb;
		$user = $_SESSION["username"];
		$sql = "select * from #pre#admin where username='{$user}'";
		$one = $sdb->getone($sql);

		if($one)
		{
			
			$pass['password'] = md5($password+$one['mcrypt']);
			$query = $sdb->update("show_admin",$pass," where username='{$user}' ");
			return true;
		}
		return false;
		
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