<?php
define("PHPBODY",dirname(__FILE__));
if(@$_SESSION['isadmin'] == '' && empty($_GET))
{
	$_GET['c'] = 'admin';
	$_GET['a'] = 'index';
}
$_GET['allow'] = 'admin';
include PHPBODY."/show/core/core.php";
if(!file_exists(PHPBODY."/install.lok"))
{
    header("Location:install.php");
}