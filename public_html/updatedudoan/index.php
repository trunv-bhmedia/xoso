<?php 

//require_once('help/function.php');
//require_once('help/parse.php');
require_once('href.php');
//require_once('help/function.php');
//require_once('help/phpWebHacks.php');
require_once('connect.php');
// require_once('connect/connect2.php');
//require_once('connect/db.php');
//require_once('help/tidy_clean.php');
$task	=	isset($_REQUEST['task']) ? $_REQUEST['task'] : '';
switch ($task)
{
	case 'updatedudoan':{
			require_once('updatedudoan.php');			
			get_data();
			break;
		}				
}

			
//http://app.vietbao.vn/service/apptv/result.php?k=key_encrypt_base64
//http://www.tuviglobal.com/tuvi/laso/lygiai/xem.Nguyen%20Van%20Hung.1119.25.8.0.5.5.html
//http://app.vietbao.vn/service/apptv/index.php?w=3443r4&k=1111.15.12.0.9.5&p=03ffd4a8574f6949e6d0ffe38f948e0c