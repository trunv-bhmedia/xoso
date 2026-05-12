<?php
if (isset($checktoday['MB']) && $checktoday['MB'] == 1)
    $v = $xoso['MB'][$today][0];
else
    $v = $xoso['MB'][$yesterday][0];

$strtotime_date = strtotime($v->date);

ob_start();
?>
<div class="block_db block_xsmb">
    <div class="block_db_title clearfix">
        <div class="date_block">
            <div class="day"><?php echo date('d', $strtotime_date) ?></div>
            <div class="month-year"><?php echo date('m/Y', $strtotime_date) ?></div>
        </div>
        <h2><a href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-bac.html">XỔ SỐ MIỀN BẮC</a></h2>
    </div>
    <div class="block_db_content">
        <table>
            <tr>
                <td class="title_db"><div>Giải ĐB</div></td>
                <td class="giaidacbiet" width="1%" nowrap><div><?php echo $v->a0 ?></div></td>
                <td class="arrow-right" nowrap><div><a href="<?php echo $uri_root . $v->alias ?>.html">Chi tiết</a></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td colspan="2">
                    <div class="title-top"><div class="tabs-note clearfix"><a class="span-tttt" href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-bac.html">Tường thuật trực tiếp >></a></div></div>
                </td>
            </tr>
        </table>
    </div>
</div>
<?php
$kqmb = ob_get_contents();
ob_end_clean();

$xsmn = array();

if (isset($checktoday['MN']) && $checktoday['MN'] == 1) {
    $v = $xoso['MN'][$today][0];
    $obj = $xoso['MN'][$today];
} else {
    $v = $xoso['MN'][$yesterday][0];
    $obj = $xoso['MN'][$yesterday];
}

foreach ($obj as $value) {
    $xsmn[$value->alias]->name = $value->name;
    $xsmn[$value->alias]->data = $value->a0;
}
$strtotime_date = strtotime($v->date);

ob_start();
?>
<div class="block_db block_xsmn">
    <div class="block_db_title clearfix">
        <div class="date_block">
            <div class="day"><?php echo date('d', $strtotime_date) ?></div>
            <div class="month-year"><?php echo date('m/Y', $strtotime_date) ?></div>
        </div>
        <h2><a href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-nam.html">XỔ SỐ MIỀN NAM</a></h2>
    </div>
    <div class="block_db_content">
        <table>
            <tr class="bg-gray">
                <td class="title_db">&nbsp;</td>
                <td class="giaidacbiet" width="1%" nowrap><span>Giải đặc biệt</span></td>
                <td class="arrow-right" nowrap>&nbsp;</td>
            </tr>
            <?php foreach ($xsmn as $alias => $value) { ?>
                <tr>
                    <td class="title_db"><div><a href="<?php echo $uri_root . $alias ?>.html"><?php echo $value->name ?></a></div></td>
                    <td class="giaidacbiet" width="1%" nowrap><div><?php echo $value->data ?></div></td>
                    <td class="arrow-right" nowrap><div><a href="<?php echo $uri_root . $alias ?>.html">Chi tiết</a></div></td>
                </tr>
            <?php } ?>
            <tr>
                <td>&nbsp;</td>
                <td colspan="2">
                    <div class="title-top"><div class="tabs-note clearfix"><a class="span-tttt" href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-nam.html">Tường thuật trực tiếp >></a></div></div>
                </td>
            </tr>
        </table>
    </div>
</div>
<?php
$kqmn = ob_get_contents();
ob_end_clean();

$xsmt = array();

if (isset($checktoday['MT']) && $checktoday['MT'] == 1) {
    $v = $xoso['MT'][$today][0];
    $obj = $xoso['MT'][$today];
} else {
    $v = $xoso['MT'][$yesterday][0];
    $obj = $xoso['MT'][$yesterday];
}

foreach ($obj as $value) {
    $xsmt[$value->alias]->name = $value->name;
    $xsmt[$value->alias]->data = $value->a0;
}
$strtotime_date = strtotime($v->date);

ob_start();
?>
<div class="block_db block_xsmt">
    <div class="block_db_title clearfix">
        <div class="date_block">
            <div class="day"><?php echo date('d', $strtotime_date) ?></div>
            <div class="month-year"><?php echo date('m/Y', $strtotime_date) ?></div>
        </div>
        <h2><a href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-trung.html">XỔ SỐ MIỀN TRUNG</a></h2>
    </div>
    <div class="block_db_content">
        <table>
            <tr class="bg-gray">
                <td class="title_db">&nbsp;</td>
                <td class="giaidacbiet" width="1%" nowrap><span>Giải đặc biệt</span></td>
                <td class="arrow-right" nowrap>&nbsp;</td>
            </tr>
            <?php foreach ($xsmt as $alias => $value) { ?>
                <tr>
                    <td class="title_db"><div><a href="<?php echo $uri_root . $alias ?>.html"><?php echo $value->name ?></a></div></td>
                    <td class="giaidacbiet" width="1%" nowrap><div><?php echo $value->data ?></div></td>
                    <td class="arrow-right" nowrap><div><a href="<?php echo $uri_root . $alias ?>.html">Chi tiết</a></div></td>
                </tr>
            <?php } ?>
            <tr>
                <td>&nbsp;</td>
                <td colspan="2">
                    <div class="title-top"><div class="tabs-note clearfix"><a class="span-tttt" href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-trung.html">Tường thuật trực tiếp >></a></div></div>
                </td>
            </tr>
        </table>
    </div>
</div>
<?php
$kqmt = ob_get_contents();
ob_end_clean();

//$tttt_mb = true;
//$tttt_mt = true;
//$tttt_mn = true;
//if ($tttt_mb || $tttt_mt || $tttt_mn) {
//    echo '<script type="text/javascript" src="' . js_link('jquery-blink.js') . '"></script>';
//    if ($tttt_mb) {
//        echo '<div class="tttt_link"><a class="tttt_blink" href="' . $uri_root . 'tuong-thuat-truc-tiep-ket-qua-xo-so/mien-bac.html">Đang tường thuật trực tiếp Xổ Số Miền Bắc</a></div>';
//    } elseif ($tttt_mt) {
//        echo '<div class="tttt_link"><a class="tttt_blink" href="' . $uri_root . 'tuong-thuat-truc-tiep-ket-qua-xo-so/mien-trung.html">Đang tường thuật trực tiếp Xổ Số Miền Trung</a></div>';
//    } else {
//        echo '<div class="tttt_link"><a class="tttt_blink" href="' . $uri_root . 'tuong-thuat-truc-tiep-ket-qua-xo-so/mien-nam.html">Đang tường thuật trực tiếp Xổ Số Miền Nam</a></div>';
//    }
//    echo "<script type=\"text/javascript\">$(document).ready(function() { $('.tttt_blink').blink({delay:100});});</script>";
//}

if ($_SESSION['ck'] == 1 || $_SESSION['ck'] == 9)
    echo $kqmb . $kqmn . $kqmt;
elseif ($_SESSION['ck'] == 2)
    echo $kqmn . $kqmb . $kqmt;
elseif ($_SESSION['ck'] == 3)
    echo $kqmt . $kqmb . $kqmn;
?>

<div class="page-title-xs">
    <strong>Xổ số hôm nay <?php echo date('d/m/Y', time()) ?></strong>
    <a class="arrow-right" href="javascript:;" onclick="showPopup('#xshomnay');">&nbsp;</a>
</div>
<div class="home-block" id="xshomnay" style="display:none">
    <ul class="xs-menu">
        <li><h2><a href="<?php echo $uri_root . $url_mienbac ?>.html"><span>Miền Bắc</span></a></h2></li>
        <li><h2><a href="<?php echo $uri_root . $url_miennam ?>.html"><span>Miền Nam</span></a></h2></li>
        <?php
        foreach ($location_today['MN'] as $value) {
            echo '<li class="sub-menu-xstoday"><h3><a href="' . $uri_root . $value->alias . '.html"><span>' . $value->name . '</span></a></h3></li>';
        }
        ?>
        <li><h2><a href="<?php echo $uri_root . $url_mientrung ?>.html"><span>Miền Trung</span></a></h2></li>
        <?php
        foreach ($location_today['MT'] as $value) {
            echo '<li class="sub-menu-xstoday"><h3><a href="' . $uri_root . $value->alias . '.html"><span>' . $value->name . '</span></a></h3></li>';
        }
        ?>
    </ul>
</div>