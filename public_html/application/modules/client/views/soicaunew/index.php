<link type="text/css" rel="stylesheet" href="<?php echo css_link('soicau.css') ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo css_link('jquery-ui-1.8.23.custom.css') ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo css_link('jquery.datepick.css') ?>" />
<script type="text/javascript" src="<?php echo js_link('jquery-ui-1.8.23.custom.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo js_link('jquery.datepick.js') ?>"></script>
<div class="title title-red">
    <div class="title-right" style="padding:0 5px 0 295px">
        <ul class="tabs clearfix">
            <li class="active"><a href="<?php echo $uri_root ?>soi-cau.html?setmode=full">Soi cầu toàn diện</a></li>
            <li><a href="<?php echo $uri_root ?>soi-cau.html?setmode=num">Tìm cầu cho cặp số</a></li>
        </ul>
    </div>
</div>

<div class="box-result">
    <form name=f action='<?php echo $uri_root ?>soi-cau.html' method="get" style='padding:10px;text-align:center'>
        <input type=hidden name=submit value='1' />
        <input type=hidden name=setmode value='full' />
        <b>Độ dài của cầu:</b> 
        <select name='exactlimit'>
            <option value='0'<?php echo $exactlimit == 0 ? ' selected="selected"' : '' ?>>Bằng hoặc hơn</option>
            <option value='1'<?php echo $exactlimit == 1 ? ' selected="selected"' : '' ?>>Chính xác bằng</option>
        </select>&nbsp; 
        <input size=2 name=limit value='<?php echo $limit ?>' class="soicau_limit" />&nbsp;ngày&nbsp;&nbsp;
        <input type=submit class=button value=' Soi cầu ' />
        <div style='margin:5px 0 5px 0'>
            <a class=a_small href='javascript:;' onclick='var opts=document.getElementById("opts"); if(opts.style.display=="none"){opts.style.display="block"; this.innerHTML="Tùy chọn ▲"} else {opts.style.display="none"; this.innerHTML="Tùy chọn ▼"}'>Tùy chọn ▲</a>
        </div>
        <div id=opts style='width:440px;margin:0 auto;background:#FFF5E8; border:#F3DCB1 1px solid; padding:5px'>
            Ngày <input size=10 name=ngay id=ngay value='<?php echo $ngay ?>' />
            <select name='nhay' id='nhay' onchange='if(this.value>1)f.db.checked=0'>
                <option value=1<?php echo $nhay == 1 ? ' selected="selected"' : '' ?>>1 nháy</option>
                <option value=2<?php echo $nhay == 2 ? ' selected="selected"' : '' ?>>2 nháy</option>
                <option value=3<?php echo $nhay == 3 ? ' selected="selected"' : '' ?>>3 nháy</option>
                <option value=4<?php echo $nhay == 4 ? ' selected="selected"' : '' ?>>4 nháy</option>
                <option value=5<?php echo $nhay == 5 ? ' selected="selected"' : '' ?>>5 nháy</option>
            </select>
            &nbsp;&nbsp;&nbsp;<input type=checkbox name='db' value=1 onclick='if(this.checked)nhay.selectedIndex=0' id=db<?php echo $db == 1 ? ' checked="checked"' : '' ?> />
            <label for=db>Giải đặc biệt</label>
            &nbsp;&nbsp;&nbsp;<input type=radio name=lon value='1' id=caulon<?php echo $lon == 1 ? ' checked="checked"' : '' ?> />
            <label for=caulon>Lộn</label> 
            &nbsp;&nbsp;&nbsp;<input type=radio name=lon value='0' id=khonglon<?php echo $lon == 0 ? ' checked="checked"' : '' ?> />
            <label for=khonglon>Không lộn</label>         
        </div>
        <div style='clear:both'></div>
    </form>
</div>
<div class="contentcontainer">
    <div style="text-align:center">
        <?php if ($result_cau) { ?>
            <div style='display:none' id='currkq' title='Kết quả xổ số ngày <?php echo str_replace('-', '/', $ngay) ?>'>
                <div  class="box-result">
                    <table class="tbl-tt tbl-main-tt">
                        <tr>
                            <td colspan="2" class="bg-yelow1"><strong class="txt-red"><h2>Xổ Số Miền Bắc - <?php echo $result_cau->dateOfWeek ?> ngày <?php echo str_replace('-', '/', $ngay) ?></h2></strong></td>
                            <td class="td-sub" rowspan="9">
                                <table class="tbl-dd">
                                    <tr>
                                        <th class="first bg-yelow1">Đầu</th>
                                        <th class="last bg-yelow1">Đuôi</th>
                                    </tr>
                                    <?php foreach ($result_cau->extra as $k1 => $v1): ?>
                                        <tr>
                                            <td class="first"><?php echo $k1 ?></td>
                                            <td class="<?php echo($k1 == 9 ? 'last' : ''); ?>"><?php echo $v1; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="bg-gray border-right">Giải ĐB</td>
                            <td class="bg-gray border-right giaidb">
                                <?php echo '<strong class="red font18 span-space">' . $result_cau->a0 . '</strong>'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-right">Giải nhất</td>
                            <td class="border-right giai1">
                                <?php echo '<strong class="span-space">' . $result_cau->a1 . '</strong>'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="bg-gray border-right">Giải nhì</td>
                            <td class="bg-gray border-right giai2">
                                <?php
                                $str = str_replace('-', '</strong><strong class="span-space">', $result_cau->a2);
                                echo '<strong class="span-space">' . $str . '</strong>';
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-right">Giải ba</td>
                            <td class="border-right giai3">
                                <?php
                                $str = str_replace('-', '</strong><strong class="span-space">', $result_cau->a3);
                                echo '<strong class="span-space">' . $str . '</strong>';
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="bg-gray border-right">Giải tư</td>
                            <td class="bg-gray border-right giai4">
                                <?php
                                $str = str_replace('-', '</strong><strong class="span-space">', $result_cau->a4);
                                echo '<strong class="span-space">' . $str . '</strong>';
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-right">Giải năm</td>
                            <td class="border-right giai5">
                                <?php
                                $str = str_replace('-', '</strong><strong class="span-space">', $result_cau->a5);
                                echo '<strong class="span-space">' . $str . '</strong>';
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="bg-gray border-right">Giải sáu</td>
                            <td class="bg-gray border-right giai6">
                                <?php
                                $str = str_replace('-', '</strong><strong class="span-space">', $result_cau->a6);
                                echo '<strong class="span-space">' . $str . '</strong>';
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-right">Giải bảy</td>
                            <td class="border-right giai7">
                                <?php
                                $str = str_replace('-', '</strong><strong class="span-space">', $result_cau->a7);
                                echo '<strong class="span-space">' . $str . '</strong>';
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="ablue" style="padding-bottom:10px"><a href='javascript:;' onclick='dlg("currkq",530,500); return false'>>> Xem kết quả ngày <?php echo str_replace('-', '/', $ngay) ?></a></div>
        <?php } ?>

        <div style="text-align:center" id=showcauarea></div>
        <div style='font-size:13px; color:#6C6C6C; font-weight:bold; padding:5px 0'>Số ngày cầu chạy:</div>
        <table border=0 cellspacing=2 style='margin:0 auto 10px'>
            <tr>
                <?php
                for ($i = 1; $i <= $max_cau; $i++) {
                    $class = '';
                    $classtd = '';
                    if ($limit == $i) {
                        $class = ' showdays_a_on';
                        $classtd = ' showdays_td_on';
                    }
                    $url = '?ngay=' . $ngay . '&amp;limit=' . $i . '&amp;exactlimit=' . $exactlimit . '&amp;lon=' . $lon . '&amp;nhay=' . $nhay . '&amp;db=' . $db;
                    ?>
                    <td align=center class='showdays_td<?php echo $classtd ?>'>
                        <a href='<?php echo $url ?>' class='showdays_a<?php echo $class ?>'><?php echo $i ?></a>
                    </td>
                    <?php
                }
                ?>            
            </tr>
        </table>

        <?php
        $days = array('0' => 'Chủ Nhật', '1' => 'Thứ Hai', '2' => 'Thứ Ba', '3' => 'Thứ Tư', '4' => 'Thứ Năm', '5' => 'Thứ Sáu', '6' => 'Thứ Bảy');
        $arr_matrix = str_split($matrancau->str);

        $list_cau = array();
        $str_list_cau = '';
        $arr_vitri = array();
        foreach ($data_limit as $vitri => $value) {
            $str_vitri = explode('x', $vitri);
            $arr_vitri[$str_vitri[1]][] = 'vt_' . $str_vitri[0];

            if ($lon == 0) {
                $arr_vitri[$str_vitri[0]][] = 'vt0lon_' . $str_vitri[1];

                $list_cau[$value]['cau'] = $list_cau[$value]['cau'] + 1;
                $list_cau[$value]['so'] = $value;
                $list_cau[$value]['order'] = $value;
            } else {
                $arr_vitri[$str_vitri[0]][] = 'vt_' . $str_vitri[1];

                $arr = str_split($value);
                if ($arr[0] != $arr[1]) {
                    if ($arr[0] > $arr[1]) {
                        $list_cau[$arr[1] . $arr[0] . ',' . $arr[0] . $arr[1]]['cau'] = $list_cau[$arr[1] . $arr[0] . ',' . $arr[0] . $arr[1]]['cau'] + 1;
                        $list_cau[$arr[1] . $arr[0] . ',' . $arr[0] . $arr[1]]['so'] = $arr[1] . $arr[0] . ',' . $arr[0] . $arr[1];
                        $list_cau[$arr[1] . $arr[0] . ',' . $arr[0] . $arr[1]]['order'] = $arr[1] . $arr[0];
                    } else {
                        $list_cau[$arr[0] . $arr[1] . ',' . $arr[1] . $arr[0]]['cau'] = $list_cau[$arr[0] . $arr[1] . ',' . $arr[1] . $arr[0]]['cau'] + 1;
                        $list_cau[$arr[0] . $arr[1] . ',' . $arr[1] . $arr[0]]['so'] = $arr[0] . $arr[1] . ',' . $arr[1] . $arr[0];
                        $list_cau[$arr[0] . $arr[1] . ',' . $arr[1] . $arr[0]]['order'] = $arr[0] . $arr[1];
                    }
                } else {
                    $list_cau[$value]['cau'] = $list_cau[$value]['cau'] + 1;
                    $list_cau[$value]['so'] = $value;
                    $list_cau[$value]['order'] = $value;
                }
            }

            $class = '';
            if ($exactlimit == 0 && isset($data_nextlimit[$vitri]))
                $class = ' a_cau_more';
            $str_list_cau .= "<a title='Tại vị trí " . $vitri . "' class='a_cau" . $class . "' href='?showcau&amp;ngay=" . $ngay . "&amp;limit=" . $limit . "&amp;exactlimit=" . $exactlimit . "&amp;lon=" . $lon . "&amp;nhay=" . $nhay . "&amp;db=" . $db . "&amp;vt=" . $vitri . "'>" . $value . "</a>";
        }
        foreach ($list_cau as $key => $value) {
            $sort_so[$key] = $value['order'];
            $sort_cau[$key] = $value['cau'];
        }
        array_multisort($sort_cau, SORT_DESC, $sort_so, SORT_ASC, $list_cau);
        if ($lon == 0) {
            $list_cau_next = array();
            foreach ($data_nextlimit as $value) {
                $list_cau_next[$value] = $list_cau_next[$value] + 1;
            }
            $cap_nextlimit = count($list_cau_next);
        } else {
            $list_cau_next = array();
            foreach ($data_nextlimit as $value) {
                $arr = str_split($value);
                if ($arr[0] != $arr[1]) {
                    if ($arr[0] > $arr[1]) {
                        $list_cau_next[$arr[1] . $arr[0] . ',' . $arr[0] . $arr[1]] = $list_cau_next[$arr[1] . $arr[0] . ',' . $arr[0] . $arr[1]] + 1;
                    } else {
                        $list_cau_next[$arr[0] . $arr[1] . ',' . $arr[1] . $arr[0]] = $list_cau_next[$arr[0] . $arr[1] . ',' . $arr[1] . $arr[0]] + 1;
                    }
                } else {
                    $list_cau_next[$value] = $list_cau_next[$value] + 1;
                }
            }
            $cap_nextlimit = count($list_cau_next);
        }
        $top_cau = current($list_cau);
        ?>
        <div style='display:none' id="matrix<?php echo str_replace('-', '', $ngay) ?>" title='MA TRẬN CẦU' class='matrancau_dlg'>
            <table class=matrancau cellspacing=1 cellpadding=3>
                <thead>
                    <tr><th colspan=13>Mở thưởng <?php echo $days[date('w', strtotime($matrancau->date))] ?> ngày <?php echo date('d/m/Y', strtotime($matrancau->date)) ?></th></tr>
                </thead>
                <tr>
                    <td class=leftcol>Đặc Biệt</td>
                    <td colspan=12>
                        <span id='vt_0' title='Vị trí: 0' class='vt <?php echo isset($arr_vitri[0]) ? implode(' ', $arr_vitri[0]) . ' cocau' : '' ?>'><?php echo $arr_matrix[0] ?></span>
                        <span id='vt_1' title='Vị trí: 1' class='vt <?php echo isset($arr_vitri[1]) ? implode(' ', $arr_vitri[1]) . ' cocau' : '' ?>'><?php echo $arr_matrix[1] ?></span>
                        <span id='vt_2' title='Vị trí: 2' class='vt <?php echo isset($arr_vitri[2]) ? implode(' ', $arr_vitri[2]) . ' cocau' : '' ?>'><?php echo $arr_matrix[2] ?></span>
                        <span id='vt_3' title='Vị trí: 3' class='vt <?php echo isset($arr_vitri[3]) ? implode(' ', $arr_vitri[3]) . ' cocau' : '' ?>'><?php echo $arr_matrix[3] ?></span>
                        <span id='vt_4' title='Vị trí: 4' class='vt <?php echo isset($arr_vitri[4]) ? implode(' ', $arr_vitri[4]) . ' cocau' : '' ?>'><?php echo $arr_matrix[4] ?></span>
                    </td>
                </tr>
                <tr>
                    <td class=leftcol>Giải Nhất</td>
                    <td colspan=12>
                        <span id='vt_5' title='Vị trí: 5' class='vt <?php echo isset($arr_vitri[5]) ? implode(' ', $arr_vitri[5]) . ' cocau' : '' ?>'><?php echo $arr_matrix[5] ?></span>
                        <span id='vt_6' title='Vị trí: 6' class='vt <?php echo isset($arr_vitri[6]) ? implode(' ', $arr_vitri[6]) . ' cocau' : '' ?>'><?php echo $arr_matrix[6] ?></span>
                        <span id='vt_7' title='Vị trí: 7' class='vt <?php echo isset($arr_vitri[7]) ? implode(' ', $arr_vitri[7]) . ' cocau' : '' ?>'><?php echo $arr_matrix[7] ?></span>
                        <span id='vt_8' title='Vị trí: 8' class='vt <?php echo isset($arr_vitri[8]) ? implode(' ', $arr_vitri[8]) . ' cocau' : '' ?>'><?php echo $arr_matrix[8] ?></span>
                        <span id='vt_9' title='Vị trí: 9' class='vt <?php echo isset($arr_vitri[9]) ? implode(' ', $arr_vitri[9]) . ' cocau' : '' ?>'><?php echo $arr_matrix[9] ?></span>
                    </td>
                </tr>
                <tr>
                    <td class=leftcol>Giải Nhì</td>
                    <td colspan=6>
                        <span id='vt_10' title='Vị trí: 10' class='vt <?php echo isset($arr_vitri[10]) ? implode(' ', $arr_vitri[10]) . ' cocau' : '' ?>'><?php echo $arr_matrix[10] ?></span>
                        <span id='vt_11' title='Vị trí: 11' class='vt <?php echo isset($arr_vitri[11]) ? implode(' ', $arr_vitri[11]) . ' cocau' : '' ?>'><?php echo $arr_matrix[11] ?></span>
                        <span id='vt_12' title='Vị trí: 12' class='vt <?php echo isset($arr_vitri[12]) ? implode(' ', $arr_vitri[12]) . ' cocau' : '' ?>'><?php echo $arr_matrix[12] ?></span>
                        <span id='vt_13' title='Vị trí: 13' class='vt <?php echo isset($arr_vitri[13]) ? implode(' ', $arr_vitri[13]) . ' cocau' : '' ?>'><?php echo $arr_matrix[13] ?></span>
                        <span id='vt_14' title='Vị trí: 14' class='vt <?php echo isset($arr_vitri[14]) ? implode(' ', $arr_vitri[14]) . ' cocau' : '' ?>'><?php echo $arr_matrix[14] ?></span>
                    </td>
                    <td colspan=6>
                        <span id='vt_15' title='Vị trí: 15' class='vt <?php echo isset($arr_vitri[15]) ? implode(' ', $arr_vitri[15]) . ' cocau' : '' ?>'><?php echo $arr_matrix[15] ?></span>
                        <span id='vt_16' title='Vị trí: 16' class='vt <?php echo isset($arr_vitri[16]) ? implode(' ', $arr_vitri[16]) . ' cocau' : '' ?>'><?php echo $arr_matrix[16] ?></span>
                        <span id='vt_17' title='Vị trí: 17' class='vt <?php echo isset($arr_vitri[17]) ? implode(' ', $arr_vitri[17]) . ' cocau' : '' ?>'><?php echo $arr_matrix[17] ?></span>
                        <span id='vt_18' title='Vị trí: 18' class='vt <?php echo isset($arr_vitri[18]) ? implode(' ', $arr_vitri[18]) . ' cocau' : '' ?>'><?php echo $arr_matrix[18] ?></span>
                        <span id='vt_19' title='Vị trí: 19' class='vt <?php echo isset($arr_vitri[19]) ? implode(' ', $arr_vitri[19]) . ' cocau' : '' ?>'><?php echo $arr_matrix[19] ?></span>
                    </td>
                </tr>
                <tr>
                    <td rowspan=2 class=leftcol>Giải Ba</td>
                    <td colspan=4>
                        <span id='vt_20' title='Vị trí: 20' class='vt <?php echo isset($arr_vitri[20]) ? implode(' ', $arr_vitri[20]) . ' cocau' : '' ?>'><?php echo $arr_matrix[20] ?></span>
                        <span id='vt_21' title='Vị trí: 21' class='vt <?php echo isset($arr_vitri[21]) ? implode(' ', $arr_vitri[21]) . ' cocau' : '' ?>'><?php echo $arr_matrix[21] ?></span>
                        <span id='vt_22' title='Vị trí: 22' class='vt <?php echo isset($arr_vitri[22]) ? implode(' ', $arr_vitri[22]) . ' cocau' : '' ?>'><?php echo $arr_matrix[22] ?></span>
                        <span id='vt_23' title='Vị trí: 23' class='vt <?php echo isset($arr_vitri[23]) ? implode(' ', $arr_vitri[23]) . ' cocau' : '' ?>'><?php echo $arr_matrix[23] ?></span>
                        <span id='vt_24' title='Vị trí: 24' class='vt <?php echo isset($arr_vitri[24]) ? implode(' ', $arr_vitri[24]) . ' cocau' : '' ?>'><?php echo $arr_matrix[24] ?></span>
                    </td>
                    <td colspan=4>
                        <span id='vt_25' title='Vị trí: 25' class='vt <?php echo isset($arr_vitri[25]) ? implode(' ', $arr_vitri[25]) . ' cocau' : '' ?>'><?php echo $arr_matrix[25] ?></span>
                        <span id='vt_26' title='Vị trí: 26' class='vt <?php echo isset($arr_vitri[26]) ? implode(' ', $arr_vitri[26]) . ' cocau' : '' ?>'><?php echo $arr_matrix[26] ?></span>
                        <span id='vt_27' title='Vị trí: 27' class='vt <?php echo isset($arr_vitri[27]) ? implode(' ', $arr_vitri[27]) . ' cocau' : '' ?>'><?php echo $arr_matrix[27] ?></span>
                        <span id='vt_28' title='Vị trí: 28' class='vt <?php echo isset($arr_vitri[28]) ? implode(' ', $arr_vitri[28]) . ' cocau' : '' ?>'><?php echo $arr_matrix[28] ?></span>
                        <span id='vt_29' title='Vị trí: 29' class='vt <?php echo isset($arr_vitri[29]) ? implode(' ', $arr_vitri[29]) . ' cocau' : '' ?>'><?php echo $arr_matrix[29] ?></span>
                    </td>
                    <td colspan=4>
                        <span id='vt_30' title='Vị trí: 30' class='vt <?php echo isset($arr_vitri[30]) ? implode(' ', $arr_vitri[30]) . ' cocau' : '' ?>'><?php echo $arr_matrix[30] ?></span>
                        <span id='vt_31' title='Vị trí: 31' class='vt <?php echo isset($arr_vitri[31]) ? implode(' ', $arr_vitri[31]) . ' cocau' : '' ?>'><?php echo $arr_matrix[31] ?></span>
                        <span id='vt_32' title='Vị trí: 32' class='vt <?php echo isset($arr_vitri[32]) ? implode(' ', $arr_vitri[32]) . ' cocau' : '' ?>'><?php echo $arr_matrix[32] ?></span>
                        <span id='vt_33' title='Vị trí: 33' class='vt <?php echo isset($arr_vitri[33]) ? implode(' ', $arr_vitri[33]) . ' cocau' : '' ?>'><?php echo $arr_matrix[33] ?></span>
                        <span id='vt_34' title='Vị trí: 34' class='vt <?php echo isset($arr_vitri[34]) ? implode(' ', $arr_vitri[34]) . ' cocau' : '' ?>'><?php echo $arr_matrix[34] ?></span>
                    </td>
                </tr>
                <tr>
                    <td colspan=4>
                        <span id='vt_35' title='Vị trí: 35' class='vt <?php echo isset($arr_vitri[35]) ? implode(' ', $arr_vitri[35]) . ' cocau' : '' ?>'><?php echo $arr_matrix[35] ?></span>
                        <span id='vt_36' title='Vị trí: 36' class='vt <?php echo isset($arr_vitri[36]) ? implode(' ', $arr_vitri[36]) . ' cocau' : '' ?>'><?php echo $arr_matrix[36] ?></span>
                        <span id='vt_37' title='Vị trí: 37' class='vt <?php echo isset($arr_vitri[37]) ? implode(' ', $arr_vitri[37]) . ' cocau' : '' ?>'><?php echo $arr_matrix[37] ?></span>
                        <span id='vt_38' title='Vị trí: 38' class='vt <?php echo isset($arr_vitri[38]) ? implode(' ', $arr_vitri[38]) . ' cocau' : '' ?>'><?php echo $arr_matrix[38] ?></span>
                        <span id='vt_39' title='Vị trí: 39' class='vt <?php echo isset($arr_vitri[39]) ? implode(' ', $arr_vitri[39]) . ' cocau' : '' ?>'><?php echo $arr_matrix[39] ?></span>
                    </td>
                    <td colspan=4>
                        <span id='vt_40' title='Vị trí: 40' class='vt <?php echo isset($arr_vitri[40]) ? implode(' ', $arr_vitri[40]) . ' cocau' : '' ?>'><?php echo $arr_matrix[40] ?></span>
                        <span id='vt_41' title='Vị trí: 41' class='vt <?php echo isset($arr_vitri[41]) ? implode(' ', $arr_vitri[41]) . ' cocau' : '' ?>'><?php echo $arr_matrix[41] ?></span>
                        <span id='vt_42' title='Vị trí: 42' class='vt <?php echo isset($arr_vitri[42]) ? implode(' ', $arr_vitri[42]) . ' cocau' : '' ?>'><?php echo $arr_matrix[42] ?></span>
                        <span id='vt_43' title='Vị trí: 43' class='vt <?php echo isset($arr_vitri[43]) ? implode(' ', $arr_vitri[43]) . ' cocau' : '' ?>'><?php echo $arr_matrix[43] ?></span>
                        <span id='vt_44' title='Vị trí: 44' class='vt <?php echo isset($arr_vitri[44]) ? implode(' ', $arr_vitri[44]) . ' cocau' : '' ?>'><?php echo $arr_matrix[44] ?></span>
                    </td>
                    <td colspan=4>
                        <span id='vt_45' title='Vị trí: 45' class='vt <?php echo isset($arr_vitri[45]) ? implode(' ', $arr_vitri[45]) . ' cocau' : '' ?>'><?php echo $arr_matrix[45] ?></span>
                        <span id='vt_46' title='Vị trí: 46' class='vt <?php echo isset($arr_vitri[46]) ? implode(' ', $arr_vitri[46]) . ' cocau' : '' ?>'><?php echo $arr_matrix[46] ?></span>
                        <span id='vt_47' title='Vị trí: 47' class='vt <?php echo isset($arr_vitri[47]) ? implode(' ', $arr_vitri[47]) . ' cocau' : '' ?>'><?php echo $arr_matrix[47] ?></span>
                        <span id='vt_48' title='Vị trí: 48' class='vt <?php echo isset($arr_vitri[48]) ? implode(' ', $arr_vitri[48]) . ' cocau' : '' ?>'><?php echo $arr_matrix[48] ?></span>
                        <span id='vt_49' title='Vị trí: 49' class='vt <?php echo isset($arr_vitri[49]) ? implode(' ', $arr_vitri[49]) . ' cocau' : '' ?>'><?php echo $arr_matrix[49] ?></span>
                    </td>
                </tr>
                <tr>
                    <td class=leftcol>Giải Tư</td>
                    <td colspan=3>
                        <span id='vt_50' title='Vị trí: 50' class='vt <?php echo isset($arr_vitri[50]) ? implode(' ', $arr_vitri[50]) . ' cocau' : '' ?>'><?php echo $arr_matrix[50] ?></span>
                        <span id='vt_51' title='Vị trí: 51' class='vt <?php echo isset($arr_vitri[51]) ? implode(' ', $arr_vitri[51]) . ' cocau' : '' ?>'><?php echo $arr_matrix[51] ?></span>
                        <span id='vt_52' title='Vị trí: 52' class='vt <?php echo isset($arr_vitri[52]) ? implode(' ', $arr_vitri[52]) . ' cocau' : '' ?>'><?php echo $arr_matrix[52] ?></span>
                        <span id='vt_53' title='Vị trí: 53' class='vt <?php echo isset($arr_vitri[53]) ? implode(' ', $arr_vitri[53]) . ' cocau' : '' ?>'><?php echo $arr_matrix[53] ?></span>
                    </td>
                    <td colspan=3>
                        <span id='vt_54' title='Vị trí: 54' class='vt <?php echo isset($arr_vitri[54]) ? implode(' ', $arr_vitri[54]) . ' cocau' : '' ?>'><?php echo $arr_matrix[54] ?></span>
                        <span id='vt_55' title='Vị trí: 55' class='vt <?php echo isset($arr_vitri[55]) ? implode(' ', $arr_vitri[55]) . ' cocau' : '' ?>'><?php echo $arr_matrix[55] ?></span>
                        <span id='vt_56' title='Vị trí: 56' class='vt <?php echo isset($arr_vitri[56]) ? implode(' ', $arr_vitri[56]) . ' cocau' : '' ?>'><?php echo $arr_matrix[56] ?></span>
                        <span id='vt_57' title='Vị trí: 57' class='vt <?php echo isset($arr_vitri[57]) ? implode(' ', $arr_vitri[57]) . ' cocau' : '' ?>'><?php echo $arr_matrix[57] ?></span>
                    </td>
                    <td colspan=3>
                        <span id='vt_58' title='Vị trí: 58' class='vt <?php echo isset($arr_vitri[58]) ? implode(' ', $arr_vitri[58]) . ' cocau' : '' ?>'><?php echo $arr_matrix[58] ?></span>
                        <span id='vt_59' title='Vị trí: 59' class='vt <?php echo isset($arr_vitri[59]) ? implode(' ', $arr_vitri[59]) . ' cocau' : '' ?>'><?php echo $arr_matrix[59] ?></span>
                        <span id='vt_60' title='Vị trí: 60' class='vt <?php echo isset($arr_vitri[60]) ? implode(' ', $arr_vitri[60]) . ' cocau' : '' ?>'><?php echo $arr_matrix[60] ?></span>
                        <span id='vt_61' title='Vị trí: 61' class='vt <?php echo isset($arr_vitri[61]) ? implode(' ', $arr_vitri[61]) . ' cocau' : '' ?>'><?php echo $arr_matrix[61] ?></span>
                    </td>
                    <td colspan=3>
                        <span id='vt_62' title='Vị trí: 62' class='vt <?php echo isset($arr_vitri[62]) ? implode(' ', $arr_vitri[62]) . ' cocau' : '' ?>'><?php echo $arr_matrix[62] ?></span>
                        <span id='vt_63' title='Vị trí: 63' class='vt <?php echo isset($arr_vitri[63]) ? implode(' ', $arr_vitri[63]) . ' cocau' : '' ?>'><?php echo $arr_matrix[63] ?></span>
                        <span id='vt_64' title='Vị trí: 64' class='vt <?php echo isset($arr_vitri[64]) ? implode(' ', $arr_vitri[64]) . ' cocau' : '' ?>'><?php echo $arr_matrix[64] ?></span>
                        <span id='vt_65' title='Vị trí: 65' class='vt <?php echo isset($arr_vitri[65]) ? implode(' ', $arr_vitri[65]) . ' cocau' : '' ?>'><?php echo $arr_matrix[65] ?></span>
                    </td>
                </tr>
                <tr>
                    <td rowspan=2 class=leftcol>Giải Năm</td>
                    <td colspan=4>
                        <span id='vt_66' title='Vị trí: 66' class='vt <?php echo isset($arr_vitri[66]) ? implode(' ', $arr_vitri[66]) . ' cocau' : '' ?>'><?php echo $arr_matrix[66] ?></span>
                        <span id='vt_67' title='Vị trí: 67' class='vt <?php echo isset($arr_vitri[67]) ? implode(' ', $arr_vitri[67]) . ' cocau' : '' ?>'><?php echo $arr_matrix[67] ?></span>
                        <span id='vt_68' title='Vị trí: 68' class='vt <?php echo isset($arr_vitri[68]) ? implode(' ', $arr_vitri[68]) . ' cocau' : '' ?>'><?php echo $arr_matrix[68] ?></span>
                        <span id='vt_69' title='Vị trí: 69' class='vt <?php echo isset($arr_vitri[69]) ? implode(' ', $arr_vitri[69]) . ' cocau' : '' ?>'><?php echo $arr_matrix[69] ?></span>
                    </td>
                    <td colspan=4>
                        <span id='vt_70' title='Vị trí: 70' class='vt <?php echo isset($arr_vitri[70]) ? implode(' ', $arr_vitri[70]) . ' cocau' : '' ?>'><?php echo $arr_matrix[70] ?></span>
                        <span id='vt_71' title='Vị trí: 71' class='vt <?php echo isset($arr_vitri[71]) ? implode(' ', $arr_vitri[71]) . ' cocau' : '' ?>'><?php echo $arr_matrix[71] ?></span>
                        <span id='vt_72' title='Vị trí: 72' class='vt <?php echo isset($arr_vitri[72]) ? implode(' ', $arr_vitri[72]) . ' cocau' : '' ?>'><?php echo $arr_matrix[72] ?></span>
                        <span id='vt_73' title='Vị trí: 73' class='vt <?php echo isset($arr_vitri[73]) ? implode(' ', $arr_vitri[73]) . ' cocau' : '' ?>'><?php echo $arr_matrix[73] ?></span>
                    </td>
                    <td colspan=4>
                        <span id='vt_74' title='Vị trí: 74' class='vt <?php echo isset($arr_vitri[74]) ? implode(' ', $arr_vitri[74]) . ' cocau' : '' ?>'><?php echo $arr_matrix[74] ?></span>
                        <span id='vt_75' title='Vị trí: 75' class='vt <?php echo isset($arr_vitri[75]) ? implode(' ', $arr_vitri[75]) . ' cocau' : '' ?>'><?php echo $arr_matrix[75] ?></span>
                        <span id='vt_76' title='Vị trí: 76' class='vt <?php echo isset($arr_vitri[76]) ? implode(' ', $arr_vitri[76]) . ' cocau' : '' ?>'><?php echo $arr_matrix[76] ?></span>
                        <span id='vt_77' title='Vị trí: 77' class='vt <?php echo isset($arr_vitri[77]) ? implode(' ', $arr_vitri[77]) . ' cocau' : '' ?>'><?php echo $arr_matrix[77] ?></span>
                    </td>
                </tr>
                <tr>
                    <td colspan=4>
                        <span id='vt_78' title='Vị trí: 78' class='vt <?php echo isset($arr_vitri[78]) ? implode(' ', $arr_vitri[78]) . ' cocau' : '' ?>'><?php echo $arr_matrix[78] ?></span>
                        <span id='vt_79' title='Vị trí: 79' class='vt <?php echo isset($arr_vitri[79]) ? implode(' ', $arr_vitri[79]) . ' cocau' : '' ?>'><?php echo $arr_matrix[79] ?></span>
                        <span id='vt_80' title='Vị trí: 80' class='vt <?php echo isset($arr_vitri[80]) ? implode(' ', $arr_vitri[80]) . ' cocau' : '' ?>'><?php echo $arr_matrix[80] ?></span>
                        <span id='vt_81' title='Vị trí: 81' class='vt <?php echo isset($arr_vitri[81]) ? implode(' ', $arr_vitri[81]) . ' cocau' : '' ?>'><?php echo $arr_matrix[81] ?></span>
                    </td>
                    <td colspan=4>
                        <span id='vt_82' title='Vị trí: 82' class='vt <?php echo isset($arr_vitri[82]) ? implode(' ', $arr_vitri[82]) . ' cocau' : '' ?>'><?php echo $arr_matrix[82] ?></span>
                        <span id='vt_83' title='Vị trí: 83' class='vt <?php echo isset($arr_vitri[83]) ? implode(' ', $arr_vitri[83]) . ' cocau' : '' ?>'><?php echo $arr_matrix[83] ?></span>
                        <span id='vt_84' title='Vị trí: 84' class='vt <?php echo isset($arr_vitri[84]) ? implode(' ', $arr_vitri[84]) . ' cocau' : '' ?>'><?php echo $arr_matrix[84] ?></span>
                        <span id='vt_85' title='Vị trí: 85' class='vt <?php echo isset($arr_vitri[85]) ? implode(' ', $arr_vitri[85]) . ' cocau' : '' ?>'><?php echo $arr_matrix[85] ?></span>
                    </td>
                    <td colspan=4>
                        <span id='vt_86' title='Vị trí: 86' class='vt <?php echo isset($arr_vitri[86]) ? implode(' ', $arr_vitri[86]) . ' cocau' : '' ?>'><?php echo $arr_matrix[86] ?></span>
                        <span id='vt_87' title='Vị trí: 87' class='vt <?php echo isset($arr_vitri[87]) ? implode(' ', $arr_vitri[87]) . ' cocau' : '' ?>'><?php echo $arr_matrix[87] ?></span>
                        <span id='vt_88' title='Vị trí: 88' class='vt <?php echo isset($arr_vitri[88]) ? implode(' ', $arr_vitri[88]) . ' cocau' : '' ?>'><?php echo $arr_matrix[88] ?></span>
                        <span id='vt_89' title='Vị trí: 89' class='vt <?php echo isset($arr_vitri[89]) ? implode(' ', $arr_vitri[89]) . ' cocau' : '' ?>'><?php echo $arr_matrix[89] ?></span>
                    </td>
                </tr>
                <tr>
                    <td class=leftcol>Giải Sáu</td>
                    <td colspan=4>
                        <span id='vt_90' title='Vị trí: 90' class='vt <?php echo isset($arr_vitri[90]) ? implode(' ', $arr_vitri[90]) . ' cocau' : '' ?>'><?php echo $arr_matrix[90] ?></span>
                        <span id='vt_91' title='Vị trí: 91' class='vt <?php echo isset($arr_vitri[91]) ? implode(' ', $arr_vitri[91]) . ' cocau' : '' ?>'><?php echo $arr_matrix[91] ?></span>
                        <span id='vt_92' title='Vị trí: 92' class='vt <?php echo isset($arr_vitri[92]) ? implode(' ', $arr_vitri[92]) . ' cocau' : '' ?>'><?php echo $arr_matrix[92] ?></span>
                    </td>
                    <td colspan=4>
                        <span id='vt_93' title='Vị trí: 93' class='vt <?php echo isset($arr_vitri[93]) ? implode(' ', $arr_vitri[93]) . ' cocau' : '' ?>'><?php echo $arr_matrix[93] ?></span>
                        <span id='vt_94' title='Vị trí: 94' class='vt <?php echo isset($arr_vitri[94]) ? implode(' ', $arr_vitri[94]) . ' cocau' : '' ?>'><?php echo $arr_matrix[94] ?></span>
                        <span id='vt_95' title='Vị trí: 95' class='vt <?php echo isset($arr_vitri[95]) ? implode(' ', $arr_vitri[95]) . ' cocau' : '' ?>'><?php echo $arr_matrix[95] ?></span>
                    </td>
                    <td colspan=4>
                        <span id='vt_96' title='Vị trí: 96' class='vt <?php echo isset($arr_vitri[96]) ? implode(' ', $arr_vitri[96]) . ' cocau' : '' ?>'><?php echo $arr_matrix[96] ?></span>
                        <span id='vt_97' title='Vị trí: 97' class='vt <?php echo isset($arr_vitri[97]) ? implode(' ', $arr_vitri[97]) . ' cocau' : '' ?>'><?php echo $arr_matrix[97] ?></span>
                        <span id='vt_98' title='Vị trí: 98' class='vt <?php echo isset($arr_vitri[98]) ? implode(' ', $arr_vitri[98]) . ' cocau' : '' ?>'><?php echo $arr_matrix[98] ?></span>
                    </td>
                </tr>
                <tr>
                    <td class=leftcol>Giải Bảy</td>
                    <td colspan=3>
                        <span id='vt_99' title='Vị trí: 99' class='vt <?php echo isset($arr_vitri[99]) ? implode(' ', $arr_vitri[99]) . ' cocau' : '' ?>'><?php echo $arr_matrix[99] ?></span>
                        <span id='vt_100' title='Vị trí: 100' class='vt <?php echo isset($arr_vitri[100]) ? implode(' ', $arr_vitri[100]) . ' cocau' : '' ?>'><?php echo $arr_matrix[100] ?></span>
                    </td>
                    <td colspan=3>
                        <span id='vt_101' title='Vị trí: 101' class='vt <?php echo isset($arr_vitri[101]) ? implode(' ', $arr_vitri[101]) . ' cocau' : '' ?>'><?php echo $arr_matrix[101] ?></span>
                        <span id='vt_102' title='Vị trí: 102' class='vt <?php echo isset($arr_vitri[102]) ? implode(' ', $arr_vitri[102]) . ' cocau' : '' ?>'><?php echo $arr_matrix[102] ?></span>
                    </td>
                    <td colspan=3>
                        <span id='vt_103' title='Vị trí: 103' class='vt <?php echo isset($arr_vitri[103]) ? implode(' ', $arr_vitri[103]) . ' cocau' : '' ?>'><?php echo $arr_matrix[103] ?></span>
                        <span id='vt_104' title='Vị trí: 104' class='vt <?php echo isset($arr_vitri[104]) ? implode(' ', $arr_vitri[104]) . ' cocau' : '' ?>'><?php echo $arr_matrix[104] ?></span>
                    </td>
                    <td colspan=3>
                        <span id='vt_105' title='Vị trí: 105' class='vt <?php echo isset($arr_vitri[105]) ? implode(' ', $arr_vitri[105]) . ' cocau' : '' ?>'><?php echo $arr_matrix[105] ?></span>
                        <span id='vt_106' title='Vị trí: 106' class='vt <?php echo isset($arr_vitri[106]) ? implode(' ', $arr_vitri[106]) . ' cocau' : '' ?>'><?php echo $arr_matrix[106] ?></span>
                    </td>
                </tr>
                <tr class=lastrow><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
            </table>
            <ul>
                <li>Các số màu đậm là các vị trí có cầu.</li>
                <li>Bấm vào một vị trí có cầu, sẽ biết (các) vị trí tạo cầu với nó (màu tím).</li>
                <li>Bấm vào số màu tím để xem cầu.</li>
            </ul>
        </div>

        <div style='margin:15px 0'><a class=a_button_light href='javascript:;' onclick='matrancaudlg("matrix<?php echo str_replace('-', '', $ngay) ?>"); return false' title='Xem phân bố vị trí của cầu trên bảng kết quả'>Ma trận cầu</a></div>
    </div>

    <div class="contentbox">
        <div class="contentbox_header">
            <div style='color:#4F4F4F'>Kết quả soi cầu ngày <?php echo str_replace('-', '/', $ngay) ?> tìm được <span style='color:#9B021D'><?php echo count($data_limit) ?></span> cầu có độ dài <?php echo $exactlimit == 1 ? '=' : '>=' ?> <?php echo $limit ?> ngày<?php echo $limit == $max_cau ? ' (max)' : '' ?>:</div>
        </div>
        <div class="contentbox_body">
            <?php echo $str_list_cau ?>
            <?php if ($data_nextlimit && $exactlimit == 0) { ?><div style='color:#069; margin-top:10px'>Trong đó có <b><?php echo count($data_nextlimit) ?></b> cầu dài trên <?php echo $limit ?> ngày (màu nền đậm)</div><?php } ?>
            <?php if (count($list_cau) > 1) { ?><div style='color:#069; margin-top:5px'>Cầu xuất hiện tại <b><?php echo count($list_cau) ?></b> cặp số khác nhau<?php if ($limit < $max_cau && $exactlimit == 0) { ?>, trong đó có <b><?php echo $cap_nextlimit ?></b> cặp số có cầu chạy hơn <?php echo $limit ?> ngày<?php } ?>.</div><?php } ?>
            <?php if ($top_cau['cau'] > 1) { ?>
                <div style='padding:5px 0; font-size:17px; color:#008000'>Cặp số có nhiều cầu nhất là <?php echo $top_cau['so'] ?>: <?php echo $top_cau['cau'] ?> cầu (<?php echo $top_cau['cau'] ?> vị trí cầu khác nhau đều báo <?php echo $db == 0 ? 'lô' : 'đề' ?> về <?php echo str_replace(',', ' hoặc ', $top_cau['so']) ?>)</div>
            </div>
        </div>

        <div class="contentbox">
            <div class="contentbox_header">
                <div>Thống kê cầu lặp: </div>
            </div>
            <?php
            echo '<div class="contentbox_body">';
            $dem = 1;
            foreach ($list_cau as $value) {
                if ($dem == 1 || $dem % 10 == 1)
                    echo '<table class=tbl1 cellspacing=1 cellpadding=4>';
                echo '<tr><td class=col1>' . $value['so'] . '</td><td class=col2>' . $value['cau'] . ' cầu</td></tr>';
                if ($dem % 10 == 0)
                    echo '</table>';
                $dem++;
            }
            if (($dem - 1) % 10 != 0)
                echo '</table>';
            echo '</div>';
        }else {
            echo '</div>';
        }
        ?>
    </div>
    <div style='clear:both'></div>
    <script type="text/javascript" src="<?php echo js_link('soicau.js') ?>"></script>
    <script type="text/javascript">/*<![CDATA[*/$("#ngay").datepick({dateFormat:"dd-mm-yyyy",maxDate:+0,onSelect:function(){}});/*]]>*/</script>
    <script type="text/javascript">
        function cauclick(a){
            $('a.a_cau.a_cau_active').removeClass('a_cau_active');
            $(a).addClass('a_cau_active');
            href=$(a).attr('href');
            href=href.split("vt=");
            vt=href[href.length-1];
            showcau(vt,'<?php echo $ngay ?>','<?php echo $limit ?>','<?php echo $lon ?>','<?php echo $db ?>','<?php echo $nhay ?>');
        }
        $("span.cocau").click(function(){
            if($(this).hasClass("vt_selecting")){
                vt_unselect();
            }else if($(this).hasClass("vt_connect")){
                var vt1=$("span.vt_selecting").attr("id");
                vt1=vt1.split("_");
                vt1=vt1[1];
                var vt2=$(this).attr("id");
                vt2=vt2.split("_");
                vt2=vt2[1];
                $("span.vt_connect_click").removeClass("vt_connect_click");
                $(this).addClass("vt_connect_click");
                cau_link_set_active(vt1+'x'+vt2)
                $('a.a_cau[title$="'+vt2+'x'+vt1+'"]').addClass('a_cau_active');		
                showcau(vt1+"x"+vt2,'<?php echo $ngay ?>','<?php echo $limit ?>','<?php echo $lon ?>','<?php echo $db ?>','<?php echo $nhay ?>');
            }else{
                var id=$(this).attr('id');
                vt_unselect();
                $(this).addClass('vt_selecting');
                $("span.cocau").each(function(i,el){
                    if($(el).hasClass(id))
                        $(el).addClass('vt_connect');
                });
            }
        });
        showcaufromhash();
    </script>
</div>