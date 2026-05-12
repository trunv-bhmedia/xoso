<?php
include('simple_html_dom_helper.php');
include('phpWebHacks.php');
include('parse.php');

include('config.php');
@set_time_limit(60 * 180);

$date = isset($_REQUEST['date'])?$_REQUEST['date']:date("d-m-Y");

//$link = "http://www.minhngoc.net.vn/ket-qua-xo-so/mien-bac.html";
$link = "https://www.minhngoc.net.vn/ket-qua-xo-so/mien-bac/".trim($date).".html";
$html = get_content_mn($link);
$html = loadhtmlstring($html);
$body = $html->find('table[class="bkqtinhmienbac"]',0);


$gdb = trim(str_replace(array("</div><div>","<div>","</div>"),array("-","",""),$body->find('td[class="giaidb"]',0)->innertext));
$g1 = trim(str_replace(array("</div><div>","<div>","</div>"),array("-","",""),$body->find('td[class="giai1"]',0)->innertext));
$g2 = trim(str_replace(array("</div><div>","<div>","</div>"),array("-","",""),$body->find('td[class="giai2"]',0)->innertext));
$g3 = trim(str_replace(array("</div><div>","<div>","</div>"),array("-","",""),$body->find('td[class="giai3"]',0)->innertext));
$g4 = trim(str_replace(array("</div><div>","<div>","</div>"),array("-","",""),$body->find('td[class="giai4"]',0)->innertext));
$g5 = trim(str_replace(array("</div><div>","<div>","</div>"),array("-","",""),$body->find('td[class="giai5"]',0)->innertext));
$g6 = trim(str_replace(array("</div><div>","<div>","</div>"),array("-","",""),$body->find('td[class="giai6"]',0)->innertext));
$g7 = trim(str_replace(array("</div><div>","<div>","</div>"),array("-","",""),$body->find('td[class="giai7"]',0)->innertext));

$kyHieuDB = $body->find('.loaive_content',0)->innertext;

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
        
        $duoi = trim(substr($arr_loto[$t], 1, 1));
        if ($dau == '0') {
            if ($duoi0 == '')
                $duoi0 = trim($duoi);
            else
                $duoi0 .= "," . $duoi;
        }elseif ($dau == '1') {
            if ($duoi1 == '')
                $duoi1 = trim($duoi);
            else
                $duoi1 .= "," . $duoi;
        }elseif ($dau == '2') {
            if ($duoi2 == '')
                $duoi2 = trim($duoi);
            else
                $duoi2 .= "," . $duoi;
        }elseif ($dau == '3') {
            if ($duoi3 == '')
                $duoi3 = trim($duoi);
            else
                $duoi3 .= "," . $duoi;
        }elseif ($dau == '4') {
            if ($duoi4 == '')
                $duoi4 = trim($duoi);
            else
                $duoi4 .= "," . $duoi;
        }elseif ($dau == '5') {
            if ($duoi5 == '')
                $duoi5 = trim($duoi);
            else
                $duoi5 .= "," . $duoi;
        }elseif ($dau == '6') {
            if ($duoi6 == '')
                $duoi6 = trim($duoi);
            else
                $duoi6 .= "," . $duoi;
        }elseif ($dau == '7') {
            if ($duoi7 == '')
                $duoi7 = trim($duoi);
            else
                $duoi7 .= "," . $duoi;
        }elseif ($dau == '8') {
            if ($duoi8 == '')
                $duoi8 = trim($duoi);
            else
                $duoi8 .= "," . $duoi;
        }elseif ($dau == '9') {
            if ($duoi9 == '')
                $duoi9 = trim($duoi);
            else
                $duoi9 .= "," . $duoi;
        }
    }

  
$stra = '["'.$gdb.'","'.$g1.'","'.$g2.'","'.$g3.'","'.$g4.'","'.$g5.'","'.$g6.'","'.$g7.'",""]';
$strb = '["'.substr($gdb,-2).'","'.substr($g1,-2).'","'.cutStr1($g2,1).'","'.cutStr1($g3,1).'","'.cutStr1($g4,1).'","'.cutStr1($g5,1).'","'.cutStr1($g6,1).'","'.cutStr1($g7,1).'",""]';
$strc = '["'.$duoi0.'","'.$duoi1.'","'.$duoi2.'","'.$duoi3.'","'.$duoi4.'","'.$duoi5.'","'.$duoi6.'","'.$duoi7.'","'.$duoi8.'","'.$duoi9.'"]';
$b0 = substr($gdb,-2);
$b1 = substr($g1,-2);
$b2 = cutStr1($g2,1);
$b3 = cutStr1($g3,1);
$b4 = cutStr1($g4,1);
$b5 = cutStr1($g5,1);
$b6 = cutStr1($g6,1);
$b7 = cutStr1($g7,1);
$sqlck = "select count(*) from xs_result where lid=1 and date ='".date("Y-m-d", strtotime($date))."' and a0=".trim($gdb);
//var_dump($sqlck); die;
$result = mysql_query($sqlck);
$row = mysql_fetch_row($result);

if($row[0]<=0){
$sql = "insert into xs_result(lid,khtt,date, extension,a0,a1,a2,a3,a4,a5,a6,a7,b0,b1,b2,b3,b4,b5,b6,b7)values(1,'".trim($kyHieuDB)."','".date("Y-m-d", strtotime($date))."','$strc','$gdb','$g1','$g2','$g3','$g4','$g5','$g6','$g7','$b0','$b1','$b2','$b3','$b4','$b5','$b6','$b7') ";  
//echo $sql;die;
mysql_query($sql);
}


function cutStr1($str,$t)
{
    $tem = explode("-", $str);
    
    $str2 = "";
        for($i=0;$i<count($tem);$i++)
        {
            if($i>0) $s = ",";
           if($t==1){
            $str2 .= $s.substr($tem[$i],-2);
           } else{
            $str2 .= $s.substr($tem[$i],-1);
           }
        }
    
    return $str2;
}
function curl_page2($url, $curl_header = 0, $cookie = '') {
        $referer = 'http://www.google.com/';
        $useragent = 'Mozilla/5.0 (Windows NT 6.1; rv:20.0) Gecko/20100101 Firefox/20.0';
        $timeout = 20;
        $connecttimeout = 5;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, $curl_header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_NOSIGNAL, 1);

        if ($cookie != '')
            curl_setopt($ch, CURLOPT_COOKIE, $cookie);

        curl_setopt($ch, CURLOPT_REFERER, $referer);
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $connecttimeout);
        $html_content = curl_exec($ch);
        curl_close($ch);

        return $html_content;
    }
function get_content_mn($link)
	{
		$browser = new phpWebHacks();
		$arr_post = array();
		$arr_post['sourcelink'] = $link;
		$arr_post['User-Agent'] = 'Mozilla/5.0 (iPad; CPU OS 6_0 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10A5355d Safari/8536.25';
		$response	=	$browser->post('http://servercrawl.com',$arr_post);
		$response = trim(preg_replace('/startmyIP.*?endmyIP:\s*<hr\s*\/>\s*/ism','', $response));
		unset($browser);
		return $response;
	}

?>
