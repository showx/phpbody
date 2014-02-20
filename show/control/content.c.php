<?php
/**
* 内容类
* Author show
* copyright phpbody (www.phpbody.com)
*/
if(!defined('BODY')){exit();}
Class content extends base{
	public function index()
	{
		
	}
    public function add()
    {
    	global $r;
    	
    	tpl::a("c",$r->get("c",""));
    	tpl::a("a",$r->get("a",""));
        tpl::d("admin/content.add.tpl");
    }
    public function padd()
    {
    	global $r;
    	$categoryid = $r->post("categoryid",1);
    	$title = $r->post("title",'');
    	$content = $r->post("content",'');
    	$tags = $r->post("tags",'');
    	if(!empty($title))
    	{
    		$arr = compact("categoryid","title","content","tags");
    		$return = contentModel::contentadd($arr);
    		if($return)
    		{
    			go('content','add');
    		}
    		
    	}
    }
}