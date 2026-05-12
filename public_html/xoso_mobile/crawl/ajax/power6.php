<?php

function get_cat($drawid) {
    $db = new MyDBO();
    $sql = "SELECT * FROM `vietlott_data` WHERE type = 3 AND drawId = " . trim($drawid) . " LIMIT 1";
    $row = $db->get_one_row($sql);
    return $row;
}

function get_data($drawid) {
    $href = new href();
    $obj_cat = get_cat($drawid);
    $defalutExecution = ini_get('max_execution_time');
    @set_time_limit(60 * 30);

    if ($obj_cat) {
        ?>    
        <div class="box-result-detail">
            <p class="time-result">Kỳ quay thưởng #000<?php echo $obj_cat->drawId; ?> | Ngày quay thưởng <?php echo date('d/m/Y', $obj_cat->dateint); ?></p>
            <div class="box-loading"><img class="loading-box-vietlott" src="http://www.xoso.com/public/client/images/loading-circle.gif" alt="loading-xo-so-vietlott"></div>
            <ul class="result-number">
                <li class="arrow-result">
                    <a href="javascript:void(0)" onclick=" return prevNextResultGamePower655(this, 0)" data-gameid="3" data-drawid="<?php echo $obj_cat->drawId - 1; ?>" data-dayprize="<?php echo date('n/j/Y', $obj_cat->dateint); ?> 12:00:00 AM">
                        <i class="icon-arrow-left my-file-vietlott"></i>
                    </a>
                </li>
                <?php $data_power_content = json_decode($obj_cat->content); ?>
                <li><?php echo $data_power_content->content->db[0]; ?></li>
                <li><?php echo $data_power_content->content->db[1]; ?></li>
                <li><?php echo $data_power_content->content->db[2]; ?></li>
                <li><?php echo $data_power_content->content->db[3]; ?></li>
                <li><?php echo $data_power_content->content->db[4]; ?></li>
                <li><?php echo $data_power_content->content->db[5]; ?></li>
                <li class="number-Special"><?php echo $data_power_content->content->db[6]; ?></li>
                <li class="arrow-result">
                    <a href="javascript:void(0)" onclick=" return prevNextResultGamePower655(this, 1)" data-gameid="3" data-drawid="<?php echo $obj_cat->drawId + 1; ?>" data-dayprize="<?php echo date('n/j/Y', $obj_cat->dateint); ?> 12:00:00 AM">
                        <i class="icon-arrow-right my-file-vietlott"></i>
                    </a>
                </li>
            </ul>
             <p class="time-result" style="margin-top: 10px; font-weight: bold; text-align: center; font-size: 20px;"><?php echo $data_power_content->content->nd->jp->gt; ?></p>
            <p class="time-result" style="margin-top: 10px;">Các con số dự thưởng phải trùng với số kết quả nhưng không cần theo đúng thứ tự</p>
        </div>

        <?php
    }
    @set_time_limit($defalutExecution);
    die;
}
?>
