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
	//$link = $obj_cat->link.'?id='.$obj_cat->next.'&nocatche=1#'.$obj_cat->next;   	
	$link = $obj_cat->link.'#'.$obj_cat->next;   	
    echo $link . '<hr>';
	$data = $obj_cat->next;
	
    $obj_content = file_get_contents($link);
	
	
	$web = loadHtmlString($obj_content);
	
	$title = $web->find('div[class=chitietketqua_title] h5',0);
	preg_match('/.*(\d{2})\/(\d{2})\/(\d{4}).*/is', $title->innertext, $matches_date);
	
	$date = trim($matches_date[3]).'-'.trim($matches_date[2]).'-'.trim($matches_date[1]).' 00:00:00';	
	
	
	$giai_dac_biet_obj = $web->find('div[class=tong_day_so_ket_qua]',0);
	$list_number_db = $giai_dac_biet_obj->find('div[class=day_so_ket_qua_v2]');
	
	//var_dump(count($list_number_db)); die;
	
	$array_db = array();
	$giai1 = $list_number_db[0];
	
	$array_db['g1'][] = trim(strip_tags($giai1->find('span[class=bong_tron]',0)->innertext));
	$array_db['g1'][] = trim(strip_tags($giai1->find('span[class=bong_tron]',1)->innertext));
	$array_db['g1'][] = trim(strip_tags($giai1->find('span[class=bong_tron]',2)->innertext));
	$array_db['g1'][] = trim(strip_tags($giai1->find('span[class=bong_tron]',3)->innertext));
	
	$giai21 = $list_number_db[1];
	$giai22 = $list_number_db[2];
	
	$array_db['g2']['s1'][] = trim(strip_tags($giai21->find('span[class=bong_tron]',0)->innertext));
	$array_db['g2']['s1'][] = trim(strip_tags($giai21->find('span[class=bong_tron]',1)->innertext));
	$array_db['g2']['s1'][] = trim(strip_tags($giai21->find('span[class=bong_tron]',2)->innertext));
	$array_db['g2']['s1'][] = trim(strip_tags($giai21->find('span[class=bong_tron]',3)->innertext));
	
	$array_db['g2']['s2'][] = trim(strip_tags($giai22->find('span[class=bong_tron]',0)->innertext));
	$array_db['g2']['s2'][] = trim(strip_tags($giai22->find('span[class=bong_tron]',1)->innertext));
	$array_db['g2']['s2'][] = trim(strip_tags($giai22->find('span[class=bong_tron]',2)->innertext));
	$array_db['g2']['s2'][] = trim(strip_tags($giai22->find('span[class=bong_tron]',3)->innertext));
	
	
	$giai31 = $list_number_db[3];
	$giai32 = $list_number_db[4];
	$giai33 = $list_number_db[5];
	
	$array_db['g3']['s1'][] = trim(strip_tags($giai31->find('span[class=bong_tron]',0)->innertext));
	$array_db['g3']['s1'][] = trim(strip_tags($giai31->find('span[class=bong_tron]',1)->innertext));
	$array_db['g3']['s1'][] = trim(strip_tags($giai31->find('span[class=bong_tron]',2)->innertext));
	$array_db['g3']['s1'][] = trim(strip_tags($giai31->find('span[class=bong_tron]',3)->innertext));
	
	$array_db['g3']['s2'][] = trim(strip_tags($giai32->find('span[class=bong_tron]',0)->innertext));
	$array_db['g3']['s2'][] = trim(strip_tags($giai32->find('span[class=bong_tron]',1)->innertext));
	$array_db['g3']['s2'][] = trim(strip_tags($giai32->find('span[class=bong_tron]',2)->innertext));
	$array_db['g3']['s2'][] = trim(strip_tags($giai32->find('span[class=bong_tron]',3)->innertext));
	
	$array_db['g3']['s3'][] = trim(strip_tags($giai33->find('span[class=bong_tron]',0)->innertext));
	$array_db['g3']['s3'][] = trim(strip_tags($giai33->find('span[class=bong_tron]',1)->innertext));
	$array_db['g3']['s3'][] = trim(strip_tags($giai33->find('span[class=bong_tron]',2)->innertext));
	$array_db['g3']['s3'][] = trim(strip_tags($giai33->find('span[class=bong_tron]',3)->innertext));
	
	$giaikk1 = $list_number_db[6];
	$giaikk2 = $list_number_db[7];
	
	$array_db['kk1'][] = trim(strip_tags($giaikk1->find('span[class=bong_tron]',0)->innertext));
	$array_db['kk1'][] = trim(strip_tags($giaikk1->find('span[class=bong_tron]',1)->innertext));
	$array_db['kk1'][] = trim(strip_tags($giaikk1->find('span[class=bong_tron]',2)->innertext));
	$array_db['kk1'][] = trim(strip_tags($giaikk1->find('span[class=bong_tron]',3)->innertext));
	
	$array_db['kk2'][] = trim(strip_tags($giaikk2->find('span[class=bong_tron]',0)->innertext));
	$array_db['kk2'][] = trim(strip_tags($giaikk2->find('span[class=bong_tron]',1)->innertext));
	$array_db['kk2'][] = trim(strip_tags($giaikk2->find('span[class=bong_tron]',2)->innertext));
	$array_db['kk2'][] = trim(strip_tags($giaikk2->find('span[class=bong_tron]',3)->innertext));

	
	
    //$detail = $web->find('table[class=table table-striped]',0);   
	$detail = $web->find('div[class=table-responsive] table[class=table table-hover]',0);   
     
    $list_dt = $detail->find('tr');
	$array_dt = array();
	$array_dt['g1']['kq'] = trim(strip_tags($list_dt[3]->find('td',1)->innertext)); 
	$array_dt['g1']['sl'] = trim(strip_tags($list_dt[3]->find('td',2)->innertext));  
	$array_dt['g1']['th4'] = trim(strip_tags($list_dt[3]->find('td',3)->innertext)); 
	$array_dt['g1']['th6'] = trim(strip_tags($list_dt[3]->find('td',4)->innertext)); 
	$array_dt['g1']['th12'] = trim(strip_tags($list_dt[3]->find('td',5)->innertext)); 
	$array_dt['g1']['th24'] = trim(strip_tags($list_dt[3]->find('td',6)->innertext)); 
	
	$array_dt['g2']['kq'] = trim(strip_tags(preg_replace('/<\/b>\s*<b>/ism',' - ',$list_dt[2]->find('td',1)->innertext))); 
	$array_dt['g2']['sl'] = trim(strip_tags($list_dt[4]->find('td',2)->innertext)); 
	$array_dt['g2']['th4'] = trim(strip_tags($list_dt[4]->find('td',3)->innertext)); 
	$array_dt['g2']['th6'] = trim(strip_tags($list_dt[4]->find('td',4)->innertext)); 
	$array_dt['g2']['th12'] = trim(strip_tags($list_dt[4]->find('td',5)->innertext)); 
	$array_dt['g2']['th24'] = trim(strip_tags($list_dt[4]->find('td',6)->innertext)); 
	
	$array_dt['g3']['kq'] = trim(strip_tags(preg_replace('/<\/b>\s*<b>/ism',' - ',$list_dt[3]->find('td',1)->innertext))); 
	$array_dt['g3']['sl'] = trim(strip_tags($list_dt[5]->find('td',2)->innertext)); 
	$array_dt['g3']['th4'] = trim(strip_tags($list_dt[5]->find('td',3)->innertext)); 
	$array_dt['g3']['th6'] = trim(strip_tags($list_dt[5]->find('td',4)->innertext)); 
	$array_dt['g3']['th12'] = trim(strip_tags($list_dt[5]->find('td',5)->innertext)); 
	$array_dt['g3']['th24'] = trim(strip_tags($list_dt[5]->find('td',6)->innertext)); 
	
	$array_dt['kk1']['kq'] = trim(strip_tags($list_dt[6]->find('td',1)->innertext)); 
	$array_dt['kk1']['sl'] = trim(strip_tags($list_dt[6]->find('td',2)->innertext));
	$array_dt['kk1']['th4'] = trim(strip_tags($list_dt[6]->find('td',3)->innertext)); 
	$array_dt['kk1']['th6'] = trim(strip_tags($list_dt[6]->find('td',4)->innertext)); 
	$array_dt['kk1']['th12'] = trim(strip_tags($list_dt[6]->find('td',5)->innertext)); 
	$array_dt['kk1']['th24'] = trim(strip_tags($list_dt[6]->find('td',6)->innertext)); 
	
	$array_dt['kk2']['kq'] = trim(strip_tags($list_dt[7]->find('td',1)->innertext)); 
	$array_dt['kk2']['sl'] = trim(strip_tags($list_dt[7]->find('td',2)->innertext)); 
	$array_dt['kk2']['th4'] = trim(strip_tags($list_dt[7]->find('td',3)->innertext)); 
	$array_dt['kk2']['th6'] = trim(strip_tags($list_dt[7]->find('td',4)->innertext)); 
	$array_dt['kk2']['th12'] = trim(strip_tags($list_dt[7]->find('td',5)->innertext)); 
	$array_dt['kk2']['th24'] = trim(strip_tags($list_dt[7]->find('td',6)->innertext)); 
	
	if(!$array_dt['kk2']['sl']){
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
                            `type` = 2,
                            `drawId` = ".Quote(trim($obj_cat->next)).",
                            `content` = ".Quote(trim($data_final)).",  
                            `date` = ".Quote(trim($date)).", 
                            `dateint` = ".Quote(strtotime($date));
	//var_dump($sql_insert); die; 					
    $db->run_query($sql_insert);
	
 
    $sql_update = "UPDATE `vietlott_crawl` SET `next` = " . Quote($next_param) . ", `time` = " . Quote(strtotime('now')) . " WHERE `id` = $obj_cat->id";
    $db->run_query($sql_update);
    return 1;
}


?>
