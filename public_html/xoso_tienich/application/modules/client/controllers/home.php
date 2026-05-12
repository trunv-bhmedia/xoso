<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require 'client' . EXT;

class Home extends Client {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model('xs_result_model');
//        $timer = $this->xs_result_model->getTimer();
//
//        $timeMB_end = '18:55';
//        $timeMT_end = '17:55';
//        $timeMN_end = '16:55';
//
//        $this->data['tttt_mb'] = false;
//        $this->data['tttt_mt'] = false;
//        $this->data['tttt_mn'] = false;
//        $time = date('H:i');
//        if ($time >= $timer['MN'] && $time < $timeMN_end) {
//            $this->data['tttt_mn'] = true;
//        } elseif ($time >= $timer['MT'] && $time < $timeMT_end) {
//            $this->data['tttt_mt'] = true;
//        } elseif ($time >= $timer['MB'] && $time < $timeMB_end) {
//            $this->data['tttt_mb'] = true;
//        }
//        $this->simple_cache->delete_item('home_data');
        // key is the name you have given to the cached data
        // will check if the item is cached or
//        $home_data = array();
//        if (!$this->simple_cache->is_cached('home_data')) {
        // not cached, do our things that need caching
//        $this->load->helper('upload');
//        $area = 0;
//        $date = date('Y-m-d');
//        $lastdate = date('Y-m-d', strtotime('-1 day'));
//        $rows['MB_NEW'] = $this->xs_result_model->read_xml($area, $date, 1);
//        if(!$rows['MB_NEW'])
//            $rows['MB_NEW'] = $this->xs_result_model->read_xml($area, $lastdate, 1);
//
//        $area = 1;
//        $rows['MT_NEW'] = $this->xs_result_model->read_xml($area, $date, 1);
//        if(!$rows['MT_NEW'])
//            $rows['MT_NEW'] = $this->xs_result_model->read_xml($area, $lastdate, 1);
//
//        $area = 2;
//        $rows['MN_NEW'] = $this->xs_result_model->read_xml($area, $date, 1);
//        if(!$rows['MN_NEW'])
//            $rows['MN_NEW'] = $this->xs_result_model->read_xml($area, $lastdate, 1);
//
//        if (!$rows['MB_NEW'] || !$rows['MT_NEW'] || !$rows['MN_NEW']) {
//        $lastrows = $this->xs_result_model->getLastItems();
//            $rows = array_merge($rows, $lastrows);
//        }
//        if ($rows['MB_NEW']) {
//            $tmp = $rows['MB_NEW']->date;
//            $rows['MB_NEW'] = $rows['MB_NEW']->cache->data;
//            $rows['MB_NEW']->date = $tmp;
//        }
//        if ($rows['MT_NEW']) {
//            $tmp = $rows['MT_NEW']->date;
//            $rows['MT_NEW'] = $rows['MT_NEW']->cache->data;
//            $rows['MT_NEW']->date = $tmp;
//        }
//        if ($rows['MN_NEW']) {
//            $tmp = $rows['MN_NEW']->date;
//            $rows['MN_NEW'] = $rows['MN_NEW']->cache->data;
//            $rows['MN_NEW']->date = $tmp;
//        }
//            var_dump($rows);

        $yesterday = date('Y-m-d', strtotime('-1 day'));
        $today = date('Y-m-d');
//        $yesterday = '2013-01-01';
//        $today = '2013-01-02';
        $this->db->where('(r.date=\'' . $yesterday . '\' OR r.date=\'' . $today . '\')');
        $this->db->where('l.status', 1);
        $data = $this->db->select('r.a0,r.date,l.name,l.alias,l.area')
                ->from('xs_result AS r')
                ->join('xs_location AS l', 'r.lid = l.id', 'left')
                ->order_by('r.date', 'DESC')
                ->order_by('l.ordering', 'ASC')
                ->get()
                ->result();
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
        $this->data['_meta'] = $this->meta_model->show_title('home');
        $this->data['_meta']['title'] = 'Xổ số ket qua xo so truc tiep KQXS nhanh nhat cho mobile';

//        $home_data['items'] = $this->xs_result_model->getItemsFirstLast(30, 1);
//        $this->load->model(array('xs_northern_model'));
//        $home_data['xsdt'] = $this->xs_northern_model->getResult();
//            $home_data['items'] = $this->xs_statistics_model->getItemsStatistics();
//            $home_data['locations'] = $this->xs_statistics_model->getNowLocations();
//            // store in cache
//            $this->simple_cache->cache_item('home_data', $home_data);
//        } else {
//            $home_data = $this->simple_cache->get_item('home_data');
//        }

//        $this->data = array_merge($this->data, $home_data);

        $this->data['tmpl'] = 'home/home';
        $this->load->view('layout/content', $this->data);
    }

    function matinh() {
        $this->data['tmpl'] = 'home/matinh';
        $this->load->view('layout/content', $this->data);
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */