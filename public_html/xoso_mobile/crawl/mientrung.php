<?php
function get_data() {   
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
    $href = new href();

    $link = 'https://www.minhngoc.net.vn/xstt/MT/MT.php?visit=0';    
    echo $link . '<hr>';
    $obj_content = get_content($link);
	if(!$obj_content->content){
		return false;
	}
	$content=$obj_content->content;
	
	preg_match('/listtinhnew="([^\"]*)"/is', $content, $matches);
	
	$array_loc = explode(',', $matches[1]);
	$array_result = array();
	for($i=0; $i<count($array_loc); $i++){
		$object = new stdClass();
		$object->lid = trim($array_loc[$i]);
		$g8 = get_item('/kqxs\["T'.trim($array_loc[$i]).'_G8"\]="([^"]*)"/is',$content);
		$g7 = get_item('/kqxs\["T'.trim($array_loc[$i]).'_G7"\]="([^"]*)"/is',$content);
		$g61 = get_item('/kqxs\["T'.trim($array_loc[$i]).'_G6_1"\]="([^"]*)"/is',$content);
		$g62 = get_item('/kqxs\["T'.trim($array_loc[$i]).'_G6_2"\]="([^"]*)"/is',$content);
		$g63 = get_item('/kqxs\["T'.trim($array_loc[$i]).'_G6_3"\]="([^"]*)"/is',$content);
		$g5 = get_item('/kqxs\["T'.trim($array_loc[$i]).'_G5"\]="([^"]*)"/is',$content);
		$g41 = get_item('/kqxs\["T'.trim($array_loc[$i]).'_G4_1"\]="([^"]*)"/is',$content);
		$g42 = get_item('/kqxs\["T'.trim($array_loc[$i]).'_G4_2"\]="([^"]*)"/is',$content);
		$g43 = get_item('/kqxs\["T'.trim($array_loc[$i]).'_G4_3"\]="([^"]*)"/is',$content);
		$g44 = get_item('/kqxs\["T'.trim($array_loc[$i]).'_G4_4"\]="([^"]*)"/is',$content);
		$g45 = get_item('/kqxs\["T'.trim($array_loc[$i]).'_G4_5"\]="([^"]*)"/is',$content);
		$g46 = get_item('/kqxs\["T'.trim($array_loc[$i]).'_G4_6"\]="([^"]*)"/is',$content);
		$g47 = get_item('/kqxs\["T'.trim($array_loc[$i]).'_G4_7"\]="([^"]*)"/is',$content);
		$g31 = get_item('/kqxs\["T'.trim($array_loc[$i]).'_G3_1"\]="([^"]*)"/is',$content);
		$g32 = get_item('/kqxs\["T'.trim($array_loc[$i]).'_G3_2"\]="([^"]*)"/is',$content);
		$g2 = get_item('/kqxs\["T'.trim($array_loc[$i]).'_G2"\]="([^"]*)"/is',$content);
		$g1 = get_item('/kqxs\["T'.trim($array_loc[$i]).'_G1"\]="([^"]*)"/is',$content);
		$gdb = get_item('/kqxs\["T'.trim($array_loc[$i]).'_Gdb"\]="([^"]*)"/is',$content);
		
		$arr_loto = array();
		$arr_loto[] = substr($g8, -2);		
		$arr_loto[] = substr($g7, -2);
		$arr_loto[] = substr($g61, -2);
		$arr_loto[] = substr($g62, -2);
		$arr_loto[] = substr($g63, -2);
		$arr_loto[] = substr($g5, -2);
		$arr_loto[] = substr($g41, -2);
		$arr_loto[] = substr($g42, -2);
		$arr_loto[] = substr($g43, -2);
		$arr_loto[] = substr($g44, -2);
		$arr_loto[] = substr($g45, -2);
		$arr_loto[] = substr($g46, -2);
		$arr_loto[] = substr($g47, -2);
		$arr_loto[] = substr($g31, -2);
		$arr_loto[] = substr($g32, -2);
		$arr_loto[] = substr($g2, -2);
		$arr_loto[] = substr($g1, -2);
		$arr_loto[] = substr($gdb, -2);	
		
		$object->ext = getExtratxt($arr_loto);
		
		$object->a8 = $g8;
		$object->a7 = $g7;
		$object->a6 = $g61.'-'.$g62.'-'.$g63;
		$object->a5 = $g5;
		$object->a4 = $g41.'-'.$g42.'-'.$g43.'-'.$g44.'-'.$g45.'-'.$g46.'-'.$g47;
		$object->a3 = $g31.'-'.$g32;
		$object->a2 = $g2;
		$object->a1 = $g1;
		$object->a0 = $gdb;
		
		
		$object->b8 = substr($g8, -2);
		$object->b7 = substr($g7, -2);
		$object->b6 = substr($g61, -2).','.substr($g62, -2).','.substr($g63, -2);
		$object->b5 = substr($g5, -2);
		$object->b4 = substr($g41, -2).','.substr($g42, -2).','.substr($g43, -2).','.substr($g44, -2).','.substr($g45, -2).','.substr($g46, -2).','.substr($g47, -2);
		$object->b3 = substr($g31, -2).','.substr($g32, -2);
		$object->b2 = substr($g2, -2);
		$object->b1 = substr($g1, -2);
		$object->b0 = substr($gdb, -2); 
		
		
		
		$array_result[] = $object;
		
		
	}
	
	$yesterday = strtotime('now') - 86400;
    $date = date('Y-m-d',$yesterday);
	$db = new MyDBO();
	foreach ($array_result as $v) {
			
			
            $query = 'INSERT IGNORE INTO xs_result SET
                            lid=' . $v->lid . '
                            ,date=\'' . $date . '\'
                            ,extension=\'' . json_encode($v->ext) . '\'
                            ,a0=\'' . $v->a0 . '\'
                            ,a1=\'' . $v->a1 . '\'
                            ,a2=\'' . $v->a2 . '\'
                            ,a3=\'' . $v->a3 . '\'
                            ,a4=\'' . $v->a4 . '\'
                            ,a5=\'' . $v->a5 . '\'
                            ,a6=\'' . $v->a6 . '\'
                            ,a7=\'' . $v->a7 . '\'
                            ,a8=\'' . $v->a8 . '\'
                            ,b0=\'' . $v->b0 . '\'
                            ,b1=\'' . $v->b1 . '\'
                            ,b2=\'' . $v->b2 . '\'
                            ,b3=\'' . $v->b3 . '\'
                            ,b4=\'' . $v->b4 . '\'
                            ,b5=\'' . $v->b5 . '\'
                            ,b6=\'' . $v->b6 . '\'
                            ,b7=\'' . $v->b7 . '\'
                            ,b8=\'' . $v->b8 . '\'
                        ';
			
            $db->run_query($query);
        }
	
	
    return 1;
}
function get_item($patten, $strin){
	preg_match($patten, $strin, $mathces);
	return trim($mathces[1]);
}
function getExtratxt($arr_loto) {
        $result = array();

        $result[0] = '';
        $result[1] = '';
        $result[2] = '';
        $result[3] = '';
        $result[4] = '';
        $result[5] = '';
        $result[6] = '';
        $result[7] = '';
        $result[8] = '';
        $result[9] = '';

        //lay loto duoi
        $total = count($arr_loto);
        for ($j = 0; $j < $total; $j++) {
            $dau = substr($arr_loto[$j], 0, 1);
            $duoi = substr($arr_loto[$j], 1, 1);
            if ($dau == '0') {
                if ($result[0] == '')
                    $result[0] = $duoi;
                else
                    $result[0] .= ',' . $duoi;
            }elseif ($dau == '1') {
                if ($result[1] == '')
                    $result[1] = $duoi;
                else
                    $result[1] .= ',' . $duoi;
            }elseif ($dau == '2') {
                if ($result[2] == '')
                    $result[2] = $duoi;
                else
                    $result[2] .= ',' . $duoi;
            }elseif ($dau == '3') {
                if ($result[3] == '')
                    $result[3] = $duoi;
                else
                    $result[3] .= ',' . $duoi;
            }elseif ($dau == '4') {
                if ($result[4] == '')
                    $result[4] = $duoi;
                else
                    $result[4] .= ',' . $duoi;
            }elseif ($dau == '5') {
                if ($result[5] == '')
                    $result[5] = $duoi;
                else
                    $result[5] .= ',' . $duoi;
            }elseif ($dau == '6') {
                if ($result[6] == '')
                    $result[6] = $duoi;
                else
                    $result[6] .= ',' . $duoi;
            }elseif ($dau == '7') {
                if ($result[7] == '')
                    $result[7] = $duoi;
                else
                    $result[7] .= ',' . $duoi;
            }elseif ($dau == '8') {
                if ($result[8] == '')
                    $result[8] = $duoi;
                else
                    $result[8] .= ',' . $duoi;
            }elseif ($dau == '9') {
                if ($result[9] == '')
                    $result[9] = $duoi;
                else
                    $result[9] .= ',' . $duoi;
            }
        }

        return $result;
    }

?>
