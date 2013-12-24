<?php
/*
 * Author show
 * copy right PHPBODY
 */
Class tpl{
    private $lib;
    public static $tpl;
    private $data; 
    public static $_instance;
    public function init() {
        $this->lib = templatelib;
        include templatelib."/Smarty.class.php";
        $this->tpl = new Smarty;
        $this->tpl->template_dir = template_dir;
        $this->tpl->compile_dir = compile_dir;
        $this->tpl->config_dir = config_dir;
        $this->tpl->cache_dir = cache_dir;
        $this->tpl->left_delimiter = left_delimiter;
        $this->tpl->right_delimiter = right_delimiter;
    }
    
    /*
     * 单例创建
     */
    public static function getInstance(){
        if(!(self::$_instance instanceof self)){
            self::$_instance = new self;
        }
        return self::$_instance;
    }
    
    /*
     * 赋值
     */
    public function a($key,$val){
        self::init();
        $this->tpl->assign("{$key}",$val);
    }
    /*
     * 渲染
     */
    public function d($name){
        self::init();
        $this->tpl->display($name);
    }
    
    /*
     * html fetch
     */
    public function f()
    {
        
    }
}
?>
