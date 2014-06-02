<?php
define("PHPBODY",dirname(__FILE__));
if(@$_SESSION['isadmin'] == '' && empty($_GET))
{
	$_GET['c'] = 'member';
	$_GET['a'] = 'index';
}
$_GET['allow'] = 'member';
include PHPBODY."/show/core/core.php";