<?php
//$timer = '10:53:00';
$current = time();
$time_area = date('H\hi', strtotime($timer));
$time = date('H:i');
if ($time < "12:00")
    $counter = 0;
else
    $counter = (strtotime(date($timer)) - $current) * 1000;

if ($area == 'MB') {
    $title = 'MIỀN BẮC';
    $title2 = 'Miền Bắc';
} elseif ($area == 'MT') {
    $title = 'MIỀN TRUNG';
    $title2 = 'Miền Trung';
} else {
    $title = 'MIỀN NAM';
    $title2 = 'Miền Nam';
}
$today = date('d/m/Y', time());
?>
<div class="banner">
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
<h1 style="position: absolute; text-indent: -99999px">TRỰC TIẾP XỔ SỐ <?php echo $title ?></h1>
<div class="wating-result">
    <p><strong class="font18">TRỰC TIẾP XỔ SỐ <?php echo $title ?></strong></p>
    <p id="icon-load">
        Đang chờ kết quả Xổ số <?php echo $title2 ?> lúc <strong><?php echo $time_area . ' ngày ' . $today ?></strong>. Chúc các bạn may mắn!!!<br/>
        <img src="<?php echo img_link('icon-xs/007.gif'); ?>" width="145" height="15" alt="" />
    </p>
</div>
<div class="tabs-provide">
    <ul>
        <li<?php echo $area == 'MB' ? ' class="active"' : ''; ?>><a href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-bac.html">MIỀN BẮC</a></li>
        <li<?php echo $area == 'MT' ? ' class="active"' : ''; ?>><a href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-trung.html">MIỀN TRUNG</a></li>
        <li<?php echo $area == 'MN' ? ' class="active"' : ''; ?>><a href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-nam.html">MIỀN NAM</a></li>
    </ul>
</div>
<div id="xstt-block">
    <?php if ($time >= "12:00") { ?>
        <div class="title title-red">
            <div class="title-right">Thông báo</div>
        </div>
        <div class="box-result">
            <div class="box-information">
                <p class="font18 red"><strong>Hiện tại không phải giờ xổ số!!!</strong></p>
                <?php if ($area != 'MB') { ?>
                    <p>
                        Lịch quay số mở thưởng ngày <?php echo $today ?><br />
                        <span class="red">
                            <?php
                            foreach ($location as $k => $v)
                                echo ($k == 0 ? '' : ' - ') . $v->name;
                            ?>
                        </span>
                    </p>
                <?php } ?>
                <p class="red">
                    <strong>Đang chờ đến giờ xổ số <?php echo $title2 ?></strong>
                </p>
                <div class="box-wait" id="xstt">
                    <div class="wait-inner">
                        <ul class="clearfix">
                            <li>
                                <span class="num hour">00</span>
                                Giờ
                            </li>
                            <li>
                                <span class="num min">00</span>
                                Phút
                            </li>
                            <li>
                                <span class="num sec">00</span>
                                Giây
                            </li>
                        </ul>
                    </div>
                </div>
                <p>Kết quả xổ số toàn quốc tự động cập nhật liên tục từng giải như ngồi xem trước hội trường xổ số trong suốt quá trình mở thưởng từ hệ thống máy chủ kết nối dữ liệu trực tuyến của xoso.com (không cần refresh)<strong class="red"> - Kính chúc quý khách may mắn phát tài!</strong></p>
            </div>
        </div>
        <div class="line-red mb10">&nbsp;</div>
    <?php } ?>
</div>

<div class="title title-red">
    <div class="title-right">LƯU Ý KHI XEM TƯỜNG THUẬT TRỰC TIẾP XỔ SỐ
    </div>
</div>
<div class="box-result">
    <div class="box-notes">
        <?php
        $time_area_mb = date('H\hi', strtotime($location_menu['MB'][0]->time));
        $time_area_mt = date('H\hi', strtotime($location_menu['MT'][0]->time));
        $time_area_mn = date('H\hi', strtotime($location_menu['MN'][0]->time));
        ?>
        <div class="msg-block">
            Tường thuật trực tiếp kết quả xổ số <strong><a href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-bac.html">Miền Bắc</a></strong> <?php echo $time_area_mb ?>'<br/>
            Tường thuật trực tiếp kết quả xổ số <strong><a href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-trung.html">Miền Trung</a></strong> <?php echo $time_area_mt ?>'<br/>
            Tường thuật trực tiếp kết quả xổ số <strong><a href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so/mien-nam.html">Miền Nam</a></strong> <?php echo $time_area_mn ?>'<br/><br/>
            Tường thuật trực tiếp kết quả xổ số từ trường quay, dữ liệu cập nhật siêu tốc, nhanh nhất, chính xác nhất.Bạn có thể theo dõi trong suốt quá trình quay thưởng mà không cần phải Refresh (F5)<br/><br/>
            Trong thời điểm quay thưởng, số lượng truy cập tới hệ thống XOSO.COM là rất lớn, băng thông bị tắc nghẽn, hoặc một số lỗi khác mặc dù chúng tôi đã khắc phục, nhưng vẫn có những lúc có thể bị gián đoạn dữ liệu, hệ thống luôn luôn ưu tiên tác vụ tại thời điểm đó, để đảm bảo kết quả được gửi về sớm nhất có thể.
        </div>
    </div>
</div>

<script type="text/javascript">
    var counter=<?php echo $counter?>;var checkTime=5000;var clockTime=1000;var timerCheck=setInterval("checkUpdate();",checkTime);var timerClock=setInterval("clockUpdate();",clockTime);clockUpdate();checkUpdate();
    function clockUpdate(){if(counter>-1){mb=countDown(counter);counter=mb.time;jQuery("#xstt .hour").html(mb.hour);jQuery("#xstt .min").html(mb.min);jQuery("#xstt .sec").html(mb.sec)}else{clearInterval(timerClock)}}
    function countDown(time){time=time-clockTime;var Xhour=Math.floor(time/(1000*60*60));var Xmins=Math.floor(time/(1000*60));var Xsecs=Math.floor(time/1000);var Xmin=Xmins-Xhour*60;var Xsec=Xsecs-Xmins*60;if(Xhour<0){Xmin='00'}else if(Xmin<10){Xmin='0'+Xmin}if(Xhour<0){Xsec='00'}else if(Xsec<10){Xsec='0'+Xsec}if(Xhour<0){Xhour='00'}else if(Xhour<10){Xhour='0'+Xhour}return Object({hour:Xhour,min:Xmin,sec:Xsec,time:time})}
    function checkUpdate(){if(counter<=0){jQuery.post('<?php echo $uri_root . 'xstt/' . $area; ?>',function(data){if(data!=1){jQuery('#xstt-block').html(data);$('#icon-load').hide()}})}}
</script>