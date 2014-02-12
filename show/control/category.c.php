<?php
if(!defined('BODY')){exit();}
/**
* 栏目相关
* Author show
* copyright phpbody
*/
Class category extends base{
    public function index()
    {
    	$menu = categoryModel::getMenu();
    	tpl::a("menu",$menu);
        tpl::d("category.index.tpl");
    }
}