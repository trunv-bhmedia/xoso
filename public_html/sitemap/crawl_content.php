<?php

	function get_cat()
	{
		$db = new MyDBO();
		$sql = "SELECT * FROM `app_monan_content`  WHERE status = 0 ORDER BY `date` DESC LIMIT 3";		
		$rows = $db->get_rows($sql);		
		
	    return $rows;
	}

	function get_data (){
		ini_set('display_errors',1);
		ini_set('display_startup_errors',1);
		error_reporting(-1);
		$href	=	new href();
		$param	=	array();
		$param['task']		=	'getcontent';
		$refresh	=	$href->refresh($param,1000);
				echo ($refresh);
		
		
		$arr_cat = get_cat();
	
		if (!count($arr_cat)) {
			die('Ket thuc danh sach.');
		}		
		$defalutExecution = ini_get('max_execution_time');
		@set_time_limit(60 * 30);
		
		if (count($arr_cat)) {		
			for ($i=0; $i<count($arr_cat); $i++){				
				$obj_return = getListContent($arr_cat[$i]);
				echo 'ok '.$arr_cat[$i]->id.'<hr>';
			}
			}			
		@set_time_limit($defalutExecution);

		echo '<br />Time: '. date('Y-m-d h:m:s');
		die;

	}
	function getListContent($obj_cat){	
		
		$href = new href();
		$link = $obj_cat->link;
		$date = date ( 'Y-m-d' );
		$obj_content_today = get_content($link,'www.meishij.net');		
		$content_today = $obj_content_today->content;		
		
		$html_today = loadHtmlString($content_today);
		$info2 = $html_today->find('div[class=cp_main_info_w] div[class=info2]',0);
		$body= $html_today->find('div[class=cp_body_left]',0);
		$db = new MyDBO();
		$content_final = $info2->outertext.$body->outertext;
		
		$content_final = preg_replace('/<span[^>]*class="authors_copy_right"[^>]*>.*/is', '', $content_final);
		$content_final = preg_replace('/<div[^>]*class="cp_comment"[^>]*>.*/is', '', $content_final);
		$content_final = preg_replace('/<img[^>]*>/is', '', $content_final);
		$content_final = preg_replace('/<(\/|)a[^>]*>/is', '', $content_final);
		
		$sql_update = "UPDATE `app_monan_content` SET `content` = ".Quote($content_final).", `status` = 1 WHERE `id` = $obj_cat->id";
		$db->run_query($sql_update);
		
					
		
		return 1;
	}
	
	
	
	
?>
