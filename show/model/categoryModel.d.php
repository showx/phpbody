<?php
if(!defined('BODY')){exit();}
/**
* 栏目相关
* Author show
* copyright phpbody (www.phpbody.com)
*/
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
	    		$arr[$val['parentid']][$val['id']] = $val;
	    	}
            $arrkey = array_keys($arr);
            $menu['0'] = $arr['0'];
            foreach($arrkey as $key=>$val)
            {
                if($val==0){continue;}
                // $tmp = self::getParentid($val);
                    if(self::searchkey($menu,$val))
                    {   
                        //根，实际没必要判断
                    }else{
                        $menu = self::fors($menu,$val,$arr[$val]);
                    }
            }

    	}
        $menu = self::menutree($menu);
    	return $menu;
    }
    
    public static function fors(&$arr,$d,$data)
    {
        foreach($arr as $key=>&$val)
        {
            if(self::searchkey($val,$d))
            {
                array_push($val[$d],$data);
                
            }else{
                self::fors($val,$d,$data);
            }
        }
        return $arr;
    }
    public static function searchkey($arr,$key)
    {
        if(is_array($arr))
        {
            //array_search($key,$arr);
            $a = array_key_exists($key,$arr);
            if($a)
            {
                return true;
            }else{
                return false;
            }
        }
        return false;
        
    }
    /**
    * 生成菜单
    */
    public function menutree($tree)
    {
        $str = '';
        foreach($tree['0'] as $key=>$val)
        {
            $str .= "<li><a href='#'>{$val['name']}</a>";
            if(isset($val['0']))
            {
                $tmp = self::subtree($val['0']);
                $str .= $tmp;
            }
            $str .="</li>";
        }
        return $str;
    }
    /**
    * 获取子菜单
    */
    private function subtree($tree)
    {
        $str = "<ul>";
        foreach($tree as $key=>$val)
        {
            $str .="<li><a href='#'>{$val['name']}</a>";
            if(isset($val['0']))
            {
                $tt = self::subtree($val['0']);
                $str .= $tt;
            }
            $str .="</li>";
        }
        $str .= "</ul>";
        return $str;
    }
    public static function getParentid($id)
    {
        global $sdb;
        $sql = "select parentid from #pre#menu where id ={$id}";
        $result = $sdb->getone($sql);
        
        return $result;

    }
    /**
    * 增加栏目 
    */
    public static function CategoryAdd($name,$parentid=0)
    {
        global $sdb;
        $sql = "insert into #pre#menu(`parentid`,`name`) values('{$parentid}','{$name}');";
        $return = $sdb->query($sql);
    }
}