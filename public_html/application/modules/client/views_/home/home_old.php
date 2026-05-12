<div class="banner">
    <div class="mod-banner-home">
        <?php
        foreach ($banner as $v) {
            if ($v->position == 'top' && ($v->page == 'all' || $v->page == $c_module)) {
                ?>
                <div><a target="_blank" href="<?php echo $v->url; ?>" title="<?php echo view_title($v->name); ?>"><img src="<?php echo site_url($v->image); ?>" width="566" alt="<?php echo view_title($v->name); ?>" /></a></div>
                <?php
            }
        }
        ?>
    </div>
</div>
<div class="box-tt clearfix">
    <strong class="strong-tt">Trực tiếp kết quả Xổ Số Miền Bắc<br />
        Nhận kết quả nhanh siêu tốc</strong>
    <div class="box-editor">Soạn <strong class="red">TT MB</strong> gửi <strong class="red">8517</strong></div>
</div>
<table class="tbl-tt tbl-rate mb30">
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

$title_share = 'Xổ Số ' . $v->name . ' - ' . $datew . ' ngày ' . $date;

$alias_date = $v->alias . '/' . $date_ve_do;
$curPageURL = urlencode($uri_root . $alias_date . '.html');
$url_google = 'https://www.google.com/bookmarks/mark?op=add&amp;bkmk=' . $curPageURL . '&amp;title=' . urlencode($title_share);
$url_facebook = 'http://www.facebook.com/sharer.php?u=' . $curPageURL;
$url_yahoo = 'http://www.addtoany.com/add_to/yahoo_mail?linkurl=' . $curPageURL . '&amp;type=page&amp;linkname=&amp;linknote=';
$url_email = 'mailto:?subject=' . $title_share . '&amp;body=' . $curPageURL;
?>

<div id='div-gpt-ad-1378288615889-1' style='width:336px' class="mainmenu">
    <script type='text/javascript'>
        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1378288615889-1'); });
    </script>
</div>
<br/>
<h2 class="h2-title">KẾT QUẢ XỔ SỐ KIẾN THIẾT MIỀN BẮC <?php echo $date; ?></h2>
<div class="title title-red">
    <div class="title-right clearfix"><strong class="left xsmb">XỔ SỐ TRUYỀN THỐNG - <?php echo $date; ?></strong>
        <a class="right view-table" href="<?php echo $uri_root . $v->alias; ?>.html">Xem chi tiết <span>&nbsp;</span></a>
    </div>
</div>
<div class="box-result">
    <table class="tbl-tt tbl-main-tt">
        <tr>
            <td colspan="2" class="bg-yelow1"><a href="<?php echo $uri_root . $v->alias . '/' . str_replace('/', '-', $date) ?>.html"><strong class="txt-red"><h2>Xổ Số <?php echo $v->name; ?> - <?php echo $datew ?> ngày <?php echo $date; ?></h2></strong></a></td>
            <td class="td-sub" rowspan="8">
                <table class="tbl-dd">
                    <tr>
                        <th class="first bg-yelow1">Đầu</th>
                        <th class="last bg-yelow1">Đuôi</th>
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
            <td>
                <div class="share-like clearfix">
                    <a rel="nofollow" href="<?php echo $url_google ?>" title="Google" target="_blank" class="share-g">&nbsp;</a>
                    <a rel="nofollow" href="<?php echo $url_facebook ?>" title="Facebook" target="_blank" class="share-f">&nbsp;</a>
                    <a rel="nofollow" href="<?php echo $url_yahoo ?>" title="Yahoo" target="_blank" class="share-yahoo">&nbsp;</a>
                    <a rel="nofollow" href="<?php echo $url_email ?>" title="Email" target="_blank" class="share-email">&nbsp;</a>
                </div>
            </td>
        </tr>
    </table>
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
    <h2 class="h2-title">KẾT QUẢ XỔ SỐ ĐIỆN TOÁN</h2>
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
<div class="line-red mb10">&nbsp;</div>
<h2 class="h2-title">KẾT QUẢ XỔ SỐ KIẾN THIẾT MIỀN NAM <?php echo $date; ?></h2>
<div class="title title-red">
    <div class="title-right clearfix"><strong class="left xsmb">KẾT QUẢ XỔ SỐ MIỀN NAM</strong>
        <span class="right">Mở thưởng hôm nay lúc <strong><?php echo date('h:i A', strtotime($location_today['MN'][0]->time)) ?></strong></span>
    </div>
</div>
<div class="box-result">
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

            $title .= '<td class="' . $class . 't-cen"><a href="' . $uri_root . $value->alias . '.html"><strong>' . $value->name . '</strong></a></td>';
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
    <div class="bg-yelow1"><a href="<?php echo $uri_root . $url_miennam . '/' . $date_ve_do ?>.html"><strong class="txt-red"><h2>Xổ số Miền Nam mở thưởng ngày <?php echo $datew ?> - <?php echo $date ?></h2></strong></a></div>
    <table class="tbl-tt">
        <tr>
            <td class="border-right t-cen"><strong>Giải thưởng</strong></td>
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
    <ul class="list-editor space1">
        <?php echo $sms ?>
    </ul>
    <div class="tabs-note space-pleft clearfix">
        <a class="span-in" target="_blank" href="<?php echo $uri_root ?>ve-do.html?l=3&amp;d=<?php echo $date_ve_do ?>&amp;t=2">In vé dò</a>
        <a class="span-dvo" href="<?php echo $uri_root ?>do-ve-so.html">Dò vé online</a>
        <a class="span-vs" href="<?php echo $uri_root ?>ve-so-mien-nam.html">Hình ảnh vé số </a>
        <a class="span-mvs" href="<?php echo $uri_root ?>mua-online.html">Mua online</a>
        <a class="span-tkxs" href="<?php echo $uri_root ?>thong-ke-quan-trong.html">Thống kê xổ số</a>
    </div>
</div>
<div class="line-red mb10">&nbsp;</div>
<h2 class="h2-title">KẾT QUẢ XỔ SỐ KIẾN THIẾT MIỀN TRUNG <?php echo $date; ?></h2>
<div class="title title-red">
    <div class="title-right clearfix"><strong class="left xsmb">KẾT QUẢ XỔ SỐ MIỀN TRUNG</strong>
        <span class="right">Mở thưởng hôm nay lúc <strong><?php echo date('h:i A', strtotime($location_today['MT'][0]->time)) ?></strong></span>
    </div>
</div>
<div class="box-result">
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

            $title .= '<td class="' . $class . 't-cen"><a href="' . $uri_root . $value->alias . '.html"><strong>' . $value->name . '</strong></a></td>';
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
    <div class="bg-yelow1"><a href="<?php echo $uri_root . $url_mientrung . '/' . $date_ve_do ?>.html"><strong class="txt-red"><h2>Xổ số Miền Trung mở thưởng ngày <?php echo $datew ?> - <?php echo $date ?></h2></strong></a></div>
    <table class="tbl-tt">
        <tr>
            <td class="border-right t-cen"><strong>Giải thưởng</strong></td>
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
    <ul class="list-editor space1">
        <?php echo $sms ?>
    </ul>
    <div class="tabs-note space-pleft clearfix">
        <a class="span-in" target="_blank" href="<?php echo $uri_root ?>ve-do.html?l=2&amp;d=<?php echo $date_ve_do ?>&amp;t=2">In vé dò</a>
        <a class="span-dvo" href="<?php echo $uri_root ?>do-ve-so.html">Dò vé online</a>
        <a class="span-vs" href="<?php echo $uri_root ?>ve-so-mien-trung.html">Hình ảnh vé số </a>
        <a class="span-mvs" href="<?php echo $uri_root ?>mua-online.html">Mua online</a>
        <a class="span-tkxs" href="<?php echo $uri_root ?>thong-ke-quan-trong.html">Thống kê xổ số</a>
    </div>
</div>
<div class="line-red mb10">&nbsp;</div>
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