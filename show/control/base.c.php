<?php
if(!defined('BODY')){exit();}
/**
 * 基类
 * Author show
 * copyright phpbody (www.phpbody.com)
 */
Class base{
    public $db;
	public $route;
    public function __construct() {
    	global $sdb,$r;
    	$this->db = $sdb;
    	$this->route = $r;
    }
}