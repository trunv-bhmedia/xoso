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

    $v->extra = json_decode($v->extension);
    $v->data[0] = $v->a0;
    $v->data[1] = $v->a1;
    $v->data[2] = $v->a2;
    $v->data[3] = $v->a3;
    $v->data[4] = $v->a4;
    $v->data[5] = $v->a5;
    $v->data[6] = $v->a6;
    $v->data[7] = $v->a7;
}
$date_ve_do = str_replace('/', '-', $date);

$title_share = 'Xổ Số Miền Bắc - ' . $datew . ' ngày ' . $date;

$alias_date = $v->alias . '/' . $date_ve_do;
$curPageURL = urlencode($uri_root . $alias_date . '.html');
$url_google = 'https://www.google.com/bookmarks/mark?op=add&amp;bkmk=' . $curPageURL . '&amp;title=' . urlencode($title_share);
$url_facebook = 'http://www.facebook.com/sharer.php?u=' . $curPageURL;
$url_yahoo = 'http://www.addtoany.com/add_to/yahoo_mail?linkurl=' . $curPageURL . '&amp;type=page&amp;linkname=&amp;linknote=';
$url_email = 'mailto:?subject=' . $title_share . '&amp;body=' . $curPageURL;
?>
<div class="tit-xs clearfix">
    <strong class="title-xs">XỔ SỐ TRUYỀN THỐNG - <?php echo $date; ?></strong>
    <div class="menuRight">
        <a href="<?php echo $uri_root . $v->alias; ?>.html"><img src="<?php echo img_link('date.png'); ?>" width="15" height="16" alt="" /></a>
    </div>
</div>
<div class="page-title">
    <a href="<?php echo $uri_root . $v->alias . '/' . str_replace('/', '-', $date) ?>.html"><strong class="txt-red"><h2>Xổ Số <?php echo $v->name; ?> - <?php echo $datew ?> ngày <?php echo $date; ?></h2></strong></a>
</div>
<table class="tbl-xs">
    <tr>
        <td class="bg-gray border-right">Giải đặc biệt</td>
        <td class="bg-gray border-right giaidb">
            <?php
            echo '<strong class="red font18 span-space">' . $v->data[0] . '</strong>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="border-right">Giải nhất</td>
        <td class="border-right giai1">
            <?php
            echo '<strong class="span-space">' . $v->data[1] . '</strong>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="bg-gray border-right">Giải nhì</td>
        <td class="bg-gray border-right giai2">
            <?php
            $str = str_replace('-', '</strong><strong class="span-space">', $v->data[2]);
            echo '<strong class="span-space">' . $str . '</strong>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="border-right">Giải ba</td>
        <td class="border-right giai3">
            <?php
            $str = str_replace('-', '</strong><strong class="span-space">', $v->data[3]);
            echo '<strong class="span-space">' . $str . '</strong>';
            ?>
        </td>

    </tr>
    <tr>
        <td class="bg-gray border-right">Giải tư</td>
        <td class="bg-gray border-right giai4">
            <?php
            $str = str_replace('-', '</strong><strong class="span-space">', $v->data[4]);
            echo '<strong class="span-space">' . $str . '</strong>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="border-right">Giải năm</td>
        <td class="border-right giai5">
            <?php
            $str = str_replace('-', '</strong><strong class="span-space">', $v->data[5]);
            echo '<strong class="span-space">' . $str . '</strong>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="bg-gray border-right">Giải sáu</td>
        <td class="bg-gray border-right giai6">
            <?php
            $str = str_replace('-', '</strong><strong class="span-space">', $v->data[6]);
            echo '<strong class="span-space">' . $str . '</strong>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="border-right">Giải bảy</td>
        <td class="border-right giai7">
            <?php
            $str = str_replace('-', '</strong><strong class="span-space">', $v->data[7]);
            echo '<strong class="span-space">' . $str . '</strong>';
            ?>
        </td>
    </tr>
</table>
<table class="tbl-xs">
    <tr>
        <th class="red">Đầu</th>
        <th class="red border-right">Đuôi</th>
        <th class="red border-right">Đầu</th>
        <th class="red">Đuôi</th>
    </tr>
    <tr>
        <td class="bg-gray first"><strong>0</strong></td>
        <td class="bg-gray border-right"><?php echo $v->extra[0] ?></td>
        <td class="bg-gray border-right"><strong>5</strong></td>
        <td class="bg-gray"><?php echo $v->extra[5] ?></td>
    </tr>
    <tr>
        <td class="first"><strong>1</strong></td>
        <td class="border-right"><?php echo $v->extra[1] ?></td>
        <td class="border-right"><strong>6</strong></td>
        <td><?php echo $v->extra[6] ?></td>
    </tr>
    <tr>
        <td class="bg-gray first"><strong>2</strong></td>
        <td class="bg-gray border-right"><?php echo $v->extra[2] ?></td>
        <td class="bg-gray border-right"><strong>7</strong></td>
        <td class="bg-gray"><?php echo $v->extra[7] ?></td>
    </tr>
    <tr>
        <td class="first"><strong>3</strong></td>
        <td class="border-right"><?php echo $v->extra[3] ?></td>
        <td class="border-right"><strong>8</strong></td>
        <td><?php echo $v->extra[8] ?></td>
    </tr>
    <tr>
        <td class="bg-gray first"><strong>4</strong></td>
        <td class="bg-gray border-right"><?php echo $v->extra[4] ?></td>
        <td class="bg-gray border-right"><strong>9</strong></td>
        <td class="bg-gray"><?php echo $v->extra[9] ?></td>
    </tr>
</table>
<div class="view-result clearfix">
    <div class="right share-right">
        <div class="share-like left">
            <a rel="nofollow" href="<?php echo $url_google ?>" title="Google" target="_blank" class="share-g">&nbsp;</a>
            <a rel="nofollow" href="<?php echo $url_facebook ?>" title="Facebook" target="_blank" class="share-f">&nbsp;</a>
            <a rel="nofollow" href="<?php echo $url_yahoo ?>" title="Yahoo" target="_blank" class="share-yahoo">&nbsp;</a>
            <a rel="nofollow" href="<?php echo $url_email ?>" title="Email" target="_blank" class="share-email">&nbsp;</a>
        </div>
    </div>
</div>
<div class="line-red mb10">&nbsp;</div>

<h2 class="h2-title">KẾT QUẢ XỔ SỐ KIẾN THIẾT MIỀN NAM <?php echo $date; ?></h2>
<div class="tit-xs clearfix">
    <strong class="title-xs">KẾT QUẢ XỔ SỐ MIỀN NAM</strong>
    <span class="right">Mở thưởng hôm nay lúc <strong><?php echo date('h:i A', strtotime($location_today['MN'][0]->time)) ?></strong></span>
</div>
<ul class="provide clearfix">
    <?php
    foreach ($location_today['MN'] as $value) {
        echo '<li><a href="' . $uri_root . $value->alias . '.html"><span>' . $value->name . '</span></a></li>';
    }
    ?>
</ul>
<?php
$title = '';
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
$sms = '';
if ($xoso['MN_NEW']) {
    $date = date('d/m/Y', strtotime($xoso['MN_NEW']->date));
    $datew = $days[date('w', strtotime($xoso['MN_NEW']->date))];

    foreach ($xoso['MN_NEW'] as $key => $value) {
        $i++;
        $class = '';
        if ($i != count(get_object_vars($xoso['MN_NEW'])))
            $class = 'border-right ';

        $title .= '<td class="' . $class . 't-cen"><a href="' . $uri_root . $value->alias . '.html"><strong>' . $value->name . '</strong></a></td>';
        $g8 .='<td class="' . $class . 'bg-gray t-cen"><strong class="red">' . $value->data[8] . '</strong></td>';
        $g7 .='<td class="' . $class . 't-cen">' . $value->data[7] . '</td>';
        $g6 .='<td class="' . $class . 'bg-gray t-cen"><div>' . (str_replace('-', '</div><div>', $value->data[6])) . '</div></td>';
        $g5 .='<td class="' . $class . 't-cen">' . $value->data[5] . '</td>';
        $g4 .='<td class="' . $class . 'bg-gray t-cen"><div>' . (str_replace('-', '</div><div>', $value->data[4])) . '</div></td>';
        $g3 .='<td class="' . $class . 't-cen"><div>' . (str_replace('-', '</div><div>', $value->data[3])) . '</div></td>';
        $g2 .='<td class="' . $class . 'bg-gray t-cen">' . $value->data[2] . '</td>';
        $g1 .='<td class="' . $class . 't-cen">' . $value->data[1] . '</td>';
        $g0 .='<td class="' . $class . 'bg-gray t-cen"><strong class="red">' . $value->data[0] . '</strong></td>';

        $sms .= '<li>Để nhận kết quả xổ số <strong>' . $value->name . '</strong> sớm nhất, soạn tin <span>KQ ' . $value->code . '</span> gửi <span>8117</span></li>';
    }
}else {
    $v = $xoso['MN'][0];
    $date = $v->date;
    $datew = $v->dateOfWeek;
    foreach ($xoso['MN'] as $key => $value) {
        $i++;
        $class = '';
        if ($i != count($xoso['MN']))
            $class = 'border-right ';

        $title .= '<th class="' . $class . 't-cen"><a href="' . $uri_root . $value->alias . '.html"><strong>' . $value->name . '</strong></a></th>';
        $g8 .='<td class="' . $class . 'bg-gray t-cen"><strong class="red">' . $value->a8 . '</strong></td>';
        $g7 .='<td class="' . $class . 't-cen">' . $value->a7 . '</td>';
        $g6 .='<td class="' . $class . 'bg-gray t-cen"><div>' . (str_replace('-', '</div><div>', $value->a6)) . '</div></td>';
        $g5 .='<td class="' . $class . 't-cen">' . $value->a5 . '</td>';
        $g4 .='<td class="' . $class . 'bg-gray t-cen"><div>' . (str_replace('-', '</div><div>', $value->a4)) . '</div></td>';
        $g3 .='<td class="' . $class . 't-cen"><div>' . (str_replace('-', '</div><div>', $value->a3)) . '</div></td>';
        $g2 .='<td class="' . $class . 'bg-gray t-cen">' . $value->a2 . '</td>';
        $g1 .='<td class="' . $class . 't-cen">' . $value->a1 . '</td>';
        $g0 .='<td class="' . $class . 'bg-gray t-cen"><strong class="red">' . $value->a0 . '</strong></td>';

        $sms .= '<li>Để nhận kết quả xổ số <strong>' . $value->name . '</strong> sớm nhất, soạn tin <span>KQ ' . $value->code . '</span> gửi <span>8117</span></li>';
    }
}

$title_share = 'Xổ Số Miền Nam - ' . $datew . ' ngày ' . $date;

$date_ve_do = str_replace('/', '-', $date);
$alias_date = $url_miennam . '/' . $date_ve_do;
$curPageURL = urlencode($uri_root . $alias_date . '.html');
$url_google = 'https://www.google.com/bookmarks/mark?op=add&amp;bkmk=' . $curPageURL . '&amp;title=' . urlencode($title_share);
$url_facebook = 'http://www.facebook.com/sharer.php?u=' . $curPageURL;
$url_yahoo = 'http://www.addtoany.com/add_to/yahoo_mail?linkurl=' . $curPageURL . '&amp;type=page&amp;linkname=&amp;linknote=';
$url_email = 'mailto:?subject=' . $title_share . '&amp;body=' . $curPageURL;
?>
<div class="page-title">
    <a href="<?php echo $uri_root . $url_miennam ?>.html"><strong class="txt-red"><h2>Xổ số Miền Nam mở thưởng ngày <?php echo $datew ?> - <?php echo $date ?></h2></strong></a>
</div>
<table class="tbl-xs">
    <tr>
        <th class="border-right t-cen">Giải thưởng</th>
        <?php echo $title ?>
    </tr>
    <tr>
        <td class="border-righ bg-gray t-cen">Giải tám</td>
        <?php echo $g8 ?>
    </tr>
    <tr>
        <td class="border-right t-cen">Giải bảy</td>
        <?php echo $g7 ?>
    </tr>
    <tr>
        <td class="border-right bg-gray t-cen">Giải sáu</td>
        <?php echo $g6 ?>
    </tr>
    <tr>
        <td class="border-right t-cen">Giải năm</td>
        <?php echo $g5 ?>
    </tr>
    <tr>
        <td class="border-right bg-gray t-cen">Giải tư</td>
        <?php echo $g4 ?>
    </tr>
    <tr>
        <td class="border-right t-cen">Giải ba</td>
        <?php echo $g3 ?>
    </tr>
    <tr>
        <td class="border-right bg-gray t-cen">Giải nhì</td>
        <?php echo $g2 ?>
    </tr>
    <tr>
        <td class="border-right t-cen">Giải nhất</td>
        <?php echo $g1 ?>
    </tr>
    <tr>
        <td class="border-right t-cen bg-gray">Giải đặc biệt</td>
        <?php echo $g0 ?>
    </tr>
</table>
<div class="view-result clearfix">
    <div class="right share-right">
        <div class="share-like left">
            <a rel="nofollow" href="<?php echo $url_google ?>" title="Google" target="_blank" class="share-g">&nbsp;</a>
            <a rel="nofollow" href="<?php echo $url_facebook ?>" title="Facebook" target="_blank" class="share-f">&nbsp;</a>
            <a rel="nofollow" href="<?php echo $url_yahoo ?>" title="Yahoo" target="_blank" class="share-yahoo">&nbsp;</a>
            <a rel="nofollow" href="<?php echo $url_email ?>" title="Email" target="_blank" class="share-email">&nbsp;</a>
        </div>
    </div>
</div>
<div class="line-red mb10">&nbsp;</div>

<h2 class="h2-title">KẾT QUẢ XỔ SỐ KIẾN THIẾT MIỀN TRUNG <?php echo $date; ?></h2>
<div class="tit-xs clearfix">
    <strong class="title-xs">KẾT QUẢ XỔ SỐ MIỀN TRUNG</strong>
    <span class="right">Mở thưởng hôm nay lúc <strong><?php echo date('h:i A', strtotime($location_today['MT'][0]->time)) ?></strong></span>
</div>
<ul class="provide clearfix">
    <?php
    foreach ($location_today['MT'] as $value) {
        echo '<li><a href="' . $uri_root . $value->alias . '.html"><span>' . $value->name . '</span></a></li>';
    }
    ?>
</ul>
<?php
$title = '';
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
$sms = '';
if ($xoso['MT_NEW']) {
    $date = date('d/m/Y', strtotime($xoso['MT_NEW']->date));
    $datew = $days[date('w', strtotime($xoso['MT_NEW']->date))];

    foreach ($xoso['MT_NEW'] as $key => $value) {
        $i++;
        $class = '';
        if ($i != count(get_object_vars($xoso['MT_NEW'])))
            $class = 'border-right ';

        $title .= '<td class="' . $class . 't-cen"><a href="' . $uri_root . $value->alias . '.html"><strong>' . $value->name . '</strong></a></td>';
        $g8 .='<td class="' . $class . 'bg-gray t-cen"><strong class="red">' . $value->data[8] . '</strong></td>';
        $g7 .='<td class="' . $class . 't-cen">' . $value->data[7] . '</td>';
        $g6 .='<td class="' . $class . 'bg-gray t-cen"><div>' . (str_replace('-', '</div><div>', $value->data[6])) . '</div></td>';
        $g5 .='<td class="' . $class . 't-cen">' . $value->data[5] . '</td>';
        $g4 .='<td class="' . $class . 'bg-gray t-cen"><div>' . (str_replace('-', '</div><div>', $value->data[4])) . '</div></td>';
        $g3 .='<td class="' . $class . 't-cen"><div>' . (str_replace('-', '</div><div>', $value->data[3])) . '</div></td>';
        $g2 .='<td class="' . $class . 'bg-gray t-cen">' . $value->data[2] . '</td>';
        $g1 .='<td class="' . $class . 't-cen">' . $value->data[1] . '</td>';
        $g0 .='<td class="' . $class . 'bg-gray t-cen"><strong class="red">' . $value->data[0] . '</strong></td>';

        $sms .= '<li>Để nhận kết quả xổ số <strong>' . $value->name . '</strong> sớm nhất, soạn tin <span>KQ ' . $value->code . '</span> gửi <span>8117</span></li>';
    }
}else {
    $v = $xoso['MT'][0];
    $date = $v->date;
    $datew = $v->dateOfWeek;
    foreach ($xoso['MT'] as $key => $value) {
        $i++;
        $class = '';
        if ($i != count($xoso['MT']))
            $class = 'border-right ';

        $title .= '<th class="' . $class . 't-cen"><a href="' . $uri_root . $value->alias . '.html"><strong>' . $value->name . '</strong></a></th>';
        $g8 .='<td class="' . $class . 'bg-gray t-cen"><strong class="red">' . $value->a8 . '</strong></td>';
        $g7 .='<td class="' . $class . 't-cen">' . $value->a7 . '</td>';
        $g6 .='<td class="' . $class . 'bg-gray t-cen"><div>' . (str_replace('-', '</div><div>', $value->a6)) . '</div></td>';
        $g5 .='<td class="' . $class . 't-cen">' . $value->a5 . '</td>';
        $g4 .='<td class="' . $class . 'bg-gray t-cen"><div>' . (str_replace('-', '</div><div>', $value->a4)) . '</div></td>';
        $g3 .='<td class="' . $class . 't-cen"><div>' . (str_replace('-', '</div><div>', $value->a3)) . '</div></td>';
        $g2 .='<td class="' . $class . 'bg-gray t-cen">' . $value->a2 . '</td>';
        $g1 .='<td class="' . $class . 't-cen">' . $value->a1 . '</td>';
        $g0 .='<td class="' . $class . 'bg-gray t-cen"><strong class="red">' . $value->a0 . '</strong></td>';

        $sms .= '<li>Để nhận kết quả xổ số <strong>' . $value->name . '</strong> sớm nhất, soạn tin <span>KQ ' . $value->code . '</span> gửi <span>8117</span></li>';
    }
}

$title_share = 'Xổ Số Miền Trung - ' . $datew . ' ngày ' . $date;

$date_ve_do = str_replace('/', '-', $date);
$alias_date = $url_mientrung . '/' . $date_ve_do;
$curPageURL = urlencode($uri_root . $alias_date . '.html');
$url_google = 'https://www.google.com/bookmarks/mark?op=add&amp;bkmk=' . $curPageURL . '&amp;title=' . urlencode($title_share);
$url_facebook = 'http://www.facebook.com/sharer.php?u=' . $curPageURL;
$url_yahoo = 'http://www.addtoany.com/add_to/yahoo_mail?linkurl=' . $curPageURL . '&amp;type=page&amp;linkname=&amp;linknote=';
$url_email = 'mailto:?subject=' . $title_share . '&amp;body=' . $curPageURL;
?>
<div class="page-title">
    <a href="<?php echo $uri_root . $url_mientrung ?>.html"><strong class="txt-red"><h2>Xổ số Miền Trung mở thưởng ngày <?php echo $datew ?> - <?php echo $date ?></h2></strong></a>
</div>
<table class="tbl-xs">
    <tr>
        <th class="border-right t-cen">Giải thưởng</th>
        <?php echo $title ?>
    </tr>
    <tr>
        <td class="border-righ bg-gray t-cen">Giải tám</td>
        <?php echo $g8 ?>
    </tr>
    <tr>
        <td class="border-right t-cen">Giải bảy</td>
        <?php echo $g7 ?>
    </tr>
    <tr>
        <td class="border-right bg-gray t-cen">Giải sáu</td>
        <?php echo $g6 ?>
    </tr>
    <tr>
        <td class="border-right t-cen">Giải năm</td>
        <?php echo $g5 ?>
    </tr>
    <tr>
        <td class="border-right bg-gray t-cen">Giải tư</td>
        <?php echo $g4 ?>
    </tr>
    <tr>
        <td class="border-right t-cen">Giải ba</td>
        <?php echo $g3 ?>
    </tr>
    <tr>
        <td class="border-right bg-gray t-cen">Giải nhì</td>
        <?php echo $g2 ?>
    </tr>
    <tr>
        <td class="border-right t-cen">Giải nhất</td>
        <?php echo $g1 ?>
    </tr>
    <tr>
        <td class="border-right t-cen bg-gray">Giải đặc biệt</td>
        <?php echo $g0 ?>
    </tr>
</table>
<div class="view-result clearfix">
    <div class="right share-right">
        <div class="share-like left">
            <a rel="nofollow" href="<?php echo $url_google ?>" title="Google" target="_blank" class="share-g">&nbsp;</a>
            <a rel="nofollow" href="<?php echo $url_facebook ?>" title="Facebook" target="_blank" class="share-f">&nbsp;</a>
            <a rel="nofollow" href="<?php echo $url_yahoo ?>" title="Yahoo" target="_blank" class="share-yahoo">&nbsp;</a>
            <a rel="nofollow" href="<?php echo $url_email ?>" title="Email" target="_blank" class="share-email">&nbsp;</a>
        </div>
    </div>
</div>
<div class="bg-shadow">&nbsp;</div>