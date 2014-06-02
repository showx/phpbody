<?php
if(!defined('BODY')){exit();}
Class lists extends admin{
    public function __construct()
    {
        $this->s =  new SaeStorage();

        $this->f = new SaeFetchurl();
    }
    /**
     * 跑取小游戏攻略
     * @return [type] [description]
     */
    public function crondgonglue()
    {
        global $sdb;
        //先跑完历史数据
        // $count =80;
        // for($i=$count;$i>1;$i--)
        // {
            $url = http::http_get("http://www.17yy.com/youxigonglue/index.html");  //80页
            $url = string::toutf8($url,'gbk');
            preg_match_all('/<div class=\"L_list\" onmouseover=\"this.style.backgroundColor=\'#f0f8ff\';\" onmouseout=\"this.style.backgroundColor=\'#fff\';\"><span>(.*?)<\/span><p><a href=\"(.*?)\">(.*?)<\/a><\/p><\/div>/is',$url,$tmp);
            foreach($tmp['2'] as $key=>$val)
            {
                $tmp['3'][$key] = addslashes($tmp['3'][$key]);
                $x = $tmp[3][$key];
                $sql = "select * from show_gonglue where title='$x'";
                $ok = $sdb->getone($sql);
                if($ok)
                {
                    continue;
                }
                self::getlist($val,$tmp['3'][$key],$tmp['1'][$key]);
                echo $val."\n";
            }
        // }
    }
    private function getlist($url,$title,$date,$classid='13')
    {
        $con = http::http_get($url);
        $con = string::toutf8($con,'gbk');
        preg_match('/<div class=\"con_L1\" id=\"con_L1\">(.*?)<div class=\"use\">/is',$con,$tt);

        $tt['1'] = preg_replace("/<iframe(.*?)<\/iframe>/is",'',$tt['1']);
        $tt['1'] = preg_replace('/<li><a(.*?)<\/a><\/li>/is','',$tt['1']);
        $tt['1'] = preg_replace('/<a(.*?)<\/a>/is','',$tt['1']);
        $tt['1'] = preg_replace('/<img(.*?)\/>/is','',$tt['1']);
        
        self::create($classid,$title,$tt['1'],$date,$url);
        
    }
    private function create($classid,$title,$content,$date,$url)
    {
        global $sdb;
        if($date)
        {
            $time = strtotime($date);
        }else{
            $time = time();
        }
        $content = addslashes($content);
        $data = array("title"=>$title,"content"=>$content,"timestamp"=>$time,"url"=>$url); //"classid"=>$classid,这个没意思
        $sdb->insert2("show_gonglue",$data);
        echo $url;
    }
    public function crondtag()
    {
        global $sdb;
        $sql = "select classid,id,tags from #pre#game where isup=''";
        $tmp  = $sdb->query($sql);
        while($result = mysql_fetch_array($tmp))
        {
            $tags = explode(",",$result['tags']);
            foreach($tags as $key =>$val)
            {
                $s = "replace into #pre#tags(`tagname`,`classid`) values('{$val}','{$result['classid']}');";    
                $sdb->query($s);

                echo $val."<br/>";
            }
                $ss = "update #pre#game set isup='1' where id='{$result['id']}'";
                $sdb->query($ss);
            
        }
    }
    /**
     * 4399
     * @return [type] [description]
     */
    public function crond()
    {
        set_time_limit(0);
        $s = $this->s;  //懒得改代码了
        $f = $this->f;
        $rundata = array(
        "8"=>"http://www.4399.com/flash_fl/16_1.htm", //装扮  不火的向上调一下 
        "2"=>"http://www.4399.com/flash_fl/5_1.htm", //益智
        "4"=>"http://www.4399.com/flash_fl/4_1.htm", //射击
        "5"=>"http://www.4399.com/flash_fl/6_1.htm", //冒险
        "10"=>"http://www.4399.com/flash_fl/1_1.htm", //搞笑
        "1"=>"http://www.4399.com/flash_fl/12_1.htm", //休闲
        "6"=>"http://www.4399.com/flash_fl/3_1.htm", //体育
        "7"=>"http://www.4399.com/flash_fl/8_1.htm", //策略
        "3"=>"http://www.4399.com/flash_fl/2_1.htm", //动作
        //"16"=>"http://www.3366.com/games/47_new_pic.shtml", //敏捷
        );
        foreach($rundata as $k=>$v)
        {
            // echo $k."\n";
            $classid = $k;
            $data = http::http_get($v);  //"http://www.3366.com/games/47_new_pic.shtml"
            listsModel::dosomething4399($classid,$data,$s,$f);
        }
    }
    /**
     * 7k7k
     * @return [type] [description]
     */
    public function crond7k7k()
    {
        $s = $this->s;  //懒得改代码了
        $f = $this->f;
        $rundata = array(
            "8"=>"http://www.7k7k.com/flash_fl/499_new_1.htm", //装扮
            "2"=>"http://www.7k7k.com/flash_fl/456_new_1.htm", //益智
            "4"=>"http://www.7k7k.com/flash_fl/459_new_1.htm", //射击
            "5"=>"http://www.7k7k.com/flash_fl/461_new_1.htm", //冒险
            //"10"=>"http://www.3366.com/games/43_new_pic.shtml", //搞笑
            "1"=>"http://www.7k7k.com/flash_fl/485_new_1.htm", //休闲
            "6"=>"http://www.7k7k.com/flash_fl/458_new_1.htm", //体育
            //"7"=>"http://www.3366.com/games/46_new_pic.shtml", //策略
            "3"=>"http://www.7k7k.com/flash_fl/478_new_1.htm", //动作
            //"16"=>"http://www.3366.com/games/47_new_pic.shtml", //敏捷
        );
        foreach($rundata as $k=>$v)
        {
            $classid = $k;
            $data = http::http_get($v);  //"http://www.3366.com/games/47_new_pic.shtml"
            listsModel::dosomething7k7k($classid,$data,$s,$f);
        }
    }
    /**
     * 3366
     */
    public function crond3366()
    {
        $s = $this->s;  //懒得改代码了
        $f = $this->f;
        $rundata = array(
        "4"=>"http://www.3366.com/games/42_new_pic.shtml", //射击
        "5"=>"http://www.3366.com/games/44_new_pic.shtml", //冒险
        "10"=>"http://www.3366.com/games/43_new_pic.shtml", //搞笑
        "1"=>"http://www.3366.com/games/45_new_pic.shtml", //休闲
        "6"=>"http://www.3366.com/games/41_new_pic.shtml", //体育
        "7"=>"http://www.3366.com/games/46_new_pic.shtml", //策略
        "8"=>"http://www.3366.com/games/128_new_pic.shtml", //装扮
        "16"=>"http://www.3366.com/games/47_new_pic.shtml", //敏捷
        "2"=>"http://www.3366.com/games/39_new_pic.shtml", //益智
        "3"=>"http://www.3366.com/games/40_new_pic.shtml", //动作
        /*
        "2"=>"http://www.3366.com/games/39_new_pic.shtml",
        "13"=>"http://www.3366.com/games/40_new_pic.shtml",
        "14"=>"http://www.3366.com/games/42_new_pic.shtml",
        "15"=>"http://www.3366.com/games/44_new_pic.shtml",
        "16"=>"http://www.3366.com/games/43_new_pic.shtml",
        "17"=>"http://www.3366.com/games/45_new_pic.shtml",
        "18"=>"http://www.3366.com/games/41_new_pic.shtml",
        "19"=>"http://www.3366.com/games/46_new_pic_26.shtml",
        "38"=>"http://www.3366.com/games/47_new_pic.shtml",
        */
        );
        foreach($rundata as $k=>$v)
        {
            $classid = $k;
            $data = http::http_get($v);  //"http://www.3366.com/games/47_new_pic.shtml"
            listsModel::dosomething3366($classid,$data,$s,$f);
        }
    }
    public function index()
    {
        
    }
    /**
     * 伪静态设置
     * @return [type] [description]
     */
    public function whtml()
    {

    }
    /**
     * 设置网站地图
     * @return [type] [description]
     */
    public function sitemap()
    {
    	$data = listsModel::getSite();
        
        
    }
    /**
     * 读取storage再显示xml
     * @return [type] [description]
     */
    public function xmlmap()
    {

    }
}