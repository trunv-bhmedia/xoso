<?php
 
//http://xoso.com.vn/ajax/ajaxXsmbLive.ashx
//$html = curl_page2("http://xoso.tructiep.vn/array-mien-bac.html");

 $key = '';
 if (!$key) {
     $html = file_get_contents("http://xoso.com.vn/xo-so-mien-bac/xsmb-p1.html"); 
 } 
 
 $regid = '/var\s*appKey\s*=\s*\'([^\']*)\';/is';

 preg_match($regid, $html, $matches);
 	$key = $matches[1];
	 $regid = '/var\s*groupId\s*=\s*(\d+);/is';
	$link = 'http://xoso.com.vn/lottery_ws/LotteryWCFService.svc/GetLotteryMsgLiveByGroup/1,1,21,1,4,'.$key.',1';
	//var_dump($link); die;
	$js_source = file_get_contents($link);
	$data = json_decode($js_source);
	header("Content-type: text/xml; charset=utf-8");
	echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
	echo '<kqxs id="mb">' . "\n";
	for ($i = 0; $i < count($data); $i++) {
		$rs_array2 = $data[$i]->LotPrizes;
// 		var_dump($data[$i]); die;
		for ($j = 0; $j < count($rs_array2); $j++) {
			if ($rs_array2[0]->Range == "..." && $rs_array2[1]->Range != "...") {
				$quay = "dangquay";
			} elseif ($rs_array2[0]->Range != "...") {
				$quay = "quayxong";
			} elseif ($rs_array2[1]->Range == "...") {
				$quay = "chuaquay";
			}
			if ($j == 0){
				$giai = "giaidacbiet";
				$key_giai = "Giải DB";
			}				
			elseif ($j == 1){
				$giai = "giainhat";
				$key_giai = "Giải nhất";
			}			
			elseif ($j == 2){
				$giai = "giainhi";
				$key_giai = "Giải nhì";
			}			
			elseif ($j == 3){
				$giai = "giaiba";
				$key_giai = "Giải ba";
			}			
			elseif ($j == 4){
				$giai = "giaitu";
				$key_giai = "Giải tư";
			}			
			elseif ($j == 5){
				$giai = "giainam";
				$key_giai = "Giải năm";
			}			
			elseif ($j == 6){
				$giai = "giaisau";
				$key_giai = "Giải sáu";
			}			
			elseif ($j == 7){
				$giai = "giaibay";
				$key_giai = "Giải bảy";
			}	
// 			$str = strlen($rs_array2[$j]) == 1 ? $rs_array2[$j] . "." : $rs_array2[$j];
			$str = $rs_array2[$j]->Range;
			if (0 <= $j && $j < 8) {
				if ($rs_array2[$j]->Range == "...") {
					echo "<" . $giai . ">." . $str . "</" . $giai . ">" . "\n";
				} else {
					echo "<" . $giai . ">" . $str . "</" . $giai . ">" . "\n";
				}
			}
		}
		$LotoTailTable = $data[$i]->Lotos;
		
		
// 		$str = $rs_array2[8];
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
		echo "<name>Miền Bắc</name>" . "\n";
		echo "<date>" . $data[$i]->CrDateTime . "</date>" . "\n";
		echo "<status>" . $quay . "</status>" . "\n";
	}
	echo "</kqxs>";
// }




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