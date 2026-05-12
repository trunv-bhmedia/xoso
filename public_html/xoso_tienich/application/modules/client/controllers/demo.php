<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require 'client' . EXT;

class demo extends Client {

    function __construct() {
        parent::__construct();
    }

    public function index($type) {
        $kqwidth = '500px';
        switch ($type) {
            case 'index':
                $kqwidth = '500px';
                break;
            case 'demo-02':
                $kqwidth = '200px';
                break;
            case 'demo-03':
                $kqwidth = '50%';
                break;
            case 'demo-04':
                $kqwidth = '100%';
                break;
            case 'demo-05':
                $kqwidth = '155px';
                break;
            case 'demo-06':
                $kqwidth = '250px';
                break;
        }
        $this->data['_meta'] = $this->meta_model->show_title('demo');
        $this->data['kqwidth'] = $kqwidth;
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

        $this->data['demo_date'] = $this->xs_result_model->getDemoDate($lid);
        if ($date == '') {
            $date = $this->data['demo_date'][0]->date;
            $this->data['item'] = $this->xs_result_model->getDemoItem($lid, $date);
        } else {
            $this->data['item'] = $this->xs_result_model->getDemoItem($lid, date('Y-m-d', strtotime($date)));
        }

        $this->data['lid'] = $lid;
        $this->data['date'] = $date;
        $this->load->view('demo/getkqxs', $this->data);
    }

}