<div class="block_sms"><?php echo $text_sms->content ?></div>
<div class="box-tt clearfix">
    <strong class="strong-tt">Tr?c ti?p k?t qu? X? S? Mi?n B?c<br />
        Nh?n k?t qu? nhanh siêu t?c</strong>
    <div class="box-editor"><strong class="red">BHX TT MB</strong> g?i <strong class="red">8588</strong></div>
</div>
<?php
$days = array('0' => 'Ch? nh?t', '1' => 'Th? 2', '2' => 'Th? 3', '3' => 'Th? 4', '4' => 'Th? 5', '5' => 'Th? 6', '6' => 'Th? 7');
if (isset($checktoday['MB']) && $checktoday['MB'] == 1)
    $v = $xoso['MB'][$today][0];
else
    $v = $xoso['MB'][$yesterday][0];

$date = date('d/m/Y', strtotime($v->date));
$datew = $days[date('w', strtotime($v->date))];
$v->extra = json_decode($v->extension);
?>
<div class="block_db block_xsmb">
    <div class="block_db_title clearfix">
        <h2>X? S? MI?N B?C - <?php echo $date ?></h2>
        <a class="right" href="<?php echo $uri_root . $v->alias ?>.html">Xem k?t qu? chi ti?t</a>
    </div>
    <div class="block_db_content">
        <div class="title_db">Gi?i d?c bi?t</div>
        <div class="giaidacbiet"><?php echo $v->a0 ?></div>
    </div>
    <div class="block_db_footer">
        <a class="left" href="<?php echo $uri_root . $v->alias ?>.html">Xem k?t qu? chi ti?t</a>
        <span class="left">&nbsp;</span>
        <a href="javascript:" onclick="showPopup('#loto-xsmb')">Loto</a>
        <a href="javascript:" onclick="showPopup('#xsdt-block')">X? S? Ði?n Toán</a>
    </div>
</div>
<div id="xsdt-block" style="display:none">
    <div class="box-result">
        <div class="bg-yelow1"><strong class="txt-red"><h2>X? S? Ði?n Toán</h2></strong></div>
        <?php
        $DT6x36_time = strtotime($xsdt['DT6x36']->date);
        $DT123_time = strtotime($xsdt['DT123']->date);
        $TT_time = strtotime($xsdt['TT']->date);
        ?>
        <table class="tbl-result">
            <tr>
                <td class="bg-gray first">
                    <strong class="left">K?t qu? x? s? di?n toán 6x36</strong>
                    <span class="right">M? thu?ng <?php echo $days[date('w', $DT6x36_time)] ?> ngày <?php echo(date('d/m/Y', $DT6x36_time)); ?></span>
                </td>
            </tr>
            <tr>
                <td class="td-sub">
                    <table>
                        <tr>
                            <?php foreach (json_decode($xsdt['DT6x36']->data)as $value) { ?>
                                <td class="red font24 t-cen"><strong><?php echo $value ?></strong></td>
                            <?php } ?>
                            <td class="t-right"><a class="read-more" href="<?php echo $uri_root ?>xo-so-dien-toan/6X36/<?php echo(date('d-m-Y', $DT6x36_time)); ?>.html"><span>Xem thêm</span></a></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="bg-gray first">
                    <strong class="left">K?t qu? x? s? di?n toán 1*2*3</strong>
                    <span class="right">M? thu?ng <?php echo $days[date('w', $DT123_time)] ?> ngày <?php echo(date('d/m/Y', $DT123_time)); ?></span>
                </td>
            </tr>
            <tr>
                <td class="td-sub">
                    <table class="tbl-sub">
                        <tr>
                            <?php foreach (json_decode($xsdt['DT123']->data)as $value) { ?>
                                <td class="red font24 t-cen"><strong><?php echo $value ?></strong></td>
                            <?php } ?>
                            <td class="t-right"><a class="read-more" href="<?php echo $uri_root ?>xo-so-dien-toan/1*2*3/<?php echo(date('d-m-Y', $DT123_time)); ?>.html"><span>Xem thêm</span></a></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="bg-gray first">
                    <strong class="left">K?t qu? x? s? Th?n tài</strong>
                    <span class="right">M? thu?ng <?php echo $days[date('w', $TT_time)] ?> ngày <?php echo(date('d/m/Y', $TT_time)); ?></span>
                </td>
            </tr>
            <tr>
                <td class="td-sub">
                    <table class="tbl-sub">
                        <tr>
                            <?php foreach (json_decode($xsdt['TT']->data)as $value) { ?>
                                <td class="red font24 t-cen"><strong><?php echo $value ?></strong></td>
                            <?php } ?>
                            <td class="t-right"><a class="read-more" href="<?php echo $uri_root ?>xo-so-dien-toan/than-tai/<?php echo(date('d-m-Y', $TT_time)); ?>.html"><span>Xem thêm</span></a></td>
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
        <div class="bg-yelow1"><strong class="txt-red">Loto Mi?n B?c - <?php echo $datew ?> ngày <?php echo $date ?></strong></div>
        <table class="tbl-tt">
            <tr>
                <td class="bg-gray border-right t-cen"><strong>Ð?u</strong></td>
                <td class="bg-gray border-right t-cen"><strong>Ðuôi</strong></td>
                <td class="bg-gray border-right t-cen"><strong>Ð?u</strong></td>
                <td class="bg-gray t-cen"><strong>Ðuôi</strong></td>
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

if (isset($checktoday['MN']) && $checktoday['MN'] == 1) {
    $v = $xoso['MN'][$today][0];
    $obj = $xoso['MN'][$today];
} else {
    $v = $xoso['MN'][$yesterday][0];
    $obj = $xoso['MN'][$yesterday];
}

$date = date('d/m/Y', strtotime($v->date));
$datew = $days[date('w', strtotime($v->date))];

foreach ($obj as $value) {
    $xsmn[$value->alias]->name = $value->name;
    $xsmn[$value->alias]->data = $value->a0;
    $loto_tinh.='<td colspan="2" class="bg-gray border-right t-cen"><strong>' . $value->name . '</strong></td>';
    $loto_title.='<td class="border-right t-cen"><span>Ð?u</span></td><td class="border-right t-cen"><span>Ðuôi</span></td>';
    $extra = json_decode($value->extension);
    foreach ($extra as $k => $v) {
        $class = '';
        if ($k % 2 == 0)
            $class = 'bg-gray ';
        $loto_arr[$k].='<td class="' . $class . 'border-right t-cen"><span class="red">' . $k . '</span></td><td class="' . $class . 'border-right t-cen">' . $v . '</td>';
    }
}
?>
<div class="block_db block_xsmn">
    <div class="block_db_title clearfix">
        <h2>X? S? MI?N NAM - <?php echo $date ?></h2>
        <a class="right" href="<?php echo $uri_root ?>xoso-mien-nam.html">Xem k?t qu? chi ti?t</a>
    </div>
    <div class="block_db_content">
        <ul class="list-tinh">
            <?php
            foreach ($xsmn as $alias => $value) {
                $width = 'w188';
                if (count($xsmn) == 2)
                    $width = 'w282';elseif (count($xsmn) == 4)
                    $width = 'w141';
                ?>
                <li class="<?php echo $width ?>">
                    <div>
                        <a href="<?php echo $uri_root . $alias ?>.html"><?php echo $value->name ?></a>
                        <div class="title_db">Gi?i d?c bi?t</div>
                        <div class="giaidacbiet"><?php echo $value->data ?></div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="block_db_footer">
        <a class="left" href="<?php echo $uri_root ?>xoso-mien-nam.html">Xem k?t qu? chi ti?t</a>
        <span class="left">&nbsp;</span>
        <a href="javascript:" onclick="showPopup('#loto-xsmn')">Loto</a>
        <a href="javascript:" onclick="showPopup('#xsmn-block')">M? thu?ng hôm nay</a>
    </div>
</div>
<div id="xsmn-block" style="display:none">
    <div class="box-result">
        <div class="bg-yelow1">
            <div class="title-right clearfix">
                <strong class="left txt-red">K?T QU? X? S? MI?N NAM</strong>
                <span class="right txt-red">M? thu?ng hôm nay lúc <strong><?php echo date('h:i A', strtotime($location_menu['MN'][0]->time)) ?></strong></span>
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
                    echo '<li>Ð? nh?n k?t qu? x? s? <strong>' . $value->name . '</strong> s?m nh?t, so?n tin <span>KQ ' . $value->code . '</span> g?i <span>8017</span></li>';
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="line-red">&nbsp;</div>
</div>
<div id="loto-xsmn" style="display:none">
    <div class="box-result">
        <div class="bg-yelow1"><strong class="txt-red">Loto Mi?n Nam - <?php echo $datew ?> ngày <?php echo $date ?></strong></div>
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

if (isset($checktoday['MT']) && $checktoday['MT'] == 1) {
    $v = $xoso['MT'][$today][0];
    $obj = $xoso['MT'][$today];
} else {
    $v = $xoso['MT'][$yesterday][0];
    $obj = $xoso['MT'][$yesterday];
}

$date = date('d/m/Y', strtotime($v->date));
$datew = $days[date('w', strtotime($v->date))];

foreach ($obj as $value) {
    $xsmt[$value->alias]->name = $value->name;
    $xsmt[$value->alias]->data = $value->a0;
    $loto_tinh.='<td colspan="2" class="bg-gray border-right t-cen"><strong>' . $value->name . '</strong></td>';
    $loto_title.='<td class="border-right t-cen"><span>Ð?u</span></td><td class="border-right t-cen"><span>Ðuôi</span></td>';
    $extra = json_decode($value->extension);
    foreach ($extra as $k => $v) {
        $class = '';
        if ($k % 2 == 0)
            $class = 'bg-gray ';
        $loto_arr[$k].='<td class="' . $class . 'border-right t-cen"><span class="red">' . $k . '</span></td><td class="' . $class . 'border-right t-cen">' . $v . '</td>';
    }
}
?>
<div class="block_db block_xsmt">
    <div class="block_db_title clearfix">
        <h2>X? S? MI?N TRUNG - <?php echo $date ?></h2>
        <a class="right" href="<?php echo $uri_root ?>xoso-mien-trung.html">Xem k?t qu? chi ti?t</a>
    </div>
    <div class="block_db_content">
        <ul class="list-tinh">
            <?php
            foreach ($xsmt as $alias => $value) {
                $width = 'w188';
                if (count($xsmt) == 2)
                    $width = 'w282';elseif (count($xsmt) == 4)
                    $width = 'w141';
                ?>
                <li class="<?php echo $width ?>">
                    <div>
                        <a href="<?php echo $uri_root . $alias ?>.html"><?php echo $value->name ?></a>
                        <div class="title_db">Gi?i d?c bi?t</div>
                        <div class="giaidacbiet"><?php echo $value->data ?></div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="block_db_footer">
        <a class="left" href="<?php echo $uri_root ?>xoso-mien-trung.html">Xem k?t qu? chi ti?t</a>
        <span class="left">&nbsp;</span>
        <a href="javascript:" onclick="showPopup('#loto-xsmt')">Loto</a>
        <a href="javascript:" onclick="showPopup('#xsmt-block')">M? thu?ng hôm nay</a>
    </div>
</div>
<div id="xsmt-block" style="display:none">
    <div class="box-result">
        <div class="bg-yelow1">
            <div class="title-right clearfix">
                <strong class="left txt-red">K?T QU? X? S? MI?N TRUNG</strong>
                <span class="right txt-red">M? thu?ng hôm nay lúc <strong><?php echo date('h:i A', strtotime($location_menu['MT'][0]->time)) ?></strong></span>
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
                    echo '<li>Ð? nh?n k?t qu? x? s? <strong>' . $value->name . '</strong> s?m nh?t, so?n tin <span>KQ ' . $value->code . '</span> g?i <span>8017</span></li>';
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="line-red">&nbsp;</div>
</div>
<div id="loto-xsmt" style="display:none">
    <div class="box-result">
        <div class="bg-yelow1"><strong class="txt-red">Loto Mi?n Trung - <?php echo $datew ?> ngày <?php echo $date ?></strong></div>
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
    <script type='text/javascript'>googletag.cmd.push(function(){googletag.display("div-gpt-ad-1378288615889-1")});</script>
</div>
<br/>

<div class="tk-home">
    <div class="tk-title">
        <h3>Th?ng kê nhanh các t?nh quay thu?ng hôm nay</h3>
        <div class="styled-select">
            <select name="tinh-home" id="tinh-home" onchange="loadTKHome();">
                <option value="1">Mi?n B?c</option>
                <?php foreach ($location_today['MT'] as $value) { ?>
                    <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                <?php } ?>
                <?php foreach ($location_today['MN'] as $value) { ?>
                    <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div id="load-tk-home"></div>
</div>
<script type="text/javascript">function loadTKHome() {var a = $("#tinh-home").val();$("#load-tk-home").html('<div style="padding:10px;text-align:center"><img src="<?php echo img_link('icon-xs/007.gif'); ?>" width="145" height="15" alt="" /></div>');$.ajax({type: "GET",url: "<?php echo $uri_root ?>loadtkhome/" + a,success: function(b) {$("#load-tk-home").html(b);}})}$(document).ready(function(a) {loadTKHome()});</script>
<?php $this->load->view($layout_sms); ?>