<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	http://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There area two reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router what URI segments to use if those provided
  | in the URL cannot be matched to a valid route.
  |
 */
$url = $_SERVER["SCRIPT_URI"];
$redirects = Array(
	'\/tin-xo-so\/[^\/]*\/' => '/tin-xo-so/',
	'thongke-dau-duoi-0-9' => 'thong-ke-dau-duoi-0-9'
);		
$uri = implode('/', $this->uri->segments);		
foreach ($redirects as $from => $to)
{      	
	if (preg_match("/".$from."/is", $url, $match))
	{
		$url = preg_replace("/".$from."/is", $to, $url);		
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: ". $url); 
		//redirect($url , 'location', 301);
	}
}

$route['default_controller'] = "client/home";
$route['404_override'] = 'client/error_404';

$route['acp_admin'] = 'admin/home';
$route['acp_admin/(:any)?'] = 'admin/$1';

$route["live-mien-nam.html"] = "client/livexoso/livemn";
$route["live-mien-trung.html"] = "client/livexoso/livemt";
$route["live-mien-bac.html"] = "client/livexoso/livemb";
$route["live-xoso.html"] = "client/livexoso/index";
$route["thanh-vien-vip.html"] = "client/html/vip";
$route["dang-nhap.html"] = "client/user/login";
$route["dang-nhap-app.html"] = "client/user/login2";
$route["dang-xuat.html"] = "client/user/logout";
$route["cap-nhat-thong-tin-ca-nhan.html"] = "client/user/update_info";
$route["cap-nhat-thong-tin-ca-nhan-app.html"] = "client/user/update_info2";
$route["quay-so-may-man.html"] = "client/quayxs";
$route["quay-thu.html"] = "client/quayxs/quaythu";
$route["cung-quay-xo-so.html"] = "client/quayxs/quaynhanh";
$route["tuong-thuat-truc-tiep-ket-qua-xo-so.html"] = "client/tructiep/index/home";
$route["ket-qua.html"] = "client/xoso/home";
$route["ket-qua/([\d]+-[\d]+-[\d]+).html"] = "client/xoso/home/$1";

$route['xo-so-dien-toan.html'] = 'client/xs_northern/index';
$route['xo-so-dien-toan/([\d]+-[\d]+-[\d]+).html'] = 'client/xs_northern/byday/$1';
$route['xo-so-dien-toan/(.*?)/([\d]+-[\d]+-[\d]+).html'] = 'client/xs_northern/bytype/$1/$2';

$route['xo-so-mien-bac'] = 'xo-so-mien-bac.html';
$route['xo-so-mien-trung'] = 'xo-so-mien-trung.html';
$route['xoso-mien-trung'] = 'xo-so-mien-trung.html';
$route['xo-so-mien-nam'] = 'xo-so-mien-nam.html';
$route['xoso-mien-nam'] = 'xo-so-mien-nam.html';


$route['(xo-so-[\w\-]+).html'] = 'client/xoso/index/$1';
$route['(xoso-[\w\-]+).html'] = 'client/xoso/index/$1';
$route['(xo-so-[\w\-]+)/(thu-[\w]+)/([\d]+-[\d]+-[\d]+).html'] = 'client/xoso/filter_th/$1/$2/$3';
$route['(xo-so-[\w\-]+)/(thu-[\w]+).html'] = 'client/xoso/filter_th/$1/$2';
$route['(xoso-[\w\-]+)/(thu-[\w]+)/([\d]+-[\d]+-[\d]+).html'] = 'client/xoso/filter_th/$1/$2/$3';
$route['(xoso-[\w\-]+)/(thu-[\w]+).html'] = 'client/xoso/filter_th/$1/$2';
$route['(xo-so-[\w\-]+)/(chu-nhat)/([\d]+-[\d]+-[\d]+).html'] = 'client/xoso/filter_th/$1/$2/$3';
$route['(xo-so-[\w\-]+)/(chu-nhat).html'] = 'client/xoso/filter_th/$1/$2';
$route['(xoso-[\w\-]+)/(chu-nhat)/([\d]+-[\d]+-[\d]+).html'] = 'client/xoso/filter_th/$1/$2/$3';
$route['(xoso-[\w\-]+)/(chu-nhat).html'] = 'client/xoso/filter_th/$1/$2';
$route['(xo-so-[\w\-]+)/([\d]+-[\d]+-[\d]+).html'] = 'client/xoso/filter_date/$1/$2';
$route['(xoso-[\w\-]+)/([\d]+-[\d]+-[\d]+).html'] = 'client/xoso/filter_date/$1/$2';
$route['tuong-thuat-truc-tiep-ket-qua-xo-so/([\w\-]+).html'] = 'client/tructiep/index/$1';
$route['xstt/([\w]+)'] = 'client/xoso/xstt/$1';
$route['xstt_1/([\w]+)'] = 'client/xoso/xstt_1/$1';
$route['xstt_2/([\w]+)'] = 'client/xoso/xstt_2/$1';

$route['(thong-ke-quan-trong).html'] = 'client/statistics/index/$1';
$route['(thong-ke-quan-trong)-([\w\-]+).html'] = 'client/statistics/index/$1/$2';
$route['(thong-ke-theo-bo-so).html'] = 'client/statistics/synthesis/$1';
$route['(thong-ke-theo-bo-so)-([\w\-]+).html'] = 'client/statistics/synthesis/$1/$2';
$route['(thong-ke-lo-to-tinh).html'] = 'client/statistics/loto/$1';
$route['(thong-ke-lo-to-tinh)-([\w\-]+).html'] = 'client/statistics/loto/$1/$2';
$route['(thong-ke-lo-gan).html'] = 'client/statistics/gan/$1';
$route['(thong-ke-lo-gan)-([\w\-]+).html'] = 'client/statistics/gan/$1/$2';
$route['(thong-ke-cap-so-tu-00-99).html'] = 'client/statistics/two/$1';
$route['(thong-ke-cap-so-tu-00-99)-([\w\-]+).html'] = 'client/statistics/two/$1/$2';
$route['(thong-ke-theo-chu-ky).html'] = 'client/statistics/chuky/$1';
$route['(thong-ke-theo-chu-ky)-([\w\-]+).html'] = 'client/statistics/chuky/$1/$2';
$route['(thong-ke-giai-dac-biet-theo-tuan).html'] = 'client/statistics/week/$1/0';
$route['(thong-ke-giai-dac-biet-theo-tuan)-([\w\-]+).html'] = 'client/statistics/week/$1/0/$2';
$route['(thong-ke-cap-so-cuoi-giai-dac-biet-theo-tuan).html'] = 'client/statistics/week/$1/1';
$route['(thong-ke-cap-so-cuoi-giai-dac-biet-theo-tuan)-([\w\-]+).html'] = 'client/statistics/week/$1/1/$2';
$route['(thong-ke-giai-dac-biet-theo-thang).html'] = 'client/statistics/month/$1/0';
$route['(thong-ke-giai-dac-biet-theo-thang)-([\w\-]+).html'] = 'client/statistics/month/$1/0/$2';
$route['(thong-ke-cap-so-cuoi-giai-dac-biet-theo-thang).html'] = 'client/statistics/month/$1/1';
$route['(thong-ke-cap-so-cuoi-giai-dac-biet-theo-thang)-([\w\-]+).html'] = 'client/statistics/month/$1/1/$2';
$route['(thongke-dau-duoi-0-9).html'] = 'client/statistics/first_last/$1';
$route['(thong-ke-dau-duoi-0-9).html'] = 'client/statistics/first_last/$1';
$route['(thongke-dau-duoi-0-9)-([\w\-]+).html'] = 'client/statistics/first_last/$1/$2';
$route['(thong-ke-dau-duoi-0-9)-([\w\-]+).html'] = 'client/statistics/first_last/$1/$2';
$route['(thong-ke-theo-tong-0-9).html'] = 'client/statistics/sum/$1';
$route['(thong-ke-theo-tong-0-9)-([\w\-]+).html'] = 'client/statistics/sum/$1/$2';
$route['(thong-ke-tong-chan).html'] = 'client/statistics/sum_even_odd/$1/0';
$route['(thong-ke-tong-chan)-([\w\-]+).html'] = 'client/statistics/sum_even_odd/$1/0/$2';
$route['(thong-ke-tong-le).html'] = 'client/statistics/sum_even_odd/$1/1';
$route['(thong-ke-tong-le)-([\w\-]+).html'] = 'client/statistics/sum_even_odd/$1/1/$2';
$route['(thong-ke-lo-to-theo-dau-duoi).html'] = 'client/statistics/dau_duoi/$1';
$route['(thong-ke-lo-to-theo-dau-duoi)-([\w\-]+).html'] = 'client/statistics/dau_duoi/$1/$2';
$route['(thong-ke-lo-to-theo-tong).html'] = 'client/statistics/loto_sum/$1';
$route['(thong-ke-lo-to-theo-tong)-([\w\-]+).html'] = 'client/statistics/loto_sum/$1/$2';
$route['in-ve-do.html'] = 'client/print_xoso/index';
$route['ve-do.html?([\w]+)'] = 'client/print_xoso/vedo/$1';
$route["tin-xo-so.html"] = "client/news/index";
$route["tin-xo-so-trang-([\d]+).html"] = "client/news/index//$1";
$route['tin-xo-so/danh-muc-([\w\-]+)-trang-([\d]+).html'] = 'client/news/index/$1/$2';
$route['tin-xo-so/danh-muc-([\w\-]+).html'] = 'client/news/index/$1';
$route['tin-xo-so/([\w\-]+)/([\w\-]+).html'] = 'client/news/detail/$1/$2';
$route['tin-xo-so/([\w\-]+).html'] = 'client/news/detail//$1';

// Vietlott <li><a href="http://xoso.com/vietlott/xo-so-power-6-55-vietlott.html"><span>Power 6/55</span></a></li>
$route['vietlott/xo-so-power-6-55-vietlott.html'] = 'client/vietlott/power6';
$route['vietlott/mega6.html'] = 'client/vietlott/mega6';
$route['vietlott/max4d.html'] = 'client/vietlott/max4d';
$route['vietlott/choi-thu-mega-6-45-vietlott-huong-dan-choi.html'] = 'client/vietlott/choithu6';
$route['vietlott/choi-thu-max-4d-vietlott-huong-dan-choi.html'] = 'client/vietlott/choithumax4d';
$route['vietlott/choi-thu-power-6-55-vietlott-huong-dan-choi.html'] = 'client/vietlott/choithupower6';
$route['vietlott/mega6-trang-([\d]+).html'] = 'client/vietlott/mega6/$1';
$route['vietlott/max4d-trang-([\d]+).html'] = 'client/vietlott/max4d/$1';


$route["lich-mo-thuong-xo-so.html"] = "client/html/index";
$route["do-ve-so.html"] = "client/statistics/doveso";
$route["giai-dap-giac-mo.html"] = "client/xs_dreams/index";
$route["giai-dap-giac-mo-trang-([\d]+).html"] = "client/xs_dreams/index/$1";
$route['loadtinh/([\w\-]+)/([\d]+-[\d]+-[\d]+)'] = 'client/statistics/loadtinh/select_mien/$1/$2';
$route['loadtinhs/([\w\-]+)/([\d]+-[\d]+-[\d]+)'] = 'client/statistics/loadtinh/select_provide/$1/$2';
$route['loadloc/([\w\-]+)/([\d]+-[\d]+-[\d]+)'] = 'client/statistics/loadtinh/select_loc/$1/$2';

$route['(thongke-cau-xo-so).html'] = 'client/soicau/index/$1';
$route['(thongke-cau)-(xo-so-[\w\-]+).html'] = 'client/soicau/index/$1/$2';
$route['(thongke-cau-bach-thu-mien-bac).html'] = 'client/soicau/bachthu/$1';

$route['loadkqxs/([\w]+)/([\d]+)'] = 'client/xoso/loadkqxs/$1/$2';

$route['demo/index.html'] = 'client/demo/index';
$route['getkqxs-([\w\-]+).js'] = 'client/demo/getkqxs/$1';
$route['getkqxs-([\w\-]+)/([\d]+-[\d]+-[\d]+).js'] = 'client/demo/getkqxs/$1/$2';

$route['getkqxsdemo-([\w\-]+).js'] = 'client/demo/getkqxsdemo/$1';
$route['getkqxsdemo-([\w\-]+)/([\d]+-[\d]+-[\d]+).js'] = 'client/demo/getkqxsdemo/$1/$2';

$route['getkqxsj-([\w\-]+).js'] = 'client/demo/getkqxsj/$1';
$route['getkqxsj-([\w\-]+)/([\d]+-[\d]+-[\d]+).js'] = 'client/demo/getkqxsj/$1/$2';

$route['getkqxsj2-([\w\-]+).js'] = 'client/demo/getkqxsj2/$1';
$route['getkqxsj2-([\w\-]+)/([\d]+-[\d]+-[\d]+).js'] = 'client/demo/getkqxsj2/$1/$2';

$route['getkqxswp-([\w\-]+).js'] = 'client/demo/getkqxswp/$1';
$route['getkqxswp-([\w\-]+)/([\d]+-[\d]+-[\d]+).js'] = 'client/demo/getkqxswp/$1/$2';

$route['tao-ma-nhung/ket-qua-xo-so.html'] = 'client/demo/tao_ma_nhung';
$route['gioi-thieu.html'] = 'client/html/gioithieu';
$route['tro-giup.html'] = 'client/news/help';
$route["tro-giup-trang-([\d]+).html"] = "client/news/help//$1";
$route['tro-giup/danh-muc-([\w\-]+)-trang-([\d]+).html'] = 'client/news/help/$1/$2';
$route['tro-giup/danh-muc-([\w\-]+).html'] = 'client/news/help/$1';
$route['tro-giup/([\w\-]+)/([\w\-]+).html'] = 'client/news/helpdetail/$1/$2';
$route['tro-giup/([\w\-]+).html'] = 'client/news/helpdetail//$1';

$route['ve-so.html'] = 'client/xs_veso/index';
$route['ve-so-([\w\-]+).html'] = 'client/xs_veso/index/$1';

$route['tags/(.*)'] = 'client/tags/index/$1';
$route['mua-online.html'] = 'client/mua_online/index';

$route['so-dau-duoi/mien-bac/([\d]+-[\d]+-[\d]+).html'] = 'client/sodauduoi/mienbac/$1';
$route['so-dau-duoi/(mien-bac)/(thu-[\w]+)/([\d]+-[\d]+-[\d]+).html'] = 'client/sodauduoi/filter_th/$1/$2/$3';
$route['so-dau-duoi/(mien-bac)/(thu-[\w]+).html'] = 'client/sodauduoi/filter_th/$1/$2';
$route['so-dau-duoi/(mien-bac)/(chu-nhat)/([\d]+-[\d]+-[\d]+).html'] = 'client/sodauduoi/filter_th/$1/$2/$3';
$route['so-dau-duoi/(mien-bac)/(chu-nhat).html'] = 'client/sodauduoi/filter_th/$1/$2';
$route['so-dau-duoi/mien-bac.html'] = 'client/sodauduoi/mienbac';
$route['so-dau-duoi/(mien-nam)/([\d]+-[\d]+-[\d]+).html'] = 'client/sodauduoi/index/$1/$2';
$route['so-dau-duoi/(mien-nam)/(thu-[\w]+)/([\d]+-[\d]+-[\d]+).html'] = 'client/sodauduoi/filter_th/$1/$2/$3';
$route['so-dau-duoi/(mien-nam)/(thu-[\w]+).html'] = 'client/sodauduoi/filter_th/$1/$2';
$route['so-dau-duoi/(mien-nam)/(chu-nhat)/([\d]+-[\d]+-[\d]+).html'] = 'client/sodauduoi/filter_th/$1/$2/$3';
$route['so-dau-duoi/(mien-nam)/(chu-nhat).html'] = 'client/sodauduoi/filter_th/$1/$2';
$route['so-dau-duoi/(mien-nam).html'] = 'client/sodauduoi/index/$1';
$route['so-dau-duoi/(mien-trung)/([\d]+-[\d]+-[\d]+).html'] = 'client/sodauduoi/index/$1/$2';
$route['so-dau-duoi/(mien-trung)/(thu-[\w]+)/([\d]+-[\d]+-[\d]+).html'] = 'client/sodauduoi/filter_th/$1/$2/$3';
$route['so-dau-duoi/(mien-trung)/(thu-[\w]+).html'] = 'client/sodauduoi/filter_th/$1/$2';
$route['so-dau-duoi/(mien-trung)/(chu-nhat)/([\d]+-[\d]+-[\d]+).html'] = 'client/sodauduoi/filter_th/$1/$2/$3';
$route['so-dau-duoi/(mien-trung)/(chu-nhat).html'] = 'client/sodauduoi/filter_th/$1/$2';
$route['so-dau-duoi/(mien-trung).html'] = 'client/sodauduoi/index/$1';

$route['ma-tinh-thanh.html'] = 'client/home';
$route['du-doan-xo-so-([\w\-]+)/([\w\-]+).html'] = 'client/xs_dudoan/detail/$1/$2';
$route['du-doan-(xo-so-[\w\-]+)-trang-([\d]+).html'] = 'client/xs_dudoan/index/$1/$2';
$route['du-doan-(xo-so-[\w\-]+).html'] = 'client/xs_dudoan/index/$1';
$route['du-doan-xo-so.html'] = 'client/xs_dudoan/home';

$route['du-doan/([\w\-]+).html'] = 'client/xs_lotonuoi/detail/$1';
$route['kinh-nghiem/([\w\-]+).html'] = 'client/xs_kinhnghiem/detail/$1';

$route['quayso/loadKq'] = 'client/quayxs/loadKq';
$route['loadtkhome/([\d]+)'] = 'client/home/loadtkhome/$1';

$route['thong-ke-xo-so-hom-nay/([\w\-]+)/([\d]+-[\d]+-[\d]+).html'] = 'client/thongke/index/$1/$2';
$route['thong-ke-xo-so-hom-nay/([\w\-]+).html'] = 'client/thongke/index/$1';
$route["thong-ke-xo-so-hom-nay.html"] = "client/thongke";
$route['thong-ke-vip-xo-so-3-mien-ngay-([\d]+-[\d]+-[\d]+).html'] = 'client/thongke/vip/$1';
$route['thong-ke-vip-xo-so-3-mien.html'] = 'client/thongke/vip';
$route['thong-ke-so-dep-tu-cac-dien-dan-xo-so/([\w\-]+)/([\d]+-[\d]+-[\d]+).html'] = 'client/thongke/site/$1/$2';
$route['thong-ke-so-dep-tu-cac-dien-dan-xo-so.html'] = 'client/thongke/site';
$route['thong-ke-tan-suat-loto.html'] = 'client/thongke/tansuat';
$route['soi-cau.html'] = 'client/soicaunew';
$route['soicau_sendhtml'] = 'client/soicaunew/sendhtml';
$route['loto-online.html'] = 'client/loto_online/index';
$route['lol_betlist'] = 'client/loto_online/betlist';
$route['lol_betupdate'] = 'client/loto_online/betupdate';
$route['lol_betkq'] = 'client/loto_online/betkq';

$route['chat-luu-tru.html'] = 'client/chat/chatac';
$route['chat-full-screen.html'] = 'client/chat/chatm';
$route['chat-full-screen-app.html'] = 'client/chat/chatm2';
$route['giao-luu-thao-luan-chot-so-lotto.html'] = 'client/chat';
$route['chat_trend'] = 'client/chat/trend';
$route['chat_ajaxsearch'] = 'client/chat/ajaxsearch';
$route['chat_onlinestatdata'] = 'client/chat/onlinestatdata';
$route['chat_chatlist'] = 'client/chat/chatlist';
$route['chat_chatsrv'] = 'client/chat/chatsrv';
$route['chat_userinfo'] = 'client/chat/userinfo';
$route['chat_friend'] = 'client/chat/friend';
$route['chat_stateupdate'] = 'client/chat/chatstateupdate';
$route['chat_chot'] = 'client/chat/chot';
$route['chat_scan'] = 'client/chat/scan';

$route['openid/(.*)'] = 'client/user/openid/$1';

$route['([A-Za-z0-9_-]+)-xo-so-mien-bac.html'] = 'client/error_404';

$route['admin(:any)?'] = 'client/error_404';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
