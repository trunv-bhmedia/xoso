<?php $url = '';
$alias_ = $alias;
$url_tttt = '';
if ($alias == $url_mientrung) {
$l_area = 'MIỀN TRUNG';
$lname = 'Miền Trung';
$url = $url_mientrung;
$url_tttt = $uri_root . 'tuong-thuat-truc-tiep-ket-qua-xo-so/mien-trung.html';
if (isset($th) && $th != '') $alias_ = $alias . '/' . $th;$location_time = $location_menu['MT'][0]->time;
}else {
$l_area = 'MIỀN NAM';
$lname = 'Miền Nam';
$url = $url_miennam;
$url_tttt = $uri_root . 'tuong-thuat-truc-tiep-ket-qua-xo-so/mien-nam.html';
if (isset($th) && $th != '') $alias_ = $alias . '/' . $th;$location_time = $location_menu['MN'][0]->time;
}if (isset($date) && $date != '') echo '<h1 style="position: absolute; text-indent: -99999px">KẾT QUẢ XỔ SỐ ' . $l_area . ' NGÀY ' . str_replace('-', '/', $date) . '</h1>';else {
if (isset($thu) && $thu != '') echo '<h1 style="position: absolute; text-indent: -99999px">KẾT QUẢ XỔ SỐ ' . $l_area . ' - ' . mb_strtoupper($thu, 'UTF-8') . '</h1>';else echo '<h1 style="position: absolute; text-indent: -99999px">KẾT QUẢ XỔ SỐ ' . $l_area . '</h1>';
} ?>
<div class="box-tt clearfix">
<strong class="strong-tt">Trực tiếp kết quả Xổ Số Miền Bắc<br />
Nhận kết quả nhanh siêu tốc</strong>
<div class="box-editor">Soạn <strong class="red">BHX TT MB</strong> gửi <strong class="red">8588</strong></div>
</div>
<?php
//if ((!isset($_SESSION['user']) || $_SESSION['user']['gender'] == 0) && isset($date) && $date != '' && date('Y-m-d',  strtotime($date)) < '2008-01-01'){
//echo '<div class="alert_vip">Không có kết quả ngày '.str_replace('-', '/', $date).'.<br/>Bạn chỉ được xem kết quả từ năm 2008 trở lại đây<br/>';
//$this->load->view('layout/vip');
//echo '</div>';
//}
?>
<div class="xs-provide clearfix">
<strong class="left strong-provide">XỔ SỐ <?php echo $l_area ?></strong>
<ul class="tabs-week right">
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
<?php if ($date == '') $date = date('d-m-Y');if ($items) {
foreach ($items as $xoso) {
$date = str_replace('/', '-', $xoso[0]->date);
break;
}
}

//if (!isset($_SESSION['user']) || $_SESSION['user']['gender'] == 0)
//$start = '07-01-2008';
//else
$start = '07-01-2006';

$today = date('d-m-Y');
$end = $today;
$strtotime_date = strtotime($date);
$strtotime_start = strtotime($start);
$strtotime_today = strtotime($today);
if ($strtotime_date >= $strtotime_today) {
$next = $today;
} else {
$next = date('d-m-Y', strtotime($date . ' +1 day'));
}if ($strtotime_date <= $strtotime_start) {
$pre = $start;
} else {
$pre = date('d-m-Y', strtotime($date . ' -1 day'));
}$next_7 = date('d-m-Y', strtotime($date . ' +7 day'));
if (strtotime($next_7) > $strtotime_today) $next_7 = $today;$pre_7 = date('d-m-Y', strtotime($date . ' -7 day'));
if (strtotime($pre_7) < $strtotime_start) $pre_7 = $start; ?>
<div class="tabs-week-content">
<div class="week-slide clearfix">
<ul class="clearfix">
<li><a href="<?php echo $uri_root . $alias_ . '/' . $start ?>.html" class="three-arrow">&laquo;&laquo;</a></li>
<li><a href="<?php echo $uri_root . $alias_ . '/' . $pre_7 ?>.html" class="two-arrow">&laquo;&lsaquo;</a></li>
<li><a href="<?php echo $uri_root . $alias_ . '/' . $pre ?>.html" class="one-arrow">&laquo;</a></li>
<li>
<div class="box-date">
<div class="box-datein">
<input name="kqxs_date" type="text" class="txt-date" id="kqxs_date" value="<?php echo $date ?>" />
<script type="text/javascript">/*<![CDATA[*/$("#kqxs_date").datepick({dateFormat:"dd-mm-yyyy",maxDate:+0,onSelect:function(){var a=$("#kqxs_date").val();document.location="<?php echo $uri_root . $alias_ ?>/"+a+".html"}});/*]]>*/</script>
</div>
</div>
</li>
<li><a href="<?php echo $uri_root . $alias_ . '/' . $next ?>.html" class="one1-arrow">&raquo;</a></li>
<li><a href="<?php echo $uri_root . $alias_ . '/' . $next_7 ?>.html" class="two1-arrow">&rsaquo;&raquo;</a></li>
<li><a href="<?php echo $uri_root . $alias_ . '/' . $end ?>.html" class="three1-arrow">&raquo;&raquo;</a></li>
</ul>
</div>
</div>
<?php if ($items) { 
echo '<div class="title-top"><div class="tabs-note clearfix"><a class="span-ttttmn" href="' . $url_tttt . '">Tường thuật trực tiếp >></a></div></div>';
?>
<div class="title title-red">
<div class="title-right clearfix"><strong class="left xsmb">KẾT QUẢ XỔ SỐ <?php echo $l_area ?></strong>
<span class="right">Mở thưởng hôm nay lúc <strong><?php echo date('h:i A', strtotime($location_time)) ?></strong></span>
</div>
</div>
<?php $total_show = 0;
foreach ($items as $xoso) {
$total_show++;
if ($total_show > 7) break;
$date = $xoso[0]->date;
$datew = $xoso[0]->dateOfWeek;
$date_link = str_replace('/', '-', $date);
//if ((!isset($_SESSION['user']) || $_SESSION['user']['gender'] == 0) && date('Y-m-d',  strtotime($date_link)) < '2008-01-01') break;
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
$loto_title = '';
$loto_arr = array();
foreach ($xoso as $key => $value) {
$i++;
$class = '';
if ($i != count($xoso)) $class = 'border-right ';$title.='<td class="' . $class . 't-cen"><a href="' . $uri_root . $value->alias . '.html"><strong>' . $value->name . '</strong></a></td>';
$g8.='<td class="' . $class . 'bg-gray t-cen"><strong class="red">' . $value->a8 . '</strong></td>';
$g7.='<td class="' . $class . 't-cen">' . $value->a7 . '</td>';
$g6.='<td class="' . $class . 'bg-gray t-cen"><div>' . (str_replace('-', '</div><div>', $value->a6)) . '</div></td>';
$g5.='<td class="' . $class . 't-cen">' . $value->a5 . '</td>';
$g4.='<td class="' . $class . 'bg-gray t-cen"><div>' . (str_replace('-', '</div><div>', $value->a4)) . '</div></td>';
$g3.='<td class="' . $class . 't-cen"><div>' . (str_replace('-', '</div><div>', $value->a3)) . '</div></td>';
$g2.='<td class="' . $class . 'bg-gray t-cen">' . $value->a2 . '</td>';
$g1.='<td class="' . $class . 't-cen">' . $value->a1 . '</td>';
$g0.='<td class="' . $class . 'bg-gray t-cen"><strong class="red">' . $value->a0 . '</strong></td>';
$class_loto = '';
if ($i == count($xoso)) $class_loto = ' last';$loto_title.='<th class="border-right bg-yelow1 t-cen"><span>Đầu</span></th><th class="border-right bg-yelow1 t-cen' . $class_loto . '"><span>Đuôi</span></th>';
$extra = json_decode($value->extension);
foreach ($extra as $k => $v) {
$loto_arr[$k].='<td class="border-right bg-red1 t-cen">' . $k . '</td><td class="' . $class . 't-cen">' . $v . '</td>';
}$sms.='<li>Để nhận kết quả xổ số <strong>' . $value->name . '</strong> sớm nhất, soạn tin <span>BHX KQ ' . $value->code . '</span> gửi <span>8188</span></li>';
}$title_share = 'Xổ Số ' . $lname . ' - ' . $datew . ' ngày ' . $date;
$curPageURL = urlencode($uri_root . $url . '/' . $date_link . '.html');
$url_google = 'https://www.google.com/bookmarks/mark?op=add&amp;bkmk=' . $curPageURL . '&amp;title=' . urlencode($title_share);
$url_facebook = 'http://www.facebook.com/sharer.php?u=' . $curPageURL;
$url_yahoo = 'http://www.addtoany.com/add_to/yahoo_mail?linkurl=' . $curPageURL . '&amp;type=page&amp;linkname=&amp;linknote=';
$url_email = 'mailto:?subject=' . formatMail($title_share) . '&amp;body=' . $curPageURL; ?>
<div class="box-result">
<div class="bg-yelow1"><a href="<?php echo $uri_root . $url . '/' . $date_link ?>.html"><strong class="txt-red"><h2>Xổ số <?php echo $lname ?> mở thưởng ngày <?php echo $datew ?> - <?php echo $date ?></h2></strong></a></div>
<table class="tbl-tt">
<tr>
<td class="border-right t-cen"><strong>Giải thưởng</strong></td>
<?php echo $title ?>
</tr>
<tr>
<td class="border-right bg-gray t-cen">Giải tám</td>
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
</div>
<div class="line-red">&nbsp;</div>
<div class="view-result clearfix">
<div class="bg-yelow1 borde-view left">
<span class="span-result" onclick="showPopup('#loto-block-<?php echo $date_link ?>')">Xem kết quả Loto <?php echo $datew ?> ngày <?php echo $date ?></span>
</div>
</div>
<div id="loto-block-<?php echo $date_link ?>" style="display:none">
<div class="box-result">
<table class="tbl-tt">
<tr>
<th class="border-right bg-yelow1 t-cen"><span><?php echo $datew ?></span></th>
<?php echo $loto_title ?>
</tr>
<tr>
<td rowspan="10" class="border-right">Thống kê đầu / đuôi<br />Xổ số <?php echo $lname ?> <br />
ngày <?php echo $date ?>
</td>
<?php echo $loto_arr[0] ?>
</tr>
<tr><?php echo $loto_arr[1] ?></tr>
<tr><?php echo $loto_arr[2] ?></tr>
<tr><?php echo $loto_arr[3] ?></tr>
<tr><?php echo $loto_arr[4] ?></tr>
<tr><?php echo $loto_arr[5] ?></tr>
<tr><?php echo $loto_arr[6] ?></tr>
<tr><?php echo $loto_arr[7] ?></tr>
<tr><?php echo $loto_arr[8] ?></tr>
<tr class="last"><?php echo $loto_arr[9] ?></tr>
</table>
</div>
<div class="line-red">&nbsp;</div>
</div>
<ul class="list-editor space1">
<?php echo $sms ?>
</ul>
<div class="tabs-note col3 clearfix">
<a class="span-in" target="_blank" href="<?php echo $uri_root ?>in-ve-do.html?l=<?php echo $alias == $url_mientrung ? 2 : 3 ?>&amp;d=<?php echo $date_link ?>&amp;t=2">&nbsp;</a>
<a class="span-dvo" href="<?php echo $uri_root ?>do-ve-so.html">&nbsp;</a>
<a class="span-quayxs" href="<?php echo $uri_root ?>cung-quay-xo-so.html<?php echo $alias == $url_mientrung ? '?t=2' : '?t=3' ?>">&nbsp;</a>
<a class="span-vs" href="<?php echo $uri_root ?>ve-so-<?php echo $alias == $url_mientrung ? 'mien-trung' : 'mien-nam' ?>.html">&nbsp;</a>
</div>
<div class="view-result clearfix">
<div class="big-share-like">
<div class="share-like left">
<span>Chia sẻ</span>
<a rel="nofollow" href="<?php echo $url_facebook ?>" title="Facebook" target="_blank" class="share-f">Facebook</a>
<a rel="nofollow" href="<?php echo $url_google ?>" title="Google+" target="_blank" class="share-g">Google+</a>
<a rel="nofollow" href="<?php echo $url_yahoo ?>" title="Yahoo" target="_blank" class="share-yahoo">Yahoo</a>
<a rel="nofollow" href="<?php echo $url_email ?>" title="Email" target="_blank" class="share-email">Email</a>
</div>
</div>
</div>
<?php
}
}?>