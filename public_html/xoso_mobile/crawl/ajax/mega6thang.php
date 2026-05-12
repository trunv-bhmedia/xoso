<?php

function get_cat($thang, $nam) {
    $db = new MyDBO();
    $date = $nam . "-" . $thang;
    $sql = "SELECT * FROM `vietlott_data` WHERE type = 1 AND date like '$date%'";
    //var_dump($sql); die;
    $rows = $db->get_rows($sql);

    return $rows;
}

function get_data($thang, $nam) {
    $href = new href();

    $arr_cat = get_cat($thang, $nam);

    $defalutExecution = ini_get('max_execution_time');
    @set_time_limit(60 * 30);
//    var_dump($arr_cat[0]); die;
    if (count($arr_cat)) {
        ?>    
        <div class="box_so margin-top-box xsmt-new-table">
            <div class="box_so_left">
                <div class="result-header">
                    <h2 class="heder-matran"><span>Kết quả tìm kiếm</span></h2>
                </div>
                <table width="100%" cellspacing="1" cellpadding="0" border="0" bgcolor="#f8f8f8">
                    <tbody>

                        <tr>
                            <th>Ngày mở thưởng</th>
                            <th>Bộ số chiến thắng</th>
                            <th>Giải đặc biệt</th>
                        </tr>
                        <?php
                        for ($i = 0; $i < count($arr_cat); $i++) {
                            $j = count($arr_cat) - $i;
                            $item_mega = $arr_cat[$j - 1];
                            $data_mega_content_item = json_decode($item_mega->content);
                            ?>
                            <tr class="web_bg_Trang">
                                <td class="web_XS_1 chugiai"><?php echo date('d/m/Y', strtotime($item_mega->date)); ?></td>
                                <td class="web_XS_2 chukq">
                                    <span><?php echo $data_mega_content_item->content->db[0]; ?></span><span><?php echo $data_mega_content_item->content->db[1]; ?></span><span><?php echo $data_mega_content_item->content->db[2]; ?></span><span><?php echo $data_mega_content_item->content->db[3]; ?></span><span><?php echo $data_mega_content_item->content->db[4]; ?></span><span><?php echo $data_mega_content_item->content->db[5]; ?></span>
                                </td>
                                <td><?php echo $data_mega_content_item->content->nd->jp->gt; ?> VNĐ</td>
                            </tr>
                        <?php } ?> 
                    </tbody>
                </table>
            </div>

        </div>

    <?php } else { ?>
        <center class="tb-not"><b>Tháng này chưa có dữ liệu</b><br></center>
        <?php
    }
    @set_time_limit($defalutExecution);
    die;
}
?>