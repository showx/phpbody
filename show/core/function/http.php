<?php
if(!defined('BODY')){exit();}
/**
* 网络辅助类
* Author show
* copyright phpbody (www.phpbody.com)
*/
Class http{
    /**
    * 获取header
    */
    public static function get_header($url){
        $ch  = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_NOBODY,true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_AUTOREFERER,true);
        curl_setopt($ch, CURLOPT_TIMEOUT,30);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Accept: */*',
        'User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)',
        'Connection: Keep-Alive'));
        $header = curl_exec($ch);
        return $header;
    }
    /*
     * http get函数
     * @parem $url
     * @parem $$timeout=30
     * @parem $referer_url=''
     */
    public static function http_get($url, $timeout=30, $referer_url='')
    {
        $startt = time();
        if (function_exists('curl_init'))
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            if( $referer_url != '' )  curl_setopt($ch, CURLOPT_REFERER, $referer_url);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.2; zh-CN; rv:1.9.2.13) Gecko/20101203 Firefox/3.6.13');
            $result = curl_exec($ch);
            $errno  = curl_errno($ch);
            curl_close($ch);
            return $result;
        }
        else
        {
            $Referer = ($referer_url=='' ?  '' : "Referer:{$referer_url}\r\n");
            $context =
            array('http' =>
                array('method' => 'GET',
                  'header' => 'User-Agent:'.'Mozilla/5.0 (Windows; U; Windows NT 5.2; zh-CN; rv:1.9.2.13) Gecko/20101203 Firefox/3.6.13'."\r\n".$Referer
                )
            );
            $contextid = stream_context_create($context);
            $sock = fopen($url, 'r', false, $contextid);
            stream_set_timeout($sock, $timeout);
            if($sock)
            {
                $result = '';
                while (!feof($sock)) {
                    //$result .= stream_get_line($sock, 10240, "\n");
                    $result .= fgets($sock, 4096);
                    if( time() - $startt > $timeout ) {
                        return '';
                    }
                }
                fclose($sock);
            }
        }
        return $result;
    }
    /**
     * php的header相关操作
     * @param  string $type [description]
     * @param  [type] $tmp  [description]
     * @return [type]       [description]
     */
    public static function switchheader($type='',$tmp)
    {
      if($type=="xml")
      {
        header('Content-Type: text/xml');
      }elseif($type=="nocache")
      {
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Cache-Control: no-cache");
        header("Pragma: no-cache");
      }elseif($type=="pdf")
      {
        header("Content-type:application/pdf");
        header("Content-Disposition:attachment;filename='{$tmp}'");
      }elseif($type=="charset")
      {
        header("Content-type: text/html; charset={$tmp}"); //默认是utf-8
      }elseif($type=="location")
      {
        header("Location:{$tmp}");
      }
       
    }
    /**
     * post 
     * @param  [type] $url   [description]
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public static function  pcurl($url,$param)
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
    public static function  url_fetch($url) {
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
    public static function  check_url ($url) { 
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
    /**
     * 获取IP地址
     * @return [type] [description]
     */
    public static function getClientIp()
    {
        $client_ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
        if(empty($client_ip))
        {
            $ip = "0.0.0.0";
        }
        return $client_ip;
    }
    /**
     * 获取IP地区
     * @param  [type] $ip [description]
     * @return [type]     [description]
     */
   public static function convertip($ip) { 
      $ip1num = 0;
      $ip2num = 0;
      $ipAddr1 ="";
      $ipAddr2 ="";
      $dat_path = SHOWFUNCTION.'/ip/qqwry.dat';        
      if(!preg_match("/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/", $ip)) { 
        return 'IP Address Error'; 
      }  
      if(!$fd = @fopen($dat_path, 'rb')){ 
        return 'IP date file not exists or access denied'; 
      }  
      $ip = explode('.', $ip); 
      $ipNum = $ip[0] * 16777216 + $ip[1] * 65536 + $ip[2] * 256 + $ip[3];  
      $DataBegin = fread($fd, 4); 
      $DataEnd = fread($fd, 4); 
      $ipbegin = implode('', unpack('L', $DataBegin)); 
      if($ipbegin < 0) $ipbegin += pow(2, 32); 
        $ipend = implode('', unpack('L', $DataEnd)); 
      if($ipend < 0) $ipend += pow(2, 32); 
        $ipAllNum = ($ipend - $ipbegin) / 7 + 1; 
      $BeginNum = 0; 
      $EndNum = $ipAllNum;  
      while($ip1num>$ipNum || $ip2num<$ipNum) { 
        $Middle= intval(($EndNum + $BeginNum) / 2); 
        fseek($fd, $ipbegin + 7 * $Middle); 
        $ipData1 = fread($fd, 4); 
        if(strlen($ipData1) < 4) { 
          fclose($fd); 
          return 'System Error'; 
        }
        $ip1num = implode('', unpack('L', $ipData1)); 
        if($ip1num < 0) $ip1num += pow(2, 32); 

        if($ip1num > $ipNum) { 
          $EndNum = $Middle; 
          continue; 
        } 
        $DataSeek = fread($fd, 3); 
        if(strlen($DataSeek) < 3) { 
          fclose($fd); 
          return 'System Error'; 
        } 
        $DataSeek = implode('', unpack('L', $DataSeek.chr(0))); 
        fseek($fd, $DataSeek); 
        $ipData2 = fread($fd, 4); 
        if(strlen($ipData2) < 4) { 
          fclose($fd); 
          return 'System Error'; 
        } 
        $ip2num = implode('', unpack('L', $ipData2)); 
        if($ip2num < 0) $ip2num += pow(2, 32);  
          if($ip2num < $ipNum) { 
            if($Middle == $BeginNum) { 
              fclose($fd); 
              return 'Unknown'; 
            } 
            $BeginNum = $Middle; 
          } 
        }  
        $ipFlag = fread($fd, 1); 
        if($ipFlag == chr(1)) { 
          $ipSeek = fread($fd, 3); 
          if(strlen($ipSeek) < 3) { 
            fclose($fd); 
            return 'System Error'; 
          } 
          $ipSeek = implode('', unpack('L', $ipSeek.chr(0))); 
          fseek($fd, $ipSeek); 
          $ipFlag = fread($fd, 1); 
        } 
        if($ipFlag == chr(2)) { 
          $AddrSeek = fread($fd, 3); 
          if(strlen($AddrSeek) < 3) { 
          fclose($fd); 
          return 'System Error'; 
        } 
        $ipFlag = fread($fd, 1); 
        if($ipFlag == chr(2)) { 
          $AddrSeek2 = fread($fd, 3); 
          if(strlen($AddrSeek2) < 3) { 
            fclose($fd); 
            return 'System Error'; 
          } 
          $AddrSeek2 = implode('', unpack('L', $AddrSeek2.chr(0))); 
          fseek($fd, $AddrSeek2); 
        } else { 
          fseek($fd, -1, SEEK_CUR); 
        } 
        while(($char = fread($fd, 1)) != chr(0)) 
        $ipAddr2 .= $char; 
        $AddrSeek = implode('', unpack('L', $AddrSeek.chr(0))); 
        fseek($fd, $AddrSeek); 
        while(($char = fread($fd, 1)) != chr(0)) 
        $ipAddr1 .= $char; 
      } else { 
        fseek($fd, -1, SEEK_CUR); 
        while(($char = fread($fd, 1)) != chr(0)) 
        $ipAddr1 .= $char; 
        $ipFlag = fread($fd, 1); 
        if($ipFlag == chr(2)) { 
          $AddrSeek2 = fread($fd, 3); 
          if(strlen($AddrSeek2) < 3) { 
            fclose($fd); 
            return 'System Error'; 
          } 
          $AddrSeek2 = implode('', unpack('L', $AddrSeek2.chr(0))); 
          fseek($fd, $AddrSeek2); 
        } else { 
          fseek($fd, -1, SEEK_CUR); 
        } 
        while(($char = fread($fd, 1)) != chr(0)){ 
          $ipAddr2 .= $char; 
        } 
      } 
      fclose($fd);  
      if(preg_match('/http/i', $ipAddr2)) { 
        $ipAddr2 = ''; 
      } 
      $ipaddr = "$ipAddr1 $ipAddr2"; 
      $ipaddr = preg_replace('/CZ88.NET/is', '', $ipaddr); 
      $ipaddr = preg_replace('/^s*/is', '', $ipaddr); 
      $ipaddr = preg_replace('/s*$/is', '', $ipaddr); 
      if(preg_match('/http/i', $ipaddr) || $ipaddr == '') { 
        $ipaddr = 'Unknown'; 
      } 
      return $ipaddr; 
    }
}
?>
