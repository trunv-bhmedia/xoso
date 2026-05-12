<?php
//$timer = '10:53:00';
$current = time();
$time_area = date('H\hi', strtotime($timer));
$time = date('H:i');

if ($area == 'MB') {
    $title = 'MIỀN BẮC';
    $title2 = 'Miền Bắc';
    $time_end = '18:00';
    $l_area = 'Truyền thống';
} elseif ($area == 'MT') {
    $title = 'MIỀN TRUNG';
    $title2 = 'Miền Trung';
    $time_end = '17:00';
    $l_area = 'Miền Trung';
} else {
    $title = 'MIỀN NAM';
    $title2 = 'Miền Nam';
    $time_end = '16:00';
    $l_area = 'Miền Nam';
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
<?php
if ($area == 'MB') {
    $days = array('0' => 'Chủ nhật', '1' => 'Thứ 2', '2' => 'Thứ 3', '3' => 'Thứ 4', '4' => 'Thứ 5', '5' => 'Thứ 6', '6' => 'Thứ 7');

    if ($time < $time_end) {
        $date = date('d/m/Y', strtotime('-1 day'));
        $date_ve_do = date('d-m-Y', strtotime('-1 day'));
        $datew = date('w', strtotime('-1 day'));
    } else {
        $date = date('d/m/Y');
        $date_ve_do = date('d-m-Y');
        $datew = date('w');
    }

    $title_share = 'Xổ Số Miền Bắc - ' . $days[$datew] . ' ngày ' . $date;
    $shared_content = 'Xổ Số Miền Bắc ngày ' . $date;
    $alias_date = $url_mienbac . '/' . $date_ve_do;
    $curPageURL = urlencode($uri_root . $alias_date . '.html');
    $url_google = 'https://www.google.com/bookmarks/mark?op=add&amp;bkmk=' . $curPageURL . '&amp;title=' . urlencode($title_share) . '&amp;annotation=' . $shared_content;
    $url_facebook = 'http://www.facebook.com/sharer.php?u=' . $curPageURL;
    $url_yahoo = 'http://www.addtoany.com/add_to/yahoo_mail?linkurl=' . $curPageURL . '. ' . $shared_content . '&amp;type=page&amp;linkname=' . $title_share . '&amp;linknote=';
    $url_email = 'mailto:?subject=' . formatMail($title_share) . '&amp;body=' . $curPageURL . '. ' . formatMail($shared_content);
    ?>
    <div id="kqxs-mb" style="display:none">
        <div class="tit-xs clearfix">
            <strong class="title-xs">TRỰC TIẾP XỔ SỐ <?php echo mb_strtoupper($l_area, 'UTF-8') ?></strong>
            <div class="menuRight">
                <a href="<?php echo $uri_root . $url_mienbac ?>.html"><img src="<?php echo img_link('date.png'); ?>" width="15" height="16" alt="" /></a>
            </div>
        </div>
        <div class="page-title">
            <strong class="txt-red"><h2>Xổ Số Miền Bắc - <?php echo($days[$datew]); ?> ngày <?php echo $date; ?></h2></strong>
        </div>

        <table class="tbl-xs">
            <tr>
                <td class="bg-gray border-right">Giải đặc biệt</td>
                <td class="bg-gray giaidb"></td>
            </tr>
            <tr>
                <td class="border-right">Giải nhất</td>
                <td class="giai1 font70014"></td>
            </tr>
            <tr>
                <td class="bg-gray border-right">Giải nhì</td>
                <td class="bg-gray giai2 font70014"></td>
            </tr>
            <tr>
                <td class="border-right">Giải ba</td>
                <td class="giai3 font70014"></td>
            </tr>
            <tr>
                <td class="bg-gray border-right">Giải tư</td>
                <td class="bg-gray giai4 font70014"></td>
            </tr>
            <tr>
                <td class="border-right">Giải năm</td>
                <td class="giai5 font70014"></td>
            </tr>
            <tr>
                <td class="bg-gray border-right">Giải sáu</td>
                <td class="bg-gray giai6 font70014"></td>
            </tr>
            <tr>
                <td class="border-right">Giải bảy</td>
                <td class="giai7 font70014"></td>
            </tr>
        </table>
        <table class="tbl-xs" id="extra_mb"></table>
        <div class="view-result clearfix">
            <div class="big-share-like">
                <div class="share-like clearfix">
                    <a class="span-dvo" href="<?php echo $uri_root ?>do-ve-so.html">&nbsp;</a>
                    <a class="span-quayxs last" href="<?php echo $uri_root ?>cung-quay-xo-so.html">&nbsp;</a>                
                </div>
                <div class="share-like mt5 clearfix">
                    <a rel="nofollow" href="<?php echo $url_facebook ?>" title="Facebook" target="_blank" class="share-f">&nbsp;</a>
                    <a rel="nofollow" href="<?php echo $url_google ?>" title="Google" target="_blank" class="share-g">&nbsp;</a>
                    <a rel="nofollow" href="<?php echo $url_yahoo ?>" title="Yahoo" target="_blank" class="share-yahoo">&nbsp;</a>
                    <a rel="nofollow" href="<?php echo $url_email ?>" title="Email" target="_blank" class="share-email last">&nbsp;</a>
                </div>
            </div>
        </div>
        <div class="tit-xs clearfix">
            <strong class="title-xs">Loto trực tiếp Miền Bắc</strong>
        </div>
        <table class="tbl-xs">
            <tr class="lotorow1"></tr>
            <tr class="lotorow2"></tr>
            <tr class="lotorow3"></tr>
        </table>
    </div>
<?php } ?>
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
    var counter=<?php echo $counter ?>;var checkTime=3000;var clockTime=1000;var timerCheck;var timerClock=setInterval("clockUpdate();",clockTime);<?php if ($time < $time_end) { ?>timerCheck=setInterval("checkUpdate();",checkTime);<?php } ?>
    function clockUpdate(){if(counter>-1){mb=countDown(counter);counter=mb.time;$("#xstt .hour").html(mb.hour);$("#xstt .min").html(mb.min);$("#xstt .sec").html(mb.sec)}else{timerCheck=setInterval("checkUpdate();",checkTime);clearInterval(timerClock)}}
    function countDown(f){f=f-clockTime;var a=Math.floor(f/(1000*60*60));var e=Math.floor(f/(1000*60));var c=Math.floor(f/1000);var b=e-a*60;var d=c-e*60;if(a<0){b="00"}else{if(b<10){b="0"+b}}if(a<0){d="00"}else{if(d<10){d="0"+d}}if(a<0){a="00"}else{if(a<10){a="0"+a}}return Object({hour:a,min:b,sec:d,time:f})}
    function checkUpdate(){
        if(counter<=0){
<?php
if ($area == 'MB') {
    $url_sv1 = 'http://www.xoso.com/xstt/xsmb.php';
    $url_sv2 = 'http://www.xoso.com/xstt/xsmb.php';
    ?>
                    $.ajax({
                        type:"GET",
                        timeout:3000,
                        dataType:"jsonp",
                        jsonpCallback:"MB",
                        cache:true,
                        url:"<?php echo $url_sv1 ?>",
                        success:function(n){
                            if((typeof n.sec!="undefined") && n.sec=="<?php echo md5(date('d')) ?>"){
                                $("#xstt-block").html("");
                                $("#kqxs-block").html("");
                                $("#icon-load").html("");
                                $("#kqxs-mb").show();
                                var f=true;
                                if(n.status==0){f=false}
                                    
                                $.ajax({
                                    type:"GET",
                                    timeout:3000,
                                    dataType:"jsonp",
                                    jsonpCallback:"MB",
                                    cache:true,
                                    url:"<?php echo $url_sv2 ?>",
                                    success:function(H){
                                        if((typeof H.sec!="undefined") && H.sec=="<?php echo md5(date('d')) ?>"){
                                            if(n.count_b<H.count_b) n=H;
                                        }
                                    }
                                });
                                    
                                var j=["\\+\\+\\+\\+","\\+\\+\\+","\\+\\+","\\+"];
                                var t=['<img src="<?php echo img_link('count_1.gif') ?>" width="13" alt="" height="13" /><img src="<?php echo img_link('count_2.gif') ?>" width="13" alt="" height="13" /><img src="<?php echo img_link('count_3.gif') ?>" width="13" alt="" height="13" /><img src="<?php echo img_link('count_4.gif') ?>" width="13" alt="" height="13" />','<img src="<?php echo img_link('count_1.gif') ?>" width="13" alt="" height="13" /><img src="<?php echo img_link('count_2.gif') ?>" width="13" alt="" height="13" /><img src="<?php echo img_link('count_3.gif') ?>" width="13" alt="" height="13" />','<img src="<?php echo img_link('count_1.gif') ?>" width="13" alt="" height="13" /><img src="<?php echo img_link('count_2.gif') ?>" width="13" alt="" height="13" />','<img src="<?php echo img_link('count_1.gif') ?>" width="13" alt="" height="13" />'];
                                var s=n.data[0].replace(/\*\*\*\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                var e=n.data[1].replace(/\*\*\*\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                var d=n.data[2].replace(/-/g,'</strong><strong class="span-space">');
                                var d=d.replace(/\*\*\*\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                var u=n.data[3].replace(/-/g,'</strong><strong class="span-space">');
                                var u=u.replace(/\*\*\*\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                var r=n.data[4].replace(/-/g,'</strong><strong class="span-space">');
                                var r=r.replace(/\*\*\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                var p=n.data[5].replace(/-/g,'</strong><strong class="span-space">');
                                var p=p.replace(/\*\*\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                var o=n.data[6].replace(/-/g,'</strong><strong class="span-space">');
                                var o=o.replace(/\*\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                var m=n.data[7].replace(/-/g,'</strong><strong class="span-space">');
                                var m=m.replace(/\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                $.each(j,function(x,w){
                                    var y=new RegExp(w,"g");
                                    s=s.replace(y,t[x]);
                                    e=e.replace(y,t[x]);
                                    d=d.replace(y,t[x]);
                                    u=u.replace(y,t[x]);
                                    r=r.replace(y,t[x]);
                                    p=p.replace(y,t[x]);
                                    o=o.replace(y,t[x]);
                                    m=m.replace(y,t[x])
                                });
                                $("#kqxs-mb td.giaidb").html('<strong class="red font18 span-space">'+s+"</strong>");
                                $("#kqxs-mb td.giai1").html('<strong class="span-space">'+e+"</strong>");
                                $("#kqxs-mb td.giai2").html('<strong class="span-space">'+d+"</strong>");
                                $("#kqxs-mb td.giai3").html('<strong class="span-space">'+u+"</strong>");
                                $("#kqxs-mb td.giai4").html('<strong class="span-space">'+r+"</strong>");
                                $("#kqxs-mb td.giai5").html('<strong class="span-space">'+p+"</strong>");
                                $("#kqxs-mb td.giai6").html('<strong class="span-space">'+o+"</strong>");
                                $("#kqxs-mb td.giai7").html('<strong class="span-space">'+m+"</strong>");
                                $("#extra_mb").html('<tr><th class="red border-right">Đầu</th><th class="red border-right">Đuôi</th><th class="red border-right">Đầu</th><th class="red">Đuôi</th></tr>');
                                if(typeof n.extra!="undefined"){
                                    for(var l=0;l<=4;l++){
                                        if(n.extra[l]=="undefined"||n.extra[l]==null){continue}
                                        q="bg-gray";
                                        if(l%2==0){q=""}
                                        $("#extra_mb tr:last").after('<tr><td class="'+q+' first"><strong>'+l+'</strong></td><td class="'+q+' border-right">'+n.extra[l]+'</td><td class="'+q+' border-right"><strong>'+(l+5)+'</strong></td><td class="'+q+'">'+n.extra[l+5]+"</td></tr>")
                                    }
                                }
                                var k=8;var h=17;var g=26;var q="";
                                $("#kqxs-mb tr.lotorow1").html("");
                                $("#kqxs-mb tr.lotorow2").html("");
                                $("#kqxs-mb tr.lotorow3").html("");
                                for(var l=0;l<=k;l++){
                                    if(n.data_b[l]=="undefined"||n.data_b[l]==null){continue}
                                    q="border-right";
                                    if(l==k){q=""}
                                    $("#kqxs-mb tr.lotorow1").append('<td class="'+q+'"><strong>'+n.data_b[l]+"</strong></td>")
                                }
                                for(var l=(k+1);l<=h;l++){
                                    if(n.data_b[l]=="undefined"||n.data_b[l]==null){continue}
                                    q="border-right";
                                    if(l==h){q=""}
                                    $("#kqxs-mb tr.lotorow2").append('<td class="'+q+'"><strong>'+n.data_b[l]+"</strong></td>")
                                }
                                for(var l=(h+1);l<=g;l++){
                                    if(n.data_b[l]=="undefined"||n.data_b[l]==null){continue}
                                    q="border-right";
                                    if(l==g){q=""}
                                    $("#kqxs-mb tr.lotorow3").append('<td class="'+q+'"><strong>'+n.data_b[l]+"</strong></td>")
                                }
                                if(f==true){clearInterval(timerCheck)}
                            }
                        },
                        error: function (request, status, error) {
                            $.ajax({
                                type:"GET",
                                timeout:3000,
                                dataType:"jsonp",
                                jsonpCallback:"MB",
                                cache:true,
                                url:"<?php echo $url_sv2 ?>",
                                success:function(n){
                                    if((typeof n.sec!="undefined") && n.sec=="<?php echo md5(date('d')) ?>"){
                                        $("#xstt-block").html("");
                                        $("#kqxs-block").html("");
                                        $("#icon-load").html("");
                                        $("#kqxs-mb").show();
                                        var f=true;
                                        if(n.status==0){f=false}
                                        var j=["\\+\\+\\+\\+","\\+\\+\\+","\\+\\+","\\+"];
                                        var t=['<img src="<?php echo img_link('count_1.gif') ?>" width="13" alt="" height="13" /><img src="<?php echo img_link('count_2.gif') ?>" width="13" alt="" height="13" /><img src="<?php echo img_link('count_3.gif') ?>" width="13" alt="" height="13" /><img src="<?php echo img_link('count_4.gif') ?>" width="13" alt="" height="13" />','<img src="<?php echo img_link('count_1.gif') ?>" width="13" alt="" height="13" /><img src="<?php echo img_link('count_2.gif') ?>" width="13" alt="" height="13" /><img src="<?php echo img_link('count_3.gif') ?>" width="13" alt="" height="13" />','<img src="<?php echo img_link('count_1.gif') ?>" width="13" alt="" height="13" /><img src="<?php echo img_link('count_2.gif') ?>" width="13" alt="" height="13" />','<img src="<?php echo img_link('count_1.gif') ?>" width="13" alt="" height="13" />'];
                                        var s=n.data[0].replace(/\*\*\*\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                        var e=n.data[1].replace(/\*\*\*\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                        var d=n.data[2].replace(/-/g,'</strong><strong class="span-space">');
                                        var d=d.replace(/\*\*\*\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                        var u=n.data[3].replace(/-/g,'</strong><strong class="span-space">');
                                        var u=u.replace(/\*\*\*\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                        var r=n.data[4].replace(/-/g,'</strong><strong class="span-space">');
                                        var r=r.replace(/\*\*\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                        var p=n.data[5].replace(/-/g,'</strong><strong class="span-space">');
                                        var p=p.replace(/\*\*\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                        var o=n.data[6].replace(/-/g,'</strong><strong class="span-space">');
                                        var o=o.replace(/\*\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                        var m=n.data[7].replace(/-/g,'</strong><strong class="span-space">');
                                        var m=m.replace(/\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                        $.each(j,function(x,w){
                                            var y=new RegExp(w,"g");
                                            s=s.replace(y,t[x]);
                                            e=e.replace(y,t[x]);
                                            d=d.replace(y,t[x]);
                                            u=u.replace(y,t[x]);
                                            r=r.replace(y,t[x]);
                                            p=p.replace(y,t[x]);
                                            o=o.replace(y,t[x]);
                                            m=m.replace(y,t[x])
                                        });
                                        $("#kqxs-mb td.giaidb").html('<strong class="red font18 span-space">'+s+"</strong>");
                                        $("#kqxs-mb td.giai1").html('<strong class="span-space">'+e+"</strong>");
                                        $("#kqxs-mb td.giai2").html('<strong class="span-space">'+d+"</strong>");
                                        $("#kqxs-mb td.giai3").html('<strong class="span-space">'+u+"</strong>");
                                        $("#kqxs-mb td.giai4").html('<strong class="span-space">'+r+"</strong>");
                                        $("#kqxs-mb td.giai5").html('<strong class="span-space">'+p+"</strong>");
                                        $("#kqxs-mb td.giai6").html('<strong class="span-space">'+o+"</strong>");
                                        $("#kqxs-mb td.giai7").html('<strong class="span-space">'+m+"</strong>");
                                        $("#extra_mb").html('<tr><th class="red border-right">Đầu</th><th class="red border-right">Đuôi</th><th class="red border-right">Đầu</th><th class="red">Đuôi</th></tr>');
                                        if(typeof n.extra!="undefined"){
                                            for(var l=0;l<=4;l++){
                                                if(n.extra[l]=="undefined"||n.extra[l]==null){continue}
                                                q="bg-gray";
                                                if(l%2==0){q=""}
                                                $("#extra_mb tr:last").after('<tr><td class="'+q+' first"><strong>'+l+'</strong></td><td class="'+q+' border-right">'+n.extra[l]+'</td><td class="'+q+' border-right"><strong>'+(l+5)+'</strong></td><td class="'+q+'">'+n.extra[l+5]+"</td></tr>")
                                            }
                                        }
                                        var k=8;var h=17;var g=26;var q="";
                                        $("#kqxs-mb tr.lotorow1").html("");
                                        $("#kqxs-mb tr.lotorow2").html("");
                                        $("#kqxs-mb tr.lotorow3").html("");
                                        for(var l=0;l<=k;l++){
                                            if(n.data_b[l]=="undefined"||n.data_b[l]==null){continue}
                                            q="border-right";
                                            if(l==k){q=""}
                                            $("#kqxs-mb tr.lotorow1").append('<td class="'+q+'"><strong>'+n.data_b[l]+"</strong></td>")
                                        }
                                        for(var l=(k+1);l<=h;l++){
                                            if(n.data_b[l]=="undefined"||n.data_b[l]==null){continue}
                                            q="border-right";
                                            if(l==h){q=""}
                                            $("#kqxs-mb tr.lotorow2").append('<td class="'+q+'"><strong>'+n.data_b[l]+"</strong></td>")
                                        }
                                        for(var l=(h+1);l<=g;l++){
                                            if(n.data_b[l]=="undefined"||n.data_b[l]==null){continue}
                                            q="border-right";
                                            if(l==g){q=""}
                                            $("#kqxs-mb tr.lotorow3").append('<td class="'+q+'"><strong>'+n.data_b[l]+"</strong></td>")
                                        }
                                        if(f==true){clearInterval(timerCheck)}
                                    }
                                }
                            });
                        }
                    });
<?php } else { ?>
                $.ajax({type:"GET",timeout:3000,url:"<?php echo $uri_root . 'xstt/' . $area . '?t=' . $timer; ?>",success:function(d){if(d!=1){$("#xstt-block").html(d);$("#kqxs-block").html("");$("#icon-load").html("")}}});
<?php } ?>
        }
    };
    $(document).ready(function(a){
        clockUpdate();checkUpdate();
<?php if ($time < $time_end) { ?>$.ajax({type:"GET",timeout:3000,url:"<?php echo $uri_root . 'xstt/' . $area . '?t=' . $timer; ?>",success:function(a){if(a!=1){$("#kqxs-block").html(a)}}});<?php } ?>
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