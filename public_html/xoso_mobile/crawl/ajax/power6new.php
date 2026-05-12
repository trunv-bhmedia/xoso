<?php

function get_cat($drawid) {
    $db = new MyDBO();
    $sql = "SELECT * FROM `vietlott_data` WHERE type = 3 AND drawId = " . trim($drawid) . " LIMIT 1";
    //var_dump($sql); die;
    $row = $db->get_one_row($sql);
    return $row;
}

function get_data($drawid) {
    $href = new href();
    $obj_cat = get_cat($drawid);
    $defalutExecution = ini_get('max_execution_time');
    @set_time_limit(60 * 30);
    //var_dump($arr_cat[0]); die;
    if ($obj_cat) {
        ?>    
        <div class="jackpost-xx mega645-box" >
            <h2 class="jackpost-xx-h2">KẾT QUẢ TRÚNG THƯỞNG<br>POWER 6/55<small>Ngày quay thưởng <?php echo date('d/m/Y', $obj_cat->dateint); ?></small></h2>
            <div class="jackpost-xx-content" >
                <div class="jackpost-xx-content-top">
                    <ul>
                        <?php $data_mega_content = json_decode($obj_cat->content); ?>
                        <li><?php echo $data_mega_content->content->db[0]; ?></li>
                        <li><?php echo $data_mega_content->content->db[1]; ?></li>
                        <li><?php echo $data_mega_content->content->db[2]; ?></li>
                        <li><?php echo $data_mega_content->content->db[3]; ?></li>
                        <li><?php echo $data_mega_content->content->db[4]; ?></li>
                        <li><?php echo $data_mega_content->content->db[5]; ?></li> 
                        <li class="number-Special"><?php echo $data_mega_content->content->db[6]; ?></li>
                    </ul>
                    <div class="button-slide">                                
                        <a class="mega-result-btn" href="javascript:void(0)" onclick=" return prevNextResultGamePower655(this, 1)" data-gameid="3" data-drawid="<?php echo $obj_cat->drawId - 1; ?>" data-dayprize="<?php echo date('n/j/Y', $obj_cat->dateint); ?> 12:00:00 AM">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="mega-result-btn" href="javascript:void(0)" onclick=" return prevNextResultGamePower655(this, 0)" data-gameid="3" data-drawid="<?php echo $obj_cat->drawId + 1; ?>" data-dayprize="<?php echo date('n/j/Y', $obj_cat->dateint); ?> 12:00:00 AM">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="jackpost-xx-content-mid">
                    <div class="box_so xsmt-new-table">
                        <div class="box_so_left">
                            <table class="tablesxs" width="100%" cellspacing="1" cellpadding="0" border="0">
                                <tbody>
                                    <tr class="web_bg_title_tinh">
                                        <td colspan="4" class="web_XS_1 chugiai"><h2 class="h2-matran">Giá trị Jackpot 1</h2></td>
                                    </tr>
                                    <tr>
                                        <td class="jack-sxs" colspan="4" style="font-size: 16px !important;"><?php echo $data_mega_content->content->nd->jp->gt; ?> đồng</td>
                                    </tr>
                                    <tr>
                                        <th>Giải thưởng</th>
                                        <th>Trùng khớp</th>                                    
                                        <th>Số lượng giải</th>
                                        <th>Giá trị giải (đồng)</th>
                                    </tr>

                                    <tr class="web_bg_Trang">
                                        <td class="web_XS_1 chugiai">Jackpot 1</td>
                                        <td class="web_XS_2 chukq"><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i></td>
                                        <td><?php echo $data_mega_content->content->nd->jp->sl; ?></td>
                                        <td><?php echo $data_mega_content->content->nd->jp->gt; ?></td>
                                    </tr>
                                    <tr class="web_bg_Trang">
                                        <td class="web_XS_1 chugiai">Jackpot 2</td>
                                        <td class="web_XS_2 chukq"><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle cbv-not-pow" aria-hidden="true"></i></td>
                                        <td><?php echo $data_mega_content->content->nd->jp2->sl; ?></td>
                                        <td><?php echo $data_mega_content->content->nd->jp2->gt; ?></td>
                                    </tr>
                                    <tr class="web_bg_Trang">
                                        <td class="web_XS_1 chugiai">Giải nhất</td>
                                        <td class="web_XS_2 chukq"><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i></td>
                                        <td><?php echo $data_mega_content->content->nd->g1->sl; ?></td>
                                        <td><?php echo $data_mega_content->content->nd->g1->gt; ?></td>
                                    </tr>
                                    <tr class="web_bg_Trang">
                                        <td class="web_XS_1 chugiai">Giải nhì</td>
                                        <td class="web_XS_2 chukq"><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i></td>
                                        <td><?php echo $data_mega_content->content->nd->g2->sl; ?></td>
                                        <td><?php echo $data_mega_content->content->nd->g2->gt; ?></td>
                                    </tr>
                                    <tr class="web_bg_Trang">
                                        <td class="web_XS_1 chugiai">Giải ba</td>
                                        <td class="web_XS_2 chukq"><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i><i class="fa fa-circle" aria-hidden="true"></i></td>
                                        <td><?php echo $data_mega_content->content->nd->g3->sl; ?></td>
                                        <td><?php echo $data_mega_content->content->nd->g3->gt; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }
    @set_time_limit($defalutExecution);
    die;
}
?>
