<?php

$url = "https://www.youtube.com/api/cms3/ytrpc/rights";
$data = '{"method":"searchAssets","params":[,"bhmedia","doremon",0,0,25,,0,,[[,3,1]],,,,,,,,,,,1],"xsrf":"AEr_9LZJCQgRRk0gZpfDBZ9x4MHDVCuKqg:1448330135363"}';


$data = post_to_url2($url,$data);

echo $data->content; die;

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
?>