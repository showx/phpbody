<?php
/**
* 内容类
* Author show
* copyright phpbody (www.phpbody.com)
* 暂不分开model层
*/
if(!defined('BODY')){exit();}
Class ads extends admin{
	public function index()
	{
        global $sdb;
		$sql = "select * from #pre#ads";
        $result = $sdb->getall($sql);
        tpl::a("result",$result);
        tpl::d("ads.index.tpl");
	}
    public function gen()
    {
        global $sdb;
         $s =  new SaeStorage();
        $query = $sdb->query("select * from #pre#ads");
        while($t = mysql_fetch_array($query))
        {
            $content = str_replace("\r\n",'',$t['content']);
            // $content=preg_replace("/\s/","",$t['content']); 
            $content = str_replace("<!--","",$content);
            $content = str_replace("//-->","",$content);
            $content = preg_replace("/\/\*(.*)\*\//","",$content);
            $content = addslashes($content);
            $content = "document.write(\"{$content}\");";
            $s->write('8','/ads/'.$t['id'].".js",$content);   //sae
            // $d = file_put_contents(PHPBODY.'/ads/'.$t['id'].".js", $content);
        }
        go("ads","index");
    }
    public function edit()
    {
        global $r,$sdb;
        $id = $r->req("id");
        $tmp = $r->req("onedit");
        if($tmp==1)
        {
            $title = $r->req("title");
            $content = $r->req("content");
            $data = array("title"=>$title,"content"=>$content,"timestamp"=>time());
            $sdb->update("show_ads",$data," where id ='{$id}'");
            go("ads","index");
        }
        
        $result = $sdb->getone("select * from #pre#ads where id='{$id}'");
        if($result)
        {
            tpl::a("result",$result);
            tpl::a("edit","ok");
            tpl::d("ads.add.tpl");
        }
        
    }
    public function del()
    {
        global $r,$sdb;
        $id = $r->req("id");
        $sdb->query("delete from #pre#ads where id='{$id}'");
        go("ads","index");
    }
    public function add()
    {
    	global $r;
    	
    	tpl::a("c",$r->get("c",""));
    	tpl::a("a",$r->get("a",""));
        tpl::d("ads.add.tpl");
    }
    public function padd()
    {
    	global $r,$sdb;
    	$title = $r->req("title");
        $content = $r->req("content");
        $data = array("title"=>$title,"content"=>$content,"timestamp"=>time()); //subtitle 简历就算了
        $s = $sdb->insert2("show_ads",$data);
        go("ads","index");
       
    }
    public function friendedit()
    {
        global $r,$sdb;
        $id = $r->req("id");
        $tmp = $r->req("onedit");
        if($tmp==1)
        {
            $title = $r->req("title");
            $url = $r->req("url");
            $data = array("title"=>$title,"url"=>$url);
            $sdb->update("show_links",$data," where id ='{$id}'");
            go("ads","friendindex");
        }
        
        $result = $sdb->getone("select * from #pre#links where id='{$id}'");
        if($result)
        {
            tpl::a("result",$result);
            tpl::a("edit","ok");
            tpl::d("friendlink.add.tpl");
        }
        
    }
    public function frienddel()
    {
        global $r,$sdb;
        $id = $r->req("id");
        $sdb->query("delete from #pre#links where id='{$id}'");
        go("ads","friendindex");
    }
    /**
     * 友情链接管理
     * @return [type] [description]
     */
    public function friendindex()
    {
        $sql = "select * from #pre#links";
        $result = $this->db->getall($sql);
        tpl::a("result",$result);
        tpl::d("friendlink.index.tpl");
    }
    /**
     * 添加友情链接
     * @return [type] [description]
     */
    public function friendadd()
    {
        $title  = $this->route->req("title");
        $url = $this->route->req("url");
        if(!empty($title))
        {
            $data = array("title"=>$title,"url"=>$url); //subtitle 简历就算了
            $s = $this->db->insert2("show_links",$data);
            go("ads","friendindex");
        }
        tpl::a("c",$this->route->get("c",""));
        tpl::a("a",$this->route->get("a",""));
        tpl::d("friendlink.add.tpl");
    }
}