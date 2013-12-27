<?php

Class db{
    private $link;
    private $array;
    private $db;
    private $sql;
    private $data;
    private $xdata;
    private static $_instance;
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
    }
    /*
     * 建立查询
     * 语句失败，拋出
     */
    public function query($sql)
    {
//        $sql = addslashes($sql);
//        $sql = self::safe($sql);
        $str = "#pre#";
        $sql = str_replace($str,$GLOBALS['db']['pre'],$sql);
        $d = mysql_query($sql) or die("Invalid query: " .$sql.mysql_error());
        return $d;
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
    function get_one($sql)
    {
        $result = $this->query($sql);
        while($this->xdata = mysql_fetch_array($result,MYSQL_ASSOC))
        {
            break;
        }
        return $this->xdata;
    }
    /*
     * 获取全部信息
     */
    function get_all($sql)
    {
        $result = $this->query($sql);
        while($this->xdata = mysql_fetch_array($result,MYSQL_ASSOC))
        {
            $this->data[] = $this->xdata;
        }
        return $this->data;
    }
}
?>
