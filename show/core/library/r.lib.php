<?php
if(!defined('BODY')){exit();}
/**
* 路由类
* Author show
* powered by phpbody (www.phpbody.com)
*/
Class r{
    public $get;
    public $post;
    public $req;
    public $url = array("a","id","run"); //"c",
    public $surl = array("c","a","id","swit","run"); //有control的使用
    public function __construct()
    {
        //极路由，超伪静态
        //$_SERVER['QUERY_STRING'];
        // if($_SERVER['REQUEST_METHOD']=='GET')  //容易造成post和get只能其中一个
        // {
            foreach($_GET as $key =>$val)
            {
                $this->get[$key] = $val;
                $this->req[$key] = $val;
            }
        // }elseif($_SERVER['REQUEST_METHOD']=='POST')
        // {
            foreach($_POST as $key =>$val)
            {
                $this->post[$key] = $val;
                $this->req[$key] = $val;
            }
        // }
       self::_safe($this->get);
       self::_safe($this->post);
       self::_safe($this->req);
       //$_SERVER['PATH_INFO'];  //部分服务器不支持
       if(isset($this->get['r']))
       {
         $tmp = explode("/",$this->get['r']);
         $count = count($tmp)-1;
         for($i=0;$i<=$count;$i++)
         {
            if(isset($tmp[$i]))
            {
                $s = $this->url[$i];
                // $this->get->{$s} = $tmp[$i];
                $this->get[$s] = $tmp[$i];
                $this->req[$s] = $tmp[$i];
            }
            
         }
       }
       if(isset($this->get['s']))  //还是需要一级使用，不放在r上了，但多了个rewrite
       {
         $tmp = explode("/",$this->get['s']);
         $count = count($tmp)-1;
         for($i=0;$i<=$count;$i++)
         {
            if(isset($tmp[$i]))
            {
                $s = $this->url[$i];
                // $this->get->{$s} = $tmp[$i];
                $this->get[$s] = $tmp[$i];
                $this->req[$s] = $tmp[$i];
            }
         }
       }
       $this->get = (object)$this->get;
       $this->post = (object)$this->post;
       $this->req = (object)$this->req;
       unset($_GET,$_POST);

    }

    private function data($at='get',$key,$val)
    {
        $tmp = @$this->$at->$key;
        if(isset($tmp))
        {
            return $tmp;
        }else{
            return $val;
        }
    }
    public function req($key,$val='')
    {
        $d = self::data('req',$key,$val);
        return $d;
    }
    /**
    *  get方式
    */
    public function get($key,$val='')
    {
        $d = self::data('get',$key,$val);
        return $d;
    }
    /**
    *  post方式
    */
    public function post($key,$val='')
    {
        $d = self::data('post',$key,$val);
        return $d;
    }
    /*
     * 报告安全
     */
    public function _safe(&$data)
    {
        if(is_array($data))
        {
            foreach($data as $k => &$v)
            {
                self::_safe($v);
            }
        }else{
            $data = addslashes($data);
        }
        return $data;
    }
    public function save()
    {
        global $sdb;
        $tmp = $GLOBALS['debug']['url'];
        if($tmp)
        {
            $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            $get = serialize($this->get);
            $post = serialize($this->post);
            $time = time();
            $sql = "insert into show_debug(`url`,`get`,`post`,`timestamp`) values('{$url}','{$get}','{$post}','{$time}')";
            $sdb->query($sql);
        }
    }
    public function __sleep()
    {

    }
    public function __wakeup()
    {
        
    }
}
