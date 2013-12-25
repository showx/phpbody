<?php
define("PHPBODY",dirname(__FILE__));
header("Content-type: text/html; charset=utf-8"); 
include PHPBODY."/show/core/core.php";

if(!defined('BODY'))
{
	exit();
}

if(!file_exists(PHPBODY."/install.lok"))
{
    header("Location:install.php");
}
?>
