<?php

	function get_cat()
	{
		$date = date ( 'Y-m-d' );
		$db = new MyDBO();
		$sql = "SELECT * FROM `app_monan_content`	 WHERE date < ".Quote($date)." LIMIT 1";		
		$rows = $db->get_rows($sql);		
		
	    return $rows;
	}

	function get_data (){
		ini_set('display_errors',1);
		ini_set('display_startup_errors',1);
		error_reporting(-1);
		
		$href	=	new href();		
// 		$arr_cat = get_cat();
	
// 		if (!count($arr_cat)) {
// 			die('Ket thuc danh sach.');
// 		}		
		$defalutExecution = ini_get('max_execution_time');
		@set_time_limit(60 * 30);
		
// 		if (count($arr_cat)) {						
				$obj_return = getListContent();
// 			}			
		@set_time_limit($defalutExecution);

		echo '<br />Time: '. date('Y-m-d h:m:s');
		die;

	}
	function getListContent(){	
		
		$href = new href();
		$link = 'http://www.meishij.net/';
		$date = date ( 'Y-m-d' );
		$obj_content_today = get_content($link,'www.meishij.net');		
		$content_today = $obj_content_today->content;		
		$html_today = loadHtmlString($content_today);
		$main_today = $html_today->find('div[id=index_zzw_main]',0);
		$db = new MyDBO();
		$list_block = $main_today->find('div[class=zzw_item]');
		$po = 0;
		for ($i=0; $i<count($list_block); $i++){
			$meal_title = $list_block[$i]->find('h3[class=bbtitles]',0)->innertext;
			preg_match('/<div[^>]*c="(\d+)"[^>]*>/is', $list_block[$i]->outertext, $matches_c);
			$po = $matches_c[1];
			
			$list_content = $list_block[$i]->find('li');
			
			for ($j=0; $j<count($list_content); $j++){
				$title = $list_content[$j]->find('h2 a',0)->innertext;
				$link = $list_content[$j]->find('h2 a',0)->href;
				$des = $list_content[$j]->find('strong',0)->innertext;
				$thumb = $list_content[$j]->find('img',0)->src;
				$pathsave = "/home/appbhmedia.com/public_html/appmonan/images/";
				$slug = md5($title);
				$thumb_final = get_image($thumb,$slug,$pathsave);
				$thumb_final = 'http://210.211.97.114:84/appmonan/images/'.$thumb_final;
				$sql_insert = "INSERT INTO `app_monan_content` SET 
										`title` = ".Quote(trim($title)).",
										`link` = ".Quote(trim($link)).",
										`thumb` = ".Quote(trim($thumb_final)).",
										`des` = ".Quote(trim($des)).",
										`date` = ".Quote(trim($date)).",
										`order` = ".Quote(trim($po)).",
										`meal` = ".Quote(trim($meal_title));			
				$db->run_query($sql_insert);
			}
		}			
		
		return 1;
	}
	
	
	
	
?>
