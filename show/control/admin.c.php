<?php
if(!defined('BODY')){exit();}
/**
* 管理后台
* Author show
* copyright phpbody (www.phpbody.com)
*/
class admin extends base{
    public function index()
    {
        if($_SESSION['isadmin'] =='')
        {
            form::go('admin','login');
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
                form::go('admin','index');
                exit();
            }
        }
        tpl::d('login.tpl');
    }
    public function logout()
    {
        $_SESSION['isadmin'] = $_SESSION['username'] = '';
        form::go('admin','index');
    }
}