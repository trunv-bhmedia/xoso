<?php

function get_cat($date)
	{
// 		$date = date ( 'Y-m-d' );
		$db = new MyDBO();
		$sql = "SELECT * FROM `app_monan_content`	 WHERE date like '%".$date."%' AND `status` = 1 ORDER BY `order`";	 	
// 		var_dump($sql);die;
		$rows = $db->get_rows($sql);		
		
	    return $rows;
	}

	function get_data ($date){
		
		$href	=	new href();
		$arr_cat = get_cat($date);
	
		if (!count($arr_cat)) {
			die('Ket thuc danh sach.');
		}
		
		$defalutExecution = ini_get('max_execution_time');
		@set_time_limit(60 * 30);
		
		if (count($arr_cat)) {
			
				header('Content-Type: application/json');
				echo json_encode($arr_cat);
		}
			
		@set_time_limit($defalutExecution);

		
		die;

	}	
?>
