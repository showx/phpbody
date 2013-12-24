<?php
Class http{
    function curl($url,$param)
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
