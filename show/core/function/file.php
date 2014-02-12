<?php
/**
 * 文件操作相关
 * Author show
 * copyright phpbody (www.phpbody.com)
 */
Class file{
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
