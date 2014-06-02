<?php
/**
 * 缓存 方法
 * Author show
 * copyright phpbody (www.phpbody.com)
 */
class cache{
	public $mmc;
    /**
     * 设置缓存
     * @param [type] $value [description]
     */
	public function __constract()
	{
		self::init();
	}
	public function init()
	{
		$this->mmc=memcache_init();
	}
    public static function set($prefix, $key, $value, $cachetime='10800') //-1
    {
        $mmc=memcache_init();
        $test = memcache_set($mmc,$prefix.$key,$value,$cachetime);
    }
    /**
     * 获陬缓存
     * @param [type] $key [description]
     */
    public static function get($prefix, $key)
    {
        $mmc=memcache_init();
       $data = memcache_get($mmc,$prefix.$key);
       return $data;
    }
}