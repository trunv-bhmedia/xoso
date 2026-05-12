<?php
//$timer = '10:53:00';
$current = time();
$time_area = date('H\hi', strtotime($timer));
$time = date('H:i');

if ($area == 'MB') {
$title = 'MIỀN BẮC';
$title2 = 'Miền Bắc';
$time_end = '18:00';
} elseif ($area == 'MT') {
$title = 'MIỀN TRUNG';
$title2 = 'Miền Trung';
$time_end = '17:00';
} else {
$title = 'MIỀN NAM';
$title2 = 'Miền Nam';
$time_end = '16:00';
}

$counter = (strtotime(date($timer)) - $current) * 1000;
$today = date('d/m/Y', time());
?>
<h1 style="position: absolute; text-indent: -99999px">TRỰC TIẾP XỔ SỐ <?php echo $title ?></h1>
<div class="page-title-xs"><strong>Trực tiếp Xổ Số <?php echo date('d/m/Y', time()) ?></strong></div>
<div class="waiting t-cen" id="icon-load">
<img src="<?php echo img_link('icon-xs/007.gif'); ?>" width="145" height="15" alt="" /><br />
Đang chờ Kết quả Xổ số <?php echo $title2 ?> lúc<br />
<strong><?php echo $time_area . ' ngày ' . $today ?></strong>. Chúc các bạn may mắn!!!
</div>
<div class="page-title-ttxs t-cen">
<ul class="tabs-provide">
<li><a<?php echo $area == 'MB' ? ' class="active"' : ''; ?> href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-bac.html">MIỀN BẮC</a></li>
<li><a<?php echo $area == 'MT' ? ' class="active"' : ''; ?> href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-trung.html">MIỀN TRUNG</a></li>
<li><a<?php echo $area == 'MN' ? ' class="active"' : ''; ?> href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-nam.html">MIỀN NAM</a></li>
</ul>
</div>
<div id="xstt-block">
<div class="box-current t-cen">
<p><span class="red font16"><?php if ($counter > 0) { ?>Hiện tại không phải giờ xổ số!!!<?php } else { ?>Tường thuật trực tiếp kết quả xổ số<?php } ?></span></p>
<?php if ($area != 'MB') { ?>
<p>Lịch quay số mở thưởng ngày <?php echo $today ?></p>
<p class="red">
<?php
foreach ($location_today[$area] as $k => $v)
echo ($k == 0 ? '' : ' - ') . $v->name;
?>
</p>
<?php } ?>
</div>
<div class="box-wait" id="xstt">
<div class="wait-inner">
<ul class="clearfix">
<li><span class="num hour">00</span></li>
<li><span class="num min">00</span></li>
<li><span class="num sec">00</span></li>
</ul>
</div>
</div>
<p class="t-cen txt-update">
Kết quả xổ số toàn quốc tự động cập nhật liên tục từng giải như ngồi xem trước hội trường xổ số trong suốt quá trình mở thưởng từ hệ thống máy chủ kết nối dữ liệu trực tuyến của xoso.com (không cần refresh)<br/>
<strong class="red"> - Kính chúc quý khách may mắn phát tài!</strong>
</p>
</div>

<div id="kqxs-block"></div>

<?php
if ($area != 'MB') {
if ($area == 'MT')
$url = $uri_root . $url_mientrung;
else
$url = $uri_root . $url_miennam;
?>
<ul class="xs-menu">
<li><h3 style="background:#eee"><a class="ketqua" href="<?php echo $url ?>.html"><span>Kết quả các tỉnh khác</span></a></h3></li>
</ul>
<?php } ?>

<div class="box-note">
<p><strong class="red">LƯU Ý KHI XEM TƯỜNG THUẬT TRỰC TIẾP XỔ SỐ</strong></p>
<?php
$time_area_mb = date('H\hi', strtotime($location_menu['MB'][0]->time));
$time_area_mt = date('H\hi', strtotime($location_menu['MT'][0]->time));
$time_area_mn = date('H\hi', strtotime($location_menu['MN'][0]->time));
?>
<p>
Tường thuật trực tiếp kết quả xổ số <strong><a href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-bac.html">Miền Bắc</a></strong> <?php echo $time_area_mb ?>'<br/>
Tường thuật trực tiếp kết quả xổ số <strong><a href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-trung.html">Miền Trung</a></strong> <?php echo $time_area_mt ?>'<br/>
Tường thuật trực tiếp kết quả xổ số <strong><a href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-nam.html">Miền Nam</a></strong> <?php echo $time_area_mn ?>'<br/><br/>
Tường thuật trực tiếp kết quả xổ số từ trường quay, dữ liệu cập nhật siêu tốc, nhanh nhất, chính xác nhất.<br/><br/>
Trong thời điểm quay thưởng, số lượng truy cập tới hệ thống XOSO.COM là rất lớn, có những lúc có thể bị gián đoạn dữ liệu, nhưng hệ thống luôn luôn ưu tiên tác vụ tại thời điểm đó, để đảm bảo kết quả được gửi về sớm nhất có thể.
</p>
</div>
<script type="text/javascript">
/*<![CDATA[*/
var counter=<?php echo $counter?>;var checkTime=5000;var clockTime=1000;var timerCheck=setInterval("checkUpdate();",checkTime);var timerClock=setInterval("clockUpdate();",clockTime);
function clockUpdate(){if(counter>-1){mb=countDown(counter);counter=mb.time;$("#xstt .hour").html(mb.hour);$("#xstt .min").html(mb.min);$("#xstt .sec").html(mb.sec)}else{timerCheck=setInterval("checkUpdate();",checkTime);clearInterval(timerClock)}}
function countDown(f){f=f-clockTime;var a=Math.floor(f/(1000*60*60));var e=Math.floor(f/(1000*60));var c=Math.floor(f/1000);var b=e-a*60;var d=c-e*60;if(a<0){b="00"}else{if(b<10){b="0"+b}}if(a<0){d="00"}else{if(d<10){d="0"+d}}if(a<0){a="00"}else{if(a<10){a="0"+a}}return Object({hour:a,min:b,sec:d,time:f})}
function checkUpdate(){if(counter<=0){$.ajax({type:"GET",timeout:1000,url:"<?php echo $uri_root.'xstt/'.$area.'?t='.$timer;?>",success:function(a){if(a!=1){$("#xstt-block").html(a);$("#kqxs-block").html('');$("#icon-load").html('')}}});}}
$(document).ready(function(a){
clockUpdate();checkUpdate();
<?php if($time<$time_end){?>$.ajax({type:"GET",timeout:1000,url:"<?php echo $uri_root.'xstt/'.$area.'?t='.$timer;?>",success:function(a){if(a!=1){$("#kqxs-block").html(a)}}});<?php }?>;
});
/*]]>*/
</script>
<script type="text/javascript">var google_conversion_id=971468785;var google_conversion_language="en";var google_conversion_format="3";var google_conversion_color="ffffff";var google_conversion_label="w0VACP-FoAoQ8d-dzwM";var google_remarketing_only=false;</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script>
<noscript>
<div style="display:inline">
<img height="1" width="1" style="border-style:none" alt="" src="//www.googleadservices.com/pagead/conversion/971468785/?label=w0VACP-FoAoQ8d-dzwM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>