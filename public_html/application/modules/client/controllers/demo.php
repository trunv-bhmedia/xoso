<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require 'client' . EXT;

class demo extends Client {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model(array('demo_model', 'doitac_model'));
        $this->demo_model->order_by('order', 'ASC');
        $this->demo_model->order_by('id', 'DESC');
        $items = $this->demo_model->get_many_by(array("published" => 1));

        $this->doitac_model->order_by('order', 'ASC');
        $this->doitac_model->order_by('id', 'DESC');
        $doitac = $this->doitac_model->get_many_by(array("published" => 1));

        $this->data['_meta'] = $this->meta_model->show_title('demo');
        $this->data['items'] = $items;
        $this->data['doitac'] = $doitac;
        $this->data['tmpl'] = 'demo/index';
        $this->load->view('layout/demo', $this->data);
    }

    public function tao_ma_nhung() {
        $this->data['_meta'] = $this->meta_model->show_title('tao_ma_nhung');
        $this->data['tmpl'] = 'demo/tao_ma_nhung';
        $this->load->view('layout/content', $this->data);
    }

    public function getkqxs($alias = '', $date = '') {
        $this->load->model('xs_result_model');

        $lid = 1;
        if ($alias != '') {
            foreach ($this->data['xs_location_menu'] as $value) {
                if ($value->alias == $alias) {
                    $lid = $value->id;
                    break;
                }
            }
        }

//        $today = date('d-m-Y', time());
//        if (!$this->simple_cache->is_cached('demo_date_' . $lid . '_' . $today)) {
            $this->data['demo_date'] = $this->xs_result_model->getDemoDate($lid);
            // store in cache
//            $this->simple_cache->cache_item('demo_data_' . $lid . '_' . $today, $this->data['demo_date']);
//        } else {
//            $this->data['demo_date'] = $this->simple_cache->get_item('demo_date_' . $lid . '_' . $today);
//        }
        if ($date == '') {
            $date = $this->data['demo_date'][0]->date;
//            if (!$this->simple_cache->is_cached('demo_data_' . $lid . '_' . $date)) {
                $this->data['item'] = $this->xs_result_model->getDemoItem($lid, $date);
                // store in cache
//                $this->simple_cache->cache_item('demo_data_' . $lid . '_' . $date, $this->data['item']);
//            } else {
//                $this->data['item'] = $this->simple_cache->get_item('demo_data_' . $lid . '_' . $date);
//            }
        } else {
            $date_ = date('Y-m-d', strtotime($date));
//            if (!$this->simple_cache->is_cached('demo_data_' . $lid . '_' . $date_)) {
                $this->data['item'] = $this->xs_result_model->getDemoItem($lid, $date_);
                // store in cache
//                $this->simple_cache->cache_item('demo_data_' . $lid . '_' . $date_, $this->data['item']);
//            } else {
//                $this->data['item'] = $this->simple_cache->get_item('demo_data_' . $lid . '_' . $date_);
//            }
        }

        $this->data['lid'] = $lid;
        $this->data['date'] = $date;
        $this->load->view('demo/getkqxs', $this->data);
    }

    public function getkqxsdemo($alias = '', $date = '') {
        $this->load->model('xs_result_model');

        $lid = 1;
        if ($alias != '') {
            foreach ($this->data['xs_location_menu'] as $value) {
                if ($value->alias == $alias) {
                    $lid = $value->id;
                    break;
                }
            }
        }

//        $today = date('d-m-Y', time());
//        if (!$this->simple_cache->is_cached('demo_date_' . $lid . '_' . $today)) {
            $this->data['demo_date'] = $this->xs_result_model->getDemoDate($lid);
            // store in cache
//            $this->simple_cache->cache_item('demo_data_' . $lid . '_' . $today, $this->data['demo_date']);
//        } else {
//            $this->data['demo_date'] = $this->simple_cache->get_item('demo_date_' . $lid . '_' . $today);
//        }
        if ($date == '') {
            $date = $this->data['demo_date'][0]->date;
//            if (!$this->simple_cache->is_cached('demo_data_' . $lid . '_' . $date)) {
                $this->data['item'] = $this->xs_result_model->getDemoItem($lid, $date);
                // store in cache
//                $this->simple_cache->cache_item('demo_data_' . $lid . '_' . $date, $this->data['item']);
//            } else {
//                $this->data['item'] = $this->simple_cache->get_item('demo_data_' . $lid . '_' . $date);
//            }
        } else {
            $date_ = date('Y-m-d', strtotime($date));
//            if (!$this->simple_cache->is_cached('demo_data_' . $lid . '_' . $date_)) {
                $this->data['item'] = $this->xs_result_model->getDemoItem($lid, $date_);
                // store in cache
//                $this->simple_cache->cache_item('demo_data_' . $lid . '_' . $date_, $this->data['item']);
//            } else {
//                $this->data['item'] = $this->simple_cache->get_item('demo_data_' . $lid . '_' . $date_);
//            }
        }

        $this->data['lid'] = $lid;
        $this->data['date'] = $date;
        $this->load->view('demo/getkqxsdemo', $this->data);
    }

    public function getkqxsj($alias = '', $date = '') {
        $this->load->model('xs_result_model');

        $lid = 1;
        if ($alias != '') {
            foreach ($this->data['xs_location_menu'] as $value) {
                if ($value->alias == $alias) {
                    $lid = $value->id;
                    break;
                }
            }
        }

//        $today = date('d-m-Y', time());
//        if (!$this->simple_cache->is_cached('demo_date_' . $lid . '_' . $today)) {
            $this->data['demo_date'] = $this->xs_result_model->getDemoDate($lid);
            // store in cache
//            $this->simple_cache->cache_item('demo_data_' . $lid . '_' . $today, $this->data['demo_date']);
//        } else {
//            $this->data['demo_date'] = $this->simple_cache->get_item('demo_date_' . $lid . '_' . $today);
//        }
        if ($date == '') {
            $date = $this->data['demo_date'][0]->date;
//            if (!$this->simple_cache->is_cached('demo_data_' . $lid . '_' . $date)) {
                $this->data['item'] = $this->xs_result_model->getDemoItem($lid, $date);
                // store in cache
//                $this->simple_cache->cache_item('demo_data_' . $lid . '_' . $date, $this->data['item']);
//            } else {
//                $this->data['item'] = $this->simple_cache->get_item('demo_data_' . $lid . '_' . $date);
//            }
        } else {
            $date_ = date('Y-m-d', strtotime($date));
//            if (!$this->simple_cache->is_cached('demo_data_' . $lid . '_' . $date_)) {
                $this->data['item'] = $this->xs_result_model->getDemoItem($lid, $date_);
                // store in cache
//                $this->simple_cache->cache_item('demo_data_' . $lid . '_' . $date_, $this->data['item']);
//            } else {
//                $this->data['item'] = $this->simple_cache->get_item('demo_data_' . $lid . '_' . $date_);
//            }
        }

        $this->data['lid'] = $lid;
        $this->data['date'] = $date;
        $this->load->view('demo/getkqxsj', $this->data);
    }

    public function getkqxsj2($alias = '', $date = '') {
        $this->load->model('xs_result_model');

        $lid = 1;
        if ($alias != '') {
            foreach ($this->data['xs_location_menu'] as $value) {
                if ($value->alias == $alias) {
                    $lid = $value->id;
                    break;
                }
            }
        }

//        $today = date('d-m-Y', time());
//        if (!$this->simple_cache->is_cached('demo_date_' . $lid . '_' . $today)) {
            $this->data['demo_date'] = $this->xs_result_model->getDemoDate($lid);
            // store in cache
//            $this->simple_cache->cache_item('demo_data_' . $lid . '_' . $today, $this->data['demo_date']);
//        } else {
//            $this->data['demo_date'] = $this->simple_cache->get_item('demo_date_' . $lid . '_' . $today);
//        }
        if ($date == '') {
            $date = $this->data['demo_date'][0]->date;
//            if (!$this->simple_cache->is_cached('demo_data_' . $lid . '_' . $date)) {
                $this->data['item'] = $this->xs_result_model->getDemoItem($lid, $date);
                // store in cache
//                $this->simple_cache->cache_item('demo_data_' . $lid . '_' . $date, $this->data['item']);
//            } else {
//                $this->data['item'] = $this->simple_cache->get_item('demo_data_' . $lid . '_' . $date);
//            }
        } else {
            $date_ = date('Y-m-d', strtotime($date));
//            if (!$this->simple_cache->is_cached('demo_data_' . $lid . '_' . $date_)) {
                $this->data['item'] = $this->xs_result_model->getDemoItem($lid, $date_);
                // store in cache
//                $this->simple_cache->cache_item('demo_data_' . $lid . '_' . $date_, $this->data['item']);
//            } else {
//                $this->data['item'] = $this->simple_cache->get_item('demo_data_' . $lid . '_' . $date_);
//            }
        }

        $this->data['lid'] = $lid;
        $this->data['date'] = $date;
        $this->load->view('demo/getkqxsj2', $this->data);
    }

    public function getkqxswp($alias = '', $date = '') {
        $this->load->model('xs_result_model');

        $lid = 1;
        if ($alias != '') {
            foreach ($this->data['xs_location_menu'] as $value) {
                if ($value->alias == $alias) {
                    $lid = $value->id;
                    break;
                }
            }
        }

//        $today = date('d-m-Y', time());
//        if (!$this->simple_cache->is_cached('demo_date_' . $lid . '_' . $today)) {
            $this->data['demo_date'] = $this->xs_result_model->getDemoDate($lid);
            // store in cache
//            $this->simple_cache->cache_item('demo_data_' . $lid . '_' . $today, $this->data['demo_date']);
//        } else {
//            $this->data['demo_date'] = $this->simple_cache->get_item('demo_date_' . $lid . '_' . $today);
//        }
        if ($date == '') {
            $date = $this->data['demo_date'][0]->date;
//            if (!$this->simple_cache->is_cached('demo_data_' . $lid . '_' . $date)) {
                $this->data['item'] = $this->xs_result_model->getDemoItem($lid, $date);
                // store in cache
//                $this->simple_cache->cache_item('demo_data_' . $lid . '_' . $date, $this->data['item']);
//            } else {
//                $this->data['item'] = $this->simple_cache->get_item('demo_data_' . $lid . '_' . $date);
//            }
        } else {
            $date_ = date('Y-m-d', strtotime($date));
//            if (!$this->simple_cache->is_cached('demo_data_' . $lid . '_' . $date_)) {
                $this->data['item'] = $this->xs_result_model->getDemoItem($lid, $date_);
                // store in cache
//                $this->simple_cache->cache_item('demo_data_' . $lid . '_' . $date_, $this->data['item']);
//            } else {
//                $this->data['item'] = $this->simple_cache->get_item('demo_data_' . $lid . '_' . $date_);
//            }
        }

        $this->data['lid'] = $lid;
        $this->data['date'] = $date;
        $this->load->view('demo/getkqxswp', $this->data);
    }

}