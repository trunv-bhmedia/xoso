<?php
$url = '';
if ($alias == $url_mientrung) {
    $l_area = 'MIỀN TRUNG';
    $url = 'so-dau-duoi/mien-trung/' . $th;
    $url_ = 'so-dau-duoi/mien-trung';
} else {
    $l_area = 'MIỀN NAM';
    $url = 'so-dau-duoi/mien-nam/' . $th;
    $url_ = 'so-dau-duoi/mien-nam';
}
$title = 'SỚ ĐẦU ĐUÔI ' . $l_area . ' - ' . $thu;
?>
<div class="box-tt clearfix">
    <strong class="strong-tt">Trực tiếp kết quả Xổ Số Miền Bắc<br />
        Nhận kết quả nhanh siêu tốc</strong>
    <div class="box-editor">Soạn <strong class="red">TT MB</strong> gửi <strong class="red">8517</strong></div>
</div>
<div class="xs-provide clearfix">
    <div class="title-top"><h1><?php echo $title ?></h1></div>
    <ul class="tabs-week pad55">
        <li<?php echo $th == '' ? ' class="active"' : '' ?>><a href="<?php echo $uri_root . $url_ ?>.html">Tất cả</a></li>
        <li<?php echo $th == 'thu-hai' ? ' class="active"' : '' ?>><a href="<?php echo $uri_root . $url_ ?>/thu-hai.html">Thứ 2</a></li>
        <li<?php echo $th == 'thu-ba' ? ' class="active"' : '' ?>><a href="<?php echo $uri_root . $url_ ?>/thu-ba.html">Thứ 3</a></li>
        <li<?php echo $th == 'thu-tu' ? ' class="active"' : '' ?>><a href="<?php echo $uri_root . $url_ ?>/thu-tu.html">Thứ 4</a></li>
        <li<?php echo $th == 'thu-nam' ? ' class="active"' : '' ?>><a href="<?php echo $uri_root . $url_ ?>/thu-nam.html">Thứ 5</a></li>
        <li<?php echo $th == 'thu-sau' ? ' class="active"' : '' ?>><a href="<?php echo $uri_root . $url_ ?>/thu-sau.html">Thứ 6</a></li>
        <li<?php echo $th == 'thu-bay' ? ' class="active"' : '' ?>><a href="<?php echo $uri_root . $url_ ?>/thu-bay.html">Thứ 7</a></li>
        <li<?php echo $th == 'chu-nhat' ? ' class="active"' : '' ?>><a href="<?php echo $uri_root . $url_ ?>/chu-nhat.html">Chủ Nhật</a></li>
    </ul>
</div>
<?php
if ($date == '')
    $date = date('d-m-Y');
if ($items) {
    foreach ($items as $xoso) {
        $date = str_replace('/', '-', $xoso[0]->date);
        break;
    }
}

$start = '30-01-2006';
$today = date('d-m-Y');
$end = $today;
$strtotime_start = strtotime($start);
$strtotime_today = strtotime($today);

$next_7 = date('d-m-Y', strtotime($date . ' +30 day'));
if (strtotime($next_7) > $strtotime_today)
    $next_7 = $today;
$pre_7 = date('d-m-Y', strtotime($date . ' -30 day'));
if (strtotime($pre_7) < $strtotime_start)
    $pre_7 = $start;
?>
<div class="tabs-week-content">
    <div class="week-slide clearfix">
        <ul class="clearfix">
            <li><a href="<?php echo $uri_root . $url . '/' . $start ?>.html" class="three-arrow">&laquo;&laquo;</a></li>
            <li><a href="<?php echo $uri_root . $url . '/' . $pre_7 ?>.html" class="two-arrow">&laquo;&lsaquo;</a></li>
            <li>
                <div class="box-date">
                    <div class="box-datein">                        
                        <input name="kqxs_date" type="text" class="txt-date" id="kqxs_date" value="<?php echo $date ?>" />
                        <script type="text/javascript">$("#kqxs_date").datepick({dateFormat: 'dd-mm-yyyy',maxDate: +0,onSelect: function() {var day=$("#kqxs_date").val();document.location='<?php echo $uri_root . $url ?>/'+day+'.html';}});</script>
                    </div>
                </div>
            </li>
            <li><a href="<?php echo $uri_root . $url . '/' . $next_7 ?>.html" class="two1-arrow">&rsaquo;&raquo;</a></li>
            <li><a href="<?php echo $uri_root . $url . '/' . $end ?>.html" class="three1-arrow">&raquo;&raquo;</a></li>
        </ul>
    </div>
</div>
<?php
if ($items) {
    $total_show = 0;
    foreach ($items as $xoso) {
        $total_show++;

        if ($total_show > 30)
            break;

        $date = $xoso[0]->date;
        $datew = $xoso[0]->dateOfWeek;
        $date_link = str_replace('/', '-', $date);

        $title = '';
        foreach ($xoso as $value) {
            $title .= '<td class="kq">' . $value->name . '<br /><span class="xanh">' . $value->a8 . '</span> - <span class="do">' . substr($value->a0, -2, 2) . '</span></td>';
        }
        ?>
        <table border="0" cellspacing="0" cellpadding="0" class="sodauduoi_block">
            <tbody>
                <tr>
                    <td class="ngay"><a href="<?php echo $uri_root . $alias . '/' . $date_link ?>.html"><?php echo $datew ?><br /><?php echo $date ?></a></td>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0" style="width:auto">
                            <tbody>
                                <tr>
                                    <?php echo $title ?>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php
    }
}?>