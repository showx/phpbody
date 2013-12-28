<?php
/**
* 首页应用
* Author show
* copyright phpbody
*/
Class home extends base{

    public function index()
    {
        indexModel::getResult();
    	tpl::a("test","Hello World!!");
        tpl::d('index.tpl');
    }
}