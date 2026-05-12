<?php

//http://xoso.com.vn/ajax/ajaxXsmbLive.ashx
//$html = curl_page2("http://xoso.tructiep.vn/array-mien-bac.html");
$html = '';
if ($html) {
    $rs_array = explode(',', $html);
} else {
    $html = curl_page2("http://xoso.com.vn/ajax/ajaxXsmbLive.ashx");
    if ($html) {
        $rs_array = explode(',', $html);
    } else {
        return null;
    }
}
//echo "<pre>";	
//print_r($rs_array); die;
header("Content-type: text/xml; charset=utf-8");
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<kqxs id="mb">' . "\n";
for ($i = 0; $i < count($rs_array); $i++) {
    $rs_array2 = explode(';', $rs_array[$i]);
    //echo "<pre>";
    //print_r($rs_array2);
    //die;
    for ($j = 0; $j < count($rs_array2); $j++) {
        if ($rs_array2[0] == "?" && $rs_array2[1] != "?") {
            $quay = "dangquay";
        } elseif ($rs_array2[0] != "?") {
            $quay = "quayxong";
        } elseif ($rs_array2[1] == "?") {
            $quay = "chuaquay";
        }
        if ($j == 0)
            $giai = "giaidacbiet";
        elseif ($j == 1)
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

        $str = strlen($rs_array2[$j]) == 1 ? $rs_array2[$j] . "." : $rs_array2[$j];
        if (0 <= $j && $j < 8) {
            if ($rs_array2[$j] == "?") {
                echo "<" . $giai . ">." . $str . "</" . $giai . ">" . "\n";
            } else {
                echo "<" . $giai . ">" . $str . "</" . $giai . ">" . "\n";
            }
        }
    }
    $str = $rs_array2[8];
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

    $arr_loto = explode("-", $str);
    $total = count($arr_loto);
    for ($t = 0; $t < $total; $t++) {
        $dau = substr($arr_loto[$t], 0, 1);
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
    echo "<name>Miền Bắc</name>" . "\n";
    echo "<date>" . $rs_array2[11] . "</date>" . "\n";
    echo "<status>" . $quay . "</status>" . "\n";
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