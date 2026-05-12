<?php

//http://xoso.com.vn/ajax/ajaxXsmnLive.ashx
//$html = curl_page2("http://xoso.tructiep.vn/array-mien-nam.html");
//$html = '462739;82838;15179;70865-12550;36193-84861-21741-66607-31093-32311-80902;6411;0004-9502-6763;225;24;5649;39363;AG;An Giang;24-04-2014;1;20;24-25-04-02-63-11-93-61-41-07-93-11-02-65-50-79-38-39,176203;04097;24783;93411-70602;27236-96085-14073-21930-39653-23386-69561;5331;6062-8662-9840;540;57;5649;39362;TN;Tây Ninh;24-04-2014;1;21;57-40-62-62-40-31-36-85-73-30-53-86-61-11-02-83-97-03,510890;20802;11346;97363-24478;08358-79496-18311-56178-03696-64640-39724;5572;8243-1488-0694;478;88;5649;39364;BTH;Bình Thuận;24-04-2014;1;22;88-78-43-88-94-72-58-96-11-78-96-40-24-63-78-46-02-90';
// $key = '';

 if (!$key) {
     $html = file_get_contents("http://xoso.com.vn/xo-so-mien-nam/xsmn-p1.html"); 
 } 
 $regid = '/var\s*appKey\s*=\s*\'([^\']*)\';/is';

 preg_match($regid, $html, $matches);
 	$key = $matches[1];
	 $regid = '/var\s*groupId\s*=\s*(\d+);/is';
	$link = 'http://xoso.com.vn/lottery_ws/LotteryWCFService.svc/GetLotteryMsgLiveByGroup/2,1,21,1,4,'.$key.',1';
	var_dump($link); die;
	$js_source = file_get_contents($link);
	$data = json_decode($js_source);
// 	var_dump($js_source); die;
header("Content-type: text/xml; charset=utf-8");
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo "<kqxs>" . "\n";
for ($i = 0; $i < count($data); $i++) {
    $rs_array2 = $data[$i]->LotPrizes;
    for ($j = 0; $j < count($rs_array2); $j++) {
        if ($rs_array2[0]->Range == "..." && $rs_array2[8]->Range != "...") {
            $quay = "dangquay";
        } elseif ($rs_array2[0]->Range != "...") {
            $quay = "quayxong";
        } elseif ($rs_array2[8]->Range == "...") {
            $quay = "chuaquay";
        }
        if ($j == 0) {
            $giai = "giaidacbietsauso";
            $giai2 = "giaidacbiet";
        } elseif ($j == 1)
            $giai = "giainhat";
        elseif ($j == 2)
            $giai = "giainhi";
        elseif ($j == 3)
            $giai = "giaiba";
        elseif ($j == 4)
            $giai = "giaitu";
        elseif ($j == 5)
            $giai = "giainam";
        elseif ($j == 6)
            $giai = "giaisau";
        elseif ($j == 7)
            $giai = "giaibay";
        elseif ($j == 8)
            $giai = "giaitam";

//         $str = strlen($rs_array2[$j]) > 1 ? substr($rs_array2[$j], 1) : $rs_array2[$j];
//         $str = strlen($rs_array2[$j]) == 1 ? $rs_array2[$j] . "." : $rs_array2[$j];
        $str = $rs_array2[$j]->Range;
        if ($j == 0) {
            echo "<" . $data[$i]->LotteryCode . ">" . "\n";
        }
        if ($j == 0) {
            if ($rs_array2[$j]->Range == "...") {
                echo "<" . $giai . ">." . $rs_array2[$j]->Range . "</" . $giai . ">" . "\n" . "<" . $giai2 . ">." . $str . "</" . $giai2 . ">" . "\n";
            } else {
                echo "<" . $giai . ">" . $rs_array2[$j]->Range . "</" . $giai . ">" . "\n" . "<" . $giai2 . ">" . $str . "</" . $giai2 . ">" . "\n";
            }
        }
        if (1 <= $j && $j < 9) {
            echo "<" . $giai . ">" . $str . "</" . $giai . ">" . "\n";
        }
    }
    $LotoTailTable = $data[$i]->Lotos;
//     $str = $rs_array2[16];
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

//     $arr_loto = explode("-", $str);
//     $total = count($arr_loto);
    for ($t = 0; $t < count($LotoTailTable); $t++) {
        $dau = $LotoTailTable[$t]->Head;
        $duoi = $LotoTailTable[$t]->Tail;
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
    echo "<dau0>" . $duoi0 . "</dau0>" . "\n";
    echo "<dau1>" . $duoi1 . "</dau1>" . "\n";
    echo "<dau2>" . $duoi2 . "</dau2>" . "\n";
    echo "<dau3>" . $duoi3 . "</dau3>" . "\n";
    echo "<dau4>" . $duoi4 . "</dau4>" . "\n";
    echo "<dau5>" . $duoi5 . "</dau5>" . "\n";
    echo "<dau6>" . $duoi6 . "</dau6>" . "\n";
    echo "<dau7>" . $duoi7 . "</dau7>" . "\n";
    echo "<dau8>" . $duoi8 . "</dau8>" . "\n";
    echo "<dau9>" . $duoi9 . "</dau9>" . "\n";
    echo "<name>" . $data[$i]->LotteryName . "</name>" . "\n";
    echo "<date>" . $data[$i]->CrDateTime . "</date>" . "\n";
    echo "<status>" . $quay . "</status>" . "\n";
    echo "</" .  $data[$i]->LotteryCode . ">" . "\n";
}
echo "</kqxs>";

function curl_page2($url) {
    $referer = 'http://www.google.com/';
    $useragent = 'Mozilla/5.0 (Windows NT 6.1; rv:20.0) Gecko/20100101 Firefox/20.0';
    $timeout = 20;
    $connecttimeout = 5;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_NOSIGNAL, 1);

    curl_setopt($ch, CURLOPT_REFERER, $referer);
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $connecttimeout);
    $html_content = curl_exec($ch);
    curl_close($ch);

    return $html_content;
}

?>