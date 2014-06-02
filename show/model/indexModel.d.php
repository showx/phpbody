<?php
class indexModel extends base{
    public static function getResult()
    {
    	global $sdb;
    	$result = $GLOBALS['sdb']->getone("select * from show_admin");
    	$result = "test";
    	return $result;
    }
}