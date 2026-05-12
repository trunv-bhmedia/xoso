<div class="box-tt clearfix">
    <strong class="strong-tt">Trực tiếp kết quả Xổ Số Miền Bắc<br />
        Nhận kết quả nhanh siêu tốc</strong>
    <div class="box-editor">Soạn <strong class="red">TT MB</strong> gửi <strong class="red">8517</strong></div>
</div>
<?php
$days = array(
    '0' => 'Chủ nhật',
    '1' => 'Thứ 2',
    '2' => 'Thứ 3',
    '3' => 'Thứ 4',
    '4' => 'Thứ 5',
    '5' => 'Thứ 6',
    '6' => 'Thứ 7'
);

if ($xoso['MB_NEW']) {
    $v = $xoso['MB_NEW']->MB;
    $date = date('d/m/Y', strtotime($xoso['MB_NEW']->date));
    $datew = $days[date('w', strtotime($xoso['MB_NEW']->date))];
} else {
    $v = $xoso['MB'][0];
    $date = $v->date;
    $datew = $v->dateOfWeek;
    $v->data[0] = $v->a0;
    $v->extra = json_decode($v->extension);
}
?>
<div class="block_db block_xsmb">
    <div class="block_db_title clearfix">
        <h2>XỔ SỐ MIỀN BẮC - <?php echo $date ?></h2>
        <a class="right" href="<?php echo $uri_root . $v->alias ?>.html">Xem kết quả chi tiết</a>
    </div>
    <div class="block_db_content">
        <div class="title_db">Giải đặc biệt</div>
        <div class="giaidacbiet"><?php echo $v->data[0] ?></div>
    </div>
    <div class="block_db_footer">
        <a class="left" href="<?php echo $uri_root . $v->alias ?>.html">Xem kết quả chi tiết</a>
        <span class="left">&nbsp;</span>
        <a href="javascript:;" onclick="showPopup('#loto-xsmb');">Loto</a>
        <a href="javascript:;" onclick="showPopup('#xsdt-block');">Xổ Số Điện Toán</a>
    </div>
</div>
<div id="xsdt-block" style="display:none">
    <div class="box-result">
        <div class="bg-yelow1"><strong class="txt-red"><h2>Xổ Số Điện Toán</h2></strong></div>
        <?php
        $DT6x36_time = strtotime($xsdt['DT6x36']->date);
        $DT123_time = strtotime($xsdt['DT123']->date);
        $TT_time = strtotime($xsdt['TT']->date);
        ?>
        <table class="tbl-result">
            <tr>
                <td class="bg-gray first">
                    <strong class="left">Kết quả xổ số điện toán 6x36</strong>
                    <span class="right">Mở thưởng <?php echo $days[date('w', $DT6x36_time)] ?> ngày <?php echo(date('d/m/Y', $DT6x36_time)); ?></span>

                </td>
            </tr>
            <tr>
                <td class="td-sub">
                    <table>
                        <tr>
                            <?php foreach (json_decode($xsdt['DT6x36']->data) as $value) { ?>
                                <td class="red font24 t-cen"><strong><?php echo $value ?></strong></td>
                            <?php } ?>
                            <td class="t-right"><a class="read-more" href="<?php echo $uri_root ?>xo-so-dien-toan/6X36/<?php echo (date('d-m-Y', $DT6x36_time)); ?>.html"><span>Xem thêm</span></a></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="bg-gray first">
                    <strong class="left">Kết quả xổ số điện toán 1*2*3</strong>
                    <span class="right">Mở thưởng <?php echo $days[date('w', $DT123_time)] ?> ngày <?php echo(date('d/m/Y', $DT123_time)); ?></span>
                </td>
            </tr>
            <tr>
                <td class="td-sub">
                    <table class="tbl-sub">
                        <tr>
                            <?php foreach (json_decode($xsdt['DT123']->data) as $value) { ?>
                                <td class="red font24 t-cen"><strong><?php echo $value ?></strong></td>
                            <?php } ?>
                            <td class="t-right"><a class="read-more" href="<?php echo $uri_root ?>xo-so-dien-toan/1*2*3/<?php echo (date('d-m-Y', $DT123_time)); ?>.html"><span>Xem thêm</span></a></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="bg-gray first">
                    <strong class="left">Kết quả xổ số Thần tài</strong>
                    <span class="right">Mở thưởng <?php echo $days[date('w', $TT_time)] ?> ngày <?php echo(date('d/m/Y', $TT_time)); ?></span>
                </td>
            </tr>
            <tr>
                <td class="td-sub">
                    <table class="tbl-sub">
                        <tr>
                            <?php foreach (json_decode($xsdt['TT']->data) as $value) { ?>
                                <td class="red font24 t-cen"><strong><?php echo $value ?></strong></td>
                            <?php } ?>
                            <td class="t-right"><a class="read-more" href="<?php echo $uri_root ?>xo-so-dien-toan/than-tai/<?php echo (date('d-m-Y', $TT_time)); ?>.html"><span>Xem thêm</span></a></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <div class="line-red">&nbsp;</div>
</div>
<div id="loto-xsmb" style="display:none">
    <div class="box-result">
        <div class="bg-yelow1"><strong class="txt-red">Loto Miền Bắc - <?php echo $datew ?> ngày <?php echo $date ?></strong></div>
        <table class="tbl-tt">
            <tr>
                <td class="bg-gray border-right t-cen"><strong>Đầu</strong></td>
                <td class="bg-gray border-right t-cen"><strong>Đuôi</strong></td>
                <td class="bg-gray border-right t-cen"><strong>Đầu</strong></td>
                <td class="bg-gray t-cen"><strong>Đuôi</strong></td>
            </tr>
            <tr>
                <td class="border-right t-cen"><span class="red">0</span></td>
                <td class="border-right t-cen"><?php echo $v->extra[0] ?></td>
                <td class="border-right t-cen"><span class="red">5</span></td>
                <td class="t-cen"><?php echo $v->extra[5] ?></td>
            </tr>
            <tr>
                <td class="bg-gray border-right t-cen"><span class="red">1</span></td>
                <td class="bg-gray border-right t-cen"><?php echo $v->extra[1] ?></td>
                <td class="bg-gray border-right t-cen"><span class="red">6</span></td>
                <td class="bg-gray t-cen"><?php echo $v->extra[6] ?></td>
            </tr>
            <tr>
                <td class="border-right t-cen"><span class="red">2</span></td>
                <td class="border-right t-cen"><?php echo $v->extra[2] ?></td>
                <td class="border-right t-cen"><span class="red">7</span></td>
                <td class="t-cen"><?php echo $v->extra[7] ?></td>
            </tr>
            <tr>
                <td class="bg-gray border-right t-cen"><span class="red">3</span></td>
                <td class="bg-gray border-right t-cen"><?php echo $v->extra[3] ?></td>
                <td class="bg-gray border-right t-cen"><span class="red">8</span></td>
                <td class="bg-gray t-cen"><?php echo $v->extra[8] ?></td>
            </tr>
            <tr>
                <td class="border-right t-cen"><span class="red">4</span></td>
                <td class="border-right t-cen"><?php echo $v->extra[4] ?></td>
                <td class="border-right t-cen"><span class="red">9</span></td>
                <td class="t-cen"><?php echo $v->extra[9] ?></td>
            </tr>
        </table>
    </div>
    <div class="line-red">&nbsp;</div>
</div>

<?php
$xsmn = array();
$loto_tinh = '';
$loto_title = '';
$loto_arr = array();
if ($xoso['MN_NEW']) {
    $date = date('d/m/Y', strtotime($xoso['MN_NEW']->date));
    $datew = $days[date('w', strtotime($xoso['MN_NEW']->date))];
    foreach ($xoso['MN_NEW'] as $value) {
        if (isset($value->name)) {
            $xsmn[$value->alias]->name = $value->name;
            $xsmn[$value->alias]->data = $value->data[0];

            $loto_tinh .= '<td colspan="2" class="bg-gray border-right t-cen"><strong>' . $value->name . '</strong></td>';
            $loto_title .='<td class="border-right t-cen"><span>Đầu</span></td><td class="border-right t-cen"><span>Đuôi</span></td>';

            $extra = $value->extra;
            foreach ($extra as $k => $v) {
                $class = '';
                if ($k % 2 == 0)
                    $class = 'bg-gray ';
                $loto_arr[$k] .= '<td class="' . $class . 'border-right t-cen"><span class="red">' . $k . '</span></td><td class="' . $class . 'border-right t-cen">' . $v . '</td>';
            }
        }
    }
} else {
    $v = $xoso['MN'][0];
    $date = $v->date;
    $datew = $v->dateOfWeek;
    foreach ($xoso['MN'] as $value) {
        $xsmn[$value->alias]->name = $value->name;
        $xsmn[$value->alias]->data = $value->a0;

        $loto_tinh .= '<td colspan="2" class="bg-gray border-right t-cen"><strong>' . $value->name . '</strong></td>';
        $loto_title .='<td class="border-right t-cen"><span>Đầu</span></td><td class="border-right t-cen"><span>Đuôi</span></td>';

        $extra = json_decode($value->extension);
        foreach ($extra as $k => $v) {
            $class = '';
            if ($k % 2 == 0)
                $class = 'bg-gray ';
            $loto_arr[$k] .= '<td class="' . $class . 'border-right t-cen"><span class="red">' . $k . '</span></td><td class="' . $class . 'border-right t-cen">' . $v . '</td>';
        }
    }
}
?>
<div class="block_db block_xsmn">
    <div class="block_db_title clearfix">
        <h2>XỔ SỐ MIỀN NAM - <?php echo $date ?></h2>
        <a class="right" href="<?php echo $uri_root ?>xoso-mien-nam.html">Xem kết quả chi tiết</a>
    </div>
    <div class="block_db_content">
        <ul class="list-tinh">
            <?php
            foreach ($xsmn as $alias => $value) {
                $width = 'w188';
                if (count($xsmn) == 2)
                    $width = 'w282';
                elseif (count($xsmn) == 4)
                    $width = 'w141';
                ?>
                <li class="<?php echo $width ?>">
                    <div>
                        <a href="<?php echo $uri_root . $alias ?>.html"><?php echo $value->name ?></a>
                        <div class="title_db">Giải đặc biệt</div>
                        <div class="giaidacbiet"><?php echo $value->data ?></div>
                    </div>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
    <div class="block_db_footer">
        <a class="left" href="<?php echo $uri_root ?>xoso-mien-nam.html">Xem kết quả chi tiết</a>
        <span class="left">&nbsp;</span>
        <a href="javascript:;" onclick="showPopup('#loto-xsmn');">Loto</a>
        <a href="javascript:;" onclick="showPopup('#xsmn-block');">Mở thưởng hôm nay</a>        
    </div>
</div>
<div id="xsmn-block" style="display:none">
    <div class="box-result">
        <div class="bg-yelow1">
            <div class="title-right clearfix">
                <strong class="left txt-red">KẾT QUẢ XỔ SỐ MIỀN NAM</strong>
                <span class="right txt-red">Mở thưởng hôm nay lúc <strong><?php echo date('h:i A', strtotime($location_today['MN'][0]->time)) ?></strong></span>
            </div>
        </div>
        <div class="box-gray spacenone">
            <ul class="list-pro">
                <?php
                foreach ($location_today['MN'] as $value) {
                    echo '<li><a href="' . $uri_root . $value->alias . '.html"><span>' . $value->name . '</span></a></li>';
                }
                ?>
            </ul>
            <ul class="list-editor">
                <?php
                foreach ($location_today['MN'] as $value) {
                    echo '<li>Để nhận kết quả xổ số <strong>' . $value->name . '</strong> sớm nhất, soạn tin <span>KQ ' . $value->code . '</span> gửi <span>8117</span></li>';
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="line-red">&nbsp;</div>
</div>
<div id="loto-xsmn" style="display:none">
    <div class="box-result">
        <div class="bg-yelow1"><strong class="txt-red">Loto Miền Nam - <?php echo $datew ?> ngày <?php echo $date ?></strong></div>
        <table class="tbl-tt">
            <tr><?php echo $loto_tinh ?></tr>
            <tr><?php echo $loto_title ?></tr>
            <tr><?php echo $loto_arr[0] ?></tr>
            <tr><?php echo $loto_arr[1] ?></tr>
            <tr><?php echo $loto_arr[2] ?></tr>
            <tr><?php echo $loto_arr[3] ?></tr>
            <tr><?php echo $loto_arr[4] ?></tr>
            <tr><?php echo $loto_arr[5] ?></tr>
            <tr><?php echo $loto_arr[6] ?></tr>
            <tr><?php echo $loto_arr[7] ?></tr>
            <tr><?php echo $loto_arr[8] ?></tr>
            <tr><?php echo $loto_arr[9] ?></tr>
        </table>
    </div>
    <div class="line-red">&nbsp;</div>
</div>

<?php
$xsmt = array();
$loto_tinh = '';
$loto_title = '';
$loto_arr = array();
if ($xoso['MT_NEW']) {
    $date = date('d/m/Y', strtotime($xoso['MT_NEW']->date));
    $datew = $days[date('w', strtotime($xoso['MN_NEW']->date))];
    foreach ($xoso['MT_NEW'] as $value) {
        if (isset($value->name)) {
            $xsmt[$value->alias]->name = $value->name;
            $xsmt[$value->alias]->data = $value->data[0];

            $loto_tinh .= '<td colspan="2" class="bg-gray border-right t-cen"><strong>' . $value->name . '</strong></td>';
            $loto_title .='<td class="border-right t-cen"><span>Đầu</span></td><td class="border-right t-cen"><span>Đuôi</span></td>';

            $extra = $value->extra;
            foreach ($extra as $k => $v) {
                $class = '';
                if ($k % 2 == 0)
                    $class = 'bg-gray ';
                $loto_arr[$k] .= '<td class="' . $class . 'border-right t-cen"><span class="red">' . $k . '</span></td><td class="' . $class . 'border-right t-cen">' . $v . '</td>';
            }
        }
    }
} else {
    $v = $xoso['MT'][0];
    $date = $v->date;
    $datew = $v->dateOfWeek;
    foreach ($xoso['MT'] as $value) {
        $xsmt[$value->alias]->name = $value->name;
        $xsmt[$value->alias]->data = $value->a0;

        $loto_tinh .= '<td colspan="2" class="bg-gray border-right t-cen"><strong>' . $value->name . '</strong></td>';
        $loto_title .='<td class="border-right t-cen"><span>Đầu</span></td><td class="border-right t-cen"><span>Đuôi</span></td>';

        $extra = json_decode($value->extension);
        foreach ($extra as $k => $v) {
            $class = '';
            if ($k % 2 == 0)
                $class = 'bg-gray ';
            $loto_arr[$k] .= '<td class="' . $class . 'border-right t-cen"><span class="red">' . $k . '</span></td><td class="' . $class . 'border-right t-cen">' . $v . '</td>';
        }
    }
}
?>
<div class="block_db block_xsmt">
    <div class="block_db_title clearfix">
        <h2>XỔ SỐ MIỀN TRUNG - <?php echo $date ?></h2>
        <a class="right" href="<?php echo $uri_root ?>xoso-mien-trung.html">Xem kết quả chi tiết</a>
    </div>
    <div class="block_db_content">
        <ul class="list-tinh">
            <?php
            foreach ($xsmt as $alias => $value) {
                $width = 'w188';
                if (count($xsmt) == 2)
                    $width = 'w282';
                elseif (count($xsmt) == 4)
                    $width = 'w141';
                ?>
                <li class="<?php echo $width ?>">
                    <div>
                        <a href="<?php echo $uri_root . $alias ?>.html"><?php echo $value->name ?></a>
                        <div class="title_db">Giải đặc biệt</div>
                        <div class="giaidacbiet"><?php echo $value->data ?></div>
                    </div>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
    <div class="block_db_footer">
        <a class="left" href="<?php echo $uri_root ?>xoso-mien-trung.html">Xem kết quả chi tiết</a>
        <span class="left">&nbsp;</span>
        <a href="javascript:;" onclick="showPopup('#loto-xsmt');">Loto</a>
        <a href="javascript:;" onclick="showPopup('#xsmt-block');">Mở thưởng hôm nay</a>
    </div>
</div>
<div id="xsmt-block" style="display:none">
    <div class="box-result">
        <div class="bg-yelow1">
            <div class="title-right clearfix">
                <strong class="left txt-red">KẾT QUẢ XỔ SỐ MIỀN TRUNG</strong>
                <span class="right txt-red">Mở thưởng hôm nay lúc <strong><?php echo date('h:i A', strtotime($location_today['MT'][0]->time)) ?></strong></span>
            </div>
        </div>
        <div class="box-gray spacenone">
            <ul class="list-pro">
                <?php
                foreach ($location_today['MT'] as $value) {
                    echo '<li><a href="' . $uri_root . $value->alias . '.html"><span>' . $value->name . '</span></a></li>';
                }
                ?>
            </ul>
            <ul class="list-editor">
                <?php
                foreach ($location_today['MT'] as $value) {
                    echo '<li>Để nhận kết quả xổ số <strong>' . $value->name . '</strong> sớm nhất, soạn tin <span>KQ ' . $value->code . '</span> gửi <span>8117</span></li>';
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="line-red">&nbsp;</div>
</div>
<div id="loto-xsmt" style="display:none">
    <div class="box-result">
        <div class="bg-yelow1"><strong class="txt-red">Loto Miền Trung - <?php echo $datew ?> ngày <?php echo $date ?></strong></div>
        <table class="tbl-tt">
            <tr><?php echo $loto_tinh ?></tr>
            <tr><?php echo $loto_title ?></tr>
            <tr><?php echo $loto_arr[0] ?></tr>
            <tr><?php echo $loto_arr[1] ?></tr>
            <tr><?php echo $loto_arr[2] ?></tr>
            <tr><?php echo $loto_arr[3] ?></tr>
            <tr><?php echo $loto_arr[4] ?></tr>
            <tr><?php echo $loto_arr[5] ?></tr>
            <tr><?php echo $loto_arr[6] ?></tr>
            <tr><?php echo $loto_arr[7] ?></tr>
            <tr><?php echo $loto_arr[8] ?></tr>
            <tr><?php echo $loto_arr[9] ?></tr>
        </table>
    </div>
    <div class="line-red">&nbsp;</div>
</div>
<br/>
<div id='div-gpt-ad-1378288615889-1' style='width:336px' class="mainmenu">
    <script type='text/javascript'>
        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1378288615889-1'); });
    </script>
</div>
<br/>
<div class="box-result background-none">
    <table class="tbl-tt tbl-rate">
        <tr>
            <th class="border-right th-rate"><strong>Thống kê quan trọng</strong></th>
            <th class="border-right th-rate"><strong>Thống kê tần suất xổ số</strong></th>
            <th class="border-right th-rate"><strong>Gan cực đại</strong></th>
            <th class="th-rate"><strong>Thống kê Loto</strong></th>
        </tr>
        <tr>
            <td class="border-right"><a href="<?php echo $uri_root ?>thong-ke-quan-trong.html">Miền Bắc</a></td>
            <td class="border-right"><a href="<?php echo $uri_root ?>thong-ke-cap-so-tu-00-99.html">Miền Bắc</a></td>
            <td class="border-right"><a href="<?php echo $uri_root ?>thong-ke-lo-gan.html">Miền Bắc</a></td>
            <td class=""><a href="<?php echo $uri_root ?>thong-ke-lo-to-tinh.html">Miền Bắc</a></td>
        </tr>
        <tr>
            <td class="bg-gray border-right"><strong>Miền Trung</strong></td>
            <td class="bg-gray border-right">&nbsp;</td>
            <td class="bg-gray border-right">&nbsp;</td>
            <td class="bg-gray">&nbsp;</td>
        </tr>
        <?php foreach ($location_today['MT'] as $value) { ?>
            <tr>
                <td class="border-right"><a href="<?php echo $uri_root ?>thong-ke-quan-trong-<?php echo $value->alias ?>.html"><?php echo $value->name ?></a></td>
                <td class="border-right"><a href="<?php echo $uri_root ?>thong-ke-cap-so-tu-00-99-<?php echo $value->alias ?>.html"><?php echo $value->name ?></a></td>
                <td class="border-right"><a href="<?php echo $uri_root ?>thong-ke-lo-gan-<?php echo $value->alias ?>.html"><?php echo $value->name ?></a></td>
                <td class=""><a href="<?php echo $uri_root ?>thong-ke-lo-to-tinh-<?php echo $value->alias ?>.html"><?php echo $value->name ?></a></td>
            </tr>
        <?php } ?>
        <tr>
            <td class="bg-gray border-right"><strong>Miền Nam</strong></td>
            <td class="bg-gray border-right">&nbsp;</td>
            <td class="bg-gray border-right">&nbsp;</td>
            <td class="bg-gray">&nbsp;</td>
        </tr>
        <?php foreach ($location_today['MN'] as $value) { ?>
            <tr>
                <td class="border-right"><a href="<?php echo $uri_root ?>thong-ke-quan-trong-<?php echo $value->alias ?>.html"><?php echo $value->name ?></a></td>
                <td class="border-right"><a href="<?php echo $uri_root ?>thong-ke-cap-so-tu-00-99-<?php echo $value->alias ?>.html"><?php echo $value->name ?></a></td>
                <td class="border-right"><a href="<?php echo $uri_root ?>thong-ke-lo-gan-<?php echo $value->alias ?>.html"><?php echo $value->name ?></a></td>
                <td class=""><a href="<?php echo $uri_root ?>thong-ke-lo-to-tinh-<?php echo $value->alias ?>.html"><?php echo $value->name ?></a></td>
            </tr>
        <?php } ?>
    </table>    
</div>
<div class="line-red">&nbsp;</div>
<?php
$db_dau = '';
$loto_dau = '';
foreach ($items['dau'] as $k => $v) {
    if ($k == 0) {
        $db_dau.='<tr>';
        $loto_dau.='<tr>';
    }
    if ($k == 5) {
        $db_dau.='</tr><tr>';
        $loto_dau.='</tr><tr>';
    }
    $db_dau.='<td><strong class="red">' . $k . '</strong> (' . $items['dau_dacbiet'][$k] . ' lượt)</td>';
    $loto_dau.='<td><strong class="red">' . $k . '</strong> (' . $v . ' lượt)</td>';
    if ($k == 9) {
        $db_dau.='</tr>';
        $loto_dau.='</tr>';
    }
}
$db_duoi = '';
$loto_duoi = '';
foreach ($items['duoi'] as $k => $v) {
    if ($k == 0) {
        $db_duoi.='<tr>';
        $loto_duoi.='<tr>';
    }
    if ($k == 5) {
        $db_duoi.='</tr><tr>';
        $loto_duoi.='</tr><tr>';
    }
    $db_duoi.='<td><strong class="red">' . $k . '</strong> (' . $items['duoi_dacbiet'][$k] . ' lượt)</td>';
    $loto_duoi.='<td><strong class="red">' . $k . '</strong> (' . $v . ' lượt)</td>';
    if ($k == 9) {
        $db_duoi.='</tr>';
        $loto_duoi.='</tr>';
    }
}
?>
<br/>
<div class="msg-block">Thống kê theo giải đặc biệt, tất cả các giải trong <strong>30 lần</strong> quay gần nhất của xổ số <strong><a href="<?php echo $uri_root ?>xo-so-mien-bac.html">MIỀN BẮC</a></strong>, tính đến kết quả trước <strong>ngày <?php echo date('d/m/Y'); ?></strong> theo đầu số, theo đuôi số, nhằm mục đích để người dùng có những nhận định xát sao hơn với những con số có thể xuất hiện trong những ngày tiếp theo, và khả năng không xuất hiện của những con số khác.</div>
<br/>
<div class="box-result">
    <div class="tk-d">THỐNG KÊ THEO GIẢI ĐẶC BIỆT TRONG 30 LẦN QUAY XỔ SỐ MIỀN BẮC</div>
    <div class="tk-h">Thống kê dưới đây được tính đến trước giờ kết quả ngày <?php echo date('d/m/Y'); ?></div>
    <table class="tbl-tt tbl-tt1">
        <tr>
            <td colspan="5" class="bg-gray"><strong>Thống kê theo đầu số</strong></td>
        </tr>
        <?php echo $db_dau ?>
        <tr>
            <td colspan="5" class="bg-gray"><strong>Thống kê theo đuôi số</strong></td>
        </tr>
        <?php echo $db_duoi ?>
    </table>
</div>
<div class="line-red mb10">&nbsp;</div>
<div class="box-result">
    <div class="tk-d">THỐNG KÊ LOTO TRONG 30 LẦN QUAY XỔ SỐ MIỀN BẮC</div>
    <div class="tk-h">Thống kê dưới đây được tính đến trước giờ kết quả ngày <?php echo date('d/m/Y'); ?></div>
    <table class="tbl-tt tbl-tt1">
        <tr>
            <td colspan="5" class="bg-gray"><strong>Thống kê theo đầu số</strong></td>
        </tr>
        <?php echo $loto_dau ?>
        <tr>
            <td colspan="5" class="bg-gray"><strong>Thống kê theo đuôi số</strong></td>
        </tr>
        <?php echo $loto_duoi ?>        
    </table>
</div>
<div class="line-red mb10">&nbsp;</div>
<?php $this->load->view($layout_sms); ?>