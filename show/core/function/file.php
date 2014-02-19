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
    public static function putlog($filename,$log);
    {
        $string = "<?php exit();?>";
        $logpath = PHPBODY."/show/debug/log/";
        file_put_contents($logpath.$filename,$log,FILE_APPEND);
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
}
?>
