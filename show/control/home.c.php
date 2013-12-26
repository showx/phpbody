<?php
Class home extends base{

    public function index()
    {
    	
        indexModel::getResult();
    	tpl::a("test","Hello World!!");
        tpl::d('index.tpl');
    }
}