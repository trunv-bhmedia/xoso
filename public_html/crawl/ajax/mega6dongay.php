<?php

function get_cat($datedove) {
    $db = new MyDBO();
    $sql = "SELECT * FROM `vietlott_data` WHERE type = 1 AND date like '$datedove%' LIMIT 1";
    $row = $db->get_one_row($sql);
    return $row;
}

function get_data($datedove, $dsSoDo) {
    $datedove = preg_replace('/(\d{2})\/(\d{2})\/(\d{4})/is', '$3-$2-$1', $datedove);
    $href = new href();
    $objecData = get_cat($datedove);
    $defalutExecution = ini_get('max_execution_time');
    @set_time_limit(60 * 30);
    if ($objecData) {
        $objboso = json_decode($objecData->content);
        $boso = $objboso->content->db;
        $countInput = count($dsSoDo);
        $arrDayTrung=array();
        for ($k = 0; $k < $countInput; $k++) {
            $countTG=0;$strout='';
            $itemDay = $dsSoDo[$k];
            asort($itemDay);
            for ($i = 0; $i < 6; $i++) {
                if (in_array($itemDay[$i], $boso)) {
                    $strout .= '<span class="active">' . $itemDay[$i] . '</span>';
//                    $status = 1;
                    $countTG++;
                } else{
                    $strout .= '<span>' . $itemDay[$i] . '</span>';
                }
            }
            if($countTG>2){
                $arrDayTrung[][$countTG]=$strout;
            }
        }
        if ($arrDayTrung) {
            ?>    
            <div class="box_kqxs margin-top-box xsmt-new-table" id="matran">
                <div id="kqxs_matran">
                    <div class="result-header">
                        <h2 class="heder-matran"><span>Dãy số trúng</span></h2>
                    </div>
                    <div class="box_so xsmt-new-table">
                        <div class="box_so_left">
                            <table width="100%" cellspacing="1" cellpadding="0" border="0" bgcolor="#f8f8f8">
                                <tbody>
                                    <tr>
                                        <th>Ngày mở thưởng</th>
                                        <th>Bộ số chiến thắng</th>
                                        <th>Giải thưởng</th>
                                    </tr>
                                    <?php 
                                    $countItem = count($arrDayTrung);
                                    for ($i=0;$i<$countItem;$i++){?>
                                    <tr class="web_bg_Trang">
                                        <td class="web_XS_1 chugiai"><?php echo date('d/m/Y', strtotime($objecData->date)) ?></td>
                                        <?php $arrDayTrung[$i]; foreach ($arrDayTrung[$i] as $gaiTrung=>$itemdtvalue){ ?>
                                        <td class="web_XS_2 chukq"><?php echo $itemdtvalue;?></td>
                                        <td>
                                            <?php
                                            if ($gaiTrung == 3)
                                                echo "Giải ba";
                                            else if ($gaiTrung == 4)
                                                echo "Giải nhì";
                                            else if ($gaiTrung == 5)
                                                echo "Giải nhất";
                                            else echo "Jackpot";
                                            ?>
                                        </td>
                                    <?php }?>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="boxseo bogoc2">
                        <a href="#" class="send-sms" data-telno="9911" data-message="MEGA">
                            <h3 style="color: green; text-transform: uppercase; font-weight: bold"><center>Chúc mừng bạn đã trúng giải</center></h3>
                        </a>
                    </div>        
                </div>
            </div>					
            <?php
        }
        else {
            ?>
            <div class="boxseo bogoc2">
                <center><b>Rất tiếc, vé số của bạn chưa giành chiến thắng.</b></center>
            </div>
            <?php
        }
    }else {
            ?>
            <div class="boxseo bogoc2">
                <center><b>Chọn ngày mở thưởng.</b></center>
            </div>
            <?php
        }
    @set_time_limit($defalutExecution);
    die;
}
?>
