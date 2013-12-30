<?php

class admin extends base{
    public function index()
    {
        if($_SESSION['isadmin'] =='')
        {
            header("Location:index.php?c=admin&a=login");
        }

        tpl::a('name',$_SESSION['username']);
        tpl::d('admin.tpl');
    }
    public function login()
    {
        global $r;
        if($r->get('name') && $r->get('pass'))
        {
            $istrue = adminModel::getAdmin($r->get->name,$r->get->pass);
            if($istrue)
            {
                $_SESSION['isadmin'] = "yes";
                $_SESSION['username'] = $r->get->name;
                header("Location:?c=admin&a=index");
                exit();
            }
        }
        tpl::d('login.tpl');
    }
    public function logout()
    {
        $_SESSION['isadmin'] = '';
        $_SESSION['username'] = '';
        header("Location:?c=admin&a=index");
    }
}