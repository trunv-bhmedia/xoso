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

        if ($alias == 'home') {
            $timer = $this->xs_result_model->getTimer();

            $timeMT_end = '17:55';
            $timeMN_end = '16:55';

            $time = date('H:i');
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
        $this->data['_meta'] = $this->meta_model->show_title('truc_tiep', $search, $replace);

//        $this->data['timer'] = $this->xs_result_model->getTimer($area);
//        $this->data['location'] = array();
//        if ($area != 'MB')
//            $this->data['location'] = $this->xs_location_model->getLocation($area);

        $this->data['area'] = $area;

//        $this->data['tmpl'] = 'xoso/tructiep';
        $this->data['tmpl'] = 'xoso/tttt';
        $this->load->view('layout/content', $this->data);
    }

//    public function tt($alias) {
//        $this->load->model('xs_result_model');
//
//        if ($alias == 'home') {
//            $timer = $this->xs_result_model->getTimer();
//
//            $timeMT_end = '17:55';
//            $timeMN_end = '16:55';
//
//            $time = date('H:i');
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
////        if ($area != 'MB')
////            $this->data['location'] = $this->xs_location_model->getLocation($area);
//
//        $this->data['area'] = $area;
//
//        $this->data['tmpl'] = 'xoso/tttt';
//        $this->load->view('layout/content', $this->data);
//    }

}