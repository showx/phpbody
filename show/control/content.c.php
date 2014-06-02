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
		self::game();
	}
    /**
    * 游戏评分
    */
    public function pfen()
    {

    }
    /**
     * 标签相关
     * @return [type] [description]
     */
    public function tags()
    {
        global $r;
        $id = $r->get("id","");
        $page = $r->get("run","1");
        if(!is_numeric($id))
        {
            $tags = contentModel::getTagsid($id);
            $id = $tags['id'];
        }else{
            $tags = contentModel::getTagsdd($id);    
        }
        $count = contentModel::getliketagsCount($id);
        $result = contentModel::getliketags($id,$page,32);
        $pagediv = form::getPage($page,$count,32,'/r/tags/'.$id,'/');
        tpl::a("tags",$tags);
        tpl::a("pagediv",$pagediv);
        tpl::a("result",$result);
        tpl::d("tags.tpl");
    }
   
    public function game()
    {
        global $r;
        $id = $r->get("id","");
        $run = $r->get("run","");
        if($id)
        {
            $result = contentModel::getGameDetail($id);
            if($result)
            {
                foreach($result as $key=>$val)
                {
                    tpl::a($key,$val);
                }
            }
            tpl::a("cid",$result['classid']);
            if($run==1)
            {
                $comment = contentModel::getcomment($id);
                tpl::a("comment",$comment);
                tpl::d("run.tpl");
                exit();
            }
            contentModel::UpdateGameWithid($id);  //计数器
          
            tpl::d("display.tpl");
        }
    }
    
}