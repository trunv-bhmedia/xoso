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

$route['default_controller'] = "client/home";
$route['404_override'] = 'client/error_404';

//$route['acp_admin'] = 'admin/home';
//$route['acp_admin/(:any)?'] = 'admin/$1';

//$route["lien-he-quan-tri.html"] = "client/html/contact";
$route["quay-so-may-man.html"] = "client/quayxs";
$route["quay-thu.html"] = "client/quayxs/quaythu";
$route["cung-quay-xo-so.html"] = "client/quayxs/quaynhanh";
$route["tuong-thuat-truc-tiep-ket-qua-xo-so.html"] = "client/tructiep/index/home";
$route["ket-qua.html"] = "client/xoso/home";
$route["ket-qua/([\d]+-[\d]+-[\d]+).html"] = "client/xoso/home/$1";

//$route['xo-so-dien-toan.html'] = 'client/xs_northern/index';
//$route['xo-so-dien-toan/([\d]+-[\d]+-[\d]+).html'] = 'client/xs_northern/byday/$1';
//$route['xo-so-dien-toan/(.*?)/([\d]+-[\d]+-[\d]+).html'] = 'client/xs_northern/bytype/$1/$2';

$route['(xo-so-[\w\-]+).html'] = 'client/xoso/index/$1';
$route['(xoso-[\w\-]+).html'] = 'client/xoso/index/$1';
$route['(xo-so-[\w\-]+)'] = 'client/xoso/index/$1';
$route['(xoso-[\w\-]+)'] = 'client/xoso/index/$1';
//$route['(xo-so-[\w\-]+)/(thu-[\w]+).html'] = 'client/xoso/filter_th/$1/$2';
//$route['(xoso-[\w\-]+)/(thu-[\w]+).html'] = 'client/xoso/filter_th/$1/$2';
//$route['(xo-so-[\w\-]+)/(chu-nhat).html'] = 'client/xoso/filter_th/$1/$2';
//$route['(xoso-[\w\-]+)/(chu-nhat).html'] = 'client/xoso/filter_th/$1/$2';
$route['(xo-so-[\w\-]+)/([\d]+-[\d]+-[\d]+).html'] = 'client/xoso/filter_date/$1/$2';
$route['(xoso-[\w\-]+)/([\d]+-[\d]+-[\d]+).html'] = 'client/xoso/filter_date/$1/$2';
$route['(xo-so-[\w\-]+)/([\d]+-[\d]+-[\d]+)'] = 'client/xoso/filter_date/$1/$2';
$route['(xoso-[\w\-]+)/([\d]+-[\d]+-[\d]+)'] = 'client/xoso/filter_date/$1/$2';
$route['tuong-thuat-truc-tiep-ket-qua-xo-so/([\w\-]+).html'] = 'client/tructiep/index/$1';
$route['xstt/([\w]+)'] = 'client/xoso/xstt/$1';

$route['(thong-ke-quan-trong).html'] = 'client/statistics/index/$1';
$route['(thong-ke-quan-trong)-([\w\-]+).html'] = 'client/statistics/index/$1/$2';
//$route['(thong-ke-theo-bo-so).html'] = 'client/statistics/synthesis/$1';
//$route['(thong-ke-theo-bo-so)-([\w\-]+).html'] = 'client/statistics/synthesis/$1/$2';
//$route['(thong-ke-lo-to-tinh).html'] = 'client/statistics/loto/$1';
//$route['(thong-ke-lo-to-tinh)-([\w\-]+).html'] = 'client/statistics/loto/$1/$2';
$route['(thong-ke-lo-gan).html'] = 'client/statistics/gan/$1';
$route['(thong-ke-lo-gan)-([\w\-]+).html'] = 'client/statistics/gan/$1/$2';
$route['(thong-ke-cap-so-tu-00-99).html'] = 'client/statistics/two/$1';
$route['(thong-ke-cap-so-tu-00-99)-([\w\-]+).html'] = 'client/statistics/two/$1/$2';
//$route['(thong-ke-theo-chu-ky).html'] = 'client/statistics/chuky/$1';
//$route['(thong-ke-theo-chu-ky)-([\w\-]+).html'] = 'client/statistics/chuky/$1/$2';
//$route['(thong-ke-giai-dac-biet-theo-tuan).html'] = 'client/statistics/week/$1/0';
//$route['(thong-ke-giai-dac-biet-theo-tuan)-([\w\-]+).html'] = 'client/statistics/week/$1/0/$2';
//$route['(thong-ke-cap-so-cuoi-giai-dac-biet-theo-tuan).html'] = 'client/statistics/week/$1/1';
//$route['(thong-ke-cap-so-cuoi-giai-dac-biet-theo-tuan)-([\w\-]+).html'] = 'client/statistics/week/$1/1/$2';
//$route['(thong-ke-giai-dac-biet-theo-thang).html'] = 'client/statistics/month/$1/0';
//$route['(thong-ke-giai-dac-biet-theo-thang)-([\w\-]+).html'] = 'client/statistics/month/$1/0/$2';
//$route['(thong-ke-cap-so-cuoi-giai-dac-biet-theo-thang).html'] = 'client/statistics/month/$1/1';
//$route['(thong-ke-cap-so-cuoi-giai-dac-biet-theo-thang)-([\w\-]+).html'] = 'client/statistics/month/$1/1/$2';
$route['(thongke-dau-duoi-0-9).html'] = 'client/statistics/first_last/$1';
$route['(thong-ke-dau-duoi-0-9).html'] = 'client/statistics/first_last/$1';
$route['(thongke-dau-duoi-0-9)-([\w\-]+).html'] = 'client/statistics/first_last/$1/$2';
$route['(thong-ke-dau-duoi-0-9)-([\w\-]+).html'] = 'client/statistics/first_last/$1/$2';
//$route['(thong-ke-theo-tong-0-9).html'] = 'client/statistics/sum/$1';
//$route['(thong-ke-theo-tong-0-9)-([\w\-]+).html'] = 'client/statistics/sum/$1/$2';
//$route['(thong-ke-tong-chan).html'] = 'client/statistics/sum_even_odd/$1/0';
//$route['(thong-ke-tong-chan)-([\w\-]+).html'] = 'client/statistics/sum_even_odd/$1/0/$2';
//$route['(thong-ke-tong-le).html'] = 'client/statistics/sum_even_odd/$1/1';
//$route['(thong-ke-tong-le)-([\w\-]+).html'] = 'client/statistics/sum_even_odd/$1/1/$2';
$route['(thong-ke-lo-to-theo-dau-duoi).html'] = 'client/statistics/dau_duoi/$1';
$route['(thong-ke-lo-to-theo-dau-duoi)-([\w\-]+).html'] = 'client/statistics/dau_duoi/$1/$2';
//$route['(thong-ke-lo-to-theo-tong).html'] = 'client/statistics/loto_sum/$1';
//$route['(thong-ke-lo-to-theo-tong)-([\w\-]+).html'] = 'client/statistics/loto_sum/$1/$2';
//$route['in-ve-do.html'] = 'client/print_xoso/index';
//$route['ve-do.html?([\w]+)'] = 'client/print_xoso/vedo/$1';
//$route["tin-xo-so.html"] = "client/news/index";
//$route["tin-xo-so-trang-([\d]+).html"] = "client/news/index//$1";
//$route['tin-xo-so/danh-muc-([\w\-]+)-trang-([\d]+).html'] = 'client/news/index/$1/$2';
//$route['tin-xo-so/danh-muc-([\w\-]+).html'] = 'client/news/index/$1';
//$route['tin-xo-so/([\w\-]+)/([\w\-]+).html'] = 'client/news/detail/$1/$2';
//$route['tin-xo-so/([\w\-]+).html'] = 'client/news/detail//$1';

//$route["lich-mo-thuong-xo-so.html"] = "client/html/index";
$route["do-ve-so.html"] = "client/statistics/doveso";
$route["giai-dap-giac-mo.html"] = "client/xs_dreams/index";
$route["giai-dap-giac-mo-trang-([\d]+).html"] = "client/xs_dreams/index/$1";
$route['loadtinh/([\w\-]+)/([\d]+-[\d]+-[\d]+)'] = 'client/statistics/loadtinh/select_mien/$1/$2';

//$route['(thongke-cau-xo-so).html'] = 'client/soicau/index/$1';
//$route['(thongke-cau)-(xo-so-[\w\-]+).html'] = 'client/soicau/index/$1/$2';
//$route['(thongke-cau-bach-thu-mien-bac).html'] = 'client/soicau/bachthu/$1';

//$route['loadkqxs/([\w]+)/([\d]+)'] = 'client/xoso/loadkqxs/$1/$2';

//$route['demo/(.*?).html'] = 'client/demo/index/$1';
//$route['getkqxs-([\w\-]+).js'] = 'client/demo/getkqxs/$1';
//$route['getkqxs-([\w\-]+).js\?_=\d+'] = 'client/demo/getkqxs/$1';
//$route['getkqxs-([\w\-]+)/([\d]+-[\d]+-[\d]+).js'] = 'client/demo/getkqxs/$1/$2';
//$route['getkqxs-([\w\-]+)/([\d]+-[\d]+-[\d]+).js\?_=\d+'] = 'client/demo/getkqxs/$1/$2';

//$route['tao-ma-nhung/ket-qua-xo-so.html'] = 'client/demo/tao_ma_nhung';
//$route['gioi-thieu.html'] = 'client/html/gioithieu';
//$route['tro-giup.html'] = 'client/news/help';
//$route["tro-giup-trang-([\d]+).html"] = "client/news/help//$1";
//$route['tro-giup/danh-muc-([\w\-]+)-trang-([\d]+).html'] = 'client/news/help/$1/$2';
//$route['tro-giup/danh-muc-([\w\-]+).html'] = 'client/news/help/$1';
//$route['tro-giup/([\w\-]+)/([\w\-]+).html'] = 'client/news/helpdetail/$1/$2';
//$route['tro-giup/([\w\-]+).html'] = 'client/news/helpdetail//$1';

//$route['ve-so.html'] = 'client/xs_veso/index';
//$route['ve-so-([\w\-]+).html'] = 'client/xs_veso/index/$1';

//$route['tags/(.*)'] = 'client/tags/index/$1';
//$route['mua-online.html'] = 'client/mua_online/index';

// Vietlott
$route['vietlott/mega6.html'] = 'client/vietlott/mega6';
$route['vietlott/max4d.html'] = 'client/vietlott/max4d';
$route['vietlott/xo-so-power-6-55-vietlott.html'] = 'client/vietlott/power6';
$route['vietlott/mega6-trang-([\d]+).html'] = 'client/vietlott/mega6/$1';
$route['vietlott/max4d-trang-([\d]+).html'] = 'client/vietlott/max4d/$1';

$route['live/iphone'] = "client/live/iphone";
$route['iphone/statistic'] = "client/iphone/statistic";
$route['iphone/now'] = "client/iphone/now";
$route['iphone/result'] = "client/iphone/result";

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

$route['ma-tinh-thanh.html'] = 'client/home/matinh';

$route['quayso/loadKq'] = 'client/quayxs/loadKq';

$route['thong-ke-hom-nay.html'] = 'client/chat/thongke';
$route['soi-cau.html'] = 'client/soicaunew';
$route['soicau_sendhtml'] = 'client/soicaunew/sendhtml';
$route['loto-online.html'] = 'client/loto_online/index';
$route['lol_betlist'] = 'client/loto_online/betlist';
$route['lol_betupdate'] = 'client/loto_online/betupdate';
$route['lol_betkq'] = 'client/loto_online/betkq';

$route['chat-luu-tru.html'] = 'client/chat/chatac';
$route['chat-full-screen.html'] = 'client/chat/chatm';
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

$route["dang-nhap.html"] = "client/user/login";
$route["dang-ky.html"] = "client/user/register";
$route["dang-xuat.html"] = "client/user/logout";
$route["cap-nhat-thong-tin-ca-nhan.html"] = "client/user/update_info";

$route['chot-so-lotto.html'] = 'client/chat/chotso';

$route['openid/(.*)'] = 'client/user/openid/$1';

$route['([A-Za-z0-9_-]+)-xo-so-mien-bac.html'] = 'client/error_404';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
