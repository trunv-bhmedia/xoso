<?php

var_dump($_COOKIE); echo '<hr />';
echo time();

$fn = isset($_REQUEST['ck'])?1:0;
if($fn == 1)
{
	
	setcookie("islogin","thanhvienvip" . time() ,time() + 900);
	header('Cache-Control: max-age=30, public') ;
}else{
	setcookie("islogin","thanhvienthuong",time() + 900);
	header('Cache-Control: max-age=15, public') ;
}
 