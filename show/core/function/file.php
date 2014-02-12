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
    public static function createlistindex()
    {
        $dh = opendir(PHPBODY);

    }
    public static function putlog()
    {
        $string = "<?php exit();?>";
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
    public static function scandir()
    {
        if($dh = opendir($path))
        {
            while (($file = readdir($dh)) !== false) {
                if($file!='.' || $file!='..')
                {

                }
            }

        }
    }
    /**
     * 删除目录
     * @return [type] [description]
     */
    public static function deldir()
    {

    }
}
?>
