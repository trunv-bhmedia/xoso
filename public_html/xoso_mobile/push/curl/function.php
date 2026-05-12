<?php
		function curl_page21($link){
	    echo $link;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $link );
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION , 1);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:16.0) Gecko/20100101 Firefox/16.0');
		//curl_setopt($ch, CURLOPT_REFERER, 'http://www.xoso.com');
		curl_setopt($ch, CURLOPT_ENCODING,'');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true ); 
		$content = curl_exec( $ch );
		$curl_info = curl_getinfo($ch);
		curl_close($ch);
		return $content;
	}
?>