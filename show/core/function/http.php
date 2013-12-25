<?php
Class http{
    /**
     * post 
     * @param  [type] $url   [description]
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    function pcurl($url,$param)
    {
        $param = http_build_query($param);
        $curl = curl_init($url);   
        curl_setopt($curl, CURLOPT_FAILONERROR, 1); 
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 5);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $param);
        $r = curl_exec($curl);
        curl_close($curl);
        return $r;
    }
    /**
     * 普通下载
     * @param  [type] $url [description]
     * @return [type]      [description]
     */
    function url_fetch($url) {
        $contents='';
        if (function_exists('curl_init')) {
            $ch=curl_init();
            curl_setopt($ch,CURLOPT_TIMEOUT,10);
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,10);
            curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
            $contents=trim(curl_exec($ch));
            curl_close($ch);
            return $contents;
        }else{
            file_get_contents($url);
        }
    }
    function check_url ($url) { 
            $url_pieces = parse_url ($url);
            $path = (isset($url_pieces['path'])) ? $url_pieces['path'] :  '/'; 
            $port = (isset($url_pieces['port'])) ? $url_pieces['port'] : 80; 
            if ($fp = @fsockopen ($url_pieces['host'], $port, $errno, $errstr, 30)) { 
                    $send = "HEAD $path HTTP/1.1\r\n";
                    $send .= "HOST: {$url_pieces['host']}\r\n";
                    $send .= "CONNECTION: Close\r\n\r\n";
                    fwrite($fp, $send);
                    $data = fgets ($fp, 128); 
                    fclose($fp); 
                    list($response, $code) = explode (' ', $data); 
                    if ($code == 200) {
                            return array($code, 'good');
                    } else {
                            return array($code, 'bad');
                    }
            } else {
                    return array($errstr, 'bad');
            }
    }
}
?>
