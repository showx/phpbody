<?php
/*
 * 上传类
 * Author show
 * copyright PHPBODY (www.phpbody.com)
 */
Class upload
{
    protected config = array();
    public function __construct($config = array())
    {
        $this->config['size'] = !empty($config['size'])?$config['size']:'10000';
        $this->config['type'] = !empty($config['type'])?$config['type']:'jpg';
    }
}
?>
