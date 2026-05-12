<?php
ini_set('displsy_errors',1);
require_once('gcm.php');	
$gcm = new GCM();
//$registatoin_ids = array($arr_aid[$i]->token);
$registatoin_ids = array("APA91bHlYtln0BwsP8eZsRtLSvLRwOWGhnEfUUIpkuhM9nSimkm7N2p0jlm3ltz_NMH-IRVMIfMC0UTNlXqFTqUY0bCkkPWz0GvqeoowqvabB-XkcIwPawLSzWxDHYxD8yBMpOvv9U7E-1GKt8BPGXpRN2P2Ndgd7g");

//$message = "Push xổ số Miền Bắc";
 $message = array("price"=>"KQXS Miền Bắc: G:7: ?-?-?-? G:6: ?-?-? G:5: ?-?-?-?-?-? G:4: ?-?-?-? G:3: ?-?-?-?-?-? G:2: ?-? G:1: .?. G:DB: .?.");
$result = $gcm->send_notification($registatoin_ids, $message);
echo $result;

die;
/*

function get_app($app_test = ''){
	$today = date ( 'Y-m-d' );
	$int_today = strtotime($today);
	$int_tomorow = $int_today + 86400;
	$tomorow = date('Y-m-d',$int_tomorow);
	
	$db = new MyDBO();
	if ($app_test){
		$sql = "SELECT *
				FROM `reg_push_android`
				WHERE `token` = '$app_test'
				ORDER BY `p_date` ASC";
	}else {
	    $sql = "SELECT *
				FROM `reg_push_android`
				WHERE `s_date` < '$today'
				ORDER BY `p_date` ASC 
				LIMIT 1";
//		$sql = "SELECT *
//				FROM `reg_push`
//				WHERE `id` in (6483)
//				ORDER BY `p_date` ASC";
	}			
		
    $rows = $db->get_rows($sql);
    
    return $rows;
}
function get_word(){
	$db = new MyDBO();
	    $sql = "SELECT *
				FROM `tudien`
				ORDER BY `id` DESC 
				LIMIT 1";
    $rows = $db->get_one_row($sql);
    return $rows;
}

function push($app_test = '',$dev = ''){
	if ($app_test){
		$arr_aid = get_app($app_test);
	}
	else $arr_aid = get_app();
	
	require_once('gcm.php');
     
    $gcm = new GCM();
    $word = get_word();
    $arrID = array();
    $arrsms = array();
    $db = new wpdb();
 	for ($i=0; $i<count($arr_aid); $i++){
	    $registatoin_ids = array($arr_aid[$i]->token);
	    $message = array("price" => $word->word);
	  	$result = $gcm->send_notification($registatoin_ids, $message);
 		echo $result;
 		
 		$post = array(
			'p_date' 	=> date ( 'Y-m-d H:i:s' ), //The user ID number of the author.
			's_date' 	=> date ( 'Y-m-d' ), //The user ID number of the author.
		);  
		$db->update( 'reg_push_android', $post, array( 'id' => $arr_aid[$i]->id ),  array('%s') );
 	}
 	var_dump($arrID);
 	echo '<hr/>';
// 	$j_arrsms = json_encode($arrsms);
// 	$result = $gcm->send_notification($arrID, $j_arrsms);
//	echo $result;
	
	
}
*/
?>