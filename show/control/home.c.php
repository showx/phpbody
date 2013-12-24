<?php
Class home{
    public function index()
    {
//        $result = db::i()->get_one("select * from show_admin");
        tpl::d('index.tpl');
    }
}