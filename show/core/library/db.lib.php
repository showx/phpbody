<?php
/**
 * 数据库驱动类
 * Author show
 * copyright phpbody (www.phpbody.com)
 */
Class db{
    private $link;
    private $array;
    private $db;
    private $sql;
    private $data;
    private $xdata;
    private static $_instance;
    private $safestring;
    private $replacestring;
    /*
     * 调用时候建立
     */
    function __construct()
    {
       self::conn();
    }
    
    /*
     * 单例创建
     */
    public static function i(){  //getInstance
        if(!(self::$_instance instanceof self)){
        self::$_instance = new self;
    }
        return self::$_instance;
    }
    
    /*
     * 建立连接
     */
    function conn()
    {
        $this->link = mysql_connect($GLOBALS['db']['host'],$GLOBALS['db']['user'],$GLOBALS['db']['pass']) or die('请检查数据库配置');
        mysql_select_db($GLOBALS['db']['databases'],$this->link) or die('数据库No Found');
        self::query("set names utf8");
    }
    /*
     * 建立查询
     * 语句失败，拋出
     */
    public function query($sql)
    {
//        $sql = addslashes($sql);
//        $sql = self::safe($sql);
        $sqlkey = md5($sql);
        $d = self::cache($sqlkey);
        if($d)
        {
            return $d;
        }
        $str = "#pre#";
        $sql = str_replace($str,$GLOBALS['db']['pre'],$sql);
        $d = mysql_query($sql) or die("Invalid query: " .$sql.mysql_error());
        if($GLOBALS['cache']['sql'])
        {
            cache::set("sql",$sqlkey,$d);
        }
        return $d;
    }
    public function batchinsert()
    {

    }
    public function batchupdate()
    {
        
    }
    /**
     * 插入数据
     * @param  [type] $table  [description]
     * @param  [type] $keyarr [description]
     * @param  [type] $valarr [description]
     * @return [type]         [description]
     */
    public function insert($table,$keyarr,$valarr)
    {
        $keys = implode("`,`",$keyarr);
        $values = implode("','",$valarr);
        $sql = "insert into {$table}(`{$keys}`) values('{$values}')";
        $tmp = self::query($sql);
        return $tmp;
    }
    /**
     * 更新数据
     * @param  [type] $table [description]
     * @param  [type] $data  [description]
     * @param  string $where [description]
     * @return [type]        [description]
     */
    public function update($table,$data,$where='')
    {
        $tmp ='';
        $i = 0;
        foreach($data as $key=>$val)
        {
                if($i==0)
                {
                    $tmp .= "{$key} = {$val} ";    
                }else{
                    $tmp .= ",{$key} = {$val} ";
                }
                
                $i=1;
        }
        $sql = "update {$table} set {$tmp} {$where}";
        $return = db::query($sql);
        return $return;
    }
    /**
    * 读取缓存
    *
    */
    private function cache($sqlkey)
    {
        if($GLOBALS['cache']['sql'])
        {
            $data = cache::get("sql",$sqlkey);
            return $data;
        }
    }
    /**
     * 影响的条数
     * @return [type] [description]
     */
    public function affected_rows()
    {
        return mysql_affected_rows();
    }
    /**
     * 获取最后插入的ID
     * @return [type] [description]
     */
    public function getinsertid()
    {
        $this->id=mysql_insert_id($this->link);
    }
    /**
     * 释放sql
     * @return [type] [description]
     */
    public function free($sql)
    {
        mysql_free_result($sql);
    }
    /*
     * 安全处理
     */
    function safe($sql)
    {
        $sql = mysql_real_escape_string($sql);
        return $sql;
    }
    /*
     * 获取一条信息
     */
    function getone($sql)
    {
        $result = $this->query($sql);
        $this->xdata = mysql_fetch_array($result,MYSQL_ASSOC);
        return $this->xdata;
    }
    /*
     * 获取全部信息
     */
    function getall($sql)
    {
        $data = '';
        $result = $this->query($sql);
        while($this->xdata = mysql_fetch_array($result,MYSQL_ASSOC))
        {
            $data[] = $this->xdata;
        }
        return $data;
    }
}
?>
