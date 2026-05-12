<?php
include('simple_html_dom.php');
@set_time_limit(60 * 180);
$link = "http://www.minhngoc.net.vn/ket-qua-xo-so/mien-bac.html";
$html = file_get_html($link);
$body = $html->find('table[class="bkqtinhmienbac"]',0);
$date = isset($_REQUEST['date'])?$_REQUEST['date']:date("Y-m-d");
//echo $body;
$gdb = str_replace(array("</div><div>","<div>","</div>"),array("-","",""),$body->find('td[class="giaidb"]',0)->innertext);
$g1 = str_replace(array("</div><div>","<div>","</div>"),array("-","",""),$body->find('td[class="giai1"]',0)->innertext);
$g2 = str_replace(array("</div><div>","<div>","</div>"),array("-","",""),$body->find('td[class="giai2"]',0)->innertext);
$g3 = str_replace(array("</div><div>","<div>","</div>"),array("-","",""),$body->find('td[class="giai3"]',0)->innertext);
$g4 = str_replace(array("</div><div>","<div>","</div>"),array("-","",""),$body->find('td[class="giai4"]',0)->innertext);
$g5 = str_replace(array("</div><div>","<div>","</div>"),array("-","",""),$body->find('td[class="giai5"]',0)->innertext);
$g6 = str_replace(array("</div><div>","<div>","</div>"),array("-","",""),$body->find('td[class="giai6"]',0)->innertext);
$g7 = str_replace(array("</div><div>","<div>","</div>"),array("-","",""),$body->find('td[class="giai7"]',0)->innertext);

//echo $gdb."-".$g1."-".$g2."-".$g3;

//echo $strc;

$strd = substr($gdb,-2).'-'.substr($g1,-2).'-'.cutStr1($g2,1).'-'.cutStr1($g3,1).'-'.cutStr1($g4,1).'-'.cutStr1($g5,1).'-'.cutStr1($g6,1).'-'.cutStr1($g7,1);

$str = $strd;
    //print_r($str);
    $duoi0 = "";
    $duoi1 = "";
    $duoi2 = "";
    $duoi3 = "";
    $duoi4 = "";
    $duoi5 = "";
    $duoi6 = "";
    $duoi7 = "";
    $duoi8 = "";
    $duoi9 = "";

    $arr_loto = explode("-", $strd);
//    echo "<pre>";
//    print_r($arr_loto);
//    echo "</pre>";
    $total = count($arr_loto);
    
    for ($t = 0; $t < $total; $t++) {
        $dau = substr($arr_loto[$t], 0, 1);
//        echo $dau."<br>";
        
        $duoi = substr($arr_loto[$t], 1, 1);
        if ($dau == '0') {
            if ($duoi0 == '')
                $duoi0 = $duoi;
            else
                $duoi0 .= "," . $duoi;
        }elseif ($dau == '1') {
            if ($duoi1 == '')
                $duoi1 = $duoi;
            else
                $duoi1 .= "," . $duoi;
        }elseif ($dau == '2') {
            if ($duoi2 == '')
                $duoi2 = $duoi;
            else
                $duoi2 .= "," . $duoi;
        }elseif ($dau == '3') {
            if ($duoi3 == '')
                $duoi3 = $duoi;
            else
                $duoi3 .= "," . $duoi;
        }elseif ($dau == '4') {
            if ($duoi4 == '')
                $duoi4 = $duoi;
            else
                $duoi4 .= "," . $duoi;
        }elseif ($dau == '5') {
            if ($duoi5 == '')
                $duoi5 = $duoi;
            else
                $duoi5 .= "," . $duoi;
        }elseif ($dau == '6') {
            if ($duoi6 == '')
                $duoi6 = $duoi;
            else
                $duoi6 .= "," . $duoi;
        }elseif ($dau == '7') {
            if ($duoi7 == '')
                $duoi7 = $duoi;
            else
                $duoi7 .= "," . $duoi;
        }elseif ($dau == '8') {
            if ($duoi8 == '')
                $duoi8 = $duoi;
            else
                $duoi8 .= "," . $duoi;
        }elseif ($dau == '9') {
            if ($duoi9 == '')
                $duoi9 = $duoi;
            else
                $duoi9 .= "," . $duoi;
        }
    }

    
$stra = '["'.$gdb.'","'.$g1.'","'.$g2.'","'.$g3.'","'.$g4.'","'.$g5.'","'.$g6.'","'.$g7.'",""]';
$strb = '["'.substr($gdb,-2).'","'.substr($g1,-2).'","'.cutStr1($g2,1).'","'.cutStr1($g3,1).'","'.cutStr1($g4,1).'","'.cutStr1($g5,1).'","'.cutStr1($g6,1).'","'.cutStr1($g7,1).'",""]';
$strc = '["'.$duoi0.'","'.$duoi1.'","'.$duoi2.'","'.$duoi3.'","'.$duoi4.'","'.$duoi5.'","'.$duoi6.'","'.$duoi7.'","'.$duoi8.'","'.$duoi9.'"]';

$strwr = '{"area":0,"date":"'.$date.'","cache":{"area":0,"data":{"MB":{"lid":1,"name":"Mi\u1ec1n B\u1eafc","alias":"xo-so-mien-bac","area":0,"code":"MB","data":'.$stra.',"data_b":'.$strb.',"extra":'.$strc.',"status":0}}},"state":0}';
$strwr = str_replace(" ","",$strwr);
//echo $strwr;
    
function cutStr1($str,$t)
{
    $tem = explode("-", $str);
    
    $str2 = "";
        for($i=0;$i<count($tem);$i++)
        {
            if($i>0) $s = "-";
           if($t==1){
            $str2 .= $s.substr($tem[$i],-2);
           } else{
            $str2 .= $s.substr($tem[$i],-1);
           }
        }
    
    return $str2;
}

//$mypath="/home/xoso/public_html/xstt/";
$mypath="G:/wamp/www/xoso/laykq/";
if (!file_exists($mypath)) {
	mkdir($mypath,0777,TRUE);
}
$file = "mt.txt";
$filename = $mypath.'/'.$file;
$handle = fopen($filename,"w");
fwrite($handle,$strwr);
fclose($handle);
echo $strwr;
?>
