<?php
/*
 * excel操作类
 * Author show
 * copyright phpbody (www.phpbody.com)
 */
require_once realpath(dirname(__FILE__)).'/excel/PHPExcel.php';
require_once realpath(dirname(__FILE__)).'/excel/PHPExcel/Writer/Excel5.php';
require_once realpath(dirname(__FILE__)).'/excel/PHPExcel/Writer/Excel2007.php';
class excel
{
        private $objExcel;
        private $objWriter;
        private $objActSheet;
	public function __construct() {
		$this->objExcel =  new PHPExcel();
		$this->objWriter = new PHPExcel_Writer_Excel5($this->objExcel);
//$objWriter = new PHPExcel_Writer_Excel2007($objExcel);
		$this->objExcel->setActiveSheetIndex(0);
		$this->objActSheet = $this->objExcel->getActiveSheet();
	}
        //二维数组传入法 竖
	public function disarray($arr)
        {
            $abcstring =array ('A' ,'B' ,'C' ,'D' ,'E' ,'F' ,'G' ,'H' ,'I' ,'J' ,'K' ,'L' ,'M' ,'N' ,'O' ,'P' ,'Q' ,'R' ,'S' ,'T' ,'U' ,'V' ,'W' ,'X' ,'Y' ,'Z' ,'AA' ,'AB' ,'AC' ,'AD' ,'AE' ,'AF' ,'AG' ,'AH' ,'AI' ,'AJ' ,'AK' ,'AL' ,'AM' ,'AN' ,'AO' ,'AP' ,'AQ' ,'AR' ,'AS' ,'AT' ,'AU' ,'AV' ,'AW' ,'AX' ,'AY' ,'AZ' ,'BA' ,'BB' ,'BC' ,'BD' ,'BE' ,'BF' ,'BG' ,'BH' ,'BI' ,'BJ' ,'BK' ,'BL' ,'BM' ,'BN' ,'BO' ,'BP' ,'BQ' ,'BR' ,'BS' ,'BT' ,'BU' ,'BV' ,'BW' ,'BX' ,'BY' ,'BZ' );
            $i=1;
            foreach($arr as $key => $val)
            {
                
                foreach($val as $ek => $ev)
                {
                    $j=0;
                    foreach($ev as $k =>$v)
                    {
                        if(is_array($v))
                        {
                            $i=0;
                            foreach($v as $zk => $zv)
                            {
                                self::dataset($abcstring[$j].$i ,$zv);
                            }
                        }
                        else
                        {
                            self::dataset($abcstring[$j].$i ,$v);
                        }
                        $j++;
                    }
                     $i++;
                }
//                $i++;
            }
        }
        //二维数组传入法 横
        public function disarray_hen($arr)
        {
            $abcstring =array ('A' ,'B' ,'C' ,'D' ,'E' ,'F' ,'G' ,'H' ,'I' ,'J' ,'K' ,'L' ,'M' ,'N' ,'O' ,'P' ,'Q' ,'R' ,'S' ,'T' ,'U' ,'V' ,'W' ,'X' ,'Y' ,'Z' ,'AA' ,'AB' ,'AC' ,'AD' ,'AE' ,'AF' ,'AG' ,'AH' ,'AI' ,'AJ' ,'AK' ,'AL' ,'AM' ,'AN' ,'AO' ,'AP' ,'AQ' ,'AR' ,'AS' ,'AT' ,'AU' ,'AV' ,'AW' ,'AX' ,'AY' ,'AZ' ,'BA' ,'BB' ,'BC' ,'BD' ,'BE' ,'BF' ,'BG' ,'BH' ,'BI' ,'BJ' ,'BK' ,'BL' ,'BM' ,'BN' ,'BO' ,'BP' ,'BQ' ,'BR' ,'BS' ,'BT' ,'BU' ,'BV' ,'BW' ,'BX' ,'BY' ,'BZ' );
            $bian=0;
            foreach($arr as $key => $val)
            {
                $i=1;
                foreach($val as $ek => $ev)
                {
                    $j=$bian;
                    foreach($ev as $k =>$v)
                    {
                        self::dataset($abcstring[$j].$i ,$v);
                        $j++;
                    }
                     $i++;
                }
                $bian+=2;
//                $i++;
            }
        }
	public function dataset($weizhi,$zhi)
	{
//		$this->objActSheet->setCellValue($weizhi,iconv("gbk", "utf-8", "{$zhi}"));
		$this->objActSheet->setCellValue($weizhi,$zhi);
//                $k=$this->objActSheet->getCell('A1');
//                var_dump($k);
	}
	
	public function display($outputFileName)
	{ 
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		header('Content-Disposition:inline;filename="'.$outputFileName.'"');
		header("Content-Transfer-Encoding: binary");
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Pragma: no-cache");
		return $this->objWriter->save('php://output');
	}
}
?>