<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require 'client' . EXT;

class tructiep extends Client {

    function __construct() {
        parent::__construct();
        $time = date('H:i');
        if ($time > '16:00' && $time < '19:00')
            header("Cache-Control: max-age=3");
    }

    public function index($alias) {
        $this->load->model('xs_result_model');

        $timer['MB'] = '18:05';
        $timer['MT'] = '17:14';
        $timer['MN'] = '16:12';
        $timeMB_end = '18:55';
        $timeMT_end = '17:55';
        $timeMN_end = '16:55';

        $time = date('H:i');
        if ($time >= $timer['MN'] && $time < $timeMN_end) {
            $this->data['meta_refresh_mn'] = false;
        } elseif ($time >= $timer['MT'] && $time < $timeMT_end) {
            $this->data['meta_refresh_mt'] = false;
        } elseif ($time >= $timer['MB'] && $time < $timeMB_end) {
            $this->data['meta_refresh_mb'] = false;
        }
		if($alias == 'home'){
			$this->data['_meta']['title'] = "Xem trực tiếp kết quả xổ số toàn quốc";
			$this->data['_meta']['description'] = "Xem kết quả xổ số trực tiếp toàn quốc nhanh nhất, chính xác nhất tại xoso.com cập nhật liên tục từng giải trong suốt quá trình mở thưởng.";
			$this->data['_meta']['keywords'] = "trực tiếp kết quả xổ số, kết quả xổ số trực tiếp, xổ số trực tiếp, xo so truc tiep, truc tiep ket qua xo so";
			
		}elseif($alias == 'mien-trung'){
			$this->data['_meta']['title'] = "Xem trực tiếp kết quả xổ số miền trung";
			$this->data['_meta']['description'] = "Xem kết quả xổ số trực miền trung quốc nhanh nhất, chính xác nhất tại xoso.com cập nhật liên tục từng giải trong suốt quá trình mở thưởng.";
			$this->data['_meta']['keywords'] = "trực tiếp kết quả xổ số miền trung, kết quả xổ số trực tiếp miền trung, xổ số trực tiếp miền trung, xo so truc tiep mien bac trung, truc tiep ket qua xo so mien trung";
		}elseif($alias == 'mien-nam'){
			$this->data['_meta']['title'] = "Xem trực tiếp kết quả xổ số miền nam";
			$this->data['_meta']['description'] = "Xem kết quả xổ số trực miền nam quốc nhanh nhất, chính xác nhất tại xoso.com cập nhật liên tục từng giải trong suốt quá trình mở thưởng.";
			$this->data['_meta']['keywords'] = "trực tiếp kết quả xổ số miền nam, kết quả xổ số trực tiếp miền nam, xổ số trực tiếp miền nam, xo so truc tiep mien bac nam, truc tiep ket qua xo so mien nam";
		}else{
			$this->data['_meta']['title'] = "Xem trực tiếp kết quả xổ số miền bắc";
			$this->data['_meta']['description'] = "Xem kết quả xổ số trực miền bắc quốc nhanh nhất, chính xác nhất tại xoso.com cập nhật liên tục từng giải trong suốt quá trình mở thưởng.";
			$this->data['_meta']['keywords'] = "trực tiếp kết quả xổ số miền bắc, kết quả xổ số trực tiếp miền bắc, xổ số trực tiếp miền bắc, xo so truc tiep mien bac bắc, truc tiep ket qua xo so mien bac";
		}
        if ($alias == 'home') {
//            if ($time >= $timer['MN'] && $time < $timeMN_end) {
//                $alias = 'mien-nam';
//            } elseif ($time >= $timer['MT'] && $time < $timeMT_end) {
//                $alias = 'mien-trung';
//            }

            if ($time < '17:00') {
                $alias = 'mien-nam';
            } elseif ($time >= '17:00' && $time <= '18:00') {
                $alias = 'mien-trung';
            }
        }

        $area = 'MB';
        $replace = array('Miền Bắc', 'mien bac');
        $this->data['timer'] = $this->data['location_menu']['MB'][0]->time;
        if ($alias == 'mien-trung') {
            $area = 'MT';
            $replace = array('Miền Trung', 'mien trung');
            $this->data['timer'] = $this->data['location_menu']['MT'][0]->time;
        } elseif ($alias == 'mien-nam') {
            $area = 'MN';
            $replace = array('Miền Nam', 'mien nam');
            $this->data['timer'] = $this->data['location_menu']['MN'][0]->time;
        }

        $search = array('[TITLE]', '[TITLE_NONE]');
		
        

//        $this->data['timer'] = $this->xs_result_model->getTimer($area);
//        $this->data['location'] = array();
//        if ($area != 'MB') {
//            $this->data['location'] = $this->xs_location_model->getLocation($area);
//        }

        $this->data['area'] = $area;

//        $this->data['tmpl'] = 'xoso/tructiep';
        $this->data['tmpl'] = 'xoso/tttt';
        $this->load->view('layout/content', $this->data);
    }

//    public function tt($alias) {
//        $this->load->model('xs_result_model');
//
//        $timer = $this->xs_result_model->getTimer();
//
//        $timeMB_end = '18:55';
//        $timeMT_end = '17:55';
//        $timeMN_end = '16:55';
//
//        $time = date('H:i');
//        if ($time >= $timer['MN'] && $time < $timeMN_end) {
//            $this->data['meta_refresh_mn'] = false;
//        } elseif ($time >= $timer['MT'] && $time < $timeMT_end) {
//            $this->data['meta_refresh_mt'] = false;
//        } elseif ($time >= $timer['MB'] && $time < $timeMB_end) {
//            $this->data['meta_refresh_mb'] = false;
//        }
//
//        if ($alias == 'home') {
////            if ($time >= $timer['MN'] && $time < $timeMN_end) {
////                $alias = 'mien-nam';
////            } elseif ($time >= $timer['MT'] && $time < $timeMT_end) {
////                $alias = 'mien-trung';
////            }
//
//            if ($time < '17:00') {
//                $alias = 'mien-nam';
//            } elseif ($time >= '17:00' && $time <= '18:00') {
//                $alias = 'mien-trung';
//            }
//        }
//
//        $area = 'MB';
//        $replace = array('Miền Bắc', 'mien bac');
//        $this->data['timer'] = $this->data['location_menu']['MB'][0]->time;
//        if ($alias == 'mien-trung') {
//            $area = 'MT';
//            $replace = array('Miền Trung', 'mien trung');
//            $this->data['timer'] = $this->data['location_menu']['MT'][0]->time;
//        } elseif ($alias == 'mien-nam') {
//            $area = 'MN';
//            $replace = array('Miền Nam', 'mien nam');
//            $this->data['timer'] = $this->data['location_menu']['MN'][0]->time;
//        }
//
//        $search = array('[TITLE]', '[TITLE_NONE]');
//        $this->data['_meta'] = $this->meta_model->show_title('truc_tiep', $search, $replace);
//
////        $this->data['timer'] = $this->xs_result_model->getTimer($area);
////        $this->data['location'] = array();
////        if ($area != 'MB') {
////            $this->data['location'] = $this->xs_location_model->getLocation($area);
////        }
//
//        $this->data['area'] = $area;
//
//        $this->data['tmpl'] = 'xoso/tttt';
//        $this->load->view('layout/content', $this->data);
//    }

}