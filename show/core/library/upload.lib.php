<?php
if(!defined('BODY')){exit();}
/*
 * 上传类
 * Author show
 * copyright PHPBODY (www.phpbody.com)
 */
Class upload
{
    protected $config = array();
    public $error;
    public function __construct($config = array())
    {
        $this->config['size'] = !empty($config['size'])?$config['size']:'10000';
        $this->config['type'] = !empty($config['type'])?$config['type']:'jpeg';
    }
    public function safe($name)
    {
        if($_FILES[$name][$name]['size'] > $this->config['size'] )
        {
            $this->errors = "文件过大";
        }
        //$_FILES['userfile']['type']
    }
    public function upload($name,$path)
    {
        if($_FILES[$name]['error'] > 0)
        {
            $this->error =  $_FILES[$name]['error'];
            return '';
        }
        self::safe($name);
        if(move_uploaded_file($_FILES[$name]['tmp_name'],$path.$_FILES[$name]['name']))
        {
            return $_FILES[$name]['name'];
        }else{
            $this->error = "上传失败";
        }   
    }
}
?>
