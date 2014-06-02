<?php
if(!defined('BODY')){exit();}
/**
 * 数据库crud操作类
 * 增删改操作
 * Author show
 * copyright phpbody (www.phpbody.com)
 */
class curd
{
	public $table;
	public $db;
	public function __construct($table='')
	{
		if(!empty($table))
		{
			$this->$table = $table;
		}
		$this->db = db::i();
	}
	public function del()
	{
		
	}


}
