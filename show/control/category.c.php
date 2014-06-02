<?php
if(!defined('BODY')){exit();}
/**
* 栏目相关
* Author show
* copyright phpbody (www.phpbody.com)
*/
Class category extends base{
    
    public function index()
    {
    	self::cate();
    }
    
    public function cate()
    {
        global $r;
        $id = $r->get("id","");
        $page = $r->get("run",'1');
        if($id)
        {
            $count = contentModel::getCount($id);
            $pagediv = form::getPage($page,$count,30,'/r/cate/'.$id,'/');//'?c=category&a=cate&id='.$id
            $result = contentModel::getPdata($id,$page,30);
            tpl::a("cid",$id);
            tpl::a("result",$result);
            tpl::a("pagediv",$pagediv);
            tpl::d("list.tpl");
        }
    }
}