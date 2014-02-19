<?php
if(!defined('BODY')){exit();}
/**
* 首页应用
* Author show
* copyright phpbody (www.phpbody.com)
*/
Class home extends base{

    public function index()
    {
        indexModel::getResult();
    	tpl::a("test","Hello World!!");
        tpl::d('index.tpl');
    }
}