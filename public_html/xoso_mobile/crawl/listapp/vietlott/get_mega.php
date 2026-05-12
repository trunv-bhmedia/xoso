<?php

function get_cat() {
    $db = new MyDBO();
    $sql = "SELECT * FROM `vietlott_crawl` WHERE id = 2 LIMIT 1";

    $rows = $db->get_rows($sql);

    return $rows;
}

function get_data() {

    $href = new href();
    $param = array();
    $param['task'] = 'mega';
    $refresh = $href->refresh($param, 1000);
    echo ($refresh);


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

    $link = trim($obj_cat->link);    
    echo $link . '<hr>';
	$data = $obj_cat->next;
	
    $obj_content = post_to_url2($link, $data);
	if(!$obj_content->content){
		return false;
	}
	$web = loadHtmlString($obj_content->content);
	$giai_dac_biet_obj = $web->find('ul[class=result-number]',0);
	$list_number_db = $giai_dac_biet_obj->find('li');
	$array_db = array();
	$array_db[] = trim(strip_tags($list_number_db[1]->innertext));
	$array_db[] = trim(strip_tags($list_number_db[2]->innertext));
	$array_db[] = trim(strip_tags($list_number_db[3]->innertext));
	$array_db[] = trim(strip_tags($list_number_db[4]->innertext));
	$array_db[] = trim(strip_tags($list_number_db[5]->innertext));
	$array_db[] = trim(strip_tags($list_number_db[6]->innertext));
	
    $detail = $web->find('table[class=table table-striped]',1);   
     
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
	$str_next = $list_number_db[7]->outertext;
	preg_match('/<a[^>]*data-gameid="(\d+)"[^>]*data-drawid="(\d+)"[^>]*data-dayprize="([^"]*)"[^>]*>/is',$str_next,$matches_next);
	$next_param = "gameId=".$matches_next[1]."&drawId=".$matches_next[2]."&dayPrize=".urlencode($matches_next[3])."&type=1";
	
	$date_int = strtotime(trim($matches_next[3]));
	$date = date('Y-m-d',$date_int);
	
	
	$data = array();
	$data["content"]["db"] = $array_db;
	$data["content"]["nd"] = $array_dt;
	$data_final = json_encode($data);
    $db = new MyDBO();
	$sql_insert = "INSERT INTO `vietlott_data` SET 
                            `type` = 1,
                            `drawId` = ".Quote(trim($matches_next[2])).",
                            `content` = ".Quote(trim($data_final)).",  
                            `date` = ".Quote(trim($date)).", 
                            `dateint` = ".Quote(trim($date_int));	
		 					
    $db->run_query($sql_insert);
	
 
    $sql_update = "UPDATE `vietlott_crawl` SET `next` = " . Quote($next_param) . ", `time` = " . Quote(strtotime('now')) . " WHERE `id` = $obj_cat->id";
    $db->run_query($sql_update);
    return 1;
}


?>
