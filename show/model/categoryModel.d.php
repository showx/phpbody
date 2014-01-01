<?php
class categoryModel{
	/*
	*
	* 获取菜单
	*/
    public static function getMenu()
    {
    	global $sdb;
    	$sql = "select * from #pre#menu";
    	$result = $sdb->getall($sql);
    	$arr = '';
    	if($result)
    	{
    		foreach($result as $key=>$val)
	    	{
	    		$arr[$val['parentid']][] = $val;
	    	}
    	}
    	return $arr;
    }
}