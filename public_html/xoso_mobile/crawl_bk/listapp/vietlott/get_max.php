<?php

function get_cat() {
    $db = new MyDBO();
    $sql = "SELECT * FROM `vietlott_crawl` WHERE id = 4 LIMIT 1";

    $rows = $db->get_rows($sql);

    return $rows;
}

function get_data() {

    $href = new href();
    $param = array();
    $param['task'] = 'max';
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
	$giai_dac_biet_obj = $web->find('ul[class=result-max4d]',0);
	$list_number_db = $giai_dac_biet_obj->find('div[class=box-result-max4d]');
	$array_db = array();
	$giai1 = $list_number_db[0]->find('ul[class=num-result-max4d]',0);
	
	$array_db['g1'][] = trim(strip_tags($giai1->find('li',0)->innertext));
	$array_db['g1'][] = trim(strip_tags($giai1->find('li',1)->innertext));
	$array_db['g1'][] = trim(strip_tags($giai1->find('li',2)->innertext));
	$array_db['g1'][] = trim(strip_tags($giai1->find('li',3)->innertext));
	
	$giai21 = $list_number_db[1]->find('ul[class=num-result-max4d]',0);
	$giai22 = $list_number_db[1]->find('ul[class=num-result-max4d]',1);
	
	$array_db['g2']['s1'][] = trim(strip_tags($giai21->find('li',0)->innertext));
	$array_db['g2']['s1'][] = trim(strip_tags($giai21->find('li',1)->innertext));
	$array_db['g2']['s1'][] = trim(strip_tags($giai21->find('li',2)->innertext));
	$array_db['g2']['s1'][] = trim(strip_tags($giai21->find('li',3)->innertext));
	
	$array_db['g2']['s2'][] = trim(strip_tags($giai22->find('li',0)->innertext));
	$array_db['g2']['s2'][] = trim(strip_tags($giai22->find('li',1)->innertext));
	$array_db['g2']['s2'][] = trim(strip_tags($giai22->find('li',2)->innertext));
	$array_db['g2']['s2'][] = trim(strip_tags($giai22->find('li',3)->innertext));
	
	
	$giai31 = $list_number_db[2]->find('ul[class=num-result-max4d]',0);
	$giai32 = $list_number_db[2]->find('ul[class=num-result-max4d]',1);
	$giai33 = $list_number_db[2]->find('ul[class=num-result-max4d]',2);
	
	$array_db['g3']['s1'][] = trim(strip_tags($giai31->find('li',0)->innertext));
	$array_db['g3']['s1'][] = trim(strip_tags($giai31->find('li',1)->innertext));
	$array_db['g3']['s1'][] = trim(strip_tags($giai31->find('li',2)->innertext));
	$array_db['g3']['s1'][] = trim(strip_tags($giai31->find('li',3)->innertext));
	
	$array_db['g3']['s2'][] = trim(strip_tags($giai32->find('li',0)->innertext));
	$array_db['g3']['s2'][] = trim(strip_tags($giai32->find('li',1)->innertext));
	$array_db['g3']['s2'][] = trim(strip_tags($giai32->find('li',2)->innertext));
	$array_db['g3']['s2'][] = trim(strip_tags($giai32->find('li',3)->innertext));
	
	$array_db['g3']['s3'][] = trim(strip_tags($giai33->find('li',0)->innertext));
	$array_db['g3']['s3'][] = trim(strip_tags($giai33->find('li',1)->innertext));
	$array_db['g3']['s3'][] = trim(strip_tags($giai33->find('li',2)->innertext));
	$array_db['g3']['s3'][] = trim(strip_tags($giai33->find('li',3)->innertext));
	
	$giaikk1 = $list_number_db[3]->find('ul[class=num-result-max4d]',0);
	$giaikk2 = $list_number_db[4]->find('ul[class=num-result-max4d]',0);
	
	$array_db['kk1'][] = trim(strip_tags($giaikk1->find('li',0)->innertext));
	$array_db['kk1'][] = trim(strip_tags($giaikk1->find('li',1)->innertext));
	$array_db['kk1'][] = trim(strip_tags($giaikk1->find('li',2)->innertext));
	$array_db['kk1'][] = trim(strip_tags($giaikk1->find('li',3)->innertext));
	
	$array_db['kk2'][] = trim(strip_tags($giaikk2->find('li',0)->innertext));
	$array_db['kk2'][] = trim(strip_tags($giaikk2->find('li',1)->innertext));
	$array_db['kk2'][] = trim(strip_tags($giaikk2->find('li',2)->innertext));
	$array_db['kk2'][] = trim(strip_tags($giaikk2->find('li',3)->innertext));

	
	
    $detail = $web->find('table[class=table table-striped]',0);   
     
    $list_dt = $detail->find('tr');
	$array_dt = array();
	$array_dt['g1']['kq'] = trim(strip_tags($list_dt[1]->find('td',1)->innertext)); 
	$array_dt['g1']['sl'] = trim(strip_tags($list_dt[1]->find('td',2)->innertext)); 
	$array_dt['g1']['gt'] = trim(strip_tags($list_dt[1]->find('td',3)->innertext)); 
	
	$array_dt['g2']['kq'] = trim(strip_tags(preg_replace('/<\/b>\s*<b>/ism',' - ',$list_dt[2]->find('td',1)->innertext))); 
	$array_dt['g2']['sl'] = trim(strip_tags($list_dt[2]->find('td',2)->innertext)); 
	$array_dt['g2']['gt'] = trim(strip_tags($list_dt[2]->find('td',3)->innertext)); 
	
	$array_dt['g3']['kq'] = trim(strip_tags(preg_replace('/<\/b>\s*<b>/ism',' - ',$list_dt[3]->find('td',1)->innertext))); 
	$array_dt['g3']['sl'] = trim(strip_tags($list_dt[3]->find('td',2)->innertext)); 
	$array_dt['g3']['gt'] = trim(strip_tags($list_dt[3]->find('td',3)->innertext)); 
	
	$array_dt['kk1']['kq'] = trim(strip_tags($list_dt[4]->find('td',1)->innertext)); 
	$array_dt['kk1']['sl'] = trim(strip_tags($list_dt[4]->find('td',2)->innertext)); 
	$array_dt['kk1']['gt'] = trim(strip_tags($list_dt[4]->find('td',3)->innertext)); 
	
	$array_dt['kk2']['kq'] = trim(strip_tags($list_dt[5]->find('td',1)->innertext)); 
	$array_dt['kk2']['sl'] = trim(strip_tags($list_dt[5]->find('td',2)->innertext)); 
	$array_dt['kk2']['gt'] = trim(strip_tags($list_dt[5]->find('td',3)->innertext)); 
	
	
	
	$str_next = $web->find('div[class=box-result-detail]',0)->outertext;
	
	//<a[^>]*data-gameid-max4d="2"[^>]*data-drawid-max4d="36" data-dayprize-max4d="2/11/2017 12:00:00 AM">
	preg_match('/<a[^>]*data-gameid-max4d\s*=\s*"(\d+)"[^>]*data-drawid-max4d\s*=\s*"(\d+)"[^>]*data-dayprize-max4d\s*=\s*"([^"]*)"[^>]*>/is',$str_next,$matches_next);
	$next_param = "gameId=".$matches_next[1]."&drawId=".$matches_next[2]."&dayPrize=".urlencode($matches_next[3])."&type=1";
	
	$date_int = strtotime(trim($matches_next[3]));
	$date = date('Y-m-d',$date_int);
	
	
	$data = array();
	$data["content"]["db"] = $array_db;
	$data["content"]["nd"] = $array_dt;
	$data_final = json_encode($data);

    $db = new MyDBO();
	$sql_insert = "INSERT INTO `vietlott_data` SET 
                            `type` = 2,
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
