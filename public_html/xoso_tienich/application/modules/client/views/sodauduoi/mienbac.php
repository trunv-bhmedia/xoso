<script type="text/javascript" src="<?php echo js_link('jquery.selectbox-0.2.js') ?>"></script>
<?php
$cur_year = date('Y');
$min_year = $cur_year - 10;
$yearList = array();
for ($i = $min_year; $i <= $cur_year; $i++) {
    $tmp = sprintf('%02d', $i);
    $yearList[] = $tmp;
}

$url = '';
$l_area = 'MIỀN BẮC';
$url = 'so-dau-duoi/mien-bac';

if (isset($date) && $date != '')
    $title = 'SỚ ĐẦU ĐUÔI ' . $l_area . ' NGÀY ' . str_replace('-', '/', $date);
else
    $title = 'SỚ ĐẦU ĐUÔI ' . $l_area;
?>
<h1 style="position: absolute; text-indent: -99999px"><?php echo $title ?></h1>
<div class="page-title-xs">
    <strong><?php echo $title ?></strong>
</div>
<?php
if ($date == '')
    $date = date('d-m-Y');
if ($items) {
    $date = str_replace('/', '-', $items[0]->date);
}

$select_day = date('d', strtotime($date));
$select_month = date('m', strtotime($date));
$select_year = date('Y', strtotime($date));

$start = '30-01-2002';
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
<div class="xs-provide clearfix">
    <ul class="tabs-week">
        <li<?php echo $th == '' ? ' class="active"' : '' ?>><a href="<?php echo $uri_root . $url ?>.html">Tất cả</a></li>
        <li<?php echo $th == 'thu-hai' ? ' class="active"' : '' ?>><a href="<?php echo $uri_root . $url ?>/thu-hai.html">Thứ 2</a></li>
        <li<?php echo $th == 'thu-ba' ? ' class="active"' : '' ?>><a href="<?php echo $uri_root . $url ?>/thu-ba.html">Thứ 3</a></li>
        <li<?php echo $th == 'thu-tu' ? ' class="active"' : '' ?>><a href="<?php echo $uri_root . $url ?>/thu-tu.html">Thứ 4</a></li>
        <li<?php echo $th == 'thu-nam' ? ' class="active"' : '' ?>><a href="<?php echo $uri_root . $url ?>/thu-nam.html">Thứ 5</a></li>
        <li<?php echo $th == 'thu-sau' ? ' class="active"' : '' ?>><a href="<?php echo $uri_root . $url ?>/thu-sau.html">Thứ 6</a></li>
        <li<?php echo $th == 'thu-bay' ? ' class="active"' : '' ?>><a href="<?php echo $uri_root . $url ?>/thu-bay.html">Thứ 7</a></li>
        <li<?php echo $th == 'chu-nhat' ? ' class="active"' : '' ?>><a href="<?php echo $uri_root . $url ?>/chu-nhat.html">CN</a></li>
    </ul>
</div>
<div class="select-provice kqxs-block">
    <a class="button button-pre" href="<?php echo $uri_root . $url . '/' . $pre_7 ?>.html"><span>&laquo;</span></a>
    <a class="button button-next" href="<?php echo $uri_root . $url . '/' . $next_7 ?>.html"><span>&raquo;</span></a>
    <form id="form_search" method="post" action="">
        <div class="box-fromto t-cen">
            <select name="select_day" id="select_day" tabindex="1">
                <option value="">Ngày</option>
                <?php
                for ($i = 1; $i <= 31; $i++) {
                    $selected = '';
                    if ($select_day == $i) {
                        $selected = ' selected=""';
                    }
                    echo '<option' . $selected . ' value="' . $i . '">' . sprintf('%02d', $i) . '</option>';
                }
                ?>
            </select>
            <select name="select_month" id="select_month" tabindex="1">
                <option value="">Tháng</option>
                <?php
                for ($i = 1; $i <= 12; $i++) {
                    $selected = '';
                    if ($select_month == $i) {
                        $selected = ' selected=""';
                    }
                    echo '<option' . $selected . ' value="' . $i . '">' . sprintf('%02d', $i) . '</option>';
                }
                ?>
            </select>
            <select name="select_year" id="select_year" tabindex="1">
                <option value="">Năm</option>
                <?php
                foreach ($yearList as $value) {
                    $selected = '';
                    if ($select_year == $value) {
                        $selected = ' selected=""';
                    }
                    echo '<option' . $selected . ' value="' . $value . '">' . $value . '</option>';
                }
                ?>
            </select>
            <a href="javascript:;" class="read-more" onclick="kqSubmit('<?php echo $uri_root . $url ?>');"><span>Xem</span></a>
        </div>
    </form>
</div>
<div class="sodauduoi_mienbac_block">
    <table width="70%" border="0" align="center" cellspacing="0" cellpadding="0" class="sodauduoi_mienbac_inner">
        <tr><td class="tg7">Giải Bảy</td><td class="tdb">Đặc Biệt</td></tr>
    </table>
    <?php
    if ($items) {
        $total_show = 0;
        foreach ($items as $xoso) {
            $total_show++;

            if ($total_show > 30)
                break;

            $date = $xoso->date;
            $datew = $xoso->dateOfWeek;
            $date_link = str_replace('/', '-', $date);
            ?>
            <a href="<?php echo $uri_root . $alias . '/' . $date_link ?>.html"><?php echo $datew ?>, <?php echo $date ?></a>
            <table width="70%" align="center" border="0" cellspacing="0" cellpadding="0" class="sodauduoi_mienbac">
                <tr>
                    <td class="g7"><span class="xanh"><?php echo str_replace('-', ',', $xoso->a7) ?></span></td>
                    <td class="db">
                        <span class="xanh"><?php echo substr($xoso->a0, 0, 3) ?></span><span class="do"><?php echo substr($xoso->a0, -2, 2) ?></span>
                    </td>
                </tr>
            </table>
            <?php
        }
    }
    ?>
</div>
<script type="text/javascript">$(function () {$("#select_mien").selectbox();$("#select_day").selectbox();$("#select_month").selectbox();$("#select_year").selectbox();});</script>