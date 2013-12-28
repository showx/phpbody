<?php
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
    
}