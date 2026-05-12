<?php

function get_cat() {
    $db = new MyDBO();
    $sql = "SELECT * FROM `vietlott_crawl` WHERE id = 2 LIMIT 1";

    $rows = $db->get_rows($sql);
//var_dump($rows); die;
    return $rows;
}

function get_data() {
//echo phpinfo(); die;
    $href = new href();
    $param = array();
    $param['task'] = 'mega';
    $refresh = $href->refresh($param, 1000);
  //  echo ($refresh);


    $arr_cat = get_cat();

    if (!count($arr_cat)) {
        die('Ket thuc danh sach.');
    }

    $defalutExecution = ini_get('max_execution_time');
    @set_time_limit(60 * 30);

    if (count($arr_cat)) {
        $obj_cat = $arr_cat[0];     
        $obj_return = getListContent($obj_cat);
    }

    @set_time_limit($defalutExecution);

    echo '<br />Time: ' . date('Y-m-d h:m:s');
    die;
}

function getListContent($obj_cat) {   

    $href = new href();

    //$link = $obj_cat->link.'?id='.$obj_cat->next.'&nocatche=1#'.$obj_cat->next;    
    $link = $obj_cat->link.'#'.$obj_cat->next;    
    echo $link . '<hr>';
	
    $obj_content = file_get_contents($link);
	
	
	$web = loadHtmlString($obj_content);
	
	$title = $web->find('div[class=chitietketqua_title] h5',0);
	preg_match('/.*(\d{2})\/(\d{2})\/(\d{4}).*/is', $title->innertext, $matches_date);
	
	$date = trim($matches_date[3]).'-'.trim($matches_date[2]).'-'.trim($matches_date[1]).' 00:00:00';
	
	//var_dump($date); die;
	
	$giai_dac_biet_obj = $web->find('div[class=day_so_ket_qua_v2]',0);
	//echo $giai_dac_biet_obj->innertext;die;
	$list_number_db = $giai_dac_biet_obj->find('span[class=bong_tron]');
	$array_db = array();
	$array_db[] = trim(strip_tags($list_number_db[0]->innertext));
	$array_db[] = trim(strip_tags($list_number_db[1]->innertext));
	$array_db[] = trim(strip_tags($list_number_db[2]->innertext));
	$array_db[] = trim(strip_tags($list_number_db[3]->innertext));
	$array_db[] = trim(strip_tags($list_number_db[4]->innertext));
	$array_db[] = trim(strip_tags($list_number_db[5]->innertext));
	
    $detail = $web->find('div[class=table-responsive] table[class=table table-hover]',0);   
     
    $list_dt = $detail->find('tr');
	$array_dt = array();
	$array_dt['jp']['sl'] = trim(strip_tags($list_dt[1]->find('td',2)->innertext)); 
	$array_dt['jp']['gt'] = trim(strip_tags($list_dt[1]->find('td',3)->innertext)); 
	
	$array_dt['g1']['sl'] = trim(strip_tags($list_dt[2]->find('td',2)->innertext)); 
	$array_dt['g1']['gt'] = trim(strip_tags($list_dt[2]->find('td',3)->innertext)); 
	
	$array_dt['g2']['sl'] = trim(strip_tags($list_dt[3]->find('td',2)->innertext)); 
	$array_dt['g2']['gt'] = trim(strip_tags($list_dt[3]->find('td',3)->innertext)); 
	
	$array_dt['g3']['sl'] = trim(strip_tags($list_dt[4]->find('td',2)->innertext)); 
	$array_dt['g3']['gt'] = trim(strip_tags($list_dt[4]->find('td',3)->innertext)); 
	
	if(!$array_dt['g3']['sl']){
		return false;
	}

	$next_param = $obj_cat->next + 1;
	$next_param = '00'.$next_param;	
	
	$data = array();
	$data["content"]["db"] = $array_db;
	$data["content"]["nd"] = $array_dt;
	$data_final = json_encode($data);
    $db = new MyDBO();
	$sql_insert = "INSERT INTO `vietlott_data` SET 
                            `type` = 1,
                            `drawId` = ".Quote(trim($obj_cat->next)).",
                            `content` = ".Quote(trim($data_final)).",  
                            `date` = ".Quote(trim($date)).", 
                            `dateint` = ".Quote(strtotime($date));	
		 					
    $db->run_query($sql_insert);
	
 
    $sql_update = "UPDATE `vietlott_crawl` SET `next` = " . Quote($next_param) . ", `time` = " . Quote(strtotime('now')) . " WHERE `id` = $obj_cat->id";
    $db->run_query($sql_update);
    return 1;
}


?>
