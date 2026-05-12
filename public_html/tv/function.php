<?php
	function get_image($url_item,$slug,$path_save,$path_view){
		preg_match('/.*?\.(jpg|gif|png|jpeg|bmp)$/ism',$url_item,$matches);
		
		if (file_exists($path_save.$slug.'.'.$matches[1])) {
	        $image_name = $slug.'.'.$matches[1];
	    }
	    else {
	    	$downloadInfo = downloadFile($url_item,$path_save,$slug.'.'.$matches[1]);
	    	if ($downloadInfo['http_code'] == 200){
				$image_name = $slug.'.'.$matches[1];
			}
			else {
				$image_name = '';
			}
	    }
		
		return $image_name;
	}
	function downloadFile( $url_to_download,$path_save,$filename_save) {
	    $url_to_download=str_replace(' ','%20',$url_to_download);
	    $url_to_download=str_replace('s128','s700',$url_to_download);
	  
	    $path = $path_save.$filename_save;
	    $ch = curl_init ($url_to_download);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:26.0) Gecko/20100101 Firefox/26.0');
	    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
	    $rawdata=curl_exec($ch);
	    curl_exec($ch);
	    $downloadInfo=curl_getinfo($ch);  
	    curl_close ($ch);
	    if(file_exists($path)){
	        unlink($path);
	    }
	    $fp = fopen($path,'x');
	    fwrite($fp, $rawdata);
	    fclose($fp);
	    return $downloadInfo;
	}
	function curl_page($url,$currentView,$page){
//		$URL = 'http://thuocbietduoc.com.vn/nhom-thuoc-1-0/thuoc-gay-te-me.aspx';
		$fields = array('currentView'=>$currentView, 'page'=>$page);
		$fields_string = '';
		
	    foreach($fields as $key=>$value) { $fields_string  .= $key.'='.$value.'&'; };

	    rtrim($fields_string,'&');
	    $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
	    curl_setopt($ch, CURLOPT_POST,count($fields));
	    curl_setopt($ch, CURLOPT_POSTFIELDS,$fields_string);
	    curl_setopt($ch, CURLOPT_HEADER, 1);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    
	    $result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	function post_to_url($url,$data) {
		$post = curl_init();
		curl_setopt($post, CURLOPT_URL, $url);
	   	curl_setopt($post, CURLOPT_POST, 1);
	  	curl_setopt($post, CURLOPT_POSTFIELDS, $data);
	   	curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($post);
		$curl_info = curl_getinfo($post);		
		curl_close($post);
		$obj_source = new stdClass();
		$obj_source->content = $result;
		$obj_source->header = $curl_info["http_code"];
		return $obj_source;
	}
	function Quote( $text )
	{
		$search=array("\\","\0","\n","\r","\x1a","'",'"');
        $replace=array("\\\\","\\0","\\n","\\r","\Z","\'",'\"');
        $text = str_replace($search,$replace,$text);
       	$text = "'".$text."'";
		return $text;
	}
?>