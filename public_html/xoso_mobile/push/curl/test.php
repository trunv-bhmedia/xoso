<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<?php
//$canchong = $_GET['canchong'];
//$chivo = $_GET['chivo'];
include "function.php";

include "simple_html_dom.php";
@set_time_limit(60,30);

$link = 'http://xoso.com/bkup/index.php?option=com_xoso&view=iphone&layout=now';

$content = curl_page21($link);
print_r($content);
?>