<?php
$f	=	isset($_REQUEST['f']) ? $_REQUEST['f'] : '';
$k	=	isset($_REQUEST['k']) ? $_REQUEST['k'] : '';
$keymb = md5('mb.txt-bhxoso'.date('d-m-Y'));
$keymn = md5('mn.txt-bhxoso'.date('d-m-Y'));
$keymt = md5('mt.txt-bhxoso'.date('d-m-Y'));
if($f == 1 && $k == $keymb){
	unlink('/home/xoso/public_html/xstt/mb.txt');
}elseif($f == 2 && $k == $keymt){
	unlink('/home/xoso/public_html/xstt/mt.txt');
}elseif($f == 3 && $k == $keymn){
	unlink('/home/xoso/public_html/xstt/mn.txt');
}else{
	echo "Ban khong co quyen!";
}
?>