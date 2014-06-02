<?php
if(!defined('BODY')){exit();}
/**
* 管理后台
* Author show
* copyright phpbody (www.phpbody.com)
*/
class admin extends base{

    public function __construct()  //覆盖了base construct
    {
        global $sdb,$r;
        $this->route = $r;
        $this->db = $sdb;
        if($this->route->get('a') !=='login')
        {
            if($_SESSION['isadmin'] =='')
            {
                echo '<a href="/?c=admin&a=login">请登录</a>';exit();
            }
        }
        
    }
    public function index()
    {
        if($_SESSION['isadmin'] =='')
        {
            form::go('admin','login');
        }
        tpl::a('name',$_SESSION['username']);
        tpl::d('admin.tpl');
    }
    public function password()
    {
        global $r;
        $password = $r->post("password");
        if($password)
        {
            $query = adminModel::UpPassword($password);
            if($query)
            {
                echo '修改成功';
            }else{
                echo '修改失败';
            }
        } 
        echo form::getFormTop("/?c=admin&a=password","post");
        echo form::input("text","password");
        echo form::input("submit","sub","modify");
        echo '</form>';
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
    public function group()
    {
        $group = adminModel::getGroup();
        tpl::a("group",$group);
        tpl::d("group.index.tpl");
    }
    public function setting()
    {
        global $r;

        tpl::d("group.xian.tpl");

    }
    public function del()
    {
        global $r;
        $id = $r->get("id");
    }
    public function info()
    {
        phpinfo();
    }
    public function adminuser()
    {

    }
    public function user()
    {
        
    }
}