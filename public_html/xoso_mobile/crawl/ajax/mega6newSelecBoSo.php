<?php

function get_cat($setDay) {
    $db = new MyDBO();
    $sql = "SELECT * FROM `vietlott_data` WHERE type = 1 AND DATE_FORMAT(date, '%Y-%m-%d')>'$setDay'";
    $rows = $db->get_rows($sql);
    return $rows;
}

function so_lan_xuat_hien($mang_so) {
    if (isset($mang_so[0])) {
        $chuoi = "";
        foreach ($mang_so as $key => $value) {
            $chuoi .= $key . ":" . $value . " ";
        }
        echo $chuoi;
    }
}

function get_data($typeNumber, $baoSo) {
    if ($typeNumber == 2) {
        $setDay = date('Y-m-d', strtotime('today - 100 days'));
    } elseif ($typeNumber == 3) {
        $setDay = date('Y-m-d', strtotime('today - 30 days'));
    } else {
        $setDay = date('Y-m-d', strtotime('today - 7 days'));
    }
    $arr_cat = get_cat($setDay);
//    var_dump($arr_cat);die;
    $defalutExecution = ini_get('max_execution_time');
    @set_time_limit(60 * 30);
    if (count($arr_cat)) {
        $cbvAll = array();
        foreach ($arr_cat as $item) {
            $obitem = json_decode($item->content);
            $boSoItem = $obitem->content->db;
            $cbvAll = array_merge($cbvAll, $boSoItem);
            ?>    
            <?php

        }
        $arrso_lan = array_count_values($cbvAll);
        arsort($arrso_lan);
        $keyArr = array_keys($arrso_lan);
        $keyArr=array_slice($keyArr,0 , $baoSo);
        echo json_encode($keyArr);die;
    }
    @set_time_limit($defalutExecution);
    die;
}
?>
