<?php
$username = 'nguyenhuunghi.it@gmail.com';
$password = 'hmbllptod2016';
$cookie_jar_path = "cookies.txt";
$agent = "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.99 Safari/537.36";

$youtube_login_form = YouTubeLoginPage($cookie_jar_path, $agent); 
$LoggedInPage = SendYouTubeLogin($youtube_login_form, $username, $password, $cookie_jar_path, $agent);
print_r($LoggedInPage); 

function SendYouTubeLogin($youtube_form, $username, $password, $cookie_jar_path, $agent) {
	
$referer = "https://www.google.com/accounts/ServiceLogin?uilel=3&service=youtube&passive=true&continue=http://www.youtube.com/signin?action_handle_signin=true&nomobiletemp=1&hl=en_US&next=%2Findex&hl=en_US&ltmpl=sso";

//Grab Form Code
$pattern = '/(?s)name="GALX"(.*?)value="(.*?)"/';
preg_match($pattern, $youtube_form, $matches); 
$galx = $matches[2];

$post = "ltmpl=sso&continue=";
$post .= urlencode("http://www.youtube.com/signin?action_handle_signin=true&nomobiletemp=1&hl=en_US&next=/");
$post .= "index&service=youtube&uilel=3&ltmpl=sso&hl=en_US&ltmpl=sso&GALX=$galx&Email=$username&Passwd=$password&PersistentCookie=yes&rmShown=1&signIn=Sign in&asts=";

       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL,"https://www.google.com/accounts/ServiceLoginAuth?service=youtube");
       curl_setopt ($ch, CURLOPT_USERAGENT, $agent);
       curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
       curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar_path);
       curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar_path);
       curl_setopt($ch, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS);
       curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
       curl_setopt ($ch, CURLOPT_POSTFIELDS, $post); 
       curl_setopt ($ch, CURLOPT_POST, 1); 
       curl_setopt ($ch, CURLOPT_TIMEOUT, 30);
        
       $syn = curl_exec($ch);
        curl_close($ch);
        
        return $syn;
}

function YouTubeLoginPage($cookie_jar_path, $agent) {
	
$url = "https://www.google.com/accounts/ServiceLogin?uilel=3&service=youtube&passive=true&continue=http://www.youtube.com/signin?action_handle_signin=true&nomobiletemp=1&hl=en_US&next=%2Findex&hl=en_US&ltmpl=sso";
$referer = "http://www.youtube.com/";
           
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_REFERER, $referer); 
       curl_setopt ($ch, CURLOPT_URL, $url);
       curl_setopt ($ch, CURLOPT_USERAGENT, $agent);
       curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar_path);
       curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar_path);
       curl_setopt($ch, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt ($ch, CURLOPT_TIMEOUT, 30);

        $curl_output = curl_exec($ch);
        curl_close($ch);
        $pattern = '/(?s)\<form(.*?)\<\/form\>/';
        preg_match_all($pattern,  $curl_output , $matches);
        
        $youtube_form = $matches[0][1];
       
        return $youtube_form;

}

?>