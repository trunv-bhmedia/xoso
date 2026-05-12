<?php
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
$counter = strtotime(date($timer)) - $current;
$today = date('d/m/Y', time());
?>
<br/>
<h1 style="position:absolute;text-indent:-99999px">TRỰC TIẾP XỔ SỐ <?php echo $title ?></h1>
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
    <div class="title title-red">
        <div class="title-right">Thông báo</div>
    </div>
    <div class="box-result">
        <div class="box-information">
            <p class="font18 red"><strong><?php if ($counter > 0) { ?>Hiện tại không phải giờ xổ số!!!<?php } else { ?>Tường thuật trực tiếp kết quả xổ số<?php } ?></strong></p>
            <?php if ($area != 'MB') { ?>
                <p>
                    Lịch quay số mở thưởng ngày <?php echo $today ?><br />
                    <span class="red">
                        <?php
                        foreach ($location_today[$area] as $k => $v)
                            echo($k == 0 ? '' : ' - ') . $v->name;
                        ?>
                    </span>
                </p>
                <?php
            }
            if ($counter > 0) {
                ?>
                <p class="red">
                    <strong>Đang chờ đến giờ xổ số <?php echo $title2 ?></strong>
                </p>
            <?php } ?>
            <div id="xsttclock"></div>
            <p>Kết quả xổ số toàn quốc tự động cập nhật liên tục từng giải như ngồi xem trước hội trường xổ số trong suốt quá trình mở thưởng từ hệ thống máy chủ kết nối dữ liệu trực tuyến của xoso.com (không cần refresh)<strong class="red"> - Kính chúc quý khách may mắn phát tài!</strong></p>
        </div>
    </div>
    <div class="line-red mb10">&nbsp;</div>
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
        <div class="title title-red">
            <div class="title-right">TRỰC TIẾP XỔ SỐ ĐIỆN TOÁN - <?php echo $date; ?></div>
        </div>
        <div class="box-result">
            <table class="tbl-result" id="tbl_xsdt"></table>
        </div>
        <div class="line-red mb10">&nbsp;</div>
        <div class="title title-red">
            <div class="title-right clearfix"><strong class="left">TRỰC TIẾP XỔ SỐ <?php echo($l_area); ?> - <?php echo $date; ?></strong>
                <a href="<?php echo $uri_root . $url_mienbac ?>.html" class="right view-table">Xem chi tiết <span>&nbsp;</span></a>
            </div>
        </div>
        <div class="box-result">
            <div class="page-title">Xổ Số Miền Bắc - <?php echo($days[$datew]); ?> ngày <?php echo $date; ?></div>
            <table class="tbl-tt">
                <tr>
                    <td class="bg-gray border-right">Giải đặc biệt</td>
                    <td class="bg-gray border-right giaidb"></td>
                    <td rowspan="7" class="td-sub">
                        <table class="tbl-dd" id="extra_mb"></table>
                    </td>
                </tr>
                <tr>
                    <td class="border-right">Giải nhất</td>
                    <td class="border-right giai1 font70014"></td>
                </tr>
                <tr>
                    <td class="bg-gray border-right">Giải nhì</td>
                    <td class="bg-gray border-right giai2 font70014"></td>
                </tr>
                <tr>
                    <td class="border-right">Giải ba</td>
                    <td class="border-right giai3 font70014"></td>
                </tr>
                <tr>
                    <td class="bg-gray border-right">Giải tư</td>
                    <td class="bg-gray border-right giai4 font70014"></td>
                </tr>
                <tr>
                    <td class="border-right">Giải năm</td>
                    <td class="border-right giai5 font70014"></td>
                </tr>
                <tr>
                    <td class="bg-gray border-right">Giải sáu</td>
                    <td class="bg-gray border-right giai6 font70014"></td>
                </tr>
                <tr>
                    <td class="border-right">Giải bảy</td>
                    <td class="border-right giai7 font70014"></td>
                    <td></td>
                </tr>
            </table>
        </div>
        <div class="line-red">&nbsp;</div>
        <ul class="list-editor space1">
            <li>Để nhận kết quả xổ số <strong>Miền Bắc</strong> sớm nhất, soạn tin <span>KQ MB</span> gửi <span>8017</span></li>
        </ul>
        <div class="tabs-note col3 clearfix">
            <a class="span-in" target="_blank" href="<?php echo $uri_root ?>in-ve-do.html?l=1&amp;d=<?php echo $date_ve_do ?>&amp;t=2">&nbsp;</a>
            <a class="span-dvo" href="<?php echo $uri_root ?>do-ve-so.html">&nbsp;</a>
            <a class="span-quayxs" href="<?php echo $uri_root ?>cung-quay-xo-so.html">&nbsp;</a>
            <a class="span-vs" href="<?php echo $uri_root ?>ve-so-mien-bac.html">&nbsp;</a>
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
        <div class="title title-red">
            <div class="title-right clearfix"><strong>Loto trực tiếp Miền Bắc</strong>
            </div>
        </div>
        <div class="box-result">
            <table class="tbl-tt">
                <tr class="lotorow1"></tr>
                <tr class="lotorow2"></tr>
                <tr class="lotorow3"></tr>
            </table>
        </div>
        <div class="line-red mb10">&nbsp;</div>
    </div>
<?php } ?>
<div id="kqxs-block"></div>
<div id='div-gpt-ad-1378288615889-1' style='width:336px' class="mainmenu">
    <script type='text/javascript'>googletag.cmd.push(function(){googletag.display("div-gpt-ad-1378288615889-1")});</script>
</div>
<br/>
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
            Trong thời điểm quay thưởng, số lượng truy cập tới hệ thống XOSO.COM là rất lớn, có những lúc có thể bị gián đoạn dữ liệu, nhưng hệ thống luôn luôn ưu tiên tác vụ tại thời điểm đó, để đảm bảo kết quả được gửi về sớm nhất có thể.
        </div>
    </div>
</div>
<script type="text/javascript">
    /*<![CDATA[*/
    var counter=<?php echo $counter ?>;
    var timerCheck=setInterval("checkUpdate();",3000);
    function checkUpdate(){
        if(counter<=0){
<?php
if ($area == 'MB') {
    $url_sv1 = $uri_root . 'xstt/xsmb.php';
    $url_sv2 = 'http://www.xoso.com/xstt/xsmb.php';
    ?>
                    $.ajax({
                        type:"GET",
                        timeout:3000,
                        dataType:"jsonp",
                        jsonpCallback:"MB",
                        cache:true,
                        url:"<?php echo $url_sv1 ?>",
                        success:function(H){
                            if((typeof H.sec!="undefined") && H.sec=="<?php echo md5(date('d')) ?>"){
                                $("#xstt-block").html("");
                                $("#kqxs-block").html("");
                                $("#icon-load").html("");
                                $("#kqxs-mb").show();
                                var I=true;
                                if(H.status==0){I=false}
                                $("#tbl_xsdt").html("");
                                                            
                                $.ajax({
                                    type:"GET",
                                    timeout:3000,
                                    dataType:"jsonp",
                                    jsonpCallback:"MB",
                                    cache:true,
                                    url:"<?php echo $url_sv2 ?>",
                                    success:function(n){
                                        if((typeof n.sec!="undefined") && n.sec=="<?php echo md5(date('d')) ?>"){
                                            if(H.count_b<n.count_b) H=n;
                                        }
                                    }
                                });
                                        
                                if(typeof H.dt6x36!="undefined"){
                                    $("#tbl_xsdt").append('<tr><td class="bg-gray first"><strong class="left">Kết quả xổ số điện toán 6x36</strong><span class="right">Mở thưởng <?php echo $days[$datew] ?> ngày <?php echo $date; ?></span></td></tr><tr><td class="td-sub"><table id="dt6x36"><tr><td class="t-right"><a href="<?php echo $uri_root ?>xo-so-dien-toan/6X36/<?php echo $date_ve_do ?>.html" class="read-more"><span>Xem thêm</span></a></td></tr></table></td></tr>');
                                    H.dt6x36.forEach(function(d){$("#dt6x36 tr:first td:last").before('<td class="red font24 t-cen"><strong>'+d+"</strong></td>")}
                                )}
                                if(typeof H.dt123!="undefined"){
                                    $("#tbl_xsdt").append('<tr><td class="bg-gray first"><strong class="left">Kết quả xổ số điện toán 1*2*3</strong><span class="right">Mở thưởng <?php echo $days[$datew] ?> ngày <?php echo $date; ?></span></td></tr><tr><td class="td-sub"><table class="tbl-sub" id="dt123"><tr><td class="t-right"><a href="<?php echo $uri_root ?>xo-so-dien-toan/1*2*3/<?php echo $date_ve_do ?>.html" class="read-more"><span>Xem thêm</span></a></td></tr></table></td></tr>');
                                    H.dt123.forEach(function(d){$("#dt123 tr:first td:last").before('<td class="red font24 t-cen"><strong>'+d+"</strong></td>")}
                                )}
                                if(typeof H.dtthantai4!="undefined"){
                                    $("#tbl_xsdt").append('<tr><td class="bg-gray first"><strong class="left">Kết quả xổ số Thần tài</strong><span class="right">Mở thưởng <?php echo $days[$datew] ?> ngày <?php echo $date; ?></span></td></tr><tr><td class="td-sub"><table class="tbl-sub"><tr><td class="red font24 t-cen"><strong>'+H.dtthantai4+'</strong></td><td class="t-right"><a href="<?php echo $uri_root ?>xo-so-dien-toan/than-tai/<?php echo $date_ve_do ?>.html" class="read-more"><span>Xem thêm</span></a></td></tr></table></td></tr>')
                                }
                                var F=["\\+\\+\\+\\+","\\+\\+\\+","\\+\\+","\\+"];
                                var A=['<img src="<?php echo img_link('count_1.gif') ?>" width="13" alt="" height="13" /><img src="<?php echo img_link('count_2.gif') ?>" width="13" alt="" height="13" /><img src="<?php echo img_link('count_3.gif') ?>" width="13" alt="" height="13" /><img src="<?php echo img_link('count_4.gif') ?>" width="13" alt="" height="13" />','<img src="<?php echo img_link('count_1.gif') ?>" width="13" alt="" height="13" /><img src="<?php echo img_link('count_2.gif') ?>" width="13" alt="" height="13" /><img src="<?php echo img_link('count_3.gif') ?>" width="13" alt="" height="13" />','<img src="<?php echo img_link('count_1.gif') ?>" width="13" alt="" height="13" /><img src="<?php echo img_link('count_2.gif') ?>" width="13" alt="" height="13" />','<img src="<?php echo img_link('count_1.gif') ?>" width="13" alt="" height="13" />'];
                                var J=H.data[0].replace(/\*\*\*\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                var x=H.data[1].replace(/\*\*\*\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                var y=H.data[2].replace(/-/g,'</strong><strong class="span-space">');
                                var y=y.replace(/\*\*\*\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                var z=H.data[3].replace(/-/g,'</strong><strong class="span-space">');
                                var z=z.replace(/\*\*\*\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                var B=H.data[4].replace(/-/g,'</strong><strong class="span-space">');
                                var B=B.replace(/\*\*\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                var C=H.data[5].replace(/-/g,'</strong><strong class="span-space">');
                                var C=C.replace(/\*\*\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                var D=H.data[6].replace(/-/g,'</strong><strong class="span-space">');
                                var D=D.replace(/\*\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                var E=H.data[7].replace(/-/g,'</strong><strong class="span-space">');
                                var E=E.replace(/\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                $.each(F,function(d,e){
                                    var f=new RegExp(e,"g");
                                    J=J.replace(f,A[d]);
                                    x=x.replace(f,A[d]);
                                    y=y.replace(f,A[d]);
                                    z=z.replace(f,A[d]);
                                    B=B.replace(f,A[d]);
                                    C=C.replace(f,A[d]);
                                    D=D.replace(f,A[d]);
                                    E=E.replace(f,A[d])
                                });
                                $("#kqxs-mb td.giaidb").html('<strong class="red font18 span-space">'+J+"</strong>");
                                $("#kqxs-mb td.giai1").html('<strong class="span-space">'+x+"</strong>");
                                $("#kqxs-mb td.giai2").html('<strong class="span-space">'+y+"</strong>");
                                $("#kqxs-mb td.giai3").html('<strong class="span-space">'+z+"</strong>");
                                $("#kqxs-mb td.giai4").html('<strong class="span-space">'+B+"</strong>");
                                $("#kqxs-mb td.giai5").html('<strong class="span-space">'+C+"</strong>");
                                $("#kqxs-mb td.giai6").html('<strong class="span-space">'+D+"</strong>");
                                $("#kqxs-mb td.giai7").html('<strong class="span-space">'+E+"</strong>");
                                $("#extra_mb").html('<tr><th class="first">Đầu</th><th class="last">Đuôi</th></tr>');
                                if(typeof H.extra!="undefined"){
                                    $.each(H.extra,function(d,e){$("#extra_mb tr:last").after('<tr><td class="first">'+d+"</td><td>"+e+"</td></tr>")}
                                )}
                                var i=8;var v=17;var w=26;var G="";
                                $("#kqxs-mb tr.lotorow1").html("");
                                $("#kqxs-mb tr.lotorow2").html("");
                                $("#kqxs-mb tr.lotorow3").html("");
                                for(var K=0;K<=i;K++){
                                    if(H.data_b[K]=="undefined"||H.data_b[K]==null){continue}
                                    G="border-right t-cen";
                                    if(K==i){G="last t-cen"}
                                    $("#kqxs-mb tr.lotorow1").append('<td class="'+G+'"><strong>'+H.data_b[K]+"</strong></td>")
                                }
                                for(var K=(i+1);K<=v;K++){
                                    if(H.data_b[K]=="undefined"||H.data_b[K]==null){continue}
                                    G="border-right t-cen";
                                    if(K==v){G="last t-cen"}
                                    $("#kqxs-mb tr.lotorow2").append('<td class="'+G+'"><strong>'+H.data_b[K]+"</strong></td>")
                                }
                                for(var K=(v+1);K<=w;K++){
                                    if(H.data_b[K]=="undefined"||H.data_b[K]==null){continue}
                                    G="border-right t-cen";
                                    if(K==w){G="last t-cen"}
                                    $("#kqxs-mb tr.lotorow3").append('<td class="'+G+'"><strong>'+H.data_b[K]+"</strong></td>")
                                }
                                if(I==true){clearInterval(timerCheck)}
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
                                success:function(H){
                                    if((typeof H.sec!="undefined") && H.sec=="<?php echo md5(date('d')) ?>"){
                                        $("#xstt-block").html("");
                                        $("#kqxs-block").html("");
                                        $("#icon-load").html("");
                                        $("#kqxs-mb").show();
                                        var I=true;
                                        if(H.status==0){I=false}
                                        $("#tbl_xsdt").html("");
                                                            
                                        if(typeof H.dt6x36!="undefined"){
                                            $("#tbl_xsdt").append('<tr><td class="bg-gray first"><strong class="left">Kết quả xổ số điện toán 6x36</strong><span class="right">Mở thưởng <?php echo $days[$datew] ?> ngày <?php echo $date; ?></span></td></tr><tr><td class="td-sub"><table id="dt6x36"><tr><td class="t-right"><a href="<?php echo $uri_root ?>xo-so-dien-toan/6X36/<?php echo $date_ve_do ?>.html" class="read-more"><span>Xem thêm</span></a></td></tr></table></td></tr>');
                                            H.dt6x36.forEach(function(d){$("#dt6x36 tr:first td:last").before('<td class="red font24 t-cen"><strong>'+d+"</strong></td>")}
                                        )}
                                        if(typeof H.dt123!="undefined"){
                                            $("#tbl_xsdt").append('<tr><td class="bg-gray first"><strong class="left">Kết quả xổ số điện toán 1*2*3</strong><span class="right">Mở thưởng <?php echo $days[$datew] ?> ngày <?php echo $date; ?></span></td></tr><tr><td class="td-sub"><table class="tbl-sub" id="dt123"><tr><td class="t-right"><a href="<?php echo $uri_root ?>xo-so-dien-toan/1*2*3/<?php echo $date_ve_do ?>.html" class="read-more"><span>Xem thêm</span></a></td></tr></table></td></tr>');
                                            H.dt123.forEach(function(d){$("#dt123 tr:first td:last").before('<td class="red font24 t-cen"><strong>'+d+"</strong></td>")}
                                        )}
                                        if(typeof H.dtthantai4!="undefined"){
                                            $("#tbl_xsdt").append('<tr><td class="bg-gray first"><strong class="left">Kết quả xổ số Thần tài</strong><span class="right">Mở thưởng <?php echo $days[$datew] ?> ngày <?php echo $date; ?></span></td></tr><tr><td class="td-sub"><table class="tbl-sub"><tr><td class="red font24 t-cen"><strong>'+H.dtthantai4+'</strong></td><td class="t-right"><a href="<?php echo $uri_root ?>xo-so-dien-toan/than-tai/<?php echo $date_ve_do ?>.html" class="read-more"><span>Xem thêm</span></a></td></tr></table></td></tr>')
                                        }
                                        var F=["\\+\\+\\+\\+","\\+\\+\\+","\\+\\+","\\+"];
                                        var A=['<img src="<?php echo img_link('count_1.gif') ?>" width="13" alt="" height="13" /><img src="<?php echo img_link('count_2.gif') ?>" width="13" alt="" height="13" /><img src="<?php echo img_link('count_3.gif') ?>" width="13" alt="" height="13" /><img src="<?php echo img_link('count_4.gif') ?>" width="13" alt="" height="13" />','<img src="<?php echo img_link('count_1.gif') ?>" width="13" alt="" height="13" /><img src="<?php echo img_link('count_2.gif') ?>" width="13" alt="" height="13" /><img src="<?php echo img_link('count_3.gif') ?>" width="13" alt="" height="13" />','<img src="<?php echo img_link('count_1.gif') ?>" width="13" alt="" height="13" /><img src="<?php echo img_link('count_2.gif') ?>" width="13" alt="" height="13" />','<img src="<?php echo img_link('count_1.gif') ?>" width="13" alt="" height="13" />'];
                                        var J=H.data[0].replace(/\*\*\*\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                        var x=H.data[1].replace(/\*\*\*\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                        var y=H.data[2].replace(/-/g,'</strong><strong class="span-space">');
                                        var y=y.replace(/\*\*\*\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                        var z=H.data[3].replace(/-/g,'</strong><strong class="span-space">');
                                        var z=z.replace(/\*\*\*\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                        var B=H.data[4].replace(/-/g,'</strong><strong class="span-space">');
                                        var B=B.replace(/\*\*\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                        var C=H.data[5].replace(/-/g,'</strong><strong class="span-space">');
                                        var C=C.replace(/\*\*\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                        var D=H.data[6].replace(/-/g,'</strong><strong class="span-space">');
                                        var D=D.replace(/\*\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                        var E=H.data[7].replace(/-/g,'</strong><strong class="span-space">');
                                        var E=E.replace(/\*\*/g,'<img src="<?php echo img_link('icon-xs/loading.gif') ?>" width="40" alt="" height="10" />');
                                        $.each(F,function(d,e){
                                            var f=new RegExp(e,"g");
                                            J=J.replace(f,A[d]);
                                            x=x.replace(f,A[d]);
                                            y=y.replace(f,A[d]);
                                            z=z.replace(f,A[d]);
                                            B=B.replace(f,A[d]);
                                            C=C.replace(f,A[d]);
                                            D=D.replace(f,A[d]);
                                            E=E.replace(f,A[d])
                                        });
                                        $("#kqxs-mb td.giaidb").html('<strong class="red font18 span-space">'+J+"</strong>");
                                        $("#kqxs-mb td.giai1").html('<strong class="span-space">'+x+"</strong>");
                                        $("#kqxs-mb td.giai2").html('<strong class="span-space">'+y+"</strong>");
                                        $("#kqxs-mb td.giai3").html('<strong class="span-space">'+z+"</strong>");
                                        $("#kqxs-mb td.giai4").html('<strong class="span-space">'+B+"</strong>");
                                        $("#kqxs-mb td.giai5").html('<strong class="span-space">'+C+"</strong>");
                                        $("#kqxs-mb td.giai6").html('<strong class="span-space">'+D+"</strong>");
                                        $("#kqxs-mb td.giai7").html('<strong class="span-space">'+E+"</strong>");
                                        $("#extra_mb").html('<tr><th class="first">Đầu</th><th class="last">Đuôi</th></tr>');
                                        if(typeof H.extra!="undefined"){
                                            $.each(H.extra,function(d,e){$("#extra_mb tr:last").after('<tr><td class="first">'+d+"</td><td>"+e+"</td></tr>")}
                                        )}
                                        var i=8;var v=17;var w=26;var G="";
                                        $("#kqxs-mb tr.lotorow1").html("");
                                        $("#kqxs-mb tr.lotorow2").html("");
                                        $("#kqxs-mb tr.lotorow3").html("");
                                        for(var K=0;K<=i;K++){
                                            if(H.data_b[K]=="undefined"||H.data_b[K]==null){continue}
                                            G="border-right t-cen";
                                            if(K==i){G="last t-cen"}
                                            $("#kqxs-mb tr.lotorow1").append('<td class="'+G+'"><strong>'+H.data_b[K]+"</strong></td>")
                                        }
                                        for(var K=(i+1);K<=v;K++){
                                            if(H.data_b[K]=="undefined"||H.data_b[K]==null){continue}
                                            G="border-right t-cen";
                                            if(K==v){G="last t-cen"}
                                            $("#kqxs-mb tr.lotorow2").append('<td class="'+G+'"><strong>'+H.data_b[K]+"</strong></td>")
                                        }
                                        for(var K=(v+1);K<=w;K++){
                                            if(H.data_b[K]=="undefined"||H.data_b[K]==null){continue}
                                            G="border-right t-cen";
                                            if(K==w){G="last t-cen"}
                                            $("#kqxs-mb tr.lotorow3").append('<td class="'+G+'"><strong>'+H.data_b[K]+"</strong></td>")
                                        }
                                        if(I==true){clearInterval(timerCheck)}
                                    }
                                }
                            });
                        }
                    });
<?php } else { ?>
                $.ajax({type:"GET",timeout:3000,url:"<?php echo $uri_root . 'xstt/' . $area . '?t=' . $timer; ?>",success:function(e){if(e!=1){$("#xstt-block").html(e);$("#kqxs-block").html("");$("#icon-load").html("")}}});
<?php } ?>
        }
    };
    $(document).ready(function(a){
        if(counter>0)$('#xsttclock').FlipClock(counter,{countdown: true,callbacks: {stop:function(){counter=0;timerCheck=setInterval("checkUpdate();",3000)}}});
        checkUpdate();
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