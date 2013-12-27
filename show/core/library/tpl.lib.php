<?php
/*
 * 模板引擎
 * Author show
 * copyright PHPBODY
 */
Class tpl{
    private $lib;
    public  $tpl;
    private $data; 
    public static $_instance;
    public static function init() {
        //$this->lib = templatelib;
        self::getInstance();
    }
    /**
    * 构建包含
    */
    public function __construct()
    {
        include templatelib."/Smarty.class.php";
    }

    /*
     * 单例创建
     */
    public static function getInstance(){
        if(!(self::$_instance instanceof self)){
            self::$_instance = new self;

            self::$_instance->tpl = new Smarty;
            self::$_instance->tpl->template_dir = template_dir;
            self::$_instance->tpl->compile_dir = compile_dir;
            self::$_instance->tpl->config_dir = config_dir;
            self::$_instance->tpl->cache_dir = cache_dir;
            self::$_instance->tpl->left_delimiter = left_delimiter;
            self::$_instance->tpl->right_delimiter = right_delimiter;
        }
        return self::$_instance;
    }
    
    /*
     * 赋值
     */
    public static function a($key,$val){
        self::init();
        self::$_instance->tpl->assign("{$key}",$val);
    }
    /*
     * 渲染
     */
    public static function d($name){
        self::init();
        self::$_instance->tpl->display($name);
    }
    
    /*
     * html fetch
     */
    public function f()
    {
        
    }
}
?>
