<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="<?php echo $_meta['description']?>" />
<meta name="keywords" content="<?php echo $_meta['keywords']?>" />
<title><?php echo $_meta['title']?></title>
<?php echo(isset($_meta['page']) ? $_meta['page'] : '');?>
<meta property="og:image" content="<?php echo img_link('logo.png')?>" />
<?php if($meta_refresh_mb==true && $meta_refresh_mt==true && $meta_refresh_mn==true){?>
<meta http-equiv="refresh" content="900" />
<?php }?>
<?php
$url = $_SERVER["SCRIPT_URI"];
$url = str_replace('m.xoso.com', 'www.xoso.com', $url);
$url2 = str_replace('www.xoso.com', 'm.xoso.com', $url);
$url2 = str_replace('http://xoso.com', 'http://m.xoso.com', $url2);
$url = str_replace('http://xoso.com', 'http://www.xoso.com', $url);
$url = preg_replace('/\.html.*$/is', '.html', $url);
echo "<link rel=\"canonical\" href=\"".$url."\" />";
if(strpos($url,'tin-xo-so') === false){
	echo "<link rel=\"alternate\" media=\"handheld\" href=\"".$url2."\" />";
}
?> 
<link type="image/x-icon" href="<?php echo img_link('favicon.ico')?>" rel="shortcut icon" />
<link type="text/css" rel="stylesheet" href="<?php echo $uri_root?>min/g=css1411" />
<script type="text/javascript" src="<?php echo $uri_root?>min/g=js1411"></script>
<meta name="google-site-verification" content="_MdXAARqGNM7C1GRrfqgrQg59dJuCGxL_3E4tJf_se0" />
<script type="text/javascript">/*<![CDATA[*/var uri_root="<?php echo $uri_root?>";function loadtinhright(){var a=$("#f_rangeStart_right").val();if(a==""){alert("Vui lòng nhập ngày mở thưởng trên tờ vé !");document.form_doveso_right.ngay.focus();return false}$.ajax({type:"GET",url:"<?php echo $uri_root?>loadtinhs/<?php echo $lid_right?>/"+a,success:function(b){$("#boxCity_right").html(b);$("#select_provide").selectbox()}})}$(document).ready(function(a){loadtinhright()});function dovesoright(){if($("#so_right").val()==""){alert("Nhập đủ dãy số dự thưởng trên tờ vé của bạn! (6 số hoặc 5 số không bao gồm ký tự)");document.form_doveso_right.so.focus();return false}else{if($("#so_right").val().length<5){alert("Nhập đủ dãy số dự thưởng trên tờ vé của bạn! (6 số hoặc 5 số không bao gồm ký tự)");document.form_doveso_right.so.focus();return false}else{if($("#f_rangeStart_right").val()==""){alert("Vui lòng nhập ngày mở thưởng trên tờ vé !");document.form_doveso_right.ngay.focus();return false}else{document.form_doveso_right.submit()}}}}var googletag=googletag||{};googletag.cmd=googletag.cmd||[];(function(){var a=document.createElement("script");a.async=true;a.type="text/javascript";var c="https:"==document.location.protocol;a.src=(c?"https:":"http:")+"//www.googletagservices.com/tag/js/gpt.js";var b=document.getElementsByTagName("script")[0];b.parentNode.insertBefore(a,b)})();googletag.cmd.push(function(){googletag.defineSlot("/35883025/xs_top",[970,90],"div-gpt-ad-1378288615889-0").addService(googletag.pubads());googletag.defineSlot("/35883025/xs_b1",[336,280],"div-gpt-ad-1378288615889-1").addService(googletag.pubads());googletag.defineSlot('/35883025/xs_right', [200,600], 'div-gpt-ad-1378288615889-2').addService(googletag.pubads());googletag.pubads().enableSingleRequest();googletag.enableServices()});/*]]>*/</script>
<?php if($c_module=='xoso'&&$c_func=='filter_date'&&isset($items[0])){$shared_content='Xổ Số '.$items[0]->name.' ngày '.$date.',';$shared_content.=' giải DB: '.$items[0]->a0.',';$shared_content.=' giải nhất: '.$items[0]->a1.',';$shared_content.=' giải nhì: '.$items[0]->a2.',';$shared_content.=' giải ba: '.$items[0]->a3.',';$shared_content.=' giải tư: '.$items[0]->a4.',';$shared_content.=' giải năm: '.$items[0]->a5.',';$shared_content.=' giải sáu: '.$items[0]->a6.',';$shared_content.=' giải bảy: '.$items[0]->a7;if($items[0]->area!='MB')$shared_content.=', giải tám: '.$items[0]->a8;echo '<meta property="og:description" content="'.$shared_content.'" />';}?>
</head>
<body>
<div id="wrapper">
<?php $this->load->view($layout_header);?> 
<div class="content-wrap"> 
<div class="content"> 
    <?php $this->load->view($tmpl);?>
</div>
</div>
<?php $this->load->view($layout_footer)?>

</div>
<script type="text/javascript">/*<![CDATA[*/var LEFT_CAL=Calendarc.setup({cont:"calendar-container",max:<?php echo date('Ymd',time())?>,date:<?php echo $date_time?>,selectionType:Calendarc.SEL_SINGLE,showTime:12,onSelect:function(c){var b=c.selection.get();if(b){b=Calendarc.intToDate(b);var a=Calendarc.printDate(b,"%d-%m-%Y");window.location.href="<?php echo $uri_root.$alias?>/"+a+".html"}}});$(function(){$("#select_provide").selectbox()});$("#f_rangeStart_right").datepick({dateFormat:"dd-mm-yyyy",maxDate:+0,onSelect:function(){loadtinhright()}});/*]]>*/</script>
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