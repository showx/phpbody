<?php
if(!defined('BODY')){exit();}
/**
 * 数据库驱动类
 * Author show
 * copyright phpbody (www.phpbody.com)
 */
Class db{
    private $link;
    private $db;
    private $sql;
    private $data;
    private $xdata;
    private static $_instance;
    private $safestring;
    private $replacestring;
    private $kput = array();
    /*
     * 调用时候建立
     */
    function __construct()
    {
       self::conn();
    }
    public static function factory()
    {
        return new db();
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
    public function query($sql='')
    {
        if(empty($sql))
        {
            $sql = $this->sql;
        }
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
        $starttime = microtime(true);
        $d = mysql_query($sql) or die("Invalid query: " .$sql.mysql_error());
        $this->sql = '';
        $endtime = microtime(true);
        $whattime = $endtime - $starttime;
        
        if($GLOBALS['cache']['sql'])
        {
            cache::set("sql",$sqlkey,$d);
        }
        return $d;
    }
    public function query_out($sql)
    {
        $str = "#pre#";
        $sql = str_replace($str,$GLOBALS['db']['pre'],$sql);
        mysql_unbuffered_query($sql);
    }
    public function batchinsert()
    {

    }
    public function batchupdate()
    {

    }
    public function selectdb($dbname)
    {
        mysql_select_db($dbname,$this->link);
    }
    /**
     * 变量入库 
     * @param  [type] $key [description]
     * @param  [type] $val [description]
     * @return [type]      [description]
     */
    public function put($key,$val)
    {
        $this->kput[$key] = $val;
    }
    public function dinsert($table)
    {
        $key = array_key($this->kput);
        $val = array_values($this->kput);
        $return = self::insert($table,$key,$val);
        $this->kput = array();
        return $return;
    }
    /**
     * 插入数据
     * @param  [type] $table  [description]
     * @param  [type] $keyarr [description]
     * @param  [type] $valarr [description]
     * @return [type]         [description]
     */
    public function insert($table,$keyarr,$valarr,$d = 'insert') //replace
    {
        $keys = implode("`,`",$keyarr);
        $values = implode("','",$valarr);
        $sql = "{$d} into {$table}(`{$keys}`) values('{$values}')";
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
     * 关闭数据库
     * @return [type] [description]
     */
    public function close()
    {
        mysql_close($this->link);
    }
    /**
     * 影响的条数
     * @return [type] [description]
     */
    public function affected_rows()
    {
        return mysql_affected_rows($this->link);
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
    public function getone($sql='')
    {
        $result = $this->query($sql);
        $this->xdata = mysql_fetch_array($result,MYSQL_ASSOC);
        return $this->xdata;
    }
    /*
     * 获取全部信息
     */
    public function getall($sql='')
    {
        $data = '';
        $result = $this->query($sql);
        while($this->xdata = mysql_fetch_array($result,MYSQL_ASSOC))
        {
            $data[] = $this->xdata;
        }
        return $data;
    }
    /**
     * 拼接SQL
     * @param  [type] $table [description]
     * @return [type]        [description]
     */
    public function select($table,$field='*')
    {
        $this->sql = "select {$field} from {$table} ";
    }
    /*
     * 左链接
     */
    public function leftjoin( $table )
    {
        $this->sql = $this->sql." leftjoin {$table} ";
    }
    /*
     * join on
     */
    public function on($str)
    {
       $this->sql = $this->sql." {$str} ";  
    }
    /*
     * 右链接
     */
    public function rightjoin($table)
    {
      $this->sql = $this->sql." rightjoin {$table} ";
    }
    /*
     * where 
     */
    public function where($where)
    {
        if(empty($where))
        {
            $where = '1';
        }
        $this->sql = $this->sql." where {$where} ";
    }
    /**
     * order by
     * @param  [type] $field [description]
     * @param  string $de    [description]
     * @return [type]        [description]
     */
    public function order($field,$de = "desc")
    {
        $this->sql = $this->sql." orderby {$field} {$de} ";
    }
    /*
     * limit num
     */
    public function limit($num='10')
    {
        $this->sql = $this->sql." limit {$num} ";
    }
}
