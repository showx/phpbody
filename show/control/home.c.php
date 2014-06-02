<?php
if(!defined('BODY')){exit();}
/**
* 首页应用
* Author show
* copyright phpbody (www.phpbody.com)
*/
Class home extends base{
	public $s;
	public $f;
	
    public function test()
    {

        $ip = http::getClientIp();
        echo $ip;
        $ip = http::convertip($ip);
        echo $ip;
        exit();
        $key = 'a916e602a818e918564798b8';
$url = 'http://www.x99x.com';
$url = mcrypt_encrypt(MCRYPT_3DES, $key, $url, MCRYPT_MODE_ECB, "00000000");

// base64 encode
$url = base64_encode($url);

print '<img src="http://images.thumbshots.com/image.aspx?cid=ivmb5nJ1XBY%3d&v=1&w=&url' . urlencode($url) . '"/>';
exit();
        // var_dump($this->db); //以后不要特意 global
        // var_dump($this->route);
        // $d = $this->db->getone("select * from #pre#admin");
        // var_dump($d);
    }
    public function gonglue()
    {
        $id =$this->route->req("id",'1');
        $result = $this->db->getone("select * from #pre#gonglue where id='{$id}'");
        tpl::a("cid","999");
        tpl::a("result",$result);
        tpl::d("gongluelist.tpl");
    }
    public function gl()
    {
        global $r;
        $keyword = $r->req("id",'');
        $mu = '';
        if(empty($keyword) && !is_numeric($keyword))
        {
            $page = $keyword;
            $keyword = '';
        }else{
            $mu = "/".$keyword;
        }
        $page = $r->get("run","1");
        if(empty($page))
        {
            $page='1';
        }
            $count = contentModel::getgonglue($keyword);
            $pagediv = form::getPage($page,$count,30,'/r/gl'.$mu);//'?c=category&a=cate&id='.$id
            $result = contentModel::getPgonglue($page,30,$keyword);
            tpl::a("cid","999");
            tpl::a("result",$result);
            tpl::a("pagediv",$pagediv);
            tpl::d("gllist.tpl");
        
    }
    /**
    * 验证码
    */
    public function captcha()
    {
        string::yanzheng();
    }
    public function comment()
    {
        $comment = $this->route->req("comment");
        $itemid = $this->route->req("itemid");
        $username = $this->route->req("username");
        $captcha = $this->route->req("captcha");
        $sid = $this->route->req("sid");
        if(empty($comment) || empty($username) || empty($itemid))
        {
            echo '不能为空';exit();
        }
        $y = string::yzm($captcha);
        if($y)
        {
            $time = time();
            $username = addslashes($username);
            $content = addslashes($content);
            $ip = http::getClientIp();
            $ip = ip2long($ip);
            $arr = array("gameid"=>$itemid,"username"=>$username,"content"=>"comment","timestamp"=>$time,"ip"=>$ip);
            $result = $this->db->insert2("show_comment",$arr);
            if($result)
            {
                echo '0';
            }else{
                echo '网络错误';
            }
        }else{
            echo '请输入正确的验证码';exit();
        }
    }
    //"game_name":"","game_url":"","game_cover":"","game_category":"
    public function searchauto()
    {
        global $r;
        $keyword = $r->get('keyword','');
        if($keyword)
        {
            $result = contentModel::getSearchGame($keyword);
            foreach($result as $key=>$val)
            {
                $data['game_name'] = $val['title'];
                $data['game_url'] = "/r/game/".$val['id'];
                $data['game_cover'] = $val['titlepic'];
                $data['game_category'] = $val['classid'];
                $tmp[] = $data;
            }
            if($tmp)
            {
                echo json_encode($tmp);
            }
        }
    }

	public function search(){
        global $r;
        $word = $r->get('keywords', '');
        if($word!='')
        {
            $result = contentModel::getSearchGame($word);
        }
        tpl::a("get_keywords",$word);
        tpl::a("result",$result);
        tpl::d("search.tpl");
    }
    public function shortcut()
    {
        $url = "http://www.4293.com/";
        $title = "4293游戏";
        $Shortcut = "[InternetShortcut] 
URL=".$url."
IDList= 
[{000214A0-0000-0000-C000-000000000046}] 
Prop3=19,2 
"; 
Header("Content-type: application/octet-stream"); 
header("Content-Disposition: attachment; filename=".$title.".url;"); 
echo $Shortcut; 
    }
    public function index()
    {
        tpl::d("index.tpl");
        exit();
        $rnd = mt_rand(1,1000);
        $cloudtag = self::cloud();
        tpl::a("cloudtag",$cloudtag);
        tpl::a("rnd",$rnd);
        tpl::d('index.tpl');
    }
    public function cloud()
    {
        $cloudtag = cache::get("cloud","");
        if($cloudtag==false)
        {
            $tag = "select * from #pre#tags order by rand() limit 15";
            $minFontSize = 12;
            $maxFontSize = 30;
            $minimumCount = 1;
            $maximumCount = 15;
            $spread = $maximumCount - $minimumCount;
            $cloudHTML = '';
            $cloudTags = array(); 

            $spread == 0 && $spread = 1; 

            $tag = $this->db->getall($tag);
            foreach($tag as $key=>$val)
            {
                $count = mt_rand(1,15);
                $size = $minFontSize + ( $count - $minimumCount ) * ( $maxFontSize - $minFontSize ) / $spread;
                $cloudTags[] = '<a style="font-size: ' . floor( $size ) . 'px'
            . '" href="/r/tags/'.$val['id'].'" title="' . $val['tagname'] .'">'
            . htmlspecialchars( stripslashes( $val['tagname'] ) ) . '</a>';

            }
            $cloudtag = join( "\n", $cloudTags ) . "\n";
            cache::set("cloud","",$cloudtag);
        }
        
        return $cloudtag;
    }
    public function game()
    {
    	content::game();
    }
    public function cate()
    {
    	category::cate();
    }
    public function tags()
    {
    	content::tags();
    }
    /**
     * 关于我们
     * @return [type] [description]
     */
    public function about()
    {
        tpl::d('about.tpl');
    }
    /**
     * 版权说明
     * @return [type] [description]
     */
    public function ban()
    {
        tpl::d('ban.tpl');
    }
    /**
     * 招聘
     * @return [type] [description]
     */
    public function job()
    {
         tpl::d('job.tpl');
    }
    /**
     * 链接
     * @return [type] [description]
     */
    public function links()
    {
         tpl::d('links.tpl');
    }
    /**
     * 发展历程
     * @return [type] [description]
     */
    public function fazhan()
    {
        tpl::d('fazhan.tpl');
    }
    /**
     * 使用协议
     * @return [type] [description]
     */
    public function usedd()
    {
        tpl::d('use.tpl');
    }
}