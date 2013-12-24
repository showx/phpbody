<?php
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
       self::_safe(&$this->get);
       self::_safe(&$this->post);
       $this->get = (object)$this->get;
       $this->post = (object)$this->post;
    }
    /*
     * 报告安全
     */
    public function _safe($data)
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
