<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Thảo luận, dự đoán loto trên mobile" />
<meta name="keywords" content="dự đoán loto, du doan loto" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>Thao luan, du doan loto tren mobile</title>
<?php
		$url = $_SERVER["SCRIPT_URI"];
		$url = str_replace('m.xoso.com', 'www.xoso.com', $url);
		$url = str_replace('http://xoso.com', 'http://www.xoso.com', $url);
		$url = preg_replace('/\.html.*$/is', '.html', $url);
		echo "<link rel=\"canonical\" href=\"".$url."\" />";
		?>
<link type="image/x-icon" href="<?php echo img_link('favicon.ico'); ?>" rel="shortcut icon" />
<link type="text/css" rel="stylesheet" href="<?php echo $uri_root ?>min/g=css1411" />
<script type="text/javascript" src="<?php echo $uri_root ?>min/g=js1411"></script>
<script type="text/javascript">var uri_root='<?php echo $uri_root ?>';</script>
<meta name="apple-touch-fullscreen" content="YES" />
<script type='text/javascript'>
var googletag=googletag||{};googletag.cmd=googletag.cmd||[];(function(){var gads=document.createElement('script');gads.async=true;gads.type='text/javascript';var useSSL='https:'==document.location.protocol;gads.src=(useSSL?'https:':'http:')+'//www.googletagservices.com/tag/js/gpt.js';var node=document.getElementsByTagName('script')[0];node.parentNode.insertBefore(gads,node)})();
googletag.cmd.push(function() {
googletag.defineSlot('/35883025/xsm_b', [300, 250], 'div-gpt-ad-1388469943220-0').addService(googletag.pubads());
googletag.defineSlot('/35883025/xsm_top', [320, 100], 'div-gpt-ad-1388469943220-1').addService(googletag.pubads());
googletag.defineSlot('/35883025/xsm_b2', [336, 280], 'div-gpt-ad-1388469943220-2').addService(googletag.pubads());
googletag.pubads().enableSingleRequest();
googletag.enableServices();
});
</script>
<style type="text/css">
    #rightmenu,.header-menu{right:auto;left:0}
    #userbox{text-align:right;color:#fff;padding-right:10px}
    #userbox a.login-icon{color:#fff}
</style>
</head>
<body>
<div id="wrapper">
<?php echo $c_module == 'home' ? '<h1 style="position: absolute; text-indent: -99999px">'.$_meta['title'].'</h1>' : '' ?>
<div class="header clearfix">
<div class="header_inner">
<div id="userbox"></div>
<script type="text/javascript">var uid='';var curruser='';var user='';var taikhoan='';function loadst(){$.ajax({url:uri_root+"client/user/loadst",cache:false,success:function (c){var objuser=jQuery.parseJSON(c);uid=objuser.id;curruser=objuser.username;user=objuser.fullname;taikhoan=objuser.taikhoan;$(".hello").html('Xin chào:<br/><strong>'+curruser+'</strong>');$("#taikhoanloto").html(taikhoan);$("#userbox").html(objuser.strlogin);}});}loadst();</script>
<div class="header-menu"><a href="javascript:;" id="showmenu" onclick="xsmobile.rightmenu();return false;">Danh mục</a></div>
</div>
</div>
<div class="banner_top"><img id="banner_top" src="<?php echo img_link('xoso_logo_3.gif'); ?>" width="320" /></div>

<div id='div-gpt-ad-1388469943220-1'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1388469943220-1'); });
</script>
</div>
<script type="text/javascript" src="http://xoso.gsspcln.jp/sdk/t/17667.js"></script>

<div class="content">    
<?php 
//$tttt_mb = true;
//$tttt_mt = true;
//$tttt_mn = true;
if ($tttt_mb || $tttt_mt || $tttt_mn) {
    echo '<script type="text/javascript" src="' . js_link('jquery-blink.js') . '"></script>';
    if ($tttt_mb) {
        echo '<div class="tttt_link"><a class="tttt_blink" href="' . $uri_root . 'tuong-thuat-truc-tiep-ket-qua-xo-so/mien-bac.html">Tường thuật trực tiếp Xổ Số Miền Bắc</a></div>';
    } elseif ($tttt_mt) {
        echo '<div class="tttt_link"><a class="tttt_blink" href="' . $uri_root . 'tuong-thuat-truc-tiep-ket-qua-xo-so/mien-trung.html">Tường thuật trực tiếp Xổ Số Miền Trung</a></div>';
    } else {
        echo '<div class="tttt_link"><a class="tttt_blink" href="' . $uri_root . 'tuong-thuat-truc-tiep-ket-qua-xo-so/mien-nam.html">Tường thuật trực tiếp Xổ Số Miền Nam</a></div>';
    }
    echo "<script type=\"text/javascript\">$(document).ready(function() { $('.tttt_blink').blink({delay:100});});</script>";
}
$this->load->view($tmpl);
?>
</div>

<div id='div-gpt-ad-1388469943220-0' style='width:300px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1388469943220-0'); });
</script>
</div>
<script type="text/javascript" src="http://xoso.gsspcln.jp/sdk/t/17668.js"></script>

<div class="gadgets"><h2 class="thong-ke" id="thong-ke">Thống kê</h2></div>
<ul class="xs-menu">
<li><h3><a class="tklanxh" href="<?php echo $uri_root ?>thongke-dau-duoi-0-9.html"><span>Thống kê số lần xuất hiện</span></a></h3></li>
<li><h3><a class="tkdauduoi" href="<?php echo $uri_root ?>thong-ke-lo-to-theo-dau-duoi.html"><span>Thống kê đầu đuôi</span></a></h3></li>
<li><h3><a class="tk0099" href="<?php echo $uri_root ?>thong-ke-cap-so-tu-00-99.html"><span>Thống kê 00 - 99</span></a></h3></li>
<li><h3><a class="thongke" href="<?php echo $uri_root ?>thong-ke-quan-trong.html"><span>Thống kê quan trọng</span></a></h3></li>
<li><h3><a class="logan" href="<?php echo $uri_root ?>thong-ke-lo-gan.html"><span>Thống kê Loto gan</span></a></h3></li>
</ul>
<div class="gadgets"><h2>Sớ đầu đuôi</h2></div>
<ul class="xs-menu">
<li><h3><a href="<?php echo $uri_root ?>so-dau-duoi/mien-nam.html"><span>Sớ Miền Nam</span></a></h3></li>
<li><h3><a href="<?php echo $uri_root ?>so-dau-duoi/mien-bac.html"><span>Sớ Miền Bắc</span></a></h3></li>                        
<li><h3><a href="<?php echo $uri_root ?>so-dau-duoi/mien-trung.html"><span>Sớ Miền Trung</span></a></h3></li>
</ul>
<div class="gadgets"><h2>Tiện ích</h2></div>
<ul class="xs-menu">
<li><h3><a class="ketqua" href="<?php echo $uri_root ?>ket-qua.html"><span>Kết quả</span></a></h3></li>
<li><h3><a class="tttt" href="<?php echo $uri_root ?>tuong-thuat-truc-tiep-ket-qua-xo-so.html"><span>Tường thuật trực tiếp</span></a></h3></li>
<li><h3><a class="dove" href="<?php echo $uri_root ?>do-ve-so.html"><span>Dò Vé</span></a></h3></li>
<li><h3><a class="quayxs" href="<?php echo $uri_root ?>quay-so-may-man.html"><span>Quay số may mắn</span></a></h3></li>
<li><h3><a href="http://www.xoso.com/in-ve-do.html?ck=1"><span>In vé dò</span></a></h3></li>
</ul>
<div class="gadgets"><h2>Cài đặt Xổ Số</h2></div>
<div class="caidatxs">
<div>- Hiển thị ưu tiên Kết quả xổ số Miền Bắc » <a href="<?php echo $uri_root ?>?ck=1">Bấm đây để xem</a></div>
<div>- Hiển thị ưu tiên Kết quả xổ số Miền Nam » <a href="<?php echo $uri_root ?>?ck=2">Bấm đây để xem</a></div>
<div>- Hiển thị ưu tiên Kết quả xổ số Miền Trung » <a href="<?php echo $uri_root ?>?ck=3">Bấm đây để xem</a></div>
</div>
<div class="gadgets mb10"><h2>Tải ứng dụng Xổ Số</h2></div>
<div class="t-cen mb10">
<a target="_blank" href="https://itunes.apple.com/vn/app/xo-so/id505057507?mt=8"><img width="130" src="<?php echo img_link('apple_en.png') ?>" /></a>
&nbsp;<a target="_blank" href="https://play.google.com/store/apps/details?id=com.bhmedia.xosocom"><img width="130" src="<?php echo img_link('android_en.png') ?>" /></a>
</div>
<div class="mb10 clearfix"></div>

<div id='div-gpt-ad-1388469943220-2' style='width:316px;margin:7px auto;overflow:hidden'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1388469943220-2'); });
</script>
</div>

<div class="mb10 clearfix"></div>
<div id="rightmenu" style="display: none;">
<div class="element">
<h3><a href="javascript:;">User</a></h3>
<a class="close-bt" onclick="xsmobile.rightmenu();return false;" href="javascript:;">Đóng</a>
<ul id="user_ul">
<li><a<?php echo $c_module == 'user' && $c_func == 'register' ? ' class="active"' : '' ?> href="<?php echo $uri_root ?>dang-ky.html"><span>Đăng ký</span></a></li>
<li><a<?php echo $c_module == 'user' && $c_func == 'login' ? ' class="active"' : '' ?> href="<?php echo $uri_root ?>dang-nhap.html"><span>Đăng nhập</span></a></li>
</ul>
<script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function(){
        if(uid!=''){
            $("#user_ul").html('<li><a<?php echo $c_module == 'user' && $c_func == 'update_info' ? ' class="active"' : '' ?> href="<?php echo $uri_root ?>cap-nhat-thong-tin-ca-nhan.html"><span>Thông tin</span></a></li>'
            +'<li><a<?php echo $c_module == 'loto_online' ? ' class="active"' : '' ?> href="<?php echo $uri_root ?>loto-online.html"><span>Tài khoản</span></a></li>'
            +'<li><a href="<?php echo $uri_root ?>dang-xuat.html"><span>Đăng xuất</span></a></li>'
            );
        }
        },1000);
    });
</script>
</div>
<div class="element">
<h3><a href="javascript:;">Dự đoán Xổ Số</a></h3>
<ul>
<li><a<?php echo $c_module == 'chat' && $c_func == 'index' ? ' class="active"' : '' ?> href="<?php echo $uri_root ?>giao-luu-thao-luan-chot-so-lotto.html">Dự đoán Xổ Số</a></li>
<li><a<?php echo $c_module == 'chat' && $c_func == 'chotso' ? ' class="active"' : '' ?> href="<?php echo $uri_root ?>chot-so-lotto.html">Chốt Số</a></li>
</ul>
</div>
<div class="element">
<h3><a href="javascript:;">Soi cầu - Thống kê</a></h3>
<ul>
<li><a<?php echo $c_module == 'soicaunew' && !isset($_GET['setmode']) || $c_module == 'soicaunew' && $_GET['setmode'] == 'full' ? ' class="active"' : '' ?> href="<?php echo $uri_root ?>soi-cau.html"><span>Soi cầu toàn diện</span></a></li>
<li><a<?php echo $c_module == 'soicaunew' && $_GET['setmode'] == 'num' ? ' class="active"' : '' ?> href="<?php echo $uri_root ?>soi-cau.html?setmode=num"><span>Tìm cầu cho cặp số</span></a></li>
<li><a<?php echo $c_module == 'chat' && $c_func == 'thongke' ? ' class="active"' : '' ?> href="<?php echo $uri_root ?>thong-ke-hom-nay.html"><span>Thống kê hôm nay</span></a></li>
</ul>
</div>
</div>
<div class="footer">
<div>&copy; 2014 Xoso.com</div>
<div><a href="<?php echo $uri_root ?>">Mobile version</a> - <a href="http://www.xoso.com/<?php echo $uri_string?>?ck=1">Desktop version</a></div>
<div class="footer-home"><a href="<?php echo $uri_root ?>">Trang chủ</a></div>
<div class="footer-top"><a href="#wrapper">Top</a></div>                
</div>
</div>
<script type="text/javascript">
$( document ).ready(function() {
var width = $(window).width();
$("#banner_top").attr('width',width);
var height = $("#banner_top").height();
if(60+height>210) height=170;
$("#wrapper").css('padding-top',60+height);
});
</script>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle" style="display:none" data-ad-client="ca-pub-1447277143699738" data-reactive-ad-format="1"  data-ad-channel="6729070649"></ins>
<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-31260907-1', 'xoso.com');
ga('require', 'displayfeatures');
ga('send', 'pageview');
</script>
</body>
</html>