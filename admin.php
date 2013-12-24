<?php
define("PHPBODY",dirname(__FILE__));
include PHPBODY."/show/core/core.php";

if(!file_exists(PHPBODY."/install.lok"))
{
    header("Location:install.php");
}

header("Location:index.php?c=admin&a=index");

