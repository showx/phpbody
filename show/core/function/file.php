<?php
if(!defined('BODY')){exit();}
/**
 * 文件操作相关
 * Author show
 * copyright phpbody (www.phpbody.com)
 */
Class file{
    /**
     * 生成默认index文件
     * 避免列出目录漏洞，
     * 扫描目录，生成默认index文件是有必要的
     */
    public static function createlistindex($path=PHPBODY)
    {
        $files = self::scandir($path."/");
        self::createindex($files);
    }
    /**
     * 生成index.php文件
     * @param  [type] $files [description]
     * @return [type]        [description]
     */
    public static function createindex($files)
    {
        //form::sbug($files);
        foreach($files as $key=>$val)
        {
            if(is_dir($val))
            {
                self::createlistindex($val);
                if(!file_exists($val."/index.php"))
                {
                    file_put_contents($val."/index.php", "no hack!");
                }
            }
        }
    }
    /**
     * 写入日志
     * @param  [type] $filename [description]
     * @param  [type] $log      [description]
     * @return [type]           [description]
     */
    public static function putlog($filename,$log);
    {
        $string = "<?php exit();?>";
        $logpath = PHPBODY."/show/debug/log/";
        file_put_contents($logpath.$filename,$log,FILE_APPEND);
    }
    /**
     * 要有后台查看log的功能
     * @param  [type] $filename [description]
     * @return [type]           [description]
     */
    public static function getlog($filename)
    {
        if(file_exists($filename))
        {
            $neirong = file_get_contents($filename);
            return $neirong;
        }
    }
    /**
     * 获取文件缓存
     * @param  [type] $name [description]
     * @return [type]       [description]
     */
    public static function filecache_get($name)
    {

    }
    /**
     * 设置文件缓存
     * @param  [type] $name [description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public static function filecache_put($name,$data)
    {

    }
    /**
     * 删除超时的文件缓存
     * @param  [type] $name [description]
     * @return [type]       [description]
     */
    public static function filecache_del($name)
    {

    }
    /**
     * 写入文件
     * @param  [type] $file [description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public static function writefile($file,$data)
    {
        try {
            if (!$fp = fopen($file, 'w')) {
                    throw new Exception('不能打开文件');
            }
            if (!fwrite($fp, $data)) {
                    throw new Exception('不能写入文件');
            }
            if (!fclose($fp)) {
                    throw new Exception('不能关闭文件');
            }
            return '写入成功';
            } catch (Exception $e) {
                    return $e->getMessage();
            }
    }
    /**
     * 上传文件
     * @return [type] [description]
     */
    public static function upload()
    {
        
    }
    /**
     * 自动生成伪静态规则 (nginx|apache|sae)
     * 机器生成方便服务器填写
     * @return [type] [description]
     */
    public static function cratejingtai($txt,$type)
    {

    }
    /**
     * 遍历目录
     * @return [type] [description]
     */
    public static function scandir($path,$repath='true')
    {
        $files = '';
        if($dh = opendir($path))
        {
            while (($file = readdir($dh)) !== false) {
                if($file!="." || $file!='..' || $file!='phpbody.git' )
                {
                    if($file =='.' || $file =='..' || $file=='.git')
                    {
                        continue;
                    }
                    //echo $file."<br/>";
                    if($repath)
                    {
                        $files[] = $path.$file;    
                    }
                    
                }
            }
            return $files;
        }
    }
    /**
     * 删除目录
     * @return [type] [description]
     */
    public static function deldir($path)
    {  
        if(is_dir($path))
        {
            @rmdir($path);
            return true;    
        }
        return false;
    }
    /**
     * 删除文件
     * @param  [type] $file [description]
     * @param  string $path [description]
     * @return [type]       [description]
     */
    public static function delfile($file,$path='')
    {
        if(file_exists($path.$file))
        {
            @unlink($path.$file);   
            return true; 
        }
        return false;
    }
    /**
     * 写入文件
     * @param  [type] $file [description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public static function wfile($file,$data)
    {
        if(is_writable($file))
        {
            if (!$handle = fopen($filename, 'a')) {  //is_readable
                 return false;
            }
            if (!fwrite($handle, $data)) {
                return false;
            }
            fclose($handle);
            return true;
        }
        return false;
    }
    /**
     * 生成网站地图
     * @return [type] [description]
     */
    public static function sitemap($data)
    {
        $tmp = "";
        foreach($data as $key=>$val)
        {
     $tmp .="<url>
            <loc>{$val['url']}</loc>
            <lastmod>{$val['time']}</lastmod>
            <changefreq>hourly</changefreq>
            <priority>0.9</priority>
            </url>
            ";
        }
        file_put_contents(PHPBODY."/sitemap.xml",$tmp);

    }
    /**
     * 输出图片
     * @param  [type] $type [description]
     * @param  [type] $img  [description]
     * @return [type]       [description]
     */
    public static function oimg($type,$img){
    switch($type) {
        case IMAGETYPE_JPEG :
            header('Content-type: image/jpeg');
            imagejpeg($img);
            break;
        case IMAGETYPE_PNG :
            header('Content-type: image/png');
            imagepng($img);
            break;
        case IMAGETYPE_GIF :
            header('Content-type: image/gif');
            imagegif($img);
            break;
        default:
            break;
    }
    }
    /**
     * 保存为Alpha值的图片
     * @param string $fileName [description]
     */
    public static function imgalpha($fileName='',$dimg){
        $fileName = $fileName.'.png';
        imagesavealpha($img, true);
        imagepng($dimg,$fileName);
    }
    /**
     * 输出alpha的图片
     */
    public static function oimgalpha($dimg){
        imagesavealpha($dimg, true);
        header('Content-type: image/png');
        imagepng($dimg);
    } 
}
?>