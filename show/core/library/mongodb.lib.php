<?php
if(!defined('BODY')){exit();}
/**
 * mongodb数据库驱动类
 * Author show
 * copyright phpbody (www.phpbody.com)
 */
Class mongodb
{
    private $conn;
    public $data;
    public function __construct()
    {
        self::__init_mongodb();
    }
    public function __init_mongodb()
    {
        $this->conn = new Mongo();
        $db = $this->conn->selectDB("show");
    }
}