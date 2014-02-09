<?php
class gearman
{
    private static $gearman_client = null;
    private static $gearman_server = null;

    /**
     * Gearman 任务添加
     *
     * @param int $gearman_server
     * @param string $function_name
     * @param array $function_param
     * @param int $level
     * @param string $complete_callback_function_name
     * @return string
     */
    public static function add_job($gearman_server = '', $function_name, $function_param, $level = 0, $complete_callback_function_name = '')
    {
        /* 初始化 */
        if(!is_object(self::$gearman_client))
        {
            self::$gearman_client = new GearmanClient();
            $link = self::$gearman_client->addServers($gearman_server);
            if($link !== true)
            {
                return null;
            }
        }
        /* 系列化参数 */
        if(is_array($function_param))
        {
            $function_param = serialize($function_param);
        }
        /* 执行等级 */
        switch ((int)$level)
        {
            case 0:
                $handle =  self::$gearman_client->addTask($function_name, $function_param);
                break;
            case 1:
                $handle =  self::$gearman_client->addTaskHighBackground($function_name, $function_param);
                break;
            case 2:
                $handle =  self::$gearman_client->addTaskBackground($function_name, $function_param);
                break;
            case 3:
                $handle =  self::$gearman_client->addTaskLowBackground($function_name, $function_param);
                break;
        }
        /* 回调函数 */
        if(!empty($complete_callback_function_name))
        {
            self::$gearman_client->setCompleteCallback($complete_callback_function_name); // 回调会阻塞
        }
        return self::$gearman_client->runTasks();
    }

    /**
     * Gearman 任务执行
     *
     * @param string $gearman_server
     * @param string $function_name
     * @param string $callback_function_name
     * @return void
     */
    public static function do_job($gearman_server = '', $function_name, $callback_function_name = '')
    {
        /* 初始化 */
        if(!is_object(self::$gearman_server))
        {
            self::$gearman_server = new GearmanWorker();
            //self::$gearman_server->addServers($gearman_server);
            $gearman_server = explode(",", $gearman_server);
            foreach ($gearman_server as $v)
            {
                self::$gearman_server->addServers($v);
            }
        }
        self::$gearman_server->addFunction($function_name, $callback_function_name);
        while(self::$gearman_server->work())
        {
            $return_code = self::$gearman_server->returnCode();
            if ($return_code != GEARMAN_SUCCESS)
            {
                echo "return_code: ".$return_code."\n";
                break;
            }
        }
    }
}