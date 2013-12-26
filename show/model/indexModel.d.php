<?php
class indexModel{
    public static function getResult()
    {
    	global $sdb;
    	$result = $GLOBALS['sdb']->get_one("select * from show_admin");
    	$result = "test";
    	return $result;
    }
}