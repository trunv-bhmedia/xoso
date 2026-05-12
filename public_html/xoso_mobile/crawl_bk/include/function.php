<?php
function mosProcessImages($content,$slug,$pathsave)
{
	//pathsave: 'D:/wamp/www/work/images/'
	//find all href value in a tag (with ")
	// http://www.psychic-revelation.com/images/i_ching_05_hsu.jpg
	$href	=	new href();
    
	if(preg_match_all('/(<img[^>]*(src=["\']([^"\']*)["\'])[^>]*>)/ism', $content, $matches)){

		for ($i = 0; $i < count($matches[1]); $i++){
			$link_img = $matches[3][$i];			
			$image_name = get_image($link_img,$slug.'-'.$i,$pathsave);
			$_link_image	=	$image_name;			
			if ($_link_image) {
				$content = str_replace($matches[2][$i], 'src="'. $_link_image .'"', $content);
			}
			else $content = str_replace($matches[1][$i], '', $content);
		}
	}
	return $content;
}
	function get_image($url_item,$slug,$path_save){
		preg_match('/.*?\.(jpg|gif|png|jpeg|bmp)/ism',$url_item,$matches);
		
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
	    $path = $path_save.$filename_save;
	    $ch = curl_init ($url_to_download);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
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
	function post_data($ch,$url){
		curl_setopt($ch, CURLOPT_URL, $url );
		curl_setopt($ch, CURLOPT_HEADER, 0); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION , 1);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:16.0) Gecko/20100101 Firefox/16.0');
		curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
		curl_setopt ($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
		curl_setopt($ch, CURLOPT_ENCODING,'');
		$content = curl_exec( $ch );
		$curl_info = curl_getinfo($ch);
		return $ch;
	}
	function get_content($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url );
		curl_setopt($ch, CURLOPT_HEADER, 0); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION , 1);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:16.0) Gecko/20100101 Firefox/16.0');
		curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
		curl_setopt ($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
		curl_setopt($ch, CURLOPT_ENCODING,'');
		$content = curl_exec( $ch );
		$curl_info = curl_getinfo($ch);
		$obj_source = new stdClass();
		$obj_source->content = $content;
		$obj_source->header = $curl_info["http_code"];
		return $obj_source;
	}
	function post_to_url2($url,$data) {
		$post = curl_init();
		curl_setopt($post, CURLOPT_URL, $url);
	   	curl_setopt($post, CURLOPT_POST, 1);
	  	curl_setopt($post, CURLOPT_POSTFIELDS, $data);
	   	curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
	   	curl_setopt($post, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:16.0) Gecko/20100101 Firefox/16.0');
	   	curl_setopt($post, CURLOPT_COOKIEFILE, "cookie.txt");
		curl_setopt ($post, CURLOPT_COOKIEJAR, 'cookie.txt');
		$result = curl_exec($post);
		$curl_info = curl_getinfo($post);		
		curl_close($post);
		$obj_source = new stdClass();
		$obj_source->content = $result;
		$obj_source->header = $curl_info["http_code"];
		return $obj_source;
	}
	function post_to_url3($url,$data) {
		$header[] = "Host: vansu.net";
		$post = curl_init();
		curl_setopt($post, CURLOPT_URL, $url);
		curl_setopt($post, CURLOPT_POST, 1);
		curl_setopt($post, CURLOPT_POSTFIELDS, $data);
		curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($post, CURLOPT_MAXREDIRS, 10);
		curl_setopt($post, CURLOPT_FOLLOWLOCATION , 1);
		curl_setopt($post, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:34.0) Gecko/20100101 Firefox/34.0');
		// 	   	curl_setopt($post, CURLOPT_COOKIEFILE, "cookie.txt");
		// 		curl_setopt ($post, CURLOPT_COOKIEJAR, 'cookie.txt');
		curl_setopt($post, CURLOPT_REFERER, 'http://vansu.net/xem-van-han-nam-2015.html');
		curl_setopt($post, CURLOPT_HTTPHEADER, $header);
		$result = curl_exec($post);
		$curl_info = curl_getinfo($post);
		curl_close($post);
		$obj_source = new stdClass();
		$obj_source->content = $result;
		$obj_source->header = $curl_info["http_code"];
		return $obj_source;
	}
	function post_to_url($post, $url,$data) {
		curl_setopt($post, CURLOPT_URL, $url);
	   	curl_setopt($post, CURLOPT_POST, 1);
	  	curl_setopt($post, CURLOPT_POSTFIELDS, $data);
	   	curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
	   	curl_setopt($post, CURLOPT_COOKIEJAR, "cookies.txt");
		curl_setopt($post, CURLOPT_COOKIEFILE, "cookies.txt");
		$result = curl_exec($post);
		$curl_info = curl_getinfo($post);		
		
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
?>