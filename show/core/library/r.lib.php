<?php
/**
* 路由类
* Author show
* powered by phpbody (www.phpbody.com)
*/
Class r{
    public $get;
    public $post;
    public $req;
    public function __construct()
    {
        if($_SERVER['REQUEST_METHOD']=='GET')
        {
            foreach($_GET as $key =>$val)
            {
                $this->get[$key] = $val;
                $this->req[$key] = $val;
            }
        }elseif($_SERVER['REQUEST_METHOD']=='POST')
        {
            foreach($_POST as $key =>$val)
            {
                $this->post[$key] = $val;
                $this->req[$key] = $val;
            }
        }
       self::_safe($this->get);
       self::_safe($this->post);
       self::_safe($this->req);
       $this->get = (object)$this->get;
       $this->post = (object)$this->post;
       $this->req = (object)$this->req;
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
            foreach($data as $k => $v)
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
        $tmp = $GLOBALS['url']['debug'];
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
}
