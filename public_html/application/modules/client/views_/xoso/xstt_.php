<?php
//$timer = '10:53:00';
$time = date('H:i');
$timer = date('H:i', strtotime($timer));
if ($time >= "12:00" && $time < $timer) {
    echo 1;
    die();
}

if (!$data) {
    echo 1;
    die();
}

$days = array(
    '0' => 'Chủ nhật',
    '1' => 'Thứ 2',
    '2' => 'Thứ 3',
    '3' => 'Thứ 4',
    '4' => 'Thứ 5',
    '5' => 'Thứ 6',
    '6' => 'Thứ 7'
);

switch ($area) {
    case 'MB':
        $l_area = 'Truyền thống';
        break;
    case 'MT':
        $l_area = 'Miền Trung';
        break;
    case 'MN':
        $l_area = 'Miền Nam';
        break;
}

if ($time < "12:00") {
    $date = date('d/m/Y', strtotime('-1 day'));
    $date_ve_do = date('d-m-Y', strtotime('-1 day'));
    $datew = date('w', strtotime('-1 day'));
} else {
    $date = date('d/m/Y');
    $date_ve_do = date('d-m-Y');
    $datew = date('w');
}

//$cols = $total_location;
$cols = count(get_object_vars($data));
$check = true;

if ($area == 'MB') {
    if ($xsdt['DT6x36'])
        $DT6x36_time = strtotime($xsdt['DT6x36']->date);
    if ($xsdt['DT123'])
        $DT123_time = strtotime($xsdt['DT123']->date);
    if ($xsdt['TT'])
        $TT_time = strtotime($xsdt['TT']->date);
    ?>
    <div class="title title-red">
        <div class="title-right">TRỰC TIẾP XỔ SỐ ĐIỆN TOÁN - <?php echo $date; ?></div>
    </div>
    <div class="box-result">
        <table class="tbl-result">
            <?php if ($xsdt['DT6x36']) { ?>
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
                                <td class="t-right"><a href="<?php echo $uri_root ?>xo-so-dien-toan/6X36/<?php echo (date('d-m-Y', $DT6x36_time)); ?>.html" class="read-more"><span>Xem thêm</span></a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            <?php } ?>
            <?php if ($xsdt['DT123']) { ?>
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
                                <td class="t-right"><a href="<?php echo $uri_root ?>xo-so-dien-toan/1*2*3/<?php echo (date('d-m-Y', $DT123_time)); ?>.html" class="read-more"><span>Xem thêm</span></a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            <?php } ?>
            <?php if ($xsdt['TT']) { ?>
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
                                <td class="t-right"><a href="<?php echo $uri_root ?>xo-so-dien-toan/than-tai/<?php echo (date('d-m-Y', $TT_time)); ?>.html" class="read-more"><span>Xem thêm</span></a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <div class="line-red mb10">&nbsp;</div>

    <?php
    foreach ($data as $k => $v):
        if ($v->status == 0)
            $check = false;
        ?>
        <div class="title title-red">
            <div class="title-right clearfix"><strong class="left">TRỰC TIẾP XỔ SỐ <?php echo ($l_area); ?> - <?php echo $date; ?></strong>
                <a href="<?php echo $uri_root . $v->alias; ?>.html" class="right view-table">Xem chi tiết <span>&nbsp;</span></a>
            </div>
        </div>
        <div class="box-result">
            <div class="page-title">Xổ Số <?php echo $v->name; ?> - <?php echo($days[$datew]); ?> ngày <?php echo $date; ?></div>
            <table class="tbl-tt">
                <tr>
                    <td class="bg-gray border-right">Giải đặc biệt</td>
                    <td class="bg-gray border-right giaidb">
                        <?php
                        $str = str_replace('*****', '<img src="' . img_link('icon-xs/loading.gif') . '" width="40" alt="" height="10" />', $v->data[0]);
                        echo '<strong class="red font18 span-space">' . $str . '</strong>';
                        ?>
                    </td>
                    <td rowspan="8" class="td-sub">
                        <table class="tbl-dd">
                            <tr>
                                <th class="first">Đầu</th>
                                <th class="last">Đuôi</th>
                            </tr>
                            <?php foreach ($v->extra as $k1 => $v1): ?>
                                <tr>
                                    <td class="first"><?php echo $k1 ?></td>
                                    <td class="<?php echo($k1 == 9 ? 'last' : ''); ?>"><?php echo $v1; ?></td>
                                </tr>
                            <?php endforeach; ?>						
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="border-right">Giải nhất</td>
                    <td class="border-right giai1">
                        <?php
                        $str = str_replace('*****', '<img src="' . img_link('icon-xs/loading.gif') . '" width="40" alt="" height="10" />', $v->data[1]);
                        echo '<strong class="span-space">' . $str . '</strong>';
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="bg-gray border-right">Giải nhì</td>
                    <td class="bg-gray border-right giai2">
                        <?php
                        $str = str_replace(array('-', '*****'), array('</strong><strong class="span-space">', '<img src="' . img_link('icon-xs/loading.gif') . '" width="40" alt="" height="10" />'), $v->data[2]);
                        echo '<strong class="span-space">' . $str . '</strong>';
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="border-right">Giải ba</td>
                    <td class="border-right giai3">
                        <?php
                        $str = str_replace(array('-', '*****'), array('</strong><strong class="span-space">', '<img src="' . img_link('icon-xs/loading.gif') . '" width="40" alt="" height="10" />'), $v->data[3]);
                        echo '<strong class="span-space">' . $str . '</strong>';
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="bg-gray border-right">Giải tư</td>
                    <td class="bg-gray border-right giai4">
                        <?php
                        $str = str_replace(array('-', '****'), array('</strong><strong class="span-space">', '<img src="' . img_link('icon-xs/loading.gif') . '" width="40" alt="" height="10" />'), $v->data[4]);
                        echo '<strong class="span-space">' . $str . '</strong>';
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="border-right">Giải năm</td>
                    <td class="border-right giai5">
                        <?php
                        $str = str_replace(array('-', '****'), array('</strong><strong class="span-space">', '<img src="' . img_link('icon-xs/loading.gif') . '" width="40" alt="" height="10" />'), $v->data[5]);
                        echo '<strong class="span-space">' . $str . '</strong>';
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="bg-gray border-right">Giải sáu</td>
                    <td class="bg-gray border-right giai6">
                        <?php
                        $str = str_replace(array('-', '***'), array('</strong><strong class="span-space">', '<img src="' . img_link('icon-xs/loading.gif') . '" width="40" alt="" height="10" />'), $v->data[6]);
                        echo '<strong class="span-space">' . $str . '</strong>';
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="border-right">Giải bảy</td>
                    <td class="border-right giai7">
                        <?php
                        $str = str_replace(array('-', '**'), array('</strong><strong class="span-space">', '<img src="' . img_link('icon-xs/loading.gif') . '" width="40" alt="" height="10" />'), $v->data[7]);
                        echo '<strong class="span-space">' . $str . '</strong>';
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    <?php endforeach; ?>

    <div class="line-red mb10">&nbsp;</div>
    <ul class="list-editor space1">
        <li>Để nhận kết quả xổ số <strong>Miền Bắc</strong> sớm nhất, soạn tin <span>KQ MB</span> gửi <span>8117</span></li>
    </ul>
    <div class="tabs-note space-pleft clearfix">
        <a class="span-in" target="_blank" href="<?php echo $uri_root ?>ve-do.html?l=1&amp;d=<?php echo $date_ve_do ?>&amp;t=2">In vé dò</a>
        <a class="span-dvo" href="<?php echo $uri_root ?>do-ve-so.html">Dò vé online</a>
        <a class="span-vs" href="<?php echo $uri_root ?>ve-so-mien-bac.html">Hình ảnh vé số </a>
        <a class="span-mvs" href="<?php echo $uri_root ?>mua-online.html">Mua online</a>
        <a class="span-tkxs" href="<?php echo $uri_root ?>thong-ke-quan-trong.html">Thống kê xổ số</a>
    </div>
    <?php foreach ($data as $k => $v) { ?>
        <div class="title title-red">
            <div class="title-right clearfix"><strong>Loto trực tiếp <?php echo ($v->name == '' ? 'Miền Bắc' : $v->name); ?></strong>
            </div>
        </div>
        <div class="box-result">
            <table class="tbl-tt">
                <?php
                $str = '';
                $l1 = 8;
                $l2 = 17;
                $l3 = 26;
                foreach ($v->data as $k1 => $v1) {
                    $str .=($str == '' ? '' : '-') . (str_replace(array(','), '-', $v1));
                }

                $arr = explode('-', $str);
                ?>
                <tr>
                    <?php for ($i = 0; $i <= $l1; $i++): ?>
                        <td class="<?php echo($i == $l1 ? 'last' : ''); ?>"><strong><?php echo substr($arr[$i], -2, 2); ?></strong></td>
                    <?php endfor; ?>							
                </tr>
                <tr>
                    <?php for ($i = ($l1 + 1); $i <= $l2; $i++): ?>
                        <td class="<?php echo($i == $l2 ? 'last' : ''); ?>"><strong><?php echo substr($arr[$i], -2, 2); ?></strong></td>
                    <?php endfor; ?>							
                </tr>
                <tr>
                    <?php for ($i = ($l2 + 1); $i <= $l3; $i++): ?>
                        <td class="<?php echo($i == $l3 ? 'last' : ''); ?>"><strong><?php echo substr($arr[$i], -2, 2); ?></strong></td>
                    <?php endfor; ?>							
                </tr>
            </table>
        </div>
        <?php
    }
}else {
    $title = '';
    $title_loto = '';
    $i = 0;
    $g8 = '';
    $g7 = '';
    $g6 = '';
    $g5 = '';
    $g4 = '';
    $g3 = '';
    $g2 = '';
    $g1 = '';
    $g0 = '';
    $code = '';
    $extra = array();
    $loto_arr = array();
    $sms = '';

    $column = count(get_object_vars($data));
    foreach ($data as $value) {
        $i++;
        $class = '';
        $class_loto = '';

        if ($i != $column)
            $class = 'border-right ';
        else
            $class_loto = ' last';

        $title .= '<td class="' . $class . 't-cen"><a href="' . $uri_root . $value->alias . '.html"><strong>' . $value->name . '</strong></a></td>';

        $title_loto .= '<th class="border-right bg-yelow1 t-cen' . $class_loto . '" colspan="3"><span>' . $value->name . '</span></th>';

        $str = str_replace('**', '<img src="' . img_link('icon-xs/loading.gif') . '" width="40" alt="" height="10" />', $value->data[8]);
        $g8 .='<td class="' . $class . 't-cen"><strong class="red">' . $str . '</strong></td>';

        $str = str_replace('***', '<img src="' . img_link('icon-xs/loading.gif') . '" width="40" alt="" height="10" />', $value->data[7]);
        $g7 .='<td class="' . $class . 'bg-gray t-cen">' . $str . '</td>';

        $str = str_replace(array('-', '****'), array('</div><div>', '<img src="' . img_link('icon-xs/loading.gif') . '" width="40" alt="" height="10" />'), $value->data[6]);
        $g6 .='<td class="' . $class . 't-cen"><div>' . $str . '</div></td>';

        $str = str_replace('****', '<img src="' . img_link('icon-xs/loading.gif') . '" width="40" alt="" height="10" />', $value->data[5]);
        $g5 .='<td class="' . $class . 'bg-gray t-cen">' . $str . '</td>';

        $str = str_replace(array('-', '*****'), array('</div><div>', '<img src="' . img_link('icon-xs/loading.gif') . '" width="40" alt="" height="10" />'), $value->data[4]);
        $g4 .='<td class="' . $class . 't-cen"><div>' . $str . '</div></td>';

        $str = str_replace(array('-', '*****'), array('</div><div>', '<img src="' . img_link('icon-xs/loading.gif') . '" width="40" alt="" height="10" />'), $value->data[3]);
        $g3 .='<td class="' . $class . 'bg-gray t-cen"><div>' . $str . '</div></td>';

        $str = str_replace('*****', '<img src="' . img_link('icon-xs/loading.gif') . '" width="40" alt="" height="10" />', $value->data[2]);
        $g2 .='<td class="' . $class . 't-cen">' . $str . '</td>';

        $str = str_replace('*****', '<img src="' . img_link('icon-xs/loading.gif') . '" width="40" alt="" height="10" />', $value->data[1]);
        $g1 .='<td class="' . $class . 'bg-gray t-cen">' . $str . '</td>';

        $str = str_replace(str_repeat('*', strlen($value->data[0])), '<img src="' . img_link('icon-xs/loading.gif') . '" width="40" alt="" height="10" />', $value->data[0]);
        $g0 .='<td class="' . $class . 't-cen"><strong class="red">' . $str . '</strong></td>';

        $code .='<td class="' . $class . 'bg-gray t-cen">' . $value->code . '</td>';

        for ($j = 0; $j <= 9; $j++)
            $extra[$i][$j] = $value->extra[$j];


        $str = '';
        foreach ($value->data as $v1) {
            $str .=($str == '' ? '' : '-') . (str_replace(array(','), '-', $v1));
        }
        $loto_arr[$i] = explode('-', $str);

        $sms .= '<li>Để nhận kết quả xổ số <strong>' . $value->name . '</strong> sớm nhất, soạn tin <span>KQ ' . $value->code . '</span> gửi <span>8117</span></li>';
    }
    ?>
    <div class="title title-red">
        <div class="title-right clearfix"><strong class="left">TRỰC TIẾP XỔ SỐ <?php echo $l_area ?> - <?php echo $date; ?></strong>
            <a class="right view-table" href="<?php echo $area == 'MT' ? $uri_root . $url_mientrung : $uri_root . $url_miennam ?>.html">Xem chi tiết <span>&nbsp;</span></a>
        </div>
    </div>
    <div class="box-result">
        <div class="bg-yelow1"><strong class="txt-red">Xổ số <?php echo $l_area ?> mở thưởng ngày <?php echo($days[$datew]); ?> - <?php echo $date; ?></strong></div>
        <table class="tbl-tt">
            <tr>
                <td class="border-right t-cen"><strong><?php echo($days[$datew]); ?></strong></td>
                <?php echo $title ?>
            </tr>
            <tr>
                <td class="border-righ bg-gray t-cen border-right"><?php echo $date; ?></td>
                <?php echo $code ?>
            </tr>
            <tr>
                <td class="border-right t-cen">Giải tám</td>
                <?php echo $g8 ?>
            </tr>
            <tr>
                <td class="border-right bg-gray t-cen">Giải bảy</td>
                <?php echo $g7 ?>
            </tr>
            <tr>
                <td class="border-right t-cen">Giải sáu</td>
                <?php echo $g6 ?>
            </tr>
            <tr>
                <td class="border-right bg-gray t-cen">Giải năm</td>
                <?php echo $g5 ?>
            </tr>
            <tr>
                <td class="border-right t-cen">Giải tư</td>
                <?php echo $g4 ?>
            </tr>
            <tr>
                <td class="border-right bg-gray t-cen">Giải ba</td>
                <?php echo $g3 ?>
            </tr>
            <tr>
                <td class="border-right t-cen">Giải nhì</td>
                <?php echo $g2 ?>
            </tr>
            <tr>
                <td class="border-right bg-gray t-cen">Giải nhất</td>
                <?php echo $g1 ?>
            </tr>
            <tr>
                <td class="border-right t-cen">Giải đặc biệt</td>
                <?php echo $g0 ?>
            </tr>
        </table>
    </div>
    <div class="line-red mb10">&nbsp;</div>
    <ul class="list-editor space1">
        <?php echo $sms ?>
    </ul>
    <div class="tabs-note space-pleft clearfix">
        <a class="span-in" target="_blank" href="<?php echo $uri_root ?>ve-do.html?l=<?php echo $area == 'MT' ? 2 : 3 ?>&amp;d=<?php echo $date_ve_do ?>&amp;t=2">In vé dò</a>
        <a class="span-dvo" href="<?php echo $uri_root ?>do-ve-so.html">Dò vé online</a>
        <a class="span-vs" href="<?php echo $uri_root ?>ve-so-<?php echo $area == 'MT' ? 'mien-trung' : 'mien-nam' ?>.html">Hình ảnh vé số </a>
        <a class="span-mvs" href="<?php echo $uri_root ?>mua-online.html">Mua online</a>
        <a class="span-tkxs" href="<?php echo $uri_root ?>thong-ke-quan-trong.html">Thống kê xổ số</a>
    </div>
    <div class="title title-red">
        <div class="title-right clearfix"><strong>BẢNG LOTO TRỰC TIẾP XỔ SỐ <?php echo ($l_area); ?> - <?php echo $date; ?></strong>
        </div>
    </div>
    <div class="box-result">
        <table class="tbl-tt">
            <tr>
                <?php echo $title_loto ?>
            </tr>
            <tr>
                <?php
                $loto_title = '';
                for ($i = 0; $i < $column; $i++) {
                    $class = '';
                    if ($i != $column - 1)
                        $class = ' border-right';
                    $loto_title .= '<td class="t-cen' . $class . ' bg-red-line" colspan="3"><strong><strong>Loto trực tiếp</strong></strong></td>';
                    ?>
                    <td class="bg-gray t-cen border-right" width="18"><strong>Số</strong></td>
                    <td class="t-cen<?php echo $class ?>" colspan="2">Đơn vị</td>
                <?php } ?>
            </tr>
            <?php for ($i = 0; $i < 10; $i++) { ?>
                <tr>
                    <?php
                    for ($j = 1; $j <= $column; $j++) {
                        $class = '';
                        if ($j != $column)
                            $class = ' border-right';
                        ?>
                        <td class="bg-gray t-cen border-right" width="18"><strong><strong class="red"><?php echo $i ?></strong></strong></td>
                        <td class="t-cen<?php echo $class ?>" colspan="2"><?php echo $extra[$j][$i] ?></td>
                    <?php } ?>
                </tr>
            <?php } ?>
            <tr>
                <?php echo $loto_title ?>
            </tr>
            <tr>
                <?php for ($i = 1; $i <= $column; $i++) { ?>
                    <td colspan="3">
                        <table class="tbl-tt">
                            <?php
                            foreach ($loto_arr[$i] as $k => $value) {
                                $class = '';
                                if (($k + 1) % 3 == 1)
                                    echo '<tr>';
                                if (($k + 1) % 3 != 0)
                                    $class = ' border-right';
                                echo '<td class="bg-gray t-cen' . $class . '" width="18"><strong>' . substr($value, -2, 2) . '</strong></td>';
                                if (($k + 1) % 3 == 0)
                                    echo '</tr>';
                            }
                            ?>
                        </table>
                    </td>
                <?php } ?>
            </tr>
        </table>
    </div>
<?php } ?>
<div class="line-red mb10">&nbsp;</div>
<?php if ($check) { ?>
    <script type="text/javascript">
        clearInterval(timerCheck);
    </script>
<?php } ?>