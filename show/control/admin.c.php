<?php

class admin extends base{
    public function index()
    {
        if($_SESSION['isadmin'] =='')
        {
            header("Location:index.php?c=admin&a=login");
        }
    }
    public function login()
    {
        global $r;
        if($r->get->name && $r->get->pass)
        {
            $istrue = adminModel::getAdmin($r->get->name,$r->get->pass);
            if($istrue)
            {
                $_SESSION['isadmin'] = "yes";
                header("Location:index.php?c=admin&a=index");
                exit();
            }
        }
        tpl::d('login.tpl');
    }
}