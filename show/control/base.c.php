<?php
if(!defined('BODY')){exit();}
/**
 * 鍩虹被
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
        tpl::a("showurl","http://gamemaster.sinaapp.com");
        tpl::a("v_sitename","x99x");
    }
}