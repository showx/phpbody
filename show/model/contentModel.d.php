<?php
if(!defined('BODY')){exit();}
/**
* 内容相关
* Author show
* copyright phpbody (www.phpbody.com)
*/
class contentModel extends base{
	/**
	*  添加文章 
	*/
	public static function contentadd($arr)
    {
        global $sdb;
        $time = time();
        $sql = "insert into #pre#content(`title`,`content`,`categoryid`,`tags`,`timestamp`) 
        values('{$arr['title']}','{$arr['content']}','{$arr['categoryid']}','{$arr['tags']}','{$time}');";
        $return = $sdb->query($sql);
        return $return;
    }
    
    public function gettags($classid,$limit=10)
    {
      global $sdb;
      $sql = "select * from #pre#tags where classid='{$classid}' limit {$limit}";
      $result = $sdb->getall($sql);
      return $result;
    }
    /**
    * 友情链接
    */
    public static function friendlink($type)
    {
      global $sdb;
      if($type=='')
      {
        $where1 =' or type is null';
      }
      $sql = "select * from #pre#links where type='{$type}' $where1";
      $result = $sdb->getall($sql);
      return $result;
    }
    public function comment(){
          $validate = req::item('validate', '');
          $itemid = req::item('itemid', '');
          $comment = req::item('comment', '');
          $ip = util::get_client_ip();
          $vdimg = new cls_securimage();
          if( empty($validate) || !$vdimg->check($validate) )
          {
              echo 'Error：请输入正确的验证码！';exit();
          }else{
            $acctl   = cls_access::factory('member');
            $fields   = $acctl->fields;
            $time = time();
            if(isset($fields['uid']) && isset($fields['user_name']))
            {
                if($itemid =='' || $comment ==''){echo '内部错误';exit();}
                $sql = "insert into comments(`gameid`,`userid`,`username`,`message`,`dateline`,`ip`) values('{$itemid}','{$fields['uid']}','{$fields['user_name']}','{$comment}','{$time}','{$ip}')";
                $result = db::query($sql);
                echo '请等待审核';exit();
            }else{
                echo '请登录用户';exit();
            }
          }
    }
    /**
     * 更新点击
     * @param [type] $gameid [description]
     */
    public static function UpdateGameWithid($gameid)
    {
      global $sdb;
        // $gameid = req::item('gameid', '');
        $sql = "update show_game set onclick=onclick+1 where id='{$gameid}'";
        $test = $sdb->query($sql,'nocache');
        echo "<!-- ok {$test}-->";
    }
    /**
     * 获取游戏的详细
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public static function getGameDetail($id)
    {
    	global $sdb;
    	$sql = "select * from #pre#game where id='{$id}'";
    	$one = $sdb->getone($sql);
    	return $one;
    } 
    /**
     * 随机游戏
     * 但这算法不太好
     * @param  [type] $index [description]
     * @return [type]        [description]
     */
    public static function getGame2($index)
    {
        global $sdb;
        $sql = "select * from game where cate={$index} order by rand() limit 10";
        $result = $sdb->getall($a);
        return $result;
        
    }
    public static function getCount($classid)
    { 
      global $sdb;

        $count = $sdb->getone("select count(*) as c from show_game where classid='$classid'");
        $count = $count['c'];
        return $count;
    }
    /**
    * 获取攻略总数
    */
    public function getgonglue($keyword='')
    {
      global $sdb;
      if($keyword)
      {
        $where = " and title like '%{$keyword}%' ";
      }
      $count =  $sdb->getone("select count(*) as c from #pre#gonglue where 1 {$where}");
      return $count['c'];
    }
    /**
    * 获取攻略 
    */
    public static function getPgonglue($page,$limit,$keyword='')
    {
      global $sdb;
      $page = ($page-1) * $limit;
      if($keyword)
      {
        $where = " and title like '%{$keyword}%' ";
      }
      $sql = "select * from #pre#gonglue where 1 {$where} order by timestamp desc limit {$page},{$limit}";
      $result = $sdb->getall($sql);
      return $result;
    }
    public static function getPdata($classid,$page,$limit)
    {
      global $sdb;
      $page = ($page-1) * $limit;
      $sql = "select * from #pre#game where classid='{$classid}' order by timestamp desc limit {$page},{$limit}";
      $result = $sdb->getall($sql);
      return $result;
    }
    public static function getGame2d($index,$limit='10',$shu='10')
    {
        global $sdb;
        $count = $sdb->getone("select count(*) as c from show_game");
        $count = $count['c'];
        $idlist=''; 
        for($i=1;$i<=$shu;$i++){ 
            if($i==1){ 
                $idlist=mt_rand(3,$count); 
            } 
            else{ 
                $idlist=$idlist.','.mt_rand(3,$count); 
            } 
        } 
        $sql = "select * from #pre#game where  id in ($idlist)  limit {$limit}"; //classid='{$index}' and

        $result = $sdb->getall($sql);
        return $result;
        
    }
    /**
     * 栏目下的游戏
     * @param  [type] $id    [description]
     * @param  string $limit [description]
     * @return [type]        [description]
     */
	public static function getGame($id,$limit='10',$page,$orderby='')
	{
		global $sdb;
    $order = '';
    if($orderby == 'rand')
    {
      $result = self::getGame2d($id,$limit,$limit);
      return $result;
    }elseif($orderby == 'click')
    {
       $order = "order by onclick desc";
    }elseif($orderby == 'timestamp')
    {
      $order = "order by timestamp desc";
    }

    $tmp = explode(",",$id);
    if($tmp)
    {
      $tmp = implode("','",$tmp);
      $where = " classid in ('{$tmp}') ";
    }else{
      $where = " classid ='{$id}'";
    }

		$sql = "select * from show_game where {$where} {$order} limit {$page},{$limit}";
		$result = $sdb->getall($sql);
		return $result;
	}
    public static function getP($index)
    {
        global $sdb;
        $sql = "select * from game where classid='{$index}' order by click desc limit 10";
        $result = $sdb->getall($sql);
        return $result;
        
    }
    public static function getComment2($gameid){
       global $sdb;
        if(!empty($gameid)){
            $sql = "select * from show_comments where gameid='{$gameid}' and ping ='1'";
            $result = $sdb->getall($sql);
            return $result;
        }
        
        return '';
    }
    public static function getliketagsCount($id)
    {
      global $sdb;
      $s = "select * from #pre#tags where id='{$id}'";
      $one = $sdb->getone($s);
      $sql = "select count(*) as c from #pre#game where tags like '%{$one['tagname']}%'";
      $data = $sdb->getone($sql);
      return $data['c'];
    }
    public static function getliketags($id,$page=1,$limit='limit')
    {
      global $sdb;
      $page = ($page-1) * $limit;
      $s = "select * from #pre#tags where id='{$id}'";
      $one = $sdb->getone($s);
      $sql = "select * from #pre#game where tags like '%{$one['tagname']}%' limit $page,$limit";
      $data = $sdb->getall($sql);
      return $data;
    }
    /**
     * 搜索游戏
     * @param  [type] $word [description]
     * @return [type]       [description]
     */
    public static function getSearchGame($word,$limit=20){
        global $sdb;
        if(!empty($word)){
            $sql = "select * from #pre#game where title like '%".$word."%' limit {$limit}";
            $result = $sdb->getall($sql);
            return $result;
        }
        
        return '';
    }
    public static function getTagsdd($id)
    {
      global $sdb;
      $one = $sdb->getone("select * from #pre#tags where id ='{$id}'");
      return $one;
    }
    public static function getTagsid($name)
    {
      global $sdb;
      $one = $sdb->getone("select * from #pre#tags where tagname ='{$name}'");
      return $one;
    }
    public static function getcomment($id)
    {
      global $sdb;
      $result = $sdb->getall("select * from #pre#comment where gameid='{$id}' order by timestamp ");
      return $result;
    }
    /**
    * 搜索攻略
    * 
    */
    public function getSearchGL($word){
        global $sdb;
        if(!empty($word)){
            $sql = "select * from gonglue where title like '%".$word."%'";
            $result = $sdb->getall($sql);
            return $result;
        }
        
    }
}