<?php
/**
* 路由类
* Author show
* powered by phpbody 
*/
Class r{
    public $get;
    public $post;
    public function __construct()
    {
        if($_SERVER['REQUEST_METHOD']=='GET')
        {
            foreach($_GET as $key =>$val)
            {
                $this->get[$key] = $val;
            }
        }elseif($_SERVER['REQUEST_METHOD']=='POST')
        {
            foreach($_POST as $key =>$val)
            {
                $this->post[$key] = $val;
            }
        }
       self::_safe($this->get);
       self::_safe($this->post);
       $this->get = (object)$this->get;
       $this->post = (object)$this->post;
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
}
