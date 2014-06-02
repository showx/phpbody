<?php
class listsModel extends base{
    /**
     * sae上传文件相关
     * @param  [type] $url     [description]
     * @param  string $classid [description]
     * @param  [type] $s       [description]
     * @param  [type] $f       [description]
     * @return [type]          [description]
     */
    public function saeup($url,$classid='',$s,$f)
    {
//      $s = new SaeStorage();

//        $f = new SaeFetchurl();
        // $s = $this->s;  //懒得改代码了
        // $f = $this->f;
        $swf = '';
        $domain ='job';  //修改domain 8
        // $url = "http://t.sina.com.cn";
        $a = pathinfo($url, PATHINFO_EXTENSION);
        if($a=='')
        {
            $name = md5($url).".txt";
        }else{
            $name = md5($url).".".$a;
        }
        $name = "/".$classid."/".$name;
        $content = $f->fetch($url);
        if($f->errno() == '0')  
        {
        //SAE_TMP_PATH
        //$s->upload( 'example' , 'test.txt' , 'http://t.sina.com.cn' );
        
        $s->write($domain,$name,$content);
            if($s->errno() == '0' ) 
            {
                // $return = $s->read( $domain , $name) ;
                $swf = $s->getUrl($domain,$name);
                
            }else{
                 $swf = $s->getUrl($domain,$name);
               echo $s->errno();
            }

        }else{
            echo $f->errmsg();
        }
        return $swf;
    }
    function dosomething3366($classid,$data,$s,$f)
    {
        global $sdb;
        preg_match('/<div id="type_generate_result_id">(.*?)<div class="mgp_pagenav"/isU',$data,$tmp);
        //链接
        preg_match_all('/<a href="(.*?)" target="_blank" title="/is',$tmp[1],$linked);  //$link已被占用 用$linked
        //图标   <img lz_src=\"[!--titlepic--]\" alt=\"
        //preg_match_all('/ <img lz_src=\"(.*?)\" alt=\"/is',$tmp[1],$img);

        foreach($linked['1'] as $key=>$val)
        {
            $links = "http://www.3366.com".$val;
            $picdata = $sdb->getone("select * from show_game where benlink = '{$links}'");
            if($picdata!='')
            {
                continue;
            }
            $content = http::http_get($links);
            // $content=DoIconvVal("GB2312","UTF8",$content);  //页面编码
            $content = string::toutf8($content,'gbk');

            self::runGameDeail3366($classid,$content,$links,$s,$f);

            echo $links."\n";
            //break; // 为了调试先这样做
        }
    }

    function runGameDeail3366($classid,$content,$links,$s,$f)
    {
    global $sdb;
    //swf源    <s></s><img src="[参数]" width="300" height="225" alt="(*)" />  [参数1]  TT:_300.jpg .swf   /img/  /flash/
    preg_match('/<s><\/s><img src="(.*)?" width="300" height="225"/is',$content,$d12);
    $swf = str_replace("_300.jpg",".swf",$d12['1']);
    $swf = str_replace("/img/","/flash/",$swf);
    $swfold = $swf;

    // $data = $sdb->getone("select * from u77u_ecms_game where flashurl_4usky = '{$swfold}'");
    // if($data!='' || $data!=false)
    // {
    //     $sqlu = "update u77u_ecms_game set benlink = '{$links}' where flashurl_4usky = '{$swfold}'";
    //     $result = $sdb->query($sqlu);
    //     return '';
    // }
    // $swf = DoTranUrl($swf,$classid);
    // $swf = $swf['url'];
    $swf = self::saeup($swf,$classid,$s,$f);
    //简介   <h3>小游戏简介：</h3>(*)<p>[参数]</p>      [参数1]  TT: <a(*)>[参数]</a> replace #[参数1]#
    preg_match('/<h3>小游戏简介：<\/h3>\s*<p>(.*?)<\/p>/is',$content,$d6);
    $d6['1'] = strip_tags($d6['1']);

    //标题  "Name": "[参数]",   [参数1]
    preg_match('/"Name": "(.*?)",/is',$content,$d1);
    //英文名 (英文名：[参数])  [参数1]
    //preg_match('/"Name": "(.*?)",/is',$content,$two);
    //大小  大小：<span>   </span>
    preg_match('/大小：<span>(.*?)<\/span>/is',$content,$d3);
    //宽度   "FlashWidth": "   ",
    preg_match('/"FlashWidth": "(.*?)",/is',$content,$d4);
    //高度   "FlashHeight": "  ",
    preg_match('/"FlashHeight": "(.*?)",/is',$content,$d5);

    //操作   <h3>操作指南：</h3>(*)[参数]</p>    [参数1]</p>
    preg_match('/<h3>操作指南：<\/h3>\s*(.*?)<\/p>/is',$content,$d7); //(.*?)<\/p>
    //<h3>小游戏目标：(*)<p>[参数]</p>
    preg_match('/<h3>小游戏目标：<\/h3>\s*<p>(.*?)<\/p>/is',$content,$d2);  //d15

    //采集信息ID  "GameId":"  "
    preg_match('/"GameId":"(.*?)"/is',$content,$d8);

    //采集信息  <dt>标签</dt><dd>  </dd>
    // preg_match('/<dt>标签<\/dt><dd>(.*?)<\/dd>/is',$content,$d9);
    //TAG标签  <dt>标签</dt><dd>    </a></dd></dl>    TT:| ,  
    preg_match('/<dt>标签<\/dt><dd>(.*?)<\/a><\/dd><\/dl>/is',$content,$d10);  //和d9差不多
    $cjinfo = $d10['1'];
    $d10['1'] = strip_tags($d10['1']);
    $d10['1'] = str_replace("|",",",$d10['1']);

    //如何开始  <h3>如何开始：(*)<p>[参数]</p>   [参数1]  TT:<br/>  
    preg_match('/<h3>如何开始：<\/h3>\s*<p>(.*?)<\/p>/is',$content,$d11);

    $d11[1] = str_replace("'",'"',$d11[1]);
    $d2[1] = str_replace("'",'"',$d2[1]);
    $d7[1] = str_replace("'",'"',$d7[1]);

    $gamebigpic = $d12['1'];
    $titlepic = str_replace("_300.jpg","_75_round.jpg",$d12['1']);
    $titlepictmp = $titlepic;
    $gamepic=  str_replace("_300.jpg","_100.jpg",$d12['1']);

    // $gamebigpic = DoTranUrl($gamebigpic,$classid);
    // $titlepic = DoTranUrl($titlepic,$classid);
    // $gamepic = DoTranUrl($gamepic,$classid);
    // $gamebigpic = $gamebigpic['url'];
    // $titlepic = $titlepic['url'];
    // $gamepic = $gamepic['url'];

    $gamebigpic = self::saeup($gamebigpic,$classid,$s,$f);
    $titlepic = self::saeup($titlepic,$classid,$s,$f);
    $gamepic = $titlepic;

    //语言    </em>语言：<span>   </span>
    preg_match('/<\/em>语言：<span>(.*?)<\/span>/is',$content,$d14);
    //needframe "NeedFrame": " "
    preg_match('/"NeedFrame": "(.*?)"/is',$content,$d15);

    //=========================入库处理=============================================

    // ecms_infotmp_ i使用临时表的判断方法

    //$data = $empire->query("select * from u77u_ecms_game where flashurl_4usky = '{$swfold}'");
    //if($data=='' || $data==false)
    //{
    $havehtml=0;
    $time = time();
    // $isql=$empire->query("insert into u77u_ecms_game(id,classid,ttid,onclick,plnum,totaldown,newspath,filename,userid,username,firsttitle,isgood,ispic,istop,isqf,ismember,isurl,truetime,lastdotime,havehtml,groupid,userfen,titlefont,titleurl,stb,fstb,restb,keyboard,newstime,titlepic,gamebigpic,gamepic,title,width,height,flashurl,flashsay,operation,filesize,howtostart,gametarget,needframe,flashurl_4usky,language_4usky,cjinfo,titlepic_4usky,benlink) values('$id','$classid',0,0,0,0,'$newspath','$filename','1','show',0,0,'1',0,'0',0,'$isurl','$time','$time','$havehtml',0,0,'','$titleurl','1','1','1','','$time','$titlepic','$gamebigpic','$gamepic','$d1[1]','$d4[1]','$d5[1]','$swf','$d6[1]','$d7[1]','$d3[1]','$d11[1]','$d2[1]','$d15[1]','$swfold','$d14[1]','$cjinfo','$titlepictmp','$links');");

    $sql = "insert into show_game(`title`,`swf`,`swfold`,`gametarget`,`tags`,`classid`,`filesize`,`flashsay`
        ,`howtostart`,`operation`,`titlepic`,`gamebigpic`,`gamepic`,`width`,`height`,
        `benlink`,`timestamp`,`domain`) 
        values('$d1[1]','$swf','$swfold','$d2[1]','$d10[1]','$classid','$d3[1]','$d6[1]','$d11[1]','$d7[1]'
            ,'$titlepic','$gamebigpic','$gamepic','$d4[1]','$d5[1]','$links','$time','8')";
    // echo $sql;
    $sdb->query($sql);

    }

    function dosomething7k7k($classid,$data,$s,$f)
    {
        global $sdb;
    //  $url = "http://www.7k7k.com/flash_fl/478_new_1.htm";
        preg_match('/<div class="ui-slide-cont">(.*?)<div class="pagination"><div class="tag-page cf">/isU',$data,$tmp);
        // preg_match_all('/<div class="li-bot-div cf">\s*<a href="(.*?)" target="_blank" class="li-bot-div-a"><\/a>/is',$tmp[1],$linked);
        preg_match_all('/<li>\s*<a href="(.*?)" class="li-top-a" target="_blank"/is',$tmp[0],$linked);
        // var_dump($linked);exit();
        foreach($linked['1'] as $key=>$val)
        {
            $gurl = "http://www.7k7k.com";
            if(stristr($val,'http://t.app.') || stristr($val,'http://web.'))
            {
                continue;
            }
            if(stristr($val,'http://'))
            {
                $links = $val;
            }else{
                $links = $gurl.$val;
            }
            $picdata = $sdb->getone("select * from show_game where benlink = '{$links}'");
                if($picdata!='')
                {
                    continue;
                }
            $content = http::http_get($links);
            self::runGameDeail7k7k($classid,$content,$links,$s,$f);
            echo $links."\n";
         // exit();
        }
    }
    function runGameDeail7k7k($classid,$content,$links,$s,$f)
    {
    global $sdb;
    //部分信息要在播放页提取
    //$content = http_get("http://www.7k7k.com/flash/127373.htm");  //采集7K7K的数据使用旧版比较好? classic  //http://www.7k7k.com/flash/127373.htm
    $twolinks = str_replace("/flash/","/swf/",$links);
    $content2 = http::http_get($twolinks);

    //标题  "Name": "[参数]",   [参数1]
    preg_match('/<h1><a href=".*?" target="_self">(.*?)<\/a><\/h1>/is',$content,$d1);

    //swf源    <s></s><img src="[参数]" width="300" height="225" alt="(*)" />  [参数1]  TT:_300.jpg .swf   /img/  /flash/
    preg_match('/_gamepath = "(.*?)"/is',$content2,$d12);  //.html 替换为 .swf
    $d12[1] = str_replace(".html",".swf",$d12[1]);
    $d12[1] = trim($d12[1]);
    $swfold = $d12[1];
    // $swf = DoTranUrl($d12[1],$classid);
    // $swf = $swf['url'];
    $swf = self::saeup($d12[1],$classid,$s,$f);
    //简介
    preg_match('/<p class="game-describe">(.*?)<\/p>/is',$content,$d6);
    $d6['1'] = strip_tags($d6['1']);
    $d6['1'] = trim($d6['1']);
    //英文名 (英文名：[参数])  [参数1]
    preg_match('/\(英文名：(.*?)\)/is',$content,$two);
    //大小  大小：<span>   </span>
    preg_match('/大小：(.*?)<\/span>/is',$content,$d3);
    //宽度   "FlashWidth": "   ",
    preg_match('/_gamewidth =(.*?),/is',$content2,$d4);
    //高度   "FlashHeight": "  ",
    preg_match('/_gameheight =(.*?),/is',$content2,$d5);

    //操作   <h3>操作指南：</h3>(*)[参数]</p>    [参数1]</p>
    preg_match('/<div class="howto">\s*<ul>(.*?)<\/div>/is',$content,$d7); //(.*?)<\/p>
    $d7[1] = trim($d7[1]);
    //<h3>小游戏目标：(*)<p>[参数]</p>
    preg_match('/<h3>3.游戏目标<\/h3>\s*<p>(.*?)<\/p>\s*<\/li>/is',$content,$d2);  //d15

    //采集信息ID  "GameId":"  "
    preg_match('/_gameid = (.*?),/is',$content,$d8);

    //采集信息  <dt>标签</dt><dd>  </dd>
    // preg_match('/<dt>标签<\/dt><dd>(.*?)<\/dd>/is',$content,$d9);
    //TAG标签  <dt>标签</dt><dd>    </a></dd></dl>    TT:| ,  
    preg_match('/<div class="game-tag">标签：(.*?)<\/div>/is',$content,$d10);  //和d9差不多
    $cjinfo = $d10['1'];
    $d10['1'] = strip_tags($d10['1']);
    $d10['1'] = trim($d10['1']);
    $d10['1'] = str_replace(" ","",$d10['1']);
    $d10['1'] = str_replace("\n",",",$d10['1']);

    //如何开始  <h3>如何开始：(*)<p>[参数]</p>   [参数1]  TT:<br/>  
    preg_match('/<h3>2.如何开始<\/h3>\s*<p>(.*?)<\/p>/is',$content,$d11);
    //语言    </em>语言：<span>   </span>
    //preg_match('/<\/em>语言：<span>(.*?)<\/span>/is',$content,$d14);
    //7k7k 语言固定是中文
    $d14[1] = "中文";
    //needframe "NeedFrame": " "
    //preg_match('/_gamepath = "(.*?)"/is',$content2,$d15);
    $d15[1] = 0;

    //preg_match('/<img _src=".*" class="pic" width="300" height="200" alt="" src="(.*?)">/is',$content,$d13);
    preg_match('/_gamebigpic = "(.*?)"/is',$content2,$d13);
    preg_match('/_gamepic = "(.*?)"/is',$content,$d9);

    $d11[1] = str_replace("'",'"',$d11[1]);
    $d2[1] = str_replace("'",'"',$d2[1]);
    $d7[1] = str_replace("'",'"',$d7[1]);

    // $gamebigpic = DoTranUrl($d13[1],$classid);
    // $titlepic = DoTranUrl($d9[1],$classid);
    // $gamepic = DoTranUrl($d9[1],$classid);
    // $gamebigpic = $gamebigpic['url'];
    // $titlepic = $titlepic['url'];
    // $gamepic = $gamepic['url'];
    $gamebigpic = self::saeup($d13[1],$classid,$s,$f);
    $titlepic = self::saeup($d9[1],$classid,$s,$f);
    $gamepic = $titlepic;
    //=========================入库处理=============================================
    $time = time();
    //主表
    // $isurl=$r['titleurl']?1:0;
    // $isql=$empire->query("insert into u77u_ecms_game(id,classid,ttid,onclick,plnum,totaldown,newspath,filename,userid,username,firsttitle,isgood,ispic,istop,isqf,ismember,isurl,truetime,lastdotime,havehtml,groupid,userfen,titlefont,titleurl,stb,fstb,restb,keyboard,newstime,titlepic,gamebigpic,gamepic,title,width,height,flashurl,flashsay,operation,filesize,howtostart,gametarget,needframe,flashurl_4usky,language_4usky,cjinfo,titlepic_4usky,benlink) values('$id','$classid',0,0,0,0,'$newspath','$filename','1','show',0,0,'1',0,'0',0,'$isurl','$time','$time','$havehtml',0,0,'','$titleurl','1','1','1','','$time','$titlepic','$gamebigpic','$gamepic','$d1[1]','$d4[1]','$d5[1]','$swf','$d6[1]','$d7[1]','$d3[1]','$d11[1]','$d2[1]','$d15[1]','$swfold','$d14[1]','$cjinfo','$titlepictmp','$links');");
    $d6[1] = addslashes($d6[1]); 
    $sql = "insert into show_game(`title`,`swf`,`swfold`,`gametarget`,`tags`,`classid`,`filesize`,`flashsay`
        ,`howtostart`,`operation`,`titlepic`,`gamebigpic`,`gamepic`,`width`,`height`,
        `benlink`,`timestamp`,`domain`) 
        values('$d1[1]','$swf','$swfold','$d2[1]','$d10[1]','$classid','$d3[1]','$d6[1]','$d11[1]','$d7[1]'
            ,'$titlepic','$gamebigpic','$gamepic','$d4[1]','$d5[1]','$links','$time','8')";
    // echo $sql;
    $sdb->query($sql);
    }
    public static function dosomething4399($classid,$data,$s,$f)
    {
        global $sdb;
        preg_match('/<div class="class_l">(.*)<div class="b2"><\/div>/isU',$data,$tmp);

        preg_match_all('/<li><a href="(.*?)"><img.*?src="(.*?)" alt/is',$tmp[1],$linked);

        foreach($linked['1'] as $key=>$val)
        {
            $gurl = "http://www.4399.com";
            if(stristr($val,'http://sjsj.') || stristr($val,'http://web'))
            {
                continue;
            }
            if(stristr($val,'http://'))
            {
                $links = $val;
            }else{
                $links = $gurl.$val;
            }
    //      $links = "http://www.4399.com/flash/122571.htm";
            // $pictmp = $empire->query("select * from u77u_ecms_game where benlink = '{$links}'");
            // echo 'start';
            $sql = "select * from show_game where benlink='{$links}'";
            $picdata = $sdb->getone($sql);
            // var_dump($picdata);echo 'end';
                // $picdata = $empire->fetch($pictmp);
                if($picdata!='')
                {
                    continue;
                }
            $imgtubiao = $linked['2'][$key];
            $content = http::http_get($links);
            $content = string::toutf8($content,'gbk');
            listsModel::runGameDeail($classid,$content,$links,$imgtubiao,$s,$f);
            echo $links."<br/>";
    //      exit();
        }
    }
    /**
     * 入库
     * @param  [type] $classid   [description]
     * @param  [type] $content   [description]
     * @param  [type] $links     [description]
     * @param  string $imgtubiao [description]
     * @return [type]            [description]
     */
    public static function runGameDeail($classid,$content,$links,$imgtubiao='',$s,$f)
    {
        global $sdb;
    //$url = "http://www.4399.com/flash/131266.htm";

    //$content = http_get($url);
    //$content=DoIconvVal("GB2312","UTF8",$content);

    //标题  "Name": "[参数]",   [参数1]
    preg_match('/game_title="(.*?)",/is',$content,$d1);
    if(empty($d1['1']))
    {
        return '';
    }
    //<h3>小游戏目标：(*)<p>[参数]</p>
    preg_match('/<div class="game_caption">(.*?)<\/div>/is',$content,$d2);  //d15
    //大小  大小：<span>   </span>
    preg_match('/大小：(.*?)[\s|\n]/is',$content,$d3);

    //宽度   "FlashWidth": "   ",
    preg_match('/_w = (.*?),/is',$content,$d4);
    //高度   "FlashHeight": "  ",
    preg_match('/_h = (.*?),/is',$content,$d5);
    //简介
    preg_match('/<p id="introduce2">介绍：(.*?)<\/p>/is',$content,$d6);
    if(!empty($d6[0]))
    {
        $d6['1'] = strip_tags($d6['1']);
        $d6['1'] = trim($d6['1']);
    }else{
        $d6['1'] = "";
    }
    //操作   <h3>操作指南：</h3>(*)[参数]</p>    [参数1]</p>
    preg_match('/<div class="operate">(.*?)<h2 class="h2_t t6"/is',$content,$d7); //(.*?)<\/p>
    $d7[1] = '<div class="operate">'.trim($d7[1]);

    //采集信息ID  "GameId":"  "
    preg_match('/nFlashId="(.*?)",/is',$content,$d8);

    //图标
    //preg_match('/_gamepic = "(.*?)"/is',$content,$d9);

    //TAG标签  <dt>标签</dt><dd>    </a></dd></dl>    TT:| ,  
    preg_match('/专题：(.*?)<\/p><\/div>\s*<div class="game_info2">/is',$content,$d10);  //和d9差不多
    $cjinfo = $d10['1'];
    $d10['1'] = strip_tags($d10['1']);
    $d10['1'] = trim($d10['1']);
    $d10['1'] = str_replace("   ",",",$d10['1']);
    //var_dump($d10);exit();
    //如何开始  <h3>如何开始：(*)<p>[参数]</p>   [参数1]  TT:<br/>  
    preg_match('/<div class="game_caption">(.*?)<\/div>/is',$content,$d11);
    //swf源
    preg_match('/_strGamePath="(.*?)",/is',$content,$d12);

    $webServer = "http://sda.4399.com/4399swf";
    $d12[1] = $webServer.$d12[1];
    // var_dump($d12);
    $swfold = $d12[1];
    if(stristr($d12[1],'.htm'))
    {
        return '';
    }
    $url = $d12['1'];
    // $swf = DoTranUrl($d12[1],$classid);
    // $swf = $swf['url'];
    // $swf = file::saeup($d12['1']);
    $swf = self::saeup($url,$classid,$s,$f);
    // echo $swf;
    preg_match('/_strGamePic="(.*?)",/is',$content,$d13);
    $d14[1] = "中文";

    $tmparray = explode(".swf",$d12[1]);
    if(count($tmparray)>1){
        $d15[1] = 0;
    } else{
        $d15[1] = 1;
    }

    $cjinfo = str_replace("'",'"',$cjinfo);

    $d11[1] = str_replace("'",'"',$d11[1]);
    $d2[1] = str_replace("'",'"',$d2[1]);
    $d7[1] = str_replace("'",'"',$d7[1]);

    $gamebigpic = self::saeup($d13[1],$classid,$s,$f);

    $titlepic = self::saeup($imgtubiao,$classid,$s,$f);
    $gamepic = $titlepic;

    // $gamebigpic = $gamebigpic['url'];
    // $titlepic = $titlepic['url'];
    // $gamepic = $gamepic['url'];

    //=========================入库处理=============================================

    
    // $isql=$empire->query("insert into u77u_ecms_game(
    // id,classid,ttid,onclick,plnum,totaldown,newspath,filename,userid,username,
    // firsttitle,isgood,ispic,istop,isqf,ismember,isurl,truetime,lastdotime,havehtml,
    // groupid,userfen,titlefont,titleurl,stb,fstb,restb,keyboard,newstime,titlepic,gamebigpic,
    // gamepic,title,width,height,flashurl,flashsay,operation,filesize,howtostart,gametarget,needframe,
    // flashurl_4usky,language_4usky,cjinfo,titlepic_4usky,benlink) values('$id','$classid',0,0,0,0,
    // '$newspath','$filename','1','show',0,0,'1',0,'0',0,'$isurl','$time','$time','$havehtml',0,0,'',
    // '$titleurl','1','1','1','','$time','$titlepic','$gamebigpic','$gamepic','$d1[1]','$d4[1]','$d5[1]',
    // '$swf','$d6[1]','$d7[1]','$d3[1]','$d11[1]','$d2[1]','$d15[1]','$swfold','$d14[1]','$cjinfo','$titlepictmp','$links');");
    $time = time();
    $sql = "insert into show_game(`title`,`swf`,`swfold`,`gametarget`,`tags`,`classid`,`filesize`,`flashsay`
        ,`howtostart`,`operation`,`titlepic`,`gamebigpic`,`gamepic`,`width`,`height`,
        `benlink`,`timestamp`,`domain`) 
        values('$d1[1]','$swf','$swfold','$d2[1]','$d10[1]','$classid','$d3[1]','$d6[1]','$d11[1]','$d7[1]'
            ,'$titlepic','$gamebigpic','$gamepic','$d4[1]','$d5[1]','$links','$time','8')";
    // echo $sql;
    $sdb->query($sql);
    // exit();
    }
    //=========================xml============================
	/**
	 * 获取分段数据
	 * @return [type] [description]
	 */
    public static function getSite()
    {
    	global $sdb;
        $s =  new SaeStorage();
    	$sql = "select * from #pre#game order by timestamp "; //limit 100
    	// $result = $sdb->getall($sql);
        $query = $sdb->query($sql);
        $i=0;
        while($tt = mysql_fetch_array($query))
        {
            if(count($tmps)>=100)
            {
                $dat = self::itemxml($tmps);
                // var_dump($dat);exit();
                ++$i;
                $name = "/sitemapxml/maps_{$i}.xml";
                $s->write('8',$name,$dat);  
                unset($tmps);
            }
            $tmps[] =$tt;
        }
        
        if(!empty($tmps))
        {
            $dat =  self::itemxml($tmps);
            ++$i;
            $name = "/sitemapxml/maps_{$i}.xml";
            $s->write('8',$name,$dat);
        }

        $sql = "select * from #pre#tags";
        $query2 = $sdb->getall($sql);
        $dat = self::tagitemxml($query2);
        $s->write('8',"/sitemapxml/tags.xml",$dat);
        $index = self::getindex();
        $s->write('8',"/sitemapxml/index.xml",$index);
        $zuizhong = self::getXml($i);
        if($zuizhong)
        {
            $s->write('8','/sitemapxml/sitemap.xml',$zuizhong);    
        }    	
    }
    public static function tagitemxml($data)
    {
        $tmp=<<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
EOT;
    foreach($data as $key=>$val)
    {
        $time = time();
        // $date = strftime("%Y-%m-%d",$val['timestamp']);
        $date = strftime("%Y-%m-%d",$time);
        $tmp .= "<url>
                <loc>http://www.x99x.com/r/tags/{$val['id']}</loc>
                <lastmod>$date</lastmod>
                <changefreq>daily</changefreq>
                <priority>0.9</priority>
              </url>";
    }
$tmp.="</urlset>";
    return $tmp;
    }
    public static function itemxml($data)
    {
    	$tmp=<<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
EOT;
	foreach($data as $key=>$val)
	{
		$time = time();
		// $date = strftime("%Y-%m-%d",$val['timestamp']);
        $date = strftime("%Y-%m-%d",$time);
		$tmp .= "<url>
			    <loc>http://www.x99x.com/r/game/{$val['id']}</loc>
			    <lastmod>$date</lastmod>
			    <changefreq>daily</changefreq>
			    <priority>0.9</priority>
			  </url>";
	}
$tmp.="</urlset>";
    return $tmp;
    }
    /**
     * 首页那些
     * @return [type] [description]
     */
    public static function getindex()
    {
        $time = strftime("%Y-%m-%d",time());
        $tmp=<<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
EOT;
        $tmp .="
        <url>
            <loc>http://www.x99x.com/</loc>
            <lastmod>{$time}</lastmod>
            <priority>0.9</priority>
        </url>
        ";
        for($j=2;$i<=8;$i++)
        {
            $tmp .="
            <url>
                <loc>http://www.x99x.com/r/cate/{$i}</loc>
                <lastmod>{$time}</lastmod>
                <priority>0.9</priority>
            </url>
            ";
        }
        $tmp .="
            <url>
                <loc>http://www.x99x.com/r/cate/10</loc>
                <lastmod>{$time}</lastmod>
                <priority>0.9</priority>
            </url>
            ";
$tmp.="</urlset>";
    return $tmp;
    }
    /**
     * 分段 (每月一次?)
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public static function getXml($num)
    {
    $time = strftime("%Y-%m-%d",time());
    $tmp=<<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
EOT;
        //首页  栏目页也要生成
        $tmp .="<sitemap>
                <loc>http://www.x99x.com/sitemapxml/index.xml</loc>
                <lastmod>{$time}</lastmod>
              </sitemap>";
        
    	if($num)
    	{
    		for($i=1;$i<=$num;$i++)
    		{
                
    			$tmp .="<sitemap>
			    <loc>http://www.x99x.com/sitemapxml/maps_{$i}.xml</loc>
			    <lastmod>{$time}</lastmod>
			  </sitemap>";
    		}
    	}
        $tmp .="<sitemap>
                <loc>http://www.x99x.com/sitemapxml/tags.xml</loc>
                <lastmod>{$time}</lastmod>
              </sitemap>";

    	$tmp.="</sitemapindex>";
        $url = PHPBODY."/sitemapxml.xml"; //哎，sae真麻烦
        return $tmp;
    }
}