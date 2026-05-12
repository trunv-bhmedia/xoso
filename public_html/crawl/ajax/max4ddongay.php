<?php

function get_cat($datedove) {
    $db = new MyDBO();
    $sql = "SELECT * FROM `vietlott_data` WHERE type = 2 AND date like '$datedove%' LIMIT 1";
    //var_dump($sql); die;
    $rows = $db->get_rows($sql);

    return $rows;
}

function get_data($datedove, $number_soi) {
    
    $array_number = $number_soi;
//    var_dump($number_soi); die;
    $datedove = preg_replace('/(\d{2})\/(\d{2})\/(\d{4})/is', '$3-$2-$1', $datedove);
    //var_dump($datedove); die;
    $href = new href();    
    $arr_cat = get_cat($datedove);   
    
   //var_dump($arr_cat); die;
    $defalutExecution = ini_get('max_execution_time');
    @set_time_limit(60 * 30);
    //var_dump($arr_cat[0]); die;
    if (count($arr_cat)) { 
        $obj_cat = $arr_cat[0]; 
        $objboso = json_decode($obj_cat->content);
        $g1 = $objboso->content->nd->g1->kq;  
        $giainhi = explode('-', $objboso->content->nd->g2->kq);
        $giaiba = explode('-', $objboso->content->nd->g3->kq);
        $giainhi = array_map('trim',$giainhi);  
        $giaiba = array_map('trim',$giaiba);  
        //var_dump($giainhi); die;
        $sotrung = '';
        $status = 0;
        $giai = '';
        $arrresult = array();
        for($i=0; $i<count($array_number); $i++){  
            if(in_array($array_number[$i], $giainhi)){
                $status = 1;
                $arrresult['giai'][] = 'Giải Nhì';
                $arrresult['sotrung'][] = $array_number[$i];
            }
            if(in_array($array_number[$i], $giaiba)){
                $status = 1;
                $arrresult['giai'][] = 'Giải Ba';
                $arrresult['sotrung'][] = $array_number[$i];
            }
            if($g1 == $array_number[$i]){
                $arrresult['giai'][] = 'Giải Nhất';
                $arrresult['sotrung'][] = $array_number[$i];
                $status = 1;                
            }elseif(substr($g1, 1, 3) == substr($array_number[$i], 1, 3)){
                $arrresult['giai'][] = 'Giải Khuyến Khích 1';
                $arrresult['sotrung'][] = $array_number[$i];                
                $status = 1; 
            }elseif(substr($g1, 2, 2) == substr($array_number[$i], 2, 2)){
                $arrresult['giai'][] = 'Giải Khuyến Khích 2';
                $arrresult['sotrung'][] = $array_number[$i];   
                $status = 1; 
            }else{
                continue;
            }
        }
        //var_dump($sotrung); die;
        if($status == 1){
	?>    
                <div class="box_kqxs margin-top-box xsmt-new-table" id="matran">
                    <div id="kqxs_matran">                       
                        <div class="boxseo bogoc2">   
                            <?php
                            for($i=0; $i<count($arrresult['giai']); $i++){ ?>
                            <br>
                            <h3 style="color: green; text-transform: uppercase; font-weight: bold"><center>Chúc mừng bạn đã trúng giải</center></h3>
                            <p><center><b><span style="color: red;"><?php echo $arrresult['giai'][$i];?></span> với bộ số <span style="color: red;"><?php echo $arrresult['sotrung'][$i];?></span></b></center></p>
                            <?php } ?>
                            
                                                       
                        </div>        
                    </div>
                </div>					
	<?php }
        else { ?>
             <div class="boxseo bogoc2">
                 <br>
                    <center><b>Rất tiếc, vé số của bạn chưa giành chiến thắng.</b></center>
             </div>
        <?php }
    }else {
            ?>
            <div class="boxseo bogoc2">
                <br>
                <center><b>Chọn ngày mở thưởng.</b></center>
            </div>
            <?php
        }
    @set_time_limit($defalutExecution);    
    die;
}


?>
