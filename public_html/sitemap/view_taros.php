<?php

	function get_cat($name, $type)
	{
		$date = date ( 'Y-m-d' );
		$db = new MyDBO();
		$sql = "SELECT c.`id`, c.`type`, c.`today`, c.`tomorrow`, c.`yesterday` FROM `content_taros` c WHERE c.`date_get` like '%".$date."%' AND c.`type` = '".$name."' AND c.`type_taros` = '".$type."'";		
// 		var_dump($sql);die;
		$rows = $db->get_rows($sql);		
		
	    return $rows;
	}

	function get_data ($name, $type){
		
		$href	=	new href();
		$arr_cat = get_cat($name, $type);
	
		if (!count($arr_cat)) {
			die('Ket thuc danh sach.');
		}
		
		$defalutExecution = ini_get('max_execution_time'); 
		@set_time_limit(60 * 30);
		
		if (count($arr_cat)) {
				$item = 	$arr_cat[0];
				echo json_encode($item);
		}
			
		@set_time_limit($defalutExecution);

		
		die;

	}	
?>
