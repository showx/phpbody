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
	    		$arr[$val['parentid']][$val['id']] = $val;
	    	}
            $arrkey = array_keys($arr);
            $menu['0'] = $arr['0'];

            foreach($arrkey as $key=>$val)
            {
                if($val==0){continue;}
                // $tmp = self::getParentid($val);
                // form::sbug($menu);
                    if(self::searchkey($menu,$val))
                    {   
                        //根，实际没必要判断
                    }else{
                        echo "==========={$val}======<br/>";
                        self::fors($menu,$val);
                    }

            }
       

    	}
    	return $menu;
    }
    public static function fors($arr,$d)
    {

        foreach($arr as $key=>$val)
        {
            if(self::searchkey($val,$d))
            {
                
            }else{
                self::fors($val,$key);
            }
        }
    }
    public static function searchkey($arr,$key)
    {
        if(is_array($arr))
        {
            //array_search($key,$arr);
            $a = array_key_exists($key,$arr);
            if($a)
            {
                echo 'ok';
                return true;
            }else{
                return false;
            }
        }
        return false;
        
    }
    public static function getParentid($id)
    {
        global $sdb;
        $sql = "select parentid from #pre#menu where id ={$id}";
        $result = $sdb->getone($sql);
        
        return $result;

    }
    public static function CategoryAdd($name,$parentid=0)
    {
        global $sdb;
        $sql = "insert into #pre#menu(`parentid`,`name`) values('{$parentid}','{$name}');";
        echo $sql;
        $return = $sdb->query($sql);
        var_dump($return);exit();
    }
}