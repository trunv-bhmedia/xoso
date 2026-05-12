<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require 'client' . EXT;

class Home extends Client {

    function __construct() {
        parent::__construct();
        $time = date('H:i');
        if ($time > '16:00' && $time < '19:00')
            header("Cache-Control: max-age=30");
    }

    public function index() {
        $this->load->model(array('xs_result_model', 'xs_northern_model', 'gioithieu_model'));
//        $timer = $this->xs_result_model->getTimer();
//
//        $timeMB_end = '18:55';
//        $timeMT_end = '17:55';
//        $timeMN_end = '16:55';

        if ($_SERVER['SCRIPT_URI'] == "http://xoso.com/index.php") {
            //die;
            header("Content-type: text/xml; charset=utf-8");
            include "function1.php";
            include "simple_html_dom.php";
            $start_date = isset($_GET['startDate']) ? $_GET['startDate'] : date('d-m-Y');
            $end_date = isset($_GET['endDate']) ? $_GET['endDate'] : date('d-m-Y');
            $location = isset($_GET['idlocation']) ? $_GET['idlocation'] : "MB";
            $location = strtoupper($location);

            //$start_date			= date('Y-m-d',strtotime(str_replace('/','-',"$start_date")));
            //$end_date			= date('Y-m-d',strtotime(str_replace('/','-',"$end_date")));
            //$start_date = "11-11-2013"; $end_date = "16-11-2013";
            //Lay ket qua tu ngay hom nay
            if (!isset($_GET['idlocation']) && $_GET['idlocation'] == "") {
                $link = "http://app.bhmedia.vn/idata/phongthuy/kq.php";
            } else {
                $link = "http://app.bhmedia.vn/idata/phongthuy/kq.php?startDate=" . $start_date . "&endDate=" . $end_date . "&idlocation=" . $location;
            }

            $date = isset($_GET['date']) ? $_GET['date'] : date('d-m-Y');
            $location = isset($_GET['idLocation']) ? $_GET['idLocation'] : "MB";
            $location = strtoupper($location);
            $location = isset($_GET['idlocation']) ? $_GET['idlocation'] : "MB";
            $idLocation1 = isset($_GET['idLocation']) ? $_GET['idLocation'] : "MB";

            $location = strtoupper($location);
            $idLocation1 = strtoupper($idLocation1);

            if (isset($idLocation1)) {
                $location = $idLocation1;
            }

            // Lay ket qua theo ngay
            if (isset($_GET['layout']) && $_GET['layout'] == "view") {

                $link = "http://app.bhmedia.vn/idata/phongthuy/kq.php?date=" . $date . "&idLocation=" . $location;
                //echo $link;
            }

            //echo $link;
            $fields = array("sex" => $sex, "birthYear" => $birthYear, "direction" => $direction);
            $url = curl_page3($link, $fields);
            $html = str_get_html($url);
            $content = $html->find('chanel', 0)->innertext;

            echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
            $content = $html->find('chanel', 0)->outertext;
            $content = str_replace(array("xoso", "lo", "nameLocal", "ranknumber", "idLocal", "rankname", "startdate", "enddate"), array("XoSo", "Lo", "namelocal", "rankNumber", "idlocal", "rankName", "startDate", "endDate"), $content);
            echo($content);
            die;
        }
        /*
          if($_SERVER['SCRIPT_URI'] != "http://xoso.com/index.php"){
          $time = date('H:i');
          if ($time >= $timer['MN'] && $time < $timeMN_end) {
          redirect(base_url() . 'tuong-thuat-truc-tiep-ket-qua-xo-so/mien-nam.html');
          } elseif ($time >= $timer['MT'] && $time < $timeMT_end) {
          redirect(base_url() . 'tuong-thuat-truc-tiep-ket-qua-xo-so/mien-trung.html');
          } elseif ($time >= $timer['MB'] && $time < $timeMB_end) {
          redirect(base_url() . 'tuong-thuat-truc-tiep-ket-qua-xo-so/mien-bac.html');
          }
          }
         */
//        $this->simple_cache->delete_item('home_data');
        // key is the name you have given to the cached data
        // will check if the item is cached or
//        $home_data = array();
//        if (!$this->simple_cache->is_cached('home_data')) {
        // not cached, do our things that need caching
//            $this->load->helper('upload');
//            $area = 0;
//            $date = date('Y-m-d');
//            $lastdate = date('Y-m-d', strtotime('-1 day'));
//            $rows['MB_NEW'] = $this->xs_result_model->read_xml_home($area, $date, 1);
//            if(!$rows['MB_NEW'])
//                $rows['MB_NEW'] = $this->xs_result_model->read_xml_home($area, $lastdate, 1);
//
//            $area = 1;
//            $rows['MT_NEW'] = $this->xs_result_model->read_xml_home($area, $date, 1);
//            if(!$rows['MT_NEW'])
//                $rows['MT_NEW'] = $this->xs_result_model->read_xml_home($area, $lastdate, 1);
//
//            $area = 2;
//            $rows['MN_NEW'] = $this->xs_result_model->read_xml_home($area, $date, 1);
//            if(!$rows['MN_NEW'])
//                $rows['MN_NEW'] = $this->xs_result_model->read_xml_home($area, $lastdate, 1);
//
//            if (!$rows['MB_NEW'] || !$rows['MT_NEW'] || !$rows['MN_NEW']) {
//        $lastrows = $this->xs_result_model->getLastItems();
//                $rows = array_merge($rows, $lastrows);
//            }
//            if ($rows['MB_NEW']) {
//                $tmp = $rows['MB_NEW']->date;
//                $rows['MB_NEW'] = $rows['MB_NEW']->cache->data;
//                $rows['MB_NEW']->date = $tmp;
//            }
//            if ($rows['MT_NEW']) {
//                $tmp = $rows['MT_NEW']->date;
//                $rows['MT_NEW'] = $rows['MT_NEW']->cache->data;
//                $rows['MT_NEW']->date = $tmp;
//            }
//            if ($rows['MN_NEW']) {
//                $tmp = $rows['MN_NEW']->date;
//                $rows['MN_NEW'] = $rows['MN_NEW']->cache->data;
//                $rows['MN_NEW']->date = $tmp;
//            }
//            var_dump($rows);

        $yesterday = date('Y-m-d', strtotime('-1 day'));
        $today = date('Y-m-d');
        //$yesterday = '2020-03-30';
        //$today = '2020-03-31';
//var_dump($this->db); die;
        $this->db->where('(r.date=\'' . $yesterday . '\' OR r.date=\'' . $today . '\')');
        $this->db->where('l.status', 1);
        $data = $this->db->select('r.a0,r.date,l.name,l.alias,l.area,r.extension')
                ->from('xs_result AS r')
                ->join('xs_location AS l', 'r.lid = l.id', 'left')
                ->order_by('r.date', 'DESC')
                ->order_by('l.ordering', 'ASC')
                ->get()
                ->result();
			
				
				
		//var_dump($data);die;		
//echo $this->db->last_query();die;
        //if($_REQUEST["debug"] == 1){
        $data_mega = $this->db->select('*')
                ->from('vietlott_data')
                ->where('type', 1)
                ->order_by('dateint', 'DESC')
                ->limit('1')
                ->get()
                ->result();
        $this->data['vietlottmega'] = $data_mega[0];
        
        $data_power = $this->db->select('*')
                ->from('vietlott_data')
                ->where('type', 3)
                ->order_by('dateint', 'DESC')
                ->limit('1')
                ->get()
                ->result();
        $this->data['vietlottpower'] = $data_power[0];

        $data_max = $this->db->select('*')
                ->from('vietlott_data')
                ->where('type', 2)
                ->order_by('dateint', 'DESC')
                ->limit('1')
                ->get()
                ->result();
        $this->data['vietlottmax'] = $data_max[0];

        $array_mega = array(3, 5, 7);
        $array_max = array(2, 4, 6);
        $array_day_mega = $this->get_time_next($array_mega);
        $array_day_max = $this->get_time_next($array_max);

        $this->data['nexttimemega'] = $array_day_mega;
        $this->data['nexttimemax'] = $array_day_max;
        //}
//        echo $this->db->last_query();

        $items = null;
        $checktoday = null;
		
		
		
		
        foreach ($data as $i => $item) {
            if ($item->date == $today && !isset($checktoday[$item->area]))
                $checktoday[$item->area] = 1;
            $items[$item->area][$item->date][] = $item;
        }
		
        $this->data['xoso'] = $items;
        $this->data['checktoday'] = $checktoday;
        $this->data['yesterday'] = $yesterday;
        $this->data['today'] = $today;
//        $this->data['items'] = $this->xs_result_model->getItemsFirstLast(30, 1);
        $this->data['xsdt'] = $this->xs_northern_model->getResult();
        $this->data['_meta'] = $this->meta_model->show_title('home');

//            $home_data['items'] = $this->xs_statistics_model->getItemsStatistics();
//            $home_data['locations'] = $this->xs_statistics_model->getNowLocations();
        // store in cache
//            $this->simple_cache->cache_item('home_data', $home_data);
//        } else {
//            $home_data = $this->simple_cache->get_item('home_data');
//        }
//        $this->data = array_merge($this->data, $home_data);

        $this->data['text_sms'] = $this->gioithieu_model->get(2);

        $this->data['tmpl'] = 'home/home';
        $this->load->view('layout/content', $this->data);
    }

    function get_time_next($array_day_mega) {
        $today_mega = date("N", strtotime("now"));
        //$today_mega = 5;
        $item = 0;
        for ($i = 0; $i < count($array_day_mega); $i++) {
            $item = $array_day_mega[$i];
            if ($today_mega < $item)
                break;
            elseif ($today_mega == $item) {
                if (date('H') < 17)
                    break;
                elseif (date('H' == 17) && date('i') < 45)
                    break;
            }
        }
        $timestame_next = ($item - $today_mega) * 86400 + time();
        $date_next = date('n/j/Y 17:45:00', $timestame_next);

        return $date_next;
    }

    function loadtkhome($lid) {
        $this->load->model(array('xs_result_model', 'xs_northern_model', 'xs_statistics_model'));
        $time_turn = 40;

        $this->data['itemsImportant'] = $this->xs_northern_model->getitemsImportant($lid, $time_turn);
        $this->data['items_30'] = $this->xs_northern_model->getitemsImportant($lid, 30);
//        if ($this->data['itemsImportant']['cautious']) {
//            foreach ($this->data['itemsImportant']['cautious'] as $key => $row) {
//                $return_fare[$key] = $row['not_count'];
//            }
//            array_multisort($return_fare, SORT_DESC, $this->data['itemsImportant']['cautious']);
//        }
        $this->data['items'] = $this->xs_result_model->getItemsFirstLast($time_turn, $lid);

        $this->data['cau_loto5'] = $this->xs_statistics_model->getItemsDetectLotto(6, $lid);
        $this->data['cau_loto6'] = $this->xs_statistics_model->getItemsDetectLotto(7, $lid);

        if ($lid == 1) {
            $this->data['cau_bt'] = $this->xs_statistics_model->getItemsDetectOnlyLotto(5, 1);
            if ($this->simple_cache->is_cached('data_cau')) {
                $this->data['cau_2nhay'] = $this->simple_cache->get_item('data_cau');
            } else {
                $this->data['limit'] = 3;
                $this->data['exactlimit'] = 0;
                $this->data['ngay'] = date('d-m-Y', strtotime('+1 days'));
                $this->data['nhay'] = 2;
                $this->data['db'] = 0;
                $this->data['lon'] = 1;

                $lid = 1;
                $arr_rs = $this->xs_statistics_model->soiCauNew($lid, $this->data['ngay'], $this->data['db'], $this->data['lon'], $this->data['nhay'], $this->data['limit']);
                $this->data['ngay'] = $arr_rs['ngay'];
                $this->data['max_cau'] = $arr_rs['max_cau'];
                $data = $arr_rs['data'];
                $this->data['data_limit'] = $arr_rs['data_limit'];
                $this->data['data_nextlimit'] = $arr_rs['data_nextlimit'];

                if ($this->data['limit'] > $this->data['max_cau']) {
                    $this->data['limit'] = $this->data['max_cau'];
                    foreach ($data as $vitri => $value) {
                        if ($value['cau'] == $this->data['limit'])
                            $this->data['data_limit'][$vitri] = $value['so'];
                    }
                }

                asort($this->data['data_limit']);

                $list_cau = array();
                foreach ($this->data['data_limit'] as $vitri => $value) {
                    if ($this->data['lon'] == 0) {
                        $list_cau[$value]['cau'] = $list_cau[$value]['cau'] + 1;
                        $list_cau[$value]['so'] = $value;
                        $list_cau[$value]['order'] = $value;
                    } else {
                        $arr = str_split($value);
                        if ($arr[0] != $arr[1]) {
                            if ($arr[0] > $arr[1]) {
                                $list_cau[$arr[1] . $arr[0] . ',' . $arr[0] . $arr[1]]['cau'] = $list_cau[$arr[1] . $arr[0] . ',' . $arr[0] . $arr[1]]['cau'] + 1;
                                $list_cau[$arr[1] . $arr[0] . ',' . $arr[0] . $arr[1]]['so'] = $arr[1] . $arr[0] . ',' . $arr[0] . $arr[1];
                                $list_cau[$arr[1] . $arr[0] . ',' . $arr[0] . $arr[1]]['order'] = $arr[1] . $arr[0];
                            } else {
                                $list_cau[$arr[0] . $arr[1] . ',' . $arr[1] . $arr[0]]['cau'] = $list_cau[$arr[0] . $arr[1] . ',' . $arr[1] . $arr[0]]['cau'] + 1;
                                $list_cau[$arr[0] . $arr[1] . ',' . $arr[1] . $arr[0]]['so'] = $arr[0] . $arr[1] . ',' . $arr[1] . $arr[0];
                                $list_cau[$arr[0] . $arr[1] . ',' . $arr[1] . $arr[0]]['order'] = $arr[0] . $arr[1];
                            }
                        } else {
                            $list_cau[$value]['cau'] = $list_cau[$value]['cau'] + 1;
                            $list_cau[$value]['so'] = $value;
                            $list_cau[$value]['order'] = $value;
                        }
                    }
                }
                foreach ($list_cau as $key => $value) {
                    $sort_so[$key] = $value['order'];
                    $sort_cau[$key] = $value['cau'];
                }
                array_multisort($sort_cau, SORT_DESC, $sort_so, SORT_ASC, $list_cau);

                $rs = array();
                foreach ($list_cau as $item)
                    $rs[] = $item['so'];

                $this->load->library(array('simple_cache'));
                $this->simple_cache->cache_item('data_cau', $rs);
                $this->data['cau_2nhay'] = $rs;
            }
        }

        $lname = '';
        if ($lid > 0) {
            foreach ($this->data['xs_location_menu'] as $value) {
                if ($value->id == $lid) {
                    $lname = $value->name;
                    break;
                }
            }
        }
        $this->data['lname'] = $lname;
        $this->load->view('home/loadtkhome', $this->data);
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */